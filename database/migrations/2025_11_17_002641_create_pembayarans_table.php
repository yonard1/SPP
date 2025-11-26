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
        Schema::create('pembayarans', function (Blueprint $table) {
            $table->integer('id_pembayaran')->autoIncrement();

            // relasi petugas, siswa, spp
            $table->integer('id_petugas');
            $table->string('nisn', 10);

            // tanggal bayar normal
            $table->date('tgl_bayar')->nullable();

            // bulan & tahun yang dibayar
            $table->string('bulan_dibayar', 10);   // Juli, Agustus, dst
            $table->string('tahun_dibayar', 4);    // 2024

            // tambahan: tahun ajaran & semester untuk history
            $table->string('tahun_ajaran');        // 2024/2025
            $table->enum('semester', ['1', '2']);

            $table->unsignedInteger('id_spp');
            $table->integer('jumlah_bayar')->default(0);

            // tambahan: archive saat siswa naik kelas / pindah semester
            $table->boolean('is_archived')->default(false);

            $table->timestamps();

            // foreign key
            $table->foreign('nisn')->references('nisn')->on('siswas')->onDelete('cascade');
            $table->foreign('id_spp')->references('id_spp')->on('spps')->onDelete('cascade');
            $table->foreign('id_petugas')->references('id_petugas')->on('petugas')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pembayarans');
    }
};
