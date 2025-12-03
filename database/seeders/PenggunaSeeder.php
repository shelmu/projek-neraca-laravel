<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Pengguna; // Panggil Model Pengguna
use Illuminate\Support\Facades\Hash; // Panggil Hash untuk enkripsi password

class PenggunaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 1. Buat Akun Admin
        Pengguna::create([
            'nim' => '11111',           // NIM Admin
            'nama' => 'Super Admin',
            'password' => Hash::make('admin123'), // Password wajib di-Hash
            'role' => 'admin',
        ]);

        // 2. Buat Akun Mahasiswa (Anggota)
        Pengguna::create([
            'nim' => '2024001',         // NIM Mahasiswa
            'nama' => 'Budi Santoso',
            'password' => Hash::make('sandi123'),
            'role' => 'anggota',
        ]);
    }
}