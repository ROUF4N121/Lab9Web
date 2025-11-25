console.log("JS Loaded!");

function confirmDelete() {
    return confirm("Yakin ingin menghapus data?");
}

<a href="index.php?page=user/delete&id=<?= $row['id_user'] ?>" 
   onclick="return confirmDelete()"
   style="color:red;">Hapus</a>
