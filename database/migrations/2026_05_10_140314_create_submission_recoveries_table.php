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
        Schema::create('pemulihan_akses', function (Blueprint $table) {
            $table->id();
            $table->foreignId('siswa_id')->constrained('siswa')->onDelete('cascade');
            $table->foreignId('mata_pelajaran_id')->constrained('mata_pelajaran')->onDelete('cascade');
            $table->enum('status_pemulihan', ['aktif', 'selesai', 'expired'])->default('aktif');
            $table->foreignId('tugas_id')->nullable()->constrained('tugas')->onDelete('set null');
            $table->timestamp('mulai_pemulihan')->nullable();
            $table->timestamp('batas_pemulihan')->nullable();
            $table->timestamp('selesai_pemulihan')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pemulihan_akses');
    }
};
