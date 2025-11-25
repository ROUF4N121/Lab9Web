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
