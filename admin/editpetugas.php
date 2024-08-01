<?php
include 'header.php';
include '../function.php';

if (!isset($_SESSION['id_petugas'])) {
    header('Location: ../login.php');
    exit;
}

if (isset($_POST['edit'])) {
    // ambil data dari masing masing form
    $id_petugas = $_GET['id_petugas'];
    $username = htmlentities(strip_tags(($_POST['user_name'])));
    $password = htmlentities(strip_tags(($_POST['pass_word'])));
    $password_hash = hash('sha256', $password);
    $nama_petugas = htmlentities(strip_tags(($_POST['nama_petugas']))); 
    $level = htmlentities(strip_tags(($_POST['level']))); 
    //proses simpan
    $query = "UPDATE petugas SET user_name = '$username', pass_word = '$password_hash', nama_petugas = '$nama_petugas', level = '$level' WHERE id_petugas = '$id_petugas'";
    $result = mysqli_query($conn, $query);
    if ($result) {
        echo "<script>alert('Data petugas berhasil diubah!')
                        document.location = 'petugas.php';
                    </script>";
    } else {
        echo "<script>alert('Data petugas gagal diubah!')
                        document.location = 'petugas.php';
                    </script>";
    }
}

?>

<div class="card mb-4">
    <div class="card-header bg-success py-3 d-flex justify-content-between">
        <h5 class="m-0 font-weight-bold text-light">Edit Data Petugas</h5>
    </div>
    <div class="card-body">
        <?php
        $id_petugas = $_GET['id_petugas'];
        $query = mysqli_query($conn, "SELECT * FROM petugas WHERE id_petugas = '$id_petugas'");
        $row = mysqli_fetch_assoc($query);
        ?>
        <form action="" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="id_petugas" value="<?= $row['id_petugas'] ?>">
            <div class="form-group mb-3">
                <label class="form-label" for="username">Username</label>
                <input type="text" name="user_name" id="username" class="form-control" value="<?= $row['user_name'] ?>" maxlength="50"/>
            </div>
            <div class="form-group mb-3">
                <label class="form-label" for="password">Password</label>
                <input type="text" name="pass_word" id="password" class="form-control" value="<?= $row['pass_word'] ?>" maxlength="64"/>
            </div>
            <div class="form-group mb-3">
                <label class="form-label" for="nama_petugas">Nama Petugas</label>
                <input type="text" name="nama_petugas" id="nama_petugas" class="form-control" value="<?= $row['nama_petugas'] ?>" maxlength="50"/>
            </div>
            <div class="form-group mb-3">
                <label class="form-label" for="level">Level</label>
                <input type="text" name="level" id="level" class="form-control" value="<?= $row['level'] ?>" readonly/>
            </div>
            <div>
                <a href="petugas.php" class="btn btn-secondary">Kembali</a>
                <button type="submit" name="edit" class="btn btn-primary">Edit</button>
        </form>
    </div>

    <?php
    include 'footer.php';
    ?>