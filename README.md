# KPI Management System

Aplikasi web untuk mengelola data karyawan dan penilaian kinerja berbasis Key Performance Indicator (KPI). Aplikasi menggunakan panel admin Filament untuk pengelolaan data dan pemantauan hasil penilaian.

## Fitur

- Dashboard ringkasan penilaian dan indikator KPI.
- Pengelolaan departemen, jabatan, karyawan, kategori penilaian, dan indikator KPI.
- Pencatatan penilaian kinerja karyawan beserta rincian nilai dan bobot indikator.
- Impor data karyawan dari Excel serta ekspor data karyawan dan penilaian ke Excel.

## Teknologi

- PHP 8.3 atau lebih baru
- Laravel 13
- Filament 5 dan Livewire 4
- SQLite sebagai basis data bawaan (dapat dikonfigurasi melalui `.env`)
- Node.js dan npm untuk aset frontend (Vite dan Tailwind CSS)

## Persiapan

Pastikan PHP, Composer, Node.js, dan npm sudah terpasang. Dari direktori proyek, jalankan:

```bash
composer run setup
```

Skrip setup akan memasang dependensi, menyiapkan `.env` dan application key, menjalankan migrasi basis data, serta memasang dan membangun aset frontend.

Jika ingin menggunakan basis data selain SQLite, sesuaikan konfigurasi `DB_*` di `.env` sebelum menjalankan migrasi.

### Data awal

Seeder menyediakan data referensi awal seperti departemen, jabatan, kategori penilaian, dan indikator KPI:

```bash
php artisan db:seed
```

Seeder tidak membuat akun pengguna. Buat akun untuk masuk ke panel admin dengan:

```bash
php artisan make:filament-user
```

## Menjalankan aplikasi

Jalankan server pengembangan:

```bash
composer run dev
```

Buka panel admin di [http://localhost:8000/admin](http://localhost:8000/admin), lalu masuk menggunakan akun Filament yang telah dibuat.

## Pengujian

Jalankan seluruh pengujian dengan:

```bash
php artisan test
```

Pemeriksaan format kode dan analisis tipe juga tersedia:

```bash
composer run lint
composer run types:check
```
