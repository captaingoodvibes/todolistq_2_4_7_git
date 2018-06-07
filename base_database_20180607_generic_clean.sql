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
(1, 1, 1, 0, 1, 1, 'Example Action.', '0000-00-00 00:00:00', 1423456626, '00:00:00', '', 0, '');

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
(1, 'Test Client', '', '', '1080804828', 0, 'Benny Benassi', '', '', 'rendletown', 0, '', '', '', '', '', '', '', '', '', 0);

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
(1, 1, 1, 1, 0, 0, 0, '', 'WorkShop', 'Build House', 53, '0', 'Job Complete', 'Example', '', 1423229460, 60, 0, '', '1423229492', '', 0);

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
(1, 0, 'Australia/Sydney', 0, 1421407111, 'everyone', 30240, 'Kanton@@', 'user', '', 'Everyone', '', '', '', '', '', '', '', '', '', '', '7rocks.com');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
