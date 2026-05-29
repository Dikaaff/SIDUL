<?php

namespace App\Services;

class ServiceResult
{
    # fungsi constructor untuk inisialisasi hasil operasi
    public function __construct(
        public bool $success,
        public string $message = '',
        public mixed $data = null
    ) {}

    # fungsi untuk membuat instance result sukses
    public static function ok(string $message = '', mixed $data = null): static
    {
        return new static(true, $message, $data);
    }

    # fungsi untuk membuat instance result gagal
    public static function error(string $message = '', mixed $data = null): static
    {
        return new static(false, $message, $data);
    }
}
