<?php
    session_start();
    include 'function.php';

    if (isset($_SESSION['id_petugas'])) {
        // Jika pengguna sudah login, arahkan ke halaman yang sesuai
        if ($_SESSION['level'] == 'admin') {
            header("Location: admin/index.php");
            exit;
        } elseif ($_SESSION['level'] == 'petugas') {
            header("Location: petugas/index.php");
            exit;
        }
    }

    if (isset($_POST['login'])) {
        $username = $_POST['user_name'];
        $password = $_POST['pass_word']; 
    
        $query = mysqli_query($conn, "SELECT * FROM petugas WHERE user_name='$username' AND pass_word='$password'");
    
        // Cek username
        if (mysqli_num_rows($query) === 1) {
            // Cek password
            $row = mysqli_fetch_assoc($query);
            if ($row['pass_word'] == $password){
                session_start();
                // Set session untuk level role
                $_SESSION['id_petugas'] = $row['id_petugas'];
                $_SESSION['nama_petugas'] = $row['nama_petugas'];
                $_SESSION['level'] = $row['level'];
    
                // Redirect sesuai level_role
                if (isset($_SESSION['id_petugas'])) {
                    // Jika pengguna sudah login, arahkan ke halaman yang sesuai
                    if ($_SESSION['level'] == 'admin') {
                        header("Location: admin/index.php");
                    } elseif ($_SESSION['level'] == 'petugas') {
                        header("Location: petugas/index.php");
                    }
                }
            } 
        } else {
            echo "<script>alert('Username atau Password Tidak Sesuai!')
                    document.location = 'login.php';
                </script>";
        }
        // Jika username atau password salah
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
                    <p>Silahkan Login Untuk <b>Petugas</b></p>
                    <form action="" method="POST" enctype="multipart/form-data">
                        <div class="form-group mb-3">
                            <label class="form-label" for="username">Username</label>
                            <input type="text" name="user_name" id="username" class="form-control" placeholder="Username" required maxlength="50"/>
                        </div>
                        <div class="form-group mb-3">
                            <label class="form-label" for="password">Password</label>
                            <input type="password" name="pass_word" id="password" class="form-control" placeholder="Password" required maxlength="64"/>
                        </div>
                        <button type="submit" name="login" class="btn btn-primary btn-block mb-3">Masuk</button>
                    </form>
                    <a href="index.php" class="mt-3">Login Sebagai Siswa</a>
                </div>
            </div>
        </div>
    </section>

    <script src="dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://kit.fontawesome.com/0a37941526.js" crossorigin="anonymous"></script>
    <script src="dist/js/script.js"></script>
</body>

</html>