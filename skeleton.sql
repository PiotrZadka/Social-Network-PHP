-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 16, 2018 at 01:23 AM
-- Server version: 10.1.28-MariaDB
-- PHP Version: 7.1.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `skeleton`
--

-- --------------------------------------------------------

--
-- Table structure for table `members`
--

CREATE TABLE `members` (
  `username` varchar(16) NOT NULL,
  `password` varchar(255) DEFAULT NULL,
  `muted` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `members`
--

INSERT INTO `members` (`username`, `password`, `muted`) VALUES
('a', '$2y$10$KDKXp0fWWAympo.6yLMjw.Gm6PzxlNBXs7m9i1T.eER/qI0JmQRJO', 0),
('admin', '$2y$10$sQtas9/BEG6Yod9wFi3PZO9VS43JNCrH0S8ArBkp5lKiGbnMn9R/u', 0),
('b', '$2y$10$l/TY2QP8AG5AogyFBXqjPeCCbo0v/DgI0CdOS5kz5TCuT5Z40CQxa', 0),
('barryg', '$2y$10$1JGH6URY5fv7rUlFIX3z4u3hI/ivsKfY./FIXH0U///rUCT3I6Wii', 0),
('brianm', '$2y$10$mxAG.ecSfaIlYWxE0yxs/OBqhEEM3jZRjzGiyjPF/d7QLV6.ldU4m', 0),
('c', '$2y$10$kZu3PuPRKDiuAHFIbcx9/uapcjXmpxxJjnvHX/fv4gio5VeoSp65i', 0),
('d', '$2y$10$sKDmUBmj.gTTFcA2/6zATOW9DXMmSiWHbeXt0uUSarsVom4P.d.Gq', 0),
('mandyb', '$2y$10$uiNYONlRn63WscAkcdwGo.YofROgzrUGFDOCOFtupvvT39rlg4xJe', 0),
('mathman', '$2y$10$abvdhFGVfGSTRk.44BxxkOA3C5YTX0ziHppXCF1C.HBJkZhS3FsG2', 0);

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `post_id` bigint(20) UNSIGNED NOT NULL,
  `username` varchar(16) NOT NULL,
  `content` varchar(140) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `likes` bigint(20) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`post_id`, `username`, `content`, `timestamp`, `likes`) VALUES
(1, 'admin', 'hello! Im Admin of this site.', '2017-12-31 21:01:50', 3),
(2, 'barryg', 'Hi Admin! Im Barry', '2017-12-31 21:02:07', 1),
(3, 'admin', 'I can mute people!', '2017-12-31 21:02:33', 0);

-- --------------------------------------------------------

--
-- Table structure for table `privatemessages`
--

CREATE TABLE `privatemessages` (
  `pm_id` bigint(20) UNSIGNED NOT NULL,
  `username` varchar(16) NOT NULL,
  `pmUsername` varchar(16) NOT NULL,
  `content` varchar(140) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `profiles`
--

CREATE TABLE `profiles` (
  `username` varchar(16) NOT NULL,
  `firstname` varchar(40) DEFAULT NULL,
  `lastname` varchar(50) DEFAULT NULL,
  `pets` tinyint(4) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `dob` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `profiles`
--

INSERT INTO `profiles` (`username`, `firstname`, `lastname`, `pets`, `email`, `dob`) VALUES
('barryg', 'Barry', 'Grimes', 5, 'baz_g@outlook.com', '1961-09-25'),
('mandyb', 'Mandy', 'Brent', 3, 'mb3@gmail.com', '1988-05-20');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `members`
--
ALTER TABLE `members`
  ADD PRIMARY KEY (`username`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`post_id`),
  ADD UNIQUE KEY `post_id` (`post_id`);

--
-- Indexes for table `privatemessages`
--
ALTER TABLE `privatemessages`
  ADD PRIMARY KEY (`pm_id`),
  ADD UNIQUE KEY `post_id` (`pm_id`);

--
-- Indexes for table `profiles`
--
ALTER TABLE `profiles`
  ADD PRIMARY KEY (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `post_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `privatemessages`
--
ALTER TABLE `privatemessages`
  MODIFY `pm_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
