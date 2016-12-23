-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Nov 21, 2016 at 07:25 AM
-- Server version: 10.1.16-MariaDB
-- PHP Version: 7.0.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dtmhs`
--

-- --------------------------------------------------------

--
-- Table structure for table `agama`
--

CREATE TABLE `agama` (
  `idagama` int(8) NOT NULL,
  `nmagama` varchar(25) NOT NULL,
  `publish` enum('T','F') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `agama`
--

INSERT INTO `agama` (`idagama`, `nmagama`, `publish`) VALUES
(1, 'Islam', 'T'),
(2, 'Kristen', 'T');

-- --------------------------------------------------------

--
-- Table structure for table `jalurmasuk`
--

CREATE TABLE `jalurmasuk` (
  `idjalurmasuk` int(8) NOT NULL,
  `nmjalurmasuk` varchar(25) NOT NULL,
  `publish` enum('T','F') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `jalurmasuk`
--

INSERT INTO `jalurmasuk` (`idjalurmasuk`, `nmjalurmasuk`, `publish`) VALUES
(1, 'PMKAB', 'T');

-- --------------------------------------------------------

--
-- Table structure for table `mahasiswa`
--

CREATE TABLE `mahasiswa` (
  `idmahasiswa` int(8) NOT NULL,
  `npm` int(10) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `sex` enum('P','L') NOT NULL,
  `tmp_lahir` varchar(25) NOT NULL,
  `tgl_lahir` date NOT NULL,
  `idagama` int(8) NOT NULL,
  `idtahun` int(8) NOT NULL,
  `idjalurmasuk` int(8) NOT NULL,
  `alamat_jln` varchar(25) NOT NULL,
  `alamat_kecamatan` varchar(25) NOT NULL,
  `alamat_kabupatenkota` varchar(25) NOT NULL,
  `alamat_provinsi` varchar(25) NOT NULL,
  `kodepos` int(10) NOT NULL,
  `nohp` int(16) NOT NULL,
  `email` varchar(50) NOT NULL,
  `photo` text NOT NULL,
  `publish` enum('T','F') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mahasiswa`
--

INSERT INTO `mahasiswa` (`idmahasiswa`, `npm`, `nama`, `sex`, `tmp_lahir`, `tgl_lahir`, `idagama`, `idtahun`, `idjalurmasuk`, `alamat_jln`, `alamat_kecamatan`, `alamat_kabupatenkota`, `alamat_provinsi`, `kodepos`, `nohp`, `email`, `photo`, `publish`) VALUES
(1, 14753061, 'Sri Rahayu', '', 'Pandansari', '1997-03-30', 1, 1, 1, 'Jl Raya', 'Sukoharjo', 'Pringsewu', 'Lampung', 35374, 2147483647, 'sri14753061@gmai.com', 'sri.JPG', 'T');

-- --------------------------------------------------------

--
-- Table structure for table `tahun`
--

CREATE TABLE `tahun` (
  `idtahun` int(8) NOT NULL,
  `tahun` int(8) NOT NULL,
  `publish` enum('T','F') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tahun`
--

INSERT INTO `tahun` (`idtahun`, `tahun`, `publish`) VALUES
(1, 2016, 'T'),
(2, 2015, 'T');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `iduser` int(8) NOT NULL,
  `nmuser` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `idmahasiswa` int(8) NOT NULL,
  `publish` enum('T','F') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`iduser`, `nmuser`, `password`, `idmahasiswa`, `publish`) VALUES
(1, 'Sri', '12345', 1, 'T');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `agama`
--
ALTER TABLE `agama`
  ADD PRIMARY KEY (`idagama`);

--
-- Indexes for table `jalurmasuk`
--
ALTER TABLE `jalurmasuk`
  ADD PRIMARY KEY (`idjalurmasuk`);

--
-- Indexes for table `mahasiswa`
--
ALTER TABLE `mahasiswa`
  ADD PRIMARY KEY (`idmahasiswa`);

--
-- Indexes for table `tahun`
--
ALTER TABLE `tahun`
  ADD PRIMARY KEY (`idtahun`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`iduser`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `agama`
--
ALTER TABLE `agama`
  MODIFY `idagama` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `jalurmasuk`
--
ALTER TABLE `jalurmasuk`
  MODIFY `idjalurmasuk` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `mahasiswa`
--
ALTER TABLE `mahasiswa`
  MODIFY `idmahasiswa` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `tahun`
--
ALTER TABLE `tahun`
  MODIFY `idtahun` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `iduser` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
