<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use App\Models\Student;
use Illuminate\Http\Request;
use Carbon\Carbon;

class AttendanceController extends Controller
{
    public function scanner()
    {
        return view('attendance.scanner');
    }

    public function store(Request $request)
    {
        $request->validate(['unique_code' => 'required|string|exists:students,unique_code']);

        $student = Student::where('unique_code', $request->unique_code)->first();

        if (!$student) {
            return response()->json(['success' => false, 'message' => 'Siswa tidak ditemukan.'], 404);
        }

        // Cek apakah siswa sudah absen hari ini
        $todayAttendance = Attendance::where('student_id', $student->id)
                                     ->whereDate('date', Carbon::today())
                                     ->first();

        if ($todayAttendance) {
            return response()->json(['success' => false, 'message' => $student->name . ' sudah melakukan absensi hari ini.'], 409);
        }

        // Jika belum, catat absensi
        Attendance::create([
            'student_id' => $student->id,
            'date' => Carbon::today(),
            'status' => 'Hadir',
        ]);

        return response()->json(['success' => true, 'message' => 'Absensi untuk ' . $student->name . ' berhasil dicatat.']);
    }
}

