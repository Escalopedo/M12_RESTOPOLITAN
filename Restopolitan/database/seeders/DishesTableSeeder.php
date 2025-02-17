<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DishesTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('dishes')->insert([
            ['menu_id' => 1, 'name' => 'Pasta a la Bolognesa', 'description' => 'Pasta con carne molida y salsa de tomate', 'price' => 12.99, 'created_at' => now(), 'updated_at' => now()],
            ['menu_id' => 2, 'name' => 'Ensalada César', 'description' => 'Ensalada fresca con pollo y aderezo César', 'price' => 9.99, 'created_at' => now(), 'updated_at' => now()],
            ['menu_id' => 3, 'name' => 'Rolls de Atún', 'description' => 'Rolls de sushi con atún fresco', 'price' => 15.99, 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
