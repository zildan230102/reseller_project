-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 04, 2024 at 04:27 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `reseller_project`
--

-- --------------------------------------------------------

--
-- Table structure for table `bukus`
--

CREATE TABLE `bukus` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `judul_buku` varchar(255) NOT NULL,
  `nama_penulis` varchar(255) NOT NULL,
  `kategori_id` bigint(20) UNSIGNED NOT NULL,
  `isbn` varchar(255) NOT NULL,
  `tahun_terbit` year(4) NOT NULL,
  `ukuran` varchar(255) NOT NULL,
  `halaman` int(11) NOT NULL,
  `jenis_kertas` varchar(255) NOT NULL,
  `jenis_sampul` varchar(255) NOT NULL,
  `berat` decimal(8,2) NOT NULL,
  `harga` decimal(10,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `bukus`
--

INSERT INTO `bukus` (`id`, `judul_buku`, `nama_penulis`, `kategori_id`, `isbn`, `tahun_terbit`, `ukuran`, `halaman`, `jenis_kertas`, `jenis_sampul`, `berat`, `harga`, `created_at`, `updated_at`) VALUES
(1, 'Buku 1', 'Penulis 1', 5, '987-654-321', '2024', 'A4', 130, 'HVS', 'Softcopy', 1.12, 150000.00, '2024-10-30 01:00:41', '2024-10-31 00:03:31'),
(2, 'Buku 2', 'Penulis 2', 8, '123-123-123', '2024', 'A5', 160, 'HVS', 'Softcopy', 1.20, 170000.00, '2024-10-30 01:01:37', '2024-10-30 01:01:37'),
(3, 'Buku 3', 'Penulis 3', 3, '546-976-234', '2018', 'A5', 112, 'HVS', 'Softcopy', 0.89, 120000.00, '2024-10-30 01:02:22', '2024-10-30 01:02:22'),
(4, 'Buku 4', 'Penulis 4', 12, '345-870-234', '2018', 'A4', 126, 'HVS', 'Softcopy', 1.22, 170000.00, '2024-10-30 21:32:05', '2024-10-30 21:32:05');

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `ekspedisis`
--

CREATE TABLE `ekspedisis` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama_ekspedisi` varchar(255) NOT NULL,
  `kode_ekspedisi` varchar(255) NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `ekspedisis`
--

INSERT INTO `ekspedisis` (`id`, `nama_ekspedisi`, `kode_ekspedisi`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 'JNE', 'jne', 1, '2024-10-30 00:58:36', '2024-10-30 00:58:36'),
(2, 'Tiki', 'tiki', 1, '2024-10-30 00:58:36', '2024-10-30 00:58:36'),
(3, 'JNT', 'jnt', 1, '2024-10-30 00:58:36', '2024-10-30 00:58:36'),
(4, 'Sicepat', 'sicepat', 1, '2024-10-30 00:58:36', '2024-10-30 00:58:36'),
(5, 'Ninja Express', 'ninja express', 1, '2024-10-30 00:58:36', '2024-10-30 00:58:36'),
(6, 'Gosend', 'gosend', 1, '2024-10-30 00:58:36', '2024-10-30 00:58:36'),
(7, 'SPX Express', 'spx express', 1, '2024-10-30 00:58:36', '2024-10-30 00:58:36');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext NOT NULL,
  `options` mediumtext DEFAULT NULL,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `kategoris`
--

CREATE TABLE `kategoris` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama_kategori` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `kategoris`
--

INSERT INTO `kategoris` (`id`, `nama_kategori`, `created_at`, `updated_at`) VALUES
(1, 'Fiksi', '2024-10-30 00:58:13', '2024-10-30 00:58:13'),
(2, 'Non-Fiksi', '2024-10-30 00:58:13', '2024-10-30 00:58:13'),
(3, 'Komik', '2024-10-30 00:58:13', '2024-10-30 00:58:13'),
(4, 'Teknologi', '2024-10-30 00:58:13', '2024-10-30 00:58:13'),
(5, 'Karya Ilmiah', '2024-10-30 00:58:13', '2024-10-30 00:58:13'),
(6, 'Sejarah', '2024-10-30 00:58:13', '2024-10-30 00:58:13'),
(7, 'Novel', '2024-10-30 00:58:13', '2024-10-30 00:58:13'),
(8, 'Buku Panduan', '2024-10-30 00:58:13', '2024-10-30 00:58:13'),
(9, 'E-Book', '2024-10-30 00:58:13', '2024-10-30 00:58:13'),
(10, 'Budaya', '2024-10-30 00:58:13', '2024-10-30 00:58:13'),
(11, 'Antalogi', '2024-10-30 00:58:13', '2024-10-30 00:58:13'),
(12, 'Sains', '2024-10-30 00:58:13', '2024-10-30 00:58:13');

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
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2024_10_15_031221_add_columns_to_users_table', 1),
(5, '2024_10_15_041036_create_tokos_table', 1),
(6, '2024_10_21_041313_create_kategoris_table', 1),
(7, '2024_10_21_042935_create_bukus_table', 1),
(8, '2024_10_25_061631_create_orders_table', 1),
(9, '2024_10_30_062049_create_ekspedisis_table', 1),
(10, '2024_10_30_063919_add_ekspedisi_id_to_tokos_table', 1),
(11, '2024_10_30_094520_update_orders_table_add_ekspedisi_id', 2);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tanggal` date NOT NULL,
  `no_hp` varchar(255) NOT NULL,
  `toko_id` bigint(20) UNSIGNED NOT NULL,
  `asal_penjualan` varchar(255) NOT NULL,
  `penerima` varchar(255) NOT NULL,
  `no_hp_penerima` varchar(255) NOT NULL,
  `alamat_kirim` varchar(255) NOT NULL,
  `kelurahan` varchar(255) NOT NULL,
  `kecamatan` varchar(255) NOT NULL,
  `kota` varchar(255) NOT NULL,
  `provinsi` varchar(255) NOT NULL,
  `ekspedisi_id` bigint(20) UNSIGNED DEFAULT NULL,
  `catatan` text DEFAULT NULL,
  `total_berat` decimal(8,2) NOT NULL,
  `grand_total` decimal(10,2) NOT NULL,
  `no_invoice` varchar(255) NOT NULL,
  `kode_booking` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `tanggal`, `no_hp`, `toko_id`, `asal_penjualan`, `penerima`, `no_hp_penerima`, `alamat_kirim`, `kelurahan`, `kecamatan`, `kota`, `provinsi`, `ekspedisi_id`, `catatan`, `total_berat`, `grand_total`, `no_invoice`, `kode_booking`, `created_at`, `updated_at`) VALUES
(1, '2024-10-30', '083852868993', 4, 'Lazada', 'Retno', '081234567812', 'Daleman, Girikerto, Turi, Sleman', 'Girikerto', 'Turi', 'Sleman', 'Yogyakarta', NULL, 'test', 0.89, 120000.00, 'BM-30102024-000', 'A89S76F970GH', '2024-10-30 01:04:25', '2024-10-30 01:04:25');

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
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('ewiCxzGK3yI5edAv7bXQyJH8DpDEJTEaPt5nEo5F', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/130.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiQ1hOWFFMOEhySnJ6dUZiU1JZY0ExeGZLbjhiamU2VG94bW9ZZlBKWSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjY6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC90b2tvIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6MTt9', 1730690759);

-- --------------------------------------------------------

--
-- Table structure for table `tokos`
--

CREATE TABLE `tokos` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama_toko` varchar(255) NOT NULL,
  `marketplace` varchar(255) NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `ekspedisi_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tokos`
--

INSERT INTO `tokos` (`id`, `nama_toko`, `marketplace`, `is_active`, `created_at`, `updated_at`, `ekspedisi_id`) VALUES
(1, 'Buka Buku', 'Bukalapak', 1, '2024-10-30 00:58:58', '2024-11-03 20:25:59', 4),
(2, 'Buku Kita', 'Shoppe', 1, '2024-10-30 00:59:17', '2024-10-30 00:59:17', 1),
(3, 'Dunia Buku', 'Web Deepublish', 1, '2024-10-30 00:59:27', '2024-10-30 00:59:27', 6),
(4, 'Buku Mu', 'Lazada', 1, '2024-10-30 00:59:37', '2024-10-30 00:59:37', 3);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `join_date` date DEFAULT NULL,
  `profile_picture` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`, `phone`, `address`, `join_date`, `profile_picture`) VALUES
(1, 'Zildan Alfazri', 'zildan@example.com', NULL, '$2y$12$LNZEPpjegb2C8o.yGtTtneCK16HOZbxo/ww7efmBEru0yfo.bpeaS', 'utfa1KmppuAEWDu5zvq4XuqOQqqeh6NPe94U122gDAX583yCLb7l2Qj5AFQc', '2024-10-30 00:57:23', '2024-10-30 00:57:23', NULL, NULL, NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bukus`
--
ALTER TABLE `bukus`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `bukus_isbn_unique` (`isbn`),
  ADD KEY `bukus_kategori_id_foreign` (`kategori_id`);

--
-- Indexes for table `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `ekspedisis`
--
ALTER TABLE `ekspedisis`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `ekspedisis_kode_ekspedisi_unique` (`kode_ekspedisi`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indexes for table `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kategoris`
--
ALTER TABLE `kategoris`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `kategoris_nama_kategori_unique` (`nama_kategori`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `orders_no_invoice_unique` (`no_invoice`),
  ADD KEY `orders_toko_id_foreign` (`toko_id`),
  ADD KEY `orders_ekspedisi_id_foreign` (`ekspedisi_id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `tokos`
--
ALTER TABLE `tokos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tokos_ekspedisi_id_foreign` (`ekspedisi_id`);

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
-- AUTO_INCREMENT for table `bukus`
--
ALTER TABLE `bukus`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `ekspedisis`
--
ALTER TABLE `ekspedisis`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `kategoris`
--
ALTER TABLE `kategoris`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tokos`
--
ALTER TABLE `tokos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `bukus`
--
ALTER TABLE `bukus`
  ADD CONSTRAINT `bukus_kategori_id_foreign` FOREIGN KEY (`kategori_id`) REFERENCES `kategoris` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ekspedisi_id_foreign` FOREIGN KEY (`ekspedisi_id`) REFERENCES `ekspedisis` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `orders_toko_id_foreign` FOREIGN KEY (`toko_id`) REFERENCES `tokos` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `tokos`
--
ALTER TABLE `tokos`
  ADD CONSTRAINT `tokos_ekspedisi_id_foreign` FOREIGN KEY (`ekspedisi_id`) REFERENCES `ekspedisis` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
