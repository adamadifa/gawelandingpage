<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Admin
        \App\Models\User::create([
            'name' => 'Admin PresensiGPS',
            'email' => 'admin@presensigps.com',
            'password' => \Illuminate\Support\Facades\Hash::make('password'),
            'role' => 'admin',
        ]);

        // Sample Member
        \App\Models\User::create([
            'name' => 'John Doe Member',
            'email' => 'member@presensigps.com',
            'password' => \Illuminate\Support\Facades\Hash::make('password'),
            'role' => 'member',
        ]);
    }
}
