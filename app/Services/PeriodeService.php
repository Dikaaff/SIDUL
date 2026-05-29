<?php

namespace App\Services;

use App\Models\Setting;

class PeriodeService
{
    # fungsi untuk mengecek apakah periode pendaftaran dibuka
    public static function isOpen(): bool
    {
        return Setting::get('is_periode_open', '1') == '1';
    }

    # fungsi untuk mengecek apakah periode pendaftaran ditutup
    public static function isClosed(): bool
    {
        return !static::isOpen();
    }

    # fungsi untuk mengubah status periode pendaftaran
    public static function toggle(): string
    {
        $current = Setting::get('is_periode_open', '1');
        $new = ($current == '1' || $current === 1) ? '0' : '1';
        Setting::set('is_periode_open', $new);
        return $new;
    }
}
