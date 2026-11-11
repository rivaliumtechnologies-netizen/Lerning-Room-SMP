<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Cetak Rekap Nilai Siswa - <?= esc($mapel) ?></title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;700;800&display=swap" rel="stylesheet">
  <style>
    body { font-family: 'Plus Jakarta Sans', sans-serif; }
    @media print {
      .no-print { display: none !important; }
      body { background-color: white !important; font-size: 11pt; }
      @page { margin: 1.5cm; }
    }
  </style>
</head>
<body class="bg-slate-100 text-slate-800 p-4 md:p-8">
  <!-- Bar Tombol Aksi (Tidak Ikut Tercetak) -->
  <div class="max-w-5xl mx-auto mb-6 flex items-center justify-between no-print bg-white p-4 rounded-2xl border border-slate-200 shadow-sm">
    <div class="flex items-center gap-2">
      <a href="<?= site_url('guru/nilai') ?>" class="px-4 py-2 rounded-xl border border-slate-200 text-xs font-bold text-slate-600 hover:bg-slate-50 transition inline-flex items-center gap-2">
        <i class="fa-solid fa-arrow-left"></i>
        <span>Kembali ke Panel Nilai</span>
      </a>
      <a href="<?= site_url('guru/nilai/export' . (!empty($filterTugasId) ? '?tugas_id='.$filterTugasId : '')) ?>" class="px-4 py-2 rounded-xl bg-emerald-600 hover:bg-emerald-700 text-xs font-bold text-white transition inline-flex items-center gap-2">
        <i class="fa-solid fa-file-excel"></i>
        <span>Unduh File Excel / CSV</span>
      </a>
    </div>
    <button onclick="window.print()" class="px-5 py-2 bg-blue-600 hover:bg-blue-700 text-white text-xs font-bold rounded-xl shadow-sm transition inline-flex items-center gap-2">
      <i class="fa-solid fa-print"></i>
      <span>Cetak Dokumen / Simpan PDF</span>
    </button>
  </div>

  <!-- Kertas Laporan Nilai Resmi -->
  <div class="max-w-5xl mx-auto bg-white p-8 md:p-12 rounded-3xl shadow-sm border border-slate-200 print:border-none print:shadow-none print:p-0">
    <!-- Kop Surat -->
    <div class="border-b-2 border-slate-800 pb-4 mb-6 flex items-center gap-4">
      <div class="w-16 h-16 bg-blue-600 text-white rounded-2xl flex items-center justify-center text-3xl font-black shrink-0">
        <i class="fa-solid fa-graduation-cap"></i>
      </div>
      <div class="flex-1 text-center pr-16">
        <h3 class="text-xs font-extrabold uppercase tracking-widest text-slate-500">Kementerian Pendidikan, Kebudayaan, Riset, dan Teknologi</h3>
        <h1 class="text-xl font-black uppercase text-slate-900 tracking-wide mt-0.5">Room Learning SMP Terpadu</h1>
        <p class="text-xs text-slate-500 mt-0.5">Sistem Manajemen Pembelajaran Digital & Penilaian Kurikulum Merdeka</p>
      </div>
    </div>

    <!-- Judul Dokumen -->
    <div class="text-center mb-6">
      <h2 class="text-base font-extrabold uppercase tracking-wide text-slate-900 underline underline-offset-4">
        Rekapitulasi Daftar Nilai Hasil Belajar Siswa
      </h2>
      <p class="text-xs text-slate-500 mt-1">Tahun Ajaran <?= date('Y') ?>/<?= date('Y')+1 ?></p>
    </div>

    <!-- Info Mata Pelajaran & Guru -->
    <div class="grid grid-cols-2 gap-4 text-xs mb-6 bg-slate-50 p-4 rounded-2xl border border-slate-100 print:bg-transparent print:border print:p-3">
      <div class="space-y-1">
        <p><span class="font-bold text-slate-600 w-32 inline-block">Mata Pelajaran</span>: <strong class="text-slate-900"><?= esc($mapel) ?></strong></p>
        <p><span class="font-bold text-slate-600 w-32 inline-block">Guru Pengampu</span>: <?= esc($guru['nama'] ?? 'Guru Pengampu') ?></p>
        <p><span class="font-bold text-slate-600 w-32 inline-block">NIP / ID Guru</span>: <?= esc($guru['nis'] ?? '198501012020121001') ?></p>
      </div>
      <div class="space-y-1">
        <p><span class="font-bold text-slate-600 w-32 inline-block">Kelas Diajar</span>: <?= esc($guru['kelas_diajar'] ?? 'Semua Kelas') ?></p>
        <p><span class="font-bold text-slate-600 w-32 inline-block">Tanggal Cetak</span>: <?= date('d F Y') ?></p>
        <p><span class="font-bold text-slate-600 w-32 inline-block">Total Data Nilai</span>: <strong><?= count($rows) ?> Siswa</strong></p>
      </div>
    </div>

    <!-- Tabel Nilai Siswa -->
    <table class="w-full text-left text-xs border-collapse border border-slate-300 mb-6">
      <thead>
        <tr class="bg-slate-100 text-slate-700 font-extrabold text-[11px] uppercase tracking-wider">
          <th class="border border-slate-300 p-2.5 text-center w-10">No</th>
          <th class="border border-slate-300 p-2.5">Nama Siswa</th>
          <th class="border border-slate-300 p-2.5 text-center w-24">NIS</th>
          <th class="border border-slate-300 p-2.5 text-center w-20">Kelas</th>
          <th class="border border-slate-300 p-2.5">Judul Tugas</th>
          <th class="border border-slate-300 p-2.5 text-center w-20">Nilai</th>
          <th class="border border-slate-300 p-2.5 text-center w-24">Status</th>
          <th class="border border-slate-300 p-2.5">Catatan Evaluasi Guru</th>
        </tr>
      </thead>
      <tbody>
        <?php if (!empty($rows)): ?>
          <?php 
            $totalNilai = 0;
            $countDinilai = 0;
            $tuntas = 0;
            foreach ($rows as $r) {
                if ($r['nilai'] !== null) {
                    $totalNilai += $r['nilai'];
                    $countDinilai++;
                    if ($r['nilai'] >= 75) $tuntas++;
                }
            }
            $rataRata = $countDinilai > 0 ? round($totalNilai / $countDinilai, 1) : 0;
          ?>
          <?php foreach ($rows as $item): ?>
            <tr class="hover:bg-slate-50">
              <td class="border border-slate-300 p-2 text-center font-bold text-slate-600"><?= $item['no'] ?></td>
              <td class="border border-slate-300 p-2 font-bold text-slate-800"><?= esc($item['nama']) ?></td>
              <td class="border border-slate-300 p-2 text-center text-slate-600"><?= esc($item['nis']) ?></td>
              <td class="border border-slate-300 p-2 text-center font-semibold text-slate-700"><?= esc($item['kelas']) ?></td>
              <td class="border border-slate-300 p-2 text-slate-700"><?= esc($item['tugas']) ?></td>
              <td class="border border-slate-300 p-2 text-center font-black text-sm <?= ($item['nilai'] !== null && $item['nilai'] >= 75) ? 'text-emerald-700' : 'text-amber-700' ?>">
                <?= $item['nilai'] !== null ? $item['nilai'] : '<span class="text-xs text-slate-400 font-normal italic">Belum</span>' ?>
              </td>
              <td class="border border-slate-300 p-2 text-center">
                <span class="px-2 py-0.5 rounded text-[10px] font-bold <?= $item['status'] === 'dinilai' ? 'bg-emerald-100 text-emerald-800' : 'bg-amber-100 text-amber-800' ?>">
                  <?= ucfirst(esc($item['status'])) ?>
                </span>
              </td>
              <td class="border border-slate-300 p-2 text-slate-600 italic">
                <?= !empty($item['komentar']) ? esc($item['komentar']) : '-' ?>
              </td>
            </tr>
          <?php endforeach; ?>
        <?php else: ?>
          <tr>
            <td colspan="8" class="border border-slate-300 p-6 text-center text-slate-400 italic">
              Belum ada data tugas yang dikumpulkan siswa.
            </td>
          </tr>
        <?php endif; ?>
      </tbody>
    </table>

    <!-- Ringkasan Statistik Ketuntasan Nilai -->
    <?php if (!empty($rows) && isset($rataRata)): ?>
      <div class="grid grid-cols-3 gap-4 text-xs mb-8 p-3 rounded-xl border border-slate-200 bg-slate-50 print:bg-transparent">
        <div>
          <span class="text-slate-500 font-bold block">Rata-Rata Kelas:</span>
          <strong class="text-sm text-slate-900"><?= $rataRata ?> / 100</strong>
        </div>
        <div>
          <span class="text-slate-500 font-bold block">Ketuntasan Belajar (KKM 75):</span>
          <strong class="text-sm text-emerald-700"><?= $tuntas ?> dari <?= $countDinilai ?> Siswa Tuntas</strong>
        </div>
        <div>
          <span class="text-slate-500 font-bold block">Status Pengumpulan:</span>
          <strong class="text-sm text-blue-700"><?= count($rows) ?> Berkas Tugas Masuk</strong>
        </div>
      </div>
    <?php endif; ?>

    <!-- Tanda Tangan Pengesahan -->
    <div class="grid grid-cols-2 gap-8 text-xs pt-4">
      <div class="text-center">
        <p class="text-slate-500">Mengetahui,</p>
        <p class="font-bold text-slate-700">Kepala Sekolah SMP</p>
        <div class="h-20"></div>
        <p class="font-extrabold text-slate-900 underline uppercase">Drs. H. Mulyadi, M.Pd.</p>
        <p class="text-[11px] text-slate-400">NIP. 196805121994031005</p>
      </div>

      <div class="text-center">
        <p class="text-slate-500">Guru Mata Pelajaran,</p>
        <p class="font-bold text-slate-700"><?= esc($mapel) ?></p>
        <div class="h-20"></div>
        <p class="font-extrabold text-slate-900 underline uppercase"><?= esc($guru['nama'] ?? 'Guru Pengampu') ?></p>
        <p class="text-[11px] text-slate-400">NIP. <?= esc($guru['nis'] ?? '198501012020121001') ?></p>
      </div>
    </div>
  </div>
</body>
</html>
