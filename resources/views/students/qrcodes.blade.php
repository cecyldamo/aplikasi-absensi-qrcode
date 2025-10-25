@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <!-- Menggunakan kolom yang lebih lebar agar muat lebih banyak kartu -->
        <div class="col-lg-10">
            <div class="card h-100">
                <!-- Header Kartu dengan Gradien dan Ikon -->
                <div class="card-header bg-info-custom d-flex align-items-center">
                    <i class="fa-solid fa-users-viewfinder me-2"></i>
                    Daftar QR Code Siswa
                </div>
                <div class="card-body">
                    <!-- Pesan Bantuan -->
                    <p class="text-muted text-center mb-4">
                        Berikut adalah daftar QR code unik untuk setiap siswa.
                        <br class="d-none d-md-block">
                        Anda bisa menggunakan halaman ini di HP Anda untuk ditunjukkan ke scanner di laptop.
                    </p>
                    
                    <!-- Grid untuk Kartu QR -->
                    <div class="qr-card-grid">
                        @forelse($students as $student)
                            <!-- Kartu QR Kustom (style dari custom.css) -->
                            <div class="qr-card">
                                <div class="qr-code-img">
                                    <!-- Library simple-qrcode akan generate SVG di sini -->
                                    {!! QrCode::size(150)->generate($student->unique_code) !!}
                                </div>
                                <div class="qr-card-footer">
                                    <span class="student-name">{{ $student->name }}</span>
                                    <span class="student-nis">NIS: {{ $student->nis }}</span>
                                </div>
                            </div>
                        @empty
                            <!-- Tampilan jika tidak ada siswa -->
                            <div class="col-12">
                                <div class="alert alert-warning text-center w-100">
                                    <i class="fa-solid fa-user-slash me-2"></i>
                                    Belum ada data siswa di database.
                                </div>
                            </div>
                        @endforelse
                    </div> <!-- akhir .qr-card-grid -->

                </div>
            </div>
        </div>
    </div>
</div>
@endsection

