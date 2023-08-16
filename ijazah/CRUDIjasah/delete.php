<?php
include ('koneksi.php');
$id = $_GET['id'];

$hapus = mysqli_query($koneksi, "DELETE FROM ijazah WHERE id='$id'");
if ($hapus == true){
    echo"BERHASIL TERHAPUS";
    header("location: index.php");
    } else {
        echo "GAGAL HAPUS" ; 
    }
?>