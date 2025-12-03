 


<?php $__env->startSection('content'); ?>
<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2>Daftar Transaksi Kas</h2>
        <a href="<?php echo e(route('kas.create')); ?>" class="btn btn-primary">
            <i class="fas fa-plus"></i> Tambah Kas Baru
        </a>
    </div>

    
    <?php if(session('success')): ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <?php echo e(session('success')); ?>

            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php endif; ?>

    <div class="table-responsive">
        <table class="table table-striped table-hover">
            <thead>
                <tr>
                    <th>No.</th>
                    <th>Tanggal</th>
                    <th>Jenis</th>
                    <th>Divisi</th>
                    <th>Nominal</th>
                    <th>Deskripsi</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php $__empty_1 = true; $__currentLoopData = $dataKas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $kas): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <tr>
                        <td><?php echo e($loop->iteration); ?></td>
                        <td><?php echo e(\Carbon\Carbon::parse($kas->tanggal_transaksi)->format('d M Y')); ?></td>
                        <td>
                            <span class="badge 
                                <?php if($kas->jenis == 'masuk'): ?> bg-success 
                                <?php else: ?> bg-danger 
                                <?php endif; ?>">
                                <?php echo e(ucfirst($kas->jenis)); ?>

                            </span>
                        </td>
                        <td><?php echo e($kas->divisi); ?></td>
                        <td>Rp <?php echo e(number_format($kas->nominal, 0, ',', '.')); ?></td>
                        <td><?php echo e($kas->deskripsi); ?></td>
                        <td>
                            <a href="<?php echo e(route('kas.edit', $kas->id_kas)); ?>" class="btn btn-sm btn-warning me-2">Edit</a>
                            
                            <form action="<?php echo e(route('kas.destroy', $kas->id_kas)); ?>" method="POST" style="display:inline;">
                                <?php echo csrf_field(); ?>
                                <?php echo method_field('DELETE'); ?>
                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">Hapus</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <tr>
                        <td colspan="7" class="text-center">Belum ada data kas yang tercatat.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\projek-neraca\resources\views/kas/index.blade.php ENDPATH**/ ?>