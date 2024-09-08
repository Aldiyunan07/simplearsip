-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Waktu pembuatan: 08 Sep 2024 pada 04.04
-- Versi server: 8.0.30
-- Versi PHP: 8.1.10

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
  `id` int NOT NULL,
  `no_peg` varchar(100) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `level` enum('admin') NOT NULL,
  `copyright` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
  `id` int NOT NULL,
  `no_disposisi` varchar(100) NOT NULL,
  `no_sumas` varchar(100) NOT NULL,
  `tgl_dispo` varchar(100) NOT NULL,
  `penerima` varchar(100) NOT NULL,
  `judul` varchar(100) NOT NULL,
  `catatan` varchar(250) NOT NULL,
  `pengirim` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `disposisi`
--

INSERT INTO `disposisi` (`id`, `no_disposisi`, `no_sumas`, `tgl_dispo`, `penerima`, `judul`, `catatan`, `pengirim`) VALUES
(14, 'DISPO001', '001/001/001', '2024-09-07', 'PEG002', 'Contoh Subject', 'Lorem Ipsum', 'PEG001');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pegawai`
--

CREATE TABLE `pegawai` (
  `id` int NOT NULL,
  `no_peg` varchar(10) DEFAULT NULL,
  `nama_peg` text,
  `nip` varchar(255) DEFAULT NULL,
  `golongan` varchar(255) DEFAULT NULL,
  `jabatan` text,
  `alamat` varchar(100) DEFAULT NULL,
  `no_telp` varchar(13) DEFAULT NULL,
  `jns_kelamin` enum('laki-laki','perempuan') CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  `level` enum('admin','user') DEFAULT NULL,
  `username` varchar(100) DEFAULT NULL,
  `password` varchar(100) DEFAULT NULL,
  `pertanyaan` varchar(100) NOT NULL,
  `photo` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `pegawai`
--

INSERT INTO `pegawai` (`id`, `no_peg`, `nama_peg`, `nip`, `golongan`, `jabatan`, `alamat`, `no_telp`, `jns_kelamin`, `level`, `username`, `password`, `pertanyaan`, `photo`) VALUES
(6, 'PEG001', 'Administrator', '0000', 'Golongan ', 'Super Admin', 'Kp Sindang Wargi', '08000000000', 'laki-laki', 'admin', 'admin', 'password', 'mandarin', 'upload/13.png'),
(32, 'PEG002', 'Eiusmod dolorem et a', '0001', 'Golongan A', 'Chief Technology Officer', 'Kp Durian Runtuh', '08111111111', 'laki-laki', 'user', 'cto', 'password', 'Dimana kamu lahir', 'upload/images.jpg'),
(33, 'PEG003', 'Libero enim velit re', '0002', 'Golongan B', 'Chief Marketing Officer', 'Kp Cibaduyut', '08222222222', 'laki-laki', 'user', 'cmo', 'password', 'Dimana kamu dibesarkan', 'upload/32.jpg'),
(34, 'PEG004', 'Maxime dicta ab omni', '0003', 'Golongan C', 'Chief Financial Officer', 'Kp Cibaduyut', '08333333333', 'perempuan', 'user', 'cfo', 'password', 'Dimana rumahmu?', 'upload/images (1).jpg'),
(35, 'PEG005', 'Voluptate excepturi ', '0004', 'Golongan D', 'Chief Executive Officer', 'Kp Baru Jaya', '08444444444', 'laki-laki', 'admin', 'ceo', 'password', 'Kapan kamu lahir', 'upload/25.jpg'),
(36, 'PEG006', 'Ratione cillum sunt ', '0005', 'Golongan E', 'Humas', 'Kp Baru Jaya', '08555555555', 'laki-laki', 'user', 'humas', 'password', 'Kapan kamu dibesarkan', 'upload/42.jpg'),
(37, 'PEG007', 'Quisquam sequi est ', '0006', 'Golongan F', 'Kebersihan', 'Kp Baru Jaya', '08666666666', 'laki-laki', 'user', 'kebersihan', 'password', 'Dimana rumah ?', 'upload/13.png');

-- --------------------------------------------------------

--
-- Struktur dari tabel `surat_keluar`
--

CREATE TABLE `surat_keluar` (
  `id` int NOT NULL,
  `kd_sukel` varchar(100) NOT NULL,
  `no_sukel` varchar(100) NOT NULL,
  `tgl_sukel` date NOT NULL,
  `instansi` text NOT NULL,
  `judul_sukel` text NOT NULL,
  `isi_sukel` varchar(250) NOT NULL,
  `file_sukel` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `surat_keluar`
--

INSERT INTO `surat_keluar` (`id`, `kd_sukel`, `no_sukel`, `tgl_sukel`, `instansi`, `judul_sukel`, `isi_sukel`, `file_sukel`) VALUES
(30, 'SUKEL001', '001/002/003', '2024-09-07', 'PT Bangkrut Jaya', 'Example Subject', 'tidak ada', 'Teknik Informatika.pdf'),
(31, 'SUKEL002', '002/003/004', '2024-09-07', 'PT Sudah Bangun Tidur Lagi', 'Contoh Subject ', 'jika ada ', 'Teknik Informatika.pdf');

-- --------------------------------------------------------

--
-- Struktur dari tabel `surat_masuk`
--

CREATE TABLE `surat_masuk` (
  `id` int NOT NULL,
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
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `surat_masuk`
--

INSERT INTO `surat_masuk` (`id`, `kd_sumas`, `no_sumas`, `tgl_sumas`, `tgl_sumasdtg`, `jns_sumas`, `judul`, `isi`, `instansi`, `penerima`, `file_sumas`) VALUES
(10, 'SUMAS001', '001/001/001', '2024-09-07', '2024-09-07', 'Jenis 1', 'Contoh Subject', 'Lorem Ipsum', 'PT Bangkrut Jaya Kembali', 'PEG002 (Eiusmod dolorem et a)', 'Teknik Informatika.pdf');

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
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT untuk tabel `disposisi`
--
ALTER TABLE `disposisi`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT untuk tabel `pegawai`
--
ALTER TABLE `pegawai`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT untuk tabel `surat_keluar`
--
ALTER TABLE `surat_keluar`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT untuk tabel `surat_masuk`
--
ALTER TABLE `surat_masuk`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
