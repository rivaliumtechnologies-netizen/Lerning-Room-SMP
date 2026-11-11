<?php
  $role = $userRole ?? session()->get('user_role');
  $isGuru = ($role === 'guru');
  $isSiswa = ($role === 'siswa');
  
  $accentGradient = $isGuru ? 'from-blue-600 to-indigo-600' : 'from-teal-600 to-emerald-500';
  $activeMenuClass = $isGuru ? 'bg-blue-50 text-blue-600 font-bold' : 'bg-teal-50 text-teal-700 font-bold';
  $badgeTheme = $isGuru ? 'bg-blue-50 text-blue-700 border-blue-200' : 'bg-teal-50 text-teal-700 border-teal-200';
  $primaryBtnClass = $isGuru ? 'bg-blue-600 hover:bg-blue-700 shadow-blue-500/20' : 'bg-teal-600 hover:bg-teal-700 shadow-teal-500/20';
  $ringFocusClass = $isGuru ? 'focus-within:ring-blue-500/20 focus-within:border-blue-500' : 'focus-within:ring-teal-500/20 focus-within:border-teal-500';
  $roleIcon = $isGuru ? 'fa-chalkboard-user' : 'fa-book-open-reader';
  $pageTitle = $isGuru ? 'Gemini AI - Referensi untuk Mengajar - Room Learning SMP' : 'Model Gemini AI Pembelajaran Terpadu - Room Learning SMP';
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?= $pageTitle ?></title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/marked/marked.min.js"></script>
  <!-- KaTeX for math rendering -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/katex@0.16.9/dist/katex.min.css">
  <script defer src="https://cdn.jsdelivr.net/npm/katex@0.16.9/dist/katex.min.js"></script>
  <script defer src="https://cdn.jsdelivr.net/npm/katex@0.16.9/dist/contrib/auto-render.min.js"></script>
  <style>
    body { font-family: 'Plus Jakarta Sans', sans-serif; }
    .custom-scroll::-webkit-scrollbar { width: 6px; height: 6px; }
    .custom-scroll::-webkit-scrollbar-track { background: transparent; }
    .custom-scroll::-webkit-scrollbar-thumb { background: #cbd5e1; border-radius: 9999px; }
    .custom-scroll::-webkit-scrollbar-thumb:hover { background: #94a3b8; }
    /* Markdown formatting */
    .ai-markdown p { margin-bottom: 0.75rem; }
    .ai-markdown p:last-child { margin-bottom: 0; }
    .ai-markdown ul { list-style-type: disc; margin-left: 1.25rem; margin-bottom: 0.75rem; }
    .ai-markdown ol { list-style-type: decimal; margin-left: 1.25rem; margin-bottom: 0.75rem; }
    .ai-markdown li { margin-bottom: 0.25rem; }
    .ai-markdown strong { color: #0f172a; font-weight: 700; }
    .ai-markdown code { background-color: #f1f5f9; padding: 0.15rem 0.35rem; border-radius: 0.25rem; font-size: 0.8rem; font-family: monospace; }
    .ai-markdown h1, .ai-markdown h2, .ai-markdown h3, .ai-markdown h4 { font-weight: 800; color: #0f172a; margin-top: 1rem; margin-bottom: 0.5rem; }
    .ai-markdown h1 { font-size: 1.2rem; }
    .ai-markdown h2 { font-size: 1.05rem; }
    .ai-markdown h3 { font-size: 0.95rem; }
    .ai-markdown hr { border: 0; border-top: 1px solid #e2e8f0; margin: 1rem 0; }
    .ai-markdown table { width: 100%; border-collapse: collapse; margin: 0.85rem 0; font-size: 0.8rem; border: 1px solid #cbd5e1; border-radius: 0.5rem; overflow: hidden; }
    .ai-markdown th { background-color: #f1f5f9; font-weight: 700; color: #1e293b; padding: 0.6rem 0.75rem; border: 1px solid #cbd5e1; text-align: left; }
    .ai-markdown td { padding: 0.5rem 0.75rem; border: 1px solid #cbd5e1; color: #334155; }
    .ai-markdown tr:nth-child(even) td { background-color: #f8fafc; }
    .katex-display { margin: 1rem 0; overflow-x: auto; overflow-y: hidden; padding: 0.5rem 0; }
  </style>
</head>
<body class="bg-slate-50/70 text-slate-800 flex h-screen overflow-hidden">

  <!-- Sidebar Navigasi Dinamis Sesuai Peran -->
  <aside class="w-64 bg-white border-r border-slate-200/80 flex flex-col justify-between shrink-0 p-4 z-20 shadow-sm">
    <div>
      <!-- Brand Header -->
      <div class="p-3 mb-4 flex items-center gap-3">
        <div class="w-10 h-10 bg-gradient-to-tr <?= $accentGradient ?> text-white rounded-2xl flex items-center justify-center font-black text-base shadow-md">
          <i class="fa-solid fa-graduation-cap"></i>
        </div>
        <div>
          <h2 class="font-black text-sm text-slate-800 leading-tight">Room Learning</h2>
          <span class="text-[10px] font-extrabold uppercase tracking-wider <?= $isSiswa ? 'text-teal-600 bg-teal-50' : 'text-blue-600 bg-blue-50' ?> px-2 py-0.5 rounded-md">
            <?= $isSiswa ? 'Siswa SMP' : ($role === 'guru' ? 'Guru Pengampu' : 'Administrator') ?>
          </span>
        </div>
      </div>

      <nav class="space-y-1">
        <?php
          if ($role === 'guru') {
              $menu = [
                  'guru/dashboard'   => ['fa-solid fa-house', 'Beranda'],
                  'guru/kelas-siswa' => ['fa-solid fa-users-rectangle', 'Kelas & Siswa'],
                  'guru/jadwal'      => ['fa-regular fa-calendar-days', 'Jadwal Belajar'],
                  'guru/materi'      => ['fa-regular fa-book-open', 'Kelola Materi'],
                  'guru/tugas'         => ['fa-regular fa-clipboard', 'Kelola Tugas'],
                  'guru/nilai'         => ['fa-regular fa-award', 'Nilai & Leger'],
                  'guru/monitoring-ai' => ['fa-solid fa-chart-line', 'Monitoring AI Siswa'],
                  'guru/profil'        => ['fa-regular fa-user', 'Profil'],
              ];
          } else {
              $menu = [
                  'siswa/dashboard' => ['fa-solid fa-house', 'Beranda Belajar'],
                  'siswa/jadwal'    => ['fa-regular fa-calendar-days', 'Jadwal Kelas Saya'],
                  'siswa/materi'    => ['fa-regular fa-book-open', 'Materi Pelajaran'],
                  'siswa/tugas'     => ['fa-regular fa-clipboard-check', 'Tugas & Pengumpulan'],
                  'siswa/profil'    => ['fa-regular fa-user', 'Profil Saya'],
              ];
          }
        ?>

        <?php foreach ($menu as $url => $item): ?>
          <a href="<?= site_url($url) ?>" class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl text-slate-600 hover:bg-slate-50 hover:text-slate-900 font-semibold text-xs transition">
            <i class="<?= $item[0] ?> w-4 text-center"></i>
            <span><?= $item[1] ?></span>
          </a>
        <?php endforeach; ?>

        <!-- Active Gemini AI Menu -->
        <a href="<?= site_url('gemini') ?>" class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl <?= $activeMenuClass ?> text-xs shadow-sm transition">
          <i class="fa-solid <?= $isGuru ? 'fa-wand-magic-sparkles text-blue-600' : 'fa-robot text-teal-500' ?> w-4 text-center"></i>
          <span><?= $isGuru ? 'Referensi Mengajar' : 'Gemini Belajar' ?></span>
        </a>
      </nav>

      <!-- User Mini Card -->
      <div class="mt-6 p-3 rounded-2xl bg-slate-50 border border-slate-100">
        <p class="text-[10px] font-bold uppercase tracking-wider text-slate-400"><?= $isGuru ? 'Referensi Mengajar Aktif' : 'Mode Belajar Aktif' ?></p>
        <p class="text-xs font-extrabold text-slate-800 mt-0.5 truncate"><?= esc(session()->get('user_name') ?? 'Pengguna') ?></p>
        <span class="inline-flex items-center gap-1 mt-1 text-[9px] font-bold px-2 py-0.5 rounded-md <?= $badgeTheme ?>">
          <i class="fa-solid <?= $roleIcon ?> text-[10px]"></i>
          <?= $isGuru ? 'Asisten Kurikulum Merdeka' : 'Mode Belajar Terbimbing' ?>
        </span>
      </div>
    </div>

    <a href="<?= site_url('logout') ?>" class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl text-rose-500 hover:bg-rose-50 hover:text-rose-600 font-bold text-xs transition">
      <i class="fa-solid fa-right-from-bracket w-4 text-center"></i>
      <span>Keluar Akun</span>
    </a>
  </aside>

  <!-- Area Chat Gemini AI (Full Workspace) -->
  <main class="flex-1 bg-white flex flex-col h-full overflow-hidden relative">
    
    <!-- Top Bar Header -->
    <div class="h-16 border-b border-slate-100 px-6 lg:px-8 flex items-center justify-between shrink-0 bg-white/90 backdrop-blur-sm z-10">
      <div class="flex items-center gap-3">
        <div class="w-10 h-10 rounded-2xl bg-gradient-to-tr <?= $accentGradient ?> text-white flex items-center justify-center font-bold text-base shadow-sm">
          <i class="fa-solid <?= $roleIcon ?> text-white"></i>
        </div>
        <div>
          <div class="flex items-center gap-2">
            <h1 class="font-black text-sm text-slate-900 leading-tight">
              <?= $isGuru ? 'Gemini AI - Referensi untuk Mengajar' : 'Model Gemini AI Pembelajaran Terpadu' ?>
            </h1>
            <span class="inline-flex items-center gap-1 text-[9px] <?= $badgeTheme ?> px-2.5 py-0.5 rounded-full font-black border">
              <i class="fa-solid fa-check text-[9px]"></i> <?= $isGuru ? 'Referensi Mengajar Aktif' : 'Mode Belajar Aktif' ?>
            </span>
          </div>
          <p class="text-[11px] text-slate-400 font-medium flex items-center gap-1.5 mt-0.5">
            <span class="w-2 h-2 rounded-full <?= $isGuru ? 'bg-blue-500' : 'bg-emerald-500' ?> inline-block animate-pulse"></span>
            <?= $isGuru ? 'Asisten Perencanaan Pembelajaran, Modul Ajar, Ide Praktikum & Soal Evaluasi' : 'Tutor Socratic Bertahap • Kurikulum Merdeka SMP' ?>
          </p>
        </div>
      </div>

      <div class="flex items-center gap-2">
        <button onclick="clearFullChat()" class="inline-flex items-center gap-1.5 text-xs text-slate-500 hover:text-slate-800 bg-slate-100 hover:bg-slate-200 px-3.5 py-1.5 rounded-xl font-bold transition">
          <i class="fa-regular fa-trash-can text-[11px]"></i>
          <span>Percakapan Baru</span>
        </button>
      </div>
    </div>

    <!-- Area Percakapan (Scrollable) -->
    <div id="fullChatScroll" class="flex-1 overflow-y-auto p-6 md:p-8 custom-scroll space-y-6">
      
      <!-- Greeting Awal (Tampil jika belum ada pesan) -->
      <div id="fullChatWelcome" class="max-w-2xl mx-auto text-center pt-4 pb-2">
        <div class="w-16 h-16 mx-auto rounded-3xl bg-gradient-to-tr <?= $accentGradient ?> text-white flex items-center justify-center text-2xl shadow-xl <?= $isGuru ? 'shadow-blue-500/10' : 'shadow-teal-500/10' ?> mb-4">
          <i class="fa-solid <?= $roleIcon ?>"></i>
        </div>
        
        <div class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full <?= $badgeTheme ?> text-[11px] font-black uppercase tracking-wider mb-2 border">
          <i class="fa-solid fa-sparkles <?= $isGuru ? 'text-blue-600' : 'text-teal-600' ?>"></i>
          <?= $isGuru ? 'Asisten Referensi Mengajar (Kurikulum Merdeka)' : 'Model Belajar Terbimbing (Socratic Coach)' ?>
        </div>

        <h2 class="text-2xl sm:text-3xl font-black text-slate-900 tracking-tight">
          Halo, <?= esc(session()->get('user_name') ?? ($isGuru ? 'Bapak/Ibu Guru' : 'Sahabat Belajar')) ?>! <?= $isGuru ? '👨‍🏫' : '👋' ?>
        </h2>
        <p class="text-slate-600 text-sm font-semibold mt-1">
          <?= $isGuru ? 'Apa referensi mengajar yang ingin Anda rumuskan hari ini?' : 'Apa yang ingin kamu pelajari hari ini?' ?>
        </p>
        <p class="text-xs text-slate-500 mt-1.5 max-w-lg mx-auto leading-relaxed">
          <?php if ($isGuru): ?>
            Dapatkan inspirasi Modul Ajar / RPP, diferensiasi konten & proses, rubrik asesmen autentik, studi kasus kontekstual, hingga butir soal HOTS Kurikulum Merdeka secara terstruktur.
          <?php else: ?>
            Tanyakan soal latihan atau konsep materi! Alih-alih memberikan jawaban instan, saya akan memandumu memahami konsep dan menyelesaikannya <strong>langkah demi langkah</strong> sampai kamu bisa menjawabnya sendiri.
          <?php endif; ?>
        </p>

        <!-- Quick Suggestion Cards: Sesuai Mode Guru vs Siswa -->
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 mt-6 text-left max-w-xl mx-auto">
          <?php if ($isGuru): ?>
            
            <button onclick="sendQuickPrompt('Buatkan rancangan Modul Ajar Kurikulum Merdeka mata pelajaran IPA kelas 7 materi Ekosistem dan Interaksi Makhluk Hidup dengan pendekatan diferensiasi proses dan produk.')" class="p-3.5 rounded-2xl bg-slate-50 hover:bg-blue-50 border border-slate-200/80 hover:border-blue-300 transition group text-xs text-slate-700 shadow-xs">
              <div class="font-bold text-slate-800 group-hover:text-blue-700 flex items-center gap-2 mb-1">
                <i class="fa-solid fa-clipboard-list text-blue-600"></i>
                <span>Rancangan Modul Ajar IPA</span>
              </div>
              <p class="text-slate-500 text-[11px] leading-relaxed">Modul Kurikulum Merdeka, TP/ATP & diferensiasi proses.</p>
            </button>

            <button onclick="sendQuickPrompt('Buatkan 3 butir soal HOTS Matematika kelas 8 materi SPLDV kontekstual (kehidupan sehari-hari) lengkap dengan kunci jawaban, langkah penyelesaian, dan rubrik penskoran analitis.')" class="p-3.5 rounded-2xl bg-slate-50 hover:bg-blue-50 border border-slate-200/80 hover:border-blue-300 transition group text-xs text-slate-700 shadow-xs">
              <div class="font-bold text-slate-800 group-hover:text-blue-700 flex items-center gap-2 mb-1">
                <i class="fa-solid fa-file-signature text-indigo-600"></i>
                <span>Soal HOTS & Rubrik Penskoran</span>
              </div>
              <p class="text-slate-500 text-[11px] leading-relaxed">Soal pemecahan masalah kontekstual & panduan rubrik asesmen.</p>
            </button>

            <button onclick="sendQuickPrompt('Bagaimana strategi pembelajaran berdiferensiasi untuk materi Teks Prosedur Bahasa Indonesia bagi siswa dengan variasi minat dan kemampuan baca di SMP?')" class="p-3.5 rounded-2xl bg-slate-50 hover:bg-blue-50 border border-slate-200/80 hover:border-blue-300 transition group text-xs text-slate-700 shadow-xs">
              <div class="font-bold text-slate-800 group-hover:text-blue-700 flex items-center gap-2 mb-1">
                <i class="fa-solid fa-layer-group text-sky-600"></i>
                <span>Strategi Diferensiasi Kelas</span>
              </div>
              <p class="text-slate-500 text-[11px] leading-relaxed">Teknik akomodasi siswa berkemampuan beragam di kelas.</p>
            </button>

            <button onclick="sendQuickPrompt('Berikan 3 ide kegiatan apersepsi / ice breaking kontekstual dan 1 ide proyek sederhana bertema \'Gaya Hidup Berkelanjutan\' untuk siswa SMP.')" class="p-3.5 rounded-2xl bg-slate-50 hover:bg-blue-50 border border-slate-200/80 hover:border-blue-300 transition group text-xs text-slate-700 shadow-xs">
              <div class="font-bold text-slate-800 group-hover:text-blue-700 flex items-center gap-2 mb-1">
                <i class="fa-solid fa-lightbulb text-amber-600"></i>
                <span>Apersepsi & Proyek P5 SMP</span>
              </div>
              <p class="text-slate-500 text-[11px] leading-relaxed">Ice breaking seru dan rancangan proyek Profil Pelajar Pancasila.</p>
            </button>

          <?php else: ?>

            <button onclick="sendQuickPrompt('Jelaskan perbedaan sel hewan dan sel tumbuhan beserta fungsinya dalam ekosistem makhluk hidup!', 'IPA')" class="p-3.5 rounded-2xl bg-slate-50 hover:bg-teal-50 border border-slate-200/80 hover:border-teal-300 transition group text-xs text-slate-700 shadow-xs">
              <div class="font-bold text-slate-800 group-hover:text-teal-700 flex items-center gap-2 mb-1">
                <i class="fa-solid fa-atom text-emerald-600"></i>
                <span>IPA - Biologi Sel</span>
              </div>
              <p class="text-slate-500 text-[11px] leading-relaxed">Perbedaan dinding sel, kloroplas, dan organel sel lainnya.</p>
            </button>

            <button onclick="sendQuickPrompt('Bagaimana cara mudah membedakan Simple Past Tense dan Present Perfect Tense dalam Bahasa Inggris beserta contoh kalimatnya?', 'Bahasa Inggris')" class="p-3.5 rounded-2xl bg-slate-50 hover:bg-teal-50 border border-slate-200/80 hover:border-teal-300 transition group text-xs text-slate-700 shadow-xs">
              <div class="font-bold text-slate-800 group-hover:text-teal-700 flex items-center gap-2 mb-1">
                <i class="fa-solid fa-language text-sky-600"></i>
                <span>Bahasa Inggris - Tenses</span>
              </div>
              <p class="text-slate-500 text-[11px] leading-relaxed">Pola kalimat, kata keterangan waktu, dan latihan contoh.</p>
            </button>

            <button onclick="sendQuickPrompt('Bagaimana cara menghitung rata-rata gabungan jika diketahui nilai rata-rata dua kelas yang berbeda jumlah siswanya?', 'Matematika')" class="p-3.5 rounded-2xl bg-slate-50 hover:bg-teal-50 border border-slate-200/80 hover:border-teal-300 transition group text-xs text-slate-700 shadow-xs">
              <div class="font-bold text-slate-800 group-hover:text-teal-700 flex items-center gap-2 mb-1">
                <i class="fa-solid fa-calculator text-teal-600"></i>
                <span>Matematika - Statistika</span>
              </div>
              <p class="text-slate-500 text-[11px] leading-relaxed">Penyelesaian soal rata-rata gabungan langkah demi langkah.</p>
            </button>

            <button onclick="sendQuickPrompt('Jelaskan faktor-faktor yang mempengaruhi interaksi antarruang dan dampaknya bagi perekonomian masyarakat Indonesia!', 'IPS')" class="p-3.5 rounded-2xl bg-slate-50 hover:bg-teal-50 border border-slate-200/80 hover:border-teal-300 transition group text-xs text-slate-700 shadow-xs">
              <div class="font-bold text-slate-800 group-hover:text-teal-700 flex items-center gap-2 mb-1">
                <i class="fa-solid fa-earth-asia text-amber-600"></i>
                <span>IPS - Interaksi Antarruang</span>
              </div>
              <p class="text-slate-500 text-[11px] leading-relaxed">Konsep saling melengkapi, kesempatan antara, dan kemudahan transfer.</p>
            </button>

          <?php endif; ?>
        </div>
      </div>

      <!-- Container Pesan Chat -->
      <div id="fullChatMessageList" class="max-w-3xl mx-auto space-y-6"></div>

      <!-- Indikator Loading / Mengetik -->
      <div id="fullChatThinking" class="hidden max-w-3xl mx-auto flex items-start gap-3 <?= $isGuru ? 'bg-blue-50/70 border-blue-100' : 'bg-teal-50/70 border-teal-100' ?> p-4 rounded-3xl border w-fit">
        <div class="w-8 h-8 rounded-xl <?= $isGuru ? 'bg-blue-600' : 'bg-teal-600' ?> text-white flex items-center justify-center text-xs shrink-0 shadow-sm">
          <i class="fa-solid <?= $roleIcon ?>"></i>
        </div>
        <div class="flex items-center gap-1.5 py-1">
          <span class="w-2 h-2 rounded-full <?= $isGuru ? 'bg-blue-600' : 'bg-teal-600' ?> animate-bounce"></span>
          <span class="w-2 h-2 rounded-full <?= $isGuru ? 'bg-blue-600' : 'bg-teal-600' ?> animate-bounce" style="animation-delay: 0.15s"></span>
          <span class="w-2 h-2 rounded-full <?= $isGuru ? 'bg-blue-600' : 'bg-teal-600' ?> animate-bounce" style="animation-delay: 0.3s"></span>
          <span class="text-xs ml-2 font-bold <?= $isGuru ? 'text-blue-800' : 'text-teal-800' ?>">
            <?= $isGuru ? 'Asisten Mengajar sedang merumuskan referensi...' : 'Mode Belajar sedang merangkai panduan...' ?>
          </span>
        </div>
      </div>

    </div>

    <!-- Input Bar di Bawah -->
    <div class="p-4 md:p-6 border-t border-slate-100 bg-white shrink-0">
      <div class="max-w-3xl mx-auto">
        <form id="fullGeminiForm" onsubmit="handleFullChatSend(event)" class="relative">
          
          <div class="bg-white border border-slate-200 rounded-3xl p-3 shadow-md <?= $ringFocusClass ?> transition">
            <textarea id="fullPromptInput" rows="2" placeholder="<?= $isGuru ? 'Tanyakan referensi materi, modul ajar, ide mengajar, atau buat rubrik penilaian...' : 'Apa yang ingin kamu pelajari? Tanyakan soal latihan atau konsep materi...' ?>" required class="w-full bg-transparent text-xs sm:text-sm text-slate-800 placeholder:text-slate-400 focus:outline-none resize-none custom-scroll py-1 px-2 leading-relaxed"></textarea>
            
            <div class="flex items-center justify-between pt-2 px-1">
              <!-- Left: + and Mode pill -->
              <div class="flex items-center gap-2">
                <button type="button" onclick="document.getElementById('fullPromptInput').focus()" class="w-7 h-7 rounded-full bg-slate-100 hover:bg-slate-200 text-slate-600 flex items-center justify-center text-xs font-bold transition">
                  <i class="fa-solid fa-plus text-[10px]"></i>
                </button>
                <div class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-slate-100 text-slate-800 text-xs font-extrabold border border-slate-200">
                  <i class="fa-solid <?= $roleIcon ?> <?= $isGuru ? 'text-blue-600' : 'text-teal-600' ?> text-xs"></i>
                  <span><?= $isGuru ? 'Referensi Mengajar' : 'Belajar' ?></span>
                </div>
                
                <?php if ($isSiswa): ?>
                <!-- Dropdown Pilihan Mata Pelajaran untuk Siswa -->
                <div class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full bg-teal-50 text-teal-800 text-xs font-bold border border-teal-200">
                  <i class="fa-solid fa-book-bookmark text-teal-600 text-[11px]"></i>
                  <select id="mapelSelect" class="bg-transparent text-xs font-extrabold text-teal-900 focus:outline-none cursor-pointer">
                    <option value="Matematika">Matematika</option>
                    <option value="IPA">Ilmu Pengetahuan Alam (IPA)</option>
                    <option value="Bahasa Indonesia">Bahasa Indonesia</option>
                    <option value="Bahasa Inggris">Bahasa Inggris</option>
                    <option value="IPS">Ilmu Pengetahuan Sosial (IPS)</option>
                    <option value="Informatika">Informatika</option>
                    <option value="Pendidikan Pancasila">Pendidikan Pancasila (PPKn)</option>
                    <option value="Seni Budaya">Seni Budaya</option>
                    <option value="PJOK">PJOK</option>
                    <option value="Prakarya">Prakarya</option>
                    <option value="Umum">Materi Umum</option>
                  </select>
                </div>
                <?php endif; ?>
              </div>

              <!-- Right: Model Flash badge & Submit button -->
              <div class="flex items-center gap-2.5">
                <div class="inline-flex items-center gap-1 text-[11px] font-bold text-slate-500 px-2 py-1 bg-slate-50 rounded-lg">
                  <span>Flash 3.5</span>
                  <i class="fa-solid fa-chevron-down text-[9px] text-slate-400"></i>
                </div>
                <button type="submit" id="fullSendBtn" class="w-8 h-8 rounded-full <?= $primaryBtnClass ?> text-white flex items-center justify-center font-bold text-xs shadow-md transition disabled:opacity-50 shrink-0">
                  <i class="fa-solid fa-arrow-up text-xs"></i>
                </button>
              </div>
            </div>
          </div>

          <div class="flex items-center justify-between mt-2 px-2 text-[10px] text-slate-400">
            <span class="flex items-center gap-1">
              <i class="fa-solid fa-sparkles <?= $isGuru ? 'text-blue-600' : 'text-teal-600' ?>"></i>
              <?= $isGuru ? 'Gemini AI • Referensi & Asisten Mengajar Kurikulum Merdeka' : 'Model Gemini AI Pembelajaran Terpadu • Mode Belajar' ?>
            </span>
            <span class="hidden sm:inline">Tekan Enter untuk kirim, Shift+Enter untuk baris baru</span>
          </div>
        </form>
      </div>
    </div>

  </main>

  <!-- Script Chat Interaktif dengan Multi-Turn History & KaTeX -->
  <script>
    let csrfToken = "<?= csrf_hash() ?>";
    let conversationHistory = []; // Menyimpan konteks tanya-jawab agar AI mengingat langkah sebelumnya

    function sendQuickPrompt(promptText, mapelOpt) {
      if (mapelOpt) {
        const mapelEl = document.getElementById('mapelSelect');
        if (mapelEl) {
          mapelEl.value = mapelOpt;
        }
      }
      document.getElementById('fullPromptInput').value = promptText;
      handleFullChatSend(new Event('submit'));
    }

    function clearFullChat() {
      conversationHistory = [];
      document.getElementById('fullChatMessageList').innerHTML = '';
      document.getElementById('fullChatWelcome').classList.remove('hidden');
    }

    function renderMarkdownWithMath(rawText) {
      if (!rawText) return '';
      if (typeof marked === 'undefined') return escapeHtml(rawText);

      const mathBlocks = [];

      // 1. Amankan blok matematika $$...$$ dan \[...\] agar backslash LaTeX tidak dihilangkan oleh parser markdown
      let safeText = rawText.replace(/(\$\$[\s\S]*?\$\$|\\\[[\s\S]*?\\\])/g, function(match) {
        mathBlocks.push(match);
        return `@@MATH_BLOCK_${mathBlocks.length - 1}@@`;
      });

      // 2. Amankan inline math \(...\) dan $...$
      safeText = safeText.replace(/(\\\([\s\S]*?\\\)|(\$([^\$\n\r]+?)\$))/g, function(match) {
        mathBlocks.push(match);
        return `@@MATH_BLOCK_${mathBlocks.length - 1}@@`;
      });

      // 3. Parse markdown dengan marked
      let html = marked.parse(safeText);

      // 4. Kembalikan blok matematika utuh
      html = html.replace(/@@MATH_BLOCK_(\d+)@@/g, function(match, id) {
        const idx = parseInt(id, 10);
        return mathBlocks[idx] !== undefined ? mathBlocks[idx] : match;
      });

      return html;
    }

    function appendMessage(sender, text) {
      const list = document.getElementById('fullChatMessageList');
      const container = document.createElement('div');

      if (sender === 'user') {
        container.className = "flex flex-col items-end space-y-1";

        const bubble = document.createElement('div');
        bubble.className = "bg-slate-100 text-slate-800 rounded-3xl rounded-br-sm px-5 py-3 text-xs sm:text-sm max-w-[85%] leading-relaxed font-normal shadow-xs whitespace-pre-wrap";
        bubble.textContent = text;
        container.appendChild(bubble);

        const actions = document.createElement('div');
        actions.className = "flex items-center gap-2 text-slate-400 text-[11px] px-2";

        const copyBtn = document.createElement('button');
        copyBtn.title = "Salin Teks";
        copyBtn.className = "hover:text-slate-600 transition";
        copyBtn.innerHTML = '<i class="fa-regular fa-copy"></i>';
        copyBtn.addEventListener('click', () => {
          navigator.clipboard.writeText(text);
          copyBtn.innerHTML = '<i class="fa-solid fa-check text-emerald-600"></i>';
          setTimeout(() => { copyBtn.innerHTML = '<i class="fa-regular fa-copy"></i>'; }, 1500);
        });
        actions.appendChild(copyBtn);

        const editBtn = document.createElement('button');
        editBtn.title = "Edit Pertanyaan";
        editBtn.className = "hover:text-slate-600 transition";
        editBtn.innerHTML = '<i class="fa-solid fa-pen text-[10px]"></i>';
        editBtn.addEventListener('click', () => {
          editPrompt(text);
        });
        actions.appendChild(editBtn);

        container.appendChild(actions);
      } else {
        container.className = "flex flex-col space-y-2";

        const contentDiv = document.createElement('div');
        contentDiv.className = "text-slate-800 text-xs sm:text-sm leading-relaxed ai-markdown max-w-3xl pr-4";
        contentDiv.innerHTML = renderMarkdownWithMath(text);
        container.appendChild(contentDiv);

        const actions = document.createElement('div');
        actions.className = "flex items-center gap-3 text-slate-400 text-xs pt-1 px-1";

        const thumbUp = document.createElement('button');
        thumbUp.title = "Membantu";
        thumbUp.className = "hover:text-teal-600 transition";
        thumbUp.innerHTML = '<i class="fa-regular fa-thumbs-up"></i>';
        thumbUp.addEventListener('click', () => {
          thumbUp.classList.toggle('text-teal-600');
        });
        actions.appendChild(thumbUp);

        const thumbDown = document.createElement('button');
        thumbDown.title = "Kurang membantu";
        thumbDown.className = "hover:text-rose-500 transition";
        thumbDown.innerHTML = '<i class="fa-regular fa-thumbs-down"></i>';
        thumbDown.addEventListener('click', () => {
          thumbDown.classList.toggle('text-rose-500');
        });
        actions.appendChild(thumbDown);

        const copyBtn = document.createElement('button');
        copyBtn.title = "Salin Jawaban";
        copyBtn.className = "hover:text-slate-700 transition";
        copyBtn.innerHTML = '<i class="fa-regular fa-copy"></i>';
        copyBtn.addEventListener('click', () => {
          navigator.clipboard.writeText(text);
          copyBtn.innerHTML = '<i class="fa-solid fa-check text-emerald-600"></i>';
          setTimeout(() => { copyBtn.innerHTML = '<i class="fa-regular fa-copy"></i>'; }, 1500);
        });
        actions.appendChild(copyBtn);

        container.appendChild(actions);
      }

      list.appendChild(container);

      // Render formula LaTeX dengan KaTeX
      if (sender === 'ai' && typeof renderMathInElement !== 'undefined') {
        renderMathInElement(container, {
          delimiters: [
            {left: '$$', right: '$$', display: true},
            {left: '$', right: '$', display: false},
            {left: '\\(', right: '\\)', display: false},
            {left: '\\[', right: '\\]', display: true}
          ],
          throwOnError: false
        });
      }

      scrollFullBottom();
    }

    function scrollFullBottom() {
      const scroll = document.getElementById('fullChatScroll');
      scroll.scrollTop = scroll.scrollHeight;
    }

    function editPrompt(txt) {
      document.getElementById('fullPromptInput').value = txt;
      document.getElementById('fullPromptInput').focus();
    }

    async function handleFullChatSend(e) {
      if (e && e.preventDefault) e.preventDefault();
      const input = document.getElementById('fullPromptInput');
      const prompt = input.value.trim();
      if (!prompt) return;

      document.getElementById('fullChatWelcome').classList.add('hidden');
      appendMessage('user', prompt);
      input.value = '';

      const thinking = document.getElementById('fullChatThinking');
      const sendBtn = document.getElementById('fullSendBtn');
      thinking.classList.remove('hidden');
      sendBtn.disabled = true;
      scrollFullBottom();

      try {
        const mapelEl = document.getElementById('mapelSelect');
        const selectedMapel = mapelEl ? mapelEl.value : '';

        const bodyParams = new URLSearchParams();
        bodyParams.append('prompt', prompt);
        bodyParams.append('mapel', selectedMapel);
        bodyParams.append('history', JSON.stringify(conversationHistory));
        bodyParams.append('<?= csrf_token() ?>', csrfToken);

        const res = await fetch('<?= site_url('gemini/ask') ?>', {
          method: 'POST',
          headers: {
            'Content-Type': 'application/x-www-form-urlencoded',
            'X-Requested-With': 'XMLHttpRequest',
            'X-CSRF-TOKEN': csrfToken
          },
          body: bodyParams
        });

        const data = await res.json();
        if (data.csrf_token) {
          csrfToken = data.csrf_token;
        }

        thinking.classList.add('hidden');
        sendBtn.disabled = false;

        if (data.success) {
          // Rekam percakapan ke memori lokal sesi ini
          conversationHistory.push({ role: 'user', parts: [{ text: prompt }] });
          conversationHistory.push({ role: 'model', parts: [{ text: data.text }] });

          appendMessage('ai', data.text);
        } else {
          appendMessage('ai', `⚠️ ${data.message || 'Terjadi kesalahan saat memproses jawaban.'}`);
        }
      } catch (err) {
        thinking.classList.add('hidden');
        sendBtn.disabled = false;
        appendMessage('ai', '⚠️ Gagal terhubung ke server.');
      }
    }

    document.getElementById('fullPromptInput').addEventListener('keydown', function(e) {
      if (e.key === 'Enter' && !e.shiftKey) {
        e.preventDefault();
        document.getElementById('fullGeminiForm').dispatchEvent(new Event('submit', { cancelable: true }));
      }
    });

    function escapeHtml(text) {
      const map = { '&': '&amp;', '<': '&lt;', '>': '&gt;', '"': '&quot;', "'": '&#039;' };
      return text.replace(/[&<>"']/g, m => map[m]);
    }

    function escapeJsString(str) {
      return str.replace(/\\/g, '\\\\').replace(/'/g, "\\'").replace(/"/g, '\\"').replace(/\n/g, '\\n').replace(/\r/g, '');
    }
  </script>
</body>
</html>
