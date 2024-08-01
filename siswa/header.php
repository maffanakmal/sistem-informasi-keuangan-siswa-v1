<?php
session_start();
include '../function.php';

if (!isset($_SESSION['nisn'])) {
    header('Location: ../index.php');
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
                <li class="sidebar-item">
                    <a href="index.php" class="sidebar-link">
                        Dashboard
                    </a>
                </li>
                <ul class="sidebar-nav">
                    <li class="sidebar-item">
                        <a href="#" class="sidebar-link collapsed" data-bs-toggle="collapse" data-bs-target="#histori" aria-expanded="false" aria-controls="histori">
                            Histori
                        </a>
                        <ul id="histori" class="sidebar-dropdown list-unstyled collapse" data-bs-parent="#sidebar">
                            <li class="sidebar-item">
                            <?php
                            $nisn = $_SESSION['nisn'];
                            $query = "SELECT * FROM siswa, ppdb, kelas
                                        WHERE siswa.id_kelas = kelas.id_kelas 
                                        AND siswa.id_ppdb = ppdb.id_ppdb
                                        AND nisn = $nisn";
                            $result = mysqli_query($conn, $query);
                            $row = mysqli_fetch_assoc($result);
                            $data_pembayaran = mysqli_query($conn, "SELECT SUM(jumlah_bayar) as jumlah_bayar 
                                        FROM pembayaran_ppdb WHERE nisn = '$row[nisn]'");
                            $data_pembayaran = mysqli_fetch_assoc($data_pembayaran);
                            $sudah_bayar = $data_pembayaran['jumlah_bayar'];
                            $kekurangan = $row['nominal_ppdb'] - $data_pembayaran['jumlah_bayar'];
                            if ($kekurangan != 0) {
                                echo "<a href='histori_pembayaran_ppdb_siswa.php?nisn=" . $_SESSION['nisn'] . "' class='sidebar-link'>PPDB</a>";
                            }
                            ?>
                            </li>
                            <li class="sidebar-item">
                                <a href="histori_pembayaran_spp_siswa.php?nisn=<?= $_SESSION['nisn'] ?>" class="sidebar-link">SPP</a>
                            </li>
                            <li class="sidebar-item">
                                <a href="histori_pembayaran_buku_siswa.php?nisn=<?= $_SESSION['nisn'] ?>" class="sidebar-link">Buku</a>
                            </li>
                            <li class="sidebar-item">
                                <a href="histori_pembayaran_kegiatan_siswa.php?nisn=<?= $_SESSION['nisn'] ?>" class="sidebar-link">Kegiatan</a>
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
                $nisn = $_SESSION['nisn'];
                $query = mysqli_query($conn, "SELECT * FROM siswa WHERE nisn = '$nisn'");
                $row = mysqli_fetch_assoc($query);
                ?>
                <div class="dropdown">
                    <button class="btn dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                        <span><?= $row['nama_siswa']; ?></span>
                    </button>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuButton1">
                        <li><a class="dropdown-item" href="editprofile.php">Pengaturan</a></li>
                        <li><a onclick="return confirm('Anda yakin mau keluar dari sistem?')" class="dropdown-item" href="../logout.php">Logout</a></li>
                </div>

            </nav>
            <div class="container px-3 pt-3">