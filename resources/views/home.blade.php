@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">

        <!-- Kolom Siswa Sudah Hadir -->
        <div class="col-lg-6 mb-4">
            <div class="card h-100 shadow-sm border-0">
                <!-- Header Kartu -->
                <div class="card-header bg-success-custom d-flex align-items-center">
                    <i class="fa-solid fa-user-check me-2"></i>
                    Siswa Sudah Hadir ({{ $presentStudents->count() }})
                </div>
                <div class="card-body">
                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <i class="fa-solid fa-circle-check me-2"></i>
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    <ul class="list-group list-group-flush attendance-list">
                        @forelse($presentStudents as $attendance)
                            <li class="list-group-item">
                                <!-- Konten (Ikon & Nama) -->
                                <div class="item-content">
                                    @if($attendance->status == 'Hadir')
                                        <i class="fa-solid fa-id-badge text-success-custom"></i>
                                    @elseif($attendance->status == 'Izin')
                                        <i class="fa-solid fa-file-lines text-info-custom"></i>
                                    @else
                                        <i class="fa-solid fa-circle-xmark text-danger-custom"></i>
                                    @endif
                                    
                                    <div>
                                        <span class="student-name">{{ $attendance->student->name }}</span>
                                        <span class="student-nis">({{ $attendance->student->nis }})</span>
                                    </div>
                                </div>
                                <!-- Badge Status -->
                                <span class="badge status-badge 
                                    @if($attendance->status == 'Hadir') status-hadir
                                    @elseif($attendance->status == 'Izin') status-izin
                                    @else status-alpa @endif">
                                    
                                    @if($attendance->status == 'Hadir')
                                        <i class="fa-solid fa-check"></i>
                                    @elseif($attendance->status == 'Izin')
                                        <i class="fa-solid fa-info-circle"></i>
                                    @else
                                        <i class="fa-solid fa-times-circle"></i>
                                    @endif
                                    {{ $attendance->status }}
                                </span>
                            </li>
                        @empty
                            <li class="list-group-item text-center no-data-item">
                                <i class="fa-solid fa-moon me-2 opacity-50"></i>
                                Belum ada siswa yang hadir hari ini.
                            </li>
                        @endforelse
                    </ul>
                </div>
            </div>
        </div>

        <!-- Kolom Siswa Belum Hadir -->
        <div class="col-lg-6 mb-4">
            <div class="card h-100 shadow-sm border-0">
                <!-- Header Kartu -->
                <div class="card-header bg-danger-custom d-flex align-items-center">
                    <i class="fa-solid fa-user-clock me-2"></i>
                    Siswa Belum Hadir ({{ $absentStudents->count() }})
                </div>
                <div class="card-body">
                    <ul class="list-group list-group-flush attendance-list">
                        @forelse($absentStudents as $student)
                            <!-- TATA LETAK DIPERBARUI AGAR TOMBOL SEJAJAR -->
                            <li class="list-group-item">
                                <!-- Konten (Ikon & Nama) -->
                                <div class="item-content">
                                    <i class="fa-regular fa-user text-muted"></i>
                                    <div>
                                        <span class="student-name">{{ $student->name }}</span>
                                        <span class="student-nis">({{ $student->nis }})</span>
                                    </div>
                                </div>
                                <!-- Tombol Aksi (Akan sejajar di kanan) -->
                                <div class="action-buttons">
                                    <form action="{{ route('attendance.update') }}" method="POST" class="d-inline-block">
                                        @csrf
                                        <input type="hidden" name="student_id" value="{{ $student->id }}">
                                        <input type="hidden" name="status" value="Izin">
                                        <!-- DIPERBAIKI: Menambahkan tanda '=' -->
                                        <button type="submit" class="btn btn-sm btn-izin">
                                            <i class="fa-solid fa-file-lines"></i>
                                            <span>Izin</span>
                                        </button>
                                    </form>
                                    <form action="{{ route('attendance.update') }}" method="POST" class="d-inline-block">
                                        @csrf
                                        <input type="hidden" name="student_id" value="{{ $student->id }}">
                                        <input type="hidden" name="status" value="Alpa">
                                        <!-- DIPERBAIKI: Menambahkan tanda '=' -->
                                        <button type="submit" class="btn btn-sm btn-alpa">
                                            <i class="fa-solid fa-circle-xmark"></i>
                                            <span>Alpa</span>
                                        </button>
                                    </form>
                                </div>
                            </li>
                        @empty
                            <li class="list-group-item text-center no-data-item">
                                <i class="fa-solid fa-champagne-glasses me-2 opacity-50"></i>
                                Semua siswa sudah hadir!
                            </li>
                        @endforelse
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

