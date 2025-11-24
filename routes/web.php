<?php

// routes/web.php
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\HomeController;

// ... (route lainnya)
Route::get('/', function () {
    return redirect()->route('login');
});

Auth::routes();

// Route yang hanya bisa diakses setelah login
Route::middleware(['auth'])->group(function () {
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    
    // Route untuk menampilkan semua QR Code siswa
    Route::get('/students/qrcodes', [StudentController::class, 'showQrCodes'])->name('students.qrcodes');
    
    // === Rute yang sudah ada ===
    // Rute untuk mengelola siswa (CRUD)
    Route::get('/students', [StudentController::class, 'index'])->name('students.index');
    Route::post('/students', [StudentController::class, 'store'])->name('students.store');
    Route::delete('/students/{student}', [StudentController::class, 'destroy'])->name('students.destroy');
    // === AKHIR Rute yang sudah ada ===

    Route::get('/scanner', [AttendanceController::class, 'scanner'])->name('scanner');
    Route::post('/attendance', [AttendanceController::class, 'store'])->name('attendance.store');
    
    // Rute untuk update status dari dashboard
    Route::post('/home/update-attendance', [App\Http\Controllers\HomeController::class, 'updateAttendance'])->name('attendance.update');

    // === LANGKAH 5: RUTE BARU UNTUK EXPORT EXCEL ===
    Route::get('/home/export', [App\Http\Controllers\HomeController::class, 'exportAttendance'])->name('attendance.export');
    // ===========================================
});

