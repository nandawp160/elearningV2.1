<?php
require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;

if (!Schema::hasColumn('guru', 'allowed_grades')) {
    Schema::table('guru', function (Blueprint $table) {
        $table->json('allowed_grades')->nullable()->after('specialization_id');
    });
    echo 'Column added successfully.';
} else {
    echo 'Column already exists.';
}
