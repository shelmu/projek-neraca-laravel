@extends('layouts.main')

@section('title', 'Selamat Datang')

@section('content')

<!-- ========================================== -->
<!-- BAGIAN 1: HERO SECTION (SAMBUTAN) -->
<!-- ========================================== -->
<div class="container d-flex align-items-center justify-content-center min-vh-100 text-center">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="mb-4">
                <i class="bi bi-wallet2 text-warning" style="font-size: 5rem;"></i>
            </div>

            <h1 class="display-3 fw-bold text-white mb-3">
                Sistem Informasi <span class="text-warning">NERACA</span>
            </h1>
            
            <p class="lead text-secondary mb-5">
                Portal terintegrasi untuk pengelolaan kas, transparansi anggaran, 
                dan monitoring program kerja organisasi mahasiswa secara real-time.
            </p>

            <div class="d-grid gap-3 d-sm-flex justify-content-sm-center mb-5">
                @guest
                    <a href="{{ route('login') }}" class="btn btn-warning btn-lg px-5 fw-bold text-dark rounded-pill">
                        Mulai Sekarang
                    </a>
                    <a href="#informasi" class="btn btn-outline-light btn-lg px-5 rounded-pill">
                        Lihat Fitur
                    </a>
                @else
                    <div class="alert alert-dark border-secondary d-inline-block px-5 py-3">
                        <i class="bi bi-check-circle-fill text-success me-2"></i> 
                        Halo, <strong>{{ Auth::user()->nama }}</strong>!
                    </div>
                    <div class="mt-3">
                        @if(Auth::user()->role == 'admin')
                            <a href="{{ route('dashboard.admin') }}" class="btn btn-warning fw-bold px-4 rounded-pill">Ke Dashboard Admin</a>
                        @else
                            <a href="{{ route('dashboard.anggota') }}" class="btn btn-warning fw-bold px-4 rounded-pill">Ke Dashboard Anggota</a>
                        @endif
                    </div>
                @endguest
            </div>
            
            <div class="mt-5 text-secondary">
                <p class="small mb-1">Scroll ke bawah</p>
                <i class="bi bi-chevron-down fs-4"></i>
            </div>
        </div>
    </div>
</div>

<hr class="border-secondary my-0">

<!-- ========================================== -->
<!-- BAGIAN 2: FITUR UNGGULAN (YANG LAMA) -->
<!-- ========================================== -->
<div id="informasi" class="py-5 bg-dark">
    <div class="container py-5">
        <div class="text-center mb-5">
            <h2 class="fw-bold text-white">Fitur Unggulan</h2>
            <p class="text-secondary">Apa yang bisa Anda lakukan di aplikasi ini?</p>
        </div>

        <div class="row g-4">
            <!-- Fitur 1 -->
            <div class="col-md-4">
                <div class="card h-100 bg-black border-secondary shadow-sm">
                    <div class="card-body text-center p-4">
                        <div class="mb-3">
                            <i class="bi bi-cash-stack fs-1 text-warning"></i>
                        </div>
                        <h4 class="card-title text-white">Manajemen Kas</h4>
                        <p class="card-text text-secondary">
                            Pencatatan uang masuk dan keluar yang transparan.
                        </p>
                    </div>
                </div>
            </div>
            <!-- Fitur 2 -->
            <div class="col-md-4">
                <div class="card h-100 bg-black border-secondary shadow-sm">
                    <div class="card-body text-center p-4">
                        <div class="mb-3">
                            <i class="bi bi-list-task fs-1 text-warning"></i>
                        </div>
                        <h4 class="card-title text-white">Program Kerja</h4>
                        <p class="card-text text-secondary">
                            Monitoring status pelaksanaan program kerja.
                        </p>
                    </div>
                </div>
            </div>
            <!-- Fitur 3 -->
            <div class="col-md-4">
                <div class="card h-100 bg-black border-secondary shadow-sm">
                    <div class="card-body text-center p-4">
                        <div class="mb-3">
                            <i class="bi bi-file-earmark-pdf-fill fs-1 text-warning"></i>
                        </div>
                        <h4 class="card-title text-white">Laporan PDF</h4>
                        <p class="card-text text-secondary">
                            Cetak laporan keuangan dan kegiatan otomatis.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<hr class="border-secondary my-0">

<!-- ========================================== -->
<!-- BAGIAN 3: GALERI (DARI NATIVE) -->
<!-- ========================================== -->
<section id="galeri" class="py-5 bg-black">
    <div class="container py-5">
        <h2 class="text-center mb-5 text-white fw-bold">GALERI LIPUTAN TERBAIK</h2>
        
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div id="neracaCarousel" class="carousel slide carousel-fade shadow-lg border border-secondary rounded" data-bs-ride="carousel">
                    
                    <div class="carousel-indicators">
                        <button type="button" data-bs-target="#neracaCarousel" data-bs-slide-to="0" class="active"></button>
                        <button type="button" data-bs-target="#neracaCarousel" data-bs-slide-to="1"></button>
                        <button type="button" data-bs-target="#neracaCarousel" data-bs-slide-to="2"></button>
                    </div>

                    <div class="carousel-inner rounded">
                        <!-- Item 1 -->
                        <div class="carousel-item active" data-bs-interval="5000">
                            <!-- Placeholder gambar abu-abu gelap -->
                            <div class="d-flex align-items-center justify-content-center bg-secondary text-white" style="height: 400px;">
                                    <img src="{{ asset('img/galeri/pjtd.jpg') }}" class="d-block w-100" alt="Pelatihan Jurnalistik">
                            </div>
                            <div class="carousel-caption d-none d-md-block bg-dark bg-opacity-75 rounded p-2">
                                <h5 class="text-warning fw-bold">Pelatihan Jurnalistik Tingkat Dasar (PJTD)</h5>
                                <p class="text-light small">Mencetak jurnalis muda yang berintegritas dan profesional.</p>
                            </div>
                        </div>
                        
                        <!-- Item 2 -->
                        <div class="carousel-item" data-bs-interval="5000">
                            <div class="d-flex align-items-center justify-content-center bg-secondary text-white" style="height: 400px;">
                                    <img src="{{ asset('img/galeri/aksi.jpg') }}" class="d-block w-100" alt="Pelatihan Jurnalistik">
                            </div>
                            <div class="carousel-caption d-none d-md-block bg-dark bg-opacity-75 rounded p-2">
                                <h5 class="text-warning fw-bold">Liputan Khusus Aksi Mahasiswa</h5>
                                <p class="text-light small">Mengabadikan momen penting pergerakan kampus.</p>
                            </div>
                        </div>
                        
                        <!-- Item 3 -->
                        <div class="carousel-item" data-bs-interval="5000">
                            <div class="d-flex align-items-center justify-content-center bg-secondary text-white" style="height: 400px;">
                                    <img src="{{ asset('img/galeri/wawancara.jpg') }}" class="d-block w-100" alt="Pelatihan Jurnalistik">
                            </div>
                            <div class="carousel-caption d-none d-md-block bg-dark bg-opacity-75 rounded p-2">
                                <h5 class="text-warning fw-bold">Diskusi Publik Redaksi</h5>
                                <p class="text-light small">Membahas isu nasional dan implikasinya bagi mahasiswa.</p>
                            </div>
                        </div>
                    </div>

                    <button class="carousel-control-prev" type="button" data-bs-target="#neracaCarousel" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#neracaCarousel" data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </button>
                </div>
            </div>
        </div>
    </div>
</section>

<hr class="border-secondary my-0">

<!-- ========================================== -->
<!-- BAGIAN 4: PRODUK JURNALISTIK (DARI NATIVE) -->
<!-- ========================================== -->
<section id="produk" class="py-5 bg-dark">
    <div class="container text-center py-5">
        <h2 class="mb-5 text-white fw-bold">PRODUK JURNALISTIK</h2>
        
        <div class="row g-4">
            <!-- Produk 1 -->
            <div class="col-md-4">
                <div class="card h-100 bg-black border-secondary shadow-sm">
                    <!-- Placeholder Gambar -->
                    <img src="{{ asset('img/produk/website.png') }}" alt="Website Neraca">
                    <div class="card-body">
                        <h5 class="card-title text-warning fw-bold">PORTAL BERITA ONLINE</h5>
                        <p class="card-text text-secondary small">Liputan cepat, akurat, dan aktual mengenai dinamika kampus dan isu regional.</p>
                        <a href="https://lpmneraca.com/" target="_blank" class="btn btn-outline-warning btn-sm mt-2 px-4">
                            Kunjungi Portal
                        </a>
                    </div>
                </div>
            </div>
            
            <!-- Produk 2 -->
            <div class="col-md-4">
                <div class="card h-100 bg-black border-secondary shadow-sm">
                    <img src="{{ asset('img/produk/majalah.jpg') }}" alt="Majalah Neraca">
                    <div class="card-body">
                        <h5 class="card-title text-warning fw-bold">MAJALAH TAHUNAN</h5>
                        <p class="card-text text-secondary small">Publikasi cetak eksklusif yang menyajikan investigasi dan esai mendalam.</p>
                        <a href="#" class="btn btn-outline-warning btn-sm mt-2 px-4">
                            Baca Edisi Terbaru
                        </a>
                    </div>
                </div>
            </div>
            
            <!-- Produk 3 -->
            <div class="col-md-4">
                <div class="card h-100 bg-black border-secondary shadow-sm">
                    <img src="{{ asset('img/produk/sosmed.png') }}" alt="Sosmed Neraca">
                    <div class="card-body">
                        <h5 class="card-title text-warning fw-bold">NERACA SOSIAL MEDIA</h5>
                        <p class="card-text text-secondary small">Berita, Liputan, infografis, dan konten audio-visual yang interaktif.</p>
                        <a href="https://www.instagram.com/neracapolmed/" target="_blank" class="btn btn-outline-warning btn-sm mt-2 px-4">
                            Ikuti Kami
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection