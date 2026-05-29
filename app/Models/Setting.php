<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    protected $fillable = ['key', 'value'];

    # fungsi untuk mengecek apakah tabel settings tersedia
    public static function isReady()
    {
        try {
            return \Illuminate\Support\Facades\Schema::hasTable('settings');
        } catch (\Exception $e) {
            return false;
        }
    }

    # fungsi untuk mengambil nilai setting berdasarkan key
    public static function get($key, $default = null)
    {
        try {
            if (!self::isReady()) {
                return $default;
            }
            $setting = self::where('key', $key)->first();
            return $setting ? $setting->value : $default;
        } catch (\Exception $e) {
            return $default;
        }
    }

    # fungsi untuk menyimpan nilai setting
    public static function set($key, $value)
    {
        try {
            if (!\Illuminate\Support\Facades\Schema::hasTable('settings')) {
                return null;
            }
            return self::updateOrCreate(['key' => $key], ['value' => $value]);
        } catch (\Exception $e) {
            return null;
        }
    }
}
