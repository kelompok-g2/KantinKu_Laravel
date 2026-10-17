# Panduan proyek KantinKu — Laravel

## Konteks dan struktur
Dokumentasi tugas terdahulu dan perbedaan terhadap kode dicatat di [kesesuaian konteks](context_alignment.md).
Repo ini menggunakan MVC + REST API. Baca [arsitektur](architecture.md) dan
[aturan AI](../agents.md). Route API di routes/api.php, controller di app/Http/Controllers/Api, model Eloquent di app/Models dan skema melalui database/migrations. Pertahankan GET /api/categories dan GET /api/menus dengan JSON success, message, data. Database pengembangan SQLite.

Baseline yang diperiksa: b37274ace6b9934939aaa1473cf9482b6b1ad0c2.
Panduan menetapkan alur kerja; pelaksanaannya dicatat di [checklist](pertemuan6_checklist.md).

## Setup laptop
Clone repo ke folder pilihan, masuk ke root dan cek git status --short --branch.
Jangan menyalin kredensial teman. Instal dependensi dari lockfile yang tersedia.
PHP minimal 8.2, Composer dan ekstensi PDO SQLite/SQLite3 diperlukan. Jalankan composer install. Hanya jika .env belum ada, jalankan Copy-Item .env.example .env. Atur DB_CONNECTION=sqlite; buat database/database.sqlite kosong hanya jika belum ada. Jalankan php artisan key:generate hanya untuk instalasi lokal baru, lalu php artisan migrate dan php artisan serve. Verifikasi GET /api/categories dan /api/menus berstatus HTTP sukses dengan JSON success, message, data. Database baru dapat mengembalikan array kosong. Jangan menimpa .env atau database yang sudah ada.

## Konvensi
Gunakan nama deskriptif, perubahan kecil dan gaya kode bawaan proyek.
Perbarui docs/architecture.md jika alur atau struktur berubah.
Jangan memasukkan rahasia, log lokal atau dependency hasil instalasi ke Git.

## Branch dan PR
- main: versi stabil, wajib protected dan menerima perubahan melalui PR.
- dev: integrasi kelompok, dibuat dari main awal jika belum ada.
- feature/context-management: aturan dan panduan Pertemuan 6; pekerjaan lain memakai feature/nama-singkat.
- Awali fitur dari dev terbaru: git fetch origin, git switch dev, git pull --ff-only, lalu git switch -c feature/nama-singkat.
- Tinjau diff, verifikasi, stage file spesifik, commit deskriptif, lalu push feature branch tanpa force.
- PR feature/* menuju dev diperiksa anggota lain dan di-merge setelah perbaikan.
- PR dev menuju main juga memerlukan review anggota lain.
- Pertahankan feature/context-management sampai screenshot struktur branch direkam.
- Selesaikan konflik di feature branch; jangan force push main/dev.

## Proteksi main — admin repo
Aktifkan branch protection/ruleset untuk main: wajib PR, minimal satu approving review,
dismiss approval saat commit baru, dan percakapan review terselesaikan.
Larang force push dan deletion; terapkan pada admin bila tersedia dan periksa bypass.
Simpan screenshot pengaturan aktif. Keberadaan panduan ini tidak membuktikan proteksi aktif.
Jika izin/paket GitHub membatasi fitur, catat dan minta admin menanganinya tanpa
mengubah visibilitas repo sepihak.

## Verifikasi sebelum PR
Pemeriksaan aplikasi: composer install; php artisan route:list --path=api; php artisan test; vendor/bin/pint --test.
Dokumentasi diperiksa konsistensi arsitektur, tautan relatif dan git diff --check.
Perubahan aplikasi membutuhkan pemeriksaan perilaku yang relevan.
Tulis BELUM DIJALANKAN beserta alasan bila pemeriksaan terhalang.

## Rules AI aktif dan log
Codex menemukan AGENTS.override.md dan diarahkan membaca agents.md.
Buka repo sebagai root proyek dan mulai sesi baru; sesi lama belum tentu memuat file baru.
Minta AI menyebut sumber instruksi dan batas arsitektur, lalu rekam screenshot hasil aktual
pada masing-masing repo. Lakukan tes perilaku; file rules saja bukan bukti kepatuhan.
Referensi: https://learn.chatgpt.com/docs/agent-configuration/agents-md

Gunakan Prompt 2 dan Prompt 3 persis dari dosen. Untuk setiap repo catat prompt, respons,
tindakan/file/diff, waktu, commit dan hasil kepatuhan. PDF satu halaman dibuat setelah
tes benar-benar berlangsung. Jangan menulis hasil lulus sebelum ada bukti.

## Rollback
Ikuti [rencana rollback](rollback_demo.md) setelah nomor skenario cocok dengan petunjuk dosen.
Perubahan rusak hanya di feature/rollback-demo, jangan main/dev.
Untuk commit shared, gunakan revert dan PR. Perubahan belum di-commit hanya boleh di-restore
pada file demo yang sengaja diubah setelah meninjau diff; jangan hilangkan pekerjaan lain.

## Kriteria selesai
Artefak kedua repo terunggah; main/dev/feature terlihat; main benar-benar protected;
minimal satu PR direview anggota lain dan merged; screenshot aktual lengkap;
PDF satu halaman memakai Prompt 2/3 asli; video tiga menit mengikuti skenario dosen;
online text memakai permalink commit serta URL PR/video yang dapat diakses.
