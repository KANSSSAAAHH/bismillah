<?php

namespace Database\Seeders;

use App\Models\Pengguna;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed akun demo LOOPIN (idempotent: updateOrCreate by email).
     */
    public function run(): void
    {
        $accounts = [
            [
                'nama' => 'Admin LOOPIN',
                'email' => 'admin@loopin.test',
                'password' => Hash::make('admin12345'),
                'role' => 'admin',
                'kelas' => 'Administrator',
                'nomor_whatsapp' => '08120000001',
            ],
            [
                'nama' => 'SMP Nusantara',
                'email' => 'sekolah@loopin.test',
                'password' => Hash::make('sekolah12345'),
                'role' => 'sekolah',
                'kelas' => 'Sekolah',
                'nomor_whatsapp' => '08120000002',
            ],
            [
                'nama' => 'Budi Prasetyo',
                'email' => 'budi@loopin.test',
                'password' => Hash::make('budi12345'),
                'role' => 'pengguna',
                'kelas' => '10 RPL',
                'nomor_whatsapp' => '08120000003',
            ],
            [
                'nama' => 'Siti Rahma',
                'email' => 'siti@loopin.test',
                'password' => Hash::make('siti12345'),
                'role' => 'pengguna',
                'kelas' => '11 TKJ',
                'nomor_whatsapp' => '08120000004',
            ],
        ];

        foreach ($accounts as $account) {
            Pengguna::query()->updateOrCreate(
                ['email' => $account['email']],
                $account,
            );
        }
    }
}
