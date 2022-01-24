<?php

namespace Database\Factories;

use App\Models\Orderline;
use Illuminate\Database\Eloquent\Factories\Factory;
use JetBrains\PhpStorm\ArrayShape;

class OrderlineFactory extends Factory
{
    protected $model = Orderline::class;

    #[ArrayShape(['order_id' => "int", 'orderline_ref' => "int", 'quantity' => "int", 'price_unit' => "int", 'status' => "int", 'price_total' => "float|int", 'barcode' => "string"])]
    public function definition(): array
    {
        $quantity = $this->faker->numberBetween(1, 250);
        $price_unit = $this->faker->numberBetween(10, 20000);

        return [
            'order_id' => 1,
            'orderline_ref' => $this->faker->numberBetween(100, 10000),
            'quantity' => $quantity,
            'price_unit' => $price_unit,
            'status' => $this->faker->numberBetween(1, 10),
            'price_total' => $price_unit * $quantity,
            'barcode' => $this->faker->ean13(),
        ];
    }
}
