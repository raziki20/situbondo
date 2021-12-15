<?php
$host       = "localhost";
$user       = "root";
$password   = "";
$database   = "bppkad_antrian";
$connect    = mysqli_connect($host, $user, $password, $database);

// mengecek koneksi
// if (!$connect) {
//     die("Koneksi gagal: " . mysqli_connect_error());
// }
// echo "Koneksi berhasil";
?>