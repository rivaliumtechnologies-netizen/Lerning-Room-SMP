<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Kelola Pengguna - Room Learning SMP</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
  <style>
    body { font-family: 'Plus Jakarta Sans', sans-serif; }
    .custom-scroll::-webkit-scrollbar { width: 5px; height: 5px; }
    .custom-scroll::-webkit-scrollbar-track { background: transparent; }
    .custom-scroll::-webkit-scrollbar-thumb { background: #cbd5e1; border-radius: 9999px; }
    .custom-scroll::-webkit-scrollbar-thumb:hover { background: #94a3b8; }
  </style>
</head>
<body class="bg-slate-50 text-slate-800 flex h-screen overflow-hidden">

  <!-- Sidebar Navigasi Admin -->
  <aside class="w-64 bg-white border-r border-slate-200 flex flex-col justify-between shrink-0 p-4 z-20">
    <div>
      <!-- App Brand Logo -->
      <div class="p-3 mb-4 flex items-center gap-2.5">
        <div class="w-9 h-9 bg-gradient-to-tr from-blue-700 to-indigo-600 text-white rounded-xl flex items-center justify-center font-bold text-sm shadow-md shadow-blue-200">
          <i class="fa-solid fa-graduation-cap"></i>
        </div>
        <div>
          <h2 class="font-extrabold text-xs text-slate-900 leading-none">Room Learning</h2>
          <span class="text-[9px] font-bold text-blue-600 uppercase tracking-wider">SMP • Administrator</span>
        </div>
      </div>

      <!-- Main Navigation Menu -->
      <nav class="space-y-1">
        <a href="<?= site_url('admin/dashboard') ?>" class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl text-slate-600 hover:bg-slate-50 hover:text-slate-900 font-semibold text-xs transition">
          <i class="fa-solid fa-house w-4"></i>
          <span>Dashboard</span>
        </a>
        <a href="<?= site_url('admin/users') ?>" class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl bg-blue-50 text-blue-600 font-bold text-xs shadow-sm transition">
          <i class="fa-solid fa-users w-4"></i>
          <span>Kelola Pengguna</span>
        </a>
        <a href="<?= site_url('admin/jadwal') ?>" class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl text-slate-600 hover:bg-slate-50 hover:text-slate-900 font-semibold text-xs transition">
          <i class="fa-regular fa-calendar-days w-4"></i>
          <span>Jadwal Pelajaran</span>
        </a>
      </nav>

      <!-- Quick Export Box -->
      <div class="mt-6 pt-5 border-t border-slate-100">
        <p class="px-3 text-[10px] font-bold uppercase tracking-wider text-slate-400 mb-2">Laporan & Ekspor</p>
        <div class="space-y-1">
          <a href="<?= site_url('admin/export/users') ?>" class="flex items-center gap-2.5 px-3 py-2 rounded-xl text-slate-600 hover:bg-emerald-50 hover:text-emerald-700 text-xs font-semibold transition">
            <i class="fa-solid fa-file-excel text-emerald-600 w-3.5"></i>
            <span>Ekspor Data User</span>
          </a>
          <a href="<?= site_url('admin/export/tugas') ?>" class="flex items-center gap-2.5 px-3 py-2 rounded-xl text-slate-600 hover:bg-amber-50 hover:text-amber-700 text-xs font-semibold transition">
            <i class="fa-solid fa-file-csv text-amber-600 w-3.5"></i>
            <span>Ekspor Data Tugas</span>
          </a>
        </div>
      </div>
    </div>

    <!-- Admin Profile & Logout -->
    <div class="pt-4 border-t border-slate-100">
      <div class="flex items-center gap-2.5 px-2 py-2 mb-2">
        <div class="w-8 h-8 rounded-full bg-slate-100 border border-slate-200 flex items-center justify-center font-black text-xs text-slate-700">
          <i class="fa-solid fa-user-shield"></i>
        </div>
        <div class="truncate">
          <div class="text-xs font-bold text-slate-800 leading-tight truncate"><?= esc(session()->get('user_name') ?? 'Admin') ?></div>
          <div class="text-[10px] text-slate-400">Super Administrator</div>
        </div>
      </div>
      <a href="<?= site_url('logout') ?>" class="flex items-center gap-2.5 px-3.5 py-2.5 rounded-xl text-red-500 hover:bg-red-50 font-bold text-xs transition">
        <i class="fa-solid fa-right-from-bracket w-4"></i>
        <span>Keluar Sistem</span>
      </a>
    </div>
  </aside>

  <!-- Main Content Area -->
  <main class="flex-1 overflow-y-auto p-6 md:p-8 custom-scroll">
    <!-- Header Bar -->
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 mb-6">
      <div>
        <h1 class="text-2xl font-extrabold text-slate-900 tracking-tight">Manajemen Pengguna</h1>
        <p class="text-xs text-slate-400 mt-1">Kelola data login, hak akses akun pendidik, peserta didik, dan kata sandi.</p>
      </div>
      <div class="flex flex-wrap items-center gap-2">
        <a href="<?= site_url('admin/export/users') ?>" class="inline-flex items-center gap-2 px-3.5 py-2.5 rounded-xl bg-white border border-slate-200 hover:bg-slate-50 text-slate-700 text-xs font-bold shadow-sm transition">
          <i class="fa-solid fa-file-excel text-emerald-600"></i>
          <span>Ekspor Excel/CSV</span>
        </a>
        <button onclick="document.getElementById('modalImportSiswa').classList.remove('hidden')" class="inline-flex items-center gap-2 px-4 py-2.5 rounded-xl bg-emerald-600 hover:bg-emerald-700 text-white text-xs font-extrabold shadow-sm transition">
          <i class="fa-solid fa-file-arrow-up"></i>
          <span>Import Siswa (Batch Buat Akun)</span>
        </button>
        <button onclick="document.getElementById('modalTambahUser').classList.remove('hidden')" class="inline-flex items-center gap-2 px-4 py-2.5 rounded-xl bg-blue-600 hover:bg-blue-700 text-white text-xs font-extrabold shadow-sm transition">
          <i class="fa-solid fa-user-plus"></i>
          <span>Tambah Akun Baru</span>
        </button>
      </div>
    </div>

    <!-- Flash Messages -->
    <?php if (session()->getFlashdata('success')): ?>
      <div class="mb-5 bg-emerald-50 border border-emerald-200 text-emerald-700 rounded-2xl p-4 text-xs font-bold flex items-center gap-2.5 shadow-sm">
        <i class="fa-solid fa-circle-check text-emerald-500 text-base"></i>
        <span><?= esc(session()->getFlashdata('success')) ?></span>
      </div>
    <?php endif; ?>

    <?php if (session()->getFlashdata('error')): ?>
      <div class="mb-5 bg-red-50 border border-red-200 text-red-700 rounded-2xl p-4 text-xs font-bold flex items-center gap-2.5 shadow-sm">
        <i class="fa-solid fa-circle-exclamation text-red-500 text-base"></i>
        <span><?= esc(session()->getFlashdata('error')) ?></span>
      </div>
    <?php endif; ?>

    <?php if (session()->getFlashdata('errors')): ?>
      <div class="mb-5 bg-red-50 border border-red-200 text-red-700 rounded-2xl p-4 text-xs font-semibold shadow-sm space-y-1">
        <?php foreach (session()->getFlashdata('errors') as $err): ?>
          <p class="flex items-center gap-2"><i class="fa-solid fa-xmark text-red-500"></i> <?= esc($err) ?></p>
        <?php endforeach; ?>
      </div>
    <?php endif; ?>

    <!-- Stat Cards Overview -->
    <?php
      // Helper untuk render tabel siswa per kelas
      $renderSiswaTable = function($studentList, $tableBodyId, $classLabel, $colorTheme = 'blue') {
          $avatarBg = match($colorTheme) {
              'emerald' => 'bg-emerald-100 text-emerald-700',
              'purple'  => 'bg-purple-100 text-purple-700',
              default   => 'bg-blue-100 text-blue-700',
          };
          $badgeStyle = match($colorTheme) {
              'emerald' => 'bg-emerald-50 text-emerald-700 border-emerald-200',
              'purple'  => 'bg-purple-50 text-purple-700 border-purple-200',
              default   => 'bg-blue-50 text-blue-700 border-blue-200',
          };
    ?>
      <div class="overflow-x-auto">
        <table class="w-full text-left text-xs">
          <thead>
            <tr class="bg-slate-50 text-slate-400 uppercase text-[10px] font-extrabold tracking-wider border-b border-slate-100">
              <th class="p-3.5 pl-4">Siswa <?= esc($classLabel) ?></th>
              <th class="p-3.5">NIS</th>
              <th class="p-3.5">Kelas / Rombel</th>
              <th class="p-3.5">Email Akun</th>
              <th class="p-3.5 text-right pr-4">Aksi</th>
            </tr>
          </thead>
          <tbody id="<?= esc($tableBodyId) ?>" class="divide-y divide-slate-100">
            <?php if (empty($studentList)): ?>
              <tr>
                <td colspan="5" class="text-center py-8 text-slate-400 text-xs italic">
                  Belum ada siswa terdaftar untuk <?= esc($classLabel) ?>. Klik tombol Tambah Akun Baru atau Import Siswa di atas.
                </td>
              </tr>
            <?php else: ?>
              <?php foreach ($studentList as $s): ?>
                <tr class="hover:bg-slate-50/70 transition user-row" data-kelas="<?= strtolower(esc($s['kelas'] ?? '')) ?>" data-nama="<?= strtolower(esc($s['nama'])) ?>" data-email="<?= strtolower(esc($s['email'])) ?>">
                  <td class="p-3.5 pl-4">
                    <div class="flex items-center gap-2.5">
                      <div class="w-8 h-8 rounded-full <?= $avatarBg ?> flex items-center justify-center font-bold text-xs shrink-0">
                        <?= strtoupper(substr($s['nama'], 0, 1)) ?>
                      </div>
                      <span class="font-bold text-slate-800 text-xs"><?= esc($s['nama']) ?></span>
                    </div>
                  </td>
                  <td class="p-3.5 font-semibold text-slate-600">
                    <?= esc($s['nis'] ?: '-') ?>
                  </td>
                  <td class="p-3.5">
                    <span class="px-2.5 py-0.5 rounded-lg text-[10px] font-extrabold border <?= $badgeStyle ?>">
                      Kelas <?= esc($s['kelas'] ?: 'Semua') ?>
                    </span>
                  </td>
                  <td class="p-3.5 text-slate-500 font-mono text-[11px]">
                    <?= esc($s['email']) ?>
                  </td>
                  <td class="p-3.5 text-right pr-4">
                    <div class="flex items-center justify-end gap-1.5">
                      <button type="button" onclick="openResetPasswordModal('<?= esc($s['id']) ?>', '<?= esc($s['nama'], 'js') ?>')" class="inline-flex items-center gap-1 px-2.5 py-1 rounded-lg text-amber-600 bg-amber-50 hover:bg-amber-100 text-[11px] font-bold transition" title="Reset Password">
                        <i class="fa-solid fa-key text-[10px]"></i>
                        <span>Reset</span>
                      </button>
                      <form action="<?= site_url('admin/users/delete') ?>" method="post" onsubmit="return confirm('Apakah Anda yakin ingin menghapus akun siswa <?= esc($s['nama']) ?>? Data pengumpulan tugas terkait juga akan terhapus.')" class="inline">
                        <?= csrf_field() ?>
                        <input type="hidden" name="user_id" value="<?= esc($s['id']) ?>">
                        <button type="submit" class="inline-flex items-center gap-1 px-2.5 py-1 rounded-lg text-red-500 bg-red-50 hover:bg-red-100 text-[11px] font-bold transition" title="Hapus Akun">
                          <i class="fa-regular fa-trash-can text-[10px]"></i>
                          <span>Hapus</span>
                        </button>
                      </form>
                    </div>
                  </td>
                </tr>
              <?php endforeach; ?>
            <?php endif; ?>
          </tbody>
        </table>
      </div>
    <?php }; ?>

    <!-- Stat Cards Overview: Dipisah Guru, Kelas VII, VIII, IX -->
    <div class="grid grid-cols-2 sm:grid-cols-4 gap-4 mb-6">
      <div class="bg-white p-4 rounded-2xl border border-slate-100 shadow-sm flex items-center gap-3 cursor-pointer hover:border-indigo-300 transition" onclick="switchUserTab('guru')">
        <div class="w-10 h-10 rounded-xl bg-indigo-50 text-indigo-600 flex items-center justify-center text-sm font-bold shrink-0">
          <i class="fa-solid fa-chalkboard-user"></i>
        </div>
        <div>
          <span class="text-[10px] font-bold uppercase tracking-wider text-slate-400 block">Guru Pendidik</span>
          <h3 class="text-xl font-extrabold text-slate-800"><?= count($guru) ?> Akun</h3>
        </div>
      </div>

      <div class="bg-white p-4 rounded-2xl border border-slate-100 shadow-sm flex items-center gap-3 cursor-pointer hover:border-emerald-300 transition" onclick="switchUserTab('vii')">
        <div class="w-10 h-10 rounded-xl bg-emerald-50 text-emerald-600 flex items-center justify-center text-sm font-bold shrink-0">
          <i class="fa-solid fa-user-graduate"></i>
        </div>
        <div>
          <span class="text-[10px] font-bold uppercase tracking-wider text-slate-400 block">Siswa Kelas VII</span>
          <h3 class="text-xl font-extrabold text-slate-800"><?= count($siswaVII) ?> Siswa</h3>
        </div>
      </div>

      <div class="bg-white p-4 rounded-2xl border border-slate-100 shadow-sm flex items-center gap-3 cursor-pointer hover:border-blue-300 transition" onclick="switchUserTab('viii')">
        <div class="w-10 h-10 rounded-xl bg-blue-50 text-blue-600 flex items-center justify-center text-sm font-bold shrink-0">
          <i class="fa-solid fa-user-graduate"></i>
        </div>
        <div>
          <span class="text-[10px] font-bold uppercase tracking-wider text-slate-400 block">Siswa Kelas VIII</span>
          <h3 class="text-xl font-extrabold text-slate-800"><?= count($siswaVIII) ?> Siswa</h3>
        </div>
      </div>

      <div class="bg-white p-4 rounded-2xl border border-slate-100 shadow-sm flex items-center gap-3 cursor-pointer hover:border-purple-300 transition" onclick="switchUserTab('ix')">
        <div class="w-10 h-10 rounded-xl bg-purple-50 text-purple-600 flex items-center justify-center text-sm font-bold shrink-0">
          <i class="fa-solid fa-user-graduate"></i>
        </div>
        <div>
          <span class="text-[10px] font-bold uppercase tracking-wider text-slate-400 block">Siswa Kelas IX</span>
          <h3 class="text-xl font-extrabold text-slate-800"><?= count($siswaIX) ?> Siswa</h3>
        </div>
      </div>
    </div>

    <!-- Tabbed Management Section -->
    <div class="bg-white rounded-3xl border border-slate-100 shadow-sm p-6 mb-8">
      <!-- Tab Controls & Search Bar -->
      <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-6 pb-4 border-b border-slate-100">
        <div class="flex flex-wrap items-center gap-2">
          <!-- Tab 1: Guru -->
          <button id="tabBtnGURU" onclick="switchUserTab('guru')" class="px-3.5 py-2 rounded-xl text-xs font-extrabold bg-indigo-50 text-indigo-700 transition flex items-center gap-2 border border-indigo-200 shadow-xs">
            <i class="fa-solid fa-chalkboard-user"></i>
            <span>Guru (<?= count($guru) ?>)</span>
          </button>

          <!-- Tab 2: Kelas VII -->
          <button id="tabBtnVII" onclick="switchUserTab('vii')" class="px-3.5 py-2 rounded-xl text-xs font-semibold text-slate-500 hover:bg-slate-50 transition flex items-center gap-2 border border-transparent">
            <i class="fa-solid fa-user-graduate text-emerald-600"></i>
            <span>Kelas VII (<?= count($siswaVII) ?>)</span>
          </button>

          <!-- Tab 3: Kelas VIII -->
          <button id="tabBtnVIII" onclick="switchUserTab('viii')" class="px-3.5 py-2 rounded-xl text-xs font-semibold text-slate-500 hover:bg-slate-50 transition flex items-center gap-2 border border-transparent">
            <i class="fa-solid fa-user-graduate text-blue-600"></i>
            <span>Kelas VIII (<?= count($siswaVIII) ?>)</span>
          </button>

          <!-- Tab 4: Kelas IX -->
          <button id="tabBtnIX" onclick="switchUserTab('ix')" class="px-3.5 py-2 rounded-xl text-xs font-semibold text-slate-500 hover:bg-slate-50 transition flex items-center gap-2 border border-transparent">
            <i class="fa-solid fa-user-graduate text-purple-600"></i>
            <span>Kelas IX (<?= count($siswaIX) ?>)</span>
          </button>

          <?php if (!empty($siswaLain)): ?>
          <!-- Tab 5: Lainnya (Opsional jika ada siswa tanpa jenjang kelas standar) -->
          <button id="tabBtnLAIN" onclick="switchUserTab('lain')" class="px-3.5 py-2 rounded-xl text-xs font-semibold text-slate-500 hover:bg-slate-50 transition flex items-center gap-2 border border-transparent">
            <i class="fa-solid fa-users text-slate-400"></i>
            <span>Lainnya (<?= count($siswaLain) ?>)</span>
          </button>
          <?php endif; ?>
        </div>

        <div class="flex flex-wrap items-center gap-2">
          <!-- Filter Rombel Dropdown (Tampil saat tab siswa aktif) -->
          <div id="rombelFilterContainer" class="hidden">
            <select id="rombelSelect" onchange="filterUserList()" class="pl-3 pr-7 py-2 bg-slate-50 border border-slate-200 rounded-xl text-xs text-slate-700 font-bold focus:bg-white focus:outline-none focus:ring-2 focus:ring-blue-500 cursor-pointer">
              <option value="">Semua Rombel / Kelas</option>
              <?php foreach ($classList as $cls): ?>
                <option value="<?= strtolower(esc($cls)) ?>">Kelas <?= esc($cls) ?> (<?= count($siswaByClass[$cls] ?? []) ?> Siswa)</option>
              <?php endforeach; ?>
            </select>
          </div>

          <div class="relative w-full sm:w-60">
            <i class="fa-solid fa-magnifying-glass absolute left-3.5 top-3 text-slate-400 text-xs"></i>
            <input type="text" id="searchUserBox" onkeyup="filterUserList()" placeholder="Cari nama, NIS, email..." class="w-full pl-9 pr-4 py-2 bg-slate-50 border border-slate-200 rounded-xl text-xs text-slate-800 focus:bg-white focus:outline-none focus:ring-2 focus:ring-blue-500">
          </div>
        </div>
      </div>

      <!-- Quick Rombel / Kelas Selector Bar (Tampil saat tab siswa aktif) -->
      <div id="rombelPillsBar" class="hidden mb-5 p-3 bg-slate-50/80 rounded-2xl border border-slate-200/80">
        <div class="flex flex-wrap items-center justify-between gap-2 mb-2">
          <span class="text-[11px] font-extrabold uppercase tracking-wider text-slate-500 flex items-center gap-1.5">
            <i class="fa-solid fa-layer-group text-blue-600"></i>
            <span>Daftar Rombel / Kelas Terdaftar (<?= count($classList) ?> Kelas)</span>
          </span>
          <button type="button" onclick="openTambahKelasModal()" class="text-[11px] font-bold text-blue-600 hover:text-blue-800 flex items-center gap-1 transition">
            <i class="fa-solid fa-circle-plus"></i>
            <span>Tambah Kelas Baru</span>
          </button>
        </div>
        <div class="flex flex-wrap items-center gap-1.5" id="rombelPillsContainer">
          <button type="button" onclick="selectRombelPill('')" data-rombel="" class="rombel-pill px-3 py-1 rounded-lg text-xs font-bold transition bg-blue-600 text-white shadow-xs">
            Semua Kelas
          </button>
          <?php foreach ($classList as $cls): ?>
            <button type="button" onclick="selectRombelPill('<?= strtolower(esc($cls, 'js')) ?>')" data-rombel="<?= strtolower(esc($cls)) ?>" class="rombel-pill px-3 py-1 rounded-lg text-xs font-semibold bg-white border border-slate-200 text-slate-700 hover:border-blue-400 hover:text-blue-600 transition flex items-center gap-1.5">
              <span>Kelas <?= esc($cls) ?></span>
              <span class="px-1.5 py-0.5 bg-slate-100 text-slate-600 text-[10px] font-bold rounded-md"><?= count($siswaByClass[$cls] ?? []) ?></span>
            </button>
          <?php endforeach; ?>
        </div>
      </div>

      <!-- Tab Content 1: Guru Table -->
      <div id="tabContentGURU" class="block">
        <div class="overflow-x-auto">
          <table class="w-full text-left text-xs">
            <thead>
              <tr class="bg-slate-50 text-slate-400 uppercase text-[10px] font-extrabold tracking-wider border-b border-slate-100">
                <th class="p-3.5 pl-4">Guru Pendidik</th>
                <th class="p-3.5">NIP / ID</th>
                <th class="p-3.5">Mata Pelajaran</th>
                <th class="p-3.5">Kelas yang Diajar</th>
                <th class="p-3.5">Email Akun</th>
                <th class="p-3.5 text-right pr-4">Aksi</th>
              </tr>
            </thead>
            <tbody id="guruTableBody" class="divide-y divide-slate-100">
              <?php if (empty($guru)): ?>
                <tr>
                  <td colspan="6" class="text-center py-8 text-slate-400 text-xs italic">
                    Belum ada guru terdaftar. Klik tombol Tambah Akun Baru di atas.
                  </td>
                </tr>
              <?php else: ?>
                <?php foreach ($guru as $g): ?>
                  <tr class="hover:bg-slate-50/70 transition user-row">
                    <td class="p-3.5 pl-4">
                      <div class="flex items-center gap-2.5">
                        <div class="w-8 h-8 rounded-full bg-indigo-100 text-indigo-700 flex items-center justify-center font-bold text-xs shrink-0">
                          <?= strtoupper(substr($g['nama'], 0, 1)) ?>
                        </div>
                        <span class="font-bold text-slate-800 text-xs"><?= esc($g['nama']) ?></span>
                      </div>
                    </td>
                    <td class="p-3.5 font-semibold text-slate-600">
                      <?= esc($g['nis'] ?: '-') ?>
                    </td>
                    <td class="p-3.5">
                      <span class="px-2.5 py-0.5 rounded-lg text-[10px] font-extrabold bg-emerald-50 text-emerald-700 border border-emerald-100">
                        <?= esc($g['mapel'] ?: 'Umum') ?>
                      </span>
                    </td>
                    <td class="p-3.5 font-semibold text-slate-700 text-[11px]">
                      <?= esc($g['kelas_diajar'] ?: 'Semua') ?>
                    </td>
                    <td class="p-3.5 text-slate-500 font-mono text-[11px]">
                      <?= esc($g['email']) ?>
                    </td>
                    <td class="p-3.5 text-right pr-4">
                      <div class="flex items-center justify-end gap-1.5">
                        <button type="button" onclick="openResetPasswordModal('<?= esc($g['id']) ?>', '<?= esc($g['nama'], 'js') ?>')" class="inline-flex items-center gap-1 px-2.5 py-1 rounded-lg text-amber-600 bg-amber-50 hover:bg-amber-100 text-[11px] font-bold transition" title="Reset Password">
                          <i class="fa-solid fa-key text-[10px]"></i>
                          <span>Reset</span>
                        </button>
                        <form action="<?= site_url('admin/users/delete') ?>" method="post" onsubmit="return confirm('Apakah Anda yakin ingin menghapus akun guru <?= esc($g['nama']) ?>? Seluruh materi & tugas guru ini akan terhapus.')" class="inline">
                          <?= csrf_field() ?>
                          <input type="hidden" name="user_id" value="<?= esc($g['id']) ?>">
                          <button type="submit" class="inline-flex items-center gap-1 px-2.5 py-1 rounded-lg text-red-500 bg-red-50 hover:bg-red-100 text-[11px] font-bold transition" title="Hapus Akun">
                            <i class="fa-regular fa-trash-can text-[10px]"></i>
                            <span>Hapus</span>
                          </button>
                        </form>
                      </div>
                    </td>
                  </tr>
                <?php endforeach; ?>
              <?php endif; ?>
            </tbody>
          </table>
        </div>
      </div>

      <!-- Tab Content 2: Siswa Kelas VII -->
      <div id="tabContentVII" class="hidden">
        <?php $renderSiswaTable($siswaVII, 'siswaVIITableBody', 'Kelas VII', 'emerald'); ?>
      </div>

      <!-- Tab Content 3: Siswa Kelas VIII -->
      <div id="tabContentVIII" class="hidden">
        <?php $renderSiswaTable($siswaVIII, 'siswaVIIITableBody', 'Kelas VIII', 'blue'); ?>
      </div>

      <!-- Tab Content 4: Siswa Kelas IX -->
      <div id="tabContentIX" class="hidden">
        <?php $renderSiswaTable($siswaIX, 'siswaIXTableBody', 'Kelas IX', 'purple'); ?>
      </div>

      <?php if (!empty($siswaLain)): ?>
      <!-- Tab Content 5: Siswa Lainnya -->
      <div id="tabContentLAIN" class="hidden">
        <?php $renderSiswaTable($siswaLain, 'siswaLainTableBody', 'Lainnya', 'blue'); ?>
      </div>
      <?php endif; ?>
    </div>
  </main>

  <!-- Modal Tambah Akun Baru -->
  <div id="modalTambahUser" class="fixed inset-0 bg-slate-900/60 backdrop-blur-sm z-50 flex items-center justify-center p-4 hidden">
    <div class="bg-white rounded-3xl max-w-lg w-full p-6 shadow-2xl border border-slate-100 relative">
      <div class="flex items-center justify-between mb-4 pb-3 border-b border-slate-100">
        <div class="flex items-center gap-2.5">
          <div class="w-8 h-8 rounded-xl bg-blue-50 text-blue-600 flex items-center justify-center text-sm font-bold">
            <i class="fa-solid fa-user-plus"></i>
          </div>
          <div>
            <h3 class="font-extrabold text-sm text-slate-800">Tambah Akun Pengguna Baru</h3>
            <p class="text-[11px] text-slate-400">Buat akun untuk Guru Pendidik atau Siswa Peserta Didik.</p>
          </div>
        </div>
        <button type="button" onclick="document.getElementById('modalTambahUser').classList.add('hidden')" class="text-slate-400 hover:text-slate-600 text-sm">
          <i class="fa-solid fa-xmark"></i>
        </button>
      </div>

      <form action="<?= site_url('admin/users/save') ?>" method="post" class="space-y-4">
        <?= csrf_field() ?>

        <div class="grid grid-cols-2 gap-3">
          <div>
            <label class="block text-[11px] font-bold uppercase text-slate-500 mb-1.5">Peran / Role *</label>
            <select name="role" id="roleSelector" onchange="toggleRoleFields()" required class="w-full rounded-xl border border-slate-200 px-3 py-2 text-xs bg-slate-50 focus:bg-white focus:outline-none focus:ring-2 focus:ring-blue-500 font-bold text-slate-700">
              <option value="siswa" selected>Siswa (Peserta Didik)</option>
              <option value="guru">Guru (Pendidik)</option>
            </select>
          </div>
          <div>
            <label class="block text-[11px] font-bold uppercase text-slate-500 mb-1.5" id="nisLabel">NIS Siswa (Opsional)</label>
            <input name="nis" id="inputNis" type="text" placeholder="Boleh dikosongkan" class="w-full rounded-xl border border-slate-200 px-3 py-2 text-xs bg-slate-50 focus:bg-white focus:outline-none focus:ring-2 focus:ring-blue-500">
          </div>
        </div>

        <div>
          <label class="block text-[11px] font-bold uppercase text-slate-500 mb-1.5">Nama Lengkap *</label>
          <input name="nama" id="inputNama" type="text" required placeholder="Contoh: Muhammad Dzakwan" oninput="autoSuggestEmail()" class="w-full rounded-xl border border-slate-200 px-3 py-2 text-xs bg-slate-50 focus:bg-white focus:outline-none focus:ring-2 focus:ring-blue-500">
        </div>

        <div>
          <label class="block text-[11px] font-bold uppercase text-slate-500 mb-1.5">
            Alamat Email <span id="emailHint" class="text-[10px] text-blue-600 font-normal lowercase">(otomatis @roomlearning.sch.id jika kosong)</span>
          </label>
          <input name="email" id="inputEmail" type="text" placeholder="nama@roomlearning.sch.id" class="w-full rounded-xl border border-slate-200 px-3 py-2 text-xs bg-slate-50 focus:bg-white focus:outline-none focus:ring-2 focus:ring-blue-500">
        </div>

        <!-- Khusus Siswa: Kelas / Rombel Bebas / Pilih -->
        <div id="kelasFieldGroup">
          <label class="block text-[11px] font-bold uppercase text-slate-500 mb-1.5">Kelas / Rombel (Siswa) *</label>
          <input list="listKelasDatalist" name="kelas" id="inputKelas" placeholder="Ketik atau pilih kelas (contoh: VII-A, VIII-B, IX-A)" class="w-full rounded-xl border border-slate-200 px-3 py-2 text-xs bg-slate-50 focus:bg-white focus:outline-none focus:ring-2 focus:ring-blue-500 font-semibold text-slate-700">
          <datalist id="listKelasDatalist">
            <?php foreach ($classList as $cls): ?>
              <option value="<?= esc($cls) ?>">Kelas <?= esc($cls) ?></option>
            <?php endforeach; ?>
            <option value="VII-A">VII-A</option>
            <option value="VII-B">VII-B</option>
            <option value="VIII-A">VIII-A</option>
            <option value="VIII-B">VIII-B</option>
            <option value="IX-A">IX-A</option>
            <option value="IX-B">IX-B</option>
          </datalist>
          <p class="text-[10px] text-slate-400 mt-1">Bisa ketik nama kelas baru bebas, sistem otomatis mencatat kelas tersebut.</p>
        </div>

        <div>
          <label class="block text-[11px] font-bold uppercase text-slate-500 mb-1.5">
            Kata Sandi <span id="pwdHint" class="text-[10px] text-slate-400 font-normal lowercase">(default: siswa123 jika kosong)</span>
          </label>
          <input name="password" id="inputPassword" type="password" placeholder="Kosongkan jika memakai default siswa123" class="w-full rounded-xl border border-slate-200 px-3 py-2 text-xs bg-slate-50 focus:bg-white focus:outline-none focus:ring-2 focus:ring-blue-500">
        </div>

        <div class="pt-2 flex items-center justify-end gap-2 border-t border-slate-100">
          <button type="button" onclick="document.getElementById('modalTambahUser').classList.add('hidden')" class="px-4 py-2 rounded-xl border border-slate-200 text-xs font-bold text-slate-600 hover:bg-slate-50 transition">
            Batal
          </button>
          <button type="submit" class="px-4 py-2 rounded-xl bg-blue-600 hover:bg-blue-700 text-xs font-bold text-white shadow-sm transition">
            Simpan Akun
          </button>
        </div>
      </form>
    </div>
  </div>

  <!-- Modal Import Siswa Batch -->
  <div id="modalImportSiswa" class="fixed inset-0 bg-slate-900/60 backdrop-blur-sm z-50 flex items-center justify-center p-4 hidden">
    <div class="bg-white rounded-3xl max-w-xl w-full p-6 shadow-2xl border border-slate-100 relative max-h-[92vh] overflow-y-auto custom-scroll">
      <div class="flex items-center justify-between mb-4 pb-3 border-b border-slate-100">
        <div class="flex items-center gap-2.5">
          <div class="w-9 h-9 rounded-xl bg-emerald-50 text-emerald-600 flex items-center justify-center text-base font-bold">
            <i class="fa-solid fa-file-arrow-up"></i>
          </div>
          <div>
            <h3 class="font-extrabold text-sm text-slate-800">Import Daftar Siswa & Buat Akun Otomatis</h3>
            <p class="text-[11px] text-slate-400">Otomatis buat email @roomlearning.sch.id & kata sandi default.</p>
          </div>
        </div>
        <button type="button" onclick="document.getElementById('modalImportSiswa').classList.add('hidden')" class="text-slate-400 hover:text-slate-600 text-sm">
          <i class="fa-solid fa-xmark"></i>
        </button>
      </div>

      <!-- Info Banner Otomatisasi -->
      <div class="mb-5 bg-gradient-to-r from-emerald-50 to-teal-50 border border-emerald-200/80 rounded-2xl p-3.5 text-xs text-slate-700 space-y-1.5">
        <div class="flex items-center gap-2 text-emerald-800 font-extrabold text-xs">
          <i class="fa-solid fa-wand-magic-sparkles text-emerald-600"></i>
          <span>Pembuatan Akun Otomatis & Cepat</span>
        </div>
        <ul class="text-[11px] text-slate-600 list-disc list-inside space-y-0.5">
          <li>Cukup sediakan <b>Nama Siswa</b> dan <b>Kelas</b> (NIS/NISN <b>tidak perlu</b> diisi).</li>
          <li>Email otomatis dibuat: <b>nama@roomlearning.sch.id</b> (nama dibersihkan dari spasi/karakter khusus).</li>
          <li>Kata sandi awal otomatis diatur menjadi <b>siswa123</b> (bisa disesuaikan di bawah).</li>
        </ul>
      </div>

      <form action="<?= site_url('admin/users/import') ?>" method="post" enctype="multipart/form-data" class="space-y-4">
        <?= csrf_field() ?>

        <!-- Metode 1: Upload File CSV -->
        <div class="p-4 bg-slate-50/70 border border-slate-200/80 rounded-2xl">
          <div class="flex items-center justify-between mb-2">
            <label class="block text-[11px] font-bold uppercase text-slate-700">
              <i class="fa-solid fa-file-csv text-emerald-600 mr-1"></i> Metode 1: Unggah File CSV
            </label>
            <a href="<?= site_url('admin/users/template') ?>" class="text-[11px] font-bold text-emerald-600 hover:text-emerald-800 inline-flex items-center gap-1 transition">
              <i class="fa-solid fa-download"></i>
              <span>Download Contoh Format CSV</span>
            </a>
          </div>
          <input type="file" name="file_siswa" accept=".csv, .txt" class="block w-full text-xs text-slate-500 file:mr-3 file:py-2 file:px-3 file:rounded-xl file:border-0 file:text-xs file:font-bold file:bg-emerald-100 file:text-emerald-700 hover:file:bg-emerald-200 border border-slate-200 rounded-xl p-1 bg-white cursor-pointer">
          <p class="text-[10px] text-slate-400 mt-1.5">File CSV dengan header baris pertama: <code>Nama, Kelas</code></p>
        </div>

        <div class="relative flex py-1 items-center">
          <div class="flex-grow border-t border-slate-200"></div>
          <span class="flex-shrink mx-3 text-slate-400 text-[10px] font-extrabold uppercase tracking-wider">ATAU TEMPEL LANGSUNG</span>
          <div class="flex-grow border-t border-slate-200"></div>
        </div>

        <!-- Metode 2: Tempel Langsung di Textarea -->
        <div class="p-4 bg-slate-50/70 border border-slate-200/80 rounded-2xl">
          <label class="block text-[11px] font-bold uppercase text-slate-700 mb-1.5">
            <i class="fa-solid fa-paste text-blue-600 mr-1"></i> Metode 2: Ketik / Tempel (Paste) Daftar Siswa
          </label>
          <textarea name="raw_text" rows="5" placeholder="Ahmad Rizky Pratama, VII-A&#10;Budi Santoso, VII-A&#10;Citra Lestari, VII-B&#10;Dewi Anggraeni, VIII-A" class="w-full rounded-xl border border-slate-200 px-3 py-2 text-xs font-mono bg-white focus:outline-none focus:ring-2 focus:ring-emerald-500"></textarea>
          <p class="text-[10px] text-slate-400 mt-1">Satu baris untuk satu siswa. Format: <code>Nama Lengkap Siswa, Kelas</code></p>
        </div>

        <!-- Pengaturan Default Kelas & Password -->
        <div class="grid grid-cols-2 gap-3 pt-2">
          <div>
            <label class="block text-[11px] font-bold uppercase text-slate-500 mb-1.5">Kelas Cadangan (Jika Baris Kosong)</label>
            <input list="listImportKelas" name="default_kelas" placeholder="Contoh: VII-A" class="w-full rounded-xl border border-slate-200 px-3 py-2 text-xs bg-slate-50 focus:bg-white focus:outline-none focus:ring-2 focus:ring-emerald-500 font-semibold text-slate-700">
            <datalist id="listImportKelas">
              <?php foreach ($classList as $cls): ?>
                <option value="<?= esc($cls) ?>">Kelas <?= esc($cls) ?></option>
              <?php endforeach; ?>
            </datalist>
          </div>
          <div>
            <label class="block text-[11px] font-bold uppercase text-slate-500 mb-1.5">Kata Sandi Default</label>
            <input name="default_password" type="text" value="siswa123" class="w-full rounded-xl border border-slate-200 px-3 py-2 text-xs bg-slate-50 focus:bg-white focus:outline-none focus:ring-2 focus:ring-emerald-500 font-mono font-bold text-slate-700">
          </div>
        </div>

        <div class="pt-3 flex items-center justify-end gap-2 border-t border-slate-100">
          <button type="button" onclick="document.getElementById('modalImportSiswa').classList.add('hidden')" class="px-4 py-2 rounded-xl border border-slate-200 text-xs font-bold text-slate-600 hover:bg-slate-50 transition">
            Batal
          </button>
          <button type="submit" class="inline-flex items-center gap-2 px-5 py-2.5 rounded-xl bg-emerald-600 hover:bg-emerald-700 text-xs font-extrabold text-white shadow-md shadow-emerald-200 transition">
            <i class="fa-solid fa-wand-magic-sparkles"></i>
            <span>Mulai Import & Buat Akun</span>
          </button>
        </div>
      </form>
    </div>
  </div>

  <!-- Modal Ubah Password -->
  <div id="modalUbahPassword" class="fixed inset-0 bg-slate-900/60 backdrop-blur-sm z-50 flex items-center justify-center p-4 hidden">
    <div class="bg-white rounded-3xl max-w-md w-full p-6 shadow-2xl border border-slate-100 relative">
      <div class="flex items-center justify-between mb-4 pb-3 border-b border-slate-100">
        <div class="flex items-center gap-2.5">
          <div class="w-8 h-8 rounded-xl bg-amber-50 text-amber-600 flex items-center justify-center text-sm font-bold">
            <i class="fa-solid fa-key"></i>
          </div>
          <div>
            <h3 class="font-extrabold text-sm text-slate-800">Ubah Kata Sandi Akun</h3>
            <p class="text-[11px] text-slate-400">Atur ulang password guru atau siswa.</p>
          </div>
        </div>
        <button type="button" onclick="document.getElementById('modalUbahPassword').classList.add('hidden')" class="text-slate-400 hover:text-slate-600 text-sm">
          <i class="fa-solid fa-xmark"></i>
        </button>
      </div>

      <form action="<?= site_url('admin/users/change-password') ?>" method="post" class="space-y-4">
        <?= csrf_field() ?>

        <div>
          <label class="block text-[11px] font-bold uppercase text-slate-500 mb-1.5">Pilih Pengguna *</label>
          <select name="user_id" id="resetUserIdSelect" required class="w-full rounded-xl border border-slate-200 px-3 py-2 text-xs bg-slate-50 focus:bg-white focus:outline-none focus:ring-2 focus:ring-blue-500 font-semibold text-slate-700">
            <option value="">-- Pilih Akun --</option>
            <optgroup label="Guru Pendidik (<?= count($guru) ?>)">
              <?php foreach ($guru as $g): ?>
                <option value="<?= esc($g['id']) ?>">Guru: <?= esc($g['nama']) ?> (<?= esc($g['email']) ?>)</option>
              <?php endforeach; ?>
            </optgroup>
            <optgroup label="Siswa Kelas VII (<?= count($siswaVII) ?>)">
              <?php foreach ($siswaVII as $s): ?>
                <option value="<?= esc($s['id']) ?>">Siswa VII: <?= esc($s['nama']) ?> (Kelas <?= esc($s['kelas'] ?: 'VII') ?>)</option>
              <?php endforeach; ?>
            </optgroup>
            <optgroup label="Siswa Kelas VIII (<?= count($siswaVIII) ?>)">
              <?php foreach ($siswaVIII as $s): ?>
                <option value="<?= esc($s['id']) ?>">Siswa VIII: <?= esc($s['nama']) ?> (Kelas <?= esc($s['kelas'] ?: 'VIII') ?>)</option>
              <?php endforeach; ?>
            </optgroup>
            <optgroup label="Siswa Kelas IX (<?= count($siswaIX) ?>)">
              <?php foreach ($siswaIX as $s): ?>
                <option value="<?= esc($s['id']) ?>">Siswa IX: <?= esc($s['nama']) ?> (Kelas <?= esc($s['kelas'] ?: 'IX') ?>)</option>
              <?php endforeach; ?>
            </optgroup>
            <?php if (!empty($siswaLain)): ?>
            <optgroup label="Siswa Lainnya (<?= count($siswaLain) ?>)">
              <?php foreach ($siswaLain as $s): ?>
                <option value="<?= esc($s['id']) ?>">Siswa: <?= esc($s['nama']) ?> (Kelas <?= esc($s['kelas'] ?: '-') ?>)</option>
              <?php endforeach; ?>
            </optgroup>
            <?php endif; ?>
          </select>
        </div>

        <div>
          <label class="block text-[11px] font-bold uppercase text-slate-500 mb-1.5">Kata Sandi Baru *</label>
          <input name="new_password" type="password" required placeholder="Ketik kata sandi baru" class="w-full rounded-xl border border-slate-200 px-3 py-2 text-xs bg-slate-50 focus:bg-white focus:outline-none focus:ring-2 focus:ring-blue-500">
        </div>

        <div class="pt-2 flex items-center justify-end gap-2 border-t border-slate-100">
          <button type="button" onclick="document.getElementById('modalUbahPassword').classList.add('hidden')" class="px-4 py-2 rounded-xl border border-slate-200 text-xs font-bold text-slate-600 hover:bg-slate-50 transition">
            Batal
          </button>
          <button type="submit" class="px-4 py-2 rounded-xl bg-amber-600 hover:bg-amber-700 text-xs font-bold text-white shadow-sm transition">
            Perbarui Kata Sandi
          </button>
        </div>
      </form>
    </div>
  </div>

  <!-- Interactive JavaScript -->
  <script>
    function switchUserTab(tab) {
      const tabs = ['guru', 'vii', 'viii', 'ix', 'lain'];
      const rombelContainer = document.getElementById('rombelFilterContainer');
      const rombelPills = document.getElementById('rombelPillsBar');
      
      // Sembunyikan/tampilkan filter rombel jika di tab guru vs siswa
      if (tab === 'guru') {
        if (rombelContainer) rombelContainer.classList.add('hidden');
        if (rombelPills) rombelPills.classList.add('hidden');
      } else {
        if (rombelContainer) rombelContainer.classList.remove('hidden');
        if (rombelPills) rombelPills.classList.remove('hidden');
      }

      tabs.forEach(t => {
        const content = document.getElementById('tabContent' + t.toUpperCase());
        const btn = document.getElementById('tabBtn' + t.toUpperCase());
        if (!content || !btn) return;

        if (t === tab) {
          content.classList.remove('hidden');
          if (t === 'guru') {
            btn.className = 'px-3.5 py-2 rounded-xl text-xs font-extrabold bg-indigo-50 text-indigo-700 transition flex items-center gap-2 border border-indigo-200 shadow-xs';
          } else if (t === 'vii') {
            btn.className = 'px-3.5 py-2 rounded-xl text-xs font-extrabold bg-emerald-50 text-emerald-700 transition flex items-center gap-2 border border-emerald-200 shadow-xs';
          } else if (t === 'viii') {
            btn.className = 'px-3.5 py-2 rounded-xl text-xs font-extrabold bg-blue-50 text-blue-700 transition flex items-center gap-2 border border-blue-200 shadow-xs';
          } else if (t === 'ix') {
            btn.className = 'px-3.5 py-2 rounded-xl text-xs font-extrabold bg-purple-50 text-purple-700 transition flex items-center gap-2 border border-purple-200 shadow-xs';
          } else {
            btn.className = 'px-3.5 py-2 rounded-xl text-xs font-extrabold bg-slate-100 text-slate-800 transition flex items-center gap-2 border border-slate-300 shadow-xs';
          }
        } else {
          content.classList.add('hidden');
          btn.className = 'px-3.5 py-2 rounded-xl text-xs font-semibold text-slate-500 hover:bg-slate-50 transition flex items-center gap-2 border border-transparent';
        }
      });

      filterUserList();
    }

    function selectRombelPill(rombel) {
      const select = document.getElementById('rombelSelect');
      if (select) {
        select.value = rombel;
      }
      
      // Update styling tombol pills
      document.querySelectorAll('.rombel-pill').forEach(btn => {
        const pillRombel = btn.getAttribute('data-rombel') || '';
        if (pillRombel === rombel) {
          btn.className = 'rombel-pill px-3 py-1 rounded-lg text-xs font-bold transition bg-blue-600 text-white shadow-xs';
        } else {
          btn.className = 'rombel-pill px-3 py-1 rounded-lg text-xs font-semibold bg-white border border-slate-200 text-slate-700 hover:border-blue-400 hover:text-blue-600 transition flex items-center gap-1.5';
        }
      });

      filterUserList();
    }

    function openTambahKelasModal() {
      const modal = document.getElementById('modalTambahUser');
      const roleSel = document.getElementById('roleSelector');
      roleSel.value = 'siswa';
      toggleRoleFields();
      modal.classList.remove('hidden');
      setTimeout(() => {
        const inputKelas = document.getElementById('inputKelas');
        if (inputKelas) inputKelas.focus();
      }, 100);
    }

    function autoSuggestEmail() {
      const role = document.getElementById('roleSelector').value;
      if (role !== 'siswa') return;

      const nama = document.getElementById('inputNama').value;
      const emailInput = document.getElementById('inputEmail');
      
      const cleanName = nama.toLowerCase().replace(/[^a-z0-9]/g, '');
      if (cleanName.length > 0) {
        // Hanya otomatis isi jika user belum mengetik email manual kustom
        if (!emailInput.dataset.manualEdited || emailInput.value === '' || emailInput.value.endsWith('@roomlearning.sch.id')) {
          emailInput.value = cleanName + '@roomlearning.sch.id';
        }
      } else {
        if (!emailInput.dataset.manualEdited) {
          emailInput.value = '';
        }
      }
    }

    document.getElementById('inputEmail')?.addEventListener('input', function() {
      this.dataset.manualEdited = 'true';
    });

    function toggleRoleFields() {
      const role = document.getElementById('roleSelector').value;
      const kelasGroup = document.getElementById('kelasFieldGroup');
      const nisLabel = document.getElementById('nisLabel');
      const inputNis = document.getElementById('inputNis');
      const inputEmail = document.getElementById('inputEmail');
      const emailHint = document.getElementById('emailHint');
      const inputPassword = document.getElementById('inputPassword');
      const pwdHint = document.getElementById('pwdHint');

      if (role === 'guru') {
        kelasGroup.classList.add('hidden');
        nisLabel.textContent = 'NIP Guru (Opsional)';
        inputNis.placeholder = 'Contoh: 198501012020121001';
        if (emailHint) emailHint.classList.add('hidden');
        inputEmail.required = true;
        inputEmail.placeholder = 'guru@sekolah.sch.id';
        if (pwdHint) pwdHint.classList.add('hidden');
        inputPassword.required = true;
        inputPassword.placeholder = 'Ketik kata sandi akun guru';
      } else {
        kelasGroup.classList.remove('hidden');
        nisLabel.textContent = 'NIS Siswa (Opsional)';
        inputNis.placeholder = 'Boleh dikosongkan';
        if (emailHint) emailHint.classList.remove('hidden');
        inputEmail.required = false;
        inputEmail.placeholder = 'nama@roomlearning.sch.id';
        if (pwdHint) pwdHint.classList.remove('hidden');
        inputPassword.required = false;
        inputPassword.placeholder = 'Kosongkan jika memakai default siswa123';
      }
    }

    function openResetPasswordModal(userId, userName) {
      const modal = document.getElementById('modalUbahPassword');
      const select = document.getElementById('resetUserIdSelect');
      select.value = userId;
      modal.classList.remove('hidden');
    }

    function filterUserList() {
      const query = document.getElementById('searchUserBox').value.toLowerCase().trim();
      const selectedRombel = (document.getElementById('rombelSelect')?.value || '').toLowerCase().trim();
      
      // Target baris pengguna di dalam tab yang sedang aktif
      const activeTabContent = document.querySelector('[id^="tabContent"]:not(.hidden)');
      if (!activeTabContent) return;

      const rows = activeTabContent.querySelectorAll('.user-row');
      rows.forEach(function (row) {
        const rowKelas = (row.getAttribute('data-kelas') || '').toLowerCase().trim();
        const text = (row.textContent || row.innerText).toLowerCase();

        // Cek filter rombel/kelas
        let rombelMatch = true;
        if (selectedRombel !== '') {
          rombelMatch = (rowKelas === selectedRombel || rowKelas.includes(selectedRombel));
        }

        // Cek pencarian teks
        let textMatch = true;
        if (query !== '') {
          textMatch = (text.indexOf(query) > -1);
        }

        if (rombelMatch && textMatch) {
          row.style.display = '';
        } else {
          row.style.display = 'none';
        }
      });
    }

    // Inisialisasi awal saat halaman dimuat
    document.addEventListener('DOMContentLoaded', function() {
      toggleRoleFields();
    });
  </script>
</body>
</html>

