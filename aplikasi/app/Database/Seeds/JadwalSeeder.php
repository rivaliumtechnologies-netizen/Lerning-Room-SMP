<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class JadwalSeeder extends Seeder
{
    public function run()
    {
        $existing = $this->db->table('jadwal')->countAllResults();
        if ($existing > 0) {
            echo "Jadwal table already has data.\n";
            return;
        }

        $guru = $this->db->table('users')->where('role', 'guru')->get()->getRowArray();
        $guruId = $guru ? $guru['id'] : 2;
        $mapel = !empty($guru['mapel']) ? $guru['mapel'] : 'IPA';

        $jadwals = [
            [
                'guru_id'     => $guruId,
                'mapel'       => $mapel,
                'kelas'       => 'VIII',
                'hari'        => 'Senin',
                'jam_mulai'   => '07:30:00',
                'jam_selesai' => '09:00:00',
                'ruangan'     => 'Lab IPA 1',
                'keterangan'  => 'Materi Struktur & Fungsi Sel Tumbuhan',
                'created_at'  => date('Y-m-d H:i:s'),
                'updated_at'  => date('Y-m-d H:i:s'),
            ],
            [
                'guru_id'     => $guruId,
                'mapel'       => $mapel,
                'kelas'       => 'VII A',
                'hari'        => 'Selasa',
                'jam_mulai'   => '09:30:00',
                'jam_selesai' => '11:00:00',
                'ruangan'     => 'Ruang Kelas VII-A',
                'keterangan'  => 'Pengukuran dan Besaran Pokok',
                'created_at'  => date('Y-m-d H:i:s'),
                'updated_at'  => date('Y-m-d H:i:s'),
            ],
            [
                'guru_id'     => $guruId,
                'mapel'       => $mapel,
                'kelas'       => 'VIII',
                'hari'        => 'Kamis',
                'jam_mulai'   => '08:00:00',
                'jam_selesai' => '09:30:00',
                'ruangan'     => 'Ruang Kelas VIII',
                'keterangan'  => 'Praktikum & Diskusi Kelompok',
                'created_at'  => date('Y-m-d H:i:s'),
                'updated_at'  => date('Y-m-d H:i:s'),
            ],
        ];

        $this->db->table('jadwal')->insertBatch($jadwals);
        echo "Jadwal seeder executed successfully.\n";
    }
}
