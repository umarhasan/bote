-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Sep 13, 2024 at 05:45 PM
-- Server version: 8.0.30
-- PHP Version: 8.2.20

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `boteevcg_3654sd-23`
--

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2023_10_23_054059_create_permission_tables', 2);

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
  `id` bigint UNSIGNED NOT NULL,
  `role_id` int NOT NULL,
  `permission` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `routes` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `role_id`, `permission`, `routes`, `created_at`, `updated_at`) VALUES
(1, 1, 'god-eye', 'map', '2023-12-04 10:37:46', '2023-12-04 10:37:46'),
(2, 1, 'roles', 'roles.list', '2023-12-04 10:37:46', '2023-12-04 10:37:46'),
(3, 1, 'roles', 'roles.create', '2023-12-04 10:37:46', '2023-12-04 10:37:46'),
(4, 1, 'roles', 'roles.store', '2023-12-04 10:37:46', '2023-12-04 10:37:46'),
(5, 1, 'roles', 'roles.edit', '2023-12-04 10:37:46', '2023-12-04 10:37:46'),
(6, 1, 'roles', 'roles.update', '2023-12-04 10:37:46', '2023-12-04 10:37:46'),
(7, 1, 'roles', 'roles.delete', '2023-12-04 10:37:46', '2023-12-04 10:37:46'),
(8, 1, 'admins', 'admin.list', '2023-12-04 10:37:46', '2023-12-04 10:37:46'),
(9, 1, 'admins', 'admin.create', '2023-12-04 10:37:46', '2023-12-04 10:37:46'),
(10, 1, 'admins', 'admin.store', '2023-12-04 10:37:46', '2023-12-04 10:37:46'),
(11, 1, 'admins', 'admin.edit', '2023-12-04 10:37:46', '2023-12-04 10:37:46'),
(12, 1, 'admins', 'admin.update', '2023-12-04 10:37:46', '2023-12-04 10:37:46'),
(13, 1, 'admins', 'admin.delete', '2023-12-04 10:37:46', '2023-12-04 10:37:46'),
(14, 1, 'users', 'user.list', '2023-12-04 10:37:46', '2023-12-04 10:37:46'),
(15, 1, 'users', 'user.edit', '2023-12-04 10:37:46', '2023-12-04 10:37:46'),
(16, 1, 'users', 'user.view', '2023-12-04 10:37:46', '2023-12-04 10:37:46'),
(17, 1, 'drivers', 'driver.list', '2023-12-04 10:37:46', '2023-12-04 10:37:46'),
(18, 1, 'drivers', 'driver.edit', '2023-12-04 10:37:46', '2023-12-04 10:37:46'),
(19, 1, 'drivers', 'driver.view', '2023-12-04 10:37:46', '2023-12-04 10:37:46'),
(20, 1, 'documents', 'document.list', '2023-12-04 10:37:46', '2023-12-04 10:37:46'),
(21, 1, 'documents', 'document.create', '2023-12-04 10:37:46', '2023-12-04 10:37:46'),
(22, 1, 'documents', 'document.edit', '2023-12-04 10:37:46', '2023-12-04 10:37:46'),
(23, 1, 'deleted-documents', 'document.deleted', '2023-12-04 10:37:46', '2023-12-04 10:37:46'),
(24, 1, 'reports', 'user.report', '2023-12-04 10:37:46', '2023-12-04 10:37:46'),
(25, 1, 'reports', 'driver.report', '2023-12-04 10:37:46', '2023-12-04 10:37:46'),
(26, 1, 'reports', 'ride.report', '2023-12-04 10:37:46', '2023-12-04 10:37:46'),
(27, 1, 'reports', 'intercity.report', '2023-12-04 10:37:46', '2023-12-04 10:37:46'),
(28, 1, 'reports', 'transaction.report', '2023-12-04 10:37:46', '2023-12-04 10:37:46'),
(29, 1, 'service', 'service.list', '2023-12-04 10:37:46', '2023-12-04 10:37:46'),
(30, 1, 'service', 'service.create', '2023-12-04 10:37:46', '2023-12-04 10:37:46'),
(31, 1, 'service', 'service.edit', '2023-12-04 10:37:46', '2023-12-04 10:37:46'),
(32, 1, 'ride_order', 'order.list', '2023-12-04 10:37:46', '2023-12-04 10:37:46'),
(33, 1, 'ride_order', 'order.view', '2023-12-04 10:37:46', '2023-12-04 10:37:46'),
(34, 1, 'intercity_service', 'intercity.service.list', '2023-12-04 10:37:46', '2023-12-04 10:37:46'),
(35, 1, 'intercity_service', 'intercity.service.edit', '2023-12-04 10:37:46', '2023-12-04 10:37:46'),
(36, 1, 'intercity_order', 'intercity.order.list', '2023-12-04 10:37:46', '2023-12-04 10:37:46'),
(37, 1, 'intercity_order', 'intercity.order.view', '2023-12-04 10:37:46', '2023-12-04 10:37:46'),
(38, 1, 'freight', 'freight.list', '2023-12-04 10:37:46', '2023-12-04 10:37:46'),
(39, 1, 'freight', 'freight.create', '2023-12-04 10:37:46', '2023-12-04 10:37:46'),
(40, 1, 'freight', 'freight.edit', '2023-12-04 10:37:46', '2023-12-04 10:37:46'),
(41, 1, 'airports', 'airports.list', '2023-12-04 10:37:46', '2023-12-04 10:37:46'),
(42, 1, 'airports', 'airports.create', '2023-12-04 10:37:46', '2023-12-04 10:37:46'),
(43, 1, 'airports', 'airports.edit', '2023-12-04 10:37:46', '2023-12-04 10:37:46'),
(44, 1, 'vehicle-type', 'vehicle.type.list', '2023-12-04 10:37:46', '2023-12-04 10:37:46'),
(45, 1, 'vehicle-type', 'vehicle.type.create', '2023-12-04 10:37:46', '2023-12-04 10:37:46'),
(46, 1, 'vehicle-type', 'vehicle.type.edit', '2023-12-04 10:37:46', '2023-12-04 10:37:46'),
(47, 1, 'driver-rules', 'rule.list', '2023-12-04 10:37:46', '2023-12-04 10:37:46'),
(48, 1, 'driver-rules', 'rule.create', '2023-12-04 10:37:46', '2023-12-04 10:37:46'),
(49, 1, 'driver-rules', 'rule.edit', '2023-12-04 10:37:46', '2023-12-04 10:37:46'),
(50, 1, 'deleted-driver-rules', 'rule.delete.list', '2023-12-04 10:37:46', '2023-12-04 10:37:46'),
(51, 1, 'cms', 'cms.list', '2023-12-04 10:37:46', '2023-12-04 10:37:46'),
(52, 1, 'cms', 'cms.create', '2023-12-04 10:37:46', '2023-12-04 10:37:46'),
(53, 1, 'cms', 'cms.edit', '2023-12-04 10:37:46', '2023-12-04 10:37:46'),
(54, 1, 'banners', 'banners.list', '2023-12-04 10:37:46', '2023-12-04 10:37:46'),
(55, 1, 'banners', 'banners.create', '2023-12-04 10:37:46', '2023-12-04 10:37:46'),
(56, 1, 'banners', 'banners.edit', '2023-12-04 10:37:46', '2023-12-04 10:37:46'),
(57, 1, 'deleted-banner', 'banner.delete.list', '2023-12-04 10:37:46', '2023-12-04 10:37:46'),
(58, 1, 'on-board', 'onboard.list', '2023-12-04 10:37:46', '2023-12-04 10:37:46'),
(59, 1, 'on-board', 'onboard.edit', '2023-12-04 10:37:46', '2023-12-04 10:37:46'),
(60, 1, 'faq', 'faq.list', '2023-12-04 10:37:46', '2023-12-04 10:37:46'),
(61, 1, 'faq', 'faq.create', '2023-12-04 10:37:46', '2023-12-04 10:37:46'),
(62, 1, 'faq', 'faq.edit', '2023-12-04 10:37:46', '2023-12-04 10:37:46'),
(63, 1, 'sos', 'sos.list', '2023-12-04 10:37:46', '2023-12-04 10:37:46'),
(64, 1, 'sos', 'sos.edit', '2023-12-04 10:37:46', '2023-12-04 10:37:46'),
(65, 1, 'tax', 'tax.list', '2023-12-04 10:37:46', '2023-12-04 10:37:46'),
(66, 1, 'tax', 'tax.create', '2023-12-04 10:37:46', '2023-12-04 10:37:46'),
(67, 1, 'tax', 'tax.edit', '2023-12-04 10:37:46', '2023-12-04 10:37:46'),
(68, 1, 'coupon', 'coupon.list', '2023-12-04 10:37:46', '2023-12-04 10:37:46'),
(69, 1, 'coupon', 'coupon.create', '2023-12-04 10:37:46', '2023-12-04 10:37:46'),
(70, 1, 'coupon', 'coupon.edit', '2023-12-04 10:37:46', '2023-12-04 10:37:46'),
(71, 1, 'deleted-coupon', 'coupon.delete.list', '2023-12-04 10:37:46', '2023-12-04 10:37:46'),
(72, 1, 'currency', 'currency.list', '2023-12-04 10:37:46', '2023-12-04 10:37:46'),
(73, 1, 'currency', 'currency.create', '2023-12-04 10:37:46', '2023-12-04 10:37:46'),
(74, 1, 'currency', 'currency.edit', '2023-12-04 10:37:46', '2023-12-04 10:37:46'),
(75, 1, 'language', 'language.list', '2023-12-04 10:37:46', '2023-12-04 10:37:46'),
(76, 1, 'language', 'language.create', '2023-12-04 10:37:46', '2023-12-04 10:37:46'),
(77, 1, 'language', 'language.edit', '2023-12-04 10:37:46', '2023-12-04 10:37:46'),
(78, 1, 'deleted-language', 'language.delete.list', '2023-12-04 10:37:46', '2023-12-04 10:37:46'),
(79, 1, 'payout-request', 'payout-request', '2023-12-04 10:37:46', '2023-12-04 10:37:46'),
(80, 1, 'drivers-wallet-transaction', 'driver.wallet.list', '2023-12-04 10:37:46', '2023-12-04 10:37:46'),
(81, 1, 'users-wallet-transaction', 'user.wallet.list', '2023-12-04 10:37:46', '2023-12-04 10:37:46'),
(82, 1, 'global-setting', 'global-setting', '2023-12-04 10:37:46', '2023-12-04 10:37:46'),
(83, 1, 'admin-commission', 'admin-commision', '2023-12-04 10:37:46', '2023-12-04 10:37:46'),
(84, 1, 'payment-method', 'payment-method', '2023-12-04 10:37:46', '2023-12-04 10:37:46'),
(85, 1, 'homepageTemplate', 'home-page', '2023-12-04 10:37:46', '2023-12-04 10:37:46'),
(86, 1, 'header-template', 'header', '2023-12-04 10:37:46', '2023-12-04 10:37:46'),
(87, 1, 'footer-template', 'footer', '2023-12-04 10:37:46', '2023-12-04 10:37:46'),
(88, 1, 'privacy', 'privacy', '2023-12-04 10:37:46', '2023-12-04 10:37:46'),
(89, 1, 'terms', 'terms', '2023-12-04 10:37:46', '2023-12-04 10:37:46'),
(90, 1, 'users', 'user.delete', '2023-12-06 13:26:13', '2023-12-06 13:26:13'),
(91, 1, 'drivers', 'driver.delete', '2023-12-06 13:26:13', '2023-12-06 13:26:13'),
(92, 1, 'approve_drivers', 'approve.driver.list', '2023-12-06 13:26:13', '2023-12-06 13:26:13'),
(93, 1, 'approve_drivers', 'approve.driver.delete', '2023-12-06 13:26:13', '2023-12-06 13:26:13'),
(94, 1, 'pending_drivers', 'pending.driver.list', '2023-12-06 13:26:13', '2023-12-06 13:26:13'),
(95, 1, 'pending_drivers', 'pending.driver.delete', '2023-12-06 13:26:13', '2023-12-06 13:26:13'),
(96, 1, 'documents', 'document.delete', '2023-12-06 13:26:13', '2023-12-06 13:26:13'),
(97, 1, 'service', 'service.delete', '2023-12-06 13:26:13', '2023-12-06 13:26:13'),
(98, 1, 'intercity_service', 'intercity.service.delete', '2023-12-06 13:26:13', '2023-12-06 13:26:13'),
(99, 1, 'freight', 'freight.delete', '2023-12-06 13:26:13', '2023-12-06 13:26:13'),
(100, 1, 'airports', 'airports.delete', '2023-12-06 13:26:13', '2023-12-06 13:26:13'),
(101, 1, 'vehicle-type', 'vehicle.type.delete', '2023-12-06 13:26:13', '2023-12-06 13:26:13'),
(102, 1, 'driver-rules', 'rule.delete', '2023-12-06 13:26:13', '2023-12-06 13:26:13'),
(103, 1, 'cms', 'cms.delete', '2023-12-06 13:26:13', '2023-12-06 13:26:13'),
(104, 1, 'banners', 'banners.delete', '2023-12-06 13:26:13', '2023-12-06 13:26:13'),
(105, 1, 'faq', 'faq.delete', '2023-12-06 13:26:13', '2023-12-06 13:26:13'),
(106, 1, 'sos', 'sos.delete', '2023-12-06 13:26:13', '2023-12-06 13:26:13'),
(107, 1, 'tax', 'tax.delete', '2023-12-06 13:26:13', '2023-12-06 13:26:13'),
(108, 1, 'coupon', 'coupon.delete', '2023-12-06 13:26:13', '2023-12-06 13:26:13'),
(109, 1, 'currency', 'currency.delete', '2023-12-06 13:26:13', '2023-12-06 13:26:13'),
(110, 1, 'language', 'language.delete', '2023-12-06 13:26:13', '2023-12-06 13:26:13'),
(111, 1, 'drivers-document', 'driver.document.list', '2023-12-07 06:42:52', '2023-12-07 06:42:52'),
(112, 1, 'drivers-document', 'driver.document.edit', '2023-12-07 06:43:23', '2023-12-07 06:43:23'),
(113, 1, 'zone', 'zone.list', '2024-04-30 08:00:33', '2024-04-30 08:00:33'),
(114, 1, 'zone', 'zone.create', '2024-04-30 08:00:33', '2024-04-30 08:00:33'),
(115, 1, 'zone', 'zone.edit', '2024-04-30 08:00:33', '2024-04-30 08:00:33'),
(116, 1, 'zone', 'zone.delete', '2024-04-30 08:00:33', '2024-04-30 08:00:33'),
(117, 1, 'notification-setting', 'notification-setting', '2024-06-06 10:27:37', '2024-06-06 10:27:37'),
(118, 1, 'vehicle-brand', 'vehicle.brand.list', '2024-06-06 10:28:06', '2024-06-06 10:28:06'),
(119, 1, 'vehicle-brand', 'vehicle.brand.create', '2024-06-06 10:28:38', '2024-06-06 10:28:38'),
(120, 1, 'vehicle-brand', 'vehicle.brand.edit', '2024-06-06 10:29:11', '2024-06-06 10:29:11'),
(121, 1, 'vehicle-brand', 'vehicle.brand.delete', '2024-06-06 10:29:35', '2024-06-06 10:29:35'),
(122, 1, 'vehicle-model', 'vehicle.model.list', '2024-06-06 10:29:59', '2024-06-06 10:29:59'),
(123, 1, 'vehicle-model', 'vehicle.model.create', '2024-06-06 10:30:24', '2024-06-06 10:30:24'),
(124, 1, 'vehicle-model', 'vehicle.model.edit', '2024-06-06 10:30:44', '2024-06-06 10:30:44'),
(125, 1, 'vehicle-model', 'vehicle.model.delete', '2024-06-06 10:31:05', '2024-06-06 10:31:05'),
(126, 1, 'approve_users', 'approve.user.list', '2024-06-18 06:22:42', '2024-06-18 06:22:42'),
(127, 1, 'pending_users', 'pending.user.list', '2024-06-18 06:23:05', '2024-06-18 06:23:05'),
(128, 1, 'approve_users', 'approve.user.delete', '2024-06-18 06:31:17', '2024-06-18 06:31:17'),
(129, 1, 'pending_users', 'pending.user.delete', '2024-06-18 06:31:47', '2024-06-18 06:31:47'),
(130, 1, 'document-list', 'user.document.list', '2024-06-24 06:19:01', '2024-06-24 06:19:01'),
(131, 1, 'document-upload', 'user.document.upload', '2024-06-24 06:19:22', '2024-06-24 06:19:22'),
(132, 1, 'complaint-subject', 'complaint.subject.list', '2024-06-24 06:19:43', '2024-06-24 06:19:43'),
(133, 1, 'complaint-subject', 'complaint.subject.create', '2024-06-24 06:20:02', '2024-06-24 06:20:02'),
(134, 1, 'complaint-subject', 'complaint.subject.edit', '2024-06-24 06:20:22', '2024-06-24 06:20:22'),
(135, 1, 'dynamic-notification', 'dynamic.notification.list', '2024-06-24 06:20:43', '2024-06-24 06:20:43'),
(136, 1, 'dynamic-notification', 'dynamic.notification.edit', '2024-06-24 06:21:03', '2024-06-24 06:21:03'),
(137, 1, 'complaints', 'complaints.list', '2024-06-24 06:21:26', '2024-06-24 06:21:26'),
(138, 1, 'user-ride-detail', 'user.ride.detail', '2024-06-24 06:21:45', '2024-06-24 06:21:45'),
(139, 1, 'complaints', 'complaints.edit', '2024-06-24 12:30:41', '2024-06-24 12:30:41'),
(140, 1, 'complaints', 'complaints.delete', '2024-06-24 12:31:02', '2024-06-24 12:31:02'),
(141, 1, 'complaint-subject', 'complaint.subject.delete', '2024-06-24 12:33:47', '2024-06-24 12:33:47'),
(142, 1, 'ride_order', 'order.delete', '2024-06-24 12:41:49', '2024-06-24 12:41:49'),
(143, 1, 'email-template', 'email.template.index', '2024-07-01 12:22:25', '2024-07-01 12:22:25'),
(144, 1, 'email-template', 'email.template.save', '2024-07-01 12:22:41', '2024-07-01 12:22:41');

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` bigint UNSIGNED NOT NULL,
  `role_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `role_name`, `created_at`, `updated_at`) VALUES
(1, 'Super Administrator', '2023-11-27 05:10:43', '2023-11-27 06:36:20');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role_id` int NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `role_id`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Super Admin', 'rombar24@gmail.com', NULL, '$2y$10$vZ7TraQx9bY3EOlE8rFc0eA31IuCYF.biJ6PVTAf7sADeKKFPJyuC', 1, 'UGHW1B4ESISFLmXGX44qtKHXKCqnkkml6lt6z87VI63zVGpL7EOj8aqBKrk9', '2022-02-26 12:22:29', '2024-08-21 08:47:39');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
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
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=145;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
