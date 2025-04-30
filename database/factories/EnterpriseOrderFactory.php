<?php

namespace Database\Factories;

use App\Models\EnterpriseOrder;
use App\Enums\OrderStatus;
use Illuminate\Database\Eloquent\Factories\Factory;

class EnterpriseOrderFactory extends Factory
{
    protected $model = EnterpriseOrder::class;

    public function definition()
    {
        return [
            'order_number' => $this->faker->unique()->numerify('ORD-#####'),
            'supplier_name' => $this->faker->company,
            'supplier_contact' => $this->faker->phoneNumber,
            'order_date' => $this->faker->date(),
            'delivery_address' => $this->faker->address,
            'notes' => $this->faker->optional()->sentence(),
            'status' => $this->faker->randomElement(OrderStatus::cases())->value,
            'total_amount' => $this->faker->randomFloat(2, 100, 10000),
            'is_deleted' => false,
        ];
    }
}
