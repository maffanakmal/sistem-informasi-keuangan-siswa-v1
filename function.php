<?php
    $conn = mysqli_connect('localhost', 'root', '', 'keuangan_smp');

    if (!function_exists('rupiah')) {
        function rupiah($rp){
            $jumlah = number_format($rp, 0,",",".");
            $rupiah = "Rp ".$jumlah;
            return $rupiah;
        }
    }
?>