-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 21, 2019 at 03:49 PM
-- Server version: 10.4.10-MariaDB
-- PHP Version: 7.3.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `count`
--

-- --------------------------------------------------------

--
-- Table structure for table `tb_caleg`
--

CREATE TABLE `tb_caleg` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `id_partai` int(11) NOT NULL,
  `earned_vote` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_caleg`
--

INSERT INTO `tb_caleg` (`id`, `name`, `id_partai`, `earned_vote`) VALUES
(1, 'Is Bos', 2, 72),
(2, 'Dobleh', 1, 101),
(3, 'Kabur', 3, 70);

-- --------------------------------------------------------

--
-- Table structure for table `tb_partai`
--

CREATE TABLE `tb_partai` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_partai`
--

INSERT INTO `tb_partai` (`id`, `name`) VALUES
(1, 'Cilacap Santai'),
(2, 'Cilacap Makmur'),
(3, 'Cilacap Aman');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tb_caleg`
--
ALTER TABLE `tb_caleg`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_partai`
--
ALTER TABLE `tb_partai`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tb_caleg`
--
ALTER TABLE `tb_caleg`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tb_partai`
--
ALTER TABLE `tb_partai`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
