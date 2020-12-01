-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 01, 2020 at 05:18 AM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.4.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `wen_paper`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(200) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `username`, `password`, `created_at`, `updated_at`) VALUES
(1, 'admin', '$2y$10$S3HV96PWpV/KtQQpth9rUepPSd19u0tJhikEHcMDbwbue16Vjs2ju', '2020-11-25 21:03:52', '2020-11-25 21:03:52'),
(2, 'user', '$2y$10$ZXjRbmyHTSN33trBM6rmEOl8/DGB9ZQuiR8BOdoneoxeWvkIlqARi', '2020-11-25 21:49:42', '2020-11-25 21:49:42'),
(3, 'www', '$2y$10$tB20pW4jcu0l/T2XSBpu5.hHQNUENLd1iPmDzmFIRnlPd1ejJm5MS', '2020-11-25 23:31:29', '2020-11-25 23:31:29'),
(4, 'admin2', '$2y$10$ezpcV4jdiDe7BFqu.bWAK.rMO6/Y5eHY97IsU4U6DbQkWF80PtalS', '2020-11-26 00:34:57', '2020-11-26 23:37:54'),
(5, 'user2', '$2y$10$zRKBZ.55LaoodehX3uYzVOdsHrN.cmqMftO6JYR0BVKU7kwCZWZkC', '2020-11-26 20:05:26', '2020-11-26 20:05:26');

-- --------------------------------------------------------

--
-- Table structure for table `admin_details`
--

CREATE TABLE `admin_details` (
  `id` int(11) NOT NULL,
  `admin_id` varchar(100) NOT NULL,
  `nama` varchar(200) NOT NULL,
  `email` varchar(300) NOT NULL,
  `no_telp` varchar(100) NOT NULL,
  `foto` varchar(100) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin_details`
--

INSERT INTO `admin_details` (`id`, `admin_id`, `nama`, `email`, `no_telp`, `foto`, `created_at`, `updated_at`) VALUES
(4, '4', 'wendi Nurhermansah', 'wendi@gmail.com', '081214255668', '1606376097.cowo.jpg', '2020-11-26 00:34:57', '2020-11-26 20:27:42'),
(5, '5', 'wini', 'wini@gmail.com', '081223443553', '1606446327.lll.jpg', '2020-11-26 20:05:27', '2020-11-26 20:05:27');

-- --------------------------------------------------------

--
-- Table structure for table `jurusan`
--

CREATE TABLE `jurusan` (
  `id` int(11) NOT NULL,
  `n_jurusan` varchar(100) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `jurusan`
--

INSERT INTO `jurusan` (`id`, `n_jurusan`, `created_at`, `updated_at`) VALUES
(1, 'TEKNOLOGI INFORMATIKA', '2020-11-18 07:44:23', '2020-11-18 07:44:23'),
(2, 'TEKNOLOGI INFORMASI', '2020-11-18 07:46:26', '2020-11-18 07:46:26'),
(3, 'SITEM INFORMASI', '2020-11-18 07:46:59', '2020-11-18 07:46:59'),
(4, 'TEKNOLOGI KOMPUTER', '2020-11-18 07:47:20', '2020-11-18 07:47:20'),
(5, 'TEKNIK SIPIL', '2020-11-18 07:47:50', '2020-11-18 07:47:50'),
(6, 'TEKNIK ELEKTRO', '2020-11-18 07:48:01', '2020-11-18 07:48:01');

-- --------------------------------------------------------

--
-- Table structure for table `mapel`
--

CREATE TABLE `mapel` (
  `id` int(11) NOT NULL,
  `n_mapel` varchar(100) NOT NULL,
  `jurusan_id` varchar(200) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `mapel`
--

INSERT INTO `mapel` (`id`, `n_mapel`, `jurusan_id`, `created_at`, `updated_at`) VALUES
(1, 'Pendidikan Agama', '1', '2020-11-18 07:56:04', '2020-11-18 07:56:04'),
(2, 'Bahasa Indonesia', '1', '2020-11-18 07:59:44', '2020-11-18 07:59:44'),
(3, 'Pengantar Teknologi informasi & Komunikasi', '1', '2020-11-18 07:59:44', '2020-11-18 07:59:44'),
(4, 'Pemograman Berorientasi Object', '1', '2020-11-18 07:59:44', '2020-11-18 07:59:44'),
(5, 'Aljabar Linear', '1', '2020-11-18 07:59:44', '2020-11-18 07:59:44'),
(6, 'Algoritma & Pemograman', '1', '2020-11-18 07:59:44', '2020-11-18 07:59:44'),
(7, 'Aplikasi Komputer', '1', '2020-11-18 07:59:44', '2020-11-18 07:59:44'),
(8, 'Bahasa Inggris', '2', '2020-11-18 08:00:54', '2020-11-18 08:00:54'),
(9, 'Sistem Operasi', '2', '2020-11-18 08:03:32', '2020-11-18 08:03:32'),
(10, 'Jaringan Komputer', '2', '2020-11-18 08:03:32', '2020-11-18 08:03:32'),
(11, 'Manajemen Bisnis', '2', '2020-11-18 08:03:32', '2020-11-18 08:03:32'),
(12, 'Dasar-dasar Pengmbangan Perangkat lunak', '2', '2020-11-18 08:03:32', '2020-11-18 08:03:32'),
(13, 'Teori Sistem Informasi', '2', '2020-11-18 08:03:32', '2020-11-18 08:03:32'),
(14, 'Sistem Manajement Basis Data', '2', '2020-11-18 08:03:32', '2020-11-18 08:03:32'),
(15, 'Pendidikan Anti Korupsi', '3', '2020-11-18 08:04:37', '2020-11-18 08:04:37'),
(16, 'Metodologi Penelitian', '3', '2020-11-18 08:07:43', '2020-11-18 08:07:43'),
(17, 'Technopreneur', '3', '2020-11-18 08:07:43', '2020-11-18 08:07:43'),
(18, 'Sisrem Penunjang Keputusan', '3', '2020-11-18 08:07:43', '2020-11-18 08:07:43'),
(19, 'Knowledge Manajement', '3', '2020-11-18 08:07:43', '2020-11-18 08:07:43'),
(20, 'Manajement Proyek Teknologi Informasi & Komunikasi', '3', '2020-11-18 08:07:43', '2020-11-18 08:07:43'),
(21, 'Artivicial Intelegent', '3', '2020-11-18 08:07:43', '2020-11-18 08:07:43'),
(22, 'Pendidikan Pancasila & Kewarganegaraan', '4', '2020-11-18 09:29:40', '2020-11-18 09:29:40'),
(23, 'Bahasa Inggris', '4', '2020-11-18 09:32:43', '2020-11-18 09:32:43'),
(24, 'Statistika', '4', '2020-11-18 09:32:43', '2020-11-18 09:32:43'),
(25, 'Matematika diskrit', '4', '2020-11-18 09:32:43', '2020-11-18 09:32:43'),
(26, 'Respresentasi & Penalaran', '4', '2020-11-18 09:32:43', '2020-11-18 09:32:43'),
(27, 'pembelajaran mesin', '4', '2020-11-18 09:32:43', '2020-11-18 09:32:43'),
(28, 'Grafika Komputer', '4', '2020-11-18 09:32:43', '2020-11-18 09:32:43'),
(29, 'Bahasa Assembly', '5', '2020-11-18 09:56:35', '2020-11-18 09:56:35'),
(30, 'Kriftografi', '5', '2020-11-18 09:58:34', '2020-11-18 09:58:34'),
(31, 'Teori grafik', '5', '2020-11-18 09:58:34', '2020-11-18 09:58:34'),
(32, 'Mikroprosssor', '5', '2020-11-18 09:58:34', '2020-11-18 09:58:34'),
(33, 'Pengolahan citra Digital', '5', '2020-11-18 09:58:34', '2020-11-18 09:58:34'),
(34, 'Pemograman Logic & Sematic', '5', '2020-11-18 09:58:34', '2020-11-18 09:58:34'),
(35, 'Multymedia', '5', '2020-11-18 09:58:34', '2020-11-18 09:58:34'),
(36, 'Matematika', '6', '2020-11-18 10:00:21', '2020-11-18 10:00:21'),
(37, 'Dasar Pemograman', '6', '2020-11-18 10:02:14', '2020-11-18 10:02:14'),
(38, 'Fisika', '6', '2020-11-18 10:02:14', '2020-11-18 10:02:14'),
(39, 'Pancasla', '6', '2020-11-18 10:02:14', '2020-11-18 10:02:14'),
(40, 'Agama', '6', '2020-11-18 10:02:14', '2020-11-18 10:02:14'),
(41, 'Bahasa Inggris', '6', '2020-11-18 10:02:14', '2020-11-18 10:02:14'),
(42, 'Pengantar Teknologi Elektro', '6', '2020-11-18 10:02:14', '2020-11-18 10:02:14');

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
(3, '2020_11_23_032759_create_permission_tables', 1);

-- --------------------------------------------------------

--
-- Table structure for table `model_has_permissions`
--

CREATE TABLE `model_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `update_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `model_has_roles`
--

CREATE TABLE `model_has_roles` (
  `role_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `model_has_roles`
--

INSERT INTO `model_has_roles` (`role_id`, `model_type`, `model_id`, `created_at`, `updated_at`) VALUES
(1, 'app\\User', 4, '2020-11-27 03:29:05', '2020-11-26 20:29:05'),
(2, 'app\\User', 5, '2020-11-26 20:05:27', '2020-11-26 20:05:27');

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(3, 'Role', 'web', '2020-11-25 00:31:03', '2020-11-25 00:31:03'),
(4, 'Mahasiswa', 'web', '2020-11-25 00:31:14', '2020-11-25 00:31:14');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'Super-Admin', 'web', NULL, NULL),
(2, 'Admin-Biasa', 'web', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `role_has_permissions`
--

CREATE TABLE `role_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `update_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `role_has_permissions`
--

INSERT INTO `role_has_permissions` (`permission_id`, `role_id`, `created_at`, `update_at`) VALUES
(3, 1, '2020-11-26 07:31:30', '2020-11-26 07:31:30'),
(4, 1, '2020-11-25 08:17:28', '2020-11-25 08:17:28'),
(4, 2, '2020-11-26 07:31:48', '2020-11-26 07:31:48');

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `id` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `nim` varchar(20) NOT NULL,
  `jenis_kelamin` varchar(100) NOT NULL,
  `alamat` varchar(300) NOT NULL,
  `id_jurusan` varchar(100) NOT NULL,
  `id_mapel` varchar(100) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`id`, `nama`, `nim`, `jenis_kelamin`, `alamat`, `id_jurusan`, `id_mapel`, `created_at`, `updated_at`) VALUES
(4, 'wendi nurhermansah', '110798', 'LAKI-LAKI', 'Garut, Jawa barat', '1', '3', '2020-11-19 00:10:22', '2020-11-21 03:05:19'),
(5, 'Neng Salsa Nabila Nurhermansari', '101005', 'PEREMPUAN', 'Limbangan garut', '5', '33', '2020-11-19 00:11:20', '2020-11-19 00:11:20'),
(6, 'Endang taufik Hidayat', '140900', 'LAKI-LAKI', 'kp.cibadak 1 Garut', '3', '20', '2020-11-19 00:12:59', '2020-11-19 00:12:59'),
(12, 'abdillah nurcahyo', '123456', 'LAKI-LAKI', 'Garut, Jawa barat', '4', '22', '2020-11-23 03:09:50', '2020-11-23 03:09:50'),
(13, 'Samuel abdul Malik', '334455', 'LAKI-LAKI', 'yogyakarta', '1', '4', '2020-11-23 03:10:21', '2020-11-23 03:10:21');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(200) NOT NULL,
  `password` varchar(300) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `created_at`, `updated_at`) VALUES
(1, 'wendi', 'wendi@gmail.com', 'rahasia', '2020-11-26 02:42:05', '2020-11-26 02:42:05');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `admin_details`
--
ALTER TABLE `admin_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `jurusan`
--
ALTER TABLE `jurusan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mapel`
--
ALTER TABLE `mapel`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`model_id`,`model_type`),
  ADD KEY `model_has_permissions_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indexes for table `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD PRIMARY KEY (`role_id`,`model_id`,`model_type`),
  ADD KEY `model_has_roles_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`role_id`),
  ADD KEY `role_has_permissions_role_id_foreign` (`role_id`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
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
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `admin_details`
--
ALTER TABLE `admin_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `jurusan`
--
ALTER TABLE `jurusan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `mapel`
--
ALTER TABLE `mapel`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD CONSTRAINT `model_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD CONSTRAINT `model_has_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
