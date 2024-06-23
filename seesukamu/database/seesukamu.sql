-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: May 26, 2024 at 10:55 AM
-- Server version: 8.0.30
-- PHP Version: 8.3.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `seesukamu`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbooking`
--

CREATE TABLE `tbooking` (
  `kdbook` int NOT NULL,
  `nama` varchar(50) NOT NULL,
  `nowa` varchar(20) NOT NULL,
  `tgl` date NOT NULL,
  `wkt` time NOT NULL,
  `kdtreatment` int NOT NULL,
  `konfirmasi` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `tbooking`
--

INSERT INTO `tbooking` (`kdbook`, `nama`, `nowa`, `tgl`, `wkt`, `kdtreatment`, `konfirmasi`) VALUES
(1, 'Sephia', '087811334567', '2024-01-02', '23:17:00', 1, 'Belum'),
(2, 'Jack', '0878114455', '2024-01-11', '17:17:00', 3, 'Belum'),
(3, 'Idris', '087099558855', '2024-01-19', '20:47:00', 3, 'Belum'),
(4, 'Divan', '087099558811', '2024-02-01', '14:48:00', 2, 'Belum'),
(5, 'Novi', '087099558822', '2024-02-16', '10:51:00', 2, 'Terima'),
(6, 'Juli', '087811445511', '2024-02-18', '21:40:56', 2, 'Terima'),
(7, 'Kanto', '087811445523', '2024-02-24', '28:56:22', 2, 'Tidak'),
(8, 'Agus', '083899112345', '2024-05-30', '14:42:00', 2, 'Terima'),
(9, 'Bajigur', '087099558800', '2024-05-23', '13:17:00', 1, 'Payment'),
(10, 'Rere', '087099558800', '2024-05-24', '13:19:00', 2, 'Selesai'),
(11, 'Ajeng', '087099558855', '2024-05-23', '18:43:00', 1, 'Selesai'),
(12, 'Ayu', '087099558855', '2024-05-23', '01:13:00', 1, 'Belum'),
(13, 'zahra', '087099558855', '2024-05-29', '00:20:00', 2, 'Belum'),
(14, 'nabila', '087099558855', '2024-05-22', '23:22:00', 3, 'Belum'),
(15, 'ara', '087099558800', '2024-05-14', '20:29:00', 1, 'Belum'),
(16, 'gobang', '087099558866', '2024-03-07', '23:30:00', 2, 'Belum'),
(17, 'jiji', '087099558866', '2024-01-17', '23:32:00', 3, 'Terima'),
(18, 'Galang', '085824356677', '2024-01-10', '08:40:00', 3, 'Selesai'),
(19, 'Lidwina', '0870995588', '2024-02-23', '23:10:00', 2, 'Terima'),
(20, 'Dwi', '087099558866', '2024-07-10', '18:12:00', 2, 'Selesai'),
(22, 'erog', '087099558866', '2024-03-14', '23:23:00', 3, 'Terima'),
(23, 'Kobal', '087099558855', '2024-02-16', '23:26:00', 3, 'Selesai'),
(24, 'lilii', '087099558855', '2024-05-10', '02:31:00', 3, 'Selesai');

-- --------------------------------------------------------

--
-- Table structure for table `tprice`
--

CREATE TABLE `tprice` (
  `kdprice` int NOT NULL,
  `namaprice` varchar(30) NOT NULL,
  `harga` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `tprice`
--

INSERT INTO `tprice` (`kdprice`, `namaprice`, `harga`) VALUES
(1, 'Nail Gel Tangan', '50000'),
(2, 'Nail Gel Kaki', '55000'),
(3, 'Fake Nails', '90000'),
(4, 'Soft Tip', '125000'),
(5, 'Press On Nails', '75000'),
(6, 'Chrome', '5000'),
(7, '3D Chrome', '10000'),
(8, 'Marble', '10000'),
(9, 'Ombre', '7000'),
(10, 'Art', '10000'),
(11, 'Manicure', '55000'),
(12, 'Pedicure', '65000');

-- --------------------------------------------------------

--
-- Table structure for table `ttransaksi`
--

CREATE TABLE `ttransaksi` (
  `kdtransaksi` int NOT NULL,
  `kdbook` int NOT NULL,
  `metodepay` varchar(20) NOT NULL,
  `totalpay` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `tglwktpay` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `ttransaksi`
--

INSERT INTO `ttransaksi` (`kdtransaksi`, `kdbook`, `metodepay`, `totalpay`, `tglwktpay`) VALUES
(1, 23, 'QRIS', '10000', '2024-05-26 15:04:30'),
(3, 20, 'Debit', '195000', '2024-05-26 16:29:09'),
(4, 18, 'Tunai', '105000', '2024-05-26 17:05:54'),
(5, 24, 'Transfer', '410000', '2024-05-26 17:09:21'),
(6, 11, 'Debit', '50000', '2024-05-26 17:26:08'),
(7, 10, 'Tunai', '50000', '2024-05-26 17:50:07');

-- --------------------------------------------------------

--
-- Table structure for table `ttreatment`
--

CREATE TABLE `ttreatment` (
  `kdtreatment` int NOT NULL,
  `treatment` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `ttreatment`
--

INSERT INTO `ttreatment` (`kdtreatment`, `treatment`) VALUES
(1, 'nailart homestudio'),
(2, 'nailart homeservice'),
(3, 'nailart cafeservice');

-- --------------------------------------------------------

--
-- Table structure for table `us`
--

CREATE TABLE `us` (
  `id` int NOT NULL,
  `username` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `Nama` varchar(60) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `Email` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `No_Tlp` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `Jk` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `us`
--

INSERT INTO `us` (`id`, `username`, `password`, `Nama`, `Email`, `No_Tlp`, `Jk`, `created_at`) VALUES
(1, 'admin', 'admin', 'admin', 'admin@gmail.com', '+62851887795', 'L', '2024-03-10 20:24:58');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbooking`
--
ALTER TABLE `tbooking`
  ADD PRIMARY KEY (`kdbook`),
  ADD KEY `kdtreatment` (`kdtreatment`);

--
-- Indexes for table `tprice`
--
ALTER TABLE `tprice`
  ADD PRIMARY KEY (`kdprice`);

--
-- Indexes for table `ttransaksi`
--
ALTER TABLE `ttransaksi`
  ADD PRIMARY KEY (`kdtransaksi`),
  ADD KEY `kdbook` (`kdbook`);

--
-- Indexes for table `ttreatment`
--
ALTER TABLE `ttreatment`
  ADD PRIMARY KEY (`kdtreatment`);

--
-- Indexes for table `us`
--
ALTER TABLE `us`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbooking`
--
ALTER TABLE `tbooking`
  MODIFY `kdbook` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `tprice`
--
ALTER TABLE `tprice`
  MODIFY `kdprice` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `ttransaksi`
--
ALTER TABLE `ttransaksi`
  MODIFY `kdtransaksi` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `ttreatment`
--
ALTER TABLE `ttreatment`
  MODIFY `kdtreatment` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `us`
--
ALTER TABLE `us`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tbooking`
--
ALTER TABLE `tbooking`
  ADD CONSTRAINT `tbooking_ibfk_1` FOREIGN KEY (`kdtreatment`) REFERENCES `ttreatment` (`kdtreatment`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Constraints for table `ttransaksi`
--
ALTER TABLE `ttransaksi`
  ADD CONSTRAINT `ttransaksi_ibfk_1` FOREIGN KEY (`kdbook`) REFERENCES `tbooking` (`kdbook`) ON DELETE RESTRICT ON UPDATE RESTRICT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
