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
        Schema::create('attendances', function (Blueprint $table) {
            $table->id();
            $table->foreignId('subject_id')->constrained('mata_pelajaran')->onDelete('cascade');
            $table->foreignId('student_id')->constrained('siswa')->onDelete('cascade');
            $table->date('date');
            $table->enum('status', ['Hadir', 'Izin', 'Sakit', 'Alpa'])->default('Hadir');
            $table->text('notes')->nullable();
            $table->foreignId('marked_by')->constrained('guru')->onDelete('cascade');
            $table->timestamps();
            
            $table->unique(['subject_id', 'student_id', 'date']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('attendances');
    }
};
