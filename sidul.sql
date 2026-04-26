-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Apr 26, 2026 at 02:33 PM
-- Server version: 8.0.30
-- PHP Version: 8.3.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sidul`
--

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `dosens`
--

CREATE TABLE `dosens` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `nik` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `dosens`
--

INSERT INTO `dosens` (`id`, `user_id`, `nik`, `nama`, `created_at`, `updated_at`) VALUES
(1, 3, '1935824815', 'Prof. Brice Gislason Jr.', '2026-04-26 07:09:03', '2026-04-26 07:09:03'),
(2, 4, '1945363311', 'Demarco Bahringer I', '2026-04-26 07:09:03', '2026-04-26 07:09:03'),
(3, 5, '1973076272', 'Janet Roob', '2026-04-26 07:09:03', '2026-04-26 07:09:03');

-- --------------------------------------------------------

--
-- Table structure for table `komentar_laporans`
--

CREATE TABLE `komentar_laporans` (
  `id` bigint UNSIGNED NOT NULL,
  `laporan_id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `bab_ke` int DEFAULT NULL,
  `komentar` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `laporans`
--

CREATE TABLE `laporans` (
  `id` bigint UNSIGNED NOT NULL,
  `magang_id` bigint UNSIGNED NOT NULL,
  `judul` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `bab1` longtext COLLATE utf8mb4_unicode_ci,
  `bab2` longtext COLLATE utf8mb4_unicode_ci,
  `bab3` longtext COLLATE utf8mb4_unicode_ci,
  `bab4` longtext COLLATE utf8mb4_unicode_ci,
  `status` enum('review','revisi','approved') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'review',
  `catatan_dosen` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `laporans`
--

INSERT INTO `laporans` (`id`, `magang_id`, `judul`, `bab1`, `bab2`, `bab3`, `bab4`, `status`, `catatan_dosen`, `created_at`, `updated_at`) VALUES
(1, 1, 'Laporan MAG-117', 'Bab 1', 'Bab 2', 'Bab 3', 'Bab 4', 'review', NULL, '2026-04-26 07:09:05', '2026-04-26 07:09:05'),
(2, 2, 'Laporan MAG-908', 'Bab 1', 'Bab 2', 'Bab 3', 'Bab 4', 'review', NULL, '2026-04-26 07:09:05', '2026-04-26 07:09:05'),
(3, 3, 'Laporan MAG-015', 'Bab 1', 'Bab 2', 'Bab 3', 'Bab 4', 'review', NULL, '2026-04-26 07:09:05', '2026-04-26 07:09:05');

-- --------------------------------------------------------

--
-- Table structure for table `logbooks`
--

CREATE TABLE `logbooks` (
  `id` bigint UNSIGNED NOT NULL,
  `magang_id` bigint UNSIGNED NOT NULL,
  `tanggal` date NOT NULL,
  `kegiatan` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `catatan_dosen` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `magangs`
--

CREATE TABLE `magangs` (
  `id` bigint UNSIGNED NOT NULL,
  `kode_magang` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `dosen_pembimbing_id` bigint UNSIGNED NOT NULL,
  `status_magang` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `magangs`
--

INSERT INTO `magangs` (`id`, `kode_magang`, `dosen_pembimbing_id`, `status_magang`, `created_at`, `updated_at`) VALUES
(1, 'MAG-117', 2, 'berjalan', '2026-04-26 07:09:05', '2026-04-26 07:09:05'),
(2, 'MAG-908', 1, 'berjalan', '2026-04-26 07:09:05', '2026-04-26 07:09:05'),
(3, 'MAG-015', 1, 'berjalan', '2026-04-26 07:09:05', '2026-04-26 07:09:05');

-- --------------------------------------------------------

--
-- Table structure for table `mahasiswas`
--

CREATE TABLE `mahasiswas` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `nim` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `prodi` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `dosen_wali_id` bigint UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `mahasiswas`
--

INSERT INTO `mahasiswas` (`id`, `user_id`, `nim`, `nama`, `prodi`, `dosen_wali_id`, `created_at`, `updated_at`) VALUES
(1, 6, '23.01.5149', 'Darrell Jenkins', 'Informatika', NULL, '2026-04-26 07:09:05', '2026-04-26 07:09:05'),
(2, 7, '23.01.5345', 'Emily Gleichner', 'Informatika', NULL, '2026-04-26 07:09:05', '2026-04-26 07:09:05'),
(3, 8, '23.01.5390', 'Parker Gleichner', 'Informatika', NULL, '2026-04-26 07:09:05', '2026-04-26 07:09:05'),
(4, 9, '23.01.5447', 'Cassandra Gusikowski', 'Informatika', NULL, '2026-04-26 07:09:05', '2026-04-26 07:09:05'),
(5, 10, '23.01.5106', 'Audie Gerhold', 'Informatika', NULL, '2026-04-26 07:09:05', '2026-04-26 07:09:05'),
(6, 11, '23.01.5956', 'Taurean Raynor', 'Informatika', NULL, '2026-04-26 07:09:05', '2026-04-26 07:09:05'),
(7, 12, '23.01.5057', 'Dr. Celia Yost Sr.', 'Informatika', NULL, '2026-04-26 07:09:05', '2026-04-26 07:09:05'),
(8, 13, '23.01.5001', 'Skyla Effertz I', 'Informatika', NULL, '2026-04-26 07:09:05', '2026-04-26 07:09:05'),
(9, 14, '23.01.5469', 'Lexi Connelly', 'Informatika', NULL, '2026-04-26 07:09:05', '2026-04-26 07:09:05'),
(10, 15, '23.01.5150', 'Nola Lubowitz', 'Informatika', NULL, '2026-04-26 07:09:05', '2026-04-26 07:09:05');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2026_04_22_165017_create_users_table', 1),
(2, '2026_04_22_165128_create_dosen_table', 1),
(3, '2026_04_22_165416_create_mahasiswa_table', 1),
(4, '2026_04_22_165450_create_magang_table', 1),
(5, '2026_04_22_165658_create_peserta_magang_table', 1),
(6, '2026_04_22_165746_create_logbook_table', 1),
(7, '2026_04_22_165812_create_laporan_table', 1),
(8, '2026_04_22_170102_create_komentar_laporan_table', 1),
(9, '2026_04_22_170159_create_revisi_laporan_table', 1),
(10, '2026_04_26_120543_create_cache_table', 1),
(11, '2026_04_26_120543_create_sessions_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `peserta_magangs`
--

CREATE TABLE `peserta_magangs` (
  `id` bigint UNSIGNED NOT NULL,
  `magang_id` bigint UNSIGNED NOT NULL,
  `mahasiswa_id` bigint UNSIGNED NOT NULL,
  `is_ketua` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `peserta_magangs`
--

INSERT INTO `peserta_magangs` (`id`, `magang_id`, `mahasiswa_id`, `is_ketua`, `created_at`, `updated_at`) VALUES
(1, 1, 6, 1, '2026-04-26 07:09:05', '2026-04-26 07:09:05'),
(2, 1, 8, 0, '2026-04-26 07:09:05', '2026-04-26 07:09:05'),
(3, 1, 9, 0, '2026-04-26 07:09:05', '2026-04-26 07:09:05'),
(4, 2, 1, 1, '2026-04-26 07:09:05', '2026-04-26 07:09:05'),
(5, 2, 8, 0, '2026-04-26 07:09:05', '2026-04-26 07:09:05'),
(6, 2, 10, 0, '2026-04-26 07:09:05', '2026-04-26 07:09:05'),
(7, 3, 8, 1, '2026-04-26 07:09:05', '2026-04-26 07:09:05'),
(8, 3, 9, 0, '2026-04-26 07:09:05', '2026-04-26 07:09:05'),
(9, 3, 10, 0, '2026-04-26 07:09:05', '2026-04-26 07:09:05');

-- --------------------------------------------------------

--
-- Table structure for table `revisi_laporans`
--

CREATE TABLE `revisi_laporans` (
  `id` bigint UNSIGNED NOT NULL,
  `laporan_id` bigint UNSIGNED NOT NULL,
  `bab_yang_diubah` int DEFAULT NULL,
  `konten_lama` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `konten_baru` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `updated_by` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('CZ2kH9NruZUzmXpMkWhozHxwSkiKGelwDAg7ImGb', 6, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoibkt0T3pqV0JHSGdNN2ZkQkd0UURzcGU0S0NHWUVjU2FWcWk5Vm9QQyI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MzE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9kYXNoYm9hcmQiO3M6NToicm91dGUiO3M6MTk6Im1haGFzaXN3YS5kYXNoYm9hcmQiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX1zOjUwOiJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aTo2O30=', 1777213108);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint UNSIGNED NOT NULL,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` enum('mahasiswa','dosen','operator','admin') COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `role`, `created_at`, `updated_at`) VALUES
(1, 'admin', '$2y$12$y9NUt.Q9UOnd54ZQTUxiBuZP5/6Y9c35HJqfmkhLUJPnnsykylTaa', 'admin', '2026-04-26 07:09:02', '2026-04-26 07:09:02'),
(2, 'operator', '$2y$12$Oo8nsQ1eEXObn5U6FSGhNuW404dkDT6o3YdUzfgBkuI8if0NA.nne', 'operator', '2026-04-26 07:09:02', '2026-04-26 07:09:02'),
(3, '1935824815', '$2y$12$sj51dodcULJxsnPzCVXtSObkxlvWOYVjOp6EemvFVVAMDJiQwmZ6G', 'dosen', '2026-04-26 07:09:02', '2026-04-26 07:09:02'),
(4, '1945363311', '$2y$12$QNMIsolGDlrhfasCiJyJn.1K5.0oF7ekH4hxT5eCXdz7tNQ2GNX1q', 'dosen', '2026-04-26 07:09:02', '2026-04-26 07:09:02'),
(5, '1973076272', '$2y$12$W9559l7PPKzQ4rAcZomT3e16jGVh2C0qxN1dUrKEvnljVwm4T8xZO', 'dosen', '2026-04-26 07:09:03', '2026-04-26 07:09:03'),
(6, '23.01.5149', '$2y$12$UN9vo7TpGDMWT20WpZIkBu6d9MrppUFM9B7tNhZm0enfvv3DSQ2KW', 'mahasiswa', '2026-04-26 07:09:03', '2026-04-26 07:09:03'),
(7, '23.01.5345', '$2y$12$upokU4.qyuHtbPpVCFJi0OuNrbsi3KATmJudg.BYIvqVCkAVDy5iC', 'mahasiswa', '2026-04-26 07:09:03', '2026-04-26 07:09:03'),
(8, '23.01.5390', '$2y$12$7tIs2XJSBYlKECygrrm/uu33DI47/8Wi.hiODcZHiUM0RJ52OWCoK', 'mahasiswa', '2026-04-26 07:09:03', '2026-04-26 07:09:03'),
(9, '23.01.5447', '$2y$12$TpG/U.dAGWVGH.nZmW40IeeVDJkefJG4kKG4jeSD05287pQPJS7Cm', 'mahasiswa', '2026-04-26 07:09:04', '2026-04-26 07:09:04'),
(10, '23.01.5106', '$2y$12$hIYaOfsDIebKzbSu1qNoL.buQu8.eA9W2b5qQwrS8KX5sqA/TWB9O', 'mahasiswa', '2026-04-26 07:09:04', '2026-04-26 07:09:04'),
(11, '23.01.5956', '$2y$12$2Fe1KD5o2Om1kbzwasQYk.zERa8VPI7/IHnmCX8B3zNrJZvAWVX7u', 'mahasiswa', '2026-04-26 07:09:04', '2026-04-26 07:09:04'),
(12, '23.01.5057', '$2y$12$xlfc/oIQDn0jP7/y8aiR4.pQwwH3FTG7FXYfrbOaUJ6/.4.4QX2nG', 'mahasiswa', '2026-04-26 07:09:04', '2026-04-26 07:09:04'),
(13, '23.01.5001', '$2y$12$Qox74ZDKs2.2lxXX37EwVeAJ9lAUwEQ0lMvbtqilUtFbkWwAFrIeS', 'mahasiswa', '2026-04-26 07:09:05', '2026-04-26 07:09:05'),
(14, '23.01.5469', '$2y$12$ZfCicQcfWjFBcH3L3kW7UuSXAtqTgBRh/20Y7NLCax/aLktqw.JoS', 'mahasiswa', '2026-04-26 07:09:05', '2026-04-26 07:09:05'),
(15, '23.01.5150', '$2y$12$S9eIYsU.2tmMst0bi45n5OqOmOfWdNwsKz1c832xcThuqUOko4pHi', 'mahasiswa', '2026-04-26 07:09:05', '2026-04-26 07:09:05');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`),
  ADD KEY `cache_expiration_index` (`expiration`);

--
-- Indexes for table `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`),
  ADD KEY `cache_locks_expiration_index` (`expiration`);

--
-- Indexes for table `dosens`
--
ALTER TABLE `dosens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `dosens_nik_unique` (`nik`),
  ADD KEY `dosens_user_id_foreign` (`user_id`);

--
-- Indexes for table `komentar_laporans`
--
ALTER TABLE `komentar_laporans`
  ADD PRIMARY KEY (`id`),
  ADD KEY `komentar_laporans_laporan_id_foreign` (`laporan_id`),
  ADD KEY `komentar_laporans_user_id_foreign` (`user_id`);

--
-- Indexes for table `laporans`
--
ALTER TABLE `laporans`
  ADD PRIMARY KEY (`id`),
  ADD KEY `laporans_magang_id_foreign` (`magang_id`);

--
-- Indexes for table `logbooks`
--
ALTER TABLE `logbooks`
  ADD PRIMARY KEY (`id`),
  ADD KEY `logbooks_magang_id_foreign` (`magang_id`);

--
-- Indexes for table `magangs`
--
ALTER TABLE `magangs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `magangs_kode_magang_unique` (`kode_magang`),
  ADD KEY `magangs_dosen_pembimbing_id_foreign` (`dosen_pembimbing_id`);

--
-- Indexes for table `mahasiswas`
--
ALTER TABLE `mahasiswas`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `mahasiswas_nim_unique` (`nim`),
  ADD KEY `mahasiswas_user_id_foreign` (`user_id`),
  ADD KEY `mahasiswas_dosen_wali_id_foreign` (`dosen_wali_id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `peserta_magangs`
--
ALTER TABLE `peserta_magangs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `peserta_magangs_magang_id_foreign` (`magang_id`),
  ADD KEY `peserta_magangs_mahasiswa_id_foreign` (`mahasiswa_id`);

--
-- Indexes for table `revisi_laporans`
--
ALTER TABLE `revisi_laporans`
  ADD PRIMARY KEY (`id`),
  ADD KEY `revisi_laporans_laporan_id_foreign` (`laporan_id`),
  ADD KEY `revisi_laporans_updated_by_foreign` (`updated_by`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_username_unique` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `dosens`
--
ALTER TABLE `dosens`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `komentar_laporans`
--
ALTER TABLE `komentar_laporans`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `laporans`
--
ALTER TABLE `laporans`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `logbooks`
--
ALTER TABLE `logbooks`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `magangs`
--
ALTER TABLE `magangs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `mahasiswas`
--
ALTER TABLE `mahasiswas`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `peserta_magangs`
--
ALTER TABLE `peserta_magangs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `revisi_laporans`
--
ALTER TABLE `revisi_laporans`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `dosens`
--
ALTER TABLE `dosens`
  ADD CONSTRAINT `dosens_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `komentar_laporans`
--
ALTER TABLE `komentar_laporans`
  ADD CONSTRAINT `komentar_laporans_laporan_id_foreign` FOREIGN KEY (`laporan_id`) REFERENCES `laporans` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `komentar_laporans_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `laporans`
--
ALTER TABLE `laporans`
  ADD CONSTRAINT `laporans_magang_id_foreign` FOREIGN KEY (`magang_id`) REFERENCES `magangs` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `logbooks`
--
ALTER TABLE `logbooks`
  ADD CONSTRAINT `logbooks_magang_id_foreign` FOREIGN KEY (`magang_id`) REFERENCES `magangs` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `magangs`
--
ALTER TABLE `magangs`
  ADD CONSTRAINT `magangs_dosen_pembimbing_id_foreign` FOREIGN KEY (`dosen_pembimbing_id`) REFERENCES `dosens` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `mahasiswas`
--
ALTER TABLE `mahasiswas`
  ADD CONSTRAINT `mahasiswas_dosen_wali_id_foreign` FOREIGN KEY (`dosen_wali_id`) REFERENCES `dosens` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `mahasiswas_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `peserta_magangs`
--
ALTER TABLE `peserta_magangs`
  ADD CONSTRAINT `peserta_magangs_magang_id_foreign` FOREIGN KEY (`magang_id`) REFERENCES `magangs` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `peserta_magangs_mahasiswa_id_foreign` FOREIGN KEY (`mahasiswa_id`) REFERENCES `mahasiswas` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `revisi_laporans`
--
ALTER TABLE `revisi_laporans`
  ADD CONSTRAINT `revisi_laporans_laporan_id_foreign` FOREIGN KEY (`laporan_id`) REFERENCES `laporans` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `revisi_laporans_updated_by_foreign` FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
