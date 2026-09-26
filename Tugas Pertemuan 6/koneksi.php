<?php
$host     = "localhost";
$user     = "root";
$password = "";
$database = "portal_berita";

$koneksi = mysqli_connect($host, $user, $password, $database);

if (!$koneksi) {
    die("Koneksi ke database gagal: " . mysqli_connect_error());
}
?>