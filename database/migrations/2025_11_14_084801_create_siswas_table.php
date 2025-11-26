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
        Schema::create('siswas', function (Blueprint $table) {
            $table->char('nisn', 10)->primary();
            $table->char('nis', 8);
            $table->string('nama', 35);

            // relasi kelas
            $table->integer('id_kelas');

            // tambahan fitur naik kelas
            $table->string('tahun_ajaran')->nullable(); // contoh: 2024/2025
            $table->enum('semester', ['1', '2'])->default('1');

            $table->text('alamat');
            $table->string('no_telp', 13);

            // login siswa
            $table->string('password');

            $table->unsignedInteger('id_spp');
            $table->timestamps();

            // foreign key
            $table->foreign('id_kelas')->references('id_kelas')->on('kelas')->onDelete('cascade');
            $table->foreign('id_spp')->references('id_spp')->on('spps')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('siswas');
    }
};
