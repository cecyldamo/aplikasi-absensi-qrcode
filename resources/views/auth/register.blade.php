@extends('layouts.app')

@section('content')
<link rel="stylesheet" href="{{ asset('css/custom.css') }}">
<style>
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
    max-width: 480px;
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

.form-control {
    border-radius: 0.5rem;
    padding: 0.75rem;
}

.btn-register {
    background: linear-gradient(135deg, var(--primary-gradient-start), var(--secondary-color));
    color: #fff;
    font-weight: 600;
    border: none;
    border-radius: 50rem;
    width: 100%;
    padding: 0.75rem;
    transition: all 0.3s ease;
}

.btn-register:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 20px rgba(74, 144, 226, 0.3);
    opacity: 0.9;
}

.login-text {
    text-align: center;
    margin-top: 1.25rem;
    color: var(--text-muted);
}

.login-text a {
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
            <h2>Buat Akun Baru</h2>
        </div>

        <form method="POST" action="{{ route('register') }}">
            @csrf
            <div class="mb-3">
                <label for="name" class="form-label">Nama Lengkap</label>
                <input id="name" type="text"
                    class="form-control @error('name') is-invalid @enderror"
                    name="name" value="{{ old('name') }}" required autofocus>
                @error('name')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input id="email" type="email"
                    class="form-control @error('email') is-invalid @enderror"
                    name="email" value="{{ old('email') }}" required>
                @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input id="password" type="password"
                    class="form-control @error('password') is-invalid @enderror"
                    name="password" required>
                @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="mb-3">
                <label for="password-confirm" class="form-label">Konfirmasi Password</label>
                <input id="password-confirm" type="password"
                    class="form-control"
                    name="password_confirmation" required>
            </div>

            <button type="submit" class="btn-register">
                Daftar
            </button>

            <div class="login-text">
                Sudah punya akun?
                <a href="{{ route('login') }}">Masuk di sini</a>
            </div>
        </form>
    </div>
</div>
@endsection
