<!doctype html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">

    <title><?php echo e(config('app.name', 'Laravel')); ?> - Absensi Modern</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito:400,600,700&display=swap" rel="stylesheet">

    <!-- ICONS (Font Awesome) -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- Scripts Bawaan Laravel (Vite) -->
    <?php echo app('Illuminate\Foundation\Vite')(['resources/sass/app.scss', 'resources/js/app.js']); ?>

    <!-- ✅ Custom Stylesheet Ditaruh Paling BAWAH agar menimpa Bootstrap -->
    <link href="<?php echo e(asset('css/custom.css')); ?>" rel="stylesheet">
</head>

<body>
    <div id="app">
        <!-- Navbar yang sudah di-style dengan custom.css -->
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="<?php echo e(url('/home')); ?>">
                    <i class="fa-solid fa-qrcode me-2"></i> <!-- Ikon Baru -->
                    <?php echo e(config('app.name', 'Absensi')); ?>

                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="<?php echo e(__('Toggle navigation')); ?>">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav me-auto">
                        <!-- Bisa ditambahkan link di sini nanti -->
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto">
                        <!-- Authentication Links -->
                        <?php if(auth()->guard()->guest()): ?>
                            <?php if(Route::has('login')): ?>
                                <li class="nav-item">
                                    <a class="nav-link" href="<?php echo e(route('login')); ?>"><i class="fa-solid fa-right-to-bracket me-1"></i> <?php echo e(__('Login')); ?></a>
                                </li>
                            <?php endif; ?>

                            <?php if(Route::has('register')): ?>
                                <li class="nav-item">
                                    <a class="nav-link" href="<?php echo e(route('register')); ?>"><?php echo e(__('Register')); ?></a>
                                </li>
                            <?php endif; ?>
                        <?php else: ?>
                            <!-- == INI LINK NAVIGASI BARU ANDA == -->
                            <li class="nav-item">
                                <!-- Menambahkan logika 'active' untuk menandai halaman yang sedang dibuka -->
                                <a class="nav-link <?php echo e(request()->routeIs('home') ? 'active' : ''); ?>" href="<?php echo e(route('home')); ?>">
                                    <i class="fa-solid fa-table-columns me-1"></i> Dashboard
                                </a>
                            </li>

                            <!-- === LINK "DATA SISWA" DITAMBAHKAN KEMBALI === -->
                            <li class="nav-item">
                                <a class="nav-link <?php echo e(request()->routeIs('students.index') ? 'active' : ''); ?>" href="<?php echo e(route('students.index')); ?>">
                                    <i class="fa-solid fa-users-cog me-1"></i> Data Siswa
                                </a>
                            </li>
                            <!-- === AKHIR LINK === -->

                            <li class="nav-item">
                                <a class="nav-link <?php echo e(request()->routeIs('scanner') ? 'active' : ''); ?>" href="<?php echo e(route('scanner')); ?>">
                                    <i class="fa-solid fa-camera me-1"></i> Scanner
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link <?php echo e(request()->routeIs('students.qrcodes') ? 'active' : ''); ?>" href="<?php echo e(route('students.qrcodes')); ?>">
                                    <i class="fa-solid fa-id-card me-1"></i> QR Codes Siswa
                                </a>
                            </li>
                            <!-- == AKHIR LINK NAVIGASI BARU == -->

                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    <i class="fa-solid fa-user-shield me-1"></i>
                                    <?php echo e(Auth::user()->name); ?>

                                </a>

                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="<?php echo e(route('logout')); ?>"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        <i class="fa-solid fa-right-from-bracket me-2"></i>
                                        <?php echo e(__('Logout')); ?>

                                    </a>

                                    <form id="logout-form" action="<?php echo e(route('logout')); ?>" method="POST" class="d-none">
                                        <?php echo csrf_field(); ?>
                                    </form>
                                </div>
                            </li>
                        <?php endif; ?>
                    </ul>
                </div>
            </div>
        </nav>

        <!-- Mengubah padding agar lebih pas di mobile (md-5) -->
        <main class="py-4 py-md-5">
            <?php echo $__env->yieldContent('content'); ?>
        </main>
    </div>
    
    <!-- Stack untuk script per-halaman (seperti scanner) -->
    <?php echo $__env->yieldPushContent('scripts'); ?>
</body>
</html>

<?php /**PATH D:\ABSENSI-KKT\aplikasi-absensi-qrcode\resources\views/layouts/app.blade.php ENDPATH**/ ?>