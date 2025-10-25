<?php

// database/seeders/StudentSeeder.php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Student;
use Illuminate\Support\Str;

class StudentSeeder extends Seeder
{
    public function run()
    {
        $students = [
            ['name' => 'Budi Santoso', 'nis' => '1001'],
            ['name' => 'Citra Lestari', 'nis' => '1002'],
            ['name' => 'Dewi Anggraini', 'nis' => '1003'],
            ['name' => 'Eko Prasetyo', 'nis' => '1004'],
            ['name' => 'Fitriani', 'nis' => '1005'],
        ];

        foreach ($students as $student) {
            Student::create([
                'name' => $student['name'],
                'nis' => $student['nis'],
                'unique_code' => Str::random(10) // Generate kode unik random
            ]);
        }
    }
}