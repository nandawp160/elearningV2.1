<?php
echo json_encode(App\Models\Kelas::with('homeroomTeacher')->get()->map(function($k) { return ['kelas' => $k->name, 'wali' => $k->homeroomTeacher->nama ?? null]; })->toArray());
exit;
