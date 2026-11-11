<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Kelola Materi - Guru</title>
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
        <a href="<?= site_url('guru/materi') ?>" class="flex items-center gap-3 px-3 py-2.5 rounded-xl bg-blue-50 text-blue-600 font-bold text-xs"><i class="fa-regular fa-book-open w-4"></i><span>Materi</span></a>
        <a href="<?= site_url('guru/tugas') ?>" class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-slate-600 hover:bg-slate-50 font-semibold text-xs"><i class="fa-regular fa-clipboard w-4"></i><span>Tugas</span></a>
        <a href="<?= site_url('guru/nilai') ?>" class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-slate-600 hover:bg-slate-50 font-semibold text-xs"><i class="fa-regular fa-award w-4"></i><span>Nilai</span></a>
        <a href="<?= site_url('guru/monitoring-ai') ?>" class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-slate-600 hover:bg-slate-50 font-semibold text-xs"><i class="fa-solid fa-chart-line w-4 text-indigo-500"></i><span>Monitoring AI Siswa</span></a>
        <a href="<?= site_url('guru/profil') ?>" class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-slate-600 hover:bg-slate-50 font-semibold text-xs"><i class="fa-regular fa-user w-4"></i><span>Profil</span></a>
        <a href="<?= site_url('gemini') ?>" class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-slate-600 hover:bg-slate-50 font-semibold text-xs"><i class="fa-solid fa-robot w-4"></i><span>Gemini AI</span></a>
      </nav>
    </div>
    <a href="<?= site_url('logout') ?>" class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-red-500 hover:bg-red-50 font-bold text-xs"><i class="fa-solid fa-right-from-bracket w-4"></i><span>Keluar</span></a>
  </aside>

  <main class="flex-1 overflow-y-auto p-8">
    <div class="flex flex-col lg:flex-row lg:items-center justify-between gap-4 mb-6">
      <div>
        <h1 class="text-xl font-bold text-slate-800">Kelola Materi Pelajaran</h1>
        <p class="text-xs text-slate-400 mt-0.5">Unggah berkas bahan ajar dan kelompokkan sesuai tingkatan kelas (7, 8, 9, atau Semua).</p>
      </div>

      <form action="<?= site_url('guru/materi/save') ?>" method="post" enctype="multipart/form-data" class="flex flex-wrap gap-2 items-center bg-white p-3 rounded-2xl border border-slate-200 shadow-sm">
        <?= csrf_field() ?>
        <input type="text" name="judul" placeholder="Judul materi" required class="rounded-xl border border-slate-200 px-3 py-2 text-xs focus:outline-none focus:border-blue-500">
        <input type="text" name="deskripsi" placeholder="Deskripsi singkat" required class="rounded-xl border border-slate-200 px-3 py-2 text-xs focus:outline-none focus:border-blue-500">
        <select name="kelas" required class="rounded-xl border border-slate-200 px-3 py-2 text-xs bg-white text-slate-700 font-semibold focus:outline-none focus:border-blue-500" title="Target Tingkatan Kelas">
          <option value="Semua">Semua Kelas</option>
          <option value="VII">Kelas 7 (VII)</option>
          <option value="VIII">Kelas 8 (VIII)</option>
          <option value="IX">Kelas 9 (IX)</option>
        </select>
        <input type="file" name="file" required class="text-xs text-slate-500 file:mr-2 file:py-1.5 file:px-3 file:rounded-xl file:border-0 file:text-xs file:font-semibold file:bg-slate-100 file:text-slate-700 hover:file:bg-slate-200">
        <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold px-4 py-2 rounded-xl text-xs shadow-sm transition">+ Upload Materi</button>
      </form>
    </div>

    <?php if (session()->getFlashdata('success')): ?>
      <div class="mb-4 bg-emerald-50 border border-emerald-200 text-emerald-700 rounded-2xl p-4 text-xs font-semibold flex items-center gap-2">
        <i class="fa-solid fa-circle-check text-emerald-500 text-base"></i>
        <span><?= esc(session()->getFlashdata('success')) ?></span>
      </div>
    <?php endif; ?>
    <?php if (session()->getFlashdata('error')): ?>
      <div class="mb-4 bg-red-50 border border-red-200 text-red-700 rounded-2xl p-4 text-xs font-semibold flex items-center gap-2">
        <i class="fa-solid fa-circle-exclamation text-red-500 text-base"></i>
        <span><?= esc(session()->getFlashdata('error')) ?></span>
      </div>
    <?php endif; ?>

    <div class="bg-white rounded-2xl border border-slate-100 shadow-sm overflow-hidden">
      <table class="w-full text-left text-xs">
        <thead class="bg-slate-50 text-slate-400 font-bold border-b border-slate-100 uppercase tracking-wider text-[10px]">
          <tr>
            <th class="p-4">Judul Materi</th>
            <th class="p-4">Deskripsi</th>
            <th class="p-4">Target Kelas</th>
            <th class="p-4">Berkas</th>
            <th class="p-4 text-center">Aksi</th>
          </tr>
        </thead>
        <tbody class="divide-y divide-slate-100">
          <?php if (empty($materi)): ?>
            <tr><td colspan="5" class="p-8 text-center text-slate-400 font-medium">Belum ada materi yang diunggah.</td></tr>
          <?php else: ?>
            <?php foreach ($materi as $item): ?>
              <?php
                $targetKelas = !empty($item['kelas']) ? $item['kelas'] : 'Semua';
                $badgeColor = match($targetKelas) {
                  'VII'   => 'bg-emerald-50 text-emerald-700 border-emerald-200',
                  'VIII'  => 'bg-blue-50 text-blue-700 border-blue-200',
                  'IX'    => 'bg-purple-50 text-purple-700 border-purple-200',
                  default => 'bg-slate-100 text-slate-600 border-slate-200',
                };
              ?>
              <tr class="hover:bg-slate-50/70 transition">
                <td class="p-4 font-bold text-slate-800"><?= esc($item['judul']) ?></td>
                <td class="p-4 text-slate-600 max-w-sm"><?= esc($item['deskripsi']) ?></td>
                <td class="p-4">
                  <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-full text-[11px] font-extrabold border <?= $badgeColor ?>">
                    <i class="fa-solid fa-graduation-cap text-[10px]"></i>
                    <?= $targetKelas === 'Semua' ? 'Semua Kelas' : 'Kelas ' . esc($targetKelas) ?>
                  </span>
                </td>
                <td class="p-4"><a href="<?= base_url('uploads/' . $item['file']) ?>" class="text-blue-600 hover:text-blue-700 font-semibold underline inline-flex items-center gap-1" target="_blank"><i class="fa-regular fa-file"></i> Lihat</a></td>
                <td class="p-4 text-center"><a href="<?= site_url('guru/materi/delete/' . $item['id']) ?>" class="text-red-500 hover:text-red-700 font-bold bg-red-50 hover:bg-red-100 px-3 py-1.5 rounded-xl transition" onclick="return confirm('Hapus materi ini?')">Hapus</a></td>
              </tr>
            <?php endforeach; ?>
          <?php endif; ?>
        </tbody>
      </table>
    </div>
  </main>
</body>
</html>

