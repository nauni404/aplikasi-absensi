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
        Schema::create('siswa', function (Blueprint $table) {
            $table->id();
            $table->string('nis')->unique();
            $table->string('nama');
            $table->enum('jk', ['L', 'P']);
            $table->foreignId('kelas_id')->nullable()->constrained(
                table: 'kelas', indexName: 'siswa_kelas_id'
                )->onUpdate('cascade')->nullOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('siswa');
    }
};
