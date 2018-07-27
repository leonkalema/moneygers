-- phpMyAdmin SQL Dump
-- version 2.6.4-pl3
-- http://www.phpmyadmin.net
-- 
-- Host: db417523907.db.1and1.com
-- Generation Time: Dec 12, 2012 at 02:24 AM
-- Server version: 5.0.96
-- PHP Version: 5.3.3-7+squeeze14
-- 
-- Database: `db417523907`
-- 

-- --------------------------------------------------------

-- 
-- Table structure for table `absentees`
-- 

CREATE TABLE `absentees` (
  `id` bigint(20) NOT NULL auto_increment,
  `guard` varchar(255) default NULL,
  `assignment` varchar(255) default NULL,
  `absenteedate` date default NULL,
  `comments` varchar(255) default NULL,
  `createdby` bigint(20) default NULL,
  `datecreated` date default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

-- 
-- Dumping data for table `absentees`
-- 

INSERT INTO `absentees` VALUES (2, 'H003', '110314', '2007-05-13', '', 1, '2007-12-03');
INSERT INTO `absentees` VALUES (3, 'zx', 'xc', '2002-04-03', 'xcxc', 1, '2007-12-03');

-- --------------------------------------------------------

-- 
-- Table structure for table `accounts`
-- 

CREATE TABLE `accounts` (
  `id` bigint(20) NOT NULL auto_increment,
  `accountname` varchar(250) NOT NULL default '',
  `type` varchar(250) NOT NULL default '',
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1 AUTO_INCREMENT=12 ;

-- 
-- Dumping data for table `accounts`
-- 

INSERT INTO `accounts` VALUES (1, 'Profit and Loss Account', 'inflow');
INSERT INTO `accounts` VALUES (2, 'Share Capital', 'inflow');
INSERT INTO `accounts` VALUES (3, 'Shareholders Loans', 'inflow');
INSERT INTO `accounts` VALUES (4, 'Taxation Account', 'inflow');
INSERT INTO `accounts` VALUES (5, 'Income Turnover', 'outflow');
INSERT INTO `accounts` VALUES (6, 'Nile UGS Account', 'inflow');
INSERT INTO `accounts` VALUES (7, 'Paid Goodwill', 'inflow');
INSERT INTO `accounts` VALUES (8, 'Casuals Wages', 'outflow');
INSERT INTO `accounts` VALUES (9, 'Guards Salaries', 'outflow');
INSERT INTO `accounts` VALUES (10, 'Motor Vehicles Running Repairs', 'outflow');
INSERT INTO `accounts` VALUES (11, 'DETERGENT', 'outflow');

-- --------------------------------------------------------

-- 
-- Table structure for table `actions`
-- 

CREATE TABLE `actions` (
  `id` bigint(20) NOT NULL auto_increment,
  `name` varchar(255) NOT NULL default '',
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

-- 
-- Dumping data for table `actions`
-- 

INSERT INTO `actions` VALUES (1, 'Transfer');
INSERT INTO `actions` VALUES (2, 'Promotion');
INSERT INTO `actions` VALUES (3, 'Suspension');
INSERT INTO `actions` VALUES (4, 'Warning');
INSERT INTO `actions` VALUES (5, 'Police Custody');
INSERT INTO `actions` VALUES (6, 'Expeled');

-- --------------------------------------------------------

-- 
-- Table structure for table `activity`
-- 

CREATE TABLE `activity` (
  `id` bigint(20) NOT NULL auto_increment,
  `activity` varchar(250) NOT NULL default '',
  `date_of_entry` datetime NOT NULL default '0000-00-00 00:00:00',
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

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
-- Table structure for table `alarmactions`
-- 

CREATE TABLE `alarmactions` (
  `id` bigint(20) NOT NULL auto_increment,
  `alarmid` varchar(250) NOT NULL default '',
  `prevassignment` varchar(250) NOT NULL default '',
  `prevlocation` varchar(250) NOT NULL default '',
  `prevclient` varchar(250) NOT NULL default '',
  `newassignment` varchar(250) NOT NULL default '',
  `newlocation` varchar(250) NOT NULL default '',
  `newclient` varchar(250) NOT NULL default '',
  `action` varchar(250) NOT NULL default '',
  `isactive` enum('Y','N') NOT NULL default 'Y',
  `date_of_entry` datetime NOT NULL default '0000-00-00 00:00:00',
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

-- 
-- Dumping data for table `alarmactions`
-- 

INSERT INTO `alarmactions` VALUES (1, '18', 'FD21', 'KLA-3', 'Fida', 'D145-N', 'KLA-2', 'Crane Bank Uganda', 'transfer', 'Y', '2008-05-14 10:07:17');
INSERT INTO `alarmactions` VALUES (2, '', '', '', '', 'F903', 'KBL', 'Flex Impressions Ltd', 'transfer', 'Y', '2008-05-16 08:25:18');
INSERT INTO `alarmactions` VALUES (3, 'S872', 'S4B1', 'KLA-2', 'S4B', 'S4B1', 'KLA-2', 'Crane Bank Ltd.', 'transfer', 'Y', '2008-05-20 17:05:06');
INSERT INTO `alarmactions` VALUES (4, 'R934', 'K4232', 'KLA-2', 'Shark Inc.', 'F903', 'MBR-1', 'Mbarara Stores', 'transfer', 'Y', '2008-05-20 17:06:19');
INSERT INTO `alarmactions` VALUES (5, 'S872', 'S4B1', 'KLA-2', 'S4B', 'KKK1-D', 'KLA-1', 'Kits End International', 'transfer', 'Y', '2008-07-23 10:41:58');

-- --------------------------------------------------------

-- 
-- Table structure for table `alarms`
-- 

CREATE TABLE `alarms` (
  `id` bigint(20) NOT NULL auto_increment,
  `alarmid` varchar(125) NOT NULL default '',
  `alarmtype` varchar(250) NOT NULL default '',
  `alarmstatus` varchar(250) NOT NULL default '',
  `systemsinstalled` text NOT NULL,
  `assignment` varchar(100) NOT NULL default '',
  `startdate` date NOT NULL default '0000-00-00',
  `enddate` date default '0000-00-00',
  `expirydate` date default '0000-00-00',
  `status` varchar(50) default 'active',
  `rate` varchar(250) NOT NULL default '',
  `lastupdated` datetime NOT NULL default '0000-00-00 00:00:00',
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=latin1 AUTO_INCREMENT=24 ;

-- 
-- Dumping data for table `alarms`
-- 

INSERT INTO `alarms` VALUES (3, 'A124', '', '', '', 'NBL01', '2008-02-01', '2009-10-06', '2010-12-12', 'serviced', '', '2008-05-20 17:11:02');
INSERT INTO `alarms` VALUES (4, 'A321', '', '', '', 'KKK1-D', '2008-03-03', '2008-12-05', '2009-12-19', 'transfered', '', '2008-03-19 11:39:54');
INSERT INTO `alarms` VALUES (5, 'A813', '', '', '', 'KKK1-D', '2008-03-01', '2008-03-05', '2008-03-15', 'transfered', '', '2008-02-18 14:38:12');
INSERT INTO `alarms` VALUES (6, 'A481', '', '', '', 'H312-D', '2008-02-06', '2008-03-30', '2008-04-05', 'decommissioned', '', '2008-02-18 14:38:59');
INSERT INTO `alarms` VALUES (7, 'K123', '', '', '', 'Q444-N', '2008-03-21', '2008-09-20', '2008-10-31', 'decommissioned', '', '2008-05-16 08:42:31');
INSERT INTO `alarms` VALUES (8, 'A439', '', '', '18,20', 'H312-D', '2008-03-03', '2009-02-03', '2009-10-15', 'transfered', '2700', '2008-03-13 13:36:07');
INSERT INTO `alarms` VALUES (9, 'A301', '', '', '', 'D145-N', '2008-03-01', '2008-03-15', '2008-04-01', 'serviced', '', '2008-02-18 14:38:51');
INSERT INTO `alarms` VALUES (10, 'A223', '', '', '18,19,20,22', 'H312-D', '2008-03-19', '2008-03-30', '2008-04-15', 'transfered', '3000', '2008-03-29 12:21:05');
INSERT INTO `alarms` VALUES (11, 'CNB2', '', '', '', 'D145-N', '2008-03-03', '2008-06-30', '2009-07-15', 'active', '', '2008-05-20 17:10:55');
INSERT INTO `alarms` VALUES (12, 's233', '', '', '', 'D145-N', '2008-03-02', '1999-11-30', '1999-11-30', 'serviced', '', '2008-05-20 17:07:08');
INSERT INTO `alarms` VALUES (13, 'd344', '', '', '', 'D145-N', '2008-03-04', '2008-04-06', '2008-04-07', 'transfered', '', '2008-03-29 12:20:25');
INSERT INTO `alarms` VALUES (14, 'AW02', '', '', '', 'FD21', '2008-03-06', '2008-10-30', '2008-09-30', 'decommissioned', '', '2008-05-16 08:47:32');
INSERT INTO `alarms` VALUES (15, 'HAT', '', '', '', 'H123', '0000-00-00', '0000-00-00', '0000-00-00', 'serviced', '', '2008-05-20 17:07:08');
INSERT INTO `alarms` VALUES (17, 'T9034', '', '', '', 'FD21', '2008-05-03', '0000-00-00', '0000-00-00', 'serviced', '', '2008-05-20 17:10:33');
INSERT INTO `alarms` VALUES (18, 'WA67', 'Intruder', 'Rented', '18,19,20,22', 'D145-N', '2008-02-18', '2008-06-14', '0000-00-00', 'transfered', '', '2008-05-13 14:55:07');
INSERT INTO `alarms` VALUES (21, 'S872', 'Intruder', 'Rented', '18,19,20', 'S4B1', '2008-09-19', '0000-00-00', '0000-00-00', 'serviced', '', '2008-05-20 17:10:33');
INSERT INTO `alarms` VALUES (22, 'R934', 'Panic', 'Rented', '18,19,20', 'K4232', '2008-07-15', '0000-00-00', '0000-00-00', 'active', '', '2008-05-20 17:10:55');
INSERT INTO `alarms` VALUES (23, 'W234', 'Intruder', 'Rented', '18,20', 'KKK1-D', '2008-02-18', '2010-03-09', '2008-02-28', 'active', '1500', '2008-07-23 09:51:54');

-- --------------------------------------------------------

-- 
-- Table structure for table `appraisals`
-- 

CREATE TABLE `appraisals` (
  `id` bigint(20) NOT NULL auto_increment,
  `guard` varchar(150) NOT NULL default '',
  `assignment` varchar(250) NOT NULL default '',
  `details` text NOT NULL,
  `madeby` varchar(250) NOT NULL default '',
  `isactive` enum('Y','N') NOT NULL default 'Y',
  `registrationdate` date NOT NULL default '0000-00-00',
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

-- 
-- Dumping data for table `appraisals`
-- 

INSERT INTO `appraisals` VALUES (1, 'J201', 'H312-D', 'he stole a client''s car', '', 'Y', '2008-05-11');
INSERT INTO `appraisals` VALUES (3, 'J201', 'KKK1-D', 'He has been a good guard and caught 2 theives.', 'GM', 'Y', '2008-05-10');
INSERT INTO `appraisals` VALUES (5, 'K903', 'H300-N', 'He has been a good employee so far.', 'Apolo', 'Y', '2008-05-04');
INSERT INTO `appraisals` VALUES (6, 'T023', 'STB1', 'He was vigilant in organizing the bank cusotmers.', 'Otim Michael', 'N', '2008-05-05');
INSERT INTO `appraisals` VALUES (7, 'W344', 'T903', 'He stole the client''s cup when he was leaving. that means he deserves to be suspended for indescent behaviour.', 'Tallon Holdings - Client', 'Y', '2008-05-18');

-- --------------------------------------------------------

-- 
-- Table structure for table `assignmentovertime`
-- 

CREATE TABLE `assignmentovertime` (
  `id` bigint(20) NOT NULL auto_increment,
  `guardid` varchar(250) NOT NULL default '',
  `assignment` varchar(255) NOT NULL default '',
  `scheduleid` varchar(255) NOT NULL default '',
  `date` date NOT NULL default '0000-00-00',
  `duration` varchar(250) NOT NULL default '',
  `status` varchar(255) NOT NULL default '',
  `date_of_entry` datetime NOT NULL default '0000-00-00 00:00:00',
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=177 DEFAULT CHARSET=latin1 AUTO_INCREMENT=177 ;

-- 
-- Dumping data for table `assignmentovertime`
-- 

INSERT INTO `assignmentovertime` VALUES (39, 'F554', 'H300-N', '', '2007-12-15', '2', '', '0000-00-00 00:00:00');
INSERT INTO `assignmentovertime` VALUES (42, 'P0081', 'H230-D', '', '2007-11-08', '', '', '0000-00-00 00:00:00');
INSERT INTO `assignmentovertime` VALUES (43, 'P0081', 'H300-N', '', '2007-11-08', '2', '', '0000-00-00 00:00:00');
INSERT INTO `assignmentovertime` VALUES (44, 'F554', 'H230-D', '', '2007-12-03', '', '', '0000-00-00 00:00:00');
INSERT INTO `assignmentovertime` VALUES (45, 'F554', 'NBL01', '', '2007-12-03', '3', '', '0000-00-00 00:00:00');
INSERT INTO `assignmentovertime` VALUES (46, 'Y907', 'KKK0-D', '', '2008-01-06', '2', '', '0000-00-00 00:00:00');
INSERT INTO `assignmentovertime` VALUES (150, 'P0081', 'H457-K', '11', '2008-01-30', '', 'archived', '2008-02-01 15:27:32');
INSERT INTO `assignmentovertime` VALUES (154, 'Y907', 'H230-D', '12', '2008-01-31', '', 'archived', '2008-02-01 15:51:38');
INSERT INTO `assignmentovertime` VALUES (155, 'P0081', 'H312-D', '12', '2008-01-31', '', 'rejected', '2008-02-01 15:51:38');
INSERT INTO `assignmentovertime` VALUES (156, 'P0081', 'Q444-N', '20', '2008-02-01', '', 'approved', '2008-02-01 15:51:38');
INSERT INTO `assignmentovertime` VALUES (157, 'H013', 'Leave', '20', '2008-02-01', '', 'rejected', '2008-02-02 12:48:53');
INSERT INTO `assignmentovertime` VALUES (158, 'T023', 'KKK3-N', '20', '2008-02-01', '', 'approved', '2008-02-02 12:48:53');
INSERT INTO `assignmentovertime` VALUES (159, 'Y907', 'KKK0-D', '21', '2008-02-02', '', 'approved', '2008-02-02 12:48:53');
INSERT INTO `assignmentovertime` VALUES (160, 'F554', '', '', '2008-02-13', '1', '', '0000-00-00 00:00:00');
INSERT INTO `assignmentovertime` VALUES (161, 'F554', 'KKK1-D', '28', '2008-02-12', '', 'approved', '2008-02-13 12:51:23');
INSERT INTO `assignmentovertime` VALUES (162, 'W344', 'B666-H', '29', '2008-02-13', '', 'approved', '2008-02-13 12:51:23');
INSERT INTO `assignmentovertime` VALUES (163, 'H117', 'KKK3-N', '29', '2008-02-13', '', 'approved', '2008-02-13 12:51:23');
INSERT INTO `assignmentovertime` VALUES (164, 'H013', '', '', '2008-02-13', '4', '', '0000-00-00 00:00:00');
INSERT INTO `assignmentovertime` VALUES (165, 'W344', 'H312-D', '32', '2008-02-17', '', 'approved', '2008-02-20 07:42:37');
INSERT INTO `assignmentovertime` VALUES (166, 'W344', 'H312-D', '33', '2008-02-18', '', 'rejected', '2008-02-20 07:42:37');
INSERT INTO `assignmentovertime` VALUES (167, 'F554', '', '', '2008-02-20', '2', '', '0000-00-00 00:00:00');
INSERT INTO `assignmentovertime` VALUES (168, 'F554', '', '', '2008-03-13', '5', '', '0000-00-00 00:00:00');
INSERT INTO `assignmentovertime` VALUES (169, 'F554', '', '', '2008-03-18', '2', '', '0000-00-00 00:00:00');
INSERT INTO `assignmentovertime` VALUES (170, 'F554', '', '', '2008-03-19', '1', '', '0000-00-00 00:00:00');
INSERT INTO `assignmentovertime` VALUES (171, 'W344', 'D145-N', '35', '2008-03-13', '', 'approved', '2008-03-19 10:43:31');
INSERT INTO `assignmentovertime` VALUES (172, 'H117', 'NBL01', '35', '2008-03-13', '', 'approved', '2008-03-19 10:43:31');
INSERT INTO `assignmentovertime` VALUES (173, 'W344', 'H312-D', '40', '2008-03-18', '', 'approved', '2008-03-19 12:32:21');
INSERT INTO `assignmentovertime` VALUES (174, 'F554', 'H123', '40', '2008-03-18', '', '', '2008-03-19 12:57:33');
INSERT INTO `assignmentovertime` VALUES (175, 'J201', 'H230-D', '43', '2008-04-10', '', '', '2008-04-16 16:13:54');
INSERT INTO `assignmentovertime` VALUES (176, 'T012', '', '', '2008-04-20', '2', '', '0000-00-00 00:00:00');

-- --------------------------------------------------------

-- 
-- Table structure for table `assignmentreplacements`
-- 

CREATE TABLE `assignmentreplacements` (
  `id` bigint(20) NOT NULL auto_increment,
  `guardid` varchar(250) NOT NULL default '',
  `date` datetime NOT NULL default '0000-00-00 00:00:00',
  `date_of_entry` datetime NOT NULL default '0000-00-00 00:00:00',
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=64 DEFAULT CHARSET=latin1 AUTO_INCREMENT=64 ;

-- 
-- Dumping data for table `assignmentreplacements`
-- 

INSERT INTO `assignmentreplacements` VALUES (1, 'F554', '2008-03-26 00:00:00', '2008-01-06 00:00:00');
INSERT INTO `assignmentreplacements` VALUES (3, 'Y907', '2008-01-09 00:00:00', '2008-01-10 00:00:00');
INSERT INTO `assignmentreplacements` VALUES (4, 'F554', '2008-01-04 00:00:00', '2008-01-24 00:00:00');
INSERT INTO `assignmentreplacements` VALUES (5, 'W344', '2008-05-11 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `assignmentreplacements` VALUES (6, 'T012', '2008-04-03 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `assignmentreplacements` VALUES (7, 'H013', '2008-02-01 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `assignmentreplacements` VALUES (8, 'P0081', '2008-02-01 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `assignmentreplacements` VALUES (9, 'T012', '2008-04-16 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `assignmentreplacements` VALUES (10, 'W344', '2008-04-16 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `assignmentreplacements` VALUES (12, 'W344', '2008-04-20 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `assignmentreplacements` VALUES (23, 'F903', '2008-04-20 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `assignmentreplacements` VALUES (24, 'F554', '2008-04-20 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `assignmentreplacements` VALUES (35, 'T012', '2008-04-20 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `assignmentreplacements` VALUES (36, 'F903', '2008-04-20 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `assignmentreplacements` VALUES (37, 'W344', '2008-04-20 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `assignmentreplacements` VALUES (38, 'F554', '2008-04-20 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `assignmentreplacements` VALUES (40, 'J201', '2008-04-20 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `assignmentreplacements` VALUES (41, 'J201', '2008-04-20 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `assignmentreplacements` VALUES (42, 'J201', '2008-04-20 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `assignmentreplacements` VALUES (43, 'J201', '2008-04-20 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `assignmentreplacements` VALUES (44, 'J201', '2008-04-20 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `assignmentreplacements` VALUES (45, 'J201', '2008-04-20 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `assignmentreplacements` VALUES (46, 'J201', '2008-04-20 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `assignmentreplacements` VALUES (47, 'J201', '2008-04-20 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `assignmentreplacements` VALUES (48, 'T023', '2008-04-20 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `assignmentreplacements` VALUES (49, 'T023', '2008-04-20 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `assignmentreplacements` VALUES (50, 'T023', '2008-04-20 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `assignmentreplacements` VALUES (51, 'T023', '2008-04-20 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `assignmentreplacements` VALUES (52, 'T023', '2008-04-20 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `assignmentreplacements` VALUES (53, 'T023', '2008-04-20 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `assignmentreplacements` VALUES (54, 'T023', '2008-04-20 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `assignmentreplacements` VALUES (55, 'T023', '2008-04-20 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `assignmentreplacements` VALUES (56, 'T023', '2008-04-20 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `assignmentreplacements` VALUES (57, 'T023', '2008-04-20 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `assignmentreplacements` VALUES (58, 'T023', '2008-04-20 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `assignmentreplacements` VALUES (59, 'T023', '2008-04-20 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `assignmentreplacements` VALUES (60, 'T023', '2008-04-20 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `assignmentreplacements` VALUES (61, 'T023', '2008-04-20 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `assignmentreplacements` VALUES (62, 'T023', '2008-04-20 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `assignmentreplacements` VALUES (63, 'T023', '2008-04-20 00:00:00', '0000-00-00 00:00:00');

-- --------------------------------------------------------

-- 
-- Table structure for table `assignments`
-- 

CREATE TABLE `assignments` (
  `id` bigint(20) NOT NULL auto_increment,
  `callsign` varchar(255) NOT NULL default '',
  `client` varchar(255) default NULL,
  `region` varchar(250) NOT NULL default '',
  `directions` text NOT NULL,
  `contactname` varchar(250) NOT NULL default '',
  `contactphone` varchar(250) NOT NULL default '',
  `contactemail` varchar(250) NOT NULL default '',
  `contactfax` varchar(250) NOT NULL default '',
  `emergencyno` varchar(250) NOT NULL default '',
  `alarm` varchar(250) NOT NULL default '',
  `servicetype` varchar(250) default NULL,
  `assignedguards` varchar(255) default NULL,
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
) ENGINE=InnoDB AUTO_INCREMENT=110 DEFAULT CHARSET=latin1 AUTO_INCREMENT=110 ;

-- 
-- Dumping data for table `assignments`
-- 

INSERT INTO `assignments` VALUES (7, 'H312-D', 'Crane Bank', 'KLA-3', 'Behind the Shawuliako Market as you go to the old taxi park.', 'Shem Semambo', '0773442344', 'shem.semambo@crane.co.ug', '', '0773442344', '', 'Alarm - Intruder', '5', '', '', '1196066731', '5,46', '1,3', 'Baton6,Deployment Pickup6,Gun1,Transport van6', '08:00:00', '17:30:00', '2008-03-01', '2008-05-20', '2008-05-18,2008-05-19,2008-05-20', '11000', '2007-02-06 00:00:00', '120000', 'Y', '2008-08-22', 1, 1, '2008-08-22 14:51:08');
INSERT INTO `assignments` VALUES (9, 'H300-N', 'Crane Bank', '33', 'Behind Crane Bank', 'Patel Johns', '0783434234', '', '', '077232323', '', 'Day - shift', '2', '', '', '1196066531', '168', '6,12,36', 'Baton1,Gun1,Transport van1', '07:00:00', '18:00:00', '2008-01-19', '2008-05-23', '2008-03-14,2008-04-15,2008-06-04,2008-12-22', '7000', '2007-12-08 00:00:00', '1500000', 'Y', '2008-07-04', 1, 1, '2008-07-04 17:06:35');
INSERT INTO `assignments` VALUES (63, 'D145-N', 'Nile Breweries', 'KLA-2', '', '', '', '', '', '', '', 'Alarm - Panic', '1', '', '', '1196066731', '', '9,10', 'Baton5,Gun5,Transport van1', '18:30:00', '07:30:00', '2007-11-19', '2007-12-20', '2007-11-21,2007-11-22', '10000', '2007-08-10 00:00:00', '750000', 'Y', '2008-04-20', 1, 1, '2008-04-20 10:05:33');
INSERT INTO `assignments` VALUES (67, 'H230-D', 'Felix Holdings', 'KAS-2', '', '', '', '', '', '', '', 'Day - shift', '2', '', '', '1196066531', '164', '', 'Baton2,Gun1', '07:00:00', '18:00:00', '2008-01-19', '2008-03-31', '2008-03-19,2008-06-03', '10500', '2007-11-02 00:00:00', '1340890', 'Y', '2008-03-20', 1, 1, '2008-03-20 08:19:20');
INSERT INTO `assignments` VALUES (68, 'H457-K', 'UTL', '', '', '', '', '', '', '', '', 'Day - shift', '9', '', '', '1196066701', '', '7,8', 'Baton4,Deployment Pickup4,Gun4', '07:00:00', '18:00:00', '2008-01-26', '2009-12-02', '2008-03-17,2008-03-21', '10000', '2008-01-31 00:00:00', '3000000', 'N', '2008-03-18', 1, 1, '2008-03-18 15:11:54');
INSERT INTO `assignments` VALUES (70, 'Q444-N', 'UCB', 'KLA-3', '', '', '', '', '', '', '', 'Alarm - Intruder', '8', '', '', '1196156265', '45', '', 'Baton8,Deployment Pickup1,Gun8', '08:00:00', '17:30:00', '2008-11-26', '2008-12-02', '2008-03-19,2008-03-26', '10000', '0000-00-00 00:00:00', '', 'Y', '2008-03-19', 1, 1, '2008-03-19 10:50:12');
INSERT INTO `assignments` VALUES (71, 'KKK0-D', 'Stanbic Bank', '11', '', '', '', '', '', '', '', 'Day - shift', '1', '', '', '1196156669', '160', '', 'Baton1', '07:00:00', '18:00:00', '2008-03-01', '2008-05-14', '2008-03-27', '10000', '2008-02-10 00:00:00', '230000', 'Y', '2008-05-05', 1, 1, '2008-05-05 12:09:38');
INSERT INTO `assignments` VALUES (72, 'KKK1-D', 'Kits End International', 'KBL', 'Next to Kamwokya police station.', 'Felix Johns', '072342344', '', '', '0772345345', '', 'Both', '3', '', '', '1196156669', '39,,43', '37,38,63', 'Baton1,Gun1', '00:00:00', '07:00:00', '2008-01-26', '2010-06-08', '2008-03-19', '20000', '0000-00-00 00:00:00', '', 'Y', '2008-06-05', 1, 1, '2008-06-05 09:02:12');
INSERT INTO `assignments` VALUES (73, 'KKK3-N', 'Shark Inc.', '', '', '', '', '', '', '', '', 'Shift', '1', '', '', '1196156669', '', '', '', '06:30:00', '22:30:00', '2007-11-26', '2007-12-02', '2007-12-16', '10000', '0000-00-00 00:00:00', '', 'N', '2007-11-27', 1, 1, '2008-02-13 12:38:47');
INSERT INTO `assignments` VALUES (82, 'NBL01', 'Nile Breweries', '29', '', '', '', '', '', '', '', 'Alarm - Panic', '3', '', '', '', '47', '5', 'Baton3,Deployment Pickup1,Gun1', '', '', '2008-02-01', '2008-11-30', '1999-11-30', '10000', '2008-01-15 00:00:00', '250000', 'Y', '2008-04-16', 1, 1, '2008-04-16 14:25:05');
INSERT INTO `assignments` VALUES (83, 'NBL02', 'Nile Breweries', '29', '', '', '', '', '', '', '', 'Night - shift', '1', '', 'P0081', '', '48', '', 'Baton,Deployment Pickup', '', '', '2008-02-02', '2008-10-31', '0000-00-00', '15000', '2008-02-02 00:00:00', '20000', 'N', '2008-01-25', 1, 1, '2008-03-06 14:19:30');
INSERT INTO `assignments` VALUES (84, 'STB1', 'Stanbic Bank', '29', '', '', '', '', '', '', '', 'Day - shift', '3', '', '', '', '167', '', 'Baton5,Gun5', '07:00:00', '18:00:00', '2008-02-15', '2008-12-30', '1999-11-30', '4500', '2006-02-03 00:00:00', '', 'Y', '2008-04-20', 1, 1, '2012-06-05 05:22:57');
INSERT INTO `assignments` VALUES (85, 'utl100', 'Uganda Telecom', '11', '', '', '', '', '', '', '', 'Night - shift', '10', '', '', '', '', '', 'Baton3,Gun2', '18:00:00', '07:00:00', '2008-03-06', '2009-03-10', '1999-11-30', '7000000', '0000-00-00 00:00:00', '', 'Y', '2008-04-20', 1, 1, '2008-04-20 10:49:16');
INSERT INTO `assignments` VALUES (86, 'UT01', 'Uganda Telecom Ltd', 'KLA-1', '', '', '', '', '', '', '', 'Day - shift', '3', '', '', '', '169', '', 'Baton3,Deployment Pickup1,Gun3', '07:00:00', '18:00:00', '2008-03-09', '2008-11-30', '2008-03-19', '3400', '0000-00-00 00:00:00', '', 'Y', '2008-03-19', 1, 1, '2008-03-19 10:33:42');
INSERT INTO `assignments` VALUES (88, 'H123', 'Uganda Telecom Ltd', '39', '', '', '', '', '', '', '', 'Alarm - Intruder', '5', '', '', '', '', '', 'Baton3,Gun1,Transport van1', '08:00:00', '17:30:00', '2008-01-01', '2008-03-31', '2008-02-17', '1500', '2007-09-02 00:00:00', '120000', 'Y', '2008-04-16', 1, 1, '2008-04-16 14:24:42');
INSERT INTO `assignments` VALUES (89, 'Z123', 'Zious Holdings Ltd', 'KLA-2', '', '', '', '', '', '', '', 'Day - shift', '4', '', '', '', '', '', '', '07:00:00', '18:00:00', '2008-02-02', '2008-12-01', '0000-00-00', '', '0000-00-00 00:00:00', '', 'Y', '2008-03-19', 1, 1, '2008-03-19 10:22:53');
INSERT INTO `assignments` VALUES (90, 'Z002', 'Zious Holdings Ltd', 'MBR-1', '', '', '', '', '', '', '', 'Alarm - Intruder', '2', '', '', '', '', '', '', '08:00:00', '17:30:00', '2008-03-23', '2008-12-31', '2008-03-23', '', '0000-00-00 00:00:00', '', 'Y', '2008-03-19', 1, 1, '2008-03-19 16:10:25');
INSERT INTO `assignments` VALUES (92, 'FD21', 'Fida', 'KLA-3', '', '', '', '', '', '', '', 'Alarm - Intruder', '2', '', '', '', '', '', 'Baton2,Gun1', '08:00:00', '17:30:00', '2008-03-02', '2008-05-10', '2008-03-17', '', '0000-00-00 00:00:00', '', 'Y', '2008-03-28', 1, 1, '2008-03-28 11:23:55');
INSERT INTO `assignments` VALUES (93, 'S4B1', 'S4B', 'KLA-2', 'Behind CPS and the main building.', 'Telman', '0923434', '', '', '08234324', '', 'Alarm - Intruder/Panic', '0', '', '', '', '176', '23,24,35', 'Baton1,Gun1,Transport van1', '18:30:00', '07:30:00', '2008-05-01', '2010-01-02', '1999-11-30', '', '0000-00-00 00:00:00', '', 'Y', '2008-07-04', 1, 1, '2008-07-04 17:09:37');
INSERT INTO `assignments` VALUES (97, 'F903', 'Fida', 'KLA-1', 'Behind fidodido at the bugolobi flats', 'Kintu  Musoke', '08892343', 'mkintu@fida.org', '0414890982', '077234345', '', 'Alarm - Intruder', '1', '', '', '', '', '', 'Baton1,Gun1', '00:30:00', '07:00:00', '2008-02-02', '2008-11-30', '2008-11-06', '', '0000-00-00 00:00:00', '', 'Y', '2008-05-05', 1, 1, '2008-05-05 16:12:20');
INSERT INTO `assignments` VALUES (103, 'UT004', 'Uganda Telecom Ltd', 'KLA-2', 'As you go to Bulange Mengo Palace mid way to the palace.', 'Tinka Michael', '0788293441', 't_michael@utl.co.ug', '0414890982', '077234345', '', 'Day - shift', '5', '', '', '', '', '', 'Baton1,Gun1', '07:00:00', '18:00:00', '2008-02-18', '0000-00-00', '2008-07-04', '', '0000-00-00 00:00:00', '', 'Y', '2008-07-04', 1, 1, '2008-07-04 17:13:32');
INSERT INTO `assignments` VALUES (104, 'K4232', 'Shark Inc.', 'KLA-2', 'Behind the American Embassy', 'Tinka Samuel', '024234324324', '', '', '07723434534', '', 'Alarm - Panic', '1', '', '', '', '', '', 'Baton1', '08:30:00', '24:00:00', '2008-02-18', '2008-03-18', '', '3490', '0000-00-00 00:00:00', '', 'Y', '2008-05-09', 1, 1, '2008-06-04 13:08:09');
INSERT INTO `assignments` VALUES (105, 'T903', 'Tallon Holdings Limited', 'KLA-4', 'Behind Cineplex Garden City', 'Tink Musinguzi', '09888777', 'tmusinguzi@tallon.com', '', '900988776', '', 'Alarm - Panic', '1', '', '', '', '', '', 'Baton1,Radio1', '04:30:00', '19:30:00', '2008-01-14', '2010-12-14', '', '', '0000-00-00 00:00:00', '', 'Y', '2008-05-20', 1, 1, '2008-05-20 11:03:55');
INSERT INTO `assignments` VALUES (106, 'Z890', 'Zziwa International Inc.', 'KLA-1', 'Behind CPS as you go to YWCA.', 'Almond Zious', '0772333233', 'azious@zziwaint.com', '', '041222339', '', 'Alarm - Intruder', '0', '', '', '', '', '', '', '08:00:00', '17:30:00', '2008-02-03', '2008-09-04', '', '', '0000-00-00 00:00:00', '', 'Y', '2008-07-04', 1, 1, '2008-07-04 17:07:50');
INSERT INTO `assignments` VALUES (107, 'U890', 'Uganda Telecom Ltd', 'KLA-1', 'Behind the Crane Bank main branch, you go to your right and then left in the furthest corner.', 'John Templeton', '0712324344', 'j.tepleton@utl.co.ug', '', '0771231332', '', 'Alarm - Intruder', '0', '', '', '', '', '', '', '08:00:00', '17:30:00', '2008-02-03', '2009-01-03', '', '', '0000-00-00 00:00:00', '', 'Y', '2008-07-01', 1, 1, '2008-07-01 10:51:28');
INSERT INTO `assignments` VALUES (108, 'Test', 'Stanbic Bank', 'KLA-1', 'Kampala road, near Bank if Uganda', 'Tester', '0000000', '', '', '999', '', 'Weekend - shift', '2', '', '', '', '', '', 'Baton1,Deployment Pickup1,Electronics1,Gun1,Radio1,Transport van1', '', '18:00:00', '2012-06-01', '2012-07-02', '', '', '0000-00-00 00:00:00', '', 'Y', '2012-06-05', 1, 1, '2012-06-05 10:10:00');
INSERT INTO `assignments` VALUES (109, 'A12', 'Uganda Telecom Ltd', 'KBL', 'Behind Shell Jinja Rd', 'Mr. James Tonny', '0712334455', 'jt@utl.co.ug', '', '123', '', 'Alarm - Panic', '4', '', '', '', '', '', 'Baton1,Deployment Pickup1', '09:00:00', '01:00:00', '2012-01-01', '2014-01-16', '2012-02-07', '', '0000-00-00 00:00:00', '', 'Y', '2012-09-10', 1, 1, '2012-09-10 05:13:05');

-- --------------------------------------------------------

-- 
-- Table structure for table `assignmentseparations`
-- 

CREATE TABLE `assignmentseparations` (
  `id` bigint(20) NOT NULL auto_increment,
  `assgnfrom` varchar(250) NOT NULL default '',
  `assgnto` varchar(250) NOT NULL default '',
  `distance` varchar(250) NOT NULL default '',
  `description` text NOT NULL,
  `date_of_entry` datetime NOT NULL default '0000-00-00 00:00:00',
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

-- 
-- Dumping data for table `assignmentseparations`
-- 

INSERT INTO `assignmentseparations` VALUES (1, 'utl100', 'NBL01', '34', 'Along Kira road as you pass by the old by pass again.', '2008-06-05 11:13:55');
INSERT INTO `assignmentseparations` VALUES (2, 'FD21', 'STB1', '30', 'You have to go through the Mukwano by pass to dodge traffic all the time.', '2008-06-05 11:20:18');
INSERT INTO `assignmentseparations` VALUES (4, 'Z123', 'T903', '4', 'There are humps between the two so take note.', '2008-06-05 11:47:50');

-- --------------------------------------------------------

-- 
-- Table structure for table `audittrail`
-- 

CREATE TABLE `audittrail` (
  `id` bigint(20) NOT NULL auto_increment,
  `username` varchar(255) NOT NULL default '',
  `workStation` varchar(255) NOT NULL default '',
  `page_Visited` text NOT NULL,
  `time_Visited` datetime NOT NULL default '0000-00-00 00:00:00',
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1517 DEFAULT CHARSET=latin1 AUTO_INCREMENT=1517 ;

-- 
-- Dumping data for table `audittrail`
-- 

INSERT INTO `audittrail` VALUES (1, 'Username', '127.0.0.1', 'http://localhost/guardsecure/core/dashboard.php', '2010-09-27 20:10:57');
INSERT INTO `audittrail` VALUES (2, 'admin', '127.0.0.1', 'http://localhost/guardsecure/core/dashboard.php', '2010-09-27 20:11:09');
INSERT INTO `audittrail` VALUES (3, 'admin', '127.0.0.1', 'http://localhost/guardsecure/hr/manageguards.php', '2010-09-27 20:11:18');
INSERT INTO `audittrail` VALUES (4, 'admin', '127.0.0.1', 'http://localhost/guardsecure/core/dashboard.php', '2010-09-27 20:11:23');
INSERT INTO `audittrail` VALUES (5, 'admin', '127.0.0.1', 'http://localhost/guardsecure/finance/manageguardfinance.php', '2010-09-27 20:11:25');
INSERT INTO `audittrail` VALUES (6, 'admin', '127.0.0.1', 'http://localhost/guardsecure/core/dashboard.php', '2010-09-27 20:11:29');
INSERT INTO `audittrail` VALUES (7, 'admin', '127.0.0.1', 'http://localhost/guardsecure/hr/managepersonnel.php', '2010-09-27 20:11:34');
INSERT INTO `audittrail` VALUES (8, 'admin', '127.0.0.1', 'http://localhost/guardsecure/core/dashboard.php', '2010-09-27 20:11:36');
INSERT INTO `audittrail` VALUES (9, 'admin', '127.0.0.1', 'http://localhost/guardsecure/help/addsection.php', '2010-09-27 20:11:50');
INSERT INTO `audittrail` VALUES (10, 'admin', '127.0.0.1', 'http://localhost/guardsecure/core/dashboard.php', '2010-09-27 20:11:53');
INSERT INTO `audittrail` VALUES (11, 'admin', '127.0.0.1', 'http://localhost/guardsecure/settings/index.php', '2010-09-27 20:12:05');
INSERT INTO `audittrail` VALUES (12, 'admin', '127.0.0.1', 'http://localhost/guardsecure/core/dashboard.php', '2010-09-27 20:12:08');
INSERT INTO `audittrail` VALUES (13, '', '127.0.0.1', 'http://localhost/guardsecure/core/dashboard.php', '2010-10-01 08:28:39');
INSERT INTO `audittrail` VALUES (14, '', '127.0.0.1', 'http://localhost/guardsecure/core/dashboard.php', '2010-10-04 11:37:49');
INSERT INTO `audittrail` VALUES (15, '', '127.0.0.1', 'http://localhost/guardsecure/core/dashboard.php', '2010-10-04 12:39:24');
INSERT INTO `audittrail` VALUES (16, '', '127.0.0.1', 'http://localhost/guardsecure/core/dashboard.php', '2010-10-06 14:03:58');
INSERT INTO `audittrail` VALUES (17, '', '127.0.0.1', 'http://localhost/guardsecure/core/dashboard.php', '2010-10-15 17:34:41');
INSERT INTO `audittrail` VALUES (18, 'admin', '127.0.0.1', 'http://localhost/guardsecure/core/dashboard.php', '2010-10-15 17:35:25');
INSERT INTO `audittrail` VALUES (19, 'admin', '127.0.0.1', 'http://localhost/guardsecure/hr/manageguards.php', '2010-10-15 17:35:28');
INSERT INTO `audittrail` VALUES (20, 'admin', '127.0.0.1', 'http://localhost/guardsecure/core/dashboard.php', '2010-10-15 17:35:30');
INSERT INTO `audittrail` VALUES (21, 'admin', '127.0.0.1', 'http://localhost/guardsecure/core/manageusers.php', '2010-10-15 17:35:31');
INSERT INTO `audittrail` VALUES (22, 'admin', '127.0.0.1', 'http://localhost/guardsecure/core/user.php', '2010-10-15 17:35:35');
INSERT INTO `audittrail` VALUES (23, 'admin', '127.0.0.1', 'http://localhost/guardsecure/core/dashboard.php', '2010-10-15 17:35:37');
INSERT INTO `audittrail` VALUES (24, 'admin', '127.0.0.1', 'http://localhost/guardsecure/hr/manageguards.php', '2010-10-15 17:35:46');
INSERT INTO `audittrail` VALUES (25, 'admin', '127.0.0.1', 'http://localhost/guardsecure/hr/index.php', '2010-10-15 17:35:47');
INSERT INTO `audittrail` VALUES (26, '', '127.0.0.1', 'http://localhost/guardsecure/core/dashboard.php', '2010-10-21 15:02:17');
INSERT INTO `audittrail` VALUES (27, '', '127.0.0.1', 'http://localhost/guardsecure/core/dashboard.php', '2010-11-11 12:11:49');
INSERT INTO `audittrail` VALUES (28, 'admin', '127.0.0.1', 'http://localhost/guardsecure/core/dashboard.php', '2010-11-11 12:13:30');
INSERT INTO `audittrail` VALUES (29, 'admin', '127.0.0.1', 'http://localhost/guardsecure/hr/manageguards.php', '2010-11-11 12:13:45');
INSERT INTO `audittrail` VALUES (30, 'admin', '127.0.0.1', 'http://localhost/guardsecure/hr/index.php', '2010-11-11 12:13:47');
INSERT INTO `audittrail` VALUES (31, '', '127.0.0.1', 'http://localhost/guardsecure/core/dashboard.php', '2011-01-20 09:44:59');
INSERT INTO `audittrail` VALUES (32, '', '127.0.0.1', 'http://localhost/guardsecure/core/dashboard.php', '2011-01-20 09:56:12');
INSERT INTO `audittrail` VALUES (33, 'admin', '127.0.0.1', 'http://localhost/guardsecure/core/dashboard.php', '2011-01-20 09:56:18');
INSERT INTO `audittrail` VALUES (34, 'admin', '127.0.0.1', 'http://localhost/guardsecure/finance/manageguardfinance.php', '2011-01-20 10:07:23');
INSERT INTO `audittrail` VALUES (35, '', '127.0.0.1', 'http://localhost/guardsecure/core/dashboard.php', '2011-03-07 12:50:17');
INSERT INTO `audittrail` VALUES (36, '', '127.0.0.1', 'http://localhost/guardsecure/core/dashboard.php', '2011-03-17 17:47:37');
INSERT INTO `audittrail` VALUES (37, '', '127.0.0.1', 'http://localhost/guardsecure/core/dashboard.php', '2011-04-20 15:16:51');
INSERT INTO `audittrail` VALUES (38, '', '127.0.0.1', 'http://localhost/guardsecure/core/dashboard.php', '2011-07-22 18:26:32');
INSERT INTO `audittrail` VALUES (39, '', '192.168.0.17', 'http://acrav/guardsecure/core/dashboard.php', '2011-10-27 18:12:07');
INSERT INTO `audittrail` VALUES (40, '', '127.0.0.1', 'http://localhost/guardsecure/core/dashboard.php', '2012-03-21 11:23:56');
INSERT INTO `audittrail` VALUES (41, '', '127.0.0.1', 'http://localhost/guardsecure/core/dashboard.php', '2012-05-28 17:11:44');
INSERT INTO `audittrail` VALUES (42, '', '127.0.0.1', 'http://localhost/guardsecure/core/dashboard.php', '2012-05-28 17:21:57');
INSERT INTO `audittrail` VALUES (43, 'admin', '127.0.0.1', 'http://localhost/guardsecure/core/dashboard.php', '2012-05-28 17:41:15');
INSERT INTO `audittrail` VALUES (44, 'admin', '127.0.0.1', 'http://localhost/guardsecure/hr/leave.php', '2012-05-28 17:44:17');
INSERT INTO `audittrail` VALUES (45, 'admin', '127.0.0.1', 'http://localhost/guardsecure/core/dashboard.php', '2012-05-28 17:44:26');
INSERT INTO `audittrail` VALUES (46, '', '196.0.21.52', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-05-29 02:49:54');
INSERT INTO `audittrail` VALUES (47, 'admin', '196.0.21.52', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-05-29 04:04:53');
INSERT INTO `audittrail` VALUES (48, 'admin', '196.0.21.52', 'http://guardsecure.newwavetech.co.ug/finance/managerates.php', '2012-05-29 04:05:37');
INSERT INTO `audittrail` VALUES (49, 'admin', '196.0.21.52', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-05-29 04:06:08');
INSERT INTO `audittrail` VALUES (50, 'admin', '196.0.21.52', 'http://guardsecure.newwavetech.co.ug/settings/settings.php', '2012-05-29 04:06:29');
INSERT INTO `audittrail` VALUES (51, '', '212.88.100.70', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-05-29 04:10:05');
INSERT INTO `audittrail` VALUES (52, 'admin', '212.88.100.70', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-05-29 04:10:19');
INSERT INTO `audittrail` VALUES (53, 'admin', '212.88.100.70', 'http://guardsecure.newwavetech.co.ug/finance/report.php?f=Client%20Invoice', '2012-05-29 04:10:58');
INSERT INTO `audittrail` VALUES (54, 'admin', '212.88.100.70', 'http://guardsecure.newwavetech.co.ug/finance/report.php', '2012-05-29 04:11:53');
INSERT INTO `audittrail` VALUES (55, 'admin', '212.88.100.70', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-05-29 04:15:17');
INSERT INTO `audittrail` VALUES (56, 'admin', '212.88.100.70', 'http://guardsecure.newwavetech.co.ug/core/manageclients.php', '2012-05-29 04:15:23');
INSERT INTO `audittrail` VALUES (57, 'admin', '212.88.100.70', 'http://guardsecure.newwavetech.co.ug/core/client.php?action=edit&id=MTM=', '2012-05-29 04:15:44');
INSERT INTO `audittrail` VALUES (58, 'admin', '212.88.100.70', 'http://guardsecure.newwavetech.co.ug/core/manageclients.php', '2012-05-29 04:16:10');
INSERT INTO `audittrail` VALUES (59, 'admin', '212.88.100.70', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-05-29 04:16:18');
INSERT INTO `audittrail` VALUES (60, 'admin', '212.88.100.70', 'http://guardsecure.newwavetech.co.ug/core/guardreport.php?f=Guard%20Daily%20Schedule', '2012-05-29 04:16:26');
INSERT INTO `audittrail` VALUES (61, 'admin', '212.88.100.70', 'http://guardsecure.newwavetech.co.ug/operations/report.php?f=Control%20Shift', '2012-05-29 04:16:36');
INSERT INTO `audittrail` VALUES (62, 'admin', '212.88.100.70', 'http://guardsecure.newwavetech.co.ug/core/guardreport.php?f=Item%20Location', '2012-05-29 04:16:50');
INSERT INTO `audittrail` VALUES (63, 'admin', '212.88.100.70', 'http://guardsecure.newwavetech.co.ug/core/guardreport.php', '2012-05-29 04:17:03');
INSERT INTO `audittrail` VALUES (64, 'admin', '212.88.100.70', 'http://guardsecure.newwavetech.co.ug/core/guardreport.php', '2012-05-29 04:17:21');
INSERT INTO `audittrail` VALUES (65, 'admin', '41.210.129.19', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-05-29 04:33:09');
INSERT INTO `audittrail` VALUES (66, 'admin', '41.210.129.19', 'http://guardsecure.newwavetech.co.ug/operations/sitreps.php', '2012-05-29 04:33:59');
INSERT INTO `audittrail` VALUES (67, 'admin', '41.210.129.19', 'http://guardsecure.newwavetech.co.ug/operations/sitreps.php', '2012-05-29 04:34:43');
INSERT INTO `audittrail` VALUES (68, 'admin', '41.210.129.19', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-05-29 04:34:50');
INSERT INTO `audittrail` VALUES (69, 'admin', '41.210.129.19', 'http://guardsecure.newwavetech.co.ug/transport/index.php', '2012-05-29 04:35:55');
INSERT INTO `audittrail` VALUES (70, 'admin', '41.210.129.19', 'http://guardsecure.newwavetech.co.ug/transport/vehiclelog.php', '2012-05-29 04:36:14');
INSERT INTO `audittrail` VALUES (71, 'admin', '41.210.129.19', 'http://guardsecure.newwavetech.co.ug/transport/index.php?logdate=2012-05-29', '2012-05-29 04:37:41');
INSERT INTO `audittrail` VALUES (72, 'admin', '41.210.129.19', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-05-29 04:38:28');
INSERT INTO `audittrail` VALUES (73, 'admin', '41.210.129.19', 'http://guardsecure.newwavetech.co.ug/hr/periodofservice.php', '2012-05-29 04:39:14');
INSERT INTO `audittrail` VALUES (74, 'admin', '41.210.129.19', 'http://guardsecure.newwavetech.co.ug/hr/manageguards.php', '2012-05-29 04:39:57');
INSERT INTO `audittrail` VALUES (75, 'admin', '41.210.129.19', 'http://guardsecure.newwavetech.co.ug/hr/managepersonnel.php?id=NDU1Rg==', '2012-05-29 04:40:27');
INSERT INTO `audittrail` VALUES (76, 'admin', '41.210.129.19', 'http://guardsecure.newwavetech.co.ug/hr/personnel.php?action=edit&id=Ng==', '2012-05-29 04:40:39');
INSERT INTO `audittrail` VALUES (77, 'admin', '41.210.129.19', 'http://guardsecure.newwavetech.co.ug/hr/managepersonnel.php', '2012-05-29 04:41:49');
INSERT INTO `audittrail` VALUES (78, 'admin', '41.210.129.19', 'http://guardsecure.newwavetech.co.ug/hr/managepersonnel.php?id=MjEwVA==', '2012-05-29 04:42:01');
INSERT INTO `audittrail` VALUES (79, 'admin', '41.210.129.19', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-05-29 04:50:31');
INSERT INTO `audittrail` VALUES (80, 'admin', '41.210.129.19', 'http://guardsecure.newwavetech.co.ug/inventory/manageitempurchases.php', '2012-05-29 04:53:47');
INSERT INTO `audittrail` VALUES (81, 'admin', '41.210.129.19', 'http://guardsecure.newwavetech.co.ug/inventory/itempurchases.php', '2012-05-29 04:54:10');
INSERT INTO `audittrail` VALUES (82, 'admin', '41.210.129.19', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-05-29 04:54:51');
INSERT INTO `audittrail` VALUES (83, 'admin', '41.210.129.19', 'http://guardsecure.newwavetech.co.ug/finance/report.php?f=Guard%20Payroll', '2012-05-29 05:03:17');
INSERT INTO `audittrail` VALUES (84, 'admin', '41.221.93.229', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-05-29 05:06:22');
INSERT INTO `audittrail` VALUES (85, 'admin', '41.221.93.229', 'http://guardsecure.newwavetech.co.ug/hr/manageguards.php', '2012-05-29 05:07:21');
INSERT INTO `audittrail` VALUES (86, 'admin', '41.221.93.229', 'http://guardsecure.newwavetech.co.ug/hr/index.php', '2012-05-29 05:07:30');
INSERT INTO `audittrail` VALUES (87, 'admin', '41.221.93.229', 'http://guardsecure.newwavetech.co.ug/hr/manageguards.php', '2012-05-29 05:08:12');
INSERT INTO `audittrail` VALUES (88, 'admin', '41.221.93.229', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-05-29 05:08:29');
INSERT INTO `audittrail` VALUES (89, 'admin', '41.221.93.229', 'http://guardsecure.newwavetech.co.ug/core/manageusers.php', '2012-05-29 05:08:34');
INSERT INTO `audittrail` VALUES (90, 'admin', '41.221.93.229', 'http://guardsecure.newwavetech.co.ug/core/user.php', '2012-05-29 05:08:40');
INSERT INTO `audittrail` VALUES (91, 'admin', '41.221.93.229', 'http://guardsecure.newwavetech.co.ug/core/manageusers.php', '2012-05-29 05:08:49');
INSERT INTO `audittrail` VALUES (92, 'admin', '41.221.93.229', 'http://guardsecure.newwavetech.co.ug/core/manageusers.php?v=sam', '2012-05-29 05:09:38');
INSERT INTO `audittrail` VALUES (93, 'admin', '41.221.93.229', 'http://guardsecure.newwavetech.co.ug/core/user.php', '2012-05-29 05:11:59');
INSERT INTO `audittrail` VALUES (94, 'admin', '41.221.93.229', 'http://guardsecure.newwavetech.co.ug/core/manageusers.php', '2012-05-29 05:12:50');
INSERT INTO `audittrail` VALUES (95, 'eisahm', '41.221.93.229', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-05-29 05:13:05');
INSERT INTO `audittrail` VALUES (96, 'eisahm', '41.221.93.229', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-05-29 05:13:21');
INSERT INTO `audittrail` VALUES (97, 'admin', '41.221.93.229', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-05-29 05:13:36');
INSERT INTO `audittrail` VALUES (98, 'admin', '41.221.93.229', 'http://guardsecure.newwavetech.co.ug/core/manageusers.php', '2012-05-29 05:23:12');
INSERT INTO `audittrail` VALUES (99, 'admin', '41.221.93.229', 'http://guardsecure.newwavetech.co.ug/core/user.php', '2012-05-29 05:23:15');
INSERT INTO `audittrail` VALUES (100, 'admin', '41.221.93.229', 'http://guardsecure.newwavetech.co.ug/core/manageusers.php', '2012-05-29 05:23:49');
INSERT INTO `audittrail` VALUES (101, 'tiger', '41.221.93.229', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-05-29 05:24:01');
INSERT INTO `audittrail` VALUES (102, '', '196.0.21.52', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-06-04 02:31:48');
INSERT INTO `audittrail` VALUES (103, 'admin', '196.0.21.52', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-06-04 02:33:09');
INSERT INTO `audittrail` VALUES (104, 'admin', '196.0.21.52', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-06-04 04:10:14');
INSERT INTO `audittrail` VALUES (105, '', '196.0.21.52', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-06-04 04:10:34');
INSERT INTO `audittrail` VALUES (106, '', '196.0.21.52', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-06-05 03:55:14');
INSERT INTO `audittrail` VALUES (107, '', '41.221.93.229', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-06-05 05:18:38');
INSERT INTO `audittrail` VALUES (108, 'admin', '41.221.93.229', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-06-05 05:19:04');
INSERT INTO `audittrail` VALUES (109, 'admin', '41.221.93.229', 'http://guardsecure.newwavetech.co.ug/hr/manageguards.php', '2012-06-05 05:19:25');
INSERT INTO `audittrail` VALUES (110, 'admin', '41.221.93.229', 'http://guardsecure.newwavetech.co.ug/hr/index.php?id=OTM=&a=view', '2012-06-05 05:19:42');
INSERT INTO `audittrail` VALUES (111, 'admin', '41.221.93.229', 'http://guardsecure.newwavetech.co.ug/hr/managepersonnel.php?id=OTkzUw==', '2012-06-05 05:20:19');
INSERT INTO `audittrail` VALUES (112, 'admin', '41.221.93.229', 'http://guardsecure.newwavetech.co.ug/hr/personnel.php', '2012-06-05 05:20:24');
INSERT INTO `audittrail` VALUES (113, 'admin', '41.221.93.229', 'http://guardsecure.newwavetech.co.ug/hr/managepersonnel.php', '2012-06-05 05:21:21');
INSERT INTO `audittrail` VALUES (114, 'admin', '41.221.93.229', 'http://guardsecure.newwavetech.co.ug/hr/managepersonnel.php?id=NDU1Rg==', '2012-06-05 05:21:40');
INSERT INTO `audittrail` VALUES (115, 'admin', '41.221.93.229', 'http://guardsecure.newwavetech.co.ug/hr/manageguards.php', '2012-06-05 05:21:51');
INSERT INTO `audittrail` VALUES (116, 'admin', '41.221.93.229', 'http://guardsecure.newwavetech.co.ug/hr/managepersonnel.php?id=MzIwVA==', '2012-06-05 05:22:00');
INSERT INTO `audittrail` VALUES (117, 'admin', '41.221.93.229', 'http://guardsecure.newwavetech.co.ug/hr/manageguards.php', '2012-06-05 05:22:05');
INSERT INTO `audittrail` VALUES (118, 'admin', '41.221.93.229', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-06-05 05:22:12');
INSERT INTO `audittrail` VALUES (119, 'admin', '41.221.93.229', 'http://guardsecure.newwavetech.co.ug/finance/managerates.php', '2012-06-05 05:22:21');
INSERT INTO `audittrail` VALUES (120, 'admin', '41.221.93.229', 'http://guardsecure.newwavetech.co.ug/finance/rates.php', '2012-06-05 05:22:44');
INSERT INTO `audittrail` VALUES (121, 'admin', '41.221.93.229', 'http://guardsecure.newwavetech.co.ug/finance/rates.php', '2012-06-05 05:22:57');
INSERT INTO `audittrail` VALUES (122, 'admin', '41.221.93.229', 'http://guardsecure.newwavetech.co.ug/finance/rates.php', '2012-06-05 05:23:03');
INSERT INTO `audittrail` VALUES (123, 'admin', '41.221.93.229', 'http://guardsecure.newwavetech.co.ug/finance/rates.php', '2012-06-05 05:23:09');
INSERT INTO `audittrail` VALUES (124, 'admin', '41.221.93.229', 'http://guardsecure.newwavetech.co.ug/finance/managerates.php', '2012-06-05 05:23:24');
INSERT INTO `audittrail` VALUES (125, 'admin', '41.221.93.229', 'http://guardsecure.newwavetech.co.ug/finance/rates.php', '2012-06-05 05:23:35');
INSERT INTO `audittrail` VALUES (126, 'admin', '41.221.93.229', 'http://guardsecure.newwavetech.co.ug/finance/rates.php', '2012-06-05 05:23:43');
INSERT INTO `audittrail` VALUES (127, 'admin', '41.221.93.229', 'http://guardsecure.newwavetech.co.ug/finance/managerates.php', '2012-06-05 05:23:50');
INSERT INTO `audittrail` VALUES (128, 'admin', '41.221.93.229', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-06-05 05:24:05');
INSERT INTO `audittrail` VALUES (129, 'admin', '41.221.93.229', 'http://guardsecure.newwavetech.co.ug/settings/settings.php', '2012-06-05 05:24:10');
INSERT INTO `audittrail` VALUES (130, 'admin', '41.221.93.229', 'http://guardsecure.newwavetech.co.ug/finance/manageguardfinance.php', '2012-06-05 05:24:13');
INSERT INTO `audittrail` VALUES (131, 'admin', '41.221.93.229', 'http://guardsecure.newwavetech.co.ug/finance/manageguardfinance.php', '2012-06-05 05:24:42');
INSERT INTO `audittrail` VALUES (132, 'admin', '41.221.93.229', 'http://guardsecure.newwavetech.co.ug/settings/payeformula.php', '2012-06-05 05:24:59');
INSERT INTO `audittrail` VALUES (133, 'admin', '41.221.93.229', 'http://guardsecure.newwavetech.co.ug/settings/settings.php', '2012-06-05 05:25:43');
INSERT INTO `audittrail` VALUES (134, 'admin', '41.221.93.229', 'http://guardsecure.newwavetech.co.ug/settings/settings.php', '2012-06-05 05:26:58');
INSERT INTO `audittrail` VALUES (135, 'admin', '41.221.93.229', 'http://guardsecure.newwavetech.co.ug/core/managefinancecategories.php', '2012-06-05 05:27:06');
INSERT INTO `audittrail` VALUES (136, 'admin', '41.221.93.229', 'http://guardsecure.newwavetech.co.ug/settings/settings.php', '2012-06-05 05:27:15');
INSERT INTO `audittrail` VALUES (137, 'admin', '41.221.93.229', 'http://guardsecure.newwavetech.co.ug/core/managesuppliers.php', '2012-06-05 05:27:25');
INSERT INTO `audittrail` VALUES (138, 'admin', '41.221.93.229', 'http://guardsecure.newwavetech.co.ug/settings/settings.php', '2012-06-05 05:27:33');
INSERT INTO `audittrail` VALUES (139, 'admin', '41.221.93.229', 'http://guardsecure.newwavetech.co.ug/core/managedistricts.php', '2012-06-05 05:27:39');
INSERT INTO `audittrail` VALUES (140, 'admin', '41.221.93.229', 'http://guardsecure.newwavetech.co.ug/settings/settings.php', '2012-06-05 05:27:43');
INSERT INTO `audittrail` VALUES (141, 'admin', '41.221.93.229', 'http://guardsecure.newwavetech.co.ug/core/manageservicetypes.php', '2012-06-05 05:27:51');
INSERT INTO `audittrail` VALUES (142, 'admin', '41.221.93.229', 'http://guardsecure.newwavetech.co.ug/settings/settings.php', '2012-06-05 05:28:00');
INSERT INTO `audittrail` VALUES (143, 'admin', '41.221.93.229', 'http://guardsecure.newwavetech.co.ug/core/managegroups.php', '2012-06-05 05:28:09');
INSERT INTO `audittrail` VALUES (144, 'admin', '41.221.93.229', 'http://guardsecure.newwavetech.co.ug/core/manageusers.php?a=search&groupid=Mjg=', '2012-06-05 05:28:45');
INSERT INTO `audittrail` VALUES (145, 'admin', '41.221.93.229', 'http://guardsecure.newwavetech.co.ug/settings/settings.php', '2012-06-05 05:28:57');
INSERT INTO `audittrail` VALUES (146, 'admin', '41.221.93.229', 'http://guardsecure.newwavetech.co.ug/core/managedepartments.php', '2012-06-05 05:29:06');
INSERT INTO `audittrail` VALUES (147, 'admin', '41.221.93.229', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-06-05 05:29:14');
INSERT INTO `audittrail` VALUES (148, '', '196.0.21.52', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-06-05 09:46:03');
INSERT INTO `audittrail` VALUES (149, 'tiger', '196.0.21.52', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-06-05 09:46:25');
INSERT INTO `audittrail` VALUES (150, 'admin', '196.0.21.52', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-06-05 09:46:50');
INSERT INTO `audittrail` VALUES (151, 'admin', '196.0.21.52', 'http://guardsecure.newwavetech.co.ug/hr/manageguards.php', '2012-06-05 09:47:15');
INSERT INTO `audittrail` VALUES (152, 'admin', '196.0.21.52', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-06-05 09:48:01');
INSERT INTO `audittrail` VALUES (153, 'admin', '196.0.21.52', 'http://guardsecure.newwavetech.co.ug/core/manageclients.php', '2012-06-05 09:48:06');
INSERT INTO `audittrail` VALUES (154, 'admin', '196.0.21.52', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-06-05 09:48:40');
INSERT INTO `audittrail` VALUES (155, 'admin', '196.0.21.52', 'http://guardsecure.newwavetech.co.ug/core/manageusers.php', '2012-06-05 09:48:44');
INSERT INTO `audittrail` VALUES (156, 'admin', '196.0.21.52', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-06-05 09:49:07');
INSERT INTO `audittrail` VALUES (157, 'admin', '196.0.21.52', 'http://guardsecure.newwavetech.co.ug/finance/manageguardloans.php', '2012-06-05 09:49:12');
INSERT INTO `audittrail` VALUES (158, 'admin', '196.0.21.52', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-06-05 09:49:35');
INSERT INTO `audittrail` VALUES (159, 'admin', '196.0.21.52', 'http://guardsecure.newwavetech.co.ug/hr/manageleave.php', '2012-06-05 09:49:41');
INSERT INTO `audittrail` VALUES (160, 'admin', '196.0.21.52', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-06-05 09:49:58');
INSERT INTO `audittrail` VALUES (161, 'admin', '196.0.21.52', 'http://guardsecure.newwavetech.co.ug/hr/managepromotions.php', '2012-06-05 09:50:09');
INSERT INTO `audittrail` VALUES (162, 'admin', '196.0.21.52', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-06-05 09:55:27');
INSERT INTO `audittrail` VALUES (163, 'admin', '196.0.21.52', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-06-05 10:01:27');
INSERT INTO `audittrail` VALUES (164, 'admin', '212.88.100.70', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-06-05 10:06:55');
INSERT INTO `audittrail` VALUES (165, 'admin', '212.88.100.70', 'http://guardsecure.newwavetech.co.ug/core/manageassignments.php', '2012-06-05 10:07:05');
INSERT INTO `audittrail` VALUES (166, 'admin', '212.88.100.70', 'http://guardsecure.newwavetech.co.ug/core/assignment.php', '2012-06-05 10:07:40');
INSERT INTO `audittrail` VALUES (167, 'admin', '212.88.100.70', 'http://guardsecure.newwavetech.co.ug/core/manageassignments.php', '2012-06-05 10:10:01');
INSERT INTO `audittrail` VALUES (168, 'admin', '212.88.100.70', 'http://guardsecure.newwavetech.co.ug/core/generatetwo.php?id=108&t=ZHJhdWc=', '2012-06-05 10:10:08');
INSERT INTO `audittrail` VALUES (169, '', '196.0.21.52', 'http://guardsecure.newwavetech.co.ug/core/generatetwo.php?id=108&t=ZHJhdWc=', '2012-06-05 10:29:28');
INSERT INTO `audittrail` VALUES (170, 'admin', '196.0.21.52', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-06-05 10:29:57');
INSERT INTO `audittrail` VALUES (171, 'admin', '212.88.100.70', 'http://guardsecure.newwavetech.co.ug/core/manageassignments.php', '2012-06-06 01:54:15');
INSERT INTO `audittrail` VALUES (172, 'admin', '212.88.100.70', 'http://guardsecure.newwavetech.co.ug/settings/settings.php', '2012-06-06 01:54:22');
INSERT INTO `audittrail` VALUES (173, 'admin', '212.88.100.70', 'http://guardsecure.newwavetech.co.ug/core/viewuser.php?id=MQ==', '2012-06-06 01:54:31');
INSERT INTO `audittrail` VALUES (174, 'admin', '212.88.100.70', 'http://guardsecure.newwavetech.co.ug/settings/settings.php', '2012-06-06 01:54:38');
INSERT INTO `audittrail` VALUES (175, 'admin', '212.88.100.70', 'http://guardsecure.newwavetech.co.ug/core/favorites.php', '2012-06-06 01:54:42');
INSERT INTO `audittrail` VALUES (176, 'admin', '212.88.100.70', 'http://guardsecure.newwavetech.co.ug/core/favorites.php?t=1', '2012-06-06 01:54:49');
INSERT INTO `audittrail` VALUES (177, 'admin', '212.88.100.70', 'http://guardsecure.newwavetech.co.ug/core/favorites.php', '2012-06-06 01:54:53');
INSERT INTO `audittrail` VALUES (178, 'admin', '212.88.100.70', 'http://guardsecure.newwavetech.co.ug/settings/settings.php', '2012-06-06 01:55:02');
INSERT INTO `audittrail` VALUES (179, 'admin', '212.88.100.70', 'http://guardsecure.newwavetech.co.ug/core/manageservicetypes.php', '2012-06-06 01:55:27');
INSERT INTO `audittrail` VALUES (180, 'admin', '212.88.100.70', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-06-06 01:55:33');
INSERT INTO `audittrail` VALUES (181, 'admin', '212.88.100.70', 'http://guardsecure.newwavetech.co.ug/settings/index.php?t=New%20Finance%20Report', '2012-06-06 01:56:10');
INSERT INTO `audittrail` VALUES (182, 'admin', '212.88.100.70', 'http://guardsecure.newwavetech.co.ug/settings/index.php', '2012-06-06 01:56:20');
INSERT INTO `audittrail` VALUES (183, 'admin', '212.88.100.70', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-06-06 01:56:30');
INSERT INTO `audittrail` VALUES (184, 'admin', '212.88.100.70', 'http://guardsecure.newwavetech.co.ug/transport/managefueldistribution.php', '2012-06-06 01:59:19');
INSERT INTO `audittrail` VALUES (185, 'admin', '212.88.100.70', 'http://guardsecure.newwavetech.co.ug/transport/fueldistribution.php?action=edit&id=NA==', '2012-06-06 01:59:32');
INSERT INTO `audittrail` VALUES (186, 'admin', '212.88.100.70', 'http://guardsecure.newwavetech.co.ug/transport/managefueldistribution.php', '2012-06-06 01:59:43');
INSERT INTO `audittrail` VALUES (187, 'admin', '212.88.100.70', 'http://guardsecure.newwavetech.co.ug/transport/fueldistribution.php', '2012-06-06 01:59:49');
INSERT INTO `audittrail` VALUES (188, 'admin', '212.88.100.70', 'http://guardsecure.newwavetech.co.ug/transport/fueldistribution.php', '2012-06-06 02:00:13');
INSERT INTO `audittrail` VALUES (189, 'admin', '212.88.100.70', 'http://guardsecure.newwavetech.co.ug/transport/managefueldistribution.php', '2012-06-06 02:00:14');
INSERT INTO `audittrail` VALUES (190, 'admin', '212.88.100.70', 'http://guardsecure.newwavetech.co.ug/settings/settings.php', '2012-06-06 02:00:30');
INSERT INTO `audittrail` VALUES (191, 'admin', '212.88.100.70', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-06-06 02:00:34');
INSERT INTO `audittrail` VALUES (192, 'admin', '212.88.100.70', 'http://guardsecure.newwavetech.co.ug/transport/fuelreport.php', '2012-06-06 02:00:49');
INSERT INTO `audittrail` VALUES (193, 'admin', '212.88.100.70', 'http://guardsecure.newwavetech.co.ug/transport/fuelreport.php', '2012-06-06 02:01:14');
INSERT INTO `audittrail` VALUES (194, 'admin', '212.88.100.70', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-06-06 02:01:27');
INSERT INTO `audittrail` VALUES (195, 'admin', '212.88.100.70', 'http://guardsecure.newwavetech.co.ug/inventory/inventorystock.php', '2012-06-06 02:01:33');
INSERT INTO `audittrail` VALUES (196, 'admin', '212.88.100.70', 'http://guardsecure.newwavetech.co.ug/inventory/item.php?id=Mg==&d=edit', '2012-06-06 02:01:41');
INSERT INTO `audittrail` VALUES (197, 'admin', '212.88.100.70', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-06-06 02:01:59');
INSERT INTO `audittrail` VALUES (198, 'admin', '212.88.100.70', 'http://guardsecure.newwavetech.co.ug/operations/appraisals.php', '2012-06-06 02:02:18');
INSERT INTO `audittrail` VALUES (199, 'admin', '212.88.100.70', 'http://guardsecure.newwavetech.co.ug/operations/addappraisal.php?action=edit&id=Nw==', '2012-06-06 02:19:04');
INSERT INTO `audittrail` VALUES (200, 'admin', '41.221.93.229', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-06-06 07:00:48');
INSERT INTO `audittrail` VALUES (201, 'admin', '41.221.93.229', 'http://guardsecure.newwavetech.co.ug/operations/index.php', '2012-06-06 07:01:26');
INSERT INTO `audittrail` VALUES (202, 'admin', '41.221.93.229', 'http://guardsecure.newwavetech.co.ug/operations/index.php', '2012-06-06 07:01:45');
INSERT INTO `audittrail` VALUES (203, 'admin', '41.221.93.229', 'http://guardsecure.newwavetech.co.ug/operations/index.php', '2012-06-06 07:02:01');
INSERT INTO `audittrail` VALUES (204, 'admin', '41.221.93.229', 'http://guardsecure.newwavetech.co.ug/operations/index.php', '2012-06-06 07:02:20');
INSERT INTO `audittrail` VALUES (205, 'admin', '41.221.93.229', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-06-06 07:02:22');
INSERT INTO `audittrail` VALUES (206, 'admin', '41.221.93.229', 'http://guardsecure.newwavetech.co.ug/core/manageassignments.php', '2012-06-06 07:02:34');
INSERT INTO `audittrail` VALUES (207, 'admin', '41.221.93.229', 'http://guardsecure.newwavetech.co.ug/core/assignment.php', '2012-06-06 07:02:42');
INSERT INTO `audittrail` VALUES (208, 'admin', '41.221.93.229', 'http://guardsecure.newwavetech.co.ug/core/manageassignments.php', '2012-06-06 07:04:08');
INSERT INTO `audittrail` VALUES (209, 'admin', '41.221.93.229', 'http://guardsecure.newwavetech.co.ug/finance/nssf.php', '2012-06-06 07:06:16');
INSERT INTO `audittrail` VALUES (210, 'admin', '41.221.93.229', 'http://guardsecure.newwavetech.co.ug/finance/nssf.php?a=edit', '2012-06-06 07:08:35');
INSERT INTO `audittrail` VALUES (211, 'admin', '41.221.93.229', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-06-06 07:09:17');
INSERT INTO `audittrail` VALUES (212, 'admin', '41.221.93.229', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-06-06 07:10:03');
INSERT INTO `audittrail` VALUES (213, 'admin', '41.221.93.229', 'http://guardsecure.newwavetech.co.ug/finance/managetransactions.php?t=d29sZnR1bw==', '2012-06-06 07:10:15');
INSERT INTO `audittrail` VALUES (214, 'admin', '41.221.93.229', 'http://guardsecure.newwavetech.co.ug/finance/transaction.php?t=d29sZnR1bw==', '2012-06-06 07:10:26');
INSERT INTO `audittrail` VALUES (215, 'admin', '41.221.93.229', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-06-06 07:10:43');
INSERT INTO `audittrail` VALUES (216, 'admin', '41.221.93.229', 'http://guardsecure.newwavetech.co.ug/finance/paymentstatus.php', '2012-06-06 07:11:52');
INSERT INTO `audittrail` VALUES (217, 'admin', '41.221.93.229', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-06-06 07:12:14');
INSERT INTO `audittrail` VALUES (218, 'admin', '41.221.93.229', 'http://guardsecure.newwavetech.co.ug/operations/appraisals.php', '2012-06-06 07:12:28');
INSERT INTO `audittrail` VALUES (219, 'admin', '41.221.93.229', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-06-06 07:12:31');
INSERT INTO `audittrail` VALUES (220, 'admin', '41.221.93.229', 'http://guardsecure.newwavetech.co.ug/operations/index.php', '2012-06-06 07:12:42');
INSERT INTO `audittrail` VALUES (221, '', '41.202.225.153', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-06-08 02:51:32');
INSERT INTO `audittrail` VALUES (222, 'admin', '41.202.225.153', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-06-08 02:51:48');
INSERT INTO `audittrail` VALUES (223, 'admin', '41.202.225.153', 'http://guardsecure.newwavetech.co.ug/hr/manageguards.php', '2012-06-08 02:52:44');
INSERT INTO `audittrail` VALUES (224, 'admin', '41.202.225.153', 'http://guardsecure.newwavetech.co.ug/hr/index.php', '2012-06-08 02:53:37');
INSERT INTO `audittrail` VALUES (225, 'admin', '41.202.225.153', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-06-08 02:53:43');
INSERT INTO `audittrail` VALUES (226, '', '41.210.129.117', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-06-08 02:59:17');
INSERT INTO `audittrail` VALUES (227, '', '196.0.21.52', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-06-18 09:44:54');
INSERT INTO `audittrail` VALUES (228, 'tiger', '196.0.21.52', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-06-18 09:45:04');
INSERT INTO `audittrail` VALUES (229, 'tiger', '196.0.21.52', 'http://guardsecure.newwavetech.co.ug/core/manageassignments.php', '2012-06-18 09:45:54');
INSERT INTO `audittrail` VALUES (230, '', '41.221.93.230', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-06-18 10:55:09');
INSERT INTO `audittrail` VALUES (231, 'admin', '41.221.93.230', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-06-18 10:55:28');
INSERT INTO `audittrail` VALUES (232, 'admin', '41.221.93.230', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-06-18 10:58:27');
INSERT INTO `audittrail` VALUES (233, 'admin', '41.221.93.230', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-06-18 10:58:53');
INSERT INTO `audittrail` VALUES (234, 'admin', '41.221.93.230', 'http://guardsecure.newwavetech.co.ug/hr/manageguards.php', '2012-06-18 10:59:15');
INSERT INTO `audittrail` VALUES (235, 'admin', '41.221.93.230', 'http://guardsecure.newwavetech.co.ug/hr/index.php?id=NzI=&a=edit', '2012-06-18 10:59:21');
INSERT INTO `audittrail` VALUES (236, 'admin', '41.221.93.230', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-06-18 11:00:33');
INSERT INTO `audittrail` VALUES (237, 'admin', '41.221.93.230', 'http://guardsecure.newwavetech.co.ug/core/manageassignments.php', '2012-06-18 11:00:38');
INSERT INTO `audittrail` VALUES (238, 'admin', '41.221.93.230', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-06-18 11:01:11');
INSERT INTO `audittrail` VALUES (239, 'admin', '41.221.93.230', 'http://guardsecure.newwavetech.co.ug/operations/index.php', '2012-06-18 11:01:26');
INSERT INTO `audittrail` VALUES (240, 'admin', '41.221.93.230', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-06-18 11:01:39');
INSERT INTO `audittrail` VALUES (241, 'admin', '41.221.93.230', 'http://guardsecure.newwavetech.co.ug/inventory/inventorystock.php', '2012-06-18 11:09:54');
INSERT INTO `audittrail` VALUES (242, 'admin', '41.221.93.230', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-06-18 11:10:08');
INSERT INTO `audittrail` VALUES (243, 'admin', '41.221.93.230', 'http://guardsecure.newwavetech.co.ug/finance/manageguardfinance.php', '2012-06-18 11:10:15');
INSERT INTO `audittrail` VALUES (244, 'admin', '41.221.93.230', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-06-18 11:10:26');
INSERT INTO `audittrail` VALUES (245, 'admin', '41.221.93.230', 'http://guardsecure.newwavetech.co.ug/hr/manageleave.php', '2012-06-18 11:12:36');
INSERT INTO `audittrail` VALUES (246, 'admin', '41.221.93.230', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-06-18 11:13:05');
INSERT INTO `audittrail` VALUES (247, 'admin', '41.221.93.230', 'http://guardsecure.newwavetech.co.ug/operations/appraisals.php', '2012-06-18 11:13:26');
INSERT INTO `audittrail` VALUES (248, 'admin', '41.221.93.230', 'http://guardsecure.newwavetech.co.ug/operations/addappraisal.php', '2012-06-18 11:14:02');
INSERT INTO `audittrail` VALUES (249, 'admin', '41.221.93.230', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-06-18 11:14:13');
INSERT INTO `audittrail` VALUES (250, 'admin', '41.221.93.230', 'http://guardsecure.newwavetech.co.ug/settings/settings.php', '2012-06-18 11:14:24');
INSERT INTO `audittrail` VALUES (251, 'admin', '41.221.93.230', 'http://guardsecure.newwavetech.co.ug/core/managegroups.php', '2012-06-18 11:14:35');
INSERT INTO `audittrail` VALUES (252, 'admin', '41.221.93.230', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-06-18 11:14:49');
INSERT INTO `audittrail` VALUES (253, 'admin', '41.221.93.230', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-06-18 11:15:51');
INSERT INTO `audittrail` VALUES (254, 'admin', '41.221.93.230', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-06-18 11:16:39');
INSERT INTO `audittrail` VALUES (255, 'admin', '41.221.93.230', 'http://guardsecure.newwavetech.co.ug/core/user.php', '2012-06-18 11:16:47');
INSERT INTO `audittrail` VALUES (256, 'admin', '41.221.93.230', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-06-18 11:18:03');
INSERT INTO `audittrail` VALUES (257, 'admin', '41.221.93.230', 'http://guardsecure.newwavetech.co.ug/settings/settings.php', '2012-06-18 11:18:06');
INSERT INTO `audittrail` VALUES (258, 'admin', '41.221.93.230', 'http://guardsecure.newwavetech.co.ug/core/managegroups.php', '2012-06-18 11:18:14');
INSERT INTO `audittrail` VALUES (259, 'admin', '41.221.93.230', 'http://guardsecure.newwavetech.co.ug/core/manageusers.php', '2012-06-18 11:18:33');
INSERT INTO `audittrail` VALUES (260, 'mtukahirwa', '41.221.93.230', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-06-18 11:18:53');
INSERT INTO `audittrail` VALUES (261, 'mtukahirwa', '212.88.100.70', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-06-20 04:22:31');
INSERT INTO `audittrail` VALUES (262, '', '196.0.21.52', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-06-26 11:24:09');
INSERT INTO `audittrail` VALUES (263, 'admin', '196.0.21.52', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-06-26 11:25:17');
INSERT INTO `audittrail` VALUES (264, 'admin', '196.0.21.52', 'http://guardsecure.newwavetech.co.ug/operations/report.php?f=Control%20Shift', '2012-06-26 11:25:46');
INSERT INTO `audittrail` VALUES (265, 'admin', '196.0.21.52', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-06-26 11:26:02');
INSERT INTO `audittrail` VALUES (266, 'admin', '196.0.21.52', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-06-26 11:26:34');
INSERT INTO `audittrail` VALUES (267, 'admin', '196.0.21.52', 'http://guardsecure.newwavetech.co.ug/settings/settings.php', '2012-06-26 11:27:01');
INSERT INTO `audittrail` VALUES (268, 'admin', '196.0.21.52', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-06-26 12:00:16');
INSERT INTO `audittrail` VALUES (269, 'admin', '196.0.21.52', 'http://guardsecure.newwavetech.co.ug/core/guardreport.php?f=Guard%20Daily%20Schedule', '2012-06-26 12:01:26');
INSERT INTO `audittrail` VALUES (270, 'admin', '196.0.21.52', 'http://guardsecure.newwavetech.co.ug/finance/report.php?f=Guard%20Payroll', '2012-06-26 12:01:38');
INSERT INTO `audittrail` VALUES (271, 'admin', '196.0.21.52', 'http://guardsecure.newwavetech.co.ug/finance/report.php', '2012-06-26 12:02:07');
INSERT INTO `audittrail` VALUES (272, 'admin', '196.0.21.52', 'http://guardsecure.newwavetech.co.ug/finance/report.php', '2012-06-26 12:03:37');
INSERT INTO `audittrail` VALUES (273, '', '196.0.21.52', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-06-27 08:27:58');
INSERT INTO `audittrail` VALUES (274, '', '196.0.21.52', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-06-27 08:29:18');
INSERT INTO `audittrail` VALUES (275, '', '196.0.21.52', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-06-27 10:11:37');
INSERT INTO `audittrail` VALUES (276, '', '196.0.21.52', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-06-27 11:13:44');
INSERT INTO `audittrail` VALUES (277, '', '196.0.21.52', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-06-29 08:14:40');
INSERT INTO `audittrail` VALUES (278, 'admin', '196.0.21.52', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-06-29 08:15:54');
INSERT INTO `audittrail` VALUES (279, 'admin', '196.0.21.52', 'http://guardsecure.newwavetech.co.ug/transport/fuelreport.php', '2012-06-29 08:16:40');
INSERT INTO `audittrail` VALUES (280, 'admin', '196.0.21.52', 'http://guardsecure.newwavetech.co.ug/transport/fuelreport.php', '2012-06-29 08:17:02');
INSERT INTO `audittrail` VALUES (281, 'admin', '196.0.21.52', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-06-29 08:17:20');
INSERT INTO `audittrail` VALUES (282, 'admin', '196.0.21.52', 'http://guardsecure.newwavetech.co.ug/settings/settings.php', '2012-06-29 08:17:25');
INSERT INTO `audittrail` VALUES (283, 'admin', '196.0.21.52', 'http://guardsecure.newwavetech.co.ug/settings/payeformula.php', '2012-06-29 08:17:33');
INSERT INTO `audittrail` VALUES (284, 'admin', '196.0.21.52', 'http://guardsecure.newwavetech.co.ug/settings/index.php', '2012-06-29 08:18:13');
INSERT INTO `audittrail` VALUES (285, 'admin', '196.0.21.52', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-06-29 08:19:09');
INSERT INTO `audittrail` VALUES (286, 'admin', '196.0.21.52', 'http://guardsecure.newwavetech.co.ug/hr/manageguards.php', '2012-06-29 08:19:17');
INSERT INTO `audittrail` VALUES (287, 'admin', '196.0.21.52', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-06-29 08:19:37');
INSERT INTO `audittrail` VALUES (288, 'admin', '196.0.21.52', 'http://guardsecure.newwavetech.co.ug/hr/personnel.php', '2012-06-29 08:20:20');
INSERT INTO `audittrail` VALUES (289, 'admin', '196.0.21.52', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-06-29 08:20:59');
INSERT INTO `audittrail` VALUES (290, 'admin', '196.0.21.52', 'http://guardsecure.newwavetech.co.ug/hr/manageguards.php', '2012-06-29 08:21:04');
INSERT INTO `audittrail` VALUES (291, 'admin', '196.0.21.52', 'http://guardsecure.newwavetech.co.ug/hr/index.php', '2012-06-29 08:21:11');
INSERT INTO `audittrail` VALUES (292, 'admin', '196.0.21.52', 'http://guardsecure.newwavetech.co.ug/hr/index.php', '2012-06-29 08:21:58');
INSERT INTO `audittrail` VALUES (293, '', '196.0.21.52', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-07-03 07:30:46');
INSERT INTO `audittrail` VALUES (294, '', '41.202.225.154', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-07-09 05:53:44');
INSERT INTO `audittrail` VALUES (295, '', '93.182.181.3', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-07-09 06:49:51');
INSERT INTO `audittrail` VALUES (296, '', '93.182.181.3', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-07-09 06:49:52');
INSERT INTO `audittrail` VALUES (297, '', '83.233.186.82', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-07-09 11:43:54');
INSERT INTO `audittrail` VALUES (298, '', '66.249.66.34', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-07-09 14:20:24');
INSERT INTO `audittrail` VALUES (299, '', '66.249.66.34', 'http://guardsecure.newwavetech.co.ug/core/reminders.php', '2012-07-09 14:52:39');
INSERT INTO `audittrail` VALUES (300, '', '66.249.66.34', 'http://guardsecure.newwavetech.co.ug/core/favorites.php', '2012-07-09 14:55:25');
INSERT INTO `audittrail` VALUES (301, '', '66.249.72.108', 'http://guardsecure.newwavetech.co.ug/settings/index.php', '2012-07-09 14:56:48');
INSERT INTO `audittrail` VALUES (302, '', '66.249.66.34', 'http://guardsecure.newwavetech.co.ug/settings/settings.php', '2012-07-09 14:59:43');
INSERT INTO `audittrail` VALUES (303, '', '66.249.66.34', 'http://guardsecure.newwavetech.co.ug/core/viewuser.php?id=', '2012-07-09 15:02:46');
INSERT INTO `audittrail` VALUES (304, '', '66.249.66.34', 'http://guardsecure.newwavetech.co.ug/core/reminders.php?id=MTI=&a=delete', '2012-07-09 15:22:31');
INSERT INTO `audittrail` VALUES (305, '', '66.249.66.34', 'http://guardsecure.newwavetech.co.ug/hr/index.php?id=MTM=&a=edit', '2012-07-09 15:23:35');
INSERT INTO `audittrail` VALUES (306, '', '66.249.66.34', 'http://guardsecure.newwavetech.co.ug/hr/index.php?id=NTM=&a=edit', '2012-07-09 15:24:07');
INSERT INTO `audittrail` VALUES (307, '', '66.249.66.34', 'http://guardsecure.newwavetech.co.ug/core/user.php?id=&action=edit', '2012-07-09 15:24:39');
INSERT INTO `audittrail` VALUES (308, '', '66.249.66.34', 'http://guardsecure.newwavetech.co.ug/core/reminders.php?id=MjI=&a=delete', '2012-07-09 15:25:43');
INSERT INTO `audittrail` VALUES (309, '', '66.249.66.34', 'http://guardsecure.newwavetech.co.ug/core/reminders.php?id=MTIx&a=delete', '2012-07-09 15:25:59');
INSERT INTO `audittrail` VALUES (310, '', '66.249.66.34', 'http://guardsecure.newwavetech.co.ug/core/reminders.php?id=NQ==&a=delete', '2012-07-09 15:26:15');
INSERT INTO `audittrail` VALUES (311, '', '66.249.66.34', 'http://guardsecure.newwavetech.co.ug/core/reminders.php?id=MTU=&a=delete', '2012-07-09 15:26:44');
INSERT INTO `audittrail` VALUES (312, '', '66.249.72.108', 'http://guardsecure.newwavetech.co.ug/core/reminders.php?id=OTE=&a=delete', '2012-07-09 15:27:16');
INSERT INTO `audittrail` VALUES (313, '', '66.249.66.34', 'http://guardsecure.newwavetech.co.ug/core/reminders.php?id=Ng==&a=delete', '2012-07-09 15:27:48');
INSERT INTO `audittrail` VALUES (314, '', '66.249.72.108', 'http://guardsecure.newwavetech.co.ug/core/reminders.php?id=MjIx&a=delete', '2012-07-09 15:28:20');
INSERT INTO `audittrail` VALUES (315, '', '66.249.72.108', 'http://guardsecure.newwavetech.co.ug/core/reminders.php?id=MzM=&a=delete', '2012-07-09 15:28:52');
INSERT INTO `audittrail` VALUES (316, '', '66.249.66.34', 'http://guardsecure.newwavetech.co.ug/core/reminders.php?id=NDM=&a=delete', '2012-07-09 15:29:24');
INSERT INTO `audittrail` VALUES (317, '', '66.249.66.34', 'http://guardsecure.newwavetech.co.ug/core/reminders.php?id=MzE=&a=delete', '2012-07-09 15:29:56');
INSERT INTO `audittrail` VALUES (318, '', '66.249.66.34', 'http://guardsecure.newwavetech.co.ug/core/reminders.php?id=MjE=&a=delete', '2012-07-09 15:30:28');
INSERT INTO `audittrail` VALUES (319, '', '66.249.66.34', 'http://guardsecure.newwavetech.co.ug/core/reminders.php?id=NA==&a=delete', '2012-07-09 15:30:58');
INSERT INTO `audittrail` VALUES (320, '', '66.249.66.34', 'http://guardsecure.newwavetech.co.ug/core/reminders.php?id=MzI=&a=delete', '2012-07-09 15:31:32');
INSERT INTO `audittrail` VALUES (321, '', '66.249.66.34', 'http://guardsecure.newwavetech.co.ug/core/reminders.php?id=MQ==&a=delete', '2012-07-09 15:32:04');
INSERT INTO `audittrail` VALUES (322, '', '66.249.72.108', 'http://guardsecure.newwavetech.co.ug/core/reminders.php?id=Mw==&a=delete', '2012-07-09 15:32:35');
INSERT INTO `audittrail` VALUES (323, '', '66.249.66.34', 'http://guardsecure.newwavetech.co.ug/core/reminders.php?id=MzIx&a=delete', '2012-07-09 15:33:08');
INSERT INTO `audittrail` VALUES (324, '', '66.249.66.34', 'http://guardsecure.newwavetech.co.ug/hr/manageleave.php?a=search&leaveid=47', '2012-07-09 15:33:40');
INSERT INTO `audittrail` VALUES (325, '', '66.249.66.34', 'http://guardsecure.newwavetech.co.ug/hr/manageleave.php?a=search&leaveid=42', '2012-07-09 15:34:21');
INSERT INTO `audittrail` VALUES (326, '', '66.249.66.34', 'http://guardsecure.newwavetech.co.ug/hr/manageleave.php?a=search&leaveid=45', '2012-07-09 15:35:01');
INSERT INTO `audittrail` VALUES (327, '', '66.249.66.34', 'http://guardsecure.newwavetech.co.ug/hr/manageleave.php?a=search&leaveid=38', '2012-07-09 15:35:18');
INSERT INTO `audittrail` VALUES (328, '', '66.249.66.34', 'http://guardsecure.newwavetech.co.ug/hr/manageleave.php?a=search&leaveid=39', '2012-07-09 15:35:44');
INSERT INTO `audittrail` VALUES (329, '', '66.249.66.34', 'http://guardsecure.newwavetech.co.ug/hr/manageleave.php?a=search&leaveid=43', '2012-07-09 15:36:19');
INSERT INTO `audittrail` VALUES (330, '', '66.249.72.108', 'http://guardsecure.newwavetech.co.ug/hr/manageleave.php?a=search&leaveid=46', '2012-07-09 15:36:51');
INSERT INTO `audittrail` VALUES (331, '', '66.249.66.34', 'http://guardsecure.newwavetech.co.ug/hr/manageleave.php?a=search&leaveid=44', '2012-07-09 15:37:24');
INSERT INTO `audittrail` VALUES (332, '', '66.249.66.34', 'http://guardsecure.newwavetech.co.ug/core/manageusers.php?a=search&userid=6', '2012-07-09 15:37:57');
INSERT INTO `audittrail` VALUES (333, '', '66.249.72.108', 'http://guardsecure.newwavetech.co.ug/core/manageusers.php?a=search&userid=18', '2012-07-09 15:38:26');
INSERT INTO `audittrail` VALUES (334, '', '66.249.66.34', 'http://guardsecure.newwavetech.co.ug/core/manageusers.php?a=search&userid=19', '2012-07-09 15:39:20');
INSERT INTO `audittrail` VALUES (335, '', '66.249.66.34', 'http://guardsecure.newwavetech.co.ug/hr/manageguards.php', '2012-07-09 15:41:39');
INSERT INTO `audittrail` VALUES (336, '', '66.249.66.34', 'http://guardsecure.newwavetech.co.ug/hr/managepersonnel.php?id=MTM=', '2012-07-09 15:46:09');
INSERT INTO `audittrail` VALUES (337, '', '66.249.72.108', 'http://guardsecure.newwavetech.co.ug/hr/managepersonnel.php?id=MzIwVA==', '2012-07-09 15:50:51');
INSERT INTO `audittrail` VALUES (338, '', '66.249.66.34', 'http://guardsecure.newwavetech.co.ug/hr/manageleave.php?a=archive', '2012-07-09 15:55:40');
INSERT INTO `audittrail` VALUES (339, '', '66.249.66.34', 'http://guardsecure.newwavetech.co.ug/hr/managepersonnel.php?id=NTM=', '2012-07-09 15:58:08');
INSERT INTO `audittrail` VALUES (340, '', '66.249.66.34', 'http://guardsecure.newwavetech.co.ug/hr/managepersonnel.php?id=MzA5Sw==', '2012-07-09 16:00:11');
INSERT INTO `audittrail` VALUES (341, '', '66.249.66.34', 'http://guardsecure.newwavetech.co.ug/hr/approvals.php?id=NTQ=&t=gm&p=view', '2012-07-09 16:07:25');
INSERT INTO `audittrail` VALUES (342, '', '66.249.66.34', 'http://guardsecure.newwavetech.co.ug/hr/approvals.php?id=MjQ=&t=gm&p=view', '2012-07-09 16:09:05');
INSERT INTO `audittrail` VALUES (343, '', '66.249.66.34', 'http://guardsecure.newwavetech.co.ug/hr/index.php?id=MzM=&a=view', '2012-07-09 16:10:03');
INSERT INTO `audittrail` VALUES (344, '', '66.249.72.108', 'http://guardsecure.newwavetech.co.ug/hr/manageleave.php', '2012-07-09 16:10:35');
INSERT INTO `audittrail` VALUES (345, '', '66.249.66.34', 'http://guardsecure.newwavetech.co.ug/hr/manageguards.php?a=archive', '2012-07-09 16:11:34');
INSERT INTO `audittrail` VALUES (346, '', '66.249.66.34', 'http://guardsecure.newwavetech.co.ug/hr/index.php?id=MTM=&a=view', '2012-07-09 16:12:30');
INSERT INTO `audittrail` VALUES (347, '', '66.249.72.108', 'http://guardsecure.newwavetech.co.ug/hr/index.php?id=MjM=&a=view', '2012-07-09 16:13:26');
INSERT INTO `audittrail` VALUES (348, '', '66.249.66.34', 'http://guardsecure.newwavetech.co.ug/hr/index.php?id=NTM=&a=view', '2012-07-09 16:14:23');
INSERT INTO `audittrail` VALUES (349, '', '66.249.66.34', 'http://guardsecure.newwavetech.co.ug/hr/index.php?id=OTM=&a=view', '2012-07-09 16:15:20');
INSERT INTO `audittrail` VALUES (350, '', '66.249.66.34', 'http://guardsecure.newwavetech.co.ug/hr/index.php?id=NzI=&a=view', '2012-07-09 16:16:16');
INSERT INTO `audittrail` VALUES (351, '', '66.249.66.34', 'http://guardsecure.newwavetech.co.ug/hr/index.php?id=NDM=&a=view', '2012-07-09 16:17:13');
INSERT INTO `audittrail` VALUES (352, '', '66.249.66.34', 'http://guardsecure.newwavetech.co.ug/hr/index.php?id=NzM=&a=view', '2012-07-09 16:18:09');
INSERT INTO `audittrail` VALUES (353, '', '66.249.72.108', 'http://guardsecure.newwavetech.co.ug/hr/index.php?id=NjM=&a=view', '2012-07-09 16:19:06');
INSERT INTO `audittrail` VALUES (354, '', '66.249.72.108', 'http://guardsecure.newwavetech.co.ug/hr/index.php?id=ODM=&a=view', '2012-07-09 16:20:03');
INSERT INTO `audittrail` VALUES (355, '', '66.249.66.34', 'http://guardsecure.newwavetech.co.ug/hr/manageguards.php?a=order&va=id&ty=desc', '2012-07-09 16:21:27');
INSERT INTO `audittrail` VALUES (356, '', '66.249.66.34', 'http://guardsecure.newwavetech.co.ug/hr/manageguards.php?a=order&va=doe&ty=desc', '2012-07-09 16:21:56');
INSERT INTO `audittrail` VALUES (357, '', '66.249.66.34', 'http://guardsecure.newwavetech.co.ug/hr/approvals.php?id=MTQ=&t=gm&p=view', '2012-07-09 16:22:55');
INSERT INTO `audittrail` VALUES (358, '', '66.249.72.108', 'http://guardsecure.newwavetech.co.ug/hr/approvals.php?id=MDQ=&t=gm&p=view', '2012-07-09 16:23:59');
INSERT INTO `audittrail` VALUES (359, '', '66.249.72.108', 'http://guardsecure.newwavetech.co.ug/hr/manageguards.php?a=order&va=name&ty=desc', '2012-07-09 16:25:05');
INSERT INTO `audittrail` VALUES (360, '', '66.249.72.108', 'http://guardsecure.newwavetech.co.ug/hr/managepersonnel.php?id=NDQzVw==', '2012-07-09 16:29:10');
INSERT INTO `audittrail` VALUES (361, '', '66.249.66.34', 'http://guardsecure.newwavetech.co.ug/hr/managepersonnel.php?id=MzM=', '2012-07-09 16:35:54');
INSERT INTO `audittrail` VALUES (362, '', '66.249.72.108', 'http://guardsecure.newwavetech.co.ug/hr/manageguards.php?a=order&va=id&ty=asc', '2012-07-09 16:44:31');
INSERT INTO `audittrail` VALUES (363, '', '66.249.72.108', 'http://guardsecure.newwavetech.co.ug/hr/managepersonnel.php?id=MjM=', '2012-07-09 16:44:32');
INSERT INTO `audittrail` VALUES (364, '', '66.249.72.108', 'http://guardsecure.newwavetech.co.ug/hr/managepersonnel.php?id=NDM=', '2012-07-09 16:46:41');
INSERT INTO `audittrail` VALUES (365, '', '66.249.66.34', 'http://guardsecure.newwavetech.co.ug/hr/managepersonnel.php?id=NzI=', '2012-07-09 16:47:28');
INSERT INTO `audittrail` VALUES (366, '', '66.249.66.34', 'http://guardsecure.newwavetech.co.ug/hr/managepersonnel.php?id=NjM=', '2012-07-09 16:48:16');
INSERT INTO `audittrail` VALUES (367, '', '66.249.72.108', 'http://guardsecure.newwavetech.co.ug/hr/managepersonnel.php?id=OTM=', '2012-07-09 16:49:03');
INSERT INTO `audittrail` VALUES (368, '', '66.249.72.108', 'http://guardsecure.newwavetech.co.ug/hr/managepersonnel.php?id=NzM=', '2012-07-09 16:49:49');
INSERT INTO `audittrail` VALUES (369, '', '66.249.66.34', 'http://guardsecure.newwavetech.co.ug/hr/managepersonnel.php?id=ODM=', '2012-07-09 16:50:39');
INSERT INTO `audittrail` VALUES (370, '', '66.249.72.108', 'http://guardsecure.newwavetech.co.ug/hr/managepersonnel.php?id=Mzc2VA==', '2012-07-09 16:51:26');
INSERT INTO `audittrail` VALUES (371, '', '66.249.72.108', 'http://guardsecure.newwavetech.co.ug/hr/managepersonnel.php?id=NDU1Rg==', '2012-07-09 16:52:13');
INSERT INTO `audittrail` VALUES (372, '', '66.249.72.108', 'http://guardsecure.newwavetech.co.ug/hr/managepersonnel.php?id=OTkzUw==', '2012-07-09 16:53:01');
INSERT INTO `audittrail` VALUES (373, '', '66.249.72.108', 'http://guardsecure.newwavetech.co.ug/hr/managepersonnel.php?id=MzIxMzIx', '2012-07-09 16:53:49');
INSERT INTO `audittrail` VALUES (374, '', '66.249.66.34', 'http://guardsecure.newwavetech.co.ug/hr/managepersonnel.php?id=NDEzWQ==', '2012-07-09 16:54:31');
INSERT INTO `audittrail` VALUES (375, '', '66.249.66.34', 'http://guardsecure.newwavetech.co.ug/hr/managepersonnel.php?id=MTAySg==', '2012-07-09 16:55:26');
INSERT INTO `audittrail` VALUES (376, '', '66.249.66.34', 'http://guardsecure.newwavetech.co.ug/hr/managepersonnel.php?id=MjEwVA==', '2012-07-09 16:56:13');
INSERT INTO `audittrail` VALUES (377, '', '66.249.66.34', 'http://guardsecure.newwavetech.co.ug/hr/index.php?id=MDM=&a=view', '2012-07-09 16:57:01');
INSERT INTO `audittrail` VALUES (378, '', '66.249.66.34', 'http://guardsecure.newwavetech.co.ug/hr/index.php?id=MDQ=&a=view', '2012-07-09 16:57:50');
INSERT INTO `audittrail` VALUES (379, '', '66.249.66.34', 'http://guardsecure.newwavetech.co.ug/hr/manageguards.php?a=order&va=name&ty=asc', '2012-07-09 16:58:41');
INSERT INTO `audittrail` VALUES (380, '', '66.249.66.34', 'http://guardsecure.newwavetech.co.ug/hr/manageguards.php?a=order&va=doe&ty=asc', '2012-07-09 16:59:14');
INSERT INTO `audittrail` VALUES (381, '', '66.249.72.108', 'http://guardsecure.newwavetech.co.ug/hr/managepersonnel.php?id=MDM=', '2012-07-09 17:19:35');
INSERT INTO `audittrail` VALUES (382, '', '66.249.66.34', 'http://guardsecure.newwavetech.co.ug/hr/managepersonnel.php?id=NDAwMFI=', '2012-07-09 17:19:36');
INSERT INTO `audittrail` VALUES (383, '', '66.249.72.108', 'http://guardsecure.newwavetech.co.ug/hr/managepersonnel.php?id=MDQ=', '2012-07-09 17:19:37');
INSERT INTO `audittrail` VALUES (384, '', '66.249.66.34', 'http://guardsecure.newwavetech.co.ug/hr/managepersonnel.php?id=NzExSA==', '2012-07-09 17:31:39');
INSERT INTO `audittrail` VALUES (385, '', '83.233.186.82', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-07-10 11:39:25');
INSERT INTO `audittrail` VALUES (386, '', '83.233.186.82', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-07-10 11:42:35');
INSERT INTO `audittrail` VALUES (387, '', '157.56.95.128', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-07-10 14:03:35');
INSERT INTO `audittrail` VALUES (388, '', '83.233.186.82', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-07-11 11:09:11');
INSERT INTO `audittrail` VALUES (389, '', '83.233.186.82', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-07-11 11:17:44');
INSERT INTO `audittrail` VALUES (390, '', '41.190.205.179', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-07-11 11:41:26');
INSERT INTO `audittrail` VALUES (391, '', '66.249.66.78', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-07-12 04:02:17');
INSERT INTO `audittrail` VALUES (392, '', '207.46.13.117', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-07-12 08:51:26');
INSERT INTO `audittrail` VALUES (393, '', '207.46.13.118', 'http://guardsecure.newwavetech.co.ug/settings/settings.php', '2012-07-12 09:31:24');
INSERT INTO `audittrail` VALUES (394, '', '83.233.186.82', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-07-12 11:34:46');
INSERT INTO `audittrail` VALUES (395, '', '83.233.186.82', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-07-12 12:25:00');
INSERT INTO `audittrail` VALUES (396, '', '157.56.95.128', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-07-12 17:30:23');
INSERT INTO `audittrail` VALUES (397, '', '65.52.110.18', 'http://guardsecure.newwavetech.co.ug/settings/index.php', '2012-07-12 22:43:50');
INSERT INTO `audittrail` VALUES (398, '', '66.249.66.78', 'http://guardsecure.newwavetech.co.ug/core/manageusers.php?a=search&userid=19', '2012-07-12 23:22:05');
INSERT INTO `audittrail` VALUES (399, '', '66.249.66.78', 'http://guardsecure.newwavetech.co.ug/core/favorites.php', '2012-07-13 03:12:01');
INSERT INTO `audittrail` VALUES (400, '', '65.52.108.146', 'http://guardsecure.newwavetech.co.ug/core/reminders.php', '2012-07-13 03:20:28');
INSERT INTO `audittrail` VALUES (401, '', '207.46.13.118', 'http://guardsecure.newwavetech.co.ug/core/favorites.php', '2012-07-13 05:07:50');
INSERT INTO `audittrail` VALUES (402, '', '66.249.72.102', 'http://guardsecure.newwavetech.co.ug/core/manageusers.php?a=search&userid=18', '2012-07-13 10:05:45');
INSERT INTO `audittrail` VALUES (403, '', '66.249.66.78', 'http://guardsecure.newwavetech.co.ug/core/manageusers.php?a=search&userid=6', '2012-07-13 10:48:02');
INSERT INTO `audittrail` VALUES (404, '', '66.249.72.102', 'http://guardsecure.newwavetech.co.ug/core/reminders.php', '2012-07-13 11:06:26');
INSERT INTO `audittrail` VALUES (405, '', '83.233.186.82', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-07-13 11:12:35');
INSERT INTO `audittrail` VALUES (406, '', '83.233.186.82', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-07-13 11:20:07');
INSERT INTO `audittrail` VALUES (407, '', '66.249.66.78', 'http://guardsecure.newwavetech.co.ug/hr/approvals.php?id=MjQ=&t=gm&p=view', '2012-07-13 20:58:47');
INSERT INTO `audittrail` VALUES (408, '', '66.249.66.78', 'http://guardsecure.newwavetech.co.ug/hr/approvals.php?id=NTQ=&t=gm&p=view', '2012-07-13 21:28:22');
INSERT INTO `audittrail` VALUES (409, '', '66.249.66.78', 'http://guardsecure.newwavetech.co.ug/hr/index.php?id=MTM=&a=edit', '2012-07-13 22:09:44');
INSERT INTO `audittrail` VALUES (410, '', '66.249.66.78', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-07-13 23:55:24');
INSERT INTO `audittrail` VALUES (411, '', '66.249.66.78', 'http://guardsecure.newwavetech.co.ug/hr/index.php?id=NTM=&a=edit', '2012-07-14 01:54:12');
INSERT INTO `audittrail` VALUES (412, '', '66.249.72.102', 'http://guardsecure.newwavetech.co.ug/hr/manageguards.php', '2012-07-14 07:48:08');
INSERT INTO `audittrail` VALUES (413, '', '66.249.66.78', 'http://guardsecure.newwavetech.co.ug/hr/manageleave.php?a=archive', '2012-07-14 08:33:01');
INSERT INTO `audittrail` VALUES (414, '', '66.249.72.102', 'http://guardsecure.newwavetech.co.ug/hr/manageleave.php?a=search&leaveid=38', '2012-07-14 09:29:22');
INSERT INTO `audittrail` VALUES (415, '', '66.249.73.202', 'http://guardsecure.newwavetech.co.ug/hr/manageleave.php?a=search&leaveid=39', '2012-07-14 12:57:46');
INSERT INTO `audittrail` VALUES (416, '', '66.249.73.202', 'http://guardsecure.newwavetech.co.ug/hr/manageleave.php?a=search&leaveid=42', '2012-07-14 19:28:41');
INSERT INTO `audittrail` VALUES (417, '', '66.249.73.202', 'http://guardsecure.newwavetech.co.ug/hr/manageleave.php?a=search&leaveid=43', '2012-07-14 19:36:30');
INSERT INTO `audittrail` VALUES (418, '', '66.249.73.202', 'http://guardsecure.newwavetech.co.ug/hr/manageleave.php?a=search&leaveid=44', '2012-07-14 20:39:32');
INSERT INTO `audittrail` VALUES (419, '', '66.249.73.202', 'http://guardsecure.newwavetech.co.ug/hr/manageleave.php?a=search&leaveid=45', '2012-07-15 01:07:02');
INSERT INTO `audittrail` VALUES (420, '', '66.249.73.202', 'http://guardsecure.newwavetech.co.ug/hr/manageleave.php?a=search&leaveid=46', '2012-07-15 06:51:51');
INSERT INTO `audittrail` VALUES (421, '', '66.249.73.202', 'http://guardsecure.newwavetech.co.ug/hr/manageleave.php?a=search&leaveid=47', '2012-07-15 07:41:49');
INSERT INTO `audittrail` VALUES (422, '', '66.249.73.202', 'http://guardsecure.newwavetech.co.ug/hr/manageguards.php', '2012-07-15 10:54:37');
INSERT INTO `audittrail` VALUES (423, '', '178.255.215.79', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-07-15 16:03:52');
INSERT INTO `audittrail` VALUES (424, '', '178.255.215.79', 'http://guardsecure.newwavetech.co.ug/core/viewuser.php?id=', '2012-07-15 17:22:40');
INSERT INTO `audittrail` VALUES (425, '', '31.172.30.2', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-07-15 18:27:49');
INSERT INTO `audittrail` VALUES (426, '', '31.172.30.2', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-07-15 18:27:51');
INSERT INTO `audittrail` VALUES (427, '', '66.249.73.202', 'http://guardsecure.newwavetech.co.ug/hr/manageleave.php?a=archive', '2012-07-15 18:28:50');
INSERT INTO `audittrail` VALUES (428, '', '66.249.73.202', 'http://guardsecure.newwavetech.co.ug/hr/managepersonnel.php?id=MTM=', '2012-07-15 21:54:56');
INSERT INTO `audittrail` VALUES (429, '', '222.186.26.41', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-07-16 03:23:45');
INSERT INTO `audittrail` VALUES (430, '', '222.186.26.41', 'http://guardsecure.newwavetech.co.ug/core/viewuser.php?id=', '2012-07-16 03:34:24');
INSERT INTO `audittrail` VALUES (431, '', '222.186.26.41', 'http://guardsecure.newwavetech.co.ug/settings/settings.php', '2012-07-16 03:44:08');
INSERT INTO `audittrail` VALUES (432, '', '222.186.26.41', 'http://guardsecure.newwavetech.co.ug/settings/index.php', '2012-07-16 03:56:20');
INSERT INTO `audittrail` VALUES (433, '', '222.186.26.41', 'http://guardsecure.newwavetech.co.ug/core/favorites.php', '2012-07-16 04:27:36');
INSERT INTO `audittrail` VALUES (434, '', '66.249.73.202', 'http://guardsecure.newwavetech.co.ug/hr/managepersonnel.php?id=MzA5Sw==', '2012-07-16 05:23:44');
INSERT INTO `audittrail` VALUES (435, '', '83.233.186.82', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-07-16 06:01:40');
INSERT INTO `audittrail` VALUES (436, '', '83.233.186.82', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-07-16 06:49:15');
INSERT INTO `audittrail` VALUES (437, '', '66.249.73.202', 'http://guardsecure.newwavetech.co.ug/hr/manageleave.php?a=search&leaveid=46', '2012-07-16 11:23:29');
INSERT INTO `audittrail` VALUES (438, '', '66.249.73.202', 'http://guardsecure.newwavetech.co.ug/hr/managepersonnel.php?id=MzIwVA==', '2012-07-16 17:22:36');
INSERT INTO `audittrail` VALUES (439, '', '222.186.26.41', 'http://guardsecure.newwavetech.co.ug/core/reminders.php', '2012-07-16 19:35:23');
INSERT INTO `audittrail` VALUES (440, '', '222.186.26.41', 'http://guardsecure.newwavetech.co.ug/core/viewuser.php?id=', '2012-07-16 19:35:24');
INSERT INTO `audittrail` VALUES (441, '', '222.186.26.41', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-07-16 19:35:29');
INSERT INTO `audittrail` VALUES (442, '', '66.249.73.202', 'http://guardsecure.newwavetech.co.ug/hr/managepersonnel.php?id=NTM=', '2012-07-16 23:44:43');
INSERT INTO `audittrail` VALUES (443, '', '125.77.202.62', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-07-17 02:32:55');
INSERT INTO `audittrail` VALUES (444, '', '125.77.202.62', 'http://guardsecure.newwavetech.co.ug/settings/index.php', '2012-07-17 02:33:59');
INSERT INTO `audittrail` VALUES (445, '', '125.77.202.62', 'http://guardsecure.newwavetech.co.ug/core/viewuser.php?id=', '2012-07-17 02:34:00');
INSERT INTO `audittrail` VALUES (446, '', '125.77.202.62', 'http://guardsecure.newwavetech.co.ug/settings/settings.php', '2012-07-17 02:34:01');
INSERT INTO `audittrail` VALUES (447, '', '125.77.202.62', 'http://guardsecure.newwavetech.co.ug/core/favorites.php', '2012-07-17 02:34:02');
INSERT INTO `audittrail` VALUES (448, '', '125.77.202.62', 'http://guardsecure.newwavetech.co.ug/core/reminders.php', '2012-07-17 02:34:03');
INSERT INTO `audittrail` VALUES (449, '', '66.249.73.202', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-07-17 07:15:40');
INSERT INTO `audittrail` VALUES (450, '', '83.233.186.82', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-07-17 10:08:49');
INSERT INTO `audittrail` VALUES (451, '', '109.87.138.55', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-07-17 14:24:36');
INSERT INTO `audittrail` VALUES (452, '', '83.233.186.82', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-07-18 09:51:28');
INSERT INTO `audittrail` VALUES (453, '', '222.186.26.41', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-07-18 11:36:41');
INSERT INTO `audittrail` VALUES (454, '', '196.0.21.52', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-07-19 07:56:16');
INSERT INTO `audittrail` VALUES (455, 'admin', '196.0.21.52', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-07-19 07:57:56');
INSERT INTO `audittrail` VALUES (456, 'admin', '196.0.21.52', 'http://guardsecure.newwavetech.co.ug/core/guardreport.php?f=Guard%20Daily%20Schedule', '2012-07-19 08:11:16');
INSERT INTO `audittrail` VALUES (457, 'admin', '196.0.21.52', 'http://guardsecure.newwavetech.co.ug/finance/report.php?f=Client%20Invoice', '2012-07-19 08:11:28');
INSERT INTO `audittrail` VALUES (458, 'admin', '196.0.21.52', 'http://guardsecure.newwavetech.co.ug/finance/report.php', '2012-07-19 08:12:21');
INSERT INTO `audittrail` VALUES (459, 'admin', '196.0.21.52', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-07-19 08:14:03');
INSERT INTO `audittrail` VALUES (460, 'admin', '196.0.21.52', 'http://guardsecure.newwavetech.co.ug/settings/index.php', '2012-07-19 08:15:10');
INSERT INTO `audittrail` VALUES (461, 'admin', '196.0.21.52', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-07-19 08:15:41');
INSERT INTO `audittrail` VALUES (462, 'admin', '196.0.21.52', 'http://guardsecure.newwavetech.co.ug/core/reminders.php', '2012-07-19 08:17:14');
INSERT INTO `audittrail` VALUES (463, 'admin', '196.0.21.52', 'http://guardsecure.newwavetech.co.ug/core/viewclient.php?id=MTM=', '2012-07-19 08:24:05');
INSERT INTO `audittrail` VALUES (464, 'admin', '196.0.21.52', 'http://guardsecure.newwavetech.co.ug/settings/settings.php', '2012-07-19 08:24:29');
INSERT INTO `audittrail` VALUES (465, 'admin', '196.0.21.52', 'http://guardsecure.newwavetech.co.ug/core/manageguarduniform.php', '2012-07-19 08:38:40');
INSERT INTO `audittrail` VALUES (466, 'admin', '196.0.21.52', 'http://guardsecure.newwavetech.co.ug/core/addguarduniform.php?action=edit&id=NzI=', '2012-07-19 08:38:53');
INSERT INTO `audittrail` VALUES (467, 'admin', '196.0.21.52', 'http://guardsecure.newwavetech.co.ug/core/addguarduniform.php', '2012-07-19 08:39:03');
INSERT INTO `audittrail` VALUES (468, 'admin', '196.0.21.52', 'http://guardsecure.newwavetech.co.ug/core/manageguarduniform.php', '2012-07-19 08:39:04');
INSERT INTO `audittrail` VALUES (469, 'admin', '196.0.21.52', 'http://guardsecure.newwavetech.co.ug/core/manageguarduniform.php?v=belt', '2012-07-19 08:39:19');
INSERT INTO `audittrail` VALUES (470, 'admin', '196.0.21.52', 'http://guardsecure.newwavetech.co.ug/core/addguarduniform.php', '2012-07-19 08:39:24');
INSERT INTO `audittrail` VALUES (471, 'admin', '196.0.21.52', 'http://guardsecure.newwavetech.co.ug/core/addguarduniform.php', '2012-07-19 08:39:32');
INSERT INTO `audittrail` VALUES (472, 'admin', '196.0.21.52', 'http://guardsecure.newwavetech.co.ug/core/manageguarduniform.php', '2012-07-19 08:39:32');
INSERT INTO `audittrail` VALUES (473, 'admin', '196.0.21.52', 'http://guardsecure.newwavetech.co.ug/core/manageguarduniform.php?id=MzM=&action=delete', '2012-07-19 08:39:43');
INSERT INTO `audittrail` VALUES (474, 'admin', '196.0.21.52', 'http://guardsecure.newwavetech.co.ug/settings/settings.php', '2012-07-19 08:39:58');
INSERT INTO `audittrail` VALUES (475, 'admin', '196.0.21.52', 'http://guardsecure.newwavetech.co.ug/settings/index.php', '2012-07-19 08:40:03');
INSERT INTO `audittrail` VALUES (476, 'admin', '196.0.21.52', 'http://guardsecure.newwavetech.co.ug/settings/settings.php', '2012-07-19 08:40:09');
INSERT INTO `audittrail` VALUES (477, 'admin', '196.0.21.52', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-07-19 08:40:20');
INSERT INTO `audittrail` VALUES (478, 'admin', '196.0.21.52', 'http://guardsecure.newwavetech.co.ug/finance/report.php?f=Client%20Invoice', '2012-07-19 08:41:02');
INSERT INTO `audittrail` VALUES (479, 'admin', '196.0.21.52', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-07-19 08:41:13');
INSERT INTO `audittrail` VALUES (480, 'admin', '196.0.21.52', 'http://guardsecure.newwavetech.co.ug/finance/manageguardfinance.php', '2012-07-19 08:41:34');
INSERT INTO `audittrail` VALUES (481, 'admin', '196.0.21.52', 'http://guardsecure.newwavetech.co.ug/finance/manageguardfinance.php', '2012-07-19 08:42:26');
INSERT INTO `audittrail` VALUES (482, 'admin', '196.0.21.52', 'http://guardsecure.newwavetech.co.ug/finance/manageguardfinance.php', '2012-07-19 08:42:49');
INSERT INTO `audittrail` VALUES (483, 'admin', '196.0.21.52', 'http://guardsecure.newwavetech.co.ug/finance/payslip.php?id=NDAwMFI=', '2012-07-19 09:11:07');
INSERT INTO `audittrail` VALUES (484, 'admin', '196.0.21.52', 'http://guardsecure.newwavetech.co.ug/finance/payslip.php', '2012-07-19 09:11:19');
INSERT INTO `audittrail` VALUES (485, '', '83.233.186.82', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-07-19 10:57:40');
INSERT INTO `audittrail` VALUES (486, '', '196.0.21.52', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-07-20 04:02:33');
INSERT INTO `audittrail` VALUES (487, 'admin', '196.0.21.52', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-07-20 04:03:40');
INSERT INTO `audittrail` VALUES (488, 'admin', '196.0.21.52', 'http://guardsecure.newwavetech.co.ug/hr/manageguards.php', '2012-07-20 04:11:55');
INSERT INTO `audittrail` VALUES (489, 'admin', '196.0.21.52', 'http://guardsecure.newwavetech.co.ug/hr/managepersonnel.php?id=MzIwVA==', '2012-07-20 04:12:55');
INSERT INTO `audittrail` VALUES (490, 'admin', '196.0.21.52', 'http://guardsecure.newwavetech.co.ug/hr/viewpersonnelfile.php?id=NDI=', '2012-07-20 04:13:17');
INSERT INTO `audittrail` VALUES (491, 'admin', '196.0.21.52', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-07-20 04:14:43');
INSERT INTO `audittrail` VALUES (492, 'admin', '196.0.21.52', 'http://guardsecure.newwavetech.co.ug/hr/managepersonnel.php', '2012-07-20 04:18:08');
INSERT INTO `audittrail` VALUES (493, 'admin', '196.0.21.52', 'http://guardsecure.newwavetech.co.ug/hr/managepersonnel.php?id=MjEwVA==', '2012-07-20 04:18:31');
INSERT INTO `audittrail` VALUES (494, 'admin', '196.0.21.52', 'http://guardsecure.newwavetech.co.ug/hr/viewpersonnelfile.php?id=NTI=', '2012-07-20 04:18:50');
INSERT INTO `audittrail` VALUES (495, 'admin', '196.0.21.52', 'http://guardsecure.newwavetech.co.ug/settings/settings.php', '2012-07-20 04:20:38');
INSERT INTO `audittrail` VALUES (496, 'admin', '196.0.21.52', 'http://guardsecure.newwavetech.co.ug/core/managedepartments.php', '2012-07-20 04:21:38');
INSERT INTO `audittrail` VALUES (497, 'admin', '196.0.21.52', 'http://guardsecure.newwavetech.co.ug/core/adddepartment.php', '2012-07-20 04:24:19');
INSERT INTO `audittrail` VALUES (498, 'admin', '196.0.21.52', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-07-20 04:24:48');
INSERT INTO `audittrail` VALUES (499, 'admin', '196.0.21.52', 'http://guardsecure.newwavetech.co.ug/operations/sitreps.php', '2012-07-20 04:42:13');
INSERT INTO `audittrail` VALUES (500, 'admin', '196.0.21.52', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-07-20 04:44:27');
INSERT INTO `audittrail` VALUES (501, 'admin', '196.0.21.52', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-07-20 05:28:35');
INSERT INTO `audittrail` VALUES (502, 'admin', '196.0.21.52', 'http://guardsecure.newwavetech.co.ug/hr/manageleave.php', '2012-07-20 05:43:25');
INSERT INTO `audittrail` VALUES (503, 'admin', '196.0.21.52', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-07-20 05:57:38');
INSERT INTO `audittrail` VALUES (504, 'admin', '196.0.21.52', 'http://guardsecure.newwavetech.co.ug/technical/managealarminstallations.php', '2012-07-20 05:58:55');
INSERT INTO `audittrail` VALUES (505, 'admin', '196.0.21.52', 'http://guardsecure.newwavetech.co.ug/technical/alarminstallations.php?action=view&id=MTE=', '2012-07-20 05:59:28');
INSERT INTO `audittrail` VALUES (506, 'admin', '196.0.21.52', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-07-20 05:59:59');
INSERT INTO `audittrail` VALUES (507, 'admin', '196.0.21.52', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-07-20 06:06:47');
INSERT INTO `audittrail` VALUES (508, '', '196.0.21.52', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-07-20 06:06:57');
INSERT INTO `audittrail` VALUES (509, 'admin', '196.0.21.52', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-07-20 06:07:08');
INSERT INTO `audittrail` VALUES (510, 'admin', '196.0.21.52', 'http://guardsecure.newwavetech.co.ug/hr/manageguards.php', '2012-07-20 06:07:22');
INSERT INTO `audittrail` VALUES (511, 'admin', '196.0.21.52', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-07-20 06:07:43');
INSERT INTO `audittrail` VALUES (512, 'admin', '196.0.21.52', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-07-20 06:08:31');
INSERT INTO `audittrail` VALUES (513, 'admin', '196.0.21.52', 'http://guardsecure.newwavetech.co.ug/core/manageclients.php', '2012-07-20 06:09:57');
INSERT INTO `audittrail` VALUES (514, 'admin', '196.0.21.52', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-07-20 06:10:29');
INSERT INTO `audittrail` VALUES (515, 'admin', '196.0.21.52', 'http://guardsecure.newwavetech.co.ug/finance/managetransactions.php?t=d29sZnR1bw==', '2012-07-20 06:10:38');
INSERT INTO `audittrail` VALUES (516, 'admin', '196.0.21.52', 'http://guardsecure.newwavetech.co.ug/finance/transaction.php?id=NQ==&a=edit&t=d29sZnR1bw==', '2012-07-20 06:10:53');
INSERT INTO `audittrail` VALUES (517, 'admin', '196.0.21.52', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-07-20 06:11:47');
INSERT INTO `audittrail` VALUES (518, '', '218.85.143.218', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-07-20 08:40:42');
INSERT INTO `audittrail` VALUES (519, '', '66.249.71.137', 'http://guardsecure.newwavetech.co.ug/hr/managepersonnel.php?id=NzM=', '2012-07-20 09:26:23');
INSERT INTO `audittrail` VALUES (520, '', '66.249.71.137', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-07-20 11:26:00');
INSERT INTO `audittrail` VALUES (521, '', '83.233.186.82', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-07-20 12:16:46');
INSERT INTO `audittrail` VALUES (522, '', '180.76.5.151', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-07-21 07:57:52');
INSERT INTO `audittrail` VALUES (523, '', '83.233.186.82', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-07-21 09:40:46');
INSERT INTO `audittrail` VALUES (524, '', '83.233.186.82', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-07-21 09:44:36');
INSERT INTO `audittrail` VALUES (525, '', '66.249.71.137', 'http://guardsecure.newwavetech.co.ug/hr/managepersonnel.php?id=MzIxMzIx', '2012-07-22 05:35:25');
INSERT INTO `audittrail` VALUES (526, '', '83.233.186.82', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-07-22 10:25:31');
INSERT INTO `audittrail` VALUES (527, '', '41.221.93.229', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-07-22 14:12:14');
INSERT INTO `audittrail` VALUES (528, 'admin', '41.221.93.229', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-07-22 14:12:46');
INSERT INTO `audittrail` VALUES (529, 'admin', '41.221.93.229', 'http://guardsecure.newwavetech.co.ug/core/manageclients.php', '2012-07-22 14:13:13');
INSERT INTO `audittrail` VALUES (530, 'admin', '41.221.93.229', 'http://guardsecure.newwavetech.co.ug/core/client.php', '2012-07-22 14:13:28');
INSERT INTO `audittrail` VALUES (531, 'admin', '41.221.93.229', 'http://guardsecure.newwavetech.co.ug/core/manageclients.php', '2012-07-22 14:13:35');
INSERT INTO `audittrail` VALUES (532, 'admin', '41.221.93.229', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-07-22 14:13:48');
INSERT INTO `audittrail` VALUES (533, '', '196.0.21.52', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-07-23 02:11:39');
INSERT INTO `audittrail` VALUES (534, 'admin', '196.0.21.52', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-07-23 02:11:50');
INSERT INTO `audittrail` VALUES (535, '', '83.233.186.82', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-07-23 09:58:59');
INSERT INTO `audittrail` VALUES (536, '', '218.85.143.218', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-07-24 06:14:22');
INSERT INTO `audittrail` VALUES (537, '', '83.233.186.82', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-07-24 10:47:22');
INSERT INTO `audittrail` VALUES (538, '', '93.182.171.3', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-07-24 19:14:41');
INSERT INTO `audittrail` VALUES (539, '', '93.182.171.3', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-07-24 19:14:42');
INSERT INTO `audittrail` VALUES (540, '', '83.233.186.82', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-07-25 09:20:38');
INSERT INTO `audittrail` VALUES (541, '', '83.233.186.82', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-07-25 09:37:12');
INSERT INTO `audittrail` VALUES (542, '', '66.249.73.202', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-07-25 12:25:29');
INSERT INTO `audittrail` VALUES (543, '', '83.233.186.82', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-07-26 09:39:58');
INSERT INTO `audittrail` VALUES (544, '', '218.85.143.218', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-07-27 02:35:25');
INSERT INTO `audittrail` VALUES (545, '', '218.85.143.218', 'http://guardsecure.newwavetech.co.ug/settings/index.php', '2012-07-27 02:36:14');
INSERT INTO `audittrail` VALUES (546, '', '218.85.143.218', 'http://guardsecure.newwavetech.co.ug/core/viewuser.php?id=', '2012-07-27 02:36:15');
INSERT INTO `audittrail` VALUES (547, '', '218.85.143.218', 'http://guardsecure.newwavetech.co.ug/settings/settings.php', '2012-07-27 02:36:16');
INSERT INTO `audittrail` VALUES (548, '', '218.85.143.218', 'http://guardsecure.newwavetech.co.ug/core/favorites.php', '2012-07-27 02:36:17');
INSERT INTO `audittrail` VALUES (549, '', '218.85.143.218', 'http://guardsecure.newwavetech.co.ug/core/reminders.php', '2012-07-27 02:36:18');
INSERT INTO `audittrail` VALUES (550, '', '83.233.186.82', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-07-27 09:22:43');
INSERT INTO `audittrail` VALUES (551, '', '180.76.5.58', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-07-27 22:51:13');
INSERT INTO `audittrail` VALUES (552, '', '83.233.186.82', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-07-28 08:05:33');
INSERT INTO `audittrail` VALUES (553, '', '83.233.186.82', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-07-28 08:15:54');
INSERT INTO `audittrail` VALUES (554, '', '93.182.164.113', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-07-28 17:32:45');
INSERT INTO `audittrail` VALUES (555, '', '93.182.164.113', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-07-28 17:32:45');
INSERT INTO `audittrail` VALUES (556, '', '91.201.64.223', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-07-28 21:49:44');
INSERT INTO `audittrail` VALUES (557, '', '188.143.232.213', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-07-29 03:45:00');
INSERT INTO `audittrail` VALUES (558, '', '83.233.186.82', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-07-29 08:25:51');
INSERT INTO `audittrail` VALUES (559, '', '83.233.186.82', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-07-30 08:23:26');
INSERT INTO `audittrail` VALUES (560, '', '41.202.225.155', 'http://guardsecure.newwavetech.co.ug/core/managegroups.php', '2012-07-31 03:38:51');
INSERT INTO `audittrail` VALUES (561, 'mtukahirwa', '41.202.225.155', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-07-31 03:40:04');
INSERT INTO `audittrail` VALUES (562, 'mtukahirwa', '41.202.225.155', 'http://guardsecure.newwavetech.co.ug/hr/manageguards.php', '2012-07-31 03:40:47');
INSERT INTO `audittrail` VALUES (563, 'mtukahirwa', '41.202.225.155', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-07-31 03:41:29');
INSERT INTO `audittrail` VALUES (564, 'mtukahirwa', '41.202.225.155', 'http://guardsecure.newwavetech.co.ug/settings/settings.php', '2012-07-31 03:43:28');
INSERT INTO `audittrail` VALUES (565, 'mtukahirwa', '41.202.225.155', 'http://guardsecure.newwavetech.co.ug/core/viewuser.php?id=NjI=', '2012-07-31 03:50:35');
INSERT INTO `audittrail` VALUES (566, 'mtukahirwa', '41.202.225.155', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-07-31 03:51:18');
INSERT INTO `audittrail` VALUES (567, 'mtukahirwa', '41.202.225.155', 'http://guardsecure.newwavetech.co.ug/core/manageclients.php', '2012-07-31 03:56:14');
INSERT INTO `audittrail` VALUES (568, 'mtukahirwa', '41.202.225.155', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-07-31 03:56:48');
INSERT INTO `audittrail` VALUES (569, 'mtukahirwa', '41.202.225.155', 'http://guardsecure.newwavetech.co.ug/core/client.php', '2012-07-31 03:56:49');
INSERT INTO `audittrail` VALUES (570, 'mtukahirwa', '41.202.225.155', 'http://guardsecure.newwavetech.co.ug/core/manageclients.php', '2012-07-31 03:57:02');
INSERT INTO `audittrail` VALUES (571, 'mtukahirwa', '41.202.225.155', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-07-31 03:57:04');
INSERT INTO `audittrail` VALUES (572, 'mtukahirwa', '41.202.225.155', 'http://guardsecure.newwavetech.co.ug/core/manageassignments.php', '2012-07-31 03:57:19');
INSERT INTO `audittrail` VALUES (573, 'mtukahirwa', '41.202.225.155', 'http://guardsecure.newwavetech.co.ug/core/generatetwo.php?id=108&t=ZHJhdWc=', '2012-07-31 03:57:37');
INSERT INTO `audittrail` VALUES (574, 'mtukahirwa', '41.202.225.155', 'http://guardsecure.newwavetech.co.ug/core/manageassignments.php', '2012-07-31 03:57:57');
INSERT INTO `audittrail` VALUES (575, 'mtukahirwa', '41.202.225.155', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-07-31 03:58:02');
INSERT INTO `audittrail` VALUES (576, '', '83.233.186.82', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-07-31 09:21:29');
INSERT INTO `audittrail` VALUES (577, '', '196.0.21.52', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-07-31 09:56:43');
INSERT INTO `audittrail` VALUES (578, 'admin', '196.0.21.52', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-07-31 09:57:02');
INSERT INTO `audittrail` VALUES (579, 'admin', '196.0.21.52', 'http://guardsecure.newwavetech.co.ug/core/reminders.php', '2012-07-31 09:57:50');
INSERT INTO `audittrail` VALUES (580, 'admin', '196.0.21.52', 'http://guardsecure.newwavetech.co.ug/finance/approvals.php?id=MDI=&t=gm', '2012-07-31 09:58:22');
INSERT INTO `audittrail` VALUES (581, 'admin', '196.0.21.52', 'http://guardsecure.newwavetech.co.ug/finance/manageguardloans.php', '2012-07-31 09:58:58');
INSERT INTO `audittrail` VALUES (582, '', '206.83.60.47', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-07-31 13:18:14');
INSERT INTO `audittrail` VALUES (583, '', '180.76.5.60', 'http://guardsecure.newwavetech.co.ug/settings/index.php', '2012-07-31 16:14:43');
INSERT INTO `audittrail` VALUES (584, '', '180.76.5.175', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-07-31 16:14:45');
INSERT INTO `audittrail` VALUES (585, '', '196.0.21.52', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-08-01 01:57:03');
INSERT INTO `audittrail` VALUES (586, 'admin', '196.0.21.52', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-08-01 01:58:13');
INSERT INTO `audittrail` VALUES (587, '', '196.0.21.52', 'http://tiger.guardsecure.net/core/dashboard.php', '2012-08-01 03:12:37');
INSERT INTO `audittrail` VALUES (588, 'admin', '196.0.21.52', 'http://tiger.guardsecure.net/core/dashboard.php', '2012-08-01 03:13:55');
INSERT INTO `audittrail` VALUES (589, 'admin', '196.0.21.52', 'http://tiger.guardsecure.net/core/client.php', '2012-08-01 03:14:34');
INSERT INTO `audittrail` VALUES (590, 'admin', '196.0.21.52', 'http://tiger.guardsecure.net/core/dashboard.php', '2012-08-01 03:15:30');
INSERT INTO `audittrail` VALUES (591, 'admin', '196.0.21.52', 'http://tiger.guardsecure.net/finance/managerates.php', '2012-08-01 03:17:34');
INSERT INTO `audittrail` VALUES (592, 'admin', '196.0.21.52', 'http://tiger.guardsecure.net/core/dashboard.php', '2012-08-01 03:23:18');
INSERT INTO `audittrail` VALUES (593, 'admin', '196.0.21.52', 'http://tiger.guardsecure.net/finance/manageguardfinance.php', '2012-08-01 03:24:52');
INSERT INTO `audittrail` VALUES (594, 'admin', '196.0.21.52', 'http://tiger.guardsecure.net/finance/manageguardfinance.php', '2012-08-01 03:25:30');
INSERT INTO `audittrail` VALUES (595, 'admin', '196.0.21.52', 'http://tiger.guardsecure.net/settings/settings.php', '2012-08-01 03:37:10');
INSERT INTO `audittrail` VALUES (596, 'admin', '196.0.21.52', 'http://tiger.guardsecure.net/settings/payeformula.php', '2012-08-01 03:37:17');
INSERT INTO `audittrail` VALUES (597, 'admin', '196.0.21.52', 'http://tiger.guardsecure.net/core/dashboard.php', '2012-08-01 03:37:45');
INSERT INTO `audittrail` VALUES (598, 'admin', '196.0.21.52', 'http://tiger.guardsecure.net/finance/manageguardfinance.php', '2012-08-01 03:52:16');
INSERT INTO `audittrail` VALUES (599, 'admin', '196.0.21.52', 'http://tiger.guardsecure.net/finance/index.php?id=NDAwMFI=&t=subtract', '2012-08-01 03:52:25');
INSERT INTO `audittrail` VALUES (600, 'admin', '196.0.21.52', 'http://tiger.guardsecure.net/finance/manageguardfinance.php', '2012-08-01 03:52:47');
INSERT INTO `audittrail` VALUES (601, 'admin', '196.0.21.52', 'http://tiger.guardsecure.net/finance/manageguardfinance.php', '2012-08-01 03:53:03');
INSERT INTO `audittrail` VALUES (602, 'admin', '196.0.21.52', 'http://tiger.guardsecure.net/finance/manageguardfinance.php', '2012-08-01 03:54:02');
INSERT INTO `audittrail` VALUES (603, 'admin', '196.0.21.52', 'http://tiger.guardsecure.net/core/dashboard.php', '2012-08-01 03:54:20');
INSERT INTO `audittrail` VALUES (604, 'admin', '196.0.21.52', 'http://tiger.guardsecure.net/finance/report.php?f=Guard%20Payroll', '2012-08-01 03:54:27');
INSERT INTO `audittrail` VALUES (605, 'admin', '196.0.21.52', 'http://tiger.guardsecure.net/finance/report.php', '2012-08-01 03:55:06');
INSERT INTO `audittrail` VALUES (606, '', '196.0.21.52', 'http://tiger.guardsecure.net/core/dashboard.php', '2012-08-01 07:05:45');
INSERT INTO `audittrail` VALUES (607, 'admin', '196.0.21.52', 'http://tiger.guardsecure.net/core/dashboard.php', '2012-08-01 07:06:17');
INSERT INTO `audittrail` VALUES (608, '', '196.0.21.52', 'http://tiger.guardsecure.net/core/dashboard.php', '2012-08-01 07:12:29');
INSERT INTO `audittrail` VALUES (609, 'admin', '196.0.21.52', 'http://tiger.guardsecure.net/core/dashboard.php', '2012-08-01 07:12:54');
INSERT INTO `audittrail` VALUES (610, 'admin', '196.0.21.52', 'http://tiger.guardsecure.net/core/dashboard.php', '2012-08-01 08:33:49');
INSERT INTO `audittrail` VALUES (611, 'admin', '196.0.21.52', 'http://tiger.guardsecure.net/core/manageclients.php', '2012-08-01 08:35:22');
INSERT INTO `audittrail` VALUES (612, '', '83.233.186.82', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-08-01 09:16:17');
INSERT INTO `audittrail` VALUES (613, '', '83.233.186.82', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-08-01 09:18:00');
INSERT INTO `audittrail` VALUES (614, '', '208.115.111.71', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-08-01 10:01:05');
INSERT INTO `audittrail` VALUES (615, '', '93.182.173.52', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-08-01 17:38:16');
INSERT INTO `audittrail` VALUES (616, '', '93.182.173.52', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-08-01 17:38:16');
INSERT INTO `audittrail` VALUES (617, '', '146.0.74.210', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-08-02 00:29:26');
INSERT INTO `audittrail` VALUES (618, '', '146.0.74.210', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-08-02 00:29:26');
INSERT INTO `audittrail` VALUES (619, '', '41.223.85.245', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-08-02 06:43:41');
INSERT INTO `audittrail` VALUES (620, '', '83.233.186.82', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-08-02 08:30:21');
INSERT INTO `audittrail` VALUES (621, '', '188.143.232.213', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-08-03 05:11:06');
INSERT INTO `audittrail` VALUES (622, '', '91.201.64.223', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-08-03 06:40:28');
INSERT INTO `audittrail` VALUES (623, '', '83.233.186.82', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-08-03 08:08:24');
INSERT INTO `audittrail` VALUES (624, '', '83.233.186.82', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-08-03 08:12:02');
INSERT INTO `audittrail` VALUES (625, '', '91.201.64.223', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-08-03 10:17:40');
INSERT INTO `audittrail` VALUES (626, '', '91.201.64.223', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-08-03 15:01:57');
INSERT INTO `audittrail` VALUES (627, '', '66.249.73.202', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-08-04 03:47:22');
INSERT INTO `audittrail` VALUES (628, '', '83.233.186.82', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-08-04 07:48:49');
INSERT INTO `audittrail` VALUES (629, '', '41.217.236.13', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-08-04 08:14:03');
INSERT INTO `audittrail` VALUES (630, '', '41.217.236.13', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-08-04 08:16:04');
INSERT INTO `audittrail` VALUES (631, '', '180.76.5.142', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-08-04 09:40:45');
INSERT INTO `audittrail` VALUES (632, '', '83.233.186.82', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-08-05 08:16:04');
INSERT INTO `audittrail` VALUES (633, '', '83.233.186.82', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-08-06 07:39:10');
INSERT INTO `audittrail` VALUES (634, '', '76.73.3.18', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-08-06 11:09:15');
INSERT INTO `audittrail` VALUES (635, '', '71.178.171.18', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-08-06 14:07:25');
INSERT INTO `audittrail` VALUES (636, '', '41.222.2.32', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-08-07 04:44:51');
INSERT INTO `audittrail` VALUES (637, '', '83.233.186.82', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-08-07 07:55:06');
INSERT INTO `audittrail` VALUES (638, '', '83.233.186.82', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-08-07 08:06:32');
INSERT INTO `audittrail` VALUES (639, '', '196.0.21.52', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-08-08 03:38:33');
INSERT INTO `audittrail` VALUES (640, 'Username', '196.0.21.52', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-08-08 03:40:54');
INSERT INTO `audittrail` VALUES (641, 'admin', '196.0.21.52', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-08-08 07:06:01');
INSERT INTO `audittrail` VALUES (642, '', '83.233.186.82', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-08-08 07:46:43');
INSERT INTO `audittrail` VALUES (643, 'admin', '196.0.21.52', 'http://guardsecure.newwavetech.co.ug/hr/manageguards.php', '2012-08-08 08:26:01');
INSERT INTO `audittrail` VALUES (644, 'admin', '196.0.21.52', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-08-08 08:26:20');
INSERT INTO `audittrail` VALUES (645, 'admin', '196.0.21.52', 'http://guardsecure.newwavetech.co.ug/core/manageclients.php', '2012-08-08 08:26:23');
INSERT INTO `audittrail` VALUES (646, 'admin', '196.0.21.52', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-08-08 08:26:51');
INSERT INTO `audittrail` VALUES (647, 'admin', '196.0.21.52', 'http://guardsecure.newwavetech.co.ug/core/manageusers.php', '2012-08-08 08:26:56');
INSERT INTO `audittrail` VALUES (648, 'admin', '196.0.21.52', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-08-08 08:27:55');
INSERT INTO `audittrail` VALUES (649, 'admin', '196.0.21.52', 'http://guardsecure.newwavetech.co.ug/finance/manageguardloans.php', '2012-08-08 08:28:00');
INSERT INTO `audittrail` VALUES (650, 'admin', '196.0.21.52', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-08-08 08:28:07');
INSERT INTO `audittrail` VALUES (651, 'admin', '196.0.21.52', 'http://guardsecure.newwavetech.co.ug/hr/managepromotions.php', '2012-08-08 08:28:11');
INSERT INTO `audittrail` VALUES (652, 'admin', '196.0.21.52', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-08-08 08:28:20');
INSERT INTO `audittrail` VALUES (653, 'admin', '196.0.21.52', 'http://guardsecure.newwavetech.co.ug/inventory/manageitempurchases.php', '2012-08-08 08:50:41');
INSERT INTO `audittrail` VALUES (654, 'admin', '196.0.21.52', 'http://guardsecure.newwavetech.co.ug/inventory/manageitempurchases.php', '2012-08-08 08:50:59');
INSERT INTO `audittrail` VALUES (655, 'admin', '196.0.21.52', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-08-08 08:51:04');
INSERT INTO `audittrail` VALUES (656, 'admin', '196.0.21.52', 'http://guardsecure.newwavetech.co.ug/finance/manageguardfinance.php', '2012-08-08 08:51:09');
INSERT INTO `audittrail` VALUES (657, 'admin', '196.0.21.52', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-08-08 08:51:23');
INSERT INTO `audittrail` VALUES (658, 'admin', '196.0.21.52', 'http://guardsecure.newwavetech.co.ug/core/region.php', '2012-08-08 08:51:27');
INSERT INTO `audittrail` VALUES (659, 'admin', '196.0.21.52', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-08-08 08:51:33');
INSERT INTO `audittrail` VALUES (660, 'admin', '196.0.21.52', 'http://guardsecure.newwavetech.co.ug/hr/managepromotions.php', '2012-08-08 08:51:42');
INSERT INTO `audittrail` VALUES (661, 'admin', '196.0.21.52', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-08-08 08:57:11');
INSERT INTO `audittrail` VALUES (662, 'admin', '196.0.21.52', 'http://guardsecure.newwavetech.co.ug/hr/manageguards.php', '2012-08-08 08:59:25');
INSERT INTO `audittrail` VALUES (663, 'admin', '196.0.21.52', 'http://guardsecure.newwavetech.co.ug/hr/index.php', '2012-08-08 09:01:49');
INSERT INTO `audittrail` VALUES (664, 'admin', '196.0.21.52', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-08-08 09:17:59');
INSERT INTO `audittrail` VALUES (665, 'admin', '196.0.21.52', 'http://guardsecure.newwavetech.co.ug/core/manageclients.php', '2012-08-08 09:19:29');
INSERT INTO `audittrail` VALUES (666, 'admin', '196.0.21.52', 'http://guardsecure.newwavetech.co.ug/core/client.php', '2012-08-08 09:19:34');
INSERT INTO `audittrail` VALUES (667, 'admin', '196.0.21.52', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-08-08 09:20:21');
INSERT INTO `audittrail` VALUES (668, 'admin', '196.0.21.52', 'http://guardsecure.newwavetech.co.ug/core/manageusers.php', '2012-08-08 09:20:31');
INSERT INTO `audittrail` VALUES (669, 'admin', '196.0.21.52', 'http://guardsecure.newwavetech.co.ug/core/user.php', '2012-08-08 09:20:35');
INSERT INTO `audittrail` VALUES (670, 'admin', '196.0.21.52', 'http://guardsecure.newwavetech.co.ug/core/manageusers.php', '2012-08-08 09:20:51');
INSERT INTO `audittrail` VALUES (671, 'admin', '196.0.21.52', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-08-08 09:20:56');
INSERT INTO `audittrail` VALUES (672, 'admin', '196.0.21.52', 'http://guardsecure.newwavetech.co.ug/settings/settings.php', '2012-08-08 09:20:59');
INSERT INTO `audittrail` VALUES (673, 'admin', '196.0.21.52', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-08-08 09:21:34');
INSERT INTO `audittrail` VALUES (674, 'admin', '196.0.21.52', 'http://guardsecure.newwavetech.co.ug/finance/manageguardloans.php', '2012-08-08 09:22:31');
INSERT INTO `audittrail` VALUES (675, 'admin', '196.0.21.52', 'http://guardsecure.newwavetech.co.ug/finance/loan.php?id=NDE=&a=edit', '2012-08-08 09:22:41');
INSERT INTO `audittrail` VALUES (676, 'admin', '196.0.21.52', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-08-08 09:22:51');
INSERT INTO `audittrail` VALUES (677, 'admin', '196.0.21.52', 'http://guardsecure.newwavetech.co.ug/transport/managefueldistribution.php', '2012-08-08 09:23:03');
INSERT INTO `audittrail` VALUES (678, 'admin', '196.0.21.52', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-08-08 09:23:11');
INSERT INTO `audittrail` VALUES (679, '', '196.0.21.52', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-08-09 02:28:26');
INSERT INTO `audittrail` VALUES (680, '', '196.0.21.52', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-08-09 03:52:50');
INSERT INTO `audittrail` VALUES (681, 'admin', '196.0.21.52', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-08-09 03:53:04');
INSERT INTO `audittrail` VALUES (682, '', '196.0.21.52', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-08-09 04:51:06');
INSERT INTO `audittrail` VALUES (683, '', '196.0.21.52', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-08-09 04:51:19');
INSERT INTO `audittrail` VALUES (684, '', '196.0.21.52', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-08-09 04:51:34');
INSERT INTO `audittrail` VALUES (685, 'admin', '196.0.21.52', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-08-09 04:52:03');
INSERT INTO `audittrail` VALUES (686, 'admin', '196.0.21.52', 'http://guardsecure.newwavetech.co.ug/core/client.php', '2012-08-09 04:52:25');
INSERT INTO `audittrail` VALUES (687, 'admin', '196.0.21.52', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-08-09 04:52:45');
INSERT INTO `audittrail` VALUES (688, 'admin', '196.0.21.52', 'http://guardsecure.newwavetech.co.ug/hr/manageguards.php', '2012-08-09 04:53:02');
INSERT INTO `audittrail` VALUES (689, 'admin', '196.0.21.52', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-08-09 04:53:56');
INSERT INTO `audittrail` VALUES (690, 'admin', '196.0.21.52', 'http://guardsecure.newwavetech.co.ug/core/manageclients.php', '2012-08-09 04:54:02');
INSERT INTO `audittrail` VALUES (691, 'admin', '196.0.21.52', 'http://guardsecure.newwavetech.co.ug/core/manageassignments.php?a=search&clientid=MDI=', '2012-08-09 04:54:12');
INSERT INTO `audittrail` VALUES (692, 'admin', '196.0.21.52', 'http://guardsecure.newwavetech.co.ug/core/generatetwo.php?id=89&t=ZHJhdWc=', '2012-08-09 04:54:28');
INSERT INTO `audittrail` VALUES (693, 'admin', '196.0.21.52', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-08-09 04:56:01');
INSERT INTO `audittrail` VALUES (694, 'admin', '196.0.21.52', 'http://guardsecure.newwavetech.co.ug/core/group.php', '2012-08-09 04:57:41');
INSERT INTO `audittrail` VALUES (695, 'admin', '196.0.21.52', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-08-09 05:02:05');
INSERT INTO `audittrail` VALUES (696, 'admin', '196.0.21.52', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-08-09 05:06:49');
INSERT INTO `audittrail` VALUES (697, 'admin', '196.0.21.52', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-08-09 05:11:51');
INSERT INTO `audittrail` VALUES (698, '', '196.0.21.52', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-08-09 05:54:56');
INSERT INTO `audittrail` VALUES (699, '', '64.120.225.83', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-08-09 06:04:05');
INSERT INTO `audittrail` VALUES (700, '', '64.120.225.83', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-08-09 06:04:07');
INSERT INTO `audittrail` VALUES (701, '', '83.233.186.82', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-08-09 08:21:50');
INSERT INTO `audittrail` VALUES (702, '', '188.143.232.211', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-08-09 17:56:56');
INSERT INTO `audittrail` VALUES (703, '', '100.43.83.145', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-08-09 22:53:31');
INSERT INTO `audittrail` VALUES (704, '', '180.76.5.93', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-08-10 01:44:34');
INSERT INTO `audittrail` VALUES (705, '', '204.236.235.245', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-08-10 01:44:41');
INSERT INTO `audittrail` VALUES (706, '', '176.215.190.98', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-08-10 06:27:15');
INSERT INTO `audittrail` VALUES (707, '', '176.215.190.98', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-08-10 06:27:16');
INSERT INTO `audittrail` VALUES (708, '', '83.233.186.82', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-08-10 07:46:21');
INSERT INTO `audittrail` VALUES (709, '', '83.233.186.82', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-08-10 08:01:24');
INSERT INTO `audittrail` VALUES (710, '', '83.233.186.82', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-08-11 08:02:15');
INSERT INTO `audittrail` VALUES (711, '', '83.233.186.82', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-08-11 08:05:45');
INSERT INTO `audittrail` VALUES (712, '', '188.190.127.70', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-08-11 11:10:48');
INSERT INTO `audittrail` VALUES (713, '', '77.222.128.221', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-08-11 21:58:04');
INSERT INTO `audittrail` VALUES (714, '', '77.222.128.221', 'http://guardsecure.newwavetech.co.ug/settings/index.php', '2012-08-11 21:58:17');
INSERT INTO `audittrail` VALUES (715, '', '83.233.186.82', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-08-12 07:59:57');
INSERT INTO `audittrail` VALUES (716, '', '188.186.200.67', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-08-12 11:28:48');
INSERT INTO `audittrail` VALUES (717, '', '188.186.200.67', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-08-12 11:28:49');
INSERT INTO `audittrail` VALUES (718, '', '188.190.126.72', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-08-12 21:23:23');
INSERT INTO `audittrail` VALUES (719, '', '83.233.186.82', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-08-13 07:50:20');
INSERT INTO `audittrail` VALUES (720, '', '83.233.186.82', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-08-13 08:07:59');
INSERT INTO `audittrail` VALUES (721, '', '66.249.73.202', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-08-14 00:00:58');
INSERT INTO `audittrail` VALUES (722, '', '41.202.225.154', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-08-14 05:57:17');
INSERT INTO `audittrail` VALUES (723, '', '83.233.186.82', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-08-14 07:46:36');
INSERT INTO `audittrail` VALUES (724, '', '83.233.186.82', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-08-14 08:16:03');
INSERT INTO `audittrail` VALUES (725, '', '212.227.136.205', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-08-14 13:39:01');
INSERT INTO `audittrail` VALUES (726, '', '212.227.136.205', 'http://guardsecure.newwavetech.co.ug/core/viewuser.php?id=', '2012-08-14 13:40:20');
INSERT INTO `audittrail` VALUES (727, '', '212.227.136.205', 'http://guardsecure.newwavetech.co.ug/settings/settings.php', '2012-08-14 13:40:27');
INSERT INTO `audittrail` VALUES (728, '', '212.227.136.205', 'http://guardsecure.newwavetech.co.ug/core/favorites.php', '2012-08-14 13:40:41');
INSERT INTO `audittrail` VALUES (729, '', '212.227.136.205', 'http://guardsecure.newwavetech.co.ug/core/reminders.php', '2012-08-14 13:40:48');
INSERT INTO `audittrail` VALUES (730, '', '212.227.136.205', 'http://guardsecure.newwavetech.co.ug/settings/index.php', '2012-08-14 13:40:51');
INSERT INTO `audittrail` VALUES (731, '', '212.227.136.205', 'http://guardsecure.newwavetech.co.ug/core/user.php?id=&action=edit', '2012-08-14 13:42:06');
INSERT INTO `audittrail` VALUES (732, '', '178.255.215.79', 'http://guardsecure.newwavetech.co.ug/core/viewuser.php?id=', '2012-08-14 20:43:40');
INSERT INTO `audittrail` VALUES (733, '', '41.77.75.37', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-08-15 06:28:15');
INSERT INTO `audittrail` VALUES (734, 'admin', '41.77.75.37', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-08-15 06:29:13');
INSERT INTO `audittrail` VALUES (735, 'admin', '41.77.75.37', 'http://guardsecure.newwavetech.co.ug/hr/manageguards.php', '2012-08-15 06:29:37');
INSERT INTO `audittrail` VALUES (736, 'admin', '41.77.75.37', 'http://guardsecure.newwavetech.co.ug/hr/index.php', '2012-08-15 06:29:55');
INSERT INTO `audittrail` VALUES (737, 'admin', '41.77.75.37', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-08-15 06:31:05');
INSERT INTO `audittrail` VALUES (738, 'admin', '41.77.75.37', 'http://guardsecure.newwavetech.co.ug/hr/manageguards.php', '2012-08-15 06:31:21');
INSERT INTO `audittrail` VALUES (739, 'admin', '41.77.75.37', 'http://guardsecure.newwavetech.co.ug/hr/managepersonnel.php?id=NDU1Rg==', '2012-08-15 06:31:25');
INSERT INTO `audittrail` VALUES (740, 'admin', '41.77.75.37', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-08-15 06:31:32');
INSERT INTO `audittrail` VALUES (741, 'admin', '41.77.75.37', 'http://guardsecure.newwavetech.co.ug/hr/manageguards.php', '2012-08-15 06:31:37');
INSERT INTO `audittrail` VALUES (742, 'admin', '41.77.75.37', 'http://guardsecure.newwavetech.co.ug/hr/index.php', '2012-08-15 06:32:05');
INSERT INTO `audittrail` VALUES (743, 'admin', '41.77.75.37', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-08-15 06:32:59');
INSERT INTO `audittrail` VALUES (744, 'admin', '41.77.75.37', 'http://guardsecure.newwavetech.co.ug/inventory/inventorystock.php', '2012-08-15 06:33:42');
INSERT INTO `audittrail` VALUES (745, 'admin', '41.77.75.37', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-08-15 06:33:50');
INSERT INTO `audittrail` VALUES (746, 'admin', '41.77.75.37', 'http://guardsecure.newwavetech.co.ug/inventory/itemissues.php', '2012-08-15 06:34:28');
INSERT INTO `audittrail` VALUES (747, 'admin', '41.77.75.37', 'http://guardsecure.newwavetech.co.ug/inventory/index.php?a=issue', '2012-08-15 06:34:31');
INSERT INTO `audittrail` VALUES (748, 'admin', '41.77.75.37', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-08-15 06:34:42');
INSERT INTO `audittrail` VALUES (749, 'admin', '41.77.75.37', 'http://guardsecure.newwavetech.co.ug/hr/manageguards.php', '2012-08-15 06:35:48');
INSERT INTO `audittrail` VALUES (750, 'admin', '41.77.75.37', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-08-15 06:36:05');
INSERT INTO `audittrail` VALUES (751, 'admin', '41.77.75.37', 'http://guardsecure.newwavetech.co.ug/inventory/itemissues.php', '2012-08-15 06:36:13');
INSERT INTO `audittrail` VALUES (752, 'admin', '41.77.75.37', 'http://guardsecure.newwavetech.co.ug/inventory/index.php?a=issue', '2012-08-15 06:36:15');
INSERT INTO `audittrail` VALUES (753, 'admin', '41.77.75.37', 'http://guardsecure.newwavetech.co.ug/inventory/index.php', '2012-08-15 06:36:21');
INSERT INTO `audittrail` VALUES (754, 'admin', '41.77.75.37', 'http://guardsecure.newwavetech.co.ug/inventory/index.php?a=issue&type=Radio', '2012-08-15 06:36:22');
INSERT INTO `audittrail` VALUES (755, 'admin', '41.77.75.37', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-08-15 06:37:24');
INSERT INTO `audittrail` VALUES (756, 'admin', '41.77.75.37', 'http://guardsecure.newwavetech.co.ug/core/manageclients.php', '2012-08-15 06:37:29');
INSERT INTO `audittrail` VALUES (757, 'admin', '41.77.75.37', 'http://guardsecure.newwavetech.co.ug/core/client.php', '2012-08-15 06:37:34');
INSERT INTO `audittrail` VALUES (758, 'admin', '41.77.75.37', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-08-15 06:38:02');
INSERT INTO `audittrail` VALUES (759, 'admin', '41.77.75.37', 'http://guardsecure.newwavetech.co.ug/hr/managepromotions.php', '2012-08-15 06:40:17');
INSERT INTO `audittrail` VALUES (760, 'admin', '41.77.75.37', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-08-15 06:40:33');
INSERT INTO `audittrail` VALUES (761, 'admin', '41.77.75.37', 'http://guardsecure.newwavetech.co.ug/core/manageassignments.php', '2012-08-15 06:40:57');
INSERT INTO `audittrail` VALUES (762, 'admin', '41.77.75.37', 'http://guardsecure.newwavetech.co.ug/core/assignment.php', '2012-08-15 06:41:04');
INSERT INTO `audittrail` VALUES (763, 'admin', '41.77.75.37', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-08-15 06:52:33');
INSERT INTO `audittrail` VALUES (764, 'admin', '41.77.75.37', 'http://guardsecure.newwavetech.co.ug/finance/manageguardfinance.php', '2012-08-15 06:56:48');
INSERT INTO `audittrail` VALUES (765, 'admin', '41.77.75.37', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-08-15 06:57:15');
INSERT INTO `audittrail` VALUES (766, 'admin', '41.77.75.37', 'http://guardsecure.newwavetech.co.ug/finance/report.php?f=Guard%20Payroll', '2012-08-15 06:57:20');
INSERT INTO `audittrail` VALUES (767, 'admin', '41.77.75.37', 'http://guardsecure.newwavetech.co.ug/finance/report.php', '2012-08-15 06:57:44');
INSERT INTO `audittrail` VALUES (768, 'admin', '41.77.75.37', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-08-15 06:58:14');
INSERT INTO `audittrail` VALUES (769, 'admin', '41.77.75.37', 'http://guardsecure.newwavetech.co.ug/finance/report.php?f=Guard%20Payroll', '2012-08-15 06:58:26');
INSERT INTO `audittrail` VALUES (770, 'admin', '41.77.75.37', 'http://guardsecure.newwavetech.co.ug/finance/report.php', '2012-08-15 06:58:35');
INSERT INTO `audittrail` VALUES (771, 'admin', '41.77.75.37', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-08-15 06:59:25');
INSERT INTO `audittrail` VALUES (772, 'admin', '41.77.75.37', 'http://guardsecure.newwavetech.co.ug/finance/managetransactions.php?t=d29sZnR1bw==', '2012-08-15 07:01:42');
INSERT INTO `audittrail` VALUES (773, 'admin', '41.77.75.37', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-08-15 07:01:54');
INSERT INTO `audittrail` VALUES (774, 'admin', '41.77.75.37', 'http://guardsecure.newwavetech.co.ug/finance/managetransactions.php?t=d29sZm5p', '2012-08-15 07:01:59');
INSERT INTO `audittrail` VALUES (775, 'admin', '41.77.75.37', 'http://guardsecure.newwavetech.co.ug/finance/transaction.php?t=d29sZm5p', '2012-08-15 07:02:01');
INSERT INTO `audittrail` VALUES (776, 'admin', '41.77.75.37', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-08-15 07:02:14');
INSERT INTO `audittrail` VALUES (777, 'admin', '41.77.75.37', 'http://guardsecure.newwavetech.co.ug/finance/managetransactions.php?t=d29sZnR1bw==', '2012-08-15 07:02:47');
INSERT INTO `audittrail` VALUES (778, 'admin', '41.77.75.37', 'http://guardsecure.newwavetech.co.ug/finance/transaction.php?t=d29sZnR1bw==', '2012-08-15 07:02:50');
INSERT INTO `audittrail` VALUES (779, 'admin', '41.77.75.37', 'http://guardsecure.newwavetech.co.ug/settings/settings.php', '2012-08-15 07:03:20');
INSERT INTO `audittrail` VALUES (780, 'admin', '41.77.75.37', 'http://guardsecure.newwavetech.co.ug/core/manageaccounts.php', '2012-08-15 07:03:35');
INSERT INTO `audittrail` VALUES (781, 'admin', '41.77.75.37', 'http://guardsecure.newwavetech.co.ug/core/addaccount.php', '2012-08-15 07:03:42');
INSERT INTO `audittrail` VALUES (782, 'admin', '41.77.75.37', 'http://guardsecure.newwavetech.co.ug/core/addaccount.php', '2012-08-15 07:03:58');
INSERT INTO `audittrail` VALUES (783, 'admin', '41.77.75.37', 'http://guardsecure.newwavetech.co.ug/core/manageaccounts.php', '2012-08-15 07:03:59');
INSERT INTO `audittrail` VALUES (784, 'admin', '41.77.75.37', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-08-15 07:04:14');
INSERT INTO `audittrail` VALUES (785, 'admin', '41.77.75.37', 'http://guardsecure.newwavetech.co.ug/finance/managetransactions.php?t=d29sZnR1bw==', '2012-08-15 07:05:54');
INSERT INTO `audittrail` VALUES (786, 'admin', '41.77.75.37', 'http://guardsecure.newwavetech.co.ug/finance/managetransactions.php?t=d29sZnR1bw==&ia=Tg==', '2012-08-15 07:05:57');
INSERT INTO `audittrail` VALUES (787, 'admin', '41.77.75.37', 'http://guardsecure.newwavetech.co.ug/finance/managetransactions.php?t=d29sZnR1bw==', '2012-08-15 07:06:08');
INSERT INTO `audittrail` VALUES (788, 'admin', '41.77.75.37', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-08-15 07:06:11');
INSERT INTO `audittrail` VALUES (789, 'admin', '41.77.75.37', 'http://guardsecure.newwavetech.co.ug/finance/managetransactions.php?t=d29sZm5p', '2012-08-15 07:06:15');
INSERT INTO `audittrail` VALUES (790, 'admin', '41.77.75.37', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-08-15 07:10:38');
INSERT INTO `audittrail` VALUES (791, 'admin', '41.77.75.37', 'http://guardsecure.newwavetech.co.ug/finance/report.php?f=Client%20Invoice', '2012-08-15 07:29:15');
INSERT INTO `audittrail` VALUES (792, 'admin', '41.77.75.37', 'http://guardsecure.newwavetech.co.ug/finance/report.php', '2012-08-15 07:36:00');
INSERT INTO `audittrail` VALUES (793, 'admin', '41.77.75.37', 'http://guardsecure.newwavetech.co.ug/finance/report.php?f=Client%20Invoice', '2012-08-15 07:36:14');
INSERT INTO `audittrail` VALUES (794, 'admin', '41.77.75.37', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-08-15 07:36:21');
INSERT INTO `audittrail` VALUES (795, '', '83.233.186.82', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-08-15 07:46:51');
INSERT INTO `audittrail` VALUES (796, 'admin', '41.77.75.37', 'http://guardsecure.newwavetech.co.ug/hr/manageguards.php', '2012-08-15 07:48:03');
INSERT INTO `audittrail` VALUES (797, 'admin', '41.77.75.37', 'http://guardsecure.newwavetech.co.ug/hr/index.php?id=NzI=&a=edit', '2012-08-15 07:48:11');
INSERT INTO `audittrail` VALUES (798, 'admin', '41.77.75.37', 'http://guardsecure.newwavetech.co.ug/hr/managepersonnel.php?id=NDU1Rg==', '2012-08-15 07:48:48');
INSERT INTO `audittrail` VALUES (799, 'admin', '41.77.75.37', 'http://guardsecure.newwavetech.co.ug/hr/viewpersonnelfile.php?id=Ng==', '2012-08-15 07:48:52');
INSERT INTO `audittrail` VALUES (800, 'admin', '41.77.75.37', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-08-15 07:49:04');
INSERT INTO `audittrail` VALUES (801, '', '83.233.186.82', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-08-15 07:59:09');
INSERT INTO `audittrail` VALUES (802, '', '69.58.178.58', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-08-15 11:20:38');
INSERT INTO `audittrail` VALUES (803, '', '218.85.143.218', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-08-16 04:11:46');
INSERT INTO `audittrail` VALUES (804, '', '218.85.143.218', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-08-16 05:05:40');
INSERT INTO `audittrail` VALUES (805, '', '218.85.143.218', 'http://guardsecure.newwavetech.co.ug/settings/index.php', '2012-08-16 05:06:17');
INSERT INTO `audittrail` VALUES (806, '', '218.85.143.218', 'http://guardsecure.newwavetech.co.ug/core/viewuser.php?id=', '2012-08-16 05:06:17');
INSERT INTO `audittrail` VALUES (807, '', '218.85.143.218', 'http://guardsecure.newwavetech.co.ug/settings/settings.php', '2012-08-16 05:06:18');
INSERT INTO `audittrail` VALUES (808, '', '218.85.143.218', 'http://guardsecure.newwavetech.co.ug/core/favorites.php', '2012-08-16 05:06:18');
INSERT INTO `audittrail` VALUES (809, '', '218.85.143.218', 'http://guardsecure.newwavetech.co.ug/core/reminders.php', '2012-08-16 05:06:19');
INSERT INTO `audittrail` VALUES (810, '', '83.233.186.82', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-08-16 08:33:47');
INSERT INTO `audittrail` VALUES (811, '', '66.249.71.198', 'http://guardsecure.newwavetech.co.ug/core/reminders.php', '2012-08-16 09:31:51');
INSERT INTO `audittrail` VALUES (812, '', '66.249.71.198', 'http://guardsecure.newwavetech.co.ug/core/favorites.php', '2012-08-16 09:55:48');
INSERT INTO `audittrail` VALUES (813, '', '66.249.71.198', 'http://guardsecure.newwavetech.co.ug/settings/index.php', '2012-08-16 12:41:42');
INSERT INTO `audittrail` VALUES (814, '', '66.249.71.198', 'http://guardsecure.newwavetech.co.ug/settings/settings.php', '2012-08-16 23:41:22');
INSERT INTO `audittrail` VALUES (815, '', '208.115.111.71', 'http://guardsecure.newwavetech.co.ug/core/favorites.php', '2012-08-17 02:35:31');
INSERT INTO `audittrail` VALUES (816, '', '66.249.71.198', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-08-17 06:15:39');
INSERT INTO `audittrail` VALUES (817, '', '83.233.186.82', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-08-17 08:00:30');
INSERT INTO `audittrail` VALUES (818, '', '83.233.186.82', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-08-17 08:26:35');
INSERT INTO `audittrail` VALUES (819, '', '208.115.111.71', 'http://guardsecure.newwavetech.co.ug/core/favorites.php', '2012-08-17 10:34:31');
INSERT INTO `audittrail` VALUES (820, '', '69.84.207.246', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-08-17 18:18:52');
INSERT INTO `audittrail` VALUES (821, '', '69.84.207.246', 'http://guardsecure.newwavetech.co.ug/core/reminders.php', '2012-08-17 18:18:53');
INSERT INTO `audittrail` VALUES (822, '', '69.84.207.246', 'http://guardsecure.newwavetech.co.ug/core/favorites.php', '2012-08-17 18:18:53');
INSERT INTO `audittrail` VALUES (823, '', '69.84.207.246', 'http://guardsecure.newwavetech.co.ug/settings/index.php', '2012-08-17 18:18:53');
INSERT INTO `audittrail` VALUES (824, '', '69.84.207.246', 'http://guardsecure.newwavetech.co.ug/core/viewuser.php?id=', '2012-08-17 18:18:58');
INSERT INTO `audittrail` VALUES (825, '', '69.84.207.246', 'http://guardsecure.newwavetech.co.ug/settings/settings.php', '2012-08-17 18:18:58');
INSERT INTO `audittrail` VALUES (826, '', '69.84.207.246', 'http://guardsecure.newwavetech.co.ug/core/user.php?id=&action=edit', '2012-08-17 18:19:07');
INSERT INTO `audittrail` VALUES (827, '', '212.113.35.162', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-08-18 06:02:45');
INSERT INTO `audittrail` VALUES (828, '', '83.233.186.82', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-08-18 07:46:39');
INSERT INTO `audittrail` VALUES (829, '', '83.233.186.82', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-08-18 08:05:32');
INSERT INTO `audittrail` VALUES (830, '', '193.105.210.30', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-08-18 23:04:33');
INSERT INTO `audittrail` VALUES (831, '', '93.182.149.167', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-08-19 03:54:12');
INSERT INTO `audittrail` VALUES (832, '', '93.182.149.167', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-08-19 03:54:14');
INSERT INTO `audittrail` VALUES (833, '', '83.233.186.82', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-08-19 07:32:19');
INSERT INTO `audittrail` VALUES (834, '', '193.105.210.30', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-08-19 14:39:54');
INSERT INTO `audittrail` VALUES (835, '', '31.184.238.13', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-08-19 17:52:10');
INSERT INTO `audittrail` VALUES (836, '', '31.184.238.13', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-08-19 17:52:12');
INSERT INTO `audittrail` VALUES (837, '', '157.55.16.219', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-08-19 18:01:29');
INSERT INTO `audittrail` VALUES (838, '', '180.76.5.189', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-08-20 00:18:45');
INSERT INTO `audittrail` VALUES (839, '', '37.113.8.183', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-08-20 04:28:24');
INSERT INTO `audittrail` VALUES (840, '', '93.182.149.167', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-08-20 05:32:25');
INSERT INTO `audittrail` VALUES (841, '', '93.182.149.167', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-08-20 05:32:25');
INSERT INTO `audittrail` VALUES (842, '', '193.105.210.30', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-08-20 06:25:32');
INSERT INTO `audittrail` VALUES (843, '', '83.233.186.82', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-08-20 07:15:20');
INSERT INTO `audittrail` VALUES (844, '', '83.233.186.82', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-08-20 07:29:37');
INSERT INTO `audittrail` VALUES (845, '', '41.190.129.38', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-08-20 07:35:53');
INSERT INTO `audittrail` VALUES (846, '', '91.201.64.26', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-08-20 07:54:23');
INSERT INTO `audittrail` VALUES (847, '', '173.242.122.80', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-08-20 12:02:08');
INSERT INTO `audittrail` VALUES (848, '', '173.242.122.80', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-08-20 12:02:09');
INSERT INTO `audittrail` VALUES (849, '', '173.242.122.80', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-08-20 13:28:39');
INSERT INTO `audittrail` VALUES (850, '', '173.242.122.80', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-08-20 13:28:39');
INSERT INTO `audittrail` VALUES (851, '', '173.242.122.80', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-08-20 17:57:07');
INSERT INTO `audittrail` VALUES (852, '', '173.242.122.80', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-08-20 17:57:07');
INSERT INTO `audittrail` VALUES (853, '', '173.242.122.80', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-08-20 19:36:15');
INSERT INTO `audittrail` VALUES (854, '', '83.233.186.82', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-08-21 08:02:35');
INSERT INTO `audittrail` VALUES (855, '', '83.233.186.82', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-08-21 08:10:03');
INSERT INTO `audittrail` VALUES (856, '', '31.184.238.13', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-08-21 12:31:02');
INSERT INTO `audittrail` VALUES (857, '', '193.105.210.30', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-08-21 23:27:16');
INSERT INTO `audittrail` VALUES (858, '', '31.184.238.13', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-08-22 00:01:21');
INSERT INTO `audittrail` VALUES (859, '', '94.181.166.31', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-08-22 03:58:54');
INSERT INTO `audittrail` VALUES (860, '', '193.105.210.30', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-08-22 05:55:23');
INSERT INTO `audittrail` VALUES (861, '', '83.233.186.82', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-08-22 07:29:06');
INSERT INTO `audittrail` VALUES (862, '', '83.233.186.82', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-08-22 07:33:42');
INSERT INTO `audittrail` VALUES (863, '', '193.105.210.30', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-08-22 12:27:32');
INSERT INTO `audittrail` VALUES (864, '', '193.105.210.30', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-08-22 18:52:32');
INSERT INTO `audittrail` VALUES (865, '', '65.52.110.192', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-08-22 20:59:50');
INSERT INTO `audittrail` VALUES (866, '', '65.52.110.192', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-08-22 21:29:48');
INSERT INTO `audittrail` VALUES (867, '', '193.105.210.30', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-08-23 01:50:10');
INSERT INTO `audittrail` VALUES (868, '', '41.138.3.61', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-08-23 06:37:22');
INSERT INTO `audittrail` VALUES (869, '', '83.233.186.82', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-08-23 07:44:32');
INSERT INTO `audittrail` VALUES (870, '', '83.233.186.82', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-08-23 07:48:24');
INSERT INTO `audittrail` VALUES (871, '', '193.105.210.30', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-08-23 08:28:06');
INSERT INTO `audittrail` VALUES (872, '', '188.143.232.213', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-08-23 17:12:56');
INSERT INTO `audittrail` VALUES (873, '', '193.105.210.30', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-08-23 21:33:37');
INSERT INTO `audittrail` VALUES (874, '', '91.201.64.223', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-08-23 23:17:24');
INSERT INTO `audittrail` VALUES (875, '', '66.249.73.202', 'http://guardsecure.newwavetech.co.ug/core/viewuser.php?id=', '2012-08-24 00:11:32');
INSERT INTO `audittrail` VALUES (876, '', '119.139.24.164', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-08-24 02:48:16');
INSERT INTO `audittrail` VALUES (877, '', '193.105.210.30', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-08-24 04:09:10');
INSERT INTO `audittrail` VALUES (878, '', '193.105.210.117', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-08-24 04:37:29');
INSERT INTO `audittrail` VALUES (879, '', '83.233.186.82', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-08-24 07:50:19');
INSERT INTO `audittrail` VALUES (880, '', '83.233.186.82', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-08-24 08:02:22');
INSERT INTO `audittrail` VALUES (881, '', '193.105.210.117', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-08-24 08:40:31');
INSERT INTO `audittrail` VALUES (882, '', '193.105.210.117', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-08-24 08:40:31');
INSERT INTO `audittrail` VALUES (883, '', '193.105.210.30', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-08-24 13:19:27');
INSERT INTO `audittrail` VALUES (884, '', '193.105.210.30', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-08-24 20:53:59');
INSERT INTO `audittrail` VALUES (885, '', '193.105.210.117', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-08-25 03:54:44');
INSERT INTO `audittrail` VALUES (886, '', '193.105.210.117', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-08-25 11:03:58');
INSERT INTO `audittrail` VALUES (887, '', '180.76.5.66', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-08-25 14:51:39');
INSERT INTO `audittrail` VALUES (888, '', '188.143.232.12', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-08-26 16:05:46');
INSERT INTO `audittrail` VALUES (889, '', '66.249.72.123', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-08-26 21:59:15');
INSERT INTO `audittrail` VALUES (890, '', '91.201.64.223', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-08-27 08:43:22');
INSERT INTO `audittrail` VALUES (891, '', '65.52.110.192', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-08-27 19:34:35');
INSERT INTO `audittrail` VALUES (892, '', '65.52.110.192', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-08-27 20:29:31');
INSERT INTO `audittrail` VALUES (893, '', '178.255.215.79', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-08-28 16:34:19');
INSERT INTO `audittrail` VALUES (894, '', '208.115.113.87', 'http://guardsecure.newwavetech.co.ug/core/reminders.php', '2012-08-28 16:44:29');
INSERT INTO `audittrail` VALUES (895, '', '178.255.215.79', 'http://guardsecure.newwavetech.co.ug/settings/index.php', '2012-08-28 19:04:06');
INSERT INTO `audittrail` VALUES (896, '', '75.72.211.41', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-08-29 02:10:50');
INSERT INTO `audittrail` VALUES (897, '', '83.233.186.82', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-08-29 07:52:37');
INSERT INTO `audittrail` VALUES (898, '', '83.233.186.82', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-08-29 08:16:50');
INSERT INTO `audittrail` VALUES (899, '', '180.76.5.186', 'http://guardsecure.newwavetech.co.ug/settings/index.php', '2012-08-30 03:42:56');
INSERT INTO `audittrail` VALUES (900, '', '180.76.6.225', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-08-30 03:42:59');
INSERT INTO `audittrail` VALUES (901, '', '196.0.21.52', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-08-30 06:06:22');
INSERT INTO `audittrail` VALUES (902, 'admin', '196.0.21.52', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-08-30 07:04:26');
INSERT INTO `audittrail` VALUES (903, '', '83.233.186.82', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-08-30 07:18:38');
INSERT INTO `audittrail` VALUES (904, '', '83.233.186.82', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-08-30 07:30:55');
INSERT INTO `audittrail` VALUES (905, '', '157.55.34.32', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-08-30 18:56:13');
INSERT INTO `audittrail` VALUES (906, '', '180.76.5.146', 'http://guardsecure.newwavetech.co.ug/settings/index.php', '2012-08-30 19:19:19');
INSERT INTO `audittrail` VALUES (907, '', '180.76.5.107', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-08-30 19:19:22');
INSERT INTO `audittrail` VALUES (908, '', '208.115.111.71', 'http://guardsecure.newwavetech.co.ug/core/viewuser.php?id=', '2012-08-30 22:40:00');
INSERT INTO `audittrail` VALUES (909, '', '208.115.111.71', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-08-31 02:35:02');
INSERT INTO `audittrail` VALUES (910, '', '94.181.166.31', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-08-31 05:41:52');
INSERT INTO `audittrail` VALUES (911, '', '83.233.186.82', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-08-31 07:40:13');
INSERT INTO `audittrail` VALUES (912, '', '173.242.122.80', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-08-31 09:50:42');
INSERT INTO `audittrail` VALUES (913, '', '173.242.122.80', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-08-31 09:50:44');
INSERT INTO `audittrail` VALUES (914, '', '208.115.111.71', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-08-31 10:37:21');
INSERT INTO `audittrail` VALUES (915, '', '188.143.232.211', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-08-31 16:17:07');
INSERT INTO `audittrail` VALUES (916, '', '208.115.111.71', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-08-31 18:42:50');
INSERT INTO `audittrail` VALUES (917, '', '173.242.122.80', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-08-31 20:19:38');
INSERT INTO `audittrail` VALUES (918, '', '173.242.122.80', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-08-31 20:19:38');
INSERT INTO `audittrail` VALUES (919, '', '83.233.186.82', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-09-01 08:01:13');
INSERT INTO `audittrail` VALUES (920, '', '176.74.192.72', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-09-01 19:28:09');
INSERT INTO `audittrail` VALUES (921, '', '176.74.192.72', 'http://guardsecure.newwavetech.co.ug/core/viewuser.php?id=', '2012-09-01 19:29:23');
INSERT INTO `audittrail` VALUES (922, '', '176.74.192.72', 'http://guardsecure.newwavetech.co.ug/settings/settings.php', '2012-09-01 19:29:24');
INSERT INTO `audittrail` VALUES (923, '', '176.74.192.72', 'http://guardsecure.newwavetech.co.ug/core/favorites.php', '2012-09-01 19:29:25');
INSERT INTO `audittrail` VALUES (924, '', '176.74.192.72', 'http://guardsecure.newwavetech.co.ug/core/reminders.php', '2012-09-01 19:29:25');
INSERT INTO `audittrail` VALUES (925, '', '176.74.192.72', 'http://guardsecure.newwavetech.co.ug/settings/index.php', '2012-09-01 19:29:26');
INSERT INTO `audittrail` VALUES (926, '', '176.74.192.72', 'http://guardsecure.newwavetech.co.ug/settings/settings.php', '2012-09-01 19:30:54');
INSERT INTO `audittrail` VALUES (927, '', '176.74.192.72', 'http://guardsecure.newwavetech.co.ug/core/favorites.php', '2012-09-01 19:30:55');
INSERT INTO `audittrail` VALUES (928, '', '176.74.192.72', 'http://guardsecure.newwavetech.co.ug/settings/index.php', '2012-09-01 19:30:56');
INSERT INTO `audittrail` VALUES (929, '', '188.190.124.70', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-09-02 08:16:42');
INSERT INTO `audittrail` VALUES (930, '', '83.233.186.82', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-09-03 07:36:30');
INSERT INTO `audittrail` VALUES (931, '', '196.0.21.52', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-09-03 08:27:14');
INSERT INTO `audittrail` VALUES (932, '', '196.0.21.52', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-09-03 08:33:53');
INSERT INTO `audittrail` VALUES (933, 'admin', '196.0.21.52', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-09-03 08:34:05');
INSERT INTO `audittrail` VALUES (934, 'admin', '196.0.21.52', 'http://guardsecure.newwavetech.co.ug/core/manageassignments.php', '2012-09-03 08:39:17');
INSERT INTO `audittrail` VALUES (935, 'admin', '196.0.21.52', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-09-03 08:39:51');
INSERT INTO `audittrail` VALUES (936, 'admin', '196.0.21.52', 'http://guardsecure.newwavetech.co.ug/finance/report.php?f=Guard%20Payroll', '2012-09-03 08:40:02');
INSERT INTO `audittrail` VALUES (937, 'admin', '196.0.21.52', 'http://guardsecure.newwavetech.co.ug/finance/report.php', '2012-09-03 08:40:12');
INSERT INTO `audittrail` VALUES (938, '', '213.186.127.11', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-09-03 18:57:46');
INSERT INTO `audittrail` VALUES (939, '', '213.186.127.28', 'http://guardsecure.newwavetech.co.ug/core/favorites.php', '2012-09-04 03:58:38');
INSERT INTO `audittrail` VALUES (940, '', '196.0.4.84', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-09-04 06:16:09');
INSERT INTO `audittrail` VALUES (941, '', '196.0.4.84', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-09-04 06:16:21');
INSERT INTO `audittrail` VALUES (942, '', '83.233.186.82', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-09-04 07:59:45');
INSERT INTO `audittrail` VALUES (943, '', '87.236.194.158', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-09-04 10:49:10');
INSERT INTO `audittrail` VALUES (944, '', '87.236.194.158', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-09-04 10:49:13');
INSERT INTO `audittrail` VALUES (945, '', '208.115.111.71', 'http://guardsecure.newwavetech.co.ug/settings/settings.php', '2012-09-04 10:52:22');
INSERT INTO `audittrail` VALUES (946, '', '208.115.111.71', 'http://guardsecure.newwavetech.co.ug/settings/index.php', '2012-09-04 14:37:52');
INSERT INTO `audittrail` VALUES (947, '', '213.186.127.3', 'http://guardsecure.newwavetech.co.ug/core/reminders.php', '2012-09-04 19:41:52');
INSERT INTO `audittrail` VALUES (948, '', '213.186.119.135', 'http://guardsecure.newwavetech.co.ug/core/viewuser.php?id=', '2012-09-05 00:11:49');
INSERT INTO `audittrail` VALUES (949, '', '91.201.64.223', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-09-05 02:07:54');
INSERT INTO `audittrail` VALUES (950, '', '93.182.163.155', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-09-05 03:37:32');
INSERT INTO `audittrail` VALUES (951, '', '93.182.163.155', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-09-05 03:37:33');
INSERT INTO `audittrail` VALUES (952, '', '83.233.186.82', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-09-05 07:24:17');
INSERT INTO `audittrail` VALUES (953, '', '213.186.127.2', 'http://guardsecure.newwavetech.co.ug/settings/index.php', '2012-09-05 09:11:52');
INSERT INTO `audittrail` VALUES (954, '', '212.113.37.105', 'http://guardsecure.newwavetech.co.ug/settings/settings.php', '2012-09-05 13:41:51');
INSERT INTO `audittrail` VALUES (955, '', '66.249.73.202', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-09-06 03:28:52');
INSERT INTO `audittrail` VALUES (956, '', '83.233.186.82', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-09-06 08:12:55');
INSERT INTO `audittrail` VALUES (957, '', '180.76.5.61', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-09-07 03:42:56');
INSERT INTO `audittrail` VALUES (958, '', '180.76.5.154', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-09-07 05:27:03');
INSERT INTO `audittrail` VALUES (959, '', '83.233.186.82', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-09-07 07:08:23');
INSERT INTO `audittrail` VALUES (960, '', '83.233.186.82', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-09-07 07:09:54');
INSERT INTO `audittrail` VALUES (961, '', '83.233.186.82', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-09-08 06:55:41');
INSERT INTO `audittrail` VALUES (962, '', '66.249.73.202', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-09-08 11:38:00');
INSERT INTO `audittrail` VALUES (963, '', '83.233.186.82', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-09-09 07:31:00');
INSERT INTO `audittrail` VALUES (964, '', '83.233.186.82', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-09-09 07:41:56');
INSERT INTO `audittrail` VALUES (965, '', '196.0.21.52', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-09-10 02:19:16');
INSERT INTO `audittrail` VALUES (966, '', '196.0.21.52', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-09-10 02:19:37');
INSERT INTO `audittrail` VALUES (967, 'admin', '196.0.21.52', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-09-10 02:19:48');
INSERT INTO `audittrail` VALUES (968, '', '94.23.12.62', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-09-10 03:48:08');
INSERT INTO `audittrail` VALUES (969, '', '94.23.12.62', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-09-10 03:48:09');
INSERT INTO `audittrail` VALUES (970, 'admin', '196.0.21.52', 'http://guardsecure.newwavetech.co.ug/hr/manageguards.php', '2012-09-10 05:03:12');
INSERT INTO `audittrail` VALUES (971, 'admin', '196.0.21.52', 'http://guardsecure.newwavetech.co.ug/hr/index.php', '2012-09-10 05:03:27');
INSERT INTO `audittrail` VALUES (972, 'admin', '196.0.21.52', 'http://guardsecure.newwavetech.co.ug/hr/manageguards.php', '2012-09-10 05:04:30');
INSERT INTO `audittrail` VALUES (973, 'admin', '196.0.21.52', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-09-10 05:04:42');
INSERT INTO `audittrail` VALUES (974, 'admin', '196.0.21.52', 'http://guardsecure.newwavetech.co.ug/finance/report.php?f=Guard%20Payroll', '2012-09-10 05:04:55');
INSERT INTO `audittrail` VALUES (975, 'admin', '196.0.21.52', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-09-10 05:05:38');
INSERT INTO `audittrail` VALUES (976, 'admin', '196.0.21.52', 'http://guardsecure.newwavetech.co.ug/core/manageassignments.php', '2012-09-10 05:05:43');
INSERT INTO `audittrail` VALUES (977, 'admin', '196.0.21.52', 'http://guardsecure.newwavetech.co.ug/core/assignment.php', '2012-09-10 05:05:51');
INSERT INTO `audittrail` VALUES (978, 'admin', '196.0.21.52', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-09-10 05:07:08');
INSERT INTO `audittrail` VALUES (979, 'admin', '196.0.21.52', 'http://guardsecure.newwavetech.co.ug/operations/index.php', '2012-09-10 05:07:40');
INSERT INTO `audittrail` VALUES (980, 'admin', '196.0.21.52', 'http://guardsecure.newwavetech.co.ug/operations/index.php', '2012-09-10 05:07:54');
INSERT INTO `audittrail` VALUES (981, 'admin', '196.0.21.52', 'http://guardsecure.newwavetech.co.ug/operations/index.php', '2012-09-10 05:08:09');
INSERT INTO `audittrail` VALUES (982, 'admin', '196.0.21.52', 'http://guardsecure.newwavetech.co.ug/operations/index.php?a=new&d=back', '2012-09-10 05:08:17');
INSERT INTO `audittrail` VALUES (983, 'admin', '196.0.21.52', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-09-10 05:08:18');
INSERT INTO `audittrail` VALUES (984, 'admin', '196.0.21.52', 'http://guardsecure.newwavetech.co.ug/core/manageassignments.php', '2012-09-10 05:08:28');
INSERT INTO `audittrail` VALUES (985, 'admin', '196.0.21.52', 'http://guardsecure.newwavetech.co.ug/core/generatetwo.php?id=106&t=bXJhbGE=', '2012-09-10 05:09:15');
INSERT INTO `audittrail` VALUES (986, 'admin', '196.0.21.52', 'http://guardsecure.newwavetech.co.ug/core/manageassignments.php', '2012-09-10 05:09:24');
INSERT INTO `audittrail` VALUES (987, 'admin', '196.0.21.52', 'http://guardsecure.newwavetech.co.ug/core/assignment.php?a=view&id=NjAx', '2012-09-10 05:09:31');
INSERT INTO `audittrail` VALUES (988, 'admin', '196.0.21.52', 'http://guardsecure.newwavetech.co.ug/core/manageassignments.php', '2012-09-10 05:09:44');
INSERT INTO `audittrail` VALUES (989, 'admin', '196.0.21.52', 'http://guardsecure.newwavetech.co.ug/core/assignment.php', '2012-09-10 05:09:48');
INSERT INTO `audittrail` VALUES (990, 'admin', '196.0.21.52', 'http://guardsecure.newwavetech.co.ug/core/manageassignments.php', '2012-09-10 05:13:05');
INSERT INTO `audittrail` VALUES (991, 'admin', '196.0.21.52', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-09-10 05:13:28');
INSERT INTO `audittrail` VALUES (992, 'admin', '196.0.21.52', 'http://guardsecure.newwavetech.co.ug/operations/index.php', '2012-09-10 05:13:33');
INSERT INTO `audittrail` VALUES (993, 'admin', '196.0.21.52', 'http://guardsecure.newwavetech.co.ug/operations/index.php', '2012-09-10 05:13:50');
INSERT INTO `audittrail` VALUES (994, 'admin', '196.0.21.52', 'http://guardsecure.newwavetech.co.ug/operations/index.php', '2012-09-10 05:14:07');
INSERT INTO `audittrail` VALUES (995, 'admin', '196.0.21.52', 'http://guardsecure.newwavetech.co.ug/core/assignment.php?action=edit&id=NTg=', '2012-09-10 05:14:22');
INSERT INTO `audittrail` VALUES (996, 'admin', '196.0.21.52', 'http://guardsecure.newwavetech.co.ug/operations/index.php', '2012-09-10 05:14:31');
INSERT INTO `audittrail` VALUES (997, 'admin', '196.0.21.52', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-09-10 05:17:14');
INSERT INTO `audittrail` VALUES (998, 'admin', '196.0.21.52', 'http://guardsecure.newwavetech.co.ug/hr/manageguards.php', '2012-09-10 05:18:44');
INSERT INTO `audittrail` VALUES (999, 'admin', '196.0.21.52', 'http://guardsecure.newwavetech.co.ug/hr/managepersonnel.php?id=NDU1Rg==', '2012-09-10 05:18:57');
INSERT INTO `audittrail` VALUES (1000, 'admin', '196.0.21.52', 'http://guardsecure.newwavetech.co.ug/hr/viewpersonnelfile.php?id=Ng==', '2012-09-10 05:19:08');
INSERT INTO `audittrail` VALUES (1001, 'admin', '196.0.21.52', 'http://guardsecure.newwavetech.co.ug/hr/managepersonnel.php?id=NDU1Rg==', '2012-09-10 05:19:16');
INSERT INTO `audittrail` VALUES (1002, 'admin', '196.0.21.52', 'http://guardsecure.newwavetech.co.ug/hr/personnel.php', '2012-09-10 05:19:20');
INSERT INTO `audittrail` VALUES (1003, 'admin', '196.0.21.52', 'http://guardsecure.newwavetech.co.ug/hr/managepersonnel.php', '2012-09-10 05:21:31');
INSERT INTO `audittrail` VALUES (1004, 'admin', '196.0.21.52', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-09-10 05:25:15');
INSERT INTO `audittrail` VALUES (1005, 'admin', '196.0.21.52', 'http://guardsecure.newwavetech.co.ug/operations/report.php?f=Control%20Shift', '2012-09-10 05:25:26');
INSERT INTO `audittrail` VALUES (1006, 'admin', '196.0.21.52', 'http://guardsecure.newwavetech.co.ug/operations/report.php', '2012-09-10 05:25:56');
INSERT INTO `audittrail` VALUES (1007, 'admin', '196.0.21.52', 'http://guardsecure.newwavetech.co.ug/operations/report.php', '2012-09-10 05:26:17');
INSERT INTO `audittrail` VALUES (1008, 'admin', '196.0.21.52', 'http://guardsecure.newwavetech.co.ug/operations/report.php?f=Control%20Shift', '2012-09-10 05:26:29');
INSERT INTO `audittrail` VALUES (1009, 'admin', '196.0.21.52', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-09-10 05:27:07');
INSERT INTO `audittrail` VALUES (1010, 'admin', '196.0.21.52', 'http://guardsecure.newwavetech.co.ug/operations/appraisals.php', '2012-09-10 05:27:56');
INSERT INTO `audittrail` VALUES (1011, 'admin', '196.0.21.52', 'http://guardsecure.newwavetech.co.ug/operations/addappraisal.php', '2012-09-10 05:28:11');
INSERT INTO `audittrail` VALUES (1012, 'admin', '196.0.21.52', 'http://guardsecure.newwavetech.co.ug/operations/appraisals.php', '2012-09-10 05:28:18');
INSERT INTO `audittrail` VALUES (1013, 'admin', '196.0.21.52', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-09-10 05:28:21');
INSERT INTO `audittrail` VALUES (1014, 'admin', '196.0.21.52', 'http://guardsecure.newwavetech.co.ug/operations/inspections.php', '2012-09-10 05:28:44');
INSERT INTO `audittrail` VALUES (1015, 'admin', '196.0.21.52', 'http://guardsecure.newwavetech.co.ug/operations/addinspection.php', '2012-09-10 05:28:48');
INSERT INTO `audittrail` VALUES (1016, 'admin', '196.0.21.52', 'http://guardsecure.newwavetech.co.ug/operations/inspections.php', '2012-09-10 05:29:31');
INSERT INTO `audittrail` VALUES (1017, 'admin', '196.0.21.52', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-09-10 05:29:37');
INSERT INTO `audittrail` VALUES (1018, 'admin', '196.0.21.52', 'http://guardsecure.newwavetech.co.ug/operations/inspections.php', '2012-09-10 05:30:53');
INSERT INTO `audittrail` VALUES (1019, 'admin', '196.0.21.52', 'http://guardsecure.newwavetech.co.ug/operations/addinspection.php', '2012-09-10 05:31:00');
INSERT INTO `audittrail` VALUES (1020, 'admin', '196.0.21.52', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-09-10 05:37:55');
INSERT INTO `audittrail` VALUES (1021, 'admin', '196.0.21.52', 'http://guardsecure.newwavetech.co.ug/finance/managetransactions.php?t=d29sZnR1bw==', '2012-09-10 05:39:26');
INSERT INTO `audittrail` VALUES (1022, 'admin', '196.0.21.52', 'http://guardsecure.newwavetech.co.ug/finance/transaction.php?t=d29sZnR1bw==', '2012-09-10 05:39:30');
INSERT INTO `audittrail` VALUES (1023, 'admin', '196.0.21.52', 'http://guardsecure.newwavetech.co.ug/finance/managetransactions.php?t=d29sZnR1bw==', '2012-09-10 05:40:46');
INSERT INTO `audittrail` VALUES (1024, 'admin', '196.0.21.52', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-09-10 05:40:49');
INSERT INTO `audittrail` VALUES (1025, 'admin', '196.0.21.52', 'http://guardsecure.newwavetech.co.ug/finance/managetransactions.php?t=d29sZm5p', '2012-09-10 05:41:02');
INSERT INTO `audittrail` VALUES (1026, 'admin', '196.0.21.52', 'http://guardsecure.newwavetech.co.ug/finance/managetransactions.php?t=d29sZm5p', '2012-09-10 05:41:04');
INSERT INTO `audittrail` VALUES (1027, 'admin', '196.0.21.52', 'http://guardsecure.newwavetech.co.ug/finance/transaction.php?t=d29sZm5p', '2012-09-10 05:41:07');
INSERT INTO `audittrail` VALUES (1028, 'admin', '196.0.21.52', 'http://guardsecure.newwavetech.co.ug/finance/managetransactions.php?t=d29sZm5p', '2012-09-10 05:41:26');
INSERT INTO `audittrail` VALUES (1029, 'admin', '196.0.21.52', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-09-10 05:41:29');
INSERT INTO `audittrail` VALUES (1030, 'admin', '196.0.21.52', 'http://guardsecure.newwavetech.co.ug/finance/paymentstatus.php', '2012-09-10 05:41:45');
INSERT INTO `audittrail` VALUES (1031, 'admin', '196.0.21.52', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-09-10 05:41:53');
INSERT INTO `audittrail` VALUES (1032, 'admin', '196.0.21.52', 'http://guardsecure.newwavetech.co.ug/finance/manageguardloans.php', '2012-09-10 05:42:00');
INSERT INTO `audittrail` VALUES (1033, 'admin', '196.0.21.52', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-09-10 05:42:16');
INSERT INTO `audittrail` VALUES (1034, 'admin', '196.0.21.52', 'http://guardsecure.newwavetech.co.ug/finance/manageguardclaims.php', '2012-09-10 05:42:24');
INSERT INTO `audittrail` VALUES (1035, 'admin', '196.0.21.52', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-09-10 05:42:36');
INSERT INTO `audittrail` VALUES (1036, 'admin', '196.0.21.52', 'http://guardsecure.newwavetech.co.ug/finance/report.php?f=Guard%20Payroll', '2012-09-10 05:42:43');
INSERT INTO `audittrail` VALUES (1037, 'admin', '196.0.21.52', 'http://guardsecure.newwavetech.co.ug/finance/report.php', '2012-09-10 05:42:55');
INSERT INTO `audittrail` VALUES (1038, '', '83.233.186.82', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-09-10 07:05:01');
INSERT INTO `audittrail` VALUES (1039, '', '93.182.146.54', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-09-10 11:46:53');
INSERT INTO `audittrail` VALUES (1040, '', '93.182.146.54', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-09-10 11:46:55');
INSERT INTO `audittrail` VALUES (1041, '', '222.187.222.104', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-09-11 03:20:38');
INSERT INTO `audittrail` VALUES (1042, '', '222.187.222.104', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-09-11 03:20:39');
INSERT INTO `audittrail` VALUES (1043, '', '208.115.111.71', 'http://guardsecure.newwavetech.co.ug/core/favorites.php', '2012-09-11 06:28:54');
INSERT INTO `audittrail` VALUES (1044, '', '83.233.186.82', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-09-11 06:53:48');
INSERT INTO `audittrail` VALUES (1045, '', '83.233.186.82', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-09-11 07:08:08');
INSERT INTO `audittrail` VALUES (1046, '', '31.184.238.13', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-09-11 07:14:48');
INSERT INTO `audittrail` VALUES (1047, '', '37.130.227.134', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-09-11 16:23:55');
INSERT INTO `audittrail` VALUES (1048, '', '37.130.227.134', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-09-11 16:23:56');
INSERT INTO `audittrail` VALUES (1049, '', '91.201.64.223', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-09-11 22:45:45');
INSERT INTO `audittrail` VALUES (1050, '', '14.140.212.234', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-09-12 01:25:37');
INSERT INTO `audittrail` VALUES (1051, '', '14.140.212.234', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-09-12 01:30:07');
INSERT INTO `audittrail` VALUES (1052, '', '83.233.186.82', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-09-12 06:19:15');
INSERT INTO `audittrail` VALUES (1053, '', '83.233.186.82', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-09-12 21:17:23');
INSERT INTO `audittrail` VALUES (1054, '', '83.233.186.82', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-09-13 00:02:21');
INSERT INTO `audittrail` VALUES (1055, '', '83.233.186.82', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-09-13 03:38:00');
INSERT INTO `audittrail` VALUES (1056, '', '83.233.186.82', 'http://guardsecure.newwavetech.co.ug/settings/settings.php', '2012-09-13 03:38:12');
INSERT INTO `audittrail` VALUES (1057, '', '83.233.186.82', 'http://guardsecure.newwavetech.co.ug/core/favorites.php', '2012-09-13 03:38:13');
INSERT INTO `audittrail` VALUES (1058, '', '83.233.186.82', 'http://guardsecure.newwavetech.co.ug/core/reminders.php', '2012-09-13 03:38:13');
INSERT INTO `audittrail` VALUES (1059, '', '83.233.186.82', 'http://guardsecure.newwavetech.co.ug/settings/index.php', '2012-09-13 03:38:14');
INSERT INTO `audittrail` VALUES (1060, '', '222.187.222.104', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-09-13 23:05:51');
INSERT INTO `audittrail` VALUES (1061, '', '222.187.222.104', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-09-13 23:05:52');
INSERT INTO `audittrail` VALUES (1062, '', '83.233.186.82', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-09-14 01:16:32');
INSERT INTO `audittrail` VALUES (1063, '', '83.233.186.82', 'http://guardsecure.newwavetech.co.ug/settings/settings.php', '2012-09-14 01:16:45');
INSERT INTO `audittrail` VALUES (1064, '', '83.233.186.82', 'http://guardsecure.newwavetech.co.ug/core/favorites.php', '2012-09-14 01:16:46');
INSERT INTO `audittrail` VALUES (1065, '', '83.233.186.82', 'http://guardsecure.newwavetech.co.ug/core/reminders.php', '2012-09-14 01:16:46');
INSERT INTO `audittrail` VALUES (1066, '', '83.233.186.82', 'http://guardsecure.newwavetech.co.ug/settings/index.php', '2012-09-14 01:16:46');
INSERT INTO `audittrail` VALUES (1067, '', '83.233.186.82', 'http://guardsecure.newwavetech.co.ug/core/user.php?id=&action=edit', '2012-09-14 01:16:48');
INSERT INTO `audittrail` VALUES (1068, '', '83.233.186.82', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-09-15 01:51:37');
INSERT INTO `audittrail` VALUES (1069, '', '83.233.186.82', 'http://guardsecure.newwavetech.co.ug/settings/settings.php', '2012-09-15 01:51:49');
INSERT INTO `audittrail` VALUES (1070, '', '83.233.186.82', 'http://guardsecure.newwavetech.co.ug/core/favorites.php', '2012-09-15 01:51:50');
INSERT INTO `audittrail` VALUES (1071, '', '83.233.186.82', 'http://guardsecure.newwavetech.co.ug/core/reminders.php', '2012-09-15 01:51:51');
INSERT INTO `audittrail` VALUES (1072, '', '83.233.186.82', 'http://guardsecure.newwavetech.co.ug/settings/index.php', '2012-09-15 01:51:51');
INSERT INTO `audittrail` VALUES (1073, '', '83.233.186.82', 'http://guardsecure.newwavetech.co.ug/core/user.php?id=&action=edit', '2012-09-15 01:51:53');
INSERT INTO `audittrail` VALUES (1074, '', '222.187.222.104', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-09-15 19:51:06');
INSERT INTO `audittrail` VALUES (1075, '', '222.187.222.104', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-09-15 19:51:07');
INSERT INTO `audittrail` VALUES (1076, '', '131.253.46.112', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-09-16 00:28:48');
INSERT INTO `audittrail` VALUES (1077, '', '208.115.113.87', 'http://guardsecure.newwavetech.co.ug/core/reminders.php', '2012-09-16 00:44:29');
INSERT INTO `audittrail` VALUES (1078, '', '83.233.186.82', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-09-16 01:41:43');
INSERT INTO `audittrail` VALUES (1079, '', '83.233.186.82', 'http://guardsecure.newwavetech.co.ug/settings/settings.php', '2012-09-16 01:41:54');
INSERT INTO `audittrail` VALUES (1080, '', '83.233.186.82', 'http://guardsecure.newwavetech.co.ug/core/favorites.php', '2012-09-16 01:41:55');
INSERT INTO `audittrail` VALUES (1081, '', '83.233.186.82', 'http://guardsecure.newwavetech.co.ug/core/reminders.php', '2012-09-16 01:41:56');
INSERT INTO `audittrail` VALUES (1082, '', '83.233.186.82', 'http://guardsecure.newwavetech.co.ug/settings/index.php', '2012-09-16 01:41:56');
INSERT INTO `audittrail` VALUES (1083, '', '83.233.186.82', 'http://guardsecure.newwavetech.co.ug/core/user.php?id=&action=edit', '2012-09-16 01:41:58');
INSERT INTO `audittrail` VALUES (1084, '', '5.167.189.43', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-09-16 03:47:37');
INSERT INTO `audittrail` VALUES (1085, '', '31.184.238.13', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-09-16 09:22:41');
INSERT INTO `audittrail` VALUES (1086, '', '82.193.109.249', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-09-17 12:31:22');
INSERT INTO `audittrail` VALUES (1087, '', '93.182.163.36', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-09-17 15:52:31');
INSERT INTO `audittrail` VALUES (1088, '', '93.182.163.36', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-09-17 15:52:32');
INSERT INTO `audittrail` VALUES (1089, '', '208.115.111.71', 'http://guardsecure.newwavetech.co.ug/core/viewuser.php?id=', '2012-09-17 18:33:57');
INSERT INTO `audittrail` VALUES (1090, '', '208.115.111.71', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-09-17 22:48:00');
INSERT INTO `audittrail` VALUES (1091, '', '82.80.249.139', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-09-17 23:02:34');
INSERT INTO `audittrail` VALUES (1092, '', '66.249.73.202', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-09-18 05:56:12');
INSERT INTO `audittrail` VALUES (1093, '', '5.167.189.161', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-09-18 09:45:32');
INSERT INTO `audittrail` VALUES (1094, '', '83.233.186.82', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-09-18 15:26:44');
INSERT INTO `audittrail` VALUES (1095, '', '83.233.186.82', 'http://guardsecure.newwavetech.co.ug/settings/settings.php', '2012-09-18 15:26:59');
INSERT INTO `audittrail` VALUES (1096, '', '83.233.186.82', 'http://guardsecure.newwavetech.co.ug/core/favorites.php', '2012-09-18 15:27:00');
INSERT INTO `audittrail` VALUES (1097, '', '83.233.186.82', 'http://guardsecure.newwavetech.co.ug/core/reminders.php', '2012-09-18 15:27:01');
INSERT INTO `audittrail` VALUES (1098, '', '83.233.186.82', 'http://guardsecure.newwavetech.co.ug/settings/index.php', '2012-09-18 15:27:01');
INSERT INTO `audittrail` VALUES (1099, '', '83.233.186.82', 'http://guardsecure.newwavetech.co.ug/core/user.php?id=&action=edit', '2012-09-18 15:27:03');
INSERT INTO `audittrail` VALUES (1100, '', '199.15.234.122', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-09-18 18:07:04');
INSERT INTO `audittrail` VALUES (1101, '', '83.233.186.82', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-09-18 23:02:33');
INSERT INTO `audittrail` VALUES (1102, '', '83.233.186.82', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-09-19 01:56:26');
INSERT INTO `audittrail` VALUES (1103, '', '83.233.186.82', 'http://guardsecure.newwavetech.co.ug/settings/settings.php', '2012-09-19 01:56:37');
INSERT INTO `audittrail` VALUES (1104, '', '83.233.186.82', 'http://guardsecure.newwavetech.co.ug/core/favorites.php', '2012-09-19 01:56:38');
INSERT INTO `audittrail` VALUES (1105, '', '83.233.186.82', 'http://guardsecure.newwavetech.co.ug/core/reminders.php', '2012-09-19 01:56:38');
INSERT INTO `audittrail` VALUES (1106, '', '83.233.186.82', 'http://guardsecure.newwavetech.co.ug/settings/index.php', '2012-09-19 01:56:38');
INSERT INTO `audittrail` VALUES (1107, '', '83.233.186.82', 'http://guardsecure.newwavetech.co.ug/core/user.php?id=&action=edit', '2012-09-19 01:56:40');
INSERT INTO `audittrail` VALUES (1108, '', '173.242.122.80', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-09-19 04:42:00');
INSERT INTO `audittrail` VALUES (1109, '', '173.242.122.80', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-09-19 04:42:04');
INSERT INTO `audittrail` VALUES (1110, '', '208.115.111.71', 'http://guardsecure.newwavetech.co.ug/settings/settings.php', '2012-09-20 02:44:58');
INSERT INTO `audittrail` VALUES (1111, '', '31.184.238.13', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-09-20 06:35:54');
INSERT INTO `audittrail` VALUES (1112, '', '208.115.111.71', 'http://guardsecure.newwavetech.co.ug/settings/index.php', '2012-09-20 06:50:45');
INSERT INTO `audittrail` VALUES (1113, '', '41.221.93.229', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-09-20 14:38:01');
INSERT INTO `audittrail` VALUES (1114, '', '83.233.186.82', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-09-21 00:51:55');
INSERT INTO `audittrail` VALUES (1115, '', '83.233.186.82', 'http://guardsecure.newwavetech.co.ug/settings/settings.php', '2012-09-21 00:52:08');
INSERT INTO `audittrail` VALUES (1116, '', '83.233.186.82', 'http://guardsecure.newwavetech.co.ug/core/favorites.php', '2012-09-21 00:52:09');
INSERT INTO `audittrail` VALUES (1117, '', '83.233.186.82', 'http://guardsecure.newwavetech.co.ug/core/reminders.php', '2012-09-21 00:52:09');
INSERT INTO `audittrail` VALUES (1118, '', '83.233.186.82', 'http://guardsecure.newwavetech.co.ug/settings/index.php', '2012-09-21 00:52:09');
INSERT INTO `audittrail` VALUES (1119, '', '83.233.186.82', 'http://guardsecure.newwavetech.co.ug/core/user.php?id=&action=edit', '2012-09-21 00:52:11');
INSERT INTO `audittrail` VALUES (1120, '', '213.186.127.7', 'http://guardsecure.newwavetech.co.ug/core/user.php?id=&action=edit', '2012-09-21 22:24:19');
INSERT INTO `audittrail` VALUES (1121, '', '83.233.186.82', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-09-22 01:01:56');
INSERT INTO `audittrail` VALUES (1122, '', '83.233.186.82', 'http://guardsecure.newwavetech.co.ug/settings/settings.php', '2012-09-22 01:02:07');
INSERT INTO `audittrail` VALUES (1123, '', '83.233.186.82', 'http://guardsecure.newwavetech.co.ug/core/favorites.php', '2012-09-22 01:02:08');
INSERT INTO `audittrail` VALUES (1124, '', '83.233.186.82', 'http://guardsecure.newwavetech.co.ug/core/reminders.php', '2012-09-22 01:02:08');
INSERT INTO `audittrail` VALUES (1125, '', '83.233.186.82', 'http://guardsecure.newwavetech.co.ug/settings/index.php', '2012-09-22 01:02:08');
INSERT INTO `audittrail` VALUES (1126, '', '83.233.186.82', 'http://guardsecure.newwavetech.co.ug/core/user.php?id=&action=edit', '2012-09-22 01:02:10');
INSERT INTO `audittrail` VALUES (1127, '', '83.233.186.82', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-09-22 21:54:21');
INSERT INTO `audittrail` VALUES (1128, '', '180.76.5.54', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-09-22 22:04:29');
INSERT INTO `audittrail` VALUES (1129, '', '83.233.186.82', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-09-23 00:49:24');
INSERT INTO `audittrail` VALUES (1130, '', '83.233.186.82', 'http://guardsecure.newwavetech.co.ug/settings/settings.php', '2012-09-23 00:49:35');
INSERT INTO `audittrail` VALUES (1131, '', '83.233.186.82', 'http://guardsecure.newwavetech.co.ug/core/favorites.php', '2012-09-23 00:49:36');
INSERT INTO `audittrail` VALUES (1132, '', '83.233.186.82', 'http://guardsecure.newwavetech.co.ug/core/reminders.php', '2012-09-23 00:49:37');
INSERT INTO `audittrail` VALUES (1133, '', '83.233.186.82', 'http://guardsecure.newwavetech.co.ug/settings/index.php', '2012-09-23 00:49:37');
INSERT INTO `audittrail` VALUES (1134, '', '41.221.93.229', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-09-23 05:03:11');
INSERT INTO `audittrail` VALUES (1135, '', '31.184.238.33', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-09-23 18:53:49');
INSERT INTO `audittrail` VALUES (1136, '', '117.21.225.6', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-09-23 19:03:19');
INSERT INTO `audittrail` VALUES (1137, '', '117.21.225.6', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-09-23 19:03:20');
INSERT INTO `audittrail` VALUES (1138, '', '83.233.186.82', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-09-24 03:27:49');
INSERT INTO `audittrail` VALUES (1139, '', '83.233.186.82', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-09-24 04:48:01');
INSERT INTO `audittrail` VALUES (1140, '', '83.233.186.82', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-09-24 07:07:28');
INSERT INTO `audittrail` VALUES (1141, '', '83.233.186.82', 'http://guardsecure.newwavetech.co.ug/settings/settings.php', '2012-09-24 07:07:39');
INSERT INTO `audittrail` VALUES (1142, '', '83.233.186.82', 'http://guardsecure.newwavetech.co.ug/core/favorites.php', '2012-09-24 07:07:40');
INSERT INTO `audittrail` VALUES (1143, '', '83.233.186.82', 'http://guardsecure.newwavetech.co.ug/core/reminders.php', '2012-09-24 07:07:40');
INSERT INTO `audittrail` VALUES (1144, '', '83.233.186.82', 'http://guardsecure.newwavetech.co.ug/settings/index.php', '2012-09-24 07:07:41');
INSERT INTO `audittrail` VALUES (1145, '', '83.233.186.82', 'http://guardsecure.newwavetech.co.ug/core/user.php?id=&action=edit', '2012-09-24 07:07:43');
INSERT INTO `audittrail` VALUES (1146, '', '213.186.119.140', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-09-24 13:24:19');
INSERT INTO `audittrail` VALUES (1147, '', '94.23.12.62', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-09-24 13:35:37');
INSERT INTO `audittrail` VALUES (1148, '', '94.23.12.62', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-09-24 13:35:38');
INSERT INTO `audittrail` VALUES (1149, '', '83.233.186.82', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-09-24 20:59:35');
INSERT INTO `audittrail` VALUES (1150, '', '83.233.186.82', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-09-24 22:09:21');
INSERT INTO `audittrail` VALUES (1151, '', '83.233.186.82', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-09-25 00:33:06');
INSERT INTO `audittrail` VALUES (1152, '', '83.233.186.82', 'http://guardsecure.newwavetech.co.ug/settings/settings.php', '2012-09-25 00:33:17');
INSERT INTO `audittrail` VALUES (1153, '', '83.233.186.82', 'http://guardsecure.newwavetech.co.ug/core/favorites.php', '2012-09-25 00:33:18');
INSERT INTO `audittrail` VALUES (1154, '', '83.233.186.82', 'http://guardsecure.newwavetech.co.ug/core/reminders.php', '2012-09-25 00:33:18');
INSERT INTO `audittrail` VALUES (1155, '', '83.233.186.82', 'http://guardsecure.newwavetech.co.ug/settings/index.php', '2012-09-25 00:33:19');
INSERT INTO `audittrail` VALUES (1156, '', '83.233.186.82', 'http://guardsecure.newwavetech.co.ug/core/user.php?id=&action=edit', '2012-09-25 00:33:20');
INSERT INTO `audittrail` VALUES (1157, '', '208.115.113.87', 'http://guardsecure.newwavetech.co.ug/core/user.php?id=&action=edit', '2012-09-25 16:55:17');
INSERT INTO `audittrail` VALUES (1158, '', '83.233.186.82', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-09-25 21:59:25');
INSERT INTO `audittrail` VALUES (1159, '', '83.233.186.82', 'http://guardsecure.newwavetech.co.ug/settings/settings.php', '2012-09-25 21:59:35');
INSERT INTO `audittrail` VALUES (1160, '', '83.233.186.82', 'http://guardsecure.newwavetech.co.ug/core/favorites.php', '2012-09-25 21:59:36');
INSERT INTO `audittrail` VALUES (1161, '', '83.233.186.82', 'http://guardsecure.newwavetech.co.ug/core/reminders.php', '2012-09-25 21:59:37');
INSERT INTO `audittrail` VALUES (1162, '', '83.233.186.82', 'http://guardsecure.newwavetech.co.ug/settings/index.php', '2012-09-25 21:59:38');
INSERT INTO `audittrail` VALUES (1163, '', '83.233.186.82', 'http://guardsecure.newwavetech.co.ug/core/user.php?id=&action=edit', '2012-09-25 21:59:40');
INSERT INTO `audittrail` VALUES (1164, '', '83.233.186.82', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-09-26 00:43:06');
INSERT INTO `audittrail` VALUES (1165, '', '83.233.186.82', 'http://guardsecure.newwavetech.co.ug/settings/settings.php', '2012-09-26 00:43:18');
INSERT INTO `audittrail` VALUES (1166, '', '83.233.186.82', 'http://guardsecure.newwavetech.co.ug/core/favorites.php', '2012-09-26 00:43:19');
INSERT INTO `audittrail` VALUES (1167, '', '83.233.186.82', 'http://guardsecure.newwavetech.co.ug/core/reminders.php', '2012-09-26 00:43:19');
INSERT INTO `audittrail` VALUES (1168, '', '83.233.186.82', 'http://guardsecure.newwavetech.co.ug/settings/index.php', '2012-09-26 00:43:19');
INSERT INTO `audittrail` VALUES (1169, '', '83.233.186.82', 'http://guardsecure.newwavetech.co.ug/core/user.php?id=&action=edit', '2012-09-26 00:43:21');
INSERT INTO `audittrail` VALUES (1170, '', '37.59.48.227', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-09-26 08:21:21');
INSERT INTO `audittrail` VALUES (1171, '', '37.59.48.227', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-09-26 08:21:22');
INSERT INTO `audittrail` VALUES (1172, '', '178.255.215.79', 'http://guardsecure.newwavetech.co.ug/settings/index.php', '2012-09-26 11:17:50');
INSERT INTO `audittrail` VALUES (1173, '', '178.255.215.79', 'http://guardsecure.newwavetech.co.ug/settings/settings.php', '2012-09-26 12:10:43');
INSERT INTO `audittrail` VALUES (1174, '', '99.67.238.51', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-09-26 14:02:01');
INSERT INTO `audittrail` VALUES (1175, '', '208.115.111.71', 'http://guardsecure.newwavetech.co.ug/core/favorites.php', '2012-09-26 14:34:04');
INSERT INTO `audittrail` VALUES (1176, '', '31.184.238.13', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-09-27 01:42:01');
INSERT INTO `audittrail` VALUES (1177, '', '91.201.64.223', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-09-27 19:40:09');
INSERT INTO `audittrail` VALUES (1178, '', '31.184.238.13', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-09-28 19:17:02');
INSERT INTO `audittrail` VALUES (1179, '', '94.23.1.28', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-09-29 00:08:30');
INSERT INTO `audittrail` VALUES (1180, '', '83.233.186.82', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-09-29 13:37:15');
INSERT INTO `audittrail` VALUES (1181, '', '190.90.36.8', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-09-29 19:19:30');
INSERT INTO `audittrail` VALUES (1182, '', '83.233.186.82', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-09-30 01:08:30');
INSERT INTO `audittrail` VALUES (1183, '', '83.233.186.82', 'http://guardsecure.newwavetech.co.ug/settings/settings.php', '2012-09-30 01:08:41');
INSERT INTO `audittrail` VALUES (1184, '', '83.233.186.82', 'http://guardsecure.newwavetech.co.ug/core/favorites.php', '2012-09-30 01:08:42');
INSERT INTO `audittrail` VALUES (1185, '', '83.233.186.82', 'http://guardsecure.newwavetech.co.ug/core/reminders.php', '2012-09-30 01:08:42');
INSERT INTO `audittrail` VALUES (1186, '', '83.233.186.82', 'http://guardsecure.newwavetech.co.ug/settings/index.php', '2012-09-30 01:08:42');
INSERT INTO `audittrail` VALUES (1187, '', '83.233.186.82', 'http://guardsecure.newwavetech.co.ug/core/user.php?id=&action=edit', '2012-09-30 01:08:44');
INSERT INTO `audittrail` VALUES (1188, '', '66.249.73.210', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-09-30 08:27:30');
INSERT INTO `audittrail` VALUES (1189, '', '31.184.238.33', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-09-30 15:10:04');
INSERT INTO `audittrail` VALUES (1190, '', '83.233.186.82', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-09-30 21:54:48');
INSERT INTO `audittrail` VALUES (1191, '', '83.233.186.82', 'http://guardsecure.newwavetech.co.ug/settings/settings.php', '2012-09-30 21:55:01');
INSERT INTO `audittrail` VALUES (1192, '', '83.233.186.82', 'http://guardsecure.newwavetech.co.ug/core/favorites.php', '2012-09-30 21:55:01');
INSERT INTO `audittrail` VALUES (1193, '', '83.233.186.82', 'http://guardsecure.newwavetech.co.ug/core/reminders.php', '2012-09-30 21:55:02');
INSERT INTO `audittrail` VALUES (1194, '', '83.233.186.82', 'http://guardsecure.newwavetech.co.ug/settings/index.php', '2012-09-30 21:55:02');
INSERT INTO `audittrail` VALUES (1195, '', '83.233.186.82', 'http://guardsecure.newwavetech.co.ug/core/user.php?id=&action=edit', '2012-09-30 21:55:04');
INSERT INTO `audittrail` VALUES (1196, '', '91.236.74.192', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-09-30 22:36:07');
INSERT INTO `audittrail` VALUES (1197, '', '91.236.74.192', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-09-30 22:36:08');
INSERT INTO `audittrail` VALUES (1198, '', '83.233.186.82', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-10-01 00:37:09');
INSERT INTO `audittrail` VALUES (1199, '', '83.233.186.82', 'http://guardsecure.newwavetech.co.ug/settings/settings.php', '2012-10-01 00:37:20');
INSERT INTO `audittrail` VALUES (1200, '', '83.233.186.82', 'http://guardsecure.newwavetech.co.ug/core/favorites.php', '2012-10-01 00:37:21');
INSERT INTO `audittrail` VALUES (1201, '', '83.233.186.82', 'http://guardsecure.newwavetech.co.ug/core/reminders.php', '2012-10-01 00:37:21');
INSERT INTO `audittrail` VALUES (1202, '', '83.233.186.82', 'http://guardsecure.newwavetech.co.ug/settings/index.php', '2012-10-01 00:37:21');
INSERT INTO `audittrail` VALUES (1203, '', '83.233.186.82', 'http://guardsecure.newwavetech.co.ug/core/user.php?id=&action=edit', '2012-10-01 00:37:23');
INSERT INTO `audittrail` VALUES (1204, '', '208.115.113.87', 'http://guardsecure.newwavetech.co.ug/core/reminders.php', '2012-10-01 08:27:32');
INSERT INTO `audittrail` VALUES (1205, '', '77.247.181.162', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-10-01 09:08:59');
INSERT INTO `audittrail` VALUES (1206, '', '77.247.181.162', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-10-01 09:09:11');
INSERT INTO `audittrail` VALUES (1207, '', '66.249.73.210', 'http://guardsecure.newwavetech.co.ug/core/user.php?id=&action=edit', '2012-10-02 02:35:57');
INSERT INTO `audittrail` VALUES (1208, '', '94.181.148.117', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-10-02 15:16:19');
INSERT INTO `audittrail` VALUES (1209, '', '46.119.122.31', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-10-02 16:53:55');
INSERT INTO `audittrail` VALUES (1210, '', '46.119.122.31', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-10-02 20:33:40');
INSERT INTO `audittrail` VALUES (1211, '', '208.115.111.71', 'http://guardsecure.newwavetech.co.ug/core/viewuser.php?id=', '2012-10-03 10:19:04');
INSERT INTO `audittrail` VALUES (1212, '', '208.115.111.71', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-10-03 13:29:47');
INSERT INTO `audittrail` VALUES (1213, '', '66.249.71.227', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-10-03 14:49:13');
INSERT INTO `audittrail` VALUES (1214, '', '83.233.186.82', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-10-04 09:54:51');
INSERT INTO `audittrail` VALUES (1215, '', '83.233.186.82', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-10-04 11:52:04');
INSERT INTO `audittrail` VALUES (1216, '', '83.233.186.82', 'http://guardsecure.newwavetech.co.ug/settings/settings.php', '2012-10-04 11:52:15');
INSERT INTO `audittrail` VALUES (1217, '', '83.233.186.82', 'http://guardsecure.newwavetech.co.ug/core/favorites.php', '2012-10-04 11:52:16');
INSERT INTO `audittrail` VALUES (1218, '', '83.233.186.82', 'http://guardsecure.newwavetech.co.ug/core/reminders.php', '2012-10-04 11:52:16');
INSERT INTO `audittrail` VALUES (1219, '', '83.233.186.82', 'http://guardsecure.newwavetech.co.ug/settings/index.php', '2012-10-04 11:52:17');
INSERT INTO `audittrail` VALUES (1220, '', '83.233.186.82', 'http://guardsecure.newwavetech.co.ug/core/user.php?id=&action=edit', '2012-10-04 11:52:19');
INSERT INTO `audittrail` VALUES (1221, '', '31.184.238.33', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-10-05 03:46:03');
INSERT INTO `audittrail` VALUES (1222, '', '62.75.216.154', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-10-05 06:30:18');
INSERT INTO `audittrail` VALUES (1223, '', '46.119.122.31', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-10-05 07:42:10');
INSERT INTO `audittrail` VALUES (1224, '', '46.119.122.31', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-10-05 17:23:07');
INSERT INTO `audittrail` VALUES (1225, '', '208.115.111.71', 'http://guardsecure.newwavetech.co.ug/settings/settings.php', '2012-10-05 17:41:19');
INSERT INTO `audittrail` VALUES (1226, '', '208.115.111.71', 'http://guardsecure.newwavetech.co.ug/settings/index.php', '2012-10-05 21:42:10');
INSERT INTO `audittrail` VALUES (1227, '', '188.143.232.33', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-10-06 15:47:43');
INSERT INTO `audittrail` VALUES (1228, '', '31.184.238.33', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-10-06 20:16:33');
INSERT INTO `audittrail` VALUES (1229, '', '31.184.238.33', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-10-08 19:36:04');
INSERT INTO `audittrail` VALUES (1230, '', '88.190.37.223', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-10-09 11:55:09');
INSERT INTO `audittrail` VALUES (1231, '', '88.190.37.223', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-10-09 11:55:10');
INSERT INTO `audittrail` VALUES (1232, '', '31.184.238.33', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-10-10 02:34:47');
INSERT INTO `audittrail` VALUES (1233, '', '208.115.113.87', 'http://guardsecure.newwavetech.co.ug/core/user.php?id=&action=edit', '2012-10-10 20:35:35');
INSERT INTO `audittrail` VALUES (1234, '', '220.181.108.119', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-10-11 01:30:06');
INSERT INTO `audittrail` VALUES (1235, '', '188.165.220.218', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-10-11 10:55:01');
INSERT INTO `audittrail` VALUES (1236, '', '184.154.119.146', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-10-11 18:40:02');
INSERT INTO `audittrail` VALUES (1237, '', '220.181.108.76', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-10-11 19:21:04');
INSERT INTO `audittrail` VALUES (1238, '', '31.184.238.33', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-10-11 22:01:50');
INSERT INTO `audittrail` VALUES (1239, '', '180.76.5.140', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-10-11 23:17:06');
INSERT INTO `audittrail` VALUES (1240, '', '208.115.111.71', 'http://guardsecure.newwavetech.co.ug/core/favorites.php', '2012-10-12 01:38:57');
INSERT INTO `audittrail` VALUES (1241, '', '37.113.53.218', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-10-12 02:38:29');
INSERT INTO `audittrail` VALUES (1242, '', '31.184.238.13', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-10-12 10:35:42');
INSERT INTO `audittrail` VALUES (1243, '', '184.154.119.146', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-10-12 10:55:45');
INSERT INTO `audittrail` VALUES (1244, '', '91.237.249.99', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-10-12 14:27:43');
INSERT INTO `audittrail` VALUES (1245, '', '91.237.249.99', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-10-12 14:27:44');
INSERT INTO `audittrail` VALUES (1246, '', '37.59.48.227', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-10-13 04:11:13');
INSERT INTO `audittrail` VALUES (1247, '', '37.59.48.227', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-10-13 04:11:14');
INSERT INTO `audittrail` VALUES (1248, '', '41.82.118.58', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-10-13 12:19:36');
INSERT INTO `audittrail` VALUES (1249, '', '41.82.118.58', 'http://guardsecure.newwavetech.co.ug/core/favorites.php', '2012-10-13 12:19:51');
INSERT INTO `audittrail` VALUES (1250, '', '41.82.118.58', 'http://guardsecure.newwavetech.co.ug/core/reminders.php', '2012-10-13 12:19:52');
INSERT INTO `audittrail` VALUES (1251, '', '41.82.118.58', 'http://guardsecure.newwavetech.co.ug/core/viewuser.php?id=417', '2012-10-13 12:19:52');
INSERT INTO `audittrail` VALUES (1252, '', '41.82.118.58', 'http://guardsecure.newwavetech.co.ug/settings/index.php', '2012-10-13 12:19:52');
INSERT INTO `audittrail` VALUES (1253, '', '41.82.118.58', 'http://guardsecure.newwavetech.co.ug/settings/settings.php', '2012-10-13 12:19:52');
INSERT INTO `audittrail` VALUES (1254, '', '41.82.118.58', 'http://guardsecure.newwavetech.co.ug/core/viewuser.php?id=21', '2012-10-13 12:20:00');
INSERT INTO `audittrail` VALUES (1255, '', '41.82.118.58', 'http://guardsecure.newwavetech.co.ug/core/viewuser.php?id=365', '2012-10-13 12:20:01');
INSERT INTO `audittrail` VALUES (1256, '', '41.82.118.58', 'http://guardsecure.newwavetech.co.ug/core/viewuser.php?id=', '2012-10-13 12:20:01');
INSERT INTO `audittrail` VALUES (1257, '', '41.82.118.58', 'http://guardsecure.newwavetech.co.ug/core/user.php?id=&action=edit', '2012-10-13 12:20:01');
INSERT INTO `audittrail` VALUES (1258, '', '41.82.118.58', 'http://guardsecure.newwavetech.co.ug/core/viewuser.php?id=151', '2012-10-13 12:20:46');
INSERT INTO `audittrail` VALUES (1259, '', '213.186.119.135', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-10-14 00:17:36');
INSERT INTO `audittrail` VALUES (1260, '', '66.249.73.210', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-10-14 02:44:42');
INSERT INTO `audittrail` VALUES (1261, '', '213.186.119.142', 'http://guardsecure.newwavetech.co.ug/core/favorites.php', '2012-10-14 04:47:35');
INSERT INTO `audittrail` VALUES (1262, '', '213.186.119.141', 'http://guardsecure.newwavetech.co.ug/core/reminders.php', '2012-10-14 18:17:35');
INSERT INTO `audittrail` VALUES (1263, '', '213.186.119.132', 'http://guardsecure.newwavetech.co.ug/core/viewuser.php?id=', '2012-10-14 22:47:35');
INSERT INTO `audittrail` VALUES (1264, '', '203.198.23.82', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-10-15 00:54:32');
INSERT INTO `audittrail` VALUES (1265, '', '31.184.238.33', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-10-15 07:28:20');
INSERT INTO `audittrail` VALUES (1266, '', '212.113.37.105', 'http://guardsecure.newwavetech.co.ug/settings/index.php', '2012-10-15 07:48:03');
INSERT INTO `audittrail` VALUES (1267, '', '31.184.238.13', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-10-15 08:36:26');
INSERT INTO `audittrail` VALUES (1268, '', '213.186.119.143', 'http://guardsecure.newwavetech.co.ug/settings/settings.php', '2012-10-15 11:10:06');
INSERT INTO `audittrail` VALUES (1269, '', '204.236.235.245', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-10-16 02:01:00');
INSERT INTO `audittrail` VALUES (1270, '', '37.113.40.105', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-10-16 05:50:22');
INSERT INTO `audittrail` VALUES (1271, '', '196.0.21.52', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-10-16 08:34:20');
INSERT INTO `audittrail` VALUES (1272, '', '208.115.113.87', 'http://guardsecure.newwavetech.co.ug/core/reminders.php', '2012-10-16 08:45:23');
INSERT INTO `audittrail` VALUES (1273, '', '46.119.122.31', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-10-17 07:32:24');
INSERT INTO `audittrail` VALUES (1274, '', '94.181.168.128', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-10-17 17:44:14');
INSERT INTO `audittrail` VALUES (1275, '', '46.119.122.31', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-10-17 18:23:19');
INSERT INTO `audittrail` VALUES (1276, '', '188.165.124.176', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-10-18 05:29:59');
INSERT INTO `audittrail` VALUES (1277, '', '188.165.124.176', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-10-18 09:12:10');
INSERT INTO `audittrail` VALUES (1278, '', '208.115.111.71', 'http://guardsecure.newwavetech.co.ug/core/viewuser.php?id=', '2012-10-18 15:08:31');
INSERT INTO `audittrail` VALUES (1279, '', '190.194.30.185', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-10-18 16:17:50');
INSERT INTO `audittrail` VALUES (1280, '', '208.115.111.71', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-10-18 18:07:05');
INSERT INTO `audittrail` VALUES (1281, '', '31.184.238.13', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-10-19 00:21:46');
INSERT INTO `audittrail` VALUES (1282, '', '31.184.238.33', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-10-19 00:50:23');
INSERT INTO `audittrail` VALUES (1283, '', '5.167.184.151', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-10-19 04:12:41');
INSERT INTO `audittrail` VALUES (1284, '', '188.165.220.218', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-10-19 16:32:55');
INSERT INTO `audittrail` VALUES (1285, '', '157.55.34.183', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-10-19 21:22:44');
INSERT INTO `audittrail` VALUES (1286, '', '157.55.34.183', 'http://guardsecure.newwavetech.co.ug/core/reminders.php', '2012-10-19 21:22:50');
INSERT INTO `audittrail` VALUES (1287, '', '157.55.32.77', 'http://guardsecure.newwavetech.co.ug/core/favorites.php', '2012-10-19 21:25:56');
INSERT INTO `audittrail` VALUES (1288, '', '157.55.34.183', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-10-20 01:14:02');
INSERT INTO `audittrail` VALUES (1289, '', '157.55.34.183', 'http://guardsecure.newwavetech.co.ug/core/reminders.php', '2012-10-20 01:14:05');
INSERT INTO `audittrail` VALUES (1290, '', '157.55.32.77', 'http://guardsecure.newwavetech.co.ug/core/favorites.php', '2012-10-20 01:25:36');
INSERT INTO `audittrail` VALUES (1291, '', '91.237.249.99', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-10-20 03:17:47');
INSERT INTO `audittrail` VALUES (1292, '', '208.115.111.71', 'http://guardsecure.newwavetech.co.ug/settings/settings.php', '2012-10-20 22:24:40');
INSERT INTO `audittrail` VALUES (1293, '', '208.115.111.71', 'http://guardsecure.newwavetech.co.ug/settings/index.php', '2012-10-21 02:45:58');
INSERT INTO `audittrail` VALUES (1294, '', '94.181.168.128', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-10-22 17:31:45');
INSERT INTO `audittrail` VALUES (1295, '', '41.221.90.30', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-10-23 02:35:30');
INSERT INTO `audittrail` VALUES (1296, '', '31.184.238.13', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-10-23 05:01:59');
INSERT INTO `audittrail` VALUES (1297, '', '46.119.39.200', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-10-23 07:08:56');
INSERT INTO `audittrail` VALUES (1298, '', '46.119.39.200', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-10-23 07:08:57');
INSERT INTO `audittrail` VALUES (1299, '', '31.184.238.33', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-10-23 17:27:54');
INSERT INTO `audittrail` VALUES (1300, '', '177.71.243.229', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-10-25 08:07:03');
INSERT INTO `audittrail` VALUES (1301, '', '177.71.144.189', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-10-25 08:07:05');
INSERT INTO `audittrail` VALUES (1302, '', '54.232.11.220', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php/index.php', '2012-10-25 08:07:07');
INSERT INTO `audittrail` VALUES (1303, '', '91.237.249.99', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-10-26 03:13:45');
INSERT INTO `audittrail` VALUES (1304, '', '66.249.73.210', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-10-26 04:52:22');
INSERT INTO `audittrail` VALUES (1305, '', '66.249.73.210', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-10-26 05:08:07');
INSERT INTO `audittrail` VALUES (1306, '', '178.137.88.191', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-10-26 13:03:49');
INSERT INTO `audittrail` VALUES (1307, '', '178.137.88.191', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-10-26 13:04:00');
INSERT INTO `audittrail` VALUES (1308, '', '31.184.238.13', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-10-26 18:36:07');
INSERT INTO `audittrail` VALUES (1309, '', '31.184.238.13', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-10-26 18:36:08');
INSERT INTO `audittrail` VALUES (1310, '', '31.184.238.33', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-10-26 20:40:00');
INSERT INTO `audittrail` VALUES (1311, '', '31.184.238.33', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-10-26 20:40:01');
INSERT INTO `audittrail` VALUES (1312, '', '180.76.5.59', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-10-26 22:33:48');
INSERT INTO `audittrail` VALUES (1313, '', '173.199.120.99', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-10-27 09:06:33');
INSERT INTO `audittrail` VALUES (1314, '', '173.242.118.223', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-10-27 10:23:38');
INSERT INTO `audittrail` VALUES (1315, '', '173.242.118.223', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-10-27 10:23:38');
INSERT INTO `audittrail` VALUES (1316, '', '208.115.111.71', 'http://guardsecure.newwavetech.co.ug/core/favorites.php', '2012-10-27 10:51:20');
INSERT INTO `audittrail` VALUES (1317, '', '173.199.114.179', 'http://guardsecure.newwavetech.co.ug/settings/settings.php', '2012-10-27 14:01:50');
INSERT INTO `audittrail` VALUES (1318, '', '173.199.115.67', 'http://guardsecure.newwavetech.co.ug/core/viewuser.php?id=', '2012-10-27 14:16:53');
INSERT INTO `audittrail` VALUES (1319, '', '173.199.115.107', 'http://guardsecure.newwavetech.co.ug/core/favorites.php', '2012-10-27 14:39:13');
INSERT INTO `audittrail` VALUES (1320, '', '173.199.116.91', 'http://guardsecure.newwavetech.co.ug/settings/index.php', '2012-10-27 14:47:02');
INSERT INTO `audittrail` VALUES (1321, '', '173.199.115.115', 'http://guardsecure.newwavetech.co.ug/core/reminders.php', '2012-10-27 14:54:13');
INSERT INTO `audittrail` VALUES (1322, '', '173.199.115.75', 'http://guardsecure.newwavetech.co.ug/core/user.php?id=&action=edit', '2012-10-27 20:11:59');
INSERT INTO `audittrail` VALUES (1323, '', '31.184.238.33', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-10-28 02:32:08');
INSERT INTO `audittrail` VALUES (1324, '', '94.27.83.230', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-10-28 09:56:16');
INSERT INTO `audittrail` VALUES (1325, '', '85.17.29.107', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-10-28 21:22:30');
INSERT INTO `audittrail` VALUES (1326, '', '85.17.29.107', 'http://guardsecure.newwavetech.co.ug/core/viewuser.php?id=', '2012-10-28 21:22:40');
INSERT INTO `audittrail` VALUES (1327, '', '85.17.29.107', 'http://guardsecure.newwavetech.co.ug/settings/settings.php', '2012-10-28 21:22:41');
INSERT INTO `audittrail` VALUES (1328, '', '85.17.29.107', 'http://guardsecure.newwavetech.co.ug/core/favorites.php', '2012-10-28 21:22:52');
INSERT INTO `audittrail` VALUES (1329, '', '85.17.29.107', 'http://guardsecure.newwavetech.co.ug/core/reminders.php', '2012-10-28 21:22:54');
INSERT INTO `audittrail` VALUES (1330, '', '85.17.29.107', 'http://guardsecure.newwavetech.co.ug/settings/index.php', '2012-10-28 21:22:56');
INSERT INTO `audittrail` VALUES (1331, '', '31.184.238.33', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-10-29 00:47:04');
INSERT INTO `audittrail` VALUES (1332, '', '31.184.238.13', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-10-29 00:56:04');
INSERT INTO `audittrail` VALUES (1333, '', '114.102.10.104', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-10-29 04:35:32');
INSERT INTO `audittrail` VALUES (1334, '', '188.163.25.86', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-10-30 01:03:28');
INSERT INTO `audittrail` VALUES (1335, '', '188.163.25.86', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-10-30 01:03:29');
INSERT INTO `audittrail` VALUES (1336, '', '31.184.238.13', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-10-30 15:51:41');
INSERT INTO `audittrail` VALUES (1337, '', '31.184.238.33', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-10-30 15:56:13');
INSERT INTO `audittrail` VALUES (1338, '', '173.255.233.124', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-10-31 08:25:15');
INSERT INTO `audittrail` VALUES (1339, '', '208.115.113.87', 'http://guardsecure.newwavetech.co.ug/core/reminders.php', '2012-10-31 08:30:53');
INSERT INTO `audittrail` VALUES (1340, '', '174.139.177.114', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-10-31 10:46:10');
INSERT INTO `audittrail` VALUES (1341, '', '174.139.177.114', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-10-31 10:46:11');
INSERT INTO `audittrail` VALUES (1342, '', '188.92.75.82', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-10-31 22:50:45');
INSERT INTO `audittrail` VALUES (1343, '', '220.181.108.120', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-11-01 05:58:03');
INSERT INTO `audittrail` VALUES (1344, '', '173.199.120.83', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-11-02 01:25:11');
INSERT INTO `audittrail` VALUES (1345, '', '173.199.119.19', 'http://guardsecure.newwavetech.co.ug/core/favorites.php', '2012-11-02 06:22:13');
INSERT INTO `audittrail` VALUES (1346, '', '174.139.177.114', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-11-02 07:14:41');
INSERT INTO `audittrail` VALUES (1347, '', '174.139.177.114', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-11-02 07:14:42');
INSERT INTO `audittrail` VALUES (1348, '', '173.199.120.67', 'http://guardsecure.newwavetech.co.ug/core/reminders.php', '2012-11-02 10:44:47');
INSERT INTO `audittrail` VALUES (1349, '', '173.199.119.19', 'http://guardsecure.newwavetech.co.ug/core/viewuser.php?id=', '2012-11-02 11:59:47');
INSERT INTO `audittrail` VALUES (1350, '', '173.199.115.115', 'http://guardsecure.newwavetech.co.ug/settings/index.php', '2012-11-02 14:29:42');
INSERT INTO `audittrail` VALUES (1351, '', '173.199.119.51', 'http://guardsecure.newwavetech.co.ug/settings/settings.php', '2012-11-02 15:44:46');
INSERT INTO `audittrail` VALUES (1352, '', '208.115.111.71', 'http://guardsecure.newwavetech.co.ug/core/viewuser.php?id=', '2012-11-03 03:12:46');
INSERT INTO `audittrail` VALUES (1353, '', '94.27.112.76', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-11-03 04:20:31');
INSERT INTO `audittrail` VALUES (1354, '', '94.27.112.76', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-11-03 04:20:32');
INSERT INTO `audittrail` VALUES (1355, '', '208.115.111.71', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-11-03 05:43:40');
INSERT INTO `audittrail` VALUES (1356, '', '173.199.120.83', 'http://guardsecure.newwavetech.co.ug/core/user.php?id=&action=edit', '2012-11-03 07:22:33');
INSERT INTO `audittrail` VALUES (1357, '', '174.139.177.114', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-11-03 08:13:49');
INSERT INTO `audittrail` VALUES (1358, '', '174.139.177.114', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-11-03 08:13:51');
INSERT INTO `audittrail` VALUES (1359, '', '141.105.120.152', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-11-03 09:06:31');
INSERT INTO `audittrail` VALUES (1360, '', '96.57.191.220', 'http://guardsecure.newwavetech.co.ug/settings/index.php', '2012-11-04 05:26:43');
INSERT INTO `audittrail` VALUES (1361, '', '96.57.191.220', 'http://guardsecure.newwavetech.co.ug/settings/index.php', '2012-11-04 05:26:44');
INSERT INTO `audittrail` VALUES (1362, '', '96.57.191.220', 'http://guardsecure.newwavetech.co.ug/settings/index.php', '2012-11-04 05:26:44');
INSERT INTO `audittrail` VALUES (1363, '', '96.57.191.220', 'http://guardsecure.newwavetech.co.ug/core/viewuser.php?id=', '2012-11-04 05:26:45');
INSERT INTO `audittrail` VALUES (1364, '', '96.57.191.220', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-11-04 05:26:46');
INSERT INTO `audittrail` VALUES (1365, '', '96.57.191.220', 'http://guardsecure.newwavetech.co.ug/settings/settings.php', '2012-11-04 05:26:46');
INSERT INTO `audittrail` VALUES (1366, '', '178.137.84.8', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-11-04 10:21:34');
INSERT INTO `audittrail` VALUES (1367, '', '178.137.84.8', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-11-04 10:21:37');
INSERT INTO `audittrail` VALUES (1368, '', '184.154.100.11', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-11-04 15:09:21');
INSERT INTO `audittrail` VALUES (1369, '', '184.154.100.11', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-11-04 15:09:21');
INSERT INTO `audittrail` VALUES (1370, '', '176.195.160.15', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-11-04 15:57:45');
INSERT INTO `audittrail` VALUES (1371, '', '176.195.160.15', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-11-04 15:57:46');
INSERT INTO `audittrail` VALUES (1372, '', '31.184.238.33', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-11-04 18:21:46');
INSERT INTO `audittrail` VALUES (1373, '', '31.184.238.33', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-11-04 18:21:46');
INSERT INTO `audittrail` VALUES (1374, '', '31.184.238.13', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-11-05 00:16:37');
INSERT INTO `audittrail` VALUES (1375, '', '31.184.238.13', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-11-05 00:16:38');
INSERT INTO `audittrail` VALUES (1376, '', '208.115.111.71', 'http://guardsecure.newwavetech.co.ug/settings/settings.php', '2012-11-05 10:00:08');
INSERT INTO `audittrail` VALUES (1377, '', '208.115.111.71', 'http://guardsecure.newwavetech.co.ug/settings/index.php', '2012-11-05 13:41:56');
INSERT INTO `audittrail` VALUES (1378, '', '197.221.148.1', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-11-06 04:44:53');
INSERT INTO `audittrail` VALUES (1379, '', '212.88.100.196', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-11-06 16:20:39');
INSERT INTO `audittrail` VALUES (1380, '', '100.43.83.145', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-11-06 16:35:16');
INSERT INTO `audittrail` VALUES (1381, '', '188.143.232.70', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-11-06 23:50:24');
INSERT INTO `audittrail` VALUES (1382, '', '188.143.232.70', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-11-06 23:50:26');
INSERT INTO `audittrail` VALUES (1383, '', '66.249.73.210', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-11-07 06:16:32');
INSERT INTO `audittrail` VALUES (1384, '', '66.249.73.210', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-11-07 06:21:35');
INSERT INTO `audittrail` VALUES (1385, '', '195.229.241.172', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-11-07 17:03:12');
INSERT INTO `audittrail` VALUES (1386, '', '95.79.138.25', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-11-07 23:48:10');
INSERT INTO `audittrail` VALUES (1387, '', '14.146.81.40', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-11-08 03:31:28');
INSERT INTO `audittrail` VALUES (1388, '', '78.158.5.214', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-11-08 09:39:54');
INSERT INTO `audittrail` VALUES (1389, '', '78.158.5.214', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-11-08 09:39:55');
INSERT INTO `audittrail` VALUES (1390, '', '157.55.32.153', 'http://guardsecure.newwavetech.co.ug/core/reminders.php', '2012-11-08 15:55:37');
INSERT INTO `audittrail` VALUES (1391, '', '157.55.32.164', 'http://guardsecure.newwavetech.co.ug/core/viewuser.php?id=', '2012-11-08 15:55:40');
INSERT INTO `audittrail` VALUES (1392, '', '157.55.35.98', 'http://guardsecure.newwavetech.co.ug/core/reminders.php', '2012-11-08 16:50:54');
INSERT INTO `audittrail` VALUES (1393, '', '173.242.118.223', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-11-08 23:19:56');
INSERT INTO `audittrail` VALUES (1394, '', '5.167.182.32', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-11-09 01:01:41');
INSERT INTO `audittrail` VALUES (1395, '', '174.139.177.114', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-11-09 06:22:18');
INSERT INTO `audittrail` VALUES (1396, '', '174.139.177.114', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-11-09 06:22:21');
INSERT INTO `audittrail` VALUES (1397, '', '180.76.5.158', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-11-09 14:16:15');
INSERT INTO `audittrail` VALUES (1398, '', '173.242.118.223', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-11-09 19:14:38');
INSERT INTO `audittrail` VALUES (1399, '', '89.76.14.166', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-11-09 21:16:27');
INSERT INTO `audittrail` VALUES (1400, '', '89.76.14.166', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-11-09 21:16:28');
INSERT INTO `audittrail` VALUES (1401, '', '89.76.14.166', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-11-09 21:17:08');
INSERT INTO `audittrail` VALUES (1402, '', '89.76.14.166', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-11-09 21:17:09');
INSERT INTO `audittrail` VALUES (1403, '', '157.55.32.77', 'http://guardsecure.newwavetech.co.ug/core/favorites.php', '2012-11-10 08:00:16');
INSERT INTO `audittrail` VALUES (1404, '', '157.55.34.180', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-11-10 08:00:48');
INSERT INTO `audittrail` VALUES (1405, '', '31.184.238.13', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-11-11 01:57:19');
INSERT INTO `audittrail` VALUES (1406, '', '31.184.238.33', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-11-11 05:32:31');
INSERT INTO `audittrail` VALUES (1407, '', '208.115.111.71', 'http://guardsecure.newwavetech.co.ug/core/favorites.php', '2012-11-12 02:19:37');
INSERT INTO `audittrail` VALUES (1408, '', '174.139.177.114', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-11-12 13:59:36');
INSERT INTO `audittrail` VALUES (1409, '', '174.139.177.114', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-11-12 13:59:38');
INSERT INTO `audittrail` VALUES (1410, '', '188.92.75.82', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-11-13 16:33:50');
INSERT INTO `audittrail` VALUES (1411, '', '46.119.34.11', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-11-14 10:35:28');
INSERT INTO `audittrail` VALUES (1412, '', '176.8.88.206', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-11-14 14:07:18');
INSERT INTO `audittrail` VALUES (1413, '', '176.8.88.206', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-11-14 14:07:19');
INSERT INTO `audittrail` VALUES (1414, '', '31.184.238.33', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-11-14 23:48:43');
INSERT INTO `audittrail` VALUES (1415, '', '91.223.75.11', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-11-15 06:17:38');
INSERT INTO `audittrail` VALUES (1416, '', '91.223.75.11', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-11-15 06:17:39');
INSERT INTO `audittrail` VALUES (1417, '', '178.255.215.79', 'http://guardsecure.newwavetech.co.ug/core/viewuser.php?id=', '2012-11-15 20:31:10');
INSERT INTO `audittrail` VALUES (1418, '', '208.115.113.87', 'http://guardsecure.newwavetech.co.ug/core/reminders.php', '2012-11-16 07:27:42');
INSERT INTO `audittrail` VALUES (1419, '', '31.184.238.13', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-11-16 21:27:33');
INSERT INTO `audittrail` VALUES (1420, '', '5.167.179.131', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-11-17 03:00:45');
INSERT INTO `audittrail` VALUES (1421, '', '31.184.238.33', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-11-17 03:20:37');
INSERT INTO `audittrail` VALUES (1422, '', '78.30.200.81', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-11-17 12:20:46');
INSERT INTO `audittrail` VALUES (1423, '', '188.143.232.211', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-11-17 12:30:20');
INSERT INTO `audittrail` VALUES (1424, '', '77.78.104.141', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-11-17 12:32:17');
INSERT INTO `audittrail` VALUES (1425, '', '85.195.101.146', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-11-17 16:22:47');
INSERT INTO `audittrail` VALUES (1426, '', '5.167.179.131', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-11-18 04:57:37');
INSERT INTO `audittrail` VALUES (1427, '', '208.115.111.71', 'http://guardsecure.newwavetech.co.ug/core/viewuser.php?id=', '2012-11-18 13:34:41');
INSERT INTO `audittrail` VALUES (1428, '', '208.115.111.71', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-11-18 17:39:09');
INSERT INTO `audittrail` VALUES (1429, '', '31.184.238.33', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-11-18 22:37:23');
INSERT INTO `audittrail` VALUES (1430, '', '31.184.238.13', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-11-19 00:09:14');
INSERT INTO `audittrail` VALUES (1431, '', '41.202.240.11', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-11-19 02:30:38');
INSERT INTO `audittrail` VALUES (1432, '', '66.249.76.61', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-11-20 01:05:16');
INSERT INTO `audittrail` VALUES (1433, '', '66.249.76.61', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-11-20 01:15:01');
INSERT INTO `audittrail` VALUES (1434, '', '95.67.106.110', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-11-20 15:30:44');
INSERT INTO `audittrail` VALUES (1435, '', '208.115.111.71', 'http://guardsecure.newwavetech.co.ug/settings/settings.php', '2012-11-20 21:24:58');
INSERT INTO `audittrail` VALUES (1436, '', '46.119.39.130', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-11-21 00:53:59');
INSERT INTO `audittrail` VALUES (1437, '', '208.115.111.71', 'http://guardsecure.newwavetech.co.ug/settings/index.php', '2012-11-21 01:30:32');
INSERT INTO `audittrail` VALUES (1438, '', '220.181.108.146', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-11-22 09:06:01');
INSERT INTO `audittrail` VALUES (1439, '', '220.181.108.85', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-11-22 12:08:43');
INSERT INTO `audittrail` VALUES (1440, '', '220.181.108.180', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-11-22 15:07:25');
INSERT INTO `audittrail` VALUES (1441, '', '220.181.108.183', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-11-22 18:08:04');
INSERT INTO `audittrail` VALUES (1442, '', '31.184.238.33', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-11-23 01:45:42');
INSERT INTO `audittrail` VALUES (1443, '', '180.76.5.96', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-11-23 13:55:12');
INSERT INTO `audittrail` VALUES (1444, '', '180.76.5.113', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-11-25 00:46:32');
INSERT INTO `audittrail` VALUES (1445, '', '173.199.114.99', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-11-25 10:57:49');
INSERT INTO `audittrail` VALUES (1446, '', '208.115.113.87', 'http://guardsecure.newwavetech.co.ug/core/user.php?id=&action=edit', '2012-11-25 19:33:06');
INSERT INTO `audittrail` VALUES (1447, '', '212.88.100.196', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-11-26 07:33:45');
INSERT INTO `audittrail` VALUES (1448, '', '66.249.74.154', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-11-26 17:04:34');
INSERT INTO `audittrail` VALUES (1449, '', '78.30.200.81', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-11-26 17:23:39');
INSERT INTO `audittrail` VALUES (1450, '', '188.143.232.31', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-11-27 03:39:13');
INSERT INTO `audittrail` VALUES (1451, '', '208.115.111.71', 'http://guardsecure.newwavetech.co.ug/core/favorites.php', '2012-11-27 05:43:07');
INSERT INTO `audittrail` VALUES (1452, '', '31.184.238.13', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-11-27 19:11:20');
INSERT INTO `audittrail` VALUES (1453, '', '212.117.172.80', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-11-27 21:55:36');
INSERT INTO `audittrail` VALUES (1454, '', '31.184.238.33', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-11-27 23:30:11');
INSERT INTO `audittrail` VALUES (1455, '', '173.199.114.179', 'http://guardsecure.newwavetech.co.ug/core/favorites.php', '2012-11-28 08:40:29');
INSERT INTO `audittrail` VALUES (1456, '', '173.199.120.99', 'http://guardsecure.newwavetech.co.ug/core/reminders.php', '2012-11-28 13:10:29');
INSERT INTO `audittrail` VALUES (1457, '', '173.199.118.35', 'http://guardsecure.newwavetech.co.ug/core/viewuser.php?id=', '2012-11-28 14:40:29');
INSERT INTO `audittrail` VALUES (1458, '', '173.199.116.43', 'http://guardsecure.newwavetech.co.ug/settings/index.php', '2012-11-28 17:40:29');
INSERT INTO `audittrail` VALUES (1459, '', '173.199.114.179', 'http://guardsecure.newwavetech.co.ug/settings/settings.php', '2012-11-28 19:10:29');
INSERT INTO `audittrail` VALUES (1460, '', '173.242.126.130', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-11-29 11:16:44');
INSERT INTO `audittrail` VALUES (1461, '', '173.242.126.130', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-11-29 11:16:44');
INSERT INTO `audittrail` VALUES (1462, '', '213.186.127.5', 'http://guardsecure.newwavetech.co.ug/settings/index.php', '2012-11-29 11:55:28');
INSERT INTO `audittrail` VALUES (1463, '', '213.186.119.143', 'http://guardsecure.newwavetech.co.ug/settings/settings.php', '2012-11-29 14:10:27');
INSERT INTO `audittrail` VALUES (1464, '', '94.45.177.109', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-11-30 18:21:44');
INSERT INTO `audittrail` VALUES (1465, '', '94.45.177.109', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-11-30 18:21:45');
INSERT INTO `audittrail` VALUES (1466, '', '173.199.119.27', 'http://guardsecure.newwavetech.co.ug/core/user.php?id=&action=edit', '2012-11-30 21:45:45');
INSERT INTO `audittrail` VALUES (1467, '', '176.195.173.9', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-12-01 06:13:04');
INSERT INTO `audittrail` VALUES (1468, '', '176.195.173.9', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-12-01 06:13:05');
INSERT INTO `audittrail` VALUES (1469, '', '178.255.215.79', 'http://guardsecure.newwavetech.co.ug/settings/settings.php', '2012-12-01 12:18:13');
INSERT INTO `audittrail` VALUES (1470, '', '178.255.215.79', 'http://guardsecure.newwavetech.co.ug/core/user.php?id=&action=edit', '2012-12-01 12:45:27');
INSERT INTO `audittrail` VALUES (1471, '', '208.115.113.87', 'http://guardsecure.newwavetech.co.ug/core/reminders.php', '2012-12-01 18:50:01');
INSERT INTO `audittrail` VALUES (1472, '', '220.181.108.180', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-12-02 00:22:28');
INSERT INTO `audittrail` VALUES (1473, '', '213.186.127.10', 'http://guardsecure.newwavetech.co.ug/core/reminders.php', '2012-12-02 01:49:47');
INSERT INTO `audittrail` VALUES (1474, '', '213.186.119.135', 'http://guardsecure.newwavetech.co.ug/core/user.php?id=&action=edit', '2012-12-02 05:11:14');
INSERT INTO `audittrail` VALUES (1475, '', '176.195.177.88', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-12-02 06:44:45');
INSERT INTO `audittrail` VALUES (1476, '', '176.195.177.88', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-12-02 06:44:46');
INSERT INTO `audittrail` VALUES (1477, '', '213.186.127.14', 'http://guardsecure.newwavetech.co.ug/core/viewuser.php?id=', '2012-12-02 07:25:29');
INSERT INTO `audittrail` VALUES (1478, '', '188.163.29.155', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-12-02 15:28:19');
INSERT INTO `audittrail` VALUES (1479, '', '220.181.108.77', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-12-02 20:02:37');
INSERT INTO `audittrail` VALUES (1480, '', '66.249.73.210', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-12-03 11:34:41');
INSERT INTO `audittrail` VALUES (1481, '', '208.115.111.71', 'http://guardsecure.newwavetech.co.ug/core/viewuser.php?id=', '2012-12-04 04:37:05');
INSERT INTO `audittrail` VALUES (1482, '', '37.113.31.145', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-12-04 06:30:46');
INSERT INTO `audittrail` VALUES (1483, '', '213.144.132.98', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-12-04 06:52:54');
INSERT INTO `audittrail` VALUES (1484, '', '188.92.75.244', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-12-04 08:00:16');
INSERT INTO `audittrail` VALUES (1485, '', '188.92.75.244', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-12-04 08:00:17');
INSERT INTO `audittrail` VALUES (1486, '', '91.201.64.225', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-12-04 08:06:51');
INSERT INTO `audittrail` VALUES (1487, '', '91.201.64.225', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-12-04 08:06:52');
INSERT INTO `audittrail` VALUES (1488, '', '208.115.111.71', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-12-04 09:33:42');
INSERT INTO `audittrail` VALUES (1489, '', '69.84.207.246', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-12-04 17:55:57');
INSERT INTO `audittrail` VALUES (1490, '', '69.84.207.246', 'http://guardsecure.newwavetech.co.ug/core/favorites.php', '2012-12-04 17:55:57');
INSERT INTO `audittrail` VALUES (1491, '', '69.84.207.246', 'http://guardsecure.newwavetech.co.ug/settings/index.php', '2012-12-04 17:55:58');
INSERT INTO `audittrail` VALUES (1492, '', '69.84.207.246', 'http://guardsecure.newwavetech.co.ug/core/reminders.php', '2012-12-04 17:55:58');
INSERT INTO `audittrail` VALUES (1493, '', '69.84.207.246', 'http://guardsecure.newwavetech.co.ug/core/viewuser.php?id=', '2012-12-04 17:55:58');
INSERT INTO `audittrail` VALUES (1494, '', '69.84.207.246', 'http://guardsecure.newwavetech.co.ug/settings/settings.php', '2012-12-04 17:55:59');
INSERT INTO `audittrail` VALUES (1495, '', '71.176.122.162', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-12-04 18:33:52');
INSERT INTO `audittrail` VALUES (1496, '', '196.0.21.52', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-12-06 11:55:49');
INSERT INTO `audittrail` VALUES (1497, 'admin', '196.0.21.52', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-12-06 11:57:20');
INSERT INTO `audittrail` VALUES (1498, '', '208.115.111.71', 'http://guardsecure.newwavetech.co.ug/settings/settings.php', '2012-12-06 13:28:11');
INSERT INTO `audittrail` VALUES (1499, '', '208.115.111.71', 'http://guardsecure.newwavetech.co.ug/settings/index.php', '2012-12-06 17:29:23');
INSERT INTO `audittrail` VALUES (1500, '', '100.43.83.145', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-12-06 21:28:32');
INSERT INTO `audittrail` VALUES (1501, '', '76.73.3.18', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-12-09 18:48:39');
INSERT INTO `audittrail` VALUES (1502, '', '60.28.240.123', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-12-09 21:24:16');
INSERT INTO `audittrail` VALUES (1503, '', '60.28.240.123', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-12-09 21:24:17');
INSERT INTO `audittrail` VALUES (1504, '', '60.28.240.123', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php/index.php', '2012-12-09 21:24:19');
INSERT INTO `audittrail` VALUES (1505, '', '196.0.21.52', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-12-10 02:49:29');
INSERT INTO `audittrail` VALUES (1506, '', '46.119.124.206', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-12-10 05:09:52');
INSERT INTO `audittrail` VALUES (1507, '', '46.119.124.206', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-12-10 05:09:52');
INSERT INTO `audittrail` VALUES (1508, '', '180.76.5.137', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-12-10 18:49:36');
INSERT INTO `audittrail` VALUES (1509, '', '208.115.113.87', 'http://guardsecure.newwavetech.co.ug/core/user.php?id=&action=edit', '2012-12-11 07:31:43');
INSERT INTO `audittrail` VALUES (1510, '', '173.199.120.51', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-12-11 14:13:44');
INSERT INTO `audittrail` VALUES (1511, '', '180.76.5.137', 'http://guardsecure.newwavetech.co.ug/core/dashboard.php', '2012-12-11 18:11:01');
INSERT INTO `audittrail` VALUES (1512, '', '77.78.104.141', 'http://guardsecure.newwavetech.co.ug/core/favorites.php', '2012-12-12 02:58:19');
INSERT INTO `audittrail` VALUES (1513, '', '77.78.104.141', 'http://guardsecure.newwavetech.co.ug/core/viewuser.php?id=', '2012-12-12 02:58:21');
INSERT INTO `audittrail` VALUES (1514, '', '77.78.104.141', 'http://guardsecure.newwavetech.co.ug/core/reminders.php', '2012-12-12 02:58:24');
INSERT INTO `audittrail` VALUES (1515, '', '77.78.104.141', 'http://guardsecure.newwavetech.co.ug/settings/settings.php', '2012-12-12 02:58:26');
INSERT INTO `audittrail` VALUES (1516, '', '77.78.104.141', 'http://guardsecure.newwavetech.co.ug/settings/index.php', '2012-12-12 02:58:28');

-- --------------------------------------------------------

-- 
-- Table structure for table `categories`
-- 

CREATE TABLE `categories` (
  `id` bigint(20) NOT NULL auto_increment,
  `category` varchar(100) NOT NULL default '',
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

-- 
-- Dumping data for table `categories`
-- 

INSERT INTO `categories` VALUES (1, 'Guns');
INSERT INTO `categories` VALUES (2, 'Uniforms');
INSERT INTO `categories` VALUES (3, 'Vehicles');
INSERT INTO `categories` VALUES (4, 'Others');

-- --------------------------------------------------------

-- 
-- Table structure for table `children`
-- 

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
) ENGINE=InnoDB AUTO_INCREMENT=85 DEFAULT CHARSET=latin1 AUTO_INCREMENT=85 ;

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
INSERT INTO `children` VALUES (74, 'felix', 'Kent', 'Umer', 'F', '10', 1, '2007-11-09 10:09:52', 1, '2008-07-16 15:01:27');
INSERT INTO `children` VALUES (75, 'Dean', 'Tish', 'Innocent', 'F', '65', 1, '2007-11-09 10:09:53', 1, '2008-07-16 15:01:27');
INSERT INTO `children` VALUES (76, 'John Peters', 'I Think', 'Peterson', 'M', '23', 1, '2007-11-09 10:17:24', 1, '2008-07-16 15:01:27');
INSERT INTO `children` VALUES (77, 'Jinja', 'Hunt', '', 'F', '10', 1, '2007-11-09 10:18:17', 1, '2008-07-16 15:01:27');
INSERT INTO `children` VALUES (78, 'Feroz', 'Johns', 'Hopkins', 'M', '12', 1, '2007-11-14 09:28:19', 1, '2008-02-12 17:44:10');
INSERT INTO `children` VALUES (79, 'Hint', 'Jina', 'Tina', 'F', '10', 1, '2007-11-14 09:28:19', 1, '2008-02-12 17:44:10');
INSERT INTO `children` VALUES (80, 'Torry', 'Johns', 'ziwa', 'M', '9', 1, '2007-11-14 09:28:19', 1, '2008-02-12 17:44:10');
INSERT INTO `children` VALUES (81, 'Mary', 'Ogong', '', 'F', '1', 1, '2007-11-20 10:27:42', 1, '2008-07-16 15:01:27');
INSERT INTO `children` VALUES (82, 'Awoja', 'Tracy', 'Winfred', 'F', '7', 1, '2008-03-12 10:11:16', 1, '2008-04-01 11:39:05');
INSERT INTO `children` VALUES (83, 'Marion', 'Mukasa', '', 'M', '7', 1, '2008-04-14 19:32:33', 1, '2008-04-14 20:22:07');
INSERT INTO `children` VALUES (84, 'Sheba', 'Kabisa', 'Juno', 'F', '2', 1, '2008-04-14 19:32:33', 1, '2008-04-14 20:22:07');

-- --------------------------------------------------------

-- 
-- Table structure for table `clients`
-- 

CREATE TABLE `clients` (
  `id` bigint(20) NOT NULL auto_increment,
  `name` varchar(255) default NULL,
  `plotno` varchar(255) default NULL,
  `boxno` varchar(255) default NULL,
  `floorno` varchar(20) default NULL,
  `genphone` varchar(250) NOT NULL default '0',
  `contname` varchar(250) NOT NULL default '',
  `contposition` varchar(250) NOT NULL default '',
  `contphone` bigint(20) NOT NULL default '0',
  `fax` varchar(50) NOT NULL default '',
  `email` varchar(255) default NULL,
  `isactive` enum('Y','N') NOT NULL default 'Y',
  `datecreated` varchar(255) default NULL,
  `createdby` bigint(20) default NULL,
  `lastupdatedby` bigint(20) default NULL,
  `lastupdatedate` timestamp NULL default NULL on update CURRENT_TIMESTAMP,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=32 DEFAULT CHARSET=latin1 AUTO_INCREMENT=32 ;

-- 
-- Dumping data for table `clients`
-- 

INSERT INTO `clients` VALUES (2, 'Crane Bank', '12', '5473', '12', '76865856', 'seba', 'accountant', 53253245, '25641234543', 'info@cranebank.com', 'Y', '08-01-25', 1, NULL, '2008-02-11 16:16:01');
INSERT INTO `clients` VALUES (4, 'Stanbic Bank', '4141', 'stan@yahoo.com', 'dasdjk', '0414567588', 'Mugoya Frank', 'Administrative Assistant', 774883241, '256414565336', 'mugoya@stanbic.co.ug', 'Y', '08-02-14', 1, NULL, '2008-02-14 10:52:17');
INSERT INTO `clients` VALUES (6, 'Uganda Telecom Ltd', '45, Bombo Road', '4124, Kampala', 'Telephone House', '+256750925298', 'Matama Paul', 'Director General', 256412525597, '+266412525598', 'pmatama@utlonline.co.ug', 'Y', '08-03-18', 1, NULL, '2008-03-18 15:59:03');
INSERT INTO `clients` VALUES (10, 'Fida', '424', '5424', '41541', '441545', '', '', 415, '', 'sam@yahoo.com', 'Y', '07-10-27', 1, NULL, '2008-02-11 16:16:01');
INSERT INTO `clients` VALUES (14, 'Nile Breweries', '2222222', '4525', '5425', '55555555', '', '', 4151, '', 'sampkal@gmail.com', 'Y', '07-10-27', 1, NULL, '2008-02-11 16:15:42');
INSERT INTO `clients` VALUES (15, 'Shark Inc.', '4141', '56666666666', '4151', '4151', '', '', 515415, '', 'sdsa', 'Y', '07-10-27', 1, NULL, '2008-05-06 10:15:19');
INSERT INTO `clients` VALUES (16, 'Kits End International', '3414', '414', '4124', '414', '', '', 54124, '', 'samp@gmail.com', 'Y', '07-10-27', 1, NULL, '2008-02-11 16:15:42');
INSERT INTO `clients` VALUES (18, 'Felix Holdings', '43', '363636', '3', '53242423432', 'Ismael', 'Manager', 23423432, '', 'felix@yahoo.com', 'N', '08-03-18', 1, NULL, '2008-03-18 15:54:41');
INSERT INTO `clients` VALUES (20, 'Zious Holdings Ltd', '12', '1234', 'Floor 3', '256 772890073, 803423444', 'Zious De Mious', 'Chief Purchasing Officer', 256772990, '04145253535', 'alzious@yahoo.co.uk', 'Y', '08-03-26', 1, NULL, '2008-03-26 12:58:28');
INSERT INTO `clients` VALUES (21, 'Ugasa Holdings', 'Plot 23 Jinja Rd.', '124123 Jinja', 'Floor 3, Rm 23', '734563456', 'Kintu Deograsias', 'Chief Security Officer', 4567456745, '23433344', 'ugasa@ugasa.com', 'Y', '08-01-28', 1, NULL, '2008-02-11 16:15:42');
INSERT INTO `clients` VALUES (22, 'Bank of Baroda', 'Plot 28 Kampala Road', '34820', '', '256414344234,256414676553', 'Hassan Mubiru', 'Operations manager', 256772443920, '25641324332', 'hmubiru@baroda.org', 'Y', '08-02-11', 1, NULL, '2008-02-11 15:18:48');
INSERT INTO `clients` VALUES (23, 'Daniel Holdings Ltd', '45 Kampala Road', '45645', '35A 2nd Floor', '056785678, 077465755', 'Kintu John', 'Senior Finannce Manager', 65785678, '0414656561', 'kintu@danielholdings.com', 'Y', '08-04-15', 1, NULL, '2008-04-15 10:50:37');
INSERT INTO `clients` VALUES (24, 'Holdam Ltd.', '56 Kololo Drive', '6345 Kampala', '', '077342343, 0414890804, 4328098034', 'Marion Johnston', 'Procurement Officer', 77324244, '0412412323', 'marion.j@holdam.net', 'N', '08-04-14', 1, NULL, NULL);
INSERT INTO `clients` VALUES (25, 'Kitukilo Holdings', '23 Kampala Rd', '2342 Jinja', 'Floor 2', '0414 678233', 'Felix Peterson', 'Chief Technical Officer', 77121238, '04123332', 'fpeterson@holdings.org', 'Y', '08-05-06', 1, NULL, NULL);
INSERT INTO `clients` VALUES (26, 'TID', '7 Sixth Str Industrial Area', '0888 Kampala', '', '072344234', 'Peter Kintu', 'Head Operations', 77234234, '041423232', 'pkintu@yahoo.co.uk', 'Y', '08-05-06', 1, NULL, NULL);
INSERT INTO `clients` VALUES (27, 'Info Technologies Ltd.', '89 Kintu Rd', '09992 Kampala', 'Floor 3', '', 'Harry Damulira', 'CEO', 77234234, '04123332', '', 'Y', '08-05-06', 1, NULL, '2008-05-06 10:14:04');
INSERT INTO `clients` VALUES (29, 'Garry Johns', '89 Kintu Rd', '09993', '', '', '', '', 0, '', '', '', '08-05-06', 1, NULL, NULL);
INSERT INTO `clients` VALUES (30, 'Hint Ltd', '23', '84567', '', '', '', '', 0, '', '', '', '08-05-06', 1, NULL, NULL);
INSERT INTO `clients` VALUES (31, 'Tallon Holdings Limited', '30 Kintu Rd', '9786 Kampala', '', '0988823,077223123', 'Ronald Musinguzi', 'Manager Security', 70234234, '', 'rmusinguzi@tallonholdings.com', 'Y', '08-05-20', 1, NULL, NULL);

-- --------------------------------------------------------

-- 
-- Table structure for table `commanders`
-- 

CREATE TABLE `commanders` (
  `id` bigint(20) NOT NULL auto_increment,
  `name` varchar(255) NOT NULL default '',
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=latin1 AUTO_INCREMENT=33 ;

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
-- Table structure for table `comments`
-- 

CREATE TABLE `comments` (
  `id` bigint(20) NOT NULL auto_increment,
  `madeby` varchar(250) NOT NULL default '',
  `details` text NOT NULL,
  `location` varchar(250) NOT NULL default '',
  `type` varchar(250) NOT NULL default '',
  `date` datetime NOT NULL default '0000-00-00 00:00:00',
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=93 DEFAULT CHARSET=latin1 AUTO_INCREMENT=93 ;

-- 
-- Dumping data for table `comments`
-- 

INSERT INTO `comments` VALUES (65, 'K903', 'There were too many people at the venue. I couldnt inspect the guard''s work.', 'H312-D', 'Inspection', '2008-05-07 00:00:00');
INSERT INTO `comments` VALUES (71, 'J201', 'Guard doses at work.', 'Crane Bank', 'Inspection', '2008-05-20 00:00:00');
INSERT INTO `comments` VALUES (72, 'J201', 'Tint was poured onto the maid of the house by the guard on duty.', 'Jinja Police Station', 'Inspection', '2008-05-20 00:00:00');
INSERT INTO `comments` VALUES (73, 'J201', 'He lost his cap at the client''s', 'Tank Hill', 'Inspection', '2008-05-19 00:00:00');
INSERT INTO `comments` VALUES (75, 'J201', 'The guard was collected from a dustbin where he was drunk by the client.', 'H312', 'Inspection', '2008-05-19 00:00:00');
INSERT INTO `comments` VALUES (76, 'Zizinga Michael', 'The joiner is worn out and needs replacement.', 'Cruntch', 'Inspection', '2008-06-03 00:00:00');
INSERT INTO `comments` VALUES (77, 'Zixina Michael', 'Micheal broke it during training.', 'Cruntch', 'Inspection', '2008-06-06 00:00:00');
INSERT INTO `comments` VALUES (78, 'Zixina Michael', 'Micheal broke it during training.', 'Cruntch', 'Inspection', '2008-06-06 00:00:00');
INSERT INTO `comments` VALUES (79, 'Zixina Michael', 'It requires repair to the top.', 'Headlight', 'Inspection', '2008-06-03 00:00:00');
INSERT INTO `comments` VALUES (82, 'Joseph Simons', 'Right hand flipper is broken.', 'Flippers', 'Inspection', '2008-06-01 00:00:00');
INSERT INTO `comments` VALUES (83, 'Joseph Simons', 'One of the headlights doesnt light', 'Headlights', 'Inspection', '2008-06-01 00:00:00');
INSERT INTO `comments` VALUES (84, 'Tinka Godfrey Meyers', 'It required more than one tap to light.', 'Chiller lights', 'Inspection', '2008-02-16 00:00:00');
INSERT INTO `comments` VALUES (85, 'Charles Meyers', 'The bucket is leaking oil.', 'Folarns Bucket', 'Inspection', '2008-02-02 00:00:00');
INSERT INTO `comments` VALUES (86, 'Solomon Meyers', 'They are worn out.', 'Back Tyres', 'Inspection', '2008-02-02 00:00:00');
INSERT INTO `comments` VALUES (87, 'Solomon Meyers', 'THey are broken', 'Head lamps', 'Inspection', '2008-02-02 00:00:00');
INSERT INTO `comments` VALUES (88, 'Solomon Meyers', 'It no longer closes', 'Glover Box', 'Inspection', '2008-02-02 00:00:00');
INSERT INTO `comments` VALUES (89, 'Solomon Meyers', 'It requires repair together with cleaning.', 'Bonnet', 'Inspection', '2008-02-02 00:00:00');
INSERT INTO `comments` VALUES (90, 'Solomon Meyers', 'It requires re-painting.', 'Bonnet', 'Inspection', '2008-02-02 00:00:00');
INSERT INTO `comments` VALUES (91, 'Solomon Meyers', 'It broke during a response to alarm on Netherlands Embassy', 'Car Wheel', 'Inspection', '2008-02-02 00:00:00');
INSERT INTO `comments` VALUES (92, 'Felix peterson', 'It needs new polish and spare parts.', 'Cabin top', 'Inspection', '2008-03-01 00:00:00');

-- --------------------------------------------------------

-- 
-- Table structure for table `complaints`
-- 

CREATE TABLE `complaints` (
  `id` bigint(20) NOT NULL auto_increment,
  `details` text NOT NULL,
  `madeby` varchar(250) NOT NULL default '',
  `callsign` varchar(250) NOT NULL default '',
  `contactphone` varchar(250) NOT NULL default '',
  `isactive` enum('Y','N') NOT NULL default 'Y',
  `madeon` datetime NOT NULL default '0000-00-00 00:00:00',
  `type` varchar(150) NOT NULL default '',
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- 
-- Dumping data for table `complaints`
-- 


-- --------------------------------------------------------

-- 
-- Table structure for table `department`
-- 

CREATE TABLE `department` (
  `id` bigint(20) NOT NULL auto_increment,
  `departmentname` varchar(250) NOT NULL default '',
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

-- 
-- Dumping data for table `department`
-- 

INSERT INTO `department` VALUES (1, 'Human Resource');
INSERT INTO `department` VALUES (2, 'Finance');
INSERT INTO `department` VALUES (3, 'Operations');
INSERT INTO `department` VALUES (4, 'Administration');

-- --------------------------------------------------------

-- 
-- Table structure for table `district`
-- 

CREATE TABLE `district` (
  `id` bigint(20) NOT NULL auto_increment,
  `district` varchar(250) NOT NULL default '',
  `date_of_entry` datetime NOT NULL default '0000-00-00 00:00:00',
  `lastupdatedby` bigint(20) NOT NULL default '0',
  `lastupdatedate` datetime NOT NULL default '0000-00-00 00:00:00',
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=latin1 AUTO_INCREMENT=16 ;

-- 
-- Dumping data for table `district`
-- 

INSERT INTO `district` VALUES (1, 'Kabong', '2007-10-25 12:02:28', 0, '0000-00-00 00:00:00');
INSERT INTO `district` VALUES (2, 'kampala', '2007-10-25 13:33:53', 0, '0000-00-00 00:00:00');
INSERT INTO `district` VALUES (9, 'Kintu Rd Bridge', '2007-10-25 14:46:59', 0, '0000-00-00 00:00:00');
INSERT INTO `district` VALUES (11, 'Mpigi', '2007-10-27 14:50:15', 0, '0000-00-00 00:00:00');
INSERT INTO `district` VALUES (12, 'Kamuli', '2007-11-15 11:46:16', 0, '0000-00-00 00:00:00');
INSERT INTO `district` VALUES (13, 'Masaka', '2007-12-13 15:13:07', 0, '0000-00-00 00:00:00');
INSERT INTO `district` VALUES (14, 'Gulu', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00');
INSERT INTO `district` VALUES (15, 'Kabale', '2008-03-17 12:01:36', 0, '0000-00-00 00:00:00');

-- --------------------------------------------------------

-- 
-- Table structure for table `documents`
-- 

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
) ENGINE=InnoDB AUTO_INCREMENT=34 DEFAULT CHARSET=latin1 COMMENT='InnoDB free: 4096 kB; InnoDB free: 4096 kB; InnoDB free: 409' AUTO_INCREMENT=34 ;

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

CREATE TABLE `employers` (
  `id` bigint(20) NOT NULL auto_increment,
  `name` varchar(250) NOT NULL default '',
  `telephone` varchar(100) NOT NULL default '',
  `physicaladdress` varchar(250) NOT NULL default '',
  `position` varchar(250) NOT NULL default '',
  `startdate` varchar(40) NOT NULL default '',
  `enddate` varchar(40) NOT NULL default '',
  `createdby` bigint(20) NOT NULL default '0',
  `date_of_entry` datetime NOT NULL default '0000-00-00 00:00:00',
  `lastupdatedby` bigint(20) NOT NULL default '0',
  `lastupdatedate` datetime NOT NULL default '0000-00-00 00:00:00',
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=113 DEFAULT CHARSET=latin1 AUTO_INCREMENT=113 ;

-- 
-- Dumping data for table `employers`
-- 

INSERT INTO `employers` VALUES (1, '', '', '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, '2007-10-29 08:59:02', 0, '0000-00-00 00:00:00');
INSERT INTO `employers` VALUES (2, '', '', '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, '2007-10-29 08:59:30', 0, '0000-00-00 00:00:00');
INSERT INTO `employers` VALUES (3, '', '', '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, '2007-10-29 09:01:39', 0, '0000-00-00 00:00:00');
INSERT INTO `employers` VALUES (4, '', '', '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, '2007-10-29 09:05:35', 0, '0000-00-00 00:00:00');
INSERT INTO `employers` VALUES (5, '', '', '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, '2007-10-29 09:11:22', 0, '0000-00-00 00:00:00');
INSERT INTO `employers` VALUES (6, '', '', '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, '2007-10-29 09:17:16', 0, '0000-00-00 00:00:00');
INSERT INTO `employers` VALUES (7, '', '', '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, '2007-10-29 09:19:35', 0, '0000-00-00 00:00:00');
INSERT INTO `employers` VALUES (8, '', '', '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, '2007-10-29 09:25:22', 0, '0000-00-00 00:00:00');
INSERT INTO `employers` VALUES (9, '', '', '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, '2007-10-29 09:28:32', 0, '0000-00-00 00:00:00');
INSERT INTO `employers` VALUES (10, '', '', '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, '2007-10-29 09:31:30', 0, '0000-00-00 00:00:00');
INSERT INTO `employers` VALUES (11, '', '', '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, '2007-10-29 09:36:03', 0, '0000-00-00 00:00:00');
INSERT INTO `employers` VALUES (12, '', '', '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, '2007-10-29 09:38:26', 0, '0000-00-00 00:00:00');
INSERT INTO `employers` VALUES (13, '', '', '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, '2007-10-29 09:38:58', 0, '0000-00-00 00:00:00');
INSERT INTO `employers` VALUES (14, '', '', '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, '2007-10-29 09:40:52', 0, '0000-00-00 00:00:00');
INSERT INTO `employers` VALUES (15, '', '', '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, '2007-10-29 09:45:18', 0, '0000-00-00 00:00:00');
INSERT INTO `employers` VALUES (16, '', '', '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, '2007-10-29 09:46:23', 0, '0000-00-00 00:00:00');
INSERT INTO `employers` VALUES (17, '', '', '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, '2007-10-29 09:47:57', 0, '0000-00-00 00:00:00');
INSERT INTO `employers` VALUES (18, '', '', '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, '2007-10-29 09:49:22', 0, '0000-00-00 00:00:00');
INSERT INTO `employers` VALUES (19, '', '', '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, '2007-10-29 09:51:56', 0, '0000-00-00 00:00:00');
INSERT INTO `employers` VALUES (20, '', '', '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, '2007-10-29 09:52:40', 0, '0000-00-00 00:00:00');
INSERT INTO `employers` VALUES (21, '', '', '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, '2007-10-29 10:36:07', 0, '0000-00-00 00:00:00');
INSERT INTO `employers` VALUES (22, '', '', '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, '2007-10-29 10:39:53', 0, '0000-00-00 00:00:00');
INSERT INTO `employers` VALUES (23, '', '', '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, '2007-10-29 10:43:45', 0, '0000-00-00 00:00:00');
INSERT INTO `employers` VALUES (24, '', '', '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, '2007-10-29 13:14:54', 0, '0000-00-00 00:00:00');
INSERT INTO `employers` VALUES (25, '', '', '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, '2007-10-29 13:18:54', 0, '0000-00-00 00:00:00');
INSERT INTO `employers` VALUES (26, '', '', '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, '2007-10-29 13:21:56', 0, '0000-00-00 00:00:00');
INSERT INTO `employers` VALUES (27, '', '', '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, '2007-10-29 13:23:25', 0, '0000-00-00 00:00:00');
INSERT INTO `employers` VALUES (28, '', '', '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, '2007-10-29 13:25:09', 0, '0000-00-00 00:00:00');
INSERT INTO `employers` VALUES (29, '', '', '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, '2007-10-29 13:56:42', 0, '0000-00-00 00:00:00');
INSERT INTO `employers` VALUES (30, '', '', '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, '2007-10-29 14:08:49', 0, '0000-00-00 00:00:00');
INSERT INTO `employers` VALUES (31, '', '', '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, '2007-10-29 14:11:43', 0, '0000-00-00 00:00:00');
INSERT INTO `employers` VALUES (32, '', '', '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, '2007-10-29 14:19:57', 0, '0000-00-00 00:00:00');
INSERT INTO `employers` VALUES (33, '', '', '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, '2007-10-29 14:21:04', 0, '0000-00-00 00:00:00');
INSERT INTO `employers` VALUES (34, '', '', '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, '2007-10-29 14:32:28', 0, '0000-00-00 00:00:00');
INSERT INTO `employers` VALUES (35, 'Saracen Limited', '434123213', 'Plot 34 Katong Hill', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, '2007-10-29 14:51:12', 0, '0000-00-00 00:00:00');
INSERT INTO `employers` VALUES (36, 'Saracen Limited', '434123213', 'Plot 34 Katong Hill', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, '2007-10-29 14:52:57', 0, '0000-00-00 00:00:00');
INSERT INTO `employers` VALUES (37, 'Saracen Limited', '434123213', 'Plot 34 Katong Hill', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, '2007-10-29 14:55:00', 0, '0000-00-00 00:00:00');
INSERT INTO `employers` VALUES (38, 'Saracen Limited', '434123213', 'Plot 34 Katong Hill', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, '2007-10-29 14:56:42', 0, '0000-00-00 00:00:00');
INSERT INTO `employers` VALUES (39, 'Saracen Limited', '434123213', 'Plot 34 Katong Hill', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, '2007-10-29 15:00:31', 0, '0000-00-00 00:00:00');
INSERT INTO `employers` VALUES (40, 'Saracen Limited', '434123213', 'Plot 34 Katong Hill', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, '2007-10-29 15:01:41', 0, '0000-00-00 00:00:00');
INSERT INTO `employers` VALUES (41, 'Saracen Limited', '434123213', 'Plot 34 Katong Hill', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, '2007-10-29 15:03:33', 0, '0000-00-00 00:00:00');
INSERT INTO `employers` VALUES (42, 'Saracen Limited', '434123213', 'Plot 34 Katong Hill', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, '2007-10-29 15:09:02', 0, '0000-00-00 00:00:00');
INSERT INTO `employers` VALUES (43, 'Saracen Limited', '434123213', 'Plot 34 Katong Hill', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, '2007-10-29 15:10:58', 0, '0000-00-00 00:00:00');
INSERT INTO `employers` VALUES (44, 'Saracen Limited', '434123213', 'Plot 34 Katong Hill', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, '2007-10-29 15:13:10', 0, '0000-00-00 00:00:00');
INSERT INTO `employers` VALUES (45, 'Saracen Limited', '434123213', 'Plot 34 Katong Hill', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, '2007-10-29 15:14:44', 0, '0000-00-00 00:00:00');
INSERT INTO `employers` VALUES (46, 'Saracen Limited', '434123213', 'Plot 34 Katong Hill', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, '2007-10-29 15:15:14', 0, '0000-00-00 00:00:00');
INSERT INTO `employers` VALUES (47, 'Saracen Limited', '434123213', 'Plot 34 Katong Hill', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, '2007-10-29 15:23:02', 0, '0000-00-00 00:00:00');
INSERT INTO `employers` VALUES (48, 'Saracen Limited', '434123213', 'Plot 34 Katong Hill', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, '2007-10-29 15:25:23', 0, '0000-00-00 00:00:00');
INSERT INTO `employers` VALUES (49, 'Saracen Limited', '434123213', 'Plot 34 Katong Hill', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, '2007-10-29 15:27:32', 0, '0000-00-00 00:00:00');
INSERT INTO `employers` VALUES (50, 'Saracen Limited', '434123213', 'Plot 34 Katong Hill', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, '2007-10-29 15:28:22', 0, '0000-00-00 00:00:00');
INSERT INTO `employers` VALUES (51, 'Saracen Limited', '434123213', 'Plot 34 Katong Hill', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, '2007-10-29 15:29:42', 0, '0000-00-00 00:00:00');
INSERT INTO `employers` VALUES (52, 'Saracen Limited', '434123213', 'Plot 34 Katong Hill', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, '2007-10-29 15:42:42', 0, '0000-00-00 00:00:00');
INSERT INTO `employers` VALUES (53, 'Kirimutu Secutiry', '5324324324', 'Plot 34\r\nKanjokya Street', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, '2007-11-09 06:08:00', 0, '0000-00-00 00:00:00');
INSERT INTO `employers` VALUES (54, '', '', '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, '2007-11-09 06:35:43', 0, '0000-00-00 00:00:00');
INSERT INTO `employers` VALUES (55, '', '', '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, '2007-11-09 09:10:19', 0, '0000-00-00 00:00:00');
INSERT INTO `employers` VALUES (56, '', '', '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, '2007-11-09 10:31:12', 0, '0000-00-00 00:00:00');
INSERT INTO `employers` VALUES (57, '', '', '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, '2007-11-09 10:33:14', 0, '0000-00-00 00:00:00');
INSERT INTO `employers` VALUES (58, '', '', '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, '2007-11-09 10:46:33', 0, '0000-00-00 00:00:00');
INSERT INTO `employers` VALUES (59, '', '', '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, '2007-11-09 10:52:08', 0, '0000-00-00 00:00:00');
INSERT INTO `employers` VALUES (60, '', '', '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, '2007-11-09 10:56:55', 0, '0000-00-00 00:00:00');
INSERT INTO `employers` VALUES (61, '', '', '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, '2007-11-09 10:58:50', 0, '0000-00-00 00:00:00');
INSERT INTO `employers` VALUES (62, '', '', '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, '2007-11-09 11:02:44', 0, '0000-00-00 00:00:00');
INSERT INTO `employers` VALUES (63, '', '', '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, '2007-11-09 11:39:36', 0, '0000-00-00 00:00:00');
INSERT INTO `employers` VALUES (64, '', '', '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, '2007-11-09 11:40:57', 0, '0000-00-00 00:00:00');
INSERT INTO `employers` VALUES (65, '', '', '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, '2007-11-09 11:55:07', 0, '0000-00-00 00:00:00');
INSERT INTO `employers` VALUES (66, '', '', '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, '2007-11-09 12:00:56', 0, '0000-00-00 00:00:00');
INSERT INTO `employers` VALUES (67, '', '', '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, '2007-11-11 22:18:30', 0, '0000-00-00 00:00:00');
INSERT INTO `employers` VALUES (68, '', '', '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, '2007-11-11 22:43:48', 0, '0000-00-00 00:00:00');
INSERT INTO `employers` VALUES (69, 'Kintu Joseph', '52424234', 'Harry Johns Hospital', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, '2007-11-13 02:47:19', 0, '0000-00-00 00:00:00');
INSERT INTO `employers` VALUES (70, 'Peter Johns Kindergaten', '954757456', 'Peter Johns Road\r\nKamwokya', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, '2007-11-13 02:48:18', 0, '0000-00-00 00:00:00');
INSERT INTO `employers` VALUES (71, 'Kintu John', '756322345', 'Hiarry Johns\r\nKint Hospital\r\nHate Squard', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, '2007-11-14 03:18:34', 0, '0000-00-00 00:00:00');
INSERT INTO `employers` VALUES (72, 'Kintu John', '756322345', 'Hiarry Johns\r\nKint Hospital\r\nHate Squard', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, '2007-11-14 03:24:59', 0, '0000-00-00 00:00:00');
INSERT INTO `employers` VALUES (73, 'Harry Peterson', '9465477457', 'Kampala Rd\r\nJinja Hospital\r\nJinja Rd', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, '2007-11-14 03:24:59', 0, '0000-00-00 00:00:00');
INSERT INTO `employers` VALUES (74, 'Kintu John', '756322345', 'Hiarry Johns\r\nKint Hospital\r\nHate Squard', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, '2007-11-14 03:26:42', 0, '0000-00-00 00:00:00');
INSERT INTO `employers` VALUES (75, 'Harry Peterson', '9465477457', 'Kampala Rd\r\nJinja Hospital\r\nJinja Rd', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, '2007-11-14 03:26:42', 0, '0000-00-00 00:00:00');
INSERT INTO `employers` VALUES (76, 'Zziwa Almond', '432523452345', 'Garry Johns peterson Str.\r\nTint Rd\r\nStreet Torry', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, '2007-11-14 03:29:10', 0, '0000-00-00 00:00:00');
INSERT INTO `employers` VALUES (77, 'Kintu Johns', '6345325432', 'hi there', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, '2007-11-14 04:00:55', 0, '0000-00-00 00:00:00');
INSERT INTO `employers` VALUES (78, 'Kintu Johns', '6345325432', 'hi there', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, '2007-11-14 04:05:57', 0, '0000-00-00 00:00:00');
INSERT INTO `employers` VALUES (79, 'Kintu Johns', '6345325432', 'hi there', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, '2007-11-14 04:06:55', 0, '0000-00-00 00:00:00');
INSERT INTO `employers` VALUES (80, 'Feron Garry', '854757575', 'testing', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, '2007-11-14 04:07:40', 0, '0000-00-00 00:00:00');
INSERT INTO `employers` VALUES (81, 'Feron Garry', '854757575', 'testing', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, '2007-11-14 04:11:12', 0, '0000-00-00 00:00:00');
INSERT INTO `employers` VALUES (82, 'Feron Garry', '854757575', 'testing', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, '2007-11-14 04:12:05', 0, '0000-00-00 00:00:00');
INSERT INTO `employers` VALUES (83, 'Feron Garry', '854757575', 'testing', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, '2007-11-14 04:14:42', 0, '0000-00-00 00:00:00');
INSERT INTO `employers` VALUES (84, 'Joseph Peterson', '74365634564', 'Yaer Hint\r\nTorry\r\nPeter Gert', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, '2007-11-14 04:15:37', 0, '0000-00-00 00:00:00');
INSERT INTO `employers` VALUES (85, 'Tired Ben', '6563456345', 'Gate Him\r\nI test', '', '2008', '2008', 1, '2007-11-14 04:26:48', 1, '2008-07-16 15:01:27');
INSERT INTO `employers` VALUES (86, 'there you are', '41241234', 'baby bay', '', '2008', '2008', 1, '2007-11-14 04:32:02', 1, '2008-07-16 15:01:27');
INSERT INTO `employers` VALUES (87, 'Kintu Moses', '9567865', 'Kint Rd.\r\nRoad Tink\r\nUganda', '', '2008', '2008', 1, '2007-11-14 09:28:19', 1, '2008-02-12 17:44:11');
INSERT INTO `employers` VALUES (88, 'Honey Point', '63462345', 'Garry Str.\r\nTerry Horror.', '', '2008', '2008', 1, '2007-11-14 09:28:19', 1, '2008-02-12 17:44:11');
INSERT INTO `employers` VALUES (89, '', '', '', '', '1970', '1970', 1, '2007-11-15 11:44:34', 1, '2007-11-15 11:46:53');
INSERT INTO `employers` VALUES (90, '', '', '', '', '2008', '2008', 1, '2007-11-27 18:41:48', 1, '2008-02-08 12:04:16');
INSERT INTO `employers` VALUES (91, '', '', '', '', '2008', '2008', 1, '2007-11-27 18:44:37', 1, '2008-04-01 09:57:34');
INSERT INTO `employers` VALUES (92, '', '', '', '', '', '', 1, '2007-11-27 18:49:27', 1, '2008-04-09 13:52:07');
INSERT INTO `employers` VALUES (93, '', '', '', '', '', '', 1, '2008-01-16 09:45:52', 0, '0000-00-00 00:00:00');
INSERT INTO `employers` VALUES (94, '', '', '', '', '', '', 1, '2008-01-25 10:19:20', 1, '2008-02-01 14:25:52');
INSERT INTO `employers` VALUES (95, '', '', '', '', '', '', 1, '2008-02-04 14:37:30', 0, '0000-00-00 00:00:00');
INSERT INTO `employers` VALUES (96, 'Uganda Peoples Defence Forces', '0414776332', 'P.O.Box. 32424\r\nBombo.', 'Sergent', '2008', '2008', 1, '2008-02-05 08:14:54', 1, '2008-04-01 11:39:05');
INSERT INTO `employers` VALUES (97, 'Kigo Prison', '0414736334', 'P.o.Box, 3232\r\nKigo, Kampala', 'RP', '2008', '2008', 1, '2008-02-05 13:17:16', 1, '2008-04-10 09:42:03');
INSERT INTO `employers` VALUES (98, '', '', '', '', '', '', 1, '2008-02-11 14:46:05', 0, '0000-00-00 00:00:00');
INSERT INTO `employers` VALUES (99, '', '', '', '', '', '', 1, '2008-04-01 11:48:35', 0, '0000-00-00 00:00:00');
INSERT INTO `employers` VALUES (100, '', '', '', '', '', '', 1, '2008-04-01 11:51:58', 0, '0000-00-00 00:00:00');
INSERT INTO `employers` VALUES (101, '', '', '', '', '', '', 1, '2008-04-01 12:10:52', 0, '0000-00-00 00:00:00');
INSERT INTO `employers` VALUES (102, '', '', '', '', '2008', '2008', 1, '2008-04-01 12:26:28', 1, '2008-04-30 11:53:23');
INSERT INTO `employers` VALUES (103, '', '', '', '', '', '', 1, '2008-04-01 12:40:34', 0, '0000-00-00 00:00:00');
INSERT INTO `employers` VALUES (104, '', '', '', '', '', '', 1, '2008-04-01 12:41:30', 0, '0000-00-00 00:00:00');
INSERT INTO `employers` VALUES (105, '', '', '', '', '', '', 1, '2008-04-01 13:08:18', 0, '0000-00-00 00:00:00');
INSERT INTO `employers` VALUES (106, 'Hint Hunters', '054674567', 'Terry Rd Kindergaten\r\nPlot 67 \r\nSpring Hill', 'Head Security', '2008', '2008', 1, '2008-04-14 19:32:33', 1, '2008-04-14 20:22:08');
INSERT INTO `employers` VALUES (107, 'Toast Bank', '0723452345', 'Kilington High Rd\r\nPlot 7 Kampala Rd', 'Chief Backup Security', '2008', '2008', 1, '2008-04-14 19:32:33', 1, '2008-04-14 20:22:08');
INSERT INTO `employers` VALUES (108, '', '', '', '', '', '', 1, '2008-04-15 10:40:21', 1, '2008-04-18 09:12:09');
INSERT INTO `employers` VALUES (109, '', '', '', '', '', '', 1, '2008-05-03 13:26:07', 0, '0000-00-00 00:00:00');
INSERT INTO `employers` VALUES (110, '', '', '', '', '1970', '1970', 1, '2008-05-20 17:56:53', 1, '2008-05-21 07:40:15');
INSERT INTO `employers` VALUES (111, '', '', '', '', '', '', 1, '2008-05-21 07:59:00', 1, '2008-05-21 08:02:31');
INSERT INTO `employers` VALUES (112, '', '', '', '', '', '', 1, '2008-07-02 10:40:42', 1, '2008-07-02 15:23:33');

-- --------------------------------------------------------

-- 
-- Table structure for table `equipment`
-- 

CREATE TABLE `equipment` (
  `id` bigint(20) NOT NULL auto_increment,
  `type` varchar(250) NOT NULL default '',
  `name` varchar(250) NOT NULL default '',
  `serialno` varchar(250) NOT NULL default '',
  `status` varchar(250) NOT NULL default '',
  `instore` enum('Y','N') NOT NULL default 'Y',
  `date_of_entry` datetime NOT NULL default '0000-00-00 00:00:00',
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=latin1 AUTO_INCREMENT=14 ;

-- 
-- Dumping data for table `equipment`
-- 

INSERT INTO `equipment` VALUES (1, 'Gun', 'Rifle - Russia 1987', '123123', 'New', 'N', '2007-11-22 00:00:00');
INSERT INTO `equipment` VALUES (2, 'Baton', 'Japan Batons', '6245235', 'New', 'N', '2008-03-28 14:09:10');
INSERT INTO `equipment` VALUES (3, 'Gun', 'AK47 - 1998 Model', '523413123', 'New', 'N', '2008-03-29 12:00:11');
INSERT INTO `equipment` VALUES (4, 'Deployment Pickup', 'Pickup - Toyota 1999 Model', 'UAB 937Q', 'New', 'N', '2008-02-12 13:27:38');
INSERT INTO `equipment` VALUES (6, 'Deployment Pickup', 'Toyota - 1992 Model', 'UAB 875H', 'Old - Usable', 'Y', '2007-11-29 14:16:58');
INSERT INTO `equipment` VALUES (7, 'Transport van', 'Toyota Minibus', 'UAD 234Q', 'New - Damaged', 'Y', '2007-12-04 20:20:55');
INSERT INTO `equipment` VALUES (8, 'Transport van', 'Bullion van', 'UAH 334K', 'New', 'Y', '2008-03-29 11:57:55');
INSERT INTO `equipment` VALUES (9, 'Deployment Pickup', 'Toyota subaru', 'UAD 309H', 'New', 'Y', '2008-03-28 11:09:43');
INSERT INTO `equipment` VALUES (11, 'Other', 'Caps', '0882344', 'New', 'Y', '2008-05-12 11:58:53');
INSERT INTO `equipment` VALUES (12, 'Radio', 'Russian RACK 124', '7888233R', 'New', 'Y', '2008-05-16 11:44:35');
INSERT INTO `equipment` VALUES (13, 'Electronics', 'Alarm Button - 123323', 'AR-123323', 'New', 'Y', '2008-05-20 17:45:18');

-- --------------------------------------------------------

-- 
-- Table structure for table `equipmentdetails`
-- 

CREATE TABLE `equipmentdetails` (
  `id` bigint(20) NOT NULL auto_increment,
  `name` text NOT NULL,
  `type` varchar(250) NOT NULL default '',
  `category` varchar(50) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=latin1 AUTO_INCREMENT=33 ;

-- 
-- Dumping data for table `equipmentdetails`
-- 

INSERT INTO `equipmentdetails` VALUES (2, 'New', 'Status', NULL);
INSERT INTO `equipmentdetails` VALUES (3, 'Old - Usable', 'Status', NULL);
INSERT INTO `equipmentdetails` VALUES (4, 'Old - Not Usable', 'Status', NULL);
INSERT INTO `equipmentdetails` VALUES (5, 'Obsolesent', 'Status', NULL);
INSERT INTO `equipmentdetails` VALUES (6, 'Baton', 'Type', 'Uniforms');
INSERT INTO `equipmentdetails` VALUES (7, 'Deployment Pickup', 'Type', 'Vehicles');
INSERT INTO `equipmentdetails` VALUES (8, 'Transport Van', 'Type', 'Vehicles');
INSERT INTO `equipmentdetails` VALUES (13, 'New - Damaged', 'Status', NULL);
INSERT INTO `equipmentdetails` VALUES (14, 'Bullion Van', 'Type', 'Vehicles');
INSERT INTO `equipmentdetails` VALUES (15, 'Other', 'Type', NULL);
INSERT INTO `equipmentdetails` VALUES (16, 'Electronics', 'Type', 'Others');
INSERT INTO `equipmentdetails` VALUES (17, 'Alarms, Equipment & Materials', 'Type', 'Others');
INSERT INTO `equipmentdetails` VALUES (18, 'Key Pad', 'Alarm', NULL);
INSERT INTO `equipmentdetails` VALUES (19, 'Remote', 'Alarm', NULL);
INSERT INTO `equipmentdetails` VALUES (20, 'Backup Battery', 'Alarm', NULL);
INSERT INTO `equipmentdetails` VALUES (21, 'Motion Detectors', 'Alarm', NULL);
INSERT INTO `equipmentdetails` VALUES (22, 'Fixed Button', 'Alarm', NULL);
INSERT INTO `equipmentdetails` VALUES (23, 'Radio', 'Type', 'Others');
INSERT INTO `equipmentdetails` VALUES (26, 'Shirts', 'Uniform', NULL);
INSERT INTO `equipmentdetails` VALUES (27, 'Trousers', 'Uniform', NULL);
INSERT INTO `equipmentdetails` VALUES (28, 'Sweaters', 'Uniform', NULL);
INSERT INTO `equipmentdetails` VALUES (29, 'Shoes', 'Uniform', NULL);
INSERT INTO `equipmentdetails` VALUES (30, 'Rain Coat', 'Uniform', NULL);
INSERT INTO `equipmentdetails` VALUES (31, 'Belt', 'Uniform', NULL);
INSERT INTO `equipmentdetails` VALUES (32, 'Fire Arms', 'Type', 'Guns');

-- --------------------------------------------------------

-- 
-- Table structure for table `equipments`
-- 

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
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

-- 
-- Dumping data for table `equipments`
-- 

INSERT INTO `equipments` VALUES (1, '2', 'sad', 'sdd', '', '', '', '2007-12-04', '08:30:00', '1991-10-17', '06:30:00', '', 0, '2007-12-04', 1, 1, '2007-12-04 15:38:15');
INSERT INTO `equipments` VALUES (2, '7', 'dsd', 'sxdsd', '3', 'cdfc', 'fdfd', '2001-09-17', '06:30:00', '1993-08-12', '07:30:00', '', 0, '2007-12-04', 1, 1, '2007-12-04 15:40:00');
INSERT INTO `equipments` VALUES (3, '6', 'assdc', 'dsfcdefc', '1', 'sds', 'dsd', '2004-09-16', '09:00:00', '2004-04-15', '07:30:00', ' large', 12, '2007-12-04', 1, 1, '2007-12-04 15:50:07');
INSERT INTO `equipments` VALUES (4, '5', 'sd384598', 'h3d-k', '3', 'joab', 'vicent', '1992-08-15', '08:00:00', '2007-12-04', '07:30:00', ' medium', 16, '2007-12-04', 1, 1, '2007-12-04 16:39:34');

-- --------------------------------------------------------

-- 
-- Table structure for table `experiences`
-- 

CREATE TABLE `experiences` (
  `id` bigint(20) NOT NULL auto_increment,
  `type` varchar(100) NOT NULL default '',
  `startdate` datetime NOT NULL default '0000-00-00 00:00:00',
  `enddate` datetime NOT NULL default '0000-00-00 00:00:00',
  `createdby` bigint(20) NOT NULL default '0',
  `date_of_entry` datetime NOT NULL default '0000-00-00 00:00:00',
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=36 DEFAULT CHARSET=latin1 AUTO_INCREMENT=36 ;

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
INSERT INTO `experiences` VALUES (17, 'prisonsexperience_', '2008-03-01 12:00:00', '2008-03-01 12:00:00', 1, '2007-11-13 02:55:04');
INSERT INTO `experiences` VALUES (22, 'policeexperience_', '1995-04-01 12:04:00', '1999-09-01 12:09:00', 1, '2007-11-14 03:01:11');
INSERT INTO `experiences` VALUES (23, 'policeexperience_', '1995-04-01 12:04:00', '1999-09-01 12:09:00', 1, '2007-11-14 03:08:15');
INSERT INTO `experiences` VALUES (24, 'policeexperience_', '1995-04-01 12:04:00', '1999-09-01 12:09:00', 1, '2007-11-14 03:10:22');
INSERT INTO `experiences` VALUES (25, 'policeexperience_', '1995-04-01 12:04:00', '1999-09-01 12:09:00', 1, '2007-11-14 03:13:43');
INSERT INTO `experiences` VALUES (26, 'policeexperience_', '2008-03-01 12:00:00', '2008-03-01 12:00:00', 1, '2007-11-14 03:14:44');
INSERT INTO `experiences` VALUES (27, 'policeexperience_', '1999-03-12 12:00:00', '2004-03-12 12:00:00', 1, '2007-11-14 09:28:19');
INSERT INTO `experiences` VALUES (28, 'armyexperience_', '2005-02-01 12:00:00', '2006-11-01 12:00:00', 1, '2008-02-05 12:19:43');
INSERT INTO `experiences` VALUES (29, 'prisonsexperience_', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, '2008-02-05 12:19:43');
INSERT INTO `experiences` VALUES (30, 'armyexperience_', '1996-01-10 12:00:00', '2004-03-10 12:00:00', 1, '2008-02-05 13:17:16');
INSERT INTO `experiences` VALUES (31, 'policeexperience_', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, '2008-02-08 10:32:39');
INSERT INTO `experiences` VALUES (32, 'policeexperience_', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, '2008-02-08 10:34:25');
INSERT INTO `experiences` VALUES (33, 'prisonsexperience_', '2005-03-10 12:00:00', '2006-12-10 12:00:00', 1, '2008-02-11 12:56:14');
INSERT INTO `experiences` VALUES (34, 'armyexperience_', '2000-02-14 12:00:00', '2002-09-14 12:00:00', 1, '2008-04-14 19:32:33');
INSERT INTO `experiences` VALUES (35, 'policeexperience_', '2006-05-14 12:00:00', '2007-11-14 12:00:00', 1, '2008-04-14 19:32:33');

-- --------------------------------------------------------

-- 
-- Table structure for table `favorites`
-- 

CREATE TABLE `favorites` (
  `id` bigint(20) NOT NULL auto_increment,
  `name` varchar(250) NOT NULL default '',
  `description` varchar(250) default NULL,
  `link` varchar(250) NOT NULL default '',
  `section` varchar(100) NOT NULL default '',
  `viewedby` text NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=56 DEFAULT CHARSET=latin1 AUTO_INCREMENT=56 ;

-- 
-- Dumping data for table `favorites`
-- 

INSERT INTO `favorites` VALUES (1, 'Add Guard', 'Register guards.', '../hr/index.php', '1', '');
INSERT INTO `favorites` VALUES (2, 'Add Clients', 'Register new clients.', '../core/client.php', '1', '1,81,85');
INSERT INTO `favorites` VALUES (3, 'Register New User', 'Register new users and asign them groups.', '../core/user.php', '7', '1,85');
INSERT INTO `favorites` VALUES (4, 'Manage Guards', 'Modify guard details, view their status and personnel files.', '../hr/manageguards.php', '1', '1');
INSERT INTO `favorites` VALUES (5, 'Active Guards', 'Shows a list of active guards.', '../operations/manageactiveguards.php', '2', '');
INSERT INTO `favorites` VALUES (6, 'Overtime', 'Shows overtime report and details about each assignment.', '../finance/overtimereport.php', '2', '1');
INSERT INTO `favorites` VALUES (7, 'Payroll Schedule', 'Generate guard payroll schedule.', '../finance/report.php?f=Guard%20Payroll', '2', '1');
INSERT INTO `favorites` VALUES (8, 'PAYE Schedule', 'Includes PAYE returns for each guard for a specified period.', '../finance/paye.php', '2', '1');
INSERT INTO `favorites` VALUES (9, 'Equipment In Store', 'Shows items in the inventory.', '../inventory/inventorystock.php', '2', '1,79,82');
INSERT INTO `favorites` VALUES (10, 'Sick Guards', 'Shows a list of sick guards.', '../operations/managesickguards.php', '2', '1');
INSERT INTO `favorites` VALUES (11, 'Control Shift', 'Generate control shift report for a specified date.', '../operations/report.php?f=Control%20Shift', '2', '1');
INSERT INTO `favorites` VALUES (12, 'Client Daily Schedule', 'Generate a daily report showing assigned guards for the active clients.', '../core/guardreport.php?f=Guard%20Daily%20Schedule', '2', '1');
INSERT INTO `favorites` VALUES (13, 'NSSF Schedule', 'Includes NSSF contributions for each guard for a specified period.', '../finance/nssf.php', '2', '1');
INSERT INTO `favorites` VALUES (14, 'Register New Assignment', 'Add client assignments.', '../core/assignment.php', '3', '1');
INSERT INTO `favorites` VALUES (15, 'Active Assignments', 'View the active assignments.', '../core/manageassignments.php', '3', '1');
INSERT INTO `favorites` VALUES (16, 'Register Loan Application', 'Enter guard loan application for approval by GM or other responsible personnel', '../finance/loan.php', '6', '1,80,81,83,84');
INSERT INTO `favorites` VALUES (17, 'Register Leave Application', 'Enter leave guard leave aplication', '../hr/leave.php', '1', '1,83,84,85');
INSERT INTO `favorites` VALUES (18, 'Promote Guard', 'Change the guard''s employement position', '../hr/managepromotions.php', '1', '1,84,85');
INSERT INTO `favorites` VALUES (19, 'Create User Group', 'Register new user group and assign rights to it.', '../core/group.php', '7', '1,83');
INSERT INTO `favorites` VALUES (20, 'Create Guard File', 'Register new file for the guard''s records.', '../hr/personnel.php', '1', '1,84,85');
INSERT INTO `favorites` VALUES (21, 'Guard Period of Service', 'A report showing the guard period of service', '../hr/periodofservice.php', '2', '1,84');
INSERT INTO `favorites` VALUES (22, 'Today''s Guard Schedule', 'Shows where each guard will be located today.', '../operations/schedule.php', '11', '1,82');
INSERT INTO `favorites` VALUES (23, 'Guard Shedule Calendar', 'Shows the month view of the scheduled assignments and the assigned guards.', '../operations/schedulecalendar.php', '11', '1,79,82');
INSERT INTO `favorites` VALUES (24, 'Register New Appraisal', 'Enter new appraisal for a guard.', '../operations/addappraisal.php', '11', '1,79,82');
INSERT INTO `favorites` VALUES (25, 'Search Incidents', 'Searches all incidents according to reference number or assignment number', '../operations/manageincidents.php', '11', '1,79,82');
INSERT INTO `favorites` VALUES (26, 'New Incident', 'Register new incident by guard', '../operations/incident.php', '11', '1,79,82');
INSERT INTO `favorites` VALUES (27, 'New Region', 'Create new region of guard operations.', '../core/region.php', '7', '1,82,83');
INSERT INTO `favorites` VALUES (28, 'Search Guards By Status', 'Search guards by their current status e,g., active, resting, absconded etc', '../operations/manageactiveguards.php', '2', '1,79,80,81,82,83,84,85');
INSERT INTO `favorites` VALUES (29, 'Register Client Complaint', 'Enter new client complaint', '../operations/addcomplaint.php?t=dG5laWxD', '11', '1,82,79');
INSERT INTO `favorites` VALUES (30, 'New Guard Complaint', 'Register a complaint by a guard', '../operations/addcomplaint.php?t=ZHJhdUc=', '11', '1,79,82');
INSERT INTO `favorites` VALUES (31, 'New Inspection Report', 'Enter new report on an inspection that has been carried out.', '../operations/addinspection.php', '11', '1,79,82,83');
INSERT INTO `favorites` VALUES (32, 'New Alarm', 'Record new guard alarm.', '../technical/alarminstallations.php', '11', '1,79,82');
INSERT INTO `favorites` VALUES (34, 'Today''s Sitrep Checks', 'View/Edit today''s sitrep checks', '../operations/sitreps.php', '11', '1,79,82,87');
INSERT INTO `favorites` VALUES (35, 'View Sitrep Calendar', 'A monthly view of the sitrep checks recorded so far.', '../operations/sitrepcalendar.php', '11', '1,82');
INSERT INTO `favorites` VALUES (36, 'New Inventory Item', 'Record new inventory item', '../inventory/item.php', '5', '1,79,82');
INSERT INTO `favorites` VALUES (37, 'Issue Item(s)', 'Allow issuing of a given item.', '../inventory/index.php?a=issue', '5', '1,79,82');
INSERT INTO `favorites` VALUES (38, 'Return Item(s)', 'Allows returning of previously issued items.', '../inventory/itemissues.php?a=return', '5', '1,79,82');
INSERT INTO `favorites` VALUES (39, 'Track Item Location', 'Shows where each item is located at the search date.', '../inventory/itemissues.php?a=return', '2', '1,79,80,81,82,83,84,85,86,87');
INSERT INTO `favorites` VALUES (40, 'Record Purchase', 'Enter details of an item purchase.', '../inventory/itempurchases.php', '5', '1,79,82');
INSERT INTO `favorites` VALUES (41, 'Generate Invoice', 'Generate a profoma invoice for services provided to a client for a selected period.', '../finance/report.php?f=Client%20Invoice', '6', '1,80,81');
INSERT INTO `favorites` VALUES (42, 'Generate Pay Slip(s)', 'Generate a the payslip for a guard(s)', '../finance/manageguardfinance.php', '6', '1,80,81');
INSERT INTO `favorites` VALUES (43, 'Guard Financial Status', 'View the financial status of the guards showing how much money the guards owe the company.', '../finance/manageguardfinance.php', '6', '1,80,81');
INSERT INTO `favorites` VALUES (44, 'Generate Payroll', 'Generate the guard payroll for a selected period and export to MS Excel or MS Word', '../finance/report.php?f=Guard%20Payroll', '6', '1,80,81');
INSERT INTO `favorites` VALUES (45, 'New Ledger Entry', 'Record an expenditure from petty cash into the general ledger', '../finance/transaction.php?t=d29sZnR1bw==', '6', '1,80,81');
INSERT INTO `favorites` VALUES (46, 'Record Payment Transaction', 'Enter details for a new payment made by a client.', '../finance/transaction.php?t=d29sZm5p', '6', '1,81,80');
INSERT INTO `favorites` VALUES (47, 'Financial Rates', 'Add/Modify guard and client payment rates for automatic finacial calculations.', '../finance/managerates.php', '6', '1,80,81');
INSERT INTO `favorites` VALUES (48, 'Record Fuel Distribution', 'Allows entering of details of fuel rationing to the vehicles of the company.', '../transport/fueldistribution.php', '9', '1,86,87');
INSERT INTO `favorites` VALUES (49, 'New Vechicle Service Report', 'Record details of service done on a vehicle.', '../transport/vehicleservice.php', '9', '1,86,87');
INSERT INTO `favorites` VALUES (50, 'Today''s Vehicle Logs', 'View/Edit today''s vehicle logs', '../transport/index.php', '9', '1,86,87');
INSERT INTO `favorites` VALUES (51, 'Search Drivers/Commaders', 'Search the list of drivers and commanders by name or ID', '../hr/manageguards.php?a=search&t=drivers', '9', '1,86,87');
INSERT INTO `favorites` VALUES (52, 'Average Fuel Consumption', 'Generate a report on the average fuel consumption of the vehicles for a selected period', '../transport/fuelreport.php', '9', '1,86,87');
INSERT INTO `favorites` VALUES (53, 'New Assignment Separation', 'Record new separation of the assignment locations.', '../transport/assignmentseparations.php', '9', '1,86,87');
INSERT INTO `favorites` VALUES (54, 'New Vehicle Inspection Report', 'Record details and all comments of a new inspection report.', '../transport/addvehicleinspection.php', '9', '1,86,87');
INSERT INTO `favorites` VALUES (55, 'Search Drivers/Commanders Appraisal', 'Look up appraisal details for a driver or commander', '../operations/appraisals.php?t=drivers', '9', '1,86,87');

-- --------------------------------------------------------

-- 
-- Table structure for table `favoritesection`
-- 

CREATE TABLE `favoritesection` (
  `id` bigint(20) NOT NULL auto_increment,
  `image` varchar(250) NOT NULL default '',
  `name` varchar(250) NOT NULL default '',
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1 AUTO_INCREMENT=12 ;

-- 
-- Dumping data for table `favoritesection`
-- 

INSERT INTO `favoritesection` VALUES (1, '../images/scheduleguards.gif', 'HR');
INSERT INTO `favoritesection` VALUES (2, '../images/managementofassignements.gif', 'Reports');
INSERT INTO `favoritesection` VALUES (3, '../images/schedulingguards.gif', 'Guard Assignments');
INSERT INTO `favoritesection` VALUES (5, '../images/inventorymanagement.gif', 'Inventory');
INSERT INTO `favoritesection` VALUES (6, '../images/financeandaccounting.gif', 'Finance');
INSERT INTO `favoritesection` VALUES (7, '../images/registerandmanageguards.gif', 'Administration');
INSERT INTO `favoritesection` VALUES (9, '../images/scheduleguards.gif', 'Transport');
INSERT INTO `favoritesection` VALUES (11, '../images/customer.gif', 'Operations');

-- --------------------------------------------------------

-- 
-- Table structure for table `filedocuments`
-- 

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
-- Table structure for table `financecategories`
-- 

CREATE TABLE `financecategories` (
  `id` bigint(20) NOT NULL auto_increment,
  `category` varchar(250) NOT NULL default '',
  `type` varchar(150) NOT NULL default '',
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

-- 
-- Dumping data for table `financecategories`
-- 

INSERT INTO `financecategories` VALUES (1, 'Claim', 'add');
INSERT INTO `financecategories` VALUES (2, 'Uniform Deposit', 'subtract');
INSERT INTO `financecategories` VALUES (4, 'Staff Debt Deduction', 'subtract');
INSERT INTO `financecategories` VALUES (5, 'Sold Leave', 'add');

-- --------------------------------------------------------

-- 
-- Table structure for table `fueldistribution`
-- 

CREATE TABLE `fueldistribution` (
  `id` bigint(20) NOT NULL auto_increment,
  `date` date NOT NULL default '0000-00-00',
  `vehicleregno` varchar(50) NOT NULL default '',
  `mileage` int(11) NOT NULL default '0',
  `litresreceived` int(11) NOT NULL default '0',
  `costperlitre` varchar(250) NOT NULL default '',
  `petrostation` varchar(100) NOT NULL default '',
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

-- 
-- Dumping data for table `fueldistribution`
-- 

INSERT INTO `fueldistribution` VALUES (1, '2008-03-12', 'UAB 875H', 87333, 69, '', 'Shell Capital');
INSERT INTO `fueldistribution` VALUES (2, '2008-03-12', 'UAH 334K', 43434, 44, '', 'Shell Bugoloobi');
INSERT INTO `fueldistribution` VALUES (4, '2008-02-04', 'UAB 937Q', 873344, 96, '', 'Shell Jinja road');
INSERT INTO `fueldistribution` VALUES (5, '2008-02-08', 'UAH 334K', 43488, 98, '', 'Total Kamwokya');
INSERT INTO `fueldistribution` VALUES (6, '2008-03-06', 'UAD 309H', 9833, 91, '', 'Shell Jinja Road');
INSERT INTO `fueldistribution` VALUES (7, '2008-03-20', 'UAH 334K', 9023448, 22, '3090', 'Shell Capital');
INSERT INTO `fueldistribution` VALUES (8, '2012-01-01', 'UAB 875H', 8900998, 90, '3500', 'Shell');

-- --------------------------------------------------------

-- 
-- Table structure for table `groups`
-- 

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
) ENGINE=InnoDB AUTO_INCREMENT=89 DEFAULT CHARSET=latin1 AUTO_INCREMENT=89 ;

-- 
-- Dumping data for table `groups`
-- 

INSERT INTO `groups` VALUES (1, 'Administrators', 'System Administrators for the whole system', '182,91,188,177,192,178,65,152,108,164,172,189,162,143,72,71,70,193,138,44,125,139,124,47,48,59,46,98,74,54,103,154,169,183,49,179,62,45,180,100,116,120,111,68,171,76,106,57,153,173,81,53,78,61,82,99,115,119,110,67,87,85,75,105,56,80,186,79,95,144,121,83,112,197,145,194,181,187,191,165,132,127,185,150,200,136,166,135,134,126,159,170,133,184,199,129,131,130,156,190,155,196,161,151,94,141,168,160,93,90,50,73,142,96,107,102,60,42,113,66,117,55,128,89,101,41,32,52,64,69,92,137,123,51,36,33,39,63,43,122,77,88,40,97,35,114,109,86,34,38,84,104,118,163,58,157,158,198,174,201,175,195', 1, '2007-11-28', 1, '2008-08-15 17:52:48');
INSERT INTO `groups` VALUES (79, 'Operations Clerks', 'These are the data guys in the operations department.', '108,44,47,48,98,53,99,115,119,110,67,80,95,121,112,127,94,50,96,107,102,113,66,117,101,32,52,69,92,123,51,36,122,97,35,114,109,34,38,104,118', 1, '2008-01-05', NULL, '2008-01-09 11:18:52');
INSERT INTO `groups` VALUES (80, 'Finance Management', 'These are managers in the finance and accounting department', '91,72,125,81,78,82,87,85,80,79,121,83,135,134,126,141,93,90,50,73,96,107,42,113,66,117,128,89,101,32,52,69,92,123,51,36,33,39,63,43,122,77,97,35,114,109,86,34,84,118', 1, '2008-01-09', NULL, '2008-01-09 11:19:04');
INSERT INTO `groups` VALUES (81, 'Finance Clerks', 'These are clerks in the finance and accounting department', '47,81,78,82,87,85,80,79,121,83,141,90,50,96,107,42,113,66,117,89,32,52,69,92,123,51,36,33,39,43,122,88,97,35,114,109,86,34,84,118', 1, '2008-01-09', NULL, '2008-01-09 16:57:43');
INSERT INTO `groups` VALUES (82, 'Operations Management', 'Members in the operations\r\nmanagement department', '91,65,108,70,44,47,48,98,103,49,100,116,120,111,68,106,53,99,115,119,110,67,105,80,95,121,112,132,127,136,135,134,126,133,94,90,50,73,96,107,102,113,66,117,128,101,32,52,69,92,123,51,36,122,77,97,35,114,109,34,38,104,118', 1, '2008-01-09', NULL, '2008-01-09 11:32:35');
INSERT INTO `groups` VALUES (83, 'General Management', 'General\r\nManagement members', '91,143,87,85,80,79,95,121,83,141,93,90,50,142,96,107,42,113,66,117,128,101,41,32,52,92,137,123,51,36,33,43,122,77,88,97,35,114,109,86,34,84,118', 1, '2008-01-09', NULL, '2008-02-04 16:06:52');
INSERT INTO `groups` VALUES (84, 'HR Management', 'These are managers in the HR Department', '65,71,44,46,74,45,68,76,67,75,132,136,141,50,73,142,42,66,128,32,52,69,123,51,36,43,122,77,40,34', 1, '2008-01-09', NULL, '2008-01-09 11:45:12');
INSERT INTO `groups` VALUES (85, 'HR Clerks', 'These are Clerks in the HR Department', '65,71,70,44,46,67,56,79,83,141,50,73,142,42,66,55,32,52,69,123,51,36,43,122,77,40,34', 1, '2008-01-09', NULL, '2008-07-03 14:57:51');
INSERT INTO `groups` VALUES (86, 'Transport Clerks', 'Enters/modifies any of the transport section data as instructed by the management.', '157,158', 1, '2008-06-10', NULL, '2008-08-14 11:36:47');
INSERT INTO `groups` VALUES (87, 'Transport Management', 'In charge of all the fleet of the company.', '', 1, '2008-06-10', NULL, '2008-06-10 12:02:52');
INSERT INTO `groups` VALUES (88, 'Clerical', NULL, '', NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

-- 
-- Table structure for table `guardclaims`
-- 

CREATE TABLE `guardclaims` (
  `id` bigint(20) NOT NULL auto_increment,
  `guardid` varchar(250) NOT NULL default '',
  `amount` varchar(250) NOT NULL default '',
  `reason` text NOT NULL,
  `claimstatus` varchar(250) NOT NULL default '',
  `isactive` enum('Y','N') NOT NULL default 'Y',
  `datecreated` datetime NOT NULL default '0000-00-00 00:00:00',
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

-- 
-- Dumping data for table `guardclaims`
-- 

INSERT INTO `guardclaims` VALUES (2, '', '', '', '', 'Y', '0000-00-00 00:00:00');
INSERT INTO `guardclaims` VALUES (3, '', '', '', '', 'Y', '0000-00-00 00:00:00');
INSERT INTO `guardclaims` VALUES (4, '', '', '', '', 'Y', '0000-00-00 00:00:00');
INSERT INTO `guardclaims` VALUES (5, '', '', '', '', 'Y', '0000-00-00 00:00:00');
INSERT INTO `guardclaims` VALUES (6, '123123', '146000', 'I caught a thief and wasnt compesated.', 'Approved', 'Y', '2008-02-18 00:00:00');
INSERT INTO `guardclaims` VALUES (7, '', '', '', '', 'Y', '0000-00-00 00:00:00');
INSERT INTO `guardclaims` VALUES (8, '', '', '', '', 'Y', '0000-00-00 00:00:00');
INSERT INTO `guardclaims` VALUES (9, '', '', '', '', 'Y', '0000-00-00 00:00:00');

-- --------------------------------------------------------

-- 
-- Table structure for table `guarddocuments`
-- 

CREATE TABLE `guarddocuments` (
  `id` bigint(20) NOT NULL auto_increment,
  `documentname` varchar(125) default NULL,
  `referencenumber` varchar(100) NOT NULL default '',
  `addedby` int(11) NOT NULL default '0',
  `date_of_entry` date NOT NULL default '0000-00-00',
  `lastupdated` datetime NOT NULL default '0000-00-00 00:00:00',
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

-- 
-- Dumping data for table `guarddocuments`
-- 

INSERT INTO `guarddocuments` VALUES (3, 'LC letter', '23434343', 1, '2008-03-31', '2008-03-31 16:30:15');
INSERT INTO `guarddocuments` VALUES (4, 'Medical Examination', '873483434', 1, '2008-03-31', '0000-00-00 00:00:00');

-- --------------------------------------------------------

-- 
-- Table structure for table `guardfinance`
-- 

CREATE TABLE `guardfinance` (
  `id` bigint(20) NOT NULL auto_increment,
  `amount` varchar(200) NOT NULL default '',
  `type` varchar(200) NOT NULL default '',
  `date` datetime NOT NULL default '0000-00-00 00:00:00',
  `reason` text NOT NULL,
  `category` varchar(250) NOT NULL default '',
  `approved` enum('Y','N') NOT NULL default 'N',
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=109 DEFAULT CHARSET=latin1 AUTO_INCREMENT=109 ;

-- 
-- Dumping data for table `guardfinance`
-- 

INSERT INTO `guardfinance` VALUES (1, '3000', 'Bonus', '2007-12-11 10:40:20', 'He shot and wounded a thief who was stealing a clients car', '', 'N');
INSERT INTO `guardfinance` VALUES (2, '7000', 'Bonus', '2007-12-05 10:40:58', 'He was instrumental in catching  a thief who raided the clients factory', '', 'Y');
INSERT INTO `guardfinance` VALUES (3, '23000', 'Deduction', '2008-02-17 00:00:00', 'He lost his uniform in a fight at his home', '', 'Y');
INSERT INTO `guardfinance` VALUES (27, '9000', 'Bonus', '2007-12-11 00:00:00', 'the guard stole the show by eating a rat', '', 'Y');
INSERT INTO `guardfinance` VALUES (28, '2000', 'Bonus', '2007-12-15 00:00:00', 'THere was a dilema in addition of this', '', 'Y');
INSERT INTO `guardfinance` VALUES (29, '78000', 'Bonus', '2007-12-06 00:00:00', 'I wanted to show the guard that is was doable', '', 'Y');
INSERT INTO `guardfinance` VALUES (30, '620', 'Bonus', '2007-12-03 00:00:00', 'Got from his own sweat', '', 'Y');
INSERT INTO `guardfinance` VALUES (31, '12000', 'Bonus', '2007-12-13 00:00:00', 'there are no problems with him', '', 'Y');
INSERT INTO `guardfinance` VALUES (32, '30000', 'Deduction', '2007-11-02 00:00:00', 'There is no reason for hiring him', '', 'Y');
INSERT INTO `guardfinance` VALUES (33, '11000', 'Deduction', '2007-12-03 00:00:00', 'Till there is a problem.', '', 'N');
INSERT INTO `guardfinance` VALUES (34, '40800', 'Bonus', '2008-02-04 00:00:00', 'There is no way that I want to get above', '', 'Y');
INSERT INTO `guardfinance` VALUES (35, '12400', 'Bonus', '2007-01-03 00:00:00', 'The guard bought the clients land.', '', 'Y');
INSERT INTO `guardfinance` VALUES (36, '12400', 'Bonus', '2008-02-16 00:00:00', 'The guard bought the clients land.', '', 'Y');
INSERT INTO `guardfinance` VALUES (37, '100000', 'Deduction', '2008-02-07 00:00:00', 'The guard stole the clients phone', '', 'Y');
INSERT INTO `guardfinance` VALUES (38, '29000', 'Bonus', '2007-05-03 00:00:00', 'there are no things done so far', '', 'N');
INSERT INTO `guardfinance` VALUES (39, '12000', 'Deduction', '2007-12-05 00:00:00', 'here', '4', 'Y');
INSERT INTO `guardfinance` VALUES (40, '4000', 'Deduction', '2007-08-12 00:00:00', 'He stole client''s property', '2', 'Y');
INSERT INTO `guardfinance` VALUES (41, '3000', 'Bonus', '2008-03-18 00:00:00', 'He has expressed commitment to his job.', '', 'Y');
INSERT INTO `guardfinance` VALUES (42, '7000', 'Bonus', '2008-03-19 00:00:00', 'He has caught a thief that wasnt earlier seen.', '', 'Y');
INSERT INTO `guardfinance` VALUES (43, '2000', 'Deduction', '2008-03-19 00:00:00', 'He beat a neighbour''s dog', '2', 'Y');
INSERT INTO `guardfinance` VALUES (44, '10000', 'Bonus', '2008-03-19 00:00:00', 'He got us a new client', '', 'N');
INSERT INTO `guardfinance` VALUES (45, '5000', 'Bonus', '2008-03-19 00:00:00', 'he got us a new client', '', 'Y');
INSERT INTO `guardfinance` VALUES (46, '50000', 'Bonus', '2008-03-25 00:00:00', 'gud work always', '', 'Y');
INSERT INTO `guardfinance` VALUES (47, '40000', 'Bonus', '2008-04-08 00:00:00', 'hardworking', '', 'Y');
INSERT INTO `guardfinance` VALUES (48, '40000', 'Bonus', '2008-04-09 00:00:00', 'dd', '', 'Y');
INSERT INTO `guardfinance` VALUES (49, '50000', 'Bonus', '2008-02-10 00:00:00', 'He killed a robber who was caught red-handed.', '', 'Y');
INSERT INTO `guardfinance` VALUES (50, '34000', 'Bonus', '2008-07-25 00:00:00', 'He caught a thief', '', 'Y');
INSERT INTO `guardfinance` VALUES (51, '3500', 'Bonus', '2008-08-01 20:14:40', 'Sold leave on Overtime Duty', 'Sold Leave', 'Y');
INSERT INTO `guardfinance` VALUES (52, '', 'Bonus', '2008-08-01 20:14:40', 'Sold leave on Overtime Duty', 'Sold Leave', 'Y');
INSERT INTO `guardfinance` VALUES (53, '', 'Bonus', '2008-08-01 20:14:40', 'Sold leave on Overtime Duty', 'Sold Leave', 'Y');
INSERT INTO `guardfinance` VALUES (54, '', 'Bonus', '2008-08-01 20:14:40', 'Sold leave on Overtime Duty', 'Sold Leave', 'Y');
INSERT INTO `guardfinance` VALUES (55, '', 'Bonus', '2008-08-01 20:14:40', 'Sold leave on Overtime Duty', 'Sold Leave', 'Y');
INSERT INTO `guardfinance` VALUES (56, '45000', 'Bonus', '2008-08-01 20:14:40', 'Sold leave on Overtime Duty', 'Sold Leave', 'Y');
INSERT INTO `guardfinance` VALUES (57, '30000', 'Bonus', '2008-08-01 20:14:40', 'Sold leave on Overtime Duty', 'Sold Leave', 'Y');
INSERT INTO `guardfinance` VALUES (58, '200000', 'Bonus', '2008-08-01 20:14:40', 'Sold leave on Overtime Duty', 'Sold Leave', 'Y');
INSERT INTO `guardfinance` VALUES (59, '70000', 'Bonus', '2008-08-01 20:14:40', 'Sold leave on Overtime Duty', 'Sold Leave', 'Y');
INSERT INTO `guardfinance` VALUES (60, '200', 'Bonus', '2008-08-01 20:14:40', 'Sold leave on Overtime Duty', 'Sold Leave', 'Y');
INSERT INTO `guardfinance` VALUES (61, '50000', 'Bonus', '2008-08-01 20:14:40', 'Sold leave on Overtime Duty', 'Sold Leave', 'Y');
INSERT INTO `guardfinance` VALUES (62, '3500', 'Bonus', '2008-08-01 20:18:09', 'Sold leave on Overtime Duty', 'Sold Leave', 'Y');
INSERT INTO `guardfinance` VALUES (63, '', 'Bonus', '2008-08-01 20:18:10', 'Sold leave on Overtime Duty', 'Sold Leave', 'Y');
INSERT INTO `guardfinance` VALUES (64, '', 'Bonus', '2008-08-01 20:18:10', 'Sold leave on Overtime Duty', 'Sold Leave', 'Y');
INSERT INTO `guardfinance` VALUES (65, '', 'Bonus', '2008-08-01 20:18:10', 'Sold leave on Overtime Duty', 'Sold Leave', 'Y');
INSERT INTO `guardfinance` VALUES (66, '', 'Bonus', '2008-08-01 20:18:10', 'Sold leave on Overtime Duty', 'Sold Leave', 'Y');
INSERT INTO `guardfinance` VALUES (67, '45000', 'Bonus', '2008-08-01 20:18:10', 'Sold leave on Overtime Duty', 'Sold Leave', 'Y');
INSERT INTO `guardfinance` VALUES (68, '30000', 'Bonus', '2008-08-01 20:18:10', 'Sold leave on Overtime Duty', 'Sold Leave', 'Y');
INSERT INTO `guardfinance` VALUES (69, '200000', 'Bonus', '2008-08-01 20:18:10', 'Sold leave on Overtime Duty', 'Sold Leave', 'Y');
INSERT INTO `guardfinance` VALUES (70, '70000', 'Bonus', '2008-08-01 20:18:10', 'Sold leave on Overtime Duty', 'Sold Leave', 'Y');
INSERT INTO `guardfinance` VALUES (71, '200', 'Bonus', '2008-08-01 20:18:10', 'Sold leave on Overtime Duty', 'Sold Leave', 'Y');
INSERT INTO `guardfinance` VALUES (72, '50000', 'Bonus', '2008-08-01 20:18:10', 'Sold leave on Overtime Duty', 'Sold Leave', 'Y');
INSERT INTO `guardfinance` VALUES (73, '70000', 'Bonus', '2008-08-14 08:04:54', 'Sold leave on Normal Duty', 'Sold Leave', 'Y');
INSERT INTO `guardfinance` VALUES (74, '3500', 'Bonus', '2008-08-14 08:04:54', 'Sold leave on Overtime Duty', 'Sold Leave', 'Y');
INSERT INTO `guardfinance` VALUES (75, '', 'Bonus', '2008-08-14 08:04:54', 'Sold leave on Overtime Duty', 'Sold Leave', 'Y');
INSERT INTO `guardfinance` VALUES (76, '', 'Bonus', '2008-08-14 08:04:54', 'Sold leave on Overtime Duty', 'Sold Leave', 'Y');
INSERT INTO `guardfinance` VALUES (77, '', 'Bonus', '2008-08-14 08:04:55', 'Sold leave on Overtime Duty', 'Sold Leave', 'Y');
INSERT INTO `guardfinance` VALUES (78, '', 'Bonus', '2008-08-14 08:04:55', 'Sold leave on Overtime Duty', 'Sold Leave', 'Y');
INSERT INTO `guardfinance` VALUES (79, '45000', 'Bonus', '2008-08-14 08:04:55', 'Sold leave on Overtime Duty', 'Sold Leave', 'Y');
INSERT INTO `guardfinance` VALUES (80, '30000', 'Bonus', '2008-08-14 08:04:55', 'Sold leave on Overtime Duty', 'Sold Leave', 'Y');
INSERT INTO `guardfinance` VALUES (81, '200000', 'Bonus', '2008-08-14 08:04:55', 'Sold leave on Overtime Duty', 'Sold Leave', 'Y');
INSERT INTO `guardfinance` VALUES (82, '70000', 'Bonus', '2008-08-14 08:04:55', 'Sold leave on Overtime Duty', 'Sold Leave', 'Y');
INSERT INTO `guardfinance` VALUES (83, '200', 'Bonus', '2008-08-14 08:04:55', 'Sold leave on Overtime Duty', 'Sold Leave', 'Y');
INSERT INTO `guardfinance` VALUES (84, '50000', 'Bonus', '2008-08-14 08:04:55', 'Sold leave on Overtime Duty', 'Sold Leave', 'Y');
INSERT INTO `guardfinance` VALUES (85, '3500', 'Bonus', '2008-08-14 08:07:42', 'Sold leave on Overtime Duty', 'Sold Leave', 'Y');
INSERT INTO `guardfinance` VALUES (86, '', 'Bonus', '2008-08-14 08:07:42', 'Sold leave on Overtime Duty', 'Sold Leave', 'Y');
INSERT INTO `guardfinance` VALUES (87, '', 'Bonus', '2008-08-14 08:07:42', 'Sold leave on Overtime Duty', 'Sold Leave', 'Y');
INSERT INTO `guardfinance` VALUES (88, '', 'Bonus', '2008-08-14 08:07:42', 'Sold leave on Overtime Duty', 'Sold Leave', 'Y');
INSERT INTO `guardfinance` VALUES (89, '', 'Bonus', '2008-08-14 08:07:42', 'Sold leave on Overtime Duty', 'Sold Leave', 'Y');
INSERT INTO `guardfinance` VALUES (90, '45000', 'Bonus', '2008-08-14 08:07:42', 'Sold leave on Overtime Duty', 'Sold Leave', 'Y');
INSERT INTO `guardfinance` VALUES (91, '30000', 'Bonus', '2008-08-14 08:07:42', 'Sold leave on Overtime Duty', 'Sold Leave', 'Y');
INSERT INTO `guardfinance` VALUES (92, '200000', 'Bonus', '2008-08-14 08:07:42', 'Sold leave on Overtime Duty', 'Sold Leave', 'Y');
INSERT INTO `guardfinance` VALUES (93, '70000', 'Bonus', '2008-08-14 08:07:42', 'Sold leave on Overtime Duty', 'Sold Leave', 'Y');
INSERT INTO `guardfinance` VALUES (94, '200', 'Bonus', '2008-08-14 08:07:42', 'Sold leave on Overtime Duty', 'Sold Leave', 'Y');
INSERT INTO `guardfinance` VALUES (95, '50000', 'Bonus', '2008-08-14 08:07:42', 'Sold leave on Overtime Duty', 'Sold Leave', 'Y');
INSERT INTO `guardfinance` VALUES (96, '40000', 'Deduction', '2008-08-14 00:00:00', 'Uniform deposit installment for July 2008', '2', 'Y');
INSERT INTO `guardfinance` VALUES (97, '60000', 'Deduction', '2008-04-10 00:00:00', 'Uniform deposit for installment of april 2008', '2', 'N');
INSERT INTO `guardfinance` VALUES (98, '10300', 'Deduction', '2008-08-07 00:00:00', 'Debt deduction for month of April 08', '4', 'Y');
INSERT INTO `guardfinance` VALUES (99, '45000', 'Bonus', '2008-08-19 00:00:00', 'he slept on duty', '', 'Y');
INSERT INTO `guardfinance` VALUES (100, '45000', 'Bonus', '2008-08-19 00:00:00', 'he slept on duty', '', 'Y');
INSERT INTO `guardfinance` VALUES (101, '45000', 'Bonus', '2008-08-19 00:00:00', 'he slept on duty', '', 'Y');
INSERT INTO `guardfinance` VALUES (102, '45000', 'Bonus', '2008-08-19 00:00:00', 'he slept on duty', '', 'Y');
INSERT INTO `guardfinance` VALUES (103, '45000', 'Bonus', '2008-08-19 00:00:00', 'he slept on duty', '', 'Y');
INSERT INTO `guardfinance` VALUES (104, '45000', 'Bonus', '2008-08-19 00:00:00', 'he slept on duty', '1', 'Y');
INSERT INTO `guardfinance` VALUES (105, '600070', 'Bonus', '2008-08-19 00:00:00', 'He stole the owners gun.', '1', 'Y');
INSERT INTO `guardfinance` VALUES (106, '600070', 'Bonus', '2008-08-19 00:00:00', 'He stole the owners gun.', '1', 'Y');
INSERT INTO `guardfinance` VALUES (107, '600070', 'Bonus', '2008-08-19 00:00:00', 'He stole the owners gun.', '1', 'Y');
INSERT INTO `guardfinance` VALUES (108, '30700', 'Deduction', '2008-08-03 00:00:00', 'Uniform savings for July', '2', 'Y');

-- --------------------------------------------------------

-- 
-- Table structure for table `guardfinancestatus`
-- 

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

CREATE TABLE `guardresponseforms` (
  `id` bigint(20) NOT NULL auto_increment,
  `assignment` varchar(255) NOT NULL default '',
  `guard` varchar(255) NOT NULL default '',
  `commander` varchar(255) NOT NULL default '',
  `mobile` varchar(255) NOT NULL default '',
  `datecreated` date NOT NULL default '0000-00-00',
  `location` varchar(255) NOT NULL default '',
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=44 DEFAULT CHARSET=latin1 AUTO_INCREMENT=44 ;

-- 
-- Dumping data for table `guardresponseforms`
-- 

INSERT INTO `guardresponseforms` VALUES (21, 'Kamugisha', 'kamus', 'kamus', '4551', '2007-11-02', '');
INSERT INTO `guardresponseforms` VALUES (22, 'kk', 'kk', 'kk', '4341', '2007-11-02', '');
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

CREATE TABLE `guards` (
  `id` bigint(20) NOT NULL auto_increment,
  `guardid` varchar(255) default NULL,
  `photoname` varchar(100) default NULL,
  `personid` bigint(20) NOT NULL default '0',
  `fingerprintname` varchar(250) default NULL,
  `dateofemployment` date NOT NULL default '0000-00-00',
  `dateofexpiry` date NOT NULL default '0000-00-00',
  `jobtitle` varchar(100) NOT NULL default '',
  `contractstartdate` date default NULL,
  `contractenddate` date default NULL,
  `promotiondate` datetime default NULL,
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
  `uniformids` varchar(225) default NULL,
  `landlordid` bigint(20) NOT NULL default '0',
  `lc1letterprovided` enum('Y','N') NOT NULL default 'N',
  `medicalexaminationdone` enum('N','Y') NOT NULL default 'N',
  `documentsids` varchar(250) default NULL,
  `uniformprovided` enum('Y','N') NOT NULL default 'N',
  `isarchived` enum('Y','N') NOT NULL default 'N',
  `status` varchar(250) NOT NULL default '',
  `statusstartdate` datetime NOT NULL default '0000-00-00 00:00:00',
  `rate` varchar(250) NOT NULL default '',
  `overtimerate` varchar(250) NOT NULL default '',
  `nssfno` text NOT NULL,
  `tinno` text NOT NULL,
  `financialstatus` text NOT NULL,
  `leavedays` text NOT NULL,
  `lastpaymentdate` varchar(250) NOT NULL default '',
  `datecreated` date NOT NULL default '0000-00-00',
  `createdby` bigint(20) default NULL,
  `lastupdatedby` bigint(20) default NULL,
  `lastupdatedate` datetime NOT NULL default '0000-00-00 00:00:00',
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=41 DEFAULT CHARSET=latin1 COMMENT='InnoDB free: 4096 kB; InnoDB free: 3072 kB; InnoDB free: 307' AUTO_INCREMENT=41 ;

-- 
-- Dumping data for table `guards`
-- 

INSERT INTO `guards` VALUES (27, 'F554', 'photos/1205764415guardpic_1.jpg', 135, 'fingerprints/1199472646images8.jpg', '2008-02-02', '2010-03-02', '5', '2008-01-01', '2010-02-06', '2008-04-28 11:37:50', 0, 0, 146, 147, '74,75,76,77,81', '73,74,79', '75,76', '77,78', '26,17', '85,86', '84,89', '34,33,32', 85, 'Y', 'Y', '', 'Y', 'N', '7', '0000-00-00 00:00:00', '50000', '2000', 'T890833', 'T808-23993-234', '3,37,49,36,34', '30', '2008-01-03', '2007-11-09', 1, 1, '2008-07-16 15:01:27');
INSERT INTO `guards` VALUES (30, 'H117', 'photos/120479351342-16673255.jpg', 154, '', '2006-04-05', '2008-03-18', '1', '2008-02-03', '2010-02-03', NULL, 0, 0, 0, 0, '', '', '', '', '', '91', '97', '35,36,37,38,39', 98, '', '', '', 'Y', 'Y', '5', '0000-00-00 00:00:00', '2530', '5000', 'R523252', 'T908-23423-204', '40,39,43,34,36,38', '30', '2007-12-01 10:00:00', '2007-11-27', 1, 1, '2008-04-01 09:57:35');
INSERT INTO `guards` VALUES (31, 'T023', 'photos/1207114991images2.jpg', 155, 'fingerprints/1199470754images7.jpg', '2005-03-03', '2008-01-01', '2', '1999-11-30', '1999-11-30', '2008-04-28 11:37:50', 0, 0, 0, 0, '', '', '', '', '', '92', '99', '15,16,17,18,19', 100, '', '', '', 'Y', 'N', '7', '2008-07-04 15:43:50', '2000', '4000', 'R624324', 'R890-8923-890', '48,44', '30', '2008-01-01', '2007-11-27', 1, 1, '2008-04-09 13:52:07');
INSERT INTO `guards` VALUES (32, 'T012', 'photos/120479174642-16310901.jpg', 158, 'fingerprints/1202188495images8.jpg', '2008-02-18', '2009-11-17', '2', '2008-02-09', '2009-12-19', '2008-04-28 11:37:50', 160, 161, 162, 163, '82', '92', '90', '91', '28', '96', '107', '40,41,42,43', 108, 'Y', 'Y', '', 'Y', 'N', '7', '2008-08-14 08:04:54', '70000', '5000', 'Y890234', 'Y893-3455-789', '', '30', '2008-03-06', '2008-02-05', 1, 1, '2008-04-01 11:39:05');
INSERT INTO `guards` VALUES (33, 'W344', 'photos/120220663642-17803142.jpg', 159, '', '1992-10-17', '2008-04-29', '1', '2008-01-16', '2008-04-25', '2008-04-28 11:37:50', 0, 0, 0, 0, '', '', '', '', '30,33', '97', '109', '11,25,26', 110, 'Y', 'Y', '', 'Y', 'N', '7', '2008-08-01 20:04:36', '200000', '80000', 'T099823', 'T908-8934-432', '45,41,42,46', '60', '2008-03-07', '2008-02-05', 1, 1, '2008-04-10 09:42:03');
INSERT INTO `guards` VALUES (34, 'J201', 'photos/1207119381juli.jpg', 173, '', '2008-02-20', '2008-12-19', '3', '2008-01-13', '2008-11-01', '2008-04-28 11:37:50', 0, 0, 0, 0, '', '', '', '', '', '102', '129', '50,51,52', 130, 'Y', '', '', 'Y', 'N', '7', '2008-07-07 09:02:22', '30000', '5000', '', 'T893-8933-234', '50', '', '2008-05-06', '2008-04-01', 1, 1, '2008-04-30 11:53:23');
INSERT INTO `guards` VALUES (35, 'K903', 'photos/1207114956babel.jpg', 180, '', '2007-09-19', '2011-08-18', '3', '2008-07-14', '2011-07-07', '2008-04-28 11:37:50', 0, 0, 0, 0, '', '', '', '', '', '', '143', '53,54', 144, 'Y', 'Y', '', 'Y', 'N', '9', '2008-08-01 15:38:20', '45000', '4500', '', 'R893-3435-932', '47', '', '', '2008-04-01', 1, 1, '2008-04-07 17:40:01');
INSERT INTO `guards` VALUES (36, '123123', 'photos/1208756001Water_lilies.jpg', 181, '', '1990-02-19', '0000-00-00', '2', '0000-00-00', '0000-00-00', '2008-04-28 11:37:50', 0, 0, 0, 0, '', '', '', '', '', '106', '145', '', 146, '', '', '', '', 'N', '7', '2008-07-04 15:43:50', '', '', '', 'T902-3444-434', '', '', '', '2008-04-21', 1, NULL, '0000-00-00 00:00:00');
INSERT INTO `guards` VALUES (37, 'Y314', 'photos/1209810367Sunset.jpg', 182, '', '1992-03-02', '2009-01-12', '4', '2008-02-10', '2009-01-12', NULL, 0, 0, 0, 0, '', '', '', '', '', '109', '147', '', 148, '', '', '', '', 'N', '7', '2008-07-04 15:43:50', '', '', 'R99343', 'Y099-3433-344', '', '', '', '2008-05-03', 1, NULL, '0000-00-00 00:00:00');
INSERT INTO `guards` VALUES (38, 'T673', 'photos/1211295413funnygunners.jpg', 183, '', '2007-02-17', '0000-00-00', '', '0000-00-00', '0000-00-00', NULL, 0, 0, 0, 0, '', '', '', '', '', '110', '149', '', 150, '', '', '', 'N', 'N', '7', '2008-07-04 16:26:40', '', '', 'K00443', 'R999-3434-878', '', '', '', '2008-05-20', 1, 1, '2008-05-21 07:40:16');
INSERT INTO `guards` VALUES (39, 'S399', 'photos/1211346151AX067852.jpg', 184, '', '1990-05-17', '2009-04-02', '2', '0000-00-00', '0000-00-00', NULL, 0, 0, 0, 0, '', '', '', '', '', '111', '151', '', 152, '', '', '', 'N', 'N', '7', '2008-07-07 09:02:22', '', '', 'T89988', 'Y000-4534-455', '108,96,97,98', '', '', '2008-05-21', 1, 1, '2008-05-21 08:02:31');
INSERT INTO `guards` VALUES (40, 'R0004', 'photos/1214984442Water_lilies.jpg', 185, '', '2008-03-17', '0000-00-00', '', '0000-00-00', '0000-00-00', NULL, 0, 0, 0, 0, '', '', '', '', '', '112', '153', '69,75,72,74', 154, '', '', '', 'Y', 'Y', '7', '2008-08-01 15:38:20', '3500', '5000', '', 'Y000-4534-456', '104,107,98,97,96', '', '', '2008-07-02', 1, 1, '2008-07-02 15:23:34');

-- --------------------------------------------------------

-- 
-- Table structure for table `guardschedule`
-- 

CREATE TABLE `guardschedule` (
  `id` bigint(20) NOT NULL auto_increment,
  `schedule` text NOT NULL,
  `overtimeentry` text NOT NULL,
  `sitrepchecks` text NOT NULL,
  `dateentered` date NOT NULL default '0000-00-00',
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=131 DEFAULT CHARSET=latin1 AUTO_INCREMENT=131 ;

-- 
-- Dumping data for table `guardschedule`
-- 

INSERT INTO `guardschedule` VALUES (11, 'Y907=Leave,P0081=H312-D', 'Y907=,P0081=H457-K', '', '2008-01-30');
INSERT INTO `guardschedule` VALUES (12, 'Y907=H230-D,P0081=H312-D', 'Y907=H230-D,P0081=H312-D', '', '2008-01-31');
INSERT INTO `guardschedule` VALUES (20, 'Y907=KKK1-D,P0081=H312-D', 'H013=Leave,H117=,T023=KKK3-N,Y907=,F554=,P0081=Q444-N', '', '2008-02-01');
INSERT INTO `guardschedule` VALUES (21, 'H013=H300-N,H117=H300-N,T023=Q444-N,Y907=KKK1-D,F554=H300-N,P0081=H312-D', 'H013=,H117=,T023=,Y907=KKK0-D,F554=,P0081=', '', '2008-02-02');
INSERT INTO `guardschedule` VALUES (22, 'H013=H300-N,H117=KKK0-D,T023=Sick,Y907=Sick,F554=,P0081=Sick', 'T012=,W344=,H013=,H117=,Y907=,F554=,P0081=', '', '2008-02-05');
INSERT INTO `guardschedule` VALUES (23, 'H013=H230-D,H117=H230-D,T023=KKK1-D,Y907=Q444-N,F554=,P0081=H457-K', 'H013=,H117=,T023=,Y907=,F554=,P0081=', '', '2008-02-04');
INSERT INTO `guardschedule` VALUES (24, 'T012=,W344=K003-D,H013=D145-N,H117=D145-N,Y907=Sick,F554=,P0081=NBL01', 'T012=,W344=,H013=,H117=,Y907=,F554=,P0081=', '', '2008-02-06');
INSERT INTO `guardschedule` VALUES (25, 'T012=,W344=Sick,H013=D145-N,H117=D145-N,Y907=Sick,F554=NBL01,P0081=NBL01', 'T012=,W344=,H013=,H117=,Y907=,F554=,P0081=', '', '2008-02-07');
INSERT INTO `guardschedule` VALUES (26, 'T012=Sick,W344=Sick,H013=Sick,H117=NBL02,Y907=H313-N,F554=H457-K,P0081=H313-N', 'T012=,W344=,H013=,H117=,Y907=,F554=,P0081=', '', '2008-02-08');
INSERT INTO `guardschedule` VALUES (27, 'T012=Sick,W344=Leave,H013=NBL01,H117=H457-K,Y907=H457-K,F554=Sick,P0081=B666-H', 'T012=,W344=,H013=,H117=,Y907=,F554=,P0081=', '', '2008-02-11');
INSERT INTO `guardschedule` VALUES (28, 'T012=Sick,W344=D145-N,H013=KKK3-N,H117=H312-D,Y907=KKK1-D,F554=KKK1-D,P0081=H300-N', 'T012=,W344=,H013=,H117=,Y907=,F554=KKK1-D,P0081=', '', '2008-02-12');
INSERT INTO `guardschedule` VALUES (29, 'T012=Sick,W344=Sick,H013=H313-N,H117=H300-N,Y907=KKK3-N,F554=H230-D,P0081=H457-K', 'T012=,W344=B666-H,H013=,H117=KKK3-N,Y907=,F554=,P0081=', '', '2008-02-13');
INSERT INTO `guardschedule` VALUES (30, 'T012=Sick,W344=Sick,H013=H313-N,H117=H300-N,Y907=KKK3-N,F554=H230-D,P0081=Sick', 'T012=,W344=,H013=,H117=,Y907=,F554=,P0081=', '', '2008-02-14');
INSERT INTO `guardschedule` VALUES (31, 'T012=Sick,W344=Q444-N,H013=KKK0-D,H117=H313-N,Y907=D145-N,F554=KKK3-N,P0081=H300-N', 'T012=,W344=,H013=,H117=,Y907=,F554=,P0081=', '', '2008-02-18');
INSERT INTO `guardschedule` VALUES (32, 'T012=B666-H,W344=Rest,H013=Sick,H117=D145-N,Y907=KKK3-N,F554=H312-D,P0081=NBL01', 'T012=,W344=H312-D,H013=,H117=,Y907=,F554=,P0081=', '', '2008-02-17');
INSERT INTO `guardschedule` VALUES (33, 'T012=B666-H,W344=Rest,H013=Sick,H117=D145-N,Y907=KKK3-N,F554=H312-D,P0081=NBL01', 'T012=,W344=H312-D,H013=,H117=,Y907=,F554=,P0081=', '', '2008-02-18');
INSERT INTO `guardschedule` VALUES (34, 'T012=Rest,W344=K003-D,H117=Sick,F554=KKK1-D', 'T012=,W344=,H117=,F554=', '', '2008-03-12');
INSERT INTO `guardschedule` VALUES (35, 'T012=H300-N,W344=K003-D,H117=Sick,F554=NBL01', 'T012=,W344=D145-N,H117=NBL01,F554=', '', '2008-03-13');
INSERT INTO `guardschedule` VALUES (36, 'T012=H230-D,W344=K003-D,H117=KKK1-D,F554=utl100', 'T012=,W344=,H117=,F554=', '', '2008-03-14');
INSERT INTO `guardschedule` VALUES (37, 'T012=H230-D,W344=Absconded,H117=Sick,F554=utl100', 'T012=,W344=,H117=,F554=', '', '2008-03-17');
INSERT INTO `guardschedule` VALUES (38, 'T012=B666-H,W344=Absconded,H117=Sick,F554=Leave', 'T012=,W344=,H117=,F554=', '', '2008-03-17');
INSERT INTO `guardschedule` VALUES (39, 'T012=Leave,W344=Sick,H117=KKK1-D,F554=Police Custody', 'T012=,W344=,H117=,F554=', '', '2008-03-16');
INSERT INTO `guardschedule` VALUES (40, 'T012=H313-N,W344=H230-D,H117=Leave,F554=Sick', 'T012=,W344=H312-D,H117=,F554=H123', '', '2008-03-18');
INSERT INTO `guardschedule` VALUES (41, 'T012=Leave,W344=H312-D,H117=KKK1-D,F554=Leave', 'T012=,W344=,H117=,F554=', '', '2008-03-19');
INSERT INTO `guardschedule` VALUES (42, 'T012=H123,W344=UT01,H117=utl100,F554=Sick', 'T012=,W344=,H117=,F554=', '', '2008-03-28');
INSERT INTO `guardschedule` VALUES (43, 'J201=H457-K,T012=H123,W344=KKK3-N,T023=KKK1-D,F554=Sick', 'J201=H230-D,T012=,W344=,T023=,F554=', '', '2008-04-10');
INSERT INTO `guardschedule` VALUES (44, 'J201=H457-K,T012=Sick,W344=KKK3-N,T023=H230-D,F554=KKK1-D', 'J201=,T012=,W344=,T023=,F554=', '', '2008-04-11');
INSERT INTO `guardschedule` VALUES (45, 'J201=D145-N,T012=KKK1-D,W344=KKK3-N,T023=Sick,F554=NBL01', 'J201=,T012=,W344=,T023=,F554=', '', '2008-04-14');
INSERT INTO `guardschedule` VALUES (46, '123123=D145-N,J201=H457-K,K903=Leave,T012=Leave,W344=Leave,T023=KKK1-D,F554=KKK3-N', '123123=,J201=,K903=,T012=,W344=,T023=,F554=', '', '2008-04-28');
INSERT INTO `guardschedule` VALUES (47, 'K903=KKK1-D,123123=,T012=STB1,W344=UT01,J201=Rest,Y314=utl100,T023=UT01,F554=', '', '', '2008-05-05');
INSERT INTO `guardschedule` VALUES (48, 'K903=KKK1-D,123123=,T012=STB1,W344=UT01,J201=H312-D,Y314=utl100,T023=UT01,F554=KKK0-D', '', '', '2008-05-06');
INSERT INTO `guardschedule` VALUES (49, 'K903=Rest,123123=,T012=STB1,W344=UT01,J201=H312-D,Y314=utl100,T023=UT01,F554=', '', '', '2008-05-07');
INSERT INTO `guardschedule` VALUES (50, 'K903=KKK1-D,123123=,T012=STB1,W344=UT01,J201=H312-D,Y314=utl100,T023=UT01,F554=STB1', '', '', '2008-05-08');
INSERT INTO `guardschedule` VALUES (51, 'K903=,123123=,T012=Rest,W344=UT01,J201=H312-D,Y314=Rest,T023=UT01,F554=utl100', '', '', '2008-05-09');
INSERT INTO `guardschedule` VALUES (52, 'K903=,123123=,T012=STB1,W344=Rest,J201=H312-D,Y314=utl100,T023=Rest,F554=UT01', '', '', '2008-05-10');
INSERT INTO `guardschedule` VALUES (53, 'K903=,123123=Rest,T012=STB1,W344=UT01,J201=H312-D,Y314=utl100,T023=UT01,F554=Rest', '', '', '2008-05-11');
INSERT INTO `guardschedule` VALUES (102, 'Y314=Rest,123123=KKK0-D,J201=,K903=STB1,T012=UT01,W344=', '', '', '2008-05-12');
INSERT INTO `guardschedule` VALUES (103, 'Y314=,123123=Rest,T023=KKK0-D,J201=,K903=STB1,T012=UT01,W344=', '', '', '2008-05-13');
INSERT INTO `guardschedule` VALUES (104, 'Y314=,123123=KKK0-D,J201=Rest,K903=STB1,T012=UT01,W344=', '', '', '2008-05-14');
INSERT INTO `guardschedule` VALUES (105, 'Y314=,123123=,J201=,K903=Rest,T023=STB1,T012=UT01,W344=', '', '', '2008-05-15');
INSERT INTO `guardschedule` VALUES (106, 'Y314=,123123=,J201=,K903=STB1,T012=Rest,T023=UT01,W344=', '', '', '2008-05-16');
INSERT INTO `guardschedule` VALUES (107, 'Y314=,123123=,J201=,K903=STB1,T012=UT01,W344=Rest', '', '', '2008-05-17');
INSERT INTO `guardschedule` VALUES (108, 'Y314=,123123=,J201=,K903=STB1,T012=UT01,W344=,T023=Rest', '', '', '2008-05-18');
INSERT INTO `guardschedule` VALUES (109, 'Y314=Leave,123123=KKK1-D,J201=utl100,K903=H457-K,T012=utl100,W344=T903,T023=Absent,F554=D145-N', 'Y314=,123123=,J201=,K903=,T012=,W344=,T023=,F554=', '123123=Y-Y-Y-Y--,K903=Y--Y-Y-Y-Y,W344=Y--Y-Y--,F554=-----Y', '2008-05-20');
INSERT INTO `guardschedule` VALUES (110, 'Y314=KKK1-D,J201=utl100,T012=utl100,W344=T903', '', '', '2008-05-19');
INSERT INTO `guardschedule` VALUES (111, 'Y314=KKK1-D,J201=Rest,123123=utl100,T012=Rest,123123=utl100,W344=T903', '', '', '2008-05-21');
INSERT INTO `guardschedule` VALUES (112, 'Y314=KKK1-D,J201=utl100,T012=utl100,W344=T903', '', '', '2008-05-22');
INSERT INTO `guardschedule` VALUES (113, 'Y314=KKK1-D,J201=utl100,T012=utl100,W344=T903', '', '', '2008-05-23');
INSERT INTO `guardschedule` VALUES (114, 'Y314=KKK1-D,J201=utl100,T012=utl100,W344=Rest,123123=T903', '', '', '2008-05-24');
INSERT INTO `guardschedule` VALUES (115, 'Y314=KKK1-D,J201=utl100,T012=utl100,W344=T903,123123=Rest', '', '', '2008-05-25');
INSERT INTO `guardschedule` VALUES (116, 'S399=H230-D,T673=Leave,Y314=KKK3-N,123123=H123,K903=KKK3-N,J201=Police Custody,W344=Leave,T012=Sick,T023=Sick,F554=H457-K', 'S399=,T673=,Y314=,123123=,K903=,J201=,W344=,T012=,T023=,F554=', '', '2008-05-29');
INSERT INTO `guardschedule` VALUES (117, 'R0004=H123,S399=,T673=KKK1-D,Y314=Leave,123123=Absent,K903=KKK3-N,J201=,W344=Z123,T012=,T023=,F554=', 'R0004=,S399=,T673=,Y314=,123123=,K903=,J201=,W344=,T012=,T023=,F554=', '', '2008-07-02');
INSERT INTO `guardschedule` VALUES (118, 'R0004=,S399=Absent,T673=,Y314=,123123=,K903=Leave,J201=,W344=Leave,T012=Leave,T023=KKK3-N,F554=H123', 'R0004=,S399=,T673=,Y314=,123123=,K903=,J201=,W344=,T012=,T023=,F554=', '', '2008-07-04');
INSERT INTO `guardschedule` VALUES (119, 'R0004=Sick,S399=NBL01,T673=utl100,Y314=F903,123123=Z002,K903=UT004,J201=Z002,W344=H457-K,T012=Leave,T023=Z123,F554=KKK1-D', 'R0004=,S399=,T673=,Y314=,123123=,K903=,J201=,W344=,T012=,T023=,F554=', '', '2008-07-07');
INSERT INTO `guardschedule` VALUES (121, 'R0004=Z123,S399=NBL01,T673=,Y314=utl100,123123=,K903=Leave,J201=T903,W344=Z002,T012=Leave,T023=Z002,F554=Z123', 'R0004=,S399=,T673=,Y314=,123123=,K903=,J201=,W344=,T012=,T023=,F554=', '', '2008-08-01');
INSERT INTO `guardschedule` VALUES (122, 'R0004=,S399=NBL01,T673=UT004,Y314=T903,123123=Z123,K903=Leave,J201=Z123,W344=NBL01,T012=Z123,T023=Z123,F554=Z123', 'R0004=,S399=,T673=,Y314=,123123=,K903=,J201=,W344=,T012=,T023=,F554=', '', '2008-08-14');
INSERT INTO `guardschedule` VALUES (123, 'R0004=,S399=NBL01,T673=UT004,Y314=T903,123123=Z123,K903=Leave,J201=Z123,W344=NBL01,T012=Z123,T023=Z123,F554=Z123', 'R0004=,S399=,T673=,Y314=,123123=,K903=,J201=,W344=,T012=,T023=,F554=', '', '2008-08-14');
INSERT INTO `guardschedule` VALUES (124, '=Test', '', '', '2012-06-04');
INSERT INTO `guardschedule` VALUES (125, 'opio=Test', '', '', '2012-06-05');
INSERT INTO `guardschedule` VALUES (126, 'opio=Test', '', '', '2012-06-06');
INSERT INTO `guardschedule` VALUES (127, 'opio=Test', '', '', '2012-06-07');
INSERT INTO `guardschedule` VALUES (128, 'opio=Test', '', '', '2012-06-08');
INSERT INTO `guardschedule` VALUES (129, 'opio=Test', '', '', '2012-06-09');
INSERT INTO `guardschedule` VALUES (130, 'opio=Test', '', '', '2012-06-10');

-- --------------------------------------------------------

-- 
-- Table structure for table `guardstatus`
-- 

CREATE TABLE `guardstatus` (
  `id` bigint(20) NOT NULL auto_increment,
  `status` varchar(250) NOT NULL default '',
  `statusvalue` varchar(250) NOT NULL default '',
  `date_of_entry` datetime NOT NULL default '0000-00-00 00:00:00',
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1 AUTO_INCREMENT=12 ;

-- 
-- Dumping data for table `guardstatus`
-- 

INSERT INTO `guardstatus` VALUES (1, 'Sick', '/SICK', '2007-11-28 21:02:12');
INSERT INTO `guardstatus` VALUES (2, 'Dismissed', '/DISMISSED', '2007-11-28 21:04:21');
INSERT INTO `guardstatus` VALUES (5, 'Absconded', '/ABSCONDED', '2007-11-28 00:00:00');
INSERT INTO `guardstatus` VALUES (7, 'On Duty', '', '2008-01-07 10:00:44');
INSERT INTO `guardstatus` VALUES (8, 'Absent', '/ABSENT', '2008-01-30 00:00:00');
INSERT INTO `guardstatus` VALUES (9, 'Leave', '/LEAVE', '2008-01-25 00:00:00');
INSERT INTO `guardstatus` VALUES (10, 'Police Custody', '/POLICE CUSTODY', '2008-01-15 00:00:00');
INSERT INTO `guardstatus` VALUES (11, 'Rest', '/REST', '2008-01-18 00:00:00');

-- --------------------------------------------------------

-- 
-- Table structure for table `guardstatustrack`
-- 

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
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=latin1 AUTO_INCREMENT=18 ;

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
INSERT INTO `guardstatustrack` VALUES (9, 'T023', 'Active', '', 'He has been down with Malaria but he has fully recovered.', '2008-02-01 00:00:00', '0000-00-00 00:00:00', 'F554', '2008-01-17 12:01:10');
INSERT INTO `guardstatustrack` VALUES (10, 'T023', 'Active', '', 'He has been down with Malaria but he has fully recovered.', '2008-01-01 00:00:00', '0000-00-00 00:00:00', 'F554', '2008-01-25 16:36:17');
INSERT INTO `guardstatustrack` VALUES (11, 'T012', 'Active', '', '', '2008-02-15 00:00:00', '0000-00-00 00:00:00', 'F554', '2008-01-28 13:51:40');
INSERT INTO `guardstatustrack` VALUES (12, 'W344', 'Leave', '', 'Leave is due', '2008-03-01 00:00:00', '0000-00-00 00:00:00', 'F554', '2008-02-05 16:05:36');
INSERT INTO `guardstatustrack` VALUES (13, 'W344', 'Sick', 'Headache', 'Got a hedek while on duty', '2008-02-06 00:00:00', '2008-02-09 00:00:00', 'W344', '2008-02-07 14:55:47');
INSERT INTO `guardstatustrack` VALUES (14, 'T012', 'On Duty', '', 'Active', '2008-02-11 00:00:00', '0000-00-00 00:00:00', 'Y907', '2008-02-11 09:23:36');
INSERT INTO `guardstatustrack` VALUES (15, 'T012', 'Sick', 'Yellow Fever', '', '1991-02-17 00:00:00', '0000-00-00 00:00:00', 'W344', '2008-02-11 13:07:54');
INSERT INTO `guardstatustrack` VALUES (16, 'P0081', 'Sick', 'Headache', 'He has got a small headache but he will fine soon', '2008-02-14 00:00:00', '2008-02-15 00:00:00', 'F554', '2008-02-14 12:15:39');
INSERT INTO `guardstatustrack` VALUES (17, 'W344', 'Sick', 'Malaria', '', '2008-02-01 00:00:00', '0000-00-00 00:00:00', 'F554', '2008-02-14 12:17:14');

-- --------------------------------------------------------

-- 
-- Table structure for table `helpsection`
-- 

CREATE TABLE `helpsection` (
  `id` bigint(20) NOT NULL auto_increment,
  `step` varchar(250) NOT NULL default '',
  `details` text NOT NULL,
  `substeps` text NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=112 DEFAULT CHARSET=latin1 AUTO_INCREMENT=112 ;

-- 
-- Dumping data for table `helpsection`
-- 

INSERT INTO `helpsection` VALUES (1, '1.', 'Logging on to SmartGuard', '1,2,18,19,33,34,35,36,37,38,39,40');
INSERT INTO `helpsection` VALUES (2, '2.', 'Registering new users', '20,21,22,23,24,25,26,27');
INSERT INTO `helpsection` VALUES (4, '3.', 'Creating user groups', '41,42,43,44,45,46,47,48,49,50,51');
INSERT INTO `helpsection` VALUES (5, '11.', 'Registering leave application', '28,29,30,31,32');
INSERT INTO `helpsection` VALUES (6, '4.', 'Managing user accounts', '52,53,54,56,58,59,61,62');
INSERT INTO `helpsection` VALUES (7, '5.', 'Editing user details', '63,64,65,66,67');
INSERT INTO `helpsection` VALUES (8, '6.', 'Managing guards', '68,69,70,71,72,73,74,75,76,77,78,79,80');
INSERT INTO `helpsection` VALUES (9, '7.', 'Creating a new guard', '81,82,83,84,85');
INSERT INTO `helpsection` VALUES (10, '8.', 'Editing guard''s details', '86,87,88,89');
INSERT INTO `helpsection` VALUES (11, '9.', 'Changing the guard''s status', '90,91,92,93');
INSERT INTO `helpsection` VALUES (12, '10.', 'Manage leave applications', '94,95,96,97,98,99,100,101,102,103');
INSERT INTO `helpsection` VALUES (13, '12.', 'Editing leave application', '104,105,106,107');
INSERT INTO `helpsection` VALUES (14, '13.', 'Changing status of leave application', '108,109,110,111');
INSERT INTO `helpsection` VALUES (15, '14', 'Tracking guard discipline', '112,113,114,115,116,117,118,119,120');
INSERT INTO `helpsection` VALUES (16, '15.', 'Creating New personnel file', '121,122,123,124,125');
INSERT INTO `helpsection` VALUES (17, '16', 'Editing personnel file', '126,127,128,129');
INSERT INTO `helpsection` VALUES (18, '17.', 'Generating client report', '130,131,132,133,134,135,136,137,138,139,140,141,142');
INSERT INTO `helpsection` VALUES (19, '18.', 'Guard Payroll Report', '143,144,145,146,147,148,149,150,151,152,153');
INSERT INTO `helpsection` VALUES (20, '19', 'Managing client payment status', '154,157,158,159,160,161,162,164');
INSERT INTO `helpsection` VALUES (21, '20.', 'Managing rates', '165,166,167,168,169');
INSERT INTO `helpsection` VALUES (22, '21.', 'Editing Client Rates', '170,171,172,173,174,175,176');
INSERT INTO `helpsection` VALUES (23, '22.', 'Editing guard rates', '177,178,179,180,181,182,183,184');
INSERT INTO `helpsection` VALUES (24, '23.', 'PAYE Schedule', '185,186,187,188,189,190,191,192');
INSERT INTO `helpsection` VALUES (25, '24.', 'NSSF Schedule', '193,194,195,196,197,198,199,200,201');
INSERT INTO `helpsection` VALUES (26, '25.', 'Editing NSSF schedule', '202,203,204,205');
INSERT INTO `helpsection` VALUES (27, '26', 'Guard''s financial status', '206,207,208,209,210,211,212,213,214,215');
INSERT INTO `helpsection` VALUES (28, '27', 'Managing assignment overtime', '216,217,218,219,220,221,222,223,224,225');
INSERT INTO `helpsection` VALUES (29, '28', 'Managing assignments', '226,227,228,229,230,231,232,233,234,235,236,237');
INSERT INTO `helpsection` VALUES (30, '29', 'Creating new assignment', '238,239,240,241,242,243,244,245,246,247,248,249,250,251,252');
INSERT INTO `helpsection` VALUES (31, '30.', 'Posting overtime', '253,254,255,256,257,258');
INSERT INTO `helpsection` VALUES (32, '31.', 'Posting replacement', '259,260,261,262,263,264');
INSERT INTO `helpsection` VALUES (33, '32', 'Client schedules', '265,266,267,268,269,270,271');
INSERT INTO `helpsection` VALUES (34, '33', 'Managing incidents', '272,273,274,275,276,277,278,279,280,281');
INSERT INTO `helpsection` VALUES (35, '34.', 'Creating new incident', '282,284,285,286,287,288,289,290,291,292');
INSERT INTO `helpsection` VALUES (36, '35.', 'Managing actions on incidents', '293,294,295,296');
INSERT INTO `helpsection` VALUES (37, '36.', 'Managing clients', '297,298,299,300,301,302,303,304,305,306,307');
INSERT INTO `helpsection` VALUES (38, '37.', 'Creating new client', '308,309,310,311');
INSERT INTO `helpsection` VALUES (39, '38', 'Managing regions', '312,313,314,315,316,317,318,319,320');
INSERT INTO `helpsection` VALUES (40, '39.', 'Creating a new region', '321,322,323,324,325,326,327');
INSERT INTO `helpsection` VALUES (41, '40.', 'Viewing active guards', '328,329,330,331,332,333');
INSERT INTO `helpsection` VALUES (42, '41.', 'Viewing sick guards', '334,335,336,337,338,339');
INSERT INTO `helpsection` VALUES (43, '42.', 'Managing inventory stock', '340,341,342,343,344,345,346,347,348');
INSERT INTO `helpsection` VALUES (44, '43.', 'Registering items in the inventory', '349,350,351,352,353,354,355');
INSERT INTO `helpsection` VALUES (45, '44.', 'Editing item in inventory', '356,357,358,359');
INSERT INTO `helpsection` VALUES (46, '45.', 'Deleting item in inventory', '360,361,362,363');
INSERT INTO `helpsection` VALUES (47, '46.', 'Searching for item in inventory', '364,365,366,367');
INSERT INTO `helpsection` VALUES (48, '47.', 'Managing item issues', '368,369,370,371,372,373,374,375,376');
INSERT INTO `helpsection` VALUES (49, '48.', 'Editing issued items', '377,378,379,380');
INSERT INTO `helpsection` VALUES (50, '49.', 'Adding item issues', '381,382,383,384,385,386,387,388,389,390');
INSERT INTO `helpsection` VALUES (51, '50.', 'Managing item returns', '391,392,393,394,395,396,397,398,399');
INSERT INTO `helpsection` VALUES (52, '51.', 'Returning an item', '400,401,402,403,404,405,406,407,408,409');
INSERT INTO `helpsection` VALUES (53, '52.', 'Reports for stock items', '410,411,412,413,414,415,416,417,418,419,420');
INSERT INTO `helpsection` VALUES (54, '53.', 'Reminders', '421,422,423,424,425,426,427,428');
INSERT INTO `helpsection` VALUES (55, '54.', 'Sending a request', '429,430,431,432,433,434,435');
INSERT INTO `helpsection` VALUES (56, '55.', 'Viewing user''s profile', '436,437,438,439,440');
INSERT INTO `helpsection` VALUES (57, '56.', 'Editing user profile', '442,443,444,445');
INSERT INTO `helpsection` VALUES (58, '57.', 'Updating favorites section', '446,447,448,449,450,451,452,453,454,455');
INSERT INTO `helpsection` VALUES (59, '58.', 'PAYE Fomulae', '456,457,458,459,460');
INSERT INTO `helpsection` VALUES (60, '59.', 'Leave Type', '461,462,463,464,465');
INSERT INTO `helpsection` VALUES (61, '60.', 'Creating new leave type', '466,467,468,469');
INSERT INTO `helpsection` VALUES (62, '61.', 'Deleting leave type', '470,471,472,473');
INSERT INTO `helpsection` VALUES (63, '62.', 'Districts', '474,475,476,477,478');
INSERT INTO `helpsection` VALUES (64, '63', 'Creating new district', '479,480,481,482');
INSERT INTO `helpsection` VALUES (65, '64.', 'Editing District', '483,484,485,486');
INSERT INTO `helpsection` VALUES (66, '65.', 'Deleting Districts', '487,488,489,490');
INSERT INTO `helpsection` VALUES (67, '66.', 'Tribes', '491,492,493,494,495');
INSERT INTO `helpsection` VALUES (68, '67', 'Creating new tribes', '496,497,498,499');
INSERT INTO `helpsection` VALUES (69, '68.', 'Editing tribes', '500,501,502,503');
INSERT INTO `helpsection` VALUES (70, '69.', 'Deleting tribes', '504,505,506,507');
INSERT INTO `helpsection` VALUES (71, '70.', 'Managing user rights ', '508,509,510,511,512');
INSERT INTO `helpsection` VALUES (72, '71.', 'Creating new user rights', '513,514,515,516');
INSERT INTO `helpsection` VALUES (73, '72.', 'Editing user rights', '517,518,519');
INSERT INTO `helpsection` VALUES (74, '73.', 'Deleting user rights', '520,521,522,523,524');
INSERT INTO `helpsection` VALUES (75, '74.', 'Managing disciplinary actions', '525,526,527,528,529');
INSERT INTO `helpsection` VALUES (76, '75.', 'Creating new Disciplinary Actions', '530,531,532,533');
INSERT INTO `helpsection` VALUES (77, '76.', 'Editing disciplinary action', '534,535,536');
INSERT INTO `helpsection` VALUES (78, '77.', 'Deleting disciplinary action', '537,538,539,540');
INSERT INTO `helpsection` VALUES (79, '78.', 'Managing service types', '541,542,543,544,545');
INSERT INTO `helpsection` VALUES (80, '80.', 'Editing service types', '546,547,548');
INSERT INTO `helpsection` VALUES (81, '81.', 'Deleting service types', '549,550,551,552,553');
INSERT INTO `helpsection` VALUES (82, '82.', 'Managing item types', '554,555,556,557,558');
INSERT INTO `helpsection` VALUES (83, '83.', 'Creating new item types', '559,560,561,562,563');
INSERT INTO `helpsection` VALUES (84, '84.', 'Editing item type ', '564,565,566,567');
INSERT INTO `helpsection` VALUES (85, '85.', 'Deleting item types', '568,569,570,571,572');
INSERT INTO `helpsection` VALUES (86, '86.', 'Managing item status', '573,574,575,576,577');
INSERT INTO `helpsection` VALUES (87, '87.', 'Creating new item status', '578,579,580,581');
INSERT INTO `helpsection` VALUES (88, '88.', 'Editing item status', '582,583,584,585');
INSERT INTO `helpsection` VALUES (89, '89.', 'Deleting item status', '586,587,588,589,590');
INSERT INTO `helpsection` VALUES (90, '90.', 'Managing guard status', '591,592,593,594,595');
INSERT INTO `helpsection` VALUES (91, '91.', 'Creating new guard status', '596,597,598,599');
INSERT INTO `helpsection` VALUES (92, '92.', 'Editing guard status', '600,601,602,603');
INSERT INTO `helpsection` VALUES (93, '93.', 'Deleting guard status', '604,605,606,607,608');
INSERT INTO `helpsection` VALUES (94, '94.', 'Fuel Distribution', '609,610,611,612,613,614,615,616,617,618,619');
INSERT INTO `helpsection` VALUES (95, '95.', 'Adding fuel distribution report', '620,621,622,623,624,625,626,627');
INSERT INTO `helpsection` VALUES (96, '96.', 'Editing fuel distribution report', '628,629,630,631');
INSERT INTO `helpsection` VALUES (97, '97.', 'Deleting fuel distribution report', '632,633,634,635');
INSERT INTO `helpsection` VALUES (98, '98.', 'Vehicle Service', '636,637,638,639,640,641,642,643,644,645,646');
INSERT INTO `helpsection` VALUES (99, '99.', 'Adding a service report', '647,648,649,650,651,652,653,654');
INSERT INTO `helpsection` VALUES (100, '100.', 'Editing vehicle service report', '655,656,657,658');
INSERT INTO `helpsection` VALUES (101, '101.', 'Deleting vehicle service report', '659,660,661,662');
INSERT INTO `helpsection` VALUES (102, '102.', 'Vehicle logbook', '663,664,665,666,667,668,669,670,671,672,673,674,675,676,677,678,679,680,681,682,683,684,685');
INSERT INTO `helpsection` VALUES (103, '103.', 'Managing Alarms', '686,687,688,689,690,691,692,693,694,695');
INSERT INTO `helpsection` VALUES (104, '104.', 'Adding Alarms', '696,697,698,699,700,701,702');
INSERT INTO `helpsection` VALUES (105, '105.', 'Serviced Alarms', '703,704');
INSERT INTO `helpsection` VALUES (106, '106.', 'Decommissioned Alarms', '705,706');
INSERT INTO `helpsection` VALUES (107, '107', 'Transferring alarms', '707,708,709,710,711');
INSERT INTO `helpsection` VALUES (108, '108.', 'Transferred Alarms', '712,713');
INSERT INTO `helpsection` VALUES (109, '109.', 'Managing Schedules', '714,715,716,717,718,719,720');
INSERT INTO `helpsection` VALUES (110, '110.', 'Previous schedules', '721,722,723');
INSERT INTO `helpsection` VALUES (111, '111.', 'Editing or Creating schedules', '724,725,726,727,728,729,730,731');

-- --------------------------------------------------------

-- 
-- Table structure for table `helpsubsection`
-- 

CREATE TABLE `helpsubsection` (
  `id` bigint(20) NOT NULL auto_increment,
  `step` varchar(250) NOT NULL default '',
  `details` text NOT NULL,
  `imageURL` text NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=732 DEFAULT CHARSET=latin1 AUTO_INCREMENT=732 ;

-- 
-- Dumping data for table `helpsubsection`
-- 

INSERT INTO `helpsubsection` VALUES (1, 'a.', 'Enter your username in the username field', '');
INSERT INTO `helpsubsection` VALUES (2, 'b.', 'Enter your password in the password field', '');
INSERT INTO `helpsubsection` VALUES (18, 'c', '', 'helpimages/1200294145login.jpg');
INSERT INTO `helpsubsection` VALUES (19, 'c.', 'Click Login to login to SmartGuard', '');
INSERT INTO `helpsubsection` VALUES (20, 'a', '', 'helpimages/1200296160usergrp.jpg');
INSERT INTO `helpsubsection` VALUES (21, 'a.', 'Go to Dashboard', '');
INSERT INTO `helpsubsection` VALUES (22, 'b.', 'On Your Favorites menu under HR, click Register New User.', '');
INSERT INTO `helpsubsection` VALUES (23, 'c.', 'The form below will be displayed.', '');
INSERT INTO `helpsubsection` VALUES (24, 'd', '', 'helpimages/1200295272newuser2.jpg');
INSERT INTO `helpsubsection` VALUES (25, 'd.', 'Enter the fields in the form displayed. Fields marked with a * all required. ', '');
INSERT INTO `helpsubsection` VALUES (26, 'e.', 'You can add the user to a group and set the user''s status to either Active - meaning the user can access the system, or Not Active - meaning the user cannot access the system at registration.', '');
INSERT INTO `helpsubsection` VALUES (27, 'f.', 'Then click on the Create button to create the user.', '');
INSERT INTO `helpsubsection` VALUES (28, 'a.	', 'Click on Register Leave Application button', '');
INSERT INTO `helpsubsection` VALUES (29, 'b.	', 'The form below is displayed', '');
INSERT INTO `helpsubsection` VALUES (30, 'c', '', 'helpimages/1200302526register_leave.jpg');
INSERT INTO `helpsubsection` VALUES (31, 'c.', 'Fill in the form and the fields marked with * are all required', '');
INSERT INTO `helpsubsection` VALUES (32, 'd.	', 'Click on Save to add the leave application for the guard.', '');
INSERT INTO `helpsubsection` VALUES (33, 'd.', 'If your username and password are correct, you will be redirected to the Dashboard where you can perform others tasks depending on the rights you have.', '');
INSERT INTO `helpsubsection` VALUES (34, 'e.', 'If your username and/or password is/are wrong, you will be prompted to enter them again.', '');
INSERT INTO `helpsubsection` VALUES (35, 'f.', 'If you have forgotten you password, click on the link Forgot Password. The screen below is displayed.', '');
INSERT INTO `helpsubsection` VALUES (36, 'g', '', 'helpimages/1200294455forgotpass.jpg');
INSERT INTO `helpsubsection` VALUES (37, 'g.', 'Enter your username and click "Send To Admin" ', '');
INSERT INTO `helpsubsection` VALUES (38, 'h.', 'If you enter a wrong username, you will get a message "Sorry. There is no registered user with that username."', '');
INSERT INTO `helpsubsection` VALUES (39, 'i.', 'If you enter a correct username and send, you will receive a message "The username has been sent. Please allow some time for the admin to respond. Check your registered email for the response."', '');
INSERT INTO `helpsubsection` VALUES (40, 'j.', 'The admin will send you a new password to your registered email address.', '');
INSERT INTO `helpsubsection` VALUES (41, 'a.', 'Go to Settings', '');
INSERT INTO `helpsubsection` VALUES (42, 'b', '', 'helpimages/1200296400usergrp.jpg');
INSERT INTO `helpsubsection` VALUES (43, 'b.	', 'Click on Manage User Groups. ', '');
INSERT INTO `helpsubsection` VALUES (44, 'c.', 'The interface below will be displayed.', '');
INSERT INTO `helpsubsection` VALUES (45, 'd', '', 'helpimages/1200296540usergrp2.jpg');
INSERT INTO `helpsubsection` VALUES (46, 'd.', 'Click on Create New Group. The following screen will be displayed', '');
INSERT INTO `helpsubsection` VALUES (47, 'e', '', 'helpimages/1200296685usergrp3.jpg');
INSERT INTO `helpsubsection` VALUES (48, 'e.', 'Enter the group name', '');
INSERT INTO `helpsubsection` VALUES (49, 'f.', 'Add the rights for that group', '');
INSERT INTO `helpsubsection` VALUES (50, 'g.', 'Enter the description of the group', '');
INSERT INTO `helpsubsection` VALUES (51, 'h.', 'Click on Save to add the group', '');
INSERT INTO `helpsubsection` VALUES (52, 'a.', 'Go to Dashboard ', '');
INSERT INTO `helpsubsection` VALUES (53, 'b', '', 'helpimages/1200297070userac.jpg');
INSERT INTO `helpsubsection` VALUES (54, 'b.', 'Under Administration and Human Resources, click Manage user accounts. ', '');
INSERT INTO `helpsubsection` VALUES (56, 'c.', 'The screen below will be displayed.', '');
INSERT INTO `helpsubsection` VALUES (58, 'd', '', 'helpimages/1200298009userac2.jpg');
INSERT INTO `helpsubsection` VALUES (59, 'd.', 'Click on Delete to delete the user.', '');
INSERT INTO `helpsubsection` VALUES (61, 'e.', 'Click on Edit to edit the user''s details.', '');
INSERT INTO `helpsubsection` VALUES (62, 'f.', 'Click on the user''s name to view the user''s profile.', '');
INSERT INTO `helpsubsection` VALUES (63, 'a.', 'Click on the Edit link of the user whose details you want to edit.', '');
INSERT INTO `helpsubsection` VALUES (64, 'b.', 'In the form displayed, make the necessary changes', '');
INSERT INTO `helpsubsection` VALUES (65, 'c', '', 'helpimages/1200298512user.jpg');
INSERT INTO `helpsubsection` VALUES (66, 'c.', 'You can assign the user to a group by clicking on the User Group dropdown.', '');
INSERT INTO `helpsubsection` VALUES (67, 'd.', 'Click on Create to save the changes.', '');
INSERT INTO `helpsubsection` VALUES (68, 'a.', 'Go to Dashboard ', '');
INSERT INTO `helpsubsection` VALUES (69, 'b.', 'Under Administration and Human Resources, click Manage guard details.', '');
INSERT INTO `helpsubsection` VALUES (70, 'c', '', 'helpimages/1200299139managequards.jpg');
INSERT INTO `helpsubsection` VALUES (71, 'c.', 'The screen below will be displayed.', '');
INSERT INTO `helpsubsection` VALUES (72, 'd', '', 'helpimages/1200299361manageguard2.jpg');
INSERT INTO `helpsubsection` VALUES (73, 'i.', 'Click on Create New Guard button to create a new guard.', '');
INSERT INTO `helpsubsection` VALUES (74, 'ii.', 'To search for a guard, enter the search item in this field. Click here to search for a guard.', '');
INSERT INTO `helpsubsection` VALUES (75, 'iii.', 'Choose the search criteria. You can search guards by either the name or the ID.', '');
INSERT INTO `helpsubsection` VALUES (76, 'iv.', 'Click on Search Guard button to search for a guard.', '');
INSERT INTO `helpsubsection` VALUES (77, 'v.', 'Click on the guard ID to edit the guard''s details.', '');
INSERT INTO `helpsubsection` VALUES (78, 'vi.', 'The status column shows the status of the guard. Click on the link to change it.', '');
INSERT INTO `helpsubsection` VALUES (79, 'vii.', 'Click on View File to see the guard''s details.', '');
INSERT INTO `helpsubsection` VALUES (80, 'viii.', 'Click on the Delete link for the guard you want to delete.', '');
INSERT INTO `helpsubsection` VALUES (81, 'a.', 'Click on Create New Guard button on the image in the Manage guard section', '');
INSERT INTO `helpsubsection` VALUES (82, 'b.', 'The form below is displayed', '');
INSERT INTO `helpsubsection` VALUES (83, 'c', '', 'helpimages/1200300123addguard.jpg');
INSERT INTO `helpsubsection` VALUES (84, 'c.', 'Enter the information about the guard under the selected General Tab. Do the same for the other tabs. i.e. Address, Parents, Family, History, and Referees. All fields marked with * are required. ', '');
INSERT INTO `helpsubsection` VALUES (85, 'd.', 'Click on Save all Guard Data button to save the guard.', '');
INSERT INTO `helpsubsection` VALUES (86, 'a.', 'Click on the Edit link of the guard you wish to edit their details in the Manage guard section', '');
INSERT INTO `helpsubsection` VALUES (87, 'b.', 'In the form displayed below, make the necessary changes.', '');
INSERT INTO `helpsubsection` VALUES (88, 'c', '', 'helpimages/1200301212guard2.jpg');
INSERT INTO `helpsubsection` VALUES (89, 'c.', 'Click on Save all Guard Data button to save the changes made.', '');
INSERT INTO `helpsubsection` VALUES (90, 'a.', 'Click on the link in the status column in Manage guard section, for the guard you wish to edit their status', '');
INSERT INTO `helpsubsection` VALUES (91, 'b.', 'In the form displayed below, make the necessary changes e.g. you change the status to Active, Dismissed, Sick, Absconded, etc.', '');
INSERT INTO `helpsubsection` VALUES (92, 'c', '', 'helpimages/1200301504guardstatus.jpg');
INSERT INTO `helpsubsection` VALUES (93, 'c.', 'Click on Save button to save the changes made', '');
INSERT INTO `helpsubsection` VALUES (94, 'a.', 'Go to Dashboard ', '');
INSERT INTO `helpsubsection` VALUES (95, 'b', '', 'helpimages/1200301864leaveapp.jpg');
INSERT INTO `helpsubsection` VALUES (96, 'b.', 'Under Administration and Human Resources, click More links. Then click on Leave applications ', '');
INSERT INTO `helpsubsection` VALUES (97, 'c.', 'The screen below will be displayed.', '');
INSERT INTO `helpsubsection` VALUES (98, 'd', '', 'helpimages/1200302149manageleave.jpg');
INSERT INTO `helpsubsection` VALUES (99, 'i.', 'Click on Register Leave Application button to create a new Leave application for a guard.', '');
INSERT INTO `helpsubsection` VALUES (100, 'ii.', 'Click the Delete link for the guard you wish to delete their leave application.', '');
INSERT INTO `helpsubsection` VALUES (101, 'iii.', 'Click the Edit link for the guard you wish to edit their leave application.', '');
INSERT INTO `helpsubsection` VALUES (102, 'iv.', 'Click the View link for the guard you wish to view their leave application.', '');
INSERT INTO `helpsubsection` VALUES (103, 'v.', 'Click on these links to view/change the Approval status of the leave application.', '');
INSERT INTO `helpsubsection` VALUES (104, 'a.', 'Click on the Edit link for the guard you wish to edit their leave application.', '');
INSERT INTO `helpsubsection` VALUES (105, 'b.', 'In the form displayed below, make the necessary changes e.g. you change the leave type, reason for leave, start date and End date.', '');
INSERT INTO `helpsubsection` VALUES (106, 'c', '', 'helpimages/1200302769editleave.jpg');
INSERT INTO `helpsubsection` VALUES (107, 'c.', 'Click on Save button to save the changes made', '');
INSERT INTO `helpsubsection` VALUES (108, 'a.', 'Click on the link in the Approvals column for the guard you wish to edit the leave application status. The following screen is displayed.', '');
INSERT INTO `helpsubsection` VALUES (109, 'b', '', 'helpimages/1200303069leaveapproval.jpg');
INSERT INTO `helpsubsection` VALUES (110, 'b.', 'You can set the approval status to either Accept or Reject.', '');
INSERT INTO `helpsubsection` VALUES (111, 'c.', 'Click on Save button to save the changes.', '');
INSERT INTO `helpsubsection` VALUES (112, 'a.', 'Go to Dashboard ', '');
INSERT INTO `helpsubsection` VALUES (113, 'b', '', 'helpimages/1200303336guarddispline.jpg');
INSERT INTO `helpsubsection` VALUES (114, 'b.', 'Under Administration and Human Resources, click More links. Then click on Track guard discipline ', '');
INSERT INTO `helpsubsection` VALUES (115, 'c.', 'The screen below will be displayed.', '');
INSERT INTO `helpsubsection` VALUES (116, 'd', '', 'helpimages/1200303503managepersonnelfiles.jpg');
INSERT INTO `helpsubsection` VALUES (117, 'i.', 'Click on Create New Personnel File button to create a new personnel file for guard.', '');
INSERT INTO `helpsubsection` VALUES (118, 'ii.', 'Click the Delete link for the guard you wish to delete their personnel file.', '');
INSERT INTO `helpsubsection` VALUES (119, 'iii.', 'Click the Edit link for the guard you wish to edit their personnel file.', '');
INSERT INTO `helpsubsection` VALUES (120, 'iv.', 'iv.	Click the GuardÃƒÂ¢Ã¢â€šÂ¬Ã¢â€žÂ¢s name for the guard you wish to view their personnel file.', '');
INSERT INTO `helpsubsection` VALUES (121, 'a.', 'Click on Create New Personnel File button on the image in the previous section.', '');
INSERT INTO `helpsubsection` VALUES (122, 'b.', 'The form below is displayed', '');
INSERT INTO `helpsubsection` VALUES (123, 'c', '', 'helpimages/1200303820createpersonnelfile.jpg');
INSERT INTO `helpsubsection` VALUES (124, 'c.', 'Fill in the form and the fields marked with * are all required.', '');
INSERT INTO `helpsubsection` VALUES (125, 'd.', 'Click on Save to create the personnel File for the guard.', '');
INSERT INTO `helpsubsection` VALUES (126, 'a.', 'Click on the Edit link guard you wish to edit their personnel file.', '');
INSERT INTO `helpsubsection` VALUES (127, 'b.', 'In the form displayed below, make the necessary changes .', '');
INSERT INTO `helpsubsection` VALUES (128, 'c', '', 'helpimages/1200304053createpersonnel2.jpg');
INSERT INTO `helpsubsection` VALUES (129, 'c.', 'Click on Save button to save the changes made', '');
INSERT INTO `helpsubsection` VALUES (130, 'a.', 'Go to Dashboard ', '');
INSERT INTO `helpsubsection` VALUES (131, 'b', '', 'helpimages/1200304372generatingclientreport.jpg');
INSERT INTO `helpsubsection` VALUES (132, 'b.', 'Under Finance and Accounting, click Generate invoice. ', '');
INSERT INTO `helpsubsection` VALUES (133, 'c.', 'The screen below will be displayed.', '');
INSERT INTO `helpsubsection` VALUES (134, 'd', '', 'helpimages/1200304575generateclientinvoicereport.jpg');
INSERT INTO `helpsubsection` VALUES (135, 'd.', 'Enter client''s name or few characters to search for client', '');
INSERT INTO `helpsubsection` VALUES (136, 'e.', 'Select from the search results, the client you wish to generate their Invoice', '');
INSERT INTO `helpsubsection` VALUES (137, 'f.', 'Select the period for which the report ', '');
INSERT INTO `helpsubsection` VALUES (138, 'g.', 'Select the details you want to appear in the report generated', '');
INSERT INTO `helpsubsection` VALUES (139, 'h.', 'Click on Generate Report to generate the client Invoice Report. The report generated will be in this format.', '');
INSERT INTO `helpsubsection` VALUES (140, 'i', '', 'helpimages/1200304889clientinvoicereport.jpg');
INSERT INTO `helpsubsection` VALUES (141, 'i.', 'You can print the report', '');
INSERT INTO `helpsubsection` VALUES (142, 'j.', 'You can export the report to Ms. Word or Ms. Excel', '');
INSERT INTO `helpsubsection` VALUES (143, 'a.', 'Go to Dashboard', '');
INSERT INTO `helpsubsection` VALUES (144, 'b', '', 'helpimages/1200305125guardpayroll.jpg');
INSERT INTO `helpsubsection` VALUES (145, 'b.', 'Under Finance and Accounting, click Generate payroll for personnel salaries.', '');
INSERT INTO `helpsubsection` VALUES (146, 'c.', 'The screen below will be displayed', '');
INSERT INTO `helpsubsection` VALUES (147, 'd', '', 'helpimages/1200305285genertegurdpayroll.jpg');
INSERT INTO `helpsubsection` VALUES (148, 'd.', 'Select the period for which the you want to generate the report ', '');
INSERT INTO `helpsubsection` VALUES (149, 'e.', 'Select the details you want to appear in the report generated', '');
INSERT INTO `helpsubsection` VALUES (150, 'f.', 'Click on Generate Report to generate the client Invoice Report. The report generated will be in this format.', '');
INSERT INTO `helpsubsection` VALUES (151, 'g', '', 'helpimages/1200305465guardpayrollreport.jpg');
INSERT INTO `helpsubsection` VALUES (152, 'g.', 'You can print the report', '');
INSERT INTO `helpsubsection` VALUES (153, 'h.', 'You can export the report to Ms. Word or Ms. Excel', '');
INSERT INTO `helpsubsection` VALUES (154, 'a.', 'Go to Dashboard', '');
INSERT INTO `helpsubsection` VALUES (157, 'b', '', 'helpimages/1200306130trackpayment.jpg');
INSERT INTO `helpsubsection` VALUES (158, 'b.', 'Under Finance and Accounting, click Track payment of invoices.', '');
INSERT INTO `helpsubsection` VALUES (159, 'c.', 'The screen below will be displayed', '');
INSERT INTO `helpsubsection` VALUES (160, 'd', '', 'helpimages/1200306270paymentstatus.jpg');
INSERT INTO `helpsubsection` VALUES (161, 'd.', 'Click on Edit link to change the client''s payment status.', '');
INSERT INTO `helpsubsection` VALUES (162, 'e.', 'In the form displayed below, make the necessary changes.', '');
INSERT INTO `helpsubsection` VALUES (164, 'f.', 'Click Save to save the changes or Back to exit without saving.', '');
INSERT INTO `helpsubsection` VALUES (165, 'a.', 'Go to Dashboard', '');
INSERT INTO `helpsubsection` VALUES (166, 'b', '', 'helpimages/1200308286managerates.jpg');
INSERT INTO `helpsubsection` VALUES (167, 'b.', 'Under Finance and Accounting, click Manage rates.', '');
INSERT INTO `helpsubsection` VALUES (168, 'c.', 'The screen below will be displayed', '');
INSERT INTO `helpsubsection` VALUES (169, 'd', '', 'helpimages/1200308561rates.jpg');
INSERT INTO `helpsubsection` VALUES (170, 'a.', 'To edit client rates, select a client or several clients, from the Manage clients section', '');
INSERT INTO `helpsubsection` VALUES (171, 'b', '', 'helpimages/1200309068clientrates.jpg');
INSERT INTO `helpsubsection` VALUES (172, 'b.', 'Click on Edit Assignment Rates', '');
INSERT INTO `helpsubsection` VALUES (173, 'c.', 'The following screen will be displayed', '');
INSERT INTO `helpsubsection` VALUES (174, 'd', '', 'helpimages/1200309222addrates.jpg');
INSERT INTO `helpsubsection` VALUES (175, 'd.', 'Edit/change the Assignment rate', '');
INSERT INTO `helpsubsection` VALUES (176, 'e.', 'Click on Save to save the changes or Back to exit without saving.', '');
INSERT INTO `helpsubsection` VALUES (177, 'a.', 'To edit guard rates, search for a guard by entering a guard''s name', '');
INSERT INTO `helpsubsection` VALUES (178, 'b', '', 'helpimages/1200309631editguardrates.jpg');
INSERT INTO `helpsubsection` VALUES (179, 'b.', 'Click on click on search. If the name exists, the guard and Rate will be shown', '');
INSERT INTO `helpsubsection` VALUES (180, 'c.', 'Select the guard by clicking in the checkbox besides guardÃƒÂ¢Ã¢â€šÂ¬Ã¢â€žÂ¢s name', '');
INSERT INTO `helpsubsection` VALUES (181, 'd.', 'Click Edit Guard Rates. The following screen will be displayed', '');
INSERT INTO `helpsubsection` VALUES (182, 'e', '', '');
INSERT INTO `helpsubsection` VALUES (183, 'e.', 'Make the necessary changes on the guard rate', '');
INSERT INTO `helpsubsection` VALUES (184, 'f.', 'Click on save to save the changes or Back to exit without saving.', '');
INSERT INTO `helpsubsection` VALUES (185, 'a.', 'Go to Dashboard', '');
INSERT INTO `helpsubsection` VALUES (186, 'b', '', 'helpimages/1200309980PAYEschedule.jpg');
INSERT INTO `helpsubsection` VALUES (187, 'b.', 'Under Finance and Accounting, click Custom reports, then click PAYE schedule', '');
INSERT INTO `helpsubsection` VALUES (188, 'c.', 'The screen below will be displayed', '');
INSERT INTO `helpsubsection` VALUES (189, 'd', '', 'helpimages/1200310127PAYEschedule2.jpg');
INSERT INTO `helpsubsection` VALUES (190, 'd.', 'Click on the Edit link to make changes in the PAYE schedule', '');
INSERT INTO `helpsubsection` VALUES (191, 'e.', 'You can print the schedule', '');
INSERT INTO `helpsubsection` VALUES (192, 'f.', 'You can export the schedule to Ms. Word or Ms. Excel', '');
INSERT INTO `helpsubsection` VALUES (193, 'a.', 'Go to Dashboard', '');
INSERT INTO `helpsubsection` VALUES (194, 'b', '', 'helpimages/1200310433NSSFschedule.jpg');
INSERT INTO `helpsubsection` VALUES (195, 'b.', 'Under Finance and Accounting, click Custom reports', '');
INSERT INTO `helpsubsection` VALUES (196, 'c.', 'Then click NSSF schedule', '');
INSERT INTO `helpsubsection` VALUES (197, 'd.', 'The screen below will be displayed', '');
INSERT INTO `helpsubsection` VALUES (198, 'e', '', 'helpimages/1200310556NSSFschedule2.jpg');
INSERT INTO `helpsubsection` VALUES (199, 'e.', 'Click on the Edit link to make changes in the NSSF schedule', '');
INSERT INTO `helpsubsection` VALUES (200, 'f.', 'You can print the schedule', '');
INSERT INTO `helpsubsection` VALUES (201, 'g.', 'You can export the schedule to Ms. Word or Ms. Excel', '');
INSERT INTO `helpsubsection` VALUES (202, 'a.', 'Click edit link on the NSSF schedule', '');
INSERT INTO `helpsubsection` VALUES (203, 'b.', 'On the form displayed below, make the necessary changes (the NSSF number)', '');
INSERT INTO `helpsubsection` VALUES (204, 'c', '', 'helpimages/1200310904NSSFreport.jpg');
INSERT INTO `helpsubsection` VALUES (205, 'c.', 'Click view to view the changes', '');
INSERT INTO `helpsubsection` VALUES (206, 'a.', 'Go to Dashboard', '');
INSERT INTO `helpsubsection` VALUES (207, 'b', '', 'helpimages/1200311007financialreport.jpg');
INSERT INTO `helpsubsection` VALUES (208, 'b.', 'Under Finance and Accounting, click Custom reports', '');
INSERT INTO `helpsubsection` VALUES (209, 'c.', 'Then click Guard financial status', '');
INSERT INTO `helpsubsection` VALUES (210, 'd.', 'The screen below will be displayed', '');
INSERT INTO `helpsubsection` VALUES (211, 'e', '', 'helpimages/1200311144financialreport2.jpg');
INSERT INTO `helpsubsection` VALUES (212, 'e.', 'Click on the update link to change the guard''s financial status for a given guard. The following screen is displayed.', '');
INSERT INTO `helpsubsection` VALUES (213, 'f', '', 'helpimages/1200311273financialreport3.jpg');
INSERT INTO `helpsubsection` VALUES (214, 'f.', 'Make the necessary changes.', '');
INSERT INTO `helpsubsection` VALUES (215, 'g.', 'Click on the Save button to save the changes.', '');
INSERT INTO `helpsubsection` VALUES (216, 'a.', 'Go to Dashboard', '');
INSERT INTO `helpsubsection` VALUES (217, 'b', '', 'helpimages/1200311453assignmentovertime.jpg');
INSERT INTO `helpsubsection` VALUES (218, 'b.', 'Under Finance and Accounting, click Custom reports', '');
INSERT INTO `helpsubsection` VALUES (219, 'c.', 'Then click Overtime report', '');
INSERT INTO `helpsubsection` VALUES (220, 'd.', 'The screen below will be displayed', '');
INSERT INTO `helpsubsection` VALUES (221, 'e', '', 'helpimages/1200311675overtime.jpg');
INSERT INTO `helpsubsection` VALUES (222, 'e.', 'To manage assignment overtime, click Manage Assignment Overtime.', '');
INSERT INTO `helpsubsection` VALUES (223, 'f.', 'Click the link under Call Sign column to view the assignment and overtime details for a client.', '');
INSERT INTO `helpsubsection` VALUES (224, 'g.', 'Click the Details link to view the overtime details for a client, as shown below', '');
INSERT INTO `helpsubsection` VALUES (225, 'h', '', 'helpimages/1200311743overtime1.jpg');
INSERT INTO `helpsubsection` VALUES (226, 'a.', 'Go to Dashboard', '');
INSERT INTO `helpsubsection` VALUES (227, 'b', '', 'helpimages/1200312021assignments.jpg');
INSERT INTO `helpsubsection` VALUES (228, 'b.', 'Under Operations Management, click Manage assignments', '');
INSERT INTO `helpsubsection` VALUES (229, 'c.', 'The screen below will be displayed', '');
INSERT INTO `helpsubsection` VALUES (230, 'd', '', 'helpimages/1200312172assignment2.jpg');
INSERT INTO `helpsubsection` VALUES (231, 'i.', 'Click Create New Assignment to create a new assignment', '');
INSERT INTO `helpsubsection` VALUES (232, 'ii.', 'Click on the link View Archive to view the archived assignments', '');
INSERT INTO `helpsubsection` VALUES (233, 'iii.', 'Click Edit to edit the assignment', '');
INSERT INTO `helpsubsection` VALUES (234, 'iv.', 'Click Delete to delete the assignment', '');
INSERT INTO `helpsubsection` VALUES (235, 'v.', 'Click Post to post an Overtime', '');
INSERT INTO `helpsubsection` VALUES (236, 'vi.', 'Click Post to post a replacement', '');
INSERT INTO `helpsubsection` VALUES (237, 'vii.', 'Click the Archive button to archive selected assignment(s).', '');
INSERT INTO `helpsubsection` VALUES (238, 'a.', 'After clicking on the Create New Assignment link on the image in the previous section, the following screen is displayed.', '');
INSERT INTO `helpsubsection` VALUES (239, 'b', '', 'helpimages/1200312485assignment3.jpg');
INSERT INTO `helpsubsection` VALUES (240, 'b.', 'Enter the client name or search for client', '');
INSERT INTO `helpsubsection` VALUES (241, 'c.', 'Enter the Call sign (ensure that the call sign is not yet taken by clicking on Check Availability)', '');
INSERT INTO `helpsubsection` VALUES (242, 'd.', 'Select the region code.', '');
INSERT INTO `helpsubsection` VALUES (243, 'e.', 'Add the Alarm type', '');
INSERT INTO `helpsubsection` VALUES (244, 'f.', 'Select the service type', '');
INSERT INTO `helpsubsection` VALUES (245, 'g.', 'Select the Starting and Ending dates when the service(s) is needed', '');
INSERT INTO `helpsubsection` VALUES (246, 'h.', 'Select the Start and End time of the day when the service(s) will be needed.', '');
INSERT INTO `helpsubsection` VALUES (247, 'i.', 'You can add the date(s) when the services is(are) not needed. This is optional', '');
INSERT INTO `helpsubsection` VALUES (248, 'j.', 'Add Guard(s) needed for assignment. Enter guard name and click Search for Guard. A list of names is displayed; select the Guard you want to assign. You can add as many guards as you want to assign.', '');
INSERT INTO `helpsubsection` VALUES (249, 'k.', 'Add Commander, Enter a name and click Search for Guard. A list of names is displayed; select the Guard you want to assign as a commander.', '');
INSERT INTO `helpsubsection` VALUES (250, 'l.', 'Add Reliever, Enter a name and click Search for Guard. A list of names is displayed; select the Guard you want to assign as a reliever.', '');
INSERT INTO `helpsubsection` VALUES (251, 'm.', 'Add the Equipment required by selecting from the available equipment list.', '');
INSERT INTO `helpsubsection` VALUES (252, 'n', 'Click Save to save the assignment.', '');
INSERT INTO `helpsubsection` VALUES (253, 'a.', 'Click on the Post link to post overtime for a new assignment. The following screen is displayed', '');
INSERT INTO `helpsubsection` VALUES (254, 'b', '', 'helpimages/1200313179overtime1.jpg');
INSERT INTO `helpsubsection` VALUES (255, 'b.', 'Click on the link Post Overtime to add overtime. The following screen is displayed', '');
INSERT INTO `helpsubsection` VALUES (256, 'c', '', 'helpimages/1200313225overtime2.jpg');
INSERT INTO `helpsubsection` VALUES (257, 'c.', 'Enter all the details in the form and click on Save to save the assignment overtime. The following screen is displayed after saving.', '');
INSERT INTO `helpsubsection` VALUES (258, 'd', '', 'helpimages/1203483630overtime.jpg');
INSERT INTO `helpsubsection` VALUES (259, 'a.', 'Click Post to post replacement for a new assignment. The following screen is displayed', '');
INSERT INTO `helpsubsection` VALUES (260, 'b', '', 'helpimages/1200313608replacement.jpg');
INSERT INTO `helpsubsection` VALUES (261, 'b.', 'Click on the link Post Replacement to add replacement. The following screen is displayed', '');
INSERT INTO `helpsubsection` VALUES (262, 'c', '', 'helpimages/1200313648replacement2.jpg');
INSERT INTO `helpsubsection` VALUES (263, 'c.', 'Enter all the details in the form and click on Save to save the assignment replacement. The following screen is displayed after saving.', '');
INSERT INTO `helpsubsection` VALUES (264, 'd.', '', 'helpimages/1200313803placement3.jpg');
INSERT INTO `helpsubsection` VALUES (265, 'a.', 'Go to Dashboard', '');
INSERT INTO `helpsubsection` VALUES (266, 'b', '', 'helpimages/1200314317clientschedules.jpg');
INSERT INTO `helpsubsection` VALUES (267, 'b.', 'Under Operations Management, click View client schedules. The following screen will be displayed', '');
INSERT INTO `helpsubsection` VALUES (268, 'c', '', 'helpimages/1200314578generateclientschedules.jpg');
INSERT INTO `helpsubsection` VALUES (269, 'c.', 'Follow the instructions on the screen.', '');
INSERT INTO `helpsubsection` VALUES (270, 'd.', 'When you click on Generate Schedule, the generated schedule will be looking like the one below.', '');
INSERT INTO `helpsubsection` VALUES (271, 'e', '', 'helpimages/1200314839clientschedulereport1.jpg');
INSERT INTO `helpsubsection` VALUES (272, 'a.', 'Go to Dashboard', '');
INSERT INTO `helpsubsection` VALUES (273, 'b', '', 'helpimages/1200315113incidents.jpg');
INSERT INTO `helpsubsection` VALUES (274, 'b.', 'Under Operations Management, click More links', '');
INSERT INTO `helpsubsection` VALUES (275, 'c.', 'Then click on Manage incidents on assignments. The screen below will be displayed', '');
INSERT INTO `helpsubsection` VALUES (276, 'd', '', 'helpimages/1200315265incidents1.jpg');
INSERT INTO `helpsubsection` VALUES (277, 'd.', 'Click on Create New Incident to create a new incident', '');
INSERT INTO `helpsubsection` VALUES (278, 'e.', 'Click on Edit to edit incident ', '');
INSERT INTO `helpsubsection` VALUES (279, 'f.', 'Click on Delete to an incident', '');
INSERT INTO `helpsubsection` VALUES (280, 'g.', 'Click on Manage Actions to add/edit the actions', '');
INSERT INTO `helpsubsection` VALUES (281, 'h.', 'Click on the reference number of the incident to view the details of the incident.', '');
INSERT INTO `helpsubsection` VALUES (282, 'a.', 'When you click on Create New Incident button, the following screen is displayed.', '');
INSERT INTO `helpsubsection` VALUES (284, 'b', '', 'helpimages/1200315659createincindent.jpg');
INSERT INTO `helpsubsection` VALUES (285, 'b.', 'The reference number is generated automatically and randomly, you can change it.', '');
INSERT INTO `helpsubsection` VALUES (286, 'c.', 'Add the assignment by typing the name and clicking on Search for Assignment, a list of assignments is displayed; click the assignment number to select the assignment.', '');
INSERT INTO `helpsubsection` VALUES (287, 'd.', 'Add the date of incident and the guard responsible. Enter the guard name and search the guard, click on a guardÃƒÂ¢Ã¢â€šÂ¬Ã¢â€žÂ¢s name to assign the guard.', '');
INSERT INTO `helpsubsection` VALUES (288, 'e.', 'Add the details of the incident', '');
INSERT INTO `helpsubsection` VALUES (289, 'f.', 'Add the reporter of the incident and the time the incident was reported', '');
INSERT INTO `helpsubsection` VALUES (290, 'g.', 'Add the checker of the incident and the time the incident was checked.', '');
INSERT INTO `helpsubsection` VALUES (291, 'h.', 'Add the actions taken. You can add as many actions as possible.', '');
INSERT INTO `helpsubsection` VALUES (292, 'i.', 'Click Save to save the incident.', '');
INSERT INTO `helpsubsection` VALUES (293, 'a.', 'Click on the Manage Actions link for a particular incident, the screen displayed allows you to edit the existing actions and to add or remove actions', '');
INSERT INTO `helpsubsection` VALUES (294, 'b', '', 'helpimages/1200316174editincidents.jpg');
INSERT INTO `helpsubsection` VALUES (295, 'b.', 'You can add an action or edit the existing action. ', '');
INSERT INTO `helpsubsection` VALUES (296, 'c.', 'Click Save to save the changes or Back to exit without saving.', '');
INSERT INTO `helpsubsection` VALUES (297, 'a.', 'Go to Dashboard', '');
INSERT INTO `helpsubsection` VALUES (298, 'b', '', 'helpimages/1200316480manageclients.jpg');
INSERT INTO `helpsubsection` VALUES (299, 'b.', 'Under Operations Management, click More links', '');
INSERT INTO `helpsubsection` VALUES (300, 'c.', 'Then click on Manage clients on assignments. The screen below will be displayed', '');
INSERT INTO `helpsubsection` VALUES (301, 'd', '', 'helpimages/1200316677manageclient2.jpg');
INSERT INTO `helpsubsection` VALUES (302, 'd.', 'Click on Create New Client to create a new client', '');
INSERT INTO `helpsubsection` VALUES (303, 'e.', 'Click on Edit to edit client details', '');
INSERT INTO `helpsubsection` VALUES (304, 'f.', 'Click on Delete to delete a client.', '');
INSERT INTO `helpsubsection` VALUES (305, 'g.', 'Click on Add Assignment to add assignments to a client', '');
INSERT INTO `helpsubsection` VALUES (306, 'h.', 'Click on the client name to view the details of the client', '');
INSERT INTO `helpsubsection` VALUES (307, 'i.', 'Click View All to view all assignments on the client.', '');
INSERT INTO `helpsubsection` VALUES (308, 'a.', 'When you click on create new client, the following form is displayed.', '');
INSERT INTO `helpsubsection` VALUES (309, 'b', '', 'helpimages/1200316995createclient.jpg');
INSERT INTO `helpsubsection` VALUES (310, 'b.', 'Enter the fields in the form and all those fields marked with <font color=red>*</font> are required.', '');
INSERT INTO `helpsubsection` VALUES (311, 'c.', 'You can set the status of the client to either active or not active, and click Save to save the client information.', '');
INSERT INTO `helpsubsection` VALUES (312, 'a.', 'Go to Dashboard', '');
INSERT INTO `helpsubsection` VALUES (313, 'b', '', 'helpimages/1200317263regions.jpg');
INSERT INTO `helpsubsection` VALUES (314, 'b.', 'Under Operations Management, click More links', '');
INSERT INTO `helpsubsection` VALUES (315, 'c.', 'Then click on Manage regions. The screen below will be displayed', '');
INSERT INTO `helpsubsection` VALUES (316, 'd', '', 'helpimages/1200317394regions2.jpg');
INSERT INTO `helpsubsection` VALUES (317, 'd.', 'Click on <i>Create New Region</i> to create a new region', '');
INSERT INTO `helpsubsection` VALUES (318, 'e.', 'Click on Edit to edit region details', '');
INSERT INTO `helpsubsection` VALUES (319, 'f.', 'Click on Delete to delete a region.', '');
INSERT INTO `helpsubsection` VALUES (320, 'g.', 'Click on region name to view the details of that region.', '');
INSERT INTO `helpsubsection` VALUES (321, 'a.', 'When you click on the Create New Region button, the following screen is displayed', '');
INSERT INTO `helpsubsection` VALUES (322, 'b', '', 'helpimages/1200317626addregion.jpg');
INSERT INTO `helpsubsection` VALUES (323, 'b.', 'Add the region code. Click on Check Availability to verify that the code is not being used by another region', '');
INSERT INTO `helpsubsection` VALUES (324, 'c.', 'Add region name, ensure that the name is not being used by another region', '');
INSERT INTO `helpsubsection` VALUES (325, 'd.', 'Add the description of the region.', '');
INSERT INTO `helpsubsection` VALUES (326, 'e.', 'Add the areas covered by the region. You can add these at a later stage one at a time, as the coverage grows.', '');
INSERT INTO `helpsubsection` VALUES (327, 'f.', 'Click on Save to save the region.', '');
INSERT INTO `helpsubsection` VALUES (328, 'a.', 'Go to Dashboard', '');
INSERT INTO `helpsubsection` VALUES (329, 'b', '', 'helpimages/1200317890activeguards.jpg');
INSERT INTO `helpsubsection` VALUES (330, 'b.', 'Under Operations Management, click More links', '');
INSERT INTO `helpsubsection` VALUES (331, 'c.', 'Then click on View active guards. The screen below will be displayed, having a list of active guards.', '');
INSERT INTO `helpsubsection` VALUES (332, 'd', '', 'helpimages/1200318072activeguards1.jpg');
INSERT INTO `helpsubsection` VALUES (333, 'd.', 'Click on the guard''s name to view the status of the guard.', '');
INSERT INTO `helpsubsection` VALUES (334, 'a.', 'Go to Dashboard', '');
INSERT INTO `helpsubsection` VALUES (335, 'b', '', 'helpimages/1200318156activeguards3.jpg');
INSERT INTO `helpsubsection` VALUES (336, 'b.', 'Under Operations Management, click More links', '');
INSERT INTO `helpsubsection` VALUES (337, 'c.', 'Then click on View sick guards. The screen below will be displayed, having a list of sick guards.', '');
INSERT INTO `helpsubsection` VALUES (338, 'd', '', 'helpimages/1200318354sickguards.jpg');
INSERT INTO `helpsubsection` VALUES (339, 'd.', 'Click on the GuardÃƒÂ¢Ã¢â€šÂ¬Ã¢â€žÂ¢s name to view the status of the guard and the sickness details, including the type of illness and the expected recovery date.', '');
INSERT INTO `helpsubsection` VALUES (340, 'a.', 'Go to Dashboard', '');
INSERT INTO `helpsubsection` VALUES (341, 'b', '', 'helpimages/1200318425inventory.jpg');
INSERT INTO `helpsubsection` VALUES (342, 'b.', 'Under Inventory Management, click Manage inventory stock', '');
INSERT INTO `helpsubsection` VALUES (343, 'c.', 'The following screen will be displayed', '');
INSERT INTO `helpsubsection` VALUES (344, 'd', '', 'helpimages/1200318560inventory2.jpg');
INSERT INTO `helpsubsection` VALUES (345, 'd.', 'Click Register New Item button to add a new item to the inventory', '');
INSERT INTO `helpsubsection` VALUES (346, 'e.', 'To search for an item in the inventory, enter the search term (serial number) and click on Search Items button.', '');
INSERT INTO `helpsubsection` VALUES (347, 'f.', 'Click on the Edit link to edit an item in the inventory. Make the necessary changes and click Save to save the changes you have made.', '');
INSERT INTO `helpsubsection` VALUES (348, 'g.', 'Click on the Delete link to delete an item from the inventory.', '');
INSERT INTO `helpsubsection` VALUES (349, 'a.', 'When you click on Register New Item, the screen below is displayed', '');
INSERT INTO `helpsubsection` VALUES (350, 'b', '', 'helpimages/1200318862itemregister.jpg');
INSERT INTO `helpsubsection` VALUES (351, 'b.', 'Fill in the fields of the form. Select the item type from the list, or if it doesnÃƒÂ¢Ã¢â€šÂ¬Ã¢â€žÂ¢t not exist, click on Add New Type and add the new item type.', '');
INSERT INTO `helpsubsection` VALUES (352, 'c.', 'Add the name of the item.', '');
INSERT INTO `helpsubsection` VALUES (353, 'd.', 'Add the serial number of the item and ensure that it is not used by another item.', '');
INSERT INTO `helpsubsection` VALUES (354, 'e.', 'Select the status of the item, if the status is not included in the list, click Add New Status to add it.', '');
INSERT INTO `helpsubsection` VALUES (355, 'f.', 'Click on Save to save the item.', '');
INSERT INTO `helpsubsection` VALUES (356, 'a.', 'Click on Edit link of the item you want to edit', '');
INSERT INTO `helpsubsection` VALUES (357, 'b', '', 'helpimages/1200319335itemregister2.jpg');
INSERT INTO `helpsubsection` VALUES (358, 'b.', 'Make the necessary changes', '');
INSERT INTO `helpsubsection` VALUES (359, 'c.', 'Click Save to save the changes you have made.', '');
INSERT INTO `helpsubsection` VALUES (360, 'a.', 'Click on Delete link of the item you want to delete', '');
INSERT INTO `helpsubsection` VALUES (361, 'b.', 'A message is displayed on the screen to confirm whether you want to delete the item.', '');
INSERT INTO `helpsubsection` VALUES (362, 'c', '', 'helpimages/1200319538deleteitem.jpg');
INSERT INTO `helpsubsection` VALUES (363, 'c.', 'When you click OK, the item will be deleted, if you click Cancel, the item will not be deleted.', '');
INSERT INTO `helpsubsection` VALUES (364, 'a.', 'Enter the serial number (all or part) of the item to search for', '');
INSERT INTO `helpsubsection` VALUES (365, 'b', '', 'helpimages/1200319767searchitems.jpg');
INSERT INTO `helpsubsection` VALUES (366, 'b.', 'Click Search Items button', '');
INSERT INTO `helpsubsection` VALUES (367, 'c.', 'If there are matching results, they are shown. Otherwise, a message will be shown with "There are no items to display."', '');
INSERT INTO `helpsubsection` VALUES (368, 'a.', 'Go to Dashboard', '');
INSERT INTO `helpsubsection` VALUES (369, 'b', '', 'helpimages/1200320108itemissuess.jpg');
INSERT INTO `helpsubsection` VALUES (370, 'b.', 'Under Inventory Management, click Manage item issues', '');
INSERT INTO `helpsubsection` VALUES (371, 'c.', 'The following screen will be displayed, with a list of issued items', '');
INSERT INTO `helpsubsection` VALUES (372, 'd', '', 'helpimages/1200320157itemissuess2.jpg');
INSERT INTO `helpsubsection` VALUES (373, 'd.', 'Click Issue Item button to issue an item', '');
INSERT INTO `helpsubsection` VALUES (374, 'e.', 'To search for an issued item in the inventory, enter the search term and click on Search Items button.', '');
INSERT INTO `helpsubsection` VALUES (375, 'f.', 'Click on the Edit link to edit issued item.', '');
INSERT INTO `helpsubsection` VALUES (376, 'g.', 'Click on the Delete link to delete the issued item from the inventory.', '');
INSERT INTO `helpsubsection` VALUES (377, 'a.', 'When u click on Edit link, the form below is displayed', '');
INSERT INTO `helpsubsection` VALUES (378, 'b', '', 'helpimages/1200320417itemissues4.jpg');
INSERT INTO `helpsubsection` VALUES (379, 'b.', 'Make the necessary changes. Click Save to submit the changes you have made.', '');
INSERT INTO `helpsubsection` VALUES (380, 'c.', 'A message is displayed with ''Your item was successfully updated''', '');
INSERT INTO `helpsubsection` VALUES (381, 'a.', 'When you click on Issue Item, the following screen will be displayed', '');
INSERT INTO `helpsubsection` VALUES (382, 'b', '', 'helpimages/1200320787issueitem2.jpg');
INSERT INTO `helpsubsection` VALUES (383, 'b.', 'Enter the item serial number. Check the availability of the item because you canÃƒÂ¢Ã¢â€šÂ¬Ã¢â€žÂ¢t issue an item that is not available.', '');
INSERT INTO `helpsubsection` VALUES (384, 'c.', 'The issuing officer will be the person who is logged in.', '');
INSERT INTO `helpsubsection` VALUES (385, 'd.', 'Enter date of issue. By default, this will be the current date, but it can be changed', '');
INSERT INTO `helpsubsection` VALUES (386, 'e.', 'Enter guard responsible by typing the guard name and click on search for guard to display matching results from which you pick the guard.', '');
INSERT INTO `helpsubsection` VALUES (387, 'f.', 'Enter the client name and click on search for assignment to display matching results from which you pick the assignment.', '');
INSERT INTO `helpsubsection` VALUES (388, 'g.', 'Select the status of the item', '');
INSERT INTO `helpsubsection` VALUES (389, 'h.', 'Add the present condition of the Item.', '');
INSERT INTO `helpsubsection` VALUES (390, 'i.', 'Click on Save to save the item issue.', '');
INSERT INTO `helpsubsection` VALUES (391, 'a.', 'Go to Dashboard', '');
INSERT INTO `helpsubsection` VALUES (392, 'b', '', 'helpimages/1200321169itemreturns.jpg');
INSERT INTO `helpsubsection` VALUES (393, 'b.', 'Under Inventory Management, click Manage item returns', '');
INSERT INTO `helpsubsection` VALUES (394, 'c.', 'The following screen will be displayed, with a list of issued items', '');
INSERT INTO `helpsubsection` VALUES (395, 'd', '', 'helpimages/1200321217itemreturns2.jpg');
INSERT INTO `helpsubsection` VALUES (396, 'd.', 'Click Return Item button to return an item', '');
INSERT INTO `helpsubsection` VALUES (397, 'e.', 'To search for a returned item in the inventory, enter the search term (serial number) and click on Search Returns button.', '');
INSERT INTO `helpsubsection` VALUES (398, 'f.', 'Click on the Edit link to edit item returns.', '');
INSERT INTO `helpsubsection` VALUES (399, 'g.', 'Click on the Delete link to delete the returned item from the inventory.', '');
INSERT INTO `helpsubsection` VALUES (400, 'a.', 'When you click on Return Item on the image in the previous section, the following screen will be displayed', '');
INSERT INTO `helpsubsection` VALUES (401, 'b', '', 'helpimages/1200321483itemreturn3.jpg');
INSERT INTO `helpsubsection` VALUES (402, 'b.', 'Enter the item serial number. Check the availability of the item because you canÃƒÂ¢Ã¢â€šÂ¬Ã¢â€žÂ¢t return an item that is not available among issued items.', '');
INSERT INTO `helpsubsection` VALUES (403, 'c.', 'The issuing officer will be the person who is logged in.', '');
INSERT INTO `helpsubsection` VALUES (404, 'd.', 'Enter date of return. By default, this will be the current date, but it can be changed', '');
INSERT INTO `helpsubsection` VALUES (405, 'e.', 'Enter guard responsible by typing the guard name and click on search for guard to display matching results from which you pick the guard.', '');
INSERT INTO `helpsubsection` VALUES (406, 'f.', 'Enter the client name and click on search for assignment to display matching results from which you pick the assignment.', '');
INSERT INTO `helpsubsection` VALUES (407, 'g.', 'Select the status of the item', '');
INSERT INTO `helpsubsection` VALUES (408, 'h.', 'Add the present condition of the Item.', '');
INSERT INTO `helpsubsection` VALUES (409, 'i.', 'Click on Save to save the item return.', '');
INSERT INTO `helpsubsection` VALUES (410, 'a.', 'Go to Dashboard', '');
INSERT INTO `helpsubsection` VALUES (411, 'b', '', 'helpimages/1200321771stockitems.jpg');
INSERT INTO `helpsubsection` VALUES (412, 'b.', 'Under Inventory Management, click Track stock items (Reports)', '');
INSERT INTO `helpsubsection` VALUES (413, 'c.', 'The following screen will be displayed, with a list of issued items', '');
INSERT INTO `helpsubsection` VALUES (414, 'd', '', 'helpimages/1200321926itemlocation.jpg');
INSERT INTO `helpsubsection` VALUES (415, 'd.', 'Select the details you want to be included in the report', '');
INSERT INTO `helpsubsection` VALUES (416, 'e.', 'Click Generate Report', '');
INSERT INTO `helpsubsection` VALUES (417, 'f.', 'The generated report will be in this format below', '');
INSERT INTO `helpsubsection` VALUES (418, 'g', '', 'helpimages/1200322106itemlocation2.jpg');
INSERT INTO `helpsubsection` VALUES (419, 'g.', 'You can print the report by clicking on the Print button', '');
INSERT INTO `helpsubsection` VALUES (420, 'h.', 'You can export the report to either Ms. Word or Ms. Excel', '');
INSERT INTO `helpsubsection` VALUES (421, '.', 'On the dashboard, there is a section where the user views the reminders sent to his/her user group', '');
INSERT INTO `helpsubsection` VALUES (422, 'b', '', 'helpimages/1200322493reminder.jpg');
INSERT INTO `helpsubsection` VALUES (423, 'a.', 'Click on the link besides the reminder to open it', '');
INSERT INTO `helpsubsection` VALUES (424, 'b.', 'You can select the reminder(s) and click on Archive Reminders to archive them.', '');
INSERT INTO `helpsubsection` VALUES (425, 'c.', 'Click on View Archive to see the archived reminders. The following screen will be displayed', '');
INSERT INTO `helpsubsection` VALUES (426, 'd', '', 'helpimages/1200322706reminder2.jpg');
INSERT INTO `helpsubsection` VALUES (427, 'd.', 'You can delete the reminders in the archive.', '');
INSERT INTO `helpsubsection` VALUES (428, 'e.', 'You can click on Contact Others to send a request message to any of the system user groups. The screen displayed will look like this', '');
INSERT INTO `helpsubsection` VALUES (429, 'a.', 'Click on the <i>Contact Others </i>link on the Remiders sections', '');
INSERT INTO `helpsubsection` VALUES (430, 'b', '', 'helpimages/1200323047contactothers.jpg');
INSERT INTO `helpsubsection` VALUES (431, 'b.', 'Select the person (user group) you want to send the request to', '');
INSERT INTO `helpsubsection` VALUES (432, 'c.', 'Enter the subject of the request.', '');
INSERT INTO `helpsubsection` VALUES (433, 'd.', 'Enter the details of your request.', '');
INSERT INTO `helpsubsection` VALUES (434, 'e.', 'Click Send to send the request to the selected user group(s).', '');
INSERT INTO `helpsubsection` VALUES (435, 'f.', 'f.	The message will be displayed with "Your message has been sent."', '');
INSERT INTO `helpsubsection` VALUES (436, 'a.', 'Go to Settings', '');
INSERT INTO `helpsubsection` VALUES (437, 'b', '', 'helpimages/1200323972userprofile.jpg');
INSERT INTO `helpsubsection` VALUES (438, 'b.', 'Under User Profile, click View Profile. Your user profile will be displayed as shown below.', '');
INSERT INTO `helpsubsection` VALUES (439, 'c', '', 'helpimages/1200324061userprofile1.jpg');
INSERT INTO `helpsubsection` VALUES (440, 'c.', 'Under User Profile, click Edit Profile. Your user profile will be displayed as shown below.', '');
INSERT INTO `helpsubsection` VALUES (442, 'a.', 'Go to Settings', '');
INSERT INTO `helpsubsection` VALUES (443, 'b.', 'Under User Profile, click Edit Profile. Your user profile will be displayed as shown below.', '');
INSERT INTO `helpsubsection` VALUES (444, 'c', '', 'helpimages/1200324355userprofile2.jpg');
INSERT INTO `helpsubsection` VALUES (445, 'c.', 'Make the necessary changes and click on Create to save the changes.', '');
INSERT INTO `helpsubsection` VALUES (446, 'a.', 'Go to Settings', '');
INSERT INTO `helpsubsection` VALUES (447, 'b.', 'Under User Profile, click Update Favorites. Your user profile will be displayed as shown below.', '');
INSERT INTO `helpsubsection` VALUES (448, 'c', '', 'helpimages/1200377973favorites.jpg');
INSERT INTO `helpsubsection` VALUES (449, 'i.', 'Choose the section under which you want to update from the dropdown', '');
INSERT INTO `helpsubsection` VALUES (450, 'ii.', 'Select the favorite(s) you want to add under the selected section', '');
INSERT INTO `helpsubsection` VALUES (451, 'iii.', 'Click on Save Settings to save the new favorites.', '');
INSERT INTO `helpsubsection` VALUES (452, 'iv.', 'Administrators can edit the sections which other groups can view by clicking on the Edit link. The following screen will be displayed.', '');
INSERT INTO `helpsubsection` VALUES (453, 'c.', 'When the administrator clicks on the Edit link, the following screen is displayed', '');
INSERT INTO `helpsubsection` VALUES (454, 'd', '', 'helpimages/1200378167favorites1.jpg');
INSERT INTO `helpsubsection` VALUES (455, 'd.', 'For example in the figure above , the administrator can set the favorite of Manage Inventory to be viewed by Finance Managers and HR Clerks', '');
INSERT INTO `helpsubsection` VALUES (456, 'a.', 'Go to Settings', '');
INSERT INTO `helpsubsection` VALUES (457, 'b', '', 'helpimages/1200378583modulesettings.jpg');
INSERT INTO `helpsubsection` VALUES (458, 'b.', 'Under Modules settings, clicking on PAYE Formulae displays the following screen.', '');
INSERT INTO `helpsubsection` VALUES (459, 'c', '', 'helpimages/1200378663PAYEfomulae.jpg');
INSERT INTO `helpsubsection` VALUES (460, 'c.', 'Enter the fixed tax, lower and upper limits, tax percentage and the type of tax.', '');
INSERT INTO `helpsubsection` VALUES (461, '', 'Under Modules settings, clicking on Leave Types displays the following screen.', '');
INSERT INTO `helpsubsection` VALUES (462, 'a', '', 'helpimages/1200378992leavetype.jpg');
INSERT INTO `helpsubsection` VALUES (463, 'a.', 'Click on Create New Leave Type button to create a new leave type', '');
INSERT INTO `helpsubsection` VALUES (464, 'b.', 'Click on Edit link to edit the leave type', '');
INSERT INTO `helpsubsection` VALUES (465, 'c.', 'Click on Delete link to delete a leave type', '');
INSERT INTO `helpsubsection` VALUES (466, '', 'When you click on Create New Leave Type button, the following screen will be displayed', '');
INSERT INTO `helpsubsection` VALUES (467, 'a', '', 'helpimages/1200379144leavetype1.jpg');
INSERT INTO `helpsubsection` VALUES (468, 'a.', 'Enter the leave type', '');
INSERT INTO `helpsubsection` VALUES (469, 'b.', 'Click on Save to save the new leave type.', '');
INSERT INTO `helpsubsection` VALUES (470, 'a.', 'Click on the Delete link for the leave type you want to delete.', '');
INSERT INTO `helpsubsection` VALUES (471, 'b.', 'The following confirmation message will be displayed on your screen', '');
INSERT INTO `helpsubsection` VALUES (472, 'c', '', 'helpimages/1200379438leavetype2.jpg');
INSERT INTO `helpsubsection` VALUES (473, 'c.', 'Clicking on OK will delete the leave type and clicking Cancel will not.', '');
INSERT INTO `helpsubsection` VALUES (474, '', 'Under Modules settings, clicking on Districts displays the following screen.', '');
INSERT INTO `helpsubsection` VALUES (475, 'a', '', 'helpimages/1200379520districts.jpg');
INSERT INTO `helpsubsection` VALUES (476, 'a.', 'Click on Create New District button to create a new district', '');
INSERT INTO `helpsubsection` VALUES (477, 'b.', 'Click on Edit link to edit the district ', '');
INSERT INTO `helpsubsection` VALUES (478, 'c.', 'Click on Delete link to delete a district', '');
INSERT INTO `helpsubsection` VALUES (479, 'a.', 'When you click on Create New District button, the following screen will be displayed', '');
INSERT INTO `helpsubsection` VALUES (480, 'b', '', 'helpimages/1200379777district2.jpg');
INSERT INTO `helpsubsection` VALUES (481, 'b.', 'Enter the District name', '');
INSERT INTO `helpsubsection` VALUES (482, 'c.', 'Click on Save to save the new dstrict.', '');
INSERT INTO `helpsubsection` VALUES (483, 'a.', 'Click on the Edit link for the district you want to edit.', '');
INSERT INTO `helpsubsection` VALUES (484, 'b.', 'The following screen will be displayed', '');
INSERT INTO `helpsubsection` VALUES (485, 'c', '', 'helpimages/1200380003district3.jpg');
INSERT INTO `helpsubsection` VALUES (486, 'c.', 'Make the necessary changes and click on Save to save the changes.', '');
INSERT INTO `helpsubsection` VALUES (487, 'a.', 'Click on the Delete link for the district you want to delete.', '');
INSERT INTO `helpsubsection` VALUES (488, 'b.', 'The following confirmation message will be displayed on your screen', '');
INSERT INTO `helpsubsection` VALUES (489, 'c', '', 'helpimages/1200380096district4.jpg');
INSERT INTO `helpsubsection` VALUES (490, 'c.', 'Clicking on OK will delete the district and clicking Cancel will not.', '');
INSERT INTO `helpsubsection` VALUES (491, '', 'Under Modules settings, clicking on Tribes displays the following screen.', '');
INSERT INTO `helpsubsection` VALUES (492, 'a', '', 'helpimages/1200380284tribes.jpg');
INSERT INTO `helpsubsection` VALUES (493, 'a.', 'Click on Create New Tribes button to create a new tribe', '');
INSERT INTO `helpsubsection` VALUES (494, 'b.', 'Click on Edit link to edit the tribe details', '');
INSERT INTO `helpsubsection` VALUES (495, 'c.', 'Click on Delete link to delete a tribe', '');
INSERT INTO `helpsubsection` VALUES (496, 'a.', 'When you click on Create New Tribe button, the following screen will be displayed', '');
INSERT INTO `helpsubsection` VALUES (497, 'b', '', 'helpimages/1200380557tribes1.jpg');
INSERT INTO `helpsubsection` VALUES (498, 'b.', 'Enter the tribe name', '');
INSERT INTO `helpsubsection` VALUES (499, 'c.', 'Click on Save to save the new tribe.', '');
INSERT INTO `helpsubsection` VALUES (500, 'a.', 'Click on the Edit link for the tribe you want to edit.', '');
INSERT INTO `helpsubsection` VALUES (501, 'b.', 'The following screen will be displayed', '');
INSERT INTO `helpsubsection` VALUES (502, 'b', '', 'helpimages/1200380725tribes2.jpg');
INSERT INTO `helpsubsection` VALUES (503, 'c.', 'Make the necessary changes and click on Save to save the changes.', '');
INSERT INTO `helpsubsection` VALUES (504, 'a.', 'Click on the Delete link for the tribe you want to delete.', '');
INSERT INTO `helpsubsection` VALUES (505, 'b.', 'The following confirmation message will be displayed on your screen', '');
INSERT INTO `helpsubsection` VALUES (506, 'c', '', 'helpimages/1200381041tribes4.jpg');
INSERT INTO `helpsubsection` VALUES (507, 'c.', 'Clicking on OK will delete the tribe and clicking <i>Cancel</i> will not.', '');
INSERT INTO `helpsubsection` VALUES (508, '', 'Under Modules settings, clicking on User Rights displays the following screen.', '');
INSERT INTO `helpsubsection` VALUES (509, 'a', '', 'helpimages/1200381345rights1.jpg');
INSERT INTO `helpsubsection` VALUES (510, 'a.', 'Click on Create New User Right button to create a new user right', '');
INSERT INTO `helpsubsection` VALUES (511, 'b.', 'Click on Edit link of the user right you want to edit', '');
INSERT INTO `helpsubsection` VALUES (512, 'c.', 'Click on Delete link for the user right you want to delete', '');
INSERT INTO `helpsubsection` VALUES (513, 'a.', 'Clicking on Create New User Right button displays the following screen', '');
INSERT INTO `helpsubsection` VALUES (514, 'b', '', 'helpimages/1200381717rights2.jpg');
INSERT INTO `helpsubsection` VALUES (515, 'b.', 'Enter the right name', '');
INSERT INTO `helpsubsection` VALUES (516, 'c.', 'Click on Save to save the right.', '');
INSERT INTO `helpsubsection` VALUES (517, 'a.', 'Click on the Edit link of the right you want to edit. The following screen will be displayed.', '');
INSERT INTO `helpsubsection` VALUES (518, 'b', '', 'helpimages/1200381918rights5.jpg');
INSERT INTO `helpsubsection` VALUES (519, 'b.', 'Make the necessary changes and click on Save to save the changes.', '');
INSERT INTO `helpsubsection` VALUES (520, 'a.', 'Click on Delete link for the user right you want to delete. ', '');
INSERT INTO `helpsubsection` VALUES (521, 'b.', 'The following confirmation message will be displayed on the screen.', '');
INSERT INTO `helpsubsection` VALUES (522, 'c', '', 'helpimages/1200382097rights3.jpg');
INSERT INTO `helpsubsection` VALUES (523, 'c.', 'Clicking on OK will delete the selected user right.', '');
INSERT INTO `helpsubsection` VALUES (524, 'd.', 'Clicking Cancel will close the message and returns to the previous window.', '');
INSERT INTO `helpsubsection` VALUES (525, '', 'Under Modules settings, clicking on Disciplinary Actions displays the following screen.', '');
INSERT INTO `helpsubsection` VALUES (526, 'a', '', 'helpimages/1200382306discpline.jpg');
INSERT INTO `helpsubsection` VALUES (527, 'a.', 'Click on Create New Disciplinary Actions button to create a new disciplinary action', '');
INSERT INTO `helpsubsection` VALUES (528, 'b.', 'Click on Edit link of the disciplinary action you want to edit', '');
INSERT INTO `helpsubsection` VALUES (529, 'c.', 'Click on Delete link for to the disciplinary action you want to delete ', '');
INSERT INTO `helpsubsection` VALUES (530, 'a.', 'Clicking on Create New Disciplinary Actions button displays the following screen', '');
INSERT INTO `helpsubsection` VALUES (531, 'b', '', 'helpimages/1200382739discipline1.jpg');
INSERT INTO `helpsubsection` VALUES (532, 'b.', 'Enter the new disciplinary action', '');
INSERT INTO `helpsubsection` VALUES (533, 'c.', 'Click on Save to save the action.', '');
INSERT INTO `helpsubsection` VALUES (534, 'a.', 'Click on the Edit link of the action you want to edit. The following screen will be displayed.', '');
INSERT INTO `helpsubsection` VALUES (535, 'b', '', 'helpimages/1200382857discipline2.jpg');
INSERT INTO `helpsubsection` VALUES (536, 'b.', 'Make the necessary changes and click on Save to save the changes.', '');
INSERT INTO `helpsubsection` VALUES (537, 'a.', 'Click on Delete link for the action you want to delete. The following confirmation message will be displayed on the screen.', '');
INSERT INTO `helpsubsection` VALUES (538, 'b', '', 'helpimages/1200383028discipline4.jpg');
INSERT INTO `helpsubsection` VALUES (539, 'b.', 'Clicking on OK will display the selected action.', '');
INSERT INTO `helpsubsection` VALUES (540, 'c.', 'Clicking Cancel will close the message and returns to the previous window without deleting the action', '');
INSERT INTO `helpsubsection` VALUES (541, 'a.', 'Clicking on Create New Service Types button displays the following screen', '');
INSERT INTO `helpsubsection` VALUES (542, 'b', '', 'helpimages/1200383325servicetype.jpg');
INSERT INTO `helpsubsection` VALUES (543, 'b.', 'Enter the new service type', '');
INSERT INTO `helpsubsection` VALUES (544, 'c.', 'Enter the start and End times of the service type', '');
INSERT INTO `helpsubsection` VALUES (545, 'd.', 'Click on Save to save the service type', '');
INSERT INTO `helpsubsection` VALUES (546, 'a.', 'Click on the Edit link of the service type you want to edit. The following screen will be displayed.', '');
INSERT INTO `helpsubsection` VALUES (547, 'b', '', 'helpimages/1200383594servicetype2.jpg');
INSERT INTO `helpsubsection` VALUES (548, 'b.', 'Make the necessary changes and click on Save to save the changes.', '');
INSERT INTO `helpsubsection` VALUES (549, 'a.', 'Click on Delete link for the service type you want to delete. ', '');
INSERT INTO `helpsubsection` VALUES (550, 'b.', 'The following confirmation message will be displayed on the screen.', '');
INSERT INTO `helpsubsection` VALUES (551, 'c', '', 'helpimages/1200383698servicetype4.jpg');
INSERT INTO `helpsubsection` VALUES (552, 'c.', 'Clicking on OK will delete the selected service type.', '');
INSERT INTO `helpsubsection` VALUES (553, 'd.', 'Clicking Cancel will close the message and returns to the previous window without deleting the service type', '');
INSERT INTO `helpsubsection` VALUES (554, '', 'Under Modules settings, clicking on Item Types displays the following screen.', '');
INSERT INTO `helpsubsection` VALUES (555, 'a', '', 'helpimages/1200384200itemtypes1.jpg');
INSERT INTO `helpsubsection` VALUES (556, 'a.', 'Click on Create New Item Type button to create a new item type', '');
INSERT INTO `helpsubsection` VALUES (557, 'b.', 'Click on Edit link of the item type you want to edit', '');
INSERT INTO `helpsubsection` VALUES (558, 'c.', 'Click on Delete link for the item type you want to delete', '');
INSERT INTO `helpsubsection` VALUES (559, 'a.', 'Clicking on Create New Item Type button displays the following screen', '');
INSERT INTO `helpsubsection` VALUES (560, 'b', '', 'helpimages/1200384527itemtype3.jpg');
INSERT INTO `helpsubsection` VALUES (561, 'b.', 'Enter the new item type', '');
INSERT INTO `helpsubsection` VALUES (562, 'c.', 'Enter the start and End times', '');
INSERT INTO `helpsubsection` VALUES (563, 'd.', 'Click on Save to item type', '');
INSERT INTO `helpsubsection` VALUES (564, 'a.', 'Click on the Edit link of the item type you want to edit. ', '');
INSERT INTO `helpsubsection` VALUES (565, 'b.', 'The following screen will be displayed', '');
INSERT INTO `helpsubsection` VALUES (566, 'c', '', 'helpimages/1200384652itemtype5.jpg');
INSERT INTO `helpsubsection` VALUES (567, 'c.', 'Make the necessary changes and click on Save to save the changes.', '');
INSERT INTO `helpsubsection` VALUES (568, 'a.', 'Click on Delete link for the item type you want to delete. ', '');
INSERT INTO `helpsubsection` VALUES (569, 'b.', 'The following confirmation message will be displayed on the screen.', '');
INSERT INTO `helpsubsection` VALUES (570, 'c', '', 'helpimages/1200384848itemtype4.jpg');
INSERT INTO `helpsubsection` VALUES (571, 'c.', 'Clicking on OK will delete  the selected item type.', '');
INSERT INTO `helpsubsection` VALUES (572, 'd.', 'Clicking Cancel will close the message and returns to the previous window without deleting the item type', '');
INSERT INTO `helpsubsection` VALUES (573, '', 'Under Modules settings, clicking on Item Status displays the following screen.', '');
INSERT INTO `helpsubsection` VALUES (574, 'a', '', 'helpimages/1200385120status.jpg');
INSERT INTO `helpsubsection` VALUES (575, 'a.', 'Click on Create New Item Status button to create a new item status', '');
INSERT INTO `helpsubsection` VALUES (576, 'b.', 'Click on Edit link of the item status you want to edit', '');
INSERT INTO `helpsubsection` VALUES (577, 'c.', 'Click on Delete link of the item status you want to delete', '');
INSERT INTO `helpsubsection` VALUES (578, 'a.', 'Clicking on Create New Item Status button displays the following screen', '');
INSERT INTO `helpsubsection` VALUES (579, 'b', '', 'helpimages/1200385350status1.jpg');
INSERT INTO `helpsubsection` VALUES (580, 'b.', 'Enter the new item status', '');
INSERT INTO `helpsubsection` VALUES (581, 'c.', 'Click on Save to save the item status', '');
INSERT INTO `helpsubsection` VALUES (582, 'a.', 'Click on the Edit link of the item status you want to edit. ', '');
INSERT INTO `helpsubsection` VALUES (583, 'b.', 'The following screen will be displayed.', '');
INSERT INTO `helpsubsection` VALUES (584, 'c', '', 'helpimages/1200385628status5.jpg');
INSERT INTO `helpsubsection` VALUES (585, 'c.', 'Make the necessary changes and click on Save to save the changes.', '');
INSERT INTO `helpsubsection` VALUES (586, 'a.', 'Click on Delete link for the item status you want to delete. ', '');
INSERT INTO `helpsubsection` VALUES (587, 'b.', 'The following confirmation message will be displayed on the screen.', '');
INSERT INTO `helpsubsection` VALUES (588, 'c', '', 'helpimages/1200385713status6.jpg');
INSERT INTO `helpsubsection` VALUES (589, 'c.', 'Clicking on OK will delete  the selected item status.', '');
INSERT INTO `helpsubsection` VALUES (590, 'd.', 'Clicking Cancel will close the message and returns to the previous window without deleting the item status', '');
INSERT INTO `helpsubsection` VALUES (591, '', 'Under Modules settings, clicking on Guard Status displays the following screen.', '');
INSERT INTO `helpsubsection` VALUES (592, 'a', '', 'helpimages/1200385898guardstatuss.jpg');
INSERT INTO `helpsubsection` VALUES (593, 'a.', 'Click on Create New Guard Status button to create a new guard status', '');
INSERT INTO `helpsubsection` VALUES (594, 'b.', 'Click on Edit link of the guard status you want to edit', '');
INSERT INTO `helpsubsection` VALUES (595, 'c.', 'Click on Delete link of the guard status you want to delete', '');
INSERT INTO `helpsubsection` VALUES (596, 'a.', 'Clicking on Create New Guard Status button displays the following screen', '');
INSERT INTO `helpsubsection` VALUES (597, 'b', '', 'helpimages/1200386134guardstatuss1.jpg');
INSERT INTO `helpsubsection` VALUES (598, 'b.', 'Enter the new guard status', '');
INSERT INTO `helpsubsection` VALUES (599, 'c.', 'Click on Save to guard status', '');
INSERT INTO `helpsubsection` VALUES (600, 'a.', 'Click on the Edit link of the guard status you want to edit', '');
INSERT INTO `helpsubsection` VALUES (601, 'b.', 'The following screen will be displayed.', '');
INSERT INTO `helpsubsection` VALUES (602, 'c', '', 'helpimages/1200386232guardstatuss2.jpg');
INSERT INTO `helpsubsection` VALUES (603, 'c.', 'Make the necessary changes and click on Save to save the changes.', '');
INSERT INTO `helpsubsection` VALUES (604, 'a.', 'Click on Delete link for the guard status you want to delete. ', '');
INSERT INTO `helpsubsection` VALUES (605, 'b.', 'The following confirmation message will be displayed on the screen.', '');
INSERT INTO `helpsubsection` VALUES (606, 'c', '', 'helpimages/1200386383guardstatuss5.jpg');
INSERT INTO `helpsubsection` VALUES (607, 'c.', 'Clicking on OK will delete  the selected guard status.', '');
INSERT INTO `helpsubsection` VALUES (608, 'd.', 'Clicking Cancel will close the message and returns to the previous window.', '');
INSERT INTO `helpsubsection` VALUES (609, 'a.', 'Go to Dashboard', '');
INSERT INTO `helpsubsection` VALUES (610, 'b.', 'Under Transport Management, click Fuel Distribution', '');
INSERT INTO `helpsubsection` VALUES (611, 'c', '', 'helpimages/1203077475fuel.jpg');
INSERT INTO `helpsubsection` VALUES (612, 'c.', 'The following screen will be displayed ', '');
INSERT INTO `helpsubsection` VALUES (613, 'd', '', 'helpimages/1203077733fuel.jpg');
INSERT INTO `helpsubsection` VALUES (614, 'i.', 'Click Add Fuel Distribution to add new distribution report', '');
INSERT INTO `helpsubsection` VALUES (615, 'ii.', 'To search for a distribution report, type in search value', '');
INSERT INTO `helpsubsection` VALUES (616, 'iii.', 'Select the criteria you want to search for', '');
INSERT INTO `helpsubsection` VALUES (617, 'iv.', 'Click Search Distribution Reports to search for reports.', '');
INSERT INTO `helpsubsection` VALUES (618, 'v.', 'Click Edit to edit a distribution report', '');
INSERT INTO `helpsubsection` VALUES (619, 'vi.', 'Click Delete to delete a distribution report', '');
INSERT INTO `helpsubsection` VALUES (620, 'a.', 'When you click on Add Fuel Distribution, the screen below is displayed', '');
INSERT INTO `helpsubsection` VALUES (621, 'b', '', 'helpimages/1203078196addfuel.jpg');
INSERT INTO `helpsubsection` VALUES (622, 'b.', 'Fill in the fields of the form. All fields marked with * are required.', '');
INSERT INTO `helpsubsection` VALUES (623, 'c.', 'Select the vehicle for which you are adding fuel report.', '');
INSERT INTO `helpsubsection` VALUES (624, 'd.', 'Enter the mileage reading for the vehicle.', '');
INSERT INTO `helpsubsection` VALUES (625, 'e.', 'Enter the amount (number of litres) of fuel added.', '');
INSERT INTO `helpsubsection` VALUES (626, 'f.', 'Add the petro station where you got the fuel.', '');
INSERT INTO `helpsubsection` VALUES (627, 'g.', 'Click on Save to save the report.', '');
INSERT INTO `helpsubsection` VALUES (628, 'a.', 'Click on Edit link of the report you want to edit. The following screen will be displayed', '');
INSERT INTO `helpsubsection` VALUES (629, 'b', '', 'helpimages/1203078618editfuel.jpg');
INSERT INTO `helpsubsection` VALUES (630, 'b.', 'Make the necessary changes in the report.', '');
INSERT INTO `helpsubsection` VALUES (631, 'c.', 'Click Save to save the changes you have made or Back to return the the previous page without saving.', '');
INSERT INTO `helpsubsection` VALUES (632, 'a.', 'Click on Delete link of the report you want to delete', '');
INSERT INTO `helpsubsection` VALUES (633, 'b.', 'A message is displayed on the screen to confirm whether you want to delete the report.', '');
INSERT INTO `helpsubsection` VALUES (634, 'c', '', 'helpimages/1203078832deletefuel.jpg');
INSERT INTO `helpsubsection` VALUES (635, 'c.', 'When you click OK, the report will be deleted, if you click Cancel, the item will not be deleted.', '');
INSERT INTO `helpsubsection` VALUES (636, 'a.', 'Go to Dashboard', '');
INSERT INTO `helpsubsection` VALUES (637, 'b.', 'Under Transport Management, click Service Vehicles', '');
INSERT INTO `helpsubsection` VALUES (638, 'c', '', 'helpimages/1203079031servicevehicle.jpg');
INSERT INTO `helpsubsection` VALUES (639, 'c.', 'The following screen will be displayed ', '');
INSERT INTO `helpsubsection` VALUES (640, 'd', '', 'helpimages/1203079256managevehicle.jpg');
INSERT INTO `helpsubsection` VALUES (641, 'i.', 'Click Add Service Report to add new service report', '');
INSERT INTO `helpsubsection` VALUES (642, 'ii.', 'To search for a service report, type in search value', '');
INSERT INTO `helpsubsection` VALUES (643, 'iii.', 'Select the criteria you want to search for.', '');
INSERT INTO `helpsubsection` VALUES (644, 'iv.', 'Click Search Service Reports to search for reports.', '');
INSERT INTO `helpsubsection` VALUES (645, 'v.', 'Click Edit to edit a service report', '');
INSERT INTO `helpsubsection` VALUES (646, 'vi.', 'Click Delete to delete a service report', '');
INSERT INTO `helpsubsection` VALUES (647, 'a.', 'When you click on Add Service Report, the screen below is displayed', '');
INSERT INTO `helpsubsection` VALUES (648, 'b', '', 'helpimages/1203079512addservicereport.jpg');
INSERT INTO `helpsubsection` VALUES (649, 'b.', 'Fill in the fields of the form. All fields marked with * are required.', '');
INSERT INTO `helpsubsection` VALUES (650, 'c.', 'Enter the date when the vehicle was serviced.', '');
INSERT INTO `helpsubsection` VALUES (651, 'd.', 'Select the vehicle for which you are adding the report.', '');
INSERT INTO `helpsubsection` VALUES (652, 'e.', 'Enter the part of the vehicle serviced or replaced', '');
INSERT INTO `helpsubsection` VALUES (653, 'f.', 'Enter the description of the service done.', '');
INSERT INTO `helpsubsection` VALUES (654, 'g.', 'Click on Save to save the report.', '');
INSERT INTO `helpsubsection` VALUES (655, 'a.', 'Click on Edit link of the report you want to edit. The following screen will be displayed', '');
INSERT INTO `helpsubsection` VALUES (656, 'b', '', 'helpimages/1203079791editservicereport.jpg');
INSERT INTO `helpsubsection` VALUES (657, 'b.', 'Make the necessary changes in the report.', '');
INSERT INTO `helpsubsection` VALUES (658, 'c.', 'Click Save to save the changes you have made or Back to return the the previous page without saving.', '');
INSERT INTO `helpsubsection` VALUES (659, 'a.', 'Click on Delete link of the report you want to delete', '');
INSERT INTO `helpsubsection` VALUES (660, 'b.', 'A message is displayed on the screen to confirm whether you want to delete the report.', '');
INSERT INTO `helpsubsection` VALUES (661, 'c', '', 'helpimages/1203080115deleteserv_ice.jpg');
INSERT INTO `helpsubsection` VALUES (662, 'c.', 'When you click OK, the report will be deleted, if you click Cancel, the item will not be deleted.', '');
INSERT INTO `helpsubsection` VALUES (663, 'a.', 'Go to Dashboard', '');
INSERT INTO `helpsubsection` VALUES (664, 'b.', 'Under Transport Management, click Vehicle log', '');
INSERT INTO `helpsubsection` VALUES (665, 'c', '', 'helpimages/1203080878dailylog.jpg');
INSERT INTO `helpsubsection` VALUES (666, 'c.', 'If there is no logbook information for the current date, the following screen will be displayed', '');
INSERT INTO `helpsubsection` VALUES (667, 'd', '', 'helpimages/1203081042nolog.jpg');
INSERT INTO `helpsubsection` VALUES (668, 'd.', 'Select the vehicle (mobile) number for the vehicle you want to add the logbook information for the current date. The following screen will be displayed.', '');
INSERT INTO `helpsubsection` VALUES (669, 'e', '', 'helpimages/1203081316newlog.jpg');
INSERT INTO `helpsubsection` VALUES (670, 'i.', 'Enter the amount of fuel (litres) which the car has in the morning.', '');
INSERT INTO `helpsubsection` VALUES (671, 'ii.', 'Select the type of shift', '');
INSERT INTO `helpsubsection` VALUES (672, 'iii.', 'Select the driver of the vehicle', '');
INSERT INTO `helpsubsection` VALUES (673, 'iv.', 'Select the car commander of the vehicle', '');
INSERT INTO `helpsubsection` VALUES (674, 'v.', 'Click on Add Record to add a row for the records. Enter the values of the time out, From, Odometer Start and Reason', '');
INSERT INTO `helpsubsection` VALUES (675, 'vi.', 'Click on Save to save the current record. ', '');
INSERT INTO `helpsubsection` VALUES (676, 'vii.', 'You can update that record at any time during the same day.', '');
INSERT INTO `helpsubsection` VALUES (677, 'e.', 'You can click on the link previous logbooks to view logbooks for previous days. The following screen will be displayed', '');
INSERT INTO `helpsubsection` VALUES (678, 'f', '', 'helpimages/1203081791prevlog.jpg');
INSERT INTO `helpsubsection` VALUES (679, 'f.', 'When you click on the vehicle, you view its logbook information for the selected date. The following screen will be displayed.', '');
INSERT INTO `helpsubsection` VALUES (680, 'g', '', 'helpimages/1203082102carvehiclelog.jpg');
INSERT INTO `helpsubsection` VALUES (681, 'g.', 'If there are vehicles with logbook information for the current date, the following screen will be displayed, showing the vehicles which have logbook information.', '');
INSERT INTO `helpsubsection` VALUES (682, 'h', '', 'helpimages/1203082629prevlogs.jpg');
INSERT INTO `helpsubsection` VALUES (683, 'h.', 'Click on the vehicle number to view/add more logbook information about that particular vehicle. The following screen will be displayed.', '');
INSERT INTO `helpsubsection` VALUES (684, 'i', '', 'helpimages/1203082856addinglog.jpg');
INSERT INTO `helpsubsection` VALUES (685, 'i.', 'You can update the current record and at the same time add more records for the selected vehicle logbook.', '');
INSERT INTO `helpsubsection` VALUES (686, 'a.', 'Go to Dashboard', '');
INSERT INTO `helpsubsection` VALUES (687, 'b.', 'Under Technical Management, click Alarms Installed', '');
INSERT INTO `helpsubsection` VALUES (688, 'c', '', 'helpimages/1203083312alarms.jpg');
INSERT INTO `helpsubsection` VALUES (689, 'c.', 'The following screen will be displayed.', '');
INSERT INTO `helpsubsection` VALUES (690, 'd', '', 'helpimages/1203083437managealarms.jpg');
INSERT INTO `helpsubsection` VALUES (691, 'i.', 'Click Add Alarm to add a new alarm', '');
INSERT INTO `helpsubsection` VALUES (692, 'ii.', 'To view the serviced alarms, decommissioned alarms and transferred alarms, click on the appropriate link.', '');
INSERT INTO `helpsubsection` VALUES (693, 'iii.', 'Select the alarm(s) you want to service, decommission or transfer and click on the corresponding buttom at the bottom.', '');
INSERT INTO `helpsubsection` VALUES (694, 'iv.', 'Click Edit to edit an alarm', '');
INSERT INTO `helpsubsection` VALUES (695, 'v.', 'Click Delete to delete an alarm.', '');
INSERT INTO `helpsubsection` VALUES (696, 'a.', 'When you click on Add Alarm, the following screen will be displayed.', '');
INSERT INTO `helpsubsection` VALUES (697, 'b', '', 'helpimages/1203084189addalarms.jpg');
INSERT INTO `helpsubsection` VALUES (698, 'b.', 'Enter the fields in the form, fields marked with * are required.', '');
INSERT INTO `helpsubsection` VALUES (699, 'c.', 'Enter the alarm ID, check whether the ID you enter does not exist.', '');
INSERT INTO `helpsubsection` VALUES (700, 'd.', 'Select the assignment for which you are adding the alarm', '');
INSERT INTO `helpsubsection` VALUES (701, 'e.', 'Enter the start date, end date and the exipry date of the alarm.', '');
INSERT INTO `helpsubsection` VALUES (702, 'f.', 'Click on Save to save the alarm.', '');
INSERT INTO `helpsubsection` VALUES (703, 'a.', 'When you click on the link Serviced Alarms, the following screen will be displayed', '');
INSERT INTO `helpsubsection` VALUES (704, 'b', '', 'helpimages/1203084547servicedalarms.jpg');
INSERT INTO `helpsubsection` VALUES (705, 'a.', 'When you click on the link Decommissioned Alarms, the following screen will be displayed', '');
INSERT INTO `helpsubsection` VALUES (706, 'b', '', 'helpimages/1203084598decommissionedalarms.jpg');
INSERT INTO `helpsubsection` VALUES (707, 'a.', 'To transfer alarms, select the alarm(s) you want to transfer', '');
INSERT INTO `helpsubsection` VALUES (708, 'b.', 'At the bottom, click on the Transfer Alarms button. The following screen will be displayed.', '');
INSERT INTO `helpsubsection` VALUES (709, 'c', '', 'helpimages/1203339720transferalarms.jpg');
INSERT INTO `helpsubsection` VALUES (710, 'c.', 'select the new assignments (the ones you are transferring  the alarms to)', '');
INSERT INTO `helpsubsection` VALUES (711, 'd.', 'Click on Save to complete the transfer.', '');
INSERT INTO `helpsubsection` VALUES (712, 'a.', 'When you click on the link Transferred Alarms, the following screen will be displayed', '');
INSERT INTO `helpsubsection` VALUES (713, 'b', '', 'helpimages/1203340107transferedalarms.jpg');
INSERT INTO `helpsubsection` VALUES (714, 'a.', 'Go to Dashboard', '');
INSERT INTO `helpsubsection` VALUES (715, 'b.', 'Under Tools, click Schedule Calender', '');
INSERT INTO `helpsubsection` VALUES (716, 'c', '', 'helpimages/1203340273schedule.jpg');
INSERT INTO `helpsubsection` VALUES (717, 'c.', 'If there are no guard schedules made for the current day, the following screen will be displayed, showing all guards registered.', '');
INSERT INTO `helpsubsection` VALUES (718, 'd', '', 'helpimages/1203340428schedules1.jpg');
INSERT INTO `helpsubsection` VALUES (719, 'd.', 'Click on the link Previous Schedules to view the guard schedules for the previous days.', '');
INSERT INTO `helpsubsection` VALUES (720, 'e.', 'Click on the Edit link to create a new schedule or to edit the current schedule.', '');
INSERT INTO `helpsubsection` VALUES (721, 'a.', 'When you click on the previous schedules link, the following will be displayed, showing the guards and their statuses.', '');
INSERT INTO `helpsubsection` VALUES (722, 'b', '', 'helpimages/1203341065prevschedule.jpg');
INSERT INTO `helpsubsection` VALUES (723, 'b.', 'Click on the number under each category to view the IDÃ¢â‚¬â„¢s of the guards under that category.', '');
INSERT INTO `helpsubsection` VALUES (724, 'a.', 'To edit the current dayÃ¢â‚¬â„¢s schedule (or creating a new schedule), click on the Edit link. The following screen will be displayed displaying the various schedules.', '');
INSERT INTO `helpsubsection` VALUES (725, 'b', '', 'helpimages/1203341295editschedule.jpg');
INSERT INTO `helpsubsection` VALUES (726, 'b.', 'The column marked TodayÃ¢â‚¬â„¢s Loc shows the guards current status. If he is sick, indicate it as /SICK, if he is assigned, select the call sign of the assignment.', '');
INSERT INTO `helpsubsection` VALUES (727, 'c.', 'The column marked 24  shows the guards status for the previous day.', '');
INSERT INTO `helpsubsection` VALUES (728, 'd.', 'The column marked OT 24 shows the guards overtime status of the previous day. If he did overtime the previous day, select the call sign of the assignment where he was.', '');
INSERT INTO `helpsubsection` VALUES (729, 'e.', 'The column marked OT 24 shows the guards overtime status of the current day.', '');
INSERT INTO `helpsubsection` VALUES (730, 'f.', 'After making the necessary schedules/changes, click on the Save Changes button, the following screen will be displayed.', '');
INSERT INTO `helpsubsection` VALUES (731, 'g', '', 'helpimages/1203341767saveschedule.jpg');

-- --------------------------------------------------------

-- 
-- Table structure for table `illness`
-- 

CREATE TABLE `illness` (
  `id` bigint(20) NOT NULL auto_increment,
  `name` varchar(255) NOT NULL default '',
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

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

CREATE TABLE `incidentaction` (
  `id` bigint(20) NOT NULL auto_increment,
  `incident` varchar(255) default NULL,
  `date_of_action` date default NULL,
  `actiontaken` varchar(255) default NULL,
  `createdby` bigint(20) default NULL,
  `datecreated` date default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

-- 
-- Dumping data for table `incidentaction`
-- 

INSERT INTO `incidentaction` VALUES (1, 'H34-d', '2005-03-03', 'escalated to commander james', 1, '2007-12-03');
INSERT INTO `incidentaction` VALUES (2, '11', '2007-06-04', 'incident worked on', 1, '2007-12-03');

-- --------------------------------------------------------

-- 
-- Table structure for table `incidentactions`
-- 

CREATE TABLE `incidentactions` (
  `id` bigint(20) NOT NULL auto_increment,
  `details` text NOT NULL,
  `date_of_entry` datetime NOT NULL default '0000-00-00 00:00:00',
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=latin1 AUTO_INCREMENT=31 ;

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
INSERT INTO `incidentactions` VALUES (16, 'The dog ate his cat.', '2007-12-07 11:24:16');
INSERT INTO `incidentactions` VALUES (17, 'He then beat his master', '2007-12-07 11:24:49');
INSERT INTO `incidentactions` VALUES (18, 'and then smiled at his wife!!!', '2007-12-07 11:25:21');
INSERT INTO `incidentactions` VALUES (19, 'The boy then beat the dog till it was lame', '2007-12-07 11:26:30');
INSERT INTO `incidentactions` VALUES (20, 'I then came in to intervene', '2007-12-07 11:27:12');
INSERT INTO `incidentactions` VALUES (21, 'I also called the police to intervene', '2007-12-07 11:28:53');
INSERT INTO `incidentactions` VALUES (22, 'I also noted the difference in time of arrival.', '2007-12-07 11:29:27');
INSERT INTO `incidentactions` VALUES (23, 'started the alarm to evacuate people from building', '2008-01-11 14:48:54');
INSERT INTO `incidentactions` VALUES (24, 'Carried the babies out of the building', '2008-01-11 14:55:05');
INSERT INTO `incidentactions` VALUES (25, 'The guard set off the alarm and all people were evacuated', '2008-03-19 15:59:35');
INSERT INTO `incidentactions` VALUES (26, 'New premises need much attention.', '2008-03-26 11:56:27');
INSERT INTO `incidentactions` VALUES (27, 'ddd', '2008-03-26 13:43:10');
INSERT INTO `incidentactions` VALUES (28, 'ff', '2008-03-26 13:46:45');
INSERT INTO `incidentactions` VALUES (29, 'sdsds', '2008-03-26 13:49:25');
INSERT INTO `incidentactions` VALUES (30, 'uu', '2008-03-26 14:14:53');

-- --------------------------------------------------------

-- 
-- Table structure for table `incidents`
-- 

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
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

-- 
-- Dumping data for table `incidents`
-- 

INSERT INTO `incidents` VALUES (1, '1196967076', 'D145-N', '2008-02-12 00:00:00', 'H013', 'There was a bang on the door before the guard escaped with a big bag of coins', 'F554', '07:00:00', 'P0081', '08:00:00', '16,20,21', '2007-12-06 17:32:10');
INSERT INTO `incidents` VALUES (2, '1196949576', 'H230-D', '2007-12-16 00:00:00', 'H013', 'The dog was bitten by the guard.', 'F554', '05:30:00', 'P0081', '06:00:00', '4,5,6,7,8', '2007-12-06 19:53:28');
INSERT INTO `incidents` VALUES (3, '1200050981', 'H313-N', '2008-02-01 00:00:00', 'Y907', 'These premises need to be secure', 'reporter name', '08:30:00', 'checker name', '08:30:00', '23,24', '2008-01-11 14:48:54');
INSERT INTO `incidents` VALUES (5, '1206521654', 'STB1', '2008-03-26 00:00:00', 'W344', 'The security door is week', 'Musoke Paul', '07:30:00', 'Manager', '08:00:00', '26', '2008-03-26 11:56:27');
INSERT INTO `incidents` VALUES (8, '1206530063', 'H123', '2008-03-27 00:00:00', 'H117', 'uuu', 'uuu', '', 'uuu', '', '30', '2008-03-26 14:14:53');

-- --------------------------------------------------------

-- 
-- Table structure for table `inspections`
-- 

CREATE TABLE `inspections` (
  `id` bigint(20) NOT NULL auto_increment,
  `madeby` varchar(250) NOT NULL default '',
  `isactive` enum('N','Y') NOT NULL default 'Y',
  `date_of_entry` datetime NOT NULL default '0000-00-00 00:00:00',
  `commentids` text NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=latin1 AUTO_INCREMENT=23 ;

-- 
-- Dumping data for table `inspections`
-- 

INSERT INTO `inspections` VALUES (15, 'K903', 'Y', '2008-05-07 00:00:00', '65');
INSERT INTO `inspections` VALUES (18, 'J201', 'Y', '2008-05-20 00:00:00', '72,71');
INSERT INTO `inspections` VALUES (19, 'J201', 'Y', '2008-05-19 00:00:00', '75,73');
INSERT INTO `inspections` VALUES (22, 'Zixina Michael', 'Y', '2008-06-03 00:00:00', '79,78');

-- --------------------------------------------------------

-- 
-- Table structure for table `itemissue`
-- 

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
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=latin1 AUTO_INCREMENT=26 ;

-- 
-- Dumping data for table `itemissue`
-- 

INSERT INTO `itemissue` VALUES (8, 'return', '123123', '1', '2007-12-02 00:00:00', 'H117', 'H230-D', 'Old - Usable', 'The car is old and usable. Can you believe that!', '2007-12-04 17:12:20', '1');
INSERT INTO `itemissue` VALUES (10, 'issue', 'UAB 875H', '1', '2007-12-07 00:00:00', 'T012', 'B666-H', 'Old - Usable', 'It has just been flown in from Saudi Arabia yesterday', '2008-02-12 13:29:55', '1');
INSERT INTO `itemissue` VALUES (11, 'issue', '523413123', '1', '2007-12-02 00:00:00', 'T023', 'H300-N', 'New', 'It has just been flown in from Saudi Arabia again', '2007-12-04 17:05:55', '1');
INSERT INTO `itemissue` VALUES (13, 'return', 'UAB 875H', '1', '2008-01-11 00:00:00', 'F554', 'KKK1-D', 'Obsolesent', 'good', '2008-01-12 12:50:51', '1');
INSERT INTO `itemissue` VALUES (18, 'return', '6245235', '1', '2008-04-01 00:00:00', 'F554', 'H230-D', 'New', 'good condition', '0000-00-00 00:00:00', '');
INSERT INTO `itemissue` VALUES (21, 'return', 'UAD 309H', '1', '2008-03-29 00:00:00', 'W344', 'KKK1-D', 'New', 'damaged, knocked the Client''s gate and right indicator broke.', '0000-00-00 00:00:00', '');
INSERT INTO `itemissue` VALUES (23, 'return', 'UAH 334K', '1', '2008-06-04 00:00:00', 'W344', 'STB1', 'New - Damaged', 'It requires some repairs before it is fit for duty again.', '0000-00-00 00:00:00', '');
INSERT INTO `itemissue` VALUES (25, 'return', 'AR-123323', '1', '2008-05-20 00:00:00', 'T012', 'KKK1-D', 'New', 'It is scrtached.', '0000-00-00 00:00:00', '');

-- --------------------------------------------------------

-- 
-- Table structure for table `itempurchases`
-- 

CREATE TABLE `itempurchases` (
  `id` bigint(20) NOT NULL auto_increment,
  `itemtype` varchar(100) NOT NULL default '',
  `itemname` varchar(100) default NULL,
  `description` text,
  `cost` bigint(20) default NULL,
  `department` varchar(150) default NULL,
  `supplier` varchar(200) default NULL,
  `status` varchar(100) default NULL,
  `approvedby` varchar(250) NOT NULL default '0',
  `date_of_entry` datetime NOT NULL default '0000-00-00 00:00:00',
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

-- 
-- Dumping data for table `itempurchases`
-- 

INSERT INTO `itempurchases` VALUES (2, 'Baton', 'M34893-T', 'It is brown in color with white tip.', 35000, '3', '1', 'New', 'GM', '2008-05-03 10:20:06');

-- --------------------------------------------------------

-- 
-- Table structure for table `jobtitles`
-- 

CREATE TABLE `jobtitles` (
  `id` bigint(20) NOT NULL auto_increment,
  `jobtitle` varchar(250) NOT NULL default '',
  `date_of_entry` datetime NOT NULL default '0000-00-00 00:00:00',
  `lastupdatedby` bigint(20) NOT NULL default '0',
  `lastupdatedate` datetime NOT NULL default '0000-00-00 00:00:00',
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

-- 
-- Dumping data for table `jobtitles`
-- 

INSERT INTO `jobtitles` VALUES (1, 'Driver', '2008-04-09 00:00:00', 1, '2008-04-09 12:18:23');
INSERT INTO `jobtitles` VALUES (2, 'Car Commander', '2008-04-09 12:48:05', 1, '2008-04-09 12:57:22');
INSERT INTO `jobtitles` VALUES (3, 'Inspector', '2008-04-09 16:20:20', 1, '2008-04-09 16:23:35');
INSERT INTO `jobtitles` VALUES (4, 'Guard', '2008-04-14 14:45:26', 0, '0000-00-00 00:00:00');
INSERT INTO `jobtitles` VALUES (5, 'QRF', '2008-07-16 15:01:13', 0, '0000-00-00 00:00:00');

-- --------------------------------------------------------

-- 
-- Table structure for table `leaveapplications`
-- 

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
  `gmapproved` enum('Y','N') default NULL,
  `dateoffinanceapproval` datetime default NULL,
  `dateofhrapproval` datetime default NULL,
  `dateofoperationsapproval` datetime NOT NULL default '0000-00-00 00:00:00',
  `dateofgmapproval` datetime NOT NULL default '0000-00-00 00:00:00',
  `financeapprovalmsg` text NOT NULL,
  `hrapprovalmsg` text NOT NULL,
  `operationsapprovalmsg` text NOT NULL,
  `gmapprovalmsg` text NOT NULL,
  `whofinanceapproved` varchar(100) NOT NULL default '',
  `whohrapproved` varchar(100) NOT NULL default '',
  `whooperationapproved` varchar(100) NOT NULL default '',
  `whogmapproved` varchar(100) NOT NULL default '',
  `advancetaken` bigint(20) default NULL,
  `travelallowances` bigint(20) default NULL,
  `loantaken` bigint(20) default NULL,
  `uniformreturned` enum('N','Y') default NULL,
  `dateuniformreturned` date default NULL,
  `status` varchar(50) NOT NULL default '',
  `isactive` enum('N','Y') default 'Y',
  `sold` enum('Y','N') NOT NULL default 'N',
  `datecreated` date default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=47 DEFAULT CHARSET=latin1 AUTO_INCREMENT=47 ;

-- 
-- Dumping data for table `leaveapplications`
-- 

INSERT INTO `leaveapplications` VALUES (23, 'F554', '2007-01-02 00:00:00', '2007-05-12 00:00:00', 'Paternity Leave', 'To give birth', 'N', 'N', 'Y', 'N', '2009-01-10 00:00:00', '2008-04-02 15:53:28', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', 'free to take leave', '', '', '', '1', '', '', 0, 0, 0, '', '2007-12-10', 'Pending', 'Y', 'N', '0000-00-00');
INSERT INTO `leaveapplications` VALUES (34, 'H013', '2008-03-02 00:00:00', '2008-05-30 00:00:00', 'Unpaid', 'To give birth', 'Y', 'Y', 'Y', 'N', '2008-04-10 00:00:00', '2008-04-10 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', '', '', '', '', '', '', 5000, 2000, 20000, 'Y', '2008-04-10', 'Pending', 'N', 'N', '2007-10-16');
INSERT INTO `leaveapplications` VALUES (35, 'W344', '2008-03-21 00:00:00', '2008-12-02 00:00:00', 'Pass Leave', 'My wife is going to give birth', 'Y', 'Y', 'Y', 'N', '2008-03-19 11:59:57', '2008-03-19 12:05:25', '2008-03-19 11:59:00', '0000-00-00 00:00:00', 'Can have his leave', 'he can take leave', 'he is free to take his leave', '', '1', '1', '1', '', 100000, 40000, 0, 'Y', '2007-01-10', 'Pending', 'Y', 'Y', '0000-00-00');
INSERT INTO `leaveapplications` VALUES (36, 'P0081', '2007-11-14 00:00:00', '2007-11-16 00:00:00', 'Maternity Leave', 'I wanted to go now', 'N', 'Y', 'Y', 'N', '0000-00-00 00:00:00', '2007-12-13 23:28:21', '2008-01-10 14:37:47', '0000-00-00 00:00:00', 'I want to say he has done well.', 'I let this guy go', 'I think he has worked hard. Let him go.', '', '', '', '1', '', 23900, 125000, 125000, 'Y', NULL, '', 'Y', 'N', '2007-12-13');
INSERT INTO `leaveapplications` VALUES (37, 'Y907', '2007-01-15 00:00:00', '2007-12-16 00:00:00', 'Pass Leave', 'There are no men going to be got here', 'N', 'N', 'N', 'N', NULL, NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', '', '', '', '', '', '', NULL, NULL, NULL, 'N', NULL, '', 'Y', 'N', '2007-12-13');
INSERT INTO `leaveapplications` VALUES (38, 'H013', '2008-01-16 00:00:00', '2008-03-15 00:00:00', 'Annual', 'The guard has to go for annual leave.', NULL, 'Y', 'Y', 'N', NULL, '2008-01-05 18:23:02', '2008-01-05 19:02:10', '0000-00-00 00:00:00', '', 'There are guys who wouldnt like him to go but I want him to go.', 'I wanted to give him but he is too proud. He is ok now.', '', '', '', '1', '', NULL, NULL, NULL, 'Y', NULL, '', 'Y', 'N', '2008-01-05');
INSERT INTO `leaveapplications` VALUES (39, 'Y907', '2008-02-15 00:00:00', '2008-03-05 00:00:00', 'Annual', 'Time for annual leave has reached', NULL, NULL, 'Y', 'N', NULL, '2008-02-06 09:46:27', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', 'He is free to have his leave', '', '', '', '1', '', '', NULL, NULL, NULL, 'Y', NULL, '', 'Y', 'N', '2008-01-18');
INSERT INTO `leaveapplications` VALUES (40, 'T012', '2008-03-19 00:00:00', '2008-04-23 00:00:00', 'Annual', 'Ready to go for annual leave.', NULL, NULL, NULL, 'N', NULL, NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', '', '', '', '', '', '', NULL, NULL, NULL, 'Y', NULL, '', 'N', 'N', '2008-01-27');
INSERT INTO `leaveapplications` VALUES (41, 'F554', '2008-08-07 00:00:00', '2010-03-04 00:00:00', 'Annual', 'Study Leave', 'Y', 'Y', 'Y', 'N', '2008-03-12 11:04:25', '2008-03-12 11:06:11', '2008-03-12 11:06:35', '0000-00-00 00:00:00', 'He is a good guard', 'He is resourcefull', 'He will be back in 18 months', '', '20', '20', '20', '', 70000, 30000, 150000, 'Y', NULL, '', 'N', 'N', '2008-02-04');
INSERT INTO `leaveapplications` VALUES (42, 'T012', '2008-04-18 00:00:00', '2008-08-16 00:00:00', 'Annual', 'Normal annual leave for the village.', NULL, NULL, 'Y', 'Y', NULL, '2008-03-19 11:55:09', '0000-00-00 00:00:00', '2008-04-28 09:53:58', '', 'He can take his leave', '', '', '', '1', '', '1', NULL, NULL, NULL, 'Y', NULL, '', 'Y', 'Y', '2008-03-19');
INSERT INTO `leaveapplications` VALUES (45, 'K903', '2008-02-16 00:00:00', '2008-11-30 00:00:00', 'Annual', 'His time is now to go for rest.', NULL, NULL, NULL, 'Y', NULL, NULL, '0000-00-00 00:00:00', '2008-04-26 19:26:39', '', '', '', 'he can go now', '', '', '', '1', NULL, NULL, NULL, NULL, NULL, '', 'Y', 'N', '2008-04-26');
INSERT INTO `leaveapplications` VALUES (46, 'T012', '2008-02-01 00:00:00', '2008-02-05 00:00:00', 'Pass Leave', 'He can relax before being promoted.', NULL, NULL, NULL, NULL, NULL, NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', '', '', '', '', '', '', NULL, NULL, NULL, NULL, NULL, '', 'Y', 'N', '2008-04-26');

-- --------------------------------------------------------

-- 
-- Table structure for table `leavetypes`
-- 

CREATE TABLE `leavetypes` (
  `id` bigint(20) NOT NULL auto_increment,
  `leavetype` varchar(200) NOT NULL default '',
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

-- 
-- Dumping data for table `leavetypes`
-- 

INSERT INTO `leavetypes` VALUES (1, 'Annual');
INSERT INTO `leavetypes` VALUES (2, 'Unpaid');
INSERT INTO `leavetypes` VALUES (3, 'Pass Leave');
INSERT INTO `leavetypes` VALUES (4, 'Maternity Leave');
INSERT INTO `leavetypes` VALUES (5, 'Paternity Leave');
INSERT INTO `leavetypes` VALUES (7, 'Other');

-- --------------------------------------------------------

-- 
-- Table structure for table `loanapplications`
-- 

CREATE TABLE `loanapplications` (
  `id` bigint(20) NOT NULL auto_increment,
  `guardid` varchar(50) default '0',
  `loanamount` bigint(20) default NULL,
  `appnletter` varchar(255) NOT NULL default '',
  `gmapproved` enum('N','Y') default NULL,
  `gmapprovalmsg` text,
  `dateofgmapproval` datetime default NULL,
  `repayinstallment` bigint(20) default NULL,
  `whogmapproved` varchar(100) default NULL,
  `loanstatus` varchar(50) NOT NULL default '',
  `isactive` enum('N','Y') default 'Y',
  `datecreated` date default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=latin1 AUTO_INCREMENT=22 ;

-- 
-- Dumping data for table `loanapplications`
-- 

INSERT INTO `loanapplications` VALUES (1, 'T023', 30000, '', 'Y', 'He can take the loan provided he can repay the installments as agreed.', '2008-04-07 14:00:49', 2000, '1', '', 'Y', '2008-04-07');
INSERT INTO `loanapplications` VALUES (14, 'F554', 450000, '', 'Y', 'take loan', '2008-04-07 14:58:01', 12000, '1', '', 'Y', '2008-04-07');
INSERT INTO `loanapplications` VALUES (16, 'W344', 50000, '', NULL, NULL, NULL, NULL, NULL, '', 'N', '2008-04-09');
INSERT INTO `loanapplications` VALUES (18, 'F554', 34000, 'uploads/1209213002F554SmartGuardFeaturesList_28Mar08.pdf', NULL, NULL, NULL, NULL, NULL, '', 'Y', '2008-04-26');
INSERT INTO `loanapplications` VALUES (19, 'K903', 300, '', 'Y', 'He can get the money. Check his previous debt for clarification.', '2008-08-20 11:44:35', 100, '1', '', 'Y', '2008-08-15');
INSERT INTO `loanapplications` VALUES (20, '', 0, '', NULL, NULL, NULL, NULL, NULL, '', 'Y', '2008-08-20');
INSERT INTO `loanapplications` VALUES (21, '', 0, '', NULL, NULL, NULL, NULL, NULL, '', 'Y', '2008-08-20');

-- --------------------------------------------------------

-- 
-- Table structure for table `loanapprovals`
-- 

CREATE TABLE `loanapprovals` (
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
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- 
-- Dumping data for table `loanapprovals`
-- 


-- --------------------------------------------------------

-- 
-- Table structure for table `location`
-- 

CREATE TABLE `location` (
  `id` bigint(20) NOT NULL auto_increment,
  `name` varchar(255) NOT NULL default '',
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=latin1 AUTO_INCREMENT=31 ;

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
-- Table structure for table `logbook`
-- 

CREATE TABLE `logbook` (
  `id` bigint(20) NOT NULL auto_increment,
  `logdate` date NOT NULL default '0000-00-00',
  `mobile` varchar(50) NOT NULL default '',
  `fuelmorning` varchar(250) NOT NULL default '0',
  `fuelevening` varchar(250) default NULL,
  `shift` varchar(50) NOT NULL default '',
  `driver` varchar(100) NOT NULL default '',
  `driverid` varchar(50) NOT NULL default '',
  `qrfguards` text NOT NULL,
  `carcommander` varchar(100) NOT NULL default '',
  `commanderid` varchar(100) NOT NULL default '',
  `timeout` varchar(5) NOT NULL default '',
  `timein` varchar(5) default NULL,
  `placefrom` varchar(100) NOT NULL default '',
  `placeto` varchar(100) default NULL,
  `odometerstart` int(11) default NULL,
  `odometerend` varchar(11) default NULL,
  `kmtravelled` varchar(11) default NULL,
  `reason` varchar(255) default NULL,
  `conditionsandcomments` text,
  `handoverdriver` varchar(100) default NULL,
  `handovercarcommander` varchar(100) default NULL,
  `receivingdriver` varchar(100) default NULL,
  `receivingcarcommander` varchar(100) default NULL,
  `receivedby` varchar(100) NOT NULL default '',
  `timereceived` time default '00:00:00',
  `isactive` enum('Y','N') NOT NULL default 'Y',
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=54 DEFAULT CHARSET=latin1 AUTO_INCREMENT=54 ;

-- 
-- Dumping data for table `logbook`
-- 

INSERT INTO `logbook` VALUES (2, '2008-02-07', 'UAH 334K', '56', '0', 'Day - shift', 'W344', '', '', 'F554', '', '1212', '1220', '314A', 'Katonga', 1234, '1236', '0', 'Standby Location', '', 'W344', 'F554', '', '', 'System Administrator', '11:53:40', 'Y');
INSERT INTO `logbook` VALUES (3, '2008-02-07', 'UAH 334K', '56', '0', 'Day - shift', 'W344', '', '', 'F554', '', '1233', '1244', 'Katonga', 'CRNBK', 1236, '1238', '0', 'Alarm Panic', '', 'W344', 'F554', '', '', 'System Administrator', '12:28:28', 'Y');
INSERT INTO `logbook` VALUES (5, '2008-02-07', 'UAB 937Q', '100', '0', 'Alarm - Panic', 'P0081', '', '', 'F554', '', '1020', '1035', 'katonga', 'BOU1', 3120, '3121', '0', 'Alarm Call out', '', 'P0081', 'F554', '', '', 'System Administrator', '12:33:13', 'Y');
INSERT INTO `logbook` VALUES (7, '2008-02-07', 'UAB 937Q', '100', '0', 'Alarm - Panic', 'P0081', '', '', 'F554', '', '1216', '1230', 'K.B.', '314A', 2134, '2136', '0', 'Alarm Call Out', '', 'P0081', 'F554', '', '', 'System Administrator', '12:37:27', 'Y');
INSERT INTO `logbook` VALUES (8, '2008-02-07', 'UAB 937Q', '100', '0', 'Alarm - Panic', 'P0081', '', '', 'F554', '', '1235', '1240', '314A', 'KOLOLO', 2136, '2138', '0', 'Standby Location', '', 'P0081', 'F554', '', '', 'System Administrator', '12:37:27', 'Y');
INSERT INTO `logbook` VALUES (9, '2008-02-01', 'UAB 937Q', '100', '0', 'Alarm - Panic', 'P0081', '', '', 'F554', '', '1300', '1330', 'KOLOLO', 'NBL1', 2138, '2146', '0', 'Alarm Panic', '', 'P0081', 'F554', '', '', 'System Administrator', '12:37:27', 'N');
INSERT INTO `logbook` VALUES (10, '2008-02-07', 'UAH 334K', '56', '0', 'Day - shift', 'W344', '', '', 'F554', '', '1300', '1321', 'CRNBK', 'Katonga', 1238, '1241', '0', 'Standby Location', '  ', 'W344', 'F554', '', '', 'System Administrator', '13:56:59', 'Y');
INSERT INTO `logbook` VALUES (11, '2008-02-06', 'UAH 334K', '56', '0', 'Day - shift', 'W344', '', '', 'F554', '', '1136', '0', 'Katonga', 'GBA1', 1241, '0', '0', 'Alarm Call out', '   ', 'W344', 'F554', '', '', 'System Administrator', '13:58:45', 'Y');
INSERT INTO `logbook` VALUES (13, '2008-02-06', 'UAD 234Q', '30', '0', 'Alarm - Intruder', 'T012', '', '', 'F554', '', '1213', '1233', 'MSK1', 'CRN3', 2122, '2130', '0', 'Alarm Call Out', '  ', 'T012', 'F554', '', '', 'System Administrator', '13:59:26', 'Y');
INSERT INTO `logbook` VALUES (14, '2008-02-08', 'UAB 937Q', '100', '0', 'Alarm - Panic', 'P0081', '', '', 'F554', '', '1419', '1428', 'NBL1', 'Katonga', 2146, '2151', '0', 'Standby Location', '  ', 'P0081', 'F554', '', '', 'System Administrator', '14:28:28', 'Y');
INSERT INTO `logbook` VALUES (15, '2008-02-09', 'UAD 234Q', '98', '0', 'Day - shift', 'W344', '', '', 'F554', '', '1004', '1100', 'Katonga', 'CRNBK', 2330, '2340', '0', 'Alarm Call out', '  ', 'W344', 'F554', '', '', 'System Administrator', '11:37:58', 'Y');
INSERT INTO `logbook` VALUES (16, '2008-02-09', 'UAD 234Q', '98', '0', 'Day - shift', 'W344', '', '', 'F554', '', '1158', '1202', 'CRNBK', 'HK01', 2340, '2342', '0', 'Alarm Panic', '    ', 'W344', 'F554', '', '', 'System Administrator', '12:03:00', 'Y');
INSERT INTO `logbook` VALUES (19, '2008-02-12', 'UAD 309H', '67', '', 'Day - shift', 'P0081', '', '', 'F554', '', '1220', '1230', 'NBL1', 'Katonga', 2112, '2117', '0', 'Standby location', '  ', 'P0081', 'F554', '', '', 'System Administrator', '17:39:02', 'Y');
INSERT INTO `logbook` VALUES (21, '2008-02-12', 'UAD 309H', '67', '', 'Day - shift', 'P0081', '', '', 'F554', '', '1412', '1421', 'Katonga', 'BMK1', 2117, '2121', '0', 'Alarm Panic', '    ', 'P0081', 'F554', '', '', 'System Administrator', '17:47:35', 'Y');
INSERT INTO `logbook` VALUES (24, '2008-02-15', 'UAD 234Q', '67', '', 'Day - shift', 'T012', '', '', 'F554', '', '1300', '', 'NBL1', 'Katonga', 2117, '', '', 'Standby location', ' ', '', '', '', '', 'System Administrator', '12:39:34', 'Y');
INSERT INTO `logbook` VALUES (26, '2008-03-19', 'UAD 309H', '2', '34', 'Day - shift', 'W344', '', '', 'J201', '', '12:30', '12:52', 'H113', 'T334', 12899, '13000', '', 'Rapid Alarm response', ' Vehicle in good condition.', '', '', '', '', 'System Administrator', '11:36:09', 'N');
INSERT INTO `logbook` VALUES (27, '2008-04-09', 'UAB 937Q', '0', '', 'Alarm - Panic', 'W344', '', '', 'J201', '', '12:30', '13:12', 'KB001', '341H', 3200, '3213', '0', 'Alarm Panic', '  ', 'K903', 'J201', '', '', 'System Administrator', '16:39:35', 'Y');
INSERT INTO `logbook` VALUES (28, '2008-05-09', 'UAB 937Q', '40', '2', 'Day - shift', 'H117', '', '', 'T012', '', '1240', '1320', 'H312-D', 'KKK1-D', 23999, '', '', 'Alarm interception', 'Vehicle is doing well. It needs repair of exterior parts only.', '', '', '', '', 'System Administrator', '08:38:27', 'Y');
INSERT INTO `logbook` VALUES (40, '2008-07-15', 'UAB 875H', 'sa3_4', 'reserve', 'Alarm - Intruder', 'W344', '', '', 'T012', '', '1200', '1950', 'H001-N', 'H004-N', 14540, '14550', '', 'Alarm Response', 'In good condition.', 'W344', 'T012', 'W344', '123123', 'System Administrator', '17:23:50', 'Y');
INSERT INTO `logbook` VALUES (47, '2008-07-15', 'UAB 875H', 'sa3_4', 'reserve', 'Alarm - Intruder', 'W344', '', '', 'T012', '', '1920', '2008', 'H004-N', 'H312-D', 14550, '14560', '', 'Fetch Guards', 'In good condition.', 'W344', 'T012', 'W344', '123123', 'System Administrator', '17:23:50', 'Y');
INSERT INTO `logbook` VALUES (48, '2008-07-16', 'UAD 234Q', 'sb3_4', 'reserve', 'Alarm - Intruder/Panic', 'H117', '', 'T023<>F554<>S399', 'T012', '', '1230', '1530', 'T115-D', 'K001-N', 130030, '130032', '', 'Attack force deployment', 'Vehicle OK', 'H117', 'T012', 'W344', '123123', 'System Administrator', '15:10:00', 'Y');
INSERT INTO `logbook` VALUES (51, '2008-07-16', 'UAD 234Q', 'sb3_4', 'reserve', 'Alarm - Intruder/Panic', 'H117', '', 'T023<>F554<>S399', 'T012', '', '1535', '1550', 'K001-N', 'H312-D', 130032, '130036', '', 'Return to base', 'Vehicle OK', 'H117', 'T012', 'W344', '123123', 'System Administrator', '15:10:00', 'Y');
INSERT INTO `logbook` VALUES (52, '2008-07-16', 'UAD 234Q', 'sb3_4', 'reserve', 'Alarm - Intruder/Panic', 'H117', '', 'T023<>F554<>S399', 'T012', '', '1600', '1620', 'H312-D', 'T115-D', 130036, '130040', '', 'Response to Alarm', 'Vehicle OK', 'H117', 'T012', 'W344', '123123', 'System Administrator', '15:59:38', 'Y');
INSERT INTO `logbook` VALUES (53, '2008-08-14', 'UAB 875H', 'sa3_4', 'sa1_2', 'Alarm - Intruder', 'H117', '', 'T023<>J201', 'T023', '', '1320', '1350', 'H312-D', 'KKK1-D', 89099, '90000', '', 'alarm response', 'THe car is in good condition.', 'H117', '123123', 'H117', 'T012', 'John Butema', '09:11:24', 'Y');

-- --------------------------------------------------------

-- 
-- Table structure for table `messages`
-- 

CREATE TABLE `messages` (
  `id` bigint(20) NOT NULL auto_increment,
  `reason` varchar(200) NOT NULL default '',
  `details` text NOT NULL,
  `sentby` varchar(250) NOT NULL default '',
  `sentto` varchar(250) NOT NULL default '',
  `date` datetime NOT NULL default '0000-00-00 00:00:00',
  `isactive` enum('Y','N') NOT NULL default 'Y',
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=232 DEFAULT CHARSET=latin1 AUTO_INCREMENT=232 ;

-- 
-- Dumping data for table `messages`
-- 

INSERT INTO `messages` VALUES (8, 'Pick up delays', 'This is to bring to your notice that the pick up delays to come thus making us work longer hours which are unaccounted for.', '1', '1,81', '2008-01-11 17:41:23', 'N');
INSERT INTO `messages` VALUES (10, 'how to get report', 'how do I generate financial status report', '1', '80', '2008-01-12 18:17:09', 'Y');
INSERT INTO `messages` VALUES (11, 'delayed payements', 'Guards payments have not been deposited to their respective accounts', '12', '80', '2008-01-15 12:23:54', 'Y');
INSERT INTO `messages` VALUES (15, 'testing', 'test reminder', '1', '83', '2008-02-08 13:02:17', 'Y');
INSERT INTO `messages` VALUES (20, 'Modify client details', 'I can not modify clients'' details', '6', '1,85', '2008-03-19 10:55:07', 'N');
INSERT INTO `messages` VALUES (52, 'APPROVE LOAN', '<a href="../finance/approvals.php?id=NjE=&t=gm">Loan Application</a>', '1', '1,81,80', '2008-04-09 14:43:00', 'Y');
INSERT INTO `messages` VALUES (109, 'Contract for Wilson Akena Akena expires in 14 Days.', '<a href="../hr/index.php?id=MzM="> Update contract</a>', '1', '1,84,85', '2008-04-11 14:53:30', 'Y');
INSERT INTO `messages` VALUES (110, 'Contract for Julian Kugonza Ouma has expired!', '<a href="../hr/index.php?id=NDM="> Update contract</a>', '1', '1,84,85', '2008-04-11 14:53:30', 'N');
INSERT INTO `messages` VALUES (111, 'Contract for Wilson Akena Akena expires in 11 Days.', '<a href="../hr/index.php?id=MzM="> Update contract</a>', '1', '1,84,85', '2008-04-14 08:26:19', 'Y');
INSERT INTO `messages` VALUES (112, 'Contract for Wilson Akena Akena expires in 4 Days.', '<a href="../hr/index.php?id=MzM="> Update contract</a>', '1', '1,84,85', '2008-04-21 07:27:34', 'Y');
INSERT INTO `messages` VALUES (113, 'Contract for Julian Kugonza Ouma expires in 10 Days.', '<a href="../hr/index.php?id=NDM="> Update contract</a>', '1', '1,84,85', '2008-04-21 07:27:34', 'Y');
INSERT INTO `messages` VALUES (114, 'APPROVE LOAN', '<a href="../finance/approvals.php?id=NzE=&t=gm">Loan Application</a>', '1', '1,80,81', '2008-04-22 07:13:28', 'Y');
INSERT INTO `messages` VALUES (115, 'Contract for Julian Kugonza Ouma expires in 6 Days.', '<a href="../hr/index.php?id=NDM="> Update contract</a>', '1', '1,84,85', '2008-04-25 07:39:09', 'Y');
INSERT INTO `messages` VALUES (116, 'Contract for Wilson Akena Akena has expired!', '<a href="../hr/index.php?id=MzM="> Update contract</a>', '1', '1,84,85', '2008-04-26 12:56:32', 'Y');
INSERT INTO `messages` VALUES (117, 'Contract for Julian Kugonza Ouma expires in 5 Days.', '<a href="../hr/index.php?id=NDM="> Update contract</a>', '1', '1,84,85', '2008-04-26 12:56:32', 'Y');
INSERT INTO `messages` VALUES (118, 'APPROVE LOAN', '<a href="../finance/approvals.php?id=ODE=&t=gm">Loan Application</a>', '1', '1,80,81', '2008-04-26 15:09:32', 'Y');
INSERT INTO `messages` VALUES (119, 'APPROVE LOAN', '<a href="../finance/approvals.php?id=OTE=&t=gm">Loan Application</a>', '1', '1,80,81', '2008-04-26 15:29:52', 'N');
INSERT INTO `messages` VALUES (120, 'APPROVE LOAN', '<a href="../finance/approvals.php?id=MDI=&t=gm">Loan Application</a>', '1', '1,80,81', '2008-04-26 15:30:03', 'N');
INSERT INTO `messages` VALUES (130, 'Contract for Julian Kugonza Ouma expires in 3 Days.', '<a href="../hr/index.php?id=NDM="> Update contract</a>', '', '1,84,85', '2008-04-28 10:44:42', 'Y');
INSERT INTO `messages` VALUES (133, 'STILL ON LEAVE', 'Ryan Babel is still on leave. His authorised leave ended on 30-Mar-2008.', '', '1,80,81,84,85', '2008-04-28 10:50:31', 'Y');
INSERT INTO `messages` VALUES (139, 'GUARD PROMOTION', 'Ryan Babel  has been promoted to INSPECTOR. Please change the payment rate if affected', '', '1,80,84', '2008-04-28 11:37:50', 'Y');
INSERT INTO `messages` VALUES (140, 'GUARD PROMOTION', 'Joseph Okot Opio has been promoted to CAR COMMANDER. Please change the payment rate if affected', '', '1,80,84', '2008-04-28 11:37:50', 'Y');
INSERT INTO `messages` VALUES (157, 'GUARDS DUE FOR LEAVE', '<a href="../hr/manageleave.php?a=sactive">Guards List</a> starting 01-Apr-2008.', '', '1', '2008-04-28 14:23:40', 'Y');
INSERT INTO `messages` VALUES (158, 'Contract for Julian Kugonza Ouma expires in 2 Days.', '<a href="../hr/index.php?id=NDM="> Update contract</a>', '', '1,84,85', '2008-04-29 07:11:49', 'Y');
INSERT INTO `messages` VALUES (160, 'LONG SERVICE AWARD', '<a href="../hr/manageguards.php?a=lsearch&y=ODAwMg==">Guards List</a> for 2008.', '', '1,84,85', '2008-04-29 07:53:21', 'Y');
INSERT INTO `messages` VALUES (161, 'Contract for Julian Kugonza Ouma expires in 1 Days.', '<a href="../hr/index.php?id=NDM="> Update contract</a>', '', '1,84,85', '2008-04-30 10:10:50', 'N');
INSERT INTO `messages` VALUES (162, 'BACKUP DATABASE', 'Please backup the DB for week ending 02-May-2008.', '', '1', '2008-04-30 10:10:50', 'Y');
INSERT INTO `messages` VALUES (163, 'STILL ON LEAVE', 'Wilson Akena is still on leave. His authorised leave ended on 02-May-2008.', '', '1,80,81,84,85', '2008-05-02 07:50:03', 'Y');
INSERT INTO `messages` VALUES (166, 'NEW CLIENT', 'Register new assignment(s) for <a href="../core/viewclient.php?id=ODI=">Info Technologies Ltd.</a>', '', '1,79,82', '2008-05-06 09:25:04', 'Y');
INSERT INTO `messages` VALUES (167, 'NEW CLIENT', 'Register new assignment(s) for <a href="../core/viewclient.php?id=OTI=">Garry Johns</a>', '', '1,79,82', '2008-05-06 09:28:20', 'N');
INSERT INTO `messages` VALUES (168, 'NEW CLIENT', 'Register new assignment(s) for <a href="../core/viewclient.php?id=MDM=">Hint Ltd</a>', '', '1,79,82', '2008-05-06 09:54:01', 'N');
INSERT INTO `messages` VALUES (169, 'BACKUP DATABASE', 'Please backup the DB for week ending 09-May-2008.', '', '1', '2008-05-07 08:40:51', 'Y');
INSERT INTO `messages` VALUES (170, 'BACKUP DATABASE', 'Please backup the DB for week ending 16-May-2008.', '', '1', '2008-05-14 07:28:54', 'Y');
INSERT INTO `messages` VALUES (171, 'NEW CLIENT', 'Register new assignment(s) for <a href="../core/viewclient.php?id=MTM=">Tallon Holdings Limited</a>', '', '1,79,82', '2008-05-20 10:58:20', 'N');
INSERT INTO `messages` VALUES (172, 'BACKUP DATABASE', 'Please backup the DB for week ending 23-May-2008.', '', '1', '2008-05-21 07:35:27', 'Y');
INSERT INTO `messages` VALUES (173, 'Add Uniform to guard', '<a href="../hr/index.php?id=ODM=&a=edit">Provide Uniform</a>', '1', '1,79,82', '2008-05-21 07:40:16', 'N');
INSERT INTO `messages` VALUES (174, 'Add Uniform to guard', '<a href="../hr/index.php?id=OTM=&a=edit">Provide Uniform</a>', '1', '1,79,82', '2008-05-21 08:01:57', 'N');
INSERT INTO `messages` VALUES (175, 'Add Uniform to guard', '<a href="../hr/index.php?id=OTM=&a=edit">Provide Uniform</a>', '1', '1,79,82', '2008-05-21 08:02:17', 'N');
INSERT INTO `messages` VALUES (176, 'Add Uniform to guard', '<a href="../hr/index.php?id=OTM=&a=edit">Provide Uniform</a>', '1', '1,79,82', '2008-05-21 08:02:32', 'N');
INSERT INTO `messages` VALUES (177, 'BACKUP DATABASE', 'Please backup the DB for week ending 30-May-2008.', '', '1', '2008-05-28 07:58:23', 'Y');
INSERT INTO `messages` VALUES (178, 'BACKUP DATABASE', 'Please backup the DB for week ending 06-Jun-2008.', '', '1', '2008-06-04 07:33:11', 'Y');
INSERT INTO `messages` VALUES (179, 'NEW ASSIGNMENT', 'Generate contract For <a href="../core/manageassignments.php?a=search&v=Z890&type=Call Sign">Zziwa International Inc.</a>', '', '1,79,82', '2008-06-10 10:24:52', 'Y');
INSERT INTO `messages` VALUES (180, 'NEW ASSIGNMENT', 'Generate contract For <a href="../core/manageassignments.php?a=search&v=U890&type=Call Sign">Uganda Telecom Ltd</a>', '', '1,79,82', '2008-07-01 10:51:28', 'Y');
INSERT INTO `messages` VALUES (181, 'BACKUP DATABASE', 'Please backup the DB for week ending 04-Jul-2008.', '', '1', '2008-07-02 07:22:38', 'Y');
INSERT INTO `messages` VALUES (182, 'BACKUP DATABASE', 'Please backup the DB for week ending 18-Jul-2008.', '', '1', '2008-07-16 08:40:42', 'Y');
INSERT INTO `messages` VALUES (183, 'BACKUP DATABASE', 'Please backup the DB for week ending 25-Jul-2008.', '', '1', '2008-07-23 08:25:08', 'Y');
INSERT INTO `messages` VALUES (184, 'BACKUP DATABASE', 'Please backup the DB for week ending 01-Aug-2008.', '', '1', '2008-07-30 10:52:19', 'N');
INSERT INTO `messages` VALUES (185, 'BACKUP DATABASE', 'Please backup the DB for week ending 08-Aug-2008.', '', '1', '2008-08-06 10:00:44', 'N');
INSERT INTO `messages` VALUES (186, 'APPROVE STAFF DEBT', '<a href="../finance/approvals.php?id=OTE=&t=gm">Staff Debt Application</a>', '1', '1,80,81', '2008-08-15 07:49:50', 'N');
INSERT INTO `messages` VALUES (187, 'APPROVE STAFF DEBT', '<a href="../finance/approvals.php?id=MDI=&t=gm">Staff Debt Application</a>', '1', '1,80,81', '2008-08-15 07:50:47', 'N');
INSERT INTO `messages` VALUES (188, 'BACKUP DATABASE', 'Please backup the DB for week ending 22-Aug-2008.', '', '1', '2008-08-20 11:05:06', 'N');
INSERT INTO `messages` VALUES (189, 'APPROVE STAFF DEBT', '<a href="../finance/approvals.php?id=MDI=&t=gm">Staff Debt Application</a>', '1', '1,80,81', '2008-08-20 11:43:58', 'N');
INSERT INTO `messages` VALUES (190, 'APPROVE STAFF DEBT', '<a href="../finance/approvals.php?id=MTI=&t=gm">Staff Debt Application</a>', '1', '1,80,81', '2008-08-20 11:44:35', 'N');
INSERT INTO `messages` VALUES (191, 'BACKUP DATABASE', 'Please backup the DB for week ending 05-Sep-2008.', '', '1', '2008-08-27 08:43:18', 'N');
INSERT INTO `messages` VALUES (192, 'this is a', 'this is the most current message this month, this is a message over try and check it out', '1', '1', '2008-08-28 11:55:45', 'Y');
INSERT INTO `messages` VALUES (193, 'BACKUP DATABASE', 'Please backup the DB for week ending 19-Sep-2008.', '', '1', '2008-09-10 09:46:40', 'Y');
INSERT INTO `messages` VALUES (194, 'STILL ON LEAVE', 'Ryan Babel is still on leave. His authorised leave ended on 30-Nov-2008.', '', '1,80,81,84,85', '2010-09-27 20:10:57', 'Y');
INSERT INTO `messages` VALUES (195, 'Contract for Fat Opio Darlem has expired!', '<a href="../hr/index.php?id=NzI="> Update contract</a>', '', '1,84,85', '2010-09-27 20:10:57', 'Y');
INSERT INTO `messages` VALUES (196, 'Contract for Tito Simon Okello has expired!', '<a href="../hr/index.php?id=MDM="> Update contract</a>', '', '1,84,85', '2010-09-27 20:10:57', 'Y');
INSERT INTO `messages` VALUES (197, 'Contract for Tim Benson Okello has expired!', '<a href="../hr/index.php?id=MjM="> Update contract</a>', '', '1,84,85', '2010-09-27 20:10:57', 'Y');
INSERT INTO `messages` VALUES (198, 'Contract for Almond Tester  has expired!', '<a href="../hr/index.php?id=NzM="> Update contract</a>', '', '1,84,85', '2010-09-27 20:10:57', 'Y');
INSERT INTO `messages` VALUES (199, 'LONG SERVICE AWARD', '<a href="../hr/manageguards.php?a=lsearch&y=MDEwMg==">Guards List</a> for 2010.', '', '1,84,85', '2010-09-27 20:10:57', 'Y');
INSERT INTO `messages` VALUES (200, 'BACKUP DATABASE', 'Please backup the DB for week ending 08-Oct-2010.', '', '1', '2010-10-06 14:03:58', 'Y');
INSERT INTO `messages` VALUES (201, 'LONG SERVICE AWARD', '<a href="../hr/manageguards.php?a=lsearch&y=MTEwMg==">Guards List</a> for 2011.', '', '1,84,85', '2011-01-20 09:44:58', 'Y');
INSERT INTO `messages` VALUES (202, 'BACKUP DATABASE', 'Please backup the DB for week ending 22-Apr-2011.', '', '1', '2011-04-20 15:16:51', 'Y');
INSERT INTO `messages` VALUES (203, 'Contract for Ryan Babel  has expired!', '<a href="../hr/index.php?id=NTM="> Update contract</a>', '', '1,84,85', '2011-07-22 18:26:32', 'Y');
INSERT INTO `messages` VALUES (204, 'BACKUP DATABASE', 'Please backup the DB for week ending 23-Mar-2012.', '', '1', '2012-03-21 11:23:56', 'Y');
INSERT INTO `messages` VALUES (205, 'LONG SERVICE AWARD', '<a href="../hr/manageguards.php?a=lsearch&y=MjEwMg==">Guards List</a> for 2012.', '', '1,84,85', '2012-03-21 11:23:56', 'Y');
INSERT INTO `messages` VALUES (206, 'NEW ASSIGNMENT', 'Generate contract For <a href="../core/manageassignments.php?a=search&v=Test&type=Call Sign">Stanbic Bank</a>', '', '1,79,82', '2012-06-05 10:10:00', 'Y');
INSERT INTO `messages` VALUES (207, 'BACKUP DATABASE', 'Please backup the DB for week ending 08-Jun-2012.', '', '1', '2012-06-06 01:55:33', 'Y');
INSERT INTO `messages` VALUES (208, 'New Finance Report', 'Testing', '1', '1', '2012-06-06 01:56:20', 'Y');
INSERT INTO `messages` VALUES (209, 'BACKUP DATABASE', 'Please backup the DB for week ending 22-Jun-2012.', '', '1', '2012-06-20 04:22:31', 'Y');
INSERT INTO `messages` VALUES (210, 'BACKUP DATABASE', 'Please backup the DB for week ending 29-Jun-2012.', '', '1', '2012-06-27 08:27:58', 'Y');
INSERT INTO `messages` VALUES (211, 'BACKUP DATABASE', 'Please backup the DB for week ending 13-Jul-2012.', '', '1', '2012-07-11 11:09:11', 'Y');
INSERT INTO `messages` VALUES (212, 'BACKUP DATABASE', 'Please backup the DB for week ending 20-Jul-2012.', '', '1', '2012-07-18 09:51:28', 'Y');
INSERT INTO `messages` VALUES (213, 'BACKUP DATABASE', 'Please backup the DB for week ending 27-Jul-2012.', '', '1', '2012-07-25 09:20:38', 'Y');
INSERT INTO `messages` VALUES (214, 'BACKUP DATABASE', 'Please backup the DB for week ending 03-Aug-2012.', '', '1', '2012-08-01 01:57:03', 'Y');
INSERT INTO `messages` VALUES (215, 'BACKUP DATABASE', 'Please backup the DB for week ending 10-Aug-2012.', '', '1', '2012-08-08 03:38:33', 'N');
INSERT INTO `messages` VALUES (216, 'BACKUP DATABASE', 'Please backup the DB for week ending 17-Aug-2012.', '', '1', '2012-08-15 06:28:15', 'Y');
INSERT INTO `messages` VALUES (217, 'BACKUP DATABASE', 'Please backup the DB for week ending 24-Aug-2012.', '', '1', '2012-08-22 00:01:21', 'Y');
INSERT INTO `messages` VALUES (218, 'BACKUP DATABASE', 'Please backup the DB for week ending 31-Aug-2012.', '', '1', '2012-08-29 02:10:50', 'Y');
INSERT INTO `messages` VALUES (219, 'BACKUP DATABASE', 'Please backup the DB for week ending 07-Sep-2012.', '', '1', '2012-09-05 02:07:54', 'Y');
INSERT INTO `messages` VALUES (220, 'NEW ASSIGNMENT', 'Generate contract For <a href="../core/manageassignments.php?a=search&v=A12&type=Call Sign">Uganda Telecom Ltd</a>', '', '1,79,82', '2012-09-10 05:13:05', 'Y');
INSERT INTO `messages` VALUES (221, 'BACKUP DATABASE', 'Please backup the DB for week ending 14-Sep-2012.', '', '1', '2012-09-12 01:25:37', 'Y');
INSERT INTO `messages` VALUES (222, 'BACKUP DATABASE', 'Please backup the DB for week ending 21-Sep-2012.', '', '1', '2012-09-19 01:56:26', 'Y');
INSERT INTO `messages` VALUES (223, 'BACKUP DATABASE', 'Please backup the DB for week ending 28-Sep-2012.', '', '1', '2012-09-26 00:43:06', 'Y');
INSERT INTO `messages` VALUES (224, 'BACKUP DATABASE', 'Please backup the DB for week ending 05-Oct-2012.', '', '1', '2012-10-03 13:29:47', 'Y');
INSERT INTO `messages` VALUES (225, 'BACKUP DATABASE', 'Please backup the DB for week ending 12-Oct-2012.', '', '1', '2012-10-10 02:34:47', 'Y');
INSERT INTO `messages` VALUES (226, 'BACKUP DATABASE', 'Please backup the DB for week ending 19-Oct-2012.', '', '1', '2012-10-17 07:32:24', 'Y');
INSERT INTO `messages` VALUES (227, 'BACKUP DATABASE', 'Please backup the DB for week ending 02-Nov-2012.', '', '1', '2012-10-31 08:25:15', 'Y');
INSERT INTO `messages` VALUES (228, 'EWXSiDENFZyVoJM', 'Pardon me for being cynical, but what you''re waitnng to do may be difficult.  However, I do wish you all the best.What kind of waste management are you thinking of?  Trash service, or industrial-toxic waste management?   I think many third world countries   developing nations (or whatever the current term of art is) have more problems to solve than worring about environmental/waste issues.  Therefore, they may ignore trying to solve waste issues, in favor of what they perceive as higher priority activities, until they are forced to face it head on.  You may be in an area that is a bit more concerned with sustainable environments and that will help you succeed.Your first source of info should be the country where you''re setting up shop.If you don''t get much help from them, your next best bet may be with the united nations environmental programme   they may offer sound advice, and maybe even some seed money.  Or, try enviros groups   sierra club, greenpeace, etc.', '', '1', '2012-11-04 05:26:44', 'Y');
INSERT INTO `messages` VALUES (229, 'BACKUP DATABASE', 'Please backup the DB for week ending 09-Nov-2012.', '', '1', '2012-11-07 06:16:32', 'Y');
INSERT INTO `messages` VALUES (230, 'BACKUP DATABASE', 'Please backup the DB for week ending 16-Nov-2012.', '', '1', '2012-11-14 10:35:28', 'Y');
INSERT INTO `messages` VALUES (231, 'BACKUP DATABASE', 'Please backup the DB for week ending 23-Nov-2012.', '', '1', '2012-11-21 00:53:59', 'Y');

-- --------------------------------------------------------

-- 
-- Table structure for table `mobile`
-- 

CREATE TABLE `mobile` (
  `id` bigint(20) NOT NULL auto_increment,
  `number` bigint(20) NOT NULL default '0',
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=latin1 AUTO_INCREMENT=29 ;

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

CREATE TABLE `payeranges` (
  `id` bigint(20) NOT NULL auto_increment,
  `fixedtax` varchar(200) NOT NULL default '',
  `lowerlevel` varchar(200) NOT NULL default '',
  `upperlevel` varchar(200) NOT NULL default '',
  `percentagetax` varchar(200) NOT NULL default '',
  `type` varchar(200) NOT NULL default 'local',
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

-- 
-- Dumping data for table `payeranges`
-- 

INSERT INTO `payeranges` VALUES (1, '0', '0', '130000', '0', 'local');
INSERT INTO `payeranges` VALUES (2, '0', '130000', '235000', '10', 'local');
INSERT INTO `payeranges` VALUES (3, '10500', '235000', '410000', '20', 'local');
INSERT INTO `payeranges` VALUES (4, '45500', '410000', '0', '30', 'local');

-- --------------------------------------------------------

-- 
-- Table structure for table `paymentforms`
-- 

CREATE TABLE `paymentforms` (
  `id` bigint(20) NOT NULL auto_increment,
  `form` varchar(255) NOT NULL default '',
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

-- 
-- Dumping data for table `paymentforms`
-- 

INSERT INTO `paymentforms` VALUES (1, 'Cash');
INSERT INTO `paymentforms` VALUES (2, 'Cheque');
INSERT INTO `paymentforms` VALUES (4, 'RTGS');
INSERT INTO `paymentforms` VALUES (5, 'Telegraphic Transfer');

-- --------------------------------------------------------

-- 
-- Table structure for table `personnel`
-- 

CREATE TABLE `personnel` (
  `id` bigint(20) NOT NULL auto_increment,
  `guard` varchar(255) NOT NULL default '',
  `type` varchar(255) NOT NULL default '',
  `notes` varchar(255) NOT NULL default '',
  `actiontaken` varchar(255) NOT NULL default '',
  `takenby` varchar(100) NOT NULL default '',
  `disciplineletter` varchar(100) default NULL,
  `date` datetime NOT NULL default '0000-00-00 00:00:00',
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=latin1 AUTO_INCREMENT=28 ;

-- 
-- Dumping data for table `personnel`
-- 

INSERT INTO `personnel` VALUES (6, 'F554', 'Discipline', 'She is good', 'Transfer', 'Natume Deborah', NULL, '2008-02-08 00:00:00');
INSERT INTO `personnel` VALUES (8, 'W344', 'Indiscipline', 'Very Poor Behaviours', 'Warning', 'Garry Johns', NULL, '2008-01-25 00:00:00');
INSERT INTO `personnel` VALUES (24, 'T023', 'Discipline', 'He escaped and caught a guard', 'Transfer', 'Daniel Kiwanuka', NULL, '2008-02-17 00:00:00');
INSERT INTO `personnel` VALUES (25, 'T012', 'Indiscipline', 'ok', 'Suspension', 'Musoke', NULL, '2007-04-08 00:00:00');
INSERT INTO `personnel` VALUES (26, 'T012', 'Discipline', 'He managed to catch an escaping thief in the middle of a rainny night.', 'Promotion', 'GM', 'T012Proposal_28Jan08.doc', '1997-04-19 00:00:00');
INSERT INTO `personnel` VALUES (27, 'J201', 'Discipline', 'She perfomed well in he debut year', 'Promotion', 'Nantume Irene', 'J201e-payroll features.doc', '1991-02-25 00:00:00');

-- --------------------------------------------------------

-- 
-- Table structure for table `personnelfiles`
-- 

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
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

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
) ENGINE=InnoDB AUTO_INCREMENT=186 DEFAULT CHARSET=latin1 AUTO_INCREMENT=186 ;

-- 
-- Dumping data for table `persons`
-- 

INSERT INTO `persons` VALUES (1, 'System', 'Administrator', '', '', 'Uganda', 'tribe', '2006-07-03', 0, 'N', NULL, NULL, 3, 0, NULL, 2007, 0, NULL, '0000-00-00 00:00:00');
INSERT INTO `persons` VALUES (4, 'Jimmy', 'Oluchi', 'Oketcho', '', 'Uganda', 'Alur', '2005-09-25', 0, 'N', NULL, NULL, 6, 0, NULL, 2007, 0, 0, '0000-00-00 00:00:00');
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
INSERT INTO `persons` VALUES (135, 'Fat', 'Opio', 'Darlem', '', 'American Samoa', '8', '1974-04-15', 555, '', '', '', 551, 0, 552, 2007, 1, 1, '2008-07-16 15:01:26');
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
INSERT INTO `persons` VALUES (146, 'Cherry', 'Johns', 'Vent', 'Cherry', '', '', '1980-07-17', 484, '', 'dancer', 'Charlies Angels EXTER', 485, 0, 0, 2007, 1, 1, '2008-07-16 15:01:27');
INSERT INTO `persons` VALUES (147, 'Tim', 'Johanson', '', '', '', '', '0000-00-00', 0, '', 'Computer Wiz', 'computers & Co', 494, 0, 0, 2007, 1, 1, '2008-07-16 15:01:27');
INSERT INTO `persons` VALUES (149, 'Folarn', 'Garry', 'Hunt', '', '', '', '0000-00-00', 0, 'N', 'manager', 'MTN Uganda', 527, 0, 0, 2007, 1, 1, '2008-02-12 17:44:10');
INSERT INTO `persons` VALUES (150, 'Lady', 'Fatuma', 'Hint', '', '', '', '0000-00-00', 0, 'Y', 'Manager', 'UTL', 528, 0, 0, 2007, 1, 1, '2008-02-12 17:44:10');
INSERT INTO `persons` VALUES (151, 'Maria', 'angel', 'magdalene', 'Tina', '', '', '1985-08-08', 530, '', 'dancer', 'Angel Droppers', 531, 0, 0, 2007, 1, 1, '2008-02-12 17:44:10');
INSERT INTO `persons` VALUES (152, 'John', 'Kenny', '', '', '', '', '0000-00-00', 0, '', 'Farmer', 'NAADS', 532, 0, 0, 2007, 1, 1, '2008-02-12 17:44:10');
INSERT INTO `persons` VALUES (154, 'Tito', 'Simon', 'Okello', '', 'Argentina', '8', '1973-03-17', 572, '', '', '', 568, 0, 569, 2007, 1, 1, '2008-04-01 09:57:34');
INSERT INTO `persons` VALUES (155, 'Joseph', 'Okot', 'Opio', '', 'Uganda', '9', '1973-01-17', 580, '', '', '', 576, 0, 577, 2007, 1, 1, '2008-04-09 13:52:07');
INSERT INTO `persons` VALUES (156, 'Tim', 'Ben', 'Okot', '', 'Uganda', '8', '1974-04-16', 632, '', '', '', 628, 0, 629, 2008, 1, 1, '2008-02-01 14:25:52');
INSERT INTO `persons` VALUES (157, 'Tim', 'Ben', 'Okello', '', 'Uganda', '8', '0000-00-00', 745, '', '', '', 741, 0, 742, 2008, 1, NULL, NULL);
INSERT INTO `persons` VALUES (158, 'Tim', 'Benson', 'Okello', 'Barry', 'Uganda', '10', '1974-02-19', 753, '', '', '', 749, 0, 750, 2008, 1, 1, '2008-04-01 11:39:04');
INSERT INTO `persons` VALUES (159, 'Wilson', 'Akena', 'Akena', '', 'Uganda', '8', '1972-11-13', 916, '', '', '', 912, 0, 913, 2008, 1, 1, '2008-04-10 09:42:02');
INSERT INTO `persons` VALUES (160, 'Ariko', 'Tom', 'Ochan', '', '', '', '0000-00-00', 0, 'N', '', '', 1745, 0, 0, 2008, 1, 1, '2008-04-01 11:39:05');
INSERT INTO `persons` VALUES (161, 'Harriet', 'Anena', 'Pasca', '', '', '', '0000-00-00', 0, 'Y', '', '', 1746, 0, 0, 2008, 1, 1, '2008-04-01 11:39:05');
INSERT INTO `persons` VALUES (162, 'Asalo', 'Rebbecca', 'Akuti', '', '', '', '1983-07-22', 1771, '', 'Teacher', 'Muyingo', 1772, 0, 0, 2008, 1, 1, '2008-04-01 11:39:05');
INSERT INTO `persons` VALUES (163, 'Eyaru', 'Barnabas', '', '', '', '', '0000-00-00', 0, '', 'Banker', 'Barclays', 1773, 0, 0, 2008, 1, 1, '2008-04-01 11:39:05');
INSERT INTO `persons` VALUES (164, 'Jackson', 'Kugonza', 'Akugira', '', 'Uganda', '12', '0000-00-00', 1868, '', '', '', 1864, 0, 1865, 2008, 1, NULL, NULL);
INSERT INTO `persons` VALUES (165, 'Jackson', 'Kugonza', 'Akugira', '', 'Uganda', '12', '0000-00-00', 1876, '', '', '', 1872, 0, 1873, 2008, 1, NULL, NULL);
INSERT INTO `persons` VALUES (166, 'Jackson', 'Kugonza', 'Akugira', '', 'Uganda', '12', '0000-00-00', 1884, '', '', '', 1880, 0, 1881, 2008, 1, NULL, NULL);
INSERT INTO `persons` VALUES (167, 'Jackson', 'Kugonza', 'Akugira', '', 'Uganda', '12', '0000-00-00', 1892, '', '', '', 1888, 0, 1889, 2008, 1, NULL, NULL);
INSERT INTO `persons` VALUES (168, 'cxzc', 'xcz', 'czc', 'zczc', 'Uganda', '10', '0000-00-00', 1900, '', '', '', 1896, 0, 1897, 2008, 1, NULL, NULL);
INSERT INTO `persons` VALUES (170, 'Doreen', 'Alaso', '', '', 'Uganda', '', '0000-00-00', 1916, '', '', '', 1912, 0, 1913, 2008, 1, NULL, NULL);
INSERT INTO `persons` VALUES (173, 'Julian', 'Kugonza', 'Ouma', '', 'Denmark', '11', '1975-08-11', 1940, '', '', '', 1936, 0, 1937, 2008, 1, 1, '2008-04-30 11:53:23');
INSERT INTO `persons` VALUES (174, 'ryan', 'babel', '', '', 'Netherlands', '3', '0000-00-00', 1958, '', '', '', 1954, 0, 1955, 2008, 1, NULL, NULL);
INSERT INTO `persons` VALUES (175, 'ryan', 'babel', '', '', 'Netherlands', '', '0000-00-00', 1966, '', '', '', 1962, 0, 1963, 2008, 1, NULL, NULL);
INSERT INTO `persons` VALUES (180, 'Ryan', 'Babel', '', '', 'Netherlands', '10', '1984-03-01', 2021, '', '', '', 2017, 0, 2018, 2008, 1, 1, '2008-04-07 17:40:01');
INSERT INTO `persons` VALUES (181, 'Lameck', 'Kintu', '', '', 'Uganda', '', '0000-00-00', 2179, '', '', '', 2175, 0, 2176, 2008, 1, NULL, NULL);
INSERT INTO `persons` VALUES (182, 'Almond', 'Tester', '', '', 'Uganda', '', '0000-00-00', 2192, '', '', '', 2188, 0, 2189, 2008, 1, NULL, NULL);
INSERT INTO `persons` VALUES (183, 'Tinka', 'Johnson', '', '', 'Uganda', '', '0000-00-00', 2200, '', '', '', 2196, 0, 2197, 2008, 1, 1, '2008-05-21 07:40:15');
INSERT INTO `persons` VALUES (184, 'Johnson', 'Byakabare', '', '', 'Uganda', '3', '1972-06-16', 2213, '', '', '', 2209, 0, 2210, 2008, 1, 1, '2008-05-21 08:02:31');
INSERT INTO `persons` VALUES (185, 'Chico', 'United', '', '', 'Uganda', '', '0000-00-00', 2236, '', '', '', 2232, 0, 2233, 2008, 1, 1, '2008-07-02 15:23:33');

-- --------------------------------------------------------

-- 
-- Table structure for table `places`
-- 

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
) ENGINE=InnoDB AUTO_INCREMENT=2367 DEFAULT CHARSET=latin1 AUTO_INCREMENT=2367 ;

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
INSERT INTO `places` VALUES (2301, '', '', '', '', '', '', '', '', '', '', '', '', '', 1, '2008-07-02', NULL, NULL);
INSERT INTO `places` VALUES (2302, '', '', '', '', '', '', '', '', '', '', '', '', '', 1, '2008-07-02', NULL, NULL);
INSERT INTO `places` VALUES (2303, '', '', '', '', '', '', '', '', '', '', '', '', '', 1, '2008-07-02', NULL, NULL);
INSERT INTO `places` VALUES (2304, '', '', '', '', '', '', '', '', '', '', '', '', '', 1, '2008-07-02', NULL, NULL);
INSERT INTO `places` VALUES (2305, '', '', '', '', '', '', '', '', '', '', '', '', '', 1, '2008-07-02', NULL, NULL);
INSERT INTO `places` VALUES (2306, '', '', '', '', '', '', '', '', '', '', '', '', '', 1, '2008-07-02', NULL, NULL);
INSERT INTO `places` VALUES (2307, '', '', '', '', '', '', '', '', '', '', '', '', '', 1, '2008-07-02', NULL, NULL);
INSERT INTO `places` VALUES (2308, '', '', '', '', '', '', '', '', '', '', '', '', '', 1, '2008-07-02', NULL, NULL);
INSERT INTO `places` VALUES (2309, '', '', '', '', '', '', '', '', '', '', '', '', '', 1, '2008-07-02', NULL, NULL);
INSERT INTO `places` VALUES (2310, '', '', '', '', '', '', '', '', '', '', '', '', '', 1, '2008-07-02', NULL, NULL);
INSERT INTO `places` VALUES (2311, '', '', '', '', '', '', '', '', '', '', '', '', '', 1, '2008-07-02', NULL, NULL);
INSERT INTO `places` VALUES (2312, '', '', '', '', '', '', '', '', '', '', '', '', '', 1, '2008-07-02', NULL, NULL);
INSERT INTO `places` VALUES (2313, '', '', '', '', '', '', '', '', '', '', '', '', '', 1, '2008-07-02', NULL, NULL);
INSERT INTO `places` VALUES (2314, '', '', '', '', '', '', '', '', '', '', '', '', '', 1, '2008-07-02', NULL, NULL);
INSERT INTO `places` VALUES (2315, '', '', '', '', '', '', '', '', '', '', '', '', '', 1, '2008-07-02', NULL, NULL);
INSERT INTO `places` VALUES (2316, '', '', '', '', '', '', '', '', '', '', '', '', '', 1, '2008-07-02', NULL, NULL);
INSERT INTO `places` VALUES (2317, '', '', '', '', '', '', '', '', '', '', '', '', '', 1, '2008-07-02', NULL, NULL);
INSERT INTO `places` VALUES (2318, '', '', '', '', '', '', '', '', '', '', '', '', '', 1, '2008-07-02', NULL, NULL);
INSERT INTO `places` VALUES (2319, '', '', '', '', '', '', '', '', '', '', '', '', '', 1, '2008-07-02', NULL, NULL);
INSERT INTO `places` VALUES (2320, '', '', '', '', '', '', '', '', '', '', '', '', '', 1, '2008-07-02', NULL, NULL);
INSERT INTO `places` VALUES (2321, '', '', '', '', '', '', '', '', '', '', '', '', '', 1, '2008-07-02', NULL, NULL);
INSERT INTO `places` VALUES (2322, '', '', '', '', '', '', '', '', '', '', '', '', '', 1, '2008-07-02', NULL, NULL);
INSERT INTO `places` VALUES (2323, '', '', '', '', '', '', '', '', '', '', '', '', '', 1, '2008-07-02', NULL, NULL);
INSERT INTO `places` VALUES (2324, '', '', '', '', '', '', '', '', '', '', '', '', '', 1, '2008-07-02', NULL, NULL);
INSERT INTO `places` VALUES (2325, '', '', '', '', '', '', '', '', '', '', '', '', '', 1, '2008-07-02', NULL, NULL);
INSERT INTO `places` VALUES (2326, '', '', '', '', '', '', '', '', '', '', '', '', '', 1, '2008-07-02', NULL, NULL);
INSERT INTO `places` VALUES (2327, '', '', '', '', '', '', '', '', '', '', '', '', '', 1, '2008-07-02', NULL, NULL);
INSERT INTO `places` VALUES (2328, '', '', '', '', '', '', '', '', '', '', '', '', '', 1, '2008-07-02', NULL, NULL);
INSERT INTO `places` VALUES (2329, '', '', '', '', '', '', '', '', '', '', '', '', '', 1, '2008-07-02', NULL, NULL);
INSERT INTO `places` VALUES (2330, '', '', '', '', '', '', '', '', '', '', '', '', '', 1, '2008-07-02', NULL, NULL);
INSERT INTO `places` VALUES (2331, '', '', '', '', '', '', '', '', '', '', '', '', '', 1, '2008-07-02', NULL, NULL);
INSERT INTO `places` VALUES (2332, '', '', '', '', '', '', '', '', '', '', '', '', '', 1, '2008-07-02', NULL, NULL);
INSERT INTO `places` VALUES (2333, '', '', '', '', '', '', '', '', '', '', '', '', '', 1, '2008-07-02', NULL, NULL);
INSERT INTO `places` VALUES (2334, '', '', '', '', '', '', '', '', '', '', '', '', '', 1, '2008-07-02', NULL, NULL);
INSERT INTO `places` VALUES (2335, '', '', '', '', '', '', '', '', '', '', '', '', '', 1, '2008-07-02', NULL, NULL);
INSERT INTO `places` VALUES (2336, '', '', '', '', '', '', '', '', '', '', '', '', '', 1, '2008-07-02', NULL, NULL);
INSERT INTO `places` VALUES (2337, '', '', '', '', '', '', '', '', '', '', '', '', '', 1, '2008-07-02', NULL, NULL);
INSERT INTO `places` VALUES (2338, '', '', '', '', '', '', '', '', '', '', '', '', '', 1, '2008-07-02', NULL, NULL);
INSERT INTO `places` VALUES (2339, '', '', '', '', '', '', '', '', '', '', '', '', '', 1, '2008-07-02', NULL, NULL);
INSERT INTO `places` VALUES (2340, '', '', '', '', '', '', '', '', '', '', '', '', '', 1, '2008-07-02', NULL, NULL);
INSERT INTO `places` VALUES (2341, '', '', '', '', '', '', '', '', '', '', '', '', '', 1, '2008-07-02', NULL, NULL);
INSERT INTO `places` VALUES (2342, '', '', '', '', '', '', '', '', '', '', '', '', '', 1, '2008-07-02', NULL, NULL);
INSERT INTO `places` VALUES (2343, '', '', '', '', '', '', '', '', '', '', '', '', '', 1, '2008-07-02', NULL, NULL);
INSERT INTO `places` VALUES (2344, '', '', '', '', '', '', '', '', '', '', '', '', '', 1, '2008-07-02', NULL, NULL);
INSERT INTO `places` VALUES (2345, '', '', '', '', '', '', '', '', '', '', '', '', '', 1, '2008-07-02', NULL, NULL);
INSERT INTO `places` VALUES (2346, '', '', '', '', '', '', '', '', '', '', '', '', '', 1, '2008-07-02', NULL, NULL);
INSERT INTO `places` VALUES (2347, '', '', '', '', '', '', '', '', '', '', '', '', '', 1, '2008-07-02', NULL, NULL);
INSERT INTO `places` VALUES (2348, '', '', '', '', '', '', '', '', '', '', '', '', '', 1, '2008-07-02', NULL, NULL);
INSERT INTO `places` VALUES (2349, '', '', '', '', '', '', '', '', '', '', '', '', '', 1, '2008-07-02', NULL, NULL);
INSERT INTO `places` VALUES (2350, '', '', '', '', '', '', '', '', '', '', '', '', '', 1, '2008-07-02', NULL, NULL);
INSERT INTO `places` VALUES (2351, '', '', '', '', '', '', '', '', '', '', '', '', '', 1, '2008-07-02', NULL, NULL);
INSERT INTO `places` VALUES (2352, '', '', '', '', '', '', '', '', '', '', '', '', '', 1, '2008-07-02', NULL, NULL);
INSERT INTO `places` VALUES (2353, '', '', '', '', '', '', '', '', '', '', '', '', '', 1, '2008-07-02', NULL, NULL);
INSERT INTO `places` VALUES (2354, '', '', '', '', '', '', '', '', '', '', '', '', '', 1, '2008-07-02', NULL, NULL);
INSERT INTO `places` VALUES (2355, '', '', '', '', '', '', '', '', '', '', '', '', '', 1, '2008-07-02', NULL, NULL);
INSERT INTO `places` VALUES (2356, '', '', '', '', '', '', '', '', '', '', '', '', '', 1, '2008-07-02', NULL, NULL);
INSERT INTO `places` VALUES (2357, '', '', '', '', '', '', '', '', '', '', '', '', '', 1, '2008-07-02', NULL, NULL);
INSERT INTO `places` VALUES (2358, '', '', '', '', '', '', '', '', '', '', '', '', '', 1, '2008-07-02', NULL, NULL);
INSERT INTO `places` VALUES (2359, '', '', '', '', '', '', '', '', '', '', '', '', '', 1, '2008-07-02', NULL, NULL);
INSERT INTO `places` VALUES (2360, '', '', '', '', '', '', '', '', '', '', '', '', '', 1, '2008-07-02', NULL, NULL);
INSERT INTO `places` VALUES (2361, '', '', '', '', '', '', '', '', '', '', '', '', '', 1, '2008-07-02', NULL, NULL);
INSERT INTO `places` VALUES (2362, '', '', '', '', '', '', '', '', '', '', '', '', '', 1, '2008-07-02', NULL, NULL);
INSERT INTO `places` VALUES (2363, '', '', '', '', '', '', '', '', '', '', '', '', '', 1, '2008-07-02', NULL, NULL);
INSERT INTO `places` VALUES (2364, '', '', '', '', '', '', '', '', '', '', '', '', '', 1, '2008-07-02', NULL, NULL);
INSERT INTO `places` VALUES (2365, '', '', '', '', '', '', '', '', '', '', '', '', '', 1, '2008-07-16', NULL, NULL);
INSERT INTO `places` VALUES (2366, '', '', '', '', '', '', '', '', '', '', '', '', '', 1, '2008-07-16', NULL, NULL);

-- --------------------------------------------------------

-- 
-- Table structure for table `promotions`
-- 

CREATE TABLE `promotions` (
  `id` bigint(20) NOT NULL auto_increment,
  `guard` varchar(100) NOT NULL default '',
  `oldtitle` varchar(250) NOT NULL default '',
  `newtitle` varchar(250) NOT NULL default '',
  `dateofpromotion` datetime NOT NULL default '0000-00-00 00:00:00',
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

-- 
-- Dumping data for table `promotions`
-- 

INSERT INTO `promotions` VALUES (1, '123123', '', '1', '2008-04-28 11:21:59');
INSERT INTO `promotions` VALUES (2, 'K903', '1', '2', '2008-04-28 11:21:59');
INSERT INTO `promotions` VALUES (3, 'T023', '1', '3', '2008-04-28 11:22:00');
INSERT INTO `promotions` VALUES (4, '123123', '1', '2', '2008-04-28 11:25:28');
INSERT INTO `promotions` VALUES (5, 'T023', '3', '1', '2008-04-28 11:25:29');
INSERT INTO `promotions` VALUES (6, 'K903', '2', '3', '2008-04-28 11:37:50');
INSERT INTO `promotions` VALUES (7, 'T023', '1', '2', '2008-04-28 11:37:50');

-- --------------------------------------------------------

-- 
-- Table structure for table `referees`
-- 

CREATE TABLE `referees` (
  `id` bigint(20) NOT NULL auto_increment,
  `name` varchar(100) NOT NULL default '',
  `physicaladdress` varchar(250) NOT NULL default '',
  `telephone` varchar(100) NOT NULL default '',
  `date_of_entry` datetime default NULL,
  `createdby` bigint(20) default NULL,
  `lastupdatedby` bigint(20) NOT NULL default '0',
  `lastupdatedate` datetime NOT NULL default '0000-00-00 00:00:00',
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=160 DEFAULT CHARSET=latin1 AUTO_INCREMENT=160 ;

-- 
-- Dumping data for table `referees`
-- 

INSERT INTO `referees` VALUES (1, 'Sentamu Christopher', 'terry Drive\r\nKololo 2321', '9898796789', '2007-10-29 08:50:42', 0, 0, '0000-00-00 00:00:00');
INSERT INTO `referees` VALUES (2, 'Sentamu Christopher', 'terry Drive\r\nKololo 2321', '9898796789', '2007-10-29 08:51:23', 0, 0, '0000-00-00 00:00:00');
INSERT INTO `referees` VALUES (3, 'Sentamu Christopher', 'terry Drive\r\nKololo 2321', '9898796789', '2007-10-29 08:51:52', 0, 0, '0000-00-00 00:00:00');
INSERT INTO `referees` VALUES (4, 'Sentamu Christopher', 'terry Drive\r\nKololo 2321', '9898796789', '2007-10-29 08:53:00', 0, 0, '0000-00-00 00:00:00');
INSERT INTO `referees` VALUES (5, 'Sentamu Christopher', 'terry Drive\r\nKololo 2321', '9898796789', '2007-10-29 08:56:36', 0, 0, '0000-00-00 00:00:00');
INSERT INTO `referees` VALUES (6, '', '', '', '2007-10-29 08:59:02', 1, 0, '0000-00-00 00:00:00');
INSERT INTO `referees` VALUES (7, '', '', '', '2007-10-29 08:59:30', 1, 0, '0000-00-00 00:00:00');
INSERT INTO `referees` VALUES (8, '', '', '', '2007-10-29 09:01:39', 1, 0, '0000-00-00 00:00:00');
INSERT INTO `referees` VALUES (9, '', '', '', '2007-10-29 09:05:35', 1, 0, '0000-00-00 00:00:00');
INSERT INTO `referees` VALUES (10, '', '', '', '2007-10-29 09:11:22', 1, 0, '0000-00-00 00:00:00');
INSERT INTO `referees` VALUES (11, '', '', '', '2007-10-29 09:17:16', 1, 0, '0000-00-00 00:00:00');
INSERT INTO `referees` VALUES (12, '', '', '', '2007-10-29 09:19:36', 1, 0, '0000-00-00 00:00:00');
INSERT INTO `referees` VALUES (13, '', '', '', '2007-10-29 09:25:22', 1, 0, '0000-00-00 00:00:00');
INSERT INTO `referees` VALUES (14, '', '', '', '2007-10-29 09:28:32', 1, 0, '0000-00-00 00:00:00');
INSERT INTO `referees` VALUES (15, '', '', '', '2007-10-29 09:31:30', 1, 0, '0000-00-00 00:00:00');
INSERT INTO `referees` VALUES (16, '', '', '', '2007-10-29 09:36:03', 1, 0, '0000-00-00 00:00:00');
INSERT INTO `referees` VALUES (17, '', '', '', '2007-10-29 09:38:26', 1, 0, '0000-00-00 00:00:00');
INSERT INTO `referees` VALUES (18, '', '', '', '2007-10-29 09:38:58', 1, 0, '0000-00-00 00:00:00');
INSERT INTO `referees` VALUES (19, '', '', '', '2007-10-29 09:40:52', 1, 0, '0000-00-00 00:00:00');
INSERT INTO `referees` VALUES (20, '', '', '', '2007-10-29 09:45:18', 1, 0, '0000-00-00 00:00:00');
INSERT INTO `referees` VALUES (21, '', '', '', '2007-10-29 09:46:23', 1, 0, '0000-00-00 00:00:00');
INSERT INTO `referees` VALUES (22, '', '', '', '2007-10-29 09:47:57', 1, 0, '0000-00-00 00:00:00');
INSERT INTO `referees` VALUES (23, '', '', '', '2007-10-29 09:49:22', 1, 0, '0000-00-00 00:00:00');
INSERT INTO `referees` VALUES (24, '', '', '', '2007-10-29 09:51:56', 1, 0, '0000-00-00 00:00:00');
INSERT INTO `referees` VALUES (25, '', '', '', '2007-10-29 09:52:41', 1, 0, '0000-00-00 00:00:00');
INSERT INTO `referees` VALUES (26, '', '', '', '2007-10-29 10:36:08', 1, 0, '0000-00-00 00:00:00');
INSERT INTO `referees` VALUES (27, '', '', '', '2007-10-29 10:39:54', 1, 0, '0000-00-00 00:00:00');
INSERT INTO `referees` VALUES (28, '', '', '', '2007-10-29 10:43:45', 1, 0, '0000-00-00 00:00:00');
INSERT INTO `referees` VALUES (29, '', '', '', '2007-10-29 10:53:43', 1, 0, '0000-00-00 00:00:00');
INSERT INTO `referees` VALUES (30, '', '', '', '2007-10-29 13:14:54', 1, 0, '0000-00-00 00:00:00');
INSERT INTO `referees` VALUES (31, '', '', '', '2007-10-29 13:18:54', 1, 0, '0000-00-00 00:00:00');
INSERT INTO `referees` VALUES (32, '', '', '', '2007-10-29 13:21:56', 1, 0, '0000-00-00 00:00:00');
INSERT INTO `referees` VALUES (33, '', '', '', '2007-10-29 13:23:25', 1, 0, '0000-00-00 00:00:00');
INSERT INTO `referees` VALUES (34, '', '', '', '2007-10-29 13:25:09', 1, 0, '0000-00-00 00:00:00');
INSERT INTO `referees` VALUES (35, '', '', '', '2007-10-29 13:56:42', 1, 0, '0000-00-00 00:00:00');
INSERT INTO `referees` VALUES (36, '', '', '', '2007-10-29 14:08:49', 1, 0, '0000-00-00 00:00:00');
INSERT INTO `referees` VALUES (37, '', '', '', '2007-10-29 14:11:43', 1, 0, '0000-00-00 00:00:00');
INSERT INTO `referees` VALUES (38, '', '', '', '2007-10-29 14:19:57', 1, 0, '0000-00-00 00:00:00');
INSERT INTO `referees` VALUES (39, '', '', '', '2007-10-29 14:21:04', 1, 0, '0000-00-00 00:00:00');
INSERT INTO `referees` VALUES (40, '', '', '', '2007-10-29 14:32:28', 1, 0, '0000-00-00 00:00:00');
INSERT INTO `referees` VALUES (41, 'Mr. Samson Kiseka', 'Plot 3 Jint Lane', '1141231312', '2007-10-29 14:51:12', 1, 0, '0000-00-00 00:00:00');
INSERT INTO `referees` VALUES (42, 'Mr. Samson Kiseka', 'Plot 3 Jint Lane', '1141231312', '2007-10-29 14:52:57', 1, 0, '0000-00-00 00:00:00');
INSERT INTO `referees` VALUES (43, 'Mr. Samson Kiseka', 'Plot 3 Jint Lane', '1141231312', '2007-10-29 14:55:00', 1, 0, '0000-00-00 00:00:00');
INSERT INTO `referees` VALUES (44, 'Mr. Samson Kiseka', 'Plot 3 Jint Lane', '1141231312', '2007-10-29 14:56:42', 1, 0, '0000-00-00 00:00:00');
INSERT INTO `referees` VALUES (45, 'Mr. Samson Kiseka', 'Plot 3 Jint Lane', '1141231312', '2007-10-29 15:00:31', 1, 0, '0000-00-00 00:00:00');
INSERT INTO `referees` VALUES (46, 'Mr. Samson Kiseka', 'Plot 3 Jint Lane', '1141231312', '2007-10-29 15:01:41', 1, 0, '0000-00-00 00:00:00');
INSERT INTO `referees` VALUES (47, 'Mr. Samson Kiseka', 'Plot 3 Jint Lane', '1141231312', '2007-10-29 15:03:33', 1, 0, '0000-00-00 00:00:00');
INSERT INTO `referees` VALUES (48, 'Mr. Samson Kiseka', 'Plot 3 Jint Lane', '1141231312', '2007-10-29 15:09:02', 1, 0, '0000-00-00 00:00:00');
INSERT INTO `referees` VALUES (49, 'Felix Kint', 'Plot 23 Fun Drive', '1123213', '2007-10-29 15:10:04', 1, 0, '0000-00-00 00:00:00');
INSERT INTO `referees` VALUES (50, 'Hill Johns', 'Plot 2 Getty Drive', '531113123', '2007-10-29 15:10:04', 1, 0, '0000-00-00 00:00:00');
INSERT INTO `referees` VALUES (51, 'Mr. Samson Kiseka', 'Plot 3 Jint Lane', '1141231312', '2007-10-29 15:10:04', 1, 0, '0000-00-00 00:00:00');
INSERT INTO `referees` VALUES (52, 'Felix Kint', 'Plot 23 Fun Drive', '1123213', '2007-10-29 15:10:58', 1, 0, '0000-00-00 00:00:00');
INSERT INTO `referees` VALUES (53, 'Hill Johns', 'Plot 2 Getty Drive', '531113123', '2007-10-29 15:10:58', 1, 0, '0000-00-00 00:00:00');
INSERT INTO `referees` VALUES (54, 'Mr. Samson Kiseka', 'Plot 3 Jint Lane', '1141231312', '2007-10-29 15:10:58', 1, 0, '0000-00-00 00:00:00');
INSERT INTO `referees` VALUES (55, 'Felix Kint', 'Plot 23 Fun Drive', '1123213', '2007-10-29 15:13:10', 1, 0, '0000-00-00 00:00:00');
INSERT INTO `referees` VALUES (56, 'Hill Johns', 'Plot 2 Getty Drive', '531113123', '2007-10-29 15:13:10', 1, 0, '0000-00-00 00:00:00');
INSERT INTO `referees` VALUES (57, 'Mr. Samson Kiseka', 'Plot 3 Jint Lane', '1141231312', '2007-10-29 15:13:10', 1, 0, '0000-00-00 00:00:00');
INSERT INTO `referees` VALUES (58, 'Felix Kint', 'Plot 23 Fun Drive', '1123213', '2007-10-29 15:14:44', 1, 0, '0000-00-00 00:00:00');
INSERT INTO `referees` VALUES (59, 'Hill Johns', 'Plot 2 Getty Drive', '531113123', '2007-10-29 15:14:44', 1, 0, '0000-00-00 00:00:00');
INSERT INTO `referees` VALUES (60, 'Mr. Samson Kiseka', 'Plot 3 Jint Lane', '1141231312', '2007-10-29 15:14:44', 1, 0, '0000-00-00 00:00:00');
INSERT INTO `referees` VALUES (61, 'Felix Kint', 'Plot 23 Fun Drive', '1123213', '2007-10-29 15:15:14', 1, 0, '0000-00-00 00:00:00');
INSERT INTO `referees` VALUES (62, 'Hill Johns', 'Plot 2 Getty Drive', '531113123', '2007-10-29 15:15:14', 1, 0, '0000-00-00 00:00:00');
INSERT INTO `referees` VALUES (63, 'Mr. Samson Kiseka', 'Plot 3 Jint Lane', '1141231312', '2007-10-29 15:15:14', 1, 0, '0000-00-00 00:00:00');
INSERT INTO `referees` VALUES (64, 'Felix Kint', 'Plot 23 Fun Drive', '1123213', '2007-10-29 15:23:02', 1, 0, '0000-00-00 00:00:00');
INSERT INTO `referees` VALUES (65, 'Hill Johns', 'Plot 2 Getty Drive', '531113123', '2007-10-29 15:23:02', 1, 0, '0000-00-00 00:00:00');
INSERT INTO `referees` VALUES (66, 'Mr. Samson Kiseka', 'Plot 3 Jint Lane', '1141231312', '2007-10-29 15:23:02', 1, 0, '0000-00-00 00:00:00');
INSERT INTO `referees` VALUES (67, 'Felix Kint', 'Plot 23 Fun Drive', '1123213', '2007-10-29 15:25:23', 1, 0, '0000-00-00 00:00:00');
INSERT INTO `referees` VALUES (68, 'Hill Johns', 'Plot 2 Getty Drive', '531113123', '2007-10-29 15:25:23', 1, 0, '0000-00-00 00:00:00');
INSERT INTO `referees` VALUES (69, 'Mr. Samson Kiseka', 'Plot 3 Jint Lane', '1141231312', '2007-10-29 15:25:23', 1, 0, '0000-00-00 00:00:00');
INSERT INTO `referees` VALUES (70, 'Felix Kint', 'Plot 23 Fun Drive', '1123213', '2007-10-29 15:27:32', 1, 0, '0000-00-00 00:00:00');
INSERT INTO `referees` VALUES (71, 'Hill Johns', 'Plot 2 Getty Drive', '531113123', '2007-10-29 15:27:32', 1, 0, '0000-00-00 00:00:00');
INSERT INTO `referees` VALUES (72, 'Mr. Samson Kiseka', 'Plot 3 Jint Lane', '1141231312', '2007-10-29 15:27:32', 1, 0, '0000-00-00 00:00:00');
INSERT INTO `referees` VALUES (73, 'Felix Kint', 'Plot 23 Fun Drive', '1123213', '2007-10-29 15:28:22', 1, 0, '0000-00-00 00:00:00');
INSERT INTO `referees` VALUES (74, 'Hill Johns', 'Plot 2 Getty Drive', '531113123', '2007-10-29 15:28:22', 1, 0, '0000-00-00 00:00:00');
INSERT INTO `referees` VALUES (75, 'Mr. Samson Kiseka', 'Plot 3 Jint Lane', '1141231312', '2007-10-29 15:28:22', 1, 0, '0000-00-00 00:00:00');
INSERT INTO `referees` VALUES (76, 'Felix Kint', 'Plot 23 Fun Drive', '1123213', '2007-10-29 15:29:42', 1, 1, '2007-11-09 06:08:00');
INSERT INTO `referees` VALUES (77, 'Hill Johns', 'Plot 2 Getty 23 Drive', '531113123', '2007-10-29 15:29:42', 1, 1, '2007-11-09 06:08:00');
INSERT INTO `referees` VALUES (78, 'Mr. Samson Kiseka (RIP)', 'Plot 3 Jint Lane', '1141231312', '2007-10-29 15:29:42', 1, 1, '2007-11-09 06:08:01');
INSERT INTO `referees` VALUES (79, 'Felix Kint', 'Plot 23 Fun Drive', '1123213', '2007-10-29 15:42:42', 1, 1, '2007-11-09 06:17:49');
INSERT INTO `referees` VALUES (80, 'Hill Johns', 'Plot 2 Getty Drive', '531113123', '2007-10-29 15:42:42', 1, 1, '2007-11-09 06:17:50');
INSERT INTO `referees` VALUES (81, 'Mr. Samson Kiseka', 'Plot 3 Jint Lane', '1141231312', '2007-10-29 15:42:42', 1, 1, '2007-11-09 06:17:50');
INSERT INTO `referees` VALUES (82, '', '', '', '2007-11-09 06:35:43', 1, 1, '2007-11-09 06:38:07');
INSERT INTO `referees` VALUES (83, '', '', '', '2007-11-09 06:35:43', 1, 1, '2007-11-09 06:38:07');
INSERT INTO `referees` VALUES (84, 'the Journery', 'Hey,\r\nDid you see this\r\nGarry', '52543245345', '2007-11-09 09:10:19', 1, 1, '2008-07-16 15:01:27');
INSERT INTO `referees` VALUES (85, 'Kintu Ismail', 'Death Valley\r\n34 Silicon Rd', '08578678657', '2007-11-09 09:10:19', 1, 1, '2008-07-16 15:01:27');
INSERT INTO `referees` VALUES (86, '', '', '', '2007-11-11 22:18:30', 1, 1, '2008-02-11 10:50:02');
INSERT INTO `referees` VALUES (87, '', '', '', '2007-11-11 22:18:30', 1, 1, '2008-02-11 10:50:02');
INSERT INTO `referees` VALUES (88, '', '', '', '2007-11-14 02:32:38', 1, 0, '0000-00-00 00:00:00');
INSERT INTO `referees` VALUES (89, 'Mr. John Peter', 'Dr. You Yi\r\nRd behind Peter\r\nHint', '7353445345', '2007-11-14 05:22:16', 1, 1, '2008-07-16 15:01:27');
INSERT INTO `referees` VALUES (90, 'Felix R.', 'Goat Tier\r\nTore Johns', '8456745', '2007-11-14 09:28:19', 1, 1, '2008-02-12 17:44:11');
INSERT INTO `referees` VALUES (91, 'Tinker', 'Hint Runner\r\nroad Tink', '45345345', '2007-11-14 09:28:19', 1, 1, '2008-02-12 17:44:11');
INSERT INTO `referees` VALUES (92, 'Sender', 'Goart Koran\r\nI want to go!!!', '643563456', '2007-11-14 09:28:19', 1, 1, '2008-02-12 17:44:11');
INSERT INTO `referees` VALUES (93, '', '', '', '2007-11-15 11:44:34', 1, 1, '2007-11-15 11:46:53');
INSERT INTO `referees` VALUES (94, '', '', '', '2007-11-15 11:44:34', 1, 1, '2007-11-15 11:46:53');
INSERT INTO `referees` VALUES (95, '', '', '', '2007-11-27 18:41:49', 1, 1, '2008-02-08 12:04:16');
INSERT INTO `referees` VALUES (96, '', '', '', '2007-11-27 18:41:49', 1, 1, '2008-02-08 12:04:16');
INSERT INTO `referees` VALUES (97, '', '', '', '2007-11-27 18:44:37', 1, 1, '2008-04-01 09:57:35');
INSERT INTO `referees` VALUES (98, '', '', '', '2007-11-27 18:44:37', 1, 1, '2008-04-01 09:57:35');
INSERT INTO `referees` VALUES (99, '', '', '', '2007-11-27 18:49:27', 1, 1, '2008-04-09 13:52:07');
INSERT INTO `referees` VALUES (100, '', '', '', '2007-11-27 18:49:27', 1, 1, '2008-04-09 13:52:07');
INSERT INTO `referees` VALUES (101, '', '', '', '2008-01-16 09:45:52', 1, 0, '0000-00-00 00:00:00');
INSERT INTO `referees` VALUES (102, '', '', '', '2008-01-16 09:45:52', 1, 0, '0000-00-00 00:00:00');
INSERT INTO `referees` VALUES (103, '', '', '', '2008-01-25 10:19:20', 1, 1, '2008-02-01 14:25:52');
INSERT INTO `referees` VALUES (104, '', '', '', '2008-01-25 10:19:20', 1, 1, '2008-02-01 14:25:52');
INSERT INTO `referees` VALUES (105, '', '', '', '2008-02-04 14:37:30', 1, 0, '0000-00-00 00:00:00');
INSERT INTO `referees` VALUES (106, '', '', '', '2008-02-04 14:37:30', 1, 0, '0000-00-00 00:00:00');
INSERT INTO `referees` VALUES (107, 'Ash Luwambo', 'Plot 456, Rubaga\r\nKampala,\r\nUganda', '+256752311567', '2008-02-05 08:14:54', 1, 1, '2008-04-01 11:39:05');
INSERT INTO `referees` VALUES (108, 'Luwambo James', 'Plot 456, Rubaga,\r\nKampala,\r\nUganda', '+256772456654', '2008-02-05 08:14:54', 1, 1, '2008-04-01 11:39:05');
INSERT INTO `referees` VALUES (109, '', '', '', '2008-02-05 13:17:16', 1, 1, '2008-04-10 09:42:03');
INSERT INTO `referees` VALUES (110, '', '', '', '2008-02-05 13:17:16', 1, 1, '2008-04-10 09:42:03');
INSERT INTO `referees` VALUES (111, '', '', '', '2008-04-01 11:48:35', 1, 0, '0000-00-00 00:00:00');
INSERT INTO `referees` VALUES (112, '', '', '', '2008-04-01 11:48:35', 1, 0, '0000-00-00 00:00:00');
INSERT INTO `referees` VALUES (113, '', '', '', '2008-04-01 11:51:58', 1, 0, '0000-00-00 00:00:00');
INSERT INTO `referees` VALUES (114, '', '', '', '2008-04-01 11:51:58', 1, 0, '0000-00-00 00:00:00');
INSERT INTO `referees` VALUES (115, '', '', '', '2008-04-01 12:00:11', 1, 0, '0000-00-00 00:00:00');
INSERT INTO `referees` VALUES (116, '', '', '', '2008-04-01 12:00:11', 1, 0, '0000-00-00 00:00:00');
INSERT INTO `referees` VALUES (117, '', '', '', '2008-04-01 12:01:01', 1, 0, '0000-00-00 00:00:00');
INSERT INTO `referees` VALUES (118, '', '', '', '2008-04-01 12:01:01', 1, 0, '0000-00-00 00:00:00');
INSERT INTO `referees` VALUES (119, '', '', '', '2008-04-01 12:10:52', 1, 0, '0000-00-00 00:00:00');
INSERT INTO `referees` VALUES (120, '', '', '', '2008-04-01 12:10:52', 1, 0, '0000-00-00 00:00:00');
INSERT INTO `referees` VALUES (121, '', '', '', '2008-04-01 12:14:24', 1, 0, '0000-00-00 00:00:00');
INSERT INTO `referees` VALUES (122, '', '', '', '2008-04-01 12:14:24', 1, 0, '0000-00-00 00:00:00');
INSERT INTO `referees` VALUES (123, '', '', '', '2008-04-01 12:15:16', 1, 0, '0000-00-00 00:00:00');
INSERT INTO `referees` VALUES (124, '', '', '', '2008-04-01 12:15:16', 1, 0, '0000-00-00 00:00:00');
INSERT INTO `referees` VALUES (125, '', '', '', '2008-04-01 12:17:20', 1, 0, '0000-00-00 00:00:00');
INSERT INTO `referees` VALUES (126, '', '', '', '2008-04-01 12:17:20', 1, 0, '0000-00-00 00:00:00');
INSERT INTO `referees` VALUES (127, '', '', '', '2008-04-01 12:24:19', 1, 0, '0000-00-00 00:00:00');
INSERT INTO `referees` VALUES (128, '', '', '', '2008-04-01 12:24:19', 1, 0, '0000-00-00 00:00:00');
INSERT INTO `referees` VALUES (129, '', '', '', '2008-04-01 12:26:28', 1, 1, '2008-04-30 11:53:23');
INSERT INTO `referees` VALUES (130, '', '', '', '2008-04-01 12:26:28', 1, 1, '2008-04-30 11:53:23');
INSERT INTO `referees` VALUES (131, '', '', '', '2008-04-01 12:40:34', 1, 0, '0000-00-00 00:00:00');
INSERT INTO `referees` VALUES (132, '', '', '', '2008-04-01 12:40:34', 1, 0, '0000-00-00 00:00:00');
INSERT INTO `referees` VALUES (133, '', '', '', '2008-04-01 12:41:30', 1, 0, '0000-00-00 00:00:00');
INSERT INTO `referees` VALUES (134, '', '', '', '2008-04-01 12:41:30', 1, 0, '0000-00-00 00:00:00');
INSERT INTO `referees` VALUES (135, '', '', '', '2008-04-01 13:08:18', 1, 0, '0000-00-00 00:00:00');
INSERT INTO `referees` VALUES (136, '', '', '', '2008-04-01 13:08:18', 1, 0, '0000-00-00 00:00:00');
INSERT INTO `referees` VALUES (137, '', '', '', '2008-04-01 13:23:24', 1, 0, '0000-00-00 00:00:00');
INSERT INTO `referees` VALUES (138, '', '', '', '2008-04-01 13:23:24', 1, 0, '0000-00-00 00:00:00');
INSERT INTO `referees` VALUES (139, '', '', '', '2008-04-01 13:24:56', 1, 0, '0000-00-00 00:00:00');
INSERT INTO `referees` VALUES (140, '', '', '', '2008-04-01 13:24:56', 1, 0, '0000-00-00 00:00:00');
INSERT INTO `referees` VALUES (141, '', '', '', '2008-04-01 13:26:34', 1, 0, '0000-00-00 00:00:00');
INSERT INTO `referees` VALUES (142, '', '', '', '2008-04-01 13:26:34', 1, 0, '0000-00-00 00:00:00');
INSERT INTO `referees` VALUES (143, '', '', '', '2008-04-01 13:26:53', 1, 1, '2008-04-07 17:40:01');
INSERT INTO `referees` VALUES (144, '', '', '', '2008-04-01 13:26:53', 1, 1, '2008-04-07 17:40:01');
INSERT INTO `referees` VALUES (145, '', '', '', '2008-04-21 08:33:21', 1, 0, '0000-00-00 00:00:00');
INSERT INTO `referees` VALUES (146, '', '', '', '2008-04-21 08:33:21', 1, 0, '0000-00-00 00:00:00');
INSERT INTO `referees` VALUES (147, '', '', '', '2008-05-03 13:26:07', 1, 0, '0000-00-00 00:00:00');
INSERT INTO `referees` VALUES (148, '', '', '', '2008-05-03 13:26:07', 1, 0, '0000-00-00 00:00:00');
INSERT INTO `referees` VALUES (149, '', '', '', '2008-05-20 17:56:53', 1, 1, '2008-05-21 07:40:15');
INSERT INTO `referees` VALUES (150, '', '', '', '2008-05-20 17:56:53', 1, 1, '2008-05-21 07:40:15');
INSERT INTO `referees` VALUES (151, '', '', '', '2008-05-21 07:59:00', 1, 1, '2008-05-21 08:02:31');
INSERT INTO `referees` VALUES (152, '', '', '', '2008-05-21 07:59:00', 1, 1, '2008-05-21 08:02:31');
INSERT INTO `referees` VALUES (153, '', '', '', '2008-07-02 10:40:42', 1, 1, '2008-07-02 15:23:33');
INSERT INTO `referees` VALUES (154, '', '', '', '2008-07-02 10:40:42', 1, 1, '2008-07-02 15:23:33');
INSERT INTO `referees` VALUES (155, '', '', '', '2008-07-02 11:24:06', 1, 0, '0000-00-00 00:00:00');
INSERT INTO `referees` VALUES (156, '', '', '', '2008-07-02 11:24:09', 1, 0, '0000-00-00 00:00:00');
INSERT INTO `referees` VALUES (157, '', '', '', '2008-07-02 11:24:12', 1, 0, '0000-00-00 00:00:00');
INSERT INTO `referees` VALUES (158, '', '', '', '2008-07-02 11:24:22', 1, 0, '0000-00-00 00:00:00');
INSERT INTO `referees` VALUES (159, '', '', '', '2008-07-02 14:32:29', 1, 0, '0000-00-00 00:00:00');

-- --------------------------------------------------------

-- 
-- Table structure for table `regions`
-- 

CREATE TABLE `regions` (
  `id` bigint(20) NOT NULL auto_increment,
  `name` varchar(255) default NULL,
  `description` varchar(255) default NULL,
  `areascovered` varchar(255) default NULL,
  `code` varchar(255) default 'N',
  `createdby` bigint(20) default NULL,
  `datecreated` date default NULL,
  `lastupdatedby` bigint(20) default NULL,
  `lastupdatedate` timestamp NULL default NULL on update CURRENT_TIMESTAMP,
  PRIMARY KEY  (`id`),
  UNIQUE KEY `code` (`code`)
) ENGINE=InnoDB AUTO_INCREMENT=41 DEFAULT CHARSET=latin1 AUTO_INCREMENT=41 ;

-- 
-- Dumping data for table `regions`
-- 

INSERT INTO `regions` VALUES (9, 'warid towers', 'warid premises', 'kampala - Jinja road', 'WAR-1', 1, '2007-10-26', NULL, '2008-03-26 13:56:37');
INSERT INTO `regions` VALUES (11, 'Kampala', 'City', 'Nakawa,Banda,Kireka', 'KLA-1', 1, '2007-10-26', NULL, '2007-11-30 09:18:58');
INSERT INTO `regions` VALUES (13, 'wakiso', 'all major towns in wakiso', 'standandard charterd,stanbic,shell', 'WAK-1', 1, '2007-10-26', NULL, '2007-11-30 09:19:12');
INSERT INTO `regions` VALUES (14, 'Kololo', 'Kololo airstrip', 'airstrip', 'KOL-1', 1, '2007-10-26', NULL, '2007-11-30 09:19:25');
INSERT INTO `regions` VALUES (15, 'kasese', 'all towns in kasese', 'margharita,rwenzor NP', 'KAS-2', 1, '2007-10-26', NULL, '2007-11-30 09:19:44');
INSERT INTO `regions` VALUES (29, 'Kampala', 'capital city', 'kiseka market,capital shoppers supermarket,', 'KLA-2', 1, '2007-10-27', NULL, '2007-11-30 09:19:57');
INSERT INTO `regions` VALUES (31, 'masaka', 'masaka town', 'kyabakuza,mpondwe', 'MAS-1', 1, '2007-10-27', NULL, '2007-11-30 09:20:11');
INSERT INTO `regions` VALUES (33, 'Kampala', 'CBD of kampala and surroundings', 'Kololo,Muyenga', 'KLA-3', 1, '2007-11-28', NULL, '2007-11-30 09:20:21');
INSERT INTO `regions` VALUES (35, 'Mbarara', 'Mbarara City', 'Main street,High Street', 'MBR-1', 1, '2008-01-11', NULL, NULL);
INSERT INTO `regions` VALUES (36, 'Kampala', 'kampala Central region and surroundings', 'New Park,Old Park', 'KLA-4', 1, '2008-01-16', NULL, '2008-03-19 17:20:18');
INSERT INTO `regions` VALUES (40, 'Kabale', 'Kabale (Kigezi) District', 'Kabale TC, Kagadi, katerarume, kangore', 'KBL', 1, '2008-03-19', NULL, '2008-03-26 13:56:12');

-- --------------------------------------------------------

-- 
-- Table structure for table `reportdetails`
-- 

CREATE TABLE `reportdetails` (
  `id` bigint(20) NOT NULL auto_increment,
  `detail` varchar(250) NOT NULL default '',
  `reporttype` varchar(250) NOT NULL default '',
  `viewedby` varchar(250) NOT NULL default '1',
  `date_of_entry` datetime NOT NULL default '0000-00-00 00:00:00',
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=59 DEFAULT CHARSET=latin1 AUTO_INCREMENT=59 ;

-- 
-- Dumping data for table `reportdetails`
-- 

INSERT INTO `reportdetails` VALUES (11, 'Client Name', 'Client Invoice', '1', '2007-11-26 19:59:41');
INSERT INTO `reportdetails` VALUES (13, 'Item Name', 'Item Location', '1', '2007-12-04 08:16:01');
INSERT INTO `reportdetails` VALUES (14, 'Item Serial No', 'Item Location', '1', '2007-12-05 08:16:48');
INSERT INTO `reportdetails` VALUES (15, 'In Custody Of', 'Item Location', '1', '2007-12-05 08:18:55');
INSERT INTO `reportdetails` VALUES (16, 'Current Location', 'Item Location', '1', '2007-12-05 08:19:15');
INSERT INTO `reportdetails` VALUES (17, 'On Assignment', 'Item Location', '1', '2007-12-05 08:19:57');
INSERT INTO `reportdetails` VALUES (18, 'Expected Return Date', 'Item Location', '1', '2007-12-05 08:20:37');
INSERT INTO `reportdetails` VALUES (19, 'Item Status', 'Item Location', '1', '2007-12-05 08:21:04');
INSERT INTO `reportdetails` VALUES (20, 'Issued By', 'Item Location', '1', '2007-12-05 15:43:23');
INSERT INTO `reportdetails` VALUES (21, 'Incident Reference Number', 'Control Shift', '1', '2007-12-08 16:28:34');
INSERT INTO `reportdetails` VALUES (22, 'Details', 'Control Shift', '1', '2007-12-07 16:29:13');
INSERT INTO `reportdetails` VALUES (23, 'Assignment', 'Control Shift', '1', '2007-12-07 16:29:59');
INSERT INTO `reportdetails` VALUES (24, 'Reported By', 'Control Shift', '1', '2007-12-07 16:30:11');
INSERT INTO `reportdetails` VALUES (25, 'Date', 'Control Shift', '1', '0000-00-00 00:00:00');
INSERT INTO `reportdetails` VALUES (26, 'Actions Taken', 'Control Shift', '1', '2007-12-07 16:31:00');
INSERT INTO `reportdetails` VALUES (27, 'Guard Responsible', 'Control Shift', '1', '2007-12-05 16:37:00');
INSERT INTO `reportdetails` VALUES (28, 'Checked By', 'Control Shift', '1', '2007-12-08 16:37:16');
INSERT INTO `reportdetails` VALUES (29, 'Assignment Call Sign', 'Client Invoice', '1', '2007-12-07 14:06:00');
INSERT INTO `reportdetails` VALUES (30, 'Assignment Total Charge', 'Client Invoice', '1', '2007-12-07 14:06:26');
INSERT INTO `reportdetails` VALUES (31, 'Total Charge', 'Client Invoice', '1', '2007-12-08 14:06:45');
INSERT INTO `reportdetails` VALUES (32, 'Assignment Charge Rate', 'Client Invoice', '1', '2007-12-08 14:07:26');
INSERT INTO `reportdetails` VALUES (33, 'Charge Period', 'Client Invoice', '1', '2007-12-08 14:10:21');
INSERT INTO `reportdetails` VALUES (34, 'Client Address', 'Client Invoice', '1', '2007-12-07 14:26:46');
INSERT INTO `reportdetails` VALUES (35, 'Assignment Type', 'Client Invoice', '1', '2007-12-06 00:00:00');
INSERT INTO `reportdetails` VALUES (36, 'Invoice Date', 'Client Invoice', '1', '2007-12-06 16:21:39');
INSERT INTO `reportdetails` VALUES (43, 'Guard Name', 'Guard Payroll', '1', '2007-12-05 21:34:27');
INSERT INTO `reportdetails` VALUES (44, 'Guard ID', 'Guard Payroll', '1', '2007-12-05 21:34:39');
INSERT INTO `reportdetails` VALUES (45, 'Gross Payment', 'Guard Payroll', '1', '2007-12-06 21:35:35');
INSERT INTO `reportdetails` VALUES (46, 'Bonuses', 'Guard Payroll', '1', '2007-12-02 21:35:54');
INSERT INTO `reportdetails` VALUES (47, 'Net Payment', 'Guard Payroll', '1', '2007-12-06 21:37:05');
INSERT INTO `reportdetails` VALUES (48, 'Deductions', 'Guard Payroll', '1', '2007-12-07 21:38:45');
INSERT INTO `reportdetails` VALUES (49, 'Total Amount Due to All Guards', 'Guard Payroll', '1', '2007-12-08 21:44:37');
INSERT INTO `reportdetails` VALUES (50, 'Leave Days', 'Guard Payroll', '1', '2008-02-01 00:00:00');
INSERT INTO `reportdetails` VALUES (51, 'Overtime Charge', 'Guard Payroll', '1', '2008-02-01 00:00:00');
INSERT INTO `reportdetails` VALUES (52, 'Particulars', 'Ledger Report', '1', '2008-08-13 00:00:00');
INSERT INTO `reportdetails` VALUES (53, 'Account', 'Ledger Report', '1', '2008-08-14 00:00:00');
INSERT INTO `reportdetails` VALUES (54, 'Amount', 'Ledger Report', '1', '2008-08-14 00:00:00');
INSERT INTO `reportdetails` VALUES (55, 'Date', 'Ledger Report', '1', '2008-08-14 00:00:00');
INSERT INTO `reportdetails` VALUES (56, 'Received By', 'Ledger Report', '1', '2008-08-14 00:00:00');
INSERT INTO `reportdetails` VALUES (57, 'Passed By', 'Ledger Report', '1', '2008-08-14 00:00:00');
INSERT INTO `reportdetails` VALUES (58, 'Payment Form', 'Ledger Report', '1', '2008-08-14 00:00:00');

-- --------------------------------------------------------

-- 
-- Table structure for table `rights`
-- 

CREATE TABLE `rights` (
  `id` bigint(20) NOT NULL auto_increment,
  `rightname` varchar(255) NOT NULL default '',
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=202 DEFAULT CHARSET=latin1 AUTO_INCREMENT=202 ;

-- 
-- Dumping data for table `rights`
-- 

INSERT INTO `rights` VALUES (32, 'Can view Administration and HR Module');
INSERT INTO `rights` VALUES (33, 'Can view Finance and Accounting Module');
INSERT INTO `rights` VALUES (34, 'Can view Operations Management Module');
INSERT INTO `rights` VALUES (35, 'Can view Inventory Management Module');
INSERT INTO `rights` VALUES (36, 'Can view client schedules');
INSERT INTO `rights` VALUES (38, 'Can view operations reminders');
INSERT INTO `rights` VALUES (39, 'Can view finance reminders');
INSERT INTO `rights` VALUES (40, 'Can view HR reminders');
INSERT INTO `rights` VALUES (41, 'Can view admin reminders');
INSERT INTO `rights` VALUES (42, 'Can search guards archive');
INSERT INTO `rights` VALUES (43, 'Can view guard details');
INSERT INTO `rights` VALUES (44, 'Can change guard status');
INSERT INTO `rights` VALUES (45, 'Can delete guard');
INSERT INTO `rights` VALUES (46, 'Can create new guard');
INSERT INTO `rights` VALUES (47, 'Can create new assignment');
INSERT INTO `rights` VALUES (48, 'Can create new client');
INSERT INTO `rights` VALUES (49, 'Can delete client');
INSERT INTO `rights` VALUES (50, 'Can search clients');
INSERT INTO `rights` VALUES (51, 'Can view client details');
INSERT INTO `rights` VALUES (52, 'Can view all assignments on a client');
INSERT INTO `rights` VALUES (53, 'Can edit client details');
INSERT INTO `rights` VALUES (54, 'Can create new user');
INSERT INTO `rights` VALUES (55, 'Can search users');
INSERT INTO `rights` VALUES (56, 'Can edit user details');
INSERT INTO `rights` VALUES (57, 'Can delete user details');
INSERT INTO `rights` VALUES (58, 'Can view user details');
INSERT INTO `rights` VALUES (59, 'Can create new groups');
INSERT INTO `rights` VALUES (60, 'Can search groups');
INSERT INTO `rights` VALUES (61, 'Can edit groups');
INSERT INTO `rights` VALUES (62, 'Can delete groups');
INSERT INTO `rights` VALUES (63, 'Can view group details');
INSERT INTO `rights` VALUES (64, 'Can view all group users');
INSERT INTO `rights` VALUES (65, 'Can add leave applications');
INSERT INTO `rights` VALUES (66, 'Can search leave applications');
INSERT INTO `rights` VALUES (67, 'Can edit leave applications');
INSERT INTO `rights` VALUES (68, 'Can delete leave applications');
INSERT INTO `rights` VALUES (69, 'Can view all leave application details');
INSERT INTO `rights` VALUES (70, 'Can approve under operations');
INSERT INTO `rights` VALUES (71, 'Can approve under HR');
INSERT INTO `rights` VALUES (72, 'Can approve under Finance');
INSERT INTO `rights` VALUES (73, 'Can search for guard''s personnel file');
INSERT INTO `rights` VALUES (74, 'Can create new personnel file');
INSERT INTO `rights` VALUES (75, 'Can edit personnel file details');
INSERT INTO `rights` VALUES (76, 'Can delete personnel file details');
INSERT INTO `rights` VALUES (77, 'Can view guard personnel file');
INSERT INTO `rights` VALUES (78, 'Can edit client payment information');
INSERT INTO `rights` VALUES (79, 'Can generate client invoice');
INSERT INTO `rights` VALUES (80, 'Can generate a schedule for a given client''s assignments');
INSERT INTO `rights` VALUES (81, 'Can edit assignment rates');
INSERT INTO `rights` VALUES (82, 'Can edit guard rates');
INSERT INTO `rights` VALUES (83, 'Can generate payroll reports');
INSERT INTO `rights` VALUES (84, 'Can view PAYE schedule');
INSERT INTO `rights` VALUES (85, 'Can edit PAYE schedule');
INSERT INTO `rights` VALUES (86, 'Can view NSSF schedule');
INSERT INTO `rights` VALUES (87, 'Can edit NSSF schedule');
INSERT INTO `rights` VALUES (88, 'Can view guard''s financial status');
INSERT INTO `rights` VALUES (89, 'Can update guard''s financial status');
INSERT INTO `rights` VALUES (90, 'Can search assignment overtime');
INSERT INTO `rights` VALUES (91, 'Can add assignment overtime');
INSERT INTO `rights` VALUES (92, 'Can view assignment overtime details');
INSERT INTO `rights` VALUES (93, 'Can request for a new financial report');
INSERT INTO `rights` VALUES (94, 'Can post replacement for a guard in an assignment');
INSERT INTO `rights` VALUES (95, 'Can generate control shift reports');
INSERT INTO `rights` VALUES (96, 'Can search for incidents');
INSERT INTO `rights` VALUES (97, 'Can view incident details');
INSERT INTO `rights` VALUES (98, 'Can create new incidents');
INSERT INTO `rights` VALUES (99, 'Can edit incidents');
INSERT INTO `rights` VALUES (100, 'Can delete incidents');
INSERT INTO `rights` VALUES (101, 'Can view actions taken on incidents');
INSERT INTO `rights` VALUES (102, 'Can search for regoins');
INSERT INTO `rights` VALUES (103, 'Can create regions');
INSERT INTO `rights` VALUES (104, 'Can view region details');
INSERT INTO `rights` VALUES (105, 'Can edit region details');
INSERT INTO `rights` VALUES (106, 'Can delete regoin');
INSERT INTO `rights` VALUES (107, 'Can search for item in the inventory');
INSERT INTO `rights` VALUES (108, 'Can add new item in inventory');
INSERT INTO `rights` VALUES (109, 'Can view items in inventory');
INSERT INTO `rights` VALUES (110, 'Can edit items in inventory');
INSERT INTO `rights` VALUES (111, 'Can delete items in inventory');
INSERT INTO `rights` VALUES (112, 'Can issue item');
INSERT INTO `rights` VALUES (113, 'Can search issued items');
INSERT INTO `rights` VALUES (114, 'Can view issued item details');
INSERT INTO `rights` VALUES (115, 'Can edit item issues');
INSERT INTO `rights` VALUES (116, 'Can delete item issues');
INSERT INTO `rights` VALUES (117, 'Can search returned items');
INSERT INTO `rights` VALUES (118, 'Can view returned items');
INSERT INTO `rights` VALUES (119, 'Can edit item returns');
INSERT INTO `rights` VALUES (120, 'Can delete item returns');
INSERT INTO `rights` VALUES (121, 'Can generate item location report');
INSERT INTO `rights` VALUES (122, 'Can view guard location');
INSERT INTO `rights` VALUES (123, 'Can view available guards');
INSERT INTO `rights` VALUES (124, 'Can change user group');
INSERT INTO `rights` VALUES (125, 'Can change PAYE formulae');
INSERT INTO `rights` VALUES (126, 'Can manage leave types');
INSERT INTO `rights` VALUES (127, 'Can manage districts');
INSERT INTO `rights` VALUES (128, 'Can send requests to the system administrator');
INSERT INTO `rights` VALUES (129, 'Can manage tribes');
INSERT INTO `rights` VALUES (130, 'Can manage user rights');
INSERT INTO `rights` VALUES (131, 'Can manage user groups');
INSERT INTO `rights` VALUES (132, 'Can manage disciplinary actions');
INSERT INTO `rights` VALUES (133, 'Can manage service types');
INSERT INTO `rights` VALUES (134, 'Can manage item types');
INSERT INTO `rights` VALUES (135, 'Can manage item status');
INSERT INTO `rights` VALUES (136, 'Can manage guard status');
INSERT INTO `rights` VALUES (137, 'Can view audit trail');
INSERT INTO `rights` VALUES (138, 'Can change global settings');
INSERT INTO `rights` VALUES (139, 'Can change system expiry date');
INSERT INTO `rights` VALUES (141, 'Can print guard details');
INSERT INTO `rights` VALUES (142, 'Can search for guards');
INSERT INTO `rights` VALUES (143, 'Can approve overtime.');
INSERT INTO `rights` VALUES (144, 'Can generate guard schedule');
INSERT INTO `rights` VALUES (145, 'Can manage alarm installations');
INSERT INTO `rights` VALUES (150, 'Can manage fuel distribution');
INSERT INTO `rights` VALUES (151, 'Can post overtime for a guard in an assignment');
INSERT INTO `rights` VALUES (152, 'Can add new alarms');
INSERT INTO `rights` VALUES (153, 'Can edit alarms');
INSERT INTO `rights` VALUES (154, 'Can delete alarms');
INSERT INTO `rights` VALUES (155, 'Can manage vehicle service details');
INSERT INTO `rights` VALUES (156, 'Can manage vehicle daily logbooks');
INSERT INTO `rights` VALUES (157, 'Can view vehicle daily logbook');
INSERT INTO `rights` VALUES (158, 'Can view vehicle service details');
INSERT INTO `rights` VALUES (159, 'Can manage loans');
INSERT INTO `rights` VALUES (160, 'Can register loan applications');
INSERT INTO `rights` VALUES (161, 'Can modify loan application details');
INSERT INTO `rights` VALUES (162, 'Can approve as GM');
INSERT INTO `rights` VALUES (163, 'Can view the guard''s period of service');
INSERT INTO `rights` VALUES (164, 'Can add new supplier');
INSERT INTO `rights` VALUES (165, 'Can manage departments');
INSERT INTO `rights` VALUES (166, 'Can manage item purchases');
INSERT INTO `rights` VALUES (168, 'Can register an item purchase');
INSERT INTO `rights` VALUES (169, 'Can delete an item purchase');
INSERT INTO `rights` VALUES (170, 'Can manage perfomance appraisals');
INSERT INTO `rights` VALUES (171, 'Can delete perfomance appraisals');
INSERT INTO `rights` VALUES (172, 'Can add perfomance appraisals');
INSERT INTO `rights` VALUES (173, 'Can edit an appraisal');
INSERT INTO `rights` VALUES (174, 'Manage client complaints');
INSERT INTO `rights` VALUES (175, 'Manage guard complaints');
INSERT INTO `rights` VALUES (177, 'Can add client complaints');
INSERT INTO `rights` VALUES (178, 'Can add guard complaints');
INSERT INTO `rights` VALUES (179, 'Can delete client complaints');
INSERT INTO `rights` VALUES (180, 'Can delete guard complaints');
INSERT INTO `rights` VALUES (181, 'Can manage assignment inspection reports');
INSERT INTO `rights` VALUES (182, 'Can add assignment inspection reports');
INSERT INTO `rights` VALUES (183, 'Can delete assignment inspection reports');
INSERT INTO `rights` VALUES (184, 'Can manage sitrep checks');
INSERT INTO `rights` VALUES (185, 'Can manage financial transactions');
INSERT INTO `rights` VALUES (186, 'Can generate client contracts');
INSERT INTO `rights` VALUES (187, 'Can manage assignment separations');
INSERT INTO `rights` VALUES (188, 'Can add assignment separations');
INSERT INTO `rights` VALUES (189, 'Can add vehicle inspections');
INSERT INTO `rights` VALUES (190, 'Can manage vehicle inspections');
INSERT INTO `rights` VALUES (191, 'Can manage average fuel consumption');
INSERT INTO `rights` VALUES (192, 'Can add fuel distribution');
INSERT INTO `rights` VALUES (193, 'Can archive vehicle inspections');
INSERT INTO `rights` VALUES (194, 'Can manage alarm systems installed');
INSERT INTO `rights` VALUES (195, 'Manage guard uniform');
INSERT INTO `rights` VALUES (196, 'Can mark leave as sold');
INSERT INTO `rights` VALUES (197, 'Can manage accounts');
INSERT INTO `rights` VALUES (198, 'Generate Ledger Report');
INSERT INTO `rights` VALUES (199, 'Can manage staff debts');
INSERT INTO `rights` VALUES (200, 'Can manage guard claims');
INSERT INTO `rights` VALUES (201, 'Manage finance categories');

-- --------------------------------------------------------

-- 
-- Table structure for table `schools`
-- 

CREATE TABLE `schools` (
  `id` bigint(20) NOT NULL auto_increment,
  `schoolname` varchar(255) default NULL,
  `type` varchar(100) NOT NULL default '',
  `yearjoined` varchar(255) default NULL,
  `yearleft` varchar(255) default NULL,
  `createdby` bigint(20) default NULL,
  `date_of_entry` datetime default NULL,
  `lastupdatedby` bigint(20) default NULL,
  `lastupdatedate` timestamp NULL default NULL on update CURRENT_TIMESTAMP,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=93 DEFAULT CHARSET=latin1 AUTO_INCREMENT=93 ;

-- 
-- Dumping data for table `schools`
-- 

INSERT INTO `schools` VALUES (1, 'Salem Primary', 'primary', '2003', '2004', 1, '2007-10-29 14:51:12', NULL, NULL);
INSERT INTO `schools` VALUES (2, 'Warlem High School', 'secondary', '2005', '2006', 1, '2007-10-29 14:51:12', NULL, NULL);
INSERT INTO `schools` VALUES (3, 'Best Dancer', 'qual', '', '1998', 1, '2007-10-29 14:51:12', NULL, NULL);
INSERT INTO `schools` VALUES (4, 'Salem Primary', 'primary', '2003', '2004', 1, '2007-10-29 14:52:57', NULL, NULL);
INSERT INTO `schools` VALUES (5, 'Warlem High School', 'secondary', '2005', '2006', 1, '2007-10-29 14:52:57', NULL, NULL);
INSERT INTO `schools` VALUES (6, 'Best Dancer', 'qual', '', '1998', 1, '2007-10-29 14:52:57', NULL, NULL);
INSERT INTO `schools` VALUES (7, 'Salem Primary', 'primary', '2003', '2004', 1, '2007-10-29 14:55:00', NULL, NULL);
INSERT INTO `schools` VALUES (8, 'Warlem High School', 'secondary', '2005', '2006', 1, '2007-10-29 14:55:00', NULL, NULL);
INSERT INTO `schools` VALUES (9, 'Best Dancer', 'qual', '', '1998', 1, '2007-10-29 14:55:00', NULL, NULL);
INSERT INTO `schools` VALUES (10, 'Salem Primary', 'primary', '2003', '2004', 1, '2007-10-29 14:56:41', NULL, NULL);
INSERT INTO `schools` VALUES (11, 'Warlem High School', 'secondary', '2005', '2006', 1, '2007-10-29 14:56:41', NULL, NULL);
INSERT INTO `schools` VALUES (12, 'Best Dancer', 'qual', '', '1998', 1, '2007-10-29 14:56:42', NULL, NULL);
INSERT INTO `schools` VALUES (13, 'Salem Primary', 'primary', '2003', '2004', 1, '2007-10-29 15:00:31', NULL, NULL);
INSERT INTO `schools` VALUES (14, 'Warlem High School', 'secondary', '2005', '2006', 1, '2007-10-29 15:00:31', NULL, NULL);
INSERT INTO `schools` VALUES (15, 'Best Dancer', 'qual', '', '1998', 1, '2007-10-29 15:00:31', NULL, NULL);
INSERT INTO `schools` VALUES (16, 'Salem Primary', 'primary', '2003', '2004', 1, '2007-10-29 15:01:41', NULL, NULL);
INSERT INTO `schools` VALUES (17, 'Warlem High School', 'secondary', '2005', '2006', 1, '2007-10-29 15:01:41', NULL, NULL);
INSERT INTO `schools` VALUES (18, 'Best Dancer', 'qual', '', '1998', 1, '2007-10-29 15:01:41', NULL, NULL);
INSERT INTO `schools` VALUES (19, 'Salem Primary', 'primary', '2003', '2004', 1, '2007-10-29 15:03:33', NULL, NULL);
INSERT INTO `schools` VALUES (20, 'Kintu Primary', 'primary', '1994', '1999', 1, '2007-10-29 15:03:33', NULL, NULL);
INSERT INTO `schools` VALUES (21, 'Warlem High School', 'secondary', '2005', '2006', 1, '2007-10-29 15:03:33', NULL, NULL);
INSERT INTO `schools` VALUES (22, 'Best Dancer', 'qual', '', '1998', 1, '2007-10-29 15:03:33', NULL, NULL);
INSERT INTO `schools` VALUES (23, 'Salem Primary', 'primary', '2003', '2004', 1, '2007-10-29 15:09:02', NULL, NULL);
INSERT INTO `schools` VALUES (24, 'Kintu Primary', 'primary', '1994', '1999', 1, '2007-10-29 15:09:02', NULL, NULL);
INSERT INTO `schools` VALUES (25, 'Warlem High School', 'secondary', '2005', '2006', 1, '2007-10-29 15:09:02', NULL, NULL);
INSERT INTO `schools` VALUES (26, 'Best Dancer', 'qual', '', '1998', 1, '2007-10-29 15:09:02', NULL, NULL);
INSERT INTO `schools` VALUES (27, 'Salem Primary', 'primary', '2003', '2004', 1, '2007-10-29 15:10:04', NULL, NULL);
INSERT INTO `schools` VALUES (28, 'Kintu Primary', 'primary', '1994', '1999', 1, '2007-10-29 15:10:04', NULL, NULL);
INSERT INTO `schools` VALUES (29, 'Warlem High School', 'secondary', '2005', '2006', 1, '2007-10-29 15:10:04', NULL, NULL);
INSERT INTO `schools` VALUES (30, 'Best Dancer', 'qual', '', '1998', 1, '2007-10-29 15:10:04', NULL, NULL);
INSERT INTO `schools` VALUES (31, 'Salem Primary', 'primary', '2003', '2004', 1, '2007-10-29 15:10:57', NULL, NULL);
INSERT INTO `schools` VALUES (32, 'Kintu Primary', 'primary', '1994', '1999', 1, '2007-10-29 15:10:57', NULL, NULL);
INSERT INTO `schools` VALUES (33, 'Warlem High School', 'secondary', '2005', '2006', 1, '2007-10-29 15:10:57', NULL, NULL);
INSERT INTO `schools` VALUES (34, 'Best Dancer', 'qual', '', '1998', 1, '2007-10-29 15:10:58', NULL, NULL);
INSERT INTO `schools` VALUES (35, 'Salem Primary', 'primary', '2003', '2004', 1, '2007-10-29 15:13:09', NULL, NULL);
INSERT INTO `schools` VALUES (36, 'Kintu Primary', 'primary', '1994', '1999', 1, '2007-10-29 15:13:09', NULL, NULL);
INSERT INTO `schools` VALUES (37, 'Warlem High School', 'secondary', '2005', '2006', 1, '2007-10-29 15:13:09', NULL, NULL);
INSERT INTO `schools` VALUES (38, 'Best Dancer', 'qual', '', '1998', 1, '2007-10-29 15:13:10', NULL, NULL);
INSERT INTO `schools` VALUES (39, 'Salem Primary', 'primary', '2003', '2004', 1, '2007-10-29 15:14:44', NULL, NULL);
INSERT INTO `schools` VALUES (40, 'Kintu Primary', 'primary', '1994', '1999', 1, '2007-10-29 15:14:44', NULL, NULL);
INSERT INTO `schools` VALUES (41, 'Warlem High School', 'secondary', '2005', '2006', 1, '2007-10-29 15:14:44', NULL, NULL);
INSERT INTO `schools` VALUES (42, 'Best Dancer', 'qual', '', '1998', 1, '2007-10-29 15:14:44', NULL, NULL);
INSERT INTO `schools` VALUES (43, 'Salem Primary', 'primary', '2003', '2004', 1, '2007-10-29 15:15:13', NULL, NULL);
INSERT INTO `schools` VALUES (44, 'Kintu Primary', 'primary', '1994', '1999', 1, '2007-10-29 15:15:13', NULL, NULL);
INSERT INTO `schools` VALUES (45, 'Warlem High School', 'secondary', '2005', '2006', 1, '2007-10-29 15:15:13', NULL, NULL);
INSERT INTO `schools` VALUES (46, 'Best Dancer', 'qual', '', '1998', 1, '2007-10-29 15:15:14', NULL, NULL);
INSERT INTO `schools` VALUES (47, 'Salem Primary', 'primary', '2003', '2004', 1, '2007-10-29 15:23:01', NULL, NULL);
INSERT INTO `schools` VALUES (48, 'Kintu Primary', 'primary', '1994', '1999', 1, '2007-10-29 15:23:02', NULL, NULL);
INSERT INTO `schools` VALUES (49, 'Warlem High School', 'secondary', '2005', '2006', 1, '2007-10-29 15:23:02', NULL, NULL);
INSERT INTO `schools` VALUES (50, 'Best Dancer', 'qual', '', '1998', 1, '2007-10-29 15:23:02', NULL, NULL);
INSERT INTO `schools` VALUES (51, 'Salem Primary', 'primary', '2003', '2004', 1, '2007-10-29 15:25:23', NULL, NULL);
INSERT INTO `schools` VALUES (52, 'Kintu Primary', 'primary', '1994', '1999', 1, '2007-10-29 15:25:23', NULL, NULL);
INSERT INTO `schools` VALUES (53, 'Warlem High School', 'secondary', '2005', '2006', 1, '2007-10-29 15:25:23', NULL, NULL);
INSERT INTO `schools` VALUES (54, 'Best Dancer', 'qual', '', '1998', 1, '2007-10-29 15:25:23', NULL, NULL);
INSERT INTO `schools` VALUES (55, 'Salem Primary', 'primary', '2003', '2004', 1, '2007-10-29 15:27:32', NULL, NULL);
INSERT INTO `schools` VALUES (56, 'Kintu Primary', 'primary', '1994', '1999', 1, '2007-10-29 15:27:32', NULL, NULL);
INSERT INTO `schools` VALUES (57, 'Warlem High School', 'secondary', '2005', '2006', 1, '2007-10-29 15:27:32', NULL, NULL);
INSERT INTO `schools` VALUES (58, 'Best Dancer', 'qual', '', '1998', 1, '2007-10-29 15:27:32', NULL, NULL);
INSERT INTO `schools` VALUES (59, 'Salem Primary', 'primary', '2003', '2004', 1, '2007-10-29 15:28:22', NULL, NULL);
INSERT INTO `schools` VALUES (60, 'Kintu Primary', 'primary', '1994', '1999', 1, '2007-10-29 15:28:22', NULL, NULL);
INSERT INTO `schools` VALUES (61, 'Warlem High School', 'secondary', '2005', '2006', 1, '2007-10-29 15:28:22', NULL, NULL);
INSERT INTO `schools` VALUES (62, 'Best Dancer', 'qual', '', '1998', 1, '2007-10-29 15:28:22', NULL, NULL);
INSERT INTO `schools` VALUES (63, 'Salem Primary', 'primary', '2003', '2004', 1, '2007-10-29 15:29:41', 1, '2007-11-09 17:07:59');
INSERT INTO `schools` VALUES (64, 'Kintu Primary', 'primary', '1994', '1999', 1, '2007-10-29 15:29:41', 1, '2007-11-09 17:08:00');
INSERT INTO `schools` VALUES (65, 'Warlem High School', 'secondary', '2005', '2006', 1, '2007-10-29 15:29:42', 1, '2007-11-09 17:08:00');
INSERT INTO `schools` VALUES (66, 'Best Dancer', 'qual', '', '1998', 1, '2007-10-29 15:29:42', 1, '2007-11-09 17:08:00');
INSERT INTO `schools` VALUES (67, 'Salem Primary', 'primary', '2003', '2004', 1, '2007-10-29 15:42:42', 1, '2007-11-09 17:17:49');
INSERT INTO `schools` VALUES (68, 'Kintu Primary', 'primary', '1994', '1999', 1, '2007-10-29 15:42:42', 1, '2007-11-09 17:17:49');
INSERT INTO `schools` VALUES (69, 'Warlem High School', 'secondary', '2005', '2006', 1, '2007-10-29 15:42:42', 1, '2007-11-09 17:17:49');
INSERT INTO `schools` VALUES (70, 'Best Dancer', 'qual', '', '1998', 1, '2007-10-29 15:42:42', 1, '2007-11-09 17:17:49');
INSERT INTO `schools` VALUES (71, 'Pokino Secondary', 'secondary', '1996', '2004', 1, '2007-11-09 06:08:00', NULL, NULL);
INSERT INTO `schools` VALUES (72, 'Winner of Eating Competitions', 'qual', '', '2003', 1, '2007-11-09 06:08:00', NULL, NULL);
INSERT INTO `schools` VALUES (73, 'Have Primary Sch.', 'primary', '2005', '2006', 1, '2007-11-09 10:26:29', 1, '2008-07-16 15:01:27');
INSERT INTO `schools` VALUES (74, 'Kintu Primary', 'primary', '2002', '2004', 1, '2007-11-09 10:30:20', 1, '2008-07-16 15:01:27');
INSERT INTO `schools` VALUES (75, 'Goran High School', 'secondary', '1995', '2001', 1, '2007-11-09 10:31:12', 1, '2008-07-16 15:01:27');
INSERT INTO `schools` VALUES (76, 'Kintu High School', 'secondary', '1999', '1999', 1, '2007-11-09 10:31:12', 1, '2008-07-16 15:01:27');
INSERT INTO `schools` VALUES (77, 'Harry Johns', 'qual', '', '2001', 1, '2007-11-09 10:32:52', 1, '2008-07-16 15:01:27');
INSERT INTO `schools` VALUES (78, 'Fint Jotham Award', 'qual', '', '1994', 1, '2007-11-09 10:32:52', 1, '2008-07-16 15:01:27');
INSERT INTO `schools` VALUES (79, 'Talemwa Deaf Association', 'primary', '2003', '2006', 1, '2007-11-13 02:49:04', 1, '2008-07-16 15:01:27');
INSERT INTO `schools` VALUES (80, 'Makerere Primary', 'primary', '1998', '2001', 1, '2007-11-14 09:28:19', 1, '2008-02-12 17:44:10');
INSERT INTO `schools` VALUES (81, 'Kintu Primary', 'primary', '2002', '2005', 1, '2007-11-14 09:28:19', 1, '2008-02-12 17:44:10');
INSERT INTO `schools` VALUES (82, 'Makerere College School', 'secondary', '2004', '2005', 1, '2007-11-14 09:28:19', 1, '2008-02-12 17:44:10');
INSERT INTO `schools` VALUES (83, 'Felix Secodary', 'secondary', '2000', '2004', 1, '2007-11-14 09:28:19', 1, '2008-02-12 17:44:11');
INSERT INTO `schools` VALUES (84, 'Kint High', 'secondary', '1999', '1999', 1, '2007-11-14 09:28:19', 1, '2008-02-12 17:44:11');
INSERT INTO `schools` VALUES (85, 'Font Hanger', 'qual', '', '2003', 1, '2007-11-14 09:28:19', 1, '2008-02-12 17:44:11');
INSERT INTO `schools` VALUES (86, 'Goat Race Hunter', 'qual', '', '2004', 1, '2007-11-14 09:28:19', 1, '2008-02-12 17:44:11');
INSERT INTO `schools` VALUES (87, 'Palabong Primary School', 'primary', '1980', '1986', 1, '2008-01-31 10:45:00', 1, '2008-02-01 14:25:52');
INSERT INTO `schools` VALUES (88, 'Teso College Aleot', 'secondary', '1987', '1991', 1, '2008-01-31 10:45:00', 1, '2008-02-01 14:25:52');
INSERT INTO `schools` VALUES (89, 'Kachombara Primary School', 'primary', '1984', '1992', 1, '2008-03-12 10:00:30', NULL, NULL);
INSERT INTO `schools` VALUES (90, 'Ngora High School', 'secondary', '1993', '1997', 1, '2008-03-12 10:00:31', 1, '2008-04-01 11:39:05');
INSERT INTO `schools` VALUES (91, 'Cadre Course', 'qual', '', '1998', 1, '2008-03-12 10:00:31', 1, '2008-04-01 11:39:05');
INSERT INTO `schools` VALUES (92, 'Kachombara Primary School', 'primary', '1984', '1992', 1, '2008-03-12 10:01:40', 1, '2008-04-01 11:39:05');

-- --------------------------------------------------------

-- 
-- Table structure for table `servicetypes`
-- 

CREATE TABLE `servicetypes` (
  `id` bigint(20) NOT NULL auto_increment,
  `type` text NOT NULL,
  `starttime` varchar(100) NOT NULL default '',
  `endtime` varchar(100) NOT NULL default '',
  `date_of_entry` datetime NOT NULL default '0000-00-00 00:00:00',
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

-- 
-- Dumping data for table `servicetypes`
-- 

INSERT INTO `servicetypes` VALUES (1, 'Alarm - Intruder', '08:00:00', '17:30:00', '2007-11-16 10:24:29');
INSERT INTO `servicetypes` VALUES (2, 'Day - shift', '07:00:00', '18:00:00', '2007-11-16 10:24:44');
INSERT INTO `servicetypes` VALUES (3, 'Weekend - shift', '09:00:00', '18:00:00', '0000-00-00 00:00:00');
INSERT INTO `servicetypes` VALUES (5, 'Night - shift', '18:00:00', '07:00:00', '0000-00-00 00:00:00');
INSERT INTO `servicetypes` VALUES (6, 'Both', '', '', '0000-00-00 00:00:00');
INSERT INTO `servicetypes` VALUES (7, 'Alarm - Panic', '', '', '0000-00-00 00:00:00');
INSERT INTO `servicetypes` VALUES (8, 'Alarm - Intruder/Panic', '', '', '0000-00-00 00:00:00');

-- --------------------------------------------------------

-- 
-- Table structure for table `settings`
-- 

CREATE TABLE `settings` (
  `employernssfrate` varchar(100) NOT NULL default '',
  `employeenssfrate` varchar(250) NOT NULL default '',
  `companyname` text NOT NULL,
  `employerno` text NOT NULL,
  `customerserviceemail` text NOT NULL,
  `expirydate` datetime NOT NULL default '0000-00-00 00:00:00',
  `companytinno` text NOT NULL,
  `serveripaddress` text NOT NULL,
  `companylogo` text NOT NULL,
  `pobox` varchar(250) NOT NULL default '',
  `headqtrscity` varchar(250) NOT NULL default '',
  `headqtrscountry` varchar(250) NOT NULL default '',
  `contacttelphone` varchar(250) NOT NULL default '',
  `abbreviation` varchar(150) NOT NULL default '',
  `VATrate` varchar(150) NOT NULL default ''
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- 
-- Dumping data for table `settings`
-- 

INSERT INTO `settings` VALUES ('10', '5', 'Tiger Security', 'NS.008548 KLA-N', 'info@iknowuganda.com', '2008-12-31 00:00:00', 'T892-123-123', '89.199.87.30', '', '21645', 'Kampala', 'Uganda', '0753333809', 'USL', '17');

-- --------------------------------------------------------

-- 
-- Table structure for table `sickguard`
-- 

CREATE TABLE `sickguard` (
  `id` bigint(20) NOT NULL auto_increment,
  `guard` varchar(255) NOT NULL default '',
  `illness` varchar(255) NOT NULL default '',
  `notes` varchar(255) NOT NULL default '',
  `date_started` datetime NOT NULL default '0000-00-00 00:00:00',
  `date_recovery` datetime NOT NULL default '0000-00-00 00:00:00',
  `date_of_entry` datetime NOT NULL default '0000-00-00 00:00:00',
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=latin1 AUTO_INCREMENT=16 ;

-- 
-- Dumping data for table `sickguard`
-- 

INSERT INTO `sickguard` VALUES (1, 'H013', 'Yellow Fever', 'Can not see well and likes drinking a lot of Coke', '2007-02-18 00:00:00', '2007-12-02 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `sickguard` VALUES (2, 'Y907', 'Headache', 'Just paing', '2003-05-16 00:00:00', '2006-04-03 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `sickguard` VALUES (4, 'T023', 'Headache', 'The bad man', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `sickguard` VALUES (5, 'Y907', 'Yellow Fever', 'His temperature is very high.', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `sickguard` VALUES (12, 'T023', 'Headache', 'He loves to fall sick at the time of Christmas', '1992-01-17 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `sickguard` VALUES (15, 'T023', 'Headache', 'He loves to fall sick at the time of Christmas', '2007-01-17 00:00:00', '2007-12-18 00:00:00', '0000-00-00 00:00:00');

-- --------------------------------------------------------

-- 
-- Table structure for table `suppliers`
-- 

CREATE TABLE `suppliers` (
  `id` bigint(20) NOT NULL auto_increment,
  `suppliername` varchar(250) NOT NULL default '',
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

-- 
-- Dumping data for table `suppliers`
-- 

INSERT INTO `suppliers` VALUES (1, 'Yuen Biau');
INSERT INTO `suppliers` VALUES (2, 'Malaysia Furnishers Ltd');
INSERT INTO `suppliers` VALUES (3, 'Kintu Industries Ltd');
INSERT INTO `suppliers` VALUES (4, 'Muko Investments');

-- --------------------------------------------------------

-- 
-- Table structure for table `transactions`
-- 

CREATE TABLE `transactions` (
  `id` bigint(20) NOT NULL auto_increment,
  `particulars` text NOT NULL,
  `amount` varchar(255) NOT NULL default '',
  `receivedby` varchar(255) NOT NULL default '',
  `passedby` varchar(255) NOT NULL default '',
  `paymentform` varchar(255) NOT NULL default '',
  `type` varchar(255) NOT NULL default '',
  `account` varchar(150) NOT NULL default '',
  `isactive` enum('Y','N') NOT NULL default 'Y',
  `date_of_entry` datetime NOT NULL default '0000-00-00 00:00:00',
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

-- 
-- Dumping data for table `transactions`
-- 

INSERT INTO `transactions` VALUES (1, 'Fuel requisition for May 2008.', '13890000', 'Opio Sam', '', 'Cheque', 'outflow', '', 'N', '2008-05-02 00:00:00');
INSERT INTO `transactions` VALUES (2, 'Transport Van repair charges from Toyota Ugnda', '230000', 'Michael', 'Chris', 'Cash', 'outflow', '10', 'Y', '2008-02-01 00:00:00');
INSERT INTO `transactions` VALUES (5, 'Paid leave reimbursement for Tito Simon Peter', '450000', 'Tito Simon Peter', 'Chris', 'Cash', 'outflow', '8', 'Y', '2008-02-19 00:00:00');
INSERT INTO `transactions` VALUES (7, 'Darsh Peterson guard services payment.', '130000', 'Chris', '', 'Cheque', 'inflow', '6', 'Y', '2008-01-02 00:00:00');
INSERT INTO `transactions` VALUES (8, 'Reimbursement for guard services for 2007 from Crane Bank', '345860990', 'Warda', '', 'Cheque', 'inflow', '6', 'Y', '2008-02-03 00:00:00');
INSERT INTO `transactions` VALUES (9, 'Paid goodwill by Crane Bank.', '243600', 'Michael', '', 'Cash', 'inflow', '7', 'Y', '2008-02-01 00:00:00');

-- --------------------------------------------------------

-- 
-- Table structure for table `tribe`
-- 

CREATE TABLE `tribe` (
  `id` bigint(20) NOT NULL auto_increment,
  `tribe` varchar(250) NOT NULL default '',
  `date_of_entry` datetime NOT NULL default '0000-00-00 00:00:00',
  `lastupdatedby` bigint(20) NOT NULL default '0',
  `lastupdatedate` datetime NOT NULL default '0000-00-00 00:00:00',
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1 AUTO_INCREMENT=13 ;

-- 
-- Dumping data for table `tribe`
-- 

INSERT INTO `tribe` VALUES (2, 'Karamajong', '2007-10-25 09:48:58', 0, '0000-00-00 00:00:00');
INSERT INTO `tribe` VALUES (3, 'Baganda', '2007-10-25 09:53:50', 0, '0000-00-00 00:00:00');
INSERT INTO `tribe` VALUES (7, 'Basoga', '2007-10-25 10:33:29', 0, '0000-00-00 00:00:00');
INSERT INTO `tribe` VALUES (8, 'Itesot', '2007-10-27 14:48:50', 0, '0000-00-00 00:00:00');
INSERT INTO `tribe` VALUES (9, 'Bakonjo', '2007-11-15 11:45:54', 0, '0000-00-00 00:00:00');
INSERT INTO `tribe` VALUES (10, 'Bagishu', '2007-12-13 15:12:33', 0, '0000-00-00 00:00:00');
INSERT INTO `tribe` VALUES (11, 'Batooro', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00');
INSERT INTO `tribe` VALUES (12, 'Bakiga', '2008-03-17 11:58:22', 0, '0000-00-00 00:00:00');

-- --------------------------------------------------------

-- 
-- Table structure for table `uniform`
-- 

CREATE TABLE `uniform` (
  `id` bigint(20) NOT NULL auto_increment,
  `uniformtype` varchar(100) default NULL,
  `number` int(11) default NULL,
  `createdby` varchar(100) default NULL,
  `date_of_entry` datetime default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=76 DEFAULT CHARSET=latin1 AUTO_INCREMENT=76 ;

-- 
-- Dumping data for table `uniform`
-- 

INSERT INTO `uniform` VALUES (1, 'shirts_', 2, '1', '2008-02-08 11:33:27');
INSERT INTO `uniform` VALUES (2, 'trousers_', 2, '1', '2008-02-08 11:33:27');
INSERT INTO `uniform` VALUES (3, 'shoes_', 2, '1', '2008-02-08 11:33:27');
INSERT INTO `uniform` VALUES (4, 'shirts_', 2, '1', '2008-02-08 11:56:38');
INSERT INTO `uniform` VALUES (5, 'trousers_', 2, '1', '2008-02-08 11:56:38');
INSERT INTO `uniform` VALUES (6, 'sweaters_', 3, '1', '2008-02-08 11:56:38');
INSERT INTO `uniform` VALUES (7, 'shoes_', 4, '1', '2008-02-08 11:56:38');
INSERT INTO `uniform` VALUES (8, 'raincoats_', 2, '1', '2008-02-08 11:56:38');
INSERT INTO `uniform` VALUES (9, 'shirts_', 5, '1', '2008-02-08 11:57:52');
INSERT INTO `uniform` VALUES (10, 'sweaters_', 2, '1', '2008-02-08 11:57:52');
INSERT INTO `uniform` VALUES (11, 'shirts_', 1, '1', '2008-02-08 12:03:36');
INSERT INTO `uniform` VALUES (12, 'shirts_', 2, '1', '2008-02-08 12:04:16');
INSERT INTO `uniform` VALUES (13, 'trousers_', 2, '1', '2008-02-08 12:04:16');
INSERT INTO `uniform` VALUES (14, 'shoes_', 2, '1', '2008-02-08 12:04:16');
INSERT INTO `uniform` VALUES (15, 'shirts_', 3, '1', '2008-02-08 12:08:52');
INSERT INTO `uniform` VALUES (16, 'trousers_', 2, '1', '2008-02-08 12:08:52');
INSERT INTO `uniform` VALUES (17, 'sweaters_', 2, '1', '2008-02-08 12:08:52');
INSERT INTO `uniform` VALUES (18, 'shoes_', 3, '1', '2008-02-08 12:08:52');
INSERT INTO `uniform` VALUES (19, 'raincoats_', 5, '1', '2008-02-08 12:08:52');
INSERT INTO `uniform` VALUES (20, 'shoes_', 2, '1', '2008-02-11 10:33:22');
INSERT INTO `uniform` VALUES (21, 'shirts_', 2, '1', '2008-02-11 10:50:02');
INSERT INTO `uniform` VALUES (22, 'raincoats_', 2, '1', '2008-02-11 10:50:02');
INSERT INTO `uniform` VALUES (23, 'sweaters_', 0, '1', '2008-02-11 11:15:09');
INSERT INTO `uniform` VALUES (24, 'raincoats_', 4, '1', '2008-02-11 11:15:09');
INSERT INTO `uniform` VALUES (25, 'trousers_', 1, '1', '2008-02-11 11:58:43');
INSERT INTO `uniform` VALUES (26, 'shoes_', 1, '1', '2008-02-11 11:58:43');
INSERT INTO `uniform` VALUES (27, 'shirts_', 2, '1', '2008-02-12 17:44:11');
INSERT INTO `uniform` VALUES (28, 'trousers_', 2, '1', '2008-02-12 17:44:11');
INSERT INTO `uniform` VALUES (29, 'shoes_', 2, '1', '2008-02-12 17:44:11');
INSERT INTO `uniform` VALUES (30, 'sweaters_', 1, '1', '2008-02-13 13:39:37');
INSERT INTO `uniform` VALUES (31, 'raincoats_', 1, '1', '2008-02-13 13:39:37');
INSERT INTO `uniform` VALUES (32, 'sweaters_', 3, '1', '2008-03-19 07:19:10');
INSERT INTO `uniform` VALUES (33, 'shoes_', 1, '1', '2008-03-19 07:19:10');
INSERT INTO `uniform` VALUES (34, 'shirts_', 3, '1', '2008-04-01 09:37:08');
INSERT INTO `uniform` VALUES (35, 'shirts_', 2, '1', '2008-04-01 09:55:19');
INSERT INTO `uniform` VALUES (36, 'trousers_', 2, '1', '2008-04-01 09:55:19');
INSERT INTO `uniform` VALUES (37, 'sweaters_', 1, '1', '2008-04-01 09:55:19');
INSERT INTO `uniform` VALUES (38, 'shoes_', 2, '1', '2008-04-01 09:55:19');
INSERT INTO `uniform` VALUES (39, 'raincoats_', 1, '1', '2008-04-01 09:55:19');
INSERT INTO `uniform` VALUES (40, 'shirts_', 2, '1', '2008-04-01 10:11:11');
INSERT INTO `uniform` VALUES (41, 'trousers_', 2, '1', '2008-04-01 10:11:11');
INSERT INTO `uniform` VALUES (42, 'shoes_', 2, '1', '2008-04-01 10:11:11');
INSERT INTO `uniform` VALUES (43, 'raincoats_', 1, '1', '2008-04-01 10:11:11');
INSERT INTO `uniform` VALUES (44, 'shirts_', 2, '1', '2008-04-01 12:27:45');
INSERT INTO `uniform` VALUES (45, 'trousers_', 2, '1', '2008-04-01 12:27:45');
INSERT INTO `uniform` VALUES (46, 'shoes_', 2, '1', '2008-04-01 12:27:45');
INSERT INTO `uniform` VALUES (47, 'shirts_', 2, '1', '2008-04-01 13:04:08');
INSERT INTO `uniform` VALUES (48, 'trousers_', 2, '1', '2008-04-01 13:04:08');
INSERT INTO `uniform` VALUES (49, 'shoes_', 2, '1', '2008-04-01 13:04:08');
INSERT INTO `uniform` VALUES (50, 'shirts_', 1, '1', '2008-04-01 13:27:46');
INSERT INTO `uniform` VALUES (51, 'sweaters_', 1, '1', '2008-04-01 13:27:46');
INSERT INTO `uniform` VALUES (52, 'raincoats_', 1, '1', '2008-04-01 13:27:46');
INSERT INTO `uniform` VALUES (53, 'shirts_', 3, '1', '2008-04-07 17:38:41');
INSERT INTO `uniform` VALUES (54, 'trousers_', 2, '1', '2008-04-07 17:38:41');
INSERT INTO `uniform` VALUES (55, 'sweaters_', 2, '1', '2008-07-02 10:40:41');
INSERT INTO `uniform` VALUES (56, 'shoes_', 3, '1', '2008-07-02 10:40:42');
INSERT INTO `uniform` VALUES (57, 'belt_', 6, '1', '2008-07-02 11:10:55');
INSERT INTO `uniform` VALUES (58, 'trousers_', 8, '1', '2008-07-02 11:10:55');
INSERT INTO `uniform` VALUES (59, 'belt_', 4, '1', '2008-07-02 11:22:09');
INSERT INTO `uniform` VALUES (60, 'shoes_', 2, '1', '2008-07-02 11:22:09');
INSERT INTO `uniform` VALUES (61, 'belt_', 3, '1', '2008-07-02 11:25:09');
INSERT INTO `uniform` VALUES (62, 'shirts_', 9, '1', '2008-07-02 11:25:09');
INSERT INTO `uniform` VALUES (63, 'belt_', 5, '1', '2008-07-02 11:27:13');
INSERT INTO `uniform` VALUES (64, 'raincoat_', 4, '1', '2008-07-02 11:27:13');
INSERT INTO `uniform` VALUES (65, 'belt_', 5, '1', '2008-07-02 14:18:56');
INSERT INTO `uniform` VALUES (66, 'raincoat_', 4, '1', '2008-07-02 14:18:56');
INSERT INTO `uniform` VALUES (67, 'belt_', 5, '1', '2008-07-02 14:20:06');
INSERT INTO `uniform` VALUES (68, 'raincoat_', 4, '1', '2008-07-02 14:20:06');
INSERT INTO `uniform` VALUES (69, 'belt_', 1, '1', '2008-07-02 14:32:15');
INSERT INTO `uniform` VALUES (70, 'raincoat_', 4, '1', '2008-07-02 14:32:15');
INSERT INTO `uniform` VALUES (71, 'shoes_', 1, '1', '2008-07-02 15:20:37');
INSERT INTO `uniform` VALUES (72, 'sweaters_', 10, '1', '2008-07-02 15:22:17');
INSERT INTO `uniform` VALUES (73, 'shirts_', 1, '1', '2008-07-02 15:22:26');
INSERT INTO `uniform` VALUES (74, 'trousers_', 6, '1', '2008-07-02 15:22:38');
INSERT INTO `uniform` VALUES (75, 'shirts_', 1, '1', '2008-07-02 15:23:33');

-- --------------------------------------------------------

-- 
-- Table structure for table `uniformstate`
-- 

CREATE TABLE `uniformstate` (
  `id` bigint(20) NOT NULL auto_increment,
  `uniformstate` varchar(250) NOT NULL default '',
  `date_of_entry` datetime NOT NULL default '0000-00-00 00:00:00',
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

-- 
-- Dumping data for table `uniformstate`
-- 

INSERT INTO `uniformstate` VALUES (1, 'Old - Unusable', '2007-11-19 23:26:29');
INSERT INTO `uniformstate` VALUES (2, 'New', '2007-11-19 23:26:38');
INSERT INTO `uniformstate` VALUES (3, 'Old - Usable', '2007-11-19 23:27:03');
INSERT INTO `uniformstate` VALUES (4, 'Dirty - Permanently Stained', '2007-11-19 23:27:47');
INSERT INTO `uniformstate` VALUES (5, 'Not usable', '2007-11-20 08:53:16');
INSERT INTO `uniformstate` VALUES (6, 'Dirty - Washable', '2007-12-12 16:50:23');

-- --------------------------------------------------------

-- 
-- Table structure for table `users`
-- 

CREATE TABLE `users` (
  `id` bigint(20) NOT NULL auto_increment,
  `firstname` varchar(255) default NULL,
  `lastname` varchar(255) default NULL,
  `username` varchar(255) default NULL,
  `password` varchar(255) default NULL,
  `isactive` enum('N','Y') default 'N',
  `email` varchar(255) default NULL,
  `telephonenumber` varchar(255) default NULL,
  `favorites` text NOT NULL,
  `address` varchar(255) default NULL,
  `usergroup` varchar(100) NOT NULL default '',
  `datecreated` date default NULL,
  `createdby` bigint(20) default NULL,
  `lastupdatedby` bigint(20) default NULL,
  `lastupdatedate` timestamp NULL default NULL on update CURRENT_TIMESTAMP,
  PRIMARY KEY  (`id`),
  KEY `isactive` (`isactive`)
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=latin1 AUTO_INCREMENT=29 ;

-- 
-- Dumping data for table `users`
-- 

INSERT INTO `users` VALUES (1, 'System', 'Administrator', 'admin', 'd033e22ae348aeb5660fc2140aec35850c4da997', 'Y', 'sysadmin@smartguard.com', '1312312', '47,41,42,44,12,11,9,21,19,27,3,2,20,4,18,17', 'P.O.Box 64774', '1', '2007-09-20', 0, 1, '2008-09-10 12:26:56');
INSERT INTO `users` VALUES (6, 'Tony', 'Hawk', 'thawk', '9229e48225789074f8d3a320988d407484221e89', 'Y', 't.hawk@gmail.com', '230930233', '2,3', '15 Kampala avenue', '80', '2007-09-24', 0, 1, '2008-08-29 08:59:36');
INSERT INTO `users` VALUES (8, 'Philip', 'Kato', 'pkato', 'ad8b42881d7feaa8597ab5a9dbf7baf714c84125', 'Y', 'pkato@gmail.com', '213898', '26', 'p.o.box Kampala', '79', '2007-10-24', 1, 1, '2008-08-22 19:39:46');
INSERT INTO `users` VALUES (11, 'Johnson', 'Matsiko', 'mjohn', '6e69982bc616982c2f7be95fc82cd0e04fa61782', 'Y', 'mjohn@gmail.com', '343434', '', '34343', '84', '2007-10-24', 1, 1, '2008-07-03 16:11:04');
INSERT INTO `users` VALUES (12, 'Jose', 'Mary', 'mjose', '4a3487e57d90e2084654b6d23937e75af5c8ee55', 'Y', 'mjose@yahoo.co', '33244', '', '24334', '80', '2007-10-24', 1, 1, '2008-03-19 10:56:14');
INSERT INTO `users` VALUES (13, 'Richard', 'Juma', 'rjuma', '2f7a8690f488be852b94ce688211bcd7aba8d20c', 'Y', 'rjuma@yahoo.com', '0987654', '', 'p.o.box kampala', '81', '2007-10-24', 1, 1, '2008-08-20 16:17:23');
INSERT INTO `users` VALUES (15, 'david', 'kamugisha', 'kdavid', '54acf20443e787a4bea4114ac142642fb960fd65', 'Y', 'david@gmail.com', '0782204271', '', 'new wave technologies ltd', '', '2007-10-26', 1, NULL, NULL);
INSERT INTO `users` VALUES (16, 'Sam', 'Kalenzi', 'sam', 'f16bed56189e249fe4ca8ed10a1ecae60e8ceac0', 'Y', 'sampkal@gmail.com', '0712456789', '', 'kampala', '84', '2007-10-27', 1, 1, '2008-04-11 08:40:18');
INSERT INTO `users` VALUES (17, 'Dann', 'Muliika', 'dmulira', 'a79837ce13483f125608ca6365c98029ffb20050', 'Y', 'dmulira@yahoo.com', '07826806822', '', 'Kampala', '85', '2007-11-28', 1, 1, '2008-08-14 11:40:14');
INSERT INTO `users` VALUES (18, 'Israel', 'Kakooza', 'esmile', '8cb2237d0679ca88db6464eac60da96345513964', 'Y', 'esmile@yahoo.com', '0774616202', '2,40,39,47,41', 'P.o.bx 2312 Kampala', '81', '2008-01-09', 1, 1, '2008-08-27 15:45:43');
INSERT INTO `users` VALUES (19, 'Marion', 'Arina', 'marina', '1382244e1784be148fb78b24983c206ebc95928f', 'Y', 'marina@wbs-tv.com', '0752899320', '2,3', 'Plot 29 Spear House\r\nJinja Road\r\nP.O.Box. 32444\r\nKampala.', '82', '2008-01-16', 1, 1, '2008-04-02 16:31:58');
INSERT INTO `users` VALUES (20, 'JP', 'Nkeragasani', 'jpnkera', 'da39a3ee5e6b4b0d3255bfef95601890afd80709', 'Y', 'nkepeter@yahoo.com', '0782680682', '2,4,16,33,40,41,31,47,50,48', 'Bukoto, Kampala', '1', '2008-03-12', 1, 1, '2008-03-20 16:05:48');
INSERT INTO `users` VALUES (22, 'Chico', 'Sams', 'csams', '8cb2237d0679ca88db6464eac60da96345513964', 'Y', 'csams@yahoo.com', '087123443', '3,2,20,18,17', 'Tinton Falls\r\nPlot 30 Real Tech Rd', '84', '2008-03-19', 1, 1, '2008-08-28 13:05:52');
INSERT INTO `users` VALUES (23, 'Yusuf', 'Oooo', 'yusuf', '8cb2237d0679ca88db6464eac60da96345513964', 'Y', 'yopad@newwavetech.co.ug', '078388382', '28,39,42,44,43,45,46', 'dfdfd', '80', '2008-08-27', 1, NULL, '2008-08-27 15:58:17');
INSERT INTO `users` VALUES (24, 'Eisah', 'Mayanja', 'eisahm', 'cf3c9b220d3f050b9563fa5b420707350af1eb4b', 'Y', 'emayanja@gmail.com', '0414389220', '', 'Kampala', '87', '2012-05-29', 1, NULL, NULL);
INSERT INTO `users` VALUES (25, 'Test', 'Test', 'tiger', '46e3d772a1888eadff26c7ada47fd7502d796e07', 'Y', '', '', '', '', '80', '2012-05-29', 1, NULL, NULL);
INSERT INTO `users` VALUES (26, 'Martha', 'Tukahirwa', 'mtukahirwa', '8f0c7f4e2c890649199fc9ccca793f36ff033f8b', 'Y', '', '', '', 'Tiger Security', '1', '2012-06-18', 1, NULL, NULL);
INSERT INTO `users` VALUES (27, '', '', '', 'da39a3ee5e6b4b0d3255bfef95601890afd80709', '', '', '', '', '', '', '2012-08-17', 0, NULL, NULL);
INSERT INTO `users` VALUES (28, '', '', '', 'da39a3ee5e6b4b0d3255bfef95601890afd80709', '', '', '', '', '', '', '2012-10-13', 0, NULL, NULL);

-- --------------------------------------------------------

-- 
-- Table structure for table `vehicleinspections`
-- 

CREATE TABLE `vehicleinspections` (
  `id` bigint(20) NOT NULL auto_increment,
  `vehicleno` varchar(250) NOT NULL default '',
  `inspectiondate` varchar(250) NOT NULL default '',
  `commentids` text NOT NULL,
  `madeby` varchar(250) NOT NULL default '',
  `isactive` enum('Y','N') NOT NULL default 'Y',
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

-- 
-- Dumping data for table `vehicleinspections`
-- 

INSERT INTO `vehicleinspections` VALUES (3, 'UAB 875H', '2008-02-02', '91,90,84', 'Solomon Meyers', 'N');
INSERT INTO `vehicleinspections` VALUES (4, 'UAB 937Q', '2008-02-02', '85,84', 'Charles Meyers', 'Y');
INSERT INTO `vehicleinspections` VALUES (5, 'UAD 309H', '2008-03-01', '92', 'Felix peterson', 'Y');

-- --------------------------------------------------------

-- 
-- Table structure for table `vehicleservice`
-- 

CREATE TABLE `vehicleservice` (
  `id` bigint(20) NOT NULL auto_increment,
  `servicedate` date NOT NULL default '0000-00-00',
  `vehicleregno` varchar(50) NOT NULL default '',
  `partserviced` varchar(150) NOT NULL default '',
  `servicedone` text NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

-- 
-- Dumping data for table `vehicleservice`
-- 

INSERT INTO `vehicleservice` VALUES (1, '2008-01-30', 'UAA 874H', 'Engine', 'Replaced oil filter');
INSERT INTO `vehicleservice` VALUES (2, '2008-01-30', 'UAB 822D', 'Cabin', 'Repaired the cabin.');
INSERT INTO `vehicleservice` VALUES (3, '2008-02-01', 'UAH 334K', 'Bonnet', 'Removed the front bonnet and replaced it with another one.');
INSERT INTO `vehicleservice` VALUES (4, '2008-01-02', 'UAH 334K', 'Entire car', 'serviced the entire car');
INSERT INTO `vehicleservice` VALUES (5, '2008-01-03', 'UAD 309H', 'Injector Pumps', 'Removed the injector pumps and put new ones. They cost 230,000Shs');

-- --------------------------------------------------------

-- 
-- Table structure for table `verifications`
-- 

CREATE TABLE `verifications` (
  `id` bigint(20) NOT NULL auto_increment,
  `name` varchar(255) default NULL,
  `type` enum('Landlord','LC1','Decaration') default NULL,
  `physicaladdress` varchar(255) default NULL,
  `telephone` varchar(255) default NULL,
  `isapproved` enum('N','Y') default 'N',
  `dateapproved` date default NULL,
  `datesubmitted` date default NULL,
  `createdby` bigint(20) default NULL,
  `datecreated` date default NULL,
  `lastupdatedby` bigint(20) default NULL,
  `lastupdatedate` timestamp NULL default NULL on update CURRENT_TIMESTAMP,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- 
-- Dumping data for table `verifications`
-- 

