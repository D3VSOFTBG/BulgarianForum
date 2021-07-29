-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1
-- Време на генериране: 29 юли 2021 в 23:45
-- Версия на сървъра: 10.4.20-MariaDB
-- Версия на PHP: 8.0.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данни: `bulgarianforum`
--

-- --------------------------------------------------------

--
-- Структура на таблица `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `registered_date` date NOT NULL,
  `token` varchar(50) DEFAULT NULL,
  `token_created_time` int(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Схема на данните от таблица `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `registered_date`, `token`, `token_created_time`) VALUES
(3, 'test2', 'test2@gmail.com', '$2y$10$nX6IM/B2xycREmZ5c7MJmeeuOHj1A2e5oF4tevj9vi6GwBc.7mZkK', '2021-06-26', '104b5151221169c35fe498b64c7aab7a', NULL),
(4, 'testing123', 'testing123@gmail.com', '$2y$10$PnoD9whra37uaElh5X0w6uupq2nrELXRXByj4sMvPYDuQ4wWgFMda', '2021-06-30', 'asd1231323', NULL),
(8, 'parapetXD123', 'parapetXD123@gmail.com', '$2y$10$qAN8j1OxvLbJJoyZOBiEN.kZrAC1YZMQ7nl7zJngUgk/kK0uKHc8O', '2021-07-27', NULL, NULL),
(9, 'leshtorba123', 'leshtorba123@gmail.com', '$2y$10$cmSd.GmeJ4LU/UO5AKZ4k.4TrWJuMGUvlcLbh8AdYkO/vProsyDQ.', '2021-07-27', NULL, NULL),
(10, 'parolata', 'parolata@gmail.com', '$2y$10$6szoppCa3EyDd0P7FOcgA.u.VvHDfsv6M6QCyRXsFqAMNMaH7S4yK', '2021-07-27', NULL, NULL),
(11, 'testvam123', 'testvam123@gmail.com', '$2y$10$weVdAg5ZGmQ7vJt66dqsde4o5KDplCvRFMV4aOjMtEPfnnGOZur7G', '2021-07-28', NULL, NULL),
(12, 'proba123', 'proba123@gmail.com', '$2y$10$HfQ58v1qFGT8yUqgznpFSO9pKxCJB6PuQCYPPukFMrLHlcoJcpKqS', '2021-07-28', NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Индекси за таблица `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
