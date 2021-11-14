-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 31, 2021 at 05:18 AM
-- Server version: 10.4.19-MariaDB
-- PHP Version: 8.0.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `nirvik`
--

-- --------------------------------------------------------

--
-- Table structure for table `abouts`
--

CREATE TABLE `abouts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `description` varchar(999) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `abouts`
--

INSERT INTO `abouts` (`id`, `description`, `created_at`, `updated_at`) VALUES
(1, '<p><strong style=\"font-family: &quot;Open Sans&quot;, Arial, sans-serif; font-size: 14px; text-align: justify;\"><font color=\"#ff0000\">Lorem Ipsum</font></strong><span style=\"font-family: &quot;Open Sans&quot;, Arial, sans-serif; font-size: 14px; text-align: justify;\"><font color=\"#ffffff\">&nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to mak</font><font style=\"\"><font color=\"#ffffff\">e a type specimen </font><font color=\"#efc631\">book</font><font color=\"#ffffff\">.</font></font></span></p>', '2021-08-05 22:58:06', '2021-08-09 06:58:35');

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
(4, '2021_07_13_055801_create_sections_table', 2),
(5, '2021_07_13_060046_create_shifts_table', 3),
(6, '2021_07_17_085457_create_user_details_table', 4),
(7, '2021_07_17_091746_create_mobile_number_details_table', 5),
(8, '2021_08_06_044341_create_abouts_table', 6),
(10, '2021_08_11_142722_create_news_table', 7);

-- --------------------------------------------------------

--
-- Table structure for table `mobile_number_details`
--

CREATE TABLE `mobile_number_details` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `mobile` varchar(15) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `mobile_number_details`
--

INSERT INTO `mobile_number_details` (`id`, `user_id`, `mobile`, `created_at`, `updated_at`) VALUES
(25, 31, '01721914666', '2021-07-29 19:25:38', '2021-07-29 19:25:38'),
(26, 31, '01924146965', '2021-07-29 19:25:38', '2021-07-29 19:25:38'),
(27, 32, NULL, '2021-07-29 19:48:39', '2021-07-29 19:48:39'),
(28, 33, NULL, '2021-07-29 19:59:00', '2021-07-29 19:59:00'),
(30, 34, NULL, '2021-07-29 20:01:28', '2021-07-29 20:01:28'),
(32, 35, NULL, '2021-07-31 06:27:15', '2021-07-31 06:27:15');

-- --------------------------------------------------------

--
-- Table structure for table `news`
--

CREATE TABLE `news` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `heading` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `body` varchar(999) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `active` bigint(20) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `news`
--

INSERT INTO `news` (`id`, `heading`, `body`, `active`, `created_at`, `updated_at`) VALUES
(1, 'China Lab Coronavirus: চিনের ল্যাবেই তৈরি হয়েছে করোনাভাইরাস, দাবি US GOP রিপোর্টে', '<p><span style=\"margin: 0px; padding: 0px; outline: 0px; font-family: solaimanlipi, &quot;Noto Sans&quot;, Roboto, sans-serif; font-size: 18px; text-align: justify; color: rgb(128, 0, 128);\"><span style=\"margin: 0px; padding: 0px; outline: 0px; font-weight: 700;\">উহান:</span>&nbsp;</span><span style=\"color: rgb(46, 46, 46); font-family: solaimanlipi, &quot;Noto Sans&quot;, Roboto, sans-serif; font-size: 18px; text-align: justify;\">করোনাভাইরাসের উৎপত্তি কোথায় ? এই মারণ ভাইরাস হঠাৎ এল কোত্থেকে ? এই প্রশ্নের উত্তর গত দেড় বছর ধরে খুঁজে বেড়াচ্ছেন বিজ্ঞানীরা ৷ এবার ফের এই ভাইরাস ছড়ানোর জন্য চিনের ল্যাবকেই কাঠগড়ায় দাঁড় করানো হল ৷ আমেরিকার&nbsp;Foreign Affairs Committee of the Grand Old Party (GOP) প্রকাশিত রিপোর্টে দাবি করা হল- করোনাভাইরাস জিনগত পরিবর্তন করা ভাইরাস ৷ উহান ইনস্টিটিউট অফ ভাইরোলজির গবেষণাগার থেকেই এটি কোনওভাবে ছড়িয়ে পড়েছিল ৷</span><br></p>', NULL, '2021-08-11 10:35:45', '2021-08-11 10:35:45');

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `password_resets`
--

INSERT INTO `password_resets` (`email`, `token`, `created_at`) VALUES
('rafidalridwan@gmail.com', '$2y$10$z6/tJfEo3pXX1I22E27yXOY2Cxghx61L4ABI7GuB2ubkQyZGNbtpW', '2021-08-09 06:13:22');

-- --------------------------------------------------------

--
-- Table structure for table `sections`
--

CREATE TABLE `sections` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `shift` bigint(20) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sections`
--

INSERT INTO `sections` (`id`, `name`, `shift`, `created_at`, `updated_at`) VALUES
(1, 'A', 1, '2021-07-13 06:01:36', NULL),
(2, 'B', 1, '2021-07-13 06:02:04', NULL),
(3, 'C', 2, '2021-07-13 06:02:23', NULL),
(4, 'D', 2, '2021-07-13 06:02:41', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `shifts`
--

CREATE TABLE `shifts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `shifts`
--

INSERT INTO `shifts` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Morning', '2021-07-13 06:03:05', NULL),
(2, 'Day', '2021-07-13 06:03:22', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` bigint(20) DEFAULT 3 COMMENT '1=SuperAdmin; 2=Admin; 3=User;',
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `type`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'superadmin', NULL, NULL, '$2y$10$0BR3dsCiIJiAf1V5j3KNLuktzPnC4jDo.SqT0n4m1hnMFUqz5Bxte', 1, NULL, '2021-07-12 22:39:06', '2021-07-12 22:39:06'),
(2, 'admin', NULL, NULL, '$2y$10$LMZ5W5v.Tp0MytkW2RcW3ez/iBGB1XSdMWICWF8NhwhcLPQvEMIxq', 2, NULL, '2021-07-12 23:20:58', '2021-08-03 06:43:38'),
(31, 'a20', 'rafidalridwan@gmail.com', NULL, '$2y$10$Z5cpEFdd0MxEhjW7oEEui.zxPE6u7QZigufjEUUHduAiNJVq2yjQy', 3, '5QGY5Suj7yw35yJqsvh7I4ZawG9I7ggzPuORWrsyjkJoTT0W9zIjl8iaTCfN', '2021-07-24 21:34:56', '2021-07-31 00:45:44'),
(32, 'a1', NULL, NULL, '$2y$10$feyJbgEd4WhgSkoMOrv.cupBfeeHk22b1JqWROOlfELrdA6bSeNoe', 3, NULL, '2021-07-29 19:48:39', '2021-07-29 19:48:39'),
(33, 'a2', NULL, NULL, '$2y$10$Rq9RlXgIzpiuMppzE4NMIuRm5T786fTG5PIUtlfa6TEExkJkAfF9i', 3, NULL, '2021-07-29 19:59:00', '2021-07-29 19:59:00'),
(34, 'a3', NULL, NULL, '$2y$10$XeMvEWYqjB0McN4EQleZOOLtI2h68bEbK05ua8xouHtOyLbyO0EmS', 3, NULL, '2021-07-29 20:00:03', '2021-07-29 20:01:28'),
(35, 'a4', 'a4@gmail.com', NULL, '$2y$10$Ts6h.1mUtpPOOFxU2Ep3cerxcMkCqhPGu0X5F/LHEGNp/QwZcWGnq', 3, NULL, '2021-07-31 06:26:18', '2021-07-31 06:27:15'),
(36, 'a5', NULL, NULL, '$2y$10$6LoH8kfd/ceu1MBrtCCrBuevEe8sRv/K/u9mU0DzzepCxnk5TjRRm', 3, NULL, '2021-08-07 06:41:22', '2021-08-07 06:41:22'),
(37, 'a6', NULL, NULL, '$2y$10$6eh9GqK4ydJDBaj0V4BAfexVwHLoIhZXzEJsNQt/WQZ2VF2gwM1CK', 3, NULL, '2021-08-07 07:02:29', '2021-08-07 07:02:29'),
(38, 'a7', NULL, NULL, '$2y$10$POLWMEjPJ9ajezAIVbklx.P24qo7wH7UjeRm0y3Z/07P7I9gU5HNC', 3, NULL, '2021-08-07 07:28:51', '2021-08-07 07:28:51'),
(39, 'a8', NULL, NULL, '$2y$10$ErJyhghv2jfCXbicKUBzWeT0zgje66dT49RLWn1RXsaFTOin6WgGq', 2, NULL, '2021-08-07 07:29:45', '2021-08-07 07:29:45'),
(40, 'a70', NULL, NULL, '$2y$10$soUPFcB4DvagBawIbpGj6uC1WqRj/syNj49362oq3CkmhboLg278W', 3, NULL, '2021-08-08 08:12:21', '2021-08-08 08:12:21');

-- --------------------------------------------------------

--
-- Table structure for table `user_details`
--

CREATE TABLE `user_details` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `full_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `current_city` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `designation` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `office_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `current_address` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `permanent_address` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `marital_status` bigint(20) DEFAULT NULL,
  `spouse_name` varchar(250) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `number_of_child` bigint(20) DEFAULT NULL,
  `section` bigint(20) DEFAULT NULL,
  `shift` bigint(20) DEFAULT NULL,
  `religion` bigint(20) DEFAULT NULL,
  `roll_no` bigint(20) DEFAULT NULL,
  `attachment` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user_details`
--

INSERT INTO `user_details` (`id`, `user_id`, `full_name`, `current_city`, `designation`, `office_name`, `current_address`, `permanent_address`, `marital_status`, `spouse_name`, `number_of_child`, `section`, `shift`, `religion`, `roll_no`, `attachment`, `created_at`, `updated_at`) VALUES
(2, 31, 'Rafid Al Ridwan', 'Dhaka', 'Jr. Software Engineer', 'Technovista Limited', 'House no. 45, Road no: 12, Section 10, Uttara Model Town, Dhaka', NULL, 2, 'Lithi Zaben', NULL, 1, 1, 1, 20, '16275652971627531505154.jpg', '2021-07-24 21:34:56', '2021-07-29 19:24:56'),
(4, 32, 'Toufik Hasan', 'Dhaka', NULL, NULL, NULL, NULL, 1, NULL, NULL, 1, 1, 1, NULL, NULL, '2021-07-29 19:48:39', '2021-07-29 19:48:39'),
(5, 33, 'Wayes A Rasul', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-07-29 19:59:00', '2021-07-29 19:59:00'),
(6, 34, 'Jubair Islam', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-07-29 20:00:03', '2021-07-29 20:01:28'),
(7, 35, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-07-31 06:26:18', '2021-07-31 06:26:18'),
(8, 1, 'Super Admin', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '16279946181627531505154.jpg', NULL, '2021-08-03 06:43:38'),
(9, 36, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-08-07 06:41:22', '2021-08-07 06:41:22'),
(10, 37, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-08-07 07:02:29', '2021-08-07 07:02:29'),
(11, 38, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-08-07 07:28:51', '2021-08-07 07:28:51'),
(12, 39, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-08-07 07:29:45', '2021-08-07 07:29:45'),
(13, 40, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-08-08 08:12:21', '2021-08-08 08:12:21');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `abouts`
--
ALTER TABLE `abouts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mobile_number_details`
--
ALTER TABLE `mobile_number_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `news`
--
ALTER TABLE `news`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `sections`
--
ALTER TABLE `sections`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `shifts`
--
ALTER TABLE `shifts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_name_unique` (`name`);

--
-- Indexes for table `user_details`
--
ALTER TABLE `user_details`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `abouts`
--
ALTER TABLE `abouts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `mobile_number_details`
--
ALTER TABLE `mobile_number_details`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `news`
--
ALTER TABLE `news`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `sections`
--
ALTER TABLE `sections`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `shifts`
--
ALTER TABLE `shifts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `user_details`
--
ALTER TABLE `user_details`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
