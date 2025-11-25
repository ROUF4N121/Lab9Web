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
