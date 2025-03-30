<?php

namespace Database\Factories;

use App\Models\Customer;
use Illuminate\Database\Eloquent\Factories\Factory;

class CustomerFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Customer::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'customerNumber' => $this->faker->unique()->numerify('#####'),
            'name' => $this->faker->name,
            'companyName' => $this->faker->company,
            'fiscalData' => $this->faker->regexify('RFC: [A-Z]{3}[0-9]{9}'),
            'address' => $this->faker->address,
        ];
    }
}
