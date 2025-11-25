<?php
include 'config/database.php';

$id = $_GET['id'];

$sql = "DELETE FROM data_user WHERE id_user = '$id'";
mysqli_query($conn, $sql);

echo "<script>alert('User berhasil dihapus');</script>";
echo "<script>window.location='index.php?page=user/list'</script>";
?>
