<?php
include 'header.php';
include '../function.php';

if (!isset($_SESSION['id_petugas'])) {
    header('Location: ../login.php');
    exit;
}

if (isset($_POST['edit'])) {
    // ambil data dari masing masing form
    $id_ppdb = $_GET['id_ppdb'];
    $nama_ppdb = htmlentities(strip_tags($_POST['nama_ppdb']));
    $nominal_ppdb = htmlentities(strip_tags($_POST['nominal_ppdb']));
    //proses simpan
    $query = "UPDATE ppdb SET nama_ppdb = '$nama_ppdb', nominal_ppdb = '$nominal_ppdb' WHERE id_ppdb = '$id_ppdb'";
    $result = mysqli_query($conn, $query);
    if ($result) {
        echo "<script>alert('Data ppdb berhasil diubah!')
                        document.location = 'ppdb.php';
                    </script>";
    } else {
        echo "<script>alert('Data ppdb gagal diubah!')
                        document.location = 'ppdb.php';
                    </script>";
    }
}

?>

<div class="card mb-4">
    <div class="card-header bg-success py-3 d-flex justify-content-between">
        <h5 class="m-0 font-weight-bold text-light">Edit Data PPDB</h5>
    </div>
    <div class="card-body">
    <?php
        $id_ppdb = $_GET['id_ppdb'];
        $query = mysqli_query($conn, "SELECT * FROM ppdb WHERE id_ppdb = '$id_ppdb'");
        $row = mysqli_fetch_assoc($query);
        ?>
        <form action="" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="id_ppdb" value="<?= $row['id_ppdb'] ?>">
            <div class="form-group mb-3">
                <label class="form-label" for="nama_ppdb">Nama PPDB</label>
                <input type="text" name="nama_ppdb" id="nama_ppdb" class="form-control" value="<?= $row['nama_ppdb'] ?>" maxlength="35"/>
            </div>
            <div class="form-group mb-3">
                <label class="form-label" for="nominal_ppdb">Nominal</label>
                <input type="text" name="nominal_ppdb" id="nominal_ppdb" class="form-control" value="<?= $row['nominal_ppdb'] ?>" maxlength="13"/>
            </div>
            <div>
                <a href="ppdb.php" class="btn btn-secondary">Kembali</a>
                <button type="submit" name="edit" class="btn btn-primary">Edit</button>
        </form>
    </div>
</div>

    <?php
    include 'footer.php';
    ?>