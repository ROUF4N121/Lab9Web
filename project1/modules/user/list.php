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
