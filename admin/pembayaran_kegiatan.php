<?php
include 'header.php';
include '../function.php';

if (!isset($_SESSION['id_petugas'])) {
    header('Location: ../login.php');
    exit;
}

if (isset($_GET['reset_kegiatan'])) {
    $nisn = $_GET['reset_kegiatan'];
    $query = mysqli_query($conn, "DELETE FROM pembayaran_kegiatan WHERE id_pembayaran_kegiatan AND nisn = '$nisn'");
    if ($query) {
        echo "<script>alert('Pembayaran kegiatan berhasil dihapus!')
                    document.location = 'pembayaran_kegiatan.php';
                </script>";
    } else {
        echo "<script>alert('Pembayaran kegiatan gagal dihapus!')
                    document.location = 'pembayaran_kegiatan.php';
                </script>";
    }
}

?>

<div class="card mb-4">
    <div class="card-body">
        <form action="" method="GET">
            <table class="table">
                <tr>
                    <td>NISN</td>
                    <td>:</td>
                    <td><input type="text" name="nisn" placeholder="Masukkan NISN Siswa" class="form-control"></td>
                    <td><button type="submit" class="btn btn-primary" name="cari">Cari</button></td>
                </tr>
            </table>
        </form>
    </div>
</div>

<?php
if (isset($_GET['nisn']) && $_GET['nisn'] != '') {
    $nisn = $_GET['nisn'];
    $query = "SELECT * FROM siswa, kelas, spp,kegiatan
                    WHERE siswa.id_kelas = kelas.id_kelas 
                    AND siswa.id_spp = spp.id_spp
                    AND siswa.id_kegiatan = kegiatan.id_kegiatan
                    AND siswa.nisn = '$nisn'";
    $result = mysqli_query($conn, $query);
    if (mysqli_num_rows($result) <= 0) {
        echo "<script>alert('Data siswa tidak ada')
                        document.location = 'kegiatan.php';
                    </script>";
    } else {
        $row = mysqli_fetch_assoc($result);
        $nisn = $row['nisn'];
        $nis = $row['nis'];
    }

    $data_pembayaran = mysqli_query($conn, "SELECT SUM(jumlah_bayar) as jumlah_bayar 
                                                        FROM pembayaran_kegiatan WHERE nisn = '$row[nisn]'");
    $data_pembayaran = mysqli_fetch_assoc($data_pembayaran);
    $sudah_bayar = $data_pembayaran['jumlah_bayar'];
    $kekurangan = $row['nominal_kegiatan'] - $data_pembayaran['jumlah_bayar'];
?>

    <div class="card mb-4">
        <div class="card-header bg-success py-3">
            <h5 class="m-0 font-weight-bold text-white">Data Pembayaran Kegiatan</h5>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <tr>
                        <td>NISN</td>
                        <td><?= $row['nisn'] ?></td>
                    </tr>
                    <tr>
                        <td>Nama Siswa</td>
                        <td><?= $row['nama_siswa'] ?></td>
                    </tr>
                    <tr>
                        <td>Kelas</td>
                        <td><?= $row['nama_kelas'] ?></td>
                    </tr>
                    <tr>
                        <td>Angkatan</td>
                        <td><?= $row['tahun'] ?></td>
                    </tr>
                    <tr>
                        <td>Kegiatan</td>
                        <td><?= $row['nama_kegiatan'] ?></td>
                    </tr>
                    <tr>
                        <td>Nominal</td>
                        <td><?= rupiah($row['nominal_kegiatan']) ?></td>
                    </tr>
                    <tr>
                        <td>Sudah Dibayar</td>
                        <td><?= rupiah($sudah_bayar) ?></td>
                    </tr>
                    <tr>
                        <td>Kekurangan</td>
                        <td><?= rupiah($kekurangan) ?></td>
                    </tr>
                </table>
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <td>Status</td>
                            <td>Aksi</td>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>
                                <?php
                                if ($kekurangan == 0) {
                                    echo "<h5><span class='badge bg-success'>LUNAS</span></h5>";
                                } else { ?>
                                    <a href="transaksi_pembayaran_kegiatan.php?nisn=<?= $row['nisn'] ?>&kekurangan=<?= $kekurangan ?>" class="btn btn-sm btn-danger">Bayar</span></a>
                                <?php } ?>
                            </td>
                            <td>
                                <a href="histori_pembayaran_kegiatan_siswa.php?nisn=<?= $row['nisn'] ?>" class="btn btn-sm btn-success mb-1"><span class="fas fa-eye"></span></a>
                                <?php
                                if ($kekurangan == 0) {
                                    echo "<a href='cetak_pembayaran_kegiatan_siswa.php?nisn=" . $row['nisn'] . "&kekurangan=" . $kekurangan . "' class='btn btn-sm btn-primary mb-1'><span class='fas fa-print'></span></a>";
                                    echo " | ";
                                    echo "<a href='pembayaran_kegiatan.php?reset_kegiatan=" . $row['nisn'] . "' class='btn btn-sm btn-warning' onclick=\"return confirm('Hapus Jika Pembayaran kegiatan per kegiatan Sudah LUNAS, Digunakan Untuk Membayar kegiatan Selanjutnya. Pastikan Bukti Pembayaran LUNAS Sudah Dicetak!')\"><span class='fas fa-trash'></span></a>";
                                }
                                ?>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

<?php } ?>

<?php
include 'footer.php';
?>