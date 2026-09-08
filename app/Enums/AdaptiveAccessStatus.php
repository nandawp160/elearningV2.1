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
            self::WARNING => 'EWS (Peringatan Dini)',
            self::LOCKED => 'Lock SSL (Terkunci)',
            self::RECOVERY => 'Mode Pemulihan',
        };
    }

    public function shortLabel(): string
    {
        return match ($this) {
            self::NORMAL => 'Normal',
            self::WARNING => 'EWS',
            self::LOCKED => 'Lock SSL',
            self::RECOVERY => 'Pemulihan',
        };
    }

    public function isNormal(): bool
    {
        return $this === self::NORMAL;
    }

    public function isWarning(): bool
    {
        return $this === self::WARNING;
    }

    public function isEws(): bool
    {
        return $this === self::WARNING;
    }

    public function isLocked(): bool
    {
        return $this === self::LOCKED;
    }

    public function isLockSsl(): bool
    {
        return $this === self::LOCKED;
    }

    public function isRecovery(): bool
    {
        return $this === self::RECOVERY;
    }

    public function badgeClass(): string
    {
        return match ($this) {
            self::NORMAL => 'bg-emerald-50 text-emerald-700 border-emerald-200 dark:bg-emerald-950/50 dark:text-emerald-400 dark:border-emerald-800',
            self::WARNING => 'bg-amber-50 text-amber-700 border-amber-200 dark:bg-amber-950/50 dark:text-amber-400 dark:border-amber-800',
            self::LOCKED => 'bg-rose-50 text-rose-700 border-rose-200 dark:bg-rose-950/50 dark:text-rose-400 dark:border-rose-800',
            self::RECOVERY => 'bg-purple-50 text-purple-700 border-purple-200 dark:bg-purple-950/50 dark:text-purple-400 dark:border-purple-800',
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
