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
                'city' => 'Barcelona',
                'street_address' => 'Avenida Diagonal, 200',
                'postal_code' => '08019'
            ],
            [
                'city' => 'Madrid',
                'street_address' => 'Paseo de la Castellana, 50',
                'postal_code' => '28046'
            ],
            [
                'city' => 'Madrid',
                'street_address' => 'Calle Alcalá, 300',
                'postal_code' => '28027'
            ],
            [
                'city' => 'Valencia',
                'street_address' => 'Avenida Blasco Ibáñez, 75',
                'postal_code' => '46001'
            ],
            [
                'city' => 'Valencia',
                'street_address' => 'Calle Colón, 30',
                'postal_code' => '46004'
            ],
            [
                'city' => 'Sevilla',
                'street_address' => 'Plaza de España, 2',
                'postal_code' => '41013'
            ],
            [
                'city' => 'Sevilla',
                'street_address' => 'Calle Sierpes, 45',
                'postal_code' => '41004'
            ],
            [
                'city' => 'Bilbao',
                'street_address' => 'Gran Vía Don Diego López de Haro, 55',
                'postal_code' => '48009'
            ],
            [
                'city' => 'Bilbao',
                'street_address' => 'Calle Licenciado Poza, 20',
                'postal_code' => '48011'
            ],
            [
                'city' => 'Málaga',
                'street_address' => 'Paseo del Parque, 15',
                'postal_code' => '29016'
            ],
            [
                'city' => 'Málaga',
                'street_address' => 'Calle Larios, 5',
                'postal_code' => '29005'
            ],
            [
                'city' => 'Zaragoza',
                'street_address' => 'Paseo Independencia, 45',
                'postal_code' => '50001'
            ],
            [
                'city' => 'Zaragoza',
                'street_address' => 'Avenida de Goya, 85',
                'postal_code' => '50006'
            ],
            [
                'city' => 'Granada',
                'street_address' => 'Plaza Nueva, 12',
                'postal_code' => '18010'
            ],
            [
                'city' => 'Granada',
                'street_address' => 'Calle Reyes Católicos, 40',
                'postal_code' => '18009'
            ],
            [
                'city' => 'Alicante',
                'street_address' => 'Explanada de España, 3',
                'postal_code' => '03002'
            ],
            [
                'city' => 'Alicante',
                'street_address' => 'Avenida Maisonnave, 20',
                'postal_code' => '03003'
            ],
            [
                'city' => 'San Sebastián',
                'street_address' => 'Boulevard Zumardia, 1',
                'postal_code' => '20003'
            ],
            [
                'city' => 'San Sebastián',
                'street_address' => 'Calle Mayor, 15',
                'postal_code' => '20005'
            ]
        ]);
    }
}