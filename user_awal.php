<?php 
include 'config/koneksi.php'; 
 
$nama = 'Administrator'; 
$username = 'admin'; 
$password = password_hash('admin123', PASSWORD_DEFAULT); 
$level = 'admin'; 
$status = 'aktif'; 
 
$sql = "INSERT INTO tb_pengguna 
(nama_lengkap, username, password, level, status) 
VALUES 
('$nama', '$username', '$password', '$level', '$status')"; 
 
if (mysqli_query($koneksi, $sql)) { 
    echo 'user admin berhasil dibuat. silahkan hapus file ini.'; 
} else { 
    echo 'gagal memuat user: '. mysqli_error($koneksi); 
} 
?>