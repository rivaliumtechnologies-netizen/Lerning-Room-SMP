<?php

namespace App\Models;

use CodeIgniter\Model;

class TugasModel extends Model
{
    protected $table            = 'tugas';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $allowedFields    = ['guru_id', 'judul', 'deskripsi', 'link_eksternal', 'deadline', 'kelas', 'created_at', 'updated_at'];

    public function getByGuru(int $guruId)
    {
        return $this->where('guru_id', $guruId)->orderBy('deadline', 'ASC')->findAll();
    }

    public function getAllWithGuru()
    {
        return $this->select('tugas.*, users.nama as guru_nama')
            ->join('users', 'users.id = tugas.guru_id')
            ->orderBy('tugas.deadline', 'ASC')
            ->findAll();
    }

    public function getByKelas(?string $kelas)
    {
        $builder = $this->select('tugas.*, users.nama as guru_nama')
            ->join('users', 'users.id = tugas.guru_id');

        if (!empty($kelas)) {
            $builder->groupStart()
                ->where('tugas.kelas', $kelas)
                ->orWhere('tugas.kelas', 'Semua')
                ->orWhere('tugas.kelas', '')
                ->orWhere('tugas.kelas IS NULL', null, false)
            ->groupEnd();
        }

        return $builder->orderBy('tugas.deadline', 'ASC')->findAll();
    }
}

