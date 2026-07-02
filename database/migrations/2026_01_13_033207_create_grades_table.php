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
        Schema::create('grades', function (Blueprint $table) {
            $table->id();
            $table->foreignId('submission_id')->nullable()->constrained('pengumpulan_tugas')->onDelete('cascade');
            $table->foreignId('subject_id')->constrained('mata_pelajaran')->onDelete('cascade');
            $table->foreignId('student_id')->constrained('siswa')->onDelete('cascade');
            $table->enum('type', ['assignment', 'quiz', 'midterm', 'final'])->default('assignment');
            $table->decimal('score', 5, 2);
            $table->integer('max_score')->default(100);
            $table->text('feedback')->nullable();
            $table->foreignId('graded_by')->constrained('guru')->onDelete('cascade');
            $table->dateTime('graded_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('grades');
    }
};
