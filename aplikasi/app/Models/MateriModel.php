<?php

namespace App\Models;

use CodeIgniter\Model;

class MateriModel extends Model
{
    protected $table            = 'materi';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $allowedFields    = ['guru_id', 'judul', 'deskripsi', 'file', 'kelas', 'created_at', 'updated_at'];

    public function getByGuru(int $guruId)
    {
        return $this->where('guru_id', $guruId)->orderBy('created_at', 'DESC')->findAll();
    }

    public function getAllWithGuru()
    {
        return $this->select('materi.*, users.nama as guru_nama, users.mapel as mapel')
            ->join('users', 'users.id = materi.guru_id')
            ->orderBy('materi.created_at', 'DESC')
            ->findAll();
    }

    public function getByKelas(?string $kelas)
    {
        $builder = $this->select('materi.*, users.nama as guru_nama, users.mapel as mapel')
            ->join('users', 'users.id = materi.guru_id');

        if (!empty($kelas)) {
            $builder->groupStart()
                ->where('materi.kelas', $kelas)
                ->orWhere('materi.kelas', 'Semua')
                ->orWhere('materi.kelas', '')
                ->orWhere('materi.kelas IS NULL', null, false)
            ->groupEnd();
        }

        return $builder->orderBy('materi.created_at', 'DESC')->findAll();
    }
}

