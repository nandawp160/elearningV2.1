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
        Schema::table('pemulihan_akses', function (Blueprint $table) {
            $table->unique(['siswa_id', 'mata_pelajaran_id'], 'unique_siswa_subject_recovery');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('pemulihan_akses', function (Blueprint $table) {
            $table->dropUnique('unique_siswa_subject_recovery');
        });
    }
};
