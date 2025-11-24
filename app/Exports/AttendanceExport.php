<?php

namespace App\Exports;

// Model
use App\Models\Attendance;
use App\Models\Student; // Kita perlu join ke tabel siswa

// Carbon untuk manajemen tanggal
use Carbon\Carbon;

// Maatwebsite Excel traits
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class AttendanceExport implements FromQuery, WithHeadings, WithMapping, ShouldAutoSize, WithStyles
{
    // Properti untuk nomor urut
    private $rowNum = 0;

    /**
    * @return \Illuminate\Database\Query\Builder
    */
    public function query()
    {
        // 1. Ambil data absensi HARI INI saja
        // 2. Join dengan tabel 'students' untuk mendapatkan Nama dan NIS
        // 3. Urutkan berdasarkan nama siswa
        return Attendance::query()
            ->join('students', 'attendances.student_id', '=', 'students.id')
            ->whereDate('attendances.date', Carbon::today())
            ->select('attendances.*', 'students.name', 'students.nis') // Pilih kolom yang relevan
            ->orderBy('students.name', 'asc');
    }

    /**
    * @return array
    */
    public function headings(): array
    {
        // Ini akan menjadi baris judul (header) di file Excel
        return [
            'No.',
            'Nama Siswa',
            'NIS',
            'Status',
            'Hari',
            'Tanggal',
            'Waktu Presensi'
        ];
    }

    /**
    * @param mixed $attendance (Ini adalah hasil dari function query() di atas)
    * @return array
    */
    public function map($attendance): array
    {
        // Fungsi ini memformat setiap baris data
        // Kita menggunakan 'created_at' karena itu adalah timestamp saat absensi dicatat
        return [
            ++$this->rowNum, // Nomor urut
            $attendance->name,
            $attendance->nis,
            $attendance->status,
            // Format waktu ke Bahasa Indonesia (l = nama hari, F = nama bulan)
            Carbon::parse($attendance->created_at)->translatedFormat('l'), 
            Carbon::parse($attendance->created_at)->translatedFormat('d F Y'),
            Carbon::parse($attendance->created_at)->translatedFormat('H:i:s')
        ];
    }

    /**
    * @param Worksheet $sheet
    * @return array
    */
    public function styles(Worksheet $sheet)
    {
        // Membuat baris pertama (baris header) menjadi cetak tebal (bold)
        return [
            1    => ['font' => ['bold' => true]],
        ];
    }
}

