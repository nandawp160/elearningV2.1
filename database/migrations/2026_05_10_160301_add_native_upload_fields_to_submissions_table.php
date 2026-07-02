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
            $table->string('original_name')->nullable()->after('file_tugas');
            $table->string('file_path')->nullable()->after('original_name');
            $table->unsignedBigInteger('file_size')->nullable()->after('file_path');
            $table->string('mime_type')->nullable()->after('file_size');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('pengumpulan_tugas', function (Blueprint $table) {
            $table->dropColumn(['original_name', 'file_path', 'file_size', 'mime_type']);
        });
    }
};
