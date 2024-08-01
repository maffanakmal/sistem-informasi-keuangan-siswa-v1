<?php
include 'header.php';
include '../function.php';

if (!isset($_SESSION['id_petugas'])) {
    header('Location: ../login.php');
    exit;
}

if (isset($_POST['simpan'])) {
    // ambil data dari masing masing form
    $nama_kegiatan = htmlentities(strip_tags(($_POST['nama_kegiatan'])));
    $nominal_kegiatan = htmlentities(strip_tags(($_POST['nominal_kegiatan'])));

    // validasi
    $sql = "SELECT * FROM kegiatan WHERE nama_kegiatan ='$nama_kegiatan'";
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) {
        echo "<script>alert('Data kegiatan sudah ada')
                    document.location = 'kegiatan.php';
                </script>";
    } else {
        //proses simpan
        $query = "INSERT INTO kegiatan (nama_kegiatan, nominal_kegiatan) VALUES ('$nama_kegiatan', '$nominal_kegiatan')";
        $result = mysqli_query($conn, $query);
        if ($result) {
            echo "<script>alert('Data kegiatan berhasil disimpan!')
                        document.location = 'kegiatan.php';
                    </script>";
        } else {
            echo "<script>alert('Data kegiatan gagal disimpan!')
                        document.location = 'kegiatan.php';
                    </script>";
        }
    }
}

if (isset($_GET['id_kegiatan'])) {
    $id_kegiatan = $_GET['id_kegiatan'];
    $query = mysqli_query($conn, "DELETE FROM kegiatan WHERE id_kegiatan = '$id_kegiatan'");
    if ($query) {
        echo "<script>alert('Data kegiatan berhasil dihapus!')
                    document.location = 'kegiatan.php';
                </script>";
    } else {
        echo "<script>alert('Data kegiatan gagal dihapus!')
                    document.location = 'kegiatan.php';
                </script>";
    }
}

?>

<div class="card mb-4">
    <div class="card-header bg-success py-3 d-flex justify-content-between">
        <h4 class="m-0 font-weight-bold text-light">Data Kegiatan</h4>
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
                    <th>Nama kegiatan</th>
                    <th>Nominal</th>
                    <th width="80px">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $number = 1;
                $query = "SELECT * FROM kegiatan";
                $result = mysqli_query($conn, $query);
                while ($row = mysqli_fetch_assoc($result)) :
                ?>
                    <tr>
                        <td><?= $number++ ?></td>
                        <td><?= $row['nama_kegiatan'] ?></td>
                        <td><?= rupiah($row['nominal_kegiatan']) ?></td>
                        <td>
                            <a href="editkegiatan.php?id_kegiatan=<?= $row['id_kegiatan'] ?>" class="btn btn-sm btn-warning"><span class="fas fa-edit"></span></a>
                            <a href="kegiatan.php?id_kegiatan=<?= $row['id_kegiatan'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Apakah yakin ingin menghapus data?')"><span class="fas fa-trash"></span></a>
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
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah Data Kegiatan</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="" method="POST" enctype="multipart/form-data">
                            <div class="form-group mb-3">
                                <label class="form-label" for="nama_kegiatan">Nama Kegiatan</label>
                                <input type="text" name="nama_kegiatan" id="nama_kegiatan" class="form-control" placeholder="Masukkan Nama Kegiatan" maxlength="30" required />
                            </div>
                            <div class="form-group mb-3">
                                <label class="form-label" for="nominal_kegiatan">Nominal</label>
                                <input type="text" name="nominal_kegiatan" id="nominal_kegiatan" class="form-control" placeholder="Masukkan Nominal" maxlength="13" required />
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