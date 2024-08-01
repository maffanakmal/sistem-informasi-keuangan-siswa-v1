<?php
include 'header.php';
include '../function.php';

if (!isset($_SESSION['id_petugas'])) {
    header('Location: ../login.php');
    exit;
}

if (isset($_POST['simpan'])) {
    // ambil data dari masing masing form
    $nisn = htmlentities(strip_tags(($_POST['nisn'])));
    $nis = htmlentities(strip_tags(($_POST['nis'])));
    $nama_siswa = htmlentities(strip_tags(($_POST['nama_siswa'])));
    $id_kelas = htmlentities(strip_tags(($_POST['id_kelas'])));
    $alamat = htmlentities(strip_tags(($_POST['alamat'])));
    $no_telp = htmlentities(strip_tags(($_POST['no_telp'])));
    $id_ppdb = htmlentities(strip_tags(($_POST['id_ppdb'])));
    $id_spp = htmlentities(strip_tags(($_POST['id_spp'])));
    $id_buku = htmlentities(strip_tags(($_POST['id_buku'])));
    $id_kegiatan = htmlentities(strip_tags(($_POST['id_kegiatan'])));

    // validasi
    $sql = "SELECT * FROM siswa WHERE nisn ='$nisn'";
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) {
        echo "<script>alert('Data siswa sudah ada')
                    document.location = 'siswa.php';
                </script>";
    } else {
        //proses simpan
        $query = "INSERT INTO siswa (nisn, nis, nama_siswa, id_kelas, alamat, no_telp, id_ppdb ,id_spp, id_buku, id_kegiatan) VALUES ('$nisn', '$nis', '$nama_siswa', '$id_kelas', '$alamat', '$no_telp', '$id_ppdb' ,'$id_spp', '$id_buku', '$id_kegiatan')";
        $result = mysqli_query($conn, $query);
        if ($result) {
            echo "<script>alert('Data siswa berhasil disimpan!')
                        document.location = 'siswa.php';
                    </script>";
        } else {
            echo "<script>alert('Data siswa gagal disimpan!')
                        document.location = 'siswa.php';
                    </script>";
        }
    }
}

if (isset($_GET['nisn'])) {
    $nisn = $_GET['nisn'];
    $query = mysqli_query($conn, "DELETE FROM siswa WHERE nisn = '$nisn'");
    if ($query) {
        echo "<script>alert('Data siswa berhasil dihapus!')
                    document.location = 'siswa.php';
                </script>";
    } else {
        echo "<script>alert('Data siswa gagal dihapus!')
                    document.location = 'siswa.php';
                </script>";
    }
}

?>

<div class="card mb-4">
    <div class="card-header bg-success py-3 d-flex justify-content-between">
        <h4 class="m-0 font-weight-bold text-light">Data Siswa</h4>
        <!-- Button trigger modal -->
        <button type="button" class="btn btn-light" data-bs-toggle="modal" data-bs-target="#addModal">
            Tambah Data
        </button>
    </div>
    <div class="card-body">
        <table class="table table-bordered" id="myTable" width="100%" cellspacing="0">
            <thead>
                <tr>
                    <th width="10px">No.</th>
                    <th>NISN</th>
                    <th>NIS</th>
                    <th>Nama Siswa</th>
                    <th>Kelas</th>
                    <th>Alamat</th>
                    <th>No. Telepon</th>
                    <th>Biaya</th>
                    <th width="80px">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $number = 1;
                $query = "SELECT * FROM siswa, kelas
                        WHERE siswa.id_kelas = kelas.id_kelas 
                        ORDER BY nisn ASC";
                $result = mysqli_query($conn, $query);
                while ($row = mysqli_fetch_assoc($result)) :
                ?>
                    <tr>
                        <td><?= $number++ ?></td>
                        <td><?= $row['nisn'] ?></td>
                        <td><?= $row['nis'] ?></td>
                        <td><?= $row['nama_siswa'] ?></td>
                        <td><?= $row['nama_kelas'] ?></td>
                        <td><?= $row['alamat'] ?></td>
                        <td><?= $row['no_telp'] ?></td>
                        <td>
                            <a href="detail_pembayaran_siswa.php?nisn=<?= $row['nisn'] ?>" class="btn btn-sm btn-success mb-1"><span class="fas fa-eye"></span></a>
                        </td>
                        <td>
                            <a href="editsiswa.php?nisn=<?= $row['nisn'] ?>" class="btn btn-sm btn-warning"><span class="fas fa-edit"></span></a>
                            <a href="siswa.php?nisn=<?= $row['nisn'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Apakah yakin ingin menghapus data?')"><span class="fas fa-trash"></span></a>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>

        <!-- Add Modal -->
        <div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah Data Siswa</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="" method="POST" enctype="multipart/form-data">
                            <div class="form-group mb-3">
                                <label class="form-label" for="nisn">NISN</label>
                                <input type="text" name="nisn" id="nisn" class="form-control" placeholder="Masukkan NISN" maxlength="25" required />
                            </div>
                            <div class="form-group mb-3">
                                <label class="form-label" for="nis">NIS</label>
                                <input type="text" name="nis" id="nis" class="form-control" placeholder="Masukkan NIS" maxlength="32" required />
                            </div>
                            <div class="form-group mb-3">
                                <label class="form-label" for="nama_siswa">Nama Siswa</label>
                                <input type="text" name="nama_siswa" id="nama_siswa" class="form-control" placeholder="Masukkan Nama" maxlength="35" required />
                            </div>
                            <div class="form-group mb-3">
                                <label class="form-label" for="kelas">Kelas</label>
                                <select class="form-control mb-3" name="id_kelas" id="kelas">
                                    <option selected>--Pilih Kelas--</option>
                                    <?php
                                    $query = mysqli_query($conn, "SELECT * FROM kelas ORDER BY id_kelas");
                                    while ($kelas = mysqli_fetch_assoc($query)) :
                                        echo "<option value=" . $kelas['id_kelas'] . ">" . $kelas['nama_kelas'] . "</option>";
                                    endwhile;
                                    ?>
                                </select>
                            </div>
                            <div class="form-group mb-3">
                                <label class="form-label" for="alamat">Alamat</label>
                                <textarea class="form-control" name="alamat" id="alamat" placeholder="Masukkan Alamat" required></textarea>
                            </div>
                            <div class="form-group mb-3">
                                <label class="form-label" for="no_telp">No. Telepon</label>
                                <input type="text" name="no_telp" id="no_telp" class="form-control" placeholder="Masukkan No Telepon" maxlength="35" required />
                            </div>
                            <h5>Pembayaran</h5>
                            <hr>
                            <div class="form-group mb-3">
                                <label class="form-label" for="ppdb">PPDB</label>
                                <select class="form-control mb-3" name="id_ppdb" id="ppdb">
                                    <option selected>--Pilih PPDB--</option>
                                    <?php
                                    $query = mysqli_query($conn, "SELECT * FROM ppdb ORDER BY id_ppdb");
                                    while ($ppdb = mysqli_fetch_assoc($query)) :
                                        echo "<option value=" . $ppdb['id_ppdb'] . ">" . $ppdb['nama_ppdb'] . " - (" . rupiah($ppdb['nominal_ppdb']) . ")" . "</option>";
                                    endwhile;
                                    ?>
                                </select>
                            </div>
                            <div class="form-group mb-3">
                                <label class="form-label" for="spp">SPP</label>
                                <select class="form-control mb-3" name="id_spp" id="spp">
                                    <option selected>--Pilih SPP--</option>
                                    <?php
                                    $query = mysqli_query($conn, "SELECT * FROM spp ORDER BY id_spp");
                                    while ($spp = mysqli_fetch_assoc($query)) :
                                        echo "<option value=" . $spp['id_spp'] . ">" . $spp['tahun'] . " - (" . rupiah($spp['nominal_spp']) . ")" . "</option>";
                                    endwhile;
                                    ?>
                                </select>
                            </div>
                            <div class="form-group mb-3">
                                <label class="form-label" for="buku">Buku</label>
                                <select class="form-control mb-3" name="id_buku" id="buku">
                                    <option selected>--Pilih Buku--</option>
                                    <?php
                                    $query = mysqli_query($conn, "SELECT * FROM buku ORDER BY id_buku");
                                    while ($buku = mysqli_fetch_assoc($query)) :
                                        echo "<option value=" . $buku['id_buku'] . ">" . $buku['nama_buku'] . " - (" . rupiah($buku['nominal_buku']) . ")" . "</option>";
                                    endwhile;
                                    ?>
                                </select>
                            </div>
                            <div class="form-group mb-3">
                                <label class="form-label" for="kegiatan">Kegiatan</label>
                                <select class="form-control mb-3" name="id_kegiatan" id="kegiatan">
                                    <option selected>--Pilih Kegiatan--</option>
                                    <?php
                                    $query = mysqli_query($conn, "SELECT * FROM kegiatan ORDER BY id_kegiatan");
                                    while ($kegiatan = mysqli_fetch_assoc($query)) :
                                        echo "<option value=" . $kegiatan['id_kegiatan'] . ">" . $kegiatan['nama_kegiatan'] . " - (" . rupiah($kegiatan['nominal_kegiatan']) . ")" . "</option>";
                                    endwhile;
                                    ?>
                                </select>
                            </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" name="simpan" class="btn btn-primary">Simpan</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php
    include 'footer.php';
    ?>