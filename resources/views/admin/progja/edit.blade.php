@extends('layouts.main')

@section('title', 'Edit Program Kerja')

@section('content')
<div class="container my-5" style="max-width: 900px;">
    
    <!-- Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold text-white">Edit Program Kerja</h2>
        <a href="{{ route('progja.index') }}" class="btn btn-outline-light">
            <i class="bi bi-arrow-left me-1"></i> Kembali
        </a>
    </div>

    <div class="card bg-dark border-secondary shadow-sm">
        <div class="card-header bg-warning text-dark border-bottom border-secondary">
            <h5 class="mb-0 fw-bold"><i class="bi bi-pencil-square me-2"></i> Edit Data: {{ $progja->nama_progja }}</h5>
        </div>
        <div class="card-body">
            
            <form action="{{ route('progja.update', $progja->id_progja) }}" method="POST">
                @csrf
                @method('PUT')
                
                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label text-secondary">Nama Program Kerja</label>
                            <input type="text" name="nama_progja" class="form-control bg-dark text-white border-secondary" value="{{ $progja->nama_progja }}" required>
                        </div>
                        
                        <div class="mb-3">
                            <label class="form-label text-secondary">Divisi Induk</label>
                            <select class="form-select bg-dark text-white border-secondary" name="divisi_induk" required>
                                <option value="" disabled>Pilih Divisi</option>
                                @foreach (['Litbang', 'Redaksi', 'Organisasi', 'Kreatif', 'Humas', 'Keuangan'] as $divisi)
                                    <option value="{{ $divisi }}" {{ $progja->divisi_induk == $divisi ? 'selected' : '' }}>{{ $divisi }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label class="form-label text-secondary">Ketua Panitia</label>
                            <input type="text" name="ketua_panitia" class="form-control bg-dark text-white border-secondary" value="{{ $progja->ketua_panitia }}" required>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label text-secondary">Anggaran (Rp)</label>
                            <input type="number" name="anggaran" class="form-control bg-dark text-white border-secondary" value="{{ $progja->anggaran }}" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label text-secondary">Target Selesai</label>
                            <input type="date" name="target_selesai" class="form-control bg-dark text-white border-secondary" value="{{ $progja->target_selesai }}" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label text-warning">Tanggal Realisasi (Terlaksana)</label>
                            <!-- Value: Jika isinya 'N/A', kosongkan agar datepicker bersih. Jika ada tanggal, tampilkan. -->
                            <input type="date" name="realisasi_tanggal" class="form-control bg-dark text-white border-secondary" 
                                   value="{{ $progja->realisasi_tanggal == 'N/A' ? '' : $progja->realisasi_tanggal }}">
                            <div class="form-text text-muted">Isi jika kegiatan sudah selesai.</div>
                        </div>
                        
                        <div class="mb-3">
                            <label class="form-label text-secondary">Status Saat Ini</label>
                            <select name="status" class="form-select bg-dark text-white border-secondary" required>
                                <option value="Belum Selesai" {{ $progja->status == 'Belum Selesai' ? 'selected' : '' }}>Belum Selesai</option>
                                <option value="Selesai" {{ $progja->status == 'Selesai' ? 'selected' : '' }}>Selesai</option>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="mb-4">
                    <label class="form-label text-secondary">Deskripsi Lengkap</label>
                    <textarea name="deskripsi_progja" class="form-control bg-dark text-white border-secondary" rows="3" required>{{ $progja->deskripsi_progja }}</textarea>
                </div>

                <hr class="border-secondary">

                <h5 class="mb-3 text-warning">Susunan Kepanitiaan</h5>
                <div id="panitia_container" class="mb-3">
                    
                    @forelse($panitia as $p)
                        <div class="row g-2 mb-2 panitia-row border border-secondary p-2 rounded bg-black">
                            <div class="col-md-3">
                                <select class="form-select bg-dark text-white border-secondary" name="panitia_jabatan[]" required>
                                    <option value="Sekretaris Panitia" {{ $p->jabatan == 'Sekretaris Panitia' ? 'selected' : '' }}>Sekretaris Panitia</option>
                                    <option value="Bendahara Panitia" {{ $p->jabatan == 'Bendahara Panitia' ? 'selected' : '' }}>Bendahara Panitia</option>
                                    <option value="Koordinator" {{ $p->jabatan == 'Koordinator' ? 'selected' : '' }}>Koordinator</option>
                                    <option value="Anggota" {{ $p->jabatan == 'Anggota' ? 'selected' : '' }}>Anggota</option>
                                </select>
                            </div>
                            <div class="col-md-3">
                                <input type="text" class="form-control bg-dark text-white border-secondary" name="panitia_bidang[]" value="{{ $p->bidang }}" placeholder="Bidang" required>
                            </div>
                            <div class="col-md-5">
                                <input type="text" class="form-control bg-dark text-white border-secondary" name="panitia_nama[]" value="{{ $p->nama }}" placeholder="Nama Anggota" required>
                            </div>
                            <div class="col-md-1 d-grid">
                                <button type="button" class="btn btn-danger btn-remove-panitia"><i class="bi bi-trash"></i></button>
                            </div>
                        </div>
                    @empty
                        <div class="row g-2 mb-2 panitia-row border border-secondary p-2 rounded bg-black">
                            <div class="col-md-3">
                                <select class="form-select bg-dark text-white border-secondary" name="panitia_jabatan[]" required>
                                    <option value="" selected disabled>Jabatan...</option>
                                    <option value="Sekretaris Panitia">Sekretaris Panitia</option>
                                    <option value="Bendahara Panitia">Bendahara Panitia</option>
                                    <option value="Koordinator">Koordinator Bidang</option>
                                    <option value="Anggota">Anggota Bidang</option>
                                </select>
                            </div>
                            <div class="col-md-3">
                                <input type="text" class="form-control bg-dark text-white border-secondary" name="panitia_bidang[]" placeholder="Bidang" required>
                            </div>
                            <div class="col-md-5">
                                <input type="text" class="form-control bg-dark text-white border-secondary" name="panitia_nama[]" placeholder="Nama Anggota" required>
                            </div>
                            <div class="col-md-1 d-grid">
                                <button type="button" class="btn btn-danger btn-remove-panitia"><i class="bi bi-trash"></i></button>
                            </div>
                        </div>
                    @endforelse

                </div>
                
                <button type="button" id="add_panitia_btn" class="btn btn-outline-secondary btn-sm mt-2">
                    <i class="bi bi-plus-circle me-1"></i> Tambah Anggota Panitia
                </button>

                <div class="d-grid gap-2 mt-5">
                    <button type="submit" class="btn btn-warning btn-lg fw-bold text-dark">
                        <i class="bi bi-save me-1"></i> Update Program Kerja
                    </button>
                </div>

            </form>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const container = document.getElementById('panitia_container');
        const addButton = document.getElementById('add_panitia_btn');
        
        // Template Baris Baru (Sama dengan Create)
        const template = `
            <div class="row g-2 mb-2 panitia-row border border-secondary p-2 rounded bg-black">
                <div class="col-md-3">
                    <select class="form-select bg-dark text-white border-secondary" name="panitia_jabatan[]" required>
                        <option value="" selected disabled>Jabatan...</option>
                        <option value="Sekretaris Panitia">Sekretaris Panitia</option>
                        <option value="Bendahara Panitia">Bendahara Panitia</option>
                        <option value="Koordinator">Koordinator Bidang</option>
                        <option value="Anggota">Anggota Bidang</option>
                    </select>
                </div>
                <div class="col-md-3">
                    <input type="text" class="form-control bg-dark text-white border-secondary" name="panitia_bidang[]" placeholder="Bidang" required>
                </div>
                <div class="col-md-5">
                    <input type="text" class="form-control bg-dark text-white border-secondary" name="panitia_nama[]" placeholder="Nama Anggota" required>
                </div>
                <div class="col-md-1 d-grid">
                    <button type="button" class="btn btn-danger btn-remove-panitia"><i class="bi bi-trash"></i></button>
                </div>
            </div>
        `;

        container.addEventListener('click', function(e) {
            if (e.target.closest('.btn-remove-panitia')) {
                const row = e.target.closest('.panitia-row');
                if (container.children.length > 1) {
                     row.remove();
                } else {
                    alert("Minimal harus ada satu anggota panitia.");
                }
            }
        });

        addButton.addEventListener('click', function() {
            container.insertAdjacentHTML('beforeend', template);
        });
    });
</script>
@endsection