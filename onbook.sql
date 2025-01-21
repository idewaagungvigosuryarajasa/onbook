-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 08, 2024 at 01:44 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.0.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `grabook`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id_admin` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `nama_lengkap` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id_admin`, `username`, `password`, `nama_lengkap`) VALUES
(1, 'admin1@example.com', 'admin123', 'Admin One'),
(3, 'admin2@example.com', 'admin456', 'Admin Two');

-- --------------------------------------------------------

--
-- Table structure for table `kurir`
--

CREATE TABLE `kurir` (
  `id_kurir` int(50) NOT NULL,
  `nama_kurir` varchar(100) NOT NULL,
  `tarif` int(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `kurir`
--

INSERT INTO `kurir` (`id_kurir`, `nama_kurir`, `tarif`) VALUES
(1, 'J&T REG (2 Hari Kerja)', 9000),
(2, 'JNE REG (2 Hari Kerja)', 10000),
(3, 'JNE YES (1 Hari Kerja)', 24000),
(4, 'Grab Instan (Lokasi Diluar Service)', 20000),
(5, 'Grab Same Day (Lokasi Diluar Service)', 20000),
(6, 'Rush Delivery by Grab Express (Lokasi Diluar Service)', 20000),
(7, 'GO-SEND Same Day (Lokasi Diluar Service)', 20000),
(8, 'GO-SEND Instant', 20000),
(9, 'Tiki REG (2 Hari Kerja)', 8000),
(10, 'Pos Indonesia (3-5 Hari Kerja)', 12000);

-- --------------------------------------------------------

--
-- Table structure for table `pelanggan`
--

CREATE TABLE `pelanggan` (
  `id_pelanggan` int(11) NOT NULL,
  `gmail_pelanggan` varchar(100) NOT NULL,
  `password_pelanggan` varchar(50) NOT NULL,
  `nama_pelanggan` varchar(100) NOT NULL,
  `telepon_pelanggan` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `pelanggan`
--

INSERT INTO `pelanggan` (`id_pelanggan`, `gmail_pelanggan`, `password_pelanggan`, `nama_pelanggan`, `telepon_pelanggan`) VALUES
(4, 'andi@example.com', 'password123', 'Andi', '081234567890'),
(8, 'ym@mail.com', 'ym', 'ym', '78710');

-- --------------------------------------------------------

--
-- Table structure for table `pembayaran`
--

CREATE TABLE `pembayaran` (
  `id_pembayaran` int(11) NOT NULL,
  `id_pembelian` int(11) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `bank` varchar(255) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `tanggal` date NOT NULL,
  `bukti` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `pembayaran`
--

INSERT INTO `pembayaran` (`id_pembayaran`, `id_pembelian`, `nama`, `bank`, `jumlah`, `tanggal`, `bukti`) VALUES
(6, 9, 'Andi', 'BCA', 75000, '2024-05-10', 'bukti_pembayaran_andi.jpg'),
(7, 10, 'Budi', 'BNI', 128000, '2024-05-11', 'bukti_pembayaran_budi.jpg'),
(8, 12, 'ym', 'BCA', 72000, '2024-05-20', '20240520054919Screenshot (53).png'),
(9, 13, 'ym', 'BCA', 72000, '2024-05-20', '20240520103608Screenshot (68).png');

-- --------------------------------------------------------

--
-- Table structure for table `pembelian`
--

CREATE TABLE `pembelian` (
  `id_pembelian` int(11) NOT NULL,
  `id_pelanggan` int(11) NOT NULL,
  `id_kurir` int(11) NOT NULL,
  `tanggal_pembelian` date NOT NULL,
  `total_pembelian` int(11) NOT NULL,
  `nama_kurir` varchar(100) NOT NULL,
  `tarif` int(11) NOT NULL,
  `alamat_pengiriman` text NOT NULL,
  `status_pembelian` varchar(100) NOT NULL DEFAULT 'Tertunda',
  `resi_pengiriman` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `pembelian`
--

INSERT INTO `pembelian` (`id_pembelian`, `id_pelanggan`, `id_kurir`, `tanggal_pembelian`, `total_pembelian`, `nama_kurir`, `tarif`, `alamat_pengiriman`, `status_pembelian`, `resi_pengiriman`) VALUES
(9, 4, 9, '2024-05-10', 85000, 'Tiki REG (2 Hari Kerja)', 8000, 'Jakarta', 'Lunas (Barang Terkirim)', '71616'),
(12, 8, 3, '2024-05-20', 72000, 'JNE YES (1 Hari Kerja)', 24000, 'haljdald', 'Lunas (Barang Terkirim)', '8008'),
(13, 4, 1, '2024-05-20', 105000, 'J&T REG (2 Hari Kerja)', 9000, 'GGS', 'Batal (Jumlah Duit Tidak Sesuai)', ''),
(14, 8, 2, '2024-06-08', 85000, 'JNE REG (2 Hari Kerja)', 10000, 'zzz', 'Tertunda', '');

-- --------------------------------------------------------

--
-- Table structure for table `pembelian_produk`
--

CREATE TABLE `pembelian_produk` (
  `id_pembelian_produk` int(11) NOT NULL,
  `id_pembelian` int(11) NOT NULL,
  `id_produk` int(11) NOT NULL,
  `jumlah_pembelian` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `pembelian_produk`
--

INSERT INTO `pembelian_produk` (`id_pembelian_produk`, `id_pembelian`, `id_produk`, `jumlah_pembelian`) VALUES
(13, 9, 3, 1),
(14, 10, 4, 2),
(15, 11, 4, 4),
(16, 12, 3, 1),
(17, 13, 3, 2),
(18, 14, 2, 1);

-- --------------------------------------------------------

--
-- Table structure for table `produk`
--

CREATE TABLE `produk` (
  `id_produk` int(11) NOT NULL,
  `nama_produk` varchar(100) NOT NULL,
  `harga_produk` int(11) NOT NULL,
  `berat_produk` int(11) NOT NULL,
  `foto_produk` varchar(100) NOT NULL,
  `deskripsi_produk` text NOT NULL,
  `resep_produk` varchar(100) NOT NULL,
  `stok_produk` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `produk`
--

INSERT INTO `produk` (`id_produk`, `nama_produk`, `harga_produk`, `berat_produk`, `foto_produk`, `deskripsi_produk`, `resep_produk`, `stok_produk`) VALUES
(1, 'The Great Gatsby', 55000, 180, 'tb1.png', ' Novel klasik karya F. Scott Fitzgerald yang menggambarkan kehidupan mewah dan penuh intrik di era Roaring Twenties di Amerika Serikat. bagus', 'tb1alt.png', 7),
(2, 'Sapiens', 75000, 220, 'tb2.png', 'Buku non-fiksi karya Yuval Noah Harari yang merangkum sejarah manusia dari zaman purba hingga masa modern, membahas evolusi, peradaban, dan revolusi kognitif.', 'tb2alt.png', 7),
(3, 'Pride and Prejudice', 48000, 170, 'tb3.png', 'Novel klasik karya Jane Austen yang mengisahkan kisah percintaan antara Elizabeth Bennet dan Mr. Darcy di tengah-tengah norma-norma sosial pada era Regency di Inggris.', 'tb3alt.png', 3),
(4, 'Project Hail Mary', 85000, 280, 'tb4.png', 'Novel fiksi ilmiah karya Andy Weir tentang seorang astronot yang terbangun dari hibernasi di tengah perjalanan ruang angkasa dan harus menyelamatkan umat manusia dari kepunahan.', 'tb4alt.png', 0),
(5, 'The Final Girl Support Group', 62000, 190, 'tb5.png', 'Novel thriller psikologis karya Grady Hendrix tentang sekelompok wanita yang selamat dari serangkaian pembunuhan dan tergabung dalam kelompok pendukung untuk mengatasi trauma mereka.', 'tb5alt.png', 6),
(6, 'Klara and the Sun', 69000, 200, 'tb6.png', 'Novel fiksi spekulatif karya Kazuo Ishiguro tentang seorang robot kecerdasan buatan yang melayani sebagai teman bagi seorang gadis remaja yang sakit.', 'tb6alt.png', 5),
(7, 'The Paper Palace', 78000, 240, 'tb7.png', 'Novel drama keluarga karya Miranda Cowley Heller yang mengisahkan kisah cinta terlarang yang berlangsung selama bertahun-tahun di Cape Cod, Massachusetts.', 'tb7alt.png', 3),
(8, 'Doraemon: Stand By Me', 70000, 120, 'tb8.png', 'Bercerita tentang persahabatan yang terjalin di antara Nobita, Doraemon, dan teman-temannya. Mereka berusaha untuk melawan semua rintangan demi menyelamatkan diri mereka dari ancaman masa depan.', 'tb9alt.png', 3),
(9, 'Sherlock Holmes: A Study in Scarlet', 55000, 200, 'tb9.png', 'Buku pertama dari serial Sherlock Holmes. Bercerita tentang bagaimana Sherlock Holmes dan Dr. John Watson pertama kali bertemu dan bekerja sama untuk memecahkan kasus pembunuhan yang penuh misteri.', 'tb9alt.png', 5),
(10, 'The Lord of the Rings', 90000, 250, 'tb10.png', 'Awal dari trilogi epik fantasi karya J.R.R. Tolkien yang mengikuti petualangan Frodo Baggins dan kawan-kawan untuk menghancurkan Cincin Kekuasaan yang jahat.', 'tb10alt.png', 3);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id_admin`);

--
-- Indexes for table `kurir`
--
ALTER TABLE `kurir`
  ADD PRIMARY KEY (`id_kurir`);

--
-- Indexes for table `pelanggan`
--
ALTER TABLE `pelanggan`
  ADD PRIMARY KEY (`id_pelanggan`);

--
-- Indexes for table `pembayaran`
--
ALTER TABLE `pembayaran`
  ADD PRIMARY KEY (`id_pembayaran`);

--
-- Indexes for table `pembelian`
--
ALTER TABLE `pembelian`
  ADD PRIMARY KEY (`id_pembelian`);

--
-- Indexes for table `pembelian_produk`
--
ALTER TABLE `pembelian_produk`
  ADD PRIMARY KEY (`id_pembelian_produk`);

--
-- Indexes for table `produk`
--
ALTER TABLE `produk`
  ADD PRIMARY KEY (`id_produk`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id_admin` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `kurir`
--
ALTER TABLE `kurir`
  MODIFY `id_kurir` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `pelanggan`
--
ALTER TABLE `pelanggan`
  MODIFY `id_pelanggan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `pembayaran`
--
ALTER TABLE `pembayaran`
  MODIFY `id_pembayaran` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `pembelian`
--
ALTER TABLE `pembelian`
  MODIFY `id_pembelian` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `pembelian_produk`
--
ALTER TABLE `pembelian_produk`
  MODIFY `id_pembelian_produk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `produk`
--
ALTER TABLE `produk`
  MODIFY `id_produk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
