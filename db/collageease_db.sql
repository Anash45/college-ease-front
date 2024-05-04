-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 04, 2024 at 12:54 PM
-- Server version: 8.0.35
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `collageease_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `commentID` int NOT NULL,
  `content` text COLLATE utf8mb4_general_ci,
  `userID` int NOT NULL,
  `postID` int NOT NULL,
  `createdAt` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`commentID`, `content`, `userID`, `postID`, `createdAt`) VALUES
(5, 'Check', 2, 2, '2024-04-18 18:00:44'),
(6, 'Testing.', 2, 2, '2024-04-18 18:00:49'),
(7, 'Testing.', 2, 3, '2024-04-18 18:02:12');

-- --------------------------------------------------------

--
-- Table structure for table `contactmessages`
--

CREATE TABLE `contactmessages` (
  `ID` int NOT NULL,
  `Name` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `Email` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `Message` text COLLATE utf8mb4_general_ci NOT NULL,
  `CreatedAt` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `contactmessages`
--

INSERT INTO `contactmessages` (`ID`, `Name`, `Email`, `Message`, `CreatedAt`) VALUES
(2, 'Syed Muhammad Anas Bukhari', 'f4futuretech@gmail.com', 'Abcd Test.', '2024-05-02 23:54:13');

-- --------------------------------------------------------

--
-- Table structure for table `faqs`
--

CREATE TABLE `faqs` (
  `fId` int NOT NULL,
  `question` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `answer` text COLLATE utf8mb4_general_ci NOT NULL,
  `createdAt` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `faqs`
--

INSERT INTO `faqs` (`fId`, `question`, `answer`, `createdAt`) VALUES
(1, 'WHY DO UNIVERSITIES FREQUENTLY DELAY ANNOUNCING THEIR DATES?', 'The lack of a university means that she often has not announced her dates yet.', '2024-04-29 02:18:09'),
(2, 'WHO IS ELIGIBLE FOR GRADUATE STUDIES AND BRIDGING PROGRAMS?', 'Graduate studies and bridging are not for high school graduates.', '2024-04-29 02:19:33'),
(3, 'HOW CAN THE REGISTRATION DATES BE OBTAINED?', 'You can tell us the registration dates by clicking here for appointments.', '2024-04-29 02:19:45'),
(4, 'Test', 'aadasd', '2024-04-29 02:26:26'),
(5, 'Test', 'aadasd', '2024-04-29 02:26:36');

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `postID` int NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `content` text COLLATE utf8mb4_general_ci,
  `userID` int NOT NULL,
  `closed` tinyint(1) DEFAULT '0',
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `createdAt` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`postID`, `title`, `content`, `userID`, `closed`, `status`, `createdAt`) VALUES
(2, 'New Post', 'New\r\nPost \r\ntesting... 1234', 1, 0, 0, '2024-04-18 17:19:35'),
(3, 'Post Test By User 1', 'This is the post testing by user.', 2, 1, 1, '2024-04-18 18:01:32'),
(4, 'Test', 'Testing\r\n', 3, 0, 1, '2024-05-03 00:00:09'),
(6, 'Test Alumni', 'Alumni post.', 3, 0, 1, '2024-05-03 00:08:52');

-- --------------------------------------------------------

--
-- Table structure for table `programs`
--

CREATE TABLE `programs` (
  `ID` int NOT NULL,
  `Name` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `State` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `Degree` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `Registration_Date` date NOT NULL,
  `Registration_Link` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `createdAt` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `Location` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `Rank` int DEFAULT NULL,
  `Scholarships` varchar(255) COLLATE utf8mb4_general_ci DEFAULT 'Included',
  `Career_Services` varchar(255) COLLATE utf8mb4_general_ci DEFAULT 'Included'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `programs`
--

INSERT INTO `programs` (`ID`, `Name`, `State`, `Degree`, `Registration_Date`, `Registration_Link`, `createdAt`, `Location`, `Rank`, `Scholarships`, `Career_Services`) VALUES
(2, 'UMT', 'public', 'masters', '2024-04-11', 'https://onlineadmissions.umt.edu.pk/', '2024-04-17 23:45:41', 'JHKL', 13, 'Not Included', 'Included'),
(3, 'UMS University', 'private', 'phd', '2024-04-20', 'https://onlineadmissions.umt.edu.pk/', '2024-04-18 17:07:29', 'LHR', 12, 'Included', 'Not Included'),
(4, 'UMS University', 'private', 'phd', '2024-04-20', 'https://onlineadmissions.umt.edu.pk/', '2024-04-18 17:07:32', 'LHR', 12, 'Included', 'Not Included'),
(5, 'Test', 'public', 'bachelors', '2024-04-09', 'https://onlineadmissions.umt.edu.pk/', '2024-04-29 03:09:01', 'ISB', 21, 'Not Included', 'Included');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `ID` int NOT NULL,
  `Name` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `Email` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `Password` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `Role` enum('alumni','student','admin') COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`ID`, `Name`, `Email`, `Password`, `Role`) VALUES
(1, 'Admin', 'admin@gmail.com', '$2y$10$p0X1BbTbnPNtHLSk6fcba.DbWa0s.4LjTW4kAXNhNMh6k8XrDuqSi', 'admin'),
(2, 'Abcd', 'abc@xyz.com', '$2y$10$x/lJFyeYrSAPtK/HEfzP9ODDkxC9KnlWN9GOi/k.FUUPLl1egfSWC', 'student'),
(3, 'Alumni', 'abc1@xyz.com', '$2y$10$ZVSEB8HzKlFEEvHIfP4ko.avHL1I8oqTQNVgX0G.8wKzlmjXjkUI2', 'alumni');

-- --------------------------------------------------------

--
-- Table structure for table `votes`
--

CREATE TABLE `votes` (
  `voteID` int NOT NULL,
  `commentID` int NOT NULL,
  `userID` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `votes`
--

INSERT INTO `votes` (`voteID`, `commentID`, `userID`) VALUES
(9, 6, 2);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`commentID`),
  ADD KEY `userID` (`userID`),
  ADD KEY `postID` (`postID`);

--
-- Indexes for table `contactmessages`
--
ALTER TABLE `contactmessages`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `faqs`
--
ALTER TABLE `faqs`
  ADD PRIMARY KEY (`fId`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`postID`),
  ADD KEY `userID` (`userID`);

--
-- Indexes for table `programs`
--
ALTER TABLE `programs`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `votes`
--
ALTER TABLE `votes`
  ADD PRIMARY KEY (`voteID`),
  ADD KEY `commentID` (`commentID`),
  ADD KEY `userID` (`userID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `commentID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `contactmessages`
--
ALTER TABLE `contactmessages`
  MODIFY `ID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `faqs`
--
ALTER TABLE `faqs`
  MODIFY `fId` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `postID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `programs`
--
ALTER TABLE `programs`
  MODIFY `ID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `ID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `votes`
--
ALTER TABLE `votes`
  MODIFY `voteID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `comments_ibfk_1` FOREIGN KEY (`userID`) REFERENCES `users` (`ID`) ON DELETE CASCADE,
  ADD CONSTRAINT `comments_ibfk_2` FOREIGN KEY (`postID`) REFERENCES `posts` (`postID`) ON DELETE CASCADE;

--
-- Constraints for table `posts`
--
ALTER TABLE `posts`
  ADD CONSTRAINT `posts_ibfk_1` FOREIGN KEY (`userID`) REFERENCES `users` (`ID`) ON DELETE CASCADE;

--
-- Constraints for table `votes`
--
ALTER TABLE `votes`
  ADD CONSTRAINT `votes_ibfk_1` FOREIGN KEY (`commentID`) REFERENCES `comments` (`commentID`) ON DELETE CASCADE,
  ADD CONSTRAINT `votes_ibfk_2` FOREIGN KEY (`userID`) REFERENCES `users` (`ID`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
