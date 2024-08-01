<?php
include 'header.php';
include '../function.php';

if (!isset($_SESSION['nisn'])) {
    header('Location: ../index.php');
    exit;
}

if (isset($_POST['edit'])) {
    // ambil data dari masing masing form
    $nisn = $_SESSION['nisn'];
    $no_telp = htmlentities(strip_tags(($_POST['no_telp'])));
    $alamat = htmlentities(strip_tags(($_POST['alamat'])));
    //proses simpan
    $query = "UPDATE siswa SET no_telp = '$no_telp', alamat = '$alamat' WHERE nisn = '$nisn'";
    $result = mysqli_query($conn, $query);
    if ($result) {
        $_SESSION['nisn'] = $nisn;
        echo "<script>alert('Data berhasil diubah!')
                        document.location = 'index.php';
                    </script>";
    } else {
        echo "<script>alert('Data gagal diubah!')
                        document.location = 'index.php';
                    </script>";
    }
}

?>

<div class="card mb-4">
    <div class="card-header bg-success py-3 d-flex justify-content-between">
        <h5 class="m-0 font-weight-bold text-light">Pengaturan</h5>
    </div>
    <div class="card-body">
        <?php
        $nisn = $_SESSION['nisn'];
        $query = mysqli_query($conn, "SELECT * FROM siswa WHERE nisn = '$nisn'");
        $row = mysqli_fetch_assoc($query);
        ?>
        <form action="" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="nisn" value="<?= $row['nisn'] ?>">
            <div class="form-group mb-3">
                <label class="form-label" for="no_telp">Nomor Telepon</label>
                <input type="text" name="no_telp" id="no_telp" class="form-control" value="<?= $row['no_telp'] ?>" />
            </div>
            <div class="form-group mb-3">
                <label class="form-label" for="alamat">Alamat</label>
                <textarea type="text" name="alamat" id="alamat" class="form-control"><?= $row['alamat'] ?></textarea>
            </div>
            <div>
                <a href="index.php" class="btn btn-secondary">Kembali</a>
                <button type="submit" name="edit" class="btn btn-primary">Simpan</button>
        </form>
    </div>

    <?php
    include 'footer.php';
    ?>