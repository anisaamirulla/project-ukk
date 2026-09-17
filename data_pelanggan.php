<?php
session_start();
include 'includes/cek_session.php';
include 'config/koneksi.php';

$query = mysqli_query($koneksi, "SELECT * FROM tb_pelanggan ORDER BY id_pelanggan DESC");
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Data Pelanggan</title>
</head>
<body>

<h2>Data Pelanggan</h2>

<a href="tambah_pelanggan.php">+ Tambah Pelanggan</a>

<br><br>

<table border="1" cellpadding="10" cellspacing="0">
    <tr>
        <th>No</th>
        <th>Nama Pelanggan</th>
        <th>No. Telepon</th>
        <th>Alamat</th>
        <th>Aksi</th>
    </tr>

    <?php
    $no = 1;

    while ($data = mysqli_fetch_assoc($query)) {
    ?>

    <tr>
        <td><?= $no++; ?></td>
        <td><?= htmlspecialchars($data['nama_pelanggan']); ?></td>
        <td><?= htmlspecialchars($data['no_telepon']); ?></td>
        <td><?= htmlspecialchars($data['alamat']); ?></td>
        <td>
            <a href="edit_pelanggan.php?id=<?= $data['id_pelanggan']; ?>">
                Edit
            </a>

            |

            <a href="hapus_pelanggan.php?id=<?= $data['id_pelanggan']; ?>"
               onclick="return confirm('Yakin ingin menghapus pelanggan ini?');">
                Hapus
            </a>
        </td>
    </tr>

    <?php } ?>

</table>

</body>
</html>