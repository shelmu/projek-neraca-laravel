@extends('layouts.main')

@section('title', 'Tambah Transaksi')

@section('content')
<div class="container my-5" style="max-width: 700px;">
    
    <!-- Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="text-white fw-bold">Tambah Transaksi</h2>
        <a href="{{ route('kas.index') }}" class="btn btn-outline-light">
            <i class="bi bi-arrow-left me-1"></i> Kembali
        </a>
    </div>

    <div class="card bg-dark border-secondary shadow-sm">
        <div class="card-header bg-success text-white border-bottom border-secondary">
            <h5 class="mb-0 fw-bold"><i class="bi bi-wallet2 me-2"></i> Catat Transaksi Baru</h5>
        </div>
        <div class="card-body">
            
            <form action="{{ route('kas.store') }}" method="POST">
                @csrf
                
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label class="form-label text-secondary">Tanggal Transaksi</label>
                        <input type="date" name="tanggal_transaksi" class="form-control bg-dark text-white border-secondary" value="{{ date('Y-m-d') }}" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label text-secondary">Jenis Transaksi</label>
                        <select name="jenis" class="form-select bg-dark text-white border-secondary" required>
                            <option value="masuk">Pemasukan (Uang Masuk)</option>
                            <option value="keluar">Pengeluaran (Uang Keluar)</option>
                        </select>
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label text-secondary">Nominal (Rp)</label>
                    <input type="number" name="nominal" class="form-control bg-dark text-white border-secondary" placeholder="Contoh: 50000" min="0" required>
                </div>

                <div class="mb-3">
                    <label class="form-label text-secondary">Deskripsi / Keterangan</label>
                    <textarea name="deskripsi" class="form-control bg-dark text-white border-secondary" rows="2" placeholder="Contoh: Iuran anggota bulan November" required></textarea>
                </div>

                <div class="row mb-4">
                    <div class="col-md-6">
                        <label class="form-label text-secondary">Divisi</label>
                        <input type="text" name="divisi" class="form-control bg-dark text-white border-secondary" placeholder="Contoh: Bendahara / Umum" required>
                    </div>
                    
                    <div class="col-md-6">
                        <label class="form-label text-secondary">Nama Anggota / PIC</label>
                        <!-- Input Searchable dengan style dark -->
                        <input class="form-control bg-dark text-white border-secondary" list="listAnggota" name="nama_anggota" placeholder="Ketik nama untuk mencari..." autocomplete="off">
                        
                        <datalist id="listAnggota">
                            @foreach($users as $user)
                                <option value="{{ $user->nama }}">
                            @endforeach
                        </datalist>
                        
                        <div class="form-text text-muted">Otomatis muncul saat diketik.</div>
                    </div>
                </div>

                <div class="d-grid gap-2">
                    <button type="submit" class="btn btn-success fw-bold">
                        <i class="bi bi-save me-1"></i> Simpan Transaksi
                    </button>
                </div>
            </form>

        </div>
    </div>
</div>
@endsection