@extends('layouts.app')

@section('content')
<div class="container">
    <!-- === LANGKAH 6: TOMBOL EXPORT DITAMBAHKAN DI SINI === -->
    <div class="d-flex justify-content-end mb-3">
        <a href="{{ route('attendance.export') }}" class="btn btn-success-custom">
            <i class="fa-solid fa-file-excel me-2"></i>
            Export ke Excel
        </a>
    </div>
    <!-- ================================================= -->
     
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
                            {{-- Modifikasi LI agar flex dan rata --}}
                            <li class="list-group-item d-flex justify-content-between align-items-start"> 
                                
                                <!-- Konten (Ikon & Nama & Waktu) -->
                                <div class="item-content d-flex"> {{-- Tambah d-flex --}}
                                    @if($attendance->status == 'Hadir')
                                        <i class="fa-solid fa-id-badge text-success-custom me-2 mt-1"></i> {{-- Tambah margin --}}
                                    @elseif($attendance->status == 'Izin')
                                        <i class="fa-solid fa-file-lines text-info-custom me-2 mt-1"></i> {{-- Tambah margin --}}
                                    @else
                                        <i class="fa-solid fa-circle-xmark text-danger-custom me-2 mt-1"></i> {{-- Tambah margin --}}
                                    @endif
                                    
                                    {{-- Grup Nama dan Waktu --}}
                                    <div>
                                        <span class="student-name">{{ $attendance->student->name }}</span>
                                        <span class="student-nis">({{ $attendance->student->nis }})</span>
                                        
                                        {{-- ===== FITUR BARU: WAKTU PRESENSI ===== --}}
                                        <span class="d-block text-muted" style="font-size: 0.8rem;">
                                            {{ \Carbon\Carbon::parse($attendance->created_at)->translatedFormat('l, d F Y H:i:s') }}
                                        </span>
                                        {{-- ===== AKHIR FITUR BARU ===== --}}

                                    </div>
                                </div>

                                {{-- Grup Badge dan Tombol Edit --}}
                                <div class="text-end">
                                    <!-- Badge Status -->
                                    <span class="badge status-badge d-block mb-1 {{-- Class dinamis badge --}}
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

                                    {{-- ===== FITUR BARU: TOMBOL EDIT ===== --}}
                                    <div class="dropdown">
                                        <button class="btn btn-sm btn-outline-secondary dropdown-toggle" type="button" id="dropdownMenuButton-{{$attendance->student->id}}" data-bs-toggle="dropdown" aria-expanded="false" style="--bs-btn-padding-y: .1rem; --bs-btn-padding-x: .4rem; --bs-btn-font-size: .75rem;">
                                            Ubah
                                        </button>
                                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton-{{$attendance->student->id}}">
                                            <li>
                                                <form action="{{ route('attendance.update') }}" method="POST">
                                                    @csrf
                                                    <input type="hidden" name="student_id" value="{{ $attendance->student->id }}">
                                                    <input type="hidden" name="status" value="Hadir">
                                                    <button type="submit" class="dropdown-item">Hadir</button>
                                                </form>
                                            </li>
                                            <li>
                                                <form action="{{ route('attendance.update') }}" method="POST">
                                                    @csrf
                                                    <input type="hidden" name="student_id" value="{{ $attendance->student->id }}">
                                                    <input type="hidden" name="status" value="Izin">
                                                    <button type="submit" class="dropdown-item">Izin</button>
                                                </form>
                                            </li>
                                            <li>
                                                <form action="{{ route('attendance.update') }}" method="POST">
                                                    @csrf
                                                    <input type="hidden" name="student_id" value="{{ $attendance->student->id }}">
                                                    <input type="hidden" name="status" value="Alpa">
                                                    <button type="submit" class="dropdown-item">Alpa</button>
                                                </form>
                                            </li>
                                        </ul>
                                    </div>
                                    {{-- ===== AKHIR FITUR BARU ===== --}}
                                </div>

                            </li>
                        @empty
                            <li class="list-group-item text-center no-data-item">
                                Belum ada siswa yang hadir hari ini.
                            </li>
                        @endforelse
                    </ul>
                </div>
            </div>
        </div>

        <!-- Kolom Siswa Belum Hadir (Kode Anda) -->
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
                            <li class="list-group-item student-item-absent"> <!-- Tambahkan class student-item-absent -->
                                <!-- Area yang bisa diklik untuk dropdown -->
                                <a href="#" class="dropdown-toggle-student" data-bs-toggle="dropdown" aria-expanded="false">
                                    <div class="item-content">
                                        <i class="fa-regular fa-user text-muted"></i>
                                        <div>
                                            <span class="student-name">{{ $student->name }}</span>
                                            <span class="student-nis">({{ $student->nis }})</span>
                                        </div>
                                    </div>
                                    <!-- Ikon panah dropdown -->
                                    <i class="fa-solid fa-caret-down dropdown-arrow"></i>
                                </a>

                                <!-- Menu Dropdown -->
                                <ul class="dropdown-menu dropdown-menu-student">
                                    <li>
                                        <!-- Form untuk Izin -->
                                        <form action="{{ route('attendance.update') }}" method="POST" class="d-inline">
                                            @csrf
                                            <input type="hidden" name="student_id" value="{{ $student->id }}">
                                            <input type="hidden" name="status" value="Izin">
                                            <button type="submit" class="dropdown-item dropdown-item-izin">
                                                <i class="fa-solid fa-file-lines me-2"></i>Tandai Izin
                                            </button>
                                        </form>
                                    </li>
                                    <li>
                                        <!-- Form untuk Alpa -->
                                        <form action="{{ route('attendance.update') }}" method="POST" class="d-inline">
                                            @csrf
                                            <input type="hidden" name="student_id" value="{{ $student->id }}">
                                            <input type="hidden" name="status" value="Alpa">
                                            <button type="submit" class="dropdown-item dropdown-item-alpa">
                                                <i class="fa-solid fa-circle-xmark me-2"></i>Tandai Alpa
                                            </button>
                                        </form>
                                    </li>
                                </ul>
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
