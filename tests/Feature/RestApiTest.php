<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Str;
use Tests\TestCase;

class RestApiTest extends TestCase
{
    use RefreshDatabase;

    public function test_account_tokens_can_be_issued_used_and_revoked(): void
    {
        $account = [
            'name' => 'Pelanggan', 'email' => 'pelanggan@example.test',
            'password' => 'kata-sandi-123', 'password_confirmation' => 'kata-sandi-123',
            'is_admin' => true,
        ];
        $created = $this->postJson('/api/auth/register', $account)->assertCreated()
            ->assertJsonPath('data.user.is_admin', false)
            ->assertJsonMissingPath('data.user.password');

        $token = $created->json('data.token');
        $this->api('GET', '/api/auth/me', $token)->assertOk()->assertJsonPath('data.email', $account['email']);
        $this->api('POST', '/api/auth/logout', $token)->assertOk();
        $this->api('GET', '/api/auth/me', $token)->assertUnauthorized();

        $this->api('POST', '/api/auth/login', '', ['email' => $account['email'], 'password' => 'salah'])
            ->assertUnauthorized();
        $login = $this->api('POST', '/api/auth/login', '', $account)->assertOk();
        $this->api('GET', '/api/auth/me', $login->json('data.token'))->assertOk();
        $this->app['auth']->forgetGuards();
        $this->get('/api/auth/me')->assertUnauthorized()->assertJsonPath('status', 'error')->assertJsonStructure(['status', 'message', 'data']);
    }

    public function test_catalog_orders_and_notifications_work_with_real_permissions(): void
    {
        $admin = User::factory()->create(['is_admin' => true])->createToken('test')->plainTextToken;
        $user = User::factory()->create();
        $customer = $user->createToken('test')->plainTextToken;
        $other = User::factory()->create()->createToken('test')->plainTextToken;

        $this->api('GET', '/api/categories', '')->assertOk()->assertJsonPath('status', 'success')->assertJsonPath('data', []);
        $this->api('GET', '/api/menus', '')->assertOk()->assertJsonPath('status', 'success')->assertJsonPath('data', []);
        $this->api('POST', '/api/categories', $customer, ['name' => 'Makanan'])->assertForbidden();
        $category = $this->api('POST', '/api/categories', $admin, ['name' => 'Makanan'])
            ->assertCreated()->json('data.id');
        $this->api('PATCH', "/api/categories/$category", $admin, ['name' => 'Makanan Berat'])
            ->assertOk()->assertJsonPath('data.name', 'Makanan Berat');

        $menu = $this->api('POST', '/api/menus', $admin, ['name' => 'Ayam', 'category_id' => $category, 'price' => 16000])
            ->assertCreated()->json('data.id');
        $this->api('GET', "/api/menus/$menu", '')->assertOk()->assertJsonPath('data.name', 'Ayam');
        $this->api('PATCH', "/api/menus/$menu", $admin, ['price' => 15000])->assertOk();
        $this->api('DELETE', "/api/categories/$category", $admin)->assertConflict();

        $body = ['items' => [['menu_id' => $menu, 'quantity' => 2]], 'pickup' => 'scheduled', 'pickup_time' => '14:00', 'total' => 1];
        $key = ['Idempotency-Key' => (string) Str::uuid()];
        $order = $this->api('POST', '/api/orders', $customer, $body, $key)->assertCreated()
            ->assertJsonPath('data.status', 'pending')->assertJsonMissingPath('data.checkout_token')->json('data.id');
        $this->api('POST', '/api/orders', $customer, $body, $key)->assertOk()->assertJsonPath('data.id', $order);
        $this->assertDatabaseCount('orders', 1);
        $this->assertDatabaseHas('orders', ['id' => $order, 'total' => 30000, 'payment_method' => 'cash']);
        $this->assertDatabaseHas('order_items', ['order_id' => $order, 'quantity' => 2, 'unit_price' => 15000]);
        $this->api('GET', '/api/orders', $customer)->assertOk()->assertJsonPath('meta.total', 1);
        $this->api('GET', "/api/orders/$order", $customer)->assertOk()->assertJsonPath('data.id', $order);
        $this->api('GET', "/api/orders/$order", $other)->assertNotFound();
        $this->api('GET', '/api/admin/orders', $customer)->assertForbidden();
        $this->api('GET', '/api/admin/orders', $admin)->assertOk()->assertJsonPath('meta.total', 1);
        $this->api('PATCH', "/api/orders/$order/status", $customer, ['status' => 'preparing'])->assertForbidden();
        $this->api('PATCH', "/api/orders/$order/status", $admin, ['status' => 'ready'])->assertConflict();
        $this->api('PATCH', "/api/orders/$order/status", $admin, ['status' => 'preparing'])
            ->assertOk()->assertJsonPath('data.status', 'preparing');

        $notification = $this->api('GET', '/api/notifications', $customer)->assertOk()
            ->assertJsonPath('data.0.data.order_id', $order)->json('data.0.id');
        $this->api('PATCH', "/api/notifications/$notification/read", $other)->assertNotFound();
        $this->api('PATCH', "/api/notifications/$notification/read", $customer)->assertOk();
        $this->assertNotNull($user->notifications()->findOrFail($notification)->read_at);

        $this->api('DELETE', "/api/menus/$menu", $admin)->assertOk();
        $this->api('POST', '/api/orders', $customer, $body)->assertUnprocessable()->assertJsonPath('status', 'error')->assertJsonValidationErrors('items');
        $this->api('DELETE', "/api/categories/$category", $admin)->assertOk();
        $this->assertDatabaseHas('order_items', ['order_id' => $order, 'menu_id' => null, 'name' => 'Ayam']);
    }

    private function api(string $method, string $uri, string $token, array $data = [], array $headers = [])
    {
        $this->app['auth']->forgetGuards();

        return $this->json($method, $uri, $data, $token ? $headers + ['Authorization' => 'Bearer '.$token] : $headers);
    }
}
