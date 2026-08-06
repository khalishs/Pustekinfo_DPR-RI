<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## About Laravel

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel takes the pain out of development by easing common tasks used in many web projects, such as:

- [Simple, fast routing engine](https://laravel.com/docs/routing).
- [Powerful dependency injection container](https://laravel.com/docs/container).
- Multiple back-ends for [session](https://laravel.com/docs/session) and [cache](https://laravel.com/docs/cache) storage.
- Expressive, intuitive [database ORM](https://laravel.com/docs/eloquent).
- Database agnostic [schema migrations](https://laravel.com/docs/migrations).
- [Robust background job processing](https://laravel.com/docs/queues).
- [Real-time event broadcasting](https://laravel.com/docs/broadcasting).

Laravel is accessible, powerful, and provides tools required for large, robust applications.

## Instalasi & Setup Database

Setiap kali clone repo ini (atau setelah merge ke `main`), database **tidak ikut ter-commit** (file `database/database.sqlite` maupun kredensial di `.env` sengaja di-ignore Git karena berbeda-beda tiap environment). Yang ikut ter-commit adalah **migration** dan **seeder**, sehingga siapa pun yang clone bisa membangun ulang skema + data dasar (akun pegawai, statistik, layanan) secara otomatis.

Cara tercepat, setelah clone:

```bash
composer run setup
```

Command di atas otomatis akan:
1. `composer install`
2. Menyalin `.env.example` → `.env` (kalau belum ada)
3. Generate `APP_KEY` (kalau belum ada)
4. Membuat file `database/database.sqlite` (kalau pakai SQLite dan file belum ada)
5. Menjalankan `php artisan migrate`
6. Menjalankan `php artisan db:seed`
7. `npm install && npm run build`

Setelah itu jalankan `composer run dev` untuk start server lokal.

**Catatan:**
- Default `.env.example` memakai `DB_CONNECTION=sqlite`. Kalau mau pakai MySQL, edit `.env` sesuai kredensial lokal (`DB_CONNECTION=mysql`, `DB_HOST`, `DB_DATABASE`, dst) sebelum menjalankan `composer run setup`, atau jalankan ulang `php artisan migrate --seed` setelah mengganti konfigurasi.
- Seeder (`DatabaseSeeder`, `StatisticSeeder`, `ServiceSeeder`) memakai `updateOrCreate`, jadi aman dijalankan berkali-kali (tidak akan duplikat data).
- Konten yang diisi manual lewat admin panel (berita, galeri, agenda, kepemimpinan, dll) **tidak** dibawa oleh seeder — itu memang data spesifik tiap environment/database, bukan bagian dari kode.

## Storage & Upload Gambar

Semua gambar yang di-upload lewat panel admin (hero slider, galeri, berita, foto profil, dll) disimpan di `storage/app/public/` dan diakses lewat browser lewat symlink `public/storage`. Dua hal penting soal ini:

1. **`php artisan storage:link` wajib dijalankan di tiap environment.** Sudah otomatis ikut dijalankan oleh `composer run setup` (lihat di atas), jadi kalau setup lewat command itu, tidak perlu langkah manual tambahan.
2. **File yang sudah di-upload TIDAK ikut ter-commit ke Git** (`storage/app/public/*` sengaja di-`.gitignore`, sama seperti database — memang bukan bagian dari kode, tapi data spesifik tiap environment). Artinya kalau teman Anda `git clone` project ini, dia tidak akan otomatis dapat gambar-gambar yang sudah Anda upload sebelumnya. Untuk menyamakan:
   - **Cara cepat/lokal**: zip folder `storage/app/public` dan kirim manual (bukan lewat Git), lalu extract di folder yang sama di komputer teman Anda.
   - **Cara jangka panjang**: pindahkan penyimpanan ke cloud storage (lihat di bawah) — sekali dikonfigurasi, semua orang yang menjalankan project ini (dari environment manapun) otomatis melihat gambar yang sama karena sumbernya bukan lagi disk lokal.

### Pindah ke cloud storage (S3 / S3-compatible)

Semua kode upload & tampilan gambar sudah memakai disk yang bisa dikonfigurasi lewat env var `MEDIA_DISK` (lihat `config/filesystems.php` dan helper `media_url()` di `app/Support/helpers.php`) — jadi pindah ke cloud storage tidak perlu ubah kode sama sekali, cukup isi `.env`:

```env
MEDIA_DISK=s3
AWS_ACCESS_KEY_ID=...
AWS_SECRET_ACCESS_KEY=...
AWS_DEFAULT_REGION=...
AWS_BUCKET=...
AWS_URL=...
# Hanya perlu diisi kalau bukan AWS S3 asli (Cloudflare R2, DigitalOcean Spaces,
# Backblaze B2, MinIO, dll):
AWS_ENDPOINT=...
AWS_USE_PATH_STYLE_ENDPOINT=true
```

Package `league/flysystem-aws-s3-v3` sudah terpasang, jadi tinggal isi kredensial dari provider pilihan Anda. Kalau `MEDIA_DISK` dibiarkan `public` (default), semuanya tetap jalan seperti biasa di disk lokal.

### Pindah ke Firebase Storage

Firebase Storage juga didukung lewat disk `gcs` (Firebase Storage sebenarnya adalah bucket Google Cloud Storage). Langkahnya:

1. Buka [Firebase Console](https://console.firebase.google.com) → project Anda → **Storage**, aktifkan kalau belum, catat nama bucket-nya (biasanya `<project-id>.appspot.com` atau `<project-id>.firebasestorage.app`).
2. **Project settings** (ikon gerigi) → **Service accounts** → **Generate new private key** → download file JSON-nya.
3. Simpan file itu sebagai `storage/app/firebase-credentials.json` (folder ini sudah otomatis di-gitignore, jadi aman, kredensialnya tidak akan ke-commit).
4. Isi `.env`:

```env
MEDIA_DISK=gcs
FIREBASE_PROJECT_ID=nama-project-firebase-anda
FIREBASE_STORAGE_BUCKET=nama-project-firebase-anda.appspot.com
FIREBASE_CREDENTIALS_PATH=app/firebase-credentials.json
```

Package `spatie/laravel-google-cloud-storage` sudah terpasang untuk driver-nya. Setelah `MEDIA_DISK=gcs` aktif, semua upload baru dari admin panel otomatis tersimpan di Firebase Storage — siapapun yang menjalankan project ini (dari environment manapun) akan melihat gambar yang sama tanpa perlu transfer file manual lagi.

## Learning Laravel

Laravel has the most extensive and thorough [documentation](https://laravel.com/docs) and video tutorial library of all modern web application frameworks, making it a breeze to get started with the framework. You can also check out [Laravel Learn](https://laravel.com/learn), where you will be guided through building a modern Laravel application.

If you don't feel like reading, [Laracasts](https://laracasts.com) can help. Laracasts contains thousands of video tutorials on a range of topics including Laravel, modern PHP, unit testing, and JavaScript. Boost your skills by digging into our comprehensive video library.

## Laravel Sponsors

We would like to extend our thanks to the following sponsors for funding Laravel development. If you are interested in becoming a sponsor, please visit the [Laravel Partners program](https://partners.laravel.com).

### Premium Partners

- **[Vehikl](https://vehikl.com)**
- **[Tighten Co.](https://tighten.co)**
- **[Kirschbaum Development Group](https://kirschbaumdevelopment.com)**
- **[64 Robots](https://64robots.com)**
- **[Curotec](https://www.curotec.com/services/technologies/laravel)**
- **[DevSquad](https://devsquad.com/hire-laravel-developers)**
- **[Redberry](https://redberry.international/laravel-development)**
- **[Active Logic](https://activelogic.com)**

## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](https://laravel.com/docs/contributions).

## Code of Conduct

In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
