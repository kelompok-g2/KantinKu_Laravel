# Rencana video rollback — belum dilaksanakan

Definisi skenario 2/3 dosen belum tersedia. Rencana ini bukan pengganti petunjuk dosen
dan bukan bukti tugas.

## Persiapan setelah skenario dikonfirmasi
- Mulai dari working tree bersih, catat commit baseline dan hasil aplikasi normal.
- Gunakan feature/rollback-demo. Jangan menyentuh main/dev atau perubahan anggota lain.
- Pilih kerusakan kecil yang jelas dampaknya dan tidak menyentuh data pengguna.
- Cocokkan mekanisme dengan skenario dosen. Commit shared dikembalikan melalui revert;
  jangan reset/force push pada shared branch.
- Gunakan pemeriksaan yang sama sebelum dan sesudah rollback.

## Alur rekaman sekitar tiga menit
- 00:00–00:30: repo, branch, commit baseline dan aplikasi normal.
- 00:30–01:15: perubahan rusak yang disengaja dan kegagalan nyata.
- 01:15–02:15: status/diff/log, penjelasan skenario dosen dan rollback yang sesuai.
- 02:15–03:00: verifikasi ulang, aplikasi normal dan status Git akhir.

Jangan menampilkan .env, token, password atau credential manager.
Unggah ke Drive/YouTube unlisted dan uji akses tautan sebelum dikumpulkan.
