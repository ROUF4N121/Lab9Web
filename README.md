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

```
project/
│── index.php
│── config/
│   └── database.php
│── views/
│   ├── header.php
│   ├── footer.php
│   └── dashboard.php
│── modules/
│   ├── user/
│   │   ├── list.php
│   │   └── add.php
│   └── auth/
│       ├── login.php
│       └── logout.php
│── assets/
    ├── css/
    └── js/
```

Routing menggunakan url: index.php?page=user/list

Opsional: Gunakan htaccess agar url lebih SEO Friendly.
Contoh URL: (base-domain)/user/list

### Jawab

Oke, Praktik ini kita akan membuat sebuah admin console jadi saya menambahkan 5 file tambahan. jadi strukturnya:

```
project/
│── index.php
│── config/
│   └── database.php
│── views/
│   ├── header.php
│   ├── footer.php
│   └── dashboard.php
│── modules/
│   ├── user/
│   │   ├── add.php
│   │   |── list.php
│   │   |── delete.php
│   │   └── edit.php
│   └── auth/
│       ├── login.php
│       └── logout.php
│── assets/
    ├── css/
        |── style.css
        |── login.css
    └── js/
        |── script.js
```

#### Sebelum itu kita haru buat database. kali ini saya membuat database dengan 2 tabel.

```sql
CREATE DATABASE latihan_user;

USE latihan_user;

CREATE TABLE data_user (
    id_user INT(10) AUTO_INCREMENT PRIMARY KEY,
    nama VARCHAR(50),
    email VARCHAR(50),
    gender ENUM('Laki-laki', 'Perempuan'),
    tanggal_lahir DATE,
    telepon VARCHAR(20),
    alamat VARCHAR(100)
);

CREATE TABLE users_login (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50),
    password VARCHAR(100)
);

INSERT INTO users_login (username, password)
VALUES ('admin', MD5('admin123'));
```

#### Sekarang kita mulai program utamanya.

#### Buat file baru dengan nama index.php

```php
<?php
session_start();

if (!isset($_SESSION['login'])) {
    header("Location: modules/auth/login.php");
    exit;
}

include 'config/database.php';
include 'views/header.php';

$page = isset($_GET['page']) ? $_GET['page'] : "dashboard";

if ($page === "dashboard") {
    include "views/dashboard.php";
}
else if (file_exists("modules/" . $page . ".php")) {
    include "modules/" . $page . ".php";
}
else {
    include "modules/error/404.php";
}

include 'views/footer.php';
?>
```

#### Buat folder baru bernama config dan buat file database.php

```php
<?php
$host = "localhost";
$user = "root";
$pass = "";
$db   = "latihan_user";

$conn = mysqli_connect($host, $user, $pass, $db);

if (!$conn) {
    die("Koneksi gagal: " . mysqli_connect_error());
}
?>
```

#### Sekarang, buat folder views yang berisi header.php, footer.php dan dashboard.php

1. header.php
```php
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Console</title>
    <link rel="stylesheet" href="assets/css/style.css">
    <script src="assets/js/script.js"></script>
</head>
<body>
<div class="container">
    <header>
        <h1>Admin Console</h1>
    </header>

    <nav>
        <a href="index.php">Dashboard</a>
        <a href="index.php?page=user/list">Data User</a>
        <a href="index.php?page=user/add">Tambah User</a>

        <a style="float:right; background:red;" 
       href="modules/auth/logout.php">Logout</a>
    </nav>

    <main>
```

2. footer.php
```php
    </main>

    <footer>
        <p>&copy; 2025 - TI.24.A.3 - Roufan Awaluna Romadhon</p>
    </footer>
</div>
</body>
</html>
```

3. dashboard.php
```php
<?php
$sqlCount = "SELECT COUNT(*) AS total FROM data_user";
$resultCount = mysqli_query($conn, $sqlCount);
$totalUser = mysqli_fetch_assoc($resultCount)['total'];

$tanggal = date("l, d F Y");
?>

<div class="dashboard">
    <h2>Selamat Datang, <?= $_SESSION['username']; ?> 👋</h2>
    <p class="subtitle">Halo. Gunakan dasbor ini untuk memantau aktivitas sistem dan mengelola pengaturan utama.</p>

    <div class="datetime-box">
        <p><b>Tanggal:</b> <?= $tanggal; ?></p>
        <p><b>Waktu:</b> <span id="jam"></span></p>
    </div>

    <div class="card-container">
        <div class="card">
            <h3>👥 Total Users</h3>
            <p><?= $totalUser ?> User Terdaftar</p>
        </div>
    </div>
</div>

<script>
setInterval(() => {
    let waktu = new Date();
    document.getElementById("jam").innerHTML = 
        waktu.getHours().toString().padStart(2, '0') + ":" +
        waktu.getMinutes().toString().padStart(2, '0') + ":" +
        waktu.getSeconds().toString().padStart(2, '0');
}, 1000);
</script>
```

#### Sekarang, buat folder bernama modules dan folder tersebut diisi lagi folder user dan auth

#### Di folder user buat 4 file add.php, list.php, delete.php dan edit.php

1. add.php
```php
<?php
if (isset($_POST['submit'])) {
    $nama   = $_POST['nama'];
    $email  = $_POST['email'];
    $gender = $_POST['gender'];
    $tgl    = $_POST['tanggal_lahir'];
    $telp   = $_POST['telepon'];
    $alamat = $_POST['alamat'];

    $sql = "INSERT INTO data_user (nama, email, gender, tanggal_lahir, telepon, alamat)
            VALUES ('$nama', '$email', '$gender', '$tgl', '$telp', '$alamat')";
    mysqli_query($conn, $sql);

    echo "<script>alert('User berhasil ditambahkan');</script>";
    echo "<script>window.location='index.php?page=user/list'</script>";
}
?>

<h2>Tambah User</h2>

<form method="POST">
    <label>Nama:</label><br>
    <input type="text" name="nama" required><br><br>

    <label>Email:</label><br>
    <input type="email" name="email" required><br><br>

    <label>Gender:</label><br>
    <select name="gender">
        <option value="Laki-laki">Laki-laki</option>
        <option value="Perempuan">Perempuan</option>
    </select><br><br>

    <label>Tanggal Lahir:</label><br>
    <input type="date" name="tanggal_lahir"><br><br>

    <label>No. Telepon:</label><br>
    <input type="text" name="telepon"><br><br>

    <label>Alamat:</label><br>
    <textarea name="alamat"></textarea><br><br>

    <button type="submit" name="submit">Simpan</button>
</form>
```

2. list.php
```php
<?php
$sql = "SELECT * FROM data_user";
$result = mysqli_query($conn, $sql);
?>

<h2>Daftar User</h2>

<a href="index.php?page=user/add">
    <button>Tambah User</button>
</a>

<table border="1" cellpadding="8" cellspacing="0">
    <tr>
        <th>Nama</th>
        <th>Email</th>
        <th>Gender</th>
        <th>Tanggal Lahir</th>
        <th>Telepon</th>
        <th>Alamat</th>
        <th>Aksi</th>
    </tr>

    <?php while ($row = mysqli_fetch_assoc($result)): ?>
    <tr>
        <td><?= $row['nama'] ?></td>
        <td><?= $row['email'] ?></td>
        <td><?= $row['gender'] ?></td>
        <td><?= $row['tanggal_lahir'] ?></td>
        <td><?= $row['telepon'] ?></td>
        <td><?= $row['alamat'] ?></td>

        <td>
            <a href="index.php?page=user/edit&id=<?= $row['id_user'] ?>">Edit</a> | 

            <a 
                href="index.php?page=user/delete&id=<?= $row['id_user'] ?>" 
                onclick="return confirm('Yakin ingin menghapus user ini?')"
                style="color:red;"
            >Hapus</a>
        </td>
    </tr>
    <?php endwhile; ?>
</table>
```

3. delete.php
```php
<?php
include 'config/database.php';

$id = $_GET['id'];

$sql = "DELETE FROM data_user WHERE id_user = '$id'";
mysqli_query($conn, $sql);

echo "<script>alert('User berhasil dihapus');</script>";
echo "<script>window.location='index.php?page=user/list'</script>";
?>
```

4. edit.php
```php
<?php
include 'config/database.php';

$id = $_GET['id'];

$sql = "SELECT * FROM data_user WHERE id_user = '$id'";
$result = mysqli_query($conn, $sql);
$data = mysqli_fetch_assoc($result);

if (isset($_POST['submit'])) {
    $nama   = $_POST['nama'];
    $email  = $_POST['email'];
    $gender = $_POST['gender'];
    $tgl    = $_POST['tanggal_lahir'];
    $telp   = $_POST['telepon'];
    $alamat = $_POST['alamat'];

    $update = "UPDATE data_user SET 
                nama='$nama',
                email='$email',
                gender='$gender',
                tanggal_lahir='$tgl',
                telepon='$telp',
                alamat='$alamat'
               WHERE id_user='$id'";

    mysqli_query($conn, $update);

    echo "<script>alert('Data user berhasil diperbarui');</script>";
    echo "<script>window.location='index.php?page=user/list'</script>";
}
?>

<h2>Edit User</h2>

<form method="POST">
    <label>Nama:</label><br>
    <input type="text" name="nama" value="<?= $data['nama'] ?>" required><br><br>

    <label>Email:</label><br>
    <input type="email" name="email" value="<?= $data['email'] ?>" required><br><br>

    <label>Gender:</label><br>
    <select name="gender" required>
        <option value="Laki-laki" <?= ($data['gender'] == 'Laki-laki') ? 'selected' : '' ?>>Laki-laki</option>
        <option value="Perempuan" <?= ($data['gender'] == 'Perempuan') ? 'selected' : '' ?>>Perempuan</option>
    </select><br><br>

    <label>Tanggal Lahir:</label><br>
    <input type="date" name="tanggal_lahir" value="<?= $data['tanggal_lahir'] ?>"><br><br>

    <label>No. Telepon:</label><br>
    <input type="text" name="telepon" value="<?= $data['telepon'] ?>"><br><br>

    <label>Alamat:</label><br>
    <textarea name="alamat"><?= $data['alamat'] ?></textarea><br><br>

    <button type="submit" name="submit">Update</button>
</form>
```

#### Di folder auth buat 2 file login.php dan logout.php

1. login.php
```php
<?php
session_start();
include '../../config/database.php';

if (isset($_POST['submit'])) {
    $username = $_POST['username'];
    $password = md5($_POST['password']);

    $sql = "SELECT * FROM users_login 
            WHERE username='$username' AND password='$password'";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        $_SESSION['login'] = true;
        $_SESSION['username'] = $username;

        header("Location: ../../index.php");
        exit;
    } else {
        $error = "Username atau password salah!";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <link rel="stylesheet" href="../../assets/css/login.css">
</head>
<body>

<div class="login-box">
    <h2>Login Admin</h2>

    <form method="POST">
        <input type="text" name="username" placeholder="Username" required>

        <input type="password" name="password" placeholder="Password" required>

        <button type="submit" name="submit">Login</button>

        <?php if (isset($error)): ?>
            <p class="error"><?= $error ?></p>
        <?php endif; ?>
    </form>
</div>

</body>
</html>
```

2. logout.php
```php
<?php
session_start();
session_destroy();

echo "<script>alert('Anda berhasil logout');</script>";
echo "<script>window.location='login.php'</script>";
?>
```

#### Sekarang, buat folder bernama assets dan folder tersebu berisi folder css dan js

#### di folder css diisi style.css dan login.css

1. style.css
```css
body {
    font-family: Arial, sans-serif;
    background: #f4f4f4;
    margin: 0;
    padding: 0;
}

.container {
    width: 85%;
    margin: 20px auto;
    background: white;
    padding: 20px;
    border-radius: 8px;
}

header {
    text-align: center;
    padding: 10px 0;
    border-bottom: 2px solid #ddd;
}

nav {
    margin: 15px 0;
    background: #007bff;
    padding: 10px;
    border-radius: 5px;
}

nav a {
    color: white;
    padding: 8px 12px;
    margin-right: 10px;
    text-decoration: none;
    border-radius: 3px;
}

nav a:hover {
    background: #0056b3;
}

main {
    margin-top: 20px;
}

footer {
    margin-top: 30px;
    text-align: center;
    padding: 10px;
    background: #eee;
    border-radius: 5px;
}

/* Table */
table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 15px;
}

table, th, td {
    border: 1px solid #ddd;
    padding: 10px;
}

th {
    background: #f0f0f0;
}

/* Form */
input, select {
    padding: 8px;
    margin: 5px 0 10px;
    width: 50%;
}

button, input[type="submit"] {
    background: #28a745;
    border: none;
    padding: 10px 15px;
    color: white;
    border-radius: 4px;
    cursor: pointer;
}

button:hover, input[type="submit"]:hover {
    background: #218838;
}
```

2. login.css
```css
body {
    margin: 0;
    padding: 0;
    font-family: Arial, sans-serif;
    background: linear-gradient(135deg, #007bff, #00c6ff);
    height: 100vh;
    display: flex;
    justify-content: center;
    align-items: center;
}

.login-box {
    width: 350px;
    background: white;
    padding: 25px;
    border-radius: 10px;
    box-shadow: 0px 5px 15px rgba(0,0,0,0.3);
    text-align: center;
}

.login-box h2 {
    margin-bottom: 20px;
    color: #333;
}

.login-box input {
    width: 100%;
    padding: 10px;
    margin: 8px 0;
    font-size: 15px;
    border: 1px solid #aaa;
    border-radius: 5px;
}

.login-box button {
    width: 100%;
    padding: 10px;
    background: #007bff;
    border: none;
    color: white;
    font-size: 16px;
    border-radius: 5px;
    cursor: pointer;
}

.login-box button:hover {
    background: #0056b3;
}

.error {
    margin-top: 10px;
    color: red;
}
```

#### di folder js diisi file script.js

1. script.js
```js
console.log("JS Loaded!");

function confirmDelete() {
    return confirm("Yakin ingin menghapus data?");
}

<a href="index.php?page=user/delete&id=<?= $row['id_user'] ?>" 
   onclick="return confirmDelete()"
   style="color:red;">Hapus</a>
```

### Demo Video
