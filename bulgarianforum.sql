-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1
-- Време на генериране:  7 авг 2021 в 00:17
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
-- Структура на таблица `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `category_name` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
  `role` varchar(50) NOT NULL,
  `profile_picture` varchar(250) NOT NULL,
  `email_confirmed` int(11) NOT NULL,
  `token` varchar(50) DEFAULT NULL,
  `token_created_time` int(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Схема на данните от таблица `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `registered_date`, `role`, `profile_picture`, `email_confirmed`, `token`, `token_created_time`) VALUES
(12, 'proba123', 'proba123@yahoo.com', '$2y$10$nkyuiAi5zdRXyFafw7PLAuLCXh8m.Nn0c5eU.IJOWrnN/fewxYuRW', '2021-07-28', 'Administrator', '../uploads/proba123/profile-picture/ed0a3721e8b4bdb2122713ea7fa248eb.jpg', 1, NULL, NULL),
(14, 'novpotrebitel123', 'novpotrebitel123@gmail.com', '$2y$10$YOwj6GnAX0df8geebxRO5OjNvAh3nGCB/K9qDEpdHDWxaZAV3KqUi', '2021-08-02', 'Member', 'https://www.gravatar.com/avatar/26cbe35a41c2fdc83515b1236dc65509', 0, '9d25523a5ec1325b122918a28dc84d17', 1628037653),
(15, 'petel123', 'petel123@gmail.com', '$2y$10$mpAj26DD3SH1a7ZWekh7Yuv8NuVT7./82FZAG8bBrgIm33jUAHozC', '2021-08-02', 'Member', 'https://www.gravatar.com/avatar/b5339c141ece5ead023b6f98745f1eb0', 0, '8049c55e43059b3aac877c3ee2dcfd0e', 1627945387);

--
-- Indexes for dumped tables
--

--
-- Индекси за таблица `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

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
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
