<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Profil Guru - Room Learning SMP</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;700;800&display=swap" rel="stylesheet">
  <style>body { font-family: 'Plus Jakarta Sans', sans-serif; }</style>
</head>
<body class="bg-slate-50 text-slate-800 flex h-screen overflow-hidden">
  <aside class="w-64 bg-white border-r border-slate-200 flex flex-col justify-between shrink-0 p-4">
    <div>
      <div class="p-3 mb-4 flex items-center gap-2">
        <div class="w-8 h-8 bg-blue-600 text-white rounded-lg flex items-center justify-center font-bold text-sm"><i class="fa-solid fa-graduation-cap"></i></div>
        <div><h2 class="font-extrabold text-xs text-slate-800 leading-none">Room Learning</h2><span class="text-[9px] font-bold text-blue-600">SMP</span></div>
      </div>
      <nav class="space-y-1">
        <a href="<?= site_url('guru/dashboard') ?>" class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-slate-600 hover:bg-slate-50 font-semibold text-xs"><i class="fa-solid fa-house w-4"></i><span>Beranda</span></a>
        <a href="<?= site_url('guru/kelas-siswa') ?>" class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-slate-600 hover:bg-slate-50 font-semibold text-xs"><i class="fa-solid fa-users-rectangle w-4"></i><span>Kelas & Siswa</span></a>
        <a href="<?= site_url('guru/jadwal') ?>" class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-slate-600 hover:bg-slate-50 font-semibold text-xs"><i class="fa-regular fa-calendar-days w-4"></i><span>Jadwal Belajar</span></a>
        <a href="<?= site_url('guru/materi') ?>" class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-slate-600 hover:bg-slate-50 font-semibold text-xs"><i class="fa-regular fa-book-open w-4"></i><span>Kelola Materi</span></a>
        <a href="<?= site_url('guru/tugas') ?>" class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-slate-600 hover:bg-slate-50 font-semibold text-xs"><i class="fa-regular fa-clipboard w-4"></i><span>Kelola Tugas</span></a>
        <a href="<?= site_url('guru/nilai') ?>" class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-slate-600 hover:bg-slate-50 font-semibold text-xs"><i class="fa-regular fa-award w-4"></i><span>Nilai</span></a>
        <a href="<?= site_url('guru/monitoring-ai') ?>" class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-slate-600 hover:bg-slate-50 font-semibold text-xs"><i class="fa-solid fa-chart-line w-4 text-indigo-500"></i><span>Monitoring AI Siswa</span></a>
        <a href="<?= site_url('guru/profil') ?>" class="flex items-center gap-3 px-3 py-2.5 rounded-xl bg-blue-50 text-blue-600 font-bold text-xs"><i class="fa-regular fa-user w-4"></i><span>Profil</span></a>
        <a href="<?= site_url('gemini') ?>" class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-slate-600 hover:bg-slate-50 font-semibold text-xs"><i class="fa-solid fa-robot w-4"></i><span>Gemini AI</span></a>
      </nav>
    </div>
    <a href="<?= site_url('logout') ?>" class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-red-500 hover:bg-red-50 font-bold text-xs"><i class="fa-solid fa-right-from-bracket w-4"></i><span>Keluar</span></a>
  </aside>

  <main class="flex-1 overflow-y-auto p-8">
    <div class="max-w-2xl mx-auto">
      <h1 class="text-2xl font-bold mb-6">Profil Guru</h1>

      <?php if (session()->getFlashdata('success')): ?>
        <div class="mb-4 bg-emerald-50 border border-emerald-200 text-emerald-700 rounded-2xl p-4 text-sm"><?= esc(session()->getFlashdata('success')) ?></div>
      <?php endif; ?>
      <?php if (session()->getFlashdata('error')): ?>
        <div class="mb-4 bg-red-50 border border-red-200 text-red-700 rounded-2xl p-4 text-sm"><?= esc(session()->getFlashdata('error')) ?></div>
      <?php endif; ?>

      <div class="bg-white rounded-3xl border border-slate-100 p-6 shadow-sm">
        <div class="flex items-center gap-4 mb-6">
          <div class="w-16 h-16 bg-blue-600 text-white rounded-2xl flex items-center justify-center text-2xl font-bold">
            <i class="fa-solid fa-user"></i>
          </div>
          <div>
            <h2 class="text-lg font-extrabold text-slate-800"><?= esc($user['nama'] ?? '-') ?></h2>
            <span class="text-xs bg-blue-50 text-blue-600 px-3 py-1 rounded-full font-semibold">Guru</span>
          </div>
        </div>

        <form action="<?= site_url('guru/profil/update') ?>" method="post" class="space-y-4">
          <?= csrf_field() ?>
          <div>
            <label class="block text-[11px] font-bold uppercase text-slate-500 mb-2">Nama Guru</label>
            <input type="text" name="nama" value="<?= esc($user['nama'] ?? '') ?>" required class="w-full rounded-2xl border border-slate-200 px-3 py-2 text-sm outline-none focus:border-blue-500">
          </div>
          <div>
            <label class="block text-[11px] font-bold uppercase text-slate-500 mb-2">Email</label>
            <input type="email" value="<?= esc($user['email'] ?? '') ?>" disabled class="w-full rounded-2xl border border-slate-200 px-3 py-2 text-sm bg-slate-50 text-slate-500">
          </div>
          <div>
            <label class="block text-[11px] font-bold uppercase text-slate-500 mb-2">Mata Pelajaran yang Diajarkan</label>
            <input type="text" name="mapel" value="<?= esc($user['mapel'] ?? '') ?>" placeholder="Contoh: IPA" class="w-full rounded-2xl border border-slate-200 px-3 py-2 text-sm outline-none focus:border-blue-500">
          </div>
          <div>
            <label class="block text-[11px] font-bold uppercase text-slate-500 mb-2">Kelas yang Diajar</label>
            <input type="text" name="kelas_diajar" value="<?= esc($user['kelas_diajar'] ?? '') ?>" placeholder="Contoh: VII A, VII B, VIII" class="w-full rounded-2xl border border-slate-200 px-3 py-2 text-sm outline-none focus:border-blue-500">
          </div>
          <button type="submit" class="w-full rounded-2xl bg-blue-600 px-4 py-2 text-sm font-bold text-white hover:bg-blue-700">Simpan Profil</button>
        </form>
      </div>
    </div>
  </main>
</body>
</html>
