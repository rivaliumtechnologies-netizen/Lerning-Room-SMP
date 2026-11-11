<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Dashboard Guru - Room Learning SMP</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;700;800&display=swap" rel="stylesheet">
  <style>body { font-family: 'Plus Jakarta Sans', sans-serif; }</style>
</head>
<body class="bg-slate-50 text-slate-800 flex h-screen overflow-hidden">
  <aside class="w-64 bg-white border-r border-slate-200 flex flex-col justify-between shrink-0 p-4">
    <div>
      <div class="p-3 mb-4 flex items-center gap-2">
        <div class="w-8 h-8 bg-blue-600 text-white rounded-lg flex items-center justify-center font-bold text-sm shadow-sm"><i class="fa-solid fa-graduation-cap"></i></div>
        <div><h2 class="font-extrabold text-xs text-slate-800 leading-none">Room Learning</h2><span class="text-[9px] font-bold text-blue-600">SMP</span></div>
      </div>
      <nav class="space-y-1">
        <a href="<?= site_url('guru/dashboard') ?>" class="flex items-center gap-3 px-3 py-2.5 rounded-xl bg-blue-50 text-blue-600 font-bold text-xs"><i class="fa-solid fa-house w-4"></i><span>Beranda</span></a>
        <a href="<?= site_url('guru/kelas-siswa') ?>" class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-slate-600 hover:bg-slate-50 font-semibold text-xs"><i class="fa-solid fa-users-rectangle w-4"></i><span>Kelas & Siswa</span></a>
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
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-6">
      <div>
        <h1 class="text-2xl font-extrabold text-slate-800">Selamat datang, <?= esc(session()->get('user_name')) ?>! 👋</h1>
        <p class="text-xs text-slate-400 mt-1">Panel Pembelajaran Digital Terpadu SMP - Kurikulum Merdeka</p>
      </div>
      <div class="flex items-center gap-2">
        <span class="inline-flex items-center gap-1.5 text-xs bg-emerald-50 text-emerald-700 border border-emerald-200 px-3 py-1 rounded-full font-bold">
          <i class="fa-solid fa-book-bookmark text-[10px]"></i>
          Mapel: <?= !empty($guru['mapel']) ? esc($guru['mapel']) : 'Belum Diatur' ?>
        </span>
        <span class="text-xs bg-blue-50 text-blue-700 border border-blue-200 px-3 py-1 rounded-full font-bold">Guru Pengampu</span>
      </div>
    </div>

    <!-- Info Kelas yang Diajarkan Banner -->
    <div class="bg-white border border-slate-200 rounded-3xl p-5 mb-6 shadow-sm">
      <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
        <div class="flex items-center gap-3">
          <div class="w-11 h-11 rounded-2xl bg-indigo-50 text-indigo-600 flex items-center justify-center text-lg font-bold">
            <i class="fa-solid fa-school"></i>
          </div>
          <div>
            <h3 class="text-sm font-bold text-slate-800">Kelas yang Anda Ajar</h3>
            <div class="flex flex-wrap items-center gap-1.5 mt-1.5">
              <?php if (!empty($kelasList)): ?>
                <?php foreach ($kelasList as $k): ?>
                  <span class="inline-flex items-center px-2.5 py-0.5 rounded-lg text-xs font-extrabold bg-indigo-50 text-indigo-700 border border-indigo-100">
                    <?= esc($k) ?>
                  </span>
                <?php endforeach; ?>
              <?php else: ?>
                <span class="text-xs text-slate-400 italic">Belum ada daftar kelas. Atur di menu Profil.</span>
              <?php endif; ?>
            </div>
          </div>
        </div>
        <div class="flex items-center gap-2">
          <a href="<?= site_url('guru/kelas-siswa') ?>" class="inline-flex items-center gap-2 px-3.5 py-2 rounded-xl text-xs font-bold text-indigo-600 bg-indigo-50 hover:bg-indigo-100 transition">
            <i class="fa-solid fa-users-rectangle"></i>
            <span>Daftar Siswa Kelas</span>
          </a>
          <a href="<?= site_url('guru/profil') ?>" class="inline-flex items-center gap-2 px-3.5 py-2 rounded-xl text-xs font-semibold text-slate-600 hover:bg-slate-100 transition border border-slate-200">
            <i class="fa-solid fa-pen"></i>
            <span>Ubah</span>
          </a>
        </div>
      </div>
    </div>

    <!-- Stat Overview 5 Cards -->
    <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-5 gap-4 mb-6">
      <div class="bg-white p-4 rounded-2xl border border-slate-100 shadow-sm">
        <div class="flex items-center justify-between text-slate-400 mb-2">
          <span class="text-[10px] font-bold uppercase tracking-wider">Kelas Diajar</span>
          <i class="fa-solid fa-chalkboard-user text-xs text-indigo-500"></i>
        </div>
        <h3 class="text-2xl font-extrabold text-slate-800"><?= count($kelasList) ?></h3>
        <p class="text-[10px] text-slate-400 mt-0.5">Rombongan belajar</p>
      </div>

      <div class="bg-white p-4 rounded-2xl border border-slate-100 shadow-sm">
        <div class="flex items-center justify-between text-slate-400 mb-2">
          <span class="text-[10px] font-bold uppercase tracking-wider">Total Siswa</span>
          <i class="fa-solid fa-user-group text-xs text-blue-500"></i>
        </div>
        <h3 class="text-2xl font-extrabold text-slate-800"><?= esc($totalSiswa ?? 0) ?></h3>
        <p class="text-[10px] text-slate-400 mt-0.5">Siswa terdaftar</p>
      </div>

      <div class="bg-white p-4 rounded-2xl border border-slate-100 shadow-sm">
        <div class="flex items-center justify-between text-slate-400 mb-2">
          <span class="text-[10px] font-bold uppercase tracking-wider">Jadwal Mengajar</span>
          <i class="fa-regular fa-calendar-check text-xs text-amber-500"></i>
        </div>
        <h3 class="text-2xl font-extrabold text-slate-800"><?= esc($jadwalCount ?? 0) ?></h3>
        <p class="text-[10px] text-slate-400 mt-0.5">Sesi per minggu</p>
      </div>

      <div class="bg-white p-4 rounded-2xl border border-slate-100 shadow-sm">
        <div class="flex items-center justify-between text-slate-400 mb-2">
          <span class="text-[10px] font-bold uppercase tracking-wider">Materi Aktif</span>
          <i class="fa-regular fa-book-open text-xs text-emerald-500"></i>
        </div>
        <h3 class="text-2xl font-extrabold text-slate-800"><?= esc($materiCount) ?></h3>
        <p class="text-[10px] text-slate-400 mt-0.5">Modul pembelajaran</p>
      </div>

      <div class="bg-white p-4 rounded-2xl border border-slate-100 shadow-sm">
        <div class="flex items-center justify-between text-slate-400 mb-2">
          <span class="text-[10px] font-bold uppercase tracking-wider">Tugas & Respon</span>
          <i class="fa-regular fa-clipboard text-xs text-purple-500"></i>
        </div>
        <h3 class="text-2xl font-extrabold text-slate-800"><?= esc($tugasCount) ?> <span class="text-xs text-slate-400 font-normal">/ <?= esc($pengumpulanCount) ?></span></h3>
        <p class="text-[10px] text-slate-400 mt-0.5">Tugas / Pengumpulan</p>
      </div>
    </div>

    <!-- Two Columns: Jadwal Pembelajaran & Gemini AI Banner -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-8">
      <!-- Jadwal Preview (2 cols) -->
      <div class="lg:col-span-2 bg-white rounded-3xl border border-slate-100 p-6 shadow-sm">
        <div class="flex items-center justify-between mb-4">
          <div>
            <h2 class="text-sm font-bold text-slate-800">Waktu & Jadwal Pembelajaran</h2>
            <p class="text-[11px] text-slate-400">Jadwal sesi mengajar mata pelajaran Anda</p>
          </div>
          <a href="<?= site_url('guru/jadwal') ?>" class="text-xs font-bold text-blue-600 hover:text-blue-700 inline-flex items-center gap-1.5">
            <span>Kelola Jadwal</span>
            <i class="fa-solid fa-arrow-right text-[10px]"></i>
          </a>
        </div>

        <?php if (!empty($jadwalList)): ?>
          <div class="divide-y divide-slate-100">
            <?php foreach ($jadwalList as $j): ?>
              <div class="py-3 flex items-center justify-between gap-3">
                <div class="flex items-center gap-3">
                  <div class="w-10 h-10 rounded-xl bg-blue-50 text-blue-700 flex flex-col items-center justify-center font-bold">
                    <span class="text-[9px] uppercase leading-none"><?= substr($j['hari'], 0, 3) ?></span>
                    <span class="text-xs font-black"><?= date('H:i', strtotime($j['jam_mulai'])) ?></span>
                  </div>
                  <div>
                    <div class="flex items-center gap-2">
                      <h4 class="text-xs font-bold text-slate-800"><?= esc($j['mapel']) ?></h4>
                      <span class="px-2 py-0.5 rounded text-[10px] font-extrabold bg-slate-100 text-slate-600"><?= esc($j['kelas']) ?></span>
                    </div>
                    <p class="text-[11px] text-slate-400 mt-0.5">
                      <i class="fa-regular fa-clock text-[10px] mr-1"></i><?= date('H:i', strtotime($j['jam_mulai'])) ?> - <?= date('H:i', strtotime($j['jam_selesai'])) ?> WIB
                      <?php if (!empty($j['ruangan'])): ?>
                        • <i class="fa-solid fa-location-dot text-[10px] mr-0.5"></i> <?= esc($j['ruangan']) ?>
                      <?php endif; ?>
                    </p>
                  </div>
                </div>
                <span class="text-xs font-semibold px-2.5 py-1 bg-emerald-50 text-emerald-700 rounded-lg">
                  <?= esc($j['hari']) ?>
                </span>
              </div>
            <?php endforeach; ?>
          </div>
        <?php else: ?>
          <div class="text-center py-8 bg-slate-50 rounded-2xl border border-dashed border-slate-200">
            <i class="fa-regular fa-calendar-xmark text-slate-300 text-3xl mb-2"></i>
            <p class="text-xs text-slate-500 font-semibold">Belum ada jadwal mengajar yang diatur.</p>
            <p class="text-[11px] text-slate-400 mt-0.5">Tambahkan jadwal mata pelajaran Anda agar siswa dapat melihat waktu belajar.</p>
            <a href="<?= site_url('guru/jadwal') ?>" class="mt-3 inline-flex items-center gap-1.5 px-3 py-1.5 bg-blue-600 text-white rounded-xl text-xs font-bold hover:bg-blue-700 transition">
              <i class="fa-solid fa-plus text-[10px]"></i>
              <span>Atur Jadwal Sekarang</span>
            </a>
          </div>
        <?php endif; ?>
      </div>

      <!-- Gemini AI Card (1 col) -->
      <div class="bg-gradient-to-br from-indigo-600 via-blue-600 to-sky-500 rounded-3xl p-6 text-white shadow-lg shadow-sky-100 flex flex-col justify-between">
        <div>
          <div class="w-10 h-10 rounded-2xl bg-white/10 backdrop-blur border border-white/20 flex items-center justify-center text-xl mb-4">
            <i class="fa-solid fa-robot"></i>
          </div>
          <h2 class="text-base font-extrabold leading-snug">Gemini AI - Referensi untuk Mengajar</h2>
          <p class="text-xs text-sky-100 mt-2 leading-relaxed">
            Asisten cerdas untuk membantu guru menyusun rencana ajar, membuat bank soal dan tugas otomatis, serta menghasilkan referensi materi edukatif berbasis Kurikulum Merdeka.
          </p>
        </div>
        <div class="mt-6 space-y-2">
          <a href="<?= site_url('guru/monitoring-ai') ?>" class="w-full inline-flex items-center justify-center gap-2 rounded-2xl bg-white px-4 py-2.5 text-xs font-black text-indigo-700 hover:bg-indigo-50 transition shadow-sm">
            <i class="fa-solid fa-chart-line text-indigo-600"></i>
            <span>Monitoring AI Siswa</span>
          </a>
          <a href="<?= site_url('gemini') ?>" class="w-full inline-flex items-center justify-center gap-2 rounded-2xl bg-white/10 hover:bg-white/20 border border-white/20 px-4 py-2 text-xs font-bold text-white transition">
            <i class="fa-solid fa-wand-magic-sparkles text-amber-300"></i>
            <span>Tutor Referensi Guru</span>
          </a>
        </div>
      </div>
    </div>
  </main>
</body>
</html>

