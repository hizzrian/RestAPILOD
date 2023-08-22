-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Aug 22, 2023 at 07:01 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.0.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_artikel`
--

-- --------------------------------------------------------

--
-- Table structure for table `artikel`
--

CREATE TABLE `artikel` (
  `id` int(5) UNSIGNED NOT NULL,
  `judul` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `penulis` int(5) UNSIGNED NOT NULL,
  `konten` text NOT NULL,
  `tanggal_publikasi` date NOT NULL,
  `kategori` varchar(100) NOT NULL,
  `views` int(10) UNSIGNED NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `artikel`
--

INSERT INTO `artikel` (`id`, `judul`, `slug`, `penulis`, `konten`, `tanggal_publikasi`, `kategori`, `views`) VALUES
(9, 'Artikel 9', 'artikel-9', 4, 'Ini adalah konten artikel 9', '2023-07-26', 'Kategori 3', 33),
(10, 'Artikel 10', 'artikel-10', 4, 'Ini adalah konten artikel 10', '2023-07-16', 'Kategori 3', 289),
(12, 'Artikel 10', 'artikel-10', 4, 'Ini adalah konten artikel 10', '2023-07-16', 'Kategori 3', 289),
(15, 'Web Dev', 'web-dev', 1, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Purus faucibus ornare suspendisse sed nisi. Dolor magna eget est lorem ipsum dolor sit amet consectetur. Pellentesque eu tincidunt tortor aliquam nulla facilisi cras fermentum. Suscipit tellus mauris a diam maecenas sed enim ut. Ornare lectus sit amet est. Vitae tempus quam pellentesque nec nam aliquam sem et. Placerat vestibulum lectus mauris ultrices eros in cursus turpis. Consequat id porta nibh venenatis cras sed felis eget. Massa placerat duis ultricies lacus sed turpis tincidunt id aliquet. Tincidunt ornare massa eget egestas purus viverra accumsan. Tortor consequat id porta nibh. Malesuada pellentesque elit eget gravida cum sociis natoque penatibus. Nunc eget lorem dolor sed viverra. Lacus vel facilisis volutpat est velit egestas dui.', '2023-08-17', 'Web Dev', 2),
(16, 'judul', 'judul', 1, 'kjasdajskd', '2023-08-17', 'asjd', 1),
(17, 'Artikel apa ada nya', 'artikel-apa-ada-nya', 1, 'Ini adalah konten artikel 5', '2023-08-20', 'Kategori 1', 0),
(18, 'Artikel 5 asdasd', 'artikel-5-asdasd', 1, 'Ini adalah konten artikel 5', '2023-08-20', 'Kategori 1', 0),
(19, 'judul hiyahiyahyia', 'judul-hiyahiyahyia', 1, 'kjasdajskd', '2023-08-20', 'asjd', 0),
(20, 'judul hiyahiyahyia asdasd', 'judul-hiyahiyahyia-asdasd', 1, 'kjasdajskd', '2023-08-20', 'asjd', 0),
(21, 'Artikel 5 hmmmmm', 'artikel-5-hmmmmm', 1, 'Ini adalah konten artikel 5', '2023-08-20', 'Kategori 1', 0),
(22, 'Artikel 5asd asd as sa ', 'artikel-5asd-asd-as-sa', 1, 'Ini adalah konten artikel 5', '2023-08-20', 'Kategori 1', 0),
(23, 'Test Add Artikel', 'test-add-artikel', 1, 'Test Add ArtikelTest Add ArtikelTest Add ArtikelTest Add ArtikelTest Add ArtikelTest Add Artikel', '2023-08-21', 'Artikel', 1),
(24, 'testing', 'testing', 1, '<b>Testing addTesting addTesting addTesting addTesting addTesting addTesting addTesting add</b>\n\n<s>Testing Strike</s>', '2023-08-21', 'testinggg', 2),
(25, 'testing judul artikel', 'testing-judul-artikel', 1, '<b>Testing</b>\n<i>Italic</i>\n<u>underline</u>\n<s>strike</s>\n<a href=\"youtube.com\">Test</a>', '2023-08-21', 'cara membuat artiikel', 2);

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `version` varchar(255) NOT NULL,
  `class` varchar(255) NOT NULL,
  `group` varchar(255) NOT NULL,
  `namespace` varchar(255) NOT NULL,
  `time` int(11) NOT NULL,
  `batch` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `version`, `class`, `group`, `namespace`, `time`, `batch`) VALUES
(1, '2021-09-10-085823', 'App\\Database\\Migrations\\AddClient', 'default', 'App', 1691927423, 1),
(2, '2021-09-10-085837', 'App\\Database\\Migrations\\AddUser', 'default', 'App', 1691927423, 1),
(3, '2023-08-13-161842', 'App\\Database\\Migrations\\AddArtikel', 'default', 'App', 1691943823, 2);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(5) UNSIGNED NOT NULL,
  `fullname` varchar(100) NOT NULL,
  `avatar` varchar(100) DEFAULT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `role` varchar(100) DEFAULT NULL,
  `username` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `fullname`, `avatar`, `email`, `password`, `updated_at`, `created_at`, `role`, `username`) VALUES
(1, 'admin', NULL, 'admin@localhost.com', '$2y$10$.Aq0yJirdsis1Nyx8xolJuOYJhvhWyZ1k1pTZIQUkMgrtT6BQS4uK', NULL, '2023-08-13 18:57:40', 'admin', 'admin'),
(4, 'client', NULL, 'client@localhost.com', '$2y$10$.Aq0yJirdsis1Nyx8xolJuOYJhvhWyZ1k1pTZIQUkMgrtT6BQS4uK', NULL, '2023-08-13 18:57:40', 'client', 'client'),
(5, 'editor', NULL, 'editor@localhost.com', '$2y$10$.Aq0yJirdsis1Nyx8xolJuOYJhvhWyZ1k1pTZIQUkMgrtT6BQS4uK', NULL, '2023-08-13 18:57:40', 'editor', 'editor');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `artikel`
--
ALTER TABLE `artikel`
  ADD PRIMARY KEY (`id`),
  ADD KEY `artikel_FK` (`penulis`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `artikel`
--
ALTER TABLE `artikel`
  MODIFY `id` int(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `artikel`
--
ALTER TABLE `artikel`
  ADD CONSTRAINT `artikel_FK` FOREIGN KEY (`penulis`) REFERENCES `user` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
