<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Menambahkan akun Admin
        User::factory()->create([
            'name' => 'Admin',
            'email' => 'admin@example.com',
            'password' => Hash::make('admin123'), // Pastikan password di-hash
            'role' => 'admin', 
        ]);

        // Menambahkan akun Test User
        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => Hash::make('password123'), // Pastikan password di-hash
            'role' => 'customer', 
        ]);

        // Menambahkan akun Konselor
        User::factory()->create([
            'name' => 'konselor1',
            'password' => Hash::make('konselor123'), // Pastikan password di-hash
            'role' => 'konselor', 
        ]);
    }
}
