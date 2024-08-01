<?php
include 'header.php';
include '../function.php';

if (!isset($_SESSION['id_petugas'])) {
    header('Location: ../login.php');
    exit;
}

if (isset($_POST['simpan'])) {
    // ambil data dari masing masing form
    $tahun = htmlentities(strip_tags(($_POST['tahun'])));
    $nominal_spp = htmlentities(strip_tags(($_POST['nominal_spp'])));

    // validasi
    $sql = "SELECT * FROM spp WHERE tahun ='$tahun'";
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) {
        echo "<script>alert('Data angkatan sudah ada')
                    document.location = 'spp.php';
                </script>";
    } else {
        //proses simpan
        $query = "INSERT INTO spp (tahun, nominal_spp) VALUES ('$tahun', '$nominal_spp')";
        $result = mysqli_query($conn, $query);
        if ($result) {
            echo "<script>alert('Data angkatan berhasil disimpan!')
                        document.location = 'spp.php';
                    </script>";
        } else {
            echo "<script>alert('Data angkatan gagal disimpan!')
                        document.location = 'spp.php';
                    </script>";
        }
    }
}

if (isset($_GET['id_spp'])) {
    $id_spp = $_GET['id_spp'];
    $query = mysqli_query($conn, "DELETE FROM spp WHERE id_spp = '$id_spp'");
    if ($query) {
        echo "<script>alert('Data spp berhasil dihapus!')
                    document.location = 'spp.php';
                </script>";
    } else {
        echo "<script>alert('Data spp gagal dihapus!')
                    document.location = 'spp.php';
                </script>";
    }
}

?>

<div class="card mb-4">
    <div class="card-header bg-success py-3 d-flex justify-content-between">
        <h4 class="m-0 font-weight-bold text-light">Data SPP</h4>
        <!-- Button trigger modal -->
        <button type="button" class="btn btn-light" data-bs-toggle="modal" data-bs-target="#addModal">
            Tambah Data
        </button>
    </div>
    <div class="card-body">
        <table class="table table-bordered" id="myTable" width="100%">
            <thead>
                <tr>
                    <th width="10px">No.</th>
                    <th>Tahun</th>
                    <th>Nominal</th>
                    <th width="80px">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $number = 1;
                $query = "SELECT * FROM spp";
                $result = mysqli_query($conn, $query);
                while ($row = mysqli_fetch_assoc($result)) :
                ?>
                    <tr>
                        <td><?= $number++ ?></td>
                        <td><?= $row['tahun'] ?></td>
                        <td><?= rupiah($row['nominal_spp']) ?></td>
                        <td>
                            <a href="editspp.php?id_spp=<?= $row['id_spp'] ?>" class="btn btn-sm btn-warning"><span class="fas fa-edit"></span></a>
                            <a href="spp.php?id_spp=<?= $row['id_spp'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Apakah yakin ingin menghapus data?')"><span class="fas fa-trash"></span></a>
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
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah Data SPP</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="" method="POST" enctype="multipart/form-data">
                            <div class="form-group mb-3">
                                <label class="form-label" for="tahun">Tahun</label>
                                <input type="text" name="tahun" id="tahun" class="form-control" placeholder="Masukkan Tahun" maxlength="4" required />
                            </div>
                            <div class="form-group mb-3">
                                <label class="form-label" for="nominal_spp">Nominal</label>
                                <input type="text" name="nominal_spp" id="nominal_spp" class="form-control" placeholder="Masukkan Nominal" maxlength="13" required />
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