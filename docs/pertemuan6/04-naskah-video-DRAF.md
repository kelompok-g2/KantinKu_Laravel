# Naskah video rollback tiga menit - DRAF

BELUM DIREKAM. Definisi skenario 2/3 dosen belum diberikan. Pilih salah satu hanya
setelah membaca petunjuk aslinya; dokumen ini tidak mengarang nomor skenario.

## Lengkapi sebelum merekam
- Repo/aplikasi yang ditunjukkan: [ISI sesuai tugas dosen]
- Nomor dan teks skenario dosen: [ISI]
- Branch demo: feature/rollback-demo
- Commit baseline normal: [ISI setelah aplikasi berhasil dijalankan]
- File dan perubahan rusak yang disengaja: [ISI]
- Pemeriksaan normal/gagal/pulih yang sama: [ISI]
- Mekanisme/perintah rollback yang cocok dengan skenario: [ISI setelah dikonfirmasi]

## 00:00-00:30 - keadaan normal
Narasi: "Ini proyek KantinKu pada branch [ISI], commit [ISI]. Sebelum perubahan,
aplikasi berjalan normal seperti yang terlihat pada [HASIL AKTUAL]."
Tampilkan identitas repo, status Git bersih dan aplikasi. Jangan pakai cuplikan hasil palsu.

## 00:30-01:15 - perubahan rusak
Narasi: "Saya mengubah [FILE] pada branch demo. Dampak perubahan ini adalah [HASIL GAGAL AKTUAL]."
Tampilkan diff dan pemeriksaan yang gagal. Kerusakan tidak boleh menyentuh main/dev,
rahasia, database pengguna atau pekerjaan anggota lain.

## 01:15-02:15 - rollback
Narasi: "Sesuai skenario [NOMOR ASLI DOSEN], saya mengembalikan perubahan dengan
[MEKANISME YANG SUDAH DICOCOKKAN]. Riwayat shared branch tidak ditulis ulang."
Tampilkan status/log/diff dan tindakan aktual. Commit shared memakai revert melalui
alur review kelompok; jangan force push. Jangan menggunakan reset/restore menyeluruh.
Pastikan perubahan file yang dikembalikan memang milik demo dan sudah ditinjau.

## 02:15-03:00 - kembali normal
Narasi: "Pemeriksaan yang sama sekarang menghasilkan [HASIL PULIH AKTUAL]. Aplikasi
kembali ke perilaku awal, dan status Git terakhir adalah [HASIL AKTUAL]."
Tampilkan aplikasi normal dan status Git. Simpan SHA sebelum/rusak/sesudah pada log.

## Setelah merekam
Unggah ke Drive atau YouTube unlisted; uji akses dari jendela tanpa login jika diizinkan.
Catat tautan pada bukti/video/tautan-video.md dan online text. Jangan menandai selesai
hanya karena naskah sudah tersedia. Jika dosen meminta dua aplikasi, sesuaikan pembagian
durasi tanpa menyatakan satu aplikasi mewakili yang lain.
