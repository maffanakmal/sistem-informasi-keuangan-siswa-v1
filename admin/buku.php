<?php
include 'header.php';
include '../function.php';

if (!isset($_SESSION['id_petugas'])) {
    header('Location: ../login.php');
    exit;
}

if (isset($_POST['simpan'])) {
    // ambil data dari masing masing form
    $nama_buku = htmlentities(strip_tags(($_POST['nama_buku'])));
    $nominal_buku = htmlentities(strip_tags(($_POST['nominal_buku'])));

    // validasi
    $sql = "SELECT * FROM buku WHERE nama_buku ='$nama_buku'";
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) {
        echo "<script>alert('Data Buku sudah ada')
                    document.location = 'buku.php';
                </script>";
    } else {
        //proses simpan
        $query = "INSERT INTO buku (nama_buku, nominal_buku) VALUES ('$nama_buku', '$nominal_buku')";
        $result = mysqli_query($conn, $query);
        if ($result) {
            echo "<script>alert('Data Buku berhasil disimpan!')
                        document.location = 'buku.php';
                    </script>";
        } else {
            echo "<script>alert('Data Buku gagal disimpan!')
                        document.location = 'buku.php';
                    </script>";
        }
    }
}

if (isset($_GET['id_buku'])) {
    $id_buku = $_GET['id_buku'];
    $query = mysqli_query($conn, "DELETE FROM buku WHERE id_buku = '$id_buku'");
    if ($query) {
        echo "<script>alert('Data buku berhasil dihapus!')
                    document.location = 'buku.php';
                </script>";
    } else {
        echo "<script>alert('Data buku gagal dihapus!')
                    document.location = 'buku.php';
                </script>";
    }
}

?>

<div class="card mb-4">
    <div class="card-header bg-success py-3 d-flex justify-content-between">
        <h4 class="m-0 font-weight-bold text-light">Data Buku</h4>
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
                    <th>Nama Buku</th>
                    <th>Nominal</th>
                    <th width="80px">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $number = 1;
                $query = "SELECT * FROM buku";
                $result = mysqli_query($conn, $query);
                while ($row = mysqli_fetch_assoc($result)) :
                ?>
                    <tr>
                        <td><?= $number++ ?></td>
                        <td><?= $row['nama_buku'] ?></td>
                        <td><?= rupiah($row['nominal_buku']) ?></td>
                        <td>
                            <a href="editbuku.php?id_buku=<?= $row['id_buku'] ?>" class="btn btn-sm btn-warning"><span class="fas fa-edit"></span></a>
                            <a href="buku.php?id_buku=<?= $row['id_buku'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Apakah yakin ingin menghapus data?')"><span class="fas fa-trash"></span></a>
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
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah Data Buku</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="" method="POST" enctype="multipart/form-data">
                            <div class="form-group mb-3">
                                <label class="form-label" for="nama_buku">Nama Buku</label>
                                <input type="text" name="nama_buku" id="nama_buku" class="form-control" placeholder="Masukkan Nama Buku" maxlength="25" required />
                            </div>
                            <div class="form-group mb-3">
                                <label class="form-label" for="nominal_buku">Nominal</label>
                                <input type="text" name="nominal_buku" id="nominal_buku" class="form-control" placeholder="Masukkan Nominal" maxlength="13" required />
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