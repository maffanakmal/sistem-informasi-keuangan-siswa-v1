<?php
include 'header.php';
include '../function.php';

if (!isset($_SESSION['id_petugas'])) {
    header('Location: ../login.php');
    exit;
}

if (isset($_POST['edit'])) {
    // ambil data dari masing masing form
    $id_buku = $_GET['id_buku'];
    $nama_buku = htmlentities(strip_tags($_POST['nama_buku']));
    $nominal_buku = htmlentities(strip_tags($_POST['nominal_buku']));
    //proses simpan
    $query = "UPDATE buku SET nama_buku = '$nama_buku', nominal_buku = '$nominal_buku' WHERE id_buku = '$id_buku'";
    $result = mysqli_query($conn, $query);
    if ($result) {
        echo "<script>alert('Data buku berhasil diubah!')
                        document.location = 'buku.php';
                    </script>";
    } else {
        echo "<script>alert('Data buku gagal diubah!')
                        document.location = 'buku.php';
                    </script>";
    }
}

?>

<div class="card mb-4">
    <div class="card-header bg-success py-3 d-flex justify-content-between">
        <h5 class="m-0 font-weight-bold text-light">Edit Data Buku</h5>
    </div>
    <div class="card-body">
    <?php
        $id_buku = $_GET['id_buku'];
        $query = mysqli_query($conn, "SELECT * FROM buku WHERE id_buku = '$id_buku'");
        $row = mysqli_fetch_assoc($query);
        ?>
        <form action="" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="id_buku" value="<?= $row['id_buku'] ?>">
            <div class="form-group mb-3">
                <label class="form-label" for="nama_buku">Nama Buku</label>
                <input type="text" name="nama_buku" id="nama_buku" class="form-control" value="<?= $row['nama_buku'] ?>" maxlength="25"/>
            </div>
            <div class="form-group mb-3">
                <label class="form-label" for="nominal_buku">Nominal</label>
                <input type="text" name="nominal_buku" id="nominal_buku" class="form-control" value="<?= $row['nominal_buku'] ?>" maxlength="13"/>
            </div>
            <div>
                <a href="buku.php" class="btn btn-secondary">Kembali</a>
                <button type="submit" name="edit" class="btn btn-primary">Edit</button>
        </form>
    </div>
</div>

    <?php
    include 'footer.php';
    ?>