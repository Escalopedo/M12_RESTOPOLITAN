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
                'user_id' => 3, // Regular User
                'rating' => 5,
                'comment' => '¡Excelente comida y servicio!',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'restaurant_id' => 2,
                'user_id' => 3, // Regular User
                'rating' => 4,
                'comment' => 'Muy buena experiencia, pero un poco caro.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}