@extends('layouts.main')

@section('title', 'Input Program Kerja')

@section('content')
<div class="container my-5" style="max-width: 900px;">
    
    <!-- Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold text-white">Input Program Kerja Baru</h2>
        <a href="{{ route('progja.index') }}" class="btn btn-outline-light">
            <i class="bi bi-arrow-left me-1"></i> Kembali
        </a>
    </div>

    <div class="card bg-dark border-secondary shadow-sm">
        <div class="card-header bg-primary text-white border-bottom border-secondary">
            <h5 class="mb-0 fw-bold"><i class="bi bi-folder-plus me-2"></i> Informasi Proyek dan Anggaran</h5>
        </div>
        <div class="card-body">
            
            <form action="{{ route('progja.store') }}" method="POST" id="formCreateProgja">
                @csrf 

                <div class="row">
                    <!-- KOLOM KIRI -->
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label text-secondary">Nama Program Kerja</label>
                            <input type="text" class="form-control bg-dark text-white border-secondary" name="nama_progja" required placeholder="Contoh: PJTD Angkatan XI">
                        </div>
                        
                        <div class="mb-3">
                            <label class="form-label text-secondary">Divisi Induk/Pengelola</label>
                            <select class="form-select bg-dark text-white border-secondary" name="divisi_induk" required>
                                <option value="" selected disabled>Pilih Divisi</option>
                                @foreach (['Litbang', 'Redaksi', 'Organisasi', 'Kreatif', 'Humas', 'Keuangan'] as $divisi)
                                    <option value="{{ $divisi }}">{{ $divisi }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label class="form-label text-secondary">Ketua Panitia (PJ)</label>
                            <input type="text" class="form-control bg-dark text-white border-secondary" name="ketua_panitia" required placeholder="Nama Ketua Panitia">
                        </div>
                    </div>

                    <!-- KOLOM KANAN -->
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label text-secondary">Anggaran Biaya (Rp)</label>
                            <input type="number" class="form-control bg-dark text-white border-secondary" name="anggaran" required placeholder="Contoh: 1500000">
                        </div>
                        
                        <div class="mb-3">
                            <label class="form-label text-secondary">Target Tanggal Selesai</label>
                            <input type="date" class="form-control bg-dark text-white border-secondary" name="target_selesai" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label text-secondary">Status Awal</label>
                            <select class="form-select bg-dark text-white border-secondary" name="status" required>
                                <option value="Belum Selesai" selected>Belum Selesai</option>
                                <option value="Selesai">Selesai</option>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="mb-4">
                    <label class="form-label text-secondary">Deskripsi Lengkap Program Kerja</label>
                    <textarea class="form-control bg-dark text-white border-secondary" name="deskripsi_progja" rows="3" placeholder="Jelaskan tujuan dan ruang lingkup." required></textarea>
                </div>

                <hr class="border-secondary">

                <!-- BAGIAN DINAMIS PANITIA -->
                <h5 class="mb-3 text-warning">Susunan Kepanitiaan (Inti & Bidang)</h5>
                <p class="text-secondary small">Isi data untuk Sekretaris, Bendahara, dan Koordinator Bidang lainnya.</p>

                <div id="panitia_container" class="mb-3">
                    <!-- Baris Pertama Default -->
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
                </div>
                
                <button type="button" id="add_panitia_btn" class="btn btn-outline-secondary btn-sm mt-2">
                    <i class="bi bi-plus-circle me-1"></i> Tambah Anggota Panitia
                </button>

                <div class="d-grid gap-2 mt-5">
                    <button type="submit" class="btn btn-primary btn-lg fw-bold">
                        <i class="bi bi-save me-1"></i> Simpan Program Kerja
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
        
        // Template baris baru (Dark Mode)
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