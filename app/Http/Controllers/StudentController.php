<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;
use SimpleSoftwareIO\QrCode\Facades\QrCode; // Pastikan ini ada (sesuai kode Anda)
use Illuminate\Support\Str;                   // Import Str untuk kode unik
use Illuminate\Validation\Rule;                 // Import Rule untuk validasi unique

class StudentController extends Controller
{

    /**
     * Menampilkan halaman manajemen data siswa.
     */
    public function index()
    {
        // Menggunakan orderBy agar lebih rapi di tampilan
        $students = Student::orderBy('name', 'asc')->get(); 
        return view('students.index', compact('students'));
    }

    /**
     * Menyimpan data siswa baru.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            // Menggunakan Rule::unique agar lebih jelas
            'nis' => ['required', 'string', 'max:50', Rule::unique('students', 'nis')], 
        ], [
            'name.required' => 'Nama siswa tidak boleh kosong.',
            'nis.required' => 'NIS tidak boleh kosong.',
            'nis.unique' => 'NIS ini sudah terdaftar. Harap gunakan NIS lain.'
        ]);

        // === LOGIKA PEMBUATAN KODE UNIK DIMASUKKAN KEMBALI ===
        $uniqueCode = Str::random(10);
        while (Student::where('unique_code', $uniqueCode)->exists()) {
            $uniqueCode = Str::random(10);
        }
        // ===================================================

        Student::create([
            'name' => $request->name,
            'nis' => $request->nis,
            'unique_code' => $uniqueCode, // <- Kode unik ditambahkan
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
     * (Menggunakan kode dari versi terbaru Anda, tapi ditambahkan orderBy)
     */
    public function showQrCodes()
    {
        // Menggunakan orderBy agar lebih rapi di tampilan cetak
        $students = Student::orderBy('name', 'asc')->get(); 
        return view('students.qrcodes', compact('students'));
    }
}

