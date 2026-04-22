-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 22, 2026 at 05:36 PM
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
  `department_logo` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `department`
--

INSERT INTO `department` (`department_id`, `department_name`, `department_logo`) VALUES
(1, 'College of Computer Studies', NULL),
(10, 'Department of Information Technology - College of Computing Studies', NULL),
(11, 'Department of Computer Science - College of Computing Studies', NULL),
(12, 'Department of Business Administration - College of Business and Management', NULL),
(13, 'Department of Accountancy - College of Business and Management', NULL),
(14, 'Department of Civil Engineering - College of Engineering', NULL),
(15, 'Department of Psychology - College of Arts and Sciences', NULL);

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
  `slot_taken` int(11) DEFAULT 0,
  `status` enum('closed','open','ongoing''finished') DEFAULT 'open',
  `event_bg_picture` text DEFAULT NULL,
  `approval_status` enum('pending','rejected','approved') DEFAULT 'pending',
  `created_at` datetime DEFAULT current_timestamp(),
  `restrictions` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`restrictions`))
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `events`
--

INSERT INTO `events` (`event_id`, `org_id`, `advertisement_id`, `event_name`, `description`, `location`, `start_date`, `end_date`, `start_time`, `end_time`, `registration_deadline`, `capacity`, `slot_taken`, `status`, `event_bg_picture`, `approval_status`, `created_at`, `restrictions`) VALUES
(3005, 1006, NULL, 'wsada', 'dsadasd', 'asdads', '2026-04-01', '2026-04-09', '20:14:00', '17:17:00', '2026-04-09 17:19:00', 123, 0, 'open', NULL, 'approved', '2026-04-20 17:15:13', '{\"year_level\":[\"1st\",\"3rd\",\"4th\"],\"programs\":[\"21\",\"24\",\"30\"]}'),
(3011, 1006, NULL, 'sdadsa', 'dasdasd', '123', '2026-04-03', '2026-04-02', '17:25:00', '19:27:00', '2026-04-23 21:23:00', 123, 0, '', NULL, 'approved', '2026-04-20 17:23:56', '{\"year_level\":[\"Alumni\"],\"programs\":[\"24\"]}');

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
  `org_password` varchar(255) DEFAULT NULL,
  `org_logo` mediumblob DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `status` enum('active','deactivated') DEFAULT 'active'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `organizations`
--

INSERT INTO `organizations` (`org_id`, `users_id`, `department_id`, `org_name`, `org_email`, `org_contact_no`, `org_username`, `org_password`, `org_logo`, `created_at`, `status`) VALUES
(1000, 20203, 10, 'THE KOLOKOY CLUB', 'kolokoyClub@gmail.com', '122', 'ian', 'ian', NULL, '2026-04-22 06:08:45', 'active'),
(1003, 20202, 11, 'THE KOLOKOY CLUB', 'velasco.ezekieljohn.javellana@gmail.com', '123', '123', '$2y$10$9fuIQT/3ARAr4uxIgkuz5OYhOvReERrK2k01n3UcLJi', NULL, '2026-04-14 05:13:46', 'active'),
(1006, 20200, 10, 'THE MONKEY CLUB', 'adote.ronadrian.molleda@gmail.com', '09199883537', 'banana', '$2y$10$A./wRYVzEjleCgYvwGIzQO8XCLgmg23y9.cHe.wTvNzgUNiKDnwxm', NULL, '2026-04-22 05:56:16', 'deactivated');

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
  `additional_files` varchar(255) DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `org_application`
--

INSERT INTO `org_application` (`org_apply_id`, `user_id`, `department_id`, `org_name`, `org_email`, `org_contact_no`, `org_username`, `org_password`, `status`, `additional_files`, `created_at`) VALUES
(1, 20200, 11, 'tbs genggeng', 'samonte.psalmamiel.tosoc@gmail.com', '09123456789', 'kolokoyKame', '$2y$10$HioSqCXfRumXPFdHT8tK2eJrNHMkpjJNtVpL0AwqGwumji/X7352y', 'rejected', 'pedo.pdf', '2026-04-10 04:39:33'),
(16, 20203, 10, 'THE KOLOKOY CLUB', 'esteban.jamesbenedict.mabbayad.12@gmail.com', '122', '123', '$2y$10$qsSZ.s4k6FK3BHVmRl4FBuhV6sL/VwiGTySQM74tG4Ui105xSPj4K', 'approved', 'file_69dd026f8197a8.34277366.jpg', '2026-04-13 16:49:19'),
(22, 20202, 11, 'THE KOLOKOY CLUB', 'adote.ronadrian.molleda@gmail.com', '123', '123', '$2y$10$9fuIQT/3ARAr4uxIgkuz5OYhOvReERrK2k01n3UcLJiy.7mY/W796', 'rejected', NULL, '2026-04-14 13:13:46'),
(24, 20200, 10, 'THE MONKEY CLUB', 'adote.ronadrian.molleda@gmail.com', '09199883537', 'banana', '$2y$10$A./wRYVzEjleCgYvwGIzQO8XCLgmg23y9.cHe.wTvNzgUNiKDnwxm', 'approved', NULL, '2026-04-19 09:19:19');

-- --------------------------------------------------------

--
-- Table structure for table `programs`
--

CREATE TABLE `programs` (
  `program_id` int(11) NOT NULL,
  `program_name` text DEFAULT NULL,
  `program_logo` text DEFAULT NULL,
  `prog_abv` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `programs`
--

INSERT INTO `programs` (`program_id`, `program_name`, `program_logo`, `prog_abv`) VALUES
(21, 'Bachelor of Science in Entrepreneurship', NULL, 'BSEntrep'),
(22, 'Bachelor of Science in Accountancy', NULL, 'BSA'),
(23, 'Bachelor of Science in Management Accounting', NULL, 'BSMA'),
(24, 'Bachelor of Science in Information Technology', NULL, 'BSIT'),
(25, 'Bachelor of Science in Information Systems', NULL, 'BSIS'),
(26, 'Bachelor of Science in Computer Science', NULL, 'BSCS'),
(27, 'Bachelor of Science in Computer Engineering', NULL, 'BSCpE'),
(28, 'Bachelor of Science in Electronics Engineering', NULL, 'BSECE'),
(29, 'Bachelor of Science in Industrial Engineering', NULL, 'BSIE'),
(30, 'Bachelor of Secondary Education', NULL, 'BSEd');

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
  `password_hashed` varchar(50) DEFAULT NULL,
  `year_level` enum('1st','2nd','3rd','4th') DEFAULT NULL,
  `program_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`users_id`, `role`, `first_name`, `last_name`, `middle_name`, `email`, `profile_pic`, `last_logged`, `status`, `created_at`, `password_hashed`, `year_level`, `program_id`) VALUES
(20200, NULL, NULL, NULL, NULL, 'adote.ronadrian.molleda@gmail.com', NULL, NULL, 'active', '2026-04-10 02:37:42', 'null123', NULL, NULL),
(20202, 'client', 'John', 'Client', 'A.', 'adote.ronadrian.molleda@gmail.com', NULL, '2026-03-26', 'active', '2026-04-13 14:28:53', 'testpass', NULL, NULL),
(20203, 'client', 'Anna', 'Reyes', 'C.', 'adote.ronadrian.molleda@gmail.com', NULL, '2026-03-20', 'active', '2026-04-13 14:28:53', 'mypassword', NULL, NULL),
(20204, 'admin', 'Kevin', 'Lopez', 'R.', 'adote.ronadrian.molleda@gmail.com', NULL, '2026-03-27', 'active', '2026-04-13 14:28:53', 'letmein', NULL, NULL);

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
-- Indexes for table `programs`
--
ALTER TABLE `programs`
  ADD PRIMARY KEY (`program_id`);

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
  ADD PRIMARY KEY (`users_id`),
  ADD KEY `program_id` (`program_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `advertisement`
--
ALTER TABLE `advertisement`
  MODIFY `adverstisement_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `department`
--
ALTER TABLE `department`
  MODIFY `department_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `events`
--
ALTER TABLE `events`
  MODIFY `event_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3012;

--
-- AUTO_INCREMENT for table `organizations`
--
ALTER TABLE `organizations`
  MODIFY `org_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1007;

--
-- AUTO_INCREMENT for table `org_application`
--
ALTER TABLE `org_application`
  MODIFY `org_apply_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `programs`
--
ALTER TABLE `programs`
  MODIFY `program_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

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
  ADD CONSTRAINT `responses_ibfk_eventID` FOREIGN KEY (`event_id`) REFERENCES `events` (`event_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`program_id`) REFERENCES `programs` (`program_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
