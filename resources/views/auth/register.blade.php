@extends('layouts.app')

@section('content')
<!-- Card otentikasi akan dipusatkan secara otomatis oleh style di app.blade.php dan custom.css -->
<div class="card auth-card">
    <div class="card-body">

        <!-- Judul dan Subjudul -->
        <h1 class="card-title">Buat Akun Baru</h1>
        <p class="card-subtitle">Silakan isi data Anda untuk mendaftar</p>

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <!-- Form Group Name -->
            <div class="mb-3">
                <label for="name" class="form-label">{{ __('Name') }}</label>
                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
                @error('name')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <!-- Form Group Email -->
            <div class="mb-3">
                <label for="email" class="form-label">{{ __('Email Address') }}</label>
                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">
                @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <!-- Form Group Password -->
            <div class="mb-3">
                <label for="password" class="form-label">{{ __('Password') }}</label>
                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
                @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <!-- Form Group Confirm Password -->
            <div class="mb-3">
                <label for="password-confirm" class="form-label">{{ __('Confirm Password') }}</label>
                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
            </div>

            <!-- Tombol Submit -->
            <button type="submit" class="btn btn-auth">
                Daftar
            </button>

            <!-- Link ke Login -->
            <p class="auth-footer-text">
                Sudah punya akun? <a href="{{ route('login') }}" class="auth-link">Masuk di sini</a>
            </p>

        </form>
    </div>
</div>
@endsection

