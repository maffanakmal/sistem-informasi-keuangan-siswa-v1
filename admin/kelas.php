<?php
include 'header.php';
include '../function.php';

if (!isset($_SESSION['id_petugas'])) {
    header('Location: ../login.php');
    exit;
}

if (isset($_POST['simpan'])) {
    // ambil data dari masing masing form
    $nama_kelas = htmlentities(strip_tags(($_POST['nama_kelas'])));

    // validasi
    $sql = "SELECT * FROM kelas WHERE nama_kelas ='$nama_kelas'";
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) {
        echo "<script>alert('Data kelas sudah ada')
                    document.location = 'spp.php';
                </script>";
    } else {
        //proses simpan
        $query = "INSERT INTO kelas (nama_kelas) VALUES ('$nama_kelas')";
        $result = mysqli_query($conn, $query);
        if ($result) {
            echo "<script>alert('Data kelas berhasil disimpan!')
                        document.location = 'kelas.php';
                    </script>";
        } else {
            echo "<script>alert('Data kelas gagal disimpan!')
                        document.location = 'kelas.php';
                    </script>";
        }
    }
}

if (isset($_GET['id_kelas'])) {
    $id_kelas = $_GET['id_kelas'];
    $query = mysqli_query($conn, "DELETE FROM kelas WHERE id_kelas = '$id_kelas'");
    if ($query) {
        echo "<script>alert('Data kelas berhasil dihapus!')
                    document.location = 'kelas.php';
                </script>";
    } else {
        echo "<script>alert('Data kelas gagal dihapus!')
                    document.location = 'kelas.php';
                </script>";
    }
}

?>

<div class="card mb-4">
    <div class="card-header bg-success py-3 d-flex justify-content-between">
        <h4 class="m-0 font-weight-bold text-light">Data Kelas</h4>
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
                    <th>Kelas</th>
                    <th width="80px">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $number = 1;
                $query = "SELECT * FROM kelas";
                $result = mysqli_query($conn, $query);
                while ($row = mysqli_fetch_assoc($result)) :
                ?>
                    <tr>
                        <td><?= $number++ ?></td>
                        <td><?= $row['nama_kelas'] ?></td>
                        <td>
                            <a href="editkelas.php?id_kelas=<?= $row['id_kelas'] ?>" class="btn btn-sm btn-warning"><span class="fas fa-edit"></span></a>
                            <a href="kelas.php?id_kelas=<?= $row['id_kelas'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Apakah yakin ingin menghapus data?')"><span class="fas fa-trash"></span></a>
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
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah Data Kelas</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="" method="POST" enctype="multipart/form-data">
                            <div class="form-group mb-3">
                                <label class="form-label" for="kelas">Kelas</label>
                                <input type="text" name="nama_kelas" id="kelas" class="form-control" placeholder="Masukkan Kelas" maxlength="10" required />
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