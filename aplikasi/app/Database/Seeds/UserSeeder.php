<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run()
    {
        $users = [
            [
                'nama'     => 'Administrator',
                'email'    => 'admin@roomlearning.sch.id',
                'password' => password_hash('admin123', PASSWORD_DEFAULT),
                'role'     => 'admin',
                'nis'      => null,
                'kelas'    => null,
            ],
            [
                'nama'     => 'Bu Sari',
                'email'    => 'guru@roomlearning.sch.id',
                'password' => password_hash('guru123', PASSWORD_DEFAULT),
                'role'     => 'guru',
                'nis'      => null,
                'kelas'    => null,
            ],
            [
                'nama'     => 'Dzakwan',
                'email'    => 'siswa@roomlearning.sch.id',
                'password' => password_hash('siswa123', PASSWORD_DEFAULT),
                'role'     => 'siswa',
                'nis'      => '2024001',
                'kelas'    => 'VIII',
            ],
        ];

        $this->db->table('users')->insertBatch($users);
    }
}

