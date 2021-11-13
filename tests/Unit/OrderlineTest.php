<?php

namespace Tests\Unit;

use App\Models\Orderline;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class OrderlineTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function anInvalidStatusIsNotSet(): void
    {
        $order = Orderline::factory()->create();
        /** @var Orderline $order */

        $response = $order->setStatus('invalid status');

        $this->assertEquals(false, $response);
        $this->assertDatabaseHas('orderlines', ['status' => $order::STATUS_NAMES[$order->getStatus()]]);
        $this->assertDatabaseMissing('orderlines', ['status' => 'invalid status']);
    }

    /** @test */
    public function aValidStatusIsSet(): void
    {
        $order = Orderline::factory()->create();
        /** @var Orderline $order */

        $response = $order->setStatus('queued packing');

        $this->assertEquals(true, $response);
        $this->assertDatabaseHas('orderlines', ['status' => $order::STATUS_NAMES['queued packing']]);
    }
}
