<?php

namespace App\Enums;

enum AssignmentSubmissionType: string
{
    case VISUAL = 'visual';
    case DOCUMENT = 'dokumen';
    case AUDIOVISUAL = 'audiovisual';
    case EXTERNAL_URL = 'tautan';

    /**
     * Get label for display
     */
    public function label(): string
    {
        return match($this) {
            self::VISUAL => 'Media Visual',
            self::DOCUMENT => 'Berkas Dokumen',
            self::AUDIOVISUAL => 'Multimedia Audiovisual',
            self::EXTERNAL_URL => 'Tautan Karya Eksternal',
        };
    }
}
