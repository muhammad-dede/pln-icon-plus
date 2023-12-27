@extends('layouts.auth')

@section('title', 'Login')

@section('content')
    <form id="form_submit" class="card card-md" action="{{ route('login') }}" method="POST">
        @csrf
        <div class="card-body">
            <h1 class="text-center">Masuk Akun</h1>
            <p class="text-center text-muted">Silahkan masuk ke akun Anda.</p>
            <div class="mb-2">
                <label class="form-label" for="username">Username</label>
                <input type="text" name="username" id="username"
                    class="form-control @error('username') is-invalid @enderror" autocomplete="on"
                    value="{{ old('username') }}" />
                @error('username')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-2">
                <label class="form-label" for="password">
                    Password
                    @if (Route::has('password.request'))
                        <span class="form-label-description">
                            <a href="{{ route('password.request') }}" tabindex="-1">
                                Lupa password
                            </a>
                        </span>
                    @endif
                </label>
                <input type="password" name="password" id="password"
                    class="form-control @error('password') is-invalid @enderror" />
                @error('password')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-2">
                <label class="form-check">
                    <input type="checkbox" name="remember" class="form-check-input" @checked(old('remember')) />
                    <span class="form-check-label">Ingat Saya</span>
                </label>
            </div>
            <div class="form-footer d-grid gap-2">
                <button type="submit" class="btn btn-primary">Masuk</button>
            </div>
            @if (Route::has('register'))
                <hr>
                <div class="text-center text-muted">
                    Belum punya akun?
                    <a href="{{ route('register') }}" tabindex="-1">Daftarkan diri Anda</a>
                </div>
            @endif
        </div>
    </form>
@endsection
