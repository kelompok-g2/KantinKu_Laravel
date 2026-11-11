# REST API KantinKu untuk Pertemuan 9

Base URL lokal XAMPP `http://localhost/kantinku/api`. Saat memakai `php artisan serve`, gunakan `http://127.0.0.1:8000/api`. Kirim header `Accept: application/json` dan `Content-Type: application/json` untuk request dengan body. Untuk route terproteksi gunakan `Authorization: Bearer <token>`.

| # | Method | Path relatif ke /api | Akses |
|---|---|---|---|
| 1 | GET | /menus | Publik, endpoint lama |
| 2 | GET | /categories | Publik, endpoint lama |
| 3 | GET | /menus/{menu} | Publik |
| 4 | POST | /auth/register | Publik |
| 5 | POST | /auth/login | Publik |
| 6 | GET | /auth/me | Akun terautentikasi |
| 7 | POST | /auth/logout | Akun terautentikasi |
| 8 | POST | /categories | Pengelola |
| 9 | PATCH | /categories/{category} | Pengelola |
| 10 | DELETE | /categories/{category} | Pengelola |
| 11 | POST | /menus | Pengelola |
| 12 | PATCH | /menus/{menu} | Pengelola |
| 13 | DELETE | /menus/{menu} | Pengelola |
| 14 | POST | /orders | Akun terautentikasi |
| 15 | GET | /orders | Pemilik pesanan |
| 16 | GET | /orders/{order} | Pemilik atau pengelola |
| 17 | GET | /admin/orders | Pengelola |
| 18 | PATCH | /orders/{order}/status | Pengelola |
| 19 | GET | /notifications | Pemilik notifikasi |
| 20 | PATCH | /notifications/{id}/read | Pemilik notifikasi |

Jika Apache memakai aturan rewrite di luar folder public, teruskan header Authorization ke PHP seperti aturan bawaan di public/.htaccess.

## Body dan perilaku

- Register menerima `name`, `email`, `password`, dan `password_confirmation`. Login menerima `email` dan `password`. Keduanya mengembalikan `data.token` dengan masa berlaku 30 hari. Logout mencabut token yang digunakan.
- Kategori menerima `name` dan opsional `description`. Kategori yang masih punya menu mengembalikan 409 saat dihapus.
- Menu menerima `name`, `category_id`, `price` dan opsional `stand`, `description`, `image_url` (HTTP/HTTPS), serta `is_available`. PATCH menerima field yang berubah. Harga dan nama historis tetap tersimpan di item pesanan jika menu dihapus.
- Buat pesanan dengan `{"items":[{"menu_id":1,"quantity":2}],"pickup":"scheduled","pickup_time":"14:00","note":"Tanpa sambal"}`. Pilihan `pickup` mencakup `asap`, `after_class`, dan `scheduled`. Harga dihitung dari database. Bayar tunai saat pengambilan. Opsional `Idempotency-Key` berupa UUID per checkout. Ulangi dengan kunci yang sama jika pengiriman request perlu diulang.
- Kirim `{"status":"preparing"}` untuk memulai proses. Transisi sah ialah `pending → preparing → ready → completed`. Perubahan status membuat notifikasi pemilik.
- Respons sukses memakai `success`, `message`, dan `data`. Daftar pesanan dan notifikasi memakai pagination di `data`. Error Laravel memakai `message` dan, untuk validasi, `errors`.
- Dokumen [rancangan API v1](api_contract.md) menggambarkan target awal. Daftar di atas mencatat route yang tersedia pada implementasi P09.

## Akses pengelola

Buat akun lewat register, lalu aktifkan peran untuk email tersebut dari terminal server yang berwenang.

```sh
php artisan kantinku:pengelola email-anda@example.com
```

## Verifikasi

```sh
composer install
php artisan migrate
php artisan route:list --path=api --except-vendor
php artisan test
```

Siapkan `.env`, `APP_KEY`, dan koneksi database sebelum migrasi. Tes HTTP otomatis memakai SQLite in-memory dan menguji semua 20 endpoint, token, batas akses, checkout ulang, snapshot item, dan notifikasi.
