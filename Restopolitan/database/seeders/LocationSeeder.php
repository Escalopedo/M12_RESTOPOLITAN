<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LocationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        // Insertar datos en la tabla locations
        DB::table('locations')->insert([
            [
                'city' => 'Barcelona',
                'street_address' => 'Calle Gran Via, 100',
                'postal_code' => '08001'
            ],
            [
                'city' => 'Madrid',
                'street_address' => 'Paseo de la Castellana, 50',
                'postal_code' => '28046'
            ],
            [
                'city' => 'Valencia',
                'street_address' => 'Avenida Blasco Ibáñez, 75',
                'postal_code' => '46001'
            ],
            [
                'city' => 'Sevilla',
                'street_address' => 'Plaza de España, 2',
                'postal_code' => '41013'
            ],
            [
                'city' => 'Bilbao',
                'street_address' => 'Gran Vía Don Diego López de Haro, 55',
                'postal_code' => '48009'
            ]
        ]);
    }
}
