<?php

namespace Tests\Feature;

use App\Models\Order;
use App\Models\Orderline;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class OrderlineTest extends TestCase
{
    use RefreshDatabase;


    /** @test */
    public function updatingAnOrderlineRecalculatesOrderPrices(): void
    {
        $order = Order::factory()->hasOrderlines(1)->ready()->create();

        // These values are outside the values the Orderline factory will generate
        Orderline::first()->update([
            'quantity' => 300,
            'price_unit' => 1
        ]);
        $orderline = Orderline::first();

        $data = ['foo' => 'bar'];

        $response = $this->patchJson("/api/orderlines/$orderline->id", $data);
        $response->assertStatus(200);
        $this->assertEquals(300, $order->refresh()->price_total_net);
    }
}
