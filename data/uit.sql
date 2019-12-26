-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 26, 2019 at 01:41 PM
-- Server version: 10.4.10-MariaDB
-- PHP Version: 7.3.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `uit`
--

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `cat_id` int(11) NOT NULL,
  `cat_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`cat_id`, `cat_name`) VALUES
(1, 'Samsung'),
(2, 'Oppo'),
(3, 'Apple');

-- --------------------------------------------------------

--
-- Table structure for table `dataset`
--

CREATE TABLE `dataset` (
  `link_id` int(11) NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `link_name` varchar(1024) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `dataset`
--

INSERT INTO `dataset` (`link_id`, `product_name`, `link_name`) VALUES
(1, 'iphone x 64gb', 'https://www.thegioididong.com/dtdd/iphone-x-64gb'),
(2, 'iphone x 64gb', 'https://www.thegioididong.com/tin-tuc/iphone-x-64gb-gray-giam-soc-toi-4-trieu-dong-1113557'),
(3, 'iphone x 64gb', 'https://fptshop.com.vn/dien-thoai/iphone-x'),
(4, 'iphone x 64gb', 'https://fptshop.com.vn/may-doi-tra/dien-thoai-cu-gia-re/iphone-x-htm'),
(5, 'iphone x 64gb', 'https://fptshop.com.vn/dien-thoai/iphone-x/338058/tra-gop'),
(6, 'iphone x 64gb', 'https://viettelstore.vn/dien-thoai/iphone-x-64gb-pid118486.html'),
(7, 'iphone x 64gb', 'https://didongviet.vn/iphone-x-64gb-like-new'),
(9, 'iphone x 64gb', 'https://www.hnammobile.com/dien-thoai/apple-iphone-x-64gb.12497.html');

-- --------------------------------------------------------

--
-- Table structure for table `inventory_in`
--

CREATE TABLE `inventory_in` (
  `inventory_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `import_date` datetime NOT NULL,
  `quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `inventory_in`
--

INSERT INTO `inventory_in` (`inventory_id`, `product_id`, `import_date`, `quantity`) VALUES
(1, 1, '2019-09-03 00:00:00', 1),
(2, 1, '2019-09-04 00:00:00', 1);

-- --------------------------------------------------------

--
-- Table structure for table `inventory_out`
--

CREATE TABLE `inventory_out` (
  `io_id` int(11) NOT NULL,
  `inventory_id` int(11) NOT NULL,
  `export_date` datetime NOT NULL,
  `quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `inventory_out`
--

INSERT INTO `inventory_out` (`io_id`, `inventory_id`, `export_date`, `quantity`) VALUES
(1, 1, '2019-09-04 00:00:00', 1);

-- --------------------------------------------------------

--
-- Table structure for table `inventory_performance`
--

CREATE TABLE `inventory_performance` (
  `ip_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `from_date` datetime NOT NULL,
  `to_date` datetime NOT NULL,
  `performance` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `inventory_performance`
--

INSERT INTO `inventory_performance` (`ip_id`, `product_id`, `from_date`, `to_date`, `performance`) VALUES
(1, 1, '2019-08-01 00:00:00', '2019-12-30 00:00:00', 529053),
(2, 2, '2019-08-01 00:00:00', '2019-12-30 00:00:00', 528053);

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `product_id` int(11) NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `product_price` int(20) NOT NULL,
  `cat_id` int(11) NOT NULL,
  `product_img` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`product_id`, `product_name`, `product_price`, `cat_id`, `product_img`) VALUES
(1, 'Samsung Galaxy A20s', 4390000, 1, 'samsung-galaxy-a20s-black-600x600.jpg'),
(2, 'Samsung Galaxy A30', 4990000, 1, 'samsung-galaxy-a30-32gb-600x600.jpg'),
(3, 'Samsung Galaxy A30s', 5590000, 1, 'samsung-galaxy-a30s-green-600x600.jpg'),
(4, 'Samsung Galaxy A50', 6990000, 1, 'samsung-galaxy-a50-black-600x600.jpg'),
(5, 'Samsung Galaxy A50s', 6290000, 1, 'samsung-galaxy-a50s-green-600x600.jpg'),
(6, 'Samsung Galaxy A51', 7990000, 1, 'samsung-galaxy-a51-white-600x600.jpg'),
(7, 'Samsung Galaxy A7', 6990000, 1, 'samsung-galaxy-a7-2018-blue-600x600.jpg'),
(8, 'Oppo A1K', 2990000, 2, 'oppo-a1k-red-600x600.jpg'),
(9, 'Oppo A5s', 3290000, 2, 'oppo-a5s-red-600x600.jpg'),
(10, 'Oppo A7', 3990000, 2, 'oppo-a7-green-600x600.jpg'),
(11, 'Oppo F11', 5490000, 2, 'oppo-f11-mtp-600x600.jpg'),
(12, 'Oppo F11 Pro', 6490000, 2, 'oppo-f11-pro-128gb-600x600.jpg'),
(13, 'Oppo K3', 5490000, 2, 'oppo-k3-black-600x600.jpg'),
(14, 'Oppo Reno', 9490000, 2, 'oppo-reno-pink-600x600.jpg'),
(15, 'Oppo Reno 2', 14990000, 2, 'oppo-reno2-f-green-mtp-600x600-1-600x600.jpg'),
(16, 'iPhone 7 Plus', 12990000, 3, 'iphone-7-plus-32gb-gold-600x600-600x600.jpg'),
(17, 'iPhone 8 Plus', 15990000, 3, 'iphone-8-plus-hh-600x600-600x600.jpg'),
(18, 'iPhone 11 Pro Max', 33990000, 3, 'iphone-11-pro-max-green-600x600.jpg'),
(19, 'iPhone Xs Max', 27990000, 3, 'iphone-xs-max-256gb-white-600x600.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `product_analysis`
--

CREATE TABLE `product_analysis` (
  `table_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `visited_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `product_analysis`
--

INSERT INTO `product_analysis` (`table_id`, `product_id`, `visited_date`) VALUES
(1, 19, '2019-12-22 14:45:21'),
(2, 16, '2019-12-22 14:45:55'),
(3, 1, '2019-12-22 14:45:57'),
(4, 9, '2019-12-22 14:46:02'),
(5, 9, '2019-12-22 14:46:40'),
(6, 18, '2019-12-22 14:59:59'),
(7, 7, '2019-12-22 15:09:05'),
(8, 19, '2019-12-23 18:22:29'),
(9, 4, '2019-12-23 18:22:41'),
(10, 8, '2019-12-24 19:03:41'),
(11, 1, '2019-12-25 05:08:48'),
(12, 1, '2019-12-25 05:08:50'),
(13, 1, '2019-12-25 05:08:52'),
(14, 1, '2019-12-25 05:08:53'),
(15, 1, '2019-12-25 05:08:55'),
(16, 2, '2019-12-25 05:18:25'),
(17, 9, '2019-12-25 05:18:33'),
(18, 8, '2019-12-25 05:19:56'),
(19, 9, '2019-12-25 05:19:59'),
(20, 9, '2019-12-25 05:21:32'),
(21, 9, '2019-12-25 05:21:58'),
(22, 9, '2019-12-25 05:25:39'),
(23, 8, '2019-12-25 05:31:26'),
(24, 8, '2019-12-25 05:31:30'),
(25, 8, '2019-12-25 05:31:32'),
(26, 8, '2019-12-25 05:31:34'),
(27, 3, '2019-12-26 04:12:58'),
(28, 5, '2019-12-26 04:27:01'),
(29, 5, '2019-12-26 04:27:04'),
(30, 5, '2019-12-26 04:27:06'),
(31, 5, '2019-12-26 04:27:08'),
(32, 5, '2019-12-26 04:27:09'),
(33, 5, '2019-12-26 04:27:12'),
(34, 8, '2019-12-26 04:42:11'),
(35, 1, '2019-12-26 04:45:32');

-- --------------------------------------------------------

--
-- Table structure for table `rules`
--

CREATE TABLE `rules` (
  `rule_id` int(11) NOT NULL,
  `class_or_ID` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `matching_ratio` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `rules`
--

INSERT INTO `rules` (`rule_id`, `class_or_ID`, `name`, `matching_ratio`) VALUES
(1, 'class', 'area_price', 0),
(2, 'class', 'fs-dtprice', 0),
(3, 'class or ID', 'price', 0),
(4, 'class', 'mc-lpri1', 0);

-- --------------------------------------------------------

--
-- Table structure for table `rule_and_dataset`
--

CREATE TABLE `rule_and_dataset` (
  `table_id` int(11) NOT NULL,
  `rule_id` int(11) NOT NULL,
  `link_id` int(11) NOT NULL,
  `is_visited` int(11) NOT NULL,
  `is_identified_price` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`cat_id`);

--
-- Indexes for table `dataset`
--
ALTER TABLE `dataset`
  ADD PRIMARY KEY (`link_id`);

--
-- Indexes for table `inventory_in`
--
ALTER TABLE `inventory_in`
  ADD PRIMARY KEY (`inventory_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `inventory_out`
--
ALTER TABLE `inventory_out`
  ADD PRIMARY KEY (`io_id`),
  ADD KEY `inventory_id` (`inventory_id`);

--
-- Indexes for table `inventory_performance`
--
ALTER TABLE `inventory_performance`
  ADD PRIMARY KEY (`ip_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`product_id`),
  ADD KEY `cat_id` (`cat_id`);

--
-- Indexes for table `product_analysis`
--
ALTER TABLE `product_analysis`
  ADD PRIMARY KEY (`table_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `rules`
--
ALTER TABLE `rules`
  ADD PRIMARY KEY (`rule_id`);

--
-- Indexes for table `rule_and_dataset`
--
ALTER TABLE `rule_and_dataset`
  ADD PRIMARY KEY (`table_id`),
  ADD KEY `rule_id` (`rule_id`),
  ADD KEY `link_id` (`link_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `cat_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `dataset`
--
ALTER TABLE `dataset`
  MODIFY `link_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `inventory_in`
--
ALTER TABLE `inventory_in`
  MODIFY `inventory_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `inventory_out`
--
ALTER TABLE `inventory_out`
  MODIFY `io_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `inventory_performance`
--
ALTER TABLE `inventory_performance`
  MODIFY `ip_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `product_analysis`
--
ALTER TABLE `product_analysis`
  MODIFY `table_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `rules`
--
ALTER TABLE `rules`
  MODIFY `rule_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `rule_and_dataset`
--
ALTER TABLE `rule_and_dataset`
  MODIFY `table_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `inventory_in`
--
ALTER TABLE `inventory_in`
  ADD CONSTRAINT `inventory_in_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `product` (`product_id`);

--
-- Constraints for table `inventory_out`
--
ALTER TABLE `inventory_out`
  ADD CONSTRAINT `inventory_out_ibfk_1` FOREIGN KEY (`inventory_id`) REFERENCES `inventory_in` (`inventory_id`);

--
-- Constraints for table `inventory_performance`
--
ALTER TABLE `inventory_performance`
  ADD CONSTRAINT `inventory_performance_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `product` (`product_id`);

--
-- Constraints for table `product`
--
ALTER TABLE `product`
  ADD CONSTRAINT `product_ibfk_1` FOREIGN KEY (`cat_id`) REFERENCES `category` (`cat_id`);

--
-- Constraints for table `product_analysis`
--
ALTER TABLE `product_analysis`
  ADD CONSTRAINT `product_analysis_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `product` (`product_id`);

--
-- Constraints for table `rule_and_dataset`
--
ALTER TABLE `rule_and_dataset`
  ADD CONSTRAINT `rule_and_dataset_ibfk_1` FOREIGN KEY (`rule_id`) REFERENCES `rules` (`rule_id`),
  ADD CONSTRAINT `rule_and_dataset_ibfk_2` FOREIGN KEY (`link_id`) REFERENCES `dataset` (`link_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
