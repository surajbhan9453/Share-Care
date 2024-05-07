-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 17, 2024 at 03:50 AM
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
-- Database: `donationdb`
--

-- --------------------------------------------------------

--
-- Table structure for table `donations`
--

CREATE TABLE `donations` (
  `id` int(11) NOT NULL,
  `item_type` varchar(20) NOT NULL,
  `item_name` varchar(15) NOT NULL,
  `quantity` int(11) NOT NULL,
  `address` varchar(30) NOT NULL,
  `phone` bigint(20) NOT NULL,
  `comments` varchar(30) NOT NULL,
  `donor` varchar(30) NOT NULL,
  `status` varchar(15) DEFAULT 'pending',
  `collected_by` varchar(20) DEFAULT 'N/A'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `donations`
--

INSERT INTO `donations` (`id`, `item_type`, `item_name`, `quantity`, `address`, `phone`, `comments`, `donor`, `status`, `collected_by`) VALUES
(1, 'clothes', 'Shrts', 10, 'Kharar, PUNJAB', 8726454894, '', 'abhishek@gmail.com', 'collected', 'akshay@gmail.com'),
(2, 'clothes', 'T-shirt, Pant', 2, 'Kharar punjab', 7894561234, 'qwertyuiop', 'demo@123', 'collected', 'raju@jj');

-- --------------------------------------------------------

--
-- Table structure for table `requests`
--

CREATE TABLE `requests` (
  `id` int(11) NOT NULL,
  `recipient_name` varchar(100) DEFAULT NULL,
  `recipient_email` varchar(100) DEFAULT NULL,
  `donation_id` int(10) NOT NULL,
  `donor_email` text DEFAULT NULL,
  `request_status` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `requests`
--

INSERT INTO `requests` (`id`, `recipient_name`, `recipient_email`, `donation_id`, `donor_email`, `request_status`) VALUES
(1, 'Akshay Thakur', 'akshay@gmail.com', 1, 'abhishek@gmail.com', 'collected'),
(2, 'raju singh', 'raju@jj', 2, 'demo@123', 'collected');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `user_type` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `first_name`, `last_name`, `email`, `password`, `user_type`) VALUES
(5, 'Sourabh', 'Singh', 'rajpoot@gmail.com', '$2y$10$vjDF7ITSl9Zyqc1OV4Pn2e4tJIfcu.d4TtQtgoeiNOwrD.KH3MMJ2', 'donor'),
(6, 'Akshay', 'Thakur', 'akshay@gmail.com', '$2y$10$pq1hSPjB.soyY79fuWSOduPMNp5ARt6edYOhyTpXcNkCFGSjjN.xi', 'recipient'),
(8, 'Abhishek', 'Singh', 'abhishek@gmail.com', '$2y$10$f.ubIujkmTvVvjD/2PdIaecN2es9RnDMniw/rirqohL4WuctNdEVy', 'donor'),
(10, 'demo', 'singh', 'demo@123', '$2y$10$zFF2kYzwOERNfNI6xao0f.4S4uUUkh2/m0BfQP3NgDu/7M4iv7Q2S', 'donor'),
(12, 'Suraj Bhan', 'Kushwaha', 'suraj@gmail.com', '$2y$10$aNujFOoR1LuIMNteAp7nFODKkBo9qhKvm2pTCcfbkIwauw2LTFao.', 'admin'),
(16, 'raju', 'singh', 'raju@jj', '$2y$10$GHQ4LsSgN/NkJWGxEWTL0eDheEszMmdGA5Bej7q6aXRoRYNDiTp1m', 'recipient');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `donations`
--
ALTER TABLE `donations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `requests`
--
ALTER TABLE `requests`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `donations`
--
ALTER TABLE `donations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `requests`
--
ALTER TABLE `requests`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
