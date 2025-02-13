<?php 

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RestaurantsTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('restaurants')->insert([
            [
                'id' => 1,
                'name' => 'Trattoria Roma',
                'description' => 'Un restaurante con auténtica comida italiana.',
                'average_price' => 25.50,
                'photo' => 'italiana.jpg',
                'gerente_id' => 3, // Gerente correspondiente
                'location_id' => 1, 
                'rating' => 4.5,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 2,
                'name' => 'El Mariachi',
                'description' => 'Sabores tradicionales de México con mariachi en vivo.',
                'average_price' => 20.00,
                'photo' => 'mexicana.jpg',
                'gerente_id' => 4,
                'location_id' => 2, 
                'rating' => 4.0,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 3,
                'name' => 'Sakura Sushi',
                'description' => 'Exquisita gastronomía japonesa con sushi y ramen.',
                'average_price' => 30.00,
                'photo' => 'japonesa.jpg',
                'gerente_id' => 5,
                'location_id' => 3, 
                'rating' => 4.8,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 4,
                'name' => 'Gran Muralla',
                'description' => 'Delicias de la cocina china en un ambiente tradicional.',
                'average_price' => 18.00,
                'photo' => 'china.jpg',
                'gerente_id' => 6,
                'location_id' => 4, 
                'rating' => 4.3,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 5,
                'name' => 'Mediterráneo Grill',
                'description' => 'Sabores frescos del mar y la tierra con un toque moderno.',
                'average_price' => 28.00,
                'photo' => 'mediterranea.jpg',
                'gerente_id' => 7,
                'location_id' => 5, 
                'rating' => 4.6,
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);
    }
}