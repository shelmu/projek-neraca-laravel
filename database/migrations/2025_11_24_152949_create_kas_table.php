<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('kas', function (Blueprint $table) {
        // id_kas INT(11) AUTO_INCREMENT
        $table->id('id_kas'); 
        
        // tanggal_transaksi DATE
        $table->date('tanggal_transaksi');
        
        // jenis ENUM('masuk', 'keluar')
        $table->enum('jenis', ['masuk', 'keluar']);
        
        // nama_anggota VARCHAR(100) DEFAULT NULL
        $table->string('nama_anggota', 100)->nullable();
        
        // deskripsi TEXT
        $table->text('deskripsi');
        
        // nominal INT(11)
        $table->integer('nominal');
        
        // divisi VARCHAR(100)
        $table->string('divisi', 100);
        
        // created_at TIMESTAMP (Laravel otomatis buat created_at & updated_at)
        $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kas');
    }
};
