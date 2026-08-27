# FRONTEND — LOOP

Dokumen frontend untuk project **LOOPIN** membahas antarmuka web dan status implementasinya.

> Nama file `frontend.md` (pengganti `FROMTEND.MD` versi lama dengan typo).

## 1. Stack Frontend

- **Blade** (Laravel templating).
- **Tailwind CSS** (utility-first).
- **Vite** sebagai build tool.
- HTML/CSS/JS vanilla di dalam Blade; tanpa framework JS tambahan.

## 2. Requirement Frontend (referensi PRD)

- Landing page interaktif kampanye circular economy.
- Halaman autentikasi aman (masuk/daftar).
- Dashboard utama + katalog interaktif.
- CRUD barang via UI.
- Pencarian dan filter kategori.
- Validasi form ketat (client).
- Desain responsif desktop & mobile.
- Notifikasi UI serta profil & impact page.

## 3. Catatan Kelembagaan (pages)

Yang dibuat di `resources/views`:

- `layout` aplikasi (navbar + area konten).
- `dashboard`
- `login`
- katalog barang (card list) + pencarian/filter
- detail barang
- form tambah / edit barang
- barang saya (tombol edit/hapus/update status)
- impact
- requests (placeholder)
- profile

## 4. Yang Sudah Dikerjakan

- [x] Build frontend via Vite aktif.
- [x] Tailwind CSS di dependency.
- [x] Jalur route ke semua halaman utama aktif.
- [x] Layout utama (navbar + konten) dibuat.
- [x] Dashboard awal dibuat.
- [x] Halaman login terhubung ke backend.
- [x] Katalog dengan card list berjalan.
- [x] Detail barang tersedia.
- [x] Form tambah/edit barang tersedia.
- [x] Barang saya dengan edit/hapus/update status.
- [x] Impact, requests, profile tersedia.
- [x] Search & filter kategori dasar berjalan.

## 5. Yang Ada Tapi Belum Sesukai LOOP

- [~] Identitas visual versi awal, belum brand guideline final kompetisi.
- [~] Halaman requests masih placeholder fungsional (belum alur submit–matching).

## 6. Belum Lengkap / Harus Dikerjakan

- [ ] Landing page final (narasi masalah, solusi, manfaat, CTA) untuk presentasi/juri.
- [ ] Halaman registrasi & onboarding (register).
- [ ] Upload foto file nyata dari UI (bukan URL manual).
- [ ] Notifikasi UI (badge/list/mark as read).
- [ ] Empty / loading / error states di semua modul.
- [ ] Pengujian responsive lintas device & accessibility polish.

## 7. Catatan UX / Gaps

- Alur login → dashboard → katalog → CRUD sudah berjalan.
- Onboarding user baru belum ada karena register belum dibuat.
- Branding masih MVP, belum final untuk presentasi.

## 8. Prioritas Implementasi

### Tinggi
- Landing page final.
- Halaman register + onboarding.
- Upload foto barang.

### Menengah
- Filter kategori + pencarian keyword.
- Halaman profile & impact polish.
- Komponen notifikasi di UI.

### Lanjutan
- Polish UI: animasi ringan, konsistensi spacing/typography.
- Optimasi aksesibilitas: label form, kontras warna, focus state.

## 9. Requirement Konfigurasi untuk Menjalankan

```bash
npm install     # dependency (jika belum)
npm run dev     # saat development (Vite HMR)
# atau
npm run build   # build produksi
php artisan serve   # jalankan server Laravel
```