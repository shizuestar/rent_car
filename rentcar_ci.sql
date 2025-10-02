-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Oct 02, 2025 at 06:19 AM
-- Server version: 8.0.30
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `rentcar_ci`
--

-- --------------------------------------------------------

--
-- Table structure for table `cars`
--

CREATE TABLE `cars` (
  `id` bigint UNSIGNED NOT NULL,
  `category_id` bigint UNSIGNED DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `type` varchar(255) NOT NULL,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci,
  `year` date DEFAULT NULL,
  `no_plat` varchar(50) NOT NULL,
  `rent_price` decimal(10,2) NOT NULL,
  `status` enum('available','rented') NOT NULL DEFAULT 'available',
  `image` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `cars`
--

INSERT INTO `cars` (`id`, `category_id`, `name`, `type`, `description`, `year`, `no_plat`, `rent_price`, `status`, `image`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, 'Nissan X-Trail', 'SUV', 'Nissan X-Trail: SUV Tangguh untuk Setiap Petualangan Keluarga\r\n\r\nJelajahi setiap sudut kota dan taklukkan jalur tersembunyi bersama Nissan X-Trail. Dirancang sebagai SUV yang sempurna untuk keluarga modern, X-Trail menawarkan perpaduan ideal antara ketangguhan sejati dan kenyamanan premium.\r\n\r\nNikmati ruang kabin yang fleksibel dan lega dengan pilihan 3 baris kursi (tergantung tipe), siap membawa seluruh anggota keluarga dan barang bawaan untuk weekend getaway atau perjalanan harian Anda. Didukung oleh teknologi Nissan Intelligent Mobility, berkendara menjadi lebih aman, lebih cerdas, dan lebih menyenangkan. Dari desain eksterior yang gagah hingga performa mesin yang responsif, X-Trail adalah mitra tepercaya yang siap menemani setiap cerita petualangan Anda.\r\n\r\nRasakan kombinasi sempurna antara gaya, keamanan, dan kemampuan off-road ringan. Waktunya untuk menjelajah lebih jauh.', '2025-10-01', 'B 1234 XY', 350000.00, 'available', 'uploads/cars/5k_Lamborghini_Huracan_2018.jpeg', NULL, '2025-10-01 20:46:43', NULL),
(2, 2, 'BMW 320i', 'Sedan', 'Nissan X-Trail: SUV Tangguh untuk Setiap Petualangan Keluarga\r\n\r\nJelajahi setiap sudut kota dan taklukkan jalur tersembunyi bersama Nissan X-Trail. Dirancang sebagai SUV yang sempurna untuk keluarga modern, X-Trail menawarkan perpaduan ideal antara ketangguhan sejati dan kenyamanan premium.\r\n\r\nNikmati ruang kabin yang fleksibel dan lega dengan pilihan 3 baris kursi (tergantung tipe), siap membawa seluruh anggota keluarga dan barang bawaan untuk weekend getaway atau perjalanan harian Anda. Didukung oleh teknologi Nissan Intelligent Mobility, berkendara menjadi lebih aman, lebih cerdas, dan lebih menyenangkan. Dari desain eksterior yang gagah hingga performa mesin yang responsif, X-Trail adalah mitra tepercaya yang siap menemani setiap cerita petualangan Anda.\r\n\r\nRasakan kombinasi sempurna antara gaya, keamanan, dan kemampuan off-road ringan. Waktunya untuk menjelajah lebih jauh.', '2025-10-01', 'B 5678 AB', 500000.00, 'available', 'uploads/cars/lambo.jpeg', NULL, '2025-10-01 20:48:43', NULL),
(3, 3, 'Toyota Avanza', 'MPV', 'Nissan X-Trail: SUV Tangguh untuk Setiap Petualangan Keluarga\r\n\r\nJelajahi setiap sudut kota dan taklukkan jalur tersembunyi bersama Nissan X-Trail. Dirancang sebagai SUV yang sempurna untuk keluarga modern, X-Trail menawarkan perpaduan ideal antara ketangguhan sejati dan kenyamanan premium.\r\n\r\nNikmati ruang kabin yang fleksibel dan lega dengan pilihan 3 baris kursi (tergantung tipe), siap membawa seluruh anggota keluarga dan barang bawaan untuk weekend getaway atau perjalanan harian Anda. Didukung oleh teknologi Nissan Intelligent Mobility, berkendara menjadi lebih aman, lebih cerdas, dan lebih menyenangkan. Dari desain eksterior yang gagah hingga performa mesin yang responsif, X-Trail adalah mitra tepercaya yang siap menemani setiap cerita petualangan Anda.\r\n\r\nRasakan kombinasi sempurna antara gaya, keamanan, dan kemampuan off-road ringan. Waktunya untuk menjelajah lebih jauh.', '2025-10-01', 'D 1111 CD', 250000.00, 'available', 'uploads/cars/pfp.jpeg', NULL, '2025-10-01 20:52:56', NULL),
(4, 1, 'Admiral', 'A 123', 'Nissan X-Trail: SUV Tangguh untuk Setiap Petualangan Keluarga\r\n\r\nJelajahi setiap sudut kota dan taklukkan jalur tersembunyi bersama Nissan X-Trail. Dirancang sebagai SUV yang sempurna untuk keluarga modern, X-Trail menawarkan perpaduan ideal antara ketangguhan sejati dan kenyamanan premium.\r\n\r\nNikmati ruang kabin yang fleksibel dan lega dengan pilihan 3 baris kursi (tergantung tipe), siap membawa seluruh anggota keluarga dan barang bawaan untuk weekend getaway atau perjalanan harian Anda. Didukung oleh teknologi Nissan Intelligent Mobility, berkendara menjadi lebih aman, lebih cerdas, dan lebih menyenangkan. Dari desain eksterior yang gagah hingga performa mesin yang responsif, X-Trail adalah mitra tepercaya yang siap menemani setiap cerita petualangan Anda.\r\n\r\nRasakan kombinasi sempurna antara gaya, keamanan, dan kemampuan off-road ringan. Waktunya untuk menjelajah lebih jauh.', '2025-10-01', 'AD 8989 BD', 100000.00, 'rented', 'uploads/cars/18d712c3-b538-403d-8907-b6459d9ed294.jpeg', '2025-10-01 00:39:27', '2025-10-01 20:52:49', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(100) NOT NULL,
  `description` text,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `description`, `created_at`, `updated_at`) VALUES
(1, 'SUVI', 'Sport Utility Vehicle', NULL, NULL),
(2, 'Sedan', 'Mobil sedan untuk keluarga/eksekutif', NULL, NULL),
(3, 'MPV', 'Multi Purpose Vehicle untuk keluarga', NULL, NULL),
(5, 'Motor', 'Sepeda motor harian', NULL, NULL),
(7, 'Fais Bau', 'Paisss', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `nama_lengkap` varchar(255) NOT NULL,
  `no_telepon` varchar(20) NOT NULL,
  `nik` varchar(20) NOT NULL,
  `alamat` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`id`, `user_id`, `nama_lengkap`, `no_telepon`, `nik`, `alamat`, `created_at`, `updated_at`) VALUES
(1, 8, '', '099987654678', '09990909009', 'Buran Tasikmadu Karanganyar', NULL, NULL),
(3, 9, '', '0992817651765', '0987654567890', 'Ngemplak Brujul Papua Tengahs', NULL, NULL),
(4, 10, '', '9876545678654', '87654567876543', 'Buran Karanganyar Jawa Selatan', NULL, NULL),
(5, 12, 'Yudha', '097654567654', '9876545678765', 'Alamat saya', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `id` bigint UNSIGNED NOT NULL,
  `transaction_id` bigint UNSIGNED NOT NULL,
  `method` enum('cash','transfer') NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `payment_proof` varchar(255) NOT NULL,
  `status` enum('pending','verify') NOT NULL DEFAULT 'pending',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `transactions`
--

CREATE TABLE `transactions` (
  `id` bigint UNSIGNED NOT NULL,
  `rent_date` date NOT NULL,
  `return_date` date NOT NULL,
  `total` decimal(10,2) NOT NULL,
  `status` enum('pending','cancel','paid','completed') NOT NULL DEFAULT 'pending',
  `user_id` bigint UNSIGNED NOT NULL,
  `car_id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `transactions`
--

INSERT INTO `transactions` (`id`, `rent_date`, `return_date`, `total`, `status`, `user_id`, `car_id`, `created_at`, `updated_at`) VALUES
(11, '2025-10-03', '2025-10-11', 800000.00, 'pending', 8, 4, '2025-10-01 21:12:42', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `role` enum('admin','customer') NOT NULL DEFAULT 'customer',
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `role`, `password`, `remember_token`, `created_at`, `updated_at`, `deleted_at`) VALUES
(5, 'Adminnn', 'admin@email.com', 'admin', '$2y$10$Oa3q684Aig2fosZ38yfDV.cq/QR9EZgBZYW/2aWHrCgSrDijFqmLG', NULL, NULL, NULL, NULL),
(8, 'Fais Nashrullah', 'fais@gmail.com', 'customer', '$2y$10$st4TJsZg6FTILcp.jEE5VuzVN6aLKyIv4nE.BhvBTYwZIUexav6DO', NULL, NULL, NULL, NULL),
(9, 'Fais Bau', 'fais123@gmail.com', 'customer', '$2y$10$BP0CmTpLZjmDyUHEB0804uYEbntQfv0hC8OCeSezx.TKyT49gu9vq', NULL, NULL, NULL, NULL),
(10, 'Amnan Khoirul Majid', 'amm@gmail.com', 'customer', '$2y$10$3hn9DCF/tYgrBqyK1ILSaODhscWTEWWEaanADwd9.ODgfJQZvKoBW', NULL, NULL, NULL, NULL),
(12, 'Yudha', 'yudha@gmail.com', 'customer', '$2y$10$tWg8HShm2LeihccJMMk44.4b.Tz0DwyIKMiSTkujboo2XJssY.Er2', NULL, NULL, NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cars`
--
ALTER TABLE `cars`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `no_plat` (`no_plat`),
  ADD KEY `category_id` (`category_id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nik` (`nik`),
  ADD UNIQUE KEY `customers_user_id_unique` (`user_id`);

--
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `transaction_id` (`transaction_id`);

--
-- Indexes for table `transactions`
--
ALTER TABLE `transactions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `car_id` (`car_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cars`
--
ALTER TABLE `cars`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `transactions`
--
ALTER TABLE `transactions`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `cars`
--
ALTER TABLE `cars`
  ADD CONSTRAINT `cars_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `customers`
--
ALTER TABLE `customers`
  ADD CONSTRAINT `customers_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `payments`
--
ALTER TABLE `payments`
  ADD CONSTRAINT `payments_ibfk_1` FOREIGN KEY (`transaction_id`) REFERENCES `transactions` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `transactions`
--
ALTER TABLE `transactions`
  ADD CONSTRAINT `transactions_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `transactions_ibfk_2` FOREIGN KEY (`car_id`) REFERENCES `cars` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
