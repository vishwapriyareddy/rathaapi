-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 04, 2022 at 09:24 AM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 7.4.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `rathanadb`
--

-- --------------------------------------------------------

--
-- Table structure for table `add_edit_cases`
--

CREATE TABLE `add_edit_cases` (
  `no_of_data` int(11) NOT NULL,
  `company_name` varchar(50) NOT NULL,
  `stokist_name` varchar(90) NOT NULL,
  `invoice_no` int(30) NOT NULL,
  `no_of_cases` int(10) NOT NULL,
  `delivery_person` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `admin_table`
--

CREATE TABLE `admin_table` (
  `no_of_data` int(30) NOT NULL,
  `admin_id` varchar(30) NOT NULL,
  `admin_name` varchar(30) NOT NULL,
  `admin_password` varchar(50) NOT NULL,
  `admin_status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `box_update`
--

CREATE TABLE `box_update` (
  `no_of_data` int(10) NOT NULL,
  `box_id` int(11) NOT NULL,
  `batch` varchar(30) NOT NULL,
  `material` varchar(50) NOT NULL,
  `material_description` varchar(50) NOT NULL,
  `expiry_date` date NOT NULL,
  `quantity` varchar(50) NOT NULL,
  `condition_type` varchar(30) NOT NULL,
  `ebs_file` longblob NOT NULL,
  `boxes_checked` tinyint(1) NOT NULL,
  `checked_verified_by` varchar(30) NOT NULL,
  `credit_no` varchar(50) NOT NULL,
  `credit_date` date NOT NULL,
  `returns_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `company_table`
--

CREATE TABLE `company_table` (
  `no_of_data` int(10) NOT NULL,
  `company_id` int(11) NOT NULL,
  `company_name` varchar(100) NOT NULL,
  `company_status` tinyint(1) NOT NULL,
  `company_email` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `cover`
--

CREATE TABLE `cover` (
  `no_of_data` int(10) NOT NULL,
  `id` int(11) NOT NULL,
  `type` varchar(10) NOT NULL,
  `courier_no` varchar(30) NOT NULL,
  `company_name` varchar(50) NOT NULL,
  `customer_name` varchar(100) NOT NULL,
  `customer_city` varchar(40) NOT NULL,
  `comments` varchar(100) NOT NULL,
  `transport_name` varchar(100) NOT NULL,
  `created_date` date NOT NULL,
  `updated_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `customer_table`
--

CREATE TABLE `customer_table` (
  `no_of_data` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `customer_name` varchar(100) NOT NULL,
  `customer_email` varchar(30) NOT NULL,
  `customer_pass` varchar(50) NOT NULL,
  `customer_city` varchar(30) NOT NULL,
  `customer_status` tinyint(1) NOT NULL,
  `GST_NO` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `lr_updation`
--

CREATE TABLE `lr_updation` (
  `no_of_data` int(11) NOT NULL,
  `lr_id` int(11) NOT NULL,
  `company_name` varchar(50) NOT NULL,
  `no_of_boxes` varchar(30) NOT NULL,
  `trasnport_name` varchar(50) NOT NULL,
  `courier_no` varchar(50) NOT NULL,
  `customer_name` varchar(100) NOT NULL,
  `customer_city` varchar(50) NOT NULL,
  `invoice_number` varchar(50) NOT NULL,
  `invoice_date` date NOT NULL,
  `invoice_value` varchar(50) NOT NULL,
  `booking_person` varchar(30) NOT NULL,
  `lr_no` varchar(30) NOT NULL,
  `lr_date` date NOT NULL,
  `cheque_no` varchar(30) NOT NULL,
  `cheque_date` date NOT NULL,
  `eway_bill_no` varchar(30) NOT NULL,
  `weight` float NOT NULL,
  `comments` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `returns`
--

CREATE TABLE `returns` (
  `no_of_data` int(11) NOT NULL,
  `return_id` int(10) NOT NULL,
  `type` tinyint(1) NOT NULL,
  `courier_no` varchar(30) NOT NULL,
  `customer_name` varchar(50) NOT NULL,
  `no_of_boxes` varchar(30) NOT NULL,
  `LR_date` date NOT NULL,
  `company_name` varchar(50) NOT NULL,
  `transport_name` varchar(50) NOT NULL,
  `customer_city` varchar(30) NOT NULL,
  `box_no` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `transport_table`
--

CREATE TABLE `transport_table` (
  `no_of_data` int(11) NOT NULL,
  `transport_id` int(11) NOT NULL,
  `transport_name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `user_table`
--

CREATE TABLE `user_table` (
  `no_of_data` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `user_name` varchar(30) NOT NULL,
  `password` varchar(50) NOT NULL,
  `user_status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `vehicle_movement`
--

CREATE TABLE `vehicle_movement` (
  `no_of_data` int(11) NOT NULL,
  `vehicle_id` int(11) NOT NULL,
  `date` date NOT NULL,
  `vehicle_no` varchar(30) NOT NULL,
  `vehicle_location` varchar(30) NOT NULL,
  `drive_name` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `add_edit_cases`
--
ALTER TABLE `add_edit_cases`
  ADD PRIMARY KEY (`no_of_data`);

--
-- Indexes for table `admin_table`
--
ALTER TABLE `admin_table`
  ADD PRIMARY KEY (`no_of_data`);

--
-- Indexes for table `box_update`
--
ALTER TABLE `box_update`
  ADD PRIMARY KEY (`no_of_data`);

--
-- Indexes for table `company_table`
--
ALTER TABLE `company_table`
  ADD PRIMARY KEY (`no_of_data`);

--
-- Indexes for table `cover`
--
ALTER TABLE `cover`
  ADD PRIMARY KEY (`no_of_data`);

--
-- Indexes for table `customer_table`
--
ALTER TABLE `customer_table`
  ADD PRIMARY KEY (`no_of_data`);

--
-- Indexes for table `lr_updation`
--
ALTER TABLE `lr_updation`
  ADD PRIMARY KEY (`no_of_data`);

--
-- Indexes for table `returns`
--
ALTER TABLE `returns`
  ADD PRIMARY KEY (`no_of_data`);

--
-- Indexes for table `transport_table`
--
ALTER TABLE `transport_table`
  ADD PRIMARY KEY (`no_of_data`);

--
-- Indexes for table `user_table`
--
ALTER TABLE `user_table`
  ADD PRIMARY KEY (`no_of_data`);

--
-- Indexes for table `vehicle_movement`
--
ALTER TABLE `vehicle_movement`
  ADD PRIMARY KEY (`no_of_data`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `add_edit_cases`
--
ALTER TABLE `add_edit_cases`
  MODIFY `no_of_data` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `admin_table`
--
ALTER TABLE `admin_table`
  MODIFY `no_of_data` int(30) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `box_update`
--
ALTER TABLE `box_update`
  MODIFY `no_of_data` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `company_table`
--
ALTER TABLE `company_table`
  MODIFY `no_of_data` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `cover`
--
ALTER TABLE `cover`
  MODIFY `no_of_data` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `customer_table`
--
ALTER TABLE `customer_table`
  MODIFY `no_of_data` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `lr_updation`
--
ALTER TABLE `lr_updation`
  MODIFY `no_of_data` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `returns`
--
ALTER TABLE `returns`
  MODIFY `no_of_data` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `transport_table`
--
ALTER TABLE `transport_table`
  MODIFY `no_of_data` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user_table`
--
ALTER TABLE `user_table`
  MODIFY `no_of_data` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `vehicle_movement`
--
ALTER TABLE `vehicle_movement`
  MODIFY `no_of_data` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
