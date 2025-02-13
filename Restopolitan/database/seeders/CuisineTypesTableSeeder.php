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
        ]);
    }
}