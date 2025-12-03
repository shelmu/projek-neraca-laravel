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
        Schema::create('panitia_detail', function (Blueprint $table) {
            // Sesuai Native: id_panitia int(11) auto_increment
            $table->integer('id_panitia')->autoIncrement();
            
            // Relasi ke program_kerja
            $table->integer('id_progja'); 
            
            $table->string('nama', 100);
            $table->string('jabatan', 100);
            $table->string('bidang', 100);
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('panitia_detail');
    }
};