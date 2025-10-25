<?php

// database/seeders/UserSeeder.php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run()
    {
        User::create([
            'name' => 'Guru Admin',
            'email' => 'guru@sekolah.com',
            'password' => Hash::make('password'), // passwordnya: password
        ]);
    }
}