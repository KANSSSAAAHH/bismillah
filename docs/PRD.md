# PRD — LOOPIN (Platform Circular Economy Perlengkapan Sekolah)

Dokumen ini adalah Product Requirements Document (PRD) resmi untuk pengembangan platform **LOOPIN**.

## 1. Ringkasan Produk

**LOOPIN** adalah platform *circular economy* untuk perlengkapan sekolah yang memfasilitasi **donasi, barter, dan distribusi barang layak pakai**. Target utama adalah siswa, orang tua, dan sekolah. Tujuan utamanya mengurangi sampah/limbah barang sekolah yang masih layak pakai sekaligus membantu pemerataan akses perlengkapan sekolah.

## 2. Visi & Misi

### Visi
Menjadi platform utama daur ulang dan distribusi ulang perlengkapan sekolah di Indonesia, membangun ekositem donasi-barter yang transparan, aman, dan berdampak sosial.

### Misi
1. Menghubungkan penyumbang (donatur/PS) dengan penerima manfaat (siswa/sekolah).
2. Mendorong budaya berbagi dan memakai ulang perlengkapan sekolah.
3. Memberikan transparansi atas dampak yang dicapai (impact).
4. Menyediakan pengalaman regulasi yang mudah, aman, dan dapat dipercaya.

## 3. Pernyataan Masalah

- Banyak siswa membutuhkan perlengkapan sekolah tetapi terkendala biaya.
- Banyak perlengkapan layak pakai menumpuk tidak terpakai.
- Sulit menemukan jalur donasi/barter yang terpercaya.

## 4. Persona Pengguna

| Persona | Deskripsi | Kebutuhan Utama |
|---------|-----------|-----------------|
| Penyedia Barang | Siswa / orang tua / relawan yang memiliki barang layak pakai | Upload barang, kelola, cek dampak |
| Penerima Manfaat | Siswa/sekolah yang membutuhkan barang | Cari barang, ajukan permintaan, menerima |
| Admin/Sekolah | Menyelenggarakan kegiatan donor/barter di lingkungan sekolah | Validasi barang, pantau transaksi, lihat dampak |

## 5. Scope / Lingkup Fitur

### In Scope (MVP)

- Landing page interaktif kampanye circular economy.
- Autentikasi pengguna (masuk & daftar).
- Dashboard utama pengguna.
- Katalog barang dengan pencarian & filter kategori.
- Detail barang.
- CRUD barang (tambah, lihat, edit, hapus).
- Validasi form ketat (client & server).
- Manajemen status barang (tersedia, diproses, selesai).
- Halaman "Barang Saya".
- Alur permintaan barang (request) dan pencatatan transaksi.
- Notifikasi in-app sederhana.
- Halaman profil pengguna.
- Halaman dampak (impact metrics).
- Desain responsif desktop & mobile.

### Out of Scope (untuk MVP)

- Pembayaran / integrasi e-wallet.
- Alokasi logistik pengiriman real-time.
- Mobile native app (menggunakan web responsif dulu).
- Pemasaran otomatis / iklan.

## 6. Requirement Fungsional (Functional Requirements)

| ID | Fitur | Requirement |
|----|-------|-------------|
| FR-01 | Landing Page | Menampilkan narasi masalah, solusi, manfaat, dan CTA menuju katalog/daftar. |
| FR-02 | Autentikasi | Login, logout, dan registrasi pengguna mandiri dengan hash password. |
| FR-03 | Dashboard | Menyajikan ringkasan status barang, aktivitas, dan dampak pengguna. |
| FR-04 | Katalog | Daftar barang dengan grid card, fitur pencarian keyword dan filter kategori. |
| FR-05 | Detail Barang | Informasi lengkap barang + tombol permintaan/detail aksi. |
| FR-06 | CRUD Barang | Form tambah, lihat, edit, hapus sewajarnya milik; upload foto. |
| FR-07 | Status Barang | Ubah status (tersedia / terjadwal / selesai). |
| FR-08 | Validasi | Validasi form server (Form Request) dan client (UI). |
| FR-09 | Permission/Policy | Hanya pemilik yang bisa mengubah/hapus barangnya. |
| FR-10 | Transaksi/Request | Ajukan permintaan barang, approve/reject, catat transaksi. |
| FR-11 | Notifikasi | Notifikasi in-app saat status/perminter berubah. |
| FR-12 | Responsif | Layout berfungsi di desktop & mobile. |

## 7. Acceptance Criteria Umum

- Pengguna dapat mendaftar, login, dan logout dengan baik.
- Pengguna dapat menambah barang dengan foto, lalu melihatnya di katalog.
- Pemilik dapat mengedit/menghapus/mengubah status barangnya sendiri; non-pemilik tidak.
- Pengguna dapat menyaring katalog berdasarkan keyword dan kategori.
- Permintaan barang dan transaksi tercatat dengan status yang jelas.
- Tampilan berfungsi responsif di perangkat desktop & mobile.
- Data tersimpan aman pada database MySQL `loopin` (migrasi sudah tersedia).

## 8. Metrik Keberhasilan (Success Metrics)

- Jumlah pengguna terdaftar.
- Jumlah barang terunggah dan total transaksi permintaan selesai.
- Jumlah barang terdistribusikan (donasi/barter).
- Tingkat penyelesaian permintaan barang.
- Durasi rata-rata pengguna di katalog; conversion ke permintaan.

## 9. Prioritas & Sprint

### Sprint 1 — Core Functional

- Registrasi pengguna + integrasi auth standar Laravel.
- Ubah foto URL → upload file ke `storage/public`.
- Policy & middleware untuk route sensitif.
- Form Request validation untuk semua input penting.

### Sprint 2 — Completeness

- Perillingkarkan alur permintaan, transaksi, dan notifikasi end-to-end.
- Pencarian/filter kategori lengkap.
- Seed data dummy untuk demo.
- Test feature auth, CRUD, transaksi, dan authorization.
- Polisi visual dan brand final LOOP.

## 10. Asumsi & Batasan

- Stack: Laravel 12 + Blade + Tailwind CSS + Vite; database MySQL.
- Auth saat awal pakai custom session; rencana pindah ke guard auth standar Laravel.
- Foto barang saat ini masih URL string; perlu migrasi ke file upload.