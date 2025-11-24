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
                            <input type="text"
                                   class="form-control @error('name') is-invalid @enderror"
                                   id="name" name="name" value="{{ old('name') }}" required>
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="nis" class="form-label">NIS (Nomor Induk Siswa)</label>
                            <input type="text"
                                   class="form-control @error('nis') is-invalid @enderror"
                                   id="nis" name="nis" value="{{ old('nis') }}" required>
                            @error('nis')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Tambahkan mt-3 agar tombol lebih turun -->
                        <button type="submit" class="btn btn-success-custom w-100 mt-3">
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
                <div class="card-header bg-info-custom text-white">
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
                                <div class="item-content">
                                    <i class="fa-regular fa-user text-muted"></i>
                                    <div>
                                        <span class="student-name">{{ $student->name }}</span>
                                        <span class="student-nis">({{ $student->nis }})</span>
                                    </div>
                                </div>
                                <form action="{{ route('students.destroy', $student->id) }}" method="POST" id="delete-form-{{ $student->id }}">
                                    @csrf
                                    @method('DELETE')
                                    <button type="button" class="btn btn-sm btn-alpa delete-button"
                                            data-student-id="{{ $student->id }}"
                                            data-student-name="{{ $student->name }}">
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

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.all.min.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function () {
    if (typeof Swal === 'undefined') {
        console.error('SweetAlert2 gagal dimuat!');
        return;
    }

    const deleteButtons = document.querySelectorAll('.delete-button');
    deleteButtons.forEach(button => {
        button.addEventListener('click', function (event) {
            event.preventDefault();
            const studentId = this.dataset.studentId;
            const studentName = this.dataset.studentName;
            const form = document.getElementById(`delete-form-${studentId}`);

            Swal.fire({
                title: 'Apakah Anda yakin?',
                html: `Anda akan menghapus siswa <strong>${studentName}</strong>.<br>Semua data absensi terkait juga akan dihapus!`,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#dc3545',
                cancelButtonColor: '#6c757d',
                confirmButtonText: 'Ya, hapus!',
                cancelButtonText: 'Batal',
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    if (form) {
                        form.submit();
                    } else {
                        Swal.fire('Error!', 'Formulir penghapusan tidak ditemukan.', 'error');
                    }
                }
            });
        });
    });
});
</script>
@endpush
