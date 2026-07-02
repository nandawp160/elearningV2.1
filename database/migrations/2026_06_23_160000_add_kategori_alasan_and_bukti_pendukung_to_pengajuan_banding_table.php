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
        Schema::table('pengajuan_banding', function (Blueprint $table) {
            $table->string('kategori_alasan')->nullable()->after('alasan');
            $table->string('bukti_pendukung')->nullable()->after('kategori_alasan');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('pengajuan_banding', function (Blueprint $table) {
            $table->dropColumn(['kategori_alasan', 'bukti_pendukung']);
        });
    }
};
