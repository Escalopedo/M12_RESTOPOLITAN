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
            LocationSeeder::class,
            UsersTableSeeder::class,
            CuisineTypesTableSeeder::class,
            RestaurantsTableSeeder::class,
            SessionsTableSeeder::class,
            ReviewsTableSeeder::class,
            RestaurantCuisineTypesTableSeeder::class,
            MenusTableSeeder::class,              
            DishesTableSeeder::class,             
            DishCuisineTypesTableSeeder::class, 
        ]);
    }
}
