<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Dashboard Admin - Room Learning SMP</title>
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
        <a href="<?= site_url('admin/dashboard') ?>" class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl bg-blue-50 text-blue-600 font-bold text-xs shadow-sm transition">
          <i class="fa-solid fa-house w-4"></i>
          <span>Dashboard</span>
        </a>
        <a href="<?= site_url('admin/guru') ?>" class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl text-slate-600 hover:bg-slate-50 hover:text-slate-900 font-semibold text-xs transition">
          <i class="fa-solid fa-chalkboard-user w-4"></i>
          <span>Data Guru</span>
        </a>
        <a href="<?= site_url('admin/siswa') ?>" class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl text-slate-600 hover:bg-slate-50 hover:text-slate-900 font-semibold text-xs transition">
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
        <h1 class="text-2xl font-extrabold text-slate-900 tracking-tight">Pusat Kendali Administrator</h1>
        <p class="text-xs text-slate-400 mt-1">Kelola seluruh aktivitas akademik, guru, siswa, dan kurikulum Room Learning SMP.</p>
      </div>
      <div class="flex items-center gap-2">
        <span class="inline-flex items-center gap-1.5 text-xs bg-emerald-50 text-emerald-700 border border-emerald-200 px-3.5 py-1.5 rounded-full font-bold shadow-sm">
          <span class="w-2 h-2 rounded-full bg-emerald-500 animate-pulse"></span>
          <span>Sistem Aktif • Kurikulum Merdeka</span>
        </span>
      </div>
    </div>

    <!-- Hero Executive Banner -->
    <div class="relative overflow-hidden rounded-3xl bg-gradient-to-r from-slate-900 via-indigo-950 to-blue-900 text-white p-7 mb-8 shadow-xl shadow-slate-200">
      <div class="relative z-10 flex flex-col lg:flex-row lg:items-center justify-between gap-6">
        <div class="max-w-xl">
          <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-[10px] font-bold uppercase tracking-wider bg-white/10 border border-white/15 text-sky-200 mb-3">
            <i class="fa-solid fa-shield-halved text-[9px]"></i>
            Executive Control Center
          </span>
          <h2 class="text-xl md:text-2xl font-extrabold leading-snug tracking-tight">
            Selamat Datang, <?= esc(session()->get('user_name') ?? 'Administrator') ?>! 👋
          </h2>
          <p class="text-xs text-slate-300 mt-2 leading-relaxed">
            Pantau dan atur seluruh ekosistem pembelajaran digital: kelola akun pendidik & peserta didik, koordinasikan jadwal tatap muka 5 hari sekolah, serta monitor tugas dan modul materi terpadu.
          </p>
        </div>

        <div class="flex flex-wrap sm:flex-nowrap items-center gap-2.5 shrink-0">
          <a href="<?= site_url('admin/siswa') ?>" class="inline-flex items-center gap-2 px-4 py-2.5 rounded-2xl bg-white text-slate-900 hover:bg-slate-100 text-xs font-extrabold shadow-sm transition">
            <i class="fa-solid fa-user-plus text-blue-600"></i>
            <span>Tambah Siswa</span>
          </a>
          <a href="<?= site_url('admin/guru') ?>" class="inline-flex items-center gap-2 px-4 py-2.5 rounded-2xl bg-white/20 hover:bg-white/30 text-white text-xs font-extrabold shadow-sm transition backdrop-blur-xs">
            <i class="fa-solid fa-chalkboard-user"></i>
            <span>Data Guru</span>
          </a>
          <a href="<?= site_url('admin/jadwal') ?>" class="inline-flex items-center gap-2 px-4 py-2.5 rounded-2xl bg-blue-600 hover:bg-blue-500 text-white text-xs font-bold shadow-sm transition">
            <i class="fa-regular fa-calendar-plus"></i>
            <span>Atur Jadwal</span>
          </a>
        </div>
      </div>

      <!-- Decorative Background Glow -->
      <div class="absolute -right-12 -top-12 w-64 h-64 bg-blue-500/20 rounded-full blur-3xl pointer-events-none"></div>
      <div class="absolute right-48 -bottom-16 w-56 h-56 bg-purple-500/20 rounded-full blur-3xl pointer-events-none"></div>
    </div>

    <!-- 6 Primary Stat Cards -->
    <section class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-6 gap-4 mb-8">
      <!-- Guru Card -->
      <a href="<?= site_url('admin/guru') ?>" class="bg-white p-4 rounded-2xl border border-slate-100 shadow-sm hover:shadow-md hover:border-indigo-200 transition group flex flex-col justify-between">
        <div class="flex items-center justify-between mb-2">
          <span class="text-[10px] font-bold uppercase tracking-wider text-slate-400">Total Guru</span>
          <div class="w-8 h-8 rounded-xl bg-indigo-50 text-indigo-600 flex items-center justify-center text-xs group-hover:scale-110 transition">
            <i class="fa-solid fa-chalkboard-user"></i>
          </div>
        </div>
        <div>
          <h3 class="text-2xl font-extrabold text-slate-800 tracking-tight"><?= esc($guruCount) ?></h3>
          <p class="text-[10px] text-slate-400 mt-0.5">Pendidik aktif</p>
        </div>
      </a>

      <!-- Siswa Card -->
      <a href="<?= site_url('admin/siswa') ?>" class="bg-white p-4 rounded-2xl border border-slate-100 shadow-sm hover:shadow-md hover:border-blue-200 transition group flex flex-col justify-between">
        <div class="flex items-center justify-between mb-2">
          <span class="text-[10px] font-bold uppercase tracking-wider text-slate-400">Total Siswa</span>
          <div class="w-8 h-8 rounded-xl bg-blue-50 text-blue-600 flex items-center justify-center text-xs group-hover:scale-110 transition">
            <i class="fa-solid fa-user-group"></i>
          </div>
        </div>
        <div>
          <h3 class="text-2xl font-extrabold text-slate-800 tracking-tight"><?= esc($siswaCount) ?></h3>
          <p class="text-[10px] text-slate-400 mt-0.5">Peserta didik</p>
        </div>
      </a>

      <!-- Jadwal Card -->
      <a href="<?= site_url('admin/jadwal') ?>" class="bg-white p-4 rounded-2xl border border-slate-100 shadow-sm hover:shadow-md hover:border-amber-200 transition group flex flex-col justify-between">
        <div class="flex items-center justify-between mb-2">
          <span class="text-[10px] font-bold uppercase tracking-wider text-slate-400">Jadwal Sesi</span>
          <div class="w-8 h-8 rounded-xl bg-amber-50 text-amber-600 flex items-center justify-center text-xs group-hover:scale-110 transition">
            <i class="fa-regular fa-calendar-check"></i>
          </div>
        </div>
        <div>
          <h3 class="text-2xl font-extrabold text-slate-800 tracking-tight"><?= esc($jadwalCount ?? 0) ?></h3>
          <p class="text-[10px] text-slate-400 mt-0.5">Senin - Jumat</p>
        </div>
      </a>

      <!-- Materi Card -->
      <div class="bg-white p-4 rounded-2xl border border-slate-100 shadow-sm flex flex-col justify-between">
        <div class="flex items-center justify-between mb-2">
          <span class="text-[10px] font-bold uppercase tracking-wider text-slate-400">Materi Ajar</span>
          <div class="w-8 h-8 rounded-xl bg-emerald-50 text-emerald-600 flex items-center justify-center text-xs">
            <i class="fa-regular fa-book-open"></i>
          </div>
        </div>
        <div>
          <h3 class="text-2xl font-extrabold text-slate-800 tracking-tight"><?= esc($materiCount) ?></h3>
          <p class="text-[10px] text-slate-400 mt-0.5">Modul terunggah</p>
        </div>
      </div>

      <!-- Tugas Card -->
      <div class="bg-white p-4 rounded-2xl border border-slate-100 shadow-sm flex flex-col justify-between">
        <div class="flex items-center justify-between mb-2">
          <span class="text-[10px] font-bold uppercase tracking-wider text-slate-400">Tugas Aktif</span>
          <div class="w-8 h-8 rounded-xl bg-purple-50 text-purple-600 flex items-center justify-center text-xs">
            <i class="fa-regular fa-clipboard"></i>
          </div>
        </div>
        <div>
          <h3 class="text-2xl font-extrabold text-slate-800 tracking-tight"><?= esc($tugasCount) ?></h3>
          <p class="text-[10px] text-slate-400 mt-0.5">Penugasan guru</p>
        </div>
      </div>

      <!-- Pengumpulan Card -->
      <div class="bg-white p-4 rounded-2xl border border-slate-100 shadow-sm flex flex-col justify-between">
        <div class="flex items-center justify-between mb-2">
          <span class="text-[10px] font-bold uppercase tracking-wider text-slate-400">Pengumpulan</span>
          <div class="w-8 h-8 rounded-xl bg-rose-50 text-rose-600 flex items-center justify-center text-xs">
            <i class="fa-solid fa-file-circle-check"></i>
          </div>
        </div>
        <div>
          <h3 class="text-2xl font-extrabold text-slate-800 tracking-tight"><?= esc($pengumpulanCount) ?></h3>
          <p class="text-[10px] text-slate-400 mt-0.5">Respons siswa</p>
        </div>
      </div>
    </section>

    <!-- Two-Column Interactive Grid -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-8">
      <!-- Left Column (2 Cols): Student Distribution & Recent Schedules -->
      <div class="lg:col-span-2 space-y-6">
        
        <!-- Distribusi Siswa per Jenjang -->
        <div class="bg-white rounded-3xl border border-slate-100 p-6 shadow-sm">
          <div class="flex items-center justify-between mb-4">
            <div>
              <h2 class="text-sm font-bold text-slate-800">Distribusi Peserta Didik per Tingkatan</h2>
              <p class="text-[11px] text-slate-400">Sebaran siswa aktif pada rombongan belajar Kelas 7, 8, dan 9</p>
            </div>
            <a href="<?= site_url('admin/siswa') ?>" class="text-xs font-bold text-blue-600 hover:text-blue-700 inline-flex items-center gap-1">
              <span>Kelola Siswa</span>
              <i class="fa-solid fa-arrow-right text-[10px]"></i>
            </a>
          </div>

          <?php 
            $tot = max(1, (int)$siswaCount);
            $pVII = round(($siswaVII / $tot) * 100);
            $pVIII = round(($siswaVIII / $tot) * 100);
            $pIX = round(($siswaIX / $tot) * 100);
          ?>

          <div class="space-y-4 pt-2">
            <!-- Kelas VII -->
            <div>
              <div class="flex justify-between items-center text-xs font-bold mb-1.5">
                <span class="flex items-center gap-2 text-slate-700">
                  <span class="w-2.5 h-2.5 rounded-full bg-emerald-500"></span>
                  <span>Kelas 7 (Fase D Awal)</span>
                </span>
                <span class="text-slate-500"><?= esc($siswaVII) ?> Siswa (<?= $pVII ?>%)</span>
              </div>
              <div class="w-full bg-slate-100 rounded-full h-2.5 overflow-hidden">
                <div class="bg-emerald-500 h-2.5 rounded-full transition-all duration-500" style="width: <?= max(4, $pVII) ?>%"></div>
              </div>
            </div>

            <!-- Kelas VIII -->
            <div>
              <div class="flex justify-between items-center text-xs font-bold mb-1.5">
                <span class="flex items-center gap-2 text-slate-700">
                  <span class="w-2.5 h-2.5 rounded-full bg-blue-500"></span>
                  <span>Kelas 8 (Fase D Lanjutan)</span>
                </span>
                <span class="text-slate-500"><?= esc($siswaVIII) ?> Siswa (<?= $pVIII ?>%)</span>
              </div>
              <div class="w-full bg-slate-100 rounded-full h-2.5 overflow-hidden">
                <div class="bg-blue-500 h-2.5 rounded-full transition-all duration-500" style="width: <?= max(4, $pVIII) ?>%"></div>
              </div>
            </div>

            <!-- Kelas IX -->
            <div>
              <div class="flex justify-between items-center text-xs font-bold mb-1.5">
                <span class="flex items-center gap-2 text-slate-700">
                  <span class="w-2.5 h-2.5 rounded-full bg-purple-500"></span>
                  <span>Kelas 9 (Fase D Akhir)</span>
                </span>
                <span class="text-slate-500"><?= esc($siswaIX) ?> Siswa (<?= $pIX ?>%)</span>
              </div>
              <div class="w-full bg-slate-100 rounded-full h-2.5 overflow-hidden">
                <div class="bg-purple-500 h-2.5 rounded-full transition-all duration-500" style="width: <?= max(4, $pIX) ?>%"></div>
              </div>
            </div>
          </div>
        </div>

        <!-- Jadwal Pelajaran Terdaftar -->
        <div class="bg-white rounded-3xl border border-slate-100 p-6 shadow-sm">
          <div class="flex items-center justify-between mb-4">
            <div>
              <h2 class="text-sm font-bold text-slate-800">Jadwal Pembelajaran Terjadwal</h2>
              <p class="text-[11px] text-slate-400">Sesi tatap muka pelajaran aktif di sekolah</p>
            </div>
            <a href="<?= site_url('admin/jadwal') ?>" class="text-xs font-bold text-blue-600 hover:text-blue-700 inline-flex items-center gap-1">
              <span>Semua Jadwal</span>
              <i class="fa-solid fa-arrow-right text-[10px]"></i>
            </a>
          </div>

          <?php if (!empty($recentJadwal)): ?>
            <div class="divide-y divide-slate-100">
              <?php foreach ($recentJadwal as $j): ?>
                <div class="py-3 flex items-center justify-between gap-3">
                  <div class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-xl bg-blue-50 text-blue-700 flex flex-col items-center justify-center font-bold">
                      <span class="text-[9px] uppercase leading-none font-extrabold"><?= substr($j['hari'], 0, 3) ?></span>
                      <span class="text-xs font-black"><?= date('H:i', strtotime($j['jam_mulai'])) ?></span>
                    </div>
                    <div>
                      <div class="flex items-center gap-2">
                        <h4 class="text-xs font-bold text-slate-800"><?= esc($j['mapel']) ?></h4>
                        <span class="px-2 py-0.5 rounded text-[10px] font-extrabold bg-blue-50 text-blue-700"><?= esc($j['kelas']) ?></span>
                      </div>
                      <p class="text-[11px] text-slate-400 mt-0.5">
                        <i class="fa-solid fa-user-tie text-[10px] mr-1"></i><?= esc($j['nama_guru'] ?? 'Guru Pengampu') ?>
                        <?php if (!empty($j['ruangan'])): ?>
                          • <i class="fa-solid fa-location-dot text-[10px] mr-0.5"></i> <?= esc($j['ruangan']) ?>
                        <?php endif; ?>
                      </p>
                    </div>
                  </div>
                  <span class="text-[10px] font-extrabold px-2.5 py-1 bg-slate-100 text-slate-700 rounded-lg">
                    <?= date('H:i', strtotime($j['jam_mulai'])) ?> - <?= date('H:i', strtotime($j['jam_selesai'])) ?>
                  </span>
                </div>
              <?php endforeach; ?>
            </div>
          <?php else: ?>
            <div class="text-center py-6 text-slate-400 text-xs italic">
              Belum ada jadwal pelajaran yang ditentukan.
            </div>
          <?php endif; ?>
        </div>

      </div>

      <!-- Right Column (1 Col): Recent Users & System Card -->
      <div class="space-y-6">
        
        <!-- Pengguna Baru -->
        <div class="bg-white rounded-3xl border border-slate-100 p-6 shadow-sm">
          <div class="flex items-center justify-between mb-4">
            <div>
              <h2 class="text-sm font-bold text-slate-800">Pengguna Terbaru</h2>
              <p class="text-[11px] text-slate-400">Akun yang baru didaftarkan</p>
            </div>
            <a href="<?= site_url('admin/siswa') ?>" class="text-xs font-bold text-blue-600 hover:text-blue-700 inline-flex items-center gap-1">
              <span>Kelola</span>
              <i class="fa-solid fa-arrow-right text-[10px]"></i>
            </a>
          </div>

          <?php if (!empty($recentUsers)): ?>
            <div class="divide-y divide-slate-100">
              <?php foreach ($recentUsers as $u): ?>
                <div class="py-2.5 flex items-center justify-between gap-2">
                  <div class="flex items-center gap-2.5 min-w-0">
                    <div class="w-8 h-8 rounded-full <?= $u['role'] === 'guru' ? 'bg-indigo-50 text-indigo-600' : 'bg-blue-50 text-blue-600' ?> flex items-center justify-center text-xs font-bold shrink-0">
                      <i class="<?= $u['role'] === 'guru' ? 'fa-solid fa-chalkboard-user' : 'fa-solid fa-user-graduate' ?>"></i>
                    </div>
                    <div class="min-w-0">
                      <h4 class="text-xs font-bold text-slate-800 truncate"><?= esc($u['nama']) ?></h4>
                      <p class="text-[10px] text-slate-400 truncate"><?= esc($u['email']) ?></p>
                    </div>
                  </div>
                  <span class="text-[10px] font-bold px-2 py-0.5 rounded-full shrink-0 <?= $u['role'] === 'guru' ? 'bg-indigo-50 text-indigo-700 border border-indigo-100' : 'bg-blue-50 text-blue-700 border border-blue-100' ?>">
                    <?= ucfirst($u['role']) ?>
                  </span>
                </div>
              <?php endforeach; ?>
            </div>
          <?php else: ?>
            <div class="text-center py-6 text-slate-400 text-xs italic">
              Belum ada data user.
            </div>
          <?php endif; ?>
        </div>

        <!-- System & Platform Card -->
        <div class="bg-gradient-to-br from-indigo-50 to-blue-50 rounded-3xl border border-indigo-100 p-6">
          <div class="flex items-center gap-2 text-indigo-900 font-extrabold text-xs mb-3">
            <i class="fa-solid fa-server text-indigo-600"></i>
            <span>Informasi Infrastruktur</span>
          </div>
          <div class="space-y-2 text-xs">
            <div class="flex justify-between items-center text-slate-600">
              <span class="text-[11px]">Framework</span>
              <strong class="font-bold text-slate-900">CodeIgniter 4.7</strong>
            </div>
            <div class="flex justify-between items-center text-slate-600">
              <span class="text-[11px]">Database Engine</span>
              <strong class="font-bold text-slate-900">MySQL 3307</strong>
            </div>
            <div class="flex justify-between items-center text-slate-600">
              <span class="text-[11px]">PHP Engine</span>
              <strong class="font-bold text-slate-900"><?= phpversion() ?></strong>
            </div>
            <div class="flex justify-between items-center text-slate-600">
              <span class="text-[11px]">Hari Belajar</span>
              <strong class="font-bold text-slate-900">Senin - Jumat</strong>
            </div>
          </div>
          <div class="mt-4 pt-3 border-t border-indigo-100/80">
            <a href="<?= site_url('admin/export/users') ?>" class="w-full inline-flex items-center justify-center gap-2 py-2 px-3 rounded-xl bg-white text-indigo-700 hover:bg-indigo-50 border border-indigo-200 text-xs font-bold transition">
              <i class="fa-solid fa-download text-[11px]"></i>
              <span>Unduh Master User (CSV)</span>
            </a>
          </div>
        </div>

      </div>
    </div>
  </main>

</body>
</html>

