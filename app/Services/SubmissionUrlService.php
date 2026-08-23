<?php

namespace App\Services;

class SubmissionUrlService
{
    /**
     * Whitelist Hostnames for Video Providers
     */
    protected array $allowedVideoHosts = [
        'youtube.com',
        'www.youtube.com',
        'm.youtube.com',
        'youtu.be',
        'youtube-nocookie.com',
        'www.youtube-nocookie.com',
        'drive.google.com',
        'loom.com',
        'www.loom.com',
    ];

    /**
     * Whitelist Hostnames for External Project Providers
     */
    protected array $allowedProjectHosts = [
        'canva.com',
        'www.canva.com',
        'figma.com',
        'www.figma.com',
        'github.com',
        'www.github.com',
        'drive.google.com',
        'docs.google.com',
    ];

    /**
     * Check if a URL has a valid HTTPS scheme and no HTML/iframe tags.
     */
    public function isValidHttpsUrl(?string $url): bool
    {
        if (empty($url) || strlen($url) > 2048) {
            return false;
        }

        // Hard block any raw HTML / iframe injection
        if (preg_match('/<[^>]*>|javascript:|data:/i', $url)) {
            return false;
        }

        // Must start with https://
        if (!str_starts_with(strtolower(trim($url)), 'https://')) {
            return false;
        }

        return filter_var($url, FILTER_VALIDATE_URL) !== false;
    }

    /**
     * Extract normalized hostname from URL
     */
    public function extractHost(?string $url): ?string
    {
        if (!$this->isValidHttpsUrl($url)) {
            return null;
        }

        $host = parse_url($url, PHP_URL_HOST);
        return $host ? strtolower($host) : null;
    }

    /**
     * Check exact host match against whitelist
     */
    protected function matchHost(string $host, array $allowedHosts): bool
    {
        $host = strtolower(trim($host));
        foreach ($allowedHosts as $allowed) {
            $allowed = strtolower(trim($allowed));
            if ($host === $allowed) {
                return true;
            }
            // Strict subdomain matching (e.g. *.youtube.com or *.google.com)
            if (str_ends_with($host, '.' . $allowed)) {
                // Ensure no evil domains like youtube.com.evil.test
                return true;
            }
        }
        return false;
    }

    /**
     * Check if URL is an allowed video URL
     */
    public function isAllowedVideoUrl(?string $url): bool
    {
        $host = $this->extractHost($url);
        if (!$host) {
            return false;
        }

        return $this->matchHost($host, config('assignment_submission.allowed_video_hosts', $this->allowedVideoHosts));
    }

    /**
     * Check if URL is an allowed project URL
     */
    public function isAllowedProjectUrl(?string $url): bool
    {
        $host = $this->extractHost($url);
        if (!$host) {
            return false;
        }

        return $this->matchHost($host, config('assignment_submission.allowed_project_hosts', $this->allowedProjectHosts));
    }

    /**
     * Validate submission URL depending on target assignment type (supports Enums or strings)
     */
    public function validateUrl(?string $url, $assignmentType = 'audiovisual', $mode = null): array
    {
        $typeStr = is_object($assignmentType) && enum_exists(get_class($assignmentType)) ? $assignmentType->value : (string) $assignmentType;
        
        if (empty($url)) {
            return ['valid' => false, 'error' => 'Tautan pengumpulan wajib diisi.', 'message' => 'Tautan pengumpulan wajib diisi.', 'platform' => null];
        }

        if (strlen($url) > 2048) {
            return ['valid' => false, 'error' => 'Tautan pengumpulan maksimal 2.048 karakter.', 'message' => 'Tautan pengumpulan maksimal 2.048 karakter.', 'platform' => null];
        }

        if (preg_match('/<[^>]*>|javascript:|data:/i', $url)) {
            return ['valid' => false, 'error' => 'Format URL tidak valid atau mengandung tag script / HTML', 'message' => 'Format URL tidak valid atau mengandung tag script / HTML', 'platform' => null];
        }

        if (!str_starts_with(strtolower(trim($url)), 'https://')) {
            return ['valid' => false, 'error' => 'Tautan wajib menggunakan protokol HTTPS', 'message' => 'Tautan wajib menggunakan protokol HTTPS', 'platform' => null];
        }

        if (!$this->isValidHttpsUrl($url)) {
            return ['valid' => false, 'error' => 'Format URL tidak valid', 'message' => 'Format URL tidak valid', 'platform' => null];
        }

        $host = $this->extractHost($url);
        if (!$host) {
            return ['valid' => false, 'error' => 'Domain tautan tidak valid', 'message' => 'Domain tautan tidak valid', 'platform' => null];
        }

        if ($typeStr === 'audiovisual') {
            if (!$this->isAllowedVideoUrl($url)) {
                return [
                    'valid' => false,
                    'error' => "Domain {$host} tidak diizinkan untuk pengumpulan video",
                    'message' => "Domain {$host} tidak diizinkan untuk pengumpulan video",
                    'platform' => null,
                ];
            }
            $embed = $this->getVideoEmbedData($url);
            return [
                'valid' => true,
                'error' => null,
                'message' => null,
                'platform' => $embed['provider'] ?? 'video',
                'host' => $host,
            ];
        } elseif ($typeStr === 'tautan') {
            if (!$this->isAllowedProjectUrl($url)) {
                return [
                    'valid' => false,
                    'error' => "Domain {$host} tidak diizinkan untuk tautan karya",
                    'message' => "Domain {$host} tidak diizinkan untuk tautan karya",
                    'platform' => null,
                ];
            }
            $proj = $this->getProjectPlatformData($url);
            return [
                'valid' => true,
                'error' => null,
                'message' => null,
                'platform' => $proj['platform'] ?? 'project',
                'host' => $host,
            ];
        }

        return ['valid' => true, 'error' => null, 'message' => null, 'host' => $host, 'platform' => 'generic'];
    }

    /**
     * Validate submission URL depending on target assignment type
     */
    public function validateSubmissionUrl(?string $url, string $assignmentType): array
    {
        return $this->validateUrl($url, $assignmentType);
    }

    /**
     * Parse video URL into clean embed data (alias for getVideoEmbedData)
     */
    public function parseEmbedData(?string $url): array
    {
        $data = $this->getVideoEmbedData($url);
        if ($data) {
            return array_merge(['is_embeddable' => true], $data);
        }
        return ['is_embeddable' => false, 'embed_url' => null];
    }

    /**
     * Parse video URL into clean embed data
     */
    public function getVideoEmbedData(?string $url): ?array
    {
        if (!$url || !$this->isAllowedVideoUrl($url)) {
            return null;
        }

        $host = $this->extractHost($url);

        // 1. YouTube Handler
        if (str_contains($host, 'youtube.com') || str_contains($host, 'youtu.be') || str_contains($host, 'youtube-nocookie.com')) {
            $videoId = null;

            if (preg_match('/(?:youtube\.com\/(?:[^\/]+\/.+\/|(?:v|e(?:mbed)?)\/|.*[?&]v=)|youtu\.be\/|youtube\.com\/shorts\/)([^"&?\/\s]{11})/i', $url, $matches)) {
                $videoId = $matches[1];
            }

            if ($videoId) {
                return [
                    'provider' => 'youtube',
                    'provider_name' => 'YouTube',
                    'video_id' => $videoId,
                    'embed_url' => "https://www.youtube-nocookie.com/embed/{$videoId}",
                    'backup_url' => $url,
                    'icon' => 'fab fa-youtube text-red-600',
                ];
            }
        }

        // 2. Google Drive Handler
        if ($host === 'drive.google.com') {
            $fileId = null;

            if (preg_match('/\/file\/d\/([a-zA-Z0-9_-]+)/i', $url, $matches)) {
                $fileId = $matches[1];
            } elseif (preg_match('/[?&]id=([a-zA-Z0-9_-]+)/i', $url, $matches)) {
                $fileId = $matches[1];
            }

            if ($fileId) {
                return [
                    'provider' => 'google_drive',
                    'provider_name' => 'Google Drive',
                    'video_id' => $fileId,
                    'embed_url' => "https://drive.google.com/file/d/{$fileId}/preview",
                    'backup_url' => $url,
                    'icon' => 'fab fa-google-drive text-amber-500',
                ];
            }
        }

        // 3. Loom Handler
        if (str_contains($host, 'loom.com')) {
            $loomId = null;
            if (preg_match('/\/share\/([a-zA-Z0-9]+)/i', $url, $matches)) {
                $loomId = $matches[1];
            } elseif (preg_match('/\/embed\/([a-zA-Z0-9]+)/i', $url, $matches)) {
                $loomId = $matches[1];
            }

            if ($loomId) {
                return [
                    'provider' => 'loom',
                    'provider_name' => 'Loom',
                    'video_id' => $loomId,
                    'embed_url' => "https://www.loom.com/embed/{$loomId}",
                    'backup_url' => $url,
                    'icon' => 'fas fa-video text-purple-600',
                ];
            }
        }

        return null;
    }

    /**
     * Parse project URL into platform meta
     */
    public function getProjectPlatformData(?string $url): ?array
    {
        if (!$url || !$this->isValidHttpsUrl($url)) {
            return null;
        }

        $host = $this->extractHost($url);
        if (!$host) {
            return null;
        }

        if (str_contains($host, 'canva.com')) {
            return [
                'platform' => 'canva',
                'name' => 'Canva Project',
                'icon' => 'fas fa-palette text-cyan-500',
                'color' => '#00c4cc',
                'url' => $url,
            ];
        }

        if (str_contains($host, 'figma.com')) {
            return [
                'platform' => 'figma',
                'name' => 'Figma Design',
                'icon' => 'fab fa-figma text-purple-500',
                'color' => '#f24e1e',
                'url' => $url,
            ];
        }

        if (str_contains($host, 'github.com')) {
            return [
                'platform' => 'github',
                'name' => 'GitHub Repository',
                'icon' => 'fab fa-github text-slate-800 dark:text-white',
                'color' => '#24292e',
                'url' => $url,
            ];
        }

        if (str_contains($host, 'drive.google.com') || str_contains($host, 'docs.google.com')) {
            return [
                'platform' => 'google_workspace',
                'name' => 'Google Workspace / Drive',
                'icon' => 'fab fa-google-drive text-emerald-600',
                'color' => '#0f9d58',
                'url' => $url,
            ];
        }

        return [
            'platform' => 'generic',
            'name' => 'Tautan Eksternal',
            'icon' => 'fas fa-external-link-alt text-slate-500',
            'color' => '#64748b',
            'url' => $url,
        ];
    }
}
