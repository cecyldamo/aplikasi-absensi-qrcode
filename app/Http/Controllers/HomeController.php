<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;
use App\Models\Attendance;
use Carbon\Carbon; // Pastikan Carbon di-import

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        // Set zona waktu WITA (Manado)
        $today = Carbon::today('Asia/Makassar');

        // Ambil ID siswa yang sudah absen hari ini
        $presentStudentIds = Attendance::whereDate('date', $today)
                                        ->pluck('student_id');

        // Ambil data siswa yang sudah hadir
        // Urutkan berdasarkan waktu input terbaru (created_at desc)
        $presentStudents = Attendance::with('student')
                                     ->whereDate('date', $today)
                                     ->orderBy('created_at', 'desc') // Diurutkan agar data terbaru di atas
                                     ->get();

        // Ambil data siswa yang belum hadir
        $absentStudents = Student::whereNotIn('id', $presentStudentIds)
                                 ->orderBy('name', 'asc') // Urutkan berdasarkan nama
                                 ->get();

        return view('home', compact('presentStudents', 'absentStudents'));
    }

    /**
     * Fungsi baru untuk update absensi oleh guru
     * (baik dari daftar 'Belum Hadir' atau 'Sudah Hadir')
     */
    public function updateAttendance(Request $request)
    {
        $request->validate([
            'student_id' => 'required|exists:students,id',
            'status' => 'required|in:Hadir,Izin,Alpa',
        ]);

        // Set zona waktu WITA (Manado)
        $today = Carbon::today('Asia/Makassar');

        // Gunakan updateOrCreate untuk menangani data baru atau yang sudah ada
        Attendance::updateOrCreate(
            [
                'student_id' => $request->student_id,
                'date' => $today, // Gunakan tanggal hari ini
            ],
            [
                'status' => $request->status,
                // 'created_at' dan 'updated_at' akan di-handle otomatis
                // Jika status diubah, 'updated_at' akan diperbarui
                // Jika 'Hadir' (scan QR), 'created_at' yang digunakan
            ]
        );

        return redirect()->route('home')->with('success', 'Status absensi siswa berhasil diperbarui.');
    }
}
