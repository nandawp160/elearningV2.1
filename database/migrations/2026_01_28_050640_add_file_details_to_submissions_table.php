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
        Schema::table('pengumpulan_tugas', function (Blueprint $table) {
            $table->string('file_name')->nullable()->after('drive_link');
            $table->string('file_icon')->nullable()->after('file_name');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('pengumpulan_tugas', function (Blueprint $table) {
            $table->dropColumn(['file_name', 'file_icon']);
        });
    }
};
