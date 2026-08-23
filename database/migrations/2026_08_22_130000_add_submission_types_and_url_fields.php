<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // 1. Modifikasi tabel tugas
        Schema::table('tugas', function (Blueprint $table) {
            if (!Schema::hasColumn('tugas', 'tipe_pengumpulan')) {
                $table->string('tipe_pengumpulan', 30)->default('dokumen')->after('deskripsi');
            }
            if (!Schema::hasColumn('tugas', 'mode_audiovisual')) {
                $table->string('mode_audiovisual', 30)->nullable()->after('tipe_pengumpulan');
            }
        });

        // 2. Modifikasi tabel pengumpulan_tugas
        Schema::table('pengumpulan_tugas', function (Blueprint $table) {
            if (!Schema::hasColumn('pengumpulan_tugas', 'submission_url')) {
                $table->text('submission_url')->nullable()->after('file_tugas');
            }
            // Pastikan metadata berkas bersifat nullable untuk pengumpulan URL
            $table->string('file_tugas')->nullable()->change();
            $table->string('file_path')->nullable()->change();
            $table->string('original_name')->nullable()->change();
            $table->unsignedBigInteger('file_size')->nullable()->change();
            $table->string('mime_type')->nullable()->change();
        });

        // 3. Salin data lama dari drive_link ke submission_url jika ada
        if (Schema::hasColumn('pengumpulan_tugas', 'drive_link')) {
            DB::table('pengumpulan_tugas')
                ->whereNotNull('drive_link')
                ->whereNull('submission_url')
                ->update(['submission_url' => DB::raw('drive_link')]);
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tugas', function (Blueprint $table) {
            if (Schema::hasColumn('tugas', 'mode_audiovisual')) {
                $table->dropColumn('mode_audiovisual');
            }
            if (Schema::hasColumn('tugas', 'tipe_pengumpulan')) {
                $table->dropColumn('tipe_pengumpulan');
            }
        });

        Schema::table('pengumpulan_tugas', function (Blueprint $table) {
            if (Schema::hasColumn('pengumpulan_tugas', 'submission_url')) {
                $table->dropColumn('submission_url');
            }
        });
    }
};
