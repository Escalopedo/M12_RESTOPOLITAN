<?php 

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('users')->insert([
            // Admin
            [
                'name' => 'Admin User',
                'email' => 'admin@gmail.com',
                'password' => Hash::make('password'),
                'role_id' => 1, // Admin
                'email_verified_at' => now(),
                'created_at' => now(),
                'updated_at' => now(),
            ],

            // Usuario regular
            [
                'name' => 'Regular User',
                'email' => 'user@gmail.com',
                'password' => Hash::make('password'),
                'role_id' => 3, // Usuario normal
                'email_verified_at' => now(),
                'created_at' => now(),
                'updated_at' => now(),
            ],

            // Gerentes (1 por restaurante, desde ID 3 hasta ID 17)
            [
                'name' => 'Gerente Trattoria Roma',
                'email' => 'gerente1@gmail.com',
                'password' => Hash::make('password'),
                'role_id' => 2,
                'email_verified_at' => now(),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Gerente El Mariachi',
                'email' => 'gerente2@gmail.com',
                'password' => Hash::make('password'),
                'role_id' => 2,
                'email_verified_at' => now(),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Gerente Sakura Sushi',
                'email' => 'gerente3@gmail.com',
                'password' => Hash::make('password'),
                'role_id' => 2,
                'email_verified_at' => now(),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Gerente Gran Muralla',
                'email' => 'gerente4@gmail.com',
                'password' => Hash::make('password'),
                'role_id' => 2,
                'email_verified_at' => now(),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Gerente Mediterráneo Grill',
                'email' => 'gerente5@gmail.com',
                'password' => Hash::make('password'),
                'role_id' => 2,
                'email_verified_at' => now(),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Gerente Curry House',
                'email' => 'gerente6@gmail.com',
                'password' => Hash::make('password'),
                'role_id' => 2,
                'email_verified_at' => now(),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Gerente Le Petit Bistro',
                'email' => 'gerente7@gmail.com',
                'password' => Hash::make('password'),
                'role_id' => 2,
                'email_verified_at' => now(),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Gerente Texas BBQ',
                'email' => 'gerente8@gmail.com',
                'password' => Hash::make('password'),
                'role_id' => 2,
                'email_verified_at' => now(),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Gerente Green Veggie',
                'email' => 'gerente9@gmail.com',
                'password' => Hash::make('password'),
                'role_id' => 2,
                'email_verified_at' => now(),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Gerente Vegan Bliss',
                'email' => 'gerente10@gmail.com',
                'password' => Hash::make('password'),
                'role_id' => 2,
                'email_verified_at' => now(),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Gerente Bangkok Street',
                'email' => 'gerente11@gmail.com',
                'password' => Hash::make('password'),
                'role_id' => 2,
                'email_verified_at' => now(),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Gerente Seoul Kitchen',
                'email' => 'gerente12@gmail.com',
                'password' => Hash::make('password'),
                'role_id' => 2,
                'email_verified_at' => now(),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Gerente Alhambra Delights',
                'email' => 'gerente13@gmail.com',
                'password' => Hash::make('password'),
                'role_id' => 2,
                'email_verified_at' => now(),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Gerente La Taberna Española',
                'email' => 'gerente14@gmail.com',
                'password' => Hash::make('password'),
                'role_id' => 2,
                'email_verified_at' => now(),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Gerente Santorini Taverna',
                'email' => 'gerente15@gmail.com',
                'password' => Hash::make('password'),
                'role_id' => 2,
                'email_verified_at' => now(),
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}