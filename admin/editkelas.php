<?php
include 'header.php';
include '../function.php';

if (!isset($_SESSION['id_petugas'])) {
    header('Location: ../login.php');
    exit;
}

if (isset($_POST['edit'])) {
    // ambil data dari masing masing form
    $id_kelas = $_GET['id_kelas'];
    $nama_kelas = htmlentities(strip_tags($_POST['nama_kelas']));

    //proses simpan
    $query = "UPDATE kelas SET nama_kelas = '$nama_kelas' WHERE id_kelas = '$id_kelas'";
    $result = mysqli_query($conn, $query);
    if ($result) {
        echo "<script>alert('Data kelas berhasil diubah!')
                        document.location = 'kelas.php';
                    </script>";
    } else {
        echo "<script>alert('Data kelas gagal diubah!')
                        document.location = 'kelas.php';
                    </script>";
    }
}

?>

<div class="card mb-4">
    <div class="card-header bg-success py-3 d-flex justify-content-between">
        <h5 class="m-0 font-weight-bold text-light">Edit data Kelas</h5>
    </div>
    <div class="card-body">
    <?php
        $id_kelas = $_GET['id_kelas'];
        $query = mysqli_query($conn, "SELECT * FROM kelas WHERE id_kelas = '$id_kelas'");
        $row = mysqli_fetch_assoc($query);
        ?>
        <form action="" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="id_kelas" value="<?= $row['id_kelas'] ?>">
            <div class="form-group mb-3">
                <label class="form-label" for="nama_kelas">Kelas</label>
                <input type="text" name="nama_kelas" id="nama_kelas" class="form-control" value="<?= $row['nama_kelas'] ?>" />
            </div>
            <div>
                <a href="kelas.php" class="btn btn-secondary">Kembali</a>
                <button type="submit" name="edit" class="btn btn-primary">Edit</button>
        </form>
    </div>
</div>

    <?php
    include 'footer.php';
    ?>