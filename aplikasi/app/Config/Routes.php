<?php

use CodeIgniter\Router\RouteCollection;

/** @var RouteCollection $routes */

// --------------------------------------------------------------------------
// Public Routes
// --------------------------------------------------------------------------
$routes->get('/', 'Home::index');
$routes->get('login', 'Auth::login');
$routes->post('login', 'Auth::doLogin');
$routes->get('logout', 'Auth::logout');

// --------------------------------------------------------------------------
// Admin Routes (protected: login + role admin)
// --------------------------------------------------------------------------
$routes->group('admin', ['filter' => 'auth:admin'], static function ($routes) {
    $routes->get('dashboard', 'Admin::dashboard');
    $routes->get('users', 'Admin::users');
    $routes->get('guru', 'Admin::guru');
    $routes->get('siswa', 'Admin::siswa');
    $routes->post('users/save', 'Admin::saveUser');
    $routes->post('users/change-password', 'Admin::changePassword');
    $routes->post('users/delete', 'Admin::deleteUser');
    $routes->get('jadwal', 'Admin::jadwal');
    $routes->post('jadwal/save', 'Admin::saveJadwal');
    $routes->get('jadwal/delete/(:num)', 'Admin::deleteJadwal/$1');
    $routes->get('export/users', 'Admin::exportUsers');
    $routes->get('export/guru', 'Admin::exportGuru');
    $routes->get('export/siswa', 'Admin::exportSiswa');
    $routes->get('export/tugas', 'Admin::exportTugas');
    $routes->post('users/import', 'Admin::importSiswa');
    $routes->get('users/template', 'Admin::downloadTemplate');
    $routes->post('siswa/import', 'Admin::importSiswa');
    $routes->get('siswa/template', 'Admin::downloadTemplate');
    $routes->post('siswa/save', 'Admin::saveUser');
    $routes->post('guru/save', 'Admin::saveUser');
});

// --------------------------------------------------------------------------
// Guru Routes (protected: login + role guru)
// --------------------------------------------------------------------------
$routes->group('guru', ['filter' => 'auth:guru'], static function ($routes) {
    $routes->get('dashboard', 'Guru::dashboard');
    $routes->get('profil', 'Guru::profil');
    $routes->post('profil/update', 'Guru::updateProfil');
    $routes->get('materi', 'Guru::materi');
    $routes->post('materi/save', 'Guru::saveMateri');
    $routes->get('materi/delete/(:num)', 'Guru::deleteMateri/$1');
    $routes->get('tugas', 'Guru::tugas');
    $routes->post('tugas/save', 'Guru::saveTugas');
    $routes->get('tugas/delete/(:num)', 'Guru::deleteTugas/$1');
    $routes->get('nilai', 'Guru::nilai');
    $routes->get('nilai/export', 'Guru::exportNilai');
    $routes->get('nilai/cetak', 'Guru::cetakNilai');
    $routes->post('nilai/save', 'Guru::saveNilai');
    $routes->get('nilai/download/(:segment)', 'Guru::downloadSubmission/$1');
    $routes->get('nilai/view/(:segment)', 'Guru::viewSubmission/$1');
    $routes->get('kelas-siswa', 'Guru::kelasSiswa');
    $routes->get('jadwal', 'Guru::jadwal');
    $routes->post('jadwal/save', 'Guru::saveJadwal');
    $routes->get('jadwal/delete/(:num)', 'Guru::deleteJadwal/$1');
    $routes->get('monitoring-ai', 'Guru::monitoringAi');
});

// --------------------------------------------------------------------------
// Siswa Routes (protected: login + role siswa)
// --------------------------------------------------------------------------
$routes->group('siswa', ['filter' => 'auth:siswa'], static function ($routes) {
    $routes->get('dashboard', 'Siswa::dashboard');
    $routes->get('profil', 'Siswa::profil');
    $routes->post('profil/update', 'Siswa::updateProfil');
    $routes->get('materi', 'Siswa::materi');
    $routes->get('tugas', 'Siswa::tugas');
    $routes->post('tugas/submit', 'Siswa::submitTugas');
    $routes->get('jadwal', 'Siswa::jadwal');
});

// --------------------------------------------------------------------------
// Gemini Routes (protected: login)
// --------------------------------------------------------------------------
$routes->group('gemini', ['filter' => 'auth'], static function ($routes) {
    $routes->get('/', 'Gemini::index');
    $routes->post('ask', 'Gemini::ask');
});

