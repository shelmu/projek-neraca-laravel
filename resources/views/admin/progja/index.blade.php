@extends('layouts.main')

@section('title', 'Kelola Program Kerja')

@section('content')
<div class="container my-5">
    
    <!-- Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold text-white">Manajemen Program Kerja</h2>
        <a href="{{ route('dashboard.admin') }}" class="btn btn-outline-light">
            <i class="bi bi-arrow-left me-1"></i> Kembali
        </a>
    </div>

    <!-- BAGIAN 1: WIDGET RINGKASAN (Dark Mode) -->
    <div class="row mb-4 g-3">
        <!-- Total -->
        <div class="col-md-4">
            <div class="card h-100 bg-dark border-secondary shadow-sm">
                <div class="card-body border-start border-4 border-primary">
                    <div class="text-uppercase fw-bold text-primary small">Total Program Kerja</div>
                    <div class="h2 mb-0 fw-bold text-white">{{ $total_progja }}</div>
                </div>
            </div>
        </div>
        <!-- Selesai -->
        <div class="col-md-4">
            <div class="card h-100 bg-dark border-secondary shadow-sm">
                <div class="card-body border-start border-4 border-success">
                    <div class="text-uppercase fw-bold text-success small">Selesai</div>
                    <div class="h2 mb-0 fw-bold text-white">{{ $progja_selesai }}</div>
                </div>
            </div>
        </div>
        <!-- Belum Selesai -->
        <div class="col-md-4">
            <div class="card h-100 bg-dark border-secondary shadow-sm">
                <div class="card-body border-start border-4 border-danger">
                    <div class="text-uppercase fw-bold text-danger small">Belum Selesai</div>
                    <div class="h2 mb-0 fw-bold text-white">{{ $progja_belum_selesai }}</div>
                </div>
            </div>
        </div>
    </div>

    <hr class="border-secondary my-4">

    <!-- BAGIAN 2: TABEL DATA -->
    <div class="card bg-dark border-secondary shadow-sm">
        <div class="card-header bg-transparent border-secondary py-3 d-flex justify-content-between align-items-center">
            <h5 class="m-0 fw-bold text-white">Daftar Program Kerja</h5>
            
            <div>
                <!-- Tombol Cetak PDF -->
                <a href="{{ route('progja.pdf') }}" class="btn btn-danger me-2" target="_blank">
                    <i class="bi bi-file-earmark-pdf-fill me-1"></i> PDF
                </a>
                <!-- Tombol Tambah -->
                <a href="{{ route('progja.create') }}" class="btn btn-primary">
                    <i class="bi bi-plus-lg me-1"></i> Tambah Progja
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
                            <th class="ps-4">No</th>
                            <th>Nama Progja</th>
                            <th>Divisi PJ</th>
                            <th>Target Selesai</th>
                            <th>Realisasi</th>
                            <th>Status</th>
                            <th class="text-end pe-4">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($progja as $index => $item)
                        <tr>
                            <td class="ps-4 text-secondary">{{ $index + 1 }}</td>
                            <td class="fw-bold">{{ $item->nama_progja }}</td>
                            <td><span class="badge bg-secondary">{{ $item->divisi_induk }}</span></td>
                            <td>{{ date('d M Y', strtotime($item->target_selesai)) }}</td>
                            <td>{{ $item->realisasi_tanggal == 'N/A' ? '-' : $item->realisasi_tanggal }}</td>
                            <td>
                                @if($item->status == 'Selesai')
                                    <span class="badge bg-success">Selesai</span>
                                @else
                                    <span class="badge bg-danger">Belum Selesai</span>
                                @endif
                            </td>
                            <td class="text-end pe-4">
                                <div class="d-flex justify-content-end gap-2">
                                    <!-- Tombol Detail -->
                                    <a href="{{ route('progja.show', $item->id_progja) }}" class="btn btn-sm btn-info text-white" title="Lihat Detail">
                                        <i class="bi bi-eye-fill"></i>
                                    </a>

                                    <!-- Tombol Edit -->
                                    <a href="{{ route('progja.edit', $item->id_progja) }}" class="btn btn-sm btn-warning text-dark" title="Edit Data">
                                        <i class="bi bi-pencil-square"></i>
                                    </a>
                                    
                                    <!-- Tombol Hapus -->
                                    <form action="{{ route('progja.destroy', $item->id_progja) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus {{ $item->nama_progja }}?');">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger" title="Hapus Data">
                                            <i class="bi bi-trash-fill"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="7" class="text-center py-5 text-muted">
                                <i class="bi bi-inbox fs-1 d-block mb-3"></i>
                                Belum ada Program Kerja.
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