# Project API WA - PHP + MySQL + Fonnte

Project ini menggunakan:
- PHP Native
- MySQL
- PHP Session
- password_hash/password_verify
- JavaScript Fetch API
- Fonnte WhatsApp API

## Struktur

project-api-fonnte/
├── api/
│   ├── register.php
│   ├── login.php
│   ├── update_profile.php
│   └── delete_account.php
├── config/
│   ├── database.php
│   └── fonnte.php
├── functions/
│   └── fonnte.php
├── index.php
├── register.php
├── login.php
├── dashboard.php
├── logout.php
└── database.sql

## Penting tentang GitHub

File PHP boleh disimpan dan dikelola di GitHub sebagai repository source code.
Namun GitHub Pages TIDAK menjalankan PHP.

Jadi:
GitHub = tempat menyimpan source code
Hosting PHP/MySQL = tempat menjalankan aplikasi

Jangan aktifkan GitHub Pages untuk menjalankan project PHP ini.

## Setup

1. Buat database MySQL bernama api_wa_fonnte.
2. Import database.sql.
3. Edit config/database.php:
   - $db_host
   - $db_name
   - $db_user
   - $db_pass
4. Edit config/fonnte.php dan isi token Fonnte di SERVER.
5. Pastikan hosting memiliki PHP cURL.
6. Buka register.php.

## Fonnte

Endpoint yang digunakan:
https://api.fonnte.com/send

Token tidak boleh ditaruh di JavaScript/frontend.
Jangan commit token Fonnte asli ke repository GitHub publik.

## Alur

register.php
 -> api/register.php
 -> MySQL
 -> Fonnte -> WhatsApp

login.php
 -> api/login.php
 -> PHP Session
 -> dashboard.php

dashboard.php
 -> api/update_profile.php
 -> MySQL
 -> Fonnte

dashboard.php
 -> api/delete_account.php
 -> MySQL
 -> Fonnte
 -> logout/session destroy
