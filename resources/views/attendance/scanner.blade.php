@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <!-- Mengubah ukuran kolom agar lebih pas di layar besar (col-md-8 -> col-lg-6) -->
        <div class="col-lg-6 col-md-8">
            <!-- Menggunakan style kartu kustom yang sama dengan dashboard -->
            <div class="card h-100">
                <!-- Header Kartu dengan Gradien dan Ikon -->
                <div class="card-header bg-primary-custom d-flex align-items-center">
                    <i class="fa-solid fa-camera me-2"></i>
                    Scan QR Code Absensi
                </div>
                <div class="card-body text-center p-4">
                    <!-- Pesan Bantuan -->
                    <p class="text-muted">Arahkan QR code siswa ke kamera untuk mencatat kehadiran.</p>
                    
                    <!-- Area Scanner -->
                    <!-- Div ini akan diisi oleh kamera -->
                    <div id="qr-reader-container">
                        <div id="qr-reader" class="shadow-sm"></div>
                    </div>

                    <!-- Notifikasi Sukses/Error -->
                    <div id="notification" class="mt-3"></div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<!-- Pustaka Axios untuk kirim data ke server -->
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>

<!-- 
  Kita akan memuat pustaka scanner secara dinamis (dari JSDelivr)
  Ini adalah metode yang sudah terbukti berhasil di langkah kita sebelumnya.
-->
<script>
    // Variabel global untuk menyimpan hasil scan terakhir
    let lastScanResult = null;
    
    // Fungsi untuk memuat skrip secara dinamis
    function loadScript(src, callback) {
        let script = document.createElement('script');
        script.type = 'text/javascript';
        script.src = src;
        script.onload = callback;
        script.onerror = function() {
            console.error("Gagal memuat skrip: " + src);
            // Menampilkan error di UI jika gagal
            const notificationDiv = document.getElementById('notification');
            if(notificationDiv) {
                notificationDiv.innerHTML = `<div class="alert alert-danger">Gagal memuat komponen scanner. Periksa koneksi internet Anda dan refresh halaman.</div>`;
            }
        };
        document.head.appendChild(script);
    }

    // Fungsi untuk menampilkan notifikasi
    function showNotification(message, isSuccess) {
        const notificationDiv = document.getElementById('notification');
        if (!notificationDiv) return;

        let alertClass = isSuccess ? 'alert-success' : 'alert-danger';
        let iconClass = isSuccess ? 'fa-solid fa-circle-check' : 'fa-solid fa-circle-exclamation';

        notificationDiv.innerHTML = `
            <div class="alert ${alertClass} d-flex align-items-center" role="alert">
                <i class="${iconClass} me-2"></i>
                <div>
                    ${message}
                </div>
            </div>
        `;

        // Notifikasi akan hilang setelah 3 detik
        setTimeout(() => {
            notificationDiv.innerHTML = '';
            lastScanResult = null; // Reset setelah notifikasi hilang
        }, 3000);
    }

    // Fungsi yang akan dijalankan ketika QR code berhasil dipindai
    function onScanSuccess(decodedText, decodedResult) {
        // Hanya proses jika hasil scan berbeda dari yang terakhir
        if (decodedText !== lastScanResult) {
            lastScanResult = decodedText;
            console.log(`Scan result: ${decodedText}`, decodedResult);

            // Memberikan getaran (feedback) di HP
            if (window.navigator.vibrate) {
                window.navigator.vibrate(100);
            }

            // Kirim data ke server menggunakan Axios
            axios.post('{{ route("attendance.store") }}', {
                unique_code: decodedText,
                _token: '{{ csrf_token() }}' // Sertakan CSRF token
            })
            .then(function (response) {
                // Handle success
                console.log(response.data);
                showNotification(response.data.message, true);
            })
            .catch(function (error) {
                // Handle error
                console.error(error.response.data);
                showNotification(error.response.data.message, false);
            });
        }
    }

    // Fungsi yang akan dijalankan jika scan gagal (opsional)
    function onScanFailure(error) {
        // Ini akan sering terpanggil, jadi kita biarkan kosong agar tidak spam console
        // console.warn(`QR error = ${error}`);
    }

    // Fungsi utama untuk memulai scanner
    function startScanner() {
        // Cek apakah library sudah dimuat
        if (typeof Html5QrcodeScanner === 'undefined') {
            console.error('Html5QrcodeScanner library is not loaded.');
            showNotification('Komponen scanner gagal dimuat.', false);
            return;
        }

        try {
            let html5QrcodeScanner = new Html5QrcodeScanner(
                "qr-reader", // ID dari elemen <div>
                { 
                    fps: 10,  // Frames per second
                    qrbox: { width: 250, height: 250 } // Ukuran kotak scan
                },
                false // verbose
            );
            html5QrcodeScanner.render(onScanSuccess, onScanFailure);
        } catch (e) {
            console.error("Error saat memulai scanner:", e);
            showNotification('Tidak dapat memulai kamera. Pastikan Anda memberikan izin.', false);
        }
    }

    // Panggil fungsi untuk memuat skrip, dan jika berhasil, panggil startScanner
    loadScript("https://cdn.jsdelivr.net/npm/html5-qrcode@2.3.8/html5-qrcode.min.js", startScanner);

</script>
@endpush

