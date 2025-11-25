# Lab9Web

- Nama : Roufan Awaluna Romadhon
- NIM : 31240423
- Kelas : TI.24.A.3

---

## Deskripsi

Tugas ini untuk memahami konsep dasar Modularisasi Program, memaham konsep dasar fungsi pada php, membuat program sederhana menggunakan PHP dan mengimplementasikan penggunaan fungsi pada PHP.

## Langkah-langkah

Buat file baru dengan nama header.php

```php
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Contoh Modularisasi</title>
    <link  href="style.css"  rel="stylesheet"  type="text/stylesheet"  media="screen" />
</head>
<body>
    <div class="container">
    <header>
        <h1>Modularisasi Menggunakan Require</h1>
    </header>
    <nav>
        <a href="home.php">Home</a>
        <a href="about.php">Tentang</a>
        <a href="kontak.php">Kontak</a>
    </nav>
```

Buat file baru dengan nama footer.php

```php
        <footer>
            <p>&copy; 2021, Informatika, Universitas Pelita Bangsa</p>
        </footer>
    </div>
</body>
</html>
```

Buat file baru dengan nama home.php

```php
<?php require('header.php'); ?>

<div class="content">
    <h2>Ini Halaman Home</h2>
    <p>Ini adalah bagian content dari halaman.</p>
</div>
<?php require('footer.php'); ?>
```

Buat file baru dengan nama about.php

```php
<?php require('header.php'); ?>

<div class="content">
    <h2>Ini Halaman About</h2>
    <p>Ini adalah bagian content dari halaman.</p>
</div>
<?php require('footer.php'); ?>
```

## Pertanyaan dan Tugas

Implementasikan konsep modularisasi pada kode program praktikum 8 tentang database, sehingga setiap halamannya memiliki template tampilan yang sama. Dan terapkan penggunaan Routing agar project menjadi lebih modular.
Gunakan struktur direktory seperti berikut:

Routing menggunakan url: index.php?page=user/list

Opsional: Gunakan htaccess agar url lebih SEO Friendly.
Contoh URL: (base-domain)/user/list
