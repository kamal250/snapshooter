-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jul 09, 2020 at 02:37 PM
-- Server version: 10.3.14-MariaDB
-- PHP Version: 7.1.29

SET FOREIGN_KEY_CHECKS=0;
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";

--
-- Database: `your_db_name`
--

-- --------------------------------------------------------

--
-- Table structure for table `do_droplets`
--

DROP TABLE IF EXISTS `do_droplets`;
CREATE TABLE IF NOT EXISTS `do_droplets` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `droplet_id` varchar(255) NOT NULL,
  `droplet_name` varchar(255) NOT NULL,
  `droplet_response` text NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `do_snapshots`
--

DROP TABLE IF EXISTS `do_snapshots`;
CREATE TABLE IF NOT EXISTS `do_snapshots` (
  `id` int(1) NOT NULL AUTO_INCREMENT,
  `snapshot_id` varchar(255) NOT NULL,
  `snapshot_name` varchar(255) NOT NULL,
  `droplet_id` varchar(255) NOT NULL,
  `started_at` datetime NOT NULL DEFAULT current_timestamp(),
  `snapshot_response` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

ALTER TABLE `do_snapshots`
  ADD CONSTRAINT `snapshot_droplet_fk` FOREIGN KEY (`droplet_id`) REFERENCES `do_droplets` (`droplet_id`) ON DELETE CASCADE ON UPDATE CASCADE;

SET FOREIGN_KEY_CHECKS=1;
COMMIT;
