-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 09 Okt 2024 pada 14.44
-- Versi server: 10.4.24-MariaDB
-- Versi PHP: 7.4.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `toko_alat_musik`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `pesanan`
--

CREATE TABLE `pesanan` (
  `id` int(11) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `umur` int(255) NOT NULL,
  `password` varchar(11) NOT NULL,
  `ingin_memesan` varchar(5) NOT NULL,
  `jumlah_pesanan` int(255) DEFAULT NULL,
  `total_harga` int(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `pesanan`
--

INSERT INTO `pesanan` (`id`, `nama`, `umur`, `password`, `ingin_memesan`, `jumlah_pesanan`, `total_harga`) VALUES
(4, 'rara', 24, '$2y$10$Iu6d', 'Ya', 10, 30000000),
(5, 'q', 21, '$2y$10$jgmo', 'Ya', 2, 6000000),
(6, 'kiki', 12, '$2y$10$0xFY', 'Ya', 2, 6000000),
(8, 'arip', 12, '$2y$10$o5fj', 'Ya', 2, 6000000),
(13, 'ucup', 12, '$2y$10$7yxO', 'Ya', 1, 0),
(14, 'arap', 11, '$2y$10$r6Pe', 'Ya', 2, 9000000),
(15, 'alfredo', 22, '$2y$10$4LqJ', 'Ya', 2, 2147483647);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `pesanan`
--
ALTER TABLE `pesanan`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nama` (`nama`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `pesanan`
--
ALTER TABLE `pesanan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
