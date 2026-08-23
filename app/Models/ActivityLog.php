<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;

class ActivityLog extends Model
{
    protected $table = 'activity_logs';

    protected $fillable = [
        'user_id',
        'action',
        'description',
        'ip_address',
        'user_agent',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public static function log(string $action, string $description): void
    {
        try {
            self::create([
                'user_id' => Auth::id(),
                'action' => strtoupper($action),
                'description' => $description,
                'ip_address' => Request::ip(),
                'user_agent' => Request::userAgent(),
            ]);
        } catch (\Exception $e) {
            // Log to Laravel system log to prevent breaking application flow
            logger()->error("Failed to write activity log: " . $e->getMessage());
        }
    }

    public static function logEmergency(string $action, string $description, array $metadata = []): void
    {
        try {
            $formattedDesc = $description;
            if (!empty($metadata)) {
                $metaStrings = [];
                foreach ($metadata as $key => $val) {
                    if ($val !== null && $val !== '') {
                        $metaStrings[] = ucfirst(str_replace('_', ' ', $key)) . ": " . $val;
                    }
                }
                if (!empty($metaStrings)) {
                    $formattedDesc .= ' [' . implode(' | ', $metaStrings) . ']';
                }
            }

            self::create([
                'user_id' => Auth::id() ?? ($metadata['user_id'] ?? null),
                'action' => strtoupper($action),
                'description' => $formattedDesc,
                'ip_address' => Request::ip() ?? '127.0.0.1',
                'user_agent' => Request::userAgent() ?? 'System / Background CLI',
            ]);
        } catch (\Exception $e) {
            logger()->error("Failed to write emergency activity log: " . $e->getMessage());
        }
    }
}
