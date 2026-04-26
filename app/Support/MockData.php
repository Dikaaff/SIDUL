<?php

namespace App\Support;

use Illuminate\Support\Facades\Session;
use Illuminate\Support\Collection;

class MockData
{
    /**
     * Get the default mock users.
     */
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

    /**
     * Get a user from the mock data by email.
     */
    public static function findUserByEmail(string $email): ?array
    {
        return collect(self::getTestUsers())->firstWhere('email', $email);
    }

    /**
     * Get pendaftaran data (from session if exists).
     */
    public static function getPendaftaran(): ?array
    {
        return Session::get('mock_pendaftaran', null);
    }

    /**
     * Store pendaftaran data in session.
     */
    public static function storePendaftaran(array $data): void
    {
        $data['status'] = 'Menunggu ACC';
        Session::put('mock_pendaftaran', $data);
    }

    /**
     * Get logbooks (from session).
     */
    public static function getLogbooks(): Collection
    {
        return collect(Session::get('mock_logbooks', []));
    }

    /**
     * Add logbook entry.
     */
    public static function addLogbook(array $data): void
    {
        $logbooks = self::getLogbooks();
        $data['id'] = $logbooks->count() + 1;
        $data['created_at'] = now();
        $logbooks->push($data);
        Session::put('mock_logbooks', $logbooks->toArray());
    }

    /**
     * Get bimbingans (from session).
     */
    public static function getBimbingans(): Collection
    {
        return collect(Session::get('mock_bimbingans', []));
    }

    /**
     * Get laporans (from session).
     */
    public static function getLaporans(): Collection
    {
        return collect(Session::get('mock_laporans', []));
    }
}
