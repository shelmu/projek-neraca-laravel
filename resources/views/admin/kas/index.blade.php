@extends('layouts.main')

@section('title', 'Kelola Kas')

@section('content')
<div class="container my-5">
    
    <!-- Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold text-white">Manajemen Data Kas</h2>
        <a href="{{ route('dashboard.admin') }}" class="btn btn-outline-light">
            <i class="bi bi-arrow-left me-1"></i> Kembali
        </a>
    </div>

    <!-- BAGIAN 1: WIDGET RINGKASAN SALDO (Dark Mode) -->
    <div class="row mb-4 g-3">
        <!-- Total Masuk -->
        <div class="col-md-4">
            <div class="card h-100 bg-dark border-secondary shadow-sm">
                <div class="card-body border-start border-4 border-success">
                    <div class="text-uppercase fw-bold text-success small">Total Kas Masuk</div>
                    <div class="h3 mb-0 fw-bold text-white">
                        Rp {{ number_format($totalMasuk, 0, ',', '.') }}
                    </div>
                </div>
            </div>
        </div>

        <!-- Total Keluar -->
        <div class="col-md-4">
            <div class="card h-100 bg-dark border-secondary shadow-sm">
                <div class="card-body border-start border-4 border-danger">
                    <div class="text-uppercase fw-bold text-danger small">Total Kas Keluar</div>
                    <div class="h3 mb-0 fw-bold text-white">
                        Rp {{ number_format($totalKeluar, 0, ',', '.') }}
                    </div>
                </div>
            </div>
        </div>

        <!-- Saldo Akhir -->
        <div class="col-md-4">
            <div class="card h-100 bg-dark border-secondary shadow-sm">
                <div class="card-body border-start border-4 border-primary">
                    <div class="text-uppercase fw-bold text-primary small">SALDO AKHIR</div>
                    <div class="h3 mb-0 fw-bold {{ $saldoAkhir < 0 ? 'text-danger' : 'text-white' }}">
                        Rp {{ number_format($saldoAkhir, 0, ',', '.') }}
                    </div>
                </div>
            </div>
        </div>
    </div>

    <hr class="border-secondary my-4">

    <!-- BAGIAN 2: TABEL TRANSAKSI -->
    <div class="card bg-dark border-secondary shadow-sm">
        <div class="card-header bg-transparent border-secondary py-3 d-flex justify-content-between align-items-center">
            <h5 class="m-0 fw-bold text-white">Daftar Transaksi</h5>
            
            <div>
                <!-- Tombol Cetak PDF -->
                <a href="{{ route('kas.pdf') }}" class="btn btn-danger me-2" target="_blank">
                    <i class="bi bi-file-earmark-pdf-fill me-1"></i> PDF
                </a>
                <!-- Tombol Tambah -->
                <a href="{{ route('kas.create') }}" class="btn btn-primary">
                    <i class="bi bi-plus-circle-fill me-1"></i> Catat Baru
                </a>
            </div>
        </div>

        <div class="card-body p-0">
            @if(session('success'))
                <div class="alert alert-success m-3 alert-dismissible fade show" role="alert">
                    <i class="bi bi-check-circle-fill me-2"></i> {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <div class="table-responsive">
                <table class="table table-dark table-hover mb-0 align-middle">
                    <thead>
                        <tr>
                            <th class="ps-4">Tanggal</th>
                            <th>Jenis</th>
                            <th>Deskripsi</th>
                            <th>Divisi/PIC</th>
                            <th class="text-end">Nominal</th>
                            <th class="text-end pe-4">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($dataKas as $item)
                        <tr>
                            <td class="ps-4 text-secondary">{{ date('d-m-Y', strtotime($item->tanggal_transaksi)) }}</td>
                            <td>
                                @if($item->jenis == 'masuk')
                                    <span class="badge bg-success text-uppercase">Pemasukan</span>
                                @else
                                    <span class="badge bg-danger text-uppercase">Pengeluaran</span>
                                @endif
                            </td>
                            <td>{{ $item->deskripsi }}</td>
                            <td>
                                <span class="badge bg-secondary">{{ $item->divisi }}</span><br>
                                <small class="text-secondary">{{ $item->nama_anggota }}</small>
                            </td>
                            <td class="text-end fw-bold {{ $item->jenis == 'masuk' ? 'text-success' : 'text-danger' }}">
                                {{ $item->jenis == 'masuk' ? '+' : '-' }} 
                                Rp {{ number_format($item->nominal, 0, ',', '.') }}
                            </td>
                            <td class="text-end pe-4">
                                <div class="d-flex justify-content-end gap-2">
                                    <a href="{{ route('kas.edit', $item->id_kas) }}" class="btn btn-sm btn-warning text-dark" title="Edit">
                                        <i class="bi bi-pencil-square"></i>
                                    </a>
                                    <form action="{{ route('kas.destroy', $item->id_kas) }}" method="POST" onsubmit="return confirm('Hapus transaksi ini?');">
                                        @csrf 
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger" title="Hapus">
                                            <i class="bi bi-trash-fill"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="text-center py-5 text-muted">
                                <i class="bi bi-inbox fs-1 d-block mb-3"></i>
                                Belum ada data transaksi kas yang tercatat.
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection