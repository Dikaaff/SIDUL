<?php

namespace App\Support;

use Illuminate\Support\Facades\Session;
use Illuminate\Support\Collection;

class MockData
{
    public static function getTestUsers(): array
    {
        return [
            [
                'id' => 1,
                'username' => '20210001',
                'email' => 'mahasiswa@sidul.com',
                'password' => 'password123',
                'role' => 'mahasiswa',
                'nim' => '20210001',
            ],
            [
                'id' => 2,
                'username' => '19876003',
                'email' => 'dosen@sidul.com',
                'password' => 'password123',
                'role' => 'dosen',
            ],
            [
                'id' => 3,
                'username' => 'operator',
                'email' => 'operator@sidul.com',
                'password' => 'password123',
                'role' => 'operator',
            ],
        ];
    }

    public static function findUserByEmail(string $email): ?array
    {
        return collect(self::getTestUsers())->firstWhere('email', $email);
    }

    public static function getPendaftaran(): ?array
    {
        return Session::get('mock_pendaftaran', null);
    }

    public static function storePendaftaran(array $data): void
    {
        $data['status'] = 'Menunggu ACC';
        Session::put('mock_pendaftaran', $data);
    }

    public static function getLogbooks(): Collection
    {
        return collect(Session::get('mock_logbooks', []));
    }

    public static function addLogbook(array $data): void
    {
        $logbooks = self::getLogbooks();
        $data['id'] = $logbooks->count() + 1;
        $data['created_at'] = now();
        $logbooks->push($data);
        Session::put('mock_logbooks', $logbooks->toArray());
    }

    public static function getBimbingans(): Collection
    {
        return collect(Session::get('mock_bimbingans', []));
    }

    public static function getLaporans(): Collection
    {
        return collect(Session::get('mock_laporans', []));
    }
}
