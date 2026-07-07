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
        if (!Schema::hasColumn('mata_pelajaran', 'beban_jp')) {
            Schema::table('mata_pelajaran', function (Blueprint $table) {
                $table->integer('beban_jp')->default(4)->after('tingkat');
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if (Schema::hasColumn('mata_pelajaran', 'beban_jp')) {
            Schema::table('mata_pelajaran', function (Blueprint $table) {
                $table->dropColumn('beban_jp');
            });
        }
    }
};
