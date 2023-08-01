-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 31, 2023 at 02:20 PM
-- Server version: 10.1.38-MariaDB
-- PHP Version: 7.3.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `perpustakaanku`
--

-- --------------------------------------------------------

--
-- Table structure for table `buku`
--

CREATE TABLE `buku` (
  `id` int(11) NOT NULL,
  `rak_buku` varchar(250) NOT NULL,
  `no_buku` varchar(50) NOT NULL,
  `kode_peminjaman` varchar(50) NOT NULL,
  `judul_buku` varchar(255) NOT NULL,
  `kategori` varchar(50) NOT NULL,
  `stok` int(10) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `penerbit` varchar(250) NOT NULL,
  `penulis` varchar(250) NOT NULL,
  `tahun_terbit` varchar(250) NOT NULL,
  `sampul_buku` varchar(250) NOT NULL,
  `abstrak_buku` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `buku`
--

INSERT INTO `buku` (`id`, `rak_buku`, `no_buku`, `kode_peminjaman`, `judul_buku`, `kategori`, `stok`, `status`, `penerbit`, `penulis`, `tahun_terbit`, `sampul_buku`, `abstrak_buku`) VALUES
(18, '01', '123', 'Kelas 8', 'Ilmu Pengetahuan Alam (kelas 8)', 'non fiksi', 7, 1, 'Victoriani Inabury, Cece Sutia', 'Pusat Kurikulum dan Perbukuan', '2021', 'UxF_Ll9GZaACwn__tyoVsJm5148YuXBKD2_bMgrRQ7ieSNH0zI_bda1143582d0164ca0b0a6a1d627ecf42757d73d.jpeg', ''),
(19, '02', '456', 'Kelas 7', 'Matematika (Kelas 7)', 'non fiksi', 7, 1, 'Tim Gakko Tosho', 'Pusat Kurikulum dan Perbukuan', '2021', 'qyM8LrXl57DTbVBwzJfHp_RidoKNYmAnetEPFj61_Iax4_Z2vO_81c708888b5b72aba57d8fdfe56b23728c66d828.jpeg', '');

-- --------------------------------------------------------

--
-- Table structure for table `peminjaman`
--

CREATE TABLE `peminjaman` (
  `id` int(11) NOT NULL,
  `id_buku` int(11) NOT NULL,
  `id_siswa` int(11) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `tgl_pinjam` date NOT NULL,
  `tgl_kembali` date NOT NULL,
  `is_booking` tinyint(1) NOT NULL,
  `konfirmasi_pinjam` enum('F','T') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `peminjaman`
--

INSERT INTO `peminjaman` (`id`, `id_buku`, `id_siswa`, `jumlah`, `tgl_pinjam`, `tgl_kembali`, `is_booking`, `konfirmasi_pinjam`) VALUES
(57, 18, 13, 2, '2023-07-28', '2023-07-31', 0, 'T'),
(58, 19, 14, 3, '2023-07-28', '2023-07-31', 0, 'T'),
(59, 18, 14, 1, '2023-07-31', '2023-08-01', 1, 'F'),
(60, 18, 14, 1, '2023-07-31', '2023-08-01', 1, 'F');

-- --------------------------------------------------------

--
-- Table structure for table `pengembalian`
--

CREATE TABLE `pengembalian` (
  `id` int(11) NOT NULL,
  `id_peminjaman` int(11) NOT NULL,
  `tgl_kembali` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pengembalian`
--

INSERT INTO `pengembalian` (`id`, `id_peminjaman`, `tgl_kembali`) VALUES
(27, 57, '2023-07-31'),
(28, 58, '2023-07-31');

-- --------------------------------------------------------

--
-- Table structure for table `siswa`
--

CREATE TABLE `siswa` (
  `id` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `nisn` varchar(20) NOT NULL,
  `kelas` varchar(150) NOT NULL,
  `telepon` varchar(50) NOT NULL,
  `jenis_kelamin` varchar(50) NOT NULL,
  `alamat` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `siswa`
--

INSERT INTO `siswa` (`id`, `id_user`, `nama`, `nisn`, `kelas`, `telepon`, `jenis_kelamin`, `alamat`) VALUES
(5, 13, 'Alvian', '7210', '7-2', '081295816783', 'Laki-Laki', 'Perum. Sepinggan Asri'),
(6, 14, 'Angelia Ayu Ningtyas', '7312', '7-3', '089691183060', 'Perempuan', 'Jl. Mulawarman Rt. 32');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `username` varchar(50) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `role` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `nama`, `username`, `password`, `role`) VALUES
(10, 'admin', 'admin', '202cb962ac59075b964b07152d234b70', 'admin'),
(13, 'Alvian', NULL, NULL, 'user'),
(14, 'Angelia Ayu Ningtyas', NULL, NULL, 'user');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `buku`
--
ALTER TABLE `buku`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `peminjaman`
--
ALTER TABLE `peminjaman`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_buku` (`id_buku`);

--
-- Indexes for table `pengembalian`
--
ALTER TABLE `pengembalian`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_buku` (`id_peminjaman`) USING BTREE;

--
-- Indexes for table `siswa`
--
ALTER TABLE `siswa`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_user` (`id_user`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `buku`
--
ALTER TABLE `buku`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `peminjaman`
--
ALTER TABLE `peminjaman`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;

--
-- AUTO_INCREMENT for table `pengembalian`
--
ALTER TABLE `pengembalian`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `siswa`
--
ALTER TABLE `siswa`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `peminjaman`
--
ALTER TABLE `peminjaman`
  ADD CONSTRAINT `peminjaman_ibfk_1` FOREIGN KEY (`id_buku`) REFERENCES `buku` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
