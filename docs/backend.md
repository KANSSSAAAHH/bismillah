# BACKEND — LOOP (Database & Logika)

Dokumen status implementasi backend **LOOPIN**: data, logika, auth, dan konfigurasi.

## 1. Stack & Konfigurasi

- Framework: **Laravel 12**, PHP 8.2.
- Database: **MySQL 8.4.3** (Laragon), nama database: `loopin`.
- Kredensial lokal: host `127.0.0.1`, port `3306`, user `root`, password kosong.
- Driver default sudah `mysql` (bukan sqlite).
- Session/cache/queue diset ke database.

### Konfigurasi `.env` (relevan)

```dotenv
APP_NAME=LOOPIN
APP_ENV=local
APP_DEBUG=true
APP_URL=http://localhost

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=loopin
DB_USERNAME=root
DB_PASSWORD=

SESSION_DRIVER=database
QUEUE_CONNECTION=database
CACHE_STORE=database
FILESYSTEM_DISK=local
```

## 2. Skema Database (dari migration)

Tabel sudah termigrasi ke database MySQL `loopin`:

| Tabel | Keterangan |
|-------|------------|
| `pengguna` | Pengguna custom domain LOOPIN. |
| `barang` | Barang daur ulang. |
| `transaksi` | Transaksi barang. |
| `permintaan_barang` | Permintaan barang (request). |
| `notifikasi` | Notifikasi pengguna. |
| `users` | User bawa aan Laravel (cadangan). |
| `sessions` | Sesi pengguna. |
| `cache` / `cache_locks` | Cache. |
| `jobs` / `job_batches` / `failed_jobs` | Queue. |
| `password_reset_tokens` | Reset password. |

Migration files di `database/migrations`:

```text
0001_01_01_000000_create_users_table.php
0001_01_01_000001_create_cache_table.php
0001_01_01_000002_create_jobs_table.php
2026_08_21_144332_create_pengguna_table.php
2026_08_21_144337_create_barang_table.php
2026_08_21_144342_create_transaksi_table.php
2026_08_21_144348_create_permintaan_barang_table.php
2026_08_21_144354_create_notifikasi_table.php
```

Semua migrasi sudah dijalankan (batch 1) — verifikasi `php artisan migrate:status` bernilai **"Ran"** di semua.

## 3. Yang Sudah Dikerjakan (Backend)

- [x] Struktur backend Laravel siap.
- [x] Migration domain dibuat & berhasil di MySQL.
- [x] Foreign key inti pada migration.
- [x] Enum status/kategori mulai dimodelkan di tabel.
- [x] Model Eloquent domain lengkap: `Pengguna`, `Barang`, `Transaksi`, `PermintaanBarang`, `Notifikasi`.
- [x] Service layer: `TransaksiService`, `NotifikasiService`, `UploadService`, trait `AuthorizedRoles`.
- [x] Controller: Dashboard, Auth, Item, Transaksi, Request, Notifikasi, Impact, Profile, Admin.
- [x] Alur transaksi & permintaan end-to-end (buat → setujui → jadwal → selesai) + notifikasi otomatis.
- [x] Upload foto file ke `storage/public` (fallback URL), `storage:link` aktif.
- [x] Otorisasi owner/admin via `ensureOwner` + middleware `login`/`role`.
- [x] Hardening: throttle login/register, session regenerate, validasi ketat, whitelist enum.
- [x] CRUD barang + status; search & filter kategori.
- [x] Seeder demo dan automated unit test (hijau).

## 4. Yang Parsial

- [~] Login/logout session custom (belum guard Laravel bawaan; sudah di-hardening: regenerate session + throttle).

## 5. Yang Belum / Catatan Berikutnya

- [ ] Form Request class terpisah (saat ini pakai `$request->validate` + service).
- [ ] Test berbasis skema MySQL (phpunit default sqlite in-memory belum mendukung `enum`/`ALTER` MySQL).
- [ ] Kolom timestamps pada tabel domain (opsional, untuk histori).
- catatan: model & service transaksi/permintaan/notifikasi, upload foto, seeder, dan test — **sudah selesai**.

## 6. Temuan Teknis Penting

- Tabel domain belum punya timestamps (`created_at`/`updated_at`) → histori sulit dilacak. Pertimbangkan menambahkan.
- Register dari UI belum ada (login/logout sudah nyata via session custom).
- Rencana migrasi ke guard auth standar Laravel.

## 7. Prioritas Backend

### Langkah 1 (wajib)
- Finalisasi arsitektur auth (users default atau migrasi penuh ke `pengguna`).
- Buat model domain & relasi Eloquent.
- Controller CRUD + Form Request validasi.

### Langkah 2
- Alur transaksi permintaan barang.
- Notifikasi otomatis saat status berubah.
- Seeder agar data demo siap uji.

### Langkah 3
- Test auth, CRUD, transaksi, notifikasi.
- Hardening input & otorisasi.

## 8. Cara Menjalankan / Verifikasi

```bash
# Verifikasi koneksi & status migrasi
php artisan migrate:status
# Jalankan server
php artisan serve
# Cek driver DB aktif
php artisan tinker --execute="echo config('database.default');"   # mysql
```

Verifikasi: `migrate:status` semua "Ran (batch 1)", DB default = `mysql`, aplikasi HTTP 200.