<?php

namespace App\Controllers;

use App\Models\JadwalModel;
use App\Models\MateriModel;
use App\Models\PengumpulanModel;
use App\Models\TugasModel;
use App\Models\UserModel;
use CodeIgniter\HTTP\RedirectResponse;
use CodeIgniter\HTTP\ResponseInterface;

class Admin extends BaseController
{
    public function dashboard()
    {
        $userModel        = new UserModel();
        $materiModel      = new MateriModel();
        $tugasModel       = new TugasModel();
        $pengumpulanModel = new PengumpulanModel();
        $jadwalModel      = new JadwalModel();

        $guruCount        = $userModel->where('role', 'guru')->countAllResults(false);
        $siswaCount       = $userModel->where('role', 'siswa')->countAllResults(false);
        $materiCount      = $materiModel->countAllResults(false);
        $tugasCount       = $tugasModel->countAllResults(false);
        $pengumpulanCount = $pengumpulanModel->countAllResults(false);
        $jadwalCount      = $jadwalModel->countAllResults(false);

        // Distribusi Siswa per Jenjang Kelas
        $siswaVII  = $userModel->where('role', 'siswa')->like('kelas', 'VII')->countAllResults(false);
        $siswaVIII = $userModel->where('role', 'siswa')->like('kelas', 'VIII')->countAllResults(false);
        $siswaIX   = $userModel->where('role', 'siswa')->like('kelas', 'IX')->countAllResults(false);

        // Jadwal Aktif
        $allJadwal    = $jadwalModel->getAllWithGuru();
        $recentJadwal = array_slice($allJadwal, 0, 5);

        // Pengguna Terbaru
        $recentUsers = $userModel->whereIn('role', ['guru', 'siswa'])->orderBy('id', 'DESC')->limit(5)->findAll();

        $data = [
            'guruCount'        => $guruCount,
            'siswaCount'       => $siswaCount,
            'materiCount'      => $materiCount,
            'tugasCount'       => $tugasCount,
            'pengumpulanCount' => $pengumpulanCount,
            'jadwalCount'      => $jadwalCount,
            'siswaVII'         => $siswaVII,
            'siswaVIII'        => $siswaVIII,
            'siswaIX'          => $siswaIX,
            'recentJadwal'     => $recentJadwal,
            'recentUsers'      => $recentUsers,
        ];

        return view('admin/dashboard', $data);
    }

    /**
     * Redirect users ke siswa
     */
    public function users(): RedirectResponse
    {
        return redirect()->to('admin/siswa');
    }

    /**
     * Halaman kelola data guru (pendidik).
     */
    public function guru()
    {
        $userModel = new UserModel();
        $guru = $userModel->where('role', 'guru')->orderBy('nama', 'ASC')->findAll();

        $mapelList = [];
        $kelasDiajarList = [];
        foreach ($guru as $g) {
            if (!empty($g['mapel'])) $mapelList[$g['mapel']] = true;
            if (!empty($g['kelas_diajar'])) {
                $kls = explode(',', $g['kelas_diajar']);
                foreach ($kls as $k) {
                    $k = trim($k);
                    if ($k !== '') $kelasDiajarList[$k] = true;
                }
            }
        }

        // Standar kelas SMP: 7A-G, 8A-G, 9A-G
        $uniqueClasses = [];
        $grades = ['VII', 'VIII', 'IX'];
        $letters = ['A', 'B', 'C', 'D', 'E', 'F', 'G'];
        foreach ($grades as $gr) {
            foreach ($letters as $l) {
                $uniqueClasses["{$gr}-{$l}"] = true;
            }
        }

        $allSiswa = $userModel->where('role', 'siswa')->findAll();
        foreach ($allSiswa as $s) {
            $c = trim((string)($s['kelas'] ?? ''));
            if ($c !== '' && $c !== 'Belum Diatur') {
                $uniqueClasses[$c] = true;
            }
        }
        $classList = array_keys($uniqueClasses);
        
        $orderMap = [
            'VII-A'=>1, 'VII-B'=>2, 'VII-C'=>3, 'VII-D'=>4, 'VII-E'=>5, 'VII-F'=>6, 'VII-G'=>7,
            'VIII-A'=>8, 'VIII-B'=>9, 'VIII-C'=>10, 'VIII-D'=>11, 'VIII-E'=>12, 'VIII-F'=>13, 'VIII-G'=>14,
            'IX-A'=>15, 'IX-B'=>16, 'IX-C'=>17, 'IX-D'=>18, 'IX-E'=>19, 'IX-F'=>20, 'IX-G'=>21,
        ];
        usort($classList, function($a, $b) use ($orderMap) {
            $oa = $orderMap[$a] ?? 999;
            $ob = $orderMap[$b] ?? 999;
            if ($oa === $ob) return strcmp($a, $b);
            return $oa <=> $ob;
        });

        // Kelompokkan kelas per jenjang
        $classesByGrade = ['VII' => [], 'VIII' => [], 'IX' => [], 'LAIN' => []];
        foreach ($classList as $cls) {
            if (str_starts_with($cls, 'VII-')) {
                $classesByGrade['VII'][] = $cls;
            } elseif (str_starts_with($cls, 'VIII-')) {
                $classesByGrade['VIII'][] = $cls;
            } elseif (str_starts_with($cls, 'IX-')) {
                $classesByGrade['IX'][] = $cls;
            } else {
                $classesByGrade['LAIN'][] = $cls;
            }
        }

        $data = [
            'guru'             => $guru,
            'totalMapel'       => count($mapelList),
            'totalKelasDiajar' => count($kelasDiajarList),
            'classList'        => $classList,
            'classesByGrade'   => $classesByGrade,
        ];

        return view('admin/guru', $data);
    }

    /**
     * Halaman kelola data siswa dan rombel/kelas.
     */
    public function siswa()
    {
        $userModel = new UserModel();
        $allSiswa  = $userModel->where('role', 'siswa')->orderBy('kelas', 'ASC')->orderBy('nama', 'ASC')->findAll();

        $siswaVII  = [];
        $siswaVIII = [];
        $siswaIX   = [];
        $siswaLain = [];

        foreach ($allSiswa as $s) {
            $kls = strtoupper(trim((string)($s['kelas'] ?? '')));
            // Cek VIII dulu sebelum VII karena VII adalah substring dari VIII
            if (strpos($kls, 'VIII') !== false || strpos($kls, '8') !== false) {
                $siswaVIII[] = $s;
            } elseif (strpos($kls, 'VII') !== false || strpos($kls, '7') !== false) {
                $siswaVII[] = $s;
            } elseif (strpos($kls, 'IX') !== false || strpos($kls, '9') !== false) {
                $siswaIX[] = $s;
            } else {
                $siswaLain[] = $s;
            }
        }

        // Standar kelas SMP: 7A-G, 8A-G, 9A-G
        $siswaByClass = [];
        $uniqueClasses = [];
        $grades = ['VII', 'VIII', 'IX'];
        $letters = ['A', 'B', 'C', 'D', 'E', 'F', 'G'];
        foreach ($grades as $gr) {
            foreach ($letters as $l) {
                $uniqueClasses["{$gr}-{$l}"] = true;
                $siswaByClass["{$gr}-{$l}"] = [];
            }
        }

        foreach ($allSiswa as $s) {
            $c = trim((string)($s['kelas'] ?? 'Belum Diatur'));
            if ($c === '') $c = 'Belum Diatur';
            $siswaByClass[$c][] = $s;
            if ($c !== 'Belum Diatur') {
                $uniqueClasses[$c] = true;
            }
        }
        $classList = array_keys($uniqueClasses);

        $orderMap = [
            'VII-A'=>1, 'VII-B'=>2, 'VII-C'=>3, 'VII-D'=>4, 'VII-E'=>5, 'VII-F'=>6, 'VII-G'=>7,
            'VIII-A'=>8, 'VIII-B'=>9, 'VIII-C'=>10, 'VIII-D'=>11, 'VIII-E'=>12, 'VIII-F'=>13, 'VIII-G'=>14,
            'IX-A'=>15, 'IX-B'=>16, 'IX-C'=>17, 'IX-D'=>18, 'IX-E'=>19, 'IX-F'=>20, 'IX-G'=>21,
        ];
        usort($classList, function($a, $b) use ($orderMap) {
            $oa = $orderMap[$a] ?? 999;
            $ob = $orderMap[$b] ?? 999;
            if ($oa === $ob) return strcmp($a, $b);
            return $oa <=> $ob;
        });

        // Kelompokkan kelas per jenjang
        $classesByGrade = ['VII' => [], 'VIII' => [], 'IX' => [], 'LAIN' => []];
        foreach ($classList as $cls) {
            if (str_starts_with($cls, 'VII-')) {
                $classesByGrade['VII'][] = $cls;
            } elseif (str_starts_with($cls, 'VIII-')) {
                $classesByGrade['VIII'][] = $cls;
            } elseif (str_starts_with($cls, 'IX-')) {
                $classesByGrade['IX'][] = $cls;
            } else {
                $classesByGrade['LAIN'][] = $cls;
            }
        }

        $data = [
            'siswa'          => $allSiswa,
            'siswaVII'       => $siswaVII,
            'siswaVIII'      => $siswaVIII,
            'siswaIX'        => $siswaIX,
            'siswaLain'      => $siswaLain,
            'siswaByClass'   => $siswaByClass,
            'classList'      => $classList,
            'classesByGrade' => $classesByGrade,
        ];

        return view('admin/siswa', $data);
    }

    public function saveUser(): RedirectResponse
    {
        $userModel = new UserModel();
        $userId = (int) $this->request->getPost('user_id');
        $nama = trim((string) $this->request->getPost('nama'));
        $email = trim((string) $this->request->getPost('email'));
        $password = (string) $this->request->getPost('password');
        $role = $this->request->getPost('role');
        $nis = $this->request->getPost('nis') ?: null;
        $kelas = $this->request->getPost('kelas') ?: null;
        $mapel = trim((string) $this->request->getPost('mapel')) ?: null;
        if ($mapel === '__LAINNYA__' || empty($mapel)) {
            $customMapel = trim((string) $this->request->getPost('custom_mapel'));
            if (!empty($customMapel)) {
                $mapel = $customMapel;
            } elseif ($mapel === '__LAINNYA__') {
                $mapel = null;
            }
        }

        // Proses pilihan kelas yang diajar (bisa berupa array checkbox atau string)
        $rawKelasDiajar = $this->request->getPost('kelas_diajar');
        if (is_array($rawKelasDiajar)) {
            $kelasDiajar = implode(', ', array_filter(array_map('trim', $rawKelasDiajar)));
        } else {
            $kelasDiajar = trim((string) $rawKelasDiajar);
        }
        if (empty($kelasDiajar)) {
            $kelasDiajar = null;
        }

        // Jika siswa dan email / password kosong, buat otomatis
        if ($role === 'siswa') {
            if (empty($userId) && empty($password)) {
                $password = 'siswa123';
            }
            if (empty($email)) {
                $cleanName = strtolower(preg_replace('/[^a-zA-Z0-9]/', '', $nama));
                if (empty($cleanName)) {
                    $cleanName = 'siswa' . rand(100, 999);
                }
                $finalEmail = $cleanName . '@roomlearning.sch.id';
                $counter = 1;
                while ($userModel->where('email', $finalEmail)->first()) {
                    $counter++;
                    $finalEmail = $cleanName . $counter . '@roomlearning.sch.id';
                }
                $email = $finalEmail;
            }
        }

        // Aturan validasi
        $rules = [
            'nama'  => 'required',
            'email' => 'required|valid_email',
            'role'  => 'required|in_list[guru,siswa]',
        ];

        // Jika user baru, password wajib minimal 4 karakter
        if (empty($userId)) {
            $rules['password'] = 'required|min_length[4]';
        } elseif (!empty($password)) {
            $rules['password'] = 'min_length[4]';
        }

        $validation = \service('validation');
        $validation->setRules($rules);

        $validData = [
            'nama'  => $nama,
            'email' => $email,
            'role'  => $role,
        ];
        if (!empty($password)) {
            $validData['password'] = $password;
        }

        if (! $validation->run($validData)) {
            return redirect()->back()->withInput()->with('errors', $validation->getErrors());
        }

        // Cek email duplikat
        if ($userId) {
            $exists = $userModel->where('email', $email)->where('id !=', $userId)->first();
        } else {
            $exists = $userModel->where('email', $email)->first();
        }

        if ($exists) {
            return redirect()->back()->withInput()->with('error', 'Email sudah terdaftar untuk akun lain.');
        }

        $dataToSave = [
            'nama'         => $nama,
            'email'        => $email,
            'role'         => $role,
            'nis'          => $nis,
            'kelas'        => $kelas,
            'mapel'        => $mapel,
            'kelas_diajar' => $kelasDiajar,
        ];

        if (!empty($password)) {
            $dataToSave['password'] = password_hash($password, PASSWORD_DEFAULT);
        }

        if ($userId) {
            $userModel->update($userId, $dataToSave);
            $msg = "Data {$role} '{$nama}' berhasil diperbarui.";
        } else {
            $userModel->insert($dataToSave);
            $msg = "Akun {$role} '{$nama}' berhasil dibuat dengan email {$email}.";
        }

        $redirectUrl = ($role === 'guru') ? 'admin/guru' : 'admin/siswa';
        return redirect()->to($redirectUrl)->with('success', $msg);
    }

    public function changePassword(): RedirectResponse
    {
        $userId = (int) $this->request->getPost('user_id');
        $newPassword = $this->request->getPost('new_password');

        if (! $userId || ! $newPassword) {
            return redirect()->back()->with('error', 'User ID dan password baru wajib diisi.');
        }

        $userModel = new UserModel();
        $user = $userModel->find($userId);

        if (! $user) {
            return redirect()->back()->with('error', 'Akun tidak ditemukan.');
        }

        $userModel->update($userId, [
            'password' => password_hash($newPassword, PASSWORD_DEFAULT),
        ]);

        return redirect()->back()->with('success', 'Password berhasil diubah.');
    }

    public function deleteUser(): RedirectResponse
    {
        $userId = (int) $this->request->getPost('user_id');

        if (! $userId || $userId === (int) session()->get('user_id')) {
            return redirect()->back()->with('error', 'Tidak dapat menghapus akun ini.');
        }

        $userModel = new UserModel();
        $userModel->delete($userId);

        return redirect()->back()->with('success', 'Akun berhasil dihapus.');
    }

    public function exportUsers()
    {
        $userModel = new UserModel();
        $users = $userModel->orderBy('role', 'ASC')->orderBy('nama', 'ASC')->findAll();

        $filename = 'laporan_users_' . date('Ymd_His') . '.csv';

        $response = $this->response;
        $response->setHeader('Content-Type', 'text/csv; charset=UTF-8');
        $response->setHeader('Content-Disposition', 'attachment; filename="' . $filename . '"');

        $handle = fopen('php://output', 'w');
        // BOM UTF-8 agar excel membaca aksen dengan benar.
        fwrite($handle, "\xEF\xBB\xBF");
        fputcsv($handle, ['Role', 'Nama', 'Email', 'NIS/NIP', 'Kelas', 'Password']);

        foreach ($users as $user) {
            fputcsv($handle, [
                $user['role'],
                $user['nama'],
                $user['email'],
                $user['nis'] ?: '-',
                $user['kelas'] ?: '-',
                '(di-hash)',
            ]);
        }

        fclose($handle);
        return $response;
    }

    public function exportGuru()
    {
        $userModel = new UserModel();
        $gurus = $userModel->where('role', 'guru')->orderBy('nama', 'ASC')->findAll();
        $filename = 'laporan_guru_' . date('Ymd_His') . '.csv';

        $response = $this->response;
        $response->setHeader('Content-Type', 'text/csv; charset=UTF-8');
        $response->setHeader('Content-Disposition', 'attachment; filename="' . $filename . '"');

        $handle = fopen('php://output', 'w');
        fwrite($handle, "\xEF\xBB\xBF");
        fputcsv($handle, ['Nama Guru', 'Email', 'NIP/ID', 'Mata Pelajaran', 'Kelas yang Diajar']);

        foreach ($gurus as $g) {
            fputcsv($handle, [
                $g['nama'],
                $g['email'],
                $g['nis'] ?: '-',
                $g['mapel'] ?: '-',
                $g['kelas_diajar'] ?: '-',
            ]);
        }

        fclose($handle);
        return $response;
    }

    public function exportSiswa()
    {
        $userModel = new UserModel();
        $siswas = $userModel->where('role', 'siswa')->orderBy('kelas', 'ASC')->orderBy('nama', 'ASC')->findAll();
        $filename = 'laporan_siswa_' . date('Ymd_His') . '.csv';

        $response = $this->response;
        $response->setHeader('Content-Type', 'text/csv; charset=UTF-8');
        $response->setHeader('Content-Disposition', 'attachment; filename="' . $filename . '"');

        $handle = fopen('php://output', 'w');
        fwrite($handle, "\xEF\xBB\xBF");
        fputcsv($handle, ['Nama Siswa', 'Kelas', 'NIS', 'Email']);

        foreach ($siswas as $s) {
            fputcsv($handle, [
                $s['nama'],
                $s['kelas'] ?: '-',
                $s['nis'] ?: '-',
                $s['email'],
            ]);
        }

        fclose($handle);
        return $response;
    }

    public function exportTugas()
    {
        $tugasModel = new TugasModel();
        $userModel = new UserModel();
        $pengumpulanModel = new PengumpulanModel();

        $tugas = $tugasModel->findAll();
        $filename = 'laporan_tugas_' . date('Ymd_His') . '.csv';

        $response = $this->response;
        $response->setHeader('Content-Type', 'text/csv; charset=UTF-8');
        $response->setHeader('Content-Disposition', 'attachment; filename="' . $filename . '"');

        $handle = fopen('php://output', 'w');
        fwrite($handle, "\xEF\xBB\xBF");
        fputcsv($handle, ['Judul', 'Deskripsi', 'Deadline', 'Guru', 'Jumlah Dikumpulkan']);

        foreach ($tugas as $t) {
            $guru = $userModel->find($t['guru_id']);
            $count = $pengumpulanModel->where('tugas_id', $t['id'])->countAllResults(false);

            fputcsv($handle, [
                $t['judul'],
                $t['deskripsi'] ?: '-',
                $t['deadline'] ?: '-',
                $guru['nama'] ?? '-',
                $count,
            ]);
        }

        fclose($handle);
        return $response;
    }

    /**
     * Halaman kelola jadwal pelajaran seluruh guru & kelas.
     */
    public function jadwal()
    {
        $jadwalModel = new JadwalModel();
        $userModel   = new UserModel();

        $data = [
            'jadwal' => $jadwalModel->getAllWithGuru(),
            'guru'   => $userModel->where('role', 'guru')->orderBy('nama', 'ASC')->findAll(),
        ];

        return view('admin/jadwal', $data);
    }

    public function saveJadwal(): RedirectResponse
    {
        $guruId     = $this->request->getPost('guru_id');
        $mapel      = $this->request->getPost('mapel');
        $kelas      = $this->request->getPost('kelas');
        $hari       = $this->request->getPost('hari');
        $jamMulai   = $this->request->getPost('jam_mulai');
        $jamSelesai = $this->request->getPost('jam_selesai');
        $ruangan    = $this->request->getPost('ruangan');
        $keterangan = $this->request->getPost('keterangan');

        if (! $guruId || ! $mapel || ! $kelas || ! $hari || ! $jamMulai || ! $jamSelesai) {
            return redirect()->back()->with('error', 'Semua kolom bertanda bintang (*) wajib diisi.');
        }

        $jadwalModel = new JadwalModel();
        $jadwalModel->insert([
            'guru_id'     => (int) $guruId,
            'mapel'       => $mapel,
            'kelas'       => $kelas,
            'hari'        => $hari,
            'jam_mulai'   => $jamMulai,
            'jam_selesai' => $jamSelesai,
            'ruangan'     => $ruangan,
            'keterangan'  => $keterangan,
            'created_at'  => date('Y-m-d H:i:s'),
            'updated_at'  => date('Y-m-d H:i:s'),
        ]);

        return redirect()->to('admin/jadwal')->with('success', 'Jadwal pelajaran berhasil ditambahkan.');
    }

    public function deleteJadwal($id): RedirectResponse
    {
        $jadwalModel = new JadwalModel();
        $jadwalModel->delete($id);

        return redirect()->to('admin/jadwal')->with('success', 'Jadwal pelajaran berhasil dihapus.');
    }

    /**
     * Download template CSV/Excel untuk import siswa
     */
    public function downloadTemplate(): ResponseInterface
    {
        $csvContent = "Nama,Kelas\n";
        $csvContent .= "Ahmad Rizky Pratama,VII-A\n";
        $csvContent .= "Siti Aisyah Putri,VII-C\n";
        $csvContent .= "Budi Santoso,VIII-B\n";
        $csvContent .= "Dewi Lestari,VIII-E\n";
        $csvContent .= "Fajar Ramadhan,IX-A\n";
        $csvContent .= "Gita Gutawa,IX-G\n";

        return $this->response
            ->setHeader('Content-Type', 'text/csv; charset=UTF-8')
            ->setHeader('Content-Disposition', 'attachment; filename="template_import_siswa.csv"')
            ->setBody($csvContent);
    }

    /**
     * Import batch siswa dari file CSV/Excel atau teks baris
     * Otomatis membuatkan email nama@roomlearning.sch.id & password default
     */
    public function importSiswa(): RedirectResponse
    {
        $userModel = new UserModel();
        $file = $this->request->getFile('file_siswa');
        $rawText = trim((string) $this->request->getPost('raw_text'));
        $defaultPassword = $this->request->getPost('default_password') ?: 'siswa123';
        $pilihKelas = trim((string) $this->request->getPost('default_kelas'));

        $rows = [];

        // 1. Jika pengguna upload file CSV/TXT
        if ($file && $file->isValid() && !$file->hasMoved()) {
            $handle = fopen($file->getTempName(), 'r');
            if ($handle !== false) {
                $isHeader = true;
                while (($data = fgetcsv($handle, 1000, ',')) !== false) {
                    if (empty($data) || (count($data) === 1 && empty($data[0]))) continue;

                    // Lewati header jika baris pertama tertulis Nama / Kelas
                    if ($isHeader) {
                        $isHeader = false;
                        if (stripos($data[0], 'nama') !== false || (isset($data[1]) && stripos($data[1], 'kelas') !== false)) {
                            continue;
                        }
                    }

                    $nama = trim($data[0] ?? '');
                    $kelas = trim($data[1] ?? '') ?: $pilihKelas;

                    if (!empty($nama)) {
                        $rows[] = ['nama' => $nama, 'kelas' => $kelas ?: 'VII-A'];
                    }
                }
                fclose($handle);
            }
        }

        // 2. Jika pengguna juga/atau mengisi via teks baris (contoh: Ahmad Rizky, VII-A)
        if (!empty($rawText)) {
            $lines = explode("\n", str_replace("\r", "", $rawText));
            foreach ($lines as $line) {
                $line = trim($line);
                if (empty($line)) continue;

                // Pisahkan dengan koma atau tab atau titik koma
                $parts = preg_split('/[,;\t]/', $line);
                $nama = trim($parts[0] ?? '');
                $kelas = trim($parts[1] ?? '') ?: $pilihKelas;

                if (!empty($nama)) {
                    $rows[] = ['nama' => $nama, 'kelas' => $kelas ?: 'VII-A'];
                }
            }
        }

        if (empty($rows)) {
            return redirect()->back()->with('error', 'Tidak ada data siswa yang valid untuk diimpor. Pastikan format nama dan kelas sudah sesuai.');
        }

        $berhasil = 0;
        $gagal = 0;

        foreach ($rows as $item) {
            $nama = $item['nama'];
            $kelas = $item['kelas'];

            // Generator Email Otomatis: nama@roomlearning.sch.id
            $cleanName = strtolower(preg_replace('/[^a-zA-Z0-9]/', '', $nama));
            if (empty($cleanName)) {
                $cleanName = 'siswa' . rand(100, 999);
            }

            $emailBase = $cleanName . '@roomlearning.sch.id';
            $finalEmail = $emailBase;
            $counter = 1;

            // Pastikan email unik jika ada nama yang persis sama
            while ($userModel->where('email', $finalEmail)->first()) {
                $counter++;
                $finalEmail = $cleanName . $counter . '@roomlearning.sch.id';
            }

            $saved = $userModel->insert([
                'nama'       => $nama,
                'email'      => $finalEmail,
                'password'   => password_hash($defaultPassword, PASSWORD_DEFAULT),
                'role'       => 'siswa',
                'nis'        => null,
                'kelas'      => $kelas,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ]);

            if ($saved) {
                $berhasil++;
            } else {
                $gagal++;
            }
        }

        $msg = "Berhasil mengimpor dan membuat {$berhasil} akun siswa baru beserta email @roomlearning.sch.id.";
        if ($gagal > 0) {
            $msg .= " ({$gagal} data gagal disimpan)";
        }

        return redirect()->to('admin/siswa')->with('success', $msg);
    }
}

