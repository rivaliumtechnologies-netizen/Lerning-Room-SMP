<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Nilai Tugas - Guru</title>
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
        <a href="<?= site_url('guru/nilai') ?>" class="flex items-center gap-3 px-3 py-2.5 rounded-xl bg-blue-50 text-blue-600 font-bold text-xs"><i class="fa-regular fa-award w-4"></i><span>Nilai</span></a>
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
        <h1 class="text-xl font-bold text-slate-800">Nilai & Pengumpulan Tugas Siswa</h1>
        <p class="text-xs text-slate-400 mt-0.5">Periksa, beri penilaian, serta unduh atau cetak rekap daftar nilai siswa untuk rapor dan administrasi.</p>
      </div>
      <div class="flex flex-wrap items-center gap-2">
        <a href="<?= site_url('guru/nilai/export' . (!empty($filterTugasId) ? '?tugas_id='.$filterTugasId : '') . (!empty($filterKelas) ? '&kelas='.$filterKelas : '')) ?>" class="inline-flex items-center gap-2 px-4 py-2.5 bg-emerald-600 hover:bg-emerald-700 text-white rounded-xl text-xs font-bold shadow-sm transition">
          <i class="fa-solid fa-file-excel"></i>
          <span>Unduh Rekap Nilai (Excel/CSV)</span>
        </a>
        <a href="<?= site_url('guru/nilai/cetak' . (!empty($filterTugasId) ? '?tugas_id='.$filterTugasId : '') . (!empty($filterKelas) ? '&kelas='.$filterKelas : '')) ?>" target="_blank" class="inline-flex items-center gap-2 px-4 py-2.5 bg-blue-600 hover:bg-blue-700 text-white rounded-xl text-xs font-bold shadow-sm transition">
          <i class="fa-solid fa-print"></i>
          <span>Cetak Rekap Nilai</span>
        </a>
      </div>
    </div>

    <!-- Filter Bar Tugas & Kelas -->
    <div class="bg-white p-4 rounded-2xl border border-slate-100 shadow-sm mb-6">
      <form action="<?= site_url('guru/nilai') ?>" method="get" class="flex flex-col md:flex-row md:items-center justify-between gap-3">
        <div class="flex flex-wrap items-center gap-3">
          <!-- Filter Tugas -->
          <div>
            <label class="block text-[10px] font-bold uppercase text-slate-400 mb-1">Filter Tugas</label>
            <select name="tugas_id" onchange="this.form.submit()" class="bg-slate-50 border border-slate-200 rounded-xl px-3 py-1.5 text-xs text-slate-700 font-semibold focus:bg-white focus:outline-none">
              <option value="">-- Semua Tugas --</option>
              <?php if (!empty($tugasList)): ?>
                <?php foreach ($tugasList as $t): ?>
                  <option value="<?= esc($t['id']) ?>" <?= ($filterTugasId == $t['id']) ? 'selected' : '' ?>>
                    <?= esc($t['judul']) ?> (<?= esc($t['kelas'] ?? 'Semua') ?>)
                  </option>
                <?php endforeach; ?>
              <?php endif; ?>
            </select>
          </div>

          <!-- Filter Kelas -->
          <div>
            <label class="block text-[10px] font-bold uppercase text-slate-400 mb-1">Filter Kelas</label>
            <select name="kelas" onchange="this.form.submit()" class="bg-slate-50 border border-slate-200 rounded-xl px-3 py-1.5 text-xs text-slate-700 font-semibold focus:bg-white focus:outline-none">
              <option value="">-- Semua Tingkatan --</option>
              <option value="VII" <?= ($filterKelas === 'VII') ? 'selected' : '' ?>>Kelas 7 (VII)</option>
              <option value="VIII" <?= ($filterKelas === 'VIII') ? 'selected' : '' ?>>Kelas 8 (VIII)</option>
              <option value="IX" <?= ($filterKelas === 'IX') ? 'selected' : '' ?>>Kelas 9 (IX)</option>
            </select>
          </div>

          <?php if (!empty($filterTugasId) || !empty($filterKelas)): ?>
            <div class="pt-4">
              <a href="<?= site_url('guru/nilai') ?>" class="text-xs text-red-500 hover:text-red-700 font-bold inline-flex items-center gap-1">
                <i class="fa-solid fa-rotate-left"></i>
                <span>Reset Filter</span>
              </a>
            </div>
          <?php endif; ?>
        </div>

        <div class="pt-4 md:pt-0">
          <input type="text" id="filterSiswaInput" onkeyup="filterSubmissionTable()" placeholder="Cari nama siswa atau NIS..." class="w-full md:w-60 bg-slate-50 border border-slate-200 rounded-xl px-3.5 py-1.5 text-xs text-slate-800 focus:bg-white focus:outline-none focus:ring-2 focus:ring-blue-500">
        </div>
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
      <div class="overflow-x-auto">
        <table class="w-full text-left text-xs">
          <thead class="bg-slate-50 text-slate-400 font-bold border-b border-slate-100 uppercase tracking-wider text-[10px]">
            <tr>
              <th class="p-4">Tugas & Target</th>
              <th class="p-4">Siswa (NIS & Kelas)</th>
              <th class="p-4">File Pengumpulan</th>
              <th class="p-4">Status & Waktu</th>
              <th class="p-4">Nilai</th>
              <th class="p-4">Aksi Penilaian</th>
            </tr>
          </thead>
          <tbody class="divide-y divide-slate-100">
            <?php if (empty($submissions)): ?>
              <tr>
                <td colspan="6" class="p-8 text-center text-slate-400">
                  <div class="w-12 h-12 bg-slate-100 text-slate-400 rounded-full flex items-center justify-center mx-auto mb-2 text-lg">
                    <i class="fa-regular fa-folder-open"></i>
                  </div>
                  <p class="font-semibold text-slate-500">Belum ada pengumpulan tugas dari siswa.</p>
                </td>
              </tr>
            <?php else: ?>
              <?php foreach ($submissions as $sub): ?>
                <?php
                  $fileName = $sub['file'] ?? '';
                  $ext = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
                  $isPdf = ($ext === 'pdf');
                  $isImage = in_array($ext, ['jpg', 'jpeg', 'png', 'gif', 'webp']);
                  $canPreview = ($isPdf || $isImage);
                  $viewUrl = site_url('guru/nilai/view/' . rawurlencode($fileName));
                  $downloadUrl = site_url('guru/nilai/download/' . rawurlencode($fileName));
                ?>
                <tr class="hover:bg-slate-50/60 transition submission-row">
                  <td class="p-4 align-top">
                    <div class="font-bold text-slate-800"><?= esc($sub['tugas_judul']) ?></div>
                    <div class="flex items-center gap-1.5 mt-1">
                      <span class="px-2 py-0.5 rounded text-[10px] font-extrabold bg-blue-50 text-blue-700">
                        <?= esc($sub['tugas_kelas'] ?? 'Semua') ?>
                      </span>
                      <span class="text-[10px] text-slate-400 flex items-center gap-1">
                        <i class="fa-regular fa-clock"></i> <?= esc($sub['tugas_deadline'] ?: '-') ?>
                      </span>
                    </div>
                  </td>
                  <td class="p-4 align-top">
                    <div class="font-bold text-slate-800"><?= esc($sub['siswa_nama']) ?></div>
                    <div class="flex items-center gap-1.5 mt-0.5 text-[11px] text-slate-500">
                      <span class="font-semibold text-slate-600">NIS: <?= esc($sub['siswa_nis'] ?? '-') ?></span>
                      •
                      <span class="px-1.5 py-0.5 rounded text-[10px] font-extrabold bg-slate-100 text-slate-700">Kelas <?= esc($sub['siswa_kelas'] ?? '-') ?></span>
                    </div>
                    <?php if (!empty($sub['komentar']) && $sub['status'] === 'dikumpulkan'): ?>
                      <div class="text-[10px] text-slate-400 mt-1 italic">"<?= esc($sub['komentar']) ?>"</div>
                    <?php endif; ?>
                  </td>
                  <td class="p-4 align-top">
                    <?php if (!empty($fileName)): ?>
                      <div class="flex flex-col gap-1.5">
                        <div class="flex items-center gap-1.5">
                          <span class="inline-flex items-center gap-1 px-2 py-0.5 rounded text-[10px] font-bold uppercase <?= $isPdf ? 'bg-rose-50 text-rose-600 border border-rose-200' : ($isImage ? 'bg-emerald-50 text-emerald-600 border border-emerald-200' : 'bg-blue-50 text-blue-600 border border-blue-200') ?>">
                            <i class="<?= $isPdf ? 'fa-regular fa-file-pdf' : ($isImage ? 'fa-regular fa-file-image' : 'fa-regular fa-file-word') ?>"></i>
                            <?= esc($ext ?: 'FILE') ?>
                          </span>
                          <span class="text-[11px] text-slate-500 truncate max-w-[140px]" title="<?= esc($fileName) ?>">
                            <?= esc($fileName) ?>
                          </span>
                        </div>
                        <div class="flex items-center gap-2 pt-0.5">
                          <?php if ($canPreview): ?>
                            <button type="button"
                              onclick="openPreview('<?= $viewUrl ?>', '<?= esc($fileName, 'js') ?>', '<?= $ext ?>')"
                              class="inline-flex items-center gap-1.5 bg-blue-50 hover:bg-blue-100 text-blue-600 px-2.5 py-1.5 rounded-lg text-[11px] font-bold transition">
                              <i class="fa-regular fa-eye"></i> Lihat File
                            </button>
                          <?php else: ?>
                            <a href="<?= $downloadUrl ?>"
                              class="inline-flex items-center gap-1.5 bg-slate-100 hover:bg-slate-200 text-slate-600 px-2.5 py-1.5 rounded-lg text-[11px] font-bold transition" title="Format ini tidak bisa dipratinjau langsung di browser">
                              <i class="fa-solid fa-file-arrow-down"></i> Buka / Download
                            </a>
                          <?php endif; ?>
                          <a href="<?= $downloadUrl ?>"
                            class="inline-flex items-center gap-1.5 bg-slate-50 hover:bg-slate-100 border border-slate-200 text-slate-700 px-2.5 py-1.5 rounded-lg text-[11px] font-bold transition">
                            <i class="fa-solid fa-download"></i> Download
                          </a>
                        </div>
                      </div>
                    <?php else: ?>
                      <span class="text-slate-400 italic text-[11px]">Tidak ada file</span>
                    <?php endif; ?>
                  </td>
                  <td class="p-4 align-top">
                    <?php if ($sub['status'] === 'dinilai'): ?>
                      <span class="inline-flex items-center gap-1 bg-emerald-50 text-emerald-600 border border-emerald-200 px-2.5 py-1 rounded-full text-[10px] font-bold">
                        <i class="fa-solid fa-check"></i> Dinilai
                      </span>
                    <?php else: ?>
                      <span class="inline-flex items-center gap-1 bg-amber-50 text-amber-600 border border-amber-200 px-2.5 py-1 rounded-full text-[10px] font-bold">
                        <i class="fa-solid fa-clock-rotate-left"></i> Dikumpulkan
                      </span>
                    <?php endif; ?>
                    <div class="text-[10px] text-slate-400 mt-1">
                      <?= !empty($sub['created_at']) ? date('d M Y, H:i', strtotime($sub['created_at'])) : '-' ?>
                    </div>
                  </td>
                  <td class="p-4 align-top font-bold text-sm <?= $sub['nilai'] !== null ? 'text-blue-600' : 'text-slate-300' ?>">
                    <?= $sub['nilai'] !== null ? esc($sub['nilai']) : '-' ?>
                  </td>
                  <td class="p-4 align-top">
                    <form action="<?= site_url('guru/nilai/save') ?>" method="post" class="flex flex-col gap-2">
                      <?= csrf_field() ?>
                      <input type="hidden" name="pengumpulan_id" value="<?= esc($sub['id']) ?>">
                      <div class="flex items-center gap-2">
                        <input type="number" name="nilai" min="0" max="100" required placeholder="0-100" value="<?= esc($sub['nilai'] !== null ? $sub['nilai'] : '') ?>" class="rounded-xl border border-slate-200 px-2.5 py-1.5 text-xs w-20 focus:outline-none focus:border-blue-500 font-semibold" title="Masukkan nilai 0-100">
                        <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold px-3 py-1.5 rounded-xl text-xs shadow-sm transition">
                          Simpan
                        </button>
                      </div>
                      <input type="text" name="komentar" placeholder="Catatan/feedback untuk siswa..." value="<?= esc($sub['komentar'] ?? '') ?>" class="rounded-xl border border-slate-200 px-2.5 py-1.5 text-xs w-full focus:outline-none focus:border-blue-500">
                    </form>
                  </td>
                </tr>
              <?php endforeach; ?>
            <?php endif; ?>
          </tbody>
        </table>
      </div>
    </div>
  </main>

  <!-- Modal Preview File -->
  <div id="previewModal" class="fixed inset-0 bg-slate-900/60 backdrop-blur-sm z-50 hidden flex items-center justify-center p-4">
    <div class="bg-white w-full max-w-5xl h-[88vh] rounded-3xl shadow-2xl flex flex-col overflow-hidden animate-in fade-in zoom-in-95 duration-150">
      <div class="px-6 py-4 border-b border-slate-100 flex items-center justify-between bg-slate-50">
        <div class="flex items-center gap-3">
          <div class="w-8 h-8 rounded-xl bg-blue-100 text-blue-600 flex items-center justify-center font-bold text-sm">
            <i class="fa-regular fa-file-lines"></i>
          </div>
          <div>
            <h3 id="modalFileName" class="text-sm font-bold text-slate-800 truncate max-w-md">Nama File</h3>
            <p class="text-[11px] text-slate-400">Pratinjau Tugas Siswa</p>
          </div>
        </div>
        <div class="flex items-center gap-2">
          <a id="modalDownloadBtn" href="#" class="inline-flex items-center gap-1.5 bg-blue-600 hover:bg-blue-700 text-white px-3 py-2 rounded-xl text-xs font-bold transition shadow-sm">
            <i class="fa-solid fa-download"></i> Download File
          </a>
          <a id="modalOpenTabBtn" href="#" target="_blank" class="inline-flex items-center gap-1.5 bg-white hover:bg-slate-100 border border-slate-200 text-slate-700 px-3 py-2 rounded-xl text-xs font-bold transition">
            <i class="fa-solid fa-arrow-up-right-from-square"></i> Tab Baru
          </a>
          <button type="button" onclick="closePreview()" class="w-8 h-8 rounded-xl bg-slate-100 hover:bg-slate-200 text-slate-500 hover:text-slate-800 flex items-center justify-center font-bold text-sm transition">
            <i class="fa-solid fa-xmark"></i>
          </button>
        </div>
      </div>
      <div id="previewContainer" class="flex-1 bg-slate-100 flex items-center justify-center overflow-hidden">
        <!-- Content injected dynamically: iframe or img -->
      </div>
    </div>
  </div>

  <script>
    function openPreview(url, fileName, ext) {
      const modal = document.getElementById('previewModal');
      const container = document.getElementById('previewContainer');
      const fileNameEl = document.getElementById('modalFileName');
      const downloadBtn = document.getElementById('modalDownloadBtn');
      const openTabBtn = document.getElementById('modalOpenTabBtn');

      fileNameEl.textContent = fileName;
      downloadBtn.href = url.replace('/nilai/view/', '/nilai/download/');
      openTabBtn.href = url;

      container.innerHTML = '';

      if (['jpg', 'jpeg', 'png', 'gif', 'webp'].includes(ext)) {
        const img = document.createElement('img');
        img.src = url;
        img.className = 'max-h-full max-w-full object-contain p-4 rounded-xl';
        img.alt = fileName;
        container.appendChild(img);
      } else {
        const iframe = document.createElement('iframe');
        iframe.src = url;
        iframe.className = 'w-full h-full border-0';
        container.appendChild(iframe);
      }

      modal.classList.remove('hidden');
    }

    function closePreview() {
      const modal = document.getElementById('previewModal');
      const container = document.getElementById('previewContainer');
      container.innerHTML = '';
      modal.classList.add('hidden');
    }

    // Close on Escape key
    document.addEventListener('keydown', function (e) {
      if (e.key === 'Escape') {
        closePreview();
      }
    });

    // Close on clicking backdrop
    document.getElementById('previewModal').addEventListener('click', function (e) {
      if (e.target === this) {
        closePreview();
      }
    });

    function filterSubmissionTable() {
      const input = document.getElementById('filterSiswaInput');
      const filter = input.value.toLowerCase();
      const rows = document.querySelectorAll('.submission-row');

      rows.forEach(function (row) {
        const text = row.textContent || row.innerText;
        if (text.toLowerCase().indexOf(filter) > -1) {
          row.style.display = '';
        } else {
          row.style.display = 'none';
        }
      });
    }
  </script>
</body>
</html>

