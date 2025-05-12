<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\CustomerOrder;
use App\Models\Customer;
use Illuminate\Support\Facades\DB;

class CustomerOrderFactory extends Factory
{
    protected $model = CustomerOrder::class;

    public function definition(): array
    {
        // Obtener customerNumber de clientes existentes
        $customerNumbers = Customer::pluck('customerNumber')->toArray();
        
        // Seleccionar un customerNumber aleatorio o un valor por defecto si no hay clientes
        $selectedCustomerNumber = !empty($customerNumbers) ? $this->faker->randomElement($customerNumbers) : 'FALLBACK_CUST_NUM';

        // Obtener el nombre del cliente basado en el customer_number seleccionado
        $customerName = '';
        if ($selectedCustomerNumber !== 'FALLBACK_CUST_NUM') {
            $customer = Customer::where('customerNumber', $selectedCustomerNumber)->first();
            $customerName = $customer ? $customer->name : $this->faker->name;
        } else {
            $customerName = $this->faker->name; // Nombre aleatorio si es fallback
        }

        return [
            'invoice_number' => $this->faker->unique()->numerify('INV-#####'),
            'customer_number' => $selectedCustomerNumber,
            'customer_name' => $customerName,
            'fiscal_data' => $this->faker->regexify('RFC: [A-Z]{3}[0-9]{9}'),
            'order_date' => $this->faker->dateTimeBetween('-1 year', 'now'),
            'delivery_address' => $this->faker->address,
            'notes' => $this->faker->sentence,
            'status' => $this->faker->randomElement(['ORDERED', 'IN_PROCESS', 'IN_ROUTE', 'DELIVERED']),
            'total_amount' => $this->faker->randomFloat(2, 100, 10000),
            'is_deleted' => false,
        ];
    }
}
