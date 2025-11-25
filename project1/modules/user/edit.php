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
