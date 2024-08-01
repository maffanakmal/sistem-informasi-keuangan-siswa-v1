<?php
include 'header.php';
include '../function.php';

if (!isset($_SESSION['id_petugas'])) {
    header('Location: ../login.php');
    exit;
}

if (isset($_POST['edit'])) {
    // ambil data dari masing masing form
    $nisn = $_GET['nisn'];
    $nis = htmlentities(strip_tags(($_POST['nis'])));
    $nama_siswa = htmlentities(strip_tags(($_POST['nama_siswa'])));
    $id_kelas = htmlentities(strip_tags(($_POST['id_kelas'])));
    $alamat = htmlentities(strip_tags(($_POST['alamat'])));
    $no_telp = htmlentities(strip_tags(($_POST['no_telp'])));
    $id_ppdb = htmlentities(strip_tags(($_POST['id_ppdb'])));
    $id_spp = htmlentities(strip_tags(($_POST['id_spp'])));
    $id_buku = htmlentities(strip_tags(($_POST['id_buku'])));
    $id_kegiatan = htmlentities(strip_tags(($_POST['id_kegiatan'])));

    //proses simpan
    $query = "UPDATE siswa SET nis = '$nis', 
                                nama_siswa = '$nama_siswa', 
                                id_kelas = '$id_kelas', 
                                alamat = '$alamat', 
                                no_telp = '$no_telp',
                                id_ppdb = '$id_ppdb',
                                id_spp = '$id_spp',
                                id_buku = '$id_buku',
                                id_kegiatan = '$id_kegiatan'
                                WHERE nisn = '$nisn'";
    $result = mysqli_query($conn, $query);
    if ($result) {
        echo "<script>alert('Data siswa berhasil diubah!')
                        document.location = 'siswa.php';
                    </script>";
    } else {
        echo "<script>alert('Data siswa gagal diubah!')
                        document.location = 'siswa.php';
                    </script>";
    }
}

?>

<div class="card mb-4">
    <div class="card-header bg-success py-3 d-flex justify-content-between">
        <h5 class="m-0 font-weight-bold text-light">Edit Data Siswa</h5>
    </div>
    <div class="card-body">
        <?php
        $nisn = $_GET['nisn'];
        $query = "SELECT * FROM siswa, spp, kelas
                        WHERE siswa.id_kelas = kelas.id_kelas 
                        AND siswa.id_spp = spp.id_spp
                        AND nisn = '$nisn'";
        $result = mysqli_query($conn, $query);
        $row = mysqli_fetch_assoc($result);
        ?>
        <form action="" method="POST" enctype="multipart/form-data">
            <div class="form-group mb-3">
                <label class="form-label" for="nisn">NISN</label>
                <input type="text" name="nisn" id="nisn" class="form-control" value="<?= $row['nisn'] ?>" readonly/>
            </div>
            <div class="form-group mb-3">
                <label class="form-label" for="nis">NIS</label>
                <input type="text" name="nis" id="nis" class="form-control" value="<?= $row['nis'] ?>" />
            </div>
            <div class="form-group mb-3">
                <label class="form-label" for="nama_siswa">Nama Siswa</label>
                <input type="text" name="nama_siswa" id="nama_siswa" class="form-control" value="<?= $row['nama_siswa'] ?>" />
            </div>
            <div class="form-group mb-3">
                <label class="form-label" for="kelas">Kelas</label>
                <select class="form-control mb-3" name="id_kelas" id="kelas">
                    <option selected>-- Pilih Kelas --</option>
                    <?php
                    $selected = "";
                    $query = mysqli_query($conn, "SELECT * FROM kelas ORDER BY id_kelas");
                    while ($kelas = mysqli_fetch_assoc($query)) :
                        if ($row['id_kelas'] == $kelas['id_kelas']) {
                            $selected = "selected";
                        } else {
                            $selected = "";
                        }
                        echo "<option $selected value=" . $kelas['id_kelas'] . ">" . $kelas['nama_kelas'] . "</option>";
                    endwhile;
                    ?>
                </select>
            </div>
            <div class="form-group mb-3">
                <label class="form-label" for="alamat">Alamat</label>
                <textarea class="form-control" name="alamat" id="alamat"><?= $row['alamat'] ?></textarea>
            </div>
            <div class="form-group mb-3">
                <label class="form-label" for="no_telp">No. Telepon</label>
                <input type="text" name="no_telp" id="no_telp" class="form-control" value="<?= $row['no_telp'] ?>" />
            </div>
            <h5>Pembayaran</h5>
            <hr>
            <div class="form-group mb-3">
            <label class="form-label" for="ppdb">PPDB</label>
                <select class="form-control mb-3" name="id_ppdb" id="ppdb">
                    <option selected>-- Pilih PPDB --</option>
                    <?php
                    $selected = "";
                    $query = mysqli_query($conn, "SELECT * FROM ppdb ORDER BY id_ppdb");
                    while ($ppdb = mysqli_fetch_assoc($query)) :
                        if ($row['id_ppdb'] == $ppdb['id_ppdb']) {
                            $selected = "selected";
                        } else {
                            $selected = "";
                        }
                        echo "<option $selected value=" . $ppdb['id_ppdb'] . ">" . $ppdb['nama_ppdb'] . " - (" . rupiah($ppdb['nominal_ppdb']) . ")" . "</option>";
                    endwhile;
                    ?>
                </select>
            </div>
            <div class="form-group mb-3">
            <label class="form-label" for="spp">SPP</label>
                <select class="form-control mb-3" name="id_spp" id="spp">
                    <option selected>-- Pilih SPP --</option>
                    <?php
                    $selected = "";
                    $query = mysqli_query($conn, "SELECT * FROM spp ORDER BY id_spp");
                    while ($spp = mysqli_fetch_assoc($query)) :
                        if ($row['id_spp'] == $spp['id_spp']) {
                            $selected = "selected";
                        } else {
                            $selected = "";
                        }
                        echo "<option $selected value=" . $spp['id_spp'] . ">" . $spp['tahun'] . " - (" . rupiah($spp['nominal_spp']) . ")" . "</option>";
                    endwhile;
                    ?>
                </select>
            </div>
            <div class="form-group mb-3">
            <label class="form-label" for="buku">Buku</label>
                <select class="form-control mb-3" name="id_buku" id="buku">
                    <option selected>-- Pilih Buku --</option>
                    <?php
                    $selected = "";
                    $query = mysqli_query($conn, "SELECT * FROM buku ORDER BY id_buku");
                    while ($buku = mysqli_fetch_assoc($query)) :
                        if ($row['id_buku'] == $buku['id_buku']) {
                            $selected = "selected";
                        } else {
                            $selected = "";
                        }
                        echo "<option $selected value=" . $buku['id_buku'] . ">" . $buku['nama_buku'] . " - (" . rupiah($buku['nominal_buku']) . ")" . "</option>";
                    endwhile;
                    ?>
                </select>
            </div>
            <div class="form-group mb-3">
            <label class="form-label" for="kegiatan">Kegiatan</label>
                <select class="form-control mb-3" name="id_kegiatan" id="kegiatan">
                    <option selected>-- Pilih Kegiatan --</option>
                    <?php
                    $selected = "";
                    $query = mysqli_query($conn, "SELECT * FROM kegiatan ORDER BY id_kegiatan");
                    while ($kegiatan = mysqli_fetch_assoc($query)) :
                        if ($row['id_kegiatan'] == $kegiatan['id_kegiatan']) {
                            $selected = "selected";
                        } else {
                            $selected = "";
                        }
                        echo "<option $selected value=" . $kegiatan['id_kegiatan'] . ">" . $kegiatan['nama_kegiatan'] . " - (" . rupiah($kegiatan['nominal_kegiatan']) . ")" . "</option>";
                    endwhile;
                    ?>
                </select>
            </div>
            <a href="siswa.php" class="btn btn-secondary">Kembali</a>
            <button type="submit" name="edit" class="btn btn-primary">Simpan</button>
        </form>
    </div>

    <?php
    include 'footer.php';
    ?>