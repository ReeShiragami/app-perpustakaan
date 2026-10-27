# Aplikasi Perpustakaan Digital

Aplikasi manajemen perpustakaan berbasis Laravel. Fitur aplikasi mencakup login, dashboard statistik, pengelolaan kategori, buku, anggota, peminjaman, pengembalian, laporan peminjaman, dan REST API.

## Persyaratan

Pastikan perangkat sudah memiliki:

- PHP versi yang sesuai dengan `composer.json` proyek
- Composer
- MySQL atau MariaDB
- Node.js dan npm (hanya jika proyek membutuhkan proses build aset frontend)
- Git

## 1. Clone repository

Ganti `<URL_REPOSITORY_GITHUB>` dengan URL repository GitHub proyek yang sebenarnya.

```powershell
git clone <URL_REPOSITORY_GITHUB>
cd app-perpustakaan
```

Jika nama folder hasil clone berbeda, masuklah ke folder proyek tersebut.

## 2. Install dependency PHP

```powershell
composer install
```

## 3. Siapkan file environment

Salin `.env.example` menjadi `.env`:

```powershell
Copy-Item .env.example .env
```

Buka `.env`, lalu sesuaikan konfigurasi aplikasi dan database. Contoh untuk MySQL lokal:

```dotenv
APP_NAME="Perpustakaan Digital"
APP_ENV=local
APP_KEY=
APP_DEBUG=true
APP_URL=http://127.0.0.1:8000

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=db_perpustakaan
DB_USERNAME=root
DB_PASSWORD=

INTERNAL_API_URL=http://127.0.0.1:8011
```

Sesuaikan `DB_USERNAME` dan `DB_PASSWORD` dengan konfigurasi MySQL di perangkat masing-masing. Jika database atau nama pengguna berbeda, ubah nilainya sesuai kebutuhan.

Buat database kosong bernama `db_perpustakaan` melalui MySQL/phpMyAdmin, atau gunakan nama lain lalu sesuaikan `DB_DATABASE`.

Buat application key:

```powershell
php artisan key:generate
```

> Jangan commit file `.env` ke Git karena berisi konfigurasi lokal dan dapat berisi informasi sensitif. Gunakan `.env.example` untuk membagikan nama variabel yang diperlukan.

## 4. Jalankan migration dan seeder

Pastikan database sudah dibuat dan konfigurasi database pada `.env` benar. Kemudian jalankan:

```powershell
php artisan migrate --seed
```

Perintah tersebut membuat tabel yang didefinisikan oleh migration dan menjalankan seeder yang terdaftar di `DatabaseSeeder`.

> **Perhatian:** jalankan perintah ini pada database pengembangan/demo yang benar. Jangan menjalankan `migrate:fresh --seed` pada database yang berisi data penting karena perintah itu menghapus tabel sebelum membuatnya kembali.

## 5. Jalankan dua server Laravel

Aplikasi menggunakan dua instance server pengembangan. Server pertama melayani browser, sedangkan server kedua menyediakan API internal yang dikonsumsi Dashboard dan Laporan Peminjaman. **Keduanya harus berjalan bersamaan** untuk menampilkan data statistik dan laporan secara normal.

### Terminal 1 — aplikasi web (port 8000)

Dari folder proyek:

```powershell
php artisan serve --port=8000
```

Buka aplikasi melalui:

- Login: `http://127.0.0.1:8000/login`
- Dashboard: `http://127.0.0.1:8000/`
- Buku: `http://127.0.0.1:8000/books`
- Anggota: `http://127.0.0.1:8000/members`
- Peminjaman: `http://127.0.0.1:8000/loans`
- Laporan peminjaman: `http://127.0.0.1:8000/loans/report`

### Terminal 2 — API internal (port 8011)

Buka terminal kedua, masuk ke folder proyek yang sama, lalu jalankan:

```powershell
php artisan serve --port=8011
```

Variabel `INTERNAL_API_URL` pada `.env` harus mengarah ke alamat server kedua:

```dotenv
INTERNAL_API_URL=http://127.0.0.1:8011
```

Konfigurasi ini digunakan aplikasi saat mengambil data melalui endpoint API, termasuk statistik Dashboard (`/api/stats`) dan data laporan peminjaman (`/api/loans`).

Jangan tutup salah satu terminal selama demo. Jika server port `8011` tidak aktif atau URL-nya salah, Dashboard dan Laporan mungkin menampilkan data kosong sesuai penanganan kegagalan koneksi di aplikasi.

## 6. Login demo

Jika database diisi menggunakan seeder proyek yang menyediakan akun demo, akun admin yang disiapkan adalah:

- Email: `admin@pens.ac.id`
- Password: `password`

Gunakan kredensial tersebut hanya jika `UserSeeder` pada versi proyek yang dijalankan memang membuat akun itu. Ganti password untuk penggunaan di luar lingkungan demo lokal.

## 7. Pengujian REST API dengan Postman

Dengan server web di port `8000` aktif, gunakan base URL berikut:

```text
http://127.0.0.1:8000
```

Untuk request GET, tambahkan header:

```text
Accept: application/json
```

Endpoint yang tersedia pada proyek:

| Method | Endpoint | Kegunaan |
|---|---|---|
| `GET` | `/api/test` | Memeriksa endpoint uji |
| `GET` | `/api/books` | Melihat daftar buku |
| `POST` | `/api/books` | Membuat buku melalui API |
| `GET` | `/api/books/{book}` | Melihat detail buku |
| `PUT` / `PATCH` | `/api/books/{book}` | Memperbarui buku melalui API |
| `DELETE` | `/api/books/{book}` | Menghapus buku melalui API |
| `GET` | `/api/members` | Melihat daftar anggota |
| `GET` | `/api/members/{member}` | Melihat detail anggota |
| `GET` | `/api/loans` | Melihat daftar peminjaman |
| `POST` | `/api/loans` | Membuat peminjaman melalui API |
| `GET` | `/api/loans/{loan}` | Melihat detail peminjaman |
| `PUT` | `/api/loans/{id}/kembalikan` | Memproses pengembalian melalui API |
| `GET` | `/api/stats` | Melihat statistik perpustakaan |

Contoh request untuk melihat buku:

```http
GET http://127.0.0.1:8000/api/books
Accept: application/json
```

Untuk request `POST`, `PUT`, atau `PATCH`, pilih **Body → raw → JSON** dan tambahkan header `Content-Type: application/json`. Isi body harus mengikuti field dan aturan validasi yang ditetapkan oleh controller API proyek. Gunakan ID yang benar-benar ada untuk endpoint yang memerlukan parameter ID.

## 8. Alur demo

Urutan demo yang disarankan:

1. Login.
2. Tampilkan Dashboard.
3. Tambah kategori.
4. Tambah buku.
5. Tambah anggota.
6. Buat peminjaman.
7. Tampilkan daftar peminjaman aktif.
8. Proses pengembalian.
9. Tampilkan laporan peminjaman.
10. Demo endpoint REST API di Postman.

Lihat [`DEMO.md`](DEMO.md) untuk langkah demonstrasi yang lebih rinci.

## Troubleshooting singkat

- **`APP_KEY` kosong:** jalankan `php artisan key:generate`.
- **Database tidak dapat diakses:** pastikan MySQL aktif, database sudah dibuat, dan nilai `DB_*` di `.env` benar.
- **Tabel belum ada:** jalankan `php artisan migrate --seed`.
- **Dashboard/laporan tidak memuat data API:** pastikan server kedua aktif pada port `8011` dan `INTERNAL_API_URL=http://127.0.0.1:8011`.
- **Perubahan `.env` tidak terbaca setelah konfigurasi sebelumnya di-cache:** jalankan `php artisan config:clear`.
- **Route tidak sesuai:** periksa route yang terdaftar dengan `php artisan route:list`.

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
