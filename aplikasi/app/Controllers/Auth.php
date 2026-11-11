<?php

namespace App\Controllers;

use App\Models\UserModel;
use CodeIgniter\HTTP\RedirectResponse;

class Auth extends BaseController
{
    public function login()
    {
        // Jika sudah login, langsung arahkan ke dashboard masing-masing.
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

        return view('auth/login');
    }

    public function doLogin()
    {
        $email = $this->request->getPost('email');
        $password = $this->request->getPost('password');
        $role = $this->request->getPost('role');

        $validation = \service('validation');
        $validation->setRules([
            'email'    => 'required|valid_email',
            'password' => 'required',
            'role'     => 'permit_empty|in_list[admin,guru,siswa]',
        ]);

        if (! $validation->withRequest($this->request)->run()) {
            return redirect()->back()->withInput()->with('errors', $validation->getErrors());
        }

        $userModel = new UserModel();
        $user = $userModel->where('email', $email)->first();

        if (! $user || ! password_verify($password, $user['password'])) {
            return redirect()->back()->withInput()->with('error', 'Email atau password salah.');
        }

        // Validasi bahwa role akun harus sesuai dengan tab role yang dipilih saat login
        if (! empty($role) && $user['role'] !== $role) {
            $roleLabel = match ($user['role']) {
                'siswa' => 'Siswa',
                'guru'  => 'Guru',
                'admin' => 'Admin',
                default => ucfirst($user['role']),
            };
            $targetLabel = match ($role) {
                'siswa' => 'Siswa',
                'guru'  => 'Guru',
                'admin' => 'Admin',
                default => ucfirst($role),
            };

            return redirect()->back()->withInput()->with('error', "Gagal masuk: Akun ini terdaftar sebagai {$roleLabel}, bukan {$targetLabel}. Silakan pilih tab {$roleLabel} untuk login.");
        }

        $userRole = $user['role'];
        $session = session();
        $session->regenerate(true);
        $session->set([
            'user_id'      => $user['id'],
            'user_name'    => $user['nama'],
            'user_email'   => $user['email'],
            'user_role'    => $userRole,
            'is_logged_in' => true,
        ]);

        if ($userRole === 'admin') {
            return redirect()->to('/admin/dashboard');
        }
        if ($userRole === 'guru') {
            return redirect()->to('/guru/dashboard');
        }

        return redirect()->to('/siswa/dashboard');
    }

    public function logout(): RedirectResponse
    {
        $session = session();
        $session->remove(['user_id', 'user_name', 'user_email', 'user_role', 'is_logged_in']);
        $session->destroy();
        return redirect()->to('/login');
    }
}
