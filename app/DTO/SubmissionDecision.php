<?php

namespace App\DTO;

use App\Enums\AdaptiveAccessStatus;

class SubmissionDecision
{
    public function __construct(
        public readonly bool $allowed,
        public readonly AdaptiveAccessStatus $sslStatus,
        public readonly bool $prerequisiteMet = true,
        public readonly string $reasonCode = 'ALLOWED',
        public readonly string $message = 'Pengumpulan tugas diizinkan.',
        public readonly ?int $targetTugasId = null,
        public readonly ?int $prerequisiteMaterialId = null,
        public readonly ?string $prerequisiteTitle = null,
        public readonly bool $canAppeal = false,
        public readonly ?int $subjectId = null,
        public readonly int $tunggakanCount = 0,
        public readonly int $returnedCount = 0
    ) {}

    public function toArray(): array
    {
        return [
            'allowed'                  => $this->allowed,
            'ssl_status'               => $this->sslStatus->value,
            'prerequisite_met'         => $this->prerequisiteMet,
            'reason_code'              => $this->reasonCode,
            'message'                  => $this->message,
            'target_tugas_id'          => $this->targetTugasId,
            'prerequisite_material_id' => $this->prerequisiteMaterialId,
            'prerequisite_title'       => $this->prerequisiteTitle,
            'can_appeal'               => $this->canAppeal,
            'subject_id'               => $this->subjectId,
            'tunggakan_count'          => $this->tunggakanCount,
            'returned_count'           => $this->returnedCount,
        ];
    }
}
