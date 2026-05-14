-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 14, 2026 at 07:48 AM
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
-- Database: `event_backup`
--

-- --------------------------------------------------------

--
-- Table structure for table `department`
--

CREATE TABLE `department` (
  `department_id` int(11) NOT NULL,
  `department_name` varchar(255) DEFAULT NULL,
  `department_logo` varchar(255) DEFAULT NULL,
  `status` enum('active','inactive') NOT NULL DEFAULT 'active'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `department`
--

INSERT INTO `department` (`department_id`, `department_name`, `department_logo`, `status`) VALUES
(10, 'Department of Information Technology - College of Computing Studies', 'dept_69f7384c0bef06.47169091.svg', 'active'),
(11, 'Department of Computer Science - College of Computing Studies', '5.svg', 'active'),
(13, 'Department of Accountancy - College of Business and Management', '3.svg', 'active'),
(14, 'Department of Civil Engineering - College of Engineering', '2.svg', 'active'),
(15, 'Department of Psychology - College of Arts and Sciences', '5.svg', 'active'),
(21, 'Department of Digital Innovation and Cyber Systems', 'dept_69f76faa8a04c6.06693127.svg', 'inactive'),
(23, 'CSS', 'dept_69feabe795c972.35790806.png', 'active');

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

CREATE TABLE `events` (
  `event_id` int(11) NOT NULL,
  `org_id` int(11) DEFAULT NULL,
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
  `status` enum('open','closed','ongoing','finished','cancelled','rescheduled') DEFAULT 'open',
  `event_bg_picture` text DEFAULT NULL,
  `approval_status` enum('approved','rejected','pending','for_reschedule') DEFAULT 'pending',
  `created_at` datetime DEFAULT current_timestamp(),
  `restrictions` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`restrictions`))
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `events`
--

INSERT INTO `events` (`event_id`, `org_id`, `event_name`, `description`, `location`, `start_date`, `end_date`, `start_time`, `end_time`, `registration_deadline`, `capacity`, `slot_taken`, `status`, `event_bg_picture`, `approval_status`, `created_at`, `restrictions`) VALUES
(3020, 1014, 'Tech Innovators Summit 2026', 'Tech Innovators Summit 2026 is an event focused on software development, cybersecurity, artificial intelligence, UI/UX design, and startup innovation. The event includes workshops, coding competitions, startup pitching, sponsor booths, and networking sessions with industry professionals.', 'UKE Main Auditorium', '2026-05-22', '2026-05-22', '07:00:00', '16:00:00', '2026-05-14 22:00:00', 30, 1, 'open', 'event_6a042fbb9e28b8.09129535.jpg', 'approved', '2026-05-13 16:00:59', '{\"year_level\":[\"Alumni\"],\"programs\":[\"21\",\"22\",\"23\",\"29\"]}'),
(3021, 1015, 'AWS CLUB ORIENTATION', 'lorem ipsum lorem ipsum lorem ipsum lorem ipsum lorem ipsum', 'UKE Main Auditorium', '2026-05-20', '2026-05-20', '07:09:00', '20:10:00', '2026-05-17 19:10:00', 30, 1, 'open', 'event_6a055968c5a482.42151253.jpg', 'approved', '2026-05-14 13:11:04', '{\"year_level\":[\"1st\",\"Irregular\"],\"programs\":[\"24\",\"25\",\"26\",\"27\"]}');

-- --------------------------------------------------------

--
-- Table structure for table `feedbacks`
--

CREATE TABLE `feedbacks` (
  `feedback_id` int(11) NOT NULL,
  `event_id` int(11) DEFAULT NULL,
  `users_id` int(11) DEFAULT NULL,
  `feedback_star` int(11) DEFAULT NULL,
  `feedback_comment` text DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `organizations`
--

CREATE TABLE `organizations` (
  `org_id` int(11) NOT NULL,
  `department_id` int(11) DEFAULT NULL,
  `org_name` varchar(255) DEFAULT NULL,
  `org_email` varchar(50) DEFAULT NULL,
  `org_contact_no` varchar(50) DEFAULT NULL,
  `org_username` varchar(50) DEFAULT NULL,
  `org_password` varchar(255) DEFAULT NULL,
  `org_logo` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `status` enum('active','deactivated') DEFAULT 'active'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `organizations`
--

INSERT INTO `organizations` (`org_id`, `department_id`, `org_name`, `org_email`, `org_contact_no`, `org_username`, `org_password`, `org_logo`, `created_at`, `status`) VALUES
(1014, 23, 'Computer Society Club', 'adote.ronadrian.molleda@gmail.com', '09703416914', 'computer123', '$2y$10$UxgzBDBOSc7CNRAHLZMZie0oRAulgzOn0841.LTNAHr90CZ0q1YRS', '1778659050_Tech Gadgets.jpg', '2026-05-13 07:57:30', 'active'),
(1015, 23, 'AWS University of Kristian Evangelion', 'rondrianmadote@gmail.com', '09480895211', 'aws123', '$2y$10$8qTWWG5wl7NDaMSB.hx2.OtFLs50IURJ3qNNkMF4yLnw/z4WSxXUq', '1778735205_society.jpg', '2026-05-14 05:06:45', 'active');

-- --------------------------------------------------------

--
-- Table structure for table `packages`
--

CREATE TABLE `packages` (
  `package_id` int(11) NOT NULL,
  `sponsor_id` int(11) DEFAULT NULL,
  `package_name` text DEFAULT NULL,
  `description` text DEFAULT NULL,
  `benefits` text DEFAULT NULL,
  `package_bg` text DEFAULT NULL,
  `status` enum('ongoing','onhold') DEFAULT 'ongoing',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `approval_status` enum('pending','approved','rejected','completed') DEFAULT 'pending',
  `event_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `packages`
--

INSERT INTO `packages` (`package_id`, `sponsor_id`, `package_name`, `description`, `benefits`, `package_bg`, `status`, `created_at`, `approval_status`, `event_id`) VALUES
(14, 6003, 'Acme Corp Sponsorship Package', 'Acme Corp is a beauty and wellness company specializing in professional facial treatments, advanced skincare solutions, and non-invasive aesthetic services. The company focuses on helping clients achieve healthier and more radiant skin through personalized consultations, modern treatment technologies, and high-quality skincare products.', '[\"Deep Cleansing Facial\",\"Acne Treatment Therapy\",\"Hydration & Glow Facial\",\"Skincare Consultation\"]', 'pkg_6a04396b9be254.36018160.jpg', 'ongoing', '2026-05-13 08:42:19', 'approved', 3020),
(15, 6003, 'Acme Call me Kevin', 'Acme is a big company', '[\"Free Massage\",\"Free Zus Coffee\",\"Free Food\"]', 'pkg_6a055ab95400a5.86075749.jpg', 'ongoing', '2026-05-14 05:16:41', 'approved', 3021);

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
  `event_id` int(11) DEFAULT NULL,
  `users_id` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `responses`
--

INSERT INTO `responses` (`response_id`, `event_id`, `users_id`, `created_at`) VALUES
(3032, 3020, 20200, '2026-05-13 17:55:54'),
(3034, 3021, 20200, '2026-05-14 05:44:56');

-- --------------------------------------------------------

--
-- Table structure for table `sponsorships`
--

CREATE TABLE `sponsorships` (
  `sponsor_id` int(11) NOT NULL,
  `sponsor_logo` text DEFAULT NULL,
  `sponsor_email` varchar(255) DEFAULT NULL,
  `sponsor_contact_no` varchar(100) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `username` text DEFAULT NULL,
  `password` text DEFAULT NULL,
  `company_name` text DEFAULT NULL,
  `company_address` text DEFAULT NULL,
  `status` enum('activated','deactivated') DEFAULT 'activated'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sponsorships`
--

INSERT INTO `sponsorships` (`sponsor_id`, `sponsor_logo`, `sponsor_email`, `sponsor_contact_no`, `created_at`, `username`, `password`, `company_name`, `company_address`, `status`) VALUES
(6003, 'sponsor_6003_1778661571.jpg', 'adote.ronadrian.molleda@gmail.com', '09703416914', '2026-05-13 08:39:31', 'acme123', '$2y$10$HSHt9ixgMNSHIcrUNEIaJ.CGy4xhxAVazKnQvKuv5.TlwYYdHmVNO', 'Acme Corp', '18th Floor, Orion Business Center, Commonwealth Avenue, Quezon City, Metro Manila, Philippines', 'activated');

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
  `profile_pic` text DEFAULT NULL,
  `last_logged` date DEFAULT NULL,
  `status` enum('active','inactive') DEFAULT 'active',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `password_hashed` varchar(50) DEFAULT NULL,
  `year_level` enum('1st','2nd','3rd','4th','Alumni','Irregular') DEFAULT NULL,
  `program_id` int(11) DEFAULT NULL,
  `contact_no` varchar(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`users_id`, `role`, `first_name`, `last_name`, `middle_name`, `email`, `profile_pic`, `last_logged`, `status`, `created_at`, `password_hashed`, `year_level`, `program_id`, `contact_no`) VALUES
(20200, 'client', 'Roger', 'Lance', NULL, 'adote.ronadrian.molleda@gmail.com', 'user_20200_1778609836.jpg', NULL, 'active', '2026-05-14 05:44:19', 'null123', '2nd', 30, '09703416914'),
(20202, 'client', 'John', 'Client', 'A.', 'adote.ronadrian.molleda@gmail.com', NULL, '2026-03-26', 'active', '2026-05-11 10:34:59', 'password123', NULL, NULL, '09703416914'),
(20203, 'client', 'Anna', 'Reyes', 'C.', 'adote.ronadrian.molleda@gmail.com', NULL, '2026-03-20', 'active', '2026-05-11 10:34:59', 'password123', 'Irregular', 21, '09703416914'),
(20204, 'admin', 'Kevin', 'Lopez', 'R.', 'adote.ronadrian.molleda@gmail.com', 'users_20204_1778735272.jpg', '2026-03-27', 'active', '2026-05-14 05:07:52', 'letmein', '2nd', 22, '09703416914'),
(30001, 'client', 'Lisa', 'Garcia', 'M', 'adote.ronadrian.molleda@gmail.com', NULL, '2026-04-21', 'active', '2026-05-11 10:34:59', 'password123', '2nd', 24, '09703416914'),
(30002, 'client', 'Kevin', 'Cruz', 'B', 'adote.ronadrian.molleda@gmail.com', NULL, '2026-04-13', 'active', '2026-05-13 03:52:38', 'password123', '', 22, '09703416914'),
(30003, 'client', 'Anna', 'Reyes', 'M', 'adote.ronadrian.molleda@gmail.com', NULL, '2026-04-22', 'active', '2026-05-11 10:34:59', 'password123', '2nd', 27, '09703416914'),
(30004, 'client', 'John', 'Santos', 'C', 'adote.ronadrian.molleda@gmail.com', NULL, '2026-04-24', 'active', '2026-05-13 03:52:38', 'password123', '1st', 23, '09703416914'),
(30005, 'client', 'Anna', 'Santos', 'L', 'adote.ronadrian.molleda@gmail.com', NULL, '2026-04-06', 'active', '2026-05-13 03:52:38', 'password123', '', 26, '09703416914'),
(30006, 'client', 'John', 'Lopez', 'T', 'adote.ronadrian.molleda@gmail.com', NULL, '2026-04-03', 'active', '2026-05-13 03:52:38', 'password123', '2nd', 28, '09703416914'),
(30007, 'client', 'Kevin', 'Lopez', 'C', 'adote.ronadrian.molleda@gmail.com', NULL, '2026-04-09', 'active', '2026-05-13 03:52:38', 'password123', '', 27, '09703416914'),
(30008, 'client', 'Kevin', 'Garcia', 'O', 'adote.ronadrian.molleda@gmail.com', NULL, '2026-04-04', 'active', '2026-05-13 03:52:38', 'password123', '', 28, '09703416914'),
(30009, 'client', 'Lisa', 'Santos', 'E', 'adote.ronadrian.molleda@gmail.com', NULL, '2026-04-15', 'active', '2026-05-13 03:52:38', 'password123', '2nd', 22, '09703416914'),
(30010, 'client', 'Mark', 'Santos', 'E', 'adote.ronadrian.molleda@gmail.com', NULL, '2026-04-20', 'active', '2026-05-13 03:52:38', 'password123', '', 28, '09703416914'),
(30011, 'client', 'Anna', 'Cruz', 'I', 'adote.ronadrian.molleda@gmail.com', NULL, '2026-04-24', 'active', '2026-05-13 03:52:38', 'password123', '2nd', 27, '09703416914'),
(30012, 'client', 'Lisa', 'Lopez', 'O', 'adote.ronadrian.molleda@gmail.com', NULL, '2026-04-03', 'active', '2026-05-11 10:34:59', 'password123', '1st', 21, '09703416914'),
(30013, 'client', 'Anna', 'Cruz', 'M', 'adote.ronadrian.molleda@gmail.com', NULL, '2026-03-31', 'active', '2026-05-13 03:52:38', 'password123', '', 23, '09703416914'),
(30014, 'client', 'Anna', 'Cruz', 'E', 'adote.ronadrian.molleda@gmail.com', NULL, '2026-03-30', 'active', '2026-05-13 03:52:38', 'password123', '', 21, '09703416914'),
(30015, 'client', 'Lisa', 'Garcia', 'N', 'adote.ronadrian.molleda@gmail.com', NULL, '2026-04-13', 'active', '2026-05-13 03:52:38', 'password123', '', 24, '09703416914'),
(30016, 'client', 'Kevin', 'Cruz', 'I', 'adote.ronadrian.molleda@gmail.com', NULL, '2026-04-06', 'active', '2026-05-11 10:34:59', 'password123', '2nd', 28, '09703416914'),
(30017, 'client', 'Kevin', 'Lopez', 'V', 'adote.ronadrian.molleda@gmail.com', NULL, '2026-03-27', 'active', '2026-05-13 03:52:38', 'password123', '', 26, '09703416914'),
(30019, 'client', 'Mark', 'Lopez', 'I', 'adote.ronadrian.molleda@gmail.com', NULL, '2026-04-03', 'active', '2026-05-13 03:52:38', 'password123', '', 23, '09703416914'),
(30020, 'client', 'Anna', 'Cruz', 'M', 'adote.ronadrian.molleda@gmail.com', NULL, '2026-04-01', 'active', '2026-05-11 10:34:59', 'password123', '', 24, '09703416914'),
(30021, 'client', 'John', 'Reyes', 'I', 'adote.ronadrian.molleda@gmail.com', NULL, '2026-04-14', 'active', '2026-05-11 10:34:59', 'password123', '1st', 29, '09703416914'),
(30022, 'client', 'Lisa', 'Cruz', 'S', 'adote.ronadrian.molleda@gmail.com', NULL, '2026-04-10', 'active', '2026-05-11 10:34:59', 'password123', '', 27, '09703416914'),
(30023, 'client', 'Kevin', 'Garcia', 'M', 'adote.ronadrian.molleda@gmail.com', NULL, '2026-04-13', 'active', '2026-05-13 03:52:38', 'password123', '', 29, '09703416914'),
(30024, 'client', 'Anna', 'Garcia', 'Y', 'adote.ronadrian.molleda@gmail.com', NULL, '2026-04-13', 'active', '2026-05-13 03:52:38', 'password123', '1st', 28, '09703416914'),
(30025, 'client', 'Lisa', 'Lopez', 'W', 'adote.ronadrian.molleda@gmail.com', NULL, '2026-04-10', 'active', '2026-05-11 10:34:59', 'password123', '1st', 21, '09703416914'),
(30026, 'client', 'Anna', 'Garcia', 'T', 'adote.ronadrian.molleda@gmail.com', NULL, '2026-04-13', 'active', '2026-05-13 03:52:38', 'password123', '', 23, '09703416914'),
(30027, 'client', 'John', 'Cruz', 'O', 'adote.ronadrian.molleda@gmail.com', NULL, '2026-04-15', 'active', '2026-05-11 10:34:59', 'password123', '1st', 22, '09703416914'),
(30028, 'client', 'Kevin', 'Santos', 'F', 'adote.ronadrian.molleda@gmail.com', NULL, '2026-03-31', 'active', '2026-05-11 10:34:59', 'password123', '', 24, '09703416914'),
(30029, 'client', 'John', 'Santos', 'B', 'adote.ronadrian.molleda@gmail.com', NULL, '2026-04-02', 'active', '2026-05-11 10:34:59', 'password123', '', 29, '09703416914'),
(30030, 'client', 'Anna', 'Reyes', 'C', 'adote.ronadrian.molleda@gmail.com', NULL, '2026-04-16', 'active', '2026-05-13 03:52:38', 'password123', '', 22, '09703416914');

--
-- Indexes for dumped tables
--

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
  ADD KEY `events_ibfk_orgID` (`org_id`);

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
  ADD KEY `organizations_ibfk_deptID` (`department_id`);

--
-- Indexes for table `packages`
--
ALTER TABLE `packages`
  ADD PRIMARY KEY (`package_id`),
  ADD KEY `fk_sponsor_id` (`sponsor_id`),
  ADD KEY `fk_event_id` (`event_id`);

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
-- AUTO_INCREMENT for table `department`
--
ALTER TABLE `department`
  MODIFY `department_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `events`
--
ALTER TABLE `events`
  MODIFY `event_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3022;

--
-- AUTO_INCREMENT for table `feedbacks`
--
ALTER TABLE `feedbacks`
  MODIFY `feedback_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `organizations`
--
ALTER TABLE `organizations`
  MODIFY `org_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1016;

--
-- AUTO_INCREMENT for table `packages`
--
ALTER TABLE `packages`
  MODIFY `package_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `programs`
--
ALTER TABLE `programs`
  MODIFY `program_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `responses`
--
ALTER TABLE `responses`
  MODIFY `response_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3035;

--
-- AUTO_INCREMENT for table `sponsorships`
--
ALTER TABLE `sponsorships`
  MODIFY `sponsor_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6004;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `events`
--
ALTER TABLE `events`
  ADD CONSTRAINT `events_ibfk_1` FOREIGN KEY (`org_id`) REFERENCES `organizations` (`org_id`) ON DELETE CASCADE ON UPDATE CASCADE;

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
  ADD CONSTRAINT `organizations_ibfk_2` FOREIGN KEY (`department_id`) REFERENCES `department` (`department_id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `packages`
--
ALTER TABLE `packages`
  ADD CONSTRAINT `packages_ibfk_1` FOREIGN KEY (`sponsor_id`) REFERENCES `sponsorships` (`sponsor_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `packages_ibfk_2` FOREIGN KEY (`event_id`) REFERENCES `events` (`event_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `responses`
--
ALTER TABLE `responses`
  ADD CONSTRAINT `responses_ibfk_1` FOREIGN KEY (`users_id`) REFERENCES `users` (`users_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `responses_ibfk_eventID` FOREIGN KEY (`event_id`) REFERENCES `events` (`event_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`program_id`) REFERENCES `programs` (`program_id`) ON DELETE SET NULL ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
