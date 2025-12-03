<!DOCTYPE html>
<html>
<head>
    <title>Detail Program Kerja</title>
    <style>
        body { font-family: sans-serif; font-size: 11pt; line-height: 1.4; }
        
        .header { text-align: center; margin-bottom: 30px; border-bottom: 3px double #000; padding-bottom: 10px; }
        .header h2 { margin: 0; text-transform: uppercase; font-size: 16pt; }
        .header p { margin: 2px 0; font-size: 10pt; }
        
        .section-title { 
            background-color: #eee; 
            padding: 5px; 
            font-weight: bold; 
            border: 1px solid #000; 
            margin-top: 20px; 
            margin-bottom: 10px; 
        }
        
        table { width: 100%; border-collapse: collapse; margin-bottom: 10px; }
        .info-table td { padding: 5px; vertical-align: top; }
        .info-label { width: 180px; font-weight: bold; }
        
        .panitia-table th, .panitia-table td { border: 1px solid #000; padding: 6px; }
        .panitia-table th { background-color: #f0f0f0; text-align: center; }
        
        .status-box { 
            border: 1px solid #000; 
            padding: 5px 10px; 
            display: inline-block; 
            font-weight: bold; 
            margin-top: 5px;
        }
    </style>
</head>
<body>

    <div class="header">
        <h2>DETAIL PROGRAM KERJA</h2>
        <p>ORGANISASI MAHASISWA - PERIODE 2024/2025</p>
    </div>

    <!-- BAGIAN 1: INFORMASI UMUM -->
    <div class="section-title">A. INFORMASI UMUM</div>
    
    <table class="info-table">
        <tr>
            <td class="info-label">Nama Program Kerja</td>
            <td>: {{ $progja->nama_progja }}</td>
        </tr>
        <tr>
            <td class="info-label">Divisi Penanggung Jawab</td>
            <td>: {{ $progja->divisi_induk }}</td>
        </tr>
        <tr>
            <td class="info-label">Ketua Pelaksana</td>
            <td>: {{ $progja->ketua_panitia }}</td>
        </tr>
        <tr>
            <td class="info-label">Anggaran Dana</td>
            <td>: Rp {{ number_format($progja->anggaran, 0, ',', '.') }}</td>
        </tr>
        <tr>
            <td class="info-label">Target Pelaksanaan</td>
            <td>: {{ date('d F Y', strtotime($progja->target_selesai)) }}</td>
        </tr>
        <tr>
            <td class="info-label">Status Saat Ini</td>
            <td>: 
                <span style="text-transform: uppercase;">{{ $progja->status }}</span>
            </td>
        </tr>
        <tr>
            <td class="info-label">Deskripsi Kegiatan</td>
            <td>: <br>{!! nl2br(e($progja->deskripsi_progja)) !!}</td>
        </tr>
    </table>

    <!-- BAGIAN 2: SUSUNAN KEPANITIAAN -->
    <div class="section-title">B. SUSUNAN KEPANITIAAN</div>

    <p style="font-weight: bold; margin-bottom: 5px;">1. BADAN PENGURUS HARIAN (BPH)</p>
    <table class="panitia-table">
        <thead>
            <tr>
                <th width="10%">No</th>
                <th width="40%">Jabatan</th>
                <th width="50%">Nama Lengkap</th>
            </tr>
        </thead>
        <tbody>
            @foreach($inti as $index => $anggota)
            <tr>
                <td style="text-align: center;">{{ $index + 1 }}</td>
                <td>{{ $anggota['jabatan'] }}</td>
                <td>{{ $anggota['nama'] }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    @php $nomor_bidang = 2; @endphp
    @foreach($bidang_lain as $nama_bidang => $anggota_list)
        <p style="font-weight: bold; margin-bottom: 5px; margin-top: 15px;">
            {{ $nomor_bidang++ }}. BIDANG {{ strtoupper($nama_bidang) }}
        </p>
        <table class="panitia-table">
            <thead>
                <tr>
                    <th width="10%">No</th>
                    <th width="40%">Posisi</th>
                    <th width="50%">Nama Lengkap</th>
                </tr>
            </thead>
            <tbody>
                @foreach($anggota_list as $idx => $anggota)
                <tr>
                    <td style="text-align: center;">{{ $idx + 1 }}</td>
                    <td>{{ $anggota->jabatan }}</td>
                    <td>{{ $anggota->nama }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    @endforeach

    <div style="margin-top: 50px; width: 100%;">
        <table style="width: 100%; border: none;">
            <tr>
                <td style="width: 60%;"></td>
                <td style="text-align: center;">
                    Dicetak pada: {{ date('d F Y') }}<br>
                    Mengetahui,<br>
                    <strong>Ketua Organisasi</strong>
                    <br><br><br><br>
                    ( .................................... )
                </td>
            </tr>
        </table>
    </div>

</body>
</html>