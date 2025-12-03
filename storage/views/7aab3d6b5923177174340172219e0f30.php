

<?php $__env->startSection('title', 'Edit Anggota'); ?>

<?php $__env->startSection('content'); ?>
<div class="container my-5" style="max-width: 600px;">
    
    <!-- Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="text-white fw-bold">Edit Anggota</h2>
        <a href="<?php echo e(route('anggota.index')); ?>" class="btn btn-outline-secondary">
            <i class="bi bi-arrow-left me-1"></i> Kembali
        </a>
    </div>

    <!-- Card Form Dark -->
    <div class="card bg-dark border-secondary shadow-sm">
        <div class="card-header bg-warning text-dark border-bottom border-warning">
            <h5 class="mb-0 fw-bold"><i class="bi bi-pencil-square me-2"></i> Edit Data: <?php echo e($user->nama); ?></h5>
        </div>
        <div class="card-body">
            
            <form action="<?php echo e(route('anggota.update', $user->id)); ?>" method="POST">
                <?php echo csrf_field(); ?>
                <?php echo method_field('PUT'); ?>
                
                <div class="mb-3">
                    <label class="form-label text-secondary">Nomor Induk Mahasiswa (NIM)</label>
                    <input type="text" name="nim" class="form-control bg-dark text-white border-secondary" value="<?php echo e(old('nim', $user->nim)); ?>" required>
                </div>
                
                <div class="mb-3">
                    <label class="form-label text-secondary">Nama Lengkap</label>
                    <input type="text" name="nama" class="form-control bg-dark text-white border-secondary" value="<?php echo e(old('nama', $user->nama)); ?>" required>
                </div>

                <div class="mb-3">
                    <label class="form-label text-secondary">Password Baru (Opsional)</label>
                    <input type="text" name="password" class="form-control bg-dark text-white border-secondary" placeholder="Kosongkan jika tidak ingin mengubah password">
                </div>

                <div class="mb-4">
                    <label class="form-label text-secondary">Role / Jabatan</label>
                    <select name="role" class="form-select bg-dark text-white border-secondary">
                        <option value="anggota" <?php echo e($user->role == 'anggota' ? 'selected' : ''); ?>>Anggota Biasa</option>
                        <option value="admin" <?php echo e($user->role == 'admin' ? 'selected' : ''); ?>>Administrator</option>
                    </select>
                </div>

                <div class="d-grid gap-2">
                    <button type="submit" class="btn btn-warning fw-bold text-dark">
                        <i class="bi bi-arrow-repeat me-1"></i> Update Data
                    </button>
                </div>
            </form>

        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\projek-neraca\resources\views/admin/anggota/edit.blade.php ENDPATH**/ ?>