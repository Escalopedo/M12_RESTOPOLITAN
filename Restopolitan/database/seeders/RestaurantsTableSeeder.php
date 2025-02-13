<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RestaurantsTableSeeder extends Seeder
{
    public function run()
    {
        // Inserta los restaurantes con referencias directas a los IDs de las ubicaciones
        DB::table('restaurants')->insert([
            [
                'name' => 'Restaurante Italiano',
                'description' => 'Un restaurante con auténtica comida italiana.',
                'average_price' => 25.50,
                'photo' => 'italiano.jpg',
                'gerente_id' => 2, // Gerente User
                'rating' => 4.5,
                'location_id' => 1, 
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Restaurante Mexicano',
                'description' => 'Sabores tradicionales de México.',
                'average_price' => 20.00,
                'photo' => 'mexicano.jpg',
                'gerente_id' => 2, // Gerente User
                'rating' => 4.0,
                'location_id' => 2, 
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}