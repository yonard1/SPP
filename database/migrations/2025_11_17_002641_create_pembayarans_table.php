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
            $table->integer('id_petugas');
            $table->string('nisn', 10);
            $table->date('tgl_bayar');
            $table->string('bulan_dibayar', 8);
            $table->string('tahun_dibayar', 4);
            $table->integer('id_spp');
            $table->integer('jumlah_bayar');

            $table->timestamps();

            $table->foreign('id_petugas')->references('id_petugas')->on('petugas')->onDelete('cascade');
            $table->foreign('nisn')->references('nisn')->on('siswas')->onDelete('cascade');
            $table->foreign('id_spp')->references('id_spp')->on('spps')->onDelete('cascade');
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
