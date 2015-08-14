-- phpMyAdmin SQL Dump
-- version 4.3.10
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jul 15, 2015 at 04:01 AM
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
-- Table structure for table `location_report`
--

CREATE TABLE IF NOT EXISTS `location_report` (
  `id` int(11) NOT NULL COMMENT 'ID',
  `location_name` varchar(100) COLLATE utf8_unicode_ci NOT NULL COMMENT 'หน่วยงานที่รายงาน'
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `location_report`
--

INSERT INTO `location_report` (`id`, `location_name`) VALUES
(1, 'องค์กรแพทย์'),
(2, 'ห้องฉุกเฉิน'),
(3, 'ฝ่ายเภสัชกรรม'),
(4, 'ห้อง LAB'),
(5, 'ห้อง X-Ray'),
(6, 'ฝ่ายทันตกรรม'),
(7, 'ผู้ป่วยนอก'),
(8, 'ผู้ป่วยใน'),
(9, 'งานเวชปฎิบัติครอบครัว'),
(10, 'ห้องคลอด'),
(11, 'งานเวชระเบียน'),
(12, 'งานการเงิน'),
(13, 'งานยานพาหนะ'),
(14, 'งานซ่อมบำรุง'),
(15, 'งานเทคโนโลยีสารสนเทศ'),
(16, 'งานซักฟอก'),
(17, 'งานจ่ายกลาง'),
(18, 'งานโภชนาการ'),
(19, 'ศูนย์ตรวจสอบสิทธิ์'),
(20, 'คลิคิกให้คำปรึกษา'),
(21, 'งานรักษาความปลอกภัย'),
(22, 'กายภาพบำบัด');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `location_report`
--
ALTER TABLE `location_report`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `location_report`
--
ALTER TABLE `location_report`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID',AUTO_INCREMENT=23;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
