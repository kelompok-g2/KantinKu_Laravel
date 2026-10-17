# Kesesuaian dengan dokumentasi awal

Sumber bersama: [kelompok-g2/Kelompok-G](https://github.com/kelompok-g2/Kelompok-G),
commit 01b319365076608ae72fbd4693d6a510c429449d.

## Pemetaan rancangan dan implementasi

| Area | Rancangan awal | Kondisi kode saat diperiksa | Aturan lanjutan |
|---|---|---|---|
| API | Base /api/v1; respons status, message, data | Laravel baru GET /api/categories dan /api/menus; respons success, message, data | Pertahankan baseline untuk P06. Penyelarasan versi/response dilakukan melalui fitur terpisah dan uji kontrak Flutter–Laravel. |
| Data | users, categories, menus, orders, order_items, payments, notifications, order_status_histories | Domain Category/Menu tersedia; pemesanan dan pembayaran belum diimplementasikan | Jadikan desain referensi pengembangan bertahap, jangan mengaku seluruh tabel/fitur sudah selesai. |
| Visual | Design tokens memakai nama KantinKampus, primary #3B82F6, font Inter, spacing 4px | Flutter memakai nama KantinKu dan tema hijau Material | Catat perbedaan; penyelarasan UI melalui feature terpisah, bukan mengganti UI diam-diam pada tugas workflow. |
| Flutter | Konsumen API rancangan | MenuModel tersedia, repository masih mengembalikan daftar kosong | Integrasi API masih pekerjaan berikutnya. |
| Database | SQL memakai sintaks identity dan foreign key deferrable | Pengembangan Laravel memakai SQLite migrations | Jangan langsung mengimpor database.sql ke SQLite. Turunkan perubahan skema ke migration dan verifikasi kompatibilitas. |

## Referensi permanen
- [Kontrak API](https://github.com/kelompok-g2/Kelompok-G/blob/01b319365076608ae72fbd4693d6a510c429449d/docs/api_contract.md)
- [Design tokens](https://github.com/kelompok-g2/Kelompok-G/blob/01b319365076608ae72fbd4693d6a510c429449d/docs/design_tokens.md)
- [Rancangan database](https://github.com/kelompok-g2/Kelompok-G/blob/01b319365076608ae72fbd4693d6a510c429449d/docs/database.sql)
- [ERD](https://github.com/kelompok-g2/Kelompok-G/blob/01b319365076608ae72fbd4693d6a510c429449d/docs/erd.png)

Dokumentasi sumber yang ditemukan berisi rancangan, bukan teks Prompt 2/3
atau definisi skenario rollback 2/3. Detail petunjuk dosen tersebut masih diperlukan.
