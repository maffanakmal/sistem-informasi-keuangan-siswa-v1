<?php
include 'header.php';

?>

<div class="text-center">
    <h2>Selamat Datang</h2>
    <h3>Di Aplikasi Keuangan SMP Nurul Iman Untuk Siswa</h3>
</div>
<hr>

<div class="row">
    <!-- Baris Pertama -->
    <?php
    $nisn = $_SESSION['nisn'];
    $query = "SELECT * FROM siswa, ppdb
                WHERE siswa.id_ppdb = ppdb.id_ppdb
                AND nisn = $nisn";
    $result = mysqli_query($conn, $query);
    $row = mysqli_fetch_assoc($result);
    $data_pembayaran = mysqli_query($conn, "SELECT SUM(jumlah_bayar) as jumlah_bayar 
                                        FROM pembayaran_ppdb WHERE nisn = '$row[nisn]'");
    $data_pembayaran = mysqli_fetch_assoc($data_pembayaran);
    $sudah_bayar = $data_pembayaran['jumlah_bayar'];
    $kekurangan = $row['nominal_ppdb'] - $data_pembayaran['jumlah_bayar'];
    if ($kekurangan != 0) {
        echo "<div class='col-xl-4 col-md-6 mb-4'>
            <div class='card border-left-primary h-100 py-2'>
                <div class='card-body'>
                    <div class='text-xs font-weight-bold text-primary text-uppercase mb-1'>
                        Sisa Pembayaran PPDB
                        <div class='h5 mb-0 font-weight-bold text-gray-800'><b>" . rupiah($kekurangan) . "</b></div>
                    </div>
                </div>
            </div>
        </div>";
    }
    ?>
    <div class="col-xl-4 col-md-6 mb-4">
        <div class="card border-left-primary h-100 py-2">
            <div class="card-body">
                <?php
                $nisn = $_SESSION['nisn'];
                $query = "SELECT * FROM siswa, spp
                            WHERE siswa.id_spp = spp.id_spp
                            AND nisn = $nisn";
                $result = mysqli_query($conn, $query);
                $row = mysqli_fetch_assoc($result);
                $data_pembayaran = mysqli_query($conn, "SELECT SUM(jumlah_bayar) as jumlah_bayar 
                                                                            FROM pembayaran_spp WHERE nisn = '$row[nisn]'");
                $data_pembayaran = mysqli_fetch_assoc($data_pembayaran);
                $sudah_bayar = $data_pembayaran['jumlah_bayar'];
                $kekurangan = $row['nominal_spp'] - $data_pembayaran['jumlah_bayar'];
                ?>
                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                    Sisa Pembayaran SPP
                    <div class="h5 mb-0 font-weight-bold text-gray-800"><b><?= rupiah($kekurangan) ?></b></div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-4 col-md-6 mb-4">
        <div class="card border-left-primary h-100 py-2">
            <div class="card-body">
                <?php
                $nisn = $_SESSION['nisn'];
                $query = "SELECT * FROM siswa, buku
                            WHERE siswa.id_buku = buku.id_buku
                            AND nisn = $nisn";
                $result = mysqli_query($conn, $query);
                $row = mysqli_fetch_assoc($result);
                $data_pembayaran = mysqli_query($conn, "SELECT SUM(jumlah_bayar) as jumlah_bayar 
                                                                            FROM pembayaran_buku WHERE nisn = '$row[nisn]'");
                $data_pembayaran = mysqli_fetch_assoc($data_pembayaran);
                $sudah_bayar = $data_pembayaran['jumlah_bayar'];
                $kekurangan = $row['nominal_buku'] - $data_pembayaran['jumlah_bayar'];
                ?>
                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                    Sisa Pembayaran Buku
                    <div class="h5 mb-0 font-weight-bold text-gray-800"><b><?= rupiah($kekurangan) ?></b></div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-4 col-md-6 mb-4">
        <div class="card border-left-primary h-100 py-2">
            <div class="card-body">
                <?php
                $nisn = $_SESSION['nisn'];
                $query = "SELECT * FROM siswa, kegiatan
                            WHERE siswa.id_kegiatan = kegiatan.id_kegiatan
                            AND nisn = $nisn";
                $result = mysqli_query($conn, $query);
                $row = mysqli_fetch_assoc($result);
                $data_pembayaran = mysqli_query($conn, "SELECT SUM(jumlah_bayar) as jumlah_bayar 
                                                                            FROM pembayaran_kegiatan WHERE nisn = '$row[nisn]'");
                $data_pembayaran = mysqli_fetch_assoc($data_pembayaran);
                $sudah_bayar = $data_pembayaran['jumlah_bayar'];
                $kekurangan = $row['nominal_kegiatan'] - $data_pembayaran['jumlah_bayar'];
                ?>
                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                    Sisa Pembayaran Kegiatan
                    <div class="h5 mb-0 font-weight-bold text-gray-800"><b><?= rupiah($kekurangan) ?></b></div>
                </div>
            </div>
        </div>
    </div>

    
</div>

<?php
include 'footer.php';
?>