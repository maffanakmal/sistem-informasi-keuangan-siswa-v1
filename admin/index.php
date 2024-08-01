<?php
include 'header.php';
?>

<div class="text-center">
    <h2>Selamat Datang</h2>
    <h3>Di Aplikasi Keuangan SMP Nurul Iman Untuk Administrator</h3>
</div>
<hr>

<div class="row">
    <!-- Baris Pertama -->
    <div class="col-xl-4 col-md-6 mb-4">
        <div class="card border-left-primary h-100 py-2">
            <div class="card-body">
                <?php
                $query = "SELECT * FROM pembayaran_ppdb WHERE id_pembayaran_ppdb";
                $result = mysqli_query($conn, $query);
                $total_ppdb = mysqli_num_rows($result);

                $totalBiayaPpdb = 0;
                while ($row = mysqli_fetch_assoc($result)) {
                    $totalBiayaPpdb += $row['jumlah_bayar'];
                }
                ?>
                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                    Total Transaksi PPDB
                    <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $total_ppdb ?></div>
                    <hr>
                    Total Nominal PPDB
                    <div class="h5 mb-0 font-weight-bold text-gray-800"><?= rupiah($totalBiayaPpdb) ?></div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-4 col-md-6 mb-4">
        <div class="card border-left-primary h-100 py-2">
            <div class="card-body">
                <?php
                $query = "SELECT * FROM pembayaran_spp WHERE id_pembayaran_spp";
                $result = mysqli_query($conn, $query);
                $total_spp = mysqli_num_rows($result);

                $totalBiayaSpp = 0;
                while ($row = mysqli_fetch_assoc($result)) {
                    $totalBiayaSpp += $row['jumlah_bayar'];
                }
                ?>
                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                    Total Transaksi SPP
                    <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $total_spp ?></div>
                    <hr>
                    Total Nominal SPP
                    <div class="h5 mb-0 font-weight-bold text-gray-800"><?= rupiah($totalBiayaSpp) ?></div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-4 col-md-6 mb-4">
        <div class="card border-left-primary h-100 py-2">
            <div class="card-body">
                <?php
                $query = "SELECT * FROM pembayaran_buku WHERE id_pembayaran_buku";
                $result = mysqli_query($conn, $query);
                $total_buku = mysqli_num_rows($result);

                $totalBiayaBuku = 0;
                while ($row = mysqli_fetch_assoc($result)) {
                    $totalBiayaBuku += $row['jumlah_bayar'];
                }
                ?>
                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                    Total Transaksi Buku
                    <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $total_buku ?></div>
                    <hr>
                    Total Nominal buku
                    <div class="h5 mb-0 font-weight-bold text-gray-800"><?= rupiah($totalBiayaBuku) ?></div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-4 col-md-6 mb-4">
        <div class="card border-left-primary h-100 py-2">
            <div class="card-body">
                <?php
                $query = "SELECT * FROM pembayaran_kegiatan WHERE id_pembayaran_kegiatan";
                $result = mysqli_query($conn, $query);
                $total_kegiatan = mysqli_num_rows($result);

                $totalBiayaKegiatan = 0;
                while ($row = mysqli_fetch_assoc($result)) {
                    $totalBiayaKegiatan += $row['jumlah_bayar'];
                }
                ?>
                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                    Total Transaksi Kegiatan
                    <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $total_kegiatan ?></div>
                    <hr>
                    Total Nominal Kegiatan
                    <div class="h5 mb-0 font-weight-bold text-gray-800"><?= rupiah($totalBiayaKegiatan) ?></div>
                </div>
            </div>
        </div>
    </div>

    <!-- Baris Kedua -->
    <div class="col-xl-4 col-md-6 mb-4">
        <div class="card border-left-primary h-100 py-2">
            <div class="card-body">
                <?php
                $query = "SELECT * FROM siswa, kelas 
                                        WHERE siswa.id_kelas = kelas.id_kelas
                                        AND SUBSTRING_INDEX(kelas.nama_kelas, ' ', 1) = '1'";
                $result = mysqli_query($conn, $query);
                $total_siswa = mysqli_num_rows($result);
                ?>
                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                    Total Siswa Kelas VII
                    <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $total_siswa ?></div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-4 col-md-6 mb-4">
        <div class="card border-left-primary h-100 py-2">
            <div class="card-body">
                <?php
                $query = "SELECT * FROM siswa, kelas 
                                        WHERE siswa.id_kelas = kelas.id_kelas
                                        AND SUBSTRING_INDEX(kelas.nama_kelas, ' ', 1) = '2'";
                $result = mysqli_query($conn, $query);
                $total_siswa = mysqli_num_rows($result);
                ?>
                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                    Total Siswa Kelas VIII
                    <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $total_siswa ?></div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-4 col-md-6 mb-4">
        <div class="card border-left-primary h-100 py-2">
            <div class="card-body">
                <?php
                $query = "SELECT * FROM siswa, kelas 
                                        WHERE siswa.id_kelas = kelas.id_kelas
                                        AND nama_kelas = SUBSTRING_INDEX(kelas.nama_kelas, ' ', 1) = '3'";
                $result = mysqli_query($conn, $query);
                $total_siswa = mysqli_num_rows($result);
                ?>
                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                    Total Siswa Kelas IX
                    <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $total_siswa ?></div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
include 'footer.php';
?>