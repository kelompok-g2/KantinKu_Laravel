# Panduan singkat admin, reviewer dan merge

## A. Admin melindungi main - ulangi untuk kedua repo
Repo Flutter: https://github.com/kelompok-g2/Kantinku---flutter
Repo Laravel: https://github.com/kelompok-g2/KantinKu_Laravel

1. Login dengan akun admin repo, buka Settings. Verifikasi nama owner kelompok-g2.
2. Buka Branches, pada Branch protection rules pilih Add classic branch protection rule.
   Jika organisasi memakai ruleset, gunakan padanan pengaturan di ruleset aktif.
3. Isi Branch name pattern: main. Verifikasi target tepat main.
4. Aktifkan Require a pull request before merging dan Require approvals, jumlah 1.
5. Aktifkan Dismiss stale pull request approvals when new commits are pushed serta
   Require conversation resolution before merging.
6. Aktifkan Do not allow bypassing the above settings bila tersedia. Jangan tambahkan
   bypass aktor. Biarkan Allow force pushes dan Allow deletions tidak dicentang.
7. Simpan perubahan. Buka kembali rule untuk memverifikasi tersimpan, lalu ambil screenshot.
8. Ulangi untuk repo satunya. Jangan mencoba push rusak ke main untuk membuktikan proteksi.

Izin Write cukup untuk kontribusi, tetapi pengaturan ini perlu admin atau izin edit rules.
Jika tombol berbeda/tidak tersedia, admin perlu memeriksa kebijakan organisasi/paket GitHub.
Jangan mengubah visibilitas repo untuk mengatasi kendala tanpa keputusan kelompok.

## B. Anggota lain mereview perubahan terbaru
PR Flutter: https://github.com/kelompok-g2/Kantinku---flutter/pull/1
PR Laravel: https://github.com/kelompok-g2/KantinKu_Laravel/pull/1

1. Login sebagai anggota selain pembuat PR. Buka salah satu PR dan tab Files changed.
2. Baca aturan MVVM/MVC, larangan force push, panduan serta batasan bukti.
3. Pastikan tidak ada rahasia dan klaim tes palsu; dokumen tidak mengubah perilaku aplikasi.
4. Klik Review changes. Tulis temuan yang benar-benar diperiksa.
5. Pilih Approve bila layak; pilih Request changes bila perlu diperbaiki; Submit review.
6. Verifikasi review tampil dari akun reviewer yang benar. Ulangi repo lainnya.

Komentar biasa atau review AI bukan pengganti persetujuan anggota lain. Bila commit baru
masuk setelah review, reviewer perlu memeriksa versi terbaru dan memperbarui review bila perlu.

## C. Menggabungkan perubahan
1. Pastikan PR fitur menuju dev, review sesuai, dan percakapan selesai.
2. Anggota yang berwenang memilih Merge pull request, lalu konfirmasi; verifikasi badge Merged.
3. Pertahankan feature/context-management sampai screenshot branch direkam.
4. Buat PR kedua dengan base main dan compare dev. Jelaskan rilis dokumentasi P06.
5. Anggota lain mereview PR dev ke main. Merge setelah seluruh aturan main terpenuhi.
6. Verifikasi agents.md dan docs/project_guidelines.md terlihat di main kedua repo.

Jangan melewati proteksi, menggunakan akun teman untuk review, atau force push shared branch.
Simpan link PR rilis dev ke main pada teks pengumpulan setelah benar-benar dibuat.

Sumber resmi:
- https://docs.github.com/en/repositories/configuring-branches-and-merges-in-your-repository/managing-protected-branches/managing-a-branch-protection-rule
- https://docs.github.com/en/pull-requests/how-tos/review-pull-requests/reviewing-proposed-changes-in-a-pull-request
