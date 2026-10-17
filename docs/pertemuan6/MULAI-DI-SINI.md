# Hasil pengujian terbaru

Pengujian manual konfirmasi dan jebakan telah dilaksanakan pada sesi Codex aktif setelah aturan dibaca eksplisit. Buka [PDF log satu halaman](Log-Test-Prompt-2-3-KantinKu.pdf) dan [respons lengkap](Log-Test-Prompt-2-3-KantinKu.md). Nomor P2/P3 merupakan penamaan kerja dari dua jenis uji pada bagian 11 materi; bukan kutipan prompt bernomor. Penilaian dilakukan oleh asisten yang sama. Bukti penemuan rules otomatis pada sesi IDE baru, tes aplikasi, review anggota lain dan video rollback tetap terpisah. Bagian persiapan di bawah adalah catatan sebelumnya.

# Paket persiapan Tugas Pertemuan 6 - KantinKu

Disiapkan 17 Oktober 2026. Deadline dari foto tugas: 22 Oktober 2026 pukul 08:12;
pastikan zona waktu yang ditampilkan LMS. Paket ini BELUM merupakan pengumpulan final.

## Yang sudah tersedia
- Dua repo di D:/KantinKu-P06 beserta dokumentasi awal Kelompok-G.
- agents.md, AGENTS.override.md, docs/project_guidelines.md dan pemetaan rancangan awal.
- Branch main, dev, feature/context-management di kedua repo.
- PR Flutter #1 dan Laravel #1 menuju dev; status terakhir diperiksa masih terbuka.
- Formulir log satu halaman, teks pengumpulan, panduan admin/reviewer, naskah video
  dan tempat penyimpanan bukti. Template bukan hasil tes.

## Urutan kerja - lakukan satu baris lalu verifikasi
| Urutan | Tindakan | Verifikasi |
|---|---|---|
| 1 | Admin mengikuti 01-panduan-admin-review.md untuk melindungi main di kedua repo | Rule main aktif dan screenshot pengaturan disimpan |
| 2 | Anggota lain membaca PR terbaru, mengirim review yang sesuai hasil pemeriksaan | Review tampil dengan akun anggota lain dan status yang benar |
| 3 | Setelah review dan diskusi selesai, merge PR fitur ke dev; buat PR dev ke main | Status Merged dan commit dokumen masuk main melalui PR |
| 4 | Buka sesi AI baru di root masing-masing repo, ikuti 02-panduan-bukti.md | AI menyebut aturan aktual; screenshot asli disimpan |
| 5 | Dapatkan Prompt 2/3 dan skenario 2/3 asli dari dosen | Teks lengkap dan nomor skenario tercatat |
| 6 | Siapkan toolchain, jalankan aplikasi dan tes yang relevan | Hasil nyata disimpan; jangan tulis lulus untuk tes yang belum dijalankan |
| 7 | Jalankan Prompt 2/3, isi log sumber dan PDF satu halaman | Empat kasus (2 prompt x 2 repo) memiliki hasil dan bukti |
| 8 | Rekam video sesuai skenario dosen dengan naskah 04 | Terlihat normal, rusak, rollback dan normal lagi |
| 9 | Isi tautan kosong pada 05-online-text-DRAF.md | Semua tautan bisa dibuka, termasuk video |
| 10 | Lengkapi 06-checklist-final.md lalu unggah bukti ke LMS | Tidak ada template/klaim tanpa bukti pada pengumpulan final |

## Berkas utama
- 01-panduan-admin-review.md: panduan admin, reviewer dan merge.
- 02-panduan-bukti.md: aturan screenshot dan verifikasi AI rules.
- 03-log-test-SUMBER.md dan 03-log-test.csv: catatan rinci yang bisa diedit.
- Log-Test-Prompt-2-3-KantinKu.pdf: formulir interaktif satu halaman, BELUM DIUJI.
- 04-naskah-video-DRAF.md: alur rekaman; mekanisme rollback menunggu dosen.
- 05-online-text-DRAF.md: teks dengan permalink dokumen dan PR yang nyata.
- 06-checklist-final.md: audit pengumpulan.
- bukti/: tempat screenshot, log dan tautan video asli.
- Flutter/ dan Laravel/: salinan artefak dokumentasi masing-masing repo.

Jangan mengunggah template PDF sebagai log tes final. Jangan menaruh .env, token,
password, data pribadi atau dependency hasil instalasi di paket/GitHub.
