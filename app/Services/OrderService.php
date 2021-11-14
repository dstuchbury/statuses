<?php

namespace App\Services;

use App\Models\Order;

class OrderService
{
    public function recalculatePrices(Order $order): void
    {
        $total = 0;
        foreach ($order->orderlines as $orderline) {
            $total = $orderline->quantity * $orderline->price_unit;
            \Log::info(sprintf('Line %s updating. New total %s', $orderline->id, $total));
        }
        $order->update([
            'price_total_net' => $total
        ]);

        \Log::info(sprintf('Total %s', $total));
    }
}
