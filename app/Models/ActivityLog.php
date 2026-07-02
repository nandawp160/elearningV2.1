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
}
