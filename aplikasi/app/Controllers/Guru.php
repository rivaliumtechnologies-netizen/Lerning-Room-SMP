<?php

namespace App\Controllers;

use App\Models\ChatAiModel;
use App\Models\JadwalModel;
use App\Models\MateriModel;
use App\Models\PengumpulanModel;
use App\Models\TugasModel;
use App\Models\UserModel;
use CodeIgniter\HTTP\RedirectResponse;
use CodeIgniter\HTTP\ResponseInterface;

class Guru extends BaseController
{
    public function dashboard()
    {
        $materiModel      = new MateriModel();
        $tugasModel       = new TugasModel();
        $pengumpulanModel = new PengumpulanModel();
        $jadwalModel      = new JadwalModel();
        $userModel        = new UserModel();

        $guruId = session()->get('user_id');
        $guru   = $userModel->find($guruId);

        $jadwalList = $jadwalModel->getByGuru($guruId);

        $rawKelas = $guru['kelas_diajar'] ?? '';
        $kelasList = [];
        if (! empty($rawKelas)) {
            $kelasList = array_filter(array_map('trim', explode(',', $rawKelas)));
        }

        $totalSiswa = $userModel->where('role', 'siswa')->countAllResults(false);

        $data = [
            'guru'             => $guru,
            'kelasList'        => $kelasList,
            'totalSiswa'       => $totalSiswa,
            'materiCount'      => $materiModel->where('guru_id', $guruId)->countAllResults(false),
            'tugasCount'       => $tugasModel->where('guru_id', $guruId)->countAllResults(false),
            'pengumpulanCount' => $pengumpulanModel->countAllResults(false),
            'jadwalCount'      => count($jadwalList),
            'jadwalList'       => array_slice($jadwalList, 0, 5),
        ];

        return view('guru/dashboard', $data);
    }

    // ------------------------------------------------------------------
    // Profil
    // ------------------------------------------------------------------

    public function profil()
    {
        $userModel = new UserModel();
        $data['user'] = $userModel->find(session()->get('user_id'));

        return view('guru/profil', $data);
    }

    public function updateProfil(): RedirectResponse
    {
        $nama = $this->request->getPost('nama');
        $mapel = $this->request->getPost('mapel');
        $kelasDiajar = $this->request->getPost('kelas_diajar');

        if (! $nama) {
            return redirect()->back()->with('error', 'Nama wajib diisi.');
        }

        $userModel = new UserModel();
        $userModel->update(session()->get('user_id'), [
            'nama'         => $nama,
            'mapel'        => $mapel,
            'kelas_diajar' => $kelasDiajar,
            'updated_at'   => date('Y-m-d H:i:s'),
        ]);

        // Update nama pada session agar tampil di header.
        session()->set('user_name', $nama);

        return redirect()->back()->with('success', 'Profil berhasil diperbarui.');
    }

    // ------------------------------------------------------------------
    // Materi
    // ------------------------------------------------------------------

    public function materi()
    {
        $materiModel = new MateriModel();
        $data['materi'] = $materiModel->getByGuru(session()->get('user_id'));

        return view('guru/materi', $data);
    }

    public function saveMateri(): RedirectResponse
    {
        $materiModel = new MateriModel();
        $judul = $this->request->getPost('judul');
        $deskripsi = $this->request->getPost('deskripsi');
        $kelas = $this->request->getPost('kelas') ?: 'Semua';
        $file = $this->request->getFile('file');

        if (! $judul || ! $file || ! $file->isValid() || $file->hasMoved()) {
            return redirect()->back()->with('error', 'Judul dan file materi wajib diisi.');
        }

        $fileName = $file->getRandomName();
        $file->move(ROOTPATH . 'public/uploads', $fileName);

        $materiModel->save([
            'guru_id'    => session()->get('user_id'),
            'judul'      => $judul,
            'deskripsi'  => $deskripsi,
            'file'       => $fileName,
            'kelas'      => $kelas,
            'created_at' => date('Y-m-d H:i:s'),
        ]);

        return redirect()->back()->with('success', 'Materi berhasil diunggah.');
    }

    public function deleteMateri($id): RedirectResponse
    {
        $materiModel = new MateriModel();
        $materi = $materiModel->find($id);

        // Hanya boleh hapus milik sendiri.
        if ($materi && (int) $materi['guru_id'] === (int) session()->get('user_id')) {
            // Hapus file fisik jika ada.
            $filePath = ROOTPATH . 'public/uploads/' . $materi['file'];
            if (is_file($filePath)) {
                unlink($filePath);
            }
            $materiModel->delete($id);
        }

        return redirect()->back()->with('success', 'Materi berhasil dihapus.');
    }

    // ------------------------------------------------------------------
    // Tugas
    // ------------------------------------------------------------------

    public function tugas()
    {
        $tugasModel = new TugasModel();
        $data['tugas'] = $tugasModel->getByGuru(session()->get('user_id'));

        return view('guru/tugas', $data);
    }

    public function saveTugas(): RedirectResponse
    {
        $tugasModel = new TugasModel();
        $judul = $this->request->getPost('judul');
        $deskripsi = $this->request->getPost('deskripsi');
        $deadline = $this->request->getPost('deadline');
        $kelas = $this->request->getPost('kelas') ?: 'Semua';
        $linkEksternal = trim((string) $this->request->getPost('link_eksternal'));
        if (!empty($linkEksternal) && !preg_match('#^https?://#i', $linkEksternal)) {
            $linkEksternal = 'https://' . $linkEksternal;
        }

        if (! $judul || ! $deadline) {
            return redirect()->back()->with('error', 'Judul dan deadline tugas wajib diisi.');
        }

        $tugasModel->save([
            'guru_id'        => session()->get('user_id'),
            'judul'          => $judul,
            'deskripsi'      => $deskripsi,
            'link_eksternal' => !empty($linkEksternal) ? $linkEksternal : null,
            'deadline'       => $deadline,
            'kelas'          => $kelas,
            'created_at'     => date('Y-m-d H:i:s'),
        ]);

        return redirect()->back()->with('success', 'Tugas berhasil dibuat.');
    }

    public function deleteTugas($id): RedirectResponse
    {
        $tugasModel = new TugasModel();
        $tugas = $tugasModel->find($id);

        if ($tugas && (int) $tugas['guru_id'] === (int) session()->get('user_id')) {
            $tugasModel->delete($id);
        }

        return redirect()->back()->with('success', 'Tugas berhasil dihapus.');
    }

    // ------------------------------------------------------------------
    // Nilai / Penilaian Pengumpulan Tugas
    // ------------------------------------------------------------------

    public function nilai()
    {
        $pengumpulanModel = new PengumpulanModel();
        $tugasModel       = new TugasModel();
        $userModel        = new UserModel();

        $guruId = session()->get('user_id');
        $tugasList = $tugasModel->getByGuru($guruId);

        $filterTugasId = $this->request->getGet('tugas_id');
        $filterKelas   = $this->request->getGet('kelas');

        $submissions = [];
        foreach ($tugasList as $t) {
            if (!empty($filterTugasId) && $t['id'] != $filterTugasId) {
                continue;
            }

            $rows = $pengumpulanModel->where('tugas_id', $t['id'])->orderBy('created_at', 'DESC')->findAll();

            foreach ($rows as $row) {
                $siswa = $userModel->find($row['siswa_id']);

                if (!empty($filterKelas) && ($siswa['kelas'] ?? '') !== $filterKelas) {
                    continue;
                }

                $row['tugas_judul']    = $t['judul'];
                $row['tugas_kelas']    = $t['kelas'] ?? 'Semua';
                $row['tugas_deadline'] = $t['deadline'];
                $row['siswa_nama']     = $siswa['nama'] ?? 'Siswa';
                $row['siswa_nis']      = $siswa['nis'] ?? '-';
                $row['siswa_kelas']    = $siswa['kelas'] ?? '-';
                $submissions[] = $row;
            }
        }

        $data = [
            'submissions'   => $submissions,
            'tugasList'     => $tugasList,
            'filterTugasId' => $filterTugasId,
            'filterKelas'   => $filterKelas,
        ];

        return view('guru/nilai', $data);
    }

    /**
     * Unduh Rekap Nilai Siswa dalam format CSV / Excel
     */
    public function exportNilai(): ResponseInterface
    {
        $guruId           = session()->get('user_id');
        $userModel        = new UserModel();
        $tugasModel       = new TugasModel();
        $pengumpulanModel = new PengumpulanModel();

        $guru  = $userModel->find($guruId);
        $mapel = !empty($guru['mapel']) ? $guru['mapel'] : 'Mata_Pelajaran';

        $filterTugasId = $this->request->getGet('tugas_id');
        $filterKelas   = $this->request->getGet('kelas');

        $tugasList = $tugasModel->getByGuru($guruId);

        $filename = 'rekap_nilai_' . url_title($mapel, '_', true) . '_' . date('Ymd_His') . '.csv';

        $response = $this->response;
        $response->setHeader('Content-Type', 'text/csv; charset=UTF-8');
        $response->setHeader('Content-Disposition', 'attachment; filename="' . $filename . '"');

        $handle = fopen('php://output', 'w');
        // UTF-8 BOM untuk kompatibilitas Microsoft Excel
        fwrite($handle, "\xEF\xBB\xBF");

        fputcsv($handle, [
            'No',
            'Nama Siswa',
            'NIS',
            'Kelas Siswa',
            'Mata Pelajaran',
            'Guru Pengampu',
            'Judul Tugas',
            'Target Kelas',
            'Tenggat Waktu',
            'Waktu Pengumpulan',
            'Nilai (0-100)',
            'Status Penilaian',
            'Catatan / Feedback Guru'
        ]);

        $no = 1;
        foreach ($tugasList as $t) {
            if (!empty($filterTugasId) && $t['id'] != $filterTugasId) {
                continue;
            }

            $submissions = $pengumpulanModel->where('tugas_id', $t['id'])->orderBy('created_at', 'DESC')->findAll();

            foreach ($submissions as $sub) {
                $siswa = $userModel->find($sub['siswa_id']);

                if (!empty($filterKelas) && ($siswa['kelas'] ?? '') !== $filterKelas) {
                    continue;
                }

                fputcsv($handle, [
                    $no++,
                    $siswa['nama'] ?? 'Siswa',
                    $siswa['nis'] ?? '-',
                    $siswa['kelas'] ?? '-',
                    $mapel,
                    $guru['nama'] ?? 'Guru Pengampu',
                    $t['judul'],
                    $t['kelas'] ?? 'Semua',
                    !empty($t['deadline']) ? date('d/m/Y H:i', strtotime($t['deadline'])) : '-',
                    !empty($sub['created_at']) ? date('d/m/Y H:i', strtotime($sub['created_at'])) : '-',
                    $sub['nilai'] !== null ? $sub['nilai'] : 'Belum Dinilai',
                    ucfirst($sub['status'] ?? 'terkirim'),
                    $sub['komentar'] ?: '-',
                ]);
            }
        }

        fclose($handle);
        return $response;
    }

    /**
     * Halaman cetak / pratinjau cetak PDF rekap nilai resmi
     */
    public function cetakNilai()
    {
        $guruId           = session()->get('user_id');
        $userModel        = new UserModel();
        $tugasModel       = new TugasModel();
        $pengumpulanModel = new PengumpulanModel();

        $guru  = $userModel->find($guruId);
        $mapel = !empty($guru['mapel']) ? $guru['mapel'] : 'Mata Pelajaran';

        $filterTugasId = $this->request->getGet('tugas_id');
        $filterKelas   = $this->request->getGet('kelas');

        $tugasList = $tugasModel->getByGuru($guruId);

        $rows = [];
        $no = 1;
        foreach ($tugasList as $t) {
            if (!empty($filterTugasId) && $t['id'] != $filterTugasId) {
                continue;
            }

            $subs = $pengumpulanModel->where('tugas_id', $t['id'])->orderBy('created_at', 'DESC')->findAll();

            foreach ($subs as $sub) {
                $siswa = $userModel->find($sub['siswa_id']);

                if (!empty($filterKelas) && ($siswa['kelas'] ?? '') !== $filterKelas) {
                    continue;
                }

                $rows[] = [
                    'no'        => $no++,
                    'nama'      => $siswa['nama'] ?? 'Siswa',
                    'nis'       => $siswa['nis'] ?? '-',
                    'kelas'     => $siswa['kelas'] ?? '-',
                    'tugas'     => $t['judul'],
                    'deadline'  => $t['deadline'],
                    'waktu'     => $sub['created_at'],
                    'nilai'     => $sub['nilai'],
                    'status'    => $sub['status'],
                    'komentar'  => $sub['komentar'],
                ];
            }
        }

        $data = [
            'guru'          => $guru,
            'mapel'         => $mapel,
            'rows'          => $rows,
            'filterTugasId' => $filterTugasId,
            'filterKelas'   => $filterKelas,
        ];

        return view('guru/cetak_nilai', $data);
    }

    public function saveNilai(): RedirectResponse
    {
        $pengumpulanId = (int) $this->request->getPost('pengumpulan_id');
        $nilai = (int) $this->request->getPost('nilai');
        $komentar = $this->request->getPost('komentar');

        if (! $pengumpulanId || $nilai < 0 || $nilai > 100) {
            return redirect()->back()->with('error', 'Nilai harus antara 0 - 100.');
        }

        $pengumpulanModel = new PengumpulanModel();
        $pengumpulanModel->update($pengumpulanId, [
            'nilai'    => $nilai,
            'komentar' => $komentar,
            'status'   => 'dinilai',
        ]);

        return redirect()->back()->with('success', 'Nilai berhasil disimpan.');
    }

    public function downloadSubmission($fileName)
    {
        $filePath = ROOTPATH . 'public/uploads/' . basename($fileName);

        if (! is_file($filePath)) {
            return redirect()->back()->with('error', 'File tidak ditemukan.');
        }

        return $this->response->download($filePath, null);
    }

    public function viewSubmission($fileName)
    {
        $safeFileName = basename($fileName);
        $filePath = ROOTPATH . 'public/uploads/' . $safeFileName;

        if (! is_file($filePath)) {
            return redirect()->back()->with('error', 'File tugas tidak ditemukan.');
        }

        $mime = mime_content_type($filePath) ?: 'application/octet-stream';

        return $this->response
            ->setHeader('Content-Type', $mime)
            ->setHeader('Content-Disposition', 'inline; filename="' . $safeFileName . '"')
            ->setBody(file_get_contents($filePath));
    }

    // ------------------------------------------------------------------
    // Data Kelas & Siswa
    // ------------------------------------------------------------------
    public function kelasSiswa()
    {
        $userModel = new UserModel();
        $guruId = session()->get('user_id');
        $guru = $userModel->find($guruId);

        $semuaSiswa = $userModel->where('role', 'siswa')->orderBy('nama', 'ASC')->findAll();

        // Kelompokkan siswa per tingkatan kelas
        $siswaByKelas = [
            'VII'  => [],
            'VIII' => [],
            'IX'   => [],
            'Lain' => [],
        ];

        foreach ($semuaSiswa as $s) {
            $k = strtoupper(trim((string) $s['kelas']));
            if (in_array($k, ['VII', '7'])) {
                $siswaByKelas['VII'][] = $s;
            } elseif (in_array($k, ['VIII', '8'])) {
                $siswaByKelas['VIII'][] = $s;
            } elseif (in_array($k, ['IX', '9'])) {
                $siswaByKelas['IX'][] = $s;
            } else {
                $siswaByKelas['Lain'][] = $s;
            }
        }

        $data = [
            'guru'         => $guru,
            'siswaByKelas' => $siswaByKelas,
            'totalSiswa'   => count($semuaSiswa),
        ];

        return view('guru/kelas_siswa', $data);
    }

    // ------------------------------------------------------------------
    // Jadwal Pembelajaran
    // ------------------------------------------------------------------
    public function jadwal()
    {
        $jadwalModel = new JadwalModel();
        $userModel = new UserModel();
        $guruId = session()->get('user_id');
        $guru = $userModel->find($guruId);

        $data = [
            'jadwal' => $jadwalModel->getByGuru($guruId),
            'guru'   => $guru,
        ];

        return view('guru/jadwal', $data);
    }

    public function saveJadwal(): RedirectResponse
    {
        $jadwalModel = new JadwalModel();
        $guruId = session()->get('user_id');

        $mapel = $this->request->getPost('mapel');
        $kelas = $this->request->getPost('kelas');
        $hari = $this->request->getPost('hari');
        $jamMulai = $this->request->getPost('jam_mulai');
        $jamSelesai = $this->request->getPost('jam_selesai');
        $ruangan = $this->request->getPost('ruangan') ?: 'Ruang Kelas';
        $keterangan = $this->request->getPost('keterangan');

        if (! $mapel || ! $kelas || ! $hari || ! $jamMulai || ! $jamSelesai) {
            return redirect()->back()->with('error', 'Semua kolom jadwal wajib diisi lengkap.');
        }

        $jadwalModel->save([
            'guru_id'     => $guruId,
            'mapel'       => $mapel,
            'kelas'       => $kelas,
            'hari'        => $hari,
            'jam_mulai'   => $jamMulai,
            'jam_selesai' => $jamSelesai,
            'ruangan'     => $ruangan,
            'keterangan'  => $keterangan,
            'created_at'  => date('Y-m-d H:i:s'),
        ]);

        return redirect()->back()->with('success', 'Jadwal pembelajaran berhasil ditambahkan.');
    }

    public function deleteJadwal($id): RedirectResponse
    {
        $jadwalModel = new JadwalModel();
        $jadwal = $jadwalModel->find($id);

        if ($jadwal && (int) $jadwal['guru_id'] === (int) session()->get('user_id')) {
            $jadwalModel->delete($id);
        }

        return redirect()->back()->with('success', 'Jadwal berhasil dihapus.');
    }

    // ------------------------------------------------------------------
    // Monitoring AI Siswa (Pemantauan Chat Gemini per Mapel & Kelas)
    // ------------------------------------------------------------------
    public function monitoringAi()
    {
        $userModel = new UserModel();
        $chatModel = new ChatAiModel();

        $guruId = session()->get('user_id');
        $guru   = $userModel->find($guruId);

        $mapel = trim($guru['mapel'] ?? '');
        $rawKelas = $guru['kelas_diajar'] ?? '';
        $kelasList = [];
        if (!empty($rawKelas)) {
            $kelasList = array_filter(array_map('trim', explode(',', $rawKelas)));
        }

        // Ambil daftar unik seluruh kelas siswa di database untuk filter tambahan
        $allKelasDb = $userModel->where('role', 'siswa')
            ->where('kelas IS NOT NULL', null, false)
            ->where('kelas !=', '')
            ->distinct()
            ->findColumn('kelas') ?? [];

        // Gabungkan kelas yang diajar guru dengan semua kelas yang ada di database
        $combinedKelas = array_unique(array_filter(array_merge($kelasList, $allKelasDb)));
        sort($combinedKelas);

        $kelasParam = $this->request->getGet('kelas');
        $filterKelas = null;
        $isExplicitAllKelas = false;
        if ($kelasParam !== null) {
            if ($kelasParam === '' || $kelasParam === 'all') {
                $isExplicitAllKelas = true;
                $filterKelas = '';
            } else {
                $filterKelas = $kelasParam;
            }
        }

        $filterSiswa = $this->request->getGet('siswa_id') ? (int) $this->request->getGet('siswa_id') : null;
        $search = $this->request->getGet('q') ?: null;

        // Ambil SEMUA siswa di kelas/rombel yang relevan agar guru bisa memilih siswa siapa pun
        $studentListBuilder = $userModel->select('users.id, users.nama, users.nis, users.kelas, COUNT(chat_ai.id) as total_tanya')
            ->join('chat_ai', 'chat_ai.user_id = users.id', 'left')
            ->where('users.role', 'siswa');

        if (!empty($filterKelas)) {
            $studentListBuilder->where('users.kelas', $filterKelas);
        } elseif (!$isExplicitAllKelas && !empty($kelasList)) {
            $studentListBuilder->whereIn('users.kelas', $kelasList);
        }

        $studentList = $studentListBuilder->groupBy('users.id')
            ->orderBy('total_tanya', 'DESC')
            ->orderBy('users.nama', 'ASC')
            ->findAll();

        // Data siswa yang saat ini sedang dipilih
        $selectedStudent = null;
        if (!empty($filterSiswa)) {
            $selectedStudent = $userModel->find($filterSiswa);
        }

        // Ambil data chat siswa (jika siswa dipilih, khusus siswa tersebut)
        $chatList = $chatModel->getMonitoringByGuru($mapel, $kelasList, $filterKelas, $search, $filterSiswa, $isExplicitAllKelas);

        // Analisis kata kunci / konsep materi yang sering ditanyakan (Mengecualikan kata umum soal/tugas/percakapan)
        $keywordCounts = [];
        $excludedWords = [
            'soal', 'soal-soal', 'nomor', 'latihan', 'tugas', 'ulangan', 'ujian', 'pr', 'jawaban', 'kunci', 
            'pilihan', 'ganda', 'esai', 'essay', 'cara', 'mengerjakan', 'menyelesaikan', 'hitunglah', 'tentukan',
            'apa', 'itu', 'bagaimana', 'kenapa', 'mengapa', 'adalah', 'yang', 'dan', 'di', 'ke', 'dari', 
            'ini', 'itu', 'pada', 'untuk', 'dengan', 'saya', 'kamu', 'bisa', 'tolong', 'jelaskan', 'berikan', 
            'contoh', 'halo', 'hai', 'terima', 'kasih', 'apakah', 'seperti', 'dalam', 'tentang', 'buatkan', 'jawab'
        ];

        foreach ($chatList as $item) {
            $cleanText = strtolower(preg_replace('/[^\p{L}\p{N}\s]/u', ' ', $item['prompt']));
            $words = array_filter(explode(' ', $cleanText));
            foreach ($words as $w) {
                $w = trim($w);
                if (strlen($w) >= 4 && !in_array($w, $excludedWords)) {
                    $keywordCounts[$w] = ($keywordCounts[$w] ?? 0) + 1;
                }
            }
        }
        arsort($keywordCounts);
        $topKeywords = array_slice($keywordCounts, 0, 10, true);

        $data = [
            'guru'               => $guru,
            'mapel'              => $mapel,
            'kelasList'          => !empty($kelasList) ? $kelasList : $combinedKelas,
            'combinedKelas'      => $combinedKelas,
            'filterKelas'        => $filterKelas,
            'isExplicitAllKelas' => $isExplicitAllKelas,
            'filterSiswa'        => $filterSiswa,
            'selectedStudent'    => $selectedStudent,
            'studentList'        => $studentList,
            'search'             => $search,
            'chatList'           => $chatList,
            'totalChat'          => count($chatList),
            'topKeywords'        => $topKeywords,
        ];

        return view('guru/monitoring_ai', $data);
    }
}

