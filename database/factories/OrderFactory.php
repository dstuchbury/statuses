<?php

namespace Database\Factories;

use App\Models\Order;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

class OrderFactory extends Factory
{
    protected $model = Order::class;

    public function definition(): array
    {
        return [
            'order_ref' => $this->faker->numberBetween(1000, 10000),
            'date_received' => Carbon::now()->toDateString(),
            'date_sla' => Carbon::now()->addDays(3)->toDateString(),
            'status' => $this->faker->numberBetween(1, 18),
            'price_total_net' => $this->faker->numberBetween(100, 200000),
        ];
    }
}
