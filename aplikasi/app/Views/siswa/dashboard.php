<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Dashboard Siswa - Room Learning SMP</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
  <style>
    body { font-family: 'Plus Jakarta Sans', sans-serif; }
    .custom-scrollbar::-webkit-scrollbar { width: 5px; height: 5px; }
    .custom-scrollbar::-webkit-scrollbar-track { background: #f1f5f9; }
    .custom-scrollbar::-webkit-scrollbar-thumb { background: #cbd5e1; border-radius: 4px; }
  </style>
</head>
<body class="bg-slate-50/60 text-slate-800 flex h-screen overflow-hidden">

  <!-- Sidebar Navigasi Siswa (Fresh Teal Theme) -->
  <aside class="w-64 bg-white border-r border-slate-200/80 flex flex-col justify-between shrink-0 p-4 shadow-sm">
    <div>
      <!-- Brand Header -->
      <div class="p-3 mb-4 flex items-center gap-3">
        <div class="w-10 h-10 bg-gradient-to-tr from-teal-600 to-emerald-500 text-white rounded-2xl flex items-center justify-center font-black text-base shadow-md shadow-teal-500/20">
          <i class="fa-solid fa-graduation-cap"></i>
        </div>
        <div>
          <h2 class="font-black text-sm text-slate-800 leading-tight">Room Learning</h2>
          <span class="text-[10px] font-extrabold uppercase tracking-wider text-teal-600 bg-teal-50 px-2 py-0.5 rounded-md">Siswa SMP</span>
        </div>
      </div>

      <!-- Navigation -->
      <nav class="space-y-1">
        <a href="<?= site_url('siswa/dashboard') ?>" class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl bg-teal-50 text-teal-700 font-bold text-xs shadow-sm transition">
          <i class="fa-solid fa-house w-4 text-center"></i>
          <span>Beranda Belajar</span>
        </a>
        <a href="<?= site_url('siswa/jadwal') ?>" class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl text-slate-600 hover:bg-slate-50 hover:text-slate-900 font-semibold text-xs transition">
          <i class="fa-regular fa-calendar-days w-4 text-center"></i>
          <span>Jadwal Kelas Saya</span>
        </a>
        <a href="<?= site_url('siswa/materi') ?>" class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl text-slate-600 hover:bg-slate-50 hover:text-slate-900 font-semibold text-xs transition">
          <i class="fa-regular fa-book-open w-4 text-center"></i>
          <span>Materi Pelajaran</span>
        </a>
        <a href="<?= site_url('siswa/tugas') ?>" class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl text-slate-600 hover:bg-slate-50 hover:text-slate-900 font-semibold text-xs transition">
          <i class="fa-regular fa-clipboard-check w-4 text-center"></i>
          <span>Tugas & Pengumpulan</span>
        </a>
        <a href="<?= site_url('siswa/profil') ?>" class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl text-slate-600 hover:bg-slate-50 hover:text-slate-900 font-semibold text-xs transition">
          <i class="fa-regular fa-user w-4 text-center"></i>
          <span>Profil Saya</span>
        </a>
        <a href="<?= site_url('gemini') ?>" class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl text-slate-600 hover:bg-slate-50 hover:text-slate-900 font-semibold text-xs transition">
          <i class="fa-solid fa-robot text-teal-500 w-4 text-center"></i>
          <span>Tanya Gemini AI</span>
        </a>
      </nav>

      <!-- Student Mini Profile Card in Sidebar -->
      <div class="mt-8 p-3.5 rounded-2xl bg-gradient-to-br from-teal-50 to-emerald-50/60 border border-teal-100">
        <div class="flex items-center gap-2.5">
          <div class="w-8 h-8 rounded-full bg-teal-600 text-white font-bold text-xs flex items-center justify-center">
            <?= strtoupper(substr(session()->get('user_name') ?? 'S', 0, 1)) ?>
          </div>
          <div class="overflow-hidden">
            <p class="text-xs font-bold text-slate-800 truncate"><?= esc(session()->get('user_name')) ?></p>
            <p class="text-[10px] text-teal-700 font-semibold">Kelas: <?= esc($kelas) ?></p>
          </div>
        </div>
      </div>
    </div>

    <!-- Logout Button -->
    <a href="<?= site_url('logout') ?>" class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl text-rose-500 hover:bg-rose-50 hover:text-rose-600 font-bold text-xs transition">
      <i class="fa-solid fa-right-from-bracket w-4 text-center"></i>
      <span>Keluar Akun</span>
    </a>
  </aside>

  <!-- Main Content Area -->
  <main class="flex-1 overflow-y-auto custom-scrollbar p-6 lg:p-8">
    
    <!-- Top Welcome Bar -->
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 mb-6">
      <div>
        <h1 class="text-2xl font-black text-slate-900 tracking-tight">
          Halo, <?= esc(session()->get('user_name')) ?>! 👋
        </h1>
        <p class="text-xs text-slate-500 mt-1">
          Tetap semangat belajar di Portal Pembelajaran Digital SMP. Kamu pasti bisa meraih prestasi terbaik!
        </p>
      </div>

      <div class="flex flex-wrap items-center gap-2">
        <span class="inline-flex items-center gap-1.5 text-xs bg-teal-50 text-teal-700 border border-teal-200/80 px-3.5 py-1.5 rounded-full font-bold shadow-sm">
          <i class="fa-solid fa-school text-[11px] text-teal-600"></i>
          Kelas: <?= esc($kelas) ?>
        </span>
        <span class="inline-flex items-center gap-1.5 text-xs bg-slate-100 text-slate-700 px-3.5 py-1.5 rounded-full font-semibold">
          <i class="fa-regular fa-calendar-check text-[11px] text-slate-500"></i>
          Hari Ini: <strong class="font-bold text-teal-800"><?= esc($hariIni) ?></strong>
        </span>
      </div>
    </div>

    <!-- Motivational Hero Banner (Teal Gradient) -->
    <div class="relative overflow-hidden rounded-3xl bg-gradient-to-r from-teal-600 via-emerald-600 to-cyan-600 text-white p-6 lg:p-7 mb-8 shadow-lg shadow-teal-500/10">
      <div class="relative z-10 flex flex-col md:flex-row md:items-center justify-between gap-6">
        <div class="max-w-xl">
          <div class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-white/15 backdrop-blur-md text-white text-[10px] font-extrabold tracking-wider uppercase mb-3 border border-white/20">
            <i class="fa-solid fa-sparkles text-amber-300"></i>
            Ruang Belajar Digital SMP
          </div>
          <h2 class="text-xl lg:text-2xl font-black tracking-tight leading-snug">
            Siap Menjelajahi Pelajaran Baru Hari Ini? 🚀
          </h2>
          <p class="text-xs text-teal-50/90 font-medium mt-1.5 leading-relaxed">
            Periksa jadwal belajar kelasmu, baca bahan ajar interaktif, dan manfaatkan bantuan AI Gemini jika ada materi yang perlu penjelasan lebih mendalam.
          </p>
        </div>

        <div class="flex flex-wrap sm:flex-nowrap items-center gap-2.5 shrink-0">
          <a href="<?= site_url('siswa/tugas') ?>" class="inline-flex items-center gap-2 px-4 py-2.5 rounded-2xl bg-white text-teal-800 hover:bg-teal-50 text-xs font-black shadow-sm transition">
            <i class="fa-regular fa-clipboard-check text-teal-600"></i>
            <span>Cek Tugas Saya</span>
          </a>
          <a href="<?= site_url('gemini') ?>" class="inline-flex items-center gap-2 px-4 py-2.5 rounded-2xl bg-teal-700/60 hover:bg-teal-700 text-white border border-white/20 text-xs font-bold transition">
            <i class="fa-solid fa-wand-magic-sparkles text-amber-300"></i>
            <span>Tanya Gemini AI</span>
          </a>
        </div>
      </div>

      <!-- Decorative Elements -->
      <div class="absolute -right-10 -bottom-10 w-52 h-52 bg-white/10 rounded-full blur-2xl pointer-events-none"></div>
      <div class="absolute right-64 -top-12 w-40 h-40 bg-teal-400/20 rounded-full blur-2xl pointer-events-none"></div>
    </div>

    <!-- 4 Personal Metric Cards -->
    <div class="grid grid-cols-2 lg:grid-cols-4 gap-4 mb-8">
      
      <!-- Card 1: Materi -->
      <a href="<?= site_url('siswa/materi') ?>" class="bg-white p-4.5 rounded-2xl border border-slate-200/70 hover:border-teal-300 hover:shadow-md transition group">
        <div class="flex items-center justify-between mb-3">
          <div class="w-10 h-10 rounded-xl bg-teal-50 text-teal-600 flex items-center justify-center text-base group-hover:scale-110 transition">
            <i class="fa-regular fa-book-open"></i>
          </div>
          <span class="text-[10px] font-extrabold px-2 py-0.5 rounded-md bg-teal-50 text-teal-700 border border-teal-100">
            Tersedia
          </span>
        </div>
        <p class="text-xs font-semibold text-slate-500">Materi Pelajaran</p>
        <h3 class="text-xl font-black text-slate-900 mt-0.5"><?= esc($materiCount ?? 0) ?> <span class="text-xs font-medium text-slate-400">Modul</span></h3>
      </a>

      <!-- Card 2: Jadwal -->
      <a href="<?= site_url('siswa/jadwal') ?>" class="bg-white p-4.5 rounded-2xl border border-slate-200/70 hover:border-cyan-300 hover:shadow-md transition group">
        <div class="flex items-center justify-between mb-3">
          <div class="w-10 h-10 rounded-xl bg-cyan-50 text-cyan-600 flex items-center justify-center text-base group-hover:scale-110 transition">
            <i class="fa-regular fa-calendar-days"></i>
          </div>
          <span class="text-[10px] font-extrabold px-2 py-0.5 rounded-md bg-cyan-50 text-cyan-700 border border-cyan-100">
            Minggu Ini
          </span>
        </div>
        <p class="text-xs font-semibold text-slate-500">Jadwal Belajar</p>
        <h3 class="text-xl font-black text-slate-900 mt-0.5"><?= esc($jadwalCount ?? 0) ?> <span class="text-xs font-medium text-slate-400">Sesi</span></h3>
      </a>

      <!-- Card 3: Tugas Pending -->
      <a href="<?= site_url('siswa/tugas') ?>" class="bg-white p-4.5 rounded-2xl border border-slate-200/70 hover:border-amber-300 hover:shadow-md transition group">
        <div class="flex items-center justify-between mb-3">
          <div class="w-10 h-10 rounded-xl bg-amber-50 text-amber-600 flex items-center justify-center text-base group-hover:scale-110 transition">
            <i class="fa-regular fa-clock"></i>
          </div>
          <span class="text-[10px] font-extrabold px-2 py-0.5 rounded-md <?= $tugasPending > 0 ? 'bg-amber-100 text-amber-800' : 'bg-slate-100 text-slate-600' ?>">
            <?= $tugasPending > 0 ? 'Perlu Dikerjakan' : 'Lengkap' ?>
          </span>
        </div>
        <p class="text-xs font-semibold text-slate-500">Tugas Belum Dikumpul</p>
        <h3 class="text-xl font-black <?= $tugasPending > 0 ? 'text-amber-600' : 'text-slate-900' ?> mt-0.5">
          <?= esc($tugasPending ?? 0) ?> <span class="text-xs font-medium text-slate-400">Tugas</span>
        </h3>
      </a>

      <!-- Card 4: Tugas Selesai Dinilai -->
      <a href="<?= site_url('siswa/tugas') ?>" class="bg-white p-4.5 rounded-2xl border border-slate-200/70 hover:border-emerald-300 hover:shadow-md transition group">
        <div class="flex items-center justify-between mb-3">
          <div class="w-10 h-10 rounded-xl bg-emerald-50 text-emerald-600 flex items-center justify-center text-base group-hover:scale-110 transition">
            <i class="fa-regular fa-award"></i>
          </div>
          <span class="text-[10px] font-extrabold px-2 py-0.5 rounded-md bg-emerald-50 text-emerald-700 border border-emerald-100">
            <?= $rataRataNilai !== null ? 'Rata-rata: '.$rataRataNilai : 'Selesai' ?>
          </span>
        </div>
        <p class="text-xs font-semibold text-slate-500">Tugas Sudah Dinilai</p>
        <h3 class="text-xl font-black text-slate-900 mt-0.5"><?= esc($tugasGraded ?? 0) ?> <span class="text-xs font-medium text-slate-400">Tugas</span></h3>
      </a>

    </div>

    <!-- Dual Column Learning Section: Jadwal Hari Ini & Status Tugas -->
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-6 mb-8">
      
      <!-- Left Column (7 cols): Jadwal Pelajaran Hari Ini -->
      <div class="lg:col-span-7 bg-white rounded-3xl border border-slate-200/80 p-5 lg:p-6 shadow-sm flex flex-col justify-between">
        <div>
          <div class="flex items-center justify-between mb-4">
            <div class="flex items-center gap-2.5">
              <div class="w-8 h-8 rounded-xl bg-teal-100 text-teal-700 flex items-center justify-center text-sm font-bold">
                <i class="fa-solid fa-calendar-day"></i>
              </div>
              <div>
                <h3 class="text-sm font-bold text-slate-900">Pelajaran Kamu Hari Ini (<?= esc($hariIni) ?>)</h3>
                <p class="text-[11px] text-slate-400">Jadwal tatap muka kelas <?= esc($kelas) ?> untuk hari ini.</p>
              </div>
            </div>
            <a href="<?= site_url('siswa/jadwal') ?>" class="text-xs font-bold text-teal-600 hover:text-teal-700 inline-flex items-center gap-1">
              <span>Semua Hari</span>
              <i class="fa-solid fa-chevron-right text-[10px]"></i>
            </a>
          </div>

          <?php if (!empty($jadwalHariIni)): ?>
            <div class="space-y-3">
              <?php foreach ($jadwalHariIni as $j): ?>
                <div class="p-3.5 rounded-2xl border border-teal-100/80 bg-teal-50/30 hover:bg-teal-50/60 transition flex items-center justify-between">
                  <div class="flex items-center gap-3">
                    <div class="w-11 h-11 rounded-xl bg-teal-600 text-white flex flex-col items-center justify-center font-bold shrink-0 shadow-sm shadow-teal-500/20">
                      <i class="fa-solid fa-book-open text-xs"></i>
                    </div>
                    <div>
                      <h4 class="text-xs font-black text-slate-900"><?= esc($j['mapel']) ?></h4>
                      <p class="text-[11px] text-slate-500 font-medium">
                        <i class="fa-solid fa-user-tie text-[9px] mr-1 text-slate-400"></i><?= esc($j['nama_guru'] ?? 'Guru Pengampu') ?>
                      </p>
                      <p class="text-[10px] text-teal-700 font-semibold mt-0.5">
                        <i class="fa-regular fa-clock mr-1"></i><?= date('H:i', strtotime($j['jam_mulai'])) ?> - <?= date('H:i', strtotime($j['jam_selesai'])) ?> WIB
                        <?php if (!empty($j['ruangan'])): ?>
                          • <i class="fa-solid fa-location-dot text-[9px] mr-0.5"></i> <?= esc($j['ruangan']) ?>
                        <?php endif; ?>
                      </p>
                    </div>
                  </div>
                  <span class="px-2.5 py-1 text-[10px] font-extrabold bg-teal-100 text-teal-800 rounded-lg">
                    <?= esc($j['kelas']) ?>
                  </span>
                </div>
              <?php endforeach; ?>
            </div>
          <?php else: ?>
            <div class="text-center py-8 bg-slate-50/70 rounded-2xl border border-dashed border-slate-200">
              <div class="w-12 h-12 rounded-full bg-emerald-50 text-emerald-600 flex items-center justify-center mx-auto mb-2 text-xl">
                <i class="fa-solid fa-mug-hot"></i>
              </div>
              <p class="text-xs font-bold text-slate-700">Tidak ada jadwal kelas untuk hari <?= esc($hariIni) ?>!</p>
              <p class="text-[11px] text-slate-400 max-w-xs mx-auto mt-0.5">
                Bagus sekali! Kamu bisa memanfaatkan waktu luang ini untuk membaca modul materi atau menuntaskan tugas.
              </p>
              <a href="<?= site_url('siswa/jadwal') ?>" class="mt-3.5 inline-flex items-center gap-1.5 px-3 py-1.5 bg-teal-600 text-white rounded-xl text-xs font-bold hover:bg-teal-700 transition">
                <i class="fa-regular fa-calendar-days text-[10px]"></i>
                <span>Lihat Jadwal Hari Lain</span>
              </a>
            </div>
          <?php endif; ?>
        </div>

        <div class="mt-4 pt-3 border-t border-slate-100 flex items-center justify-between text-xs text-slate-400">
          <span>Total Sesi Minggu Ini: <strong class="text-slate-700 font-bold"><?= esc($jadwalCount ?? 0) ?> Sesi</strong></span>
          <span class="text-teal-600 font-semibold">5 Hari Sekolah (Senin - Jumat)</span>
        </div>
      </div>

      <!-- Right Column (5 cols): Status & Ringkasan Tugas Saya -->
      <div class="lg:col-span-5 bg-white rounded-3xl border border-slate-200/80 p-5 lg:p-6 shadow-sm flex flex-col justify-between">
        <div>
          <div class="flex items-center justify-between mb-4">
            <div class="flex items-center gap-2">
              <div class="w-8 h-8 rounded-xl bg-amber-100 text-amber-700 flex items-center justify-center text-sm font-bold">
                <i class="fa-solid fa-list-check"></i>
              </div>
              <div>
                <h3 class="text-sm font-bold text-slate-900">Tugas Belajar Saya</h3>
                <p class="text-[11px] text-slate-400">Ringkasan tugas yang perlu kamu selesaikan.</p>
              </div>
            </div>
            <a href="<?= site_url('siswa/tugas') ?>" class="text-xs font-bold text-amber-600 hover:text-amber-700 inline-flex items-center gap-1">
              <span>Semua Tugas</span>
              <i class="fa-solid fa-chevron-right text-[10px]"></i>
            </a>
          </div>

          <?php if (!empty($recentTugas)): ?>
            <div class="space-y-2.5">
              <?php foreach ($recentTugas as $rt): ?>
                <div class="p-3 rounded-2xl border border-slate-100 bg-slate-50/50 flex items-center justify-between hover:bg-slate-50 transition">
                  <div class="overflow-hidden pr-2">
                    <h5 class="text-xs font-bold text-slate-800 truncate"><?= esc($rt['judul']) ?></h5>
                    <p class="text-[10px] text-slate-400 mt-0.5">
                      <i class="fa-regular fa-clock mr-0.5"></i> Tenggat: <?= !empty($rt['deadline']) ? date('d M, H:i', strtotime($rt['deadline'])) : 'Tanpa batas' ?>
                    </p>
                  </div>
                  <div class="shrink-0">
                    <?php if (!empty($rt['nilai'])): ?>
                      <span class="px-2 py-0.5 rounded-lg text-[10px] font-black bg-emerald-100 text-emerald-800">
                        Nilai: <?= esc($rt['nilai']) ?>
                      </span>
                    <?php elseif (!empty($rt['is_submitted'])): ?>
                      <span class="px-2 py-0.5 rounded-lg text-[10px] font-bold bg-blue-50 text-blue-700">
                        Dinilai Guru
                      </span>
                    <?php else: ?>
                      <a href="<?= site_url('siswa/tugas') ?>" class="px-2.5 py-1 rounded-lg text-[10px] font-bold bg-amber-500 hover:bg-amber-600 text-white transition">
                        Kumpulkan
                      </a>
                    <?php endif; ?>
                  </div>
                </div>
              <?php endforeach; ?>
            </div>
          <?php else: ?>
            <div class="text-center py-8 bg-slate-50/70 rounded-2xl border border-dashed border-slate-200">
              <i class="fa-regular fa-clipboard text-slate-300 text-2xl mb-1.5"></i>
              <p class="text-xs font-bold text-slate-600">Belum ada tugas aktif untuk kelasmu.</p>
              <p class="text-[10px] text-slate-400 mt-0.5">Bagus! Kamu bisa santai atau membaca materi lebih dulu.</p>
            </div>
          <?php endif; ?>
        </div>

        <!-- Bantuan Gemini AI Card -->
        <div class="mt-4 pt-4 border-t border-slate-100">
          <div class="p-3.5 rounded-2xl bg-gradient-to-r from-teal-50 to-emerald-50 border border-teal-100/90 flex items-center justify-between">
            <div class="flex items-center gap-2.5">
              <div class="w-8 h-8 rounded-xl bg-teal-600 text-white flex items-center justify-center text-xs">
                <i class="fa-solid fa-robot"></i>
              </div>
              <div>
                <p class="text-xs font-bold text-teal-900 leading-none">Gemini Pembelajaran Terpadu</p>
                <p class="text-[10px] text-teal-600 mt-0.5">Tanya konsep, kuis, atau latihan belajar terpadu</p>
              </div>
            </div>
            <a href="<?= site_url('gemini') ?>" class="px-3 py-1.5 rounded-xl bg-teal-600 hover:bg-teal-700 text-white text-[11px] font-bold transition shadow-sm">
              Tanya AI
            </a>
          </div>
        </div>

      </div>

    </div>

  </main>

</body>
</html>
