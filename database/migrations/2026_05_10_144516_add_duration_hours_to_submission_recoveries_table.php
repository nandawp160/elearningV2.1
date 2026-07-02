<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('pemulihan_akses', function (Blueprint $table) {
            $table->integer('durasi_jam')->default(48)->after('status_pemulihan');
        });
    }

    public function down(): void
    {
        Schema::table('pemulihan_akses', function (Blueprint $table) {
            $table->dropColumn('durasi_jam');
        });
    }
};
