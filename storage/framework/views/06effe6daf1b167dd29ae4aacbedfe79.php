

<?php $__env->startSection('content'); ?>
<div class="container">
    <!-- Tombol Cetak -->
    <div class="d-flex justify-content-end mb-3">
        <button onclick="window.print()" class="btn btn-primary-custom">
            <i class="fa-solid fa-print me-2"></i>Cetak Semua QR Code
        </button>
    </div>

    <div class="row">
        <?php $__empty_1 = true; $__currentLoopData = $students; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $student): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
            <div class="col-md-4 col-6 mb-4">
                <div class="card text-center qr-card-wrapper shadow-sm">
                    <div class="card-body">
                        <h5 class="student-name-qr"><?php echo e($student->name); ?></h5>
                        <p class="student-nis-qr"><?php echo e($student->nis); ?></p>
                        <div class="qr-code-container d-flex justify-content-center align-items-center">
                            <!-- 
                                =================================
                                PERUBAHAN UTAMA DI SINI:
                                Menggunakan unique_code untuk QR
                                =================================
                            -->
                            <?php echo QrCode::size(150)->generate($student->unique_code); ?>

                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
            <div class="col-12">
                <div class="alert alert-warning text-center">
                    <i class="fa-solid fa-users-slash me-2"></i>
                    Belum ada data siswa untuk ditampilkan. Silakan tambahkan siswa terlebih dahulu di halaman "Data Siswa".
                </div>
            </div>
        <?php endif; ?>
    </div>
</div>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\ABSENSI-KKT\aplikasi-absensi-qrcode\resources\views/students/qrcodes.blade.php ENDPATH**/ ?>