<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Monitoring AI Siswa - Portal Guru - Room Learning SMP</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/marked/marked.min.js"></script>
  <style>
    body { font-family: 'Plus Jakarta Sans', sans-serif; }
    .custom-scroll::-webkit-scrollbar { width: 5px; height: 5px; }
    .custom-scroll::-webkit-scrollbar-thumb { background: #cbd5e1; border-radius: 9999px; }
    .custom-scroll::-webkit-scrollbar-thumb:hover { background: #94a3b8; }
  </style>
</head>
<body class="bg-slate-50 text-slate-800 flex h-screen overflow-hidden">

  <!-- Sidebar Guru -->
  <aside class="w-64 bg-white border-r border-slate-200/80 flex flex-col justify-between shrink-0 p-4 z-20 shadow-sm">
    <div>
      <!-- School Logo & Portal Brand -->
      <div class="p-3 mb-4 flex items-center gap-3">
        <div class="w-10 h-10 bg-gradient-to-tr from-blue-600 to-indigo-600 text-white rounded-2xl flex items-center justify-center font-black text-base shadow-md shadow-blue-500/20">
          <i class="fa-solid fa-graduation-cap"></i>
        </div>
        <div>
          <h2 class="font-black text-sm text-slate-800 leading-tight">Room Learning</h2>
          <span class="text-[10px] font-extrabold uppercase tracking-wider text-blue-600 bg-blue-50 px-2 py-0.5 rounded-md">
            Guru Pengampu
          </span>
        </div>
      </div>

      <!-- Navigation Menu -->
      <nav class="space-y-1">
        <a href="<?= site_url('guru/dashboard') ?>" class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-slate-600 hover:bg-slate-50 font-semibold text-xs transition">
          <i class="fa-solid fa-house w-4 text-center"></i><span>Beranda</span>
        </a>
        <a href="<?= site_url('guru/kelas-siswa') ?>" class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-slate-600 hover:bg-slate-50 font-semibold text-xs transition">
          <i class="fa-solid fa-users-rectangle w-4 text-center"></i><span>Kelas & Siswa</span>
        </a>
        <a href="<?= site_url('guru/jadwal') ?>" class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-slate-600 hover:bg-slate-50 font-semibold text-xs transition">
          <i class="fa-regular fa-calendar-days w-4 text-center"></i><span>Jadwal Belajar</span>
        </a>
        <a href="<?= site_url('guru/materi') ?>" class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-slate-600 hover:bg-slate-50 font-semibold text-xs transition">
          <i class="fa-regular fa-book-open w-4 text-center"></i><span>Kelola Materi</span>
        </a>
        <a href="<?= site_url('guru/tugas') ?>" class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-slate-600 hover:bg-slate-50 font-semibold text-xs transition">
          <i class="fa-regular fa-clipboard w-4 text-center"></i><span>Kelola Tugas</span>
        </a>
        <a href="<?= site_url('guru/nilai') ?>" class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-slate-600 hover:bg-slate-50 font-semibold text-xs transition">
          <i class="fa-regular fa-award w-4 text-center"></i><span>Nilai Siswa</span>
        </a>
        <!-- Active Menu: Monitoring AI Siswa -->
        <a href="<?= site_url('guru/monitoring-ai') ?>" class="flex items-center gap-3 px-3 py-2.5 rounded-xl bg-indigo-50 text-indigo-700 font-extrabold text-xs shadow-xs border border-indigo-100 transition">
          <i class="fa-solid fa-chart-line w-4 text-center text-indigo-600"></i><span>Monitoring AI Siswa</span>
        </a>
        <a href="<?= site_url('guru/profil') ?>" class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-slate-600 hover:bg-slate-50 font-semibold text-xs transition">
          <i class="fa-regular fa-user w-4 text-center"></i><span>Profil Guru</span>
        </a>
        <a href="<?= site_url('gemini') ?>" class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-slate-600 hover:bg-slate-50 font-semibold text-xs transition">
          <i class="fa-solid fa-wand-magic-sparkles w-4 text-center text-blue-500"></i><span>Gemini AI (Tutor Guru)</span>
        </a>
      </nav>

      <!-- Mini Card Profil Guru Aktif (Penanda Jelas Identitas Akun Guru) -->
      <div class="mt-6 p-3.5 rounded-2xl bg-slate-50 border border-slate-100">
        <p class="text-[10px] font-bold uppercase tracking-wider text-slate-400">Akun Guru Aktif</p>
        <p class="text-xs font-black text-slate-800 mt-0.5 truncate"><?= esc(session()->get('user_name') ?? $guru['nama'] ?? 'Bapak/Ibu Guru') ?></p>
        <div class="flex items-center gap-1.5 mt-1.5">
          <span class="inline-flex items-center gap-1 text-[9px] font-extrabold px-2 py-0.5 rounded-md bg-blue-50 text-blue-700 border border-blue-200">
            <i class="fa-solid fa-chalkboard-user text-[10px]"></i>
            <?= !empty($mapel) ? esc($mapel) : 'Semua Mapel' ?>
          </span>
        </div>
      </div>
    </div>

    <!-- Tombol Keluar -->
    <a href="<?= site_url('logout') ?>" class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-rose-500 hover:bg-rose-50 font-bold text-xs transition">
      <i class="fa-solid fa-right-from-bracket w-4 text-center"></i>
      <span>Keluar Akun</span>
    </a>
  </aside>

  <!-- Main Content -->
  <main class="flex-1 overflow-y-auto p-6 md:p-8 custom-scroll">
    
    <!-- Top Header Bar with Teacher Profile Indicator -->
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-6 pb-4 border-b border-slate-200/60">
      <div>
        <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-indigo-50 text-indigo-700 text-[11px] font-extrabold border border-indigo-200 mb-2">
          <i class="fa-solid fa-chart-line text-indigo-600"></i>
          <span>Portal Guru • Evaluasi Pembelajaran Berbantuan AI</span>
        </div>
        <h1 class="text-2xl font-black text-slate-900 tracking-tight">Monitoring Chat AI Siswa</h1>
        <p class="text-xs text-slate-500 mt-1 max-w-2xl leading-relaxed">
          Pantau riwayat konsultasi materi mandiri yang ditanyakan para siswa kepada Gemini AI untuk mendeteksi materi yang dirasa sulit sebagai bahan evaluasi guru di kelas.
        </p>
      </div>

      <!-- Kartu Profil Guru yang Sedang Login -->
      <div class="flex items-center gap-3 bg-white p-3 px-4 rounded-2xl border border-slate-200/90 shadow-xs shrink-0">
        <div class="w-10 h-10 rounded-2xl bg-gradient-to-tr from-blue-600 to-indigo-600 text-white flex items-center justify-center font-black text-sm shadow-sm">
          <?= strtoupper(substr(session()->get('user_name') ?? 'G', 0, 1)) ?>
        </div>
        <div>
          <div class="flex items-center gap-2">
            <h3 class="text-xs font-black text-slate-900 leading-none"><?= esc(session()->get('user_name') ?? 'Guru Pengampu') ?></h3>
            <span class="text-[9px] font-extrabold uppercase bg-blue-50 text-blue-700 border border-blue-200 px-2 py-0.5 rounded-md">Guru</span>
          </div>
          <p class="text-[10px] text-slate-400 mt-1 font-medium">
            Mapel: <strong class="text-slate-700"><?= !empty($mapel) ? esc($mapel) : 'Semua Mapel' ?></strong>
            • Kelas Diajar: <strong class="text-slate-700"><?= !empty($guru['kelas_diajar']) ? esc($guru['kelas_diajar']) : 'Semua' ?></strong>
          </p>
        </div>
      </div>
    </div>

    <!-- Banner Penegasan Panel Monitoring Guru -->
    <div class="bg-gradient-to-r from-indigo-700 via-indigo-600 to-blue-600 text-white p-5 rounded-3xl shadow-sm mb-6 flex flex-col sm:flex-row sm:items-center justify-between gap-4">
      <div class="flex items-start sm:items-center gap-3.5">
        <div class="w-11 h-11 rounded-2xl bg-white/15 backdrop-blur border border-white/20 flex items-center justify-center text-xl text-white shrink-0">
          <i class="fa-solid fa-eye"></i>
        </div>
        <div>
          <div class="flex items-center gap-2">
            <h2 class="text-sm font-black text-white">Mode Pengawasan Guru (Monitoring Siswa)</h2>
            <span class="text-[9px] font-black uppercase bg-white/20 text-white px-2 py-0.5 rounded-md backdrop-blur border border-white/10">Mode Observasi</span>
          </div>
          <p class="text-xs text-indigo-100 mt-0.5 leading-relaxed">
            Anda sedang berada di panel pengawasan guru. Seluruh data di bawah merupakan catatan interaksi siswa saat belajar mandiri dengan asisten cerdas Gemini AI.
          </p>
        </div>
      </div>
      <div class="shrink-0 flex items-center gap-2">
        <a href="<?= site_url('guru/dashboard') ?>" class="inline-flex items-center gap-2 px-3.5 py-2 rounded-xl bg-white text-indigo-700 hover:bg-indigo-50 text-xs font-black transition shadow-xs">
          <i class="fa-solid fa-house text-xs"></i>
          <span>Kembali ke Beranda</span>
        </a>
      </div>
    </div>

    <!-- 3 Info Metric Cards: Evaluasi Konsep Materi -->
    <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 mb-6">
      
      <div class="bg-white p-5 rounded-3xl border border-slate-200/80 shadow-xs">
        <div class="flex items-center justify-between text-slate-400 mb-2">
          <span class="text-[11px] font-extrabold uppercase tracking-wider text-slate-500">Total Obrolan Siswa</span>
          <div class="w-8 h-8 rounded-xl bg-indigo-50 text-indigo-600 flex items-center justify-center text-xs">
            <i class="fa-solid fa-comments"></i>
          </div>
        </div>
        <h3 class="text-2xl font-black text-slate-900"><?= esc($totalChat) ?></h3>
        <p class="text-[11px] text-slate-400 mt-0.5">
          <?= !empty($selectedStudent) ? 'Pertanyaan khusus dari ' . esc($selectedStudent['nama']) : 'Total pertanyaan siswa pada mapel ' . esc($mapel ?: 'umum') ?>
        </p>
      </div>

      <div class="bg-white p-5 rounded-3xl border border-slate-200/80 shadow-xs">
        <div class="flex items-center justify-between text-slate-400 mb-2">
          <span class="text-[11px] font-extrabold uppercase tracking-wider text-slate-500">Siswa Aktif Bertanya</span>
          <div class="w-8 h-8 rounded-xl bg-blue-50 text-blue-600 flex items-center justify-center text-xs">
            <i class="fa-solid fa-users"></i>
          </div>
        </div>
        <h3 class="text-2xl font-black text-slate-900"><?= count($studentList) ?> <span class="text-xs font-semibold text-slate-400">Siswa</span></h3>
        <p class="text-[11px] text-slate-400 mt-0.5">Gunakan filter siswa untuk mengamati satu individu secara spesifik</p>
      </div>

      <!-- Kartu Evaluasi Konsep Materi yang Sering Ditanyakan -->
      <div class="bg-white p-5 rounded-3xl border border-slate-200/80 shadow-xs">
        <div class="flex items-center justify-between text-slate-400 mb-2">
          <span class="text-[11px] font-extrabold uppercase tracking-wider text-slate-500">Konsep Evaluasi Guru</span>
          <div class="w-8 h-8 rounded-xl bg-amber-50 text-amber-600 flex items-center justify-center text-xs">
            <i class="fa-solid fa-lightbulb"></i>
          </div>
        </div>
        <div class="flex flex-wrap gap-1.5 mt-1">
          <?php if (!empty($topKeywords)): ?>
            <?php foreach (array_slice($topKeywords, 0, 5) as $word => $count): ?>
              <span class="px-2.5 py-1 bg-amber-50 text-amber-800 border border-amber-200 rounded-lg text-xs font-bold inline-flex items-center gap-1">
                <i class="fa-solid fa-magnifying-glass-chart text-[9px] text-amber-600"></i>
                <?= esc(ucfirst($word)) ?> <span class="text-[10px] text-amber-600 font-normal">(<?= $count ?>x)</span>
              </span>
            <?php endforeach; ?>
          <?php else: ?>
            <span class="text-xs text-slate-400 italic">Belum cukup data konsep materi yang ditanyakan.</span>
          <?php endif; ?>
        </div>
      </div>

    </div>

    <!-- PANEL FILTER KONTROL TERPADU: PILIH KELAS & PILIH SISWA -->
    <div class="bg-white p-6 rounded-3xl border border-slate-200/80 shadow-xs mb-6">
      <div class="flex items-center justify-between pb-4 mb-4 border-b border-slate-100">
        <div class="flex items-center gap-2">
          <div class="w-8 h-8 rounded-xl bg-indigo-50 text-indigo-600 flex items-center justify-center text-xs font-bold">
            <i class="fa-solid fa-sliders"></i>
          </div>
          <div>
            <h3 class="text-xs font-black uppercase tracking-wider text-slate-800">Filter Analisis: Rombel & Rekam Jejak Siswa</h3>
            <p class="text-[11px] text-slate-400">Pilih rombongan belajar dan tentukan siswa untuk membaca rekam jejak belajarnya</p>
          </div>
        </div>

        <?php if (!empty($filterKelas) || !empty($filterSiswa) || !empty($search) || !empty($isExplicitAllKelas)): ?>
          <a href="<?= site_url('guru/monitoring-ai') ?>" class="text-[11px] font-extrabold text-rose-600 hover:text-rose-700 inline-flex items-center gap-1.5 bg-rose-50 px-3 py-1.5 rounded-xl border border-rose-100 transition">
            <i class="fa-solid fa-rotate-left"></i>
            <span>Reset Semua Filter</span>
          </a>
        <?php endif; ?>
      </div>

      <!-- Form Filter Interaktif -->
      <form action="<?= site_url('guru/monitoring-ai') ?>" method="GET" class="grid grid-cols-1 sm:grid-cols-12 gap-3.5">
        
        <!-- 1. Pilihan Kelas (Dropdown) -->
        <div class="sm:col-span-4">
          <label class="text-[11px] font-extrabold uppercase tracking-wider text-slate-500 block mb-1.5">
            <i class="fa-solid fa-school text-indigo-500 mr-1"></i> 1. Pilih Kelas / Rombel:
          </label>
          <select name="kelas" onchange="this.form.submit()" class="w-full px-3.5 py-2.5 bg-slate-50 border border-slate-200 rounded-2xl text-xs font-bold text-slate-800 focus:outline-none focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500 cursor-pointer">
            <option value="all" <?= ($filterKelas === '' || $isExplicitAllKelas || empty($filterKelas)) ? 'selected' : '' ?>>-- Semua Kelas (Seluruh Siswa) --</option>
            <?php foreach (($combinedKelas ?? $kelasList) as $k): ?>
              <option value="<?= esc($k) ?>" <?= ($filterKelas === $k) ? 'selected' : '' ?>>
                Kelas <?= esc($k) ?>
              </option>
            <?php endforeach; ?>
          </select>
        </div>

        <!-- 2. Pilihan Siswa di Kelas Tersebut -->
        <div class="sm:col-span-5">
          <label class="text-[11px] font-extrabold uppercase tracking-wider text-slate-500 block mb-1.5">
            <i class="fa-solid fa-user-graduate text-teal-600 mr-1"></i> 2. Pilih Siswa untuk Diobservasi:
          </label>
          <select name="siswa_id" onchange="this.form.submit()" class="w-full px-3.5 py-2.5 bg-slate-50 border border-slate-200 rounded-2xl text-xs font-bold text-slate-800 focus:outline-none focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500 cursor-pointer">
            <option value="">-- Semua Siswa (<?= count($studentList) ?> Siswa) --</option>
            <?php foreach ($studentList as $s): ?>
              <option value="<?= $s['id'] ?>" <?= ($filterSiswa == $s['id']) ? 'selected' : '' ?>>
                <?= esc($s['nama']) ?> (Kelas <?= esc($s['kelas']) ?> • <?= $s['total_tanya'] ?>x Tanya)
              </option>
            <?php endforeach; ?>
          </select>
        </div>

        <!-- 3. Pencarian Kata Kunci / Topik -->
        <div class="sm:col-span-3">
          <label class="text-[11px] font-extrabold uppercase tracking-wider text-slate-500 block mb-1.5">
            <i class="fa-solid fa-magnifying-glass text-slate-400 mr-1"></i> 3. Cari Kata Kunci:
          </label>
          <div class="relative">
            <input type="text" name="q" value="<?= esc($search ?? '') ?>" placeholder="Ketik kata kunci..." class="w-full pl-3.5 pr-9 py-2.5 bg-slate-50 border border-slate-200 rounded-2xl text-xs font-medium focus:outline-none focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500">
            <button type="submit" class="absolute right-2 top-1/2 -translate-y-1/2 w-7 h-7 bg-indigo-600 text-white rounded-xl flex items-center justify-center text-xs hover:bg-indigo-700 transition">
              <i class="fa-solid fa-arrow-right"></i>
            </button>
          </div>
        </div>

      </form>
    </div>

    <!-- Riwayat Chat List Table (Catatan Interaksi Siswa) -->
    <div class="bg-white rounded-3xl border border-slate-200/80 shadow-xs overflow-hidden">
      
      <div class="p-5 border-b border-slate-100 flex flex-col sm:flex-row sm:items-center justify-between gap-2">
        <div>
          <div class="flex items-center gap-2">
            <span class="w-2.5 h-2.5 rounded-full bg-emerald-500 inline-block"></span>
            <h3 class="text-sm font-black text-slate-900">
              <?= !empty($selectedStudent) ? 'Catatan Interaksi Khusus Siswa: ' . esc($selectedStudent['nama']) : 'Daftar Interaksi Siswa dengan Gemini AI' ?>
            </h3>
          </div>
          <p class="text-[11px] text-slate-400 mt-0.5">
            <?= !empty($selectedStudent) ? 'Menampilkan riwayat pertanyaan dan bimbingan yang diterima oleh siswa ini.' : 'Daftar rekam jejak konsultasi materi seluruh siswa pada mata pelajaran ' . esc($mapel ?: 'umum') ?>
          </p>
        </div>
        <span class="text-xs font-black px-3.5 py-1.5 bg-indigo-50 text-indigo-700 border border-indigo-100 rounded-xl shrink-0">
          <?= count($chatList) ?> Percakapan Terdata
        </span>
      </div>

      <?php if (!empty($chatList)): ?>
        <div class="divide-y divide-slate-100">
          <?php foreach ($chatList as $index => $item): ?>
            <div class="p-6 hover:bg-slate-50/70 transition">
              
              <!-- Identitas Siswa yang Bertanya -->
              <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-3 mb-3 bg-slate-50 p-3.5 rounded-2xl border border-slate-100">
                <div class="flex items-center gap-3">
                  <div class="w-10 h-10 rounded-2xl bg-teal-600 text-white font-black text-sm flex items-center justify-center shadow-xs shrink-0">
                    <?= strtoupper(substr($item['siswa_nama'], 0, 1)) ?>
                  </div>
                  <div>
                    <div class="flex items-center gap-2">
                      <span class="text-[9px] font-black uppercase tracking-wider text-teal-700 bg-teal-100/70 px-2 py-0.5 rounded-md border border-teal-200">
                        <i class="fa-solid fa-user-graduate mr-1"></i>Siswa
                      </span>
                      <h4 class="text-xs font-black text-slate-900"><?= esc($item['siswa_nama']) ?></h4>
                    </div>
                    <p class="text-[10px] text-slate-500 mt-0.5">
                      Kelas: <strong class="text-slate-800"><?= esc($item['kelas'] ?? '-') ?></strong> • NIS: <strong class="text-slate-800"><?= esc($item['nis'] ?? '-') ?></strong>
                    </p>
                  </div>
                </div>

                <div class="flex items-center gap-2">
                  <span class="px-3 py-1 rounded-xl text-[10px] font-black bg-indigo-50 text-indigo-700 border border-indigo-200">
                    <i class="fa-solid fa-book-bookmark text-[9px] mr-1"></i>Mapel: <?= esc($item['mapel'] ?: ($mapel ?: 'Umum')) ?>
                  </span>
                  <span class="text-[11px] text-slate-400 font-medium">
                    <i class="fa-regular fa-clock mr-1"></i><?= date('d M Y, H:i', strtotime($item['created_at'])) ?> WIB
                  </span>
                </div>
              </div>

              <!-- Isi Pertanyaan Siswa -->
              <div class="bg-indigo-50/50 border border-indigo-100/90 rounded-2xl p-4 mb-3">
                <div class="flex items-center gap-1.5 text-[11px] font-black text-indigo-900 mb-1.5">
                  <i class="fa-solid fa-circle-question text-indigo-600"></i>
                  <span>Pertanyaan yang Diajukan Siswa kepada AI:</span>
                </div>
                <div class="bg-white/90 p-3 rounded-xl border border-indigo-100 text-xs text-slate-800 font-bold leading-relaxed">
                  "<?= esc($item['prompt']) ?>"
                </div>
              </div>

              <!-- Cuplikan Bimbingan Gemini AI -->
              <div class="bg-slate-50/90 border border-slate-200/80 rounded-2xl p-4">
                <div class="flex items-center justify-between mb-2">
                  <div class="flex items-center gap-1.5 text-[11px] font-black text-teal-800">
                    <i class="fa-solid fa-sparkles text-teal-600"></i>
                    <span>Tanggapan Bimbingan Gemini AI kepada Siswa:</span>
                  </div>
                  <button type="button" onclick="toggleDetail('chat-<?= $index ?>')" class="text-[11px] font-black text-indigo-600 hover:text-indigo-800 inline-flex items-center gap-1 bg-white px-3 py-1 rounded-xl border border-slate-200 shadow-2xs transition">
                    <span id="btn-text-chat-<?= $index ?>">Lihat Lengkap</span> <i class="fa-solid fa-chevron-down text-[9px]"></i>
                  </button>
                </div>
                
                <!-- Singkat -->
                <p id="short-chat-<?= $index ?>" class="text-xs text-slate-600 line-clamp-2 leading-relaxed font-medium">
                  <?= esc(strip_tags($item['response'])) ?>
                </p>

                <!-- Lengkap (Hidden by default) -->
                <div id="full-chat-<?= $index ?>" class="hidden text-xs text-slate-700 leading-relaxed whitespace-pre-wrap mt-3 pt-3 border-t border-slate-200 font-medium">
                  <?= esc($item['response']) ?>
                </div>
              </div>

            </div>
          <?php endforeach; ?>
        </div>
      <?php else: ?>
        <div class="p-16 text-center">
          <div class="w-16 h-16 mx-auto rounded-3xl bg-slate-100 text-slate-400 flex items-center justify-center text-2xl mb-4">
            <i class="fa-regular fa-comments"></i>
          </div>
          <h4 class="text-sm font-bold text-slate-700">Belum Ada Riwayat Obrolan</h4>
          <p class="text-xs text-slate-400 mt-1 max-w-sm mx-auto leading-relaxed">
            <?= !empty($selectedStudent) ? 'Siswa ini belum pernah mengajukan pertanyaan mandiri kepada Gemini AI.' : 'Belum ada catatan pertanyaan siswa pada kriteria filter yang Anda pilih.' ?>
          </p>
          <div class="mt-4">
            <a href="<?= site_url('guru/monitoring-ai?kelas=all') ?>" class="inline-flex items-center gap-1.5 px-4 py-2 bg-indigo-50 text-indigo-700 rounded-xl text-xs font-bold hover:bg-indigo-100 transition border border-indigo-200">
              <i class="fa-solid fa-list-check text-xs"></i>
              <span>Lihat Semua Siswa (Seluruh Kelas)</span>
            </a>
          </div>
        </div>
      <?php endif; ?>

    </div>

  </main>

  <script>
    function toggleDetail(id) {
      const full = document.getElementById('full-' + id);
      const short = document.getElementById('short-' + id);
      const btnText = document.getElementById('btn-text-' + id);

      if (full.classList.contains('hidden')) {
        full.classList.remove('hidden');
        short.classList.add('hidden');
        btnText.innerText = 'Sembunyikan';
      } else {
        full.classList.add('hidden');
        short.classList.remove('hidden');
        btnText.innerText = 'Lihat Lengkap';
      }
    }
  </script>
</body>
</html>
