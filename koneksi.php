<?php
$host = "localhost";
$user = "root";
$pass = "";
$db = "angkatan1_porto1";

$connect = mysqli_connect($host, $user, $pass, $db);
if (!$connect) {
  die("koneksi gagal");
}
