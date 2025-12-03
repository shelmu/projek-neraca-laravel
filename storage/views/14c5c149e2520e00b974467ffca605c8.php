

<?php $__env->startSection('title', 'Dashboard Admin'); ?>

<?php $__env->startSection('content'); ?>
<div class="container my-5">
    <!-- Header -->
    <div class="mb-5 text-center">
        <h1 class="display-5 fw-bold text-white">Dashboard Administrator</h1>
        <p class="lead text-secondary">Silakan pilih menu di bawah untuk mengelola data.</p>
    </div>
    
    <!-- Grid Menu -->
    <div class="row g-4 justify-content-center">
        
        <!-- MENU 1: KELOLA ANGGOTA -->
        <div class="col-md-4">
            <div class="card h-100 bg-dark border-secondary shadow-sm hover-effect">
                <div class="card-body text-center p-5">
                    <div class="mb-3">
                        <i class="bi bi-people-fill display-4 text-warning"></i>
                    </div>
                    <h3 class="card-title text-white">Kelola Anggota</h3>
                    <p class="card-text text-secondary">Lihat daftar, tambah anggota baru, edit, atau hapus data pengguna.</p>
                    
                    <a href="<?php echo e(route('anggota.index')); ?>" class="btn btn-outline-warning btn-lg w-100 mt-3">
                        Buka Menu
                    </a>
                </div>
            </div>
        </div>
        
        <!-- MENU 2: KELOLA KAS -->
        <div class="col-md-4">
            <div class="card h-100 bg-dark border-secondary shadow-sm hover-effect">
                <div class="card-body text-center p-5">
                    <div class="mb-3">
                        <i class="bi bi-wallet2 display-4 text-success"></i>
                    </div>
                    <h3 class="card-title text-white">Kelola Kas</h3>
                    <p class="card-text text-secondary">Catat pemasukan dan pengeluaran keuangan organisasi.</p>
                    
                    <a href="<?php echo e(route('kas.index')); ?>" class="btn btn-outline-success btn-lg w-100 mt-3">
                        Buka Menu
                    </a>
                </div>
            </div>
        </div>

        <!-- MENU 3: PROGRAM KERJA -->
        <div class="col-md-4">
            <div class="card h-100 bg-dark border-secondary shadow-sm hover-effect">
                <div class="card-body text-center p-5">
                    <div class="mb-3">
                        <i class="bi bi-list-task display-4 text-danger"></i>
                    </div>
                    <h3 class="card-title text-white">Program Kerja</h3>
                    <p class="card-text text-secondary">Pantau progres dan status program kerja divisi.</p>
                    
                    <a href="<?php echo e(route('progja.index')); ?>" class="btn btn-outline-danger btn-lg w-100 mt-3">
                        Buka Menu
                    </a>
                </div>
            </div>
        </div>

    </div>
</div>

<style>
    /* Efek hover sedikit naik */
    .hover-effect { transition: transform 0.3s; }
    .hover-effect:hover { transform: translateY(-5px); border-color: #ffc107 !important; }
</style>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\projek-neraca\resources\views/dashboard/admin.blade.php ENDPATH**/ ?>