@extends('layouts.auth')

@section('title', 'Login')

@section('content')
<div class="card shadow-lg border-0">
    <div class="card-body p-4">
        <h3 class="text-center fw-bold mb-4">LOGIN</h3>
        
        @if(session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif

        <form action="{{ route('login') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label class="form-label">NIM</label>
                <input type="text" name="nim" class="form-control" required autofocus>
            </div>
            <div class="mb-3">
                <label class="form-label">Password</label>
                <input type="password" name="password" class="form-control" required>
            </div>
            <div class="d-grid gap-2">
                <button type="submit" class="btn btn-warning fw-bold">Masuk</button>
            </div>
        </form>
        
        <div class="text-center mt-3">
            <a href="{{ route('register') }}" class="text-decoration-none">Daftar Akun Baru</a>
        </div>
    </div>
</div>
<div class="text-center mt-3">
    <a href="{{ url('/') }}" class="text-white-50 text-decoration-none small">&larr; Kembali ke Beranda</a>
</div>
@endsection