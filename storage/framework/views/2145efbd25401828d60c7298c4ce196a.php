<?php $__env->startSection('content'); ?>
<link rel="stylesheet" href="<?php echo e(asset('css/custom.css')); ?>">
<style>
/* === Styling Halaman Login === */
body > main {
    padding: 0 !important;
}

.auth-container {
    min-height: 100vh;
    background: linear-gradient(135deg, var(--primary-gradient-start), var(--secondary-color));
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 2rem;
}

.auth-card {
    background: rgba(255, 255, 255, 0.9);
    backdrop-filter: blur(10px);
    border-radius: 1rem;
    box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
    width: 100%;
    max-width: 450px;
    padding: 2rem;
    animation: fadeIn 0.8s ease;
}

.auth-header {
    text-align: center;
    margin-bottom: 1.5rem;
}

.auth-header h2 {
    font-weight: 700;
    color: var(--primary-color);
}

.auth-header p {
    color: var(--text-muted);
    font-size: 0.9rem;
}

.form-control {
    border-radius: 0.5rem;
    padding: 0.75rem;
}

.btn-login {
    background: linear-gradient(135deg, var(--primary-gradient-start), var(--secondary-color));
    color: #fff;
    font-weight: 600;
    border: none;
    border-radius: 50rem;
    width: 100%;
    padding: 0.75rem;
    transition: all 0.3s ease;
}

.btn-login:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 20px rgba(74, 144, 226, 0.3);
    opacity: 0.9;
}

.form-check-label {
    font-size: 0.9rem;
    color: var(--text-muted);
}

.forgot-link {
    display: block;
    text-align: right;
    font-size: 0.9rem;
}

.register-text {
    text-align: center;
    margin-top: 1.25rem;
    color: var(--text-muted);
}

.register-text a {
    color: var(--primary-color);
    font-weight: 600;
}

@keyframes fadeIn {
    from { opacity: 0; transform: translateY(20px); }
    to { opacity: 1; transform: translateY(0); }
}
</style>

<div class="auth-container">
    <div class="auth-card">
        <div class="auth-header">
            <h2>Selamat Datang</h2>
            <p>Masuk untuk melanjutkan ke sistem absensi modern</p>
        </div>

        <form method="POST" action="<?php echo e(route('login')); ?>">
            <?php echo csrf_field(); ?>
            <div class="mb-3">
                <label for="email" class="form-label">Email Address</label>
                <input id="email" type="email"
                    class="form-control <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                    name="email" value="<?php echo e(old('email')); ?>" required autofocus>
                <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <span class="invalid-feedback" role="alert">
                        <strong><?php echo e($message); ?></strong>
                    </span>
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>

            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input id="password" type="password"
                    class="form-control <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                    name="password" required>
                <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <span class="invalid-feedback" role="alert">
                        <strong><?php echo e($message); ?></strong>
                    </span>
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>

            <div class="d-flex justify-content-between align-items-center mb-3">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="remember" id="remember"
                        <?php echo e(old('remember') ? 'checked' : ''); ?>>
                    <label class="form-check-label" for="remember">
                        Remember Me
                    </label>
                </div>
                <?php if(Route::has('password.request')): ?>
                    <a class="forgot-link" href="<?php echo e(route('password.request')); ?>">
                        Lupa Password?
                    </a>
                <?php endif; ?>
            </div>

            <button type="submit" class="btn-login">
                Masuk
            </button>

            <div class="register-text">
                Belum punya akun?
                <a href="<?php echo e(route('register')); ?>">Daftar sekarang</a>
            </div>
        </form>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\ABSENSI-KKT\aplikasi-absensi-qrcode\resources\views/auth/login.blade.php ENDPATH**/ ?>