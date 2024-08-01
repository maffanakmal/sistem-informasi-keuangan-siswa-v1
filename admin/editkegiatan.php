<?php
include 'header.php';
include '../function.php';

if (!isset($_SESSION['id_petugas'])) {
    header('Location: ../login.php');
    exit;
}

if (isset($_POST['edit'])) {
    // ambil data dari masing masing form
    $id_kegiatan = $_GET['id_kegiatan'];
    $nama_kegiatan = htmlentities(strip_tags($_POST['nama_kegiatan']));
    $nominal_kegiatan = htmlentities(strip_tags($_POST['nominal_kegiatan']));
    //proses simpan
    $query = "UPDATE kegiatan SET nama_kegiatan = '$nama_kegiatan', nominal_kegiatan = '$nominal_kegiatan' WHERE id_kegiatan = '$id_kegiatan'";
    $result = mysqli_query($conn, $query);
    if ($result) {
        echo "<script>alert('Data kegiatan berhasil diubah!')
                        document.location = 'kegiatan.php';
                    </script>";
    } else {
        echo "<script>alert('Data kegiatan gagal diubah!')
                        document.location = 'kegiatan.php';
                    </script>";
    }
}

?>

<div class="card mb-4">
    <div class="card-header bg-success py-3 d-flex justify-content-between">
        <h5 class="m-0 font-weight-bold text-light">Edit Data Kegiatan</h5>
    </div>
    <div class="card-body">
    <?php
        $id_kegiatan = $_GET['id_kegiatan'];
        $query = mysqli_query($conn, "SELECT * FROM kegiatan WHERE id_kegiatan = '$id_kegiatan'");
        $row = mysqli_fetch_assoc($query);
        ?>
        <form action="" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="id_kegiatan" value="<?= $row['id_kegiatan'] ?>">
            <div class="form-group mb-3">
                <label class="form-label" for="nama_kegiatan">Nama Kegiatan</label>
                <input type="text" name="nama_kegiatan" id="nama_kegiatan" class="form-control" value="<?= $row['nama_kegiatan'] ?>" />
            </div>
            <div class="form-group mb-3">
                <label class="form-label" for="nominal_kegiatan">Nominal</label>
                <input type="text" name="nominal_kegiatan" id="nominal_kegiatan" class="form-control" value="<?= $row['nominal_kegiatan'] ?>" />
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