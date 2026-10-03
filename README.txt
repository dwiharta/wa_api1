PROJECT API WHATSAPP - FONNTE
==============================

1. Copy folder "project-api-fonnte" ke:
   C:\xampp\htdocs\

2. Jalankan XAMPP:
   - Apache
   - MySQL

3. Buka phpMyAdmin:
   http://localhost/phpmyadmin

4. Import file:
   database.sql

5. Edit:
   config/fonnte.php

   Ganti:
   define("FONNTE_TOKEN", "TOKEN_FONNTE_ANDA");

   menjadi token Fonnte Anda.

6. Buka:
   http://localhost/project-api-fonnte/register.html

URUTAN PENGUJIAN
================
A. Register akun baru.
B. Cek data pada tabel users.
C. Cek WhatsApp masuk ke nomor yang didaftarkan.
D. Login menggunakan akun tersebut.
E. Edit profil.
F. Cek notifikasi WhatsApp.
G. Cek tabel log_whatsapp.
H. Hapus akun.
I. Cek notifikasi penghapusan.
J. Coba login kembali dengan akun yang sudah dihapus.

CATATAN
=======
- Endpoint Fonnte menggunakan https://api.fonnte.com/send.
- Nomor WhatsApp boleh ditulis 08xxxxxxxxxx.
- Sistem mengubahnya menjadi format 62xxxxxxxxxx saat mengirim.
- Jika token Fonnte belum diisi, data tetap diproses tetapi log WhatsApp
  akan mencatat bahwa token belum dikonfigurasi.
- Password menggunakan password_hash() dan diverifikasi dengan password_verify().
