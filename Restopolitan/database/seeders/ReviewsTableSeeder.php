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
        ]);
    }
}