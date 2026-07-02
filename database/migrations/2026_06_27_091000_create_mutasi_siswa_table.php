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
        Schema::create('mutasi_siswa', function (Blueprint $table) {
            $table->id();
            $table->foreignId('siswa_id')->constrained('siswa')->cascadeOnDelete();
            $table->enum('jenis_mutasi', ['masuk', 'keluar', 'dikeluarkan', 'mengundurkan diri'])->default('keluar');
            $table->date('tanggal_mutasi');
            $table->string('keterangan_sekolah')->nullable()->comment('Asal sekolah jika masuk, tujuan jika keluar');
            $table->text('alasan')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mutasi_siswa');
    }
};
