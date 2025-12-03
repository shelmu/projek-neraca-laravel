<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProgramKerja extends Model
{
    use HasFactory;

    protected $table = 'program_kerja';
    protected $primaryKey = 'id_progja'; // Kunci utama custom

    // Daftar kolom yang boleh diisi (Harus sama persis dengan migrasi)
    protected $fillable = [
        'nama_progja',
        'divisi_induk',
        'anggaran',
        'target_selesai',
        'realisasi_tanggal',
        'status',
        'deskripsi_progja',
        'ketua_panitia'
    ];
}