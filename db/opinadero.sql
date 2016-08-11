-- phpMyAdmin SQL Dump
-- version 4.0.10.14
-- http://www.phpmyadmin.net
--
-- Host: localhost:3306
-- Generation Time: Aug 10, 2016 at 09:40 AM
-- Server version: 5.5.45-cll-lve
-- PHP Version: 5.4.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `opinadero`
--

-- --------------------------------------------------------

--
-- Table structure for table `dc_blog`
--

CREATE TABLE IF NOT EXISTS `dc_blog` (
  `blog_id` varchar(32) COLLATE utf8_bin NOT NULL,
  `blog_uid` varchar(32) COLLATE utf8_bin NOT NULL,
  `blog_creadt` datetime NOT NULL DEFAULT '1970-01-01 00:00:00',
  `blog_upddt` datetime NOT NULL DEFAULT '1970-01-01 00:00:00',
  `blog_url` varchar(255) COLLATE utf8_bin NOT NULL,
  `blog_name` varchar(255) COLLATE utf8_bin NOT NULL,
  `blog_desc` longtext COLLATE utf8_bin,
  `blog_status` smallint(6) NOT NULL DEFAULT '1',
  PRIMARY KEY (`blog_id`),
  KEY `dc_idx_blog_blog_upddt` (`blog_upddt`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `dc_blog`
--

INSERT INTO `dc_blog` (`blog_id`, `blog_uid`, `blog_creadt`, `blog_upddt`, `blog_url`, `blog_name`, `blog_desc`, `blog_status`) VALUES
('default', 'e9cf17e9e1f87fd247434ff983083f6d', '2016-05-07 16:18:18', '2016-05-07 16:21:54', 'http://www.opinadero.com/index.php?', 'My first blog', NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `dc_category`
--

CREATE TABLE IF NOT EXISTS `dc_category` (
  `cat_id` bigint(20) NOT NULL,
  `blog_id` varchar(32) COLLATE utf8_bin NOT NULL,
  `cat_title` varchar(255) COLLATE utf8_bin NOT NULL,
  `cat_url` varchar(255) COLLATE utf8_bin NOT NULL,
  `cat_desc` longtext COLLATE utf8_bin,
  `cat_position` int(11) DEFAULT '0',
  `cat_lft` int(11) DEFAULT NULL,
  `cat_rgt` int(11) DEFAULT NULL,
  PRIMARY KEY (`cat_id`),
  UNIQUE KEY `dc_uk_cat_url` (`cat_url`,`blog_id`),
  KEY `dc_idx_category_blog_id` (`blog_id`) USING BTREE,
  KEY `dc_idx_category_cat_lft_blog_id` (`blog_id`,`cat_lft`) USING BTREE,
  KEY `dc_idx_category_cat_rgt_blog_id` (`blog_id`,`cat_rgt`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Table structure for table `dc_comment`
--

CREATE TABLE IF NOT EXISTS `dc_comment` (
  `comment_id` bigint(20) NOT NULL,
  `post_id` bigint(20) NOT NULL,
  `comment_dt` datetime NOT NULL DEFAULT '1970-01-01 00:00:00',
  `comment_tz` varchar(128) COLLATE utf8_bin NOT NULL DEFAULT 'UTC',
  `comment_upddt` datetime NOT NULL DEFAULT '1970-01-01 00:00:00',
  `comment_author` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `comment_email` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `comment_site` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `comment_content` longtext COLLATE utf8_bin,
  `comment_words` longtext COLLATE utf8_bin,
  `comment_ip` varchar(39) COLLATE utf8_bin DEFAULT NULL,
  `comment_status` smallint(6) DEFAULT '0',
  `comment_spam_status` varchar(128) COLLATE utf8_bin DEFAULT '0',
  `comment_spam_filter` varchar(32) COLLATE utf8_bin DEFAULT NULL,
  `comment_trackback` smallint(6) NOT NULL DEFAULT '0',
  PRIMARY KEY (`comment_id`),
  KEY `dc_idx_comment_post_id` (`post_id`) USING BTREE,
  KEY `dc_idx_comment_post_id_dt_status` (`post_id`,`comment_dt`,`comment_status`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `dc_comment`
--

INSERT INTO `dc_comment` (`comment_id`, `post_id`, `comment_dt`, `comment_tz`, `comment_upddt`, `comment_author`, `comment_email`, `comment_site`, `comment_content`, `comment_words`, `comment_ip`, `comment_status`, `comment_spam_status`, `comment_spam_filter`, `comment_trackback`) VALUES
(1, 1, '2016-05-07 17:18:18', 'Europe/London', '2016-05-07 16:18:18', 'Dotclear Team', 'contact@dotclear.net', 'http://www.dotclear.org/', '<p>This is a comment.</p>\n<p>To delete it, log in and view your blog''s comments. Then you might remove or edit it.</p>', 'this comment delete log and view your blog comments then you might remove edit', '147.70.91.71', 1, '0', NULL, 0);

-- --------------------------------------------------------

--
-- Table structure for table `dc_link`
--

CREATE TABLE IF NOT EXISTS `dc_link` (
  `link_id` bigint(20) NOT NULL,
  `blog_id` varchar(32) COLLATE utf8_bin NOT NULL,
  `link_href` varchar(255) COLLATE utf8_bin NOT NULL,
  `link_title` varchar(255) COLLATE utf8_bin NOT NULL,
  `link_desc` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `link_lang` varchar(5) COLLATE utf8_bin DEFAULT NULL,
  `link_xfn` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `link_position` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`link_id`),
  KEY `dc_idx_link_blog_id` (`blog_id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Table structure for table `dc_log`
--

CREATE TABLE IF NOT EXISTS `dc_log` (
  `log_id` bigint(20) NOT NULL,
  `user_id` varchar(32) COLLATE utf8_bin DEFAULT NULL,
  `blog_id` varchar(32) COLLATE utf8_bin DEFAULT NULL,
  `log_table` varchar(255) COLLATE utf8_bin NOT NULL,
  `log_dt` datetime NOT NULL DEFAULT '1970-01-01 00:00:00',
  `log_ip` varchar(39) COLLATE utf8_bin NOT NULL,
  `log_msg` longtext COLLATE utf8_bin,
  PRIMARY KEY (`log_id`),
  KEY `dc_idx_log_user_id` (`user_id`) USING BTREE,
  KEY `dc_fk_log_blog` (`blog_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Table structure for table `dc_media`
--

CREATE TABLE IF NOT EXISTS `dc_media` (
  `media_id` bigint(20) NOT NULL,
  `user_id` varchar(32) COLLATE utf8_bin NOT NULL,
  `media_path` varchar(255) COLLATE utf8_bin NOT NULL,
  `media_title` varchar(255) COLLATE utf8_bin NOT NULL,
  `media_file` varchar(255) COLLATE utf8_bin NOT NULL,
  `media_dir` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT '.',
  `media_meta` longtext COLLATE utf8_bin,
  `media_dt` datetime NOT NULL DEFAULT '1970-01-01 00:00:00',
  `media_creadt` datetime NOT NULL DEFAULT '1970-01-01 00:00:00',
  `media_upddt` datetime NOT NULL DEFAULT '1970-01-01 00:00:00',
  `media_private` smallint(6) NOT NULL DEFAULT '0',
  PRIMARY KEY (`media_id`),
  KEY `dc_idx_media_user_id` (`user_id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `dc_media`
--

INSERT INTO `dc_media` (`media_id`, `user_id`, `media_path`, `media_title`, `media_file`, `media_dir`, `media_meta`, `media_dt`, `media_creadt`, `media_upddt`, `media_private`) VALUES
(1, 'admin', 'public', 'Project_20141203_1260.jpg', 'Welcome/Project_20141203_1260.jpg', 'Welcome', '<meta><Title/><Description/><Creator/><Rights/><Make/><Model/><Exposure/><FNumber/><MaxApertureValue/><ExposureProgram/><ISOSpeedRatings/><DateTimeOriginal></DateTimeOriginal><ExposureBiasValue/><MeteringMode/><FocalLength/><Lens/><CountryCode/><Country/><State/><City/><Keywords/></meta>', '2016-05-07 16:19:31', '2016-05-07 16:19:31', '2016-05-07 16:19:31', 0),
(2, 'admin', 'public', 'Project_20141203_1261.jpg', 'Welcome/Project_20141203_1261.jpg', 'Welcome', '<meta><Title/><Description/><Creator/><Rights/><Make/><Model/><Exposure/><FNumber/><MaxApertureValue/><ExposureProgram/><ISOSpeedRatings/><DateTimeOriginal></DateTimeOriginal><ExposureBiasValue/><MeteringMode/><FocalLength/><Lens/><CountryCode/><Country/><State/><City/><Keywords/></meta>', '2016-05-07 16:19:32', '2016-05-07 16:19:32', '2016-05-07 16:19:32', 0),
(3, 'admin', 'public', 'Project_20141203_1262.jpg', 'Welcome/Project_20141203_1262.jpg', 'Welcome', '<meta><Title/><Description/><Creator/><Rights/><Make/><Model/><Exposure/><FNumber/><MaxApertureValue/><ExposureProgram/><ISOSpeedRatings/><DateTimeOriginal></DateTimeOriginal><ExposureBiasValue/><MeteringMode/><FocalLength/><Lens/><CountryCode/><Country/><State/><City/><Keywords/></meta>', '2016-05-07 16:19:32', '2016-05-07 16:19:32', '2016-05-07 16:19:32', 0),
(4, 'admin', 'public', 'Project_20141203_1263.jpg', 'Welcome/Project_20141203_1263.jpg', 'Welcome', '<meta><Title/><Description/><Creator/><Rights/><Make/><Model/><Exposure/><FNumber/><MaxApertureValue/><ExposureProgram/><ISOSpeedRatings/><DateTimeOriginal></DateTimeOriginal><ExposureBiasValue/><MeteringMode/><FocalLength/><Lens/><CountryCode/><Country/><State/><City/><Keywords/></meta>', '2016-05-07 16:19:33', '2016-05-07 16:19:33', '2016-05-07 16:19:33', 0),
(5, 'admin', 'public', 'Project_20141203_1264.jpg', 'Welcome/Project_20141203_1264.jpg', 'Welcome', '<meta><Title/><Description/><Creator/><Rights/><Make/><Model/><Exposure/><FNumber/><MaxApertureValue/><ExposureProgram/><ISOSpeedRatings/><DateTimeOriginal></DateTimeOriginal><ExposureBiasValue/><MeteringMode/><FocalLength/><Lens/><CountryCode/><Country/><State/><City/><Keywords/></meta>', '2016-05-07 16:19:33', '2016-05-07 16:19:33', '2016-05-07 16:19:33', 0),
(6, 'admin', 'public', 'Project_20141203_1265.jpg', 'Welcome/Project_20141203_1265.jpg', 'Welcome', '<meta><Title/><Description/><Creator/><Rights/><Make/><Model/><Exposure/><FNumber/><MaxApertureValue/><ExposureProgram/><ISOSpeedRatings/><DateTimeOriginal></DateTimeOriginal><ExposureBiasValue/><MeteringMode/><FocalLength/><Lens/><CountryCode/><Country/><State/><City/><Keywords/></meta>', '2016-05-07 16:19:34', '2016-05-07 16:19:34', '2016-05-07 16:19:34', 0),
(7, 'admin', 'public', 'Project_20141203_1266.jpg', 'Welcome/Project_20141203_1266.jpg', 'Welcome', '<meta><Title/><Description/><Creator/><Rights/><Make/><Model/><Exposure/><FNumber/><MaxApertureValue/><ExposureProgram/><ISOSpeedRatings/><DateTimeOriginal></DateTimeOriginal><ExposureBiasValue/><MeteringMode/><FocalLength/><Lens/><CountryCode/><Country/><State/><City/><Keywords/></meta>', '2016-05-07 16:19:34', '2016-05-07 16:19:34', '2016-05-07 16:19:34', 0),
(8, 'admin', 'public', 'Project_20141203_1267.jpg', 'Welcome/Project_20141203_1267.jpg', 'Welcome', '<meta><Title/><Description/><Creator/><Rights/><Make/><Model/><Exposure/><FNumber/><MaxApertureValue/><ExposureProgram/><ISOSpeedRatings/><DateTimeOriginal></DateTimeOriginal><ExposureBiasValue/><MeteringMode/><FocalLength/><Lens/><CountryCode/><Country/><State/><City/><Keywords/></meta>', '2016-05-07 16:19:35', '2016-05-07 16:19:35', '2016-05-07 16:19:35', 0),
(9, 'admin', 'public', 'Project_20141203_1268.jpg', 'Welcome/Project_20141203_1268.jpg', 'Welcome', '<meta><Title/><Description/><Creator/><Rights/><Make/><Model/><Exposure/><FNumber/><MaxApertureValue/><ExposureProgram/><ISOSpeedRatings/><DateTimeOriginal></DateTimeOriginal><ExposureBiasValue/><MeteringMode/><FocalLength/><Lens/><CountryCode/><Country/><State/><City/><Keywords/></meta>', '2016-05-07 16:19:35', '2016-05-07 16:19:35', '2016-05-07 16:19:35', 0),
(10, 'admin', 'public', 'Project_20141203_1269.jpg', 'Welcome/Project_20141203_1269.jpg', 'Welcome', '<meta><Title/><Description/><Creator/><Rights/><Make/><Model/><Exposure/><FNumber/><MaxApertureValue/><ExposureProgram/><ISOSpeedRatings/><DateTimeOriginal></DateTimeOriginal><ExposureBiasValue/><MeteringMode/><FocalLength/><Lens/><CountryCode/><Country/><State/><City/><Keywords/></meta>', '2016-05-07 16:19:36', '2016-05-07 16:19:36', '2016-05-07 16:19:36', 0),
(11, 'admin', 'public', 'Project_20141203_1270.jpg', 'Welcome/Project_20141203_1270.jpg', 'Welcome', '<meta><Title/><Description/><Creator/><Rights/><Make/><Model/><Exposure/><FNumber/><MaxApertureValue/><ExposureProgram/><ISOSpeedRatings/><DateTimeOriginal></DateTimeOriginal><ExposureBiasValue/><MeteringMode/><FocalLength/><Lens/><CountryCode/><Country/><State/><City/><Keywords/></meta>', '2016-05-07 16:19:36', '2016-05-07 16:19:36', '2016-05-07 16:19:36', 0),
(12, 'admin', 'public', 'Project_20141203_1271.jpg', 'Welcome/Project_20141203_1271.jpg', 'Welcome', '<meta><Title/><Description/><Creator/><Rights/><Make/><Model/><Exposure/><FNumber/><MaxApertureValue/><ExposureProgram/><ISOSpeedRatings/><DateTimeOriginal></DateTimeOriginal><ExposureBiasValue/><MeteringMode/><FocalLength/><Lens/><CountryCode/><Country/><State/><City/><Keywords/></meta>', '2016-05-07 16:19:37', '2016-05-07 16:19:37', '2016-05-07 16:19:37', 0),
(13, 'admin', 'public', 'Project_20141203_1272.jpg', 'Welcome/Project_20141203_1272.jpg', 'Welcome', '<meta><Title/><Description/><Creator/><Rights/><Make/><Model/><Exposure/><FNumber/><MaxApertureValue/><ExposureProgram/><ISOSpeedRatings/><DateTimeOriginal></DateTimeOriginal><ExposureBiasValue/><MeteringMode/><FocalLength/><Lens/><CountryCode/><Country/><State/><City/><Keywords/></meta>', '2016-05-07 16:19:38', '2016-05-07 16:19:38', '2016-05-07 16:19:38', 0),
(14, 'admin', 'public', 'Project_20141203_1273.jpg', 'Welcome/Project_20141203_1273.jpg', 'Welcome', '<meta><Title/><Description/><Creator/><Rights/><Make/><Model/><Exposure/><FNumber/><MaxApertureValue/><ExposureProgram/><ISOSpeedRatings/><DateTimeOriginal></DateTimeOriginal><ExposureBiasValue/><MeteringMode/><FocalLength/><Lens/><CountryCode/><Country/><State/><City/><Keywords/></meta>', '2016-05-07 16:19:38', '2016-05-07 16:19:38', '2016-05-07 16:19:38', 0),
(15, 'admin', 'public', 'Project_20141203_1274.jpg', 'Welcome/Project_20141203_1274.jpg', 'Welcome', '<meta><Title/><Description/><Creator/><Rights/><Make/><Model/><Exposure/><FNumber/><MaxApertureValue/><ExposureProgram/><ISOSpeedRatings/><DateTimeOriginal></DateTimeOriginal><ExposureBiasValue/><MeteringMode/><FocalLength/><Lens/><CountryCode/><Country/><State/><City/><Keywords/></meta>', '2016-05-07 16:19:39', '2016-05-07 16:19:39', '2016-05-07 16:19:39', 0),
(16, 'admin', 'public', 'Project_20141203_1275.jpg', 'Welcome/Project_20141203_1275.jpg', 'Welcome', '<meta><Title/><Description/><Creator/><Rights/><Make/><Model/><Exposure/><FNumber/><MaxApertureValue/><ExposureProgram/><ISOSpeedRatings/><DateTimeOriginal></DateTimeOriginal><ExposureBiasValue/><MeteringMode/><FocalLength/><Lens/><CountryCode/><Country/><State/><City/><Keywords/></meta>', '2016-05-07 16:19:39', '2016-05-07 16:19:39', '2016-05-07 16:19:39', 0),
(17, 'admin', 'public', 'Project_20141203_1276.jpg', 'Welcome/Project_20141203_1276.jpg', 'Welcome', '<meta><Title/><Description/><Creator/><Rights/><Make/><Model/><Exposure/><FNumber/><MaxApertureValue/><ExposureProgram/><ISOSpeedRatings/><DateTimeOriginal></DateTimeOriginal><ExposureBiasValue/><MeteringMode/><FocalLength/><Lens/><CountryCode/><Country/><State/><City/><Keywords/></meta>', '2016-05-07 16:19:40', '2016-05-07 16:19:40', '2016-05-07 16:19:40', 0),
(18, 'admin', 'public', 'Project_20141203_1277.jpg', 'Welcome/Project_20141203_1277.jpg', 'Welcome', '<meta><Title/><Description/><Creator/><Rights/><Make/><Model/><Exposure/><FNumber/><MaxApertureValue/><ExposureProgram/><ISOSpeedRatings/><DateTimeOriginal></DateTimeOriginal><ExposureBiasValue/><MeteringMode/><FocalLength/><Lens/><CountryCode/><Country/><State/><City/><Keywords/></meta>', '2016-05-07 16:19:40', '2016-05-07 16:19:40', '2016-05-07 16:19:40', 0),
(19, 'admin', 'public', 'Project_20141203_1278.jpg', 'Welcome/Project_20141203_1278.jpg', 'Welcome', '<meta><Title/><Description/><Creator/><Rights/><Make/><Model/><Exposure/><FNumber/><MaxApertureValue/><ExposureProgram/><ISOSpeedRatings/><DateTimeOriginal></DateTimeOriginal><ExposureBiasValue/><MeteringMode/><FocalLength/><Lens/><CountryCode/><Country/><State/><City/><Keywords/></meta>', '2016-05-07 16:19:41', '2016-05-07 16:19:41', '2016-05-07 16:19:41', 0),
(20, 'admin', 'public', 'Project_20141203_1279.jpg', 'Welcome/Project_20141203_1279.jpg', 'Welcome', '<meta><Title/><Description/><Creator/><Rights/><Make/><Model/><Exposure/><FNumber/><MaxApertureValue/><ExposureProgram/><ISOSpeedRatings/><DateTimeOriginal></DateTimeOriginal><ExposureBiasValue/><MeteringMode/><FocalLength/><Lens/><CountryCode/><Country/><State/><City/><Keywords/></meta>', '2016-05-07 16:19:41', '2016-05-07 16:19:41', '2016-05-07 16:19:41', 0),
(21, 'admin', 'public', 'Project_20141203_1280.jpg', 'Welcome/Project_20141203_1280.jpg', 'Welcome', '<meta><Title/><Description/><Creator/><Rights/><Make/><Model/><Exposure/><FNumber/><MaxApertureValue/><ExposureProgram/><ISOSpeedRatings/><DateTimeOriginal></DateTimeOriginal><ExposureBiasValue/><MeteringMode/><FocalLength/><Lens/><CountryCode/><Country/><State/><City/><Keywords/></meta>', '2016-05-07 16:19:42', '2016-05-07 16:19:42', '2016-05-07 16:19:42', 0),
(22, 'admin', 'public', 'Project_20141203_1281.jpg', 'Welcome/Project_20141203_1281.jpg', 'Welcome', '<meta><Title/><Description/><Creator/><Rights/><Make/><Model/><Exposure/><FNumber/><MaxApertureValue/><ExposureProgram/><ISOSpeedRatings/><DateTimeOriginal></DateTimeOriginal><ExposureBiasValue/><MeteringMode/><FocalLength/><Lens/><CountryCode/><Country/><State/><City/><Keywords/></meta>', '2016-05-07 16:19:42', '2016-05-07 16:19:42', '2016-05-07 16:19:42', 0),
(23, 'admin', 'public', 'Project_20141203_1282.jpg', 'Welcome/Project_20141203_1282.jpg', 'Welcome', '<meta><Title/><Description/><Creator/><Rights/><Make/><Model/><Exposure/><FNumber/><MaxApertureValue/><ExposureProgram/><ISOSpeedRatings/><DateTimeOriginal></DateTimeOriginal><ExposureBiasValue/><MeteringMode/><FocalLength/><Lens/><CountryCode/><Country/><State/><City/><Keywords/></meta>', '2016-05-07 16:19:43', '2016-05-07 16:19:43', '2016-05-07 16:19:43', 0),
(24, 'admin', 'public', 'Project_20141203_1283.jpg', 'Welcome/Project_20141203_1283.jpg', 'Welcome', '<meta><Title/><Description/><Creator/><Rights/><Make/><Model/><Exposure/><FNumber/><MaxApertureValue/><ExposureProgram/><ISOSpeedRatings/><DateTimeOriginal></DateTimeOriginal><ExposureBiasValue/><MeteringMode/><FocalLength/><Lens/><CountryCode/><Country/><State/><City/><Keywords/></meta>', '2016-05-07 16:19:43', '2016-05-07 16:19:43', '2016-05-07 16:19:43', 0),
(25, 'admin', 'public', 'Project_20141203_1284.jpg', 'Welcome/Project_20141203_1284.jpg', 'Welcome', '<meta><Title/><Description/><Creator/><Rights/><Make/><Model/><Exposure/><FNumber/><MaxApertureValue/><ExposureProgram/><ISOSpeedRatings/><DateTimeOriginal></DateTimeOriginal><ExposureBiasValue/><MeteringMode/><FocalLength/><Lens/><CountryCode/><Country/><State/><City/><Keywords/></meta>', '2016-05-07 16:19:44', '2016-05-07 16:19:44', '2016-05-07 16:19:44', 0),
(26, 'admin', 'public', 'Project_20141203_1285.jpg', 'Welcome/Project_20141203_1285.jpg', 'Welcome', '<meta><Title/><Description/><Creator/><Rights/><Make/><Model/><Exposure/><FNumber/><MaxApertureValue/><ExposureProgram/><ISOSpeedRatings/><DateTimeOriginal></DateTimeOriginal><ExposureBiasValue/><MeteringMode/><FocalLength/><Lens/><CountryCode/><Country/><State/><City/><Keywords/></meta>', '2016-05-07 16:19:44', '2016-05-07 16:19:44', '2016-05-07 16:19:44', 0),
(27, 'admin', 'public', 'Project_20141203_1286.jpg', 'Welcome/Project_20141203_1286.jpg', 'Welcome', '<meta><Title/><Description/><Creator/><Rights/><Make/><Model/><Exposure/><FNumber/><MaxApertureValue/><ExposureProgram/><ISOSpeedRatings/><DateTimeOriginal></DateTimeOriginal><ExposureBiasValue/><MeteringMode/><FocalLength/><Lens/><CountryCode/><Country/><State/><City/><Keywords/></meta>', '2016-05-07 16:19:45', '2016-05-07 16:19:45', '2016-05-07 16:19:45', 0),
(28, 'admin', 'public', 'Project_20141203_1287.jpg', 'Welcome/Project_20141203_1287.jpg', 'Welcome', '<meta><Title/><Description/><Creator/><Rights/><Make/><Model/><Exposure/><FNumber/><MaxApertureValue/><ExposureProgram/><ISOSpeedRatings/><DateTimeOriginal></DateTimeOriginal><ExposureBiasValue/><MeteringMode/><FocalLength/><Lens/><CountryCode/><Country/><State/><City/><Keywords/></meta>', '2016-05-07 16:19:45', '2016-05-07 16:19:45', '2016-05-07 16:19:45', 0),
(29, 'admin', 'public', 'Project_20141203_1288.jpg', 'Welcome/Project_20141203_1288.jpg', 'Welcome', '<meta><Title/><Description/><Creator/><Rights/><Make/><Model/><Exposure/><FNumber/><MaxApertureValue/><ExposureProgram/><ISOSpeedRatings/><DateTimeOriginal></DateTimeOriginal><ExposureBiasValue/><MeteringMode/><FocalLength/><Lens/><CountryCode/><Country/><State/><City/><Keywords/></meta>', '2016-05-07 16:19:46', '2016-05-07 16:19:46', '2016-05-07 16:19:46', 0),
(30, 'admin', 'public', 'Project_20141203_1289.jpg', 'Welcome/Project_20141203_1289.jpg', 'Welcome', '<meta><Title/><Description/><Creator/><Rights/><Make/><Model/><Exposure/><FNumber/><MaxApertureValue/><ExposureProgram/><ISOSpeedRatings/><DateTimeOriginal></DateTimeOriginal><ExposureBiasValue/><MeteringMode/><FocalLength/><Lens/><CountryCode/><Country/><State/><City/><Keywords/></meta>', '2016-05-07 16:19:46', '2016-05-07 16:19:46', '2016-05-07 16:19:46', 0),
(31, 'admin', 'public', 'Project_20141203_1290.jpg', 'Welcome/Project_20141203_1290.jpg', 'Welcome', '<meta><Title/><Description/><Creator/><Rights/><Make/><Model/><Exposure/><FNumber/><MaxApertureValue/><ExposureProgram/><ISOSpeedRatings/><DateTimeOriginal></DateTimeOriginal><ExposureBiasValue/><MeteringMode/><FocalLength/><Lens/><CountryCode/><Country/><State/><City/><Keywords/></meta>', '2016-05-07 16:19:47', '2016-05-07 16:19:47', '2016-05-07 16:19:47', 0),
(32, 'admin', 'public', 'Project_20141203_1291.jpg', 'Welcome/Project_20141203_1291.jpg', 'Welcome', '<meta><Title/><Description/><Creator/><Rights/><Make/><Model/><Exposure/><FNumber/><MaxApertureValue/><ExposureProgram/><ISOSpeedRatings/><DateTimeOriginal></DateTimeOriginal><ExposureBiasValue/><MeteringMode/><FocalLength/><Lens/><CountryCode/><Country/><State/><City/><Keywords/></meta>', '2016-05-07 16:19:47', '2016-05-07 16:19:47', '2016-05-07 16:19:47', 0),
(33, 'admin', 'public', 'Project_20141203_1292.jpg', 'Welcome/Project_20141203_1292.jpg', 'Welcome', '<meta><Title/><Description/><Creator/><Rights/><Make/><Model/><Exposure/><FNumber/><MaxApertureValue/><ExposureProgram/><ISOSpeedRatings/><DateTimeOriginal></DateTimeOriginal><ExposureBiasValue/><MeteringMode/><FocalLength/><Lens/><CountryCode/><Country/><State/><City/><Keywords/></meta>', '2016-05-07 16:19:48', '2016-05-07 16:19:48', '2016-05-07 16:19:48', 0),
(34, 'admin', 'public', 'Project_20141203_1293.jpg', 'Welcome/Project_20141203_1293.jpg', 'Welcome', '<meta><Title/><Description/><Creator/><Rights/><Make/><Model/><Exposure/><FNumber/><MaxApertureValue/><ExposureProgram/><ISOSpeedRatings/><DateTimeOriginal></DateTimeOriginal><ExposureBiasValue/><MeteringMode/><FocalLength/><Lens/><CountryCode/><Country/><State/><City/><Keywords/></meta>', '2016-05-07 16:19:48', '2016-05-07 16:19:48', '2016-05-07 16:19:48', 0),
(35, 'admin', 'public', 'Project_20141203_1294.jpg', 'Welcome/Project_20141203_1294.jpg', 'Welcome', '<meta><Title/><Description/><Creator/><Rights/><Make/><Model/><Exposure/><FNumber/><MaxApertureValue/><ExposureProgram/><ISOSpeedRatings/><DateTimeOriginal></DateTimeOriginal><ExposureBiasValue/><MeteringMode/><FocalLength/><Lens/><CountryCode/><Country/><State/><City/><Keywords/></meta>', '2016-05-07 16:19:48', '2016-05-07 16:19:48', '2016-05-07 16:19:48', 0),
(36, 'admin', 'public', 'Project_20141203_1295.jpg', 'Welcome/Project_20141203_1295.jpg', 'Welcome', '<meta><Title/><Description/><Creator/><Rights/><Make/><Model/><Exposure/><FNumber/><MaxApertureValue/><ExposureProgram/><ISOSpeedRatings/><DateTimeOriginal></DateTimeOriginal><ExposureBiasValue/><MeteringMode/><FocalLength/><Lens/><CountryCode/><Country/><State/><City/><Keywords/></meta>', '2016-05-07 16:19:49', '2016-05-07 16:19:49', '2016-05-07 16:19:49', 0),
(37, 'admin', 'public', 'Project_20141203_1296.jpg', 'Welcome/Project_20141203_1296.jpg', 'Welcome', '<meta><Title/><Description/><Creator/><Rights/><Make/><Model/><Exposure/><FNumber/><MaxApertureValue/><ExposureProgram/><ISOSpeedRatings/><DateTimeOriginal></DateTimeOriginal><ExposureBiasValue/><MeteringMode/><FocalLength/><Lens/><CountryCode/><Country/><State/><City/><Keywords/></meta>', '2016-05-07 16:19:49', '2016-05-07 16:19:49', '2016-05-07 16:19:49', 0),
(38, 'admin', 'public', 'Project_20141203_1297.jpg', 'Welcome/Project_20141203_1297.jpg', 'Welcome', '<meta><Title/><Description/><Creator/><Rights/><Make/><Model/><Exposure/><FNumber/><MaxApertureValue/><ExposureProgram/><ISOSpeedRatings/><DateTimeOriginal></DateTimeOriginal><ExposureBiasValue/><MeteringMode/><FocalLength/><Lens/><CountryCode/><Country/><State/><City/><Keywords/></meta>', '2016-05-07 16:19:50', '2016-05-07 16:19:50', '2016-05-07 16:19:50', 0),
(39, 'admin', 'public', 'Project_20141203_1298.jpg', 'Welcome/Project_20141203_1298.jpg', 'Welcome', '<meta><Title/><Description/><Creator/><Rights/><Make/><Model/><Exposure/><FNumber/><MaxApertureValue/><ExposureProgram/><ISOSpeedRatings/><DateTimeOriginal></DateTimeOriginal><ExposureBiasValue/><MeteringMode/><FocalLength/><Lens/><CountryCode/><Country/><State/><City/><Keywords/></meta>', '2016-05-07 16:19:50', '2016-05-07 16:19:50', '2016-05-07 16:19:50', 0),
(40, 'admin', 'public', 'Project_20141203_1299.jpg', 'Welcome/Project_20141203_1299.jpg', 'Welcome', '<meta><Title/><Description/><Creator/><Rights/><Make/><Model/><Exposure/><FNumber/><MaxApertureValue/><ExposureProgram/><ISOSpeedRatings/><DateTimeOriginal></DateTimeOriginal><ExposureBiasValue/><MeteringMode/><FocalLength/><Lens/><CountryCode/><Country/><State/><City/><Keywords/></meta>', '2016-05-07 16:19:51', '2016-05-07 16:19:51', '2016-05-07 16:19:51', 0),
(41, 'admin', 'public', 'Project_20141203_1300.jpg', 'Welcome/Project_20141203_1300.jpg', 'Welcome', '<meta><Title/><Description/><Creator/><Rights/><Make/><Model/><Exposure/><FNumber/><MaxApertureValue/><ExposureProgram/><ISOSpeedRatings/><DateTimeOriginal></DateTimeOriginal><ExposureBiasValue/><MeteringMode/><FocalLength/><Lens/><CountryCode/><Country/><State/><City/><Keywords/></meta>', '2016-05-07 16:19:51', '2016-05-07 16:19:51', '2016-05-07 16:19:51', 0),
(42, 'admin', 'public', 'Project_20141203_1301.jpg', 'Welcome/Project_20141203_1301.jpg', 'Welcome', '<meta><Title/><Description/><Creator/><Rights/><Make/><Model/><Exposure/><FNumber/><MaxApertureValue/><ExposureProgram/><ISOSpeedRatings/><DateTimeOriginal></DateTimeOriginal><ExposureBiasValue/><MeteringMode/><FocalLength/><Lens/><CountryCode/><Country/><State/><City/><Keywords/></meta>', '2016-05-07 16:19:52', '2016-05-07 16:19:52', '2016-05-07 16:19:52', 0);

-- --------------------------------------------------------

--
-- Table structure for table `dc_meta`
--

CREATE TABLE IF NOT EXISTS `dc_meta` (
  `meta_id` varchar(255) COLLATE utf8_bin NOT NULL,
  `meta_type` varchar(64) COLLATE utf8_bin NOT NULL,
  `post_id` bigint(20) NOT NULL,
  PRIMARY KEY (`meta_id`,`meta_type`,`post_id`),
  KEY `dc_idx_meta_post_id` (`post_id`) USING BTREE,
  KEY `dc_idx_meta_meta_type` (`meta_type`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Table structure for table `dc_permissions`
--

CREATE TABLE IF NOT EXISTS `dc_permissions` (
  `user_id` varchar(32) COLLATE utf8_bin NOT NULL,
  `blog_id` varchar(32) COLLATE utf8_bin NOT NULL,
  `permissions` longtext COLLATE utf8_bin,
  PRIMARY KEY (`user_id`,`blog_id`),
  KEY `dc_idx_permissions_blog_id` (`blog_id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Table structure for table `dc_ping`
--

CREATE TABLE IF NOT EXISTS `dc_ping` (
  `post_id` bigint(20) NOT NULL,
  `ping_url` varchar(255) COLLATE utf8_bin NOT NULL,
  `ping_dt` datetime NOT NULL DEFAULT '1970-01-01 00:00:00',
  PRIMARY KEY (`post_id`,`ping_url`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Table structure for table `dc_post`
--

CREATE TABLE IF NOT EXISTS `dc_post` (
  `post_id` bigint(20) NOT NULL,
  `blog_id` varchar(32) COLLATE utf8_bin NOT NULL,
  `user_id` varchar(32) COLLATE utf8_bin NOT NULL,
  `cat_id` bigint(20) DEFAULT NULL,
  `post_dt` datetime NOT NULL DEFAULT '1970-01-01 00:00:00',
  `post_tz` varchar(128) COLLATE utf8_bin NOT NULL DEFAULT 'UTC',
  `post_creadt` datetime NOT NULL DEFAULT '1970-01-01 00:00:00',
  `post_upddt` datetime NOT NULL DEFAULT '1970-01-01 00:00:00',
  `post_password` varchar(32) COLLATE utf8_bin DEFAULT NULL,
  `post_type` varchar(32) COLLATE utf8_bin NOT NULL DEFAULT 'post',
  `post_format` varchar(32) COLLATE utf8_bin NOT NULL DEFAULT 'xhtml',
  `post_url` varchar(255) COLLATE utf8_bin NOT NULL,
  `post_lang` varchar(5) COLLATE utf8_bin DEFAULT NULL,
  `post_title` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `post_excerpt` longtext COLLATE utf8_bin,
  `post_excerpt_xhtml` longtext COLLATE utf8_bin,
  `post_content` longtext COLLATE utf8_bin,
  `post_content_xhtml` longtext COLLATE utf8_bin NOT NULL,
  `post_notes` longtext COLLATE utf8_bin,
  `post_meta` longtext COLLATE utf8_bin,
  `post_words` longtext COLLATE utf8_bin,
  `post_status` smallint(6) NOT NULL DEFAULT '0',
  `post_selected` smallint(6) NOT NULL DEFAULT '0',
  `post_position` int(11) NOT NULL DEFAULT '0',
  `post_open_comment` smallint(6) NOT NULL DEFAULT '0',
  `post_open_tb` smallint(6) NOT NULL DEFAULT '0',
  `nb_comment` int(11) NOT NULL DEFAULT '0',
  `nb_trackback` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`post_id`),
  UNIQUE KEY `dc_uk_post_url` (`post_url`,`post_type`,`blog_id`),
  KEY `dc_idx_post_cat_id` (`cat_id`) USING BTREE,
  KEY `dc_idx_post_user_id` (`user_id`) USING BTREE,
  KEY `dc_idx_post_blog_id` (`blog_id`) USING BTREE,
  KEY `dc_idx_post_post_dt` (`post_dt`) USING BTREE,
  KEY `dc_idx_post_post_dt_post_id` (`post_dt`,`post_id`) USING BTREE,
  KEY `dc_idx_blog_post_post_dt_post_id` (`blog_id`,`post_dt`,`post_id`) USING BTREE,
  KEY `dc_idx_blog_post_post_status` (`blog_id`,`post_status`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `dc_post`
--

INSERT INTO `dc_post` (`post_id`, `blog_id`, `user_id`, `cat_id`, `post_dt`, `post_tz`, `post_creadt`, `post_upddt`, `post_password`, `post_type`, `post_format`, `post_url`, `post_lang`, `post_title`, `post_excerpt`, `post_excerpt_xhtml`, `post_content`, `post_content_xhtml`, `post_notes`, `post_meta`, `post_words`, `post_status`, `post_selected`, `post_position`, `post_open_comment`, `post_open_tb`, `nb_comment`, `nb_trackback`) VALUES
(1, 'default', 'admin', NULL, '2016-05-07 17:18:00', 'Europe/London', '2016-05-07 16:18:18', '2016-05-07 16:18:18', NULL, 'post', 'xhtml', '2016/05/07/Welcome-to-Dotclear!', 'en', 'Welcome to Dotclear!', NULL, '', '<p>This is your first entry. When you''re ready to blog, log in to edit or delete it.</p>', '<p>This is your first entry. When you''re ready to blog, log in to edit or delete it.</p>', NULL, NULL, 'welcome dotclear this your first entry when you ready blog log edit delete', 1, 0, 0, 1, 0, 1, 0),
(2, 'default', 'admin', NULL, '2016-05-07 17:18:00', 'Europe/London', '2016-05-07 16:18:19', '2016-05-07 16:18:19', NULL, 'page', 'xhtml', '2016/05/07/My-first-page', 'en', 'My first page', '', '', '<p>This is your first page. When you''re ready to blog, log in to edit or delete it.</p>', '<p>This is your first page. When you''re ready to blog, log in to edit or delete it.</p>', NULL, NULL, 'first page this your first page when you ready blog log edit delete', -2, 0, 0, 0, 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `dc_post_media`
--

CREATE TABLE IF NOT EXISTS `dc_post_media` (
  `media_id` bigint(20) NOT NULL,
  `post_id` bigint(20) NOT NULL,
  `link_type` varchar(32) COLLATE utf8_bin NOT NULL DEFAULT 'attachment',
  PRIMARY KEY (`media_id`,`post_id`,`link_type`),
  KEY `dc_idx_post_media_post_id` (`post_id`) USING BTREE,
  KEY `dc_idx_post_media_media_id` (`media_id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `dc_post_media`
--

INSERT INTO `dc_post_media` (`media_id`, `post_id`, `link_type`) VALUES
(1, 1, 'attachment');

-- --------------------------------------------------------

--
-- Table structure for table `dc_pref`
--

CREATE TABLE IF NOT EXISTS `dc_pref` (
  `pref_id` varchar(255) COLLATE utf8_bin NOT NULL,
  `user_id` varchar(32) COLLATE utf8_bin DEFAULT NULL,
  `pref_ws` varchar(32) COLLATE utf8_bin NOT NULL DEFAULT 'system',
  `pref_value` longtext COLLATE utf8_bin,
  `pref_type` varchar(8) COLLATE utf8_bin NOT NULL DEFAULT 'string',
  `pref_label` longtext COLLATE utf8_bin,
  UNIQUE KEY `dc_uk_pref` (`pref_ws`,`pref_id`,`user_id`),
  KEY `dc_idx_pref_user_id` (`user_id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `dc_pref`
--

INSERT INTO `dc_pref` (`pref_id`, `user_id`, `pref_ws`, `pref_value`, `pref_type`, `pref_label`) VALUES
('doclinks', NULL, 'dashboard', '1', 'boolean', ''),
('dcnews', NULL, 'dashboard', '1', 'boolean', ''),
('quickentry', NULL, 'dashboard', '1', 'boolean', ''),
('nodragdrop', NULL, 'accessibility', '0', 'boolean', ''),
('enhanceduploader', NULL, 'interface', '1', 'boolean', ''),
('favorites', NULL, 'dashboard', '[]', 'array', 'User favorites'),
('favorites', 'admin', 'dashboard', '[]', 'array', NULL),
('favorites', NULL, 'dashboard', '["posts","new_post","newpage","comments","categories","media","blog_theme","widgets","simpleMenu","prefs","help"]', 'array', NULL),
('quickentry', 'admin', 'dashboard', '0', 'boolean', ''),
('unfolded_sections', NULL, 'toggles', '', 'string', 'Folded sections in admin'),
('unfolded_sections', 'admin', 'toggles', 'dcx_attachments', 'string', 'Folded sections in admin');

-- --------------------------------------------------------

--
-- Table structure for table `dc_session`
--

CREATE TABLE IF NOT EXISTS `dc_session` (
  `ses_id` varchar(40) COLLATE utf8_bin NOT NULL,
  `ses_time` int(11) NOT NULL DEFAULT '0',
  `ses_start` int(11) NOT NULL DEFAULT '0',
  `ses_value` longtext COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`ses_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `dc_session`
--

INSERT INTO `dc_session` (`ses_id`, `ses_time`, `ses_start`, `ses_value`) VALUES
('8e731e25221baabd7726bb08b93949c6f0896e5a', 1462638115, 1462637905, 'sess_user_id|s:5:"admin";sess_browser_uid|s:40:"2cb5398af9df61e3bf42c5457d701aae5447cf77";sess_blog_id|s:7:"default";media_manager_dir|s:7:"Welcome";');

-- --------------------------------------------------------

--
-- Table structure for table `dc_setting`
--

CREATE TABLE IF NOT EXISTS `dc_setting` (
  `setting_id` varchar(255) COLLATE utf8_bin NOT NULL,
  `blog_id` varchar(32) COLLATE utf8_bin DEFAULT NULL,
  `setting_ns` varchar(32) COLLATE utf8_bin NOT NULL DEFAULT 'system',
  `setting_value` longtext COLLATE utf8_bin,
  `setting_type` varchar(8) COLLATE utf8_bin NOT NULL DEFAULT 'string',
  `setting_label` longtext COLLATE utf8_bin,
  UNIQUE KEY `dc_uk_setting` (`setting_ns`,`setting_id`,`blog_id`),
  KEY `dc_idx_setting_blog_id` (`blog_id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `dc_setting`
--

INSERT INTO `dc_setting` (`setting_id`, `blog_id`, `setting_ns`, `setting_value`, `setting_type`, `setting_label`) VALUES
('allow_comments', NULL, 'system', '1', 'boolean', 'Allow comments on blog'),
('allow_trackbacks', NULL, 'system', '1', 'boolean', 'Allow trackbacks on blog'),
('blog_timezone', NULL, 'system', 'Europe/London', 'string', 'Blog timezone'),
('comments_nofollow', NULL, 'system', '1', 'boolean', 'Add rel="nofollow" to comments URLs'),
('comments_pub', NULL, 'system', '1', 'boolean', 'Publish comments immediately'),
('comments_ttl', NULL, 'system', '0', 'integer', 'Number of days to keep comments open (0 means no ttl)'),
('copyright_notice', NULL, 'system', '', 'string', 'Copyright notice (simple text)'),
('date_format', NULL, 'system', '%A, %B %e %Y', 'string', 'Date format. See PHP strftime function for patterns'),
('editor', NULL, 'system', '', 'string', 'Person responsible of the content'),
('enable_html_filter', NULL, 'system', '0', 'boolean', 'Enable HTML filter'),
('enable_xmlrpc', NULL, 'system', '0', 'boolean', 'Enable XML/RPC interface'),
('lang', NULL, 'system', 'en', 'string', 'Default blog language'),
('media_exclusion', NULL, 'system', '/\\.(phps?|pht(ml)?|phl|s?html?|js)[0-9]*$/i', 'string', 'File name exclusion pattern in media manager. (PCRE value)'),
('media_img_m_size', NULL, 'system', '448', 'integer', 'Image medium size in media manager'),
('media_img_s_size', NULL, 'system', '240', 'integer', 'Image small size in media manager'),
('media_img_t_size', NULL, 'system', '100', 'integer', 'Image thumbnail size in media manager'),
('media_img_title_pattern', NULL, 'system', 'Title ;; Date(%b %Y) ;; separator(, )', 'string', 'Pattern to set image title when you insert it in a post'),
('media_video_width', NULL, 'system', '400', 'integer', 'Video width in media manager'),
('media_video_height', NULL, 'system', '300', 'integer', 'Video height in media manager'),
('media_flash_fallback', NULL, 'system', '1', 'boolean', 'Flash player fallback for audio and video media'),
('nb_post_for_home', NULL, 'system', '20', 'integer', 'Number of entries on first home page'),
('nb_post_per_page', NULL, 'system', '20', 'integer', 'Number of entries on home pages and category pages'),
('nb_post_per_feed', NULL, 'system', '20', 'integer', 'Number of entries on feeds'),
('nb_comment_per_feed', NULL, 'system', '20', 'integer', 'Number of comments on feeds'),
('post_url_format', NULL, 'system', '{y}/{m}/{d}/{t}', 'string', 'Post URL format. {y}: year, {m}: month, {d}: day, {id}: post id, {t}: entry title'),
('public_path', NULL, 'system', 'public', 'string', 'Path to public directory, begins with a / for a full system path'),
('public_url', NULL, 'system', '/public', 'string', 'URL to public directory'),
('robots_policy', NULL, 'system', 'INDEX,FOLLOW', 'string', 'Search engines robots policy'),
('short_feed_items', NULL, 'system', '0', 'boolean', 'Display short feed items'),
('theme', NULL, 'system', 'berlin', 'string', 'Blog theme'),
('themes_path', NULL, 'system', 'themes', 'string', 'Themes root path'),
('themes_url', NULL, 'system', '/themes', 'string', 'Themes root URL'),
('time_format', NULL, 'system', '%H:%M', 'string', 'Time format. See PHP strftime function for patterns'),
('tpl_allow_php', NULL, 'system', '0', 'boolean', 'Allow PHP code in templates'),
('tpl_use_cache', NULL, 'system', '1', 'boolean', 'Use template caching'),
('trackbacks_pub', NULL, 'system', '1', 'boolean', 'Publish trackbacks immediately'),
('trackbacks_ttl', NULL, 'system', '0', 'integer', 'Number of days to keep trackbacks open (0 means no ttl)'),
('url_scan', NULL, 'system', 'query_string', 'string', 'URL handle mode (path_info or query_string)'),
('use_smilies', NULL, 'system', '0', 'boolean', 'Show smilies on entries and comments'),
('no_search', NULL, 'system', '0', 'boolean', 'Disable search'),
('inc_subcats', NULL, 'system', '0', 'boolean', 'Include sub-categories in category page and category posts feed'),
('wiki_comments', NULL, 'system', '0', 'boolean', 'Allow commenters to use a subset of wiki syntax'),
('date_formats', NULL, 'system', '["%Y-%m-%d","%m\\/%d\\/%Y","%d\\/%m\\/%Y","%Y\\/%m\\/%d","%d.%m.%Y","%b %e %Y","%e %b %Y","%Y %b %e","%a, %Y-%m-%d","%a, %m\\/%d\\/%Y","%a, %d\\/%m\\/%Y","%a, %Y\\/%m\\/%d","%B %e, %Y","%e %B, %Y","%Y, %B %e","%e. %B %Y","%A, %B %e, %Y","%A, %e %B, %Y","%A, %Y, %B %e","%A, %Y, %B %e","%A, %e. %B %Y"]', 'array', 'Date formats examples'),
('time_formats', NULL, 'system', '["%H:%M","%I:%M","%l:%M","%Hh%M","%Ih%M","%lh%M"]', 'array', 'Time formats examples'),
('store_plugin_url', NULL, 'system', 'http://update.dotaddict.org/dc2/plugins.xml', 'string', 'Plugins XML feed location'),
('store_theme_url', NULL, 'system', 'http://update.dotaddict.org/dc2/themes.xml', 'string', 'Themes XML feed location'),
('antispam_moderation_ttl', NULL, 'antispam', '0', 'integer', 'Antispam Moderation TTL (days)'),
('firstpage', 'default', 'pages', '1', 'boolean', NULL),
('blowup_style', NULL, 'themes', '', 'string', 'Blow Up  custom style'),
('active', NULL, 'dcckeditor', '1', 'boolean', 'dcCKEditor plugin activated?'),
('alignment_buttons', NULL, 'dcckeditor', '1', 'boolean', 'Add alignment buttons?'),
('list_buttons', NULL, 'dcckeditor', '1', 'boolean', 'Add list buttons?'),
('textcolor_button', NULL, 'dcckeditor', '0', 'boolean', 'Add text color button?'),
('background_textcolor_button', NULL, 'dcckeditor', '0', 'boolean', 'Add background text color button?'),
('cancollapse_button', NULL, 'dcckeditor', '0', 'boolean', 'Add collapse button?'),
('format_select', NULL, 'dcckeditor', '1', 'boolean', 'Add format selection?'),
('format_tags', NULL, 'dcckeditor', 'p;h1;h2;h3;h4;h5;h6;pre;address', 'string', 'Custom formats'),
('table_button', NULL, 'dcckeditor', '0', 'boolean', 'Add table button?'),
('clipboard_buttons', NULL, 'dcckeditor', '0', 'boolean', 'Add clipboard buttons?'),
('disable_native_spellchecker', NULL, 'dcckeditor', '1', 'boolean', 'Disables the built-in spell checker if the browser provides one?'),
('active', NULL, 'dclegacyeditor', '1', 'boolean', 'dcLegacyEditor plugin activated ?'),
('simpleMenu', NULL, 'system', '[{"label":"Home","descr":"Recent posts","url":"\\/index.php?"},{"label":"Archives","descr":"","url":"\\/index.php?archive"}]', 'array', 'simpleMenu default menu'),
('simpleMenu_active', NULL, 'system', '1', 'boolean', 'Active'),
('widgets_nav', 'default', 'widgets', '', 'string', 'Navigation widgets'),
('widgets_extra', 'default', 'widgets', '', 'string', 'Extra widgets'),
('widgets_custom', 'default', 'widgets', '', 'string', 'Custom widgets'),
('pings_active', NULL, 'pings', '1', 'boolean', 'Activate pings plugin'),
('pings_uris', NULL, 'pings', '{"Ping-o-Matic!":"http:\\/\\/rpc.pingomatic.com\\/","Google Blog Search":"http:\\/\\/blogsearch.google.com\\/ping\\/RPC2"}', 'array', 'Pings services URIs'),
('jquery_migrate_mute', 'default', 'system', '1', 'boolean', 'Mute warnings for jquery migrate plugin ?'),
('antispam_date_last_purge', 'default', 'antispam', '1463168928', 'integer', 'Antispam Date Last Purge (unix timestamp)');

-- --------------------------------------------------------

--
-- Table structure for table `dc_spamrule`
--

CREATE TABLE IF NOT EXISTS `dc_spamrule` (
  `rule_id` bigint(20) NOT NULL,
  `blog_id` varchar(32) COLLATE utf8_bin DEFAULT NULL,
  `rule_type` varchar(16) COLLATE utf8_bin NOT NULL DEFAULT 'word',
  `rule_content` varchar(128) COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`rule_id`),
  KEY `dc_idx_spamrule_blog_id` (`blog_id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `dc_spamrule`
--

INSERT INTO `dc_spamrule` (`rule_id`, `blog_id`, `rule_type`, `rule_content`) VALUES
(1, NULL, 'word', '/-credit(\\s+|$)/'),
(2, NULL, 'word', '/-digest(\\s+|$)/'),
(3, NULL, 'word', '/-loan(\\s+|$)/'),
(4, NULL, 'word', '/-online(\\s+|$)/'),
(5, NULL, 'word', '4u'),
(6, NULL, 'word', 'adipex'),
(7, NULL, 'word', 'advicer'),
(8, NULL, 'word', 'ambien'),
(9, NULL, 'word', 'baccarat'),
(10, NULL, 'word', 'baccarrat'),
(11, NULL, 'word', 'blackjack'),
(12, NULL, 'word', 'bllogspot'),
(13, NULL, 'word', 'bolobomb'),
(14, NULL, 'word', 'booker'),
(15, NULL, 'word', 'byob'),
(16, NULL, 'word', 'car-rental-e-site'),
(17, NULL, 'word', 'car-rentals-e-site'),
(18, NULL, 'word', 'carisoprodol'),
(19, NULL, 'word', 'cash'),
(20, NULL, 'word', 'casino'),
(21, NULL, 'word', 'casinos'),
(22, NULL, 'word', 'chatroom'),
(23, NULL, 'word', 'cialis'),
(24, NULL, 'word', 'craps'),
(25, NULL, 'word', 'credit-card'),
(26, NULL, 'word', 'credit-report-4u'),
(27, NULL, 'word', 'cwas'),
(28, NULL, 'word', 'cyclen'),
(29, NULL, 'word', 'cyclobenzaprine'),
(30, NULL, 'word', 'dating-e-site'),
(31, NULL, 'word', 'day-trading'),
(32, NULL, 'word', 'debt'),
(33, NULL, 'word', 'digest-'),
(34, NULL, 'word', 'discount'),
(35, NULL, 'word', 'discreetordering'),
(36, NULL, 'word', 'duty-free'),
(37, NULL, 'word', 'dutyfree'),
(38, NULL, 'word', 'estate'),
(39, NULL, 'word', 'favourits'),
(40, NULL, 'word', 'fioricet'),
(41, NULL, 'word', 'flowers-leading-site'),
(42, NULL, 'word', 'freenet'),
(43, NULL, 'word', 'freenet-shopping'),
(44, NULL, 'word', 'gambling'),
(45, NULL, 'word', 'gamias'),
(46, NULL, 'word', 'health-insurancedeals-4u'),
(47, NULL, 'word', 'holdem'),
(48, NULL, 'word', 'holdempoker'),
(49, NULL, 'word', 'holdemsoftware'),
(50, NULL, 'word', 'holdemtexasturbowilson'),
(51, NULL, 'word', 'hotel-dealse-site'),
(52, NULL, 'word', 'hotele-site'),
(53, NULL, 'word', 'hotelse-site'),
(54, NULL, 'word', 'incest'),
(55, NULL, 'word', 'insurance-quotesdeals-4u'),
(56, NULL, 'word', 'insurancedeals-4u'),
(57, NULL, 'word', 'jrcreations'),
(58, NULL, 'word', 'levitra'),
(59, NULL, 'word', 'macinstruct'),
(60, NULL, 'word', 'mortgage'),
(61, NULL, 'word', 'online-gambling'),
(62, NULL, 'word', 'onlinegambling-4u'),
(63, NULL, 'word', 'ottawavalleyag'),
(64, NULL, 'word', 'ownsthis'),
(65, NULL, 'word', 'palm-texas-holdem-game'),
(66, NULL, 'word', 'paxil'),
(67, NULL, 'word', 'pharmacy'),
(68, NULL, 'word', 'phentermine'),
(69, NULL, 'word', 'pills'),
(70, NULL, 'word', 'poker'),
(71, NULL, 'word', 'poker-chip'),
(72, NULL, 'word', 'poze'),
(73, NULL, 'word', 'prescription'),
(74, NULL, 'word', 'rarehomes'),
(75, NULL, 'word', 'refund'),
(76, NULL, 'word', 'rental-car-e-site'),
(77, NULL, 'word', 'roulette'),
(78, NULL, 'word', 'shemale'),
(79, NULL, 'word', 'slot'),
(80, NULL, 'word', 'slot-machine'),
(81, NULL, 'word', 'soma'),
(82, NULL, 'word', 'taboo'),
(83, NULL, 'word', 'tamiflu'),
(84, NULL, 'word', 'texas-holdem'),
(85, NULL, 'word', 'thorcarlson'),
(86, NULL, 'word', 'top-e-site'),
(87, NULL, 'word', 'top-site'),
(88, NULL, 'word', 'tramadol'),
(89, NULL, 'word', 'trim-spa'),
(90, NULL, 'word', 'ultram'),
(91, NULL, 'word', 'v1h'),
(92, NULL, 'word', 'vacuum'),
(93, NULL, 'word', 'valeofglamorganconservatives'),
(94, NULL, 'word', 'viagra'),
(95, NULL, 'word', 'vicodin'),
(96, NULL, 'word', 'vioxx'),
(97, NULL, 'word', 'xanax'),
(98, NULL, 'word', 'zolus');

-- --------------------------------------------------------

--
-- Table structure for table `dc_user`
--

CREATE TABLE IF NOT EXISTS `dc_user` (
  `user_id` varchar(32) COLLATE utf8_bin NOT NULL,
  `user_super` smallint(6) DEFAULT NULL,
  `user_status` smallint(6) NOT NULL DEFAULT '1',
  `user_pwd` varchar(40) COLLATE utf8_bin NOT NULL,
  `user_change_pwd` smallint(6) NOT NULL DEFAULT '0',
  `user_recover_key` varchar(32) COLLATE utf8_bin DEFAULT NULL,
  `user_name` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `user_firstname` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `user_displayname` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `user_email` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `user_url` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `user_desc` longtext COLLATE utf8_bin,
  `user_default_blog` varchar(32) COLLATE utf8_bin DEFAULT NULL,
  `user_options` longtext COLLATE utf8_bin,
  `user_lang` varchar(5) COLLATE utf8_bin DEFAULT NULL,
  `user_tz` varchar(128) COLLATE utf8_bin NOT NULL DEFAULT 'UTC',
  `user_post_status` smallint(6) NOT NULL DEFAULT '-2',
  `user_creadt` datetime NOT NULL DEFAULT '1970-01-01 00:00:00',
  `user_upddt` datetime NOT NULL DEFAULT '1970-01-01 00:00:00',
  PRIMARY KEY (`user_id`),
  KEY `dc_idx_user_user_default_blog` (`user_default_blog`) USING BTREE,
  KEY `dc_idx_user_user_super` (`user_super`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `dc_user`
--

INSERT INTO `dc_user` (`user_id`, `user_super`, `user_status`, `user_pwd`, `user_change_pwd`, `user_recover_key`, `user_name`, `user_firstname`, `user_displayname`, `user_email`, `user_url`, `user_desc`, `user_default_blog`, `user_options`, `user_lang`, `user_tz`, `user_post_status`, `user_creadt`, `user_upddt`) VALUES
('admin', 1, 1, '40335a023dfd1616c00b12182cb4f9f56213468e', 0, NULL, 'Hernandez', 'David', NULL, 'soporte@cachira.com', NULL, NULL, NULL, 'a:5:{s:9:"edit_size";i:24;s:14:"enable_wysiwyg";b:1;s:14:"toolbar_bottom";b:0;s:6:"editor";a:2:{s:5:"xhtml";s:10:"dcCKEditor";s:4:"wiki";s:14:"dcLegacyEditor";}s:11:"post_format";s:4:"wiki";}', 'en', 'Europe/London', -2, '2016-05-07 16:18:18', '2016-05-07 16:18:18');

-- --------------------------------------------------------

--
-- Table structure for table `dc_version`
--

CREATE TABLE IF NOT EXISTS `dc_version` (
  `module` varchar(64) COLLATE utf8_bin NOT NULL,
  `version` varchar(32) COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`module`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `dc_version`
--

INSERT INTO `dc_version` (`module`, `version`) VALUES
('antispam', '1.4.1'),
('blogroll', '1.4'),
('blowupConfig', '1.2'),
('core', '2.9.1'),
('dcCKEditor', '1.1.0'),
('dcLegacyEditor', '0.1.3'),
('pages', '1.4'),
('simpleMenu', '1.3'),
('widgets', '3.3');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `dc_category`
--
ALTER TABLE `dc_category`
  ADD CONSTRAINT `dc_fk_category_blog` FOREIGN KEY (`blog_id`) REFERENCES `dc_blog` (`blog_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `dc_comment`
--
ALTER TABLE `dc_comment`
  ADD CONSTRAINT `dc_fk_comment_post` FOREIGN KEY (`post_id`) REFERENCES `dc_post` (`post_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `dc_link`
--
ALTER TABLE `dc_link`
  ADD CONSTRAINT `dc_fk_link_blog` FOREIGN KEY (`blog_id`) REFERENCES `dc_blog` (`blog_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `dc_log`
--
ALTER TABLE `dc_log`
  ADD CONSTRAINT `dc_fk_log_blog` FOREIGN KEY (`blog_id`) REFERENCES `dc_blog` (`blog_id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `dc_media`
--
ALTER TABLE `dc_media`
  ADD CONSTRAINT `dc_fk_media_user` FOREIGN KEY (`user_id`) REFERENCES `dc_user` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `dc_meta`
--
ALTER TABLE `dc_meta`
  ADD CONSTRAINT `dc_fk_meta_post` FOREIGN KEY (`post_id`) REFERENCES `dc_post` (`post_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `dc_permissions`
--
ALTER TABLE `dc_permissions`
  ADD CONSTRAINT `dc_fk_permissions_blog` FOREIGN KEY (`blog_id`) REFERENCES `dc_blog` (`blog_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `dc_fk_permissions_user` FOREIGN KEY (`user_id`) REFERENCES `dc_user` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `dc_ping`
--
ALTER TABLE `dc_ping`
  ADD CONSTRAINT `dc_fk_ping_post` FOREIGN KEY (`post_id`) REFERENCES `dc_post` (`post_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `dc_post`
--
ALTER TABLE `dc_post`
  ADD CONSTRAINT `dc_fk_post_blog` FOREIGN KEY (`blog_id`) REFERENCES `dc_blog` (`blog_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `dc_fk_post_category` FOREIGN KEY (`cat_id`) REFERENCES `dc_category` (`cat_id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `dc_fk_post_user` FOREIGN KEY (`user_id`) REFERENCES `dc_user` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `dc_post_media`
--
ALTER TABLE `dc_post_media`
  ADD CONSTRAINT `dc_fk_media` FOREIGN KEY (`media_id`) REFERENCES `dc_media` (`media_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `dc_fk_media_post` FOREIGN KEY (`post_id`) REFERENCES `dc_post` (`post_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `dc_pref`
--
ALTER TABLE `dc_pref`
  ADD CONSTRAINT `dc_fk_pref_user` FOREIGN KEY (`user_id`) REFERENCES `dc_user` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `dc_setting`
--
ALTER TABLE `dc_setting`
  ADD CONSTRAINT `dc_fk_setting_blog` FOREIGN KEY (`blog_id`) REFERENCES `dc_blog` (`blog_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `dc_spamrule`
--
ALTER TABLE `dc_spamrule`
  ADD CONSTRAINT `dc_fk_spamrule_blog` FOREIGN KEY (`blog_id`) REFERENCES `dc_blog` (`blog_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `dc_user`
--
ALTER TABLE `dc_user`
  ADD CONSTRAINT `dc_fk_user_default_blog` FOREIGN KEY (`user_default_blog`) REFERENCES `dc_blog` (`blog_id`) ON DELETE SET NULL ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
