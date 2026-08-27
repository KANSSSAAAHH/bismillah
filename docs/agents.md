# AGENTS — LOOPIN

Dokumen ini mendefinisikan peran agent kerja dan status eksekusi untuk project **LOOPIN**.

## 1. Tujuan Produk

**LOOPIN** adalah platform circular economy untuk perlengkapan sekolah (donasi, barter, dan distribusi barang layak pakai). Target utama: siswa, sekolah, dan orang tua.

## 2. Daftar Agent dan Tanggung Jawab

### Product Agent
- Menjaga scope fitur sesuai dokumen utama: landing page, autentikasi, dashboard katalog, CRUD barang, pencarian/filter, validasi, desain responsif.
- Menentukan prioritas sprint dan acceptance criteria (acuan: `PRD.md`).

### Frontend Agent
- Membangun antarmuka **Blade + Tailwind**.
- Alur halaman: landing → login/register → dashboard → katalog → detail barang → form CRUD → profil.
- Menjamin responsible behavior desktop/mobile; polish aksesibilitas.
- Referensi: `frontend.md`.

### Backend Agent
- Implementasi domain model, controller, service, policy, and validasi server.
- Autentikasi, sesi, dan state transaksi.
- Integritas data: pengguna, barang, transaksi, permintaan_barang, notifikasi.
- Referensi: `backend.md`.

### QA Agent
- Menulis test feature/unit untuk route, auth, CRUD, filter, dan transaksi.
- Membuat regression checklist sebelum release.

### DevOps Agent
- Menjaga environment, build, dan deployment.
- Konfigurasi produksi (APP_ENV, database, queue, storage symlink, cache).

## 3. Status Eksekusi Saat Ini (Verifikasi Runtime)

### Sudah Dikerjakan
- [x] Bootstrap project **Laravel 12** aktif.
- [x] Konfigurasi Vite + Tailwind tersedia.
- [x] Database **MySQL `loopin`** tersambung; seluruh migrasi dijalankan.
- [x] Tabel domain LOOPIN termigrasi: pengguna, barang, transaksi, permintaan_barang, notifikasi (+ users, sessions, cache, jobs).
- [x] Routing utama aktif & terhubung ke controller.
- [x] Model awal domain dibuat (Pengguna, Barang).
- [x] Controller inti dibuat (Dashboard, Auth, Item, Request, Impact, Profile).
- [x] View inti tersedia (dashboard, login, katalog, detail, create/edit, barang saya, impact, requests, profile).
- [x] CRUD barang dasar + update status + hapus berfungsi.
- [x] Pencarian & filter kategori dasar aktif di katalog.
- [x] Web server merespons HTTP 200 (aplikasi dapat dijalankan).

### Sedang Berjalan (Parsial)
- [~] Autentikasi berbasis session custom, belum guard auth standar Laravel.
- [~] Modul requests/notifikasi masih struktur awal.

### Belum Lengkap
- [ ] Registrasi pengguna dari UI.
- [ ] Upload foto berbasis file storage (masih URL string).
- [ ] Notifikasi fungsional.
- [ ] Test coverage untuk fitur utama.

## 4. Gap Kritis yang Wajib Ditutup Dulu

1. Registrasi pengguna untuk onboarding akun baru.
2. Policy/middleware formal untuk hardening otorisasi.
3. Alur permintaan barang, transaksi, notifikasi end-to-end.
4. Automatik test untuk regression.

## 5. Prioritas 2 Sprint Berikutnya

### Sprint 1 (Core Functional)
- Implementasi register + integrasi auth standar Laravel.
- Ganti input foto menjadi upload file ke storage/public.
- Tambahkan policy & middleware pada route sensitif.
- Validasi berdasarkan Form Request.

### Sprint 2 (Completeness)
- Tambahkan pencarian/filter kategori lengkap.
- Implementasi permintaan barang dan notifikasi sederhana.
- Tambah test feature untuk auth dan CRUD.
- Perpecat UI & brand final LOOP.

## 6. Cara Menjalankan / Verifikasi Runtime

```bash
# 1. Pastikan MySQL Laragon aktif di port 3306 (database `loopin` sudah ada).
# 2. Konfigurasi .env sudah MySQL:
#    DB_CONNECTION=mysql / DB_HOST=127.0.0.1 / DB_PORT=3306
#    DB_DATABASE=loopin / DB_USERNAME=root / DB_PASSWORD=
# 3. Jalankan migrasi (sudah dijalankan):
php artisan migrate
# 4. Jalankan web server:
php artisan serve
# 5. Akses: http://127.0.0.1:8000
```