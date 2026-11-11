<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index()
    {
        // Jika sudah login, arahkan ke dashboard sesuai role.
        if (session()->get('is_logged_in')) {
            $role = session()->get('user_role');

            if ($role === 'admin') {
                return redirect()->to('/admin/dashboard');
            }
            if ($role === 'guru') {
                return redirect()->to('/guru/dashboard');
            }

            return redirect()->to('/siswa/dashboard');
        }

        return redirect()->to('/login');
    }
}

