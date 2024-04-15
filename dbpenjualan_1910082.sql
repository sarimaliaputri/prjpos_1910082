-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 14 Feb 2023 pada 01.58
-- Versi server: 10.4.25-MariaDB
-- Versi PHP: 8.0.23

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dbpenjualan_1910082`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `bantu_1910082`
--

CREATE TABLE `bantu_1910082` (
  `id_1910082` int(11) NOT NULL,
  `faktur_1910082` char(20) DEFAULT NULL,
  `idbrg_1910082` char(11) DEFAULT NULL,
  `qty_1910082` int(11) DEFAULT NULL,
  `hrg_1910082` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `barangkeluar_1910082`
--

CREATE TABLE `barangkeluar_1910082` (
  `nofakkeluar_1910082` char(20) NOT NULL,
  `tglkeluar_1910082` date DEFAULT NULL,
  `keluarkdplg_1910082` char(10) DEFAULT NULL,
  `jumlahuang_1910082` double DEFAULT NULL,
  `sisauang_1910082` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `barangkeluar_1910082`
--

INSERT INTO `barangkeluar_1910082` (`nofakkeluar_1910082`, `tglkeluar_1910082`, `keluarkdplg_1910082`, `jumlahuang_1910082`, `sisauang_1910082`) VALUES
('0402230001', '2023-02-04', 'PEL-015', NULL, NULL),
('0402230002', '2023-02-04', 'PEL-004', NULL, NULL),
('0402230003', '2023-02-04', 'PEL-004', NULL, NULL),
('0602230001', '2023-02-06', 'PEL-001', NULL, NULL),
('1302230001', '2023-02-13', 'PEL-013', NULL, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `barangmasuk_1910082`
--

CREATE TABLE `barangmasuk_1910082` (
  `nofakmasuk_1910082` char(20) NOT NULL,
  `tglmasuk_1910082` date DEFAULT NULL,
  `masukkdpem_1910082` char(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `barangmasuk_1910082`
--

INSERT INTO `barangmasuk_1910082` (`nofakmasuk_1910082`, `tglmasuk_1910082`, `masukkdpem_1910082`) VALUES
('F0001', '2023-01-02', 'PEM-001'),
('F0002', '2023-01-02', 'PEM-002'),
('F0003', '2023-01-02', 'PEM-003'),
('F0004', '2023-01-08', 'PEM-004'),
('F0005', '2023-01-15', 'PEM-009'),
('F0006', '2023-01-16', 'PEM-001'),
('F0007', '2023-01-16', 'PEM-004'),
('F0008', '2023-01-16', 'PEM-001'),
('F0009', '2023-01-16', 'PEM-001'),
('F0010', '2023-01-16', 'PEM-001'),
('F0011', '2023-01-27', 'PEM-001'),
('F0012', '2023-01-30', 'PEM-001');

-- --------------------------------------------------------

--
-- Struktur dari tabel `barang_1910082`
--

CREATE TABLE `barang_1910082` (
  `kdbrg_1910082` char(11) NOT NULL,
  `namabrg_1910082` varchar(50) DEFAULT NULL,
  `satuanbrg_1910082` varchar(50) DEFAULT NULL,
  `hargabrg_1910082` int(11) DEFAULT NULL,
  `stokbrg_1910082` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `barang_1910082`
--

INSERT INTO `barang_1910082` (`kdbrg_1910082`, `namabrg_1910082`, `satuanbrg_1910082`, `hargabrg_1910082`, `stokbrg_1910082`) VALUES
('BRG-001', 'Minyak Goreng', 'Liter', 5000, 0),
('BRG-002', 'Telur', 'Butir', 12000, 28),
('BRG-003', 'Tepung Terigu', 'Gram', 8000, 57),
('BRG-004', 'Mie Instan', 'PCS', 3000, 33),
('BRG-005', 'Air Mineral', 'Botol', 10000, 81),
('BRG-006', 'Sabun', 'PCS', 5000, 13),
('BRG-007', 'Shampoo', 'Sachet', 2000, 35),
('BRG-008', 'Pasta Gigi', 'PCS', 20000, 22),
('BRG-009', 'Rokok', 'Batangan', 5000, 30),
('BRG-010', 'Detergen', 'PCS', 1000, 25),
('BRG-011', 'Sunlight', 'Botol', 25000, 10),
('BRG-012', 'So Klin', 'PCS', 25000, 25),
('BRG-013', 'Downy', 'Sachet', 500, 13),
('BRG-014', 'Kopi Luwak', 'Sachet', 2000, 30),
('BRG-015', 'Susu Kental Manis', 'Kaleng', 12000, 20),
('BRG-016', 'Kecap Manis Bango', 'Sachet', 3000, 10),
('BRG-017', 'Saus Sambal ABC', 'Sachet', 3000, 25),
('BRG-018', 'Baygon', 'Kotak', 5000, 33),
('BRG-019', 'Buku Tulis', 'PCS', 4000, 29),
('BRG-020', 'Pulpen', 'PCS', 1500, 20);

-- --------------------------------------------------------

--
-- Struktur dari tabel `detailkeluar_1910082`
--

CREATE TABLE `detailkeluar_1910082` (
  `detailidkeluar_1910082` bigint(20) NOT NULL,
  `detailnofakkeluar_1910082` char(20) DEFAULT NULL,
  `detailkeluarkdbrg_1910082` char(11) DEFAULT NULL,
  `detailkeluarqty_1910082` int(11) DEFAULT NULL,
  `detailkeluarhrg_1910082` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `detailkeluar_1910082`
--

INSERT INTO `detailkeluar_1910082` (`detailidkeluar_1910082`, `detailnofakkeluar_1910082`, `detailkeluarkdbrg_1910082`, `detailkeluarqty_1910082`, `detailkeluarhrg_1910082`) VALUES
(22, '0402230001', 'BRG-019', 1, 4000),
(23, '0402230002', 'BRG-005', 2, 10000),
(24, '0402230003', 'BRG-004', 2, 3000),
(25, '0402230003', 'BRG-005', 1, 10000),
(26, '0602230001', 'BRG-001', 20, 5000),
(27, '0602230002', 'BRG-001', 1, 5000),
(28, '0602230001', 'BRG-002', 2, 12000),
(29, '1302230001', 'BRG-001', 1, 5000);

--
-- Trigger `detailkeluar_1910082`
--
DELIMITER $$
CREATE TRIGGER `t_ai_detailkeluar_1910082` AFTER INSERT ON `detailkeluar_1910082` FOR EACH ROW BEGIN
UPDATE barang_1910082 SET stokbrg_1910082 = stokbrg_1910082 - NEW .detailkeluarqty_1910082 WHERE kdbrg_1910082 = NEW .detailkeluarkdbrg_1910082;
    END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Struktur dari tabel `detailmasuk_1910082`
--

CREATE TABLE `detailmasuk_1910082` (
  `detailidmasuk_1910082` bigint(20) NOT NULL,
  `detailnofak_1910082` char(20) DEFAULT NULL,
  `detailkdbrg_1910082` char(11) DEFAULT NULL,
  `detailqty_1910082` int(11) DEFAULT NULL,
  `detailhrgbrg_1910082` double DEFAULT NULL,
  `detailsubtotal_1910082` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `detailmasuk_1910082`
--

INSERT INTO `detailmasuk_1910082` (`detailidmasuk_1910082`, `detailnofak_1910082`, `detailkdbrg_1910082`, `detailqty_1910082`, `detailhrgbrg_1910082`, `detailsubtotal_1910082`) VALUES
(1, 'F0001', 'BRG-002', 5, 12000, NULL),
(2, 'F0001', 'BRG-004', 2, 3000, NULL),
(3, 'F0002', 'BRG-006', 5, 5000, NULL),
(4, 'F0002', 'BRG-005', 1, 10000, NULL),
(5, 'F0003', 'BRG-018', 20, 5000, NULL),
(6, 'F0003', 'BRG-022', 2, 15000, NULL),
(7, 'F0004', 'BRG-004', 5, 3000, NULL),
(8, 'F0004', 'BRG-005', 10, 10000, NULL),
(9, 'F0005', 'BRG-005', 1, 10000, NULL),
(10, 'F0005', 'BRG-008', 2, 20000, NULL),
(11, 'F0006', 'BRG-001', 2, 5000, NULL),
(12, 'F0006', 'BRG-002', 5, 12000, NULL),
(13, 'F0007', 'BRG-004', 3, 3000, NULL),
(14, 'F0007', 'BRG-008', 5, 20000, NULL),
(15, 'F0008', 'BRG-003', 30, 8000, NULL),
(16, 'F0008', 'BRG-005', 50, 10000, NULL),
(17, 'F0009', 'BRG-004', 4, 3000, NULL),
(18, 'F0009', 'BRG-007', 10, 2000, NULL),
(19, 'F0010', 'BRG-001', 5, 5000, NULL),
(20, 'F0010', 'BRG-003', 20, 8000, NULL),
(21, 'F0011', 'BRG-009', 5, 5000, NULL),
(22, 'F0011', 'BRG-010', 5, 1000, NULL),
(23, 'F0012', 'BRG-001', 3, 5000, NULL),
(24, 'F0012', 'BRG-002', 5, 12000, NULL),
(25, 'F0013', 'BRG-001', 4, 5000, NULL);

--
-- Trigger `detailmasuk_1910082`
--
DELIMITER $$
CREATE TRIGGER `t_ai_detailmasuk_1910082` AFTER INSERT ON `detailmasuk_1910082` FOR EACH ROW BEGIN
UPDATE barang_1910082 SET stokbrg_1910082 = stokbrg_1910082 + NEW .detailqty_1910082 WHERE kdbrg_1910082 = NEW .detailkdbrg_1910082;
    END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Struktur dari tabel `pelanggan_1910082`
--

CREATE TABLE `pelanggan_1910082` (
  `kdplg_1910082` char(10) NOT NULL,
  `namaplg_1910082` varchar(50) DEFAULT NULL,
  `alamatplg_1910082` varchar(50) DEFAULT NULL,
  `notlp_1910082` varchar(15) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `pelanggan_1910082`
--

INSERT INTO `pelanggan_1910082` (`kdplg_1910082`, `namaplg_1910082`, `alamatplg_1910082`, `notlp_1910082`) VALUES
('PEL-001', 'Sari', 'JL Veteran', '081212121212'),
('PEL-002', 'Wafi', 'JL Gajah Mada', '081223232323'),
('PEL-003', 'Puput', 'JL K.H Ahmad Dahlan', '081234343434'),
('PEL-004', 'Attaya', 'JL Jhoni Anwar', '081245454545'),
('PEL-005', 'Yumna', 'JL Thamrin', '081256565656'),
('PEL-006', 'Adib', 'Alai', '081267676767'),
('PEL-007', 'Alyssia', 'Siteba', '081278787878'),
('PEL-008', 'Abid', 'Gunung Pangilun', '081289898989'),
('PEL-009', 'Aqila', 'Simpang Tinju', '081290909090'),
('PEL-010', 'Keenan', 'Jati', '081201010101'),
('PEL-011', 'Kanaya', 'Ampang', '081202020202'),
('PEL-012', 'Khaleed', 'Ulak Karang', '081203030303'),
('PEL-013', 'Rindu', 'Lapai', '081204040404'),
('PEL-014', 'Bilal', 'Ganting', '081205050505'),
('PEL-015', 'Naura', 'Purus', '081206060606');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pemasok_1910082`
--

CREATE TABLE `pemasok_1910082` (
  `kdpem_1910082` char(10) NOT NULL,
  `namapem_1910082` varchar(50) DEFAULT NULL,
  `alamatpem_1910082` varchar(50) DEFAULT NULL,
  `notlp_1910082` varchar(15) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `pemasok_1910082`
--

INSERT INTO `pemasok_1910082` (`kdpem_1910082`, `namapem_1910082`, `alamatpem_1910082`, `notlp_1910082`) VALUES
('PEM-001', 'PT Jaya Utama Santikah', 'Lubuk Buaya', '(0751) 10101'),
('PEM-002', 'CV Adorra Jaya Mandriri', 'Tabing', '(0751) 20202'),
('PEM-003', 'PT Jeje Elshadai Suksesindo', 'Ulak Karang', '(0751) 30303'),
('PEM-004', 'CV Era Media Printing', 'Veteran', '(0751) 40404'),
('PEM-005', 'PT Wijayamas Teknindo', 'Purus', '(0751) 50505'),
('PEM-006', 'PT Satriya Ekatama Prasetiya', 'Ganting', '(0751) 60606'),
('PEM-007', 'PT Shasco Gunakarya Piranti', 'Ampang', '(0751) 70707'),
('PEM-008', 'PT Aku Sayang Indonesia Ku', 'Alai', '(0751) 80808'),
('PEM-009', 'CV Global Solusindo Teknologi', 'Siteba', '(0751) 90909'),
('PEM-010', 'PT Dachangsheng Racking Indonesia', 'Adinegoro', '(0751) 12131');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `bantu_1910082`
--
ALTER TABLE `bantu_1910082`
  ADD PRIMARY KEY (`id_1910082`);

--
-- Indeks untuk tabel `barangkeluar_1910082`
--
ALTER TABLE `barangkeluar_1910082`
  ADD PRIMARY KEY (`nofakkeluar_1910082`);

--
-- Indeks untuk tabel `barangmasuk_1910082`
--
ALTER TABLE `barangmasuk_1910082`
  ADD PRIMARY KEY (`nofakmasuk_1910082`);

--
-- Indeks untuk tabel `barang_1910082`
--
ALTER TABLE `barang_1910082`
  ADD PRIMARY KEY (`kdbrg_1910082`);

--
-- Indeks untuk tabel `detailkeluar_1910082`
--
ALTER TABLE `detailkeluar_1910082`
  ADD PRIMARY KEY (`detailidkeluar_1910082`);

--
-- Indeks untuk tabel `detailmasuk_1910082`
--
ALTER TABLE `detailmasuk_1910082`
  ADD PRIMARY KEY (`detailidmasuk_1910082`);

--
-- Indeks untuk tabel `pelanggan_1910082`
--
ALTER TABLE `pelanggan_1910082`
  ADD PRIMARY KEY (`kdplg_1910082`);

--
-- Indeks untuk tabel `pemasok_1910082`
--
ALTER TABLE `pemasok_1910082`
  ADD PRIMARY KEY (`kdpem_1910082`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `bantu_1910082`
--
ALTER TABLE `bantu_1910082`
  MODIFY `id_1910082` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=131;

--
-- AUTO_INCREMENT untuk tabel `detailkeluar_1910082`
--
ALTER TABLE `detailkeluar_1910082`
  MODIFY `detailidkeluar_1910082` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT untuk tabel `detailmasuk_1910082`
--
ALTER TABLE `detailmasuk_1910082`
  MODIFY `detailidmasuk_1910082` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
