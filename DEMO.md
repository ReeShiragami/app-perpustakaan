# Skenario Demo UAS — Aplikasi Perpustakaan Digital

Dokumen ini menjadi panduan urutan demonstrasi aplikasi Perpustakaan Digital. Jalankan demo dari awal sampai akhir dan tunjukkan bahwa perubahan data tampil pada halaman yang relevan.

## 1. Persiapan sebelum demo

1. Pastikan database sudah terisi dan akun pengguna tersedia.
2. Dari folder proyek, jalankan server web di terminal pertama:

   ```powershell
   php artisan serve --port=8000
   ```

3. Jalankan server API internal di terminal kedua:

   ```powershell
   php artisan serve --port=8011
   ```

4. Pastikan `.env` memiliki konfigurasi berikut:

   ```dotenv
   INTERNAL_API_URL=http://127.0.0.1:8011
   ```

5. Buka browser di `http://127.0.0.1:8000/login`.
6. Siapkan Postman untuk pengujian API pada bagian akhir.

> Catatan: Dashboard dan halaman laporan mengonsumsi API internal. Karena itu, kedua server perlu aktif selama demonstrasi.

## 2. Login

1. Tampilkan halaman login.
2. Masukkan akun demo yang tersedia di database. Jika menggunakan data dari `UserSeeder`, akun admin yang disiapkan adalah:
   - Email: `admin@pens.ac.id`
   - Password: `password`
3. Klik tombol **Login**.
4. Pastikan login berhasil dan aplikasi mengarahkan pengguna ke Dashboard.

**Yang ditunjukkan:** autentikasi pengguna dan akses ke halaman aplikasi.

## 3. Tampilkan Dashboard

1. Setelah login, perlihatkan halaman Dashboard.
2. Jelaskan tiga statistik utama:
   - Total Buku
   - Total Anggota
   - Peminjaman Aktif
3. Tunjukkan tautan menuju laporan peminjaman.

**Yang ditunjukkan:** ringkasan kondisi perpustakaan. Angka dapat berubah setelah data baru ditambahkan atau transaksi peminjaman/pengembalian diproses.

## 4. Tambah kategori

1. Buka menu **Kategori**.
2. Klik **Tambah Kategori**.
3. Isi nama kategori sesuai kebutuhan demo.
4. Simpan.
5. Pastikan kategori baru muncul pada daftar kategori.

**Yang ditunjukkan:** kategori dapat dibuat dan disimpan. Kategori ini akan dipakai saat menambahkan buku.

## 5. Tambah buku

1. Buka menu **Buku**.
2. Klik **Tambah Buku**.
3. Isi data buku pada formulir, seperti:
   - Judul
   - Penulis
   - Penerbit
   - Tahun terbit
   - ISBN (jika diminta)
   - Stok
   - Kategori yang baru dibuat
4. Simpan.
5. Pastikan buku baru muncul pada daftar buku dan data kategorinya sesuai.

**Yang ditunjukkan:** data buku tersimpan dan terhubung dengan kategori.

## 6. Tambah anggota

1. Buka menu **Anggota**.
2. Klik **Tambah Anggota**.
3. Isi seluruh field wajib pada formulir, misalnya nama, email, dan informasi anggota lain yang diminta aplikasi.
4. Simpan.
5. Pastikan anggota baru muncul pada daftar anggota.

**Yang ditunjukkan:** data anggota berhasil ditambahkan dan tersedia untuk transaksi peminjaman.

## 7. Buat peminjaman

1. Buka menu **Peminjaman**.
2. Klik **Tambah Peminjaman**.
3. Pilih anggota yang baru ditambahkan.
4. Pilih buku yang baru ditambahkan.
5. Isi tanggal peminjaman dan tanggal kembali sesuai field yang tersedia.
6. Simpan transaksi.
7. Pastikan aplikasi menampilkan pesan berhasil atau mengarahkan kembali ke daftar peminjaman.

**Yang ditunjukkan:** transaksi peminjaman menghubungkan anggota dan buku. Jika aplikasi menerapkan pengurangan stok saat peminjaman, tunjukkan perubahan stok tersebut.

## 8. Tampilkan daftar peminjaman aktif

1. Buka daftar **Peminjaman**.
2. Cari transaksi yang baru dibuat.
3. Pastikan transaksi tersebut terlihat dan statusnya masih **Dipinjam** atau status aktif yang digunakan aplikasi.
4. Tunjukkan informasi anggota, buku, tanggal pinjam, tanggal kembali, dan status yang tersedia di tabel.

**Yang ditunjukkan:** transaksi yang belum dikembalikan tercatat sebagai peminjaman aktif.

## 9. Proses pengembalian

1. Pada transaksi yang baru dibuat, klik aksi **Kembalikan** atau buka transaksi lalu pilih aksi pengembalian sesuai tampilan aplikasi.
2. Konfirmasikan proses pengembalian jika diminta.
3. Pastikan aplikasi menampilkan pesan berhasil.
4. Periksa kembali daftar peminjaman dan pastikan status transaksi berubah menjadi **Dikembalikan**.
5. Jika stok buku otomatis bertambah setelah pengembalian, tunjukkan perubahan stoknya.

**Yang ditunjukkan:** status dan data pengembalian diperbarui, bukan sekadar menambahkan transaksi baru.

## 10. Tampilkan laporan peminjaman

1. Klik tautan **Lihat Laporan Peminjaman** pada Dashboard atau buka:

   `http://127.0.0.1:8000/loans/report`

2. Tunjukkan tabel laporan yang memuat informasi transaksi, anggota, petugas, buku, tanggal pinjam, tanggal kembali, dan status (sesuai kolom yang ditampilkan).
3. Cari transaksi yang baru saja dibuat dan dikembalikan.
4. Pastikan status pada laporan mencerminkan hasil pengembalian.

**Yang ditunjukkan:** halaman laporan menampilkan data yang diperoleh melalui endpoint API peminjaman.

## 11. Demo REST API menggunakan Postman

Gunakan base URL:

`http://127.0.0.1:8000`

Pastikan header berikut disetel pada request GET:

`Accept: application/json`

Jalankan request berikut satu per satu dan perlihatkan status HTTP serta body JSON yang diterima.

| Tujuan | Method | URL |
|---|---|---|
| Memeriksa endpoint uji | `GET` | `/api/test` |
| Melihat daftar buku | `GET` | `/api/books` |
| Melihat daftar anggota | `GET` | `/api/members` |
| Melihat daftar peminjaman | `GET` | `/api/loans` |
| Melihat statistik | `GET` | `/api/stats` |

Contoh request lengkap:

```http
GET http://127.0.0.1:8000/api/books
Accept: application/json
```

Untuk menunjukkan operasi tulis/pengembalian API jika diperlukan, gunakan endpoint yang tersedia:

- `POST /api/books` — membuat buku; isi **Body → raw → JSON** sesuai field dan validasi yang digunakan API proyek.
- `PUT /api/loans/{id}/kembalikan` — memproses pengembalian untuk ID peminjaman yang valid.

Untuk request `POST` atau `PUT`, tambahkan header `Content-Type: application/json` dan gunakan struktur JSON sesuai validasi controller API yang ada di proyek. Jangan menebak nama field; periksa `Api\BookController` atau `Api\LoanController` bila perlu. Gunakan ID transaksi demo yang benar-benar ada.

**Yang ditunjukkan:** API dapat diakses melalui HTTP, mengembalikan JSON, dan menyediakan data yang juga digunakan oleh halaman Dashboard/Laporan.

## 12. Penutup demo

Sampaikan rangkuman singkat:

1. Pengguna dapat login dan melihat ringkasan Dashboard.
2. Kategori, buku, dan anggota dapat ditambahkan.
3. Peminjaman dapat dibuat, dilihat sebagai transaksi aktif, lalu diproses pengembaliannya.
4. Laporan menampilkan data transaksi.
5. REST API dapat diuji secara terpisah melalui Postman.

## Checklist sebelum presentasi

- [ ] Akun demo dapat digunakan untuk login.
- [ ] Kedua server berjalan pada port `8000` dan `8011`.
- [ ] Dashboard menampilkan statistik tanpa error.
- [ ] Penambahan kategori, buku, dan anggota berhasil.
- [ ] Peminjaman baru dapat dibuat dan terlihat pada daftar.
- [ ] Pengembalian mengubah status transaksi.
- [ ] Laporan dapat dibuka dan menampilkan transaksi.
- [ ] Request GET API berhasil di Postman.
- [ ] Siapkan satu ID peminjaman valid untuk demonstrasi endpoint pengembalian API jika diperlukan.
