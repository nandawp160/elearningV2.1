<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Table subjects is omitted in Indonesian schema (fallback maps to mata_pelajaran)
    }

    public function down(): void
    {
        // Do nothing
    }
};
