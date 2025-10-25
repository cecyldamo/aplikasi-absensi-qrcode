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
    Route::get('/scanner', [AttendanceController::class, 'scanner'])->name('scanner');
    Route::post('/attendance', [AttendanceController::class, 'store'])->name('attendance.store');
    // routes/web.php
    // ... di dalam Route::middleware(['auth'])->group(...)
    Route::post('/home/update-attendance', [App\Http\Controllers\HomeController::class, 'updateAttendance'])->name('attendance.update');
});