<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    public function run(): void
    {
        // Akun Admin Utama yang ditentukan langsung di database
        User::updateOrCreate(
            ['email' => 'admin@rentaljaya.com'], // Email Admin
            [
                'name' => 'Super Admin Rental Jaya',
                'password' => Hash::make('admin123'), // Password Admin
                'role' => 'admin',
            ]
        );
    }
}