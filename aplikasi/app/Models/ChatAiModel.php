<?php

namespace App\Models;

use CodeIgniter\Model;

class ChatAiModel extends Model
{
    protected $table            = 'chat_ai';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $allowedFields    = ['user_id', 'mapel', 'prompt', 'response', 'created_at'];

    public function getMonitoringByGuru(string $mapel, array $kelasList = [], ?string $filterKelas = null, ?string $search = null, ?int $studentId = null, bool $isExplicitAllKelas = false)
    {
        $builder = $this->select('chat_ai.*, users.nama as siswa_nama, users.nis, users.kelas')
            ->join('users', 'users.id = chat_ai.user_id')
            ->where('users.role', 'siswa');

        if (!empty($studentId)) {
            $builder->where('chat_ai.user_id', $studentId);
        }

        if (!empty($mapel)) {
            $builder->groupStart()
                ->where('chat_ai.mapel', $mapel)
                ->orLike('chat_ai.prompt', $mapel)
                ->orWhere('chat_ai.mapel IS NULL', null, false)
                ->orWhere('chat_ai.mapel', '')
            ->groupEnd();
        }

        if (!empty($filterKelas)) {
            $builder->where('users.kelas', $filterKelas);
        } elseif (!$isExplicitAllKelas && !empty($kelasList) && empty($studentId)) {
            $builder->whereIn('users.kelas', $kelasList);
        }

        if (!empty($search)) {
            $builder->groupStart()
                ->like('chat_ai.prompt', $search)
                ->orLike('users.nama', $search)
                ->orLike('chat_ai.response', $search)
            ->groupEnd();
        }

        return $builder->orderBy('chat_ai.created_at', 'DESC')->findAll();
    }
}
