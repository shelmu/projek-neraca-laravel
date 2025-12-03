<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Akun - Laravel</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

    <div class="container d-flex justify-content-center align-items-center min-vh-100">
        <div class="col-md-5 col-lg-4">
            <div class="card shadow-lg p-4 border-0">
                <div class="card-body">
                    <h2 class="card-title text-center mb-2 fw-bold">Daftar Akun</h2>
                    <p class="text-center text-muted mb-4">Silakan lengkapi data diri Anda</p>

                    <!-- Menampilkan Error Validasi -->
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ url('/register') }}" method="POST">
                        @csrf 

                        <div class="mb-3">
                            <label for="nim" class="form-label">NIM</label>
                            <input type="text" class="form-control" id="nim" name="nim" 
                                   placeholder="Masukkan NIM" value="{{ old('nim') }}" required autofocus>
                        </div>

                        <div class="mb-3">
                            <label for="nama" class="form-label">Nama Lengkap</label>
                            <input type="text" class="form-control" id="nama" name="nama" 
                                   placeholder="Masukkan Nama Lengkap" value="{{ old('nama') }}" required>
                        </div>

                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" class="form-control" id="password" name="password" 
                                   placeholder="Minimal 6 karakter" required>
                        </div>

                        <div class="d-grid gap-2 mt-4">
                            <button type="submit" class="btn btn-success btn-lg">Daftar Sekarang</button>
                        </div>
                        
                        <div class="text-center mt-4">
                            <p class="mb-1">Sudah punya akun?</p>
                            <a href="{{ route('login') }}" class="text-decoration-none fw-bold">Login di sini</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
```

### 4. Hubungkan Tombol Register di Login
Terakhir, pastikan tombol "Daftar Sekarang" di halaman **Login** mengarah ke rute yang benar.

Buka **`resources/views/login.blade.php`**, cari bagian link daftar, dan pastikan kodenya seperti ini:

```html
<a href="{{ route('register') }}" class="text-decoration-none fw-bold">Daftar Sekarang</a>