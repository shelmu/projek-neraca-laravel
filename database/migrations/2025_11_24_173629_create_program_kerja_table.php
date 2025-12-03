<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('program_kerja', function (Blueprint $table) {
            // Sesuai Native: id_progja int(11) auto_increment
            $table->integer('id_progja')->autoIncrement(); 
            
            $table->string('nama_progja', 255);
            $table->string('divisi_induk', 100);
            $table->integer('anggaran'); // Kolom baru sesuai native
            
            $table->string('target_selesai', 20); 
            $table->string('realisasi_tanggal', 20)->default('N/A');
            
            $table->enum('status', ['Selesai', 'Belum Selesai']);
            $table->text('deskripsi_progja'); 
            
            $table->string('ketua_panitia', 100); // Kolom baru sesuai native
            
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('program_kerja');
    }
};