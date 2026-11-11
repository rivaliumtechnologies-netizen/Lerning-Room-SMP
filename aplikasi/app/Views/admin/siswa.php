<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Data Siswa & Rombel Kelas - Room Learning SMP</title>
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
        <a href="<?= site_url('admin/guru') ?>" class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl text-slate-600 hover:bg-slate-50 hover:text-slate-900 font-semibold text-xs transition">
          <i class="fa-solid fa-chalkboard-user w-4"></i>
          <span>Data Guru</span>
        </a>
        <a href="<?= site_url('admin/siswa') ?>" class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl bg-blue-50 text-blue-600 font-bold text-xs shadow-sm transition">
          <i class="fa-solid fa-user-graduate w-4"></i>
          <span>Data Siswa & Kelas</span>
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
          <a href="<?= site_url('admin/export/guru') ?>" class="flex items-center gap-2.5 px-3 py-2 rounded-xl text-slate-600 hover:bg-indigo-50 hover:text-indigo-700 text-xs font-semibold transition">
            <i class="fa-solid fa-file-excel text-indigo-600 w-3.5"></i>
            <span>Ekspor Data Guru</span>
          </a>
          <a href="<?= site_url('admin/export/siswa') ?>" class="flex items-center gap-2.5 px-3 py-2 rounded-xl text-slate-600 hover:bg-emerald-50 hover:text-emerald-700 text-xs font-semibold transition">
            <i class="fa-solid fa-file-excel text-emerald-600 w-3.5"></i>
            <span>Ekspor Data Siswa</span>
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
        <h1 class="text-2xl font-extrabold text-slate-900 tracking-tight flex items-center gap-2.5">
          <span class="w-8 h-8 rounded-xl bg-emerald-50 text-emerald-600 flex items-center justify-center text-sm font-bold">
            <i class="fa-solid fa-user-graduate"></i>
          </span>
          <span>Data Siswa & Rombel Kelas</span>
        </h1>
        <p class="text-xs text-slate-400 mt-1">Kelola data peserta didik, buat akun massal, pembagian rombel, dan lihat daftar per kelas.</p>
      </div>
      <div class="flex flex-wrap items-center gap-2">
        <a href="<?= site_url('admin/export/siswa') ?>" class="inline-flex items-center gap-2 px-3.5 py-2.5 rounded-xl bg-white border border-slate-200 hover:bg-slate-50 text-slate-700 text-xs font-bold shadow-sm transition">
          <i class="fa-solid fa-file-excel text-emerald-600"></i>
          <span>Ekspor Siswa (CSV)</span>
        </a>
        <button onclick="document.getElementById('modalImportSiswa').classList.remove('hidden')" class="inline-flex items-center gap-2 px-4 py-2.5 rounded-xl bg-emerald-600 hover:bg-emerald-700 text-white text-xs font-extrabold shadow-sm transition">
          <i class="fa-solid fa-file-arrow-up"></i>
          <span>Import Siswa (Batch Buat Akun)</span>
        </button>
        <button onclick="document.getElementById('modalTambahSiswa').classList.remove('hidden')" class="inline-flex items-center gap-2 px-4 py-2.5 rounded-xl bg-blue-600 hover:bg-blue-700 text-white text-xs font-extrabold shadow-sm transition">
          <i class="fa-solid fa-user-plus"></i>
          <span>Tambah Siswa Baru</span>
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

    <!-- Stat Cards Overview: Total Siswa, Kelas VII, VIII, IX -->
    <div class="grid grid-cols-2 sm:grid-cols-4 gap-4 mb-6">
      <div class="bg-white p-4 rounded-2xl border border-slate-100 shadow-sm flex items-center gap-3 cursor-pointer hover:border-slate-300 transition" onclick="switchSiswaTab('semua')">
        <div class="w-10 h-10 rounded-xl bg-slate-100 text-slate-700 flex items-center justify-center text-sm font-bold shrink-0">
          <i class="fa-solid fa-users"></i>
        </div>
        <div>
          <span class="text-[10px] font-bold uppercase tracking-wider text-slate-400 block">Total Siswa Aktif</span>
          <h3 class="text-xl font-extrabold text-slate-800"><?= count($siswa) ?> Siswa</h3>
        </div>
      </div>

      <div class="bg-white p-4 rounded-2xl border border-slate-100 shadow-sm flex items-center gap-3 cursor-pointer hover:border-emerald-300 transition" onclick="switchSiswaTab('vii')">
        <div class="w-10 h-10 rounded-xl bg-emerald-50 text-emerald-600 flex items-center justify-center text-sm font-bold shrink-0">
          <i class="fa-solid fa-user-graduate"></i>
        </div>
        <div>
          <span class="text-[10px] font-bold uppercase tracking-wider text-slate-400 block">Siswa Kelas VII</span>
          <h3 class="text-xl font-extrabold text-slate-800"><?= count($siswaVII) ?> Siswa</h3>
        </div>
      </div>

      <div class="bg-white p-4 rounded-2xl border border-slate-100 shadow-sm flex items-center gap-3 cursor-pointer hover:border-blue-300 transition" onclick="switchSiswaTab('viii')">
        <div class="w-10 h-10 rounded-xl bg-blue-50 text-blue-600 flex items-center justify-center text-sm font-bold shrink-0">
          <i class="fa-solid fa-user-graduate"></i>
        </div>
        <div>
          <span class="text-[10px] font-bold uppercase tracking-wider text-slate-400 block">Siswa Kelas VIII</span>
          <h3 class="text-xl font-extrabold text-slate-800"><?= count($siswaVIII) ?> Siswa</h3>
        </div>
      </div>

      <div class="bg-white p-4 rounded-2xl border border-slate-100 shadow-sm flex items-center gap-3 cursor-pointer hover:border-purple-300 transition" onclick="switchSiswaTab('ix')">
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
      <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-5 pb-4 border-b border-slate-100">
        <div class="flex flex-wrap items-center gap-2">
          <!-- Tab Semua -->
          <button id="tabBtnSEMUA" onclick="switchSiswaTab('semua')" class="px-3.5 py-2 rounded-xl text-xs font-extrabold bg-blue-50 text-blue-700 transition flex items-center gap-2 border border-blue-200 shadow-xs">
            <i class="fa-solid fa-users"></i>
            <span>Semua Siswa (<?= count($siswa) ?>)</span>
          </button>

          <!-- Tab Kelas VII -->
          <button id="tabBtnVII" onclick="switchSiswaTab('vii')" class="px-3.5 py-2 rounded-xl text-xs font-semibold text-slate-500 hover:bg-slate-50 transition flex items-center gap-2 border border-transparent">
            <i class="fa-solid fa-user-graduate text-emerald-600"></i>
            <span>Kelas VII (<?= count($siswaVII) ?>)</span>
          </button>

          <!-- Tab Kelas VIII -->
          <button id="tabBtnVIII" onclick="switchSiswaTab('viii')" class="px-3.5 py-2 rounded-xl text-xs font-semibold text-slate-500 hover:bg-slate-50 transition flex items-center gap-2 border border-transparent">
            <i class="fa-solid fa-user-graduate text-blue-600"></i>
            <span>Kelas VIII (<?= count($siswaVIII) ?>)</span>
          </button>

          <!-- Tab Kelas IX -->
          <button id="tabBtnIX" onclick="switchSiswaTab('ix')" class="px-3.5 py-2 rounded-xl text-xs font-semibold text-slate-500 hover:bg-slate-50 transition flex items-center gap-2 border border-transparent">
            <i class="fa-solid fa-user-graduate text-purple-600"></i>
            <span>Kelas IX (<?= count($siswaIX) ?>)</span>
          </button>

          <?php if (!empty($siswaLain)): ?>
          <!-- Tab Lainnya -->
          <button id="tabBtnLAIN" onclick="switchSiswaTab('lain')" class="px-3.5 py-2 rounded-xl text-xs font-semibold text-slate-500 hover:bg-slate-50 transition flex items-center gap-2 border border-transparent">
            <i class="fa-solid fa-folder text-slate-400"></i>
            <span>Lainnya (<?= count($siswaLain) ?>)</span>
          </button>
          <?php endif; ?>
        </div>

        <div class="flex flex-wrap items-center gap-2">
          <!-- Filter Rombel Dropdown -->
          <div class="relative">
            <select id="rombelSelect" onchange="selectRombelPill(this.value)" class="pl-3 pr-7 py-2 bg-slate-50 border border-slate-200 rounded-xl text-xs text-slate-700 font-bold focus:bg-white focus:outline-none focus:ring-2 focus:ring-blue-500 cursor-pointer">
              <option value="">Semua Rombel (<?= count($classList) ?> Kelas)</option>
              <?php if (!empty($classesByGrade['VII'])): ?>
                <optgroup label="Kelas VII (7A - 7G)">
                  <?php foreach ($classesByGrade['VII'] as $cls): ?>
                    <option value="<?= strtolower(esc($cls)) ?>">Kelas <?= esc($cls) ?> (<?= count($siswaByClass[$cls] ?? []) ?> Siswa)</option>
                  <?php endforeach; ?>
                </optgroup>
              <?php endif; ?>
              <?php if (!empty($classesByGrade['VIII'])): ?>
                <optgroup label="Kelas VIII (8A - 8G)">
                  <?php foreach ($classesByGrade['VIII'] as $cls): ?>
                    <option value="<?= strtolower(esc($cls)) ?>">Kelas <?= esc($cls) ?> (<?= count($siswaByClass[$cls] ?? []) ?> Siswa)</option>
                  <?php endforeach; ?>
                </optgroup>
              <?php endif; ?>
              <?php if (!empty($classesByGrade['IX'])): ?>
                <optgroup label="Kelas IX (9A - 9G)">
                  <?php foreach ($classesByGrade['IX'] as $cls): ?>
                    <option value="<?= strtolower(esc($cls)) ?>">Kelas <?= esc($cls) ?> (<?= count($siswaByClass[$cls] ?? []) ?> Siswa)</option>
                  <?php endforeach; ?>
                </optgroup>
              <?php endif; ?>
              <?php if (!empty($classesByGrade['LAIN'])): ?>
                <optgroup label="Kelas Lainnya">
                  <?php foreach ($classesByGrade['LAIN'] as $cls): ?>
                    <option value="<?= strtolower(esc($cls)) ?>">Kelas <?= esc($cls) ?> (<?= count($siswaByClass[$cls] ?? []) ?> Siswa)</option>
                  <?php endforeach; ?>
                </optgroup>
              <?php endif; ?>
            </select>
          </div>

          <div class="relative w-full sm:w-60">
            <i class="fa-solid fa-magnifying-glass absolute left-3.5 top-3 text-slate-400 text-xs"></i>
            <input type="text" id="searchSiswaBox" onkeyup="filterSiswaList()" placeholder="Cari nama, kelas, email..." class="w-full pl-9 pr-4 py-2 bg-slate-50 border border-slate-200 rounded-xl text-xs text-slate-800 focus:bg-white focus:outline-none focus:ring-2 focus:ring-blue-500">
          </div>
        </div>
      </div>

      <!-- Quick Rombel / Kelas Selector Bar: Terbagi Rapi Kelas 7, 8, 9 -->
      <div id="rombelPillsBar" class="mb-6 p-4 bg-slate-50/90 rounded-2xl border border-slate-200/90 space-y-3">
        <div class="flex flex-wrap items-center justify-between gap-2 pb-2.5 border-b border-slate-200/70">
          <div class="flex items-center gap-2">
            <span class="text-xs font-extrabold text-slate-800 flex items-center gap-1.5">
              <i class="fa-solid fa-layer-group text-blue-600"></i>
              <span>Daftar Rombel / Kelas Terdaftar</span>
            </span>
            <span class="text-[11px] font-bold text-slate-500 bg-white px-2 py-0.5 rounded-md border border-slate-200">
              Total <?= count($classList) ?> Kelas
            </span>
          </div>
          <div class="flex items-center gap-2">
            <button type="button" onclick="selectRombelPill('')" data-rombel="" class="rombel-pill px-3 py-1 rounded-lg text-xs font-bold transition bg-slate-800 text-white shadow-xs">
              Semua Kelas
            </button>
            <button type="button" onclick="openTambahKelasModal()" class="text-xs font-bold text-blue-600 hover:text-blue-800 flex items-center gap-1 bg-white px-3 py-1 rounded-lg border border-blue-200 hover:border-blue-400 transition shadow-xs">
              <i class="fa-solid fa-circle-plus"></i>
              <span>Tambah Siswa / Kelas</span>
            </button>
          </div>
        </div>

        <!-- Baris Kelas VII (7A - 7G) -->
        <div class="flex flex-col sm:flex-row sm:items-center gap-2">
          <div class="w-36 shrink-0 flex items-center">
            <button type="button" onclick="switchSiswaTab('vii')" class="w-full px-2.5 py-1 rounded-lg bg-emerald-50 hover:bg-emerald-100 text-emerald-800 border border-emerald-200/80 text-[11px] font-extrabold flex items-center justify-between transition group">
              <span class="flex items-center gap-1.5">
                <i class="fa-solid fa-user-graduate text-emerald-600"></i>
                <span>Kelas VII</span>
              </span>
              <span class="text-[10px] font-bold px-1.5 py-0.2 bg-emerald-200/70 text-emerald-800 rounded">
                <?= count($siswaVII) ?> Siswa
              </span>
            </button>
          </div>
          <div class="flex flex-wrap items-center gap-1.5 flex-1">
            <?php foreach (($classesByGrade['VII'] ?? []) as $cls): ?>
              <?php $cnt = count($siswaByClass[$cls] ?? []); ?>
              <button type="button" onclick="selectRombelPill('<?= strtolower(esc($cls, 'js')) ?>')" data-rombel="<?= strtolower(esc($cls)) ?>" class="rombel-pill px-2.5 py-1 rounded-lg text-xs font-semibold bg-white border border-slate-200 text-slate-700 hover:border-emerald-400 hover:text-emerald-700 transition flex items-center gap-1.5 shadow-2xs">
                <span><?= esc($cls) ?></span>
                <span class="px-1.5 py-0.2 rounded text-[10px] font-bold <?= $cnt > 0 ? 'bg-emerald-50 text-emerald-700 border border-emerald-200/60' : 'bg-slate-100 text-slate-400' ?>">
                  <?= $cnt ?>
                </span>
              </button>
            <?php endforeach; ?>
          </div>
        </div>

        <!-- Baris Kelas VIII (8A - 8G) -->
        <div class="flex flex-col sm:flex-row sm:items-center gap-2">
          <div class="w-36 shrink-0 flex items-center">
            <button type="button" onclick="switchSiswaTab('viii')" class="w-full px-2.5 py-1 rounded-lg bg-blue-50 hover:bg-blue-100 text-blue-800 border border-blue-200/80 text-[11px] font-extrabold flex items-center justify-between transition group">
              <span class="flex items-center gap-1.5">
                <i class="fa-solid fa-user-graduate text-blue-600"></i>
                <span>Kelas VIII</span>
              </span>
              <span class="text-[10px] font-bold px-1.5 py-0.2 bg-blue-200/70 text-blue-800 rounded">
                <?= count($siswaVIII) ?> Siswa
              </span>
            </button>
          </div>
          <div class="flex flex-wrap items-center gap-1.5 flex-1">
            <?php foreach (($classesByGrade['VIII'] ?? []) as $cls): ?>
              <?php $cnt = count($siswaByClass[$cls] ?? []); ?>
              <button type="button" onclick="selectRombelPill('<?= strtolower(esc($cls, 'js')) ?>')" data-rombel="<?= strtolower(esc($cls)) ?>" class="rombel-pill px-2.5 py-1 rounded-lg text-xs font-semibold bg-white border border-slate-200 text-slate-700 hover:border-blue-400 hover:text-blue-700 transition flex items-center gap-1.5 shadow-2xs">
                <span><?= esc($cls) ?></span>
                <span class="px-1.5 py-0.2 rounded text-[10px] font-bold <?= $cnt > 0 ? 'bg-blue-50 text-blue-700 border border-blue-200/60' : 'bg-slate-100 text-slate-400' ?>">
                  <?= $cnt ?>
                </span>
              </button>
            <?php endforeach; ?>
          </div>
        </div>

        <!-- Baris Kelas IX (9A - 9G) -->
        <div class="flex flex-col sm:flex-row sm:items-center gap-2">
          <div class="w-36 shrink-0 flex items-center">
            <button type="button" onclick="switchSiswaTab('ix')" class="w-full px-2.5 py-1 rounded-lg bg-purple-50 hover:bg-purple-100 text-purple-800 border border-purple-200/80 text-[11px] font-extrabold flex items-center justify-between transition group">
              <span class="flex items-center gap-1.5">
                <i class="fa-solid fa-user-graduate text-purple-600"></i>
                <span>Kelas IX</span>
              </span>
              <span class="text-[10px] font-bold px-1.5 py-0.2 bg-purple-200/70 text-purple-800 rounded">
                <?= count($siswaIX) ?> Siswa
              </span>
            </button>
          </div>
          <div class="flex flex-wrap items-center gap-1.5 flex-1">
            <?php foreach (($classesByGrade['IX'] ?? []) as $cls): ?>
              <?php $cnt = count($siswaByClass[$cls] ?? []); ?>
              <button type="button" onclick="selectRombelPill('<?= strtolower(esc($cls, 'js')) ?>')" data-rombel="<?= strtolower(esc($cls)) ?>" class="rombel-pill px-2.5 py-1 rounded-lg text-xs font-semibold bg-white border border-slate-200 text-slate-700 hover:border-purple-400 hover:text-purple-700 transition flex items-center gap-1.5 shadow-2xs">
                <span><?= esc($cls) ?></span>
                <span class="px-1.5 py-0.2 rounded text-[10px] font-bold <?= $cnt > 0 ? 'bg-purple-50 text-purple-700 border border-purple-200/60' : 'bg-slate-100 text-slate-400' ?>">
                  <?= $cnt ?>
                </span>
              </button>
            <?php endforeach; ?>
          </div>
        </div>

        <?php if (!empty($classesByGrade['LAIN'])): ?>
        <!-- Baris Kelas Lainnya -->
        <div class="flex flex-col sm:flex-row sm:items-center gap-2">
          <div class="w-36 shrink-0 flex items-center">
            <button type="button" onclick="switchSiswaTab('lain')" class="w-full px-2.5 py-1 rounded-lg bg-slate-100 hover:bg-slate-200 text-slate-800 border border-slate-300 text-[11px] font-extrabold flex items-center justify-between transition group">
              <span class="flex items-center gap-1.5">
                <i class="fa-solid fa-folder text-slate-500"></i>
                <span>Lainnya</span>
              </span>
              <span class="text-[10px] font-bold px-1.5 py-0.2 bg-slate-200 text-slate-800 rounded">
                <?= count($siswaLain) ?> Siswa
              </span>
            </button>
          </div>
          <div class="flex flex-wrap items-center gap-1.5 flex-1">
            <?php foreach ($classesByGrade['LAIN'] as $cls): ?>
              <?php $cnt = count($siswaByClass[$cls] ?? []); ?>
              <button type="button" onclick="selectRombelPill('<?= strtolower(esc($cls, 'js')) ?>')" data-rombel="<?= strtolower(esc($cls)) ?>" class="rombel-pill px-2.5 py-1 rounded-lg text-xs font-semibold bg-white border border-slate-200 text-slate-700 hover:border-slate-400 hover:text-slate-800 transition flex items-center gap-1.5 shadow-2xs">
                <span><?= esc($cls) ?></span>
                <span class="px-1.5 py-0.2 rounded text-[10px] font-bold <?= $cnt > 0 ? 'bg-slate-200 text-slate-800' : 'bg-slate-100 text-slate-400' ?>">
                  <?= $cnt ?>
                </span>
              </button>
            <?php endforeach; ?>
          </div>
        </div>
        <?php endif; ?>
      </div>

      <!-- Tabel Siswa -->
      <div class="overflow-x-auto">
        <table class="w-full text-left text-xs">
          <thead>
            <tr class="bg-slate-50 text-slate-400 uppercase text-[10px] font-extrabold tracking-wider border-b border-slate-100">
              <th class="p-3.5 pl-4">Peserta Didik</th>
              <th class="p-3.5">NIS</th>
              <th class="p-3.5">Kelas / Rombel</th>
              <th class="p-3.5">Email Akun</th>
              <th class="p-3.5 text-right pr-4">Aksi</th>
            </tr>
          </thead>
          <tbody id="siswaTableBody" class="divide-y divide-slate-100">
            <?php if (empty($siswa)): ?>
              <tr>
                <td colspan="5" class="text-center py-10 text-slate-400 text-xs italic">
                  Belum ada siswa terdaftar. Klik tombol Tambah Siswa Baru atau Import Siswa di atas.
                </td>
              </tr>
            <?php else: ?>
              <?php foreach ($siswa as $s): ?>
                <?php
                  $klsUpper = strtoupper(trim((string)($s['kelas'] ?? '')));
                  $tingkat = 'lain';
                  if (strpos($klsUpper, 'VIII') !== false || strpos($klsUpper, '8') !== false) {
                      $tingkat = 'viii';
                      $badgeStyle = 'bg-blue-50 text-blue-700 border-blue-200';
                      $avatarBg = 'bg-blue-100 text-blue-700';
                  } elseif (strpos($klsUpper, 'VII') !== false || strpos($klsUpper, '7') !== false) {
                      $tingkat = 'vii';
                      $badgeStyle = 'bg-emerald-50 text-emerald-700 border-emerald-200';
                      $avatarBg = 'bg-emerald-100 text-emerald-700';
                  } elseif (strpos($klsUpper, 'IX') !== false || strpos($klsUpper, '9') !== false) {
                      $tingkat = 'ix';
                      $badgeStyle = 'bg-purple-50 text-purple-700 border-purple-200';
                      $avatarBg = 'bg-purple-100 text-purple-700';
                  } else {
                      $badgeStyle = 'bg-slate-100 text-slate-700 border-slate-200';
                      $avatarBg = 'bg-slate-200 text-slate-700';
                  }
                ?>
                <tr class="hover:bg-slate-50/70 transition siswa-row" data-tingkat="<?= $tingkat ?>" data-kelas="<?= strtolower(esc($s['kelas'] ?? '')) ?>">
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
                      <button type="button" onclick='openEditSiswaModal(<?= json_encode($s, JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP) ?>)' class="inline-flex items-center gap-1 px-2.5 py-1 rounded-lg text-blue-600 bg-blue-50 hover:bg-blue-100 text-[11px] font-bold transition" title="Edit Data Siswa">
                        <i class="fa-solid fa-pen-to-square text-[10px]"></i>
                        <span>Edit</span>
                      </button>
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
            <tr id="noResultsRow" class="hidden">
              <td colspan="5" class="text-center py-12 text-slate-400 text-xs">
                <i class="fa-solid fa-users-slash text-3xl mb-2 text-slate-300 block"></i>
                <p class="font-bold text-slate-600">Tidak ada siswa yang sesuai</p>
                <p class="text-[11px] text-slate-400 mt-0.5">Tidak ditemukan data siswa untuk filter kelas atau pencarian ini.</p>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </main>

  <!-- Modal Tambah Siswa Baru -->
  <div id="modalTambahSiswa" class="fixed inset-0 bg-slate-900/60 backdrop-blur-sm z-50 flex items-center justify-center p-4 hidden">
    <div class="bg-white rounded-3xl max-w-lg w-full p-6 shadow-2xl border border-slate-100 relative">
      <div class="flex items-center justify-between mb-4 pb-3 border-b border-slate-100">
        <div class="flex items-center gap-2.5">
          <div class="w-8 h-8 rounded-xl bg-blue-50 text-blue-600 flex items-center justify-center text-sm font-bold">
            <i class="fa-solid fa-user-plus"></i>
          </div>
          <div>
            <h3 class="font-extrabold text-sm text-slate-800">Tambah Akun Siswa Baru</h3>
            <p class="text-[11px] text-slate-400">Email & password akan otomatis dibuat sistem.</p>
          </div>
        </div>
        <button type="button" onclick="document.getElementById('modalTambahSiswa').classList.add('hidden')" class="text-slate-400 hover:text-slate-600 text-sm">
          <i class="fa-solid fa-xmark"></i>
        </button>
      </div>

      <form action="<?= site_url('admin/users/save') ?>" method="post" class="space-y-4">
        <?= csrf_field() ?>
        <input type="hidden" name="role" value="siswa">

        <div class="grid grid-cols-2 gap-3">
          <div>
            <label class="block text-[11px] font-bold uppercase text-slate-500 mb-1.5">Nama Lengkap Siswa *</label>
            <input name="nama" id="inputNama" type="text" required placeholder="Contoh: Muhammad Dzakwan" oninput="autoSuggestEmail()" class="w-full rounded-xl border border-slate-200 px-3 py-2 text-xs bg-slate-50 focus:bg-white focus:outline-none focus:ring-2 focus:ring-blue-500 font-semibold">
          </div>
          <div>
            <label class="block text-[11px] font-bold uppercase text-slate-500 mb-1.5">NIS Siswa (Opsional)</label>
            <input name="nis" type="text" placeholder="Boleh dikosongkan" class="w-full rounded-xl border border-slate-200 px-3 py-2 text-xs bg-slate-50 focus:bg-white focus:outline-none focus:ring-2 focus:ring-blue-500">
          </div>
        </div>

        <div>
          <label class="block text-[11px] font-bold uppercase text-slate-500 mb-1.5">Kelas / Rombel *</label>
          <input list="listKelasDatalist" name="kelas" id="inputKelas" required placeholder="Ketik atau pilih kelas (contoh: VII-A, VIII-B, IX-A)" class="w-full rounded-xl border border-slate-200 px-3 py-2 text-xs bg-slate-50 focus:bg-white focus:outline-none focus:ring-2 focus:ring-blue-500 font-semibold text-slate-700">
          <datalist id="listKelasDatalist">
            <?php foreach ($classList as $cls): ?>
              <option value="<?= esc($cls) ?>">Kelas <?= esc($cls) ?></option>
            <?php endforeach; ?>
          </datalist>
          <p class="text-[10px] text-slate-400 mt-1">Bisa ketik nama kelas baru bebas, sistem otomatis mencatat kelas tersebut.</p>
        </div>

        <div>
          <label class="block text-[11px] font-bold uppercase text-slate-500 mb-1.5">
            Alamat Email <span class="text-[10px] text-blue-600 font-normal lowercase">(otomatis @roomlearning.sch.id jika kosong)</span>
          </label>
          <input name="email" id="inputEmail" type="text" placeholder="nama@roomlearning.sch.id" class="w-full rounded-xl border border-slate-200 px-3 py-2 text-xs bg-slate-50 focus:bg-white focus:outline-none focus:ring-2 focus:ring-blue-500">
        </div>

        <div>
          <label class="block text-[11px] font-bold uppercase text-slate-500 mb-1.5">
            Kata Sandi <span class="text-[10px] text-slate-400 font-normal lowercase">(default: siswa123 jika kosong)</span>
          </label>
          <input name="password" id="inputPassword" type="password" placeholder="Kosongkan jika memakai default siswa123" class="w-full rounded-xl border border-slate-200 px-3 py-2 text-xs bg-slate-50 focus:bg-white focus:outline-none focus:ring-2 focus:ring-blue-500">
        </div>

        <div class="pt-2 flex items-center justify-end gap-2 border-t border-slate-100">
          <button type="button" onclick="document.getElementById('modalTambahSiswa').classList.add('hidden')" class="px-4 py-2 rounded-xl border border-slate-200 text-xs font-bold text-slate-600 hover:bg-slate-50 transition">
            Batal
          </button>
          <button type="submit" class="px-4 py-2 rounded-xl bg-blue-600 hover:bg-blue-700 text-xs font-bold text-white shadow-sm transition">
            Simpan Siswa Baru
          </button>
        </div>
      </form>
    </div>
  </div>

  <!-- Modal Edit Data Siswa -->
  <div id="modalEditSiswa" class="fixed inset-0 bg-slate-900/60 backdrop-blur-sm z-50 flex items-center justify-center p-4 hidden">
    <div class="bg-white rounded-3xl max-w-lg w-full p-6 shadow-2xl border border-slate-100 relative max-h-[92vh] overflow-y-auto custom-scroll">
      <div class="flex items-center justify-between mb-4 pb-3 border-b border-slate-100">
        <div class="flex items-center gap-2.5">
          <div class="w-8 h-8 rounded-xl bg-blue-50 text-blue-600 flex items-center justify-center text-sm font-bold">
            <i class="fa-solid fa-user-pen"></i>
          </div>
          <div>
            <h3 class="font-extrabold text-sm text-slate-800">Edit Data Siswa</h3>
            <p class="text-[11px] text-slate-400">Perbarui nama, rombel kelas, email, dan kata sandi.</p>
          </div>
        </div>
        <button type="button" onclick="document.getElementById('modalEditSiswa').classList.add('hidden')" class="text-slate-400 hover:text-slate-600 text-sm">
          <i class="fa-solid fa-xmark"></i>
        </button>
      </div>

      <form action="<?= site_url('admin/users/save') ?>" method="post" class="space-y-4">
        <?= csrf_field() ?>
        <input type="hidden" name="user_id" id="editSiswaId">
        <input type="hidden" name="role" value="siswa">

        <div>
          <label class="block text-[11px] font-bold uppercase text-slate-500 mb-1.5">Nama Lengkap Siswa *</label>
          <input name="nama" id="editSiswaNama" type="text" required placeholder="Contoh: Ahmad Rizky Pratama" class="w-full rounded-xl border border-slate-200 px-3 py-2 text-xs bg-slate-50 focus:bg-white focus:outline-none focus:ring-2 focus:ring-blue-500 font-semibold text-slate-800">
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
          <div>
            <label class="block text-[11px] font-bold uppercase text-slate-500 mb-1.5">Kelas / Rombel Siswa *</label>
            <input list="listKelasDatalist" name="kelas" id="editSiswaKelas" required placeholder="Pilih atau ketik rombel, contoh: VII-A" class="w-full rounded-xl border border-slate-200 px-3 py-2 text-xs bg-slate-50 focus:bg-white focus:outline-none focus:ring-2 focus:ring-blue-500 font-semibold text-slate-700">
            <p class="text-[10px] text-slate-400 mt-1">Pilih dari 21 kelas standar atau ketik kelas bebas.</p>
          </div>
          <div>
            <label class="block text-[11px] font-bold uppercase text-slate-500 mb-1.5">NIS (Nomor Induk) <span class="text-[10px] text-slate-400 font-normal lowercase">(opsional)</span></label>
            <input name="nis" id="editSiswaNis" type="text" placeholder="Nomor Induk Siswa" class="w-full rounded-xl border border-slate-200 px-3 py-2 text-xs bg-slate-50 focus:bg-white focus:outline-none focus:ring-2 focus:ring-blue-500">
          </div>
        </div>

        <div>
          <label class="block text-[11px] font-bold uppercase text-slate-500 mb-1.5">Alamat Email Akun *</label>
          <input name="email" id="editSiswaEmail" type="email" required placeholder="nama@roomlearning.sch.id" class="w-full rounded-xl border border-slate-200 px-3 py-2 text-xs bg-slate-50 focus:bg-white focus:outline-none focus:ring-2 focus:ring-blue-500 font-mono text-slate-700">
        </div>

        <div class="p-3.5 bg-amber-50/70 border border-amber-200/80 rounded-2xl">
          <label class="block text-[11px] font-bold uppercase text-amber-900 mb-1 flex items-center gap-1.5">
            <i class="fa-solid fa-key text-amber-600"></i>
            <span>Ganti Kata Sandi (Password Baru)</span>
          </label>
          <input name="password" id="editSiswaPassword" type="password" placeholder="Kosongkan jika tidak ingin mengubah kata sandi" class="w-full rounded-xl border border-amber-200 px-3 py-2 text-xs bg-white focus:outline-none focus:ring-2 focus:ring-amber-500">
          <p class="text-[10px] text-amber-700 mt-1">Isi minimal 4 karakter hanya jika ingin mengganti kata sandi siswa ini.</p>
        </div>

        <div class="pt-2 flex items-center justify-end gap-2 border-t border-slate-100">
          <button type="button" onclick="document.getElementById('modalEditSiswa').classList.add('hidden')" class="px-4 py-2 rounded-xl border border-slate-200 text-xs font-bold text-slate-600 hover:bg-slate-50 transition">
            Batal
          </button>
          <button type="submit" class="px-4 py-2 rounded-xl bg-blue-600 hover:bg-blue-700 text-xs font-bold text-white shadow-sm transition">
            Simpan Perubahan
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
            <h3 class="font-extrabold text-sm text-slate-800">Ubah Kata Sandi Siswa</h3>
            <p class="text-[11px] text-slate-400">Atur ulang password siswa yang bersangkutan.</p>
          </div>
        </div>
        <button type="button" onclick="document.getElementById('modalUbahPassword').classList.add('hidden')" class="text-slate-400 hover:text-slate-600 text-sm">
          <i class="fa-solid fa-xmark"></i>
        </button>
      </div>

      <div id="resetPasswordTargetName" class="mb-3.5 p-2.5 bg-amber-50 rounded-xl border border-amber-200 text-xs text-amber-800 font-semibold flex items-center gap-2 hidden">
        <i class="fa-solid fa-user-gear text-amber-600"></i>
        <span>Atur password untuk siswa: <strong id="resetTargetText" class="font-extrabold text-amber-900"></strong></span>
      </div>

      <form action="<?= site_url('admin/users/change-password') ?>" method="post" class="space-y-4">
        <?= csrf_field() ?>
        <div>
          <label class="block text-[11px] font-bold uppercase text-slate-500 mb-1.5">Pilih Siswa *</label>
          <select name="user_id" id="resetUserIdSelect" required class="w-full rounded-xl border border-slate-200 px-3 py-2 text-xs bg-slate-50 focus:bg-white focus:outline-none focus:ring-2 focus:ring-blue-500 font-semibold text-slate-700">
            <option value="">-- Pilih Akun Siswa --</option>
            <?php foreach ($siswa as $s): ?>
              <option value="<?= esc($s['id']) ?>"><?= esc($s['nama']) ?> (Kelas <?= esc($s['kelas'] ?: '-') ?>)</option>
            <?php endforeach; ?>
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

  <script>
    let activeTingkat = 'semua';

    function switchSiswaTab(tingkat, resetRombel = true) {
      activeTingkat = tingkat;
      const tabs = ['semua', 'vii', 'viii', 'ix', 'lain'];

      tabs.forEach(t => {
        const btn = document.getElementById('tabBtn' + t.toUpperCase());
        if (!btn) return;

        if (t === tingkat) {
          if (t === 'semua') {
            btn.className = 'px-3.5 py-2 rounded-xl text-xs font-extrabold bg-blue-50 text-blue-700 transition flex items-center gap-2 border border-blue-200 shadow-xs';
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
          btn.className = 'px-3.5 py-2 rounded-xl text-xs font-semibold text-slate-500 hover:bg-slate-50 transition flex items-center gap-2 border border-transparent';
        }
      });

      if (resetRombel) {
        const select = document.getElementById('rombelSelect');
        if (select) select.value = '';
        updatePillStyles('');
      }

      filterSiswaList();
    }

    function selectRombelPill(rombel) {
      const select = document.getElementById('rombelSelect');
      if (select) {
        select.value = rombel;
      }
      
      // Jika rombel dipilih, pastikan tab yang aktif tidak menyembunyikan kelas tersebut
      if (rombel) {
        if (rombel.indexOf('vii-') === 0 || rombel.indexOf('7') === 0) {
          if (activeTingkat !== 'semua' && activeTingkat !== 'vii') {
            switchSiswaTab('vii', false);
          }
        } else if (rombel.indexOf('viii-') === 0 || rombel.indexOf('8') === 0) {
          if (activeTingkat !== 'semua' && activeTingkat !== 'viii') {
            switchSiswaTab('viii', false);
          }
        } else if (rombel.indexOf('ix-') === 0 || rombel.indexOf('9') === 0) {
          if (activeTingkat !== 'semua' && activeTingkat !== 'ix') {
            switchSiswaTab('ix', false);
          }
        }
      }

      updatePillStyles(rombel);
      filterSiswaList();
    }

    function updatePillStyles(rombel) {
      document.querySelectorAll('.rombel-pill').forEach(btn => {
        const pillRombel = (btn.getAttribute('data-rombel') || '').toLowerCase().trim();
        const isSelected = (pillRombel === (rombel || '').toLowerCase().trim());

        if (isSelected) {
          if (!pillRombel) {
            btn.className = 'rombel-pill px-3 py-1 rounded-lg text-xs font-bold transition bg-slate-800 text-white shadow-xs';
          } else if (pillRombel.indexOf('vii-') === 0 || pillRombel.indexOf('7') === 0) {
            btn.className = 'rombel-pill px-2.5 py-1 rounded-lg text-xs font-bold transition bg-emerald-600 text-white border border-emerald-600 shadow-xs flex items-center gap-1.5';
          } else if (pillRombel.indexOf('viii-') === 0 || pillRombel.indexOf('8') === 0) {
            btn.className = 'rombel-pill px-2.5 py-1 rounded-lg text-xs font-bold transition bg-blue-600 text-white border border-blue-600 shadow-xs flex items-center gap-1.5';
          } else if (pillRombel.indexOf('ix-') === 0 || pillRombel.indexOf('9') === 0) {
            btn.className = 'rombel-pill px-2.5 py-1 rounded-lg text-xs font-bold transition bg-purple-600 text-white border border-purple-600 shadow-xs flex items-center gap-1.5';
          } else {
            btn.className = 'rombel-pill px-2.5 py-1 rounded-lg text-xs font-bold transition bg-slate-700 text-white border border-slate-700 shadow-xs flex items-center gap-1.5';
          }
        } else {
          if (!pillRombel) {
            btn.className = 'rombel-pill px-3 py-1 rounded-lg text-xs font-bold transition bg-white border border-slate-200 text-slate-600 hover:border-slate-300 shadow-2xs';
          } else {
            btn.className = 'rombel-pill px-2.5 py-1 rounded-lg text-xs font-semibold bg-white border border-slate-200 text-slate-700 hover:border-slate-300 transition flex items-center gap-1.5 shadow-2xs';
          }
        }
      });
    }

    function openTambahKelasModal() {
      const modal = document.getElementById('modalTambahSiswa');
      modal.classList.remove('hidden');
      setTimeout(() => {
        const inputKelas = document.getElementById('inputKelas');
        if (inputKelas) inputKelas.focus();
      }, 100);
    }

    function autoSuggestEmail() {
      const nama = document.getElementById('inputNama').value;
      const emailInput = document.getElementById('inputEmail');
      
      const cleanName = nama.toLowerCase().replace(/[^a-z0-9]/g, '');
      if (cleanName.length > 0) {
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

    function openEditSiswaModal(siswa) {
      document.getElementById('editSiswaId').value = siswa.id || '';
      document.getElementById('editSiswaNama').value = siswa.nama || '';
      document.getElementById('editSiswaKelas').value = siswa.kelas || '';
      document.getElementById('editSiswaNis').value = siswa.nis || '';
      document.getElementById('editSiswaEmail').value = siswa.email || '';
      document.getElementById('editSiswaPassword').value = '';

      document.getElementById('modalEditSiswa').classList.remove('hidden');
      setTimeout(() => {
        document.getElementById('editSiswaNama')?.focus();
      }, 100);
    }

    function openResetPasswordModal(userId, userName) {
      const modal = document.getElementById('modalUbahPassword');
      const select = document.getElementById('resetUserIdSelect');
      if (select) select.value = userId;

      const banner = document.getElementById('resetPasswordTargetName');
      const targetText = document.getElementById('resetTargetText');
      if (banner && targetText) {
        if (userName) {
          targetText.textContent = userName;
          banner.classList.remove('hidden');
        } else {
          banner.classList.add('hidden');
        }
      }

      modal.classList.remove('hidden');
    }

    function filterSiswaList() {
      const query = document.getElementById('searchSiswaBox').value.toLowerCase().trim();
      const selectedRombel = (document.getElementById('rombelSelect')?.value || '').toLowerCase().trim();
      const rows = document.querySelectorAll('.siswa-row');
      let visibleCount = 0;

      rows.forEach(function (row) {
        const rowTingkat = row.getAttribute('data-tingkat') || '';
        const rowKelas = (row.getAttribute('data-kelas') || '').toLowerCase().trim();
        const text = (row.textContent || row.innerText).toLowerCase();

        // 1. Cek filter tingkat tab
        let tingkatMatch = (activeTingkat === 'semua' || rowTingkat === activeTingkat);

        // 2. Cek filter rombel/kelas spesifik
        let rombelMatch = true;
        if (selectedRombel !== '') {
          rombelMatch = (rowKelas === selectedRombel || rowKelas.includes(selectedRombel));
        }

        // 3. Cek pencarian teks
        let textMatch = true;
        if (query !== '') {
          textMatch = (text.indexOf(query) > -1);
        }

        if (tingkatMatch && rombelMatch && textMatch) {
          row.style.display = '';
          visibleCount++;
        } else {
          row.style.display = 'none';
        }
      });

      const noResultsRow = document.getElementById('noResultsRow');
      if (noResultsRow) {
        if (rows.length > 0 && visibleCount === 0) {
          noResultsRow.classList.remove('hidden');
        } else {
          noResultsRow.classList.add('hidden');
        }
      }
    }
  </script>
</body>
</html>
