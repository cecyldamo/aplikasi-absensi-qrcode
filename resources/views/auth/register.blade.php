@extends('layouts.app')

@section('content')
<div class="auth-container">
    <div class="auth-card">
        <div class="col-md-5 auth-info-col d-none d-md-flex">
            <div>
                <h1>Bergabunglah Bersama Kami</h1>
                <p>Daftarkan akun baru untuk mulai menggunakan sistem absensi modern.</p>
            </div>
        </div>

        <div class="col-12 col-md-7 auth-form-col">
            <div class="form-header">
                <h2>Daftar Akun Baru</h2>
            </div>

            <form method="POST" action="{{ route('register') }}">
                @csrf

                <div class="mb-3">
                    <label for="name" class="form-label">{{ __('Nama') }}</label>
                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
                    @error('name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="email" class="form-label">{{ __('Alamat Email') }}</label>
                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">
                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="password" class="form-label">{{ __('Password') }}</label>
                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
                    @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="password-confirm" class="form-label">{{ __('Konfirmasi Password') }}</label>
                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                </div>

                <div class="d-grid mt-4">
                    <button type="submit" class="btn btn-auth">
                        {{ __('Register') }}
                    </button>
                </div>

                <div class="auth-link">
                    <span>Sudah punya akun?</span>
                    <a href="{{ route('login') }}">
                        {{ __('Login di sini') }}
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection