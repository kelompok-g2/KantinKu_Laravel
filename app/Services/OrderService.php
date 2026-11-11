<?php

namespace App\Services;

use App\Models\Menu;
use App\Models\Order;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

class OrderService
{
    public function place(User $user, array $quantities, array $details, string $token): array
    {
        return DB::transaction(function () use ($user, $quantities, $details, $token) {
            User::whereKey($user->id)->lockForUpdate()->firstOrFail();
            $existing = Order::where('user_id', $user->id)->where('checkout_token', $token)->first();
            if ($existing) {
                return [$existing->load('items'), false];
            }

            $menus = Menu::whereKey(array_keys($quantities))->orderBy('id')->lockForUpdate()->get();
            if (! $quantities || $menus->count() !== count($quantities) || $menus->contains(fn (Menu $menu) => ! $menu->is_available)) {
                throw ValidationException::withMessages(['items' => 'Pilih menu yang masih tersedia.']);
            }

            $totalCents = $menus->sum(fn (Menu $menu) => (int) round($menu->price * 100) * $quantities[$menu->id]);

            $order = Order::create([
                'user_id' => $user->id,
                'checkout_token' => $token,
                'total' => number_format($totalCents / 100, 2, '.', ''),
                'pickup' => $details['pickup'],
                'pickup_time' => $details['pickup_time'] ?? null,
                'note' => $details['note'] ?? null,
            ]);
            $order->items()->createMany($menus->map(fn (Menu $menu) => [
                'menu_id' => $menu->id,
                'name' => $menu->name,
                'stand' => $menu->stand,
                'unit_price' => $menu->price,
                'quantity' => $quantities[$menu->id],
            ])->all());

            return [$order->refresh()->load('items'), true];
        }, 3);
    }

    public function advance(Order $order, string $expected, string $status): ?Order
    {
        return DB::transaction(function () use ($order, $expected, $status) {
            $current = Order::whereKey($order->id)->lockForUpdate()->firstOrFail();
            if ($current->status !== $expected || (Order::NEXT[$expected] ?? null) !== $status) {
                return null;
            }

            $current->status = $status;
            $current->save();
            $current->user->notifications()->create([
                'id' => (string) Str::uuid(),
                'type' => 'order-status',
                'data' => ['order_id' => $current->id, 'status' => $status, 'message' => Order::STATUS[$status]],
            ]);

            return $current->load('items');
        }, 3);
    }
}
