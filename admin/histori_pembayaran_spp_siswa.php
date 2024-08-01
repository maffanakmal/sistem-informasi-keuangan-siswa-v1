<?php
include 'header.php';
include '../function.php';

if (!isset($_SESSION['id_petugas'])) {
    header('Location: ../login.php');
    exit;
}

if (isset($_GET['id_pembayaran_spp'])) {
    $id_pembayaran_spp = $_GET['id_pembayaran_spp'];
    $query = mysqli_query($conn, "DELETE FROM pembayaran_spp WHERE id_pembayaran_spp = '$id_pembayaran_spp'");
    if ($query) {
        echo "<script>alert('Pembayaran SPP berhasil dihapus!')
                    document.location = 'pembayaran_spp.php';
                </script>";
    } else {
        echo "<script>alert('Pembayaran SPP gagal dihapus!')
                    document.location = 'pembayaran_spp.php';
                </script>";
    }
}
?>

<div class="card mb-4">
    <div class="card-header bg-success py-3 d-flex justify-content-between">
        <h5 class="m-0 font-weight-bold text-light">Detail Pembayaran SPP</h5>
    </div>
    <div class="card-body">
        <table class="table table-bordered" id="myTable" width="100%" cellspacing="0">
            <thead>
                <tr>
                    <th width="10px">No.</th>
                    <th>SPP</th>
                    <th>Nominal Dibayar</th>
                    <th>Sudah Dibayar</th>
                    <th>Bulan Dibayar</th>
                    <th>Tanggal Bayar</th>
                    <th>Petugas</th>
                    <th width="80px">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $nisn = $_GET['nisn'];
                $number = 1;
                $query = "SELECT * FROM pembayaran_spp, siswa, kelas, spp, petugas 
                        WHERE pembayaran_spp.nisn = siswa.nisn
                        AND siswa.id_kelas = kelas.id_kelas
                        AND pembayaran_spp.id_spp = spp.id_spp
                        AND pembayaran_spp.id_petugas = petugas.id_petugas
                        AND siswa.nisn = '$nisn'
                        ORDER BY tgl_bayar DESC";
                $result = mysqli_query($conn, $query);
                while ($row = mysqli_fetch_assoc($result)) :
                ?>
                    <tr>
                        <td><?= $number++ ?></td>
                        <td><?= $row['tahun'] ?></td>
                        <td><?= rupiah($row['nominal_spp']) ?></td>
                        <td><?= rupiah($row['jumlah_bayar']) ?></td>
                        <td><?= $row['bulan_dibayar'] ?></td>
                        <td><?= $row['tgl_bayar'] ?></td>
                        <td><?= $row['nama_petugas'] ?></td>
                        <td>
                            <a href="histori_pembayaran_spp_siswa.php?id_pembayaran_spp=<?= $row['id_pembayaran_spp'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Apakah yakin ingin menghapus data?')"><span class="fas fa-trash"></span></a>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
        <a href="pembayaran_spp.php?nisn=<?= $nisn ?>&cari=" class="btn btn-secondary">Kembali</a>
    </div>
    <?php
    include 'footer.php';
    ?>