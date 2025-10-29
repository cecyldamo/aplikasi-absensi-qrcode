@extends('layouts.app')

@section('content')
<!-- Card otentikasi akan dipusatkan secara otomatis oleh style di app.blade.php dan custom.css -->
<div class="card auth-card">
    <div class="card-body">
        
        <!-- Judul dan Subjudul -->
        <h1 class="card-title">Selamat Datang</h1>
        <p class="card-subtitle">Masuk untuk melanjutkan ke sistem absensi</p>

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <!-- Form Group Email -->
            <div class="mb-3">
                <label for="email" class="form-label">{{ __('Email Address') }}</label>
                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <!-- Form Group Password -->
            <div class="mb-3">
                <label for="password" class="form-label">{{ __('Password') }}</label>
                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
                @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <!-- Baris Remember Me & Lupa Password -->
            <div class="d-flex justify-content-between align-items-center mb-3">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                    <label class="form-check-label" for="remember">
                        {{ __('Remember Me') }}
                    </label>
                </div>
                @if (Route::has('password.request'))
                    <a class="auth-link" href="{{ route('password.request') }}">
                        Lupa Password?
                    </a>
                @endif
            </div>

            <!-- Tombol Submit -->
            <button type="submit" class="btn btn-auth">
                Masuk
            </button>

            <!-- Link ke Register -->
            <p class="auth-footer-text">
                Belum punya akun? <a href="{{ route('register') }}" class="auth-link">Daftar sekarang</a>
            </p>

        </form>
    </div>
</div>
@endsection

