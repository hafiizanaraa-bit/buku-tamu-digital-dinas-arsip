<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     * Kolom tujuan diperpanjang agar muat format "Tujuan: rincian",
     * misalnya "Konsultasi: pengelolaan arsip kantor desa".
     */
    public function up(): void
    {
        Schema::table('janji_temus', function (Blueprint $table) {
            $table->string('tujuan', 200)->change();
        });
    }

    /**
     * Reverse the migrations.
     * Dikembalikan ke 255 (bukan 50) supaya data yang sudah tersimpan
     * tidak terpotong atau membuat rollback gagal.
     */
    public function down(): void
    {
        Schema::table('janji_temus', function (Blueprint $table) {
            $table->string('tujuan', 255)->change();
        });
    }
};