@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <!-- Kolom Tambah Siswa Baru -->
        <div class="col-md-4 mb-4">
            <div class="card shadow-sm border-0 h-100">
                <div class="card-header bg-primary-custom text-white">
                    <i class="fa-solid fa-user-plus me-2"></i>
                    Tambah Siswa Baru
                </div>
                <div class="card-body">
                    <form action="{{ route('students.store') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="name" class="form-label">Nama Siswa</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name') }}" required>
                            @error('name')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="nis" class="form-label">NIS (Nomor Induk Siswa)</label>
                            <input type="text" class="form-control @error('nis') is-invalid @enderror" id="nis" name="nis" value="{{ old('nis') }}" required>
                            @error('nis')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-success-custom w-100">
                            <i class="fa-solid fa-save me-2"></i>
                            Simpan
                        </button>
                    </form>
                </div>
            </div>
        </div>

        <!-- Kolom Daftar Siswa -->
        <div class="col-md-8 mb-4">
            <div class="card shadow-sm border-0 h-100">
                 <!-- === PERUBAHAN DI SINI === -->
                <div class="card-header bg-info-custom text-white"> 
                 <!-- ======================== -->
                    <i class="fa-solid fa-users me-2"></i>
                    Daftar Siswa ({{ $students->count() }})
                </div>
                <div class="card-body">
                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <i class="fa-solid fa-circle-check me-2"></i>
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif
                     @if(session('error'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <i class="fa-solid fa-circle-xmark me-2"></i>
                            {{ session('error') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    <ul class="list-group list-group-flush attendance-list">
                        @forelse($students as $student)
                            <li class="list-group-item">
                                <!-- Konten (Ikon & Nama) -->
                                <div class="item-content">
                                    <i class="fa-regular fa-user text-muted"></i>
                                    <div>
                                        <span class="student-name">{{ $student->name }}</span>
                                        <span class="student-nis">({{ $student->nis }})</span>
                                    </div>
                                </div>
                                <!-- Tombol Aksi (Hapus) -->
                                <form action="{{ route('students.destroy', $student->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus siswa ini? Semua data absensi terkait akan ikut terhapus.');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-alpa">
                                        <i class="fa-solid fa-trash-alt"></i>
                                        <span>Hapus</span>
                                    </button>
                                </form>
                            </li>
                        @empty
                            <li class="list-group-item text-center no-data-item">
                                <i class="fa-solid fa-moon me-2 opacity-50"></i>
                                Belum ada data siswa.
                            </li>
                        @endforelse
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

