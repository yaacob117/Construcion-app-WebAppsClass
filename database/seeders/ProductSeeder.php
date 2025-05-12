<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Product::insert([
            [
                'id' => 1,
                'product_id' => 'PROD-001',
                'name' => 'Product A',
                'description' => 'Description for Product A',
                'price' => 100.00,
                'supplier' => 'Supplier A',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 2,
                'product_id' => 'PROD-002',
                'name' => 'Product B',
                'description' => 'Description for Product B',
                'price' => 200.00,
                'supplier' => 'Supplier B',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 3,
                'product_id' => 'PROD-003',
                'name' => 'Product C',
                'description' => 'Description for Product C',
                'price' => 300.00,
                'supplier' => 'Supplier C',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);

        // Poblar con datos adicionales usando la factory
        Product::factory()->count(10)->create(); // Crea 10 productos adicionales
    }
}
