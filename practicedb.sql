-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 04, 2017 at 09:29 AM
-- Server version: 10.1.26-MariaDB
-- PHP Version: 7.1.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `practicedb`
--

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
(3, '2017_11_02_094253_create-to_dos-table', 1),
(4, '2017_11_02_094807_create-tasks-table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tasks`
--

CREATE TABLE `tasks` (
  `id` int(10) UNSIGNED NOT NULL,
  `to_dos_id` int(10) UNSIGNED NOT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `taskdesc` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(4) NOT NULL,
  `duedate` time NOT NULL,
  `sort` tinyint(4) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tasks`
--

INSERT INTO `tasks` (`id`, `to_dos_id`, `title`, `taskdesc`, `status`, `duedate`, `sort`, `created_at`, `updated_at`) VALUES
(2, 2, 'task2', 'TASK2 TODO2 Description', 0, '00:00:00', 0, NULL, NULL),
(4, 2, 'task4', 'TASK4 TODO2 Description', 2, '00:00:00', 1, NULL, NULL),
(5, 16, 'task5', 'TASK5 TODO3 Description', 0, '00:00:00', 1, NULL, NULL),
(6, 16, 'task6', 'TASK6 TODO3 Description', 1, '00:00:00', 2, NULL, NULL),
(7, 16, 'task7', 'TASK7 TODO3 Description', 0, '00:00:00', 3, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `to_dos`
--

CREATE TABLE `to_dos` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `text` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(4) NOT NULL,
  `sort` tinyint(4) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `to_dos`
--

INSERT INTO `to_dos` (`id`, `user_id`, `title`, `text`, `status`, `sort`, `created_at`, `updated_at`) VALUES
(1, 3, 'todo1', 'TODO1 Description', 2, 1, NULL, NULL),
(2, 3, 'todo2', 'TODO2 Description', 1, 7, NULL, NULL),
(3, 4, 'xxx', 'XXX', 0, 1, NULL, NULL),
(16, 3, 'todo3', 'TODO3 Description', 1, 3, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `verifyToken` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '0',
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `verifyToken`, `status`, `remember_token`, `created_at`, `updated_at`) VALUES
(3, 'Zahra', 'gh.shahsavan@gmail.com', '$2y$10$Xl1o5vEKLaxa1i11CIonDeg.8RpW85au2aUf5qlty/ZokFdLX1xB.', 'KMuuZSUHKEH5WHaBz7Vbxi4FX90mwCBICgXLTW1K', 0, 'Wh14KS3ZS6lVx9qkvEjZaGhegwdlJW2nQMhufxHrnO2903DxRzKnW1KL1uJ6', '2017-11-02 06:55:52', '2017-11-02 06:55:52'),
(4, 'ziba', 'ziba.baharestani@gmail.com', '$2y$10$Xl1o5vEKLaxa1i11CIonDeg.8RpW85au2aUf5qlty/ZokFdLX1xB.', 'Null', 1, NULL, NULL, NULL),
(5, 'z', 'azam.shahsavan@gmail.com', '$2y$10$FNz1DJYz389r3k10bRPtbeZILffyyT/Erh0J.no2Ai.QgaxKLhvBi', 'cROXfuxErzcfcOzydiigoCxcxra52TNodtXmakYT', 0, NULL, '2017-11-04 03:36:33', '2017-11-04 03:36:33');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `tasks`
--
ALTER TABLE `tasks`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tasks_to_dos_id_foreign` (`to_dos_id`);

--
-- Indexes for table `to_dos`
--
ALTER TABLE `to_dos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `to_dos_user_id_foreign` (`user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tasks`
--
ALTER TABLE `tasks`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `to_dos`
--
ALTER TABLE `to_dos`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tasks`
--
ALTER TABLE `tasks`
  ADD CONSTRAINT `tasks_to_dos_id_foreign` FOREIGN KEY (`to_dos_id`) REFERENCES `to_dos` (`id`);

--
-- Constraints for table `to_dos`
--
ALTER TABLE `to_dos`
  ADD CONSTRAINT `to_dos_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
