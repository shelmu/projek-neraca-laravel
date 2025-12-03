<!DOCTYPE html>
<html>
<head>
    <title>Laporan Program Kerja</title>
    <style>
        body { font-family: sans-serif; font-size: 11pt; }
        
        .header { text-align: center; margin-bottom: 20px; border-bottom: 2px solid #333; padding-bottom: 10px; }
        .header h2 { margin: 0; text-transform: uppercase; }
        .header p { margin: 2px 0; color: #555; }
        
        table { width: 100%; border-collapse: collapse; margin-top: 10px; }
        th, td { border: 1px solid #000; padding: 6px 8px; vertical-align: top; }
        th { background-color: #f0f0f0; font-weight: bold; text-align: center; }
        
        .text-center { text-align: center; }
        .text-right { text-align: right; }
        .badge { font-weight: bold; font-size: 10px; text-transform: uppercase; }
        
        /* Ringkasan di bawah tabel */
        .summary-box { margin-top: 20px; width: 40%; float: right; border: 1px solid #000; padding: 10px; }
        .summary-row { display: flex; justify-content: space-between; margin-bottom: 5px; }
        .summary-label { font-weight: bold; }
    </style>
</head>
<body>

    <div class="header">
        <h2>Laporan Program Kerja</h2>
        <p>Organisasi Mahasiswa - Periode 2024/2025</p>
        <p>Dicetak pada: <?php echo e(date('d-m-Y H:i')); ?></p>
    </div>

    <table>
        <thead>
            <tr>
                <th width="5%">No</th>
                <th width="25%">Nama Program</th>
                <th width="15%">Divisi</th>
                <th width="15%">Ketua Panitia</th>
                <th width="15%">Anggaran</th>
                <th width="15%">Target Selesai</th>
                <th width="10%">Status</th>
            </tr>
        </thead>
        <tbody>
            <?php $__empty_1 = true; $__currentLoopData = $progja; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
            <tr>
                <td class="text-center"><?php echo e($index + 1); ?></td>
                <td>
                    <strong><?php echo e($item->nama_progja); ?></strong><br>
                    <span style="font-size: 10px; color: #555;">Realisasi: <?php echo e($item->realisasi_tanggal); ?></span>
                </td>
                <td class="text-center"><?php echo e($item->divisi_induk); ?></td>
                <td><?php echo e($item->ketua_panitia); ?></td>
                <td class="text-right">Rp <?php echo e(number_format($item->anggaran, 0, ',', '.')); ?></td>
                <td class="text-center"><?php echo e(date('d-m-Y', strtotime($item->target_selesai))); ?></td>
                <td class="text-center">
                    <?php echo e($item->status); ?>

                </td>
            </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
            <tr>
                <td colspan="7" class="text-center">Belum ada data program kerja.</td>
            </tr>
            <?php endif; ?>
        </tbody>
    </table>

    <!-- Ringkasan Data -->
    <div style="margin-top: 30px; page-break-inside: avoid;">
        <table style="width: 50%; float: right; border: none;">
            <tr>
                <td style="border: none;"><strong>Total Program Kerja</strong></td>
                <td style="border: none; text-align: right;"><?php echo e(count($progja)); ?> Program</td>
            </tr>
            <tr>
                <td style="border: none;"><strong>Status Selesai</strong></td>
                <td style="border: none; text-align: right;"><?php echo e($totalSelesai); ?></td>
            </tr>
            <tr>
                <td style="border: none;"><strong>Status Belum Selesai</strong></td>
                <td style="border: none; text-align: right;"><?php echo e($totalBelum); ?></td>
            </tr>
            <tr style="border-top: 1px solid #000;">
                <td style="border: none; padding-top: 10px;"><strong>TOTAL ANGGARAN</strong></td>
                <td style="border: none; padding-top: 10px; text-align: right;"><strong>Rp <?php echo e(number_format($totalAnggaran, 0, ',', '.')); ?></strong></td>
            </tr>
        </table>
    </div>

</body>
</html><?php /**PATH C:\laragon\www\projek-neraca\resources\views/admin/progja/pdf.blade.php ENDPATH**/ ?>