<?php

namespace Database\Seeders;

use App\Models\EnterpriseOrder;
use App\Enums\OrderStatus;
use Illuminate\Database\Seeder;

class EnterpriseOrderSeeder extends Seeder
{
    public function run(): void
    {
        EnterpriseOrder::insert([
            [
                'id' => 1,
                'order_number' => 'ORD-001',
                'supplier_name' => 'Supplier A',
                'supplier_contact' => '123-456-7890',
                'order_date' => now(),
                'delivery_address' => '123 Main St',
                'notes' => 'First enterprise order',
                'status' => OrderStatus::ORDERED,
                'total_amount' => 1500.00,
                'is_deleted' => false,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 2,
                'order_number' => 'ORD-002',
                'supplier_name' => 'Supplier B',
                'supplier_contact' => '987-654-3210',
                'order_date' => now(),
                'delivery_address' => '456 Secondary Ave',
                'notes' => 'Second enterprise order',
                'status' => OrderStatus::IN_PROCESS,
                'total_amount' => 2500.00,
                'is_deleted' => false,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);

        EnterpriseOrder::factory()->count(15)->create();
    }
}
