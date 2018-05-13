-- phpMyAdmin SQL Dump
-- version 4.0.10deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: May 20, 2016 at 05:35 PM
-- Server version: 5.5.49-0ubuntu0.14.04.1
-- PHP Version: 5.5.9-1ubuntu4.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `demo_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `action`
--

CREATE TABLE IF NOT EXISTS `action` (
  `ActionID` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `ActionFkJobID` int(10) unsigned NOT NULL DEFAULT '0',
  `ActionFkClientID` smallint(5) unsigned NOT NULL DEFAULT '0',
  `ActionRelToFkClientID` smallint(5) unsigned NOT NULL DEFAULT '0',
  `ActionFromFkUserID` smallint(5) unsigned NOT NULL DEFAULT '0',
  `ActionToFkUSerID` smallint(5) unsigned NOT NULL DEFAULT '0',
  `ActionText` text NOT NULL,
  `ActionDateTime` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `ActionDateSecs` bigint(100) NOT NULL DEFAULT '0',
  `ActionTotalTime` time NOT NULL DEFAULT '00:00:00',
  `ActionTotalSecs` varchar(100) NOT NULL DEFAULT '',
  `ActionTotalBreakSecs` int(7) NOT NULL DEFAULT '0',
  `ActionType` varchar(50) NOT NULL DEFAULT '',
  PRIMARY KEY (`ActionID`),
  FULLTEXT KEY `ActionText` (`ActionText`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COMMENT='Action table represents all Job transactions' AUTO_INCREMENT=21 ;

--
-- Dumping data for table `action`
--

INSERT INTO `action` (`ActionID`, `ActionFkJobID`, `ActionFkClientID`, `ActionRelToFkClientID`, `ActionFromFkUserID`, `ActionToFkUSerID`, `ActionText`, `ActionDateTime`, `ActionDateSecs`, `ActionTotalTime`, `ActionTotalSecs`, `ActionTotalBreakSecs`, `ActionType`) VALUES
(1, 1, 1, 0, 1, 1, 'Example Action.', '0000-00-00 00:00:00', 1423456626, '00:00:00', '', 0, ''),
(2, 2, 2, 0, 1, 1, 'Job Added  - Build house.', '0000-00-00 00:00:00', 1427474175, '00:00:00', '0', 0, ''),
(3, 1, 1, 0, 1, 0, 'Job finished (ticked from Job Board) - Build House', '0000-00-00 00:00:00', 1427474185, '00:00:00', '', 0, ''),
(4, 3, 2, 0, 1, 1, 'Job Added  - Organise earthworks.', '0000-00-00 00:00:00', 1427474189, '00:00:00', '21', 0, ''),
(5, 4, 2, 0, 1, 1, 'Job Added  - Formwork carpenters.', '0000-00-00 00:00:00', 1427474231, '00:00:00', '17', 0, ''),
(6, 5, 2, 0, 1, 1, 'Job Added  - Concrete truck xx cubic meters.', '0000-00-00 00:00:00', 1427474278, '00:00:00', '22', 0, ''),
(7, 6, 2, 0, 1, 1, 'Job Added  - Hire compactor.', '0000-00-00 00:00:00', 1427474312, '00:00:00', '18', 0, ''),
(8, 7, 2, 0, 1, 1, 'Job Added  - Plumber to put pipes in slab before the concreters come.', '0000-00-00 00:00:00', 1427474343, '00:00:00', '26', 0, ''),
(9, 8, 2, 0, 1, 1, 'Job Added  - Book brick layers.', '0000-00-00 00:00:00', 1427474378, '00:00:00', '19', 0, ''),
(10, 9, 2, 0, 1, 1, 'Job Added  - Build walls.', '0000-00-00 00:00:00', 1427474446, '00:00:00', '7', 0, ''),
(11, 10, 2, 0, 1, 1, 'Job Added  - Organise window frames and sliding doors.', '0000-00-00 00:00:00', 1427474496, '00:00:00', '16', 0, ''),
(12, 11, 2, 0, 1, 1, 'Job Added  - Buy lintels before brickies arrive.', '0000-00-00 00:00:00', 1427474522, '00:00:00', '52', 0, ''),
(13, 12, 2, 0, 1, 1, 'Job Added  - Talk to civil engineering about structural.', '0000-00-00 00:00:00', 1427474592, '00:00:00', '16', 0, ''),
(14, 13, 2, 0, 1, 1, 'Job Added  - Build roof.', '0000-00-00 00:00:00', 1427474617, '00:00:00', '6', 0, ''),
(15, 14, 2, 0, 1, 1, 'Job Added  - Find carpenter.', '0000-00-00 00:00:00', 1427474629, '00:00:00', '10', 0, ''),
(16, 15, 2, 0, 1, 1, 'Job Added  - Order prefabricated trusses.', '0000-00-00 00:00:00', 1427474647, '00:00:00', '12', 0, ''),
(17, 16, 2, 0, 1, 1, 'Job Added  - Buy colorbond corrugated iron.', '0000-00-00 00:00:00', 1427474666, '00:00:00', '26', 0, ''),
(18, 17, 2, 0, 1, 1, 'Job Added  - Set date for roof plumbers.', '0000-00-00 00:00:00', 1427474703, '00:00:00', '11', 0, ''),
(19, 18, 3, 0, 1, 1, 'Job Added  - Get mechanic to fix car.', '0000-00-00 00:00:00', 1427474820, '00:00:00', '0', 0, ''),
(20, 19, 3, 0, 1, 1, 'Job Added  - Write management reports.', '0000-00-00 00:00:00', 1427474856, '00:00:00', '0', 0, '');

-- --------------------------------------------------------

--
-- Table structure for table `client`
--

CREATE TABLE IF NOT EXISTS `client` (
  `ClientID` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `ClientName` varchar(99) NOT NULL DEFAULT '',
  `ClientName2` varchar(100) NOT NULL DEFAULT '',
  `ClientType` varchar(20) NOT NULL DEFAULT '',
  `ClientDate` varchar(100) NOT NULL DEFAULT '',
  `ClientPriority` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `ClientContactName` varchar(100) NOT NULL DEFAULT '',
  `ClientAddress1` varchar(100) NOT NULL DEFAULT '',
  `ClientAddress2` varchar(100) NOT NULL DEFAULT '',
  `ClientCity` varchar(100) NOT NULL DEFAULT '',
  `ClientCallBack` int(2) NOT NULL DEFAULT '0',
  `client_notes` text NOT NULL,
  `ClientState` varchar(20) NOT NULL DEFAULT '',
  `ClientPostcode` varchar(20) NOT NULL DEFAULT '',
  `ClientCountry` varchar(100) NOT NULL DEFAULT '',
  `ClientPhone1` varchar(50) NOT NULL DEFAULT '',
  `ClientPhone2` varchar(50) NOT NULL DEFAULT '',
  `ClientFax` varchar(50) NOT NULL DEFAULT '',
  `ClientEmail` varchar(50) NOT NULL DEFAULT '',
  `ClientUrl` varchar(100) NOT NULL DEFAULT '',
  `ClientCallOrder` int(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`ClientID`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COMMENT='Client Information' AUTO_INCREMENT=4 ;

--
-- Dumping data for table `client`
--

INSERT INTO `client` (`ClientID`, `ClientName`, `ClientName2`, `ClientType`, `ClientDate`, `ClientPriority`, `ClientContactName`, `ClientAddress1`, `ClientAddress2`, `ClientCity`, `ClientCallBack`, `client_notes`, `ClientState`, `ClientPostcode`, `ClientCountry`, `ClientPhone1`, `ClientPhone2`, `ClientFax`, `ClientEmail`, `ClientUrl`, `ClientCallOrder`) VALUES
(1, 'Test Client', '', '', '1080804828', 0, 'Benny Benassi', '', '', 'rendletown', 0, '', '', '', '', '', '', '', '', '', 0),
(2, 'Ed Client', '', '', '1427474112', 0, 'Ed', '', '', '', 0, '', '', '', '', '0419 823 456', '', '', '', '', 0),
(3, 'Bob Richard', '', '', '1427474772', 0, 'Bob', '', '', '', 0, '', '', '', '', '4923 345 612', '', '', '', '', 0);

-- --------------------------------------------------------

--
-- Table structure for table `clock`
--

CREATE TABLE IF NOT EXISTS `clock` (
  `clockID` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `clockFkJobID` int(10) unsigned NOT NULL DEFAULT '0',
  `colockFkUserID` int(10) unsigned NOT NULL DEFAULT '0',
  `clockOn` varchar(20) NOT NULL DEFAULT '',
  `clockOff` varchar(20) NOT NULL DEFAULT '',
  `clockBreakInSecs` varchar(10) NOT NULL DEFAULT '',
  `clock_comment` text NOT NULL,
  `clock_first_fail_time` int(11) NOT NULL,
  `clock_number_of_fails` tinyint(1) NOT NULL,
  PRIMARY KEY (`clockID`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COMMENT='For logging job and user hours' AUTO_INCREMENT=2 ;

--
-- Dumping data for table `clock`
--

INSERT INTO `clock` (`clockID`, `clockFkJobID`, `colockFkUserID`, `clockOn`, `clockOff`, `clockBreakInSecs`, `clock_comment`, `clock_first_fail_time`, `clock_number_of_fails`) VALUES
(1, 0, 0, '', '', '', 'Security', 1418745619, 1);

-- --------------------------------------------------------

--
-- Table structure for table `config`
--

CREATE TABLE IF NOT EXISTS `config` (
  `ConfigID` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `ConfigFKUserID` tinyint(5) NOT NULL,
  `ConfigProgramTitle` varchar(50) NOT NULL,
  `ConfigDebug` tinyint(1) NOT NULL DEFAULT '0',
  `config_blank_login` tinyint(1) NOT NULL,
  `config_time_zone` varchar(35) NOT NULL,
  PRIMARY KEY (`ConfigID`),
  UNIQUE KEY `ConfigID` (`ConfigID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `config`
--

INSERT INTO `config` (`ConfigID`, `ConfigFKUserID`, `ConfigProgramTitle`, `ConfigDebug`, `config_blank_login`, `config_time_zone`) VALUES
(1, 0, 'Spiros 2.2.9', 0, 1, 'Australia/Sydney');

-- --------------------------------------------------------

--
-- Table structure for table `job`
--

CREATE TABLE IF NOT EXISTS `job` (
  `JobID` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `JobFkClientID` smallint(5) unsigned NOT NULL DEFAULT '0',
  `JobFromFkUserID` smallint(5) unsigned NOT NULL DEFAULT '0',
  `JobToFkUserID` smallint(5) unsigned NOT NULL DEFAULT '0',
  `JobParent` mediumint(9) NOT NULL COMMENT 'Indicates the parent job',
  `JobChild` tinyint(4) NOT NULL DEFAULT '0' COMMENT 'Specifies if the Job has a child.',
  `JobBranch` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'Specify whether brach is open.',
  `JobDate` varchar(50) NOT NULL DEFAULT '',
  `JobType` varchar(50) NOT NULL DEFAULT '',
  `JobTitle` text NOT NULL,
  `JobPriority` double NOT NULL DEFAULT '0',
  `JobImpUrg` char(1) NOT NULL DEFAULT '0' COMMENT 'Importance Urgency Matrix',
  `JobStatus` varchar(13) NOT NULL DEFAULT '0',
  `JobDescription` text NOT NULL,
  `JobCardNumber` varchar(12) DEFAULT NULL,
  `JobSchedTimeInSecs` int(20) unsigned NOT NULL DEFAULT '0',
  `JobEstSecs` int(20) unsigned NOT NULL DEFAULT '60',
  `JobActualSecs` int(20) unsigned NOT NULL DEFAULT '0',
  `JobTimeComment` text NOT NULL,
  `JobTimeInserted` varchar(50) NOT NULL DEFAULT '',
  `JobParts` text NOT NULL,
  `job_visibility` tinyint(2) NOT NULL,
  PRIMARY KEY (`JobID`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COMMENT='Job is a complete request or project' AUTO_INCREMENT=20 ;

--
-- Dumping data for table `job`
--

INSERT INTO `job` (`JobID`, `JobFkClientID`, `JobFromFkUserID`, `JobToFkUserID`, `JobParent`, `JobChild`, `JobBranch`, `JobDate`, `JobType`, `JobTitle`, `JobPriority`, `JobImpUrg`, `JobStatus`, `JobDescription`, `JobCardNumber`, `JobSchedTimeInSecs`, `JobEstSecs`, `JobActualSecs`, `JobTimeComment`, `JobTimeInserted`, `JobParts`, `job_visibility`) VALUES
(1, 1, 1, 1, 0, 0, 0, '', 'WorkShop', 'Build House', 53, '0', 'Job Complete', 'Example', '', 1423229460, 60, 0, '', '1423229492', '', 0),
(2, 2, 1, 1, 0, 1, 1, '', 'WorkShop', 'Build house.', 65.5, '0', 'Active', '', '', 1427474175, 60, 0, '', '1427474175', '', 2),
(3, 2, 1, 1, 2, 1, 0, '', 'WorkShop', 'Organise earthworks.', 70, '0', 'Active', '', '', 1427474210, 60, 0, '', '1427474210', '', 0),
(4, 2, 1, 1, 3, 0, 0, '', 'WorkShop', 'Formwork carpenters.', 56, '0', 'Active', '', '', 1427474220, 60, 0, '', '1427474248', '', 0),
(13, 2, 1, 1, 2, 1, 1, '', 'WorkShop', 'Build roof.', 65, '0', 'Active', '', '', 1427474623, 60, 0, '', '1427474623', '', 0),
(5, 2, 1, 1, 3, 0, 0, '', 'WorkShop', 'Concrete truck xx cubic meters.', 57, '0', 'Active', '', '', 1427474300, 60, 0, '', '1427474300', '', 0),
(6, 2, 1, 1, 3, 0, 0, '', 'WorkShop', 'Hire compactor.', 58, '0', 'Active', '', '', 1427474330, 60, 0, '', '1427474330', '', 0),
(7, 2, 1, 1, 3, 0, 0, '', 'WorkShop', 'Plumber to put pipes in slab before the concreters come.', 59, '0', 'Active', '', '', 1427474369, 60, 0, '', '1427474369', '', 0),
(8, 2, 1, 1, 9, 0, 0, '', 'WorkShop', 'Book brick layers.', 60, '0', 'Active', '', '', 1427474340, 60, 0, '', '1427474397', '', 0),
(9, 2, 1, 1, 2, 1, 0, '', 'WorkShop', 'Build walls.', 69.5, '0', 'Active', '', '', 1427474453, 60, 0, '', '1427474453', '', 0),
(10, 2, 1, 1, 9, 0, 0, '', 'WorkShop', 'Organise window frames and sliding doors.', 62, '0', 'Active', '', '', 1427474512, 60, 0, '', '1427474512', '', 0),
(11, 2, 1, 1, 9, 0, 0, '', 'WorkShop', 'Buy lintels before brickies arrive.', 63, '0', 'Active', '', '', 1427474574, 60, 0, '', '1427474574', '', 0),
(12, 2, 1, 1, 9, 0, 0, '', 'WorkShop', 'Talk to civil engineering about structural.', 64, '0', 'Active', '', '', 1427474608, 60, 0, '', '1427474608', '', 0),
(14, 2, 1, 1, 13, 0, 0, '', 'WorkShop', 'Find carpenter.', 66, '0', 'Active', '', '', 1427474639, 60, 0, '', '1427474639', '', 0),
(15, 2, 1, 1, 13, 0, 0, '', 'WorkShop', 'Order prefabricated trusses.', 67, '0', 'Active', '', '', 1427474659, 60, 0, '', '1427474659', '', 0),
(16, 2, 1, 1, 13, 0, 0, '', 'WorkShop', 'Buy colorbond corrugated iron.', 68, '0', 'Active', '', '', 1427474692, 60, 0, '', '1427474692', '', 0),
(17, 2, 1, 3, 13, 0, 0, '', 'WorkShop', 'Set date for roof plumbers.', 69, '0', 'Active', '', '', 1427474700, 60, 0, '', '1427474714', '', 0),
(18, 3, 1, 1, 0, 0, 0, '', 'WorkShop', 'Get mechanic to fix car.', 27, '0', 'Active', '', '', 1427474820, 60, 0, '', '1427474820', '', 0),
(19, 3, 1, 1, 0, 0, 0, '', 'WorkShop', 'Write management reports.', 71, '0', 'Active', '', '', 1427474856, 60, 0, '', '1427474856', '', 0);

-- --------------------------------------------------------

--
-- Table structure for table `reminder`
--

CREATE TABLE IF NOT EXISTS `reminder` (
  `ReminderID` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `ReminderFkJobID` int(10) unsigned NOT NULL DEFAULT '0',
  `ReminderFkClientID` int(6) unsigned NOT NULL DEFAULT '0',
  `ReminderFromFkUserID` int(5) unsigned NOT NULL DEFAULT '0',
  `ReminderToFkUserID` int(5) unsigned NOT NULL DEFAULT '0',
  `ReminderType` varchar(8) NOT NULL DEFAULT '',
  `ReminderTimeAddedInSecs` int(50) NOT NULL DEFAULT '0',
  `ReminderSchedTimeInSecs` varchar(50) NOT NULL DEFAULT '',
  `ReminderEstimateTimeInSecs` varchar(15) NOT NULL DEFAULT '1',
  `ReminderTimeDismissedInSecs` varchar(50) NOT NULL DEFAULT '0',
  `ReminderTitle` text NOT NULL,
  PRIMARY KEY (`ReminderID`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COMMENT='Reminder service' AUTO_INCREMENT=2 ;

--
-- Dumping data for table `reminder`
--

INSERT INTO `reminder` (`ReminderID`, `ReminderFkJobID`, `ReminderFkClientID`, `ReminderFromFkUserID`, `ReminderToFkUserID`, `ReminderType`, `ReminderTimeAddedInSecs`, `ReminderSchedTimeInSecs`, `ReminderEstimateTimeInSecs`, `ReminderTimeDismissedInSecs`, `ReminderTitle`) VALUES
(1, 1398, 2570, 1, 1, 'Reminder', 1422749232, '1422749220', '1', '1422750109', 'Example Reminder.\r\n');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `UserID` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `UserFkClientID` smallint(5) unsigned NOT NULL DEFAULT '0',
  `user_time_zone` varchar(20) NOT NULL,
  `UserActive` int(1) unsigned NOT NULL DEFAULT '0',
  `UserDate` int(11) NOT NULL,
  `UserLogin` varchar(20) NOT NULL DEFAULT '',
  `User_db_token` int(5) unsigned DEFAULT NULL,
  `UserPassword` varchar(20) NOT NULL DEFAULT '',
  `UserType` varchar(15) NOT NULL DEFAULT 'user',
  `UserLastname` varchar(50) NOT NULL DEFAULT '',
  `UserFirstname` varchar(50) NOT NULL DEFAULT '',
  `UserAddress1` varchar(100) NOT NULL DEFAULT '',
  `UserAddress2` varchar(100) NOT NULL DEFAULT '',
  `UserCity` varchar(100) NOT NULL DEFAULT '',
  `UserState` varchar(20) NOT NULL DEFAULT '',
  `UserPostcode` varchar(20) NOT NULL DEFAULT '',
  `UserCountry` varchar(100) NOT NULL DEFAULT '',
  `UserPhone1` varchar(50) NOT NULL DEFAULT '',
  `UserPhone2` varchar(50) NOT NULL DEFAULT '',
  `UserFax` varchar(50) NOT NULL DEFAULT '',
  `UserEmail` varchar(50) NOT NULL DEFAULT '',
  `UserUrl` varchar(100) NOT NULL DEFAULT '',
  PRIMARY KEY (`UserID`),
  UNIQUE KEY `UserLogin` (`UserLogin`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COMMENT='User Information' AUTO_INCREMENT=4 ;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`UserID`, `UserFkClientID`, `user_time_zone`, `UserActive`, `UserDate`, `UserLogin`, `User_db_token`, `UserPassword`, `UserType`, `UserLastname`, `UserFirstname`, `UserAddress1`, `UserAddress2`, `UserCity`, `UserState`, `UserPostcode`, `UserCountry`, `UserPhone1`, `UserPhone2`, `UserFax`, `UserEmail`, `UserUrl`) VALUES
(1, 0, 'Australia/Sydney', 1, 1427474055, 'Barry', 1, 'bluesky', 'user', '', 'Barry', '', '', '', '', '', '', '', '', '', '', '7rocks.com'),
(2, 0, 'Australia/Sydney', 0, 1421407111, 'everyone', 30240, 'Kanton@@', 'user', '', 'Everyone', '', '', '', '', '', '', '', '', '', '', '7rocks.com'),
(3, 0, 'Australia/Sydney', 1, 1427474430, 'Al worker', NULL, 'bluesky', 'user', '', 'Al worker', '', '', '', '', '', '', '', '', '', '', '');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
