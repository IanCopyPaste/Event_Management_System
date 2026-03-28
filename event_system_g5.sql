-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 28, 2026 at 03:34 PM
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
-- Database: `event_system_g5`
--

-- --------------------------------------------------------

--
-- Table structure for table `advertisement`
--

CREATE TABLE `advertisement` (
  `adverstisement_id` int(11) NOT NULL,
  `event_id` int(11) DEFAULT NULL,
  `sponsor_id` int(11) DEFAULT NULL,
  `status` enum('pending','approved','rejected') DEFAULT 'pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `department`
--

CREATE TABLE `department` (
  `department_id` int(11) NOT NULL,
  `department_name` varchar(255) DEFAULT NULL,
  `department_logo` mediumblob DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

CREATE TABLE `events` (
  `event_id` int(11) NOT NULL,
  `org_id` int(11) DEFAULT NULL,
  `advertisement_id` int(11) DEFAULT NULL,
  `event_name` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `location` varchar(255) DEFAULT NULL,
  `start_date` date DEFAULT NULL,
  `end_date` date DEFAULT NULL,
  `start_time` time DEFAULT NULL,
  `end_time` time DEFAULT NULL,
  `registration_deadline` datetime DEFAULT NULL,
  `capacity` int(11) DEFAULT NULL,
  `slot_taken` int(11) DEFAULT NULL,
  `status` enum('closed','open','ongoing''finished') DEFAULT 'closed',
  `event_bg_picture` mediumblob DEFAULT NULL,
  `approval_status` enum('pending','approval','rejected') DEFAULT NULL,
  `created_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `feedbacks`
--

CREATE TABLE `feedbacks` (
  `feedback_id` int(11) NOT NULL,
  `event_id` int(11) DEFAULT NULL,
  `users_id` int(11) DEFAULT NULL,
  `feedback_value` int(11) DEFAULT NULL,
  `feedback_description` longtext DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `forms`
--

CREATE TABLE `forms` (
  `form_id` int(11) NOT NULL,
  `event_id` int(11) DEFAULT NULL,
  `form_json_id` varchar(50) DEFAULT NULL,
  `title` text DEFAULT NULL,
  `description` longtext DEFAULT NULL,
  `form_json_data` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`form_json_data`)),
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `org_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `organizations`
--

CREATE TABLE `organizations` (
  `org_id` int(11) NOT NULL,
  `users_id` int(11) DEFAULT NULL,
  `department_id` int(11) DEFAULT NULL,
  `org_name` varchar(255) DEFAULT NULL,
  `org_email` varchar(50) DEFAULT NULL,
  `org_contact_no` varchar(50) DEFAULT NULL,
  `org_username` varchar(50) DEFAULT NULL,
  `org_password` varchar(50) DEFAULT NULL,
  `org_logo` mediumblob DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `org_application`
--

CREATE TABLE `org_application` (
  `org_apply_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `department_id` int(11) DEFAULT NULL,
  `org_name` varchar(100) DEFAULT NULL,
  `org_email` varchar(100) DEFAULT NULL,
  `org_contact_no` text DEFAULT NULL,
  `org_username` varchar(100) DEFAULT NULL,
  `org_password` varchar(255) DEFAULT NULL,
  `status` enum('pending','approved','rejected') DEFAULT 'pending',
  `additional_files` mediumblob DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `responses`
--

CREATE TABLE `responses` (
  `response_id` int(11) NOT NULL,
  `form_id` int(11) DEFAULT NULL,
  `event_id` int(11) DEFAULT NULL,
  `users_id` int(11) DEFAULT NULL,
  `form_json_id` varchar(255) DEFAULT NULL,
  `form_json_data` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`form_json_data`)),
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sponsorships`
--

CREATE TABLE `sponsorships` (
  `sponsor_id` int(11) NOT NULL,
  `sponsor_name` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `sponsor_logo` mediumblob DEFAULT NULL,
  `ad_link` text DEFAULT NULL,
  `sponsor_email` varchar(255) DEFAULT NULL,
  `sponsor_contact_no` varchar(100) DEFAULT NULL,
  `additional_documents` mediumblob DEFAULT NULL,
  `status` enum('pending','approved','rejected') DEFAULT 'pending',
  `created_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `users_id` int(11) NOT NULL,
  `role` enum('admin','client') DEFAULT NULL,
  `first_name` varchar(255) DEFAULT NULL,
  `last_name` varchar(255) DEFAULT NULL,
  `middle_name` varchar(255) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `profile_pic` mediumblob DEFAULT NULL,
  `last_logged` date DEFAULT NULL,
  `status` enum('active','inactive') DEFAULT 'active',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `password_hashed` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`users_id`, `role`, `first_name`, `last_name`, `middle_name`, `email`, `profile_pic`, `last_logged`, `status`, `created_at`, `password_hashed`) VALUES
(20200, 'admin', 'Ronald', 'Santos', 'M.', 'ronald.santos@example.com', NULL, '2026-03-28', 'active', '2026-03-28 12:21:51', 'password123'),
(20201, 'client', 'Maria', 'Garcia', 'L.', 'maria.garcia@example.com', NULL, '2026-03-25', 'active', '2026-03-28 12:21:51', '123456'),
(20202, 'client', 'John', 'Doe', 'A.', 'john.doe@example.com', NULL, '2026-03-26', 'inactive', '2026-03-28 12:21:51', 'testpass'),
(20203, 'client', 'Anna', 'Reyes', 'C.', 'anna.reyes@example.com', NULL, '2026-03-20', 'active', '2026-03-28 12:21:51', 'mypassword'),
(20204, 'admin', 'Kevin', 'Lopez', 'R.', 'kevin.lopez@example.com', NULL, '2026-03-27', 'active', '2026-03-28 12:21:51', 'letmein');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `advertisement`
--
ALTER TABLE `advertisement`
  ADD PRIMARY KEY (`adverstisement_id`),
  ADD KEY `event_id` (`event_id`),
  ADD KEY `sponsor_id` (`sponsor_id`);

--
-- Indexes for table `department`
--
ALTER TABLE `department`
  ADD PRIMARY KEY (`department_id`);

--
-- Indexes for table `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`event_id`),
  ADD KEY `events_ibfk_orgID` (`org_id`),
  ADD KEY `events_ibfk_adID` (`advertisement_id`);

--
-- Indexes for table `feedbacks`
--
ALTER TABLE `feedbacks`
  ADD PRIMARY KEY (`feedback_id`),
  ADD KEY `event_id` (`event_id`),
  ADD KEY `users_id` (`users_id`);

--
-- Indexes for table `forms`
--
ALTER TABLE `forms`
  ADD PRIMARY KEY (`form_id`),
  ADD KEY `forms_ibfk_eventID` (`event_id`),
  ADD KEY `org_id` (`org_id`);

--
-- Indexes for table `organizations`
--
ALTER TABLE `organizations`
  ADD PRIMARY KEY (`org_id`),
  ADD KEY `organizations_ibfk_usersID` (`users_id`),
  ADD KEY `organizations_ibfk_deptID` (`department_id`);

--
-- Indexes for table `org_application`
--
ALTER TABLE `org_application`
  ADD PRIMARY KEY (`org_apply_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `department_id` (`department_id`);

--
-- Indexes for table `responses`
--
ALTER TABLE `responses`
  ADD PRIMARY KEY (`response_id`),
  ADD KEY `responses_ibfk_eventID` (`event_id`),
  ADD KEY `responses_ibfk_formID` (`form_id`),
  ADD KEY `users_id` (`users_id`);

--
-- Indexes for table `sponsorships`
--
ALTER TABLE `sponsorships`
  ADD PRIMARY KEY (`sponsor_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`users_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `advertisement`
--
ALTER TABLE `advertisement`
  MODIFY `adverstisement_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `events`
--
ALTER TABLE `events`
  MODIFY `event_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3000;

--
-- AUTO_INCREMENT for table `forms`
--
ALTER TABLE `forms`
  MODIFY `form_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2000;

--
-- AUTO_INCREMENT for table `org_application`
--
ALTER TABLE `org_application`
  MODIFY `org_apply_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1000;

--
-- AUTO_INCREMENT for table `responses`
--
ALTER TABLE `responses`
  MODIFY `response_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3000;

--
-- AUTO_INCREMENT for table `sponsorships`
--
ALTER TABLE `sponsorships`
  MODIFY `sponsor_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6000;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `advertisement`
--
ALTER TABLE `advertisement`
  ADD CONSTRAINT `advertisement_ibfk_1` FOREIGN KEY (`event_id`) REFERENCES `events` (`event_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `advertisement_ibfk_2` FOREIGN KEY (`sponsor_id`) REFERENCES `sponsorships` (`sponsor_id`) ON DELETE CASCADE;

--
-- Constraints for table `events`
--
ALTER TABLE `events`
  ADD CONSTRAINT `events_ibfk_adID` FOREIGN KEY (`advertisement_id`) REFERENCES `advertisement` (`adverstisement_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `events_ibfk_orgID` FOREIGN KEY (`org_id`) REFERENCES `organizations` (`org_id`) ON DELETE CASCADE;

--
-- Constraints for table `feedbacks`
--
ALTER TABLE `feedbacks`
  ADD CONSTRAINT `feedbacks_ibfk_1` FOREIGN KEY (`event_id`) REFERENCES `events` (`event_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `feedbacks_ibfk_2` FOREIGN KEY (`users_id`) REFERENCES `users` (`users_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `forms`
--
ALTER TABLE `forms`
  ADD CONSTRAINT `forms_ibfk_1` FOREIGN KEY (`org_id`) REFERENCES `organizations` (`org_id`),
  ADD CONSTRAINT `forms_ibfk_eventID` FOREIGN KEY (`event_id`) REFERENCES `events` (`event_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `forms_ibfk_orgID` FOREIGN KEY (`org_id`) REFERENCES `organizations` (`org_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `organizations`
--
ALTER TABLE `organizations`
  ADD CONSTRAINT `organizations_ibfk_deptID` FOREIGN KEY (`department_id`) REFERENCES `department` (`department_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `organizations_ibfk_usersID` FOREIGN KEY (`users_id`) REFERENCES `users` (`users_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `org_application`
--
ALTER TABLE `org_application`
  ADD CONSTRAINT `org_application_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`users_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `org_application_ibfk_2` FOREIGN KEY (`department_id`) REFERENCES `department` (`department_id`) ON DELETE CASCADE;

--
-- Constraints for table `responses`
--
ALTER TABLE `responses`
  ADD CONSTRAINT `responses_ibfk_1` FOREIGN KEY (`users_id`) REFERENCES `users` (`users_id`),
  ADD CONSTRAINT `responses_ibfk_eventID` FOREIGN KEY (`event_id`) REFERENCES `events` (`event_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `responses_ibfk_formID` FOREIGN KEY (`form_id`) REFERENCES `forms` (`form_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
