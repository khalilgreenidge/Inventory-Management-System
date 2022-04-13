-- phpMyAdmin SQL Dump
-- version 4.2.7.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Mar 11, 2017 at 10:06 PM
-- Server version: 5.6.20
-- PHP Version: 5.5.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `heduis`
--
CREATE DATABASE heduis;
USE heduis;
-- --------------------------------------------------------

--
-- Table structure for table `activation_links`
--

CREATE TABLE IF NOT EXISTS `activation_links` (
  `hash` varchar(40) NOT NULL,
  `startDate` date NOT NULL,
  `endDate` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `activation_links`
--

INSERT INTO `activation_links` (`hash`, `startDate`, `endDate`) VALUES
('00edbb83472a25f592cd816cc5b6f375', '2015-04-25', '0000-00-00'),
('460e9f409d3deb5151d1651559f351e7', '2017-03-11', '2017-03-18'),
('7494b2948f127fe1ffcd26d6be15df92', '2015-04-25', '0000-00-00'),
('a9ac48f569e5644ca47f7437b1dbb402', '2015-04-25', '0000-00-00'),
('dec81c8fca715ce19f4a645866bda16a', '2017-03-11', '2017-03-18'),
('e6f8edb6001b8b5adff8d487db242458', '2015-04-25', '0000-00-00');

-- --------------------------------------------------------

--
-- Table structure for table `licence`
--

CREATE TABLE IF NOT EXISTS `licence` (
  `id` varchar(30) NOT NULL,
  `brand` varchar(30) NOT NULL,
  `version` varchar(30) NOT NULL,
  `key` varchar(30) NOT NULL,
  `type` varchar(30) NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `licence`
--

INSERT INTO `licence` (`id`, `brand`, `version`, `key`, `type`, `start_date`, `end_date`) VALUES
('1', 'Microsoft', 'Server 2012', 'CVXX-JJBB-SDVV-SDVG', 'Software', '2015-04-03', '2015-04-25'),
('2', 'Microsoft', 'Server NT', 'wefe-wefwe-ewf-few-f-we', 'Software', '2013-01-01', '2015-05-19');

-- --------------------------------------------------------

--
-- Table structure for table `loan`
--

CREATE TABLE IF NOT EXISTS `loan` (
  `ticket_id` int(11) NOT NULL,
  `ID` varchar(30) NOT NULL,
  `Officer` varchar(40) NOT NULL,
  `Email` varchar(60) NOT NULL,
  `Returned` varchar(30) NOT NULL,
  `LoanDate` date DEFAULT NULL,
  `ReturnDate` date DEFAULT NULL,
  `Duration` varchar(11) NOT NULL,
  `Reason` varchar(150) NOT NULL,
  `Status` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `loan`
--

INSERT INTO `loan` (`ticket_id`, `ID`, `Officer`, `Email`, `Returned`, `LoanDate`, `ReturnDate`, `Duration`, `Reason`, `Status`) VALUES
(1, 'PA1', 'Khalil Greenidge', 'khalilgreenidge16@gmail.com', 'no', '2015-04-30', '2015-04-30', '24 hours', '', 'accepted'),
(2, 'DA2', 'Khalil Greenidge', 'khalilgreenidge16@gmail.com', 'no', '2015-05-19', '2015-05-19', '24 hours', 'To use for a conference', 'accepted'),
(3, 'F4', 'Khalil Greenidge', 'khalilgreenidge16@gmail.com', 'yes', '2015-05-19', '2015-05-19', '24 hours', 'To use at animecon', 'accepted'),
(4, 'CK2', 'Khalil Greenidge', 'khalilgreenidge16@gmail.com', 'yes', '2015-05-28', '2015-05-30', '02day(s)', 'I want to borrow to use in a meeting', 'accepted'),
(5, 'F4', 'Andre Edghll', 'andreedghill5@gmail.com', 'no', '2015-05-22', '2015-06-11', '20day(s)', '', 'declined'),
(6, 'PBG1', 'Bobby Brown', 'freshprince_kg@hotmail.com', 'no', '2016-08-10', '2016-08-11', '01day(s)', 'I want to use it to write an essay.', 'accepted'),
(7, 'C3', 'Dawne Greenidge', 'blessedandfavoured@gmail.com', 'no', '2016-08-10', '2016-08-11', '01day(s)', 'To type her resume.', 'accepted'),
(8, 'TA1', 'Dawne Greenidge', 'blessedandfavoured@gmail.com', 'yes', '2016-08-10', '2016-08-11', '01day(s)', 'To write an essay', 'accepted'),
(9, 'F3', 'Bobby Brown', 'freshprince_kg@hotmail.com', 'yes', '2016-08-10', '2016-08-11', '01day(s)', 'To type out a resume.', 'accepted');

-- --------------------------------------------------------

--
-- Table structure for table `new_equipment`
--

CREATE TABLE IF NOT EXISTS `new_equipment` (
`id` int(11) NOT NULL,
  `type` varchar(30) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=16 ;

--
-- Dumping data for table `new_equipment`
--

INSERT INTO `new_equipment` (`id`, `type`) VALUES
(9, 'Server'),
(10, 'Router'),
(11, 'Switch'),
(12, 'Firewall'),
(13, 'Tablet'),
(14, 'Laptop'),
(15, 'Projector');

-- --------------------------------------------------------

--
-- Table structure for table `new_office_equipment`
--

CREATE TABLE IF NOT EXISTS `new_office_equipment` (
`id` int(11) NOT NULL,
  `type` varchar(30) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `new_office_equipment`
--

INSERT INTO `new_office_equipment` (`id`, `type`) VALUES
(1, 'Desk'),
(2, 'Chair');

-- --------------------------------------------------------

--
-- Table structure for table `new_stationery`
--

CREATE TABLE IF NOT EXISTS `new_stationery` (
`id` int(11) NOT NULL,
  `type` varchar(30) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=29 ;

--
-- Dumping data for table `new_stationery`
--

INSERT INTO `new_stationery` (`id`, `type`) VALUES
(22, 'Pen'),
(24, 'Pencil'),
(25, 'Highlighter'),
(26, 'Eraser'),
(27, 'Paper'),
(28, 'Whiteout');

-- --------------------------------------------------------

--
-- Table structure for table `password_reset`
--

CREATE TABLE IF NOT EXISTS `password_reset` (
  `hash` varchar(40) NOT NULL,
  `user` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `password_reset`
--

INSERT INTO `password_reset` (`hash`, `user`) VALUES
('00edbb83472a25f592cd816cc5b6f375', 'techadmin'),
('a9ac48f569e5644ca47f7437b1dbb402', 'k.greenidge'),
('dec81c8fca715ce19f4a645866bda16a', 'k.greenidge');

-- --------------------------------------------------------

--
-- Table structure for table `registration`
--

CREATE TABLE IF NOT EXISTS `registration` (
  `hash` varchar(40) NOT NULL,
  `user` varchar(20) NOT NULL,
  `password` varchar(40) NOT NULL,
  `gender` varchar(6) NOT NULL,
  `name` varchar(40) NOT NULL,
  `email` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `registration`
--

INSERT INTO `registration` (`hash`, `user`, `password`, `gender`, `name`, `email`) VALUES
('7494b2948f127fe1ffcd26d6be15df92', 'tester', '161ebd7d45089b3446ee4e0d86dbcf92', 'male', 'Test Ter', 'khalilgreenidge16@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `stock`
--

CREATE TABLE IF NOT EXISTS `stock` (
  `id` varchar(30) NOT NULL,
  `name` varchar(30) DEFAULT NULL,
  `brand` varchar(30) NOT NULL,
  `model` varchar(30) NOT NULL,
  `type` varchar(30) NOT NULL,
  `loaned` varchar(3) NOT NULL,
  `Comment` varchar(250) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `stock`
--

INSERT INTO `stock` (`id`, `name`, `brand`, `model`, `type`, `loaned`, `Comment`) VALUES
('7C323760R', 'TRAINLAP-20', 'Toshiba', 'Satellite', 'Laptop', 'no', 'Dad''s old laptop					'),
('BLU1', NULL, 'Sarasa', 'Zebra 0.7', 'Pencil', 'no', 'This is a blue pencil.					'),
('C1', 'Pen1', 'Parker', 'Symphony', 'Pen', 'no', NULL),
('C3', 'TrainDesk-2', 'Dell', 'Latitude', 'Laptop', 'yes', NULL),
('CA1', 'TRAINCHAIR-1', 'Ellusion', 'Foam Chair', 'Chair', 'no', NULL),
('CA2', 'TRAINCHAIR-2', 'Ellusion', 'Foam Chair', 'Chair', 'no', NULL),
('CA3', 'TRAINCHAIR-3', 'Ellusion', 'Foam Chair', 'Chair', 'no', 'Test'),
('CA4', 'TRAINCHAIR-4', 'Ellusion', 'Wooden Desk', 'Chair', 'no', 'khalil''s'),
('CA5', 'TRAINCHAIR-5', 'Ellusion', 'Foam Chair', 'Chair', 'no', NULL),
('CK2', 'TRAINLAP2', 'Dell', 'Latitude', 'Laptop', 'no', NULL),
('CK5', 'TRAINLAP15', 'Dell', 'Latitude', 'Laptop', 'no', NULL),
('CKI', '', 'Pilot', 'G10', 'Pen', 'no', 'Newly added.					'),
('DA1', 'TrainDesk-1', 'Ashley Furniture', 'Baraga L-Desk H410-24', 'Desk', 'no', 'Desk for training room					'),
('DA2', 'TRAINDESK-2', 'Ellusion', 'Wooden Desk', ' Desk', 'yes', '					'),
('DA3', 'TRAINDESK-3', 'Ellusion', 'Wooden Desk', 'Desk', 'no', 'New'),
('desk1', 'TRAINDESK-1', 'Staples', 'kn', 'Desk', 'no', NULL),
('F1', 'TrainDesk-1', 'Dell', 'Latitude', 'Laptop', 'no', NULL),
('F3', 'Traindesk-1', 'Dell', 'Optiplex', 'Desktop', 'no', NULL),
('f4', 'TrainDesk-1', 'Dell', 'O', 'Desktop', 'no', NULL),
('F6', 'TrainDesk-1', 'Dell', 'Optiplex', 'Desktop', 'no', NULL),
('f7', 'TrainDesk-1', 'Dell', 'Optiplex', 'Desktop', 'no', NULL),
('FA2', 'TRAINFIRE-1', 'Fortinet', '110C', 'Firewall', 'no', 'Newly Added.					'),
('FG2', 'Traindesk-3', 'Dell', 'Optiplex', 'Desktop', 'no', 'Not working'),
('G71C000F5110', 'CHARGER-1', 'Toshiba', 'AC Adapter', 'Laptop', 'no', '					'),
('IUJH', 'TRAINFAX-1', 'Samsung', 'CoCo', 'Fax Machine', 'no', 'Pint condition					'),
('PA1', NULL, 'Staples', 'A4', 'Paper', 'yes', '					'),
('PA2', NULL, 'Pilot', 'G69', 'Pen', 'no', 'New					'),
('PA3', NULL, 'Pilot', 'G10', 'Pen', 'no', 'New\r\n					'),
('PA6', NULL, 'Pilot', 'Flex', 'Pen', 'no', 'New pen					'),
('PBG1', NULL, 'Sarasa', 'Zebra 0.7', 'Pen', 'yes', 'Black Gel-ink Pen (edited).'),
('PPT1', 'PROJECTOR-1', 'Dell', 'Lighthouse', 'Projector', 'no', '					'),
('PU9', NULL, 'Sarasa', 'Zebra 0.7', 'Pen', 'no', 'Black gel ink					'),
('SA1', 'TRAINSWITCH-1', 'Cisco', 'Catalyst', 'Switch', 'no', 'New					'),
('SpPBBWDDZP5', NULL, 'Laporkan', 'Box', 'Paper', 'no', 'Brown					'),
('TA1', 'TRAINTAB-1', 'Microsoft', 'Surface Pro 3', 'Tablet', 'no', 'Newly Added.					'),
('WA1', NULL, 'Staples', 'G90', 'Whiteout', 'no', '					'),
('YGI1', NULL, 'Sarasa', 'Zebra 0.7', 'Pencil', 'no', 'This Is A Yellow Pencil');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `user` varchar(20) NOT NULL,
  `password` varchar(40) NOT NULL,
  `gender` varchar(6) NOT NULL,
  `name` varchar(40) NOT NULL,
  `email` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user`, `password`, `gender`, `name`, `email`) VALUES
('ae_1', '4e75f7c562d151ad9ee832bacf3b0688', 'male', 'Andre Edghll', 'andreedghill5@gmail.com'),
('b.brown', '161ebd7d45089b3446ee4e0d86dbcf92', 'male', 'Bobby Brown', 'freshprince_kg@hotmail.com'),
('d.d', '161ebd7d45089b3446ee4e0d86dbcf92', 'male', 'Dil Dul', 'dildul@rfr.ewf'),
('d.dil', '161ebd7d45089b3446ee4e0d86dbcf92', 'male', 'Dil Dul', 'kjn@kjn.com'),
('d.greenidge', '161ebd7d45089b3446ee4e0d86dbcf92', 'female', 'Dawne Greenidge', 'blessedandfavoured@gmail.com'),
('Elliep', '855fd8fa7986050c4f6958d722cf6fbb', 'female', 'Ellen Prescod', 'ekprescod@hedu.edu.bb'),
('furiousdre', '275972009e9307d2d080f774b4eb6a58', 'male', 'Andre Hyland', 'hyland.andre@gmail.com'),
('k.greenidge', 'd41e98d1eafa6d6011d3a70f1a5b92f0', 'male', 'Khalil Greenidge', 'khalilgreenidge16@gmail.com'),
('p.rowe', '161ebd7d45089b3446ee4e0d86dbcf92', 'male', 'Patrick Rowe', 'psrowe@hedu.edu.bb'),
('romariobates', 'dc93aa596988e027059e45260887e5a9', 'male', 'Romario Bates', 'romario.bates@gmail.com'),
('s.greenidge', '161ebd7d45089b3446ee4e0d86dbcf92', 'male', 'Shawn Greenidge', 'sgreenidge@globaldirectories.c'),
('selwyn.greenidge', '161ebd7d45089b3446ee4e0d86dbcf92', 'male', 'Selwyn Greenidge', 'selwyn.greenidge1@gmail.com'),
('techadmin', 'd41e98d1eafa6d6011d3a70f1a5b92f0', 'male', 'Tech Admin', 'techadmin@hedu.edu.bb');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `activation_links`
--
ALTER TABLE `activation_links`
 ADD PRIMARY KEY (`hash`);

--
-- Indexes for table `licence`
--
ALTER TABLE `licence`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `loan`
--
ALTER TABLE `loan`
 ADD PRIMARY KEY (`ticket_id`), ADD KEY `ID` (`ID`);

--
-- Indexes for table `new_equipment`
--
ALTER TABLE `new_equipment`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `new_office_equipment`
--
ALTER TABLE `new_office_equipment`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `new_stationery`
--
ALTER TABLE `new_stationery`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_reset`
--
ALTER TABLE `password_reset`
 ADD PRIMARY KEY (`hash`), ADD KEY `hash` (`hash`);

--
-- Indexes for table `registration`
--
ALTER TABLE `registration`
 ADD PRIMARY KEY (`hash`);

--
-- Indexes for table `stock`
--
ALTER TABLE `stock`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
 ADD PRIMARY KEY (`user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `new_equipment`
--
ALTER TABLE `new_equipment`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT for table `new_office_equipment`
--
ALTER TABLE `new_office_equipment`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `new_stationery`
--
ALTER TABLE `new_stationery`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=29;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `loan`
--
ALTER TABLE `loan`
ADD CONSTRAINT `k` FOREIGN KEY (`ID`) REFERENCES `stock` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `password_reset`
--
ALTER TABLE `password_reset`
ADD CONSTRAINT `password_reset_ibfk_1` FOREIGN KEY (`hash`) REFERENCES `activation_links` (`hash`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Constraints for table `registration`
--
ALTER TABLE `registration`
ADD CONSTRAINT `registration_ibfk_1` FOREIGN KEY (`hash`) REFERENCES `activation_links` (`hash`) ON DELETE CASCADE ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
