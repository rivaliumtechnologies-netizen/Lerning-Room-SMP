<?php

namespace App\Controllers;

use App\Models\JadwalModel;
use App\Models\MateriModel;
use App\Models\PengumpulanModel;
use App\Models\TugasModel;
use App\Models\UserModel;
use CodeIgniter\HTTP\RedirectResponse;

class Siswa extends BaseController
{
    public function dashboard()
    {
        $materiModel      = new MateriModel();
        $tugasModel       = new TugasModel();
        $jadwalModel      = new JadwalModel();
        $userModel        = new UserModel();
        $pengumpulanModel = new PengumpulanModel();

        $siswaId = session()->get('user_id');
        $siswa   = $userModel->find($siswaId);
        $kelas   = $siswa['kelas'] ?? 'Semua';

        $jadwalList = $jadwalModel->getByKelas($kelas);
        $materiList = $materiModel->getByKelas($kelas);
        $tugasList  = $tugasModel->getByKelas($kelas);

        // Deteksi hari ini dalam bahasa Indonesia
        $hariMap = [
            1 => 'Senin',
            2 => 'Selasa',
            3 => 'Rabu',
            4 => 'Kamis',
            5 => 'Jumat',
            6 => 'Sabtu',
            7 => 'Minggu',
        ];
        $hariIni = $hariMap[(int) date('N')] ?? 'Senin';

        // Filter jadwal khusus hari ini
        $jadwalHariIni = array_values(array_filter($jadwalList, function ($j) use ($hariIni) {
            return strcasecmp($j['hari'], $hariIni) === 0;
        }));

        // Pengumpulan & progress tugas siswa
        $userSubmissions = $pengumpulanModel->where('siswa_id', $siswaId)->findAll();
        $submissionMap = [];
        foreach ($userSubmissions as $sub) {
            $submissionMap[$sub['tugas_id']] = $sub;
        }

        $tugasPending   = 0;
        $tugasSubmitted = 0;
        $tugasGraded    = 0;
        $totalNilai     = 0;

        foreach ($tugasList as &$t) {
            if (isset($submissionMap[$t['id']])) {
                $sub = $submissionMap[$t['id']];
                $t['is_submitted'] = true;
                $t['status']       = $sub['status'] ?? 'dikumpulkan';
                $t['nilai']        = $sub['nilai'] ?? null;
                if ($t['nilai'] !== null && $t['nilai'] !== '') {
                    $tugasGraded++;
                    $totalNilai += (float) $t['nilai'];
                } else {
                    $tugasSubmitted++;
                }
            } else {
                $t['is_submitted'] = false;
                $t['status']       = 'belum';
                $t['nilai']        = null;
                $tugasPending++;
            }
        }
        unset($t);

        $rataRataNilai = $tugasGraded > 0 ? round($totalNilai / $tugasGraded, 1) : null;

        $data = [
            'siswa'          => $siswa,
            'kelas'          => $kelas,
            'hariIni'        => $hariIni,
            'jadwalHariIni'  => $jadwalHariIni,
            'materiCount'    => count($materiList),
            'tugasCount'     => count($tugasList),
            'jadwalCount'    => count($jadwalList),
            'tugasPending'   => $tugasPending,
            'tugasSubmitted' => $tugasSubmitted,
            'tugasGraded'    => $tugasGraded,
            'rataRataNilai'  => $rataRataNilai,
            'jadwalList'     => array_slice($jadwalList, 0, 5),
            'recentTugas'    => array_slice($tugasList, 0, 4),
        ];

        return view('siswa/dashboard', $data);
    }

    public function profil()
    {
        $userModel = new UserModel();
        $data['user'] = $userModel->find(session()->get('user_id'));

        return view('siswa/profil', $data);
    }

    public function updateProfil(): RedirectResponse
    {
        $nama = $this->request->getPost('nama');
        $kelas = $this->request->getPost('kelas');

        if (! $nama) {
            return redirect()->back()->with('error', 'Nama wajib diisi.');
        }

        $userModel = new UserModel();
        $userModel->update(session()->get('user_id'), [
            'nama'       => $nama,
            'kelas'      => $kelas,
            'updated_at' => date('Y-m-d H:i:s'),
        ]);

        session()->set('user_name', $nama);

        return redirect()->back()->with('success', 'Profil berhasil diperbarui.');
    }

    public function materi()
    {
        $userModel = new UserModel();
        $user = $userModel->find(session()->get('user_id'));
        $kelasSiswa = $user['kelas'] ?? null;

        $materiModel = new MateriModel();
        $data['materi'] = $materiModel->getByKelas($kelasSiswa);
        $data['kelas_siswa'] = $kelasSiswa;

        return view('siswa/materi', $data);
    }

    public function tugas()
    {
        $userModel = new UserModel();
        $user = $userModel->find(session()->get('user_id'));
        $kelasSiswa = $user['kelas'] ?? null;

        $tugasModel = new TugasModel();
        $pengumpulanModel = new PengumpulanModel();

        $tugas = $tugasModel->getByKelas($kelasSiswa);
        $siswaId = session()->get('user_id');

        // Tandai setiap tugas dengan status pengumpulan siswa ini.
        foreach ($tugas as &$t) {
            $submission = $pengumpulanModel
                ->where('tugas_id', $t['id'])
                ->where('siswa_id', $siswaId)
                ->first();

            $t['submitted'] = ! empty($submission);
            $t['status']    = $submission['status'] ?? null;
            $t['nilai']     = $submission['nilai'] ?? null;
            $t['komentar']  = $submission['komentar'] ?? null;
            $t['file']      = $submission['file'] ?? null;
            $t['submitted_at'] = $submission['created_at'] ?? null;
        }
        unset($t);

        $data['tugas']       = $tugas;
        $data['kelas_siswa'] = $kelasSiswa;
        $data['user']        = $user;

        return view('siswa/tugas', $data);
    }

    public function submitTugas(): RedirectResponse
    {
        $tugasId = (int) $this->request->getPost('tugas_id');
        $komentar = $this->request->getPost('komentar');
        $file = $this->request->getFile('file');

        if (! $tugasId) {
            return redirect()->back()->with('error', 'Pilih tugas yang ingin dikumpulkan.');
        }

        if (! $file || ! $file->isValid() || $file->hasMoved()) {
            return redirect()->back()->with('error', 'File tugas wajib diunggah.');
        }

        $siswaId = session()->get('user_id');
        $pengumpulanModel = new PengumpulanModel();

        // Cek apakah sudah pernah mengumpulkan tugas ini.
        $existing = $pengumpulanModel
            ->where('tugas_id', $tugasId)
            ->where('siswa_id', $siswaId)
            ->first();

        $fileName = $file->getRandomName();
        $file->move(ROOTPATH . 'public/uploads', $fileName);

        $data = [
            'tugas_id'   => $tugasId,
            'siswa_id'   => $siswaId,
            'file'       => $fileName,
            'komentar'   => $komentar,
            'status'     => 'dikumpulkan',
            'created_at' => date('Y-m-d H:i:s'),
        ];

        if ($existing) {
            // Hapus file lama.
            $oldFile = ROOTPATH . 'public/uploads/' . $existing['file'];
            if (is_file($oldFile)) {
                unlink($oldFile);
            }
            $pengumpulanModel->update($existing['id'], $data);
        } else {
            $pengumpulanModel->save($data);
        }

        return redirect()->back()->with('success', 'Tugas berhasil dikumpulkan.');
    }

    public function jadwal()
    {
        $userModel = new UserModel();
        $user = $userModel->find(session()->get('user_id'));
        $kelasSiswa = $user['kelas'] ?? null;

        $jadwalModel = new JadwalModel();
        $data = [
            'user'        => $user,
            'kelas_siswa' => $kelasSiswa,
            'jadwal'      => $jadwalModel->getByKelas($kelasSiswa),
        ];

        return view('siswa/jadwal', $data);
    }
}

