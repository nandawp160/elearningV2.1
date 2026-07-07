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
        if (!Schema::hasColumn('guru', 'tugas_tambahan_jtm')) {
            Schema::table('guru', function (Blueprint $table) {
                $table->integer('tugas_tambahan_jtm')->default(0)->after('status');
            });
        }

        if (!Schema::hasColumn('mata_pelajaran', 'beban_jp')) {
            Schema::table('mata_pelajaran', function (Blueprint $table) {
                $table->integer('beban_jp')->default(4)->after('status');
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if (Schema::hasColumn('guru', 'tugas_tambahan_jtm')) {
            Schema::table('guru', function (Blueprint $table) {
                $table->dropColumn('tugas_tambahan_jtm');
            });
        }

        if (Schema::hasColumn('mata_pelajaran', 'beban_jp')) {
            Schema::table('mata_pelajaran', function (Blueprint $table) {
                $table->dropColumn('beban_jp');
            });
        }
    }
};
