-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 05 Des 2023 pada 14.48
-- Versi Server: 10.1.9-MariaDB
-- PHP Version: 7.0.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `tiket_online`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_kereta`
--

CREATE TABLE `tbl_kereta` (
  `kode_kereta` int(11) NOT NULL,
  `nama_kereta` varchar(100) NOT NULL,
  `stasiun_awal` varchar(100) NOT NULL,
  `stasiun_akhir` varchar(100) NOT NULL,
  `jadwal_berangkat` time NOT NULL,
  `jadwal_sampai` time NOT NULL,
  `harga` varchar(100) NOT NULL,
  `stok` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tbl_kereta`
--

INSERT INTO `tbl_kereta` (`kode_kereta`, `nama_kereta`, `stasiun_awal`, `stasiun_akhir`, `jadwal_berangkat`, `jadwal_sampai`, `harga`, `stok`) VALUES
(11, 'ARGO ANGGREK LUXURY SLEEPER ', 'GAMBIR', 'SURABAYA PASAR TURI', '20:30:00', '04:35:00', '1365000', 28),
(12, 'ARGO BROMO ANGGREK ', 'GAMBIR', 'SURABAYA PASAR TURI', '20:30:00', '04:35:00', '730000', 100),
(13, 'CIKURAY ', 'PASARSENEN', 'BANDUNG', '17:40:00', '20:52:00', '45000', 97);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_login`
--

CREATE TABLE `tbl_login` (
  `kode_login` int(100) NOT NULL,
  `role` varchar(100) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tbl_login`
--

INSERT INTO `tbl_login` (`kode_login`, `role`, `username`, `password`) VALUES
(1, 'admin', 'admin', 'admin'),
(2, 'pengguna', 'dandi', '123');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_pengguna`
--

CREATE TABLE `tbl_pengguna` (
  `kode_pengguna` int(10) NOT NULL,
  `nama_pengguna` varchar(100) NOT NULL,
  `nik` varchar(100) NOT NULL,
  `no_telepon` varchar(100) NOT NULL,
  `tanggal_berangkat` date NOT NULL,
  `jumlah_tiket` int(100) NOT NULL,
  `kode_kereta` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tbl_pengguna`
--

INSERT INTO `tbl_pengguna` (`kode_pengguna`, `nama_pengguna`, `nik`, `no_telepon`, `tanggal_berangkat`, `jumlah_tiket`, `kode_kereta`) VALUES
(69, 'MOH FARHAN ZAENURI', '3214060810030004', '087829478221', '2023-12-24', 1, 15),
(70, 'MOH FARHAN ZAENURI', '3214060810030004', '087829478221', '0000-00-00', 1, 14),
(71, 'FAHLEVI NICKO ', '3214060810030004', '087829478221', '0000-00-00', 1, 4),
(72, 'MOH FARHAN ZAENURI', '3214060810030004', '087829478221', '2024-01-05', 1, 13),
(73, 'MOH FARHAN ZAENURI', '3214060810030004', '087829478221', '2023-12-30', 1, 14);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_tiket`
--

CREATE TABLE `tbl_tiket` (
  `kode_tiket` int(100) NOT NULL,
  `kode_pengguna` int(100) NOT NULL,
  `kode_login` int(100) NOT NULL,
  `no_gerbong` varchar(100) NOT NULL,
  `no_kursi` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_kereta`
--
ALTER TABLE `tbl_kereta`
  ADD PRIMARY KEY (`kode_kereta`);

--
-- Indexes for table `tbl_login`
--
ALTER TABLE `tbl_login`
  ADD PRIMARY KEY (`kode_login`);

--
-- Indexes for table `tbl_pengguna`
--
ALTER TABLE `tbl_pengguna`
  ADD PRIMARY KEY (`kode_pengguna`);

--
-- Indexes for table `tbl_tiket`
--
ALTER TABLE `tbl_tiket`
  ADD PRIMARY KEY (`kode_tiket`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_kereta`
--
ALTER TABLE `tbl_kereta`
  MODIFY `kode_kereta` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT for table `tbl_login`
--
ALTER TABLE `tbl_login`
  MODIFY `kode_login` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `tbl_pengguna`
--
ALTER TABLE `tbl_pengguna`
  MODIFY `kode_pengguna` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=74;
--
-- AUTO_INCREMENT for table `tbl_tiket`
--
ALTER TABLE `tbl_tiket`
  MODIFY `kode_tiket` int(100) NOT NULL AUTO_INCREMENT;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
