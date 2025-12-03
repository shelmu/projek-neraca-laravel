@extends('layouts.main')

@section('title', 'Detail Progja')

@section('content')
<div class="container my-5 flex-grow-1">
    
    <!-- Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold text-white">Detail Program Kerja: {{ $progja->nama_progja }}</h2>
        <a href="{{ route('progja.index') }}" class="btn btn-outline-light">
            <i class="bi bi-arrow-left me-1"></i> Kembali
        </a>
    </div>

    <div class="row">
        <div class="col-lg-12">
            
            <!-- KARTU 1: INFORMASI UTAMA -->
            <div class="card bg-dark border-secondary shadow-sm mb-4">
                <div class="card-header bg-warning text-dark fw-bold border-bottom border-secondary">
                    Informasi Utama
                </div>
                <div class="card-body">
                    <p class="mb-1 text-white"><strong>ID Proker:</strong> #{{ $progja->id_progja }}</p>
                    <p class="mb-1 text-white"><strong>Divisi Induk:</strong> {{ $progja->divisi_induk }}</p>
                    <p class="mb-1 text-white"><strong>Ketua Panitia:</strong> {{ $progja->ketua_panitia }}</p>
                    <p class="mb-1 text-white"><strong>Status:</strong> 
                        @if($progja->status == 'Selesai')
                            <span class="badge bg-success">SELESAI</span>
                        @else
                            <span class="badge bg-danger">BELUM SELESAI</span>
                        @endif
                    </p>
                    
                    <hr class="border-secondary my-2">
                    
                    <p class="mb-1 text-white"><strong>Realisasi Tanggal:</strong> {{ $progja->realisasi_tanggal }}</p>
                    <p class="mb-1 text-white"><strong>Target Selesai:</strong> {{ date('d M Y', strtotime($progja->target_selesai)) }}</p>
                </div>
            </div>

            <!-- KARTU 2: ANGGARAN & DESKRIPSI -->
            <div class="card bg-dark border-secondary shadow-sm mb-4">
                <div class="card-header bg-secondary text-white border-bottom border-secondary">
                    Anggaran dan Deskripsi
                </div>
                <div class="card-body">
                    <p class="lead text-white"><strong>Anggaran Biaya:</strong> <span class="fw-bold text-success">Rp {{ number_format($progja->anggaran, 0, ',', '.') }}</span></p>
                    <hr class="border-secondary">
                    <h5 class="text-white">Deskripsi Proyek:</h5>
                    <p class="text-white">{!! nl2br(e($progja->deskripsi_progja)) !!}</p>
                </div>
            </div>
            
            <!-- TOMBOL AKSI -->
            <div class="d-flex justify-content-start gap-3 mb-5">
                <a href="{{ route('progja.detail.pdf', $progja->id_progja) }}" class="btn btn-success" target="_blank">
                    <i class="bi bi-file-pdf-fill me-1"></i> Unduh Laporan PDF
                </a>
                
                <a href="{{ route('progja.edit', $progja->id_progja) }}" class="btn btn-warning text-dark">
                    <i class="bi bi-pencil-square me-1"></i> Edit Progja
                </a>
                
                <form action="{{ route('progja.destroy', $progja->id_progja) }}" method="POST" onsubmit="return confirm('Yakin hapus progja ini?');">
                    @csrf @method('DELETE')
                    <button type="submit" class="btn btn-danger">
                        <i class="bi bi-trash me-1"></i> Hapus Progja
                    </button>
                </form>
            </div>
            
            <h4 class="mb-3 text-warning border-bottom border-secondary pb-2">Susunan Panitia</h4>
            <div class="row">
                
                <!-- DAFTAR BPH (INTI) -->
                <div class="col-12 mb-4">
                    <div class="card bg-dark border-secondary shadow-sm">
                        <div class="card-header bg-black text-warning border-bottom border-secondary fw-bold">
                            BADAN PENGURUS HARIAN (BPH)
                        </div>
                        <ul class="list-group list-group-flush">
                            @foreach($inti as $anggota)
                                <li class="list-group-item bg-dark text-white border-secondary d-flex justify-content-between align-items-center">
                                    <span class="badge bg-primary me-2">{{ strtoupper($anggota['jabatan']) }}</span>
                                    <strong>{{ $anggota['nama'] }}</strong>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
                
                <!-- DAFTAR BIDANG (LOOPING) -->
                @foreach($bidang_lain as $nama_bidang => $anggota_list)
                    <div class="col-md-6 mb-4">
                        <div class="card bg-dark border-secondary shadow-sm">
                            <div class="card-header bg-secondary text-white border-bottom border-secondary fw-bold">
                                BIDANG: {{ strtoupper($nama_bidang) }}
                            </div>
                            <ul class="list-group list-group-flush">
                                @foreach($anggota_list as $anggota)
                                    <li class="list-group-item bg-dark text-white border-secondary d-flex justify-content-between align-items-center">
                                        <div class="fw-bold text-secondary">{{ $anggota->jabatan }}</div>
                                        <div>{{ $anggota->nama }}</div>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                @endforeach

            </div>
        </div>
    </div>
</div>
@endsection