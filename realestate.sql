-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 24, 2025 at 05:48 AM
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
-- Database: `realestate`
--

-- --------------------------------------------------------

--
-- Table structure for table `favorites`
--

CREATE TABLE `favorites` (
  `favorite_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `property_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `favorites`
--

INSERT INTO `favorites` (`favorite_id`, `user_id`, `property_id`) VALUES
(31, 8, 15),
(39, 1, 22);

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `message_id` int(11) NOT NULL,
  `sender_id` int(11) DEFAULT NULL,
  `receiver_id` int(11) DEFAULT NULL,
  `message` text NOT NULL,
  `sent_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `timestamp` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`message_id`, `sender_id`, `receiver_id`, `message`, `sent_at`, `timestamp`) VALUES
(6, 1, 3, 'yeno guru', '2025-03-14 15:33:40', '2025-03-14 21:03:40'),
(7, 1, 3, 'yenilla', '2025-03-14 15:38:57', '2025-03-14 21:08:57'),
(8, 1, 3, 'im tharun', '2025-03-14 15:39:44', '2025-03-14 21:09:44'),
(9, 1, 3, 'yeno', '2025-03-14 15:48:04', '2025-03-14 21:18:04'),
(10, 3, 1, 'uvce', '2025-03-14 15:53:35', '2025-03-14 21:23:35'),
(14, 3, 1, 'hi', '2025-03-15 06:39:50', '2025-03-15 12:09:50'),
(15, 3, 1, 'hi', '2025-03-15 06:39:53', '2025-03-15 12:09:53'),
(16, 3, 1, 'hi', '2025-03-15 06:39:55', '2025-03-15 12:09:55'),
(17, 3, 1, 'yeno', '2025-03-15 06:48:34', '2025-03-15 12:18:34'),
(18, 3, 1, 'im mahesh this side', '2025-03-15 06:48:49', '2025-03-15 12:18:49'),
(19, 3, 1, 'hii', '2025-03-15 06:59:38', '2025-03-15 12:29:38'),
(21, 1, 3, 'yen sisyaa', '2025-03-15 07:04:51', '2025-03-15 12:34:51'),
(22, 4, 1, 'guru mane beku', '2025-03-15 15:03:18', '2025-03-15 20:33:18'),
(23, 1, 4, 'ok guru', '2025-03-15 15:12:13', '2025-03-15 20:42:13'),
(24, 4, 1, 'yeno meena', '2025-03-19 06:53:22', '2025-03-19 12:23:22'),
(25, 7, 1, 'hii i need a home', '2025-03-22 02:10:12', '2025-03-22 07:40:12'),
(26, 4, 4, 'hi', '2025-03-23 04:30:36', '2025-03-23 10:00:36'),
(27, 1, 4, 'hello', '2025-03-23 04:37:29', '2025-03-23 10:07:29'),
(28, 1, 8, 'hloo', '2025-03-23 15:04:44', '2025-03-23 20:34:44'),
(29, 1, 8, 'hii', '2025-03-24 04:27:47', '2025-03-24 09:57:47');

-- --------------------------------------------------------

--
-- Table structure for table `properties`
--

CREATE TABLE `properties` (
  `property_id` int(11) NOT NULL,
  `property_name` varchar(255) NOT NULL,
  `price` decimal(12,2) NOT NULL,
  `property_address` varchar(255) NOT NULL,
  `owner_email` varchar(100) NOT NULL,
  `owner_phone` varchar(15) NOT NULL,
  `property_type` varchar(50) NOT NULL,
  `image` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `user_id` int(11) NOT NULL,
  `description` text DEFAULT NULL,
  `owner_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `properties`
--

INSERT INTO `properties` (`property_id`, `property_name`, `price`, `property_address`, `owner_email`, `owner_phone`, `property_type`, `image`, `created_at`, `user_id`, `description`, `owner_name`) VALUES
(15, 'Taj Mahal', 3500000000.00, 'Agra, Uttar Pradesh', 'shahajahan@gmail.com', '9863167479', 'House', '1742701448-taj mahal.jpg', '2025-03-23 03:44:08', 4, 'TajMahal', 'Raghu'),
(16, 'Raj Apartments', 300000000.00, 'Rajajinagar, Bangalore', 'rajkumar@gmail.com', '874934673', 'Apartment', '1742739513-images (2).jpeg', '2025-03-23 14:18:33', 8, 'Nice', 'Akash'),
(17, 'KumarKrupa Apartments', 2000000000.00, 'Magadi Raod, bangalore', 'raghunath@gmail.com', '879213996', 'Apartment', '1742739679-images (1).jpeg', '2025-03-23 14:21:19', 8, 'apartment', 'Virat'),
(18, 'Naidu Buildings', 2000000000.00, 'Koramangala, Bangalore', 'rajkumar@gmail.com', '897348793', 'Apartment', '1742740035-istockphoto-488120139-612x612.jpg', '2025-03-23 14:27:15', 8, 'Nice', 'Ashish'),
(19, 'Cathedrel Properties', 4500000000.00, 'Vijayanagar, Banaglore', 'nandan@gmail.com', '7389413879', 'House', '1742740167-pexels-photo-439391.jpeg', '2025-03-23 14:29:27', 8, 'good', 'Dilson'),
(20, 'Joseph Gardens', 2000000000.00, 'Mysore, Karnataka', 'shashank@gmail.com', '78943879132', 'House', '1742740234-images (4).jpeg', '2025-03-23 14:30:34', 8, 'Good', 'John'),
(21, 'Sobha Apartments', 900000000.00, 'Rajajinagar,Bnagalore', 'karthik@gmail.com', '8786879324', 'Apartment', '1742740305-istockphoto-2148850507-612x612.jpg', '2025-03-23 14:31:45', 8, 'Good', 'Shreyas'),
(22, 'Dilson Gardens', 1600000000.00, 'Hosakote, Bnagalore Rural, Karnataka', 'dilson@gmail.com', '8734289318', 'House', '1742740384-images (5).jpeg', '2025-03-23 14:33:04', 8, 'Good', 'Akshay'),
(23, 'Vintage Villas', 100000000.00, 'Bangalore', 'srikanth@gmail.com', '8939631869', 'Apartment', '1742741906-images (7).jpeg', '2025-03-23 14:58:26', 8, 'Good', 'Kumara'),
(24, 'Kishor Farms', 230000000.00, 'Hebbal, Bangalore', 'kishor@gmail.com', '72136939', 'Land', '1742742216-images (6).jpeg', '2025-03-23 15:03:36', 8, 'Nice', 'Kishore'),
(25, 'RK Nests', 250000000.00, 'Kolar', 'ramu@gmail.com', '970784123', 'House', '1742744072-images (5).jpeg', '2025-03-23 15:34:32', 1, 'Nice home', 'RamRaj');

-- --------------------------------------------------------

--
-- Table structure for table `reports`
--

CREATE TABLE `reports` (
  `report_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `property_id` int(11) NOT NULL,
  `reason` text NOT NULL,
  `report_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `reports`
--

INSERT INTO `reports` (`report_id`, `user_id`, `property_id`, `reason`, `report_date`) VALUES
(1, 1, 25, 'there some legal issues', '2025-03-23 15:35:04'),
(2, 1, 25, 'there some legal issues', '2025-03-23 15:38:55'),
(3, 1, 25, 'not good as shown', '2025-03-23 15:39:04'),
(4, 1, 16, 'apartment not good', '2025-03-24 04:21:23');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `address` text NOT NULL,
  `dob` date NOT NULL,
  `phone` varchar(15) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `profile_image` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `first_name`, `last_name`, `address`, `dob`, `phone`, `email`, `password`, `profile_image`) VALUES
(1, 'tharun', 'p', 'Yelahanka', '1999-02-26', '863852764', 'tharun@gmail.com', '$2y$10$tH6r6TT8Yq28sTXbM1wEfOfX1FAC4Nqoz6BPJr91PTUgxZrRyihde', NULL),
(3, 'Kushal', 'R', 'Kolar', '2001-07-11', '7634167733', 'kushal@gmail.com', '$2y$10$f3gggroin3/qWSoiI.HJ8e3J/qwx/SakWk/UU2oMho4EY0LT8MV4.', NULL),
(4, 'Mahesh', 'M', 'Hoskte', '1999-11-18', '8927639189', 'mahesh@gmail.com', '$2y$10$JjEerkkYBncnK3Y6MdOjyeyhtbxddHAq6bO5sNR/1vNoTwTEgnFca', NULL),
(6, 'Raghu', 'R', 'Mysore', '1997-01-28', '8349866972', 'raghu@gmail.com', '$2y$10$Z231zaHKTKqvYPjIzfL0reR6oiaZ9dxUfp5ZgAsTBovTZ8lAbmiwe', NULL),
(7, 'Ramesh', 'Kumar', 'Bangalore', '2000-03-09', '9829873934', 'ramesh@gmail.com', '$2y$10$CFNQEsqBXLP6tnDGzMwuTecfvrLJUfObK4iIqXNKmuh8lq1cStL7C', NULL),
(8, 'Kushal', 'D R', 'Kolar, Bnagalore', '2000-12-31', '8691289869', 'kushaldr@gmail.com', '$2y$10$dZh1LZ46Pj3JxXfmjg.ueumLwuONUoI.LtZ.X5p3JPa.jOcChj.H.', NULL),
(9, 'Vinay', 'Kumar', 'Mallshwaram', '1994-03-24', '785621855', 'sukku@gmail.com', '$2y$10$fE3annCvRcJS5pB4/ZkW2.6mqCTPb5EwaZoHNeF5x3SBk/cQAlfsu', NULL),
(10, 'Mohith', 'N', 'Mulbagal', '1977-10-20', '9986998658', 'cr@gmail.com', '$2y$10$cA3SjiXepwL2LLtGOVY6VuLLbmTeh4Z8HE9yoSZo5eTiSlCbxyCZO', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `favorites`
--
ALTER TABLE `favorites`
  ADD PRIMARY KEY (`favorite_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `property_id` (`property_id`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`message_id`),
  ADD KEY `sender_id` (`sender_id`),
  ADD KEY `receiver_id` (`receiver_id`);

--
-- Indexes for table `properties`
--
ALTER TABLE `properties`
  ADD PRIMARY KEY (`property_id`);

--
-- Indexes for table `reports`
--
ALTER TABLE `reports`
  ADD PRIMARY KEY (`report_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `property_id` (`property_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `phone` (`phone`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `favorites`
--
ALTER TABLE `favorites`
  MODIFY `favorite_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `message_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `properties`
--
ALTER TABLE `properties`
  MODIFY `property_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `reports`
--
ALTER TABLE `reports`
  MODIFY `report_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `favorites`
--
ALTER TABLE `favorites`
  ADD CONSTRAINT `favorites_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `favorites_ibfk_2` FOREIGN KEY (`property_id`) REFERENCES `properties` (`property_id`) ON DELETE CASCADE;

--
-- Constraints for table `reports`
--
ALTER TABLE `reports`
  ADD CONSTRAINT `reports_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `reports_ibfk_2` FOREIGN KEY (`property_id`) REFERENCES `properties` (`property_id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
