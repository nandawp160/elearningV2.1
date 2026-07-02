<?php

use App\Models\Tugas;
use App\Models\JadwalPelajaran;
use Carbon\Carbon;

$subject = JadwalPelajaran::first();
if (!$subject) {
    echo "No subject found!\n";
    exit;
}

$assignment = Tugas::create([
    'subject_id' => $subject->id,
    'title' => 'UJI COBA PILIHAN GANDA (5 SOAL)',
    'description' => "Berikut adalah soal uji coba:\n\n1. Apa ibu kota Indonesia?\n   A. Jakarta\n   B. Bandung\n   C. Surabaya\n   D. Medan\n\n2. Hasil dari 2 + 2 adalah...\n   A. 3\n   B. 4\n   C. 5\n   D. 6\n\n3. Apa warna bendera Indonesia?\n   A. Merah Putih\n   B. Biru Putih\n   C. Kuning Hijau\n\n4. Planet ketiga dari Matahari adalah...\n   A. Mars\n   B. Venus\n   C. Bumi\n   D. Jupiter\n\n5. Ada berapa hari dalam satu minggu?\n   A. 5\n   B. 6\n   C. 7\n   D. 8",
    'due_date' => Carbon::now()->addDays(7),
    'max_score' => 100,
    'type' => 'multiple_choice',
    'answer_key' => 'A, B, A, C, C',
    'created_by' => $subject->teacher_id,
    'status' => 'active',
]);

echo "Assignment Created: ID " . $assignment->id . "\n";
echo "Kunci Jawaban: " . $assignment->answer_key . "\n";
