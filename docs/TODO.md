# TODO - Room Learning SMP (CI4)

## 1. Konfigurasi & Environment
- [x] Buat `.env` (DB MySQL `room_learning_smp`, root, baseURL, API key Gemini)
- [x] Update `app/Config/Database.php` (default DB credentials)
- [x] Set `indexPage = ''` di `app/Config/App.php` (clean URL)

## 2. Database
- [x] Buat migration `CreateTables` (users, materi, tugas, pengumpulan, chat_ai)
- [x] Buat seeder `UserSeeder` (akun admin, guru, siswa)
- [x] Buat `database.sql` untuk import phpMyAdmin

## 3. Routing & Security
- [x] Tulis ulang `app/Config/Routes.php` (login/logout + grup terproteksi)
- [x] Daftarkan `AuthFilter` & `RoleFilter` di `app/Config/Filters.php`
- [x] Aktifkan CSRF global

## 4. Controllers
- [x] `Home.php` → redirect ke login/dashboard
- [x] `Auth.php` → perbaiki minor
- [x] `Admin.php` → stats + kelola user (list, tambah, ubah password, hapus, export CSV)
- [x] `Guru.php` → materi & tugas CRUD + halaman nilai
- [x] `Siswa.php` → materi, tugas, submit tugas (upload file)
- [x] `Gemini.php` → tetap (endpoint ask + simpan riwayat)

## 5. Models
- [x] Tambah method yang dibutuhkan di UserModel, MateriModel, TugasModel, PengumpulanModel

## 6. Views
- [x] `auth/login.php` (sudah ok, minor)
- [x] `admin/dashboard.php` (panel lengkap)
- [x] `admin/users.php` (kelola user lengkap)
- [x] `guru/dashboard.php`, `guru/materi.php`, `guru/tugas.php`, `guru/nilai.php` (baru)
- [x] `siswa/dashboard.php`, `siswa/materi.php`, `siswa/tugas.php` (tambah upload)
- [x] `gemini/index.php`

## 7. Lainnya
- [x] Buat folder `public/uploads/` + `.htaccess`
- [x] Cek syntax PHP semua file

## 8. Fitur Profil Guru & Siswa (Baru)
- [x] Tambah kolom `mapel` & `kelas_diajar` di tabel users (`_add_columns.php`)
- [x] `UserModel` → tambah `mapel`, `kelas_diajar` ke allowedFields
- [x] `Guru::profil()` & `Guru::updateProfil()` controller
- [x] `Siswa::profil()` & `Siswa::updateProfil()` controller
- [x] Route `/guru/profil` (GET + POST) & `/siswa/profil` (GET + POST)
- [x] View `guru/profil.php` (nama, email, mapel, kelas_diajar)
- [x] View `siswa/profil.php` (nama, email, NIS, kelas)
- [x] Menu "Profil" di sidebar semua halaman guru & siswa
- [x] Cek syntax PHP semua file OK

## 9. Verifikasi Akhir (Selesai)
- [x] MySQL aktif & database `room_learning_smp` ter-scan (tabel chat_ai, materi, pengumpulan, tugas, users)
- [x] `php spark serve` berjalan di port 8080
- [x] Halaman `/login` tampil (HTTP 200)
- [x] Login admin → `/admin/dashboard` (HTTP 200)
- [x] Login guru → `/guru/dashboard` (HTTP 200)
- [x] Login siswa → `/siswa/dashboard` (HTTP 200)
- [x] CSRF global aktif untuk semua form POST
- [x] Filter auth + role aktif (admin/guru/siswa)
- [x] File diagnostik sementara dibersihkan (check_db.php, _diag.php, check_users.php, dll.)

## 10. Perapihan Struktur Folder & File
- [x] Satukan file prototype mockup HTML (admin, guru, siswa, pages, archive) ke `prototipe_desain/`
- [x] Pindahkan dan amankan `database.sql` ke folder `database/`
- [x] Ubah folder utama aplikasi CodeIgniter dari `codeigniter4-CodeIgniter4-2bd0f01` menjadi `aplikasi/`
- [x] Bersihkan file script sementara (`_add_columns.php`, `_diag2.php`)
- [x] Perbaiki duplikasi syntax dan error login di `app/Controllers/Auth.php`
- [x] Buat file panduan `README.md` di root dan dokumentasi di `docs/`
## 11. Fitur Interaksi Gemini AI Side-Panel di Materi Siswa (Baru)
- [x] Tambah panel samping Gemini AI di sisi kanan halaman `siswa/materi.php` (sesuai contoh referensi)
- [x] Tambah tombol icon AI di topbar dan pada setiap baris materi ("Tanya AI")
- [x] Tambah greeting dinamis ("Hello, Rival / How can I help you today?"), quick prompt chips, dan disclaimer
- [x] Tambah chip konteks materi aktif ("Konteks: [Judul Materi]")
- [x] Tambah parser Markdown (`marked.js`) agar output jawaban AI tampil rapi
- [x] Update controller `Gemini::ask()` dengan dukungan parameter `context`, peremajaan token CSRF dinamis, dan mode demo interaktif

## 12. Langkah Menjalankan Aplikasi
1. Buka XAMPP dan pastikan Apache & MySQL berjalan.
2. Import file database `database/database.sql` ke database MySQL `room_learning_smp`.
3. Buka terminal, masuk ke folder aplikasi:
   ```bash
   cd aplikasi
   php spark serve
   ```
4. Buka browser: `http://localhost:8080`
5. Login dengan akun demo:
   - **Admin**: `admin@roomlearning.sch.id` / `admin123`
   - **Guru**: `guru@roomlearning.sch.id` / `guru123`
   - **Siswa**: `siswa@roomlearning.sch.id` / `siswa123`


