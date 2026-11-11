<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Jadwal Pembelajaran - Guru</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;700;800&display=swap" rel="stylesheet">
  <style>body { font-family: 'Plus Jakarta Sans', sans-serif; }</style>
</head>
<body class="bg-slate-50 text-slate-800 flex h-screen overflow-hidden">
  <!-- Sidebar Guru -->
  <aside class="w-64 bg-white border-r border-slate-200 flex flex-col justify-between shrink-0 p-4">
    <div>
      <div class="p-3 mb-4 flex items-center gap-2">
        <div class="w-8 h-8 bg-blue-600 text-white rounded-lg flex items-center justify-center font-bold text-sm"><i class="fa-solid fa-graduation-cap"></i></div>
        <div><h2 class="font-extrabold text-xs text-slate-800 leading-none">Room Learning</h2><span class="text-[9px] font-bold text-blue-600">SMP</span></div>
      </div>
      <nav class="space-y-1">
        <a href="<?= site_url('guru/dashboard') ?>" class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-slate-600 hover:bg-slate-50 font-semibold text-xs"><i class="fa-solid fa-house w-4"></i><span>Beranda</span></a>
        <a href="<?= site_url('guru/kelas-siswa') ?>" class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-slate-600 hover:bg-slate-50 font-semibold text-xs"><i class="fa-solid fa-users-rectangle w-4"></i><span>Kelas & Siswa</span></a>
        <a href="<?= site_url('guru/jadwal') ?>" class="flex items-center gap-3 px-3 py-2.5 rounded-xl bg-blue-50 text-blue-600 font-bold text-xs"><i class="fa-regular fa-calendar-days w-4"></i><span>Jadwal Belajar</span></a>
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
    <div class="flex flex-col lg:flex-row lg:items-center justify-between gap-4 mb-6">
      <div>
        <h1 class="text-2xl font-bold text-slate-800">Jadwal & Waktu Pembelajaran</h1>
        <p class="text-xs text-slate-400 mt-1">Atur jadwal pertemuan kelas, jam mengajar, dan ruangan belajar siswa.</p>
      </div>

      <button onclick="document.getElementById('formJadwalModal').classList.remove('hidden')" class="bg-blue-600 hover:bg-blue-700 text-white font-bold px-4 py-2.5 rounded-xl text-xs shadow-sm transition inline-flex items-center gap-2">
        <i class="fa-solid fa-plus"></i>
        <span>Tambah Jadwal Mengajar</span>
      </button>
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

    <!-- Kartu Hari-Hari Jadwal Mengajar (Senin s/d Jumat) -->
    <?php
      $days = ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat'];
      $groupedJadwal = [];
      foreach ($days as $d) {
          $groupedJadwal[$d] = [];
      }
      foreach ($jadwal as $j) {
          $groupedJadwal[$j['hari']][] = $j;
      }
    ?>

    <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-6">
      <?php foreach ($days as $day): ?>
        <?php $list = $groupedJadwal[$day]; ?>
        <div class="bg-white rounded-3xl border border-slate-100 shadow-sm overflow-hidden flex flex-col">
          <div class="p-4 border-b border-slate-100 flex items-center justify-between bg-slate-50/70">
            <h3 class="font-extrabold text-sm text-slate-800 flex items-center gap-2">
              <i class="fa-regular fa-calendar text-blue-600"></i>
              <span><?= esc($day) ?></span>
            </h3>
            <span class="text-[10px] font-bold px-2 py-0.5 rounded-full <?= count($list) > 0 ? 'bg-blue-100 text-blue-700' : 'bg-slate-200 text-slate-500' ?>">
              <?= count($list) ?> Sesi
            </span>
          </div>

          <div class="p-4 flex-1 space-y-3">
            <?php if (empty($list)): ?>
              <div class="py-6 text-center text-slate-400 text-xs">
                <i class="fa-regular fa-calendar-xmark text-2xl mb-1.5 text-slate-300 block"></i>
                Tidak ada jadwal mengajar
              </div>
            <?php else: ?>
              <?php foreach ($list as $item): ?>
                <?php
                  $badgeColor = match($item['kelas']) {
                    'VII'   => 'bg-emerald-50 text-emerald-700 border-emerald-200',
                    'VIII'  => 'bg-blue-50 text-blue-700 border-blue-200',
                    'IX'    => 'bg-purple-50 text-purple-700 border-purple-200',
                    default => 'bg-slate-100 text-slate-700 border-slate-200',
                  };
                ?>
                <div class="p-3 rounded-2xl border border-slate-100 bg-slate-50/50 hover:bg-blue-50/30 transition group">
                  <div class="flex items-start justify-between gap-2">
                    <div>
                      <span class="inline-flex items-center gap-1 px-2 py-0.5 rounded-md text-[9px] font-extrabold border <?= $badgeColor ?>">
                        Kelas <?= esc($item['kelas']) ?>
                      </span>
                      <h4 class="font-bold text-xs text-slate-800 mt-1"><?= esc($item['mapel']) ?></h4>
                    </div>
                    <a href="<?= site_url('guru/jadwal/delete/' . $item['id']) ?>" class="text-slate-300 hover:text-red-500 transition p-1" onclick="return confirm('Hapus sesi jadwal ini?')" title="Hapus jadwal">
                      <i class="fa-regular fa-trash-can text-xs"></i>
                    </a>
                  </div>

                  <div class="mt-2.5 pt-2 border-t border-slate-100 flex items-center justify-between text-[11px] text-slate-500">
                    <span class="font-semibold text-blue-600 flex items-center gap-1">
                      <i class="fa-regular fa-clock"></i>
                      <?= substr($item['jam_mulai'], 0, 5) ?> - <?= substr($item['jam_selesai'], 0, 5) ?> WIB
                    </span>
                    <span class="text-slate-400 flex items-center gap-1">
                      <i class="fa-solid fa-location-dot text-[10px]"></i> <?= esc($item['ruangan'] ?: 'Ruang Kelas') ?>
                    </span>
                  </div>

                  <?php if (!empty($item['keterangan'])): ?>
                    <div class="mt-1.5 text-[10px] text-slate-400 italic">
                      *<?= esc($item['keterangan']) ?>
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

  <!-- Modal Tambah Jadwal -->
  <div id="formJadwalModal" class="fixed inset-0 bg-slate-900/60 backdrop-blur-sm z-50 hidden flex items-center justify-center p-4">
    <div class="bg-white w-full max-w-lg rounded-3xl shadow-2xl overflow-hidden animate-in fade-in zoom-in-95 duration-150">
      <div class="px-6 py-4 border-b border-slate-100 flex items-center justify-between bg-slate-50">
        <h3 class="font-bold text-sm text-slate-800 flex items-center gap-2">
          <i class="fa-regular fa-calendar-plus text-blue-600"></i>
          <span>Tambah Jadwal Mengajar</span>
        </h3>
        <button type="button" onclick="document.getElementById('formJadwalModal').classList.add('hidden')" class="w-8 h-8 rounded-xl bg-slate-100 hover:bg-slate-200 text-slate-500 flex items-center justify-center font-bold text-sm transition">
          <i class="fa-solid fa-xmark"></i>
        </button>
      </div>

      <form action="<?= site_url('guru/jadwal/save') ?>" method="post" class="p-6 space-y-4">
        <?= csrf_field() ?>
        <div>
          <label class="block text-[11px] font-bold uppercase text-slate-500 mb-1.5">Mata Pelajaran</label>
          <input type="text" name="mapel" required value="<?= esc($guru['mapel'] ?? '') ?>" placeholder="Contoh: IPA Terpadu" class="w-full rounded-xl border border-slate-200 px-3 py-2 text-xs focus:outline-none focus:border-blue-500">
        </div>

        <div class="grid grid-cols-2 gap-3">
          <div>
            <label class="block text-[11px] font-bold uppercase text-slate-500 mb-1.5">Tingkat Kelas</label>
            <select name="kelas" required class="w-full rounded-xl border border-slate-200 px-3 py-2 text-xs bg-white focus:outline-none focus:border-blue-500">
              <option value="VII">Kelas 7 (VII)</option>
              <option value="VIII">Kelas 8 (VIII)</option>
              <option value="IX">Kelas 9 (IX)</option>
            </select>
          </div>
          <div>
            <label class="block text-[11px] font-bold uppercase text-slate-500 mb-1.5">Hari</label>
            <select name="hari" required class="w-full rounded-xl border border-slate-200 px-3 py-2 text-xs bg-white focus:outline-none focus:border-blue-500">
              <option value="Senin">Senin</option>
              <option value="Selasa">Selasa</option>
              <option value="Rabu">Rabu</option>
              <option value="Kamis">Kamis</option>
              <option value="Jumat">Jumat</option>
            </select>
          </div>
        </div>

        <div class="grid grid-cols-2 gap-3">
          <div>
            <label class="block text-[11px] font-bold uppercase text-slate-500 mb-1.5">Jam Mulai</label>
            <input type="time" name="jam_mulai" required class="w-full rounded-xl border border-slate-200 px-3 py-2 text-xs focus:outline-none focus:border-blue-500">
          </div>
          <div>
            <label class="block text-[11px] font-bold uppercase text-slate-500 mb-1.5">Jam Selesai</label>
            <input type="time" name="jam_selesai" required class="w-full rounded-xl border border-slate-200 px-3 py-2 text-xs focus:outline-none focus:border-blue-500">
          </div>
        </div>

        <div class="grid grid-cols-2 gap-3">
          <div>
            <label class="block text-[11px] font-bold uppercase text-slate-500 mb-1.5">Ruangan / Lab</label>
            <input type="text" name="ruangan" placeholder="Contoh: Lab IPA / R. 8A" class="w-full rounded-xl border border-slate-200 px-3 py-2 text-xs focus:outline-none focus:border-blue-500">
          </div>
          <div>
            <label class="block text-[11px] font-bold uppercase text-slate-500 mb-1.5">Catatan (opsional)</label>
            <input type="text" name="keterangan" placeholder="Contoh: Bawa buku praktikum" class="w-full rounded-xl border border-slate-200 px-3 py-2 text-xs focus:outline-none focus:border-blue-500">
          </div>
        </div>

        <div class="pt-2 flex items-center justify-end gap-2">
          <button type="button" onclick="document.getElementById('formJadwalModal').classList.add('hidden')" class="px-4 py-2 rounded-xl border border-slate-200 text-xs font-bold text-slate-600 hover:bg-slate-50">
            Batal
          </button>
          <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold px-5 py-2 rounded-xl text-xs shadow-md transition">
            Simpan Jadwal
          </button>
        </div>
      </form>
    </div>
  </div>
</body>
</html>
