<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ReviewsTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('reviews')->insert([
            [
                'restaurant_id' => 1,
                'user_id' => 2, // Regular User
                'rating' => 5,
                'comment' => '¡Excelente comida y servicio! La pasta es increíble.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'restaurant_id' => 2,
                'user_id' => 2,
                'rating' => 4,
                'comment' => 'Muy buena experiencia, pero un poco caro.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'restaurant_id' => 3,
                'user_id' => 2,
                'rating' => 5,
                'comment' => 'El sushi más fresco que he probado. Volveré pronto.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'restaurant_id' => 4,
                'user_id' => 2,
                'rating' => 3,
                'comment' => 'Los platos estaban bien, pero el servicio fue un poco lento.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'restaurant_id' => 5,
                'user_id' => 2,
                'rating' => 4,
                'comment' => 'Sabores frescos y mediterráneos, pero me gustaría más variedad en el menú.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'restaurant_id' => 6,
                'user_id' => 2,
                'rating' => 5,
                'comment' => 'La mejor comida india que he probado, especias perfectas.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'restaurant_id' => 7,
                'user_id' => 2,
                'rating' => 4,
                'comment' => 'Muy elegante, aunque un poco caro. Postres espectaculares.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'restaurant_id' => 8,
                'user_id' => 2,
                'rating' => 5,
                'comment' => 'Las hamburguesas y costillas son brutales, muy recomendado.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'restaurant_id' => 9,
                'user_id' => 2,
                'rating' => 5,
                'comment' => 'Me encanta que todo sea vegetariano y tan sabroso. Opciones muy creativas.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'restaurant_id' => 10,
                'user_id' => 2,
                'rating' => 4,
                'comment' => 'Un gran lugar vegano, aunque podrían mejorar los postres.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'restaurant_id' => 11,
                'user_id' => 2,
                'rating' => 5,
                'comment' => 'Comida tailandesa auténtica, el pad thai es delicioso.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'restaurant_id' => 12,
                'user_id' => 2,
                'rating' => 4,
                'comment' => 'Buen kimchi y excelente BBQ coreano. Un poco lleno el local.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'restaurant_id' => 13,
                'user_id' => 2,
                'rating' => 5,
                'comment' => 'Platos árabes exquisitos, recomiendo el hummus y el falafel.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'restaurant_id' => 14,
                'user_id' => 2,
                'rating' => 4,
                'comment' => 'Tapas españolas muy bien preparadas, aunque un poco caro.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'restaurant_id' => 15,
                'user_id' => 2,
                'rating' => 5,
                'comment' => 'Comida griega increíble, los gyros y la moussaka están de 10.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}