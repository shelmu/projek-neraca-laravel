<?php

namespace App\Http\Controllers;

use App\Models\Kas;
use App\Models\Pengguna;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf; // <--- PENTING: Tambahkan ini


class KasController extends Controller
{
    public function index()
    {
        // 1. AMBIL DATA TABEL (Urut tanggal terbaru)
        $dataKas = Kas::orderBy('tanggal_transaksi', 'desc')
                      ->orderBy('created_at', 'desc')
                      ->get(); 

        // 2. HITUNG RINGKASAN (Pengganti query SUM di native)
        $totalMasuk  = Kas::where('jenis', 'masuk')->sum('nominal');
        $totalKeluar = Kas::where('jenis', 'keluar')->sum('nominal');
        $saldoAkhir  = $totalMasuk - $totalKeluar;

        // 3. KIRIM SEMUA DATA KE VIEW
        return view('admin.kas.index', compact(
            'dataKas', 
            'totalMasuk', 
            'totalKeluar', 
            'saldoAkhir'
        ));
    }

    // ... (Method create, store, edit, update, destroy TETAP SAMA seperti sebelumnya) ...
    // Agar kode tidak kepanjangan, saya tidak tulis ulang bagian bawahnya 
    // karena tidak ada perubahan di sana.
    
    public function create()
    {
        $users = Pengguna::orderBy('nama', 'asc')->get();
        return view('admin.kas.create', compact('users'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'tanggal_transaksi' => 'required|date',
            'jenis'             => 'required|in:masuk,keluar',
            'deskripsi'         => 'required|string',
            'nominal'           => 'required|integer|min:1',
            'divisi'            => 'required|string|max:100',
            'nama_anggota'      => 'nullable|string',
        ]);

        Kas::create($request->all());
        return redirect()->route('kas.index')->with('success', 'Data Kas berhasil ditambahkan!');
    }

    public function edit(Kas $kas)
    {
        $users = Pengguna::orderBy('nama', 'asc')->get();
        return view('admin.kas.edit', compact('kas', 'users'));
    }

    public function update(Request $request, Kas $kas)
    {
        $request->validate([
            'tanggal_transaksi' => 'required|date',
            'jenis'             => 'required|in:masuk,keluar',
            'deskripsi'         => 'required|string',
            'nominal'           => 'required|integer|min:1',
            'divisi'            => 'required|string|max:100',
            'nama_anggota'      => 'nullable|string',
        ]);
        
        $kas->update($request->all());
        return redirect()->route('kas.index')->with('success', 'Data Kas berhasil diperbarui!');
    }

    public function destroy(Kas $kas)
    {
        $kas->delete();
        return redirect()->route('kas.index')->with('success', 'Data Kas berhasil dihapus!');
    }

        public function cetakLaporan()
    {
        // 1. Ambil data kas (Bisa diurutkan sesuai kebutuhan)
        $dataKas = Kas::orderBy('tanggal_transaksi', 'asc')->get();

        // 2. Hitung Ringkasan untuk ditampilkan di PDF
        $totalMasuk  = Kas::where('jenis', 'masuk')->sum('nominal');
        $totalKeluar = Kas::where('jenis', 'keluar')->sum('nominal');
        $saldoAkhir  = $totalMasuk - $totalKeluar;

        // 3. Load View khusus PDF (bukan index biasa)
        // Kita akan buat file view ini di langkah selanjutnya
        $pdf = Pdf::loadView('admin.kas.pdf', compact('dataKas', 'totalMasuk', 'totalKeluar', 'saldoAkhir'));

        // 4. Download atau Stream (Tampilkan di browser)
        // SetPaper('a4', 'portrait') mengatur ukuran kertas
        return $pdf->setPaper('a4', 'portrait')->stream('laporan-kas.pdf');
    }
}