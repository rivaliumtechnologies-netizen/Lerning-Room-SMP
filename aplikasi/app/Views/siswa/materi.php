<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Materi Siswa - Room Learning SMP</title>
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
    /* Custom scrollbar */
    .custom-scroll::-webkit-scrollbar { width: 5px; height: 5px; }
    .custom-scroll::-webkit-scrollbar-track { background: transparent; }
    .custom-scroll::-webkit-scrollbar-thumb { background: #cbd5e1; border-radius: 9999px; }
    .custom-scroll::-webkit-scrollbar-thumb:hover { background: #94a3b8; }
    /* Markdown styling inside AI response */
    .ai-markdown p { margin-bottom: 0.5rem; }
    .ai-markdown p:last-child { margin-bottom: 0; }
    .ai-markdown ul { list-style-type: disc; margin-left: 1.25rem; margin-bottom: 0.5rem; }
    .ai-markdown ol { list-style-type: decimal; margin-left: 1.25rem; margin-bottom: 0.5rem; }
    .ai-markdown strong { color: #0f172a; font-weight: 700; }
    .ai-markdown code { background-color: #f1f5f9; padding: 0.15rem 0.35rem; border-radius: 0.25rem; font-size: 0.75rem; font-family: monospace; }
    .ai-markdown table { width: 100%; border-collapse: collapse; margin: 0.75rem 0; font-size: 0.75rem; border: 1px solid #cbd5e1; }
    .ai-markdown th { background-color: #f1f5f9; font-weight: 700; color: #1e293b; padding: 0.5rem; border: 1px solid #cbd5e1; text-align: left; }
    .ai-markdown td { padding: 0.4rem 0.5rem; border: 1px solid #cbd5e1; color: #334155; }
    .katex-display { margin: 0.75rem 0; overflow-x: auto; overflow-y: hidden; padding: 0.25rem 0; }
  </style>
</head>
<body class="bg-slate-50 text-slate-800 flex h-screen overflow-hidden">

  <!-- Sidebar Navigasi Utama -->
  <!-- Sidebar Navigasi Siswa (Fresh Teal Theme) -->
  <aside class="w-64 bg-white border-r border-slate-200/80 flex flex-col justify-between shrink-0 p-4 shadow-sm z-20">
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
        <a href="<?= site_url('siswa/jadwal') ?>" class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl text-slate-600 hover:bg-slate-50 hover:text-slate-900 font-semibold text-xs transition">
          <i class="fa-regular fa-calendar-days w-4 text-center"></i>
          <span>Jadwal Kelas Saya</span>
        </a>
        <a href="<?= site_url('siswa/materi') ?>" class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl bg-teal-50 text-teal-700 font-bold text-xs shadow-sm transition">
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
    </div>

    <!-- Logout Button -->
    <a href="<?= site_url('logout') ?>" class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl text-rose-500 hover:bg-rose-50 hover:text-rose-600 font-bold text-xs transition">
      <i class="fa-solid fa-right-from-bracket w-4 text-center"></i>
      <span>Keluar Akun</span>
    </a>
  </aside>

  <!-- Area Konten Utama (Kiri & Tengah) -->
  <main class="flex-1 flex flex-col h-full overflow-hidden transition-all duration-300 relative">
    
    <!-- ============================================================ -->
    <!-- VIEW 1: DAFTAR TABEL MATERI (Default Tampilan Awal)           -->
    <!-- ============================================================ -->
    <div id="materiListView" class="flex-1 overflow-y-auto p-8 custom-scroll">
      
      <!-- Top Bar Header -->
      <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 mb-6">
        <div>
          <div class="flex items-center gap-2.5">
            <h1 class="text-2xl font-extrabold text-slate-800 tracking-tight">Materi Pembelajaran</h1>
            <?php if (!empty($kelas_siswa)): ?>
              <span class="bg-teal-50 text-teal-700 text-xs font-extrabold px-3 py-1 rounded-full border border-teal-200">
                Kelas <?= esc($kelas_siswa) ?>
              </span>
            <?php endif; ?>
          </div>
          <p class="text-xs text-slate-500 mt-1">Menampilkan materi pembelajaran khusus untuk <?= !empty($kelas_siswa) ? 'Kelas ' . esc($kelas_siswa) . ' dan materi umum' : 'semua tingkatan' ?>.</p>
        </div>

        <!-- Tombol Trigger Gemini AI di Bagian Kanan Header -->
        <button onclick="toggleGeminiPanel()" class="inline-flex items-center gap-2 bg-gradient-to-tr from-teal-600 to-emerald-500 hover:from-teal-700 hover:to-emerald-600 text-white px-4 py-2.5 rounded-xl text-xs font-bold shadow-md shadow-teal-500/20 transition-all transform active:scale-95 shrink-0">
          <i class="fa-solid fa-wand-magic-sparkles text-amber-300"></i>
          <span>Tanya Gemini AI</span>
          <span class="bg-white/20 text-white text-[10px] px-1.5 py-0.5 rounded-full font-semibold">Live</span>
        </button>
      </div>

      <!-- Kartu Tabel Materi -->
      <div class="bg-white rounded-2xl border border-slate-100 shadow-sm overflow-hidden mb-6">
        <div class="p-4 border-b border-slate-100 flex items-center justify-between">
          <h3 class="font-bold text-sm text-slate-700 flex items-center gap-2">
            <i class="fa-solid fa-book-open text-teal-600"></i>
            <span>Daftar Materi Tersedia</span>
          </h3>
          <span class="text-xs text-slate-400 font-medium"><?= count($materi ?? []) ?> Materi</span>
        </div>

        <div class="overflow-x-auto">
          <table class="w-full text-left text-xs">
            <thead class="bg-slate-50/80 text-slate-500 font-bold border-b border-slate-100 uppercase tracking-wider text-[10px]">
              <tr>
                <th class="p-4">Judul Materi</th>
                <th class="p-4">Deskripsi</th>
                <th class="p-4">Tingkat Kelas</th>
                <th class="p-4">Guru</th>
                <th class="p-4">Tipe Berkas</th>
                <th class="p-4 text-center">Aksi & Bantuan AI</th>
              </tr>
            </thead>
            <tbody class="divide-y divide-slate-100">
              <?php if (empty($materi)): ?>
                <tr>
                  <td colspan="6" class="p-8 text-center text-slate-400">
                    <i class="fa-regular fa-folder-open text-3xl mb-2 text-slate-300 block"></i>
                    Belum ada materi untuk tingkatan kelas ini.
                  </td>
                </tr>
              <?php else: ?>
                <?php foreach ($materi as $item): 
                  $fileExt = !empty($item['file']) ? strtolower(pathinfo($item['file'], PATHINFO_EXTENSION)) : '';
                  $isPdf = ($fileExt === 'pdf');
                  $isWord = in_array($fileExt, ['doc', 'docx']);
                  $targetKelas = !empty($item['kelas']) ? $item['kelas'] : 'Semua';
                  $badgeColor = match($targetKelas) {
                    'VII'   => 'bg-emerald-50 text-emerald-700 border-emerald-200',
                    'VIII'  => 'bg-teal-50 text-teal-700 border-teal-200',
                    'IX'    => 'bg-cyan-50 text-cyan-700 border-cyan-200',
                    default => 'bg-slate-100 text-slate-600 border-slate-200',
                  };
                ?>
                  <tr class="hover:bg-slate-50/70 transition-colors">
                    <td class="p-4 font-bold text-slate-800">
                      <div class="flex items-center gap-2">
                        <?php if ($isPdf): ?>
                          <i class="fa-solid fa-file-pdf text-rose-500 text-base"></i>
                        <?php elseif ($isWord): ?>
                          <i class="fa-solid fa-file-word text-sky-600 text-base"></i>
                        <?php else: ?>
                          <i class="fa-solid fa-file-lines text-slate-400 text-base"></i>
                        <?php endif; ?>
                        <span><?= esc($item['judul']) ?></span>
                      </div>
                    </td>
                    <td class="p-4 text-slate-600 max-w-xs leading-relaxed">
                      <?= esc($item['deskripsi']) ?>
                    </td>
                    <td class="p-4">
                      <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-full text-[10px] font-extrabold border <?= $badgeColor ?>">
                        <?= $targetKelas === 'Semua' ? 'Semua Kelas' : 'Kelas ' . esc($targetKelas) ?>
                      </span>
                    </td>
                    <td class="p-4 text-slate-600">
                      <span class="inline-flex items-center gap-1.5 bg-slate-100 text-slate-700 px-2.5 py-1 rounded-lg text-[11px] font-semibold">
                        <i class="fa-solid fa-user-tie text-slate-400 text-[10px]"></i>
                        <?= esc($item['guru_nama']) ?>
                      </span>
                    </td>
                    <td class="p-4">
                      <?php if (!empty($item['file'])): ?>
                        <span class="uppercase font-extrabold text-[10px] px-2 py-0.5 rounded <?= $isPdf ? 'bg-rose-50 text-rose-600 border border-rose-200' : ($isWord ? 'bg-sky-50 text-sky-600 border border-sky-200' : 'bg-slate-100 text-slate-600') ?>">
                          <?= esc($fileExt) ?>
                        </span>
                      <?php else: ?>
                        <span class="text-slate-400 italic text-[11px]">-</span>
                      <?php endif; ?>
                    </td>
                    <td class="p-4 text-center">
                      <div class="inline-flex items-center gap-2">
                        <!-- Tombol Buka & Baca Langsung (Split View) -->
                        <?php if (!empty($item['file'])): ?>
                          <button type="button" 
                            onclick="openMaterialViewer('<?= esc($item['judul'], 'js') ?>', '<?= esc($item['deskripsi'], 'js') ?>', '<?= base_url('uploads/' . $item['file']) ?>', '<?= esc($fileExt, 'js') ?>', '<?= esc($item['guru_nama'], 'js') ?>', '<?= esc($item['mapel'] ?? '', 'js') ?>')" 
                            class="inline-flex items-center gap-1.5 bg-teal-600 hover:bg-teal-700 text-white px-3 py-1.5 rounded-xl font-bold text-[11px] shadow-sm shadow-teal-500/20 transition-all transform active:scale-95">
                            <i class="fa-solid fa-book-open-reader"></i>
                            <span>Buka & Pelajari</span>
                          </button>
                        <?php endif; ?>

                        <!-- Tombol Tanya AI Spesifik -->
                        <button type="button" 
                          onclick="openAiForMateri('<?= esc($item['judul'], 'js') ?>', '<?= esc($item['deskripsi'], 'js') ?>', '<?= esc($item['mapel'] ?? '', 'js') ?>')" 
                          class="inline-flex items-center gap-1.5 bg-teal-50 hover:bg-teal-600 hover:text-white text-teal-700 border border-teal-200 px-3 py-1.5 rounded-xl font-bold text-[11px] transition-all shadow-xs">
                          <i class="fa-solid fa-wand-magic-sparkles text-amber-400"></i>
                          <span>Tanya AI</span>
                        </button>

                        <!-- Tombol Download Asli -->
                        <?php if (!empty($item['file'])): ?>
                          <a href="<?= base_url('uploads/' . $item['file']) ?>" download class="w-8 h-8 rounded-xl bg-slate-100 hover:bg-teal-50 hover:text-teal-700 text-slate-600 flex items-center justify-center text-xs transition" title="Download Berkas">
                            <i class="fa-solid fa-download"></i>
                          </a>
                        <?php endif; ?>
                      </div>
                    </td>
                  </tr>
                <?php endforeach; ?>
              <?php endif; ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>

    <!-- ============================================================ -->
    <!-- VIEW 2: SPLIT SCREEN READER (PDF / DOKUMEN VIEWER LANGSUNG) -->
    <!-- ============================================================ -->
    <div id="materiReaderView" class="hidden flex-1 flex flex-col h-full bg-slate-100 overflow-hidden">
      
      <!-- Toolbar Atas Viewer Dokumen -->
      <div class="bg-white border-b border-slate-200 px-6 py-3 flex items-center justify-between shrink-0 shadow-xs">
        <div class="flex items-center gap-3">
          <button onclick="closeMaterialViewer()" class="inline-flex items-center gap-1.5 text-xs font-bold text-slate-600 hover:text-teal-700 bg-slate-100 hover:bg-teal-50 px-3 py-1.5 rounded-xl transition">
            <i class="fa-solid fa-arrow-left"></i>
            <span>Kembali ke Daftar</span>
          </button>

          <div class="h-4 w-px bg-slate-200"></div>

          <div>
            <h2 id="readerTitle" class="font-extrabold text-sm text-slate-800 leading-tight">Judul Materi</h2>
            <p id="readerAuthor" class="text-[10px] text-slate-400 font-medium">Guru Pengampu: -</p>
          </div>
        </div>

        <div class="flex items-center gap-2">
          <!-- Buka di Tab Baru -->
          <a id="readerNewTabBtn" href="#" target="_blank" class="inline-flex items-center gap-1.5 text-xs font-semibold text-slate-600 hover:text-teal-700 hover:bg-teal-50 px-3 py-1.5 rounded-xl border border-slate-200 transition" title="Buka PDF di Tab Baru">
            <i class="fa-solid fa-arrow-up-right-from-square text-[11px]"></i>
            <span class="hidden sm:inline">Tab Baru</span>
          </a>

          <!-- Toggle Panel AI Kanan -->
          <button onclick="toggleGeminiPanel()" class="inline-flex items-center gap-1.5 bg-teal-50 text-teal-700 hover:bg-teal-100 border border-teal-200 px-3 py-1.5 rounded-xl font-bold text-xs transition">
            <i class="fa-solid fa-wand-magic-sparkles text-amber-500"></i>
            <span>Panel AI</span>
          </button>
        </div>
      </div>

      <!-- Area Tampilan Isi Dokumen (PDF Reader / Fallback) -->
      <div class="flex-1 p-4 overflow-hidden relative">
        
        <!-- Container PDF Frame -->
        <div id="pdfContainer" class="w-full h-full bg-white rounded-2xl shadow-sm border border-slate-200 overflow-hidden">
          <iframe id="pdfFrame" src="" class="w-full h-full border-0"></iframe>
        </div>

        <!-- Fallback jika berkas Word (.docx/.doc) -->
        <div id="nonPdfContainer" class="hidden w-full h-full bg-white rounded-2xl shadow-sm border border-slate-200 p-8 flex flex-col items-center justify-center text-center">
          <div class="w-16 h-16 rounded-3xl bg-teal-50 text-teal-600 flex items-center justify-center text-3xl mb-4 shadow-sm">
            <i class="fa-solid fa-file-word"></i>
          </div>
          <h3 id="nonPdfTitle" class="text-base font-bold text-slate-800 mb-1">Dokumen Word</h3>
          <p id="nonPdfDesc" class="text-xs text-slate-500 max-w-md mb-6 leading-relaxed">Dokumen materi format Word dapat kamu unduh untuk dibaca di laptopmu.</p>
          
          <div class="flex items-center gap-3">
            <a id="nonPdfDownloadBtn" href="#" download class="inline-flex items-center gap-2 bg-teal-600 hover:bg-teal-700 text-white font-bold text-xs px-5 py-2.5 rounded-xl shadow-md shadow-teal-500/20 transition">
              <i class="fa-solid fa-download"></i>
              <span>Download Berkas Dokumen</span>
            </a>
            <button onclick="openAiForMateri(currentReadingTitle, currentReadingDesc, currentReadingMapel)" class="inline-flex items-center gap-2 bg-teal-50 hover:bg-teal-100 text-teal-700 font-bold text-xs px-5 py-2.5 rounded-xl border border-teal-200 transition">
              <i class="fa-solid fa-wand-magic-sparkles text-amber-500"></i>
              <span>Tanya Gemini AI</span>
            </button>
          </div>
        </div>

      </div>
    </div>

    <!-- Floating Action Button (FAB) Jika Panel AI Tertutup -->
    <button id="floatingAiBtn" onclick="toggleGeminiPanel()" class="hidden fixed bottom-6 right-6 bg-gradient-to-tr from-teal-600 to-emerald-500 text-white p-3.5 rounded-2xl shadow-xl shadow-teal-500/30 hover:scale-105 active:scale-95 transition-all flex items-center gap-2 font-bold text-xs z-30 group">
      <i class="fa-solid fa-wand-magic-sparkles text-amber-300 text-base animate-pulse"></i>
      <span class="hidden group-hover:inline transition-all">Tanya Gemini AI</span>
    </button>
  </main>

  <!-- ============================================================= -->
  <!-- PANEL GEMINI AI DI BAGIAN KANAN (Model Pembelajaran Terpadu) -->
  <!-- ============================================================= -->
  <aside id="geminiSidebar" class="w-[430px] bg-white border-l border-slate-200 flex flex-col shrink-0 h-full shadow-2xl transition-all duration-300 z-40 relative">
    
    <!-- 1. Header Panel -->
    <div class="p-4 border-b border-slate-100 flex items-center justify-between bg-white shrink-0">
      <div class="flex items-center gap-2.5">
        <div class="w-9 h-9 rounded-2xl bg-gradient-to-tr from-teal-600 to-emerald-500 text-white flex items-center justify-center font-bold text-sm shadow-md shadow-teal-500/20">
          <i class="fa-solid fa-wand-magic-sparkles text-amber-300"></i>
        </div>
        <div>
          <div class="flex items-center gap-1.5">
            <h3 class="font-extrabold text-xs text-slate-800 leading-tight">Gemini Pembelajaran Terpadu</h3>
            <span class="bg-teal-50 text-teal-700 text-[9px] font-bold px-1.5 py-0.5 rounded-full border border-teal-200">SMP</span>
          </div>
          <p class="text-[10px] font-semibold text-emerald-600 flex items-center gap-1 mt-0.5">
            <span class="w-1.5 h-1.5 rounded-full bg-emerald-500 inline-block animate-ping"></span>
            Asisten Terpadu Aktif
          </p>
        </div>
      </div>
      
      <!-- Tombol Aksi Header: Reset Chat & Tutup -->
      <div class="flex items-center gap-1">
        <button onclick="clearChatHistory()" title="Bersihkan Percakapan" class="w-7 h-7 flex items-center justify-center text-slate-400 hover:text-slate-600 rounded-lg hover:bg-slate-100 text-xs transition">
          <i class="fa-regular fa-trash-can"></i>
        </button>
        <button onclick="toggleGeminiPanel()" title="Tutup Panel" class="w-7 h-7 flex items-center justify-center text-slate-400 hover:text-slate-600 rounded-lg hover:bg-slate-100 text-xs transition">
          <i class="fa-solid fa-xmark text-sm"></i>
        </button>
      </div>
    </div>

    <!-- 2. Isi Percakapan & Konten (Scrollable) -->
    <div id="chatScrollArea" class="flex-1 overflow-y-auto p-4 custom-scroll space-y-4">
      
      <!-- Hero Greeting (Sesuai model Pembelajaran Terpadu) -->
      <div id="greetingSection" class="pt-2 pb-1">
        <h2 class="text-2xl font-extrabold text-transparent bg-clip-text bg-gradient-to-r from-teal-600 to-emerald-600">
          Halo, <?= esc(session()->get('user_name') ?? 'Sahabat Belajar') ?>! 👋
        </h2>
        <p class="text-slate-600 text-sm font-semibold mt-1">Apa yang ingin kamu pelajari hari ini?</p>
        <p class="text-[11px] text-slate-400 mt-0.5 leading-relaxed">
          Eksplorasi materi pelajaranmu secara terpadu. Hubungkan konsep teori, contoh kehidupan nyata, dan latihan soal interaktif bersama Gemini.
        </p>
      </div>

      <!-- Quick Action Chips (Format Pembelajaran Terpadu) -->
      <div id="quickChipsSection" class="space-y-2 pt-1">
        <p class="text-[10px] font-bold text-slate-400 uppercase tracking-wider flex items-center gap-1.5">
          <i class="fa-solid fa-layer-group text-teal-600"></i>
          <span>Mode Bantuan Terpadu:</span>
        </p>
        
        <!-- Chip 1: Rangkuman Konsep Terpadu -->
        <button onclick="applyPromptChip('Rangkum konsep utama materi ini secara terpadu dan jelaskan dengan bahasa yang mudah dipahami siswa SMP')" class="w-full text-left p-2.5 rounded-xl bg-slate-50 hover:bg-teal-50 border border-slate-100 hover:border-teal-200 text-slate-700 hover:text-teal-700 text-xs font-semibold flex items-center gap-2.5 transition group">
          <div class="w-6 h-6 rounded-lg bg-teal-100 group-hover:bg-teal-200 text-teal-700 flex items-center justify-center text-[11px] shrink-0 transition">
            <i class="fa-regular fa-file-lines"></i>
          </div>
          <div class="truncate">
            <div class="text-xs font-bold text-slate-800 group-hover:text-teal-700">Rangkuman Konsep Terpadu</div>
            <div class="text-[10px] text-slate-400 truncate">Inti materi pelajaran dirangkum ringkas dan padat</div>
          </div>
        </button>

        <!-- Chip 2: Kaitan Kehidupan Nyata / Lintas Konsep -->
        <button onclick="applyPromptChip('Jelaskan materi ini dengan menghubungkannya ke fenomena atau contoh nyata di kehidupan sehari-hari siswa')" class="w-full text-left p-2.5 rounded-xl bg-slate-50 hover:bg-emerald-50 border border-slate-100 hover:border-emerald-200 text-slate-700 hover:text-emerald-700 text-xs font-semibold flex items-center gap-2.5 transition group">
          <div class="w-6 h-6 rounded-lg bg-emerald-100 group-hover:bg-emerald-200 text-emerald-700 flex items-center justify-center text-[11px] shrink-0 transition">
            <i class="fa-solid fa-earth-americas"></i>
          </div>
          <div class="truncate">
            <div class="text-xs font-bold text-slate-800 group-hover:text-emerald-700">Kaitan Kehidupan Nyata</div>
            <div class="text-[10px] text-slate-400 truncate">Contoh konkret aplikasi materi di sekitar kita</div>
          </div>
        </button>

        <!-- Chip 3: Soal Latihan & Pembahasan Nalar -->
        <button onclick="applyPromptChip('Buatkan 3 soal latihan kontekstual tingkat SMP dari materi ini lengkap dengan kunci jawaban dan cara pembahasannya')" class="w-full text-left p-2.5 rounded-xl bg-slate-50 hover:bg-teal-50 border border-slate-100 hover:border-teal-200 text-slate-700 hover:text-teal-700 text-xs font-semibold flex items-center gap-2.5 transition group">
          <div class="w-6 h-6 rounded-lg bg-teal-100 group-hover:bg-teal-200 text-teal-700 flex items-center justify-center text-[11px] shrink-0 transition">
            <i class="fa-solid fa-pen-to-square"></i>
          </div>
          <div class="truncate">
            <div class="text-xs font-bold text-slate-800 group-hover:text-teal-700">Latihan Soal & Pembahasan</div>
            <div class="text-[10px] text-slate-400 truncate">Uji pemahaman dengan soal nalar interaktif</div>
          </div>
        </button>
      </div>

      <!-- Disclaimer Box -->
      <div id="disclaimerBox" class="bg-teal-50/60 border border-teal-200/70 rounded-2xl p-3 text-[11px] text-teal-800 relative flex items-start gap-2.5">
        <i class="fa-solid fa-circle-info text-teal-600 text-xs mt-0.5 shrink-0"></i>
        <div class="pr-4 leading-relaxed">
          <span>Gemini AI dapat membuat kesalahan. Selalu cocokkan jawaban dengan materi resmi dan penjelasan dari gurumu.</span>
        </div>
        <button onclick="document.getElementById('disclaimerBox').style.display='none'" class="absolute top-2.5 right-2.5 text-teal-400 hover:text-teal-600">
          <i class="fa-solid fa-xmark text-xs"></i>
        </button>
      </div>

      <!-- Container Bubble Pesan Chat -->
      <div id="chatMessages" class="space-y-3 pt-2"></div>

      <!-- Loading / Thinking Indicator -->
      <div id="aiThinking" class="hidden flex items-start gap-2.5 text-xs text-slate-500 bg-teal-50/70 p-3 rounded-2xl border border-teal-100 w-fit">
        <div class="w-6 h-6 rounded-lg bg-teal-600 text-white flex items-center justify-center text-[10px] shrink-0 shadow-xs">
          <i class="fa-solid fa-wand-magic-sparkles text-amber-300"></i>
        </div>
        <div class="flex items-center gap-1 py-1">
          <span class="w-1.5 h-1.5 rounded-full bg-teal-600 animate-bounce"></span>
          <span class="w-1.5 h-1.5 rounded-full bg-teal-600 animate-bounce" style="animation-delay: 0.15s"></span>
          <span class="w-1.5 h-1.5 rounded-full bg-teal-600 animate-bounce" style="animation-delay: 0.3s"></span>
          <span class="text-[11px] ml-1.5 font-bold text-teal-800">Gemini sedang menyusun penjelasan...</span>
        </div>
      </div>
    </div>

    <!-- 3. Context Chip & Input Box (Sesuai format terintegrasi materi) -->
    <div class="p-3 border-t border-slate-100 bg-white shrink-0 space-y-2">
      
      <!-- Chip Konteks Materi Aktif -->
      <div id="contextChip" class="bg-teal-50 border border-teal-200 rounded-xl px-3 py-1.5 text-[11px] text-teal-800 flex items-center justify-between">
        <div class="flex items-center gap-1.5 truncate">
          <i class="fa-solid fa-book-open-reader text-teal-600 text-[11px]"></i>
          <span class="text-teal-600 font-medium">Konteks Terpadu:</span>
          <span id="contextTitle" class="font-bold truncate">Umum (Semua Materi)</span>
        </div>
        <button onclick="resetMateriContext()" title="Hapus fokus materi" class="text-teal-400 hover:text-teal-600 ml-2">
          <i class="fa-solid fa-xmark text-xs"></i>
        </button>
      </div>

      <!-- Form Input Pesan -->
      <form id="geminiChatForm" onsubmit="handleSendChat(event)" class="relative">
        <div class="flex items-end gap-2 bg-slate-50 border border-slate-200 rounded-2xl p-2.5 focus-within:border-teal-500 focus-within:ring-2 focus-within:ring-teal-500/20 transition">
          <textarea id="chatInput" rows="2" placeholder="Tanyakan materi pelajaran secara terpadu di sini..." required class="w-full bg-transparent text-xs text-slate-800 placeholder:text-slate-400 focus:outline-none resize-none custom-scroll py-0.5 px-1"></textarea>
          
          <div class="flex items-center gap-1 shrink-0 pb-0.5">
            <button type="submit" id="sendBtn" class="w-8 h-8 rounded-xl bg-teal-600 hover:bg-teal-700 text-white flex items-center justify-center text-xs shadow-sm shadow-teal-500/20 transition disabled:opacity-50">
              <i class="fa-solid fa-paper-plane text-[11px]"></i>
            </button>
          </div>
        </div>

        <div class="flex items-center justify-between mt-1.5 px-1 text-[10px] text-slate-400 font-medium">
          <span class="flex items-center gap-1">
            <i class="fa-solid fa-sparkles text-teal-600"></i> Model: <span class="text-slate-600 font-bold">Gemini 2.0 Flash (Pembelajaran Terpadu)</span>
          </span>
          <span>Shift+Enter untuk baris baru</span>
        </div>
      </form>

    </div>
  </aside>

  <!-- Script Interaksi Split-Screen & Gemini AI -->
  <script>
    // State aplikasi
    let currentContext = "";
    let currentMapel = "";
    let currentReadingMapel = "";
    let csrfToken = "<?= csrf_hash() ?>";
    let isPanelOpen = true;
    let currentReadingTitle = "";
    let currentReadingDesc = "";
    let materiHistory = [];

    // Helper deteksi mata pelajaran dari teks materi jika belum tercatat di data guru
    function detectMapel(text) {
      if (!text) return "";
      const t = text.toUpperCase();
      if (t.includes("IPA") || t.includes("SAINS") || t.includes("BIOLOGI") || t.includes("FISIKA") || t.includes("KIMIA") || t.includes("PERNAPASAN") || t.includes("TATA SURYA") || t.includes("SEL") || t.includes("ORGAN")) return "Ilmu Pengetahuan Alam (IPA)";
      if (t.includes("MATEMATIKA") || t.includes("MTK") || t.includes("ALJABAR") || t.includes("GEOMETRI") || t.includes("STATISTIKA") || t.includes("ARITMATIKA") || t.includes("PERSAMAAN")) return "Matematika";
      if (t.includes("BAHASA INDONESIA") || t.includes("B. INDO") || t.includes("TEKS ") || t.includes("PUISI") || t.includes("CERPEN") || t.includes("PARAGRAF")) return "Bahasa Indonesia";
      if (t.includes("BAHASA INGGRIS") || t.includes("ENGLISH") || t.includes("B. ING") || t.includes("TENSES") || t.includes("VOCABULARY")) return "Bahasa Inggris";
      if (t.includes("IPS") || t.includes("SEJARAH") || t.includes("GEOGRAFI") || t.includes("SOSIOLOGI") || t.includes("EKONOMI")) return "Ilmu Pengetahuan Sosial (IPS)";
      if (t.includes("PPKN") || t.includes("PKN") || t.includes("PANCASILA") || t.includes("KEWARGANEGARAAN")) return "Pendidikan Pancasila (PPKn)";
      if (t.includes("SENI") || t.includes("BUDAYA") || t.includes("LUKIS") || t.includes("MUSIK") || t.includes("TARI") || t.includes("KERAJINAN")) return "Seni Budaya";
      if (t.includes("PJOK") || t.includes("PENJAS") || t.includes("OLAHRAGA") || t.includes("KEBUGARAN") || t.includes("SENAM")) return "PJOK";
      if (t.includes("INFORMATIKA") || t.includes("TIK") || t.includes("KOMPUTER") || t.includes("CODING") || t.includes("JARINGAN")) return "Informatika";
      if (t.includes("PRAKARYA") || t.includes("PENGOLAHAN") || t.includes("BUDIDAYA")) return "Prakarya";
      return "";
    }

    // Toggle Tampilan Panel Kanan
    function toggleGeminiPanel() {
      const sidebar = document.getElementById('geminiSidebar');
      const floatingBtn = document.getElementById('floatingAiBtn');
      isPanelOpen = !isPanelOpen;

      if (isPanelOpen) {
        sidebar.classList.remove('hidden');
        floatingBtn.classList.add('hidden');
      } else {
        sidebar.classList.add('hidden');
        floatingBtn.classList.remove('hidden');
      }
    }

    // Buka Viewer Dokumen (Split Screen PDF Reader)
    function openMaterialViewer(judul, deskripsi, fileUrl, fileExt, guruNama, mapel = "") {
      currentReadingTitle = judul;
      currentReadingDesc = deskripsi;
      currentReadingMapel = mapel || detectMapel(judul + " " + deskripsi);

      // Sembunyikan tabel materi, tampilkan reader
      document.getElementById('materiListView').classList.add('hidden');
      document.getElementById('materiReaderView').classList.remove('hidden');

      // Set info dokumen
      document.getElementById('readerTitle').textContent = judul;
      document.getElementById('readerAuthor').textContent = "Guru Pengampu: " + (guruNama || "Guru");
      document.getElementById('readerNewTabBtn').href = fileUrl;

      // Periksa tipe file
      const pdfContainer = document.getElementById('pdfContainer');
      const nonPdfContainer = document.getElementById('nonPdfContainer');
      const pdfFrame = document.getElementById('pdfFrame');

      if (fileExt.toLowerCase() === 'pdf') {
        pdfContainer.classList.remove('hidden');
        nonPdfContainer.classList.add('hidden');
        pdfFrame.src = fileUrl;
      } else {
        pdfContainer.classList.add('hidden');
        nonPdfContainer.classList.remove('hidden');
        document.getElementById('nonPdfTitle').textContent = judul + " (" + fileExt.toUpperCase() + ")";
        document.getElementById('nonPdfDesc').textContent = deskripsi;
        document.getElementById('nonPdfDownloadBtn').href = fileUrl;
      }

      // Otomatis aktifkan materi sebagai konteks di Gemini AI
      openAiForMateri(judul, deskripsi, currentReadingMapel);
    }

    // Tutup Viewer dan Kembali ke Tabel
    function closeMaterialViewer() {
      document.getElementById('materiReaderView').classList.add('hidden');
      document.getElementById('materiListView').classList.remove('hidden');
      document.getElementById('pdfFrame').src = "";
    }

    // Set Materi Aktif sebagai Konteks Chat AI
    function openAiForMateri(judul, deskripsi, mapel = "") {
      if (!isPanelOpen) {
        toggleGeminiPanel();
      }

      currentMapel = mapel || detectMapel(judul + " " + deskripsi);
      currentReadingMapel = currentMapel;

      const mapelLabel = currentMapel ? `Mata Pelajaran: ${currentMapel}\n` : '';
      currentContext = `${mapelLabel}Judul Materi: ${judul}\nRingkasan/Deskripsi: ${deskripsi}`;
      document.getElementById('contextTitle').textContent = (currentMapel ? `[${currentMapel}] ` : '') + judul;

      // Sambut siswa di chat dengan materi spesifik
      const textMapel = currentMapel ? ` mata pelajaran **${currentMapel}**` : '';
      appendMessage('ai', `Halo! Kamu sedang mempelajari materi **"${judul}"**${textMapel}. AI akan membantu menjawab pertanyaan khusus seputar materi dan mata pelajaran ini. Silakan tanyakan konsep inti, rumus, atau pembahasannya! 🎓📘`);
      document.getElementById('chatInput').focus();
    }

    // Set konteks awal tanpa trigger bubble greeting
    function setInitialMateriContext(judul, deskripsi, mapel = "") {
      currentMapel = mapel || detectMapel(judul + " " + deskripsi);
      currentReadingMapel = currentMapel;
      const mapelLabel = currentMapel ? `Mata Pelajaran: ${currentMapel}\n` : '';
      currentContext = `${mapelLabel}Judul Materi: ${judul}\nRingkasan/Deskripsi: ${deskripsi}`;
      const chipTitle = document.getElementById('contextTitle');
      if (chipTitle) {
        chipTitle.textContent = (currentMapel ? `[${currentMapel}] ` : '') + judul;
      }
    }

    // Reset Konteks ke Umum
    function resetMateriContext() {
      currentContext = "";
      currentMapel = "";
      currentReadingMapel = "";
      document.getElementById('contextTitle').textContent = "Umum (Semua Materi)";
    }

    // Terapkan chip rekomendasi ke input
    function applyPromptChip(text) {
      document.getElementById('chatInput').value = text;
      handleSendChat(new Event('submit'));
    }

    function renderMarkdownWithMath(rawText) {
      if (!rawText) return '';
      if (typeof marked === 'undefined') return escapeHtml(rawText);

      const mathBlocks = [];

      let safeText = rawText.replace(/(\$\$[\s\S]*?\$\$|\\\[[\s\S]*?\\\])/g, function(match) {
        mathBlocks.push(match);
        return `@@MATH_BLOCK_${mathBlocks.length - 1}@@`;
      });

      safeText = safeText.replace(/(\\\([\s\S]*?\\\)|(\$([^\$\n\r]+?)\$))/g, function(match) {
        mathBlocks.push(match);
        return `@@MATH_BLOCK_${mathBlocks.length - 1}@@`;
      });

      let html = marked.parse(safeText);

      html = html.replace(/@@MATH_BLOCK_(\d+)@@/g, function(match, id) {
        const idx = parseInt(id, 10);
        return mathBlocks[idx] !== undefined ? mathBlocks[idx] : match;
      });

      return html;
    }

    // Render pesan ke dalam chat container
    function appendMessage(sender, text) {
      const chatMessages = document.getElementById('chatMessages');
      const msgDiv = document.createElement('div');

      if (sender === 'user') {
        msgDiv.className = "flex justify-end";
        msgDiv.innerHTML = `
          <div class="bg-gradient-to-tr from-teal-600 to-emerald-600 text-white rounded-2xl rounded-br-none px-3.5 py-2.5 text-xs max-w-[85%] shadow-sm leading-relaxed font-medium">
            ${escapeHtml(text)}
          </div>
        `;
      } else {
        msgDiv.className = "flex items-start gap-2.5";
        const parsedHtml = renderMarkdownWithMath(text);
        msgDiv.innerHTML = `
          <div class="w-6 h-6 rounded-lg bg-gradient-to-tr from-teal-600 to-emerald-500 text-white flex items-center justify-center text-[10px] shrink-0 mt-0.5 shadow-xs">
            <i class="fa-solid fa-wand-magic-sparkles text-amber-300"></i>
          </div>
          <div class="bg-white border border-slate-200/80 text-slate-700 rounded-2xl rounded-tl-none p-3.5 text-xs max-w-[85%] shadow-xs leading-relaxed ai-markdown">
            ${parsedHtml}
          </div>
        `;
      }

      chatMessages.appendChild(msgDiv);

      // Render formula LaTeX dengan KaTeX jika ada
      if (sender === 'ai' && typeof renderMathInElement !== 'undefined') {
        renderMathInElement(msgDiv, {
          delimiters: [
            {left: '$$', right: '$$', display: true},
            {left: '$', right: '$', display: false},
            {left: '\\(', right: '\\)', display: false},
            {left: '\\[', right: '\\]', display: true}
          ],
          throwOnError: false
        });
      }

      scrollToBottom();
    }

    // Scroll chat area ke paling bawah
    function scrollToBottom() {
      const scrollArea = document.getElementById('chatScrollArea');
      scrollArea.scrollTop = scrollArea.scrollHeight;
    }

    // Bersihkan riwayat chat tampilan
    function clearChatHistory() {
      materiHistory = [];
      document.getElementById('chatMessages').innerHTML = '';
      appendMessage('ai', 'Riwayat chat telah dibersihkan. Silakan tanyakan materi pelajaranmu!');
    }

    // Kirim pesan ke API Gemini
    async function handleSendChat(event) {
      event.preventDefault();
      const input = document.getElementById('chatInput');
      const prompt = input.value.trim();
      if (!prompt) return;

      // Sembunyikan greeting awal saat sudah mulai chat
      document.getElementById('greetingSection').classList.add('hidden');
      document.getElementById('quickChipsSection').classList.add('hidden');

      // Tampilkan pesan siswa
      appendMessage('user', prompt);
      input.value = '';

      // Tampilkan indikator loading
      const thinkingEl = document.getElementById('aiThinking');
      thinkingEl.classList.remove('hidden');
      scrollToBottom();

      const sendBtn = document.getElementById('sendBtn');
      sendBtn.disabled = true;

      try {
        const bodyParams = new URLSearchParams();
        bodyParams.append('prompt', prompt);
        bodyParams.append('context', currentContext);
        bodyParams.append('mapel', currentMapel || currentReadingMapel || '');
        bodyParams.append('source', 'materi');
        bodyParams.append('history', JSON.stringify(materiHistory));
        bodyParams.append('<?= csrf_token() ?>', csrfToken);

        const response = await fetch('<?= site_url('gemini/ask') ?>', {
          method: 'POST',
          headers: {
            'Content-Type': 'application/x-www-form-urlencoded',
            'X-Requested-With': 'XMLHttpRequest',
            'X-CSRF-TOKEN': csrfToken
          },
          body: bodyParams
        });

        const data = await response.json();

        // Update CSRF token dari response
        if (data.csrf_token) {
          csrfToken = data.csrf_token;
        }

        thinkingEl.classList.add('hidden');
        sendBtn.disabled = false;

        if (data.success) {
          materiHistory.push({ role: 'user', parts: [{ text: prompt }] });
          materiHistory.push({ role: 'model', parts: [{ text: data.text }] });
          appendMessage('ai', data.text);
        } else {
          appendMessage('ai', `⚠️ ${data.message || 'Maaf, terjadi kesalahan saat menghubungi Gemini AI.'}`);
        }
      } catch (err) {
        thinkingEl.classList.add('hidden');
        sendBtn.disabled = false;
        appendMessage('ai', '⚠️ Tidak dapat terhubung ke server. Pastikan server lokal aktif.');
      }
    }

    // Support Shift+Enter untuk baris baru & Enter untuk kirim
    document.getElementById('chatInput').addEventListener('keydown', function(e) {
      if (e.key === 'Enter' && !e.shiftKey) {
        e.preventDefault();
        document.getElementById('geminiChatForm').dispatchEvent(new Event('submit', { cancelable: true }));
      }
    });

    // Helper escape HTML
    function escapeHtml(text) {
      const map = { '&': '&amp;', '<': '&lt;', '>': '&gt;', '"': '&quot;', "'": '&#039;' };
      return text.replace(/[&<>"']/g, m => map[m]);
    }

    <?php if (!empty($materi) && isset($materi[0])): ?>
    // Auto-set konteks materi aktif ke materi pertama di daftar pada saat halaman materi dibuka
    document.addEventListener('DOMContentLoaded', function() {
      setInitialMateriContext(
        '<?= esc($materi[0]['judul'], 'js') ?>',
        '<?= esc($materi[0]['deskripsi'], 'js') ?>',
        '<?= esc($materi[0]['mapel'] ?? '', 'js') ?>'
      );
    });
    <?php endif; ?>
  </script>
</body>
</html>
