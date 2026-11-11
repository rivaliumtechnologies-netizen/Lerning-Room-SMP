# Learning Room SMP 🎓

Aplikasi E-Learning interaktif untuk SMP berbasis **CodeIgniter 4**, dilengkapi integrasi AI Google Gemini, manajemen materi, tugas online, dan profil pengguna.

---

## 📁 Struktur Direktori Proyek

Proyek ini telah dirapikan ke dalam struktur yang terorganisir:

```text
Lerning Room SMP/
│
├── 📂 aplikasi/               # Source code utama aplikasi CodeIgniter 4
│   ├── app/                   # Controllers, Models, Views, Config, Filters
│   ├── public/                # Web root (index.php, uploads, aset)
│   │   └── uploads/           # Folder penyimpanan file tugas siswa
│   ├── system/                # Core framework CodeIgniter 4
│   ├── writable/              # Cache, logs, sessions, data sementara
│   ├── .env                   # File konfigurasi environment & database
│   ├── composer.json          # Dependency PHP
│   └── spark                  # CLI tool CodeIgniter
│
├── 📂 database/               # File database MySQL siap pakai
│   └── database.sql           # Schema tabel + data awal (users, materi, tugas, dll.)
│
├── 📂 prototipe_desain/       # Kumpulan template / mockup HTML statis awal
│   ├── admin/                 # Mockup tampilan dashboard admin
│   ├── guru/                  # Mockup dashboard guru & kelola materi/tugas
│   ├── siswa/                 # Mockup dashboard siswa & pengerjaan tugas
│   ├── pages/                 # Mockup halaman login & tampilan Gemini AI
│   └── archive/               # Arsip file mockup versi sebelumnya
│
├── 📂 docs/                   # Dokumentasi teknis proyek
│   └── TODO.md                # Log pengerjaan & checklist fitur skripsi
│
└── 📄 README.md               # Petunjuk penggunaan proyek (file ini)
```

---

## 🚀 Cara Menjalankan Aplikasi

### 1. Prasyarat
- **PHP** >= 8.2 (dengan ekstensi `mysqli`, `curl`, `intl`, `mbstring`)
- **MySQL / MariaDB** (bisa via XAMPP)
- **Web Browser** (Chrome / Edge / Firefox)

### 2. Persiapan Database
1. Buka **XAMPP Control Panel**, lalu start **Apache** dan **MySQL**.
2. Buka browser ke **phpMyAdmin**: `http://localhost/phpmyadmin`
3. Buat database baru bernama: `room_learning_smp`
4. Klik tab **Import**, pilih file:
   `database/database.sql`
5. Klik **Go / Kirim** hingga import selesai.

### 3. Konfigurasi `.env`
Konfigurasi database berada di file `aplikasi/.env`:
```ini
database.default.hostname = localhost
database.default.database = room_learning_smp
database.default.username = root
database.default.password = 
database.default.port = 3306

# API Key Google Gemini (opsional, untuk fitur chat AI)
gemini.api_key = 'YOUR_GEMINI_API_KEY'
```

### 4. Menjalankan Server Lokal
Buka Command Prompt atau PowerShell di folder proyek ini:

```bash
# Masuk ke folder aplikasi
cd aplikasi

# Jalankan server bawaan CodeIgniter
php spark serve
```

Aplikasi dapat diakses melalui browser di:
👉 **`http://localhost:8080`**

---

## 🔑 Akun Demo Pengguna

| Role | Email | Password | Hak Akses |
| :--- | :--- | :--- | :--- |
| **Admin** | `admin@roomlearning.sch.id` | `admin123` | Manajemen pengguna, tambah user, reset password, export data |
| **Guru** | `guru@roomlearning.sch.id` | `guru123` | Kelola materi belajar, buat tugas, beri nilai siswa, konsultasi Gemini AI, edit profil |
| **Siswa** | `siswa@roomlearning.sch.id` | `siswa123` | Baca materi, kumpulkan tugas (upload file), konsultasi Gemini AI, edit profil |

---

## 🎨 Prototipe Desain HTML

Jika ingin melihat rancangan desain statis (HTML/Tailwind CSS) sebelum diintegrasikan ke CodeIgniter:
- Buka folder `prototipe_desain/`
- Buka file `prototipe_desain/pages/index.html` langsung di browser dengan klik ganda.
