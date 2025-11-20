<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Create Admin User
        User::create([
            'name' => 'Fadly',
            'email' => 'admin@kantin.com',
            'password' => Hash::make('FadlyGanteng'),
            'role' => 'admin',
        ]);

        // Create Kasir User
        User::create([
            'name' => 'Emira',
            'email' => 'kasir@kantin.com',
            'password' => Hash::make('EmiraCantik'),
            'role' => 'kasir',
        ]);
    }
}
