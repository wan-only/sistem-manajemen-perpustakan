<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
   
    public function up(): void
    {
        Schema::create('peminjamen', function (Blueprint $table) {
        $table->id();
        $table->foreignId('user_id')->constrained()->onDelete('cascade');
        $table->foreignId('buku_id')->constrained()->onDelete('cascade'); // Relasi ke table users
        $table->date('tanggal_peminjaman'); 
        $table->date('tanggal_kembali')->nullable();
        $table->string('status');
        $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('peminjamen');
    }
};
