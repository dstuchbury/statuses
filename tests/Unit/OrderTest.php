<?php

namespace Tests\Unit;

use App\Models\Order;
use Illuminate\Foundation\Testing\RefreshDatabase;

class OrderTest extends \Tests\TestCase
{
    use RefreshDatabase;

    /** @test */
    public function anInvalidStatusIsNotSet(): void
    {
        $order = Order::factory()->create();
        /** @var Order $order */

        $response = $order->setStatus('invalid status');

        $this->assertEquals(false, $response);
        $this->assertDatabaseHas('orders', ['status' => $order::STATUS_DESCRIPTIONS[$order->getStatus()]]);
    }

    /** @test */
    public function aValidStatusIsSet(): void
    {
        $order = Order::factory()->create();
        /** @var Order $order */

        $response = $order->setStatus('queued packing');

        $this->assertEquals(true, $response);
        $this->assertDatabaseHas('orders', ['status' => $order::STATUS_DESCRIPTIONS['queued packing']]);
    }
}
