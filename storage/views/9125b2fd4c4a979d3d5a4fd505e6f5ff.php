

<?php $__env->startSection('title', 'Edit Transaksi'); ?>

<?php $__env->startSection('content'); ?>
<div class="container my-5" style="max-width: 700px;">
    
    <!-- Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="text-white fw-bold">Edit Transaksi</h2>
        <a href="<?php echo e(route('kas.index')); ?>" class="btn btn-outline-light">
            <i class="bi bi-arrow-left me-1"></i> Kembali
        </a>
    </div>

    <div class="card bg-dark border-secondary shadow-sm">
        <div class="card-header bg-warning text-dark border-bottom border-secondary">
            <h5 class="mb-0 fw-bold"><i class="bi bi-pencil-square me-2"></i> Edit Data Transaksi</h5>
        </div>
        <div class="card-body">
            
            <form action="<?php echo e(route('kas.update', $kas->id_kas)); ?>" method="POST">
                <?php echo csrf_field(); ?>
                <?php echo method_field('PUT'); ?> 
                
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label class="form-label text-secondary">Tanggal Transaksi</label>
                        <input type="date" name="tanggal_transaksi" class="form-control bg-dark text-white border-secondary" 
                               value="<?php echo e(old('tanggal_transaksi', $kas->tanggal_transaksi)); ?>" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label text-secondary">Jenis Transaksi</label>
                        <select name="jenis" class="form-select bg-dark text-white border-secondary" required>
                            <option value="masuk" <?php echo e($kas->jenis == 'masuk' ? 'selected' : ''); ?>>Pemasukan</option>
                            <option value="keluar" <?php echo e($kas->jenis == 'keluar' ? 'selected' : ''); ?>>Pengeluaran</option>
                        </select>
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label text-secondary">Nominal (Rp)</label>
                    <input type="number" name="nominal" class="form-control bg-dark text-white border-secondary" 
                           value="<?php echo e(old('nominal', $kas->nominal)); ?>" min="0" required>
                </div>

                <div class="mb-3">
                    <label class="form-label text-secondary">Deskripsi / Keterangan</label>
                    <textarea name="deskripsi" class="form-control bg-dark text-white border-secondary" rows="2" required><?php echo e(old('deskripsi', $kas->deskripsi)); ?></textarea>
                </div>

                <div class="row mb-4">
                    <div class="col-md-6">
                        <label class="form-label text-secondary">Divisi</label>
                        <input type="text" name="divisi" class="form-control bg-dark text-white border-secondary" 
                               value="<?php echo e(old('divisi', $kas->divisi)); ?>" required>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label text-secondary">Nama Anggota / PIC</label>
                        <input class="form-control bg-dark text-white border-secondary" list="listAnggota" name="nama_anggota" 
                               placeholder="Ketik nama untuk mencari..." 
                               value="<?php echo e(old('nama_anggota', $kas->nama_anggota)); ?>" autocomplete="off">
                        
                        <datalist id="listAnggota">
                            <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($user->nama); ?>">
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </datalist>
                        
                        <div class="form-text text-muted">Ketik untuk mengganti nama anggota.</div>
                    </div>
                </div>

                <div class="d-grid gap-2">
                    <button type="submit" class="btn btn-warning fw-bold text-dark">
                        <i class="bi bi-arrow-repeat me-1"></i> Update Transaksi
                    </button>
                </div>
            </form>

        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\projek-neraca\resources\views/admin/kas/edit.blade.php ENDPATH**/ ?>