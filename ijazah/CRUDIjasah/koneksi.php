<?php

$server = "localhost";
$user = "root";
$password = "";
$database = "program_ijazah";


$koneksi = mysqli_connect ($server,$user,$password,$database);

if ($koneksi == true){
} else "GAGAL TERHUBUNG";
?>