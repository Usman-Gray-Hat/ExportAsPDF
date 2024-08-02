-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 02, 2024 at 02:04 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `demo`
--

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `age` int(11) DEFAULT NULL,
  `created_at` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `age`, `created_at`) VALUES
(1, 'Usman Hameed', 25, '2024-07-30'),
(2, 'Ali Malik', 30, '2024-07-30'),
(3, 'Raheel Azam', 28, '2024-07-30'),
(4, 'Fahad Ahmed', 25, '2024-07-31'),
(6, 'Danish Arshad', 24, '2024-07-31'),
(7, 'Aashir Ali Khan ', 26, '2024-07-31'),
(11, 'Syed Bilal Jawed', 24, '2024-07-31'),
(12, 'Mr. MUHAMMAD SALMAN SHAIKH ', 27, '2024-07-31'),
(13, 'Mr. MUHAMMAD RAMEEZ ALI BAIG', 28, '2024-07-31'),
(14, 'Umer', 24, '2024-07-31'),
(15, 'Faizan Durrani', 23, '2024-07-31'),
(16, 'Rabia Waheed', 22, '2024-07-31'),
(17, 'Shahid Anwar', 32, '2024-07-31'),
(18, 'Qadeer Khan', 58, '2024-07-31'),
(19, 'Haider Ali', 28, '2024-08-01'),
(20, 'Imad Waseem', 35, '2024-08-01'),
(21, 'Naseem Shah', 24, '2024-08-01'),
(24, 'Ubaid Shah', 20, '2024-08-01');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
