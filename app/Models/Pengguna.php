<?php

namespace App\Models;

// PENTING: Kita ganti extends Model biasa menjadi Authenticatable
// Agar fitur Auth::attempt() bisa jalan
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Pengguna extends Authenticatable
{
    use Notifiable;

    // Memberitahu Laravel nama tabel kita adalah 'pengguna'
    protected $table = 'pengguna';

    // Kolom yang boleh diisi (Mass Assignment)
    protected $fillable = [
        'nim',
        'nama',
        'password',
        'role',
    ];

    // Kolom yang disembunyikan saat dikonversi ke Array/JSON
    protected $hidden = [
        'password',
        'remember_token',
    ];

    // Otomatis hash password saat disimpan (opsional tapi bagus)
    protected $casts = [
        'password' => 'hashed',
    ];
}