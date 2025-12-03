

<?php $__env->startSection('title', 'Tambah Anggota'); ?>

<?php $__env->startSection('content'); ?>
<div class="container my-5" style="max-width: 600px;">
    
    <!-- Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="text-white fw-bold">Tambah Anggota</h2>
        <a href="<?php echo e(route('anggota.index')); ?>" class="btn btn-outline-light">
            <i class="bi bi-arrow-left me-1"></i> Kembali
        </a>
    </div>

    <!-- Card Form Dark -->
    <div class="card bg-dark border-secondary shadow-sm">
        <div class="card-header bg-primary text-white border-bottom border-secondary">
            <h5 class="mb-0 fw-bold"><i class="bi bi-person-plus me-2"></i> Form Anggota Baru</h5>
        </div>
        <div class="card-body">
            
            <form action="<?php echo e(route('anggota.store')); ?>" method="POST">
                <?php echo csrf_field(); ?>
                
                <div class="mb-3">
                    <label class="form-label text-secondary">Nomor Induk Mahasiswa (NIM)</label>
                    <input type="text" name="nim" class="form-control bg-dark text-white border-secondary" placeholder="Masukkan NIM" required>
                </div>
                
                <div class="mb-3">
                    <label class="form-label text-secondary">Nama Lengkap</label>
                    <input type="text" name="nama" class="form-control bg-dark text-white border-secondary" placeholder="Masukkan Nama Lengkap" required>
                </div>

                <div class="mb-3">
                    <label class="form-label text-secondary">Password Default</label>
                    <input type="text" name="password" class="form-control bg-dark text-white border-secondary" value="123456" required>
                    <div class="form-text text-muted">Password default bisa diganti oleh pengguna nanti.</div>
                </div>

                <div class="mb-4">
                    <label class="form-label text-secondary">Role / Jabatan</label>
                    <select name="role" class="form-select bg-dark text-white border-secondary">
                        <option value="anggota">Anggota Biasa</option>
                        <option value="admin">Administrator</option>
                    </select>
                </div>

                <div class="d-grid gap-2">
                    <button type="submit" class="btn btn-primary fw-bold">
                        <i class="bi bi-save me-1"></i> Simpan Data
                    </button>
                </div>
            </form>

        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\projek-neraca\resources\views/admin/anggota/create.blade.php ENDPATH**/ ?>