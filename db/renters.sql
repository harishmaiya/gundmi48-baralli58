-- phpMyAdmin SQL Dump
-- version 3.5.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Oct 24, 2016 at 12:07 PM
-- Server version: 5.5.24-log
-- PHP Version: 5.3.13

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `1renters-ins`
--

-- --------------------------------------------------------

--
-- Table structure for table `bookings`
--

CREATE TABLE IF NOT EXISTS `bookings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_item` int(20) NOT NULL DEFAULT '0',
  `the_date` date NOT NULL DEFAULT '0000-00-00',
  `id_state` int(11) NOT NULL DEFAULT '0',
  `id_booking` int(10) NOT NULL DEFAULT '0',
  `PropId` varchar(255) NOT NULL,
  `price` float(10,2) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_item` (`id_item`),
  KEY `id_state` (`id_state`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `bookings_admin_users`
--

CREATE TABLE IF NOT EXISTS `bookings_admin_users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `level` tinyint(1) NOT NULL DEFAULT '2',
  `username` varchar(20) NOT NULL DEFAULT '',
  `password` varchar(32) NOT NULL DEFAULT '',
  `state` tinyint(1) NOT NULL DEFAULT '1',
  `date_visit` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `visits` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `bookings_admin_users`
--

INSERT INTO `bookings_admin_users` (`id`, `level`, `username`, `password`, `state`, `date_visit`, `visits`) VALUES
(1, 1, 'admin', 'fe01ce2a7fbac8fafaed7c982a04e229', 1, '2014-01-03 16:23:49', 2);

-- --------------------------------------------------------

--
-- Table structure for table `bookings_config`
--

CREATE TABLE IF NOT EXISTS `bookings_config` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL DEFAULT '',
  `num_months` tinyint(3) NOT NULL DEFAULT '3',
  `default_lang` varchar(6) NOT NULL DEFAULT 'en',
  `theme` varchar(50) NOT NULL DEFAULT 'default',
  `start_day` enum('mon','sun') NOT NULL DEFAULT 'sun',
  `date_format` enum('us','eu') NOT NULL DEFAULT 'eu',
  `click_past_dates` enum('on','off') NOT NULL DEFAULT 'off',
  `cal_url` varchar(255) NOT NULL DEFAULT '',
  `local_path` varchar(255) NOT NULL DEFAULT '/calendar',
  `version` varchar(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `bookings_config`
--

INSERT INTO `bookings_config` (`id`, `title`, `num_months`, `default_lang`, `theme`, `start_day`, `date_format`, `click_past_dates`, `cal_url`, `local_path`, `version`) VALUES
(1, 'Availability Calendar', 6, 'en', 'default', 'sun', 'eu', 'off', '', '/calendar', 'v3.03.07');

-- --------------------------------------------------------

--
-- Table structure for table `bookings_items`
--

CREATE TABLE IF NOT EXISTS `bookings_items` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_user` int(11) NOT NULL DEFAULT '1',
  `id_ref_external` int(11) NOT NULL COMMENT 'link to external db table',
  `desc_en` varchar(100) NOT NULL DEFAULT '',
  `desc_es` varchar(100) NOT NULL DEFAULT '',
  `list_order` int(11) NOT NULL DEFAULT '0',
  `state` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `id_user` (`id_user`),
  KEY `id_ref_external` (`id_ref_external`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `bookings_items`
--

INSERT INTO `bookings_items` (`id`, `id_user`, `id_ref_external`, `desc_en`, `desc_es`, `list_order`, `state`) VALUES
(1, 1, 0, 'Demo Item', 'Demo', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `bookings_last_update`
--

CREATE TABLE IF NOT EXISTS `bookings_last_update` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `id_item` int(10) NOT NULL DEFAULT '0',
  `date_mod` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  KEY `id_item` (`id_item`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `bookings_last_update`
--

INSERT INTO `bookings_last_update` (`id`, `id_item`, `date_mod`) VALUES
(1, 1, '2014-01-21 10:38:03');

-- --------------------------------------------------------

--
-- Table structure for table `bookings_states`
--

CREATE TABLE IF NOT EXISTS `bookings_states` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `desc_en` varchar(100) NOT NULL DEFAULT '',
  `desc_es` varchar(100) NOT NULL DEFAULT '',
  `code` varchar(10) NOT NULL DEFAULT '',
  `state` tinyint(1) NOT NULL DEFAULT '1',
  `list_order` int(11) NOT NULL DEFAULT '0',
  `class` varchar(30) NOT NULL DEFAULT '',
  `show_in_key` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `bookings_states`
--

INSERT INTO `bookings_states` (`id`, `desc_en`, `desc_es`, `code`, `state`, `list_order`, `class`, `show_in_key`) VALUES
(1, 'Booked', 'Reservado', 'b', 1, 0, 'booked', 1),
(4, 'Unavailable', 'Unavailable', 'pr', 1, 3, 'booked_pr', 1);

-- --------------------------------------------------------

--
-- Table structure for table `ci_sessions`
--

CREATE TABLE IF NOT EXISTS `ci_sessions` (
  `session_id` varchar(40) NOT NULL DEFAULT '0',
  `ip_address` varchar(45) NOT NULL DEFAULT '0',
  `user_agent` varchar(120) NOT NULL,
  `last_activity` int(10) unsigned NOT NULL DEFAULT '0',
  `user_data` text NOT NULL,
  PRIMARY KEY (`session_id`),
  KEY `last_activity_idx` (`last_activity`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `contactus`
--

CREATE TABLE IF NOT EXISTS `contactus` (
  `id` int(20) NOT NULL AUTO_INCREMENT,
  `name` varchar(250) NOT NULL,
  `email` varchar(250) NOT NULL,
  `subject` varchar(250) NOT NULL,
  `message` text NOT NULL,
  `security_code` varchar(20) NOT NULL,
  `dateAdded` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `contactus`
--

INSERT INTO `contactus` (`id`, `name`, `email`, `subject`, `message`, `security_code`, `dateAdded`) VALUES
(1, 'dsfsd', 'fsdfsd@resf', 'sdfsdf', 'sdf', '', '2016-05-30 17:17:24');

-- --------------------------------------------------------

--
-- Table structure for table `country_code`
--

CREATE TABLE IF NOT EXISTS `country_code` (
  `Country` varchar(80) NOT NULL,
  `Code` varchar(80) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `fc_admin`
--

CREATE TABLE IF NOT EXISTS `fc_admin` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `created` date NOT NULL,
  `modified` date NOT NULL,
  `admin_name` varchar(24) NOT NULL,
  `admin_password` varchar(500) NOT NULL,
  `email` varchar(5000) NOT NULL,
  `dropbox_email` varchar(500) NOT NULL,
  `dropbox_password` varchar(500) NOT NULL,
  `admin_type` enum('super','sub') NOT NULL DEFAULT 'super',
  `privileges` text NOT NULL,
  `last_login_date` datetime NOT NULL,
  `last_logout_date` datetime NOT NULL,
  `last_login_ip` varchar(16) NOT NULL,
  `is_verified` enum('No','Yes') NOT NULL,
  `site_pagination_per_page` int(20) NOT NULL,
  `status` enum('Active','Inactive') NOT NULL DEFAULT 'Active',
  `twilio_account_sid` varchar(1000) NOT NULL,
  `twilio_account_token` varchar(1000) NOT NULL,
  `twilio_phone_number` varchar(1000) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `fc_admin`
--

INSERT INTO `fc_admin` (`id`, `created`, `modified`, `admin_name`, `admin_password`, `email`, `dropbox_email`, `dropbox_password`, `admin_type`, `privileges`, `last_login_date`, `last_logout_date`, `last_login_ip`, `is_verified`, `site_pagination_per_page`, `status`, `twilio_account_sid`, `twilio_account_token`, `twilio_phone_number`) VALUES
(1, '2016-02-11', '2016-10-24', 'admin', '21232f297a57a5a743894a0e4a801fc3', 'muthukrishnan@teamtweaks.com', '', '', 'super', '', '2016-10-24 05:16:29', '2016-09-19 07:39:01', '192.168.1.52', 'Yes', 20, 'Active', '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `fc_admin_settings`
--

CREATE TABLE IF NOT EXISTS `fc_admin_settings` (
  `id` int(200) NOT NULL AUTO_INCREMENT,
  `dropbox_email` varchar(500) NOT NULL,
  `dropbox_password` varchar(500) NOT NULL,
  `site_contact_mail` varchar(200) NOT NULL,
  `site_contact_number` varchar(50) NOT NULL,
  `email_title` varchar(400) NOT NULL,
  `google_verification` varchar(500) NOT NULL,
  `google_verification_code` longtext NOT NULL,
  `google_redirect_url_db` varchar(120) NOT NULL,
  `facebook_link` varchar(200) NOT NULL,
  `twitter_link` varchar(100) NOT NULL,
  `tumblr_link` text NOT NULL,
  `instagram_link` text NOT NULL,
  `snapchat_link` text NOT NULL,
  `pinterest` varchar(500) NOT NULL,
  `googleplus_link` varchar(100) NOT NULL,
  `linkedin_link` varchar(500) NOT NULL,
  `rss_link` varchar(500) NOT NULL,
  `youtube_link` varchar(500) NOT NULL,
  `footer_content` varchar(255) NOT NULL,
  `logo_image` varchar(255) NOT NULL,
  `home_logo_image` varchar(255) NOT NULL,
  `background_image` varchar(255) NOT NULL,
  `under_construction_image` varchar(255) NOT NULL,
  `videoUrl` varchar(200) NOT NULL,
  `currency_type` varchar(20) NOT NULL,
  `slider` enum('on','off') NOT NULL DEFAULT 'off',
  `meta_title` varchar(100) NOT NULL,
  `meta_keyword` varchar(150) NOT NULL,
  `meta_description` mediumtext NOT NULL,
  `fevicon_image` varchar(255) NOT NULL,
  `watermark` varchar(255) NOT NULL,
  `facebook_api` varchar(100) NOT NULL,
  `facebook_secret_key` varchar(100) NOT NULL,
  `paypal_api_name` varchar(100) NOT NULL,
  `paypal_api_pw` varchar(100) NOT NULL,
  `paypal_api_key` varchar(100) NOT NULL,
  `authorize_net_key` varchar(100) NOT NULL,
  `paypal_id` varchar(500) NOT NULL,
  `paypal_live` enum('1','2') NOT NULL,
  `smtp_port` int(200) NOT NULL,
  `smtp_uname` varchar(200) NOT NULL,
  `smtp_password` varchar(200) NOT NULL,
  `consumer_key` varchar(500) NOT NULL,
  `consumer_secret` varchar(500) NOT NULL,
  `google_client_secret` varchar(500) NOT NULL,
  `google_client_id` varchar(500) NOT NULL,
  `google_redirect_url` varchar(500) NOT NULL,
  `google_redirect_url_connect` varchar(100) NOT NULL,
  `google_developer_key` varchar(500) NOT NULL,
  `linkedin_app_id` varchar(50) NOT NULL,
  `linkedin_app_id1` varchar(120) NOT NULL,
  `linkedin_app_key1` varchar(80) NOT NULL,
  `linkedin_app_key` varchar(50) NOT NULL,
  `facebook_app_id` text NOT NULL,
  `facebook_app_secret` text NOT NULL,
  `like_text` mediumtext NOT NULL,
  `unlike_text` mediumtext NOT NULL,
  `liked_text` mediumtext NOT NULL,
  `banner_text` varchar(1000) NOT NULL,
  `site_pagination_per_page` int(20) NOT NULL,
  `twilio_account_sid` varchar(1000) NOT NULL,
  `twilio_account_token` varchar(1000) NOT NULL,
  `twilio_phone_number` varchar(1000) NOT NULL,
  `google_map_api` text NOT NULL,
  `home_title_1` varchar(250) NOT NULL,
  `home_title_2` varchar(250) NOT NULL,
  `home_title_3` varchar(200) NOT NULL,
  `home_title_4` varchar(200) NOT NULL,
  `s3_bucket_name` varchar(130) NOT NULL,
  `s3_access_key` varchar(132) NOT NULL,
  `s3_secret_key` varchar(250) NOT NULL,
  `instagram` varchar(255) NOT NULL,
  `on_off` ENUM('on','off') NOT NULL DEFAULT 'on' ,
  `ios_link` varchar(250) NOT NULL,
  `android_link` varchar(250) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `fc_admin_settings`
--

INSERT INTO `fc_admin_settings` (`id`, `dropbox_email`, `dropbox_password`, `site_contact_mail`, `site_contact_number`, `email_title`, `google_verification`, `google_verification_code`, `google_redirect_url_db`, `facebook_link`, `twitter_link`, `tumblr_link`, `instagram_link`, `snapchat_link`, `pinterest`, `googleplus_link`, `linkedin_link`, `rss_link`, `youtube_link`, `footer_content`, `logo_image`, `home_logo_image`, `background_image`, `under_construction_image`, `videoUrl`, `currency_type`, `slider`, `meta_title`, `meta_keyword`, `meta_description`, `fevicon_image`, `watermark`, `facebook_api`, `facebook_secret_key`, `paypal_api_name`, `paypal_api_pw`, `paypal_api_key`, `authorize_net_key`, `paypal_id`, `paypal_live`, `smtp_port`, `smtp_uname`, `smtp_password`, `consumer_key`, `consumer_secret`, `google_client_secret`, `google_client_id`, `google_redirect_url`, `google_redirect_url_connect`, `google_developer_key`, `linkedin_app_id`, `linkedin_app_id1`, `linkedin_app_key1`, `linkedin_app_key`, `facebook_app_id`, `facebook_app_secret`, `like_text`, `unlike_text`, `liked_text`, `banner_text`, `site_pagination_per_page`, `twilio_account_sid`, `twilio_account_token`, `twilio_phone_number`, `google_map_api`, `home_title_1`, `home_title_2`, `home_title_3`, `home_title_4`, `s3_bucket_name`, `s3_access_key`, `s3_secret_key`, `instagram`) VALUES
(1, '', '', 'muthukrishnan@gmail.com', '', 'Beetrut', '', '', '', 'https://fb.com', 'https://twitter.com', '', '', '', 'https://in.pinterest.com/', 'https://google.com', '', '', 'https://youtube.com', 'Copyright 2016. Beetrut. All rights reserved.', 'admin_logo.png', 'renters-landing-logo.png', 'bg.jpg', 'coming-soon.jpg', 'https://www.youtube.com/embed/TmDKbUrSYxQ', 'USD', 'on', 'Beetrut', 'Beetrut', 'Beetrut', 'favicon.png', 'favicon.png', '', '', '', '', '', '', '', '', 0, '', '', '', '', 'Vs3K8gdo_KwCoVVhkT4j38cv', '664360393494-62f9726trsh73ggkdfgbbrkdmlb1516u.apps.googleusercontent.com', '', '', 'AIzaSyCgA3-jFEYPX8S1WAK_ASubjxrq8lEEMws', '', '', '', '', '', '', 'Like', 'Unlike', 'Like''d', '', 20, '', '', '', 'AIzaSyCgA3-jFEYPX8S1WAK_ASubjxrq8lEEMws', '', '', '', '', '', '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `fc_attribute`
--

CREATE TABLE IF NOT EXISTS `fc_attribute` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `attribute_name` varchar(500) NOT NULL,
  `status` enum('Active','Inactive') NOT NULL,
  `dateAdded` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `attribute_seourl` varchar(500) NOT NULL,
  `attribute_title` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `fc_attribute`
--

INSERT INTO `fc_attribute` (`id`, `attribute_name`, `status`, `dateAdded`, `attribute_seourl`, `attribute_title`) VALUES
(1, 'Amenities', 'Active', '2015-08-12 09:14:14', 'amenities', 'Common amenities at most Hosts listings.'),
(4, 'Extras', 'Active', '2016-10-12 07:10:12', 'extras', 'Extras services'),
(5, 'Special Features', 'Active', '2016-08-30 06:46:17', 'specialfeatures', 'Features of your listing for guests with specific needs.');

-- --------------------------------------------------------

--
-- Table structure for table `fc_banner_category`
--

CREATE TABLE IF NOT EXISTS `fc_banner_category` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `name` mediumtext NOT NULL,
  `image` mediumtext NOT NULL,
  `link` mediumtext NOT NULL,
  `status` enum('Publish','Unpublish') NOT NULL,
  `dateAdded` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `fc_banner_category`
--

INSERT INTO `fc_banner_category` (`id`, `name`, `image`, `link`, `status`, `dateAdded`) VALUES
(5, 'Nursery', 'nursery.jpg', '', 'Publish', '2013-09-24 16:43:07'),
(6, 'Season Indoors', 'season-indoors.jpg', '', 'Publish', '2013-09-24 16:43:17');

-- --------------------------------------------------------

--
-- Table structure for table `fc_booking`
--

CREATE TABLE IF NOT EXISTS `fc_booking` (
  `id` int(11) NOT NULL,
  `From_date` datetime NOT NULL,
  `To_date` datetime NOT NULL,
  `prd_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `owner_id` int(11) NOT NULL,
  `Details` varchar(300) CHARACTER SET utf8 NOT NULL,
  `NoofGuest` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `fc_category`
--

CREATE TABLE IF NOT EXISTS `fc_category` (
  `id` int(200) NOT NULL AUTO_INCREMENT,
  `cat_name` varchar(500) NOT NULL,
  `rootID` int(20) NOT NULL,
  `seourl` varchar(255) NOT NULL,
  `image` varchar(100) NOT NULL,
  `status` enum('Active','InActive') NOT NULL,
  `cat_position` int(11) NOT NULL,
  `seo_title` longblob NOT NULL,
  `seo_keyword` longblob NOT NULL,
  `seo_description` longblob NOT NULL,
  `dateAdded` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `fc_category`
--

INSERT INTO `fc_category` (`id`, `cat_name`, `rootID`, `seourl`, `image`, `status`, `cat_position`, `seo_title`, `seo_keyword`, `seo_description`, `dateAdded`) VALUES
(1, '', 0, '', '', 'Active', 0, '', '', '', '2014-10-31 07:42:15');

-- --------------------------------------------------------

--
-- Table structure for table `fc_cities`
--

CREATE TABLE IF NOT EXISTS `fc_cities` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `countryid` int(11) NOT NULL,
  `stateid` int(11) NOT NULL,
  `state_code` varchar(32) NOT NULL,
  `name` varchar(32) NOT NULL,
  `contid` varchar(50) NOT NULL,
  `seourl` varchar(250) NOT NULL,
  `status` enum('InActive','Active') NOT NULL,
  `featured` enum('0','1') NOT NULL,
  `description` longblob NOT NULL,
  `meta_title` varchar(1000) NOT NULL,
  `meta_keyword` varchar(1000) NOT NULL,
  `meta_description` blob NOT NULL,
  `citylogo` varchar(1000) NOT NULL,
  `citythumb` varchar(1000) NOT NULL,
  `neighborhoods` varchar(1000) NOT NULL,
  `tags` varchar(1000) NOT NULL,
  `short_description` varchar(1000) NOT NULL,
  `latitude` varchar(1000) NOT NULL,
  `longitude` varchar(1000) NOT NULL,
  `get_around` varchar(1000) NOT NULL,
  `known_for` varchar(1000) NOT NULL,
  `view_order` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=449 ;

--
-- Dumping data for table `fc_cities`
--

INSERT INTO `fc_cities` (`id`, `countryid`, `stateid`, `state_code`, `name`, `contid`, `seourl`, `status`, `featured`, `description`, `meta_title`, `meta_keyword`, `meta_description`, `citylogo`, `citythumb`, `neighborhoods`, `tags`, `short_description`, `latitude`, `longitude`, `get_around`, `known_for`, `view_order`) VALUES
(1, 95, 860, '', 'chennai', '', 'chennai', 'Active', '0', '', '', '', '', '', '', '0', '', '', '37.77264', '-122.40992', '', '', 0),
(436, 215, 43, '', 'New york', '', 'new-york', 'Active', '1', '', 'New York - Renters', '', '', '1432131783-new-york-city111.jpg', 'new-york-city111.jpg', '0', '', '', '40.71278', '-74.00594', '', '', 0),
(3, 145, 4, 'TRG', 'Al Muktatfi Bil', '', 'al-muktatfi-bil', 'Active', '0', '', '', '', '', '1436762897-10988494_10153063739605309_3582694735587706984_n.jpg', '10988494_10153063739605309_3582694735587706984_n.jpg', '0', '', '', '4.61990', '103.20890', '', '', 0),
(4, 145, 0, 'MLK', 'Alor Gajah', '', 'alor-gajah', 'Active', '0', '', '', '', '', '', '', '', '', '', '2.3618', '102.2215', '', '', 0),
(5, 145, 0, 'KDH', 'Alor Setar', '', 'alor-setar', 'Active', '0', '', '', '', '', '', '', '', '', '', '6.1063', '100.3685', '', '', 0),
(6, 145, 0, 'KDH', 'Alor Star', '', 'alor-star', 'Active', '0', '', '', '', '', '', '', '', '', '', '6.1194', '100.3677', '', '', 0),
(7, 145, 0, 'SGR', 'Ampang', '', 'ampang', 'Active', '0', '', '', '', '', '', '', '', '', '', '3.1549', '101.7412', '', '', 0),
(8, 145, 0, 'PLS', 'Arau', '', 'arau', 'Active', '0', '', '', '', '', '', '', '', '', '', '6.4246', '100.2736', '', '', 0),
(9, 145, 0, 'MLK', 'Asahan', '', 'asahan', 'Active', '0', '', '', '', '', '', '', '', '', '', '2.38', '102.4819', '', '', 0),
(10, 145, 0, 'SRW', 'Asajaya', '', 'asajaya', 'Active', '0', '', '', '', '', '', '', '', '', '', '1.5424', '110.516', '', '', 0),
(11, 145, 0, 'JHR', 'Ayer Baloi', '', 'ayer-baloi', 'Active', '0', '', '', '', '', '', '', '', '', '', '1.6927', '103.2524', '', '', 0),
(12, 145, 0, 'JHR', 'Ayer Hitam', '', 'ayer-hitam', 'Active', '0', '', '', '', '', '', '', '', '', '', '1.9032', '103.2165', '', '', 0),
(13, 145, 0, 'PNG', 'Ayer Itam', '', 'ayer-itam', 'Active', '0', '', '', '', '', '', '', '', '', '', '5.3681', '100.305', '', '', 0),
(14, 145, 0, 'MLK', 'Ayer Keroh', '', 'ayer-keroh', 'Active', '0', '', '', '', '', '', '', '', '', '', '2.2872', '102.2759', '', '', 0),
(15, 145, 0, 'KTN', 'Ayer Lanas', '', 'ayer-lanas', 'Active', '0', '', '', '', '', '', '', '', '', '', '5.8142', '101.9253', '', '', 0),
(16, 145, 0, 'PRK', 'Ayer Tawar', '', 'ayer-tawar', 'Active', '0', '', '', '', '', '', '', '', '', '', '4.3674', '100.8604', '', '', 0),
(17, 145, 0, 'JHR', 'Ayer Tawar 3', '', 'ayer-tawar-3', 'Active', '0', '', '', '', '', '', '', '', '', '', '1.721', '103.8967', '', '', 0),
(18, 215, 18, 'KTN', 'Miami ', '', 'miami', 'Active', '0', '', '', '', '', '1432130738-miami+skyrise+tower111.jpg', 'miami+skyrise+tower111.jpg', '0', '', '', '25.76168', '-80.19179', '', '', 0),
(19, 145, 0, 'PRK', 'Bagan Datoh', '', 'bagan-datoh', 'Active', '0', '', '', '', '', '', '', '', '', '', '3.9793', '100.7593', '', '', 0),
(20, 145, 0, 'PRK', 'Bagan Serai', '', 'bagan-serai', 'Active', '0', '', '', '', '', '', '', '', '', '', '4.8687', '100.6968', '', '', 0),
(21, 145, 0, 'NSN', 'Bahau', '', 'bahau', 'Active', '0', '', '', '', '', '', '', '', '', '', '2.8199', '102.2934', '', '', 0),
(22, 145, 0, 'PNG', 'Balik Pulau', '', 'balik-pulau', 'Active', '0', '', '', '', '', '', '', '', '', '', '5.352', '100.2824', '', '', 0),
(23, 145, 0, 'KDH', 'Baling', '', 'baling', 'Active', '0', '', '', '', '', '', '', '', '', '', '5.7229', '100.7831', '', '', 0),
(24, 145, 0, 'SRW', 'Balingian', '', 'balingian', 'Active', '0', '', '', '', '', '', '', '', '', '', '2.2248', '111.6044', '', '', 0),
(25, 145, 0, 'PHG', 'Balok', '', 'balok', 'Active', '0', '', '', '', '', '', '', '', '', '', '3.912', '103.3298', '', '', 0),
(26, 145, 0, 'KDH', 'Bandar Baharu', '', 'bandar-baharu', 'Active', '0', '', '', '', '', '', '', '', '', '', '5.1873', '100.5156', '', '', 0),
(27, 145, 0, 'KDH', 'Bandar Bahru', '', 'bandar-bahru', 'Active', '0', '', '', '', '', '', '', '', '', '', '5.6564', '100.5422', '', '', 0),
(28, 145, 0, 'SGR', 'Bandar Baru Ban', '', 'bandar-baru-ban', 'Active', '0', '', '', '', '', '', '', '', '', '', '2.9918', '101.7455', '', '', 0),
(29, 145, 0, 'NSN', 'Bandar Baru Ens', '', 'bandar-baru-ens', 'Active', '0', '', '', '', '', '', '', '', '', '', '2.7526', '101.7667', '', '', 0),
(30, 145, 0, 'JHR', 'Bandar Penawar', '', 'bandar-penawar', 'Active', '0', '', '', '', '', '', '', '', '', '', '1.6712', '103.9725', '', '', 0),
(31, 145, 0, 'SGR', 'Bandar Puncak A', '', 'bandar-puncak-a', 'Active', '0', '', '', '', '', '', '', '', '', '', '3.1682', '101.5271', '', '', 0),
(32, 145, 0, 'PHG', 'Bandar Pusat  J', '', 'bandar-pusat-j', 'Active', '0', '', '', '', '', '', '', '', '', '', '3.7416', '102.5443', '', '', 0),
(33, 145, 0, 'PHG', 'Bandar Pusat Je', '', 'bandar-pusat-je', 'Active', '0', '', '', '', '', '', '', '', '', '', '3.6739', '102.5212', '', '', 0),
(34, 145, 0, 'PRK', 'Bandar Seri Isk', '', 'bandar-seri-isk', 'Active', '0', '', '', '', '', '', '', '', '', '', '4.3587', '100.9673', '', '', 0),
(35, 145, 0, 'NSN', 'Bandar Seri Jem', '', 'bandar-seri-jem', 'Active', '0', '', '', '', '', '', '', '', '', '', '2.8299', '102.2531', '', '', 0),
(36, 145, 0, 'JHR', 'Bandar Tenggara', '', 'bandar-tenggara', 'Active', '0', '', '', '', '', '', '', '', '', '', '1.7876', '103.6699', '', '', 0),
(37, 145, 0, 'PHG', 'Bandar Tun Abdu', '', 'bandar-tun-abdu', 'Active', '0', '', '', '', '', '', '', '', '', '', '2.9499', '102.6818', '', '', 0),
(38, 145, 0, 'SGR', 'Bangi', '', 'bangi', 'Active', '0', '', '', '', '', '', '', '', '', '', '2.9271', '101.7802', '', '', 0),
(39, 145, 0, 'SGR', 'Banting', '', 'banting', 'Active', '0', '', '', '', '', '', '', '', '', '', '2.9092', '101.5279', '', '', 0),
(40, 145, 0, 'SRW', 'Baram', '', 'baram', 'Active', '0', '', '', '', '', '', '', '', '', '', '2.0768', '112.3837', '', '', 0),
(41, 145, 0, 'SGR', 'Batang Berjunta', '', 'batang-berjunta', 'Active', '0', '', '', '', '', '', '', '', '', '', '3.3036', '101.46', '', '', 0),
(42, 145, 0, 'SGR', 'Batang Kali', '', 'batang-kali', 'Active', '0', '', '', '', '', '', '', '', '', '', '3.3751', '101.6306', '', '', 0),
(43, 145, 0, 'JHR', 'Batu Anam', '', 'batu-anam', 'Active', '0', '', '', '', '', '', '', '', '', '', '2.4247', '102.8497', '', '', 0),
(44, 215, 43, 'KUL', 'Newark', '', 'newark', 'Active', '1', '', '', '', '', '1432131688-NYC_Buildings1.jpg', 'NYC_Buildings1.jpg', '0', '', '', '43.04673', '-77.09525', '', '', 0),
(45, 145, 0, 'PNG', 'Batu Ferringhi', '', 'batu-ferringhi', 'Active', '0', '', '', '', '', '', '', '', '', '', '5.4452', '100.2911', '', '', 0),
(46, 145, 0, 'PRK', 'Batu Gajah', '', 'batu-gajah', 'Active', '0', '', '', '', '', '', '', '', '', '', '4.4422', '101.0546', '', '', 0),
(47, 145, 0, 'NSN', 'Batu Kikir', '', 'batu-kikir', 'Active', '0', '', '', '', '', '', '', '', '', '', '2.8352', '102.2086', '', '', 0),
(48, 145, 0, 'PRK', 'Batu Kurau', '', 'batu-kurau', 'Active', '0', '', '', '', '', '', '', '', '', '', '4.9553', '100.8398', '', '', 0),
(49, 145, 0, 'PNG', 'Batu Maung', '', 'batu-maung', 'Active', '0', '', '', '', '', '', '', '', '', '', '5.355', '100.2709', '', '', 0),
(50, 145, 0, 'JHR', 'Batu Pahat', '', 'batu-pahat', 'Active', '0', '', '', '', '', '', '', '', '', '', '1.8578', '103.0357', '', '', 0),
(51, 145, 0, 'SRW', 'Bau', '', 'bau', 'Active', '0', '', '', '', '', '', '', '', '', '', '1.4813', '110.1013', '', '', 0),
(52, 145, 0, 'PNG', 'Bayan Lepas', '', 'bayan-lepas', 'Active', '0', '', '', '', '', '', '', '', '', '', '5.3163', '100.281', '', '', 0),
(53, 145, 0, 'SBH', 'Beaufort', '', 'beaufort', 'Active', '0', '', '', '', '', '', '', '', '', '', '5.3452', '115.7078', '', '', 0),
(54, 145, 0, 'KDH', 'Bedong', '', 'bedong', 'Active', '0', '', '', '', '', '', '', '', '', '', '5.7879', '100.4719', '', '', 0),
(55, 145, 0, 'PRK', 'Behrang Stesen', '', 'behrang-stesen', 'Active', '0', '', '', '', '', '', '', '', '', '', '3.889', '101.4121', '', '', 0),
(56, 145, 0, 'SRW', 'Bekenu', '', 'bekenu', 'Active', '0', '', '', '', '', '', '', '', '', '', '4.0678', '113.8315', '', '', 0),
(57, 145, 0, 'JHR', 'Bekok', '', 'bekok', 'Active', '0', '', '', '', '', '', '', '', '', '', '2.1332', '103.4663', '', '', 0),
(58, 145, 0, 'SRW', 'Belaga', '', 'belaga', 'Active', '0', '', '', '', '', '', '', '', '', '', '2.4811', '113.6292', '', '', 0),
(59, 145, 0, 'SRW', 'Belawai', '', 'belawai', 'Active', '0', '', '', '', '', '', '', '', '', '', '1.9636', '111.0947', '', '', 0),
(60, 145, 0, 'SBH', 'Beluran', '', 'beluran', 'Active', '0', '', '', '', '', '', '', '', '', '', '5.9945', '117.3361', '', '', 0),
(61, 145, 0, 'PHG', 'Benta', '', 'benta', 'Active', '0', '', '', '', '', '', '', '', '', '', '3.9583', '102.1692', '', '', 0),
(62, 145, 0, 'PHG', 'Bentong', '', 'bentong', 'Active', '0', '', '', '', '', '', '', '', '', '', '3.5281', '101.9763', '', '', 0),
(63, 145, 0, 'JHR', 'Benut', '', 'benut', 'Active', '0', '', '', '', '', '', '', '', '', '', '1.6864', '103.2713', '', '', 0),
(64, 145, 0, 'SGR', 'Beranang', '', 'beranang', 'Active', '0', '', '', '', '', '', '', '', '', '', '2.952', '101.8261', '', '', 0),
(65, 145, 0, 'SRW', 'Betong', '', 'betong', 'Active', '0', '', '', '', '', '', '', '', '', '', '1.5038', '111.4675', '', '', 0),
(66, 145, 0, 'SBH', 'Beverly', '', 'beverly', 'Active', '0', '', '', '', '', '', '', '', '', '', '5.4204', '116.7968', '', '', 0),
(67, 145, 0, 'PRK', 'Bidor', '', 'bidor', 'Active', '0', '', '', '', '', '', '', '', '', '', '4.1787', '101.2265', '', '', 0),
(68, 145, 0, 'SRW', 'Bintangor', '', 'bintangor', 'Active', '0', '', '', '', '', '', '', '', '', '', '2.2244', '111.5791', '', '', 0),
(69, 145, 0, 'SRW', 'Bintulu', '', 'bintulu', 'Active', '0', '', '', '', '', '', '', '', '', '', '2.6262', '112.1367', '', '', 0),
(70, 145, 0, 'SBH', 'Bongawan', '', 'bongawan', 'Active', '0', '', '', '', '', '', '', '', '', '', '5.4835', '115.7834', '', '', 0),
(71, 145, 0, 'PHG', 'Brinchang', '', 'brinchang', 'Active', '0', '', '', '', '', '', '', '', '', '', '4.3557', '101.6275', '', '', 0),
(72, 145, 0, 'PRK', 'Bruas', '', 'bruas', 'Active', '0', '', '', '', '', '', '', '', '', '', '4.7499', '100.837', '', '', 0),
(73, 145, 0, 'TRG', 'Bukit Besi', '', 'bukit-besi', 'Active', '0', '', '', '', '', '', '', '', '', '', '5.0395', '102.7909', '', '', 0),
(74, 145, 0, 'PHG', 'Bukit Fraser', '', 'bukit-fraser', 'Active', '0', '', '', '', '', '', '', '', '', '', '3.7188', '101.7403', '', '', 0),
(75, 145, 0, 'JHR', 'Bukit Gambir', '', 'bukit-gambir', 'Active', '0', '', '', '', '', '', '', '', '', '', '2.1437', '102.8537', '', '', 0),
(76, 145, 0, 'PHG', 'Bukit Goh', '', 'bukit-goh', 'Active', '0', '', '', '', '', '', '', '', '', '', '3.7793', '102.9106', '', '', 0),
(77, 145, 0, 'KDH', 'Bukit Kayu Hita', '', 'bukit-kayu-hita', 'Active', '0', '', '', '', '', '', '', '', '', '', '6.3493', '100.4429', '', '', 0),
(78, 145, 0, 'PNG', 'Bukit Mertajam', '', 'bukit-mertajam', 'Active', '0', '', '', '', '', '', '', '', '', '', '5.3344', '100.4673', '', '', 0),
(79, 145, 0, 'JHR', 'Bukit Pasir', '', 'bukit-pasir', 'Active', '0', '', '', '', '', '', '', '', '', '', '2.1122', '102.7617', '', '', 0),
(80, 145, 0, 'TRG', 'Bukit Payong', '', 'bukit-payong', 'Active', '0', '', '', '', '', '', '', '', '', '', '5.2321', '103.1041', '', '', 0),
(81, 145, 0, 'SGR', 'Bukit Rotan', '', 'bukit-rotan', 'Active', '0', '', '', '', '', '', '', '', '', '', '3.1956', '101.3926', '', '', 0),
(82, 145, 0, 'PNG', 'Butterworth', '', 'butterworth', 'Active', '0', '', '', '', '', '', '', '', '', '', '5.4093', '100.3649', '', '', 0),
(83, 145, 0, 'TRG', 'Ceneh', '', 'ceneh', 'Active', '0', '', '', '', '', '', '', '', '', '', '4.1373', '103.2476', '', '', 0),
(84, 145, 0, 'JHR', 'Chaah', '', 'chaah', 'Active', '0', '', '', '', '', '', '', '', '', '', '2.0491', '103.1443', '', '', 0),
(85, 145, 0, 'TRG', 'Chalok', '', 'chalok', 'Active', '0', '', '', '', '', '', '', '', '', '', '5.3867', '102.8676', '', '', 0),
(86, 145, 0, 'PRK', 'Changkat Jering', '', 'changkat-jering', 'Active', '0', '', '', '', '', '', '', '', '', '', '4.7067', '100.832', '', '', 0),
(87, 145, 0, 'PRK', 'Changkat Keruin', '', 'changkat-keruin', 'Active', '0', '', '', '', '', '', '', '', '', '', '4.2702', '100.8909', '', '', 0),
(88, 145, 0, 'PRK', 'Chemor', '', 'chemor', 'Active', '0', '', '', '', '', '', '', '', '', '', '4.7281', '101.12', '', '', 0),
(89, 145, 0, 'PRK', 'Chenderiang', '', 'chenderiang', 'Active', '0', '', '', '', '', '', '', '', '', '', '4.3111', '101.2339', '', '', 0),
(90, 145, 0, 'PRK', 'Chenderong Bala', '', 'chenderong-bala', 'Active', '0', '', '', '', '', '', '', '', '', '', '4.2992', '101.0101', '', '', 0),
(91, 145, 0, 'PHG', 'Chenor', '', 'chenor', 'Active', '0', '', '', '', '', '', '', '', '', '', '3.5018', '102.6455', '', '', 0),
(92, 145, 0, 'KTN', 'Cherang Ruku', '', 'cherang-ruku', 'Active', '0', '', '', '', '', '', '', '', '', '', '5.8722', '102.4363', '', '', 0),
(93, 145, 0, 'KUL', 'Cheras', '', 'cheras', 'Active', '0', '', '', '', '', '', '', '', '', '', '3.1056', '101.7253', '', '', 0),
(94, 145, 0, 'PRK', 'Chikus', '', 'chikus', 'Active', '0', '', '', '', '', '', '', '', '', '', '4.3082', '101.0173', '', '', 0),
(95, 145, 0, 'PHG', 'Chini', '', 'chini', 'Active', '0', '', '', '', '', '', '', '', '', '', '3.2106', '103.0223', '', '', 0),
(96, 145, 0, 'TRG', 'Cukai', '', 'cukai', 'Active', '0', '', '', '', '', '', '', '0', '', '', '4.33050', '103.35200', '', '', 0),
(97, 145, 0, 'SGR', 'Cyberjaya', '', 'cyberjaya', 'Active', '0', '', '', '', '', '', '', '', '', '', '2.9679', '101.653', '', '', 0),
(98, 145, 0, 'KTN', 'Dabong', '', 'dabong', 'Active', '0', '', '', '', '', '', '', '', '', '', '5.4938', '102.0523', '', '', 0),
(99, 145, 0, 'SRW', 'Dalat', '', 'dalat', 'Active', '0', '', '', '', '', '', '', '', '', '', '2.2853', '111.9027', '', '', 0),
(100, 215, 57, 'PHG', 'Houston', '', 'houston', 'Active', '1', '', '', '', '', '1432131090-houston-wallpaper-hd1.jpg', 'houston-wallpaper-hd1.jpg', '0', '', '', '29.76043', '-95.36980', '', '', 0),
(101, 145, 0, 'SRW', 'Daro', '', 'daro', 'Active', '0', '', '', '', '', '', '', '', '', '', '2.5321', '111.5253', '', '', 0),
(102, 145, 0, 'SRW', 'Debak', '', 'debak', 'Active', '0', '', '', '', '', '', '', '', '', '', '1.5775', '111.2168', '', '', 0),
(103, 145, 0, 'SGR', 'Dengkil', '', 'dengkil', 'Active', '0', '', '', '', '', '', '', '', '', '', '2.9686', '101.652', '', '', 0),
(104, 145, 0, 'PHG', 'Dong', '', 'dong', 'Active', '0', '', '', '', '', '', '', '', '', '', '3.8834', '101.983', '', '', 0),
(105, 145, 0, 'TRG', 'Dungun', '', 'dungun', 'Active', '0', '', '', '', '', '', '', '', '', '', '4.8168', '103.3036', '', '', 0),
(106, 145, 0, 'MLK', 'Durian Tunggal', '', 'durian-tunggal', 'Active', '0', '', '', '', '', '', '', '', '', '', '2.3013', '102.2842', '', '', 0),
(107, 145, 0, 'JHR', 'Endau', '', 'endau', 'Active', '0', '', '', '', '', '', '', '', '', '', '2.5415', '103.542', '', '', 0),
(108, 145, 0, 'PRK', 'Enggor', '', 'enggor', 'Active', '0', '', '', '', '', '', '', '', '', '', '4.8218', '100.946', '', '', 0),
(109, 145, 0, 'SRW', 'Engkilili', '', 'engkilili', 'Active', '0', '', '', '', '', '', '', '', '', '', '1.2817', '110.9074', '', '', 0),
(110, 145, 0, 'PHG', 'Gambang', '', 'gambang', 'Active', '0', '', '', '', '', '', '', '', '', '', '3.7444', '103.1378', '', '', 0),
(111, 145, 0, 'JHR', 'Gelang Patah', '', 'gelang-patah', 'Active', '0', '', '', '', '', '', '', '', '', '', '1.4619', '103.5857', '', '', 0),
(112, 145, 0, 'PNG', 'Gelugor', '', 'gelugor', 'Active', '0', '', '', '', '', '', '', '', '', '', '5.3653', '100.3067', '', '', 0),
(113, 145, 0, 'NSN', 'Gemas', '', 'gemas', 'Active', '0', '', '', '', '', '', '', '', '', '', '2.6637', '102.5259', '', '', 0),
(114, 145, 0, 'NSN', 'Gemencheh', '', 'gemencheh', 'Active', '0', '', '', '', '', '', '', '', '', '', '2.6213', '102.3113', '', '', 0),
(115, 145, 0, 'PHG', 'Genting Highlan', '', 'genting-highlan', 'Active', '0', '', '', '', '', '', '', '', '', '', '3.422', '101.7892', '', '', 0),
(116, 145, 0, 'PRK', 'Gerik', '', 'gerik', 'Active', '0', '', '', '', '', '', '', '', '', '', '5.2806', '101.1007', '', '', 0),
(117, 145, 0, 'JHR', 'Gerisek', '', 'gerisek', 'Active', '0', '', '', '', '', '', '', '', '', '', '2.215', '102.7854', '', '', 0),
(118, 145, 0, 'PRK', 'Gopeng', '', 'gopeng', 'Active', '0', '', '', '', '', '', '', '', '', '', '4.5193', '101.1153', '', '', 0),
(119, 145, 0, 'KTN', 'Gua Musang', '', 'gua-musang', 'Active', '0', '', '', '', '', '', '', '', '', '', '5.0356', '102.0247', '', '', 0),
(120, 145, 0, 'JHR', 'Gugusan Taib An', '', 'gugusan-taib-an', 'Active', '0', '', '', '', '', '', '', '', '', '', '1.7601', '103.6852', '', '', 0),
(121, 145, 0, 'KDH', 'Gurun', '', 'gurun', 'Active', '0', '', '', '', '', '', '', '', '', '', '5.8064', '100.5136', '', '', 0),
(122, 145, 0, 'SGR', 'Hulu Langat', '', 'hulu-langat', 'Active', '0', '', '', '', '', '', '', '', '', '', '3.0719', '101.8347', '', '', 0),
(123, 145, 0, 'PRK', 'Hutan Melintang', '', 'hutan-melintang', 'Active', '0', '', '', '', '', '', '', '', '', '', '4.0333', '100.9471', '', '', 0),
(124, 145, 0, 'SBH', 'Inanam', '', 'inanam', 'Active', '0', '', '', '', '', '', '', '', '', '', '5.9933', '116.1322', '', '', 0),
(125, 145, 0, 'PRK', 'Intan', '', 'intan', 'Active', '0', '', '', '', '', '', '', '', '', '', '5.4297', '101.0342', '', '', 0),
(126, 145, 0, 'PRK', 'Ipoh', '', 'ipoh', 'Active', '0', '', '', '', '', '', '', '', '', '', '4.6502', '101.0682', '', '', 0),
(127, 145, 0, 'MLK', 'Jasin', '', 'jasin', 'Active', '0', '', '', '', '', '', '', '', '', '', '2.2933', '102.4146', '', '', 0),
(128, 145, 0, 'PHG', 'Jaya Gading', '', 'jaya-gading', 'Active', '0', '', '', '', '', '', '', '', '', '', '3.8173', '103.1733', '', '', 0),
(129, 145, 0, 'KTN', 'Jeli', '', 'jeli', 'Active', '0', '', '', '', '', '', '', '', '', '', '5.728', '101.9225', '', '', 0),
(130, 145, 0, 'PNG', 'Jelutong', '', 'jelutong', 'Active', '0', '', '', '', '', '', '', '', '', '', '5.3956', '100.3111', '', '', 0),
(131, 145, 0, 'JHR', 'Jementah', '', 'jementah', 'Active', '0', '', '', '', '', '', '', '', '', '', '2.1737', '102.9493', '', '', 0),
(132, 145, 0, 'KDH', 'Jeniang', '', 'jeniang', 'Active', '0', '', '', '', '', '', '', '', '', '', '5.8343', '100.6252', '', '', 0),
(133, 145, 0, 'SGR', 'Jenjarom', '', 'jenjarom', 'Active', '0', '', '', '', '', '', '', '', '', '', '2.9723', '101.5282', '', '', 0),
(134, 145, 0, 'PRK', 'Jeram', '', 'jeram', 'Active', '0', '', '', '', '', '', '', '', '', '', '4.3641', '101.1539', '', '', 0),
(135, 145, 0, 'PHG', 'Jerantut', '', 'jerantut', 'Active', '0', '', '', '', '', '', '', '', '', '', '3.868', '102.4271', '', '', 0),
(136, 145, 0, 'TRG', 'Jerteh', '', 'jerteh', 'Active', '0', '', '', '', '', '', '', '', '', '', '5.6111', '102.5729', '', '', 0),
(137, 145, 0, 'KDH', 'Jitra', '', 'jitra', 'Active', '0', '', '', '', '', '', '', '', '', '', '6.1316', '100.4351', '', '', 0),
(138, 145, 0, 'NSN', 'Johol', '', 'johol', 'Active', '0', '', '', '', '', '', '', '', '', '', '2.6182', '102.2701', '', '', 0),
(139, 145, 0, 'JHR', 'Johor Bahru', '', 'johor-bahru', 'Active', '0', '', '', '', '', '', '', '', '', '', '1.5035', '103.7405', '', '', 0),
(140, 145, 0, 'SRW', 'Julau', '', 'julau', 'Active', '0', '', '', '', '', '', '', '', '', '', '1.783', '111.9699', '', '', 0),
(141, 145, 0, 'SRW', 'Kabong', '', 'kabong', 'Active', '0', '', '', '', '', '', '', '', '', '', '1.8453', '111.4252', '', '', 0),
(142, 145, 0, 'JHR', 'Kahang', '', 'kahang', 'Active', '0', '', '', '', '', '', '', '', '', '', '2.1504', '103.5336', '', '', 0),
(143, 145, 0, 'SGR', 'Kajang', '', 'kajang', 'Active', '0', '', '', '', '', '', '', '', '', '', '3.0094', '101.7755', '', '', 0),
(144, 145, 0, 'PLS', 'Kaki Bukit', '', 'kaki-bukit', 'Active', '0', '', '', '', '', '', '', '', '', '', '6.6472', '100.2022', '', '', 0),
(145, 145, 0, 'PRK', 'Kampar', '', 'kampar', 'Active', '0', '', '', '', '', '', '', '', '', '', '4.3551', '101.1252', '', '', 0),
(146, 145, 0, 'PRK', 'Kampung Gajah', '', 'kampung-gajah', 'Active', '0', '', '', '', '', '', '', '', '', '', '4.3923', '100.9307', '', '', 0),
(147, 145, 0, 'PRK', 'Kampung Kepayan', '', 'kampung-kepayan', 'Active', '0', '', '', '', '', '', '', '', '', '', '4.5595', '101.0673', '', '', 0),
(148, 145, 0, 'TRG', 'Kampung Raja', '', 'kampung-raja', 'Active', '0', '', '', '', '', '', '', '', '', '', '5.7332', '102.613', '', '', 0),
(149, 145, 0, 'PRK', 'Kamunting', '', 'kamunting', 'Active', '0', '', '', '', '', '', '', '', '', '', '4.8263', '100.7717', '', '', 0),
(150, 145, 0, 'PLS', 'Kangar', '', 'kangar', 'Active', '0', '', '', '', '', '', '', '', '', '', '6.4312', '100.2056', '', '', 0),
(151, 145, 0, 'SRW', 'Kanowit', '', 'kanowit', 'Active', '0', '', '', '', '', '', '', '', '', '', '1.9416', '112.0866', '', '', 0),
(152, 145, 0, 'SGR', 'Kapar', '', 'kapar', 'Active', '0', '', '', '', '', '', '', '', '', '', '3.1331', '101.4207', '', '', 0),
(153, 145, 0, 'SRW', 'Kapit', '', 'kapit', 'Active', '0', '', '', '', '', '', '', '', '', '', '1.9499', '113.1692', '', '', 0),
(154, 145, 0, 'PHG', 'Karak', '', 'karak', 'Active', '0', '', '', '', '', '', '', '', '', '', '3.4339', '102.1543', '', '', 0),
(155, 145, 0, 'KDH', 'Karangan', '', 'karangan', 'Active', '0', '', '', '', '', '', '', '', '', '', '5.5748', '100.6005', '', '', 0),
(156, 145, 0, 'KTN', 'Kem Desa Pahlaw', '', 'kem-desa-pahlaw', 'Active', '0', '', '', '', '', '', '', '', '', '', '5.8938', '102.2273', '', '', 0),
(157, 145, 0, 'MLK', 'Kem Trendak', '', 'kem-trendak', 'Active', '0', '', '', '', '', '', '', '', '', '', '2.2891', '102.3256', '', '', 0),
(158, 145, 0, 'TRG', 'Kemasek', '', 'kemasek', 'Active', '0', '', '', '', '', '', '', '', '', '', '4.62', '103.353', '', '', 0),
(159, 145, 0, 'PHG', 'Kemayan', '', 'kemayan', 'Active', '0', '', '', '', '', '', '', '', '', '', '3.251', '102.5593', '', '', 0),
(160, 145, 0, 'SBH', 'Keningau', '', 'keningau', 'Active', '0', '', '', '', '', '', '', '', '', '', '5.3561', '116.3049', '', '', 0),
(161, 145, 0, 'KDH', 'Kepala Batas', '', 'kepala-batas', 'Active', '0', '', '', '', '', '', '', '', '', '', '5.9661', '100.4734', '', '', 0),
(162, 145, 0, 'SGR', 'Kerling', '', 'kerling', 'Active', '0', '', '', '', '', '', '', '', '', '', '3.5566', '101.5612', '', '', 0),
(163, 145, 0, 'TRG', 'Kerteh', '', 'kerteh', 'Active', '0', '', '', '', '', '', '', '', '', '', '4.6985', '103.3568', '', '', 0),
(164, 145, 0, 'TRG', 'Ketengah Jaya', '', 'ketengah-jaya', 'Active', '0', '', '', '', '', '', '', '', '', '', '4.4348', '103.3763', '', '', 0),
(165, 145, 0, 'KTN', 'Ketereh', '', 'ketereh', 'Active', '0', '', '', '', '', '', '', '', '', '', '5.9179', '102.2274', '', '', 0),
(166, 145, 0, 'TRG', 'Kijal', '', 'kijal', 'Active', '0', '', '', '', '', '', '', '', '', '', '4.436', '103.4175', '', '', 0),
(167, 145, 0, 'SGR', 'Klang', '', 'klang', 'Active', '0', '', '', '', '', '', '', '', '', '', '3.0349', '101.5119', '', '', 0),
(168, 145, 0, 'SGR', 'KLIA', '', 'klia', 'Active', '0', '', '', '', '', '', '', '', '', '', '2.8239', '101.687', '', '', 0),
(169, 145, 0, 'JHR', 'Kluang', '', 'kluang', 'Active', '0', '', '', '', '', '', '', '', '', '', '1.9226', '103.4038', '', '', 0),
(170, 145, 0, 'KDH', 'Kodiang', '', 'kodiang', 'Active', '0', '', '', '', '', '', '', '', '', '', '6.2045', '100.3746', '', '', 0),
(171, 145, 0, 'NSN', 'Kota', '', 'kota', 'Active', '0', '', '', '', '', '', '', '', '', '', '2.5231', '102.1388', '', '', 0),
(172, 145, 0, 'KTN', 'Kota Bahru', '', 'kota-bahru', 'Active', '0', '', '', '', '', '', '', '', '', '', '6.122', '102.2523', '', '', 0),
(173, 145, 0, 'SBH', 'Kota Belud', '', 'kota-belud', 'Active', '0', '', '', '', '', '', '', '', '', '', '6.3463', '116.4665', '', '', 0),
(174, 145, 0, 'KTN', 'Kota Bharu', '', 'kota-bharu', 'Active', '0', '', '', '', '', '', '', '', '', '', '6.1253', '102.2461', '', '', 0),
(175, 145, 0, 'SBH', 'Kota Kinabalu', '', 'kota-kinabalu', 'Active', '0', '', '', '', '', '', '', '', '', '', '5.8626', '115.9946', '', '', 0),
(176, 145, 0, 'SBH', 'Kota Kinabatang', '', 'kota-kinabatang', 'Active', '0', '', '', '', '', '', '', '', '', '', '5.2438', '117.4841', '', '', 0),
(177, 145, 0, 'KDH', 'Kota Kuala Muda', '', 'kota-kuala-muda', 'Active', '0', '', '', '', '', '', '', '', '', '', '5.7405', '100.4243', '', '', 0),
(178, 145, 0, 'SBH', 'Kota Marudu', '', 'kota-marudu', 'Active', '0', '', '', '', '', '', '', '', '', '', '6.5407', '116.8224', '', '', 0),
(179, 145, 0, 'SRW', 'Kota Samarahan', '', 'kota-samarahan', 'Active', '0', '', '', '', '', '', '', '', '', '', '1.4727', '110.402', '', '', 0),
(180, 145, 0, 'KDH', 'Kota Sarang Sem', '', 'kota-sarang-sem', 'Active', '0', '', '', '', '', '', '', '', '', '', '5.9008', '100.4089', '', '', 0),
(181, 145, 0, 'JHR', 'Kota Tinggi', '', 'kota-tinggi', 'Active', '0', '', '', '', '', '', '', '', '', '', '1.7427', '103.7788', '', '', 0),
(182, 145, 0, 'KTN', 'Kuala Balah', '', 'kuala-balah', 'Active', '0', '', '', '', '', '', '', '', '', '', '5.4526', '101.9212', '', '', 0),
(183, 145, 0, 'TRG', 'Kuala Berang', '', 'kuala-berang', 'Active', '0', '', '', '', '', '', '', '', '', '', '5.1048', '102.9733', '', '', 0),
(184, 145, 0, 'TRG', 'Kuala Besut', '', 'kuala-besut', 'Active', '0', '', '', '', '', '', '', '', '', '', '5.7998', '102.5579', '', '', 0),
(185, 145, 0, 'PRK', 'Kuala Kangsar', '', 'kuala-kangsar', 'Active', '0', '', '', '', '', '', '', '', '', '', '4.7073', '100.9381', '', '', 0),
(186, 145, 0, 'KDH', 'Kuala Kedah', '', 'kuala-kedah', 'Active', '0', '', '', '', '', '', '', '', '', '', '5.9919', '100.3635', '', '', 0),
(187, 145, 0, 'KDH', 'Kuala Ketil', '', 'kuala-ketil', 'Active', '0', '', '', '', '', '', '', '', '', '', '5.6747', '100.6754', '', '', 0),
(188, 145, 0, 'NSN', 'Kuala Klawang', '', 'kuala-klawang', 'Active', '0', '', '', '', '', '', '', '', '', '', '2.9555', '102.0719', '', '', 0),
(189, 145, 0, 'KTN', 'Kuala Krai', '', 'kuala-krai', 'Active', '0', '', '', '', '', '', '', '', '', '', '5.5693', '102.1786', '', '', 0),
(190, 145, 0, 'PHG', 'Kuala Krau', '', 'kuala-krau', 'Active', '0', '', '', '', '', '', '', '', '', '', '3.6237', '102.456', '', '', 0),
(191, 145, 0, 'SGR', 'Kuala Kubu Baru', '', 'kuala-kubu-baru', 'Active', '0', '', '', '', '', '', '', '', '', '', '3.386', '101.5488', '', '', 0),
(192, 145, 0, 'PRK', 'Kuala Kurau', '', 'kuala-kurau', 'Active', '0', '', '', '', '', '', '', '', '', '', '4.9211', '100.5186', '', '', 0),
(193, 145, 0, 'PHG', 'Kuala Lipis', '', 'kuala-lipis', 'Active', '0', '', '', '', '', '', '', '', '', '', '4.0629', '102.1071', '', '', 0),
(194, 215, 62, 'KUL', 'Seattle', '', 'seattle', 'Active', '1', '', '', '', '', '1432131243-seattle-21.jpg', 'seattle-21.jpg', '0', '', '', '47.60621', '-122.33207', '', '', 0),
(195, 145, 0, 'KDH', 'Kuala Nerang', '', 'kuala-nerang', 'Active', '0', '', '', '', '', '', '', '', '', '', '6.1461', '100.5833', '', '', 0),
(196, 145, 0, 'KDH', 'Kuala Pegang', '', 'kuala-pegang', 'Active', '0', '', '', '', '', '', '', '', '', '', '5.7874', '100.6923', '', '', 0),
(197, 145, 0, 'SBH', 'Kuala Penyu', '', 'kuala-penyu', 'Active', '0', '', '', '', '', '', '', '', '', '', '5.4894', '115.5347', '', '', 0),
(198, 145, 0, 'PLS', 'Kuala Perlis', '', 'kuala-perlis', 'Active', '0', '', '', '', '', '', '', '', '', '', '6.2683', '100.2088', '', '', 0),
(199, 145, 0, 'NSN', 'Kuala Pilah', '', 'kuala-pilah', 'Active', '0', '', '', '', '', '', '', '', '', '', '2.7226', '102.2138', '', '', 0),
(200, 145, 0, 'PHG', 'Kuala Rompin', '', 'kuala-rompin', 'Active', '0', '', '', '', '', '', '', '', '', '', '2.9496', '103.4089', '', '', 0),
(201, 145, 0, 'SGR', 'Kuala Selangor', '', 'kuala-selangor', 'Active', '0', '', '', '', '', '', '', '', '', '', '3.2457', '101.3678', '', '', 0),
(202, 145, 0, 'PRK', 'Kuala Sepetang', '', 'kuala-sepetang', 'Active', '0', '', '', '', '', '', '', '', '', '', '4.9204', '100.6607', '', '', 0),
(203, 145, 0, 'MLK', 'Kuala Sungai Ba', '', 'kuala-sungai-ba', 'Active', '0', '', '', '', '', '', '', '', '', '', '2.33', '102.0961', '', '', 0),
(204, 145, 0, 'TRG', 'Kuala Terenggan', '', 'kuala-terenggan', 'Active', '0', '', '', '', '', '', '', '', '', '', '5.2847', '103.1475', '', '', 0),
(205, 145, 0, 'PHG', 'Kuantan', '', 'kuantan', 'Active', '0', '', '', '', '', '', '', '', '', '', '3.8099', '103.2893', '', '', 0),
(206, 145, 0, 'PNG', 'Kubang Semang', '', 'kubang-semang', 'Active', '0', '', '', '', '', '', '', '', '', '', '5.4088', '100.4837', '', '', 0),
(207, 145, 865, 'SRW', 'Kuching', '', 'kuching', 'InActive', '0', '', '', '', '', '1434493639-12.jpg', '12.jpg', '0', '', '', '1.54550', '110.34390', '', '', 0),
(208, 145, 0, 'SBH', 'Kudat', '', 'kudat', 'Active', '0', '', '', '', '', '', '', '', '', '', '6.8298', '116.8867', '', '', 0),
(209, 145, 0, 'JHR', 'Kukup', '', 'kukup', 'Active', '0', '', '', '', '', '', '', '', '', '', '1.423', '103.4425', '', '', 0),
(210, 145, 0, 'JHR', 'Kulai', '', 'kulai', 'Active', '0', '', '', '', '', '', '', '', '', '', '1.7259', '103.5011', '', '', 0),
(211, 145, 0, 'KDH', 'Kulim', '', 'kulim', 'Active', '0', '', '', '', '', '', '', '', '', '', '5.4724', '100.5385', '', '', 0),
(212, 145, 0, 'SBH', 'Kunak', '', 'kunak', 'Active', '0', '', '', '', '', '', '', '', '', '', '4.677', '118.1392', '', '', 0),
(213, 145, 0, 'KDH', 'Kupang', '', 'kupang', 'Active', '0', '', '', '', '', '', '', '', '', '', '5.6818', '100.758', '', '', 0),
(214, 145, 0, 'JHR', 'Labis', '', 'labis', 'Active', '0', '', '', '', '', '', '', '', '', '', '2.2604', '103.5458', '', '', 0),
(215, 145, 0, 'NSN', 'Labu', '', 'labu', 'Active', '0', '', '', '', '', '', '', '', '', '', '2.7339', '101.8927', '', '', 0),
(216, 145, 0, 'LBN', 'Labuan', '', 'labuan', 'Active', '0', '', '', '', '', '', '', '', '', '', '5.296', '115.2429', '', '', 0),
(217, 145, 0, 'SBH', 'Lahad Datu', '', 'lahad-datu', 'Active', '0', '', '', '', '', '', '', '', '', '', '5.0434', '118.346', '', '', 0),
(218, 145, 0, 'PRK', 'Lambor Kanan', '', 'lambor-kanan', 'Active', '0', '', '', '', '', '', '', '', '', '', '4.385', '100.9163', '', '', 0),
(219, 145, 0, 'PHG', 'Lanchang', '', 'lanchang', 'Active', '0', '', '', '', '', '', '', '', '', '', '3.5547', '102.265', '', '', 0),
(220, 145, 0, 'KDH', 'Langgar', '', 'langgar', 'Active', '0', '', '', '', '', '', '', '', '', '', '6.0479', '100.407', '', '', 0),
(221, 145, 0, 'PRK', 'Langkap', '', 'langkap', 'Active', '0', '', '', '', '', '', '', '', '', '', '4.2015', '101.0814', '', '', 0),
(222, 145, 0, 'KDH', 'Langkawi', '', 'langkawi', 'Active', '0', '', '', '', '', '', '', '', '', '', '6.2439', '99.9533', '', '', 0),
(223, 145, 0, 'SRW', 'Lawas', '', 'lawas', 'Active', '0', '', '', '', '', '', '', '', '', '', '3.9117', '114.0909', '', '', 0),
(224, 145, 0, 'JHR', 'Layang-Layang', '', 'layang-layang', 'Active', '0', '', '', '', '', '', '', '', '', '', '1.7832', '103.4388', '', '', 0),
(225, 145, 0, 'PRK', 'Lenggong', '', 'lenggong', 'Active', '0', '', '', '', '', '', '', '', '', '', '4.9846', '100.973', '', '', 0),
(226, 145, 0, 'SBH', 'Likas', '', 'likas', 'Active', '0', '', '', '', '', '', '', '', '', '', '6.008', '116.1256', '', '', 0),
(227, 145, 0, 'SRW', 'Limbang', '', 'limbang', 'Active', '0', '', '', '', '', '', '', '', '', '', '4.1371', '114.6005', '', '', 0),
(228, 145, 0, 'SRW', 'Lingga', '', 'lingga', 'Active', '0', '', '', '', '', '', '', '', '', '', '1.3306', '111.1952', '', '', 0),
(229, 145, 0, 'NSN', 'Linggi', '', 'linggi', 'Active', '0', '', '', '', '', '', '', '', '', '', '2.5272', '102.026', '', '', 0),
(230, 145, 0, 'SRW', 'Long Lama', '', 'long-lama', 'Active', '0', '', '', '', '', '', '', '', '', '', '3.9671', '114.2984', '', '', 0),
(231, 145, 0, 'SRW', 'Lubok Antu', '', 'lubok-antu', 'Active', '0', '', '', '', '', '', '', '', '', '', '1.2548', '111.6771', '', '', 0),
(232, 145, 0, 'MLK', 'Lubok China', '', 'lubok-china', 'Active', '0', '', '', '', '', '', '', '', '', '', '2.4326', '102.1127', '', '', 0),
(233, 145, 0, 'PRK', 'Lumut', '', 'lumut', 'Active', '0', '', '', '', '', '', '', '', '', '', '4.317', '100.7977', '', '', 0),
(234, 145, 0, 'KDH', 'Lunas', '', 'lunas', 'Active', '0', '', '', '', '', '', '', '', '', '', '5.5071', '100.5589', '', '', 0),
(235, 145, 0, 'SRW', 'Lundu', '', 'lundu', 'Active', '0', '', '', '', '', '', '', '', '', '', '1.6733', '109.8363', '', '', 0),
(236, 145, 0, 'PHG', 'Lurah Bilut', '', 'lurah-bilut', 'Active', '0', '', '', '', '', '', '', '', '', '', '3.6623', '101.9202', '', '', 0),
(237, 145, 0, 'SRW', 'Lutong', '', 'lutong', 'Active', '0', '', '', '', '', '', '', '', '', '', '4.4803', '114.0108', '', '', 0),
(238, 145, 0, 'KTN', 'Machang', '', 'machang', 'Active', '0', '', '', '', '', '', '', '', '', '', '5.7573', '102.2168', '', '', 0),
(239, 145, 0, 'PRK', 'Malim Nawar', '', 'malim-nawar', 'Active', '0', '', '', '', '', '', '', '', '', '', '4.3844', '101.1174', '', '', 0),
(240, 145, 0, 'PRK', 'Mambang Di Awan', '', 'mambang-di-awan', 'Active', '0', '', '', '', '', '', '', '', '', '', '4.4423', '101.1131', '', '', 0),
(241, 145, 0, 'PRK', 'Manong', '', 'manong', 'Active', '0', '', '', '', '', '', '', '', '', '', '4.6523', '100.8827', '', '', 0),
(242, 145, 0, 'NSN', 'Mantin', '', 'mantin', 'Active', '0', '', '', '', '', '', '', '', '', '', '2.8078', '101.9088', '', '', 0),
(243, 145, 0, 'TRG', 'Marang', '', 'marang', 'Active', '0', '', '', '', '', '', '', '', '', '', '5.2424', '103.126', '', '', 0),
(244, 145, 0, 'JHR', 'Masai', '', 'masai', 'Active', '0', '', '', '', '', '', '', '', '', '', '1.5558', '103.7616', '', '', 0),
(245, 145, 0, 'MLK', 'Masjid Tanah', '', 'masjid-tanah', 'Active', '0', '', '', '', '', '', '', '', '', '', '2.3301', '102.1472', '', '', 0),
(246, 145, 0, 'PRK', 'Matang', '', 'matang', 'Active', '0', '', '', '', '', '', '', '', '', '', '4.7804', '100.7247', '', '', 0),
(247, 145, 0, 'SRW', 'Matu', '', 'matu', 'Active', '0', '', '', '', '', '', '', '', '', '', '2.6413', '111.4437', '', '', 0),
(248, 145, 0, 'MLK', 'Melaka', '', 'melaka', 'Active', '0', '', '', '', '', '', '', '', '', '', '2.2019', '102.2518', '', '', 0),
(249, 145, 0, 'KTN', 'Melor', '', 'melor', 'Active', '0', '', '', '', '', '', '', '', '', '', '5.92', '102.2742', '', '', 0),
(250, 145, 0, 'SBH', 'Membakut', '', 'membakut', 'Active', '0', '', '', '', '', '', '', '', '', '', '5.5243', '115.6889', '', '', 0),
(251, 145, 0, 'PHG', 'Mentakab', '', 'mentakab', 'Active', '0', '', '', '', '', '', '', '', '', '', '3.5435', '102.3122', '', '', 0),
(252, 145, 0, 'SBH', 'Menumbok', '', 'menumbok', 'Active', '0', '', '', '', '', '', '', '', '', '', '5.3398', '115.3766', '', '', 0),
(253, 145, 0, 'KDH', 'Merbok', '', 'merbok', 'Active', '0', '', '', '', '', '', '', '', '', '', '5.7262', '100.4529', '', '', 0),
(254, 145, 0, 'MLK', 'Merlimau', '', 'merlimau', 'Active', '0', '', '', '', '', '', '', '', '', '', '2.198', '102.3718', '', '', 0),
(255, 145, 0, 'JHR', 'Mersing', '', 'mersing', 'Active', '0', '', '', '', '', '', '', '', '', '', '2.3043', '103.7599', '', '', 0),
(256, 145, 0, 'SRW', 'Miri', '', 'miri', 'Active', '0', '', '', '', '', '', '', '', '', '', '4.2678', '113.9692', '', '', 0),
(257, 145, 0, 'PHG', 'Muadzam Shah', '', 'muadzam-shah', 'Active', '0', '', '', '', '', '', '', '', '', '', '3.2041', '102.8052', '', '', 0),
(258, 145, 0, 'JHR', 'Muar', '', 'muar', 'Active', '0', '', '', '', '', '', '', '', '', '', '2.0051', '102.7335', '', '', 0),
(259, 145, 0, 'SRW', 'Mukah', '', 'mukah', 'Active', '0', '', '', '', '', '', '', '', '', '', '2.4118', '112.0435', '', '', 0),
(260, 145, 0, 'SBH', 'Nabawan', '', 'nabawan', 'Active', '0', '', '', '', '', '', '', '', '', '', '4.7676', '116.4017', '', '', 0),
(261, 145, 0, 'SRW', 'Nanga Medamit', '', 'nanga-medamit', 'Active', '0', '', '', '', '', '', '', '', '', '', '2.5574', '113.0012', '', '', 0),
(262, 145, 0, 'SRW', 'Niah', '', 'niah', 'Active', '0', '', '', '', '', '', '', '', '', '', '3.195', '112.6848', '', '', 0),
(263, 145, 0, 'PNG', 'Nibong Tebal', '', 'nibong-tebal', 'Active', '0', '', '', '', '', '', '', '', '', '', '5.2141', '100.4518', '', '', 0),
(264, 145, 0, 'NSN', 'Nilai', '', 'nilai', 'Active', '0', '', '', '', '', '', '', '', '', '', '2.8093', '101.8334', '', '', 0),
(265, 145, 0, 'JHR', 'Nusajaya', '', 'nusajaya', 'Active', '0', '', '', '', '', '', '', '', '', '', '1.5014', '103.6439', '', '', 0),
(266, 145, 0, 'PLS', 'Padang Besar', '', 'padang-besar', 'Active', '0', '', '', '', '', '', '', '', '', '', '6.5341', '100.31', '', '', 0),
(267, 145, 0, 'PRK', 'Padang Rengas', '', 'padang-rengas', 'Active', '0', '', '', '', '', '', '', '', '', '', '4.8174', '100.8677', '', '', 0),
(268, 145, 0, 'KDH', 'Padang Serai', '', 'padang-serai', 'Active', '0', '', '', '', '', '', '', '', '', '', '5.5331', '100.5534', '', '', 0),
(269, 145, 0, 'PHG', 'Padang Tengku', '', 'padang-tengku', 'Active', '0', '', '', '', '', '', '', '', '', '', '4.1907', '102.0495', '', '', 0),
(270, 145, 0, 'JHR', 'Pagoh', '', 'pagoh', 'Active', '0', '', '', '', '', '', '', '', '', '', '2.087', '102.8871', '', '', 0),
(271, 145, 0, 'TRG', 'Paka', '', 'paka', 'Active', '0', '', '', '', '', '', '', '', '', '', '4.7314', '103.358', '', '', 0),
(272, 145, 0, 'JHR', 'Paloh', '', 'paloh', 'Active', '0', '', '', '', '', '', '', '', '', '', '2.1593', '103.507', '', '', 0),
(273, 145, 0, 'SBH', 'Pamol', '', 'pamol', 'Active', '0', '', '', '', '', '', '', '', '', '', '6.0793', '117.5024', '', '', 0),
(274, 145, 0, 'JHR', 'Panchor', '', 'panchor', 'Active', '0', '', '', '', '', '', '', '', '', '', '2.0423', '102.9538', '', '', 0),
(275, 145, 0, 'PRK', 'Pangkor', '', 'pangkor', 'Active', '0', '', '', '', '', '', '', '', '', '', '4.2597', '100.6095', '', '', 0),
(276, 145, 0, 'PRK', 'Pantai Remis', '', 'pantai-remis', 'Active', '0', '', '', '', '', '', '', '', '', '', '4.5708', '100.6901', '', '', 0),
(277, 145, 0, 'SBH', 'Papar', '', 'papar', 'Active', '0', '', '', '', '', '', '', '', '', '', '5.5174', '115.9036', '', '', 0),
(278, 145, 0, 'PRK', 'Parit', '', 'parit', 'Active', '0', '', '', '', '', '', '', '', '', '', '4.5504', '100.9064', '', '', 0),
(279, 145, 0, 'PRK', 'Parit Buntar', '', 'parit-buntar', 'Active', '0', '', '', '', '', '', '', '', '', '', '4.907', '100.6029', '', '', 0),
(280, 145, 0, 'JHR', 'Parit Jawa', '', 'parit-jawa', 'Active', '0', '', '', '', '', '', '', '', '', '', '1.9152', '102.8197', '', '', 0),
(281, 145, 0, 'JHR', 'Parit Raja', '', 'parit-raja', 'Active', '0', '', '', '', '', '', '', '', '', '', '1.8605', '103.1004', '', '', 0),
(282, 145, 0, 'JHR', 'Parit Sulong', '', 'parit-sulong', 'Active', '0', '', '', '', '', '', '', '', '', '', '1.9663', '102.9015', '', '', 0),
(283, 145, 0, 'KTN', 'Pasir  Puteh', '', 'pasir-puteh', 'Active', '0', '', '', '', '', '', '', '', '', '', '5.876', '102.3841', '', '', 0),
(284, 145, 0, 'JHR', 'Pasir Gudang', '', 'pasir-gudang', 'Active', '0', '', '', '', '', '', '', '', '', '', '1.5002', '103.8273', '', '', 0),
(285, 145, 0, 'KTN', 'Pasir Mas', '', 'pasir-mas', 'Active', '0', '', '', '', '', '', '', '', '', '', '6.0129', '102.1459', '', '', 0),
(286, 145, 0, 'PHG', 'Pekan', '', 'pekan', 'Active', '0', '', '', '', '', '', '', '', '', '', '3.5374', '103.2801', '', '', 0),
(287, 145, 0, 'SGR', 'Pelabuhan Klang', '', 'pelabuhan-klang', 'Active', '0', '', '', '', '', '', '', '', '', '', '3.0186', '101.4286', '', '', 0),
(288, 145, 0, 'PNG', 'Penaga', '', 'penaga', 'Active', '0', '', '', '', '', '', '', '', '', '', '5.4632', '100.4027', '', '', 0),
(289, 145, 0, 'SBH', 'Penampang', '', 'penampang', 'Active', '0', '', '', '', '', '', '', '', '', '', '5.8883', '116.1026', '', '', 0),
(290, 145, 0, 'PNG', 'Penang Hill', '', 'penang-hill', 'Active', '0', '', '', '', '', '', '', '', '', '', '5.418', '100.2775', '', '', 0),
(291, 145, 0, 'KDH', 'Pendang', '', 'pendang', 'Active', '0', '', '', '', '', '', '', '', '', '', '5.9623', '100.472', '', '', 0),
(292, 145, 0, 'JHR', 'Pengerang', '', 'pengerang', 'Active', '0', '', '', '', '', '', '', '', '', '', '1.4656', '103.9435', '', '', 0),
(293, 145, 0, 'PRK', 'Pengkalan Hulu', '', 'pengkalan-hulu', 'Active', '0', '', '', '', '', '', '', '', '', '', '5.4731', '101.0105', '', '', 0),
(294, 145, 0, 'PNG', 'Perai', '', 'perai', 'Active', '0', '', '', '', '', '', '', '', '', '', '5.3769', '100.3848', '', '', 0),
(295, 145, 0, 'TRG', 'Permaisuri', '', 'permaisuri', 'Active', '0', '', '', '', '', '', '', '', '', '', '5.4698', '102.8602', '', '', 0),
(296, 145, 0, 'PNG', 'Permatang Pauh', '', 'permatang-pauh', 'Active', '0', '', '', '', '', '', '', '', '', '', '5.3934', '100.4107', '', '', 0),
(297, 145, 0, 'SGR', 'Petaling Jaya', '', 'petaling-jaya', 'Active', '0', '', '', '', '', '', '', '', '', '', '3.107', '101.6305', '', '', 0),
(298, 145, 0, 'KDH', 'Pokok Sena', '', 'pokok-sena', 'Active', '0', '', '', '', '', '', '', '', '', '', '6.1542', '100.5613', '', '', 0),
(299, 145, 0, 'JHR', 'Pontian', '', 'pontian', 'Active', '0', '', '', '', '', '', '', '', '', '', '1.5666', '103.3873', '', '', 0),
(300, 145, 0, 'NSN', 'Port Dickson', '', 'port-dickson', 'Active', '0', '', '', '', '', '', '', '', '', '', '2.5932', '101.8413', '', '', 0),
(301, 145, 0, 'SGR', 'Puchong', '', 'puchong', 'Active', '0', '', '', '', '', '', '', '', '', '', '3.0757', '101.6198', '', '', 0),
(302, 145, 0, 'KTN', 'Pulai Chondong', '', 'pulai-chondong', 'Active', '0', '', '', '', '', '', '', '', '', '', '5.8908', '102.2376', '', '', 0),
(303, 145, 0, 'SGR', 'Pulau Carey', '', 'pulau-carey', 'Active', '0', '', '', '', '', '', '', '', '', '', '2.8879', '101.3913', '', '', 0),
(304, 145, 0, 'SGR', 'Pulau Ketam', '', 'pulau-ketam', 'Active', '0', '', '', '', '', '', '', '', '', '', '2.9555', '101.3268', '', '', 0),
(305, 145, 0, 'PNG', 'Pulau Pinang', '', 'pulau-pinang', 'Active', '0', '', '', '', '', '', '', '', '', '', '5.4166', '100.3305', '', '', 0),
(306, 145, 0, 'SRW', 'Pusa', '', 'pusa', 'Active', '0', '', '', '', '', '', '', '', '', '', '1.6097', '111.4337', '', '', 0),
(307, 145, 0, 'NSN', 'Pusat  Bandar P', '', 'pusat-bandar-p', 'Active', '0', '', '', '', '', '', '', '', '', '', '2.7184', '102.5765', '', '', 0),
(308, 145, 0, 'PRK', 'Pusing', '', 'pusing', 'Active', '0', '', '', '', '', '', '', '', '', '', '4.5117', '100.9917', '', '', 0),
(309, 145, 0, 'SBH', 'Putatan', '', 'putatan', 'Active', '0', '', '', '', '', '', '', '', '', '', '5.4204', '116.7968', '', '', 0),
(310, 145, 0, 'PJY', 'Putrajaya', '', 'putrajaya', 'Active', '0', '', '', '', '', '', '', '', '', '', '2.9264', '101.6964', '', '', 0),
(311, 145, 0, 'SBH', 'Ranau', '', 'ranau', 'Active', '0', '', '', '', '', '', '', '', '', '', '5.9589', '116.6402', '', '', 0),
(312, 145, 0, 'NSN', 'Rantau', '', 'rantau', 'Active', '0', '', '', '', '', '', '', '', '', '', '2.589', '101.9629', '', '', 0),
(313, 145, 0, 'KTN', 'Rantau Panjang', '', 'rantau-panjang', 'Active', '0', '', '', '', '', '', '', '', '', '', '5.9632', '102.0073', '', '', 0),
(314, 145, 0, 'SGR', 'Rasa', '', 'rasa', 'Active', '0', '', '', '', '', '', '', '', '', '', '3.3861', '101.6093', '', '', 0),
(315, 145, 0, 'PHG', 'Raub', '', 'raub', 'Active', '0', '', '', '', '', '', '', '', '', '', '3.7577', '101.9827', '', '', 0),
(316, 145, 0, 'SGR', 'Rawang', '', 'rawang', 'Active', '0', '', '', '', '', '', '', '', '', '', '3.2549', '101.5705', '', '', 0),
(317, 145, 0, 'NSN', 'Rembau', '', 'rembau', 'Active', '0', '', '', '', '', '', '', '', '', '', '2.5798', '102.1108', '', '', 0),
(318, 145, 0, 'JHR', 'Rengam', '', 'rengam', 'Active', '0', '', '', '', '', '', '', '', '', '', '1.8498', '103.3555', '', '', 0),
(319, 145, 0, 'JHR', 'Rengit', '', 'rengit', 'Active', '0', '', '', '', '', '', '', '', '', '', '1.664', '103.2453', '', '', 0),
(320, 145, 0, 'PHG', 'Ringlet', '', 'ringlet', 'Active', '0', '', '', '', '', '', '', '', '', '', '4.2961', '101.5451', '', '', 0),
(321, 145, 0, 'SRW', 'Roban', '', 'roban', 'Active', '0', '', '', '', '', '', '', '', '', '', '1.8838', '111.3155', '', '', 0),
(322, 145, 0, 'NSN', 'Rompin', '', 'rompin', 'Active', '0', '', '', '', '', '', '', '', '', '', '2.694', '102.4612', '', '', 0),
(323, 145, 0, 'SGR', 'Sabak Bernam', '', 'sabak-bernam', 'Active', '0', '', '', '', '', '', '', '', '', '', '3.6254', '101.0593', '', '', 0),
(324, 145, 0, 'SBH', 'Sandakan', '', 'sandakan', 'Active', '0', '', '', '', '', '', '', '', '', '', '5.848', '117.9591', '', '', 0),
(325, 145, 0, 'SRW', 'Saratok', '', 'saratok', 'Active', '0', '', '', '', '', '', '', '', '', '', '1.6629', '111.2076', '', '', 0),
(326, 145, 0, 'SRW', 'Sarikei', '', 'sarikei', 'Active', '0', '', '', '', '', '', '', '', '', '', '2.0455', '111.5346', '', '', 0),
(327, 145, 0, 'PRK', 'Sauk', '', 'sauk', 'Active', '0', '', '', '', '', '', '', '', '', '', '4.8496', '100.9456', '', '', 0),
(328, 145, 0, 'SRW', 'Sebauh', '', 'sebauh', 'Active', '0', '', '', '', '', '', '', '', '', '', '2.7811', '112.6702', '', '', 0),
(329, 145, 0, 'SRW', 'Sebuyau', '', 'sebuyau', 'Active', '0', '', '', '', '', '', '', '', '', '', '1.3337', '110.9275', '', '', 0),
(330, 145, 0, 'PHG', 'Sega', '', 'sega', 'Active', '0', '', '', '', '', '', '', '', '', '', '3.9817', '101.9348', '', '', 0),
(331, 145, 0, 'JHR', 'Segamat', '', 'segamat', 'Active', '0', '', '', '', '', '', '', '', '', '', '2.3134', '102.9786', '', '', 0),
(332, 145, 0, 'SGR', 'Sekinchan', '', 'sekinchan', 'Active', '0', '', '', '', '', '', '', '', '', '', '3.3788', '101.2798', '', '', 0),
(333, 145, 0, 'PRK', 'Selama', '', 'selama', 'Active', '0', '', '', '', '', '', '', '', '', '', '4.829', '100.8841', '', '', 0),
(334, 145, 0, 'MLK', 'Selandar', '', 'selandar', 'Active', '0', '', '', '', '', '', '', '', '', '', '2.384', '102.3584', '', '', 0),
(335, 145, 0, 'PRK', 'Selekoh', '', 'selekoh', 'Active', '0', '', '', '', '', '', '', '', '', '', '3.9955', '100.768', '', '', 0),
(336, 145, 0, 'KTN', 'Selising', '', 'selising', 'Active', '0', '', '', '', '', '', '', '', '', '', '5.8899', '102.2958', '', '', 0),
(337, 145, 0, 'SGR', 'Semenyih', '', 'semenyih', 'Active', '0', '', '', '', '', '', '', '', '', '', '2.9982', '101.8017', '', '', 0),
(338, 145, 0, 'JHR', 'Semerah', '', 'semerah', 'Active', '0', '', '', '', '', '', '', '', '', '', '1.9075', '102.8813', '', '', 0),
(339, 145, 0, 'SBH', 'Semporna', '', 'semporna', 'Active', '0', '', '', '', '', '', '', '', '', '', '4.4363', '118.5318', '', '', 0),
(340, 145, 0, 'JHR', 'Senai', '', 'senai', 'Active', '0', '', '', '', '', '', '', '', '', '', '1.6446', '103.5973', '', '', 0),
(341, 145, 0, 'JHR', 'Senggarang', '', 'senggarang', 'Active', '0', '', '', '', '', '', '', '', '', '', '1.8138', '103.0467', '', '', 0),
(342, 145, 0, 'SGR', 'Sepang', '', 'sepang', 'Active', '0', '', '', '', '', '', '', '', '', '', '2.9765', '101.7067', '', '', 0),
(343, 145, 0, 'KDH', 'Serdang', '', 'serdang', 'Active', '0', '', '', '', '', '', '', '', '', '', '5.4765', '100.5938', '', '', 0),
(344, 145, 0, 'NSN', 'Seremban', '', 'seremban', 'Active', '0', '', '', '', '', '', '', '', '', '', '2.8109', '101.9012', '', '', 0),
(345, 145, 0, 'SGR', 'Serendah', '', 'serendah', 'Active', '0', '', '', '', '', '', '', '', '', '', '3.23', '101.6374', '', '', 0),
(346, 145, 0, 'JHR', 'Seri Gading', '', 'seri-gading', 'Active', '0', '', '', '', '', '', '', '', '', '', '1.8197', '103.2399', '', '', 0),
(347, 145, 0, 'SGR', 'Seri Kembangan', '', 'seri-kembangan', 'Active', '0', '', '', '', '', '', '', '', '', '', '3.0383', '101.7094', '', '', 0),
(348, 145, 0, 'PRK', 'Seri Manjung', '', 'seri-manjung', 'Active', '0', '', '', '', '', '', '', '', '', '', '4.602', '100.7979', '', '', 0),
(349, 145, 0, 'SRW', 'Serian', '', 'serian', 'Active', '0', '', '', '', '', '', '', '', '', '', '1.2438', '110.2563', '', '', 0),
(350, 145, 0, 'KUL', 'Setapak', '', 'setapak', 'Active', '0', '', '', '', '', '', '', '', '', '', '3.1876', '101.7102', '', '', 0),
(351, 145, 0, 'SGR', 'Shah Alam', '', 'shah-alam', 'Active', '0', '', '', '', '', '', '', '', '', '', '3.0797', '101.5186', '', '', 0),
(352, 145, 0, 'NSN', 'Si Rusa', '', 'si-rusa', 'Active', '0', '', '', '', '', '', '', '', '', '', '2.5099', '102.0049', '', '', 0),
(353, 145, 0, 'SRW', 'Sibu', '', 'sibu', 'Active', '0', '', '', '', '', '', '', '', '', '', '2.2086', '111.6', '', '', 0),
(354, 145, 0, 'SRW', 'Siburan', '', 'siburan', 'Active', '0', '', '', '', '', '', '', '', '', '', '1.3148', '110.3751', '', '', 0),
(355, 145, 0, 'KDH', 'Sik', '', 'sik', 'Active', '0', '', '', '', '', '', '', '', '', '', '5.8207', '100.6951', '', '', 0),
(356, 145, 0, 'PRK', 'Simpang', '', 'simpang', 'Active', '0', '', '', '', '', '', '', '', '', '', '4.7183', '100.7986', '', '', 0),
(357, 145, 0, 'PLS', 'Simpang Ampat', '', 'simpang-ampat', 'Active', '0', '', '', '', '', '', '', '', '', '', '6.3155', '100.2026', '', '', 0),
(358, 145, 0, 'PRK', 'Simpang Ampat S', '', 'simpang-ampat-s', 'Active', '0', '', '', '', '', '', '', '', '', '', '4.9211', '100.7084', '', '', 0),
(359, 145, 0, 'NSN', 'Simpang Durian', '', 'simpang-durian', 'Active', '0', '', '', '', '', '', '', '', '', '', '3.0168', '102.1793', '', '', 0),
(360, 145, 0, 'KDH', 'Simpang Empat', '', 'simpang-empat', 'Active', '0', '', '', '', '', '', '', '', '', '', '6.013', '100.4018', '', '', 0),
(361, 145, 0, 'NSN', 'Simpang Pertang', '', 'simpang-pertang', 'Active', '0', '', '', '', '', '', '', '', '', '', '3.018', '102.3018', '', '', 0),
(362, 145, 0, 'JHR', 'Simpang Rengam', '', 'simpang-rengam', 'Active', '0', '', '', '', '', '', '', '', '', '', '1.881', '103.3957', '', '', 0),
(363, 145, 0, 'SRW', 'Simunjan', '', 'simunjan', 'Active', '0', '', '', '', '', '', '', '', '', '', '1.2657', '110.8125', '', '', 0),
(364, 145, 0, 'SBH', 'Sipitang', '', 'sipitang', 'Active', '0', '', '', '', '', '', '', '', '', '', '5.0331', '115.5728', '', '', 0),
(365, 145, 0, 'PRK', 'Sitiawan', '', 'sitiawan', 'Active', '0', '', '', '', '', '', '', '', '', '', '4.3227', '100.8021', '', '', 0),
(366, 145, 0, 'PRK', 'Slim River', '', 'slim-river', 'Active', '0', '', '', '', '', '', '', '', '', '', '4.0303', '101.294', '', '', 0),
(367, 145, 0, 'SRW', 'Song', '', 'song', 'Active', '0', '', '', '', '', '', '', '', '', '', '1.735', '112.533', '', '', 0),
(368, 145, 0, 'SRW', 'Spaoh', '', 'spaoh', 'Active', '0', '', '', '', '', '', '', '', '', '', '1.6533', '111.5983', '', '', 0),
(369, 145, 0, 'SRW', 'Sri Aman', '', 'sri-aman', 'Active', '0', '', '', '', '', '', '', '', '', '', '1.3177', '111.3894', '', '', 0),
(370, 145, 0, 'JHR', 'Sri Medan', '', 'sri-medan', 'Active', '0', '', '', '', '', '', '', '', '', '', '1.5084', '103.7136', '', '', 0);
INSERT INTO `fc_cities` (`id`, `countryid`, `stateid`, `state_code`, `name`, `contid`, `seourl`, `status`, `featured`, `description`, `meta_title`, `meta_keyword`, `meta_description`, `citylogo`, `citythumb`, `neighborhoods`, `tags`, `short_description`, `latitude`, `longitude`, `get_around`, `known_for`, `view_order`) VALUES
(371, 145, 0, 'SGR', 'Subang Airport', '', 'subang-airport', 'Active', '0', '', '', '', '', '', '', '', '', '', '3.1851', '101.6275', '', '', 0),
(372, 145, 0, 'SGR', 'Subang Jaya', '', 'subang-jaya', 'Active', '0', '', '', '', '', '', '', '', '', '', '3.0542', '101.5949', '', '', 0),
(373, 145, 0, 'SRW', 'Sundar', '', 'sundar', 'Active', '0', '', '', '', '', '', '', '', '', '', '3.9777', '114.0651', '', '', 0),
(374, 145, 0, 'SGR', 'Sungai Ayer Taw', '', 'sungai-ayer-taw', 'Active', '0', '', '', '', '', '', '', '', '', '', '3.776', '100.875', '', '', 0),
(375, 145, 0, 'SGR', 'Sungai Besar', '', 'sungai-besar', 'Active', '0', '', '', '', '', '', '', '', '', '', '3.5615', '101.146', '', '', 0),
(376, 145, 0, 'SGR', 'Sungai Buloh', '', 'sungai-buloh', 'Active', '0', '', '', '', '', '', '', '', '', '', '3.1618', '101.598', '', '', 0),
(377, 145, 0, 'PHG', 'Sungai Koyan', '', 'sungai-koyan', 'Active', '0', '', '', '', '', '', '', '', '', '', '4.1582', '101.84', '', '', 0),
(378, 145, 0, 'PHG', 'Sungai Lembing', '', 'sungai-lembing', 'Active', '0', '', '', '', '', '', '', '', '', '', '3.8104', '102.9129', '', '', 0),
(379, 145, 0, 'JHR', 'Sungai Mati', '', 'sungai-mati', 'Active', '0', '', '', '', '', '', '', '', '', '', '1.5141', '103.7014', '', '', 0),
(380, 145, 0, 'SGR', 'Sungai Pelek', '', 'sungai-pelek', 'Active', '0', '', '', '', '', '', '', '', '', '', '2.8526', '101.632', '', '', 0),
(381, 145, 0, 'KDH', 'Sungai Petani', '', 'sungai-petani', 'Active', '0', '', '', '', '', '', '', '', '', '', '5.6639', '100.4902', '', '', 0),
(382, 145, 0, 'MLK', 'Sungai Rambai', '', 'sungai-rambai', 'Active', '0', '', '', '', '', '', '', '', '', '', '2.1368', '102.5051', '', '', 0),
(383, 145, 0, 'MLK', 'Sungai Rambai''', '', 'sungai-rambai', 'Active', '0', '', '', '', '', '', '', '', '', '', '2.1368', '102.5051', '', '', 0),
(384, 145, 0, 'PRK', 'Sungai Siput', '', 'sungai-siput', 'Active', '0', '', '', '', '', '', '', '', '', '', '4.9134', '101.0665', '', '', 0),
(385, 145, 0, 'PRK', 'Sungai Sumun', '', 'sungai-sumun', 'Active', '0', '', '', '', '', '', '', '', '', '', '4.0448', '100.8621', '', '', 0),
(386, 145, 0, 'TRG', 'Sungai Tong', '', 'sungai-tong', 'Active', '0', '', '', '', '', '', '', '', '', '', '5.2448', '102.8795', '', '', 0),
(387, 145, 0, 'MLK', 'Sungai Udang', '', 'sungai-udang', 'Active', '0', '', '', '', '', '', '', '', '', '', '2.2867', '102.1406', '', '', 0),
(388, 145, 0, 'PRK', 'Sungkai', '', 'sungkai', 'Active', '0', '', '', '', '', '', '', '', '', '', '4.112', '101.2529', '', '', 0),
(389, 145, 0, 'PRK', 'Taiping', '', 'taiping', 'Active', '0', '', '', '', '', '', '', '', '', '', '4.7969', '100.7934', '', '', 0),
(390, 145, 0, 'SBH', 'Tambunan', '', 'tambunan', 'Active', '0', '', '', '', '', '', '', '', '', '', '5.6933', '116.3797', '', '', 0),
(391, 145, 0, 'SBH', 'Tamparuli', '', 'tamparuli', 'Active', '0', '', '', '', '', '', '', '', '', '', '6.117', '116.2675', '', '', 0),
(392, 145, 0, 'NSN', 'Tampin', '', 'tampin', 'Active', '0', '', '', '', '', '', '', '', '', '', '2.5687', '102.1824', '', '', 0),
(393, 145, 0, 'KTN', 'Tanah Merah', '', 'tanah-merah', 'Active', '0', '', '', '', '', '', '', '', '', '', '5.7687', '102.1201', '', '', 0),
(394, 145, 0, 'PHG', 'Tanah Rata', '', 'tanah-rata', 'Active', '0', '', '', '', '', '', '', '', '', '', '4.3972', '101.4559', '', '', 0),
(395, 145, 0, 'JHR', 'Tangkak', '', 'tangkak', 'Active', '0', '', '', '', '', '', '', '', '', '', '2.1462', '102.7848', '', '', 0),
(396, 145, 0, 'PNG', 'Tanjong Bungah', '', 'tanjong-bungah', 'Active', '0', '', '', '', '', '', '', '', '', '', '5.4515', '100.2943', '', '', 0),
(397, 145, 0, 'NSN', 'Tanjong Ipoh', '', 'tanjong-ipoh', 'Active', '0', '', '', '', '', '', '', '', '', '', '2.73', '102.1526', '', '', 0),
(398, 145, 0, 'SGR', 'Tanjong Karang', '', 'tanjong-karang', 'Active', '0', '', '', '', '', '', '', '', '', '', '3.316', '101.3201', '', '', 0),
(399, 145, 0, 'MLK', 'Tanjong Kling', '', 'tanjong-kling', 'Active', '0', '', '', '', '', '', '', '', '', '', '2.2376', '102.1588', '', '', 0),
(400, 145, 0, 'PRK', 'Tanjong Malim', '', 'tanjong-malim', 'Active', '0', '', '', '', '', '', '', '', '', '', '3.9159', '101.3812', '', '', 0),
(401, 145, 0, 'PRK', 'Tanjong Piandan', '', 'tanjong-piandan', 'Active', '0', '', '', '', '', '', '', '', '', '', '4.9011', '100.5731', '', '', 0),
(402, 145, 0, 'PRK', 'Tanjong Rambuta', '', 'tanjong-rambuta', 'Active', '0', '', '', '', '', '', '', '', '', '', '4.5601', '101.1448', '', '', 0),
(403, 145, 0, 'SGR', 'Tanjong Sepat', '', 'tanjong-sepat', 'Active', '0', '', '', '', '', '', '', '', '', '', '2.7691', '101.5625', '', '', 0),
(404, 145, 0, 'PRK', 'Tanjong Tualang', '', 'tanjong-tualang', 'Active', '0', '', '', '', '', '', '', '', '', '', '4.3912', '101.0461', '', '', 0),
(405, 145, 0, 'SBH', 'Tanjung Aru', '', 'tanjung-aru', 'Active', '0', '', '', '', '', '', '', '', '', '', '5.9771', '116.0678', '', '', 0),
(406, 145, 0, 'PRK', 'Tapah', '', 'tapah', 'Active', '0', '', '', '', '', '', '', '', '', '', '4.3279', '101.1595', '', '', 0),
(407, 145, 0, 'PRK', 'Tapah Road', '', 'tapah-road', 'Active', '0', '', '', '', '', '', '', '', '', '', '4.2684', '101.1236', '', '', 0),
(408, 145, 0, 'PNG', 'Tasek Gelugor', '', 'tasek-gelugor', 'Active', '0', '', '', '', '', '', '', '', '', '', '5.4558', '100.4549', '', '', 0),
(409, 145, 0, 'PNG', 'Tasek Gelugur', '', 'tasek-gelugur', 'Active', '0', '', '', '', '', '', '', '', '', '', '5.2632', '100.4846', '', '', 0),
(410, 145, 0, 'SRW', 'Tatau', '', 'tatau', 'Active', '0', '', '', '', '', '', '', '', '', '', '2.5733', '112.6906', '', '', 0),
(411, 145, 0, 'SBH', 'Tawau', '', 'tawau', 'Active', '0', '', '', '', '', '', '', '', '', '', '4.2901', '117.8994', '', '', 0),
(412, 145, 0, 'SGR', 'Telok Panglima ', '', 'telok-panglima', 'Active', '0', '', '', '', '', '', '', '', '', '', '3.0195', '101.5246', '', '', 0),
(413, 145, 0, 'PRK', 'Teluk Intan', '', 'teluk-intan', 'Active', '0', '', '', '', '', '', '', '', '', '', '4.1739', '101.0194', '', '', 0),
(414, 145, 0, 'KTN', 'Temangan', '', 'temangan', 'Active', '0', '', '', '', '', '', '', '', '', '', '5.7612', '102.1769', '', '', 0),
(415, 145, 0, 'PHG', 'Temerloh', '', 'temerloh', 'Active', '0', '', '', '', '', '', '', '', '', '', '3.484', '102.4266', '', '', 0),
(416, 145, 0, 'PRK', 'Temoh', '', 'temoh', 'Active', '0', '', '', '', '', '', '', '', '', '', '4.3504', '101.1622', '', '', 0),
(417, 145, 0, 'SBH', 'Tenghilan', '', 'tenghilan', 'Active', '0', '', '', '', '', '', '', '', '', '', '5.9977', '116.529', '', '', 0),
(418, 145, 0, 'SBH', 'Tenom', '', 'tenom', 'Active', '0', '', '', '', '', '', '', '', '', '', '4.9839', '115.93', '', '', 0),
(419, 145, 0, 'PRK', 'TLDM Lumut', '', 'tldm-lumut', 'Active', '0', '', '', '', '', '', '', '', '', '', '4.8073', '100.8', '', '', 0),
(420, 145, 0, 'PHG', 'Triang', '', 'triang', 'Active', '0', '', '', '', '', '', '', '', '', '', '3.4051', '102.6233', '', '', 0),
(421, 145, 0, 'PRK', 'Trolak', '', 'trolak', 'Active', '0', '', '', '', '', '', '', '', '', '', '3.9577', '101.3342', '', '', 0),
(422, 145, 0, 'PRK', 'Trong', '', 'trong', 'Active', '0', '', '', '', '', '', '', '', '', '', '4.6539', '100.7739', '', '', 0),
(423, 145, 0, 'PRK', 'Tronoh', '', 'tronoh', 'Active', '0', '', '', '', '', '', '', '', '', '', '4.4306', '101.014', '', '', 0),
(424, 145, 0, 'SBH', 'Tuaran', '', 'tuaran', 'Active', '0', '', '', '', '', '', '', '', '', '', '6.132', '116.2069', '', '', 0),
(425, 145, 0, 'KTN', 'Tumpat', '', 'tumpat', 'Active', '0', '', '', '', '', '', '', '', '', '', '6.1411', '102.1763', '', '', 0),
(426, 145, 0, 'PRK', 'Ulu Bernam', '', 'ulu-bernam', 'Active', '0', '', '', '', '', '', '', '', '', '', '3.9111', '101.2078', '', '', 0),
(427, 145, 0, 'PRK', 'Ulu Kinta', '', 'ulu-kinta', 'Active', '0', '', '', '', '', '', '', '', '', '', '4.6008', '101.1007', '', '', 0),
(428, 145, 0, 'JHR', 'Ulu Tiram', '', 'ulu-tiram', 'Active', '0', '', '', '', '', '', '', '', '', '', '1.6728', '103.6325', '', '', 0),
(429, 145, 0, 'KDH', 'Universiti Utar', '', 'universiti-utar', 'Active', '0', '', '', '', '', '', '', '', '', '', '6.4574', '100.506', '', '', 0),
(430, 145, 0, 'PNG', 'USM Pulau Pinan', '', 'usm-pulau-pinan', 'Active', '0', '', '', '', '', '', '', '', '', '', '5.3572', '100.3055', '', '', 0),
(431, 145, 0, 'KTN', 'Wakaf Bharu', '', 'wakaf-bharu', 'Active', '0', '', '', '', '', '', '', '', '', '', '6.0573', '102.1743', '', '', 0),
(432, 145, 0, 'KDH', 'Yan', '', 'yan', 'Active', '0', '', '', '', '', '', '', '', '', '', '5.8366', '100.4039', '', '', 0),
(433, 145, 0, 'JHR', 'Yong Peng', '', 'yong-peng', 'Active', '0', '', '', '', '', '', '', '', '', '', '1.9139', '103.1326', '', '', 0),
(435, 215, 4, '', 'Brickworks estate', '', 'brickworks-estate', 'Active', '0', '', '', '', '', '1430997868-Chrysanthemum.jpg', 'Chrysanthemum.jpg', '0', '', '', '37.77264', '-122.40992', '', '', 0),
(437, 215, 51, '', 'Philadelphia', '', 'philadelphia', 'Active', '0', '', '', '', '', '1432132012-pennsylvania-fall-widescreen-0021.jpg', 'pennsylvania-fall-widescreen-0021.jpg', '0', '', '', '39.95258', '-75.16522', '', '', 0),
(438, 215, 862, '', 'Los Angeles', '', 'los-angeles', 'Active', '0', '', '', '', '', '1432132277-Los-Angeles1.jpg', 'Los-Angeles1.jpg', '0', '', '', '34.05223', '-118.24368', '', '', 0),
(439, 215, 23, '', 'Chicago', '', 'chicago', 'Active', '0', '', '', '', '', '1432132410-ChicagoSkyline12.jpg', 'ChicagoSkyline12.jpg', '0', '', '', '41.87811', '-87.62980', '', '', 0),
(440, 215, 21, '', 'Lahaina', '', 'lahaina', 'Active', '0', '', '', '', '', '1434898101-us-hi-lahaina.jpg', 'us-hi-lahaina.jpg', '0', '', '', '20.87833', '-156.68250', '', '', 0),
(441, 70, 866, '', 'london', '', 'london', 'Active', '0', '', '', '', '', '1434980703-images.jpeg', 'images.jpeg', '0', '', '', '52.35552', '-1.17432', '', '', 0),
(442, 152, 0, '', 'Rotterdam', '', 'rotterdam', 'Active', '1', '', '', '', '', '1436033047-41127_fullimage_Rotterdam-skyline.jpg', '41127_fullimage_Rotterdam-skyline.jpg', '0', '', '', '51.92442', '4.47773', '', '', 0),
(443, 95, 0, '', 'Bangalore', '', 'bangalore', 'Active', '0', '', '', '', '', '1436162897-29525F-1331010088-Brand_Factory_-__Marathalli.jpeg', '29525F-1331010088-Brand_Factory_-__Marathalli.jpeg', '0', '', '', '12.97160', '77.59456', '', '', 0),
(446, 215, 4, '', 'Arizona', '', 'arizona', 'Active', '0', '', '', '', '', '1437821495-Arizona.jpg', 'Arizona.jpg', '0', '', '', '34.04893', '-111.09373', '', '', 0),
(447, 200, 0, '', 'Chiang Mai', '', 'chiang-mai', 'Active', '0', '', '', '', '', '1438053313-android-chrome-96x96.png', 'android-chrome-96x96.png', '0', '', '', '18.78775', '98.99313', '', '', 0),
(448, 207, 873, '', 'Osmangazi', '', 'osmangazi', 'Active', '0', '', '', '', '', '1439068807-bursa.jpg', 'bursa.jpg', '0', '', '', '40.18853', '29.06096', '', '', 0);

-- --------------------------------------------------------

--
-- Table structure for table `fc_cities_old`
--

CREATE TABLE IF NOT EXISTS `fc_cities_old` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `countryid` int(11) NOT NULL,
  `stateid` int(11) NOT NULL,
  `state_code` varchar(32) NOT NULL,
  `name` varchar(32) NOT NULL,
  `contid` varchar(50) NOT NULL,
  `seourl` varchar(250) NOT NULL,
  `status` enum('InActive','Active') NOT NULL,
  `featured` enum('0','1') NOT NULL,
  `description` longblob NOT NULL,
  `meta_title` varchar(1000) NOT NULL,
  `meta_keyword` varchar(1000) NOT NULL,
  `meta_description` blob NOT NULL,
  `citylogo` varchar(1000) NOT NULL,
  `citythumb` varchar(1000) NOT NULL,
  `neighborhoods` varchar(1000) NOT NULL,
  `tags` varchar(1000) NOT NULL,
  `short_description` varchar(1000) NOT NULL,
  `latitude` varchar(1000) NOT NULL,
  `longitude` varchar(1000) NOT NULL,
  `get_around` varchar(1000) NOT NULL,
  `known_for` varchar(1000) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=892 ;

--
-- Dumping data for table `fc_cities_old`
--

INSERT INTO `fc_cities_old` (`id`, `countryid`, `stateid`, `state_code`, `name`, `contid`, `seourl`, `status`, `featured`, `description`, `meta_title`, `meta_keyword`, `meta_description`, `citylogo`, `citythumb`, `neighborhoods`, `tags`, `short_description`, `latitude`, `longitude`, `get_around`, `known_for`) VALUES
(872, 0, 41, '', 'Newark', '', 'newark', 'Active', '1', 0x3c703e796f75206172652077697468696e2077616c6b696e672064697374616e636520746f2074686520747261696e2c207468652062656163682c2073686f7070696e672c2072657374617572616e74732c20796f67612c206172742067616c6c65726965732c20616e64206d757369632076656e7565732e3c2f703e, '', '', '', 'city.jpg', 'city2.jpg', '871', 'style', 'you are within walking distance to the train, the beach, shopping, restaurants, yoga, art galleries, and music venues.', '40.735657', '-74.1723667', '', ''),
(873, 215, 4, '', 'Phoenix', '', 'phoenix', 'Active', '1', 0x3c646c3e3c64643e0d0a3c703e4c6f636174656420696e2074686520487564736f6e2056616c6c65792c20616e64206a75737420612073686f72742064726976652066726f6d2074686520204265726b7368697265732c20416e6372616d64616c6520697320612062757267656f6e696e67206661726d696e6720636f6d6d756e6974792e202054686572652061726520206d616e7920736d616c6c20746f776e732061726f756e6420746861742065616368206f66666572207468656972206f776e20756e6971756520616374697669746965732c202072657374617572616e74732c2073746f7265732e2020546865726520697320616e20756e636f756e7461626c6520616d6f756e74206f66207468696e677320746f20646f20696e202074686520617265612c2066726f6d2068696b696e672c20746f20736b69696e672c20746f206b6179616b696e6720616e642063616e6f65696e672e2020204f6e2074686520207765656b656e647320746865726520617265206661726d657273206d61726b65747320696e20616c6c2074686520746f776e73206f66666572696e6720677265617420206c6f63616c6c792067726f776e2070726f6475636520616e64206372616674732e3c2f703e0d0a3c703e4f7572206f776e206661726d2073746f726520616c736f20686173206d616e79206c6f63616c2070726f64756374732061732077656c6c206173206f7572206f776e202047726173732066656420426565662c20506f726b2c204c616d6220616e6420636869636b656e20616e64206f7572206f776e204368617263757465726965206d616465206f6e2020746865206661726d2e3c2f703e0d0a3c2f64643e3c2f646c3e, '', '', '', '11.jpg', '24260521.jpg', '0', 'newark', 'Located in the Hudson Valley, and just a short drive from the Berkshires, Ancramdale is a burgeoning farming community. There are many small towns around that each offer their own unique activities, restaurants, stores. ', '33.44838', '-112.07404', 'Public Transit', 'La Sagrada Familia, GaudÃƒÆ’Ã†â€™Ãƒâ€ Ã¢â‚¬â„¢ÃƒÆ’Ã¢â‚¬Å¡Ãƒâ€šÃ‚Â­, FC Barcelona, Las Ramblas, warm sun and cool beaches, avant-garde architecture, museums, and music, gastronomic pioneers'),
(871, 0, 12, '', 'San Francisco', '', 'san-francisco', 'Active', '1', 0x3c703e496620616e2061646472657373206861732074776f20636f6e666c696374696e67206c696e65732c2073756368206173206120706f7374206f666669636520626f78206c696e653c6272202f3e20616e642061207374726565742061646472657373206c696e652c20746865206c6f776572206c696e652077696c6c206e6f726d616c6c792062652075736564206966206d61696c2063616e2062653c6272202f3e2064656c69766572656420746f207468617420616464726573732e3c6272202f3e204d6f7374206f6674656e20636f6e666c696374696e67206c696e657320617265206e6f7420757365642e3c2f703e, '', '', '', '536216.jpg', '462786_(1).jpg', '0', 'new', 'If an address has two conflicting lines, such as a post office box line\r\nand a street address line, the lower line will normally be used if mail can be\r\n', '37.7749295', '-122.4194155', 'Public Transit', 'La Sagrada Familia, GaudÃƒÆ’Ã†â€™Ãƒâ€ Ã¢â‚¬â„¢ÃƒÆ’Ã¢â‚¬Å¡Ãƒâ€šÃ‚Â­, FC Barcelona, Las Ramblas, warm sun and cool beaches, avant-garde architecture, museums, and music, gastronomic pioneers'),
(874, 0, 859, '', 'Krefeld', '', 'krefeld', 'Active', '1', 0x3c703e736466736466736420667364662073646620736466736420663c2f703e, '', '', '', '444289_(1).jpg', '334138.jpg', '0', 'good', 'tetd', '51.3387609', '6.5853417', 'Public Transit', 'La Sagrada Familia, GaudÃƒÆ’Ã†â€™Ãƒâ€ Ã¢â‚¬â„¢ÃƒÆ’Ã¢â‚¬Å¡Ãƒâ€šÃ‚Â­, FC Barcelona, Las Ramblas, warm sun and cool beaches, avant-garde architecture, museums, and music, gastronomic pioneers'),
(891, 95, 860, '', 'Chennai', '', 'chennai', 'Active', '0', '', '', '', '', '9aaac9f54cb5b6236c280832fe3f9138.jpg', '9aaac9f54cb5b6236c280832fe3f91381.jpg', '0', '', '', '13.08160', '80.27518', '', ''),
(885, 0, 4, '', 'gani', '', 'gani', 'Active', '0', '', '', '', '', '39.jpg', '310.jpg', '0', '', '', '', '', 'gani', 'gani'),
(888, 215, 4, '', 'ari', '', 'ari', 'Active', '0', '', '', '', '', '313.jpg', '44.jpg', '0', '', '', '34.86443', '-114.14846', 'ari', 'ari'),
(887, 0, 41, '', 'Jersy', '', 'jersy', 'Active', '0', '', '', '', '', '312.jpg', '43.jpg', '0', '', '', '', '', 'Jersy', ''),
(889, 0, 6, '', 'gang', '', 'gang', 'Active', '0', '', '', '', '', '314.jpg', '315.jpg', '0', '', '', '', '', 'gang', 'gang'),
(890, 0, 6, '', 'gang1', '', 'gang1', 'Active', '0', '', '', '', '', '316.jpg', '45.jpg', '0', '', '', '', '', 'gang1', 'gang1');

-- --------------------------------------------------------

--
-- Table structure for table `fc_city`
--

CREATE TABLE IF NOT EXISTS `fc_city` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `state_name` varchar(50) NOT NULL,
  `country_name` varchar(50) NOT NULL,
  `seourl` varchar(250) NOT NULL,
  `status` enum('InActive','Active') NOT NULL,
  `featured` enum('0','1') NOT NULL,
  `citylogo` varchar(1000) NOT NULL,
  `citythumb` varchar(1000) NOT NULL,
  `latitude` varchar(1000) NOT NULL,
  `longitude` varchar(1000) NOT NULL,
  `meta_title` blob NOT NULL,
  `meta_keyword` blob NOT NULL,
  `meta_description` blob NOT NULL,
  `view_order` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `fc_city`
--

INSERT INTO `fc_city` (`id`, `name`, `state_name`, `country_name`, `seourl`, `status`, `featured`, `citylogo`, `citythumb`, `latitude`, `longitude`, `meta_title`, `meta_keyword`, `meta_description`, `view_order`) VALUES
(1, 'Paris', 'Gangwon-do', 'South Korea', 'paris', 'Active', '1', '1460448490-paris-1574785.jpg', 'paris-1574785.jpg', '37.75185', '128.87606', 0x5061726973205469746c65, 0x3c703e5061726973204b6579776f72643c2f703e, 0x3c703e5061726973266e6273703b4465736372697074696f6e3c2f703e, 1),
(2, 'London', 'ì„œìš¸', 'South Korea', 'london', 'Active', '1', '1460448550-MaxW640imageVersiondefaultAR-140709178.jpg', 'MaxW640imageVersiondefaultAR-140709178.jpg', '37.56654', '126.97797', 0xec9588eb8f99, 0xec9588eb8f99, 0xec9588eb8f99, 13),
(3, 'Newyork', 'Jeju-do', 'South Korea', 'newyork', 'Active', '1', '1461058976-Argentina.jpg', 'Argentina.jpg', '33.49962', '126.53119', '', '', '', 3),
(4, 'Houston', 'Texas', 'United States', 'houston', 'Active', '1', '1460448531-mysore-palace-during.jpg', 'mysore-palace-during.jpg', '29.76043', '-95.36980', '', '', '', 4),
(6, 'Miami', 'Florida', 'United States', 'miami', 'Active', '1', '1460448482-1565012.jpg', '1565012.jpg', '35.17955', '129.07564', '', '', '', 2),
(7, 'Chennai', 'Tamil Nadu', 'India', 'chennai', 'InActive', '0', '1460448523-ancient-india.jpg', 'ancient-india.jpg', '13.08268', '80.27072', '', '', '', 7),
(8, 'Mumbai', 'Maharashtra', 'India', 'mumbai', 'Active', '0', '1460448295-gateway_to_india.jpg', 'gateway_to_india.jpg', '19.07598', '72.87766', '', '', '', 0);

-- --------------------------------------------------------

--
-- Table structure for table `fc_cms`
--

CREATE TABLE IF NOT EXISTS `fc_cms` (
  `id` int(200) NOT NULL AUTO_INCREMENT,
  `page_name` varchar(500) NOT NULL,
  `page_title` varchar(200) NOT NULL,
  `section` varchar(50) NOT NULL,
  `seourl` varchar(1000) NOT NULL,
  `hidden_page` enum('Yes','No') NOT NULL DEFAULT 'No',
  `category` enum('Main','Sub') NOT NULL DEFAULT 'Main',
  `parent` int(11) NOT NULL DEFAULT '0',
  `meta_tag` varchar(500) NOT NULL,
  `meta_description` blob NOT NULL,
  `description` blob NOT NULL,
  `status` enum('Publish','UnPublish') NOT NULL,
  `meta_title` varchar(1000) NOT NULL,
  `lang_code` varchar(120) NOT NULL,
  `toId` int(12) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=50 ;

--
-- Dumping data for table `fc_cms`
--

INSERT INTO `fc_cms` (`id`, `page_name`, `page_title`, `section`, `seourl`, `hidden_page`, `category`, `parent`, `meta_tag`, `meta_description`, `description`, `status`, `meta_title`, `lang_code`, `toId`) VALUES
(1, 'Cancellation Policy', 'Cancellation Policy', 'discover', 'cancellation-policy', 'No', 'Main', 0, 'Cancellation Policy', 0x3c703e43616e63656c6c6174696f6e20506f6c6963793c2f703e, 0x3c7461626c652069643d22636d735f74626c2220636c6173733d22646973706c617920646973706c61795f74626c20646174615461626c65223e0d0a3c74626f64793e0d0a3c747220636c6173733d226f6464223e0d0a3c746420636c6173733d2263656e7465722020736f7274696e675f31223e63616e63656c6c6174696f6e2d706f6c6963793c6272202f3e3c6272202f3e3c2f74643e0d0a3c2f74723e0d0a3c2f74626f64793e0d0a3c2f7461626c653e0d0a3c703e266e6273703b3c2f703e0d0a3c703e3c696d67207372633d22687474703a2f2f616972626e6276322e7a6f706c61792e636f6d2f75706c6f616465642f3030382e6a70672220616c743d22222077696474683d2238303022206865696768743d2236303022202f3e3c2f703e, 'Publish', 'Cancellation Policy', 'en', 1),
(9, 'Help', 'Help', 'company', 'help', 'No', 'Main', 0, '', '', 0x3c703e576861742069732052656e74657273203f3c2f703e0d0a3c703e52656e746572732069732061206d61726b657420706c6163652077686572652070726f7065727479206f776e6572732c2063616e206c6973742074686569722070726f706572747920776974682074682065696d6167657320616e642074686520616d6d656e6974657320746865792067697665207768696c6520746865206775657320626f6f6b732074686569722070726f70657274792e2052656e7465727320676976657320796f752074686520666c65786962696c69747920746f206769766520616c6c207468652064657461696c73206f66207468652070726f706572747920696e20612065617379207761792e3c2f703e0d0a3c703e266e6273703b3c2f703e0d0a3c7461626c65207374796c653d2277696474683a203130303070783b222063656c6c73706163696e673d223130222063656c6c70616464696e673d223230223e0d0a3c74626f64793e0d0a3c7472207374796c653d226865696768743a20383370783b223e0d0a3c7464207374796c653d2277696474683a2033343670783b206865696768743a20383370783b223e0d0a3c7461626c65207374796c653d22626f726465722d636f6c6f723a20233030303030303b2077696474683a2034353070783b20666c6f61743a206c6566743b206261636b67726f756e642d636f6c6f723a20236666363630303b2220626f726465723d2231222063656c6c73706163696e673d223330222063656c6c70616464696e673d223330223e0d0a3c74626f64793e0d0a3c7472207374796c653d226865696768743a20343970783b223e0d0a3c7464207374796c653d226865696768743a20343970783b223e0d0a3c6469763e57656c636f6d653c2f6469763e0d0a3c2f74643e0d0a3c2f74723e0d0a3c7472207374796c653d226865696768743a20343970783b223e0d0a3c7464207374796c653d226865696768743a20343970783b223e0d0a3c6469763e7364667364667364667364667364667364667364663c2f6469763e0d0a3c2f74643e0d0a3c2f74723e0d0a3c7472207374796c653d226865696768743a20343970783b223e0d0a3c7464207374796c653d226865696768743a20343970783b223e0d0a3c6469763e7364667364667364667364663c2f6469763e0d0a3c2f74643e0d0a3c2f74723e0d0a3c2f74626f64793e0d0a3c2f7461626c653e0d0a3c2f74643e0d0a3c7464207374796c653d2277696474683a2033353670783b206865696768743a20383370783b223e0d0a3c7461626c65207374796c653d22626f726465722d636f6c6f723a20233030303030303b2077696474683a2034353070783b20666c6f61743a206c6566743b206261636b67726f756e642d636f6c6f723a20236666363630303b2220626f726465723d2231222063656c6c73706163696e673d223330222063656c6c70616464696e673d223330223e0d0a3c74626f64793e0d0a3c7472207374796c653d226865696768743a20343970783b223e0d0a3c7464207374796c653d226865696768743a20343970783b223e52656e746572733c2f74643e0d0a3c2f74723e0d0a3c7472207374796c653d226865696768743a20343970783b223e0d0a3c7464207374796c653d226865696768743a20343970783b223e736466736466736466737364667364667364667364663c2f74643e0d0a3c2f74723e0d0a3c7472207374796c653d226865696768743a20343970783b223e0d0a3c7464207374796c653d226865696768743a20343970783b223e7364667364667364667364667364667364667364667364667364667364667364663c2f74643e0d0a3c2f74723e0d0a3c2f74626f64793e0d0a3c2f7461626c653e0d0a3c2f74643e0d0a3c2f74723e0d0a3c2f74626f64793e0d0a3c2f7461626c653e, 'Publish', '', 'en', 9),
(31, 'Terms of Service', 'Terms of Service', '', 'terms-of-service', 'No', 'Main', 0, '', '', 0x3c6469762069643d22636f6e7461696e65722d77726170706572223e0d0a3c64697620636c6173733d22636f6e7461696e657220223e0d0a3c64697620636c6173733d226d61696e33223e0d0a3c6469762069643d22636f6e74656e745f746578742220636c6173733d226d6964646c655f73656374696f6e223e0d0a3c70207374796c653d22746578742d616c69676e3a206a7573746966793b223e3c7370616e207374796c653d22666f6e742d66616d696c793a2076657264616e612c2067656e6576613b20666f6e742d73697a653a206d656469756d3b223e3c7374726f6e673e3120266e6273703b416363657074616e63652054686520557365204f66205a6f706c6179205465726d7320616e6420436f6e646974696f6e733c2f7374726f6e673e3c2f7370616e3e3c2f703e0d0a3c70207374796c653d22746578742d616c69676e3a206a7573746966793b223e3c7370616e207374796c653d22666f6e742d66616d696c793a2076657264616e612c2067656e6576613b20666f6e742d73697a653a206d656469756d3b223e596f75722061636365737320746f20616e6420757365206f66205a6f706c6179206973207375626a656374206578636c75736976656c7920746f207468657365205465726d7320616e6420436f6e646974696f6e732e20596f752077696c6c206e6f742075736520746865205765627369746520666f7220616e7920707572706f7365207468617420697320756e6c617766756c206f722070726f68696269746564206279207468657365205465726d7320616e6420436f6e646974696f6e732e204279207573696e6720746865205765627369746520796f75206172652066756c6c7920616363657074696e6720746865207465726d732c20636f6e646974696f6e7320616e6420646973636c61696d65727320636f6e7461696e656420696e2074686973206e6f746963652e20496620796f7520646f206e6f7420616363657074207468657365205465726d7320616e6420436f6e646974696f6e7320796f75206d75737420696d6d6564696174656c792073746f70207573696e672074686520576562736974652e3c2f7370616e3e3c2f703e0d0a3c70207374796c653d22746578742d616c69676e3a206a7573746966793b223e3c7370616e207374796c653d22666f6e742d66616d696c793a2076657264616e612c2067656e6576613b20666f6e742d73697a653a206d656469756d3b223e266e6273703b3c2f7370616e3e3c2f703e0d0a3c70207374796c653d22746578742d616c69676e3a206a7573746966793b223e3c7370616e207374796c653d22666f6e742d66616d696c793a2076657264616e612c2067656e6576613b20666f6e742d73697a653a206d656469756d3b223e3c7374726f6e673e3220266e6273703b43726564697420636172642064657461696c733c2f7374726f6e673e3c2f7370616e3e3c2f703e0d0a3c70207374796c653d22746578742d616c69676e3a206a7573746966793b223e3c7370616e207374796c653d22666f6e742d66616d696c793a2076657264616e612c2067656e6576613b20666f6e742d73697a653a206d656469756d3b223e496e7365727420796f757220637265646974206361726420706f6c6963793c2f7370616e3e3c2f703e0d0a3c70207374796c653d22746578742d616c69676e3a206a7573746966793b223e3c7370616e207374796c653d22666f6e742d66616d696c793a2076657264616e612c2067656e6576613b20666f6e742d73697a653a206d656469756d3b223e266e6273703b3c2f7370616e3e3c2f703e0d0a3c70207374796c653d22746578742d616c69676e3a206a7573746966793b223e3c7370616e207374796c653d22666f6e742d66616d696c793a2076657264616e612c2067656e6576613b20666f6e742d73697a653a206d656469756d3b223e3c7374726f6e673e3320266e6273703b4c4547414c204144564943453c2f7374726f6e673e3c2f7370616e3e3c2f703e0d0a3c70207374796c653d22746578742d616c69676e3a206a7573746966793b223e3c7370616e207374796c653d22666f6e742d66616d696c793a2076657264616e612c2067656e6576613b20666f6e742d73697a653a206d656469756d3b223e54686520636f6e74656e7473206f66205a6f706c6179207765627369746520646f206e6f7420636f6e737469747574652061647669636520616e642073686f756c64206e6f742062652072656c6965642075706f6e20696e206d616b696e67206f72207265667261696e696e672066726f6d206d616b696e672c20616e79206465636973696f6e2e266e6273703b3c2f7370616e3e3c6272202f3e3c7370616e207374796c653d22666f6e742d66616d696c793a2076657264616e612c2067656e6576613b20666f6e742d73697a653a206d656469756d3b223e416c6c206d6174657269616c20636f6e7461696e6564206f6e205a6f706c61792069732070726f766964656420776974686f757420616e79206f722077617272616e7479206f6620616e79206b696e642e20596f752075736520746865206d6174657269616c206f6e205a6f706c617920617420796f7572206f776e2064697363726574696f6e3c2f7370616e3e3c2f703e0d0a3c70207374796c653d22746578742d616c69676e3a206a7573746966793b223e3c7370616e207374796c653d22666f6e742d66616d696c793a2076657264616e612c2067656e6576613b20666f6e742d73697a653a206d656469756d3b223e266e6273703b3c2f7370616e3e3c2f703e0d0a3c70207374796c653d22746578742d616c69676e3a206a7573746966793b223e3c7370616e207374796c653d22666f6e742d66616d696c793a2076657264616e612c2067656e6576613b20666f6e742d73697a653a206d656469756d3b223e3c7374726f6e673e3420266e6273703b4348414e4745204f46205553453c2f7374726f6e673e3c2f7370616e3e3c2f703e0d0a3c70207374796c653d22746578742d616c69676e3a206a7573746966793b223e3c7370616e207374796c653d22666f6e742d66616d696c793a2076657264616e612c2067656e6576613b20666f6e742d73697a653a206d656469756d3b223e5a6f706c61792072657365727665732074686520726967687420746f3a3c2f7370616e3e3c2f703e0d0a3c70207374796c653d22746578742d616c69676e3a206a7573746966793b223e3c6272202f3e3c7370616e207374796c653d22666f6e742d66616d696c793a2076657264616e612c2067656e6576613b20666f6e742d73697a653a206d656469756d3b223e342e3120266e6273703b6368616e6765206f722072656d6f7665202874656d706f726172696c79206f72207065726d616e656e746c7929207468652057656273697465206f7220616e792070617274206f6620697420776974686f7574206e6f7469636520616e6420796f7520636f6e6669726d2074686174205a6f706c6179207368616c6c206e6f74206265206c6961626c6520746f20796f7520666f7220616e792073756368206368616e6765206f722072656d6f76616c20616e642e3c2f7370616e3e3c6272202f3e3c7370616e207374796c653d22666f6e742d66616d696c793a2076657264616e612c2067656e6576613b20666f6e742d73697a653a206d656469756d3b223e342e3220266e6273703b6368616e6765207468657365205465726d7320616e6420436f6e646974696f6e7320617420616e792074696d652c20616e6420796f757220636f6e74696e75656420757365206f6620746865205765627369746520666f6c6c6f77696e6720616e79206368616e676573207368616c6c206265206465656d656420746f20626520796f757220616363657074616e6365206f662073756368206368616e67652e3c2f7370616e3e3c2f703e0d0a3c70207374796c653d22746578742d616c69676e3a206a7573746966793b223e3c7370616e207374796c653d22666f6e742d66616d696c793a2076657264616e612c2067656e6576613b20666f6e742d73697a653a206d656469756d3b223e266e6273703b3c2f7370616e3e3c2f703e0d0a3c70207374796c653d22746578742d616c69676e3a206a7573746966793b223e3c7370616e207374796c653d22666f6e742d66616d696c793a2076657264616e612c2067656e6576613b20666f6e742d73697a653a206d656469756d3b223e3c7374726f6e673e3520266e6273703b4c696e6b7320746f2054686972642050617274792057656273697465733c2f7374726f6e673e3c2f7370616e3e3c2f703e0d0a3c70207374796c653d22746578742d616c69676e3a206a7573746966793b223e3c7370616e207374796c653d22666f6e742d66616d696c793a2076657264616e612c2067656e6576613b20666f6e742d73697a653a206d656469756d3b223e5a6f706c61792057656273697465206d617920696e636c756465206c696e6b7320746f20746869726420706172747920776562736974657320746861742061726520636f6e74726f6c6c656420616e64206d61696e7461696e6564206279206f74686572732e20416e79206c696e6b20746f206f74686572207765627369746573206973206e6f7420616e20656e646f7273656d656e74206f66207375636820776562736974657320616e6420796f752061636b6e6f776c6564676520616e64206167726565207468617420776520617265206e6f7420726573706f6e7369626c6520666f722074686520636f6e74656e74206f7220617661696c6162696c697479206f6620616e7920737563682073697465732e3c2f7370616e3e3c2f703e0d0a3c70207374796c653d22746578742d616c69676e3a206a7573746966793b223e3c7370616e207374796c653d22666f6e742d66616d696c793a2076657264616e612c2067656e6576613b20666f6e742d73697a653a206d656469756d3b223e266e6273703b3c2f7370616e3e3c2f703e0d0a3c70207374796c653d22746578742d616c69676e3a206a7573746966793b223e3c7370616e207374796c653d22666f6e742d66616d696c793a2076657264616e612c2067656e6576613b20666f6e742d73697a653a206d656469756d3b223e3c7374726f6e673e3620266e6273703b434f505952494748543c2f7374726f6e673e3c2f7370616e3e3c2f703e0d0a3c70207374796c653d22746578742d616c69676e3a206a7573746966793b223e3c7370616e207374796c653d22666f6e742d66616d696c793a2076657264616e612c2067656e6576613b20666f6e742d73697a653a206d656469756d3b223e362e3120266e6273703b416c6c20636f707972696768742c207472616465206d61726b7320616e6420616c6c206f7468657220696e74656c6c65637475616c2070726f70657274792072696768747320696e20746865205765627369746520616e642069747320636f6e74656e742028696e636c7564696e6720776974686f7574206c696d69746174696f6e2074686520576562736974652064657369676e2c20746578742c20677261706869637320616e6420616c6c20736f66747761726520616e6420736f7572636520636f64657320636f6e6e656374656420776974682074686520576562736974652920617265206f776e6564206279206f72206c6963656e73656420746f205a6f706c6179206f72206f74686572776973652075736564206279205a6f706c6179206173207065726d6974746564206279206c61772e3c2f7370616e3e3c6272202f3e3c7370616e207374796c653d22666f6e742d66616d696c793a2076657264616e612c2067656e6576613b20666f6e742d73697a653a206d656469756d3b223e362e3220266e6273703b496e20616363657373696e6720746865205765627369746520796f75206167726565207468617420796f752077696c6c206163636573732074686520636f6e74656e7420736f6c656c7920666f7220796f757220706572736f6e616c2c206e6f6e2d636f6d6d65726369616c207573652e204e6f6e65206f662074686520636f6e74656e74206d617920626520646f776e6c6f616465642c20636f706965642c20726570726f64756365642c207472616e736d69747465642c2073746f7265642c20736f6c64206f7220646973747269627574656420776974686f757420746865207072696f72207772697474656e20636f6e73656e74206f662074686520636f7079726967687420686f6c6465722e2054686973206578636c756465732074686520646f776e6c6f6164696e672c20636f7079696e6720616e642f6f72207072696e74696e67206f66207061676573206f6620746865205765627369746520666f7220706572736f6e616c2c206e6f6e2d636f6d6d65726369616c20686f6d6520757365206f6e6c792e3c2f7370616e3e3c2f703e0d0a3c70207374796c653d22746578742d616c69676e3a206a7573746966793b223e3c7370616e207374796c653d22666f6e742d66616d696c793a2076657264616e612c2067656e6576613b20666f6e742d73697a653a206d656469756d3b223e266e6273703b3c2f7370616e3e3c2f703e0d0a3c70207374796c653d22746578742d616c69676e3a206a7573746966793b223e3c7370616e207374796c653d22666f6e742d66616d696c793a2076657264616e612c2067656e6576613b20666f6e742d73697a653a206d656469756d3b223e3c7374726f6e673e3720266e6273703b4c494e4b5320544f20414e442046524f4d204f544845522057454253495445533c2f7374726f6e673e3c2f7370616e3e3c2f703e0d0a3c70207374796c653d22746578742d616c69676e3a206a7573746966793b223e3c7370616e207374796c653d22666f6e742d66616d696c793a2076657264616e612c2067656e6576613b20666f6e742d73697a653a206d656469756d3b223e372e3120266e6273703b5468726f7567686f75742074686973205765627369746520796f75206d61792066696e64206c696e6b7320746f2074686972642070617274792077656273697465732e205468652070726f766973696f6e206f662061206c696e6b20746f20737563682061207765627369746520646f6573206e6f74206d65616e207468617420776520656e646f727365207468617420776562736974652e20496620796f7520766973697420616e792077656273697465207669612061206c696e6b206f6e2074686973205765627369746520796f7520646f20736f20617420796f7572206f776e207269736b2e3c2f7370616e3e3c2f703e0d0a3c70207374796c653d22746578742d616c69676e3a206a7573746966793b223e3c6272202f3e3c7370616e207374796c653d22666f6e742d66616d696c793a2076657264616e612c2067656e6576613b20666f6e742d73697a653a206d656469756d3b223e372e3220266e6273703b416e792070617274792077697368696e6720746f206c696e6b20746f2074686973207765627369746520697320656e7469746c656420746f20646f20736f2070726f766964656420746861742074686520636f6e646974696f6e732062656c6f7720617265206f627365727665643a3c2f7370616e3e3c6272202f3e3c7370616e207374796c653d22666f6e742d66616d696c793a2076657264616e612c2067656e6576613b20666f6e742d73697a653a206d656469756d3b223e266e6273703b266e6273703b266e6273703b28612920266e6273703b796f7520646f206e6f74207365656b20746f20696d706c7920746861742077652061726520656e646f7273696e6720746865207365727669636573206f722070726f6475637473206f6620616e6f7468657220706172747920756e6c657373207468697320686173206265656e20616772656564207769746820757320696e2077726974696e673b3c2f7370616e3e3c6272202f3e3c7370616e207374796c653d22666f6e742d66616d696c793a2076657264616e612c2067656e6576613b20666f6e742d73697a653a206d656469756d3b223e266e6273703b266e6273703b266e6273703b28622920266e6273703b796f7520646f206e6f74206d6973726570726573656e7420796f75722072656c6174696f6e736869702077697468207468697320776562736974653b20616e643c2f7370616e3e3c6272202f3e3c7370616e207374796c653d22666f6e742d66616d696c793a2076657264616e612c2067656e6576613b20666f6e742d73697a653a206d656469756d3b223e266e6273703b266e6273703b266e6273703b286329203b266e6273703b74686520776562736974652066726f6d20776869636820796f75206c696e6b20746f2074686973205765627369746520646f6573206e6f7420636f6e7461696e206f6666656e73697665206f72206f746865727769736520636f6e74726f7665727369616c20636f6e74656e74206f722c20636f6e74656e74207468617420696e6672696e67657320616e7920696e74656c6c65637475616c2070726f706572747920726967687473206f72206f7468657220726967687473206f6620612074686972642070617274792e3c2f7370616e3e3c2f703e0d0a3c70207374796c653d22746578742d616c69676e3a206a7573746966793b223e3c6272202f3e3c7370616e207374796c653d22666f6e742d66616d696c793a2076657264616e612c2067656e6576613b20666f6e742d73697a653a206d656469756d3b223e372e3320266e6273703b4279206c696e6b696e6720746f2074686973205765627369746520696e20627265616368206f66206f7572207465726d732c20796f75207368616c6c20696e64656d6e69667920757320666f7220616e79206c6f7373206f722064616d61676520737566666572656420746f20746869732057656273697465206173206120726573756c74206f662073756368206c696e6b696e672e3c2f7370616e3e3c2f703e0d0a3c70207374796c653d22746578742d616c69676e3a206a7573746966793b223e3c7370616e207374796c653d22666f6e742d66616d696c793a2076657264616e612c2067656e6576613b20666f6e742d73697a653a206d656469756d3b223e266e6273703b3c2f7370616e3e3c2f703e0d0a3c70207374796c653d22746578742d616c69676e3a206a7573746966793b223e3c7370616e207374796c653d22666f6e742d66616d696c793a2076657264616e612c2067656e6576613b20666f6e742d73697a653a206d656469756d3b223e3c7374726f6e673e3820266e6273703b20444953434c41494d45525320414e44204c494d49544154494f4e204f46204c494142494c4954593c2f7374726f6e673e3c2f7370616e3e3c2f703e0d0a3c70207374796c653d22746578742d616c69676e3a206a7573746966793b223e3c7370616e207374796c653d22666f6e742d66616d696c793a2076657264616e612c2067656e6576613b20666f6e742d73697a653a206d656469756d3b223e382e3120266e6273703b54686520576562736974652069732070726f7669646564206f6e20616e20415320495320616e6420415320415641494c41424c4520626173697320776974686f757420616e7920726570726573656e746174696f6e206f7220656e646f7273656d656e74206d61646520616e6420776974686f75742077617272616e7479206f6620616e79206b696e6420776865746865722065787072657373206f7220696d706c6965642c20696e636c7564696e6720627574206e6f74206c696d6974656420746f2074686520696d706c6965642077617272616e74696573206f66207361746973666163746f7279207175616c6974792c206669746e65737320666f72206120706172746963756c617220707572706f73652c206e6f6e2d696e6672696e67656d656e742c20636f6d7061746962696c6974792c20736563757269747920616e642061636375726163792e3c2f7370616e3e3c2f703e0d0a3c70207374796c653d22746578742d616c69676e3a206a7573746966793b223e3c6272202f3e3c7370616e207374796c653d22666f6e742d66616d696c793a2076657264616e612c2067656e6576613b20666f6e742d73697a653a206d656469756d3b223e382e3220266e6273703b546f2074686520657874656e74207065726d6974746564206279206c61772c205a6f706c61792077696c6c206e6f74206265206c6961626c6520666f7220616e7920696e646972656374206f7220636f6e73657175656e7469616c206c6f7373206f722064616d6167652077686174657665722028696e636c7564696e6720776974686f7574206c696d69746174696f6e206c6f7373206f6620627573696e6573732c206f70706f7274756e6974792c20646174612c2070726f66697473292061726973696e67206f7574206f66206f7220696e20636f6e6e656374696f6e20776974682074686520757365206f662074686520576562736974652e3c2f7370616e3e3c2f703e0d0a3c70207374796c653d22746578742d616c69676e3a206a7573746966793b223e3c6272202f3e3c7370616e207374796c653d22666f6e742d66616d696c793a2076657264616e612c2067656e6576613b20666f6e742d73697a653a206d656469756d3b223e382e3320266e6273703b5a6f706c6179206d616b6573206e6f2077617272616e74792074686174207468652066756e6374696f6e616c697479206f662074686520576562736974652077696c6c20626520756e696e746572727570746564206f72206572726f7220667265652c207468617420646566656374732077696c6c20626520636f72726563746564206f722074686174207468652057656273697465206f7220746865207365727665722074686174206d616b657320697420617661696c61626c65206172652066726565206f662076697275736573206f7220616e797468696e6720656c7365207768696368206d6179206265206861726d66756c206f722064657374727563746976652e3c2f7370616e3e3c2f703e0d0a3c70207374796c653d22746578742d616c69676e3a206a7573746966793b223e3c6272202f3e3c7370616e207374796c653d22666f6e742d66616d696c793a2076657264616e612c2067656e6576613b20666f6e742d73697a653a206d656469756d3b223e382e3420266e6273703b4e6f7468696e6720696e207468657365205465726d7320616e6420436f6e646974696f6e73207368616c6c20626520636f6e73747275656420736f20617320746f206578636c756465206f72206c696d697420746865206c696162696c697479206f66205a6f706c617920666f72206465617468206f7220706572736f6e616c20696e6a757279206173206120726573756c74206f6620746865206e65676c6967656e6365206f66205a6f706c6179206f722074686174206f662069747320656d706c6f79656573206f72206167656e74732e3c2f7370616e3e3c2f703e0d0a3c70207374796c653d22746578742d616c69676e3a206a7573746966793b223e3c7370616e207374796c653d22666f6e742d66616d696c793a2076657264616e612c2067656e6576613b20666f6e742d73697a653a206d656469756d3b223e266e6273703b3c2f7370616e3e3c2f703e0d0a3c70207374796c653d22746578742d616c69676e3a206a7573746966793b223e3c7370616e207374796c653d22666f6e742d66616d696c793a2076657264616e612c2067656e6576613b20666f6e742d73697a653a206d656469756d3b223e3c7374726f6e673e3920266e6273703b494e44454d4e4954593c2f7374726f6e673e3c2f7370616e3e3c2f703e0d0a3c70207374796c653d22746578742d616c69676e3a206a7573746966793b223e3c7370616e207374796c653d22666f6e742d66616d696c793a2076657264616e612c2067656e6576613b20666f6e742d73697a653a206d656469756d3b223e596f7520616772656520746f20696e64656d6e69667920616e6420686f6c64205a6f706c617920616e642069747320656d706c6f7965657320616e64206167656e7473206861726d6c6573732066726f6d20616e6420616761696e737420616c6c206c696162696c69746965732c206c6567616c20666565732c2064616d616765732c206c6f737365732c20636f73747320616e64206f7468657220657870656e73657320696e2072656c6174696f6e20746f20616e7920636c61696d73206f7220616374696f6e732062726f7567687420616761696e7374205a6f706c61792061726973696e67206f7574206f6620616e792062726561636820627920796f75206f66207468657365205465726d7320616e6420436f6e646974696f6e73206f72206f74686572206c696162696c69746965732061726973696e67206f7574206f6620796f757220757365206f66207468697320576562736974652e3c2f7370616e3e3c2f703e0d0a3c70207374796c653d22746578742d616c69676e3a206a7573746966793b223e3c7370616e207374796c653d22666f6e742d66616d696c793a2076657264616e612c2067656e6576613b20666f6e742d73697a653a206d656469756d3b223e266e6273703b3c2f7370616e3e3c2f703e0d0a3c70207374796c653d22746578742d616c69676e3a206a7573746966793b223e3c7370616e207374796c653d22666f6e742d66616d696c793a2076657264616e612c2067656e6576613b20666f6e742d73697a653a206d656469756d3b223e3c7374726f6e673e313020266e6273703b5345564552414e43453c2f7374726f6e673e3c2f7370616e3e3c2f703e0d0a3c70207374796c653d22746578742d616c69676e3a206a7573746966793b223e3c7370616e207374796c653d22666f6e742d66616d696c793a2076657264616e612c2067656e6576613b20666f6e742d73697a653a206d656469756d3b223e496620616e79206f66207468657365205465726d7320616e6420436f6e646974696f6e732073686f756c642062652064657465726d696e656420746f20626520696e76616c69642c20696c6c6567616c206f7220756e656e666f72636561626c6520666f7220616e7920726561736f6e20627920616e7920636f757274206f6620636f6d706574656e74206a7572697364696374696f6e207468656e2073756368205465726d206f7220436f6e646974696f6e207368616c6c206265207365766572656420616e64207468652072656d61696e696e67205465726d7320616e6420436f6e646974696f6e73207368616c6c207375727669766520616e642072656d61696e20696e2066756c6c20666f72636520616e642065666665637420616e6420636f6e74696e756520746f2062652062696e64696e6720616e6420656e666f72636561626c652e3c2f7370616e3e3c2f703e0d0a3c70207374796c653d22746578742d616c69676e3a206a7573746966793b223e3c7370616e207374796c653d22666f6e742d66616d696c793a2076657264616e612c2067656e6576613b20666f6e742d73697a653a206d656469756d3b223e266e6273703b3c2f7370616e3e3c2f703e0d0a3c70207374796c653d22746578742d616c69676e3a206a7573746966793b223e3c7370616e207374796c653d22666f6e742d66616d696c793a2076657264616e612c2067656e6576613b20666f6e742d73697a653a206d656469756d3b223e3c7374726f6e673e313120266e6273703b5741495645523c2f7374726f6e673e3c2f7370616e3e3c2f703e0d0a3c70207374796c653d22746578742d616c69676e3a206a7573746966793b223e3c7370616e207374796c653d22666f6e742d66616d696c793a2076657264616e612c2067656e6576613b20666f6e742d73697a653a206d656469756d3b223e496620796f752062726561636820746865736520436f6e646974696f6e73206f662055736520616e642077652074616b65206e6f20616374696f6e2c2077652077696c6c207374696c6c20626520656e7469746c656420746f20757365206f75722072696768747320616e642072656d656469657320696e20616e79206f7468657220736974756174696f6e20776865726520796f752062726561636820746865736520436f6e646974696f6e73206f66205573652e3c2f7370616e3e3c2f703e0d0a3c70207374796c653d22746578742d616c69676e3a206a7573746966793b223e3c7370616e207374796c653d22666f6e742d66616d696c793a2076657264616e612c2067656e6576613b20666f6e742d73697a653a206d656469756d3b223e266e6273703b3c2f7370616e3e3c2f703e0d0a3c70207374796c653d22746578742d616c69676e3a206a7573746966793b223e3c7370616e207374796c653d22666f6e742d66616d696c793a2076657264616e612c2067656e6576613b20666f6e742d73697a653a206d656469756d3b223e3c7374726f6e673e313220266e6273703b474f5645524e494e47204c41573c2f7374726f6e673e3c2f7370616e3e3c2f703e0d0a3c70207374796c653d22746578742d616c69676e3a206a7573746966793b223e3c7370616e207374796c653d22666f6e742d66616d696c793a2076657264616e612c2067656e6576613b20666f6e742d73697a653a206d656469756d3b223e5468657365205465726d7320616e6420436f6e646974696f6e73207368616c6c20626520676f7665726e656420627920616e6420636f6e73747275656420696e206163636f7264616e6365207769746820746865206c6177206f6620696e64696120616e6420796f7520686572656279207375626d697420746f20746865206578636c7573697665206a7572697364696374696f6e206f662074686520696e64696120636f757274732e3c2f7370616e3e3c2f703e0d0a3c2f6469763e0d0a3c2f6469763e0d0a3c2f6469763e0d0a3c2f6469763e, 'Publish', '', 'en', 31),
(38, 'Privacy Policy', 'Privacy Policy', '', 'privacy-policy', 'No', 'Main', 0, '', '', '', 'Publish', '', 'en', 38),
(49, '개인 정보 정책', '개인 정보 정책', '', 'privacy-policy', 'No', 'Main', 0, '', '', 0x3c7072652069643d2274772d7461726765742d746578742220636c6173733d2274772d646174612d7465787420766b5f7478742074772d74612074772d746578742d6d656469756d22206469723d226c74722220646174612d706c616365686f6c6465723d225472616e736c6174696f6e2220646174612d66756c6c746578743d22223e3c7370616e206c616e673d226b6f223eeab09cec9db820eca095ebb3b420eca095ecb1853c2f7370616e3e3c2f7072653e, 'Publish', '', 'kr', 38),
(48, '서비스 약관', '서비스 약관', '', 'terms-of-service', 'No', 'Main', 0, '', '', 0x3c7072652069643d2274772d7461726765742d746578742220636c6173733d2274772d646174612d7465787420766b5f7478742074772d74612074772d746578742d6d656469756d22206469723d226c74722220646174612d706c616365686f6c6465723d225472616e736c6174696f6e2220646174612d66756c6c746578743d22223e3c7370616e206c616e673d226b6f223eec849cebb984ec8aa420ec95bdeab4803c2f7370616e3e3c2f7072653e, 'Publish', '', 'kr', 31),
(47, '도움', '도움', '', 'help', 'No', 'Main', 0, '', '', 0x3c7072652069643d2274772d7461726765742d746578742220636c6173733d2274772d646174612d7465787420766b5f7478742074772d74612074772d746578742d6c6172676522206469723d226c74722220646174612d706c616365686f6c6465723d225472616e736c6174696f6e2220646174612d66756c6c746578743d22223e3c7370616e206c616e673d226b6f223eeb8f84ec9b803c2f7370616e3e3c2f7072653e, 'Publish', '', 'kr', 9),
(46, '취소 정책', '취소 정책', '', 'cancellation-policy', 'No', 'Main', 0, '', '', 0x3c7072652069643d2274772d7461726765742d746578742220636c6173733d2274772d646174612d7465787420766b5f7478742074772d74612074772d746578742d6d656469756d22206469723d226c74722220646174612d706c616365686f6c6465723d225472616e736c6174696f6e2220646174612d66756c6c746578743d22223e3c7370616e206c616e673d226b6f223eecb7a8ec868c20eca095ecb1853c2f7370616e3e3c2f7072653e, 'Publish', '', 'kr', 1);

-- --------------------------------------------------------

--
-- Table structure for table `fc_commission`
--

CREATE TABLE IF NOT EXISTS `fc_commission` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `commission_type` varchar(250) NOT NULL,
  `commission_percentage` varchar(200) NOT NULL,
  `promotion_type` enum('flat','percentage') NOT NULL,
  `status` enum('Active','Inactive') NOT NULL,
  `seo_tag` varchar(50) NOT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `fc_commission`
--

INSERT INTO `fc_commission` (`id`, `commission_type`, `commission_percentage`, `promotion_type`, `status`, `seo_tag`, `created`) VALUES
(1, 'Host Listing', '5', 'flat', 'Active', 'host-listing', '2016-09-16 09:35:32'),
(2, 'Guest Booking', '2', 'percentage', 'Active', 'guest-booking', '2016-09-16 10:10:15'),
(3, 'Host Accept The Reservation Request', '5', 'flat', 'Active', 'host-accept', '2016-09-28 13:13:19');

-- --------------------------------------------------------

--
-- Table structure for table `fc_commission_paid`
--

CREATE TABLE IF NOT EXISTS `fc_commission_paid` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `host_email` varchar(250) NOT NULL,
  `host_id` int(11) NOT NULL,
  `amount` float(10,2) NOT NULL,
  `transaction_id` varchar(250) NOT NULL,
  `comission_track_id` int(11) NOT NULL,
  `status` enum('Pending','Paid') NOT NULL DEFAULT 'Pending',
  `dateAdded` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `fc_commission_tracking`
--

CREATE TABLE IF NOT EXISTS `fc_commission_tracking` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `host_email` varchar(100) NOT NULL,
  `host_id` int(11) NOT NULL,
  `booking_no` varchar(100) NOT NULL,
  `total_amount` float(10,2) NOT NULL,
  `guest_fee` float(10,2) NOT NULL,
  `host_fee` float(10,2) NOT NULL,
  `payable_amount` float(10,2) NOT NULL,
  `dateAdded` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `paid_status` enum('yes','no') NOT NULL DEFAULT 'no',
  `pro_total_amount` varchar(50) NOT NULL,
  `pro_guest_fee` varchar(50) NOT NULL,
  `pro_host_fee` varchar(50) NOT NULL,
  `pro_payable_amount` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `fc_contactus`
--

CREATE TABLE IF NOT EXISTS `fc_contactus` (
  `id` int(200) NOT NULL AUTO_INCREMENT,
  `firstname` varchar(500) NOT NULL,
  `lastname` varchar(500) NOT NULL,
  `adults` varchar(500) NOT NULL,
  `children` varchar(500) NOT NULL,
  `email` varchar(500) NOT NULL,
  `mobile_no` varchar(100) NOT NULL,
  `contact_sub` varchar(1000) NOT NULL,
  `message` varchar(5000) NOT NULL,
  `status` enum('Active','InActive') NOT NULL DEFAULT 'Active',
  `dateAdded` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `arrival_date` date NOT NULL,
  `departure_date` date NOT NULL,
  `rental_id` varchar(1000) NOT NULL,
  `renter_id` varchar(1000) NOT NULL,
  `read_staus` enum('UnRead','Read') NOT NULL,
  `user_read_status` enum('UnRead','Read') NOT NULL,
  `customer_id` int(100) NOT NULL,
  `enquiry_timezone` varchar(1000) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `fc_country`
--

CREATE TABLE IF NOT EXISTS `fc_country` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `contid` varchar(255) CHARACTER SET utf8 COLLATE utf8_persian_ci NOT NULL,
  `country_code` varchar(2) CHARACTER SET utf8 COLLATE utf8_persian_ci DEFAULT NULL,
  `country_mobile_code` varchar(200) NOT NULL,
  `name` varchar(255) CHARACTER SET utf8 COLLATE utf8_persian_ci DEFAULT NULL,
  `seourl` varchar(750) CHARACTER SET utf8 COLLATE utf8_persian_ci NOT NULL,
  `currency_type` char(3) CHARACTER SET utf8 COLLATE utf8_persian_ci NOT NULL,
  `currency_symbol` text NOT NULL,
  `shipping_cost` decimal(10,2) NOT NULL,
  `shipping_tax` decimal(10,2) NOT NULL,
  `meta_title` blob NOT NULL,
  `meta_keyword` blob NOT NULL,
  `meta_description` blob NOT NULL,
  `description` longblob NOT NULL,
  `status` enum('Active','InActive') CHARACTER SET utf8 COLLATE utf8_persian_ci NOT NULL DEFAULT 'Active',
  `dateAdded` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `currency_default` enum('No','Yes') CHARACTER SET utf8 COLLATE utf8_persian_ci NOT NULL DEFAULT 'No',
  `slider_image` varchar(1000) NOT NULL,
  `logo` varchar(1000) NOT NULL,
  `map` varchar(1000) NOT NULL,
  `thumb` varchar(1000) NOT NULL,
  `language_code` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=232 ;

--
-- Dumping data for table `fc_country`
--

INSERT INTO `fc_country` (`id`, `contid`, `country_code`, `country_mobile_code`, `name`, `seourl`, `currency_type`, `currency_symbol`, `shipping_cost`, `shipping_tax`, `meta_title`, `meta_keyword`, `meta_description`, `description`, `status`, `dateAdded`, `currency_default`, `slider_image`, `logo`, `map`, `thumb`, `language_code`) VALUES
(1, 'EU', 'AD', '+376', 'Andorra', 'andorra', 'EUR', '$', '0.00', '0.00', '', '', '', '', 'InActive', '2015-02-19 07:41:51', 'No', '0', '0', '0', '', 'en'),
(2, 'AS', 'AE', '+971', 'United Arab Emirates', 'united-arab-emirates', 'AED', '$', '0.00', '0.00', '', '', '', '', 'Active', '2014-12-13 08:00:58', 'No', '0', '0', '0', '', 'en'),
(3, 'AS', 'AF', '+93 ', 'Afghanistan', 'afghanistan', 'AFN', '0', '3.00', '0.00', '', '', '', 0x3c703e686a676a663c2f703e, 'InActive', '2015-07-07 07:05:17', 'No', '0', 'Chrysanthemum2.jpg', '0', 'Koala8.jpg', 'en'),
(4, 'NA', 'AG', '+268', 'Antigua And Barbuda', 'antigua-and-barbuda', 'XCD', '$', '2.00', '3.00', '', '', '', '', 'Active', '2014-12-13 08:04:56', 'No', '0', '0', '0', '', 'en'),
(5, 'EU', 'AL', '+355', 'Albania', 'albania', 'ALL', '', '0.00', '0.00', '', '', '', '', 'InActive', '2015-02-19 07:51:51', 'No', '0', '0', '0', '', 'en'),
(6, 'AS', 'AM', '+374', 'Armenia', 'armenia', 'AMD', '', '0.00', '0.00', '', '', '', '', 'Active', '2014-12-13 08:05:30', 'No', '0', '0', '0', '', 'en'),
(7, 'AF', 'AO', '+244', 'Angola', 'angola', 'AOA', '', '0.00', '0.00', '', '', '', '', 'InActive', '2015-02-19 07:53:23', 'No', '0', '0', '0', '', 'en'),
(8, 'AN', 'AQ', '+672', 'Antarctica', 'antarctica', 'XCD', '', '0.00', '0.00', '', '', '', '', 'InActive', '2015-02-19 09:07:57', 'No', '0', '0', '0', '', 'en'),
(9, 'SA', 'AR', '+54 ', 'Argentina', 'argentina', 'ARS', '', '0.00', '0.00', '', '', '', '', 'Active', '2014-12-13 08:06:52', 'No', '0', '0', '0', '', 'en'),
(10, 'OC', 'AS', '+684', 'American Samoa', 'american-samoa', 'USD', '', '0.00', '0.00', '', '', '', '', 'InActive', '2015-02-19 07:53:16', 'No', '0', '0', '0', '', 'en'),
(11, 'EU', 'AT', '+43', 'Austria', 'austria', 'EUR', '', '0.00', '0.00', '', '', '', '', 'Active', '2014-12-13 08:07:46', 'No', '0', '0', '0', '', 'en'),
(12, 'OC', 'AU', '+61', 'Australia', 'australia', 'AUD', '$', '0.00', '0.00', '', '', '', '', 'Active', '2014-12-13 08:08:00', 'No', '0', '0', '0', '', 'en'),
(13, 'NA', 'AW', '+297', 'Aruba', 'aruba', 'AWG', '', '0.00', '0.00', '', '', '', '', 'Active', '2014-12-13 08:08:47', 'No', '0', '0', '0', '', 'en'),
(14, '', 'AX', '+358\n', 'Aland Islands', 'aland-islands', 'EUR', 'ÃƒÆ’Ã†â€™Ãƒâ€šÃ‚Â¢ÃƒÆ’Ã‚Â¢ÃƒÂ¢Ã¢â‚¬Å¡Ã‚Â¬Ãƒâ€¦Ã‚Â¡ÃƒÆ’Ã¢â‚¬Å¡Ãƒâ€šÃ‚Â¬', '0.00', '0.00', '', '', '', 0x3c703e64667364663c2f703e, 'InActive', '2015-04-28 10:51:02', 'No', '0', 'Chrysanthemum1.jpg', '0', 'Lighthouse3.jpg', 'en'),
(15, 'AS', 'AZ', '+994', 'Azerbaijan', 'azerbaijan', 'AZN', '', '0.00', '0.00', '', '', '', '', 'Active', '2014-12-13 08:10:43', 'No', '0', '0', '0', '', 'en'),
(16, '', 'BA', '+387', 'Bosnia And Herzegovina', 'bosnia-and-herzegovina', 'BAM', '', '0.00', '0.00', '', '', '', '', 'Active', '2014-12-13 08:10:57', 'No', '0', '0', '0', '', 'en'),
(17, 'NA', 'BB', '+246', 'Barbados', 'barbados', 'BBD', '', '0.00', '0.00', '', '', '', '', 'Active', '2014-12-13 08:12:49', 'No', '0', '0', '0', '', 'en'),
(18, 'AS', 'BD', '+880', 'Bangladesh', 'bangladesh', 'BDT', '', '0.00', '0.00', '', '', '', '', 'Active', '2014-12-13 08:13:02', 'No', '0', '0', '0', '', 'en'),
(19, 'EU', 'BE', '+32', 'Belgium', 'belgium', 'EUR', '', '0.00', '0.00', '', '', '', '', 'Active', '2014-12-13 08:13:36', 'No', '0', '0', '0', '', 'en'),
(20, 'AF', 'BF', '+226', 'Burkina Faso', 'burkina-faso', 'XOF', '', '0.00', '0.00', '', '', '', '', 'Active', '2014-12-13 08:14:05', 'No', '0', '0', '0', '', 'en'),
(21, 'EU', 'BG', '+359', 'Bulgaria', 'bulgaria', 'BGN', '', '0.00', '0.00', '', '', '', '', 'Active', '2014-12-13 08:14:27', 'No', '0', '0', '0', '', 'en'),
(22, 'AS', 'BH', '+973', 'Bahrain', 'bahrain', 'BHD', '', '0.00', '0.00', '', '', '', '', 'Active', '2014-12-13 08:14:48', 'No', '0', '0', '0', '', 'en'),
(23, 'AF', 'BI', '+257', 'Burundi', 'burundi', 'BIF', '', '0.00', '0.00', '', '', '', '', 'Active', '2014-12-13 08:15:04', 'No', '0', '0', '0', '', 'en'),
(24, 'AF', 'BJ', '+229 ', 'Benin', 'benin', 'XOF', '', '0.00', '0.00', '', '', '', '', 'Active', '2014-12-13 08:15:36', 'No', '0', '0', '0', '', 'en'),
(25, 'NA', 'BM', '+1441', 'Bermuda', 'bermuda', 'BMD', '', '0.00', '0.00', '', '', '', '', 'Active', '2014-12-13 08:16:42', 'No', '0', '0', '0', '', 'en'),
(26, '', 'BN', '+673', 'Brunei', 'brunei', 'BND', '', '0.00', '0.00', '', '', '', '', 'Active', '2014-12-13 08:16:54', 'No', '0', '0', '0', '', 'en'),
(27, 'SA', 'BO', '+591', 'Bolivia', 'bolivia', 'BOB', '', '0.00', '0.00', '', '', '', '', 'Active', '2014-12-13 08:17:16', 'No', '0', '0', '0', '', 'en'),
(28, '', 'BQ', '+599', 'Bonaire, Saint Eustatius And Saba ', 'bonaire,-saint-eustatius-and-saba', 'USD', '', '0.00', '0.00', '', '', '', '', 'InActive', '2015-07-07 07:05:29', 'No', '0', '0', '0', '', 'en'),
(29, 'SA', 'BR', '+55', 'Brazil', 'brazil', 'BRL', '', '0.00', '0.00', '', '', '', '', 'Active', '2014-12-13 08:18:32', 'No', '0', '0', '0', '', 'en'),
(30, 'NA', 'BS', '+242', 'Bahamas', 'bahamas', 'BSD', '', '0.00', '0.00', '', '', '', '', 'Active', '2014-12-13 08:18:46', 'No', '0', '0', '0', '', 'en'),
(31, 'AS', 'BT', '+975', 'Bhutan', 'bhutan', 'BTN', '', '0.00', '0.00', '', '', '', '', 'Active', '2014-12-13 08:19:06', 'No', '0', '0', '0', '', 'en'),
(32, 'AN', 'BV', '+47	', 'Bouvet Island', 'bouvet-island', 'NOK', '', '0.00', '0.00', '', '', '', '', 'Active', '2014-12-13 08:20:27', 'No', '0', '0', '0', '', 'en'),
(33, 'AF', 'BW', '+267', 'Botswana', 'botswana', 'BWP', '', '0.00', '0.00', '', '', '', '', 'Active', '2014-12-13 08:21:06', 'No', '0', '0', '0', '', 'en'),
(34, 'EU', 'BY', '+375', 'Belarus', 'belarus', 'BYR', '', '0.00', '0.00', '', '', '', '', 'Active', '2014-12-13 08:21:20', 'No', '0', '0', '0', '', 'en'),
(35, 'NA', 'BZ', '+501', 'Belize', 'belize', 'BZD', '', '0.00', '0.00', '', '', '', '', 'Active', '2014-12-13 08:21:32', 'No', '0', '0', '0', '', 'en'),
(36, 'NA', 'CA', '+1', 'Canada', 'canada', 'CAD', '', '0.00', '0.00', '', '', '', '', 'Active', '2014-12-13 08:21:55', 'No', '0', '0', '0', '', 'en'),
(37, '', 'CD', '+243', 'Democratic Republic Of The Congo', 'democratic-republic-of-the-congo', 'DRC', '', '0.00', '0.00', '', '', '', '', 'Active', '2014-12-13 08:22:19', 'No', '0', '0', '0', '', 'en'),
(38, 'AF', 'CF', '+236\n', 'Central African Republic', 'central-african-republic', 'XAF', '', '0.00', '0.00', '', '', '', '', 'Active', '2014-12-13 08:22:31', 'No', '0', '0', '0', '', 'en'),
(39, '', 'CG', '+ 242', 'Republic Of The Congo', 'republic-of-the-congo', 'DRC', '', '0.00', '0.00', '', '', '', '', 'Active', '2014-12-13 08:22:52', 'No', '0', '0', '0', '', 'en'),
(40, 'EU', 'CH', '+41\n', 'Switzerland', 'switzerland', 'CHF', '', '0.00', '0.00', '', '', '', '', 'Active', '2014-12-13 08:24:43', 'No', '0', '0', '0', '', 'en'),
(41, '', 'CI', '+225', 'Ivory Coast', 'ivory-coast', 'XOF', '', '0.00', '0.00', '', '', '', '', 'Active', '2014-12-13 08:24:59', 'No', '0', '0', '0', '', 'en'),
(42, 'SA', 'CL', '+56\n', 'Chile', 'chile', 'CLP', '', '0.00', '0.00', '', '', '', '', 'Active', '2014-12-13 08:25:34', 'No', '0', '0', '0', '', 'en'),
(43, 'AF', 'CM', '+237', 'Cameroon', 'cameroon', 'XAF', '', '0.00', '0.00', '', '', '', '', 'Active', '2014-12-13 08:26:12', 'No', '0', '0', '0', '', 'en'),
(44, 'AS', 'CN', '+86', 'China', 'china', 'CNY', '', '0.00', '0.00', '', '', '', '', 'Active', '2014-12-13 08:26:32', 'No', '0', '0', '0', '', 'en'),
(45, 'SA', 'CO', '+57', 'Colombia', 'colombia', 'COP', '', '0.00', '0.00', '', '', '', '', 'Active', '2014-12-13 08:26:43', 'No', '0', '0', '0', '', 'en'),
(46, 'NA', 'CR', '+506\n', 'Costa Rica', 'costa-rica', 'CRC', '', '0.00', '0.00', '', '', '', '', 'Active', '2014-12-13 08:26:58', 'No', '0', '0', '0', '', 'en'),
(47, 'NA', 'CU', '+53\n', 'Cuba', 'cuba', 'CUP', '', '0.00', '0.00', '', '', '', '', 'Active', '2014-12-13 08:27:11', 'No', '0', '0', '0', '', 'en'),
(48, 'AF', 'CV', '+238\n', 'Cape Verde', 'cape-verde', 'CVE', '', '0.00', '0.00', '', '', '', '', 'Active', '2014-12-13 08:27:22', 'No', '0', '0', '0', '', 'en'),
(49, 'EU', 'CY', '+357\n', 'Cyprus', 'cyprus', 'EUR', '', '0.00', '0.00', '', '', '', '', 'Active', '2014-12-13 08:27:34', 'No', '0', '0', '0', '', 'en'),
(50, 'EU', 'CZ', '+420\n', 'Czech Republic', 'czech-republic', 'CZK', '', '0.00', '0.00', '', '', '', '', 'Active', '2014-12-13 08:27:47', 'No', '0', '0', '0', '', 'en'),
(51, 'EU', 'DE', '+49', 'Germany', 'germany', 'EUR', '0', '0.00', '0.00', '', '', '', '', 'Active', '2014-12-13 08:28:01', 'No', '0', '0', '0', '', 'de'),
(52, 'AF', 'DJ', '+253', 'Djibouti', 'djibouti', 'DJF', '', '0.00', '0.00', '', '', '', '', 'Active', '2014-12-13 08:28:12', 'No', '0', '0', '0', '', 'en'),
(53, 'EU', 'DK', '+45', 'Denmark', 'denmark', 'DKK', '', '0.00', '0.00', '', '', '', '', 'Active', '2014-12-13 08:28:33', 'No', '0', '0', '0', '', 'en'),
(54, 'NA', 'DM', '+ 1 767', 'Dominica', 'dominica', 'XCD', '', '0.00', '0.00', '', '', '', '', 'Active', '2014-12-13 08:28:55', 'No', '0', '0', '0', '', 'en'),
(55, 'NA', 'DO', '+1 809 ', 'Dominican Republic', 'dominican-republic', 'DOP', '', '0.00', '0.00', '', '', '', '', 'Active', '2014-12-13 08:29:55', 'No', '0', '0', '0', '', 'en'),
(56, 'AF', 'DZ', '+213', 'Algeria', 'algeria', 'DZD', '', '0.00', '0.00', '', '', '', '', 'InActive', '2015-02-19 07:53:07', 'No', '0', '0', '0', '', 'en'),
(57, 'SA', 'EC', '+593', 'Ecuador', 'ecuador', 'ECS', '', '0.00', '0.00', '', '', '', '', 'Active', '2014-12-13 08:30:16', 'No', '0', '0', '0', '', 'en'),
(58, 'EU', 'EE', '+372', 'Estonia', 'estonia', 'EUR', '', '0.00', '0.00', '', '', '', '', 'Active', '2014-12-13 08:30:26', 'No', '0', '0', '0', '', 'en'),
(59, 'AF', 'EG', '+20', 'Egypt', 'egypt', 'EGP', '', '0.00', '0.00', '', '', '', '', 'Active', '2014-12-13 08:30:38', 'No', '0', '0', '0', '', 'en'),
(60, 'AF', 'EH', '+212', 'Western Sahara', 'western-sahara', 'MAD', '', '0.00', '0.00', '', '', '', '', 'Active', '2014-12-13 08:31:28', 'No', '0', '0', '0', '', 'en'),
(61, 'AF', 'ER', '+291', 'Eritrea', 'eritrea', 'ERN', '', '0.00', '0.00', '', '', '', '', 'Active', '2014-12-13 09:15:36', 'No', '0', '0', '0', '', 'en'),
(62, 'EU', 'ES', '+34', 'Spain', 'spain', 'EUR', '', '0.00', '0.00', '', '', '', '', 'Active', '2014-12-13 09:16:03', 'No', '0', '0', '0', '', 'en'),
(63, 'AF', 'ET', '+251', 'Ethiopia', 'ethiopia', 'ETB', '', '0.00', '0.00', '', '', '', '', 'Active', '2014-12-13 09:16:18', 'No', '0', '0', '0', '', 'en'),
(64, 'EU', 'FI', '+358', 'Finland', 'finland', 'EUR', '', '0.00', '0.00', '', '', '', '', 'Active', '2014-12-13 09:16:34', 'No', '0', '0', '0', '', 'en'),
(65, 'OC', 'FJ', '+679', 'Fiji', 'fiji', 'FJD', '', '0.00', '0.00', '', '', '', '', 'Active', '2014-12-13 09:16:47', 'No', '0', '0', '0', '', 'en'),
(66, '', 'FM', '+691', 'Micronesia', 'micronesia', 'USD', '', '0.00', '0.00', '', '', '', '', 'Active', '2014-12-13 09:17:01', 'No', '0', '0', '0', '', 'en'),
(67, 'EU', 'FO', '+298', 'Faroe Islands', 'faroe-islands', 'DKK', '', '0.00', '0.00', '', '', '', '', 'Active', '2014-12-13 09:17:20', 'No', '0', '0', '0', '', 'en'),
(68, 'EU', 'FR', '+33', 'France', 'france', 'EUR', '', '0.00', '0.00', '', '', '', '', 'Active', '2014-12-13 09:17:33', 'No', '0', '0', '0', '', 'en'),
(69, 'AF', 'GA', '+241 ', 'Gabon', 'gabon', 'XAF', '', '0.00', '0.00', '', '', '', '', 'Active', '2014-12-13 09:17:49', 'No', '0', '0', '0', '', 'en'),
(70, 'EU', 'GB', '+44', 'United Kingdom', 'united-kingdom', 'USD', '', '0.00', '0.00', '', '', '', '', 'Active', '2014-12-13 09:18:13', 'No', '0', '0', '0', '', 'en'),
(71, 'NA', 'GD', '+1 473', 'Grenada', 'grenada', 'XCD', '', '0.00', '0.00', '', '', '', '', 'Active', '2014-12-13 09:18:37', 'No', '0', '0', '0', '', 'en'),
(72, 'AS', 'GE', '+995', 'Georgia', 'georgia', 'GEL', '', '0.00', '0.00', '', '', '', '', 'Active', '2014-12-13 09:18:53', 'No', '0', '0', '0', '', 'en'),
(73, 'SA', 'GF', '+594', 'French Guiana', 'french-guiana', 'EUR', '', '0.00', '0.00', '', '', '', '', 'Active', '2014-12-13 09:19:18', 'No', '0', '0', '0', '', 'en'),
(74, '', 'GG', '+44', 'Guernsey', 'guernsey', 'GGP', '', '0.00', '0.00', '', '', '', '', 'Active', '2014-12-13 09:19:48', 'No', '0', '0', '0', '', 'en'),
(75, 'AF', 'GH', '+233', 'Ghana', 'ghana', 'GHS', '', '0.00', '0.00', '', '', '', '', 'Active', '2014-12-13 09:20:00', 'No', '0', '0', '0', '', 'en'),
(76, 'NA', 'GL', '+299', 'Greenland', 'greenland', 'DKK', '', '0.00', '0.00', '', '', '', '', 'Active', '2014-12-13 09:20:11', 'No', '0', '0', '0', '', 'en'),
(77, 'AF', 'GM', '+220', 'Gambia', 'gambia', 'GMD', '', '0.00', '0.00', '', '', '', '', 'Active', '2014-12-13 09:20:24', 'No', '0', '0', '0', '', 'en'),
(78, 'AF', 'GN', '+224 ', 'Guinea', 'guinea', 'GNF', '', '0.00', '0.00', '', '', '', '', 'Active', '2014-12-13 09:21:16', 'No', '0', '0', '0', '', 'en'),
(79, 'NA', 'GP', '+590', 'Guadeloupe', 'guadeloupe', 'EUD', '', '0.00', '0.00', '', '', '', '', 'Active', '2014-12-13 09:21:30', 'No', '0', '0', '0', '', 'en'),
(80, 'AF', 'GQ', '+240', 'Equatorial Guinea', 'equatorial-guinea', 'XAF', '', '0.00', '0.00', '', '', '', '', 'Active', '2014-12-13 09:21:43', 'No', '0', '0', '0', '', 'en'),
(81, 'EU', 'GR', '+30', 'Greece', 'greece', 'EUR', '', '0.00', '0.00', '', '', '', '', 'Active', '2014-12-13 09:22:04', 'No', '0', '0', '0', '', 'en'),
(82, 'NA', 'GT', '+502', 'Guatemala', 'guatemala', 'QTQ', '', '0.00', '0.00', '', '', '', '', 'Active', '2014-12-13 09:22:51', 'No', '0', '0', '0', '', 'en'),
(83, 'OC', 'GU', '+1 671', 'Guam', 'guam', 'USD', '', '0.00', '0.00', '', '', '', '', 'Active', '2014-12-13 09:23:11', 'No', '0', '0', '0', '', 'en'),
(84, 'AF', 'GW', '+245', 'Guinea-Bissau', 'guineabissau', 'GWP', '', '0.00', '0.00', '', '', '', '', 'Active', '2014-12-13 09:23:31', 'No', '0', '0', '0', '', 'en'),
(85, 'SA', 'GY', '+592', 'Guyana', 'guyana', 'GYD', '', '0.00', '0.00', '', '', '', '', 'Active', '2014-12-13 09:23:51', 'No', '0', '0', '0', '', 'en'),
(86, 'AS', 'HK', '+852', 'Hong Kong', 'hong-kong', 'HKD', '', '0.00', '0.00', '', '', '', '', 'Active', '2014-12-13 09:24:09', 'No', '0', '0', '0', '', 'en'),
(87, 'NA', 'HN', '+504', 'Honduras', 'honduras', 'HNL', '', '0.00', '0.00', '', '', '', '', 'Active', '2014-12-13 09:24:21', 'No', '0', '0', '0', '', 'en'),
(88, 'EU', 'HR', '+385', 'Croatia', 'croatia', 'HRK', '', '0.00', '0.00', '', '', '', '', 'Active', '2014-12-13 09:24:35', 'No', '0', '0', '0', '', 'en'),
(89, 'NA', 'HT', '+509', 'Haiti', 'haiti', 'HTG', '', '0.00', '0.00', '', '', '', '', 'Active', '2014-12-13 09:24:49', 'No', '0', '0', '0', '', 'en'),
(90, 'EU', 'HU', '+36', 'Hungary', 'hungary', 'HUF', '', '0.00', '0.00', '', '', '', '', 'Active', '2014-12-13 09:25:05', 'No', '0', '0', '0', '', 'en'),
(91, 'AS', 'ID', '+62', 'Indonesia', 'indonesia', 'IDR', '', '0.00', '0.00', '', '', '', '', 'Active', '2014-12-13 09:25:23', 'No', '0', '0', '0', '', 'en'),
(92, 'EU', 'IE', '+353', 'Ireland', 'ireland', 'EUR', '', '0.00', '0.00', '', '', '', '', 'Active', '2014-12-13 09:25:40', 'No', '0', '0', '0', '', 'en'),
(93, 'AS', 'IL', '+972 ', 'Israel', 'israel', 'ILS', '', '0.00', '0.00', '', '', '', '', 'Active', '2014-12-13 09:26:06', 'No', '0', '0', '0', '', 'en'),
(94, '', 'IM', '+44', 'Isle Of Man', 'isle-of-man', 'GBP', '', '0.00', '0.00', '', '', '', '', 'Active', '2014-12-13 09:26:18', 'No', '0', '0', '0', '', 'en'),
(95, 'AS', 'IN', '+91', 'India', 'india', 'INR', '0', '15.00', '10.00', '', '', '', '', 'Active', '2015-04-28 10:51:02', 'Yes', '0', '0', '0', '', 'en'),
(96, 'AS', 'IO', '+246', 'British Indian Ocean Territory', 'british-indian-ocean-territory', 'USD', '', '0.00', '0.00', '', '', '', '', 'Active', '2014-12-13 09:27:18', 'No', '0', '0', '0', '', 'en'),
(97, 'AS', 'IQ', '+964', 'Iraq', 'iraq', 'IQD', '', '0.00', '0.00', '', '', '', '', 'Active', '2014-12-13 09:27:40', 'No', '0', '0', '0', '', 'en'),
(98, '', 'IR', '+98', 'Iran', 'iran', 'IRR', '', '0.00', '0.00', '', '', '', '', 'Active', '2014-12-13 09:27:52', 'No', '0', '0', '0', '', 'en'),
(99, 'EU', 'IS', '+354', 'Iceland', 'iceland', 'ISK', '', '0.00', '0.00', '', '', '', '', 'Active', '2014-12-13 09:28:08', 'No', '0', '0', '0', '', 'en'),
(100, 'EU', 'IT', '+39', 'Italy', 'italy', 'EUR', '', '0.00', '0.00', '', '', '', '', 'Active', '2014-12-13 09:44:29', 'No', '0', '0', '0', '', 'en'),
(101, '', 'JE', '+44 ', 'Jersey', 'jersey', 'GBP', '', '0.00', '0.00', '', '', '', '', 'Active', '2014-12-13 09:44:54', 'No', '0', '0', '0', '', 'en'),
(102, 'NA', 'JM', '+1 876', 'Jamaica', 'jamaica', 'JMD', '', '0.00', '0.00', '', '', '', '', 'Active', '2014-12-13 09:45:08', 'No', '0', '0', '0', '', 'en'),
(103, 'AS', 'JO', '+962', 'Jordan', 'jordan', 'JOD', '', '0.00', '0.00', '', '', '', '', 'Active', '2014-12-13 09:45:25', 'No', '0', '0', '0', '', 'en'),
(104, 'AS', 'JP', '+81 ', 'Japan', 'japan', 'JPY', '', '0.00', '0.00', '', '', '', '', 'Active', '2014-12-13 09:45:44', 'No', '0', '0', '0', '', 'en'),
(105, 'AF', 'KE', '+254', 'Kenya', 'kenya', 'KES', '', '0.00', '0.00', '', '', '', '', 'Active', '2014-12-13 09:45:56', 'No', '0', '0', '0', '', 'en'),
(106, 'AS', 'KG', '+996', 'Kyrgyzstan', 'kyrgyzstan', 'KGS', '', '0.00', '0.00', '', '', '', '', 'Active', '2014-12-13 09:46:19', 'No', '0', '0', '0', '', 'en'),
(107, 'AS', 'KH', '+855', 'Cambodia', 'cambodia', 'KHR', '', '0.00', '0.00', '', '', '', '', 'Active', '2014-12-13 09:46:29', 'No', '0', '0', '0', '', 'en'),
(108, 'OC', 'KI', '+686', 'Kiribati', 'kiribati', 'AUD', '', '0.00', '0.00', '', '', '', '', 'Active', '2014-12-13 09:46:38', 'No', '0', '0', '0', '', 'en'),
(109, 'AF', 'KM', '+269', 'Comoros', 'comoros', 'KMF', '', '0.00', '0.00', '', '', '', '', 'Active', '2014-12-13 09:46:53', 'No', '0', '0', '0', '', 'en'),
(110, 'NA', 'KN', '+1 869', 'Saint Kitts And Nevis', 'saint-kitts-and-nevis', 'XCD', '', '0.00', '0.00', '', '', '', '', 'Active', '2014-12-13 09:47:06', 'No', '0', '0', '0', '', 'en'),
(111, '', 'KP', '+850', 'North Korea', 'north-korea', 'KPW', '', '0.00', '0.00', '', '', '', '', 'Active', '2014-12-13 09:47:21', 'No', '0', '0', '0', '', 'en'),
(112, '', 'KR', '+82', 'South Korea', 'south-korea', 'KRW', '', '0.00', '0.00', '', '', '', '', 'Active', '2014-12-13 09:47:34', 'No', '0', '0', '0', '', 'en'),
(113, 'AS', 'KW', '+965', 'Kuwait', 'kuwait', 'KWD', '', '0.00', '0.00', '', '', '', '', 'Active', '2014-12-13 09:47:47', 'No', '0', '0', '0', '', 'en'),
(114, 'AS', 'KZ', '+7', 'Kazakhstan', 'kazakhstan', 'KZT', '', '0.00', '0.00', '', '', '', '', 'Active', '2014-12-13 09:48:00', 'No', '0', '0', '0', '', 'en'),
(115, '', 'LA', '+856', 'Laos', 'laos', 'LAK', '', '0.00', '0.00', '', '', '', '', 'Active', '2014-12-13 09:48:14', 'No', '0', '0', '0', '', 'en'),
(116, 'AS', 'LB', '+961', 'Lebanon', 'lebanon', 'LBP', '', '0.00', '0.00', '', '', '', '', 'Active', '2014-12-13 09:48:24', 'No', '0', '0', '0', '', 'en'),
(117, 'NA', 'LC', '+1 758', 'Saint Lucia', 'saint-lucia', 'XCD', '', '0.00', '0.00', '', '', '', '', 'Active', '2014-12-13 09:48:44', 'No', '0', '0', '0', '', 'en'),
(118, 'EU', 'LI', '+423', 'Liechtenstein', 'liechtenstein', 'CHF', '', '0.00', '0.00', '', '', '', '', 'Active', '2014-12-13 09:48:58', 'No', '0', '0', '0', '', 'en'),
(119, 'AS', 'LK', '+94', 'Sri Lanka', 'sri-lanka', 'LKR', 'Rs', '20.00', '12.00', '', '', '', '', 'Active', '2014-12-13 09:49:12', 'No', '0', '0', '0', '', 'en'),
(120, 'AF', 'LR', '+231', 'Liberia', 'liberia', 'LRD', '', '0.00', '0.00', '', '', '', '', 'Active', '2014-12-13 09:49:26', 'No', '0', '0', '0', '', 'en'),
(121, 'AF', 'LS', '+266', 'Lesotho', 'lesotho', 'LSL', '', '0.00', '0.00', '', '', '', '', 'Active', '2014-12-13 11:07:37', 'No', '0', '0', '0', '', 'en'),
(122, 'EU', 'LT', '+370', 'Lithuania', 'lithuania', 'LTL', '', '0.00', '0.00', '', '', '', '', 'Active', '2014-12-13 11:07:49', 'No', '0', '0', '0', '', 'en'),
(123, 'EU', 'LU', '+352', 'Luxembourg', 'luxembourg', 'EUR', '', '0.00', '0.00', '', '', '', '', 'Active', '2014-12-13 11:08:03', 'No', '0', '0', '0', '', 'en'),
(124, 'EU', 'LV', '+371', 'Latvia', 'latvia', 'LVL', '', '0.00', '0.00', '', '', '', '', 'Active', '2014-12-13 11:08:17', 'No', '0', '0', '0', '', 'en'),
(125, '', 'LY', '+ 218', 'Libya', 'libya', 'LYD', '', '0.00', '0.00', '', '', '', '', 'Active', '2014-12-13 11:08:34', 'No', '0', '0', '0', '', 'en'),
(126, 'AF', 'MA', '+212', 'Morocco', 'morocco', 'MAD', '', '0.00', '0.00', '', '', '', '', 'Active', '2014-12-13 11:09:49', 'No', '0', '0', '0', '', 'en'),
(127, 'EU', 'MC', '+377', 'Monaco', 'monaco', 'EUR', '', '0.00', '0.00', '', '', '', '', 'Active', '2014-12-13 11:10:06', 'No', '0', '0', '0', '', 'en'),
(128, '', 'MD', '+373', 'Moldova', 'moldova', 'MDL', '', '0.00', '0.00', '', '', '', '', 'Active', '2014-12-13 11:10:20', 'No', '0', '0', '0', '', 'en'),
(129, '', 'ME', '+382', 'Montenegro', 'montenegro', 'EUR', '', '0.00', '0.00', '', '', '', '', 'Active', '2014-12-13 11:10:33', 'No', '0', '0', '0', '', 'en'),
(130, 'AF', 'MG', '+261', 'Madagascar', 'madagascar', 'MGF', '', '0.00', '0.00', '', '', '', '', 'Active', '2014-12-13 11:10:47', 'No', '0', '0', '0', '', 'en'),
(131, 'OC', 'MH', '+692', 'Marshall Islands', 'marshall-islands', 'USD', '', '0.00', '0.00', '', '', '', '', 'Active', '2014-12-13 11:11:04', 'No', '0', '0', '0', '', 'en'),
(132, '', 'MK', '+389', 'Macedonia', 'macedonia', 'MKD', '', '0.00', '0.00', '', '', '', '', 'Active', '2014-12-13 11:11:20', 'No', '0', '0', '0', '', 'en'),
(133, 'AF', 'ML', '+223', 'Mali', 'mali', 'XOF', '', '0.00', '0.00', '', '', '', '', 'Active', '2014-12-13 11:11:33', 'No', '0', '0', '0', '', 'en'),
(134, 'AS', 'MM', '+95', 'Myanmar', 'myanmar', 'MMK', '', '0.00', '0.00', '', '', '', '', 'Active', '2014-12-13 11:12:12', 'No', '0', '0', '0', '', 'en'),
(135, 'AS', 'MN', '+976', 'Mongolia', 'mongolia', 'MNT', '', '0.00', '0.00', '', '', '', '', 'Active', '2014-12-13 11:12:26', 'No', '0', '0', '0', '', 'en'),
(136, '', 'MO', '+853', 'Macao', 'macao', 'MOP', '', '0.00', '0.00', '', '', '', '', 'Active', '2014-12-13 11:12:38', 'No', '0', '0', '0', '', 'en'),
(137, 'OC', 'MP', '+1 670', 'Northern Mariana Islands', 'northern-mariana-islands', 'USD', '', '0.00', '0.00', '', '', '', '', 'Active', '2014-12-13 11:12:58', 'No', '0', '0', '0', '', 'en'),
(138, 'NA', 'MQ', '+596', 'Martinique', 'martinique', 'EUR', '', '0.00', '0.00', '', '', '', '', 'Active', '2014-12-13 11:13:48', 'No', '0', '0', '0', '', 'en'),
(139, 'AF', 'MR', '+222', 'Mauritania', 'mauritania', 'MRO', '', '0.00', '0.00', '', '', '', '', 'Active', '2014-12-13 11:14:00', 'No', '0', '0', '0', '', 'en'),
(140, 'NA', 'MS', '+1664', 'Montserrat', 'montserrat', 'XCD', '', '0.00', '0.00', '', '', '', '', 'Active', '2014-12-13 11:14:26', 'No', '0', '0', '0', '', 'en'),
(141, 'AF', 'MU', '+230', 'Mauritius', 'mauritius', 'MUR', '', '0.00', '0.00', '', '', '', '', 'Active', '2014-12-13 11:15:18', 'No', '0', '0', '0', '', 'en'),
(142, 'AS', 'MV', '+960', 'Maldives', 'maldives', 'MVR', '', '0.00', '0.00', '', '', '', '', 'Active', '2014-12-13 11:15:31', 'No', '0', '0', '0', '', 'en'),
(143, 'AF', 'MW', '+265', 'Malawi', 'malawi', 'MWK', '', '0.00', '0.00', '', '', '', '', 'Active', '2014-12-13 11:15:47', 'No', '0', '0', '0', '', 'en'),
(144, 'NA', 'MX', '+52', 'Mexico', 'mexico', 'MXN', '', '0.00', '0.00', '', '', '', 0x3c703e3c7374726f6e673e54726176656c696e6720746f204d657869636f3c2f7374726f6e673e3c2f703e0d0a3c703e4d657869636f207661636174696f6e2072656e74616c7320616e64204d657869636f207661636174696f6e20686f6d6573206861766520696e6372656173656420696e20766f6c756d652c206173206861732074686520746f757269736d20696e64757374727920696e2074686520617265612e2054686973206973206f6e65206f6620746865206d6f737420706f70756c617220706c6163657320746f20766973697420696e207468652077686f6c65206f66204e6f7274682020416d657269636120616e64206974206973206561737920746f20736565207768792e204d657869636f20636f766572732061206875676520737572666163652061726561206f662061726f756e64203736302c30303020737175617265206d696c65732c207768696368206d65616e73207468657265206973206365727461696e6c79206e6f7420612073686f7274616765206f66207468696e677320746f2073656520616e6420646f20686572652e3c2f703e0d0a3c703e266e6273703b3c2f703e0d0a3c703e3c7374726f6e673e5468696e677320746f20646f20696e204d657869636f3c2f7374726f6e673e3c2f703e0d0a3c703e416674657220636865636b696e6720696e746f204d657869636f207661636174696f6e2072656e74616c7320616e64204d657869636f207661636174696f6e20686f6d65732c206c697374696e672074686520706c6163657320746f207669736974206973206365727461696e6c79206120776f727468207768696c65207468696e6720746f20646f2e204f6e65207468696e672074686174207468697320706c616365206973206b6e6f776e20666f7220697320686176696e6720736f6d65206772656174207369746573206f66206172636861656f6c6f676963616c20696e7465726573742c2077686963682061726520677265617420776974682070656f706c652074686174206c6f766520746f206578706c6f72652e2049742077617320686572652074686174206d616e7920646966666572656e7420666f726d73206f6620636f6d6d756e69636174696f6e207765726520646576656c6f7065642c20696e636c7564696e672077726974696e672e20416c6f6e677369646520746869732c206c6f7473206f662061726974686d6574696320616e6420617374726f6e6f6d7920626173656420646973636f7665726965732068617665206265656e206d6164652068657265206f766572207468652063656e7475726965732c207768696368206d616b6573207468697320616e20696e746572657374696e6720706c61636520746f20766973697420666f7220616c6c206f66207468652066616d696c792e3c2f703e0d0a3c703e266e6273703b3c2f703e0d0a3c703e4f6620636f757273652c206120766973697420746f2061204d657869636f207661636174696f6e2072656e74616c2077696c6c20616c6c6f772070656f706c6520746f206578706c6f726520736f6d65206f6620746865206d616e792062656163686573207468617420617265206f6e206f666665722e20546865207265616c6974792069732074686174207468657265206973206365727461696e6c79206e6f7420612073686f7274616765206f6620746f70207175616c697479206265616368657320746f206578706c6f72652e204d657869636f20697320686f6d6520746f2061726f756e6420362c303030206d696c6573206f6620636f617374206c696e652c207768696368206d65616e7320746861742074686572652061726520612067726561742072616e6765206f6620646966666572656e7420626561636865732c20696e636c7564696e6720636f7665732c2063617665732062757420616c736f20736d616c6c20626179732e20546865207761766573206865726520617265206e6f7420706172746963756c61726c79206c617267652c20627574206d616e79206f66207468652062656163686573206172652077656c6c206b6e6f776e20666f7220696e636f72706f726174696e67206578636974696e672077617465722073706f72747320696e746f20657665727920646179206c6966652e3c2f703e0d0a3c703e266e6273703b3c2f703e0d0a3c703e416c6f6e677369646520746865206265616368657320616e6420746865206d616e79206172636861656f6c6f676963616c20646973636f76657269657320746861742061726520776f727468206578706c6f72696e672c20616e6f74686572206f7074696f6e20697320746f20657870657269656e6365206d616e79206f662074686520616476656e7475726573207468617420617265206f6e206f666665722e204d657869636f2069732066756c6c206f6620746f7572206775696465732074686174207370656369616c69736520696e20616c6c207479706573206f66207468696e67732e205468697320696e636c7564657320746865206c696b6573206f662034783420746f7572732c2062757420616c736f206775696465642077616c6b7320616e64206d6f756e7461696e2062696b652072696465732e205468697320616c6c6f77732070656f706c6520746f206578706c6f7265207468697320677265617420706c616365207573696e6720646966666572656e7420666f726d73206f66207472616e73706f72742c20776869636820616c6c6f7773207468656d20746f20736565204d657869636f20696e20612077686f6c65206e6577206c696768742e204f6620636f757273652c2074686572652061726520706c656e7479206f66206f7074696f6e7320746f2063686f6f73652066726f6d20686572652e3c2f703e0d0a3c703e266e6273703b3c2f703e0d0a3c703e3c7374726f6e673e4163636f6d6d6f646174696f6e7320696e204d657869636f3c2f7374726f6e673e3c2f703e0d0a3c703e4163636f6d6d6f646174696f6e7320696e204d657869636f2068617665206265656e206120687567652070617274206f662068656c70696e6720746f2067726f772074686520746f757269736d20696e64757374727920686572652e20546865205269747a204361726c746f6e206973206365727461696e6c79206f6e65206f6620746865206772656174657220686f74656c7320696e2074686520617265612e204a75737420696e2066726f6e74206f662069742c2069732061726f756e6420312c3230306674206f662077686974652073616e64792062656163682c207768696368206d65616e732072656c6178696e672068657265206973206365727461696e6c79206e6f7420676f696e6720746f20626520646966666963756c742e20497420697320636f6e76656e69656e746c79206c6f63617465642c207768696368206d65616e73207468617420616c6c20746865206d616a6f722061747472616374696f6e73206172652077697468696e20612073686f72742064697374616e6365206f662074686520686f74656c20686572652e2054686520666163696c6974696573206865726520617265206d6f7265207468616e206c75787572696f757320616e6420746865792068656c702070656f706c6520746f2073656520746865207472756520626561757479206f66204d657869636f2e3c2f703e0d0a3c703e266e6273703b3c2f703e0d0a3c703e3c7374726f6e673e5765617468657220696e204d657869636f3c2f7374726f6e673e3c2f703e0d0a3c703e546865207765617468657220696e204d657869636f206973206b6e6f776e20666f72206265696e6720657863657074696f6e616c20647572696e67207468652073756d6d6572206d6f6e7468732c207768696368206d616b6573206974207065726665637420666f7220612073756d6d6572207661636174696f6e2e20447572696e67207468652073756d6d6572206d6f6e7468732c207468726f7567686f757420746869732067726561742064657374696e6174696f6e2c2076697369746f72732073686f756c64206578706563742074656d706572617475726573206f662061726f756e6420323820266465673b43207768696368206973207761726d2c20627574206365727461696e6c7920636f6d666f727461626c65206174207468652073616d652074696d652e20497420697320647572696e67207468652073756d6d6572206d6f6e746873207468617420746865206d616a6f72697479206f662074686520746f757269737473207468617420766973697420686572652e3c2f703e, 'Active', '2014-12-13 11:16:20', 'No', '0', '0', '0', '', 'en'),
(145, 'AS', 'MY', '+60', 'Malaysia', 'malaysia', 'MYR', '', '0.00', '0.00', '', '', '', '', 'Active', '2015-02-19 09:18:00', 'No', '0', '0', '0', '', 'en'),
(146, 'AF', 'MZ', '+258', 'Mozambique', 'mozambique', 'MZN', '', '0.00', '0.00', '', '', '', '', 'Active', '2014-12-13 11:16:46', 'No', '0', '0', '0', '', 'en'),
(147, 'AF', 'NA', '+264', 'Namibia', 'namibia', 'NAD', '', '0.00', '0.00', '', '', '', '', 'Active', '2014-12-13 11:17:10', 'No', '0', '0', '0', '', 'en'),
(148, 'OC', 'NC', '+687', 'New Caledonia', 'new-caledonia', 'CFP', '', '0.00', '0.00', '', '', '', '', 'Active', '2014-12-13 11:17:31', 'No', '0', '0', '0', '', 'en'),
(149, 'AF', 'NE', '+227', 'Niger', 'niger', 'XOF', '', '0.00', '0.00', '', '', '', '', 'Active', '2014-12-13 11:18:48', 'No', '0', '0', '0', '', 'en'),
(150, 'AF', 'NG', '+234', 'Nigeria', 'nigeria', 'NGN', '', '0.00', '0.00', '', '', '', '', 'Active', '2014-12-13 11:19:28', 'No', '0', '0', '0', '', 'en'),
(151, 'NA', 'NI', '+505', 'Nicaragua', 'nicaragua', 'NIO', '', '0.00', '0.00', '', '', '', '', 'Active', '2014-12-13 11:19:48', 'No', '0', '0', '0', '', 'en'),
(152, 'EU', 'NL', '+31', 'Netherlands', 'netherlands', 'EUR', '', '0.00', '0.00', '', '', '', '', 'Active', '2014-12-13 11:20:05', 'No', '0', '0', '0', '', 'en'),
(153, 'EU', 'NO', '+47', 'Norway', 'norway', 'NOK', '', '0.00', '0.00', '', '', '', '', 'Active', '2014-12-13 11:20:23', 'No', '0', '0', '0', '', 'en'),
(154, 'AS', 'NP', '+977', 'Nepal', 'nepal', 'NPR', '', '0.00', '0.00', '', '', '', '', 'Active', '2014-12-13 11:20:36', 'No', '0', '0', '0', '', 'en'),
(155, 'OC', 'NR', '+674', 'Nauru', 'nauru', 'AUD', '', '0.00', '0.00', '', '', '', '', 'Active', '2014-12-13 11:20:59', 'No', '0', '0', '0', '', 'en'),
(156, 'OC', 'NZ', '+64', 'New Zealand', 'new-zealand', 'NZD', '', '0.00', '0.00', '', '', '', '', 'Active', '2014-12-13 11:21:14', 'No', '0', '0', '0', '', 'en'),
(157, 'AS', 'OM', '+968', 'Oman', 'oman', 'OMR', '', '0.00', '0.00', '', '', '', '', 'Active', '2014-12-13 11:21:28', 'No', '0', '0', '0', '', 'en'),
(158, 'NA', 'PA', '+507', 'Panama', 'panama', 'PAB', '', '0.00', '0.00', '', '', '', '', 'Active', '2014-12-13 11:21:42', 'No', '0', '0', '0', '', 'en'),
(159, 'SA', 'PE', '+51', 'Peru', 'peru', 'PEN', '', '0.00', '0.00', '', '', '', '', 'Active', '2014-12-13 11:21:53', 'No', '0', '0', '0', '', 'en'),
(160, 'OC', 'PF', '+689', 'French Polynesia', 'french-polynesia', 'CFP', '', '0.00', '0.00', '', '', '', '', 'Active', '2014-12-13 11:22:06', 'No', '0', '0', '0', '', 'en'),
(161, 'OC', 'PG', '+675', 'Papua New Guinea', 'papua-new-guinea', 'PGK', '', '0.00', '0.00', '', '', '', '', 'Active', '2014-12-13 11:22:20', 'No', '0', '0', '0', '', 'en'),
(162, 'AS', 'PH', '+63', 'Philippines', 'philippines', 'PHP', '', '0.00', '0.00', '', '', '', '', 'Active', '2014-12-13 11:22:36', 'No', '0', '0', '0', '', 'en'),
(163, 'AS', 'PK', '+92', 'Pakistan', 'pakistan', 'PKR', '', '0.00', '0.00', '', '', '', '', 'Active', '2014-12-13 11:22:51', 'No', '0', '0', '0', '', 'en'),
(164, 'EU', 'PL', '+48 ', 'Poland', 'poland', 'PLN', '', '0.00', '0.00', '', '', '', '', 'Active', '2014-12-13 11:23:11', 'No', '0', '0', '0', '', 'en'),
(165, '', 'PM', '+508', 'Saint Pierre And Miquelon', 'saint-pierre-and-miquelon', 'EUR', '', '0.00', '0.00', '', '', '', '', 'Active', '2014-12-13 11:23:39', 'No', '0', '0', '0', '', 'en'),
(166, 'NA', 'PR', '+787', 'Puerto Rico', 'puerto-rico', 'USD', '', '0.00', '0.00', '', '', '', '', 'Active', '2014-12-13 11:24:15', 'No', '0', '0', '0', '', 'en'),
(167, '', 'PS', '+970', 'Palestinian Territory', 'palestinian-territory', 'PAB', '', '0.00', '0.00', '', '', '', '', 'Active', '2014-12-13 11:24:43', 'No', '0', '0', '0', '', 'en'),
(168, 'EU', 'PT', '+351', 'Portugal', 'portugal', 'EUR', '', '0.00', '0.00', '', '', '', '', 'Active', '2014-12-13 11:25:07', 'No', '0', '0', '0', '', 'en'),
(169, 'OC', 'PW', '+680', 'Palau', 'palau', 'USD', '', '0.00', '0.00', '', '', '', '', 'Active', '2014-12-13 11:26:25', 'No', '0', '0', '0', '', 'en'),
(170, 'SA', 'PY', '+595', 'Paraguay', 'paraguay', 'PYG', '', '0.00', '0.00', '', '', '', '', 'Active', '2014-12-13 11:26:38', 'No', '0', '0', '0', '', 'en'),
(171, 'AS', 'QA', '+974', 'Qatar', 'qatar', 'QAR', '', '0.00', '0.00', '', '', '', '', 'Active', '2014-12-13 11:26:55', 'No', '0', '0', '0', '', 'en'),
(172, 'AF', 'RE', '+262', 'Reunion', 'reunion', 'EUR', '', '0.00', '0.00', '', '', '', '', 'Active', '2014-12-13 11:27:12', 'No', '0', '0', '0', '', 'en'),
(173, 'EU', 'RO', '+40', 'Romania', 'romania', 'RON', '', '0.00', '0.00', '', '', '', '', 'Active', '2014-12-13 11:27:23', 'No', '0', '0', '0', '', 'en'),
(174, '', 'RS', '+381', 'Serbia', 'serbia', 'RSD', '', '0.00', '0.00', '', '', '', '', 'Active', '2014-12-13 11:27:37', 'No', '0', '0', '0', '', 'en'),
(175, '', 'RU', '+7', 'Russia', 'russia', 'RUB', '', '0.00', '0.00', '', '', '', '', 'Active', '2014-12-13 11:27:54', 'No', '0', '0', '0', '', 'en'),
(176, 'AF', 'RW', '+250', 'Rwanda', 'rwanda', 'RWF', '', '0.00', '0.00', '', '', '', '', 'Active', '2014-12-13 11:28:06', 'No', '0', '0', '0', '', 'en'),
(177, 'AS', 'SA', '+966', 'Saudi Arabia', 'saudi-arabia', 'SAR', '', '0.00', '0.00', '', '', '', '', 'Active', '2014-12-13 11:28:20', 'No', '0', '0', '0', '', 'en'),
(178, 'OC', 'SB', '+677', 'Solomon Islands', 'solomon-islands', 'SBD', '', '0.00', '0.00', '', '', '', '', 'Active', '2014-12-13 11:28:38', 'No', '0', '0', '0', '', 'en'),
(179, 'AF', 'SC', '+248 ', 'Seychelles', 'seychelles', 'SCR', '', '0.00', '0.00', '', '', '', '', 'Active', '2014-12-13 11:30:16', 'No', '0', '0', '0', '', 'en'),
(180, 'AF', 'SD', '+249', 'Sudan', 'sudan', 'SDG', '', '0.00', '0.00', '', '', '', '', 'Active', '2014-12-13 11:30:30', 'No', '0', '0', '0', '', 'en'),
(181, 'EU', 'SE', '+46 ', 'Sweden', 'sweden', 'SEK', '', '0.00', '0.00', '', '', '', '', 'Active', '2014-12-13 11:31:07', 'No', '0', '0', '0', '', 'en'),
(182, 'AS', 'SG', '+65', 'Singapore', 'singapore', 'SGD', '', '0.00', '0.00', '', '', '', '', 'Active', '2014-12-13 11:31:24', 'No', '0', '0', '0', '', 'en'),
(183, '', 'SH', '+290', 'Saint Helena', 'saint-helena', 'SHP', '', '0.00', '0.00', '', '', '', '', 'Active', '2014-12-13 11:31:36', 'No', '0', '0', '0', '', 'en'),
(184, 'EU', 'SI', '+386', 'Slovenia', 'slovenia', 'EUR', '', '0.00', '0.00', '', '', '', '', 'Active', '2014-12-13 11:31:50', 'No', '0', '0', '0', '', 'en'),
(185, '', 'SJ', '+47', 'Svalbard And Jan Mayen', 'svalbard-and-jan-mayen', 'NOK', '', '0.00', '0.00', '', '', '', '', 'Active', '2014-12-13 11:32:26', 'No', '0', '0', '0', '', 'en'),
(186, '', 'SK', '+421', 'Slovakia', 'slovakia', 'EUR', '', '0.00', '0.00', '', '', '', '', 'Active', '2014-12-13 11:32:38', 'No', '0', '0', '0', '', 'en'),
(187, 'AF', 'SL', '+232', 'Sierra Leone', 'sierra-leone', 'SLL', '', '0.00', '0.00', '', '', '', '', 'Active', '2014-12-13 11:32:52', 'No', '0', '0', '0', '', 'en'),
(188, 'EU', 'SM', '+378', 'San Marino', 'san-marino', 'EUR', '', '0.00', '0.00', '', '', '', '', 'Active', '2014-12-13 11:33:13', 'No', '0', '0', '0', '', 'en'),
(189, 'AF', 'SN', '+221', 'Senegal', 'senegal', 'XOF', '', '0.00', '0.00', '', '', '', '', 'Active', '2014-12-13 11:33:27', 'No', '0', '0', '0', '', 'en'),
(190, 'AF', 'SO', '+252', 'Somalia', 'somalia', 'SOS', '', '0.00', '0.00', '', '', '', '', 'Active', '2014-12-13 11:33:41', 'No', '0', '0', '0', '', 'en'),
(191, 'SA', 'SR', '+597', 'Suriname', 'suriname', 'SRD', '', '0.00', '0.00', '', '', '', '', 'Active', '2014-12-13 11:33:54', 'No', '0', '0', '0', '', 'en'),
(192, '', 'SS', '+211', 'South Sudan', 'south-sudan', 'SSP', '', '0.00', '0.00', '', '', '', '', 'Active', '2014-12-13 11:34:41', 'No', '0', '0', '0', '', 'en'),
(193, 'AF', 'ST', '+239', 'Sao Tome And Principe', 'sao-tome-and-principe', 'STD', '', '0.00', '0.00', '', '', '', '', 'Active', '2014-12-13 11:34:57', 'No', '0', '0', '0', '', 'en'),
(194, 'NA', 'SV', '+503', 'El Salvador', 'el-salvador', 'SVC', '', '0.00', '0.00', '', '', '', '', 'Active', '2014-12-13 11:35:19', 'No', '0', '0', '0', '', 'en'),
(195, '', 'SY', '+963', 'Syria', 'syria', 'SYP', '', '0.00', '0.00', '', '', '', '', 'Active', '2014-12-13 11:35:43', 'No', '0', '0', '0', '', 'en'),
(196, 'AF', 'SZ', '+268', 'Swaziland', 'swaziland', 'SZL', '', '0.00', '0.00', '', '', '', '', 'Active', '2014-12-13 11:36:03', 'No', '0', '0', '0', '', 'en'),
(197, 'AF', 'TD', '+235', 'Chad', 'chad', 'XAF', '', '0.00', '0.00', '', '', '', '', 'Active', '2014-12-13 11:37:02', 'No', '0', '0', '0', '', 'en'),
(198, 'AN', 'TF', '', 'French Southern Territories', 'french-southern-territories', 'EUR', '', '0.00', '0.00', '', '', '', '', 'Active', '2014-08-26 02:24:29', 'No', '0', '0', '0', '', 'en'),
(199, 'AF', 'TG', '+228', 'Togo', 'togo', 'XOF', '', '0.00', '0.00', '', '', '', '', 'Active', '2014-12-13 11:40:14', 'No', '0', '0', '0', '', 'en'),
(200, 'AS', 'TH', '+66', 'Thailand', 'thailand', 'THB', '', '0.00', '0.00', '', '', '', '', 'Active', '2014-12-13 11:40:38', 'No', '0', '0', '0', '', 'en'),
(201, 'AS', 'TJ', '+992', 'Tajikistan', 'tajikistan', 'TJS', '', '0.00', '0.00', '', '', '', '', 'Active', '2014-12-13 11:40:53', 'No', '0', '0', '0', '', 'en'),
(202, 'OC', 'TK', '+690', 'Tokelau', 'tokelau', 'NZD', '', '0.00', '0.00', '', '', '', '', 'Active', '2014-12-13 11:41:07', 'No', '0', '0', '0', '', 'en'),
(203, 'OC', 'TL', '+670', 'East Timor', 'east-timor', 'USD', '', '0.00', '0.00', '', '', '', '', 'Active', '2014-12-13 11:41:19', 'No', '0', '0', '0', '', 'en'),
(204, 'AS', 'TM', '+993', 'Turkmenistan', 'turkmenistan', 'TMT', '', '0.00', '0.00', '', '', '', '', 'Active', '2014-12-13 11:41:30', 'No', '0', '0', '0', '', 'en'),
(205, 'AF', 'TN', '+216', 'Tunisia', 'tunisia', 'TND', '', '0.00', '0.00', '', '', '', '', 'Active', '2014-12-13 11:41:44', 'No', '0', '0', '0', '', 'en'),
(206, 'OC', 'TO', '+676', 'Tonga', 'tonga', 'TOP', '', '0.00', '0.00', '', '', '', '', 'Active', '2014-12-13 11:42:00', 'No', '0', '0', '0', '', 'en'),
(207, 'AS', 'TR', '+90', 'Turkey', 'turkey', 'TRY', '', '0.00', '0.00', '', '', '', '', 'Active', '2014-12-13 11:48:51', 'No', '0', '0', '0', '', 'en'),
(208, 'NA', 'TT', '+868\n', 'Trinidad And Tobago', 'trinidad-and-tobago', 'TTD', '', '0.00', '0.00', '', '', '', '', 'Active', '2014-12-13 11:49:41', 'No', '0', '0', '0', '', 'en'),
(209, 'OC', 'TV', '+688', 'Tuvalu', 'tuvalu', 'AUD', '', '0.00', '0.00', '', '', '', '', 'Active', '2014-12-13 11:49:56', 'No', '0', '0', '0', '', 'en'),
(210, 'AS', 'TW', '+886', 'Taiwan', 'taiwan', 'TWD', '', '0.00', '0.00', '', '', '', '', 'Active', '2014-12-13 12:17:11', 'No', '0', '0', '0', '', 'en'),
(211, '', 'TZ', '+255', 'Tanzania', 'tanzania', 'TZS', '', '0.00', '0.00', '', '', '', '', 'Active', '2014-12-13 12:17:54', 'No', '0', '0', '0', '', 'en'),
(212, 'EU', 'UA', '+380', 'Ukraine', 'ukraine', 'UAH', '', '0.00', '0.00', '', '', '', '', 'Active', '2014-12-13 12:18:07', 'No', '0', '0', '0', '', 'en'),
(213, 'AF', 'UG', '+256', 'Uganda', 'uganda', 'UGX', '', '0.00', '0.00', '', '', '', '', 'Active', '2014-12-13 12:18:31', 'No', '0', '0', '0', '', 'en'),
(214, 'OC', 'UM', '+1', 'United States Minor Outlying Islands', 'united-states-minor-outlying-islands', 'USD', '', '0.00', '0.00', '', '', '', '', 'Active', '2014-12-13 12:20:23', 'No', '0', '0', '0', '', 'en'),
(215, 'NA', 'US', '+1', 'United States', 'united-states', 'USD', '0', '0.00', '0.00', '', '', '', '', 'Active', '2014-12-13 12:20:51', 'No', '0', '0', '0', '', 'da'),
(216, 'SA', 'UY', '+598\n', 'Uruguay', 'uruguay', 'UYU', '', '0.00', '0.00', '', '', '', '', 'Active', '2014-12-13 12:21:11', 'No', '0', '0', '0', '', 'en'),
(217, 'AS', 'UZ', '+998', 'Uzbekistan', 'uzbekistan', 'UZS', '', '0.00', '0.00', '', '', '', '', 'Active', '2014-12-13 12:21:22', 'No', '0', '0', '0', '', 'en'),
(218, 'NA', 'VC', '+1 784 ', 'Saint Vincent And The Grenadines', 'saint-vincent-and-the-grenadines', 'XCD', '', '0.00', '0.00', '', '', '', '', 'Active', '2014-12-13 12:21:38', 'No', '0', '0', '0', '', 'en'),
(219, 'SA', 'VE', '+58', 'Venezuela', 'venezuela', 'VEF', '', '0.00', '0.00', '', '', '', '', 'Active', '2014-12-13 12:21:53', 'No', '0', '0', '0', '', 'en'),
(220, '', 'VI', '+1 340', 'U.S. Virgin Islands', 'u.s.-virgin-islands', 'USD', '', '0.00', '0.00', '', '', '', '', 'Active', '2014-12-13 12:22:21', 'No', '0', '0', '0', '', 'en'),
(221, '', 'VN', '+84', 'Vietnam', 'vietnam', 'VND', '', '0.00', '0.00', '', '', '', '', 'Active', '2014-12-13 12:22:37', 'No', '0', '0', '0', '', 'en'),
(222, 'OC', 'VU', '+678', 'Vanuatu', 'vanuatu', 'VUV', '', '0.00', '0.00', '', '', '', '', 'Active', '2014-12-13 12:22:47', 'No', '0', '0', '0', '', 'en'),
(223, '', 'WF', '+681 ', 'Wallis And Futuna', 'wallis-and-futuna', 'XPF', '', '0.00', '0.00', '', '', '', '', 'Active', '2014-12-13 12:23:12', 'No', '0', '0', '0', '', 'en'),
(224, 'OC', 'WS', '+685', 'Samoa', 'samoa', 'WST', '', '0.00', '0.00', '', '', '', '', 'Active', '2014-12-13 12:23:28', 'No', '0', '0', '0', '', 'en'),
(225, '', 'XK', '+381', 'Kosovo', 'kosovo', 'EUR', '', '0.00', '0.00', '', '', '', '', 'Active', '2014-12-13 12:23:43', 'No', '0', '0', '0', '', 'en'),
(226, 'AS', 'YE', '+967', 'Yemen', 'yemen', 'YER', '', '0.00', '0.00', '', '', '', '', 'Active', '2014-12-13 12:23:55', 'No', '0', '0', '0', '', 'en'),
(227, 'AF', 'YT', '+262', 'Mayotte', 'mayotte', 'EUR', '', '0.00', '0.00', '', '', '', '', 'Active', '2014-12-13 12:24:08', 'No', '0', '0', '0', '', 'en'),
(228, 'AF', 'ZA', '+27', 'South Africa', 'south-africa', 'ZAR', '', '0.00', '0.00', '', '', '', '', 'Active', '2014-12-13 12:24:19', 'No', '0', '0', '0', '', 'en'),
(229, 'AF', 'ZM', '+260', 'Zambia', 'zambia', 'ZMW', '', '0.00', '0.00', '', '', '', '', 'Active', '2014-12-13 12:24:39', 'No', '0', '0', '0', '', 'en'),
(230, 'AF', 'ZW', '+263', 'Zimbabwe', 'zimbabwe', 'ZWD', '', '0.00', '0.00', '', '', '', '', 'Active', '2014-12-13 12:24:56', 'No', '0', '0', '0', '', 'en');

-- --------------------------------------------------------

--
-- Table structure for table `fc_couponcards`
--

CREATE TABLE IF NOT EXISTS `fc_couponcards` (
  `id` int(50) NOT NULL AUTO_INCREMENT,
  `coupon_name` varchar(250) NOT NULL,
  `code` varchar(50) NOT NULL,
  `price_type` enum('1','2','3') NOT NULL DEFAULT '1',
  `coupon_type` varchar(500) NOT NULL,
  `price_value` float(10,2) NOT NULL,
  `quantity` int(100) NOT NULL,
  `description` blob NOT NULL,
  `datefrom` date NOT NULL,
  `dateto` date NOT NULL,
  `category_id` varchar(500) NOT NULL,
  `product_id` varchar(500) NOT NULL,
  `status` enum('Active','Inactive') NOT NULL,
  `card_status` enum('redeemed','not used','expired') NOT NULL DEFAULT 'not used',
  `purchase_count` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `fc_currency`
--

CREATE TABLE IF NOT EXISTS `fc_currency` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `country_name` varchar(255) NOT NULL,
  `seourl` varchar(755) NOT NULL,
  `currency_symbols` text NOT NULL,
  `currency_rate` float(10,3) NOT NULL,
  `currency_type` char(3) NOT NULL,
  `meta_title` blob NOT NULL,
  `meta_keyword` blob NOT NULL,
  `meta_description` blob NOT NULL,
  `status` enum('Active','InActive') NOT NULL,
  `dateAdded` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `default_currency` enum('No','Yes') NOT NULL DEFAULT 'No',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=15 ;

--
-- Dumping data for table `fc_currency`
--

INSERT INTO `fc_currency` (`id`, `country_name`, `seourl`, `currency_symbols`, `currency_rate`, `currency_type`, `meta_title`, `meta_keyword`, `meta_description`, `status`, `dateAdded`, `default_currency`) VALUES
(3, 'United States Dollar', 'united-states-dollar', '$', 1.000, 'USD', '', '', '', 'Active', '2016-07-01 10:55:01', 'Yes'),
(5, 'Ecuador', 'ecuador', '€', 0.890, 'EUR', '', '', '', 'InActive', '2016-09-23 12:48:58', 'No'),
(13, 'United Kingdom', 'united-kingdom', '£', 0.790, 'GBP', '', '', '', 'Active', '2016-10-05 07:10:06', 'No');

-- --------------------------------------------------------

--
-- Table structure for table `fc_dispute`
--

CREATE TABLE IF NOT EXISTS `fc_dispute` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `prd_id` int(12) NOT NULL,
  `user_id` int(12) NOT NULL,
  `message` varchar(200) NOT NULL,
  `created_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `fc_help_main`
--

CREATE TABLE IF NOT EXISTS `fc_help_main` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `type` enum('Both','User','Host') NOT NULL DEFAULT 'Both',
  `status` enum('Active','InActive') NOT NULL DEFAULT 'Active',
  `lang` varchar(25) NOT NULL DEFAULT 'en',
  `toId` int(11) NOT NULL,
  `seo` varchar(250) CHARACTER SET utf8 DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `fc_help_question`
--

CREATE TABLE IF NOT EXISTS `fc_help_question` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `main` int(11) NOT NULL,
  `sub` int(11) NOT NULL,
  `question` text NOT NULL,
  `answer` text NOT NULL,
  `status` enum('Active','Inactive') NOT NULL,
  `feature` enum('yes','no') NOT NULL,
  `lang` varchar(25) NOT NULL DEFAULT 'en',
  `toId` int(11) NOT NULL,
  `seo` varchar(250) CHARACTER SET utf8 NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `fc_help_sub`
--

CREATE TABLE IF NOT EXISTS `fc_help_sub` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `main` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `type` enum('User','Host','Both') NOT NULL DEFAULT 'User',
  `status` enum('Active','Inactive') NOT NULL DEFAULT 'Active',
  `lang` varchar(25) NOT NULL DEFAULT 'en',
  `toId` int(11) NOT NULL,
  `seo` varchar(250) CHARACTER SET utf8 NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `fc_hostalert`
--

CREATE TABLE IF NOT EXISTS `fc_hostalert` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `hostId` int(11) NOT NULL,
  `propertyId` int(11) NOT NULL,
  `seen` enum('no','yes') NOT NULL DEFAULT 'no',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `fc_inbox`
--

CREATE TABLE IF NOT EXISTS `fc_inbox` (
  `id` int(100) NOT NULL AUTO_INCREMENT,
  `user_id` varchar(1000) NOT NULL,
  `sender_id` varchar(1000) NOT NULL,
  `product_id` int(100) NOT NULL,
  `description` blob NOT NULL,
  `dateAdded` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `mailsubject` varchar(1000) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `fc_inbox_new`
--

CREATE TABLE IF NOT EXISTS `fc_inbox_new` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL COMMENT 'sender id',
  `message` varchar(350) NOT NULL,
  `guide_id` int(11) NOT NULL COMMENT 'receiver id',
  `date_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `fc_inbox_reply`
--

CREATE TABLE IF NOT EXISTS `fc_inbox_reply` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `rental_id` int(11) NOT NULL,
  `sender_id` int(11) NOT NULL,
  `receiver_id` int(11) NOT NULL,
  `message` text NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `posted_by` enum('customer','host') NOT NULL,
  `msg_read` enum('no','yes') NOT NULL DEFAULT 'no',
  `convId` int(22) NOT NULL,
  `bookingno` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `fc_languages`
--

CREATE TABLE IF NOT EXISTS `fc_languages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(200) NOT NULL,
  `lang_code` varchar(100) NOT NULL,
  `status` enum('Active','Inactive') NOT NULL DEFAULT 'Active',
  `default_lang` varchar(40) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=39 ;

--
-- Dumping data for table `fc_languages`
--

INSERT INTO `fc_languages` (`id`, `name`, `lang_code`, `status`, `default_lang`) VALUES
(1, 'English', 'en', 'Active', 'Default'),
(4, 'dansk', 'da', 'Inactive', ''),
(5, 'Deutsch', 'de', 'Inactive', ''),
(10, 'Filipino', 'fil', 'Inactive', ''),
(12, 'Indonesian', 'id', 'Inactive', ''),
(14, 'Italiano', 'it', 'Inactive', ''),
(15, 'Lithuanian', 'lt', 'Inactive', ''),
(16, 'Nederlands', 'nl', 'Inactive', ''),
(17, 'norsk', 'no', 'Inactive', ''),
(18, 'Polski', 'pl', 'Inactive', ''),
(24, 'Suomi', 'fi', 'Inactive', ''),
(30, 'srpski (latinica)', 'sr-latn', 'Inactive', ''),
(31, 'svenska', 'sv', 'Inactive', ''),
(32, 'Thai', 'th', 'Inactive', ''),
(34, 'chinese', 'CN', 'Inactive', ''),
(35, 'French', 'FR', 'Inactive', ''),
(36, 'o0lp', '99', 'Inactive', ''),
(37, 'korean', 'kr', 'Active', ''),
(38, 'Spanish', 'es', 'Inactive', '');

-- --------------------------------------------------------

--
-- Table structure for table `fc_languages_known`
--

CREATE TABLE IF NOT EXISTS `fc_languages_known` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `language_code` varchar(100) NOT NULL,
  `language_name` varchar(200) NOT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=24 ;

--
-- Dumping data for table `fc_languages_known`
--

INSERT INTO `fc_languages_known` (`id`, `language_code`, `language_name`, `created`) VALUES
(1, '4096', 'Bahasa Indonesia', '2016-06-14 02:55:26'),
(2, '4194304', 'Bahasa Malaysia', '2014-11-25 11:13:53'),
(3, '32768', 'Bengali', '2014-11-25 11:14:49'),
(4, '16777216', 'Dansk', '2014-11-25 11:14:49'),
(5, '4', 'Deutsch', '2014-11-25 11:15:22'),
(6, '1', 'English', '2014-11-25 11:15:22'),
(7, '64', 'Espanol', '2015-09-30 12:32:05'),
(8, '2', 'FranÃƒÂ§ais', '2015-09-30 12:32:18'),
(9, '512', 'Hindi', '2014-11-25 11:16:26'),
(10, '16', 'Italiano', '2014-11-25 11:16:26'),
(11, '536870912', 'Magyar', '2014-11-25 11:16:54'),
(12, '8192', 'Nederlands', '2014-11-25 11:16:54'),
(13, '67108864', 'Norsk', '2014-11-25 11:17:21'),
(14, '2097152', 'Polski', '2014-11-25 11:17:21'),
(16, '131072', 'Punjabi', '2014-11-25 11:17:59'),
(17, '524288', 'Sign Language', '2014-11-25 11:18:46'),
(18, '134217728', 'Suomi', '2014-11-25 11:18:46'),
(19, '33554432', 'Svenska', '2014-11-25 11:19:12'),
(20, '8388608', 'Tagalog', '2014-11-25 11:19:12'),
(23, '262144', 'Russian', '2015-09-30 12:33:39');

-- --------------------------------------------------------

--
-- Table structure for table `fc_listings`
--

CREATE TABLE IF NOT EXISTS `fc_listings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `rooms_bed` longtext NOT NULL,
  `listing_values` longtext NOT NULL,
  `listings_info` longtext NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `fc_listings`
--

INSERT INTO `fc_listings` (`id`, `rooms_bed`, `listing_values`, `listings_info`) VALUES
(1, '{"bedrooms":"Studio,1,2,3,4,5,6,7,8,9","beds":"1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16+","bedtype":"airbed,futon,pull-out sofa,couch,real bed","bathrooms":"Private,Both,Shared","noofbathrooms":"1,2,3,4,5","min_stay":"1,2,3,4,5,6,7,8,9,10","accommodates":"1,2,3,4,5,6,7,8,9,10,10+","can_policy":"Flexible,Moderate,Strict"}', '{"Bedrooms":"1,2,3,4,5,6,7,8,9,10,11","Beds":"1,2,3,4,5,6,7,8,9,10","Bathrooms":"Private,public,both","minimum_stay":"1,2,3,4,5,6,7,8,9","accommodates":"1,2,3,4,5,6,7,8,9","New_value":"","test":""}', '');

-- --------------------------------------------------------

--
-- Table structure for table `fc_listing_types`
--

CREATE TABLE IF NOT EXISTS `fc_listing_types` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `status` enum('Active','InActive') NOT NULL DEFAULT 'Active',
  `type` enum('option','text') NOT NULL,
  `labelname` varchar(200) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=38 ;

--
-- Dumping data for table `fc_listing_types`
--

INSERT INTO `fc_listing_types` (`id`, `name`, `status`, `type`, `labelname`) VALUES
(23, 'Bedrooms', 'InActive', 'option', 'Bedrooms'),
(24, 'Beds', 'InActive', 'option', 'Beds'),
(26, 'Bathrooms', 'Active', 'option', 'Bathrooms'),
(30, 'minimum_stay', 'Active', 'option', 'minimum stay'),
(33, 'accommodates', 'Active', 'option', 'accommodates'),
(36, 'New_value', 'Active', 'text', 'New value'),
(37, 'test', 'InActive', 'option', 'test');

-- --------------------------------------------------------

--
-- Table structure for table `fc_lists`
--

CREATE TABLE IF NOT EXISTS `fc_lists` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `name` varchar(200) NOT NULL,
  `user_id` bigint(20) NOT NULL,
  `product_id` longtext NOT NULL,
  `followers` longtext NOT NULL,
  `banner` varchar(200) NOT NULL,
  `category_id` bigint(20) NOT NULL,
  `contributors` longtext NOT NULL,
  `contributors_invited` longtext NOT NULL,
  `product_count` bigint(20) NOT NULL,
  `followers_count` bigint(20) NOT NULL,
  `whocansee` enum('Everyone','Only me') NOT NULL DEFAULT 'Everyone',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `fc_listspace`
--

CREATE TABLE IF NOT EXISTS `fc_listspace` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `attribute_name` varchar(500) NOT NULL,
  `attribute_description` varchar(250) NOT NULL,
  `status` enum('Active','Inactive') NOT NULL,
  `dateAdded` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `attribute_seourl` varchar(500) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

--
-- Dumping data for table `fc_listspace`
--

INSERT INTO `fc_listspace` (`id`, `attribute_name`, `attribute_description`, `status`, `dateAdded`, `attribute_seourl`) VALUES
(9, 'Ambiance', '', 'Active', '2016-09-16 03:31:34', 'propertytype'),
(10, 'Venue Type', '', 'Active', '2015-07-07 06:51:40', 'roomtype');

-- --------------------------------------------------------

--
-- Table structure for table `fc_listspace_values`
--

CREATE TABLE IF NOT EXISTS `fc_listspace_values` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `listspace_id` int(11) NOT NULL,
  `list_value` varchar(250) NOT NULL,
  `list_description` varchar(250) NOT NULL,
  `other` varchar(200) NOT NULL,
  `image` varchar(250) NOT NULL,
  `products` longtext NOT NULL,
  `product_count` bigint(20) NOT NULL,
  `followers` longtext NOT NULL,
  `followers_count` bigint(20) NOT NULL,
  `list_value_seourl` text NOT NULL,
  `status` enum('Active','InActive') NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=54 ;

--
-- Dumping data for table `fc_listspace_values`
--

INSERT INTO `fc_listspace_values` (`id`, `listspace_id`, `list_value`, `list_description`, `other`, `image`, `products`, `product_count`, `followers`, `followers_count`, `list_value_seourl`, `status`) VALUES
(1, 2, 'demo', '', '', '', '', 0, '', 0, 'demo', 'Active'),
(3, 5, 'demo', '', 'no', '', '', 0, '', 0, 'demo', 'Active'),
(4, 4, 'demo', '', '', '', '', 0, '', 0, 'demo', 'Active'),
(5, 5, 'demo 2', '', 'no', '', '', 0, '', 0, 'demo2', 'Active'),
(6, 8, 'demo 2', '', '', '', '', 0, '', 0, 'demo2', 'Active'),
(17, 11, 'type', '', 'no', '', '', 0, '', 0, 'type', 'Active'),
(29, 9, 'House', 'House', 'Yes', 'apt2.jpg', '', 0, '', 0, 'house', 'Active'),
(30, 10, 'Private Room', '', 'no', 'Apartment2.png', '', 0, '', 0, 'privateroom', 'Active'),
(31, 9, 'Apartment', '', 'Yes', 'Apartment3.png', '', 0, '', 0, 'apartment', 'Active'),
(32, 9, 'Bed & Breakfast', '', 'no', 'images1.jpg', '', 0, '', 0, 'bedbreakfast', 'Active'),
(33, 9, 'Cabin', '', 'no', 'Apartment5.png', '', 0, '', 0, 'cabin', 'Active'),
(34, 10, 'Common Room', '', 'no', 'Apartment6.png', '', 0, '', 0, 'commonroom', 'Active'),
(35, 10, 'Shared Both room', '', 'no', 'Apartment7.png', '', 0, '', 0, 'sharedbothroom', 'Active'),
(40, 9, 'Villa', '', 'Yes', '', '', 0, '', 0, 'villa', 'Active'),
(41, 9, 'Budget Hotel', 'Budget Hotel', 'Yes', '1541535.jpg', '', 0, '', 0, 'budgethotel', 'Active'),
(42, 9, 'Tree House ', 'Tree House ', 'Yes', '', '', 0, '', 0, 'treehouse', 'Active'),
(43, 9, 'Kitchen', 'Kitchen', 'Yes', '', '', 0, '', 0, 'kitchen', 'Active'),
(44, 9, 'Slip', 'Slip', 'Yes', '', '', 0, '', 0, 'slip', 'Active'),
(45, 9, 'Mooring', 'Mooring', 'Yes', '', '', 0, '', 0, 'mooring', 'Active'),
(46, 9, 'Seawall', 'Seawall', 'Yes', '', '', 0, '', 0, 'seawall', 'Active'),
(47, 10, 'Standard Room ', 'Standard Room ', 'Yes', '', '', 0, '', 0, 'standardroom', 'Active'),
(48, 10, 'Executive Room', 'Executive Room', 'Yes', '', '', 0, '', 0, 'executiveroom', 'Active'),
(49, 10, 'Luxury Room ', 'Luxury Room ', 'Yes', '', '', 0, '', 0, 'luxuryroom', 'Active'),
(50, 10, 'House', 'House', 'Yes', '', '', 0, '', 0, 'house', 'Active'),
(51, 10, 'Garage', 'Garage', 'Yes', '', '', 0, '', 0, 'garage', 'Active'),
(52, 10, 'Single Room', 'Single Room', 'Yes', '', '', 0, '', 0, 'singleroom', 'Active'),
(53, 9, 'Beach house', 'house', 'no', '', '', 0, '', 0, 'beachhouse', 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `fc_list_sub_values`
--

CREATE TABLE IF NOT EXISTS `fc_list_sub_values` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `list_id` int(20) NOT NULL,
  `list_value_id` varchar(20) NOT NULL,
  `sub_list_value` varchar(250) NOT NULL,
  `image` varchar(250) NOT NULL,
  `products` longtext NOT NULL,
  `product_count` bigint(20) NOT NULL,
  `followers` longtext NOT NULL,
  `followers_count` bigint(20) NOT NULL,
  `sub_list_value_seourl` text NOT NULL,
  `status` enum('Active','Inactive') NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=13 ;

--
-- Dumping data for table `fc_list_sub_values`
--

INSERT INTO `fc_list_sub_values` (`id`, `list_id`, `list_value_id`, `sub_list_value`, `image`, `products`, `product_count`, `followers`, `followers_count`, `sub_list_value_seourl`, `status`) VALUES
(1, 1, '2', 'cxsacasc', '', '', 0, '', 0, '', 'Active'),
(2, 1, '1', 'Air Conditioning', 'Chrysanthemum.jpg', '', 0, '', 0, '', 'Active'),
(3, 1, '19', 'test', '', '', 0, '', 0, '', 'Active'),
(5, 1, '36', 'Cable TV', '', '', 0, '', 0, '', 'Active'),
(6, 1, '3', 'Buzzer/Wireless Internet', '', '', 0, '', 0, '', 'Active'),
(7, 7, '38', 'Cabin', '', '', 0, '', 0, '', 'Active'),
(8, 7, '1', 'Chalet', '', '', 0, '', 0, '', 'Active'),
(9, 7, '40', 'Dorm', '', '', 0, '', 0, '', 'Active'),
(10, 7, '38', 'Loft', '', '', 0, '', 0, '', 'Active'),
(11, 7, '39', 'Other', '', '', 0, '', 0, '', 'Active'),
(12, 7, '40', 'Villa', '', '', 0, '', 0, '', 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `fc_list_values`
--

CREATE TABLE IF NOT EXISTS `fc_list_values` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `list_id` int(11) NOT NULL,
  `list_value` varchar(200) NOT NULL,
  `image` varchar(250) NOT NULL,
  `products` longtext NOT NULL,
  `product_count` bigint(20) NOT NULL,
  `followers` longtext NOT NULL,
  `followers_count` bigint(20) NOT NULL,
  `list_value_seourl` text NOT NULL,
  `status` enum('Active','InActive') NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=93 ;

--
-- Dumping data for table `fc_list_values`
--

INSERT INTO `fc_list_values` (`id`, `list_id`, `list_value`, `image`, `products`, `product_count`, `followers`, `followers_count`, `list_value_seourl`, `status`) VALUES
(1, 1, 'Wireless Internet', 'wireless.png', '', 0, '', 1, 'wirelessinternet', 'Active'),
(3, 1, 'Kitchen', 'kitchen.png', '', 0, '', 0, 'kitchen', 'Active'),
(41, 1, 'Essentials', 'essential.png', '', 0, '', 0, 'essentials', 'Active'),
(42, 1, 'Cable TV', 'cable.png', '', 0, '', 0, 'cabletv', 'Active'),
(43, 4, 'Air Conditioning', 'airconditioner.png', '', 0, '', 0, 'airconditioning', 'Active'),
(44, 1, 'Heating', 'heating.png', '', 0, '', 0, 'heating', 'Active'),
(45, 1, 'Internet', 'internet_(2).png', '', 0, '', 0, 'internet', 'Active'),
(49, 1, 'Washer', 'washer.png', '', 0, '', 0, 'washer', 'Active'),
(50, 1, 'Dryer', 'dryer.png', '', 0, '', 0, 'dryer', 'Active'),
(51, 1, 'Breakfast', 'break.png', '', 0, '', 0, 'breakfast', 'Active'),
(52, 1, 'Family/Kid Friendly', 'family.png', '', 0, '', 0, 'familykidfriendly', 'Active'),
(53, 1, 'Suitable for Events', 'event.png', '', 0, '', 0, 'suitableforevents', 'Active'),
(55, 1, 'Wheelchair Accessible', 'weel.png', '', 0, '', 0, 'wheelchairaccessible', 'Active'),
(56, 1, 'Elevator in Building', 'elevator.png', '', 0, '', 0, 'elevatorinbuilding', 'Active'),
(57, 1, 'Indoor Fireplace', 'indoor.png', '', 0, '', 0, 'indoorfireplace', 'Active'),
(58, 1, 'Buzzer/ Wireless Intercom', 'buzzer.png', '', 0, '', 0, 'buzzerwirelessintercom', 'Active'),
(59, 1, 'Doorman', 'doorman.png', '', 0, '', 0, 'doorman', 'Active'),
(60, 1, 'Pool', 'pool.png', '', 0, '', 0, 'pool', 'Active'),
(61, 1, 'Hot Tub', 'hottub.png', '', 0, '', 0, 'hottub', 'Active'),
(62, 1, 'Gym', 'gym.png', '', 0, '', 0, 'gym', 'Active'),
(63, 1, 'Smoke Detector', 'smoke.png', '', 0, '', 0, 'smokedetector', 'Active'),
(64, 4, 'Hot Tub', 'hottub.png', '', 0, '', 0, 'hottub', 'Active'),
(65, 4, 'Washer', 'washer.png', '', 0, '', 0, 'washer', 'Active'),
(66, 4, 'Pool', 'pool.png', '', 0, '', 0, 'pool', 'Active'),
(67, 4, 'Dryer', 'dryer.png', '', 0, '', 0, 'dryer', 'Active'),
(68, 4, 'Breakfast', 'break.png', '', 0, '', 0, 'breakfast', 'Active'),
(69, 4, 'Free Parking on Premises', 'Parking.png', '', 0, '', 0, 'freeparkingonpremises', 'Active'),
(70, 4, 'Gym', 'gym.png', '', 0, '', 0, 'gym', 'Active'),
(71, 4, 'Elevator in Building', 'elevator.png', '', 0, '', 0, 'elevatorinbuilding', 'Active'),
(72, 4, 'Indoor Fireplace', 'indoor.png', '', 0, '', 0, 'indoorfireplace', 'Active'),
(73, 4, 'Buzzer/ Wireless Intercom', 'buzzer.png', '', 0, '', 0, 'buzzerwirelessintercom', 'Active'),
(74, 4, 'Doorman', 'doorman.png', '', 0, '', 0, 'doorman', 'Active'),
(75, 4, 'Shampoo', 'internet_(2)1.png', '', 0, '', 0, 'shampoo', 'Active'),
(82, 5, 'Family/Kid Friendly', 'family.png', '', 0, '', 0, 'familykidfriendly', 'Active'),
(83, 5, 'Wheelchair Accessible', 'weel.png', '', 0, '', 0, 'wheelchairaccessible', 'Active'),
(84, 5, 'Pets Allowed', 'Pets_Allowed.png', '', 0, '', 0, 'petsallowed', 'Active'),
(85, 5, 'Suitable for Events', 'event.png', '', 0, '', 0, 'suitableforevents', 'Active'),
(86, 5, 'Smoking Allowed', 'smoking.png', '', 0, '', 0, 'smokingallowed', 'Active'),
(90, 1, 'Outdoor Shower', 'internet_(2)2.png', '', 0, '', 0, 'outdoorshower', 'Active'),
(92, 1, 'ice', 'internet_(2)3.png', '', 0, '', 0, 'ice', 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `fc_location`
--

CREATE TABLE IF NOT EXISTS `fc_location` (
  `id` int(200) NOT NULL AUTO_INCREMENT,
  `location_name` varchar(1000) NOT NULL,
  `location_code` varchar(500) NOT NULL,
  `iso_code2` varchar(500) NOT NULL,
  `iso_code3` varchar(500) NOT NULL,
  `country_tax` float(10,2) NOT NULL,
  `country_ship` decimal(10,2) NOT NULL,
  `seourl` varchar(1000) NOT NULL,
  `currency_type` varchar(500) NOT NULL,
  `currency_symbol` varchar(500) NOT NULL,
  `status` enum('Active','InActive') NOT NULL,
  `dateAdded` datetime NOT NULL,
  `meta_title` longblob NOT NULL,
  `meta_keyword` longblob NOT NULL,
  `meta_description` longblob NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `fc_location`
--

INSERT INTO `fc_location` (`id`, `location_name`, `location_code`, `iso_code2`, `iso_code3`, `country_tax`, `country_ship`, `seourl`, `currency_type`, `currency_symbol`, `status`, `dateAdded`, `meta_title`, `meta_keyword`, `meta_description`) VALUES
(1, 'IN', '', '', '', 5.00, '15.00', 'india', 'INR', 'Rs', 'InActive', '2013-07-26 04:10:15', '', '', ''),
(3, 'USA', '', 'US', 'USA', 1.00, '0.00', 'usa', 'USD', '$', 'Active', '2013-07-26 12:00:00', 0x555341, 0x555341, 0x555341),
(6, 'Uk', '', '', '', 10.00, '10.00', 'uk', 'USD', '$', 'InActive', '2013-07-29 13:00:00', '', '', ''),
(7, 'Australia', '', 'AU', '', 10.00, '20.00', 'australia', 'AUD', '$', 'InActive', '2013-08-21 11:00:00', '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `fc_med_message`
--

CREATE TABLE IF NOT EXISTS `fc_med_message` (
  `id` int(25) NOT NULL AUTO_INCREMENT,
  `productId` int(25) NOT NULL,
  `bookingNo` varchar(250) NOT NULL,
  `senderId` int(25) NOT NULL,
  `receiverId` int(25) NOT NULL,
  `subject` varchar(250) NOT NULL,
  `message` text CHARACTER SET utf8 NOT NULL,
  `dateAdded` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `msg_read` enum('No','Yes') NOT NULL,
  `status` enum('Pending','Accept','Decline') NOT NULL,
  `point` enum('0','1','2') NOT NULL DEFAULT '0',
  `user_archive_status` enum('No','Yes') NOT NULL,
  `host_archive_status` enum('No','Yes') NOT NULL,
  `special_booking` varchar(50) NOT NULL,
  `b_prd_id` int(11) NOT NULL,
  `b_checkin` datetime NOT NULL,
  `b_checkout` datetime NOT NULL,
  `b_NoofGuest` int(11) NOT NULL,
  `b_numofdates` int(11) NOT NULL,
  `b_serviceFee` decimal(10,2) NOT NULL,
  `b_totalAmt` decimal(10,2) NOT NULL,
  `offer_accept` enum('Pending','Accept','Decline') NOT NULL DEFAULT 'Pending',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `fc_neighborhood`
--

CREATE TABLE IF NOT EXISTS `fc_neighborhood` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(32) NOT NULL,
  `seourl` varchar(250) NOT NULL,
  `status` enum('InActive','Active') NOT NULL,
  `category` varchar(1000) NOT NULL,
  `description` longblob NOT NULL,
  `meta_title` varchar(1000) NOT NULL,
  `meta_keyword` varchar(1000) NOT NULL,
  `meta_description` blob NOT NULL,
  `citylogo` varchar(1000) NOT NULL,
  `citythumb` varchar(1000) NOT NULL,
  `neighborhoods` varchar(1000) NOT NULL,
  `tags` varchar(1000) NOT NULL,
  `short_description` varchar(1000) NOT NULL,
  `featured` enum('0','1') NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `fc_newsletter`
--

CREATE TABLE IF NOT EXISTS `fc_newsletter` (
  `id` int(200) NOT NULL AUTO_INCREMENT,
  `news_title` varchar(5000) NOT NULL,
  `news_descrip` blob NOT NULL,
  `status` enum('Active','InActive') NOT NULL,
  `dateAdded` datetime NOT NULL,
  `news_image` varchar(500) NOT NULL,
  `news_subject` varchar(1000) NOT NULL,
  `sender_name` varchar(500) NOT NULL,
  `sender_email` varchar(500) NOT NULL,
  `news_seourl` varchar(1000) NOT NULL,
  `typeVal` enum('1','2') NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=49 ;

--
-- Dumping data for table `fc_newsletter`
--

INSERT INTO `fc_newsletter` (`id`, `news_title`, `news_descrip`, `status`, `dateAdded`, `news_image`, `news_subject`, `sender_name`, `sender_email`, `news_seourl`, `typeVal`) VALUES
(33, 'Reservation Confirmed to Admin', 0x3c7461626c6520636c6173733d2275692d736f727461626c652d68616e646c652063757272656e745461626c652220626f726465723d2230222077696474683d2231303025222063656c6c73706163696e673d2230222063656c6c70616464696e673d22302220616c69676e3d2263656e74657222206267636f6c6f723d2223346635393562223e0a3c74626f64793e0a3c74723e0a3c74643e0a3c7461626c6520636c6173733d22646576696365776964746822207374796c653d226261636b67726f756e642d636f6c6f723a20236638663866383b2220626f726465723d2230222077696474683d22363030222063656c6c73706163696e673d2230222063656c6c70616464696e673d22302220616c69676e3d2263656e746572223e0a3c74626f64793e0a3c74723e0a3c7464206267636f6c6f723d222334663539356222206865696768743d223330223e266e6273703b20266e6273703b20266e6273703b20266e6273703b20266e6273703b3c2f74643e0a3c2f74723e0a3c74723e0a3c746420616c69676e3d226c65667422206267636f6c6f723d2223346635393562223e3c696d67207374796c653d226d617267696e3a20313570782035707820303b2070616464696e673a203070783b20626f726465723a206e6f6e653b22207372633d227b626173655f75726c28297d696d616765732f6c6f676f2f7b246c6f676f7d2220616c743d227b246d6574615f7469746c657d222077696474683d2232303022202f3e3c2f74643e0a3c2f74723e0a3c74723e0a3c7464206267636f6c6f723d222334663539356222206865696768743d223330223e266e6273703b3c2f74643e0a3c2f74723e0a3c74723e0a3c746420636c6173733d226564697461626c6522207374796c653d22636f6c6f723a20236666666666663b20666f6e742d66616d696c793a204f70656e2053616e732c20417269616c2c2048656c7665746963612c2073616e732d73657269663b20666f6e742d73697a653a20313870783b20666f6e742d7765696768743a20626f6c643b20746578742d7472616e73666f726d3a207570706572636173653b2070616464696e673a2038707820323070783b206261636b67726f756e642d636f6c6f723a20233462626566663b2220616c69676e3d2263656e746572222076616c69676e3d226d6964646c65223e48692041646d696e3c2f74643e0a3c2f74723e0a3c74723e0a3c7464206865696768743d223530223e266e6273703b3c2f74643e0a3c2f74723e0a3c74723e0a3c7464207374796c653d22636f6c6f723a20233030303b2070616464696e673a2030707820323070783b20666f6e742d66616d696c793a204f70656e2053616e732c20417269616c2c2048656c7665746963612c2073616e732d73657269663b20666f6e742d73697a653a20313370783b2220616c69676e3d2263656e746572223e5765277265206578636974656420746f2074656c6c20796f752074686174207b2466697273745f6e616d657d207b246c6173745f6e616d657d206a75737420626f6f6b6564207b2472656e74616c5f6e616d657d2c20666f722074686520626f6f6b696e672023207b24626f6f6b696e674e6f7d2077697468207b2472656e7465725f666e616d657d207b2472656e7465725f6c6e616d657d3c2f74643e0a3c2f74723e0a3c74723e0a3c74643e266e6273703b3c2f74643e0a3c2f74723e0a3c74723e0a3c7464207374796c653d22636f6c6f723a20233030303b2070616464696e673a2030707820313070783b20666f6e742d7765696768743a20626f6c643b20666f6e742d66616d696c793a204f70656e2053616e732c20417269616c2c2048656c7665746963612c2073616e732d73657269663b20666f6e742d73697a653a20313370783b2220616c69676e3d2263656e746572222076616c69676e3d22746f70223e4974696e65726172793c2f74643e0a3c2f74723e0a3c74723e0a3c746420616c69676e3d2263656e746572222076616c69676e3d226d6964646c65223e0a3c646976207374796c653d226261636b67726f756e642d636f6c6f723a20236633343032653b20646973706c61793a207461626c653b20626f726465722d7261646975733a203570783b20636f6c6f723a20236666666666663b20666f6e742d66616d696c793a204f70656e2053616e732c20417269616c2c2073616e732d73657269663b20666f6e742d73697a653a20313370783b20746578742d7472616e73666f726d3a207570706572636173653b20666f6e742d7765696768743a20626f6c643b2070616464696e673a2037707820313270783b20746578742d616c69676e3a2063656e7465723b20746578742d6465636f726174696f6e3a206e6f6e653b2077696474683a2031343070783b206d617267696e3a206175746f3b223e3c61207374796c653d22636f6c6f723a20236666666666663b20746578742d6465636f726174696f6e3a206e6f6e653b2220687265663d227b626173655f75726c28297d72656e74616c2f7b247072645f69647d223e3c696d67207374796c653d2277696474683a2033303070783b22207372633d227b2472656e74616c5f696d6167657d2220616c743d2222202f3e207b2472656e74616c5f6e616d657d3c2f613e3c2f6469763e0a3c2f74643e0a3c2f74723e0a3c74723e0a3c746420616c69676e3d2263656e746572223e0a3c7461626c6520626f726465723d2230222077696474683d2231303025222063656c6c73706163696e673d2230222063656c6c70616464696e673d22302220616c69676e3d2263656e746572223e0a3c74626f64793e0a3c7472207374796c653d2270616464696e673a20313070783b20666c6f61743a206c6566743b223e0a3c746420616c69676e3d2263656e746572222076616c69676e3d22746f70223e0a3c7461626c6520626f726465723d2230222077696474683d22363030222063656c6c73706163696e673d2231222063656c6c70616464696e673d223522206267636f6c6f723d2223454145414541223e0a3c74626f6479207374796c653d22666f6e742d66616d696c793a204f70656e2053616e732c20417269616c2c2048656c7665746963612c2073616e732d73657269663b20666f6e742d73697a653a20313370783b223e0a3c74723e0a3c74682077696474683d223735223e54696d653c2f74683e0a3c74682077696474683d223735223e446174653c2f74683e0a3c2f74723e0a3c747220616c69676e3d2263656e746572223e0a3c7464206267636f6c6f723d2223464646464646223e4172726976653c2f74643e0a3c7464206267636f6c6f723d2223464646464646223e7b24636865636b696e7d3c2f74643e0a3c2f74723e0a3c747220616c69676e3d2263656e746572223e0a3c7464206267636f6c6f723d2223464646464646223e4465706172743c2f74643e0a3c7464206267636f6c6f723d2223464646464646223e7b24636865636b6f75747d3c2f74643e0a3c2f74723e0a3c2f74626f64793e0a3c2f7461626c653e0a3c2f74643e0a3c2f74723e0a3c2f74626f64793e0a3c2f7461626c653e0a3c2f74643e0a3c2f74723e0a3c74723e0a3c74643e266e6273703b3c2f74643e0a3c2f74723e0a3c74723e0a3c746420616c69676e3d2263656e746572223e0a3c7461626c6520626f726465723d2230222077696474683d2231303025222063656c6c73706163696e673d2230222063656c6c70616464696e673d22302220616c69676e3d2263656e746572223e0a3c74626f64793e0a3c7472207374796c653d2270616464696e673a20313070783b20666c6f61743a206c6566743b223e0a3c746420616c69676e3d2263656e746572222076616c69676e3d22746f70223e0a3c7461626c6520626f726465723d2230222077696474683d22363030222063656c6c73706163696e673d2231222063656c6c70616464696e673d2235223e0a3c74626f6479207374796c653d22666f6e742d66616d696c793a204f70656e2053616e732c20417269616c2c2048656c7665746963612c2073616e732d73657269663b20666f6e742d73697a653a20313370783b223e0a3c74723e0a3c746820616c69676e3d226c656674223e47756573743c2f74683e0a3c2f74723e0a3c7472206267636f6c6f723d2223454145414541223e0a3c74642077696474683d223135307078223e3c696d67207372633d2270726f647563742e706e672220616c743d2222202f3e3c2f74643e0a3c74643e0a3c7461626c6520626f726465723d2230222077696474683d2231303025222063656c6c73706163696e673d2230222063656c6c70616464696e673d22302220616c69676e3d2263656e746572223e0a3c74626f64793e0a3c74723e0a3c7464207374796c653d22666f6e742d66616d696c793a204f70656e2053616e732c20417269616c2c2048656c7665746963612c2073616e732d73657269663b20666f6e742d73697a653a20313370783b2070616464696e673a20357078203070783b223e7b2466697273745f6e616d657d207b246c6173745f6e616d657d3c2f74643e0a3c2f74723e0a3c74723e0a3c7464207374796c653d22666f6e742d66616d696c793a204f70656e2053616e732c20417269616c2c2048656c7665746963612c2073616e732d73657269663b20666f6e742d73697a653a20313370783b2070616464696e673a20357078203070783b223e7b2470685f6e6f7d3c2f74643e0a3c2f74723e0a3c2f74626f64793e0a3c2f7461626c653e0a3c2f74643e0a3c2f74723e0a3c2f74626f64793e0a3c2f7461626c653e0a3c2f74643e0a3c2f74723e0a3c2f74626f64793e0a3c2f7461626c653e0a3c2f74643e0a3c2f74723e0a3c74723e0a3c7464206865696768743d223330223e266e6273703b3c2f74643e0a3c2f74723e0a3c74723e0a3c7464207374796c653d22636f6c6f723a20233466353935623b20666f6e742d66616d696c793a204f70656e2053616e732c20417269616c2c2048656c7665746963612c2073616e732d73657269663b20666f6e742d73697a653a20313370783b206c696e652d6865696768743a20323070783b2070616464696e673a2030707820323070783b2220616c69676e3d226c656674222076616c69676e3d22746f70222077696474683d223330307078223e0a3c7461626c65207374796c653d2277696474683a20313030253b20666f6e742d73697a653a20313370783b223e0a3c74626f64793e0a3c74723e0a3c7464207374796c653d22626f726465722d626f74746f6d3a2031707820736f6c696420236262623b223e555344266e6273703b7b2470726963657d2a7b246e6f6f666e69676874737d204e696768743c2f74643e0a3c7464207374796c653d22626f726465722d626f74746f6d3a2031707820736f6c696420236262623b223e266e6273703b3c2f74643e0a3c7464207374796c653d22626f726465722d626f74746f6d3a2031707820736f6c696420236262623b2070616464696e673a20357078203070783b223e7b2473796d626f6c7d266e6273703b7b24616d6f756e747d3c2f74643e0a3c2f74723e0a3c74723e0a3c7464207374796c653d22626f726465722d626f74746f6d3a2031707820736f6c696420236262623b223e53657276696365204665653c2f74643e0a3c7464207374796c653d22626f726465722d626f74746f6d3a2031707820736f6c696420236262623b223e266e6273703b3c2f74643e0a3c7464207374796c653d22626f726465722d626f74746f6d3a2031707820736f6c696420236262623b2070616464696e673a20357078203070783b223e7b2473796d626f6c7d266e6273703b7b24736572766963654665657d3c2f74643e0a3c2f74723e0a3c74723e0a3c7464207374796c653d22626f726465722d626f74746f6d3a2031707820736f6c696420236262623b2070616464696e673a2031307078203070783b223e446973636f756e7420416d6f756e74282d293c2f74643e0a3c7464207374796c653d22626f726465722d626f74746f6d3a2031707820736f6c696420236262623b2070616464696e673a2031307078203070783b223e266e6273703b3c2f74643e0a3c7464207374796c653d22626f726465722d626f74746f6d3a2031707820736f6c696420236262623b2070616464696e673a2031307078203070783b223e7b2473796d626f6c7d207b24646973636f756e745f616d6f756e747d3c2f74643e0a3c2f74723e0a3c74723e0a3c7464207374796c653d22626f726465722d626f74746f6d3a2031707820736f6c696420236262623b2070616464696e673a2031307078203070783b223e546f74616c3c2f74643e0a3c7464207374796c653d22626f726465722d626f74746f6d3a2031707820736f6c696420236262623b2070616464696e673a2031307078203070783b223e266e6273703b3c2f74643e0a3c7464207374796c653d22626f726465722d626f74746f6d3a2031707820736f6c696420236262623b2070616464696e673a2031307078203070783b223e7b2473796d626f6c7d266e6273703b7b246e6574616d6f756e747d3c2f74643e0a3c2f74723e0a3c2f74626f64793e0a3c2f7461626c653e0a3c2f74643e0a3c2f74723e0a3c74723e0a3c7464206865696768743d223330223e266e6273703b3c2f74643e0a3c2f74723e0a3c74723e0a3c7464207374796c653d2270616464696e673a2030707820323070783b20636f6c6f723a20233434343434343b20666f6e742d66616d696c793a204f70656e2053616e732c20417269616c2c2048656c7665746963612c2073616e732d73657269663b20666f6e742d73697a653a20313370783b2220616c69676e3d226c656674222076616c69676e3d226d6964646c65223e0a3c703e5468616e6b73213c2f703e0a3c703e5468652052656e74657273205465616d3c2f703e0a3c2f74643e0a3c2f74723e0a3c74723e0a3c7464206865696768743d223330223e266e6273703b3c2f74643e0a3c2f74723e0a3c74723e0a3c7464206267636f6c6f723d222334663539356222206865696768743d223330223e266e6273703b3c2f74643e0a3c2f74723e0a3c74723e0a3c746420616c69676e3d2263656e74657222206267636f6c6f723d2223346635393562223e266e6273703b3c2f74643e0a3c2f74723e0a3c74723e0a3c7464206267636f6c6f723d222334663539356222206865696768743d223530223e266e6273703b3c2f74643e0a3c2f74723e0a3c2f74626f64793e0a3c2f7461626c653e0a3c2f74643e0a3c2f74723e0a3c2f74626f64793e0a3c2f7461626c653e, 'Active', '2016-10-05 03:25:28', '', 'Reservation Confirmed', 'Renters', 'rentersteam@teamtweaks.com', '', '1'),
(16, 'Reservation request to host', 0x3c7461626c6520636c6173733d2275692d736f727461626c652d68616e646c652063757272656e745461626c652220626f726465723d2230222063656c6c73706163696e673d2230222063656c6c70616464696e673d2230222077696474683d22313030252220616c69676e3d2263656e74657222206267636f6c6f723d2223346635393562223e0a3c74626f64793e0a3c74723e0a3c74643e0a3c7461626c6520636c6173733d22646576696365776964746822207374796c653d226261636b67726f756e642d636f6c6f723a20236638663866383b2220626f726465723d2230222063656c6c73706163696e673d2230222063656c6c70616464696e673d2230222077696474683d223630302220616c69676e3d2263656e746572223e0a3c74626f64793e0a3c74723e0a3c7464206865696768743d22333022206267636f6c6f723d2223346635393562223e266e6273703b3c2f74643e0a3c2f74723e0a3c74723e0a3c746420616c69676e3d226c65667422206267636f6c6f723d2223346635393562223e3c696d67207372633d227b626173655f75726c28297d696d616765732f6c6f676f2f7b246c6f676f7d2220616c743d226c6f676f222077696474683d2232303022202f3e266e6273703b20266e6273703b3c2f74643e0a3c2f74723e0a3c74723e0a3c7464206865696768743d22333022206267636f6c6f723d2223346635393562223e266e6273703b3c2f74643e0a3c2f74723e0a3c74723e0a3c746420636c6173733d226564697461626c6522207374796c653d22636f6c6f723a20236666666666663b20666f6e742d66616d696c793a204f70656e2053616e732c20417269616c2c2048656c7665746963612c2073616e732d73657269663b20666f6e742d73697a653a20313870783b20666f6e742d7765696768743a20626f6c643b20746578742d7472616e73666f726d3a207570706572636173653b2070616464696e673a2038707820323070783b206261636b67726f756e642d636f6c6f723a20233462626566663b2220616c69676e3d2263656e746572222076616c69676e3d226d6964646c65223e4772656174206e6577732120596f7520686176652061207265736572766174696f6e20726571756573742066726f6d207b2474726176656c6c65726e616d657d2e3c2f74643e0a3c2f74723e0a3c74723e0a3c7464206865696768743d223430223e266e6273703b3c2f74643e0a3c2f74723e0a3c74723e0a3c7464207374796c653d22636f6c6f723a20233030303b2070616464696e673a2030707820313070783b20666f6e742d7765696768743a20626f6c643b20666f6e742d66616d696c793a204f70656e2053616e732c20417269616c2c2048656c7665746963612c2073616e732d73657269663b20666f6e742d73697a653a20313370783b2220616c69676e3d2263656e746572222076616c69676e3d22746f70223e7b2474726176656c6c65726e616d657d20776f756c64206c696b6520746f2073746179206174207b2470726f647563745f6e616d657d2066726f6d207b24636865636b696e646174657d207468726f756768207b24636865636b6f7574646174657d3c2f74643e0a3c2f74723e0a3c74723e0a3c7464206865696768743d223430223e266e6273703b3c2f74643e0a3c2f74723e0a3c74723e0a3c7464207374796c653d22636f6c6f723a20233030303b2070616464696e673a2030707820313070783b20666f6e742d66616d696c793a204f70656e2053616e732c20417269616c2c2048656c7665746963612c2073616e732d73657269663b20666f6e742d73697a653a20313370783b2220616c69676e3d2263656e746572223e0a3c68343e4261736564206f6e20796f75722072617465206f66203c7370616e3e7b2473796d626f6c7d3c2f7370616e3e207b2470726963657d20706572206e6967687420616c6f6e6720776974682052656e7465727320666565732c20796f757220706f74656e7469616c207061796f757420666f722074686973207265736572766174696f6e206973203c7370616e3e7b2473796d626f6c7d266e6273703b3c2f7370616e3e7b24746f74616c70726963657d2e3c2f68343e0a3c2f74643e0a3c2f74723e0a3c74723e0a3c74643e266e6273703b3c2f74643e0a3c2f74723e0a3c74723e0a3c746420616c69676e3d2263656e746572222076616c69676e3d226d6964646c65223e0a3c646976207374796c653d226261636b67726f756e642d636f6c6f723a20236633343032653b20646973706c61793a207461626c653b20626f726465722d7261646975733a203570783b20636f6c6f723a20236666666666663b20666f6e742d66616d696c793a204f70656e2053616e732c20417269616c2c2073616e732d73657269663b20666f6e742d73697a653a20313370783b20746578742d7472616e73666f726d3a207570706572636173653b20666f6e742d7765696768743a20626f6c643b2070616464696e673a2037707820313270783b20746578742d616c69676e3a2063656e7465723b20746578742d6465636f726174696f6e3a206e6f6e653b2077696474683a2031343070783b206d617267696e3a206175746f3b223e3c61207374796c653d22636f6c6f723a20236666666666663b20746578742d6465636f726174696f6e3a206e6f6e653b2220687265663d227b626173655f75726c28297d696e626f78223e416363657074202f20204465636c696e653c2f613e3c2f6469763e0a3c2f74643e0a3c2f74723e0a3c74723e0a3c746420616c69676e3d2263656e746572223e0a3c7461626c6520626f726465723d2230222063656c6c73706163696e673d2230222063656c6c70616464696e673d2230222077696474683d22313030252220616c69676e3d2263656e746572223e0a3c74626f64793e0a3c7472207374796c653d2270616464696e673a20313070783b20666c6f61743a206c6566743b223e0a3c746420616c69676e3d2263656e746572222076616c69676e3d22746f70223e0a3c70207374796c653d226d617267696e3a203070783b2070616464696e673a2038707820313070783b20666f6e742d66616d696c793a204f70656e2053616e732c20417269616c2c2048656c7665746963612c2073616e732d73657269663b20666f6e742d73697a653a20313370783b206261636b67726f756e643a20236631663166313b223e5265736572766174696f6e20526571756573743c2f703e0a3c7461626c6520626f726465723d2230222063656c6c73706163696e673d2231222063656c6c70616464696e673d2235222077696474683d2236303022206267636f6c6f723d2223454145414541223e0a3c74626f6479207374796c653d22666f6e742d66616d696c793a204f70656e2053616e732c20417269616c2c2048656c7665746963612c2073616e732d73657269663b20666f6e742d73697a653a20313370783b223e0a3c74723e0a3c74682077696474683d223735223e54696d653c2f74683e203c74682077696474683d223735223e446174653c2f74683e0a3c2f74723e0a3c747220616c69676e3d2263656e746572223e0a3c7464206267636f6c6f723d2223464646464646223e4172726976653c2f74643e0a3c7464206267636f6c6f723d2223464646464646223e7b24636865636b696e646174657d3c2f74643e0a3c2f74723e0a3c747220616c69676e3d2263656e746572223e0a3c7464206267636f6c6f723d2223464646464646223e4465706172743c2f74643e0a3c7464206267636f6c6f723d2223464646464646223e7b24636865636b6f7574646174657d3c2f74643e0a3c2f74723e0a3c2f74626f64793e0a3c2f7461626c653e0a3c2f74643e0a3c2f74723e0a3c2f74626f64793e0a3c2f7461626c653e0a3c2f74643e0a3c2f74723e0a3c7472207374796c653d226d617267696e2d746f703a20313970783b20646973706c61793a20626c6f636b3b2070616464696e673a2030707820323070783b223e0a3c7464207374796c653d22636f6c6f723a20233434343434343b20666f6e742d66616d696c793a204f70656e2053616e732c20417269616c2c2048656c7665746963612c2073616e732d73657269663b20666f6e742d73697a653a20313270783b2220616c69676e3d226c656674222076616c69676e3d226d6964646c65223e3c7370616e3e7b2474726176656c6c65726e616d657d3c2f7370616e3e2773207265736572766174696f6e20726571756573742077696c6c2065787069726520616674657220323420686f75727320696620796f7520646f6e2774206f6666696369616c6c7920616363657074206f72206465636c696e652069742e3c2f74643e0a3c2f74723e0a3c7472207374796c653d226d617267696e2d746f703a20313970783b20646973706c61793a20626c6f636b3b2070616464696e673a2030707820323070783b223e0a3c7464207374796c653d22636f6c6f723a20233434343434343b20666f6e742d66616d696c793a204f70656e2053616e732c20417269616c2c2048656c7665746963612c2073616e732d73657269663b20666f6e742d73697a653a20313270783b2220616c69676e3d226c656674222076616c69676e3d226d6964646c65223e576520656e636f757261676520796f7520746f20726573706f6e6420617320717569636b6c7920617320706f737369626c6520736f20796f75722067756573742063616e20626567696e20746f20706c616e20746865697220616476656e74757265213c2f74643e0a3c2f74723e0a3c74723e0a3c74643e266e6273703b3c2f74643e0a3c2f74723e0a3c74723e0a3c7464207374796c653d22636f6c6f723a20233434343434343b20666f6e742d66616d696c793a204f70656e2053616e732c20417269616c2c2048656c7665746963612c2073616e732d73657269663b20666f6e742d73697a653a20313370783b2220616c69676e3d2263656e746572222076616c69676e3d226d6964646c65223e3c61207374796c653d22636f6c6f723a20233030393461613b20746578742d6465636f726174696f6e3a206e6f6e653b2220687265663d2223223e2852656d656d6265723a204e6f7420726573706f6e64696e6720746f207468697320626f6f6b696e672077696c6c20726573756c7420696e20796f7572206c697374696e67206265696e672072616e6b6564206c6f7765722e293c2f613e3c2f74643e0a3c2f74723e0a3c74723e0a3c74643e266e6273703b3c2f74643e0a3c2f74723e0a3c74723e0a3c7464206865696768743d223530223e266e6273703b3c2f74643e0a3c2f74723e0a3c74723e0a3c7464207374796c653d2270616464696e673a2030707820323070783b20636f6c6f723a20233434343434343b20666f6e742d66616d696c793a204f70656e2053616e732c20417269616c2c2048656c7665746963612c2073616e732d73657269663b20666f6e742d73697a653a20313370783b2220616c69676e3d226c656674222076616c69676e3d226d6964646c65223e0a3c703e5468616e6b73213c2f703e0a3c703e5468652052656e74657273205465616d3c2f703e0a3c2f74643e0a3c2f74723e0a3c74723e0a3c7464206865696768743d223330223e266e6273703b3c2f74643e0a3c2f74723e0a3c74723e0a3c7464206865696768743d22333022206267636f6c6f723d2223346635393562223e266e6273703b3c2f74643e0a3c2f74723e0a3c74723e0a3c746420616c69676e3d2263656e74657222206267636f6c6f723d2223346635393562223e266e6273703b3c2f74643e0a3c2f74723e0a3c74723e0a3c7464206865696768743d22353022206267636f6c6f723d2223346635393562223e266e6273703b3c2f74643e0a3c2f74723e0a3c2f74626f64793e0a3c2f7461626c653e0a3c2f74643e0a3c2f74723e0a3c2f74626f64793e0a3c2f7461626c653e, 'Active', '2016-08-09 12:53:21', '', 'Reservation request to host', 'Renters', 'rentersteam@teamtweaks.com', '', '1'),
(45, 'Review Added Notification ', 0x3c7461626c6520636c6173733d2275692d736f727461626c652d68616e646c652063757272656e745461626c652220626f726465723d2230222077696474683d2231303025222063656c6c73706163696e673d2230222063656c6c70616464696e673d22302220616c69676e3d2263656e74657222206267636f6c6f723d2223666666666666223e0a3c74626f64793e0a3c74723e0a3c74643e0a3c7461626c6520636c6173733d22646576696365776964746822207374796c653d226261636b67726f756e642d636f6c6f723a20236666666666663b2220626f726465723d2230222077696474683d22363030222063656c6c73706163696e673d2230222063656c6c70616464696e673d22302220616c69676e3d2263656e746572223e0a3c74626f64793e0a3c74723e0a3c7464206267636f6c6f723d222366666666666622206865696768743d223330223e266e6273703b20266e6273703b20266e6273703b3c2f74643e0a3c2f74723e0a3c74723e0a3c746420616c69676e3d226c65667422206267636f6c6f723d2223666666666666223e3c696d67207372633d227b626173655f75726c28297d696d616765732f6c6f676f2f7b246c6f676f7d2220616c743d226c6f676f222077696474683d2232303022202f3e3c2f74643e0a3c2f74723e0a3c74723e0a3c7464206267636f6c6f723d222366666666666622206865696768743d223330223e266e6273703b3c2f74643e0a3c2f74723e0a3c74723e0a3c746420636c6173733d226564697461626c6522207374796c653d22636f6c6f723a20236666666666663b20666f6e742d66616d696c793a204f70656e2053616e732c20417269616c2c2048656c7665746963612c2073616e732d73657269663b20666f6e742d73697a653a20313870783b20666f6e742d7765696768743a20626f6c643b20746578742d7472616e73666f726d3a207570706572636173653b2070616464696e673a2038707820323070783b206261636b67726f756e642d636f6c6f723a20233462626566663b2220616c69676e3d2263656e746572222076616c69676e3d226d6964646c65223e3c7370616e207374796c653d22636f6c6f723a20236666666666663b223e48692041646d696e3c2f7370616e3e3c2f74643e0a3c2f74723e0a3c74723e0a3c7464206865696768743d223330223e266e6273703b3c2f74643e0a3c2f74723e0a3c74723e0a3c7464207374796c653d22636f6c6f723a20233030303b2070616464696e673a2030707820323070783b20666f6e742d66616d696c793a204f70656e2053616e732c20417269616c2c2048656c7665746963612c2073616e732d73657269663b20666f6e742d73697a653a20313370783b2220616c69676e3d2263656e746572223e0a3c703e3c7370616e207374796c653d22666f6e742d73697a653a20782d6c617267653b223e3c7374726f6e673e2055736572207b24757365725f6e616d657d2068617320706f737465642061207265766965772061626f757420746865206c697374696e67207b2470726f647563745f6e616d657d203c2f7374726f6e673e3c2f7370616e3e3c2f703e0a3c703e3c7370616e207374796c653d22666f6e742d73697a653a206d656469756d3b223e3c7374726f6e673e266e6273703b3c2f7374726f6e673e3c2f7370616e3e3c2f703e0a3c2f74643e0a3c2f74723e0a3c74723e0a3c7464207374796c653d2270616464696e673a2030707820323070783b20636f6c6f723a20233434343434343b20666f6e742d66616d696c793a204f70656e2053616e732c20417269616c2c2048656c7665746963612c2073616e732d73657269663b20666f6e742d73697a653a20313370783b2220616c69676e3d226c656674222076616c69676e3d226d6964646c65223e0a3c703e266e6273703b526569766577203a207b247265766965777d3c2f703e0a3c2f74643e0a3c2f74723e0a3c74723e0a3c74643e266e6273703b3c2f74643e0a3c2f74723e0a3c74723e0a3c7464206865696768743d223330223e266e6273703b3c2f74643e0a3c2f74723e0a3c74723e0a3c7464207374796c653d2270616464696e673a2030707820323070783b20636f6c6f723a20233434343434343b20666f6e742d66616d696c793a204f70656e2053616e732c20417269616c2c2048656c7665746963612c2073616e732d73657269663b20666f6e742d73697a653a20313370783b2220616c69676e3d226c656674222076616c69676e3d226d6964646c65223e0a3c703e5468616e6b73213c2f703e0a3c703e3c7370616e207374796c653d22636f6c6f723a20233030303030303b223e3c7374726f6e673e2052656e74657273205465616d3c2f7374726f6e673e3c2f7370616e3e3c2f703e0a3c2f74643e0a3c2f74723e0a3c74723e0a3c7464206865696768743d223330223e266e6273703b3c2f74643e0a3c2f74723e0a3c74723e0a3c746420616c69676e3d2263656e74657222206267636f6c6f723d2223666666666666223e266e6273703b3c2f74643e0a3c2f74723e0a3c74723e0a3c7464206267636f6c6f723d222366666666666622206865696768743d223530223e266e6273703b3c2f74643e0a3c2f74723e0a3c2f74626f64793e0a3c2f7461626c653e0a3c2f74643e0a3c2f74723e0a3c2f74626f64793e0a3c2f7461626c653e, 'Active', '2016-09-01 05:42:27', '', 'Review Notification', 'Renters', 'smithwilliam3592@gmail.com', '', '1'),
(19, 'Reservation request to host', 0x3c7461626c6520636c6173733d2275692d736f727461626c652d68616e646c652063757272656e745461626c652220626f726465723d2230222063656c6c73706163696e673d2230222063656c6c70616464696e673d2230222077696474683d22313030252220616c69676e3d2263656e74657222206267636f6c6f723d2223346635393562223e0a3c74626f64793e0a3c74723e0a3c74643e0a3c7461626c6520636c6173733d22646576696365776964746822207374796c653d226261636b67726f756e642d636f6c6f723a20236638663866383b2220626f726465723d2230222063656c6c73706163696e673d2230222063656c6c70616464696e673d2230222077696474683d223630302220616c69676e3d2263656e746572223e0a3c74626f64793e0a3c74723e0a3c7464206865696768743d22333022206267636f6c6f723d2223346635393562223e266e6273703b3c2f74643e0a3c2f74723e0a3c74723e0a3c746420616c69676e3d226c65667422206267636f6c6f723d2223346635393562223e3c696d67207372633d227b626173655f75726c28297d696d616765732f6c6f676f2f7b246c6f676f7d2220616c743d226c6f676f222077696474683d2232303022202f3e3c2f74643e0a3c2f74723e0a3c74723e0a3c7464206865696768743d22333022206267636f6c6f723d2223346635393562223e266e6273703b3c2f74643e0a3c2f74723e0a3c74723e0a3c746420636c6173733d226564697461626c6522207374796c653d22636f6c6f723a20236666666666663b20666f6e742d66616d696c793a204f70656e2053616e732c20417269616c2c2048656c7665746963612c2073616e732d73657269663b20666f6e742d73697a653a20313870783b20666f6e742d7765696768743a20626f6c643b20746578742d7472616e73666f726d3a207570706572636173653b2070616464696e673a2038707820323070783b206261636b67726f756e642d636f6c6f723a20233462626566663b2220616c69676e3d2263656e746572222076616c69676e3d226d6964646c65223e4772656174206e6577732120596f7520686176652061207265736572766174696f6e20726571756573742066726f6d207b2474726176656c6c65726e616d657d2e3c2f74643e0a3c2f74723e0a3c74723e0a3c7464206865696768743d223430223e266e6273703b3c2f74643e0a3c2f74723e0a3c74723e0a3c7464207374796c653d22636f6c6f723a20233030303b2070616464696e673a2030707820313070783b20666f6e742d7765696768743a20626f6c643b20666f6e742d66616d696c793a204f70656e2053616e732c20417269616c2c2048656c7665746963612c2073616e732d73657269663b20666f6e742d73697a653a20313370783b2220616c69676e3d2263656e746572222076616c69676e3d22746f70223e7b2474726176656c6c65726e616d657d20776f756c64206c696b6520746f2073746179206174207b2470726f647563746e616d657d2066726f6d207b24636865636b696e646174657d207468726f756768207b24636865636b6f7574646174657d3c2f74643e0a3c2f74723e0a3c74723e0a3c7464206865696768743d223430223e266e6273703b3c2f74643e0a3c2f74723e0a3c74723e0a3c7464207374796c653d22636f6c6f723a20233030303b2070616464696e673a2030707820313070783b20666f6e742d66616d696c793a204f70656e2053616e732c20417269616c2c2048656c7665746963612c2073616e732d73657269663b20666f6e742d73697a653a20313370783b2220616c69676e3d2263656e746572223e4261736564206f6e20796f75722072617465206f66203c7370616e3e555344266e6273703b3c2f7370616e3e7b2470726963657d20706572206e6967687420616c6f6e672077697468206173736f63696174656420666565732c20796f757220706f74656e7469616c207061796f757420666f722074686973207265736572766174696f6e206973203c7370616e3e555344266e6273703b3c2f7370616e3e7b24746f74616c70726963657d2e3c2f74643e0a3c2f74723e0a3c74723e0a3c74643e266e6273703b3c2f74643e0a3c2f74723e0a3c74723e0a3c746420616c69676e3d2263656e746572222076616c69676e3d226d6964646c65223e0a3c646976207374796c653d226261636b67726f756e642d636f6c6f723a20236633343032653b20646973706c61793a207461626c653b20626f726465722d7261646975733a203570783b20636f6c6f723a20236666666666663b20666f6e742d66616d696c793a204f70656e2053616e732c20417269616c2c2073616e732d73657269663b20666f6e742d73697a653a20313370783b20746578742d7472616e73666f726d3a207570706572636173653b20666f6e742d7765696768743a20626f6c643b2070616464696e673a2037707820313270783b20746578742d616c69676e3a2063656e7465723b20746578742d6465636f726174696f6e3a206e6f6e653b2077696474683a2032303070783b206d617267696e3a206175746f3b223e3c61207374796c653d22636f6c6f723a20236666666666663b20746578742d6465636f726174696f6e3a206e6f6e653b2220687265663d227b626173655f75726c28297d6c697374696e672d7265736572766174696f6e2f223e4163636570743c2f613e202f20203c61207374796c653d22636f6c6f723a20236666666666663b20746578742d6465636f726174696f6e3a206e6f6e653b2220687265663d227b626173655f75726c28297d6c697374696e672d7265736572766174696f6e2f223e4465636c696e653c2f613e3c2f6469763e0a3c2f74643e0a3c2f74723e0a3c74723e0a3c746420616c69676e3d2263656e746572223e0a3c7461626c6520626f726465723d2230222063656c6c73706163696e673d2230222063656c6c70616464696e673d2230222077696474683d22313030252220616c69676e3d2263656e746572223e0a3c74626f64793e0a3c7472207374796c653d2270616464696e673a20313070783b20666c6f61743a206c6566743b223e0a3c746420616c69676e3d2263656e746572222076616c69676e3d22746f70223e0a3c70207374796c653d226d617267696e3a203070783b2070616464696e673a2038707820313070783b20666f6e742d66616d696c793a204f70656e2053616e732c20417269616c2c2048656c7665746963612c2073616e732d73657269663b20666f6e742d73697a653a20313370783b206261636b67726f756e643a20236631663166313b223e5265736572766174696f6e20526571756573743c2f703e0a3c7461626c6520626f726465723d2230222063656c6c73706163696e673d2231222063656c6c70616464696e673d2235222077696474683d2236303022206267636f6c6f723d2223454145414541223e0a3c74626f6479207374796c653d22666f6e742d66616d696c793a204f70656e2053616e732c20417269616c2c2048656c7665746963612c2073616e732d73657269663b20666f6e742d73697a653a20313370783b223e0a3c74723e0a3c74682077696474683d223735223e54696d653c2f74683e203c74682077696474683d223735223e446174653c2f74683e0a3c2f74723e0a3c747220616c69676e3d2263656e746572223e0a3c7464206267636f6c6f723d2223464646464646223e4172726976653c2f74643e0a3c7464206267636f6c6f723d2223464646464646223e7b24636865636b696e646174657d3c2f74643e0a3c2f74723e0a3c747220616c69676e3d2263656e746572223e0a3c7464206267636f6c6f723d2223464646464646223e4465706172743c2f74643e0a3c7464206267636f6c6f723d2223464646464646223e7b24636865636b6f7574646174657d3c2f74643e0a3c2f74723e0a3c2f74626f64793e0a3c2f7461626c653e0a3c2f74643e0a3c2f74723e0a3c2f74626f64793e0a3c2f7461626c653e0a3c2f74643e0a3c2f74723e0a3c7472207374796c653d226d617267696e2d746f703a20313970783b20646973706c61793a20626c6f636b3b2070616464696e673a2030707820323070783b223e0a3c7464207374796c653d22636f6c6f723a20233434343434343b20666f6e742d66616d696c793a204f70656e2053616e732c20417269616c2c2048656c7665746963612c2073616e732d73657269663b20666f6e742d73697a653a20313270783b2220616c69676e3d226c656674222076616c69676e3d226d6964646c65223e7b2474726176656c6c65726e616d657d2773207265736572766174696f6e20726571756573742077696c6c2065787069726520616674657220323420686f75727320696620796f7520646f6e2774206f6666696369616c6c7920616363657074206f72206465636c696e652069742e3c2f74643e0a3c2f74723e0a3c7472207374796c653d226d617267696e2d746f703a20313970783b20646973706c61793a20626c6f636b3b2070616464696e673a2030707820323070783b223e0a3c7464207374796c653d22636f6c6f723a20233434343434343b20666f6e742d66616d696c793a204f70656e2053616e732c20417269616c2c2048656c7665746963612c2073616e732d73657269663b20666f6e742d73697a653a20313270783b2220616c69676e3d226c656674222076616c69676e3d226d6964646c65223e576520656e636f757261676520796f7520746f20726573706f6e6420617320717569636b6c7920617320706f737369626c6520736f20796f75722067756573742063616e20626567696e20746f20706c616e20746865697220616476656e74757265213c2f74643e0a3c2f74723e0a3c74723e0a3c74643e266e6273703b3c2f74643e0a3c2f74723e0a3c74723e0a3c7464207374796c653d22636f6c6f723a20233434343434343b20666f6e742d66616d696c793a204f70656e2053616e732c20417269616c2c2048656c7665746963612c2073616e732d73657269663b20666f6e742d73697a653a20313370783b2220616c69676e3d2263656e746572222076616c69676e3d226d6964646c65223e3c61207374796c653d22636f6c6f723a20233030393461613b20746578742d6465636f726174696f6e3a206e6f6e653b2220687265663d2223223e2852656d656d6265723a204e6f7420726573706f6e64696e6720746f207468697320626f6f6b696e672077696c6c20726573756c7420696e20796f7572206c697374696e67206265696e672072616e6b6564206c6f7765722e293c2f613e3c2f74643e0a3c2f74723e0a3c74723e0a3c74643e266e6273703b3c2f74643e0a3c2f74723e0a3c74723e0a3c7468207374796c653d22636f6c6f723a20233434343434343b20666f6e742d66616d696c793a204f70656e2053616e732c20417269616c2c2048656c7665746963612c2073616e732d73657269663b20666f6e742d73697a653a20313270783b2070616464696e673a203020323070783b2220616c69676e3d2263656e746572222076616c69676e3d226d6964646c65223e266e6273703b3c2f74683e0a3c2f74723e0a3c74723e0a3c7464206865696768743d223530223e266e6273703b3c2f74643e0a3c2f74723e0a3c74723e0a3c7464207374796c653d2270616464696e673a2030707820323070783b20636f6c6f723a20233434343434343b20666f6e742d66616d696c793a204f70656e2053616e732c20417269616c2c2048656c7665746963612c2073616e732d73657269663b20666f6e742d73697a653a20313370783b2220616c69676e3d226c656674222076616c69676e3d226d6964646c65223e0a3c703e5468616e6b73213c2f703e0a3c703e5468652052656e74657273205465616d3c2f703e0a3c2f74643e0a3c2f74723e0a3c74723e0a3c7464206865696768743d223330223e266e6273703b3c2f74643e0a3c2f74723e0a3c74723e0a3c7464206865696768743d22333022206267636f6c6f723d2223346635393562223e266e6273703b3c2f74643e0a3c2f74723e0a3c74723e0a3c746420616c69676e3d2263656e74657222206267636f6c6f723d2223346635393562223e266e6273703b3c2f74643e0a3c2f74723e0a3c74723e0a3c7464206865696768743d22353022206267636f6c6f723d2223346635393562223e266e6273703b3c2f74643e0a3c2f74723e0a3c2f74626f64793e0a3c2f7461626c653e0a3c2f74643e0a3c2f74723e0a3c2f74626f64793e0a3c2f7461626c653e, 'Active', '2016-05-31 02:53:23', '', 'Reservation request to host', 'Renters', 'rentersteam@teamtweaks.com', '', '1'),
(5, 'Forgot Password', 0x3c7461626c6520626f726465723d2230222063656c6c73706163696e673d2230222063656c6c70616464696e673d2230222077696474683d2236343022206267636f6c6f723d2223376461326331223e0a3c74626f64793e0a3c74723e0a3c7464207374796c653d2270616464696e673a20343070783b223e0a3c7461626c65207374796c653d22626f726465723a20233164343536372031707820736f6c69643b20666f6e742d66616d696c793a20417269616c2c2048656c7665746963612c2073616e732d73657269663b2220626f726465723d2230222063656c6c73706163696e673d2230222063656c6c70616464696e673d2230222077696474683d22363130223e0a3c74626f64793e0a3c74723e0a3c74643e3c6120687265663d227b626173655f75726c28297d223e3c696d67207374796c653d226d617267696e3a20313570782035707820303b2070616464696e673a203070783b20626f726465723a206e6f6e653b22207372633d227b626173655f75726c28297d696d616765732f6c6f676f2f7b246c6f676f7d2220616c743d227b246d6574615f7469746c657d22202f3e3c2f613e3c2f74643e0a3c2f74723e0a3c74723e0a3c74642076616c69676e3d22746f70223e0a3c7461626c6520626f726465723d2230222063656c6c73706163696e673d2230222063656c6c70616464696e673d223022206267636f6c6f723d2223464646464646223e0a3c74626f64793e0a3c74723e0a3c746420636f6c7370616e3d2232223e0a3c6833207374796c653d2270616464696e673a203130707820313570783b206d617267696e3a203070783b20636f6c6f723a20233064343837613b223e48657265277320596f7572204e65772050617373776f72643c2f68333e0a3c70207374796c653d2270616464696e673a203070782031357078203130707820313570783b20666f6e742d73697a653a20313270783b206d617267696e3a203070783b223e4861766520796f7520666f7267657474656e20796f75722070617373776f72643f20446f6e277420776f7272792e20576520616c726561647920726573657420796f75722070617373776f72642e3c2f703e0a3c2f74643e0a3c2f74723e0a3c74723e0a3c7464207374796c653d22666f6e742d73697a653a20313270783b2070616464696e673a203130707820313570783b222077696474683d22353025222076616c69676e3d22746f70223e0a3c703e3c7374726f6e673e4e65772050617373776f7264203a3c2f7374726f6e673e207b247077647d3c2f703e0a3c703e596f752063616e206c6f67696e207573696e672061626f76652070617373776f726420616e64206368616e676520796f75722070617373776f726420696d6d6564696174656c792e3c2f703e0a3c703e266e6273703b3c2f703e0a3c703e5468616e6b732c3c2f703e0a3c64697620636c6173733d227020223e3c7370616e3e53656e7420776974683c2f7370616e3e3c7370616e3e266e6273703b66726f6d207b24656d61696c5f7469746c657d2048513c2f7370616e3e3c2f6469763e0a3c703e266e6273703b3c2f703e0a3c2f74643e0a3c7464207374796c653d22666f6e742d73697a653a20313270783b2070616464696e673a203130707820313570783b222077696474683d22353025222076616c69676e3d22746f70223e0a3c703e266e6273703b3c2f703e0a3c703e266e6273703b3c2f703e0a3c2f74643e0a3c2f74723e0a3c2f74626f64793e0a3c2f7461626c653e0a3c2f74643e0a3c2f74723e0a3c2f74626f64793e0a3c2f7461626c653e0a3c2f74643e0a3c2f74723e0a3c2f74626f64793e0a3c2f7461626c653e, 'Active', '2016-06-07 03:47:54', '', 'Forgot Password', 'Renters', 'rentersteam@teamtweaks.com', '', '2'),
(6, 'send mail subcribers list', 0x3c646976207374796c653d2277696474683a2036303070783b206261636b67726f756e643a20234646464646463b206d617267696e3a2030206175746f3b20626f726465722d7261646975733a20313070783b20626f782d736861646f773a203020302035707820236363633b20626f726465723a2031707820736f6c696420234441374341463b223e0a3c646976207374796c653d226261636b67726f756e643a20236637663766373b2070616464696e673a20313070783b20626f726465722d7261646975733a20313070782031307078203020303b20746578742d616c69676e3a2063656e7465723b223e3c6120687265663d227b626173655f75726c28297d22207461726765743d225f626c616e6b223e3c696d67207374796c653d226d617267696e3a20357078203230707820307078203070783b22207372633d227b626173655f75726c28297d696d616765732f6c6f676f2f7b246c6f676f5f696d6167657d2220626f726465723d22302220616c743d227b247469746c657d222077696474683d2232303522202f3e3c2f613e266e6273703b3c2f6469763e0a3c646976207374796c653d226261636b67726f756e643a20236666663b2070616464696e673a20313070783b2077696474683a2035383070783b223e0a3c646976207374796c653d22666f6e742d66616d696c793a204d79726961642050726f3b20666f6e742d73697a653a20323470783b20636f6c6f723a20236461376361663b2070616464696e672d626f74746f6d3a20313570783b20666f6e742d7765696768743a20626f6c643b223e7b246e6577735f7375626a6563747d3c2f6469763e0a3c646976207374796c653d22666f6e742d66616d696c793a204d79726961642050726f3b20666f6e742d73697a653a20313670783b20636f6c6f723a20233030303b2070616464696e672d626f74746f6d3a20313570783b206c696e652d6865696768743a20323470783b20746578742d616c69676e3a206a7573746966793b223e7b246e6577735f646573637269707d3c2f6469763e0a3c646976207374796c653d22666f6e742d66616d696c793a204d79726961642050726f3b20666f6e742d73697a653a20313670783b20636f6c6f723a20233030303b2070616464696e672d626f74746f6d3a20313570783b206c696e652d6865696768743a20323470783b20746578742d616c69676e3a206a7573746966793b223e496620796f75206861766520616e79207175657374696f6e7320706c6561736520656d61696c203c61207374796c653d22636f6c6f723a20233565613030383b20746578742d6465636f726174696f6e3a206e6f6e653b2220687265663d222f63646e2d6367692f6c2f656d61696c2d70726f74656374696f6e236332623965366236616161626231656665346135623666396131616461636134616261356566653461356236663961626236613761666561653561376166613361626165653565626266223e7b24656d61696c7d3c2f613e3c2f6469763e0a3c646976207374796c653d22666f6e742d66616d696c793a204d79726961642050726f3b20666f6e742d73697a653a20313870783b20636f6c6f723a20233030303b2070616464696e672d626f74746f6d3a20313570783b206c696e652d6865696768743a20323870783b223e53696e636572656c79202c203c6272202f3e204d616e6167656d656e743c2f6469763e0a3c2f6469763e0a3c2f6469763e, 'Active', '2016-05-31 01:32:54', '', 'send mail subcribers lists', 'Renters', 'rentersteam@teamtweaks.com', '', '2');
INSERT INTO `fc_newsletter` (`id`, `news_title`, `news_descrip`, `status`, `dateAdded`, `news_image`, `news_subject`, `sender_name`, `sender_email`, `news_seourl`, `typeVal`) VALUES
(29, 'Notification Mail', 0x3c7461626c6520636c6173733d2275692d736f727461626c652d68616e646c652063757272656e745461626c652220626f726465723d2230222077696474683d2231303025222063656c6c73706163696e673d2230222063656c6c70616464696e673d22302220616c69676e3d2263656e74657222206267636f6c6f723d2223346635393562223e0a3c74626f64793e0a3c74723e0a3c74643e0a3c7461626c6520636c6173733d22646576696365776964746822207374796c653d226261636b67726f756e642d636f6c6f723a20236638663866383b2220626f726465723d2230222077696474683d22363030222063656c6c73706163696e673d2230222063656c6c70616464696e673d22302220616c69676e3d2263656e746572223e0a3c74626f64793e0a3c74723e0a3c7464206267636f6c6f723d222334663539356222206865696768743d223330223e266e6273703b20266e6273703b20266e6273703b20266e6273703b20266e6273703b20266e6273703b3c2f74643e0a3c2f74723e0a3c74723e0a3c746420616c69676e3d226c65667422206267636f6c6f723d2223346635393562223e3c696d67207374796c653d226d617267696e3a20313570782035707820303b2070616464696e673a203070783b20626f726465723a206e6f6e653b22207372633d227b626173655f75726c28297d696d616765732f6c6f676f2f7b246c6f676f7d2220616c743d226c6f676f222077696474683d2232303022202f3e3c2f74643e0a3c2f74723e0a3c74723e0a3c7464206267636f6c6f723d222334663539356222206865696768743d223330223e266e6273703b3c2f74643e0a3c2f74723e0a3c74723e0a3c746420636c6173733d226564697461626c6522207374796c653d22636f6c6f723a20236666666666663b20666f6e742d66616d696c793a204f70656e2053616e732c20417269616c2c2048656c7665746963612c2073616e732d73657269663b20666f6e742d73697a653a20313870783b20666f6e742d7765696768743a20626f6c643b20746578742d7472616e73666f726d3a207570706572636173653b2070616464696e673a2038707820323070783b206261636b67726f756e642d636f6c6f723a20233462626566663b2220616c69676e3d2263656e746572222076616c69676e3d226d6964646c65223e4869207b2466697273745f6e616d657d207b246c6173745f6e616d657d3c2f74643e0a3c2f74723e0a3c74723e0a3c7464206865696768743d223530223e266e6273703b3c2f74643e0a3c2f74723e0a3c74723e0a3c7464207374796c653d22636f6c6f723a20233030303b2070616464696e673a2030707820323070783b20666f6e742d66616d696c793a204f70656e2053616e732c20417269616c2c2048656c7665746963612c2073616e732d73657269663b20666f6e742d73697a653a20313370783b2220616c69676e3d2263656e746572223e5765277265206578636974656420746f2074656c6c20796f75207468617420796f75206861766520626f6f6b6564207b2472656e74616c5f6e616d657d2c20666f722074686520626f6f6b696e672023207b24626f6f6b696e674e6f7d2e20546f2068656c70206d616b6520636865636b2d696e207365616d6c6573732c207765207375676765737420796f7520636f6e74696e75652074686520636f6e766572736174696f6e2077697468207b2472656e7465725f666e616d657d207b2472656e7465725f6c6e616d657d3c2f74643e0a3c2f74723e0a3c74723e0a3c7464207374796c653d22636f6c6f723a20233030303b2070616464696e673a20313070782032307078203130707820323070783b20666f6e742d66616d696c793a204f70656e2053616e732c20417269616c2c2048656c7665746963612c2073616e732d73657269663b20666f6e742d73697a653a20313370783b2220616c69676e3d2263656e746572223e7468726f7567682052656e746572732773206d6573736167652073797374656d20746f20636f6e6669726d207468656972206172726976616c2074696d652c2061736b20616e79207175657374696f6e7320796f75206d617920686176652c20616e642068656c70207468656d20666967757265206f757420686f7720746f20626573742067657420746f20796f7572206c697374696e672e3c2f74643e0a3c2f74723e0a3c74723e0a3c74643e266e6273703b3c2f74643e0a3c2f74723e0a3c74723e0a3c7464207374796c653d22636f6c6f723a20233030303b2070616464696e673a2030707820313070783b20666f6e742d7765696768743a20626f6c643b20666f6e742d66616d696c793a204f70656e2053616e732c20417269616c2c2048656c7665746963612c2073616e732d73657269663b20666f6e742d73697a653a20313370783b2220616c69676e3d2263656e746572222076616c69676e3d22746f70223e4974696e65726172793c2f74643e0a3c2f74723e0a3c74723e0a3c746420616c69676e3d2263656e746572222076616c69676e3d226d6964646c65223e0a3c646976207374796c653d226261636b67726f756e642d636f6c6f723a20236633343032653b20646973706c61793a207461626c653b20626f726465722d7261646975733a203570783b20636f6c6f723a20236666666666663b20666f6e742d66616d696c793a204f70656e2053616e732c20417269616c2c2073616e732d73657269663b20666f6e742d73697a653a20313370783b20746578742d7472616e73666f726d3a207570706572636173653b20666f6e742d7765696768743a20626f6c643b2070616464696e673a2037707820313270783b20746578742d616c69676e3a2063656e7465723b20746578742d6465636f726174696f6e3a206e6f6e653b2077696474683a2031343070783b206d617267696e3a206175746f3b223e3c61207374796c653d22636f6c6f723a20236666666666663b20746578742d6465636f726174696f6e3a206e6f6e653b2220687265663d227b626173655f75726c28297d72656e74616c2f7b247072645f69647d223e3c696d67207372633d227b2472656e74616c5f696d6167657d2220616c743d22222077696474683d2233303022202f3e207b2472656e74616c5f6e616d657d3c2f613e3c2f6469763e0a3c2f74643e0a3c2f74723e0a3c74723e0a3c746420616c69676e3d2263656e746572223e0a3c7461626c6520626f726465723d2230222077696474683d2231303025222063656c6c73706163696e673d2230222063656c6c70616464696e673d22302220616c69676e3d2263656e746572223e0a3c74626f64793e0a3c7472207374796c653d2270616464696e673a20313070783b20666c6f61743a206c6566743b223e0a3c746420616c69676e3d2263656e746572222076616c69676e3d22746f70223e0a3c7461626c6520626f726465723d2230222077696474683d22363030222063656c6c73706163696e673d2231222063656c6c70616464696e673d223522206267636f6c6f723d2223454145414541223e0a3c74626f6479207374796c653d22666f6e742d66616d696c793a204f70656e2053616e732c20417269616c2c2048656c7665746963612c2073616e732d73657269663b20666f6e742d73697a653a20313370783b223e0a3c74723e0a3c74682077696474683d223735223e54696d653c2f74683e0a3c74682077696474683d223735223e446174653c2f74683e0a3c2f74723e0a3c747220616c69676e3d2263656e746572223e0a3c7464206267636f6c6f723d2223464646464646223e4172726976653c2f74643e0a3c7464206267636f6c6f723d2223464646464646223e7b2463686b496e7d3c2f74643e0a3c2f74723e0a3c747220616c69676e3d2263656e746572223e0a3c7464206267636f6c6f723d2223464646464646223e4465706172743c2f74643e0a3c7464206267636f6c6f723d2223464646464646223e7b2463686b4f75747d3c2f74643e0a3c2f74723e0a3c2f74626f64793e0a3c2f7461626c653e0a3c2f74643e0a3c2f74723e0a3c2f74626f64793e0a3c2f7461626c653e0a3c2f74643e0a3c2f74723e0a3c74723e0a3c74643e266e6273703b3c2f74643e0a3c2f74723e0a3c74723e0a3c746420616c69676e3d2263656e746572223e0a3c7461626c6520626f726465723d2230222077696474683d2231303025222063656c6c73706163696e673d2230222063656c6c70616464696e673d22302220616c69676e3d2263656e746572223e0a3c74626f64793e0a3c7472207374796c653d2270616464696e673a20313070783b20666c6f61743a206c6566743b223e0a3c746420616c69676e3d2263656e746572222076616c69676e3d22746f70223e0a3c7461626c6520626f726465723d2230222077696474683d22363030222063656c6c73706163696e673d2231222063656c6c70616464696e673d2235223e0a3c74626f6479207374796c653d22666f6e742d66616d696c793a204f70656e2053616e732c20417269616c2c2048656c7665746963612c2073616e732d73657269663b20666f6e742d73697a653a20313370783b223e0a3c74723e0a3c746820616c69676e3d226c656674223e596f757220477265656e20686f7573653c2f74683e0a3c2f74723e0a3c7472206267636f6c6f723d2223454145414541223e0a3c74642077696474683d223135307078223e3c696d67207372633d227b24696d6167657d2220616c743d22222077696474683d22353022206865696768743d22353022202f3e3c2f74643e0a3c74643e0a3c7461626c6520626f726465723d2230222077696474683d2231303025222063656c6c73706163696e673d2230222063656c6c70616464696e673d22302220616c69676e3d2263656e746572223e0a3c74626f64793e0a3c74723e0a3c7464207374796c653d22666f6e742d66616d696c793a204f70656e2053616e732c20417269616c2c2048656c7665746963612c2073616e732d73657269663b20666f6e742d73697a653a20313370783b2070616464696e673a20357078203070783b223e7b2472656e7465725f666e616d657d207b2472656e7465725f6c6e616d657d3c2f74643e0a3c2f74723e0a3c74723e0a3c7464207374796c653d22666f6e742d66616d696c793a204f70656e2053616e732c20417269616c2c2048656c7665746963612c2073616e732d73657269663b20666f6e742d73697a653a20313370783b2070616464696e673a20357078203070783b223e7b2470685f6e6f7d3c2f74643e0a3c2f74723e0a3c2f74626f64793e0a3c2f7461626c653e0a3c2f74643e0a3c2f74723e0a3c2f74626f64793e0a3c2f7461626c653e0a3c2f74643e0a3c2f74723e0a3c2f74626f64793e0a3c2f7461626c653e0a3c2f74643e0a3c2f74723e0a3c74723e0a3c7464207374796c653d2270616464696e673a2030707820323070783b20666f6e742d66616d696c793a204f70656e2053616e732c20417269616c2c2048656c7665746963612c2073616e732d73657269663b20666f6e742d73697a653a20313370783b20666f6e742d7765696768743a20626f6c643b2220616c69676e3d226c656674223e5061796d656e743c2f74643e0a3c2f74723e0a3c74723e0a3c7464207374796c653d2270616464696e673a2030707820323070783b20666f6e742d66616d696c793a204f70656e2053616e732c20417269616c2c2048656c7665746963612c2073616e732d73657269663b20666f6e742d73697a653a20313370783b223e4f6e20746865206461792061667465722074686520677565737420636865636b7320696e2c20746865207061796f7574206d6574686f6420796f7520737570706c6965642077696c6c2062652063726564697465642e20466f722064657461696c732c2073656520796f7572205472616e73616374696f6e20486973746f72792e3c2f74643e0a3c2f74723e0a3c74723e0a3c7464206865696768743d223330223e266e6273703b3c2f74643e0a3c2f74723e0a3c74723e0a3c7464207374796c653d2270616464696e673a2030707820323070783b20666f6e742d66616d696c793a204f70656e2053616e732c20417269616c2c2048656c7665746963612c2073616e732d73657269663b20666f6e742d73697a653a20313370783b20666f6e742d7765696768743a20626f6c643b2220616c69676e3d226c656674223e43616e63656c6c6174696f6e20506f6c6963793c2f74643e0a3c2f74723e0a3c74723e0a3c7464207374796c653d2270616464696e673a2030707820323070783b20666f6e742d66616d696c793a204f70656e2053616e732c20417269616c2c2048656c7665746963612c2073616e732d73657269663b20666f6e742d73697a653a20313370783b223e466c657869626c653a2046756c6c20726566756e64203120646179207072696f7220746f206172726976616c2c2065786365707420666565733c2f74643e0a3c2f74723e0a3c74723e0a3c7464206865696768743d223330223e266e6273703b3c2f74643e0a3c2f74723e0a3c74723e0a3c7464207374796c653d22636f6c6f723a20233466353935623b20666f6e742d66616d696c793a204f70656e2053616e732c20417269616c2c2048656c7665746963612c2073616e732d73657269663b20666f6e742d73697a653a20313370783b206c696e652d6865696768743a20323070783b2070616464696e673a2030707820323070783b2220616c69676e3d226c656674222076616c69676e3d22746f70222077696474683d223330307078223e0a3c7461626c65207374796c653d2277696474683a20313030253b20666f6e742d73697a653a20313370783b223e0a3c74626f64793e0a3c74723e0a3c7464207374796c653d22626f726465722d626f74746f6d3a2031707820736f6c696420236262623b223e666f72207b246e6f6f666e69676874737d204e696768743c2f74643e0a3c7464207374796c653d22626f726465722d626f74746f6d3a2031707820736f6c696420236262623b223e266e6273703b3c2f74643e0a3c7464207374796c653d22626f726465722d626f74746f6d3a2031707820736f6c696420236262623b2070616464696e673a20357078203070783b223e7b2473796d626f6c7d266e6273703b7b24616d6f756e747d3c2f74643e0a3c2f74723e0a3c74723e0a3c7464207374796c653d22626f726465722d626f74746f6d3a2031707820736f6c696420236262623b2070616464696e673a2031307078203070783b223e53657276696365204665653c2f74643e0a3c7464207374796c653d22626f726465722d626f74746f6d3a2031707820736f6c696420236262623b2070616464696e673a2031307078203070783b223e266e6273703b3c2f74643e0a3c7464207374796c653d22626f726465722d626f74746f6d3a2031707820736f6c696420236262623b2070616464696e673a2031307078203070783b223e7b2473796d626f6c7d207b24736572766963654665657d3c2f74643e0a3c2f74723e0a3c74723e0a3c7464207374796c653d22626f726465722d626f74746f6d3a2031707820736f6c696420236262623b2070616464696e673a2031307078203070783b223e446973636f756e7420416d6f756e74282d293c2f74643e0a3c7464207374796c653d22626f726465722d626f74746f6d3a2031707820736f6c696420236262623b2070616464696e673a2031307078203070783b223e266e6273703b3c2f74643e0a3c7464207374796c653d22626f726465722d626f74746f6d3a2031707820736f6c696420236262623b2070616464696e673a2031307078203070783b223e7b2473796d626f6c7d207b24646973636f756e745f616d6f756e747d3c2f74643e0a3c2f74723e0a3c74723e0a3c7464207374796c653d22626f726465722d626f74746f6d3a2031707820736f6c696420236262623b2070616464696e673a2031307078203070783b223e546f74616c3c2f74643e0a3c7464207374796c653d22626f726465722d626f74746f6d3a2031707820736f6c696420236262623b2070616464696e673a2031307078203070783b223e266e6273703b3c2f74643e0a3c7464207374796c653d22626f726465722d626f74746f6d3a2031707820736f6c696420236262623b2070616464696e673a2031307078203070783b223e7b2473796d626f6c7d207b246e6574616d6f756e747d3c2f74643e0a3c2f74723e0a3c2f74626f64793e0a3c2f7461626c653e0a3c2f74643e0a3c2f74723e0a3c74723e0a3c7464206865696768743d223330223e266e6273703b3c2f74643e0a3c2f74723e0a3c74723e0a3c7464207374796c653d2270616464696e673a2030707820323070783b20636f6c6f723a20233434343434343b20666f6e742d66616d696c793a204f70656e2053616e732c20417269616c2c2048656c7665746963612c2073616e732d73657269663b20666f6e742d73697a653a20313370783b2220616c69676e3d226c656674222076616c69676e3d226d6964646c65223e0a3c703e5468616e6b73213c2f703e0a3c703e5468652052656e74657273205465616d3c2f703e0a3c2f74643e0a3c2f74723e0a3c74723e0a3c7464206865696768743d223330223e266e6273703b3c2f74643e0a3c2f74723e0a3c74723e0a3c7464206267636f6c6f723d222334663539356222206865696768743d223330223e266e6273703b3c2f74643e0a3c2f74723e0a3c74723e0a3c746420616c69676e3d2263656e74657222206267636f6c6f723d2223346635393562223e266e6273703b3c2f74643e0a3c2f74723e0a3c74723e0a3c7464206267636f6c6f723d222334663539356222206865696768743d223530223e266e6273703b3c2f74643e0a3c2f74723e0a3c2f74626f64793e0a3c2f7461626c653e0a3c2f74643e0a3c2f74723e0a3c2f74626f64793e0a3c2f7461626c653e, 'Active', '2016-10-26 04:29:45', '', 'Notification Mail', 'Renters', 'rentersteam@teamtweaks.com', '', '1'),
(32, 'Listing Email Host ', 0x3c7461626c6520636c6173733d2275692d736f727461626c652d68616e646c652063757272656e745461626c652220626f726465723d2230222063656c6c73706163696e673d2230222063656c6c70616464696e673d2230222077696474683d22313030252220616c69676e3d2263656e74657222206267636f6c6f723d2223346635393562223e0a3c74626f64793e0a3c74723e0a3c74643e0a3c7461626c6520636c6173733d22646576696365776964746822207374796c653d226261636b67726f756e642d636f6c6f723a20236638663866383b2220626f726465723d2230222063656c6c73706163696e673d2230222063656c6c70616464696e673d2230222077696474683d223630302220616c69676e3d2263656e746572223e0a3c74626f64793e0a3c74723e0a3c7464206865696768743d22333022206267636f6c6f723d2223346635393562223e266e6273703b20266e6273703b20266e6273703b20266e6273703b20266e6273703b20266e6273703b20266e6273703b20266e6273703b20266e6273703b3c2f74643e0a3c2f74723e0a3c74723e0a3c746420616c69676e3d226c65667422206267636f6c6f723d2223346635393562223e3c696d67207372633d227b626173655f75726c28297d696d616765732f6c6f676f2f7b246c6f676f7d2220616c743d226c6f676f222077696474683d2232303022202f3e266e6273703b266e6273703b3c2f74643e0a3c2f74723e0a3c74723e0a3c7464206865696768743d22333022206267636f6c6f723d2223346635393562223e266e6273703b3c2f74643e0a3c2f74723e0a3c74723e0a3c746420636c6173733d226564697461626c6522207374796c653d22636f6c6f723a20236666666666663b20666f6e742d66616d696c793a204f70656e2053616e732c20417269616c2c2048656c7665746963612c2073616e732d73657269663b20666f6e742d73697a653a20313870783b20666f6e742d7765696768743a20626f6c643b20746578742d7472616e73666f726d3a207570706572636173653b2070616464696e673a2038707820323070783b206261636b67726f756e642d636f6c6f723a20233462626566663b2220616c69676e3d2263656e746572222076616c69676e3d226d6964646c65223e4869207b24686f73746e616d657d3c2f74643e0a3c2f74723e0a3c74723e0a3c7464206865696768743d223330223e266e6273703b3c2f74643e0a3c2f74723e0a3c74723e0a3c7464207374796c653d22636f6c6f723a20233030303b2070616464696e673a2030707820323070783b20666f6e742d66616d696c793a204f70656e2053616e732c20417269616c2c2048656c7665746963612c2073616e732d73657269663b20666f6e742d73697a653a20313370783b2220616c69676e3d2263656e746572223e266e6273703b596f75206861766520637265617465642061206e6577206c697374696e67207769746820796f75722052656e74657273206163636f756e74206f6e207b2470726f7065727479646174657d206174207b2470726f706572747974696d657d2e3c2f74643e0a3c2f74723e0a3c74723e0a3c74643e266e6273703b3c2f74643e0a3c2f74723e0a3c74723e0a3c7464207374796c653d22636f6c6f723a20233030303b2070616464696e673a2030707820323070783b20666f6e742d66616d696c793a204f70656e2053616e732c20417269616c2c2048656c7665746963612c2073616e732d73657269663b20666f6e742d73697a653a20313370783b2220616c69676e3d226c656674223e266e6273703b4c697374206e616d65203a207b2470726f70657274796e616d657d3c2f74643e0a3c2f74723e0a3c74723e0a3c7464207374796c653d22636f6c6f723a20233030303b2070616464696e673a2030707820323070783b20666f6e742d66616d696c793a204f70656e2053616e732c20417269616c2c2048656c7665746963612c2073616e732d73657269663b20666f6e742d73697a653a20313370783b2220616c69676e3d226c656674223e4c696e6b203a203c6120687265663d227b626173655f75726c28297d72656e74616c2f7b2470726f706572747969647d223e207b626173655f75726c28297d72656e74616c2f7b2470726f706572747969647d3c2f613e3c2f74643e0a3c2f74723e0a3c74723e0a3c7464207374796c653d22636f6c6f723a20233030303b2070616464696e673a2030707820323070783b20666f6e742d66616d696c793a204f70656e2053616e732c20417269616c2c2048656c7665746963612c2073616e732d73657269663b20666f6e742d73697a653a20313370783b2220616c69676e3d226c656674223e5072696365203a7b2473796d626f6c7d207b2470726f706572747970726963657d3c2f74643e0a3c2f74723e0a3c74723e0a3c74643e266e6273703b3c2f74643e0a3c2f74723e0a3c74723e0a3c74643e266e6273703b3c2f74643e0a3c2f74723e0a3c74723e0a3c7464207374796c653d22636f6c6f723a20233030303b2070616464696e673a2030707820323070783b20666f6e742d66616d696c793a204f70656e2053616e732c20417269616c2c2048656c7665746963612c2073616e732d73657269663b20666f6e742d73697a653a20313370783b2220616c69676e3d226c656674223e496620746869732077617320796f752c20796f752063616e2069676e6f7265207468697320656d61696c2e3c2f74643e0a3c2f74723e0a3c74723e0a3c74643e266e6273703b3c2f74643e0a3c2f74723e0a3c74723e0a3c7464207374796c653d22636f6c6f723a20233030303b2070616464696e673a2030707820323070783b20666f6e742d66616d696c793a204f70656e2053616e732c20417269616c2c2048656c7665746963612c2073616e732d73657269663b20666f6e742d73697a653a20313370783b2220616c69676e3d226c656674223e49662074686973207761736e277420796f752c206c6574207573206b6e6f772e204e6f74696679696e6720757320697320696d706f7274616e7420626563617573652069742068656c7073207573206d616b652073757265206e6f206f6e6520266e6273703b20697320616363657373696e6720796f7572206163636f756e7420776974686f757420796f7572206b6e6f776c656467652e3c2f74643e0a3c2f74723e0a3c74723e0a3c7464206865696768743d223330223e266e6273703b3c2f74643e0a3c2f74723e0a3c74723e0a3c7464207374796c653d2270616464696e673a2030707820323070783b20636f6c6f723a20233434343434343b20666f6e742d66616d696c793a204f70656e2053616e732c20417269616c2c2048656c7665746963612c2073616e732d73657269663b20666f6e742d73697a653a20313370783b2220616c69676e3d226c656674222076616c69676e3d226d6964646c65223e0a3c703e266e6273703b5468616e6b73213c2f703e0a3c703e266e6273703b5468652052656e74657273205465616d3c2f703e0a3c2f74643e0a3c2f74723e0a3c74723e0a3c7464206865696768743d223330223e266e6273703b3c2f74643e0a3c2f74723e0a3c74723e0a3c7464206865696768743d22333022206267636f6c6f723d2223346635393562223e266e6273703b3c2f74643e0a3c2f74723e0a3c74723e0a3c746420616c69676e3d2263656e74657222206267636f6c6f723d2223346635393562223e266e6273703b3c2f74643e0a3c2f74723e0a3c74723e0a3c7464206865696768743d22353022206267636f6c6f723d2223346635393562223e266e6273703b3c2f74643e0a3c2f74723e0a3c2f74626f64793e0a3c2f7461626c653e0a3c2f74643e0a3c2f74723e0a3c2f74626f64793e0a3c2f7461626c653e, 'Active', '2016-08-09 03:03:26', '', 'Host listed new property ', 'Renters', 'rentersteam@teamtweaks.com', '', '1'),
(35, 'Registration Confirmation', 0x3c646976207374796c653d22646973706c61793a20696e6c696e652d626c6f636b3b206261636b67726f756e643a206e6f6e6520726570656174207363726f6c6c203070782030707820236637663766373b20626f726465723a206d656469756d206e6f6e653b20626f782d736861646f773a2030707820307078203270782030707820236363636363633b20636f6c6f723a20233536356135633b206c696e652d6865696768743a20323170783b2077696474683a2035363070783b2070616464696e673a203230707820353070783b223e0a3c646976207374796c653d22646973706c61793a20696e6c696e652d626c6f636b3b20746578742d616c69676e3a2063656e7465723b2077696474683a20313030253b223e3c696d67207374796c653d2277696474683a2031343970783b22207372633d227b626173655f75726c28297d696d616765732f6c6f676f2f7b246c6f676f7d2220616c743d2222202f3e3c2f6469763e0a3c646976207374796c653d22646973706c61793a20696e6c696e652d626c6f636b3b20666f6e742d73697a653a20313370783b2077696474683a20313030253b206d617267696e3a20303b2070616464696e673a20303b20666f6e742d66616d696c793a2048656c7665746963612c417269616c2c73616e732d73657269663b223e3c7370616e3e4869266e6273703b3c2f7370616e3e3c6c6162656c207374796c653d2270616464696e673a203020302030203270783b223e7b24757365726e616d657d2c3c2f6c6162656c3e0a3c646976207374796c653d22646973706c61793a20696e6c696e652d626c6f636b3b2077696474683a20313030253b206d617267696e3a203070783b20666f6e742d66616d696c793a2048656c7665746963612c417269616c2c73616e732d73657269663b20666f6e742d73697a653a20313470783b2070616464696e673a2039707820307078203670783b223e57656c636f6d6520746f2052656e746572732120496e206f7264657220746f2067657420737461727465642c20796f75206e65656420746f20636f6e6669726d20796f757220656d61696c20616464726573732e3c2f6469763e0a3c64697620636c6173733d22702022207374796c653d226d617267696e3a20303b2070616464696e673a20303b223e0a3c64697620636c6173733d2262746e2062746e2d7072696d6172792073706163653122207374796c653d226d617267696e3a20303b223e3c6120687265663d227b2463666d75726c7d223e20436f6e6669726d20456d61696c3c2f613e266e6273703b20266e6273703b266e6273703b3c2f6469763e0a3c2f6469763e0a3c64697620636c6173733d22702022207374796c653d2270616464696e673a203070783b20666f6e742d66616d696c793a2048656c7665746963612c417269616c2c73616e732d73657269663b20666f6e742d73697a653a20313470783b206d617267696e3a2031656d203070782033656d3b223e5468616e6b732c20266e6273703b266e6273703b3c6272207374796c653d226d617267696e3a20303b2070616464696e673a20303b22202f3e546865207b24656d61696c5f7469746c657d205465616d3c2f6469763e0a3c2f6469763e0a3c2f6469763e, 'Active', '2016-08-22 04:13:31', '', 'Registration Confirmation', 'Renters', 'smithwilliam3592@gmail.com', '', '1'),
(18, 'Verification Confirmation', 0x3c646976207374796c653d22646973706c61793a20696e6c696e652d626c6f636b3b206261636b67726f756e643a206e6f6e6520726570656174207363726f6c6c203070782030707820236637663766373b20626f726465723a206d656469756d206e6f6e653b20626f782d736861646f773a2030707820307078203270782030707820236363636363633b20636f6c6f723a20233536356135633b206c696e652d6865696768743a20323170783b2077696474683a2035363070783b2070616464696e673a203230707820353070783b223e0a3c646976207374796c653d22646973706c61793a20696e6c696e652d626c6f636b3b20746578742d616c69676e3a2063656e7465723b2077696474683a20313030253b223e3c696d67207374796c653d2277696474683a2031343970783b22207372633d227b626173655f75726c28297d696d616765732f6c6f676f2f7b246c6f676f7d2220616c743d2222202f3e266e6273703b266e6273703b3c2f6469763e0a3c646976207374796c653d22646973706c61793a20696e6c696e652d626c6f636b3b20666f6e742d73697a653a20313370783b2077696474683a20313030253b206d617267696e3a20303b2070616464696e673a20303b20666f6e742d66616d696c793a2048656c7665746963612c417269616c2c73616e732d73657269663b223e3c7370616e3e48693c2f7370616e3e3c6c6162656c207374796c653d2270616464696e673a203020302030203270783b223e7b24757365726e616d657d2c3c2f6c6162656c3e0a3c646976207374796c653d22646973706c61793a20696e6c696e652d626c6f636b3b2077696474683a20313030253b206d617267696e3a203070783b20666f6e742d66616d696c793a2048656c7665746963612c417269616c2c73616e732d73657269663b20666f6e742d73697a653a20313470783b2070616464696e673a2039707820307078203670783b223e4861692061646d696e206b696e646c7920617070726f7665207468652076657266697920737461747573202e3c2f6469763e0a3c64697620636c6173733d22702022207374796c653d2270616464696e673a203070783b20666f6e742d66616d696c793a2048656c7665746963612c417269616c2c73616e732d73657269663b20666f6e742d73697a653a20313470783b206d617267696e3a2031656d203070782033656d3b223e5468616e6b732c3c6272207374796c653d226d617267696e3a20303b2070616464696e673a20303b22202f3e546865207b24656d61696c5f7469746c657d205465616d3c2f6469763e0a3c2f6469763e0a3c2f6469763e, 'Active', '2016-08-22 04:11:58', '', 'Verification Confirmation', 'Renters', 'smithwilliam3592@gmail.com', '', '1'),
(44, 'Review Listed', 0x3c7461626c6520636c6173733d2275692d736f727461626c652d68616e646c652063757272656e745461626c652220626f726465723d2230222077696474683d2231303025222063656c6c73706163696e673d2230222063656c6c70616464696e673d22302220616c69676e3d2263656e74657222206267636f6c6f723d2223666666666666223e0a3c74626f64793e0a3c74723e0a3c74643e0a3c7461626c6520636c6173733d22646576696365776964746822207374796c653d226261636b67726f756e642d636f6c6f723a20236666666666663b2220626f726465723d2230222077696474683d22363030222063656c6c73706163696e673d2230222063656c6c70616464696e673d22302220616c69676e3d2263656e746572223e0a3c74626f64793e0a3c74723e0a3c7464206267636f6c6f723d222366666666666622206865696768743d223330223e266e6273703b20266e6273703b20266e6273703b3c2f74643e0a3c2f74723e0a3c74723e0a3c746420616c69676e3d226c65667422206267636f6c6f723d2223666666666666223e3c696d67207372633d227b626173655f75726c28297d696d616765732f6c6f676f2f7b246c6f676f7d2220616c743d226c6f676f222077696474683d2232303022202f3e3c2f74643e0a3c2f74723e0a3c74723e0a3c7464206267636f6c6f723d222366666666666622206865696768743d223330223e266e6273703b3c2f74643e0a3c2f74723e0a3c74723e0a3c746420636c6173733d226564697461626c6522207374796c653d22636f6c6f723a20236666666666663b20666f6e742d66616d696c793a204f70656e2053616e732c20417269616c2c2048656c7665746963612c2073616e732d73657269663b20666f6e742d73697a653a20313870783b20666f6e742d7765696768743a20626f6c643b20746578742d7472616e73666f726d3a207570706572636173653b2070616464696e673a2038707820323070783b206261636b67726f756e642d636f6c6f723a20233462626566663b2220616c69676e3d2263656e746572222076616c69676e3d226d6964646c65223e3c7370616e207374796c653d22636f6c6f723a20236666666666663b223e4869207b24686f73745f6e616d657d3c2f7370616e3e3c2f74643e0a3c2f74723e0a3c74723e0a3c7464206865696768743d223330223e266e6273703b3c2f74643e0a3c2f74723e0a3c74723e0a3c7464207374796c653d22636f6c6f723a20233030303b2070616464696e673a2030707820323070783b20666f6e742d66616d696c793a204f70656e2053616e732c20417269616c2c2048656c7665746963612c2073616e732d73657269663b20666f6e742d73697a653a20313370783b2220616c69676e3d2263656e746572223e0a3c703e3c7370616e207374796c653d22666f6e742d73697a653a20782d6c617267653b223e3c7374726f6e673e2055736572207b24757365725f6e616d657d2068617320706f737465642061207265766965772061626f757420796f7572206c697374696e67207b2470726f647563745f6e616d657d203c2f7374726f6e673e3c2f7370616e3e3c2f703e0a3c703e3c7370616e207374796c653d22666f6e742d73697a653a206d656469756d3b223e3c7374726f6e673e266e6273703b3c2f7374726f6e673e3c2f7370616e3e3c2f703e0a3c2f74643e0a3c2f74723e0a3c74723e0a3c74643e0a3c703e266e6273703b3c2f703e0a3c2f74643e0a3c2f74723e0a3c74723e0a3c7464207374796c653d22636f6c6f723a20233030303b2070616464696e673a2030707820323070783b20666f6e742d66616d696c793a204f70656e2053616e732c20417269616c2c2048656c7665746963612c2073616e732d73657269663b20666f6e742d73697a653a20313370783b2220616c69676e3d2263656e746572223e3c6120687265663d227b626173655f75726c28297d736974652f70726f647563742f646973706c61795f726576696577223e20436c69636b204865726520546f20566965773c2f613e3c2f74643e0a3c2f74723e0a3c74723e0a3c74643e266e6273703b3c2f74643e0a3c2f74723e0a3c74723e0a3c7464206865696768743d223330223e266e6273703b3c2f74643e0a3c2f74723e0a3c74723e0a3c7464207374796c653d2270616464696e673a2030707820323070783b20636f6c6f723a20233434343434343b20666f6e742d66616d696c793a204f70656e2053616e732c20417269616c2c2048656c7665746963612c2073616e732d73657269663b20666f6e742d73697a653a20313370783b2220616c69676e3d226c656674222076616c69676e3d226d6964646c65223e0a3c703e5468616e6b73213c2f703e0a3c703e5468652052656e74657273205465616d3c2f703e0a3c2f74643e0a3c2f74723e0a3c74723e0a3c7464206865696768743d223330223e266e6273703b3c2f74643e0a3c2f74723e0a3c74723e0a3c746420616c69676e3d2263656e74657222206267636f6c6f723d2223666666666666223e266e6273703b3c2f74643e0a3c2f74723e0a3c74723e0a3c7464206267636f6c6f723d222366666666666622206865696768743d223530223e266e6273703b3c2f74643e0a3c2f74723e0a3c2f74626f64793e0a3c2f7461626c653e0a3c2f74643e0a3c2f74723e0a3c2f74626f64793e0a3c2f7461626c653e, 'Active', '2016-10-05 02:46:24', '', 'Review Has Been Posted', 'Renters', 'rentersteam@teamtweaks.com', '', '1'),
(30, 'Host Approve Reservation', 0x3c7461626c6520636c6173733d2275692d736f727461626c652d68616e646c652063757272656e745461626c652220626f726465723d2230222063656c6c73706163696e673d2230222063656c6c70616464696e673d2230222077696474683d22313030252220616c69676e3d2263656e74657222206267636f6c6f723d2223346635393562223e0a3c74626f64793e0a3c74723e0a3c74643e0a3c7461626c6520636c6173733d22646576696365776964746822207374796c653d226261636b67726f756e642d636f6c6f723a20236638663866383b2220626f726465723d2230222063656c6c73706163696e673d2230222063656c6c70616464696e673d2230222077696474683d223630302220616c69676e3d2263656e746572223e0a3c74626f64793e0a3c74723e0a3c7464206865696768743d22333022206267636f6c6f723d2223346635393562223e266e6273703b3c2f74643e0a3c2f74723e0a3c74723e0a3c746420616c69676e3d226c65667422206267636f6c6f723d2223346635393562223e3c696d67207372633d227b626173655f75726c28297d696d616765732f6c6f676f2f7b246c6f676f7d2220616c743d226c6f676f222077696474683d22323030707822202f3e266e6273703b20266e6273703b3c2f74643e0a3c2f74723e0a3c74723e0a3c7464206865696768743d22333022206267636f6c6f723d2223346635393562223e266e6273703b3c2f74643e0a3c2f74723e0a3c74723e0a3c746420636c6173733d226564697461626c6522207374796c653d22636f6c6f723a20236666666666663b20666f6e742d66616d696c793a204f70656e2053616e732c20417269616c2c2048656c7665746963612c2073616e732d73657269663b20666f6e742d73697a653a20313870783b20666f6e742d7765696768743a20626f6c643b20746578742d7472616e73666f726d3a207570706572636173653b2070616464696e673a2038707820323070783b206261636b67726f756e642d636f6c6f723a20233462626566663b2220616c69676e3d2263656e746572222076616c69676e3d226d6964646c65223e4869207b24686f73746e616d657d2c3c2f74643e0a3c2f74723e0a3c74723e0a3c7464206865696768743d223330223e266e6273703b3c2f74643e0a3c2f74723e0a3c74723e0a3c74643e266e6273703b3c2f74643e0a3c2f74723e0a3c74723e0a3c7468207374796c653d22636f6c6f723a20233030303b2070616464696e673a2030707820323070783b20666f6e742d66616d696c793a204f70656e2053616e732c20417269616c2c2048656c7665746963612c2073616e732d73657269663b20666f6e742d73697a653a20313370783b2220616c69676e3d2263656e746572223e596f752068617665206163636570746564207b2474726176656c65726e616d657d207265736572766174696f6e207265717565737420666f72207b2470726f70657274796e616d657d2e203c2f74683e0a3c2f74723e0a3c74723e0a3c74643e266e6273703b3c2f74643e0a3c2f74723e0a3c74723e0a3c7464206865696768743d223330223e266e6273703b3c2f74643e0a3c2f74723e0a3c74723e0a3c7464207374796c653d2270616464696e673a2030707820323070783b20636f6c6f723a20233434343434343b20666f6e742d66616d696c793a204f70656e2053616e732c20417269616c2c2048656c7665746963612c2073616e732d73657269663b20666f6e742d73697a653a20313370783b2220616c69676e3d226c656674222076616c69676e3d226d6964646c65223e0a3c703e5468616e6b73213c2f703e0a3c703e5468652052656e74657273205465616d3c2f703e0a3c2f74643e0a3c2f74723e0a3c74723e0a3c7464206865696768743d223330223e266e6273703b3c2f74643e0a3c2f74723e0a3c74723e0a3c7464206865696768743d22333022206267636f6c6f723d2223346635393562223e266e6273703b3c2f74643e0a3c2f74723e0a3c74723e0a3c746420616c69676e3d2263656e74657222206267636f6c6f723d2223346635393562223e266e6273703b3c2f74643e0a3c2f74723e0a3c74723e0a3c7464206865696768743d22353022206267636f6c6f723d2223346635393562223e266e6273703b3c2f74643e0a3c2f74723e0a3c2f74626f64793e0a3c2f7461626c653e0a3c2f74643e0a3c2f74723e0a3c2f74626f64793e0a3c2f7461626c653e, 'Active', '2016-05-31 01:30:31', '', 'Host Approve Reservation', 'Renters', 'rentersteam@teamtweaks.com', '', '1'),
(20, 'Reservation request copy to travellers', 0x3c7461626c6520636c6173733d2275692d736f727461626c652d68616e646c652063757272656e745461626c652220626f726465723d2230222063656c6c73706163696e673d2230222063656c6c70616464696e673d2230222077696474683d22313030252220616c69676e3d2263656e74657222206267636f6c6f723d2223346635393562223e0a3c74626f64793e0a3c74723e0a3c74643e0a3c7461626c6520636c6173733d22646576696365776964746822207374796c653d226261636b67726f756e642d636f6c6f723a20236638663866383b2220626f726465723d2230222063656c6c73706163696e673d2230222063656c6c70616464696e673d2230222077696474683d223630302220616c69676e3d2263656e746572223e0a3c74626f64793e0a3c74723e0a3c7464206865696768743d22333022206267636f6c6f723d2223346635393562223e266e6273703b20266e6273703b20266e6273703b266e6273703b3c2f74643e0a3c2f74723e0a3c74723e0a3c746420616c69676e3d226c65667422206267636f6c6f723d2223346635393562223e3c696d67207372633d227b626173655f75726c28297d696d616765732f6c6f676f2f7b246c6f676f7d2220616c743d226c6f676f222077696474683d2232303022202f3e3c2f74643e0a3c2f74723e0a3c74723e0a3c7464206865696768743d22333022206267636f6c6f723d2223346635393562223e266e6273703b3c2f74643e0a3c2f74723e0a3c74723e0a3c746420636c6173733d226564697461626c6522207374796c653d22636f6c6f723a20236666666666663b20666f6e742d66616d696c793a204f70656e2053616e732c20417269616c2c2048656c7665746963612c2073616e732d73657269663b20666f6e742d73697a653a20313870783b20666f6e742d7765696768743a20626f6c643b20746578742d7472616e73666f726d3a207570706572636173653b2070616464696e673a2038707820323070783b206261636b67726f756e642d636f6c6f723a20233462626566663b2220616c69676e3d2263656e746572222076616c69676e3d226d6964646c65223e4869207b2474726176656c6c65726e616d657d3c2f74643e0a3c2f74723e0a3c74723e0a3c7464206865696768743d223430223e266e6273703b3c2f74643e0a3c2f74723e0a3c74723e0a3c7464207374796c653d22636f6c6f723a20233030303b2070616464696e673a2030707820313070783b20666f6e742d7765696768743a20626f6c643b20666f6e742d66616d696c793a204f70656e2053616e732c20417269616c2c2048656c7665746963612c2073616e732d73657269663b20666f6e742d73697a653a20313370783b2220616c69676e3d2263656e746572222076616c69676e3d22746f70223e596f7572207265736572766174696f6e207265717565737420666f72207b2470726f647563746e616d657d20686173206265656e207375626d69747465642e3c2f74643e0a3c2f74723e0a3c74723e0a3c7464206865696768743d223430223e266e6273703b3c2f74643e0a3c2f74723e0a3c74723e0a3c7464207374796c653d22636f6c6f723a20233030303b2070616464696e673a2030707820323070783b20666f6e742d66616d696c793a204f70656e2053616e732c20417269616c2c2048656c7665746963612c2073616e732d73657269663b20666f6e742d73697a653a20313370783b2220616c69676e3d2263656e746572223e596f757220706f74656e7469616c20686f73742068617320323420686f75727320746f20726573706f6e6420746f20796f757220726571756573742c20627574206d6f7374206f66206f757220686f737473207265706c79206d6f726520717569636b6c79207468616e207468617421204f6e6365207b24686f73746e616d657d2061636365707473206f72206465636c696e657320796f7572207265736572766174696f6e2c207765276c6c206c657420796f75206b6e6f772e3c2f74643e0a3c2f74723e0a3c74723e0a3c7464207374796c653d22636f6c6f723a20233030303b2070616464696e673a20313070782032307078203130707820323070783b20666f6e742d66616d696c793a204f70656e2053616e732c20417269616c2c2048656c7665746963612c2073616e732d73657269663b20666f6e742d73697a653a20313370783b2220616c69676e3d2263656e746572223e5765206861766520617574686f72697a656420796f7572207061796d656e74206d6574686f6420666f72203c7370616e3e7b2473796d626f6c7d3c2f7370616e3e207b24746f74616c70726963657d2c207468652066756c6c20616d6f756e74206f6620746865207265736572766174696f6e2e20496620796f75722072657175657374206973206465636c696e6564206f7220657870697265732c20796f752077696c6c206e6f7420626520636861726765642e3c2f74643e0a3c2f74723e0a3c74723e0a3c74643e266e6273703b3c2f74643e0a3c2f74723e0a3c74723e0a3c746420616c69676e3d2263656e746572222076616c69676e3d226d6964646c65223e0a3c646976207374796c653d226261636b67726f756e642d636f6c6f723a20236633343032653b20646973706c61793a207461626c653b20626f726465722d7261646975733a203570783b20636f6c6f723a20236666666666663b20666f6e742d66616d696c793a204f70656e2053616e732c20417269616c2c2073616e732d73657269663b20666f6e742d73697a653a20313370783b20746578742d7472616e73666f726d3a207570706572636173653b20666f6e742d7765696768743a20626f6c643b2070616464696e673a2037707820313270783b20746578742d616c69676e3a2063656e7465723b20746578742d6465636f726174696f6e3a206e6f6e653b2077696474683a2031343070783b206d617267696e3a206175746f3b223e3c61207374796c653d22636f6c6f723a20236666666666663b20746578742d6465636f726174696f6e3a206e6f6e653b2220687265663d227b626173655f75726c28297d72656e74616c2f7b247072645f69647d223e3c696d67207372633d227b626173655f75726c28297d7365727665722f7068702f72656e74616c2f7b247072645f696d6167657d2220616c743d22222077696474683d2233303022202f3e20287b2470726f647563746e616d657d293c2f613e3c2f6469763e0a3c2f74643e0a3c2f74723e0a3c74723e0a3c746420616c69676e3d2263656e746572223e0a3c7461626c6520626f726465723d2230222063656c6c73706163696e673d2230222063656c6c70616464696e673d2230222077696474683d22313030252220616c69676e3d2263656e746572223e0a3c74626f64793e0a3c7472207374796c653d2270616464696e673a20313070783b20666c6f61743a206c6566743b223e0a3c746420616c69676e3d2263656e746572222076616c69676e3d22746f70223e0a3c70207374796c653d226d617267696e3a203070783b2070616464696e673a2038707820313070783b20666f6e742d66616d696c793a204f70656e2053616e732c20417269616c2c2048656c7665746963612c2073616e732d73657269663b20666f6e742d73697a653a20313370783b206261636b67726f756e643a20236631663166313b223e5265736572766174696f6e20526571756573743c2f703e0a3c7461626c6520626f726465723d2230222063656c6c73706163696e673d2231222063656c6c70616464696e673d2235222077696474683d2236303022206267636f6c6f723d2223454145414541223e0a3c74626f6479207374796c653d22666f6e742d66616d696c793a204f70656e2053616e732c20417269616c2c2048656c7665746963612c2073616e732d73657269663b20666f6e742d73697a653a20313370783b223e0a3c74723e0a3c74682077696474683d223735223e54696d653c2f74683e203c74682077696474683d223735223e446174653c2f74683e0a3c2f74723e0a3c747220616c69676e3d2263656e746572223e0a3c7464206267636f6c6f723d2223464646464646223e4172726976653c2f74643e0a3c7464206267636f6c6f723d2223464646464646223e7b24636865636b696e646174657d3c2f74643e0a3c2f74723e0a3c747220616c69676e3d2263656e746572223e0a3c7464206267636f6c6f723d2223464646464646223e4465706172743c2f74643e0a3c7464206267636f6c6f723d2223464646464646223e7b24636865636b6f7574646174657d3c2f74643e0a3c2f74723e0a3c2f74626f64793e0a3c2f7461626c653e0a3c2f74643e0a3c2f74723e0a3c2f74626f64793e0a3c2f7461626c653e0a3c2f74643e0a3c2f74723e0a3c74723e0a3c74643e266e6273703b3c2f74643e0a3c2f74723e0a3c74723e0a3c7464206865696768743d2230223e266e6273703b3c2f74643e0a3c2f74723e0a3c74723e0a3c7464207374796c653d2270616464696e673a2030707820323070783b20636f6c6f723a20233434343434343b20666f6e742d66616d696c793a204f70656e2053616e732c20417269616c2c2048656c7665746963612c2073616e732d73657269663b20666f6e742d73697a653a20313370783b2220616c69676e3d226c656674222076616c69676e3d226d6964646c65223e0a3c703e5468616e6b73213c2f703e0a3c703e5468652052656e74657273205465616d3c2f703e0a3c2f74643e0a3c2f74723e0a3c74723e0a3c7464206865696768743d223330223e266e6273703b3c2f74643e0a3c2f74723e0a3c74723e0a3c7464206865696768743d22333022206267636f6c6f723d2223346635393562223e266e6273703b3c2f74643e0a3c2f74723e0a3c74723e0a3c746420616c69676e3d2263656e74657222206267636f6c6f723d2223346635393562223e266e6273703b3c2f74643e0a3c2f74723e0a3c74723e0a3c7464206865696768743d22353022206267636f6c6f723d2223346635393562223e266e6273703b3c2f74643e0a3c2f74723e0a3c2f74626f64793e0a3c2f7461626c653e0a3c2f74643e0a3c2f74723e0a3c2f74626f64793e0a3c2f7461626c653e, 'Active', '2016-08-09 12:54:27', '', 'Reservation Request', 'Renters', 'rentersteam@teamtweaks.com', '', '1'),
(21, 'After Host List Property', 0x3c7461626c6520636c6173733d2275692d736f727461626c652d68616e646c652063757272656e745461626c652220626f726465723d2230222063656c6c73706163696e673d2230222063656c6c70616464696e673d2230222077696474683d22313030252220616c69676e3d2263656e74657222206267636f6c6f723d2223346635393562223e0a3c74626f64793e0a3c74723e0a3c74643e0a3c7461626c6520636c6173733d22646576696365776964746822207374796c653d226261636b67726f756e642d636f6c6f723a20236638663866383b2220626f726465723d2230222063656c6c73706163696e673d2230222063656c6c70616464696e673d2230222077696474683d223630302220616c69676e3d2263656e746572223e0a3c74626f64793e0a3c74723e0a3c7464206865696768743d22333022206267636f6c6f723d2223346635393562223e266e6273703b3c2f74643e0a3c2f74723e0a3c74723e0a3c746420616c69676e3d226c65667422206267636f6c6f723d2223346635393562223e3c696d67207372633d227b626173655f75726c28297d696d616765732f6c6f676f2f7b246c6f676f7d2220616c743d226c6f676f22202f3e3c2f74643e0a3c2f74723e0a3c74723e0a3c7464206865696768743d22333022206267636f6c6f723d2223346635393562223e266e6273703b3c2f74643e0a3c2f74723e0a3c74723e0a3c746420636c6173733d226564697461626c6522207374796c653d22636f6c6f723a20236666666666663b20666f6e742d66616d696c793a204f70656e2053616e732c20417269616c2c2048656c7665746963612c2073616e732d73657269663b20666f6e742d73697a653a20313870783b20666f6e742d7765696768743a20626f6c643b20746578742d7472616e73666f726d3a207570706572636173653b2070616464696e673a2038707820323070783b206261636b67726f756e642d636f6c6f723a20233462626566663b2220616c69676e3d2263656e746572222076616c69676e3d226d6964646c65223e4869207b24686f73745f6e616d657d3c2f74643e0a3c2f74723e0a3c74723e0a3c7464206865696768743d223330223e266e6273703b3c2f74643e0a3c2f74723e0a3c74723e0a3c7464207374796c653d22636f6c6f723a20233030303b2070616464696e673a2030707820323070783b20666f6e742d66616d696c793a204f70656e2053616e732c20417269616c2c2048656c7665746963612c2073616e732d73657269663b20666f6e742d73697a653a20313370783b2220616c69676e3d2263656e746572223e596f75206861766520637265617465642061206e6577206c697374696e67207769746820796f75722052656e74657273206163636f756e74206f6e207b2463646174657d206174207b246374696d657d2e20266e6273703b3c2f74643e0a3c2f74723e0a3c74723e0a3c74643e266e6273703b3c2f74643e0a3c2f74723e0a3c74723e0a3c7464207374796c653d22636f6c6f723a20233030303b2070616464696e673a2030707820323070783b20666f6e742d66616d696c793a204f70656e2053616e732c20417269616c2c2048656c7665746963612c2073616e732d73657269663b20666f6e742d73697a653a20313370783b2220616c69676e3d226c656674223e4c697374206e616d65203a207b2470726f70657274796e616d657d3c2f74643e0a3c2f74723e0a3c74723e0a3c7464207374796c653d22636f6c6f723a20233030303b2070616464696e673a2030707820323070783b20666f6e742d66616d696c793a204f70656e2053616e732c20417269616c2c2048656c7665746963612c2073616e732d73657269663b20666f6e742d73697a653a20313370783b2220616c69676e3d226c656674223e4c696e6b203a3c6120687265663d227b626173655f75726c28297d72656e74616c2f7b2470726f706572747969647d223e207b626173655f75726c28297d72656e74616c2f7b2470726f706572747969647d3c2f613e3c2f74643e0a3c2f74723e0a3c74723e0a3c7464207374796c653d22636f6c6f723a20233030303b2070616464696e673a2030707820323070783b20666f6e742d66616d696c793a204f70656e2053616e732c20417269616c2c2048656c7665746963612c2073616e732d73657269663b20666f6e742d73697a653a20313370783b2220616c69676e3d226c656674223e5072696365203a203c7370616e3e7b2473796d626f6c7d3c2f7370616e3e207b2470726963657d3c2f74643e0a3c2f74723e0a3c74723e0a3c74643e266e6273703b3c2f74643e0a3c2f74723e0a3c74723e0a3c74643e266e6273703b3c2f74643e0a3c2f74723e0a3c74723e0a3c7464207374796c653d22636f6c6f723a20233030303b2070616464696e673a2030707820323070783b20666f6e742d66616d696c793a204f70656e2053616e732c20417269616c2c2048656c7665746963612c2073616e732d73657269663b20666f6e742d73697a653a20313370783b2220616c69676e3d226c656674223e496620746869732077617320796f752c20796f752063616e2069676e6f7265207468697320656d61696c2e3c2f74643e0a3c2f74723e0a3c74723e0a3c74643e266e6273703b3c2f74643e0a3c2f74723e0a3c74723e0a3c7464207374796c653d22636f6c6f723a20233030303b2070616464696e673a2030707820323070783b20666f6e742d66616d696c793a204f70656e2053616e732c20417269616c2c2048656c7665746963612c2073616e732d73657269663b20666f6e742d73697a653a20313370783b2220616c69676e3d226c656674223e49662074686973207761736e277420796f752c206c6574207573206b6e6f772e204e6f74696679696e6720757320697320696d706f7274616e7420626563617573652069742068656c7073207573206d616b652073757265206e6f206f6e6520697320616363657373696e6720796f7572206163636f756e7420776974686f757420796f7572206b6e6f776c656467652e3c2f74643e0a3c2f74723e0a3c74723e0a3c7464206865696768743d223330223e266e6273703b3c2f74643e0a3c2f74723e0a3c74723e0a3c7464207374796c653d2270616464696e673a2030707820323070783b20636f6c6f723a20233434343434343b20666f6e742d66616d696c793a204f70656e2053616e732c20417269616c2c2048656c7665746963612c2073616e732d73657269663b20666f6e742d73697a653a20313370783b2220616c69676e3d226c656674222076616c69676e3d226d6964646c65223e0a3c703e5468616e6b73213c2f703e0a3c703e5468652052656e74657273205465616d3c2f703e0a3c2f74643e0a3c2f74723e0a3c74723e0a3c7464206865696768743d223330223e266e6273703b3c2f74643e0a3c2f74723e0a3c74723e0a3c7464206865696768743d22333022206267636f6c6f723d2223346635393562223e266e6273703b3c2f74643e0a3c2f74723e0a3c74723e0a3c746420616c69676e3d2263656e74657222206267636f6c6f723d2223346635393562223e266e6273703b3c2f74643e0a3c2f74723e0a3c74723e0a3c7464206865696768743d22353022206267636f6c6f723d2223346635393562223e266e6273703b3c2f74643e0a3c2f74723e0a3c2f74626f64793e0a3c2f7461626c653e0a3c2f74643e0a3c2f74723e0a3c2f74626f64793e0a3c2f7461626c653e, 'Active', '2016-08-22 02:47:19', '', 'After Host List Property', 'Renters', 'smithwilliam3592@gmail.com', '', '1'),
(26, 'Listing Payment Success  By Host', 0x3c7461626c6520636c6173733d2275692d736f727461626c652d68616e646c652063757272656e745461626c652220626f726465723d2230222077696474683d2231303025222063656c6c73706163696e673d2230222063656c6c70616464696e673d22302220616c69676e3d2263656e74657222206267636f6c6f723d2223346635393562223e0a3c74626f64793e0a3c74723e0a3c74643e0a3c7461626c6520636c6173733d22646576696365776964746822207374796c653d226261636b67726f756e642d636f6c6f723a20236638663866383b2220626f726465723d2230222077696474683d22363030222063656c6c73706163696e673d2230222063656c6c70616464696e673d22302220616c69676e3d2263656e746572223e0a3c74626f64793e0a3c74723e0a3c7464206267636f6c6f723d222334663539356222206865696768743d223330223e266e6273703b3c2f74643e0a3c2f74723e0a3c74723e0a3c746420616c69676e3d226c65667422206267636f6c6f723d2223346635393562223e3c696d67207372633d227b626173655f75726c28297d696d616765732f6c6f676f2f7b246c6f676f7d2220616c743d226c6f676f22202f3e266e6273703b20266e6273703b20266e6273703b3c2f74643e0a3c2f74723e0a3c74723e0a3c7464206267636f6c6f723d222334663539356222206865696768743d223330223e266e6273703b3c2f74643e0a3c2f74723e0a3c74723e0a3c746420636c6173733d226564697461626c6522207374796c653d22636f6c6f723a20236666666666663b20666f6e742d66616d696c793a204f70656e2053616e732c20417269616c2c2048656c7665746963612c2073616e732d73657269663b20666f6e742d73697a653a20313870783b20666f6e742d7765696768743a20626f6c643b20746578742d7472616e73666f726d3a207570706572636173653b2070616464696e673a2038707820323070783b206261636b67726f756e642d636f6c6f723a20233462626566663b2220616c69676e3d2263656e746572222076616c69676e3d226d6964646c65223e4869207b24686f73746e616d657d2c3c2f74643e0a3c2f74723e0a3c74723e0a3c7464206865696768743d223330223e266e6273703b3c2f74643e0a3c2f74723e0a3c74723e0a3c74643e266e6273703b3c2f74643e0a3c2f74723e0a3c74723e0a3c7468207374796c653d22636f6c6f723a20233030303b2070616464696e673a2030707820323070783b20666f6e742d66616d696c793a204f70656e2053616e732c20417269616c2c2048656c7665746963612c2073616e732d73657269663b20666f6e742d73697a653a20313370783b2220616c69676e3d2263656e746572223e596f752776652070616964266e6273703b555344207b24616d6f756e747d2c20666f72266e6273703b7468652070726f7065727479207b247072646e616d657d266e6273703b3c2f74683e0a3c2f74723e0a3c74723e0a3c74643e266e6273703b3c2f74643e0a3c2f74723e0a3c74723e0a3c7464206865696768743d223330223e266e6273703b3c2f74643e0a3c2f74723e0a3c74723e0a3c7464207374796c653d2270616464696e673a2030707820323070783b20636f6c6f723a20233434343434343b20666f6e742d66616d696c793a204f70656e2053616e732c20417269616c2c2048656c7665746963612c2073616e732d73657269663b20666f6e742d73697a653a20313370783b2220616c69676e3d226c656674222076616c69676e3d226d6964646c65223e0a3c703e5468616e6b73213c2f703e0a3c703e5468652052656e746572205465616d3c2f703e0a3c2f74643e0a3c2f74723e0a3c74723e0a3c7464206865696768743d223330223e266e6273703b3c2f74643e0a3c2f74723e0a3c74723e0a3c7464206267636f6c6f723d222334663539356222206865696768743d223330223e266e6273703b3c2f74643e0a3c2f74723e0a3c74723e0a3c746420616c69676e3d2263656e74657222206267636f6c6f723d2223346635393562223e266e6273703b3c2f74643e0a3c2f74723e0a3c74723e0a3c7464206267636f6c6f723d222334663539356222206865696768743d223530223e266e6273703b3c2f74643e0a3c2f74723e0a3c2f74626f64793e0a3c2f7461626c653e0a3c2f74643e0a3c2f74723e0a3c2f74626f64793e0a3c2f7461626c653e, 'Active', '2016-08-31 04:13:09', '', 'Listing Payment Success  By Host', 'Renters', 'rentersteam@teamtweaks.com', '', '1');
INSERT INTO `fc_newsletter` (`id`, `news_title`, `news_descrip`, `status`, `dateAdded`, `news_image`, `news_subject`, `sender_name`, `sender_email`, `news_seourl`, `typeVal`) VALUES
(52, 'After Admin List Property', 0x3c7461626c6520636c6173733d2275692d736f727461626c652d68616e646c652063757272656e745461626c652220626f726465723d2230222063656c6c73706163696e673d2230222063656c6c70616464696e673d2230222077696474683d22313030252220616c69676e3d2263656e74657222206267636f6c6f723d2223346635393562223e0a3c74626f64793e0a3c74723e0a3c74643e0a3c7461626c6520636c6173733d22646576696365776964746822207374796c653d226261636b67726f756e642d636f6c6f723a20236638663866383b2220626f726465723d2230222063656c6c73706163696e673d2230222063656c6c70616464696e673d2230222077696474683d223630302220616c69676e3d2263656e746572223e0a3c74626f64793e0a3c74723e0a3c7464206865696768743d22333022206267636f6c6f723d2223346635393562223e266e6273703b20266e6273703b266e6273703b3c2f74643e0a3c2f74723e0a3c74723e0a3c746420616c69676e3d226c65667422206267636f6c6f723d2223346635393562223e3c696d67207372633d227b626173655f75726c28297d696d616765732f6c6f676f2f7b246c6f676f7d2220616c743d226c6f676f222077696474683d2232303022202f3e3c2f74643e0a3c2f74723e0a3c74723e0a3c7464206865696768743d22333022206267636f6c6f723d2223346635393562223e266e6273703b3c2f74643e0a3c2f74723e0a3c74723e0a3c746420636c6173733d226564697461626c6522207374796c653d22636f6c6f723a20236666666666663b20666f6e742d66616d696c793a204f70656e2053616e732c20417269616c2c2048656c7665746963612c2073616e732d73657269663b20666f6e742d73697a653a20313870783b20666f6e742d7765696768743a20626f6c643b20746578742d7472616e73666f726d3a207570706572636173653b2070616464696e673a2038707820323070783b206261636b67726f756e642d636f6c6f723a20233462626566663b2220616c69676e3d2263656e746572222076616c69676e3d226d6964646c65223e48692041646d696e2c3c2f74643e0a3c2f74723e0a3c74723e0a3c7464206865696768743d223330223e266e6273703b3c2f74643e0a3c2f74723e0a3c74723e0a3c7468207374796c653d22636f6c6f723a20233030303b2070616464696e673a2030707820323070783b20666f6e742d66616d696c793a204f70656e2053616e732c20417269616c2c2048656c7665746963612c2073616e732d73657269663b20666f6e742d73697a653a20313370783b2220616c69676e3d2263656e746572223e207b24686f73745f6e616d657d2068617665206372656174656420746865206e6577206c6973742e203c2f74683e0a3c2f74723e0a3c74723e0a3c74643e266e6273703b3c2f74643e0a3c2f74723e0a3c74723e0a3c7464207374796c653d22636f6c6f723a20233030303b2070616464696e673a2030707820323070783b20666f6e742d66616d696c793a204f70656e2053616e732c20417269616c2c2048656c7665746963612c2073616e732d73657269663b20666f6e742d73697a653a20313370783b2220616c69676e3d226c656674223e486f7374206e616d65203a207b24686f73745f6e616d657d3c2f74643e0a3c2f74723e0a3c74723e0a3c74643e266e6273703b3c2f74643e0a3c2f74723e0a3c74723e0a3c7464207374796c653d22636f6c6f723a20233030303b2070616464696e673a2030707820323070783b20666f6e742d66616d696c793a204f70656e2053616e732c20417269616c2c2048656c7665746963612c2073616e732d73657269663b20666f6e742d73697a653a20313370783b2220616c69676e3d226c656674223e4c697374206e616d65203a207b2470726f70657274796e616d657d3c2f74643e0a3c2f74723e0a3c74723e0a3c74643e266e6273703b3c2f74643e0a3c2f74723e0a3c74723e0a3c7464207374796c653d22636f6c6f723a20233030303b2070616464696e673a2030707820323070783b20666f6e742d66616d696c793a204f70656e2053616e732c20417269616c2c2048656c7665746963612c2073616e732d73657269663b20666f6e742d73697a653a20313370783b2220616c69676e3d226c656674223e4c696e6b203a3c6120687265663d2220616972626e622e7a6f706c61792e636f6d2f72656e74616c2f7b2470726f706572747969647d223e203c2f613e3c6120687265663d227b626173655f75726c28297d72656e74616c2f7b2470726f706572747969647d223e7b626173655f75726c28297d72656e74616c2f7b2470726f706572747969647d3c2f613e3c2f74643e0a3c2f74723e0a3c74723e0a3c74643e266e6273703b3c2f74643e0a3c2f74723e0a3c74723e0a3c7464207374796c653d22636f6c6f723a20233030303b2070616464696e673a2030707820323070783b20666f6e742d66616d696c793a204f70656e2053616e732c20417269616c2c2048656c7665746963612c2073616e732d73657269663b20666f6e742d73697a653a20313370783b2220616c69676e3d226c656674223e5072696365203a203c7370616e3e7b2473796d626f6c7d3c2f7370616e3e207b2470726963657d3c2f74643e0a3c2f74723e0a3c74723e0a3c74643e266e6273703b3c2f74643e0a3c2f74723e0a3c74723e0a3c7464206865696768743d223330223e266e6273703b3c2f74643e0a3c2f74723e0a3c74723e0a3c7464207374796c653d2270616464696e673a2030707820323070783b20636f6c6f723a20233434343434343b20666f6e742d66616d696c793a204f70656e2053616e732c20417269616c2c2048656c7665746963612c2073616e732d73657269663b20666f6e742d73697a653a20313370783b2220616c69676e3d226c656674222076616c69676e3d226d6964646c65223e0a3c703e5468616e6b73213c2f703e0a3c703e5468652052656e74657273205465616d3c2f703e0a3c2f74643e0a3c2f74723e0a3c74723e0a3c7464206865696768743d223330223e266e6273703b3c2f74643e0a3c2f74723e0a3c74723e0a3c7464206865696768743d22333022206267636f6c6f723d2223346635393562223e266e6273703b3c2f74643e0a3c2f74723e0a3c74723e0a3c746420616c69676e3d2263656e74657222206267636f6c6f723d2223346635393562223e266e6273703b3c2f74643e0a3c2f74723e0a3c74723e0a3c7464206865696768743d22353022206267636f6c6f723d2223346635393562223e266e6273703b3c2f74643e0a3c2f74723e0a3c2f74626f64793e0a3c2f7461626c653e0a3c2f74643e0a3c2f74723e0a3c2f74626f64793e0a3c2f7461626c653e, 'Active', '2016-08-22 02:47:06', '', 'After Admin List Property', 'Renters', 'smithwilliam3592@gmail.com', '', '1'),
(23, 'Host Approve Reservation', 0x3c7461626c6520636c6173733d2275692d736f727461626c652d68616e646c652063757272656e745461626c652220626f726465723d2230222063656c6c73706163696e673d2230222063656c6c70616464696e673d2230222077696474683d22313030252220616c69676e3d2263656e74657222206267636f6c6f723d2223346635393562223e0a3c74626f64793e0a3c74723e0a3c74643e0a3c7461626c6520636c6173733d22646576696365776964746822207374796c653d226261636b67726f756e642d636f6c6f723a20236638663866383b2220626f726465723d2230222063656c6c73706163696e673d2230222063656c6c70616464696e673d2230222077696474683d223630302220616c69676e3d2263656e746572223e0a3c74626f64793e0a3c74723e0a3c7464206865696768743d22333022206267636f6c6f723d2223346635393562223e266e6273703b20266e6273703b266e6273703b3c2f74643e0a3c2f74723e0a3c74723e0a3c746420616c69676e3d226c65667422206267636f6c6f723d2223346635393562223e3c696d67207372633d227b626173655f75726c28297d696d616765732f6c6f676f2f7b246c6f676f7d2220616c743d226c6f676f222077696474683d2232303022202f3e3c2f74643e0a3c2f74723e0a3c74723e0a3c7464206865696768743d22333022206267636f6c6f723d2223346635393562223e266e6273703b3c2f74643e0a3c2f74723e0a3c74723e0a3c746420636c6173733d226564697461626c6522207374796c653d22636f6c6f723a20236666666666663b20666f6e742d66616d696c793a204f70656e2053616e732c20417269616c2c2048656c7665746963612c2073616e732d73657269663b20666f6e742d73697a653a20313870783b20666f6e742d7765696768743a20626f6c643b20746578742d7472616e73666f726d3a207570706572636173653b2070616464696e673a2038707820323070783b206261636b67726f756e642d636f6c6f723a20233462626566663b2220616c69676e3d2263656e746572222076616c69676e3d226d6964646c65223e4869207b2474726176656c65726e616d657d2c3c2f74643e0a3c2f74723e0a3c74723e0a3c7464206865696768743d223330223e266e6273703b3c2f74643e0a3c2f74723e0a3c74723e0a3c74643e266e6273703b3c2f74643e0a3c2f74723e0a3c74723e0a3c7468207374796c653d22636f6c6f723a20233030303b2070616464696e673a2030707820323070783b20666f6e742d66616d696c793a204f70656e2053616e732c20417269616c2c2048656c7665746963612c2073616e732d73657269663b20666f6e742d73697a653a20313370783b2220616c69676e3d2263656e746572223e486f737420416363657074656420796f7572207265736572766174696f6e207265717565737420666f72207b2470726f70657274796e616d657d2e506c65617365206d616b6520796f7572207061796d656e74206174203c6120687265663d227b626173655f75726c28297d74726970732f7570636f6d696e67223e266e6273703b796f757220747269702064617368626f6172643c2f613e20696e2052656e74657220776562736974652e20456e6a6f7920796f757220686f6c696461792e3c2f74683e0a3c2f74723e0a3c74723e0a3c74643e266e6273703b3c2f74643e0a3c2f74723e0a3c74723e0a3c7464206865696768743d223330223e266e6273703b3c2f74643e0a3c2f74723e0a3c74723e0a3c7464207374796c653d2270616464696e673a2030707820323070783b20636f6c6f723a20233434343434343b20666f6e742d66616d696c793a204f70656e2053616e732c20417269616c2c2048656c7665746963612c2073616e732d73657269663b20666f6e742d73697a653a20313370783b2220616c69676e3d226c656674222076616c69676e3d226d6964646c65223e0a3c703e5468616e6b73213c2f703e0a3c703e5468652052656e746572205465616d3c2f703e0a3c2f74643e0a3c2f74723e0a3c74723e0a3c7464206865696768743d223330223e266e6273703b3c2f74643e0a3c2f74723e0a3c74723e0a3c7464206865696768743d22333022206267636f6c6f723d2223346635393562223e266e6273703b3c2f74643e0a3c2f74723e0a3c74723e0a3c746420616c69676e3d2263656e74657222206267636f6c6f723d2223346635393562223e266e6273703b3c2f74643e0a3c2f74723e0a3c74723e0a3c7464206865696768743d22353022206267636f6c6f723d2223346635393562223e266e6273703b3c2f74643e0a3c2f74723e0a3c2f74626f64793e0a3c2f7461626c653e0a3c2f74643e0a3c2f74723e0a3c2f74626f64793e0a3c2f7461626c653e, 'Active', '2016-05-31 01:33:12', '', 'Your reservation has been approved', 'Renters', 'rentersteam@teamtweaks.com', '', '1'),
(24, 'Host Decline Reservation', 0x3c7461626c6520636c6173733d2275692d736f727461626c652d68616e646c652063757272656e745461626c652220626f726465723d2230222063656c6c73706163696e673d2230222063656c6c70616464696e673d2230222077696474683d22313030252220616c69676e3d2263656e74657222206267636f6c6f723d2223346635393562223e0a3c74626f64793e0a3c74723e0a3c74643e0a3c7461626c6520636c6173733d22646576696365776964746822207374796c653d226261636b67726f756e642d636f6c6f723a20236638663866383b2220626f726465723d2230222063656c6c73706163696e673d2230222063656c6c70616464696e673d2230222077696474683d223630302220616c69676e3d2263656e746572223e0a3c74626f64793e0a3c74723e0a3c7464206865696768743d22333022206267636f6c6f723d2223346635393562223e266e6273703b20266e6273703b20266e6273703b20266e6273703b20266e6273703b3c2f74643e0a3c2f74723e0a3c74723e0a3c746420616c69676e3d226c65667422206267636f6c6f723d2223346635393562223e3c696d67207372633d227b626173655f75726c28297d696d616765732f6c6f676f2f7b246c6f676f7d2220616c743d226c6f676f222077696474683d2232303022202f3e3c2f74643e0a3c2f74723e0a3c74723e0a3c7464206865696768743d22333022206267636f6c6f723d2223346635393562223e266e6273703b3c2f74643e0a3c2f74723e0a3c74723e0a3c746420636c6173733d226564697461626c6522207374796c653d22636f6c6f723a20236666666666663b20666f6e742d66616d696c793a204f70656e2053616e732c20417269616c2c2048656c7665746963612c2073616e732d73657269663b20666f6e742d73697a653a20313870783b20666f6e742d7765696768743a20626f6c643b20746578742d7472616e73666f726d3a207570706572636173653b2070616464696e673a2038707820323070783b206261636b67726f756e642d636f6c6f723a20233462626566663b2220616c69676e3d2263656e746572222076616c69676e3d226d6964646c65223e4869207b2474726176656c65726e616d657d2c3c2f74643e0a3c2f74723e0a3c74723e0a3c7464206865696768743d223330223e266e6273703b3c2f74643e0a3c2f74723e0a3c74723e0a3c74643e266e6273703b3c2f74643e0a3c2f74723e0a3c74723e0a3c7468207374796c653d22636f6c6f723a20233030303b2070616464696e673a2030707820323070783b20666f6e742d66616d696c793a204f70656e2053616e732c20417269616c2c2048656c7665746963612c2073616e732d73657269663b20666f6e742d73697a653a20313370783b2220616c69676e3d2263656e746572223e3c7370616e3e54686520683c2f7370616e3e6f7374203c7370616e3e7b24686f73746e616d657d266e6273703b3c2f7370616e3e68617665206465636c696e656420796f7572207265736572766174696f6e20666f72266e6273703b3c7370616e3e7b2470726f70657274796e616d657d3c2f7370616e3e2e204b696e646c792066696e6420616c7465726e6174697665206163636f6d6f646174696f6e206174203c6120687265663d227b626173655f75726c28297d223e7b626173655f75726c28297d3c2f613e2e205765206c6f6f6b20666f727761726420666f7220796f7572206e65787420626f6f6b696e672e266e6273703b3c2f74683e0a3c2f74723e0a3c74723e0a3c74643e266e6273703b3c2f74643e0a3c2f74723e0a3c74723e0a3c7464206865696768743d223330223e266e6273703b3c2f74643e0a3c2f74723e0a3c74723e0a3c7464207374796c653d2270616464696e673a2030707820323070783b20636f6c6f723a20233434343434343b20666f6e742d66616d696c793a204f70656e2053616e732c20417269616c2c2048656c7665746963612c2073616e732d73657269663b20666f6e742d73697a653a20313370783b2220616c69676e3d226c656674222076616c69676e3d226d6964646c65223e0a3c703e5468616e6b73213c2f703e0a3c703e5468652052656e74657220205465616d3c2f703e0a3c2f74643e0a3c2f74723e0a3c74723e0a3c7464206865696768743d223330223e266e6273703b3c2f74643e0a3c2f74723e0a3c74723e0a3c7464206865696768743d22333022206267636f6c6f723d2223346635393562223e266e6273703b3c2f74643e0a3c2f74723e0a3c74723e0a3c746420616c69676e3d2263656e74657222206267636f6c6f723d2223346635393562223e266e6273703b3c2f74643e0a3c2f74723e0a3c74723e0a3c7464206865696768743d22353022206267636f6c6f723d2223346635393562223e266e6273703b3c2f74643e0a3c2f74723e0a3c2f74626f64793e0a3c2f7461626c653e0a3c2f74643e0a3c2f74723e0a3c2f74626f64793e0a3c2f7461626c653e, 'Active', '2016-08-09 12:00:48', '', 'Reservation request rejected', 'Renters', 'rentersteam@teamtweaks.com', '', '1'),
(25, 'Host decline the request', 0x3c7461626c6520636c6173733d2275692d736f727461626c652d68616e646c652063757272656e745461626c652220626f726465723d2230222063656c6c73706163696e673d2230222063656c6c70616464696e673d2230222077696474683d22313030252220616c69676e3d2263656e74657222206267636f6c6f723d2223346635393562223e0a3c74626f64793e0a3c74723e0a3c74643e0a3c7461626c6520636c6173733d22646576696365776964746822207374796c653d226261636b67726f756e642d636f6c6f723a20236638663866383b2220626f726465723d2230222063656c6c73706163696e673d2230222063656c6c70616464696e673d2230222077696474683d223630302220616c69676e3d2263656e746572223e0a3c74626f64793e0a3c74723e0a3c7464206865696768743d22333022206267636f6c6f723d2223346635393562223e266e6273703b3c2f74643e0a3c2f74723e0a3c74723e0a3c746420616c69676e3d226c65667422206267636f6c6f723d2223346635393562223e3c696d67207372633d227b626173655f75726c28297d696d616765732f6c6f676f2f7b246c6f676f7d2220616c743d226c6f676f22202f3e266e6273703b20266e6273703b3c2f74643e0a3c2f74723e0a3c74723e0a3c7464206865696768743d22333022206267636f6c6f723d2223346635393562223e266e6273703b3c2f74643e0a3c2f74723e0a3c74723e0a3c746420636c6173733d226564697461626c6522207374796c653d22636f6c6f723a20236666666666663b20666f6e742d66616d696c793a204f70656e2053616e732c20417269616c2c2048656c7665746963612c2073616e732d73657269663b20666f6e742d73697a653a20313870783b20666f6e742d7765696768743a20626f6c643b20746578742d7472616e73666f726d3a207570706572636173653b2070616464696e673a2038707820323070783b206261636b67726f756e642d636f6c6f723a20233462626566663b2220616c69676e3d2263656e746572222076616c69676e3d226d6964646c65223e4869207b24686f73746e616d657d2c3c2f74643e0a3c2f74723e0a3c74723e0a3c7464206865696768743d223330223e266e6273703b3c2f74643e0a3c2f74723e0a3c74723e0a3c7468207374796c653d22636f6c6f723a20233030303b2070616464696e673a2030707820323070783b20666f6e742d66616d696c793a204f70656e2053616e732c20417269616c2c2048656c7665746963612c2073616e732d73657269663b20666f6e742d73697a653a20313370783b2220616c69676e3d2263656e746572223e596f75722068617665206465636c696e6564207b2474726176656c65726e616d657d2773203c7370616e3e7265736572766174696f6e20726571756573743c2f7370616e3e266e6273703b666f72207b2470726f70657274796e616d657d2e203c2f74683e0a3c2f74723e0a3c74723e0a3c74643e266e6273703b3c2f74643e0a3c2f74723e0a3c74723e0a3c7464207374796c653d22636f6c6f723a20233030303b2070616464696e673a2030707820323070783b20666f6e742d66616d696c793a204f70656e2053616e732c20417269616c2c2048656c7665746963612c2073616e732d73657269663b20666f6e742d73697a653a20313370783b2220616c69676e3d226c656674223e3c6272202f3e3c2f74643e0a3c2f74723e0a3c74723e0a3c7464206865696768743d223330223e266e6273703b3c2f74643e0a3c2f74723e0a3c74723e0a3c7464207374796c653d2270616464696e673a2030707820323070783b20636f6c6f723a20233434343434343b20666f6e742d66616d696c793a204f70656e2053616e732c20417269616c2c2048656c7665746963612c2073616e732d73657269663b20666f6e742d73697a653a20313370783b2220616c69676e3d226c656674222076616c69676e3d226d6964646c65223e0a3c703e5468616e6b73213c2f703e0a3c703e5468652052656e746572205465616d3c2f703e0a3c2f74643e0a3c2f74723e0a3c74723e0a3c7464206865696768743d223330223e266e6273703b3c2f74643e0a3c2f74723e0a3c74723e0a3c7464206865696768743d22333022206267636f6c6f723d2223346635393562223e266e6273703b3c2f74643e0a3c2f74723e0a3c74723e0a3c746420616c69676e3d2263656e74657222206267636f6c6f723d2223346635393562223e266e6273703b3c2f74643e0a3c2f74723e0a3c74723e0a3c7464206865696768743d22353022206267636f6c6f723d2223346635393562223e266e6273703b3c2f74643e0a3c2f74723e0a3c2f74626f64793e0a3c2f7461626c653e0a3c2f74643e0a3c2f74723e0a3c2f74626f64793e0a3c2f7461626c653e, 'Active', '2016-08-09 12:03:52', '', 'Host decline the request', 'Renters', 'rentersteam@teamtweaks.com', '', '1'),
(56, 'Booking Declined by other booking', 0x3c7461626c6520636c6173733d2275692d736f727461626c652d68616e646c652063757272656e745461626c652220626f726465723d2230222077696474683d2231303025222063656c6c73706163696e673d2230222063656c6c70616464696e673d22302220616c69676e3d2263656e74657222206267636f6c6f723d2223346635393562223e0a3c74626f64793e0a3c74723e0a3c74643e0a3c7461626c6520636c6173733d22646576696365776964746822207374796c653d226261636b67726f756e642d636f6c6f723a20236638663866383b2220626f726465723d2230222077696474683d22363030222063656c6c73706163696e673d2230222063656c6c70616464696e673d22302220616c69676e3d2263656e746572223e0a3c74626f64793e0a3c7472207374796c653d226865696768743a20333070783b223e0a3c7464207374796c653d226865696768743a20333070783b22206267636f6c6f723d2223346635393562223e266e6273703b3c2f74643e0a3c2f74723e0a3c7472207374796c653d226865696768743a20353470783b223e0a3c7464207374796c653d226865696768743a20353470783b2220616c69676e3d226c65667422206267636f6c6f723d2223346635393562223e3c696d67207372633d227b626173655f75726c28297d696d616765732f6c6f676f2f7b246c6f676f7d2220616c743d226c6f676f22202f3e266e6273703b20266e6273703b3c2f74643e0a3c2f74723e0a3c7472207374796c653d226865696768743a20333070783b223e0a3c7464207374796c653d226865696768743a20333070783b22206267636f6c6f723d2223346635393562223e266e6273703b3c2f74643e0a3c2f74723e0a3c7472207374796c653d226865696768743a20333770783b223e0a3c746420636c6173733d226564697461626c6522207374796c653d22636f6c6f723a20236666666666663b20666f6e742d66616d696c793a20274f70656e2053616e73272c20417269616c2c2048656c7665746963612c2073616e732d73657269663b20666f6e742d73697a653a20313870783b20666f6e742d7765696768743a20626f6c643b20746578742d7472616e73666f726d3a207570706572636173653b2070616464696e673a2038707820323070783b206865696768743a20333770783b206261636b67726f756e642d636f6c6f723a20233462626566663b2220616c69676e3d2263656e746572222076616c69676e3d226d6964646c65223e4869207b24757365726e616d657d2c3c2f74643e0a3c2f74723e0a3c7472207374796c653d226865696768743a20333070783b223e0a3c7464207374796c653d226865696768743a20333070783b223e266e6273703b3c2f74643e0a3c2f74723e0a3c7472207374796c653d226865696768743a20333070783b223e0a3c7468207374796c653d22636f6c6f723a20233030303030303b2070616464696e673a2030707820323070783b20666f6e742d66616d696c793a20274f70656e2053616e73272c20417269616c2c2048656c7665746963612c2073616e732d73657269663b20666f6e742d73697a653a20313370783b206865696768743a20333070783b2220616c69676e3d2263656e746572223e536f7272792c20596f7572207265736572766174696f6e2072657175657374207b24426f6f6b696e676e6f7d20666f72207b2470726f647563745f7469746c657d207761732064656e69656420627920636f6e6669726d696e6720746865206f7468657220626f6f6b696e67206f6e207468652073616d6520646174652e3c2f74683e0a3c2f74723e0a3c7472207374796c653d226865696768743a20343770783b223e0a3c7464207374796c653d226865696768743a20343770783b223e266e6273703b3c2f74643e0a3c2f74723e0a3c7472207374796c653d226865696768743a20313570783b223e0a3c7464207374796c653d22636f6c6f723a20233030303030303b2070616464696e673a2030707820323070783b20666f6e742d66616d696c793a20274f70656e2053616e73272c20417269616c2c2048656c7665746963612c2073616e732d73657269663b20666f6e742d73697a653a20313370783b206865696768743a20313570783b2220616c69676e3d2263656e746572223e4b696e6c647920676f207769746820616e6f74686572206461746573206f6e207468652073616d652070726f70657274792e3c2f74643e0a3c2f74723e0a3c7472207374796c653d226865696768743a20333070783b223e0a3c7464207374796c653d226865696768743a20333070783b223e266e6273703b3c2f74643e0a3c2f74723e0a3c7472207374796c653d226865696768743a2031303570783b223e0a3c7464207374796c653d2270616464696e673a2030707820323070783b20636f6c6f723a20233434343434343b20666f6e742d66616d696c793a20274f70656e2053616e73272c20417269616c2c2048656c7665746963612c2073616e732d73657269663b20666f6e742d73697a653a20313370783b206865696768743a2031303570783b2220616c69676e3d226c656674222076616c69676e3d226d6964646c65223e0a3c703e5468616e6b73213c2f703e0a3c703e5468652052656e746572205465616d3c2f703e0a3c2f74643e0a3c2f74723e0a3c7472207374796c653d226865696768743a20333070783b223e0a3c7464207374796c653d226865696768743a20333070783b223e266e6273703b3c2f74643e0a3c2f74723e0a3c7472207374796c653d226865696768743a20333070783b223e0a3c7464207374796c653d226865696768743a20333070783b22206267636f6c6f723d2223346635393562223e266e6273703b3c2f74643e0a3c2f74723e0a3c7472207374796c653d226865696768743a20343770783b223e0a3c7464207374796c653d226865696768743a20343770783b2220616c69676e3d2263656e74657222206267636f6c6f723d2223346635393562223e266e6273703b3c2f74643e0a3c2f74723e0a3c7472207374796c653d226865696768743a20353070783b223e0a3c7464207374796c653d226865696768743a20353070783b22206267636f6c6f723d2223346635393562223e266e6273703b3c2f74643e0a3c2f74723e0a3c2f74626f64793e0a3c2f7461626c653e0a3c2f74643e0a3c2f74723e0a3c2f74626f64793e0a3c2f7461626c653e, 'Active', '2016-08-31 06:36:22', '', 'Booking Declined', '', '', '', '1'),
(27, 'Listing Payment Success  By Admin', 0x3c7461626c6520636c6173733d2275692d736f727461626c652d68616e646c652063757272656e745461626c652220626f726465723d2230222077696474683d2231303025222063656c6c73706163696e673d2230222063656c6c70616464696e673d22302220616c69676e3d2263656e74657222206267636f6c6f723d2223346635393562223e0a3c74626f64793e0a3c74723e0a3c74643e0a3c7461626c6520636c6173733d22646576696365776964746822207374796c653d226261636b67726f756e642d636f6c6f723a20236638663866383b2220626f726465723d2230222077696474683d22363030222063656c6c73706163696e673d2230222063656c6c70616464696e673d22302220616c69676e3d2263656e746572223e0a3c74626f64793e0a3c7472207374796c653d226865696768743a20333070783b223e0a3c7464207374796c653d226865696768743a20333070783b22206267636f6c6f723d2223346635393562223e266e6273703b3c2f74643e0a3c2f74723e0a3c7472207374796c653d226865696768743a20353470783b223e0a3c7464207374796c653d226865696768743a20353470783b2220616c69676e3d226c65667422206267636f6c6f723d2223346635393562223e3c696d67207372633d227b626173655f75726c28297d696d616765732f6c6f676f2f7b246c6f676f7d2220616c743d226c6f676f22202f3e266e6273703b20266e6273703b20266e6273703b20266e6273703b20266e6273703b266e6273703b3c2f74643e0a3c2f74723e0a3c7472207374796c653d226865696768743a20333070783b223e0a3c7464207374796c653d226865696768743a20333070783b22206267636f6c6f723d2223346635393562223e266e6273703b20266e6273703b20266e6273703b266e6273703b3c2f74643e0a3c2f74723e0a3c7472207374796c653d226865696768743a20333770783b223e0a3c746420636c6173733d226564697461626c6522207374796c653d22636f6c6f723a20236666666666663b20666f6e742d66616d696c793a20274f70656e2053616e73272c20417269616c2c2048656c7665746963612c2073616e732d73657269663b20666f6e742d73697a653a20313870783b20666f6e742d7765696768743a20626f6c643b20746578742d7472616e73666f726d3a207570706572636173653b2070616464696e673a2038707820323070783b206865696768743a20333770783b206261636b67726f756e642d636f6c6f723a20233462626566663b2220616c69676e3d2263656e746572222076616c69676e3d226d6964646c65223e48692041646d696e2c3c2f74643e0a3c2f74723e0a3c7472207374796c653d226865696768743a20333070783b223e0a3c7464207374796c653d226865696768743a20333070783b223e266e6273703b3c2f74643e0a3c2f74723e0a3c7472207374796c653d226865696768743a20343770783b223e0a3c7464207374796c653d226865696768743a20343770783b223e266e6273703b3c2f74643e0a3c2f74723e0a3c7472207374796c653d226865696768743a20313570783b223e0a3c7468207374796c653d22636f6c6f723a20233030303030303b2070616464696e673a2030707820323070783b20666f6e742d66616d696c793a20274f70656e2053616e73272c20417269616c2c2048656c7665746963612c2073616e732d73657269663b20666f6e742d73697a653a20313370783b206865696768743a20313570783b2220616c69676e3d2263656e746572223e7b24686f73746e616d657d2068617665207061696420555344207b24616d6f756e747d2c20666f72207468652070726f7065727479207b247072646e616d657d2e3c2f74683e0a3c2f74723e0a3c7472207374796c653d226865696768743a20343770783b223e0a3c7464207374796c653d226865696768743a20343770783b223e266e6273703b3c2f74643e0a3c2f74723e0a3c7472207374796c653d226865696768743a20333070783b223e0a3c7464207374796c653d226865696768743a20333070783b223e266e6273703b3c2f74643e0a3c2f74723e0a3c7472207374796c653d226865696768743a2031303570783b223e0a3c7464207374796c653d2270616464696e673a2030707820323070783b20636f6c6f723a20233434343434343b20666f6e742d66616d696c793a20274f70656e2053616e73272c20417269616c2c2048656c7665746963612c2073616e732d73657269663b20666f6e742d73697a653a20313370783b206865696768743a2031303570783b2220616c69676e3d226c656674222076616c69676e3d226d6964646c65223e0a3c703e5468616e6b73213c2f703e0a3c703e5468652052656e746572205465616d3c2f703e0a3c2f74643e0a3c2f74723e0a3c7472207374796c653d226865696768743a20333070783b223e0a3c7464207374796c653d226865696768743a20333070783b223e266e6273703b3c2f74643e0a3c2f74723e0a3c7472207374796c653d226865696768743a20333070783b223e0a3c7464207374796c653d226865696768743a20333070783b22206267636f6c6f723d2223346635393562223e266e6273703b3c2f74643e0a3c2f74723e0a3c7472207374796c653d226865696768743a20343770783b223e0a3c7464207374796c653d226865696768743a20343770783b2220616c69676e3d2263656e74657222206267636f6c6f723d2223346635393562223e266e6273703b3c2f74643e0a3c2f74723e0a3c7472207374796c653d226865696768743a20353070783b223e0a3c7464207374796c653d226865696768743a20353070783b22206267636f6c6f723d2223346635393562223e266e6273703b3c2f74643e0a3c2f74723e0a3c2f74626f64793e0a3c2f7461626c653e0a3c2f74643e0a3c2f74723e0a3c2f74626f64793e0a3c2f7461626c653e, 'Active', '2016-08-31 04:15:36', '', 'Listing Payment Success  By Admin', 'Renters', 'smithwilliam3592@gmail.com', '', '1'),
(28, 'Contact Us - Reply', 0x3c7461626c6520636c6173733d2275692d736f727461626c652d68616e646c652063757272656e745461626c652220626f726465723d2230222063656c6c73706163696e673d2230222063656c6c70616464696e673d2230222077696474683d22313030252220616c69676e3d2263656e74657222206267636f6c6f723d2223346635393562223e0a3c74626f64793e0a3c74723e0a3c74643e0a3c7461626c6520636c6173733d22646576696365776964746822207374796c653d226261636b67726f756e642d636f6c6f723a20236638663866383b2220626f726465723d2230222063656c6c73706163696e673d2230222063656c6c70616464696e673d2230222077696474683d223630302220616c69676e3d2263656e746572223e0a3c74626f64793e0a3c74723e0a3c7464206865696768743d22333022206267636f6c6f723d2223346635393562223e266e6273703b3c2f74643e0a3c2f74723e0a3c74723e0a3c746420616c69676e3d226c65667422206267636f6c6f723d2223346635393562223e3c696d67207372633d227b626173655f75726c28297d696d616765732f6c6f676f2f7b246c6f676f7d2220616c743d226c6f676f22202f3e3c2f74643e0a3c2f74723e0a3c74723e0a3c7464206865696768743d22333022206267636f6c6f723d2223346635393562223e266e6273703b3c2f74643e0a3c2f74723e0a3c74723e0a3c74643e3c7370616e3e266e6273703b20266e6273703b20266e6273703b2048693c2f7370616e3e3c6c6162656c3e7b24757365726e616d657d3c2f6c6162656c3e3c2f74643e0a3c2f74723e0a3c74723e0a3c7468207374796c653d22636f6c6f723a20233030303b2070616464696e673a2030707820323070783b20666f6e742d66616d696c793a204f70656e2053616e732c20417269616c2c2048656c7665746963612c2073616e732d73657269663b20666f6e742d73697a653a20313370783b2220616c69676e3d2263656e746572223e207b24626f64795f6d6573736167657d203c2f74683e0a3c2f74723e0a3c74723e0a3c74643e266e6273703b20266e6273703b20266e6273703b266e6273703b3c2f74643e0a3c2f74723e0a3c74723e0a3c7464206865696768743d223330223e266e6273703b3c2f74643e0a3c2f74723e0a3c74723e0a3c7464207374796c653d2270616464696e673a2030707820323070783b20636f6c6f723a20233434343434343b20666f6e742d66616d696c793a204f70656e2053616e732c20417269616c2c2048656c7665746963612c2073616e732d73657269663b20666f6e742d73697a653a20313370783b2220616c69676e3d226c656674222076616c69676e3d226d6964646c65223e0a3c703e5468616e6b73213c2f703e0a3c703e5468652052656e74657273205465616d20266e6273703b3c2f703e0a3c2f74643e0a3c2f74723e0a3c74723e0a3c7464206865696768743d22333022206267636f6c6f723d2223346635393562223e266e6273703b3c2f74643e0a3c2f74723e0a3c74723e0a3c746420616c69676e3d2263656e74657222206267636f6c6f723d2223346635393562223e266e6273703b3c2f74643e0a3c2f74723e0a3c74723e0a3c7464206865696768743d22353022206267636f6c6f723d2223346635393562223e266e6273703b3c2f74643e0a3c2f74723e0a3c2f74626f64793e0a3c2f7461626c653e0a3c2f74643e0a3c2f74723e0a3c2f74626f64793e0a3c2f7461626c653e, 'Active', '2016-05-31 01:30:07', '', 'Contact Us - Replys', 'Renters', 'rentersteam@teamtweaks.com', '', '1'),
(31, 'Listing Email Admin', 0x3c7461626c6520636c6173733d2275692d736f727461626c652d68616e646c652063757272656e745461626c652220626f726465723d2230222063656c6c73706163696e673d2230222063656c6c70616464696e673d2230222077696474683d22313030252220616c69676e3d2263656e74657222206267636f6c6f723d2223346635393562223e0a3c74626f64793e0a3c74723e0a3c74643e0a3c7461626c6520636c6173733d22646576696365776964746822207374796c653d226261636b67726f756e642d636f6c6f723a20236638663866383b2220626f726465723d2230222063656c6c73706163696e673d2230222063656c6c70616464696e673d2230222077696474683d223630302220616c69676e3d2263656e746572223e0a3c74626f64793e0a3c74723e0a3c7464206865696768743d22333022206267636f6c6f723d2223346635393562223e266e6273703b20266e6273703b266e6273703b3c2f74643e0a3c2f74723e0a3c74723e0a3c746420616c69676e3d226c65667422206267636f6c6f723d2223346635393562223e3c696d67207372633d227b626173655f75726c28297d696d616765732f6c6f676f2f7b246c6f676f7d2220616c743d226c6f676f222077696474683d2232303022202f3e3c2f74643e0a3c2f74723e0a3c74723e0a3c7464206865696768743d22333022206267636f6c6f723d2223346635393562223e266e6273703b3c2f74643e0a3c2f74723e0a3c74723e0a3c746420636c6173733d226564697461626c6522207374796c653d22636f6c6f723a20236666666666663b20666f6e742d66616d696c793a204f70656e2053616e732c20417269616c2c2048656c7665746963612c2073616e732d73657269663b20666f6e742d73697a653a20313870783b20666f6e742d7765696768743a20626f6c643b20746578742d7472616e73666f726d3a207570706572636173653b2070616464696e673a2038707820323070783b206261636b67726f756e642d636f6c6f723a20233462626566663b2220616c69676e3d2263656e746572222076616c69676e3d226d6964646c65223e48692041646d696e2c3c2f74643e0a3c2f74723e0a3c74723e0a3c7464206865696768743d223330223e266e6273703b3c2f74643e0a3c2f74723e0a3c74723e0a3c7468207374796c653d22636f6c6f723a20233030303b2070616464696e673a2030707820323070783b20666f6e742d66616d696c793a204f70656e2053616e732c20417269616c2c2048656c7665746963612c2073616e732d73657269663b20666f6e742d73697a653a20313370783b2220616c69676e3d2263656e746572223e207b2474726176656c65726e616d657d2068617665206372656174656420746865206e6577206c6973742e203c2f74683e0a3c2f74723e0a3c74723e0a3c74643e266e6273703b3c2f74643e0a3c2f74723e0a3c74723e0a3c7464207374796c653d22636f6c6f723a20233030303b2070616464696e673a2030707820323070783b20666f6e742d66616d696c793a204f70656e2053616e732c20417269616c2c2048656c7665746963612c2073616e732d73657269663b20666f6e742d73697a653a20313370783b2220616c69676e3d226c656674223e486f7374206e616d65203a207b2474726176656c65726e616d657d3c2f74643e0a3c2f74723e0a3c74723e0a3c74643e266e6273703b3c2f74643e0a3c2f74723e0a3c74723e0a3c7464207374796c653d22636f6c6f723a20233030303b2070616464696e673a2030707820323070783b20666f6e742d66616d696c793a204f70656e2053616e732c20417269616c2c2048656c7665746963612c2073616e732d73657269663b20666f6e742d73697a653a20313370783b2220616c69676e3d226c656674223e4c697374206e616d65203a207b2470726f70657274796e616d657d3c2f74643e0a3c2f74723e0a3c74723e0a3c74643e266e6273703b3c2f74643e0a3c2f74723e0a3c74723e0a3c7464207374796c653d22636f6c6f723a20233030303b2070616464696e673a2030707820323070783b20666f6e742d66616d696c793a204f70656e2053616e732c20417269616c2c2048656c7665746963612c2073616e732d73657269663b20666f6e742d73697a653a20313370783b2220616c69676e3d226c656674223e4c696e6b203a3c6120687265663d2220616972626e622e7a6f706c61792e636f6d2f72656e74616c2f7b2470726f706572747969647d223e203c2f613e3c6120687265663d227b626173655f75726c28297d72656e74616c2f7b2470726f706572747969647d223e7b626173655f75726c28297d72656e74616c2f7b2470726f706572747969647d3c2f613e3c2f74643e0a3c2f74723e0a3c74723e0a3c74643e266e6273703b3c2f74643e0a3c2f74723e0a3c74723e0a3c7464207374796c653d22636f6c6f723a20233030303b2070616464696e673a2030707820323070783b20666f6e742d66616d696c793a204f70656e2053616e732c20417269616c2c2048656c7665746963612c2073616e732d73657269663b20666f6e742d73697a653a20313370783b2220616c69676e3d226c656674223e5072696365203a203c7370616e3e7b2473796d626f6c7d3c2f7370616e3e207b2470726f706572747970726963657d3c2f74643e0a3c2f74723e0a3c74723e0a3c74643e266e6273703b3c2f74643e0a3c2f74723e0a3c74723e0a3c7464206865696768743d223330223e266e6273703b3c2f74643e0a3c2f74723e0a3c74723e0a3c7464207374796c653d2270616464696e673a2030707820323070783b20636f6c6f723a20233434343434343b20666f6e742d66616d696c793a204f70656e2053616e732c20417269616c2c2048656c7665746963612c2073616e732d73657269663b20666f6e742d73697a653a20313370783b2220616c69676e3d226c656674222076616c69676e3d226d6964646c65223e0a3c703e5468616e6b73213c2f703e0a3c703e5468652052656e74657273205465616d3c2f703e0a3c2f74643e0a3c2f74723e0a3c74723e0a3c7464206865696768743d223330223e266e6273703b3c2f74643e0a3c2f74723e0a3c74723e0a3c7464206865696768743d22333022206267636f6c6f723d2223346635393562223e266e6273703b3c2f74643e0a3c2f74723e0a3c74723e0a3c746420616c69676e3d2263656e74657222206267636f6c6f723d2223346635393562223e266e6273703b3c2f74643e0a3c2f74723e0a3c74723e0a3c7464206865696768743d22353022206267636f6c6f723d2223346635393562223e266e6273703b3c2f74643e0a3c2f74723e0a3c2f74626f64793e0a3c2f7461626c653e0a3c2f74643e0a3c2f74723e0a3c2f74626f64793e0a3c2f7461626c653e, 'Active', '2016-08-22 02:48:02', '', 'Listing Email Admin', 'Renters', 'smithwilliam3592@gmail.com', '', '1'),
(34, 'Notification Mail Host', 0x3c7461626c6520636c6173733d2275692d736f727461626c652d68616e646c652063757272656e745461626c652220626f726465723d2230222077696474683d2231303025222063656c6c73706163696e673d2230222063656c6c70616464696e673d22302220616c69676e3d2263656e74657222206267636f6c6f723d2223346635393562223e0a3c74626f64793e0a3c74723e0a3c74643e0a3c7461626c6520636c6173733d22646576696365776964746822207374796c653d226261636b67726f756e642d636f6c6f723a20236638663866383b2220626f726465723d2230222077696474683d22363030222063656c6c73706163696e673d2230222063656c6c70616464696e673d22302220616c69676e3d2263656e746572223e0a3c74626f64793e0a3c74723e0a3c7464206267636f6c6f723d222334663539356222206865696768743d223330223e266e6273703b3c2f74643e0a3c2f74723e0a3c74723e0a3c746420616c69676e3d226c65667422206267636f6c6f723d2223346635393562223e3c696d67207374796c653d226d617267696e3a20313570782035707820303b2070616464696e673a203070783b20626f726465723a206e6f6e653b22207372633d227b626173655f75726c28297d696d616765732f6c6f676f2f7b246c6f676f7d2220616c743d227b246d6574615f7469746c657d222077696474683d2232303022202f3e3c2f74643e0a3c2f74723e0a3c74723e0a3c7464206267636f6c6f723d222334663539356222206865696768743d223330223e266e6273703b3c2f74643e0a3c2f74723e0a3c74723e0a3c746420636c6173733d226564697461626c6522207374796c653d22636f6c6f723a20236666666666663b20666f6e742d66616d696c793a204f70656e2053616e732c20417269616c2c2048656c7665746963612c2073616e732d73657269663b20666f6e742d73697a653a20313870783b20666f6e742d7765696768743a20626f6c643b20746578742d7472616e73666f726d3a207570706572636173653b2070616464696e673a2038707820323070783b206261636b67726f756e642d636f6c6f723a20233462626566663b2220616c69676e3d2263656e746572222076616c69676e3d226d6964646c65223e4869207b2472656e7465725f666e616d657d207b2472656e7465725f6c6e616d657d3c2f74643e0a3c2f74723e0a3c74723e0a3c7464206865696768743d223530223e266e6273703b3c2f74643e0a3c2f74723e0a3c74723e0a3c7464207374796c653d22636f6c6f723a20233030303b2070616464696e673a2030707820323070783b20666f6e742d66616d696c793a204f70656e2053616e732c20417269616c2c2048656c7665746963612c2073616e732d73657269663b20666f6e742d73697a653a20313370783b2220616c69676e3d2263656e746572223e5765277265206578636974656420746f2074656c6c20796f7520746861742c20796f7572207b2472656e74616c5f6e616d657d20697320626f6f6b656420666f722074686520626f6f6b696e672023207b24626f6f6b696e674e6f7d2e20546f2068656c70206d616b6520636865636b2d696e207365616d6c6573732c207765207375676765737420796f7520636f6e74696e75652074686520636f6e766572736174696f6e207769746820796f7572206775657374207b2466697273745f6e616d657d207b246c6173745f6e616d657d3c2f74643e0a3c2f74723e0a3c74723e0a3c7464207374796c653d22636f6c6f723a20233030303b2070616464696e673a20313070782032307078203130707820323070783b20666f6e742d66616d696c793a204f70656e2053616e732c20417269616c2c2048656c7665746963612c2073616e732d73657269663b20666f6e742d73697a653a20313370783b2220616c69676e3d2263656e746572223e7468726f7567682052656e7465722773206d6573736167652073797374656d20746f20636f6e6669726d20796f7572206775657374206172726976616c2074696d652c2061736b20616e79207175657374696f6e7320796f75206d617920686176652c20616e642068656c70207468656d20666967757265206f757420686f7720746f20626573742067657420746f20796f7572206c697374696e672e3c2f74643e0a3c2f74723e0a3c74723e0a3c74643e266e6273703b3c2f74643e0a3c2f74723e0a3c74723e0a3c7464207374796c653d22636f6c6f723a20233030303b2070616464696e673a2030707820313070783b20666f6e742d7765696768743a20626f6c643b20666f6e742d66616d696c793a204f70656e2053616e732c20417269616c2c2048656c7665746963612c2073616e732d73657269663b20666f6e742d73697a653a20313370783b2220616c69676e3d2263656e746572222076616c69676e3d22746f70223e4974696e65726172793c2f74643e0a3c2f74723e0a3c74723e0a3c746420616c69676e3d2263656e746572222076616c69676e3d226d6964646c65223e0a3c646976207374796c653d226261636b67726f756e642d636f6c6f723a20236633343032653b20646973706c61793a207461626c653b20626f726465722d7261646975733a203570783b20636f6c6f723a20236666666666663b20666f6e742d66616d696c793a204f70656e2053616e732c20417269616c2c2073616e732d73657269663b20666f6e742d73697a653a20313370783b20746578742d7472616e73666f726d3a207570706572636173653b20666f6e742d7765696768743a20626f6c643b2070616464696e673a2037707820313270783b20746578742d616c69676e3a2063656e7465723b20746578742d6465636f726174696f6e3a206e6f6e653b2077696474683a2031343070783b206d617267696e3a206175746f3b223e3c61207374796c653d22636f6c6f723a20236666666666663b20746578742d6465636f726174696f6e3a206e6f6e653b2220687265663d227b626173655f75726c28297d72656e74616c2f7b247072645f69647d223e3c696d67207372633d227b2472656e74616c5f696d6167657d2220616c743d22222077696474683d2233303022202f3e207b2472656e74616c5f6e616d657d3c2f613e3c2f6469763e0a3c2f74643e0a3c2f74723e0a3c74723e0a3c746420616c69676e3d2263656e746572223e0a3c7461626c6520626f726465723d2230222077696474683d2231303025222063656c6c73706163696e673d2230222063656c6c70616464696e673d22302220616c69676e3d2263656e746572223e0a3c74626f64793e0a3c7472207374796c653d2270616464696e673a20313070783b20666c6f61743a206c6566743b223e0a3c746420616c69676e3d2263656e746572222076616c69676e3d22746f70223e0a3c7461626c6520626f726465723d2230222077696474683d22363030222063656c6c73706163696e673d2231222063656c6c70616464696e673d223522206267636f6c6f723d2223454145414541223e0a3c74626f6479207374796c653d22666f6e742d66616d696c793a204f70656e2053616e732c20417269616c2c2048656c7665746963612c2073616e732d73657269663b20666f6e742d73697a653a20313370783b223e0a3c74723e0a3c74682077696474683d223735223e54696d653c2f74683e0a3c74682077696474683d223735223e446174653c2f74683e0a3c2f74723e0a3c747220616c69676e3d2263656e746572223e0a3c7464206267636f6c6f723d2223464646464646223e4172726976653c2f74643e0a3c7464206267636f6c6f723d2223464646464646223e7b24636865636b696e7d3c2f74643e0a3c2f74723e0a3c747220616c69676e3d2263656e746572223e0a3c7464206267636f6c6f723d2223464646464646223e4465706172743c2f74643e0a3c7464206267636f6c6f723d2223464646464646223e7b24636865636b6f75747d3c2f74643e0a3c2f74723e0a3c2f74626f64793e0a3c2f7461626c653e0a3c2f74643e0a3c2f74723e0a3c2f74626f64793e0a3c2f7461626c653e0a3c2f74643e0a3c2f74723e0a3c74723e0a3c74643e266e6273703b3c2f74643e0a3c2f74723e0a3c74723e0a3c7464206865696768743d223330223e266e6273703b3c2f74643e0a3c2f74723e0a3c74723e0a3c7464207374796c653d22636f6c6f723a20233466353935623b20666f6e742d66616d696c793a204f70656e2053616e732c20417269616c2c2048656c7665746963612c2073616e732d73657269663b20666f6e742d73697a653a20313370783b206c696e652d6865696768743a20323070783b2070616464696e673a2030707820323070783b2220616c69676e3d226c656674222076616c69676e3d22746f70222077696474683d223330307078223e7b24736572766963657d0a3c7461626c65207374796c653d2277696474683a20313030253b20666f6e742d73697a653a20313370783b223e0a3c74626f64793e0a3c74723e0a3c7464207374796c653d22626f726465722d626f74746f6d3a2031707820736f6c696420236262623b223e666f727b246e6f6f666e69676874737d204e696768743c2f74643e0a3c7464207374796c653d22626f726465722d626f74746f6d3a2031707820736f6c696420236262623b223e266e6273703b3c2f74643e0a3c7464207374796c653d22626f726465722d626f74746f6d3a2031707820736f6c696420236262623b2070616464696e673a20357078203070783b223e7b2473796d626f6c7d266e6273703b7b24616d6f756e747d3c2f74643e0a3c2f74723e0a3c74723e0a3c7464207374796c653d22626f726465722d626f74746f6d3a2031707820736f6c696420236262623b2070616464696e673a2031307078203070783b223e53657276696365204665653c2f74643e0a3c7464207374796c653d22626f726465722d626f74746f6d3a2031707820736f6c696420236262623b2070616464696e673a2031307078203070783b223e266e6273703b3c2f74643e0a3c7464207374796c653d22626f726465722d626f74746f6d3a2031707820736f6c696420236262623b2070616464696e673a2031307078203070783b223e7b2473796d626f6c7d207b24736572766963654665657d3c2f74643e0a3c2f74723e0a3c74723e0a3c7464207374796c653d22626f726465722d626f74746f6d3a2031707820736f6c696420236262623b2070616464696e673a2031307078203070783b223e446973636f756e7420416d6f756e74282d293c2f74643e0a3c7464207374796c653d22626f726465722d626f74746f6d3a2031707820736f6c696420236262623b2070616464696e673a2031307078203070783b223e266e6273703b3c2f74643e0a3c7464207374796c653d22626f726465722d626f74746f6d3a2031707820736f6c696420236262623b2070616464696e673a2031307078203070783b223e7b2473796d626f6c7d207b24646973636f756e745f616d6f756e747d3c2f74643e0a3c2f74723e0a3c74723e0a3c7464207374796c653d22626f726465722d626f74746f6d3a2031707820736f6c696420236262623b2070616464696e673a2031307078203070783b223e546f74616c3c2f74643e0a3c7464207374796c653d22626f726465722d626f74746f6d3a2031707820736f6c696420236262623b2070616464696e673a2031307078203070783b223e266e6273703b3c2f74643e0a3c7464207374796c653d22626f726465722d626f74746f6d3a2031707820736f6c696420236262623b2070616464696e673a2031307078203070783b223e7b2473796d626f6c7d266e6273703b7b246e6574616d6f756e747d3c2f74643e0a3c2f74723e0a3c2f74626f64793e0a3c2f7461626c653e0a3c2f74643e0a3c2f74723e0a3c74723e0a3c7464206865696768743d223330223e266e6273703b3c2f74643e0a3c2f74723e0a3c74723e0a3c7464207374796c653d2270616464696e673a2030707820323070783b20636f6c6f723a20233434343434343b20666f6e742d66616d696c793a204f70656e2053616e732c20417269616c2c2048656c7665746963612c2073616e732d73657269663b20666f6e742d73697a653a20313370783b2220616c69676e3d226c656674222076616c69676e3d226d6964646c65223e0a3c703e5468616e6b73213c2f703e0a3c703e5468652052656e746572205465616d3c2f703e0a3c2f74643e0a3c2f74723e0a3c74723e0a3c7464206865696768743d223330223e266e6273703b3c2f74643e0a3c2f74723e0a3c74723e0a3c7464206267636f6c6f723d222334663539356222206865696768743d223330223e266e6273703b3c2f74643e0a3c2f74723e0a3c74723e0a3c746420616c69676e3d2263656e74657222206267636f6c6f723d2223346635393562223e266e6273703b3c2f74643e0a3c2f74723e0a3c74723e0a3c7464206267636f6c6f723d222334663539356222206865696768743d223530223e266e6273703b3c2f74643e0a3c2f74723e0a3c2f74626f64793e0a3c2f7461626c653e0a3c2f74643e0a3c2f74723e0a3c2f74626f64793e0a3c2f7461626c653e, 'Active', '2016-10-05 03:28:08', '', 'Reservation Confirmation', 'Renters', 'rentersteam@teamtweaks.com', '', '1');
INSERT INTO `fc_newsletter` (`id`, `news_title`, `news_descrip`, `status`, `dateAdded`, `news_image`, `news_subject`, `sender_name`, `sender_email`, `news_seourl`, `typeVal`) VALUES
(50, 'Host Special Offer', 0x3c7461626c6520636c6173733d2275692d736f727461626c652d68616e646c652063757272656e745461626c652220626f726465723d2230222077696474683d2231303025222063656c6c73706163696e673d2230222063656c6c70616464696e673d22302220616c69676e3d2263656e74657222206267636f6c6f723d2223346635393562223e0a3c74626f64793e0a3c74723e0a3c74643e0a3c7461626c6520636c6173733d22646576696365776964746822207374796c653d226261636b67726f756e642d636f6c6f723a20236638663866383b2220626f726465723d2230222077696474683d22363030222063656c6c73706163696e673d2230222063656c6c70616464696e673d22302220616c69676e3d2263656e746572223e0a3c74626f64793e0a3c7472207374796c653d226865696768743a20333070783b223e0a3c7464207374796c653d226865696768743a20333070783b22206267636f6c6f723d2223346635393562223e266e6273703b20266e6273703b20266e6273703b20266e6273703b20266e6273703b3c2f74643e0a3c2f74723e0a3c7472207374796c653d226865696768743a20353470783b223e0a3c7464207374796c653d226865696768743a20353470783b2220616c69676e3d226c65667422206267636f6c6f723d2223346635393562223e3c696d67207372633d227b626173655f75726c28297d696d616765732f6c6f676f2f7b246c6f676f7d2220616c743d226c6f676f222077696474683d2232303022202f3e3c2f74643e0a3c2f74723e0a3c7472207374796c653d226865696768743a20333070783b223e0a3c7464207374796c653d226865696768743a20333070783b22206267636f6c6f723d2223346635393562223e266e6273703b3c2f74643e0a3c2f74723e0a3c7472207374796c653d226865696768743a20333770783b223e0a3c746420636c6173733d226564697461626c6522207374796c653d22636f6c6f723a20236666666666663b20666f6e742d66616d696c793a20274f70656e2053616e73272c20417269616c2c2048656c7665746963612c2073616e732d73657269663b20666f6e742d73697a653a20313870783b20666f6e742d7765696768743a20626f6c643b20746578742d7472616e73666f726d3a207570706572636173653b2070616464696e673a2038707820323070783b206865696768743a20333770783b206261636b67726f756e642d636f6c6f723a20233462626566663b2220616c69676e3d2263656e746572222076616c69676e3d226d6964646c65223e4869207b24757365726e616d657d2c3c2f74643e0a3c2f74723e0a3c7472207374796c653d226865696768743a20333070783b223e0a3c7464207374796c653d226865696768743a20333070783b223e266e6273703b3c2f74643e0a3c2f74723e0a3c7472207374796c653d226865696768743a20343770783b223e0a3c7464207374796c653d226865696768743a20343770783b223e266e6273703b3c2f74643e0a3c2f74723e0a3c7472207374796c653d226865696768743a20313570783b223e0a3c7468207374796c653d22636f6c6f723a20233030303030303b2070616464696e673a2030707820323070783b20666f6e742d66616d696c793a20274f70656e2053616e73272c20417269616c2c2048656c7665746963612c2073616e732d73657269663b20666f6e742d73697a653a20313370783b206865696768743a20313570783b2220616c69676e3d2263656e746572223e546865207b2470726f70657274796e616d657d20686f7374206861766520676976656e207370656369616c206f6666657220666f7220796f752c20676f20616e6420636865636b20746865207370656369616c206f6666657220696e20796f7572206d6573736167652e266e6273703b3c2f74683e0a3c2f74723e0a3c7472207374796c653d226865696768743a2034333770783b223e0a3c7464207374796c653d226865696768743a2034333770783b223e0a3c7461626c6520626f726465723d2230222077696474683d22363030222063656c6c73706163696e673d2231222063656c6c70616464696e673d223522206267636f6c6f723d2223454145414541223e0a3c74626f6479207374796c653d22666f6e742d66616d696c793a204f70656e2053616e732c20417269616c2c2048656c7665746963612c2073616e732d73657269663b20666f6e742d73697a653a20313370783b223e0a3c74723e0a3c74682077696474683d223735223e266e6273703b3c2f74683e0a3c74682077696474683d223735223e266e6273703b3c2f74683e0a3c2f74723e0a3c747220616c69676e3d2263656e746572223e0a3c7464206267636f6c6f723d2223464646464646223e426f6f6b696e67204e6f3c2f74643e0a3c7464206267636f6c6f723d2223464646464646223e7b24626f6f6b696e675f6e6f7d3c2f74643e0a3c2f74723e0a3c747220616c69676e3d2263656e746572223e0a3c7464206267636f6c6f723d2223464646464646223e526571756573742050726f70657274793c2f74643e0a3c7464206267636f6c6f723d2223464646464646223e7b24726571756573745f70726f70657274796e616d657d3c2f74643e0a3c2f74723e0a3c747220616c69676e3d2263656e746572223e0a3c7464206267636f6c6f723d2223464646464646223e5265717565737420436865636b696e3c2f74643e0a3c7464206267636f6c6f723d2223464646464646223e7b247265715f636865636b696e7d3c2f74643e0a3c2f74723e0a3c747220616c69676e3d2263656e746572223e0a3c7464206267636f6c6f723d2223464646464646223e5265717565737420436865636b6f75743c2f74643e0a3c7464206267636f6c6f723d2223464646464646223e7b247265715f636865636b6f75747d3c2f74643e0a3c2f74723e0a3c747220616c69676e3d2263656e746572223e0a3c7464206267636f6c6f723d2223464646464646223e5265717565737420416d6f756e743c2f74643e0a3c7464206267636f6c6f723d2223464646464646223e7b2463757272656e637953796d626f6c7d7b247265715f616d6f756e747d3c2f74643e0a3c2f74723e0a3c747220616c69676e3d2263656e746572223e0a3c7464206267636f6c6f723d2223464646464646223e4f666665722050726f70657274793c2f74643e0a3c7464206267636f6c6f723d2223464646464646223e7b2470726f70657274796e616d657d3c2f74643e0a3c2f74723e0a3c747220616c69676e3d2263656e746572223e0a3c7464206267636f6c6f723d2223464646464646223e4f6666657220436865636b696e3c2f74643e0a3c7464206267636f6c6f723d2223464646464646223e7b246f66665f636865636b696e7d3c2f74643e0a3c2f74723e0a3c747220616c69676e3d2263656e746572223e0a3c7464206267636f6c6f723d2223464646464646223e4f6666657220436865636b6f75743c2f74643e0a3c7464206267636f6c6f723d2223464646464646223e266e6273703b7b247265715f636865636b6f75747d3c2f74643e0a3c2f74723e0a3c747220616c69676e3d2263656e746572223e0a3c7464206267636f6c6f723d2223464646464646223e4f6666657220416d6f756e743c2f74643e0a3c7464206267636f6c6f723d2223464646464646223e7b2463757272656e637953796d626f6c7d207b246f66665f616d6f756e747d3c2f74643e0a3c2f74723e0a3c2f74626f64793e0a3c2f7461626c653e0a3c2f74643e0a3c2f74723e0a3c7472207374796c653d226865696768743a20333070783b223e0a3c7464207374796c653d226865696768743a20333070783b223e266e6273703b3c2f74643e0a3c2f74723e0a3c7472207374796c653d226865696768743a2031303570783b223e0a3c7464207374796c653d2270616464696e673a2030707820323070783b20636f6c6f723a20233434343434343b20666f6e742d66616d696c793a20274f70656e2053616e73272c20417269616c2c2048656c7665746963612c2073616e732d73657269663b20666f6e742d73697a653a20313370783b206865696768743a2031303570783b2220616c69676e3d226c656674222076616c69676e3d226d6964646c65223e0a3c703e5468616e6b73213c2f703e0a3c703e5468652052656e746572205465616d3c2f703e0a3c2f74643e0a3c2f74723e0a3c7472207374796c653d226865696768743a20333070783b223e0a3c7464207374796c653d226865696768743a20333070783b223e266e6273703b3c2f74643e0a3c2f74723e0a3c7472207374796c653d226865696768743a20333070783b223e0a3c7464207374796c653d226865696768743a20333070783b22206267636f6c6f723d2223346635393562223e266e6273703b3c2f74643e0a3c2f74723e0a3c7472207374796c653d226865696768743a20343770783b223e0a3c7464207374796c653d226865696768743a20343770783b2220616c69676e3d2263656e74657222206267636f6c6f723d2223346635393562223e266e6273703b3c2f74643e0a3c2f74723e0a3c7472207374796c653d226865696768743a20353070783b223e0a3c7464207374796c653d226865696768743a20353070783b22206267636f6c6f723d2223346635393562223e266e6273703b3c2f74643e0a3c2f74723e0a3c2f74626f64793e0a3c2f7461626c653e0a3c2f74643e0a3c2f74723e0a3c2f74626f64793e0a3c2f7461626c653e, 'Active', '2016-09-15 06:27:05', '', 'Special offer', 'Renters', ' smithwilliam3592@gmail.com', '', '1'),
(47, 'Membe login details', 0x3c7461626c6520636c6173733d2275692d736f727461626c652d68616e646c652063757272656e745461626c652220626f726465723d2230222063656c6c73706163696e673d2230222063656c6c70616464696e673d2230222077696474683d22313030252220616c69676e3d2263656e74657222206267636f6c6f723d2223346635393562223e0a3c74626f64793e0a3c74723e0a3c74643e0a3c7461626c6520636c6173733d22646576696365776964746822207374796c653d22626f726465723a2030707820736f6c696420236635666166623b2077696474683a2036303070783b206261636b67726f756e642d636f6c6f723a20236563666166643b2220626f726465723d2230222063656c6c73706163696e673d2230222063656c6c70616464696e673d22302220616c69676e3d2263656e746572223e0a3c74626f64793e0a3c74723e0a3c7464206865696768743d22333022206267636f6c6f723d2223346635393562223e266e6273703b3c2f74643e0a3c2f74723e0a3c74723e0a3c746420616c69676e3d226c65667422206267636f6c6f723d2223346635393562223e3c696d67207372633d227b626173655f75726c28297d696d616765732f6c6f676f2f7b246c6f676f7d2220616c743d226c6f676f22202f3e3c2f74643e0a3c2f74723e0a3c74723e0a3c7464206865696768743d22333022206267636f6c6f723d2223346635393562223e266e6273703b3c2f74643e0a3c2f74723e0a3c74723e0a3c746420636c6173733d226564697461626c652220616c69676e3d2263656e746572222076616c69676e3d226d6964646c65223e48492041444d494e3c2f74643e0a3c2f74723e0a3c74723e0a3c7464206865696768743d223330223e266e6273703b3c2f74643e0a3c2f74723e0a3c74723e0a3c746420616c69676e3d2263656e746572223e596f75206861766520637265617465642061206e6577206c697374696e67207769746820796f75722052656e74657273206163636f756e74206f6e207b2463646174657d206174207b246374696d657d2e3c2f74643e0a3c2f74723e0a3c74723e0a3c74643e266e6273703b3c2f74643e0a3c2f74723e0a3c74723e0a3c746420616c69676e3d226c656674223e4c697374206e616d65203a207b2470726f70657274796e616d657d3c2f74643e0a3c2f74723e0a3c74723e0a3c746420616c69676e3d226c656674223e4c696e6b203a203c6120687265663d227b626173655f75726c28297d72656e74616c2f7b2470726f706572747969647d223e7b626173655f75726c28297d72656e74616c2f7b2470726f706572747969647d3c2f613e3c2f74643e0a3c2f74723e0a3c74723e0a3c746420616c69676e3d226c656674223e5072696365203a20555344207b2470726963657d3c2f74643e0a3c2f74723e0a3c74723e0a3c74643e266e6273703b3c2f74643e0a3c2f74723e0a3c74723e0a3c74643e266e6273703b3c2f74643e0a3c2f74723e0a3c74723e0a3c746420616c69676e3d226c656674223e496620746869732077617320796f752c20796f752063616e2069676e6f7265207468697320656d61696c2e20266e6273703b3c2f74643e0a3c2f74723e0a3c74723e0a3c74643e266e6273703b3c2f74643e0a3c2f74723e0a3c74723e0a3c746420616c69676e3d226c656674223e49662074686973207761736e277420796f752c206c6574207573206b6e6f772e204e6f74696679696e6720757320697320696d706f7274616e7420626563617573652069742068656c7073207573206d616b652073757265206e6f206f6e6520697320616363657373696e6720796f7572206163636f756e7420776974686f757420796f7572206b6e6f776c656467652e3c2f74643e0a3c2f74723e0a3c74723e0a3c7464206865696768743d223330223e266e6273703b3c2f74643e0a3c2f74723e0a3c74723e0a3c746420616c69676e3d226c656674222076616c69676e3d226d6964646c65223e0a3c703e5468616e6b73213c2f703e0a3c703e5468652052656e74657273205465616d3c2f703e0a3c2f74643e0a3c2f74723e0a3c74723e0a3c7464206865696768743d223330223e266e6273703b3c2f74643e0a3c2f74723e0a3c74723e0a3c7464206865696768743d22333022206267636f6c6f723d2223346635393562223e266e6273703b3c2f74643e0a3c2f74723e0a3c74723e0a3c746420616c69676e3d2263656e74657222206267636f6c6f723d2223346635393562223e266e6273703b3c2f74643e0a3c2f74723e0a3c74723e0a3c7464206865696768743d22353022206267636f6c6f723d2223346635393562223e266e6273703b3c6272202f3e3c6272202f3e3c2f74643e0a3c2f74723e0a3c2f74626f64793e0a3c2f7461626c653e0a3c2f74643e0a3c2f74723e0a3c2f74626f64793e0a3c2f7461626c653e, 'Active', '2016-08-22 02:49:08', '', 'You added as Member in renters', 'Renters', 'smithwilliam3592@gmail.com', '', '1'),
(49, 'Host payment conformation', 0x3c7461626c6520636c6173733d2275692d736f727461626c652d68616e646c652063757272656e745461626c652220626f726465723d2230222063656c6c73706163696e673d2230222063656c6c70616464696e673d2230222077696474683d22313030252220616c69676e3d2263656e74657222206267636f6c6f723d2223346635393562223e0a3c74626f64793e0a3c74723e0a3c74643e0a3c7461626c6520636c6173733d22646576696365776964746822207374796c653d22626f726465723a2030707820736f6c696420236635666166623b2077696474683a2036303070783b206261636b67726f756e642d636f6c6f723a20236563666166643b2220626f726465723d2230222063656c6c73706163696e673d2230222063656c6c70616464696e673d22302220616c69676e3d2263656e746572223e0a3c74626f64793e0a3c74723e0a3c7464206865696768743d22333022206267636f6c6f723d2223346635393562223e266e6273703b3c2f74643e0a3c2f74723e0a3c74723e0a3c746420616c69676e3d226c65667422206267636f6c6f723d2223346635393562223e3c696d67207372633d227b626173655f75726c28297d696d616765732f6c6f676f2f7b246c6f676f7d2220616c743d226c6f676f22202f3e3c2f74643e0a3c2f74723e0a3c74723e0a3c7464206865696768743d22333022206267636f6c6f723d2223346635393562223e266e6273703b3c2f74643e0a3c2f74723e0a3c74723e0a3c746420636c6173733d226564697461626c652220616c69676e3d2263656e746572222076616c69676e3d226d6964646c65223e48492041444d494e3c2f74643e0a3c2f74723e0a3c74723e0a3c7464206865696768743d223330223e266e6273703b3c2f74643e0a3c2f74723e0a3c74723e0a3c746420616c69676e3d2263656e746572223e416e20686f73742068617320706169642074686520616d6f756e7420666f72207468652070726f70657274793c6272202f3e3c2f74643e0a3c2f74723e0a3c74723e0a3c74643e266e6273703b3c2f74643e0a3c2f74723e0a3c74723e0a3c746420616c69676e3d226c656674223e266e6273703b3c2f74643e0a3c2f74723e0a3c74723e0a3c746420616c69676e3d226c656674223e266e6273703b3c2f74643e0a3c2f74723e0a3c74723e0a3c746420616c69676e3d226c656674223e266e6273703b3c2f74643e0a3c2f74723e0a3c74723e0a3c74643e266e6273703b3c2f74643e0a3c2f74723e0a3c74723e0a3c74643e266e6273703b3c2f74643e0a3c2f74723e0a3c74723e0a3c746420616c69676e3d226c656674223e266e6273703b3c2f74643e0a3c2f74723e0a3c74723e0a3c74643e266e6273703b3c2f74643e0a3c2f74723e0a3c74723e0a3c746420616c69676e3d226c656674223e266e6273703b3c2f74643e0a3c2f74723e0a3c74723e0a3c7464206865696768743d223330223e266e6273703b3c2f74643e0a3c2f74723e0a3c74723e0a3c746420616c69676e3d226c656674222076616c69676e3d226d6964646c65223e0a3c703e5468616e6b73213c2f703e0a3c703e5468652052656e74657273205465616d3c2f703e0a3c2f74643e0a3c2f74723e0a3c74723e0a3c7464206865696768743d223330223e266e6273703b3c2f74643e0a3c2f74723e0a3c74723e0a3c7464206865696768743d22333022206267636f6c6f723d2223346635393562223e266e6273703b3c2f74643e0a3c2f74723e0a3c74723e0a3c746420616c69676e3d2263656e74657222206267636f6c6f723d2223346635393562223e266e6273703b3c2f74643e0a3c2f74723e0a3c74723e0a3c7464206865696768743d22353022206267636f6c6f723d2223346635393562223e266e6273703b3c6272202f3e3c6272202f3e3c2f74643e0a3c2f74723e0a3c2f74626f64793e0a3c2f7461626c653e0a3c2f74643e0a3c2f74723e0a3c2f74626f64793e0a3c2f7461626c653e, 'Active', '2016-06-07 12:21:19', '', 'Host payment conformation', 'Renters', 'rentersteam@teamtweaks.com', '', '1'),
(51, 'Approve property status', 0x3c7461626c6520636c6173733d2275692d736f727461626c652d68616e646c652063757272656e745461626c652220626f726465723d2230222063656c6c73706163696e673d2230222063656c6c70616464696e673d2230222077696474683d22313030252220616c69676e3d2263656e74657222206267636f6c6f723d2223346635393562223e0a3c74626f64793e0a3c74723e0a3c74643e0a3c7461626c6520636c6173733d22646576696365776964746822207374796c653d226261636b67726f756e642d636f6c6f723a20236638663866383b2220626f726465723d2230222063656c6c73706163696e673d2230222063656c6c70616464696e673d2230222077696474683d223630302220616c69676e3d2263656e746572223e0a3c74626f64793e0a3c74723e0a3c7464206865696768743d22333022206267636f6c6f723d2223346635393562223e266e6273703b3c2f74643e0a3c2f74723e0a3c74723e0a3c746420616c69676e3d226c65667422206267636f6c6f723d2223346635393562223e3c696d67207372633d227b626173655f75726c28297d696d616765732f6c6f676f2f7b246c6f676f7d2220616c743d226c6f676f22202f3e3c2f74643e0a3c2f74723e0a3c74723e0a3c7464206865696768743d22333022206267636f6c6f723d2223346635393562223e266e6273703b3c2f74643e0a3c2f74723e0a3c74723e0a3c746420636c6173733d226564697461626c6522207374796c653d22636f6c6f723a20236666666666663b20666f6e742d66616d696c793a204f70656e2053616e732c20417269616c2c2048656c7665746963612c2073616e732d73657269663b20666f6e742d73697a653a20313870783b20666f6e742d7765696768743a20626f6c643b20746578742d7472616e73666f726d3a207570706572636173653b2070616464696e673a2038707820323070783b206261636b67726f756e642d636f6c6f723a20233462626566663b2220616c69676e3d2263656e746572222076616c69676e3d226d6964646c65223e4869207b24686f73745f6e616d657d3c2f74643e0a3c2f74723e0a3c74723e0a3c7464206865696768743d223330223e266e6273703b3c2f74643e0a3c2f74723e0a3c74723e0a3c7464207374796c653d22636f6c6f723a20233030303b2070616464696e673a2030707820323070783b20666f6e742d66616d696c793a204f70656e2053616e732c20417269616c2c2048656c7665746963612c2073616e732d73657269663b20666f6e742d73697a653a20313370783b2220616c69676e3d2263656e746572223e4e6f772061646d696e2068617665206368616e67652074686520737461747573206f6620796f75722070726f706572747920746f207b247374617475737d2e20266e6273703b3c2f74643e0a3c2f74723e0a3c74723e0a3c74643e266e6273703b3c2f74643e0a3c2f74723e0a3c74723e0a3c7464207374796c653d22636f6c6f723a20233030303b2070616464696e673a2030707820323070783b20666f6e742d66616d696c793a204f70656e2053616e732c20417269616c2c2048656c7665746963612c2073616e732d73657269663b20666f6e742d73697a653a20313370783b2220616c69676e3d226c656674223e4c697374206e616d65203a207b2470726f70657274796e616d657d3c2f74643e0a3c2f74723e0a3c74723e0a3c74643e266e6273703b3c2f74643e0a3c2f74723e0a3c74723e0a3c74643e266e6273703b3c2f74643e0a3c2f74723e0a3c74723e0a3c7464207374796c653d22636f6c6f723a20233030303b2070616464696e673a2030707820323070783b20666f6e742d66616d696c793a204f70656e2053616e732c20417269616c2c2048656c7665746963612c2073616e732d73657269663b20666f6e742d73697a653a20313370783b2220616c69676e3d226c656674223e496620746869732077617320796f752c20796f752063616e2069676e6f7265207468697320656d61696c2e3c2f74643e0a3c2f74723e0a3c74723e0a3c74643e266e6273703b3c2f74643e0a3c2f74723e0a3c74723e0a3c7464207374796c653d22636f6c6f723a20233030303b2070616464696e673a2030707820323070783b20666f6e742d66616d696c793a204f70656e2053616e732c20417269616c2c2048656c7665746963612c2073616e732d73657269663b20666f6e742d73697a653a20313370783b2220616c69676e3d226c656674223e49662074686973207761736e277420796f752c206c6574207573206b6e6f772e204e6f74696679696e6720757320697320696d706f7274616e7420626563617573652069742068656c7073207573206d616b652073757265206e6f206f6e6520697320616363657373696e6720796f7572206163636f756e7420776974686f757420796f7572206b6e6f776c656467652e3c2f74643e0a3c2f74723e0a3c74723e0a3c7464206865696768743d223330223e266e6273703b3c2f74643e0a3c2f74723e0a3c74723e0a3c7464207374796c653d2270616464696e673a2030707820323070783b20636f6c6f723a20233434343434343b20666f6e742d66616d696c793a204f70656e2053616e732c20417269616c2c2048656c7665746963612c2073616e732d73657269663b20666f6e742d73697a653a20313370783b2220616c69676e3d226c656674222076616c69676e3d226d6964646c65223e0a3c703e5468616e6b73213c2f703e0a3c703e5468652052656e74657273205465616d3c2f703e0a3c2f74643e0a3c2f74723e0a3c74723e0a3c7464206865696768743d223330223e266e6273703b3c2f74643e0a3c2f74723e0a3c74723e0a3c7464206865696768743d22333022206267636f6c6f723d2223346635393562223e266e6273703b3c2f74643e0a3c2f74723e0a3c74723e0a3c746420616c69676e3d2263656e74657222206267636f6c6f723d2223346635393562223e266e6273703b3c2f74643e0a3c2f74723e0a3c74723e0a3c7464206865696768743d22353022206267636f6c6f723d2223346635393562223e266e6273703b3c2f74643e0a3c2f74723e0a3c2f74626f64793e0a3c2f7461626c653e0a3c2f74643e0a3c2f74723e0a3c2f74626f64793e0a3c2f7461626c653e, 'Active', '2016-08-22 02:47:33', '', 'Approve property status', 'Renters', 'smithwilliam3592@gmail.com', '', '1'),
(58, 'Admin listed new property to Host', 0x3c7461626c6520636c6173733d2275692d736f727461626c652d68616e646c652063757272656e745461626c652220626f726465723d2230222077696474683d2231303025222063656c6c73706163696e673d2230222063656c6c70616464696e673d22302220616c69676e3d2263656e74657222206267636f6c6f723d2223666666666666223e0a3c74626f64793e0a3c74723e0a3c74643e266e6273703b0a3c7461626c6520636c6173733d22646576696365776964746822207374796c653d226261636b67726f756e642d636f6c6f723a20236638663866383b2220626f726465723d2230222077696474683d22363030222063656c6c73706163696e673d2230222063656c6c70616464696e673d22302220616c69676e3d2263656e746572223e0a3c74626f64793e0a3c74723e0a3c7464206267636f6c6f723d222366666666666622206865696768743d223330223e266e6273703b20266e6273703b266e6273703b3c2f74643e0a3c2f74723e0a3c74723e0a3c746420616c69676e3d226c65667422206267636f6c6f723d2223666666666666223e3c696d67207372633d227b626173655f75726c28297d696d616765732f6c6f676f2f7b246c6f676f7d2220616c743d226c6f676f222077696474683d2232303022202f3e3c2f74643e0a3c2f74723e0a3c74723e0a3c7464206267636f6c6f723d222366666666666622206865696768743d223330223e266e6273703b3c2f74643e0a3c2f74723e0a3c74723e0a3c746420636c6173733d226564697461626c6522207374796c653d22636f6c6f723a20236666666666663b20666f6e742d66616d696c793a204f70656e2053616e732c20417269616c2c2048656c7665746963612c2073616e732d73657269663b20666f6e742d73697a653a20313870783b20666f6e742d7765696768743a20626f6c643b20746578742d7472616e73666f726d3a207570706572636173653b2070616464696e673a2038707820323070783b206261636b67726f756e642d636f6c6f723a20233462626566663b2220616c69676e3d2263656e746572222076616c69676e3d226d6964646c65223e4869207b2474726176656c65726e616d657d2c3c2f74643e0a3c2f74723e0a3c74723e0a3c7464206865696768743d223330223e266e6273703b3c2f74643e0a3c2f74723e0a3c74723e0a3c7468207374796c653d22636f6c6f723a20233030303b2070616464696e673a2030707820323070783b20666f6e742d66616d696c793a204f70656e2053616e732c20417269616c2c2048656c7665746963612c2073616e732d73657269663b20666f6e742d73697a653a20313370783b2220616c69676e3d2263656e746572223e41646d696e2068617665206372656174656420746865206e65772070726f706572747920746f20796f7572204163636f756e742e3c2f74683e0a3c2f74723e0a3c74723e0a3c74643e266e6273703b3c2f74643e0a3c2f74723e0a3c74723e0a3c7464207374796c653d22636f6c6f723a20233030303b2070616464696e673a2030707820323070783b20666f6e742d66616d696c793a204f70656e2053616e732c20417269616c2c2048656c7665746963612c2073616e732d73657269663b20666f6e742d73697a653a20313370783b2220616c69676e3d226c656674223e50726f7065727479206e616d65203a207b2470726f70657274796e616d657d3c2f74643e0a3c2f74723e0a3c74723e0a3c74643e266e6273703b3c2f74643e0a3c2f74723e0a3c74723e0a3c7464207374796c653d22636f6c6f723a20233030303b2070616464696e673a2030707820323070783b20666f6e742d66616d696c793a204f70656e2053616e732c20417269616c2c2048656c7665746963612c2073616e732d73657269663b20666f6e742d73697a653a20313370783b2220616c69676e3d226c656674223e4c696e6b203a203c6120687265663d227b626173655f75726c28297d72656e74616c2f7b2470726f706572747969647d223e7b626173655f75726c28297d72656e74616c2f7b2470726f706572747969647d3c2f613e3c2f74643e0a3c2f74723e0a3c74723e0a3c74643e266e6273703b3c2f74643e0a3c2f74723e0a3c74723e0a3c7464207374796c653d22636f6c6f723a20233030303b2070616464696e673a2030707820323070783b20666f6e742d66616d696c793a204f70656e2053616e732c20417269616c2c2048656c7665746963612c2073616e732d73657269663b20666f6e742d73697a653a20313370783b2220616c69676e3d226c656674223e5072696365203a207b2473796d626f6c7d207b2470726f706572747970726963657d3c2f74643e0a3c2f74723e0a3c74723e0a3c74643e266e6273703b3c2f74643e0a3c2f74723e0a3c74723e0a3c7464206865696768743d223330223e266e6273703b3c2f74643e0a3c2f74723e0a3c74723e0a3c7464207374796c653d2270616464696e673a2030707820323070783b20636f6c6f723a20233434343434343b20666f6e742d66616d696c793a204f70656e2053616e732c20417269616c2c2048656c7665746963612c2073616e732d73657269663b20666f6e742d73697a653a20313370783b2220616c69676e3d226c656674222076616c69676e3d226d6964646c65223e0a3c703e5468616e6b73213c2f703e0a3c703e5468652052656e74657273205465616d3c2f703e0a3c2f74643e0a3c2f74723e0a3c74723e0a3c7464206865696768743d223330223e266e6273703b3c2f74643e0a3c2f74723e0a3c74723e0a3c7464206267636f6c6f723d222334663539356222206865696768743d223330223e266e6273703b3c2f74643e0a3c2f74723e0a3c74723e0a3c746420616c69676e3d2263656e74657222206267636f6c6f723d2223346635393562223e266e6273703b3c2f74643e0a3c2f74723e0a3c74723e0a3c7464206267636f6c6f723d222334663539356222206865696768743d223530223e266e6273703b3c2f74643e0a3c2f74723e0a3c2f74626f64793e0a3c2f7461626c653e0a3c703e266e6273703b3c2f703e0a3c2f74643e0a3c2f74723e0a3c2f74626f64793e0a3c2f7461626c653e0a3c703e266e6273703b3c2f703e, 'Active', '2016-09-15 05:41:00', '', 'Admin listed new property to your Account', '', '', '', '1'),
(59, 'Admin listed new property Mail', 0x3c7461626c6520636c6173733d2275692d736f727461626c652d68616e646c652063757272656e745461626c652220626f726465723d2230222077696474683d2231303025222063656c6c73706163696e673d2230222063656c6c70616464696e673d22302220616c69676e3d2263656e74657222206267636f6c6f723d2223346635393562223e0a3c74626f64793e0a3c74723e0a3c74643e0a3c7461626c6520636c6173733d22646576696365776964746822207374796c653d226261636b67726f756e642d636f6c6f723a20236638663866383b2220626f726465723d2230222077696474683d22363030222063656c6c73706163696e673d2230222063656c6c70616464696e673d22302220616c69676e3d2263656e746572223e0a3c74626f64793e0a3c74723e0a3c7464206267636f6c6f723d222334663539356222206865696768743d223330223e266e6273703b20266e6273703b266e6273703b3c2f74643e0a3c2f74723e0a3c74723e0a3c746420616c69676e3d226c65667422206267636f6c6f723d2223346635393562223e3c696d67207372633d227b626173655f75726c28297d696d616765732f6c6f676f2f7b246c6f676f7d2220616c743d226c6f676f222077696474683d2232303022202f3e3c2f74643e0a3c2f74723e0a3c74723e0a3c7464206267636f6c6f723d222334663539356222206865696768743d223330223e266e6273703b3c2f74643e0a3c2f74723e0a3c74723e0a3c746420636c6173733d226564697461626c6522207374796c653d22636f6c6f723a20236666666666663b20666f6e742d66616d696c793a204f70656e2053616e732c20417269616c2c2048656c7665746963612c2073616e732d73657269663b20666f6e742d73697a653a20313870783b20666f6e742d7765696768743a20626f6c643b20746578742d7472616e73666f726d3a207570706572636173653b2070616464696e673a2038707820323070783b206261636b67726f756e642d636f6c6f723a20233462626566663b2220616c69676e3d2263656e746572222076616c69676e3d226d6964646c65223e48692041646d696e2c3c2f74643e0a3c2f74723e0a3c74723e0a3c7464206865696768743d223330223e266e6273703b3c2f74643e0a3c2f74723e0a3c74723e0a3c7468207374796c653d22636f6c6f723a20233030303b2070616464696e673a2030707820323070783b20666f6e742d66616d696c793a204f70656e2053616e732c20417269616c2c2048656c7665746963612c2073616e732d73657269663b20666f6e742d73697a653a20313370783b2220616c69676e3d2263656e746572223e596f752068617665206372656174656420746865206e65772050726f7065727479206c6973742e3c2f74683e0a3c2f74723e0a3c74723e0a3c74643e266e6273703b3c2f74643e0a3c2f74723e0a3c74723e0a3c7464207374796c653d22636f6c6f723a20233030303b2070616464696e673a2030707820323070783b20666f6e742d66616d696c793a204f70656e2053616e732c20417269616c2c2048656c7665746963612c2073616e732d73657269663b20666f6e742d73697a653a20313370783b2220616c69676e3d226c656674223e486f7374206e616d65203a207b2474726176656c65726e616d657d3c2f74643e0a3c2f74723e0a3c74723e0a3c74643e266e6273703b3c2f74643e0a3c2f74723e0a3c74723e0a3c7464207374796c653d22636f6c6f723a20233030303b2070616464696e673a2030707820323070783b20666f6e742d66616d696c793a204f70656e2053616e732c20417269616c2c2048656c7665746963612c2073616e732d73657269663b20666f6e742d73697a653a20313370783b2220616c69676e3d226c656674223e4c697374206e616d65203a207b2470726f70657274796e616d657d3c2f74643e0a3c2f74723e0a3c74723e0a3c74643e266e6273703b3c2f74643e0a3c2f74723e0a3c74723e0a3c7464207374796c653d22636f6c6f723a20233030303b2070616464696e673a2030707820323070783b20666f6e742d66616d696c793a204f70656e2053616e732c20417269616c2c2048656c7665746963612c2073616e732d73657269663b20666f6e742d73697a653a20313370783b2220616c69676e3d226c656674223e4c696e6b203a203c6120687265663d227b626173655f75726c28297d72656e74616c2f7b2470726f706572747969647d223e7b626173655f75726c28297d72656e74616c2f7b2470726f706572747969647d3c2f613e3c2f74643e0a3c2f74723e0a3c74723e0a3c74643e266e6273703b3c2f74643e0a3c2f74723e0a3c74723e0a3c7464207374796c653d22636f6c6f723a20233030303b2070616464696e673a2030707820323070783b20666f6e742d66616d696c793a204f70656e2053616e732c20417269616c2c2048656c7665746963612c2073616e732d73657269663b20666f6e742d73697a653a20313370783b2220616c69676e3d226c656674223e5072696365203a207b2473796d626f6c7d207b2470726f706572747970726963657d3c2f74643e0a3c2f74723e0a3c74723e0a3c74643e266e6273703b3c2f74643e0a3c2f74723e0a3c74723e0a3c7464206865696768743d223330223e266e6273703b3c2f74643e0a3c2f74723e0a3c74723e0a3c7464207374796c653d2270616464696e673a2030707820323070783b20636f6c6f723a20233434343434343b20666f6e742d66616d696c793a204f70656e2053616e732c20417269616c2c2048656c7665746963612c2073616e732d73657269663b20666f6e742d73697a653a20313370783b2220616c69676e3d226c656674222076616c69676e3d226d6964646c65223e0a3c703e5468616e6b73213c2f703e0a3c703e5468652052656e74657273205465616d3c2f703e0a3c2f74643e0a3c2f74723e0a3c74723e0a3c7464206865696768743d223330223e266e6273703b3c2f74643e0a3c2f74723e0a3c74723e0a3c7464206267636f6c6f723d222334663539356222206865696768743d223330223e266e6273703b3c2f74643e0a3c2f74723e0a3c74723e0a3c746420616c69676e3d2263656e74657222206267636f6c6f723d2223346635393562223e266e6273703b3c2f74643e0a3c2f74723e0a3c74723e0a3c7464206267636f6c6f723d222334663539356222206865696768743d223530223e266e6273703b3c2f74643e0a3c2f74723e0a3c2f74626f64793e0a3c2f7461626c653e0a3c2f74643e0a3c2f74723e0a3c2f74626f64793e0a3c2f7461626c653e, 'Active', '2016-09-01 05:08:36', '', 'Listed new property by Admin', '', '', '', '1'),
(61, 'Review Listed User', 0x3c7461626c6520636c6173733d2275692d736f727461626c652d68616e646c652063757272656e745461626c652220626f726465723d2230222077696474683d2231303025222063656c6c73706163696e673d2230222063656c6c70616464696e673d22302220616c69676e3d2263656e74657222206267636f6c6f723d2223666666666666223e0a3c74626f64793e0a3c74723e0a3c74643e0a3c7461626c6520636c6173733d22646576696365776964746822207374796c653d226261636b67726f756e642d636f6c6f723a20236666666666663b2220626f726465723d2230222077696474683d22363030222063656c6c73706163696e673d2230222063656c6c70616464696e673d22302220616c69676e3d2263656e746572223e0a3c74626f64793e0a3c74723e0a3c7464206267636f6c6f723d222366666666666622206865696768743d223330223e266e6273703b20266e6273703b20266e6273703b3c2f74643e0a3c2f74723e0a3c74723e0a3c746420616c69676e3d226c65667422206267636f6c6f723d2223666666666666223e3c696d67207372633d227b626173655f75726c28297d696d616765732f6c6f676f2f7b246c6f676f7d2220616c743d226c6f676f222077696474683d2232303022202f3e3c2f74643e0a3c2f74723e0a3c74723e0a3c7464206267636f6c6f723d222366666666666622206865696768743d223330223e266e6273703b3c2f74643e0a3c2f74723e0a3c74723e0a3c746420636c6173733d226564697461626c6522207374796c653d22636f6c6f723a20236666666666663b20666f6e742d66616d696c793a204f70656e2053616e732c20417269616c2c2048656c7665746963612c2073616e732d73657269663b20666f6e742d73697a653a20313870783b20666f6e742d7765696768743a20626f6c643b20746578742d7472616e73666f726d3a207570706572636173653b2070616464696e673a2038707820323070783b206261636b67726f756e642d636f6c6f723a20233462626566663b2220616c69676e3d2263656e746572222076616c69676e3d226d6964646c65223e3c7370616e207374796c653d22636f6c6f723a20236666666666663b223e4869207b24757365725f6e616d657d3c2f7370616e3e3c2f74643e0a3c2f74723e0a3c74723e0a3c7464206865696768743d223330223e266e6273703b3c2f74643e0a3c2f74723e0a3c74723e0a3c7464207374796c653d22636f6c6f723a20233030303b2070616464696e673a2030707820323070783b20666f6e742d66616d696c793a204f70656e2053616e732c20417269616c2c2048656c7665746963612c2073616e732d73657269663b20666f6e742d73697a653a20313370783b2220616c69676e3d2263656e746572223e0a3c703e3c7370616e207374796c653d22666f6e742d73697a653a20782d6c617267653b223e3c7374726f6e673e20596f7572207265766965772061626f7574207468652070726f7065727479207b2470726f647563745f6e616d657d2062656c6f6e677320746f2074686520686f7374207b24686f73745f6e616d657d2068617320706f73746564207375636365737366756c6c79203c2f7374726f6e673e3c2f7370616e3e3c2f703e0a3c703e3c7370616e207374796c653d22666f6e742d73697a653a206d656469756d3b223e3c7374726f6e673e266e6273703b3c2f7374726f6e673e3c2f7370616e3e3c2f703e0a3c2f74643e0a3c2f74723e0a3c74723e0a3c74643e0a3c703e266e6273703b3c2f703e0a3c2f74643e0a3c2f74723e0a3c74723e0a3c7464207374796c653d22636f6c6f723a20233030303b2070616464696e673a2030707820323070783b20666f6e742d66616d696c793a204f70656e2053616e732c20417269616c2c2048656c7665746963612c2073616e732d73657269663b20666f6e742d73697a653a20313370783b2220616c69676e3d2263656e746572223e3c6120687265663d227b626173655f75726c28297d736974652f70726f647563742f646973706c61795f72657669657731223e20436c69636b204865726520546f20566965773c2f613e3c2f74643e0a3c2f74723e0a3c74723e0a3c74643e266e6273703b3c2f74643e0a3c2f74723e0a3c74723e0a3c7464206865696768743d223330223e266e6273703b3c2f74643e0a3c2f74723e0a3c74723e0a3c7464207374796c653d2270616464696e673a2030707820323070783b20636f6c6f723a20233434343434343b20666f6e742d66616d696c793a204f70656e2053616e732c20417269616c2c2048656c7665746963612c2073616e732d73657269663b20666f6e742d73697a653a20313370783b2220616c69676e3d226c656674222076616c69676e3d226d6964646c65223e0a3c703e5468616e6b73213c2f703e0a3c703e5468652052656e74657273205465616d3c2f703e0a3c2f74643e0a3c2f74723e0a3c74723e0a3c7464206865696768743d223330223e266e6273703b3c2f74643e0a3c2f74723e0a3c74723e0a3c746420616c69676e3d2263656e74657222206267636f6c6f723d2223666666666666223e266e6273703b3c2f74643e0a3c2f74723e0a3c74723e0a3c7464206267636f6c6f723d222366666666666622206865696768743d223530223e266e6273703b3c2f74643e0a3c2f74723e0a3c2f74626f64793e0a3c2f7461626c653e0a3c2f74643e0a3c2f74723e0a3c2f74626f64793e0a3c2f7461626c653e, 'Active', '2016-10-05 02:48:06', '', 'Review Posted', '', '', '', '1'),
(62, 'ennor', 0x3c703e72656e74616c7320656e64696e672073746167653c2f703e, 'Active', '2016-10-11 03:30:26', '', 'checking the coupon codes', '', '', '', '1'),
(63, 'backend', 0x3c703e636f75706f6e3c2f703e, 'Active', '2016-10-12 10:12:02', '', 'renters coupon', '', '', '', '1'),
(64, 'First user coupon template', 0x3c703e68616920757365722e2e2e636865636b2074686973206f75742e3c2f703e, 'Active', '2016-10-13 03:41:35', '', 'fist time user coupon', '', '', '', '1'),
(65, 'checking the mail ', 0x3c703e6c757875727920726f6f6d7320666f722072656e74733c2f703e, 'Active', '2016-10-17 12:19:12', '', 'subject', '', '', '', '1'),
(66, 'email email', 0x3c703e6b6a7364666f69777968727575206b6a73626869757772796f69206a6b73626e696177757265706f387165777220626e20736875706977727565796f6977206b62766b757165777079676866266e6273703b3c2f703e, 'Active', '2016-10-24 07:26:02', '', 'subject subject subject', '', '', '', '1'),
(67, 'Special offer confirmation', 0x3c7461626c6520636c6173733d2275692d736f727461626c652d68616e646c652063757272656e745461626c652220626f726465723d2230222077696474683d2231303025222063656c6c73706163696e673d2230222063656c6c70616464696e673d22302220616c69676e3d2263656e74657222206267636f6c6f723d2223346635393562223e0a3c74626f64793e0a3c74723e0a3c74643e0a3c7461626c6520636c6173733d22646576696365776964746822207374796c653d226261636b67726f756e642d636f6c6f723a20236638663866383b2220626f726465723d2230222077696474683d22363030222063656c6c73706163696e673d2230222063656c6c70616464696e673d22302220616c69676e3d2263656e746572223e0a3c74626f64793e0a3c74723e0a3c7464206267636f6c6f723d222334663539356222206865696768743d223330223e266e6273703b3c2f74643e0a3c2f74723e0a3c74723e0a3c746420616c69676e3d226c65667422206267636f6c6f723d2223346635393562223e3c696d67207372633d227b626173655f75726c28297d696d616765732f6c6f676f2f7b246c6f676f7d2220616c743d226c6f676f22202f3e266e6273703b20266e6273703b3c2f74643e0a3c2f74723e0a3c74723e0a3c7464206267636f6c6f723d222334663539356222206865696768743d223330223e266e6273703b3c2f74643e0a3c2f74723e0a3c74723e0a3c746420636c6173733d226564697461626c6522207374796c653d22636f6c6f723a20236666666666663b20666f6e742d66616d696c793a204f70656e2053616e732c20417269616c2c2048656c7665746963612c2073616e732d73657269663b20666f6e742d73697a653a20313870783b20666f6e742d7765696768743a20626f6c643b20746578742d7472616e73666f726d3a207570706572636173653b2070616464696e673a2038707820323070783b206261636b67726f756e642d636f6c6f723a20233462626566663b2220616c69676e3d2263656e746572222076616c69676e3d226d6964646c65223e4869207b24686f73746e616d657d2c3c2f74643e0a3c2f74723e0a3c74723e0a3c7464206865696768743d223330223e266e6273703b3c2f74643e0a3c2f74723e0a3c74723e0a3c7468207374796c653d22636f6c6f723a20233030303b2070616464696e673a2030707820323070783b20666f6e742d66616d696c793a204f70656e2053616e732c20417269616c2c2048656c7665746963612c2073616e732d73657269663b20666f6e742d73697a653a20313370783b2220616c69676e3d2263656e746572223e546865207370656369616c206f6666657220666f722074686520426f6f6b696e67206e6f203a207b24626f6f6b696e674e6f7d20776173207b24616374696f6e7d206279207b2474726176656c65726e616d657d2e3c2f74683e0a3c2f74723e0a3c74723e0a3c74643e266e6273703b3c2f74643e0a3c2f74723e0a3c74723e0a3c7464207374796c653d22636f6c6f723a20233030303b2070616464696e673a2030707820323070783b20666f6e742d66616d696c793a204f70656e2053616e732c20417269616c2c2048656c7665746963612c2073616e732d73657269663b20666f6e742d73697a653a20313370783b2220616c69676e3d226c656674223e266e6273703b3c2f74643e0a3c2f74723e0a3c74723e0a3c7464206865696768743d223330223e266e6273703b3c2f74643e0a3c2f74723e0a3c74723e0a3c7464207374796c653d2270616464696e673a2030707820323070783b20636f6c6f723a20233434343434343b20666f6e742d66616d696c793a204f70656e2053616e732c20417269616c2c2048656c7665746963612c2073616e732d73657269663b20666f6e742d73697a653a20313370783b2220616c69676e3d226c656674222076616c69676e3d226d6964646c65223e0a3c703e5468616e6b73213c2f703e0a3c703e5468652052656e746572205465616d3c2f703e0a3c2f74643e0a3c2f74723e0a3c74723e0a3c7464206865696768743d223330223e266e6273703b3c2f74643e0a3c2f74723e0a3c74723e0a3c7464206267636f6c6f723d222334663539356222206865696768743d223330223e266e6273703b3c2f74643e0a3c2f74723e0a3c74723e0a3c746420616c69676e3d2263656e74657222206267636f6c6f723d2223346635393562223e266e6273703b3c2f74643e0a3c2f74723e0a3c74723e0a3c7464206267636f6c6f723d222334663539356222206865696768743d223530223e266e6273703b3c2f74643e0a3c2f74723e0a3c2f74626f64793e0a3c2f7461626c653e0a3c2f74643e0a3c2f74723e0a3c2f74626f64793e0a3c2f7461626c653e, 'Active', '2016-10-26 03:14:39', '', 'Special offer confirmation', '', '', '', '1'),
(68, 'Special offer Deleted', 0x3c7461626c6520636c6173733d2275692d736f727461626c652d68616e646c652063757272656e745461626c652220626f726465723d2230222077696474683d2231303025222063656c6c73706163696e673d2230222063656c6c70616464696e673d22302220616c69676e3d2263656e74657222206267636f6c6f723d2223346635393562223e0a3c74626f64793e0a3c74723e0a3c74643e0a3c7461626c6520636c6173733d22646576696365776964746822207374796c653d226261636b67726f756e642d636f6c6f723a20236638663866383b2220626f726465723d2230222077696474683d22363030222063656c6c73706163696e673d2230222063656c6c70616464696e673d22302220616c69676e3d2263656e746572223e0a3c74626f64793e0a3c74723e0a3c7464206267636f6c6f723d222334663539356222206865696768743d223330223e266e6273703b3c2f74643e0a3c2f74723e0a3c74723e0a3c746420616c69676e3d226c65667422206267636f6c6f723d2223346635393562223e3c696d67207372633d227b626173655f75726c28297d696d616765732f6c6f676f2f7b246c6f676f7d2220616c743d226c6f676f22202f3e266e6273703b20266e6273703b3c2f74643e0a3c2f74723e0a3c74723e0a3c7464206267636f6c6f723d222334663539356222206865696768743d223330223e266e6273703b3c2f74643e0a3c2f74723e0a3c74723e0a3c746420636c6173733d226564697461626c6522207374796c653d22636f6c6f723a20236666666666663b20666f6e742d66616d696c793a204f70656e2053616e732c20417269616c2c2048656c7665746963612c2073616e732d73657269663b20666f6e742d73697a653a20313870783b20666f6e742d7765696768743a20626f6c643b20746578742d7472616e73666f726d3a207570706572636173653b2070616464696e673a2038707820323070783b206261636b67726f756e642d636f6c6f723a20233462626566663b2220616c69676e3d2263656e746572222076616c69676e3d226d6964646c65223e4869207b2474726176656c65726e616d657d2c3c2f74643e0a3c2f74723e0a3c74723e0a3c7464206865696768743d223330223e266e6273703b3c2f74643e0a3c2f74723e0a3c74723e0a3c7468207374796c653d22636f6c6f723a20233030303b2070616464696e673a2030707820323070783b20666f6e742d66616d696c793a204f70656e2053616e732c20417269616c2c2048656c7665746963612c2073616e732d73657269663b20666f6e742d73697a653a20313370783b2220616c69676e3d2263656e746572223e546865207370656369616c206f6666657220666f722074686520426f6f6b696e67206e6f203a207b24626f6f6b696e674e6f7d207761732064656c65746564266e6273703b6279207b24686f73746e616d657d2e3c2f74683e0a3c2f74723e0a3c74723e0a3c74643e266e6273703b3c2f74643e0a3c2f74723e0a3c74723e0a3c7464207374796c653d22636f6c6f723a20233030303b2070616464696e673a2030707820323070783b20666f6e742d66616d696c793a204f70656e2053616e732c20417269616c2c2048656c7665746963612c2073616e732d73657269663b20666f6e742d73697a653a20313370783b2220616c69676e3d226c656674223e266e6273703b3c2f74643e0a3c2f74723e0a3c74723e0a3c7464206865696768743d223330223e266e6273703b3c2f74643e0a3c2f74723e0a3c74723e0a3c7464207374796c653d2270616464696e673a2030707820323070783b20636f6c6f723a20233434343434343b20666f6e742d66616d696c793a204f70656e2053616e732c20417269616c2c2048656c7665746963612c2073616e732d73657269663b20666f6e742d73697a653a20313370783b2220616c69676e3d226c656674222076616c69676e3d226d6964646c65223e0a3c703e5468616e6b73213c2f703e0a3c703e5468652052656e746572205465616d3c2f703e0a3c2f74643e0a3c2f74723e0a3c74723e0a3c7464206865696768743d223330223e266e6273703b3c2f74643e0a3c2f74723e0a3c74723e0a3c7464206267636f6c6f723d222334663539356222206865696768743d223330223e266e6273703b3c2f74643e0a3c2f74723e0a3c74723e0a3c746420616c69676e3d2263656e74657222206267636f6c6f723d2223346635393562223e266e6273703b3c2f74643e0a3c2f74723e0a3c74723e0a3c7464206267636f6c6f723d222334663539356222206865696768743d223530223e266e6273703b3c2f74643e0a3c2f74723e0a3c2f74626f64793e0a3c2f7461626c653e0a3c2f74643e0a3c2f74723e0a3c2f74626f64793e0a3c2f7461626c653e, 'Active', '2016-10-26 04:16:43', '', 'Special offer Deleted', '', '', '', '1');

-- --------------------------------------------------------

--
-- Table structure for table `fc_notes`
--

CREATE TABLE IF NOT EXISTS `fc_notes` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) NOT NULL,
  `product_id` bigint(20) NOT NULL,
  `notes` mediumtext CHARACTER SET utf8 NOT NULL,
  `dateAdded` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `fc_notifications`
--

CREATE TABLE IF NOT EXISTS `fc_notifications` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `created` datetime NOT NULL,
  `user_id` bigint(20) NOT NULL,
  `activity` mediumtext COLLATE utf8_bin NOT NULL,
  `activity_id` bigint(20) NOT NULL,
  `activity_ip` mediumtext COLLATE utf8_bin NOT NULL,
  `comment_id` bigint(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `fc_payment`
--

CREATE TABLE IF NOT EXISTS `fc_payment` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `created` datetime NOT NULL,
  `modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `user_id` int(100) NOT NULL,
  `sell_id` bigint(20) NOT NULL,
  `product_id` int(100) NOT NULL,
  `price` varchar(500) NOT NULL,
  `quantity` varchar(500) NOT NULL,
  `is_coupon_used` enum('No','Yes') NOT NULL,
  `session_id` varchar(200) NOT NULL,
  `coupon_id` varchar(200) NOT NULL,
  `discountAmount` varchar(500) NOT NULL,
  `couponCode` varchar(255) NOT NULL,
  `coupontype` varchar(500) NOT NULL,
  `shippingid` int(16) NOT NULL,
  `indtotal` varchar(500) NOT NULL,
  `sumtotal` decimal(10,2) NOT NULL,
  `total` varchar(100) NOT NULL,
  `tax` decimal(10,2) NOT NULL,
  `shippingcost` varchar(500) NOT NULL,
  `shippingcountry` varchar(500) NOT NULL,
  `shippingcity` varchar(500) NOT NULL,
  `shippingstate` varchar(500) NOT NULL,
  `paidVoucherStatus` enum('Not Verified','Verified') NOT NULL,
  `paypal_transaction_id` varchar(500) NOT NULL,
  `dealCodeNumber` varchar(500) NOT NULL,
  `inserttime` varchar(65) NOT NULL,
  `status` enum('Pending','Paid') NOT NULL,
  `shipping_date` date NOT NULL,
  `tracking_id` varchar(100) NOT NULL,
  `shipping_status` varchar(100) NOT NULL,
  `payment_type` varchar(100) NOT NULL,
  `attribute_values` int(11) NOT NULL,
  `product_shipping_cost` decimal(10,2) NOT NULL,
  `product_tax_cost` decimal(10,2) NOT NULL,
  `note` blob NOT NULL,
  `order_gift` enum('0','1') NOT NULL DEFAULT '0',
  `payer_email` varchar(500) NOT NULL,
  `received_status` enum('Not received yet','Product received','Need refund') NOT NULL,
  `review_status` enum('Not open','Opened','Closed') NOT NULL,
  `EnquiryId` int(100) NOT NULL,
  `shippingname` varchar(120) NOT NULL,
  `shippingemail` varchar(120) NOT NULL,
  `shippingmobileno` varchar(120) NOT NULL,
  `shippingaddress` varchar(120) NOT NULL,
  `coupon_code` varchar(150) NOT NULL,
  `discount` int(11) NOT NULL,
  `total_amt` int(11) NOT NULL,
  `discount_type` int(11) NOT NULL,
  `dval` int(11) NOT NULL,
  `errmsg` varchar(255) NOT NULL,
  `pro_currency` varchar(50) NOT NULL,
  `pro_total` varchar(50) NOT NULL,
  `pro_sumtotal` varchar(50) NOT NULL,
  `pro_price` varchar(50) NOT NULL,
  `pro_indtotal` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `fc_payment_gateway`
--

CREATE TABLE IF NOT EXISTS `fc_payment_gateway` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `gateway_name` varchar(200) NOT NULL,
  `settings` text NOT NULL,
  `status` enum('Enable','Disable') NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `fc_payment_gateway`
--

INSERT INTO `fc_payment_gateway` (`id`, `gateway_name`, `settings`, `status`) VALUES
(1, 'Paypal IPN', 'a:2:{s:4:"mode";s:7:"sandbox";s:14:"merchant_email";s:35:"vinubusiness1-facilitator@gmail.com";}', 'Enable'),
(3, 'Stripe', 'a:3:{s:4:"mode";s:7:"sandbox";s:10:"secret_key";s:32:"sk_test_MQSQGKl7uUImfiIjfcA5mtS2";s:15:"publishable_key";s:32:"pk_test_D0EGvAFR9stcHL57p1AXt2tc";}', 'Enable'),
(4, 'Credit Card', 'a:3:{s:4:"mode";s:7:"sandbox";s:12:"merchantcode";s:9:"3um6xA6Y4";s:11:"merchantkey";s:16:"3LTjyhC22T3g346P";}', 'Enable');

-- --------------------------------------------------------

--
-- Table structure for table `fc_payment_host`
--

CREATE TABLE IF NOT EXISTS `fc_payment_host` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `bookingId` varchar(100) NOT NULL,
  `product_id` varchar(100) NOT NULL,
  `host_id` varchar(100) NOT NULL,
  `amount` varchar(100) NOT NULL,
  `txn_id` varchar(200) NOT NULL,
  `txt_date` varchar(150) NOT NULL,
  `txn_type` varchar(255) NOT NULL,
  `payment_status` enum('paid','pending') NOT NULL,
  `payment_type` varchar(50) CHARACTER SET utf8 NOT NULL,
  `paypal_txn_id` varchar(50) CHARACTER SET utf8 NOT NULL,
  `paypal_email` varchar(50) CHARACTER SET utf8 NOT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `fc_prefooter`
--

CREATE TABLE IF NOT EXISTS `fc_prefooter` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `footer_title` varchar(500) CHARACTER SET utf8 NOT NULL,
  `short_desc_count` int(10) NOT NULL,
  `short_description` text CHARACTER SET utf8 NOT NULL,
  `footer_link` varchar(500) CHARACTER SET utf8 NOT NULL,
  `image` varchar(250) CHARACTER SET utf8 NOT NULL,
  `status` enum('Active','Inactive') CHARACTER SET utf8 NOT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `lang` varchar(255) CHARACTER SET utf8 NOT NULL,
  `toId` int(12) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `fc_prefooter`
--

INSERT INTO `fc_prefooter` (`id`, `footer_title`, `short_desc_count`, `short_description`, `footer_link`, `image`, `status`, `created`, `lang`, `toId`) VALUES
(1, 'CHECK WITH GUEST', 3, 'Free Advertising and exposure//It''s Super easy!//Get more clients!', '', 'pr1.png', 'Active', '2016-10-24 11:51:35', 'en', 1),
(2, 'WHY LIST YOUR BUSINESS WITH US?', 3, 'Free Advertising and exposure//It''s Super easy!//Get more clients!', '', 'pr2.png', 'Active', '2016-10-24 11:51:39', 'en', 2),
(3, 'LIST YOUR SPACE', 3, 'Write a brief Description//Take Photos//Start Makin Money!', '', 'pr3.png', 'Active', '2016-10-24 11:51:44', 'en', 3);

-- --------------------------------------------------------

--
-- Table structure for table `fc_product`
--

CREATE TABLE IF NOT EXISTS `fc_product` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `seller_product_id` bigint(20) NOT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified` datetime NOT NULL,
  `product_name` varchar(100) NOT NULL,
  `product_title` varchar(1000) NOT NULL,
  `seourl` varchar(500) NOT NULL,
  `meta_title` longblob NOT NULL,
  `meta_keyword` longblob NOT NULL,
  `meta_description` longblob NOT NULL,
  `excerpt` varchar(500) NOT NULL,
  `category_id` varchar(500) NOT NULL,
  `price` decimal(20,2) NOT NULL,
  `std_price` decimal(10,0) NOT NULL,
  `price_range` varchar(100) NOT NULL,
  `sale_price` decimal(20,2) NOT NULL,
  `image` longtext NOT NULL,
  `description` longblob NOT NULL,
  `weight` varchar(100) NOT NULL,
  `quantity` int(11) NOT NULL,
  `max_quantity` int(11) NOT NULL DEFAULT '1',
  `purchasedCount` int(11) NOT NULL,
  `shipping_type` enum('Shippable','Not Shippable') NOT NULL,
  `shipping_cost` decimal(6,2) NOT NULL,
  `taxable_type` enum('Taxable','Not Taxable') NOT NULL,
  `tax_cost` decimal(6,2) NOT NULL,
  `sku` varchar(100) NOT NULL,
  `option` longtext NOT NULL,
  `user_id` int(11) NOT NULL DEFAULT '0',
  `likes` bigint(20) NOT NULL DEFAULT '0',
  `list_name` longtext NOT NULL,
  `sub_list` longtext NOT NULL,
  `list_value` longtext NOT NULL,
  `comment_count` bigint(20) NOT NULL,
  `ship_immediate` enum('false','true') NOT NULL,
  `status` enum('Publish','UnPublish') NOT NULL,
  `order` int(100) NOT NULL,
  `contact_count` int(100) NOT NULL,
  `currency` varchar(10) NOT NULL DEFAULT 'USD',
  `home_type` varchar(1000) NOT NULL,
  `other` varchar(250) NOT NULL,
  `room_type` varchar(1000) DEFAULT NULL,
  `accommodates` varchar(100) NOT NULL DEFAULT '1',
  `bedrooms` varchar(1000) NOT NULL,
  `beds` varchar(1000) NOT NULL,
  `bed_type` varchar(1000) NOT NULL,
  `bathrooms` varchar(1000) NOT NULL,
  `noofbathrooms` varchar(11) NOT NULL,
  `city` varchar(1000) NOT NULL,
  `listings` varchar(250) NOT NULL,
  `price_perweek` decimal(20,2) NOT NULL,
  `price_permonth` decimal(20,2) NOT NULL,
  `desc_title` varchar(50) NOT NULL,
  `space` varchar(250) NOT NULL,
  `guest_access` varchar(250) NOT NULL,
  `interact_guest` varchar(250) NOT NULL,
  `neighbor_overview` varchar(250) NOT NULL,
  `neighbor_around` varchar(250) NOT NULL,
  `other_thingnote` varchar(250) NOT NULL,
  `house_rules` longblob NOT NULL,
  `featured` enum('Featured','UnFeatured') NOT NULL DEFAULT 'UnFeatured',
  `member_pakage` int(11) NOT NULL,
  `package_status` varchar(50) NOT NULL,
  `datefrom` date NOT NULL,
  `dateto` date NOT NULL,
  `neighborhood` varchar(1000) NOT NULL,
  `mobile_verification_code` varchar(500) NOT NULL,
  `is_verified` varchar(500) NOT NULL,
  `calendar_checked` enum('','always','sometimes','onetime') NOT NULL,
  `minimum_stay` int(100) NOT NULL,
  `security_deposit` varchar(100) NOT NULL,
  `extra_people` int(20) NOT NULL,
  `cancellation_policy` varchar(200) NOT NULL,
  `minimum_price` varchar(200) NOT NULL,
  `maximum_price` varchar(200) NOT NULL,
  `through` varchar(500) NOT NULL,
  `video_url` varchar(250) NOT NULL,
  `user_status` enum('Active','Inactive') NOT NULL DEFAULT 'Inactive',
  `host_property_status` enum('yes','no') NOT NULL DEFAULT 'yes',
  `featured_on` datetime NOT NULL,
  `instantbook` enum('yes','no') NOT NULL DEFAULT 'no',
  `payment` enum('Pending','Paid') NOT NULL DEFAULT 'Pending',
  `payment1` enum('Pending','Paid') NOT NULL DEFAULT 'Pending',
  `convertedPrice` decimal(10,2) NOT NULL,
  `convertedMprice` decimal(10,2) NOT NULL,
  `ConvertedWprice` decimal(10,2) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `seller_product_id` (`seller_product_id`),
  KEY `user_id` (`user_id`),
  KEY `seller_product_id_2` (`seller_product_id`),
  KEY `user_id_2` (`user_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `fc_product_address`
--

CREATE TABLE IF NOT EXISTS `fc_product_address` (
  `id` int(100) NOT NULL AUTO_INCREMENT,
  `product_id` varchar(1000) NOT NULL,
  `country` varchar(1000) NOT NULL,
  `state` varchar(1000) NOT NULL,
  `city` varchar(1000) NOT NULL,
  `post_code` varchar(1000) NOT NULL,
  `property_name` varchar(1000) NOT NULL,
  `holding_no` varchar(1000) NOT NULL,
  `no_of_star` varchar(1000) NOT NULL,
  `address` text NOT NULL,
  `latitude` varchar(1000) NOT NULL,
  `longitude` varchar(1000) NOT NULL,
  `apt` varchar(1000) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `product_id` (`product_id`(255)),
  KEY `product_id_2` (`product_id`(255))
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `fc_product_address_new`
--

CREATE TABLE IF NOT EXISTS `fc_product_address_new` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `productId` int(11) NOT NULL,
  `address` varchar(1000) NOT NULL,
  `street` varchar(500) NOT NULL,
  `area` varchar(500) NOT NULL,
  `location` varchar(500) NOT NULL,
  `city` varchar(500) NOT NULL,
  `state` varchar(500) NOT NULL,
  `country` varchar(500) NOT NULL,
  `lang` float(20,17) NOT NULL,
  `lat` float(20,17) NOT NULL,
  `zip` varchar(100) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `productId` (`productId`),
  KEY `productId_2` (`productId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `fc_product_attribute`
--

CREATE TABLE IF NOT EXISTS `fc_product_attribute` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `attr_name` varchar(500) NOT NULL,
  `attr_seourl` varchar(500) NOT NULL,
  `status` enum('Active','Inactive') NOT NULL,
  `dateAdded` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `fc_product_booking`
--

CREATE TABLE IF NOT EXISTS `fc_product_booking` (
  `id` int(100) NOT NULL AUTO_INCREMENT,
  `product_id` varchar(1000) NOT NULL,
  `datefrom` date NOT NULL,
  `dateto` date NOT NULL,
  `expiredate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `price` float(10,2) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `product_id` (`product_id`(767)),
  KEY `product_id_2` (`product_id`(767)),
  KEY `product_id_3` (`product_id`(767))
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `fc_product_category`
--

CREATE TABLE IF NOT EXISTS `fc_product_category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `product_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `subcategory_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `fc_product_comments`
--

CREATE TABLE IF NOT EXISTS `fc_product_comments` (
  `id` int(200) NOT NULL AUTO_INCREMENT,
  `user_id` int(200) NOT NULL,
  `product_id` int(200) NOT NULL,
  `comments` longblob NOT NULL,
  `status` enum('Active','InActive') NOT NULL,
  `dateAdded` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `fc_product_deal_price`
--

CREATE TABLE IF NOT EXISTS `fc_product_deal_price` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `deal_amount` varchar(100) NOT NULL,
  `product_id` int(10) NOT NULL,
  `deal_start_date` date NOT NULL,
  `deal_end_date` date NOT NULL,
  `deal_status` enum('','Active','Inactive') NOT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `fc_rentalsenquiry`
--

CREATE TABLE IF NOT EXISTS `fc_rentalsenquiry` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `prd_id` int(11) NOT NULL,
  `checkin` datetime NOT NULL,
  `checkout` datetime NOT NULL,
  `Enquiry` longtext NOT NULL,
  `subTotal` int(12) NOT NULL,
  `caltophone` varchar(20) NOT NULL,
  `enquiry_timezone` varchar(100) NOT NULL,
  `NoofGuest` int(11) NOT NULL,
  `renter_id` int(100) NOT NULL,
  `numofdates` int(100) NOT NULL,
  `serviceFee` decimal(10,2) NOT NULL,
  `totalAmt` decimal(10,2) NOT NULL,
  `discount_amount` decimal(10,2) NOT NULL,
  `phone_no` int(100) NOT NULL,
  `booking_status` varchar(50) NOT NULL,
  `dateAdded` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `approval` enum('Pending','Decline','Accept') NOT NULL,
  `Bookingno` varchar(250) CHARACTER SET utf8 NOT NULL,
  `stripe_charge_token` varchar(255) CHARACTER SET utf8 NOT NULL,
  `cancelled` enum('No','Yes') NOT NULL DEFAULT 'No',
  `message` text NOT NULL,
  `cancellation_policy` varchar(50) NOT NULL,
  `offer` varchar(50) NOT NULL,
  `offer_approval` enum('Pending','Accept','Decline') NOT NULL DEFAULT 'Accept',
  `b_prd_id` int(11) NOT NULL,
  `b_checkin` datetime NOT NULL,
  `b_checkout` datetime NOT NULL,
  `b_NoofGuest` int(11) NOT NULL,
  `b_numofdates` int(11) NOT NULL,
  `b_serviceFee` decimal(10,2) NOT NULL,
  `b_totalAmt` decimal(10,2) NOT NULL,
  `instantbook_status` enum('No','Yes') NOT NULL,
  `declined` enum('No','Yes') NOT NULL DEFAULT 'No',
  `pro_subTotal` varchar(50) NOT NULL,
  `pro_serviceFee` varchar(50) NOT NULL,
  `pro_totalAmt` varchar(50) NOT NULL,
  `pro_discount_amount` varchar(50) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `prd_id` (`prd_id`),
  KEY `renter_id` (`renter_id`),
  KEY `b_prd_id` (`b_prd_id`),
  KEY `user_id_2` (`user_id`),
  KEY `prd_id_2` (`prd_id`),
  KEY `renter_id_2` (`renter_id`),
  KEY `b_prd_id_2` (`b_prd_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `fc_rental_photos`
--

CREATE TABLE IF NOT EXISTS `fc_rental_photos` (
  `id` int(100) NOT NULL AUTO_INCREMENT,
  `product_id` varchar(1000) NOT NULL,
  `imgPriority` varchar(1000) NOT NULL,
  `imgtitle` varchar(1000) NOT NULL,
  `product_image` varchar(1000) NOT NULL,
  `caption` varchar(200) NOT NULL,
  `cover` varchar(120) NOT NULL,
  `status` enum('Active','InActive') NOT NULL,
  `mproduct_image` varchar(1000) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `product_id` (`product_id`(767)),
  KEY `product_id_2` (`product_id`(767))
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `fc_requirements`
--

CREATE TABLE IF NOT EXISTS `fc_requirements` (
  `id` int(100) NOT NULL AUTO_INCREMENT,
  `user_id` int(100) NOT NULL,
  `id_verified` varchar(100) NOT NULL,
  `ph_verified` varchar(100) NOT NULL,
  `profile_picture` varchar(100) NOT NULL,
  `trip_description` varchar(1000) NOT NULL,
  `verify_code` varchar(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `fc_response_time`
--

CREATE TABLE IF NOT EXISTS `fc_response_time` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `product_id` int(10) NOT NULL,
  `response_time` varchar(250) NOT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `fc_review`
--

CREATE TABLE IF NOT EXISTS `fc_review` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `rateVal` int(11) NOT NULL,
  `title` varchar(500) NOT NULL,
  `review` varchar(1000) CHARACTER SET utf8 NOT NULL,
  `email` varchar(500) NOT NULL,
  `status` enum('Active','Inactive') NOT NULL DEFAULT 'Inactive',
  `product_id` int(100) NOT NULL,
  `bookingno` varchar(250) NOT NULL,
  `dateAdded` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `user_type` varchar(1000) NOT NULL,
  `owner_reply` varchar(1000) NOT NULL,
  `user_id` varchar(1000) NOT NULL,
  `reviewer_id` varchar(1000) NOT NULL,
  `review_for` enum('accuracy','communication','cleanliness','location','check_in','value') NOT NULL,
  `accuracy` int(200) NOT NULL,
  `communication` int(200) NOT NULL,
  `cleanliness` int(200) NOT NULL,
  `location` int(200) NOT NULL,
  `checkin` int(200) NOT NULL,
  `value` int(200) NOT NULL,
  `total_review` int(200) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `product_id` (`product_id`),
  KEY `user_id` (`user_id`(767)),
  KEY `product_id_2` (`product_id`),
  KEY `user_id_2` (`user_id`(767))
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `fc_review_comments`
--

CREATE TABLE IF NOT EXISTS `fc_review_comments` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `deal_code` mediumtext NOT NULL,
  `product_id` bigint(20) NOT NULL,
  `commentor_id` bigint(20) NOT NULL,
  `comment` blob NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `comment_from` enum('user','seller','admin') NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `fc_saved_neighborhoods`
--

CREATE TABLE IF NOT EXISTS `fc_saved_neighborhoods` (
  `id` int(100) NOT NULL AUTO_INCREMENT,
  `neighborhood` varchar(1000) NOT NULL,
  `user_id` int(100) NOT NULL,
  `url` varchar(1000) NOT NULL,
  `dateAdded` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `fc_shipping_address`
--

CREATE TABLE IF NOT EXISTS `fc_shipping_address` (
  `id` int(100) NOT NULL AUTO_INCREMENT,
  `user_id` int(100) NOT NULL,
  `full_name` varchar(200) NOT NULL,
  `nick_name` varchar(200) NOT NULL,
  `address1` varchar(500) NOT NULL,
  `address2` varchar(500) NOT NULL,
  `city` varchar(200) NOT NULL,
  `state` varchar(200) NOT NULL,
  `country` varchar(100) NOT NULL,
  `postal_code` varchar(10) NOT NULL,
  `phone` bigint(9) NOT NULL,
  `primary` enum('Yes','No') NOT NULL DEFAULT 'No',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `fc_shopping_carts`
--

CREATE TABLE IF NOT EXISTS `fc_shopping_carts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `created` datetime NOT NULL,
  `modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `user_id` int(11) NOT NULL,
  `sell_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `quantity` int(11) NOT NULL,
  `discountAmount` decimal(10,2) NOT NULL,
  `indtotal` decimal(10,2) NOT NULL,
  `total` decimal(10,2) NOT NULL,
  `is_coupon_used` enum('Yes','No') NOT NULL DEFAULT 'No',
  `couponID` int(200) NOT NULL,
  `couponCode` varchar(100) NOT NULL,
  `coupontype` varchar(100) NOT NULL,
  `cate_id` varchar(100) NOT NULL,
  `shipping_cost` decimal(10,2) NOT NULL,
  `product_shipping_cost` decimal(10,2) NOT NULL,
  `tax` decimal(10,2) NOT NULL,
  `product_tax_cost` decimal(10,2) NOT NULL,
  `attribute_values` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=52 ;

-- --------------------------------------------------------

--
-- Table structure for table `fc_slider`
--

CREATE TABLE IF NOT EXISTS `fc_slider` (
  `id` int(100) NOT NULL AUTO_INCREMENT,
  `status` enum('Active','InActive') NOT NULL,
  `slider_name` varchar(1000) CHARACTER SET utf8 NOT NULL,
  `slider_title` varchar(1000) CHARACTER SET utf8 NOT NULL,
  `slider_link` varchar(1000) NOT NULL,
  `slider_desc` varchar(1000) CHARACTER SET utf8 NOT NULL,
  `image` varchar(1000) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `fc_slider`
--

INSERT INTO `fc_slider` (`id`, `status`, `slider_name`, `slider_title`, `slider_link`, `slider_desc`, `image`) VALUES
(3, 'Active', ' í…ŒìŠ¤íŠ¸ í…ŒìŠ¤íŠ¸', ' í…ŒìŠ¤íŠ¸', 'www.google.com', ' í…ŒìŠ¤íŠ¸', 'us-hi-lahaina-0011.jpg'),
(5, 'Active', ' í…ŒìŠ¤íŠ¸', ' í…ŒìŠ¤íŠ¸', '', 'í…ŒìŠ¤íŠ¸  í…ŒìŠ¤íŠ¸ í…ŒìŠ¤íŠ¸ í…ŒìŠ¤íŠ¸ í…ŒìŠ¤íŠ¸ í…ŒìŠ¤íŠ¸\r\n', 'euromast-50-jaar2.jpg'),
(7, 'Active', 'ìŠ¬ë¼ì´ë”', 'ìŠ¬ë¼ì´ë”', 'http://airbnbv2.zoplay.com/rental/Stanley ', 'ìŠ¬ë¼ì´ë”\n', 'image.jpg'),
(9, 'Active', 'Aaa', 'Aaa', 'www.google.com', 'zfdf', 'wat-arun.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `fc_states`
--

CREATE TABLE IF NOT EXISTS `fc_states` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `countryid` int(11) NOT NULL,
  `state_code` varchar(32) NOT NULL,
  `name` varchar(32) NOT NULL,
  `contid` varchar(50) NOT NULL,
  `seourl` varchar(250) NOT NULL,
  `status` enum('InActive','Active') NOT NULL,
  `featured` enum('0','1') NOT NULL,
  `description` longblob NOT NULL,
  `meta_title` varchar(1000) NOT NULL,
  `meta_keyword` varchar(1000) NOT NULL,
  `meta_description` blob NOT NULL,
  `statelogo` varchar(1000) NOT NULL,
  `statethumb` varchar(1000) NOT NULL,
  `latitude` varchar(250) NOT NULL,
  `longitude` varchar(250) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=875 ;

--
-- Dumping data for table `fc_states`
--

INSERT INTO `fc_states` (`id`, `countryid`, `state_code`, `name`, `contid`, `seourl`, `status`, `featured`, `description`, `meta_title`, `meta_keyword`, `meta_description`, `statelogo`, `statethumb`, `latitude`, `longitude`) VALUES
(3, 215, 'AS', 'American Samoa', 'NA', 'american-samoa', 'Active', '', '', '', '', '', '', '', '', ''),
(4, 215, 'AZ', 'Arizona', 'NA', 'arizona', 'Active', '', '', '', '', '', '', '', '34.0489281', '-111.0937311'),
(5, 215, 'AR', 'Arkansas', 'NA', 'arkansas', 'Active', '', '', '', '', '', '', '', '', ''),
(6, 215, 'AF', 'Armed Forces Africa', 'NA', 'armed-forces-africa', 'Active', '', '', '', '', '', '', '', '15.6169796', '32.5547559'),
(7, 215, 'AA', 'Armed Forces Americas', 'NA', 'armed-forces-americas', 'Active', '', '', '', '', '', '', '', '', ''),
(8, 215, 'AC', 'Armed Forces Canada', 'NA', 'armed-forces-canada', 'Active', '', '', '', '', '', '', '', '', ''),
(9, 215, 'AE', 'Armed Forces Europe', 'NA', 'armed-forces-europe', 'Active', '', '', '', '', '', '', '', '', ''),
(10, 215, 'AM', 'Armed Forces Middle East', 'NA', 'armed-forces-middle-east', 'Active', '', '', '', '', '', '', '', '', ''),
(11, 215, 'AP', 'Armed Forces Pacific', 'NA', 'armed-forces-pacific', 'Active', '', '', '', '', '', '', '', '', ''),
(12, 215, 'CA', 'demo', 'NA', 'california', 'Active', '', '', '', '', '', '', '', '36.778261', '-119.4179324'),
(13, 215, 'CO', 'Colorado', 'NA', 'colorado', 'Active', '', '', '', '', '', '', '', '', ''),
(14, 215, 'CT', 'Connecticut', 'NA', 'connecticut', 'Active', '', '', '', '', '', '', '', '', ''),
(15, 215, 'DE', 'Delaware', 'NA', 'delaware', 'Active', '', '', '', '', '', '', '', '', ''),
(16, 215, 'DC', 'District of Columbia', 'NA', 'district-of-columbia', 'Active', '', '', '', '', '', '', '', '', ''),
(17, 215, 'FM', 'Federated States Of Micronesia', 'NA', 'federated-states-of-micronesia', 'Active', '', '', '', '', '', '', '', '', ''),
(18, 215, 'FL', 'Florida', 'NA', 'florida', 'Active', '1', 0x3c703e3c7374726f6e673e54726176656c696e6720746f20466c6f726964613c2f7374726f6e673e3c2f703e0d0a3c703e466c6f72696461207661636174696f6e2072656e74616c7320616e6420466c6f72696461207661636174696f6e20686f6d6573206861766520616c77617973206265656e2065787472656d656c7920706f70756c6172207769746820746f7572697374732066726f6d206163726f73732074686520676c6f62652e205768656e20697420636f6d657320746f207669736974696e67207468652055532c207468697320697320757375616c6c792074686520666972737420706c61636520746861742070656f706c65207468696e6b206f662e20497420697320626f726465726564206279207468652041746c616e746963204f6365616e20616e642069732074686520383c7375703e74683c2f7375703e2062696767657374206369747920696e207465726d73206f662069747320706f70756c6174696f6e2e2054686520636c696d617465207468726f7567686f7574207468652073746174652076617269657320617320697420697320736f206c617267652c20696e636c75646520626f74682073756274726f706963616c20616e642074726f706963616c2c20646570656e64696e672077686572652061626f757420696e207468652073746174652070656f706c65206172652073746179696e672e3c2f703e0d0a3c703e266e6273703b3c2f703e0d0a3c703e3c7374726f6e673e5468696e677320746f20646f20696e20466c6f726964613c2f7374726f6e673e3c2f703e0d0a3c703e416674657220626f6f6b696e6720696e746f20466c6f72696461207661636174696f6e2072656e74616c7320616e6420466c6f72696461207661636174696f6e20686f6d65732c20746865726520617265206365727461696e6c7920706c656e7479206f6620706c6163657320746f20676f20776974682066616d696c6965732c20667269656e64732c206f72206a757374206173206120636f75706c652e20546865204d69616d69205a6f6f206973206365727461696e6c7920746f70206f6e206d616e792070656f706c65732073686f72746c6973742c2073696d706c7920626563617573652069742068617320736f206d75636820746f206f666665722076697369746f72732061742073756368206120726561736f6e61626c652070726963652e20496e20666163742c206d616e792070656f706c6520696e2074686520555320636f6e7369646572207468697320746f206265207468652062657374206f6620616c6c20746865205a6f6f73206f6e2061206e6174696f6e776964652062617369732e20546865206772656174207468696e672074686174206365727461696e6c792063616e20626520736169642061626f75742074686973205a6f6f206973207468617420746865206c6f63616c20636c696d61746520616c6c6f777320746865205a6f6f206b65657065727320746f207265706c69636174652074686520636c696d61746573206f662041667269636120616e64204175737472616c69612c207768696368206d65616e73207468617420746865792063616e206b65657020616e2065787472656d656c7920776964652072616e6765206f6620646966666572656e7420616e696d616c7320686572652c206d616b696e672069742065787472656d656c7920696e746572657374696e6720616e642076617269656420666f722076697369746f72732e3c2f703e0d0a3c703e266e6273703b3c2f703e0d0a3c703e416674657220636865636b696e6720696e746f2061207661636174696f6e2072656e74616c2070726f706572747920696e20466c6f726964612c20616e6f74686572206f7074696f6e206d6967687420626520746f20766973697420746865205365617175617269756d207768696368206973206c6f636174656420686572652e2054686973206973206c6f6361746564207269676874206e65787420746f2074686520746f7572697374206172656120696e207468652063697479206f66204d69616d6920616e64206f66666572732070656f706c6520616e20696e736967687420696e746f20746865206c6f63616c20736561206c6966652c20686f7720697420686173206368616e67656420616e6420686f772069742077696c6c20636f6e74696e756520746f206368616e67652e20546869732074656e647320746f20626520616e2065787472656d656c7920677265617420646179206f757420666f722066616d696c6965732c2061732074686579206861766520746865206f70706f7274756e69747920666f72207468656972206368696c6472656e20746f2061637475616c6c7920686176652066756e2c20627574206c6561726e2061206c6f7420616c6f6e672074686520776179206174207468652073616d652074696d652c207768696368206973206365727461696e6c7920696465616c2e3c2f703e0d0a3c703e266e6273703b3c2f703e0d0a3c703e4f6620636f757273652c2061207472697020746f20466c6f7269646120776f756c64206365727461696e6c79206e6f7420626520636f6d706c65746520776974686f75742061207472697020746f207468652062656163682e204d69616d69206973206365727461696e6c79206f6e65206f6620746865206661766f7572697465206c6f636174696f6e73207768656e20697420636f6d657320746f2068697474696e67207468652062656163682c206173206974206f666665727320736f6d65206f66207468652062657374206265616368657320696e2074686520776f726c642e205468657265206973206e6f20646f7562742074686174207468697320697320747275652c2061732074686f7573616e6473206f662070656f706c65207669736974207468656d2065766572792073696e676c65206461792e204f6620636f757273652c20746865792074656e6420746f206765742061206c6f742062757369657220647572696e67207468652073756d6d6572206d6f6e74687320616e6420746865726520697320616c7761797320706c656e747920676f696e67206f6e20696e207465726d73206f662073706f72747320616e64206f7468657220616374697669746965732e3c2f703e0d0a3c703e266e6273703b3c2f703e0d0a3c703e3c7374726f6e673e4163636f6d6d6f646174696f6e7320696e20466c6f726964613c2f7374726f6e673e3c2f703e0d0a3c703e546865206163636f6d6d6f646174696f6e7320696e20466c6f726964612072616e67652061206772656174206465616c20746f2074727920616e64207375697420646966666572656e742062756467657473207768657265206576657220706f737369626c652e20466f7220696e7374616e63652c2074686572652061726520627564676574206d6f74656c732c2062757420616c736f20746f70207175616c6974792076696c6c617320617265207468652073616d652074696d652e205468652041637175616c696e61205265736f727420616e6420537061206973206f6e65206f662074686f736520746f70207175616c69747920666163696c6974696573207468617420696e636f72706f72617465207468652067726561742076696c6c617320616e6420657863656c6c656e7420666163696c697469657320616e642074656e6420746f20626520666f722074686f73652070656f706c65207468617420686176652061206c6172676572206275646765742e3c2f703e0d0a3c703e266e6273703b3c2f703e0d0a3c703e3c7374726f6e673e5765617468657220696e20466c6f726964613c2f7374726f6e673e3c2f703e0d0a3c703e546865207765617468657220696e20466c6f72696461206973206365727461696e6c792077686174206174747261637473206d616e792070656f706c6520746f20746865206172656120616e6420697320736f6d657468696e672074686174206861732068656c70656420746f206d616b652074686973206120706f70756c617220746f75726973742064657374696e6174696f6e2e20447572696e67207468652073756d6d6572206d6f6e7468732c206578706563742074656d70657261747572657320746f2068697420746865206c696b6573206f6620333820266465673b43206f6e206d616e79206f63636173696f6e732c2077686963682068656c707320746f206d616b652074686973206665656c206c696b65206120736f6d6520776861742074726f706963616c20686f6c696461792e3c2f703e, '', '', '', '', '', '', ''),
(19, 215, 'GA', 'Georgia', 'NA', 'georgia', 'Active', '', '', '', '', '', '', '', '', ''),
(20, 215, 'GU', 'Guam', 'NA', 'guam', 'Active', '', '', '', '', '', '', '', '', ''),
(21, 215, 'HI', 'Hawaii', 'NA', 'hawaii', 'Active', '', '', '', '', '', '', '', '', ''),
(22, 215, 'ID', 'Idaho', 'NA', 'idaho', 'Active', '', '', '', '', '', '', '', '', ''),
(23, 215, 'IL', 'Illinois', 'NA', 'illinois', 'Active', '', '', '', '', '', '', '', '', ''),
(24, 215, 'IN', 'Indiana', 'NA', 'indiana', 'Active', '', '', '', '', '', '', '', '', ''),
(25, 215, 'IA', 'Iowa', 'NA', 'iowa', 'Active', '', '', '', '', '', '', '', '', ''),
(26, 215, 'KS', 'Kansas', 'NA', 'kansas', 'Active', '', '', '', '', '', '', '', '', ''),
(27, 215, 'KY', 'Kentucky', 'NA', 'kentucky', 'Active', '', '', '', '', '', '', '', '', ''),
(28, 215, 'LA', 'Louisiana', 'NA', 'louisiana', 'Active', '', '', '', '', '', '', '', '', ''),
(29, 215, 'ME', 'Maine', 'NA', 'maine', 'Active', '', '', '', '', '', '', '', '', ''),
(30, 215, 'MH', 'Marshall Islands', 'NA', 'marshall-islands', 'Active', '', '', '', '', '', '', '', '', ''),
(31, 215, 'MD', 'Maryland', 'NA', 'maryland', 'Active', '', '', '', '', '', '', '', '', ''),
(32, 215, 'MA', 'Massachusetts', 'NA', 'massachusetts', 'Active', '', '', '', '', '', '', '', '', ''),
(33, 215, 'MI', 'Michigan', 'NA', 'michigan', 'Active', '', '', '', '', '', '', '', '', ''),
(34, 215, 'MN', 'Minnesota', 'NA', 'minnesota', 'Active', '', '', '', '', '', '', '', '', ''),
(35, 215, 'MS', 'Mississippi', 'NA', 'mississippi', 'Active', '', '', '', '', '', '', '', '', ''),
(36, 215, 'MO', 'Missouri', 'NA', 'missouri', 'Active', '', '', '', '', '', '', '', '', ''),
(37, 215, 'MT', 'Montana', 'NA', 'montana', 'Active', '', '', '', '', '', '', '', '', ''),
(38, 215, 'NE', 'Nebraska', 'NA', 'nebraska', 'Active', '', '', '', '', '', '', '', '', ''),
(39, 215, 'NV', 'Nevada', 'NA', 'nevada', 'Active', '', '', '', '', '', '', '', '', ''),
(40, 215, 'NH', 'New Hampshire', 'NA', 'new-hampshire', 'Active', '', '', '', '', '', '', '', '', ''),
(41, 215, 'NJ', 'New Jersey', 'NA', 'new-jersey', 'Active', '', '', '', '', '', '', '', '40.0583238', '-74.4056612'),
(42, 215, 'NM', 'New Mexico', 'NA', 'new-mexico', 'Active', '', '', '', '', '', '', '', '', ''),
(43, 215, 'NY', 'New York', 'NA', 'new-york', 'Active', '', '', '', '', '', '', '', '', ''),
(44, 215, 'NC', 'North Carolina', 'NA', 'north-carolina', 'Active', '', '', '', '', '', '', '', '', ''),
(45, 215, 'ND', 'North Dakota', 'NA', 'north-dakota', 'Active', '', '', '', '', '', '', '', '', ''),
(46, 215, 'MP', 'Northern Mariana Islands', 'NA', 'northern-mariana-islands', 'Active', '', '', '', '', '', '', '', '', ''),
(47, 215, 'OH', 'Ohio', 'NA', 'ohio', 'Active', '', '', '', '', '', '', '', '', ''),
(48, 215, 'OK', 'Oklahoma', 'NA', 'oklahoma', 'Active', '', '', '', '', '', '', '', '', ''),
(49, 215, 'OR', 'Oregon', 'NA', 'oregon', 'Active', '', '', '', '', '', '', '', '', ''),
(50, 215, 'PW', 'Palau', 'NA', 'palau', 'Active', '', '', '', '', '', '', '', '', ''),
(51, 215, 'PA', 'Pennsylvania', 'NA', 'pennsylvania', 'Active', '', '', '', '', '', '', '', '', ''),
(52, 215, 'PR', 'Puerto Rico', 'NA', 'puerto-rico', 'Active', '', '', '', '', '', '', '', '', ''),
(53, 215, 'RI', 'Rhode Island', 'NA', 'rhode-island', 'Active', '', '', '', '', '', '', '', '', ''),
(54, 215, 'SC', 'South Carolina', 'NA', 'south-carolina', 'Active', '', '', '', '', '', '', '', '', ''),
(55, 215, 'SD', 'South Dakota', 'NA', 'south-dakota', 'Active', '', '', '', '', '', '', '', '', ''),
(56, 215, 'TN', 'Tennessee', 'NA', 'tennessee', 'Active', '', '', '', '', '', '', '', '', ''),
(57, 215, 'TX', 'Texas', 'NA', 'texas', 'Active', '1', '', '', '', '', '', '', '', ''),
(58, 215, 'UT', 'Utah', 'NA', 'utah', 'Active', '', '', '', '', '', '', '', '', ''),
(59, 215, 'VT', 'Vermont', 'NA', 'vermont', 'Active', '', '', '', '', '', '', '', '', ''),
(60, 215, 'VI', 'Virgin Islands', 'NA', 'virgin-islands', 'Active', '', '', '', '', '', '', '', '', ''),
(61, 215, 'VA', 'Virginia', 'NA', 'virginia', 'Active', '', '', '', '', '', '', '', '', ''),
(62, 215, 'WA', 'Washington', 'NA', 'washington', 'Active', '', '', '', '', '', '', '', '', ''),
(63, 215, 'WV', 'West Virginia', 'NA', 'west-virginia', 'Active', '', '', '', '', '', '', '', '', ''),
(64, 215, 'WI', 'Wisconsin', 'NA', 'wisconsin', 'Active', '', '', '', '', '', '', '', '', ''),
(65, 215, 'WY', 'Wyoming', 'NA', 'wyoming', 'Active', '', '', '', '', '', '', '', '', ''),
(66, 38, 'AB', 'Alberta', 'NA', 'alberta', 'Active', '', '', '', '', '', '', '', '', ''),
(67, 38, 'BC', 'British Columbia', 'NA', 'british-columbia', 'Active', '', '', '', '', '', '', '', '', ''),
(68, 38, 'MB', 'Manitoba', 'NA', 'manitoba', 'Active', '', '', '', '', '', '', '', '', ''),
(69, 38, 'NF', 'Newfoundland', 'NA', 'newfoundland', 'Active', '', '', '', '', '', '', '', '', ''),
(70, 38, 'NB', 'New Brunswick', 'NA', 'new-brunswick', 'Active', '', '', '', '', '', '', '', '', ''),
(71, 38, 'NS', 'Nova Scotia', 'NA', 'nova-scotia', 'Active', '', '', '', '', '', '', '', '', ''),
(72, 38, 'NT', 'Northwest Territories', 'NA', 'northwest-territories', 'Active', '', '', '', '', '', '', '', '', ''),
(73, 38, 'NU', 'Nunavut', 'NA', 'nunavut', 'Active', '', '', '', '', '', '', '', '', ''),
(74, 38, 'ON', 'Ontario', 'NA', 'ontario', 'Active', '', '', '', '', '', '', '', '', ''),
(75, 38, 'PE', 'Prince Edward Island', 'NA', 'prince-edward-island', 'Active', '', '', '', '', '', '', '', '', ''),
(76, 38, 'QC', 'Quebec', 'NA', 'quebec', 'Active', '', '', '', '', '', '', '', '', ''),
(77, 38, 'SK', 'Saskatchewan', 'NA', 'saskatchewan', 'Active', '', '', '', '', '', '', '', '', ''),
(78, 38, 'YT', 'Yukon Territory', 'NA', 'yukon-territory', 'Active', '', '', '', '', '', '', '', '', ''),
(182, 13, 'NSW', 'New South Wales', 'OC', 'new-south-wales', 'Active', '', '', '', '', '', '', '', '', ''),
(183, 13, 'VIC', 'Victoria', 'OC', 'victoria', 'Active', '', '', '', '', '', '', '', '', ''),
(184, 13, 'QLD', 'Queensland', 'OC', 'queensland', 'Active', '', '', '', '', '', '', '', '', ''),
(185, 13, 'NT', 'Northern Territory', 'OC', 'northern-territory', 'Active', '', '', '', '', '', '', '', '', ''),
(186, 13, 'WA', 'Western Australia', 'OC', 'western-australia', 'Active', '', '', '', '', '', '', '', '', ''),
(187, 13, 'SA', 'South Australia', 'OC', 'south-australia', 'Active', '', '', '', '', '', '', '', '', ''),
(188, 13, 'TAS', 'Tasmania', 'OC', 'tasmania', 'Active', '', '', '', '', '', '', '', '', ''),
(189, 13, 'ACT', 'Australian Capital Territory', 'OC', 'australian-capital-territory', 'Active', '', '', '', '', '', '', '', '', ''),
(420, 105, 'AG', 'Agrigento', 'EU', 'agrigento', 'Active', '', '', '', '', '', '', '', '', ''),
(421, 105, 'AL', 'Alessandria', 'EU', 'alessandria', 'Active', '', '', '', '', '', '', '', '', ''),
(422, 105, 'AN', 'Ancona', 'EU', 'ancona', 'Active', '', '', '', '', '', '', '', '', ''),
(423, 105, 'AO', 'Aosta', 'EU', 'aosta', 'Active', '', '', '', '', '', '', '', '', ''),
(424, 105, 'AR', 'Arezzo', 'EU', 'arezzo', 'Active', '', '', '', '', '', '', '', '', ''),
(425, 105, 'AP', 'Ascoli Piceno', 'EU', 'ascoli-piceno', 'Active', '', '', '', '', '', '', '', '', ''),
(426, 105, 'AT', 'Asti', 'EU', 'asti', 'Active', '', '', '', '', '', '', '', '', ''),
(427, 105, 'AV', 'Avellino', 'EU', 'avellino', 'Active', '', '', '', '', '', '', '', '', ''),
(428, 105, 'BA', 'Bari', 'EU', 'bari', 'Active', '', '', '', '', '', '', '', '', ''),
(429, 105, 'BL', 'Belluno', 'EU', 'belluno', 'Active', '', '', '', '', '', '', '', '', ''),
(430, 105, 'BN', 'Benevento', 'EU', 'benevento', 'Active', '', '', '', '', '', '', '', '', ''),
(431, 105, 'BG', 'Bergamo', 'EU', 'bergamo', 'Active', '', '', '', '', '', '', '', '', ''),
(432, 105, 'BI', 'Biella', 'EU', 'biella', 'Active', '', '', '', '', '', '', '', '', ''),
(433, 105, 'BO', 'Bologna', 'EU', 'bologna', 'Active', '', '', '', '', '', '', '', '', ''),
(434, 105, 'BZ', 'Bolzano', 'EU', 'bolzano', 'Active', '', '', '', '', '', '', '', '', ''),
(435, 105, 'BS', 'Brescia', 'EU', 'brescia', 'Active', '', '', '', '', '', '', '', '', ''),
(436, 105, 'BR', 'Brindisi', 'EU', 'brindisi', 'Active', '', '', '', '', '', '', '', '', ''),
(437, 105, 'CA', 'Cagliari', 'EU', 'cagliari', 'Active', '', '', '', '', '', '', '', '', ''),
(438, 105, 'CL', 'Caltanissetta', 'EU', 'caltanissetta', 'Active', '', '', '', '', '', '', '', '', ''),
(439, 105, 'CB', 'Campobasso', 'EU', 'campobasso', 'Active', '', '', '', '', '', '', '', '', ''),
(440, 105, 'CE', 'Caserta', 'EU', 'caserta', 'Active', '', '', '', '', '', '', '', '', ''),
(441, 105, 'CT', 'Catania', 'EU', 'catania', 'Active', '', '', '', '', '', '', '', '', ''),
(442, 105, 'CZ', 'Catanzaro', 'EU', 'catanzaro', 'Active', '', '', '', '', '', '', '', '', ''),
(443, 105, 'CH', 'Chieti', 'EU', 'chieti', 'Active', '', '', '', '', '', '', '', '', ''),
(444, 105, 'CO', 'Como', 'EU', 'como', 'Active', '', '', '', '', '', '', '', '', ''),
(445, 105, 'CS', 'Cosenza', 'EU', 'cosenza', 'Active', '', '', '', '', '', '', '', '', ''),
(446, 105, 'CR', 'Cremona', 'EU', 'cremona', 'Active', '', '', '', '', '', '', '', '', ''),
(447, 105, 'KR', 'Crotone', 'EU', 'crotone', 'Active', '', '', '', '', '', '', '', '', ''),
(448, 105, 'CN', 'Cuneo', 'EU', 'cuneo', 'Active', '', '', '', '', '', '', '', '', ''),
(449, 105, 'EN', 'Enna', 'EU', 'enna', 'Active', '', '', '', '', '', '', '', '', ''),
(450, 105, 'FE', 'Ferrara', 'EU', 'ferrara', 'Active', '', '', '', '', '', '', '', '', ''),
(451, 105, 'FI', 'Firenze', 'EU', 'firenze', 'Active', '', '', '', '', '', '', '', '', ''),
(452, 105, 'FG', 'Foggia', 'EU', 'foggia', 'Active', '', '', '', '', '', '', '', '', ''),
(453, 105, 'FO', 'ForlÃƒÆ’Ã†â€™Ãƒâ€ Ã¢â‚¬â„¢ÃƒÆ’Ã¢', 'EU', 'forlÃƒÆ’Ã†â€™Ãƒâ€ Ã¢â‚¬â„¢ÃƒÆ’Ã¢â‚¬Å¡Ãƒâ€šÃ‚Â¬', 'Active', '', '', '', '', '', '', '', '', ''),
(454, 105, 'FR', 'Frosinone', 'EU', 'frosinone', 'Active', '', '', '', '', '', '', '', '', ''),
(455, 105, 'GE', 'Genova', 'EU', 'genova', 'Active', '', '', '', '', '', '', '', '', ''),
(456, 105, 'GO', 'Gorizia', 'EU', 'gorizia', 'Active', '', '', '', '', '', '', '', '', ''),
(457, 105, 'GR', 'Grosseto', 'EU', 'grosseto', 'Active', '', '', '', '', '', '', '', '', ''),
(458, 105, 'IM', 'Imperia', 'EU', 'imperia', 'Active', '', '', '', '', '', '', '', '', ''),
(459, 105, 'IS', 'Isernia', 'EU', 'isernia', 'Active', '', '', '', '', '', '', '', '', ''),
(460, 105, 'AQ', 'Aquila', 'EU', 'aquila', 'Active', '', '', '', '', '', '', '', '', ''),
(461, 105, 'SP', 'La Spezia', 'EU', 'la-spezia', 'Active', '', '', '', '', '', '', '', '', ''),
(462, 105, 'LT', 'Latina', 'EU', 'latina', 'Active', '', '', '', '', '', '', '', '', ''),
(463, 105, 'LE', 'Lecce', 'EU', 'lecce', 'Active', '', '', '', '', '', '', '', '', ''),
(464, 105, 'LC', 'Lecco', 'EU', 'lecco', 'Active', '', '', '', '', '', '', '', '', ''),
(465, 105, 'LI', 'Livorno', 'EU', 'livorno', 'Active', '', '', '', '', '', '', '', '', ''),
(466, 105, 'LO', 'Lodi', 'EU', 'lodi', 'Active', '', '', '', '', '', '', '', '', ''),
(467, 105, 'LU', 'Lucca', 'EU', 'lucca', 'Active', '', '', '', '', '', '', '', '', ''),
(468, 105, 'MC', 'Macerata', 'EU', 'macerata', 'Active', '', '', '', '', '', '', '', '', ''),
(469, 105, 'MN', 'Mantova', 'EU', 'mantova', 'Active', '', '', '', '', '', '', '', '', ''),
(470, 105, 'MS', 'Massa-Carrara', 'EU', 'massacarrara', 'Active', '', '', '', '', '', '', '', '', ''),
(471, 105, 'MT', 'Matera', 'EU', 'matera', 'Active', '', '', '', '', '', '', '', '', ''),
(472, 105, 'ME', 'Messina', 'EU', 'messina', 'Active', '', '', '', '', '', '', '', '', ''),
(473, 105, 'MI', 'Milano', 'EU', 'milano', 'Active', '', '', '', '', '', '', '', '', ''),
(474, 105, 'MO', 'Modena', 'EU', 'modena', 'Active', '', '', '', '', '', '', '', '', ''),
(475, 105, 'NA', 'Napoli', 'EU', 'napoli', 'Active', '', '', '', '', '', '', '', '', ''),
(476, 105, 'NO', 'Novara', 'EU', 'novara', 'Active', '', '', '', '', '', '', '', '', ''),
(477, 105, 'NU', 'Nuoro', 'EU', 'nuoro', 'Active', '', '', '', '', '', '', '', '', ''),
(478, 105, 'OR', 'Oristano', 'EU', 'oristano', 'Active', '', '', '', '', '', '', '', '', ''),
(479, 105, 'PD', 'Padova', 'EU', 'padova', 'Active', '', '', '', '', '', '', '', '', ''),
(480, 105, 'PA', 'Palermo', 'EU', 'palermo', 'Active', '', '', '', '', '', '', '', '', ''),
(481, 105, 'PR', 'Parma', 'EU', 'parma', 'Active', '', '', '', '', '', '', '', '', ''),
(482, 105, 'PG', 'Perugia', 'EU', 'perugia', 'Active', '', '', '', '', '', '', '', '', ''),
(483, 105, 'PV', 'Pavia', 'EU', 'pavia', 'Active', '', '', '', '', '', '', '', '', ''),
(484, 105, 'PS', 'Pesaro e Urbino', 'EU', 'pesaro-e-urbino', 'Active', '', '', '', '', '', '', '', '', ''),
(485, 105, 'PE', 'Pescara', 'EU', 'pescara', 'Active', '', '', '', '', '', '', '', '', ''),
(486, 105, 'PC', 'Piacenza', 'EU', 'piacenza', 'Active', '', '', '', '', '', '', '', '', ''),
(487, 105, 'PI', 'Pisa', 'EU', 'pisa', 'Active', '', '', '', '', '', '', '', '', ''),
(488, 105, 'PT', 'Pistoia', 'EU', 'pistoia', 'Active', '', '', '', '', '', '', '', '', ''),
(489, 105, 'PN', 'Pordenone', 'EU', 'pordenone', 'Active', '', '', '', '', '', '', '', '', ''),
(490, 105, 'PZ', 'Potenza', 'EU', 'potenza', 'Active', '', '', '', '', '', '', '', '', ''),
(491, 105, 'PO', 'Prato', 'EU', 'prato', 'Active', '', '', '', '', '', '', '', '', ''),
(492, 105, 'RG', 'Ragusa', 'EU', 'ragusa', 'Active', '', '', '', '', '', '', '', '', ''),
(493, 105, 'RA', 'Ravenna', 'EU', 'ravenna', 'Active', '', '', '', '', '', '', '', '', ''),
(494, 105, 'RC', 'Reggio di Calabria', 'EU', 'reggio-di-calabria', 'Active', '', '', '', '', '', '', '', '', ''),
(495, 105, 'RE', 'Reggio Emilia', 'EU', 'reggio-emilia', 'Active', '', '', '', '', '', '', '', '', ''),
(496, 105, 'RI', 'Rieti', 'EU', 'rieti', 'Active', '', '', '', '', '', '', '', '', ''),
(497, 105, 'RN', 'Rimini', 'EU', 'rimini', 'Active', '', '', '', '', '', '', '', '', ''),
(498, 105, 'RM', 'Roma', 'EU', 'roma', 'Active', '', '', '', '', '', '', '', '', ''),
(499, 105, 'RO', 'Rovigo', 'EU', 'rovigo', 'Active', '', '', '', '', '', '', '', '', ''),
(500, 105, 'SA', 'Salerno', 'EU', 'salerno', 'Active', '', '', '', '', '', '', '', '', ''),
(501, 105, 'SS', 'Sassari', 'EU', 'sassari', 'Active', '', '', '', '', '', '', '', '', ''),
(502, 105, 'SV', 'Savona', 'EU', 'savona', 'Active', '', '', '', '', '', '', '', '', ''),
(503, 105, 'SI', 'Siena', 'EU', 'siena', 'Active', '', '', '', '', '', '', '', '', ''),
(504, 105, 'SR', 'Siracusa', 'EU', 'siracusa', 'Active', '', '', '', '', '', '', '', '', ''),
(505, 105, 'SO', 'Sondrio', 'EU', 'sondrio', 'Active', '', '', '', '', '', '', '', '', ''),
(506, 105, 'TA', 'Taranto', 'EU', 'taranto', 'Active', '', '', '', '', '', '', '', '', ''),
(507, 105, 'TE', 'Teramo', 'EU', 'teramo', 'Active', '', '', '', '', '', '', '', '', ''),
(508, 105, 'TR', 'Terni', 'EU', 'terni', 'Active', '', '', '', '', '', '', '', '', ''),
(509, 105, 'TO', 'Torino', 'EU', 'torino', 'Active', '', '', '', '', '', '', '', '', ''),
(510, 105, 'TP', 'Trapani', 'EU', 'trapani', 'Active', '', '', '', '', '', '', '', '', ''),
(511, 105, 'TN', 'Trento', 'EU', 'trento', 'Active', '', '', '', '', '', '', '', '', ''),
(512, 105, 'TV', 'Treviso', 'EU', 'treviso', 'Active', '', '', '', '', '', '', '', '', ''),
(513, 105, 'TS', 'Trieste', 'EU', 'trieste', 'Active', '', '', '', '', '', '', '', '', ''),
(514, 105, 'UD', 'Udine', 'EU', 'udine', 'Active', '', '', '', '', '', '', '', '', ''),
(515, 105, 'VA', 'Varese', 'EU', 'varese', 'Active', '', '', '', '', '', '', '', '', ''),
(516, 105, 'VE', 'Venezia', 'EU', 'venezia', 'Active', '', '', '', '', '', '', '', '', ''),
(517, 105, 'VB', 'Verbania', 'EU', 'verbania', 'Active', '', '', '', '', '', '', '', '', ''),
(518, 105, 'VC', 'Vercelli', 'EU', 'vercelli', 'Active', '', '', '', '', '', '', '', '', ''),
(519, 105, 'VR', 'Verona', 'EU', 'verona', 'Active', '', '', '', '', '', '', '', '', ''),
(520, 105, 'VV', 'Vibo Valentia', 'EU', 'vibo-valentia', 'Active', '', '', '', '', '', '', '', '', ''),
(521, 105, 'VI', 'Vicenza', 'EU', 'vicenza', 'Active', '', '', '', '', '', '', '', '', ''),
(522, 105, 'VT', 'Viterbo', 'EU', 'viterbo', 'Active', '', '', '', '', '', '', '', '', ''),
(787, 222, 'AVON', 'Avon', 'EU', 'avon', 'Active', '', '', '', '', '', '', '', '', ''),
(788, 222, 'BEDS', 'Bedfordshire', 'EU', 'bedfordshire', 'Active', '', '', '', '', '', '', '', '', ''),
(789, 222, 'BERK', 'Berkshire', 'EU', 'berkshire', 'Active', '', '', '', '', '', '', '', '', ''),
(790, 222, 'BIRM', 'Birmingham', 'EU', 'birmingham', 'Active', '', '', '', '', '', '', '', '', ''),
(791, 222, 'BORD', 'Borders', 'EU', 'borders', 'Active', '', '', '', '', '', '', '', '', ''),
(792, 222, 'BUCK', 'Buckinghamshire', 'EU', 'buckinghamshire', 'Active', '', '', '', '', '', '', '', '', ''),
(793, 222, 'CAMB', 'Cambridgeshire', 'EU', 'cambridgeshire', 'Active', '', '', '', '', '', '', '', '', ''),
(794, 222, 'CENT', 'Central', 'EU', 'central', 'Active', '', '', '', '', '', '', '', '', ''),
(795, 222, 'CHES', 'Cheshire', 'EU', 'cheshire', 'Active', '', '', '', '', '', '', '', '', ''),
(796, 222, 'CLEV', 'Cleveland', 'EU', 'cleveland', 'Active', '', '', '', '', '', '', '', '', ''),
(797, 222, 'CLWY', 'Clwyd', 'EU', 'clwyd', 'Active', '', '', '', '', '', '', '', '', ''),
(798, 222, 'CORN', 'Cornwall', 'EU', 'cornwall', 'Active', '', '', '', '', '', '', '', '', ''),
(799, 222, 'CUMB', 'Cumbria', 'EU', 'cumbria', 'Active', '', '', '', '', '', '', '', '', ''),
(800, 222, 'DERB', 'Derbyshire', 'EU', 'derbyshire', 'Active', '', '', '', '', '', '', '', '', ''),
(801, 222, 'DEVO', 'Devon', 'EU', 'devon', 'Active', '', '', '', '', '', '', '', '', ''),
(802, 222, 'DORS', 'Dorset', 'EU', 'dorset', 'Active', '', '', '', '', '', '', '', '', ''),
(803, 222, 'DUMF', 'Dumfries & Galloway', 'EU', 'dumfries-&-galloway', 'Active', '', '', '', '', '', '', '', '', ''),
(804, 222, 'DURH', 'Durham', 'EU', 'durham', 'Active', '', '', '', '', '', '', '', '', ''),
(805, 222, 'DYFE', 'Dyfed', 'EU', 'dyfed', 'Active', '', '', '', '', '', '', '', '', ''),
(806, 222, 'ESUS', 'East Sussex', 'EU', 'east-sussex', 'Active', '', '', '', '', '', '', '', '', ''),
(807, 222, 'ESSE', 'Essex', 'EU', 'essex', 'Active', '', '', '', '', '', '', '', '', ''),
(808, 222, 'FIFE', 'Fife', 'EU', 'fife', 'Active', '', '', '', '', '', '', '', '', ''),
(809, 222, 'GLAM', 'Glamorgan', 'EU', 'glamorgan', 'Active', '', '', '', '', '', '', '', '', ''),
(810, 222, 'GLOU', 'Gloucestershire', 'EU', 'gloucestershire', 'Active', '', '', '', '', '', '', '', '', ''),
(811, 222, 'GRAM', 'Grampian', 'EU', 'grampian', 'Active', '', '', '', '', '', '', '', '', ''),
(812, 222, 'GWEN', 'Gwent', 'EU', 'gwent', 'Active', '', '', '', '', '', '', '', '', ''),
(813, 222, 'GWYN', 'Gwynedd', 'EU', 'gwynedd', 'Active', '', '', '', '', '', '', '', '', ''),
(814, 222, 'HAMP', 'Hampshire', 'EU', 'hampshire', 'Active', '', '', '', '', '', '', '', '', ''),
(815, 222, 'HERE', 'Hereford & Worcester', 'EU', 'hereford-&-worcester', 'Active', '', '', '', '', '', '', '', '', ''),
(816, 222, 'HERT', 'Hertfordshire', 'EU', 'hertfordshire', 'Active', '', '', '', '', '', '', '', '', ''),
(817, 222, 'HUMB', 'Humberside', 'EU', 'humberside', 'Active', '', '', '', '', '', '', '', '', ''),
(818, 222, 'KENT', 'Kent', 'EU', 'kent', 'Active', '', '', '', '', '', '', '', '', ''),
(819, 222, 'LANC', 'Lancashire', 'EU', 'lancashire', 'Active', '', '', '', '', '', '', '', '', ''),
(820, 222, 'LEIC', 'Leicestershire', 'EU', 'leicestershire', 'Active', '', '', '', '', '', '', '', '', ''),
(821, 222, 'LINC', 'Lincolnshire', 'EU', 'lincolnshire', 'Active', '', '', '', '', '', '', '', '', ''),
(822, 222, 'LOND', 'London', 'EU', 'london', 'Active', '', '', '', '', '', '', '', '', ''),
(823, 222, 'LOTH', 'Lothian', 'EU', 'lothian', 'Active', '', '', '', '', '', '', '', '', ''),
(824, 222, 'MANC', 'Manchester', 'EU', 'manchester', 'Active', '', '', '', '', '', '', '', '', ''),
(825, 222, 'MERS', 'Merseyside', 'EU', 'merseyside', 'Active', '', '', '', '', '', '', '', '', ''),
(826, 222, 'NORF', 'Norfolk', 'EU', 'norfolk', 'Active', '', '', '', '', '', '', '', '', ''),
(827, 222, 'NYOR', 'North Yorkshire', 'EU', 'north-yorkshire', 'Active', '', '', '', '', '', '', '', '', ''),
(828, 222, 'NWHI', 'North west Highlands', 'EU', 'north-west-highlands', 'Active', '', '', '', '', '', '', '', '', ''),
(829, 222, 'NHAM', 'Northamptonshire', 'EU', 'northamptonshire', 'Active', '', '', '', '', '', '', '', '', ''),
(830, 222, 'NUMB', 'Northumberland', 'EU', 'northumberland', 'Active', '', '', '', '', '', '', '', '', ''),
(831, 222, 'NOTT', 'Nottinghamshire', 'EU', 'nottinghamshire', 'Active', '', '', '', '', '', '', '', '', ''),
(832, 222, 'OXFO', 'Oxfordshire', 'EU', 'oxfordshire', 'Active', '', '', '', '', '', '', '', '', ''),
(833, 222, 'POWY', 'Powys', 'EU', 'powys', 'Active', '', '', '', '', '', '', '', '', ''),
(834, 222, 'SHRO', 'Shropshire', 'EU', 'shropshire', 'Active', '0', '', '', '', '', '', '', '', ''),
(835, 222, 'SOME', 'Somerset', 'EU', 'somerset', 'Active', '0', '', '', '', '', '', '', '', ''),
(836, 222, 'SYOR', 'South Yorkshire', 'EU', 'south-yorkshire', 'Active', '0', '', '', '', '', '', '', '', ''),
(837, 222, 'STAF', 'Staffordshire', 'EU', 'staffordshire', 'Active', '0', '', '', '', '', '', '', '', ''),
(838, 222, 'STRA', 'Strathclyde', 'EU', 'strathclyde', 'Active', '0', '', '', '', '', '', '', '', ''),
(839, 222, 'SUFF', 'Suffolk', 'EU', 'suffolk', 'Active', '0', '', '', '', '', '', '', '', ''),
(840, 222, 'SURR', 'Surrey', 'EU', 'surrey', 'Active', '0', '', '', '', '', '', '', '', ''),
(841, 222, 'WSUS', 'West Sussex', 'EU', 'west-sussex', 'Active', '0', '', '', '', '', '', '', '', ''),
(842, 222, 'TAYS', 'Tayside', 'EU', 'tayside', 'Active', '0', '', '', '', '', '', '', '', ''),
(843, 222, 'TYWE', 'Tyne & Wear', 'EU', 'tyne-&-wear', 'Active', '0', '', '', '', '', '', '', '', ''),
(844, 222, 'WARW', 'Warwickshire', 'EU', 'warwickshire', 'Active', '0', '', '', '', '', '', '', '', ''),
(845, 222, 'WISL', 'West Isles', 'EU', 'west-isles', 'Active', '0', '', '', '', '', '', '', '', ''),
(846, 222, 'WYOR', 'West Yorkshire', 'EU', 'west-yorkshire', 'Active', '0', '', '', '', '', '', '', '', ''),
(847, 222, 'WILT', 'Wiltshire', 'EU', 'wiltshire', 'Active', '0', '', '', '', '', '', '', '', ''),
(859, 51, 'NRW', 'North Rhine-Westphalia', '', 'north-rhine-westphalia', 'Active', '0', '', 'North Rhine-Westphalia', 'North Rhine-Westphalia', 0x4e6f727468205268696e652d576573747068616c6961, '', '', '', ''),
(860, 95, 'TN', 'Tamil Nadu', '', '', 'Active', '0', '', '', '', '', '', '', '11.12712', '78.65689'),
(861, 95, 'MI', 'Mumbai', '', 'mumbai', 'Active', '0', '', '', '', '', '', '', '19.07598', '72.87766'),
(862, 215, 'CA06', 'California', '', 'california', 'Active', '0', '', '', '', '', '', '', '36.77826', '-119.41793'),
(863, 95, '75002', 'Maharastra', '', 'maharastra', 'Active', '0', '', '', '', '', '', '', '19.75148', '75.71389'),
(864, 51, '1', 'Bayern', '', 'bayern', 'Active', '0', '', '', '', '', '', '', '48.79045', '11.49789'),
(865, 145, 'SWK', 'Sarawak', '', 'sarawak', 'Active', '0', '', '', '', '', '', '', '1.55328', '110.35921'),
(866, 70, '0123', 'south england', '', 'south-england', 'Active', '0', '', '', '', '', '', '', '52.35552', '-1.17432'),
(867, 95, '12', 'Karnataka', '', 'karnataka', 'Active', '0', '', '', '', '', '', '', '15.31728', '75.71389'),
(868, 189, 'sn', 'dakar', '', 'dakar', 'Active', '0', '', '', '', '', '', '', '14.76450', '-17.36603'),
(869, 95, 'Haryana', 'Haryana', '', 'haryana', 'Active', '0', '', '', '', '', '', '', '37.77264', '-122.40992'),
(870, 95, 'Delhi-NCR', 'Delhi-NCR', '', 'delhi-ncr', 'Active', '0', '', '', '', '', '', '', '28.68381', '77.41038'),
(871, 153, 'Norway', 'Buskerud', '', 'buskerud', 'Active', '0', '', '', '', '', '', '', '37.77264', '-122.40992'),
(872, 51, '51145', 'koln', '', 'koln', 'Active', '0', '', '', '', '', '', '', '50.93753', '6.96028'),
(873, 207, 'Bursa', 'Bursa', '', 'bursa', 'Active', '0', '', '', '', '', '', '', '40.18853', '29.06096'),
(874, 0, '', 'chennai', '', 'chennai', 'Active', '0', '', 'chennai', 'chennai', 0x636f6f6c65737420706c61636520696e20496e646961, '', '', '13.08268', '80.27072');

-- --------------------------------------------------------

--
-- Table structure for table `fc_state_tax`
--

CREATE TABLE IF NOT EXISTS `fc_state_tax` (
  `id` int(100) NOT NULL AUTO_INCREMENT,
  `state_name` varchar(500) NOT NULL,
  `state_code` varchar(500) NOT NULL,
  `status` enum('Active','InActive') NOT NULL,
  `dateAdded` datetime NOT NULL,
  `state_tax` float(10,2) NOT NULL,
  `country_id` int(100) NOT NULL,
  `country_code` varchar(500) NOT NULL,
  `country_name` varchar(500) NOT NULL,
  `seourl` varchar(500) NOT NULL,
  `meta_title` longblob NOT NULL,
  `meta_keyword` longblob NOT NULL,
  `meta_description` longblob NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `fc_state_tax`
--

INSERT INTO `fc_state_tax` (`id`, `state_name`, `state_code`, `status`, `dateAdded`, `state_tax`, `country_id`, `country_code`, `country_name`, `seourl`, `meta_title`, `meta_keyword`, `meta_description`) VALUES
(2, 'Alaska', 'AK', 'InActive', '2013-07-29 13:00:00', 2.00, 3, '', 'Afghanistan', 'alaska', '', '', ''),
(3, 'American Samoa', 'AS', 'Active', '2013-07-29 13:00:00', 1.00, 3, '', 'USA', '', '', '', ''),
(4, 'Arizona', 'AZ', 'Active', '2013-07-29 13:00:00', 1.00, 3, '', 'USA', 'arizona', '', '', ''),
(5, 'Armed Forces Africa', 'AF', 'Active', '2013-07-29 13:00:00', 1.00, 3, '', 'USA', 'armed-forces-africa', '', '', ''),
(6, 'Armed Forces Americas', 'AA', 'Active', '2013-07-29 13:00:00', 1.00, 3, 'US', 'USA', 'armed-forces-americas', '', '', ''),
(8, 'tamilnadu', 'TN', 'Active', '2013-07-31 06:00:00', 1.00, 1, '', 'India', 'tamilnadu', '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `fc_subadmin`
--

CREATE TABLE IF NOT EXISTS `fc_subadmin` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `created` date NOT NULL,
  `modified` date NOT NULL,
  `name` varchar(250) NOT NULL,
  `admin_name` varchar(24) NOT NULL,
  `admin_password` varchar(500) NOT NULL,
  `email` varchar(5000) NOT NULL,
  `admin_type` enum('super','sub') NOT NULL DEFAULT 'super',
  `password_reset_count` int(10) NOT NULL,
  `privileges` text NOT NULL,
  `last_login_date` datetime NOT NULL,
  `last_logout_date` datetime NOT NULL,
  `last_login_ip` varchar(16) NOT NULL,
  `is_verified` enum('No','Yes') NOT NULL,
  `status` enum('Active','Inactive') NOT NULL DEFAULT 'Active',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `fc_subproducts`
--

CREATE TABLE IF NOT EXISTS `fc_subproducts` (
  `pid` int(11) NOT NULL AUTO_INCREMENT,
  `product_id` int(11) NOT NULL,
  `attr_id` int(11) NOT NULL,
  `attr_price` decimal(10,2) NOT NULL,
  `dateAdded` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`pid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `fc_subscribers_list`
--

CREATE TABLE IF NOT EXISTS `fc_subscribers_list` (
  `id` int(200) NOT NULL AUTO_INCREMENT,
  `subscrip_mail` varchar(500) NOT NULL,
  `active` int(255) NOT NULL,
  `status` enum('Active','InActive') NOT NULL,
  `dateAdded` date NOT NULL,
  `verification_mail` varchar(1000) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `fc_testimonials`
--

CREATE TABLE IF NOT EXISTS `fc_testimonials` (
  `id` int(100) NOT NULL AUTO_INCREMENT,
  `title` varchar(1000) NOT NULL,
  `description` longblob NOT NULL,
  `dateAdded` datetime NOT NULL,
  `status` enum('Active','InActive') NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `fc_transaction`
--

CREATE TABLE IF NOT EXISTS `fc_transaction` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `payment_cycle` varchar(500) NOT NULL,
  `txn_type` varchar(500) NOT NULL,
  `last_name` varchar(500) NOT NULL,
  `next_payment_date` varchar(500) NOT NULL,
  `residence_country` varchar(500) NOT NULL,
  `initial_payment_amount` varchar(500) NOT NULL,
  `currency_code` varchar(500) NOT NULL,
  `time_created` varchar(500) NOT NULL,
  `verify_sign` varchar(750) NOT NULL,
  `period_type` varchar(500) NOT NULL,
  `payer_status` varchar(500) NOT NULL,
  `test_ipn` varchar(500) NOT NULL,
  `tax` varchar(500) NOT NULL,
  `payer_email` varchar(500) NOT NULL,
  `first_name` varchar(500) NOT NULL,
  `receiver_email` varchar(500) NOT NULL,
  `payer_id` varchar(500) NOT NULL,
  `product_type` varchar(500) NOT NULL,
  `shipping` varchar(500) NOT NULL,
  `amount_per_cycle` varchar(500) NOT NULL,
  `profile_status` varchar(500) NOT NULL,
  `charset` varchar(500) NOT NULL,
  `notify_version` varchar(500) NOT NULL,
  `amount` varchar(500) NOT NULL,
  `outstanding_balance` varchar(500) NOT NULL,
  `recurring_payment_id` varchar(500) NOT NULL,
  `product_name` varchar(500) NOT NULL,
  `custom_values` varchar(500) NOT NULL,
  `ipn_track_id` varchar(500) NOT NULL,
  `tran_date` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `fc_users`
--

CREATE TABLE IF NOT EXISTS `fc_users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `loginUserType` enum('normal','twitter','facebook','google','linkedin') NOT NULL,
  `full_name` varchar(100) NOT NULL,
  `user_name` varchar(50) NOT NULL,
  `group` enum('User','Seller') NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `status` enum('Active','Inactive') NOT NULL,
  `is_verified` enum('No','Yes') NOT NULL DEFAULT 'No',
  `id_verified` enum('No','Yes') NOT NULL DEFAULT 'No',
  `ph_verified` enum('No','Yes') NOT NULL DEFAULT 'No',
  `is_brand` enum('no','yes') NOT NULL DEFAULT 'no',
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  `last_login_date` datetime NOT NULL,
  `last_logout_date` datetime NOT NULL,
  `last_login_ip` varchar(50) NOT NULL,
  `thumbnail` varchar(100) NOT NULL,
  `address` varchar(50) NOT NULL,
  `address2` varchar(500) NOT NULL,
  `city` varchar(50) NOT NULL,
  `district` varchar(50) NOT NULL,
  `state` varchar(50) NOT NULL,
  `country` varchar(20) NOT NULL,
  `postal_code` int(11) NOT NULL,
  `phone_no` varchar(20) NOT NULL,
  `country_code` varchar(50) NOT NULL,
  `ph_country` varchar(70) NOT NULL,
  `s_address` varchar(100) NOT NULL,
  `s_city` varchar(50) NOT NULL,
  `s_district` varchar(50) NOT NULL,
  `s_state` varchar(50) NOT NULL,
  `s_country` varchar(20) NOT NULL,
  `s_postal_code` int(11) NOT NULL,
  `s_phone_no` varchar(20) NOT NULL,
  `brand_name` varchar(100) NOT NULL,
  `brand_description` text NOT NULL,
  `commision` int(11) NOT NULL,
  `web_url` varchar(50) NOT NULL,
  `bank_name` varchar(50) NOT NULL,
  `bank_no` varchar(100) NOT NULL,
  `bank_code` varchar(100) NOT NULL,
  `request_status` enum('Not Requested','Pending','Approved','Rejected') NOT NULL DEFAULT 'Not Requested',
  `verify_code` varchar(10) NOT NULL,
  `mobile_verification_code` varchar(50) DEFAULT NULL,
  `feature_product` int(100) NOT NULL,
  `followers_count` int(11) NOT NULL,
  `following_count` int(11) NOT NULL,
  `followers` varchar(200) NOT NULL,
  `following` varchar(200) NOT NULL,
  `twitter` varchar(50) NOT NULL,
  `facebook` varchar(50) NOT NULL,
  `google` varchar(50) NOT NULL,
  `birthday` date NOT NULL,
  `about` varchar(200) NOT NULL,
  `age` enum('','13 to 17','18 to 24','25 to 34','35 to 44','45 to 54','55+') NOT NULL,
  `gender` enum('Male','Female','Unspecified') NOT NULL DEFAULT 'Unspecified',
  `language` varchar(10) NOT NULL DEFAULT 'en',
  `visibility` enum('Everyone','Only you') NOT NULL,
  `display_lists` enum('Yes','No') NOT NULL,
  `email_notifications` longtext NOT NULL,
  `notifications` longtext NOT NULL,
  `updates` enum('1','0') NOT NULL,
  `products` int(11) NOT NULL,
  `lists` int(11) NOT NULL,
  `likes` int(11) NOT NULL,
  `location` mediumtext NOT NULL,
  `following_user_lists` longtext NOT NULL,
  `following_giftguide_lists` longtext NOT NULL,
  `api_id` bigint(20) NOT NULL,
  `own_products` longtext NOT NULL,
  `own_count` bigint(20) NOT NULL,
  `referId` int(11) NOT NULL,
  `want_count` bigint(20) NOT NULL,
  `refund_amount` decimal(20,2) NOT NULL DEFAULT '0.00',
  `paypal_email` varchar(500) NOT NULL,
  `contact_count` int(100) NOT NULL,
  `firstname` varchar(1000) NOT NULL,
  `lastname` varchar(1000) NOT NULL,
  `image` varchar(1000) NOT NULL,
  `description` longtext NOT NULL,
  `response_rate` int(100) NOT NULL,
  `cardType` varchar(255) NOT NULL,
  `cardNumber` int(20) NOT NULL,
  `CCExpDay` int(4) NOT NULL,
  `CCExpMnth` int(4) NOT NULL,
  `cvv` varchar(255) NOT NULL,
  `dob_date` int(100) NOT NULL,
  `dob_month` int(100) NOT NULL,
  `dob_year` int(100) NOT NULL,
  `school` varchar(1000) NOT NULL,
  `work` varchar(1000) NOT NULL,
  `timezone` varchar(1000) NOT NULL,
  `member_pakage` varchar(1000) NOT NULL,
  `member_purchase_date` date NOT NULL,
  `package_status` enum('Pending','Paid') NOT NULL DEFAULT 'Pending',
  `expired_date` date NOT NULL,
  `package_exp_date` date NOT NULL,
  `social_recommend` enum('yes','no') NOT NULL DEFAULT 'no',
  `search_by_profile` enum('yes','no') NOT NULL DEFAULT 'no',
  `emergency_name` varchar(250) NOT NULL,
  `emergency_phone` varchar(250) NOT NULL,
  `emergency_email` varchar(250) NOT NULL,
  `emergency_relationship` varchar(250) NOT NULL,
  `languages_known` text NOT NULL,
  `accname` varchar(15) NOT NULL,
  `accno` varchar(250) NOT NULL,
  `routing_no` varchar(50) NOT NULL,
  `bankname` varchar(25) NOT NULL,
  `swift_code` varchar(255) NOT NULL,
  `Acccountry` varchar(25) NOT NULL,
  `swiftcode` varchar(55) NOT NULL,
  `subscriber` enum('Yes','No','delete') NOT NULL,
  `login_hit` int(11) NOT NULL,
  `through` varchar(500) NOT NULL,
  `mobile_key` varchar(255) NOT NULL,
  `user_currency` varchar(255) NOT NULL,
  `ios_key` varchar(255) NOT NULL,
  `mobile_notification` enum('Yes','No') NOT NULL DEFAULT 'No',
  `host_status` enum('Active','Inactive') NOT NULL DEFAULT 'Inactive',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `fc_user_activity`
--

CREATE TABLE IF NOT EXISTS `fc_user_activity` (
  `id` int(200) NOT NULL AUTO_INCREMENT,
  `activity_name` varchar(200) NOT NULL,
  `activity_id` int(200) NOT NULL,
  `user_id` int(200) NOT NULL,
  `activity_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `activity_ip` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `fc_user_product`
--

CREATE TABLE IF NOT EXISTS `fc_user_product` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `seller_product_id` bigint(20) NOT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `product_name` varchar(100) NOT NULL,
  `seourl` varchar(500) NOT NULL,
  `meta_title` longblob NOT NULL,
  `meta_keyword` longblob NOT NULL,
  `meta_description` longblob NOT NULL,
  `excerpt` varchar(500) NOT NULL,
  `category_id` varchar(500) NOT NULL,
  `image` longtext NOT NULL,
  `description` longtext NOT NULL,
  `status` enum('Publish','UnPublish') NOT NULL DEFAULT 'Publish',
  `user_id` int(11) NOT NULL DEFAULT '0',
  `likes` bigint(20) NOT NULL DEFAULT '0',
  `list_name` longtext NOT NULL,
  `list_value` longtext NOT NULL,
  `web_link` mediumtext NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `fc_vendor_payment_table`
--

CREATE TABLE IF NOT EXISTS `fc_vendor_payment_table` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `transaction_id` mediumtext COLLATE utf8_bin NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `payment_type` mediumtext COLLATE utf8_bin NOT NULL,
  `amount` float(20,2) NOT NULL,
  `status` enum('pending','success','failed') COLLATE utf8_bin NOT NULL,
  `vendor_id` bigint(20) NOT NULL,
  `bookingId` varchar(50) CHARACTER SET utf8 NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `fc_wants`
--

CREATE TABLE IF NOT EXISTS `fc_wants` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) NOT NULL,
  `product_id` mediumtext NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE IF NOT EXISTS `product` (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `name` varchar(30) NOT NULL,
  `price` int(5) NOT NULL,
  `description` varchar(200) NOT NULL,
  `photos` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `schedule`
--

CREATE TABLE IF NOT EXISTS `schedule` (
  `id` int(11) DEFAULT NULL,
  `data` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
