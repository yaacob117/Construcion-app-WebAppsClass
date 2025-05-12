<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Customer;

class CustomersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('customers')->insert([
            [
                'customerNumber' => '12345',
                'name' => 'Juan Pérez',
                'companyName' => 'My company S.A.',
                'fiscalData' => 'RFC: MEP123456789',
                'address' => 'Main street #123',
            ],
            [
                'customerNumber' => '67890',
                'name' => 'María García',
                'companyName' => 'Other Inc.',
                'fiscalData' => 'RFC: OTR987654321',
                'address' => 'Avenue #456',
            ],
        ]);

        Customer::factory()->count(10)->create();
    }
}