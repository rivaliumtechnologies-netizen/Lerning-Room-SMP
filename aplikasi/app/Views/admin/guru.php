<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Data Guru - Room Learning SMP</title>
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
        <a href="<?= site_url('admin/guru') ?>" class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl bg-blue-50 text-blue-600 font-bold text-xs shadow-sm transition">
          <i class="fa-solid fa-chalkboard-user w-4"></i>
          <span>Data Guru</span>
        </a>
        <a href="<?= site_url('admin/siswa') ?>" class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl text-slate-600 hover:bg-slate-50 hover:text-slate-900 font-semibold text-xs transition">
          <i class="fa-solid fa-user-graduate w-4"></i>
          <span>Data Siswa & Kelas</span>
        </a>
        <a href="<?= site_url('admin/jadwal') ?>" class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl text-slate-600 hover:bg-slate-50 hover:text-slate-900 font-semibold text-xs transition">
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
        <h1 class="text-2xl font-extrabold text-slate-900 tracking-tight flex items-center gap-2.5">
          <span class="w-8 h-8 rounded-xl bg-indigo-50 text-indigo-600 flex items-center justify-center text-sm font-bold">
            <i class="fa-solid fa-chalkboard-user"></i>
          </span>
          <span>Data Guru & Pendidik</span>
        </h1>
        <p class="text-xs text-slate-400 mt-1">Kelola data login guru, NIP, mata pelajaran yang diampu, dan kelas pengajaran.</p>
      </div>
      <div class="flex flex-wrap items-center gap-2">
        <a href="<?= site_url('admin/export/guru') ?>" class="inline-flex items-center gap-2 px-3.5 py-2.5 rounded-xl bg-white border border-slate-200 hover:bg-slate-50 text-slate-700 text-xs font-bold shadow-sm transition">
          <i class="fa-solid fa-file-excel text-indigo-600"></i>
          <span>Ekspor Data Guru (CSV)</span>
        </a>
        <button onclick="document.getElementById('modalTambahGuru').classList.remove('hidden')" class="inline-flex items-center gap-2 px-4 py-2.5 rounded-xl bg-indigo-600 hover:bg-indigo-700 text-white text-xs font-extrabold shadow-sm transition">
          <i class="fa-solid fa-user-plus"></i>
          <span>Tambah Guru Baru</span>
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

    <?php if (session()->getFlashdata('errors')): ?>
      <div class="mb-5 bg-red-50 border border-red-200 text-red-700 rounded-2xl p-4 text-xs font-semibold shadow-sm space-y-1">
        <?php foreach (session()->getFlashdata('errors') as $err): ?>
          <p class="flex items-center gap-2"><i class="fa-solid fa-xmark text-red-500"></i> <?= esc($err) ?></p>
        <?php endforeach; ?>
      </div>
    <?php endif; ?>

    <!-- Stat Cards Overview Guru -->
    <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 mb-6">
      <div class="bg-white p-4 rounded-2xl border border-slate-100 shadow-sm flex items-center gap-3">
        <div class="w-11 h-11 rounded-xl bg-indigo-50 text-indigo-600 flex items-center justify-center text-lg font-bold shrink-0">
          <i class="fa-solid fa-chalkboard-user"></i>
        </div>
        <div>
          <span class="text-[10px] font-bold uppercase tracking-wider text-slate-400 block">Total Guru Aktif</span>
          <h3 class="text-xl font-extrabold text-slate-800"><?= count($guru) ?> Pengajar</h3>
        </div>
      </div>

      <div class="bg-white p-4 rounded-2xl border border-slate-100 shadow-sm flex items-center gap-3">
        <div class="w-11 h-11 rounded-xl bg-emerald-50 text-emerald-600 flex items-center justify-center text-lg font-bold shrink-0">
          <i class="fa-solid fa-book-open"></i>
        </div>
        <div>
          <span class="text-[10px] font-bold uppercase tracking-wider text-slate-400 block">Mata Pelajaran Diampu</span>
          <h3 class="text-xl font-extrabold text-slate-800"><?= $totalMapel ?> Bidang Studi</h3>
        </div>
      </div>

      <div class="bg-white p-4 rounded-2xl border border-slate-100 shadow-sm flex items-center gap-3">
        <div class="w-11 h-11 rounded-xl bg-blue-50 text-blue-600 flex items-center justify-center text-lg font-bold shrink-0">
          <i class="fa-solid fa-layer-group"></i>
        </div>
        <div>
          <span class="text-[10px] font-bold uppercase tracking-wider text-slate-400 block">Cakupan Kelas Pengajaran</span>
          <h3 class="text-xl font-extrabold text-slate-800"><?= $totalKelasDiajar ?> Rombel</h3>
        </div>
      </div>
    </div>

    <!-- Tabel Data Guru -->
    <div class="bg-white rounded-3xl border border-slate-100 shadow-sm p-6 mb-8">
      <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 mb-6 pb-4 border-b border-slate-100">
        <div>
          <h3 class="text-sm font-extrabold text-slate-800">Daftar Guru & Pendidik</h3>
          <p class="text-[11px] text-slate-400">Total <?= count($guru) ?> guru terdaftar di dalam platform.</p>
        </div>

        <div class="relative w-full sm:w-72">
          <i class="fa-solid fa-magnifying-glass absolute left-3.5 top-3 text-slate-400 text-xs"></i>
          <input type="text" id="searchGuruBox" onkeyup="filterGuruList()" placeholder="Cari nama guru, NIP, mapel, email..." class="w-full pl-9 pr-4 py-2 bg-slate-50 border border-slate-200 rounded-xl text-xs text-slate-800 focus:bg-white focus:outline-none focus:ring-2 focus:ring-indigo-500">
        </div>
      </div>

      <div class="overflow-x-auto">
        <table class="w-full text-left text-xs">
          <thead>
            <tr class="bg-slate-50 text-slate-400 uppercase text-[10px] font-extrabold tracking-wider border-b border-slate-100">
              <th class="p-3.5 pl-4">Guru Pendidik</th>
              <th class="p-3.5">NIP / ID</th>
              <th class="p-3.5">Mata Pelajaran</th>
              <th class="p-3.5">Kelas yang Diajar</th>
              <th class="p-3.5">Email Akun</th>
              <th class="p-3.5 text-right pr-4">Aksi</th>
            </tr>
          </thead>
          <tbody id="guruTableBody" class="divide-y divide-slate-100">
            <?php if (empty($guru)): ?>
              <tr>
                <td colspan="6" class="text-center py-10 text-slate-400 text-xs italic">
                  Belum ada akun guru yang terdaftar. Klik tombol Tambah Guru Baru di atas.
                </td>
              </tr>
            <?php else: ?>
              <?php foreach ($guru as $g): ?>
                <tr class="hover:bg-slate-50/70 transition guru-row">
                  <td class="p-3.5 pl-4">
                    <div class="flex items-center gap-2.5">
                      <div class="w-8 h-8 rounded-full bg-indigo-100 text-indigo-700 flex items-center justify-center font-bold text-xs shrink-0">
                        <?= strtoupper(substr($g['nama'], 0, 1)) ?>
                      </div>
                      <span class="font-bold text-slate-800 text-xs"><?= esc($g['nama']) ?></span>
                    </div>
                  </td>
                  <td class="p-3.5 font-semibold text-slate-600">
                    <?= esc($g['nis'] ?: '-') ?>
                  </td>
                  <td class="p-3.5">
                    <span class="px-2.5 py-0.5 rounded-lg text-[10px] font-extrabold bg-emerald-50 text-emerald-700 border border-emerald-100">
                      <?= esc($g['mapel'] ?: 'Umum') ?>
                    </span>
                  </td>
                  <td class="p-3.5 font-semibold text-slate-700 text-[11px]">
                    <?= esc($g['kelas_diajar'] ?: 'Semua') ?>
                  </td>
                  <td class="p-3.5 text-slate-500 font-mono text-[11px]">
                    <?= esc($g['email']) ?>
                  </td>
                  <td class="p-3.5 text-right pr-4">
                    <div class="flex items-center justify-end gap-1.5">
                      <button type="button" onclick='openEditGuruModal(<?= json_encode($g, JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP) ?>)' class="inline-flex items-center gap-1 px-2.5 py-1 rounded-lg text-blue-600 bg-blue-50 hover:bg-blue-100 text-[11px] font-bold transition" title="Edit Data Guru">
                        <i class="fa-solid fa-pen-to-square text-[10px]"></i>
                        <span>Edit</span>
                      </button>
                      <button type="button" onclick="openResetPasswordModal('<?= esc($g['id']) ?>', '<?= esc($g['nama'], 'js') ?>')" class="inline-flex items-center gap-1 px-2.5 py-1 rounded-lg text-amber-600 bg-amber-50 hover:bg-amber-100 text-[11px] font-bold transition" title="Reset Password">
                        <i class="fa-solid fa-key text-[10px]"></i>
                        <span>Reset</span>
                      </button>
                      <form action="<?= site_url('admin/users/delete') ?>" method="post" onsubmit="return confirm('Apakah Anda yakin ingin menghapus akun guru <?= esc($g['nama']) ?>? Seluruh materi & tugas yang diunggah guru ini akan terhapus.')" class="inline">
                        <?= csrf_field() ?>
                        <input type="hidden" name="user_id" value="<?= esc($g['id']) ?>">
                        <button type="submit" class="inline-flex items-center gap-1 px-2.5 py-1 rounded-lg text-red-500 bg-red-50 hover:bg-red-100 text-[11px] font-bold transition" title="Hapus Akun">
                          <i class="fa-regular fa-trash-can text-[10px]"></i>
                          <span>Hapus</span>
                        </button>
                      </form>
                    </div>
                  </td>
                </tr>
              <?php endforeach; ?>
            <?php endif; ?>
          </tbody>
        </table>
      </div>
    </div>
  </main>

  <!-- Modal Tambah Guru Baru -->
  <div id="modalTambahGuru" class="fixed inset-0 bg-slate-900/60 backdrop-blur-sm z-50 flex items-center justify-center p-4 hidden">
    <div class="bg-white rounded-3xl max-w-lg w-full p-6 shadow-2xl border border-slate-100 relative max-h-[92vh] overflow-y-auto custom-scroll">
      <div class="flex items-center justify-between mb-4 pb-3 border-b border-slate-100">
        <div class="flex items-center gap-2.5">
          <div class="w-8 h-8 rounded-xl bg-indigo-50 text-indigo-600 flex items-center justify-center text-sm font-bold">
            <i class="fa-solid fa-chalkboard-user"></i>
          </div>
          <div>
            <h3 class="font-extrabold text-sm text-slate-800">Tambah Akun Guru Baru</h3>
            <p class="text-[11px] text-slate-400">Buat akses login untuk pendidik & tentukan kelas pengajaran.</p>
          </div>
        </div>
        <button type="button" onclick="document.getElementById('modalTambahGuru').classList.add('hidden')" class="text-slate-400 hover:text-slate-600 text-sm">
          <i class="fa-solid fa-xmark"></i>
        </button>
      </div>

      <form action="<?= site_url('admin/users/save') ?>" method="post" class="space-y-4">
        <?= csrf_field() ?>
        <input type="hidden" name="role" value="guru">

        <div class="grid grid-cols-2 gap-3">
          <div>
            <label class="block text-[11px] font-bold uppercase text-slate-500 mb-1.5">Nama Lengkap Guru *</label>
            <input name="nama" type="text" required placeholder="Contoh: Dra. Hj. Nurjanah" class="w-full rounded-xl border border-slate-200 px-3 py-2 text-xs bg-slate-50 focus:bg-white focus:outline-none focus:ring-2 focus:ring-indigo-500 font-semibold">
          </div>
          <div>
            <label class="block text-[11px] font-bold uppercase text-slate-500 mb-1.5">NIP Guru (Opsional)</label>
            <input name="nis" type="text" placeholder="Contoh: 198501012020121001" class="w-full rounded-xl border border-slate-200 px-3 py-2 text-xs bg-slate-50 focus:bg-white focus:outline-none focus:ring-2 focus:ring-indigo-500">
          </div>
        </div>

        <div>
          <label class="block text-[11px] font-bold uppercase text-slate-500 mb-1.5">Mata Pelajaran Diampu *</label>
          <div class="space-y-2">
            <select name="mapel" id="tambahGuruMapelSelect" required onchange="handleMapelSelectChange('tambah')" class="w-full rounded-xl border border-slate-200 px-3 py-2 text-xs bg-slate-50 focus:bg-white focus:outline-none focus:ring-2 focus:ring-indigo-500 font-semibold text-slate-700 cursor-pointer">
              <option value="">-- Pilih Mata Pelajaran Standar SMP --</option>
              <optgroup label="Mata Pelajaran Utama (Kurikulum Nasional)">
                <option value="Pendidikan Agama & Budi Pekerti">Pendidikan Agama & Budi Pekerti</option>
                <option value="Pendidikan Pancasila (PPKn)">Pendidikan Pancasila (PPKn)</option>
                <option value="Bahasa Indonesia">Bahasa Indonesia</option>
                <option value="Matematika">Matematika</option>
                <option value="Ilmu Pengetahuan Alam (IPA)">Ilmu Pengetahuan Alam (IPA)</option>
                <option value="Ilmu Pengetahuan Sosial (IPS)">Ilmu Pengetahuan Sosial (IPS)</option>
                <option value="Bahasa Inggris">Bahasa Inggris</option>
                <option value="Informatika">Informatika</option>
                <option value="PJOK">PJOK (Penjasorkes)</option>
                <option value="Seni Budaya">Seni Budaya</option>
                <option value="Prakarya">Prakarya</option>
              </optgroup>
              <optgroup label="Muatan Lokal & Layanan">
                <option value="Bahasa Sunda">Bahasa Sunda (Muatan Lokal)</option>
                <option value="Bimbingan Konseling (BK)">Bimbingan Konseling (BK)</option>
              </optgroup>
              <optgroup label="Lainnya">
                <option value="__LAINNYA__">+ Tambah Mata Pelajaran Lainnya...</option>
              </optgroup>
            </select>

            <!-- Input Kustom jika memilih Lainnya -->
            <div id="tambahCustomMapelWrapper" class="hidden">
              <input type="text" name="custom_mapel" id="tambahCustomMapelInput" placeholder="Ketik nama mata pelajaran baru..." class="w-full rounded-xl border border-indigo-300 px-3 py-2 text-xs bg-indigo-50/40 focus:bg-white focus:outline-none focus:ring-2 focus:ring-indigo-500 font-semibold text-slate-800">
              <p class="text-[10px] text-slate-400 mt-1">Nama mata pelajaran baru akan tersimpan untuk guru ini.</p>
            </div>
          </div>
        </div>

        <!-- Pilihan Kelas yang Diajar Menggunakan Centang / Checkbox (7A-G, 8A-G, 9A-G) -->
        <div>
          <div class="flex items-center justify-between mb-2">
            <label class="block text-[11px] font-bold uppercase text-slate-700">Pilih Kelas yang Diajar (7 A-G, 8 A-G, 9 A-G) *</label>
            <div class="flex items-center gap-2">
              <button type="button" onclick="toggleKelasCheckboxes('tambah', true)" class="text-[10px] font-bold text-indigo-600 hover:text-indigo-800 transition">Pilih Semua</button>
              <span class="text-slate-300 text-xs">|</span>
              <button type="button" onclick="toggleKelasCheckboxes('tambah', false)" class="text-[10px] font-bold text-slate-400 hover:text-slate-600 transition">Batal Semua</button>
            </div>
          </div>

          <div class="space-y-2.5 p-3 bg-slate-50 border border-slate-200 rounded-2xl max-h-56 overflow-y-auto custom-scroll">
            <!-- Jenjang Kelas 7 (VII-A s/d VII-G) -->
            <div>
              <div class="flex items-center justify-between mb-1.5 px-0.5">
                <span class="text-[10px] font-extrabold text-emerald-800 uppercase tracking-wider flex items-center gap-1">
                  <i class="fa-solid fa-graduation-cap text-emerald-600"></i> Kelas 7 (VII-A s/d VII-G)
                </span>
                <button type="button" onclick="toggleGradeCheckboxes('tambah', 'VII', true)" class="text-[10px] font-bold text-emerald-600 hover:text-emerald-800">Pilih Semua 7</button>
              </div>
              <div class="grid grid-cols-4 sm:grid-cols-7 gap-1.5">
                <?php foreach (($classesByGrade['VII'] ?? []) as $cls): ?>
                  <label class="flex items-center justify-center gap-1 py-1 px-1.5 rounded-lg border border-slate-200 bg-white hover:border-emerald-400 cursor-pointer transition select-none text-[11px] font-bold text-slate-700 hover:bg-emerald-50/50">
                    <input type="checkbox" name="kelas_diajar[]" value="<?= esc($cls) ?>" data-grade="VII" class="tambah-kelas-cb rounded border-slate-300 text-emerald-600 focus:ring-emerald-500 h-3 w-3">
                    <span><?= esc($cls) ?></span>
                  </label>
                <?php endforeach; ?>
              </div>
            </div>

            <!-- Jenjang Kelas 8 (VIII-A s/d VIII-G) -->
            <div class="pt-2 border-t border-slate-200/60">
              <div class="flex items-center justify-between mb-1.5 px-0.5">
                <span class="text-[10px] font-extrabold text-blue-800 uppercase tracking-wider flex items-center gap-1">
                  <i class="fa-solid fa-graduation-cap text-blue-600"></i> Kelas 8 (VIII-A s/d VIII-G)
                </span>
                <button type="button" onclick="toggleGradeCheckboxes('tambah', 'VIII', true)" class="text-[10px] font-bold text-blue-600 hover:text-blue-800">Pilih Semua 8</button>
              </div>
              <div class="grid grid-cols-4 sm:grid-cols-7 gap-1.5">
                <?php foreach (($classesByGrade['VIII'] ?? []) as $cls): ?>
                  <label class="flex items-center justify-center gap-1 py-1 px-1.5 rounded-lg border border-slate-200 bg-white hover:border-blue-400 cursor-pointer transition select-none text-[11px] font-bold text-slate-700 hover:bg-blue-50/50">
                    <input type="checkbox" name="kelas_diajar[]" value="<?= esc($cls) ?>" data-grade="VIII" class="tambah-kelas-cb rounded border-slate-300 text-blue-600 focus:ring-blue-500 h-3 w-3">
                    <span><?= esc($cls) ?></span>
                  </label>
                <?php endforeach; ?>
              </div>
            </div>

            <!-- Jenjang Kelas 9 (IX-A s/d IX-G) -->
            <div class="pt-2 border-t border-slate-200/60">
              <div class="flex items-center justify-between mb-1.5 px-0.5">
                <span class="text-[10px] font-extrabold text-purple-800 uppercase tracking-wider flex items-center gap-1">
                  <i class="fa-solid fa-graduation-cap text-purple-600"></i> Kelas 9 (IX-A s/d IX-G)
                </span>
                <button type="button" onclick="toggleGradeCheckboxes('tambah', 'IX', true)" class="text-[10px] font-bold text-purple-600 hover:text-purple-800">Pilih Semua 9</button>
              </div>
              <div class="grid grid-cols-4 sm:grid-cols-7 gap-1.5">
                <?php foreach (($classesByGrade['IX'] ?? []) as $cls): ?>
                  <label class="flex items-center justify-center gap-1 py-1 px-1.5 rounded-lg border border-slate-200 bg-white hover:border-purple-400 cursor-pointer transition select-none text-[11px] font-bold text-slate-700 hover:bg-purple-50/50">
                    <input type="checkbox" name="kelas_diajar[]" value="<?= esc($cls) ?>" data-grade="IX" class="tambah-kelas-cb rounded border-slate-300 text-purple-600 focus:ring-purple-500 h-3 w-3">
                    <span><?= esc($cls) ?></span>
                  </label>
                <?php endforeach; ?>
              </div>
            </div>

            <?php if (!empty($classesByGrade['LAIN'])): ?>
            <!-- Kelas Lainnya Jika Ada -->
            <div class="pt-2 border-t border-slate-200/60">
              <span class="text-[10px] font-extrabold text-slate-600 uppercase tracking-wider block mb-1.5 px-0.5">Kelas Lainnya</span>
              <div class="grid grid-cols-4 gap-1.5">
                <?php foreach ($classesByGrade['LAIN'] as $cls): ?>
                  <label class="flex items-center justify-center gap-1 py-1 px-1.5 rounded-lg border border-slate-200 bg-white hover:border-slate-400 cursor-pointer transition select-none text-[11px] font-bold text-slate-700">
                    <input type="checkbox" name="kelas_diajar[]" value="<?= esc($cls) ?>" data-grade="LAIN" class="tambah-kelas-cb rounded border-slate-300 text-slate-600 focus:ring-slate-500 h-3 w-3">
                    <span><?= esc($cls) ?></span>
                  </label>
                <?php endforeach; ?>
              </div>
            </div>
            <?php endif; ?>
          </div>
          <p class="text-[10px] text-slate-400 mt-1">Centang satu atau lebih kelas yang diampu guru ini.</p>
        </div>

        <div>
          <label class="block text-[11px] font-bold uppercase text-slate-500 mb-1.5">Alamat Email Login *</label>
          <input name="email" type="email" required placeholder="guru@roomlearning.sch.id" class="w-full rounded-xl border border-slate-200 px-3 py-2 text-xs bg-slate-50 focus:bg-white focus:outline-none focus:ring-2 focus:ring-indigo-500">
        </div>

        <div>
          <label class="block text-[11px] font-bold uppercase text-slate-500 mb-1.5">Kata Sandi Awal *</label>
          <input name="password" type="password" required placeholder="Minimal 4 karakter (misal: guru123)" class="w-full rounded-xl border border-slate-200 px-3 py-2 text-xs bg-slate-50 focus:bg-white focus:outline-none focus:ring-2 focus:ring-indigo-500">
        </div>

        <div class="pt-2 flex items-center justify-end gap-2 border-t border-slate-100">
          <button type="button" onclick="document.getElementById('modalTambahGuru').classList.add('hidden')" class="px-4 py-2 rounded-xl border border-slate-200 text-xs font-bold text-slate-600 hover:bg-slate-50 transition">
            Batal
          </button>
          <button type="submit" class="px-4 py-2 rounded-xl bg-indigo-600 hover:bg-indigo-700 text-xs font-bold text-white shadow-sm transition">
            Simpan Guru Baru
          </button>
        </div>
      </form>
    </div>
  </div>

  <!-- Modal Edit Guru -->
  <div id="modalEditGuru" class="fixed inset-0 bg-slate-900/60 backdrop-blur-sm z-50 flex items-center justify-center p-4 hidden">
    <div class="bg-white rounded-3xl max-w-lg w-full p-6 shadow-2xl border border-slate-100 relative max-h-[92vh] overflow-y-auto custom-scroll">
      <div class="flex items-center justify-between mb-4 pb-3 border-b border-slate-100">
        <div class="flex items-center gap-2.5">
          <div class="w-8 h-8 rounded-xl bg-blue-50 text-blue-600 flex items-center justify-center text-sm font-bold">
            <i class="fa-solid fa-pen-to-square"></i>
          </div>
          <div>
            <h3 class="font-extrabold text-sm text-slate-800">Edit Data Guru</h3>
            <p class="text-[11px] text-slate-400">Perbarui profil, mata pelajaran, dan kelas yang diajar.</p>
          </div>
        </div>
        <button type="button" onclick="document.getElementById('modalEditGuru').classList.add('hidden')" class="text-slate-400 hover:text-slate-600 text-sm">
          <i class="fa-solid fa-xmark"></i>
        </button>
      </div>

      <form action="<?= site_url('admin/users/save') ?>" method="post" class="space-y-4">
        <?= csrf_field() ?>
        <input type="hidden" name="user_id" id="editGuruId">
        <input type="hidden" name="role" value="guru">

        <div class="grid grid-cols-2 gap-3">
          <div>
            <label class="block text-[11px] font-bold uppercase text-slate-500 mb-1.5">Nama Lengkap Guru *</label>
            <input name="nama" id="editGuruNama" type="text" required placeholder="Nama guru" class="w-full rounded-xl border border-slate-200 px-3 py-2 text-xs bg-slate-50 focus:bg-white focus:outline-none focus:ring-2 focus:ring-blue-500 font-semibold">
          </div>
          <div>
            <label class="block text-[11px] font-bold uppercase text-slate-500 mb-1.5">NIP Guru (Opsional)</label>
            <input name="nis" id="editGuruNis" type="text" placeholder="NIP Guru" class="w-full rounded-xl border border-slate-200 px-3 py-2 text-xs bg-slate-50 focus:bg-white focus:outline-none focus:ring-2 focus:ring-blue-500">
          </div>
        </div>

        <div>
          <label class="block text-[11px] font-bold uppercase text-slate-500 mb-1.5">Mata Pelajaran Diampu *</label>
          <div class="space-y-2">
            <select name="mapel" id="editGuruMapelSelect" required onchange="handleMapelSelectChange('edit')" class="w-full rounded-xl border border-slate-200 px-3 py-2 text-xs bg-slate-50 focus:bg-white focus:outline-none focus:ring-2 focus:ring-blue-500 font-semibold text-slate-700 cursor-pointer">
              <option value="">-- Pilih Mata Pelajaran Standar SMP --</option>
              <optgroup label="Mata Pelajaran Utama (Kurikulum Nasional)">
                <option value="Pendidikan Agama & Budi Pekerti">Pendidikan Agama & Budi Pekerti</option>
                <option value="Pendidikan Pancasila (PPKn)">Pendidikan Pancasila (PPKn)</option>
                <option value="Bahasa Indonesia">Bahasa Indonesia</option>
                <option value="Matematika">Matematika</option>
                <option value="Ilmu Pengetahuan Alam (IPA)">Ilmu Pengetahuan Alam (IPA)</option>
                <option value="Ilmu Pengetahuan Sosial (IPS)">Ilmu Pengetahuan Sosial (IPS)</option>
                <option value="Bahasa Inggris">Bahasa Inggris</option>
                <option value="Informatika">Informatika</option>
                <option value="PJOK">PJOK (Penjasorkes)</option>
                <option value="Seni Budaya">Seni Budaya</option>
                <option value="Prakarya">Prakarya</option>
              </optgroup>
              <optgroup label="Muatan Lokal & Layanan">
                <option value="Bahasa Sunda">Bahasa Sunda (Muatan Lokal)</option>
                <option value="Bimbingan Konseling (BK)">Bimbingan Konseling (BK)</option>
              </optgroup>
              <optgroup label="Lainnya">
                <option value="__LAINNYA__">+ Tambah Mata Pelajaran Lainnya...</option>
              </optgroup>
            </select>

            <!-- Input Kustom jika memilih Lainnya -->
            <div id="editCustomMapelWrapper" class="hidden">
              <input type="text" name="custom_mapel" id="editCustomMapelInput" placeholder="Ketik nama mata pelajaran baru..." class="w-full rounded-xl border border-blue-300 px-3 py-2 text-xs bg-blue-50/40 focus:bg-white focus:outline-none focus:ring-2 focus:ring-blue-500 font-semibold text-slate-800">
              <p class="text-[10px] text-slate-400 mt-1">Nama mata pelajaran baru akan tersimpan untuk guru ini.</p>
            </div>
          </div>
        </div>

        <!-- Pilihan Kelas yang Diajar Edit (Centang Kelas 7A-G, 8A-G, 9A-G) -->
        <div>
          <div class="flex items-center justify-between mb-2">
            <label class="block text-[11px] font-bold uppercase text-slate-700">Pilih Kelas yang Diajar (7 A-G, 8 A-G, 9 A-G) *</label>
            <div class="flex items-center gap-2">
              <button type="button" onclick="toggleKelasCheckboxes('edit', true)" class="text-[10px] font-bold text-blue-600 hover:text-blue-800 transition">Pilih Semua</button>
              <span class="text-slate-300 text-xs">|</span>
              <button type="button" onclick="toggleKelasCheckboxes('edit', false)" class="text-[10px] font-bold text-slate-400 hover:text-slate-600 transition">Batal Semua</button>
            </div>
          </div>

          <div class="space-y-2.5 p-3 bg-slate-50 border border-slate-200 rounded-2xl max-h-56 overflow-y-auto custom-scroll">
            <!-- Jenjang Kelas 7 (VII-A s/d VII-G) -->
            <div>
              <div class="flex items-center justify-between mb-1.5 px-0.5">
                <span class="text-[10px] font-extrabold text-emerald-800 uppercase tracking-wider flex items-center gap-1">
                  <i class="fa-solid fa-graduation-cap text-emerald-600"></i> Kelas 7 (VII-A s/d VII-G)
                </span>
                <button type="button" onclick="toggleGradeCheckboxes('edit', 'VII', true)" class="text-[10px] font-bold text-emerald-600 hover:text-emerald-800">Pilih Semua 7</button>
              </div>
              <div class="grid grid-cols-4 sm:grid-cols-7 gap-1.5">
                <?php foreach (($classesByGrade['VII'] ?? []) as $cls): ?>
                  <label class="flex items-center justify-center gap-1 py-1 px-1.5 rounded-lg border border-slate-200 bg-white hover:border-emerald-400 cursor-pointer transition select-none text-[11px] font-bold text-slate-700 hover:bg-emerald-50/50">
                    <input type="checkbox" name="kelas_diajar[]" value="<?= esc($cls) ?>" data-grade="VII" class="edit-kelas-cb rounded border-slate-300 text-emerald-600 focus:ring-emerald-500 h-3 w-3">
                    <span><?= esc($cls) ?></span>
                  </label>
                <?php endforeach; ?>
              </div>
            </div>

            <!-- Jenjang Kelas 8 (VIII-A s/d VIII-G) -->
            <div class="pt-2 border-t border-slate-200/60">
              <div class="flex items-center justify-between mb-1.5 px-0.5">
                <span class="text-[10px] font-extrabold text-blue-800 uppercase tracking-wider flex items-center gap-1">
                  <i class="fa-solid fa-graduation-cap text-blue-600"></i> Kelas 8 (VIII-A s/d VIII-G)
                </span>
                <button type="button" onclick="toggleGradeCheckboxes('edit', 'VIII', true)" class="text-[10px] font-bold text-blue-600 hover:text-blue-800">Pilih Semua 8</button>
              </div>
              <div class="grid grid-cols-4 sm:grid-cols-7 gap-1.5">
                <?php foreach (($classesByGrade['VIII'] ?? []) as $cls): ?>
                  <label class="flex items-center justify-center gap-1 py-1 px-1.5 rounded-lg border border-slate-200 bg-white hover:border-blue-400 cursor-pointer transition select-none text-[11px] font-bold text-slate-700 hover:bg-blue-50/50">
                    <input type="checkbox" name="kelas_diajar[]" value="<?= esc($cls) ?>" data-grade="VIII" class="edit-kelas-cb rounded border-slate-300 text-blue-600 focus:ring-blue-500 h-3 w-3">
                    <span><?= esc($cls) ?></span>
                  </label>
                <?php endforeach; ?>
              </div>
            </div>

            <!-- Jenjang Kelas 9 (IX-A s/d IX-G) -->
            <div class="pt-2 border-t border-slate-200/60">
              <div class="flex items-center justify-between mb-1.5 px-0.5">
                <span class="text-[10px] font-extrabold text-purple-800 uppercase tracking-wider flex items-center gap-1">
                  <i class="fa-solid fa-graduation-cap text-purple-600"></i> Kelas 9 (IX-A s/d IX-G)
                </span>
                <button type="button" onclick="toggleGradeCheckboxes('edit', 'IX', true)" class="text-[10px] font-bold text-purple-600 hover:text-purple-800">Pilih Semua 9</button>
              </div>
              <div class="grid grid-cols-4 sm:grid-cols-7 gap-1.5">
                <?php foreach (($classesByGrade['IX'] ?? []) as $cls): ?>
                  <label class="flex items-center justify-center gap-1 py-1 px-1.5 rounded-lg border border-slate-200 bg-white hover:border-purple-400 cursor-pointer transition select-none text-[11px] font-bold text-slate-700 hover:bg-purple-50/50">
                    <input type="checkbox" name="kelas_diajar[]" value="<?= esc($cls) ?>" data-grade="IX" class="edit-kelas-cb rounded border-slate-300 text-purple-600 focus:ring-purple-500 h-3 w-3">
                    <span><?= esc($cls) ?></span>
                  </label>
                <?php endforeach; ?>
              </div>
            </div>

            <?php if (!empty($classesByGrade['LAIN'])): ?>
            <!-- Kelas Lainnya Jika Ada -->
            <div class="pt-2 border-t border-slate-200/60">
              <span class="text-[10px] font-extrabold text-slate-600 uppercase tracking-wider block mb-1.5 px-0.5">Kelas Lainnya</span>
              <div class="grid grid-cols-4 gap-1.5">
                <?php foreach ($classesByGrade['LAIN'] as $cls): ?>
                  <label class="flex items-center justify-center gap-1 py-1 px-1.5 rounded-lg border border-slate-200 bg-white hover:border-slate-400 cursor-pointer transition select-none text-[11px] font-bold text-slate-700">
                    <input type="checkbox" name="kelas_diajar[]" value="<?= esc($cls) ?>" data-grade="LAIN" class="edit-kelas-cb rounded border-slate-300 text-slate-600 focus:ring-slate-500 h-3 w-3">
                    <span><?= esc($cls) ?></span>
                  </label>
                <?php endforeach; ?>
              </div>
            </div>
            <?php endif; ?>
          </div>
          <p class="text-[10px] text-slate-400 mt-1">Centang satu atau beberapa kelas rombel yang diajar.</p>
        </div>

        <div>
          <label class="block text-[11px] font-bold uppercase text-slate-500 mb-1.5">Alamat Email Login *</label>
          <input name="email" id="editGuruEmail" type="email" required placeholder="guru@roomlearning.sch.id" class="w-full rounded-xl border border-slate-200 px-3 py-2 text-xs bg-slate-50 focus:bg-white focus:outline-none focus:ring-2 focus:ring-blue-500">
        </div>

        <div>
          <label class="block text-[11px] font-bold uppercase text-slate-500 mb-1.5">
            Ubah Kata Sandi <span class="text-[10px] text-slate-400 font-normal lowercase">(opsional - kosongkan jika tidak ingin diubah)</span>
          </label>
          <input name="password" id="editGuruPassword" type="password" placeholder="Kosongkan jika tetap memakai kata sandi lama" class="w-full rounded-xl border border-slate-200 px-3 py-2 text-xs bg-slate-50 focus:bg-white focus:outline-none focus:ring-2 focus:ring-blue-500">
        </div>

        <div class="pt-2 flex items-center justify-end gap-2 border-t border-slate-100">
          <button type="button" onclick="document.getElementById('modalEditGuru').classList.add('hidden')" class="px-4 py-2 rounded-xl border border-slate-200 text-xs font-bold text-slate-600 hover:bg-slate-50 transition">
            Batal
          </button>
          <button type="submit" class="px-4 py-2 rounded-xl bg-blue-600 hover:bg-blue-700 text-xs font-bold text-white shadow-sm transition">
            Perbarui Data Guru
          </button>
        </div>
      </form>
    </div>
  </div>

  <!-- Modal Ubah Password -->
  <div id="modalUbahPassword" class="fixed inset-0 bg-slate-900/60 backdrop-blur-sm z-50 flex items-center justify-center p-4 hidden">
    <div class="bg-white rounded-3xl max-w-md w-full p-6 shadow-2xl border border-slate-100 relative">
      <div class="flex items-center justify-between mb-4 pb-3 border-b border-slate-100">
        <div class="flex items-center gap-2.5">
          <div class="w-8 h-8 rounded-xl bg-amber-50 text-amber-600 flex items-center justify-center text-sm font-bold">
            <i class="fa-solid fa-key"></i>
          </div>
          <div>
            <h3 class="font-extrabold text-sm text-slate-800">Ubah Kata Sandi Guru</h3>
            <p class="text-[11px] text-slate-400">Atur ulang password guru yang bersangkutan.</p>
          </div>
        </div>
        <button type="button" onclick="document.getElementById('modalUbahPassword').classList.add('hidden')" class="text-slate-400 hover:text-slate-600 text-sm">
          <i class="fa-solid fa-xmark"></i>
        </button>
      </div>

      <form action="<?= site_url('admin/users/change-password') ?>" method="post" class="space-y-4">
        <?= csrf_field() ?>
        <div>
          <label class="block text-[11px] font-bold uppercase text-slate-500 mb-1.5">Pilih Guru *</label>
          <select name="user_id" id="resetUserIdSelect" required class="w-full rounded-xl border border-slate-200 px-3 py-2 text-xs bg-slate-50 focus:bg-white focus:outline-none focus:ring-2 focus:ring-indigo-500 font-semibold text-slate-700">
            <option value="">-- Pilih Akun Guru --</option>
            <?php foreach ($guru as $g): ?>
              <option value="<?= esc($g['id']) ?>"><?= esc($g['nama']) ?> (<?= esc($g['email']) ?>)</option>
            <?php endforeach; ?>
          </select>
        </div>

        <div>
          <label class="block text-[11px] font-bold uppercase text-slate-500 mb-1.5">Kata Sandi Baru *</label>
          <input name="new_password" type="password" required placeholder="Ketik kata sandi baru" class="w-full rounded-xl border border-slate-200 px-3 py-2 text-xs bg-slate-50 focus:bg-white focus:outline-none focus:ring-2 focus:ring-indigo-500">
        </div>

        <div class="pt-2 flex items-center justify-end gap-2 border-t border-slate-100">
          <button type="button" onclick="document.getElementById('modalUbahPassword').classList.add('hidden')" class="px-4 py-2 rounded-xl border border-slate-200 text-xs font-bold text-slate-600 hover:bg-slate-50 transition">
            Batal
          </button>
          <button type="submit" class="px-4 py-2 rounded-xl bg-amber-600 hover:bg-amber-700 text-xs font-bold text-white shadow-sm transition">
            Perbarui Kata Sandi
          </button>
        </div>
      </form>
    </div>
  </div>

  <script>
    function toggleKelasCheckboxes(prefix, checkAll) {
      const selector = prefix === 'edit' ? '.edit-kelas-cb' : '.tambah-kelas-cb';
      document.querySelectorAll(selector).forEach(cb => {
        cb.checked = checkAll;
      });
    }

    function toggleGradeCheckboxes(prefix, grade, checkAll) {
      const selector = prefix === 'edit' ? '.edit-kelas-cb' : '.tambah-kelas-cb';
      document.querySelectorAll(selector).forEach(cb => {
        if (cb.getAttribute('data-grade') === grade) {
          cb.checked = checkAll;
        }
      });
    }

    function handleMapelSelectChange(prefix) {
      const select = document.getElementById(prefix === 'edit' ? 'editGuruMapelSelect' : 'tambahGuruMapelSelect');
      const wrapper = document.getElementById(prefix === 'edit' ? 'editCustomMapelWrapper' : 'tambahCustomMapelWrapper');
      const input = document.getElementById(prefix === 'edit' ? 'editCustomMapelInput' : 'tambahCustomMapelInput');

      if (select.value === '__LAINNYA__') {
        wrapper.classList.remove('hidden');
        input.setAttribute('required', 'required');
        input.focus();
      } else {
        wrapper.classList.add('hidden');
        input.removeAttribute('required');
      }
    }

    function openEditGuruModal(guruData) {
      document.getElementById('editGuruId').value = guruData.id || '';
      document.getElementById('editGuruNama').value = guruData.nama || '';
      document.getElementById('editGuruNis').value = guruData.nis || '';
      document.getElementById('editGuruEmail').value = guruData.email || '';
      document.getElementById('editGuruPassword').value = '';

      // Set Mapel di dropdown atau custom input
      const mapelSelect = document.getElementById('editGuruMapelSelect');
      const customWrapper = document.getElementById('editCustomMapelWrapper');
      const customInput = document.getElementById('editCustomMapelInput');
      const curMapel = (guruData.mapel || '').trim();

      let found = false;
      for (let i = 0; i < mapelSelect.options.length; i++) {
        if (mapelSelect.options[i].value && mapelSelect.options[i].value.toLowerCase() === curMapel.toLowerCase()) {
          mapelSelect.selectedIndex = i;
          found = true;
          break;
        }
      }

      if (!found && curMapel !== '') {
        mapelSelect.value = '__LAINNYA__';
        customWrapper.classList.remove('hidden');
        customInput.value = curMapel;
        customInput.setAttribute('required', 'required');
      } else {
        customWrapper.classList.add('hidden');
        customInput.value = '';
        customInput.removeAttribute('required');
      }

      // Reset semua checkbox edit
      document.querySelectorAll('.edit-kelas-cb').forEach(cb => {
        cb.checked = false;
      });

      // Centang kelas yang sesuai
      if (guruData.kelas_diajar) {
        const rawClasses = guruData.kelas_diajar.split(',').map(s => s.trim().toLowerCase());
        document.querySelectorAll('.edit-kelas-cb').forEach(cb => {
          if (rawClasses.includes(cb.value.toLowerCase())) {
            cb.checked = true;
          }
        });
      }

      document.getElementById('modalEditGuru').classList.remove('hidden');
    }

    function openResetPasswordModal(userId, userName) {
      const modal = document.getElementById('modalUbahPassword');
      const select = document.getElementById('resetUserIdSelect');
      select.value = userId;
      modal.classList.remove('hidden');
    }

    function filterGuruList() {
      const query = document.getElementById('searchGuruBox').value.toLowerCase().trim();
      const rows = document.querySelectorAll('.guru-row');
      rows.forEach(function(row) {
        const text = (row.textContent || row.innerText).toLowerCase();
        if (query === '' || text.indexOf(query) > -1) {
          row.style.display = '';
        } else {
          row.style.display = 'none';
        }
      });
    }
  </script>
</body>
</html>
