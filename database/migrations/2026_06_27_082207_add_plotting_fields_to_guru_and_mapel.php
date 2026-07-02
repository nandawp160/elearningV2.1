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
        Schema::table('guru', function (Blueprint $table) {
            $table->integer('tugas_tambahan_jtm')->default(0)->after('status');
        });

        Schema::table('mata_pelajaran', function (Blueprint $table) {
            $table->integer('beban_jp')->default(4)->after('status');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('guru_and_mapel', function (Blueprint $table) {
            //
        });
    }
};
