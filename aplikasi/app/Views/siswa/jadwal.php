<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Jadwal Pembelajaran - Siswa SMP</title>
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
        <a href="<?= site_url('siswa/dashboard') ?>" class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl text-slate-600 hover:bg-slate-50 hover:text-slate-900 font-semibold text-xs transition">
          <i class="fa-solid fa-house w-4 text-center"></i>
          <span>Beranda Belajar</span>
        </a>
        <a href="<?= site_url('siswa/jadwal') ?>" class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl bg-teal-50 text-teal-700 font-bold text-xs shadow-sm transition">
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
            <p class="text-[10px] text-teal-700 font-semibold">Kelas: <?= esc($kelas_siswa ?? 'Umum') ?></p>
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
    
    <!-- Top Header -->
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 mb-6">
      <div>
        <div class="flex items-center gap-3">
          <h1 class="text-2xl font-black text-slate-900 tracking-tight">Jadwal Pelajaran Kelas Saya</h1>
          <?php if (!empty($kelas_siswa)): ?>
            <span class="bg-teal-50 text-teal-700 text-xs font-extrabold px-3 py-1 rounded-full border border-teal-200 shadow-sm">
              Kelas <?= esc($kelas_siswa) ?>
            </span>
          <?php endif; ?>
        </div>
        <p class="text-xs text-slate-500 mt-1">
          Waktu tatap muka pembelajaran sekolah 5 hari kerja (Senin s/d Jumat).
        </p>
      </div>

      <div class="flex items-center gap-2">
        <a href="<?= site_url('siswa/dashboard') ?>" class="inline-flex items-center gap-2 px-3.5 py-2 rounded-xl bg-white border border-slate-200 text-slate-700 hover:bg-slate-50 text-xs font-bold transition">
          <i class="fa-solid fa-arrow-left text-[11px]"></i>
          <span>Kembali ke Beranda</span>
        </a>
      </div>
    </div>

    <!-- Grouping Jadwal Per Hari (Senin s/d Jumat) -->
    <?php
      $days = ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat'];
      $hariMap = [1 => 'Senin', 2 => 'Selasa', 3 => 'Rabu', 4 => 'Kamis', 5 => 'Jumat', 6 => 'Sabtu', 7 => 'Minggu'];
      $hariIniSekarang = $hariMap[(int) date('N')] ?? '';
      
      $grouped = [];
      foreach ($days as $d) {
          $grouped[$d] = [];
      }
      foreach ($jadwal as $j) {
          $grouped[$j['hari']][] = $j;
      }
    ?>

    <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-6 mb-8">
      <?php foreach ($days as $day): ?>
        <?php 
          $list = $grouped[$day]; 
          $isToday = (strcasecmp($day, $hariIniSekarang) === 0);
        ?>
        <div class="bg-white rounded-3xl border <?= $isToday ? 'border-teal-300 ring-2 ring-teal-500/20 shadow-md shadow-teal-500/5' : 'border-slate-200/80 shadow-sm' ?> overflow-hidden flex flex-col transition">
          
          <!-- Day Header -->
          <div class="p-4 border-b border-slate-100 flex items-center justify-between <?= $isToday ? 'bg-gradient-to-r from-teal-50 to-emerald-50' : 'bg-slate-50/70' ?>">
            <div class="flex items-center gap-2">
              <div class="w-8 h-8 rounded-xl <?= $isToday ? 'bg-teal-600 text-white' : 'bg-slate-200 text-slate-700' ?> flex items-center justify-center text-xs font-bold">
                <i class="fa-regular fa-calendar"></i>
              </div>
              <div>
                <h3 class="font-extrabold text-sm text-slate-800 leading-tight"><?= esc($day) ?></h3>
                <?php if ($isToday): ?>
                  <span class="text-[9px] font-black uppercase tracking-wider text-teal-700 bg-teal-100 px-1.5 py-0.5 rounded">Hari Ini</span>
                <?php endif; ?>
              </div>
            </div>
            
            <span class="text-[10px] font-bold px-2.5 py-0.5 rounded-full <?= count($list) > 0 ? ($isToday ? 'bg-teal-600 text-white' : 'bg-teal-100 text-teal-800') : 'bg-slate-200 text-slate-500' ?>">
              <?= count($list) ?> Pelajaran
            </span>
          </div>

          <!-- Subjects List -->
          <div class="p-4 flex-1 space-y-3">
            <?php if (empty($list)): ?>
              <div class="py-8 text-center text-slate-400 text-xs">
                <i class="fa-regular fa-calendar-xmark text-2xl mb-1.5 text-slate-300 block"></i>
                Tidak ada pelajaran
              </div>
            <?php else: ?>
              <?php foreach ($list as $item): ?>
                <div class="p-3.5 rounded-2xl border border-slate-100 bg-slate-50/50 hover:bg-teal-50/40 hover:border-teal-200 transition">
                  <div class="flex items-start justify-between gap-2">
                    <div>
                      <h4 class="font-extrabold text-xs text-slate-900"><?= esc($item['mapel']) ?></h4>
                      <p class="text-[11px] text-slate-500 mt-0.5 flex items-center gap-1.5">
                        <i class="fa-solid fa-user-tie text-[9px] text-slate-400"></i>
                        <span><?= esc($item['guru_nama']) ?></span>
                      </p>
                    </div>
                    <span class="inline-flex items-center px-2 py-0.5 rounded-md text-[9px] font-black bg-teal-50 text-teal-700 border border-teal-200">
                      <?= esc($item['kelas']) ?>
                    </span>
                  </div>

                  <div class="mt-3 pt-2.5 border-t border-slate-100 flex items-center justify-between text-xs">
                    <span class="font-bold text-teal-700 flex items-center gap-1.5">
                      <i class="fa-regular fa-clock text-[10px]"></i>
                      <?= substr($item['jam_mulai'], 0, 5) ?> - <?= substr($item['jam_selesai'], 0, 5) ?> WIB
                    </span>
                    <span class="text-[10px] text-slate-500 flex items-center gap-1">
                      <i class="fa-solid fa-location-dot text-slate-400 text-[9px]"></i>
                      <?= esc($item['ruangan'] ?: 'Ruang Kelas') ?>
                    </span>
                  </div>

                  <?php if (!empty($item['keterangan'])): ?>
                    <div class="mt-2 text-[10px] text-slate-500 bg-white p-2 rounded-xl border border-slate-100">
                      <i class="fa-solid fa-info-circle text-teal-600 mr-1 text-[9px]"></i>
                      <?= esc($item['keterangan']) ?>
                    </div>
                  <?php endif; ?>
                </div>
              <?php endforeach; ?>
            <?php endif; ?>
          </div>
        </div>
      <?php endforeach; ?>
    </div>
  </main>
</body>
</html>
