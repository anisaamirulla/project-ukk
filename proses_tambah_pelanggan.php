<?php
session_start();
include 'includes/cek_session.php';
include 'config/koneksi.php';

if (isset($_POST['simpan'])) {

    $nama_pelanggan = mysqli_real_escape_string(
        $koneksi,
        $_POST['nama_pelanggan']
    );

    $no_telepon = mysqli_real_escape_string(
        $koneksi,
        $_POST['no_telepon']
    );

    $alamat = mysqli_real_escape_string(
        $koneksi,
        $_POST['alamat']
    );

    $sql = "INSERT INTO tb_pelanggan
            (nama_pelanggan, no_telepon, alamat)
            VALUES
            ('$nama_pelanggan', '$no_telepon', '$alamat')";

    if (mysqli_query($koneksi, $sql)) {
        header('Location: data_pelanggan.php');
        exit;
    } else {
        echo "Gagal menambahkan pelanggan: "
             . mysqli_error($koneksi);
    }
}
?>