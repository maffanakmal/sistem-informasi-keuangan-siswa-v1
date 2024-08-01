-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 10, 2024 at 03:09 AM
-- Server version: 10.4.25-MariaDB
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `keaungan_smp`
--

-- --------------------------------------------------------

--
-- Table structure for table `buku`
--

CREATE TABLE `buku` (
  `id_buku` int(11) NOT NULL,
  `nama_buku` varchar(25) NOT NULL,
  `nominal_buku` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `buku`
--

INSERT INTO `buku` (`id_buku`, `nama_buku`, `nominal_buku`) VALUES
(1, 'Semester 1 + Daftar ulang', 275000),
(2, 'Semester 2', 345000);

-- --------------------------------------------------------

--
-- Table structure for table `kegiatan`
--

CREATE TABLE `kegiatan` (
  `id_kegiatan` int(11) NOT NULL,
  `nama_kegiatan` varchar(30) NOT NULL,
  `nominal_kegiatan` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `kegiatan`
--

INSERT INTO `kegiatan` (`id_kegiatan`, `nama_kegiatan`, `nominal_kegiatan`) VALUES
(1, 'Outbond Kelas 1', 250000),
(2, 'Outbond Kelas 2', 275000),
(3, 'Outbond Kelas 3', 300000);

-- --------------------------------------------------------

--
-- Table structure for table `kelas`
--

CREATE TABLE `kelas` (
  `id_kelas` int(11) NOT NULL,
  `nama_kelas` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `kelas`
--

INSERT INTO `kelas` (`id_kelas`, `nama_kelas`) VALUES
(1, '1 - A'),
(2, '2 - A'),
(3, '3 - A');

-- --------------------------------------------------------

--
-- Table structure for table `pembayaran_buku`
--

CREATE TABLE `pembayaran_buku` (
  `id_pembayaran_buku` int(11) NOT NULL,
  `id_petugas` int(11) NOT NULL,
  `nisn` varchar(10) NOT NULL,
  `tgl_bayar` date NOT NULL,
  `id_buku` int(11) NOT NULL,
  `jumlah_bayar` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pembayaran_buku`
--

INSERT INTO `pembayaran_buku` (`id_pembayaran_buku`, `id_petugas`, `nisn`, `tgl_bayar`, `id_buku`, `jumlah_bayar`) VALUES
(8, 1, '211000001', '2023-12-28', 2, 345000);

-- --------------------------------------------------------

--
-- Table structure for table `pembayaran_kegiatan`
--

CREATE TABLE `pembayaran_kegiatan` (
  `id_pembayaran_kegiatan` int(11) NOT NULL,
  `id_petugas` int(11) NOT NULL,
  `nisn` varchar(10) NOT NULL,
  `tgl_bayar` date NOT NULL,
  `id_kegiatan` int(11) NOT NULL,
  `jumlah_bayar` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pembayaran_kegiatan`
--

INSERT INTO `pembayaran_kegiatan` (`id_pembayaran_kegiatan`, `id_petugas`, `nisn`, `tgl_bayar`, `id_kegiatan`, `jumlah_bayar`) VALUES
(2, 1, '211000001', '0000-00-00', 3, 300000),
(3, 1, '211000002', '2023-12-28', 3, 300000);

-- --------------------------------------------------------

--
-- Table structure for table `pembayaran_ppdb`
--

CREATE TABLE `pembayaran_ppdb` (
  `id_pembayaran_ppdb` int(11) NOT NULL,
  `id_petugas` int(11) NOT NULL,
  `nisn` varchar(10) NOT NULL,
  `tgl_bayar` date NOT NULL,
  `id_ppdb` int(11) NOT NULL,
  `jumlah_bayar` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pembayaran_ppdb`
--

INSERT INTO `pembayaran_ppdb` (`id_pembayaran_ppdb`, `id_petugas`, `nisn`, `tgl_bayar`, `id_ppdb`, `jumlah_bayar`) VALUES
(3, 1, '211000003', '2023-12-28', 1, 700000);

-- --------------------------------------------------------

--
-- Table structure for table `pembayaran_spp`
--

CREATE TABLE `pembayaran_spp` (
  `id_pembayaran_spp` int(11) NOT NULL,
  `id_petugas` int(11) NOT NULL,
  `nisn` varchar(10) NOT NULL,
  `tgl_bayar` date NOT NULL,
  `bulan_dibayar` varchar(8) NOT NULL,
  `tahun_dibayar` varchar(4) NOT NULL,
  `id_spp` int(11) NOT NULL,
  `jumlah_bayar` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pembayaran_spp`
--

INSERT INTO `pembayaran_spp` (`id_pembayaran_spp`, `id_petugas`, `nisn`, `tgl_bayar`, `bulan_dibayar`, `tahun_dibayar`, `id_spp`, `jumlah_bayar`) VALUES
(7, 1, '211000002', '2023-12-27', 'Februari', '2023', 1, 300000),
(8, 1, '211000002', '2023-12-27', 'Februari', '2023', 1, 50000),
(9, 1, '211000001', '2023-12-29', 'Maret', '2023', 2, 400000),
(10, 1, '211000003', '2024-01-03', 'Januari', '2024', 3, 250000),
(11, 2, '211000003', '2024-01-09', 'Februari', '2024', 3, 200000);

-- --------------------------------------------------------

--
-- Table structure for table `petugas`
--

CREATE TABLE `petugas` (
  `id_petugas` int(11) NOT NULL,
  `user_name` varchar(50) NOT NULL,
  `pass_word` varchar(64) NOT NULL,
  `nama_petugas` varchar(50) NOT NULL,
  `level` enum('admin','petugas') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `petugas`
--

INSERT INTO `petugas` (`id_petugas`, `user_name`, `pass_word`, `nama_petugas`, `level`) VALUES
(1, 'admin', '5994471abb01112afcc18159f6cc74b4f511b99806da59b3caf5a9c173cacfc5', 'Affan', 'admin'),
(2, 'petugas', '2dad904f71aa0dcf6ea1addaa084a5865ffe448e4d3f900668e1cc7e7b6153d7', 'akmal', 'petugas'),
(5, 'bendahara', '5994471abb01112afcc18159f6cc74b4f511b99806da59b3caf5a9c173cacfc5', 'apang', 'petugas');

-- --------------------------------------------------------

--
-- Table structure for table `ppdb`
--

CREATE TABLE `ppdb` (
  `id_ppdb` int(11) NOT NULL,
  `nama_ppdb` varchar(35) NOT NULL,
  `nominal_ppdb` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `ppdb`
--

INSERT INTO `ppdb` (`id_ppdb`, `nama_ppdb`, `nominal_ppdb`) VALUES
(1, 'PPDB 2024', 850000),
(3, 'Tidak', 0);

-- --------------------------------------------------------

--
-- Table structure for table `siswa`
--

CREATE TABLE `siswa` (
  `nisn` char(10) NOT NULL,
  `nis` char(8) NOT NULL,
  `nama_siswa` varchar(50) NOT NULL,
  `id_kelas` int(11) NOT NULL,
  `alamat` text NOT NULL,
  `no_telp` varchar(13) NOT NULL,
  `id_ppdb` int(11) NOT NULL,
  `id_spp` int(11) NOT NULL,
  `id_buku` int(11) NOT NULL,
  `id_kegiatan` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `siswa`
--

INSERT INTO `siswa` (`nisn`, `nis`, `nama_siswa`, `id_kelas`, `alamat`, `no_telp`, `id_ppdb`, `id_spp`, `id_buku`, `id_kegiatan`) VALUES
('211000001', '36712312', 'Bima Aditya Rahmana', 2, 'Lembang 2', '081385433965', 3, 2, 2, 3),
('211000003', '23123123', 'Naufal Brillian', 1, 'Radio Dalam 2', '081385433978', 1, 3, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `spp`
--

CREATE TABLE `spp` (
  `id_spp` int(11) NOT NULL,
  `tahun` int(11) NOT NULL,
  `nominal_spp` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `spp`
--

INSERT INTO `spp` (`id_spp`, `tahun`, `nominal_spp`) VALUES
(1, 2022, 350000),
(2, 2023, 400000),
(3, 2024, 450000);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `buku`
--
ALTER TABLE `buku`
  ADD PRIMARY KEY (`id_buku`);

--
-- Indexes for table `kegiatan`
--
ALTER TABLE `kegiatan`
  ADD PRIMARY KEY (`id_kegiatan`);

--
-- Indexes for table `kelas`
--
ALTER TABLE `kelas`
  ADD PRIMARY KEY (`id_kelas`);

--
-- Indexes for table `pembayaran_buku`
--
ALTER TABLE `pembayaran_buku`
  ADD PRIMARY KEY (`id_pembayaran_buku`);

--
-- Indexes for table `pembayaran_kegiatan`
--
ALTER TABLE `pembayaran_kegiatan`
  ADD PRIMARY KEY (`id_pembayaran_kegiatan`);

--
-- Indexes for table `pembayaran_ppdb`
--
ALTER TABLE `pembayaran_ppdb`
  ADD PRIMARY KEY (`id_pembayaran_ppdb`);

--
-- Indexes for table `pembayaran_spp`
--
ALTER TABLE `pembayaran_spp`
  ADD PRIMARY KEY (`id_pembayaran_spp`);

--
-- Indexes for table `petugas`
--
ALTER TABLE `petugas`
  ADD PRIMARY KEY (`id_petugas`);

--
-- Indexes for table `ppdb`
--
ALTER TABLE `ppdb`
  ADD PRIMARY KEY (`id_ppdb`);

--
-- Indexes for table `siswa`
--
ALTER TABLE `siswa`
  ADD PRIMARY KEY (`nisn`);

--
-- Indexes for table `spp`
--
ALTER TABLE `spp`
  ADD PRIMARY KEY (`id_spp`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `buku`
--
ALTER TABLE `buku`
  MODIFY `id_buku` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `kegiatan`
--
ALTER TABLE `kegiatan`
  MODIFY `id_kegiatan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `kelas`
--
ALTER TABLE `kelas`
  MODIFY `id_kelas` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `pembayaran_buku`
--
ALTER TABLE `pembayaran_buku`
  MODIFY `id_pembayaran_buku` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `pembayaran_kegiatan`
--
ALTER TABLE `pembayaran_kegiatan`
  MODIFY `id_pembayaran_kegiatan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `pembayaran_ppdb`
--
ALTER TABLE `pembayaran_ppdb`
  MODIFY `id_pembayaran_ppdb` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `pembayaran_spp`
--
ALTER TABLE `pembayaran_spp`
  MODIFY `id_pembayaran_spp` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `petugas`
--
ALTER TABLE `petugas`
  MODIFY `id_petugas` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `ppdb`
--
ALTER TABLE `ppdb`
  MODIFY `id_ppdb` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `spp`
--
ALTER TABLE `spp`
  MODIFY `id_spp` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
