-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 03, 2025 at 06:54 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.1.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `storage`
--

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `contact_number` varchar(255) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`id`, `name`, `contact_number`, `address`, `created_at`, `updated_at`) VALUES
(1, 'Asep Ramlan', '22222222222222', 'Bandung Tiriss', '2025-05-08 13:57:58', '2025-05-08 14:42:36'),
(8, 'Jaya jaya', '0888888888', 'aaaaaaaa', '2025-05-12 10:32:14', '2025-05-12 10:32:14'),
(9, 'afasfasfasfasd', '123124214125421', 'asasdasdassd', '2025-05-12 10:32:22', '2025-05-12 10:32:22');

-- --------------------------------------------------------

--
-- Table structure for table `invoices`
--

CREATE TABLE `invoices` (
  `id` int(11) NOT NULL,
  `id_invoice` varchar(255) DEFAULT NULL,
  `customer_id` varchar(255) DEFAULT NULL,
  `start_date` date DEFAULT NULL,
  `end_date` date DEFAULT NULL,
  `description` text DEFAULT NULL,
  `status` enum('Pending','Approved','Rejected') NOT NULL DEFAULT 'Pending',
  `approve_at` datetime DEFAULT NULL,
  `note` text DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `invoices`
--

INSERT INTO `invoices` (`id`, `id_invoice`, `customer_id`, `start_date`, `end_date`, `description`, `status`, `approve_at`, `note`, `created_at`, `updated_at`) VALUES
(4, 'INV-20250513-01', '1', '2025-05-15', '2025-05-29', 'asdadasasd', 'Approved', NULL, NULL, '2025-05-13 00:44:57', '2025-06-30 14:05:55'),
(5, 'INV-20250513-02', '9', '2025-05-14', '2025-05-30', 'ASSSSSSSSS', 'Pending', NULL, NULL, '2025-05-13 00:58:55', '2025-05-13 00:58:55'),
(12, 'INV-20250513-03', '1', '2025-05-14', '2025-05-15', 'aaaadssadasdsa', 'Approved', NULL, NULL, '2025-05-13 02:42:14', '2025-05-13 02:42:14'),
(13, 'INV-20250513-04', '8', '2025-05-14', '2025-06-07', 'PROYEK PERBAIKI JALAN PASOPATI', 'Approved', NULL, NULL, '2025-05-13 02:54:41', '2025-05-13 02:54:41'),
(14, 'INV-20250513-05', '1', '2025-05-17', '2025-05-31', 'PROYEK AIR JAWA TIMUR', 'Pending', NULL, NULL, '2025-05-13 12:13:23', '2025-05-13 12:13:23'),
(15, 'INV-20250627-01', '1', '2025-06-27', '2025-07-01', 'Buat Jembatan', 'Approved', '2025-07-03 16:07:14', NULL, '2025-06-27 06:32:00', '2025-07-03 16:07:14');

-- --------------------------------------------------------

--
-- Table structure for table `invoice_detail`
--

CREATE TABLE `invoice_detail` (
  `id` int(11) NOT NULL,
  `id_invoice` varchar(255) DEFAULT NULL,
  `item_id` int(11) DEFAULT NULL,
  `rental_days` int(11) DEFAULT NULL,
  `sub_total` decimal(12,2) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `invoice_detail`
--

INSERT INTO `invoice_detail` (`id`, `id_invoice`, `item_id`, `rental_days`, `sub_total`, `created_at`, `updated_at`) VALUES
(3, 'INV-20250513-03', 1, 7, 7000000.00, '2025-05-13 02:42:14', '2025-05-13 02:42:14'),
(4, 'INV-20250513-04', 10, 25, 12500000.00, '2025-05-13 02:54:41', '2025-05-13 02:54:41'),
(5, 'INV-20250513-04', 11, 20, 12000000.00, '2025-05-13 02:54:41', '2025-05-13 02:54:41'),
(6, 'INV-20250513-05', 12, 30, 30000000.00, '2025-05-13 12:13:23', '2025-05-13 12:13:23'),
(7, 'INV-20250513-05', 13, 30, 16500000.00, '2025-05-13 12:13:23', '2025-05-13 12:13:23'),
(8, 'INV-20250627-01', 14, 5, 5000000.00, '2025-06-27 06:32:00', '2025-06-27 06:32:00');

-- --------------------------------------------------------

--
-- Table structure for table `item_consumable`
--

CREATE TABLE `item_consumable` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `category` varchar(100) DEFAULT NULL,
  `specification` varchar(255) DEFAULT NULL,
  `unit` varchar(50) DEFAULT NULL,
  `username` varchar(255) DEFAULT NULL,
  `stock` int(11) DEFAULT 0,
  `price` decimal(12,2) DEFAULT 0.00,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `item_consumable`
--

INSERT INTO `item_consumable` (`id`, `name`, `category`, `specification`, `unit`, `username`, `stock`, `price`, `created_at`, `updated_at`) VALUES
(1, 'Amplas 100', 'Amplas', '100', 'pcs', NULL, 10, 10000.00, '2025-06-30 07:28:11', '2025-06-30 07:28:11');

-- --------------------------------------------------------

--
-- Table structure for table `item_unit`
--

CREATE TABLE `item_unit` (
  `id` int(11) NOT NULL,
  `nama_item` varchar(255) DEFAULT NULL,
  `kode_unit` varchar(255) DEFAULT NULL,
  `brand` varchar(255) DEFAULT NULL,
  `supplier` varchar(255) DEFAULT NULL,
  `price_per_day` int(11) DEFAULT NULL,
  `status` enum('Tersedia','Disewa','Perawatan') DEFAULT 'Tersedia',
  `lokasi` varchar(255) DEFAULT NULL,
  `kondisi` enum('Baik','Butuh Perawatan','Rusak') DEFAULT 'Baik',
  `catatan` text DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `item_unit`
--

INSERT INTO `item_unit` (`id`, `nama_item`, `kode_unit`, `brand`, `supplier`, `price_per_day`, `status`, `lokasi`, `kondisi`, `catatan`, `created_at`, `updated_at`) VALUES
(1, '', 'EXCAVATOR-001', 'AAAAAA', '1', 1000000, 'Disewa', 'AAAAA', 'Baik', 'asdadasdassda', '2025-05-12 04:09:39', '2025-05-13 02:42:14'),
(2, '', 'AAA asdadasdsa', '12132a asd sadasd asdasd', '2', 1500000, 'Disewa', 'gdsf xz123232123121321213', 'Baik', 'zcadasdas21321213312231321', '2025-05-12 04:10:56', '2025-05-12 05:01:03'),
(10, '', 'EXCAVATOR-002', 'AAAAAA', '1', 500000, 'Disewa', 'AAAAA', 'Baik', NULL, '2025-05-13 02:52:56', '2025-05-13 02:54:41'),
(11, '', 'EXCAVATOR-003', 'AAAAAA', '1', 600000, 'Disewa', 'AAAAA', 'Baik', NULL, '2025-05-13 02:53:11', '2025-05-13 02:54:41'),
(12, '', 'EXCAVATOR-004', 'AAAAAA', '1', NULL, 'Disewa', 'gdsf xz123232123121321213', 'Butuh Perawatan', NULL, '2025-05-13 02:53:29', '2025-05-13 12:16:21'),
(13, '', 'EXCAVATOR-005', 'AAAAAAAA', '1', 550000, 'Disewa', 'AAAsdasdasda', 'Baik', NULL, '2025-05-13 04:54:46', '2025-05-13 12:13:23'),
(14, '', 'EXCA-005', 'MERCI', '1', 1000000, 'Disewa', 'GUDANG UTAMA - KARAWANG', 'Baik', 'OPERATOR 2 ORANG', '2025-05-13 12:19:04', '2025-06-27 06:32:00');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `suppliers`
--

CREATE TABLE `suppliers` (
  `id` int(11) NOT NULL,
  `supplier_name` varchar(255) DEFAULT NULL,
  `supplier_email` varchar(255) DEFAULT NULL,
  `contact_number` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `suppliers`
--

INSERT INTO `suppliers` (`id`, `supplier_name`, `supplier_email`, `contact_number`, `address`, `created_at`, `updated_at`) VALUES
(1, 'Coba', 'Coba@gmail.com', '1231231232123312', 'axdasdadassdasdsaas', '2025-05-12 12:29:14', '2025-05-12 12:29:03'),
(2, 'asdsaasddassda', 'addasd@gmail.com', '123221321', 'asdasdasdasdadsasdas', '2025-05-12 05:42:14', '2025-05-12 05:42:14');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `is_role` tinyint(4) NOT NULL DEFAULT 1 COMMENT '1:Admin',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `is_role`, `created_at`, `updated_at`) VALUES
(1, 'Admin', 'Admin@gmail.com', '2025-05-04 04:26:27', '$2y$12$Rq.T.nifin62zkqNnxd63OTLivCDkFbfHQ4xPXbATh3SsD3Houqm6', '1gFeRumY9LT3tn5wKIO6bD1NkCRDYigZyXwbnftco9Fw6hykX0VjQmcIazpg', 1, '2025-05-04 12:58:27', '2025-05-04 09:47:16'),
(2, 'Manager', 'manager@gmail.com', '2025-06-28 09:31:23', '$2y$12$Rq.T.nifin62zkqNnxd63OTLivCDkFbfHQ4xPXbATh3SsD3Houqm6', 'EvZGESFBRVOkYnzoJCYWvSE4wt8gbLUIRY1IvHVmRIERRR1Z7cx7pbYHkjKl', 2, '2025-06-28 09:31:23', '2025-06-28 09:31:23');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `invoices`
--
ALTER TABLE `invoices`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `invoice_detail`
--
ALTER TABLE `invoice_detail`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `item_consumable`
--
ALTER TABLE `item_consumable`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `item_unit`
--
ALTER TABLE `item_unit`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `kode_unit` (`kode_unit`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `suppliers`
--
ALTER TABLE `suppliers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `invoices`
--
ALTER TABLE `invoices`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `invoice_detail`
--
ALTER TABLE `invoice_detail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `item_consumable`
--
ALTER TABLE `item_consumable`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `item_unit`
--
ALTER TABLE `item_unit`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
