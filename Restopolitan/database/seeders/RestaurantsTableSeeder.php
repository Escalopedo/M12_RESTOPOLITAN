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
                'name' => 'Trattoria Roma',
                'description' => 'Un restaurante con auténtica comida italiana.',
                'average_price' => 25.50,
                'photo' => 'italiana.jpg',
                'gerente_id' => 3,
                'rating' => 4.5,
                'cuisine_type_id' => 1, // Italiana
                'location_id' => 1, 
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'El Mariachi',
                'description' => 'Sabores tradicionales de México con mariachi en vivo.',
                'average_price' => 20.00,
                'photo' => 'mexicana.jpg',
                'gerente_id' => 4,
                'rating' => 4.0,
                'cuisine_type_id' => 2, // Mexicana
                'location_id' => 2, 
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Sakura Sushi',
                'description' => 'Exquisita gastronomía japonesa con sushi y ramen.',
                'average_price' => 30.00,
                'photo' => 'japonesa.jpg',
                'gerente_id' => 5,
                'rating' => 4.8,
                'cuisine_type_id' => 3, // Japonesa
                'location_id' => 3, 
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Gran Muralla',
                'description' => 'Delicias de la cocina china en un ambiente tradicional.',
                'average_price' => 18.00,
                'photo' => 'china.jpg',
                'gerente_id' => 6,
                'rating' => 4.3,
                'cuisine_type_id' => 4, // China
                'location_id' => 4, 
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Mediterráneo Grill',
                'description' => 'Sabores frescos del mar y la tierra con un toque moderno.',
                'average_price' => 28.00,
                'photo' => 'mediterranea.jpg',
                'gerente_id' => 7,
                'rating' => 4.6,
                'cuisine_type_id' => 5, // Mediterránea
                'location_id' => 5, 
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Curry House',
                'description' => 'Auténtica cocina india con especias exóticas.',
                'average_price' => 22.50,
                'photo' => 'india.jpg',
                'gerente_id' => 8,
                'rating' => 4.2,
                'cuisine_type_id' => 6, // India
                'location_id' => 6, 
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Le Petit Bistro',
                'description' => 'Cocina francesa con los mejores ingredientes y recetas clásicas.',
                'average_price' => 35.00,
                'photo' => 'francesa.jpg',
                'gerente_id' => 9,
                'rating' => 4.9,
                'cuisine_type_id' => 7, // Francesa
                'location_id' => 7, 
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Texas BBQ',
                'description' => 'Carnes ahumadas y hamburguesas al estilo americano.',
                'average_price' => 27.00,
                'photo' => 'americana.jpg',
                'gerente_id' => 10,
                'rating' => 4.4,
                'cuisine_type_id' => 8, // Americana
                'location_id' => 8, 
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Green Veggie',
                'description' => 'Menú 100% vegetariano con ingredientes frescos y orgánicos.',
                'average_price' => 20.00,
                'photo' => 'vegetariana.jpg',
                'gerente_id' => 11,
                'rating' => 4.7,
                'cuisine_type_id' => 9, // Vegetariana
                'location_id' => 9, 
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Vegan Bliss',
                'description' => 'Deliciosos platos veganos sin perder el sabor.',
                'average_price' => 22.00,
                'photo' => 'vegana.jpg',
                'gerente_id' => 12,
                'rating' => 4.8,
                'cuisine_type_id' => 10, // Vegana
                'location_id' => 10, 
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Bangkok Street',
                'description' => 'Cocina tailandesa auténtica con sabores intensos.',
                'average_price' => 26.00,
                'photo' => 'tailandesa.jpg',
                'gerente_id' => 13,
                'rating' => 4.5,
                'cuisine_type_id' => 11, // Tailandesa
                'location_id' => 11, 
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Seoul Kitchen',
                'description' => 'Gastronomía coreana con BBQ y kimchi.',
                'average_price' => 23.00,
                'photo' => 'coreana.jpg',
                'gerente_id' => 14,
                'rating' => 4.6,
                'cuisine_type_id' => 12, // Coreana
                'location_id' => 12, 
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Alhambra Delights',
                'description' => 'Sabores auténticos de la cocina árabe y mediterránea.',
                'average_price' => 24.00,
                'photo' => 'arabe.jpg',
                'gerente_id' => 15,
                'rating' => 4.7,
                'cuisine_type_id' => 13, // Árabe
                'location_id' => 13, 
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'La Taberna Española',
                'description' => 'Tapas y comida española con ingredientes frescos.',
                'average_price' => 21.00,
                'photo' => 'espanola.jpg',
                'gerente_id' => 16,
                'rating' => 4.6,
                'cuisine_type_id' => 14, // Española
                'location_id' => 14, 
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Santorini Taverna',
                'description' => 'Especialidades de la cocina griega con los mejores ingredientes.',
                'average_price' => 23.50,
                'photo' => 'griega.jpg',
                'gerente_id' => 17,
                'rating' => 4.8,
                'cuisine_type_id' => 15, // Griega
                'location_id' => 15, 
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);
    }
}