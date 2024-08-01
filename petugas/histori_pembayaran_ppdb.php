<?php
include 'header.php';
include '../function.php';

if (!isset($_SESSION['id_petugas'])) {
    header('Location: ../login.php');
    exit;
}

?>
<div class="card mb-4">
    <div class="card-header bg-success py-3">
        <h5 class="m-0 font-weight-bold text-light">Cetak Data Laporan</h5>
    </div>
    <div class="card-body">
        <form action="cetak_laporan_ppdb.php" method="GET" target="_blank">
            <input type="date" name="awal" class="form-control mb-2">
            <input type="date" name="akhir" class="form-control mb-2">
            <button type="submit" class="btn btn-primary" name="cetak">Cetak PDF</button>
        </form>
    </div>
</div>

<div class="card mb-4">
    <div class="card-header bg-success py-3 d-flex justify-content-between">
        <h5 class="m-0 font-weight-bold text-light">Histori Pembayaran PPDB</h5>
    </div>
    <div class="card-body">
        <table class="table table-bordered" id="myTable" width="100%" cellspacing="0">
            <thead>
                <tr>
                    <th width="10px">No.</th>
                    <th>NISN</th>
                    <th>Nama Siswa</th>
                    <th>Kelas</th>
                    <th>Nama PPDB</th>
                    <th>Nominal Dibayar</th>
                    <th>Sudah Dibayar</th>
                    <th>Tanggal Bayar</th>
                    <th>Petugas</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $number = 1;
                $query = "SELECT * FROM pembayaran_ppdb, siswa, kelas, ppdb, petugas WHERE pembayaran_ppdb.nisn = siswa.nisn
                        AND siswa.id_kelas = kelas.id_kelas
                        AND pembayaran_ppdb.id_ppdb = ppdb.id_ppdb
                        AND pembayaran_ppdb.id_petugas = petugas.id_petugas
                        ORDER BY tgl_bayar DESC";
                $result = mysqli_query($conn, $query);
                while ($row = mysqli_fetch_assoc($result)) :
                ?>
                    <tr>
                        <td><?= $number++ ?></td>
                        <td><?= $row['nisn'] ?></td>
                        <td><?= $row['nama_siswa'] ?></td>
                        <td><?= $row['nama_kelas'] ?></td>
                        <td><?= $row['nama_ppdb'] ?></td>
                        <td><?= rupiah($row['nominal_ppdb']) ?></td>
                        <td><?= rupiah($row['jumlah_bayar']) ?></td>
                        <td><?= $row['tgl_bayar'] ?></td>
                        <td><?= $row['nama_petugas'] ?></td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>
    <?php
    include 'footer.php';
    ?>