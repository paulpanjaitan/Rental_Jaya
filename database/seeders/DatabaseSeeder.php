<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User; 
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    
    public function run(): void
    {
     User::updateOrCreate(
        ['email' => 'owner@rentaljaya.com'],
        [
            'name' => 'Owner Rental Jaya',
            'password' => Hash::make('owner123'),
            'role' => 'owner'
        ]
    );

    User::updateOrCreate(
        ['email' => 'admin@rentaljaya.com'],
        [
            'name' => 'Admin Rental Jaya',
            'password' => Hash::make('admin123'),
            'role' => 'admin'
        ]
    );
    }
}
