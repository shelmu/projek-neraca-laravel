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
        <p>Dicetak pada: {{ date('d-m-Y H:i') }}</p>
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
            @forelse($progja as $index => $item)
            <tr>
                <td class="text-center">{{ $index + 1 }}</td>
                <td>
                    <strong>{{ $item->nama_progja }}</strong><br>
                    <span style="font-size: 10px; color: #555;">Realisasi: {{ $item->realisasi_tanggal }}</span>
                </td>
                <td class="text-center">{{ $item->divisi_induk }}</td>
                <td>{{ $item->ketua_panitia }}</td>
                <td class="text-right">Rp {{ number_format($item->anggaran, 0, ',', '.') }}</td>
                <td class="text-center">{{ date('d-m-Y', strtotime($item->target_selesai)) }}</td>
                <td class="text-center">
                    {{ $item->status }}
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="7" class="text-center">Belum ada data program kerja.</td>
            </tr>
            @endforelse
        </tbody>
    </table>

    <!-- Ringkasan Data -->
    <div style="margin-top: 30px; page-break-inside: avoid;">
        <table style="width: 50%; float: right; border: none;">
            <tr>
                <td style="border: none;"><strong>Total Program Kerja</strong></td>
                <td style="border: none; text-align: right;">{{ count($progja) }} Program</td>
            </tr>
            <tr>
                <td style="border: none;"><strong>Status Selesai</strong></td>
                <td style="border: none; text-align: right;">{{ $totalSelesai }}</td>
            </tr>
            <tr>
                <td style="border: none;"><strong>Status Belum Selesai</strong></td>
                <td style="border: none; text-align: right;">{{ $totalBelum }}</td>
            </tr>
            <tr style="border-top: 1px solid #000;">
                <td style="border: none; padding-top: 10px;"><strong>TOTAL ANGGARAN</strong></td>
                <td style="border: none; padding-top: 10px; text-align: right;"><strong>Rp {{ number_format($totalAnggaran, 0, ',', '.') }}</strong></td>
            </tr>
        </table>
    </div>

</body>
</html>