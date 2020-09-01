-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Aug 31, 2020 at 06:46 PM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.2.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `laravel`
--

-- --------------------------------------------------------

--
-- Table structure for table `approving_todo_lists`
--

CREATE TABLE `approving_todo_lists` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `todo_id` bigint(20) UNSIGNED NOT NULL,
  `status` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `banners`
--

CREATE TABLE `banners` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `link` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `banners`
--

INSERT INTO `banners` (`id`, `title`, `image`, `link`, `created_at`, `updated_at`) VALUES
(4, 'This is a banner', 'bg1_1597932242_5f3e82d27a77b.jpg', 'https://www.facebook.com/ndqk0', '2020-08-20 07:04:02', '2020-08-20 07:04:02');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `title`, `slug`, `status`, `created_at`, `updated_at`) VALUES
(13, 'Camera', 'camera', 0, '2020-08-19 21:07:31', '2020-08-19 21:07:31'),
(15, 'Lens', 'lens', 0, '2020-08-21 21:42:32', '2020-08-21 21:42:32');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `images`
--

CREATE TABLE `images` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `image` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `post_id` bigint(20) UNSIGNED NOT NULL,
  `status` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `images`
--

INSERT INTO `images` (`id`, `image`, `post_id`, `status`, `created_at`, `updated_at`) VALUES
(96, 'prev1_1598695915_5f4a29ebb134e.jpg', 69, 0, NULL, NULL),
(97, 'bg2_1598695915_5f4a29ebb13bc.jpg', 69, 1, NULL, NULL);

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
(4, '2020_07_03_141757_create_permission_tables', 1),
(5, '2020_07_06_032246_create_categories_table', 2),
(6, '2020_07_06_084900_create_posts_table', 3),
(7, '2020_07_06_093935_create_images_table', 4),
(8, '2020_08_20_112410_create_banners_table', 5),
(9, '2020_08_23_072313_create_todo_lists_table', 6),
(10, '2020_08_23_084758_user_has_todo', 7),
(11, '2020_08_26_074921_create_approving_todo_lists_table', 8),
(12, '2020_08_26_115832_create_notifications_table', 8),
(13, '2020_08_26_115913_create_user_has_notifications_table', 8),
(14, '2020_08_26_142350_create_notifications_table', 9),
(15, '2020_08_27_093818_create_notifications_table', 10);

-- --------------------------------------------------------

--
-- Table structure for table `model_has_permissions`
--

CREATE TABLE `model_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `model_has_permissions`
--

INSERT INTO `model_has_permissions` (`permission_id`, `model_type`, `model_id`) VALUES
(13, 'App\\Entity\\User', 24);

-- --------------------------------------------------------

--
-- Table structure for table `model_has_roles`
--

CREATE TABLE `model_has_roles` (
  `role_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `model_has_roles`
--

INSERT INTO `model_has_roles` (`role_id`, `model_type`, `model_id`) VALUES
(3, 'App\\Entity\\User', 9),
(3, 'App\\Entity\\User', 29),
(4, 'App\\Entity\\User', 18),
(5, 'App\\Entity\\User', 20),
(5, 'App\\Entity\\User', 24);

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `notifiable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `notifiable_id` bigint(20) UNSIGNED NOT NULL,
  `data` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `read_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `notifications`
--

INSERT INTO `notifications` (`id`, `type`, `notifiable_type`, `notifiable_id`, `data`, `read_at`, `created_at`, `updated_at`) VALUES
('0f77be32-0cc2-46b1-97fd-f8ff8dfd4865', 'App\\Notifications\\Mission', 'App\\Entity\\User', 24, '{\"title\":\"B\\u1ea1n \\u0111\\u01b0\\u1ee3c th\\u00eam v\\u00e0o 1 c\\u00f4ng vi\\u1ec7c\",\"link\":\"http:\\/\\/127.0.0.1:8000\\/admin\\/todo-list\\/15\",\"icon\":\"far fa-list-alt\"}', NULL, '2020-08-27 19:27:17', '2020-08-27 19:27:17'),
('169e8632-9aaf-427c-ab71-f9d91f13c122', 'App\\Notifications\\Mission', 'App\\Entity\\User', 9, '{\"title\":\"0pJ45M1asl\",\"link\":\"https:\\/\\/www.youtube.com\\/watch?v=RlBkvjVss-s\",\"icon\":\"far fa-list-alt\"}', '2020-08-29 01:23:23', '2020-08-27 12:50:23', '2020-08-29 01:23:23'),
('1a3c3312-9b58-4077-a99d-31ce28b0bd4c', 'App\\Notifications\\Mission', 'App\\Entity\\User', 9, '{\"title\":\"UlQZOYVpdA\",\"link\":\"https:\\/\\/www.youtube.com\\/watch?v=RlBkvjVss-s\",\"icon\":\"far fa-list-alt\"}', NULL, '2020-08-27 12:50:20', '2020-08-27 12:50:20'),
('1e7af863-26c2-4a2d-a2f9-2c287f2a19a0', 'App\\Notifications\\Mission', 'App\\Entity\\User', 9, '{\"title\":\"hlFFsrJvoT\",\"link\":\"https:\\/\\/www.youtube.com\\/watch?v=RlBkvjVss-s\",\"icon\":\"far fa-list-alt\"}', NULL, '2020-08-27 12:50:11', '2020-08-27 12:50:11'),
('3d927755-e947-45b9-b111-0f1afbdff281', 'App\\Notifications\\Mission', 'App\\Entity\\User', 9, '{\"title\":\"DUa0upYma9\",\"link\":\"https:\\/\\/www.youtube.com\\/watch?v=RlBkvjVss-s\",\"icon\":\"far fa-list-alt\"}', '2020-08-27 22:05:43', '2020-08-27 12:50:33', '2020-08-27 22:05:43'),
('414a3e87-081e-477d-b2f2-533865ebb230', 'App\\Notifications\\Mission', 'App\\Entity\\User', 9, '{\"title\":\"ViWhGJBs1d\",\"link\":\"https:\\/\\/www.youtube.com\\/watch?v=RlBkvjVss-s\",\"icon\":\"far fa-list-alt\"}', NULL, '2020-08-27 12:50:19', '2020-08-27 12:50:19'),
('58feb82c-362f-42e0-9bdd-4388eedcc57f', 'App\\Notifications\\Mission', 'App\\Entity\\User', 9, '{\"title\":\"eas7dLBNXj\",\"link\":\"https:\\/\\/www.youtube.com\\/watch?v=RlBkvjVss-s\",\"icon\":\"far fa-list-alt\"}', NULL, '2020-08-27 12:50:17', '2020-08-27 12:50:17'),
('74871704-361b-41d5-bb83-5032adccb2eb', 'App\\Notifications\\Mission', 'App\\Entity\\User', 9, '{\"title\":\"upQywqmg5X\",\"link\":\"https:\\/\\/www.youtube.com\\/watch?v=RlBkvjVss-s\",\"icon\":\"far fa-list-alt\"}', NULL, '2020-08-27 12:50:15', '2020-08-27 12:50:15'),
('79036aa4-efd8-4baa-9867-e2362e645388', 'App\\Notifications\\Mission', 'App\\Entity\\User', 9, '{\"title\":\"LIpFHGL2zc\",\"link\":\"https:\\/\\/www.youtube.com\\/watch?v=RlBkvjVss-s\",\"icon\":\"far fa-list-alt\"}', '2020-08-27 22:05:33', '2020-08-27 12:50:41', '2020-08-27 22:05:33'),
('a6c3cbb2-4a30-43ba-9b10-f3ecaa4c6857', 'App\\Notifications\\Mission', 'App\\Entity\\User', 24, '{\"title\":\"C\\u1eadp nh\\u1eadt c\\u00f4ng vi\\u1ec7c\",\"link\":\"http:\\/\\/127.0.0.1:8000\\/admin\\/todo-list\\/15\",\"icon\":\"far fa-list-alt\"}', NULL, '2020-08-31 09:40:43', '2020-08-31 09:40:43'),
('b0e507e3-bfa4-4194-b572-9b4d274b3f1c', 'App\\Notifications\\Mission', 'App\\Entity\\User', 9, '{\"title\":\"iLprFapoMq\",\"link\":\"https:\\/\\/www.youtube.com\\/watch?v=RlBkvjVss-s\",\"icon\":\"far fa-list-alt\"}', NULL, '2020-08-27 12:50:16', '2020-08-27 12:50:16'),
('be7e56bb-4bf0-485a-a09b-e6df51f17ba5', 'App\\Notifications\\Mission', 'App\\Entity\\User', 9, '{\"title\":\"UZrNG6dqbc\",\"link\":\"https:\\/\\/www.youtube.com\\/watch?v=RlBkvjVss-s\",\"icon\":\"far fa-list-alt\"}', NULL, '2020-08-27 12:50:14', '2020-08-27 12:50:14'),
('c0226db1-16b2-4e80-9e39-86531db62626', 'App\\Notifications\\Mission', 'App\\Entity\\User', 9, '{\"title\":\"mAYZwdGw1u\",\"link\":\"https:\\/\\/www.youtube.com\\/watch?v=RlBkvjVss-s\",\"icon\":\"far fa-list-alt\"}', NULL, '2020-08-27 12:50:21', '2020-08-27 12:50:21'),
('c8d0d525-f126-49dc-bd6b-6f3d2941d0e9', 'App\\Notifications\\Mission', 'App\\Entity\\User', 9, '{\"title\":\"YN4eXj7VJ2\",\"link\":\"https:\\/\\/www.youtube.com\\/watch?v=RlBkvjVss-s\",\"icon\":\"far fa-list-alt\"}', NULL, '2020-08-29 01:24:29', '2020-08-29 01:24:29'),
('d5b9f8ee-84ec-487e-80da-39c284171320', 'App\\Notifications\\Mission', 'App\\Entity\\User', 9, '{\"title\":\"aipPwxBRKH\",\"link\":\"https:\\/\\/www.youtube.com\\/watch?v=RlBkvjVss-s\",\"icon\":\"far fa-list-alt\"}', NULL, '2020-08-27 12:50:13', '2020-08-27 12:50:13'),
('e00bfe34-9b74-4e46-882e-f1896ea94ca4', 'App\\Notifications\\Mission', 'App\\Entity\\User', 9, '{\"title\":\"Y6aKEKJwsQ\",\"link\":\"https:\\/\\/www.youtube.com\\/watch?v=RlBkvjVss-s\",\"icon\":\"far fa-list-alt\"}', '2020-08-29 01:23:29', '2020-08-27 12:50:22', '2020-08-29 01:23:29'),
('e3b5cf64-0743-474a-87b8-03a790d6dd61', 'App\\Notifications\\Mission', 'App\\Entity\\User', 9, '{\"title\":\"8HkMHRde8k\",\"link\":\"https:\\/\\/www.youtube.com\\/watch?v=RlBkvjVss-s\",\"icon\":\"far fa-list-alt\"}', NULL, '2020-08-27 12:50:18', '2020-08-27 12:50:18'),
('eedfa055-ee6a-4d6a-a24e-6e2d21db896e', 'App\\Notifications\\Mission', 'App\\Entity\\User', 9, '{\"title\":\"OA1Ztc91qb\",\"link\":\"https:\\/\\/www.youtube.com\\/watch?v=RlBkvjVss-s\",\"icon\":\"far fa-list-alt\"}', NULL, '2020-08-27 12:49:32', '2020-08-27 12:49:32'),
('f286e349-3009-429d-96ec-16835997fbea', 'App\\Notifications\\Mission', 'App\\Entity\\User', 9, '{\"title\":\"iIPwykCRRs\",\"link\":\"https:\\/\\/www.youtube.com\\/watch?v=RlBkvjVss-s\",\"icon\":\"far fa-list-alt\"}', '2020-08-27 22:06:06', '2020-08-27 12:50:32', '2020-08-27 22:06:06');

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
(1, 'user-list', 'web', '2020-07-03 08:44:31', '2020-07-03 08:44:31'),
(2, 'user-edit', 'web', '2020-07-03 08:44:31', '2020-07-03 08:44:31'),
(3, 'user-create', 'web', '2020-07-03 08:44:31', '2020-07-03 08:44:31'),
(4, 'user-delete', 'web', '2020-07-03 08:44:31', '2020-07-03 08:44:31'),
(5, 'role-delete', 'web', '2020-07-04 22:36:52', '2020-07-04 22:36:52'),
(6, 'role-list', 'web', '2020-07-04 22:38:04', '2020-07-04 22:38:04'),
(7, 'role-create', 'web', '2020-07-04 22:38:04', '2020-07-04 22:38:04'),
(8, 'role-edit', 'web', '2020-07-04 22:38:04', '2020-07-04 22:38:04'),
(9, 'category-list', 'web', '2020-07-06 01:21:52', '2020-07-06 01:21:52'),
(10, 'category-create', 'web', '2020-07-06 01:21:52', '2020-07-06 01:21:52'),
(11, 'category-edit', 'web', '2020-07-06 01:21:52', '2020-07-06 01:21:52'),
(12, 'category-delete', 'web', '2020-07-06 01:21:52', '2020-07-06 01:21:52'),
(13, 'banner-list', 'web', '2020-08-21 21:03:24', '2020-08-21 21:03:24'),
(14, 'banner-create', 'web', '2020-08-21 21:03:24', '2020-08-21 21:03:24'),
(15, 'banner-edit', 'web', '2020-08-21 21:03:24', '2020-08-21 21:03:24'),
(16, 'banner-delete', 'web', '2020-08-21 21:03:24', '2020-08-21 21:03:24'),
(17, 'post-list', 'web', '2020-08-21 21:48:28', '2020-08-21 21:48:28'),
(18, 'post-create', 'web', '2020-08-21 21:48:28', '2020-08-21 21:48:28'),
(19, 'post-edit', 'web', '2020-08-21 21:48:28', '2020-08-21 21:48:28'),
(20, 'post-delete', 'web', '2020-08-21 21:48:28', '2020-08-21 21:48:28'),
(21, 'todo-list', 'web', '2020-08-26 00:03:15', '2020-08-26 00:03:15'),
(22, 'todo-create', 'web', '2020-08-26 00:03:15', '2020-08-26 00:03:15'),
(23, 'todo-edit', 'web', '2020-08-26 00:03:15', '2020-08-26 00:03:15'),
(24, 'todo-delete', 'web', '2020-08-26 00:03:15', '2020-08-26 00:03:15'),
(25, 'todo-detail', 'web', '2020-08-26 00:09:36', '2020-08-26 00:09:36'),
(26, 'todo-approve-send', 'web', '2020-08-26 01:50:58', '2020-08-26 01:50:58'),
(27, 'todo-approve-list', 'web', '2020-08-26 01:50:58', '2020-08-26 01:50:58'),
(28, 'todo-approve-check', 'web', '2020-08-26 01:50:58', '2020-08-26 01:50:58'),
(29, 'todo-approve-delete', 'web', '2020-08-26 01:50:58', '2020-08-26 01:50:58'),
(30, 'user-permission-list', 'web', '2020-08-31 03:42:44', '2020-08-31 03:42:44'),
(31, 'user-permisison-edit', 'web', '2020-08-31 03:42:45', '2020-08-31 03:42:45');

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `category_id` bigint(20) UNSIGNED NOT NULL,
  `content` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `view` bigint(20) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id`, `title`, `slug`, `category_id`, `content`, `user_id`, `view`, `status`, `created_at`, `updated_at`) VALUES
(69, 'This is a title', 'this-is-a-title', 13, '<p><img src=\"/upload/image/post/content_1598695915_5f4a29ebaf4c5.jpeg\" data-filename=\"/upload/image/post/content_1598695915_5f4a29ebaf4c5.jpeg\" style=\"width: 1042px;\"><br></p>', 9, 0, 0, '2020-08-29 03:11:55', '2020-08-29 03:11:55');

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
(3, 'Admin', 'web', '2020-07-03 09:05:57', '2020-07-03 09:05:57'),
(4, 'Customer', 'web', '2020-07-03 09:09:06', '2020-07-03 09:09:06'),
(5, 'Writer', 'web', '2020-07-04 07:03:50', '2020-07-04 07:03:50');

-- --------------------------------------------------------

--
-- Table structure for table `role_has_permissions`
--

CREATE TABLE `role_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `role_has_permissions`
--

INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES
(1, 3),
(2, 3),
(3, 3),
(4, 3),
(5, 3),
(6, 3),
(7, 3),
(8, 3),
(9, 3),
(9, 5),
(10, 3),
(11, 3),
(12, 3),
(13, 3),
(14, 3),
(15, 3),
(16, 3),
(17, 3),
(17, 5),
(18, 3),
(18, 5),
(19, 3),
(19, 5),
(20, 3),
(20, 5),
(21, 3),
(22, 3),
(23, 3),
(24, 3),
(25, 3),
(25, 5),
(26, 3),
(26, 5),
(27, 3),
(28, 3),
(29, 3),
(30, 3),
(31, 3);

-- --------------------------------------------------------

--
-- Table structure for table `todo_lists`
--

CREATE TABLE `todo_lists` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `content` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `deadline` date NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `status` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `todo_lists`
--

INSERT INTO `todo_lists` (`id`, `title`, `content`, `deadline`, `user_id`, `status`, `created_at`, `updated_at`) VALUES
(7, 'Test3', '<p>Test3</p>', '2020-09-26', 9, 0, '2020-08-25 22:23:08', '2020-08-30 23:14:57'),
(8, 'Test4', '<p>Test 4</p>', '2020-10-26', 9, 0, '2020-08-25 22:23:45', '2020-08-26 03:40:29'),
(15, 'This is a title', '<p>Test</p>', '2020-08-31', 9, 0, '2020-08-27 19:27:17', '2020-08-27 19:27:17');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` int(11) DEFAULT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `role`, `address`, `phone`, `remember_token`, `created_at`, `updated_at`) VALUES
(9, 'Nguyễn Duy Quốc Khánh', 'ndqk.02.09.2000@gmail.com', NULL, '$2y$10$LW4imzzantk7MPC8OMC9mewdlahvbqmG7h64Ebm7BQtkGbXsNF61O', NULL, 'Yen So, Hoai Duc, Ha Noi', '0866950199', NULL, '2020-07-03 09:05:57', '2020-08-31 08:11:07'),
(18, 'DO THI HANH', 'dth@dth.com', NULL, '$2y$10$ckinRsf5SyCgd2WMYFbr5O4Iv4l9BDtIdQ0w0MdhxHiD5awOCjDs6', NULL, 'Yen So, Hoai Duc, Ha Noi', '1235679-000', NULL, '2020-07-04 02:02:51', '2020-08-31 08:40:02'),
(20, 'Writer NDQK', 'aaa@gmail.com', NULL, '$2y$10$Kog4ULkEiht.rdk1rVJRKO3X/Mfj7HHj20tLPT.PKCmk3BLuL/5NW', NULL, 'HN', '21341153225', NULL, '2020-07-04 07:07:01', '2020-08-31 04:27:25'),
(24, 'Writer2', 'writer@gmail.com', NULL, '$2y$10$dDc.NAddtBTmKbshe1ojkOfWLfgbzaEWoPqRnX3omA.b/CWmyuLkm', NULL, 'HN', '1234567889', NULL, '2020-08-23 02:13:30', '2020-08-29 03:43:42'),
(29, 'admin', 'admin2@admin.com', NULL, '$2y$10$tr2vQxHD5TqhrXK1QwwPgund7FDXLSnZH9O8zEfpo87W8rPcyavHG', NULL, 'VN', '12345670209', NULL, '2020-08-29 03:42:52', '2020-08-31 09:21:15');

-- --------------------------------------------------------

--
-- Table structure for table `user_has_todos`
--

CREATE TABLE `user_has_todos` (
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `todo_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user_has_todos`
--

INSERT INTO `user_has_todos` (`user_id`, `todo_id`) VALUES
(20, 8),
(20, 7),
(24, 15);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `approving_todo_lists`
--
ALTER TABLE `approving_todo_lists`
  ADD PRIMARY KEY (`id`),
  ADD KEY `approving_todo_lists_todo_id_foreign` (`todo_id`);

--
-- Indexes for table `banners`
--
ALTER TABLE `banners`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `images`
--
ALTER TABLE `images`
  ADD PRIMARY KEY (`id`),
  ADD KEY `images_post_id_foreign` (`post_id`);

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
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`),
  ADD KEY `notifications_notifiable_type_notifiable_id_index` (`notifiable_type`,`notifiable_id`);

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
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `posts_category_id_foreign` (`category_id`),
  ADD KEY `posts_user_id_foreign` (`user_id`);

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
-- Indexes for table `todo_lists`
--
ALTER TABLE `todo_lists`
  ADD PRIMARY KEY (`id`),
  ADD KEY `todo_lists_user_id_foreign` (`user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD UNIQUE KEY `users_phone_unique` (`phone`);

--
-- Indexes for table `user_has_todos`
--
ALTER TABLE `user_has_todos`
  ADD KEY `user_has_todos_user_id_foreign` (`user_id`),
  ADD KEY `user_has_todos_todo_id_foreign` (`todo_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `approving_todo_lists`
--
ALTER TABLE `approving_todo_lists`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `banners`
--
ALTER TABLE `banners`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `images`
--
ALTER TABLE `images`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=98;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=70;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `todo_lists`
--
ALTER TABLE `todo_lists`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `approving_todo_lists`
--
ALTER TABLE `approving_todo_lists`
  ADD CONSTRAINT `approving_todo_lists_todo_id_foreign` FOREIGN KEY (`todo_id`) REFERENCES `todo_lists` (`id`);

--
-- Constraints for table `images`
--
ALTER TABLE `images`
  ADD CONSTRAINT `images_post_id_foreign` FOREIGN KEY (`post_id`) REFERENCES `posts` (`id`);

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
-- Constraints for table `posts`
--
ALTER TABLE `posts`
  ADD CONSTRAINT `posts_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`),
  ADD CONSTRAINT `posts_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `todo_lists`
--
ALTER TABLE `todo_lists`
  ADD CONSTRAINT `todo_lists_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `user_has_todos`
--
ALTER TABLE `user_has_todos`
  ADD CONSTRAINT `user_has_todos_todo_id_foreign` FOREIGN KEY (`todo_id`) REFERENCES `todo_lists` (`id`),
  ADD CONSTRAINT `user_has_todos_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
