-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 02, 2024 at 05:35 PM
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
-- Database: `binbetter_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `company_settings`
--

CREATE TABLE `company_settings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `company_logo` varchar(255) DEFAULT NULL,
  `company_email` varchar(255) DEFAULT NULL,
  `company_phone` varchar(20) DEFAULT NULL,
  `company_address` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `sender_id` int(11) NOT NULL,
  `recipient_id` int(11) NOT NULL,
  `text` text DEFAULT NULL,
  `is_file` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`id`, `sender_id`, `recipient_id`, `text`, `is_file`, `created_at`, `updated_at`) VALUES
(1, 1, 2, 'Hai', NULL, '2024-09-01 17:17:17', '2024-09-01 17:17:17'),
(2, 2, 1, 'Hello', NULL, '2024-09-01 17:17:17', '2024-09-01 17:17:17'),
(3, 1, 2, 'Why you no attendance record.', NULL, '2024-09-01 17:34:39', '2024-09-01 17:34:39'),
(4, 2, 1, 'Done.', NULL, '2024-09-01 17:34:39', '2024-09-01 17:34:39'),
(5, 1, 2, 'Thank you.', NULL, '2024-09-01 17:37:56', '2024-09-01 17:37:56'),
(6, 2, 1, 'Ur Welcome.', NULL, '2024-09-01 17:37:56', '2024-09-01 17:37:56'),
(7, 1, 2, 'Please dont forget next time', NULL, '2024-09-01 17:39:07', '2024-09-01 17:39:07'),
(8, 2, 1, 'Noted.', NULL, '2024-09-01 17:39:07', '2024-09-01 17:39:07'),
(11, 1, 2, 'Keep up the good work.', NULL, '2024-09-01 17:46:16', '2024-09-01 17:46:16'),
(12, 2, 1, 'Noted.', NULL, '2024-09-01 17:46:16', '2024-09-01 17:46:16'),
(13, 1, 2, 'Nice', NULL, '2024-09-01 17:55:07', '2024-09-01 17:55:07'),
(14, 2, 1, 'Welcome', NULL, '2024-09-01 17:55:07', '2024-09-01 17:55:07'),
(72, 1, 2, 'Goodmorning', NULL, '2024-09-02 03:25:41', '2024-09-02 03:25:41'),
(73, 1, 2, 'Please reply', NULL, '2024-09-02 04:23:46', '2024-09-02 04:23:46');

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
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2024_07_24_053650_add_otp_to_users_table', 1),
(6, '2024_08_06_011609_add_profile_to_users_table', 1),
(7, '2024_08_06_225508_create_company_settings_table', 1),
(8, '2024_09_01_222930_create_messages_table', 2),
(9, '2024_09_02_113157_add_is_login_users_table', 3),
(10, '2024_09_02_220523_create_services_table', 4);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
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
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `services`
--

CREATE TABLE `services` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `service_type` varchar(255) NOT NULL,
  `service_points` int(11) NOT NULL,
  `description` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `services`
--

INSERT INTO `services` (`id`, `service_type`, `service_points`, `description`, `created_at`, `updated_at`) VALUES
(2, 'Clean-Up Drive', 50, '<p>As a social responsibility, a small population of good samaritans and concerned citizens come forward to tackle the waste problem through clean-up drives. Clean-up drives are an effective way to clear waste from natural habitats. Moreover, the visual impact of seeing others cleaning up a particular place littered with waste can have a domino effect and compel people to reflect on their actions.</p>', '2024-09-02 14:40:07', '2024-09-02 14:54:25');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `profile` varchar(255) DEFAULT NULL,
  `role` enum('Superadmin','LGU','NGO','Resident') NOT NULL DEFAULT 'Resident',
  `otp_code` varchar(255) DEFAULT NULL,
  `otp_expire` timestamp NULL DEFAULT NULL,
  `isLogin` varchar(255) DEFAULT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `email_verified_at`, `password`, `profile`, `role`, `otp_code`, `otp_expire`, `isLogin`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Admin User', 'admin@example.com', '2024-09-01 14:22:24', '$2y$10$QekA6RxEDszZho2UPGwT9uMFzTHOFy/thVZ/M/oSZTQTOD7iT/W1.', NULL, 'Superadmin', NULL, NULL, '0', NULL, '2024-09-01 14:17:14', '2024-09-02 15:27:29'),
(2, 'LGU User', 'lgu@example.com', NULL, '$2y$10$TJe0283P1gmQUrdnan4fNOT84iq9Choz9D8EYhRTJIZ315IsGQU5C', NULL, 'LGU', NULL, NULL, '1', NULL, '2024-09-01 14:17:14', '2024-09-01 14:17:14'),
(3, 'NGO User', 'ngo@example.com', NULL, '$2y$10$7DpCpNU3BbPRSU2726gESO48cm3HfrfT90/JyeCuSaGZg1wwhasPm', NULL, 'NGO', NULL, NULL, NULL, NULL, '2024-09-01 14:17:14', '2024-09-01 14:17:14'),
(4, 'Resident User', 'resident@example.com', NULL, '$2y$10$s8FNQYRPuCG1rOYxRIL/ducGzLkwB5Twc/Xxc8e49/NaZy04cL.56', NULL, 'Resident', NULL, NULL, NULL, NULL, '2024-09-01 14:17:14', '2024-09-01 14:17:14');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `company_settings`
--
ALTER TABLE `company_settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
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
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `services`
--
ALTER TABLE `services`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_username_unique` (`username`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `company_settings`
--
ALTER TABLE `company_settings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=74;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `services`
--
ALTER TABLE `services`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
