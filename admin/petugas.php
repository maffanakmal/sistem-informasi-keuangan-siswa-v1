<?php
include 'header.php';
include '../function.php';

if (!isset($_SESSION['id_petugas'])) {
    header('Location: ../login.php');
    exit;
}

if (isset($_POST['simpan'])) {
    // ambil data dari masing masing form
    $username = htmlentities(strip_tags(($_POST['user_name'])));
    $password = htmlentities(strip_tags(($_POST['pass_word'])));
    $nama_petugas = htmlentities(strip_tags(($_POST['nama_petugas'])));
    $level = htmlentities(strip_tags(($_POST['level'])));

    // validasi
    $sql = "SELECT * FROM petugas WHERE nama_petugas ='$nama_petugas'";
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) {
        echo "<script>alert('Data petugas sudah ada')
                    document.location = 'petugas.php';
                </script>";
    } else {
        //proses simpan
        $query = "INSERT INTO petugas (user_name, pass_word, nama_petugas, level) VALUES ('$username', '$password', '$nama_petugas', '$level')";
        $result = mysqli_query($conn, $query);
        if ($result) {
            echo "<script>alert('Data petugas berhasil disimpan!')
                        document.location = 'petugas.php';
                    </script>";
        } else {
            echo "<script>alert('Data petugas gagal disimpan!')
                        document.location = 'petugas.php';
                    </script>";
        }
    }
}

if (isset($_GET['id_petugas'])) {
    $id_petugas = $_GET['id_petugas'];
    $query = mysqli_query($conn, "DELETE FROM petugas WHERE id_petugas = '$id_petugas'");
    if ($query) {
        echo "<script>alert('Data petugas berhasil dihapus!')
                    document.location = 'petugas.php';
                </script>";
    } else {
        echo "<script>alert('Data petugas gagal dihapus!')
                    document.location = 'petugas.php';
                </script>";
    }
}

?>

<div class="card mb-4">
    <div class="card-header bg-success py-3 d-flex justify-content-between">
        <h4 class="m-0 font-weight-bold text-light">Data Petugas</h4>
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
                    <th>Username</th>
                    <th>Password</th>
                    <th>Nama Petugas</th>
                    <th>Level</th>
                    <th width="80px">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $number = 1;
                $query = "SELECT * FROM petugas";
                $result = mysqli_query($conn, $query);
                while ($row = mysqli_fetch_assoc($result)) :
                ?>
                    <tr>
                        <td><?= $number++ ?></td>
                        <td><?= $row['user_name'] ?></td>
                        <td><?= substr($row['pass_word'], 0, 25) ?></td>
                        <td><?= $row['nama_petugas'] ?></td>
                        <td><?= $row['level'] ?></td>
                        <td>
                            <a href="editpetugas.php?id_petugas=<?= $row['id_petugas'] ?>" class="btn btn-sm btn-warning"><span class="fas fa-edit"></span></a>
                            <a href="petugas.php?id_petugas=<?= $row['id_petugas'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Apakah yakin ingin menghapus data?')"><span class="fas fa-trash"></span></a>
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
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah Data Petugas</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="" method="POST" enctype="multipart/form-data">
                            <div class="form-group mb-3">
                                <label class="form-label" for="username">Username</label>
                                <input type="text" name="user_name" id="username" class="form-control" placeholder="Masukkan Username" required maxlength="50" />
                            </div>
                            <div class="form-group mb-3">
                                <label class="form-label" for="password">Password</label>
                                <input type="text" name="pass_word" id="password" class="form-control" placeholder="Masukkan Password" required maxlength="64" />
                            </div>
                            <div class="form-group mb-3">
                                <label class="form-label" for="nama_petugas">Nama Petugas</label>
                                <input type="text" name="nama_petugas" id="nama_petugas" class="form-control" placeholder="Masukkan Nama" required maxlength="50" />
                            </div>
                            <div class="form-group mb-3">
                                <label for="level" class="form-label">Level</label>
                                <select name="level" id="level" class="form-control">
                                    <option selected>--Pilih Level--</option>
                                    <option value="admin">Administrator</option>
                                    <option value="petugas">Bendahara</option>
                                </select>
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