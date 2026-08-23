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
            $table->enum('tingkat_eskalasi', ['guru', 'wali_kelas', 'admin'])->default('guru')->after('status');
            $table->timestamp('waktu_eskalasi')->nullable()->after('tingkat_eskalasi');
            $table->boolean('is_provisional_unlocked')->default(false)->after('waktu_eskalasi');
            $table->timestamp('provisional_unlocked_at')->nullable()->after('is_provisional_unlocked');
            $table->timestamp('provisional_expires_at')->nullable()->after('provisional_unlocked_at');
        });

        Schema::table('pemulihan_akses', function (Blueprint $table) {
            $table->enum('tipe_pemulihan', ['normal', 'provisional', 'emergency_override'])->default('normal')->after('status_pemulihan');
            $table->foreignId('dibuka_oleh')->nullable()->after('tipe_pemulihan')->constrained('pengguna')->onDelete('set null');
            $table->text('alasan_darurat')->nullable()->after('dibuka_oleh');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('pengajuan_banding', function (Blueprint $table) {
            $table->dropColumn([
                'tingkat_eskalasi',
                'waktu_eskalasi',
                'is_provisional_unlocked',
                'provisional_unlocked_at',
                'provisional_expires_at',
            ]);
        });

        Schema::table('pemulihan_akses', function (Blueprint $table) {
            $table->dropForeign(['dibuka_oleh']);
            $table->dropColumn([
                'tipe_pemulihan',
                'dibuka_oleh',
                'alasan_darurat',
            ]);
        });
    }
};
