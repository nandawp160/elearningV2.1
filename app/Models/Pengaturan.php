<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pengaturan extends Model
{
    protected $table = 'settings';

    protected $fillable = ['key', 'value'];

    protected static $cache = [];

    public static function getValue($key, $default = null)
    {
        // If requesting the active academic year, check if a Super Admin is overriding it via session
        if ($key === 'tahun_ajaran_aktif' && auth()->check() && auth()->user()->isSuperAdmin() && session()->has('admin_tahun_ajaran')) {
            return session('admin_tahun_ajaran');
        }

        if (array_key_exists($key, self::$cache)) {
            return self::$cache[$key] ?? $default;
        }

        $setting = self::where('key', $key)->first();
        $val = $setting ? $setting->value : $default;
        self::$cache[$key] = $val;
        return $val;
    }

    public static function getGlobalValue($key, $default = null)
    {
        $setting = self::where('key', $key)->first();
        return $setting ? $setting->value : $default;
    }

    public static function setValue($key, $value)
    {
        self::$cache[$key] = $value;
        return self::updateOrCreate(['key' => $key], ['value' => $value]);
    }

    public static function clearCache()
    {
        self::$cache = [];
    }
}
