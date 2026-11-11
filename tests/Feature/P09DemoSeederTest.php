<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class P09DemoSeederTest extends TestCase
{
    use RefreshDatabase;

    public function test_demo_seeding_is_repeatable_and_populates_every_domain_table(): void
    {
        $this->seed();
        $this->seed();

        $this->assertDatabaseCount('users', 6);
        foreach (['categories', 'menus', 'orders', 'order_items', 'notifications'] as $table) {
            $this->assertDatabaseCount($table, 5);
        }
        $this->assertDatabaseHas('users', ['email' => 'admin.p09@example.test', 'is_admin' => true]);
    }
}
