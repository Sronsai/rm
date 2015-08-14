-- phpMyAdmin SQL Dump
-- version 4.3.10
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jul 15, 2015 at 09:08 AM
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
-- Table structure for table `sub_type`
--

CREATE TABLE IF NOT EXISTS `sub_type` (
  `id` int(11) NOT NULL COMMENT 'ID',
  `type_id` int(11) NOT NULL COMMENT 'ประเภทความเสี่ยง',
  `sub_type_name` varchar(100) COLLATE utf8_unicode_ci NOT NULL COMMENT 'ประเภทย่อย'
) ENGINE=InnoDB AUTO_INCREMENT=70 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `sub_type`
--

INSERT INTO `sub_type` (`id`, `type_id`, `sub_type_name`) VALUES
(1, 1, 'การคัดกรอง ประเมินผิดพลาด'),
(2, 1, 'การวินิจฉัยผิดพลาด ล่าช้า'),
(3, 1, 'ผล Lab ผิดพลาดล่าช้า'),
(4, 1, 'X-Ray ผิดท่า / ไม่ชัดเจน'),
(5, 1, 'ผู้ป่วยตกเตียง'),
(6, 1, 'เข็มทิ่มตำ'),
(7, 1, 'ให้การรักษาล่าช้า'),
(8, 1, 'ภาวะแทรกซ้อนทางหัตถการ'),
(9, 1, 'ภาวะแทรกซ้อนทางทันตกรรม'),
(10, 1, 'ปฏิกิริยาจากการให้เลือด'),
(11, 1, 'เสียชีวิตโดยไม่คาดคิด'),
(12, 1, 'Revisit โรคเดิม 48 ชั่วโมง'),
(13, 1, 'การส่งต่อล่าช้า'),
(14, 1, 'ไม่สมัครใจอยู่'),
(15, 2, 'เวชระเบียนสูญหาย'),
(16, 2, 'เวชระเบียนผิดคน'),
(17, 2, 'ส่งสิทธิ์การรักษาผิดพลาด'),
(18, 2, 'การบันทึกข้อมูลไม่สมบูรณ์'),
(19, 2, 'ความลับถูกเปิดเผย'),
(20, 2, 'สรุปเวชระเบียนล่าช้า'),
(21, 2, 'โปรแกรมขัดข้อง'),
(22, 3, 'สั่งยาผิดคน'),
(23, 3, 'สั่งยาผิดชนิด'),
(24, 3, 'สั่งยาผิดความแรง'),
(25, 3, 'สั่งยาผิดรูปแบบ'),
(26, 3, 'สั่งยาผิดจำนวน'),
(27, 3, 'จัดยาผิดชนิด'),
(28, 3, 'จัดยาผิดความแรง'),
(29, 3, 'จัดยาผิดรูปแบบ'),
(30, 3, 'จัดยาผิดจำนวน'),
(31, 3, 'จ่ายยาผิดคน'),
(32, 3, 'จ่ายยาผิดชนิด'),
(33, 3, 'จ่ายยาผิดความแรง'),
(34, 3, 'จ่ายยาผิดรูปแบบ'),
(35, 3, 'จ่ายยาผิดจำนวน'),
(36, 3, 'ให้ยาผิดคน'),
(37, 3, 'ให้ยาผิดชนิด'),
(38, 3, 'ให้ยาผิดความแรง'),
(39, 3, 'ให้ยาผิดรูปแบบ'),
(40, 3, 'ให้ยาผิดจำนวน / ผิดขนาด'),
(41, 3, 'ให้ยาผิดช่องทาง'),
(42, 3, 'ให้ยาผิดเวลา'),
(43, 3, 'คุณภาพเวชภัณฑ์'),
(44, 3, 'การเบิกจ่ายยา / เวชภัณฑ์'),
(45, 4, 'มารดา / ทารกบาดเจ็บจากการคลอด'),
(47, 4, 'Fetal distress'),
(48, 4, 'Birth asphyxia'),
(49, 4, 'ภาวะแทรกซ้อนจากการคลอด'),
(50, 4, 'ตกเลือดหลังคลอด'),
(51, 5, 'ไม่เพียงพอ'),
(52, 5, 'ไม่พร้อมใช้'),
(53, 5, 'เครื่องมือทำงานผิดปกติ'),
(54, 5, 'หมดอายุ / ชำรุดเสียหาย'),
(55, 6, 'ระบบไฟฟ้า'),
(56, 6, 'ระบบน้ำ'),
(57, 6, 'ระบบก๊าซ'),
(58, 6, 'รถยนต์'),
(59, 6, 'โทรศัพท์ / Internet / ข้อมูลสารสนเทศ'),
(60, 7, 'ลื่นล้ม'),
(61, 7, 'บาดเจ็บ / ติดเชื้อจากการทำงาน'),
(62, 7, 'โดนทำร้ายร่างกาย'),
(63, 7, 'ได้รับรังสีเกินขนาด'),
(64, 7, 'โจรกรรม'),
(65, 7, 'อัคคีภัย'),
(66, 7, 'อาคารสถานที่'),
(68, 8, 'ข้อร้องเรียน / ข้อเสนอแนะ'),
(69, 8, 'อื่นๆ');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `sub_type`
--
ALTER TABLE `sub_type`
  ADD PRIMARY KEY (`id`), ADD KEY `fk_sub_type_type1_idx` (`type_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `sub_type`
--
ALTER TABLE `sub_type`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID',AUTO_INCREMENT=70;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `sub_type`
--
ALTER TABLE `sub_type`
ADD CONSTRAINT `fk_sub_type_type1` FOREIGN KEY (`type_id`) REFERENCES `type` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
