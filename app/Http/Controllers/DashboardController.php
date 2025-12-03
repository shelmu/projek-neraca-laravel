<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// Panggil Model-model yang sudah kita buat
use App\Models\Pengguna;
use App\Models\Kas;
use App\Models\ProgramKerja;

class DashboardController extends Controller
{
    // 1. Dashboard Admin
    public function indexAdmin()
    {
        return view('dashboard.admin');
    }

    // 2. Dashboard Anggota (Lengkap dengan Data Kas & Progja)
    public function indexAnggota()
    {
        // A. DATA ANGGOTA (Daftar Teman)
        $anggota = Pengguna::orderBy('nama', 'asc')->get();

        // B. DATA KAS (Ringkasan Keuangan)
        $pemasukan   = Kas::where('jenis', 'masuk')->sum('nominal');
        $pengeluaran = Kas::where('jenis', 'keluar')->sum('nominal');
        $saldo       = $pemasukan - $pengeluaran;

        // Ambil 5 Transaksi Terakhir untuk tabel riwayat kecil
        $riwayatKas = Kas::orderBy('tanggal_transaksi', 'desc')
                         ->orderBy('id_kas', 'desc')
                         ->limit(5)
                         ->get();

        // C. DATA PROGRAM KERJA
        // Urutkan: Belum Selesai di atas
        $progja = ProgramKerja::orderBy('status', 'asc')
                              ->orderBy('target_selesai', 'asc')
                              ->get();

        // D. Kirim SEMUA data ke View
        return view('dashboard.anggota', compact(
            'anggota',
            'pemasukan',
            'pengeluaran',
            'saldo',
            'riwayatKas',
            'progja'
        ));
    }
}