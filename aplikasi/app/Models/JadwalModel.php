<?php

namespace App\Models;

use CodeIgniter\Model;

class JadwalModel extends Model
{
    protected $table            = 'jadwal';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $allowedFields    = [
        'guru_id',
        'mapel',
        'kelas',
        'hari',
        'jam_mulai',
        'jam_selesai',
        'ruangan',
        'keterangan',
        'created_at',
        'updated_at'
    ];

    public function getByGuru(int $guruId)
    {
        return $this->select('jadwal.*, users.nama as guru_nama')
            ->join('users', 'users.id = jadwal.guru_id')
            ->where('jadwal.guru_id', $guruId)
            ->orderBy("FIELD(jadwal.hari, 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu')", '', false)
            ->orderBy('jadwal.jam_mulai', 'ASC')
            ->findAll();
    }

    public function getByKelas(?string $kelas)
    {
        $builder = $this->select('jadwal.*, users.nama as guru_nama')
            ->join('users', 'users.id = jadwal.guru_id');

        if (!empty($kelas)) {
            $builder->where('jadwal.kelas', $kelas);
        }

        return $builder
            ->orderBy("FIELD(jadwal.hari, 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu')", '', false)
            ->orderBy('jadwal.jam_mulai', 'ASC')
            ->findAll();
    }

    public function getAllWithGuru()
    {
        return $this->select('jadwal.*, users.nama as guru_nama')
            ->join('users', 'users.id = jadwal.guru_id')
            ->orderBy("FIELD(jadwal.hari, 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu')", '', false)
            ->orderBy('jadwal.jam_mulai', 'ASC')
            ->findAll();
    }
}
