<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use function now;

class CustomerOrdersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('customer_orders')->insert([
            [
                'id' => 1,
                'invoice_number' => 'INV-001',
                'customer_number' => '12345',
                'customer_name' => 'John Doe',
                'fiscal_data' => 'RFC: ABC123456789',
                'order_date' => now(),
                'delivery_address' => '123 Main St',
                'notes' => 'First order',
                'status' => 'ORDERED',
                'total_amount' => 1500.00,
                'is_deleted' => false,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 2,
                'invoice_number' => 'INV-002',
                'customer_number' => '67890',
                'customer_name' => 'Jane Smith',
                'fiscal_data' => 'RFC: DEF987654321',
                'order_date' => now(),
                'delivery_address' => '456 Secondary Ave',
                'notes' => 'Second order',
                'status' => 'IN_PROCESS',
                'total_amount' => 2500.00,
                'is_deleted' => false,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}