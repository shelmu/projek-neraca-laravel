<!DOCTYPE html>
<html>
<head>
    <title>Laporan Kas</title>
    <style>
        body { font-family: sans-serif; }
        .header { text-align: center; margin-bottom: 20px; }
        .header h2 { margin: 0; }
        .header p { margin: 5px 0; color: #555; }
        
        table { width: 100%; border-collapse: collapse; margin-top: 10px; }
        th, td { border: 1px solid #333; padding: 8px; font-size: 12px; }
        th { background-color: #f2f2f2; }
        
        .text-center { text-align: center; }
        .text-right { text-align: right; }
        
        .badge-masuk { color: green; font-weight: bold; }
        .badge-keluar { color: red; font-weight: bold; }
        
        .summary { margin-top: 20px; width: 40%; float: right; }
        .summary table { border: none; }
        .summary td { border: none; padding: 5px; }
        .summary .total { font-weight: bold; border-top: 1px solid #333; }
    </style>
</head>
<body>

    <div class="header">
        <h2>LAPORAN ARUS KAS</h2>
        <p>Organisasi Mahasiswa - Periode 2024/2025</p>
        <p>Dicetak pada: <?php echo e(date('d-m-Y H:i')); ?></p>
    </div>

    <table>
        <thead>
            <tr>
                <th width="5%">No</th>
                <th width="15%">Tanggal</th>
                <th width="10%">Jenis</th>
                <th>Keterangan</th>
                <th width="15%">Divisi/PIC</th>
                <th width="15%" class="text-right">Nominal</th>
            </tr>
        </thead>
        <tbody>
            <?php $__empty_1 = true; $__currentLoopData = $dataKas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
            <tr>
                <td class="text-center"><?php echo e($index + 1); ?></td>
                <td class="text-center"><?php echo e(date('d-m-Y', strtotime($item->tanggal_transaksi))); ?></td>
                <td class="text-center">
                    <?php if($item->jenis == 'masuk'): ?>
                        <span class="badge-masuk">MASUK</span>
                    <?php else: ?>
                        <span class="badge-keluar">KELUAR</span>
                    <?php endif; ?>
                </td>
                <td><?php echo e($item->deskripsi); ?></td>
                <td>
                    <?php echo e($item->divisi); ?><br>
                    <small>(<?php echo e($item->nama_anggota); ?>)</small>
                </td>
                <td class="text-right">Rp <?php echo e(number_format($item->nominal, 0, ',', '.')); ?></td>
            </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
            <tr>
                <td colspan="6" class="text-center">Tidak ada data transaksi.</td>
            </tr>
            <?php endif; ?>
        </tbody>
    </table>

    <div class="summary">
        <table>
            <tr>
                <td>Total Pemasukan</td>
                <td class="text-right">Rp <?php echo e(number_format($totalMasuk, 0, ',', '.')); ?></td>
            </tr>
            <tr>
                <td>Total Pengeluaran</td>
                <td class="text-right" style="color: red;">(Rp <?php echo e(number_format($totalKeluar, 0, ',', '.')); ?>)</td>
            </tr>
            <tr class="total">
                <td>SALDO AKHIR</td>
                <td class="text-right">Rp <?php echo e(number_format($saldoAkhir, 0, ',', '.')); ?></td>
            </tr>
        </table>
    </div>

</body>
</html><?php /**PATH C:\laragon\www\projek-neraca\resources\views/admin/kas/pdf.blade.php ENDPATH**/ ?>