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
            $table->string('nip')->nullable()->change();
            $table->string('email')->nullable()->change();
        });

        Schema::table('siswa', function (Blueprint $table) {
            $table->string('nis')->nullable()->change();
            $table->string('tempat_lahir')->nullable()->after('nama');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('guru', function (Blueprint $table) {
            $table->string('nip')->nullable(false)->change();
            $table->string('email')->nullable(false)->change();
        });

        Schema::table('siswa', function (Blueprint $table) {
            $table->string('nis')->nullable(false)->change();
            $table->dropColumn('tempat_lahir');
        });
    }
};
