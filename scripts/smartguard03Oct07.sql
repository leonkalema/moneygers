-- phpMyAdmin SQL Dump
-- version 2.8.1
-- http://www.phpmyadmin.net
-- 
-- Host: localhost
-- Generation Time: Oct 03, 2007 at 09:03 PM
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
CREATE TABLE `assignments` (
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
-- Table structure for table `clients`
-- 

DROP TABLE IF EXISTS `clients`;
CREATE TABLE `clients` (
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
-- Table structure for table `groups`
-- 

DROP TABLE IF EXISTS `groups`;
CREATE TABLE `groups` (
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
-- Table structure for table `regions`
-- 

DROP TABLE IF EXISTS `regions`;
CREATE TABLE `regions` (
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
-- Table structure for table `usergroups`
-- 

DROP TABLE IF EXISTS `usergroups`;
CREATE TABLE `usergroups` (
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
CREATE TABLE `users` (
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
