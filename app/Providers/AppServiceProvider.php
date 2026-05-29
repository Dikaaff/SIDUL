<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    # fungsi untuk mendaftarkan service ke container
    public function register(): void
    {
        //
    }

    # fungsi untuk menjalankan inisialisasi setelah semua service terdaftar
    public function boot(): void
    {
        //
    }
}
