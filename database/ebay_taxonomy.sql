-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 25, 2022 at 11:45 AM
-- Server version: 10.4.18-MariaDB
-- PHP Version: 7.3.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ebay_taxonomy`
--

-- --------------------------------------------------------

--
-- Table structure for table `ebay_taxonomy_category_fields`
--

CREATE TABLE `ebay_taxonomy_category_fields` (
  `id` int(11) NOT NULL,
  `cat_id` int(11) DEFAULT NULL,
  `localizedAspectName` varchar(255) DEFAULT NULL,
  `aspectDataType` varchar(255) DEFAULT NULL,
  `itemToAspectCardinality` varchar(255) DEFAULT NULL,
  `aspectMode` varchar(255) DEFAULT NULL,
  `aspectRequired` varchar(255) DEFAULT NULL,
  `aspectUsage` varchar(255) DEFAULT NULL,
  `aspectEnabledForVariations` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `ebay_taxonomy_category_field_values`
--

CREATE TABLE `ebay_taxonomy_category_field_values` (
  `id` int(11) NOT NULL,
  `cat_id` int(11) DEFAULT NULL,
  `ebay_taxonomy_category_fields_id` int(11) NOT NULL,
  `localizedValue` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `ebay_taxonomy_oauth`
--

CREATE TABLE `ebay_taxonomy_oauth` (
  `id` int(11) NOT NULL,
  `client_id` varchar(255) DEFAULT NULL,
  `secret_key` varchar(255) DEFAULT NULL,
  `access_token` text NOT NULL,
  `expiration` datetime NOT NULL,
  `mode` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `ebay_taxonomy_category_fields`
--
ALTER TABLE `ebay_taxonomy_category_fields`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ebay_taxonomy_category_field_values`
--
ALTER TABLE `ebay_taxonomy_category_field_values`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ebay_taxonomy_oauth`
--
ALTER TABLE `ebay_taxonomy_oauth`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `ebay_taxonomy_category_fields`
--
ALTER TABLE `ebay_taxonomy_category_fields`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=237;

--
-- AUTO_INCREMENT for table `ebay_taxonomy_category_field_values`
--
ALTER TABLE `ebay_taxonomy_category_field_values`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15891;

--
-- AUTO_INCREMENT for table `ebay_taxonomy_oauth`
--
ALTER TABLE `ebay_taxonomy_oauth`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
