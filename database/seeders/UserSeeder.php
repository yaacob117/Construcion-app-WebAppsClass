<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        DB::table('users')->insert([
            [
                'username' => 'admin',
                'name' => 'Administrator',
                'email' => 'admin@example.com',
                'password' => Hash::make('password'),
                'role_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'username' => 'sales_user',
                'name' => 'Sales User',
                'email' => 'sales@example.com',
                'password' => Hash::make('password'),
                'role_id' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'username' => 'purchasing_user',
                'name' => 'Purchasing User',
                'email' => 'purchasing@example.com',
                'password' => Hash::make('password'),
                'role_id' => 3,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'username' => 'warehouse_user',
                'name' => 'Warehouse User',
                'email' => 'warehouse@example.com',
                'password' => Hash::make('password'),
                'role_id' => 4,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'username' => 'routes_user',
                'name' => 'Routes User',
                'email' => 'routes@example.com',
                'password' => Hash::make('password'),
                'role_id' => 5,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
