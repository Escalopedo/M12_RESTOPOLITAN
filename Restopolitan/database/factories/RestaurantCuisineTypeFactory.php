<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class RestaurantCuisineTypeFactory extends Factory
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
            'cuisine_type_id' => $this->faker->numberBetween(1, 5), // ID de tipo de cocina aleatorio (1 a 5)
        ];
    }
}