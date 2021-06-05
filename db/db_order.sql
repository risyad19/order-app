-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 04 Jun 2021 pada 13.03
-- Versi server: 10.1.38-MariaDB
-- Versi PHP: 7.2.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_order`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `item_order`
--

CREATE TABLE `item_order` (
  `id` int(11) NOT NULL,
  `no_order` varchar(25) NOT NULL,
  `id_menu` int(11) NOT NULL,
  `qty` int(11) NOT NULL,
  `totalperitem` int(11) NOT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` int(11) NOT NULL,
  `updated` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_by` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `item_order`
--

INSERT INTO `item_order` (`id`, `no_order`, `id_menu`, `qty`, `totalperitem`, `created`, `created_by`, `updated`, `updated_by`) VALUES
(17, 'ABC040621-001', 2, 4, 48000, '2021-06-04 07:41:14', 1, '2021-06-03 17:00:00', 0),
(19, 'ABC040621-002', 1, 1, 35000, '2021-06-04 08:28:09', 1, '2021-06-03 17:00:00', 1),
(21, 'ABC040621-002', 7, 2, 70000, '2021-06-04 09:55:57', 1, '2021-06-03 17:00:00', 1),
(22, 'ABC040621-002', 2, 1, 12000, '2021-06-04 09:55:57', 1, '0000-00-00 00:00:00', 0),
(23, 'ABC040621-002', 5, 3, 135000, '2021-06-04 10:11:49', 1, '0000-00-00 00:00:00', 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `keys`
--

CREATE TABLE `keys` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `key` varchar(40) NOT NULL,
  `level` int(2) NOT NULL,
  `ignore_limits` tinyint(1) NOT NULL DEFAULT '0',
  `is_private_key` tinyint(1) NOT NULL DEFAULT '0',
  `ip_addresses` text,
  `date_created` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `keys`
--

INSERT INTO `keys` (`id`, `user_id`, `key`, `level`, `ignore_limits`, `is_private_key`, `ip_addresses`, `date_created`) VALUES
(1, 1, 'kasir123', 0, 0, 0, NULL, '2021-05-31 00:00:00');

-- --------------------------------------------------------

--
-- Struktur dari tabel `limits`
--

CREATE TABLE `limits` (
  `id` int(11) NOT NULL,
  `uri` varchar(255) NOT NULL,
  `count` int(10) NOT NULL,
  `hour_started` int(11) NOT NULL,
  `api_key` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `limits`
--

INSERT INTO `limits` (`id`, `uri`, `count`, `hour_started`, `api_key`) VALUES
(1, 'uri:api/menu/menu:get', 2, 1622442840, 'pelayan123');

-- --------------------------------------------------------

--
-- Struktur dari tabel `logs`
--

CREATE TABLE `logs` (
  `id` int(11) NOT NULL,
  `uri` varchar(255) NOT NULL,
  `method` varchar(6) NOT NULL,
  `params` text,
  `api_key` varchar(40) NOT NULL,
  `ip_address` varchar(45) NOT NULL,
  `time` int(11) NOT NULL,
  `rtime` float DEFAULT NULL,
  `authorized` varchar(1) NOT NULL,
  `response_code` smallint(3) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Struktur dari tabel `menu`
--

CREATE TABLE `menu` (
  `id` int(11) NOT NULL,
  `nama` varchar(25) NOT NULL,
  `kategori` int(1) NOT NULL,
  `harga` int(11) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `deskripsi` text NOT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` int(11) NOT NULL,
  `updated` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_by` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `menu`
--

INSERT INTO `menu` (`id`, `nama`, `kategori`, `harga`, `status`, `deskripsi`, `created`, `created_by`, `updated`, `updated_by`) VALUES
(1, 'Nasi Goreng Spesial Bange', 1, 35000, 1, 'Nasi goreng spesial dengan banyak toping sperti telur, ayam, baso, sosis, seafood. Enak!!!!', '2021-05-30 17:00:00', 0, '2021-05-31 17:00:00', 1),
(2, 'Jus Alpukat', 2, 12000, 1, 'Jul Alpukat pilihan dengan tambahan susu coklat', '2021-05-30 17:00:00', 0, '2021-05-30 17:00:00', 0),
(4, 'Jus Mangga', 2, 12000, 0, 'Dari mangga asli', '2021-05-31 17:00:00', 1, '0000-00-00 00:00:00', 0),
(5, 'Ayam Bekak', 1, 45000, 1, 'Makan khas daerah', '2021-05-31 17:00:00', 1, '0000-00-00 00:00:00', 0),
(7, 'CEYUK', 1, 35000, 1, 'Harga kiloan', '2021-05-31 17:00:00', 1, '0000-00-00 00:00:00', 0),
(8, 'Bubur Ayam Spesial Karet ', 1, 30000, 0, 'Enak sekali loh', '2021-06-03 11:22:58', 1, '0000-00-00 00:00:00', 2);

-- --------------------------------------------------------

--
-- Struktur dari tabel `order`
--

CREATE TABLE `order` (
  `id` int(11) NOT NULL,
  `no_order` varchar(25) NOT NULL,
  `no_meja` varchar(5) NOT NULL,
  `tanggal_order` date NOT NULL,
  `total_item` int(11) NOT NULL,
  `total_harga` int(11) NOT NULL,
  `status_order` tinyint(1) NOT NULL DEFAULT '1',
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` int(11) NOT NULL,
  `updated` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_by` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `order`
--

INSERT INTO `order` (`id`, `no_order`, `no_meja`, `tanggal_order`, `total_item`, `total_harga`, `status_order`, `created`, `created_by`, `updated`, `updated_by`) VALUES
(34, 'ABC040621-001', '1', '2021-06-04', 3, 59000, 1, '2021-06-04 07:41:14', 1, '0000-00-00 00:00:00', 0),
(35, 'ABC040621-002', '2', '2021-06-04', 7, 252000, 0, '2021-06-04 08:28:09', 1, '2021-06-03 17:00:00', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(15) NOT NULL,
  `password` varchar(250) NOT NULL,
  `active` int(11) NOT NULL,
  `level` int(11) NOT NULL,
  `created` date NOT NULL,
  `updated` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`id`, `username`, `password`, `active`, `level`, `created`, `updated`) VALUES
(1, 'kasir', 'e10adc3949ba59abbe56e057f20f883e', 1, 0, '2021-05-31', '2021-05-31'),
(2, 'pelayan', 'e10adc3949ba59abbe56e057f20f883e', 1, 1, '2021-05-31', '2021-05-31');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `item_order`
--
ALTER TABLE `item_order`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `keys`
--
ALTER TABLE `keys`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `limits`
--
ALTER TABLE `limits`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `menu`
--
ALTER TABLE `menu`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `order`
--
ALTER TABLE `order`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `no_order` (`no_order`);

--
-- Indeks untuk tabel `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `item_order`
--
ALTER TABLE `item_order`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT untuk tabel `keys`
--
ALTER TABLE `keys`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `limits`
--
ALTER TABLE `limits`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `menu`
--
ALTER TABLE `menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT untuk tabel `order`
--
ALTER TABLE `order`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT untuk tabel `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
