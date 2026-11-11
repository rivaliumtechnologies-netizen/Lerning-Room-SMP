<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Profil Siswa - Room Learning SMP</title>
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
        <a href="<?= site_url('siswa/profil') ?>" class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl bg-teal-50 text-teal-700 font-bold text-xs shadow-sm transition">
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

  <!-- Main Content Area -->
  <main class="flex-1 overflow-y-auto custom-scrollbar p-6 lg:p-8">
    <div class="max-w-2xl mx-auto">
      <div class="flex items-center justify-between mb-6">
        <div>
          <h1 class="text-2xl font-black text-slate-900 tracking-tight">Profil Akun Siswa</h1>
          <p class="text-xs text-slate-500 mt-1">Kelola data profil belajar dan tingkatan kelasmu.</p>
        </div>
        <a href="<?= site_url('siswa/dashboard') ?>" class="inline-flex items-center gap-2 px-3.5 py-2 rounded-xl bg-white border border-slate-200 text-slate-700 hover:bg-slate-50 text-xs font-bold transition">
          <i class="fa-solid fa-arrow-left text-[11px]"></i>
          <span>Kembali ke Beranda</span>
        </a>
      </div>

      <?php if (session()->getFlashdata('success')): ?>
        <div class="mb-5 bg-emerald-50 border border-emerald-200 text-emerald-800 rounded-2xl p-4 text-xs font-semibold flex items-center gap-2.5 shadow-sm">
          <i class="fa-solid fa-circle-check text-emerald-600 text-base"></i>
          <span><?= esc(session()->getFlashdata('success')) ?></span>
        </div>
      <?php endif; ?>
      <?php if (session()->getFlashdata('error')): ?>
        <div class="mb-5 bg-rose-50 border border-rose-200 text-rose-800 rounded-2xl p-4 text-xs font-semibold flex items-center gap-2.5 shadow-sm">
          <i class="fa-solid fa-circle-exclamation text-rose-600 text-base"></i>
          <span><?= esc(session()->getFlashdata('error')) ?></span>
        </div>
      <?php endif; ?>

      <div class="bg-white rounded-3xl border border-slate-200/80 p-6 lg:p-7 shadow-sm">
        <div class="flex items-center gap-4 mb-6 pb-6 border-b border-slate-100">
          <div class="w-16 h-16 bg-gradient-to-tr from-teal-600 to-emerald-500 text-white rounded-2xl flex items-center justify-center text-2xl font-black shadow-md shadow-teal-500/20">
            <?= strtoupper(substr($user['nama'] ?? 'S', 0, 1)) ?>
          </div>
          <div>
            <h2 class="text-lg font-black text-slate-900"><?= esc($user['nama'] ?? '-') ?></h2>
            <div class="flex items-center gap-2 mt-1">
              <span class="text-xs bg-teal-50 text-teal-700 border border-teal-200 px-3 py-0.5 rounded-full font-bold">
                Peserta Didik SMP
              </span>
              <span class="text-xs text-slate-400">
                Kelas: <strong class="text-slate-700 font-bold"><?= esc($user['kelas'] ?? 'Belum Dipilih') ?></strong>
              </span>
            </div>
          </div>
        </div>

        <form action="<?= site_url('siswa/profil/update') ?>" method="post" class="space-y-4">
          <?= csrf_field() ?>
          <div>
            <label class="block text-[11px] font-bold uppercase tracking-wider text-slate-500 mb-1.5">Nama Lengkap Siswa</label>
            <input type="text" name="nama" value="<?= esc($user['nama'] ?? '') ?>" required class="w-full rounded-2xl border border-slate-200 px-3.5 py-2.5 text-xs outline-none focus:border-teal-500 focus:ring-2 focus:ring-teal-500/10 transition">
          </div>
          <div>
            <label class="block text-[11px] font-bold uppercase tracking-wider text-slate-500 mb-1.5">Alamat Email Akun</label>
            <input type="email" value="<?= esc($user['email'] ?? '') ?>" disabled class="w-full rounded-2xl border border-slate-200 px-3.5 py-2.5 text-xs bg-slate-50 text-slate-500 cursor-not-allowed">
            <span class="text-[10px] text-slate-400 mt-1 block">Email akun dikelola oleh administrator sekolah.</span>
          </div>
          <div>
            <label class="block text-[11px] font-bold uppercase tracking-wider text-slate-500 mb-1.5">Nomor Induk Siswa (NIS / NISN)</label>
            <input type="text" value="<?= esc($user['nis'] ?? '') ?>" disabled class="w-full rounded-2xl border border-slate-200 px-3.5 py-2.5 text-xs bg-slate-50 text-slate-500 cursor-not-allowed">
          </div>
          <div>
            <label class="block text-[11px] font-bold uppercase tracking-wider text-slate-500 mb-1.5">Tingkat Kelas</label>
            <?php $currentKelas = $user['kelas'] ?? ''; ?>
            <select name="kelas" class="w-full rounded-2xl border border-slate-200 px-3.5 py-2.5 text-xs outline-none focus:border-teal-500 bg-white">
              <option value="" <?= empty($currentKelas) ? 'selected' : '' ?>>-- Pilih Kelas --</option>
              <option value="VII" <?= in_array($currentKelas, ['VII', '7']) ? 'selected' : '' ?>>Kelas 7 (VII)</option>
              <option value="VIII" <?= in_array($currentKelas, ['VIII', '8']) ? 'selected' : '' ?>>Kelas 8 (VIII)</option>
              <option value="IX" <?= in_array($currentKelas, ['IX', '9']) ? 'selected' : '' ?>>Kelas 9 (IX)</option>
            </select>
            <span class="text-[10px] text-slate-400 mt-1 block">Pemilihan kelas menentukan jadwal dan tugas yang muncul di akunmu.</span>
          </div>
          
          <div class="pt-2">
            <button type="submit" class="w-full rounded-2xl bg-gradient-to-r from-teal-600 to-emerald-600 px-4 py-3 text-xs font-black text-white hover:from-teal-700 hover:to-emerald-700 shadow-md shadow-teal-500/20 transition flex items-center justify-center gap-2">
              <i class="fa-solid fa-floppy-disk text-xs"></i>
              <span>Simpan Perubahan Profil</span>
            </button>
          </div>
        </form>
      </div>
    </div>
  </main>
</body>
</html>
