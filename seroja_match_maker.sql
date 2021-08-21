-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 09, 2021 at 04:48 AM
-- Server version: 10.4.20-MariaDB
-- PHP Version: 8.0.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `seroja_match_maker`
--

-- --------------------------------------------------------

--
-- Table structure for table `event`
--

CREATE TABLE `event` (
  `id` varchar(10) NOT NULL,
  `user_id` varchar(10) NOT NULL,
  `event_name` varchar(100) NOT NULL,
  `number_of_team` int(11) NOT NULL,
  `elimination_type` enum('GRP','KNO') NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT current_timestamp(),
  `last_modified` timestamp NOT NULL DEFAULT current_timestamp(),
  `status` enum('ONGOING','FINISHED') NOT NULL,
  `is_saved` int(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `event`
--

INSERT INTO `event` (`id`, `user_id`, `event_name`, `number_of_team`, `elimination_type`, `date_created`, `last_modified`, `status`, `is_saved`) VALUES
('EVT0000001', 'USR0000001', 'TESTING1', 9, 'KNO', '2021-08-08 18:34:58', '2021-08-08 18:34:58', 'ONGOING', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `match_bracket`
--

CREATE TABLE `match_bracket` (
  `id` varchar(10) NOT NULL,
  `event_id` varchar(10) NOT NULL,
  `team_a` varchar(10) DEFAULT NULL,
  `team_b` varchar(10) DEFAULT NULL,
  `skor_a` int(10) DEFAULT NULL,
  `skor_b` int(10) DEFAULT NULL,
  `winner` varchar(10) DEFAULT NULL,
  `next_branch` varchar(10) DEFAULT NULL,
  `is_end` int(1) DEFAULT NULL,
  `is_wo` int(1) DEFAULT NULL,
  `is_addition` int(11) DEFAULT NULL,
  `stage_number` int(10) DEFAULT NULL,
  `index_number` int(10) DEFAULT NULL,
  `stage_type` enum('ELIMINATION','QUARTER-FINAL','SEMI-FINAL','FINAL','ELIMINATION-FINAL') NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT current_timestamp(),
  `last_modified` timestamp NOT NULL DEFAULT current_timestamp(),
  `status` enum('UNASSIGNED','ONGOING','FINISHED') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `match_bracket`
--

INSERT INTO `match_bracket` (`id`, `event_id`, `team_a`, `team_b`, `skor_a`, `skor_b`, `winner`, `next_branch`, `is_end`, `is_wo`, `is_addition`, `stage_number`, `index_number`, `stage_type`, `date_created`, `last_modified`, `status`) VALUES
('BKT0000001', 'EVT0000001', NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, 1, 1, 'FINAL', '2021-08-08 18:34:59', '2021-08-08 18:34:59', 'UNASSIGNED'),
('BKT0000002', 'EVT0000001', NULL, NULL, NULL, NULL, NULL, 'BKT0000001', 0, 0, NULL, 2, 1, 'SEMI-FINAL', '2021-08-08 18:34:59', '2021-08-08 18:34:59', 'UNASSIGNED'),
('BKT0000003', 'EVT0000001', NULL, NULL, NULL, NULL, NULL, 'BKT0000001', 0, 0, NULL, 2, 2, 'SEMI-FINAL', '2021-08-08 18:34:59', '2021-08-08 18:34:59', 'UNASSIGNED'),
('BKT0000004', 'EVT0000001', NULL, NULL, NULL, NULL, NULL, 'BKT0000002', 0, 0, NULL, 3, 1, 'QUARTER-FINAL', '2021-08-08 18:34:59', '2021-08-08 18:34:59', 'UNASSIGNED'),
('BKT0000005', 'EVT0000001', NULL, NULL, NULL, NULL, NULL, 'BKT0000002', 0, 0, NULL, 3, 2, 'QUARTER-FINAL', '2021-08-08 18:35:00', '2021-08-08 18:35:00', 'UNASSIGNED'),
('BKT0000006', 'EVT0000001', NULL, NULL, NULL, NULL, NULL, 'BKT0000003', 0, 0, NULL, 3, 3, 'QUARTER-FINAL', '2021-08-08 18:35:00', '2021-08-08 18:35:00', 'UNASSIGNED'),
('BKT0000007', 'EVT0000001', NULL, NULL, NULL, NULL, NULL, 'BKT0000003', 0, 0, NULL, 3, 4, 'QUARTER-FINAL', '2021-08-08 18:35:00', '2021-08-08 18:35:00', 'UNASSIGNED'),
('BKT0000008', 'EVT0000001', 'TMG0000002', 'TMG0000005', NULL, NULL, NULL, 'BKT0000004', 0, 0, 0, 4, 1, 'ELIMINATION', '2021-08-08 18:35:00', '2021-08-08 18:35:01', 'UNASSIGNED'),
('BKT0000009', 'EVT0000001', 'TMG0000008', 'TMG0000004', NULL, NULL, NULL, 'BKT0000005', 0, 0, 0, 4, 3, 'ELIMINATION', '2021-08-08 18:35:00', '2021-08-08 18:35:01', 'UNASSIGNED'),
('BKT0000010', 'EVT0000001', 'TMG0000006', 'TMG0000007', NULL, NULL, NULL, 'BKT0000006', 0, 0, 0, 4, 5, 'ELIMINATION', '2021-08-08 18:35:00', '2021-08-08 18:35:01', 'UNASSIGNED'),
('BKT0000011', 'EVT0000001', 'TMG0000009', 'TMG0000001', NULL, NULL, NULL, 'BKT0000007', 0, 0, 0, 4, 7, 'ELIMINATION', '2021-08-08 18:35:00', '2021-08-08 18:35:01', 'UNASSIGNED'),
('BKT0000012', 'EVT0000001', 'TMG0000003', NULL, NULL, NULL, NULL, 'BKT0000004', 0, 0, 1, 4, 2, 'ELIMINATION', '2021-08-08 18:35:00', '2021-08-08 18:35:01', 'UNASSIGNED');

-- --------------------------------------------------------

--
-- Table structure for table `team`
--

CREATE TABLE `team` (
  `id` varchar(10) NOT NULL,
  `event_id` varchar(10) NOT NULL,
  `team_name` varchar(100) NOT NULL,
  `instance` varchar(100) NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT current_timestamp(),
  `last_modified` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `team`
--

INSERT INTO `team` (`id`, `event_id`, `team_name`, `instance`, `date_created`, `last_modified`) VALUES
('TMG0000001', 'EVT0000001', 'TEAM 1', 'SMAN 1', '2021-08-08 18:34:58', '2021-08-08 18:34:58'),
('TMG0000002', 'EVT0000001', 'TEAM 2', 'SMAN 2', '2021-08-08 18:34:58', '2021-08-08 18:34:58'),
('TMG0000003', 'EVT0000001', 'TEAM 3', 'SMAN 3', '2021-08-08 18:34:58', '2021-08-08 18:34:58'),
('TMG0000004', 'EVT0000001', 'TEAM 4', 'SMAN 4', '2021-08-08 18:34:58', '2021-08-08 18:34:58'),
('TMG0000005', 'EVT0000001', 'TEAM 5', 'SMAN 5', '2021-08-08 18:34:59', '2021-08-08 18:34:59'),
('TMG0000006', 'EVT0000001', 'TEAM 6', 'SMAN 6', '2021-08-08 18:34:59', '2021-08-08 18:34:59'),
('TMG0000007', 'EVT0000001', 'TEAM 7', 'SMAN 7', '2021-08-08 18:34:59', '2021-08-08 18:34:59'),
('TMG0000008', 'EVT0000001', 'TEAM 8', 'SMAN 8', '2021-08-08 18:34:59', '2021-08-08 18:34:59'),
('TMG0000009', 'EVT0000001', 'TEAM 9', 'SMAN 9', '2021-08-08 18:34:59', '2021-08-08 18:34:59');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` varchar(10) NOT NULL,
  `name` varchar(100) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(722) NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT current_timestamp(),
  `last_modified` timestamp NOT NULL DEFAULT current_timestamp(),
  `status` enum('A','D') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `name`, `username`, `password`, `date_created`, `last_modified`, `status`) VALUES
('USR0000001', 'Aditya Prasetio', 'adityapras', '$2y$10$L0aYBWiO3CNPcdHxRV6nG.DQ.naRFYXATtUsI0.5yEGzmzSb0aU.q', '2021-07-13 01:43:37', '2021-07-13 01:43:37', 'A'),
('USR0000002', 'Alfadli Raihan Tsani', 'alfadlirait', '$2y$10$x7m2FMfAkKwc8u4lZbK4JO.bEEvEeSbiS5mlyRWugjmo91T50CW2a', '2021-07-24 07:59:29', '2021-07-24 16:58:48', 'A'),
('USR0000003', 'Rafli Mayori', 'raflimyr', '$2y$10$bUZTC6PJGpw6jL1fvM3scefPsG1n4Ol.YVv0cb1EPqdkZPF4xfnHC', '2021-07-24 17:44:32', '2021-07-24 17:44:32', 'A'),
('USR0000004', 'Salsa', 'salsabl', '$2y$10$KotReMBXw5eE8AV5caXvEeyJZWNIHnizBhJG9aXZ8Jhx154.mD7p6', '2021-07-24 17:46:10', '2021-07-24 17:49:14', 'A'),
('USR0000005', 'Chorida Nabila', 'chorida', '$2y$10$00ssMQov3seLsCmVcxyUFulVbg2TtlE04iSetfNygJ0EBNAbAC3sy', '2021-07-27 01:52:09', '2021-07-27 01:58:21', 'A'),
('USR0000006', 'test', 'test', '$2y$10$XoP/0HqNrxlLDxm5GaO.8O6wOR7kzKQiyWCZI1vlxCA5PHSk79/Li', '2021-07-27 19:19:52', '2021-07-27 19:19:52', 'A'),
('USR0000007', 'firda', 'firdaar', '$2y$10$8yNcEzL9FnHXHzunnK9BHuNVcaqqLs0Jd2aoRQwLc6KofKStdm4f6', '2021-07-28 03:20:58', '2021-07-28 03:20:58', 'A'),
('USR0000008', 'salsabila', 'salsa', '$2y$10$ViTW807BrQwOHWmHEewAF.lIAjumz3WgLsNwTD8cgA2p/1l7t2ya6', '2021-07-29 07:43:12', '2021-07-29 07:43:12', 'A'),
('USR0000009', 'asda', 'adsad', '$2y$10$MYFQjOZfuRPWZmBoK49n8uiZRtoLyCKhyTTs9bDLHOrjpHGChVXZG', '2021-08-08 06:23:27', '2021-08-08 06:23:27', 'A');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `event`
--
ALTER TABLE `event`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `match_bracket`
--
ALTER TABLE `match_bracket`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `team`
--
ALTER TABLE `team`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
