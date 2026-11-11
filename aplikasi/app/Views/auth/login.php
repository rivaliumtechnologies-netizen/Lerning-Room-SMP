<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login - Room Learning SMP Negeri 1 Cijambe</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
  <style>
    body { font-family: 'Plus Jakarta Sans', sans-serif; }
    .bg-school-overlay {
      background-image: linear-gradient(135deg, rgba(15, 23, 42, 0.88) 0%, rgba(30, 41, 59, 0.78) 50%, rgba(15, 23, 42, 0.90) 100%), 
                        url('<?= base_url('assets/img/bg_smpn1cijambe.jpg') ?>');
      background-size: cover;
      background-position: center;
      background-repeat: no-repeat;
    }
    /* Proteksi visual panel login: selalu bersih, elegan, dan kontras tinggi */
    .login-card-right {
      background-color: #ffffff !important;
      color: #0f172a !important;
    }
    .login-input {
      background-color: #f8fafc !important;
      border-color: #e2e8f0 !important;
      color: #0f172a !important;
    }
    .login-input:focus {
      background-color: #ffffff !important;
      border-color: #0d9488 !important;
      box-shadow: 0 0 0 4px rgba(13, 148, 136, 0.15) !important;
    }
    .login-input::placeholder {
      color: #94a3b8 !important;
    }
    .login-label {
      color: #334155 !important;
    }
    .login-role-bg {
      background-color: #f1f5f9 !important;
      border-color: #e2e8f0 !important;
    }
  </style>

</head>
<body class="bg-school-overlay min-h-screen flex items-center justify-center p-4 sm:p-6 lg:p-10 relative">

  <!-- Floating subtle blur lights in background -->
  <div class="absolute top-10 left-10 w-72 h-72 bg-blue-500/15 rounded-full blur-3xl pointer-events-none"></div>
  <div class="absolute bottom-10 right-10 w-80 h-80 bg-teal-500/15 rounded-full blur-3xl pointer-events-none"></div>

  <!-- Main Login Card Container (Glassmorphic & Dual Panel) -->
  <div class="relative w-full max-w-4xl bg-white/95 backdrop-blur-xl rounded-3xl shadow-2xl overflow-hidden border border-white/40 grid grid-cols-1 lg:grid-cols-12">
    
    <!-- LEFT PANEL: School Branding & Portal Highlights (5 cols) -->
    <div class="lg:col-span-5 bg-gradient-to-br from-slate-900 via-blue-950 to-slate-900 text-white p-8 flex flex-col justify-between relative overflow-hidden">
      <!-- Background pattern -->
      <div class="absolute inset-0 opacity-10 bg-[radial-gradient(#38bdf8_1px,transparent_1px)] [background-size:16px_16px]"></div>
      
      <!-- Top Section -->
      <div class="relative z-10">
        <!-- School Tag -->
        <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-white/10 backdrop-blur-md border border-white/15 text-[11px] font-bold text-blue-200 mb-6">
          <i class="fa-solid fa-school text-teal-400"></i>
          <span>SMP NEGERI 1 CIJAMBE</span>
        </div>

        <!-- Title -->
        <h2 class="text-2xl font-black tracking-tight text-white leading-tight">
          Portal Pembelajaran Terpadu
        </h2>
        <p class="text-slate-300 text-xs mt-2 leading-relaxed font-normal">
          Platform digital interaktif untuk mendukung proses belajar mengajar, kolaborasi tugas, dan konsultasi kecerdasan buatan (Gemini AI).
        </p>

        <!-- Feature Points -->
        <div class="mt-8 space-y-3.5">
          <div class="flex items-center gap-3">
            <div class="w-8 h-8 rounded-xl bg-teal-500/20 text-teal-300 border border-teal-500/30 flex items-center justify-center text-xs shrink-0">
              <i class="fa-solid fa-robot"></i>
            </div>
            <div>
              <p class="text-xs font-bold text-slate-100 leading-none">Tanya Gemini AI</p>
              <p class="text-[10px] text-slate-400 mt-0.5">Asisten pintar pendamping belajar</p>
            </div>
          </div>

          <div class="flex items-center gap-3">
            <div class="w-8 h-8 rounded-xl bg-blue-500/20 text-blue-300 border border-blue-500/30 flex items-center justify-center text-xs shrink-0">
              <i class="fa-solid fa-book-open"></i>
            </div>
            <div>
              <p class="text-xs font-bold text-slate-100 leading-none">Materi & Modul Pelajaran</p>
              <p class="text-[10px] text-slate-400 mt-0.5">Akses materi kurikulum kapan saja</p>
            </div>
          </div>

          <div class="flex items-center gap-3">
            <div class="w-8 h-8 rounded-xl bg-emerald-500/20 text-emerald-300 border border-emerald-500/30 flex items-center justify-center text-xs shrink-0">
              <i class="fa-solid fa-clipboard-check"></i>
            </div>
            <div>
              <p class="text-xs font-bold text-slate-100 leading-none">Tugas & Nilai Terintegrasi</p>
              <p class="text-[10px] text-slate-400 mt-0.5">Pengumpulan dan evaluasi transparan</p>
            </div>
          </div>
        </div>
      </div>

      <!-- Bottom Motto -->
      <div class="relative z-10 pt-6 mt-6 border-t border-white/10">
        <p class="text-[11px] text-slate-400 italic">
          "Membentuk generasi yang cerdas, kreatif, mandiri, dan berakhlak mulia."
        </p>
      </div>
    </div>

    <!-- RIGHT PANEL: Login Form (7 cols) -->
    <div class="lg:col-span-7 login-card-right p-6 sm:p-8 md:p-10 flex flex-col justify-center">
      
      <!-- Brand Header -->
      <div class="flex items-center gap-3 mb-2">
        <div id="brandIcon" class="w-10 h-10 bg-teal-600 text-white rounded-2xl flex items-center justify-center font-black text-base shadow-md shadow-teal-500/20 transition-colors">
          <i class="fa-solid fa-graduation-cap"></i>
        </div>
        <div>
          <h1 class="text-lg font-black text-slate-900 leading-none">Room Learning</h1>
          <span class="text-[10px] font-bold text-teal-600 tracking-wider">SMP NEGERI 1 CIJAMBE</span>
        </div>
      </div>
      <p class="text-slate-500 text-xs mb-6 font-medium">Silakan masuk sesuai dengan peran akun Anda</p>

      <!-- Alert Flash Message -->
      <?php if (session()->getFlashdata('error')): ?>
        <div class="mb-4 rounded-2xl bg-rose-50 border border-rose-200 p-3 text-xs text-rose-700 font-semibold flex items-center gap-2">
          <i class="fa-solid fa-circle-exclamation text-rose-500"></i>
          <span><?= esc(session()->getFlashdata('error')) ?></span>
        </div>
      <?php endif; ?>

      <?php if (session()->getFlashdata('errors')): ?>
        <div class="mb-4 rounded-2xl bg-rose-50 border border-rose-200 p-3 text-xs text-rose-700 font-semibold space-y-1">
          <?php foreach (session()->getFlashdata('errors') as $err): ?>
            <p class="flex items-center gap-1.5"><i class="fa-solid fa-circle-exclamation text-rose-500 text-[10px]"></i> <?= esc($err) ?></p>
          <?php endforeach; ?>
        </div>
      <?php endif; ?>

      <!-- Role Selector Pills -->
      <div class="login-role-bg p-1.5 rounded-2xl flex mb-6 border gap-1">
        <button 
          type="button" 
          id="btn-siswa" 
          onclick="switchRole('siswa')" 
          class="flex-1 py-2 text-xs font-bold rounded-xl bg-teal-600 text-white shadow-sm transition-all flex items-center justify-center gap-1.5"
        >
          <i class="fa-solid fa-user-graduate text-[11px]"></i>
          <span>Siswa</span>
        </button>
        <button 
          type="button" 
          id="btn-guru" 
          onclick="switchRole('guru')" 
          class="flex-1 py-2 text-xs font-bold rounded-xl text-slate-600 hover:text-slate-900 transition-all flex items-center justify-center gap-1.5"
        >
          <i class="fa-solid fa-chalkboard-user text-[11px]"></i>
          <span>Guru</span>
        </button>
        <button 
          type="button" 
          id="btn-admin" 
          onclick="switchRole('admin')" 
          class="flex-1 py-2 text-xs font-bold rounded-xl text-slate-600 hover:text-slate-900 transition-all flex items-center justify-center gap-1.5"
        >
          <i class="fa-solid fa-shield-halved text-[11px]"></i>
          <span>Admin</span>
        </button>
      </div>

      <!-- Login Form -->
      <form action="<?= site_url('login') ?>" method="post" class="space-y-4">
        <?= csrf_field() ?>
        <input type="hidden" name="role" id="loginRole" value="siswa">

        <!-- Email Field -->
        <div>
          <label class="text-xs font-bold login-label block mb-1">Email Akun</label>
          <div class="relative">
            <i class="fa-regular fa-envelope absolute left-3.5 top-1/2 -translate-y-1/2 text-slate-400 text-xs"></i>
            <input 
              id="loginEmail" 
              name="email" 
              type="email" 
              required 
              placeholder="Masukkan email Anda" 
              class="w-full pl-9 pr-4 py-3 border rounded-2xl text-xs login-input transition"
            >
          </div>
        </div>

        <!-- Password Field -->
        <div>
          <label class="text-xs font-bold login-label block mb-1">Kata Sandi</label>
          <div class="relative">
            <i class="fa-solid fa-lock absolute left-3.5 top-1/2 -translate-y-1/2 text-slate-400 text-xs"></i>
            <input 
              id="loginPassword" 
              name="password" 
              type="password" 
              required 
              placeholder="Masukkan kata sandi" 
              class="w-full pl-9 pr-10 py-3 border rounded-2xl text-xs login-input transition"
            >
            <button 
              type="button" 
              onclick="togglePasswordVisibility()" 
              class="absolute right-3.5 top-1/2 -translate-y-1/2 text-slate-400 hover:text-slate-600 focus:outline-none"
              title="Lihat kata sandi"
            >
              <i id="passwordEyeIcon" class="fa-regular fa-eye text-xs"></i>
            </button>
          </div>
        </div>

        <!-- Submit Button -->
        <button 
          type="submit" 
          id="loginBtn" 
          class="w-full bg-teal-600 hover:bg-teal-700 text-white font-extrabold py-3.5 rounded-2xl text-xs shadow-md shadow-teal-500/20 transition-all flex items-center justify-center gap-2 mt-2"
        >
          <span>Masuk ke Sistem</span>
          <i class="fa-solid fa-arrow-right text-xs"></i>
        </button>
      </form>

    </div>

  </div>

  <script>
    function switchRole(role) {
      document.getElementById('loginRole').value = role;

      const btnSiswa = document.getElementById('btn-siswa');
      const btnGuru = document.getElementById('btn-guru');
      const btnAdmin = document.getElementById('btn-admin');
      const brandIcon = document.getElementById('brandIcon');
      const loginBtn = document.getElementById('loginBtn');
      const emailInput = document.getElementById('loginEmail');
      const passInput = document.getElementById('loginPassword');

      // Reset button styles
      const defaultBtnClass = 'flex-1 py-2 text-xs font-bold rounded-xl text-slate-600 hover:text-slate-900 transition-all flex items-center justify-center gap-1.5';
      btnSiswa.className = defaultBtnClass;
      btnGuru.className = defaultBtnClass;
      btnAdmin.className = defaultBtnClass;

      // Color themes per role
      if (role === 'siswa') {
        btnSiswa.className = 'flex-1 py-2 text-xs font-bold rounded-xl bg-teal-600 text-white shadow-sm transition-all flex items-center justify-center gap-1.5';
        brandIcon.className = 'w-10 h-10 bg-teal-600 text-white rounded-2xl flex items-center justify-center font-black text-base shadow-md shadow-teal-500/20 transition-colors';
        loginBtn.className = 'w-full bg-teal-600 hover:bg-teal-700 text-white font-extrabold py-3.5 rounded-2xl text-xs shadow-md shadow-teal-500/20 transition-all flex items-center justify-center gap-2 mt-2';
        emailInput.className = 'w-full pl-9 pr-4 py-3 border border-slate-200 rounded-2xl text-xs bg-slate-50/70 focus:outline-none focus:ring-2 focus:ring-teal-500/20 focus:border-teal-500 focus:bg-white transition';
        passInput.className = 'w-full pl-9 pr-10 py-3 border border-slate-200 rounded-2xl text-xs bg-slate-50/70 focus:outline-none focus:ring-2 focus:ring-teal-500/20 focus:border-teal-500 focus:bg-white transition';
      } else if (role === 'guru') {
        btnGuru.className = 'flex-1 py-2 text-xs font-bold rounded-xl bg-blue-600 text-white shadow-sm transition-all flex items-center justify-center gap-1.5';
        brandIcon.className = 'w-10 h-10 bg-blue-600 text-white rounded-2xl flex items-center justify-center font-black text-base shadow-md shadow-blue-500/20 transition-colors';
        loginBtn.className = 'w-full bg-blue-600 hover:bg-blue-700 text-white font-extrabold py-3.5 rounded-2xl text-xs shadow-md shadow-blue-500/20 transition-all flex items-center justify-center gap-2 mt-2';
        emailInput.className = 'w-full pl-9 pr-4 py-3 border border-slate-200 rounded-2xl text-xs bg-slate-50/70 focus:outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 focus:bg-white transition';
        passInput.className = 'w-full pl-9 pr-10 py-3 border border-slate-200 rounded-2xl text-xs bg-slate-50/70 focus:outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 focus:bg-white transition';
      } else {
        btnAdmin.className = 'flex-1 py-2 text-xs font-bold rounded-xl bg-indigo-600 text-white shadow-sm transition-all flex items-center justify-center gap-1.5';
        brandIcon.className = 'w-10 h-10 bg-indigo-600 text-white rounded-2xl flex items-center justify-center font-black text-base shadow-md shadow-indigo-500/20 transition-colors';
        loginBtn.className = 'w-full bg-indigo-600 hover:bg-indigo-700 text-white font-extrabold py-3.5 rounded-2xl text-xs shadow-md shadow-indigo-500/20 transition-all flex items-center justify-center gap-2 mt-2';
        emailInput.className = 'w-full pl-9 pr-4 py-3 border border-slate-200 rounded-2xl text-xs bg-slate-50/70 focus:outline-none focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500 focus:bg-white transition';
        passInput.className = 'w-full pl-9 pr-10 py-3 border border-slate-200 rounded-2xl text-xs bg-slate-50/70 focus:outline-none focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500 focus:bg-white transition';
      }
    }

    function togglePasswordVisibility() {
      const passInput = document.getElementById('loginPassword');
      const eyeIcon = document.getElementById('passwordEyeIcon');
      if (passInput.type === 'password') {
        passInput.type = 'text';
        eyeIcon.className = 'fa-regular fa-eye-slash text-xs text-slate-600';
      } else {
        passInput.type = 'password';
        eyeIcon.className = 'fa-regular fa-eye text-xs text-slate-400';
      }
    }
  </script>
</body>
</html>
