<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        // buat 1 user admin
        User::factory()->create([
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('admin123'),
            'role' => 'admin',
            'email_verified_at' => now(),
            'phone' => '0123456789',
            'address' => 'Jakarta',
        ]);
        
        

        // buat 10 user biasa
        
        // for ($i=0; $i < 20; $i++) { 
        //     User::factory()->create([
        //         'role' => 'user',
        //         'phone' => fake()->numerify('085############'),
        //         'address' => fake()->address(),
        //     ]);
        // }
    }
}
