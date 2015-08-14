-- phpMyAdmin SQL Dump
-- version 4.3.10
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jul 15, 2015 at 04:02 AM
-- Server version: 5.5.32-MariaDB
-- PHP Version: 5.5.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `rm`
--

-- --------------------------------------------------------

--
-- Table structure for table `system`
--

CREATE TABLE IF NOT EXISTS `system` (
  `id` int(11) NOT NULL COMMENT 'ID',
  `system_name` varchar(100) COLLATE utf8_unicode_ci NOT NULL COMMENT 'สาเหตุเชิงระบบ'
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `system`
--

INSERT INTO `system` (`id`, `system_name`) VALUES
(1, 'การฝึกอบรมปฐมนิเทศ'),
(2, 'การเข้าถึงข้อมูลข่าวสาร'),
(3, 'สิ่งแวดล้อม'),
(4, 'วัฒนธรรมขององค์กร'),
(5, 'ช่องทางการสื่อสาร'),
(6, 'สมรรถนะของเจ้าหน้าที่'),
(7, 'ภาระงาน'),
(8, 'การออกแบบระบบงาน'),
(9, 'การนิเทศ ควบคุม กำกับ'),
(10, 'ความบกพร่องของเครื่องมือ'),
(11, 'อื่นๆ');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `system`
--
ALTER TABLE `system`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `system`
--
ALTER TABLE `system`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID',AUTO_INCREMENT=12;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
