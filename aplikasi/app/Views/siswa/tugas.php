<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Tugas Siswa - Room Learning SMP</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
  <style>
    body { font-family: 'Plus Jakarta Sans', sans-serif; }
    .custom-scrollbar::-webkit-scrollbar { width: 6px; height: 6px; }
    .custom-scrollbar::-webkit-scrollbar-track { background: #f1f5f9; }
    .custom-scrollbar::-webkit-scrollbar-thumb { background: #cbd5e1; border-radius: 4px; }
    .custom-scrollbar::-webkit-scrollbar-thumb:hover { background: #94a3b8; }
  </style>
</head>
<body class="bg-slate-50/60 text-slate-800 flex h-screen overflow-hidden">

  <!-- Desktop Permanent Sidebar (Fresh Teal Theme for Siswa) -->
  <aside id="desktopSidebar" class="hidden md:flex w-64 bg-white border-r border-slate-200/80 flex-col justify-between shrink-0 p-4 shadow-sm z-20 transition-all duration-300">
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

      <!-- Navigation Links -->
      <nav class="space-y-1">
        <a href="<?= site_url('siswa/dashboard') ?>" class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl text-slate-600 hover:bg-slate-50 hover:text-slate-900 font-semibold text-xs transition">
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
        <a href="<?= site_url('siswa/tugas') ?>" class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl bg-teal-50 text-teal-700 font-bold text-xs shadow-xs transition">
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
          <div class="w-8 h-8 rounded-full bg-teal-600 text-white font-bold text-xs flex items-center justify-center shrink-0 shadow-xs">
            <?= strtoupper(substr($user['nama'] ?? session()->get('user_name') ?? 'R', 0, 1)) ?>
          </div>
          <div class="overflow-hidden">
            <p class="text-xs font-bold text-slate-800 truncate"><?= esc($user['nama'] ?? session()->get('user_name') ?? 'Rizky Pratama') ?></p>
            <p class="text-[10px] text-teal-700 font-semibold">Kelas: <?= esc(!empty($kelas_siswa) ? ($kelas_siswa === 'VIII' ? 'VIII A' : $kelas_siswa) : 'VIII A') ?></p>
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

  <!-- Mobile Sidebar Backdrop & Drawer -->
  <div id="sidebarBackdrop" onclick="toggleMobileSidebar()" class="fixed inset-0 bg-slate-900/40 backdrop-blur-xs z-40 hidden md:hidden transition-opacity"></div>
  <aside id="mobileSidebar" class="md:hidden fixed top-0 left-0 bottom-0 w-72 bg-white z-50 shadow-2xl transform -translate-x-full transition-transform duration-300 ease-in-out flex flex-col justify-between p-5">
    <div>
      <div class="flex items-center justify-between pb-4 border-b border-slate-100 mb-4">
        <div class="flex items-center gap-2.5">
          <div class="w-9 h-9 bg-gradient-to-tr from-teal-600 to-emerald-500 text-white rounded-xl flex items-center justify-center font-bold text-sm shadow-md shadow-teal-500/20">
            <i class="fa-solid fa-graduation-cap"></i>
          </div>
          <div>
            <h2 class="font-extrabold text-sm text-slate-800 leading-tight">Room Learning</h2>
            <span class="text-[10px] font-bold text-teal-600 tracking-wider">Siswa SMP</span>
          </div>
        </div>
        <button type="button" onclick="toggleMobileSidebar()" class="w-8 h-8 rounded-lg text-slate-400 hover:bg-slate-100 flex items-center justify-center">
          <i class="fa-solid fa-xmark text-sm"></i>
        </button>
      </div>

      <nav class="space-y-1">
        <a href="<?= site_url('siswa/dashboard') ?>" class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl text-slate-600 hover:bg-slate-50 font-semibold text-xs transition">
          <i class="fa-solid fa-house w-4 text-center"></i>
          <span>Beranda Belajar</span>
        </a>
        <a href="<?= site_url('siswa/jadwal') ?>" class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl text-slate-600 hover:bg-slate-50 font-semibold text-xs transition">
          <i class="fa-regular fa-calendar-days w-4 text-center"></i>
          <span>Jadwal Kelas Saya</span>
        </a>
        <a href="<?= site_url('siswa/materi') ?>" class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl text-slate-600 hover:bg-slate-50 font-semibold text-xs transition">
          <i class="fa-regular fa-book-open w-4 text-center"></i>
          <span>Materi Pelajaran</span>
        </a>
        <a href="<?= site_url('siswa/tugas') ?>" class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl bg-teal-50 text-teal-700 font-bold text-xs shadow-xs transition">
          <i class="fa-regular fa-clipboard-check w-4 text-center"></i>
          <span>Tugas & Pengumpulan</span>
        </a>
        <a href="<?= site_url('siswa/profil') ?>" class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl text-slate-600 hover:bg-slate-50 font-semibold text-xs transition">
          <i class="fa-regular fa-user w-4 text-center"></i>
          <span>Profil Saya</span>
        </a>
        <a href="<?= site_url('gemini') ?>" class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl text-slate-600 hover:bg-slate-50 font-semibold text-xs transition">
          <i class="fa-solid fa-robot text-teal-500 w-4 text-center"></i>
          <span>Tanya Gemini AI</span>
        </a>
      </nav>
    </div>

    <div>
      <a href="<?= site_url('logout') ?>" class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl text-rose-500 hover:bg-rose-50 font-bold text-xs transition">
        <i class="fa-solid fa-right-from-bracket w-4 text-center"></i>
        <span>Keluar Akun</span>
      </a>
    </div>
  </aside>

  <!-- Right Main Area Container -->
  <div class="flex-1 flex flex-col h-screen overflow-hidden">
    
    <!-- Top Navigation Bar -->
    <header class="bg-white border-b border-slate-200/80 px-6 py-3.5 flex items-center justify-between shrink-0 shadow-[0_1px_3px_rgba(0,0,0,0.02)] z-10">
      
      <!-- Left: Mobile Toggle & Desktop Sidebar Toggle -->
      <div class="flex items-center gap-3">
        <!-- Mobile hamburger -->
        <button type="button" onclick="toggleMobileSidebar()" class="md:hidden w-10 h-10 rounded-xl text-slate-700 hover:bg-slate-100 flex items-center justify-center transition focus:outline-none">
          <i class="fa-solid fa-bars text-xl"></i>
        </button>

        <!-- Desktop Toggle button -->
        <button type="button" onclick="toggleDesktopSidebar()" title="Sembunyikan/Tampilkan Sidebar" class="hidden md:flex w-9 h-9 rounded-xl text-slate-600 hover:bg-slate-100 items-center justify-center transition focus:outline-none">
          <i class="fa-solid fa-bars-staggered text-sm"></i>
        </button>

        <div class="text-xs text-slate-400 font-medium hidden sm:block">
          <span class="text-teal-700 font-bold">Ruang Belajar</span> / Tugas Siswa
        </div>
      </div>

      <!-- Right: Notifications & Profile -->
      <div class="flex items-center gap-3">
        <!-- Notification Bell -->
        <button type="button" class="relative w-10 h-10 rounded-xl text-slate-600 hover:bg-slate-100 flex items-center justify-center transition">
          <i class="fa-regular fa-bell text-lg"></i>
          <span class="absolute top-2.5 right-2.5 w-2 h-2 bg-rose-500 rounded-full ring-2 ring-white"></span>
        </button>

        <!-- Profile Widget with Dropdown -->
        <div class="relative" id="profileDropdownContainer">
          <button type="button" onclick="toggleProfileDropdown()" class="flex items-center gap-3 p-1 pl-2 pr-3 rounded-2xl hover:bg-slate-100/80 transition text-left focus:outline-none">
            <div class="w-9 h-9 rounded-full bg-gradient-to-tr from-teal-600 to-emerald-500 text-white font-bold text-xs flex items-center justify-center shadow-sm overflow-hidden ring-2 ring-teal-100">
              <img src="https://api.dicebear.com/7.x/avataaars/svg?seed=<?= urlencode($user['nama'] ?? 'Rizky Pratama') ?>&backgroundColor=b6e3f4" alt="Avatar" class="w-full h-full object-cover">
            </div>
            <div class="hidden sm:block">
              <p class="text-xs font-bold text-slate-800 leading-tight"><?= esc($user['nama'] ?? session()->get('user_name') ?? 'Rizky Pratama') ?></p>
              <p class="text-[10px] text-teal-600 font-semibold">Kelas <?= esc(!empty($kelas_siswa) ? ($kelas_siswa === 'VIII' ? 'VIII A' : $kelas_siswa) : 'VIII A') ?></p>
            </div>
            <i class="fa-solid fa-chevron-down text-[10px] text-slate-400 ml-0.5"></i>
          </button>

          <!-- Dropdown Menu -->
          <div id="profileDropdown" class="hidden absolute right-0 mt-2 w-52 bg-white rounded-2xl border border-slate-100 shadow-xl py-2 z-50">
            <div class="px-4 py-2.5 border-b border-slate-100">
              <p class="text-xs font-bold text-slate-800"><?= esc($user['nama'] ?? 'Rizky Pratama') ?></p>
              <p class="text-[11px] text-slate-400"><?= esc($user['email'] ?? session()->get('user_email') ?? 'siswa@roomlearning.sch.id') ?></p>
            </div>
            <a href="<?= site_url('siswa/profil') ?>" class="flex items-center gap-2.5 px-4 py-2 text-xs text-slate-600 hover:bg-slate-50 font-medium transition">
              <i class="fa-regular fa-user text-slate-400 w-4"></i> Profil Saya
            </a>
            <a href="<?= site_url('siswa/dashboard') ?>" class="flex items-center gap-2.5 px-4 py-2 text-xs text-slate-600 hover:bg-slate-50 font-medium transition">
              <i class="fa-solid fa-house text-slate-400 w-4"></i> Beranda Belajar
            </a>
            <div class="border-t border-slate-100 my-1"></div>
            <a href="<?= site_url('logout') ?>" class="flex items-center gap-2.5 px-4 py-2 text-xs text-rose-500 hover:bg-rose-50 font-bold transition">
              <i class="fa-solid fa-right-from-bracket text-rose-500 w-4"></i> Keluar
            </a>
          </div>
        </div>

      </div>
    </header>

    <!-- Scrollable Main View Area -->
    <main class="flex-1 overflow-y-auto custom-scrollbar p-6 lg:p-8">
      <div class="max-w-7xl mx-auto">
        
        <!-- Flash Messages -->
        <?php if (session()->getFlashdata('success')): ?>
          <div class="mb-5 bg-emerald-50 border border-emerald-200 text-emerald-800 rounded-2xl p-4 text-xs font-semibold flex items-center justify-between shadow-sm">
            <div class="flex items-center gap-2.5">
              <i class="fa-solid fa-circle-check text-emerald-600 text-base"></i>
              <span><?= esc(session()->getFlashdata('success')) ?></span>
            </div>
            <button type="button" onclick="this.parentElement.remove()" class="text-emerald-500 hover:text-emerald-700">
              <i class="fa-solid fa-xmark"></i>
            </button>
          </div>
        <?php endif; ?>

        <?php if (session()->getFlashdata('error')): ?>
          <div class="mb-5 bg-rose-50 border border-rose-200 text-rose-800 rounded-2xl p-4 text-xs font-semibold flex items-center justify-between shadow-sm">
            <div class="flex items-center gap-2.5">
              <i class="fa-solid fa-circle-exclamation text-rose-600 text-base"></i>
              <span><?= esc(session()->getFlashdata('error')) ?></span>
            </div>
            <button type="button" onclick="this.parentElement.remove()" class="text-rose-500 hover:text-rose-700">
              <i class="fa-solid fa-xmark"></i>
            </button>
          </div>
        <?php endif; ?>

        <!-- Header Section (Icon, Title, Subtitle, and Search Box) -->
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-6">
          
          <!-- Left: Title with Teal/Emerald Clipboard Icon -->
          <div class="flex items-center gap-3.5">
            <div class="w-12 h-12 rounded-2xl bg-teal-50 border border-teal-100 text-teal-600 flex items-center justify-center text-xl shadow-sm shrink-0">
              <i class="fa-solid fa-clipboard-list"></i>
            </div>
            <div>
              <h1 class="text-2xl font-black text-slate-900 tracking-tight">Tugas</h1>
              <p class="text-xs text-slate-400 font-medium mt-0.5">Lihat dan kerjakan tugas yang diberikan oleh guru</p>
            </div>
          </div>

          <!-- Right: Search Input -->
          <div class="relative w-full md:w-72 lg:w-80">
            <i class="fa-solid fa-magnifying-glass absolute left-3.5 top-1/2 -translate-y-1/2 text-slate-400 text-xs"></i>
            <input 
              type="text" 
              id="searchInput" 
              oninput="handleSearch()" 
              placeholder="Cari tugas..." 
              class="w-full pl-9 pr-4 py-2.5 bg-white border border-slate-200 rounded-xl text-xs text-slate-700 placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-teal-500/20 focus:border-teal-500 transition shadow-sm"
            >
          </div>
        </div>

        <!-- Filter Pills (Semua, Belum Dikerjakan, Sudah Dikerjakan) -->
        <div class="flex items-center gap-2.5 mb-6 overflow-x-auto pb-1">
          <button 
            type="button" 
            id="pill-semua" 
            onclick="setFilter('semua')" 
            class="filter-pill px-5 py-2 rounded-full text-xs font-bold transition shadow-sm bg-teal-600 text-white cursor-pointer"
          >
            Semua
          </button>
          <button 
            type="button" 
            id="pill-belum" 
            onclick="setFilter('belum')" 
            class="filter-pill px-5 py-2 rounded-full text-xs font-semibold transition border border-slate-200 bg-white text-slate-600 hover:bg-slate-50 cursor-pointer"
          >
            Belum Dikerjakan
          </button>
          <button 
            type="button" 
            id="pill-sudah" 
            onclick="setFilter('sudah')" 
            class="filter-pill px-5 py-2 rounded-full text-xs font-semibold transition border border-slate-200 bg-white text-slate-600 hover:bg-slate-50 cursor-pointer"
          >
            Sudah Dikerjakan
          </button>
        </div>

        <!-- Main Two-Column Layout -->
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-6 items-start">
          
          <!-- LEFT COLUMN: List of Task Cards (7 cols) -->
          <div class="lg:col-span-7 space-y-3.5" id="taskCardsList">
            <?php if (empty($tugas)): ?>
              <div class="bg-white rounded-3xl p-10 text-center border border-slate-200/80 shadow-sm">
                <div class="w-14 h-14 bg-slate-100 text-slate-400 rounded-2xl flex items-center justify-center mx-auto mb-3 text-2xl">
                  <i class="fa-regular fa-clipboard"></i>
                </div>
                <h3 class="font-bold text-slate-800 text-sm">Belum Ada Tugas</h3>
                <p class="text-xs text-slate-400 mt-1">Saat ini belum ada tugas untuk kelas Anda.</p>
              </div>
            <?php else: ?>
              <?php foreach ($tugas as $index => $item): ?>
                <?php
                  $isSubmitted = !empty($item['submitted']);
                  $statusKey = $isSubmitted ? 'sudah' : 'belum';
                  
                  // Deteksi warna dan mata pelajaran dari judul
                  $judul = $item['judul'];
                  $colorTheme = 'blue';
                  $subjectName = 'Mata Pelajaran';
                  
                  if (stripos($judul, 'matematika') !== false) {
                    $colorTheme = 'blue';
                    $subjectName = 'Matematika';
                  } elseif (stripos($judul, 'ipa') !== false) {
                    $colorTheme = 'emerald';
                    $subjectName = 'IPA';
                  } elseif (stripos($judul, 'bahasa indonesia') !== false || stripos($judul, 'indonesia') !== false) {
                    $colorTheme = 'indigo';
                    $subjectName = 'Bahasa Indonesia';
                  } elseif (stripos($judul, 'inggris') !== false || stripos($judul, 'english') !== false) {
                    $colorTheme = 'amber';
                    $subjectName = 'Bahasa Inggris';
                  } elseif (stripos($judul, 'ppkn') !== false || stripos($judul, 'pkn') !== false) {
                    $colorTheme = 'rose';
                    $subjectName = 'PPKn';
                  }

                  $badgeStyles = [
                    'blue'    => ['bg' => 'bg-blue-50', 'text' => 'text-blue-600', 'border' => 'border-blue-100'],
                    'emerald' => ['bg' => 'bg-emerald-50', 'text' => 'text-emerald-600', 'border' => 'border-emerald-100'],
                    'indigo'  => ['bg' => 'bg-indigo-50', 'text' => 'text-indigo-600', 'border' => 'border-indigo-100'],
                    'amber'   => ['bg' => 'bg-amber-50', 'text' => 'text-amber-600', 'border' => 'border-amber-100'],
                    'rose'    => ['bg' => 'bg-rose-50', 'text' => 'text-rose-600', 'border' => 'border-rose-100'],
                  ];
                  $style = $badgeStyles[$colorTheme] ?? $badgeStyles['blue'];

                  // Format deadline
                  $deadlineFormatted = 'Tanpa batas waktu';
                  if (!empty($item['deadline'])) {
                    $ts = strtotime($item['deadline']);
                    $deadlineFormatted = date('d M Y, H:i', $ts);
                    if (date('H:i', $ts) === '00:00') {
                      $deadlineFormatted = date('d M Y, 23:59', $ts);
                    }
                  }

                  $kelasDisplay = !empty($item['kelas']) && $item['kelas'] !== 'Semua' ? 'Kelas ' . $item['kelas'] . ($item['kelas'] === 'VIII' ? ' A' : '') : (!empty($kelas_siswa) ? 'Kelas ' . $kelas_siswa . ' A' : 'Semua Kelas');
                  $metaDisplay = $subjectName . '  •  ' . $kelasDisplay;
                ?>

                <div 
                  id="task-card-<?= $item['id'] ?>"
                  onclick="selectTask(<?= $item['id'] ?>)"
                  data-id="<?= $item['id'] ?>"
                  data-status="<?= $statusKey ?>"
                  data-judul="<?= esc($item['judul']) ?>"
                  data-meta="<?= esc($metaDisplay) ?>"
                  data-deadline="<?= esc($deadlineFormatted) ?>"
                  data-deskripsi="<?= esc($item['deskripsi']) ?>"
                  data-link-eksternal="<?= esc($item['link_eksternal'] ?? '') ?>"
                  data-colortheme="<?= $colorTheme ?>"
                  data-submitted="<?= $isSubmitted ? 'true' : 'false' ?>"
                  data-nilai="<?= esc($item['nilai'] ?? '') ?>"
                  data-substatus="<?= esc($item['status'] ?? '') ?>"
                  data-komentar="<?= esc($item['komentar'] ?? '') ?>"
                  data-file="<?= esc($item['file'] ?? '') ?>"
                  data-submitted-at="<?= !empty($item['submitted_at']) ? date('d M Y, H:i', strtotime($item['submitted_at'])) : '' ?>"
                  class="task-card bg-white rounded-2xl border border-slate-200/80 p-4 sm:p-5 shadow-[0_1px_3px_rgba(0,0,0,0.02)] hover:shadow-md transition cursor-pointer flex flex-col sm:flex-row sm:items-center justify-between gap-4 <?= $index === 0 ? 'ring-2 ring-teal-500 border-transparent' : '' ?>"
                >
                  <!-- Card Left Content -->
                  <div class="flex items-start gap-4">
                    <div class="w-12 h-12 rounded-2xl <?= $style['bg'] ?> <?= $style['text'] ?> <?= $style['border'] ?> border flex items-center justify-center text-lg shrink-0 mt-0.5">
                      <i class="fa-solid fa-file-lines"></i>
                    </div>
                    <div>
                      <h3 class="font-bold text-slate-800 text-sm leading-snug"><?= esc($item['judul']) ?></h3>
                      <p class="text-xs text-slate-400 font-medium mt-1"><?= esc($metaDisplay) ?></p>
                      <div class="flex items-center gap-1.5 text-xs text-slate-500 mt-2 font-medium">
                        <i class="fa-regular fa-calendar-days text-[11px] text-slate-400"></i>
                        <span>Jatuh tempo: <?= esc($deadlineFormatted) ?></span>
                      </div>
                      <?php if (!empty($item['link_eksternal'])): ?>
                        <div class="mt-2.5">
                          <a href="<?= esc($item['link_eksternal']) ?>" target="_blank" rel="noopener noreferrer" onclick="event.stopPropagation();" class="inline-flex items-center gap-1.5 px-3 py-1 bg-purple-50 text-purple-700 hover:bg-purple-100 border border-purple-200 rounded-xl text-xs font-bold transition shadow-2xs">
                            <i class="fa-solid fa-arrow-up-right-from-square text-[10px] text-purple-600"></i>
                            <span>Buka Google Form / Ujian</span>
                          </a>
                        </div>
                      <?php endif; ?>
                    </div>
                  </div>

                  <!-- Card Right Content (Status & Button) -->
                  <div class="flex sm:flex-col items-center sm:items-end justify-between sm:justify-center gap-3 shrink-0">
                    <?php if ($isSubmitted): ?>
                      <span class="bg-emerald-50 text-emerald-600 font-semibold text-xs px-3.5 py-1 rounded-full border border-emerald-100">
                        Sudah Dikerjakan
                      </span>
                      <button 
                        type="button" 
                        onclick="event.stopPropagation(); selectTask(<?= $item['id'] ?>);" 
                        class="bg-white hover:bg-teal-50/50 border border-slate-200 hover:border-teal-200 text-slate-700 hover:text-teal-700 font-bold text-xs px-4 py-2 rounded-xl flex items-center gap-1.5 shadow-xs transition"
                      >
                        <i class="fa-regular fa-eye text-xs text-slate-500"></i>
                        <span>Lihat</span>
                      </button>
                    <?php else: ?>
                      <span class="bg-rose-50 text-rose-500 font-semibold text-xs px-3.5 py-1 rounded-full border border-rose-100">
                        Belum Dikerjakan
                      </span>
                      <button 
                        type="button" 
                        onclick="event.stopPropagation(); selectTask(<?= $item['id'] ?>); openUploadModal();" 
                        class="bg-teal-600 hover:bg-teal-700 text-white font-bold text-xs px-4 py-2 rounded-xl flex items-center gap-1.5 shadow-sm shadow-teal-500/20 transition"
                      >
                        <span>Kerjakan</span>
                        <i class="fa-solid fa-chevron-right text-[10px]"></i>
                      </button>
                    <?php endif; ?>
                  </div>
                </div>
              <?php endforeach; ?>
            <?php endif; ?>

            <!-- Empty Search Result Alert -->
            <div id="noMatchMessage" class="hidden bg-white rounded-3xl p-8 text-center border border-slate-200/80 shadow-sm">
              <i class="fa-solid fa-magnifying-glass text-2xl text-slate-300 mb-2"></i>
              <p class="text-xs font-bold text-slate-700">Tugas tidak ditemukan</p>
              <p class="text-[11px] text-slate-400 mt-0.5">Coba cari dengan kata kunci lain atau pilih filter lainnya.</p>
            </div>
          </div>

          <!-- RIGHT COLUMN: Assignment Detail Panel (5 cols) -->
          <div class="lg:col-span-5">
            <div class="bg-white rounded-3xl border border-slate-200/80 p-6 shadow-sm sticky top-6">
              
              <!-- Header of Detail Panel -->
              <div class="flex items-start gap-3.5 pb-4 border-b border-slate-100">
                <div id="detailIconBox" class="w-11 h-11 rounded-2xl bg-blue-50 text-blue-600 border border-blue-100 flex items-center justify-center text-lg shrink-0">
                  <i class="fa-solid fa-file-lines"></i>
                </div>
                <div class="flex-1">
                  <h2 id="detailJudul" class="font-bold text-slate-900 text-sm leading-snug">Pilih tugas</h2>
                  <p id="detailMeta" class="text-xs text-slate-400 font-medium mt-1">-</p>
                  <div class="flex items-center gap-1.5 text-xs text-slate-500 mt-2 font-medium">
                    <i class="fa-regular fa-calendar-days text-[11px] text-slate-400"></i>
                    <span id="detailDeadline">-</span>
                  </div>
                  <div class="mt-3">
                    <span id="detailStatusBadge" class="bg-rose-50 text-rose-500 font-semibold text-xs px-3 py-1 rounded-full border border-rose-100 inline-block">
                      Belum Dikerjakan
                    </span>
                  </div>
                </div>
              </div>

              <!-- Section 1: Deskripsi Tugas -->
              <div class="mt-5">
                <div class="flex items-center gap-2 text-xs font-bold text-slate-800 mb-2">
                  <i class="fa-solid fa-bars-staggered text-slate-400"></i>
                  <span>Deskripsi Tugas</span>
                </div>
                <p id="detailDeskripsi" class="text-xs text-slate-600 leading-relaxed font-normal">
                  -
                </p>
              </div>

              <!-- Section: Link Eksternal / Ujian Online (Google Form) -->
              <div id="detailExternalLinkSection" class="hidden mt-4 p-3.5 bg-gradient-to-r from-purple-50 to-indigo-50 border border-purple-200/80 rounded-2xl">
                <div class="flex items-center gap-2 text-xs font-bold text-purple-900 mb-1">
                  <i class="fa-solid fa-square-poll-horizontal text-purple-600 text-sm"></i>
                  <span>Tautan Soal / Google Form</span>
                </div>
                <p class="text-[11px] text-purple-700 leading-relaxed mb-2.5">
                  Guru melampirkan link ujian / formulir daring untuk tugas ini. Silakan buka tautan berikut:
                </p>
                <a id="detailExternalLinkBtn" href="#" target="_blank" rel="noopener noreferrer" class="inline-flex items-center justify-center gap-2 w-full py-2.5 px-4 bg-purple-600 hover:bg-purple-700 text-white font-bold text-xs rounded-xl shadow-sm shadow-purple-500/20 transition">
                  <i class="fa-solid fa-arrow-up-right-from-square"></i>
                  <span>Buka Lembar Soal (Google Form)</span>
                </a>
              </div>

              <!-- Section 2: Lampiran -->
              <div class="mt-5">
                <div class="flex items-center justify-between mb-2.5">
                  <div class="flex items-center gap-2 text-xs font-bold text-slate-800">
                    <i class="fa-solid fa-paperclip text-slate-400"></i>
                    <span>Lampiran Dokumen</span>
                  </div>
                  <span class="text-[10px] text-teal-600 font-semibold cursor-pointer hover:underline" onclick="previewCurrentAttachment()">
                    <i class="fa-solid fa-eye text-[9px] mr-1"></i>Klik untuk melihat
                  </span>
                </div>
                
                <div onclick="previewCurrentAttachment()" class="bg-slate-50/80 border border-slate-200/80 rounded-2xl p-3 flex items-center justify-between gap-3 hover:bg-teal-50/40 hover:border-teal-200 transition cursor-pointer group">
                  <div class="flex items-center gap-3 overflow-hidden">
                    <div class="w-9 h-9 rounded-xl bg-red-100 text-red-600 flex items-center justify-center text-xs font-black shrink-0 group-hover:scale-105 transition">
                      PDF
                    </div>
                    <div class="overflow-hidden">
                      <p id="detailAttachmentName" class="text-xs font-bold text-slate-800 truncate group-hover:text-teal-700 transition">Soal_Persamaan_Linear.pdf</p>
                      <p id="detailAttachmentSize" class="text-[10px] text-slate-400 font-medium">2.4 MB</p>
                    </div>
                  </div>
                  <div class="flex items-center gap-1.5 shrink-0" onclick="event.stopPropagation()">
                    <button 
                      type="button" 
                      onclick="previewCurrentAttachment()" 
                      class="px-2.5 py-1.5 rounded-xl bg-teal-50 text-teal-700 border border-teal-200 hover:bg-teal-100 text-[11px] font-bold flex items-center gap-1 transition shadow-2xs" 
                      title="Lihat Pratinjau PDF"
                    >
                      <i class="fa-solid fa-eye text-[10px]"></i>
                      <span>Lihat</span>
                    </button>
                    <a 
                      id="detailDownloadBtn" 
                      href="#" 
                      download
                      class="w-8 h-8 rounded-xl bg-white border border-slate-200 text-slate-600 hover:text-teal-600 hover:border-teal-200 flex items-center justify-center text-xs shadow-xs transition" 
                      title="Unduh Lampiran"
                    >
                      <i class="fa-solid fa-download"></i>
                    </a>
                  </div>
                </div>
              </div>

              <!-- Section 3: Cara Pengumpulan & Status Pengumpulan -->
              <div class="mt-6 pt-5 border-t border-slate-100">
                <div class="flex items-center gap-2 text-xs font-bold text-slate-800 mb-1.5">
                  <i class="fa-solid fa-cloud-arrow-up text-slate-400"></i>
                  <span>Cara Pengumpulan</span>
                </div>
                <p class="text-xs text-slate-400 font-medium mb-3">Upload file tugas melalui tombol di bawah ini.</p>

                <!-- Box info jika sudah dikumpulkan -->
                <div id="detailSubmissionInfo" class="hidden mb-3 bg-emerald-50/70 border border-emerald-200/80 rounded-2xl p-3 text-xs">
                  <div class="flex items-center justify-between mb-1.5">
                    <span class="font-bold text-emerald-800 flex items-center gap-1.5">
                      <i class="fa-solid fa-circle-check text-emerald-600"></i> Berkas Terkirim
                    </span>
                    <span id="detailSubmissionDate" class="text-[10px] text-emerald-600 font-medium"></span>
                  </div>
                  
                  <div class="bg-white/80 p-2 rounded-xl border border-emerald-100 flex items-center justify-between gap-2 mt-1">
                    <div class="flex items-center gap-2 overflow-hidden">
                      <i class="fa-solid fa-file-pdf text-red-500 text-sm shrink-0"></i>
                      <p id="detailSubmissionFileName" class="text-[11px] text-slate-700 font-semibold truncate"></p>
                    </div>
                    <button 
                      type="button" 
                      id="btnPreviewSubmission" 
                      onclick="previewSubmittedFile()" 
                      class="px-2.5 py-1 rounded-lg bg-teal-50 hover:bg-teal-100 border border-teal-200 text-teal-800 text-[10px] font-bold flex items-center gap-1 shrink-0 transition"
                      title="Lihat Berkas Terkirim"
                    >
                      <i class="fa-solid fa-eye text-[9px]"></i>
                      <span>Lihat PDF</span>
                    </button>
                  </div>
                  
                  <!-- Nilai Badge jika dinilai -->
                  <div id="detailGradeBox" class="hidden mt-2 pt-2 border-t border-emerald-100 flex items-center justify-between">
                    <span class="text-xs font-bold text-emerald-900 flex items-center gap-1">
                      <i class="fa-solid fa-award text-amber-500"></i> Nilai Tugas:
                    </span>
                    <span id="detailGradeValue" class="text-xs font-black bg-emerald-600 text-white px-2.5 py-0.5 rounded-full"></span>
                  </div>

                  <!-- Komentar Guru jika ada -->
                  <div id="detailTeacherCommentBox" class="hidden mt-2 text-[11px] text-emerald-900 bg-white/60 p-2 rounded-xl border border-emerald-100">
                    <strong class="block text-[10px] text-slate-500 uppercase tracking-wider font-bold">Catatan Guru:</strong>
                    <span id="detailTeacherComment"></span>
                  </div>
                </div>

                <!-- Upload CTA Button (Teal Theme) -->
                <button 
                  type="button" 
                  id="detailUploadBtn" 
                  onclick="openUploadModal()" 
                  class="w-full bg-teal-600 hover:bg-teal-700 text-white font-bold py-3 px-4 rounded-xl text-xs shadow-md shadow-teal-500/20 transition flex items-center justify-center gap-2"
                >
                  <i class="fa-solid fa-arrow-up-from-bracket"></i>
                  <span id="detailUploadBtnText">Upload Tugas</span>
                </button>
              </div>

            </div>
          </div>

        </div>
      </div>
    </main>
  </div>

  <!-- Upload Modal Dialog -->
  <div id="uploadModal" class="fixed inset-0 bg-slate-900/50 backdrop-blur-xs z-50 hidden flex items-center justify-center p-4">
    <div class="bg-white rounded-3xl max-w-md w-full p-6 shadow-2xl border border-slate-100 animate-in fade-in zoom-in-95 duration-200">
      
      <!-- Modal Header -->
      <div class="flex items-center justify-between pb-4 border-b border-slate-100">
        <div class="flex items-center gap-2.5">
          <div class="w-8 h-8 rounded-xl bg-teal-50 text-teal-600 flex items-center justify-center text-sm font-bold">
            <i class="fa-solid fa-cloud-arrow-up"></i>
          </div>
          <h3 class="font-extrabold text-sm text-slate-800">Upload Tugas</h3>
        </div>
        <button type="button" onclick="closeUploadModal()" class="w-8 h-8 rounded-xl text-slate-400 hover:bg-slate-100 flex items-center justify-center transition">
          <i class="fa-solid fa-xmark text-sm"></i>
        </button>
      </div>

      <!-- Target Assignment Summary -->
      <div class="mt-4 p-3 bg-slate-50 rounded-2xl border border-slate-100">
        <p class="text-[10px] font-bold text-slate-400 uppercase tracking-wider">Tugas:</p>
        <p id="modalTaskTitle" class="text-xs font-bold text-slate-800 leading-snug mt-0.5">-</p>
        <div id="modalExternalLinkBox" class="hidden mt-2 pt-2 border-t border-slate-200/80">
          <a id="modalExternalLinkBtn" href="#" target="_blank" rel="noopener noreferrer" class="inline-flex items-center gap-1.5 text-[11px] font-bold text-purple-600 hover:text-purple-800">
            <i class="fa-solid fa-arrow-up-right-from-square"></i>
            <span>Buka Tautan Google Form / Soal Ujian</span>
          </a>
        </div>
      </div>

      <!-- Upload Form -->
      <form action="<?= site_url('siswa/tugas/submit') ?>" method="post" enctype="multipart/form-data" class="space-y-4 mt-4">
        <?= csrf_field() ?>
        <input type="hidden" name="tugas_id" id="modalTugasId" value="">

        <div>
          <label class="text-xs font-bold text-slate-700 block mb-1.5">Pilih Berkas Tugas (PDF, Word, Foto)</label>
          <div class="border-2 border-dashed border-slate-200 hover:border-teal-400 rounded-2xl p-4 text-center bg-slate-50/50 transition cursor-pointer relative">
            <input 
              type="file" 
              name="file" 
              id="modalFileInput" 
              required 
              onchange="handleFileSelected(this)" 
              class="absolute inset-0 opacity-0 cursor-pointer w-full h-full"
            >
            <div id="dropzoneEmpty">
              <i class="fa-solid fa-arrow-up-from-bracket text-teal-600 text-xl mb-1.5"></i>
              <p class="text-xs font-bold text-slate-700">Klik untuk memilih file tugas</p>
              <p class="text-[10px] text-slate-400 mt-0.5">Maksimal ukuran 10 MB (PDF, DOCX, JPG, PNG)</p>
            </div>
            <div id="dropzoneFile" class="hidden text-left bg-white p-2.5 rounded-xl border border-teal-200 flex items-center justify-between">
              <div class="flex items-center gap-2 overflow-hidden">
                <i class="fa-solid fa-file text-teal-600 text-sm shrink-0"></i>
                <span id="selectedFileName" class="text-xs font-bold text-slate-800 truncate">file.pdf</span>
              </div>
              <span id="selectedFileSize" class="text-[10px] text-slate-400 shrink-0 font-medium"></span>
            </div>
          </div>
        </div>

        <div>
          <label class="text-xs font-bold text-slate-700 block mb-1.5">Catatan Tambahan (Opsional)</label>
          <textarea 
            name="komentar" 
            rows="3" 
            placeholder="Tuliskan catatan singkat jika ada..." 
            class="w-full p-3 border border-slate-200 rounded-2xl text-xs bg-slate-50 focus:outline-none focus:border-teal-500 focus:bg-white transition"
          ></textarea>
        </div>

        <!-- Buttons -->
        <div class="flex items-center gap-2.5 pt-2">
          <button 
            type="button" 
            onclick="closeUploadModal()" 
            class="flex-1 py-2.5 rounded-xl border border-slate-200 text-slate-600 font-bold text-xs hover:bg-slate-50 transition"
          >
            Batal
          </button>
          <button 
            type="submit" 
            class="flex-1 py-2.5 rounded-xl bg-teal-600 hover:bg-teal-700 text-white font-bold text-xs shadow-md shadow-teal-500/20 transition flex items-center justify-center gap-2"
          >
            <i class="fa-solid fa-paper-plane text-xs"></i>
            <span>Kirim Tugas</span>
          </button>
        </div>
      </form>

    </div>
  </div>

  <!-- PDF Viewer Modal Dialog -->
  <div id="pdfViewerModal" class="fixed inset-0 bg-slate-900/60 backdrop-blur-sm z-50 hidden flex items-center justify-center p-3 sm:p-6">
    <div class="bg-white rounded-3xl w-full max-w-5xl h-[88vh] flex flex-col shadow-2xl border border-slate-100 overflow-hidden animate-in fade-in zoom-in-95 duration-200">
      
      <!-- Modal Header -->
      <div class="px-6 py-3.5 border-b border-slate-100 flex items-center justify-between shrink-0 bg-slate-50/70">
        <div class="flex items-center gap-3 overflow-hidden">
          <div class="w-9 h-9 rounded-xl bg-red-100 text-red-600 flex items-center justify-center font-bold text-sm shrink-0">
            <i class="fa-solid fa-file-pdf"></i>
          </div>
          <div class="overflow-hidden">
            <h3 id="pdfViewerTitle" class="font-extrabold text-sm text-slate-800 truncate">Pratinjau Dokumen PDF</h3>
            <p class="text-[10px] text-slate-400 font-medium">Penampil Dokumen Room Learning SMP</p>
          </div>
        </div>

        <div class="flex items-center gap-2 shrink-0">
          <a id="pdfViewerNewTab" href="#" target="_blank" class="px-3 py-1.5 rounded-xl border border-slate-200 text-slate-600 hover:text-slate-900 hover:bg-white text-xs font-semibold flex items-center gap-1.5 transition shadow-2xs">
            <i class="fa-solid fa-arrow-up-right-from-square text-[11px]"></i>
            <span class="hidden sm:inline">Buka di Tab Baru</span>
          </a>
          <a id="pdfViewerDownload" href="#" download class="px-3 py-1.5 rounded-xl bg-teal-600 hover:bg-teal-700 text-white text-xs font-bold flex items-center gap-1.5 transition shadow-sm shadow-teal-500/20">
            <i class="fa-solid fa-download text-[11px]"></i>
            <span class="hidden sm:inline">Unduh PDF</span>
          </a>
          <button type="button" onclick="closePdfViewerModal()" class="w-9 h-9 rounded-xl text-slate-400 hover:bg-slate-200/60 hover:text-slate-700 flex items-center justify-center transition">
            <i class="fa-solid fa-xmark text-base"></i>
          </button>
        </div>
      </div>

      <!-- Modal Body (Iframe) -->
      <div class="flex-1 w-full h-full bg-slate-100 relative">
        <iframe id="pdfViewerIframe" src="" class="w-full h-full border-0" title="Penampil PDF"></iframe>
      </div>

    </div>
  </div>

  <script>
    // Global state
    let activeFilter = 'semua';
    let selectedTaskId = null;
    const uploadsBaseUrl = '<?= base_url('uploads/') ?>';
    let currentAttachmentUrl = '';
    let currentSubmissionUrl = '';

    // Toggle Desktop Sidebar (Expand / Collapse)
    function toggleDesktopSidebar() {
      const sidebar = document.getElementById('desktopSidebar');
      if (sidebar.classList.contains('md:hidden')) {
        sidebar.classList.remove('md:hidden');
        sidebar.classList.add('md:flex');
      } else {
        sidebar.classList.remove('md:flex');
        sidebar.classList.add('md:hidden');
      }
    }

    // Toggle Mobile Sidebar Drawer
    function toggleMobileSidebar() {
      const drawer = document.getElementById('mobileSidebar');
      const backdrop = document.getElementById('sidebarBackdrop');
      const isClosed = drawer.classList.contains('-translate-x-full');
      
      if (isClosed) {
        drawer.classList.remove('-translate-x-full');
        backdrop.classList.remove('hidden');
      } else {
        drawer.classList.add('-translate-x-full');
        backdrop.classList.add('hidden');
      }
    }

    // Toggle Profile Dropdown
    function toggleProfileDropdown() {
      const dropdown = document.getElementById('profileDropdown');
      dropdown.classList.toggle('hidden');
    }

    // Close dropdown on outside click
    document.addEventListener('click', function(e) {
      const container = document.getElementById('profileDropdownContainer');
      const dropdown = document.getElementById('profileDropdown');
      if (container && !container.contains(e.target) && dropdown && !dropdown.classList.contains('hidden')) {
        dropdown.classList.add('hidden');
      }
    });

    // Select Task and update detail panel
    function selectTask(id) {
      const card = document.getElementById('task-card-' + id);
      if (!card) return;

      selectedTaskId = id;

      // Update card highlighting (Teal Theme)
      document.querySelectorAll('.task-card').forEach(c => {
        c.classList.remove('ring-2', 'ring-teal-500', 'border-transparent');
      });
      card.classList.add('ring-2', 'ring-teal-500', 'border-transparent');

      // Read dataset attributes
      const judul = card.dataset.judul;
      const meta = card.dataset.meta;
      const deadline = card.dataset.deadline;
      const deskripsi = card.dataset.deskripsi;
      const linkEksternal = card.getAttribute('data-link-eksternal') || '';
      const colorTheme = card.dataset.colortheme || 'blue';
      const isSubmitted = card.dataset.submitted === 'true';
      const subStatus = card.dataset.substatus;
      const nilai = card.dataset.nilai;
      const komentar = card.dataset.komentar;
      const fileName = card.dataset.file;
      const submittedAt = card.dataset.submittedAt;

      // Update Detail Header
      document.getElementById('detailJudul').textContent = judul;
      document.getElementById('detailMeta').textContent = meta;
      document.getElementById('detailDeadline').textContent = 'Jatuh tempo: ' + deadline;

      // Update Detail Icon Box Color
      const iconBox = document.getElementById('detailIconBox');
      const colorClasses = {
        'blue': ['bg-blue-50', 'text-blue-600', 'border-blue-100'],
        'emerald': ['bg-emerald-50', 'text-emerald-600', 'border-emerald-100'],
        'indigo': ['bg-indigo-50', 'text-indigo-600', 'border-indigo-100'],
        'amber': ['bg-amber-50', 'text-amber-600', 'border-amber-100'],
        'rose': ['bg-rose-50', 'text-rose-600', 'border-rose-100'],
      };
      iconBox.className = 'w-11 h-11 rounded-2xl flex items-center justify-center text-lg shrink-0 border ' + 
        (colorClasses[colorTheme] || colorClasses['blue']).join(' ');

      // Update Status Badge
      const statusBadge = document.getElementById('detailStatusBadge');
      if (isSubmitted) {
        statusBadge.className = 'bg-emerald-50 text-emerald-600 font-semibold text-xs px-3.5 py-1 rounded-full border border-emerald-100 inline-block';
        statusBadge.textContent = 'Sudah Dikerjakan';
      } else {
        statusBadge.className = 'bg-rose-50 text-rose-500 font-semibold text-xs px-3.5 py-1 rounded-full border border-rose-100 inline-block';
        statusBadge.textContent = 'Belum Dikerjakan';
      }

      // Update Description
      document.getElementById('detailDeskripsi').textContent = deskripsi || 'Tidak ada deskripsi khusus untuk tugas ini.';

      // Update External Link (Google Form / Ujian)
      const externalSection = document.getElementById('detailExternalLinkSection');
      const externalBtn = document.getElementById('detailExternalLinkBtn');
      if (externalSection && externalBtn) {
        if (linkEksternal && linkEksternal.trim() !== '') {
          externalSection.classList.remove('hidden');
          externalBtn.href = linkEksternal;
        } else {
          externalSection.classList.add('hidden');
          externalBtn.href = '#';
        }
      }

      // Generate Lampiran Name from Subject / Title
      let attachmentName = 'Soal_Tugas.pdf';
      let attachmentSize = '2.4 MB';
      if (judul.toLowerCase().includes('matematika')) {
        attachmentName = 'Soal_Persamaan_Linear.pdf';
        attachmentSize = '2.4 MB';
      } else if (judul.toLowerCase().includes('ipa')) {
        attachmentName = 'Panduan_Praktikum_Fotosintesis.pdf';
        attachmentSize = '1.8 MB';
      } else if (judul.toLowerCase().includes('indonesia')) {
        attachmentName = 'Teks_Cerpen_Pilihan_Bab3.pdf';
        attachmentSize = '950 KB';
      } else if (judul.toLowerCase().includes('inggris')) {
        attachmentName = 'Writing_Prompt_Template.pdf';
        attachmentSize = '720 KB';
      } else if (judul.toLowerCase().includes('ppkn')) {
        attachmentName = 'Materi_Nilai_Pancasila.pdf';
        attachmentSize = '1.2 MB';
      }
      document.getElementById('detailAttachmentName').textContent = attachmentName;
      document.getElementById('detailAttachmentSize').textContent = attachmentSize;
      
      // Update Lampiran URL & Download link
      currentAttachmentUrl = uploadsBaseUrl + attachmentName;
      const downloadBtn = document.getElementById('detailDownloadBtn');
      downloadBtn.href = currentAttachmentUrl;
      downloadBtn.setAttribute('download', attachmentName);

      // Submission Information Box
      const subInfoBox = document.getElementById('detailSubmissionInfo');
      const uploadBtnText = document.getElementById('detailUploadBtnText');

      if (isSubmitted) {
        subInfoBox.classList.remove('hidden');
        document.getElementById('detailSubmissionFileName').textContent = fileName || 'Berkas tugas telah diunggah';
        document.getElementById('detailSubmissionDate').textContent = submittedAt ? 'Dikirim: ' + submittedAt : 'Terkirim';

        if (fileName) {
          currentSubmissionUrl = uploadsBaseUrl + fileName;
          document.getElementById('btnPreviewSubmission').classList.remove('hidden');
        } else {
          currentSubmissionUrl = '';
          document.getElementById('btnPreviewSubmission').classList.add('hidden');
        }

        // Grade info
        const gradeBox = document.getElementById('detailGradeBox');
        if (nilai !== null && nilai !== '') {
          gradeBox.classList.remove('hidden');
          document.getElementById('detailGradeValue').textContent = nilai + ' / 100';
        } else {
          gradeBox.classList.add('hidden');
        }

        // Comment info
        const commentBox = document.getElementById('detailTeacherCommentBox');
        if (komentar && komentar.trim() !== '') {
          commentBox.classList.remove('hidden');
          document.getElementById('detailTeacherComment').textContent = komentar;
        } else {
          commentBox.classList.add('hidden');
        }

        uploadBtnText.textContent = 'Upload Ulang Tugas';
      } else {
        subInfoBox.classList.add('hidden');
        currentSubmissionUrl = '';
        uploadBtnText.textContent = 'Upload Tugas';
      }
    }

    // Filter pills (semua, belum, sudah)
    function setFilter(filter) {
      activeFilter = filter;
      
      const pills = {
        'semua': document.getElementById('pill-semua'),
        'belum': document.getElementById('pill-belum'),
        'sudah': document.getElementById('pill-sudah'),
      };

      Object.keys(pills).forEach(k => {
        if (k === filter) {
          pills[k].className = 'filter-pill px-5 py-2 rounded-full text-xs font-bold transition shadow-sm bg-teal-600 text-white cursor-pointer';
        } else {
          pills[k].className = 'filter-pill px-5 py-2 rounded-full text-xs font-semibold transition border border-slate-200 bg-white text-slate-600 hover:bg-slate-50 cursor-pointer';
        }
      });

      applyFilters();
    }

    // Search input handler
    function handleSearch() {
      applyFilters();
    }

    // Apply both search query & filter pills
    function applyFilters() {
      const query = (document.getElementById('searchInput').value || '').toLowerCase().trim();
      const cards = document.querySelectorAll('.task-card');
      let visibleCount = 0;
      let firstVisibleId = null;

      cards.forEach(card => {
        const judul = (card.dataset.judul || '').toLowerCase();
        const meta = (card.dataset.meta || '').toLowerCase();
        const status = card.dataset.status; // 'belum' or 'sudah'

        const matchesQuery = judul.includes(query) || meta.includes(query);
        const matchesFilter = (activeFilter === 'semua') || (activeFilter === status);

        if (matchesQuery && matchesFilter) {
          card.classList.remove('hidden');
          visibleCount++;
          if (!firstVisibleId) {
            firstVisibleId = card.dataset.id;
          }
        } else {
          card.classList.add('hidden');
        }
      });

      const noMatchMsg = document.getElementById('noMatchMessage');
      if (visibleCount === 0) {
        noMatchMsg.classList.remove('hidden');
      } else {
        noMatchMsg.classList.add('hidden');
        if (firstVisibleId && (!selectedTaskId || document.getElementById('task-card-' + selectedTaskId).classList.contains('hidden'))) {
          selectTask(firstVisibleId);
        }
      }
    }

    // Open Upload Modal
    function openUploadModal(forcedId = null) {
      const targetId = forcedId || selectedTaskId;
      if (!targetId) return;

      const card = document.getElementById('task-card-' + targetId);
      if (!card) return;

      document.getElementById('modalTugasId').value = targetId;
      document.getElementById('modalTaskTitle').textContent = card.dataset.judul;
      
      // External link in modal
      const modalExtLink = card.getAttribute('data-link-eksternal') || '';
      const modalExtBox = document.getElementById('modalExternalLinkBox');
      const modalExtBtn = document.getElementById('modalExternalLinkBtn');
      if (modalExtBox && modalExtBtn) {
        if (modalExtLink && modalExtLink.trim() !== '') {
          modalExtBox.classList.remove('hidden');
          modalExtBtn.href = modalExtLink;
        } else {
          modalExtBox.classList.add('hidden');
          modalExtBtn.href = '#';
        }
      }
      
      // Reset dropzone
      document.getElementById('modalFileInput').value = '';
      document.getElementById('dropzoneEmpty').classList.remove('hidden');
      document.getElementById('dropzoneFile').classList.add('hidden');

      document.getElementById('uploadModal').classList.remove('hidden');
    }

    function closeUploadModal() {
      document.getElementById('uploadModal').classList.add('hidden');
    }

    // Open PDF Viewer Modal
    function openPdfViewer(url, title) {
      if (!url) return;
      document.getElementById('pdfViewerTitle').textContent = title || 'Pratinjau Dokumen PDF';
      document.getElementById('pdfViewerIframe').src = url;
      document.getElementById('pdfViewerNewTab').href = url;
      document.getElementById('pdfViewerDownload').href = url;
      document.getElementById('pdfViewerDownload').setAttribute('download', title || 'dokumen.pdf');
      document.getElementById('pdfViewerModal').classList.remove('hidden');
    }

    function closePdfViewerModal() {
      document.getElementById('pdfViewerModal').classList.add('hidden');
      document.getElementById('pdfViewerIframe').src = '';
    }

    function previewCurrentAttachment() {
      const title = document.getElementById('detailAttachmentName').textContent;
      if (currentAttachmentUrl) {
        openPdfViewer(currentAttachmentUrl, title);
      }
    }

    function previewSubmittedFile() {
      const title = document.getElementById('detailSubmissionFileName').textContent;
      if (currentSubmissionUrl) {
        openPdfViewer(currentSubmissionUrl, title);
      }
    }

    // Handle File selected in Modal
    function handleFileSelected(input) {
      if (input.files && input.files[0]) {
        const file = input.files[0];
        document.getElementById('selectedFileName').textContent = file.name;
        document.getElementById('selectedFileSize').textContent = (file.size / (1024 * 1024)).toFixed(2) + ' MB';
        document.getElementById('dropzoneEmpty').classList.add('hidden');
        document.getElementById('dropzoneFile').classList.remove('hidden');
      }
    }

    // Keyboard shortcut Esc to close modals
    document.addEventListener('keydown', (e) => {
      if (e.key === 'Escape') {
        closePdfViewerModal();
        closeUploadModal();
      }
    });

    // Auto-select first card on load
    window.addEventListener('DOMContentLoaded', () => {
      const firstCard = document.querySelector('.task-card');
      if (firstCard) {
        selectTask(firstCard.dataset.id);
      }
    });
  </script>
</body>
</html>
