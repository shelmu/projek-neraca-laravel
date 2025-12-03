<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kas extends Model
{
    use HasFactory;

    // Nama tabel di database
    protected $table = 'kas';
    
    // Primary Key non-standar
    protected $primaryKey = 'id_kas';

    // Kolom yang aman untuk Mass Assignment
    protected $fillable = [
        'tanggal_transaksi',
        'jenis',
        'nama_anggota',
        'deskripsi',
        'nominal',
        'divisi',
    ];
    
    // (Opsional) Tentukan tipe data
    protected $casts = [
        'tanggal_transaksi' => 'date',
    ];
}