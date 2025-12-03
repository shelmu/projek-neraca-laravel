<?php

namespace App\Http\Controllers;

use App\Models\ProgramKerja;
use App\Models\PanitiaDetail;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf; // <--- JANGAN LUPA TAMBAHKAN INI

class ProgramKerjaController extends Controller
{
    /**
     * TAMPILKAN DAFTAR PROGJA + RINGKASAN
     */
    public function index()
    {
        // 1. Ambil Data Tabel (Urutkan: Belum Selesai di atas)
        $progja = ProgramKerja::orderBy('status', 'asc')
                              ->orderBy('target_selesai', 'asc')
                              ->get();

        // 2. Hitung Data Ringkasan (Untuk Widget Atas)
        $total_progja = ProgramKerja::count();
        
        $progja_selesai = ProgramKerja::where('status', 'Selesai')->count();
        
        // Menghitung yang statusnya bukan 'Selesai' (Belum Selesai / Pending)
        $progja_belum_selesai = ProgramKerja::where('status', '!=', 'Selesai')->count();

        // 3. Kirim SEMUA variabel ke View
        return view('admin.progja.index', compact(
            'progja', 
            'total_progja', 
            'progja_selesai', 
            'progja_belum_selesai'
        ));
    }

    /**
     * FORM TAMBAH (CREATE)
     */
    public function create()
    {
        return view('admin.progja.create');
    }

    /**
     * SIMPAN DATA (STORE)
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_progja'      => 'required',
            'divisi_induk'     => 'required',
            'ketua_panitia'    => 'required',
            'anggaran'         => 'required|numeric',
            'target_selesai'   => 'required|date',
            'status'           => 'required',
            'deskripsi_progja' => 'required',
            'panitia_nama.*'   => 'nullable|string', 
        ]);

        $progja = ProgramKerja::create([
            'nama_progja'       => $request->nama_progja,
            'divisi_induk'      => $request->divisi_induk,
            'ketua_panitia'     => $request->ketua_panitia,
            'anggaran'          => $request->anggaran,
            'target_selesai'    => $request->target_selesai,
            'status'            => $request->status,
            'deskripsi_progja'  => $request->deskripsi_progja,
            'realisasi_tanggal' => 'N/A'
        ]);

        if ($request->has('panitia_nama')) {
            $names     = $request->panitia_nama;
            $positions = $request->panitia_jabatan;
            $fields    = $request->panitia_bidang;

            for ($i = 0; $i < count($names); $i++) {
                if (!empty($names[$i])) {
                    PanitiaDetail::create([
                        'id_progja' => $progja->id_progja,
                        'nama'      => $names[$i],
                        'jabatan'   => $positions[$i],
                        'bidang'    => $fields[$i],
                    ]);
                }
            }
        }

        return redirect()->route('progja.index')->with('success', 'Program Kerja berhasil dibuat!');
    }

    /**
     * FORM EDIT
     */
    // ... method index, create, store ...

    /**
     * FORM EDIT (LENGKAP DENGAN DATA PANITIA)
     */
    public function edit($id)
    {
        $progja = ProgramKerja::findOrFail($id);
        
        // Ambil data panitia untuk ditampilkan di form
        $panitia = PanitiaDetail::where('id_progja', $id)->get();
        
        return view('admin.progja.edit', compact('progja', 'panitia'));
    }

    /**
     * UPDATE DATA (UPDATE PROGJA + SYNC PANITIA)
     */
    public function update(Request $request, $id)
    {
        $progja = ProgramKerja::findOrFail($id);

        $request->validate([
            'nama_progja'      => 'required',
            'divisi_induk'     => 'required',
            'ketua_panitia'    => 'required',
            'anggaran'         => 'required|numeric',
            'target_selesai'   => 'required|date',
            // Tambahkan validasi ini (boleh kosong/nullable)
            'realisasi_tanggal'=> 'nullable', 
            'status'           => 'required',
            'deskripsi_progja' => 'required',
        ]);

        $progja->update([
            'nama_progja'      => $request->nama_progja,
            'divisi_induk'     => $request->divisi_induk,
            'ketua_panitia'    => $request->ketua_panitia,
            'anggaran'         => $request->anggaran,
            'target_selesai'   => $request->target_selesai,
            
            // LOGIKA BARU:
            // Jika user tidak mengisi tanggal (kosong), kita simpan 'N/A'
            // Jika user mengisi, kita simpan tanggalnya
            'realisasi_tanggal'=> $request->realisasi_tanggal ?? 'N/A',
            
            'status'           => $request->status,
            'deskripsi_progja' => $request->deskripsi_progja,
        ]);

        // ... (kode update panitia di bawahnya biarkan tetap sama) ...
        
        // Hapus panitia lama
        PanitiaDetail::where('id_progja', $id)->delete();

        // Simpan panitia baru
        if ($request->has('panitia_nama')) {
            $names     = $request->panitia_nama;
            $positions = $request->panitia_jabatan;
            $fields    = $request->panitia_bidang;

            for ($i = 0; $i < count($names); $i++) {
                if (!empty($names[$i])) {
                    PanitiaDetail::create([
                        'id_progja' => $progja->id_progja,
                        'nama'      => $names[$i],
                        'jabatan'   => $positions[$i],
                        'bidang'    => $fields[$i],
                    ]);
                }
            }
        }

        return redirect()->route('progja.index')->with('success', 'Program Kerja diperbarui!');
    }

    // ... method destroy ...

    /**
     * HAPUS DATA
     */
    public function destroy($id)
    {
        $progja = ProgramKerja::findOrFail($id);
        PanitiaDetail::where('id_progja', $id)->delete();
        $progja->delete();

        return redirect()->route('progja.index')->with('success', 'Program Kerja dihapus!');
    }

    // ... (kode lainnya tetap sama) ...

    /**
     * TAMPILKAN DETAIL PROGJA (SHOW)
     */
    public function show($id)
    {
        // 1. Ambil Data Utama
        $progja = ProgramKerja::findOrFail($id);

        // 2. Ambil Data Panitia
        $panitia_list = PanitiaDetail::where('id_progja', $id)->get();

        // 3. Logika Pengelompokan (Sesuai Native)
        $inti = [];
        $bidang_lain = [];

        // Masukkan Ketua Panitia (dari tabel induk) ke array Inti paling atas
        $inti[] = [
            'jabatan' => 'Ketua Panitia',
            'nama'    => $progja->ketua_panitia
        ];

        // Loop data panitia detail
        foreach ($panitia_list as $p) {
            // Cek apakah dia BPH (Sekretaris, Bendahara, atau bidangnya ditulis 'Inti')
            if (in_array($p->jabatan, ['Sekretaris Panitia', 'Bendahara Panitia']) || strtolower($p->bidang) == 'inti') {
                $inti[] = [
                    'jabatan' => $p->jabatan,
                    'nama'    => $p->nama
                ];
            } else {
                // Masukkan ke grup bidang masing-masing
                $bidang_lain[$p->bidang][] = $p;
            }
        }

        return view('admin.progja.show', compact('progja', 'inti', 'bidang_lain'));
    }

    // ... (kode lainnya tetap sama) ...

    public function cetakLaporan()
    {
        // 1. Ambil data progja (Urutkan sesuai target selesai)
        $progja = ProgramKerja::orderBy('target_selesai', 'asc')->get();

        // 2. Hitung Total Anggaran untuk Summary
        $totalAnggaran = $progja->sum('anggaran');
        $totalSelesai  = $progja->where('status', 'Selesai')->count();
        $totalBelum    = $progja->where('status', 'Belum Selesai')->count();

        // 3. Load View PDF
        $pdf = Pdf::loadView('admin.progja.pdf', compact('progja', 'totalAnggaran', 'totalSelesai', 'totalBelum'));

        // 4. Stream PDF (Landscape agar kolom luas muat)
        return $pdf->setPaper('a4', 'landscape')->stream('laporan-program-kerja.pdf');
    }

    public function cetakDetailPdf($id)
    {
        // 1. Ambil Data Utama
        $progja = ProgramKerja::findOrFail($id);

        // 2. Ambil Data Panitia
        $panitia_list = PanitiaDetail::where('id_progja', $id)->get();

        // 3. Logika Pengelompokan (Sama seperti di method show)
        $inti = [];
        $bidang_lain = [];

        // Masukkan Ketua Panitia (dari tabel induk) ke array Inti
        $inti[] = [
            'jabatan' => 'Ketua Panitia',
            'nama'    => $progja->ketua_panitia
        ];

        foreach ($panitia_list as $p) {
            // Cek apakah dia BPH
            if (in_array($p->jabatan, ['Sekretaris Panitia', 'Bendahara Panitia']) || strtolower($p->bidang) == 'inti') {
                $inti[] = [
                    'jabatan' => $p->jabatan,
                    'nama'    => $p->nama
                ];
            } else {
                $bidang_lain[$p->bidang][] = $p;
            }
        }

        // 4. Load View PDF Khusus Detail
        $pdf = Pdf::loadView('admin.progja.pdf_detail', compact('progja', 'inti', 'bidang_lain'));

        // 5. Stream PDF (Portrait karena isinya vertikal)
        return $pdf->setPaper('a4', 'portrait')->stream('detail-progja-' . $progja->id_progja . '.pdf');
    }
}