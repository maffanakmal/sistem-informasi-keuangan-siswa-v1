<?php
include 'header.php';
include '../function.php';

if (!isset($_SESSION['id_petugas'])) {
    header('Location: ../login.php');
    exit;
}

if (isset($_POST['edit'])) {
    // ambil data dari masing masing form
    $id_spp = $_GET['id_spp'];
    $tahun = htmlentities(strip_tags($_POST['tahun']));
    $nominal_spp = htmlentities(strip_tags($_POST['nominal_spp']));
    //proses simpan
    $query = "UPDATE spp SET tahun = '$tahun', nominal_spp = '$nominal_spp' WHERE id_spp = '$id_spp'";
    $result = mysqli_query($conn, $query);
    if ($result) {
        echo "<script>alert('Data angkatan berhasil diubah!')
                        document.location = 'spp.php';
                    </script>";
    } else {
        echo "<script>alert('Data angkatan gagal diubah!')
                        document.location = 'spp.php';
                    </script>";
    }
}

?>

<div class="card mb-4">
    <div class="card-header bg-success py-3 d-flex justify-content-between">
        <h5 class="m-0 font-weight-bold text-light">Edit Data SPP</h5>
    </div>
    <div class="card-body">
        <?php
            $id_spp = $_GET['id_spp'];
            $query = mysqli_query($conn, "SELECT * FROM spp WHERE id_spp = '$id_spp'");
            $row = mysqli_fetch_assoc($query);
        ?>
        <form action="" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="id_spp" value="<?= $row['id_spp'] ?>">
            <div class="form-group mb-3">
                <label class="form-label" for="tahun">Tahun</label>
                <input type="text" name="tahun" id="tahun" class="form-control" value="<?= $row['tahun'] ?>" />
            </div>
            <div class="form-group mb-3">
                <label class="form-label" for="nominal_spp">Nominal SPP</label>
                <input type="text" name="nominal_spp" id="nominal_spp" class="form-control" value="<?= $row['nominal_spp'] ?>" />
            </div>
            <div>
                <a href="spp.php" class="btn btn-secondary">Kembali</a> 
                <button type="submit" name="edit" class="btn btn-primary">Edit</button>
            </form>
        </div>
    </div>
    <?php
    include 'footer.php';
    ?>