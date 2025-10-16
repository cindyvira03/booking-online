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
        User::create([
            'name' => 'Admin',
            'email' => 'admin@booking.com',
            'phone_number' => '081234567890',
            'password' => bcrypt('password'),
            'role' => 'admin',
        ]);

        $this->call([
            BookingSeeder::class,
        ]);
    }
}
