<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pengguna;
use Illuminate\Support\Facades\Hash;

class AnggotaController extends Controller
{
    // ... namespace dan use statements ...

    public function index()
    {
        // 1. Ambil semua data anggota
        $users = Pengguna::orderBy('role', 'asc')->orderBy('nama', 'asc')->get();

        // 2. Hitung Data Ringkasan (Untuk Widget)
        $total_user    = Pengguna::count();
        $total_admin   = Pengguna::where('role', 'admin')->count();
        $total_anggota = Pengguna::where('role', 'anggota')->count();

        // 3. Kirim semua variabel ke View
        return view('admin.anggota.index', compact(
            'users', 
            'total_user', 
            'total_admin', 
            'total_anggota'
        ));
    }

    // ... method create, store, edit, dll tetap sama ...

    // 2. FORM TAMBAH
    public function create()
    {
        return view('admin.anggota.create');
    }

    // 3. SIMPAN DATA BARU
    public function store(Request $request)
    {
        $request->validate([
            'nim' => 'required|unique:pengguna,nim',
            'nama' => 'required',
            'password' => 'required|min:6',
            'role' => 'required'
        ]);

        Pengguna::create([
            'nim' => $request->nim,
            'nama' => $request->nama,
            'password' => Hash::make($request->password),
            'role' => $request->role
        ]);

        return redirect()->route('anggota.index')->with('success', 'Anggota berhasil ditambahkan!');
    }

    // 4. FORM EDIT (Baru Ditambahkan)
    public function edit($id)
    {
        // Cari pengguna berdasarkan ID, jika tidak ketemu tampilkan 404
        $user = Pengguna::findOrFail($id);
        return view('admin.anggota.edit', compact('user'));
    }

    // 5. UPDATE DATA (Baru Ditambahkan)
    public function update(Request $request, $id)
    {
        $user = Pengguna::findOrFail($id);

        $request->validate([
            // Validasi NIM unik, tapi KECUALIKAN punya diri sendiri (ignore $id)
            'nim' => 'required|unique:pengguna,nim,'.$id, 
            'nama' => 'required',
            'role' => 'required'
        ]);

        // Update data dasar
        $user->nim = $request->nim;
        $user->nama = $request->nama;
        $user->role = $request->role;

        // Cek apakah password diisi? Kalau kosong, jangan diubah
        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        $user->save(); // Simpan perubahan

        return redirect()->route('anggota.index')->with('success', 'Data anggota berhasil diperbarui!');
    }

    // 6. HAPUS DATA (Baru Ditambahkan)
    public function destroy($id)
    {
        $user = Pengguna::findOrFail($id);
        $user->delete();

        return redirect()->route('anggota.index')->with('success', 'Anggota berhasil dihapus!');
    }
}