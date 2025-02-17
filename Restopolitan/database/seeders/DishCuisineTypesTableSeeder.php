<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DishCuisineTypesTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('dish_cuisine_types')->insert([
            ['dish_id' => 1, 'cuisine_type_id' => 1], // Pasta - Cocina Italiana
            ['dish_id' => 2, 'cuisine_type_id' => 2], // Ensalada - Cocina Mediterránea
            ['dish_id' => 3, 'cuisine_type_id' => 3], // Roll de Atún - Cocina Japonesa
        ]);
    }
}
