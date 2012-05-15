-- phpMyAdmin SQL Dump
-- version 3.5.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: May 15, 2012 at 03:14 PM
-- Server version: 5.1.61
-- PHP Version: 5.3.10

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `instance`
--

-- --------------------------------------------------------

--
-- Table structure for table `blocks`
--

CREATE TABLE IF NOT EXISTS `blocks` (
  `bid` int(11) NOT NULL AUTO_INCREMENT,
  `ref` varchar(264) NOT NULL,
  `title` varchar(264) NOT NULL,
  `nid` int(11) NOT NULL,
  PRIMARY KEY (`bid`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

-- --------------------------------------------------------

--
-- Table structure for table `content_albums`
--

CREATE TABLE IF NOT EXISTS `content_albums` (
  `cid` int(11) NOT NULL AUTO_INCREMENT,
  `description` tinytext NOT NULL,
  PRIMARY KEY (`cid`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

-- --------------------------------------------------------

--
-- Table structure for table `content_albums_items`
--

CREATE TABLE IF NOT EXISTS `content_albums_items` (
  `cid` int(11) NOT NULL AUTO_INCREMENT,
  `parent_cid` int(11) NOT NULL,
  `src` varchar(360) NOT NULL,
  `title` varchar(250) NOT NULL,
  PRIMARY KEY (`cid`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

-- --------------------------------------------------------

--
-- Table structure for table `content_lists`
--

CREATE TABLE IF NOT EXISTS `content_lists` (
  `cid` int(11) NOT NULL AUTO_INCREMENT,
  `sid` int(11) NOT NULL,
  PRIMARY KEY (`cid`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

-- --------------------------------------------------------

--
-- Table structure for table `content_menus`
--

CREATE TABLE IF NOT EXISTS `content_menus` (
  `cid` int(11) NOT NULL AUTO_INCREMENT,
  `query` varchar(264) NOT NULL,
  `class` varchar(24) NOT NULL,
  `sid` int(11) NOT NULL,
  PRIMARY KEY (`cid`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

-- --------------------------------------------------------

--
-- Table structure for table `content_pages`
--

CREATE TABLE IF NOT EXISTS `content_pages` (
  `cid` int(11) NOT NULL AUTO_INCREMENT,
  `teaser` mediumtext NOT NULL,
  `body` longtext NOT NULL,
  `attached_bid` int(11) NOT NULL,
  PRIMARY KEY (`cid`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=18 ;

-- --------------------------------------------------------

--
-- Table structure for table `content_statics`
--

CREATE TABLE IF NOT EXISTS `content_statics` (
  `cid` int(11) NOT NULL AUTO_INCREMENT,
  `addon` varchar(24) NOT NULL,
  `ref` varchar(260) NOT NULL,
  PRIMARY KEY (`cid`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

-- --------------------------------------------------------

--
-- Table structure for table `nodes`
--

CREATE TABLE IF NOT EXISTS `nodes` (
  `nid` int(11) NOT NULL AUTO_INCREMENT,
  `ref` varchar(64) NOT NULL,
  `title` varchar(300) NOT NULL,
  `content_type` varchar(36) NOT NULL,
  `content_ref` int(11) NOT NULL,
  `layout` varchar(36) NOT NULL,
  PRIMARY KEY (`nid`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=46 ;

-- --------------------------------------------------------

--
-- Table structure for table `nodeselectors`
--

CREATE TABLE IF NOT EXISTS `nodeselectors` (
  `sid` int(11) NOT NULL AUTO_INCREMENT,
  `parent_sid` int(11) DEFAULT NULL,
  `name` varchar(36) NOT NULL,
  `list_type` varchar(24) NOT NULL COMMENT 'flat or multi',
  `content_type` varchar(36) NOT NULL DEFAULT '%',
  `nid` varchar(36) NOT NULL DEFAULT '%',
  `ref` varchar(36) NOT NULL DEFAULT '%',
  `node_query` mediumtext NOT NULL,
  `content_query` mediumtext NOT NULL,
  PRIMARY KEY (`sid`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
