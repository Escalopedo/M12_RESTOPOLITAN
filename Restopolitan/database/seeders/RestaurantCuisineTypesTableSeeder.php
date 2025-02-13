<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RestaurantCuisineTypesTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('restaurant_cuisine_types')->insert([
            ['restaurant_id' => 1, 'cuisine_type_id' => 1], 
            ['restaurant_id' => 2, 'cuisine_type_id' => 2], 
        ]);
    }
}