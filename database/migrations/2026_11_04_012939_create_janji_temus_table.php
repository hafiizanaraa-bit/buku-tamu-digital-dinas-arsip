<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('janji_temus', function (Blueprint $table) {
            $table->id();

            // Kode unik bukti kunjungan
            $table->string('kode_kunjungan')->unique();

            // Identitas pengunjung
            $table->string('nama_tamu', 150);
            $table->string('telepon', 20);
            $table->string('alamat');
            $table->string('instansi', 150)->nullable();

            // Informasi kunjungan
            $table->unsignedBigInteger('pegawai_id');
            $table->string('tujuan', 150);
            $table->date('tanggal_kunjungan');
            $table->string('waktu_kunjungan', 50);
            $table->text('catatan')->nullable();

            // Status permohonan
            $table->string('status')->default('Menunggu Konfirmasi');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('janji_temus');
    }
};