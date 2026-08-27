# PROGRESS IMPLEMENTASI LOOPIN

Update terakhir: 2026-08-26

## Ringkasan

Project sudah masuk tahap MVP fungsional dasar: struktur backend domain tersedia, routing utama aktif, dan halaman frontend inti telah dibuat agar alur aplikasi dapat diuji end-to-end secara sederhana.

## Sudah Dikerjakan

- Setup Laravel 12 + Vite + Tailwind.
- Migration domain LOOPIN:
    - pengguna
    - barang
    - transaksi
    - permintaan_barang
    - notifikasi
- Routing utama terpasang ke controller:
    - dashboard
    - login/logout
    - katalog barang
    - barang saya
    - requests
    - impact
    - profile
- Model domain awal:
    - Pengguna
    - Barang
- Controller awal:
    - DashboardController
    - AuthController
    - ItemController
    - RequestController
    - ImpactController
    - ProfileController
- View utama siap pakai:
    - layout aplikasi
    - dashboard
    - login
    - katalog barang
    - detail barang
    - create/edit barang
    - barang saya
    - impact
    - requests (placeholder fungsional)
    - profile

## Belum Lengkap

- Registrasi pengguna mandiri dari UI.
- Integrasi auth standar Laravel (guard/provider) dengan tabel domain final.
- Upload foto file nyata ke storage (saat ini masih URL string).
- Modul permintaan barang yang benar-benar transaksiable.
- Modul notifikasi real-time/in-app.
- Test feature/unit untuk auth, CRUD, filter, dan authorization.
- Hardening authorization menggunakan middleware/policy.

## Risiko / Catatan

- Password login saat ini mendukung hash Laravel atau plain-text fallback untuk kompatibilitas data lama.
- Karena tabel domain tidak memiliki timestamps, histori waktu pembuatan/perubahan data belum tercatat.

## Next Sprint Yang Direkomendasikan

1. Finalkan auth architecture dan registrasi user.
2. Ganti kolom foto menjadi upload file terstruktur (public disk).
3. Lengkapi modul request/transaksi/notifikasi.
4. Tambahkan test dan policy keamanan endpoint penting.
