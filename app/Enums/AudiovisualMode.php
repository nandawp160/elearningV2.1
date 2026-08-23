<?php

namespace App\Enums;

enum AudiovisualMode: string
{
    case AUDIO_FILE = 'audio_file';
    case VIDEO_URL = 'video_url';
    case EITHER = 'either';

    /**
     * Get label for display
     */
    public function label(): string
    {
        return match($this) {
            self::AUDIO_FILE => 'Rekaman Audio Saja',
            self::VIDEO_URL => 'Tautan Video Saja',
            self::EITHER => 'Audio atau Video Bebas',
        };
    }
}
