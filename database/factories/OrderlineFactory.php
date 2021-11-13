<?php

namespace Database\Factories;

use App\Models\Orderline;
use Illuminate\Database\Eloquent\Factories\Factory;

class OrderlineFactory extends Factory
{
    protected $model = Orderline::class;

    public function definition(): array {
        $quantity = $this->faker->numberBetween(1, 250);
        $price_unit = $this->faker->numberBetween(10, 20000);

        return [
            'order_id' => 1,
            'quantity' => $quantity,
            'price_unit' => $price_unit,
            'status' => $this->faker->numberBetween(1, 10),
            'price_total' => $price_unit * $quantity,
        ];
    }
}
