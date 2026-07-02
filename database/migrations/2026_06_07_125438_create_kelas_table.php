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
        Schema::create('kelas', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->enum('grade_level', ['X', 'XI', 'XII']);
            $table->enum('major', ['IPA', 'IPS']);
            $table->foreignId('homeroom_teacher_id')->nullable()->constrained('guru')->onDelete('set null');
            $table->string('academic_year');
            $table->integer('max_students')->default(40);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kelas');
    }
};
