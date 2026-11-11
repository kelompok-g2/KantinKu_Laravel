<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Menu;
use App\Models\Order;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Ramsey\Uuid\Uuid;
use RuntimeException;

class P09DemoSeeder extends Seeder
{
    public function run(): void
    {
        $password = env('P09_DEMO_PASSWORD');
        if (! app()->environment('local', 'testing') || ! is_string($password) || strlen($password) < 12 || strlen($password) > 72) {
            throw new RuntimeException('Seeder demo hanya untuk local/testing dengan P09_DEMO_PASSWORD sepanjang 12–72 byte.');
        }

        DB::transaction(function () use ($password) {
            User::firstOrNew(['email' => 'admin.p09@example.test'])->forceFill([
                'name' => 'Pengelola Demo P09', 'password' => $password, 'is_admin' => true,
            ])->save();

            $catalog = [
                ['Makanan Berat', 'Ayam Geprek', 16000],
                ['Minuman', 'Es Teh', 4000],
                ['Camilan', 'Roti Bakar', 9000],
                ['Paket Hemat', 'Nasi Ayam Komplet', 20000],
                ['Sarapan', 'Bubur Ayam', 12000],
            ];

            foreach ($catalog as $index => [$categoryName, $name, $price]) {
                $number = $index + 1;
                $user = User::firstOrNew(['email' => "pelanggan{$number}.p09@example.test"]);
                $user->forceFill(['name' => "Pelanggan Demo {$number}", 'password' => $password, 'is_admin' => false])->save();

                $category = Category::firstOrNew(['name' => "{$categoryName} Demo P09"]);
                $category->forceFill(['description' => 'Kategori demo Pertemuan 9'])->save();
                $menu = Menu::firstOrNew(['name' => "{$name} Demo P09"]);
                $menu->forceFill(['category_id' => $category->id, 'price' => $price, 'stand' => 'Kantin Demo', 'is_available' => true])->save();

                $token = Uuid::uuid5(Uuid::NAMESPACE_URL, "kantinku-p09-seeder/order/{$number}")->toString();
                $order = Order::firstOrNew(['checkout_token' => $token]);
                $order->forceFill(['user_id' => $user->id, 'status' => 'preparing', 'total' => $price, 'pickup' => 'asap', 'payment_method' => 'cash'])->save();
                $order->items()->updateOrCreate(['name' => $menu->name], [
                    'menu_id' => $menu->id, 'stand' => $menu->stand, 'unit_price' => $price, 'quantity' => 1,
                ]);

                $notification = Uuid::uuid5(Uuid::NAMESPACE_URL, "kantinku-p09-seeder/notification/{$number}")->toString();
                $user->notifications()->updateOrCreate(['id' => $notification], [
                    'type' => 'order-status', 'data' => ['order_id' => $order->id, 'status' => 'preparing', 'message' => 'Diproses'],
                ]);
            }
        });
    }
}
