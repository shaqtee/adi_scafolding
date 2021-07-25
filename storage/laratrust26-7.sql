-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jul 25, 2021 at 09:33 PM
-- Server version: 10.5.10-MariaDB-log
-- PHP Version: 7.4.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `laratrust`
--

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `files`
--

CREATE TABLE `files` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `fileable_id` bigint(20) UNSIGNED NOT NULL,
  `fileable_type` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `files`
--

INSERT INTO `files` (`id`, `name`, `fileable_id`, `fileable_type`, `created_at`, `updated_at`) VALUES
(1, 'public/image.jpg', 20, 'App\\Models\\Product', '2021-07-25 05:15:07', '2021-07-25 05:15:07');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(9, '2021_07_07_072443_laratrust_setup_tables', 2),
(10, '2021_07_13_222226_create_products_table', 3),
(11, '2021_07_25_113824_create_taggables_table', 4),
(12, '2021_07_25_115605_create_tags_table', 5),
(14, '2021_07_25_120447_create_files_table', 6);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `display_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `name`, `display_name`, `description`, `created_at`, `updated_at`) VALUES
(1, 'users-create', 'Create Users', 'Create Users', '2021-07-11 03:51:47', '2021-07-11 03:51:47'),
(2, 'users-read', 'Read Users', 'Read Users', '2021-07-11 03:51:47', '2021-07-11 03:51:47'),
(3, 'users-update', 'Update Users', 'Update Users', '2021-07-11 03:51:47', '2021-07-11 03:51:47'),
(4, 'users-delete', 'Delete Users', 'Delete Users', '2021-07-11 03:51:47', '2021-07-11 03:51:47'),
(5, 'payments-create', 'Create Payments', 'Create Payments', '2021-07-11 03:51:47', '2021-07-11 03:51:47'),
(6, 'payments-read', 'Read Payments', 'Read Payments', '2021-07-11 03:51:47', '2021-07-11 03:51:47'),
(7, 'payments-update', 'Update Payments', 'Update Payments', '2021-07-11 03:51:47', '2021-07-11 03:51:47'),
(8, 'payments-delete', 'Delete Payments', 'Delete Payments', '2021-07-11 03:51:47', '2021-07-11 03:51:47'),
(9, 'profile-read', 'Read Profile', 'Read Profile', '2021-07-11 03:51:47', '2021-07-11 03:51:47'),
(10, 'profile-update', 'Update Profile', 'Update Profile', '2021-07-11 03:51:47', '2021-07-11 03:51:47'),
(11, 'module_1_name-create', 'Create Module_1_name', 'Create Module_1_name', '2021-07-11 03:51:48', '2021-07-11 03:51:48'),
(12, 'module_1_name-read', 'Read Module_1_name', 'Read Module_1_name', '2021-07-11 03:51:48', '2021-07-11 03:51:48'),
(13, 'module_1_name-update', 'Update Module_1_name', 'Update Module_1_name', '2021-07-11 03:51:48', '2021-07-11 03:51:48'),
(14, 'module_1_name-delete', 'Delete Module_1_name', 'Delete Module_1_name', '2021-07-11 03:51:48', '2021-07-11 03:51:48');

-- --------------------------------------------------------

--
-- Table structure for table `permission_role`
--

CREATE TABLE `permission_role` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `permission_role`
--

INSERT INTO `permission_role` (`permission_id`, `role_id`) VALUES
(1, 1),
(1, 2),
(2, 1),
(2, 2),
(3, 1),
(3, 2),
(4, 1),
(4, 2),
(5, 1),
(6, 1),
(7, 1),
(8, 1),
(9, 1),
(9, 2),
(9, 3),
(10, 1),
(10, 2),
(10, 3),
(11, 4),
(12, 4),
(13, 4),
(14, 4);

-- --------------------------------------------------------

--
-- Table structure for table `permission_user`
--

CREATE TABLE `permission_user` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `user_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `permission_user`
--

INSERT INTO `permission_user` (`permission_id`, `user_id`, `user_type`) VALUES
(1, 12, 'App\\Models\\User'),
(2, 12, 'App\\Models\\User'),
(3, 12, 'App\\Models\\User'),
(4, 12, 'App\\Models\\User'),
(5, 12, 'App\\Models\\User'),
(6, 12, 'App\\Models\\User'),
(7, 12, 'App\\Models\\User'),
(8, 12, 'App\\Models\\User'),
(9, 12, 'App\\Models\\User'),
(10, 12, 'App\\Models\\User'),
(2, 13, 'App\\Models\\User'),
(9, 13, 'App\\Models\\User'),
(10, 13, 'App\\Models\\User');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama_produk` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `harga` bigint(20) UNSIGNED NOT NULL,
  `deskripsi` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `kategori` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `foto` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `nama_produk`, `harga`, `deskripsi`, `kategori`, `foto`, `created_at`, `updated_at`) VALUES
(20, 'Pot Bunga', 120000, 'Modern Style from Yojuma', 'Barang Bekas', 'https://source.unsplash.com/aMMbyCb8fSo/600x600', NULL, NULL),
(21, 'Furniture Set', 650000, 'Modern Style from Hannah Busing', 'Barang Bekas', 'https://source.unsplash.com/nME9TubZtSo/600x600', NULL, NULL),
(22, 'Tas Cantik', 1250000, 'Modern Style from Mohammad Metri', 'Barang Bekas', 'https://source.unsplash.com/gw97geWhUPI/600x600', NULL, NULL),
(23, 'Mesin Kopi Praktis', 750000, 'Modern Style from Joshua Davis', 'Barang Bekas', 'https://source.unsplash.com/auuDZ0hglhM/600x600', NULL, NULL),
(24, 'Sepeda Jadul', 930000, 'Modern Style from Laura Petrilli', 'Barang Bekas', 'https://source.unsplash.com/tEFc4IUBGKA/600x600', NULL, NULL),
(25, 'Tupperware Handmate', 5000, 'Modern Style from Chris King', 'Barang Bekas', 'https://source.unsplash.com/JZw4AVP58d0/600x600', NULL, NULL),
(26, 'Mesin Ketik Jadul', 194000, 'Modern Style from Rishi Laishram', 'Barang Bekas', 'https://source.unsplash.com/orW_8JcNk4M/600x600', NULL, NULL),
(27, 'Kursi Meja Cantik', 145000, 'Modern Style from Inside Weather', 'Barang Bekas', 'https://source.unsplash.com/90ApxSJTTdg/600x600', NULL, NULL),
(28, 'Kacamata Bunder', 475900, 'Modern Style from Charles Deluvio', 'Barang Bekas', 'https://source.unsplash.com/1-nx1QR5dTE/600x600', NULL, NULL),
(29, 'Sepatu Unik', 60000, 'Modern Style from Alexandra Gorn', 'Barang Bekas', 'https://source.unsplash.com/CJ6SJO_yR5w/600x600', NULL, NULL),
(30, 'Packaging Susu', 10000, 'Plant-Based. Build a better planet.', 'Bahan Kue', 'https://source.unsplash.com/7mr6Yx-8WLc/600x600', NULL, NULL),
(31, 'Marmit Peanut Butter', 27000, 'Photos by Brett Jordan', 'Bahan Kue', 'https://source.unsplash.com/vbiFp8ro1Vw/600x600', NULL, NULL),
(32, 'Spageti', 30000, 'Photos by Deva Darshan', 'Bahan Kue', 'https://source.unsplash.com/F0ot6ma5Fdo/600x600', NULL, NULL),
(33, 'Tepung Tapioka', 25000, 'Photos by David Fedulov', 'Bahan Kue', 'https://source.unsplash.com/x6oBAbzzXo4/600x600', NULL, NULL),
(34, 'Coklat Import', 24000, 'Photos by Scarlet Alt', 'Bahan Kue', 'https://source.unsplash.com/I1CkORYYz6s/600x600', NULL, NULL),
(35, 'Permen Hias', 29500, 'Photos by Amit Lahav', 'Bahan Kue', 'https://source.unsplash.com/3oDQKoKPMng/600x600', NULL, NULL),
(36, 'Vegan Bechamel Sauce', 32750, 'Import from Canada', 'Bahan Kue', 'https://source.unsplash.com/DIcCGj91qOg/600x600', NULL, NULL),
(37, 'Cakers Photomate', 65000, 'That\'s Her Business', 'Bahan Kue', 'https://source.unsplash.com/7RWjlGWQ7S8/600x600', NULL, NULL),
(38, 'Set Hampers Packaging', 120000, 'Photos by Nguyen Linh', 'Bahan Kue', 'https://source.unsplash.com/rwatU6FCGRU/600x600', NULL, NULL),
(39, 'Kemasan Kertas', 2000, 'Photos by Yu Hosoi', 'Bahan Kue', 'https://source.unsplash.com/ViR3a0rx18w/600x600', NULL, NULL),
(40, 'Editing Video', 1000000, 'Photos by Emmanuel', 'Produk Digital', 'https://source.unsplash.com/UVlmNi4CaBQ/600x600', NULL, NULL),
(41, 'Mobile App Webview', 20000000, 'Photos by Rahul Chakraborty', 'Produk Digital', 'https://source.unsplash.com/xsGxhtAsfSA/600x600', NULL, NULL),
(42, 'Logo Design', 300000, 'Photos by Dylan Calluy', 'Produk Digital', 'https://source.unsplash.com/sZ9Glt1wmgU/600x600', NULL, NULL),
(43, 'T-Shirt Sablon Custom', 135000, 'Photos by Geofroy Danest', 'Produk Digital', 'https://source.unsplash.com/uhKVcZNBv80/600x600', NULL, NULL),
(44, 'Editing by Request', 500000, 'Abdulbadi Present', 'Produk Digital', 'https://source.unsplash.com/KukKYcxGOwU/600x600', NULL, NULL),
(45, 'Sesi Foto', 1250000, 'Photos by Dylann Ferreira', 'Produk Digital', 'https://source.unsplash.com/aM-reLiIabA/600x600', NULL, NULL),
(46, 'Audio Editing', 1250000, 'Photos by Axel Mencia', 'Produk Digital', 'https://source.unsplash.com/5SoYbzKhqfA/600x600', NULL, NULL),
(47, 'Social Media Maintain', 4000000, 'Photos by Deny Simanjuntak', 'Produk Digital', 'https://source.unsplash.com/pYoj2nyokOg/600x600', NULL, NULL),
(48, 'Foto Produk', 1250000, 'Photos by Laura Chouette', 'Produk Digital', 'https://source.unsplash.com/0uO0m798HmU/600x600', NULL, NULL),
(49, 'Instagram Maintain', 1250000, 'Photos by Charles Deluvio', 'Produk Digital', 'https://source.unsplash.com/FdDkfYFHqe4/600x600', NULL, NULL),
(50, 'Jeans Grosir', 68000, 'Photos by Maudefl', 'Fashion', 'https://source.unsplash.com/EDSTj4kCUcw/600x600', NULL, NULL),
(51, 'Detective Style Set', 2100000, 'Photos by Benjamin Rascoe', 'Fashion', 'https://source.unsplash.com/ItqFmSxKnIg/600x600', NULL, NULL),
(52, 'Chanel Parfum', 235000, 'Photos by Laura Chouette', 'Fashion', 'https://source.unsplash.com/MrYhyccrNO0/600x600', NULL, NULL),
(53, 'Jam Tangan', 175000, 'Photos by Krismawan Kadek', 'Fashion', 'https://source.unsplash.com/9VYig9LmUmE/600x600', NULL, NULL),
(54, 'Sepatu Kantoran', 275000, 'Photos by Iman Ameli', 'Fashion', 'https://source.unsplash.com/jng0VFa-jRw/600x600', NULL, NULL),
(55, 'Topi Piknik', 99000, 'Photos by Hans Jurgen', 'Fashion', 'https://source.unsplash.com/Yz4jCyp9JiM/600x600', NULL, NULL),
(56, 'Red Sweater', 125000, 'Photos by Alireza Kazemi', 'Fashion', 'https://source.unsplash.com/80krFvBowBg/600x600', NULL, NULL),
(57, 'Black Sweater', 125000, 'Photos by Alireza Esmaeeli', 'Fashion', 'https://source.unsplash.com/BGSZ1t80rpM/600x600', NULL, NULL),
(58, 'Blue Sweater', 1250000, 'Photos by Danny Protas', 'Fashion', 'https://source.unsplash.com/EJoQus959qo/600x600', NULL, NULL),
(59, 'Sepatu Lucu', 1250000, 'Photos by Mahabis Footwear', 'Fashion', 'https://source.unsplash.com/DyUDs65NmBk/600x600', NULL, NULL),
(60, 'Hand Sanitizer', 35000, 'Photos by Austin Piwinski', 'Kesehatan', 'https://source.unsplash.com/9jUoQWGoOXw/600x600', NULL, NULL),
(61, 'Nora Tropical', 210000, 'Nora Brands', 'Kesehatan', 'https://source.unsplash.com/IbfC88l5u8c/600x600', NULL, NULL),
(62, 'Omega3', 195000, 'Photos by Andreas M', 'Kesehatan', 'https://source.unsplash.com/AizSoIlfKRc/600x600', NULL, NULL),
(63, 'Masker Gas', 111000, 'Photos by Obi Onyeador', 'Kesehatan', 'https://source.unsplash.com/zYq4ShRBnHs/600x600', NULL, NULL),
(64, 'Jamu', 165000, 'Photos by Mehrshad', 'Kesehatan', 'https://source.unsplash.com/P7MkoYvSnLI/600x600', NULL, NULL),
(65, 'Masker Medis', 20000, 'Photos by Bud Nug', 'Kesehatan', 'https://source.unsplash.com/6IF101xBjI0/600x600', NULL, NULL),
(66, 'Masker Batik', 15000, 'Photos by Visual', 'Kesehatan', 'https://source.unsplash.com/aWBzaYPcPDA/600x600', NULL, NULL),
(67, 'Pink Stethoscope', 35000, 'Photos by Christopel Boswell', 'Kesehatan', 'https://source.unsplash.com/GEzNsJarkGU/600x600', NULL, NULL),
(68, 'Obat Batuk', 70000, 'Photos by Biolabs', 'Kesehatan', 'https://source.unsplash.com/PcHu6W2sKpg/600x600', NULL, NULL),
(69, 'Sabun Cair', 27000, 'Photos by Jonathan Cooper', 'Kesehatan', 'https://source.unsplash.com/mQ-RCaADQxs/600x600', NULL, NULL),
(70, 'Mandee Rice 5kg', 245000, 'Photos by Wahaj Sufian', 'Sembako', 'https://source.unsplash.com/ocd_xKscv1I/600x600', NULL, NULL),
(71, 'Kacang Arab', 175000, 'Mockup Graphics', 'Sembako', 'https://source.unsplash.com/v_a3DWpOFc0/600x600', NULL, NULL),
(72, 'Gula', 50000, 'Photos by Lena Myzovets', 'Sembako', 'https://source.unsplash.com/SY_J8ud1pNo/600x600', NULL, NULL),
(73, 'Telur', 70000, 'Photos by Fabizio', 'Sembako', 'https://source.unsplash.com/8-V0kdrwNs4/600x600', NULL, NULL),
(74, 'Jagung', 64000, 'Photos by Inticate Explorer', 'Sembako', 'https://source.unsplash.com/j-GJ1Vqc1SI/600x600', NULL, NULL),
(75, 'Garam', 50000, 'Photos by Curioso', 'Sembako', 'https://source.unsplash.com/lnbR0E65Yn4/600x600', NULL, NULL),
(76, 'Daging Sapi', 89500, 'Photos by John Cameron', 'Sembako', 'https://source.unsplash.com/6-5Ul3I6vSE/600x600', NULL, NULL),
(77, 'Daging Ayam', 35000, 'Photos by Huynt Quyet', 'Sembako', 'https://source.unsplash.com/YgirePmHPZU/600x600', NULL, NULL),
(78, 'Susu', 35000, 'Photos by Autum Hassett', 'Sembako', 'https://source.unsplash.com/nOctn3PEC0E/600x600', NULL, NULL),
(79, 'Cooking Oil', 70000, 'Photos by Lottie Griffiths', 'Sembako', 'https://source.unsplash.com/fzPHKbIt1IE/600x600', NULL, NULL),
(80, 'Kentang Goreng', 5000, 'Photos by Fernando', 'Snack', 'https://source.unsplash.com/R3f2emOt1bU/600x600', NULL, NULL),
(81, 'Love Corn', 6000, 'Photos by Tyler Nix', 'Snack', 'https://source.unsplash.com/TF8Inmn3Dtw/600x600', NULL, NULL),
(82, 'Zigzag Irvins', 7000, 'Photos by Tony Pham', 'Snack', 'https://source.unsplash.com/4zetMBTnoT4/600x600', NULL, NULL),
(83, 'Pulsitos', 4500, 'Pulsitos Brands', 'Snack', 'https://source.unsplash.com/uToWEwMctE8/600x600', NULL, NULL),
(84, 'Muddy Bites', 6500, 'Photos by Tyler Nix', 'Snack', 'https://source.unsplash.com/KLvJr6leOFg/600x600', NULL, NULL),
(85, 'Hampers Lebaran', 50000, 'Photos by Tanaphong Toochinda', 'Snack', 'https://source.unsplash.com/_f8S_o9xQK8/600x600', NULL, NULL),
(86, 'Kacang Mente', 325000, 'Mockup Graphics', 'Snack', 'https://source.unsplash.com/y6PeMgIa2Xo/600x600', NULL, NULL),
(87, 'Popcorn', 10000, 'Photos by Sumeet B', 'Snack', 'https://source.unsplash.com/M5DRKOFiv-o/600x600', NULL, NULL),
(88, 'Coklat Gula-Gula', 6500, 'American Heritage Chocolate', 'Snack', 'https://source.unsplash.com/uHHC3xS9u3o/600x600', NULL, NULL),
(89, 'Sushi Set', 98000, 'Photos by Farhad Ibrahimzade', 'Snack', 'https://source.unsplash.com/lKk2xzM0YFU/600x600', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `display_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `display_name`, `description`, `created_at`, `updated_at`) VALUES
(1, 'superadministrator', 'Superadministrator', 'Superadministrator', '2021-07-11 03:51:47', '2021-07-11 03:51:47'),
(2, 'administrator', 'Administrator', 'Administrator', '2021-07-11 03:51:48', '2021-07-11 03:51:48'),
(3, 'user', 'User', 'User', '2021-07-11 03:51:48', '2021-07-11 03:51:48'),
(4, 'role_name', 'Role Name', 'Role Name', '2021-07-11 03:51:48', '2021-07-11 03:51:48');

-- --------------------------------------------------------

--
-- Table structure for table `role_user`
--

CREATE TABLE `role_user` (
  `role_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `user_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'App\\Models\\User'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `role_user`
--

INSERT INTO `role_user` (`role_id`, `user_id`, `user_type`) VALUES
(2, 12, 'App\\Models\\User'),
(3, 12, 'App\\Models\\User'),
(3, 13, 'App\\Models\\User');

-- --------------------------------------------------------

--
-- Table structure for table `taggables`
--

CREATE TABLE `taggables` (
  `tag_id` bigint(20) UNSIGNED NOT NULL,
  `taggable_id` bigint(20) UNSIGNED NOT NULL,
  `taggable_type` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `taggables`
--

INSERT INTO `taggables` (`tag_id`, `taggable_id`, `taggable_type`, `created_at`, `updated_at`) VALUES
(1, 20, 'App\\Models\\Product', NULL, NULL),
(1, 21, 'App\\Models\\Product', NULL, NULL),
(6, 59, 'App\\Models\\Product', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tags`
--

CREATE TABLE `tags` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `label` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tags`
--

INSERT INTO `tags` (`id`, `name`, `label`, `created_at`, `updated_at`) VALUES
(1, 'Furniture', NULL, '2021-07-25 05:01:28', '2021-07-25 05:01:28'),
(2, 'Tas', NULL, NULL, NULL),
(3, 'Peralatan', NULL, NULL, NULL),
(4, 'Aksesoris', NULL, NULL, NULL),
(5, 'Sweater', NULL, NULL, NULL),
(6, 'Sepatu', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Superadministrator', 'superadministrator@app.com', NULL, '$2y$10$0pOgXBcOO2Aiak3Y9Z3pdeD70jxbVcwigTylhUtmLgI0P33gy6qra', NULL, '2021-07-07 13:20:22', '2021-07-07 13:20:22'),
(2, 'Franz Bergnaum', 'nasir47@example.com', '2021-07-07 14:07:22', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'g7yg9j64G4', '2021-07-07 14:07:22', '2021-07-07 14:07:22'),
(3, 'Dr. Tyree Koss PhD', 'tianna.west@example.org', '2021-07-07 14:07:22', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'oKMPvsKPWb', '2021-07-07 14:07:22', '2021-07-07 14:07:22'),
(4, 'Reva Parker', 'dooley.susie@example.org', '2021-07-07 14:07:22', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'Gtnwciwz6r', '2021-07-07 14:07:22', '2021-07-07 14:07:22'),
(5, 'Breana Bartell I', 'linnea63@example.net', '2021-07-07 14:07:22', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'k2hmnlgOUz', '2021-07-07 14:07:22', '2021-07-07 14:07:22'),
(6, 'Hailie Swift', 'omckenzie@example.org', '2021-07-07 14:07:22', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'ahCXy5CbvX', '2021-07-07 14:07:22', '2021-07-07 14:07:22'),
(7, 'Prof. Hester O\'Connell', 'jennifer56@example.com', '2021-07-07 14:14:55', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '13GVoiWbEb', '2021-07-07 14:14:55', '2021-07-07 14:14:55'),
(8, 'Prof. Maxine Kshlerin', 'kody81@example.com', '2021-07-07 14:14:55', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'DSskn8e1bA', '2021-07-07 14:14:55', '2021-07-07 14:14:55'),
(9, 'Mrs. Matilda Hackett', 'ukreiger@example.net', '2021-07-07 14:14:55', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'PsFoKTMqMt', '2021-07-07 14:14:55', '2021-07-07 14:14:55'),
(10, 'Marian Batz', 'shany.leannon@example.com', '2021-07-07 14:14:55', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'KtqyJvDr7V', '2021-07-07 14:14:55', '2021-07-07 14:14:55'),
(11, 'Brown Gutmann MD', 'kaitlyn.heidenreich@example.com', '2021-07-07 14:14:55', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'AVtsqE04Kh', '2021-07-07 14:14:55', '2021-07-07 14:14:55'),
(12, 'abdulbadi', 'adi.sakti@live.com', NULL, '$2y$10$J4hIOhd.bic8sEyc04hla.KSsx/Wqa.VA1ZAJ/EFEMDZuYUKu.wjS', NULL, '2021-07-07 14:16:45', '2021-07-07 14:16:45'),
(13, 'shaqtee', 'shaqtee@gmail.com', NULL, '$2y$10$MmElZCLCigvMSPvAQh5e7uyXGzDpBoDRJErxZhphnBTKPTdXPjuzm', NULL, '2021-07-07 14:17:55', '2021-07-07 14:17:55');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `files`
--
ALTER TABLE `files`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `permissions_name_unique` (`name`);

--
-- Indexes for table `permission_role`
--
ALTER TABLE `permission_role`
  ADD PRIMARY KEY (`permission_id`,`role_id`),
  ADD KEY `permission_role_role_id_foreign` (`role_id`);

--
-- Indexes for table `permission_user`
--
ALTER TABLE `permission_user`
  ADD PRIMARY KEY (`user_id`,`permission_id`,`user_type`),
  ADD KEY `permission_user_permission_id_foreign` (`permission_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `roles_name_unique` (`name`);

--
-- Indexes for table `role_user`
--
ALTER TABLE `role_user`
  ADD PRIMARY KEY (`user_id`,`role_id`,`user_type`),
  ADD KEY `role_user_role_id_foreign` (`role_id`);

--
-- Indexes for table `tags`
--
ALTER TABLE `tags`
  ADD PRIMARY KEY (`id`);

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
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `files`
--
ALTER TABLE `files`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=90;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tags`
--
ALTER TABLE `tags`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `permission_role`
--
ALTER TABLE `permission_role`
  ADD CONSTRAINT `permission_role_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `permission_role_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `permission_user`
--
ALTER TABLE `permission_user`
  ADD CONSTRAINT `permission_user_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `role_user`
--
ALTER TABLE `role_user`
  ADD CONSTRAINT `role_user_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
