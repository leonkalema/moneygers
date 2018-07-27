-- phpMyAdmin SQL Dump
-- version 2.8.1
-- http://www.phpmyadmin.net
-- 
-- Host: localhost
-- Generation Time: Jan 09, 2008 at 12:33 PM
-- Server version: 5.0.22
-- PHP Version: 5.1.4
-- 
-- Database: `smartguard`
-- 

-- --------------------------------------------------------

-- 
-- Table structure for table `absentees`
-- 

DROP TABLE IF EXISTS `absentees`;
CREATE TABLE `absentees` (
  `id` bigint(20) NOT NULL auto_increment,
  `guard` varchar(255) default NULL,
  `assignment` varchar(255) default NULL,
  `absenteedate` date default NULL,
  `comments` varchar(255) default NULL,
  `createdby` bigint(20) default NULL,
  `datecreated` date default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

-- 
-- Dumping data for table `absentees`
-- 

INSERT INTO `absentees` VALUES (2, 'H003', '110314', '2007-05-13', '', 1, '2007-12-03');
INSERT INTO `absentees` VALUES (3, 'zx', 'xc', '2002-04-03', 'xcxc', 1, '2007-12-03');

-- --------------------------------------------------------

-- 
-- Table structure for table `actions`
-- 

DROP TABLE IF EXISTS `actions`;
CREATE TABLE `actions` (
  `id` bigint(20) NOT NULL auto_increment,
  `name` varchar(255) NOT NULL default '',
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=14 ;

-- 
-- Dumping data for table `actions`
-- 

INSERT INTO `actions` VALUES (1, 'Transfer');
INSERT INTO `actions` VALUES (2, 'Promotion');
INSERT INTO `actions` VALUES (3, 'Suspension');
INSERT INTO `actions` VALUES (4, 'Warning');
INSERT INTO `actions` VALUES (5, 'Police Custody');
INSERT INTO `actions` VALUES (6, 'End of Employment');
INSERT INTO `actions` VALUES (7, 'Police Custody');
INSERT INTO `actions` VALUES (8, 'End of Employment');
INSERT INTO `actions` VALUES (9, 'Beaten');
INSERT INTO `actions` VALUES (10, 'Sam');
INSERT INTO `actions` VALUES (11, 'Devil');
INSERT INTO `actions` VALUES (12, 'Day');
INSERT INTO `actions` VALUES (13, 'xing');

-- --------------------------------------------------------

-- 
-- Table structure for table `activity`
-- 

DROP TABLE IF EXISTS `activity`;
CREATE TABLE `activity` (
  `id` bigint(20) NOT NULL auto_increment,
  `activity` varchar(250) NOT NULL default '',
  `date_of_entry` datetime NOT NULL default '0000-00-00 00:00:00',
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

-- 
-- Dumping data for table `activity`
-- 

INSERT INTO `activity` VALUES (1, 'supply radios', '2007-12-04 13:59:45');
INSERT INTO `activity` VALUES (2, 'on patrol', '2007-12-04 14:00:02');
INSERT INTO `activity` VALUES (3, 'on standby', '2007-12-04 14:00:20');
INSERT INTO `activity` VALUES (4, 'Deploying guards', '2007-12-04 14:00:39');
INSERT INTO `activity` VALUES (5, 'on assignment', '2007-12-04 14:00:53');

-- --------------------------------------------------------

-- 
-- Table structure for table `assignmentovertime`
-- 

DROP TABLE IF EXISTS `assignmentovertime`;
CREATE TABLE `assignmentovertime` (
  `id` bigint(20) NOT NULL auto_increment,
  `guardid` varchar(250) NOT NULL default '',
  `date` datetime NOT NULL default '0000-00-00 00:00:00',
  `duration` varchar(250) NOT NULL default '',
  `date_of_entry` datetime NOT NULL default '0000-00-00 00:00:00',
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=47 ;

-- 
-- Dumping data for table `assignmentovertime`
-- 

INSERT INTO `assignmentovertime` VALUES (5, 'Y907', '2007-12-07 00:00:00', '2', '0000-00-00 00:00:00');
INSERT INTO `assignmentovertime` VALUES (26, 'Y907', '2007-02-15 00:00:00', '2', '0000-00-00 00:00:00');
INSERT INTO `assignmentovertime` VALUES (34, 'Y907', '2007-05-12 00:00:00', '3', '0000-00-00 00:00:00');
INSERT INTO `assignmentovertime` VALUES (39, 'F554', '2007-12-15 00:00:00', '8', '0000-00-00 00:00:00');
INSERT INTO `assignmentovertime` VALUES (40, 'H117', '2007-01-01 00:00:00', '3', '0000-00-00 00:00:00');
INSERT INTO `assignmentovertime` VALUES (42, 'P0081', '2007-11-08 00:00:00', '1', '0000-00-00 00:00:00');
INSERT INTO `assignmentovertime` VALUES (43, 'P0081', '2007-11-08 00:00:00', '1', '0000-00-00 00:00:00');
INSERT INTO `assignmentovertime` VALUES (44, 'F554', '2007-12-03 00:00:00', '5', '0000-00-00 00:00:00');
INSERT INTO `assignmentovertime` VALUES (45, 'F554', '2007-12-03 00:00:00', '5', '0000-00-00 00:00:00');
INSERT INTO `assignmentovertime` VALUES (46, 'Y907', '2008-01-06 00:00:00', '4', '0000-00-00 00:00:00');

-- --------------------------------------------------------

-- 
-- Table structure for table `assignmentreplacements`
-- 

DROP TABLE IF EXISTS `assignmentreplacements`;
CREATE TABLE `assignmentreplacements` (
  `id` bigint(20) NOT NULL auto_increment,
  `guardid` varchar(250) NOT NULL default '',
  `date` datetime NOT NULL default '0000-00-00 00:00:00',
  `date_of_entry` datetime NOT NULL default '0000-00-00 00:00:00',
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

-- 
-- Dumping data for table `assignmentreplacements`
-- 

INSERT INTO `assignmentreplacements` VALUES (1, 'F554', '2008-01-01 00:00:00', '2008-01-06 00:00:00');
INSERT INTO `assignmentreplacements` VALUES (3, 'Y907', '2008-01-09 00:00:00', '2008-01-10 00:00:00');
INSERT INTO `assignmentreplacements` VALUES (4, 'F554', '2008-01-04 00:00:00', '2008-01-24 00:00:00');

-- --------------------------------------------------------

-- 
-- Table structure for table `assignments`
-- 

DROP TABLE IF EXISTS `assignments`;
CREATE TABLE `assignments` (
  `id` bigint(20) NOT NULL auto_increment,
  `callsign` varchar(255) NOT NULL default '',
  `client` varchar(255) default NULL,
  `region` varchar(250) NOT NULL default '',
  `alarm` varchar(250) NOT NULL default '',
  `servicetype` varchar(250) default NULL,
  `assignedguard` varchar(255) default NULL,
  `relievers` varchar(250) NOT NULL default '',
  `commander` varchar(250) NOT NULL default '',
  `scheduleunit` varchar(250) NOT NULL default '',
  `overtimeids` text NOT NULL,
  `replacementids` text NOT NULL,
  `equipmenttypes` text NOT NULL,
  `starttime` varchar(255) default NULL,
  `endtime` varchar(255) default NULL,
  `startdate` date default NULL,
  `enddate` date default NULL,
  `exception` varchar(255) default NULL,
  `rate` varchar(250) NOT NULL default '',
  `lastpaymentdate` datetime NOT NULL default '0000-00-00 00:00:00',
  `amountdue` varchar(250) NOT NULL default '',
  `isactive` enum('Y','N') NOT NULL default 'Y',
  `datecreated` date default NULL,
  `createdby` bigint(20) default NULL,
  `lastupdatedby` bigint(20) default NULL,
  `lastupdatedate` timestamp NULL default NULL on update CURRENT_TIMESTAMP,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='InnoDB free: 4096 kB; InnoDB free: 4096 kB; InnoDB free: 409' AUTO_INCREMENT=82 ;

-- 
-- Dumping data for table `assignments`
-- 

INSERT INTO `assignments` VALUES (3, 'H313-N', 'Fida', '', '', 'Alert', 'H013,F554,P0081', 'Y907', 'T023', '1196066731', '', '', 'Transport van', '01:00:00', '04:00:00', '2007-01-11', '2007-12-31', '0000-00-00', '7000', '0000-00-00 00:00:00', '', 'N', '2007-12-08', 1, 1, '2007-12-10 11:18:45');
INSERT INTO `assignments` VALUES (7, 'H312-D', 'Crane Bank', '29', 'W42343234', 'Shift', 'H117,H013', 'Y907', 'T023', '1196066731', '5,46', '1,3', 'Baton,Deployment Pickup,Gun', '09:30:00', '10:00:00', '2008-01-01', '2008-02-20', '2008-01-30', '11000', '2007-02-05 00:00:00', '120000', 'Y', '2008-01-06', 1, 1, '2008-01-06 22:56:53');
INSERT INTO `assignments` VALUES (8, 'B666-H', 'Crane Bank', '', '', 'Shift', 'H117,P0081', 'D109', 'T023', '1196066531', '26', '', 'Baton,Deployment Pickup', '09:30:00', '10:00:00', '2007-11-19', '2008-01-27', '2007-12-15,2007-11-24', '5000', '2007-07-01 00:00:00', '2000000', 'Y', '2007-12-10', 1, 1, '2007-12-10 12:39:15');
INSERT INTO `assignments` VALUES (9, 'H300-N', 'Crane Bank', '33', 'H666787', 'Shift', '', 'P0081', '', '1196066531', '', '', 'Baton,Deployment Pickup,Gun', '07:30:00', '08:00:00', '2007-12-19', '2008-03-07', '2008-03-14,2008-04-15,2008-06-04,2008-12-22', '7000', '0000-00-00 00:00:00', '', 'Y', '2008-01-06', 1, 1, '2008-01-06 13:23:31');
INSERT INTO `assignments` VALUES (63, 'D145-N', 'Nile Breweries', '', '', 'Shift', '', '', '', '1196066731', '', '', '', '', '', '2007-11-19', '2007-12-20', '2007-11-21,2007-11-22,2007-11-23,2007-11-28,2007-11-20,2007-11-24,2007-11-27,2007-11-29,2007-11-30,2007-12-05', '10000', '0000-00-00 00:00:00', '', 'Y', '2007-11-27', 1, 1, '2007-12-09 10:55:22');
INSERT INTO `assignments` VALUES (67, 'H230-D', 'Felix Holdings', '', '', 'Shift', 'P0081,Y907', 'P0081', '', '1196066531', '', '', '', '', '', '2007-11-19', '2008-01-27', '2007-11-22,2007-11-23', '10500', '2007-11-02 00:00:00', '1340890', 'Y', '2007-11-27', 1, 1, '2007-12-10 12:09:44');
INSERT INTO `assignments` VALUES (68, 'H457-K', 'UTL', '', '', 'Shift', '', '', '', '1196066701', '', '', '', '08:30:00', '16:00:00', '2007-11-26', '2007-12-02', '2007-11-27,2007-11-30', '10000', '0000-00-00 00:00:00', '', 'Y', '2007-11-29', 1, 1, '2007-12-10 11:19:02');
INSERT INTO `assignments` VALUES (70, 'Q444-N', 'UCB', '', '', 'Shift', 'T023', 'Y907', '', '1196156265', '45', '', '', '', '', '2007-11-26', '2007-12-02', '2007-12-02,2007-11-26,2007-11-27', '10000', '0000-00-00 00:00:00', '', 'Y', '2007-11-27', 1, 1, '2007-12-09 10:55:22');
INSERT INTO `assignments` VALUES (71, 'KKK0-D', 'Stanbic Bank', '', '', 'Shift', 'Y907', '', '', '1196156669', '', '', '', '07:00:00', '09:00:00', '2007-11-26', '2007-12-02', '', '10000', '0000-00-00 00:00:00', '', 'Y', '2007-11-27', 1, 1, '2007-12-09 10:55:22');
INSERT INTO `assignments` VALUES (72, 'KKK1-D', 'Kits End International', '', '', 'Escort', 'P0081', 'Y907', '', '1196156669', '34,39,40,43', '', '', '07:00:00', '08:30:00', '2007-11-26', '2007-12-16', '2007-12-10', '20000', '0000-00-00 00:00:00', '', 'Y', '2007-12-08', 1, 1, '2007-12-09 10:56:06');
INSERT INTO `assignments` VALUES (73, 'KKK3-N', 'Shark Inc.', '', '', 'Shift', 'H013', '', '', '1196156669', '', '', '', '06:30:00', '22:30:00', '2007-11-26', '2007-12-02', '2007-12-16', '10000', '0000-00-00 00:00:00', '', 'Y', '2007-11-27', 1, 1, '2007-12-09 10:55:22');
INSERT INTO `assignments` VALUES (81, 'K003-D', 'Shark Inc.', '33', '', 'Escort', 'Y907', 'H013', 'P0081', '', '', '', 'Baton,Gun', '08:00:00', '18:00:00', '0000-00-00', '0000-00-00', '2007-12-07', '12050', '0000-00-00 00:00:00', '', 'Y', '2007-12-05', 1, 1, '2007-12-09 10:56:24');

-- --------------------------------------------------------

-- 
-- Table structure for table `children`
-- 

DROP TABLE IF EXISTS `children`;
CREATE TABLE `children` (
  `id` bigint(20) NOT NULL auto_increment,
  `firstname` varchar(200) NOT NULL default '',
  `lastname` varchar(200) NOT NULL default '',
  `othernames` varchar(200) NOT NULL default '',
  `gender` varchar(10) NOT NULL default '',
  `age` varchar(10) NOT NULL default '',
  `createdby` bigint(20) NOT NULL default '0',
  `date_of_entry` datetime NOT NULL default '0000-00-00 00:00:00',
  `lastupdatedby` bigint(20) NOT NULL default '0',
  `lastupdatedate` datetime NOT NULL default '0000-00-00 00:00:00',
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=82 ;

-- 
-- Dumping data for table `children`
-- 

INSERT INTO `children` VALUES (1, 'Dan', 'Kintu', 'Opio', 'M', '12', 1, '2007-10-29 14:51:12', 0, '0000-00-00 00:00:00');
INSERT INTO `children` VALUES (5, 'Dan', 'Kintu', 'Opio', 'M', '12', 1, '2007-10-29 14:56:41', 0, '0000-00-00 00:00:00');
INSERT INTO `children` VALUES (6, 'Dan', 'Kintu', 'Opio', 'M', '12', 1, '2007-10-29 14:56:41', 0, '0000-00-00 00:00:00');
INSERT INTO `children` VALUES (7, 'Dan', 'Kintu', 'Opio', 'M', '12', 1, '2007-10-29 15:00:31', 0, '0000-00-00 00:00:00');
INSERT INTO `children` VALUES (8, 'Dan', 'Kintu', 'Opio', 'M', '12', 1, '2007-10-29 15:00:31', 0, '0000-00-00 00:00:00');
INSERT INTO `children` VALUES (9, 'Dan', 'Kintu', 'Opio', 'M', '12', 1, '2007-10-29 15:01:41', 0, '0000-00-00 00:00:00');
INSERT INTO `children` VALUES (10, 'Dan', 'Kintu', 'Opio', 'M', '12', 1, '2007-10-29 15:01:41', 0, '0000-00-00 00:00:00');
INSERT INTO `children` VALUES (11, 'Dan', 'Kintu', 'Opio', 'M', '12', 1, '2007-10-29 15:03:32', 0, '0000-00-00 00:00:00');
INSERT INTO `children` VALUES (12, 'Peter', 'Okello', '', 'M', '17', 1, '2007-10-29 15:03:32', 0, '0000-00-00 00:00:00');
INSERT INTO `children` VALUES (13, 'Mary', 'Jane', 'Darling', 'F', '10', 1, '2007-10-29 15:03:32', 0, '0000-00-00 00:00:00');
INSERT INTO `children` VALUES (14, 'Dan', 'Kintu', 'Opio', 'M', '12', 1, '2007-10-29 15:03:32', 0, '0000-00-00 00:00:00');
INSERT INTO `children` VALUES (15, 'Peter', 'Okello', '', 'M', '17', 1, '2007-10-29 15:03:32', 0, '0000-00-00 00:00:00');
INSERT INTO `children` VALUES (16, 'Mary', 'Jane', 'Darling', 'F', '10', 1, '2007-10-29 15:03:32', 0, '0000-00-00 00:00:00');
INSERT INTO `children` VALUES (17, 'Dan', 'Kintu', 'Opio', 'M', '12', 1, '2007-10-29 15:09:01', 0, '0000-00-00 00:00:00');
INSERT INTO `children` VALUES (18, 'Peter', 'Okello', '', 'M', '17', 1, '2007-10-29 15:09:01', 0, '0000-00-00 00:00:00');
INSERT INTO `children` VALUES (19, 'Mary', 'Jane', 'Darling', 'F', '10', 1, '2007-10-29 15:09:01', 0, '0000-00-00 00:00:00');
INSERT INTO `children` VALUES (20, 'Dan', 'Kintu', 'Opio', 'M', '12', 1, '2007-10-29 15:09:01', 0, '0000-00-00 00:00:00');
INSERT INTO `children` VALUES (21, 'Peter', 'Okello', '', 'M', '17', 1, '2007-10-29 15:09:02', 0, '0000-00-00 00:00:00');
INSERT INTO `children` VALUES (22, 'Mary', 'Jane', 'Darling', 'F', '10', 1, '2007-10-29 15:09:02', 0, '0000-00-00 00:00:00');
INSERT INTO `children` VALUES (23, 'Dan', 'Kintu', 'Opio', 'M', '12', 1, '2007-10-29 15:10:03', 0, '0000-00-00 00:00:00');
INSERT INTO `children` VALUES (24, 'Peter', 'Okello', '', 'M', '17', 1, '2007-10-29 15:10:03', 0, '0000-00-00 00:00:00');
INSERT INTO `children` VALUES (25, 'Mary', 'Jane', 'Darling', 'F', '10', 1, '2007-10-29 15:10:03', 0, '0000-00-00 00:00:00');
INSERT INTO `children` VALUES (26, 'Dan', 'Kintu', 'Opio', 'M', '12', 1, '2007-10-29 15:10:04', 0, '0000-00-00 00:00:00');
INSERT INTO `children` VALUES (27, 'Peter', 'Okello', '', 'M', '17', 1, '2007-10-29 15:10:04', 0, '0000-00-00 00:00:00');
INSERT INTO `children` VALUES (28, 'Mary', 'Jane', 'Darling', 'F', '10', 1, '2007-10-29 15:10:04', 0, '0000-00-00 00:00:00');
INSERT INTO `children` VALUES (29, 'Dan', 'Kintu', 'Opio', 'M', '12', 1, '2007-10-29 15:10:57', 0, '0000-00-00 00:00:00');
INSERT INTO `children` VALUES (30, 'Peter', 'Okello', '', 'M', '17', 1, '2007-10-29 15:10:57', 0, '0000-00-00 00:00:00');
INSERT INTO `children` VALUES (31, 'Mary', 'Jane', 'Darling', 'F', '10', 1, '2007-10-29 15:10:57', 0, '0000-00-00 00:00:00');
INSERT INTO `children` VALUES (32, 'Dan', 'Kintu', 'Opio', 'M', '12', 1, '2007-10-29 15:10:57', 0, '0000-00-00 00:00:00');
INSERT INTO `children` VALUES (33, 'Peter', 'Okello', '', 'M', '17', 1, '2007-10-29 15:10:57', 0, '0000-00-00 00:00:00');
INSERT INTO `children` VALUES (34, 'Mary', 'Jane', 'Darling', 'F', '10', 1, '2007-10-29 15:10:57', 0, '0000-00-00 00:00:00');
INSERT INTO `children` VALUES (35, 'Dan', 'Kintu', 'Opio', 'M', '12', 1, '2007-10-29 15:13:09', 0, '0000-00-00 00:00:00');
INSERT INTO `children` VALUES (36, 'Peter', 'Okello', '', 'M', '17', 1, '2007-10-29 15:13:09', 0, '0000-00-00 00:00:00');
INSERT INTO `children` VALUES (37, 'Mary', 'Jane', 'Darling', 'F', '10', 1, '2007-10-29 15:13:09', 0, '0000-00-00 00:00:00');
INSERT INTO `children` VALUES (38, 'Dan', 'Kintu', 'Opio', 'M', '12', 1, '2007-10-29 15:13:09', 0, '0000-00-00 00:00:00');
INSERT INTO `children` VALUES (39, 'Peter', 'Okello', '', 'M', '17', 1, '2007-10-29 15:13:09', 0, '0000-00-00 00:00:00');
INSERT INTO `children` VALUES (40, 'Mary', 'Jane', 'Darling', 'F', '10', 1, '2007-10-29 15:13:09', 0, '0000-00-00 00:00:00');
INSERT INTO `children` VALUES (41, 'Dan', 'Kintu', 'Opio', 'M', '12', 1, '2007-10-29 15:14:43', 0, '0000-00-00 00:00:00');
INSERT INTO `children` VALUES (42, 'Peter', 'Okello', '', 'M', '17', 1, '2007-10-29 15:14:43', 0, '0000-00-00 00:00:00');
INSERT INTO `children` VALUES (43, 'Mary', 'Jane', 'Darling', 'F', '10', 1, '2007-10-29 15:14:43', 0, '0000-00-00 00:00:00');
INSERT INTO `children` VALUES (44, 'Dan', 'Kintu', 'Opio', 'M', '12', 1, '2007-10-29 15:14:43', 0, '0000-00-00 00:00:00');
INSERT INTO `children` VALUES (45, 'Peter', 'Okello', '', 'M', '17', 1, '2007-10-29 15:14:44', 0, '0000-00-00 00:00:00');
INSERT INTO `children` VALUES (46, 'Mary', 'Jane', 'Darling', 'F', '10', 1, '2007-10-29 15:14:44', 0, '0000-00-00 00:00:00');
INSERT INTO `children` VALUES (47, 'Dan', 'Kintu', 'Opio', 'M', '12', 1, '2007-10-29 15:15:13', 0, '0000-00-00 00:00:00');
INSERT INTO `children` VALUES (48, 'Peter', 'Okello', '', 'M', '17', 1, '2007-10-29 15:15:13', 0, '0000-00-00 00:00:00');
INSERT INTO `children` VALUES (49, 'Mary', 'Jane', 'Darling', 'F', '10', 1, '2007-10-29 15:15:13', 0, '0000-00-00 00:00:00');
INSERT INTO `children` VALUES (50, 'Dan', 'Kintu', 'Opio', 'M', '12', 1, '2007-10-29 15:15:13', 0, '0000-00-00 00:00:00');
INSERT INTO `children` VALUES (51, 'Peter', 'Okello', '', 'M', '17', 1, '2007-10-29 15:15:13', 0, '0000-00-00 00:00:00');
INSERT INTO `children` VALUES (52, 'Mary', 'Jane', 'Darling', 'F', '10', 1, '2007-10-29 15:15:13', 0, '0000-00-00 00:00:00');
INSERT INTO `children` VALUES (53, 'Dan', 'Kintu', 'Opio', 'M', '12', 1, '2007-10-29 15:23:01', 0, '0000-00-00 00:00:00');
INSERT INTO `children` VALUES (54, 'Peter', 'Okello', '', 'M', '17', 1, '2007-10-29 15:23:01', 0, '0000-00-00 00:00:00');
INSERT INTO `children` VALUES (55, 'Mary', 'Jane', 'Darling', 'F', '10', 1, '2007-10-29 15:23:01', 0, '0000-00-00 00:00:00');
INSERT INTO `children` VALUES (56, 'Dan', 'Kintu', 'Opio', 'M', '12', 1, '2007-10-29 15:25:22', 0, '0000-00-00 00:00:00');
INSERT INTO `children` VALUES (57, 'Peter', 'Okello', '', 'M', '17', 1, '2007-10-29 15:25:23', 0, '0000-00-00 00:00:00');
INSERT INTO `children` VALUES (58, 'Mary', 'Jane', 'Darling', 'F', '10', 1, '2007-10-29 15:25:23', 0, '0000-00-00 00:00:00');
INSERT INTO `children` VALUES (59, 'Dan', 'Kintu', 'Opio', 'M', '12', 1, '2007-10-29 15:27:31', 0, '0000-00-00 00:00:00');
INSERT INTO `children` VALUES (60, 'Peter', 'Okello', '', 'M', '17', 1, '2007-10-29 15:27:31', 0, '0000-00-00 00:00:00');
INSERT INTO `children` VALUES (61, 'Mary', 'Jane', 'Darling', 'F', '10', 1, '2007-10-29 15:27:32', 0, '0000-00-00 00:00:00');
INSERT INTO `children` VALUES (62, 'Dan', 'Kintu', 'Opio', 'M', '12', 1, '2007-10-29 15:28:22', 0, '0000-00-00 00:00:00');
INSERT INTO `children` VALUES (63, 'Peter', 'Okello', '', 'M', '17', 1, '2007-10-29 15:28:22', 0, '0000-00-00 00:00:00');
INSERT INTO `children` VALUES (64, 'Mary', 'Jane', 'Darling', 'F', '10', 1, '2007-10-29 15:28:22', 0, '0000-00-00 00:00:00');
INSERT INTO `children` VALUES (65, 'Dan', 'Kintu', 'Opio', 'M', '12', 1, '2007-10-29 15:29:41', 1, '2007-11-09 06:07:59');
INSERT INTO `children` VALUES (66, 'Peter', 'Okello', 'Kasasiro', 'M', '17', 1, '2007-10-29 15:29:41', 1, '2007-11-09 06:07:59');
INSERT INTO `children` VALUES (67, 'Maria', 'Jane', 'Darling', 'F', '30', 1, '2007-10-29 15:29:41', 1, '2007-11-09 06:07:59');
INSERT INTO `children` VALUES (68, 'Dan', 'Kintu', 'Opio', 'M', '12', 1, '2007-10-29 15:42:41', 1, '2007-11-09 06:17:49');
INSERT INTO `children` VALUES (69, 'Peter', 'Okello', '', 'M', '17', 1, '2007-10-29 15:42:42', 1, '2007-11-09 06:17:49');
INSERT INTO `children` VALUES (70, 'Mary', 'Jane', 'Darling', 'F', '10', 1, '2007-10-29 15:42:42', 1, '2007-11-09 06:17:49');
INSERT INTO `children` VALUES (71, 'Micheal', 'Fenekansi', '', 'M', '18', 1, '2007-11-09 06:07:59', 0, '0000-00-00 00:00:00');
INSERT INTO `children` VALUES (72, 'Florn', 'Johns', 'Hunt', 'F', '23', 1, '2007-11-09 06:35:43', 1, '2007-11-09 06:38:07');
INSERT INTO `children` VALUES (73, 'Mary', 'Saary', '', 'F', '10', 1, '2007-11-09 06:35:43', 1, '2007-11-09 06:38:07');
INSERT INTO `children` VALUES (74, 'felix', 'Kent', 'Umer', 'F', '10', 1, '2007-11-09 10:09:52', 1, '2008-01-04 21:50:45');
INSERT INTO `children` VALUES (75, 'Dean', 'Tish', 'Innocent', 'F', '65', 1, '2007-11-09 10:09:53', 1, '2008-01-04 21:50:45');
INSERT INTO `children` VALUES (76, 'John Peters', 'I Think', 'Peterson', 'M', '23', 1, '2007-11-09 10:17:24', 1, '2008-01-04 21:50:45');
INSERT INTO `children` VALUES (77, 'Jinja', 'Hunt', '', 'F', '10', 1, '2007-11-09 10:18:17', 1, '2008-01-04 21:50:45');
INSERT INTO `children` VALUES (78, 'Feroz', 'Johns', 'Hopkins', 'M', '12', 1, '2007-11-14 09:28:19', 1, '2007-11-14 21:41:03');
INSERT INTO `children` VALUES (79, 'Hint', 'Jina', 'Tina', 'F', '10', 1, '2007-11-14 09:28:19', 1, '2007-11-14 21:41:03');
INSERT INTO `children` VALUES (80, 'Torry', 'Johns', 'ziwa', 'M', '9', 1, '2007-11-14 09:28:19', 1, '2007-11-14 21:41:03');
INSERT INTO `children` VALUES (81, 'Mary', 'Ogong', '', 'F', '1', 1, '2007-11-20 10:27:42', 1, '2008-01-04 21:50:45');

-- --------------------------------------------------------

-- 
-- Table structure for table `clients`
-- 

DROP TABLE IF EXISTS `clients`;
CREATE TABLE `clients` (
  `id` bigint(20) NOT NULL auto_increment,
  `name` varchar(255) default NULL,
  `plotno` varchar(255) default NULL,
  `boxno` varchar(255) default NULL,
  `floorno` varchar(20) default NULL,
  `genphone` bigint(20) NOT NULL default '0',
  `contname` varchar(250) NOT NULL default '',
  `contposition` varchar(250) NOT NULL default '',
  `contphone` bigint(20) NOT NULL default '0',
  `email` varchar(255) default NULL,
  `isactive` enum('Y','N') NOT NULL default 'N',
  `datecreated` varchar(255) default NULL,
  `createdby` bigint(20) default NULL,
  `lastupdatedby` bigint(20) default NULL,
  `lastupdatedate` timestamp NULL default NULL on update CURRENT_TIMESTAMP,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='InnoDB free: 4096 kB; InnoDB free: 4096 kB; InnoDB free: 409' AUTO_INCREMENT=22 ;

-- 
-- Dumping data for table `clients`
-- 

INSERT INTO `clients` VALUES (1, 'name1', 'phone1', 'example1@example.com', 'address1', 0, '', '', 0, 'bank1', '', '2007-10-02', 1, 1, '2007-10-02 15:31:25');
INSERT INTO `clients` VALUES (2, 'Crane Bank', '12', '5473', '12', 76865856, '', '', 53253245, 'info@cranebank.com', 'Y', '07-11-19', 1, NULL, '2007-11-27 19:03:39');
INSERT INTO `clients` VALUES (4, 'Stanbic Bank', '4141', 'stan@yahoo.com', 'dasdjk', 0, '', '', 0, 'sa', '', '2007-10-24', 1, NULL, '2007-11-30 16:18:45');
INSERT INTO `clients` VALUES (6, 'UTL', '412', '4124, Jinja', '', 750925298, '', '', 428525597, 'sam@fj.com', 'N', '2007-10-24', 1, NULL, '2007-11-27 19:24:03');
INSERT INTO `clients` VALUES (10, 'Fida', '424', '5424', '41541', 441545, '', '', 415, 'sam@yahoo.com', 'Y', '07-10-27', 1, NULL, NULL);
INSERT INTO `clients` VALUES (12, 'UCB', '14', '424', '44', 45636, '', '', 63, 'sampkal@yahoo.com', 'Y', '07-10-27', 1, NULL, NULL);
INSERT INTO `clients` VALUES (14, 'Nile Breweries', '2222222', '4525', '5425', 55555555, '', '', 4151, 'sampkal@gmail.com', 'N', '07-10-27', 1, NULL, '2007-10-28 02:13:13');
INSERT INTO `clients` VALUES (15, 'Shark Inc.', '4141', '56666666666', '4151', 4151, '', '', 515415, 'sdsa', 'Y', '07-10-27', 1, NULL, '2007-11-30 16:19:46');
INSERT INTO `clients` VALUES (16, 'Kits End International', '3414', '414', '4124', 414, '', '', 54124, 'samp@gmail.com', 'N', '07-10-27', 1, NULL, '2007-11-30 16:19:20');
INSERT INTO `clients` VALUES (18, 'Felix Holdings', '43', '363636', '3', 53242423432, '', '', 23423432, 'felix@yahoo.com', 'Y', '07-11-20', 1, NULL, NULL);
INSERT INTO `clients` VALUES (19, 'Kintu & Sons Limited', '23 Kira Rd', '413213', '', 78234243242, '', '', 78234243242, 'kandsons@info.com', 'Y', '07-11-28', 1, NULL, '2007-11-28 11:01:21');
INSERT INTO `clients` VALUES (20, 'Zious Holdings Ltd', '12', '1234', 'Floor 3', 256, '', '', 256, 'alzious@yahoo.co.uk', 'Y', '07-12-06', 1, NULL, NULL);
INSERT INTO `clients` VALUES (21, 'Ugasa Holdings', 'Plot 23 Jinja Rd.', '124123 Jinja', 'Floor 3, Rm 23', 734563456, 'Kintu Deograsias', 'Chief Security Officer', 4567456745, 'ugasa@ugasa.com', 'N', '08-01-05', 1, NULL, '2008-01-05 12:58:29');

-- --------------------------------------------------------

-- 
-- Table structure for table `commanders`
-- 

DROP TABLE IF EXISTS `commanders`;
CREATE TABLE `commanders` (
  `id` bigint(20) NOT NULL auto_increment,
  `name` varchar(255) NOT NULL default '',
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=33 ;

-- 
-- Dumping data for table `commanders`
-- 

INSERT INTO `commanders` VALUES (7, 'kalenzi samuel');
INSERT INTO `commanders` VALUES (8, 'kamus');
INSERT INTO `commanders` VALUES (9, 'kk');
INSERT INTO `commanders` VALUES (10, 'kk');
INSERT INTO `commanders` VALUES (11, '');
INSERT INTO `commanders` VALUES (12, '');
INSERT INTO `commanders` VALUES (13, '');
INSERT INTO `commanders` VALUES (14, '');
INSERT INTO `commanders` VALUES (15, '');
INSERT INTO `commanders` VALUES (16, '');
INSERT INTO `commanders` VALUES (17, '');
INSERT INTO `commanders` VALUES (18, '');
INSERT INTO `commanders` VALUES (19, '');
INSERT INTO `commanders` VALUES (20, '');
INSERT INTO `commanders` VALUES (21, '');
INSERT INTO `commanders` VALUES (22, '');
INSERT INTO `commanders` VALUES (23, '');
INSERT INTO `commanders` VALUES (24, 'Array');
INSERT INTO `commanders` VALUES (25, 'Array');
INSERT INTO `commanders` VALUES (26, 'Array');
INSERT INTO `commanders` VALUES (27, '');
INSERT INTO `commanders` VALUES (28, '8');
INSERT INTO `commanders` VALUES (29, '8');
INSERT INTO `commanders` VALUES (30, '8');
INSERT INTO `commanders` VALUES (31, '');
INSERT INTO `commanders` VALUES (32, '');

-- --------------------------------------------------------

-- 
-- Table structure for table `district`
-- 

DROP TABLE IF EXISTS `district`;
CREATE TABLE `district` (
  `id` bigint(20) NOT NULL auto_increment,
  `district` varchar(250) NOT NULL default '',
  `date_of_entry` datetime NOT NULL default '0000-00-00 00:00:00',
  `lastupdatedby` bigint(20) NOT NULL default '0',
  `lastupdatedate` datetime NOT NULL default '0000-00-00 00:00:00',
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=14 ;

-- 
-- Dumping data for table `district`
-- 

INSERT INTO `district` VALUES (1, 'Kabong', '2007-10-25 12:02:28', 0, '0000-00-00 00:00:00');
INSERT INTO `district` VALUES (2, 'kampala', '2007-10-25 13:33:53', 0, '0000-00-00 00:00:00');
INSERT INTO `district` VALUES (9, 'Kintu Rd Bridge', '2007-10-25 14:46:59', 0, '0000-00-00 00:00:00');
INSERT INTO `district` VALUES (10, 'Felix John Hopkins', '2007-10-25 14:47:22', 0, '0000-00-00 00:00:00');
INSERT INTO `district` VALUES (11, 'Mpigi', '2007-10-27 14:50:15', 0, '0000-00-00 00:00:00');
INSERT INTO `district` VALUES (12, 'Kamuli', '2007-11-15 11:46:16', 0, '0000-00-00 00:00:00');
INSERT INTO `district` VALUES (13, 'Masaka', '2007-12-13 15:13:07', 0, '0000-00-00 00:00:00');

-- --------------------------------------------------------

-- 
-- Table structure for table `documents`
-- 

DROP TABLE IF EXISTS `documents`;
CREATE TABLE `documents` (
  `id` bigint(20) NOT NULL auto_increment,
  `guardid` bigint(20) default NULL,
  `name` varchar(255) default NULL,
  `originalfilename` varchar(255) default NULL,
  `newfilename` varchar(255) default NULL,
  `description` varchar(255) default NULL,
  `createdby` bigint(20) default NULL,
  `datecreated` date default NULL,
  `lastupdatedby` bigint(20) default NULL,
  `lastupdatedate` timestamp NULL default NULL on update CURRENT_TIMESTAMP,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='InnoDB free: 4096 kB; InnoDB free: 4096 kB; InnoDB free: 409' AUTO_INCREMENT=34 ;

-- 
-- Dumping data for table `documents`
-- 

INSERT INTO `documents` VALUES (1, 0, '', '', '', '', 1, '2007-10-14', NULL, NULL);
INSERT INTO `documents` VALUES (2, 0, '', '', '', '', 1, '2007-10-14', NULL, NULL);
INSERT INTO `documents` VALUES (3, 0, '', '', '', '', 1, '2007-10-14', NULL, NULL);
INSERT INTO `documents` VALUES (4, 0, '', '', '', '', 1, '2007-10-14', NULL, NULL);
INSERT INTO `documents` VALUES (5, 0, '', '', '', '', 1, '2007-10-14', NULL, NULL);
INSERT INTO `documents` VALUES (6, 0, '', '', '', '', 1, '2007-10-14', NULL, NULL);
INSERT INTO `documents` VALUES (7, 0, '', '', '', '', 1, '2007-10-14', NULL, NULL);
INSERT INTO `documents` VALUES (8, 0, '', '', '', '', 1, '2007-10-14', NULL, NULL);
INSERT INTO `documents` VALUES (9, 0, '', '', '', '', 1, '2007-10-14', NULL, NULL);
INSERT INTO `documents` VALUES (10, 0, '', '', '', '', 1, '2007-10-14', NULL, NULL);
INSERT INTO `documents` VALUES (11, 0, '', '', '', '', 1, '2007-10-15', NULL, NULL);
INSERT INTO `documents` VALUES (12, 0, '', '', '', '', 1, '2007-10-15', NULL, NULL);
INSERT INTO `documents` VALUES (13, 0, '', '', '', '', 1, '2007-10-15', NULL, NULL);
INSERT INTO `documents` VALUES (14, 0, '', '', '', '', 1, '2007-10-15', NULL, NULL);
INSERT INTO `documents` VALUES (15, 0, '', '', '', '', 1, '2007-10-15', NULL, NULL);
INSERT INTO `documents` VALUES (16, 0, '', '', '', '', 1, '2007-10-15', NULL, NULL);
INSERT INTO `documents` VALUES (17, 0, '', '', '', '', 1, '2007-10-15', NULL, NULL);
INSERT INTO `documents` VALUES (18, 0, '', '', '', '', 1, '2007-10-15', NULL, NULL);
INSERT INTO `documents` VALUES (19, 0, '', '', '', '', 1, '2007-10-15', NULL, NULL);
INSERT INTO `documents` VALUES (20, 0, '', '', '', '', 1, '2007-10-15', NULL, NULL);
INSERT INTO `documents` VALUES (21, 0, '', '', '', '', 1, '2007-10-15', NULL, NULL);
INSERT INTO `documents` VALUES (22, 0, '', '', '', '', 1, '2007-10-15', NULL, NULL);
INSERT INTO `documents` VALUES (23, 0, '', '', '', '', 1, '2007-10-17', NULL, NULL);
INSERT INTO `documents` VALUES (24, 0, '', '', '', '', 1, '2007-10-17', NULL, NULL);
INSERT INTO `documents` VALUES (25, 0, '', '', '', '', 1, '2007-10-18', NULL, NULL);
INSERT INTO `documents` VALUES (26, 0, '', '', '', '', 1, '2007-10-18', NULL, NULL);
INSERT INTO `documents` VALUES (27, 0, '', '', '', '', 0, '2007-10-19', NULL, NULL);
INSERT INTO `documents` VALUES (28, 0, '', '', '', '', 0, '2007-10-20', NULL, NULL);
INSERT INTO `documents` VALUES (29, 0, '', '', '', '', 0, '2007-10-20', NULL, NULL);
INSERT INTO `documents` VALUES (30, 0, '', '', '', '', 0, '2007-10-20', NULL, NULL);
INSERT INTO `documents` VALUES (31, 0, '', '', '', '', 1, '2007-10-23', NULL, NULL);
INSERT INTO `documents` VALUES (32, 0, '', '', '', '', 1, '2007-10-23', NULL, NULL);
INSERT INTO `documents` VALUES (33, 0, '', '', '', '', 1, '2007-10-23', NULL, NULL);

-- --------------------------------------------------------

-- 
-- Table structure for table `employers`
-- 

DROP TABLE IF EXISTS `employers`;
CREATE TABLE `employers` (
  `id` bigint(20) NOT NULL auto_increment,
  `name` varchar(250) NOT NULL default '',
  `telephone` varchar(100) NOT NULL default '',
  `physicaladdress` varchar(250) NOT NULL default '',
  `startdate` varchar(40) NOT NULL default '',
  `enddate` varchar(40) NOT NULL default '',
  `createdby` bigint(20) NOT NULL default '0',
  `date_of_entry` datetime NOT NULL default '0000-00-00 00:00:00',
  `lastupdatedby` bigint(20) NOT NULL default '0',
  `lastupdatedate` datetime NOT NULL default '0000-00-00 00:00:00',
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=93 ;

-- 
-- Dumping data for table `employers`
-- 

INSERT INTO `employers` VALUES (1, '', '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, '2007-10-29 08:59:02', 0, '0000-00-00 00:00:00');
INSERT INTO `employers` VALUES (2, '', '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, '2007-10-29 08:59:30', 0, '0000-00-00 00:00:00');
INSERT INTO `employers` VALUES (3, '', '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, '2007-10-29 09:01:39', 0, '0000-00-00 00:00:00');
INSERT INTO `employers` VALUES (4, '', '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, '2007-10-29 09:05:35', 0, '0000-00-00 00:00:00');
INSERT INTO `employers` VALUES (5, '', '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, '2007-10-29 09:11:22', 0, '0000-00-00 00:00:00');
INSERT INTO `employers` VALUES (6, '', '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, '2007-10-29 09:17:16', 0, '0000-00-00 00:00:00');
INSERT INTO `employers` VALUES (7, '', '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, '2007-10-29 09:19:35', 0, '0000-00-00 00:00:00');
INSERT INTO `employers` VALUES (8, '', '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, '2007-10-29 09:25:22', 0, '0000-00-00 00:00:00');
INSERT INTO `employers` VALUES (9, '', '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, '2007-10-29 09:28:32', 0, '0000-00-00 00:00:00');
INSERT INTO `employers` VALUES (10, '', '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, '2007-10-29 09:31:30', 0, '0000-00-00 00:00:00');
INSERT INTO `employers` VALUES (11, '', '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, '2007-10-29 09:36:03', 0, '0000-00-00 00:00:00');
INSERT INTO `employers` VALUES (12, '', '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, '2007-10-29 09:38:26', 0, '0000-00-00 00:00:00');
INSERT INTO `employers` VALUES (13, '', '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, '2007-10-29 09:38:58', 0, '0000-00-00 00:00:00');
INSERT INTO `employers` VALUES (14, '', '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, '2007-10-29 09:40:52', 0, '0000-00-00 00:00:00');
INSERT INTO `employers` VALUES (15, '', '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, '2007-10-29 09:45:18', 0, '0000-00-00 00:00:00');
INSERT INTO `employers` VALUES (16, '', '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, '2007-10-29 09:46:23', 0, '0000-00-00 00:00:00');
INSERT INTO `employers` VALUES (17, '', '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, '2007-10-29 09:47:57', 0, '0000-00-00 00:00:00');
INSERT INTO `employers` VALUES (18, '', '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, '2007-10-29 09:49:22', 0, '0000-00-00 00:00:00');
INSERT INTO `employers` VALUES (19, '', '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, '2007-10-29 09:51:56', 0, '0000-00-00 00:00:00');
INSERT INTO `employers` VALUES (20, '', '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, '2007-10-29 09:52:40', 0, '0000-00-00 00:00:00');
INSERT INTO `employers` VALUES (21, '', '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, '2007-10-29 10:36:07', 0, '0000-00-00 00:00:00');
INSERT INTO `employers` VALUES (22, '', '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, '2007-10-29 10:39:53', 0, '0000-00-00 00:00:00');
INSERT INTO `employers` VALUES (23, '', '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, '2007-10-29 10:43:45', 0, '0000-00-00 00:00:00');
INSERT INTO `employers` VALUES (24, '', '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, '2007-10-29 13:14:54', 0, '0000-00-00 00:00:00');
INSERT INTO `employers` VALUES (25, '', '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, '2007-10-29 13:18:54', 0, '0000-00-00 00:00:00');
INSERT INTO `employers` VALUES (26, '', '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, '2007-10-29 13:21:56', 0, '0000-00-00 00:00:00');
INSERT INTO `employers` VALUES (27, '', '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, '2007-10-29 13:23:25', 0, '0000-00-00 00:00:00');
INSERT INTO `employers` VALUES (28, '', '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, '2007-10-29 13:25:09', 0, '0000-00-00 00:00:00');
INSERT INTO `employers` VALUES (29, '', '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, '2007-10-29 13:56:42', 0, '0000-00-00 00:00:00');
INSERT INTO `employers` VALUES (30, '', '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, '2007-10-29 14:08:49', 0, '0000-00-00 00:00:00');
INSERT INTO `employers` VALUES (31, '', '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, '2007-10-29 14:11:43', 0, '0000-00-00 00:00:00');
INSERT INTO `employers` VALUES (32, '', '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, '2007-10-29 14:19:57', 0, '0000-00-00 00:00:00');
INSERT INTO `employers` VALUES (33, '', '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, '2007-10-29 14:21:04', 0, '0000-00-00 00:00:00');
INSERT INTO `employers` VALUES (34, '', '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, '2007-10-29 14:32:28', 0, '0000-00-00 00:00:00');
INSERT INTO `employers` VALUES (35, 'Saracen Limited', '434123213', 'Plot 34 Katong Hill', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, '2007-10-29 14:51:12', 0, '0000-00-00 00:00:00');
INSERT INTO `employers` VALUES (36, 'Saracen Limited', '434123213', 'Plot 34 Katong Hill', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, '2007-10-29 14:52:57', 0, '0000-00-00 00:00:00');
INSERT INTO `employers` VALUES (37, 'Saracen Limited', '434123213', 'Plot 34 Katong Hill', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, '2007-10-29 14:55:00', 0, '0000-00-00 00:00:00');
INSERT INTO `employers` VALUES (38, 'Saracen Limited', '434123213', 'Plot 34 Katong Hill', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, '2007-10-29 14:56:42', 0, '0000-00-00 00:00:00');
INSERT INTO `employers` VALUES (39, 'Saracen Limited', '434123213', 'Plot 34 Katong Hill', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, '2007-10-29 15:00:31', 0, '0000-00-00 00:00:00');
INSERT INTO `employers` VALUES (40, 'Saracen Limited', '434123213', 'Plot 34 Katong Hill', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, '2007-10-29 15:01:41', 0, '0000-00-00 00:00:00');
INSERT INTO `employers` VALUES (41, 'Saracen Limited', '434123213', 'Plot 34 Katong Hill', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, '2007-10-29 15:03:33', 0, '0000-00-00 00:00:00');
INSERT INTO `employers` VALUES (42, 'Saracen Limited', '434123213', 'Plot 34 Katong Hill', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, '2007-10-29 15:09:02', 0, '0000-00-00 00:00:00');
INSERT INTO `employers` VALUES (43, 'Saracen Limited', '434123213', 'Plot 34 Katong Hill', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, '2007-10-29 15:10:58', 0, '0000-00-00 00:00:00');
INSERT INTO `employers` VALUES (44, 'Saracen Limited', '434123213', 'Plot 34 Katong Hill', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, '2007-10-29 15:13:10', 0, '0000-00-00 00:00:00');
INSERT INTO `employers` VALUES (45, 'Saracen Limited', '434123213', 'Plot 34 Katong Hill', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, '2007-10-29 15:14:44', 0, '0000-00-00 00:00:00');
INSERT INTO `employers` VALUES (46, 'Saracen Limited', '434123213', 'Plot 34 Katong Hill', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, '2007-10-29 15:15:14', 0, '0000-00-00 00:00:00');
INSERT INTO `employers` VALUES (47, 'Saracen Limited', '434123213', 'Plot 34 Katong Hill', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, '2007-10-29 15:23:02', 0, '0000-00-00 00:00:00');
INSERT INTO `employers` VALUES (48, 'Saracen Limited', '434123213', 'Plot 34 Katong Hill', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, '2007-10-29 15:25:23', 0, '0000-00-00 00:00:00');
INSERT INTO `employers` VALUES (49, 'Saracen Limited', '434123213', 'Plot 34 Katong Hill', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, '2007-10-29 15:27:32', 0, '0000-00-00 00:00:00');
INSERT INTO `employers` VALUES (50, 'Saracen Limited', '434123213', 'Plot 34 Katong Hill', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, '2007-10-29 15:28:22', 0, '0000-00-00 00:00:00');
INSERT INTO `employers` VALUES (51, 'Saracen Limited', '434123213', 'Plot 34 Katong Hill', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, '2007-10-29 15:29:42', 0, '0000-00-00 00:00:00');
INSERT INTO `employers` VALUES (52, 'Saracen Limited', '434123213', 'Plot 34 Katong Hill', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, '2007-10-29 15:42:42', 0, '0000-00-00 00:00:00');
INSERT INTO `employers` VALUES (53, 'Kirimutu Secutiry', '5324324324', 'Plot 34\r\nKanjokya Street', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, '2007-11-09 06:08:00', 0, '0000-00-00 00:00:00');
INSERT INTO `employers` VALUES (54, '', '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, '2007-11-09 06:35:43', 0, '0000-00-00 00:00:00');
INSERT INTO `employers` VALUES (55, '', '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, '2007-11-09 09:10:19', 0, '0000-00-00 00:00:00');
INSERT INTO `employers` VALUES (56, '', '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, '2007-11-09 10:31:12', 0, '0000-00-00 00:00:00');
INSERT INTO `employers` VALUES (57, '', '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, '2007-11-09 10:33:14', 0, '0000-00-00 00:00:00');
INSERT INTO `employers` VALUES (58, '', '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, '2007-11-09 10:46:33', 0, '0000-00-00 00:00:00');
INSERT INTO `employers` VALUES (59, '', '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, '2007-11-09 10:52:08', 0, '0000-00-00 00:00:00');
INSERT INTO `employers` VALUES (60, '', '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, '2007-11-09 10:56:55', 0, '0000-00-00 00:00:00');
INSERT INTO `employers` VALUES (61, '', '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, '2007-11-09 10:58:50', 0, '0000-00-00 00:00:00');
INSERT INTO `employers` VALUES (62, '', '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, '2007-11-09 11:02:44', 0, '0000-00-00 00:00:00');
INSERT INTO `employers` VALUES (63, '', '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, '2007-11-09 11:39:36', 0, '0000-00-00 00:00:00');
INSERT INTO `employers` VALUES (64, '', '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, '2007-11-09 11:40:57', 0, '0000-00-00 00:00:00');
INSERT INTO `employers` VALUES (65, '', '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, '2007-11-09 11:55:07', 0, '0000-00-00 00:00:00');
INSERT INTO `employers` VALUES (66, '', '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, '2007-11-09 12:00:56', 0, '0000-00-00 00:00:00');
INSERT INTO `employers` VALUES (67, '', '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, '2007-11-11 22:18:30', 0, '0000-00-00 00:00:00');
INSERT INTO `employers` VALUES (68, '', '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, '2007-11-11 22:43:48', 0, '0000-00-00 00:00:00');
INSERT INTO `employers` VALUES (69, 'Kintu Joseph', '52424234', 'Harry Johns Hospital', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, '2007-11-13 02:47:19', 0, '0000-00-00 00:00:00');
INSERT INTO `employers` VALUES (70, 'Peter Johns Kindergaten', '954757456', 'Peter Johns Road\r\nKamwokya', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, '2007-11-13 02:48:18', 0, '0000-00-00 00:00:00');
INSERT INTO `employers` VALUES (71, 'Kintu John', '756322345', 'Hiarry Johns\r\nKint Hospital\r\nHate Squard', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, '2007-11-14 03:18:34', 0, '0000-00-00 00:00:00');
INSERT INTO `employers` VALUES (72, 'Kintu John', '756322345', 'Hiarry Johns\r\nKint Hospital\r\nHate Squard', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, '2007-11-14 03:24:59', 0, '0000-00-00 00:00:00');
INSERT INTO `employers` VALUES (73, 'Harry Peterson', '9465477457', 'Kampala Rd\r\nJinja Hospital\r\nJinja Rd', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, '2007-11-14 03:24:59', 0, '0000-00-00 00:00:00');
INSERT INTO `employers` VALUES (74, 'Kintu John', '756322345', 'Hiarry Johns\r\nKint Hospital\r\nHate Squard', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, '2007-11-14 03:26:42', 0, '0000-00-00 00:00:00');
INSERT INTO `employers` VALUES (75, 'Harry Peterson', '9465477457', 'Kampala Rd\r\nJinja Hospital\r\nJinja Rd', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, '2007-11-14 03:26:42', 0, '0000-00-00 00:00:00');
INSERT INTO `employers` VALUES (76, 'Zziwa Almond', '432523452345', 'Garry Johns peterson Str.\r\nTint Rd\r\nStreet Torry', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, '2007-11-14 03:29:10', 0, '0000-00-00 00:00:00');
INSERT INTO `employers` VALUES (77, 'Kintu Johns', '6345325432', 'hi there', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, '2007-11-14 04:00:55', 0, '0000-00-00 00:00:00');
INSERT INTO `employers` VALUES (78, 'Kintu Johns', '6345325432', 'hi there', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, '2007-11-14 04:05:57', 0, '0000-00-00 00:00:00');
INSERT INTO `employers` VALUES (79, 'Kintu Johns', '6345325432', 'hi there', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, '2007-11-14 04:06:55', 0, '0000-00-00 00:00:00');
INSERT INTO `employers` VALUES (80, 'Feron Garry', '854757575', 'testing', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, '2007-11-14 04:07:40', 0, '0000-00-00 00:00:00');
INSERT INTO `employers` VALUES (81, 'Feron Garry', '854757575', 'testing', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, '2007-11-14 04:11:12', 0, '0000-00-00 00:00:00');
INSERT INTO `employers` VALUES (82, 'Feron Garry', '854757575', 'testing', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, '2007-11-14 04:12:05', 0, '0000-00-00 00:00:00');
INSERT INTO `employers` VALUES (83, 'Feron Garry', '854757575', 'testing', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, '2007-11-14 04:14:42', 0, '0000-00-00 00:00:00');
INSERT INTO `employers` VALUES (84, 'Joseph Peterson', '74365634564', 'Yaer Hint\r\nTorry\r\nPeter Gert', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, '2007-11-14 04:15:37', 0, '0000-00-00 00:00:00');
INSERT INTO `employers` VALUES (85, 'Tired Ben', '6563456345', 'Gate Him\r\nI test', '2008', '2008', 1, '2007-11-14 04:26:48', 1, '2008-01-04 21:50:46');
INSERT INTO `employers` VALUES (86, 'there you are', '41241234', 'baby bay', '2008', '2008', 1, '2007-11-14 04:32:02', 1, '2008-01-04 21:50:46');
INSERT INTO `employers` VALUES (87, 'Kintu Moses', '9567865', 'Kint Rd.\r\nRoad Tink\r\nUganda', '1994', '2007', 1, '2007-11-14 09:28:19', 1, '2007-11-14 21:41:04');
INSERT INTO `employers` VALUES (88, 'Honey Point', '63462345', 'Garry Str.\r\nTerry Horror.', '1995', '2007', 1, '2007-11-14 09:28:19', 1, '2007-11-14 21:41:04');
INSERT INTO `employers` VALUES (89, '', '', '', '1970', '1970', 1, '2007-11-15 11:44:34', 1, '2007-11-15 11:46:53');
INSERT INTO `employers` VALUES (90, '', '', '', '1970', '1970', 1, '2007-11-27 18:41:48', 1, '2007-12-13 16:02:05');
INSERT INTO `employers` VALUES (91, '', '', '', '1970', '1970', 1, '2007-11-27 18:44:37', 1, '2007-11-28 20:05:06');
INSERT INTO `employers` VALUES (92, '', '', '', '', '', 1, '2007-11-27 18:49:27', 1, '2008-01-04 21:19:14');

-- --------------------------------------------------------

-- 
-- Table structure for table `equipment`
-- 

DROP TABLE IF EXISTS `equipment`;
CREATE TABLE `equipment` (
  `id` bigint(20) NOT NULL auto_increment,
  `type` varchar(250) NOT NULL default '',
  `name` varchar(250) NOT NULL default '',
  `serialno` varchar(250) NOT NULL default '',
  `status` varchar(250) NOT NULL default '',
  `instore` enum('Y','N') NOT NULL default 'Y',
  `date_of_entry` datetime NOT NULL default '0000-00-00 00:00:00',
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

-- 
-- Dumping data for table `equipment`
-- 

INSERT INTO `equipment` VALUES (1, 'Gun', 'Rifle - Russia 1987', '123123', 'New', 'N', '2007-11-22 00:00:00');
INSERT INTO `equipment` VALUES (2, 'Baton', 'Japan Baton', '6245235', 'Old-Usable', 'N', '2007-11-30 00:00:00');
INSERT INTO `equipment` VALUES (3, 'Gun', 'AK47 - 1998 Model', '523413123', 'Old-Not Usable', 'N', '2007-11-15 00:00:00');
INSERT INTO `equipment` VALUES (4, 'Deployment Pickup', 'Pickup - Toyota 1999 Model', 'UAB 937Q', 'New', 'N', '2007-11-30 00:00:00');
INSERT INTO `equipment` VALUES (6, 'Transport van', 'Toyota - 1992 Model', 'UAB 875H', 'Old - Usable', 'N', '2007-11-29 14:16:58');
INSERT INTO `equipment` VALUES (7, 'Deployment Pickup', 'Toyota Minibus', 'UAD 234Q', 'New - Damaged', 'Y', '2007-12-04 20:20:55');

-- --------------------------------------------------------

-- 
-- Table structure for table `equipmentdetails`
-- 

DROP TABLE IF EXISTS `equipmentdetails`;
CREATE TABLE `equipmentdetails` (
  `id` bigint(20) NOT NULL auto_increment,
  `name` text NOT NULL,
  `type` varchar(250) NOT NULL default '',
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=14 ;

-- 
-- Dumping data for table `equipmentdetails`
-- 

INSERT INTO `equipmentdetails` VALUES (2, 'New', 'Status');
INSERT INTO `equipmentdetails` VALUES (3, 'Old - Usable', 'Status');
INSERT INTO `equipmentdetails` VALUES (4, 'Old - Not Usable', 'Status');
INSERT INTO `equipmentdetails` VALUES (5, 'Obsolesent', 'Status');
INSERT INTO `equipmentdetails` VALUES (6, 'Baton', 'Type');
INSERT INTO `equipmentdetails` VALUES (7, 'Deployment Pickup', 'Type');
INSERT INTO `equipmentdetails` VALUES (8, 'Transport van', 'Type');
INSERT INTO `equipmentdetails` VALUES (9, 'Gun', 'Type');
INSERT INTO `equipmentdetails` VALUES (10, 'Uniform', 'Type');
INSERT INTO `equipmentdetails` VALUES (11, 'Overalls', 'Type');
INSERT INTO `equipmentdetails` VALUES (12, 'Uniform - Shirt', 'Type');
INSERT INTO `equipmentdetails` VALUES (13, 'New - Damaged', 'Status');

-- --------------------------------------------------------

-- 
-- Table structure for table `equipments`
-- 

DROP TABLE IF EXISTS `equipments`;
CREATE TABLE `equipments` (
  `id` bigint(20) NOT NULL auto_increment,
  `equipmenttype` varchar(255) default NULL,
  `equipmentcode` varchar(255) default NULL,
  `assignment` varchar(255) default NULL,
  `activity` varchar(255) default NULL,
  `issuingofficer` varchar(255) default NULL,
  `responsibleguard` varchar(255) default NULL,
  `startdate` date default NULL,
  `starttime` varchar(255) default NULL,
  `enddate` date default NULL,
  `endtime` varchar(255) default NULL,
  `size` varchar(255) default NULL,
  `quantity` bigint(20) default NULL,
  `datecreated` date default NULL,
  `createdby` bigint(20) default NULL,
  `lastupdatedby` bigint(20) default NULL,
  `lastupdatedate` timestamp NULL default NULL on update CURRENT_TIMESTAMP,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

-- 
-- Dumping data for table `equipments`
-- 

INSERT INTO `equipments` VALUES (1, '2', 'sad', 'sdd', '', '', '', '2007-12-04', '08:30:00', '1991-10-17', '06:30:00', '', 0, '2007-12-04', 1, 1, '2007-12-04 15:38:15');
INSERT INTO `equipments` VALUES (2, '7', 'dsd', 'sxdsd', '3', 'cdfc', 'fdfd', '2001-09-17', '06:30:00', '1993-08-12', '07:30:00', '', 0, '2007-12-04', 1, 1, '2007-12-04 15:40:00');
INSERT INTO `equipments` VALUES (3, '6', 'assdc', 'dsfcdefc', '1', 'sds', 'dsd', '2004-09-16', '09:00:00', '2004-04-15', '07:30:00', ' large', 12, '2007-12-04', 1, 1, '2007-12-04 15:50:07');
INSERT INTO `equipments` VALUES (4, '5', 'sd384598', 'h3d-k', '3', 'joab', 'vicent', '1992-08-15', '08:00:00', '2007-12-04', '07:30:00', ' medium', 16, '2007-12-04', 1, 1, '2007-12-04 16:39:34');

-- --------------------------------------------------------

-- 
-- Table structure for table `equipmenttype`
-- 

DROP TABLE IF EXISTS `equipmenttype`;
CREATE TABLE `equipmenttype` (
  `id` bigint(20) NOT NULL auto_increment,
  `equipmenttype` varchar(250) NOT NULL default '',
  `date_of_entry` datetime NOT NULL default '0000-00-00 00:00:00',
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

-- 
-- Dumping data for table `equipmenttype`
-- 

INSERT INTO `equipmenttype` VALUES (1, 'vehicle', '0000-00-00 00:00:00');
INSERT INTO `equipmenttype` VALUES (2, 'radio', '0000-00-00 00:00:00');
INSERT INTO `equipmenttype` VALUES (3, 'firearm', '0000-00-00 00:00:00');
INSERT INTO `equipmenttype` VALUES (4, 'uniform-shirt', '0000-00-00 00:00:00');
INSERT INTO `equipmenttype` VALUES (5, 'uniform-trouser', '0000-00-00 00:00:00');
INSERT INTO `equipmenttype` VALUES (6, 'uniform-jacket', '0000-00-00 00:00:00');
INSERT INTO `equipmenttype` VALUES (7, 'batoon', '0000-00-00 00:00:00');

-- --------------------------------------------------------

-- 
-- Table structure for table `experiences`
-- 

DROP TABLE IF EXISTS `experiences`;
CREATE TABLE `experiences` (
  `id` bigint(20) NOT NULL auto_increment,
  `type` varchar(100) NOT NULL default '',
  `startdate` datetime NOT NULL default '0000-00-00 00:00:00',
  `enddate` datetime NOT NULL default '0000-00-00 00:00:00',
  `createdby` bigint(20) NOT NULL default '0',
  `date_of_entry` datetime NOT NULL default '0000-00-00 00:00:00',
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=28 ;

-- 
-- Dumping data for table `experiences`
-- 

INSERT INTO `experiences` VALUES (1, 'policeexperience_', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, '2007-10-29 15:23:02');
INSERT INTO `experiences` VALUES (2, 'policeexperience_', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, '2007-10-29 15:25:23');
INSERT INTO `experiences` VALUES (3, 'policeexperience_', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, '2007-10-29 15:27:32');
INSERT INTO `experiences` VALUES (4, 'policeexperience_', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, '2007-10-29 15:28:22');
INSERT INTO `experiences` VALUES (5, 'policeexperience_', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, '2007-10-29 15:29:42');
INSERT INTO `experiences` VALUES (6, 'policeexperience_', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, '2007-10-29 15:42:42');
INSERT INTO `experiences` VALUES (7, 'policeexperience_', '1991-04-01 00:00:00', '2002-07-01 00:00:00', 1, '2007-11-09 11:36:56');
INSERT INTO `experiences` VALUES (8, 'prisonsexperience_', '1993-01-01 00:00:00', '1995-04-01 00:00:00', 1, '2007-11-09 11:36:56');
INSERT INTO `experiences` VALUES (9, 'policeexperience_', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, '2007-11-09 11:37:30');
INSERT INTO `experiences` VALUES (10, 'prisonsexperience_', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, '2007-11-09 11:37:30');
INSERT INTO `experiences` VALUES (11, 'policeexperience_', '1991-04-01 12:04:00', '2002-02-01 12:02:00', 1, '2007-11-09 11:55:07');
INSERT INTO `experiences` VALUES (12, 'armyexperience_', '1993-03-01 12:03:00', '2006-11-01 12:11:00', 1, '2007-11-09 11:58:59');
INSERT INTO `experiences` VALUES (13, 'policeexperience_', '1990-11-01 12:11:00', '1967-01-01 12:01:00', 1, '2007-11-09 12:00:56');
INSERT INTO `experiences` VALUES (14, 'armyexperience_', '2004-04-01 12:04:00', '1993-04-01 12:04:00', 1, '2007-11-09 12:06:45');
INSERT INTO `experiences` VALUES (15, 'armyexperience_', '2007-02-01 12:02:00', '2004-02-01 12:02:00', 1, '2007-11-13 02:53:20');
INSERT INTO `experiences` VALUES (16, 'policeexperience_', '2004-04-01 12:04:00', '2006-03-01 12:03:00', 1, '2007-11-13 02:53:20');
INSERT INTO `experiences` VALUES (17, 'prisonsexperience_', '2008-01-04 12:01:00', '2008-01-04 12:01:00', 1, '2007-11-13 02:55:04');
INSERT INTO `experiences` VALUES (22, 'policeexperience_', '1995-04-01 12:04:00', '1999-09-01 12:09:00', 1, '2007-11-14 03:01:11');
INSERT INTO `experiences` VALUES (23, 'policeexperience_', '1995-04-01 12:04:00', '1999-09-01 12:09:00', 1, '2007-11-14 03:08:15');
INSERT INTO `experiences` VALUES (24, 'policeexperience_', '1995-04-01 12:04:00', '1999-09-01 12:09:00', 1, '2007-11-14 03:10:22');
INSERT INTO `experiences` VALUES (25, 'policeexperience_', '1995-04-01 12:04:00', '1999-09-01 12:09:00', 1, '2007-11-14 03:13:43');
INSERT INTO `experiences` VALUES (26, 'policeexperience_', '2008-01-04 12:01:00', '2008-01-04 12:01:00', 1, '2007-11-14 03:14:44');
INSERT INTO `experiences` VALUES (27, 'policeexperience_', '1999-03-01 12:03:00', '2004-03-01 12:03:00', 1, '2007-11-14 09:28:19');

-- --------------------------------------------------------

-- 
-- Table structure for table `favorites`
-- 

DROP TABLE IF EXISTS `favorites`;
CREATE TABLE `favorites` (
  `id` bigint(20) NOT NULL auto_increment,
  `name` varchar(250) NOT NULL default '',
  `link` varchar(250) NOT NULL default '',
  `section` varchar(100) NOT NULL default '',
  `viewedby` text NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=51 ;

-- 
-- Dumping data for table `favorites`
-- 

INSERT INTO `favorites` VALUES (1, 'Add Guard', '../hr/', '1', '1');
INSERT INTO `favorites` VALUES (2, 'Add Clients', '../core/client.php', '1', '1');
INSERT INTO `favorites` VALUES (3, 'Register New User', '../core/user.php', '1', '1');
INSERT INTO `favorites` VALUES (4, 'Manage Guards', '../hr/manageguards.php', '1', '1');
INSERT INTO `favorites` VALUES (5, 'Active Guards', '../operations/manageactiveguards.php', '2', '1');
INSERT INTO `favorites` VALUES (6, 'Overtime', '../finance/overtimereport.php', '2', '1');
INSERT INTO `favorites` VALUES (7, 'Payroll Schedule', '../finance/report.php?f=Guard%20Payroll', '2', '1');
INSERT INTO `favorites` VALUES (8, 'PAYE Schedule', '../finance/paye.php', '2', '1');
INSERT INTO `favorites` VALUES (9, 'Equipment In Store', '#', '2', '1');
INSERT INTO `favorites` VALUES (10, 'Available Guards', '#', '2', '1');
INSERT INTO `favorites` VALUES (11, 'Control Shift', '../operations/report.php?f=Control%20Shift', '2', '1');
INSERT INTO `favorites` VALUES (12, 'Guard Daily Schedule', '../core/guardreport.php?f=Guard%20Daily%20Schedule', '2', '1');
INSERT INTO `favorites` VALUES (13, 'NSSF Schedule', '../finance/nssf.php', '2', '1');
INSERT INTO `favorites` VALUES (14, 'Register New Assignment', '../core/assignment.php', '3', '1');
INSERT INTO `favorites` VALUES (15, 'Active Assignments', '../core/manageassignments.php', '3', '1');
INSERT INTO `favorites` VALUES (16, 'Client Schedules', '../operations/', '3', '1');
INSERT INTO `favorites` VALUES (17, 'Guard Location', '#', '4', '1');
INSERT INTO `favorites` VALUES (18, 'Equipment Location', '../core/guardreport.php?f=Item%20Location', '4', '1');
INSERT INTO `favorites` VALUES (19, 'Configure System Expiry Date', '../settings/settings.php', '7', '1');
INSERT INTO `favorites` VALUES (20, 'Configure Global Settings', '../settings/settings.php', '7', '1');
INSERT INTO `favorites` VALUES (21, 'Manage Guard Status', '../core/manageguardstatus.php', '7', '1');
INSERT INTO `favorites` VALUES (22, 'Manage Item Status', '../core/manageitemstatus.php', '7', '1');
INSERT INTO `favorites` VALUES (23, 'Manage Item Types', '../core/manageitemtypes.php', '7', '1');
INSERT INTO `favorites` VALUES (24, 'Manage Service Types', '../core/manageservicetypes.php', '7', '1');
INSERT INTO `favorites` VALUES (25, 'Manage Disciplinary Actions', '../core/managedisciplineactions.php', '7', '1');
INSERT INTO `favorites` VALUES (26, 'Manage User Groups', '../core/managegroups.php', '7', '1');
INSERT INTO `favorites` VALUES (27, 'Manage User Rights', '../core/managerights.php', '7', '1');
INSERT INTO `favorites` VALUES (28, 'Manage Tribes', '../core/managetribes.php', '7', '1');
INSERT INTO `favorites` VALUES (29, 'Manage Districts', '../core/managedistricts.php', '7', '1');
INSERT INTO `favorites` VALUES (30, 'Manage Leave Types', '../core/manageleavetypes.php', '7', '1');
INSERT INTO `favorites` VALUES (31, 'Change PAYE Formulae', '../settings/payeformula.php', '7', '1');
INSERT INTO `favorites` VALUES (32, 'Manage Item Returns', '../inventory/itemissues.php?a=return', '5', '1');
INSERT INTO `favorites` VALUES (33, 'Manage Item Issues', '../inventory/itemissues.php', '5', '1');
INSERT INTO `favorites` VALUES (34, 'Manage Inventory', '../inventory/inventorystock.php', '5', '1');
INSERT INTO `favorites` VALUES (35, 'Manage Regions', '../core/manageregions.php', '11', '1');
INSERT INTO `favorites` VALUES (36, 'Manage Incidents', '../operations/manageincidents.php', '11', '1');
INSERT INTO `favorites` VALUES (37, 'Control Shift Report', '../operations/report.php?f=Control%20Shift', '11', '1');
INSERT INTO `favorites` VALUES (38, 'Assignment Replacement', '../manageassignments.php', '11', '1');
INSERT INTO `favorites` VALUES (39, 'Request Financial Report', '../settings/?t=New%20Finance%20Report', '6', '1');
INSERT INTO `favorites` VALUES (40, 'Manage Assignment Overtime', '../finance/overtimereport.php', '6', '1');
INSERT INTO `favorites` VALUES (41, 'Manage Guard''s Financial Status', '../finance/manageguardfinance.php', '6', '1');
INSERT INTO `favorites` VALUES (42, 'Manage Guards', '../hr/manageguards.php', '7', '1');
INSERT INTO `favorites` VALUES (43, 'Assignments on Clients', '../core/manageassignments.php', '10', '1');
INSERT INTO `favorites` VALUES (44, 'Search Personnel File', '../hr/managepersonnel.php', '8', '1');
INSERT INTO `favorites` VALUES (45, 'Search Groups', '../core/managegroups.php', '8', '1');
INSERT INTO `favorites` VALUES (46, 'Search leave Application', '../hr/manageleave.php', '8', '1');
INSERT INTO `favorites` VALUES (47, 'Search Clients', '../core/manageclients.php', '8', '1');
INSERT INTO `favorites` VALUES (48, 'Leave Application', '../hr/leave.php', '11', '1');
INSERT INTO `favorites` VALUES (49, 'Client Schedule', '../operations', '10', '1');
INSERT INTO `favorites` VALUES (50, 'Manage Clients', '../core/manageclients.php', '10', '1,11');

-- --------------------------------------------------------

-- 
-- Table structure for table `favoritesection`
-- 

DROP TABLE IF EXISTS `favoritesection`;
CREATE TABLE `favoritesection` (
  `id` bigint(20) NOT NULL auto_increment,
  `image` varchar(250) NOT NULL default '',
  `name` varchar(250) NOT NULL default '',
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=12 ;

-- 
-- Dumping data for table `favoritesection`
-- 

INSERT INTO `favoritesection` VALUES (1, '../images/scheduleguards.gif', 'HR');
INSERT INTO `favoritesection` VALUES (2, '../images/managementofassignements.gif', 'Reports');
INSERT INTO `favoritesection` VALUES (3, '../images/schedulingguards.gif', 'Guard Assignments');
INSERT INTO `favoritesection` VALUES (4, '../images/managelocations.gif', 'Track Locations');
INSERT INTO `favoritesection` VALUES (5, '../images/inventorymanagement.gif', 'Inventory');
INSERT INTO `favoritesection` VALUES (6, '../images/financeandaccounting.gif', 'Finance');
INSERT INTO `favoritesection` VALUES (7, '../images/registerandmanageguards.gif', 'Administration');
INSERT INTO `favoritesection` VALUES (8, '../images/search.gif', 'Search');
INSERT INTO `favoritesection` VALUES (9, '../images/scheduleguards.gif', 'Schedule Guards');
INSERT INTO `favoritesection` VALUES (10, '../images/managepersonalfiles.gif', 'Clients');
INSERT INTO `favoritesection` VALUES (11, '../images/customer.gif', 'Operations');

-- --------------------------------------------------------

-- 
-- Table structure for table `filedocuments`
-- 

DROP TABLE IF EXISTS `filedocuments`;
CREATE TABLE `filedocuments` (
  `id` bigint(20) NOT NULL auto_increment,
  `personalfileid` bigint(20) NOT NULL default '0',
  `documentname` varchar(255) default NULL,
  `issued` enum('N','Y') default NULL,
  `dateissued` date default NULL,
  `firstrenewal` date default NULL,
  `secondrenewal` date default NULL,
  `thirdrenewal` date default NULL,
  `datecreated` date default NULL,
  `lastupdatedate` timestamp NULL default NULL on update CURRENT_TIMESTAMP,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- 
-- Dumping data for table `filedocuments`
-- 


-- --------------------------------------------------------

-- 
-- Table structure for table `groups`
-- 

DROP TABLE IF EXISTS `groups`;
CREATE TABLE `groups` (
  `id` bigint(20) NOT NULL auto_increment,
  `name` varchar(255) default NULL,
  `description` varchar(255) default NULL,
  `rights` text NOT NULL,
  `createdby` bigint(20) default NULL,
  `datecreated` date default NULL,
  `lastupdatedby` bigint(20) default NULL,
  `lastupdatedate` timestamp NULL default NULL on update CURRENT_TIMESTAMP,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='InnoDB free: 4096 kB; InnoDB free: 4096 kB; InnoDB free: 409' AUTO_INCREMENT=86 ;

-- 
-- Dumping data for table `groups`
-- 

INSERT INTO `groups` VALUES (1, 'Administrators', 'System Administrators for the whole system', '91,65,108,72,71,70,138,44,125,139,124,47,48,59,46,98,74,54,103,49,62,45,100,116,120,111,68,76,106,57,81,53,78,61,82,99,115,119,110,67,87,85,75,105,56,80,79,95,121,83,112,132,127,136,135,134,126,133,129,131,130,94,93,90,50,73,96,107,102,60,42,113,66,117,55,128,89,101,41,32,52,64,69,92,137,123,51,36,33,39,63,43,122,77,88,40,97,35,114,109,86,34,38,84,104,118,58', 1, '2007-11-28', 1, '2008-01-09 10:57:14');
INSERT INTO `groups` VALUES (79, 'Operations Clerks', 'These are the data guys in the operations department.', '108,44,47,48,98,53,99,115,119,110,67,80,95,121,112,127,94,50,96,107,102,113,66,117,101,32,52,69,92,123,51,36,122,97,35,114,109,34,38,104,118', 1, '2008-01-05', NULL, '2008-01-09 11:18:52');
INSERT INTO `groups` VALUES (80, 'Finance Management', 'These are managers in the finance and accounting department', '91,72,125,81,78,82,87,85,80,79,121,83,135,134,126,141,93,90,50,73,96,107,42,113,66,117,128,89,101,32,52,69,92,123,51,36,33,39,63,43,122,77,97,35,114,109,86,34,84,118', 1, '2008-01-09', NULL, '2008-01-09 11:19:04');
INSERT INTO `groups` VALUES (81, 'Finance Clerks', 'These are clerks in the finance and accounting department', '47,81,78,82,87,85,80,79,121,83,141,90,50,96,107,42,113,66,117,89,140,32,52,69,92,123,51,36,33,39,43,122,88,97,35,114,109,86,34,84,118', 1, '2008-01-09', NULL, '2008-01-09 11:25:30');
INSERT INTO `groups` VALUES (82, 'Operations Management', 'Members in the operations\r\nmanagement department', '91,65,108,70,44,47,48,98,103,49,100,116,120,111,68,106,53,99,115,119,110,67,105,80,95,121,112,132,127,136,135,134,126,133,94,90,50,73,96,107,102,113,66,117,128,101,32,52,69,92,123,51,36,122,77,97,35,114,109,34,38,104,118', 1, '2008-01-09', NULL, '2008-01-09 11:32:35');
INSERT INTO `groups` VALUES (83, 'General Management', 'General\r\nManagement members', '91,87,85,80,79,95,121,83,141,93,90,50,142,96,107,42,113,66,117,128,101,41,32,52,92,137,123,51,36,33,43,122,77,88,97,35,114,109,86,34,84,118', 1, '2008-01-09', NULL, '2008-01-09 11:36:55');
INSERT INTO `groups` VALUES (84, 'HR Management', 'These are managers in the HR Department', '65,71,44,46,74,45,68,76,67,75,132,136,141,50,73,142,42,66,128,32,52,69,123,51,36,43,122,77,40,34', 1, '2008-01-09', NULL, '2008-01-09 11:45:12');
INSERT INTO `groups` VALUES (85, 'HR Clerks', 'These are Clerks in the HR Department', '65,44,46,67,141,50,73,142,42,66,32,52,69,123,51,36,43,122,77,40,34', 1, '2008-01-09', NULL, '2008-01-09 11:48:23');

-- --------------------------------------------------------

-- 
-- Table structure for table `guardfinance`
-- 

DROP TABLE IF EXISTS `guardfinance`;
CREATE TABLE `guardfinance` (
  `id` bigint(20) NOT NULL auto_increment,
  `amount` varchar(200) NOT NULL default '',
  `type` varchar(200) NOT NULL default '',
  `date` datetime NOT NULL default '0000-00-00 00:00:00',
  `reason` text NOT NULL,
  `approved` enum('Y','N') NOT NULL default 'N',
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=41 ;

-- 
-- Dumping data for table `guardfinance`
-- 

INSERT INTO `guardfinance` VALUES (1, '3000', 'Bonus', '2007-12-11 10:40:20', 'He shot and wounded a thief who was stealing a clients car', 'N');
INSERT INTO `guardfinance` VALUES (2, '7000', 'Bonus', '2007-12-05 10:40:58', 'He was instrumental in catching  a thief who raided the clients factory', 'Y');
INSERT INTO `guardfinance` VALUES (3, '23000', 'Deduction', '2007-12-07 00:00:00', 'He lost his uniform in a fight at his home', 'Y');
INSERT INTO `guardfinance` VALUES (27, '9000', 'Bonus', '2007-12-11 00:00:00', 'the guard tole the show by eating a rat', 'Y');
INSERT INTO `guardfinance` VALUES (28, '2000', 'Bonus', '2007-12-15 00:00:00', 'THere was a dilema in addition of this', 'Y');
INSERT INTO `guardfinance` VALUES (29, '78000', 'Bonus', '2007-12-06 00:00:00', 'I wanted to show the guard that is was doable', 'Y');
INSERT INTO `guardfinance` VALUES (30, '620', 'Bonus', '2007-12-03 00:00:00', 'Got from his own sweat', 'Y');
INSERT INTO `guardfinance` VALUES (31, '12000', 'Bonus', '2007-12-13 00:00:00', 'there are no problems with thim', 'Y');
INSERT INTO `guardfinance` VALUES (32, '30000', 'Deduction', '2007-11-02 00:00:00', 'There is no reason for hiring him', 'N');
INSERT INTO `guardfinance` VALUES (33, '11000', 'Deduction', '2007-12-03 00:00:00', 'Till ther is a problem.', 'Y');
INSERT INTO `guardfinance` VALUES (34, '45800', 'Bonus', '2007-02-04 00:00:00', 'There is no way that I want to get above', 'Y');
INSERT INTO `guardfinance` VALUES (35, '12400', 'Bonus', '2007-01-03 00:00:00', 'The guard bought the clients land.', 'Y');
INSERT INTO `guardfinance` VALUES (36, '12400', 'Bonus', '2007-01-03 00:00:00', 'The guard bought the clients land.', 'Y');
INSERT INTO `guardfinance` VALUES (37, '1000', 'Deduction', '2007-12-07 00:00:00', 'The guard stole the clients phone', 'Y');
INSERT INTO `guardfinance` VALUES (38, '19000', 'Bonus', '2007-05-03 00:00:00', 'there are no things done so far', 'N');
INSERT INTO `guardfinance` VALUES (39, '14000', 'Deduction', '2007-12-05 00:00:00', 'here', 'N');
INSERT INTO `guardfinance` VALUES (40, '47890', 'Deduction', '2007-08-12 00:00:00', 'How do you find these', 'Y');

-- --------------------------------------------------------

-- 
-- Table structure for table `guardfinancestatus`
-- 

DROP TABLE IF EXISTS `guardfinancestatus`;
CREATE TABLE `guardfinancestatus` (
  `id` bigint(20) NOT NULL auto_increment,
  `guardid` varchar(250) NOT NULL default '',
  `amount` varchar(250) NOT NULL default '',
  `type` varchar(250) NOT NULL default '',
  `enteredby` varchar(250) NOT NULL default '',
  `reason` text NOT NULL,
  `date_of_entry` datetime NOT NULL default '0000-00-00 00:00:00',
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- 
-- Dumping data for table `guardfinancestatus`
-- 


-- --------------------------------------------------------

-- 
-- Table structure for table `guardresponseforms`
-- 

DROP TABLE IF EXISTS `guardresponseforms`;
CREATE TABLE `guardresponseforms` (
  `id` bigint(20) NOT NULL auto_increment,
  `assignment` varchar(255) NOT NULL default '',
  `guard` varchar(255) NOT NULL default '',
  `commander` varchar(255) NOT NULL default '',
  `mobile` varchar(255) NOT NULL default '',
  `datecreated` date NOT NULL default '0000-00-00',
  `location` varchar(255) NOT NULL default '',
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=44 ;

-- 
-- Dumping data for table `guardresponseforms`
-- 

INSERT INTO `guardresponseforms` VALUES (20, '', '435', '', '33333', '2007-11-25', '');
INSERT INTO `guardresponseforms` VALUES (21, 'Kamugisha', 'kamus', 'kamus', '4551', '2007-11-02', '');
INSERT INTO `guardresponseforms` VALUES (22, 'kk', 'kk', 'kk', '4341', '2007-11-02', '');
INSERT INTO `guardresponseforms` VALUES (23, '', 'Y907,', '', '5525', '2007-12-07', '');
INSERT INTO `guardresponseforms` VALUES (24, 'se', '', '', '', '2007-11-19', '');
INSERT INTO `guardresponseforms` VALUES (25, '', '', '', '', '2007-11-19', '');
INSERT INTO `guardresponseforms` VALUES (26, '', '', '', '', '2007-11-20', '');
INSERT INTO `guardresponseforms` VALUES (27, '', '', '', '', '2007-11-20', '');
INSERT INTO `guardresponseforms` VALUES (33, '', '', '', 'Array', '2007-11-20', '');
INSERT INTO `guardresponseforms` VALUES (34, '', '', '', 'Array', '2007-11-21', '');
INSERT INTO `guardresponseforms` VALUES (35, '', '', '', '', '2007-11-21', '');
INSERT INTO `guardresponseforms` VALUES (36, '', '', '', '', '2007-11-21', '');
INSERT INTO `guardresponseforms` VALUES (40, '', 'Y907,P0081', '', '', '2007-11-21', '');
INSERT INTO `guardresponseforms` VALUES (41, '', 'P0081,435', '8', '6,3', '2007-11-26', '');
INSERT INTO `guardresponseforms` VALUES (42, '', '', '', '', '2007-11-26', '');
INSERT INTO `guardresponseforms` VALUES (43, '', '', '', '', '2007-11-27', '');

-- --------------------------------------------------------

-- 
-- Table structure for table `guards`
-- 

DROP TABLE IF EXISTS `guards`;
CREATE TABLE `guards` (
  `id` bigint(20) NOT NULL auto_increment,
  `guardid` varchar(255) default NULL,
  `photoname` varchar(100) default NULL,
  `personid` bigint(20) NOT NULL default '0',
  `fingerprintname` varchar(250) default NULL,
  `dateofemployment` date default NULL,
  `dateofexpiry` datetime NOT NULL default '0000-00-00 00:00:00',
  `fatherid` bigint(20) default NULL,
  `motherid` bigint(20) default NULL,
  `spouseid` bigint(20) default NULL,
  `nextofkinid` bigint(20) default NULL,
  `childrenids` varchar(250) NOT NULL default '',
  `primaryschids` varchar(250) NOT NULL default '',
  `secondaryschids` varchar(250) NOT NULL default '',
  `qualschids` varchar(250) NOT NULL default '',
  `experienceids` varchar(250) NOT NULL default '',
  `employerids` varchar(250) NOT NULL default '',
  `refereeids` varchar(250) NOT NULL default '',
  `landlordid` bigint(20) NOT NULL default '0',
  `lc1letterprovided` enum('Y','N') NOT NULL default 'N',
  `isarchived` enum('Y','N') NOT NULL default 'N',
  `status` varchar(250) NOT NULL default '',
  `rate` varchar(250) NOT NULL default '',
  `nssfno` text NOT NULL,
  `tinno` text NOT NULL,
  `financialstatus` text NOT NULL,
  `leavedays` text NOT NULL,
  `lastpaymentdate` varchar(250) NOT NULL default '',
  `datecreated` date default NULL,
  `createdby` bigint(20) default NULL,
  `lastupdatedby` bigint(20) default NULL,
  `lastupdatedate` timestamp NULL default NULL on update CURRENT_TIMESTAMP,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='InnoDB free: 4096 kB; InnoDB free: 3072 kB; InnoDB free: 307' AUTO_INCREMENT=32 ;

-- 
-- Dumping data for table `guards`
-- 

INSERT INTO `guards` VALUES (1, 'P0081', 'photos/1194849828guardpic_1.jpg', 6, 'fingerprints/1194849672images.jpg', '2005-03-11', '0000-00-00 00:00:00', 0, 0, 0, 0, '', '', '', '', '', '', '86', 87, 'N', 'Y', '', '1200', 'R789274', 'T808-23423-234', '32,33,31,27,24,19,21,23', '30', '2007-12-01 10:00:00', '2007-10-14', 1, 1, '2008-01-04 21:51:34');
INSERT INTO `guards` VALUES (24, 'D109', 'photos/1194617281DSC01929.JPG', 0, '', '1982-02-28', '0000-00-00 00:00:00', 0, 0, 0, 0, '0,0,0,71', '0,0', '0,71', '0,72', ',', ',53', '0,0', 0, 'Y', 'N', '', '3000', '', '', '', '30', '2007-12-01 10:00:00', '2007-10-29', 1, 1, '2008-01-04 19:29:36');
INSERT INTO `guards` VALUES (26, 'D803', 'photos/1194619087Blue_hills.jpg', 0, '', '1963-07-05', '0000-00-00 00:00:00', 0, 0, 0, 0, '0,0', '', '', '', '', '', '0', 0, 'N', 'N', '', '3000', '', '', '', '30', '2007-12-01 10:00:00', '2007-11-09', 1, 1, '2008-01-04 19:32:41');
INSERT INTO `guards` VALUES (27, 'F554', 'photos/119947264642-16310901.jpg', 135, 'fingerprints/1199472646images8.jpg', '2008-02-02', '0000-00-00 00:00:00', 0, 0, 146, 147, '74,75,76,77,81', '73,74,79', '75,76', '77,78', '26,17', '85,86', '84,89', 85, '', 'N', '7', '500', 'T890833', 'T808-23993-234', '37,3,34,36', '30', '2007-05-03', '2007-11-09', 1, 1, '2008-01-04 21:50:46');
INSERT INTO `guards` VALUES (28, 'Y907', 'photos/1195061299DSC01929.JPG', 148, 'fingerprints/1195061299images.jpg', '1999-07-03', '0000-00-00 00:00:00', 149, 150, 151, 152, '78,79,80', '80,81', '82,83,84', '85,86', '27', '87,88', '90,91', 92, 'Y', 'Y', '1', '3000', 'T809243', 'T779-3245-234', '', '30', '2007-10-06', '2007-11-14', 1, 1, '2008-01-04 21:51:34');
INSERT INTO `guards` VALUES (29, 'H013', 'photos/1196178109Water_lilies.jpg', 153, '', '2007-04-03', '0000-00-00 00:00:00', 0, 0, 0, 0, '', '', '', '', '', '90', '95', 96, 'N', 'N', '8', '2000', 'R792344', 'T090-8934-234', '', '30', '2007-12-01 10:00:00', '2007-11-27', 1, 1, '2008-01-05 09:43:57');
INSERT INTO `guards` VALUES (30, 'H117', 'photos/1196269506Winter.jpg', 154, '', '2006-04-16', '2008-03-18 00:00:00', 0, 0, 0, 0, '', '', '', '', '', '91', '97', 98, 'N', 'N', '5', '2500', 'R523252', 'T908-23423-204', '39,40,38,36,34', '30', '2007-12-01 10:00:00', '2007-11-27', 1, 1, '2008-01-04 20:51:29');
INSERT INTO `guards` VALUES (31, 'T023', 'photos/119947075442-16673255.jpg', 155, 'fingerprints/1199470754images7.jpg', '2005-03-03', '0000-00-00 00:00:00', 0, 0, 0, 0, '', '', '', '', '', '92', '99', 100, '', 'N', '', '200', 'R624324', 'R890-8923-890', '', '30', '2007-12-01 10:00:00', '2007-11-27', 1, 1, '2008-01-04 21:19:14');

-- --------------------------------------------------------

-- 
-- Table structure for table `guardstatus`
-- 

DROP TABLE IF EXISTS `guardstatus`;
CREATE TABLE `guardstatus` (
  `id` bigint(20) NOT NULL auto_increment,
  `status` varchar(250) NOT NULL default '',
  `date_of_entry` datetime NOT NULL default '0000-00-00 00:00:00',
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

-- 
-- Dumping data for table `guardstatus`
-- 

INSERT INTO `guardstatus` VALUES (1, 'Sick', '2007-11-28 21:02:12');
INSERT INTO `guardstatus` VALUES (2, 'Dismissed', '2007-11-28 21:04:21');
INSERT INTO `guardstatus` VALUES (3, 'Active', '2007-11-27 21:04:41');
INSERT INTO `guardstatus` VALUES (4, 'Inactive', '2007-11-27 21:04:46');
INSERT INTO `guardstatus` VALUES (5, 'Absconded', '2007-11-28 00:00:00');
INSERT INTO `guardstatus` VALUES (7, 'Busy', '2008-01-07 10:00:44');

-- --------------------------------------------------------

-- 
-- Table structure for table `guardstatustrack`
-- 

DROP TABLE IF EXISTS `guardstatustrack`;
CREATE TABLE `guardstatustrack` (
  `id` bigint(20) NOT NULL auto_increment,
  `guard` varchar(100) NOT NULL default '',
  `status` varchar(250) NOT NULL default '',
  `illness` varchar(250) NOT NULL default '',
  `notes` text NOT NULL,
  `date_started` datetime NOT NULL default '0000-00-00 00:00:00',
  `date_ended` datetime NOT NULL default '0000-00-00 00:00:00',
  `reported_by` varchar(250) NOT NULL default '',
  `date_of_entry` datetime NOT NULL default '0000-00-00 00:00:00',
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

-- 
-- Dumping data for table `guardstatustrack`
-- 

INSERT INTO `guardstatustrack` VALUES (1, 'Y907', 'Sick', 'Malaria', 'High blood pressure in the lungs.', '2008-01-02 00:00:00', '2008-02-17 00:00:00', '', '2008-01-04 16:43:12');
INSERT INTO `guardstatustrack` VALUES (2, 'F554', 'Sick', 'Malaria', 'He has the bad feaver that is going to be a budden', '2008-01-13 00:00:00', '0000-00-00 00:00:00', '', '2008-01-04 19:35:03');
INSERT INTO `guardstatustrack` VALUES (3, 'F554', 'Sick', 'Malaria', 'He has the bad feaver that is going to be a budden', '2008-01-13 00:00:00', '2008-02-19 00:00:00', '', '2008-01-04 20:04:46');
INSERT INTO `guardstatustrack` VALUES (4, 'F554', 'Sick', 'Malaria', 'He has the bad feaver that is going to be a budden', '2008-01-13 00:00:00', '2008-02-19 00:00:00', 'P0081', '2008-01-04 20:17:12');
INSERT INTO `guardstatustrack` VALUES (5, 'H117', 'Dismissed', '', 'He beat up the neighbour''s dog again after 3 warnings', '2008-01-01 00:00:00', '0000-00-00 00:00:00', 'H117', '2008-01-04 20:51:29');
INSERT INTO `guardstatustrack` VALUES (6, 'H013', 'Sick', 'Headache', 'THen they dont want to talk to him because he can not take a no for an answer.', '1996-04-17 00:00:00', '0000-00-00 00:00:00', 'P0081', '2008-01-04 21:15:48');
INSERT INTO `guardstatustrack` VALUES (7, 'F554', 'Active', '', 'He left here and went home but he is now fine.', '2008-01-02 00:00:00', '0000-00-00 00:00:00', 'H013', '2008-01-04 21:49:59');
INSERT INTO `guardstatustrack` VALUES (8, 'H013', 'Active', '', 'He is ok', '2008-01-03 00:00:00', '0000-00-00 00:00:00', 'H013', '2008-01-05 09:43:57');

-- --------------------------------------------------------

-- 
-- Table structure for table `illness`
-- 

DROP TABLE IF EXISTS `illness`;
CREATE TABLE `illness` (
  `id` bigint(20) NOT NULL auto_increment,
  `name` varchar(255) NOT NULL default '',
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

-- 
-- Dumping data for table `illness`
-- 

INSERT INTO `illness` VALUES (1, 'Headache');
INSERT INTO `illness` VALUES (2, 'Malaria');
INSERT INTO `illness` VALUES (3, 'cesaer');
INSERT INTO `illness` VALUES (4, 'Yellow Fever');
INSERT INTO `illness` VALUES (5, 'Henry Ngobi');
INSERT INTO `illness` VALUES (6, 'Chest Pain');
INSERT INTO `illness` VALUES (7, 'Kimetometo');

-- --------------------------------------------------------

-- 
-- Table structure for table `incidentaction`
-- 

DROP TABLE IF EXISTS `incidentaction`;
CREATE TABLE `incidentaction` (
  `id` bigint(20) NOT NULL auto_increment,
  `incident` varchar(255) default NULL,
  `date_of_action` date default NULL,
  `actiontaken` varchar(255) default NULL,
  `createdby` bigint(20) default NULL,
  `datecreated` date default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

-- 
-- Dumping data for table `incidentaction`
-- 

INSERT INTO `incidentaction` VALUES (1, 'H34-d', '2005-03-03', 'escalated to commander james', 1, '2007-12-03');
INSERT INTO `incidentaction` VALUES (2, '11', '2007-06-04', 'incident worked on', 1, '2007-12-03');

-- --------------------------------------------------------

-- 
-- Table structure for table `incidentactions`
-- 

DROP TABLE IF EXISTS `incidentactions`;
CREATE TABLE `incidentactions` (
  `id` bigint(20) NOT NULL auto_increment,
  `details` text NOT NULL,
  `date_of_entry` datetime NOT NULL default '0000-00-00 00:00:00',
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=23 ;

-- 
-- Dumping data for table `incidentactions`
-- 

INSERT INTO `incidentactions` VALUES (1, 'The guard was repremanded and strongly warned.', '2007-12-06 19:53:27');
INSERT INTO `incidentactions` VALUES (2, 'All guards on duty that day were sacked.', '2007-12-07 10:22:28');
INSERT INTO `incidentactions` VALUES (3, 'THere were bullies every were. So we requested cabinent intervention.', '2007-12-07 10:26:54');
INSERT INTO `incidentactions` VALUES (4, 'THere were bullies every were. So we requested cabinent intervention.', '2007-12-07 10:42:59');
INSERT INTO `incidentactions` VALUES (5, 'I personnally apointed the guard my second in command.', '2007-12-07 10:43:29');
INSERT INTO `incidentactions` VALUES (6, 'We beat the bullies to death and saved the snake', '2007-12-07 10:43:51');
INSERT INTO `incidentactions` VALUES (7, 'I nolonger deal with small fish when talking about security.', '2007-12-07 10:53:44');
INSERT INTO `incidentactions` VALUES (8, 'He bought the money and never sent it away.', '2007-12-07 10:54:26');
INSERT INTO `incidentactions` VALUES (9, 'I came, I saw I conquered.', '2007-12-07 11:05:55');
INSERT INTO `incidentactions` VALUES (10, 'I never thought of Opio as a coward', '2007-12-07 11:06:15');
INSERT INTO `incidentactions` VALUES (11, 'I beat the old guy to his senses.', '2007-12-07 11:06:33');
INSERT INTO `incidentactions` VALUES (12, 'I like the old man but he just hates guards.', '2007-12-07 11:13:31');
INSERT INTO `incidentactions` VALUES (13, 'The man was rewarded for his loyalty.', '2007-12-07 11:14:07');
INSERT INTO `incidentactions` VALUES (14, 'The man was rewarded for his loyalty.', '2007-12-07 11:14:52');
INSERT INTO `incidentactions` VALUES (15, 'The man was built a new house at Kamwokya.', '2007-12-07 11:16:56');
INSERT INTO `incidentactions` VALUES (16, 'The dog ate his cat', '2007-12-07 11:24:16');
INSERT INTO `incidentactions` VALUES (17, 'He then beat his master', '2007-12-07 11:24:49');
INSERT INTO `incidentactions` VALUES (18, 'and then smiled at his wife!!!', '2007-12-07 11:25:21');
INSERT INTO `incidentactions` VALUES (19, 'The boy then beat the dog till it was lame', '2007-12-07 11:26:30');
INSERT INTO `incidentactions` VALUES (20, 'I then came in to intervene', '2007-12-07 11:27:12');
INSERT INTO `incidentactions` VALUES (21, 'I also called the police to intervene', '2007-12-07 11:28:53');
INSERT INTO `incidentactions` VALUES (22, 'I also noted the difference in time of arrival.', '2007-12-07 11:29:27');

-- --------------------------------------------------------

-- 
-- Table structure for table `incidents`
-- 

DROP TABLE IF EXISTS `incidents`;
CREATE TABLE `incidents` (
  `id` bigint(20) NOT NULL auto_increment,
  `refno` varchar(250) NOT NULL default '',
  `assignment` varchar(250) NOT NULL default '',
  `date` datetime NOT NULL default '0000-00-00 00:00:00',
  `guardresponsible` varchar(250) NOT NULL default '',
  `details` text NOT NULL,
  `reportedby` varchar(250) NOT NULL default '',
  `timereported` varchar(250) NOT NULL default '',
  `checkedby` varchar(250) NOT NULL default '',
  `timechecked` varchar(250) NOT NULL default '',
  `actiontaken` text NOT NULL,
  `date_of_entry` datetime NOT NULL default '0000-00-00 00:00:00',
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

-- 
-- Dumping data for table `incidents`
-- 

INSERT INTO `incidents` VALUES (1, '1196967076', 'D145-N', '2007-12-06 00:00:00', 'H013', 'There was a bang on the door before the guard escaped with a big bag of coins', 'F554', '07:00:00', 'P0081', '08:00:00', '16,20,21', '2007-12-06 17:32:10');
INSERT INTO `incidents` VALUES (2, '1196949576', 'H230-D', '2007-12-16 00:00:00', 'H013', 'The dog was bitten by the guard.', 'F554', '05:30:00', 'P0081', '06:00:00', '4,5,6,7,8,22', '2007-12-06 19:53:28');

-- --------------------------------------------------------

-- 
-- Table structure for table `itemissue`
-- 

DROP TABLE IF EXISTS `itemissue`;
CREATE TABLE `itemissue` (
  `id` bigint(20) NOT NULL auto_increment,
  `type` text NOT NULL,
  `serialno` text NOT NULL,
  `inventoryofficer` varchar(250) NOT NULL default '',
  `date` datetime NOT NULL default '0000-00-00 00:00:00',
  `guardresponsible` varchar(250) NOT NULL default '',
  `assignment` varchar(250) NOT NULL default '',
  `status` text NOT NULL,
  `issuecondition` text NOT NULL,
  `lastupdatedate` datetime NOT NULL default '0000-00-00 00:00:00',
  `lastupdatedby` varchar(250) NOT NULL default '',
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=13 ;

-- 
-- Dumping data for table `itemissue`
-- 

INSERT INTO `itemissue` VALUES (8, 'return', '123123', '1', '2007-12-02 00:00:00', 'Y907', 'H230-D', 'Old - Usable', 'The car is old and usable. Can you believe that!', '2007-12-04 17:12:20', '1');
INSERT INTO `itemissue` VALUES (10, 'issue', 'UAB 875H', '1', '2007-12-07 00:00:00', 'Y907', 'B666-H', 'Old - Not Usable', 'It has just been flown in from Saudi Arabia yesterday', '2007-12-04 17:06:31', '1');
INSERT INTO `itemissue` VALUES (11, 'issue', '523413123', '1', '2007-12-02 00:00:00', 'H013', 'H300-N', 'New', 'It has just been flown in from Saudi Arabia again', '2007-12-04 17:05:55', '1');
INSERT INTO `itemissue` VALUES (12, 'issue', '6245235', '1', '2007-12-05 00:00:00', 'H013', 'H312-H', 'New - Damaged', 'The handle is broken but can still be used', '0000-00-00 00:00:00', '');

-- --------------------------------------------------------

-- 
-- Table structure for table `jobs`
-- 

DROP TABLE IF EXISTS `jobs`;
CREATE TABLE `jobs` (
  `id` bigint(20) NOT NULL auto_increment,
  `guardid` varchar(255) default NULL,
  `address` varchar(255) default NULL,
  `type` enum('Other','Army','Police','Prisons') default 'Other',
  `datejoined` date default NULL,
  `dateleft` date default NULL,
  `createdby` bigint(20) default NULL,
  `datecreated` date default NULL,
  `lastupdatedby` bigint(20) default NULL,
  `lastupdatedate` timestamp NULL default NULL on update CURRENT_TIMESTAMP,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='InnoDB free: 4096 kB; InnoDB free: 4096 kB; InnoDB free: 409' AUTO_INCREMENT=1 ;

-- 
-- Dumping data for table `jobs`
-- 


-- --------------------------------------------------------

-- 
-- Table structure for table `leaveapplications`
-- 

DROP TABLE IF EXISTS `leaveapplications`;
CREATE TABLE `leaveapplications` (
  `id` bigint(20) NOT NULL auto_increment,
  `guardid` varchar(200) default '0',
  `leavestartdate` datetime default NULL,
  `leaveenddate` datetime default NULL,
  `leavetype` varchar(255) default NULL,
  `reason` varchar(255) default NULL,
  `payrollclerkapproved` enum('N','Y') default NULL,
  `operationsapproved` enum('N','Y') default NULL,
  `humanresourceapproved` enum('N','Y') default NULL,
  `dateoffinanceapproval` datetime default NULL,
  `dateofhrapproval` datetime default NULL,
  `dateofoperationsapproval` datetime NOT NULL default '0000-00-00 00:00:00',
  `financeapprovalmsg` text NOT NULL,
  `hrapprovalmsg` text NOT NULL,
  `operationsapprovalmsg` text NOT NULL,
  `whofinanceapproved` varchar(100) NOT NULL default '',
  `whohrapproved` varchar(100) NOT NULL default '',
  `whooperationapproved` varchar(100) NOT NULL default '',
  `advancetaken` bigint(20) default NULL,
  `travelallowances` bigint(20) default NULL,
  `loantaken` bigint(20) default NULL,
  `uniformreturned` enum('N','Y') default NULL,
  `dateuniformreturned` date default NULL,
  `status` varchar(50) NOT NULL default '',
  `datecreated` date default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=39 ;

-- 
-- Dumping data for table `leaveapplications`
-- 

INSERT INTO `leaveapplications` VALUES (23, 'F554', '2007-01-02 00:00:00', '2007-05-12 00:00:00', 'Paternity Leave', 'To give birth', 'N', 'N', 'N', '2009-01-10 00:00:00', '2007-12-10 00:00:00', '0000-00-00 00:00:00', '', '', '', '', '', '', 0, 0, 0, 'N', '2007-12-10', 'Pending', '0000-00-00');
INSERT INTO `leaveapplications` VALUES (34, 'H013', '2008-03-02 00:00:00', '2008-05-30 00:00:00', 'Unpaid', 'To give birth', 'Y', 'Y', 'Y', '2008-04-10 00:00:00', '2008-04-10 00:00:00', '0000-00-00 00:00:00', '', '', '', '', '', '', 5000, 2000, 20000, 'Y', '2008-04-10', 'Pending', '2007-10-16');
INSERT INTO `leaveapplications` VALUES (35, 'Y907', '2007-01-02 00:00:00', '2007-12-15 00:00:00', 'Maternity Leave', 'To give birth', 'Y', 'N', 'Y', '2009-02-10 00:00:00', '2008-11-10 00:00:00', '0000-00-00 00:00:00', '', '', '', '', '', '', 0, 0, 0, 'N', '2007-01-10', 'Pending', '0000-00-00');
INSERT INTO `leaveapplications` VALUES (36, 'P0081', '2007-11-14 00:00:00', '2007-11-16 00:00:00', 'Maternity Leave', 'I wanted to go now', 'N', 'Y', 'Y', '0000-00-00 00:00:00', '2007-12-13 23:28:21', '0000-00-00 00:00:00', 'I want to say he has done well.', 'I let this guy go', 'I think he has worked hard. Let him go.', '', '', '', 23900, 125000, 125000, 'Y', NULL, '', '2007-12-13');
INSERT INTO `leaveapplications` VALUES (37, 'Y907', '2007-01-15 00:00:00', '2007-12-16 00:00:00', 'Pass Leave', 'There are no men going to be got here', 'N', 'N', 'N', NULL, NULL, '0000-00-00 00:00:00', '', '', '', '', '', '', NULL, NULL, NULL, 'N', NULL, '', '2007-12-13');
INSERT INTO `leaveapplications` VALUES (38, 'H013', '2008-01-16 00:00:00', '2008-03-15 00:00:00', 'Annual', 'The guard has to go for annual leave.', NULL, 'Y', 'Y', NULL, '2008-01-05 18:23:02', '2008-01-05 19:02:10', '', 'There are guys who wouldnt like him to go but I want him to go.', 'I wanted to give him but he is too proud. He is ok now.', '', '', '1', NULL, NULL, NULL, 'Y', NULL, '', '2008-01-05');

-- --------------------------------------------------------

-- 
-- Table structure for table `leaveapprovals`
-- 

DROP TABLE IF EXISTS `leaveapprovals`;
CREATE TABLE `leaveapprovals` (
  `id` bigint(20) NOT NULL auto_increment,
  `approveapplication` enum('N','Y') NOT NULL default 'N',
  `rejectapplication` enum('N','Y') NOT NULL default 'N',
  `approvalmessage` varchar(255) default NULL,
  `rejectionmessage` varchar(255) default NULL,
  `approvedby` varchar(50) default NULL,
  `rejectedby` varchar(50) default NULL,
  `dateapproved` date default NULL,
  `daterejected` date default NULL,
  `datecreated` date default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

-- 
-- Dumping data for table `leaveapprovals`
-- 

INSERT INTO `leaveapprovals` VALUES (1, 'N', 'N', 'has been approved', 'has been rejected', 'hr manager', 'hr manager', '2007-10-11', '2007-10-11', NULL);

-- --------------------------------------------------------

-- 
-- Table structure for table `leavetypes`
-- 

DROP TABLE IF EXISTS `leavetypes`;
CREATE TABLE `leavetypes` (
  `id` bigint(20) NOT NULL auto_increment,
  `leavetype` varchar(200) NOT NULL default '',
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

-- 
-- Dumping data for table `leavetypes`
-- 

INSERT INTO `leavetypes` VALUES (1, 'Annual');
INSERT INTO `leavetypes` VALUES (2, 'Unpaid');
INSERT INTO `leavetypes` VALUES (3, 'Pass Leave');
INSERT INTO `leavetypes` VALUES (4, 'Maternity Leave');
INSERT INTO `leavetypes` VALUES (5, 'Paternity Leave');

-- --------------------------------------------------------

-- 
-- Table structure for table `location`
-- 

DROP TABLE IF EXISTS `location`;
CREATE TABLE `location` (
  `id` bigint(20) NOT NULL auto_increment,
  `name` varchar(255) NOT NULL default '',
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=31 ;

-- 
-- Dumping data for table `location`
-- 

INSERT INTO `location` VALUES (8, 'Jinja');
INSERT INTO `location` VALUES (9, 'Mbra');
INSERT INTO `location` VALUES (10, 'kk');
INSERT INTO `location` VALUES (11, 'jja');
INSERT INTO `location` VALUES (12, '');
INSERT INTO `location` VALUES (13, '');
INSERT INTO `location` VALUES (14, '');
INSERT INTO `location` VALUES (15, '');
INSERT INTO `location` VALUES (16, '');
INSERT INTO `location` VALUES (17, '');
INSERT INTO `location` VALUES (18, '');
INSERT INTO `location` VALUES (19, '');
INSERT INTO `location` VALUES (20, '');
INSERT INTO `location` VALUES (21, 'Array');
INSERT INTO `location` VALUES (22, 'Array');
INSERT INTO `location` VALUES (23, '');
INSERT INTO `location` VALUES (24, '');
INSERT INTO `location` VALUES (25, 'Array');
INSERT INTO `location` VALUES (26, 'Array');
INSERT INTO `location` VALUES (27, 'Array');
INSERT INTO `location` VALUES (28, '');
INSERT INTO `location` VALUES (29, '');
INSERT INTO `location` VALUES (30, '');

-- --------------------------------------------------------

-- 
-- Table structure for table `messages`
-- 

DROP TABLE IF EXISTS `messages`;
CREATE TABLE `messages` (
  `id` bigint(20) NOT NULL auto_increment,
  `reason` varchar(200) NOT NULL default '',
  `details` text NOT NULL,
  `sentby` varchar(250) NOT NULL default '',
  `sentto` varchar(250) NOT NULL default '',
  `date` datetime NOT NULL default '0000-00-00 00:00:00',
  `isactive` enum('Y','N') NOT NULL default 'Y',
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

-- 
-- Dumping data for table `messages`
-- 

INSERT INTO `messages` VALUES (1, 'New Finance Report', 'There are no things to say.', '1', '', '2007-12-12 22:44:13', 'N');
INSERT INTO `messages` VALUES (2, 'New Finance Report', 'There are no things to say.', '1', '', '2007-12-12 22:45:23', 'N');
INSERT INTO `messages` VALUES (3, 'New People Report', 'I want to be able to send guards SMS. Can you please add that? BECAUSE I feel it is the right thing to do nowadays as there is ultimate security to cater for and the rest of the people to think of. Cant you see my dilema?', '1', '', '2007-12-13 10:22:28', 'Y');
INSERT INTO `messages` VALUES (4, 'PAYE Details Change', 'I want to be able to edit these things too. Dont you think so?', '1', '', '2007-12-13 11:24:49', 'Y');
INSERT INTO `messages` VALUES (5, 'APPROVE LEAVE', '<a href="../hr/manageleave.php?a=search&leaveid=38">View Leave Applications</a>', '1', '', '2008-01-05 18:00:41', 'Y');
INSERT INTO `messages` VALUES (6, 'APPROVE LEAVE', '<a href="../hr/manageleave.php?a=search&leaveid=39">Leave Application</a>', '1', '', '2008-01-06 10:52:46', 'Y');

-- --------------------------------------------------------

-- 
-- Table structure for table `mobile`
-- 

DROP TABLE IF EXISTS `mobile`;
CREATE TABLE `mobile` (
  `id` bigint(20) NOT NULL auto_increment,
  `number` bigint(20) NOT NULL default '0',
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=29 ;

-- 
-- Dumping data for table `mobile`
-- 

INSERT INTO `mobile` VALUES (3, 4341);
INSERT INTO `mobile` VALUES (4, 5525);
INSERT INTO `mobile` VALUES (5, 4551);
INSERT INTO `mobile` VALUES (6, 33333);
INSERT INTO `mobile` VALUES (7, 0);
INSERT INTO `mobile` VALUES (8, 0);
INSERT INTO `mobile` VALUES (9, 0);
INSERT INTO `mobile` VALUES (10, 0);
INSERT INTO `mobile` VALUES (11, 0);
INSERT INTO `mobile` VALUES (12, 0);
INSERT INTO `mobile` VALUES (13, 0);
INSERT INTO `mobile` VALUES (14, 0);
INSERT INTO `mobile` VALUES (15, 0);
INSERT INTO `mobile` VALUES (16, 0);
INSERT INTO `mobile` VALUES (17, 0);
INSERT INTO `mobile` VALUES (18, 0);
INSERT INTO `mobile` VALUES (19, 0);
INSERT INTO `mobile` VALUES (20, 0);
INSERT INTO `mobile` VALUES (21, 0);
INSERT INTO `mobile` VALUES (22, 0);
INSERT INTO `mobile` VALUES (23, 0);
INSERT INTO `mobile` VALUES (24, 6);
INSERT INTO `mobile` VALUES (25, 6);
INSERT INTO `mobile` VALUES (26, 6);
INSERT INTO `mobile` VALUES (27, 0);
INSERT INTO `mobile` VALUES (28, 0);

-- --------------------------------------------------------

-- 
-- Table structure for table `payeranges`
-- 

DROP TABLE IF EXISTS `payeranges`;
CREATE TABLE `payeranges` (
  `id` bigint(20) NOT NULL auto_increment,
  `fixedtax` varchar(200) NOT NULL default '',
  `lowerlevel` varchar(200) NOT NULL default '',
  `upperlevel` varchar(200) NOT NULL default '',
  `percentagetax` varchar(200) NOT NULL default '',
  `type` varchar(200) NOT NULL default 'local',
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

-- 
-- Dumping data for table `payeranges`
-- 

INSERT INTO `payeranges` VALUES (1, '0', '0', '130000', '0', 'local');
INSERT INTO `payeranges` VALUES (2, '0', '130000', '235000', '10', 'local');
INSERT INTO `payeranges` VALUES (3, '10500', '235000', '410000', '20', 'local');
INSERT INTO `payeranges` VALUES (4, '45500', '410000', '', '30', 'local');
INSERT INTO `payeranges` VALUES (5, '0', '0', '235000', '10', 'foreign');
INSERT INTO `payeranges` VALUES (6, '23500', '235000', '410000', '20', 'foreign');
INSERT INTO `payeranges` VALUES (7, '58500', '410000', '', '30', 'foreign');

-- --------------------------------------------------------

-- 
-- Table structure for table `personnel`
-- 

DROP TABLE IF EXISTS `personnel`;
CREATE TABLE `personnel` (
  `id` bigint(20) NOT NULL auto_increment,
  `guard` varchar(255) NOT NULL default '',
  `type` varchar(255) NOT NULL default '',
  `notes` varchar(255) NOT NULL default '',
  `actiontaken` varchar(255) NOT NULL default '',
  `takenby` varchar(100) NOT NULL default '',
  `date` datetime NOT NULL default '0000-00-00 00:00:00',
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=25 ;

-- 
-- Dumping data for table `personnel`
-- 

INSERT INTO `personnel` VALUES (2, 'F554', 'Indiscipline', 'The Funny place', 'Transfer', '', '2008-01-15 00:00:00');
INSERT INTO `personnel` VALUES (3, 'Y907', 'Indiscipline', 'The man is got to be the one who stole the things.', 'Transfer', '', '1996-01-26 00:00:00');
INSERT INTO `personnel` VALUES (5, 'Y907', 'Discipline', 'The caring and loving. Disaster		', 'Transfer', '', '0000-00-00 00:00:00');
INSERT INTO `personnel` VALUES (6, 'H013', 'Discipline', 'She is good', 'Transfer', 'Natume Deborah', '1995-01-14 00:00:00');
INSERT INTO `personnel` VALUES (7, 'kalenzi sm', 'Discipline', '	ttttt					', 'Transfer', '', '0000-00-00 00:00:00');
INSERT INTO `personnel` VALUES (8, 'Y907', 'Discipline', 'Very Poor Behaviours', 'Police Custody', 'Garry Johns', '0000-00-00 00:00:00');
INSERT INTO `personnel` VALUES (12, 'Namanve', 'Discipline', 'Good', 'Suspension', '', '0000-00-00 00:00:00');
INSERT INTO `personnel` VALUES (21, 'DJ Sam Rivaldo', 'Discipline', 'Trying', 'Transfer', '', '0000-00-00 00:00:00');
INSERT INTO `personnel` VALUES (23, 'Kangu Sam', 'Indiscipline', 'Dealer', 'Police Custody', '', '0000-00-00 00:00:00');
INSERT INTO `personnel` VALUES (24, 'P0081', 'Discipline', 'He escaped and caught a guard', 'Transfer', 'Daniel Kiwanuka', '2008-01-01 00:00:00');

-- --------------------------------------------------------

-- 
-- Table structure for table `personnelfiles`
-- 

DROP TABLE IF EXISTS `personnelfiles`;
CREATE TABLE `personnelfiles` (
  `id` bigint(20) NOT NULL auto_increment,
  `guardid` varchar(255) default NULL,
  `year` bigint(20) default NULL,
  `dateofemployment` date default NULL,
  `generaldiscipline` varchar(255) default NULL,
  `appraisalbonus` varchar(255) default NULL,
  `datecreated` date default NULL,
  `lastupdatedate` timestamp NULL default NULL on update CURRENT_TIMESTAMP,
  `transfer` varchar(255) default NULL,
  `promotion` varchar(255) default NULL,
  `noofwarningletters` varchar(255) default NULL,
  `noofsuspensionletters` varchar(255) default NULL,
  `policecustody` enum('N','Y') default NULL,
  `endofeploymentstatus` varchar(255) default NULL,
  `personalfileid` bigint(20) default NULL,
  `documentname` varchar(255) default NULL,
  `issued` enum('N','Y') default NULL,
  `dateissued` date default NULL,
  `firstrenewal` date default NULL,
  `secondrenewal` date default NULL,
  `thirdrenewal` date default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

-- 
-- Dumping data for table `personnelfiles`
-- 

INSERT INTO `personnelfiles` VALUES (1, '79', 2007, '2007-10-23', 'good', 'dshdhjhj', '2007-10-23', '2007-10-23 19:11:18', 'ddcs', 'dsdcfcd', '1', '2', 'N', NULL, NULL, 'id photocopy', 'Y', '2007-10-23', '2007-10-23', '2007-10-23', '2007-10-23');
INSERT INTO `personnelfiles` VALUES (3, '64', 2007, '2007-04-23', 'fair', 'uhhh', NULL, '2007-10-23 20:00:29', 'uhuuuu', 'gdgwgd', '1', '3', 'N', NULL, NULL, 'ID photocopy', 'Y', '2007-02-15', '2007-06-09', '2007-10-10', NULL);
INSERT INTO `personnelfiles` VALUES (4, '80', 2007, '2007-02-15', 'very goog', 'hjhdh', '2007-10-23', '2007-10-23 20:10:35', 'dhuhyuhu', 'hjhjdhfh', '1', '1', 'Y', 'pending', 0, 'ID photocopy', 'Y', '2007-04-15', '2007-05-13', NULL, NULL);

-- --------------------------------------------------------

-- 
-- Table structure for table `persons`
-- 

DROP TABLE IF EXISTS `persons`;
CREATE TABLE `persons` (
  `id` bigint(20) NOT NULL auto_increment,
  `firstname` varchar(255) default NULL,
  `lastname` varchar(255) default NULL,
  `othernames` varchar(255) default NULL,
  `birthlastname` varchar(255) default NULL,
  `nationality` varchar(255) default NULL,
  `tribe` varchar(255) default NULL,
  `dateofbirth` date default NULL,
  `birthplaceid` bigint(20) default NULL,
  `isalive` enum('N','Y') default 'Y',
  `occupation` varchar(255) default NULL,
  `employer` varchar(255) default NULL,
  `addressid` bigint(20) default NULL,
  `workplaceid` bigint(20) default NULL,
  `homeid` bigint(20) default NULL,
  `datecreated` bigint(20) default NULL,
  `createdby` bigint(20) default NULL,
  `lastupdatedby` bigint(20) default NULL,
  `lastupdatedate` datetime default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='InnoDB free: 4096 kB; InnoDB free: 3072 kB; InnoDB free: 307' AUTO_INCREMENT=156 ;

-- 
-- Dumping data for table `persons`
-- 

INSERT INTO `persons` VALUES (1, 'System', 'Administrator', '', '', 'Uganda', 'tribe', '2006-07-03', 0, 'N', NULL, NULL, 3, 0, NULL, 2007, 0, NULL, '0000-00-00 00:00:00');
INSERT INTO `persons` VALUES (4, 'Jimmy', 'Oluchi', 'Oketcho', '', 'Uganda', 'Alur', '2005-09-25', 0, 'N', NULL, NULL, 6, 0, NULL, 2007, 0, 0, '0000-00-00 00:00:00');
INSERT INTO `persons` VALUES (5, 'firstname', 'lastname', 'othernames', '', 'Uganda', 'tribe', '2007-01-10', 0, 'N', NULL, NULL, 11, 0, NULL, 2007, 1, NULL, '0000-00-00 00:00:00');
INSERT INTO `persons` VALUES (6, 'Tom', 'Kato', 'othernames', '', 'Uganda', 'tribe', '1976-01-11', 498, '', '', '', 12, 0, 495, 2007, 1, 1, '2007-11-14 02:37:45');
INSERT INTO `persons` VALUES (45, 'Fat', 'Opio', 'Darlem', '', 'American Samoa', '8', '1974-04-15', 304, '', '', '', 300, 0, 301, 2007, 1, NULL, '0000-00-00 00:00:00');
INSERT INTO `persons` VALUES (46, 'Darlem', 'Kabindi', 'Fashiion', '', '', '', '1970-01-01', 0, 'N', 'Designer', 'NAADS', 302, 0, 0, 2007, 1, NULL, '0000-00-00 00:00:00');
INSERT INTO `persons` VALUES (47, 'Sharon', 'Akello', 'Falrn', '', '', '', '1970-01-01', 0, 'Y', 'Farmer', 'NAADS', 303, 0, 0, 2007, 1, NULL, '0000-00-00 00:00:00');
INSERT INTO `persons` VALUES (48, 'Forlan', 'Maggy', 'Hint', 'Happy', '', '', '1979-03-08', 305, '', 'Dancer', 'Shadows Angels', 306, 0, 0, 2007, 1, NULL, '0000-00-00 00:00:00');
INSERT INTO `persons` VALUES (49, 'Salem', 'Ddamulira', '', '', '', '', '1970-01-01', 0, '', 'dancer', 'Yahoo!', 307, 0, 0, 2007, 1, NULL, '0000-00-00 00:00:00');
INSERT INTO `persons` VALUES (50, 'Fat', 'Opio', 'Darlem', '', 'American Samoa', '8', '1974-04-15', 312, '', '', '', 308, 0, 309, 2007, 1, NULL, '0000-00-00 00:00:00');
INSERT INTO `persons` VALUES (51, 'Darlem', 'Kabindi', 'Fashiion', '', '', '', '1970-01-01', 0, 'N', 'Designer', 'NAADS', 310, 0, 0, 2007, 1, NULL, '0000-00-00 00:00:00');
INSERT INTO `persons` VALUES (52, 'Sharon', 'Akello', 'Falrn', '', '', '', '1970-01-01', 0, 'Y', 'Farmer', 'NAADS', 311, 0, 0, 2007, 1, NULL, '0000-00-00 00:00:00');
INSERT INTO `persons` VALUES (53, 'Forlan', 'Maggy', 'Hint', 'Happy', '', '', '1979-03-08', 313, '', 'Dancer', 'Shadows Angels', 314, 0, 0, 2007, 1, NULL, '0000-00-00 00:00:00');
INSERT INTO `persons` VALUES (54, 'Salem', 'Ddamulira', '', '', '', '', '1970-01-01', 0, '', 'dancer', 'Yahoo!', 315, 0, 0, 2007, 1, NULL, '0000-00-00 00:00:00');
INSERT INTO `persons` VALUES (55, 'Fat', 'Opio', 'Darlem', '', 'American Samoa', '8', '1974-04-15', 320, '', '', '', 316, 0, 317, 2007, 1, NULL, '0000-00-00 00:00:00');
INSERT INTO `persons` VALUES (56, 'Darlem', 'Kabindi', 'Fashiion', '', '', '', '1970-01-01', 0, 'N', 'Designer', 'NAADS', 318, 0, 0, 2007, 1, NULL, '0000-00-00 00:00:00');
INSERT INTO `persons` VALUES (57, 'Sharon', 'Akello', 'Falrn', '', '', '', '1970-01-01', 0, 'Y', 'Farmer', 'NAADS', 319, 0, 0, 2007, 1, NULL, '0000-00-00 00:00:00');
INSERT INTO `persons` VALUES (58, 'Forlan', 'Maggy', 'Hint', 'Happy', '', '', '1979-03-08', 321, '', 'Dancer', 'Shadows Angels', 322, 0, 0, 2007, 1, NULL, '0000-00-00 00:00:00');
INSERT INTO `persons` VALUES (59, 'Salem', 'Ddamulira', '', '', '', '', '1970-01-01', 0, '', 'dancer', 'Yahoo!', 323, 0, 0, 2007, 1, NULL, '0000-00-00 00:00:00');
INSERT INTO `persons` VALUES (60, 'Fat', 'Opio', 'Darlem', '', 'American Samoa', '8', '1974-04-15', 328, '', '', '', 324, 0, 325, 2007, 1, NULL, '0000-00-00 00:00:00');
INSERT INTO `persons` VALUES (61, 'Darlem', 'Kabindi', 'Fashiion', '', '', '', '1970-01-01', 0, 'N', 'Designer', 'NAADS', 326, 0, 0, 2007, 1, NULL, '0000-00-00 00:00:00');
INSERT INTO `persons` VALUES (62, 'Sharon', 'Akello', 'Falrn', '', '', '', '1970-01-01', 0, 'Y', 'Farmer', 'NAADS', 327, 0, 0, 2007, 1, NULL, '0000-00-00 00:00:00');
INSERT INTO `persons` VALUES (63, 'Forlan', 'Maggy', 'Hint', 'Happy', '', '', '1979-03-08', 329, '', 'Dancer', 'Shadows Angels', 330, 0, 0, 2007, 1, NULL, '0000-00-00 00:00:00');
INSERT INTO `persons` VALUES (64, 'Salem', 'Ddamulira', '', '', '', '', '1970-01-01', 0, '', 'dancer', 'Yahoo!', 331, 0, 0, 2007, 1, NULL, '0000-00-00 00:00:00');
INSERT INTO `persons` VALUES (65, 'Fat', 'Opio', 'Darlem', '', 'American Samoa', '8', '1974-04-15', 336, '', '', '', 332, 0, 333, 2007, 1, NULL, '0000-00-00 00:00:00');
INSERT INTO `persons` VALUES (66, 'Darlem', 'Kabindi', 'Fashiion', '', '', '', '1970-01-01', 0, 'N', 'Designer', 'NAADS', 334, 0, 0, 2007, 1, NULL, '0000-00-00 00:00:00');
INSERT INTO `persons` VALUES (67, 'Sharon', 'Akello', 'Falrn', '', '', '', '1970-01-01', 0, 'Y', 'Farmer', 'NAADS', 335, 0, 0, 2007, 1, NULL, '0000-00-00 00:00:00');
INSERT INTO `persons` VALUES (68, 'Forlan', 'Maggy', 'Hint', 'Happy', '', '', '1979-03-08', 337, '', 'Dancer', 'Shadows Angels', 338, 0, 0, 2007, 1, NULL, '0000-00-00 00:00:00');
INSERT INTO `persons` VALUES (69, 'Salem', 'Ddamulira', '', '', '', '', '1970-01-01', 0, '', 'dancer', 'Yahoo!', 339, 0, 0, 2007, 1, NULL, '0000-00-00 00:00:00');
INSERT INTO `persons` VALUES (70, 'Fat', 'Opio', 'Darlem', '', 'American Samoa', '8', '1974-04-15', 344, '', '', '', 340, 0, 341, 2007, 1, NULL, '0000-00-00 00:00:00');
INSERT INTO `persons` VALUES (71, 'Darlem', 'Kabindi', 'Fashiion', '', '', '', '1970-01-01', 0, 'N', 'Designer', 'NAADS', 342, 0, 0, 2007, 1, NULL, '0000-00-00 00:00:00');
INSERT INTO `persons` VALUES (72, 'Sharon', 'Akello', 'Falrn', '', '', '', '1970-01-01', 0, 'Y', 'Farmer', 'NAADS', 343, 0, 0, 2007, 1, NULL, '0000-00-00 00:00:00');
INSERT INTO `persons` VALUES (73, 'Forlan', 'Maggy', 'Hint', 'Happy', '', '', '1979-03-08', 345, '', 'Dancer', 'Shadows Angels', 346, 0, 0, 2007, 1, NULL, '0000-00-00 00:00:00');
INSERT INTO `persons` VALUES (74, 'Salem', 'Ddamulira', '', '', '', '', '1970-01-01', 0, '', 'dancer', 'Yahoo!', 347, 0, 0, 2007, 1, NULL, '0000-00-00 00:00:00');
INSERT INTO `persons` VALUES (75, 'Fat', 'Opio', 'Darlem', '', 'American Samoa', '8', '1974-04-15', 352, '', '', '', 348, 0, 349, 2007, 1, NULL, '0000-00-00 00:00:00');
INSERT INTO `persons` VALUES (76, 'Darlem', 'Kabindi', 'Fashiion', '', '', '', '1970-01-01', 0, 'N', 'Designer', 'NAADS', 350, 0, 0, 2007, 1, NULL, '0000-00-00 00:00:00');
INSERT INTO `persons` VALUES (77, 'Sharon', 'Akello', 'Falrn', '', '', '', '1970-01-01', 0, 'Y', 'Farmer', 'NAADS', 351, 0, 0, 2007, 1, NULL, '0000-00-00 00:00:00');
INSERT INTO `persons` VALUES (78, 'Forlan', 'Maggy', 'Hint', 'Happy', '', '', '1979-03-08', 353, '', 'Dancer', 'Shadows Angels', 354, 0, 0, 2007, 1, NULL, '0000-00-00 00:00:00');
INSERT INTO `persons` VALUES (79, 'Salem', 'Ddamulira', '', '', '', '', '1970-01-01', 0, '', 'dancer', 'Yahoo!', 355, 0, 0, 2007, 1, NULL, '0000-00-00 00:00:00');
INSERT INTO `persons` VALUES (80, 'Fat', 'Opio', 'Darlem', '', 'American Samoa', '8', '1974-04-15', 360, '', '', '', 356, 0, 357, 2007, 1, NULL, '0000-00-00 00:00:00');
INSERT INTO `persons` VALUES (81, 'Darlem', 'Kabindi', 'Fashiion', '', '', '', '1970-01-01', 0, 'N', 'Designer', 'NAADS', 358, 0, 0, 2007, 1, NULL, '0000-00-00 00:00:00');
INSERT INTO `persons` VALUES (82, 'Sharon', 'Akello', 'Falrn', '', '', '', '1970-01-01', 0, 'Y', 'Farmer', 'NAADS', 359, 0, 0, 2007, 1, NULL, '0000-00-00 00:00:00');
INSERT INTO `persons` VALUES (83, 'Forlan', 'Maggy', 'Hint', 'Happy', '', '', '1979-03-08', 361, '', 'Dancer', 'Shadows Angels', 362, 0, 0, 2007, 1, NULL, '0000-00-00 00:00:00');
INSERT INTO `persons` VALUES (84, 'Salem', 'Ddamulira', '', '', '', '', '1970-01-01', 0, '', 'dancer', 'Yahoo!', 363, 0, 0, 2007, 1, NULL, '0000-00-00 00:00:00');
INSERT INTO `persons` VALUES (85, 'Fat', 'Opio', 'Darlem', '', 'American Samoa', '8', '1974-04-15', 368, '', '', '', 364, 0, 365, 2007, 1, NULL, '0000-00-00 00:00:00');
INSERT INTO `persons` VALUES (86, 'Darlem', 'Kabindi', 'Fashiion', '', '', '', '1970-01-01', 0, 'N', 'Designer', 'NAADS', 366, 0, 0, 2007, 1, NULL, '0000-00-00 00:00:00');
INSERT INTO `persons` VALUES (87, 'Sharon', 'Akello', 'Falrn', '', '', '', '1970-01-01', 0, 'Y', 'Farmer', 'NAADS', 367, 0, 0, 2007, 1, NULL, '0000-00-00 00:00:00');
INSERT INTO `persons` VALUES (88, 'Forlan', 'Maggy', 'Hint', 'Happy', '', '', '1979-03-08', 369, '', 'Dancer', 'Shadows Angels', 370, 0, 0, 2007, 1, NULL, '0000-00-00 00:00:00');
INSERT INTO `persons` VALUES (89, 'Salem', 'Ddamulira', '', '', '', '', '1970-01-01', 0, '', 'dancer', 'Yahoo!', 371, 0, 0, 2007, 1, NULL, '0000-00-00 00:00:00');
INSERT INTO `persons` VALUES (90, 'Fat', 'Opio', 'Darlem', '', 'American Samoa', '8', '1974-04-15', 376, '', '', '', 372, 0, 373, 2007, 1, NULL, '0000-00-00 00:00:00');
INSERT INTO `persons` VALUES (91, 'Darlem', 'Kabindi', 'Fashiion', '', '', '', '1970-01-01', 0, 'N', 'Designer', 'NAADS', 374, 0, 0, 2007, 1, NULL, '0000-00-00 00:00:00');
INSERT INTO `persons` VALUES (92, 'Sharon', 'Akello', 'Falrn', '', '', '', '1970-01-01', 0, 'Y', 'Farmer', 'NAADS', 375, 0, 0, 2007, 1, NULL, '0000-00-00 00:00:00');
INSERT INTO `persons` VALUES (93, 'Forlan', 'Maggy', 'Hint', 'Happy', '', '', '1979-03-08', 377, '', 'Dancer', 'Shadows Angels', 378, 0, 0, 2007, 1, NULL, '0000-00-00 00:00:00');
INSERT INTO `persons` VALUES (94, 'Salem', 'Ddamulira', '', '', '', '', '1970-01-01', 0, '', 'dancer', 'Yahoo!', 379, 0, 0, 2007, 1, NULL, '0000-00-00 00:00:00');
INSERT INTO `persons` VALUES (95, 'Fat', 'Opio', 'Darlem', '', 'American Samoa', '8', '1974-04-15', 384, '', '', '', 380, 0, 381, 2007, 1, NULL, '0000-00-00 00:00:00');
INSERT INTO `persons` VALUES (96, 'Darlem', 'Kabindi', 'Fashiion', '', '', '', '1970-01-01', 0, 'N', 'Designer', 'NAADS', 382, 0, 0, 2007, 1, NULL, '0000-00-00 00:00:00');
INSERT INTO `persons` VALUES (97, 'Sharon', 'Akello', 'Falrn', '', '', '', '1970-01-01', 0, 'Y', 'Farmer', 'NAADS', 383, 0, 0, 2007, 1, NULL, '0000-00-00 00:00:00');
INSERT INTO `persons` VALUES (98, 'Forlan', 'Maggy', 'Hint', 'Happy', '', '', '1979-03-08', 385, '', 'Dancer', 'Shadows Angels', 386, 0, 0, 2007, 1, NULL, '0000-00-00 00:00:00');
INSERT INTO `persons` VALUES (99, 'Salem', 'Ddamulira', '', '', '', '', '1970-01-01', 0, '', 'dancer', 'Yahoo!', 387, 0, 0, 2007, 1, NULL, '0000-00-00 00:00:00');
INSERT INTO `persons` VALUES (100, 'Fat', 'Opio', 'Darlem', '', 'American Samoa', '8', '1974-04-15', 392, '', '', '', 388, 0, 389, 2007, 1, NULL, '0000-00-00 00:00:00');
INSERT INTO `persons` VALUES (101, 'Darlem', 'Kabindi', 'Fashiion', '', '', '', '1970-01-01', 0, 'N', 'Designer', 'NAADS', 390, 0, 0, 2007, 1, NULL, '0000-00-00 00:00:00');
INSERT INTO `persons` VALUES (102, 'Sharon', 'Akello', 'Falrn', '', '', '', '1970-01-01', 0, 'Y', 'Farmer', 'NAADS', 391, 0, 0, 2007, 1, NULL, '0000-00-00 00:00:00');
INSERT INTO `persons` VALUES (103, 'Forlan', 'Maggy', 'Hint', 'Happy', '', '', '1979-03-08', 393, '', 'Dancer', 'Shadows Angels', 394, 0, 0, 2007, 1, NULL, '0000-00-00 00:00:00');
INSERT INTO `persons` VALUES (104, 'Salem', 'Ddamulira', '', '', '', '', '1970-01-01', 0, '', 'dancer', 'Yahoo!', 395, 0, 0, 2007, 1, NULL, '0000-00-00 00:00:00');
INSERT INTO `persons` VALUES (105, 'Fat', 'Opio', 'Darlem', '', 'American Samoa', '8', '1974-04-15', 400, '', '', '', 396, 0, 397, 2007, 1, NULL, '0000-00-00 00:00:00');
INSERT INTO `persons` VALUES (106, 'Darlem', 'Kabindi', 'Fashiion', '', '', '', '1970-01-01', 0, 'N', 'Designer', 'NAADS', 398, 0, 0, 2007, 1, NULL, '0000-00-00 00:00:00');
INSERT INTO `persons` VALUES (107, 'Sharon', 'Akello', 'Falrn', '', '', '', '1970-01-01', 0, 'Y', 'Farmer', 'NAADS', 399, 0, 0, 2007, 1, NULL, '0000-00-00 00:00:00');
INSERT INTO `persons` VALUES (108, 'Forlan', 'Maggy', 'Hint', 'Happy', '', '', '1979-03-08', 401, '', 'Dancer', 'Shadows Angels', 402, 0, 0, 2007, 1, NULL, '0000-00-00 00:00:00');
INSERT INTO `persons` VALUES (109, 'Salem', 'Ddamulira', '', '', '', '', '1970-01-01', 0, '', 'dancer', 'Yahoo!', 403, 0, 0, 2007, 1, NULL, '0000-00-00 00:00:00');
INSERT INTO `persons` VALUES (110, 'Fat', 'Opio', 'Darlem', '', 'American Samoa', '8', '1974-04-15', 408, '', '', '', 404, 0, 405, 2007, 1, NULL, '0000-00-00 00:00:00');
INSERT INTO `persons` VALUES (111, 'Darlem', 'Kabindi', 'Fashiion', '', '', '', '1970-01-01', 0, 'N', 'Designer', 'NAADS', 406, 0, 0, 2007, 1, NULL, '0000-00-00 00:00:00');
INSERT INTO `persons` VALUES (112, 'Sharon', 'Akello', 'Falrn', '', '', '', '1970-01-01', 0, 'Y', 'Farmer', 'NAADS', 407, 0, 0, 2007, 1, NULL, '0000-00-00 00:00:00');
INSERT INTO `persons` VALUES (113, 'Forlan', 'Maggy', 'Hint', 'Happy', '', '', '1979-03-08', 409, '', 'Dancer', 'Shadows Angels', 410, 0, 0, 2007, 1, NULL, '0000-00-00 00:00:00');
INSERT INTO `persons` VALUES (114, 'Salem', 'Ddamulira', '', '', '', '', '1970-01-01', 0, '', 'dancer', 'Yahoo!', 411, 0, 0, 2007, 1, NULL, '0000-00-00 00:00:00');
INSERT INTO `persons` VALUES (115, 'Fat', 'Opio', 'Darlem', '', 'American Samoa', '8', '1974-04-15', 416, '', '', '', 412, 0, 413, 2007, 1, NULL, '0000-00-00 00:00:00');
INSERT INTO `persons` VALUES (116, 'Darlem', 'Kabindi', 'Fashiion', '', '', '', '1970-01-01', 0, 'N', 'Designer', 'NAADS', 414, 0, 0, 2007, 1, NULL, '0000-00-00 00:00:00');
INSERT INTO `persons` VALUES (117, 'Sharon', 'Akello', 'Falrn', '', '', '', '1970-01-01', 0, 'Y', 'Farmer', 'NAADS', 415, 0, 0, 2007, 1, NULL, '0000-00-00 00:00:00');
INSERT INTO `persons` VALUES (118, 'Forlan', 'Maggy', 'Hint', 'Happy', '', '', '1979-03-08', 417, '', 'Dancer', 'Shadows Angels', 418, 0, 0, 2007, 1, NULL, '0000-00-00 00:00:00');
INSERT INTO `persons` VALUES (119, 'Salem', 'Ddamulira', '', '', '', '', '1970-01-01', 0, '', 'dancer', 'Yahoo!', 419, 0, 0, 2007, 1, NULL, '0000-00-00 00:00:00');
INSERT INTO `persons` VALUES (120, 'Fat', 'Opio', 'Darlem', '', 'American Samoa', '8', '1974-04-15', 424, '', '', '', 420, 0, 421, 2007, 1, NULL, '0000-00-00 00:00:00');
INSERT INTO `persons` VALUES (121, 'Darlem', 'Kabindi', 'Fashiion', '', '', '', '1970-01-01', 0, 'N', 'Designer', 'NAADS', 422, 0, 0, 2007, 1, NULL, '0000-00-00 00:00:00');
INSERT INTO `persons` VALUES (122, 'Sharon', 'Akello', 'Falrn', '', '', '', '1970-01-01', 0, 'Y', 'Farmer', 'NAADS', 423, 0, 0, 2007, 1, NULL, '0000-00-00 00:00:00');
INSERT INTO `persons` VALUES (123, 'Forlan', 'Maggy', 'Hint', 'Happy', '', '', '1979-03-08', 425, '', 'Dancer', 'Shadows Angels', 426, 0, 0, 2007, 1, NULL, '0000-00-00 00:00:00');
INSERT INTO `persons` VALUES (124, 'Salem', 'Ddamulira', '', '', '', '', '1970-01-01', 0, '', 'dancer', 'Yahoo!', 427, 0, 0, 2007, 1, NULL, '0000-00-00 00:00:00');
INSERT INTO `persons` VALUES (125, 'Fat', 'Opio', 'Darlem', '', 'American Samoa', '8', '1974-04-15', 432, '', '', '', 428, 0, 429, 2007, 1, NULL, '0000-00-00 00:00:00');
INSERT INTO `persons` VALUES (126, 'Darlem', 'Kabindi', 'Fashiion', '', '', '', '1970-01-01', 0, 'N', 'Designer', 'NAADS', 430, 0, 0, 2007, 1, NULL, '0000-00-00 00:00:00');
INSERT INTO `persons` VALUES (127, 'Sharon', 'Akello', 'Falrn', '', '', '', '1970-01-01', 0, 'Y', 'Farmer', 'NAADS', 431, 0, 0, 2007, 1, NULL, '0000-00-00 00:00:00');
INSERT INTO `persons` VALUES (128, 'Forlan', 'Maggy', 'Hint', 'Happy', '', '', '1979-03-08', 433, '', 'Dancer', 'Shadows Angels', 434, 0, 0, 2007, 1, NULL, '0000-00-00 00:00:00');
INSERT INTO `persons` VALUES (129, 'Salem', 'Ddamulira', '', '', '', '', '1970-01-01', 0, '', 'dancer', 'Yahoo!', 435, 0, 0, 2007, 1, NULL, '0000-00-00 00:00:00');
INSERT INTO `persons` VALUES (130, 'Fatish', 'Opio', 'Darlem', 'Harlem', 'Uganda', '2', '1974-04-14', 0, '', '', '', 0, 0, 0, 2007, 1, 1, '2007-11-09 06:07:58');
INSERT INTO `persons` VALUES (131, 'Darlem Johns', 'Kabindi', 'Fashiion', '', '', '', '1969-12-31', 0, 'Y', 'Designer', 'NAADS', 0, 0, 0, 2007, 1, 1, '2007-11-09 06:07:59');
INSERT INTO `persons` VALUES (132, 'Sharon', 'Akello', 'Falrn', '', '', '', '1969-12-31', 0, 'N', 'Farmer', 'Kaliro Enterprises', 0, 0, 0, 2007, 1, 1, '2007-11-09 06:07:59');
INSERT INTO `persons` VALUES (133, 'Forlan Juliet', 'Maggy', 'Hint', 'Happy', '', '', '1969-12-31', 0, '', 'Dancer', 'Shadows Angels Extra', 0, 0, 0, 2007, 1, 1, '2007-11-09 06:07:59');
INSERT INTO `persons` VALUES (134, 'Salem', 'Ddamulira', '', '', '', '', '1969-12-31', 0, '', 'Paiter', 'Yahoo!', 0, 0, 0, 2007, 1, 1, '2007-11-09 06:07:59');
INSERT INTO `persons` VALUES (135, 'Fat', 'Opio', 'Darlem', '', 'American Samoa', '8', '1974-04-15', 555, '', '', '', 551, 0, 552, 2007, 1, 1, '2008-01-04 21:50:45');
INSERT INTO `persons` VALUES (136, 'Darlem', 'Kabindi', 'Fashiion', '', '', '', '1969-12-31', 0, 'N', 'Designer', 'NAADS', 0, 0, 0, 2007, 1, 1, '2007-11-09 06:17:49');
INSERT INTO `persons` VALUES (137, 'Sharon', 'Akello', 'Falrn', '', '', '', '1969-12-31', 0, 'Y', 'Farmer', 'NAADS', 0, 0, 0, 2007, 1, 1, '2007-11-09 06:17:49');
INSERT INTO `persons` VALUES (138, 'Forlan', 'Maggy', 'Hint', 'Happy', '', '', '1979-03-08', 0, '', 'Dancer', 'Shadows Angels', 0, 0, 0, 2007, 1, 1, '2007-11-09 06:17:49');
INSERT INTO `persons` VALUES (139, 'Salem', 'Ddamulira', '', '', '', '', '1969-12-31', 0, '', 'dancer', 'Yahoo!', 0, 0, 0, 2007, 1, 1, '2007-11-09 06:17:49');
INSERT INTO `persons` VALUES (140, 'Charley', 'Opolot', 'Chaplin', 'Opio', 'Antarctica', '8', '1976-05-13', 0, '', '', '', 0, 0, 0, 2007, 1, 1, '2007-11-09 06:38:07');
INSERT INTO `persons` VALUES (141, 'Forlan', 'Feid', 'Juliet', 'Juliet', '', '', '1982-09-06', 0, '', 'Belly Dancer', 'Shadows Angels Extra', 0, 0, 0, 2007, 1, 1, '2007-11-09 06:38:07');
INSERT INTO `persons` VALUES (142, 'Hunt', 'KK', '', '', '', '', '1969-12-31', 0, '', 'Singer', 'Eagles Production', 0, 0, 0, 2007, 1, 1, '2007-11-09 06:38:07');
INSERT INTO `persons` VALUES (143, 'John', 'Kintu', 'Semanda', 'Semakokilo', 'Australia', '', '1981-04-14', 464, '', '', '', 460, 0, 461, 2007, 1, 1, '2007-11-14 05:25:49');
INSERT INTO `persons` VALUES (144, 'Darlim', 'Garry', 'Terry', '', '', '', '1969-12-31', 0, 'N', 'Hunter', 'Peggy Garments', 468, 0, 0, 2007, 1, 1, '2007-11-14 05:25:49');
INSERT INTO `persons` VALUES (145, 'Fint', 'Jones', 'Tint', '', '', '', '1969-12-31', 0, 'Y', 'Teacher', 'KCC Primary School', 477, 0, 0, 2007, 1, 1, '2007-11-14 05:25:49');
INSERT INTO `persons` VALUES (146, 'Cherry', 'Johns', 'Vent', 'Cherry', '', '', '1980-07-17', 484, '', 'dancer', 'Charlies Angels EXTER', 485, 0, 0, 2007, 1, 1, '2008-01-04 21:50:45');
INSERT INTO `persons` VALUES (147, 'Tim', 'Johanson', '', '', '', '', '0000-00-00', 0, '', 'Computer Wiz', 'computers & Co', 494, 0, 0, 2007, 1, 1, '2008-01-04 21:50:45');
INSERT INTO `persons` VALUES (148, 'Darlington', 'Kintu', 'Felix', 'Hunt', 'Argentina', '8', '1981-09-14', 529, '', '', '', 525, 0, 526, 2007, 1, 1, '2007-11-14 21:41:02');
INSERT INTO `persons` VALUES (149, 'Folarn', 'Garry', 'Hunt', '', '', '', '1969-12-31', 0, 'N', 'manager', 'MTN Uganda', 527, 0, 0, 2007, 1, 1, '2007-11-14 21:41:02');
INSERT INTO `persons` VALUES (150, 'Lady', 'Fatuma', 'Hint', '', '', '', '1969-12-31', 0, 'Y', 'Manager', 'UTL', 528, 0, 0, 2007, 1, 1, '2007-11-14 21:41:02');
INSERT INTO `persons` VALUES (151, 'Maria', 'angel', 'magdalene', 'Tina', '', '', '1985-08-08', 530, '', 'dancer', 'Angel Droppers', 531, 0, 0, 2007, 1, 1, '2007-11-14 21:41:02');
INSERT INTO `persons` VALUES (152, 'John', 'Kenny', '', '', '', '', '1969-12-31', 0, '', 'Farmer', 'NAADS', 532, 0, 0, 2007, 1, 1, '2007-11-14 21:41:02');
INSERT INTO `persons` VALUES (153, 'Sekito', 'Mark', '', '', 'Uganda', '2', '1977-04-14', 564, '', '', '', 560, 0, 561, 2007, 1, 1, '2007-12-13 16:02:05');
INSERT INTO `persons` VALUES (154, 'Tito', 'Simon', 'Okello', '', 'Argentina', '8', '1973-03-17', 572, '', '', '', 568, 0, 569, 2007, 1, 1, '2007-11-28 20:05:06');
INSERT INTO `persons` VALUES (155, 'Joseph', 'Okot', 'Opio', '', 'Uganda', '9', '1973-01-17', 580, '', '', '', 576, 0, 577, 2007, 1, 1, '2008-01-04 21:19:14');

-- --------------------------------------------------------

-- 
-- Table structure for table `places`
-- 

DROP TABLE IF EXISTS `places`;
CREATE TABLE `places` (
  `id` bigint(20) NOT NULL auto_increment,
  `name` varchar(255) default NULL,
  `telephone` varchar(255) default NULL,
  `village` varchar(255) default NULL,
  `subcounty` varchar(255) default 'N',
  `county` varchar(255) default NULL,
  `district` varchar(255) default NULL,
  `town` varchar(255) default NULL,
  `parish` varchar(255) default NULL,
  `plotnumber` varchar(255) default NULL,
  `lc1chairman` varchar(255) default NULL,
  `lc1telephone` varchar(255) default NULL,
  `lc2chairman` varchar(255) default NULL,
  `lc2telephone` varchar(255) default NULL,
  `createdby` bigint(20) default NULL,
  `datecreated` date default NULL,
  `lastupdatedby` bigint(20) default NULL,
  `lastupdatedate` timestamp NULL default NULL on update CURRENT_TIMESTAMP,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='InnoDB free: 4096 kB; InnoDB free: 4096 kB; InnoDB free: 409' AUTO_INCREMENT=603 ;

-- 
-- Dumping data for table `places`
-- 

INSERT INTO `places` VALUES (1, '', '', '', 'subcounty', 'county', 'district', 'town', 'parish', '', '', '', '', '', 0, '2007-10-14', NULL, NULL);
INSERT INTO `places` VALUES (2, '', '', '', 'subcounty', 'county', 'district', 'town', 'parish', '', '', '', '', '', 0, '2007-10-14', NULL, NULL);
INSERT INTO `places` VALUES (3, '', '', '', 'subcounty', 'county', 'district', 'town', 'parish', '', '', '', '', '', 0, '2007-10-14', NULL, NULL);
INSERT INTO `places` VALUES (6, '', '', '', 'asdsdas', 'sadsdsdsda', 'Kalangala', 'Kalangala', 'dasdasd', '', '', '', '', '', 0, '2007-10-14', 1, '2007-10-15 07:10:32');
INSERT INTO `places` VALUES (7, '', '', '', 'Yumbe Subcounty', 'Yumbe County', 'Yumbe', 'Yumbe Town', 'Yumbe Parish', '', '', '', '', '', 1, '2007-10-14', NULL, NULL);
INSERT INTO `places` VALUES (8, '', '', '', 'subcounty', 'county', 'district', 'town', 'parish', '', '', '', '', '', 1, '2007-10-14', NULL, NULL);
INSERT INTO `places` VALUES (9, '', '', '', 'subcounty', 'county', 'district', 'town', 'parish', '', '', '', '', '', 1, '2007-10-14', NULL, NULL);
INSERT INTO `places` VALUES (10, '', '', '', 'subcounty', 'county', 'district', 'town', 'parish', '', '', '', '', '', 1, '2007-10-14', NULL, NULL);
INSERT INTO `places` VALUES (11, '', '', '', 'subcounty', 'county', 'district', 'town', 'parish', '', '', '', '', '', 1, '2007-10-14', NULL, NULL);
INSERT INTO `places` VALUES (12, '', '6325462652', '', 'subcounty', 'county', '', 'town', 'parish', '', '', '', '', '', 1, '2007-10-14', 1, '2007-11-14 13:37:44');
INSERT INTO `places` VALUES (19, '', '', 'Kampala', 'dsdfd', 'county', 'Kampala', 'town', 'parish', '2321 Kampala Rd', 'John Mulwanya', '123002131', 'Emily Opio', '0129391231', 1, '2007-10-14', 1, '2007-10-15 17:56:37');
INSERT INTO `places` VALUES (24, '', '', 'village', 'subcounty', 'county', 'district', 'town', 'parish', 'plotnumber', 'lc1chairman', 'lc1telephone', 'lc2chairman', 'lc2telephone', 1, '2007-10-15', NULL, NULL);
INSERT INTO `places` VALUES (25, '', '', 'home_village', 'home_subcounty', 'home_county', 'home_district', 'home_town', '', 'home_plotnumber', 'home_lc1chairman', 'home_lc1telephone', 'home_lc2chairman', 'home_lc2telephone', 0, '2007-10-15', NULL, NULL);
INSERT INTO `places` VALUES (28, '', '', 'village', 'subcounty', 'county', 'district', 'town', 'parish', 'plotnumber', 'lc1chairman', 'lc1telephone', 'lc2chairman', 'lc2telephone', 1, '2007-10-15', NULL, NULL);
INSERT INTO `places` VALUES (29, '', '', 'home_village', 'home_subcounty', 'home_county', 'home_district', 'home_town', '', 'home_plotnumber', 'home_lc1chairman', 'home_lc1telephone', 'home_lc2chairman', 'home_lc2telephone', 1, '2007-10-15', NULL, NULL);
INSERT INTO `places` VALUES (30, '', '', 'village', 'subcounty', 'county', 'district', 'town', 'parish', 'plotnumber', 'lc1chairman', 'lc1telephone', 'lc2chairman', 'lc2telephone', 1, '2007-10-15', 1, '2007-10-15 18:57:17');
INSERT INTO `places` VALUES (31, '', '', 'home_village', 'home_subcounty', 'home_county', 'home_district', 'home_town', '', 'home_plotnumber', 'home_lc1chairman', 'home_lc1telephone', 'home_lc2chairman', 'home_lc2telephone', 1, '2007-10-15', 0, '2007-10-15 18:57:18');
INSERT INTO `places` VALUES (80, '', '', '', '', '', '', '', '', '', '', '', '', '', 1, '2007-10-29', NULL, NULL);
INSERT INTO `places` VALUES (81, '', '', '', '', '', '', '', '', '', '', '', '', '', 1, '2007-10-29', NULL, NULL);
INSERT INTO `places` VALUES (82, '', '', '', '', '', '', '', '', '', '', '', '', '', 1, '2007-10-29', NULL, NULL);
INSERT INTO `places` VALUES (83, '', '', '', '', '', '', '', '', '', '', '', '', '', 1, '2007-10-29', NULL, NULL);
INSERT INTO `places` VALUES (84, '', '454545', 'sdfgsfdg', 'sdfg', 'sdfg', '1', 'sdfg', 'dfg', '4', 'ddfg', '34545', 'sgdfgd', '54545', 1, '2007-10-29', NULL, NULL);
INSERT INTO `places` VALUES (85, '', '3454', 'ewrtwert', 'wert', 'wert', '1', 'wert', 'wert', '5', 'ewrt', '3454', 'etrert', '345345', 1, '2007-10-29', NULL, NULL);
INSERT INTO `places` VALUES (86, '', '', '', '', '', '', '', '', '', '', '', '', '', 1, '2007-10-29', NULL, NULL);
INSERT INTO `places` VALUES (87, '', '', '', '', '', '', '', '', '', '', '', '', '', 1, '2007-10-29', NULL, NULL);
INSERT INTO `places` VALUES (88, '', '', '', '', '', '', '', '', '', '', '', '', '', 1, '2007-10-29', NULL, NULL);
INSERT INTO `places` VALUES (89, '', '', '', '', '', '', '', '', '', '', '', '', '', 1, '2007-10-29', NULL, NULL);
INSERT INTO `places` VALUES (90, '', '', '', '', '', '', '', '', '', '', '', '', '', 1, '2007-10-29', NULL, NULL);
INSERT INTO `places` VALUES (91, '', '', '', '', '', '', '', '', '', '', '', '', '', 1, '2007-10-29', NULL, NULL);
INSERT INTO `places` VALUES (92, '', '454545', 'sdfgsfdg', 'sdfg', 'sdfg', '1', 'sdfg', 'dfg', '4', 'ddfg', '34545', 'sgdfgd', '54545', 1, '2007-10-29', NULL, NULL);
INSERT INTO `places` VALUES (93, '', '3454', 'ewrtwert', 'wert', 'wert', '1', 'wert', 'wert', '5', 'ewrt', '3454', 'etrert', '345345', 1, '2007-10-29', NULL, NULL);
INSERT INTO `places` VALUES (94, '', '', '', '', '', '', '', '', '', '', '', '', '', 1, '2007-10-29', NULL, NULL);
INSERT INTO `places` VALUES (95, '', '', '', '', '', '', '', '', '', '', '', '', '', 1, '2007-10-29', NULL, NULL);
INSERT INTO `places` VALUES (96, '', '', '', '', '', '', '', '', '', '', '', '', '', 1, '2007-10-29', NULL, NULL);
INSERT INTO `places` VALUES (97, '', '', '', '', '', '', '', '', '', '', '', '', '', 1, '2007-10-29', NULL, NULL);
INSERT INTO `places` VALUES (98, '', '', '', '', '', '', '', '', '', '', '', '', '', 1, '2007-10-29', NULL, NULL);
INSERT INTO `places` VALUES (99, '', '', '', '', '', '', '', '', '', '', '', '', '', 1, '2007-10-29', NULL, NULL);
INSERT INTO `places` VALUES (100, '', '454545', 'sdfgsfdg', 'sdfg', 'sdfg', '1', 'sdfg', 'dfg', '4', 'ddfg', '34545', 'sgdfgd', '54545', 1, '2007-10-29', NULL, NULL);
INSERT INTO `places` VALUES (101, '', '3454', 'ewrtwert', 'wert', 'wert', '1', 'wert', 'wert', '5', 'ewrt', '3454', 'etrert', '345345', 1, '2007-10-29', NULL, NULL);
INSERT INTO `places` VALUES (102, '', '', '', '', '', '', '', '', '', '', '', '', '', 1, '2007-10-29', NULL, NULL);
INSERT INTO `places` VALUES (103, '', '', '', '', '', '', '', '', '', '', '', '', '', 1, '2007-10-29', NULL, NULL);
INSERT INTO `places` VALUES (104, '', '', '', '', '', '', '', '', '', '', '', '', '', 1, '2007-10-29', NULL, NULL);
INSERT INTO `places` VALUES (105, '', '', '', '', '', '', '', '', '', '', '', '', '', 1, '2007-10-29', NULL, NULL);
INSERT INTO `places` VALUES (106, '', '', '', '', '', '', '', '', '', '', '', '', '', 1, '2007-10-29', NULL, NULL);
INSERT INTO `places` VALUES (107, '', '', '', '', '', '', '', '', '', '', '', '', '', 1, '2007-10-29', NULL, NULL);
INSERT INTO `places` VALUES (108, '', '454545', 'sdfgsfdg', 'sdfg', 'sdfg', '1', 'sdfg', 'dfg', '4', 'ddfg', '34545', 'sgdfgd', '54545', 1, '2007-10-29', NULL, NULL);
INSERT INTO `places` VALUES (109, '', '3454', 'ewrtwert', 'wert', 'wert', '1', 'wert', 'wert', '5', 'ewrt', '3454', 'etrert', '345345', 1, '2007-10-29', NULL, NULL);
INSERT INTO `places` VALUES (110, '', '', '', '', '', '', '', '', '', '', '', '', '', 1, '2007-10-29', NULL, NULL);
INSERT INTO `places` VALUES (111, '', '', '', '', '', '', '', '', '', '', '', '', '', 1, '2007-10-29', NULL, NULL);
INSERT INTO `places` VALUES (112, '', '', '', '', '', '', '', '', '', '', '', '', '', 1, '2007-10-29', NULL, NULL);
INSERT INTO `places` VALUES (113, '', '', '', '', '', '', '', '', '', '', '', '', '', 1, '2007-10-29', NULL, NULL);
INSERT INTO `places` VALUES (114, '', '', '', '', '', '', '', '', '', '', '', '', '', 1, '2007-10-29', NULL, NULL);
INSERT INTO `places` VALUES (115, '', '', '', '', '', '', '', '', '', '', '', '', '', 1, '2007-10-29', NULL, NULL);
INSERT INTO `places` VALUES (116, '', '454545', 'sdfgsfdg', 'sdfg', 'sdfg', '1', 'sdfg', 'dfg', '4', 'ddfg', '34545', 'sgdfgd', '54545', 1, '2007-10-29', NULL, NULL);
INSERT INTO `places` VALUES (117, '', '3454', 'ewrtwert', 'wert', 'wert', '1', 'wert', 'wert', '5', 'ewrt', '3454', 'etrert', '345345', 1, '2007-10-29', NULL, NULL);
INSERT INTO `places` VALUES (118, '', '', '', '', '', '', '', '', '', '', '', '', '', 1, '2007-10-29', NULL, NULL);
INSERT INTO `places` VALUES (119, '', '', '', '', '', '', '', '', '', '', '', '', '', 1, '2007-10-29', NULL, NULL);
INSERT INTO `places` VALUES (120, '', '', '', '', '', '', '', '', '', '', '', '', '', 1, '2007-10-29', NULL, NULL);
INSERT INTO `places` VALUES (121, '', '', '', '', '', '', '', '', '', '', '', '', '', 1, '2007-10-29', NULL, NULL);
INSERT INTO `places` VALUES (122, '', '', '', '', '', '', '', '', '', '', '', '', '', 1, '2007-10-29', NULL, NULL);
INSERT INTO `places` VALUES (123, '', '', '', '', '', '', '', '', '', '', '', '', '', 1, '2007-10-29', NULL, NULL);
INSERT INTO `places` VALUES (124, '', '8675467457456', '', '', '', '', '', '', '', '', '', '', '', 1, '2007-10-29', NULL, NULL);
INSERT INTO `places` VALUES (125, '', '', '', '', '', '', '', '', '', '', '', '', '', 1, '2007-10-29', NULL, NULL);
INSERT INTO `places` VALUES (126, '', '', '', '', '', '', '', '', '', '', '', '', '', 1, '2007-10-29', NULL, NULL);
INSERT INTO `places` VALUES (127, '', '', '', '', '', '', '', '', '', '', '', '', '', 1, '2007-10-29', NULL, NULL);
INSERT INTO `places` VALUES (128, '', '', '', '', '', '', '', '', '', '', '', '', '', 1, '2007-10-29', NULL, NULL);
INSERT INTO `places` VALUES (129, '', '', '', '', '', '', '', '', '', '', '', '', '', 1, '2007-10-29', NULL, NULL);
INSERT INTO `places` VALUES (130, '', '', '', '', '', '', '', '', '', '', '', '', '', 1, '2007-10-29', NULL, NULL);
INSERT INTO `places` VALUES (131, '', '', '', '', '', '', '', '', '', '', '', '', '', 1, '2007-10-29', NULL, NULL);
INSERT INTO `places` VALUES (132, '', '4524352435', '', '', '', '', '', '', '', '', '', '', '', 1, '2007-10-29', NULL, NULL);
INSERT INTO `places` VALUES (133, '', '', '', '', '', '', '', '', '', '', '', '', '', 1, '2007-10-29', NULL, NULL);
INSERT INTO `places` VALUES (134, '', '', '', '', '', '', '', '', '', '', '', '', '', 1, '2007-10-29', NULL, NULL);
INSERT INTO `places` VALUES (135, '', '', '', '', '', '', '', '', '', '', '', '', '', 1, '2007-10-29', NULL, NULL);
INSERT INTO `places` VALUES (136, '', '', '', '', '', '', '', '', '', '', '', '', '', 1, '2007-10-29', NULL, NULL);
INSERT INTO `places` VALUES (137, '', '', '', '', '', '', '', '', '', '', '', '', '', 1, '2007-10-29', NULL, NULL);
INSERT INTO `places` VALUES (138, '', '', '', '', '', '', '', '', '', '', '', '', '', 1, '2007-10-29', NULL, NULL);
INSERT INTO `places` VALUES (139, '', '', '', '', '', '', '', '', '', '', '', '', '', 1, '2007-10-29', NULL, NULL);
INSERT INTO `places` VALUES (140, '', '4524352435', '', '', '', '', '', '', '', '', '', '', '', 1, '2007-10-29', NULL, NULL);
INSERT INTO `places` VALUES (141, '', '', '', '', '', '', '', '', '', '', '', '', '', 1, '2007-10-29', NULL, NULL);
INSERT INTO `places` VALUES (142, '', '', '', '', '', '', '', '', '', '', '', '', '', 1, '2007-10-29', NULL, NULL);
INSERT INTO `places` VALUES (143, '', '', '', '', '', '', '', '', '', '', '', '', '', 1, '2007-10-29', NULL, NULL);
INSERT INTO `places` VALUES (144, '', '', '', '', '', '', '', '', '', '', '', '', '', 1, '2007-10-29', NULL, NULL);
INSERT INTO `places` VALUES (145, '', '', '', '', '', '', '', '', '', '', '', '', '', 1, '2007-10-29', NULL, NULL);
INSERT INTO `places` VALUES (146, '', '', '', '', '', '', '', '', '', '', '', '', '', 1, '2007-10-29', NULL, NULL);
INSERT INTO `places` VALUES (147, '', '', '', '', '', '', '', '', '', '', '', '', '', 1, '2007-10-29', NULL, NULL);
INSERT INTO `places` VALUES (148, '', '4524352435', '', '', '', '', '', '', '', '', '', '', '', 1, '2007-10-29', NULL, NULL);
INSERT INTO `places` VALUES (149, '', '', '', '', '', '', '', '', '', '', '', '', '', 1, '2007-10-29', NULL, NULL);
INSERT INTO `places` VALUES (150, '', '', '', '', '', '', '', '', '', '', '', '', '', 1, '2007-10-29', NULL, NULL);
INSERT INTO `places` VALUES (151, '', '', '', '', '', '', '', '', '', '', '', '', '', 1, '2007-10-29', NULL, NULL);
INSERT INTO `places` VALUES (152, '', '', '', '', '', '', '', '', '', '', '', '', '', 1, '2007-10-29', NULL, NULL);
INSERT INTO `places` VALUES (153, '', '', '', '', '', '', '', '', '', '', '', '', '', 1, '2007-10-29', NULL, NULL);
INSERT INTO `places` VALUES (154, '', '', '', '', '', '', '', '', '', '', '', '', '', 1, '2007-10-29', NULL, NULL);
INSERT INTO `places` VALUES (155, '', '', '', '', '', '', '', '', '', '', '', '', '', 1, '2007-10-29', NULL, NULL);
INSERT INTO `places` VALUES (156, '', '4524352435', '', '', '', '', '', '', '', '', '', '', '', 1, '2007-10-29', NULL, NULL);
INSERT INTO `places` VALUES (157, '', '', '', '', '', '', '', '', '', '', '', '', '', 1, '2007-10-29', NULL, NULL);
INSERT INTO `places` VALUES (158, '', '', '', '', '', '', '', '', '', '', '', '', '', 1, '2007-10-29', NULL, NULL);
INSERT INTO `places` VALUES (159, '', '', '', '', '', '', '', '', '', '', '', '', '', 1, '2007-10-29', NULL, NULL);
INSERT INTO `places` VALUES (160, '', '', '', '', '', '', '', '', '', '', '', '', '', 1, '2007-10-29', NULL, NULL);
INSERT INTO `places` VALUES (161, '', '', '', '', '', '', '', '', '', '', '', '', '', 1, '2007-10-29', NULL, NULL);
INSERT INTO `places` VALUES (162, '', '', '', '', '', '', '', '', '', '', '', '', '', 1, '2007-10-29', NULL, NULL);
INSERT INTO `places` VALUES (163, '', '', '', '', '', '', '', '', '', '', '', '', '', 1, '2007-10-29', NULL, NULL);
INSERT INTO `places` VALUES (164, '', '4524352435', '', '', '', '', '', '', '', '', '', '', '', 1, '2007-10-29', NULL, NULL);
INSERT INTO `places` VALUES (165, '', '', '', '', '', '', '', '', '', '', '', '', '', 1, '2007-10-29', NULL, NULL);
INSERT INTO `places` VALUES (166, '', '', '', '', '', '', '', '', '', '', '', '', '', 1, '2007-10-29', NULL, NULL);
INSERT INTO `places` VALUES (167, '', '', '', '', '', '', '', '', '', '', '', '', '', 1, '2007-10-29', NULL, NULL);
INSERT INTO `places` VALUES (168, '', '', '', '', '', '', '', '', '', '', '', '', '', 1, '2007-10-29', NULL, NULL);
INSERT INTO `places` VALUES (169, '', '', '', '', '', '', '', '', '', '', '', '', '', 1, '2007-10-29', NULL, NULL);
INSERT INTO `places` VALUES (170, '', '', '', '', '', '', '', '', '', '', '', '', '', 1, '2007-10-29', NULL, NULL);
INSERT INTO `places` VALUES (171, '', '', '', '', '', '', '', '', '', '', '', '', '', 1, '2007-10-29', NULL, NULL);
INSERT INTO `places` VALUES (172, '', '4524352435', '', '', '', '', '', '', '', '', '', '', '', 1, '2007-10-29', NULL, NULL);
INSERT INTO `places` VALUES (173, '', '', '', '', '', '', '', '', '', '', '', '', '', 1, '2007-10-29', NULL, NULL);
INSERT INTO `places` VALUES (174, '', '', '', '', '', '', '', '', '', '', '', '', '', 1, '2007-10-29', NULL, NULL);
INSERT INTO `places` VALUES (175, '', '', '', '', '', '', '', '', '', '', '', '', '', 1, '2007-10-29', NULL, NULL);
INSERT INTO `places` VALUES (176, '', '', '', '', '', '', '', '', '', '', '', '', '', 1, '2007-10-29', NULL, NULL);
INSERT INTO `places` VALUES (177, '', '', '', '', '', '', '', '', '', '', '', '', '', 1, '2007-10-29', NULL, NULL);
INSERT INTO `places` VALUES (178, '', '', '', '', '', '', '', '', '', '', '', '', '', 1, '2007-10-29', NULL, NULL);
INSERT INTO `places` VALUES (179, '', '', '', '', '', '', '', '', '', '', '', '', '', 1, '2007-10-29', NULL, NULL);
INSERT INTO `places` VALUES (180, '', '4524352435', '', '', '', '', '', '', '', '', '', '', '', 1, '2007-10-29', NULL, NULL);
INSERT INTO `places` VALUES (181, '', '', '', '', '', '', '', '', '', '', '', '', '', 1, '2007-10-29', NULL, NULL);
INSERT INTO `places` VALUES (182, '', '', '', '', '', '', '', '', '', '', '', '', '', 1, '2007-10-29', NULL, NULL);
INSERT INTO `places` VALUES (183, '', '', '', '', '', '', '', '', '', '', '', '', '', 1, '2007-10-29', NULL, NULL);
INSERT INTO `places` VALUES (184, '', '', '', '', '', '', '', '', '', '', '', '', '', 1, '2007-10-29', NULL, NULL);
INSERT INTO `places` VALUES (185, '', '', '', '', '', '', '', '', '', '', '', '', '', 1, '2007-10-29', NULL, NULL);
INSERT INTO `places` VALUES (186, '', '', '', '', '', '', '', '', '', '', '', '', '', 1, '2007-10-29', NULL, NULL);
INSERT INTO `places` VALUES (187, '', '', '', '', '', '', '', '', '', '', '', '', '', 1, '2007-10-29', NULL, NULL);
INSERT INTO `places` VALUES (188, '', '4524352435', '', '', '', '', '', '', '', '', '', '', '', 1, '2007-10-29', NULL, NULL);
INSERT INTO `places` VALUES (189, '', '', '', '', '', '', '', '', '', '', '', '', '', 1, '2007-10-29', NULL, NULL);
INSERT INTO `places` VALUES (190, '', '', '', '', '', '', '', '', '', '', '', '', '', 1, '2007-10-29', NULL, NULL);
INSERT INTO `places` VALUES (191, '', '', '', '', '', '', '', '', '', '', '', '', '', 1, '2007-10-29', NULL, NULL);
INSERT INTO `places` VALUES (192, '', '', '', '', '', '', '', '', '', '', '', '', '', 1, '2007-10-29', NULL, NULL);
INSERT INTO `places` VALUES (193, '', '', '', '', '', '', '', '', '', '', '', '', '', 1, '2007-10-29', NULL, NULL);
INSERT INTO `places` VALUES (194, '', '', '', '', '', '', '', '', '', '', '', '', '', 1, '2007-10-29', NULL, NULL);
INSERT INTO `places` VALUES (195, '', '', '', '', '', '', '', '', '', '', '', '', '', 1, '2007-10-29', NULL, NULL);
INSERT INTO `places` VALUES (196, '', '213123123', '', '', '', '', '', '', '', '', '', '', '', 1, '2007-10-29', NULL, NULL);
INSERT INTO `places` VALUES (197, '', '', '', '', '', '', '', '', '', '', '', '', '', 1, '2007-10-29', NULL, NULL);
INSERT INTO `places` VALUES (198, '', '', '', '', '', '', '', '', '', '', '', '', '', 1, '2007-10-29', NULL, NULL);
INSERT INTO `places` VALUES (199, '', '', '', '', '', '', '', '', '', '', '', '', '', 1, '2007-10-29', NULL, NULL);
INSERT INTO `places` VALUES (200, '', '', '', '', '', '', '', '', '', '', '', '', '', 1, '2007-10-29', NULL, NULL);
INSERT INTO `places` VALUES (201, '', '', '', '', '', '', '', '', '', '', '', '', '', 1, '2007-10-29', NULL, NULL);
INSERT INTO `places` VALUES (202, '', '', '', '', '', '', '', '', '', '', '', '', '', 1, '2007-10-29', NULL, NULL);
INSERT INTO `places` VALUES (203, '', '', '', '', '', '', '', '', '', '', '', '', '', 1, '2007-10-29', NULL, NULL);
INSERT INTO `places` VALUES (204, '', '', '', '', '', '', '', '', '', '', '', '', '', 1, '2007-10-29', NULL, NULL);
INSERT INTO `places` VALUES (205, '', '', '', '', '', '', '', '', '', '', '', '', '', 1, '2007-10-29', NULL, NULL);
INSERT INTO `places` VALUES (206, '', '', '', '', '', '', '', '', '', '', '', '', '', 1, '2007-10-29', NULL, NULL);
INSERT INTO `places` VALUES (207, '', '', '', '', '', '', '', '', '', '', '', '', '', 1, '2007-10-29', NULL, NULL);
INSERT INTO `places` VALUES (208, '', '', '', '', '', '', '', '', '', '', '', '', '', 1, '2007-10-29', NULL, NULL);
INSERT INTO `places` VALUES (209, '', '', '', '', '', '', '', '', '', '', '', '', '', 1, '2007-10-29', NULL, NULL);
INSERT INTO `places` VALUES (210, '', '', '', '', '', '', '', '', '', '', '', '', '', 1, '2007-10-29', NULL, NULL);
INSERT INTO `places` VALUES (211, '', '', '', '', '', '', '', '', '', '', '', '', '', 1, '2007-10-29', NULL, NULL);
INSERT INTO `places` VALUES (212, '', '7456345634', '', '', '', '', '', '', '', '', '', '', '', 1, '2007-10-29', NULL, NULL);
INSERT INTO `places` VALUES (213, '', '', '', '', '', '', '', '', '', '', '', '', '', 1, '2007-10-29', NULL, NULL);
INSERT INTO `places` VALUES (214, '', '', '', '', '', '', '', '', '', '', '', '', '', 1, '2007-10-29', NULL, NULL);
INSERT INTO `places` VALUES (215, '', '', '', '', '', '', '', '', '', '', '', '', '', 1, '2007-10-29', NULL, NULL);
INSERT INTO `places` VALUES (216, '', '', '', '', '', '', '', '', '', '', '', '', '', 1, '2007-10-29', NULL, NULL);
INSERT INTO `places` VALUES (217, '', '', '', '', '', '', '', '', '', '', '', '', '', 1, '2007-10-29', NULL, NULL);
INSERT INTO `places` VALUES (218, '', '', '', '', '', '', '', '', '', '', '', '', '', 1, '2007-10-29', NULL, NULL);
INSERT INTO `places` VALUES (219, '', '', '', '', '', '', '', '', '', '', '', '', '', 1, '2007-10-29', NULL, NULL);
INSERT INTO `places` VALUES (220, '', '7456345634', '', '', '', '', '', '', '', '', '', '', '', 1, '2007-10-29', NULL, NULL);
INSERT INTO `places` VALUES (221, '', '', '', '', '', '', '', '', '', '', '', '', '', 1, '2007-10-29', NULL, NULL);
INSERT INTO `places` VALUES (222, '', '', '', '', '', '', '', '', '', '', '', '', '', 1, '2007-10-29', NULL, NULL);
INSERT INTO `places` VALUES (223, '', '', '', '', '', '', '', '', '', '', '', '', '', 1, '2007-10-29', NULL, NULL);
INSERT INTO `places` VALUES (224, '', '', '', '', '', '', '', '', '', '', '', '', '', 1, '2007-10-29', NULL, NULL);
INSERT INTO `places` VALUES (225, '', '', '', '', '', '', '', '', '', '', '', '', '', 1, '2007-10-29', NULL, NULL);
INSERT INTO `places` VALUES (226, '', '', '', '', '', '', '', '', '', '', '', '', '', 1, '2007-10-29', NULL, NULL);
INSERT INTO `places` VALUES (227, '', '', '', '', '', '', '', '', '', '', '', '', '', 1, '2007-10-29', NULL, NULL);
INSERT INTO `places` VALUES (228, '', '85475474567', '', '', '', '', '', '', '', '', '', '', '', 1, '2007-10-29', NULL, NULL);
INSERT INTO `places` VALUES (229, '', '', '', '', '', '', '', '', '', '', '', '', '', 1, '2007-10-29', NULL, NULL);
INSERT INTO `places` VALUES (230, '', '', '', '', '', '', '', '', '', '', '', '', '', 1, '2007-10-29', NULL, NULL);
INSERT INTO `places` VALUES (231, '', '', '', '', '', '', '', '', '', '', '', '', '', 1, '2007-10-29', NULL, NULL);
INSERT INTO `places` VALUES (232, '', '', '', '', '', '', '', '', '', '', '', '', '', 1, '2007-10-29', NULL, NULL);
INSERT INTO `places` VALUES (233, '', '', '', '', '', '', '', '', '', '', '', '', '', 1, '2007-10-29', NULL, NULL);
INSERT INTO `places` VALUES (234, '', '', '', '', '', '', '', '', '', '', '', '', '', 1, '2007-10-29', NULL, NULL);
INSERT INTO `places` VALUES (235, '', '', '', '', '', '', '', '', '', '', '', '', '', 1, '2007-10-29', NULL, NULL);
INSERT INTO `places` VALUES (236, '', '85475474567', '', '', '', '', '', '', '', '', '', '', '', 1, '2007-10-29', NULL, NULL);
INSERT INTO `places` VALUES (237, '', '', '', '', '', '', '', '', '', '', '', '', '', 1, '2007-10-29', NULL, NULL);
INSERT INTO `places` VALUES (238, '', '', '', '', '', '', '', '', '', '', '', '', '', 1, '2007-10-29', NULL, NULL);
INSERT INTO `places` VALUES (239, '', '', '', '', '', '', '', '', '', '', '', '', '', 1, '2007-10-29', NULL, NULL);
INSERT INTO `places` VALUES (240, '', '', '', '', '', '', '', '', '', '', '', '', '', 1, '2007-10-29', NULL, NULL);
INSERT INTO `places` VALUES (241, '', '', '', '', '', '', '', '', '', '', '', '', '', 1, '2007-10-29', NULL, NULL);
INSERT INTO `places` VALUES (242, '', '', '', '', '', '', '', '', '', '', '', '', '', 1, '2007-10-29', NULL, NULL);
INSERT INTO `places` VALUES (243, '', '', '', '', '', '', '', '', '', '', '', '', '', 1, '2007-10-29', NULL, NULL);
INSERT INTO `places` VALUES (244, '', '85475474567', '', '', '', '', '', '', '', '', '', '', '', 1, '2007-10-29', NULL, NULL);
INSERT INTO `places` VALUES (245, '', '', '', '', '', '', '', '', '', '', '', '', '', 1, '2007-10-29', NULL, NULL);
INSERT INTO `places` VALUES (246, '', '', '', '', '', '', '', '', '', '', '', '', '', 1, '2007-10-29', NULL, NULL);
INSERT INTO `places` VALUES (247, '', '', '', '', '', '', '', '', '', '', '', '', '', 1, '2007-10-29', NULL, NULL);
INSERT INTO `places` VALUES (248, '', '', '', '', '', '', '', '', '', '', '', '', '', 1, '2007-10-29', NULL, NULL);
INSERT INTO `places` VALUES (249, '', '', '', '', '', '', '', '', '', '', '', '', '', 1, '2007-10-29', NULL, NULL);
INSERT INTO `places` VALUES (250, '', '', '', '', '', '', '', '', '', '', '', '', '', 1, '2007-10-29', NULL, NULL);
INSERT INTO `places` VALUES (251, '', '', '', '', '', '', '', '', '', '', '', '', '', 1, '2007-10-29', NULL, NULL);
INSERT INTO `places` VALUES (252, '', '85475474567', '', '', '', '', '', '', '', '', '', '', '', 1, '2007-10-29', NULL, NULL);
INSERT INTO `places` VALUES (253, '', '', '', '', '', '', '', '', '', '', '', '', '', 1, '2007-10-29', NULL, NULL);
INSERT INTO `places` VALUES (254, '', '', '', '', '', '', '', '', '', '', '', '', '', 1, '2007-10-29', NULL, NULL);
INSERT INTO `places` VALUES (255, '', '', '', '', '', '', '', '', '', '', '', '', '', 1, '2007-10-29', NULL, NULL);
INSERT INTO `places` VALUES (256, '', '', '', '', '', '', '', '', '', '', '', '', '', 1, '2007-10-29', NULL, NULL);
INSERT INTO `places` VALUES (257, '', '', '', '', '', '', '', '', '', '', '', '', '', 1, '2007-10-29', NULL, NULL);
INSERT INTO `places` VALUES (258, '', '', '', '', '', '', '', '', '', '', '', '', '', 1, '2007-10-29', NULL, NULL);
INSERT INTO `places` VALUES (259, '', '', '', '', '', '', '', '', '', '', '', '', '', 1, '2007-10-29', NULL, NULL);
INSERT INTO `places` VALUES (260, '', '85475474567', '', '', '', '', '', '', '', '', '', '', '', 1, '2007-10-29', NULL, NULL);
INSERT INTO `places` VALUES (261, '', '', '', '', '', '', '', '', '', '', '', '', '', 1, '2007-10-29', NULL, NULL);
INSERT INTO `places` VALUES (262, '', '', '', '', '', '', '', '', '', '', '', '', '', 1, '2007-10-29', NULL, NULL);
INSERT INTO `places` VALUES (263, '', '', '', '', '', '', '', '', '', '', '', '', '', 1, '2007-10-29', NULL, NULL);
INSERT INTO `places` VALUES (264, '', '', '', '', '', '', '', '', '', '', '', '', '', 1, '2007-10-29', NULL, NULL);
INSERT INTO `places` VALUES (265, '', '', '', '', '', '', '', '', '', '', '', '', '', 1, '2007-10-29', NULL, NULL);
INSERT INTO `places` VALUES (266, '', '', '', '', '', '', '', '', '', '', '', '', '', 1, '2007-10-29', NULL, NULL);
INSERT INTO `places` VALUES (267, '', '', '', '', '', '', '', '', '', '', '', '', '', 1, '2007-10-29', NULL, NULL);
INSERT INTO `places` VALUES (268, '', '85475474567', '', '', '', '', '', '', '', '', '', '', '', 1, '2007-10-29', NULL, NULL);
INSERT INTO `places` VALUES (269, '', '', '', '', '', '', '', '', '', '', '', '', '', 1, '2007-10-29', NULL, NULL);
INSERT INTO `places` VALUES (270, '', '', '', '', '', '', '', '', '', '', '', '', '', 1, '2007-10-29', NULL, NULL);
INSERT INTO `places` VALUES (271, '', '', '', '', '', '', '', '', '', '', '', '', '', 1, '2007-10-29', NULL, NULL);
INSERT INTO `places` VALUES (272, '', '', '', '', '', '', '', '', '', '', '', '', '', 1, '2007-10-29', NULL, NULL);
INSERT INTO `places` VALUES (273, '', '', '', '', '', '', '', '', '', '', '', '', '', 1, '2007-10-29', NULL, NULL);
INSERT INTO `places` VALUES (274, '', '', '', '', '', '', '', '', '', '', '', '', '', 1, '2007-10-29', NULL, NULL);
INSERT INTO `places` VALUES (275, '', '', '', '', '', '', '', '', '', '', '', '', '', 1, '2007-10-29', NULL, NULL);
INSERT INTO `places` VALUES (276, '', '85475474567', '', '', '', '', '', '', '', '', '', '', '', 1, '2007-10-29', NULL, NULL);
INSERT INTO `places` VALUES (277, '', '', '', '', '', '', '', '', '', '', '', '', '', 1, '2007-10-29', NULL, NULL);
INSERT INTO `places` VALUES (278, '', '', '', '', '', '', '', '', '', '', '', '', '', 1, '2007-10-29', NULL, NULL);
INSERT INTO `places` VALUES (279, '', '', '', '', '', '', '', '', '', '', '', '', '', 1, '2007-10-29', NULL, NULL);
INSERT INTO `places` VALUES (280, '', '', '', '', '', '', '', '', '', '', '', '', '', 1, '2007-10-29', NULL, NULL);
INSERT INTO `places` VALUES (281, '', '', '', '', '', '', '', '', '', '', '', '', '', 1, '2007-10-29', NULL, NULL);
INSERT INTO `places` VALUES (282, '', '', '', '', '', '', '', '', '', '', '', '', '', 1, '2007-10-29', NULL, NULL);
INSERT INTO `places` VALUES (283, '', '', '', '', '', '', '', '', '', '', '', '', '', 1, '2007-10-29', NULL, NULL);
INSERT INTO `places` VALUES (284, '', '85475474567', '', '', '', '', '', '', '', '', '', '', '', 1, '2007-10-29', NULL, NULL);
INSERT INTO `places` VALUES (285, '', '', '', '', '', '', '', '', '', '', '', '', '', 1, '2007-10-29', NULL, NULL);
INSERT INTO `places` VALUES (286, '', '', '', '', '', '', '', '', '', '', '', '', '', 1, '2007-10-29', NULL, NULL);
INSERT INTO `places` VALUES (287, '', '', '', '', '', '', '', '', '', '', '', '', '', 1, '2007-10-29', NULL, NULL);
INSERT INTO `places` VALUES (288, '', '', '', '', '', '', '', '', '', '', '', '', '', 1, '2007-10-29', NULL, NULL);
INSERT INTO `places` VALUES (289, '', '', '', '', '', '', '', '', '', '', '', '', '', 1, '2007-10-29', NULL, NULL);
INSERT INTO `places` VALUES (290, '', '', '', '', '', '', '', '', '', '', '', '', '', 1, '2007-10-29', NULL, NULL);
INSERT INTO `places` VALUES (291, '', '', '', '', '', '', '', '', '', '', '', '', '', 1, '2007-10-29', NULL, NULL);
INSERT INTO `places` VALUES (292, '', '85475474567', '', '', '', '', '', '', '', '', '', '', '', 1, '2007-10-29', NULL, NULL);
INSERT INTO `places` VALUES (293, '', '', '', '', '', '', '', '', '', '', '', '', '', 1, '2007-10-29', NULL, NULL);
INSERT INTO `places` VALUES (294, '', '', '', '', '', '', '', '', '', '', '', '', '', 1, '2007-10-29', NULL, NULL);
INSERT INTO `places` VALUES (295, '', '', '', '', '', '', '', '', '', '', '', '', '', 1, '2007-10-29', NULL, NULL);
INSERT INTO `places` VALUES (296, '', '', '', '', '', '', '', '', '', '', '', '', '', 1, '2007-10-29', NULL, NULL);
INSERT INTO `places` VALUES (297, '', '', '', '', '', '', '', '', '', '', '', '', '', 1, '2007-10-29', NULL, NULL);
INSERT INTO `places` VALUES (298, '', '', '', '', '', '', '', '', '', '', '', '', '', 1, '2007-10-29', NULL, NULL);
INSERT INTO `places` VALUES (299, '', '', '', '', '', '', '', '', '', '', '', '', '', 1, '2007-10-29', NULL, NULL);
INSERT INTO `places` VALUES (300, '', '53423423423', 'felic', 'Kabong', 'Chamrt', '1', 'Forlan', 'Felix', '34', 'felint', '53242342', 'Gorlan', '5324234234', 1, '2007-10-29', NULL, NULL);
INSERT INTO `places` VALUES (301, '', '5242342', 'forlan', 'Felit', 'Garamba', '10', 'Terry', 'Kabowa', '6', 'Felix', 'Darlem', 'Destination', '9685678568', 1, '2007-10-29', NULL, NULL);
INSERT INTO `places` VALUES (302, '', '', 'Forlan', 'Yumbe', 'Gulu', '1', '', '', '', '', '', '', '', 1, '2007-10-29', NULL, NULL);
INSERT INTO `places` VALUES (303, '', '', 'Masaka', 'Kintu', 'Garamba', '1', '', '', '', '', '', '', '', 1, '2007-10-29', NULL, NULL);
INSERT INTO `places` VALUES (304, '', '', '', '', '', '', '', '', '', '', '', '', '', 1, '2007-10-29', NULL, NULL);
INSERT INTO `places` VALUES (305, '', '', 'Darlem', 'Mawokota', 'Kituntu', '11', '', '', '', '', '', '', '', 1, '2007-10-29', NULL, NULL);
INSERT INTO `places` VALUES (306, '', '', 'Felix Village', 'Felix', 'Hint', '9', '', '', '', '', '', '', '', 1, '2007-10-29', NULL, NULL);
INSERT INTO `places` VALUES (307, '', '', 'darlem', 'Kint', 'Texas', '1', '', '', '', '', '', '', '', 1, '2007-10-29', NULL, NULL);
INSERT INTO `places` VALUES (308, '', '53423423423', 'felic', 'Kabong', 'Chamrt', '1', 'Forlan', 'Felix', '34', 'felint', '53242342', 'Gorlan', '5324234234', 1, '2007-10-29', NULL, NULL);
INSERT INTO `places` VALUES (309, '', '5242342', 'forlan', 'Felit', 'Garamba', '10', 'Terry', 'Kabowa', '6', 'Felix', 'Darlem', 'Destination', '9685678568', 1, '2007-10-29', NULL, NULL);
INSERT INTO `places` VALUES (310, '', '', 'Forlan', 'Yumbe', 'Gulu', '1', '', '', '', '', '', '', '', 1, '2007-10-29', NULL, NULL);
INSERT INTO `places` VALUES (311, '', '', 'Masaka', 'Kintu', 'Garamba', '1', '', '', '', '', '', '', '', 1, '2007-10-29', NULL, NULL);
INSERT INTO `places` VALUES (312, '', '', '', '', '', '', '', '', '', '', '', '', '', 1, '2007-10-29', NULL, NULL);
INSERT INTO `places` VALUES (313, '', '', 'Darlem', 'Mawokota', 'Kituntu', '11', '', '', '', '', '', '', '', 1, '2007-10-29', NULL, NULL);
INSERT INTO `places` VALUES (314, '', '', 'Felix Village', 'Felix', 'Hint', '9', '', '', '', '', '', '', '', 1, '2007-10-29', NULL, NULL);
INSERT INTO `places` VALUES (315, '', '', 'darlem', 'Kint', 'Texas', '1', '', '', '', '', '', '', '', 1, '2007-10-29', NULL, NULL);
INSERT INTO `places` VALUES (316, '', '53423423423', 'felic', 'Kabong', 'Chamrt', '1', 'Forlan', 'Felix', '34', 'felint', '53242342', 'Gorlan', '5324234234', 1, '2007-10-29', NULL, NULL);
INSERT INTO `places` VALUES (317, '', '5242342', 'forlan', 'Felit', 'Garamba', '10', 'Terry', 'Kabowa', '6', 'Felix', 'Darlem', 'Destination', '9685678568', 1, '2007-10-29', NULL, NULL);
INSERT INTO `places` VALUES (318, '', '', 'Forlan', 'Yumbe', 'Gulu', '1', '', '', '', '', '', '', '', 1, '2007-10-29', NULL, NULL);
INSERT INTO `places` VALUES (319, '', '', 'Masaka', 'Kintu', 'Garamba', '1', '', '', '', '', '', '', '', 1, '2007-10-29', NULL, NULL);
INSERT INTO `places` VALUES (320, '', '', '', '', '', '', '', '', '', '', '', '', '', 1, '2007-10-29', NULL, NULL);
INSERT INTO `places` VALUES (321, '', '', 'Darlem', 'Mawokota', 'Kituntu', '11', '', '', '', '', '', '', '', 1, '2007-10-29', NULL, NULL);
INSERT INTO `places` VALUES (322, '', '', 'Felix Village', 'Felix', 'Hint', '9', '', '', '', '', '', '', '', 1, '2007-10-29', NULL, NULL);
INSERT INTO `places` VALUES (323, '', '', 'darlem', 'Kint', 'Texas', '1', '', '', '', '', '', '', '', 1, '2007-10-29', NULL, NULL);
INSERT INTO `places` VALUES (324, '', '53423423423', 'felic', 'Kabong', 'Chamrt', '1', 'Forlan', 'Felix', '34', 'felint', '53242342', 'Gorlan', '5324234234', 1, '2007-10-29', NULL, NULL);
INSERT INTO `places` VALUES (325, '', '5242342', 'forlan', 'Felit', 'Garamba', '10', 'Terry', 'Kabowa', '6', 'Felix', 'Darlem', 'Destination', '9685678568', 1, '2007-10-29', NULL, NULL);
INSERT INTO `places` VALUES (326, '', '', 'Forlan', 'Yumbe', 'Gulu', '1', '', '', '', '', '', '', '', 1, '2007-10-29', NULL, NULL);
INSERT INTO `places` VALUES (327, '', '', 'Masaka', 'Kintu', 'Garamba', '1', '', '', '', '', '', '', '', 1, '2007-10-29', NULL, NULL);
INSERT INTO `places` VALUES (328, '', '', '', '', '', '', '', '', '', '', '', '', '', 1, '2007-10-29', NULL, NULL);
INSERT INTO `places` VALUES (329, '', '', 'Darlem', 'Mawokota', 'Kituntu', '11', '', '', '', '', '', '', '', 1, '2007-10-29', NULL, NULL);
INSERT INTO `places` VALUES (330, '', '', 'Felix Village', 'Felix', 'Hint', '9', '', '', '', '', '', '', '', 1, '2007-10-29', NULL, NULL);
INSERT INTO `places` VALUES (331, '', '', 'darlem', 'Kint', 'Texas', '1', '', '', '', '', '', '', '', 1, '2007-10-29', NULL, NULL);
INSERT INTO `places` VALUES (332, '', '53423423423', 'felic', 'Kabong', 'Chamrt', '1', 'Forlan', 'Felix', '34', 'felint', '53242342', 'Gorlan', '5324234234', 1, '2007-10-29', NULL, NULL);
INSERT INTO `places` VALUES (333, '', '5242342', 'forlan', 'Felit', 'Garamba', '10', 'Terry', 'Kabowa', '6', 'Felix', 'Darlem', 'Destination', '9685678568', 1, '2007-10-29', NULL, NULL);
INSERT INTO `places` VALUES (334, '', '', 'Forlan', 'Yumbe', 'Gulu', '1', '', '', '', '', '', '', '', 1, '2007-10-29', NULL, NULL);
INSERT INTO `places` VALUES (335, '', '', 'Masaka', 'Kintu', 'Garamba', '1', '', '', '', '', '', '', '', 1, '2007-10-29', NULL, NULL);
INSERT INTO `places` VALUES (336, '', '', '', '', '', '', '', '', '', '', '', '', '', 1, '2007-10-29', NULL, NULL);
INSERT INTO `places` VALUES (337, '', '', 'Darlem', 'Mawokota', 'Kituntu', '11', '', '', '', '', '', '', '', 1, '2007-10-29', NULL, NULL);
INSERT INTO `places` VALUES (338, '', '', 'Felix Village', 'Felix', 'Hint', '9', '', '', '', '', '', '', '', 1, '2007-10-29', NULL, NULL);
INSERT INTO `places` VALUES (339, '', '', 'darlem', 'Kint', 'Texas', '1', '', '', '', '', '', '', '', 1, '2007-10-29', NULL, NULL);
INSERT INTO `places` VALUES (340, '', '53423423423', 'felic', 'Kabong', 'Chamrt', '1', 'Forlan', 'Felix', '34', 'felint', '53242342', 'Gorlan', '5324234234', 1, '2007-10-29', NULL, NULL);
INSERT INTO `places` VALUES (341, '', '5242342', 'forlan', 'Felit', 'Garamba', '10', 'Terry', 'Kabowa', '6', 'Felix', 'Darlem', 'Destination', '9685678568', 1, '2007-10-29', NULL, NULL);
INSERT INTO `places` VALUES (342, '', '', 'Forlan', 'Yumbe', 'Gulu', '1', '', '', '', '', '', '', '', 1, '2007-10-29', NULL, NULL);
INSERT INTO `places` VALUES (343, '', '', 'Masaka', 'Kintu', 'Garamba', '1', '', '', '', '', '', '', '', 1, '2007-10-29', NULL, NULL);
INSERT INTO `places` VALUES (344, '', '', '', '', '', '', '', '', '', '', '', '', '', 1, '2007-10-29', NULL, NULL);
INSERT INTO `places` VALUES (345, '', '', 'Darlem', 'Mawokota', 'Kituntu', '11', '', '', '', '', '', '', '', 1, '2007-10-29', NULL, NULL);
INSERT INTO `places` VALUES (346, '', '', 'Felix Village', 'Felix', 'Hint', '9', '', '', '', '', '', '', '', 1, '2007-10-29', NULL, NULL);
INSERT INTO `places` VALUES (347, '', '', 'darlem', 'Kint', 'Texas', '1', '', '', '', '', '', '', '', 1, '2007-10-29', NULL, NULL);
INSERT INTO `places` VALUES (348, '', '53423423423', 'felic', 'Kabong', 'Chamrt', '1', 'Forlan', 'Felix', '34', 'felint', '53242342', 'Gorlan', '5324234234', 1, '2007-10-29', NULL, NULL);
INSERT INTO `places` VALUES (349, '', '5242342', 'forlan', 'Felit', 'Garamba', '10', 'Terry', 'Kabowa', '6', 'Felix', 'Darlem', 'Destination', '9685678568', 1, '2007-10-29', NULL, NULL);
INSERT INTO `places` VALUES (350, '', '', 'Forlan', 'Yumbe', 'Gulu', '1', '', '', '', '', '', '', '', 1, '2007-10-29', NULL, NULL);
INSERT INTO `places` VALUES (351, '', '', 'Masaka', 'Kintu', 'Garamba', '1', '', '', '', '', '', '', '', 1, '2007-10-29', NULL, NULL);
INSERT INTO `places` VALUES (352, '', '', '', '', '', '', '', '', '', '', '', '', '', 1, '2007-10-29', NULL, NULL);
INSERT INTO `places` VALUES (353, '', '', 'Darlem', 'Mawokota', 'Kituntu', '11', '', '', '', '', '', '', '', 1, '2007-10-29', NULL, NULL);
INSERT INTO `places` VALUES (354, '', '', 'Felix Village', 'Felix', 'Hint', '9', '', '', '', '', '', '', '', 1, '2007-10-29', NULL, NULL);
INSERT INTO `places` VALUES (355, '', '', 'darlem', 'Kint', 'Texas', '1', '', '', '', '', '', '', '', 1, '2007-10-29', NULL, NULL);
INSERT INTO `places` VALUES (356, '', '53423423423', 'felic', 'Kabong', 'Chamrt', '1', 'Forlan', 'Felix', '34', 'felint', '53242342', 'Gorlan', '5324234234', 1, '2007-10-29', NULL, NULL);
INSERT INTO `places` VALUES (357, '', '5242342', 'forlan', 'Felit', 'Garamba', '10', 'Terry', 'Kabowa', '6', 'Felix', 'Darlem', 'Destination', '9685678568', 1, '2007-10-29', NULL, NULL);
INSERT INTO `places` VALUES (358, '', '', 'Forlan', 'Yumbe', 'Gulu', '1', '', '', '', '', '', '', '', 1, '2007-10-29', NULL, NULL);
INSERT INTO `places` VALUES (359, '', '', 'Masaka', 'Kintu', 'Garamba', '1', '', '', '', '', '', '', '', 1, '2007-10-29', NULL, NULL);
INSERT INTO `places` VALUES (360, '', '', '', '', '', '', '', '', '', '', '', '', '', 1, '2007-10-29', NULL, NULL);
INSERT INTO `places` VALUES (361, '', '', 'Darlem', 'Mawokota', 'Kituntu', '11', '', '', '', '', '', '', '', 1, '2007-10-29', NULL, NULL);
INSERT INTO `places` VALUES (362, '', '', 'Felix Village', 'Felix', 'Hint', '9', '', '', '', '', '', '', '', 1, '2007-10-29', NULL, NULL);
INSERT INTO `places` VALUES (363, '', '', 'darlem', 'Kint', 'Texas', '1', '', '', '', '', '', '', '', 1, '2007-10-29', NULL, NULL);
INSERT INTO `places` VALUES (364, '', '53423423423', 'felic', 'Kabong', 'Chamrt', '1', 'Forlan', 'Felix', '34', 'felint', '53242342', 'Gorlan', '5324234234', 1, '2007-10-29', NULL, NULL);
INSERT INTO `places` VALUES (365, '', '5242342', 'forlan', 'Felit', 'Garamba', '10', 'Terry', 'Kabowa', '6', 'Felix', 'Darlem', 'Destination', '9685678568', 1, '2007-10-29', NULL, NULL);
INSERT INTO `places` VALUES (366, '', '', 'Forlan', 'Yumbe', 'Gulu', '1', '', '', '', '', '', '', '', 1, '2007-10-29', NULL, NULL);
INSERT INTO `places` VALUES (367, '', '', 'Masaka', 'Kintu', 'Garamba', '1', '', '', '', '', '', '', '', 1, '2007-10-29', NULL, NULL);
INSERT INTO `places` VALUES (368, '', '', '', '', '', '', '', '', '', '', '', '', '', 1, '2007-10-29', NULL, NULL);
INSERT INTO `places` VALUES (369, '', '', 'Darlem', 'Mawokota', 'Kituntu', '11', '', '', '', '', '', '', '', 1, '2007-10-29', NULL, NULL);
INSERT INTO `places` VALUES (370, '', '', 'Felix Village', 'Felix', 'Hint', '9', '', '', '', '', '', '', '', 1, '2007-10-29', NULL, NULL);
INSERT INTO `places` VALUES (371, '', '', 'darlem', 'Kint', 'Texas', '1', '', '', '', '', '', '', '', 1, '2007-10-29', NULL, NULL);
INSERT INTO `places` VALUES (372, '', '53423423423', 'felic', 'Kabong', 'Chamrt', '1', 'Forlan', 'Felix', '34', 'felint', '53242342', 'Gorlan', '5324234234', 1, '2007-10-29', NULL, NULL);
INSERT INTO `places` VALUES (373, '', '5242342', 'forlan', 'Felit', 'Garamba', '10', 'Terry', 'Kabowa', '6', 'Felix', 'Darlem', 'Destination', '9685678568', 1, '2007-10-29', NULL, NULL);
INSERT INTO `places` VALUES (374, '', '', 'Forlan', 'Yumbe', 'Gulu', '1', '', '', '', '', '', '', '', 1, '2007-10-29', NULL, NULL);
INSERT INTO `places` VALUES (375, '', '', 'Masaka', 'Kintu', 'Garamba', '1', '', '', '', '', '', '', '', 1, '2007-10-29', NULL, NULL);
INSERT INTO `places` VALUES (376, '', '', '', '', '', '', '', '', '', '', '', '', '', 1, '2007-10-29', NULL, NULL);
INSERT INTO `places` VALUES (377, '', '', 'Darlem', 'Mawokota', 'Kituntu', '11', '', '', '', '', '', '', '', 1, '2007-10-29', NULL, NULL);
INSERT INTO `places` VALUES (378, '', '', 'Felix Village', 'Felix', 'Hint', '9', '', '', '', '', '', '', '', 1, '2007-10-29', NULL, NULL);
INSERT INTO `places` VALUES (379, '', '', 'darlem', 'Kint', 'Texas', '1', '', '', '', '', '', '', '', 1, '2007-10-29', NULL, NULL);
INSERT INTO `places` VALUES (380, '', '53423423423', 'felic', 'Kabong', 'Chamrt', '1', 'Forlan', 'Felix', '34', 'felint', '53242342', 'Gorlan', '5324234234', 1, '2007-10-29', NULL, NULL);
INSERT INTO `places` VALUES (381, '', '5242342', 'forlan', 'Felit', 'Garamba', '10', 'Terry', 'Kabowa', '6', 'Felix', 'Darlem', 'Destination', '9685678568', 1, '2007-10-29', NULL, NULL);
INSERT INTO `places` VALUES (382, '', '', 'Forlan', 'Yumbe', 'Gulu', '1', '', '', '', '', '', '', '', 1, '2007-10-29', NULL, NULL);
INSERT INTO `places` VALUES (383, '', '', 'Masaka', 'Kintu', 'Garamba', '1', '', '', '', '', '', '', '', 1, '2007-10-29', NULL, NULL);
INSERT INTO `places` VALUES (384, '', '', '', '', '', '', '', '', '', '', '', '', '', 1, '2007-10-29', NULL, NULL);
INSERT INTO `places` VALUES (385, '', '', 'Darlem', 'Mawokota', 'Kituntu', '11', '', '', '', '', '', '', '', 1, '2007-10-29', NULL, NULL);
INSERT INTO `places` VALUES (386, '', '', 'Felix Village', 'Felix', 'Hint', '9', '', '', '', '', '', '', '', 1, '2007-10-29', NULL, NULL);
INSERT INTO `places` VALUES (387, '', '', 'darlem', 'Kint', 'Texas', '1', '', '', '', '', '', '', '', 1, '2007-10-29', NULL, NULL);
INSERT INTO `places` VALUES (388, '', '53423423423', 'felic', 'Kabong', 'Chamrt', '1', 'Forlan', 'Felix', '34', 'felint', '53242342', 'Gorlan', '5324234234', 1, '2007-10-29', NULL, NULL);
INSERT INTO `places` VALUES (389, '', '5242342', 'forlan', 'Felit', 'Garamba', '10', 'Terry', 'Kabowa', '6', 'Felix', 'Darlem', 'Destination', '9685678568', 1, '2007-10-29', NULL, NULL);
INSERT INTO `places` VALUES (390, '', '', 'Forlan', 'Yumbe', 'Gulu', '1', '', '', '', '', '', '', '', 1, '2007-10-29', NULL, NULL);
INSERT INTO `places` VALUES (391, '', '', 'Masaka', 'Kintu', 'Garamba', '1', '', '', '', '', '', '', '', 1, '2007-10-29', NULL, NULL);
INSERT INTO `places` VALUES (392, '', '', '', '', '', '', '', '', '', '', '', '', '', 1, '2007-10-29', NULL, NULL);
INSERT INTO `places` VALUES (393, '', '', 'Darlem', 'Mawokota', 'Kituntu', '11', '', '', '', '', '', '', '', 1, '2007-10-29', NULL, NULL);
INSERT INTO `places` VALUES (394, '', '', 'Felix Village', 'Felix', 'Hint', '9', '', '', '', '', '', '', '', 1, '2007-10-29', NULL, NULL);
INSERT INTO `places` VALUES (395, '', '', 'darlem', 'Kint', 'Texas', '1', '', '', '', '', '', '', '', 1, '2007-10-29', NULL, NULL);
INSERT INTO `places` VALUES (396, '', '53423423423', 'felic', 'Kabong', 'Chamrt', '1', 'Forlan', 'Felix', '34', 'felint', '53242342', 'Gorlan', '5324234234', 1, '2007-10-29', NULL, NULL);
INSERT INTO `places` VALUES (397, '', '5242342', 'forlan', 'Felit', 'Garamba', '10', 'Terry', 'Kabowa', '6', 'Felix', 'Darlem', 'Destination', '9685678568', 1, '2007-10-29', NULL, NULL);
INSERT INTO `places` VALUES (398, '', '', 'Forlan', 'Yumbe', 'Gulu', '1', '', '', '', '', '', '', '', 1, '2007-10-29', NULL, NULL);
INSERT INTO `places` VALUES (399, '', '', 'Masaka', 'Kintu', 'Garamba', '1', '', '', '', '', '', '', '', 1, '2007-10-29', NULL, NULL);
INSERT INTO `places` VALUES (400, '', '', '', '', '', '', '', '', '', '', '', '', '', 1, '2007-10-29', NULL, NULL);
INSERT INTO `places` VALUES (401, '', '', 'Darlem', 'Mawokota', 'Kituntu', '11', '', '', '', '', '', '', '', 1, '2007-10-29', NULL, NULL);
INSERT INTO `places` VALUES (402, '', '', 'Felix Village', 'Felix', 'Hint', '9', '', '', '', '', '', '', '', 1, '2007-10-29', NULL, NULL);
INSERT INTO `places` VALUES (403, '', '', 'darlem', 'Kint', 'Texas', '1', '', '', '', '', '', '', '', 1, '2007-10-29', NULL, NULL);
INSERT INTO `places` VALUES (404, '', '53423423423', 'felic', 'Kabong', 'Chamrt', '1', 'Forlan', 'Felix', '34', 'felint', '53242342', 'Gorlan', '5324234234', 1, '2007-10-29', NULL, NULL);
INSERT INTO `places` VALUES (405, '', '5242342', 'forlan', 'Felit', 'Garamba', '10', 'Terry', 'Kabowa', '6', 'Felix', 'Darlem', 'Destination', '9685678568', 1, '2007-10-29', NULL, NULL);
INSERT INTO `places` VALUES (406, '', '', 'Forlan', 'Yumbe', 'Gulu', '1', '', '', '', '', '', '', '', 1, '2007-10-29', NULL, NULL);
INSERT INTO `places` VALUES (407, '', '', 'Masaka', 'Kintu', 'Garamba', '1', '', '', '', '', '', '', '', 1, '2007-10-29', NULL, NULL);
INSERT INTO `places` VALUES (408, '', '', '', '', '', '', '', '', '', '', '', '', '', 1, '2007-10-29', NULL, NULL);
INSERT INTO `places` VALUES (409, '', '', 'Darlem', 'Mawokota', 'Kituntu', '11', '', '', '', '', '', '', '', 1, '2007-10-29', NULL, NULL);
INSERT INTO `places` VALUES (410, '', '', 'Felix Village', 'Felix', 'Hint', '9', '', '', '', '', '', '', '', 1, '2007-10-29', NULL, NULL);
INSERT INTO `places` VALUES (411, '', '', 'darlem', 'Kint', 'Texas', '1', '', '', '', '', '', '', '', 1, '2007-10-29', NULL, NULL);
INSERT INTO `places` VALUES (412, '', '53423423423', 'felic', 'Kabong', 'Chamrt', '1', 'Forlan', 'Felix', '34', 'felint', '53242342', 'Gorlan', '5324234234', 1, '2007-10-29', NULL, NULL);
INSERT INTO `places` VALUES (413, '', '5242342', 'forlan', 'Felit', 'Garamba', '10', 'Terry', 'Kabowa', '6', 'Felix', 'Darlem', 'Destination', '9685678568', 1, '2007-10-29', NULL, NULL);
INSERT INTO `places` VALUES (414, '', '', 'Forlan', 'Yumbe', 'Gulu', '1', '', '', '', '', '', '', '', 1, '2007-10-29', NULL, NULL);
INSERT INTO `places` VALUES (415, '', '', 'Masaka', 'Kintu', 'Garamba', '1', '', '', '', '', '', '', '', 1, '2007-10-29', NULL, NULL);
INSERT INTO `places` VALUES (416, '', '', '', '', '', '', '', '', '', '', '', '', '', 1, '2007-10-29', NULL, NULL);
INSERT INTO `places` VALUES (417, '', '', 'Darlem', 'Mawokota', 'Kituntu', '11', '', '', '', '', '', '', '', 1, '2007-10-29', NULL, NULL);
INSERT INTO `places` VALUES (418, '', '', 'Felix Village', 'Felix', 'Hint', '9', '', '', '', '', '', '', '', 1, '2007-10-29', NULL, NULL);
INSERT INTO `places` VALUES (419, '', '', 'darlem', 'Kint', 'Texas', '1', '', '', '', '', '', '', '', 1, '2007-10-29', NULL, NULL);
INSERT INTO `places` VALUES (420, '', '53423423423', 'felic', 'Kabong', 'Chamrt', '1', 'Forlan', 'Felix', '34', 'felint', '53242342', 'Gorlan', '5324234234', 1, '2007-10-29', NULL, NULL);
INSERT INTO `places` VALUES (421, '', '5242342', 'forlan', 'Felit', 'Garamba', '10', 'Terry', 'Kabowa', '6', 'Felix', 'Darlem', 'Destination', '9685678568', 1, '2007-10-29', NULL, NULL);
INSERT INTO `places` VALUES (422, '', '', 'Forlan', 'Yumbe', 'Gulu', '1', '', '', '', '', '', '', '', 1, '2007-10-29', NULL, NULL);
INSERT INTO `places` VALUES (423, '', '', 'Masaka', 'Kintu', 'Garamba', '1', '', '', '', '', '', '', '', 1, '2007-10-29', NULL, NULL);
INSERT INTO `places` VALUES (424, '', '', '', '', '', '', '', '', '', '', '', '', '', 1, '2007-10-29', NULL, NULL);
INSERT INTO `places` VALUES (425, '', '', 'Darlem', 'Mawokota', 'Kituntu', '11', '', '', '', '', '', '', '', 1, '2007-10-29', NULL, NULL);
INSERT INTO `places` VALUES (426, '', '', 'Felix Village', 'Felix', 'Hint', '9', '', '', '', '', '', '', '', 1, '2007-10-29', NULL, NULL);
INSERT INTO `places` VALUES (427, '', '', 'darlem', 'Kint', 'Texas', '1', '', '', '', '', '', '', '', 1, '2007-10-29', NULL, NULL);
INSERT INTO `places` VALUES (428, '', '53423423423', 'felic', 'Kabong', 'Chamrt', '1', 'Forlan', 'Felix', '34', 'felint', '53242342', 'Gorlan', '5324234234', 1, '2007-10-29', NULL, NULL);
INSERT INTO `places` VALUES (429, '', '5242342', 'forlan', 'Felit', 'Garamba', '10', 'Terry', 'Kabowa', '6', 'Felix', 'Darlem', 'Destination', '9685678568', 1, '2007-10-29', NULL, NULL);
INSERT INTO `places` VALUES (430, '', '', 'Forlan', 'Yumbe', 'Gulu', '1', '', '', '', '', '', '', '', 1, '2007-10-29', NULL, NULL);
INSERT INTO `places` VALUES (431, '', '', 'Masaka', 'Kintu', 'Garamba', '1', '', '', '', '', '', '', '', 1, '2007-10-29', NULL, NULL);
INSERT INTO `places` VALUES (432, '', '', '', '', '', '', '', '', '', '', '', '', '', 1, '2007-10-29', NULL, NULL);
INSERT INTO `places` VALUES (433, '', '', 'Darlem', 'Mawokota', 'Kituntu', '11', '', '', '', '', '', '', '', 1, '2007-10-29', NULL, NULL);
INSERT INTO `places` VALUES (434, '', '', 'Felix Village', 'Felix', 'Hint', '9', '', '', '', '', '', '', '', 1, '2007-10-29', NULL, NULL);
INSERT INTO `places` VALUES (435, '', '', 'darlem', 'Kint', 'Texas', '1', '', '', '', '', '', '', '', 1, '2007-10-29', NULL, NULL);
INSERT INTO `places` VALUES (436, '', '53423423423', 'felic', 'Kabong', 'Chamrt', '11', 'Forlan', 'Felix', '34', 'felint', '53242342', 'Gorlan', '5324234234', 1, '2007-10-29', 1, '2007-11-09 17:07:57');
INSERT INTO `places` VALUES (437, '', '5242342', 'forlan', 'Felit', 'Garamba', '10', 'Terry', 'Kabowa', '63', 'Felix Samson Kidawalime', 'Darlem', 'Destination', '9685678568', 1, '2007-10-29', 1, '2007-11-09 17:07:58');
INSERT INTO `places` VALUES (438, '', '341432213123', 'Forlan', 'Yumbe', 'Gulu', '1', '', '', '', '', '', '', '', 1, '2007-10-29', 1, '2007-11-09 17:07:58');
INSERT INTO `places` VALUES (439, '', '65232432423', 'Masaka', 'Kintu', 'Garamba', '9', '', '', '', '', '', '', '', 1, '2007-10-29', 1, '2007-11-09 17:07:58');
INSERT INTO `places` VALUES (440, 'Kamwokya', '', 'Kamwokya', 'Kiseka II', 'KCC III', '2', '', '', '', '', '', '', '', 1, '2007-10-29', 1, '2007-11-09 17:07:58');
INSERT INTO `places` VALUES (441, '', '', 'Felix Village', 'Mawokota', 'Kituntu', '11', '', '', '', '', '', '', '', 1, '2007-10-29', 1, '2007-11-09 17:07:58');
INSERT INTO `places` VALUES (442, '', '', 'Felix Village', 'Felix', 'Hint', '9', '', '', '', '', '', '', '', 1, '2007-10-29', 1, '2007-11-09 17:07:58');
INSERT INTO `places` VALUES (443, '', '6252432423', 'Komunyo', 'Kint', 'Texas', '1', '', '', '', '', '', '', '', 1, '2007-10-29', 1, '2007-11-09 17:07:58');
INSERT INTO `places` VALUES (444, '', '53423423423', 'felic', 'Kabong', 'Chamrt', '1', 'Forlan', 'Felix', '34', 'felint', '53242342', 'Gorlan', '5324234234', 1, '2007-10-29', 1, '2007-11-09 17:17:49');
INSERT INTO `places` VALUES (445, '', '5242342', 'forlan', 'Felit', 'Garamba', '10', 'Terry', 'Kabowa', '6', 'Felix', 'Darlem', 'Destination', '9685678568', 1, '2007-10-29', 1, '2007-11-09 17:17:49');
INSERT INTO `places` VALUES (446, '', '', 'Forlan', 'Yumbe', 'Gulu', '1', '', '', '', '', '', '', '', 1, '2007-10-29', 1, '2007-11-09 17:17:49');
INSERT INTO `places` VALUES (447, '', '', 'Masaka', 'Kintu', 'Garamba', '1', '', '', '', '', '', '', '', 1, '2007-10-29', 1, '2007-11-09 17:17:49');
INSERT INTO `places` VALUES (448, 'kabong', '', 'Gulu barracks', 'Kabong', 'Kabong', '2', '', '', '', '', '', '', '', 1, '2007-10-29', 1, '2007-11-09 17:17:49');
INSERT INTO `places` VALUES (449, '', '', 'Felix Village', 'Mawokota', 'Kituntu', '11', '', '', '', '', '', '', '', 1, '2007-10-29', 1, '2007-11-09 17:17:49');
INSERT INTO `places` VALUES (450, '', '', 'Felix Village', 'Felix', 'Hint', '9', '', '', '', '', '', '', '', 1, '2007-10-29', 1, '2007-11-09 17:17:49');
INSERT INTO `places` VALUES (451, '', '', 'darlem', 'Kint', 'Texas', '1', '', '', '', '', '', '', '', 1, '2007-10-29', 1, '2007-11-09 17:17:49');
INSERT INTO `places` VALUES (452, '', '41213123213213', 'Kabowa', 'Kabowa', 'Hint', '1', 'Kampala', 'Kabowa', '53', 'Felix Johns', '521341313', 'Harely Peterson', '532314214', 1, '2007-11-09', 1, '2007-11-09 17:38:07');
INSERT INTO `places` VALUES (453, '', '5314213213', 'Filint', 'rerwer', 'Kint', '9', 'Kabwa', 'Harley', '43', 'Kint Rd', '4121321313', 'Kint Healry', '534314423', 1, '2007-11-09', 1, '2007-11-09 17:38:07');
INSERT INTO `places` VALUES (454, '', '', '', '', '', '', '', '', '', '', '', '', '', 1, '2007-11-09', NULL, NULL);
INSERT INTO `places` VALUES (455, '', '', '', '', '', '', '', '', '', '', '', '', '', 1, '2007-11-09', NULL, NULL);
INSERT INTO `places` VALUES (456, 'Harley', '', 'Kabong', 'Kabong', 'Gulu Barracks', '1', '', '', '', '', '', '', '', 1, '2007-11-09', 1, '2007-11-09 17:38:07');
INSERT INTO `places` VALUES (457, '', '', 'Felix', 'Harlem', 'Gulu', '9', '', '', '', '', '', '', '', 1, '2007-11-09', 1, '2007-11-09 17:38:07');
INSERT INTO `places` VALUES (458, '', '53434234', 'Felix', 'County 2', 'Kamwokya', '2', '', '', '', '', '', '', '', 1, '2007-11-09', 1, '2007-11-09 17:38:07');
INSERT INTO `places` VALUES (459, '', '35235235', 'Hunt', 'Kabong', 'Terry', '', '', '', '', '', '', '', '', 1, '2007-11-09', 1, '2007-11-09 17:38:07');
INSERT INTO `places` VALUES (460, '', '', '', '', '', '', '', '', '', '', '', '', '', 1, '2007-11-09', 1, '2007-11-14 18:53:06');
INSERT INTO `places` VALUES (461, '', '', '', '', '', '', '', '', '', '', '', '', '', 1, '2007-11-09', 1, '2007-11-14 18:53:08');
INSERT INTO `places` VALUES (462, '', '', '', '', '', '', '', '', '', '', '', '', '', 1, '2007-11-09', NULL, NULL);
INSERT INTO `places` VALUES (463, '', '', '', '', '', '', '', '', '', '', '', '', '', 1, '2007-11-09', NULL, NULL);
INSERT INTO `places` VALUES (464, '', '', '', '', '', '', '', '', '', '', '', '', '', 1, '2007-11-09', 1, '2007-11-14 18:53:08');
INSERT INTO `places` VALUES (465, '', '', '', '', '', '', '', '', '', '', '', '', '', 1, '2007-11-09', NULL, NULL);
INSERT INTO `places` VALUES (466, '', '', '', '', '', '', '', '', '', '', '', '', '', 1, '2007-11-09', NULL, NULL);
INSERT INTO `places` VALUES (467, '', '', '', '', '', '', '', '', '', '', '', '', '', 1, '2007-11-09', NULL, NULL);
INSERT INTO `places` VALUES (468, '', '', '', '', '', '', '', '', '', '', '', '', '', 1, '2007-11-09', 1, '2007-11-14 18:53:08');
INSERT INTO `places` VALUES (469, '', '', '', '', '', '', '', '', '', '', '', '', '', 1, '2007-11-09', NULL, NULL);
INSERT INTO `places` VALUES (470, '', '', '', '', '', '', '', '', '', '', '', '', '', 1, '2007-11-09', NULL, NULL);
INSERT INTO `places` VALUES (471, '', '', '', '', '', '', '', '', '', '', '', '', '', 1, '2007-11-09', NULL, NULL);
INSERT INTO `places` VALUES (472, '', '', '', '', '', '', '', '', '', '', '', '', '', 1, '2007-11-09', NULL, NULL);
INSERT INTO `places` VALUES (473, '', '', '', '', '', '', '', '', '', '', '', '', '', 1, '2007-11-09', NULL, NULL);
INSERT INTO `places` VALUES (474, '', '', '', '', '', '', '', '', '', '', '', '', '', 1, '2007-11-09', NULL, NULL);
INSERT INTO `places` VALUES (475, '', '', '', '', '', '', '', '', '', '', '', '', '', 1, '2007-11-09', NULL, NULL);
INSERT INTO `places` VALUES (476, '', '', '', '', '', '', '', '', '', '', '', '', '', 1, '2007-11-09', NULL, NULL);
INSERT INTO `places` VALUES (477, '', '86746745', 'Funt', 'Rarty', 'Yout', '', '', '', '', '', '', '', '', 1, '2007-11-09', 1, '2007-11-14 18:53:08');
INSERT INTO `places` VALUES (478, '', '', '', '', '', '', '', '', '', '', '', '', '', 1, '2007-11-09', NULL, NULL);
INSERT INTO `places` VALUES (479, '', '', '', '', '', '', '', '', '', '', '', '', '', 1, '2007-11-09', NULL, NULL);
INSERT INTO `places` VALUES (480, '', '', '', '', '', '', '', '', '', '', '', '', '', 1, '2007-11-09', NULL, NULL);
INSERT INTO `places` VALUES (481, '', '', '', '', '', '', '', '', '', '', '', '', '', 1, '2007-11-09', NULL, NULL);
INSERT INTO `places` VALUES (482, '', '', '', '', '', '', '', '', '', '', '', '', '', 1, '2007-11-09', NULL, NULL);
INSERT INTO `places` VALUES (483, '', '', '', '', '', '', '', '', '', '', '', '', '', 1, '2007-11-09', NULL, NULL);
INSERT INTO `places` VALUES (484, '', '', 'Garry', 'Terry Hunt', 'Hunt', '1', '', '', '', '', '', '', '', 1, '2007-11-09', 1, '2008-01-04 21:50:45');
INSERT INTO `places` VALUES (485, '', '25724562456', 'Yount', 'Hint', 'Hinter', '11', '', '', '', '', '', '', '', 1, '2007-11-09', 1, '2008-01-04 21:50:45');
INSERT INTO `places` VALUES (486, '', '', '', '', '', '', '', '', '', '', '', '', '', 1, '2007-11-09', NULL, NULL);
INSERT INTO `places` VALUES (487, '', '', '', '', '', '', '', '', '', '', '', '', '', 1, '2007-11-09', NULL, NULL);
INSERT INTO `places` VALUES (488, '', '', '', '', '', '', '', '', '', '', '', '', '', 1, '2007-11-09', NULL, NULL);
INSERT INTO `places` VALUES (489, '', '', '', '', '', '', '', '', '', '', '', '', '', 1, '2007-11-09', NULL, NULL);
INSERT INTO `places` VALUES (490, '', '', '', '', '', '', '', '', '', '', '', '', '', 1, '2007-11-09', NULL, NULL);
INSERT INTO `places` VALUES (491, '', '', '', '', '', '', '', '', '', '', '', '', '', 1, '2007-11-09', NULL, NULL);
INSERT INTO `places` VALUES (492, '', '', '', '', '', '', '', '', '', '', '', '', '', 1, '2007-11-09', NULL, NULL);
INSERT INTO `places` VALUES (493, '', '', '', '', '', '', '', '', '', '', '', '', '', 1, '2007-11-09', NULL, NULL);
INSERT INTO `places` VALUES (494, '', '00191231231', 'Fint', 'Gerty', 'Hont', '2', '', '', '', '', '', '', '', 1, '2007-11-09', 1, '2008-01-04 21:50:45');
INSERT INTO `places` VALUES (495, '', '', '', '', '', '', '', '', '', '', '', '', '', 1, '2007-11-11', 1, '2007-11-14 13:37:44');
INSERT INTO `places` VALUES (496, '', '', '', '', '', '', '', '', '', '', '', '', '', 1, '2007-11-11', NULL, NULL);
INSERT INTO `places` VALUES (497, '', '', '', '', '', '', '', '', '', '', '', '', '', 1, '2007-11-11', NULL, NULL);
INSERT INTO `places` VALUES (498, 'Felington', '', 'China Town', 'yount', 'Garry John', '', '', '', '', '', '', '', '', 1, '2007-11-11', 1, '2007-11-14 13:37:44');
INSERT INTO `places` VALUES (499, '', '', '', '', '', '', '', '', '', '', '', '', '', 1, '2007-11-11', NULL, NULL);
INSERT INTO `places` VALUES (500, '', '', '', '', '', '', '', '', '', '', '', '', '', 1, '2007-11-11', NULL, NULL);
INSERT INTO `places` VALUES (501, '', '', '', '', '', '', '', '', '', '', '', '', '', 1, '2007-11-11', NULL, NULL);
INSERT INTO `places` VALUES (502, '', '', '', '', '', '', '', '', '', '', '', '', '', 1, '2007-11-11', NULL, NULL);
INSERT INTO `places` VALUES (503, '', '', '', '', '', '', '', '', '', '', '', '', '', 1, '2007-11-11', NULL, NULL);
INSERT INTO `places` VALUES (504, '', '', '', '', '', '', '', '', '', '', '', '', '', 1, '2007-11-11', NULL, NULL);
INSERT INTO `places` VALUES (505, '', '', '', '', '', '', '', '', '', '', '', '', '', 1, '2007-11-11', NULL, NULL);
INSERT INTO `places` VALUES (506, '', '', '', '', '', '', '', '', '', '', '', '', '', 1, '2007-11-11', NULL, NULL);
INSERT INTO `places` VALUES (507, '', '', '', '', '', '', '', '', '', '', '', '', '', 1, '2007-11-11', NULL, NULL);
INSERT INTO `places` VALUES (508, '', '', '', '', '', '', '', '', '', '', '', '', '', 1, '2007-11-11', NULL, NULL);
INSERT INTO `places` VALUES (509, '', '', '', '', '', '', '', '', '', '', '', '', '', 1, '2007-11-11', NULL, NULL);
INSERT INTO `places` VALUES (510, '', '', '', '', '', '', '', '', '', '', '', '', '', 1, '2007-11-11', NULL, NULL);
INSERT INTO `places` VALUES (511, '', '', '', '', '', '', '', '', '', '', '', '', '', 1, '2007-11-11', NULL, NULL);
INSERT INTO `places` VALUES (512, '', '', '', '', '', '', '', '', '', '', '', '', '', 1, '2007-11-14', NULL, NULL);
INSERT INTO `places` VALUES (513, '', '', '', '', '', '', '', '', '', '', '', '', '', 1, '2007-11-14', NULL, NULL);
INSERT INTO `places` VALUES (514, '', '', '', '', '', '', '', '', '', '', '', '', '', 1, '2007-11-14', NULL, NULL);
INSERT INTO `places` VALUES (515, '', '', '', '', '', '', '', '', '', '', '', '', '', 1, '2007-11-14', NULL, NULL);
INSERT INTO `places` VALUES (516, '', '', '', '', '', '', '', '', '', '', '', '', '', 1, '2007-11-14', NULL, NULL);
INSERT INTO `places` VALUES (517, '', '', '', '', '', '', '', '', '', '', '', '', '', 1, '2007-11-14', NULL, NULL);
INSERT INTO `places` VALUES (518, '', '', '', '', '', '', '', '', '', '', '', '', '', 1, '2007-11-14', NULL, NULL);
INSERT INTO `places` VALUES (519, '', '', '', '', '', '', '', '', '', '', '', '', '', 1, '2007-11-14', NULL, NULL);
INSERT INTO `places` VALUES (520, '', '', '', '', '', '', '', '', '', '', '', '', '', 1, '2007-11-14', NULL, NULL);
INSERT INTO `places` VALUES (521, '', '', '', '', '', '', '', '', '', '', '', '', '', 1, '2007-11-14', NULL, NULL);
INSERT INTO `places` VALUES (522, '', '', '', '', '', '', '', '', '', '', '', '', '', 1, '2007-11-14', NULL, NULL);
INSERT INTO `places` VALUES (523, '', '', '', '', '', '', '', '', '', '', '', '', '', 1, '2007-11-14', NULL, NULL);
INSERT INTO `places` VALUES (524, '', '', '', '', '', '', '', '', '', '', '', '', '', 1, '2007-11-14', NULL, NULL);
INSERT INTO `places` VALUES (525, '', '8546574', 'Fint', 'Hunt County', 'Farlon County', '11', 'Tint', 'Gate', '23', 'Kanbig Joseph', '8674576465', 'Tinmur Peter', '56745756', 1, '2007-11-14', 1, '2007-11-15 08:41:01');
INSERT INTO `places` VALUES (526, '', '63263262', 'Very', 'Flint Road', 'Hint Road', '2', 'Delaton', 'Felix', '12', 'Hunt', '6334534', 'Garry', '525124', 1, '2007-11-14', 1, '2007-11-15 08:41:01');
INSERT INTO `places` VALUES (527, '', '958678768', 'Rangerland', 'Terry Land', 'Fairy county', '1', '', '', '', '', '', '', '', 1, '2007-11-14', 1, '2007-11-15 08:41:01');
INSERT INTO `places` VALUES (528, '', '068796789', 'kabowa', 'Fint', 'manager county', '11', '', '', '', '', '', '', '', 1, '2007-11-14', 1, '2007-11-15 08:41:01');
INSERT INTO `places` VALUES (529, 'kabowa', '', 'Felix', 'Kint', 'Uganja', '1', '', '', '', '', '', '', '', 1, '2007-11-14', 1, '2007-11-15 08:41:02');
INSERT INTO `places` VALUES (530, '', '', 'Foran', 'Foran County', 'Kampala', '9', '', '', '', '', '', '', '', 1, '2007-11-14', 1, '2007-11-15 08:41:02');
INSERT INTO `places` VALUES (531, '', '6245324535', 'kabowa', 'Tinogand', 'Ugint', '11', '', '', '', '', '', '', '', 1, '2007-11-14', 1, '2007-11-15 08:41:02');
INSERT INTO `places` VALUES (532, '', '3643564356', 'Goat Race', 'Font County', 'Font County', '', '', '', '', '', '', '', '', 1, '2007-11-14', 1, '2007-11-15 08:41:02');
INSERT INTO `places` VALUES (535, '', '', '', '', '', '', '', '', '', '', '', '', '', 1, '2007-11-15', NULL, NULL);
INSERT INTO `places` VALUES (536, '', '', '', '', '', '', '', '', '', '', '', '', '', 1, '2007-11-15', NULL, NULL);
INSERT INTO `places` VALUES (537, 'Felix Road', '', 'Kabong', 'Hunt Rd', 'Kampala County', '', '', '', '', '', '', '', '', 1, '2007-11-15', 1, '2007-11-15 11:46:53');
INSERT INTO `places` VALUES (538, '', '', '', '', '', '', '', '', '', '', '', '', '', 1, '2007-11-15', NULL, NULL);
INSERT INTO `places` VALUES (539, '', '', '', '', '', '', '', '', '', '', '', '', '', 1, '2007-11-15', NULL, NULL);
INSERT INTO `places` VALUES (540, '', '', '', '', '', '', '', '', '', '', '', '', '', 1, '2007-11-15', NULL, NULL);
INSERT INTO `places` VALUES (541, '', '', '', '', '', '', '', '', '', '', '', '', '', 1, '2007-11-15', NULL, NULL);
INSERT INTO `places` VALUES (542, '', '', '', '', '', '', '', '', '', '', '', '', '', 1, '2007-11-15', NULL, NULL);
INSERT INTO `places` VALUES (543, '', '', '', '', '', '', '', '', '', '', '', '', '', 1, '2007-11-15', NULL, NULL);
INSERT INTO `places` VALUES (544, '', '', '', '', '', '', '', '', '', '', '', '', '', 1, '2007-11-15', NULL, NULL);
INSERT INTO `places` VALUES (545, '', '', '', '', '', '', '', '', '', '', '', '', '', 1, '2007-11-15', NULL, NULL);
INSERT INTO `places` VALUES (546, '', '', '', '', '', '', '', '', '', '', '', '', '', 1, '2007-11-15', NULL, NULL);
INSERT INTO `places` VALUES (547, '', '', '', '', '', '', '', '', '', '', '', '', '', 1, '2007-11-15', NULL, NULL);
INSERT INTO `places` VALUES (548, '', '', '', '', '', '', '', '', '', '', '', '', '', 1, '2007-11-15', NULL, NULL);
INSERT INTO `places` VALUES (549, '', '', '', '', '', '', '', '', '', '', '', '', '', 1, '2007-11-15', NULL, NULL);
INSERT INTO `places` VALUES (550, '', '', '', '', '', '', '', '', '', '', '', '', '', 1, '2007-11-15', NULL, NULL);
INSERT INTO `places` VALUES (551, '', '542353245', '', '', '', '', '', '', '', '', '', '', '', 1, '2007-11-19', 1, '2008-01-04 21:50:44');
INSERT INTO `places` VALUES (552, '', '', '', '', '', '', '', '', '', '', '', '', '', 1, '2007-11-19', 1, '2008-01-04 21:50:45');
INSERT INTO `places` VALUES (553, '', '', '', '', '', '', '', '', '', '', '', '', '', 1, '2007-11-19', NULL, NULL);
INSERT INTO `places` VALUES (554, '', '', '', '', '', '', '', '', '', '', '', '', '', 1, '2007-11-19', NULL, NULL);
INSERT INTO `places` VALUES (555, '', '', '', '', '', '', '', '', '', '', '', '', '', 1, '2007-11-19', 1, '2008-01-04 21:50:45');
INSERT INTO `places` VALUES (556, '', '', '', '', '', '', '', '', '', '', '', '', '', 1, '20