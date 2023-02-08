-- phpMyAdmin SQL Dump
-- version 4.9.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Feb 02, 2023 at 03:14 PM
-- Server version: 10.5.16-MariaDB
-- PHP Version: 7.3.32

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `id18993365_doctorratingapp`
--
CREATE DATABASE IF NOT EXISTS `id18993365_doctorratingapp` DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci;
USE `id18993365_doctorratingapp`;

-- --------------------------------------------------------

--
-- Table structure for table `department_table`
--

CREATE TABLE `department_table` (
  `id` int(10) NOT NULL,
  `dept_name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `create_date` datetime NOT NULL DEFAULT current_timestamp(),
  `description` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `doctor_hp_serial_numbers`
--

CREATE TABLE `doctor_hp_serial_numbers` (
  `id` int(11) NOT NULL,
  `doctor_id` int(11) NOT NULL,
  `hospital_name` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `serial_phone` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  `hospital_address` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `create_date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `doctor_table`
--

CREATE TABLE `doctor_table` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `department_id` int(11) NOT NULL,
  `doctor_name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `isActive` tinyint(1) NOT NULL DEFAULT 0,
  `designation` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `bmdc_reg` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `phone_personal` varchar(15) COLLATE utf8_unicode_ci DEFAULT NULL,
  `doctor_photo` blob DEFAULT NULL,
  `v_card_photo` blob DEFAULT NULL,
  `create_date` datetime DEFAULT current_timestamp(),
  `update_date` datetime DEFAULT current_timestamp(),
  `active_date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `feedback_reply`
--

CREATE TABLE `feedback_reply` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `feedback_id` int(11) NOT NULL,
  `reply_message` varchar(350) COLLATE utf8_unicode_ci DEFAULT NULL,
  `create_date` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `feedbac_table`
--

CREATE TABLE `feedbac_table` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `feedback_title` varchar(150) COLLATE utf8_unicode_ci DEFAULT NULL,
  `feedback_description` varchar(350) COLLATE utf8_unicode_ci DEFAULT NULL,
  `create_date` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `rating_reply`
--

CREATE TABLE `rating_reply` (
  `id` int(11) NOT NULL,
  `rating_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `rating_reply` varchar(350) COLLATE utf8_unicode_ci DEFAULT NULL,
  `create_date` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `rating_table`
--

CREATE TABLE `rating_table` (
  `id` int(11) NOT NULL,
  `doctor_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `rating` int(11) NOT NULL,
  `rating_comment` varchar(350) COLLATE utf8_unicode_ci DEFAULT NULL,
  `rating_like` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `rating_dislike` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `reference_photo` blob DEFAULT NULL,
  `create_date` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users_table`
--

CREATE TABLE `users_table` (
  `id` int(11) NOT NULL,
  `user_role_id` int(11) NOT NULL,
  `full_name` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `email_address` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(50) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `mobile` varchar(15) COLLATE utf8_unicode_ci DEFAULT NULL,
  `photo` blob DEFAULT NULL,
  `create_date` datetime DEFAULT current_timestamp(),
  `update_date` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `user_point_table`
--

CREATE TABLE `user_point_table` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `current_point` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `used_point` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `total_point` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `comment` int(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `user_role`
--

CREATE TABLE `user_role` (
  `id` int(11) NOT NULL,
  `role_type` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `create_date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `department_table`
--
ALTER TABLE `department_table`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `doctor_hp_serial_numbers`
--
ALTER TABLE `doctor_hp_serial_numbers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `doctor_id` (`doctor_id`);

--
-- Indexes for table `doctor_table`
--
ALTER TABLE `doctor_table`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `department_id` (`department_id`);

--
-- Indexes for table `feedback_reply`
--
ALTER TABLE `feedback_reply`
  ADD PRIMARY KEY (`id`),
  ADD KEY `feedback_id` (`feedback_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `feedbac_table`
--
ALTER TABLE `feedbac_table`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `rating_reply`
--
ALTER TABLE `rating_reply`
  ADD PRIMARY KEY (`id`),
  ADD KEY `rating_id` (`rating_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `rating_table`
--
ALTER TABLE `rating_table`
  ADD PRIMARY KEY (`id`),
  ADD KEY `doctor_id` (`doctor_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `users_table`
--
ALTER TABLE `users_table`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email_address` (`email_address`),
  ADD KEY `user_role_id` (`user_role_id`);

--
-- Indexes for table `user_point_table`
--
ALTER TABLE `user_point_table`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `user_role`
--
ALTER TABLE `user_role`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `department_table`
--
ALTER TABLE `department_table`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `doctor_hp_serial_numbers`
--
ALTER TABLE `doctor_hp_serial_numbers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `doctor_table`
--
ALTER TABLE `doctor_table`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `feedback_reply`
--
ALTER TABLE `feedback_reply`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `feedbac_table`
--
ALTER TABLE `feedbac_table`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `rating_reply`
--
ALTER TABLE `rating_reply`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `rating_table`
--
ALTER TABLE `rating_table`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users_table`
--
ALTER TABLE `users_table`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user_point_table`
--
ALTER TABLE `user_point_table`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user_role`
--
ALTER TABLE `user_role`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `doctor_hp_serial_numbers`
--
ALTER TABLE `doctor_hp_serial_numbers`
  ADD CONSTRAINT `doctor_hp_serial_numbers_ibfk_1` FOREIGN KEY (`doctor_id`) REFERENCES `doctor_table` (`id`);

--
-- Constraints for table `doctor_table`
--
ALTER TABLE `doctor_table`
  ADD CONSTRAINT `doctor_table_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users_table` (`id`),
  ADD CONSTRAINT `doctor_table_ibfk_2` FOREIGN KEY (`department_id`) REFERENCES `department_table` (`id`);

--
-- Constraints for table `feedback_reply`
--
ALTER TABLE `feedback_reply`
  ADD CONSTRAINT `feedback_reply_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users_table` (`id`),
  ADD CONSTRAINT `feedback_reply_ibfk_2` FOREIGN KEY (`feedback_id`) REFERENCES `feedbac_table` (`id`);

--
-- Constraints for table `feedbac_table`
--
ALTER TABLE `feedbac_table`
  ADD CONSTRAINT `feedbac_table_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users_table` (`id`);

--
-- Constraints for table `rating_reply`
--
ALTER TABLE `rating_reply`
  ADD CONSTRAINT `rating_reply_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users_table` (`id`),
  ADD CONSTRAINT `rating_reply_ibfk_2` FOREIGN KEY (`rating_id`) REFERENCES `rating_table` (`id`);

--
-- Constraints for table `rating_table`
--
ALTER TABLE `rating_table`
  ADD CONSTRAINT `rating_table_ibfk_1` FOREIGN KEY (`doctor_id`) REFERENCES `doctor_table` (`id`),
  ADD CONSTRAINT `rating_table_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users_table` (`id`);

--
-- Constraints for table `users_table`
--
ALTER TABLE `users_table`
  ADD CONSTRAINT `users_table_ibfk_1` FOREIGN KEY (`user_role_id`) REFERENCES `user_role` (`id`);

--
-- Constraints for table `user_point_table`
--
ALTER TABLE `user_point_table`
  ADD CONSTRAINT `user_point_table_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users_table` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
