<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\OrderProduct;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\OrderProduct>
 */
class OrderProductFactory extends Factory
{
    protected $model = OrderProduct::class;
    public function definition(): array
    {
        return [
            'order_id' =>  $this->faker->numberBetween(1, 10),
            'product_id' =>  $this->faker->numberBetween(1, 10),
            'quantity' =>  $this->faker->numberBetween(1, 10),
            'unit_price' =>  $this->faker->numberBetween(1, 1000),
            'total_price' =>  $this->faker->numberBetween(1, 10000),
        ];
    }
}
