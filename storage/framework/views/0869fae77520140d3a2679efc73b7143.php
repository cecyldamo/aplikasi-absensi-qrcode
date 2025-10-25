

<?php $__env->startSection('content'); ?>
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
                    <form action="<?php echo e(route('students.store')); ?>" method="POST">
                        <?php echo csrf_field(); ?>
                        <div class="mb-3">
                            <label for="name" class="form-label">Nama Siswa</label>
                            <input type="text" class="form-control <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="name" name="name" value="<?php echo e(old('name')); ?>" required>
                            <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <div class="invalid-feedback">
                                    <?php echo e($message); ?>

                                </div>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>
                        <div class="mb-3">
                            <label for="nis" class="form-label">NIS (Nomor Induk Siswa)</label>
                            <input type="text" class="form-control <?php $__errorArgs = ['nis'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="nis" name="nis" value="<?php echo e(old('nis')); ?>" required>
                            <?php $__errorArgs = ['nis'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <div class="invalid-feedback">
                                    <?php echo e($message); ?>

                                </div>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
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
                    Daftar Siswa (<?php echo e($students->count()); ?>)
                </div>
                <div class="card-body">
                    <?php if(session('success')): ?>
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <i class="fa-solid fa-circle-check me-2"></i>
                            <?php echo e(session('success')); ?>

                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    <?php endif; ?>
                     <?php if(session('error')): ?>
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <i class="fa-solid fa-circle-xmark me-2"></i>
                            <?php echo e(session('error')); ?>

                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    <?php endif; ?>

                    <ul class="list-group list-group-flush attendance-list">
                        <?php $__empty_1 = true; $__currentLoopData = $students; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $student): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                            <li class="list-group-item">
                                <!-- Konten (Ikon & Nama) -->
                                <div class="item-content">
                                    <i class="fa-regular fa-user text-muted"></i>
                                    <div>
                                        <span class="student-name"><?php echo e($student->name); ?></span>
                                        <span class="student-nis">(<?php echo e($student->nis); ?>)</span>
                                    </div>
                                </div>
                                <!-- Tombol Aksi (Hapus) -->
                                <form action="<?php echo e(route('students.destroy', $student->id)); ?>" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus siswa ini? Semua data absensi terkait akan ikut terhapus.');">
                                    <?php echo csrf_field(); ?>
                                    <?php echo method_field('DELETE'); ?>
                                    <button type="submit" class="btn btn-sm btn-alpa">
                                        <i class="fa-solid fa-trash-alt"></i>
                                        <span>Hapus</span>
                                    </button>
                                </form>
                            </li>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                            <li class="list-group-item text-center no-data-item">
                                <i class="fa-solid fa-moon me-2 opacity-50"></i>
                                Belum ada data siswa.
                            </li>
                        <?php endif; ?>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\ABSENSI-KKT\aplikasi-absensi-qrcode\resources\views/students/index.blade.php ENDPATH**/ ?>