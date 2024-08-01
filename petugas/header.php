<?php
session_start();
include '../function.php';

if (!isset($_SESSION['id_petugas'])) {
    header('Location: ../login.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="../dist/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="../dist/css/all.css">
    <link rel="stylesheet" href="../dist/css/bootstrap-chosen.css">
    <link rel="stylesheet" href="../dist/css/style.css">
    <title>Aplikasi Keuangan SMP Nurul Iman</title>
</head>

<body>
    <div class="wrapper">
        <aside id="sidebar" class="bg-success">
            <div class="h-100">
                <div class="sidebar-logo">
                    <a href="#">Aplikasi Keuangan SMP Nurul Iman</a>
                </div>
                <ul class="sidebar-nav">
                    <li class="sidebar-header">
                        Tools & Component
                    </li>
                    <li class="sidebar-item">
                        <a href="index.php" class="sidebar-link">
                            Dashboard
                        </a>
                    </li>
                    <li class="sidebar-item">
                        <a href="#" class="sidebar-link collapsed" data-bs-toggle="collapse" data-bs-target="#pembayaran" aria-expanded="false" aria-controls="pembayaran">
                            Pembayaran
                        </a>
                        <ul id="pembayaran" class="sidebar-dropdown list-unstyled collapse" data-bs-parent="#sidebar">
                            <li class="sidebar-item">
                                <a href="pembayaran_ppdb.php" class="sidebar-link">PPDB</a>
                            </li>
                            <li class="sidebar-item">
                                <a href="pembayaran_spp.php" class="sidebar-link">SPP</a>
                            </li>
                            <li class="sidebar-item">
                                <a href="pembayaran_buku.php" class="sidebar-link">Buku</a>
                            </li>
                            <li class="sidebar-item">
                                <a href="pembayaran_kegiatan.php" class="sidebar-link">Kegiatan</a>
                            </li>
                        </ul>
                    </li>
                    <li class="sidebar-item">
                        <a href="#" class="sidebar-link collapsed" data-bs-toggle="collapse" data-bs-target="#histori" aria-expanded="false" aria-controls="histori">
                            Histori & Laporan
                        </a>
                        <ul id="histori" class="sidebar-dropdown list-unstyled collapse" data-bs-parent="#sidebar">
                            <li class="sidebar-item">
                                <a href="histori_pembayaran_ppdb.php" class="sidebar-link">PPDB</a>
                            </li>
                            <li class="sidebar-item">
                                <a href="histori_pembayaran_spp.php" class="sidebar-link">SPP</a>
                            </li>
                            <li class="sidebar-item">
                                <a href="histori_pembayaran_buku.php" class="sidebar-link">Buku</a>
                            </li>
                            <li class="sidebar-item">
                                <a href="histori_pembayaran_kegiatan.php" class="sidebar-link">Kegiatan</a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </aside>
        <div class="main">
            <nav class="navbar navbar-expand px-3 shadow-sm d-flex justify-content-between">
                <button class="btn" type="button">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <?php
                $id_petugas = $_SESSION['id_petugas'];
                $query = mysqli_query($conn, "SELECT * FROM petugas WHERE id_petugas = '$id_petugas'");
                $row = mysqli_fetch_assoc($query);
                ?>
                <div class="dropdown">
                    <button class="btn dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                        <span><?= $row['nama_petugas']; ?></span>
                    </button>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuButton1">
                        <li><a class="dropdown-item" href="editprofile.php">Pengaturan</a></li>
                        <li><a onclick="return confirm('Anda yakin mau keluar dari sistem?')" class="dropdown-item" href="../logout.php">Logout</a></li>
                </div>

            </nav>
            <div class="container px-3 pt-3">