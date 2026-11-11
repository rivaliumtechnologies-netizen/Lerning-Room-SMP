<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table            = 'users';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['nama', 'email', 'password', 'role', 'nis', 'kelas', 'mapel', 'kelas_diajar', 'created_at', 'updated_at'];

    protected $validationRules = [
        'nama'     => 'required|string|max_length[100]',
        'email'    => 'required|valid_email|is_unique[users.email]',
        'password' => 'required|min_length[4]',
        'role'     => 'required|in_list[admin,guru,siswa]',
    ];

    protected $validationMessages = [];
    protected $skipValidation     = false;

    public function findByEmail(string $email)
    {
        return $this->where('email', $email)->first();
    }

    public function getGuru()
    {
        return $this->where('role', 'guru')->orderBy('nama', 'ASC')->findAll();
    }

    public function getSiswa()
    {
        return $this->where('role', 'siswa')->orderBy('nama', 'ASC')->findAll();
    }
}
