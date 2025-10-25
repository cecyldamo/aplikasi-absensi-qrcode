<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;
use SimpleSoftwareIO\QrCode\Facades\QrCode; // Pastikan ini ada

class StudentController extends Controller
{

    /**
     * Menampilkan halaman manajemen data siswa.
     */
    public function index()
    {
        $students = Student::all();
        return view('students.index', compact('students'));
    }

    /**
     * Menyimpan data siswa baru.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'nis' => 'required|string|max:50|unique:students,nis',
        ], [
            'name.required' => 'Nama siswa tidak boleh kosong.',
            'nis.required' => 'NIS tidak boleh kosong.',
            'nis.unique' => 'NIS ini sudah terdaftar. Harap gunakan NIS lain.'
        ]);

        Student::create([
            'name' => $request->name,
            'nis' => $request->nis,
        ]);

        return redirect()->route('students.index')->with('success', 'Siswa berhasil ditambahkan.');
    }

    /**
     * Menghapus data siswa.
     */
    public function destroy(Student $student)
    {
        try {
            // Hapus semua data absensi terkait siswa ini terlebih dahulu
            $student->attendances()->delete();
            
            // Hapus data siswa
            $student->delete();

            return redirect()->route('students.index')->with('success', 'Siswa berhasil dihapus.');
        } catch (\Exception $e) {
            return redirect()->route('students.index')->with('error', 'Gagal menghapus siswa. Error: ' . $e->getMessage());
        }
    }

    /**
     * Menampilkan halaman QR Code semua siswa.
     * (Fungsi ini sudah ada sebelumnya, biarkan saja)
     */
    public function showQrCodes()
    {
        // ... (isi fungsi ini jangan diubah)
        $students = Student::all();
        return view('students.qrcodes', compact('students'));
    }
}
