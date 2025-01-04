-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 29, 2024 at 02:49 AM
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
-- Database: `login_register`
--

-- --------------------------------------------------------

--
-- Table structure for table `form`
--

CREATE TABLE `form` (
  `id` int(255) NOT NULL,
  `fullName` text NOT NULL,
  `meetingDate` date NOT NULL,
  `workshopName` varchar(255) NOT NULL,
  `workshopDate` date NOT NULL,
  `schoolName` varchar(255) NOT NULL,
  `participants` int(11) NOT NULL,
  `pros` text NOT NULL,
  `cons` text NOT NULL,
  `suggestion` text NOT NULL,
  `workshopImage` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `form`
--

INSERT INTO `form` (`id`, `fullName`, `meetingDate`, `workshopName`, `workshopDate`, `schoolName`, `participants`, `pros`, `cons`, `suggestion`, `workshopImage`) VALUES
(21, 'Batrisyia', '2024-07-13', 'Rubber Band Boat', '2024-05-21', 'Tenby International School', 40, 'Student excited to do the workshop.\r\nThe student did not want to try to do the boat by themselves', 'Some students did not know how to tie the rubber band.\r\nThe student did not want to try to do the boat by themselves', 'Some students did not know how to tie the rubber band.\r\nkxchb\r\nbkjffxy \r\njhkhk', 'cc0f0729-1ed7-4c48-8439-cc1d091bbebb.jpg,953dacfe-bb97-4587-8f31-667d60d6b844.jpg'),
(31, 'isya', '2024-08-23', 'oo', '2024-08-10', 'oo', 22, 'mnb', 'uhg', 'jhbguv', 'full heart.png');

-- --------------------------------------------------------

--
-- Table structure for table `progress`
--

CREATE TABLE `progress` (
  `id` int(11) NOT NULL,
  `fullName` text NOT NULL,
  `meetingDate` date NOT NULL,
  `projectName` varchar(255) NOT NULL,
  `startProject` date NOT NULL DEFAULT current_timestamp(),
  `dueProject` date NOT NULL DEFAULT current_timestamp(),
  `complete` text NOT NULL,
  `inprogress` text NOT NULL,
  `projectImage` varchar(255) DEFAULT NULL,
  `gantt` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `progress`
--

INSERT INTO `progress` (`id`, `fullName`, `meetingDate`, `projectName`, `startProject`, `dueProject`, `complete`, `inprogress`, `projectImage`, `gantt`) VALUES
(35, 'Batrisyia', '2024-07-06', 'Weekly Feedback Meetingggg', '2024-03-13', '2024-06-01', 'Login and register page\r\nWebsite design\r\nFeedback form & dashboard\r\nInternship progress form & dashboard\r\nConnection to database', 'All done\r\nMantap\r\nSekali', 'Screenshot (230).png,signup page.png', 'Screenshot 2024-05-23 082358.png');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `fullname` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `fullname`, `email`, `password`, `created_at`) VALUES
(1, 'isya', 'mushuk', '$2y$10$TNUH2fP8xUZ75PYJroL6T.7ujr/zkBwf2d.jYrVKEqDxyQZVXt1tG', '2024-07-17 00:40:30'),
(2, 'Batrisyia', 'user1@gmail.com', '$2y$10$E94CRP.OvrauOrikHO7aM.uIQWZi3VIO/Lr0V0IKWE10aILjyQTiu', '2024-07-17 01:34:48'),
(3, 'bb', 'abc@user', '$2y$10$JKu/eMzQE0YW6kGT1BPOyOxiZyTXsOpupjXq2ybd6L2s398nh4jhK', '2024-07-17 01:53:35'),
(4, 'nur fathin batrisyia', 'fathinbatrisyia169@gmail.com', '$2y$10$SpTb2DXRow/cKrmnNKDa3OC35bzhaxrN9N6NlX76vb7c2c3Rzw/iW', '2024-07-17 06:52:53'),
(5, 'bb', 'aa@gmail.com', '$2y$10$gfAymiWkHrYMg.jBG/oQgeZ.JRkJuRJpTnkINU8/PawgSw20A4fTy', '2024-07-23 00:30:54'),
(6, 'bb', 'bbb@gmail.com', '$2y$10$ZJdxLs30k/zYzdzomvGYGu2..EUCz5roUjo75CvUyFcy7fOpjbkfW', '2024-07-25 00:06:58');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `form`
--
ALTER TABLE `form`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `progress`
--
ALTER TABLE `progress`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `form`
--
ALTER TABLE `form`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `progress`
--
ALTER TABLE `progress`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
