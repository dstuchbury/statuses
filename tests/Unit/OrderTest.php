<?php

namespace Tests\Unit;

use App\Models\Order;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class OrderTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function anInvalidStatusIsNotSet(): void
    {
        $order = Order::factory()->create();
        /** @var Order $order */

        $response = $order->setStatus('invalid status');

        $this->assertEquals(false, $response);
        $this->assertDatabaseHas('orders', ['status' => $order::STATUS_NAMES[$order->getStatus()]]);
        $this->assertDatabaseMissing('orders', ['status' => 'invalid status']);
    }

    /** @test */
    public function aValidStatusIsSet(): void
    {
        $order = Order::factory()->create();
        /** @var Order $order */

        $response = $order->setStatus('queued packing');

        $this->assertEquals(true, $response);
        $this->assertDatabaseHas('orders', ['status' => $order::STATUS_NAMES['queued packing']]);
    }
}
