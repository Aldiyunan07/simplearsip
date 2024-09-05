-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 01 Sep 2024 pada 11.41
-- Versi server: 10.4.32-MariaDB
-- Versi PHP: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `arsipsimple`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `config`
--

CREATE TABLE `config` (
  `id` int(11) NOT NULL,
  `no_peg` varchar(100) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `level` enum('admin') NOT NULL,
  `copyright` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data untuk tabel `config`
--

INSERT INTO `config` (`id`, `no_peg`, `username`, `password`, `level`, `copyright`) VALUES
(7, 'PEG008', 'admin', 'admin', 'admin', 'AnCreator');

-- --------------------------------------------------------

--
-- Struktur dari tabel `disposisi`
--

CREATE TABLE `disposisi` (
  `id` int(11) NOT NULL,
  `no_disposisi` varchar(100) NOT NULL,
  `no_sumas` varchar(100) NOT NULL,
  `tgl_dispo` varchar(100) NOT NULL,
  `penerima` varchar(100) NOT NULL,
  `judul` varchar(100) NOT NULL,
  `catatan` varchar(250) NOT NULL,
  `pengirim` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data untuk tabel `disposisi`
--

INSERT INTO `disposisi` (`id`, `no_disposisi`, `no_sumas`, `tgl_dispo`, `penerima`, `judul`, `catatan`, `pengirim`) VALUES
(5, 'DISPO001', '0002010201', 'Et voluptatem adipis', 'PEG003', 'Qui consequat Autem', 'Rem qui veniam sit', 'PEG001'),
(6, 'DISPO001', '0002010201', 'In voluptatum conseq', 'PEG003', 'Dicta molestias quas', 'Dolor provident odi', 'PEG001'),
(7, 'DISPO002', '003/004/srt004/', 'Commodo aliquam magn', 'PEG001', 'Dolores sit accusam', 'Molestias nemo ut ad', 'PEG001');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pegawai`
--

CREATE TABLE `pegawai` (
  `id` int(11) NOT NULL,
  `no_peg` varchar(10) DEFAULT NULL,
  `nama_peg` text DEFAULT NULL,
  `jabatan` text DEFAULT NULL,
  `alamat` varchar(100) DEFAULT NULL,
  `no_telp` varchar(13) DEFAULT NULL,
  `jns_kelamin` enum('laki-laki','perempuan','','') DEFAULT NULL,
  `level` enum('admin','user') DEFAULT NULL,
  `username` varchar(100) DEFAULT NULL,
  `password` varchar(100) DEFAULT NULL,
  `pertanyaan` varchar(100) NOT NULL,
  `photo` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data untuk tabel `pegawai`
--

INSERT INTO `pegawai` (`id`, `no_peg`, `nama_peg`, `jabatan`, `alamat`, `no_telp`, `jns_kelamin`, `level`, `username`, `password`, `pertanyaan`, `photo`) VALUES
(6, 'PEG001', 'Administrator', 'Super Admin', 'Street Kamojang', '08888', 'laki-laki', 'admin', 'admin', 'password', 'mandarin', 'upload/34fjyxSLjrHBkJOGcPogg51vpZnBs25V.jpg'),
(10, 'PEG002', 'aaa2', 'aaa', 'aaa', '', 'laki-laki', 'admin', 'usr', 'usr', 'asd', ''),
(13, 'PEG003', 'wwwqqqq', 'www', 'www', '3333', 'laki-laki', 'user', '333', 'password', 'dsfas', ''),
(14, 'PEG004', 'wwwqwe', 'wqwe', 'qweqwe', '22323', 'laki-laki', 'admin', 'aaswd', 'asda', 'asdkjas', ''),
(15, 'PEG005', 'asda', 'asdasda', 'ds cas', '34234', 'laki-laki', 'user', 'wads', 'sdasda', 'sdfs', ''),
(23, 'PEG006', 'asda', 'asdsad', 'asdasd', '324234', 'laki-laki', 'admin', '2423', '23423', 'asdasd', ''),
(24, 'PEG007', 'asdas', 'asda', 'asda', '34234', 'laki-laki', 'admin', '234234', '234234', 'cilacap', ''),
(25, 'PEG008', 'Ir Habib Mutaqin', 'kepala sekolah', 'jalan merbabu cinta menuju keadilan bersama', '087719855234', 'laki-laki', 'admin', 'habib', 'admin', 'cilacap', ''),
(30, 'PEG010', 'Enim omnis cum dolor', 'Cupiditate qui place', 'Autem et qui dolor b', '41', 'perempuan', 'user', 'Cupidatat voluptatem', 'Odit cum rerum sapie', 'Sed sunt voluptas ex', 'upload/382235e1-0821-4819-a29e-6e029c97.png');

-- --------------------------------------------------------

--
-- Struktur dari tabel `surat_keluar`
--

CREATE TABLE `surat_keluar` (
  `id` int(11) NOT NULL,
  `kd_sukel` varchar(100) NOT NULL,
  `no_sukel` varchar(100) NOT NULL,
  `tgl_sukel` date NOT NULL,
  `instansi` text NOT NULL,
  `judul_sukel` text NOT NULL,
  `isi_sukel` varchar(250) NOT NULL,
  `file_sukel` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data untuk tabel `surat_keluar`
--

INSERT INTO `surat_keluar` (`id`, `kd_sukel`, `no_sukel`, `tgl_sukel`, `instansi`, `judul_sukel`, `isi_sukel`, `file_sukel`) VALUES
(14, 'SUKEL001', '003/004/006/009', '2018-02-09', 'bappeda', 'test', 'ini surat keluar pertama', 'Penguins.jpg'),
(15, 'SUKEL002', 'sdasda', '2018-02-01', 'sada', 'sadasd', 'asdasd', 'Pegawai___.pdf'),
(16, 'SUKEL003', 'sss', '2018-02-09', 'ss', 'ss', 'sss', 'Pegawai__aminudin_ (1).pdf'),
(17, 'SUKEL004', 'asdasd', '2018-02-02', 'asdasd', 'ssda', 'asdad', 'Pegawai__asda_.pdf'),
(18, 'SUKEL005', 'asdasdas', '2018-02-08', 'dasda', 'asdasd', 'asdasd', 'Pegawai__aminudin_ (1).pdf'),
(19, 'SUKEL006', 'asdasdasasda', '2018-02-16', 'asdasd', 'dasd', 'asda', 'Pegawai___.pdf'),
(20, 'SUKEL007', 'xczxc', '2018-02-01', 'zxczxc', 'xczxc', 'zxczxc', 'Pegawai__aminudin_ (1).pdf'),
(21, 'SUKEL008', 'zxczc', '2018-02-02', 'zxczcx', 'zxczxc', 'zxczc', 'Pegawai__asda_.pdf'),
(22, 'SUKEL009', 'zxczxc', '2018-02-01', 'zxczxc', 'zxczx', 'zxczxcz', 'Pegawai__aminudin_.pdf'),
(23, 'SUKEL010', 'xzczxc', '2018-02-03', 'zxcz', 'zxczxc', 'zxcz', 'Pegawai__aminudin_ (1).pdf');

-- --------------------------------------------------------

--
-- Struktur dari tabel `surat_masuk`
--

CREATE TABLE `surat_masuk` (
  `id` int(11) NOT NULL,
  `kd_sumas` varchar(100) NOT NULL,
  `no_sumas` varchar(100) NOT NULL,
  `tgl_sumas` date NOT NULL,
  `tgl_sumasdtg` date NOT NULL,
  `jns_sumas` text NOT NULL,
  `judul` text NOT NULL,
  `isi` varchar(250) NOT NULL,
  `instansi` text NOT NULL,
  `penerima` text NOT NULL,
  `file_sumas` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data untuk tabel `surat_masuk`
--

INSERT INTO `surat_masuk` (`id`, `kd_sumas`, `no_sumas`, `tgl_sumas`, `tgl_sumasdtg`, `jns_sumas`, `judul`, `isi`, `instansi`, `penerima`, `file_sumas`) VALUES
(3, 'SUMAS001', '003/004/srt004/', '2018-02-01', '2018-02-02', 'surat undangan', 'untuk pegawai 002', 'ssss', 'bappeda', 'PEG002', 'Desert.jpg'),
(5, 'SUMAS002', '0002010201', '2018-02-01', '2018-02-02', 'sss', 'ss', 'ss', 'sSd', 'PEG001', 'Pegawai__aminudin_.pdf');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `config`
--
ALTER TABLE `config`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `disposisi`
--
ALTER TABLE `disposisi`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `pegawai`
--
ALTER TABLE `pegawai`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `surat_keluar`
--
ALTER TABLE `surat_keluar`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `surat_masuk`
--
ALTER TABLE `surat_masuk`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `config`
--
ALTER TABLE `config`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT untuk tabel `disposisi`
--
ALTER TABLE `disposisi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT untuk tabel `pegawai`
--
ALTER TABLE `pegawai`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT untuk tabel `surat_keluar`
--
ALTER TABLE `surat_keluar`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT untuk tabel `surat_masuk`
--
ALTER TABLE `surat_masuk`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
