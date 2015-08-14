-- phpMyAdmin SQL Dump
-- version 4.3.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jul 03, 2015 at 03:33 AM
-- Server version: 5.6.24
-- PHP Version: 5.6.8

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
-- Table structure for table `clear`
--

CREATE TABLE IF NOT EXISTS `clear` (
  `id` int(11) NOT NULL,
  `clear_name` varchar(100) COLLATE utf8_unicode_ci NOT NULL COMMENT 'สาเหตุที่ชัดแจ้ง'
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `clear`
--

INSERT INTO `clear` (`id`, `clear_name`) VALUES
(1, 'ผู้ป่วย'),
(2, 'เจ้าหน้าที่'),
(3, 'ทีมงาน'),
(4, 'กระบวนการทำงาน'),
(5, 'เครื่องมือ'),
(6, 'สิ่งแวดล้อม'),
(7, 'ปัจจัยภายนอกที่ควบคุมไม่ได้'),
(8, 'อื่นๆ');

-- --------------------------------------------------------

--
-- Table structure for table `contact`
--

CREATE TABLE IF NOT EXISTS `contact` (
  `id` int(11) NOT NULL COMMENT 'ID',
  `contact_name` varchar(100) COLLATE utf8_unicode_ci NOT NULL COMMENT 'การติดต่อสื่อสาร'
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `contact`
--

INSERT INTO `contact` (`id`, `contact_name`) VALUES
(1, 'ตามเจ้าหน้าที่เวรไม่ได้ / ล่าช้า'),
(2, 'ปัญหาการสื่อสารกับผู้ป่วย'),
(3, 'ปัญหาการสื่อสารระหว่างเจ้าหน้าที่'),
(4, 'การให้ข้อมูลแกผู้รับบริการไม่ถูกต้อง'),
(5, 'อื่นๆ');

-- --------------------------------------------------------

--
-- Table structure for table `disease`
--

CREATE TABLE IF NOT EXISTS `disease` (
  `id` int(11) NOT NULL COMMENT 'ID',
  `disease_name` varchar(100) COLLATE utf8_unicode_ci NOT NULL COMMENT 'การป้องกันการติดเชื้อใน รพ.'
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `disease`
--

INSERT INTO `disease` (`id`, `disease_name`) VALUES
(1, 'การปนเปื้อนในสิ่งแวดล้อม'),
(2, 'การติดเชื้อใน รพ.'),
(3, 'การทำให้ปราศจากเชื้อไม่มีประสิทธิภาพ'),
(4, 'การปฏิบัติไม่ถูกต้องตามหลัก IC'),
(5, 'อื่นๆ');

-- --------------------------------------------------------

--
-- Table structure for table `equipment`
--

CREATE TABLE IF NOT EXISTS `equipment` (
  `id` int(11) NOT NULL COMMENT 'ID',
  `equipment_name` varchar(100) COLLATE utf8_unicode_ci NOT NULL COMMENT 'เครื่องมือและอุปกรณ์การแพทย์'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `etc`
--

CREATE TABLE IF NOT EXISTS `etc` (
  `id` int(11) NOT NULL COMMENT 'ID',
  `etc_name` varchar(100) COLLATE utf8_unicode_ci NOT NULL COMMENT 'อื่นๆ'
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `etc`
--

INSERT INTO `etc` (`id`, `etc_name`) VALUES
(1, 'ไม่พึงพอใจบริการ'),
(2, 'ไม่สามารถให้บริการตามที่ตกลง'),
(3, 'ผู้ป่วยไม่ได้ชำระเงิน'),
(4, 'อื่นๆ');

-- --------------------------------------------------------

--
-- Table structure for table `level`
--

CREATE TABLE IF NOT EXISTS `level` (
  `id` int(11) NOT NULL COMMENT 'ID',
  `level_name` varchar(45) COLLATE utf8_unicode_ci NOT NULL COMMENT 'ระดับความรุนแรง',
  `level_description` varchar(100) COLLATE utf8_unicode_ci NOT NULL COMMENT 'รายละเอียด'
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `level`
--

INSERT INTO `level` (`id`, `level_name`, `level_description`) VALUES
(1, 'A', 'มีโอกาศเกิดความผิดพลาด'),
(2, 'B', 'เกิดขึ้นแต่ไม่ถึงผู้ประสบเหตุ'),
(3, 'C', 'ถึงผู้ประสบเหตุ แต่ไม่เกิดความอันตราย'),
(4, 'D', 'ต้องติดตามผล'),
(5, 'E', 'ต้องบำบัดรักษา'),
(6, 'F', 'นอน รพ.นานขึ้น'),
(7, 'G', 'พิการถาวร'),
(8, 'H', 'เกือบเสียชีวิต'),
(9, 'I', 'เสียชีวิต');

-- --------------------------------------------------------

--
-- Table structure for table `location_connection`
--

CREATE TABLE IF NOT EXISTS `location_connection` (
  `id` int(11) NOT NULL COMMENT 'ID',
  `location_name` varchar(100) COLLATE utf8_unicode_ci NOT NULL COMMENT 'หน่วยงานที่รายงาน'
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `location_connection`
--

INSERT INTO `location_connection` (`id`, `location_name`) VALUES
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
(19, 'ศูนย์ตรวจสอบสอทธื์'),
(20, 'คลินิกให้คำปรึกษา'),
(21, 'งานรักษาความปลอกภัย'),
(22, 'กายภาพบำบัด');

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

-- --------------------------------------------------------

--
-- Table structure for table `location_riks`
--

CREATE TABLE IF NOT EXISTS `location_riks` (
  `id` int(11) NOT NULL COMMENT 'ID',
  `location_name` varchar(100) COLLATE utf8_unicode_ci NOT NULL COMMENT 'สถานที่เกิดเหตุ'
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `location_riks`
--

INSERT INTO `location_riks` (`id`, `location_name`) VALUES
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
(20, 'คลินิกให้คำปรึกษา'),
(21, 'งานรักษาความปลอกภัย'),
(22, 'กายภาพบำบัด');

-- --------------------------------------------------------

--
-- Table structure for table `maintenance`
--

CREATE TABLE IF NOT EXISTS `maintenance` (
  `id` int(11) NOT NULL COMMENT 'ID',
  `maintenance_name` varchar(100) COLLATE utf8_unicode_ci NOT NULL COMMENT 'การดูแลรักษา'
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `maintenance`
--

INSERT INTO `maintenance` (`id`, `maintenance_name`) VALUES
(1, 'การส่งผู้ป่วยผิดจุดบริการ'),
(2, 'การบ่งชี้ผู้ป่วยผิดพลาด'),
(3, 'การคัดกรอง / ประเมินผลผิดพลาด'),
(4, 'การวินิจฉัย / รักษาผิดพลาด / ล่าช้า'),
(5, 'Revisit โรคเดิมใน 48 ชั่วโมง'),
(6, 'Revisit โรคเดิมใน 28 วัน'),
(7, 'การเกิดแผลกดทับ'),
(8, 'ภาวะแทรกซ้อนจากการคลอด (มารดา)'),
(9, 'ภาวะแทรกซ้อนจากการคลอด (ทารก)'),
(10, 'ภาวะแทรกซ้อนจากการผ่าตัด / หัตถการ'),
(11, 'ภาวะแทรกซ้อนทางทันตกรรม'),
(12, 'ภาวะแทรกซ้อนจากให้ยาและสารน้ำ'),
(13, 'เสียชีวิต / ส่งต่อโดยไม่คาด'),
(14, 'CPR ไม่มีประสิทธิภาพ'),
(15, 'ปฏิกิริยาจากการให้เลือด'),
(16, 'ผล LAB ผิดพลาด / ล่าช้า / สูญหาย'),
(17, 'มีปัญหาจากอาหาร'),
(18, 'หนีกลับ / ไม่สมัครใจรักษา'),
(19, 'การนับเครื่องมือ /SWAB ไม่ถูกต้อง'),
(20, 'อื่นๆ');

-- --------------------------------------------------------

--
-- Table structure for table `migration`
--

CREATE TABLE IF NOT EXISTS `migration` (
  `version` varchar(180) COLLATE utf8_unicode_ci NOT NULL,
  `apply_time` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `migration`
--

INSERT INTO `migration` (`version`, `apply_time`) VALUES
('m000000_000000_base', 1433992454),
('m130524_201442_init', 1433992458);

-- --------------------------------------------------------

--
-- Table structure for table `person`
--

CREATE TABLE IF NOT EXISTS `person` (
  `id` int(11) NOT NULL COMMENT 'ID',
  `person_type` varchar(100) COLLATE utf8_unicode_ci NOT NULL COMMENT 'เหตุการณ์เกิดกับ'
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `person`
--

INSERT INTO `person` (`id`, `person_type`) VALUES
(1, 'ผู้ป่วย'),
(2, 'ญาติ'),
(3, 'เจ้าหน้าที่');

-- --------------------------------------------------------

--
-- Table structure for table `public`
--

CREATE TABLE IF NOT EXISTS `public` (
  `id` int(11) NOT NULL COMMENT 'ID',
  `public_name` varchar(100) COLLATE utf8_unicode_ci NOT NULL COMMENT 'ระบบสาธารณูปโภค'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `publics`
--

CREATE TABLE IF NOT EXISTS `publics` (
  `id` int(11) NOT NULL COMMENT 'ID',
  `public_name` varchar(100) COLLATE utf8_unicode_ci NOT NULL COMMENT 'ระบบสาธารณูปโภค'
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `publics`
--

INSERT INTO `publics` (`id`, `public_name`) VALUES
(1, 'ระบบอ๊อกซิเจนขัดข้อง'),
(2, 'ระบบไฟฟ้าสำรองไม่ทำงาน'),
(3, 'ลืมปิดเครื่องใช้ไฟฟ้า'),
(4, 'รถเสีย / ไม่มีใช้งาน'),
(5, 'อื่นๆ');

-- --------------------------------------------------------

--
-- Table structure for table `risk`
--

CREATE TABLE IF NOT EXISTS `risk` (
  `id` int(11) NOT NULL,
  `person_id` int(11) NOT NULL COMMENT 'เหตุการณ์เกิดกับ',
  `hn` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'HN',
  `pname` enum('นาย','นาง','น.ส.') COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'คำนำหน้า',
  `fname` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'ชื่อ',
  `lname` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'นามสกุล',
  `location_riks_id` int(11) NOT NULL COMMENT 'สถานที่เกิดเหตุ',
  `location_report_id` int(11) NOT NULL COMMENT 'หน่วยงานที่รายงาน',
  `location_connection_id` int(11) NOT NULL COMMENT 'หน่วยงานที่เกี่ยวข้อง',
  `risk_date` date NOT NULL COMMENT 'วันที่เกิดเหตุ',
  `risk_report` date NOT NULL COMMENT 'วันที่รายงาน',
  `risk_summary` text COLLATE utf8_unicode_ci NOT NULL COMMENT 'สรุปเหตุการณ์',
  `type_id` int(11) NOT NULL COMMENT 'ประเภทความเสี่ยง',
  `sub_type_id` int(11) NOT NULL COMMENT 'ประเภทความเสี่ยงย่อย',
  `level_id` int(11) NOT NULL COMMENT 'ระดับความรุนแรง',
  `clear_id` int(11) NOT NULL COMMENT 'สาเหตุที่ชัดแจ้ง',
  `system_id` int(11) NOT NULL COMMENT 'สาเหตุเชิงระบบ',
  `status_id` int(11) NOT NULL COMMENT 'ติดตาม / ทบทวน'
) ENGINE=InnoDB AUTO_INCREMENT=39 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `risk`
--

INSERT INTO `risk` (`id`, `person_id`, `hn`, `pname`, `fname`, `lname`, `location_riks_id`, `location_report_id`, `location_connection_id`, `risk_date`, `risk_report`, `risk_summary`, `type_id`, `sub_type_id`, `level_id`, `clear_id`, `system_id`, `status_id`) VALUES
(1, 1, '5802297', 'นาย', 'คัมคุณ', 'แสนหล้า', 2, 3, 2, '2015-06-11', '2015-06-11', 'pt ฉีด cpm แล้ว แต่ไม่มีเขียนคืน er ใน OPD card', 6, 33, 3, 2, 6, 1),
(2, 1, '0054202', 'นาง', 'บิน', 'สมจันทร์', 1, 3, 8, '2015-06-11', '2015-06-11', 'pt มี amlodipine กินประจำ มา admit ก่อนนัด ขณะนอน รพ.ไม่ได้ยา amlo', 7, 47, 3, 2, 8, 1),
(3, 1, '5505500', 'นาง', 'ฉันท์ชนก', 'อาจทอง', 7, 7, 7, '2015-06-11', '2015-06-11', 'พยาบาลส่งLabผิด แพทย์สั่ง T4  แต่พยาบาลนัด สั่งLab T3', 7, 51, 4, 2, 6, 1),
(4, 1, '5601283', 'นาง', 'เรือง', 'ลาทอง', 7, 3, 7, '2015-06-11', '2015-06-11', 'สั่งยาที่ออกฤทธิ์ซ้ำซ้อน Lorazepam 0.5 + 1 mg DCF +Naproxen', 7, 47, 3, 2, 1, 1),
(5, 1, '0010709', 'นาง', 'มั่น', 'อุ่นทุ่ม', 11, 12, 11, '2015-06-11', '2015-06-11', 'pt ฟังผลเลือด ธกส.ส่งสิทธิ์เป็น UC 30บาท', 2, 14, 3, 2, 1, 1),
(6, 1, '0028762', 'นาง', 'จิต', 'ชัชวาลย์', 7, 3, 7, '2015-06-09', '2015-06-09', 'สั่งยา 150 วัน นัด 159 วัน', 7, 47, 3, 2, 8, 1),
(7, 1, '5601899', 'นาย', 'ณัฐพงษ์', 'ภาหวัน', 11, 12, 11, '2015-06-09', '2015-06-09', 'pt ทหารเกณฑ์ ส่งสิทธิ์เป็น UC 30 บาท', 2, 14, 3, 2, 1, 1),
(8, 1, '0044416', 'น.ส.', 'เจรจา', 'พินโย', 3, 3, 3, '2015-06-08', '2015-06-08', 'cef-3 1 dose pt ถือไปฉีด รพ.สต.', 7, 47, 3, 4, 8, 1),
(9, 1, '5504886', 'นาย', 'DIDIER', 'CLEMENT', 15, 15, 11, '2015-06-08', '2015-06-09', 'คนไข้ admit เข้าไป HN 5801892 admit วันที่ 8 /05/2558 แต่พองานเวชระเบียนผู้ป่วยในจะพิพพ์ใบ Summary เลข HN เปลี่ยนเป็น 5504886', 2, 14, 3, 2, 6, 1),
(10, 1, '0000290', 'นาง', 'ดอกไม้', 'เทียมภักดี', 11, 12, 11, '2015-06-09', '2015-06-09', 'pt  สิทธิ์ ผู้สูงอายุ ส่งตรวจเป็น UC 30 บาท', 2, 14, 3, 2, 1, 1),
(11, 1, '0028611', 'นาย', 'บุญฮง', 'ลามมา', 2, 3, 2, '2015-06-07', '2015-06-09', 'pt มาตรวจ 7 มิย.ได้ยาไม่ครบ มีบัตรนัดรับยาเพิ่ม 9 มิย.แต่ไม่ระบุว่ารัยาอะไรเพิ่ม จำนวนเท่าใด ห้องยาไม่ทราบจะจัดยาอะไรเพิ่มให้', 6, 33, 3, 4, 9, 1),
(12, 1, '0042246', 'นาย', 'ศีลธรรม', 'มาตา', 11, 12, 11, '2015-06-08', '2015-06-08', 'pt เบิกได้ ส่งตรวจเป็น UC 30 บาท', 2, 14, 3, 2, 1, 1),
(13, 1, '0006346', 'นาง', 'ละมัย', 'ไชยาฟอง', 11, 12, 11, '2015-06-08', '2015-06-08', 'pt ผู้สูงอายุ ส่งตรวจเป็น  UC 30 บาท ', 2, 14, 3, 2, 1, 1),
(14, 1, '5600834', 'นาย', 'ชุม', 'ศรีอรรคพรหม', 11, 3, 6, '2015-04-29', '2015-04-29', 'pt HTcIHD มาด้วยขาบวม ส่งตรวจแบบ paperless แพทย์ off Amlodipine แล้ว Add Losartan แต่ไม่ได้ค้นแฟ้มมาแก้ไขใบเรื้อรัง', 2, 14, 1, 2, 8, 1),
(15, 3, '', '', '', '', 14, 7, 7, '2015-04-08', '2015-06-21', 'ไฟฟ้าดับ เวลา 16.15 น. เครื่องคอมพิวเตอร์ดับ', 3, 17, 2, 5, 8, 1),
(16, 3, '', '', '', '', 7, 7, 13, '2015-04-28', '2015-04-28', '    -  บริเวณคลินิกเบาหวาน เวลาประมาณ 9 โมงเช้า ขณะให้บริการผู้ป่วยรู้สึกได้กลิ่นควันรถยนต์  พบรถAmbulance จอดบริเวณทางขึ้นหน้าห้องคลอด โดยได้สตาร์ทรถทิ้งไว้ แล้วหันท้ายรถมาทางคลินิกโรคเรื้อรัง  เกิดกลิ่นและควันเหม็น ทำให้ผู้รับบริการบางท่านใช้มือปิดจมูก  บางท่านลุกเดินหนีไป  \r\n    -   เวลาประมาณ 11 โมงเช้า พบรถ Ambulance อีกคันมาจอดสตาร์ททิ้งไว้อีก แต่ไม่พบคนขับรถ\r\n\r\n  จึงได้แก้ปัญหาโดยได้เดินไปแจ้งคนขับรถ  แต่ไม่พบคนขับรถ รถยังสตาร์ทอยู่  เมื่อรอคนขับรถเดินมาได้แจ้งให้ทราบว่า ผู้ป่วยเหม็นควันท่อไอเสียจากรถ', 1, 12, 4, 2, 3, 1),
(17, 3, '', '', '', '', 7, 7, 13, '2015-04-28', '2015-04-28', '    -  บริเวณคลินิกเบาหวาน เวลาประมาณ 9 โมงเช้า ขณะให้บริการผู้ป่วยรู้สึกได้กลิ่นควันรถยนต์  พบรถAmbulance จอดบริเวณทางขึ้นหน้าห้องคลอด โดยได้สตาร์ทรถทิ้งไว้ แล้วหันท้ายรถมาทางคลินิกโรคเรื้อรัง  เกิดกลิ่นและควันเหม็น ทำให้ผู้รับบริการบางท่านใช้มือปิดจมูก  บางท่านลุกเดินหนีไป  \r\n    -   เวลาประมาณ 11 โมงเช้า พบรถ Ambulance อีกคันมาจอดสตาร์ททิ้งไว้อีก แต่ไม่พบคนขับรถ\r\n\r\n  จึงได้แก้ปัญหาโดยได้เดินไปแจ้งคนขับรถ  แต่ไม่พบคนขับรถ รถยังสตาร์ทอยู่  เมื่อรอคนขับรถเดินมาได้แจ้งให้ทราบว่า ผู้ป่วยเหม็นควันท่อไอเสียจากรถ\r\n', 8, 59, 4, 2, 3, 1),
(18, 3, '', '', '', '', 7, 7, 7, '2015-04-07', '2015-04-21', 'ผู้ป่วย TB 3+ มานั่งคอยที่OPD', 4, 25, 1, 4, 6, 1),
(19, 1, '0018470', 'นาย', 'สงคราม', 'สัตตาคม', 7, 7, 4, '2015-03-23', '2015-04-21', 'เครื่อง E lyte เสีย ห้องแลปไม่แจ้งOPD ทำให้ผู้ป่วยคอยจนถึงเที่ยง จึงบอกOPD  wfhc0h''.shz^hxj;p ,kay''z];yos]y''', 5, 27, 3, 5, 8, 1),
(20, 2, '', '', '', '', 7, 7, 7, '2015-03-17', '2015-04-09', 'ญาติผู้ป่วยลื่นล้มที่ OPD', 1, 1, 2, 6, 11, 1),
(21, 1, '5601243', 'นาย', 'ไกรคม', 'แก้ววงษา', 11, 7, 15, '2015-05-12', '2015-05-12', 'เลขคิวของ ใบนำทางเป็น 400 วันที่เป็นวันที่ของเมื่อวาน ทำให้ผู้ป่วยมานั่งคอยนาน  ไม่ถูกเรียกชื่อ เพราะไม่มีชื่อในจอคอม', 2, 15, 3, 5, 8, 1),
(22, 1, '5704887', 'นาย', 'ดรัณภพ', 'ผิวศิริ', 7, 7, 11, '2014-12-09', '2014-12-09', 'ผู้ป่วยมาตามนัด ตรวจ Hct,MB  แต่ใบนำส่ง เป็น Q ของนายเที่ยง แต่ชื่อเป็นของผู้ป่วย  ไม่มีชื่อผู้ป่วยส่งมาในระบบ Hosxp', 2, 4, 1, 5, 8, 1),
(23, 1, '0009175', 'นาง', 'อัจฉรา', 'น้อยดา', 8, 12, 8, '2015-04-14', '2015-04-16', 'pt จ่ายตรง อปท. แนบในจ่ายค่าห้องพิเศษมาด้วย(สิทธิ์ผู้ป่วยไม่ต้องจ่าย)', 6, 34, 3, 2, 8, 1),
(24, 1, '5801257', 'นาง', 'สุวคนธ์', 'มีเหม็ง', 6, 3, 3, '2015-05-14', '2015-05-14', 'pt ถือใบบันทึกการตรวจมา ไม่มี order ยาพิมพ์มา สอบถามผู้ป่วยบอกว่าแพทย์ให้มาเอายา จึงเปิดดูในคอมพบ order Amoxy5001*3/20', 2, 14, 3, 4, 11, 1),
(25, 1, '0015873', 'นาง', 'จันนาม', 'ศรีหากุน', 9, 7, 7, '2015-05-11', '2015-05-11', 'ลงใบนัดว่า นัดให้ผู้ป่วยมารับยา HT แต่จริงๆ ผู้ป่วย มารับยา Gout', 6, 34, 3, 2, 8, 1),
(26, 1, '0010709', 'นาง', 'มั่น', 'อุ่นทุ่ม', 11, 12, 11, '2015-05-10', '2015-05-10', 'pt ฟังผลเลือด ธกส.ส่งสิทธิ์เป็น UC 30บาท', 2, 14, 3, 2, 1, 1),
(27, 3, '', '', '', '', 14, 7, 7, '2015-04-08', '2015-04-21', 'ไฟฟ้าดับ เวลา 16.15 น. เครื่องคอมพิวเตอร์ดับ', 3, 17, 2, 5, 8, 1),
(28, 1, '0009658', 'น.ส.', 'ภัทราภรณ์', 'ไพศูนย์', 2, 12, 2, '2015-05-15', '2015-05-15', 'pt สิทธิ์เบิกได้รัฐวิสาหกิจ key ค่าล้างตา 2 ครั้ง ค่าฉีดยา 2 ครั้ง(มีฉีด CPM 1 amp)', 2, 14, 3, 4, 1, 1),
(29, 1, '0009658', 'น.ส.', 'ภัทราภรณ์', 'ไพศูนย์', 2, 12, 2, '2015-05-15', '2015-05-15', 'pt สิทธิ์เบิกได้รัฐวิสาหกิจ key ค่าล้างตา 2 ครั้ง ค่าฉีดยา 2 ครั้ง(มีฉีด CPM 1 amp)', 2, 14, 3, 4, 1, 1),
(30, 1, '0054202', 'นาง', 'บิน', 'สมจันทร์', 1, 3, 8, '2015-05-11', '2015-05-11', 'pt มี amlodipine กินประจำ มา admit ก่อนนัด ขณะนอน รพ.ไม่ได้ยา amlo', 7, 47, 3, 4, 8, 1),
(31, 1, '0016852', 'น.ส.', 'ชลาลัย', 'ชัยเต็ม', 11, 12, 11, '2015-05-11', '2015-05-11', 'pt บอใบรับรองแทพย์ ทำใบขับขี่ แต่ส่งสิทธิ์เป็น UC 30 บาท ', 2, 14, 3, 2, 1, 1),
(32, 3, '', '', '', '', 2, 3, 2, '2015-05-24', '2015-05-24', 'มีการประชุมที่ห้องประชุมแก่งฟ้า ผู้เข้าประชุมทิ้งแก้วกาแฟ ซองขนมไปทั่วรอบห้องประชุม', 8, 59, 3, 2, 4, 1),
(33, 1, '', '', '', '', 5, 7, 7, '2015-04-27', '2015-04-27', 'OPD ให้ OPD Card กับผู้ป่วยไปเอกซเรย์ไม่ถูกคน', 2, 4, 1, 2, 7, 1),
(34, 1, '0014733', 'นาง', 'ทะเบียน', 'นาทุม', 4, 7, 7, '2015-04-23', '2015-04-23', 'แพทย์นัดให้เก็บเสมหะมาตรวจ 3 วัน แต่ผู้ป่วยเก็บมา 1 วัน', 6, 32, 3, 4, 5, 1),
(35, 1, '5801257', 'นาง', 'สุวคนธ์', 'มีเหม็ง', 6, 3, 6, '2015-05-14', '2015-05-14', 'pt ถือใบบันทึกการตรวจมา ไม่มี order ยาพิมพ์มา สอบถามผู้ป่วยบอกว่าแพทย์ให้มาเอายา จึงเปิดดูในคอมพบ order Amoxy5001*3/20', 2, 14, 3, 2, 8, 1),
(36, 2, '', '', '', '', 10, 3, 10, '2015-04-08', '2015-04-08', 'พบญาตินำผ้าอ้อมไปตากไว้ที่ราวลวดหนาม ข้างห้องคลอด', 3, 20, 3, 8, 11, 1),
(37, 3, '', '', '', '', 16, 16, 2, '2015-01-01', '2015-07-01', 'เวลา 13.30 น. พบเครื่องมือแพทย์ 1 ชิ้น ติดลงมากับผ้าห่อ set', 4, 25, 3, 4, 8, 1),
(38, 3, '', '', '', '', 16, 16, 8, '2015-03-04', '2015-04-09', 'เวลา 9.30 น. พบผ้าเปื้อนอุจจาระปนมากับผ้าเปื้อนน้อย (ไม่ใส่ถุงแดง)', 4, 25, 3, 4, 8, 1);

-- --------------------------------------------------------

--
-- Table structure for table `risk_has_review`
--

CREATE TABLE IF NOT EXISTS `risk_has_review` (
  `risk` int(11) NOT NULL,
  `review` int(11) NOT NULL,
  `risk_has_reviewcol` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `risk_has_review1`
--

CREATE TABLE IF NOT EXISTS `risk_has_review1` (
  `risk_id` int(11) NOT NULL,
  `review_ID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `safe`
--

CREATE TABLE IF NOT EXISTS `safe` (
  `id` int(11) NOT NULL COMMENT 'ID',
  `safe_name` varchar(100) COLLATE utf8_unicode_ci NOT NULL COMMENT 'ความปลอดภัย'
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `safe`
--

INSERT INTO `safe` (`id`, `safe_name`) VALUES
(1, 'ลื่น / ล้ม / ชน'),
(2, 'ตกจากเตียง / เปล / โต๊ะ'),
(3, 'บาดเจ็บจากการทำงาน'),
(4, 'อุบัติเหตุที่เสี่ยงต่อการติดเชื้อ'),
(5, 'การทำร้ายร่างกาย'),
(6, 'อันตรายจากรังสี'),
(7, 'อัคคีภัย'),
(8, 'โจรกรรม / ลักขโมย'),
(9, 'อุบัติเหตุทางการเดินทาง'),
(10, 'อื่นๆ');

-- --------------------------------------------------------

--
-- Table structure for table `status`
--

CREATE TABLE IF NOT EXISTS `status` (
  `id` int(11) NOT NULL COMMENT 'ID',
  `status_name` varchar(100) COLLATE utf8_unicode_ci NOT NULL COMMENT 'ต้องติดตาม / ต้องทบทวน'
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `status`
--

INSERT INTO `status` (`id`, `status_name`) VALUES
(1, 'ต้องทบทวน'),
(2, 'ทำการทบทวนแล้ว');

-- --------------------------------------------------------

--
-- Table structure for table `status_active`
--

CREATE TABLE IF NOT EXISTS `status_active` (
  `id` int(11) NOT NULL COMMENT 'ID',
  `status_name` varchar(100) COLLATE utf8_unicode_ci NOT NULL COMMENT 'สถานะการทบทวน'
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `status_active`
--

INSERT INTO `status_active` (`id`, `status_name`) VALUES
(1, 'Yes'),
(2, 'No');

-- --------------------------------------------------------

--
-- Table structure for table `status_description`
--

CREATE TABLE IF NOT EXISTS `status_description` (
  `id` int(11) NOT NULL COMMENT 'ID',
  `status_date` date NOT NULL COMMENT 'วันที่ทบทวน',
  `status_description` text COLLATE utf8_unicode_ci NOT NULL COMMENT 'รายละเอียดการทบทวน',
  `status_name` varchar(100) COLLATE utf8_unicode_ci NOT NULL COMMENT 'ผู้ทบทวน',
  `status_active_id` int(11) NOT NULL COMMENT 'สถานะการทบทวน',
  `status_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sub_type`
--

CREATE TABLE IF NOT EXISTS `sub_type` (
  `id` int(11) NOT NULL COMMENT 'ID',
  `type_id` int(11) NOT NULL COMMENT 'ประเภทความเสี่ยง',
  `sub_type_name` varchar(100) COLLATE utf8_unicode_ci NOT NULL COMMENT 'ประเภทย่อย'
) ENGINE=InnoDB AUTO_INCREMENT=60 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `sub_type`
--

INSERT INTO `sub_type` (`id`, `type_id`, `sub_type_name`) VALUES
(1, 1, 'ลื่น / ล้ม / ชน'),
(2, 1, 'ตกจากเตียง / เปล / โต๊ะ'),
(3, 2, 'เวชระเบียนสูญหาย / หาไม่เจอ'),
(4, 2, 'เวชระเบียนสลับกัน'),
(5, 1, 'บาดเจ็บจากการทำงาน'),
(6, 1, 'อุบัติเหตุเสี่ยงต่อการติดเชื้อ'),
(7, 1, 'การทำร้ายร่างกาย'),
(8, 1, 'อันตรายจากรังสี'),
(9, 1, 'อัคคีภัย'),
(10, 1, 'โจรกรรม / ลักขโมย'),
(11, 1, 'อุบัติเหตุทางรถยนต์'),
(12, 1, 'อื่นๆ'),
(13, 2, 'ความลับถูกเปิดเผย'),
(14, 2, 'การบันทึกไม่สมบูรณ์ / ไม่ถูกต้อง'),
(15, 2, 'ระบบโปรแกรมขัดข้อง'),
(16, 3, 'ระบบอ๊อกซิเจนขัดข้อง'),
(17, 3, 'ระบบไฟฟ้าสำร้องไม่ทำงาน'),
(18, 3, 'ลืมปิดเครื่องใช้ไฟฟ้า'),
(19, 3, 'รถเสีย / ใช้ไม่ได้'),
(20, 3, 'อื่นๆ'),
(21, 2, 'อื่น'),
(22, 4, 'การปบเปื้อยในสิ่งแวดล้อม'),
(23, 4, 'การติดเชื้อใน รพ.'),
(24, 4, 'การทำให้ปราศจากเชื้อไม่มีประสิทธิภาพ'),
(25, 4, 'การปฏิบัติไม่ถูกต้องตามหลัก IC'),
(26, 4, 'อื่นๆ'),
(27, 5, 'ไม่พร้อมใช้งาน'),
(28, 5, 'ขัดข้อง / ทำงานผิดปกติ'),
(29, 5, 'ผู้ป่วยบาดเจ็บจากการใช้เครื่องมือ'),
(30, 5, 'อื่นๆ'),
(31, 6, 'ตามเจ้าหน้าที่เวรไม่ได้ / ล่าช้า'),
(32, 6, 'ปัญหาการสื่อสารกับผู้ป่วย'),
(33, 6, 'ปัญหาการสื่อสารระหว่างเจ้าหน้าที่'),
(34, 6, 'การให้ข้อมูลแก้ผู้รับบริการไม่ถูกต้อง / ขัดแย้งกัน'),
(35, 6, 'อื่นๆ'),
(36, 7, 'การส่อผู้ป่วยผิดจุดบริการ'),
(37, 7, 'การบ่งชี้ผู้ป่วยผิดพลาด'),
(38, 7, 'การคัดกรอง / ประเมินผิดพลาด'),
(39, 7, 'การวินิจฉัย / รักษาผิดพลาด / ล่าช้า'),
(40, 7, 'Revisit โรคเดิมใน 48 ชั่วโมง'),
(41, 7, 'Readmit โรคเดิมใน 28 วัน'),
(42, 7, 'การเกิดแผลกดทับ'),
(43, 7, 'ภาวะแทรกซ้อนจากการคลอด (มารดา)'),
(44, 7, 'ภาวะแทรกซ้อนจากการคลอด (ทารก)'),
(45, 7, 'ภาวะแทรกซ้อนจากการผ่าตัด / หัตถการ'),
(46, 7, 'ภาวะแทรกซ้อนทางทันตกรรม'),
(47, 7, 'ภาวะแทรกซ้อนจากการให้ยาและสารน้ำ'),
(48, 7, 'เสียชีวิต / ส่งต่อโดยไม่คาด'),
(49, 7, 'CPR ไม่มีประสิทธิภาพ'),
(50, 7, 'ปฏิกิริยาจากการให้เลือด'),
(51, 7, 'ผล LAB / ผิดพลาด / ล่าช้า / สูญหาย'),
(52, 7, 'มีปัญหาจากอาหาร'),
(53, 7, 'หนีกลับ / ไม่สมัครใจรักษา'),
(54, 7, 'การนับเครื่องมือ / SWAB ไม่ถูกต้อง'),
(55, 7, 'อื่นๆ'),
(56, 8, 'ไม่พึกพอใจบริการ'),
(57, 8, 'ไม่สามารถให้บริการตามที่ตกลง'),
(58, 8, 'ผู้ป่วยไม่ได้ชำระเงิน'),
(59, 8, 'อื่นๆ');

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

-- --------------------------------------------------------

--
-- Table structure for table `treat`
--

CREATE TABLE IF NOT EXISTS `treat` (
  `id` int(11) NOT NULL COMMENT 'ID',
  `treat_name` varchar(100) COLLATE utf8_unicode_ci NOT NULL COMMENT 'ระบบข้อมูลการดูแลรักษา'
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `treat`
--

INSERT INTO `treat` (`id`, `treat_name`) VALUES
(1, 'เวชระเบียนสูญหาย / หาไม่เจอ'),
(2, 'เวชระเบียนสลับกัน'),
(3, 'ความลับถูกเปิดเผย'),
(4, 'การบันทึกไม่สมบูรณ์ / ไม่ถูกต้อง'),
(5, 'ระบบโปรแกรมขัดข้อง');

-- --------------------------------------------------------

--
-- Table structure for table `type`
--

CREATE TABLE IF NOT EXISTS `type` (
  `id` int(11) NOT NULL COMMENT 'ID',
  `type_name` varchar(100) COLLATE utf8_unicode_ci NOT NULL COMMENT 'ประเภทความเสี่ยง'
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `type`
--

INSERT INTO `type` (`id`, `type_name`) VALUES
(1, 'ความปลอดภัย'),
(2, 'ระบบข้อมูลการดูแลรักษา'),
(3, 'ระบบสาธารณูปโภค'),
(4, 'การป้องกันการติดเชื้อใน รพ.'),
(5, 'เครื่องมือและอุปกรณ์การแพทย์'),
(6, 'การติดต่อสื่อสาร'),
(7, 'การดูแลรักษา'),
(8, 'อื่นๆ');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `auth_key` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `password_hash` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password_reset_token` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `status` smallint(6) NOT NULL DEFAULT '10',
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `auth_key`, `password_hash`, `password_reset_token`, `email`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Danai', 'xtdmYX82X6u8ajYuMPBrmy8QBFzHMzXI', '$2y$13$82k/cD6l9TG3IFmeGB237emY0a8K9yAVZKSLE0mPA3R5kgw.vpFG6', NULL, 'Lifegoon_2006@hotmail.com', 10, 1433992619, 1433992619),
(2, 'kannika', 'yHKfXatoaKotxBAgQepuWjl-YxbYrPAK', '$2y$13$b0cnuke/uxNxrDMFVCW30.u9QchTisAa.YuBQHIws.C5HZer7yMKm', NULL, 'kannika_pi@hotmail.com', 10, 1435399217, 1435399217);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `clear`
--
ALTER TABLE `clear`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contact`
--
ALTER TABLE `contact`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `disease`
--
ALTER TABLE `disease`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `equipment`
--
ALTER TABLE `equipment`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `etc`
--
ALTER TABLE `etc`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `level`
--
ALTER TABLE `level`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `location_connection`
--
ALTER TABLE `location_connection`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `location_report`
--
ALTER TABLE `location_report`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `location_riks`
--
ALTER TABLE `location_riks`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `maintenance`
--
ALTER TABLE `maintenance`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migration`
--
ALTER TABLE `migration`
  ADD PRIMARY KEY (`version`);

--
-- Indexes for table `person`
--
ALTER TABLE `person`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `public`
--
ALTER TABLE `public`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `publics`
--
ALTER TABLE `publics`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `risk`
--
ALTER TABLE `risk`
  ADD PRIMARY KEY (`id`), ADD KEY `fk_risk_location_riks1_idx` (`location_riks_id`), ADD KEY `fk_risk_location_report1_idx` (`location_report_id`), ADD KEY `fk_risk_location_connection1_idx` (`location_connection_id`), ADD KEY `fk_risk_person1_idx` (`person_id`), ADD KEY `fk_risk_level1_idx` (`level_id`), ADD KEY `fk_risk_clear1_idx` (`clear_id`), ADD KEY `fk_risk_system1_idx` (`system_id`), ADD KEY `fk_risk_type1_idx` (`type_id`), ADD KEY `fk_risk_status1_idx` (`status_id`), ADD KEY `fk_risk_sub_type1_idx` (`sub_type_id`);

--
-- Indexes for table `risk_has_review`
--
ALTER TABLE `risk_has_review`
  ADD PRIMARY KEY (`risk`,`review`), ADD KEY `fk_risk_has_review_risk1_idx` (`risk`);

--
-- Indexes for table `risk_has_review1`
--
ALTER TABLE `risk_has_review1`
  ADD PRIMARY KEY (`risk_id`,`review_ID`), ADD KEY `fk_risk_has_review1_risk1_idx` (`risk_id`);

--
-- Indexes for table `safe`
--
ALTER TABLE `safe`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `status`
--
ALTER TABLE `status`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `status_active`
--
ALTER TABLE `status_active`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `status_description`
--
ALTER TABLE `status_description`
  ADD PRIMARY KEY (`id`), ADD KEY `fk_status_description_status_active1_idx` (`status_active_id`), ADD KEY `fk_status_description_status1_idx` (`status_id`);

--
-- Indexes for table `sub_type`
--
ALTER TABLE `sub_type`
  ADD PRIMARY KEY (`id`), ADD KEY `fk_sub_type_type1_idx` (`type_id`);

--
-- Indexes for table `system`
--
ALTER TABLE `system`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `treat`
--
ALTER TABLE `treat`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `type`
--
ALTER TABLE `type`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `clear`
--
ALTER TABLE `clear`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `contact`
--
ALTER TABLE `contact`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID',AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `disease`
--
ALTER TABLE `disease`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID',AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `equipment`
--
ALTER TABLE `equipment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID';
--
-- AUTO_INCREMENT for table `etc`
--
ALTER TABLE `etc`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID',AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `level`
--
ALTER TABLE `level`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID',AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `location_connection`
--
ALTER TABLE `location_connection`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID',AUTO_INCREMENT=23;
--
-- AUTO_INCREMENT for table `location_report`
--
ALTER TABLE `location_report`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID',AUTO_INCREMENT=23;
--
-- AUTO_INCREMENT for table `location_riks`
--
ALTER TABLE `location_riks`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID',AUTO_INCREMENT=23;
--
-- AUTO_INCREMENT for table `maintenance`
--
ALTER TABLE `maintenance`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID',AUTO_INCREMENT=21;
--
-- AUTO_INCREMENT for table `person`
--
ALTER TABLE `person`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID',AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `public`
--
ALTER TABLE `public`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID';
--
-- AUTO_INCREMENT for table `publics`
--
ALTER TABLE `publics`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID',AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `risk`
--
ALTER TABLE `risk`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=39;
--
-- AUTO_INCREMENT for table `safe`
--
ALTER TABLE `safe`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID',AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `status`
--
ALTER TABLE `status`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID',AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `status_active`
--
ALTER TABLE `status_active`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID',AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `status_description`
--
ALTER TABLE `status_description`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID';
--
-- AUTO_INCREMENT for table `sub_type`
--
ALTER TABLE `sub_type`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID',AUTO_INCREMENT=60;
--
-- AUTO_INCREMENT for table `system`
--
ALTER TABLE `system`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID',AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `treat`
--
ALTER TABLE `treat`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID',AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `type`
--
ALTER TABLE `type`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID',AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `risk`
--
ALTER TABLE `risk`
ADD CONSTRAINT `fk_risk_clear1` FOREIGN KEY (`clear_id`) REFERENCES `clear` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
ADD CONSTRAINT `fk_risk_level1` FOREIGN KEY (`level_id`) REFERENCES `level` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
ADD CONSTRAINT `fk_risk_location_connection1` FOREIGN KEY (`location_connection_id`) REFERENCES `location_connection` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
ADD CONSTRAINT `fk_risk_location_report1` FOREIGN KEY (`location_report_id`) REFERENCES `location_report` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
ADD CONSTRAINT `fk_risk_location_riks1` FOREIGN KEY (`location_riks_id`) REFERENCES `location_riks` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
ADD CONSTRAINT `fk_risk_person1` FOREIGN KEY (`person_id`) REFERENCES `person` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
ADD CONSTRAINT `fk_risk_status1` FOREIGN KEY (`status_id`) REFERENCES `status` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
ADD CONSTRAINT `fk_risk_sub_type1` FOREIGN KEY (`sub_type_id`) REFERENCES `sub_type` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
ADD CONSTRAINT `fk_risk_system1` FOREIGN KEY (`system_id`) REFERENCES `system` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
ADD CONSTRAINT `fk_risk_type1` FOREIGN KEY (`type_id`) REFERENCES `type` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `risk_has_review`
--
ALTER TABLE `risk_has_review`
ADD CONSTRAINT `fk_risk_has_review_risk1` FOREIGN KEY (`risk`) REFERENCES `risk` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `risk_has_review1`
--
ALTER TABLE `risk_has_review1`
ADD CONSTRAINT `fk_risk_has_review1_risk1` FOREIGN KEY (`risk_id`) REFERENCES `risk` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `status_description`
--
ALTER TABLE `status_description`
ADD CONSTRAINT `fk_status_description_status1` FOREIGN KEY (`status_id`) REFERENCES `status` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
ADD CONSTRAINT `fk_status_description_status_active1` FOREIGN KEY (`status_active_id`) REFERENCES `status_active` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `sub_type`
--
ALTER TABLE `sub_type`
ADD CONSTRAINT `fk_sub_type_type1` FOREIGN KEY (`type_id`) REFERENCES `type` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
