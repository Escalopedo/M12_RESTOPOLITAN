<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            RolesTableSeeder::class,
            UsersTableSeeder::class,
            CuisineTypesTableSeeder::class,
            RestaurantsTableSeeder::class, 
            RestaurantCuisineTypesTableSeeder::class,
            ReviewsTableSeeder::class,
            SessionsTableSeeder::class,
        ]);
    }
}