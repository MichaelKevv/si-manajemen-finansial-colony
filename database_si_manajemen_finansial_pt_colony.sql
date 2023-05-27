-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 14 Apr 2023 pada 08.11
-- Versi server: 10.4.24-MariaDB
-- Versi PHP: 8.0.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `si_finansial`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `barang`
--

CREATE TABLE `barang` (
  `id_barang` char(36) NOT NULL,
  `id_kategori_barang` char(36) NOT NULL,
  `id_gudang` char(36) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `harga` int(11) NOT NULL,
  `tgl_masuk` timestamp NULL DEFAULT NULL,
  `tgl_keluar` timestamp NULL DEFAULT NULL,
  `deskripsi` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL,
  `foto` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `barang`
--

INSERT INTO `barang` (`id_barang`, `id_kategori_barang`, `id_gudang`, `nama`, `harga`, `tgl_masuk`, `tgl_keluar`, `deskripsi`, `status`, `foto`, `created_at`, `updated_at`) VALUES
('98d9fa65-87dc-420f-a9d8-1fc8ca9539f1', '98d98f2d-b266-4862-b8a9-9f35109016c5', 'b2375a6f-d220-11ed-9085-e4e7493b7607', 'Susu Diamond UHT (Coklat)', 10000, '2012-02-11 17:00:00', '2023-04-13 17:00:00', 'Susu Diamond UHT (Coklat)', 'EXP', 'YIk3tK2KKdCPCoumLkvu0rKi8S02NvcBh2YJce2V.jpg', '2023-04-04 07:49:22', '2023-04-09 10:44:29');

-- --------------------------------------------------------

--
-- Struktur dari tabel `gudang`
--

CREATE TABLE `gudang` (
  `id_gudang` char(36) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `deskripsi` varchar(255) NOT NULL,
  `alamat` varchar(255) NOT NULL,
  `kapasitas` int(11) NOT NULL,
  `status` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `gudang`
--

INSERT INTO `gudang` (`id_gudang`, `nama`, `deskripsi`, `alamat`, `kapasitas`, `status`, `created_at`, `updated_at`) VALUES
('b2375a6f-d220-11ed-9085-e4e7493b7607', 'Gudang Malang', 'Gudang yang terletak di k', 'Jl Tanjung Karlos', 1000, 'Tersedia', NULL, '2023-04-04 07:26:46');

-- --------------------------------------------------------

--
-- Struktur dari tabel `kategori_barang`
--

CREATE TABLE `kategori_barang` (
  `id_kategori_barang` char(36) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `deskripsi` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `kategori_barang`
--

INSERT INTO `kategori_barang` (`id_kategori_barang`, `nama`, `deskripsi`, `created_at`, `updated_at`) VALUES
('970931ab-d220-11ed-9085-e4e7493b7607', 'Snack', 'Sebuah makanan ringan yang berasal dari PT Colony', '2023-04-03 13:30:09', '2023-04-03 13:30:09'),
('98d98f2d-b266-4862-b8a9-9f35109016c5', 'Minuman', 'Minum', '2023-04-04 02:49:34', '2023-04-04 02:49:34');

-- --------------------------------------------------------

--
-- Struktur dari tabel `mutasi_stok`
--

CREATE TABLE `mutasi_stok` (
  `id_mutasi` char(36) NOT NULL,
  `id_barang` char(36) NOT NULL,
  `id_pengiriman` char(36) DEFAULT NULL,
  `jumlah_mutasi` int(11) NOT NULL,
  `keterangan` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL,
  `tgl_mutasi` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `mutasi_stok`
--

INSERT INTO `mutasi_stok` (`id_mutasi`, `id_barang`, `id_pengiriman`, `jumlah_mutasi`, `keterangan`, `status`, `tgl_mutasi`, `created_at`, `updated_at`) VALUES
('98e95a2e-b521-4d48-aa6c-24389a88ffa2', '98d9fa65-87dc-420f-a9d8-1fc8ca9539f1', '98e95a2e-9b7d-4aa0-845c-9bb51aed7bd7', 50, 'Memindahkan Stok Barang', 'Perjalanan', '2023-04-11 17:00:00', '2023-04-12 06:14:38', '2023-04-12 07:39:48'),
('98e9795d-b9d9-4c04-85e0-e13676d6b210', '98d9fa65-87dc-420f-a9d8-1fc8ca9539f1', '98e9795d-ae15-42a9-8663-65afedff789b', 10, 'Barang EXP', 'Disiapkan', '2023-04-10 17:00:00', '2023-04-12 07:41:49', '2023-04-12 07:41:49');

-- --------------------------------------------------------

--
-- Struktur dari tabel `outlet`
--

CREATE TABLE `outlet` (
  `id_outlet` char(36) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `deskripsi` varchar(255) NOT NULL,
  `tipe` varchar(255) NOT NULL,
  `alamat` varchar(255) NOT NULL,
  `latitude` varchar(255) NOT NULL,
  `longitude` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `outlet`
--

INSERT INTO `outlet` (`id_outlet`, `nama`, `deskripsi`, `tipe`, `alamat`, `latitude`, `longitude`, `created_at`, `updated_at`) VALUES
('d9897593-d3bc-11ed-8c2d-e4e7493b7607', 'Toko Kevin', 'Toko di jalan A Yani', 'Toko Kelontong', 'Malang', '-7.95458563', '112.6507698', NULL, '2023-04-05 07:29:57');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pegawai`
--

CREATE TABLE `pegawai` (
  `id_pegawai` char(36) NOT NULL,
  `id_pengguna` char(36) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `alamat` varchar(255) NOT NULL,
  `no_hp` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `foto` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `pegawai`
--

INSERT INTO `pegawai` (`id_pegawai`, `id_pengguna`, `nama`, `alamat`, `no_hp`, `email`, `username`, `password`, `foto`, `created_at`, `updated_at`) VALUES
('98d9fae5-6bc5-4964-8305-cdea0d05f496', '5cb3b749-cbfa-11ed-b1bb-e4e7493b7607', 'Admin', 'Malang', '085790291176', 'syahrulhidayat342@gmail.com', 'admin', '21232f297a57a5a743894a0e4a801fc3', 'QEkxBRUr6xECc1piyW8l6JSCiu84MB4Mq5eaHuBU.png', '2023-04-04 07:50:46', '2023-04-07 16:43:34'),
('c774336a-cbfa-11ed-b1bb-e4e7493b7607', '5cb3b749-cbfa-11ed-b1bb-e4e7493b7607', 'Kevin', 'Malang', '0888888', 'kevin@gmail.com', 'kevin', '9d5e3ecdeb4cdb7acfd63075ae046672', '9ORxtGYnxJH7O4PKtvYehh8NmGeXMZPpy2i1r50R.png', NULL, '2023-04-04 08:16:18');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pengguna`
--

CREATE TABLE `pengguna` (
  `id_pengguna` char(36) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `role` varchar(20) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `pengguna`
--

INSERT INTO `pengguna` (`id_pengguna`, `nama`, `role`, `created_at`, `updated_at`) VALUES
('5cb3b749-cbfa-11ed-b1bb-e4e7493b7607', 'Admin', '0', NULL, NULL),
('ca36bae2-d209-11ed-9085-e4e7493b7607', 'Kurir', '5', NULL, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `pengiriman`
--

CREATE TABLE `pengiriman` (
  `id_pengiriman` char(36) NOT NULL,
  `id_barang` char(36) NOT NULL,
  `asal` varchar(255) NOT NULL,
  `tujuan` varchar(255) NOT NULL,
  `ongkos_kirim` int(11) NOT NULL,
  `metode_pengiriman` varchar(255) NOT NULL,
  `tipe_pengiriman` varchar(255) NOT NULL,
  `tgl_pengiriman` timestamp NULL DEFAULT NULL,
  `tgl_diterima` timestamp NULL DEFAULT NULL,
  `status` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `pengiriman`
--

INSERT INTO `pengiriman` (`id_pengiriman`, `id_barang`, `asal`, `tujuan`, `ongkos_kirim`, `metode_pengiriman`, `tipe_pengiriman`, `tgl_pengiriman`, `tgl_diterima`, `status`, `created_at`, `updated_at`) VALUES
('98e95a2e-9b7d-4aa0-845c-9bb51aed7bd7', '98d9fa65-87dc-420f-a9d8-1fc8ca9539f1', 'Gudang Malang', 'Toko Kevin', 10000, 'Instant', 'Mutasi Stok', '2023-04-11 17:00:00', NULL, 'Perjalanan', '2023-04-12 06:14:38', '2023-04-12 06:14:38'),
('98e9795d-ae15-42a9-8663-65afedff789b', '98d9fa65-87dc-420f-a9d8-1fc8ca9539f1', 'Toko Kevin', 'Gudang Malang', 9000, 'Instant', 'Mutasi Stok', '2023-04-10 17:00:00', NULL, 'Disiapkan', '2023-04-12 07:41:49', '2023-04-12 07:41:49'),
('98e97dfe-4f73-43e9-8730-c357d13e4430', '98d9fa65-87dc-420f-a9d8-1fc8ca9539f1', 'Toko Kevin', 'Rumah Farish, Jalan Sungai Besar', 15000, 'Reguler - J&T', 'Pengiriman Barang ke Customer', '2023-04-11 17:00:00', '2023-04-16 17:00:00', 'Telah diterima', '2023-04-12 07:54:46', '2023-04-12 08:51:59');

-- --------------------------------------------------------

--
-- Struktur dari tabel `stok_barang`
--

CREATE TABLE `stok_barang` (
  `id_stok_barang` char(36) NOT NULL,
  `id_barang` char(36) NOT NULL,
  `jumlah_stok` int(11) NOT NULL,
  `satuan` varchar(255) NOT NULL,
  `tgl_dibuat` datetime DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `stok_barang`
--

INSERT INTO `stok_barang` (`id_stok_barang`, `id_barang`, `jumlah_stok`, `satuan`, `tgl_dibuat`, `created_at`, `updated_at`) VALUES
('98dd8a05-97b3-4b0a-856f-26b087228c6c', '98d9fa65-87dc-420f-a9d8-1fc8ca9539f1', 300, 'Pcs', '2023-04-05 00:00:00', '2023-04-06 02:18:28', '2023-04-06 02:19:04');

-- --------------------------------------------------------

--
-- Struktur dari tabel `supplier`
--

CREATE TABLE `supplier` (
  `id_supplier` char(36) NOT NULL,
  `id_barang` char(36) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `alamat` varchar(255) NOT NULL,
  `no_telp` varchar(255) NOT NULL,
  `jumlah_barang` int(11) NOT NULL,
  `tgl_supply` timestamp NULL DEFAULT NULL,
  `harga_supply` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `supplier`
--

INSERT INTO `supplier` (`id_supplier`, `id_barang`, `nama`, `alamat`, `no_telp`, `jumlah_barang`, `tgl_supply`, `harga_supply`, `created_at`, `updated_at`) VALUES
('1fdb9ff8-d99b-11ed-8c2d-e4e7493b7607', '98d9fa65-87dc-420f-a9d8-1fc8ca9539f1', 'PT Diamon Internasional', 'Beijing', '09876543212', 1000, '2023-04-12 01:25:54', 25000000, NULL, '2023-04-13 08:34:16');

-- --------------------------------------------------------

--
-- Struktur dari tabel `transaksi`
--

CREATE TABLE `transaksi` (
  `id_transaksi` char(36) NOT NULL,
  `id_outlet` char(36) NOT NULL,
  `id_pengiriman` char(36) NOT NULL,
  `id_barang` char(36) NOT NULL,
  `id_pegawai` char(36) NOT NULL,
  `jumlah_barang` int(11) NOT NULL,
  `total_harga` int(11) NOT NULL,
  `metode_bayar` varchar(255) NOT NULL,
  `keterangan` varchar(255) NOT NULL,
  `tgl_transaksi` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `barang`
--
ALTER TABLE `barang`
  ADD PRIMARY KEY (`id_barang`),
  ADD KEY `id_kategori_barang` (`id_kategori_barang`),
  ADD KEY `id_gudang` (`id_gudang`);

--
-- Indeks untuk tabel `gudang`
--
ALTER TABLE `gudang`
  ADD PRIMARY KEY (`id_gudang`);

--
-- Indeks untuk tabel `kategori_barang`
--
ALTER TABLE `kategori_barang`
  ADD PRIMARY KEY (`id_kategori_barang`);

--
-- Indeks untuk tabel `mutasi_stok`
--
ALTER TABLE `mutasi_stok`
  ADD PRIMARY KEY (`id_mutasi`),
  ADD KEY `id_barang` (`id_barang`),
  ADD KEY `id_pengiriman` (`id_pengiriman`);

--
-- Indeks untuk tabel `outlet`
--
ALTER TABLE `outlet`
  ADD PRIMARY KEY (`id_outlet`);

--
-- Indeks untuk tabel `pegawai`
--
ALTER TABLE `pegawai`
  ADD PRIMARY KEY (`id_pegawai`),
  ADD KEY `id_pengguna` (`id_pengguna`);

--
-- Indeks untuk tabel `pengguna`
--
ALTER TABLE `pengguna`
  ADD PRIMARY KEY (`id_pengguna`);

--
-- Indeks untuk tabel `pengiriman`
--
ALTER TABLE `pengiriman`
  ADD PRIMARY KEY (`id_pengiriman`),
  ADD KEY `id_barang` (`id_barang`);

--
-- Indeks untuk tabel `stok_barang`
--
ALTER TABLE `stok_barang`
  ADD PRIMARY KEY (`id_stok_barang`),
  ADD KEY `id_barang` (`id_barang`);

--
-- Indeks untuk tabel `supplier`
--
ALTER TABLE `supplier`
  ADD PRIMARY KEY (`id_supplier`),
  ADD KEY `id_barang` (`id_barang`);

--
-- Indeks untuk tabel `transaksi`
--
ALTER TABLE `transaksi`
  ADD PRIMARY KEY (`id_transaksi`),
  ADD KEY `id_outlet` (`id_outlet`),
  ADD KEY `id_pengiriman` (`id_pengiriman`),
  ADD KEY `id_barang` (`id_barang`),
  ADD KEY `id_pegawai` (`id_pegawai`);

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `barang`
--
ALTER TABLE `barang`
  ADD CONSTRAINT `barang_ibfk_2` FOREIGN KEY (`id_gudang`) REFERENCES `gudang` (`id_gudang`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `barang_ibfk_3` FOREIGN KEY (`id_kategori_barang`) REFERENCES `kategori_barang` (`id_kategori_barang`);

--
-- Ketidakleluasaan untuk tabel `mutasi_stok`
--
ALTER TABLE `mutasi_stok`
  ADD CONSTRAINT `mutasi_stok_ibfk_1` FOREIGN KEY (`id_barang`) REFERENCES `barang` (`id_barang`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `mutasi_stok_ibfk_2` FOREIGN KEY (`id_pengiriman`) REFERENCES `pengiriman` (`id_pengiriman`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `pegawai`
--
ALTER TABLE `pegawai`
  ADD CONSTRAINT `pegawai_ibfk_1` FOREIGN KEY (`id_pengguna`) REFERENCES `pengguna` (`id_pengguna`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `pengiriman`
--
ALTER TABLE `pengiriman`
  ADD CONSTRAINT `pengiriman_ibfk_1` FOREIGN KEY (`id_barang`) REFERENCES `barang` (`id_barang`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `stok_barang`
--
ALTER TABLE `stok_barang`
  ADD CONSTRAINT `stok_barang_ibfk_1` FOREIGN KEY (`id_barang`) REFERENCES `barang` (`id_barang`);

--
-- Ketidakleluasaan untuk tabel `supplier`
--
ALTER TABLE `supplier`
  ADD CONSTRAINT `supplier_ibfk_1` FOREIGN KEY (`id_barang`) REFERENCES `barang` (`id_barang`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `transaksi`
--
ALTER TABLE `transaksi`
  ADD CONSTRAINT `transaksi_ibfk_1` FOREIGN KEY (`id_outlet`) REFERENCES `outlet` (`id_outlet`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `transaksi_ibfk_2` FOREIGN KEY (`id_pengiriman`) REFERENCES `pengiriman` (`id_pengiriman`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `transaksi_ibfk_3` FOREIGN KEY (`id_barang`) REFERENCES `barang` (`id_barang`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `transaksi_ibfk_4` FOREIGN KEY (`id_pegawai`) REFERENCES `pegawai` (`id_pegawai`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
