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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('username')->unique();
            $table->string('password');
            $table->enum('role', ['admin', 'guru', 'siswa']);
            $table->foreignId('siswa_id')->nullable()->constrained(
                table: 'siswa', indexName: 'users_siswa_id'
                )->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('guru_id')->nullable()->constrained(
                table: 'guru', indexName: 'users_guru_id'
                )->cascadeOnUpdate()->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
