-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Waktu pembuatan: 01 Jul 2024 pada 19.46
-- Versi server: 10.4.28-MariaDB
-- Versi PHP: 8.1.17

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_uas`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `kategori`
--

CREATE TABLE `kategori` (
  `idkategori` varchar(6) NOT NULL,
  `tipekategori` varchar(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `kategori`
--

INSERT INTO `kategori` (`idkategori`, `tipekategori`) VALUES
('1', 'Masuk'),
('2', 'Keluar');

-- --------------------------------------------------------

--
-- Struktur dari tabel `keluar`
--

CREATE TABLE `keluar` (
  `idkeluar` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `login`
--

CREATE TABLE `login` (
  `idlogin` int(11) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `login`
--

INSERT INTO `login` (`idlogin`, `username`, `password`) VALUES
(1, 'reza', 'Kelompok01'),
(2, 'puja', 'Kelompok01'),
(3, 'iqbal', 'Kelompok01'),
(4, 'lukman', 'Kelompok01'),
(5, 'silvi', 'Kelompok01'),
(6, 'aulia', 'Kelompok01'),
(7, 'anas', 'Kelompok01');

-- --------------------------------------------------------

--
-- Struktur dari tabel `masuk`
--

CREATE TABLE `masuk` (
  `idmasuk` int(11) NOT NULL,
  `idtransaksi` int(11) NOT NULL,
  `produk` varchar(20) NOT NULL,
  `keterangan` varchar(7) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `tanggal` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `produk`
--

CREATE TABLE `produk` (
  `idproduk` varchar(6) NOT NULL,
  `namaproduk` varchar(20) NOT NULL,
  `hargasatuan` int(30) NOT NULL,
  `idsupplier` varchar(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `produk`
--

INSERT INTO `produk` (`idproduk`, `namaproduk`, `hargasatuan`, `idsupplier`) VALUES
('1136', 'Amicus X6R2301', 1650000, '1157'),
('1184', 'AmiCORE P6R8884', 2650000, '1157'),
('2269', 'S5L', 1850000, '1157'),
('2978', 'AmiCORE P6R8880', 1350000, '1157'),
('6274', 'Compolab TS', 8000000, '1157');

-- --------------------------------------------------------

--
-- Struktur dari tabel `supplier`
--

CREATE TABLE `supplier` (
  `idsupplier` varchar(6) NOT NULL,
  `namasupplier` varchar(30) NOT NULL,
  `alamat` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `supplier`
--

INSERT INTO `supplier` (`idsupplier`, `namasupplier`, `alamat`) VALUES
('1157', 'PT AMA', 'Jl Bandengan Utara'),
('1962', 'PT Medquest Jaya Global', 'JL Salemba Raya'),
('4081', 'PT IHSG', 'JL Surabaya'),
('5387', 'PT Alfa Jaya', 'Jl. Pahlawan'),
('9247', 'PT Transmedic', 'Menara Era, Atrium Senen');

-- --------------------------------------------------------

--
-- Struktur dari tabel `transaction`
--

CREATE TABLE `transaction` (
  `idtransaksi` varchar(6) NOT NULL,
  `idproduk` varchar(6) NOT NULL,
  `idkategori` varchar(6) NOT NULL,
  `kuantitas` int(11) NOT NULL,
  `tanggal` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `transaction`
--

INSERT INTO `transaction` (`idtransaksi`, `idproduk`, `idkategori`, `kuantitas`, `tanggal`) VALUES
('218734', '1184', '2', 4, '2024-06-30'),
('296231', '6274', '2', 15, '2024-06-07'),
('348236', '6274', '1', 20, '2024-06-01'),
('676199', '1184', '1', 2, '2024-06-30'),
('681126', '1184', '1', 3, '2024-06-30'),
('870978', '2269', '2', 90, '2024-07-02'),
('946492', '2269', '1', 100, '2024-07-01');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `kategori`
--
ALTER TABLE `kategori`
  ADD PRIMARY KEY (`idkategori`);

--
-- Indeks untuk tabel `keluar`
--
ALTER TABLE `keluar`
  ADD KEY `idkeluar` (`idkeluar`);

--
-- Indeks untuk tabel `login`
--
ALTER TABLE `login`
  ADD PRIMARY KEY (`idlogin`);

--
-- Indeks untuk tabel `masuk`
--
ALTER TABLE `masuk`
  ADD PRIMARY KEY (`idmasuk`);

--
-- Indeks untuk tabel `produk`
--
ALTER TABLE `produk`
  ADD PRIMARY KEY (`idproduk`),
  ADD KEY `idsupplier` (`idsupplier`);

--
-- Indeks untuk tabel `supplier`
--
ALTER TABLE `supplier`
  ADD PRIMARY KEY (`idsupplier`),
  ADD KEY `namasupplier` (`namasupplier`);

--
-- Indeks untuk tabel `transaction`
--
ALTER TABLE `transaction`
  ADD PRIMARY KEY (`idtransaksi`),
  ADD KEY `idproduk` (`idproduk`,`idkategori`),
  ADD KEY `idkategori` (`idkategori`);

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `produk`
--
ALTER TABLE `produk`
  ADD CONSTRAINT `produk_ibfk_1` FOREIGN KEY (`idsupplier`) REFERENCES `supplier` (`idsupplier`);

--
-- Ketidakleluasaan untuk tabel `transaction`
--
ALTER TABLE `transaction`
  ADD CONSTRAINT `transaction_ibfk_1` FOREIGN KEY (`idproduk`) REFERENCES `produk` (`idproduk`),
  ADD CONSTRAINT `transaction_ibfk_2` FOREIGN KEY (`idkategori`) REFERENCES `kategori` (`idkategori`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
