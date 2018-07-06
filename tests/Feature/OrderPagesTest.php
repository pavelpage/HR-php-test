<?php

namespace Tests\Feature;

use App\Order;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class OrderPagesTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_can_see_list_of_orders()
    {
        factory(Order::class, 10)->create();

        $this->get(route('order.index'))
            ->assertStatus(200);
    }

    public function test_user_can_see_order_edit_page()
    {
        $order = factory(Order::class)->create();

        $this->get(route('order.edit', $order->id))
            ->assertSee($order->client_email);
    }

    public function test_user_can_update_order()
    {
        $order = factory(Order::class)->create(['status' => 20]);
        $data = $order->toArray();
        $data['status'] = 0;

        $this->patch(route('order.update', $order->id), [
            'order' => $data
        ])->assertStatus(302);

        $this->assertDatabaseHas('orders', [
            'id' => $order->id,
            'status' => 0,
        ]);
    }

    public function test_order_requires_valid_client_email()
    {
        $order = factory(Order::class)->create();

        $this->submitForm($order, ['client_email' => 'not-email'])
            ->assertSessionHasErrors('order.client_email');

        $this->submitForm($order, ['client_email' => ''])
            ->assertSessionHasErrors('order.client_email');
    }

    public function test_order_requires_valid_partner()
    {
        $order = factory(Order::class)->create();

        $this->submitForm($order, ['partner_id' => '-1'])
            ->assertSessionHasErrors('order.partner_id');

        $this->submitForm($order, ['partner_id' => ''])
            ->assertSessionHasErrors('order.partner_id');
    }

    public function test_order_requires_status()
    {
        $order = factory(Order::class)->create();

        $this->submitForm($order, ['status' => ''])
            ->assertSessionHasErrors('order.status');

        $this->submitForm($order, ['status' => '-12'])
            ->assertSessionHasErrors('order.status');
    }

    private function submitForm($order, $overrides = [])
    {
        $data = $order->toArray();
        $data = array_merge($data, $overrides);

        return $this->patch(route('order.update', $order->id), [
            'order' => $data
        ]);
    }

}
