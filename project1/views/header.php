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
