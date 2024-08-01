<?php
session_start();
include '../function.php';

if (!isset($_SESSION['id_petugas'])) {
    header('Location: ../login.php');
    exit;
}

if (isset($_GET['awal']) && isset($_GET['akhir'])) {
    $awal = $_GET['awal'];
    $akhir = $_GET['akhir'];

    // Validasi tanggal
    if (empty($awal) || empty($akhir)) {
        echo "<script>alert('Isi tanggal terlebih dahulu!')
                    window.location.href = 'histori_pembayaran_buku.php';
                </script>";
        die();
    }

    $tanggalAwal = date("Y-m-d", strtotime($awal));
    $tanggalAkhir = date("Y-m-d", strtotime($akhir));

}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cetak Laporan Pembayaran Buku</title>
    <style>
        body {
            font-family: Arial, Helvetica, sans-serif;
        }

        .print {
            margin-top: 10px;
        }

        @media print {
            .print {
                display: none;
            }
        }

        table {
            border-collapse: collapse;
        }
    </style>
</head>

<body onload="window.print()">
    <h3 align="center">SMP NURUL IMAN <b><br>LAPORAN PEMBAYARAN BUKU</b></h3>
    <br>
    <p>Tanggal <?= $tanggalAwal . " Sampai " . $tanggalAkhir; ?></p>
    <br>
    <table border="1" cellspacing="" cellpadding="4" width="100%">
        <tr>
            <th width="10px">No.</th>
            <th>NISN</th>
            <th>Nama Siswa</th>
            <th>Kelas</th>
            <th>Buku</th>
            <th>Nominal Dibayar</th>
            <th>Sudah Dibayar</th>
            <th>Tanggal Bayar</th>
            <th>Petugas</th>
        </tr>
        <?php
        $nomor = 1;
        $query = mysqli_query($conn, "SELECT * FROM pembayaran_buku, siswa, kelas, buku, petugas 
                                        WHERE pembayaran_buku.nisn = siswa.nisn
                                        AND siswa.id_kelas = kelas.id_kelas
                                        AND pembayaran_buku.id_buku = buku.id_buku
                                        AND pembayaran_buku.id_petugas = petugas.id_petugas
                                        AND tgl_bayar BETWEEN '$tanggalAwal' AND '$tanggalAkhir'
                                        ORDER BY id_pembayaran_buku");
        $total = 0;
        while ($row = mysqli_fetch_assoc($query)) :
        ?>
            <tr>
                <td><?= $nomor++ ?></td>
                <td><?= $row['nisn'] ?></td>
                <td><?= $row['nama_siswa'] ?></td>
                <td><?= $row['nama_kelas'] ?></td>
                <td><?= $row['nama_buku'] ?></td>
                <td><?= rupiah($row['nominal_buku']) ?></td>
                <td><?= rupiah($row['jumlah_bayar']) ?></td>
                <td><?= $row['tgl_bayar'] ?></td>
                <td><?= $row['nama_petugas'] ?></td>
            </tr>
            <?php $total += $row['jumlah_bayar'] ?>
        <?php endwhile; ?>
        <tr>
            <td></td>
            <td colspan="7" align="right">TOTAL</td>
            <td align="right"><b><?= rupiah($total) ?></b></td>
        </tr>
    </table>
    <table width="100%">
        <tr>
            <td></td>
            <td width="200px">
                <br>
                <p>Tangerang, <?= date('d/m/y') ?> <br>
                    Operator,
                    <br>
                    <br>
                    <br>
                <p>________________________________</p>
            </td>
        </tr>
    </table>
</body>

</html>