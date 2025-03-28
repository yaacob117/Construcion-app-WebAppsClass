<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('roles')->insert([
            [
                'id' => 1,
                'name' => 'Administrator',
                'description' => 'Rol with all permissions',
            ],
            [
                'id' => 2,
                'name' => 'Sales',
                'description' => 'Rol for the sales team',
            ],
            [
                'id' => 3,
                'name' => 'Purchasing',
                'description' => 'Rol for the purchasing team',
            ],
            [
                'id' => 4,
                'name' => 'Warehouse',
                'description' => 'Rol for the warehouse team',
            ],
            [
                'id' => 5,
                'name' => 'Routes',
                'description' => 'Rol for the routes team',
            ],
        ]);
    }
}