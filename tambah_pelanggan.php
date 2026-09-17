<?php
session_start();
include 'includes/cek_session.php';
include 'config/koneksi.php';
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Tambah Pelanggan</title>
</head>
<body>

<h2>Tambah Pelanggan</h2>

<form action="proses_tambah_pelanggan.php" method="POST">

    <label>Nama Pelanggan</label><br>
    <input type="text" name="nama_pelanggan" required>

    <br><br>

    <label>No. Telepon</label><br>
    <input type="text" name="no_telepon" required>

    <br><br>

    <label>Alamat</label><br>
    <textarea name="alamat" rows="4" required></textarea>

    <br><br>

    <button type="submit" name="simpan">Simpan</button>

    <a href="data_pelanggan.php">Kembali</a>

</form>

</body>
</html>