<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ReviewFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'restaurant_id' => $this->faker->numberBetween(1, 30), // ID de restaurante aleatorio (1 a 30)
            'user_id' => $this->faker->numberBetween(1, 10), // ID de usuario aleatorio (1 a 10)
            'rating' => $this->faker->numberBetween(1, 5), // Rating aleatorio entre 1 y 5
            'comment' => $this->faker->paragraph, // Comentario aleatorio
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}