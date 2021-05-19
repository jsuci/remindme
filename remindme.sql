-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 07, 2021 at 04:00 AM
-- Server version: 10.4.18-MariaDB
-- PHP Version: 8.0.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `remindme`
--

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `post_id` int(9) NOT NULL,
  `user_id` int(9) NOT NULL,
  `title` text NOT NULL,
  `message` text NOT NULL,
  `date_start` datetime DEFAULT NULL,
  `date_end` date DEFAULT NULL,
  `post_status` varchar(12) DEFAULT NULL,
  `date_modified` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`post_id`, `user_id`, `title`, `message`, `date_start`, `date_end`, `post_status`, `date_modified`) VALUES
(23, 12, 'Networking Quiz', 'Module Exam (IP Addressing) at Cisco Netacad\nActivation Time: 9:00AM-9:00PM\n', '2021-05-07 09:47:47', NULL, 'active', '2021-05-07 09:47:59'),
(24, 12, 'Networking Semi May 8', 'Semi-Final Exam (Chapter 9-13) on USTeP\nActivation Time: 1:00-9:00PM\nExam Duration: 90 mins -', '2021-05-07 09:57:15', NULL, 'active', '2021-05-07 09:58:00'),
(25, 12, 'System Integration May 7', 'Presentation @ 6PM', '2021-05-07 09:59:46', NULL, 'active', '2021-05-07 09:59:58');

--
-- Triggers `posts`
--
DELIMITER $$
CREATE TRIGGER `before_insert_get_date` BEFORE INSERT ON `posts` FOR EACH ROW BEGIN

    SET NEW.date_start = NOW();
    SET NEW.date_modified = NOW();

END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `before_update_get_date` BEFORE UPDATE ON `posts` FOR EACH ROW BEGIN

    SET NEW.date_modified = NOW();

END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(9) NOT NULL,
  `email` varchar(90) NOT NULL,
  `password` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `email`, `password`) VALUES
(12, 'jsuci.jsuci@gmail.com', '$2y$10$eiQvz0PZ2OPYdaPK2pfToOQxJcXzdDwsfqQNpGmKYwDr1gLCaem/S');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`post_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `post_id` int(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `posts`
--
ALTER TABLE `posts`
  ADD CONSTRAINT `posts_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
