-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Aug 26, 2020 at 03:09 PM
-- Server version: 10.4.13-MariaDB
-- PHP Version: 7.4.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `rental-mobil-ci`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id_admin` int(11) NOT NULL,
  `nama_admin` varchar(50) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `id_customer` int(11) NOT NULL,
  `nama` varchar(40) NOT NULL,
  `username` varchar(20) NOT NULL,
  `alamat` text NOT NULL,
  `kelamin` enum('L','P') NOT NULL,
  `telepon` int(20) NOT NULL,
  `no_ktp` varchar(50) NOT NULL,
  `password` varchar(256) NOT NULL,
  `role_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`id_customer`, `nama`, `username`, `alamat`, `kelamin`, `telepon`, `no_ktp`, `password`, `role_id`) VALUES
(6, 'Ridho Surya', 'ridho123', 'JL.Pepaya', 'L', 2147483647, '23746264183678', '$2y$10$isCDADDMNqoYNaJyE.OU8udOFfWIXxqDb0aNCFWreowiKgpbqUM2W', 1),
(7, 'Rozi Amrin', 'rozi123', 'Jl.Purwodadi', 'L', 24234, '454545', '$2y$10$76gmhE5PbljqtrdMexc4..xp/5BPa847aGmPl2a.5vcl.QcmAMoc6', 2),
(11, 'Toni Saputra', 'toni123', 'Jl.Paus', 'P', 86434, '3413287', '$2y$10$szrrNlt2w/aitQ0fM8sMr.AgW47ZyenpL8WDroZQxuuclJoDl.WwW', 2);

-- --------------------------------------------------------

--
-- Table structure for table `mobil`
--

CREATE TABLE `mobil` (
  `id_mobil` int(11) NOT NULL,
  `kode_type` int(11) NOT NULL,
  `merk` varchar(40) NOT NULL,
  `no_plat` varchar(10) NOT NULL,
  `warna` varchar(20) NOT NULL,
  `tahun` varchar(4) NOT NULL,
  `status` varchar(50) NOT NULL,
  `harga_mobil` int(11) NOT NULL,
  `denda` int(11) NOT NULL,
  `ac` int(11) NOT NULL,
  `supir` int(11) NOT NULL,
  `mp3_player` int(11) NOT NULL,
  `central_lock` int(11) NOT NULL,
  `gambar` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `mobil`
--

INSERT INTO `mobil` (`id_mobil`, `kode_type`, `merk`, `no_plat`, `warna`, `tahun`, `status`, `harga_mobil`, `denda`, `ac`, `supir`, `mp3_player`, `central_lock`, `gambar`) VALUES
(7, 3, 'Avanza', 'BM 1234 MB', 'Putih', '2009', '1', 100000, 90000, 1, 1, 1, 1, '19a7a09697d626d7d4c664a1436f896b.jpg'),
(8, 2, 'Xenia', 'BM 6754 UP', 'Putih', '2009', '1', 200000, 50000, 1, 1, 1, 0, '996143517.jpg'),
(21, 3, 'Kamarun', 'BM 6765 RE', 'Hijau', '2010', '1', 120000, 80000, 1, 1, 1, 1, '1844967957.jpg'),
(22, 3, 'Honda Jaz Rs Matic 201', 'BM 6743 UP', 'Putih', '2018', '1', 300000, 100000, 0, 1, 1, 0, 'honda_jaz_rs_matic_201_1547430590_57b73d33_progressive.jpg'),
(23, 3, 'Sedan 340CC', 'BM 2398 GH', 'Merah', '2018', '0', 500000, 200000, 0, 1, 1, 0, 'car-4.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `rental`
--

CREATE TABLE `rental` (
  `id_rental` int(11) NOT NULL,
  `id_customer` int(11) NOT NULL,
  `tgl_rental` date NOT NULL,
  `tgl_kembali` date NOT NULL,
  `tgl_penggembalian` date NOT NULL,
  `status_rental` varchar(50) NOT NULL,
  `status_penggembalian` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `transaksi`
--

CREATE TABLE `transaksi` (
  `id_rental` int(11) NOT NULL,
  `id_customer` int(11) NOT NULL,
  `id_mobil` int(11) NOT NULL,
  `tgl_rental` date NOT NULL,
  `tgl_kembali` date NOT NULL,
  `harga` varchar(120) NOT NULL,
  `denda` varchar(20) NOT NULL,
  `total_denda` varchar(100) NOT NULL,
  `tgl_penggembalian` date NOT NULL,
  `status_penggembalian` varchar(50) NOT NULL,
  `status_rental` varchar(50) NOT NULL,
  `bukti_pembayaran` varchar(255) NOT NULL,
  `status_pembayaran` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `transaksi`
--

INSERT INTO `transaksi` (`id_rental`, `id_customer`, `id_mobil`, `tgl_rental`, `tgl_kembali`, `harga`, `denda`, `total_denda`, `tgl_penggembalian`, `status_penggembalian`, `status_rental`, `bukti_pembayaran`, `status_pembayaran`) VALUES
(3, 7, 23, '2020-08-24', '2020-08-27', '500000', '200000', '200000', '2020-08-28', 'Kembali', 'Selesai', 'car-5.jpg', 1),
(4, 6, 8, '2020-08-25', '2020-08-27', '200000', '50000', '100000', '2020-08-28', 'Kembali', 'Selesai', '', 0),
(5, 6, 22, '2020-08-19', '2020-08-20', '300000', '300000', '1250000', '2020-08-25', 'Kembali', 'Selesai', '', 0),
(7, 7, 21, '2020-08-16', '2020-08-17', '120000', '80000', '720000', '2020-08-26', 'Kembali', 'Selesai', 'car-4.jpg', 1),
(9, 7, 23, '2020-08-26', '2020-08-27', '500000', '200000', '0', '0000-00-00', 'Belum Kembali', 'Belum Selesai', '', 0);

-- --------------------------------------------------------

--
-- Table structure for table `type`
--

CREATE TABLE `type` (
  `id_type` int(11) NOT NULL,
  `kode_type` varchar(20) NOT NULL,
  `nama_type` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `type`
--

INSERT INTO `type` (`id_type`, `kode_type`, `nama_type`) VALUES
(2, 'SDN', 'Sedan'),
(3, 'SZK', 'Suzuki'),
(7, 'PCU', 'Packup'),
(8, 'TRV', 'Travell');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id_admin`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`id_customer`);

--
-- Indexes for table `mobil`
--
ALTER TABLE `mobil`
  ADD PRIMARY KEY (`id_mobil`),
  ADD KEY `kode_type` (`kode_type`);

--
-- Indexes for table `rental`
--
ALTER TABLE `rental`
  ADD PRIMARY KEY (`id_rental`);

--
-- Indexes for table `transaksi`
--
ALTER TABLE `transaksi`
  ADD PRIMARY KEY (`id_rental`);

--
-- Indexes for table `type`
--
ALTER TABLE `type`
  ADD PRIMARY KEY (`id_type`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id_admin` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `id_customer` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `mobil`
--
ALTER TABLE `mobil`
  MODIFY `id_mobil` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `rental`
--
ALTER TABLE `rental`
  MODIFY `id_rental` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `transaksi`
--
ALTER TABLE `transaksi`
  MODIFY `id_rental` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `type`
--
ALTER TABLE `type`
  MODIFY `id_type` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `mobil`
--
ALTER TABLE `mobil`
  ADD CONSTRAINT `mobil_ibfk_1` FOREIGN KEY (`kode_type`) REFERENCES `type` (`id_type`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
