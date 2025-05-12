<?php

namespace Database\Seeders;

use App\Models\OrderProduct;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use function now;

class OrderProductsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $orderIds = DB::table('customer_orders')->pluck('id')->toArray();
        $productIds = DB::table('products')->pluck('id')->toArray();
        
        if (empty($orderIds) || empty($productIds)) {
            // Si no hay órdenes o productos, no se pueden crear relaciones específicas ni por factory
            // Puedes añadir un mensaje aquí si lo deseas, o simplemente retornar.
            if (app()->runningInConsole()) {
                $this->command->info('Skipping OrderProductsSeeder: No customer orders or products found to create relations.');
            }
            return;
        }
        
        $orderId1 = $orderIds[0] ?? null; 
        $orderId2 = $orderIds[1] ?? $orderId1;
        $productId1 = $productIds[0] ?? null;
        $productId2 = $productIds[1] ?? $productId1;
        
        $data = [];
        // Solo intentar insertar datos específicos si los IDs necesarios existen
        if ($orderId1 && $productId1) {
            $data[] = [
                'order_id' => $orderId1,
                'product_id' => $productId1,
                'quantity' => 5,
                'unit_price' => 500,
                'total_price' => 2500,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        if ($orderId1 && $productId2) {
            $data[] = [
                'order_id' => $orderId1, 
                'product_id' => $productId2,
                'quantity' => 3,
                'unit_price' => 750,
                'total_price' => 2250,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        if ($orderId2 && $productId1) {
            $data[] = [
                'order_id' => $orderId2,
                'product_id' => $productId1,
                'quantity' => 2,
                'unit_price' => 500,
                'total_price' => 1000,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        if ($orderId2 && $productId2) {
            $data[] = [
                'order_id' => $orderId2,
                'product_id' => $productId2,
                'quantity' => 4,
                'unit_price' => 750,
                'total_price' => 3000,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        
        if (!empty($data)) {
            DB::table('order_products')->insert($data);
        }

        // Crear datos adicionales usando la factory
        // La factory se encargará de verificar si hay orderIds y productIds disponibles
        OrderProduct::factory()->count(30)->create();
    }
}