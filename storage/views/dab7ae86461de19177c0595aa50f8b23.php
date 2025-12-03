

<?php $__env->startSection('title', 'Detail Progja'); ?>

<?php $__env->startSection('content'); ?>
<div class="container my-5 flex-grow-1">
    
    <!-- Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold text-white">Detail Program Kerja: <?php echo e($progja->nama_progja); ?></h2>
        <a href="<?php echo e(route('progja.index')); ?>" class="btn btn-outline-light btn-sm">
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
                    <p class="mb-1 text-white"><strong>ID Proker:</strong> #<?php echo e($progja->id_progja); ?></p>
                    <p class="mb-1 text-white"><strong>Divisi Induk:</strong> <?php echo e($progja->divisi_induk); ?></p>
                    <p class="mb-1 text-white"><strong>Ketua Panitia:</strong> <?php echo e($progja->ketua_panitia); ?></p>
                    <p class="mb-1 text-white"><strong>Status:</strong> 
                        <?php if($progja->status == 'Selesai'): ?>
                            <span class="badge bg-success">SELESAI</span>
                        <?php else: ?>
                            <span class="badge bg-danger">BELUM SELESAI</span>
                        <?php endif; ?>
                    </p>
                    
                    <hr class="border-secondary my-2">
                    
                    <p class="mb-1 text-white"><strong>Realisasi Tanggal:</strong> <?php echo e($progja->realisasi_tanggal); ?></p>
                    <p class="mb-1 text-white"><strong>Target Selesai:</strong> <?php echo e(date('d M Y', strtotime($progja->target_selesai))); ?></p>
                </div>
            </div>

            <!-- KARTU 2: ANGGARAN & DESKRIPSI -->
            <div class="card bg-dark border-secondary shadow-sm mb-4">
                <div class="card-header bg-secondary text-white border-bottom border-secondary">
                    Anggaran dan Deskripsi
                </div>
                <div class="card-body">
                    <p class="lead text-white"><strong>Anggaran Biaya:</strong> <span class="fw-bold text-success">Rp <?php echo e(number_format($progja->anggaran, 0, ',', '.')); ?></span></p>
                    <hr class="border-secondary">
                    <h5 class="text-white">Deskripsi Proyek:</h5>
                    <p class="text-white"><?php echo nl2br(e($progja->deskripsi_progja)); ?></p>
                </div>
            </div>
            
            <!-- TOMBOL AKSI -->
            <div class="d-flex justify-content-start gap-3 mb-5">
                <a href="<?php echo e(route('progja.detail.pdf', $progja->id_progja)); ?>" class="btn btn-success" target="_blank">
                    <i class="bi bi-file-pdf-fill me-1"></i> Unduh Laporan PDF
                </a>
                
                <a href="<?php echo e(route('progja.edit', $progja->id_progja)); ?>" class="btn btn-warning text-dark">
                    <i class="bi bi-pencil-square me-1"></i> Edit Progja
                </a>
                
                <form action="<?php echo e(route('progja.destroy', $progja->id_progja)); ?>" method="POST" onsubmit="return confirm('Yakin hapus progja ini?');">
                    <?php echo csrf_field(); ?> <?php echo method_field('DELETE'); ?>
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
                            <?php $__currentLoopData = $inti; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $anggota): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <li class="list-group-item bg-dark text-white border-secondary d-flex justify-content-between align-items-center">
                                    <span class="badge bg-primary me-2"><?php echo e(strtoupper($anggota['jabatan'])); ?></span>
                                    <strong><?php echo e($anggota['nama']); ?></strong>
                                </li>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </ul>
                    </div>
                </div>
                
                <!-- DAFTAR BIDANG (LOOPING) -->
                <?php $__currentLoopData = $bidang_lain; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $nama_bidang => $anggota_list): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="col-md-6 mb-4">
                        <div class="card bg-dark border-secondary shadow-sm">
                            <div class="card-header bg-secondary text-white border-bottom border-secondary fw-bold">
                                BIDANG: <?php echo e(strtoupper($nama_bidang)); ?>

                            </div>
                            <ul class="list-group list-group-flush">
                                <?php $__currentLoopData = $anggota_list; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $anggota): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <li class="list-group-item bg-dark text-white border-secondary d-flex justify-content-between align-items-center">
                                        <div class="fw-bold text-secondary"><?php echo e($anggota->jabatan); ?></div>
                                        <div><?php echo e($anggota->nama); ?></div>
                                    </li>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </ul>
                        </div>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\projek-neraca\resources\views/admin/progja/show.blade.php ENDPATH**/ ?>