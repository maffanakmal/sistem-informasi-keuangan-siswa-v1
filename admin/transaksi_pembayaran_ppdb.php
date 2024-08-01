<?php
include 'header.php';
include '../function.php';

if (!isset($_SESSION['id_petugas'])) {
    header('Location: ../login.php');
    exit;
}

if (isset($_POST['bayar'])) {
    // ambil data dari masing masing form
    $id_petugas = $_SESSION['id_petugas'];
    $nisn = $_GET['nisn'];
    $tgl_bayar = htmlentities(strip_tags(($_POST['tgl_bayar'])));
    $id_ppdb = htmlentities(strip_tags(($_POST['id_ppdb'])));
    $jumlah_bayar = htmlentities(strip_tags(($_POST['jumlah_bayar'])));

    //proses simpan
    $query = "INSERT INTO pembayaran_ppdb (id_petugas, nisn, tgl_bayar, id_ppdb, jumlah_bayar) VALUES ('$id_petugas', '$nisn', '$tgl_bayar', '$id_ppdb', '$jumlah_bayar')";
    $result = mysqli_query($conn, $query);
    if ($result) {
        echo "<script>alert('Pembayaran ppdb berhasil!')
                    document.location = 'pembayaran_ppdb.php?nisn=$nisn&cari=';
                </script>";
    } else {
        echo "<script>alert('Pembayaran ppdb gagal!')
                    document.location = 'pembayaran_ppdb.php?nisn=$nisn&cari=';
                </script>";
    }
}

?>

<div class="card mb-4">
    <div class="card-header bg-success py-3 d-flex justify-content-between">
        <h5 class="m-0 font-weight-bold text-light">Transaksi Pembayaran PPDB</h5>
    </div>
    <div class="card-body">
        <?php
        $nisn = $_GET['nisn'];
        $kekurangan = $_GET['kekurangan'];
        $query = "SELECT * FROM siswa, ppdb, kelas
                        WHERE siswa.id_kelas = kelas.id_kelas 
                        AND siswa.id_ppdb = ppdb.id_ppdb
                        AND nisn = '$nisn'";
        $result = mysqli_query($conn, $query);
        $row = mysqli_fetch_assoc($result);
        ?>
        <form action="" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="id_ppdb" class="form-control" value="<?= $row['id_ppdb'] ?>"/>
            <div class="form-group mb-3">
                <label class="form-label" for="petugas">Nama Petugas</label>
                <input type="text" name="petugas" id="petugas" class="form-control" value="<?= $_SESSION['nama_petugas'] ?>" disabled />
            </div>
            <div class="form-group mb-3">
                <label class="form-label" for="nisn">NISN</label>
                <input type="text" name="nisn" id="nisn" class="form-control" value="<?= $row['nisn'] ?>" readonly />
            </div>
            <div class="form-group mb-3">
                <label class="form-label" for="nama_siswa">Nama Siswa</label>
                <input type="text" name="nama_siswa" id="nama_siswa" class="form-control" value="<?= $row['nama_siswa'] ?>" disabled />
            </div>
            <div class="form-group mb-3">
                <label class="form-label" for="tgl_bayar">Tanggal Bayar</label>
                <input type="date" name="tgl_bayar" id="tgl_bayar" class="form-control" required />
            </div>
            <div class="form-group mb-3">
                <label class="form-label" for="jumlah_bayar">Jumlah Bayar <b><?= rupiah($kekurangan) ?></b></label>
                <input type="text" name="jumlah_bayar" id="jumlah_bayar" class="form-control" max="<?= $kekurangan ?>" required />
            </div>
            <div class="form-group mb-3">
                <a href="pembayaran_ppdb.php?nisn=<?=$nisn?>&cari=" class="btn btn-secondary">Kembali</a>
                <button type="submit" name="bayar" class="btn btn-primary">Bayar</button>
        </form>
    </div>

    <?php
    include 'footer.php';
    ?>