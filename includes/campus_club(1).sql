-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Oct 28, 2026 at 03:32 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `campus_club`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `category_id` int(11) NOT NULL,
  `category_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`category_id`, `category_name`) VALUES
(1, 'creative'),
(2, 'social'),
(3, 'technical');

-- --------------------------------------------------------

--
-- Table structure for table `clubs`
--

CREATE TABLE `clubs` (
  `club_id` int(11) NOT NULL,
  `club_name` varchar(50) NOT NULL,
  `description` varchar(200) NOT NULL,
  `meeting_time` varchar(30) NOT NULL,
  `meeting_location` varchar(50) NOT NULL,
  `contact_email` varchar(50) NOT NULL,
  `catagory_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `clubs`
--

INSERT INTO `clubs` (`club_id`, `club_name`, `description`, `meeting_time`, `meeting_location`, `contact_email`, `catagory_id`) VALUES
(1, 'Writers Coalition', 'Get together with like-minded people are share your ideas and stories!', 'Tuesdays at 3:00pm', 'NKM Building Room 120', 'writers@gmail.com', 1),
(2, 'Painting Wizards', 'Do you like to paint? Do you like new and exciting project ideas? Well come join us!', 'Mondays at 4:30pm', 'NKM Building Room 123', 'paintingwizards@gmail.com', 1),
(3, 'Website Development Pros', 'Are you interested in Web Development? Well, we\'re the club for you! No matter what you\'re experience level is, we work with each other to create all sorts of innovative websites!', 'Tudesdays at 5:00 pm', 'IC Room 204', 'webdevers@gmail.com', 3),
(4, 'Hype Squad', 'Worried about the semester? Things getting too overwhelming? Join our club and meet new friends, take a break from the stress, and play some games to get back into a happy space!', 'Fridays at 1:30 pm', 'ICW', 'hypesquard@gmail.com', 2),
(5, 'Mathmatical Magicians', 'Do you like math? Is solving long equations fun? Well join us for weekly challenges, practical calculations for real world events, and a group of like-minded people!', 'Mondays at 12:30pm', 'ICE Room 153', 'mathmagic@gmail.com', 3);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `clubs`
--
ALTER TABLE `clubs`
  ADD PRIMARY KEY (`club_id`),
  ADD KEY `catagory_id` (`catagory_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `clubs`
--
ALTER TABLE `clubs`
  MODIFY `club_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `clubs`
--
ALTER TABLE `clubs`
  ADD CONSTRAINT `clubs_ibfk_1` FOREIGN KEY (`catagory_id`) REFERENCES `categories` (`category_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
