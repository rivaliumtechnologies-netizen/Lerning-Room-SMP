<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Kelola Jadwal Pelajaran - Room Learning SMP</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
  <style>
    body { font-family: 'Plus Jakarta Sans', sans-serif; }
    .custom-scroll::-webkit-scrollbar { width: 5px; height: 5px; }
    .custom-scroll::-webkit-scrollbar-track { background: transparent; }
    .custom-scroll::-webkit-scrollbar-thumb { background: #cbd5e1; border-radius: 9999px; }
    .custom-scroll::-webkit-scrollbar-thumb:hover { background: #94a3b8; }
  </style>
</head>
<body class="bg-slate-50 text-slate-800 flex h-screen overflow-hidden">

  <!-- Sidebar Navigasi Admin -->
  <aside class="w-64 bg-white border-r border-slate-200 flex flex-col justify-between shrink-0 p-4 z-20">
    <div>
      <!-- App Brand Logo -->
      <div class="p-3 mb-4 flex items-center gap-2.5">
        <div class="w-9 h-9 bg-gradient-to-tr from-blue-700 to-indigo-600 text-white rounded-xl flex items-center justify-center font-bold text-sm shadow-md shadow-blue-200">
          <i class="fa-solid fa-graduation-cap"></i>
        </div>
        <div>
          <h2 class="font-extrabold text-xs text-slate-900 leading-none">Room Learning</h2>
          <span class="text-[9px] font-bold text-blue-600 uppercase tracking-wider">SMP • Administrator</span>
        </div>
      </div>

      <!-- Main Navigation Menu -->
      <nav class="space-y-1">
        <a href="<?= site_url('admin/dashboard') ?>" class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl text-slate-600 hover:bg-slate-50 hover:text-slate-900 font-semibold text-xs transition">
          <i class="fa-solid fa-house w-4"></i>
          <span>Dashboard</span>
        </a>
        <a href="<?= site_url('admin/guru') ?>" class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl text-slate-600 hover:bg-slate-50 hover:text-slate-900 font-semibold text-xs transition">
          <i class="fa-solid fa-chalkboard-user w-4"></i>
          <span>Data Guru</span>
        </a>
        <a href="<?= site_url('admin/siswa') ?>" class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl text-slate-600 hover:bg-slate-50 hover:text-slate-900 font-semibold text-xs transition">
          <i class="fa-solid fa-user-graduate w-4"></i>
          <span>Data Siswa & Kelas</span>
        </a>
        <a href="<?= site_url('admin/jadwal') ?>" class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl bg-blue-50 text-blue-600 font-bold text-xs shadow-sm transition">
          <i class="fa-regular fa-calendar-days w-4"></i>
          <span>Jadwal Pelajaran</span>
        </a>
      </nav>

      <!-- Quick Export Box -->
      <div class="mt-6 pt-5 border-t border-slate-100">
        <p class="px-3 text-[10px] font-bold uppercase tracking-wider text-slate-400 mb-2">Laporan & Ekspor</p>
        <div class="space-y-1">
          <a href="<?= site_url('admin/export/guru') ?>" class="flex items-center gap-2.5 px-3 py-2 rounded-xl text-slate-600 hover:bg-indigo-50 hover:text-indigo-700 text-xs font-semibold transition">
            <i class="fa-solid fa-file-excel text-indigo-600 w-3.5"></i>
            <span>Ekspor Data Guru</span>
          </a>
          <a href="<?= site_url('admin/export/siswa') ?>" class="flex items-center gap-2.5 px-3 py-2 rounded-xl text-slate-600 hover:bg-emerald-50 hover:text-emerald-700 text-xs font-semibold transition">
            <i class="fa-solid fa-file-excel text-emerald-600 w-3.5"></i>
            <span>Ekspor Data Siswa</span>
          </a>
          <a href="<?= site_url('admin/export/tugas') ?>" class="flex items-center gap-2.5 px-3 py-2 rounded-xl text-slate-600 hover:bg-amber-50 hover:text-amber-700 text-xs font-semibold transition">
            <i class="fa-solid fa-file-csv text-amber-600 w-3.5"></i>
            <span>Ekspor Data Tugas</span>
          </a>
        </div>
      </div>
    </div>

    <!-- Admin Profile & Logout -->
    <div class="pt-4 border-t border-slate-100">
      <div class="flex items-center gap-2.5 px-2 py-2 mb-2">
        <div class="w-8 h-8 rounded-full bg-slate-100 border border-slate-200 flex items-center justify-center font-black text-xs text-slate-700">
          <i class="fa-solid fa-user-shield"></i>
        </div>
        <div class="truncate">
          <div class="text-xs font-bold text-slate-800 leading-tight truncate"><?= esc(session()->get('user_name') ?? 'Admin') ?></div>
          <div class="text-[10px] text-slate-400">Super Administrator</div>
        </div>
      </div>
      <a href="<?= site_url('logout') ?>" class="flex items-center gap-2.5 px-3.5 py-2.5 rounded-xl text-red-500 hover:bg-red-50 font-bold text-xs transition">
        <i class="fa-solid fa-right-from-bracket w-4"></i>
        <span>Keluar Sistem</span>
      </a>
    </div>
  </aside>

  <!-- Main Content Area -->
  <main class="flex-1 overflow-y-auto p-6 md:p-8 custom-scroll">
    <!-- Header Bar -->
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 mb-6">
      <div>
        <h1 class="text-2xl font-extrabold text-slate-900 tracking-tight">Jadwal Pelajaran Sekolah</h1>
        <p class="text-xs text-slate-400 mt-1">Pengaturan waktu tatap muka belajar mengajar 5 hari sekolah (Senin - Jumat).</p>
      </div>
      <div class="flex items-center gap-2">
        <button onclick="document.getElementById('modalTambahJadwal').classList.remove('hidden')" class="inline-flex items-center gap-2 px-4 py-2.5 rounded-xl bg-blue-600 hover:bg-blue-700 text-white text-xs font-extrabold shadow-sm transition">
          <i class="fa-solid fa-plus"></i>
          <span>Tambah Jadwal Baru</span>
        </button>
      </div>
    </div>

    <!-- Flash Messages -->
    <?php if (session()->getFlashdata('success')): ?>
      <div class="mb-5 bg-emerald-50 border border-emerald-200 text-emerald-700 rounded-2xl p-4 text-xs font-bold flex items-center gap-2.5 shadow-sm">
        <i class="fa-solid fa-circle-check text-emerald-500 text-base"></i>
        <span><?= esc(session()->getFlashdata('success')) ?></span>
      </div>
    <?php endif; ?>

    <?php if (session()->getFlashdata('error')): ?>
      <div class="mb-5 bg-red-50 border border-red-200 text-red-700 rounded-2xl p-4 text-xs font-bold flex items-center gap-2.5 shadow-sm">
        <i class="fa-solid fa-circle-exclamation text-red-500 text-base"></i>
        <span><?= esc(session()->getFlashdata('error')) ?></span>
      </div>
    <?php endif; ?>

    <!-- Stat Cards Overview -->
    <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 mb-6">
      <div class="bg-white p-4 rounded-2xl border border-slate-100 shadow-sm flex items-center gap-3">
        <div class="w-10 h-10 rounded-xl bg-blue-50 text-blue-600 flex items-center justify-center text-sm font-bold shrink-0">
          <i class="fa-regular fa-calendar-check"></i>
        </div>
        <div>
          <span class="text-[10px] font-bold uppercase tracking-wider text-slate-400 block">Total Sesi Pelajaran</span>
          <h3 class="text-xl font-extrabold text-slate-800"><?= count($jadwal) ?> Sesi Aktif</h3>
        </div>
      </div>

      <div class="bg-white p-4 rounded-2xl border border-slate-100 shadow-sm flex items-center gap-3">
        <div class="w-10 h-10 rounded-xl bg-indigo-50 text-indigo-600 flex items-center justify-center text-sm font-bold shrink-0">
          <i class="fa-solid fa-chalkboard-user"></i>
        </div>
        <div>
          <span class="text-[10px] font-bold uppercase tracking-wider text-slate-400 block">Guru Terjadwal</span>
          <h3 class="text-xl font-extrabold text-slate-800"><?= count($guru) ?> Guru Pengampu</h3>
        </div>
      </div>

      <div class="bg-white p-4 rounded-2xl border border-slate-100 shadow-sm flex items-center gap-3">
        <div class="w-10 h-10 rounded-xl bg-emerald-50 text-emerald-600 flex items-center justify-center text-sm font-bold shrink-0">
          <i class="fa-regular fa-clock"></i>
        </div>
        <div>
          <span class="text-[10px] font-bold uppercase tracking-wider text-slate-400 block">Hari Sekolah</span>
          <h3 class="text-xl font-extrabold text-slate-800">Senin - Jumat</h3>
        </div>
      </div>
    </div>

    <!-- Master Table Jadwal -->
    <div class="bg-white rounded-3xl border border-slate-100 shadow-sm p-6 mb-8">
      <!-- Search and Day Filter Buttons -->
      <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-6 pb-4 border-b border-slate-100">
        <div class="flex flex-wrap items-center gap-1.5">
          <button onclick="filterDay('all')" class="day-tab-btn active-day px-3 py-1.5 rounded-xl text-xs font-extrabold bg-blue-50 text-blue-600 transition" data-day="all">Semua</button>
          <button onclick="filterDay('Senin')" class="day-tab-btn px-3 py-1.5 rounded-xl text-xs font-semibold text-slate-500 hover:bg-slate-50 transition" data-day="Senin">Senin</button>
          <button onclick="filterDay('Selasa')" class="day-tab-btn px-3 py-1.5 rounded-xl text-xs font-semibold text-slate-500 hover:bg-slate-50 transition" data-day="Selasa">Selasa</button>
          <button onclick="filterDay('Rabu')" class="day-tab-btn px-3 py-1.5 rounded-xl text-xs font-semibold text-slate-500 hover:bg-slate-50 transition" data-day="Rabu">Rabu</button>
          <button onclick="filterDay('Kamis')" class="day-tab-btn px-3 py-1.5 rounded-xl text-xs font-semibold text-slate-500 hover:bg-slate-50 transition" data-day="Kamis">Kamis</button>
          <button onclick="filterDay('Jumat')" class="day-tab-btn px-3 py-1.5 rounded-xl text-xs font-semibold text-slate-500 hover:bg-slate-50 transition" data-day="Jumat">Jumat</button>
        </div>

        <div class="relative w-full sm:w-64">
          <i class="fa-solid fa-magnifying-glass absolute left-3.5 top-3 text-slate-400 text-xs"></i>
          <input type="text" id="searchJadwalBox" onkeyup="filterJadwalTable()" placeholder="Cari mapel, guru, kelas..." class="w-full pl-9 pr-4 py-2 bg-slate-50 border border-slate-200 rounded-xl text-xs text-slate-800 focus:bg-white focus:outline-none focus:ring-2 focus:ring-blue-500">
        </div>
      </div>

      <!-- Schedule Table -->
      <div class="overflow-x-auto">
        <table class="w-full text-left text-xs">
          <thead>
            <tr class="bg-slate-50 text-slate-400 uppercase text-[10px] font-extrabold tracking-wider border-b border-slate-100">
              <th class="p-3.5 pl-4">Hari & Jam Belajar</th>
              <th class="p-3.5">Mata Pelajaran</th>
              <th class="p-3.5">Rombel Kelas</th>
              <th class="p-3.5">Guru Pengampu</th>
              <th class="p-3.5">Ruangan</th>
              <th class="p-3.5">Catatan</th>
              <th class="p-3.5 text-right pr-4">Aksi</th>
            </tr>
          </thead>
          <tbody id="jadwalTableBody" class="divide-y divide-slate-100">
            <?php if (!empty($jadwal)): ?>
              <?php foreach ($jadwal as $row): ?>
                <tr class="hover:bg-slate-50/70 transition jadwal-row" data-day="<?= esc($row['hari']) ?>">
                  <td class="p-3.5 pl-4">
                    <div class="flex items-center gap-2.5">
                      <div class="w-9 h-9 rounded-xl bg-blue-50 text-blue-700 flex flex-col items-center justify-center font-bold shrink-0">
                        <span class="text-[8px] uppercase font-black leading-none"><?= substr($row['hari'], 0, 3) ?></span>
                        <span class="text-[11px] font-black"><?= date('H:i', strtotime($row['jam_mulai'])) ?></span>
                      </div>
                      <div>
                        <span class="font-extrabold text-slate-800 text-xs block"><?= esc($row['hari']) ?></span>
                        <span class="text-[11px] text-slate-400 font-medium">
                          <?= date('H:i', strtotime($row['jam_mulai'])) ?> - <?= date('H:i', strtotime($row['jam_selesai'])) ?> WIB
                        </span>
                      </div>
                    </div>
                  </td>
                  <td class="p-3.5 font-bold text-slate-800 text-xs">
                    <?= esc($row['mapel']) ?>
                  </td>
                  <td class="p-3.5">
                    <span class="px-2.5 py-0.5 rounded-lg text-[10px] font-extrabold bg-blue-50 text-blue-700 border border-blue-100">
                      <?= esc($row['kelas']) ?>
                    </span>
                  </td>
                  <td class="p-3.5">
                    <div class="flex items-center gap-2">
                      <div class="w-7 h-7 rounded-full bg-slate-100 text-slate-600 flex items-center justify-center text-[10px] font-bold shrink-0">
                        <i class="fa-solid fa-user-tie"></i>
                      </div>
                      <span class="font-semibold text-slate-700 text-xs"><?= esc($row['nama_guru'] ?? 'Guru #'.$row['guru_id']) ?></span>
                    </div>
                  </td>
                  <td class="p-3.5 text-slate-600 font-medium">
                    <?php if (!empty($row['ruangan'])): ?>
                      <span class="inline-flex items-center gap-1 text-[11px] text-slate-600">
                        <i class="fa-solid fa-location-dot text-[10px] text-slate-400"></i>
                        <?= esc($row['ruangan']) ?>
                      </span>
                    <?php else: ?>
                      <span class="text-slate-400">-</span>
                    <?php endif; ?>
                  </td>
                  <td class="p-3.5 text-slate-400 italic text-[11px]">
                    <?= !empty($row['keterangan']) ? esc($row['keterangan']) : '-' ?>
                  </td>
                  <td class="p-3.5 text-right pr-4">
                    <a href="<?= site_url('admin/jadwal/delete/' . $row['id']) ?>" onclick="return confirm('Apakah Anda yakin ingin menghapus jadwal <?= esc($row['mapel']) ?> (<?= esc($row['hari']) ?>)?')" class="inline-flex items-center gap-1 text-red-500 hover:text-red-700 font-bold text-[11px] bg-red-50 hover:bg-red-100 px-2.5 py-1.5 rounded-lg transition" title="Hapus Jadwal">
                      <i class="fa-regular fa-trash-can text-[10px]"></i>
                      <span>Hapus</span>
                    </a>
                  </td>
                </tr>
              <?php endforeach; ?>
            <?php else: ?>
              <tr>
                <td colspan="7" class="text-center py-8 text-slate-400 text-xs italic">
                  Belum ada jadwal pelajaran terdaftar. Klik tombol Tambah Jadwal Baru di atas.
                </td>
              </tr>
            <?php endif; ?>
          </tbody>
        </table>
      </div>
    </div>
  </main>

  <!-- Modal Tambah Jadwal Baru -->
  <div id="modalTambahJadwal" class="fixed inset-0 bg-slate-900/60 backdrop-blur-sm z-50 flex items-center justify-center p-4 hidden">
    <div class="bg-white rounded-3xl max-w-xl w-full p-6 shadow-2xl border border-slate-100 relative max-h-[90vh] overflow-y-auto custom-scroll">
      <div class="flex items-center justify-between mb-4 pb-3 border-b border-slate-100">
        <div class="flex items-center gap-2.5">
          <div class="w-8 h-8 rounded-xl bg-blue-50 text-blue-600 flex items-center justify-center text-sm font-bold">
            <i class="fa-solid fa-calendar-plus"></i>
          </div>
          <div>
            <h3 class="font-extrabold text-sm text-slate-800">Tambah Jadwal Pelajaran Baru</h3>
            <p class="text-[11px] text-slate-400">Atur sesi pelajaran sekolah (Senin sampai Jumat).</p>
          </div>
        </div>
        <button type="button" onclick="document.getElementById('modalTambahJadwal').classList.add('hidden')" class="text-slate-400 hover:text-slate-600 text-sm">
          <i class="fa-solid fa-xmark"></i>
        </button>
      </div>

      <form action="<?= site_url('admin/jadwal/save') ?>" method="post" class="space-y-4">
        <?= csrf_field() ?>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
          <!-- Guru Pengampu -->
          <div>
            <label class="block text-[11px] font-bold uppercase text-slate-500 mb-1.5">Guru Pengampu *</label>
            <select name="guru_id" id="selectGuruAdmin" onchange="autoFillMapelAdmin()" required class="w-full rounded-xl border border-slate-200 px-3 py-2 text-xs bg-slate-50 focus:bg-white focus:outline-none focus:ring-2 focus:ring-blue-500 font-semibold text-slate-700">
              <option value="">-- Pilih Guru --</option>
              <?php foreach ($guru as $g): ?>
                <option value="<?= esc($g['id']) ?>" data-mapel="<?= esc($g['mapel'] ?? '') ?>">
                  <?= esc($g['nama']) ?> <?= !empty($g['mapel']) ? '('.esc($g['mapel']).')' : '' ?>
                </option>
              <?php endforeach; ?>
            </select>
          </div>

          <!-- Mata Pelajaran -->
          <div>
            <label class="block text-[11px] font-bold uppercase text-slate-500 mb-1.5">Mata Pelajaran *</label>
            <input type="text" name="mapel" id="inputMapelAdmin" required placeholder="Contoh: IPA, Matematika" class="w-full rounded-xl border border-slate-200 px-3 py-2 text-xs bg-slate-50 focus:bg-white focus:outline-none focus:ring-2 focus:ring-blue-500">
          </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
          <!-- Target Rombel / Kelas -->
          <div>
            <label class="block text-[11px] font-bold uppercase text-slate-500 mb-1.5">Target Rombel / Kelas *</label>
            <select name="kelas" required class="w-full rounded-xl border border-slate-200 px-3 py-2 text-xs bg-slate-50 focus:bg-white focus:outline-none focus:ring-2 focus:ring-blue-500 font-semibold text-slate-700">
              <option value="">-- Pilih Kelas --</option>
              <optgroup label="Tingkatan Umum">
                <option value="VII">Semua Kelas 7 (VII)</option>
                <option value="VIII">Semua Kelas 8 (VIII)</option>
                <option value="IX">Semua Kelas 9 (IX)</option>
                <option value="Semua">Semua Jenjang</option>
              </optgroup>
              <optgroup label="Kelas 7 (VII-A s/d VII-G)">
                <option value="VII-A">VII-A</option>
                <option value="VII-B">VII-B</option>
                <option value="VII-C">VII-C</option>
                <option value="VII-D">VII-D</option>
                <option value="VII-E">VII-E</option>
                <option value="VII-F">VII-F</option>
                <option value="VII-G">VII-G</option>
              </optgroup>
              <optgroup label="Kelas 8 (VIII-A s/d VIII-G)">
                <option value="VIII-A">VIII-A</option>
                <option value="VIII-B">VIII-B</option>
                <option value="VIII-C">VIII-C</option>
                <option value="VIII-D">VIII-D</option>
                <option value="VIII-E">VIII-E</option>
                <option value="VIII-F">VIII-F</option>
                <option value="VIII-G">VIII-G</option>
              </optgroup>
              <optgroup label="Kelas 9 (IX-A s/d IX-G)">
                <option value="IX-A">IX-A</option>
                <option value="IX-B">IX-B</option>
                <option value="IX-C">IX-C</option>
                <option value="IX-D">IX-D</option>
                <option value="IX-E">IX-E</option>
                <option value="IX-F">IX-F</option>
                <option value="IX-G">IX-G</option>
              </optgroup>
            </select>
          </div>

          <!-- Hari Pembelajaran -->
          <div>
            <label class="block text-[11px] font-bold uppercase text-slate-500 mb-1.5">Hari Pembelajaran *</label>
            <select name="hari" required class="w-full rounded-xl border border-slate-200 px-3 py-2 text-xs bg-slate-50 focus:bg-white focus:outline-none focus:ring-2 focus:ring-blue-500 font-bold text-slate-700">
              <option value="Senin">Senin</option>
              <option value="Selasa">Selasa</option>
              <option value="Rabu">Rabu</option>
              <option value="Kamis">Kamis</option>
              <option value="Jumat">Jumat</option>
            </select>
          </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-3">
          <!-- Jam Mulai -->
          <div>
            <label class="block text-[11px] font-bold uppercase text-slate-500 mb-1.5">Jam Mulai *</label>
            <input type="time" name="jam_mulai" required value="07:30" class="w-full rounded-xl border border-slate-200 px-3 py-2 text-xs bg-slate-50 focus:bg-white focus:outline-none focus:ring-2 focus:ring-blue-500 font-mono">
          </div>

          <!-- Jam Selesai -->
          <div>
            <label class="block text-[11px] font-bold uppercase text-slate-500 mb-1.5">Jam Selesai *</label>
            <input type="time" name="jam_selesai" required value="09:00" class="w-full rounded-xl border border-slate-200 px-3 py-2 text-xs bg-slate-50 focus:bg-white focus:outline-none focus:ring-2 focus:ring-blue-500 font-mono">
          </div>

          <!-- Ruangan -->
          <div>
            <label class="block text-[11px] font-bold uppercase text-slate-500 mb-1.5">Ruangan / Lab</label>
            <input type="text" name="ruangan" placeholder="Contoh: Lab IPA 1" class="w-full rounded-xl border border-slate-200 px-3 py-2 text-xs bg-slate-50 focus:bg-white focus:outline-none focus:ring-2 focus:ring-blue-500">
          </div>
        </div>

        <div>
          <label class="block text-[11px] font-bold uppercase text-slate-500 mb-1.5">Catatan / Keterangan (Opsional)</label>
          <input type="text" name="keterangan" placeholder="Contoh: Sesi tatap muka praktikum" class="w-full rounded-xl border border-slate-200 px-3 py-2 text-xs bg-slate-50 focus:bg-white focus:outline-none focus:ring-2 focus:ring-blue-500">
        </div>

        <div class="pt-2 flex items-center justify-end gap-2 border-t border-slate-100">
          <button type="button" onclick="document.getElementById('modalTambahJadwal').classList.add('hidden')" class="px-4 py-2 rounded-xl border border-slate-200 text-xs font-bold text-slate-600 hover:bg-slate-50 transition">
            Batal
          </button>
          <button type="submit" class="px-4 py-2 rounded-xl bg-blue-600 hover:bg-blue-700 text-xs font-bold text-white shadow-sm transition">
            Simpan Jadwal Pelajaran
          </button>
        </div>
      </form>
    </div>
  </div>

  <!-- Interactive Script -->
  <script>
    function autoFillMapelAdmin() {
      const select = document.getElementById('selectGuruAdmin');
      const selectedOption = select.options[select.selectedIndex];
      const mapel = selectedOption.getAttribute('data-mapel');
      if (mapel && !document.getElementById('inputMapelAdmin').value) {
        document.getElementById('inputMapelAdmin').value = mapel;
      }
    }

    let currentDayFilter = 'all';

    function filterDay(day) {
      currentDayFilter = day;
      const buttons = document.querySelectorAll('.day-tab-btn');
      buttons.forEach(btn => {
        if (btn.getAttribute('data-day') === day) {
          btn.className = 'day-tab-btn active-day px-3 py-1.5 rounded-xl text-xs font-extrabold bg-blue-50 text-blue-600 transition';
        } else {
          btn.className = 'day-tab-btn px-3 py-1.5 rounded-xl text-xs font-semibold text-slate-500 hover:bg-slate-50 transition';
        }
      });
      filterJadwalTable();
    }

    function filterJadwalTable() {
      const query = document.getElementById('searchJadwalBox').value.toLowerCase();
      const rows = document.querySelectorAll('.jadwal-row');

      rows.forEach(function (row) {
        const text = row.textContent || row.innerText;
        const rowDay = row.getAttribute('data-day');
        const matchText = text.toLowerCase().indexOf(query) > -1;
        const matchDay = (currentDayFilter === 'all') || (rowDay === currentDayFilter);

        if (matchText && matchDay) {
          row.style.display = '';
        } else {
          row.style.display = 'none';
        }
      });
    }
  </script>
</body>
</html>
