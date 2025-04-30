<?php

namespace Database\Seeders;

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
        
        // Verificar si hay IDs disponibles
        if (empty($orderIds) || empty($productIds)) {
            return;
        }
        
        $orderId1 = $orderIds[0] ?? 2;
        $orderId2 = $orderIds[1] ?? $orderId1;
        $productId1 = $productIds[0] ?? 1;
        $productId2 = $productIds[1] ?? $productId1;
        
        $data = [
            [
                'order_id' => $orderId1,
                'product_id' => $productId1,
                'quantity' => 5,
                'unit_price' => 500,
                'total_price' => 2500,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'order_id' => $orderId1, 
                'product_id' => $productId2,
                'quantity' => 3,
                'unit_price' => 750,
                'total_price' => 2250,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'order_id' => $orderId2,
                'product_id' => $productId1,
                'quantity' => 2,
                'unit_price' => 500,
                'total_price' => 1000,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'order_id' => $orderId2,
                'product_id' => $productId2,
                'quantity' => 4,
                'unit_price' => 750,
                'total_price' => 3000,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];
        
        DB::table('order_products')->insert($data);
    }
}