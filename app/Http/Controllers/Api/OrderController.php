<?php

namespace App\Http\Controllers\Api;

use App\Models\Order;
use App\Services\OrderService;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Ramsey\Uuid\Uuid;

class OrderController extends ApiController
{
    public function index(Request $request)
    {
        $orders = Order::where('user_id', $request->user()->id)->with('items')->latest('id')->paginate(20);

        return $this->success('Daftar pesanan pengguna.', $orders);
    }

    public function all()
    {
        return $this->success('Daftar pesanan kantin.', Order::with('items')->latest('id')->paginate(20));
    }

    public function show(Request $request, Order $order)
    {
        abort_unless($order->user_id === $request->user()->id || $request->user()->is_admin, 404);

        return $this->success('Detail pesanan.', $order->load('items'));
    }

    public function store(Request $request, OrderService $orders)
    {
        $data = $request->validate([
            'items' => 'required|array|min:1|max:50',
            'items.*' => 'required|array:menu_id,quantity',
            'items.*.menu_id' => 'required|integer|min:1|distinct',
            'items.*.quantity' => 'required|integer|min:1|max:20',
            'pickup' => 'required|in:asap,after_class,scheduled',
            'pickup_time' => 'exclude_unless:pickup,scheduled|required|date_format:H:i',
            'note' => 'nullable|string|max:300',
        ]);
        $key = $request->header('Idempotency-Key');
        $user = $request->user();
        validator(['key' => $key], ['key' => 'nullable|uuid'])->validate();
        $token = $key
            ? Uuid::uuid5(Uuid::NAMESPACE_URL, 'kantinku-api-order:'.$user->id.':'.strtolower($key))->toString()
            : (string) Str::uuid();
        $quantities = array_column($data['items'], 'quantity', 'menu_id');

        [$order, $created] = $orders->place($user, $quantities, $data, $token);

        return $this->success($created ? 'Pesanan berhasil dibuat.' : 'Pesanan sudah dibuat.', $order, $created ? 201 : 200);
    }

    public function updateStatus(Request $request, Order $order, OrderService $orders)
    {
        $data = $request->validate(['status' => ['required', Rule::in(array_values(Order::NEXT))]]);
        $updated = $orders->advance($order, $order->status, $data['status']);
        abort_unless($updated, 409, 'Status pesanan tidak dapat berpindah ke tahap itu.');

        return $this->success('Status pesanan berhasil diperbarui.', $updated);
    }
}
