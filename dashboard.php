<?php
session_start();

include 'includes/cek_session.php';
include 'config/koneksi.php';

/*
=================================================
[AI]
Dashboard SellPoint
Menggunakan tabel yang sudah ada di db_sellpoint.
Tidak membuat atau menambahkan tabel baru.
=================================================
*/

// Mengambil jumlah produk
$query_produk = mysqli_query(
    $koneksi,
    "SELECT COUNT(*) AS total FROM tb_produk"
);
$data_produk = mysqli_fetch_assoc($query_produk);
$total_produk = $data_produk['total'];

// Mengambil jumlah pelanggan
$query_pelanggan = mysqli_query(
    $koneksi,
    "SELECT COUNT(*) AS total FROM tb_pelanggan"
);
$data_pelanggan = mysqli_fetch_assoc($query_pelanggan);
$total_pelanggan = $data_pelanggan['total'];

// Mengambil jumlah transaksi
$query_transaksi = mysqli_query(
    $koneksi,
    "SELECT COUNT(*) AS total FROM tb_transaksi"
);
$data_transaksi = mysqli_fetch_assoc($query_transaksi);
$total_transaksi = $data_transaksi['total'];

// Mengambil total penjualan
$query_penjualan = mysqli_query(
    $koneksi,
    "SELECT COALESCE(SUM(total_bayar), 0) AS total
     FROM tb_transaksi"
);
$data_penjualan = mysqli_fetch_assoc($query_penjualan);
$total_penjualan = $data_penjualan['total'];

// Transaksi terbaru
$query_terbaru = mysqli_query(
    $koneksi,
    "SELECT 
        t.id_transaksi,
        t.no_transaksi,
        t.tanggal,
        t.total_bayar,
        p.nama_pelanggan
     FROM tb_transaksi t
     LEFT JOIN tb_pelanggan p
        ON t.id_pelanggan = p.id_pelanggan
     ORDER BY t.id_transaksi DESC
     LIMIT 5"
);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Dashboard - SellPoint</title>

    <style>
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background: #f5f6fa;
            color: #333;
        }

        /* Sidebar */
        .sidebar {
            position: fixed;
            left: 0;
            top: 0;
            width: 230px;
            height: 100vh;
            background: #222;
            padding-top: 20px;
        }

        .logo {
            color: white;
            text-align: center;
            font-size: 24px;
            font-weight: bold;
            margin-bottom: 30px;
        }

        .sidebar a {
            display: block;
            color: white;
            text-decoration: none;
            padding: 14px 20px;
        }

        .sidebar a:hover {
            background: #444;
        }

        /* Konten */
        .main {
            margin-left: 230px;
            padding: 25px;
        }

        .navbar {
            background: white;
            padding: 18px 20px;
            border-radius: 8px;
            margin-bottom: 25px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.08);
        }

        .navbar h2 {
            margin: 0;
        }

        .navbar p {
            margin: 5px 0 0;
            color: #777;
        }

        /* Kartu */
        .cards {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 20px;
            margin-bottom: 25px;
        }

        .card {
            background: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.08);
        }

        .card h3 {
            margin: 0 0 10px;
            font-size: 16px;
            color: #777;
        }

        .card .angka {
            font-size: 28px;
            font-weight: bold;
        }

        /* Tabel */
        .table-box {
            background: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.08);
        }

        .table-box h3 {
            margin-top: 0;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th,
        td {
            padding: 12px;
            border-bottom: 1px solid #ddd;
            text-align: left;
        }

        th {
            background: #f1f1f1;
        }

        .kosong {
            text-align: center;
            color: #777;
        }

        @media (max-width: 900px) {
            .cards {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        @media (max-width: 600px) {
            .sidebar {
                width: 180px;
            }

            .main {
                margin-left: 180px;
            }

            .cards {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>

<body>

<!--
=================================================
[AI]
Sidebar mengikuti struktur navigasi project:
Dashboard
Data Produk
Data Pelanggan
Transaksi
Riwayat Transaksi
Logout
=================================================
-->

<div class="sidebar">

    <div class="logo">
        SellPoint
    </div>

    <a href="dashboard.php">
        Dashboard
    </a>

    <a href="data_produk.php">
        Data Produk
    </a>

    <a href="data_pelanggan.php">
        Data Pelanggan
    </a>

    <a href="transaksi.php">
        Transaksi
    </a>

    <a href="riwayat_transaksi.php">
        Riwayat Transaksi
    </a>

    <a href="logout.php">
        Logout
    </a>

</div>


<div class="main">

    <div class="navbar">
        <h2>Dashboard</h2>

        <p>
            Selamat datang di aplikasi manajemen penjualan SellPoint.
        </p>
    </div>


    <!-- Statistik -->

    <div class="cards">

        <div class="card">
            <h3>Total Produk</h3>
            <div class="angka">
                <?= $total_produk; ?>
            </div>
        </div>

        <div class="card">
            <h3>Total Pelanggan</h3>
            <div class="angka">
                <?= $total_pelanggan; ?>
            </div>
        </div>

        <div class="card">
            <h3>Total Transaksi</h3>
            <div class="angka">
                <?= $total_transaksi; ?>
            </div>
        </div>

        <div class="card">
            <h3>Total Penjualan</h3>
            <div class="angka">
                Rp <?= number_format($total_penjualan, 0, ',', '.'); ?>
            </div>
        </div>

    </div>


    <!-- Transaksi Terbaru -->

    <div class="table-box">

        <h3>Transaksi Terbaru</h3>

        <table>

            <thead>
                <tr>
                    <th>No</th>
                    <th>No. Transaksi</th>
                    <th>Tanggal</th>
                    <th>Pelanggan</th>
                    <th>Total Bayar</th>
                </tr>
            </thead>

            <tbody>

            <?php if (mysqli_num_rows($query_terbaru) > 0): ?>

                <?php $no = 1; ?>

                <?php while ($transaksi = mysqli_fetch_assoc($query_terbaru)): ?>

                    <tr>

                        <td>
                            <?= $no++; ?>
                        </td>

                        <td>
                            <?= htmlspecialchars($transaksi['no_transaksi']); ?>
                        </td>

                        <td>
                            <?= htmlspecialchars($transaksi['tanggal']); ?>
                        </td>

                        <td>
                            <?= $transaksi['nama_pelanggan']
                                ? htmlspecialchars($transaksi['nama_pelanggan'])
                                : 'Pelanggan Umum'; ?>
                        </td>

                        <td>
                            Rp <?= number_format(
                                $transaksi['total_bayar'],
                                0,
                                ',',
                                '.'
                            ); ?>
                        </td>

                    </tr>

                <?php endwhile; ?>

            <?php else: ?>

                <tr>
                    <td colspan="5" class="kosong">
                        Belum ada transaksi.
                    </td>
                </tr>

            <?php endif; ?>

            </tbody>

        </table>

    </div>

</div>

</body>
</html>