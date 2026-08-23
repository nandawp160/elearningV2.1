<?php

namespace App\Enums;

enum AdaptiveAccessStatus: string
{
    case NORMAL = 'NORMAL';
    case WARNING = 'WARNING';
    case LOCKED = 'LOCKED';
    case RECOVERY = 'RECOVERY';

    public function label(): string
    {
        return match ($this) {
            self::NORMAL => 'Normal',
            self::WARNING => 'Peringatan',
            self::LOCKED => 'Terkunci (SSL)',
            self::RECOVERY => 'Mode Pemulihan',
        };
    }

    public function badgeClass(): string
    {
        return match ($this) {
            self::NORMAL => 'bg-emerald-50 text-emerald-700 border-emerald-200',
            self::WARNING => 'bg-amber-50 text-amber-700 border-amber-200',
            self::LOCKED => 'bg-rose-50 text-rose-700 border-rose-200',
            self::RECOVERY => 'bg-purple-50 text-purple-700 border-purple-200',
        };
    }

    public function icon(): string
    {
        return match ($this) {
            self::NORMAL => 'fas fa-check-circle',
            self::WARNING => 'fas fa-exclamation-triangle',
            self::LOCKED => 'fas fa-lock',
            self::RECOVERY => 'fas fa-sync-alt',
        };
    }
}
