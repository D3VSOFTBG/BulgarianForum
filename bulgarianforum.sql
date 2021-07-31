-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1
-- Време на генериране:  1 авг 2021 в 00:33
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
  `profile_picture` varchar(250) DEFAULT NULL,
  `token` varchar(50) DEFAULT NULL,
  `token_created_time` int(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Схема на данните от таблица `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `registered_date`, `profile_picture`, `token`, `token_created_time`) VALUES
(3, 'test2', 'test2@gmail.com', '$2y$10$nX6IM/B2xycREmZ5c7MJmeeuOHj1A2e5oF4tevj9vi6GwBc.7mZkK', '2021-06-26', NULL, '104b5151221169c35fe498b64c7aab7a', NULL),
(4, 'testing123', 'testing123@gmail.com', '$2y$10$kjhTbfv89SvmnFI1t1KYqufXAOq/hSxhb4ZQ/y7FaNBx/EWESadSa', '2021-06-30', NULL, NULL, NULL),
(8, 'parapetXD123', 'parapetXD123@gmail.com', '$2y$10$tgl2YgmUDInfdXnTk9OsbuBEOd8oiPKIeYecd.HsFlrFeKMvyC0.y', '2021-07-27', NULL, NULL, NULL),
(9, 'leshtorba123', 'leshtorba123@gmail.com', '$2y$10$cmSd.GmeJ4LU/UO5AKZ4k.4TrWJuMGUvlcLbh8AdYkO/vProsyDQ.', '2021-07-27', NULL, 'aa2127c15497b283978e41e90d16aaee', 1627602360),
(10, 'parolata', 'parolata@gmail.com', '$2y$10$6szoppCa3EyDd0P7FOcgA.u.VvHDfsv6M6QCyRXsFqAMNMaH7S4yK', '2021-07-27', NULL, '1654e0c2d67687ea84e695c5dff7b91b', 1627597381),
(11, 'testvam123', 'testvam123@gmail.com', '$2y$10$weVdAg5ZGmQ7vJt66dqsde4o5KDplCvRFMV4aOjMtEPfnnGOZur7G', '2021-07-28', NULL, NULL, NULL),
(12, 'proba123', 'proba123@yahoo.com', '$2y$10$nkyuiAi5zdRXyFafw7PLAuLCXh8m.Nn0c5eU.IJOWrnN/fewxYuRW', '2021-07-28', '../uploads/proba123/profile-picture/ed0a3721e8b4bdb2122713ea7fa248eb.jpg', NULL, NULL),
(13, 'nevuzmojen123', 'nevuzmojen123@gmail.com', '$2y$10$3DUlIs7HP2/iZiz17vcOgeQF68RQUTg9LEbBQiaAejtZiBkrJTU2i', '2021-07-30', NULL, NULL, NULL);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
