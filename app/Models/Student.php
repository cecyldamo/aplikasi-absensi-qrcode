<?php

// app/Models/Student.php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Attendance; // Pastikan ini ditambahkan

class Student extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'nis',
        'unique_code',
    ];

    public function attendances()
    {
        return $this->hasMany(Attendance::class);
    }
}

