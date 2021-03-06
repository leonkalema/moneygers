-- phpMyAdmin SQL Dump
-- version 2.8.1
-- http://www.phpmyadmin.net
-- 
-- Host: localhost
-- Generation Time: Oct 15, 2007 at 09:03 AM
-- Server version: 5.0.22
-- PHP Version: 5.1.4
-- 
-- Database: `smartguard`
-- 

-- --------------------------------------------------------

-- 
-- Table structure for table `assignments`
-- 

DROP TABLE IF EXISTS `assignments`;
CREATE TABLE IF NOT EXISTS `assignments` (
  `id` bigint(20) NOT NULL auto_increment,
  `client` bigint(20) default NULL,
  `name` varchar(255) default NULL,
  `code` varchar(255) default NULL,
  `place` bigint(255) default NULL,
  `region` bigint(255) default NULL,
  `assignmenttype` enum('Alarm System','Shift') default NULL,
  `effectivedate` date default NULL,
  `starttime` varchar(255) default NULL,
  `endtime` varchar(255) default NULL,
  `enddate` date default NULL,
  `frequency` enum('Monthly','Weekly','Every Day') default 'Every Day',
  `daysofweek` varchar(255) default NULL,
  `daysofmonth` varchar(255) default NULL,
  `description` varchar(255) default NULL,
  `datecreated` date default NULL,
  `createdby` bigint(20) default NULL,
  `lastupdatedby` bigint(20) default NULL,
  `lastupdatedate` timestamp NULL default NULL on update CURRENT_TIMESTAMP,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='InnoDB free: 4096 kB; InnoDB free: 4096 kB; InnoDB free: 409' AUTO_INCREMENT=3 ;

-- 
-- Dumping data for table `assignments`
-- 

INSERT INTO `assignments` VALUES (1, 2, 'name', 'code', 0, NULL, '', '0000-00-00', '00:30:00', '00:30:00', '0000-00-00', 'Every Day', 'Sat,Sun,Mon,Tue,Wed,Thur,Fri', '01,02,03,04,05,06,07,08,09,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25,26,27,28,29,30,31', 'description', '2007-10-03', 1, NULL, NULL),
(2, 2, 'The name', 'code', 0, 8, 'Shift', '0000-00-00', '01:00:00', '08:00:00', '0000-00-00', 'Monthly', 'Sat,Sun', '01,02,04,05,06,08,09,10,11,12,15,16,19,20,23,25,26,29,30', 'The description', '2007-10-03', 1, 1, '2007-10-03 20:58:33');

-- --------------------------------------------------------

-- 
-- Table structure for table `children`
-- 

DROP TABLE IF EXISTS `children`;
CREATE TABLE IF NOT EXISTS `children` (
  `personid` bigint(20) NOT NULL,
  `guardid` bigint(20) NOT NULL default '0',
  `datecreated` date default NULL,
  `createdby` bigint(20) default NULL,
  PRIMARY KEY  (`personid`,`guardid`),
  KEY `userid` (`personid`),
  KEY `groupid` (`guardid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='InnoDB free: 4096 kB; InnoDB free: 4096 kB; InnoDB free: 409';

-- 
-- Dumping data for table `children`
-- 


-- --------------------------------------------------------

-- 
-- Table structure for table `clients`
-- 

DROP TABLE IF EXISTS `clients`;
CREATE TABLE IF NOT EXISTS `clients` (
  `id` bigint(20) NOT NULL auto_increment,
  `name` varchar(255) default NULL,
  `phone` varchar(255) default NULL,
  `email` varchar(255) default NULL,
  `address` varchar(255) default NULL,
  `billingtype` enum('Other','Money Order','Cash','Cheque') default 'Other',
  `bank` varchar(255) default NULL,
  `accountnumber` varchar(255) default NULL,
  `isactive` enum('N','Y') default 'N',
  `expirydate` date default NULL,
  `datecreated` date default NULL,
  `createdby` bigint(20) default NULL,
  `lastupdatedby` bigint(20) default NULL,
  `lastupdatedate` timestamp NULL default NULL on update CURRENT_TIMESTAMP,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='InnoDB free: 4096 kB; InnoDB free: 4096 kB; InnoDB free: 409' AUTO_INCREMENT=3 ;

-- 
-- Dumping data for table `clients`
-- 

INSERT INTO `clients` VALUES (1, 'name1', 'phone1', 'example1@example.com', 'address1', 'Cheque', 'bank1', 'accountnumber1', '', '2008-10-10', '2007-10-02', 1, 1, '2007-10-02 05:31:25'),
(2, 'Crane Bank', '10238123', 'test@testor.com', 'asd sdasd sadasd', 'Cash', 'Bank of Uganda', '02029229229', '', '0000-00-00', '2007-10-02', 1, 1, '2007-10-03 11:36:58');

-- --------------------------------------------------------

-- 
-- Table structure for table `documents`
-- 

DROP TABLE IF EXISTS `documents`;
CREATE TABLE IF NOT EXISTS `documents` (
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
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='InnoDB free: 4096 kB; InnoDB free: 4096 kB; InnoDB free: 409' AUTO_INCREMENT=23 ;

-- 
-- Dumping data for table `documents`
-- 

INSERT INTO `documents` VALUES (1, 0, '', '', '', '', 1, '2007-10-14', NULL, NULL),
(2, 0, '', '', '', '', 1, '2007-10-14', NULL, NULL),
(3, 0, '', '', '', '', 1, '2007-10-14', NULL, NULL),
(4, 0, '', '', '', '', 1, '2007-10-14', NULL, NULL),
(5, 0, '', '', '', '', 1, '2007-10-14', NULL, NULL),
(6, 0, '', '', '', '', 1, '2007-10-14', NULL, NULL),
(7, 0, '', '', '', '', 1, '2007-10-14', NULL, NULL),
(8, 0, '', '', '', '', 1, '2007-10-14', NULL, NULL),
(9, 0, '', '', '', '', 1, '2007-10-14', NULL, NULL),
(10, 0, '', '', '', '', 1, '2007-10-14', NULL, NULL),
(11, 0, '', '', '', '', 1, '2007-10-15', NULL, NULL),
(12, 0, '', '', '', '', 1, '2007-10-15', NULL, NULL),
(13, 0, '', '', '', '', 1, '2007-10-15', NULL, NULL),
(14, 0, '', '', '', '', 1, '2007-10-15', NULL, NULL),
(15, 0, '', '', '', '', 1, '2007-10-15', NULL, NULL),
(16, 0, '', '', '', '', 1, '2007-10-15', NULL, NULL),
(17, 0, '', '', '', '', 1, '2007-10-15', NULL, NULL),
(18, 0, '', '', '', '', 1, '2007-10-15', NULL, NULL),
(19, 0, '', '', '', '', 1, '2007-10-15', NULL, NULL),
(20, 0, '', '', '', '', 1, '2007-10-15', NULL, NULL),
(21, 0, '', '', '', '', 1, '2007-10-15', NULL, NULL),
(22, 0, '', '', '', '', 1, '2007-10-15', NULL, NULL);

-- --------------------------------------------------------

-- 
-- Table structure for table `groups`
-- 

DROP TABLE IF EXISTS `groups`;
CREATE TABLE IF NOT EXISTS `groups` (
  `id` bigint(20) NOT NULL auto_increment,
  `name` varchar(255) default NULL,
  `description` varchar(255) default NULL,
  `isactive` enum('N','Y') default 'N',
  `createdby` bigint(20) default NULL,
  `datecreated` date default NULL,
  `lastupdatedby` bigint(20) default NULL,
  `lastupdatedate` timestamp NULL default NULL on update CURRENT_TIMESTAMP,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='InnoDB free: 4096 kB; InnoDB free: 4096 kB; InnoDB free: 409' AUTO_INCREMENT=8 ;

-- 
-- Dumping data for table `groups`
-- 

INSERT INTO `groups` VALUES (1, 'Administrators', 'System Administrators', 'Y', 1, '2007-09-19', 1, '2007-09-24 23:14:52'),
(2, 'Operations Clerks', 'Operations Clerks', 'Y', 1, '2007-09-19', 1, '2007-09-24 23:14:54'),
(3, 'Inventory Clerks', 'Inventory Clerks', 'Y', 1, '2007-09-19', 1, '2007-09-24 23:14:56'),
(4, 'Finance Clerks', 'Finance Clerks', 'Y', 1, '2007-09-19', 1, '2007-09-24 23:14:59'),
(5, 'Janitors', 'Janitors', '', 0, '2007-09-24', 1, '2007-09-30 22:08:35'),
(6, 'Technicians', 'The Technicians', '', 0, '2007-09-24', 1, '2007-09-30 22:07:40'),
(7, 'Test Group', 'The utimate test', '', 0, '2007-09-30', 1, '2007-09-30 22:09:11');

-- --------------------------------------------------------

-- 
-- Table structure for table `guards`
-- 

DROP TABLE IF EXISTS `guards`;
CREATE TABLE IF NOT EXISTS `guards` (
  `id` bigint(20) NOT NULL auto_increment,
  `guardid` varchar(255) default NULL,
  `photographid` bigint(20) default NULL,
  `personid` bigint(20) NOT NULL,
  `fingerprintid` bigint(20) default NULL,
  `dateofemployment` date default NULL,
  `fatherid` bigint(20) default NULL,
  `motherid` bigint(20) default NULL,
  `spouseid` bigint(20) default NULL,
  `nextofkinid` bigint(20) default NULL,
  `beneficiaryid` bigint(20) default NULL,
  `lc1verificationid` bigint(20) default NULL,
  `landlordverificationid` bigint(20) default NULL,
  `declarationverificationid` bigint(20) default NULL,
  `datecreated` date default NULL,
  `createdby` bigint(20) default NULL,
  `lastupdatedby` bigint(20) default NULL,
  `lastupdatedate` timestamp NULL default NULL on update CURRENT_TIMESTAMP,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='InnoDB free: 4096 kB; InnoDB free: 3072 kB; InnoDB free: 307' AUTO_INCREMENT=19 ;

-- 
-- Dumping data for table `guards`
-- 

INSERT INTO `guards` VALUES (1, 'P0023', 0, 6, 0, '2007-05-23', 0, NULL, 0, 0, 0, 0, 0, 0, '2007-10-14', 1, 1, '2007-10-14 21:43:41'),
(2, 'P0035', 0, 7, 0, '2007-06-12', 0, NULL, 0, 0, 0, 0, 0, 0, '2007-10-14', 1, 1, '2007-10-14 21:43:47'),
(11, 'P0047', 19, 13, 0, '2007-04-10', 0, NULL, 0, 0, 0, 0, 0, 0, '2007-10-14', 1, 1, '2007-10-15 07:56:37'),
(16, 'guardid', 17, 0, 0, '1969-12-31', 0, NULL, 0, 0, 0, 0, 0, 0, '2007-10-15', 1, NULL, NULL),
(18, 'P0076', 22, 16, 0, '1969-12-31', 14, 15, 0, 0, 0, 0, 0, 0, '2007-10-15', 1, 1, '2007-10-15 08:57:18');

-- --------------------------------------------------------

-- 
-- Table structure for table `jobs`
-- 

DROP TABLE IF EXISTS `jobs`;
CREATE TABLE IF NOT EXISTS `jobs` (
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
-- Table structure for table `persons`
-- 

DROP TABLE IF EXISTS `persons`;
CREATE TABLE IF NOT EXISTS `persons` (
  `id` bigint(20) NOT NULL auto_increment,
  `firstname` varchar(255) default NULL,
  `lastname` varchar(255) default NULL,
  `othernames` varchar(255) default NULL,
  `birthlastname` varchar(255) default NULL,
  `nationality` varchar(255) default NULL,
  `tribe` varchar(255) default NULL,
  `dateofbirth` date default NULL,
  `placeofbirth` varchar(255) default NULL,
  `isalive` enum('N','Y') default 'Y',
  `occupation` varchar(255) default NULL,
  `employer` varchar(255) default NULL,
  `addressid` bigint(20) default NULL,
  `workplaceid` bigint(20) default NULL,
  `homeid` bigint(20) default NULL,
  `datecreated` bigint(20) default NULL,
  `createdby` bigint(20) default NULL,
  `lastupdatedby` bigint(20) default NULL,
  `lastupdatedate` timestamp NULL default NULL on update CURRENT_TIMESTAMP,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='InnoDB free: 4096 kB; InnoDB free: 3072 kB; InnoDB free: 307' AUTO_INCREMENT=17 ;

-- 
-- Dumping data for table `persons`
-- 

INSERT INTO `persons` VALUES (1, 'firstname', 'lastname', 'othernames', '', 'Uganda', 'tribe', '2006-07-03', 'placeofbirth', 'N', NULL, NULL, 3, 0, NULL, 2007, 0, NULL, '2007-10-14 21:44:39'),
(4, 'Jimmy', 'Oluchi', 'Oketcho', '', 'Uganda', 'Alur', '2005-09-25', 'Kalangala', 'N', NULL, NULL, 6, 0, NULL, 2007, 0, 1, '2007-10-14 21:44:59'),
(5, 'firstname', 'lastname', 'othernames', '', 'Uganda', 'tribe', '2007-01-10', 'placeofbirth', 'N', NULL, NULL, 11, 0, NULL, 2007, 1, NULL, NULL),
(6, 'Tom', 'Kato', 'othernames', '', 'Uganda', 'tribe', '2005-01-11', 'Lalalala', 'N', NULL, NULL, 12, 0, NULL, 2007, 1, 1, '2007-10-14 21:41:35'),
(7, 'John', 'Opio', 'Steven', '', 'Uganda', 'tribe', '2006-09-12', 'placeofbirth', 'N', NULL, NULL, 13, 0, NULL, 2007, 1, 1, '2007-10-14 21:44:21'),
(13, 'Johnson', 'Busingye', 'othernames', '', 'Uganda', 'Munyakore', '2006-08-09', 'Ruhanga', 'N', NULL, NULL, 19, 0, 0, 2007, 1, 1, '2007-10-15 07:56:37'),
(14, 'father_firstname', 'father_firstname', 'father_othernames', '', '', '', NULL, '', 'Y', 'father_occupation', 'father_employer', 32, 0, 0, 2007, 1, 0, '2007-10-15 09:01:04'),
(15, 'mother_firstname', 'mother_lastname', 'mother_othernames', '', '', '', NULL, '', 'N', 'mother_occupation', 'mother_employer', 33, 0, 0, 2007, 1, 0, '2007-10-15 09:01:07'),
(16, 'Maria', 'Atubo', 'Esther', '', 'Uganda', 'tribe', '1969-12-31', 'Nakapiripit', 'N', '', '', 30, 0, 31, 2007, 1, 1, '2007-10-15 08:57:18');

-- --------------------------------------------------------

-- 
-- Table structure for table `places`
-- 

DROP TABLE IF EXISTS `places`;
CREATE TABLE IF NOT EXISTS `places` (
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
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='InnoDB free: 4096 kB; InnoDB free: 4096 kB; InnoDB free: 409' AUTO_INCREMENT=34 ;

-- 
-- Dumping data for table `places`
-- 

INSERT INTO `places` VALUES (1, '', '', '', 'subcounty', 'county', 'district', 'town', 'parish', '', '', '', '', '', 0, '2007-10-14', NULL, NULL),
(2, '', '', '', 'subcounty', 'county', 'district', 'town', 'parish', '', '', '', '', '', 0, '2007-10-14', NULL, NULL),
(3, '', '', '', 'subcounty', 'county', 'district', 'town', 'parish', '', '', '', '', '', 0, '2007-10-14', NULL, NULL),
(6, '', '', '', 'asdsdas', 'sadsdsdsda', 'Kalangala', 'Kalangala', 'dasdasd', '', '', '', '', '', 0, '2007-10-14', 1, '2007-10-14 21:10:32'),
(7, '', '', '', 'Yumbe Subcounty', 'Yumbe County', 'Yumbe', 'Yumbe Town', 'Yumbe Parish', '', '', '', '', '', 1, '2007-10-14', NULL, NULL),
(8, '', '', '', 'subcounty', 'county', 'district', 'town', 'parish', '', '', '', '', '', 1, '2007-10-14', NULL, NULL),
(9, '', '', '', 'subcounty', 'county', 'district', 'town', 'parish', '', '', '', '', '', 1, '2007-10-14', NULL, NULL),
(10, '', '', '', 'subcounty', 'county', 'district', 'town', 'parish', '', '', '', '', '', 1, '2007-10-14', NULL, NULL),
(11, '', '', '', 'subcounty', 'county', 'district', 'town', 'parish', '', '', '', '', '', 1, '2007-10-14', NULL, NULL),
(12, '', '', '', 'subcounty', 'county', 'kotido', 'town', 'parish', '', '', '', '', '', 1, '2007-10-14', 1, '2007-10-14 21:16:14'),
(13, '', '', '', 'subcounty', 'county', 'district', 'town', 'parish', '', '', '', '', '', 1, '2007-10-14', 1, '2007-10-14 21:35:49'),
(19, '', '', 'Kampala', 'dsdfd', 'county', 'Kampala', 'town', 'parish', '2321 Kampala Rd', 'John Mulwanya', '123002131', 'Emily Opio', '0129391231', 1, '2007-10-14', 1, '2007-10-15 07:56:37'),
(24, '', '', 'village', 'subcounty', 'county', 'district', 'town', 'parish', 'plotnumber', 'lc1chairman', 'lc1telephone', 'lc2chairman', 'lc2telephone', 1, '2007-10-15', NULL, NULL),
(25, '', '', 'home_village', 'home_subcounty', 'home_county', 'home_district', 'home_town', '', 'home_plotnumber', 'home_lc1chairman', 'home_lc1telephone', 'home_lc2chairman', 'home_lc2telephone', 0, '2007-10-15', NULL, NULL),
(28, '', '', 'village', 'subcounty', 'county', 'district', 'town', 'parish', 'plotnumber', 'lc1chairman', 'lc1telephone', 'lc2chairman', 'lc2telephone', 1, '2007-10-15', NULL, NULL),
(29, '', '', 'home_village', 'home_subcounty', 'home_county', 'home_district', 'home_town', '', 'home_plotnumber', 'home_lc1chairman', 'home_lc1telephone', 'home_lc2chairman', 'home_lc2telephone', 1, '2007-10-15', NULL, NULL),
(30, '', '', 'village', 'subcounty', 'county', 'district', 'town', 'parish', 'plotnumber', 'lc1chairman', 'lc1telephone', 'lc2chairman', 'lc2telephone', 1, '2007-10-15', 1, '2007-10-15 08:57:17'),
(31, '', '', 'home_village', 'home_subcounty', 'home_county', 'home_district', 'home_town', '', 'home_plotnumber', 'home_lc1chairman', 'home_lc1telephone', 'home_lc2chairman', 'home_lc2telephone', 1, '2007-10-15', 0, '2007-10-15 08:57:18'),
(32, '', 'father_telephone', 'father_village', 'father_subcounty', 'father_county', '', '', '', '', '', '', '', '', 1, '2007-10-15', 0, '2007-10-15 08:57:17'),
(33, '', 'mother_telephone', 'mother_village', 'mother_subcounty', 'mother_county', '', '', '', '', '', '', '', '', 1, '2007-10-15', 0, '2007-10-15 08:57:17');

-- --------------------------------------------------------

-- 
-- Table structure for table `referees`
-- 

DROP TABLE IF EXISTS `referees`;
CREATE TABLE IF NOT EXISTS `referees` (
  `personid` bigint(20) NOT NULL,
  `guardid` bigint(20) NOT NULL default '0',
  `datecreated` date default NULL,
  `createdby` bigint(20) default NULL,
  PRIMARY KEY  (`personid`,`guardid`),
  KEY `userid` (`personid`),
  KEY `groupid` (`guardid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='InnoDB free: 4096 kB; InnoDB free: 4096 kB; InnoDB free: 409';

-- 
-- Dumping data for table `referees`
-- 


-- --------------------------------------------------------

-- 
-- Table structure for table `regions`
-- 

DROP TABLE IF EXISTS `regions`;
CREATE TABLE IF NOT EXISTS `regions` (
  `id` bigint(20) NOT NULL auto_increment,
  `name` varchar(255) default NULL,
  `description` varchar(255) default NULL,
  `code` varchar(255) default 'N',
  `createdby` bigint(20) default NULL,
  `datecreated` date default NULL,
  `lastupdatedby` bigint(20) default NULL,
  `lastupdatedate` timestamp NULL default NULL on update CURRENT_TIMESTAMP,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='InnoDB free: 4096 kB; InnoDB free: 4096 kB; InnoDB free: 409' AUTO_INCREMENT=9 ;

-- 
-- Dumping data for table `regions`
-- 

INSERT INTO `regions` VALUES (7, 'Kololo', 'Kololo Region', 'KR', 1, '2007-09-30', 1, '2007-09-30 22:28:34'),
(8, 'Ntinda', 'Ntinda Area', 'NA', 1, '2007-09-30', NULL, NULL);

-- --------------------------------------------------------

-- 
-- Table structure for table `schools`
-- 

DROP TABLE IF EXISTS `schools`;
CREATE TABLE IF NOT EXISTS `schools` (
  `id` bigint(20) NOT NULL auto_increment,
  `guardid` varchar(255) default NULL,
  `schoolname` varchar(255) default NULL,
  `level` enum('Primary','Tertiary Institution','Ordinary Level','Advanced Level','Other') default NULL,
  `yearjoined` varchar(255) default NULL,
  `yearleft` varchar(255) default NULL,
  `createdby` bigint(20) default NULL,
  `datecreated` date default NULL,
  `lastupdatedby` bigint(20) default NULL,
  `lastupdatedate` timestamp NULL default NULL on update CURRENT_TIMESTAMP,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='InnoDB free: 4096 kB; InnoDB free: 4096 kB; InnoDB free: 409' AUTO_INCREMENT=1 ;

-- 
-- Dumping data for table `schools`
-- 


-- --------------------------------------------------------

-- 
-- Table structure for table `usergroups`
-- 

DROP TABLE IF EXISTS `usergroups`;
CREATE TABLE IF NOT EXISTS `usergroups` (
  `userid` bigint(20) NOT NULL,
  `groupid` bigint(20) NOT NULL default '0',
  `datecreated` date default NULL,
  `createdby` bigint(20) default NULL,
  PRIMARY KEY  (`userid`,`groupid`),
  KEY `userid` (`userid`),
  KEY `groupid` (`groupid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='InnoDB free: 4096 kB; InnoDB free: 4096 kB; InnoDB free: 409';

-- 
-- Dumping data for table `usergroups`
-- 

INSERT INTO `usergroups` VALUES (1, 1, '2007-09-30', NULL),
(1, 4, '2007-09-30', NULL),
(3, 1, '2007-09-20', NULL),
(4, 1, '2007-09-20', NULL),
(5, 1, '2007-09-30', NULL),
(5, 2, '2007-09-30', NULL),
(5, 3, '2007-09-30', NULL),
(5, 4, '2007-09-30', NULL),
(6, 1, '2007-09-24', NULL),
(6, 4, '2007-09-24', NULL);

-- --------------------------------------------------------

-- 
-- Table structure for table `users`
-- 

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` bigint(20) NOT NULL auto_increment,
  `firstname` varchar(255) default NULL,
  `lastname` varchar(255) default NULL,
  `username` varchar(255) default NULL,
  `password` varchar(255) default NULL,
  `isactive` enum('N','Y') default 'N',
  `email` varchar(255) default NULL,
  `telephonenumber` varchar(255) default NULL,
  `address` varchar(255) default NULL,
  `datecreated` date default NULL,
  `createdby` bigint(20) default NULL,
  `lastupdatedby` bigint(20) default NULL,
  `lastupdatedate` timestamp NULL default NULL on update CURRENT_TIMESTAMP,
  PRIMARY KEY  (`id`),
  KEY `isactive` (`isactive`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='InnoDB free: 4096 kB; InnoDB free: 4096 kB; InnoDB free: 409' AUTO_INCREMENT=7 ;

-- 
-- Dumping data for table `users`
-- 

INSERT INTO `users` VALUES (1, 'System', 'Administrator', 'admin', 'd033e22ae348aeb5660fc2140aec35850c4da997', 'Y', 'sysadmin@smartguard.com', '1312312', 'sasd asdasdsd asdsa', '2007-09-20', 0, 0, '2007-09-30 03:39:01'),
(5, 'User', 'Sample', 'testuser1', 'password', 'Y', 'testor@testing.com', '23112325', 'asdasd asdast', '2007-09-20', 0, 0, '2007-09-30 21:46:22'),
(6, 'Tony', 'Hawk', 'thawk', 'thawk', 'Y', 't.hawk@gmail.com', '230930233', '15 Kampala avenue', '2007-09-24', 0, NULL, NULL);

-- --------------------------------------------------------

-- 
-- Table structure for table `verifications`
-- 

DROP TABLE IF EXISTS `verifications`;
CREATE TABLE IF NOT EXISTS `verifications` (
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
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='InnoDB free: 4096 kB; InnoDB free: 4096 kB; InnoDB free: 409' AUTO_INCREMENT=1 ;

-- 
-- Dumping data for table `verifications`
-- 

