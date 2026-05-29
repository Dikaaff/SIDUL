<?php

namespace App\Support;

use Illuminate\Support\Facades\Session;
use Illuminate\Support\Collection;

class MockData
{
    # fungsi untuk mengambil data mock user
    public static function getTestUsers(): array
    {
        return [
            [
                'id' => 1,
                'name' => 'Mahasiswa Test',
                'email' => 'mahasiswa@sidul.com',
                'password' => 'password123',
                'role' => 'mahasiswa',
                'nim' => '20210001',
            ],
            [
                'id' => 2,
                'name' => 'Dosen Test',
                'email' => 'dosen@sidul.com',
                'password' => 'password123',
                'role' => 'dosen',
            ],
            [
                'id' => 3,
                'name' => 'Operator Test',
                'email' => 'operator@sidul.com',
                'password' => 'password123',
                'role' => 'operator',
            ],
        ];
    }

    # fungsi untuk mencari user mock berdasarkan email
    public static function findUserByEmail(string $email): ?array
    {
        return collect(self::getTestUsers())->firstWhere('email', $email);
    }

    # fungsi untuk mengambil data pendaftaran dari session
    public static function getPendaftaran(): ?array
    {
        return Session::get('mock_pendaftaran', null);
    }

    # fungsi untuk menyimpan data pendaftaran ke session
    public static function storePendaftaran(array $data): void
    {
        $data['status'] = 'Menunggu ACC';
        Session::put('mock_pendaftaran', $data);
    }

    # fungsi untuk mengambil data logbook dari session
    public static function getLogbooks(): Collection
    {
        return collect(Session::get('mock_logbooks', []));
    }

    # fungsi untuk menambah entri logbook ke session
    public static function addLogbook(array $data): void
    {
        $logbooks = self::getLogbooks();
        $data['id'] = $logbooks->count() + 1;
        $data['created_at'] = now();
        $logbooks->push($data);
        Session::put('mock_logbooks', $logbooks->toArray());
    }

    # fungsi untuk mengambil data bimbingan dari session
    public static function getBimbingans(): Collection
    {
        return collect(Session::get('mock_bimbingans', []));
    }

    # fungsi untuk mengambil data laporan dari session
    public static function getLaporans(): Collection
    {
        return collect(Session::get('mock_laporans', []));
    }
}
