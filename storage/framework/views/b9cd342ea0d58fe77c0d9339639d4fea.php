<?php $__env->startSection('content'); ?>
<div class="container">
    <div class="row">

        <!-- Kolom Siswa Sudah Hadir -->
        <div class="col-lg-6 mb-4">
            <div class="card h-100 shadow-sm border-0">
                <!-- Header Kartu -->
                <div class="card-header bg-success-custom d-flex align-items-center">
                    <i class="fa-solid fa-user-check me-2"></i>
                    Siswa Sudah Hadir (<?php echo e($presentStudents->count()); ?>)
                </div>
                <div class="card-body">
                    <?php if(session('success')): ?>
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <i class="fa-solid fa-circle-check me-2"></i>
                            <?php echo e(session('success')); ?>

                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    <?php endif; ?>

                    <ul class="list-group list-group-flush attendance-list">
                        <?php $__empty_1 = true; $__currentLoopData = $presentStudents; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $attendance): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                            <li class="list-group-item">
                                <!-- Konten (Ikon & Nama) -->
                                <div class="item-content">
                                    <?php if($attendance->status == 'Hadir'): ?>
                                        <i class="fa-solid fa-id-badge text-success-custom"></i>
                                    <?php elseif($attendance->status == 'Izin'): ?>
                                        <i class="fa-solid fa-file-lines text-info-custom"></i>
                                    <?php else: ?>
                                        <i class="fa-solid fa-circle-xmark text-danger-custom"></i>
                                    <?php endif; ?>
                                    
                                    <div>
                                        <span class="student-name"><?php echo e($attendance->student->name); ?></span>
                                        <span class="student-nis">(<?php echo e($attendance->student->nis); ?>)</span>
                                    </div>
                                </div>
                                <!-- Badge Status -->
                                <span class="badge status-badge 
                                    <?php if($attendance->status == 'Hadir'): ?> status-hadir
                                    <?php elseif($attendance->status == 'Izin'): ?> status-izin
                                    <?php else: ?> status-alpa <?php endif; ?>">
                                    
                                    <?php if($attendance->status == 'Hadir'): ?>
                                        <i class="fa-solid fa-check"></i>
                                    <?php elseif($attendance->status == 'Izin'): ?>
                                        <i class="fa-solid fa-info-circle"></i>
                                    <?php else: ?>
                                        <i class="fa-solid fa-times-circle"></i>
                                    <?php endif; ?>
                                    <?php echo e($attendance->status); ?>

                                </span>
                            </li>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                            <li class="list-group-item text-center no-data-item">
                                <i class="fa-solid fa-moon me-2 opacity-50"></i>
                                Belum ada siswa yang hadir hari ini.
                            </li>
                        <?php endif; ?>
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
                    Siswa Belum Hadir (<?php echo e($absentStudents->count()); ?>)
                </div>
                <div class="card-body">
                    <ul class="list-group list-group-flush attendance-list">
                        <?php $__empty_1 = true; $__currentLoopData = $absentStudents; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $student): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                            <!-- TATA LETAK DIPERBARUI AGAR TOMBOL SEJAJAR -->
                            <li class="list-group-item">
                                <!-- Konten (Ikon & Nama) -->
                                <div class="item-content">
                                    <i class="fa-regular fa-user text-muted"></i>
                                    <div>
                                        <span class="student-name"><?php echo e($student->name); ?></span>
                                        <span class="student-nis">(<?php echo e($student->nis); ?>)</span>
                                    </div>
                                </div>
                                <!-- Tombol Aksi (Akan sejajar di kanan) -->
                                <div class="action-buttons">
                                    <form action="<?php echo e(route('attendance.update')); ?>" method="POST" class="d-inline-block">
                                        <?php echo csrf_field(); ?>
                                        <input type="hidden" name="student_id" value="<?php echo e($student->id); ?>">
                                        <input type="hidden" name="status" value="Izin">
                                        <!-- DIPERBAIKI: Menambahkan tanda '=' -->
                                        <button type="submit" class="btn btn-sm btn-izin">
                                            <i class="fa-solid fa-file-lines"></i>
                                            <span>Izin</span>
                                        </button>
                                    </form>
                                    <form action="<?php echo e(route('attendance.update')); ?>" method="POST" class="d-inline-block">
                                        <?php echo csrf_field(); ?>
                                        <input type="hidden" name="student_id" value="<?php echo e($student->id); ?>">
                                        <input type="hidden" name="status" value="Alpa">
                                        <!-- DIPERBAIKI: Menambahkan tanda '=' -->
                                        <button type="submit" class="btn btn-sm btn-alpa">
                                            <i class="fa-solid fa-circle-xmark"></i>
                                            <span>Alpa</span>
                                        </button>
                                    </form>
                                </div>
                            </li>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                            <li class="list-group-item text-center no-data-item">
                                <i class="fa-solid fa-champagne-glasses me-2 opacity-50"></i>
                                Semua siswa sudah hadir!
                            </li>
                        <?php endif; ?>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\user\aplikasi-absensi-qrcode\resources\views/home.blade.php ENDPATH**/ ?>