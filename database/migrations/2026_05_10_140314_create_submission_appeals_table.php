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
        Schema::create('pengajuan_banding', function (Blueprint $table) {
            $table->id();
            $table->foreignId('siswa_id')->constrained('siswa')->onDelete('cascade');
            $table->foreignId('mata_pelajaran_id')->constrained('mata_pelajaran')->onDelete('cascade');
            $table->text('alasan');
            $table->enum('status', ['ditinjau', 'diterima', 'ditolak'])->default('ditinjau');
            $table->foreignId('disetujui_oleh')->nullable()->constrained('pengguna')->onDelete('set null');
            $table->timestamp('tanggal_persetujuan')->nullable();
            $table->foreignId('tugas_id')->nullable()->constrained('tugas')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pengajuan_banding');
    }
};
