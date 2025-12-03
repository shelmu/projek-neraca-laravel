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
    Schema::create('pengguna', function (Blueprint $table) {
        // 1. Tetap gunakan ID bawaan Laravel (Big Integer Auto Increment)
        $table->id(); // Ini akan membuat kolom 'id' sebagai Primary Key
        
        // 2. NIM tetap ada, tapi dijadikan UNIQUE (tidak boleh kembar)
        // Bukan Primary Key, tapi "Kunci Unik"
        $table->string('nim')->unique(); 
        
        $table->string('nama', 100);
        $table->string('password');
        $table->enum('role', ['admin', 'anggota'])->default('anggota');
        $table->timestamps();
    });
}
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pengguna');
    }
};
