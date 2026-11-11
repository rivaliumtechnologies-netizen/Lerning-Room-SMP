<?php

namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

class AuthFilter implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        // Jika belum login, arahkan ke halaman login.
        if (! session()->get('is_logged_in')) {
            return redirect()->to('/login');
        }

        // Jika ada argumen role (misal auth:admin), pastikan role sesuai.
        $role = session()->get('user_role');
        if (! empty($arguments) && $role !== $arguments[0]) {
            $dashboard = match ($role) {
                'admin' => '/admin/dashboard',
                'guru'  => '/guru/dashboard',
                'siswa' => '/siswa/dashboard',
                default => '/login',
            };
            return redirect()->to($dashboard)->with('error', 'Akses ditolak: Anda tidak memiliki izin untuk membuka halaman tersebut.');
        }

        return null;
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        return $response;
    }
}

