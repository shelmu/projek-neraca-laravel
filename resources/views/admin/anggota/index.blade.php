@extends('layouts.main')

@section('title', 'Kelola Anggota')

@section('content')
<div class="container my-5">
    
    <!-- Header Halaman -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold text-white">Manajemen Anggota</h2>
        <a href="{{ route('dashboard.admin') }}" class="btn btn-outline-light">
            <i class="bi bi-arrow-left me-1"></i> Kembali
        </a>
    </div>

    <!-- BAGIAN 1: WIDGET RINGKASAN (Gaya Dark Mode) -->
    <div class="row mb-4 g-3">
        <!-- Total User -->
        <div class="col-md-4">
            <div class="card h-100 bg-dark border-secondary shadow-sm">
                <div class="card-body border-start border-4 border-primary">
                    <div class="text-uppercase fw-bold text-primary small">Total Pengguna</div>
                    <div class="h2 mb-0 fw-bold text-white">{{ $total_user }}</div>
                </div>
            </div>
        </div>
        <!-- Total Admin -->
        <div class="col-md-4">
            <div class="card h-100 bg-dark border-secondary shadow-sm">
                <div class="card-body border-start border-4 border-danger">
                    <div class="text-uppercase fw-bold text-danger small">Administrator</div>
                    <div class="h2 mb-0 fw-bold text-white">{{ $total_admin }}</div>
                </div>
            </div>
        </div>
        <!-- Total Anggota Biasa -->
        <div class="col-md-4">
            <div class="card h-100 bg-dark border-secondary shadow-sm">
                <div class="card-body border-start border-4 border-success">
                    <div class="text-uppercase fw-bold text-success small">Anggota Biasa</div>
                    <div class="h2 mb-0 fw-bold text-white">{{ $total_anggota }}</div>
                </div>
            </div>
        </div>
    </div>

    <hr class="border-secondary my-4">

    <!-- BAGIAN 2: TABEL DATA -->
    <div class="card bg-dark border-secondary shadow-sm">
        <div class="card-header bg-transparent border-secondary py-3 d-flex justify-content-between align-items-center">
            <h5 class="m-0 fw-bold text-white">Daftar Anggota</h5>
            <!-- Tombol Tambah -->
            <a href="{{ route('anggota.create') }}" class="btn btn-primary">
                <i class="bi bi-person-plus-fill me-1"></i> Tambah Anggota
            </a>
        </div>

        <div class="card-body p-0">
            <!-- Pesan Sukses -->
            @if(session('success'))
                <div class="alert alert-success m-3 alert-dismissible fade show" role="alert">
                    <i class="bi bi-check-circle-fill me-2"></i> {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <div class="table-responsive">
                <!-- Tabel Dark Mode -->
                <table class="table table-dark table-hover mb-0 align-middle">
                    <thead>
                        <tr>
                            <th class="ps-4">NIM</th>
                            <th>Nama Lengkap</th>
                            <th>Role</th>
                            <th class="text-end pe-4">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($users as $user)
                        <tr>
                            <td class="ps-4 fw-bold text-secondary">{{ $user->nim }}</td>
                            <td>{{ $user->nama }}</td>
                            <td>
                                <!-- Badge Role -->
                                @if($user->role == 'admin')
                                    <span class="badge bg-danger text-uppercase">Admin</span>
                                @else
                                    <span class="badge bg-success text-uppercase">Anggota</span>
                                @endif
                            </td>
                            <td class="text-end pe-4">
                                <div class="d-flex justify-content-end gap-2">
                                    <!-- TOMBOL EDIT -->
                                    <a href="{{ route('anggota.edit', $user->id) }}" class="btn btn-sm btn-warning text-dark" title="Edit Data">
                                        <i class="bi bi-pencil-square"></i>
                                    </a>

                                    <!-- TOMBOL HAPUS -->
                                    <form action="{{ route('anggota.destroy', $user->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus data {{ $user->nama }}?');">
                                        @csrf
                                        @method('DELETE') 
                                        <button type="submit" class="btn btn-sm btn-danger" title="Hapus Permanen">
                                            <i class="bi bi-trash-fill"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" class="text-center py-5 text-muted">
                                <i class="bi bi-inbox fs-1 d-block mb-3"></i>
                                Belum ada data anggota.
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