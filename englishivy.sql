-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Dec 05, 2021 at 01:28 PM
-- Server version: 5.7.33
-- PHP Version: 7.4.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `englishivy`
--

-- --------------------------------------------------------

--
-- Table structure for table `about`
--

CREATE TABLE `about` (
  `id` int(11) NOT NULL,
  `title` varchar(128) NOT NULL,
  `description` text NOT NULL,
  `image` varchar(128) NOT NULL,
  `quotes` text NOT NULL,
  `author` varchar(50) NOT NULL,
  `updated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `about`
--

INSERT INTO `about` (`id`, `title`, `description`, `image`, `quotes`, `author`, `updated`) VALUES
(0, 'About English Ivy Coffee', 'Phasellus egestas nisi nisi, lobortis ultricies risus semper nec. Vestibulum pharetra ac ante ut pellentesque. Curabitur fringilla dolor quis lorem accumsan, vitae molestie urna dapibus. Pellentesque porta est ac neque bibendum viverra. Vivamus lobortis magna ut interdum laoreet. Donec gravida lorem elit, quis condimentum ex semper sit amet. Fusce eget ligula magna. Aliquam aliquam imperdiet sodales. Ut fringilla turpis in vehicula vehicula. Pellentesque congue ac orci ut gravida. Aliquam erat volutpat. Donec iaculis lectus a arcu facilisis, eu sodales lectus sagittis. Etiam pellentesque, magna vel dictum rutrum, neque justo eleifend elit, vel tincidunt erat arcu ut sem. Sed rutrum, turpis ut commodo efficitur, quam velit convallis ipsum, et maximus enim ligula ac ligula. Vivamus tristique vulputate ultricies. Sed vitae ultrices orci.', 'logoivy2.png', 'Creativity is just connecting things. When you ask creative people how they did something, they feel a little guilty because they didn\'t really do it, they just saw something. It seemed obvious to them after a while.', 'Steve Job’s', '2021-11-26 11:12:53');

-- --------------------------------------------------------

--
-- Table structure for table `configuration`
--

CREATE TABLE `configuration` (
  `id_config` int(11) NOT NULL,
  `website_name` varchar(128) NOT NULL,
  `tagline` varchar(255) DEFAULT NULL,
  `website` varchar(255) DEFAULT NULL,
  `keywords` text,
  `metatext` text,
  `email` varchar(128) DEFAULT NULL,
  `telephone` varchar(50) DEFAULT NULL,
  `address` varchar(300) DEFAULT NULL,
  `facebook` varchar(128) DEFAULT NULL,
  `instagram` varchar(128) DEFAULT NULL,
  `description` text,
  `logo` varchar(255) DEFAULT NULL,
  `icon` varchar(128) DEFAULT NULL,
  `payment_account` varchar(255) DEFAULT NULL,
  `updated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `configuration`
--

INSERT INTO `configuration` (`id_config`, `website_name`, `tagline`, `website`, `keywords`, `metatext`, `email`, `telephone`, `address`, `facebook`, `instagram`, `description`, `logo`, `icon`, `payment_account`, `updated`) VALUES
(0, 'English Ivy Coffee', 'Welcome to the HOME you never knew you had Co-working Space | Coffee Addict', '', '', '', 'ivy@gmail.com', '000000000000', 'jakal', 'https://id-id.facebook.com/', 'https://www.instagram.com/ivy.coffee/', '', 'namaivy.png', 'logoivy.png', '', '2021-11-18 15:13:07');

-- --------------------------------------------------------

--
-- Table structure for table `customer_table`
--

CREATE TABLE `customer_table` (
  `id` int(11) NOT NULL,
  `table_code` varchar(6) CHARACTER SET utf8mb4 NOT NULL,
  `table_name` varchar(128) CHARACTER SET utf8mb4 NOT NULL,
  `status` varchar(50) CHARACTER SET utf8mb4 NOT NULL,
  `last_visit` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `customer_table`
--

INSERT INTO `customer_table` (`id`, `table_code`, `table_name`, `status`, `last_visit`) VALUES
(1, 'TAB001', 'Meja 1', 'leave', '2021-12-05 13:20:52'),
(2, 'TAB002', 'Meja 2', 'leave', '2021-12-03 16:36:31'),
(3, 'TAB003', 'Meja 3', 'leave', '2021-12-02 05:58:45'),
(4, 'TAB004', 'Meja 4', 'leave', '2021-11-21 13:44:54'),
(5, 'TAB005', 'Meja 5', 'leave', '2021-11-21 13:45:00'),
(6, 'TAB006', 'Meja 6', 'leave', '2021-11-25 17:17:28');

-- --------------------------------------------------------

--
-- Table structure for table `drinks`
--

CREATE TABLE `drinks` (
  `id` int(11) NOT NULL,
  `category` int(11) NOT NULL,
  `drink_code` varchar(32) NOT NULL,
  `drink_name` varchar(128) NOT NULL,
  `drink_image` varchar(128) NOT NULL,
  `price` decimal(10,0) NOT NULL,
  `stock` varchar(15) NOT NULL,
  `discount` decimal(10,0) DEFAULT NULL,
  `description` text NOT NULL,
  `status` varchar(20) NOT NULL,
  `created` datetime NOT NULL,
  `updated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `drinks`
--

INSERT INTO `drinks` (`id`, `category`, `drink_code`, `drink_name`, `drink_image`, `price`, `stock`, `discount`, `description`, `status`, `created`, `updated`) VALUES
(6, 1, 'DRINK001', 'Coffee Latte', 'latte.jpg', '25000', 'Ready-Stock', '0', 'Espresso + Steamed milk.', 'displayed', '2021-12-01 15:43:00', '2021-12-01 08:43:00'),
(7, 1, 'DRINK002', 'Americano', 'americano.jpg', '25000', 'Ready-Stock', '10', 'Espresso + Water', 'displayed', '2021-12-01 15:43:37', '2021-12-01 08:43:39'),
(8, 2, 'DRINK003', 'V60', 'v60.jpg', '25000', 'Ready-Stock', '0', 'kopi', 'displayed', '2021-12-01 15:58:00', '2021-12-01 08:58:00'),
(9, 2, 'DRINK004', 'Tubruk', 'tubruk.jpg', '25000', 'Ready-Stock', '10', 'Kopi + air', 'displayed', '2021-12-01 15:59:51', '2021-12-01 08:59:51'),
(10, 2, 'DRINK005', 'Vietnam Drip', 'vietnamdrip.jpg', '25000', 'Ready-Stock', '0', 'kopi', 'displayed', '2021-12-01 16:00:21', '2021-12-01 09:00:22'),
(11, 5, 'DRINK006', 'Lychee Tea', 'lychee_tea_1.jpg', '25000', 'Ready-Stock', '10', 'Lychee', 'displayed', '2021-12-01 16:01:12', '2021-12-01 09:01:12'),
(12, 5, 'DRINK007', 'Lemon Tea', 'lemon_tea.jpg', '25000', 'Ready-Stock', '10', 'Lemon', 'displayed', '2021-12-01 16:01:39', '2021-12-01 09:01:39'),
(13, 3, 'DRINK008', 'Red Velvet Latte', 'redvelvet.jpg', '25000', 'Ready-Stock', '0', 'Red velvet powder + Sugar + Creamer + Fresh milk', 'displayed', '2021-12-01 16:03:51', '2021-12-01 09:03:51'),
(14, 3, 'DRINK009', 'Taro Latte', 'taro-late.jpg', '25000', 'Ready-Stock', '10', 'Taro powder + Sugar + Creamer + Fresh milk', 'displayed', '2021-12-01 16:04:51', '2021-12-01 09:06:35');

-- --------------------------------------------------------

--
-- Table structure for table `drink_categories`
--

CREATE TABLE `drink_categories` (
  `id` int(11) NOT NULL,
  `category_slug` varchar(255) NOT NULL,
  `category_name` varchar(128) NOT NULL,
  `sorting` int(11) NOT NULL,
  `created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `drink_categories`
--

INSERT INTO `drink_categories` (`id`, `category_slug`, `category_name`, `sorting`, `created`) VALUES
(1, 'espresso-base', 'Espresso Base', 1, '2021-11-21 20:45:57'),
(2, 'manual-brew', 'Manual Brew', 2, '2021-11-21 20:46:10'),
(3, 'latte', 'Latte', 3, '2021-11-21 20:46:20'),
(4, 'mojito', 'Mojito', 4, '2021-11-21 20:46:28'),
(5, 'tea', 'Tea', 5, '2021-11-21 20:46:38'),
(6, 'bland', 'Bland', 6, '2021-11-21 20:46:46'),
(7, 'tropical-splash', 'Tropical Splash', 7, '2021-11-21 20:47:12');

-- --------------------------------------------------------

--
-- Table structure for table `drink_images`
--

CREATE TABLE `drink_images` (
  `id_image` int(11) NOT NULL,
  `id_drink` int(11) NOT NULL,
  `image_name` varchar(128) DEFAULT NULL,
  `image` varchar(255) NOT NULL,
  `updated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `drink_images`
--

INSERT INTO `drink_images` (`id_image`, `id_drink`, `image_name`, `image`, `updated`) VALUES
(1, 14, 'Taro Latte ', 'taro-late-1.jpg', '2021-12-01 09:18:37'),
(2, 14, 'Taro Latte ', 'taro-late-2.jpg', '2021-12-01 09:18:51'),
(3, 13, 'Red Velvet', 'redvelvet3.jpg', '2021-12-01 09:19:42'),
(4, 13, 'Red Velvet', 'redvelvet2.jpg', '2021-12-01 09:19:52');

-- --------------------------------------------------------

--
-- Table structure for table `food`
--

CREATE TABLE `food` (
  `id` int(11) NOT NULL,
  `category` int(11) NOT NULL,
  `food_code` varchar(32) NOT NULL,
  `food_name` varchar(128) NOT NULL,
  `food_image` varchar(128) NOT NULL,
  `price` decimal(10,0) NOT NULL,
  `stock` varchar(15) NOT NULL,
  `discount` decimal(10,0) DEFAULT NULL,
  `description` text NOT NULL,
  `status` varchar(20) NOT NULL,
  `created` datetime NOT NULL,
  `updated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `food`
--

INSERT INTO `food` (`id`, `category`, `food_code`, `food_name`, `food_image`, `price`, `stock`, `discount`, `description`, `status`, `created`, `updated`) VALUES
(2, 1, 'FOOD001', 'Red Velved Cake', 'cake_rv.jpg', '25000', 'Ready-Stock', '0', 'It is the finest Red Velvet cake with layers of soft sponge and cream are courteous.', 'displayed', '2021-11-30 23:16:02', '2021-11-30 16:16:02'),
(3, 1, 'FOOD002', 'Chocolate Mud Cake', 'mud_cake.jpg', '30000', 'Ready-Stock', '10', 'Exquisite chocolate with chocolate moist sponge and glazed with chocolate.', 'displayed', '2021-12-02 13:18:24', '2021-12-02 06:18:24'),
(4, 2, 'FOOD003', 'Potato Wedges', 'potato_wedges.jpg', '20000', 'Ready-Stock', '0', 'Irregular wedge-shaped slices of potato, that are either fried.', 'displayed', '2021-12-02 13:21:12', '2021-12-02 06:21:12'),
(5, 2, 'FOOD004', 'Garlic Bread', 'garlic_bread.jpg', '20000', 'Ready-Stock', '0', 'Consists of bread topped with garlic butter and oregano.', 'displayed', '2021-12-02 13:22:55', '2021-12-02 06:22:55'),
(6, 3, 'FOOD005', 'Cheese Croissant', 'cheese_croissant.jpg', '25000', 'Ready-Stock', '10', 'Croissant with cheese.', 'displayed', '2021-12-02 13:24:33', '2021-12-02 06:24:33'),
(7, 3, 'FOOD006', 'Almond Croissant', 'almond_croissant.jpg', '25000', 'Ready-Stock', '0', 'Croissant with almond.', 'displayed', '2021-12-02 13:25:19', '2021-12-02 06:25:19'),
(8, 3, 'FOOD007', 'Dainish Raisin', 'danish_raisin.jpg', '25000', 'Ready-Stock', '0', 'Croissant with raisin.', 'displayed', '2021-12-02 13:26:28', '2021-12-05 13:07:21');

-- --------------------------------------------------------

--
-- Table structure for table `food_categories`
--

CREATE TABLE `food_categories` (
  `id` int(11) NOT NULL,
  `category_slug` varchar(255) NOT NULL,
  `category_name` varchar(128) NOT NULL,
  `sorting` int(11) NOT NULL,
  `created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `food_categories`
--

INSERT INTO `food_categories` (`id`, `category_slug`, `category_name`, `sorting`, `created`) VALUES
(1, 'cake', 'Cake', 1, '2021-11-30 23:05:18'),
(2, 'snack', 'Snack', 2, '2021-11-30 23:05:39'),
(3, 'croissant', 'Croissant', 3, '2021-11-30 23:05:56');

-- --------------------------------------------------------

--
-- Table structure for table `ingredients`
--

CREATE TABLE `ingredients` (
  `id` int(11) NOT NULL,
  `code` varchar(10) NOT NULL,
  `name` varchar(128) NOT NULL,
  `description` text NOT NULL,
  `unit` varchar(20) NOT NULL,
  `stock` int(11) NOT NULL,
  `created` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `invoice`
--

CREATE TABLE `invoice` (
  `id_invoice` int(11) NOT NULL,
  `cashier` varchar(20) DEFAULT NULL,
  `table_number` varchar(10) NOT NULL,
  `order_type` varchar(20) NOT NULL,
  `customer_name` varchar(50) NOT NULL,
  `transaction_code` varchar(255) NOT NULL,
  `qrcode` varchar(128) DEFAULT NULL,
  `transaction_date` datetime NOT NULL,
  `total_transaction` varchar(128) NOT NULL,
  `payment_status` varchar(20) NOT NULL,
  `order_status` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `invoice`
--

INSERT INTO `invoice` (`id_invoice`, `cashier`, `table_number`, `order_type`, `customer_name`, `transaction_code`, `qrcode`, `transaction_date`, `total_transaction`, `payment_status`, `order_status`) VALUES
(1, NULL, 'TAB001', 'Dine In', 'Ambon', '02122021BKDJGLRVWH', '02122021BKDJGLRVWH.png', '2021-11-02 12:59:50', '72500', 'Complete', 'Complete'),
(2, NULL, 'TAB003', 'Dine In', 'Hims', '02122021Q46QBPF1WX', '02122021Q46QBPF1WX.png', '2021-11-02 14:43:20', '97500', 'Complete', 'Waiting'),
(3, NULL, 'TAB003', 'Dine In', 'Fakkkk', '021220211H9YLYCOID', '021220211H9YLYCOID.png', '2021-11-02 14:44:32', '162500', 'Complete', 'Waiting'),
(4, NULL, 'TAB006', 'Dine In', 'Im', '02122021IDRTUJHV5K', '02122021IDRTUJHV5K.png', '2021-11-02 14:45:18', '197000', 'Complete', 'Waiting'),
(5, NULL, 'TAB005', 'Dine In', 'Him', '02122021GLODIUQNSG', '02122021GLODIUQNSG.png', '2021-11-02 14:45:57', '142500', 'Complete', 'Waiting'),
(6, 'Admin', 'TAB001', 'Dine In', 'Hims', '03122021GI1UIQ9AVY', '03122021GI1UIQ9AVY.png', '2021-12-03 22:59:50', '137750', 'Complete', 'Complete'),
(7, 'Admin', 'TAB001', 'Dine In', 'Ambon', '03122021IXMJLCQ5YL', NULL, '2021-12-03 22:08:41', '42500', 'Complete', 'Complete'),
(8, 'Admin', 'TAB002', 'Dine In', 'Memej', '03122021SPK3SQLZEB', '03122021SPK3SQLZEB.png', '2021-12-03 22:30:42', '119500', 'Complete', 'Complete'),
(9, 'Admin', 'TAB001', 'Dine In', 'aku', '05122021VNA2NHE7OK', '05122021VNA2NHE7OK.png', '2021-12-05 19:57:39', '92000', 'Complete', 'Complete');

-- --------------------------------------------------------

--
-- Table structure for table `offers`
--

CREATE TABLE `offers` (
  `id` int(11) NOT NULL,
  `offers_code` varchar(10) NOT NULL,
  `name` varchar(50) NOT NULL,
  `image` varchar(255) NOT NULL,
  `expired` date NOT NULL,
  `status` varchar(20) NOT NULL,
  `created` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `offers`
--

INSERT INTO `offers` (`id`, `offers_code`, `name`, `image`, `expired`, `status`, `created`) VALUES
(1, 'OFF001', 'Discount 10%', 'ivy-2.jpg', '2021-12-31', 'activated', '2021-11-22'),
(2, 'OFF002', 'Free Donut', 'bronis.jpeg', '2021-12-31', 'activated', '2021-11-22');

-- --------------------------------------------------------

--
-- Table structure for table `service`
--

CREATE TABLE `service` (
  `id` int(11) NOT NULL,
  `title` varchar(128) NOT NULL,
  `description` varchar(255) NOT NULL,
  `status` varchar(20) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `service`
--

INSERT INTO `service` (`id`, `title`, `description`, `status`, `date`) VALUES
(1, 'Free Delivery Worldwide', 'Click here for more info', 'displayed', '2021-11-21 13:43:49'),
(2, '30 Days Return', 'Simply return it within 30 days for an exchange.', 'displayed', '2021-11-21 13:44:05'),
(3, 'Store Opening', 'Shop open from Monday to Sunday', 'displayed', '2021-11-21 13:44:17');

-- --------------------------------------------------------

--
-- Table structure for table `sidebar_menu`
--

CREATE TABLE `sidebar_menu` (
  `id` int(11) NOT NULL,
  `menu` varchar(128) NOT NULL,
  `url_menu` varchar(50) DEFAULT NULL,
  `icon` varchar(128) NOT NULL,
  `sorting` int(11) NOT NULL,
  `submenu` varchar(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `sidebar_menu`
--

INSERT INTO `sidebar_menu` (`id`, `menu`, `url_menu`, `icon`, `sorting`, `submenu`) VALUES
(1, 'Dashboard Admin', 'user/admin', 'fas fa-fw fa-home', 1, 'NO'),
(2, 'Dashboard Barista', 'user/barista', 'fas fa-fw fa-home', 1, 'NO'),
(3, 'Monitoring Cafe', 'monitoring', 'fas fa-fw fa-newspaper', 2, 'NO'),
(4, 'Cafe Transactions', NULL, 'fas fa-fw fa-file-invoice-dollar', 3, 'YES'),
(5, 'Order List', 'orderlist', 'fas fa-fw fa-clipboard-list', 3, 'NO'),
(6, 'Master Data Management', NULL, 'fas fa-fw fa-database', 4, 'YES'),
(8, 'User Profile', NULL, 'fas fa-fw fa-user-cog', 5, 'YES'),
(9, 'User Management', NULL, 'fas fa-fw fa-users-cog', 5, 'YES'),
(10, 'Reports & Statistics', NULL, 'fas fa-fw fa-chart-line', 6, 'YES'),
(11, 'Website Settings', NULL, 'fas fa-fw fa-cogs', 7, 'YES'),
(12, 'Front-end Settings', NULL, 'fas fa-fw fa-chalkboard', 8, 'YES'),
(13, 'FAQ Website', 'website/faq', 'fas fa-fw fa-info-circle', 9, 'NO'),
(14, 'About Website', 'website/about', 'fas fa-fw fa-heart', 10, 'NO'),
(15, 'Sign Out', 'auth/logout', 'fas fa-fw fa-sign-out-alt', 11, 'NO'),
(16, 'Dashboard Owner', 'user/owner', 'fas fa-fw fa-home', 1, 'NO');

-- --------------------------------------------------------

--
-- Table structure for table `sidebar_submenu`
--

CREATE TABLE `sidebar_submenu` (
  `id` int(11) NOT NULL,
  `menu_id` int(11) NOT NULL,
  `title` varchar(128) NOT NULL,
  `url` varchar(128) NOT NULL,
  `icon` varchar(255) NOT NULL,
  `is_active` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `sidebar_submenu`
--

INSERT INTO `sidebar_submenu` (`id`, `menu_id`, `title`, `url`, `icon`, `is_active`) VALUES
(1, 11, 'Sidebar Menu', 'configuration/sidebarmenu', 'fa fa-fw fa-folder', 1),
(2, 11, 'Sidebar SubMenu', 'configuration/submenu', 'fa fa-fw fa-folder-open', 1),
(3, 8, 'My Profile', 'user', 'fas fa-fw fa-id-card', 1),
(4, 8, 'Change Password', 'user/changepass', 'fas fa-fw fa-key', 1),
(5, 9, 'Management Role', 'manageuser', 'fas fa-fw fa-user-tag', 1),
(6, 9, 'Management User', 'manageuser/manageuser', 'fas fa-fw fa-users-cog', 1),
(7, 11, 'Configuration', 'configuration', 'fas fa-fw fa-cog', 1),
(8, 11, 'Config Logo', 'configuration/configlogo', 'far fa-fw fa-images', 1),
(9, 6, 'Drink Categories', 'drinks/categories', 'fas fa-fw fa-tag', 1),
(10, 6, 'Drink List', 'drinks', 'fas fa-fw fa-coffee', 1),
(11, 6, 'Food Categories', 'food/categories', 'fa fa-fw fa-tags', 1),
(12, 6, 'Food List', 'food', 'fas fa-fw fa-utensils', 1),
(13, 6, 'Ingredients', 'ingredients', 'fas fa-fw fa-shopping-basket', 1),
(14, 6, 'Customer Table', 'table', 'fas fa-fw fa-chair', 1),
(15, 6, 'Special Offers', 'offers', 'fas fa-fw fa-percent', 1),
(17, 4, 'Scan Transaction', 'transactions', 'fas fa-fw fa-qrcode', 1),
(18, 4, 'Sales Transactions', 'transactions/sales', 'fas fa-fw fa-money-check-alt', 1),
(19, 4, 'List Transactions', 'transactions/listtransactions', 'fas fa-fw fa-clipboard', 1),
(20, 12, 'Slider Settings', 'configuration/slider', 'fas fa-fw fa-sliders-h', 1),
(21, 12, 'About Settings', 'configuration/about', 'fas fa-fw fa-address-card', 1),
(22, 12, 'Service Settings', 'configuration/service', 'fas fa-fw fa-toolbox', 1),
(23, 10, 'Sales Report', 'reportsstatistics', 'fas fa-fw fa-file-invoice', 1);

-- --------------------------------------------------------

--
-- Table structure for table `slider_settings`
--

CREATE TABLE `slider_settings` (
  `id_slider` int(11) NOT NULL,
  `name` varchar(128) NOT NULL,
  `image` varchar(255) NOT NULL,
  `title` varchar(128) NOT NULL,
  `caption` varchar(255) NOT NULL,
  `link` varchar(128) NOT NULL,
  `text_link` varchar(50) NOT NULL,
  `is_active` int(1) NOT NULL,
  `created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `slider_settings`
--

INSERT INTO `slider_settings` (`id_slider`, `name`, `image`, `title`, `caption`, `link`, `text_link`, `is_active`, `created`) VALUES
(1, 'Slider 1', 'ivy-4.jpg', 'English Ivy Coffee', 'Best coffee shop in indonesia', 'homepage', 'Shop Now', 1, '2021-11-21 20:38:41'),
(2, 'Slider 2', 'ivy-1.jpg', 'English Ivy Coffee', 'Best coffee shop in indonesia', 'homepage', 'Shop Now', 1, '2021-11-21 20:39:11');

-- --------------------------------------------------------

--
-- Table structure for table `transaction`
--

CREATE TABLE `transaction` (
  `id_transaction` int(11) NOT NULL,
  `transaction_code` varchar(255) NOT NULL,
  `code_product` varchar(15) NOT NULL,
  `price` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `total_price` int(11) NOT NULL,
  `transaction_date` datetime NOT NULL,
  `status_queue` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `transaction`
--

INSERT INTO `transaction` (`id_transaction`, `transaction_code`, `code_product`, `price`, `quantity`, `total_price`, `transaction_date`, `status_queue`) VALUES
(1, '02122021BKDJGLRVWH', 'DRINK009', 22500, 1, 22500, '2021-11-02 12:59:50', 'Complete'),
(2, '02122021BKDJGLRVWH', 'DRINK003', 25000, 1, 25000, '2021-11-02 12:59:50', 'Complete'),
(3, '02122021BKDJGLRVWH', 'FOOD001', 25000, 1, 25000, '2021-11-02 12:59:50', 'Complete'),
(4, '02122021Q46QBPF1WX', 'DRINK004', 22500, 1, 22500, '2021-11-02 14:43:20', 'Waiting'),
(5, '02122021Q46QBPF1WX', 'DRINK005', 25000, 2, 50000, '2021-11-02 14:43:20', 'Waiting'),
(6, '02122021Q46QBPF1WX', 'FOOD006', 25000, 1, 25000, '2021-11-02 14:43:20', 'Waiting'),
(7, '021220211H9YLYCOID', 'DRINK001', 25000, 2, 50000, '2021-11-02 14:44:32', 'Waiting'),
(8, '021220211H9YLYCOID', 'DRINK003', 25000, 2, 50000, '2021-11-02 14:44:32', 'Waiting'),
(9, '021220211H9YLYCOID', 'DRINK002', 22500, 1, 22500, '2021-11-02 14:44:32', 'Waiting'),
(10, '021220211H9YLYCOID', 'FOOD003', 20000, 1, 20000, '2021-11-02 14:44:32', 'Waiting'),
(11, '021220211H9YLYCOID', 'FOOD004', 20000, 1, 20000, '2021-11-02 14:44:32', 'Waiting'),
(12, '02122021IDRTUJHV5K', 'DRINK003', 25000, 2, 50000, '2021-11-02 14:45:18', 'Waiting'),
(13, '02122021IDRTUJHV5K', 'DRINK008', 25000, 1, 25000, '2021-11-02 14:45:18', 'Waiting'),
(14, '02122021IDRTUJHV5K', 'DRINK009', 22500, 1, 22500, '2021-11-02 14:45:18', 'Waiting'),
(15, '02122021IDRTUJHV5K', 'DRINK006', 22500, 1, 22500, '2021-11-02 14:45:18', 'Waiting'),
(16, '02122021IDRTUJHV5K', 'DRINK005', 25000, 1, 25000, '2021-11-02 14:45:18', 'Waiting'),
(17, '02122021IDRTUJHV5K', 'FOOD007', 25000, 1, 25000, '2021-11-02 14:45:18', 'Waiting'),
(18, '02122021IDRTUJHV5K', 'FOOD002', 27000, 1, 27000, '2021-11-02 14:45:18', 'Waiting'),
(19, '02122021GLODIUQNSG', 'DRINK003', 25000, 1, 25000, '2021-11-02 14:45:57', 'Waiting'),
(20, '02122021GLODIUQNSG', 'DRINK002', 22500, 1, 22500, '2021-11-02 14:45:57', 'Waiting'),
(21, '02122021GLODIUQNSG', 'DRINK001', 25000, 1, 25000, '2021-11-02 14:45:57', 'Waiting'),
(22, '02122021GLODIUQNSG', 'DRINK004', 22500, 1, 22500, '2021-11-02 14:45:57', 'Waiting'),
(23, '02122021GLODIUQNSG', 'DRINK007', 22500, 1, 22500, '2021-11-02 14:45:57', 'Waiting'),
(24, '02122021GLODIUQNSG', 'FOOD006', 25000, 1, 25000, '2021-11-02 14:45:57', 'Waiting'),
(25, '03122021GI1UIQ9AVY', 'DRINK003', 25000, 1, 25000, '2021-12-03 22:59:50', 'Waiting'),
(26, '03122021GI1UIQ9AVY', 'DRINK009', 20250, 1, 20250, '2021-12-03 22:59:50', 'Waiting'),
(27, '03122021GI1UIQ9AVY', 'FOOD006', 25000, 1, 25000, '2021-12-03 22:59:50', 'Waiting'),
(28, '03122021GI1UIQ9AVY', 'FOOD003', 20000, 1, 20000, '2021-12-03 22:59:50', 'Waiting'),
(29, '03122021GI1UIQ9AVY', 'DRINK002', 22500, 1, 22500, '2021-12-03 22:59:50', 'Waiting'),
(30, '03122021GI1UIQ9AVY', 'FOOD001', 25000, 1, 25000, '2021-12-03 22:59:50', 'Waiting'),
(32, '03122021SPK3SQLZEB', 'DRINK009', 22500, 1, 22500, '2021-12-03 22:30:42', 'Complete'),
(33, '03122021SPK3SQLZEB', 'DRINK003', 25000, 4, 50000, '2021-12-03 22:30:42', 'Complete'),
(34, '03122021SPK3SQLZEB', 'FOOD003', 20000, 1, 20000, '2021-12-03 22:30:42', 'Complete'),
(35, '03122021SPK3SQLZEB', 'FOOD002', 27000, 1, 27000, '2021-12-03 22:30:42', 'Complete'),
(36, '05122021VNA2NHE7OK', 'FOOD003', 20000, 2, 40000, '2021-12-05 19:57:41', 'Complete'),
(37, '05122021VNA2NHE7OK', 'DRINK001', 25000, 1, 25000, '2021-12-05 19:57:41', 'Complete'),
(38, '05122021VNA2NHE7OK', 'FOOD002', 27000, 1, 27000, '2021-12-05 19:57:41', 'Complete');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `name` varchar(128) NOT NULL,
  `email` varchar(128) NOT NULL,
  `image` varchar(128) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role_id` int(11) NOT NULL,
  `is_active` int(1) NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `name`, `email`, `image`, `password`, `role_id`, `is_active`, `created_at`) VALUES
(1, 'Admin', 'admin@gmail.com', 'images.png', '$2y$10$uGshhGLlgBhTCHeA03my3u6FltCh9ZyZQ0rHM5TRIBQSQqll0AC..', 1, 1, '2021-11-18 14:55:15'),
(2, 'Member', 'member@gmail.com', 'default.png', '$2y$10$8xxGXisrN6CdgOYl652GMefUiZs3K/lvmIyZZkPDK0I64cFvbqp8y', 2, 1, '2021-11-24 00:23:43'),
(3, 'Barista', 'barista@gmail.com', 'default.png', '$2y$10$rKeVXN67StanPO9T9FSFS.FGJJ3IJE2zq9ddYx2b.1Ow9JtBTbFKu', 3, 1, '2021-11-24 00:24:17'),
(4, 'Owner', 'owner@gmail.com', 'default.png', '$2y$10$6SVyFwtYU4U.VfHHQcsaE.hM99oSbDZk0aq6ktswKcPavttMGyIQi', 4, 1, '2021-11-24 00:24:37');

-- --------------------------------------------------------

--
-- Table structure for table `user_access_menu`
--

CREATE TABLE `user_access_menu` (
  `id` int(11) NOT NULL,
  `role_id` int(11) NOT NULL,
  `menu_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_access_menu`
--

INSERT INTO `user_access_menu` (`id`, `role_id`, `menu_id`) VALUES
(1, 1, 1),
(3, 1, 4),
(5, 1, 6),
(8, 1, 9),
(9, 1, 10),
(10, 1, 11),
(11, 1, 12),
(12, 1, 13),
(13, 1, 14),
(14, 1, 15),
(15, 2, 8),
(16, 2, 15),
(17, 2, 14),
(18, 2, 13),
(19, 3, 2),
(20, 3, 3),
(21, 3, 5),
(22, 3, 8),
(23, 3, 15),
(24, 3, 14),
(25, 3, 13),
(26, 3, 7),
(27, 4, 8),
(28, 4, 10),
(29, 4, 13),
(30, 4, 14),
(31, 4, 15),
(32, 4, 16);

-- --------------------------------------------------------

--
-- Table structure for table `user_role`
--

CREATE TABLE `user_role` (
  `id` int(11) NOT NULL,
  `role` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_role`
--

INSERT INTO `user_role` (`id`, `role`) VALUES
(1, 'Administrator'),
(2, 'Member'),
(3, 'Barista'),
(4, 'Owner');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `about`
--
ALTER TABLE `about`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `configuration`
--
ALTER TABLE `configuration`
  ADD PRIMARY KEY (`id_config`);

--
-- Indexes for table `customer_table`
--
ALTER TABLE `customer_table`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `table_code` (`table_code`);

--
-- Indexes for table `drinks`
--
ALTER TABLE `drinks`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `product_code` (`drink_code`),
  ADD KEY `id_category` (`category`);

--
-- Indexes for table `drink_categories`
--
ALTER TABLE `drink_categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `drink_images`
--
ALTER TABLE `drink_images`
  ADD PRIMARY KEY (`id_image`);

--
-- Indexes for table `food`
--
ALTER TABLE `food`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `product_code` (`food_code`),
  ADD KEY `category` (`category`);

--
-- Indexes for table `food_categories`
--
ALTER TABLE `food_categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ingredients`
--
ALTER TABLE `ingredients`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `invoice`
--
ALTER TABLE `invoice`
  ADD PRIMARY KEY (`id_invoice`);

--
-- Indexes for table `offers`
--
ALTER TABLE `offers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `service`
--
ALTER TABLE `service`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sidebar_menu`
--
ALTER TABLE `sidebar_menu`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sidebar_submenu`
--
ALTER TABLE `sidebar_submenu`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `slider_settings`
--
ALTER TABLE `slider_settings`
  ADD PRIMARY KEY (`id_slider`);

--
-- Indexes for table `transaction`
--
ALTER TABLE `transaction`
  ADD PRIMARY KEY (`id_transaction`),
  ADD KEY `transaction_code` (`transaction_code`),
  ADD KEY `id_product` (`code_product`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_access_menu`
--
ALTER TABLE `user_access_menu`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_role`
--
ALTER TABLE `user_role`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `about`
--
ALTER TABLE `about`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `configuration`
--
ALTER TABLE `configuration`
  MODIFY `id_config` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `customer_table`
--
ALTER TABLE `customer_table`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `drinks`
--
ALTER TABLE `drinks`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `drink_categories`
--
ALTER TABLE `drink_categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `drink_images`
--
ALTER TABLE `drink_images`
  MODIFY `id_image` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `food`
--
ALTER TABLE `food`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `food_categories`
--
ALTER TABLE `food_categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `ingredients`
--
ALTER TABLE `ingredients`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `invoice`
--
ALTER TABLE `invoice`
  MODIFY `id_invoice` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `offers`
--
ALTER TABLE `offers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `service`
--
ALTER TABLE `service`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `sidebar_menu`
--
ALTER TABLE `sidebar_menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `sidebar_submenu`
--
ALTER TABLE `sidebar_submenu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `slider_settings`
--
ALTER TABLE `slider_settings`
  MODIFY `id_slider` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `transaction`
--
ALTER TABLE `transaction`
  MODIFY `id_transaction` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `user_access_menu`
--
ALTER TABLE `user_access_menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `user_role`
--
ALTER TABLE `user_role`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
