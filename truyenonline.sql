-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Dec 04, 2024 at 08:55 AM
-- Server version: 8.0.30
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `truyenonline`
--

-- --------------------------------------------------------

--
-- Table structure for table `chapters`
--

CREATE TABLE `chapters` (
  `chapter_id` int NOT NULL,
  `comic_id` int NOT NULL,
  `chap_number` int NOT NULL DEFAULT '1',
  `title` varchar(255) DEFAULT NULL,
  `page_number` int NOT NULL,
  `img_content` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `view_count` int NOT NULL DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `chapters`
--

INSERT INTO `chapters` (`chapter_id`, `comic_id`, `chap_number`, `title`, `page_number`, `img_content`, `view_count`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 'Đây có phải cách tình yêu bắt đầu ?', 66, 'dan_da_dan/chap_1/', 9, '2024-11-28 13:46:30', NULL),
(2, 1, 2, 'Thứ đó là người ngoài hành tinh phải không?', 54, 'dan_da_dan/chap_2/', 6, '2024-11-30 02:13:44', NULL),
(3, 2, 1, NULL, 16, 'dragon_ball_super/chap_1/', 10, '2024-12-02 12:16:38', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `comics`
--

CREATE TABLE `comics` (
  `comic_id` int NOT NULL,
  `comic_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `artist` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci,
  `status` int NOT NULL DEFAULT '0',
  `chap_total` int NOT NULL DEFAULT '0',
  `comic_dir` varchar(255) DEFAULT NULL,
  `title_img` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `view_count` int NOT NULL DEFAULT '0',
  `coin_price` int NOT NULL DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `comics`
--

INSERT INTO `comics` (`comic_id`, `comic_name`, `artist`, `description`, `status`, `chap_total`, `comic_dir`, `title_img`, `view_count`, `coin_price`, `created_at`, `updated_at`) VALUES
(1, 'Dan Da Dan', 'Tatsu Yukinobu', 'Một chàng trai otaku đam mê huyền bí không tin vào ma quỷ và Ayase, một cô gái không tin vào người ngoài hành tinh, gặp phải một bí ẩn quá lớn vượt quá sự hiểu biết của bản thân. Câu chuyện tình bi hài pha lẫn kinh dị và huyền bí !', 0, 2, 'dan_da_dan/', 'dan_da_dan/title.jpg', 15, 0, '2024-11-28 13:38:41', NULL),
(2, 'Dragon Ball Super', 'Toriyama Akira', 'Câu chuyện của Dragon Ball Super diễn ra ngay sau khi chiến đấu với Ma Nhân Bư, cuộc sống ở trái đất lại được hòa bình thêm 1 lần nữa. Sau đó vì nhà gần như hết tiền để chi tiêu Chichi tiền ra lệnh cho Goku phải đi kiếm tiền, và không được phép luyện tập trong thời gian này!! Videl sắp trở thành chị dâu của Goten nên Goten đã đặt ra một cuộc hành trình cùng với TRunks để tìm cho Videl một món quà!', 1, 1, 'dragon_ball_super/', 'dragon_ball_super/title.jpg', 10, 50, '2024-12-02 12:15:43', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `comic_bought`
--

CREATE TABLE `comic_bought` (
  `bought_id` int NOT NULL,
  `user_id` int NOT NULL,
  `comic_id` int NOT NULL,
  `price` int NOT NULL,
  `time_bought` timestamp NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `comic_bought`
--

INSERT INTO `comic_bought` (`bought_id`, `user_id`, `comic_id`, `price`, `time_bought`) VALUES
(1, 1, 2, 50, '2024-12-03 11:29:02'),
(4, 7, 2, 50, '2024-12-03 21:12:57'),
(6, 6, 2, 50, '2024-12-04 07:21:57');

-- --------------------------------------------------------

--
-- Table structure for table `comic_genres`
--

CREATE TABLE `comic_genres` (
  `comic_genre_id` int NOT NULL,
  `comic_id` int NOT NULL,
  `genre_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `comic_genres`
--

INSERT INTO `comic_genres` (`comic_genre_id`, `comic_id`, `genre_id`) VALUES
(1, 1, 1),
(2, 1, 2),
(3, 2, 4),
(4, 2, 1);

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `comment_id` int NOT NULL,
  `user_id` int NOT NULL,
  `comic_id` int NOT NULL,
  `chapter_id` int NOT NULL,
  `content` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `deposit_history`
--

CREATE TABLE `deposit_history` (
  `id` int NOT NULL,
  `user_id` int NOT NULL,
  `price` int DEFAULT NULL,
  `coin_get` int DEFAULT NULL,
  `payment_method` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `favorites`
--

CREATE TABLE `favorites` (
  `favorite_id` int NOT NULL,
  `user_id` int NOT NULL,
  `comic_id` int NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `genres`
--

CREATE TABLE `genres` (
  `genre_id` int NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `genres`
--

INSERT INTO `genres` (`genre_id`, `name`, `description`) VALUES
(1, 'Actions', 'Hành động có 102'),
(2, 'Adventure', 'Phiêu lưu kỳ thú'),
(4, 'Fantasy', '');

-- --------------------------------------------------------

--
-- Table structure for table `reading_history`
--

CREATE TABLE `reading_history` (
  `history_id` int NOT NULL,
  `user_id` int NOT NULL,
  `comic_id` int NOT NULL,
  `chapter_id` int NOT NULL,
  `last_page` int NOT NULL,
  `last_read` timestamp NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int NOT NULL,
  `username` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `avatar` varchar(255) DEFAULT NULL,
  `coin` int NOT NULL DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  `role` tinyint NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `username`, `email`, `password`, `avatar`, `coin`, `created_at`, `updated_at`, `role`) VALUES
(1, 'admin', 'admin@admin', 'admin', 'admin_1.jpg', 12245, '2024-11-21 08:36:53', NULL, 1),
(2, 'user', 'user@mail.com', 'user', NULL, 0, '2024-11-29 17:53:46', NULL, 0),
(6, 'test1', 'test2@mail.com', 'haha', 'test2_51c7b4.gif', 0, '2024-11-30 12:44:17', NULL, 0),
(7, 'test4', 'test4@mail.com', 'haha', 'test4_b65096.jpg', 0, '2024-12-01 00:16:34', NULL, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `chapters`
--
ALTER TABLE `chapters`
  ADD PRIMARY KEY (`chapter_id`),
  ADD KEY `comic_id` (`comic_id`);

--
-- Indexes for table `comics`
--
ALTER TABLE `comics`
  ADD PRIMARY KEY (`comic_id`);

--
-- Indexes for table `comic_bought`
--
ALTER TABLE `comic_bought`
  ADD PRIMARY KEY (`bought_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `comic_id` (`comic_id`);

--
-- Indexes for table `comic_genres`
--
ALTER TABLE `comic_genres`
  ADD PRIMARY KEY (`comic_genre_id`),
  ADD KEY `comic_id` (`comic_id`),
  ADD KEY `genre_id` (`genre_id`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`comment_id`),
  ADD KEY `chapter_id` (`chapter_id`),
  ADD KEY `comic_id` (`comic_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `deposit_history`
--
ALTER TABLE `deposit_history`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `favorites`
--
ALTER TABLE `favorites`
  ADD PRIMARY KEY (`favorite_id`),
  ADD KEY `comic_id` (`comic_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `genres`
--
ALTER TABLE `genres`
  ADD PRIMARY KEY (`genre_id`);

--
-- Indexes for table `reading_history`
--
ALTER TABLE `reading_history`
  ADD PRIMARY KEY (`history_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `chapter_id` (`chapter_id`),
  ADD KEY `comic_id` (`comic_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `chapters`
--
ALTER TABLE `chapters`
  MODIFY `chapter_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `comics`
--
ALTER TABLE `comics`
  MODIFY `comic_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `comic_bought`
--
ALTER TABLE `comic_bought`
  MODIFY `bought_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `comic_genres`
--
ALTER TABLE `comic_genres`
  MODIFY `comic_genre_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `comment_id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `deposit_history`
--
ALTER TABLE `deposit_history`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `favorites`
--
ALTER TABLE `favorites`
  MODIFY `favorite_id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `genres`
--
ALTER TABLE `genres`
  MODIFY `genre_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `reading_history`
--
ALTER TABLE `reading_history`
  MODIFY `history_id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `chapters`
--
ALTER TABLE `chapters`
  ADD CONSTRAINT `chapters_ibfk_1` FOREIGN KEY (`comic_id`) REFERENCES `comics` (`comic_id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Constraints for table `comic_bought`
--
ALTER TABLE `comic_bought`
  ADD CONSTRAINT `comic_bought_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `comic_bought_ibfk_2` FOREIGN KEY (`comic_id`) REFERENCES `comics` (`comic_id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Constraints for table `comic_genres`
--
ALTER TABLE `comic_genres`
  ADD CONSTRAINT `comic_genres_ibfk_1` FOREIGN KEY (`comic_id`) REFERENCES `comics` (`comic_id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `comic_genres_ibfk_2` FOREIGN KEY (`genre_id`) REFERENCES `genres` (`genre_id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Constraints for table `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `comments_ibfk_1` FOREIGN KEY (`chapter_id`) REFERENCES `chapters` (`chapter_id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `comments_ibfk_2` FOREIGN KEY (`comic_id`) REFERENCES `comics` (`comic_id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `comments_ibfk_3` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Constraints for table `deposit_history`
--
ALTER TABLE `deposit_history`
  ADD CONSTRAINT `deposit_history_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Constraints for table `favorites`
--
ALTER TABLE `favorites`
  ADD CONSTRAINT `favorites_ibfk_1` FOREIGN KEY (`comic_id`) REFERENCES `comics` (`comic_id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `favorites_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Constraints for table `reading_history`
--
ALTER TABLE `reading_history`
  ADD CONSTRAINT `reading_history_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `reading_history_ibfk_2` FOREIGN KEY (`chapter_id`) REFERENCES `chapters` (`chapter_id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `reading_history_ibfk_3` FOREIGN KEY (`comic_id`) REFERENCES `comics` (`comic_id`) ON DELETE RESTRICT ON UPDATE RESTRICT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
