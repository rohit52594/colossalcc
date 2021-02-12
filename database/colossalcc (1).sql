-- phpMyAdmin SQL Dump
-- version 4.9.5deb2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Feb 12, 2021 at 11:09 PM
-- Server version: 8.0.21-0ubuntu0.20.04.4
-- PHP Version: 7.4.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `colossalcc`
--

-- --------------------------------------------------------

--
-- Table structure for table `administrator`
--

CREATE TABLE `administrator` (
  `id` int NOT NULL,
  `name` varchar(200) NOT NULL,
  `email` varchar(200) NOT NULL,
  `password` varchar(200) NOT NULL,
  `verification_key` varchar(200) NOT NULL,
  `is_verified` int NOT NULL DEFAULT '0' COMMENT '1 for verified',
  `joined_date` date DEFAULT NULL,
  `joined_time` time DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `administrator`
--

INSERT INTO `administrator` (`id`, `name`, `email`, `password`, `verification_key`, `is_verified`, `joined_date`, `joined_time`) VALUES
(69, 'ADMIN', 'login@colossalcc.com', 'd9676e0cb704af8527b0976d9c1ae14a649e7969760dd2df1f67b221053d153fd48598f72b4c002897e4c66b24bd7837845842ab76029f6a426f67f804109d6bAAs/OaCpXtMfz2JbGAB/iB+nHlTWzcW/3UiUkDtNLCM=', 'ae3148314a8cde674623343f4b3dbeae', 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `assets_deliverer`
--

CREATE TABLE `assets_deliverer` (
  `id` int NOT NULL,
  `deliverer_id` int DEFAULT NULL,
  `asset_type` varchar(200) DEFAULT NULL,
  `file_name` varchar(200) DEFAULT NULL,
  `file_type` varchar(200) DEFAULT NULL,
  `file_path` varchar(200) DEFAULT NULL,
  `full_path` varchar(200) DEFAULT NULL,
  `raw_name` varchar(200) DEFAULT NULL,
  `orig_name` varchar(200) DEFAULT NULL,
  `client_name` varchar(200) DEFAULT NULL,
  `file_ext` varchar(200) DEFAULT NULL,
  `file_size` decimal(55,2) DEFAULT NULL,
  `is_image` int DEFAULT NULL,
  `image_width` int DEFAULT NULL,
  `image_height` int DEFAULT NULL,
  `image_type` varchar(200) DEFAULT NULL,
  `added_date` date DEFAULT NULL,
  `added_time` time DEFAULT NULL,
  `status` int NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `assets_deliverer`
--

INSERT INTO `assets_deliverer` (`id`, `deliverer_id`, `asset_type`, `file_name`, `file_type`, `file_path`, `full_path`, `raw_name`, `orig_name`, `client_name`, `file_ext`, `file_size`, `is_image`, `image_width`, `image_height`, `image_type`, `added_date`, `added_time`, `status`) VALUES
(1, 1, 'PASSPORT IMAGE', '8517e250462d05f988cfdf0a49a0bb55.png', 'image/png', '/var/www/html/colossalcc/uploads/deliverer/', '/var/www/html/colossalcc/uploads/deliverer/8517e250462d05f988cfdf0a49a0bb55.png', '8517e250462d05f988cfdf0a49a0bb55', 'cbe336ee616344bbf1873e5b0fc6fe59.png', 'cbe336ee616344bbf1873e5b0fc6fe59.png', '.png', '47.18', 1, 1250, 300, 'png', '2021-02-09', '22:35:26', 1),
(2, 1, 'LICENSE PROOF', '000faf88294329b13d3442aaa5db79ab.png', 'image/png', '/var/www/html/colossalcc/uploads/deliverer/', '/var/www/html/colossalcc/uploads/deliverer/000faf88294329b13d3442aaa5db79ab.png', '000faf88294329b13d3442aaa5db79ab', 'cbe336ee616344bbf1873e5b0fc6fe59.png', 'cbe336ee616344bbf1873e5b0fc6fe59.png', '.png', '47.18', 1, 1250, 300, 'png', '2021-02-09', '22:35:26', 1),
(3, 2, 'PASSPORT IMAGE', '84069e095797e2bd83486ce62660392d.jpg', 'image/jpeg', '/var/www/html/colossalcc/uploads/deliverer/', '/var/www/html/colossalcc/uploads/deliverer/84069e095797e2bd83486ce62660392d.jpg', '84069e095797e2bd83486ce62660392d', 'garden-scene11.jpg', 'garden-scene11.jpg', '.jpg', '233.24', 1, 1200, 803, 'jpeg', '2021-02-09', '22:53:13', 1),
(4, 2, 'LICENSE PROOF', '0f6e04cf7aafffaa3a6b94d519ea9f87.jpg', 'image/jpeg', '/var/www/html/colossalcc/uploads/deliverer/', '/var/www/html/colossalcc/uploads/deliverer/0f6e04cf7aafffaa3a6b94d519ea9f87.jpg', '0f6e04cf7aafffaa3a6b94d519ea9f87', 'garden-scene11.jpg', 'garden-scene11.jpg', '.jpg', '233.24', 1, 1200, 803, 'jpeg', '2021-02-09', '22:53:13', 1),
(5, 3, 'PASSPORT IMAGE', '2af19ff4db50cf9a514f7e1b0592f751.jpg', 'image/jpeg', '/var/www/html/colossalcc/uploads/deliverer/', '/var/www/html/colossalcc/uploads/deliverer/2af19ff4db50cf9a514f7e1b0592f751.jpg', '2af19ff4db50cf9a514f7e1b0592f751', 'garden-scene11.jpg', 'garden-scene11.jpg', '.jpg', '233.24', 1, 1200, 803, 'jpeg', '2021-02-12', '22:22:48', 1),
(6, 3, 'LICENSE PROOF', '38833559f64f2d91e600910c894271f2.jpg', 'image/jpeg', '/var/www/html/colossalcc/uploads/deliverer/', '/var/www/html/colossalcc/uploads/deliverer/38833559f64f2d91e600910c894271f2.jpg', '38833559f64f2d91e600910c894271f2', 'garden-scene11.jpg', 'garden-scene11.jpg', '.jpg', '233.24', 1, 1200, 803, 'jpeg', '2021-02-12', '22:22:48', 1);

-- --------------------------------------------------------

--
-- Table structure for table `deliverers`
--

CREATE TABLE `deliverers` (
  `id` int NOT NULL,
  `name` varchar(200) NOT NULL,
  `email` varchar(200) DEFAULT NULL,
  `phone` varchar(200) NOT NULL,
  `password` varchar(200) NOT NULL,
  `address` text,
  `bank_name` varchar(200) DEFAULT NULL,
  `account_number` varchar(200) DEFAULT NULL,
  `ifsc` varchar(200) DEFAULT NULL,
  `branch` varchar(200) DEFAULT NULL,
  `added_date` date DEFAULT NULL,
  `added_time` time DEFAULT NULL,
  `last_updated_date` date DEFAULT NULL,
  `last_updated_time` time DEFAULT NULL,
  `last_updated_remote` varchar(200) DEFAULT NULL,
  `is_active` int NOT NULL DEFAULT '1',
  `branch_code` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `deliverers`
--

INSERT INTO `deliverers` (`id`, `name`, `email`, `phone`, `password`, `address`, `bank_name`, `account_number`, `ifsc`, `branch`, `added_date`, `added_time`, `last_updated_date`, `last_updated_time`, `last_updated_remote`, `is_active`, `branch_code`) VALUES
(1, 'Rohit Sahusdfsdfsdf', 'login@colossalcc.com', '8402081401', '56f1f94d1c1413e638fc0c8243695c92409a911075a02de301f53cfea4f9417069602a6bba5fbf4094b56ceb0e3a831eeed12212f0045a889eaa4e5f2c2763f3J/XqBBFCUKdbh7KPKpavSzeqlOwrOrIgVGnA+/AFX60=', 'Nazira Town, Ward no: 8, PO-PS: Nazira', 'sdjfh', 'skjdfh', 'kjwafh', 'ksdjf', '2021-02-09', '22:35:26', '2021-02-09', '22:53:29', '::1', 1, 1),
(2, 'lsdhf', 'admin@msme.com', '9879879870', '42daa6b62003f093077bb4d3a173384632360cda70eded906badfde9cda2213509a4066f9ea03ac2b4013818a16486702d833c4587ac07e1067b5c3618566807t/7iaFhuFdSU+UYi0GxMk5JgqZTShmJIXIpBgS+qmbg=', 'sdf', 'sdhg', 'jsfg', 'jfg', 'sdjf', '2021-02-09', '22:53:12', NULL, NULL, NULL, 1, 1),
(3, 'jsdfjk', 'ksdfh@kjhdf.com', '6549876548', 'f93047de7583663be11083f4afa08b9e599973cdf069673f9ee7d8856f0baa5ff16fafba282e6b20aed95795418ea692ad4f17d5fad3dd20e5db10bb1801aa1anB2MZSw7gaXop5ZCO77c0OTqBtB/oS9hXftjliUm2cE=', 'sdfh', 'lsdfj', 'lskjdf', 'lkjsdf', 'lksdjf', '2021-02-12', '22:22:48', NULL, NULL, NULL, 1, 2);

-- --------------------------------------------------------

--
-- Table structure for table `login_history`
--

CREATE TABLE `login_history` (
  `id` int NOT NULL,
  `user_id` int DEFAULT NULL,
  `user_role` varchar(200) DEFAULT NULL,
  `os` varchar(200) DEFAULT NULL,
  `browser` varchar(200) DEFAULT NULL,
  `ip` varchar(200) DEFAULT NULL,
  `login_date` date DEFAULT NULL,
  `login_time` time DEFAULT NULL,
  `status` int DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `login_history`
--

INSERT INTO `login_history` (`id`, `user_id`, `user_role`, `os`, `browser`, `ip`, `login_date`, `login_time`, `status`) VALUES
(3969, 69, 'ADMIN', 'Linux', 'Chrome', '::1', '2021-02-08', '23:11:47', 1),
(3970, 1, 'DELIVERER', 'Linux', 'Chrome', '::1', '2021-02-08', '23:12:25', 1),
(3971, 1, 'SELLER', 'Linux', 'Chrome', '::1', '2021-02-08', '23:19:02', 1),
(3972, 69, 'ADMIN', 'Linux', 'Chrome', '::1', '2021-02-09', '22:03:06', 1),
(3973, 1, 'SELLER', 'Linux', 'Chrome', '::1', '2021-02-09', '22:43:47', 1),
(3974, 69, 'ADMIN', 'Linux', 'Chrome', '::1', '2021-02-10', '19:55:38', 1),
(3975, 1, 'SELLER', 'Linux', 'Chrome', '::1', '2021-02-10', '20:30:20', 1),
(3976, 69, 'ADMIN', 'Linux', 'Chrome', '::1', '2021-02-10', '22:06:59', 1),
(3977, 1, 'SELLER', 'Linux', 'Chrome', '::1', '2021-02-10', '22:07:32', 1),
(3978, 1, 'SELLER', 'Linux', 'Chrome', '::1', '2021-02-12', '20:10:04', 1),
(3979, 2, 'SELLER', 'Linux', 'Chrome', '::1', '2021-02-12', '22:22:00', 1),
(3980, 1, 'SELLER', 'Linux', 'Chrome', '::1', '2021-02-12', '22:53:35', 1),
(3981, 69, 'ADMIN', 'Linux', 'Chrome', '::1', '2021-02-12', '22:56:22', 1),
(3982, 1, 'DELIVERER', 'Linux', 'Chrome', '::1', '2021-02-12', '22:58:07', 1);

-- --------------------------------------------------------

--
-- Table structure for table `parcels`
--

CREATE TABLE `parcels` (
  `id` int NOT NULL,
  `tracking_id` varchar(200) NOT NULL,
  `branch_id` int NOT NULL,
  `current_branch` int NOT NULL COMMENT 'id of the current branch',
  `sender_address` varchar(200) NOT NULL,
  `sender_state` varchar(200) NOT NULL,
  `sender_city` varchar(200) NOT NULL,
  `sender_pincode` varchar(200) NOT NULL,
  `sender_phone` varchar(200) NOT NULL,
  `sender_alt_phone` varchar(200) DEFAULT NULL,
  `sender_name` varchar(200) NOT NULL,
  `receiver_address` varchar(200) NOT NULL,
  `receiver_state` varchar(200) NOT NULL,
  `receiver_city` varchar(200) NOT NULL,
  `receiver_pincode` varchar(200) NOT NULL,
  `receiver_phone` varchar(200) NOT NULL,
  `receiver_alt_phone` varchar(200) DEFAULT NULL,
  `receiver_name` varchar(200) NOT NULL,
  `parcel_weight` double(55,2) NOT NULL DEFAULT '0.00',
  `parcel_height` decimal(55,2) NOT NULL DEFAULT '0.00',
  `parcel_width` decimal(55,2) NOT NULL DEFAULT '0.00',
  `parcel_length` decimal(55,2) NOT NULL DEFAULT '0.00',
  `parcel_price` decimal(55,2) NOT NULL DEFAULT '0.00',
  `parcel_is_paid` int NOT NULL DEFAULT '0',
  `parcel_status` int NOT NULL DEFAULT '0' COMMENT '0 for accepted by branch, 1 item_shipped, 2 in transit, 3 out for delivery, 4 delivered, 5 undelivered',
  `parcel_delivery_attempt` int NOT NULL DEFAULT '0',
  `destination_branch` int NOT NULL,
  `parcel_receive_time` bigint NOT NULL,
  `deliverer_assigned` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `parcels`
--

INSERT INTO `parcels` (`id`, `tracking_id`, `branch_id`, `current_branch`, `sender_address`, `sender_state`, `sender_city`, `sender_pincode`, `sender_phone`, `sender_alt_phone`, `sender_name`, `receiver_address`, `receiver_state`, `receiver_city`, `receiver_pincode`, `receiver_phone`, `receiver_alt_phone`, `receiver_name`, `parcel_weight`, `parcel_height`, `parcel_width`, `parcel_length`, `parcel_price`, `parcel_is_paid`, `parcel_status`, `parcel_delivery_attempt`, `destination_branch`, `parcel_receive_time`, `deliverer_assigned`) VALUES
(1, '16444087', 1, 1, 'kjsdfh', 'kjsdhf', 'kjhsdf', '879879', '9879879870', '9879879870', 'dh', 'ksjdfh', 'kjhsdf', 'kjhsdf', '867465', '9879879870', '', 'sdfjh', 2.00, '5.00', '2.00', '1.00', '5.00', 0, 3, 3, 2, 1612973406, NULL),
(2, '85015023', 1, 2, 'kjsdhf', 'jsfh', 'skjdfh', '654987', '9879879870', '', 'sjf', 'kjhsdf', 'kjhsdf', 'kjhsdf', '987654', '9879879875', '', 'sdf', 1.00, '2.00', '1.00', '1.00', '2.00', 1, 4, 0, 2, 1612975145, 1);

-- --------------------------------------------------------

--
-- Table structure for table `seller`
--

CREATE TABLE `seller` (
  `id` int NOT NULL,
  `name` varchar(200) NOT NULL,
  `email` varchar(200) DEFAULT NULL,
  `phone` varchar(200) NOT NULL,
  `password` varchar(200) NOT NULL,
  `address` text,
  `added_date` date DEFAULT NULL,
  `added_time` time DEFAULT NULL,
  `last_updated_date` date DEFAULT NULL,
  `last_updated_time` time DEFAULT NULL,
  `last_updated_remote` varchar(200) DEFAULT NULL,
  `is_active` int NOT NULL DEFAULT '1',
  `state` varchar(200) NOT NULL,
  `city` varchar(200) NOT NULL,
  `district` varchar(200) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `po` varchar(200) NOT NULL,
  `pin` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `seller`
--

INSERT INTO `seller` (`id`, `name`, `email`, `phone`, `password`, `address`, `added_date`, `added_time`, `last_updated_date`, `last_updated_time`, `last_updated_remote`, `is_active`, `state`, `city`, `district`, `po`, `pin`) VALUES
(1, 'Rohit Sahu', 'rohitsahu728@gmail.com', '8402081401', '9a9e4c97070111f60e81d72201551463112cf3edac6496272857e91e11b401298d9f7b7cabf6fb990926d42bfa2331c95634f1cbd321f27fc5a2c611a9714375ZJxSdNc2q4YRCZr8P3p/8QKPtQzD0l4f67jVKdJgnpY=', 'Nazira Town, Ward no: 8, PO-PS: Nazira', '2021-02-09', '22:30:00', NULL, NULL, NULL, 1, '', '', '', '', ''),
(2, 'skjdfhk', 'ksjdhf@kjhsdf.com', '9879879874', '9a9e4c97070111f60e81d72201551463112cf3edac6496272857e91e11b401298d9f7b7cabf6fb990926d42bfa2331c95634f1cbd321f27fc5a2c611a9714375ZJxSdNc2q4YRCZr8P3p/8QKPtQzD0l4f67jVKdJgnpY=', 'sdf', '2021-02-10', '20:09:33', '2021-02-10', '20:11:27', '::1', 1, 'sdf', 'sdf', 'sdf', 'sdfsdf', '848484');

-- --------------------------------------------------------

--
-- Table structure for table `transaction_history`
--

CREATE TABLE `transaction_history` (
  `id` int NOT NULL,
  `tracking_id` varchar(200) NOT NULL,
  `from_branch` int NOT NULL,
  `to_branch` int NOT NULL,
  `narration` varchar(200) NOT NULL,
  `is_returning` int NOT NULL DEFAULT '0' COMMENT '1 if item is going to be returned to the origin branch',
  `dispatched_time` bigint NOT NULL,
  `accepted_time` bigint DEFAULT NULL,
  `is_delivered` int NOT NULL DEFAULT '0' COMMENT '1 if delivered',
  `failed_attempts` int NOT NULL DEFAULT '0',
  `status` int NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `transaction_history`
--

INSERT INTO `transaction_history` (`id`, `tracking_id`, `from_branch`, `to_branch`, `narration`, `is_returning`, `dispatched_time`, `accepted_time`, `is_delivered`, `failed_attempts`, `status`) VALUES
(10, '16444087', 1, 2, 'Item reached to  branch', 0, 1613146860, NULL, 0, 0, 1),
(11, '85015023', 1, 2, 'Item reached to destination branch - ', 0, 1613146891, NULL, 0, 0, 1),
(12, '85015023', 1, 2, 'Item reached to destination branch - ', 0, 1613146916, NULL, 0, 0, 1),
(17, '16444087', 2, 2, 'Item out for delivery from destination branch - sdf. Deliverer Details: jsdfjk - 6549876548', 0, 1613149069, NULL, 0, 0, 1),
(18, '16444087', 2, 2, 'Item out for delivery from destination branch - sdf. Deliverer Details: jsdfjk - 6549876548', 0, 1613149081, NULL, 0, 0, 1),
(19, '85015023', 2, 2, 'Item out for delivery from destination branch - sdf. Deliverer Details: jsdfjk - 6549876548', 0, 1613149094, NULL, 0, 0, 1),
(20, '16444087', 2, 2, 'Delivery attempt failed your parcel.', 0, 1613150373, NULL, 0, 0, 1),
(21, '16444087', 2, 2, 'Item out for delivery from destination branch - sdf. Deliverer Details: jsdfjk - 6549876548', 1, 1613150424, NULL, 0, 0, 1),
(22, '16444087', 2, 2, 'Delivery attempt failed your parcel.', 0, 1613150434, NULL, 0, 0, 1),
(23, '16444087', 2, 2, 'Item out for delivery from destination branch - sdf. Deliverer Details: jsdfjk - 6549876548', 1, 1613150442, NULL, 0, 0, 1),
(24, '16444087', 2, 2, 'Delivery attempt failed your parcel.', 0, 1613150446, NULL, 0, 0, 1),
(25, '16444087', 2, 2, 'Item out for delivery from destination branch - sdf. Deliverer Details: jsdfjk - 6549876548', 1, 1613150453, NULL, 0, 0, 1),
(26, '16444087', 2, 2, 'Delivery attempt failed your parcel.', 0, 1613150458, NULL, 0, 0, 1),
(28, '16444087', 2, 1, 'Item reached to sdf branch', 1, 1613150593, NULL, 0, 0, 1),
(29, '85015023', 2, 2, 'Item delivered successfully.', 0, 1613151449, NULL, 0, 0, 1),
(30, '85015023', 2, 2, 'Item delivered successfully.', 0, 1613151526, NULL, 0, 0, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `administrator`
--
ALTER TABLE `administrator`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `assets_deliverer`
--
ALTER TABLE `assets_deliverer`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `deliverers`
--
ALTER TABLE `deliverers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `branch_code` (`branch_code`);

--
-- Indexes for table `login_history`
--
ALTER TABLE `login_history`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `parcels`
--
ALTER TABLE `parcels`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `tracking_id` (`tracking_id`),
  ADD KEY `branch_id` (`branch_id`),
  ADD KEY `destination_branch` (`destination_branch`),
  ADD KEY `current_branch` (`current_branch`),
  ADD KEY `deliverer_assigned` (`deliverer_assigned`);

--
-- Indexes for table `seller`
--
ALTER TABLE `seller`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `transaction_history`
--
ALTER TABLE `transaction_history`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tracking_id` (`tracking_id`),
  ADD KEY `from_branch` (`from_branch`),
  ADD KEY `to_branch` (`to_branch`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `administrator`
--
ALTER TABLE `administrator`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=70;

--
-- AUTO_INCREMENT for table `assets_deliverer`
--
ALTER TABLE `assets_deliverer`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `deliverers`
--
ALTER TABLE `deliverers`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `login_history`
--
ALTER TABLE `login_history`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3983;

--
-- AUTO_INCREMENT for table `parcels`
--
ALTER TABLE `parcels`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `seller`
--
ALTER TABLE `seller`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `transaction_history`
--
ALTER TABLE `transaction_history`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `deliverers`
--
ALTER TABLE `deliverers`
  ADD CONSTRAINT `branch_code` FOREIGN KEY (`branch_code`) REFERENCES `seller` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Constraints for table `parcels`
--
ALTER TABLE `parcels`
  ADD CONSTRAINT `branch_id` FOREIGN KEY (`branch_id`) REFERENCES `seller` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `current_branch` FOREIGN KEY (`current_branch`) REFERENCES `seller` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `deliverer_assigned` FOREIGN KEY (`deliverer_assigned`) REFERENCES `deliverers` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `destination_branch` FOREIGN KEY (`destination_branch`) REFERENCES `seller` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Constraints for table `transaction_history`
--
ALTER TABLE `transaction_history`
  ADD CONSTRAINT `from_branch` FOREIGN KEY (`from_branch`) REFERENCES `seller` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `to_branch` FOREIGN KEY (`to_branch`) REFERENCES `seller` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `tracking_id` FOREIGN KEY (`tracking_id`) REFERENCES `parcels` (`tracking_id`) ON DELETE RESTRICT ON UPDATE RESTRICT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
