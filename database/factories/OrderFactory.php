<?php

namespace Database\Factories;

use App\Models\Order;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;
use JetBrains\PhpStorm\ArrayShape;

class OrderFactory extends Factory
{
    protected $model = Order::class;

    #[ArrayShape(['order_ref' => "int", 'date_received' => "string", 'date_sla' => "string", 'status' => "int", 'price_total_net' => "int"])]
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

    /**
     * Indicate that an order is shipped
     * @return Factory
     */
    public function shipped(): Factory
    {
        return $this->state(function (array $attributes) {
            return [
                'status' => Order::getIdForStatus('shipped')
            ];
        });
    }

    /**
     * Indicate that an order is ready
     * @return Factory
     */
    public function ready(): Factory
    {
        return $this->state(function (array $attributes) {
            return [
                'status' => Order::getIdForStatus('ready')
            ];
        });
    }

    /**
     * Indicate that an order is cancelled
     * @return Factory
     */
    public function cancelled(): Factory
    {
        return $this->state(function (array $attributes) {
            return [
                'status' => Order::getIdForStatus('cancelled')
            ];
        });
    }
}
