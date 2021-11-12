-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 12, 2021 at 02:43 PM
-- Server version: 10.4.20-MariaDB
-- PHP Version: 8.0.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `home_app`
--

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `customer_id` int(100) NOT NULL,
  `item_id` int(140) NOT NULL,
  `qty` int(100) NOT NULL,
  `add_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `id` int(200) NOT NULL,
  `cat_name` varchar(100) NOT NULL,
  `cat_url` varchar(100) NOT NULL,
  `status` int(5) NOT NULL,
  `cat_order` int(50) NOT NULL,
  `home` int(5) DEFAULT NULL,
  `parent_id` int(200) DEFAULT NULL,
  `main_img` text NOT NULL,
  `banner_img` text NOT NULL,
  `site_bann` text NOT NULL,
  `textarea` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `cat_name`, `cat_url`, `status`, `cat_order`, `home`, `parent_id`, `main_img`, `banner_img`, `site_bann`, `textarea`) VALUES
(16, 'Refrigerators', 'refrigerators', 1, 1, 1, 0, '1_105-56_27-07-2021_79233_02-09_30-07-2021_67002.jpg', '2_6_03-36_30-07-2021_56383_06-03_31-07-2021_58676.jpg', '2_11_03-12_09-08-2021_24161.jpg', 'sad sad asd'),
(17, 'Electronics', 'electronics', 1, 2, 1, 0, '2_3_03-35_30-07-2021_43577.jpg', '2_1_03-35_30-07-2021_22744.jpg', '3_4_03-12_09-08-2021_65684.jpg', 'sad adsad asdasda'),
(18, 'Fashion', 'fashion', 1, 3, 1, 0, '2_4_03-36_30-07-2021_13853.jpg', '2_6_03-36_30-07-2021_56383.jpg', '4_1_03-13_09-08-2021_16455.jpg', 'sa asdas dasd'),
(20, 'Single Door Fridge', 'single-door-fridge', 1, 1, 0, 16, 'fridge-single-door-501-47_28-07-2021_99051.jpg', '', '', 'Upto 270L Suitable for 2-3 Members'),
(21, 'Fridge Double Door', 'fridge-double-door', 1, 2, 0, 16, 'fridge-double-door-501-44_28-07-2021_91616.jpg', '', '', 'up to 295L Suitable for 3-4 Members'),
(22, 'Fridge Bottom Frezeer', 'fridge-bottom-frezeer', 1, 3, 0, 16, 'fridge-double-door-bottom-frizeer-501-47_28-07-2021_18650.jpg', '', '', 'Double Door with Bottom Freezer'),
(24, 'Single Door with 150L', 'single-door-with-150l', 1, 1, 0, 20, 'fridge-single-door01-31_28-07-2021_74462_03-38_30-07-2021_82316.jpg', '', '', 'a asdsad asdsad'),
(25, 'Single Door with 300L', 'single-door-with-300l', 1, 2, 0, 20, 'fridge-single-door-401-31_28-07-2021_24683_03-38_30-07-2021_43522.jpg', '', '', ''),
(26, 'Single Door with 500L', 'single-door-with-500l', 1, 3, 0, 20, 'fridge-single-door-301-31_28-07-2021_37349_03-39_30-07-2021_68265.jpg', '', '', 'asd sadsad '),
(27, 'Fridge Double Door 150L', 'fridge-double-door-150l', 1, 1, 0, 21, 'fridge-double-door-bottom-frizeer01-41_28-07-2021_72959_01-41_03-08-2021_34094_03-09_03-08-2021_36215.jpg', '', '', 's dasd a'),
(28, 'Fridge Double Door 200L', 'fridge-double-door-200l', 1, 2, 0, 21, 'fridge-double-door-bottom-frizeer-301-41_28-07-2021_59592_05-10_31-07-2021_31682_03-09_03-08-2021_87780.jpg', '', '', 's adasd'),
(29, 'Fridge Double Door 300L', 'fridge-double-door-300l', 1, 3, 0, 21, 'fridge-double-door-bottom-frizeer-501-41_28-07-2021_45901_03-10_03-08-2021_62731.jpg', '', '', 'as das da'),
(30, 'Fridge Bottom Fridge 100L', 'fridge-bottom-fridge-100l', 1, 1, 0, 22, 'fridge-single-door-301-31_28-07-2021_37349_03-39_30-07-2021_68265_01-38_03-08-2021_90856_03-10_03-08-2021_95417.jpg', '', '', 'as dasd'),
(31, 'Fridge Bottom Fridge 150L', 'fridge-bottom-fridge-150l', 1, 2, 0, 22, 'fridge-single-door-501-47_28-07-2021_99051_03-10_03-08-2021_51411.jpg', '', '', 'a dasd '),
(32, 'Fridge Bottom Fridge 250L', 'fridge-bottom-fridge-250l', 1, 3, 0, 22, 'fridge-single-door-501-47_28-07-2021_99051_03-10_03-08-2021_53553.jpg', '', '', 'a sdasd '),
(33, 'Fridge Bottom Fridge 350L', 'fridge-bottom-fridge-350l', 1, 4, 0, 22, '1_605-56_27-07-2021_10562_03-10_03-08-2021_45637.jpg', '', '', 'sad asd asdas'),
(34, 'Two Side Door Fridge', 'two-side-door-fridge', 1, 4, 0, 16, 'fridge-double-door-501-44_28-07-2021_91616_03-11_03-08-2021_93751.jpg', '', '', ' sad asd asdasd'),
(35, 'Two Side Door Fridge 100L', 'two-side-door-fridge-100l', 1, 1, 0, 34, 'fridge-double-door-401-35_28-07-2021_78253_01-38_03-08-2021_58662_03-11_03-08-2021_56396.jpg', '', '', ' asd asd'),
(36, 'Two Side Door Fridge 200L', 'two-side-door-fridge-200l', 1, 2, 0, 34, 'fridge-double-door-bottom-frizeer-401-41_28-07-2021_31429_03-11_03-08-2021_16520.jpg', '', '', 's adas '),
(37, 'Two Side Door Fridge 300L', 'two-side-door-fridge-300l', 1, 3, 0, 34, 'fridge-single-door-201-31_28-07-2021_83862_03-11_03-08-2021_72559.jpg', '', '', 'a asdasd'),
(38, 'Two Side Door Fridge 400L', 'two-side-door-fridge-400l', 1, 4, 0, 34, 'fridge-single-door-301-31_28-07-2021_37349_03-39_30-07-2021_68265_03-12_03-08-2021_13984.jpg', '', '', ' sad asdasdas'),
(39, 'Accessories', 'accessories', 1, 1, 0, 17, '2_4_03-36_30-07-2021_13853_06-30_31-07-2021_96012_05-35_05-08-2021_74664.jpg', '', '', 'as das dasd as d'),
(40, 'Mobiles', 'mobiles', 1, 2, 0, 17, '2_1_03-35_30-07-2021_22744_05-14_05-08-2021_18370_05-36_05-08-2021_45773.jpg', '', '', 'sa asd a'),
(41, 'Televisions', 'televisions', 1, 3, 0, 17, '2_3_03-35_30-07-2021_43577_06-30_31-07-2021_18485_05-36_05-08-2021_32155.jpg', '', '', 'sddsac'),
(42, 'Fridge Bottom fridge 500L', 'fridge-bottom-fridge-500l', 1, 5, 0, 22, '2_1_03-35_30-07-2021_22744_05-09_06-08-2021_37146.jpg', '', '', ' asdasdasd'),
(52, 'Mens Fashion', 'mens-fashion', 1, 1, 0, 18, '3-1_2_06-36_07-08-2021_52903.jpg', '', '', ' asdas d asdasd');

-- --------------------------------------------------------

--
-- Table structure for table `distributers`
--

CREATE TABLE `distributers` (
  `id` int(200) NOT NULL,
  `shop_name` varchar(100) NOT NULL,
  `distri_name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone` varchar(15) NOT NULL,
  `whatsapp` varchar(15) NOT NULL,
  `address` varchar(200) NOT NULL,
  `city` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `distributers`
--

INSERT INTO `distributers` (`id`, `shop_name`, `distri_name`, `email`, `phone`, `whatsapp`, `address`, `city`) VALUES
(1, 'Vikalp Enterprises', 'Vikalp Soni', 'vikalp@gmail.com', '+91-982863554', '+91-98286355', 'Plot No. 32A, New Moti Nagar, Near HP Petrol Station, Ghanaur Road, Ambala City, Haryana 134 003', 'Jaipur'),
(2, 'Pratik Enterprises', 'Pratik Rana ', 'pratik@gmail.com', '+91-9826345515', '+91-98263455', 'Plot No. 32A, New Moti Nagar, Near HP Petrol Station, Ghanaur Road, Ambala City, Haryana 134 003', 'Jaipur');

-- --------------------------------------------------------

--
-- Table structure for table `enquiry`
--

CREATE TABLE `enquiry` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(200) NOT NULL,
  `phone` varchar(122) NOT NULL,
  `city` varchar(100) NOT NULL,
  `enquiry` text NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `enquiry`
--

INSERT INTO `enquiry` (`id`, `name`, `email`, `phone`, `city`, `enquiry`, `date`) VALUES
(1, 'Aashish', 'an7162@gmail.com', '7062182162', 'Jaipur', 'asdas d asasdasdasdasdasdasdasd asd asd asd', '2021-07-23'),
(3, 'admins sad', 'ashunayakme@gmail.com', '1234567890', 'Bikaner', ' sadasdasd as', '2021-07-23'),
(4, 'admin', 'ashunayakme@gmail.com', '8209050726', 'Jodhpur', ' sadasdasd as', '2021-07-28'),
(5, 'Aashish Nayak', 'ashunayakme@gmail.com', '9828725519', 'Alwar', 'sa sad sa', '2021-07-28');

-- --------------------------------------------------------

--
-- Table structure for table `images_tb`
--

CREATE TABLE `images_tb` (
  `id` int(200) NOT NULL,
  `img_id` int(150) NOT NULL,
  `img1` varchar(200) NOT NULL,
  `img2` varchar(200) NOT NULL,
  `img3` varchar(200) NOT NULL,
  `img4` varchar(200) NOT NULL,
  `img5` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `images_tb`
--

INSERT INTO `images_tb` (`id`, `img_id`, `img1`, `img2`, `img3`, `img4`, `img5`) VALUES
(5, 7, 'fridge-single-door01-31_28-07-2021_74462.jpg', 'fridge-single-door-201-31_28-07-2021_83862.jpg', 'fridge-single-door-301-31_28-07-2021_37349.jpg', 'fridge-single-door-401-31_28-07-2021_24683.jpg', 'fridge-single-door-501-31_28-07-2021_44747.jpg'),
(6, 8, 'fridge-double-door01-35_28-07-2021_84643.jpg', 'fridge-double-door-201-35_28-07-2021_13619.jpg', 'fridge-double-door-301-35_28-07-2021_50414.jpg', 'fridge-double-door-401-35_28-07-2021_78253.jpg', 'fridge-double-door-501-35_28-07-2021_65660.jpg'),
(7, 9, 'fridge-double-door-bottom-frizeer01-41_28-07-2021_72959.jpg', 'fridge-double-door-bottom-frizeer-301-41_28-07-2021_59592.jpg', 'fridge-double-door-bottom-frizeer-201-41_28-07-2021_87658.jpg', 'fridge-double-door-bottom-frizeer-401-41_28-07-2021_31429.jpg', 'fridge-double-door-bottom-frizeer-501-41_28-07-2021_45901.jpg'),
(8, 10, 'fridge-single-door01-31_28-07-2021_74462_05-10_31-07-2021_11082.jpg', 'fridge-double-door-bottom-frizeer-301-41_28-07-2021_59592_05-10_31-07-2021_31682.jpg', 'fridge-double-door-bottom-frizeer-201-41_28-07-2021_87658_05-10_31-07-2021_40332.jpg', 'fridge-double-door-bottom-frizeer-501-47_28-07-2021_18650_05-10_31-07-2021_4784.jpg', 'fridge-double-door-bottom-frizeer-501-41_28-07-2021_45901_05-10_31-07-2021_77636.jpg'),
(9, 11, '2_3_03-35_30-07-2021_43577_06-30_31-07-2021_18485.jpg', '2_1_03-35_30-07-2021_22744_06-30_31-07-2021_73171.jpg', '2_4_03-36_30-07-2021_13853_06-30_31-07-2021_96012.jpg', '2_505-54_27-07-2021_93534_06-30_31-07-2021_90320.jpg', '2_6_03-36_30-07-2021_56383_06-30_31-07-2021_68853.jpg'),
(10, 12, 'fridge-single-door-301-31_28-07-2021_37349_03-39_30-07-2021_68265_01-38_03-08-2021_90856.jpg', 'fridge-single-door01-31_28-07-2021_74462_03-38_30-07-2021_82316_01-38_03-08-2021_44923.jpg', 'fridge-double-door-201-35_28-07-2021_13619_01-38_03-08-2021_42616.jpg', 'fridge-double-door-401-35_28-07-2021_78253_01-38_03-08-2021_58662.jpg', 'fridge-double-door-bottom-frizeer-501-47_28-07-2021_18650_05-10_31-07-2021_4784_01-38_03-08-2021_39466.jpg'),
(11, 13, 'fridge-double-door-301-35_28-07-2021_50414_01-41_03-08-2021_29309.jpg', 'fridge-double-door-bottom-frizeer01-41_28-07-2021_72959_01-41_03-08-2021_34094.jpg', 'fridge-double-door-201-35_28-07-2021_13619_01-41_03-08-2021_81999.jpg', 'fridge-double-door-201-35_28-07-2021_13619_01-38_03-08-2021_42616_01-41_03-08-2021_70889.jpg', 'fridge-double-door-301-35_28-07-2021_50414_01-41_03-08-2021_7088.jpg'),
(12, 14, '2_1_03-35_30-07-2021_22744_05-14_05-08-2021_18370.jpg', 'fridge-double-door-401-35_28-07-2021_78253_01-38_03-08-2021_58662_03-11_03-08-2021_56396_04-07_05-08-2021_15777.jpg', '', '', ''),
(13, 15, 'fridge-double-door-bottom-frizeer-301-41_28-07-2021_59592_04-54_05-08-2021_84182.jpg', 'fridge-double-door-301-35_28-07-2021_50414_04-54_05-08-2021_46207.jpg', '', '', ''),
(14, 16, '2_1_03-35_30-07-2021_22744_05-14_05-08-2021_18370_05-37_05-08-2021_14038.jpg', '', '', '', ''),
(15, 17, '2_1_03-35_30-07-2021_22744_05-14_05-08-2021_18370_05-37_05-08-2021_84798.jpg', '', '', '', ''),
(16, 18, '2_1_03-35_30-07-2021_22744_05-38_05-08-2021_54297.jpg', '', '', '', ''),
(17, 19, '2_1_03-35_30-07-2021_22744_05-38_05-08-2021_46262.jpg', '2_1_03-35_30-07-2021_22744_05-14_05-08-2021_18370_05-38_05-08-2021_39124.jpg', '', '', ''),
(18, 20, '2_3_03-35_30-07-2021_43577_05-41_05-08-2021_62595.jpg', '2_3_03-35_30-07-2021_43577_06-30_31-07-2021_18485_05-41_05-08-2021_9769.jpg', '', '', ''),
(19, 21, '3-1_1_06-37_07-08-2021_14878.jpg', '3-2_1_06-37_07-08-2021_52038.jpg', '', '', ''),
(20, 21, '3-1_1_06-37_07-08-2021_55070.jpg', '3-2_1_06-37_07-08-2021_80440.jpg', '', '', ''),
(21, 22, '3-3_2_06-38_07-08-2021_24374.jpg', '3-4_1_06-38_07-08-2021_66481.jpg', '3-3_1_06-38_07-08-2021_83925.jpg', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `logintry`
--

CREATE TABLE `logintry` (
  `id` int(20) NOT NULL,
  `ip` varchar(16) NOT NULL,
  `try` int(5) NOT NULL,
  `ltime` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `page`
--

CREATE TABLE `page` (
  `id` int(200) NOT NULL,
  `title` varchar(150) NOT NULL,
  `url` varchar(200) NOT NULL,
  `cat_type` varchar(150) NOT NULL,
  `page_order` int(100) NOT NULL,
  `status` int(10) NOT NULL,
  `price` int(100) NOT NULL,
  `description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `page`
--

INSERT INTO `page` (`id`, `title`, `url`, `cat_type`, `page_order`, `status`, `price`, `description`) VALUES
(7, 'Whirlpool 215 L 5 Star Inverter Direct-Cool Single Door Refrigerator (230 IMPRO ROY 5S INV SAPPHIRE ABYSS, Sapphire Abyss)', 'whirlpool-single-door', 'single-door-fridge', 1, 1, 15000, '<p>Keywords = refrigerator</p>\r\n\r\n<table>\r\n	<tbody>\r\n		<tr>\r\n			<td>M.R.P.:</td>\r\n			<td>?20,150.00</td>\r\n		</tr>\r\n		<tr>\r\n			<td>Price:</td>\r\n			<td>?18,240.00</td>\r\n		</tr>\r\n	</tbody>\r\n</table>\r\n\r\n<p>Eligible for Free Open Box Inspection&nbsp;<a href=\"javascript:void(0)\" id=\"openbox_eligibility\">Details&nbsp;</a></p>\r\n\r\n<table>\r\n	<tbody>\r\n		<tr>\r\n			<td>Colour</td>\r\n			<td>Sapphire Abyss</td>\r\n		</tr>\r\n		<tr>\r\n			<td>Brand</td>\r\n			<td>Whirlpool</td>\r\n		</tr>\r\n		<tr>\r\n			<td>Model Name</td>\r\n			<td>230 IMPRO ROY 5S INV SAPPHIRE ABYSS</td>\r\n		</tr>\r\n		<tr>\r\n			<td>Form Factor</td>\r\n			<td>Convertible</td>\r\n		</tr>\r\n		<tr>\r\n			<td>Pattern</td>\r\n			<td>Floral</td>\r\n		</tr>\r\n	</tbody>\r\n</table>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<h1>About this item</h1>\r\n\r\n<ul>\r\n	<li>Direct-cool refrigerator; 215 litres capacity</li>\r\n	<li>Energy Rating: 5 Star</li>\r\n	<li>Warranty: 1 year on product, 10 years on compressor</li>\r\n	<li>New crescent door Design</li>\r\n	<li>Intellisense inverter technology</li>\r\n	<li>Up to 7 days of Garden freshness. Convertible Refrigerator: No</li>\r\n	<li>Up to 12 hours of milk preservation during power cuts</li>\r\n</ul>\r\n'),
(8, 'Whirlpool 265 L 3 Star Inverter Frost-Free Double Door Refrigerator (INTELLIFRESH INV CNV 278 3S, German Steel, Convertible)', 'whirlpool-double-door', 'fridge-double-door', 1, 1, 15000, '<p>Keywords = refrigerator</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<table>\r\n	<tbody>\r\n		<tr>\r\n			<td>M.R.P.:</td>\r\n			<td>?20,150.00</td>\r\n		</tr>\r\n		<tr>\r\n			<td>Price:</td>\r\n			<td>?18,240.00</td>\r\n		</tr>\r\n	</tbody>\r\n</table>\r\n\r\n<p>Eligible for Free Open Box Inspection&nbsp;<a href=\"javascript:void(0)\" id=\"openbox_eligibility\">Details&nbsp;</a></p>\r\n\r\n<table>\r\n	<tbody>\r\n		<tr>\r\n			<td>Colour</td>\r\n			<td>Grey</td>\r\n		</tr>\r\n		<tr>\r\n			<td>Brand</td>\r\n			<td>Whirlpool</td>\r\n		</tr>\r\n		<tr>\r\n			<td>Model Name</td>\r\n			<td>INTELLIFRESH INV CNV 278 3S</td>\r\n		</tr>\r\n		<tr>\r\n			<td>Form Factor</td>\r\n			<td>Double Door</td>\r\n		</tr>\r\n		<tr>\r\n			<td>Pattern</td>\r\n			<td>Solid</td>\r\n		</tr>\r\n	</tbody>\r\n</table>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<h1>About this item</h1>\r\n\r\n<ul>\r\n	<li>Important note : This product is 4-star rated as per 2019 BEE rating and 3-star rated as per 2020 BEE rating</li>\r\n	<li>Frost-free refrigerator; 265 litres capacity.Wattage (W) 125</li>\r\n	<li>Energy Rating: 3 Star</li>\r\n	<li>Warranty: 1 year on product, 10 years on compressor</li>\r\n	<li>Convertible freezer with 5 in 1 modes - the convertible freezer comes with 5 in 1 modes. All season mode, chef mode, Dessert mode, party mode and deep freeze mode</li>\r\n	<li>Adaptive intelligence technology:(AI) microprocessor and 3 intellisensors sense load, weather conditions and usage patterns ensuring optimum cooling for long-lasting freshness</li>\r\n	<li>Intellisense inverter technology - auto-connect to home Inverter. It efficiently adapts the cooling according to internal load. It reduces energy consumption and ensures matchless performances</li>\r\n</ul>\r\n\r\n<ul>\r\n	<li>Fresh flow air tower with flexi vents: scientifically designed air tower and strategically placed vents L out cool and fresh air I different sections of the refrigerator</li>\r\n	<li>Microblock prevents up to 99 percent bacterial growth, keeping fruits and vegetables fresh for longer</li>\r\n	<li>Special features: stabilizer free operation, ice twister and collector, Zeolite technology, active deo, 6th sense deep freeze technology</li>\r\n</ul>\r\n'),
(9, 'Whirlpool 355 L 3 Star Frost Free Double Door Refrigerator (IFPRO INV CNV 370 3S, Omega Steel, Convertible)', 'whirlpool-double-refrigerator-bottom-frizeer', 'fridge-bottom-frezeer', 1, 1, 13000, '<p>Keywords = refrigerator</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<table>\r\n	<tbody>\r\n		<tr>\r\n			<td>M.R.P.:</td>\r\n			<td>?50,100.00</td>\r\n		</tr>\r\n		<tr>\r\n			<td>Price:</td>\r\n			<td>\r\n			<p>?40,247.00</p>\r\n\r\n			<p>&nbsp;</p>\r\n			</td>\r\n		</tr>\r\n		<tr>\r\n			<td>You Save:</td>\r\n			<td>?9,853.00 (20%)</td>\r\n		</tr>\r\n	</tbody>\r\n</table>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>Eligible for Free Open Box Inspection&nbsp;<a href=\"javascript:void(0)\" id=\"openbox_eligibility\">Details&nbsp;</a></p>\r\n\r\n<table>\r\n	<tbody>\r\n		<tr>\r\n			<td>Colour</td>\r\n			<td>Silver</td>\r\n		</tr>\r\n		<tr>\r\n			<td>Brand</td>\r\n			<td>Whirlpool</td>\r\n		</tr>\r\n		<tr>\r\n			<td>Model Name</td>\r\n			<td>IFPRO INV CNV 370 3S</td>\r\n		</tr>\r\n		<tr>\r\n			<td>Form Factor</td>\r\n			<td>Standard_double_door</td>\r\n		</tr>\r\n		<tr>\r\n			<td>Pattern</td>\r\n			<td>Solid</td>\r\n		</tr>\r\n	</tbody>\r\n</table>\r\n\r\n<hr />\r\n<h1>About this item</h1>\r\n\r\n<ul>\r\n	<li>Precise Temperature and Humidity Control with Adaptive Intelligence Technology - Equipped with Microprocessors and multiple Intellisensors, the revolutionary adaptive intelligence technology continuously analyses data based on load, frequent door opening, day and night temperature change, and weather pattern to ensure optimum cooling and long lasting freshness</li>\r\n	<li>Convertible 10 in 1 modes - This next generation Convertible technology comes with an intuitive user interface and easy to use 10 modes which adapt to your everyday requirements with just a simple touch! With the Convert time of 23 min the refrigerator helps to adjust as per the need of the consumer.</li>\r\n	<li>Experience No 1 in Freshness with advanced technologies - Up to 15 days of extended freshness powered by Adaptive Intelligence technology, Up to 99% Bacteria Prevention with Microblock Technology, Prevents excessive ripening of fruits and vegetables with Zeolite technology, Up to 7 days of dairy freshness with Adaptive Cooling technology</li>\r\n	<li>Avant Garde Design to give your home a modern look- Smart Space Management designed for Indian consumers with 30:70 Freezer-Fridge Capacity ratio and features like Variable Temperature Zone (Fruit-Veg-Dairy Interchangeable), Large Vegetable Crisper, Portable Ice Twister, Door Bin even in the freezer compartment</li>\r\n	<li>Powerful Performance - Uniform Cooling with 3D Airflow Technology, Intellisense Inverter Compressor + Inverter fan - Up to 45% Faster cooling, Energy Saving, Exceptional durability, Super silent performance @36dB</li>\r\n</ul>\r\n'),
(10, 'Whirlpool Single Door Refrigerator  with 150 L', 'whirlpool-single-door-refrigerator-with-150-l', 'single-door-with-150l', 1, 1, 10000, '<p>as dasdas dasdasd as das dsa das d</p>\r\n\r\n<p>Keywords = refrigerator</p>\r\n'),
(11, 'MI Smart TV', 'mi-smart-tv', 'electronics', 1, 1, 9999, '<p>Keyword= Electronics</p>\r\n\r\n<p>s aasndaas assa dasdsad asd as asd</p>\r\n'),
(12, 'Whirlpool Two Side Door Refrigerator  with 150 L', 'whirlpool-two-side-door-refrigerator-with-150-l', 'two-side-door-fridge-100l', 1, 1, 20000, '<p>Keyword = refrigerator</p>\r\n\r\n<p>&nbsp;sad sadasd asd asd</p>\r\n'),
(13, 'Whirlpool Two Side Door Refrigerator with 200 L', 'whirlpool-two-side-door-refrigerator-with-200-l', 'two-side-door-fridge-200l', 2, 1, 25000, '<p>Keyword = refrigerator&nbsp;</p>\r\n'),
(14, 'How to Create Category and Subcategory in PHP', 'how-to-create-category-and-subcategory-in-php', 'single-door-fridge', 2, 1, 0, '<p>as dasdasd</p>\r\n'),
(15, 'Large Appliances', 'large-appliances', 'refrigerators', 1, 1, 15000, '<p>sa das dasdasd asd asd asd asd</p>\r\n'),
(16, 'Mobile Cover for MI Mobiles', 'mobile-cover-for-mi-mobiles', 'accessories', 1, 1, 100, '<p>asd as dasMobile Cover for MI MobilesMobile Cover for MI MobilesMobile Cover for MI MobilesMobile Cover for MI MobilesMobile Cover for MI MobilesMobile Cover for MI MobilesMobile Cover for MI Mobiles</p>\r\n'),
(17, 'Mobile Cover for OPPO Mobiles', 'mobile-cover-for-oppo-mobiles', 'accessories', 2, 1, 150, '<p>aMobile Cover for MI MobilesMobile Cover for MI MobilesMobile Cover for MI MobilesMobile Cover for MI MobilesMobile Cover for MI MobilesMobile Cover for MI Mobiles</p>\r\n'),
(18, 'XIOMI Note 8 Pro', 'xiomi-note-8-pro', 'mobiles', 1, 1, 20000, '<p>s adas dXIOMI Note 8 ProXIOMI Note 8 ProXIOMI Note 8 ProXIOMI Note 8 ProXIOMI Note 8 Pro</p>\r\n'),
(19, 'OnePlus G65 Pro', 'oneplus-g65-pro', 'mobiles', 2, 1, 35000, '<p>OnePlus G65 ProOnePlus G65 ProOnePlus G65 ProOnePlus G65 ProOnePlus G65 ProOnePlus G65 Pro</p>\r\n'),
(20, 'XIOMI Smart TV', 'xiomi-smart-tv', 'televisions', 1, 1, 15000, '<p>XIOMI Smart TVXIOMI Smart TVXIOMI Smart TVXIOMI Smart TVXIOMI Smart TVXIOMI Smart TVXIOMI Smart TVXIOMI Smart TV</p>\r\n'),
(21, 'Nike T-shirt Mens Fashion', 'nike-t-shirt-mens-fashion', 'mens-fashion', 1, 1, 200, '<p>&nbsp;as asd asd</p>\r\n'),
(22, 'Adiddas T-shirt Mens Fashion', 'adiddas-t-shirt-mens-fashion', 'mens-fashion', 2, 1, 1200, '');

-- --------------------------------------------------------

--
-- Table structure for table `website_user`
--

CREATE TABLE `website_user` (
  `id` int(100) NOT NULL,
  `username` varchar(200) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(200) NOT NULL,
  `role` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `website_user`
--

INSERT INTO `website_user` (`id`, `username`, `email`, `password`, `role`) VALUES
(1, 'Admin', 'admin@gmail.com', '$2y$10$2bCwGxvKu7u1mWWFzhkWiud.StHs6B8.cacFbT1IBShr4ItWRr.q2', 'superadmin'),
(2, 'Aashish', 'an706218@gmail.com', '$2y$10$qQz/HS2DqMCpnLyHUi96Kuj3q3dedM0jrtaffpD/u64sAiXWW4kBS', 'admin'),
(3, 'Kirti', 'kirti@gmail.com', '$2y$10$4.cA35WKCwYvjoa5oDlGVecLJV1lw/nRRSnW9dfDWS2JNo1GUmzRi', 'manage_product'),
(4, 'Akhil', 'akhil@gmail.com', '$2y$10$K1rJgNj5MP.FAXAVyzWH.OAGMclGbD6jy7DOgzqJBSduzoJsxe0Cy', 'manage_enquiry');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `distributers`
--
ALTER TABLE `distributers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `enquiry`
--
ALTER TABLE `enquiry`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `images_tb`
--
ALTER TABLE `images_tb`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `logintry`
--
ALTER TABLE `logintry`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `page`
--
ALTER TABLE `page`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `url` (`url`);

--
-- Indexes for table `website_user`
--
ALTER TABLE `website_user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` int(200) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- AUTO_INCREMENT for table `distributers`
--
ALTER TABLE `distributers`
  MODIFY `id` int(200) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `enquiry`
--
ALTER TABLE `enquiry`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `images_tb`
--
ALTER TABLE `images_tb`
  MODIFY `id` int(200) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `logintry`
--
ALTER TABLE `logintry`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `page`
--
ALTER TABLE `page`
  MODIFY `id` int(200) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `website_user`
--
ALTER TABLE `website_user`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
