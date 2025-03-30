<?php

namespace Database\Factories;

use App\Models\OrderProduct;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\DB;

class OrderProductFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = OrderProduct::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $orderIds = DB::table('customer_orders')->pluck('id')->toArray();
        $productIds = DB::table('products')->pluck('id')->toArray();
        
        $orderId = !empty($orderIds) ? $this->faker->randomElement($orderIds) : 2;
        $productId = !empty($productIds) ? $this->faker->randomElement($productIds) : 1;
        
        $quantity = $this->faker->numberBetween(1, 10);
        $unitPrice = $this->faker->numberBetween(100, 1000);
        
        return [
            'order_id' => $orderId,
            'product_id' => $productId,
            'quantity' => $quantity,
            'unit_price' => $unitPrice,
            'total_price' => $quantity * $unitPrice,
        ];
    }
}