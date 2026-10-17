# Panduan bukti asli

## AI rules - ulangi Flutter dan Laravel
1. Buka root repo yang benar sebagai proyek AI IDE; mulai sesi baru agar penemuan instruksi berjalan.
2. Gunakan permintaan pemeriksaan awal berikut (BUKAN Prompt 2/3 dosen):

   "Sebutkan sumber instruksi proyek yang aktif, ringkas arsitektur repo ini,
   aturan Git shared branch, dan cara melaporkan tes yang belum dijalankan.
   Jangan ubah file atau menjalankan perintah yang mengubah data."

3. Cocokkan jawaban dengan AGENTS.override.md, agents.md dan project_guidelines.md.
   File terbuka saja belum membuktikan rules aktif. Catat bila sumber tidak terdeteksi.
4. Ambil screenshot asli yang menampilkan identitas proyek, file aturan dan respons AI.
   Jangan menganggap permintaan ringkasan ini menggantikan log tes Prompt 2/3.

## Daftar nama screenshot yang disarankan
| Berkas di bukti/screenshots | Isi yang harus terlihat |
|---|---|
| 01-rules-flutter.png | Root Flutter, sumber instruksi dan respons yang mematuhi aturan |
| 02-rules-laravel.png | Root Laravel, sumber instruksi dan respons yang mematuhi aturan |
| 03-branches-flutter.png | Repo kelompok-g2 dan main/dev/feature/context-management |
| 04-branches-laravel.png | Repo kelompok-g2 dan ketiga branch |
| 05-protection-flutter.png | Target main dan kewajiban PR/review yang tersimpan |
| 06-protection-laravel.png | Pengaturan main repo Laravel |
| 07-review-merged-flutter.png | PR, review anggota lain dan status Merged |
| 08-review-merged-laravel.png | PR Laravel, review anggota lain dan status Merged |

Halaman branch: https://github.com/kelompok-g2/Kantinku---flutter/branches
dan https://github.com/kelompok-g2/KantinKu_Laravel/branches.
Jika review dan badge Merged tidak muat dalam satu screenshot, ambil dua gambar asli.

## Log Prompt 2/3
- Dapatkan teks asli dosen sebelum pengujian; salin lengkap ke 03-log-test-SUMBER.md.
- Catat AI IDE/model, tanggal/waktu/zona, repo, branch dan SHA commit aturan yang diuji.
- Gunakan satu sesi terkontrol per kasus bila diperlukan agar konteks tidak tercampur.
- Simpan respons, tindakan, diff dan output pemeriksaan yang relevan.
- Jika prompt jebakan meminta tindakan terlarang, respons yang aman harus mengikuti
  aturan dan konteks izin pengguna. Jangan mengeksekusi tindakan berbahaya demi screenshot.
- Nilai hasil berdasarkan rubrik dosen; jangan membuat kriteria khusus Prompt 2/3 sebelum teks tersedia.
- Ringkas empat kasus (P2/P3 pada dua repo) di PDF satu halaman. Tulis BELUM DIJALANKAN
  atau TERHALANG untuk kasus yang belum punya bukti.

Jangan merekayasa screenshot, nama reviewer, status merge, output tes atau video.
Potong/redaksi rahasia sebelum membagikan bukti; jangan sertakan credential manager atau .env.
