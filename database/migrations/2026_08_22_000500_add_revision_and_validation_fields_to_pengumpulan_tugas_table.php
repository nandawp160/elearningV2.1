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
            $table->string('status', 50)->default('submitted')->change();
            $table->text('alasan_pengembalian')->nullable()->after('status');
            $table->timestamp('dikembalikan_pada')->nullable()->after('alasan_pengembalian');
            $table->foreignId('dikembalikan_oleh')->nullable()->after('dikembalikan_pada')->constrained('pengguna')->onDelete('set null');
            $table->unsignedInteger('revisi_ke')->default(0)->after('dikembalikan_oleh');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('pengumpulan_tugas', function (Blueprint $table) {
            $table->dropForeign(['dikembalikan_oleh']);
            $table->dropColumn([
                'alasan_pengembalian',
                'dikembalikan_pada',
                'dikembalikan_oleh',
                'revisi_ke',
            ]);
        });
    }
};
