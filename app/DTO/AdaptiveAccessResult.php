<?php

namespace App\DTO;

use App\Enums\AdaptiveAccessStatus;
use Carbon\Carbon;

class AdaptiveAccessResult
{
    public function __construct(
        public readonly AdaptiveAccessStatus $status,
        public readonly int $jumlahTunggakan,
        public readonly int $threshold,
        public readonly ?int $targetTugasId = null,
        public readonly ?Carbon $recoveryExpiresAt = null,
        public readonly ?string $appealStatus = null,
        public readonly string $reasonCode = 'NO_OVERDUE',
        public readonly string $nextAction = 'Tidak ada tindakan yang diperlukan',
        public readonly bool $canAppeal = false,
        public readonly string $thresholdSource = 'SYSTEM_FALLBACK',
        public readonly ?int $teacherThreshold = null,
    ) {}

    public function isLocked(): bool
    {
        return $this->status === AdaptiveAccessStatus::LOCKED;
    }

    public function isLockSsl(): bool
    {
        return $this->status === AdaptiveAccessStatus::LOCKED;
    }

    public function isWarning(): bool
    {
        return $this->status === AdaptiveAccessStatus::WARNING;
    }

    public function isEws(): bool
    {
        return $this->status === AdaptiveAccessStatus::WARNING;
    }

    public function isRecovery(): bool
    {
        return $this->status === AdaptiveAccessStatus::RECOVERY;
    }

    public function isNormal(): bool
    {
        return $this->status === AdaptiveAccessStatus::NORMAL;
    }

    public function statusLabel(): string
    {
        return $this->status->label();
    }

    public function badgeClass(): string
    {
        return $this->status->badgeClass();
    }

    public function icon(): string
    {
        return $this->status->icon();
    }

    public function toArray(): array
    {
        return [
            'status'              => $this->status->value,
            'status_label'        => $this->statusLabel(),
            'is_normal'           => $this->isNormal(),
            'is_ews'              => $this->isEws(),
            'is_lock_ssl'         => $this->isLockSsl(),
            'is_recovery'         => $this->isRecovery(),
            'jumlah_tunggakan'    => $this->jumlahTunggakan,
            'threshold'           => $this->threshold,
            'target_tugas_id'     => $this->targetTugasId,
            'recovery_expires_at' => $this->recoveryExpiresAt?->toISOString(),
            'appeal_status'       => $this->appealStatus,
            'reason_code'         => $this->reasonCode,
            'next_action'         => $this->nextAction,
            'can_appeal'          => $this->canAppeal,
            'badge_class'         => $this->badgeClass(),
            'icon'                => $this->icon(),
        ];
    }
}
