<?php

namespace App\Models;

use CodeIgniter\Model;

class PengumpulanModel extends Model
{
    protected $table            = 'pengumpulan';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $allowedFields    = ['tugas_id', 'siswa_id', 'file', 'nilai', 'status', 'komentar', 'created_at', 'updated_at'];

    public function getByTugas(int $tugasId)
    {
        return $this->where('tugas_id', $tugasId)->findAll();
    }

    public function getBySiswa(int $siswaId)
    {
        return $this->where('siswa_id', $siswaId)->orderBy('created_at', 'DESC')->findAll();
    }

    public function findByTugasAndSiswa(int $tugasId, int $siswaId)
    {
        return $this->where('tugas_id', $tugasId)
            ->where('siswa_id', $siswaId)
            ->first();
    }

    public function getForGuru(int $guruId)
    {
        return $this->select('pengumpulan.*, tugas.judul as tugas_judul, tugas.deadline as tugas_deadline, users.nama as siswa_nama')
            ->join('tugas', 'tugas.id = pengumpulan.tugas_id')
            ->join('users', 'users.id = pengumpulan.siswa_id')
            ->where('tugas.guru_id', $guruId)
            ->orderBy('pengumpulan.created_at', 'DESC')
            ->findAll();
    }
}

