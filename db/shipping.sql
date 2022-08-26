-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 01, 2022 at 02:05 AM
-- Server version: 10.4.18-MariaDB
-- PHP Version: 7.4.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `shipping`
--

-- --------------------------------------------------------

--
-- Table structure for table `barcodes`
--

CREATE TABLE `barcodes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `country_id` bigint(20) UNSIGNED NOT NULL,
  `barcode_number` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `client_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `price` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `content` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `previous_status` enum('canceled','reschedule','transfer','created','RTO','received hub','out to deliver','Return to seller','pending') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` enum('created','pending','received hub','out to deliver','delivered','RTO','reschedule','Returned','transfer','canceled','Return to seller') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'created',
  `end_courier_debrief` tinyint(1) NOT NULL DEFAULT 0,
  `end_seller_debrief` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `seller_id` bigint(20) UNSIGNED NOT NULL,
  `note` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `scheduling_date` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `scheduling_time` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `scheduling_times` int(11) DEFAULT NULL,
  `sub_area_id` bigint(20) UNSIGNED DEFAULT NULL,
  `deliver_courier_id` bigint(20) UNSIGNED DEFAULT NULL,
  `return_courier_id` bigint(20) UNSIGNED DEFAULT NULL,
  `shipping_price` int(11) DEFAULT NULL,
  `payment_method` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `invoice_id` bigint(20) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `barcode_couriers`
--

CREATE TABLE `barcode_couriers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `barcode_number` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `courier_id` bigint(20) UNSIGNED NOT NULL,
  `seller_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `countries`
--

CREATE TABLE `countries` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `countries`
--

INSERT INTO `countries` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'القاهرة', '2020-11-25 07:44:21', '2021-02-03 09:59:37'),
(2, 'البحر الاحمر', '2021-04-27 22:57:11', '2021-04-27 22:57:11');

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
-- Table structure for table `invoices`
--

CREATE TABLE `invoices` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `seller_id` bigint(20) UNSIGNED NOT NULL,
  `main_price` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `discount` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total` bigint(255) UNSIGNED NOT NULL,
  `payment_method` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `items`
--

CREATE TABLE `items` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `barcode_id` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `languages`
--

CREATE TABLE `languages` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `code` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `languages`
--

INSERT INTO `languages` (`id`, `name`, `code`, `image`, `created_at`, `updated_at`) VALUES
(1, 'Arabic', 'ar', 'languages/D2X2IpwnS2YGbAhAGaDjwjDM0Rk4v01X64ITpj4S.png', '2020-11-22 09:41:20', '2020-11-22 09:41:20'),
(2, 'English', 'en', 'languages/aZdsEULlPZXje101TVvnz1aLsmTe8iiVsKk1sQRX.png', '2020-11-22 09:41:38', '2020-11-22 09:41:38');

-- --------------------------------------------------------

--
-- Table structure for table `logs`
--

CREATE TABLE `logs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `barcode_id` bigint(20) UNSIGNED DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `status` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
(4, '2020_11_22_111226_create_languages_table', 1),
(5, '2020_11_22_125515_create_countries_table', 2),
(9, '2020_11_22_133946_create_barcodes_table', 3),
(11, '2020_11_25_092152_create_items_table', 4),
(12, '2021_01_10_124042_add_seller_id_to_barcodes_id', 5),
(15, '2021_01_11_112141_add_notes_to_barcods_table', 7),
(16, '2021_01_11_130248_add_schedule_date_and_time_to_barcods_table', 8),
(18, '2021_01_12_090342_create_logs_table', 9),
(19, '2021_01_13_111448_add_area_id_to_users_table', 10),
(20, '2021_01_14_074459_add_times_of_scheduling_to_data_to_barcodes_table', 11),
(23, '2021_01_14_074828_add_previous_status_to_barcodes_table', 12),
(26, '2021_01_17_090452_add_address_to_users_table', 13),
(27, '2021_01_17_090505_add_phone_to_users_table', 13),
(28, '2021_01_10_153844_create_barcode_couriers_table', 14),
(30, '2021_01_25_101246_create_sub_areas_table', 15),
(31, '2021_01_27_131600_add_sub_area_id_to_barcodes_table', 16),
(32, '2021_01_28_074333_add_end_debrief_to_barcodes_table', 17),
(34, '2021_01_29_175553_add_end_seller_debrief_to_barcodes_table', 18),
(35, '2021_01_29_175845_add_deliver_courier_id_to_barcodes', 19),
(36, '2021_01_29_180032_add_return_courier_id_to_barcodes', 20),
(37, '2021_01_30_140839_add_shipping_price_to_barcodes_table', 21),
(38, '2021_01_31_080536_add_payment_method_to_barcodes_table', 22);

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
-- Table structure for table `sub_areas`
--

CREATE TABLE `sub_areas` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `area_id` bigint(20) UNSIGNED NOT NULL,
  `deliver_price` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `return_price` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sub_areas`
--

INSERT INTO `sub_areas` (`id`, `name`, `area_id`, `deliver_price`, `return_price`, `created_at`, `updated_at`) VALUES
(9, 'Cairo', 1, '40', '10', '2021-02-03 09:59:54', '2021-02-03 09:59:54'),
(10, 'Giza', 1, '40', '10', '2021-02-03 10:00:22', '2021-02-03 10:00:22'),
(13, 'Alex', 1, '50', '10', '2021-03-13 15:00:29', '2021-03-13 15:00:29'),
(14, 'الجيزة', 2, '150', '20', '2021-04-27 22:58:09', '2021-04-27 22:58:09'),
(15, 'اسكندريه', 1, '٦٠', '٣٠', '2021-05-05 20:58:19', '2021-05-05 20:58:19'),
(16, 'شبرا', 1, '40', '20', '2021-05-05 23:13:56', '2021-05-05 23:13:56');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` bigint(20) DEFAULT NULL,
  `id_number` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bank_account` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` enum('user','admin','operator','seller','courier','accountant') COLLATE utf8mb4_unicode_ci DEFAULT 'user',
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `area_id` bigint(20) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `phone`, `id_number`, `bank_account`, `address`, `email_verified_at`, `password`, `image`, `type`, `remember_token`, `created_at`, `updated_at`, `area_id`) VALUES
(3, 'Admin', 'admin@admin.com', NULL, NULL, NULL, NULL, NULL, '$2y$10$ZIZkhKsvGWxBYxfg/nzNl.7uBq1UWIRPvGpH2NEAARVplM5ewaMsW', 'users/ACLNFY7BMXRtlxHjcbvSzNce32bXBaEk1TkALPpz.jpeg', 'admin', 'qrYYDk4duqaHYOI2mtMn3UBsJDQGYcInHM1aTjsgzSAPPHInMIZHmfgaAin2', '2020-11-24 08:03:21', '2021-05-04 04:21:57', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `barcodes`
--
ALTER TABLE `barcodes`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `barcode_number` (`barcode_number`),
  ADD KEY `barcodes_seller_id_index` (`seller_id`),
  ADD KEY `barcodes_sub_area_id_foreign` (`sub_area_id`),
  ADD KEY `barcodes_deliver_courier_id_foreign` (`deliver_courier_id`),
  ADD KEY `barcodes_return_courier_id_foreign` (`return_courier_id`),
  ADD KEY `invoice_constraint` (`invoice_id`);

--
-- Indexes for table `barcode_couriers`
--
ALTER TABLE `barcode_couriers`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `barcode_couriers_barcode_number_unique` (`barcode_number`),
  ADD KEY `barcode_couriers_courier_id_foreign` (`courier_id`),
  ADD KEY `barcode_couriers_seller_id_foreign` (`seller_id`);

--
-- Indexes for table `countries`
--
ALTER TABLE `countries`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `invoices`
--
ALTER TABLE `invoices`
  ADD PRIMARY KEY (`id`),
  ADD KEY `invoices_seller_id_foreign` (`seller_id`);

--
-- Indexes for table `items`
--
ALTER TABLE `items`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `languages`
--
ALTER TABLE `languages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `logs`
--
ALTER TABLE `logs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `logs_barcode_id_index` (`barcode_id`),
  ADD KEY `logs_user_id_index` (`user_id`),
  ADD KEY `logs_status_index` (`status`(768));

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
-- Indexes for table `sub_areas`
--
ALTER TABLE `sub_areas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sub_areas_area_id_foreign` (`area_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD KEY `users_area_id_foreign` (`area_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `barcodes`
--
ALTER TABLE `barcodes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `barcode_couriers`
--
ALTER TABLE `barcode_couriers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `countries`
--
ALTER TABLE `countries`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `invoices`
--
ALTER TABLE `invoices`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `items`
--
ALTER TABLE `items`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `languages`
--
ALTER TABLE `languages`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `logs`
--
ALTER TABLE `logs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `sub_areas`
--
ALTER TABLE `sub_areas`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `barcodes`
--
ALTER TABLE `barcodes`
  ADD CONSTRAINT `barcodes_deliver_courier_id_foreign` FOREIGN KEY (`deliver_courier_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `barcodes_return_courier_id_foreign` FOREIGN KEY (`return_courier_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `barcodes_seller_id_foreign` FOREIGN KEY (`seller_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `barcodes_sub_area_id_foreign` FOREIGN KEY (`sub_area_id`) REFERENCES `sub_areas` (`id`),
  ADD CONSTRAINT `invoice_constraint` FOREIGN KEY (`invoice_id`) REFERENCES `invoices` (`id`);

--
-- Constraints for table `barcode_couriers`
--
ALTER TABLE `barcode_couriers`
  ADD CONSTRAINT `barcode_couriers_barcode_number_foreign` FOREIGN KEY (`barcode_number`) REFERENCES `barcodes` (`barcode_number`),
  ADD CONSTRAINT `barcode_couriers_courier_id_foreign` FOREIGN KEY (`courier_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `barcode_couriers_seller_id_foreign` FOREIGN KEY (`seller_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `invoices`
--
ALTER TABLE `invoices`
  ADD CONSTRAINT `invoices_seller_id_foreign` FOREIGN KEY (`seller_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `logs`
--
ALTER TABLE `logs`
  ADD CONSTRAINT `logs_barcode_id_foreign` FOREIGN KEY (`barcode_id`) REFERENCES `barcodes` (`id`),
  ADD CONSTRAINT `logs_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `sub_areas`
--
ALTER TABLE `sub_areas`
  ADD CONSTRAINT `sub_areas_area_id_foreign` FOREIGN KEY (`area_id`) REFERENCES `countries` (`id`);

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_area_id_foreign` FOREIGN KEY (`area_id`) REFERENCES `countries` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
