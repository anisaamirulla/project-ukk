<?php
$host ='localhost';
$user = 'root';
$password = '';
$database = 'db_sellpoint';

$koneksi = mysqli_connect($host, $user, $password, $database);

if (!$koneksi) {
    die('koneksi database gagal: '. mysqli_connect_error());
}
?>