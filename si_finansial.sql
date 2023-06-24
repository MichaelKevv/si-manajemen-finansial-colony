-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 24 Jun 2023 pada 13.54
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
('9953b211-68c9-4b20-92ee-249c525c018f', '9923e539-20a3-4689-ad81-7b0d0016d044', '9923e523-7aa2-42ad-bfa5-41670081e617', 'Susu Diamond UHT', 300000, '2023-05-31 17:00:00', '2023-06-05 17:00:00', 'susu', 'Tersedia', 'fRiIvu0s8N13hEgwp9jYFB504otOEQnZLYzMfep8.jpg', '2023-06-04 02:58:08', '2023-06-04 02:58:08');

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
('9923e523-7aa2-42ad-bfa5-41670081e617', 'Gudang Singosari', 'g', 'Ds Kentangan RT 04, RW 02', 10000, 'Aman', '2023-05-11 08:41:12', '2023-05-11 08:41:12');

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
('9923e539-20a3-4689-ad81-7b0d0016d044', 'Minuman', 'minuman', '2023-05-11 08:41:26', '2023-05-11 08:41:26');

-- --------------------------------------------------------

--
-- Struktur dari tabel `konsumen`
--

CREATE TABLE `konsumen` (
  `id_konsumen` char(36) NOT NULL,
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
-- Dumping data untuk tabel `konsumen`
--

INSERT INTO `konsumen` (`id_konsumen`, `id_pengguna`, `nama`, `alamat`, `no_hp`, `email`, `username`, `password`, `foto`, `created_at`, `updated_at`) VALUES
('9978740e-2d69-4fe5-ab4d-497ee4aa895b', '99764f27-8177-4e99-b466-08f0dd0765e7', 'Azam', 'Jalan Titan III No. 24, Purwantoro, Kec. Blimbing, Malang, Jawa Timur, 65122', '085790291176', 'syahrulhidayat342@gmail.com', 'user', '202cb962ac59075b964b07152d234b70', 'WbCb7JS0iaOrG28GDDuULnhxm9GvgOzcgbakZtyA.jpg', '2023-06-22 09:30:22', '2023-06-22 09:58:17');

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
('9953b3df-7c47-4b19-9a7c-d781b995419d', 'Kampus', 'kampus itn', 'Kantin', 'Karlos', '0', '0', '2023-06-04 03:03:11', '2023-06-04 03:03:11');

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
('9953b04a-fd32-4174-b67e-1c248c24389a', 'e1f6b957-e1a0-11ed-baf9-e4e7493b7607', 'Kevin', 'Jalan Titan III No. 24, Purwantoro, Kec. Blimbing, Malang, Jawa Timur, 65122', '085790291176', 'syahrulhidayat342@gmail.com', 'kevin', 'd2e7a2105d0fb461fe6f2858cc33942f', 'TOinChVvllgOxLOmwAN0QnbeZ2HPAbjKsfH2zi4R.jpg', '2023-06-04 02:53:10', '2023-06-04 02:53:10');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pengguna`
--

CREATE TABLE `pengguna` (
  `id_pengguna` char(36) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `role` int(20) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `pengguna`
--

INSERT INTO `pengguna` (`id_pengguna`, `nama`, `role`, `created_at`, `updated_at`) VALUES
('17f951c5-10e1-11ee-b09f-e4e7493b7607', 'Kasir', 2, NULL, NULL),
('9961d498-5cbb-4654-b912-94c58f6b3b83', 'Kurir', 3, '2023-06-11 03:36:16', '2023-06-11 03:36:16'),
('99764f27-8177-4e99-b466-08f0dd0765e7', 'Konsumen', 4, '2023-06-21 07:55:31', '2023-06-21 07:55:31'),
('e1f6b957-e1a0-11ed-baf9-e4e7493b7607', 'Admin', 1, '2023-04-23 06:33:52', '2023-04-23 06:35:42');

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
('997c9206-fa7f-4aae-81b2-8d90e14953b5', '9953b211-68c9-4b20-92ee-249c525c018f', 'Kampus', 'Jalan Titan III No. 24, Purwantoro, Kec. Blimbing, Malang, Jawa Timur, 65122', 10000, 'Reguler', 'Pengiriman Barang ke Customer', '2023-06-23 17:00:00', NULL, 'Diproses', '2023-06-24 10:37:29', '2023-06-24 10:42:41'),
('997ca265-8a27-43f7-9f44-d61732bbe313', '9953b211-68c9-4b20-92ee-249c525c018f', 'Kampus', 'Jalan Titan III No. 24, Purwantoro, Kec. Blimbing, Malang, Jawa Timur, 65122', 15000, 'Instant', 'Pengiriman Barang ke Customer', '2023-06-23 17:00:00', NULL, 'Diproses', '2023-06-24 11:23:15', '2023-06-24 11:34:06');

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
('9953b234-571a-4119-8f3e-0905818b8a09', '9953b211-68c9-4b20-92ee-249c525c018f', 75, 'Pcs', '2023-06-05 00:00:00', '2023-06-04 02:58:31', '2023-06-24 11:23:15');

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

-- --------------------------------------------------------

--
-- Struktur dari tabel `transaksi`
--

CREATE TABLE `transaksi` (
  `id_transaksi` char(36) NOT NULL,
  `id_outlet` char(36) NOT NULL,
  `id_pengiriman` char(36) DEFAULT NULL,
  `id_barang` char(36) NOT NULL,
  `id_pegawai` char(36) NOT NULL,
  `id_konsumen` char(36) NOT NULL,
  `order_number` int(11) NOT NULL,
  `jumlah_barang` int(11) NOT NULL,
  `total_harga` int(11) NOT NULL,
  `metode_bayar` varchar(255) NOT NULL,
  `keterangan` varchar(255) DEFAULT NULL,
  `tgl_transaksi` timestamp NULL DEFAULT NULL,
  `status` varchar(255) NOT NULL,
  `status_code` int(11) NOT NULL DEFAULT 0,
  `bukti_bayar` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `transaksi`
--

INSERT INTO `transaksi` (`id_transaksi`, `id_outlet`, `id_pengiriman`, `id_barang`, `id_pegawai`, `id_konsumen`, `order_number`, `jumlah_barang`, `total_harga`, `metode_bayar`, `keterangan`, `tgl_transaksi`, `status`, `status_code`, `bukti_bayar`, `created_at`, `updated_at`) VALUES
('997c9206-fe9b-499d-b80b-c12f28f2e4eb', '9953b3df-7c47-4b19-9a7c-d781b995419d', '997c9206-fa7f-4aae-81b2-8d90e14953b5', '9953b211-68c9-4b20-92ee-249c525c018f', '9953b04a-fd32-4174-b67e-1c248c24389a', '9978740e-2d69-4fe5-ab4d-497ee4aa895b', 1, 5, 1500000, 'Transfer Bank', NULL, '2023-06-23 17:00:00', 'Bukti Bayar telah Diupload', 1, 'iKxbqdM1ejyDEEvbgo9Ko5FunslLbpFc43HKsitf.jpg', '2023-06-24 10:37:29', '2023-06-24 11:32:11'),
('997ca265-8ef8-46ab-bd3d-432e19f7bf20', '9953b3df-7c47-4b19-9a7c-d781b995419d', '997ca265-8a27-43f7-9f44-d61732bbe313', '9953b211-68c9-4b20-92ee-249c525c018f', '9953b04a-fd32-4174-b67e-1c248c24389a', '9978740e-2d69-4fe5-ab4d-497ee4aa895b', 6, 10, 3000000, 'Transfer Bank', NULL, '2023-06-23 17:00:00', 'Bukti Bayar Tervalidasi', 1, '2wTz1Tz1I3NAzsXLvhWgjFAlydPA6c1tzWcl7gUD.jpg', '2023-06-24 11:23:15', '2023-06-24 11:34:06');

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
-- Indeks untuk tabel `konsumen`
--
ALTER TABLE `konsumen`
  ADD PRIMARY KEY (`id_konsumen`),
  ADD KEY `id_pengguna` (`id_pengguna`);

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
  ADD PRIMARY KEY (`id_pengguna`),
  ADD UNIQUE KEY `role` (`role`);

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
  ADD UNIQUE KEY `order_number` (`order_number`),
  ADD KEY `id_outlet` (`id_outlet`),
  ADD KEY `id_pengiriman` (`id_pengiriman`),
  ADD KEY `id_barang` (`id_barang`),
  ADD KEY `id_pegawai` (`id_pegawai`),
  ADD KEY `id_konsumen` (`id_konsumen`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `pengguna`
--
ALTER TABLE `pengguna`
  MODIFY `role` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `transaksi`
--
ALTER TABLE `transaksi`
  MODIFY `order_number` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

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
-- Ketidakleluasaan untuk tabel `konsumen`
--
ALTER TABLE `konsumen`
  ADD CONSTRAINT `konsumen_ibfk_1` FOREIGN KEY (`id_pengguna`) REFERENCES `pengguna` (`id_pengguna`);

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
  ADD CONSTRAINT `transaksi_ibfk_4` FOREIGN KEY (`id_pegawai`) REFERENCES `pegawai` (`id_pegawai`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `transaksi_ibfk_5` FOREIGN KEY (`id_konsumen`) REFERENCES `konsumen` (`id_konsumen`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
