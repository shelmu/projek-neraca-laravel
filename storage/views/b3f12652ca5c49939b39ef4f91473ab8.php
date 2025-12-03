

<?php $__env->startSection('title', 'Dashboard Anggota'); ?>

<?php $__env->startSection('content'); ?>
<div class="container my-5">

    <!-- HEADER -->
    <div class="mb-4">
        <h2 class="fw-bold text-white">Dashboard Overview</h2>
        <p class="text-secondary">Selamat datang kembali, <strong class="text-warning"><?php echo e(Auth::user()->nama); ?></strong>.</p>
    </div>

    <!-- BAGIAN 1: RINGKASAN KEUANGAN -->
    <div class="row g-3 mb-5">
        <!-- Pemasukan -->
        <div class="col-md-4">
            <div class="card bg-dark border-secondary h-100">
                <div class="card-body border-start border-4 border-success">
                    <h6 class="text-uppercase text-success fw-bold small">Total Pemasukan</h6>
                    <h3 class="mb-0 text-white">Rp <?php echo e(number_format($pemasukan, 0, ',', '.')); ?></h3>
                </div>
            </div>
        </div>
        
        <!-- Pengeluaran -->
        <div class="col-md-4">
            <div class="card bg-dark border-secondary h-100">
                <div class="card-body border-start border-4 border-danger">
                    <h6 class="text-uppercase text-danger fw-bold small">Total Pengeluaran</h6>
                    <h3 class="mb-0 text-white">Rp <?php echo e(number_format($pengeluaran, 0, ',', '.')); ?></h3>
                </div>
            </div>
        </div>

        <!-- Saldo Akhir -->
        <div class="col-md-4">
            <div class="card bg-dark border-secondary h-100">
                <div class="card-body border-start border-4 border-primary">
                    <h6 class="text-uppercase text-primary fw-bold small">Saldo Akhir</h6>
                    <h3 class="mb-0 <?php echo e($saldo < 0 ? 'text-danger' : 'text-white'); ?>">
                        Rp <?php echo e(number_format($saldo, 0, ',', '.')); ?>

                    </h3>
                </div>
            </div>
        </div>
    </div>

    <div class="row g-4">
        
        <!-- BAGIAN 2: STATUS PROGRAM KERJA -->
        <div class="col-lg-8">
            <div class="card bg-dark border-secondary h-100">
                <div class="card-header bg-transparent border-secondary py-3">
                    <h5 class="m-0 fw-bold text-warning"><i class="bi bi-kanban me-2"></i> Status Program Kerja</h5>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-dark table-hover mb-0 align-middle">
                            <thead>
                                <tr>
                                    <th class="ps-4">Nama Program</th>
                                    <th>Divisi</th>
                                    <th>Target</th>
                                    <th class="text-end pe-4">Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $__empty_1 = true; $__currentLoopData = $progja; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $p): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                <tr>
                                    <td class="ps-4">
                                        <span class="fw-bold"><?php echo e($p->nama_progja); ?></span><br>
                                        <small class="text-secondary" style="font-size: 0.8rem;">Ketua: <?php echo e($p->ketua_panitia); ?></small>
                                    </td>
                                    <td><span class="badge bg-secondary"><?php echo e($p->divisi_induk); ?></span></td>
                                    <td><?php echo e(date('d M', strtotime($p->target_selesai))); ?></td>
                                    <td class="text-end pe-4">
                                        <?php if($p->status == 'Selesai'): ?>
                                            <span class="badge bg-success">Selesai</span>
                                        <?php else: ?>
                                            <span class="badge bg-warning text-dark">Belum</span>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                <tr><td colspan="4" class="text-center py-4 text-secondary">Belum ada data.</td></tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!-- BAGIAN 3: RIWAYAT KAS MINI -->
        <div class="col-lg-4">
            <div class="card bg-dark border-secondary h-100">
                <div class="card-header bg-transparent border-secondary py-3">
                    <h5 class="m-0 fw-bold text-warning"><i class="bi bi-clock-history me-2"></i> Kas Terakhir</h5>
                </div>
                <ul class="list-group list-group-flush">
                    <?php $__empty_1 = true; $__currentLoopData = $riwayatKas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $log): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <li class="list-group-item bg-dark text-light border-secondary">
                            <div class="d-flex w-100 justify-content-between align-items-center mb-1">
                                <span class="badge <?php echo e($log->jenis == 'masuk' ? 'bg-success' : 'bg-danger'); ?>">
                                    <?php echo e($log->jenis == 'masuk' ? 'Masuk' : 'Keluar'); ?>

                                </span>
                                <small class="text-secondary"><?php echo e(date('d/m', strtotime($log->tanggal_transaksi))); ?></small>
                            </div>
                            <p class="mb-1 small"><?php echo e($log->deskripsi); ?></p>
                            <div class="fw-bold <?php echo e($log->jenis == 'masuk' ? 'text-success' : 'text-danger'); ?>">
                                Rp <?php echo e(number_format($log->nominal, 0, ',', '.')); ?>

                            </div>
                        </li>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <li class="list-group-item bg-dark text-secondary text-center">Belum ada transaksi.</li>
                    <?php endif; ?>
                </ul>
            </div>
        </div>

    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\projek-neraca\resources\views/dashboard/anggota.blade.php ENDPATH**/ ?>