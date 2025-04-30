<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\CustomerOrder;
use App\Models\Customer;

class CustomerOrderFactory extends Factory
{
    protected $model = CustomerOrder::class;

    public function definition(): array
    {
        return [
            'invoice_number' => $this->faker->unique()->numerify('INV-#####'),
            'customer_number' => $this->faker->numerify('#####'),
            'customer_name' => $this->faker->name,
            'fiscal_data' => $this->faker->regexify('RFC: [A-Z]{3}[0-9]{9}'),
            'order_date' => $this->faker->dateTimeBetween('-1 year', 'now'),
            'delivery_address' => $this->faker->address,
            'notes' => $this->faker->sentence,
            'status' => $this->faker->randomElement(['Pending', 'Completed', 'Cancelled']),
            'total_amount' => $this->faker->randomFloat(2, 100, 10000),
            'is_deleted' => false,
        ];
    }
}
