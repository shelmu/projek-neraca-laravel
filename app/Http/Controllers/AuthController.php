<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Pengguna;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function showRegister()
    {
        return view('register');
    }

    // 2. PROSES PENDAFTARAN
    public function processRegister(Request $request)
    {
        // A. Validasi Input
        $validated = $request->validate([
            'nim'      => 'required|unique:pengguna,nim|numeric', // NIM harus unik & angka
            'nama'     => 'required|string|max:100',
            'password' => 'required|min:6', // Minimal 6 karakter biar aman
        ], [
            // Pesan Error Custom (Opsional, biar bahasa Indonesia)
            'nim.unique' => 'NIM ini sudah terdaftar.',
            'nim.numeric' => 'NIM harus berupa angka.',
            'password.min' => 'Password minimal 6 karakter.'
        ]);

        // B. Simpan ke Database
        Pengguna::create([
            'nim'      => $request->nim,
            'nama'     => $request->nama,
            'password' => Hash::make($request->password), // Wajib di-Hash!
            'role'     => 'anggota', // Default role pasti 'anggota'
        ]);

        // C. Redirect ke Halaman Login
        return redirect()->route('login')->with('success', 'Pendaftaran berhasil! Silakan login.');
    }

    public function login(Request $request)
    {
        // 1. Validasi Input
        $credentials = $request->validate([
            'nim' => ['required'], // Pastikan nim diisi
            'password' => ['required'], // Pastikan password diisi
        ]);

        // 2. Cek apakah "Remember Me" dicentang?
        $remember = $request->has('remember');

        // 3. Proses Login (Auth::attempt otomatis cek password hash)
        // Kita spesifikkan kuncinya adalah 'nim' dan 'password'
        if (Auth::attempt(['nim' => $request->nim, 'password' => $request->password], $remember)) {
            
            // Jika Berhasil:
            $request->session()->regenerate(); // Keamanan sesi
            
            $user = Auth::user();
            if ($user->role === 'admin') {
                return redirect()->intended('/dashboard/admin');
            } else {
                return redirect()->intended('/dashboard/anggota');
            }
        }

        // 4. Jika Gagal:
        // Kembali ke halaman login, kirim pesan error, dan kembalikan input nim (kecuali password)
        return back()->with('error', 'NIM atau Password salah.')->withInput($request->only('nim'));
    }
        // Tambahkan juga fungsi LOGOUT agar mereka bisa keluar nanti
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login');
    }
}