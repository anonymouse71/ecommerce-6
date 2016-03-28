-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Mar 29, 2016 at 12:08 AM
-- Server version: 5.6.17
-- PHP Version: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `watchesecommerce`
--

-- --------------------------------------------------------

--
-- Table structure for table `feedbacks`
--

CREATE TABLE IF NOT EXISTS `feedbacks` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `UserId` int(11) NOT NULL,
  `Title` varchar(255) NOT NULL,
  `Details` text NOT NULL,
  `CreateTime` datetime NOT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=12 ;

--
-- Dumping data for table `feedbacks`
--

INSERT INTO `feedbacks` (`Id`, `UserId`, `Title`, `Details`, `CreateTime`) VALUES
(1, 1, 'Test', 'Test một tý', '2016-03-18 16:27:55'),
(2, 1, 'Test', 'test hai tÃ½', '2016-03-18 16:31:19'),
(3, 1, 'Kiá»ƒm tra', 'Kiá»ƒm tra má»™t táº¹o', '2016-03-18 16:33:14'),
(4, 1, 'Kiểm tra', 'Kiểm tra cho chắc chắn.', '2016-03-18 16:33:49'),
(5, 1, 'ghdgkhdfkgh', 'klghdklhgdfkj', '2016-03-28 04:12:23'),
(6, 1, 'gdfgdfg', 'gdfgdfg', '2016-03-28 04:12:35'),
(7, 1, 'gdfgdfg', 'gdfgdfg', '2016-03-28 04:13:39'),
(8, 1, 'gdfgdfgdg', 'gdfgdfgdfg', '2016-03-28 04:13:46'),
(9, 1, 'jgjghj', 'jghjhg', '2016-03-28 04:13:57'),
(10, 1, 'gdfgdf', 'gfdg', '2016-03-28 04:14:50'),
(11, 1, 'ghdfhgjh', 'gdfj', '2016-03-28 04:16:44');

-- --------------------------------------------------------

--
-- Table structure for table `orderlines`
--

CREATE TABLE IF NOT EXISTS `orderlines` (
  `Id` int(11) NOT NULL,
  `OrderId` int(11) NOT NULL,
  `WatchesId` int(11) NOT NULL,
  `Quantity` int(11) NOT NULL,
  `Price` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE IF NOT EXISTS `orders` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `CreateTime` datetime NOT NULL,
  `CloseTime` datetime NOT NULL,
  `Status` int(11) NOT NULL,
  `UserId` int(11) DEFAULT NULL,
  `Name` varchar(255) NOT NULL,
  `Address` text NOT NULL,
  `Phone` varchar(12) NOT NULL,
  `Email` varchar(255) DEFAULT NULL,
  `Request` text,
  PRIMARY KEY (`Id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `types`
--

CREATE TABLE IF NOT EXISTS `types` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `CodeName` varchar(255) NOT NULL,
  `Name` varchar(255) NOT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `types`
--

INSERT INTO `types` (`Id`, `CodeName`, `Name`) VALUES
(1, 'casio', 'Casio'),
(2, 'rolex', 'Rolex'),
(3, 'omega', 'Omega'),
(4, 'longines', 'Longines'),
(5, 'citizens', 'Citizens'),
(6, 'eposswiss', 'Eposwiss');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `Password` varchar(255) NOT NULL,
  `Email` varchar(255) NOT NULL,
  `CreateTime` datetime NOT NULL,
  `Admin` int(11) NOT NULL,
  `Name` varchar(255) NOT NULL,
  `Sex` int(11) NOT NULL,
  `DoB` date NOT NULL,
  `IdCard` varchar(10) NOT NULL,
  `Address` text NOT NULL,
  `Phone` varchar(12) NOT NULL,
  PRIMARY KEY (`Id`),
  UNIQUE KEY `Username` (`Email`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`Id`, `Password`, `Email`, `CreateTime`, `Admin`, `Name`, `Sex`, `DoB`, `IdCard`, `Address`, `Phone`) VALUES
(1, 'e3afed0047b08059d0fada10f400c1e5', 'letuandat@hotmail.com', '2016-03-18 00:00:00', 0, 'Lê Tuấn Đạt', 0, '1995-05-11', '101204749', '38 Vĩnh Hưng, Hà Nội', '0944457247'),
(2, 'e10adc3949ba59abbe56e057f20f883e', 'anhanhthu@gmail.com', '0000-00-00 00:00:00', 0, 'Phạm Thị Anh Thư', 1, '0000-00-00', '101205484', '55 Phú Diễn', '0546546654'),
(8, 'e10adc3949ba59abbe56e057f20f883e', 'tuan@gmail.com', '2016-03-29 04:23:24', 0, 'Phạm Anh Tuấn', 0, '0000-00-00', '', '', ''),
(9, 'e10adc3949ba59abbe56e057f20f883e', 'vyanh@gmail.com', '2016-03-29 04:25:15', 0, 'Vy Trung Anh', 1, '1995-01-01', '546541156', '454 Minh Khai', '346871326');

-- --------------------------------------------------------

--
-- Table structure for table `watches`
--

CREATE TABLE IF NOT EXISTS `watches` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `CodeName` varchar(255) NOT NULL,
  `Name` varchar(255) NOT NULL,
  `Type` varchar(255) DEFAULT NULL,
  `Origin` varchar(255) DEFAULT NULL,
  `Year` int(11) DEFAULT NULL,
  `Details` text,
  `Price` bigint(20) DEFAULT NULL,
  `CreateTime` datetime NOT NULL,
  `Picture` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `watches`
--

INSERT INTO `watches` (`Id`, `CodeName`, `Name`, `Type`, `Origin`, `Year`, `Details`, `Price`, `CreateTime`, `Picture`) VALUES
(1, 'MTP-V004GL-9AUDF', 'Đồng hồ Casio MTP-V004GL-9AUDF', 'Casio', 'Nhật bản', 2010, 'Hãng sản xuất: Đồng hồ Casio\r\n\r\nKiểu dáng: Đồng hồ nam\r\n\r\nMáy: Pin\r\n\r\nChất liệu vỏ: Thép không gỉ hay còn gọi là inox (All Stainless Steel)\r\n\r\nChất liệu dây: dây da\r\n\r\nBảo hành: 1 năm\r\n\r\nXuất xứ: Nhật Bản\r\n\r\nMặt kính: Mineral Crystal', 720000, '2016-03-28 07:19:11', '1.jpg'),
(2, 'MTP-V005GL-9AUDF', 'Đồng hồ Casio MTP-V005GL-9AUDF', 'Casio', 'Nhật bản', 2008, 'Hãng sản xuất: Đồng hồ Casio\r\n\r\nKiểu dáng: Đồng hồ nam\r\n\r\nMáy: Pin\r\n\r\nChất liệu vỏ: Thép không gỉ hay còn gọi là inox (All Stainless Steel)\r\n\r\nChất liệu dây: dây da\r\n\r\nBảo hành: 1 năm\r\n\r\nXuất xứ: Nhật Bản\r\n\r\nMặt kính: Mineral Crystal', 630000, '2016-03-28 08:56:37', '835008269_dong-ho-casio-MTP-V005GL-9AUDF.jpg'),
(3, 'MTP-V006L-1BUDF', 'Đồng hồ Casio MTP-V006L-1BUDF', 'Casio', 'Nhật bản', 2009, 'Hãng sản xuất: Đồng hồ Casio\r\n\r\nKiểu dáng: Đồng hồ nam\r\n\r\nMáy: Pin\r\n\r\nChất liệu vỏ: Thép không gỉ hay còn gọi là inox (All Stainless Steel)\r\n\r\nChất liệu dây: dây da\r\n\r\nBảo hành: 1 năm\r\n\r\nXuất xứ: Nhật Bản\r\n\r\nMặt kính: Mineral Crystal', 720000, '2016-03-28 08:56:37', '46234354_MTP-V006L-1BUDF.png'),
(4, 'MTP-V004L-1AUDF', 'Đồng hồ Casio MTP-V004L-1AUDF', 'Casio', 'Nhật bản', 2004, 'Hãng sản xuất: Đồng hồ Casio\r\n\r\nKiểu dáng: Đồng hồ nam\r\n\r\nMáy: Pin\r\n\r\nChất liệu vỏ: Thép không gỉ hay còn gọi là inox (All Stainless Steel)\r\n\r\nChất liệu dây: dây da\r\n\r\nBảo hành: 1 năm\r\n\r\nXuất xứ: Nhật Bản\r\n\r\nMặt kính: Mineral Crystal', 675000, '2016-03-28 08:58:16', '179199675_dong-ho-casio-MTP-V004L-1AUDF.jpg'),
(5, 'MTP-V002D-1AUDF', 'Đồng hồ Casio MTP-V002D-1AUDF', 'Casio', 'Nhật bản', 2004, 'Hãng sản xuất: Đồng hồ Casio\r\n\r\nKiểu dáng: Đồng hồ nam\r\n\r\nMáy: Pin\r\n\r\nChất liệu vỏ: Thép không gỉ hay còn gọi là inox (All Stainless Steel)\r\n\r\nChất liệu dây: Thép không gỉ\r\n\r\nBảo hành: 1 năm\r\n\r\nXuất xứ: Nhật Bản\r\n\r\nMặt kính: Mineral Crystal', 765000, '2016-03-28 08:58:16', '888144402_dong-ho-casio-MTP-V002D-1AUDF.jpg');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
