-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 21, 2022 at 08:02 AM
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
(1, '<p><strong style=\"font-family: &quot;Open Sans&quot;, Arial, sans-serif; font-size: 14px; text-align: justify;\"><font color=\"#ff0000\">Lorem Ipsum</font></strong><span style=\"font-family: &quot;Open Sans&quot;, Arial, sans-serif; font-size: 14px; text-align: justify;\"><font color=\"#ffffff\">&nbsp;is simply dummy text of the printing </font><font color=\"#000000\" style=\"background-color: rgb(255, 255, 0);\">and typesetting industry. Lorem</font><font color=\"#ffffff\"> Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to mak</font><font style=\"\"><font color=\"#ffffff\">e a type specimen </font><font color=\"#000000\" style=\"background-color: rgb(255, 255, 0);\">book.</font></font></span></p>', '2021-08-05 22:58:06', '2022-03-30 22:58:07');

-- --------------------------------------------------------

--
-- Table structure for table `albums`
--

CREATE TABLE `albums` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `attachment` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `albums`
--

INSERT INTO `albums` (`id`, `title`, `attachment`, `created_at`, `updated_at`) VALUES
(4, 'abc', 'assets/user/landingPage/img/gallery/1650175650robot_white_blue_system_137_1366x768.jpg', '2022-04-17 00:07:30', '2022-04-17 00:07:30');

-- --------------------------------------------------------

--
-- Table structure for table `cover_pages`
--

CREATE TABLE `cover_pages` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `attachment` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cover_pages`
--

INSERT INTO `cover_pages` (`id`, `title`, `description`, `attachment`, `created_at`, `updated_at`) VALUES
(6, 'h5', '<p>hhhhh</p>', 'assets/user/landingPage/slider/images/1649567311background_spots_lines_light_85563_1366x768.jpg', '2022-04-09 23:08:32', '2022-04-09 23:08:32');

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

CREATE TABLE `events` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `date` date DEFAULT NULL,
  `venue` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `time` time DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `events`
--

INSERT INTO `events` (`id`, `title`, `description`, `date`, `venue`, `time`, `created_at`, `updated_at`) VALUES
(2, 'Accusamus', '<p><strong style=\"margin: 0px; padding: 0px; color: rgb(0, 0, 0); font-family: &quot;Open Sans&quot;, Arial, sans-serif; font-size: 14px; text-align: justify;\">Lorem Ipsum</strong><span style=\"color: rgb(0, 0, 0); font-family: &quot;Open Sans&quot;, Arial', '2022-04-02', 'Bogra Zilla School, Bogura', '17:00:00', '2022-03-27 03:45:51', '2022-03-27 20:40:56'),
(3, 'Consectetur', 'Labore excepteur <font color=\"#000000\" style=\"background-color: rgb(255, 255, 0);\">obcsdasfaadfa</font>', '2022-04-09', 'Amet', '17:30:00', '2022-03-27 04:45:26', '2022-03-27 20:29:14');

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
-- Table structure for table `galleries`
--

CREATE TABLE `galleries` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `album_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `attachment` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `galleries`
--

INSERT INTO `galleries` (`id`, `title`, `album_id`, `attachment`, `created_at`, `updated_at`) VALUES
(1, 'AAA', NULL, 'assets/user/landingPage/img/gallery/1648701037Nirvik white-01.jpg', '2022-03-30 21:36:47', '2022-03-30 22:30:38'),
(2, 'ABCC', '1', 'assets/user/landingPage/img/gallery/1649318520hexagons_shape_connections_125136_1366x768.jpg', '2022-04-07 02:02:00', '2022-04-07 02:02:00');

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
(10, '2021_08_11_142722_create_news_table', 7),
(11, '2022_03_27_073214_create_events_table', 8),
(14, '2022_03_29_024139_create_galleries_table', 11),
(15, '2022_03_29_113509_create_albums_table', 12),
(16, '2022_04_10_031239_create_cover_pages_table', 13),
(17, '2022_04_10_061801_create_settings_table', 14);

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
(27, 32, NULL, '2021-07-29 19:48:39', '2021-07-29 19:48:39'),
(32, 35, NULL, '2021-07-31 06:27:15', '2021-07-31 06:27:15'),
(40, 33, NULL, '2022-01-11 02:58:33', '2022-01-11 02:58:33'),
(45, 34, NULL, '2022-01-11 03:11:20', '2022-01-11 03:11:20'),
(54, 31, '01721914666', '2022-03-23 05:49:39', '2022-03-23 05:49:39'),
(55, 31, '01924146965', '2022-03-23 05:49:39', '2022-03-23 05:49:39');

-- --------------------------------------------------------

--
-- Table structure for table `news`
--

CREATE TABLE `news` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `heading` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `body` varchar(999) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` bigint(20) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `news`
--

INSERT INTO `news` (`id`, `heading`, `body`, `status`, `created_at`, `updated_at`) VALUES
(1, 'China Lab Coronavirus: চিনের ল্যাবেই তৈরি হয়েছে করোনাভাইরাস, দাবি US GOP রিপোর্টে', '<p><span style=\"margin: 0px; padding: 0px; outline: 0px; font-family: solaimanlipi, &quot;Noto Sans&quot;, Roboto, sans-serif; font-size: 18px; text-align: justify; color: rgb(128, 0, 128);\"><span style=\"margin: 0px; padding: 0px; outline: 0px; font-weight: 700;\">উহান:</span>&nbsp;</span><span style=\"color: rgb(46, 46, 46); font-family: solaimanlipi, &quot;Noto Sans&quot;, Roboto, sans-serif; font-size: 18px; text-align: justify;\">করোনাভাইরাসের উৎপত্তি কোথায় ? এই মারণ ভাইরাস হঠাৎ এল কোত্থেকে ? এই প্রশ্নের উত্তর গত দেড় বছর ধরে খুঁজে বেড়াচ্ছেন বিজ্ঞানীরা ৷ এবার ফের এই ভাইরাস ছড়ানোর জন্য চিনের ল্যাবকেই কাঠগড়ায় দাঁড় করানো হল ৷ আমেরিকার&nbsp;Foreign Affairs Committee of the Grand Old Party (GOP) প্রকাশিত রিপোর্টে দাবি করা হল- করোনাভাইরাস জিনগত পরিবর্তন করা ভাইরাস ৷ উহান ইনস্টিটিউট অফ ভাইরোলজির গবেষণাগার থেকেই এটি কোনওভাবে ছড়িয়ে পড়েছিল ৷</span><br></p>', 1, '2021-08-11 10:35:45', '2021-08-11 10:35:45'),
(6, 'টসে হেরে ফিল্ডিংয়ে অপরিবর্তিত বাংলাদেশ', '<div class=\"    \r\n                  bn-story-element\" style=\"color: rgb(18, 18, 18); font-family: Shurjo, SolaimanLipi, \" siyam=\"\" rupali\",=\"\" roboto,=\"\" arial,=\"\" helvetica,=\"\" monospace;=\"\" font-size:=\"\" 13.0906px;\"=\"\"><div class=\"story-element story-element-title\" style=\"margin: var(--space3_2) auto var(--space1_0); width: 622px;\"><h6 style=\"margin-right: 0px; margin-bottom: var(--space1_6); margin-left: 0px; padding: 0px; font-family: var(--font-2); font-size: var(--base-medium); line-height: 1.67; white-space: break-spaces;\">ক্যাচ উঠেছিল…<br>অফ স্টাম্পের বাইরের বলে কাট করেছিলেন কুইন্টন ডি কক। থার্ডম্যানে মোস্তাফিজুর রহমান ঠিকঠাক যেতে পারেননি বলের কাছে, যেটি পড়েছে তাঁর একটু সামনেই। <br>তবে ওভারের শেষ দুই বলে দুইটি বাউন্ডারি মেরেছেন ম্যালান। প্রথমটি ব্যাকওয়ার্ড পয়েন্ট দিয়ে, পরেরটি লং অফ দিয়ে। <br>৩ ওভার শেষে দক্ষিণ আফ্রিকার রান ১৭।</h6><h2 style=\"margin-right: 0px; margin-bottom: 0px; margin-left: 0px; padding: 0px; font-family: var(--font-2); font-size: 1.6em; line-height: 1.33;\">', 1, '2022-03-23 04:26:04', '2022-03-23 05:21:34');

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
('rafidalridwan@gmail.com', '$2y$10$Mmb0hnc5SfIOq9pCrrrBHOFxBOndiSvhZNxpXXwpyleq9DeWeHmDu', '2022-04-20 21:04:43');

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
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `key` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `value` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `key`, `value`, `created_at`, `updated_at`) VALUES
(3, 'app_name', 'নির্ভীক\'১২', NULL, '2022-04-17 23:50:59'),
(4, 'banner', 'assets/user/landingPage/img/1650262378logoW.png', NULL, '2022-04-18 00:12:58'),
(5, 'description', 'Bogra Zilla School (বগুড়া জিলা স্কুল) is one of the oldest high schools in the Bogra District of Bangladesh and one of the top-ranked schools in the country. It provides education from class three (Grade-3) to class ten (Grade-10).', NULL, '2022-04-17 03:34:34'),
(6, 'address', 'Bogura Zilla School', NULL, '2022-04-17 23:56:05'),
(7, 'phone', '017xxxxxxxx', NULL, NULL),
(8, 'email', 'ask@nirvik12.com', NULL, NULL);

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
(31, 'a20', 'rafidalridwan@gmail.com', NULL, '$2y$10$S53cCL7DBM9FxZtlyoIDzOJUm50bKIBcBPohTkGosPkXDMOYoxI9a', 3, 'eGKUhSlgZB9UZADaL2JveIEhKQzsrk5obOMw0XOnMIzOJ31yEibPlSqqqx46', '2021-07-24 21:34:56', '2021-11-11 04:01:58'),
(32, 'a1', NULL, NULL, '$2y$10$feyJbgEd4WhgSkoMOrv.cupBfeeHk22b1JqWROOlfELrdA6bSeNoe', 3, NULL, '2021-07-29 19:48:39', '2021-07-29 19:48:39'),
(33, 'a2', NULL, NULL, '$2y$10$Rq9RlXgIzpiuMppzE4NMIuRm5T786fTG5PIUtlfa6TEExkJkAfF9i', 3, NULL, '2021-07-29 19:59:00', '2022-01-11 02:58:33'),
(34, 'a3', NULL, NULL, '$2y$10$XeMvEWYqjB0McN4EQleZOOLtI2h68bEbK05ua8xouHtOyLbyO0EmS', 3, NULL, '2021-07-29 20:00:03', '2021-07-29 20:01:28'),
(35, 'a4', 'a4@gmail.com', NULL, '$2y$10$Ts6h.1mUtpPOOFxU2Ep3cerxcMkCqhPGu0X5F/LHEGNp/QwZcWGnq', 3, NULL, '2021-07-31 06:26:18', '2021-07-31 06:27:15'),
(36, 'a5', NULL, NULL, '$2y$10$6LoH8kfd/ceu1MBrtCCrBuevEe8sRv/K/u9mU0DzzepCxnk5TjRRm', 3, NULL, '2021-08-07 06:41:22', '2021-08-07 06:41:22'),
(42, 'd3', NULL, NULL, '$2y$10$h/JtGRWNQzhB6gZziqDopOU5CBq2AI7xN4LvLykIIWDYWCJcLQQxS', 3, NULL, '2022-03-13 23:06:56', '2022-03-13 23:06:56');

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
(2, 31, 'Rafid Al Ridwan', 'Dhaka, Bangladesh', 'Jr. Software Engineer', 'Technovista Limited', 'House no. 45, Road no: 12, Section 10, Uttara Model Town, Dhaka', NULL, 2, NULL, NULL, 1, 1, 1, 20, '16275652971627531505154.jpg', '2021-07-24 21:34:56', '2022-03-23 05:49:39'),
(4, 32, 'Toufik Hasan', 'Dhaka', NULL, NULL, NULL, NULL, 1, NULL, NULL, 1, 1, 1, NULL, NULL, '2021-07-29 19:48:39', '2021-07-29 19:48:39'),
(5, 33, 'Wayes A Rasul', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-07-29 19:59:00', '2021-07-29 19:59:00'),
(6, 34, 'Jubair Islam', NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, 1, 1, 1, NULL, NULL, '2021-07-29 20:00:03', '2022-01-11 03:11:20'),
(7, 35, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-07-31 06:26:18', '2021-07-31 06:26:18'),
(8, 1, 'Super Admin', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '16279946181627531505154.jpg', NULL, '2021-08-03 06:43:38'),
(9, 36, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-08-07 06:41:22', '2021-08-07 06:41:22'),
(21, 42, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-03-13 23:06:56', '2022-03-13 23:06:56');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `abouts`
--
ALTER TABLE `abouts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `albums`
--
ALTER TABLE `albums`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cover_pages`
--
ALTER TABLE `cover_pages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `galleries`
--
ALTER TABLE `galleries`
  ADD PRIMARY KEY (`id`);

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
-- Indexes for table `settings`
--
ALTER TABLE `settings`
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
-- AUTO_INCREMENT for table `albums`
--
ALTER TABLE `albums`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `cover_pages`
--
ALTER TABLE `cover_pages`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `events`
--
ALTER TABLE `events`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `galleries`
--
ALTER TABLE `galleries`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `mobile_number_details`
--
ALTER TABLE `mobile_number_details`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;

--
-- AUTO_INCREMENT for table `news`
--
ALTER TABLE `news`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `sections`
--
ALTER TABLE `sections`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `shifts`
--
ALTER TABLE `shifts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT for table `user_details`
--
ALTER TABLE `user_details`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
