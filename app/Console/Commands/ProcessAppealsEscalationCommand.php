<?php

namespace App\Console\Commands;

use App\Models\ActivityLog;
use App\Models\Banding;
use App\Models\GuruKelas;
use App\Models\PemulihanPengumpulan;
use App\Models\Tugas;
use Carbon\Carbon;
use Illuminate\Console\Command;

class ProcessAppealsEscalationCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'appeals:escalate-sla';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Process SLA auto-escalation (Wali Kelas / Admin) and provisional recovery unlock for overdue pending appeals';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Starting SLA checks on pending appeals...');

        $pendingAppeals = Banding::with(['student', 'subject'])
            ->whereIn('status', ['pending', 'ditinjau'])
            ->get();

        $escalatedCount = 0;
        $provisionalCount = 0;
        $now = Carbon::now();

        foreach ($pendingAppeals as $appeal) {
            $student = $appeal->student;
            $studentKelas = $student?->kelas ?? $student?->resolved_kelas;
            $kelas = $studentKelas ? \App\Models\Kelas::where('name', $studentKelas)->first() : null;
            $hoursElapsed = $appeal->created_at ? $appeal->created_at->diffInHours($now) : 0;

            // Check assigned teacher status
            $assignedTeacher = null;
            if ($kelas) {
                $guruKelas = GuruKelas::where('mata_pelajaran_id', $appeal->mata_pelajaran_id)
                    ->where('kelas_id', $kelas->id)
                    ->with('guru')
                    ->first();
                $assignedTeacher = $guruKelas?->guru;
            }
            if (!$assignedTeacher) {
                $assignedTeacher = \App\Models\Guru::where('specialization_id', $appeal->mata_pelajaran_id)->first();
            }
            $isTeacherAbsent = ($assignedTeacher && $assignedTeacher->status !== 'active');

            // 1. Check Escalation Level
            if ($hoursElapsed >= 48 && $appeal->tingkat_eskalasi !== 'admin') {
                $appeal->update([
                    'tingkat_eskalasi' => 'admin',
                    'waktu_eskalasi' => $now,
                ]);
                $escalatedCount++;

                ActivityLog::logEmergency(
                    'SYSTEM_AUTO_ESCALATION',
                    "Eskalasi otomatis ke antrean prioritas Admin untuk pengajuan banding ID #{$appeal->id} (>48 Jam).",
                    [
                        'banding_id' => $appeal->id,
                        'siswa' => $student?->nama,
                        'kelas' => $studentKelas,
                        'mata_pelajaran_id' => $appeal->mata_pelajaran_id,
                        'tingkat_eskalasi' => 'admin',
                        'usia_jam' => $hoursElapsed,
                    ]
                );
            } elseif (($hoursElapsed >= 24 || $isTeacherAbsent) && $appeal->tingkat_eskalasi === 'guru') {
                $appeal->update([
                    'tingkat_eskalasi' => 'wali_kelas',
                    'waktu_eskalasi' => $now,
                ]);
                $escalatedCount++;

                $reasonMsg = $isTeacherAbsent
                    ? "Eskalasi otomatis ke Wali Kelas karena guru mata pelajaran berhalangan/nonaktif."
                    : "Eskalasi otomatis ke Wali Kelas untuk pengajuan banding ID #{$appeal->id} (>24 Jam).";

                ActivityLog::logEmergency(
                    'SYSTEM_AUTO_ESCALATION',
                    $reasonMsg,
                    [
                        'banding_id' => $appeal->id,
                        'siswa' => $student?->nama,
                        'kelas' => $studentKelas,
                        'mata_pelajaran_id' => $appeal->mata_pelajaran_id,
                        'tingkat_eskalasi' => 'wali_kelas',
                        'usia_jam' => $hoursElapsed,
                        'guru_absent' => $isTeacherAbsent ? 'Ya' : 'Tidak',
                    ]
                );
            }

            // 2. Check Provisional Recovery Unlock Condition
            // Condition: Pending >= 24h OR teacher absent, provisional not yet triggered, AND next upcoming assignment deadline < 12 hours
            if (!$appeal->is_provisional_unlocked && ($hoursElapsed >= 24 || $isTeacherAbsent)) {
                $hasUpcomingDeadline = Tugas::where('mata_pelajaran_id', $appeal->mata_pelajaran_id)
                    ->where('status', 'aktif')
                    ->whereBetween('deadline', [$now, $now->copy()->addHours(12)])
                    ->exists();

                // Also trigger if there are multiple overdue assignments and student has been waiting > 24 hours
                if ($hasUpcomingDeadline || $hoursElapsed >= 24) {
                    $oldestOverdue = Tugas::tugas()
                        ->where('mata_pelajaran_id', $appeal->mata_pelajaran_id)
                        ->where('status', 'aktif')
                        ->where('deadline', '<', $now)
                        ->whereDoesntHave('submissions', fn($q) => $q->where('siswa_id', $appeal->siswa_id))
                        ->orderBy('deadline', 'asc')
                        ->first();

                    if ($oldestOverdue) {
                        PemulihanPengumpulan::updateOrCreate(
                            [
                                'siswa_id' => $appeal->siswa_id,
                                'mata_pelajaran_id' => $appeal->mata_pelajaran_id,
                            ],
                            [
                                'status_pemulihan' => 'aktif',
                                'tipe_pemulihan' => 'provisional',
                                'durasi_jam' => 24,
                                'tugas_id' => $oldestOverdue->id,
                                'mulai_pemulihan' => $now,
                                'batas_pemulihan' => $now->copy()->addHours(24),
                                'selesai_pemulihan' => null,
                                'alasan_darurat' => 'Akses Pemulihan Sementara (Provisional Unlock 24 Jam) oleh Sistem SLA',
                            ]
                        );

                        $appeal->update([
                            'is_provisional_unlocked' => true,
                            'provisional_unlocked_at' => $now,
                            'provisional_expires_at' => $now->copy()->addHours(24),
                        ]);

                        $provisionalCount++;

                        ActivityLog::logEmergency(
                            'PROVISIONAL_UNLOCK',
                            "Akses pemulihan sementara (Provisional Unlock 24 Jam) diaktifkan untuk tugas #{$oldestOverdue->id} ({$oldestOverdue->judul}).",
                            [
                                'banding_id' => $appeal->id,
                                'siswa' => $student?->nama,
                                'kelas' => $studentKelas,
                                'tugas' => $oldestOverdue->judul,
                                'mata_pelajaran_id' => $appeal->mata_pelajaran_id,
                                'masa_berlaku' => '24 Jam',
                            ]
                        );
                    }
                }
            }
        }

        $this->info("SLA check completed: {$escalatedCount} appeals escalated, {$provisionalCount} provisional access granted.");
        return Command::SUCCESS;
    }
}
