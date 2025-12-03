<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PanitiaDetail extends Model
{
    use HasFactory;

    protected $table = 'panitia_detail';
    protected $primaryKey = 'id_panitia'; // Custom PK

    protected $fillable = [
        'id_progja',
        'nama',
        'jabatan',
        'bidang'
    ];
}