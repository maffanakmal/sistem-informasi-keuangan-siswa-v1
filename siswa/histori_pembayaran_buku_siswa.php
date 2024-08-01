<?php
include 'header.php';
include '../function.php';

if (!isset($_SESSION['nisn'])) {
    header('Location: ../index.php');
    exit;
}
?>

<div class="card mb-4">
    <div class="card-header bg-success py-3 d-flex justify-content-between">
        <h5 class="m-0 font-weight-bold text-light">Histori Pembayaran Buku</h5>
    </div>
    <div class="card-body">
        <table class="table table-bordered" id="myTable" width="100%" cellspacing="0">
            <thead>
                <tr>
                    <th width="10px">No.</th>
                    <th>Buku</th>
                    <th>Nominal Dibayar</th>
                    <th>Sudah Dibayar</th>
                    <th>Tanggal Bayar</th>
                    <th>Petugas</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $nisn = $_GET['nisn'];
                $number = 1;
                $query = "SELECT * FROM pembayaran_buku, siswa, buku, petugas 
                        WHERE pembayaran_buku.nisn = siswa.nisn
                        AND pembayaran_buku.id_buku = buku.id_buku
                        AND pembayaran_buku.id_petugas = petugas.id_petugas
                        AND siswa.nisn = '$nisn'
                        ORDER BY tgl_bayar DESC";
                $result = mysqli_query($conn, $query);
                while ($row = mysqli_fetch_assoc($result)) :
                ?>
                    <tr>
                        <td><?= $number++ ?></td>
                        <td><?= $row['nama_buku'] ?></td>
                        <td><?= rupiah($row['nominal_buku']) ?></td>
                        <td><?= rupiah($row['jumlah_bayar']) ?></td>
                        <td><?= $row['tgl_bayar'] ?></td>
                        <td><?= $row['nama_petugas'] ?></td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
        <a href="index.php" class="btn btn-secondary">Kembali</a>
    </div>
    <?php
    include 'footer.php';
    ?>