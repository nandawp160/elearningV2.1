# Rules for Browser & DOM Testing

1. **JANGAN** jalankan alat pengujian browser atau inspeksi DOM setiap kali kamu mengubah atau menyimpan file kode.
2. Gunakan otomatisasi browser **HANYA** sebagai langkah verifikasi akhir setelah seluruh fitur selesai diimplementasikan.
3. **Safety Boundary**: Kamu **WAJIB** meminta persetujuan eksplisit (*explicit approval*) dari saya sebelum membuka instance browser.
4. **Keep it narrow**: Saat meminta izin pengujian, sebutkan halaman yang akan diuji, skenario output yang diharapkan, dan pastikan kamu mengembalikan artefak berupa screenshot atau log yang jelas.
5. Jalankan proses pengujian berat sebagai async background task agar tidak membekukan editor/workspace.
