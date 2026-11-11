<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Data Kelas & Siswa - Guru</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;700;800&display=swap" rel="stylesheet">
  <style>body { font-family: 'Plus Jakarta Sans', sans-serif; }</style>
</head>
<body class="bg-slate-50 text-slate-800 flex h-screen overflow-hidden">
  <!-- Sidebar Guru -->
  <aside class="w-64 bg-white border-r border-slate-200 flex flex-col justify-between shrink-0 p-4">
    <div>
      <div class="p-3 mb-4 flex items-center gap-2">
        <div class="w-8 h-8 bg-blue-600 text-white rounded-lg flex items-center justify-center font-bold text-sm"><i class="fa-solid fa-graduation-cap"></i></div>
        <div><h2 class="font-extrabold text-xs text-slate-800 leading-none">Room Learning</h2><span class="text-[9px] font-bold text-blue-600">SMP</span></div>
      </div>
      <nav class="space-y-1">
        <a href="<?= site_url('guru/dashboard') ?>" class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-slate-600 hover:bg-slate-50 font-semibold text-xs"><i class="fa-solid fa-house w-4"></i><span>Beranda</span></a>
        <a href="<?= site_url('guru/kelas-siswa') ?>" class="flex items-center gap-3 px-3 py-2.5 rounded-xl bg-blue-50 text-blue-600 font-bold text-xs"><i class="fa-solid fa-users-rectangle w-4"></i><span>Kelas & Siswa</span></a>
        <a href="<?= site_url('guru/jadwal') ?>" class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-slate-600 hover:bg-slate-50 font-semibold text-xs"><i class="fa-regular fa-calendar-days w-4"></i><span>Jadwal Belajar</span></a>
        <a href="<?= site_url('guru/materi') ?>" class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-slate-600 hover:bg-slate-50 font-semibold text-xs"><i class="fa-regular fa-book-open w-4"></i><span>Kelola Materi</span></a>
        <a href="<?= site_url('guru/tugas') ?>" class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-slate-600 hover:bg-slate-50 font-semibold text-xs"><i class="fa-regular fa-clipboard w-4"></i><span>Kelola Tugas</span></a>
        <a href="<?= site_url('guru/nilai') ?>" class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-slate-600 hover:bg-slate-50 font-semibold text-xs"><i class="fa-regular fa-award w-4"></i><span>Nilai</span></a>
        <a href="<?= site_url('guru/monitoring-ai') ?>" class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-slate-600 hover:bg-slate-50 font-semibold text-xs"><i class="fa-solid fa-chart-line w-4 text-indigo-500"></i><span>Monitoring AI Siswa</span></a>
        <a href="<?= site_url('guru/profil') ?>" class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-slate-600 hover:bg-slate-50 font-semibold text-xs"><i class="fa-regular fa-user w-4"></i><span>Profil</span></a>
        <a href="<?= site_url('gemini') ?>" class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-slate-600 hover:bg-slate-50 font-semibold text-xs"><i class="fa-solid fa-robot w-4"></i><span>Gemini AI</span></a>
      </nav>
    </div>
    <a href="<?= site_url('logout') ?>" class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-red-500 hover:bg-red-50 font-bold text-xs"><i class="fa-solid fa-right-from-bracket w-4"></i><span>Keluar</span></a>
  </aside>

  <main class="flex-1 overflow-y-auto p-8">
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 mb-6">
      <div>
        <h1 class="text-2xl font-bold text-slate-800">Data Kelas & Direktori Siswa</h1>
        <p class="text-xs text-slate-400 mt-1">Daftar kelas yang diajarkan dan data siswa aktif di setiap tingkatan kelas.</p>
      </div>
      <div class="flex items-center gap-2">
        <span class="text-xs bg-slate-100 text-slate-700 font-bold px-3 py-1.5 rounded-xl border border-slate-200">
          <i class="fa-solid fa-chalkboard-user text-blue-600 mr-1.5"></i>
          Mata Pelajaran: <span class="text-blue-600"><?= esc($guru['mapel'] ?? 'Umum') ?></span>
        </span>
      </div>
    </div>

    <!-- Ringkasan Statistik Kelas -->
    <div class="grid grid-cols-1 sm:grid-cols-4 gap-4 mb-8">
      <div class="bg-white p-5 rounded-2xl border border-slate-100 shadow-sm flex items-center gap-4">
        <div class="w-12 h-12 rounded-xl bg-emerald-50 text-emerald-600 flex items-center justify-center text-xl font-bold">
          VII
        </div>
        <div>
          <p class="text-[10px] font-bold text-slate-400 uppercase">Kelas 7 (VII)</p>
          <h3 class="text-xl font-extrabold text-slate-800"><?= count($siswaByKelas['VII']) ?> Siswa</h3>
        </div>
      </div>

      <div class="bg-white p-5 rounded-2xl border border-slate-100 shadow-sm flex items-center gap-4">
        <div class="w-12 h-12 rounded-xl bg-blue-50 text-blue-600 flex items-center justify-center text-xl font-bold">
          VIII
        </div>
        <div>
          <p class="text-[10px] font-bold text-slate-400 uppercase">Kelas 8 (VIII)</p>
          <h3 class="text-xl font-extrabold text-slate-800"><?= count($siswaByKelas['VIII']) ?> Siswa</h3>
        </div>
      </div>

      <div class="bg-white p-5 rounded-2xl border border-slate-100 shadow-sm flex items-center gap-4">
        <div class="w-12 h-12 rounded-xl bg-purple-50 text-purple-600 flex items-center justify-center text-xl font-bold">
          IX
        </div>
        <div>
          <p class="text-[10px] font-bold text-slate-400 uppercase">Kelas 9 (IX)</p>
          <h3 class="text-xl font-extrabold text-slate-800"><?= count($siswaByKelas['IX']) ?> Siswa</h3>
        </div>
      </div>

      <div class="bg-white p-5 rounded-2xl border border-slate-100 shadow-sm flex items-center gap-4">
        <div class="w-12 h-12 rounded-xl bg-slate-100 text-slate-600 flex items-center justify-center text-xl font-bold">
          <i class="fa-solid fa-users"></i>
        </div>
        <div>
          <p class="text-[10px] font-bold text-slate-400 uppercase">Total Siswa Terdaftar</p>
          <h3 class="text-xl font-extrabold text-slate-800"><?= esc($totalSiswa) ?> Siswa</h3>
        </div>
      </div>
    </div>

    <!-- Informasi Kelas yang Diajar Guru -->
    <div class="bg-gradient-to-r from-blue-600 to-indigo-600 text-white p-6 rounded-3xl mb-8 shadow-md flex items-center justify-between">
      <div>
        <h3 class="text-base font-bold flex items-center gap-2">
          <i class="fa-solid fa-school"></i>
          <span>Kelas yang Ditugaskan untuk Anda:</span>
        </h3>
        <p class="text-xs text-blue-100 mt-1">
          <?= !empty($guru['kelas_diajar']) ? 'Anda mengampu kelas: <strong>' . esc($guru['kelas_diajar']) . '</strong>' : 'Kelas yang diajar belum diatur di menu profil guru.' ?>
        </p>
      </div>
      <a href="<?= site_url('guru/profil') ?>" class="bg-white text-blue-600 hover:bg-blue-50 font-bold px-4 py-2 rounded-xl text-xs transition">
        Ubah di Profil
      </a>
    </div>

    <!-- Tab Pilihan Kelas -->
    <div class="mb-6 flex flex-wrap gap-2 border-b border-slate-200 pb-3">
      <button onclick="switchKelasTab('all')" id="tabBtn-all" class="kelas-tab-btn active px-4 py-2 rounded-xl text-xs font-bold transition bg-blue-600 text-white shadow-sm">
        Semua Tingkatan (<?= esc($totalSiswa) ?>)
      </button>
      <button onclick="switchKelasTab('VII')" id="tabBtn-VII" class="kelas-tab-btn px-4 py-2 rounded-xl text-xs font-bold transition bg-white text-slate-600 hover:bg-slate-100 border border-slate-200">
        Kelas 7 / VII (<?= count($siswaByKelas['VII']) ?>)
      </button>
      <button onclick="switchKelasTab('VIII')" id="tabBtn-VIII" class="kelas-tab-btn px-4 py-2 rounded-xl text-xs font-bold transition bg-white text-slate-600 hover:bg-slate-100 border border-slate-200">
        Kelas 8 / VIII (<?= count($siswaByKelas['VIII']) ?>)
      </button>
      <button onclick="switchKelasTab('IX')" id="tabBtn-IX" class="kelas-tab-btn px-4 py-2 rounded-xl text-xs font-bold transition bg-white text-slate-600 hover:bg-slate-100 border border-slate-200">
        Kelas 9 / IX (<?= count($siswaByKelas['IX']) ?>)
      </button>
    </div>

    <!-- Tabel Daftar Siswa -->
    <div class="bg-white rounded-2xl border border-slate-100 shadow-sm overflow-hidden">
      <div class="overflow-x-auto">
        <table class="w-full text-left text-xs">
          <thead class="bg-slate-50 text-slate-400 font-bold border-b border-slate-100 uppercase tracking-wider text-[10px]">
            <tr>
              <th class="p-4">No</th>
              <th class="p-4">Nama Siswa</th>
              <th class="p-4">NIS</th>
              <th class="p-4">Tingkat Kelas</th>
              <th class="p-4">Email Akun</th>
              <th class="p-4 text-center">Status</th>
            </tr>
          </thead>
          <tbody class="divide-y divide-slate-100" id="siswaTableBody">
            <?php
              $allCombined = array_merge($siswaByKelas['VII'], $siswaByKelas['VIII'], $siswaByKelas['IX'], $siswaByKelas['Lain']);
            ?>
            <?php if (empty($allCombined)): ?>
              <tr><td colspan="6" class="p-8 text-center text-slate-400">Belum ada data siswa terdaftar.</td></tr>
            <?php else: ?>
              <?php $no = 1; foreach ($allCombined as $s): ?>
                <?php
                  $k = strtoupper(trim((string)$s['kelas']));
                  $groupClass = in_array($k, ['VII','7']) ? 'VII' : (in_array($k, ['VIII','8']) ? 'VIII' : (in_array($k, ['IX','9']) ? 'IX' : 'Lain'));
                  $badgeColor = match($groupClass) {
                    'VII'   => 'bg-emerald-50 text-emerald-700 border-emerald-200',
                    'VIII'  => 'bg-blue-50 text-blue-700 border-blue-200',
                    'IX'    => 'bg-purple-50 text-purple-700 border-purple-200',
                    default => 'bg-slate-100 text-slate-600 border-slate-200',
                  };
                ?>
                <tr class="siswa-row siswa-kelas-<?= $groupClass ?> hover:bg-slate-50/70 transition">
                  <td class="p-4 text-slate-400 font-medium"><?= $no++ ?></td>
                  <td class="p-4 font-bold text-slate-800 flex items-center gap-2.5">
                    <div class="w-7 h-7 rounded-lg bg-blue-100 text-blue-600 flex items-center justify-center font-bold text-xs">
                      <?= strtoupper(substr($s['nama'], 0, 1)) ?>
                    </div>
                    <span><?= esc($s['nama']) ?></span>
                  </td>
                  <td class="p-4 text-slate-600 font-mono"><?= esc($s['nis'] ?: '-') ?></td>
                  <td class="p-4">
                    <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-full text-[10px] font-extrabold border <?= $badgeColor ?>">
                      <i class="fa-solid fa-graduation-cap text-[9px]"></i>
                      Kelas <?= esc($s['kelas'] ?: 'Belum diatur') ?>
                    </span>
                  </td>
                  <td class="p-4 text-slate-500"><?= esc($s['email']) ?></td>
                  <td class="p-4 text-center">
                    <span class="inline-flex items-center gap-1 bg-emerald-50 text-emerald-600 border border-emerald-200 px-2 py-0.5 rounded-full text-[10px] font-bold">
                      <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span> Aktif
                    </span>
                  </td>
                </tr>
              <?php endforeach; ?>
            <?php endif; ?>
          </tbody>
        </table>
      </div>
    </div>
  </main>

  <script>
    function switchKelasTab(kelas) {
      // Toggle button styles
      document.querySelectorAll('.kelas-tab-btn').forEach(btn => {
        btn.className = "kelas-tab-btn px-4 py-2 rounded-xl text-xs font-bold transition bg-white text-slate-600 hover:bg-slate-100 border border-slate-200";
      });
      const activeBtn = document.getElementById('tabBtn-' + kelas);
      if (activeBtn) {
        activeBtn.className = "kelas-tab-btn active px-4 py-2 rounded-xl text-xs font-bold transition bg-blue-600 text-white shadow-sm";
      }

      // Filter rows
      const rows = document.querySelectorAll('.siswa-row');
      rows.forEach(row => {
        if (kelas === 'all') {
          row.style.display = '';
        } else {
          row.style.display = row.classList.contains('siswa-kelas-' + kelas) ? '' : 'none';
        }
      });
    }
  </script>
</body>
</html>
