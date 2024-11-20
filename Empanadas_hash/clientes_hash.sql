-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 19, 2024 at 07:49 PM
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
-- Database: `empanadas`
--

-- --------------------------------------------------------

--
-- Table structure for table `clientes_hash`
--

CREATE TABLE `clientes_hash` (
  `id` int(13) NOT NULL,
  `nombre` varchar(35) NOT NULL,
  `correo` varchar(35) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `clientes_hash`
--

INSERT INTO `clientes_hash` (`id`, `nombre`, `correo`, `password`) VALUES
(1, 'Pepe', 'pepe@gmail.com', '$2y$10$oN1f866Gjihy7mlVxEWl2.BPMXg4YX4kQfc4/aNZ6ScvKKo8PHvOK'),
(2, 'Emilio', 'emi@gmail.com', '$2y$10$/47PqqRU65MulA2JIoZnIOcUoRwIvjMJsERR1iDZiYF6MDp5JUqcW');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `clientes_hash`
--
ALTER TABLE `clientes_hash`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `clientes_hash`
--
ALTER TABLE `clientes_hash`
  MODIFY `id` int(13) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
