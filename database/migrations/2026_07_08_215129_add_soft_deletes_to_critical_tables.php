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
            $table->softDeletes();
        });

        Schema::table('guru', function (Blueprint $table) {
            $table->softDeletes();
        });

        Schema::table('tugas', function (Blueprint $table) {
            $table->softDeletes();
        });

        Schema::table('pengumpulan_tugas', function (Blueprint $table) {
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('critical_tables', function (Blueprint $table) {
            //
        });
    }
};
