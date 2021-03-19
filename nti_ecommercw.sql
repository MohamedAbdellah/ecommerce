-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 19, 2021 at 12:40 AM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 7.3.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `nti_ecommercw`
--

-- --------------------------------------------------------

--
-- Table structure for table `addresses`
--

CREATE TABLE `addresses` (
  `id` int(10) NOT NULL,
  `street` text NOT NULL,
  `building` text NOT NULL,
  `floor` text NOT NULL,
  `flat` text NOT NULL,
  `note` text NOT NULL,
  `user_id` int(10) NOT NULL,
  `region_id` int(10) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(10) NOT NULL,
  `name` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `phot` varchar(50) NOT NULL,
  `phone` varchar(50) NOT NULL,
  `gender` tinyint(1) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `id` int(10) NOT NULL,
  `quantity` varchar(50) NOT NULL,
  `sub_total` int(10) NOT NULL,
  `total` int(10) NOT NULL,
  `user_id` int(10) NOT NULL,
  `product_id` int(10) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `id` int(10) NOT NULL,
  `name` varchar(50) NOT NULL,
  `photo` varchar(100) NOT NULL,
  `status` tinyint(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `name`, `photo`, `status`) VALUES
(1, 'sa7ya', 'default.png', 1),
(2, 'tgmlya', 'default.png', 1),
(3, 'tb5', 'default.png', 1),
(4, 'tarkibat', 'default.png', 1);

-- --------------------------------------------------------

--
-- Table structure for table `cities`
--

CREATE TABLE `cities` (
  `id` int(10) NOT NULL,
  `name` varchar(255) NOT NULL,
  `longitude` float NOT NULL,
  `latitude` float NOT NULL,
  `distance` float NOT NULL,
  `status` tinyint(4) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `cities`
--

INSERT INTO `cities` (`id`, `name`, `longitude`, `latitude`, `distance`, `status`, `created_at`, `updated_at`) VALUES
(1, 'cairo', 30, 33, 20, 1, '2021-03-15 09:17:15', '2021-03-15 09:17:15'),
(2, 'Alex', 22, 21, 15, 1, '2021-03-15 09:17:41', '2021-03-15 09:17:41'),
(3, 'Giza', 12, 12, 10, 1, '2021-03-15 09:18:20', '2021-03-15 09:18:20');

-- --------------------------------------------------------

--
-- Table structure for table `coupons`
--

CREATE TABLE `coupons` (
  `id` int(10) NOT NULL,
  `code` int(10) NOT NULL,
  `type` varchar(50) NOT NULL,
  `max_order` int(10) NOT NULL,
  `min_order` int(10) NOT NULL,
  `discount` int(10) NOT NULL,
  `count` int(10) NOT NULL,
  `gender` tinyint(1) NOT NULL,
  `account_num` int(10) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `offers`
--

CREATE TABLE `offers` (
  `id` int(10) NOT NULL,
  `name` varchar(50) NOT NULL,
  `status` varchar(50) NOT NULL,
  `discount` int(10) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `offers_products`
--

CREATE TABLE `offers_products` (
  `product_id` int(10) NOT NULL,
  `offer_id` int(10) NOT NULL,
  `price_after_discount` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(10) NOT NULL,
  `status` varchar(50) NOT NULL,
  `time` varchar(50) NOT NULL,
  `code` int(10) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp(),
  `total` int(10) NOT NULL,
  `order_id` int(10) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `status`, `time`, `code`, `date`, `total`, `order_id`, `created_at`, `updated_at`) VALUES
(1, 'done', '', 12, '2021-03-18 23:03:23', 120, 1, '2021-03-18 23:03:23', '2021-03-18 23:03:23'),
(2, 'done', '', 11, '2021-03-18 23:03:52', 11, 2, '2021-03-18 23:03:52', '2021-03-18 23:03:52'),
(3, 'done', '', 77, '2021-03-18 23:09:05', 77, 3, '2021-03-18 23:09:05', '2021-03-18 23:09:05'),
(4, 'done', '', 44, '2021-03-18 23:09:44', 78, 4, '2021-03-18 23:09:44', '2021-03-18 23:09:44');

-- --------------------------------------------------------

--
-- Table structure for table `orders_products`
--

CREATE TABLE `orders_products` (
  `product_id` int(10) NOT NULL,
  `order_id` int(10) NOT NULL,
  `price` float NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `orders_products`
--

INSERT INTO `orders_products` (`product_id`, `order_id`, `price`, `created_at`, `updated_at`) VALUES
(3, 1, 6, '2021-03-18 23:06:20', '2021-03-18 23:06:20'),
(3, 2, 11, '2021-03-18 23:04:30', '2021-03-18 23:04:30'),
(3, 3, 6, '2021-03-18 23:10:22', '2021-03-18 23:10:22'),
(5, 1, 44, '2021-03-18 23:05:46', '2021-03-18 23:05:46'),
(5, 2, 6, '2021-03-18 23:08:10', '2021-03-18 23:08:10'),
(6, 1, 120, '2021-03-18 23:04:30', '2021-03-18 23:04:30'),
(6, 2, 4, '2021-03-18 23:06:55', '2021-03-18 23:06:55'),
(6, 3, 6, '2021-03-18 23:10:22', '2021-03-18 23:10:22'),
(6, 4, 7, '2021-03-18 23:10:59', '2021-03-18 23:10:59'),
(12, 1, 12, '2021-03-18 23:05:46', '2021-03-18 23:05:46');

-- --------------------------------------------------------

--
-- Stand-in structure for view `producr_review`
-- (See below for the actual view)
--
CREATE TABLE `producr_review` (
`id` int(10)
,`name` varchar(255)
,`details` longtext
,`photo` varchar(255)
,`stock` int(10)
,`code` int(5)
,`status` tinyint(1)
,`subcaterory_id` int(10)
,`created_at` timestamp
,`updated_at` timestamp
,`price` decimal(8,2)
,`product_avg_rate` decimal(4,0)
,`product_count_reviews` bigint(21)
);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(10) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `details` longtext DEFAULT NULL,
  `photo` varchar(255) DEFAULT 'default.png',
  `stock` int(10) DEFAULT NULL,
  `code` int(5) DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `subcaterory_id` int(10) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `price` decimal(8,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `details`, `photo`, `stock`, `code`, `status`, `subcaterory_id`, `created_at`, `updated_at`, `price`) VALUES
(2, 'yanson', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 150012121,', '1.png', 12, 12121, 1, 7, '2021-03-17 18:44:20', '2021-03-17 18:44:20', '11.00'),
(3, 'ganzabil', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s,', '2.png', 12, 121211, 1, 7, '2021-03-17 18:45:18', '2021-03-17 18:45:18', '9.70'),
(4, 'shata', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s,', '3.png', 12, 1111, 1, 12, '2021-03-17 18:46:58', '2021-03-17 18:46:58', '12.50'),
(5, 'kmon', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s,', '4.png', 12, 11234, 1, 12, '2021-03-17 18:49:22', '2021-03-17 18:49:22', '22.00'),
(6, '7bhan', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s,', '5.png', 12, 122347, 1, 12, '2021-03-17 18:50:18', '2021-03-17 18:50:18', '2.20'),
(7, 'sodany', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s,', '6.png', 12, 13422, 1, 10, '2021-03-17 18:52:12', '2021-03-17 18:52:12', '12.00'),
(8, 'zyt zayton', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s,', '7.png', 12, 13422, 1, 11, '2021-03-17 18:53:25', '2021-03-17 18:53:25', '12.00'),
(9, 'zyt dora', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s,', '8.png', 12, 13462, 1, 11, '2021-03-17 18:54:11', '2021-03-17 18:54:11', '12.00'),
(10, 'shy a5dar', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s,', '9.png', 12, 6666, 1, 1, '2021-03-17 18:56:24', '2021-03-17 18:56:24', '12.60'),
(11, 'qahowa 5dra', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s,', '10.png', 12, 3333, 1, 1, '2021-03-17 18:56:24', '2021-03-17 18:56:24', '11.00'),
(12, 'milk', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s,', 'milk.png', 12, 32223, 1, 1, '2021-03-18 19:19:39', '2021-03-18 19:19:39', '11.00'),
(13, 'tamr_hendy', 'drink', 'tamr.png', 12, 88786, 1, 7, '2021-03-18 22:42:22', '2021-03-18 22:42:22', '55.00');

-- --------------------------------------------------------

--
-- Table structure for table `products_specs`
--

CREATE TABLE `products_specs` (
  `spec_id` int(10) NOT NULL,
  `product_id` int(10) NOT NULL,
  `value` varchar(20) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `products_specs`
--

INSERT INTO `products_specs` (`spec_id`, `product_id`, `value`, `created_at`, `updated_at`) VALUES
(1, 2, 'red', '2021-03-18 20:28:36', '2021-03-18 20:28:36'),
(2, 2, '12', '2021-03-18 20:28:36', '2021-03-18 20:28:36'),
(3, 2, '111', '2021-03-18 20:28:36', '2021-03-18 20:28:36'),
(4, 2, '20', '2021-03-18 20:28:36', '2021-03-18 20:28:36');

-- --------------------------------------------------------

--
-- Stand-in structure for view `product_orders`
-- (See below for the actual view)
--
CREATE TABLE `product_orders` (
`product_id` int(10)
,`order_id` int(10)
,`price` float
,`created_at` timestamp
,`updated_at` timestamp
,`product_count` bigint(21)
);

-- --------------------------------------------------------

--
-- Table structure for table `ratings`
--

CREATE TABLE `ratings` (
  `user_id` int(10) NOT NULL,
  `product_id` int(10) NOT NULL,
  `value` tinyint(1) NOT NULL,
  `comment` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ratings`
--

INSERT INTO `ratings` (`user_id`, `product_id`, `value`, `comment`, `created_at`, `updated_at`) VALUES
(3, 2, 3, 'good', '2021-03-18 18:57:17', '2021-03-18 18:57:17'),
(3, 3, 2, 'bad', '2021-03-18 18:55:17', '2021-03-18 18:55:17'),
(3, 4, 1, 'bad', '2021-03-18 18:56:41', '2021-03-18 18:56:41'),
(3, 5, 5, 'exellent', '2021-03-18 18:56:07', '2021-03-18 18:56:07'),
(3, 6, 4, 'very good', '2021-03-18 18:55:17', '2021-03-18 18:55:17'),
(3, 7, 5, 'exellent', '2021-03-18 18:56:41', '2021-03-18 18:56:41'),
(3, 8, 5, 'exellent', '2021-03-18 18:57:35', '2021-03-18 18:57:35'),
(3, 9, 2, 'bad', '2021-03-18 18:57:17', '2021-03-18 18:57:17'),
(3, 10, 4, 'very good', '2021-03-18 18:58:49', '2021-03-18 18:58:49'),
(3, 11, 3, 'good', '2021-03-18 18:56:07', '2021-03-18 18:56:07'),
(4, 2, 5, 'exellent', '2021-03-18 19:14:31', '2021-03-18 19:14:31'),
(4, 3, 2, 'bad', '2021-03-18 19:14:31', '2021-03-18 19:14:31'),
(4, 4, 2, 'bad', '2021-03-18 19:14:31', '2021-03-18 19:14:31'),
(4, 5, 3, 'good', '2021-03-18 19:14:31', '2021-03-18 19:14:31'),
(4, 6, 1, 'bad', '2021-03-18 19:14:31', '2021-03-18 19:14:31'),
(4, 7, 5, 'exellent', '2021-03-18 19:14:31', '2021-03-18 19:14:31'),
(4, 8, 5, 'exellent', '2021-03-18 19:14:31', '2021-03-18 19:14:31'),
(4, 9, 2, 'bad', '2021-03-18 19:14:31', '2021-03-18 19:14:31'),
(4, 10, 4, 'good', '2021-03-18 19:14:31', '2021-03-18 19:14:31'),
(4, 11, 1, 'bad', '2021-03-18 19:14:31', '2021-03-18 19:14:31');

-- --------------------------------------------------------

--
-- Table structure for table `regions`
--

CREATE TABLE `regions` (
  `id` int(10) NOT NULL,
  `name` varchar(50) NOT NULL,
  `lattiude` varchar(50) NOT NULL,
  `longtiude` varchar(50) NOT NULL,
  `distance` int(50) NOT NULL,
  `status` varchar(50) NOT NULL,
  `city_id` int(10) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `regions`
--

INSERT INTO `regions` (`id`, `name`, `lattiude`, `longtiude`, `distance`, `status`, `city_id`, `created_at`, `updated_at`) VALUES
(1, 'naser city', '12', '21', 11, '1', 1, '2021-03-15 09:19:22', '2021-03-15 09:19:22'),
(2, 'maadi', '12', '22', 11, '1', 1, '2021-03-15 09:19:59', '2021-03-15 09:19:59'),
(3, 'ain shames', '11', '11', 1, '1', 1, '2021-03-15 09:20:19', '2021-03-15 09:20:19'),
(4, 'dokki', '11', '12', 11, '1', 3, '2021-03-15 09:20:39', '2021-03-15 09:20:39'),
(5, 'smoha', '11', '121', 1, '1', 2, '2021-03-15 09:20:59', '2021-03-15 09:20:59'),
(6, 'Smart village', '1', '1', 1, '1', 3, '2021-03-15 09:21:45', '2021-03-15 09:21:45');

-- --------------------------------------------------------

--
-- Table structure for table `specs`
--

CREATE TABLE `specs` (
  `id` int(11) NOT NULL,
  `keyEle` varchar(100) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `specs`
--

INSERT INTO `specs` (`id`, `keyEle`, `created_at`, `updated_at`) VALUES
(1, 'color', '2021-03-18 20:19:59', '2021-03-18 20:19:59'),
(2, 'size', '2021-03-18 20:19:59', '2021-03-18 20:19:59'),
(3, 'weight', '2021-03-18 20:20:49', '2021-03-18 20:20:49'),
(4, 'grams', '2021-03-18 20:20:49', '2021-03-18 20:20:49');

-- --------------------------------------------------------

--
-- Table structure for table `subcategory`
--

CREATE TABLE `subcategory` (
  `id` int(10) NOT NULL,
  `name` varchar(50) NOT NULL,
  `photo` varchar(255) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `cat_id` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `subcategory`
--

INSERT INTO `subcategory` (`id`, `name`, `photo`, `status`, `created_at`, `updated_at`, `cat_id`) VALUES
(1, 'ta5sys', '', 0, '2021-03-17 18:33:10', '2021-03-17 18:33:10', 1),
(2, 'sh3r w bashra', '', 0, '2021-03-17 18:33:10', '2021-03-17 18:33:10', 1),
(7, 'da3t', '', 0, '2021-03-17 18:36:08', '2021-03-17 18:36:08', 1),
(10, 'mksarat', '', 0, '2021-03-17 18:37:09', '2021-03-17 18:37:09', 3),
(11, 'zyot', '', 0, '2021-03-17 18:37:45', '2021-03-17 18:37:45', 2),
(12, 'tawabl', '', 0, '2021-03-17 18:38:06', '2021-03-17 18:38:06', 3),
(13, '3rqsos', '', 1, '2021-03-18 16:54:46', '2021-03-18 16:54:46', 4);

-- --------------------------------------------------------

--
-- Table structure for table `suppliers`
--

CREATE TABLE `suppliers` (
  `id` int(10) NOT NULL,
  `name` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `photo` varchar(50) NOT NULL,
  `status` varchar(50) NOT NULL,
  `nationl_id` varchar(50) NOT NULL,
  `gender` tinyint(1) NOT NULL,
  `account_num` int(10) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) NOT NULL,
  `first` varchar(50) NOT NULL,
  `last` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `phone` varchar(14) NOT NULL,
  `password` varchar(255) NOT NULL,
  `photo` varchar(255) NOT NULL DEFAULT 'default.png',
  `gender` tinyint(1) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `code` int(5) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `first`, `last`, `email`, `phone`, `password`, `photo`, `gender`, `status`, `code`, `created_at`, `updated_at`) VALUES
(3, 'mohamed', 'Abdellah', 'mohmed0abdellah@gmail.com', '0201007492547', 'f2f3aa4d72d3e35e4414fba4985a6e44abb3b8bd', 'default.png', 0, 1, 60880, '2021-03-17 17:57:20', '2021-03-17 17:57:20'),
(4, 'ahmed', 'fathy', 'njmnulgswwdsdftcnd@wqcefp.com', '0201007492548', 'c9ee68713d12283f9e71f4afde81d1e1f85ae39d', 'default.png', 0, 1, 12019, '2021-03-18 19:10:46', '2021-03-18 19:10:46');

-- --------------------------------------------------------

--
-- Table structure for table `website_info`
--

CREATE TABLE `website_info` (
  `id` int(10) NOT NULL,
  `email` varchar(50) NOT NULL,
  `phone` varchar(50) NOT NULL,
  `addres` varchar(50) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure for view `producr_review`
--
DROP TABLE IF EXISTS `producr_review`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `producr_review`  AS  (select `products`.`id` AS `id`,`products`.`name` AS `name`,`products`.`details` AS `details`,`products`.`photo` AS `photo`,`products`.`stock` AS `stock`,`products`.`code` AS `code`,`products`.`status` AS `status`,`products`.`subcaterory_id` AS `subcaterory_id`,`products`.`created_at` AS `created_at`,`products`.`updated_at` AS `updated_at`,`products`.`price` AS `price`,if(round(avg(`ratings`.`value`),0) is null,0,round(avg(`ratings`.`value`),0)) AS `product_avg_rate`,count(`ratings`.`product_id`) AS `product_count_reviews` from (`products` left join `ratings` on(`ratings`.`product_id` = `products`.`id`)) group by `products`.`id`) ;

-- --------------------------------------------------------

--
-- Structure for view `product_orders`
--
DROP TABLE IF EXISTS `product_orders`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `product_orders`  AS  (select `orders_products`.`product_id` AS `product_id`,`orders_products`.`order_id` AS `order_id`,`orders_products`.`price` AS `price`,`orders_products`.`created_at` AS `created_at`,`orders_products`.`updated_at` AS `updated_at`,count(`orders_products`.`product_id`) AS `product_count` from `orders_products` group by `orders_products`.`product_id` desc) ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `addresses`
--
ALTER TABLE `addresses`
  ADD PRIMARY KEY (`id`),
  ADD KEY `addresses_user_FK` (`user_id`),
  ADD KEY `addresses_region_FK` (`region_id`);

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_cart_FKs` (`user_id`),
  ADD KEY `products_cart_FKs` (`product_id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cities`
--
ALTER TABLE `cities`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `coupons`
--
ALTER TABLE `coupons`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `offers`
--
ALTER TABLE `offers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `offers_products`
--
ALTER TABLE `offers_products`
  ADD PRIMARY KEY (`product_id`,`offer_id`),
  ADD KEY `offers_products_FK` (`offer_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders_products`
--
ALTER TABLE `orders_products`
  ADD PRIMARY KEY (`product_id`,`order_id`),
  ADD KEY `orders_products_FK` (`order_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `products_subcat_FK` (`subcaterory_id`);

--
-- Indexes for table `products_specs`
--
ALTER TABLE `products_specs`
  ADD PRIMARY KEY (`spec_id`,`product_id`) USING BTREE,
  ADD KEY `products_specs` (`product_id`);

--
-- Indexes for table `ratings`
--
ALTER TABLE `ratings`
  ADD PRIMARY KEY (`user_id`,`product_id`),
  ADD KEY `products_rating_FKS` (`product_id`);

--
-- Indexes for table `regions`
--
ALTER TABLE `regions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `regions_cities_FK` (`city_id`);

--
-- Indexes for table `specs`
--
ALTER TABLE `specs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `subcategory`
--
ALTER TABLE `subcategory`
  ADD PRIMARY KEY (`id`),
  ADD KEY `category_subcat_FKs` (`cat_id`);

--
-- Indexes for table `suppliers`
--
ALTER TABLE `suppliers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `website_info`
--
ALTER TABLE `website_info`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `addresses`
--
ALTER TABLE `addresses`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `cities`
--
ALTER TABLE `cities`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `coupons`
--
ALTER TABLE `coupons`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `offers`
--
ALTER TABLE `offers`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `regions`
--
ALTER TABLE `regions`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `specs`
--
ALTER TABLE `specs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `subcategory`
--
ALTER TABLE `subcategory`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `suppliers`
--
ALTER TABLE `suppliers`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `website_info`
--
ALTER TABLE `website_info`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `addresses`
--
ALTER TABLE `addresses`
  ADD CONSTRAINT `addresses_region_FK` FOREIGN KEY (`region_id`) REFERENCES `regions` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `addresses_user_FK` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `cart`
--
ALTER TABLE `cart`
  ADD CONSTRAINT `products_cart_FKs` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`),
  ADD CONSTRAINT `user_cart_FKs` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `offers_products`
--
ALTER TABLE `offers_products`
  ADD CONSTRAINT `offers_products1_FK` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `offers_products_FK` FOREIGN KEY (`offer_id`) REFERENCES `offers` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `orders_products`
--
ALTER TABLE `orders_products`
  ADD CONSTRAINT `orders_products2_FK` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`),
  ADD CONSTRAINT `orders_products_FK` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_subcat_FK` FOREIGN KEY (`subcaterory_id`) REFERENCES `subcategory` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `products_specs`
--
ALTER TABLE `products_specs`
  ADD CONSTRAINT `products_specs` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `products_specs_specs` FOREIGN KEY (`spec_id`) REFERENCES `specs` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `ratings`
--
ALTER TABLE `ratings`
  ADD CONSTRAINT `products_rating_FKS` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `users_rating_FKS` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `regions`
--
ALTER TABLE `regions`
  ADD CONSTRAINT `regions_cities_FK` FOREIGN KEY (`city_id`) REFERENCES `cities` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `subcategory`
--
ALTER TABLE `subcategory`
  ADD CONSTRAINT `category_subcat_FKs` FOREIGN KEY (`cat_id`) REFERENCES `category` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
