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
        Schema::create('absensi', function (Blueprint $table) {
            $table->id();
            $table->foreignId('siswa_id')->constrained(
                table: 'siswa', indexName: 'absensi_siswa_id'
                )->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('guru_id')->constrained(
                table: 'guru', indexName: 'absensi_guru_id'
                )->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignId('kelas_id')->constrained(
                table: 'kelas', indexName: 'absensi_kelas_id'
                )->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignId('jadwal_id')->constrained(
                table: 'jadwal', indexName: 'absensi_jadwal_id'
                )->cascadeOnUpdate()->cascadeOnDelete();
            $table->date('tanggal');
            $table->enum('status', ['A', 'S', 'I', 'H']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('absensi');
    }
};
