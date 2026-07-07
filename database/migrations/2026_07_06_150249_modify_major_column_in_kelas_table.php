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
        if (Schema::getConnection()->getDriverName() === 'sqlite') {
            Schema::table('kelas', function (Blueprint $table) {
                $table->string('major')->nullable()->change();
            });
        } else {
            DB::statement("ALTER TABLE kelas MODIFY major VARCHAR(255) NULL");
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if (Schema::getConnection()->getDriverName() === 'sqlite') {
            Schema::table('kelas', function (Blueprint $table) {
                // SQLite change back to enum-like or string
                $table->string('major')->nullable(false)->change();
            });
        } else {
            DB::statement("ALTER TABLE kelas MODIFY major ENUM('IPA', 'IPS') NOT NULL DEFAULT 'IPA'");
        }
    }
};
