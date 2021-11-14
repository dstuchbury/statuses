<?php

namespace Tests\Feature;

use App\Models\Order;
use App\Models\Orderline;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class OrderTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function updatingAnOrderRecalculatesPrices(): void
    {
        $order = Order::factory()->hasOrderlines(1)->ready()->create();

        // These values are outside the values the Orderline factory will generate
        Orderline::first()->update([
            'quantity' => 300,
            'price_unit' => 1
        ]);

        $data = ['foo' => 'bar'];

        $this->patchJson("/api/orders/$order->id", $data);
        $this->assertEquals(300, $order->refresh()->price_total_net);
    }
}
