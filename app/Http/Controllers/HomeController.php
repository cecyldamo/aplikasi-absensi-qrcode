<?php

// app/Http/Controllers/HomeController.php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;
use App\Models\Attendance;
use Carbon\Carbon;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $today = Carbon::today();

        // Ambil ID siswa yang sudah absen hari ini
        $presentStudentIds = Attendance::whereDate('date', $today)
                                        ->pluck('student_id');

        // Ambil data siswa yang sudah hadir
        $presentStudents = Attendance::with('student')
                                     ->whereDate('date', $today)
                                     ->get();

        // Ambil data siswa yang belum hadir
        $absentStudents = Student::whereNotIn('id', $presentStudentIds)->get();

        return view('home', compact('presentStudents', 'absentStudents'));
    }

    // Fungsi untuk mengubah status absensi oleh guru
    public function updateAttendance(Request $request)
    {
        $request->validate([
            'student_id' => 'required|exists:students,id',
            'status' => 'required|in:Izin,Alpa',
        ]);

        Attendance::updateOrCreate(
            [
                'student_id' => $request->student_id,
                'date' => Carbon::today(),
            ],
            [
                'status' => $request->status,
            ]
        );

        return redirect()->route('home')->with('success', 'Status absensi berhasil diubah.');
    }
}