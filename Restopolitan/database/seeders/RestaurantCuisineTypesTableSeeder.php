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

            ['restaurant_id' => 6, 'cuisine_type_id' => 6], // Curry House - India

            ['restaurant_id' => 7, 'cuisine_type_id' => 7], // Le Petit Bistro - Francesa

            ['restaurant_id' => 8, 'cuisine_type_id' => 8], // Texas BBQ - Americana

            ['restaurant_id' => 9, 'cuisine_type_id' => 9], // Green Veggie - Vegetariana

            ['restaurant_id' => 10, 'cuisine_type_id' => 10], // Vegan Bliss - Vegana

            ['restaurant_id' => 11, 'cuisine_type_id' => 11], // Bangkok Street - Tailandesa

            ['restaurant_id' => 12, 'cuisine_type_id' => 12], // Seoul Kitchen - Coreana

            ['restaurant_id' => 13, 'cuisine_type_id' => 13], // Alhambra Delights - Árabe

            ['restaurant_id' => 14, 'cuisine_type_id' => 14], // La Taberna Española - Española

            ['restaurant_id' => 15, 'cuisine_type_id' => 15], // Santorini Taverna - Griega

            ['restaurant_id' => 1, 'cuisine_type_id' => 5],  // Trattoria Roma - También Mediterránea
            ['restaurant_id' => 5, 'cuisine_type_id' => 14], // Mediterráneo Grill - También Española
            ['restaurant_id' => 9, 'cuisine_type_id' => 10], // Green Veggie - También Vegana
            ['restaurant_id' => 11, 'cuisine_type_id' => 4], // Bangkok Street - También China
        ]);
    }
}