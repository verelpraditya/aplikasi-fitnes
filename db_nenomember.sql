-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Waktu pembuatan: 17 Jul 2023 pada 01.28
-- Versi server: 10.6.14-MariaDB-cll-lve
-- Versi PHP: 8.1.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `stra9813_neno`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `absensi`
--

CREATE TABLE `absensi` (
  `id` int(5) NOT NULL,
  `id_member` varchar(30) DEFAULT NULL,
  `tgl` date DEFAULT NULL,
  `kd_waktu` varchar(10) DEFAULT NULL,
  `jam_masuk` time DEFAULT NULL,
  `jam_pulang` time DEFAULT NULL,
  `counter` int(6) DEFAULT 0
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `account`
--

CREATE TABLE `account` (
  `username` varchar(32) NOT NULL,
  `password` varchar(32) NOT NULL,
  `nama` varchar(70) NOT NULL,
  `level` varchar(5) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data untuk tabel `account`
--

INSERT INTO `account` (`username`, `password`, `nama`, `level`) VALUES
('21232f297a57a5a743894a0e4a801fc3', '21232f297a57a5a743894a0e4a801fc3', 'administrator', 'user'),
('19984dcaea13176bbb694f62ba6b5b35', '19984dcaea13176bbb694f62ba6b5b35', 'tea', 'admin'),
('ee11cbb19052e40b07aac0ca060c23ee', 'ee11cbb19052e40b07aac0ca060c23ee', 'user', 'user'),
('9a6c373507028ddf22f562af5d61b56f', '', 'administrator', 'admin');

-- --------------------------------------------------------

--
-- Struktur dari tabel `class`
--

CREATE TABLE `class` (
  `id_class` int(20) NOT NULL,
  `nama_class` varchar(30) DEFAULT NULL,
  `id_member` varchar(30) DEFAULT NULL,
  `nama` varchar(30) NOT NULL,
  `jeniskel` varchar(30) NOT NULL,
  `alamat` varchar(60) NOT NULL,
  `tanggal` date DEFAULT NULL,
  `jam_masuk` time DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Dumping data untuk tabel `class`
--

INSERT INTO `class` (`id_class`, `nama_class`, `id_member`, `nama`, `jeniskel`, `alamat`, `tanggal`, `jam_masuk`) VALUES
(1, 'AEROBIC MIC', 'NenoM0001', 'TEA', 'Laki-laki', 'TNG', '2023-07-14', '03:50:16');

-- --------------------------------------------------------

--
-- Struktur dari tabel `golongan`
--

CREATE TABLE `golongan` (
  `id_golongan` varchar(10) NOT NULL,
  `nama_golongan` varchar(50) NOT NULL,
  `biaya` double(50,0) NOT NULL,
  `kuota` int(11) NOT NULL,
  `expired` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data untuk tabel `golongan`
--

INSERT INTO `golongan` (`id_golongan`, `nama_golongan`, `biaya`, `kuota`, `expired`) VALUES
('NN.0001', 'MEMBER 1', 150000, 5, 15),
('NN.0002', 'MEMBER 2', 250000, 5, 15);

-- --------------------------------------------------------

--
-- Struktur dari tabel `guest`
--

CREATE TABLE `guest` (
  `inc` int(30) NOT NULL,
  `nama` varchar(30) NOT NULL,
  `room` varchar(20) NOT NULL,
  `alamat` varchar(50) NOT NULL,
  `telepon` varchar(20) NOT NULL,
  `tgl_masuk` date NOT NULL,
  `jam` time NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `instruktur`
--

CREATE TABLE `instruktur` (
  `id_instruktur` varchar(20) NOT NULL,
  `nama_instruktur` varchar(50) NOT NULL,
  `alamat_instruktur` varchar(50) NOT NULL,
  `tempat_lahir` varchar(50) NOT NULL,
  `tanggal_lahir` date NOT NULL,
  `jenis_kelamin` varchar(20) NOT NULL,
  `no_telepon` varchar(20) NOT NULL,
  `status_instruktur` varchar(50) NOT NULL,
  `gambar` varchar(50) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `member`
--

CREATE TABLE `member` (
  `id_member` varchar(20) NOT NULL,
  `nama` varchar(20) NOT NULL,
  `alamat` varchar(50) NOT NULL,
  `tempat_lahir` varchar(20) NOT NULL,
  `tanggal_lahir` date NOT NULL,
  `jenis_kelamin` varchar(50) NOT NULL,
  `no_telepon` varchar(20) NOT NULL,
  `status` varchar(50) NOT NULL,
  `tgl_tempo` date NOT NULL,
  `kuota` int(11) NOT NULL,
  `gambar` varchar(50) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data untuk tabel `member`
--

INSERT INTO `member` (`id_member`, `nama`, `alamat`, `tempat_lahir`, `tanggal_lahir`, `jenis_kelamin`, `no_telepon`, `status`, `tgl_tempo`, `kuota`, `gambar`) VALUES
('NenoM0001', 'TEA', 'TNG', 'TNG', '2023-07-01', 'Laki-laki', '0877', 'aktif', '2023-07-30', 0, 'member_default.jpg'),
('NenoM0002', 'tes', 'tes', 'tes', '2023-07-25', 'Laki-laki', '08', 'aktif', '2023-07-30', 3, 'member_default.jpg'),
('NenoM0003', 'tes 2', 'tes 2', 'tes 2', '2023-07-11', 'Laki-laki', '0812', 'aktif', '2023-07-31', 4, 'member_default.jpg');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pembayaran`
--

CREATE TABLE `pembayaran` (
  `no_transaksi` varchar(20) NOT NULL,
  `id_member` varchar(30) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `nama_golongan` varchar(50) NOT NULL,
  `tanggal_pembayaran` date NOT NULL,
  `tanggal_jatuh_tempo` date NOT NULL,
  `total_bayar` double(30,0) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data untuk tabel `pembayaran`
--

INSERT INTO `pembayaran` (`no_transaksi`, `id_member`, `nama`, `nama_golongan`, `tanggal_pembayaran`, `tanggal_jatuh_tempo`, `total_bayar`) VALUES
('TRS-0003', 'NenoM0001', 'TEA', 'MEMBER 1', '2023-07-16', '2023-07-31', 150000),
('TRS-0004', 'NenoM0001', 'TEA', 'MEMBER 1', '2023-07-16', '2023-07-30', 150000),
('TRS-0002', 'NenoM0003', 'tes 2', 'MEMBER 1', '2023-07-16', '2023-07-31', 150000),
('TRS-0001', 'NenoM0002', 'tes', 'MEMBER 2', '2023-07-16', '2023-07-31', 250000);

-- --------------------------------------------------------

--
-- Struktur dari tabel `registrasi`
--

CREATE TABLE `registrasi` (
  `no_registrasi` varchar(20) NOT NULL,
  `id_member` varchar(20) NOT NULL,
  `nama_member` varchar(50) NOT NULL,
  `nama_golongan` varchar(40) NOT NULL,
  `tanggal_pendaftaran` date NOT NULL,
  `biaya_pendaftaran` double(30,0) NOT NULL,
  `biaya_member` double(30,0) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data untuk tabel `registrasi`
--

INSERT INTO `registrasi` (`no_registrasi`, `id_member`, `nama_member`, `nama_golongan`, `tanggal_pendaftaran`, `biaya_pendaftaran`, `biaya_member`) VALUES
('REG-0002', 'NenoM0003', 'tes 2', 'MEMBER 1', '2023-07-16', 0, 150000),
('REG-0001', 'NenoM0002', 'tes', 'MEMBER 2', '2023-07-16', 0, 250000);

-- --------------------------------------------------------

--
-- Struktur dari tabel `umum`
--

CREATE TABLE `umum` (
  `no_transaksi` varchar(30) NOT NULL,
  `no_identitas` varchar(30) NOT NULL,
  `nama` varchar(40) NOT NULL,
  `jenis_kelamin` varchar(30) NOT NULL,
  `tempat_lahir` varchar(50) NOT NULL,
  `tgl_lahir` date NOT NULL,
  `alamat` varchar(50) NOT NULL,
  `pekerjaan` varchar(30) NOT NULL,
  `no_telepon` varchar(30) NOT NULL,
  `tgl_transaksi` date NOT NULL,
  `jumlah_bayar` double(30,0) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `absensi`
--
ALTER TABLE `absensi`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`),
  ADD KEY `id_2` (`id`);

--
-- Indeks untuk tabel `account`
--
ALTER TABLE `account`
  ADD PRIMARY KEY (`username`);

--
-- Indeks untuk tabel `class`
--
ALTER TABLE `class`
  ADD PRIMARY KEY (`id_class`);

--
-- Indeks untuk tabel `golongan`
--
ALTER TABLE `golongan`
  ADD PRIMARY KEY (`id_golongan`);

--
-- Indeks untuk tabel `guest`
--
ALTER TABLE `guest`
  ADD PRIMARY KEY (`inc`);

--
-- Indeks untuk tabel `instruktur`
--
ALTER TABLE `instruktur`
  ADD PRIMARY KEY (`id_instruktur`);

--
-- Indeks untuk tabel `member`
--
ALTER TABLE `member`
  ADD PRIMARY KEY (`id_member`);

--
-- Indeks untuk tabel `pembayaran`
--
ALTER TABLE `pembayaran`
  ADD PRIMARY KEY (`no_transaksi`);

--
-- Indeks untuk tabel `registrasi`
--
ALTER TABLE `registrasi`
  ADD PRIMARY KEY (`no_registrasi`);

--
-- Indeks untuk tabel `umum`
--
ALTER TABLE `umum`
  ADD PRIMARY KEY (`no_transaksi`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `absensi`
--
ALTER TABLE `absensi`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT untuk tabel `class`
--
ALTER TABLE `class`
  MODIFY `id_class` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `guest`
--
ALTER TABLE `guest`
  MODIFY `inc` int(30) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
