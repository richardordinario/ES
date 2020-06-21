-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 13, 2020 at 01:13 PM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `es`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `utype` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `fname` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lname` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mname` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `contact` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `utype`, `fname`, `lname`, `mname`, `contact`, `image`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Admin', 'Regina', 'Baracena', NULL, '09958013454', '693399176.jpg', 'Active', '2020-05-01 00:06:20', '2020-05-01 00:06:20'),
(2, 'Facilitator', 'Richard', 'Ordinario', NULL, '09267776670', '1345879207.jpg', 'Active', '2020-05-01 00:21:37', '2020-05-01 00:21:37'),
(6, 'Facilitator', 'Mark Christian', 'Mirador', '', '09269076915', '958646750.jpg', 'Deactive', '2020-05-03 18:46:36', '2020-05-03 18:50:50'),
(7, 'Facilitator', 'John Michael', 'Bonador', '', '09269076915', '1100572281.jpg', 'Deactive', '2020-05-04 16:49:33', '2020-05-04 16:49:33');

-- --------------------------------------------------------

--
-- Table structure for table `courses`
--

CREATE TABLE `courses` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `course_code` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `course_desc` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `courses`
--

INSERT INTO `courses` (`id`, `course_code`, `course_desc`, `created_at`, `updated_at`) VALUES
(1, 'BSCT', 'Bachelor Of Science In Computer Technology', '2020-05-01 01:45:43', '2020-05-01 01:45:43'),
(3, 'BSIT', 'Bachelor Of Science In Information Technology', '2020-05-01 01:57:26', '2020-05-02 23:31:39'),
(5, 'BSCOE', 'Bachelor Of Science In Computer Engineering', '2020-05-01 17:26:40', '2020-05-02 23:31:03');

-- --------------------------------------------------------

--
-- Table structure for table `facultys`
--

CREATE TABLE `facultys` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `position` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `fname` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lname` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mname` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `contact` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `facultys`
--

INSERT INTO `facultys` (`id`, `position`, `fname`, `lname`, `mname`, `contact`, `image`, `created_at`, `updated_at`) VALUES
(1, 'Professor 2', 'Erwin', 'Ordovez', '', '09267776670', '1121961748.jpg', '2020-05-04 15:33:48', '2020-05-04 15:33:48'),
(2, 'Professor 1', 'Pablo', 'Jose', '', '09269076915', '1882703899.jpg', '2020-05-04 15:43:14', '2020-05-04 17:12:14');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2020_03_05_133132_create_students_table', 1),
(5, '2020_04_25_023725_create_admins_table', 1),
(6, '2020_05_01_063606_create_courses_table', 1),
(7, '2020_05_03_073852_create_subjects_table', 2),
(8, '2020_05_03_102608_create_positions_table', 3),
(17, '2020_05_04_231758_add_status_to_schedules', 6),
(18, '2020_05_03_131203_create_facultys_table', 7),
(19, '2020_05_04_020100_create_schedules_table', 7),
(20, '2020_05_04_065057_create_school_years_table', 7),
(23, '2020_05_05_022450_create_questions_table', 8),
(25, '2020_05_07_091353_create_results_table', 9);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `username` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `positions`
--

CREATE TABLE `positions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `position` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `positions`
--

INSERT INTO `positions` (`id`, `position`, `created_at`, `updated_at`) VALUES
(9, 'Professor 1', '2020-05-03 04:57:00', '2020-05-03 04:57:00'),
(10, 'Professor 2', '2020-05-03 04:57:08', '2020-05-03 04:57:08');

-- --------------------------------------------------------

--
-- Table structure for table `questions`
--

CREATE TABLE `questions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `qdesc` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `qnum` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `questions`
--

INSERT INTO `questions` (`id`, `qdesc`, `qnum`, `created_at`, `updated_at`) VALUES
(1, 'Lorem Ipsum Dolor Sit Amet, Consectetur Adipiscing Elit. Aliquam Id Commodo Sapien, Quis Condimentum Turpis.', NULL, '2020-05-04 22:39:57', '2020-05-09 04:11:58'),
(2, '2 Lorem Ipsum Dolor Sit Amet, Consectetur Adipiscing Elit. Aliquam Id Commodo Sapien, Quis Condimentum Turpis.', 2, '2020-05-04 22:40:30', '2020-05-05 17:38:49'),
(3, 'Lorem Ipsum Dolor Sit Amet, Consectetur Adipiscing Elit. Aliquam Id Commodo Sapien, Quis Condimentum Turpis.', 10, '2020-05-04 22:40:34', '2020-05-09 04:11:58'),
(4, 'Lorem Ipsum Dolor Sit Amet, Consectetur Adipiscing Elit. Aliquam Id Commodo Sapien, Quis Condimentum Turpis.', 9, '2020-05-04 22:40:38', '2020-05-05 17:22:38'),
(5, '5 Lorem Ipsum Dolor Sit Amet, Consectetur Adipiscing Elit. Aliquam Id Commodo Sapien, Quis Condimentum Turpis.', 8, '2020-05-04 22:40:41', '2020-05-04 22:44:56'),
(6, '6 Lorem Ipsum Dolor Sit Amet, Consectetur Adipiscing Elit. Aliquam Id Commodo Sapien, Quis Condimentum Turpis.', 7, '2020-05-04 22:40:49', '2020-05-04 22:44:49'),
(7, '7 Lorem Ipsum Dolor Sit Amet, Consectetur Adipiscing Elit. Aliquam Id Commodo Sapien, Quis Condimentum Turpis.', 6, '2020-05-04 22:40:53', '2020-05-04 22:44:42'),
(8, '8 Lorem Ipsum Dolor Sit Amet, Consectetur Adipiscing Elit. Aliquam Id Commodo Sapien, Quis Condimentum Turpis.', 5, '2020-05-04 22:40:56', '2020-05-04 22:44:33'),
(9, '9 Lorem Ipsum Dolor Sit Amet, Consectetur Adipiscing Elit. Aliquam Id Commodo Sapien, Quis Condimentum Turpis.', 4, '2020-05-04 22:41:00', '2020-05-04 22:44:25'),
(10, '10 Lorem Ipsum Dolor Sit Amet, Consectetur Adipiscing Elit. Aliquam Id Commodo Sapien, Quis Condimentum Turpis.', 3, '2020-05-04 22:41:07', '2020-05-04 22:42:37'),
(12, '12 Lorem Ipsum Dolor Sit Amet, Consectetur Adipiscing Elit. Aliquam Id Commodo Sapien, Quis Condimentum Turpis Blahbla', 1, '2020-05-04 22:41:15', '2020-05-08 22:54:48');

-- --------------------------------------------------------

--
-- Table structure for table `results`
--

CREATE TABLE `results` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `schedid` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `studid` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `q1` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `q2` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `q3` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `q4` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `q5` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `q6` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `q7` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `q8` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `q9` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `q10` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `comment` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `results`
--

INSERT INTO `results` (`id`, `schedid`, `studid`, `q1`, `q2`, `q3`, `q4`, `q5`, `q6`, `q7`, `q8`, `q9`, `q10`, `comment`, `created_at`, `updated_at`) VALUES
(1, '4', '166-0077', '5', '4', '5', '3', '5', '3', '5', '4', '4', '5', 'Fair', '2020-05-07 22:34:11', '2020-05-07 22:34:11'),
(2, '3', '166-0075', '5', '4', '5', '3', '5', '3', '5', '4', '5', '5', 'Good', '2020-05-07 22:36:57', '2020-05-07 22:36:57'),
(3, '3', '166-0079', '5', '4', '5', '4', '5', '4', '3', '2', '1', '5', 'Fair', '2020-05-08 00:57:43', '2020-05-08 00:57:43'),
(4, '4', '166-0075', '5', '4', '5', '4', '4', '5', '5', '4', '3', '5', 'Fair Enough', '2020-05-08 22:50:06', '2020-05-08 22:50:06'),
(5, '6', '166-0076', '5', '4', '5', '4', '5', '3', '5', '4', '5', '2', 'Good Enough', '2020-05-08 23:46:49', '2020-05-08 23:46:49');

-- --------------------------------------------------------

--
-- Table structure for table `schedules`
--

CREATE TABLE `schedules` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `status` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `uid` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sem` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sy` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ylevel` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `section` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `scode` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ccode` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `schedules`
--

INSERT INTO `schedules` (`id`, `status`, `uid`, `name`, `sem`, `sy`, `ylevel`, `section`, `scode`, `ccode`, `created_at`, `updated_at`) VALUES
(1, 'Deactive', '1', 'Erwin Ordovez', '2nd Semester', '2019-2020', '4th Year', 'B', 'COM101', 'BSCT', '2020-05-04 15:35:26', '2020-05-04 15:35:26'),
(2, 'Deactive', '2', 'Pablo Jose', '2nd Semester', '2019-2020', '4th Year', 'A', 'COM101', 'BSCOE', '2020-05-04 15:43:36', '2020-05-04 15:43:36'),
(3, 'Active', '1', 'Erwin Ordovez', '2nd Semester', '2020-2021', '4th Year', 'B', 'COM101', 'BSCT', '2020-05-04 16:40:28', '2020-05-04 16:40:28'),
(4, 'Active', '2', 'Pablo Jose', '2nd Semester', '2020-2021', '4th Year', 'B', 'DBMS 1', 'BSCT', '2020-05-04 16:48:33', '2020-05-05 18:37:05'),
(6, 'Active', '2', 'Pablo Jose', '2nd Semester', '2020-2021', '4th Year', 'B', 'DBMS 1', 'BSIT', '2020-05-06 21:14:02', '2020-05-06 21:14:02');

-- --------------------------------------------------------

--
-- Table structure for table `school_years`
--

CREATE TABLE `school_years` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `sy` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `school_years`
--

INSERT INTO `school_years` (`id`, `sy`, `created_at`, `updated_at`) VALUES
(1, '2019-2020', '2020-05-04 23:33:04', '2020-05-04 23:33:04'),
(4, '2020-2021', '2020-05-05 00:39:58', '2020-05-05 00:39:58');

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `student_id` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `fname` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lname` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mname` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `course` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `major` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`id`, `student_id`, `fname`, `lname`, `mname`, `course`, `major`, `image`, `created_at`, `updated_at`) VALUES
(1, '166-0075', 'Richard', 'Ordinario', 'Daypuyart', 'BSCT', 'Computer', '501101876.jpg', '2020-05-01 00:23:10', '2020-05-06 16:30:46'),
(6, '166-0076', 'John Michael', 'Bonador', 'Pizzara', 'BSIT', 'Computer', '1018016462.jpg', '2020-05-02 01:33:22', '2020-05-06 21:14:21'),
(7, '166-0077', 'Judd Cesar', 'Chavez', '', 'BSCT', 'Computer', '1086475752.jpg', '2020-05-02 01:42:17', '2020-05-02 01:42:17'),
(8, '166-0078', 'Emmanuel', 'Gabriel', 'Zoilo', 'BSCT', 'Computer', '2106683291.jpg', '2020-05-02 01:42:53', '2020-05-02 01:47:42'),
(9, '166-0079', 'Clarrence Adreianne', 'Bautista', '', 'BSCT', 'Computer', '1322531174.jpg', '2020-05-02 01:43:37', '2020-05-03 01:36:17');

-- --------------------------------------------------------

--
-- Table structure for table `subjects`
--

CREATE TABLE `subjects` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `subject_code` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `subject_desc` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `subjects`
--

INSERT INTO `subjects` (`id`, `subject_code`, `subject_desc`, `created_at`, `updated_at`) VALUES
(1, 'COM101', 'Computer Fundamentals', '2020-05-03 00:08:22', '2020-05-03 00:08:22'),
(2, 'ENG101', 'English Grammar', '2020-05-03 00:10:35', '2020-05-03 00:38:36'),
(4, 'DBMS 1', 'Database Management 1', '2020-05-03 00:39:31', '2020-05-03 00:39:45');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uid` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `utype` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `uid`, `utype`, `name`, `username`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(2, '1', 'Admin', 'Regina Baracena', 'regina', '$2y$12$hIMSYukPcmT9kSE4iPwqdOkUeebXVAe2FN5jnRmUB8Xf4B3lD44J2', NULL, '2020-05-01 00:06:20', '2020-05-01 00:06:20'),
(3, '2', 'Facilitator', 'Richard Ordinario', 'richard', '$2y$10$WzjGDC7OTLVMmtbGUiOK3OyASTX1ohH5jeatB/mVtAuhHEycAamwO', NULL, '2020-05-01 00:21:37', '2020-05-01 00:21:37'),
(4, '166-0075', 'Student', 'Richard Daypuyart Ordinario', '166-0075', '$2y$10$c4.0SvMUfbfVQlTtADO8pe.hF1D4lnSlvR.KDkFORX6CLqgbfdphi', NULL, '2020-05-01 00:23:10', '2020-05-06 16:30:46'),
(11, '166-0076', 'Student', 'John Michael Pizzara Bonador', '166-0076', '$2y$10$3nJDraVc66wLkW0FNeX4JeNHljhQsEVA2Co6/fJPtJQIaBGvXKLA6', NULL, '2020-05-02 01:33:22', '2020-05-06 21:14:21'),
(12, '166-0077', 'Student', 'Judd Cesar Chavez', '166-0077', '$2y$10$CxYmNIit1QyYx0PzRkWR3eEy9/xF2LOno0iQ0htHG8oFQligRpkH2', NULL, '2020-05-02 01:42:17', '2020-05-02 01:42:17'),
(13, '166-0078', 'Student', 'Emmanuel Zoilo Gabriel', '166-0078', '$2y$10$yzFf8jns6QxEezS/CeMFEO18Jn9rx8AiQ7pRU9MZ9qpXMjBnpWoN.', NULL, '2020-05-02 01:42:53', '2020-05-02 01:47:42'),
(14, '166-0079', 'Student', 'Clarrence Adreianne Bautista', '166-0079', '$2y$10$VzEacLWZ8cCQpnsHFRMWkOUs6oHqvwDsPdHLd1soi29cvdGBkC45q', NULL, '2020-05-02 01:43:37', '2020-05-03 01:36:17'),
(16, '6', 'Facilitator', 'Mark Christian Mirador', 'mark', '$2y$10$AtaiN0iWKgSlIaBzOxgNSuhY4DwGsO1936v32XmEoVkgtuwCf9LKW', NULL, '2020-05-03 18:46:36', '2020-05-03 18:50:50'),
(17, '7', 'Facilitator', 'John Michael Bonador', 'jmbonador', '$2y$10$jRuk8.Dcs0aspFJHWjcZ2.g/DEpkXuaIZQQxhTN7W89QFOVfJrCXm', NULL, '2020-05-04 16:49:33', '2020-05-04 16:49:33');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `courses`
--
ALTER TABLE `courses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `facultys`
--
ALTER TABLE `facultys`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_username_index` (`username`);

--
-- Indexes for table `positions`
--
ALTER TABLE `positions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `questions`
--
ALTER TABLE `questions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `results`
--
ALTER TABLE `results`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `schedules`
--
ALTER TABLE `schedules`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `school_years`
--
ALTER TABLE `school_years`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `students_student_id_unique` (`student_id`);

--
-- Indexes for table `subjects`
--
ALTER TABLE `subjects`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_username_unique` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `courses`
--
ALTER TABLE `courses`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `facultys`
--
ALTER TABLE `facultys`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `positions`
--
ALTER TABLE `positions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `questions`
--
ALTER TABLE `questions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `results`
--
ALTER TABLE `results`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `schedules`
--
ALTER TABLE `schedules`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `school_years`
--
ALTER TABLE `school_years`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `subjects`
--
ALTER TABLE `subjects`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
