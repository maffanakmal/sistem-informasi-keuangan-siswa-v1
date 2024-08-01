<?php
    include 'function.php';

    if (isset($_SESSION['nisn'])) {
        // Jika pengguna sudah login, arahkan ke halaman yang sesuai
        if ($_SESSION['level'] == 'siswa') {
            // Jika role siswa, arahkan ke halaman siswa
            header("Location: siswa/index.php");
            exit;
        }

    }

    if (isset($_POST['login'])) {
        $nisn = $_POST['nisn'];
        $nis = $_POST['nis'];
    
        $query = mysqli_query($conn, "SELECT * FROM siswa WHERE nisn='$nisn' AND nis='$nis'");
    
        // Cek nisn
        if (mysqli_num_rows($query) === 1) {
            // Cek nis
            $row = mysqli_fetch_assoc($query);
            if ($row['nis'] === $nis) {
                session_start();
                // Set session untuk level role
                $_SESSION['nisn'] = $row['nisn'];
                $_SESSION['nama_siswa'] = $row['nama_siswa'];
                $_SESSION['level'] = 'siswa';
                
                header("Location: siswa/index.php");
            } 
        } else {
            echo "<script>alert('nisn atau nis Tidak Sesuai!')
                    document.location = 'index.php';
                </script>";
        }
        // Jika nisn atau nis salah
        $error = true;
    }
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="dist/css/style.css">
    <title>Aplikasi Keuangan SMP Nurul Iman</title>
</head>

<body>
    <section class="vh-100">
        <div class="container py-5 h-100">
            <div class="row d-flex align-items-center justify-content-center h-100">
                <div class="col-md-8 col-lg-7 col-xl-6">
                    <img src="dist/img/bg-login-2.jpg"
                        class="img-fluid" alt="Phone image">
                </div>
                <div class="col-md-7 col-lg-5 col-xl-5 offset-xl-1">
                    <h2>Selamat Datang</h2>
                    <p>Silahkan Login Untuk <b>Siswa</b></p>
                    <form action="" method="POST" enctype="multipart/form-data">
                        <div class="form-group mb-3">
                            <label class="form-label" for="nisn">Nomor Induk Siswa Nasional</label>
                            <input type="text" name="nisn" id="nisn" class="form-control" placeholder="NISN" required/>
                        </div>
                        <div class="form-group mb-3">
                            <label class="form-label" for="nis">Nomor Induk Siswa</label>
                            <input type="text" name="nis" id="nis" class="form-control" placeholder="NIS" required/>
                        </div>
                        <button type="submit" name="login" class="btn btn-primary btn-block mb-3">Masuk</button>
                    </form>
                    <a href="login.php" class="mt-3">Login Sebagai Petugas</a>
                </div>
            </div>
        </div>
    </section>

    <script src="dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://kit.fontawesome.com/0a37941526.js" crossorigin="anonymous"></script>
    <script src="dist/js/script.js"></script>
</body>

</html>