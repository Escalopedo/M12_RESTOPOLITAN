<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RestaurantCuisineTypesTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('restaurant_cuisine_types')->insert([
            ['restaurant_id' => 1, 'cuisine_type_id' => 1], // Trattoria Roma - Italiana
            ['restaurant_id' => 2, 'cuisine_type_id' => 2], // El Mariachi - Mexicana
            ['restaurant_id' => 3, 'cuisine_type_id' => 3], // Sakura Sushi - Japonesa
            ['restaurant_id' => 4, 'cuisine_type_id' => 4], // Gran Muralla - China
            ['restaurant_id' => 5, 'cuisine_type_id' => 5], // Mediterráneo Grill - Mediterránea
            ['restaurant_id' => 1, 'cuisine_type_id' => 5],  // Trattoria Roma - También Mediterránea
            ['restaurant_id' => 5, 'cuisine_type_id' => 4], // Mediterráneo Grill - También China
        ]);
    }
}