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
        // 1. Move data from tugas to materials
        $materis = DB::table('tugas')->where('deadline', '>', '2030-01-01 00:00:00')->get();
        $mapping = [];

        foreach ($materis as $materi) {
            $attachment = $materi->lampiran;
            $type = 'document';
            $url = null;
            $filePath = null;

            if ($attachment) {
                if (filter_var($attachment, FILTER_VALIDATE_URL) || str_starts_with($attachment, 'http://') || str_starts_with($attachment, 'https://')) {
                    $type = 'link';
                    $url = $attachment;
                } else {
                    $filePath = $attachment;
                    $ext = strtolower(pathinfo($attachment, PATHINFO_EXTENSION));
                    if ($ext === 'pdf') {
                        $type = 'pdf';
                    } elseif (in_array($ext, ['doc', 'docx'])) {
                        $type = 'document';
                    } elseif (in_array($ext, ['mp4', 'mkv', 'avi', 'mov'])) {
                        $type = 'video';
                    } else {
                        $type = 'other';
                    }
                }
            }

            // guru_id might be null in tugas? materials table uploaded_by is not nullable (constrained).
            // Let's fallback to the first teacher if null, or just let it fail if the data is bad.
            // If it fails, the user will know. But wait, tugas.guru_id is nullable.
            // materials.uploaded_by is NOT nullable.
            $guruId = $materi->guru_id;
            if (!$guruId) {
                $guruId = DB::table('guru')->first()->id ?? 1;
            }

            $newId = DB::table('materials')->insertGetId([
                'subject_id' => $materi->mata_pelajaran_id,
                'title' => $materi->judul,
                'description' => $materi->deskripsi,
                'type' => $type,
                'file_path' => $filePath,
                'url' => $url,
                'uploaded_by' => $guruId,
                'created_at' => $materi->created_at,
                'updated_at' => $materi->updated_at,
            ]);

            $mapping[$materi->id] = $newId;
        }

        // 2. Drop constraints from pelacakan_materi and tugas
        // Schema::table('pelacakan_materi', function (Blueprint $table) {
        //     $table->index('siswa_id'); // Add index for foreign key to use
        // });
        
        Schema::table('pelacakan_materi', function (Blueprint $table) {
            $table->dropForeign(['tugas_id']);
            $table->dropUnique(['siswa_id', 'tugas_id']);
        });

        Schema::table('tugas', function (Blueprint $table) {
            $table->dropForeign(['prasyarat_materi_id']);
        });

        // 3. Update IDs in pelacakan_materi and tugas
        foreach ($mapping as $oldId => $newId) {
            DB::table('pelacakan_materi')->where('tugas_id', $oldId)->update(['tugas_id' => $newId]);
            DB::table('tugas')->where('prasyarat_materi_id', $oldId)->update(['prasyarat_materi_id' => $newId]);
        }

        
        // Also remove any tracking records for tugas that are NOT materials, just in case
        // Wait, pelacakan_materi is ONLY for materials right now.
        // Let's delete records that didn't map to a new material ID to prevent foreign key errors.
        if (count($mapping) > 0) {
            DB::table('pelacakan_materi')->whereNotIn('tugas_id', array_values($mapping))->delete();
        } else {
            DB::table('pelacakan_materi')->delete();
        }

        // 4. Rename column and add new constraints
        Schema::table('pelacakan_materi', function (Blueprint $table) {
            $table->renameColumn('tugas_id', 'materi_id');
        });

        Schema::table('pelacakan_materi', function (Blueprint $table) {
            $table->foreign('materi_id')->references('id')->on('materials')->onDelete('cascade');
            $table->unique(['siswa_id', 'materi_id']);
        });

        Schema::table('tugas', function (Blueprint $table) {
            $table->foreign('prasyarat_materi_id')->references('id')->on('materials')->nullOnDelete();
        });

        // 5. Delete old materi records from tugas table
        DB::table('tugas')->where('deadline', '>', '2030-01-01 00:00:00')->delete();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Reverting this is complex and out of scope for a simple migration fix
    }
};
