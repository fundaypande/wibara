-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jan 31, 2019 at 02:49 PM
-- Server version: 10.1.36-MariaDB
-- PHP Version: 7.0.32

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pande`
--

-- --------------------------------------------------------

--
-- Table structure for table `bahan_bakus`
--

CREATE TABLE `bahan_bakus` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `jenis_bahan` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jumlah` int(10) UNSIGNED DEFAULT NULL,
  `satuan` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `harga` decimal(12,0) UNSIGNED DEFAULT NULL,
  `asal` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `bahan_bakus`
--

INSERT INTO `bahan_bakus` (`id`, `user_id`, `jenis_bahan`, `jumlah`, `satuan`, `harga`, `asal`, `created_at`, `updated_at`) VALUES
(2, 6, 'Kawat', 12, 'Meter', '120000', 'Kubutambahan', '2018-12-27 01:54:52', '2018-12-27 01:54:52'),
(3, 3, 'Bahan Anyaman', 30, 'Ikat', '23000', 'Kubutambahan', '2019-01-09 19:08:12', '2019-01-09 19:08:12'),
(4, 3, 'Kayu Jati', 13, 'Batang', '30000', 'Kubutambahan', '2019-01-09 19:14:51', '2019-01-09 19:14:51'),
(5, 6, 'Air', 200, '12', '12333', 'Menyali', '2019-01-10 06:50:25', '2019-01-10 06:50:25'),
(6, 6, 'Tanah', 20, 'Kubik', '300000', 'Menyali', '2019-01-10 06:51:38', '2019-01-10 06:51:38');

-- --------------------------------------------------------

--
-- Table structure for table `jenis_peralatans`
--

CREATE TABLE `jenis_peralatans` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `jenis_alat` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tahun` int(10) UNSIGNED DEFAULT NULL,
  `spesifikasi` text COLLATE utf8mb4_unicode_ci,
  `kapasitas` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `jumlah` int(10) UNSIGNED DEFAULT NULL,
  `buatan` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `harga` int(10) UNSIGNED DEFAULT NULL,
  `asal` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `jenis_peralatans`
--

INSERT INTO `jenis_peralatans` (`id`, `user_id`, `jenis_alat`, `tahun`, `spesifikasi`, `kapasitas`, `jumlah`, `buatan`, `harga`, `asal`, `created_at`, `updated_at`) VALUES
(1, 6, 'Cangkul 1212', 20201, 'Nama adalah sebutan atau label yang diberikan kepada benda, manusia, tempat, produk (misalnya merek produk) dan bahkan gagasan atau konsep, yang biasanya digunakan untuk membedakan satu sama lain. Nama dapat dipakai untuk mengenali sekelompok atau hanya sebuah benda dalam konteks yang unik mapun yang diberikan.\r\n\r\nNama manusia umumnya terbagi kepada nama depan dan nama keluarga (marga), contohnya Ali Wijaya, di mana Ali adalah nama depan sedangkan Wijaya adalah marganya. Maskipun begitu, ada pula budaya-budaya yang tidak mengenal konsep tersebut. Ada pula nama panggilan yang merupakan nama khusus yang digunakan dalam bersosialisasi.', '1213', 1213, '13Indonesia13', 1200013, '1Bengkala13', NULL, '2018-12-27 01:25:06'),
(2, 6, 'Tambah', 2018, 'Pangjang sekali', '12 orang', 20, 'amerika', 400000, 'Kubutambahan', '2018-12-26 23:36:14', '2018-12-27 00:15:25'),
(5, 6, 'Kursi', 2018, 'Lebah 2 inchi', NULL, 20, 'Amerika', 20000, 'Indiaa', '2018-12-26 23:54:21', '2018-12-26 23:54:21'),
(6, 6, 'Penggiling Ayam', 2018, 'sfdwsg', '3 orang', 34, 'Amerika', 30000, 'Indiaa', '2018-12-26 23:55:17', '2018-12-26 23:55:17'),
(7, 3, 'Cangkul', 2018, 'Tinggi sepadagn', '20', 30, 'CHina', 200000, 'malaysia', '2018-12-27 00:33:41', '2018-12-27 00:33:41'),
(8, 6, 'Penggiling', 2018, 'sgsfsdf', 'swfs', 34, 'Amerika', 128013, 'adfads', '2018-12-28 16:27:05', '2018-12-28 16:27:05'),
(9, 6, 'Pulpen', 1212, 'Ayam goreng', '138', 9183, 'China', 12000, 'Menyali', '2019-01-10 06:47:34', '2019-01-10 06:47:34'),
(10, 6, 'Gelas', 2019, 'Ayam goreng', '20', 50, 'Singpura', 12000, 'Kubutambahan', '2019-01-10 06:49:55', '2019-01-10 06:49:55'),
(11, 3, 'Buku Tulis', 2015, 'Buku yang tkak tertulis', '300', 300, 'China', 12000, 'Amerika', '2019-01-18 16:16:23', '2019-01-18 16:16:23');

-- --------------------------------------------------------

--
-- Table structure for table `komoditis`
--

CREATE TABLE `komoditis` (
  `id` int(10) UNSIGNED NOT NULL,
  `nama` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `keterangan` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `komoditis`
--

INSERT INTO `komoditis` (`id`, `nama`, `keterangan`, `created_at`, `updated_at`) VALUES
(3, 'Pengerajin Aluminium', 'Keterangan maknyuss', '2019-01-18 16:47:33', '2019-01-28 14:29:57'),
(4, 'Rerata Harga Produk', 'Cost', '2019-01-18 16:47:45', '2019-01-18 16:47:45'),
(5, 'Jumlah Peralatan Yang Dimiliki', 'Cost', '2019-01-18 16:47:59', '2019-01-18 16:47:59'),
(6, 'Jumlah Pegawai', 'Cost', '2019-01-18 16:48:11', '2019-01-18 16:48:11'),
(7, 'Lama Berdirinya Usaha', 'Benefit', '2019-01-18 16:48:27', '2019-01-18 16:48:27'),
(8, 'Nilai Penjualan Pertahun', 'Cost', '2019-01-18 16:48:42', '2019-01-18 16:48:42'),
(11, 'Pengerajin Bambu', 'Kumpulan banyak pengerajin bambu', '2019-01-28 14:30:21', '2019-01-28 14:30:21');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(3, '2014_10_12_000000_create_users_table', 1),
(7, '2014_10_12_100000_create_password_resets_table', 2),
(8, '2019_01_18_155507_create_kriteriass_table', 3);

-- --------------------------------------------------------

--
-- Table structure for table `nilai_produksis`
--

CREATE TABLE `nilai_produksis` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `jenis_produksi` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jumlah` int(11) DEFAULT NULL,
  `harga` decimal(12,0) DEFAULT NULL,
  `nilai_penjualan` decimal(12,0) DEFAULT NULL,
  `tujuan` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `deskripsi` text COLLATE utf8mb4_unicode_ci,
  `photo` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `nilai_produksis`
--

INSERT INTO `nilai_produksis` (`id`, `user_id`, `jenis_produksi`, `jumlah`, `harga`, `nilai_penjualan`, `tujuan`, `deskripsi`, `photo`, `created_at`, `updated_at`) VALUES
(1, 6, 'Sabit', 372, '320002', '400002', 'Sangsit25', 'When passing information in this manner, the data should be an array with key / value pairs. Inside your view, you can then access each value using its corresponding key, such as  <?php echo $key; ?>. As an alternative to passing a complete array of data to the view helper function, you may use the with method to add individual pieces of data to the view:\r\n\r\nreturn view(\'greeting\')->with(\'name\', \'Victoria\');\r\n\r\nSharing Data With All Views\r\nOccasionally, you may need to share a piece of data with all views that are rendered by your application. You may do so using the view facade\'s share method. Typically, you should place calls to share within a service provider\'s boot method. You are free to add them to the  AppServiceProvider or generate a separate service provider to house them:', '1546042718.jpg', NULL, '2019-01-30 17:23:19'),
(2, 3, 'Parang Tritis', 23, '30000', '36000', 'Banjarmasin', 'Barang siap jual pande', '1547089734.jpg', NULL, '2019-01-09 19:09:16'),
(4, 6, 'Bokor 4', 124, '120004', '300004', 'Sangsit4', 'Banyak data disini4', '1546042401.jpg', '2018-12-27 04:19:22', '2018-12-28 16:13:21'),
(14, 6, 'Jaje Gipang', 12, '140000', '130000', 'Pasardbf', 'Makanan ini sangat enak', '1547219834.jpeg', '2018-12-28 03:00:12', '2019-01-11 07:17:14'),
(21, 6, 'Pengecasan', 12, '12000', '50000', 'Bringkit', 'Deskripsi Pengacasan', '1547220051.png', '2019-01-11 07:20:24', '2019-01-11 07:20:51'),
(22, 11, 'Ayam Broiler', 120, '12000', '12000', 'Kubutambahan', 'Ayam broiler atau yang disebut juga ayam ras pedaging (broiler) adalah jenis ras unggulan hasil persilangan dari bangsa-bangsa ayam yang memiliki daya produktivitas tinggi, terutama dalam memproduksi daging ayam[1]. Ayam broiler yang merupakan hasil perkawinan silang dan sistem berkelanjutan sehingga mutu genetiknya bisa dikatakan baik. Mutu genetik yang baik akan muncul secara maksimal apabila ayam tersebut diberi faktor lingkungan yang mendukung, misalnya pakan yang berkualitas tinggi, sistem perkandangan yang baik, serta perawatan kesehatan dan pencegahan penyakit. Ayam broiler merupakan ternak yang paling ekonomis bila dibandingkan dengan ternak lain, kelebihan yang dimiliki adalah kecepatan pertambahan/produksi daging dalam waktu yang relatif cepat dan singkat atau sekitar 4 - 5 minggu produksi daging sudah dapat dipasarkan atau dikonsumsi.', '1547277475.jpg', '2019-01-11 23:17:34', '2019-01-11 23:17:55'),
(23, 11, 'Ayam Pejantan', 100, '193', '1093', 'lK', 'Secara prinsip bidang penjualan karkas ayam jawa super atau pejantan memiliki pasar yang relatif sama namun berbeda di kelas harga nya, secara fenotip/tampilan luar sangatlah mirip dan hanya mereka yang terlatih dan terbiasa bisa membedakannya. Contoh yang paling mudah adalah di bagian kepala, yaitu jengger atau pial nya, ayam pejantan layer/pejantan ayam petelur memiliki pial yang tinggi dan bergerigi seperti gambar dibawah ini', '1547277543.jpg', '2019-01-11 23:18:49', '2019-01-11 23:19:03'),
(24, 11, 'Babi Bali', 100, '100', '100', 'Kubutambahan', 'Babi', '1547277590.jpg', '2019-01-11 23:19:20', '2019-01-11 23:19:50'),
(25, 11, 'Pupuk Kandang', 100, '100', '100', 'Kubutambahan', 'Pupuk Kandang', '1547277600.jpg', '2019-01-11 23:19:40', '2019-01-11 23:20:00'),
(26, 3, 'Dompet', 200, '13000', '12000', 'Jakarta', 'Banyak yang beli disini', NULL, '2019-01-18 16:17:51', '2019-01-18 16:17:51'),
(27, 3, 'Pipa', 100, '12000', '50000', 'Banjar', 'Banyak data', NULL, '2019-01-18 16:21:02', '2019-01-18 16:21:02'),
(28, 3, 'Headset', 2000, '10000', '100000', 'Jakarta', 'Banyak', NULL, '2019-01-18 16:24:05', '2019-01-18 16:24:05'),
(29, 3, 'Ayan', 12000, '1109', '10909', 'Banjar', 'Banyak', '1547857570.jpg', '2019-01-18 16:25:57', '2019-01-18 16:26:10'),
(30, 3, 'Bokor', 34, '30000', '30000', 'er', 'nv nb', NULL, '2019-01-18 16:26:54', '2019-01-18 16:26:54'),
(31, 3, 'Bokor', 34, '34343', '30000', 'Sangsit', 'adv', '1547857634.jpg', '2019-01-18 16:27:14', '2019-01-18 16:27:14'),
(32, 3, 'ge', 34, '30000', '30000', 'Sangsit', 'dav', NULL, '2019-01-18 16:28:08', '2019-01-18 16:28:08'),
(33, 3, 'Pengecasan', 20, '12000', '23000', 'Sangsit', 'dcadc', '1547857738.jpg', '2019-01-18 16:28:58', '2019-01-18 16:28:58'),
(34, 3, 'ge', 20, '34343', '34343', 'er', 'dvavd', NULL, '2019-01-18 16:29:09', '2019-01-18 16:29:09');

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `profilikm`
--

CREATE TABLE `profilikm` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED DEFAULT NULL,
  `nama_usaha` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `lama_berdiri` tinyint(4) DEFAULT NULL,
  `merk_produk` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `alamat` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `kecamatan` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `desa` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `telpon` varchar(15) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `jenis_produk` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `rerata_produksi` int(11) DEFAULT NULL,
  `rerata_harga` decimal(10,0) DEFAULT NULL,
  `rerata_penjualan` decimal(12,0) DEFAULT NULL,
  `tempat_pemasaran` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `total_peralatan` int(11) DEFAULT NULL,
  `total_bahan_baku` int(11) DEFAULT NULL,
  `total_pekerja` int(11) DEFAULT NULL,
  `jarak` int(11) DEFAULT NULL,
  `permasalahan` text COLLATE utf8mb4_unicode_ci,
  `jenis_bimtek` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `long` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `lang` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `profilikm`
--

INSERT INTO `profilikm` (`id`, `user_id`, `nama_usaha`, `lama_berdiri`, `merk_produk`, `alamat`, `kecamatan`, `desa`, `telpon`, `jenis_produk`, `rerata_produksi`, `rerata_harga`, `rerata_penjualan`, `tempat_pemasaran`, `total_peralatan`, `total_bahan_baku`, `total_pekerja`, `jarak`, `permasalahan`, `jenis_bimtek`, `long`, `lang`, `created_at`, `updated_at`, `status`) VALUES
(2, 6, 'Industri Besi Baja', 32, 'Sido Muncul', 'Jalan angsoka, no 2 banjar kanginan, bungkulan', NULL, NULL, '087888030597', 'Produk Material', 30, '500000', '100000000', 'Tinge-tinge', 30, 40000000, 12, 30, 'Banyak saingan Juga', 'Bimtek sosial', NULL, NULL, '2018-12-21 19:23:56', '2018-12-27 02:02:02', 1),
(4, 8, 'Semua', 5, 'Produk Ninja', 'Kubutambahan', NULL, NULL, '087888999232', 'Ayam', 2, '3', '109309132', 'Kubt', 34, 100000000, 2, 12, 'afdadf', 'faf', NULL, NULL, '2018-12-23 00:21:18', '2018-12-23 15:24:42', 0),
(5, 3, 'Industri Tekstil', 5, 'Produk Lemari Kayu', 'Jalan banyuasri', NULL, NULL, '087888222333', 'Kayu', 52, '32000', '130000000', 'Kubutambahan', 42, 100000000, 22, 20, 'Belum ada permasalahansih 2', 'Diklat', NULL, NULL, '2018-12-24 23:07:53', '2018-12-26 17:27:03', 1),
(6, NULL, 'Bayam Baru', 52, 'Sosro 22', 'Jalan angsoka, singaraja', NULL, NULL, '087888222333', 'Ayam', 52000, '32000', '130000000', 'Kubutambahan', 10, 262, 22, 20, 'Selamat datang', 'Diklat', NULL, NULL, '2018-12-24 23:10:21', '2018-12-26 17:35:52', 1),
(7, NULL, 'Dimasak 2', 52, 'Sosro 22', 'adf', NULL, NULL, '087888222333', 'Ayam', 3, '32000', '130000000', 'Kubutambahan', 42, 100000000, 22, 21, 'tes', 'Diklat', NULL, NULL, '2018-12-25 00:31:21', '2018-12-25 00:31:21', 0),
(9, NULL, 'Di Uyeg', 52, 'Sosro 22', 'Gang Durian', NULL, NULL, '087888981398', 'Ayam', 52, '500000002', '12002', 'Pasar Tingkat2', 12, 100000000, 22, 32, 'sdfgs', 'Bintek saya2', NULL, NULL, '2018-12-25 00:39:05', '2018-12-27 02:06:23', 1),
(10, NULL, 'Usaha Waskita Karya', 4, 'Jalan raya', 'Simalunggung jawa barat', NULL, NULL, '098783475628', 'Beton', 300, '30000', '23999', 'Indonesia', 300, 3000000, 12, 20, 'Tidak ada 2', 'Diklat', NULL, NULL, '2018-12-26 17:32:42', '2018-12-26 17:53:06', 1),
(11, NULL, 'Kandang ayam', 121, 'Kandang berkualitas', 'Kubutambahan', NULL, NULL, '087291298382', 'Banyak', 120000, '45000', '12000', 'Banjarmasin', 30, 30000, 30, 30, 'Banyak permasalahan', 'Tidak ada', NULL, NULL, '2018-12-28 22:49:28', '2019-01-10 00:38:26', 1),
(12, NULL, 'Kutu Air 2', 23, 'Produk Power Bank', 'sdvsdfsd', NULL, NULL, '087888222333', 'Ayam', 121, '500000002', '130000000', 'Pasar Tingkat2', 10, 1500000, 4, 12, 'sadfadf', 'asfd', NULL, NULL, '2019-01-10 00:37:37', '2019-01-10 00:38:55', 1),
(13, NULL, 'Bayam Baru', 12, 'Produk Ninja', 'sdfasdf', NULL, NULL, '087888222333', 'Ayam', 52, '500000002', '130000000', 'Pasar Tingkat2', 42, 100000000, 4, 34, 'asdfadf', 'Diklat', NULL, NULL, '2019-01-10 00:44:34', '2019-01-10 00:44:34', 1),
(14, NULL, 'adfafd', 31, 'adfaf', 'afdadsf13', NULL, NULL, '087888981398', 'sdvsqe24', 24, '24224', '24', 'sdfw24', 224, 24, 242, 24, 'sfgvsfgwr', 'sfsf4', NULL, NULL, '2019-01-10 00:57:32', '2019-01-10 00:57:32', 1),
(15, 11, 'Komang Sudana Yasa Pande', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2019-01-11 23:15:59', '2019-01-11 23:15:59', 0);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '0',
  `role` tinyint(4) NOT NULL DEFAULT '1',
  `photo` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `token`, `status`, `role`, `photo`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Komang Sudana Yasa Pande', 'funday@gmail.com', NULL, '$2y$10$/IFHvQQHcygKYcVkJt/vhOFcqw3jXJmsy7me36e98i4jJFW6em7oK', 'LSFVkrxzvxyLaHdXU03T', 0, 3, '1545906568.jpg', 'LU7stfgkZWYgztF9ediC56Urz4gl4yxToaZFWIGMRbS8MMkt8s4LPyzMHqzs', '2018-12-21 16:16:07', '2019-01-10 06:52:25'),
(2, 'Funday', 'staf@gmail.com', NULL, '$2y$10$j0tjGoKp3YpegoTWXc6NlumhOeFk7uV7AWoSVr4Hlr160ythMV7Ie', '9r5Nygb9QKIB254lEfgc', 0, 2, '1545735921.jpg', 'zwJLppLg5oHlI1yQucDXg5uO74iLKjSMyGQglKzBgvLE0mBdPomk6QkzuoX3', '2018-12-21 16:16:48', '2018-12-25 03:05:21'),
(3, 'IKM Saya', 'ikm@gmail.com', NULL, '$2y$10$8K2S4U6z04fcGiJBq1pD/etgtg8ddhiwXHtVOvyGNx57qFNb5yQ.e', '6SsRCH8KQKGakpZrGXSh', 0, 1, '1545905883.jpg', 'Gdc0t4lzHdW1ENanI0T2SG7qszhJP8qs8Lp66eFWJgBuHDKc8PD0W3PiDTRB', '2018-12-21 16:17:11', '2018-12-27 02:18:03'),
(6, 'IKM User', 'user@gmail.com', NULL, '$2y$10$0Ubptl2yyLDrv8qiEQjkRuw2SU0hRg7N9Pfpj7zu.cZFtifiDeulC', 'OJWFGY5XgWXvfrx4KX36', 0, 1, '1546040790.jpg', 'gK4uEJTrQIhVEG2ljQHfeagclrTqvQzdjDVcTi4m9P6bkxAKAN3kShXu0UY0', '2018-12-21 19:23:56', '2018-12-28 15:46:30'),
(7, 'Industri Maju Jaya', 'user2@gmail.com', NULL, '$2y$10$nbnLw6HlF4DaZy5gcdCZoeMdBAJq6pMSuaTbKyZptx1eo.QUb6FKq', 'Zw80adRseCFsSeYq47Td', 0, 1, NULL, 'Gm0IJRhCwV9edbKjR8Kk9aNs5ouz0GvQHkEEDqSghrnBbT5U6Q3KAjJjyoBm', '2018-12-21 19:24:38', '2018-12-21 19:24:38'),
(8, 'user3', 'user3@gmail.com', NULL, '$2y$10$WMGiCdWEJ0DqpsodIK/nBunLD88iIlUOZpOLWBMQSrBRNy6t5.Cly', 'grn79pftq2QgZ8OjzMrZ', 0, 1, NULL, NULL, '2018-12-23 00:21:18', '2018-12-23 00:21:18'),
(10, 'Nyoman', 'stafku@gmail.com', NULL, '$2y$10$edMjXcSLDWzoPPBJzeEhiOL6.JPSjqIjfIi8XrME3RhLIr/55cXiC', 'jRjaBkhr0QAiWrG5Kojt', 0, 2, NULL, NULL, '2018-12-26 17:58:29', '2018-12-26 17:58:29'),
(11, 'Komang Sudana Yasa Pande', 'fundaylogin@gmail.com', NULL, '$2y$10$GKRxxnlewkdcxzeGsImA5uEz3hXsWvWvGfN7FNffDkrMBYpQp/Wqe', '8vcsXGcBoCjZd9WZ3Yn1', 0, 1, '1547277394.JPG', 'ufev5GCHruuDrlCxm5n0Bpo37zGc89BPWz7wcs5GPIw9ul6HEvSEnku4UzU2', '2019-01-11 23:15:59', '2019-01-11 23:16:34');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bahan_bakus`
--
ALTER TABLE `bahan_bakus`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `jenis_peralatans`
--
ALTER TABLE `jenis_peralatans`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `komoditis`
--
ALTER TABLE `komoditis`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `nilai_produksis`
--
ALTER TABLE `nilai_produksis`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `profilikm`
--
ALTER TABLE `profilikm`
  ADD PRIMARY KEY (`id`),
  ADD KEY `profilikm_user_id_index` (`user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bahan_bakus`
--
ALTER TABLE `bahan_bakus`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `jenis_peralatans`
--
ALTER TABLE `jenis_peralatans`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `komoditis`
--
ALTER TABLE `komoditis`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `nilai_produksis`
--
ALTER TABLE `nilai_produksis`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `profilikm`
--
ALTER TABLE `profilikm`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `bahan_bakus`
--
ALTER TABLE `bahan_bakus`
  ADD CONSTRAINT `bahan_bakus_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `jenis_peralatans`
--
ALTER TABLE `jenis_peralatans`
  ADD CONSTRAINT `jenis_peralatans_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `nilai_produksis`
--
ALTER TABLE `nilai_produksis`
  ADD CONSTRAINT `nilai_produksis_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `profilikm`
--
ALTER TABLE `profilikm`
  ADD CONSTRAINT `profilikm_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
