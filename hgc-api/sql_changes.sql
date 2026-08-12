ALTER TABLE news_articles MODIFY category VARCHAR(100) NOT NULL DEFAULT 'news';
---------------------------------------------------------------
-- phpMyAdmin SQL Dump
-- version 5.2.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Aug 12, 2026 at 06:45 PM
-- Server version: 8.4.7
-- PHP Version: 8.3.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `hgc-website`
--

-- --------------------------------------------------------

--
-- Table structure for table `news_articles`
--

DROP TABLE IF EXISTS `news_articles`;
CREATE TABLE IF NOT EXISTS `news_articles` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `slug` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `title_en` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `title_dari` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `title_pashto` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `excerpt_en` text COLLATE utf8mb4_unicode_ci,
  `excerpt_dari` text COLLATE utf8mb4_unicode_ci,
  `excerpt_pashto` text COLLATE utf8mb4_unicode_ci,
  `content_en` longtext COLLATE utf8mb4_unicode_ci,
  `content_dari` longtext COLLATE utf8mb4_unicode_ci,
  `content_pashto` longtext COLLATE utf8mb4_unicode_ci,
  `cover_image_url` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `author_name` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `category` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'news',
  `published_at` timestamp NULL DEFAULT NULL,
  `is_published` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `news_articles_slug_unique` (`slug`),
  KEY `news_articles_slug_index` (`slug`),
  KEY `news_articles_is_published_published_at_index` (`is_published`,`published_at`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `news_articles`
--

INSERT INTO `news_articles` (`id`, `slug`, `title_en`, `title_dari`, `title_pashto`, `excerpt_en`, `excerpt_dari`, `excerpt_pashto`, `content_en`, `content_dari`, `content_pashto`, `cover_image_url`, `author_name`, `category`, `published_at`, `is_published`, `created_at`, `updated_at`) VALUES
(1, 'hgc-completes-major-highway-project', 'HGC Completes Major Highway Project', NULL, NULL, 'Hafez Construction successfully completed the Kabul-Kandahar highway rehabilitation project ahead of schedule.', NULL, NULL, '<p>Hafez Construction & Reconstruction Company (HCRC) has successfully completed the major highway rehabilitation project connecting Kabul to Kandahar. The project, which began in early 2023, was completed two months ahead of schedule.</p><p>The 482-kilometer stretch has been fully resurfaced with modern asphalt technology, including 12 new bridges and improved drainage systems. This project will significantly reduce travel time and improve trade routes across Afghanistan.</p>', NULL, NULL, 'uploads/image-916c5162-1786384203.webp', 'HGC Communications', 'Test', '2026-07-08 15:49:00', 1, '2026-07-06 15:49:14', '2026-08-10 13:34:54'),
(2, 'hafez-group-wins-safety-award-2024', 'Hafez Group Wins National Safety Award 2024', NULL, NULL, 'Recognized for maintaining the highest safety standards across all project sites nationwide.', NULL, NULL, '<p>Hafez Group of Companies has been awarded the National Safety Excellence Award for 2024 by the Afghan Chamber of Commerce. This recognition comes after maintaining zero serious incidents across all construction sites for the entire year.</p><p>Our safety protocols, including daily briefings, regular equipment inspections, and comprehensive training programs, have set new industry standards in Afghanistan.</p>', NULL, NULL, NULL, 'HGC Communications', 'award', '2026-07-06 15:49:14', 1, '2026-07-06 15:49:14', '2026-07-06 15:49:14');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;