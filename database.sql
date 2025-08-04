-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 01, 2025 at 02:59 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `printact_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `delivery_challans`
--

CREATE TABLE `delivery_challans` (
  `id` int(11) NOT NULL,
  `company_name` varchar(255) DEFAULT NULL,
  `dc_number` varchar(100) DEFAULT NULL,
  `dc_date` date DEFAULT NULL,
  `po_number` varchar(100) DEFAULT NULL,
  `delivery_time` time DEFAULT NULL,
  `vehicle_number` varchar(100) DEFAULT NULL,
  `driver_name` varchar(255) DEFAULT NULL,
  `dc_file` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `expenses`
--

CREATE TABLE `expenses` (
  `id` int(11) NOT NULL,
  `po_number` varchar(100) DEFAULT NULL,
  `po_date` date DEFAULT NULL,
  `raw_material` decimal(10,2) DEFAULT NULL,
  `raw_material_transport` decimal(10,2) DEFAULT NULL,
  `cutting_cost` decimal(10,2) DEFAULT NULL,
  `cutting_transport` decimal(10,2) DEFAULT NULL,
  `designing` decimal(10,2) DEFAULT NULL,
  `plates` decimal(10,2) DEFAULT NULL,
  `printing` decimal(10,2) DEFAULT NULL,
  `lamination` decimal(10,2) DEFAULT NULL,
  `misc_transport` decimal(10,2) DEFAULT NULL,
  `naali_purchase` decimal(10,2) DEFAULT NULL,
  `naali_transport` decimal(10,2) DEFAULT NULL,
  `paper_purchase` decimal(10,2) DEFAULT NULL,
  `paper_transport` decimal(10,2) DEFAULT NULL,
  `corrugation_roll` decimal(10,2) DEFAULT NULL,
  `slicate_charges` decimal(10,2) DEFAULT NULL,
  `labor_charges` decimal(10,2) DEFAULT NULL,
  `die_charges` decimal(10,2) DEFAULT NULL,
  `die_cutting_charges` decimal(10,2) DEFAULT NULL,
  `pasting` decimal(10,2) DEFAULT NULL,
  `borai` decimal(10,2) DEFAULT NULL,
  `misc_charges` decimal(10,2) DEFAULT NULL,
  `total_expense` decimal(12,2) DEFAULT NULL,
  `total_po_rate` decimal(12,2) DEFAULT NULL,
  `profit_loss` decimal(12,2) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `invoices`
--

CREATE TABLE `invoices` (
  `id` int(11) NOT NULL,
  `company_name` varchar(255) DEFAULT NULL,
  `invoice_date` date DEFAULT NULL,
  `dc_number` varchar(100) DEFAULT NULL,
  `po_number` varchar(100) DEFAULT NULL,
  `invoice_file` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `purchase_orders`
--

CREATE TABLE `purchase_orders` (
  `id` int(11) NOT NULL,
  `company_name` varchar(255) DEFAULT NULL,
  `po_date` date DEFAULT NULL,
  `po_number` varchar(100) DEFAULT NULL,
  `po_file` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `delivery_challans`
--
ALTER TABLE `delivery_challans`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `dc_number` (`dc_number`);

--
-- Indexes for table `expenses`
--
ALTER TABLE `expenses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `invoices`
--
ALTER TABLE `invoices`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `purchase_orders`
--
ALTER TABLE `purchase_orders`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `po_number` (`po_number`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `delivery_challans`
--
ALTER TABLE `delivery_challans`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `expenses`
--
ALTER TABLE `expenses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `invoices`
--
ALTER TABLE `invoices`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `purchase_orders`
--
ALTER TABLE `purchase_orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
