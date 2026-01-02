## Sistem Prestasi Mahasiswa FMIPA

Aplikasi Laravel 12 untuk menampilkan dan mengelola prestasi mahasiswa FMIPA. Publik dapat menelusuri daftar prestasi, sementara Admin (role 1) dan Dosen (role 2) mengelola data prestasi, program studi, dan pengguna. Mahasiswa (role 3) hanya mengakses halaman publik.

### Fitur

-   Landing page daftar prestasi dengan pencarian, filter, dan pagination.
-   Admin dashboard untuk CRUD prestasi, pengguna, dan program studi.
-   Import prestasi dari Excel dan unduh template.
-   Autentikasi dengan Sanctum; proteksi role-based.

### Prasyarat

-   PHP 8.4, Composer
-   Node.js 18+ dan npm
-   Database yang didukung Laravel (MySQL/PostgreSQL/dll)

### Instalasi

```bash
composer install
cp .env.example .env   # isi konfigurasi DB_*
php artisan key:generate
php artisan migrate
npm install
npm run build          # atau npm run dev saat pengembangan
```

Jika butuh akses berkas upload (foto/bukti):

```bash
php artisan storage:link
```

Install icon from lucide:

```bash
npm install lucide
```

### Menjalankan aplikasi

```bash
# server PHP
php artisan serve

# asset dev server
npm run dev
```

### Catatan Role

-   Role 1 (Admin) & 2 (Dosen): akses area admin `/admin`.
-   Role 3 (Mahasiswa): akses publik saja.

### Lisensi

MIT (mengikuti lisensi Laravel).
