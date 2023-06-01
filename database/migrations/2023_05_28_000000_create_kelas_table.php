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
        Schema::create('kelas', function (Blueprint $table) {
            $table->id();
            $table->enum('tingkat_kelas', ['X', 'XI', 'XII']);
            $table->enum('jurusan', ['IPA', 'IPS', 'AGAMA']);
            $table->string('nama');
            $table->year('tahun_masuk');
            $table->year('tahun_keluar');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kelas');
    }
};
