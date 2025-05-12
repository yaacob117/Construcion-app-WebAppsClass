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

        if (empty($orderIds) || empty($productIds)) {
            // Si no hay órdenes o productos, la factory no puede crear una relación válida.
            // Retornar un array vacío significa que la llamada a ->create() no hará nada.
            // Esto es mejor que lanzar un error o crear datos inconsistentes.
            if (app()->runningInConsole()) {
                // Opcional: Informar en consola si se está ejecutando db:seed
                // $this->command->info('Skipping OrderProductFactory: No customer orders or products found.');
            }
            return []; 
        }

        $quantity = $this->faker->numberBetween(1, 10);
        $unit_price = $this->faker->randomFloat(2, 10, 500);

        return [
            'order_id' => $this->faker->randomElement($orderIds),
            'product_id' => $this->faker->randomElement($productIds),
            'quantity' => $quantity,
            'unit_price' => $unit_price,
            'total_price' => $quantity * $unit_price, // Calculado
        ];
    }
}