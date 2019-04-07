-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 07, 2019 at 10:43 AM
-- Server version: 10.1.36-MariaDB
-- PHP Version: 7.2.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `shop_label`
--

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `CAT_ID` int(11) NOT NULL,
  `CAT_NAME` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `PRICE` int(11) DEFAULT NULL,
  `HEIGHT` int(11) DEFAULT NULL,
  `WIDTH` int(11) DEFAULT NULL,
  `NUMBER_ROLL` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`CAT_ID`, `CAT_NAME`, `PRICE`, `HEIGHT`, `WIDTH`, `NUMBER_ROLL`) VALUES
(1, 'หลังขาว100x50cm', 150, 722, 201, 3),
(2, 'หลังขาว150x50cm', 150, 146, 46, 3),
(3, 'หลังขาว200x50cm', 150, 179, 19, 3),
(4, 'หลังขาว250x50cm', 150, 246, 46, 3),
(5, 'หลังขาว300x50cm', 150, 252, 50, 3),
(6, 'หลังดำ100x50cm', 250, 98, 48, 3),
(7, 'หลังดำ150x50cm', 250, 146, 46, 3),
(8, 'หลังดำ200x50cm', 250, 200, 50, 3),
(9, 'หลังดำ250x50cm', 250, 250, 50, 3),
(10, 'หลังดำ300x50cm', 250, 300, 50, 3),
(15, 'abc', 22, 22, 2, 12);

-- --------------------------------------------------------

--
-- Table structure for table `checks`
--

CREATE TABLE `checks` (
  `id_check` int(11) NOT NULL COMMENT 'รหัสตรวจสอบ',
  `staff_id` varchar(10) COLLATE utf8_unicode_ci NOT NULL COMMENT 'รหัสพนักงาน',
  `cat_id` int(11) NOT NULL COMMENT 'รหัสประเภท',
  `day_check` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT 'วันที่ตรวจสอบ'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `checks`
--

INSERT INTO `checks` (`id_check`, `staff_id`, `cat_id`, `day_check`) VALUES
(1, '20181130', 1, '2019-03-23 16:10:55'),
(2, '20181130', 2, '2019-03-23 16:10:57');

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `CUS_FNAME` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `CUS_LNAME` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `CUS_ADDRESS` varchar(500) COLLATE utf8_unicode_ci DEFAULT NULL,
  `CUS_EMAIL` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `CUS_PHONE` varchar(10) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`CUS_FNAME`, `CUS_LNAME`, `CUS_ADDRESS`, `CUS_EMAIL`, `CUS_PHONE`) VALUES
('dbfkdki11@gmail.com', 'dbfkdki11@gmail.com', 'dbfkdki11@gmail.com', 'dbfkdki11@gmail.com', '0831101923'),
('กิดาการ', 'อินทปัญญา', 'บ้านบึง', 'dbfkdki11@gmail.com', '0853871947'),
('su55931', 'su55931', 'su55931', 'dbfkdki11@gmail.com', '0874449632'),
('กิดาการ', 'อินทปัญญา', 'บ้านบึง', 'dbfkdki11@gmail.com', '0957591823'),
('0987654321', '0987654321', '0987654321', '0987654321', '0987654321'),
('dbfkdki11@gmail.com', 'dbfkdki11@gmail.com', 'dbfkdki11@gmail.com', 'dbfkdki11@gmail.com', '1111'),
('dbfkdki11@gmail.com', 'dbfkdki11@gmail.com', 'dbfkdki11@gmail.com', 'dbfkdki11@gmail.com', '123456789'),
('1234567890', '1234567890', '1234567890', '1234567890', '1234567890'),
('123', '123', 'dbfkdki11@gmail.com', 'dbfkdki11@gmail.com', '123465888'),
('1', '8', '2222', '333@hotmail.com', '1281545121'),
('dbfkdki11@gmail.com', 'dbfkdki11@gmail.com', '$sql_insert_lable=', 'dbfkdki11@gmail.com', '155555555');

-- --------------------------------------------------------

--
-- Table structure for table `departments`
--

CREATE TABLE `departments` (
  `DEP_ID` varchar(5) COLLATE utf8_unicode_ci NOT NULL,
  `DEP_NAME` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `departments`
--

INSERT INTO `departments` (`DEP_ID`, `DEP_NAME`) VALUES
('AC', 'Admin'),
('GP', 'graphic'),
('HR', 'human_resources'),
('MG', 'manager'),
('PS', 'print_staff'),
('SV', 'service');

-- --------------------------------------------------------

--
-- Table structure for table `income`
--

CREATE TABLE `income` (
  `ID_INCOME` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `RECEIPTS` int(11) DEFAULT NULL,
  `DISBURSEMENT` int(11) DEFAULT NULL,
  `DAY_IN` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `income`
--

INSERT INTO `income` (`ID_INCOME`, `RECEIPTS`, `DISBURSEMENT`, `DAY_IN`) VALUES
('2019032305340436', 2000, 1000, '2019-03-14'),
('2019032305370641', 1234, 567, '2019-03-10'),
('2019032305373243', 2100, 2, '2019-02-24');

-- --------------------------------------------------------

--
-- Table structure for table `lable`
--

CREATE TABLE `lable` (
  `LABLE_ID` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `STAFF_ID` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `CUS_PHONE` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `LABLE_HEIGHT` int(11) DEFAULT NULL,
  `LABLE_WIDTH` int(11) DEFAULT NULL,
  `CAT_ID` int(11) DEFAULT NULL,
  `LABLE_NUMBER` int(11) DEFAULT NULL,
  `DESCRIPTION` varchar(500) COLLATE utf8_unicode_ci DEFAULT NULL,
  `TOTAL` int(11) DEFAULT NULL,
  `ORDER_DAY` date DEFAULT NULL,
  `PICK_UP_DATE` date DEFAULT NULL,
  `IMG` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `STATUS` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `lable`
--

INSERT INTO `lable` (`LABLE_ID`, `STAFF_ID`, `CUS_PHONE`, `LABLE_HEIGHT`, `LABLE_WIDTH`, `CAT_ID`, `LABLE_NUMBER`, `DESCRIPTION`, `TOTAL`, `ORDER_DAY`, `PICK_UP_DATE`, `IMG`, `STATUS`) VALUES
('1903181', '20181136', '0831101923', 1, 1, 1, 1, 'dbfkdki11@gmail.com', 150, '2019-03-18', '2019-03-22', 'resume _vertion_eng.jpg', 'เสร็จสิ้น'),
('1903182', '20181124', '5515151515', 1, 1, 1, 1, 'company123', 150, '2019-03-18', '2019-03-22', 'Capture.JPG', 'กำลังปริ้น'),
('1903183', '20181124', '0874449632', 1, 1, 1, 1, 'su55931', 150, '2019-03-18', '2019-03-22', '51392675_1051418408391370_1917691747928899584_o.jpg', 'เสร็จสิ้น'),
('1903184', '20181130', '0801009745', 1, 11, 1, 1, '0801009745', 1650, '2019-03-18', '2019-03-22', 'IMG_0799.jpg', 'ปริ้น'),
('1903185', '20181130', '0853871947', 1, 1, 1, 1, 'งานจบ', 150, '2019-03-18', '2019-03-22', '', 'กำลังออกแบบ');

-- --------------------------------------------------------

--
-- Table structure for table `staff`
--

CREATE TABLE `staff` (
  `STAFF_ID` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `USERNAME` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `PASSWORD` varchar(250) COLLATE utf8_unicode_ci DEFAULT NULL,
  `FNAME` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `LNAME` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `PHONE` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `EMAIL` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ADDRESS` varchar(500) COLLATE utf8_unicode_ci DEFAULT NULL,
  `SALARY` int(11) DEFAULT NULL,
  `DEP_ID` varchar(5) COLLATE utf8_unicode_ci DEFAULT NULL,
  `IMG` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `staff`
--

INSERT INTO `staff` (`STAFF_ID`, `USERNAME`, `PASSWORD`, `FNAME`, `LNAME`, `PHONE`, `EMAIL`, `ADDRESS`, `SALARY`, `DEP_ID`, `IMG`) VALUES
('20181121', 'su55931', '25f9e794323b453885f5181f1b624d0b\r\n', 'สุดารัตน์', 'รัตนมณี', '0835499870', 'sudarus@gmail.com', 'บ้านเลขที่ 830 ม.2/255 ต.บ้านบึง อ.บ้านบึง จ.ชลบุรี', 12000, 'SV', '1.jpg'),
('20181122', 'achi123', '103ca003b56e97bd12245f140c8159bf', 'อชิรญาพร', 'ประเสริฐยิ่ง', '0859463218', 'achil@gmail.com', 'บ้านเลขที่ 838  ม.2/255 ต.บ้านบึง อ.บ้านบึง จ.ชลบุรี', 15000, 'GP', '51392675_1051418408391370_1917691747928899584_o.jpg'),
('20181123', 'sama123', '56f26eb65a5b3fca8928305c8e1c3acf\r\n', 'สามารถ', 'ประเสริฐยิ่ง', '0831562194', 'sama123@gmail.com', 'บ้านเลขที่ 838  ม.2/255 ต.บ้านบึง อ.บ้านบึง จ.ชลบุรี', 15000, 'GP', '53618337_2190841854340717_4409122312637382656_n.jpg'),
('20181124', 'sing567', '0b53fef84e489f54f92a428eb758c404', 'สิงหา', 'ยอดนิยม', '0874419976', 'sing567@gmail.com', 'บ้านเลขที่ 1238  ม.8/255 ต.บ้านบึง อ.บ้านบึง จ.ชลบุรี', 12000, 'PS', '48394134_325270451403821_121755523908370432_n.jpg'),
('20181125', 'akapon123', '64513b99bd8a8d727e14a83504385c08', 'เอกพล', 'ยอดนิยม', '0832215970', 'akapon123@gmail.com', 'บ้านเลขที่ 1238  ม.8/255 ต.บ้านบึง อ.บ้านบึง จ.ชลบุรี', 12000, 'PS', '36370331_1000148036814987_6451697196839469056_n(1)(1).jpg'),
('20181126', 'manee123', '8670479fb5efec88e3a8d2fa0fe1fee1', 'มณีแสง', 'แสงกระจ่าง', '0876987780', 'manee123@gmail.com', 'บ้านเลขที่ 25  ม.3/2 ต.บ้านบึง อ.บ้านบึง จ.ชลบุรี', 12000, 'HR', '6.jpg'),
('20181127', 'kalayanut', 'ed57dbdf6707822a0172bd8b763ff027', 'กัลญานัฐ', 'แสงกระจ่าง', '0853154530', 'kalayanut@gmail.com', 'บ้านเลขที่ 5  ม.3/2 ต.บ้านบึง อ.บ้านบึง จ.ชลบุรี', 20000, 'AC', '7.jpg'),
('20181128', 'kidakarn', '0192023a7bbd73250516f069df18b500', 'กิดาการ', 'อินทปัญญา', '0831101923', 'kidakarn@gmail.com', 'บ้านเลขที่ 830  2/255 ต.บ้านบึง อ.บ้านบึง จ.ชลบุรี', 20000, 'GP', '8.jpg'),
('20181129', 'patom11', 'aee781bea68334cb232f275f43cf060b', 'ปฐมพร', 'รุ่งเรืองฤทัย', '0860123490', 'patom123@gmail.com', 'บ้านเลขที่ 25  3/2 ต.บ้านบึง อ.บ้านบึง จ.ชลบุรี', 20000, 'PS', '9.jpg'),
('20181130', 'company123', 'f13ba28db45b86089ace6be57551b769', 'ศกร', 'มีชัย', '0892158730', 'company123@gmail.com', 'บ้านเลขที่ 158  5/255 ต.บ้านบึง อ.บ้านบึง จ.ชลบุรี', 50000, 'MG', '10.png'),
('20181131', 'nut1125', '7674f1a355103424ac8253a4faa66af7', 'ณัฐพล', 'เนรมัติ', '0846610283', 'nutaplon114@gmail.com', 'บ้านเลขที่ 255  5/255 ต.บ้านบึง อ.บ้านบึง จ.ชลบุรี', 15000, 'GP', '11.jpg'),
('20181132', 'niti224', '2b11188e26cb8ce8ec713b104ece3c64', 'นิติ', 'เกล้าการ', '0846621039', 'niti224@gmail.com', 'บ้านเลขที่ 255  5/255 ต.บ้านบึง อ.บ้านบึง จ.ชลบุรี', 15000, 'GP', 'Capture.JPG'),
('20181133', 'pokkeg', '62af56614667044932ecdb62ff01c168', 'ปกเกต', 'ธรรมสถิต', '0879661580', 'pokkeg123@yahoo.com', 'บ้านเลขที่ 201  5/255 ต.บ้านบึง อ.บ้านบึง จ.ชลบุรี', 15000, 'GP', '48405284_2045558368820543_3802470989669859328_n.jpg'),
('20181137', 'rung1192', '15e08b2bb83f9be7585e5b2553388f0e', 'รุ่งทิวา', 'สุขพัฒน์', '0953368741', 'rung1192@thailmail.com', 'บ้านเลขที่ 25  5/255 ต.บ้านบึง อ.บ้านบึง จ.ชลบุรี', 12000, 'PS', 'หนึ่งรุ่งทิวา_นาสำแดง.jpg'),
('20181139', 'bs21455', '9ed31c9d3d069b4524efed196c2745c6', 'บดินทร์', 'กันทะวงศ์', '0953368739', 'boos21455@gmail.com', 'บ้านเลขที่  98  4/255 ต.บ้านบึง อ.บ้านบึง จ.ชลบุรี', 12000, 'SV', '30714256_1745115035555301_2276186010410445651_n.jpg'),
('20181140', 'tong1145', '2a774cf328bc683c125f65796f304997', 'ศตนันท์', 'ทองคำ', '0953368738', 'tongcha2241@yahoo.com', 'บ้านเลขที่ 828  3/2 ต.บ้านบึง อ.บ้านบึง จ.ชลบุรี', 12000, 'SV', '1024_14428281221.jpg');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`CAT_ID`);

--
-- Indexes for table `checks`
--
ALTER TABLE `checks`
  ADD PRIMARY KEY (`id_check`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`CUS_PHONE`);

--
-- Indexes for table `departments`
--
ALTER TABLE `departments`
  ADD PRIMARY KEY (`DEP_ID`);

--
-- Indexes for table `income`
--
ALTER TABLE `income`
  ADD PRIMARY KEY (`ID_INCOME`);

--
-- Indexes for table `lable`
--
ALTER TABLE `lable`
  ADD PRIMARY KEY (`LABLE_ID`);

--
-- Indexes for table `staff`
--
ALTER TABLE `staff`
  ADD PRIMARY KEY (`STAFF_ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `CAT_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `checks`
--
ALTER TABLE `checks`
  MODIFY `id_check` int(11) NOT NULL AUTO_INCREMENT COMMENT 'รหัสตรวจสอบ', AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
