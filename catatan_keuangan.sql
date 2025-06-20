-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 20 Jun 2025 pada 11.14
-- Versi server: 10.4.32-MariaDB
-- Versi PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `catatan_keuangan`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `failed_jobs`
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
-- Struktur dari tabel `jobs`
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
-- Struktur dari tabel `job_batches`
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
-- Struktur dari tabel `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2025_05_05_034145_create_transactions_table', 2),
(5, '2025_06_20_085519_create_personal_access_tokens_table', 3);

-- --------------------------------------------------------

--
-- Struktur dari tabel `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `personal_access_tokens`
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

--
-- Dumping data untuk tabel `personal_access_tokens`
--

INSERT INTO `personal_access_tokens` (`id`, `tokenable_type`, `tokenable_id`, `name`, `token`, `abilities`, `last_used_at`, `expires_at`, `created_at`, `updated_at`) VALUES
(1, 'App\\Models\\User', 2, 'auth_token', '8cae9781de200429aa643348707a2c3913b7957e04b663ef52e0163b30ccdeea', '[\"*\"]', NULL, NULL, '2025-06-20 01:55:44', '2025-06-20 01:55:44'),
(2, 'App\\Models\\User', 2, 'auth_token', 'adf83980aef0d589d2c482b7fe68ebbf4adc8917676828a8158acd43313bb68b', '[\"*\"]', NULL, NULL, '2025-06-20 02:02:24', '2025-06-20 02:02:24'),
(3, 'App\\Models\\User', 2, 'auth_token', '70840f9133a4f2c38f3e899dc852e212834c3a1ef9f7fbdc06acc408629eb0a6', '[\"*\"]', '2025-06-20 02:05:37', NULL, '2025-06-20 02:05:08', '2025-06-20 02:05:37');

-- --------------------------------------------------------

--
-- Struktur dari tabel `sessions`
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
-- Dumping data untuk tabel `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('2PAgbHpc9jfs9cuhRqzdMAfUQW7D5hh5WK13CkE8', 2, '127.0.0.1', 'PostmanRuntime/7.44.1', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoiU0Exb3F0cUJCVjJldHlsbG81Sk9vTGl2d3c3RlNhMENWdXFIQjhlUCI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzQ6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC90cmFuc2FjdGlvbnMiO31zOjUwOiJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aToyO3M6NDoiYXV0aCI7YToxOntzOjIxOiJwYXNzd29yZF9jb25maXJtZWRfYXQiO2k6MTc1MDQwNjYxNjt9fQ==', 1750406672),
('R1JhtEa9lzx9QlZiwNN6cx66AOeGJF9u4KlreJvs', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiWmsyNmlneHZTQkQ3WUdLeWxDODFvZ1VXaHNQbW9yUmdzM25idHBTVCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly9sb2NhbGhvc3Q6ODAwMCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1750405469);

-- --------------------------------------------------------

--
-- Struktur dari tabel `transactions`
--

CREATE TABLE `transactions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `description` varchar(255) NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `type` enum('income','expense') NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `transactions`
--

INSERT INTO `transactions` (`id`, `user_id`, `description`, `amount`, `type`, `created_at`, `updated_at`) VALUES
(1, 2, 'tes', 20000.00, 'income', '2025-05-09 21:48:00', '2025-05-09 21:48:00'),
(2, 2, 'jajan', 1000.00, 'expense', '2025-05-09 21:48:18', '2025-05-09 21:48:18'),
(3, 3, 'tess', 900000.00, 'income', '2025-05-09 22:06:20', '2025-05-09 22:06:20'),
(4, 2, 'Salary', 5000000.00, 'income', '2025-05-01 01:30:00', '2025-05-01 01:30:00'),
(5, 2, 'Investment returns', 1500000.00, 'income', '2025-05-02 02:15:00', '2025-05-02 02:15:00'),
(6, 2, 'Freelance project', 2000000.00, 'income', '2025-05-03 07:20:00', '2025-05-03 07:20:00'),
(7, 2, 'Bonus', 3000000.00, 'income', '2025-05-04 09:45:00', '2025-05-04 09:45:00'),
(8, 2, 'Online sales', 750000.00, 'income', '2025-05-05 03:30:00', '2025-05-05 03:30:00'),
(9, 2, 'Consulting fee', 1200000.00, 'income', '2025-05-06 04:20:00', '2025-05-06 04:20:00'),
(10, 2, 'Dividend', 350000.00, 'income', '2025-05-07 02:00:00', '2025-05-07 02:00:00'),
(11, 2, 'Side hustle', 850000.00, 'income', '2025-05-08 06:15:00', '2025-05-08 06:15:00'),
(12, 2, 'Tax return', 1750000.00, 'income', '2025-05-09 08:30:00', '2025-05-09 08:30:00'),
(13, 2, 'Gift received', 500000.00, 'income', '2025-05-01 10:45:00', '2025-05-01 10:45:00'),
(14, 2, 'Project completion bonus', 2500000.00, 'income', '2025-04-28 02:15:00', '2025-04-28 02:15:00'),
(15, 2, 'YouTube monetization', 250000.00, 'income', '2025-04-29 07:30:00', '2025-04-29 07:30:00'),
(16, 2, 'Rental income', 3500000.00, 'income', '2025-04-30 04:45:00', '2025-04-30 04:45:00'),
(17, 2, 'Stock sale profit', 1800000.00, 'income', '2025-05-02 09:20:00', '2025-05-02 09:20:00'),
(18, 2, 'Contract payment', 4000000.00, 'income', '2025-05-04 03:10:00', '2025-05-04 03:10:00'),
(19, 2, 'Interest payment', 125000.00, 'income', '2025-05-06 08:25:00', '2025-05-06 08:25:00'),
(20, 2, 'Commission', 950000.00, 'income', '2025-05-08 02:40:00', '2025-05-08 02:40:00'),
(21, 2, 'Royalty payment', 650000.00, 'income', '2025-05-10 07:15:00', '2025-05-10 07:15:00'),
(22, 2, 'Sponsorship deal', 1350000.00, 'income', '2025-05-07 04:30:00', '2025-05-07 04:30:00'),
(23, 2, 'Performance bonus', 2750000.00, 'income', '2025-05-09 09:45:00', '2025-05-09 09:45:00'),
(24, 2, 'Groceries', 350000.00, 'expense', '2025-05-01 08:20:00', '2025-05-01 08:20:00'),
(25, 2, 'Electricity bill', 275000.00, 'expense', '2025-05-02 05:30:00', '2025-05-02 05:30:00'),
(26, 2, 'Internet subscription', 450000.00, 'expense', '2025-05-03 03:15:00', '2025-05-03 03:15:00'),
(27, 2, 'Fuel', 200000.00, 'expense', '2025-05-04 11:00:00', '2025-05-04 11:00:00'),
(28, 2, 'Dinner at restaurant', 320000.00, 'expense', '2025-05-05 12:30:00', '2025-05-05 12:30:00'),
(29, 2, 'Phone bill', 175000.00, 'expense', '2025-05-06 07:45:00', '2025-05-06 07:45:00'),
(30, 2, 'Gym membership', 300000.00, 'expense', '2025-05-07 01:10:00', '2025-05-07 01:10:00'),
(31, 2, 'Home repairs', 850000.00, 'expense', '2025-05-08 04:25:00', '2025-05-08 04:25:00'),
(32, 2, 'New laptop', 12000000.00, 'expense', '2025-05-09 06:40:00', '2025-05-09 06:40:00'),
(33, 2, 'Health insurance', 750000.00, 'expense', '2025-05-01 09:55:00', '2025-05-01 09:55:00'),
(34, 2, 'Transportation', 125000.00, 'expense', '2025-04-28 10:20:00', '2025-04-28 10:20:00'),
(35, 2, 'Movie tickets', 100000.00, 'expense', '2025-04-29 13:30:00', '2025-04-29 13:30:00'),
(36, 2, 'Clothing', 650000.00, 'expense', '2025-04-30 08:45:00', '2025-04-30 08:45:00'),
(37, 2, 'Coffee shop', 85000.00, 'expense', '2025-05-02 01:25:00', '2025-05-02 01:25:00'),
(38, 2, 'Car maintenance', 950000.00, 'expense', '2025-05-04 07:10:00', '2025-05-04 07:10:00'),
(39, 2, 'Books', 250000.00, 'expense', '2025-05-06 03:35:00', '2025-05-06 03:35:00'),
(40, 2, 'Home appliance', 1650000.00, 'expense', '2025-05-08 09:50:00', '2025-05-08 09:50:00'),
(41, 2, 'Lunch with colleagues', 275000.00, 'expense', '2025-05-10 05:15:00', '2025-05-10 05:15:00'),
(42, 2, 'Dental checkup', 500000.00, 'expense', '2025-05-07 02:20:00', '2025-05-07 02:20:00'),
(43, 2, 'Software subscription', 350000.00, 'expense', '2025-05-09 08:05:00', '2025-05-09 08:05:00'),
(44, 2, 'Hair salon', 200000.00, 'expense', '2025-05-03 09:40:00', '2025-05-03 09:40:00'),
(45, 2, 'Monthly rent', 3500000.00, 'expense', '2025-05-05 02:55:00', '2025-05-05 02:55:00'),
(46, 2, 'Office supplies', 175000.00, 'expense', '2025-05-01 06:30:00', '2025-05-01 06:30:00'),
(47, 2, 'Water bill', 150000.00, 'expense', '2025-05-04 04:25:00', '2025-05-04 04:25:00'),
(48, 2, 'Mobile app subscription', 79000.00, 'expense', '2025-05-06 10:40:00', '2025-05-06 10:40:00'),
(49, 3, 'Monthly salary', 7500000.00, 'income', '2025-05-01 01:00:00', '2025-05-01 01:00:00'),
(50, 3, 'Client payment', 3500000.00, 'income', '2025-05-02 02:30:00', '2025-05-02 02:30:00'),
(51, 3, 'Project bonus', 2000000.00, 'income', '2025-05-03 07:00:00', '2025-05-03 07:00:00'),
(52, 3, 'Investment dividend', 1250000.00, 'income', '2025-05-04 09:15:00', '2025-05-04 09:15:00'),
(53, 3, 'Consulting fee', 1800000.00, 'income', '2025-05-05 03:45:00', '2025-05-05 03:45:00'),
(54, 3, 'Freelance work', 2500000.00, 'income', '2025-05-06 04:30:00', '2025-05-06 04:30:00'),
(55, 3, 'Property rental', 4000000.00, 'income', '2025-05-07 02:15:00', '2025-05-07 02:15:00'),
(56, 3, 'Online course sales', 1650000.00, 'income', '2025-05-08 06:00:00', '2025-05-08 06:00:00'),
(57, 3, 'Stock profit', 2250000.00, 'income', '2025-05-09 08:45:00', '2025-05-09 08:45:00'),
(58, 3, 'Contract payment', 3750000.00, 'income', '2025-05-01 10:30:00', '2025-05-01 10:30:00'),
(59, 3, 'Affiliate commission', 850000.00, 'income', '2025-04-28 02:45:00', '2025-04-28 02:45:00'),
(60, 3, 'Workshop payment', 3000000.00, 'income', '2025-04-29 07:15:00', '2025-04-29 07:15:00'),
(61, 3, 'Business profit share', 5000000.00, 'income', '2025-04-30 04:00:00', '2025-04-30 04:00:00'),
(62, 3, 'Royalty payment', 1450000.00, 'income', '2025-05-02 09:30:00', '2025-05-02 09:30:00'),
(63, 3, 'Speaking engagement', 2750000.00, 'income', '2025-05-04 03:45:00', '2025-05-04 03:45:00'),
(64, 3, 'Digital product sales', 1350000.00, 'income', '2025-05-06 08:00:00', '2025-05-06 08:00:00'),
(65, 3, 'Social media sponsorship', 1800000.00, 'income', '2025-05-08 02:30:00', '2025-05-08 02:30:00'),
(66, 3, 'Online tutoring', 950000.00, 'income', '2025-05-10 07:30:00', '2025-05-10 07:30:00'),
(67, 3, 'Consulting retainer', 3250000.00, 'income', '2025-05-07 04:15:00', '2025-05-07 04:15:00'),
(68, 3, 'Year-end bonus', 5500000.00, 'income', '2025-05-09 09:30:00', '2025-05-09 09:30:00'),
(69, 3, 'Project milestone payment', 2850000.00, 'income', '2025-05-03 06:20:00', '2025-05-03 06:20:00'),
(70, 3, 'Investment returns', 1750000.00, 'income', '2025-05-05 08:10:00', '2025-05-05 08:10:00'),
(71, 3, 'Consulting project', 4250000.00, 'income', '2025-05-02 03:40:00', '2025-05-02 03:40:00'),
(72, 3, 'Dividend payment', 975000.00, 'income', '2025-05-07 05:25:00', '2025-05-07 05:25:00'),
(73, 3, 'Content creation payment', 1550000.00, 'income', '2025-05-09 07:35:00', '2025-05-09 07:35:00'),
(74, 3, 'Rent payment', 5000000.00, 'expense', '2025-05-01 08:00:00', '2025-05-01 08:00:00'),
(75, 3, 'Groceries', 750000.00, 'expense', '2025-05-02 05:45:00', '2025-05-02 05:45:00'),
(76, 3, 'Electricity bill', 450000.00, 'expense', '2025-05-03 03:30:00', '2025-05-03 03:30:00'),
(77, 3, 'Car installment', 3500000.00, 'expense', '2025-05-04 11:15:00', '2025-05-04 11:15:00'),
(78, 3, 'Dinner date', 850000.00, 'expense', '2025-05-05 12:45:00', '2025-05-05 12:45:00'),
(79, 3, 'Phone bill', 250000.00, 'expense', '2025-05-06 07:30:00', '2025-05-06 07:30:00'),
(80, 3, 'Fitness membership', 750000.00, 'expense', '2025-05-07 01:00:00', '2025-05-07 01:00:00'),
(81, 3, 'Home renovation', 15000000.00, 'expense', '2025-05-08 04:45:00', '2025-05-08 04:45:00'),
(82, 3, 'Office equipment', 4500000.00, 'expense', '2025-05-09 06:15:00', '2025-05-09 06:15:00'),
(83, 3, 'Health insurance', 1250000.00, 'expense', '2025-05-01 09:30:00', '2025-05-01 09:30:00'),
(84, 3, 'Fuel expenses', 350000.00, 'expense', '2025-04-28 10:45:00', '2025-04-28 10:45:00'),
(85, 3, 'Entertainment', 650000.00, 'expense', '2025-04-29 13:00:00', '2025-04-29 13:00:00'),
(86, 3, 'Shopping spree', 2750000.00, 'expense', '2025-04-30 08:15:00', '2025-04-30 08:15:00'),
(87, 3, 'Business lunch', 475000.00, 'expense', '2025-05-02 01:45:00', '2025-05-02 01:45:00'),
(88, 3, 'Vehicle service', 1250000.00, 'expense', '2025-05-04 07:40:00', '2025-05-04 07:40:00'),
(89, 3, 'Educational materials', 850000.00, 'expense', '2025-05-06 03:15:00', '2025-05-06 03:15:00'),
(90, 3, 'Home appliance', 3250000.00, 'expense', '2025-05-08 09:20:00', '2025-05-08 09:20:00'),
(91, 3, 'Business dinner', 950000.00, 'expense', '2025-05-10 05:45:00', '2025-05-10 05:45:00'),
(92, 3, 'Medical checkup', 1750000.00, 'expense', '2025-05-07 02:50:00', '2025-05-07 02:50:00'),
(93, 3, 'Software license', 2500000.00, 'expense', '2025-05-09 08:25:00', '2025-05-09 08:25:00'),
(94, 3, 'Internet service', 550000.00, 'expense', '2025-05-03 09:15:00', '2025-05-03 09:15:00'),
(95, 3, 'Property tax', 2250000.00, 'expense', '2025-05-05 02:35:00', '2025-05-05 02:35:00'),
(96, 3, 'Professional development', 1750000.00, 'expense', '2025-05-01 06:55:00', '2025-05-01 06:55:00'),
(97, 3, 'Travel expenses', 3750000.00, 'expense', '2025-05-04 04:10:00', '2025-05-04 04:10:00'),
(98, 3, 'Digital subscription', 175000.00, 'expense', '2025-05-06 10:25:00', '2025-05-06 10:25:00');

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Adzi Bilal', 'adzibilal02@gmail.com', NULL, '$2y$12$sz.ON4sOa02Whlrh..2HDeFP9czdNVJ6LxAuJT73pEzRaakQH9XIy', NULL, '2025-05-04 21:07:22', '2025-05-04 21:07:22'),
(2, 'admin', 'admin@gmail.com', NULL, '$2y$12$rgQPH0017SRdYbtdl1A1qe6M3/MkLrpbdZjOk0LHXjrn4JK2SKW9S', NULL, '2025-05-09 21:46:54', '2025-05-09 21:46:54'),
(3, 'admin2', 'admin2@gmail.com', NULL, '$2y$12$jcY4lU4heOVHnFmpw4tQCumnPRyE26cxaoJcnyLGXcXgFxkuBH/uS', NULL, '2025-05-09 22:06:05', '2025-05-09 22:06:05');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- Indeks untuk tabel `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`);

--
-- Indeks untuk tabel `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indeks untuk tabel `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indeks untuk tabel `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indeks untuk tabel `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indeks untuk tabel `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indeks untuk tabel `transactions`
--
ALTER TABLE `transactions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `transactions_user_id_foreign` (`user_id`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `transactions`
--
ALTER TABLE `transactions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=99;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `transactions`
--
ALTER TABLE `transactions`
  ADD CONSTRAINT `transactions_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
