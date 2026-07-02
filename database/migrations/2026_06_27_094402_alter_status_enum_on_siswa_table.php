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
        Schema::table('siswa', function (Blueprint $table) {
            \Illuminate\Support\Facades\DB::statement("ALTER TABLE siswa MODIFY status ENUM('aktif', 'nonaktif', 'lulus', 'mutasi') DEFAULT 'aktif'");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('siswa', function (Blueprint $table) {
            \Illuminate\Support\Facades\DB::statement("ALTER TABLE siswa MODIFY status ENUM('aktif', 'nonaktif') DEFAULT 'aktif'");
        });
    }
};
