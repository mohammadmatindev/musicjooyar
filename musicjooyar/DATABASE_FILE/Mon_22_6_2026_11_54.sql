-- phpMyAdmin SQL Dump
-- version 5.2.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jun 22, 2026 at 08:22 AM
-- Server version: 8.4.3
-- PHP Version: 8.3.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `musicjooyar`
--

-- --------------------------------------------------------

--
-- Table structure for table `artists`
--

CREATE TABLE `artists` (
  `ID` bigint NOT NULL,
  `first_name` varchar(100) DEFAULT NULL,
  `last_name` varchar(100) DEFAULT NULL,
  `music_count` int DEFAULT '0',
  `avatar` varchar(255) DEFAULT NULL,
  `biography` text,
  `birthdate` date DEFAULT NULL,
  `dead_date` date DEFAULT NULL,
  `created_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `ID` bigint NOT NULL,
  `title` varchar(100) DEFAULT NULL,
  `parent` bigint DEFAULT '0',
  `created_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `code_status`
--

CREATE TABLE `code_status` (
  `ID` bigint NOT NULL,
  `user_id` bigint NOT NULL,
  `phone` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `code` varchar(6) NOT NULL,
  `action` varchar(20) NOT NULL DEFAULT 'login',
  `status` varchar(25) NOT NULL DEFAULT 'pending',
  `try_conut` smallint NOT NULL,
  `sms_id` varchar(20) NOT NULL,
  `token` varchar(20) NOT NULL,
  `used_at` datetime DEFAULT NULL,
  `expire_date` datetime NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `code_status`
--

INSERT INTO `code_status` (`ID`, `user_id`, `phone`, `code`, `action`, `status`, `try_conut`, `sms_id`, `token`, `used_at`, `expire_date`, `created_at`) VALUES
(1, 1, '09123654888882 ', '1234', 'login', 'pending', 2, '000', '', NULL, '2026-06-16 13:36:07', '2026-06-16 13:36:07'),
(2, 1, '09126985365', '79197', 'login', 'pending', 0, '0', '', '2026-06-16 17:08:02', '2026-06-16 17:11:02', '2026-06-16 17:08:02'),
(3, 1, '09126985365', '74480', 'login', 'pending', 0, '0', '', '2026-06-16 17:08:34', '2026-06-16 17:11:34', '2026-06-16 17:08:34'),
(4, 1, '09126985361', '40468', 'login', 'pending', 0, '0', '', '2026-06-16 17:08:59', '2026-06-16 17:11:59', '2026-06-16 17:08:59'),
(5, 1, '09126985322', '73887', 'login', 'pending', 0, '0', '', '2026-06-16 17:09:29', '2026-06-16 17:12:29', '2026-06-16 17:09:29'),
(6, 1, '09126985365', '97172', 'login', 'pending', 0, '0', '', '2026-06-16 17:25:53', '2026-06-16 17:28:53', '2026-06-16 17:25:53'),
(7, 1, '09126985365', '43022', 'login', 'pending', 0, '0', '', '2026-06-16 17:28:13', '2026-06-16 17:31:13', '2026-06-16 17:28:13'),
(8, 1, '09126982323232', '90639', 'login', 'pending', 0, '0', '', '2026-06-16 17:28:25', '2026-06-16 17:31:25', '2026-06-16 17:28:25'),
(9, 1, '09126982323232', '32659', 'login', 'pending', 0, '0', '', '2026-06-16 17:29:57', '2026-06-16 17:32:57', '2026-06-16 17:29:57'),
(10, 1, '09126982323232', '27033', 'login', 'pending', 0, '0', '', '2026-06-16 17:31:06', '2026-06-16 17:34:06', '2026-06-16 17:31:06'),
(11, 1, '09126985365', '21488', 'login', 'pending', 0, '0', '', '2026-06-16 17:31:12', '2026-06-16 17:34:12', '2026-06-16 17:31:12'),
(12, 1, '09126985365', '37030', 'login', 'pending', 0, '0', '', '2026-06-16 17:32:00', '2026-06-16 17:35:00', '2026-06-16 17:32:00'),
(13, 1, '09126985362', '59029', 'login', 'pending', 0, '0', '', '2026-06-16 17:32:14', '2026-06-16 17:35:14', '2026-06-16 17:32:14'),
(14, 1, '09126985365', '40824', 'login', 'pending', 0, '0', '', '2026-06-17 10:57:28', '2026-06-17 11:00:28', '2026-06-17 10:57:28'),
(15, 1, '09126985362', '11873', 'login', 'pending', 0, '0', '', '2026-06-17 10:57:51', '2026-06-17 11:00:51', '2026-06-17 10:57:51'),
(16, 1, '09126543333330', '34638', 'login', 'pending', 0, '0', '', '2026-06-17 10:58:47', '2026-06-17 11:01:47', '2026-06-17 10:58:47'),
(17, 1, '09126543333330', '59233', 'login', 'pending', 0, '0', '', '2026-06-17 11:02:10', '2026-06-17 11:05:10', '2026-06-17 11:02:10'),
(18, 1, '09126543333330', '35336', 'login', 'pending', 0, '0', '', '2026-06-17 11:08:53', '2026-06-17 11:11:53', '2026-06-17 11:08:53'),
(19, 1, '09126543333330', '53670', 'login', 'pending', 0, '0', '', '2026-06-17 11:08:54', '2026-06-17 11:11:54', '2026-06-17 11:08:54'),
(20, 1, '09126543333330', '52853', 'login', 'pending', 0, '0', '', '2026-06-17 11:12:20', '2026-06-17 11:15:20', '2026-06-17 11:12:20'),
(21, 1, '09126543333330', '24188', 'login', 'pending', 0, '0', '', '2026-06-17 11:12:21', '2026-06-17 11:15:21', '2026-06-17 11:12:21'),
(22, 1, '09126543333330', '12086', 'login', 'pending', 0, '0', '', '2026-06-17 11:12:24', '2026-06-17 11:15:24', '2026-06-17 11:12:24'),
(23, 1, '09126543333330', '61086', 'login', 'pending', 0, '0', '', '2026-06-17 11:12:24', '2026-06-17 11:15:24', '2026-06-17 11:12:24'),
(24, 1, '09126543333330', '32232', 'login', 'pending', 0, '0', '', '2026-06-17 11:12:25', '2026-06-17 11:15:25', '2026-06-17 11:12:25'),
(25, 1, '09126543333330', '39058', 'login', 'pending', 0, '0', '', '2026-06-17 11:12:26', '2026-06-17 11:15:26', '2026-06-17 11:12:26'),
(26, 1, '09126543333330', '57879', 'login', 'pending', 0, '0', '', '2026-06-17 11:12:27', '2026-06-17 11:15:27', '2026-06-17 11:12:27'),
(27, 1, '09126543333330', '56423', 'login', 'pending', 0, '0', '', '2026-06-17 11:12:28', '2026-06-17 11:15:28', '2026-06-17 11:12:28'),
(28, 1, '09126543333330', '84961', 'login', 'pending', 0, '0', '', '2026-06-17 11:12:29', '2026-06-17 11:15:29', '2026-06-17 11:12:29'),
(29, 1, '09126543333330', '47021', 'login', 'pending', 0, '0', '', '2026-06-17 11:12:30', '2026-06-17 11:15:30', '2026-06-17 11:12:30'),
(30, 1, '09126985322236', '75589', 'login', 'pending', 0, '0', '', '2026-06-17 11:12:48', '2026-06-17 11:15:48', '2026-06-17 11:12:48'),
(31, 1, '09126985365', '53495', 'login', 'pending', 0, '0', '', '2026-06-17 11:18:14', '2026-06-17 11:21:14', '2026-06-17 11:18:14'),
(32, 1, '0912698532211', '36227', 'login', 'pending', 0, '0', '', '2026-06-17 11:34:00', '2026-06-17 11:37:00', '2026-06-17 11:34:00'),
(33, 1, '0912698532211', '10704', 'login', 'pending', 0, '0', '', '2026-06-17 11:37:09', '2026-06-17 11:40:09', '2026-06-17 11:37:09'),
(34, 1, '09126985111111', '31225', 'login', 'pending', 0, '0', '', '2026-06-17 11:43:14', '2026-06-17 11:46:14', '2026-06-17 11:43:14'),
(35, 1, '09126981111111', '82361', 'login', 'pending', 0, '0', '', '2026-06-17 11:44:32', '2026-06-17 11:47:32', '2026-06-17 11:44:32'),
(36, 1, '09126981111111', '87755', 'login', 'pending', 0, '0', '', '2026-06-17 11:44:44', '2026-06-17 11:47:44', '2026-06-17 11:44:44'),
(37, 1, '09126985365', '78126', 'login', 'pending', 0, '0', '', '2026-06-17 11:47:36', '2026-06-17 11:50:36', '2026-06-17 11:47:36'),
(38, 1, '09126985365', '36634', 'login', 'pending', 0, '0', '', '2026-06-17 11:47:53', '2026-06-17 11:50:53', '2026-06-17 11:47:53'),
(39, 1, '09126985365', '18571', 'login', 'pending', 0, '0', '', '2026-06-17 11:48:28', '2026-06-17 11:51:28', '2026-06-17 11:48:28'),
(40, 1, '09126985365', '84921', 'login', 'pending', 0, '0', '', '2026-06-17 11:48:53', '2026-06-17 11:51:53', '2026-06-17 11:48:53'),
(41, 1, '09126985365', '86361', 'login', 'pending', 0, '0', '', '2026-06-17 11:51:49', '2026-06-17 11:54:49', '2026-06-17 11:51:49'),
(42, 1, '09125556565656', '11769', 'login', 'pending', 0, '0', '', '2026-06-17 11:54:54', '2026-06-17 11:57:54', '2026-06-17 11:54:54'),
(43, 1, '09125556565656', '87828', 'login', 'pending', 0, '0', '', '2026-06-17 11:55:27', '2026-06-17 11:58:27', '2026-06-17 11:55:27'),
(44, 1, '096563523232', '53975', 'login', 'pending', 0, '0', '', '2026-06-17 11:55:38', '2026-06-17 11:58:38', '2026-06-17 11:55:38'),
(45, 1, '09126912121212', '73713', 'login', 'pending', 0, '0', '', '2026-06-17 11:55:56', '2026-06-17 11:58:56', '2026-06-17 11:55:56'),
(46, 1, '09126666666665', '62570', 'login', 'pending', 0, '0', '', '2026-06-17 11:58:29', '2026-06-17 12:01:29', '2026-06-17 11:58:29'),
(47, 1, '09126666666665', '34153', 'login', 'pending', 0, '0', '', '2026-06-17 12:01:56', '2026-06-17 12:04:56', '2026-06-17 12:01:56'),
(48, 1, '09126985302020', '34550', 'login', 'pending', 0, '0', '', '2026-06-17 12:08:38', '2026-06-17 12:11:38', '2026-06-17 12:08:38'),
(49, 1, '09126565656565', '66107', 'login', 'pending', 0, '0', '', '2026-06-17 12:15:04', '2026-06-17 12:18:04', '2026-06-17 12:15:04'),
(50, 1, '09123656478999', '21810', 'login', 'pending', 0, '0', '', '2026-06-17 12:19:06', '2026-06-17 12:22:06', '2026-06-17 12:19:06'),
(51, 1, '09126985399966', '81942', 'login', 'pending', 0, '0', '', '2026-06-17 12:37:54', '2026-06-17 12:40:54', '2026-06-17 12:37:54'),
(52, 1, '09126985365', '85176', 'login', 'pending', 0, '0', '', '2026-06-17 12:40:31', '2026-06-17 12:43:31', '2026-06-17 12:40:31'),
(53, 1, '09126985365', '36326', 'login', 'pending', 0, '0', '', '2026-06-17 12:41:42', '2026-06-17 12:44:42', '2026-06-17 12:41:42'),
(54, 1, '09126985365', '52815', 'login', 'pending', 0, '0', '', '2026-06-17 12:43:14', '2026-06-17 12:46:14', '2026-06-17 12:43:14'),
(55, 1, '0912698533434', '40705', 'login', 'pending', 0, '0', '', '2026-06-17 13:57:32', '2026-06-17 14:00:32', '2026-06-17 13:57:32'),
(56, 1, '0912698533434', '68375', 'login', 'pending', 0, '0', '', '2026-06-17 14:02:15', '2026-06-17 14:05:15', '2026-06-17 14:02:15'),
(57, 1, '09126985222222', '39990', 'login', 'pending', 0, '0', '', '2026-06-17 14:53:01', '2026-06-17 14:56:01', '2026-06-17 14:53:01'),
(58, 1, '09126985365111', '83142', 'login', 'pending', 6, '0', '', '2026-06-17 14:55:03', '2026-06-17 14:58:03', '2026-06-17 14:55:03'),
(59, 1, '0912698536345', '24007', 'login', 'pending', 1, '0', '', '2026-06-17 14:58:36', '2026-06-17 15:01:36', '2026-06-17 14:58:36'),
(60, 1, '0912698536503', '45015', 'login', 'used', 0, '0', '', '2026-06-17 15:09:53', '2026-06-17 15:10:18', '2026-06-17 15:07:18'),
(61, 1, '091269853614', '74743', 'login', 'used', 0, '0', 'OFnX6F', '2026-06-17 15:25:10', '2026-06-17 15:27:50', '2026-06-17 15:24:50'),
(62, 1, '0913565623220', '92922', 'login', 'pending', 0, '0', 'q2fmry', '2026-06-17 15:30:23', '2026-06-17 15:33:23', '2026-06-17 15:30:23'),
(63, 1, '0913565623220', '43673', 'login', 'pending', 0, '0', 'KiF1md', '2026-06-17 15:35:22', '2026-06-17 15:38:22', '2026-06-17 15:35:22'),
(64, 1, '0913565623220', '71793', 'login', 'pending', 0, '0', 'n0xi9V', '2026-06-17 15:38:27', '2026-06-17 15:41:27', '2026-06-17 15:38:27'),
(65, 1, '09126985311', '44925', 'login', 'pending', 0, '0', 'gYwo4s', '2026-06-22 10:43:26', '2026-06-22 10:46:26', '2026-06-22 10:43:26'),
(66, 1, '09126985311', '65530', 'login', 'pending', 0, '0', 'qTm75a', '2026-06-22 10:43:32', '2026-06-22 10:46:32', '2026-06-22 10:43:32'),
(67, 1, '09126985345', '76399', 'login', 'used', 0, '0', 'KViIUm', '2026-06-22 10:44:17', '2026-06-22 10:47:03', '2026-06-22 10:44:03'),
(68, 1, '09126985365', '33451', 'login', 'used', 0, '0', 'EQvCDs', '2026-06-22 10:44:41', '2026-06-22 10:47:36', '2026-06-22 10:44:36'),
(69, 1, '09126985365', '31543', 'login', 'used', 0, '0', 'ClxUJa', '2026-06-22 10:45:30', '2026-06-22 10:48:25', '2026-06-22 10:45:25'),
(70, 1, '09126985365', '92638', 'login', 'pending', 1, '0', '1WnzgC', '2026-06-22 11:04:57', '2026-06-22 11:07:57', '2026-06-22 11:04:57'),
(71, 1, '09126985362', '44940', 'login', 'used', 0, '0', 'WFn6on', '2026-06-22 11:05:17', '2026-06-22 11:08:09', '2026-06-22 11:05:09'),
(72, 1, '09126985311', '67336', 'login', 'used', 0, '0', 'aqh5pM', '2026-06-22 11:12:13', '2026-06-22 11:15:07', '2026-06-22 11:12:07'),
(73, 1, '09126985365', '50743', 'login', 'used', 0, '0', '50YvOO', '2026-06-22 11:12:37', '2026-06-22 11:15:29', '2026-06-22 11:12:29'),
(74, 1, '09126985364', '81749', 'login', 'used', 0, '0', 'G8TQaN', '2026-06-22 11:30:30', '2026-06-22 11:33:24', '2026-06-22 11:30:24'),
(75, 1, '09126985365', '77505', 'login', 'used', 0, '0', 'pQ6TwP', '2026-06-22 11:43:08', '2026-06-22 11:45:59', '2026-06-22 11:42:59'),
(76, 1, '09126985322', '12410', 'login', 'used', 0, '0', 'V1ibnf', '2026-06-22 11:48:57', '2026-06-22 11:51:52', '2026-06-22 11:48:52');

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `ID` bigint NOT NULL,
  `parent_id` bigint DEFAULT '0',
  `user_id` bigint DEFAULT NULL,
  `music_id` bigint DEFAULT NULL,
  `comment` text,
  `status` varchar(255) DEFAULT 'pending',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `comment_likes`
--

CREATE TABLE `comment_likes` (
  `user_id` bigint DEFAULT NULL,
  `comment_id` bigint DEFAULT NULL,
  `like` tinyint(1) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `musics`
--

CREATE TABLE `musics` (
  `ID` bigint NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `content` text,
  `author_id` bigint DEFAULT NULL,
  `cover` varchar(255) DEFAULT NULL,
  `status` varchar(20) DEFAULT 'draft',
  `comment_count` int DEFAULT '0',
  `quality_320` varchar(255) DEFAULT NULL,
  `quality_128` varchar(255) DEFAULT NULL,
  `view_count` bigint DEFAULT '0',
  `download_count` bigint DEFAULT '0',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `music_artist`
--

CREATE TABLE `music_artist` (
  `music_id` bigint DEFAULT NULL,
  `artist_id` bigint DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `music_category`
--

CREATE TABLE `music_category` (
  `music_id` bigint DEFAULT NULL,
  `category_id` bigint DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `music_favorites`
--

CREATE TABLE `music_favorites` (
  `user_id` bigint DEFAULT NULL,
  `music_id` bigint DEFAULT NULL,
  `created_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `music_views`
--

CREATE TABLE `music_views` (
  `music_id` bigint DEFAULT NULL,
  `user_id` bigint DEFAULT '0',
  `ip` varchar(15) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `ID` bigint NOT NULL,
  `username` varchar(40) DEFAULT NULL,
  `password` varchar(40) DEFAULT NULL,
  `phone` varchar(11) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `first_name` varchar(100) DEFAULT NULL,
  `last_name` varchar(100) DEFAULT NULL,
  `role` varchar(20) DEFAULT NULL,
  `avatar` varchar(255) DEFAULT NULL,
  `status` varchar(20) DEFAULT 'active',
  `last_login` datetime DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `deleted_by` bigint DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`ID`, `username`, `password`, `phone`, `email`, `first_name`, `last_name`, `role`, `avatar`, `status`, `last_login`, `created_at`, `updated_at`, `deleted_at`, `deleted_by`) VALUES
(1, 'test', 'test', 'test', 'test', 'test', 'test', 'test', 'test', 'active', '2026-06-03 16:07:28', '2026-06-05 16:07:28', '2026-06-10 16:07:28', '2026-06-24 16:07:28', NULL),
(2, NULL, NULL, '09126985362', NULL, NULL, NULL, 'subscriber', NULL, 'active', NULL, '2026-06-22 11:05:17', '2026-06-22 11:05:17', NULL, NULL),
(3, NULL, NULL, '09126985311', NULL, NULL, NULL, 'subscriber', NULL, 'active', '2026-06-22 11:12:13', '2026-06-22 11:12:13', '2026-06-22 11:12:13', NULL, NULL),
(4, NULL, NULL, '09126985365', NULL, NULL, NULL, 'subscriber', NULL, 'active', '2026-06-22 11:43:08', '2026-06-22 11:12:37', '2026-06-22 11:12:37', NULL, NULL),
(5, NULL, NULL, '09126985364', NULL, NULL, NULL, 'subscriber', NULL, 'active', '2026-06-22 11:30:30', '2026-06-22 11:30:30', '2026-06-22 11:30:30', NULL, NULL),
(6, NULL, NULL, '09126985322', NULL, NULL, NULL, 'subscriber', NULL, 'active', '2026-06-22 11:48:57', '2026-06-22 11:48:57', '2026-06-22 11:48:57', NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `artists`
--
ALTER TABLE `artists`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `code_status`
--
ALTER TABLE `code_status`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `musics`
--
ALTER TABLE `musics`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `artists`
--
ALTER TABLE `artists`
  MODIFY `ID` bigint NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `ID` bigint NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `code_status`
--
ALTER TABLE `code_status`
  MODIFY `ID` bigint NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=77;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `ID` bigint NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `musics`
--
ALTER TABLE `musics`
  MODIFY `ID` bigint NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `ID` bigint NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
