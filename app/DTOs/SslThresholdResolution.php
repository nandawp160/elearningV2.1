<?php

namespace App\DTOs;

final readonly class SslThresholdResolution
{
    public function __construct(
        public int $effectiveThreshold,
        public string $source,
        public ?int $teacherOverride,
        public ?int $schoolDefault,
        public int $minimumAllowed,
        public int $maximumAllowed,
        public ?int $guruKelasId = null,
    ) {}
}
