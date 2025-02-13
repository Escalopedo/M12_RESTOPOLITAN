<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CuisineTypesTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('cuisine_types')->insert([
            ['name' => 'Italiana', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Mexicana', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Japonesa', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'China', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Mediterránea', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'India', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Francesa', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Americana', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Vegetariana', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Vegana', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Tailandesa', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Coreana', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Árabe', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Española', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Griega', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}