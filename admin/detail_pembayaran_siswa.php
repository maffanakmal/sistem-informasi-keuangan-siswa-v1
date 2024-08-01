<?php
include 'header.php';
include '../function.php';

if (!isset($_SESSION['id_petugas'])) {
    header('Location: ../login.php');
    exit;
}

?>

<div class="card mb-4">
    <div class="card-header bg-success py-3 d-flex justify-content-between">
        <h5 class="m-0 font-weight-bold text-light">Detail Pembayaran Siswa</h5>
    </div>
    <div class="card-body">
        <table class="table table-bordered" id="myTable" width="100%" cellspacing="0">
            <thead>
                <tr>
                    <th width="10px">No.</th>
                    <th>PPDB</th>
                    <th>SPP</th>
                    <th>Buku</th>
                    <th>Kegiatan</th>
                </tr>
            </thead>

            <tbody>
                <?php
                $nisn = $_GET['nisn'];
                $number = 1;
                $query = "SELECT * FROM siswa, ppdb ,spp, buku, kegiatan
                        WHERE siswa.id_ppdb = ppdb.id_ppdb
                        AND siswa.id_spp = spp.id_spp
                        AND siswa.id_buku = buku.id_buku
                        AND siswa.id_kegiatan = kegiatan.id_kegiatan
                        AND siswa.nisn = '$nisn'";
                $result = mysqli_query($conn, $query);
                while ($row = mysqli_fetch_assoc($result)) :
                ?>
                    <tr>
                        <td><?= $number++ ?></td>
                        <td><?= $row['nama_ppdb'] . " - " . rupiah($row['nominal_ppdb']) ?></td>
                        <td><?= $row['tahun'] . " - " . rupiah($row['nominal_spp']) ?></td>
                        <td><?= $row['nama_buku'] . " - " . rupiah($row['nominal_buku']) ?></td>
                        <td><?= $row['nama_kegiatan'] . " - " . rupiah($row['nominal_kegiatan']) ?></td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
        <a href="siswa.php" class="btn btn-secondary">Kembali</a>
    </div>
    <?php
    include 'footer.php';
    ?>