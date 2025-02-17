<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MenusTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('menus')->insert([
            ['restaurant_id' => 1, 'name' => 'Menú de Almuerzo', 'created_at' => now(), 'updated_at' => now()],
            ['restaurant_id' => 2, 'name' => 'Menú Especial', 'created_at' => now(), 'updated_at' => now()],
            ['restaurant_id' => 3, 'name' => 'Sushi Degustación', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
