<?php

// app/Http/Controllers/StudentController.php
namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function showQrCodes()
    {
        $students = Student::all();
        return view('students.qrcodes', compact('students'));
    }
}