## Honda Product Manager

Aplikasi web sederhana berbasis **PHP** dan **MySQL** untuk mengelola data produk unit kendaraan Honda (*Create, Read, Update, Delete* / CRUD). Aplikasi ini dirancang dengan antarmuka yang modern, responsif, dan telah dilengkapi dengan perlindungan keamanan standar seperti token CSRF dan *Prepared Statements*.
<img width="803" height="434" alt="Hasisl projek manger" src="https://github.com/user-attachments/assets/eacfc8d3-1770-4fcc-a65c-feb0024b2e62" />

---

## Fitur Utama

- **Dashboard Unit Honda**: Menampilkan daftar produk kendaraan Honda dalam bentuk kartu (*card grid*) yang rapi dan responsif.
- **Manajemen Data (CRUD)**:
  - **Tambah Produk**: Menambahkan unit kendaraan Honda baru ke basis data.
  - **Ubah Produk**: Memperbarui informasi unit kendaraan yang sudah ada.
  - **Hapus Produk**: Menghapus data unit kendaraan dari basis data.
- **Keamanan (Security)**:
  - **CSRF Token Protection**: Mencegah serangan *Cross-Site Request Forgery* pada formulir input.
  - **Prepared Statements (PDO/MySQLi)**: Mencegah serangan *SQL Injection*.
- **Desain Modern & Terpisah**: Antarmuka berbasis CSS modern dengan struktur kode yang rapi dan terpisah (`css/style.css` & `includes/header.php`).

---

## Teknologi yang Digunakan

- **Language**: PHP (v7.4 / v8.x)
- **Database**: MySQL / MariaDB
- **Styling**: HTML5, CSS3 (Custom Dark/Red Honda Theme)
- **Environment**: XAMPP / Laragon / Local Web Server

---

## Struktur Folder

```text
honda-product-manager/
├── css/
│   └── style.css          # File styling utama aplikasi
├── includes/
│   └── header.php         # Header aplikasi & pemanggilan CSS
├── config.php             # Konfigurasi koneksi ke database MySQL
├── index.php              # Halaman utama (Daftar Produk)
├── create.php             # Halaman tambah produk
├── update.php             # Halaman edit produk
├── delete.php             # Proses hapus produk
└── README.md              # Dokumentasi proyek
