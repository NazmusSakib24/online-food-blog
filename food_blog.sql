-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 18, 2026 at 09:27 AM
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
-- Database: `food_blog`
--

-- --------------------------------------------------------

--
-- Table structure for table `food_experience_comments`
--

CREATE TABLE `food_experience_comments` (
  `id` int(11) NOT NULL,
  `post_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `comment` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `food_experience_comments`
--

INSERT INTO `food_experience_comments` (`id`, `post_id`, `user_id`, `comment`, `created_at`) VALUES
(4, 9, 7, 'nice', '2026-05-18 00:16:39'),
(5, 5, 6, 'ocaqe', '2026-05-18 00:24:50'),
(6, 4, 6, 'bjaoebj', '2026-05-18 00:24:54'),
(7, 3, 6, 'abjdvcbadj', '2026-05-18 00:24:58');

-- --------------------------------------------------------

--
-- Table structure for table `food_experience_posts`
--

CREATE TABLE `food_experience_posts` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `post_type` enum('restaurant','food','both') NOT NULL,
  `restaurant_id` int(11) DEFAULT NULL,
  `menu_item_id` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `food_experience_posts`
--

INSERT INTO `food_experience_posts` (`id`, `user_id`, `title`, `content`, `post_type`, `restaurant_id`, `menu_item_id`, `created_at`, `updated_at`) VALUES
(3, 10, 'nkldvadl', 'kdla dladvk', 'food', NULL, NULL, '2026-05-17 21:56:42', '2026-05-17 21:56:42'),
(4, 10, 'doabka', 'ajoc', 'restaurant', NULL, NULL, '2026-05-17 21:56:54', '2026-05-17 21:56:54'),
(5, 10, 'daln', 'dl ', 'food', NULL, NULL, '2026-05-17 21:57:44', '2026-05-17 21:57:44'),
(6, 11, 'jhkokho', 'oiahc', 'restaurant', NULL, NULL, '2026-05-17 21:58:28', '2026-05-17 22:45:48'),
(7, 11, 'dn', 'dskl j', 'both', NULL, NULL, '2026-05-17 21:58:36', '2026-05-17 21:58:36'),
(8, 14, 'lbqelfkbqpe', 'oeaibvcs koqe', 'restaurant', NULL, NULL, '2026-05-17 22:45:13', '2026-05-17 22:45:13'),
(9, 7, 'food', 'sandwich is good', 'food', NULL, NULL, '2026-05-18 00:07:23', '2026-05-18 00:07:23'),
(10, 6, 'hihoehfqoeih', 'jcfoabjcab', 'both', NULL, NULL, '2026-05-18 00:24:36', '2026-05-18 00:24:36'),
(11, 6, 'qiwjhdfqowih', 'sjcbaiscbji', 'restaurant', NULL, NULL, '2026-05-18 00:24:45', '2026-05-18 00:24:45');

-- --------------------------------------------------------

--
-- Table structure for table `menu_items`
--

CREATE TABLE `menu_items` (
  `id` int(11) NOT NULL,
  `restaurant_id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `image_path` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `restaurants`
--

CREATE TABLE `restaurants` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `location` varchar(100) NOT NULL,
  `area` varchar(100) NOT NULL,
  `short_background` text NOT NULL,
  `goals` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `reviews`
--

CREATE TABLE `reviews` (
  `id` int(11) NOT NULL,
  `menu_item_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `comment` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password_hash` varchar(255) NOT NULL,
  `role` enum('admin','member') NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password_hash`, `role`, `created_at`) VALUES
(1, '', 'asd@gmail.com', '$2y$10$5CWr4qCq7U3TdWzkWPqeu.v0cS.c/sNwJUZS1BZruR2d7Tkf3PAG2', 'admin', '2026-05-17 18:44:37'),
(6, 'aq', 'aq@gmail.com', '$2y$10$1qdTplPSraQYitLhG/.iaeQQMaRhQRB6xuNlc1p6iRC7hVXINimb.', 'member', '2026-05-17 19:03:12'),
(7, 'hj', 'hj@gmail.com', '$2y$10$.b9iPMqQm3XtUu8YXyM6z.W6AOIYyp49Gz.a6z2GCDyHpXJleD4M.', 'admin', '2026-05-17 19:04:07'),
(8, 'mj', 'mj@gmail.com', '$2y$10$t.R0H6Mp5JVPsICaRmrU5unCt.2dv5soCXV2QV3cFkSiNaRVGsV5W', 'admin', '2026-05-17 19:46:09'),
(10, 'gh', 'gh@gmail.com', '$2y$10$g9J8YJA5regeCRGI11L2E.FB/8K55hTRFApjYxBrfEUmsAu7dCFq2', 'admin', '2026-05-17 20:11:06'),
(11, 'vg', 'vg@gmail.com', '$2y$10$bRv/AISCniao/seKrQh4.eJYPyIjmZdxftf8vENZzeoanIyHbiwwq', 'member', '2026-05-17 21:58:14'),
(12, 'kk', 'kk@gmail.com', '$2y$10$9OO7UM5nT3Pt4DAbGftvm.5jcQldx66.diodLGWAn1Jne9GHYcxBu', 'admin', '2026-05-17 22:30:17'),
(14, 'vb', 'vb', '$2y$10$duwnWnbW1cfWDCf1GCcYM.l/snAWGbpH1Ww4WDqSPDQ9raxhh5Uka', 'admin', '2026-05-17 22:41:03');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `food_experience_comments`
--
ALTER TABLE `food_experience_comments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `post_id` (`post_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `food_experience_posts`
--
ALTER TABLE `food_experience_posts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `restaurant_id` (`restaurant_id`),
  ADD KEY `menu_item_id` (`menu_item_id`);

--
-- Indexes for table `menu_items`
--
ALTER TABLE `menu_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `restaurant_id` (`restaurant_id`);

--
-- Indexes for table `restaurants`
--
ALTER TABLE `restaurants`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`id`),
  ADD KEY `menu_item_id` (`menu_item_id`),
  ADD KEY `user_id` (`user_id`);

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
-- AUTO_INCREMENT for table `food_experience_comments`
--
ALTER TABLE `food_experience_comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `food_experience_posts`
--
ALTER TABLE `food_experience_posts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `menu_items`
--
ALTER TABLE `menu_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `restaurants`
--
ALTER TABLE `restaurants`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `reviews`
--
ALTER TABLE `reviews`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `food_experience_comments`
--
ALTER TABLE `food_experience_comments`
  ADD CONSTRAINT `food_experience_comments_ibfk_1` FOREIGN KEY (`post_id`) REFERENCES `food_experience_posts` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `food_experience_comments_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `food_experience_posts`
--
ALTER TABLE `food_experience_posts`
  ADD CONSTRAINT `food_experience_posts_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `food_experience_posts_ibfk_2` FOREIGN KEY (`restaurant_id`) REFERENCES `restaurants` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `food_experience_posts_ibfk_3` FOREIGN KEY (`menu_item_id`) REFERENCES `menu_items` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `menu_items`
--
ALTER TABLE `menu_items`
  ADD CONSTRAINT `menu_items_ibfk_1` FOREIGN KEY (`restaurant_id`) REFERENCES `restaurants` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `reviews`
--
ALTER TABLE `reviews`
  ADD CONSTRAINT `reviews_ibfk_1` FOREIGN KEY (`menu_item_id`) REFERENCES `menu_items` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `reviews_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
