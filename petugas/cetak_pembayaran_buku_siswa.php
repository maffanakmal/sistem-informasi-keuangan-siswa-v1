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
    <title>Slip Pembayaran Buku</title>
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
    <h3 align="center">SMP NURUL IMAN <b><br>BUKTI PEMBAYARAN BUKU</b></h3>
    <hr>
    <?php
    $nisn = $_GET['nisn'];
    $query = mysqli_query($conn, "SELECT * FROM siswa, spp, kelas,buku
                                    WHERE siswa.id_spp = spp.id_spp
                                    AND siswa.id_kelas = kelas.id_kelas
                                    AND siswa.id_buku = buku.id_buku
                                    AND siswa.nisn = '$nisn'");
    $result = mysqli_fetch_assoc($query);
    ?>
    <table>
        <tr>
            <td>Nama Siswa</td>
            <td>:</td>
            <td><?= $result['nama_siswa'] ?></td>
        </tr>
        <tr>
            <td>NISN</td>
            <td>:</td>
            <td><?= $result['nisn'] ?></td>
        </tr>
        <tr>
            <td>Kelas</td>
            <td>:</td>
            <td><?= $result['nama_kelas'] ?></td>
        </tr>
        <tr>
            <td>Angkatan</td>
            <td>:</td>
            <td><?= $result['tahun'] ?></td>
        </tr>
        <tr>
            <td>Buku</td>
            <td>:</td>
            <td><?= $result['nama_buku'] ?></td>
        </tr>
    </table>
    <hr>
    <table border="1" cellspacing="" cellpadding="4" width="100%">
        <tr>
            <th width="10px">No.</th>
            <th>Nominal Dibayar</th>
            <th>Sudah Dibayar</th>
            <th>Tanggal Bayar</th>
            <th>Petugas</th>
        </tr>
        <?php
        $kekurangan = $_GET['kekurangan'];
        $nisn = $_GET['nisn'];
        $number = 1;
        $total = 0;
        $query = "SELECT * FROM pembayaran_buku, siswa, buku, petugas 
                        WHERE pembayaran_buku.nisn = siswa.nisn
                        AND pembayaran_buku.id_buku = buku.id_buku
                        AND pembayaran_buku.id_petugas = petugas.id_petugas
                        AND siswa.nisn = '$nisn'
                        ORDER BY tgl_bayar DESC";
        $result = mysqli_query($conn, $query);
        while ($row = mysqli_fetch_assoc($result)) :
        ?>
            <tbody>
                <tr>
                    <td><?= $number++ ?></td>
                    <td><?= rupiah($row['nominal_buku']) ?></td>
                    <td><?= rupiah($row['jumlah_bayar']) ?></td>
                    <td><?= $row['tgl_bayar'] ?></td>
                    <td><?= $row['nama_petugas'] ?></td>
                </tr>
                <?php $total += $row['jumlah_bayar'] ?>
            <?php endwhile; ?>
            <tr>
                <td colspan="4" align="right">TOTAL</td>
                <td align="right"><b><?= rupiah($total) ?></b></td>
            </tr>
    </table>
    <table width="100%">
        <tr>
            <td>
                KETERANGAN : 
                <?php
                if ($kekurangan == 0) {
                    echo "<b>LUNAS</b>";
                }
                ?>
            </td>
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