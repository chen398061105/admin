-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- ホスト: 127.0.0.1
-- 生成日時: 2020-09-25 11:06:16
-- サーバのバージョン： 10.4.11-MariaDB
-- PHP のバージョン: 7.4.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- データベース: `f-admin`
--

-- --------------------------------------------------------

--
-- テーブルの構造 `file_type`
--

CREATE TABLE `file_type` (
  `id` int(11) NOT NULL,
  `type` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- テーブルのデータのダンプ `file_type`
--

INSERT INTO `file_type` (`id`, `type`) VALUES
(1, 'csv'),
(2, 'pdf'),
(3, 'xls'),
(4, 'xlsx');

-- --------------------------------------------------------

--
-- テーブルの構造 `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- テーブルのデータのダンプ `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2017_07_04_104528_create_admin_users_table', 1),
(2, '2017_07_04_104719_create_admin_roles_table', 1),
(3, '2017_07_04_104933_create_admin_logs_table', 1),
(4, '2017_07_04_104933_create_admin_menus_table', 1),
(5, '2017_07_04_104933_create_admin_permission_menu_table', 1),
(6, '2017_07_04_104933_create_admin_permission_role_table', 1),
(7, '2017_07_04_104933_create_admin_permissions_table', 1),
(8, '2017_07_04_104933_create_admin_role_menu_table', 1),
(9, '2017_07_04_104933_create_admin_role_user_table', 1),
(10, '2014_10_12_000000_create_users_table', 2),
(11, '2014_10_12_100000_create_password_resets_table', 2),
(12, '2019_08_19_000000_create_failed_jobs_table', 2);

-- --------------------------------------------------------

--
-- テーブルの構造 `permission`
--

CREATE TABLE `permission` (
  `id` int(10) UNSIGNED NOT NULL COMMENT 'ID',
  `title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '权限标题 ',
  `controllers` varchar(512) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '对应的controllers',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- テーブルのデータのダンプ `permission`
--

INSERT INTO `permission` (`id`, `title`, `controllers`, `created_at`, `updated_at`) VALUES
(3, '账户管理权限', 'App\\Http\\Controllers\\Admin\\UsersController@index', '2020-09-18 01:45:24', '2020-09-18 01:45:24'),
(4, '角色管理权限', 'App\\Http\\Controllers\\Admin\\RoleController@index', '2020-09-18 01:45:24', '2020-09-18 01:45:24'),
(5, '权限管理权限', 'App\\Http\\Controllers\\Admin\\PermController@index', '2020-09-18 01:45:24', '2020-09-18 01:45:24'),
(12, '商品管理权限', 'App\\Http\\Controllers\\Admin\\ProductsController@index', NULL, NULL),
(13, '后台显示权限', 'App\\Http\\Controllers\\Admin\\HomeController@welcome', NULL, NULL),
(14, '后台访问权限', 'App\\Http\\Controllers\\Admin\\HomeController@index', NULL, NULL);

-- --------------------------------------------------------

--
-- テーブルの構造 `products`
--

CREATE TABLE `products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `order_no` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `order_date` date DEFAULT NULL,
  `category` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `order_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `order_number` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `send_date` date DEFAULT NULL,
  `info` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- テーブルのデータのダンプ `products`
--

INSERT INTO `products` (`id`, `order_no`, `order_date`, `category`, `name`, `order_name`, `order_number`, `status`, `send_date`, `info`) VALUES
(1661, '1002', '2020-01-01', '靴下', '鞋子3', 'test', '5565657', '3', '2020-01-01', '靴下詳細です'),
(1662, '1002', '2020-01-02', '靴下', '靴下1', '山本', 'jp5565657', '1', '2020-01-02', '靴下詳細です'),
(1663, '1003', '2020-01-03', '服装', '服装1', '王塚台', 'jp5565657', '2', '2020-01-03', '服装詳細です'),
(1664, '1004', '2020-01-04', '化粧品', '化粧品1', '池袋', 'jp5565657', '0', '2020-01-04', '化粧品詳細です'),
(1665, '1005', '2020-01-05', '靴下', '靴下1', '山本', 'jp5565657', '1', '2020-01-05', '靴下詳細です'),
(1666, '1006', '2020-01-06', '服装', '服装1', '王塚台', 'jp5565657', '2', '2020-01-06', '服装詳細です'),
(1667, '1007', '2020-01-07', '化粧品', '化粧品1', '池袋', 'jp5565657', '0', '2020-01-07', '化粧品詳細です'),
(1668, '1002', '2020-01-01', '靴下', '鞋子3', 'test', '5565657', '3', '2020-01-01', '靴下詳細です'),
(1669, '1002', '2020-01-02', '靴下', '靴下1', '山本', 'jp5565657', '1', '2020-01-02', '靴下詳細です'),
(1670, '1003', '2020-01-03', '服装', '服装1', '王塚台', 'jp5565657', '2', '2020-01-03', '服装詳細です'),
(1671, '1004', '2020-01-04', '化粧品', '化粧品1', '池袋', 'jp5565657', '0', '2020-01-04', '化粧品詳細です'),
(1672, '1005', '2020-01-05', '靴下', '靴下1', '山本', 'jp5565657', '1', '2020-01-05', '靴下詳細です'),
(1673, '1006', '2020-01-06', '服装', '服装1', '王塚台', 'jp5565657', '2', '2020-01-06', '服装詳細です'),
(1674, '1007', '2020-01-07', '化粧品', '化粧品1', '池袋', 'jp5565657', '0', '2020-01-07', '化粧品詳細です'),
(1675, '1002', '2020-01-01', '靴下', '鞋子3', 'test', '5565657', '3', '2020-01-01', '靴下詳細です'),
(1676, '1002', '2020-01-02', '靴下', '靴下1', '山本', 'jp5565657', '1', '2020-01-02', '靴下詳細です'),
(1677, '1003', '2020-01-03', '服装', '服装1', '王塚台', 'jp5565657', '2', '2020-01-03', '服装詳細です'),
(1678, '1004', '2020-01-04', '化粧品', '化粧品1', '池袋', 'jp5565657', '0', '2020-01-04', '化粧品詳細です'),
(1679, '1005', '2020-01-05', '靴下', '靴下1', '山本', 'jp5565657', '1', '2020-01-05', '靴下詳細です'),
(1680, '1006', '2020-01-06', '服装', '服装1', '王塚台', 'jp5565657', '2', '2020-01-06', '服装詳細です'),
(1681, '1007', '2020-01-07', '化粧品', '化粧品1', '池袋', 'jp5565657', '0', '2020-01-07', '化粧品詳細です'),
(1682, '1002', '2020-01-01', '靴下', '鞋子3', 'test', '5565657', '3', '2020-01-01', '靴下詳細です'),
(1683, '1002', '2020-01-02', '靴下', '靴下1', '山本', 'jp5565657', '1', '2020-01-02', '靴下詳細です'),
(1684, '1003', '2020-01-03', '服装', '服装1', '王塚台', 'jp5565657', '2', '2020-01-03', '服装詳細です'),
(1685, '1004', '2020-01-04', '化粧品', '化粧品1', '池袋', 'jp5565657', '0', '2020-01-04', '化粧品詳細です'),
(1686, '1005', '2020-01-05', '靴下', '靴下1', '山本', 'jp5565657', '1', '2020-01-05', '靴下詳細です'),
(1687, '1006', '2020-01-06', '服装', '服装1', '王塚台', 'jp5565657', '2', '2020-01-06', '服装詳細です'),
(1688, '1007', '2020-01-07', '化粧品', '化粧品1', '池袋', 'jp5565657', '0', '2020-01-07', '化粧品詳細です');

-- --------------------------------------------------------

--
-- テーブルの構造 `role`
--

CREATE TABLE `role` (
  `id` int(10) NOT NULL,
  `role_name` varchar(32) NOT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- テーブルのデータのダンプ `role`
--

INSERT INTO `role` (`id`, `role_name`, `updated_at`, `created_at`) VALUES
(1, '超级管理员', NULL, NULL),
(2, '普通管理员', '2020-09-22 23:54:16', NULL);

-- --------------------------------------------------------

--
-- テーブルの構造 `role_permission`
--

CREATE TABLE `role_permission` (
  `id` int(11) NOT NULL,
  `role_id` int(11) NOT NULL COMMENT '角色id',
  `permission_id` int(11) NOT NULL COMMENT '权限id'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- テーブルのデータのダンプ `role_permission`
--

INSERT INTO `role_permission` (`id`, `role_id`, `permission_id`) VALUES
(8, 11, 6),
(9, 17, 5),
(128, 22, 9),
(166, 1, 3),
(167, 1, 4),
(168, 1, 5),
(169, 1, 12),
(170, 1, 13),
(171, 1, 14),
(172, 2, 12),
(173, 2, 13),
(174, 2, 14);

-- --------------------------------------------------------

--
-- テーブルの構造 `user`
--

CREATE TABLE `user` (
  `id` int(10) UNSIGNED NOT NULL COMMENT 'ID',
  `username` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '用户名',
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '密码',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- テーブルのデータのダンプ `user`
--

INSERT INTO `user` (`id`, `username`, `password`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'eyJpdiI6IjlJamZoblwvMVoxUFpcL3Q0a3JNWmtYQT09IiwidmFsdWUiOiIrWVgxN0hzK1FIVWMwd3orNHlXb2RBPT0iLCJtYWMiOiI5NGM1OTk0N2FiNzU2MjA3MGFmYjM4NTFjY2MzZDA1MmRlOTYzY2RlNTAwZjIyZWExOTc2OWU3ZDE1OTZhOTQ3In0=', '2020-09-18 01:45:24', '2020-09-21 21:01:15'),
(6, 'user02', 'eyJpdiI6IjArN2pEVThvcXYwRWN6UHlWeGs0dVE9PSIsInZhbHVlIjoiRXg5dmRDRGlMQzFIRU1ra1Q1bHBhQT09IiwibWFjIjoiNzEyNzhjNGE0ZTBlYmRmYzI2NjE0MjNjMjY4OWNmNDk0ZDc4NmFlYTQ5ZTIyZTU4YTM0OGY0NmJjMGMzMzAyZCJ9', '2020-09-21 18:18:45', '2020-09-23 05:00:20'),
(36, 'user01', 'eyJpdiI6ImlzN3pYMmdEWlVZUmNBbVRWb1ZITlE9PSIsInZhbHVlIjoiYmZQUWwzdFh3TEdxWVRSKzg1TDJcL1E9PSIsIm1hYyI6ImM4NTY3N2FlZDhhMjk5YmU1ZTA5ODAzZGVlNTM4OWQ2NzZmZmNlOGFkODNjYjk3N2RlNTU5MDBmOGY1Yjc3M2YifQ==', '2020-09-23 07:05:12', '2020-09-23 07:05:12');

-- --------------------------------------------------------

--
-- テーブルの構造 `user_role`
--

CREATE TABLE `user_role` (
  `id` int(11) NOT NULL,
  `user_id` int(10) NOT NULL,
  `role_id` int(10) NOT NULL DEFAULT 2
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- テーブルのデータのダンプ `user_role`
--

INSERT INTO `user_role` (`id`, `user_id`, `role_id`) VALUES
(32, 1, 1),
(33, 6, 2);

--
-- ダンプしたテーブルのインデックス
--

--
-- テーブルのインデックス `file_type`
--
ALTER TABLE `file_type`
  ADD PRIMARY KEY (`id`);

--
-- テーブルのインデックス `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- テーブルのインデックス `permission`
--
ALTER TABLE `permission`
  ADD PRIMARY KEY (`id`);

--
-- テーブルのインデックス `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- テーブルのインデックス `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`id`);

--
-- テーブルのインデックス `role_permission`
--
ALTER TABLE `role_permission`
  ADD PRIMARY KEY (`id`);

--
-- テーブルのインデックス `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- テーブルのインデックス `user_role`
--
ALTER TABLE `user_role`
  ADD PRIMARY KEY (`id`);

--
-- ダンプしたテーブルのAUTO_INCREMENT
--

--
-- テーブルのAUTO_INCREMENT `file_type`
--
ALTER TABLE `file_type`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- テーブルのAUTO_INCREMENT `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- テーブルのAUTO_INCREMENT `permission`
--
ALTER TABLE `permission`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'ID', AUTO_INCREMENT=15;

--
-- テーブルのAUTO_INCREMENT `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1689;

--
-- テーブルのAUTO_INCREMENT `role`
--
ALTER TABLE `role`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- テーブルのAUTO_INCREMENT `role_permission`
--
ALTER TABLE `role_permission`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=175;

--
-- テーブルのAUTO_INCREMENT `user`
--
ALTER TABLE `user`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'ID', AUTO_INCREMENT=37;

--
-- テーブルのAUTO_INCREMENT `user_role`
--
ALTER TABLE `user_role`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
