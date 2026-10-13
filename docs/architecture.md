Arsitektur Backend KantinKu — Laravel MVC + REST API

1. Deskripsi Project

KantinKu merupakan aplikasi pemesanan makanan dan minuman kantin kampus. Backend dikembangkan menggunakan Laravel untuk menyediakan REST API yang dapat digunakan oleh aplikasi Flutter.

2. Arsitektur MVC

Backend menggunakan pola Model-View-Controller (MVC).

- Model: Mengelola representasi data dan interaksi dengan database menggunakan Eloquent ORM.
- View: Pada backend API, respons utama berupa JSON, sedangkan antarmuka pengguna dikembangkan secara terpisah menggunakan Flutter.
- Controller: Memproses permintaan HTTP, mengambil data melalui Model, dan mengembalikan respons JSON.

3. Struktur Folder

app/
├── Models/
│   ├── Menu.php
│   └── Category.php
└── Http/
    └── Controllers/
        └── Api/
            ├── MenuController.php
            └── CategoryController.php

routes/
└── api.php

database/
└── migrations/

docs/
└── architecture.md

4. Database

Database pengembangan menggunakan SQLite.

Tabel utama yang telah dibuat:

- "categories": Menyimpan kategori menu.
- "menus": Menyimpan informasi menu, harga, dan ketersediaan.

Relasi: satu kategori dapat memiliki banyak menu. Setiap menu terhubung dengan satu kategori melalui "category_id".

5. REST API

Method| Endpoint| Fungsi
GET| "/api/menus"| Mengambil daftar menu
GET| "/api/categories"| Mengambil daftar kategori

Kedua endpoint mengembalikan respons dalam format JSON.

6. Alur Sistem

Flutter (View) → Flutter ViewModel → Repository → Laravel REST API → Controller → Model → SQLite.

Data dikembalikan dalam format JSON untuk diproses dan ditampilkan oleh Flutter.

7. Menjalankan Backend

composer install
php artisan key:generate
php artisan migrate
php artisan serve

Sebelum menjalankan perintah tersebut, salin ".env.example" menjadi ".env" dan pastikan konfigurasi database sesuai.

8. Status Implementasi

- Project Laravel berhasil dibuat dan dijalankan.
- Model Menu dan Category tersedia.
- Migration database berhasil dijalankan.
- Endpoint GET Menu dan Category telah diuji.
- Integrasi Flutter dengan Laravel belum dilakukan.
- Fitur pemesanan, pembayaran, dan autentikasi aplikasi belum diimplementasikan.