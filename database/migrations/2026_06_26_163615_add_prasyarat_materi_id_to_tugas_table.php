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
        Schema::table('tugas', function (Blueprint $table) {
            $table->foreignId('prasyarat_materi_id')->nullable()->after('guru_id')->constrained('tugas')->nullOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tugas', function (Blueprint $table) {
            $table->dropForeign(['prasyarat_materi_id']);
            $table->dropColumn('prasyarat_materi_id');
        });
    }
};
