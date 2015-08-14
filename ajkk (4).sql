-- phpMyAdmin SQL Dump
-- version 4.4.12
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Aug 13, 2015 at 11:17 AM
-- Server version: 5.6.25
-- PHP Version: 5.6.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ajkk`
--

-- --------------------------------------------------------

--
-- Table structure for table `automcomplete`
--

CREATE TABLE IF NOT EXISTS `automcomplete` (
  `id` int(10) unsigned NOT NULL,
  `name` varchar(60) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `automcomplete`
--

INSERT INTO `automcomplete` (`id`, `name`) VALUES
(1, 'apple'),
(2, 'banana');

-- --------------------------------------------------------

--
-- Table structure for table `avail_flpromo`
--

CREATE TABLE IF NOT EXISTS `avail_flpromo` (
  `id` int(11) unsigned NOT NULL,
  `job_id` int(11) unsigned NOT NULL,
  `emp_id` int(10) unsigned NOT NULL,
  `promo` varchar(150) COLLATE utf8_unicode_ci DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '0' COMMENT '0 - means request, 1- means approved'
) ENGINE=InnoDB AUTO_INCREMENT=83 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `avail_flpromo`
--

INSERT INTO `avail_flpromo` (`id`, `job_id`, `emp_id`, `promo`, `status`) VALUES
(77, 141, 9, '1', 2),
(78, 141, 9, '2', 2),
(79, 141, 9, '3', 2),
(80, 141, 9, '4', 2),
(81, 141, 9, '5', 2),
(82, 141, 9, '6', 2);

-- --------------------------------------------------------

--
-- Table structure for table `avail_jobpromo`
--

CREATE TABLE IF NOT EXISTS `avail_jobpromo` (
  `id` int(11) unsigned NOT NULL,
  `job_id` int(11) unsigned NOT NULL,
  `emp_id` int(10) unsigned NOT NULL,
  `promo` varchar(150) COLLATE utf8_unicode_ci DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '0' COMMENT '0 - means request, 1- means approved'
) ENGINE=InnoDB AUTO_INCREMENT=39 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `avail_jobpromo`
--

INSERT INTO `avail_jobpromo` (`id`, `job_id`, `emp_id`, `promo`, `status`) VALUES
(30, 64, 9, '1', 2),
(31, 64, 9, '2', 2),
(32, 64, 9, '3', 2),
(33, 65, 9, '1', 2),
(34, 65, 9, '2', 2),
(36, 66, 12, '1', 0),
(37, 66, 12, '2', 0),
(38, 66, 12, '3', 0);

-- --------------------------------------------------------

--
-- Table structure for table `cmsbanner`
--

CREATE TABLE IF NOT EXISTS `cmsbanner` (
  `bannerId` int(10) unsigned NOT NULL,
  `bannerName` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `bannerPath` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `category` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `dimension` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `createdOn` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updatedOn` datetime DEFAULT NULL,
  `createdBy` int(10) unsigned NOT NULL,
  `updatedBy` int(10) unsigned DEFAULT NULL,
  `status` varchar(32) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `language` varchar(45) COLLATE utf8_unicode_ci NOT NULL DEFAULT ''
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cmsfootercontent`
--

CREATE TABLE IF NOT EXISTS `cmsfootercontent` (
  `footercontentId` int(10) unsigned NOT NULL,
  `footercontentName` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `language` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `content` text COLLATE utf8_unicode_ci NOT NULL,
  `category` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `createdOn` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updatedOn` datetime DEFAULT NULL,
  `createdBy` int(10) unsigned NOT NULL,
  `updatedBy` int(10) unsigned DEFAULT NULL,
  `status` varchar(32) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cmsnews`
--

CREATE TABLE IF NOT EXISTS `cmsnews` (
  `newsId` int(10) unsigned NOT NULL,
  `title` varchar(200) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `content` text COLLATE utf8_unicode_ci NOT NULL,
  `userId` int(10) unsigned NOT NULL DEFAULT '0',
  `date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `status` enum('0','1') COLLATE utf8_unicode_ci NOT NULL DEFAULT '0' COMMENT '0-shown, 1-disable',
  `category` enum('0','1','2','3','4','5','6','7') COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '0-(SP,1HA,HB) 1-(HP,SA,HB) 2-(HP,HA,SB) 3-(SP,SA,HB) 4-(SP,HA,SB) 5-(HP,SA,SB) 6-(SP,SA,SB) 7-(HP,HA,HB))',
  `language` varchar(45) COLLATE utf8_unicode_ci NOT NULL DEFAULT ''
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

CREATE TABLE member_additional_info(
  id int(11) unsigned NOT NULL AUTO_INCREMENT, 
  member_id int(10) unsigned NOT NULL,
  currency  varchar(10) DEFAULT NULL, 
  expected_sal int unsigned DEFAULT NULL, 
  negotiable tinyint(4) NOT NULL DEFAULT '0',
  pref_loc1 varchar(100) DEFAULT NULL,  
  pref_loc2 varchar(100) DEFAULT NULL,  
  pref_loc3 varchar(100) DEFAULT NULL,  
  overseas tinyint(4) NOT NULL DEFAULT '0',
  job_status tinyint(4) NOT NULL DEFAULT '0',
  notes varchar(255) DEFAULT NULL,  
  PRIMARY KEY (id),
  KEY idx_addi_info (js_id),
  CONSTRAINT FK_js_addinfo FOREIGN KEY (js_id) REFERENCES users(id) ON UPDATE CASCADE ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `cmsnews`
--

INSERT INTO `cmsnews` (`newsId`, `title`, `content`, `userId`, `date`, `status`, `category`, `language`) VALUES
(1, 'PartyPoker revise revenue numbers', 'GIBRALTAR -- Bwin Party Digital, owners of PartyPoker, announced a warning that annual revenue may not prove as high as expectations, The Guardian reported.\n\nExpectations were in the €618m-€630m while the reality may now be closer to €608m and €612m, according to The Guardian report.', 1, '2015-01-05 07:37:34', '0', '0', 'en'),
(2, 'First time fall for Macau''s yearly gambling revenue', 'MACAO -- Macau has had its first brush with annual revenue decline, after a thumping series of revenue-climbing years, the BBC reported.\r\n\r\nIn 2014 revenue declined 2.6%, while December saw a startling decline of 30.4% when compared to the same month in 2013, the report said.\r\n\r\nThe revenue fall has been attributed to China''s clampdown on corruption, the BBC said.', 1, '2015-01-05 07:54:54', '0', '1', 'en'),
(3, 'Russia: Putin curbs illegal gambling', 'RUSSIA -- Russia is clamping down on illegal gambling with new legislation that covers both land and online gambling, RASPI reported.\r\n\r\nThe bill, signed by Vladimir Putin recently, will see new fines and consequences introduced that will penalize violators, the report explained.\r\n\r\nLast July another bill was passed which approved designated gambling zones in Crimea, RAPSI noted.', 1, '2015-01-05 07:54:59', '0', '2', 'en'),
(4, 'Impact study of Michigan casinos shows 17,000 jobs created in 2013', 'MICHIGAN -- 17,000 jobs were created as a result of the casino industry in Michigan during 2013, according to the Detroit Free Press.\r\n\r\nThe figures were revealed in an impact study on the gaming industry''s impact in Michigan during 2013, the report explained.\r\n\r\nGaming industry tax revenue from the 26 casinos (23 of which are tribal casinos) to state coffers was $730 million, the Detroit Free Press reported.', 1, '2015-01-05 08:02:15', '0', '3', 'en'),
(5, 'The Reel Life: PlayStation police edition', 'what do you do when your online video game network briefly goes down? Call the good ol'' boys in blue, of course.\r\n\r\nGamers were unable to play on Sony''s PlayStation network for a full three days around Christmas this year, and one gamer even took to dialing 911 and asking the Palm Beach County Sheriff''s Office for assistance. In the 911 call, the caller references the PlayStation network, then says, "I was wondering, do you guys know anything about that."\r\n\r\nSony was hacked over the holidays by what many people believe to be North Korea. Are you thinking what I''m thinking? Exactly: This sounds like a job for the Palm Beach County Sheriff.', 1, '2015-01-05 10:55:46', '0', '4', 'en'),
(6, 'Suffolk Downs could see reprieve if House moves on bill', 'BOSTON, Massachusetts -- Suffolk Downs could see a reprieve if the House votes to approve a bill that permit simulcasting until July 2016, The Boston Globe reported.\r\n\r\nLive racing ended at the racetrack in October 2014, the report said.\r\n\r\nThe Senate has approved the bill, but the House legislative sessions ends next week so legislators would need to step on it to approve the bill in time, according to the Boston Globe report.', 1, '2015-01-05 10:56:12', '0', '5', 'en'),
(7, 'News 1', 'test', 1, '2015-01-06 07:26:00', '0', '0', 'en'),
(9, 'Test', 'Test', 1, '2015-03-04 21:34:20', '0', '6', 'en'),
(10, 'SAMPLE', 'HEY hahaha', 1, '2015-03-16 17:14:09', '0', '6', 'ch'),
(11, 'test', 'test', 1, '2015-03-18 15:13:55', '0', '0', 'ch');

-- --------------------------------------------------------

--
-- Table structure for table `country`
--

CREATE TABLE IF NOT EXISTS `country` (
  `countryId` int(10) NOT NULL,
  `name` varchar(32) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=250 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `country`
--

INSERT INTO `country` (`countryId`, `name`) VALUES
(1, 'Afghanistan'),
(2, 'Aland Islands'),
(3, 'Albania'),
(4, 'Algeria'),
(5, 'American Samoa'),
(6, 'Andorra'),
(7, 'Angola'),
(8, 'Anguilla'),
(9, 'Antarctica'),
(10, 'Antigua and Barbuda'),
(11, 'Argentina'),
(12, 'Armenia'),
(13, 'Aruba'),
(14, 'Australia'),
(15, 'Austria'),
(16, 'Azerbaijan'),
(17, 'Bahamas'),
(18, 'Bahrain'),
(19, 'Bangladesh'),
(20, 'Barbados'),
(21, 'Belarus'),
(22, 'Belgium'),
(23, 'Belize'),
(24, 'Benin'),
(25, 'Bermuda'),
(26, 'Bhutan'),
(27, 'Bolivia'),
(28, 'Bonaire, San Eustaquio and Saba'),
(29, 'Bosnia and Herzegovina'),
(30, 'Botswana'),
(31, 'Bouvet Island'),
(32, 'Brazil'),
(33, 'British Indian Ocean Territory'),
(34, 'Brunei Darussalam'),
(35, 'Bulgaria'),
(36, 'Burkina Faso'),
(37, 'Burundi'),
(38, 'Caicos and Turcas Islands'),
(39, 'Cambodia'),
(40, 'Cameroon'),
(41, 'Canada'),
(42, 'Cape Verde'),
(43, 'Cayman Islands'),
(44, 'Central African Republic'),
(45, 'Chad'),
(46, 'Chile'),
(47, 'China'),
(48, 'Christmas Island'),
(49, 'Cocos Islands'),
(50, 'Colombia'),
(51, 'Comoros'),
(52, 'Congo'),
(53, 'Congo, Democratic Republic of th'),
(54, 'Cook Islands'),
(55, 'Costa Rica'),
(56, 'Croatia'),
(57, 'Cuba'),
(58, 'Curacao'),
(59, 'Cyprus'),
(60, 'Czech Republic'),
(61, 'Denmark'),
(62, 'Dominica'),
(63, 'Dominican Republic'),
(64, 'Ecuador'),
(65, 'Egypt'),
(66, 'El Salvador'),
(67, 'Equatorial Guinea'),
(68, 'Eritrea'),
(69, 'Estonia'),
(70, 'Ethiopia'),
(71, 'Feroe Islands'),
(72, 'Fiji'),
(73, 'Finland'),
(74, 'France'),
(75, 'French Guiana'),
(76, 'French Polynesia'),
(77, 'French Southern Territories'),
(78, 'Gabon'),
(79, 'Gambia'),
(80, 'Georgia'),
(81, 'Germany'),
(82, 'Ghana'),
(83, 'Gibraltar'),
(84, 'Granada'),
(85, 'Greece'),
(86, 'Greenland'),
(87, 'Guadeloupe'),
(88, 'Guam'),
(89, 'Guatemala'),
(90, 'Guernsey'),
(91, 'Guinea'),
(92, 'Guinea-Bissau'),
(93, 'Guyana'),
(94, 'Haiti'),
(95, 'Heard Island and Mcdonald Island'),
(96, 'Honduras'),
(97, 'Hong Kong'),
(98, 'Hungary'),
(99, 'Iceland'),
(100, 'India'),
(101, 'Indonesia'),
(102, 'Iran'),
(103, 'Iraq'),
(104, 'Ireland'),
(105, 'Isle of Man'),
(106, 'Israel'),
(107, 'Italy'),
(108, 'Ivory Coast'),
(109, 'Jamaica'),
(110, 'Japan'),
(111, 'Jersey'),
(112, 'Jordan'),
(113, 'Kazakhstan'),
(114, 'Kenya'),
(115, 'Kirguistan'),
(116, 'Kiribati'),
(117, 'Korea'),
(118, 'Kuwait'),
(119, 'Lao'),
(120, 'Latvia'),
(121, 'Lebanon'),
(122, 'Lesotho'),
(123, 'Liberia'),
(124, 'Libya'),
(125, 'Liechtenstein'),
(126, 'Lithuania'),
(127, 'Luxembourg'),
(128, 'Macau'),
(129, 'Macedonia'),
(130, 'Madagascar'),
(131, 'Malawi'),
(132, 'Malaysia'),
(133, 'Maldives'),
(134, 'Maldives'),
(135, 'Mali'),
(136, 'Malta'),
(137, 'Marshall Islands'),
(138, 'Martinique'),
(139, 'Mauritania'),
(140, 'Mauritius'),
(141, 'Mayotte'),
(142, 'Mexico'),
(143, 'Micronesia'),
(144, 'Moldova'),
(145, 'Monaco'),
(146, 'Mongolia'),
(147, 'Montenegro'),
(148, 'Montserrat'),
(149, 'Morocco'),
(150, 'Mozambique'),
(151, 'Myanmar'),
(152, 'Namibia'),
(153, 'Nauru'),
(154, 'Nepal'),
(155, 'Netherlands'),
(156, 'New Caledonia'),
(157, 'New Zealand'),
(158, 'Nicaragua'),
(159, 'Níger'),
(160, 'Nigeria'),
(161, 'Niue'),
(162, 'Norfolk Island'),
(163, 'North Korea'),
(164, 'Northern Mariana'),
(165, 'Norway'),
(166, 'Oman'),
(167, 'Pakistan'),
(168, 'Palau'),
(169, 'Palestina'),
(170, 'Panama'),
(171, 'Papua New Guinea'),
(172, 'Paraguay'),
(173, 'Peru'),
(174, 'Pitcairn'),
(175, 'Poland'),
(176, 'Portugal'),
(177, 'Puerto Rico'),
(178, 'Qatar'),
(179, 'Reunion'),
(180, 'Rumania'),
(181, 'Russia'),
(182, 'Rwanda'),
(183, 'Saint Bartolomé'),
(184, 'Saint Helena'),
(185, 'Saint Kitts and Nevis'),
(186, 'Saint Lucia'),
(187, 'Saint Pierre and Miquelon'),
(188, 'Saint Vincent and the Grenadines'),
(189, 'Salomon Islands'),
(190, 'Samoa'),
(191, 'San Marino'),
(192, 'San Martin'),
(193, 'Sao Tome and Principe'),
(194, 'Saudi Arabia'),
(195, 'Senegal'),
(196, 'Serbia'),
(197, 'Seychelles'),
(198, 'Sierra Leone'),
(199, 'Singapore'),
(200, 'Sint Maarten'),
(201, 'Slovakia'),
(202, 'Slovenia'),
(203, 'Somalia'),
(204, 'South Africa'),
(205, 'South Georgia and the South Sand'),
(206, 'South of Sudan'),
(207, 'Spain'),
(208, 'Sri Lanka'),
(209, 'Sudan'),
(210, 'Suriname'),
(211, 'Svalbard and Jan Mayen'),
(212, 'Swaziland'),
(213, 'Sweden'),
(214, 'Switzerland'),
(215, 'Syria'),
(216, 'Taiwan'),
(217, 'Tajikistan'),
(218, 'Tanzania'),
(219, 'Thailand'),
(220, 'Timor-Leste'),
(221, 'Togo'),
(222, 'Tokelau'),
(223, 'Tonga'),
(224, 'Trinidad and Tobago'),
(225, 'Tunisia'),
(226, 'Turkey'),
(227, 'Turkmenistan'),
(228, 'Tuvalu'),
(229, 'Uganda'),
(230, 'Ukraine'),
(231, 'United Arab Emirates'),
(232, 'United Kingdom'),
(233, 'United States'),
(234, 'United States Minor Outlying Isl'),
(235, 'Uzbekistan'),
(236, 'Thailand'),
(237, 'Vanuatu'),
(238, 'Vaticano'),
(239, 'Venezuela'),
(240, 'Vietnam'),
(241, 'Virgin Islands of the United Kin'),
(242, 'Virgin Islands of the United Sta'),
(243, 'Wallis and Futuna'),
(244, 'Western Sahara'),
(245, 'Yemen'),
(246, 'Yibuti'),
(247, 'Zambia'),
(248, 'Zimbabwe'),
(249, 'Philippines');

-- --------------------------------------------------------

--
-- Table structure for table `employer`
--

CREATE TABLE IF NOT EXISTS `employer` (
  `employerId` int(10) unsigned NOT NULL,
  `username` varchar(100) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `password` varchar(100) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `active` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `email` varchar(250) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `secretQuestion` varchar(100) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `secretAnswer` varchar(100) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `lastLoginIp` varchar(15) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `registerIp` varchar(15) COLLATE utf8_unicode_ci DEFAULT NULL,
  `registerLocation` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `lastLoginTime` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `lastLogoutTime` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `createdOn` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updatedOn` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `blocked` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `blockedUntil` int(11) unsigned NOT NULL DEFAULT '0',
  `blockedAfter` int(11) unsigned NOT NULL DEFAULT '0',
  `verify` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `lockedStart` datetime DEFAULT '0000-00-00 00:00:00',
  `lockedEnd` datetime DEFAULT '0000-00-00 00:00:00',
  `status` int(1) NOT NULL DEFAULT '0' COMMENT '0 - normal; 1 - frozen, 2 - locked',
  `online` int(1) NOT NULL DEFAULT '1' COMMENT '0 - online; 1 - offline;'
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `employer`
--

INSERT INTO `employer` (`employerId`, `username`, `password`, `active`, `email`, `secretQuestion`, `secretAnswer`, `lastLoginIp`, `registerIp`, `registerLocation`, `lastLoginTime`, `lastLogoutTime`, `createdOn`, `updatedOn`, `blocked`, `blockedUntil`, `blockedAfter`, `verify`, `lockedStart`, `lockedEnd`, `status`, `online`) VALUES
(7, 'testemp1@gmail.com', '$P$BgO950IfIf.3CDRzc7AJgMCrtyEufw1', 0, 'testemp1@gmail.com', '', '', '127.0.0.1', '127.0.0.1', ',', '2015-08-08 06:46:44', '0000-00-00 00:00:00', '2015-03-28 18:36:24', '0000-00-00 00:00:00', 0, 0, 0, 'JVadXU8T9Hl0Yq27163kWotDyNnwsvEm', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 1),
(8, 'test12345@gmail.com', '$P$BZMBFJ6XfQmBjlA8aUeFJt3H/0C4Vj.', 0, 'test12345@gmail.com', '', '', '', '127.0.0.1', ',', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '2015-03-29 22:13:33', '0000-00-00 00:00:00', 0, 0, 0, 'Gmjne3Uch9Mut2IWFRfQlAgoTpqN7Y1X', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 1),
(9, 'test123456@gmail.com', '$P$B24qnPG00P8qEYAelV9gxE2jJvpaZS.', 0, 'test123456@gmail.com', '', '', '127.0.0.1', '127.0.0.1', ',', '2015-04-28 12:41:30', '0000-00-00 00:00:00', '2015-03-29 23:22:45', '0000-00-00 00:00:00', 0, 0, 0, 'Yl43kOyhrINx5GzgKMDJoL9ZpfXHisRB', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 1),
(10, 'test1234567@gmail.com', '$P$BNHJH7rhiChY.XyQp2peGBlMDN0T0X1', 0, 'test1234567@gmail.com', '', '', '127.0.0.1', '127.0.0.1', ',', '2004-12-31 22:35:32', '0000-00-00 00:00:00', '2015-03-29 23:26:18', '0000-00-00 00:00:00', 0, 0, 0, 'GigFYNbCwLuj3np1WX2DsoUdc47kart9', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 1),
(11, 'testemp2@gmail.com', '$P$B5Il3unsqnt/8V4FQywQ.dBwgi0g5l1', 0, 'testemp2@gmail.com', '', '', '', '127.0.0.1', ',', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '2015-03-30 04:47:03', '0000-00-00 00:00:00', 0, 0, 0, '70R1ZqsfDjQPOchSL6IA8UJTmbt3KVlk', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 1),
(12, 'testemp321@gmail.com', '$P$BHG9bKPMpTa5xARdcpObjrW4OQjd11.', 0, 'testemp321@gmail.com', '', '', '127.0.0.1', '127.0.0.1', ',', '2015-04-30 09:54:17', '0000-00-00 00:00:00', '2015-04-28 10:55:51', '0000-00-00 00:00:00', 0, 0, 0, 'wg4E9xPak6efoVdzMyu8JBbXi1rYtWUl', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `employer_details`
--

CREATE TABLE IF NOT EXISTS `employer_details` (
  `id` int(10) unsigned NOT NULL,
  `emp_id` int(10) unsigned NOT NULL,
  `comp_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `comp_desc` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `comp_nature` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL,
  `comp_type` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL,
  `address` varchar(64) COLLATE utf8_unicode_ci DEFAULT NULL,
  `city` varchar(64) COLLATE utf8_unicode_ci DEFAULT NULL,
  `state` varchar(64) COLLATE utf8_unicode_ci DEFAULT NULL,
  `country` varchar(2) COLLATE utf8_unicode_ci DEFAULT NULL,
  `zipcode` varchar(32) COLLATE utf8_unicode_ci DEFAULT NULL,
  `phone` varchar(32) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `fax` varchar(32) COLLATE utf8_unicode_ci DEFAULT NULL,
  `business_regno` varchar(32) COLLATE utf8_unicode_ci DEFAULT NULL,
  `organization` varchar(64) COLLATE utf8_unicode_ci DEFAULT NULL,
  `comp_size` int(10) DEFAULT NULL,
  `dress_code` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `working_hrs` varchar(255) CHARACTER SET utf32 COLLATE utf32_unicode_ci DEFAULT NULL,
  `spoken_lang` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `website` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `contact_person` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `contact_person_mobilenum` varchar(32) COLLATE utf8_unicode_ci DEFAULT NULL,
  `is_removed` tinyint(4) NOT NULL DEFAULT '0'
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `employer_details`
--

INSERT INTO `employer_details` (`id`, `emp_id`, `comp_name`, `comp_desc`, `comp_nature`, `comp_type`, `address`, `city`, `state`, `country`, `zipcode`, `phone`, `email`, `fax`, `business_regno`, `organization`, `comp_size`, `dress_code`, `working_hrs`, `spoken_lang`, `website`, `contact_person`, `contact_person_mobilenum`, `is_removed`) VALUES
(9, 7, 'Test 1243', 'dasdasdsa', 'Asdasd', 'Asdasd', 'asdasdasd', 'Asdasd', 'Nothern Mindanao', 'So', '32131', '12312', 'Testemp1@gmail.com', '132312', '3213', 'Fdasfdasf', 1, '1', '1', '1', '234', '12313', '123123', 0),
(10, 8, 'Test12345', 'asdas das as as', 'D Asds Das', 'Das Das Das', 'sdadas asd', 'Das Dasd Asd', 'Calabarzon', 'C.', '1321', '2131231', 'Test12345@gmail.com', '132123', '12312312', 'Fasdfdas', 1, '1', '1', '1', 'Dsafasf', 'Test 12345', '2313', 0),
(11, 9, 'Test123456', 'test', '17', '2', 'testset', 'Makati', 'Bicol Region', 'Bi', '234', '23424242', 'Test123456@gmail.com', '2423423', '234324', 'OG', 1, '1', '1', '1', 'www.hindot.com', 'Teteste As Aes', '12314324', 0),
(12, 10, 'FFFFFFD', 'dfdas ds das fd dsa das das ds fds ds fdsa fdsjklj dslkdhs jdsahkjl sjdf hlkj hjdash dska hfdsklhdsklhf klds fldsk hfjdslh kds fkl fdhs flhkjl hdhs dhs fhas f kdsahfds fss lds sdlfdhs aas fasklds hf jdskl hsdaf dsfhs fjdhas klfhslkj hljakj hfldskajhf dasl', '1', '2', 'ayala ave makati', 'Makati', 'C.A.R', 'Ca', '12313', '123131', 'Test1234567@gmail.com', '12312312', '123123213', 'MM', 1, '1', '1', '1', 'www.jobkonek.com', 'Sdafasdf', '2131232312', 0),
(13, 11, 'Testemp', 'fdafs fasdf asd fasd fdsa fdsj l;j;sj fsad; fdk;j fkdsa fsd\r\ns fsdaf dslk;fadjsl fhjdsah lfsdj fsadf', '5', '4', 'adf dfadsdsaf asdf sadf asdfsad fsdaf dsaf dsa fasd fd', 'Dfddfsaf', 'Bicol Region', 'We', '32321', '2314232342314', 'Testemp2@gmail.com', '21341', '2141241', 'Dsfgsdfgds', 1, '1', '1', '1', 'www.jobkonek.com', 'Testcp', '12312312', 0),
(14, 12, 'Testemp', 'sdsadsadasd', '2', '1', 'fdsaf', 'Asdfdafa', 'Bicol Region', '24', '23424', '23424', 'Testemp321@gmail.com', '234324', '234234', 'Dsfdsfsda', 6, '2', '4', '3', 'www.test.com', 'Me', '123131', 0);

-- --------------------------------------------------------

--
-- Table structure for table `employer_media`
--

CREATE TABLE IF NOT EXISTS `employer_media` (
  `empMediaId` int(10) unsigned NOT NULL,
  `mediaName` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `mediaPath` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `mediaCategory` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `dimension` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `createdOn` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updatedOn` datetime DEFAULT NULL,
  `createdBy` int(10) unsigned NOT NULL,
  `updatedBy` int(10) unsigned DEFAULT NULL,
  `status` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `emp_id` int(10) unsigned DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `employer_media`
--

INSERT INTO `employer_media` (`empMediaId`, `mediaName`, `mediaPath`, `mediaCategory`, `dimension`, `createdOn`, `updatedOn`, `createdBy`, `updatedBy`, `status`, `emp_id`) VALUES
(1, 'complogo-7-GiDx45W.', '', 'comp_logo', '', '2015-03-29 21:22:06', NULL, 0, NULL, 'active', 7),
(2, 'complogo-7-Pjpw3uH.', '', 'comp_logo', '', '2015-03-29 21:24:21', NULL, 0, NULL, 'active', 7),
(3, 'complogo-7-MEcJ34t.', '', 'comp_logo', '', '2015-03-29 21:27:14', NULL, 0, NULL, 'active', 7),
(4, 'complogo-8.jpg', '', 'comp_logo', '', '2015-03-29 23:14:13', NULL, 0, NULL, 'active', 8),
(5, 'complogo-9.jpg', '', 'comp_logo', '', '2015-04-28 10:33:08', NULL, 0, NULL, 'active', 9),
(6, 'complogo-10.jpg', '', 'comp_logo', '', '2015-03-29 23:41:47', NULL, 0, NULL, 'active', 10),
(7, 'complogo-11.jpg', '', 'comp_logo', '', '2015-03-30 05:53:08', NULL, 0, NULL, 'active', 11),
(8, '', '', 'comp_logo', '', '2015-04-28 10:55:53', NULL, 0, NULL, 'active', 12);

-- --------------------------------------------------------

--
-- Table structure for table `employer_membership`
--

CREATE TABLE IF NOT EXISTS `employer_membership` (
  `id` int(11) unsigned NOT NULL,
  `emp_id` int(11) unsigned NOT NULL,
  `membership_type` tinyint(4) NOT NULL DEFAULT '0',
  `jobpost_activation_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `jobpost_expiration_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `employer_membership`
--

INSERT INTO `employer_membership` (`id`, `emp_id`, `membership_type`, `jobpost_activation_date`, `jobpost_expiration_date`) VALUES
(8, 7, 0, '2015-03-29 01:36:24', '2015-04-29 01:36:24'),
(9, 8, 0, '2015-03-30 04:13:34', '2015-04-30 04:13:34'),
(10, 9, 0, '2015-03-30 05:22:47', '2015-04-30 05:22:47'),
(11, 10, 0, '2015-03-30 05:26:18', '2015-04-30 05:26:18'),
(12, 11, 0, '2015-03-30 10:47:16', '2015-04-30 10:47:16'),
(13, 12, 0, '2015-04-28 16:55:53', '2015-05-28 16:55:53');

-- --------------------------------------------------------

--
-- Table structure for table `employer_self`
--

CREATE TABLE IF NOT EXISTS `employer_self` (
  `id` int(10) unsigned NOT NULL,
  `emp_id` int(10) unsigned NOT NULL,
  `color` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `theme` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `employees_num` int(10) unsigned DEFAULT NULL,
  `bldg_type` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `floor_num` int(10) unsigned DEFAULT NULL,
  `whyworkwithus` text COLLATE utf8_unicode_ci,
  `dresscode` text COLLATE utf8_unicode_ci,
  `location_coordinates` float DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `employer_self`
--

INSERT INTO `employer_self` (`id`, `emp_id`, `color`, `theme`, `employees_num`, `bldg_type`, `floor_num`, `whyworkwithus`, `dresscode`, `location_coordinates`) VALUES
(8, 7, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(9, 8, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(10, 9, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(11, 10, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(12, 11, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(13, 12, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `emp_notification`
--

CREATE TABLE IF NOT EXISTS `emp_notification` (
  `id` int(10) unsigned NOT NULL,
  `emp_id` int(10) unsigned NOT NULL,
  `notify_byemail` tinyint(4) NOT NULL DEFAULT '0',
  `notify_newsletter` tinyint(4) NOT NULL DEFAULT '0',
  `notify_bymobile` tinyint(4) NOT NULL DEFAULT '0'
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `emp_notification`
--

INSERT INTO `emp_notification` (`id`, `emp_id`, `notify_byemail`, `notify_newsletter`, `notify_bymobile`) VALUES
(8, 7, 0, 0, 0),
(9, 8, 0, 0, 0),
(10, 9, 0, 0, 0),
(11, 10, 0, 0, 0),
(12, 11, 0, 0, 0),
(13, 12, 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `freelancejob_applicant`
--

CREATE TABLE IF NOT EXISTS `freelancejob_applicant` (
  `jobApplicantId` int(10) unsigned NOT NULL,
  `fljobId` int(10) unsigned NOT NULL,
  `empId` int(10) unsigned NOT NULL,
  `applicantId` int(11) unsigned NOT NULL,
  `applied_on` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `candidate_status` int(1) DEFAULT '0' COMMENT '0-apply,1-shorlisted,2-for interview,3-unqualified'
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `freelancejob_applicant`
--

INSERT INTO `freelancejob_applicant` (`jobApplicantId`, `fljobId`, `empId`, `applicantId`, `applied_on`, `candidate_status`) VALUES
(1, 113, 9, 5, '2015-04-24 15:08:50', 4),
(2, 113, 9, 4, '2015-04-24 15:08:50', 0),
(3, 113, 9, 3, '2015-04-24 15:08:50', 1),
(4, 113, 9, 8, '2015-04-24 15:08:50', 1),
(5, 113, 9, 6, '2015-04-29 19:12:42', 0),
(6, 114, 9, 6, '2015-04-29 19:13:11', 0),
(7, 119, 9, 6, '2015-04-29 19:22:50', 0),
(8, 123, 9, 6, '2015-04-29 19:22:54', 0);

-- --------------------------------------------------------

--
-- Table structure for table `freelancejob_apply`
--

CREATE TABLE IF NOT EXISTS `freelancejob_apply` (
  `id` int(11) unsigned NOT NULL,
  `flJobId` int(11) unsigned NOT NULL,
  `member_id` int(10) unsigned NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '0' COMMENT '0 - apply, 1- shortlisted/underconsideration, 2- sked interview, 3- not qualified, 4- job is close',
  `logtime` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `freelancejob_apply`
--

INSERT INTO `freelancejob_apply` (`id`, `flJobId`, `member_id`, `status`, `logtime`) VALUES
(1, 115, 7, 0, '2015-04-19 22:21:25'),
(2, 115, 7, 0, '2015-04-19 22:21:25'),
(3, 115, 7, 0, '2015-04-19 22:21:25'),
(4, 116, 7, 0, '2015-04-19 22:21:25'),
(5, 118, 7, 0, '2015-04-19 22:21:25'),
(6, 119, 7, 0, '2015-04-19 22:21:25'),
(8, 114, 7, 0, '2015-04-19 22:21:25');

-- --------------------------------------------------------

--
-- Table structure for table `freelancejob_save`
--

CREATE TABLE IF NOT EXISTS `freelancejob_save` (
  `id` int(11) unsigned NOT NULL,
  `flJobId` int(11) unsigned NOT NULL,
  `member_id` int(10) unsigned NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '0' COMMENT '0 - apply, 1- shortlisted/underconsideration, 2- sked interview, 3- not qualified, 4- job is close',
  `logtime` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `freelancejob_save`
--

INSERT INTO `freelancejob_save` (`id`, `flJobId`, `member_id`, `status`, `logtime`) VALUES
(5, 115, 7, 0, '2015-04-19 22:22:07'),
(6, 116, 7, 0, '2015-04-19 22:22:07'),
(8, 113, 7, 0, '2015-04-19 22:22:07'),
(9, 114, 7, 0, '2015-04-19 22:22:07'),
(10, 113, 6, 0, '2015-04-29 17:53:59');

-- --------------------------------------------------------

--
-- Table structure for table `freelance_job`
--

CREATE TABLE IF NOT EXISTS `freelance_job` (
  `fljobId` int(11) unsigned NOT NULL,
  `joborderid` varchar(60) COLLATE utf8_unicode_ci DEFAULT NULL,
  `emp_id` int(11) unsigned NOT NULL,
  `project_name` varchar(64) COLLATE utf8_unicode_ci DEFAULT NULL,
  `project_overview` text COLLATE utf8_unicode_ci,
  `project_type` varchar(64) COLLATE utf8_unicode_ci DEFAULT NULL,
  `payment_currency` varchar(64) COLLATE utf8_unicode_ci DEFAULT NULL,
  `payment_type` tinyint(4) NOT NULL DEFAULT '1',
  `min_budget` double NOT NULL DEFAULT '0',
  `max_budget` double NOT NULL DEFAULT '0',
  `project_duration` tinyint(4) NOT NULL DEFAULT '0',
  `hrs_work` int(10) NOT NULL DEFAULT '0',
  `project_duration_per` tinyint(4) NOT NULL DEFAULT '0',
  `created_on` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_on` date DEFAULT NULL,
  `activation_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `expiration_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `is_taken` tinyint(4) NOT NULL DEFAULT '0' COMMENT '0 means not taken, 1 means taken',
  `is_approved` tinyint(2) NOT NULL DEFAULT '0',
  `is_removed` tinyint(4) NOT NULL DEFAULT '0'
) ENGINE=InnoDB AUTO_INCREMENT=142 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `freelance_job`
--

INSERT INTO `freelance_job` (`fljobId`, `joborderid`, `emp_id`, `project_name`, `project_overview`, `project_type`, `payment_currency`, `payment_type`, `min_budget`, `max_budget`, `project_duration`, `hrs_work`, `project_duration_per`, `created_on`, `updated_on`, `activation_date`, `expiration_date`, `is_taken`, `is_approved`, `is_removed`) VALUES
(113, 'JKFJ-9-50G', 9, 'php', 'We have an exisiting website but would like to a a couple of gallery pages, we can create almost what we want using adobe bridge galleries, but we can not integrate this in out website and would like a) the knowledge to, or someone to do this (if possible), or b) an alternative to this process i.e a way of easily uploading and editing images to a gallery page within our site.\r\n\r\nThe gallery interface and how we would like it to work (as I said this was done in adobe bridge) that we like is at   [obscured]   and I enclosed a jpg visual of how this would sit on our website.', '1', '1', 1, 40000, 50000, 1, 30, 1, '2015-04-17 16:35:00', '2015-04-17', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 1, 0),
(114, 'JKFJ-9-50G', 9, 'Company Website 2', 'We have an exisiting website but would like to a a couple of gallery pages, we can create almost what we want using adobe bridge galleries, but we can not integrate this in out website and would like a) the knowledge to, or someone to do this (if possible), or b) an alternative to this process i.e a way of easily uploading and editing images to a gallery page within our site.\r\n\r\nThe gallery interface and how we would like it to work (as I said this was done in adobe bridge) that we like is at   [obscured]   and I enclosed a jpg visual of how this would sit on our website.', '1', '1', 1, 4000, 500, 1, 30, 1, '2015-04-17 16:35:00', '2015-04-17', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 1, 0),
(115, 'JKFJ-9-50G', 9, 'php 2', 'We have an exisiting website but would like to a a couple of gallery pages, we can create almost what we want using adobe bridge galleries, but we can not integrate this in out website and would like a) the knowledge to, or someone to do this (if possible), or b) an alternative to this process i.e a way of easily uploading and editing images to a gallery page within our site.\r\n\r\nThe gallery interface and how we would like it to work (as I said this was done in adobe bridge) that we like is at   [obscured]   and I enclosed a jpg visual of how this would sit on our website.', '1', '1', 1, 60000, 90000, 1, 30, 1, '2015-04-17 16:35:00', NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 1, 0),
(116, 'JKFJ-9-50G', 9, 'Company Website 4', 'We have an exisiting website but would like to a a couple of gallery pages, we can create almost what we want using adobe bridge galleries, but we can not integrate this in out website and would like a) the knowledge to, or someone to do this (if possible), or b) an alternative to this process i.e a way of easily uploading and editing images to a gallery page within our site.\r\n\r\nThe gallery interface and how we would like it to work (as I said this was done in adobe bridge) that we like is at   [obscured]   and I enclosed a jpg visual of how this would sit on our website.', '1', '1', 1, 50000, 70000, 1, 30, 1, '2015-04-17 16:35:00', NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 1, 0),
(117, 'JKFJ-9-50G', 9, 'c2', 'We have an exisiting website but would like to a a couple of gallery pages, we can create almost what we want using adobe bridge galleries, but we can not integrate this in out website and would like a) the knowledge to, or someone to do this (if possible), or b) an alternative to this process i.e a way of easily uploading and editing images to a gallery page within our site.\r\n\r\nThe gallery interface and how we would like it to work (as I said this was done in adobe bridge) that we like is at   [obscured]   and I enclosed a jpg visual of how this would sit on our website.', '1', '1', 1, 400, 500, 1, 30, 1, '2015-04-17 16:35:00', NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 1, 0),
(118, 'JKFJ-9-50G', 9, 'Company Website 6', 'We have an exisiting website but would like to a a couple of gallery pages, we can create almost what we want using adobe bridge galleries, but we can not integrate this in out website and would like a) the knowledge to, or someone to do this (if possible), or b) an alternative to this process i.e a way of easily uploading and editing images to a gallery page within our site.\r\n\r\nThe gallery interface and how we would like it to work (as I said this was done in adobe bridge) that we like is at   [obscured]   and I enclosed a jpg visual of how this would sit on our website.', '1', '1', 1, 400, 500, 1, 30, 1, '2015-04-17 16:35:00', NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 1, 0),
(119, 'JKFJ-9-50G', 9, 'c 4', 'We have an exisiting website but would like to a a couple of gallery pages, we can create almost what we want using adobe bridge galleries, but we can not integrate this in out website and would like a) the knowledge to, or someone to do this (if possible), or b) an alternative to this process i.e a way of easily uploading and editing images to a gallery page within our site.\r\n\r\nThe gallery interface and how we would like it to work (as I said this was done in adobe bridge) that we like is at   [obscured]   and I enclosed a jpg visual of how this would sit on our website.', '1', '1', 1, 400, 500, 1, 30, 1, '2015-04-17 16:35:00', NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 1, 0),
(123, 'JKFJ-9-50G', 9, 'Company Website 9', 'We have an exisiting website but would like to a a couple of gallery pages, we can create almost what we want using adobe bridge galleries, but we can not integrate this in out website and would like a) the knowledge to, or someone to do this (if possible), or b) an alternative to this process i.e a way of easily uploading and editing images to a gallery page within our site.\r\n\r\nThe gallery interface and how we would like it to work (as I said this was done in adobe bridge) that we like is at   [obscured]   and I enclosed a jpg visual of how this would sit on our website.', '1', '1', 1, 400, 500, 1, 30, 1, '2015-04-17 16:35:00', NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 1, 0),
(124, 'JKFJ-9-50G', 9, 'Company Website 10', 'We have an exisiting website but would like to a a couple of gallery pages, we can create almost what we want using adobe bridge galleries, but we can not integrate this in out website and would like a) the knowledge to, or someone to do this (if possible), or b) an alternative to this process i.e a way of easily uploading and editing images to a gallery page within our site.\r\n\r\nThe gallery interface and how we would like it to work (as I said this was done in adobe bridge) that we like is at   [obscured]   and I enclosed a jpg visual of how this would sit on our website.', '1', '1', 1, 400, 500, 1, 30, 1, '2015-04-17 16:35:00', NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 1, 0),
(125, 'JKFJ-9-50G', 9, 'Company Website 11', 'We have an exisiting website but would like to a a couple of gallery pages, we can create almost what we want using adobe bridge galleries, but we can not integrate this in out website and would like a) the knowledge to, or someone to do this (if possible), or b) an alternative to this process i.e a way of easily uploading and editing images to a gallery page within our site.\r\n\r\nThe gallery interface and how we would like it to work (as I said this was done in adobe bridge) that we like is at   [obscured]   and I enclosed a jpg visual of how this would sit on our website.', '1', '1', 1, 400, 500, 1, 30, 1, '2015-04-17 16:35:00', NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 1, 0),
(126, 'JKFJ-9-50G', 9, 'Company Website 12', 'We have an exisiting website but would like to a a couple of gallery pages, we can create almost what we want using adobe bridge galleries, but we can not integrate this in out website and would like a) the knowledge to, or someone to do this (if possible), or b) an alternative to this process i.e a way of easily uploading and editing images to a gallery page within our site.\r\n\r\nThe gallery interface and how we would like it to work (as I said this was done in adobe bridge) that we like is at   [obscured]   and I enclosed a jpg visual of how this would sit on our website.', '1', '1', 1, 400, 500, 1, 30, 1, '2015-04-17 16:35:00', NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 1, 0),
(127, 'JKFJ-9-50G', 9, 'Company Website 13', 'We have an exisiting website but would like to a a couple of gallery pages, we can create almost what we want using adobe bridge galleries, but we can not integrate this in out website and would like a) the knowledge to, or someone to do this (if possible), or b) an alternative to this process i.e a way of easily uploading and editing images to a gallery page within our site.\r\n\r\nThe gallery interface and how we would like it to work (as I said this was done in adobe bridge) that we like is at   [obscured]   and I enclosed a jpg visual of how this would sit on our website.', '1', '1', 1, 400, 500, 1, 30, 1, '2015-04-17 16:35:00', NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 1, 0),
(128, 'JKFJ-9-50G', 9, 'Company Website 14', 'We have an exisiting website but would like to a a couple of gallery pages, we can create almost what we want using adobe bridge galleries, but we can not integrate this in out website and would like a) the knowledge to, or someone to do this (if possible), or b) an alternative to this process i.e a way of easily uploading and editing images to a gallery page within our site.\r\n\r\nThe gallery interface and how we would like it to work (as I said this was done in adobe bridge) that we like is at   [obscured]   and I enclosed a jpg visual of how this would sit on our website.', '1', '1', 1, 400, 500, 1, 30, 1, '2015-04-17 16:35:00', NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 1, 0),
(129, 'JKFJ-9-50G', 9, 'Company Website 15', 'We have an exisiting website but would like to a a couple of gallery pages, we can create almost what we want using adobe bridge galleries, but we can not integrate this in out website and would like a) the knowledge to, or someone to do this (if possible), or b) an alternative to this process i.e a way of easily uploading and editing images to a gallery page within our site.\r\n\r\nThe gallery interface and how we would like it to work (as I said this was done in adobe bridge) that we like is at   [obscured]   and I enclosed a jpg visual of how this would sit on our website.', '1', '1', 1, 400, 500, 1, 30, 1, '2015-04-17 16:35:00', NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 1, 0),
(130, 'JKFJ-9-IWE', 9, 'dsfd', 'dafadf', '2', '7', 1, 24, 234, 1, 234, 2, '2015-04-23 14:42:40', NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0, 0),
(131, 'JKFJ-9-TQ7', 9, 'testnew', 'asd asd', '3', '7', 1, 23, 324, 1, 234, 1, '2015-04-23 15:08:50', NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0, 0),
(132, 'JKFJ-9-3VL', 9, 'Testssda ds', 'asfddfassda', '3', '7', 1, 234, 234, 1, 324, 1, '2015-04-23 15:12:05', NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0, 0),
(133, 'JKFJ-9-WSL', 9, 'Werwe', 'dfa dasf ds fdsa', '3', '7', 2, 324, 3243, 1, 234, 1, '2015-04-23 15:13:08', NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0, 0),
(134, 'JKFJ-9-0Z1', 9, 'adfa', 'sadf dsa fdas ds', '2', '7', 2, 324, 3242, 1, 234, 1, '2015-04-23 15:15:25', NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0, 0),
(135, 'JKFJ-9-E89', 9, 'sadfsda', 'adf das fdsa fdsa', '2', '7', 1, 234, 2342, 1, 342, 1, '2015-04-23 15:16:29', NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0, 0),
(136, 'JKFJ-9-0JA', 9, 'sdadas', 'asdasdas', '3', '7', 1, 324, 24334, 1, 32, 1, '2015-04-23 15:17:33', NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0, 0),
(137, 'JKFJ-9-2AT', 9, 'sdadas', 'asdasdas', '3', '7', 1, 324, 24334, 1, 32, 1, '2015-04-23 15:57:06', NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0, 0),
(138, 'JKFJ-9-MGT', 9, 'fdsg', 'adsffds', '4', '7', 1, 234, 2345, 1, 23, 1, '2015-04-23 16:00:06', NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0, 0),
(139, 'JKFJ-9-F86', 9, 'fdsg', 'adsffds', '4', '7', 1, 234, 2345, 1, 23, 1, '2015-04-23 16:02:10', NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0, 0),
(140, 'JKFJ-9-05Q', 9, 'sdfgfdsg', 'afg afsg a', '1', '7', 1, 34, 344, 1, 345, 1, '2015-04-23 16:10:26', NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0, 0),
(141, 'JKFJ-9-QKC', 9, 'C# developer', 'C# developer', '3', '7', 1, 2222, 3333, 1, 2, 1, '2015-04-27 12:08:23', NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `freelance_job_doc`
--

CREATE TABLE IF NOT EXISTS `freelance_job_doc` (
  `freelanceJobDocId` int(10) unsigned NOT NULL,
  `mediaName` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `mediaPath` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `mediaCategory` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `createdOn` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updatedOn` datetime DEFAULT NULL,
  `createdBy` int(10) unsigned NOT NULL,
  `updatedBy` int(10) unsigned DEFAULT NULL,
  `status` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `fljob_id` int(10) unsigned DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `freelance_job_doc`
--

INSERT INTO `freelance_job_doc` (`freelanceJobDocId`, `mediaName`, `mediaPath`, `mediaCategory`, `createdOn`, `updatedOn`, `createdBy`, `updatedBy`, `status`, `fljob_id`) VALUES
(1, 'freelancejobdetails-130-9.docx', '', 'comp_fljob_docs', '2015-04-23 13:29:51', NULL, 0, NULL, 'active', 130),
(2, 'freelancejobdetails-130-9.docx', '', 'comp_fljob_docs', '2015-04-23 14:42:40', NULL, 0, NULL, 'active', 130),
(3, 'freelancejobdetails-131-9.docx', '', 'comp_fljob_docs', '2015-04-23 15:08:50', NULL, 0, NULL, 'active', 131),
(4, 'freelancejobdetails-132-9.docx', '', 'comp_fljob_docs', '2015-04-23 15:12:05', NULL, 0, NULL, 'active', 132),
(5, 'freelancejobdetails-135-9.docx', '', 'comp_fljob_docs', '2015-04-23 15:16:29', NULL, 0, NULL, 'active', 135);

-- --------------------------------------------------------

--
-- Table structure for table `freelance_skill_req`
--

CREATE TABLE IF NOT EXISTS `freelance_skill_req` (
  `fljobSkillReqId` int(11) unsigned NOT NULL,
  `flJobId` int(11) unsigned NOT NULL,
  `skills` varchar(64) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=108 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `freelance_skill_req`
--

INSERT INTO `freelance_skill_req` (`fljobSkillReqId`, `flJobId`, `skills`) VALUES
(67, 113, 'PHP'),
(68, 113, 'C'),
(69, 113, 'C++'),
(70, 113, 'Laravel'),
(71, 114, 'PHP'),
(72, 114, 'C'),
(73, 114, 'C++'),
(74, 114, 'C#'),
(75, 115, 'PHP'),
(76, 115, 'C'),
(77, 115, 'C++'),
(78, 115, 'C#'),
(79, 116, 'PHP'),
(80, 117, 'PHP'),
(81, 118, 'PHP'),
(82, 119, 'PHP'),
(87, 130, 'daf'),
(88, 130, 'AppleScript'),
(89, 131, 'Asp'),
(90, 131, 'BASIC'),
(91, 132, 'AppleScript'),
(92, 132, 'Messaging'),
(93, 133, 'AppleScript'),
(94, 133, 'BASIC'),
(95, 134, 'ActionScript'),
(96, 134, 'Attention to Detail'),
(97, 135, 'ActionScript'),
(98, 135, 'BASIC'),
(99, 136, 'adas'),
(100, 137, 'adas'),
(101, 138, 'BASIC'),
(102, 139, 'BASIC'),
(105, 140, 'sdgs'),
(106, 140, 'AppleScript'),
(107, 141, 'C# developer');

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE IF NOT EXISTS `jobs` (
  `jobId` int(11) unsigned NOT NULL,
  `emp_id` int(11) unsigned NOT NULL,
  `joborderid` varchar(60) COLLATE utf8_unicode_ci DEFAULT NULL,
  `job_title` varchar(64) COLLATE utf8_unicode_ci DEFAULT NULL,
  `jobType` varchar(10) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'ft',
  `job_overview` text COLLATE utf8_unicode_ci,
  `location_region` varchar(64) COLLATE utf8_unicode_ci DEFAULT NULL,
  `location_city` varchar(64) COLLATE utf8_unicode_ci DEFAULT NULL,
  `company_name` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL,
  `draft` tinyint(4) NOT NULL DEFAULT '0',
  `active` tinyint(4) NOT NULL DEFAULT '0',
  `created_on` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_on` datetime DEFAULT NULL,
  `activation_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `expiration_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `is_removed` tinyint(4) NOT NULL DEFAULT '0'
) ENGINE=InnoDB AUTO_INCREMENT=78 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `jobs`
--

INSERT INTO `jobs` (`jobId`, `emp_id`, `joborderid`, `job_title`, `jobType`, `job_overview`, `location_region`, `location_city`, `company_name`, `draft`, `active`, `created_on`, `updated_on`, `activation_date`, `expiration_date`, `is_removed`) VALUES
(42, 9, 'JKJP-9-NVR', 'prog1', 'ft', 'prog1', '12', 'Makati', 'asrii', 0, 1, '2015-04-24 17:15:03', NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0),
(43, 9, 'JKJP-9-FRM', 'prog2', 'ft', 'prog2', '14', 'Makati', 'test123456', 0, 1, '2015-04-24 17:18:13', NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0),
(44, 9, 'JKJP-9-HS4', 'prog3', 'ft', 'prog3', '14', 'Taguig', 'test123456', 0, 1, '2015-04-24 17:18:46', NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0),
(45, 9, 'JKJP-9-VMZ', 'prog4', 'ft', 'prog4', '15', 'Pasig', 'test123456', 0, 1, '2015-04-24 17:19:17', NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0),
(46, 9, 'JKJP-9-GSB', 'prog5', 'ft', 'prog5', '14', 'Makati', 'test123456', 0, 1, '2015-04-24 17:20:39', NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0),
(47, 9, 'JKJP-9-4DL', 'prog6', 'ft', 'prog6', '14', 'Caloocan', 'test123456', 0, 1, '2015-04-24 17:21:06', NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0),
(48, 9, 'JKJP-9-8JA', 'prog7', 'ft', 'prog7', '10', 'Makati', 'test123456', 0, 1, '2015-04-24 17:21:28', NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0),
(49, 9, 'JKJP-9-PAW', 'prog8', 'ft', 'prog8', '14', 'Marikina', 'test123456', 0, 1, '2015-04-24 17:21:57', NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0),
(50, 9, 'JKJP-9-5UZ', 'prog9', 'ft', 'prog9', '12', 'Pasay', 'test123456', 0, 1, '2015-04-24 17:22:25', NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0),
(51, 9, 'JKJP-9-Y3B', 'prog10', 'ft', 'prog10', '6', 'Pasay', 'test123456', 0, 1, '2015-04-24 17:22:50', NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0),
(52, 9, 'JKJP-9-R1G', 'prog11', 'ft', 'prog11', '13', 'Makati', 'test123456', 0, 1, '2015-04-24 17:23:18', NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0),
(53, 9, 'JKJP-9-PXV', 'prog12', 'ft', 'prog12', '5', 'Cala', 'test123456', 0, 1, '2015-04-24 17:23:42', NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0),
(54, 9, 'JKJP-9-Z2Y', 'programmer', 'ft', 'programmer', '1', 'makati', 'test123456', 0, 0, '2015-04-26 21:09:51', NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0),
(55, 10, 'JKJP-10-ONW', 'part time developer', 'ft', 'part time developer', '30', 'Makati', 'ffffffd', 0, 1, '2005-01-01 02:03:29', NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0),
(56, 9, 'JKJP-9-BK8', 'part time c# developer', 'ft', 'part time c# developer', '11', 'Manila', 'test123456', 0, 1, '2005-01-01 03:57:22', NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0),
(57, 9, 'JKJP-9-O4H', 'part time c++', 'ft', 'dkas;k '';l''k d;lsak'';dkasd''sd a;skldd ;klas d''s;as; d''kla;''lkas ''kas;''kas;'' kdd;''aks a;k'' as;k'';''k;lk as''kasd ''kasdkas ;l''ad;a''kl dakd as;kd ads'';klad;'' kas;kd kds'' ask;l'' kas;'' kda''; k;a''kda;''lks as;kda;ls kdakasj asd;lk ;ld''kas;k;askd;l''kds a.', '15', 'Makati', 'test123456', 0, 1, '2005-01-01 04:17:31', NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0),
(58, 9, 'JKJP-9-YT3', 'visual basic developer', 'ft', 'visual basic developer', '23', 'Makati', 'test123456', 0, 1, '2005-01-01 04:20:16', NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0),
(59, 9, 'JKJP-9-EJF', 'visual basic developer 2', 'ft', 'visual basic developer 2', '27', 'Pasay', 'test123456', 0, 1, '2005-01-01 04:21:07', NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0),
(60, 9, 'JKJP-9-D7T', 'visual basic developer 3', 'ft', 'visual basic developer 3', '29', 'UK', 'test123456', 0, 1, '2005-01-01 04:21:55', NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0),
(61, 9, 'JKJP-9-3KQ', 'visual basic developer 4', 'ft', 'visual basic developer 4', '31', 'us', 'test123456', 0, 1, '2005-01-01 04:22:52', NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0),
(62, 10, 'JKJP-10-SR3', 'visual plus1', 'ft', 'visual plus1', '1', 'makati', 'ffffffd', 0, 1, '2005-01-01 05:35:51', NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0),
(63, 10, 'JKJP-10-USC', 'visual plus2', 'ft', 'visual plus2', '11', 'makati', 'ffffffd', 0, 1, '2005-01-01 05:36:39', NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0),
(64, 9, 'JKJP-9-8HY', 'system analyst', 'ft', 'system analyst', '2', 'makati', 'test123456', 0, 0, '2015-04-27 11:05:01', NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0),
(65, 9, 'JKJP-9-GVB', 'qa tester', 'ft', 'qa tester', '16', 'Makati', 'test123456', 0, 0, '2015-04-27 11:16:41', NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0),
(66, 12, 'JKJP-12-BEF', 'c++ dev 1', 'ft', 'c++ dev 1', '14', 'makati', 'testemp', 0, 1, '2015-04-28 18:42:46', NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0),
(67, 12, 'JKJP-12-F5A', 'c++ dev 2', 'ft', 'c++ dev 2', '12', 'asdasd', 'testemp', 0, 1, '2015-04-28 18:47:44', NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0),
(68, 12, 'JKJP-12-G2P', 'c++ dev 3', 'ft', 'c++ dev 3', '13', 'makati', 'testemp', 0, 1, '2015-04-28 18:48:51', NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0),
(69, 12, 'JKJP-12-8EZ', 'c++ dev 4', 'ft', 'c++ dev 4', '14', 'adsada', 'testemp', 0, 1, '2015-04-28 18:49:19', NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0),
(70, 12, 'JKJP-12-H6X', 'c++ dev 5', 'ft', 'c++ dev 5', '2', 'asdad', 'testemp', 0, 1, '2015-04-28 18:49:52', NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0),
(71, 12, 'JKJP-12-X4K', 'c++ dev 6', 'ft', 'c++ dev 6', '15', 'asdad', 'testemp', 0, 1, '2015-04-28 18:50:21', NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0),
(72, 12, 'JKJP-12-ZRB', 'agency 1', 'ft', 'agency 1', '12', 'Agency 1', 'testemp', 0, 1, '2015-04-28 19:29:24', NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0),
(73, 12, 'JKJP-12-4YP', 'agency 2', 'ft', 'agency 2', '4', 'Agency 2', 'testemp', 0, 1, '2015-04-28 19:30:02', NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0),
(74, 12, 'JKJP-12-7PY', 'agency 3', 'ft', 'agency 3', '3', 'Agency 3', 'testemp', 0, 1, '2015-04-28 19:30:33', NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0),
(75, 12, 'JKJP-12-X95', 'agency 4', 'ft', 'agency 4', '14', 'Agency 4', 'testemp', 0, 1, '2015-04-28 19:30:54', NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0),
(76, 12, 'JKJP-12-B3K', 'agency 5', 'ft', 'agency 5', '13', 'Agency 5', 'testemp', 0, 1, '2015-04-28 19:31:16', NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0),
(77, 12, 'JKJP-12-K1W', 'agency 6', 'ft', 'agency 6', '12', 'Agency 6', 'testemp', 0, 1, '2015-04-28 19:31:39', NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0);

-- --------------------------------------------------------

--
-- Table structure for table `jobviewlog`
--

CREATE TABLE IF NOT EXISTS `jobviewlog` (
  `id` int(11) unsigned NOT NULL,
  `jobId` int(11) unsigned NOT NULL,
  `member_id` int(10) unsigned NOT NULL,
  `jobtype` int(10) unsigned DEFAULT NULL COMMENT '1 - job,2-freelance',
  `logtime` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=138 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `jobviewlog`
--

INSERT INTO `jobviewlog` (`id`, `jobId`, `member_id`, `jobtype`, `logtime`) VALUES
(1, 77, 6, 1, '2015-04-29 18:24:13'),
(2, 76, 6, 1, '2015-04-29 18:24:20'),
(3, 77, 6, 1, '2015-04-29 18:24:28'),
(4, 77, 6, 1, '2015-04-29 18:24:39'),
(5, 77, 6, 1, '2015-04-29 18:24:55'),
(6, 77, 6, 1, '2015-04-29 18:25:03'),
(7, 77, 6, 1, '2015-04-29 18:25:27'),
(8, 76, 6, 1, '2015-04-29 18:25:33'),
(9, 74, 6, 1, '2015-04-29 18:25:37'),
(10, 76, 6, 1, '2015-04-29 18:26:24'),
(11, 76, 6, 1, '2015-04-29 18:27:07'),
(12, 75, 6, 1, '2015-04-29 18:27:25'),
(13, 75, 6, 1, '2015-04-29 18:27:44'),
(14, 75, 6, 1, '2015-04-29 18:27:55'),
(15, 76, 6, 1, '2015-04-29 18:29:03'),
(16, 76, 6, 1, '2015-04-29 18:29:18'),
(17, 76, 6, 1, '2015-04-29 18:29:36'),
(18, 76, 6, 1, '2015-04-29 18:30:01'),
(19, 77, 6, 1, '2015-04-29 18:30:29'),
(20, 77, 6, 1, '2015-04-29 18:33:14'),
(21, 77, 6, 1, '2015-04-29 18:35:35'),
(22, 77, 6, 1, '2015-04-29 18:35:47'),
(23, 77, 6, 1, '2015-04-29 18:36:18'),
(24, 77, 6, 1, '2015-04-29 18:36:34'),
(25, 77, 6, 1, '2015-04-29 18:45:35'),
(26, 77, 6, 1, '2015-04-29 18:46:59'),
(27, 77, 6, 1, '2015-04-29 18:54:01'),
(28, 77, 6, 1, '2015-04-29 18:54:16'),
(29, 77, 6, 1, '2015-04-29 18:54:18'),
(30, 77, 6, 1, '2015-04-29 18:54:43'),
(31, 77, 6, 1, '2015-04-29 18:56:04'),
(32, 77, 6, 1, '2015-04-29 18:56:37'),
(33, 77, 6, 1, '2015-04-29 18:56:47'),
(34, 76, 6, 1, '2015-04-29 18:57:09'),
(35, 76, 6, 1, '2015-04-29 18:57:49'),
(36, 75, 6, 1, '2015-04-29 18:57:52'),
(37, 74, 6, 1, '2015-04-29 18:58:20'),
(38, 74, 6, 1, '2015-04-29 18:58:51'),
(39, 77, 6, 1, '2015-04-29 18:59:44'),
(40, 76, 6, 1, '2015-04-29 18:59:49'),
(41, 77, 6, 1, '2015-04-29 18:59:52'),
(42, 114, 6, 2, '2015-04-29 19:00:02'),
(43, 113, 6, 2, '2015-04-29 19:00:37'),
(44, 77, 6, 1, '2015-04-29 19:07:48'),
(45, 113, 6, 2, '2015-04-29 19:10:00'),
(46, 113, 6, 2, '2015-04-29 19:10:24'),
(47, 113, 6, 2, '2015-04-29 19:11:57'),
(48, 113, 6, 2, '2015-04-29 19:12:40'),
(49, 114, 6, 2, '2015-04-29 19:12:46'),
(50, 113, 6, 2, '2015-04-29 19:13:14'),
(51, 114, 6, 2, '2015-04-29 19:13:17'),
(52, 55, 6, 2, '2015-04-29 19:13:38'),
(53, 57, 6, 2, '2015-04-29 19:13:47'),
(54, 59, 6, 2, '2015-04-29 19:13:50'),
(55, 59, 6, 1, '2015-04-29 19:13:52'),
(56, 55, 6, 1, '2015-04-29 19:16:52'),
(57, 55, 6, 1, '2015-04-29 19:17:07'),
(58, 55, 6, 1, '2015-04-29 19:17:11'),
(59, 77, 6, 1, '2015-04-29 19:18:13'),
(60, 75, 6, 1, '2015-04-29 19:18:19'),
(61, 75, 6, 1, '2015-04-29 19:18:22'),
(62, 73, 6, 1, '2015-04-29 19:18:27'),
(63, 72, 6, 2, '2015-04-29 19:18:38'),
(64, 72, 6, 2, '2015-04-29 19:20:33'),
(65, 70, 6, 2, '2015-04-29 19:20:38'),
(66, 75, 6, 1, '2015-04-29 19:20:44'),
(67, 72, 6, 2, '2015-04-29 19:20:48'),
(68, 61, 6, 1, '2015-04-29 19:20:59'),
(69, 70, 6, 1, '2015-04-29 19:22:18'),
(70, 119, 6, 2, '2015-04-29 19:22:47'),
(71, 123, 6, 2, '2015-04-29 19:22:53'),
(72, 123, 6, 2, '2015-04-29 19:22:57'),
(73, 123, 6, 2, '2015-04-29 19:22:59'),
(74, 119, 6, 2, '2015-04-29 19:23:02'),
(75, 61, 6, 1, '2015-04-29 19:23:47'),
(76, 46, 6, 1, '2015-04-29 19:24:02'),
(77, 46, 6, 1, '2015-04-29 19:24:38'),
(78, 46, 6, 1, '2015-04-29 19:24:45'),
(79, 47, 6, 1, '2015-04-29 19:24:57'),
(80, 46, 6, 1, '2015-04-29 19:25:11'),
(81, 72, 6, 1, '2015-04-29 19:25:53'),
(82, 71, 6, 1, '2015-04-29 19:26:00'),
(83, 72, 6, 1, '2015-04-29 19:28:34'),
(84, 77, 6, 1, '2015-04-29 19:29:14'),
(85, 77, 0, 1, '2015-04-30 13:22:21'),
(86, 77, 0, 1, '2015-04-30 13:23:04'),
(87, 77, 0, 1, '2015-04-30 13:23:29'),
(88, 77, 0, 1, '2015-04-30 13:23:40'),
(89, 77, 0, 1, '2015-04-30 13:25:14'),
(90, 77, 0, 1, '2015-04-30 13:25:40'),
(91, 77, 0, 1, '2015-04-30 13:25:57'),
(92, 77, 0, 1, '2015-04-30 13:26:16'),
(93, 77, 0, 1, '2015-04-30 13:32:13'),
(94, 77, 0, 1, '2015-04-30 13:32:29'),
(95, 77, 0, 1, '2015-04-30 13:35:25'),
(96, 77, 0, 1, '2015-04-30 13:35:39'),
(97, 77, 0, 1, '2015-04-30 13:36:11'),
(98, 77, 0, 1, '2015-04-30 13:36:19'),
(99, 77, 0, 1, '2015-04-30 13:36:26'),
(100, 77, 0, 1, '2015-04-30 13:36:42'),
(101, 77, 0, 1, '2015-04-30 13:36:53'),
(102, 77, 0, 1, '2015-04-30 13:49:25'),
(103, 77, 6, 1, '2015-04-30 14:08:14'),
(104, 77, 6, 1, '2015-04-30 14:08:19'),
(105, 77, 6, 1, '2015-04-30 14:08:21'),
(106, 77, 0, 1, '2015-04-30 14:08:31'),
(107, 77, 0, 1, '2015-04-30 14:39:04'),
(108, 77, 0, 1, '2015-04-30 14:39:18'),
(109, 77, 0, 1, '2015-04-30 14:39:29'),
(110, 77, 0, 1, '2015-04-30 14:41:00'),
(111, 77, 0, 1, '2015-04-30 14:41:00'),
(112, 77, 0, 1, '2015-04-30 14:41:17'),
(113, 77, 0, 1, '2015-04-30 14:43:13'),
(114, 76, 0, 1, '2015-04-30 14:43:31'),
(115, 77, 0, 1, '2015-04-30 14:47:42'),
(116, 77, 0, 1, '2015-04-30 15:20:20'),
(117, 77, 0, 1, '2015-04-30 15:52:06'),
(118, 77, 6, 1, '2015-04-30 15:53:14'),
(119, 77, 0, 1, '2015-04-30 15:55:30'),
(120, 77, 6, 1, '2015-04-30 15:55:46'),
(121, 77, 0, 1, '2015-04-30 15:55:57'),
(122, 77, 12, 1, '2015-04-30 17:06:30'),
(123, 77, 0, 1, '2015-04-30 17:06:51'),
(124, 77, 0, 1, '2015-04-30 17:08:25'),
(125, 77, 0, 1, '2015-04-30 17:12:49'),
(126, 113, 0, 2, '2015-08-06 20:17:10'),
(127, 114, 0, 2, '2015-08-06 20:17:16'),
(128, 46, 0, 1, '2015-08-08 12:30:50'),
(129, 77, 13, 1, '2015-08-12 16:53:30'),
(130, 77, 13, 1, '2015-08-12 16:54:19'),
(131, 77, 13, 1, '2015-08-12 16:55:01'),
(132, 77, 13, 1, '2015-08-12 16:55:16'),
(133, 77, 13, 1, '2015-08-12 16:55:16'),
(134, 77, 13, 1, '2015-08-12 16:55:16'),
(135, 77, 13, 1, '2015-08-12 16:56:01'),
(136, 77, 13, 1, '2015-08-12 16:58:50'),
(137, 76, 13, 1, '2015-08-12 16:58:57');

-- --------------------------------------------------------

--
-- Table structure for table `job_applicant`
--

CREATE TABLE IF NOT EXISTS `job_applicant` (
  `jobApplicantId` int(10) unsigned NOT NULL,
  `jobId` int(10) unsigned NOT NULL,
  `empId` int(10) unsigned NOT NULL,
  `applicantId` int(11) unsigned DEFAULT NULL,
  `applied_on` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `candidate_status` int(1) DEFAULT '0' COMMENT '0-apply,1-shorlisted,2-for interview,3-unqualified'
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `job_applicant`
--

INSERT INTO `job_applicant` (`jobApplicantId`, `jobId`, `empId`, `applicantId`, `applied_on`, `candidate_status`) VALUES
(1, 77, 12, 6, '2015-04-30 15:53:16', 0),
(2, 77, 12, 12, '2015-04-30 16:39:31', 0),
(3, 77, 12, 13, '2015-08-12 16:56:44', 0);

-- --------------------------------------------------------

--
-- Table structure for table `job_details`
--

CREATE TABLE IF NOT EXISTS `job_details` (
  `id` int(11) unsigned NOT NULL,
  `job_id` int(11) unsigned NOT NULL,
  `vacancy_num` int(10) unsigned NOT NULL,
  `specialization` varchar(150) COLLATE utf8_unicode_ci DEFAULT NULL,
  `position_level` varchar(150) COLLATE utf8_unicode_ci DEFAULT NULL,
  `job_desc` text COLLATE utf8_unicode_ci NOT NULL,
  `sked_type` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `yr_exp` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `experience_req` text COLLATE utf8_unicode_ci,
  `additional_job_req` text COLLATE utf8_unicode_ci,
  `salary_base` varchar(150) COLLATE utf8_unicode_ci DEFAULT NULL,
  `currency` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `salary_min` varchar(150) COLLATE utf8_unicode_ci DEFAULT NULL,
  `salary_max` varchar(150) COLLATE utf8_unicode_ci DEFAULT NULL,
  `show_salary` tinyint(4) NOT NULL DEFAULT '0',
  `date_posted` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `salary_type` tinyint(4) NOT NULL DEFAULT '3',
  `date_expiry` datetime NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB AUTO_INCREMENT=71 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `job_details`
--

INSERT INTO `job_details` (`id`, `job_id`, `vacancy_num`, `specialization`, `position_level`, `job_desc`, `sked_type`, `yr_exp`, `experience_req`, `additional_job_req`, `salary_base`, `currency`, `salary_min`, `salary_max`, `show_salary`, `date_posted`, `salary_type`, `date_expiry`) VALUES
(35, 42, 2, '12', '3', 'Prog1', 'Day Shift', '1-2', 'Prog1', 'Prog1', '/mo', 'PHP', '10000', '20000', 0, '2015-04-24 00:00:00', 1, '2015-04-24 00:00:00'),
(36, 43, 23, '14', '4', 'Prog2', 'Day Shift', '1-2', 'Prog2', 'Prog2', '/mo', 'PHP', '10000', '20000', 0, '2015-04-24 00:00:00', 1, '2015-04-24 00:00:00'),
(37, 44, 3, '13', '5', 'Prog3', 'Day Shift', '1-2', 'Prog3', 'Prog3', '/mo', 'PHP', '10000', '20000', 0, '2015-04-24 00:00:00', 1, '2015-04-24 00:00:00'),
(38, 45, 4, '12', '4', 'Prog4', 'Day Shift', '6-7', 'Prog4', 'Prog4', '/mo', 'PHP', '10000', '20000', 0, '2015-04-24 00:00:00', 1, '2015-04-24 00:00:00'),
(39, 46, 54, '15', '1', 'Prog5', 'Day Shift', '1-2', 'Prog5', 'Prog5', '/mo', 'PHP', '10000', '20000', 0, '2015-04-24 00:00:00', 1, '2015-04-24 00:00:00'),
(40, 47, 4, '15', '1', 'Prog6', 'Day Shift', '1-2', 'Prog6', 'Prog6', '/mo', 'PHP', '10000', '20000', 0, '2015-04-24 00:00:00', 1, '2015-04-24 00:00:00'),
(41, 48, 5, '13', '1', 'Prog7', 'Day Shift', '1-2', 'Prog7', 'Prog7', '/mo', 'PHP', '10000', '20000', 0, '2015-04-24 00:00:00', 1, '2015-04-24 00:00:00'),
(42, 49, 5, '12', '1', 'Prog8', 'Day Shift', '1-2', 'Prog8', 'Prog8', '/mo', 'PHP', '10000', '20000', 0, '2015-04-24 00:00:00', 1, '2015-04-24 00:00:00'),
(43, 50, 5, '13', '1', 'Prog9', 'Day Shift', '1-2', 'Prog9', 'Prog9', '/mo', 'PHP', '10000', '20000', 0, '2015-04-24 00:00:00', 1, '2015-04-24 00:00:00'),
(44, 51, 3, '6', '1', 'Prog10', 'Day Shift', '1-2', 'Prog10', 'Prog10', '/mo', 'PHP', '10000', '20000', 0, '2015-04-24 00:00:00', 1, '2015-04-24 00:00:00'),
(45, 52, 4, '11', '1', 'Prog11', 'Day Shift', '1-2', 'Prog11', 'Prog11', '/mo', 'PHP', '10000', '20000', 0, '2015-04-24 00:00:00', 1, '2015-04-24 00:00:00'),
(46, 53, 5, '14', '1', 'Prog12', 'Day Shift', '1-2', 'Prog12', 'Prog12', '/mo', 'PHP', '10000', '20000', 0, '2015-04-24 00:00:00', 1, '2015-04-24 00:00:00'),
(47, 54, 4, '11', '1', 'g gds gdf gfds dsf', 'Day Shift', '1-2', 'gdf gfds gds gdfsg df', 'dsgfds gfdsf gfds', '/mo', 'PHP', '10000', '20000', 0, '2015-04-26 00:00:00', 1, '2015-04-26 00:00:00'),
(48, 55, 4, '10', '1', 'Part time developer', 'Day Shift', '1-2', 'Part time developer', 'Part time developer', '/mo', 'PHP', '10000', '20000', 0, '2004-12-31 00:00:00', 1, '2004-12-31 00:00:00'),
(49, 56, 3, '12', '4', 'Part time c# developer', 'Day Shift', '1-2', 'Part time c# developer', 'Part time c# developer', '/mo', 'PHP', '50000', '70000', 0, '2004-12-31 00:00:00', 1, '2004-12-31 00:00:00'),
(50, 57, 5, '11', '1', 'das;jd ;askljdas;kl jd;asl jd;klasjd ;lasd klasdljdsaasd asdas;kldn asd ;lasd ;las;ldaskjld as;ldkjlas ;klasdas kld;jas', 'Day Shift', '1-2', 'gfdds gfds gdf gdfs gdf gdf gds gdfsgfd gdfs dgfs gdsf dfs gfd dfs gdf', 'dfs gdf df gfds gds gdf gdfs gdddf dsf gfds dfg fdg dsf gdsf gfd gdfs gsdf', '/mo', 'PHP', '10000', '20000', 0, '2004-12-31 00:00:00', 1, '2004-12-31 00:00:00'),
(51, 58, 6, '11', '3', 'Visual Basic Developer', 'Day Shift', '1-2', 'Visual Basic Developer', 'Visual Basic Developer', '/mo', 'PHP', '10000', '20000', 0, '2004-12-31 00:00:00', 1, '2004-12-31 00:00:00'),
(52, 59, 5, '11', '1', 'Visual Basic Developer 2', 'Day Shift', '1-2', 'Visual Basic Developer 2', 'Visual Basic Developer 2', '/mo', 'PHP', '10000', '20000', 0, '2004-12-31 00:00:00', 1, '2004-12-31 00:00:00'),
(53, 60, 4, '12', '3', 'Visual Basic Developer 3', 'Day Shift', '1-2', 'Visual Basic Developer 3', 'Visual Basic Developer 3', '/mo', 'PHP', '10000', '20000', 0, '2004-12-31 00:00:00', 1, '2004-12-31 00:00:00'),
(54, 61, 7, '11', '6', 'ads das dsa fdsa das fds ds f', 'Day Shift', '1-2', 'ds sdadasds sd fds da das da fs fds', 's dasd fdsf ds fdsa fds ds asd fdsa fds', '/mo', 'PHP', '10000', '20000', 0, '2004-12-31 00:00:00', 1, '2004-12-31 00:00:00'),
(55, 62, 4, '10', '1', 'Visual Plus1', 'Day Shift', '1-2', 'Visual Plus1', 'Visual Plus1', '/mo', 'PHP', '10000', '20000', 0, '2004-12-31 00:00:00', 1, '2004-12-31 00:00:00'),
(56, 63, 4, '12', '1', 'Visual Plus2', 'Day Shift', '1-2', 'Visual Plus2', 'Visual Plus2', '/mo', 'PHP', '10000', '20000', 0, '2004-12-31 00:00:00', 1, '2004-12-31 00:00:00'),
(57, 64, 4, '5', '1', 'system analyst', 'Day Shift', '1-2', 'system analyst', 'system analyst', '/mo', 'PHP', '10000', '20000', 0, '2015-04-27 00:00:00', 1, '2015-04-27 00:00:00'),
(58, 65, 4, '12', '1', 'QA Tester', 'Day Shift', '1-2', 'QA Tester', 'QA Tester', '/mo', 'PHP', '10000', '20000', 0, '2015-04-27 00:00:00', 1, '2015-04-27 00:00:00'),
(59, 66, 4, '4', '2', 'C++ dev 1', 'Day Shift', '4-5', 'C++ dev 1', 'C++ dev 1', '/mo', 'PHP', '10000', '20000', 0, '2015-04-28 00:00:00', 1, '2015-04-28 00:00:00'),
(60, 67, 34, '12', '1', 'C++ dev 2', 'Day Shift', '4-5', 'C++ dev 2', 'C++ dev 2', '/mo', 'PHP', '10000', '20000', 0, '2015-04-28 00:00:00', 1, '2015-04-28 00:00:00'),
(61, 68, 4, '13', '1', 'C++ dev 3', 'Day Shift', '1-2', 'C++ dev 3', 'C++ dev 3', '/mo', 'PHP', '10000', '20000', 0, '2015-04-28 00:00:00', 1, '2015-04-28 00:00:00'),
(62, 69, 324, '14', '1', 'C++ dev 4', 'Day Shift', '1-2', 'C++ dev 4', 'C++ dev 4', '/mo', 'PHP', '10000', '20000', 0, '2015-04-28 00:00:00', 1, '2015-04-28 00:00:00'),
(63, 70, 34, '15', '1', 'C++ dev 5', 'Day Shift', '1-2', 'C++ dev 5', 'C++ dev 5', '/mo', 'PHP', '10000', '20000', 0, '2015-04-28 00:00:00', 1, '2015-04-28 00:00:00'),
(64, 71, 34, '14', '5', 'C++ dev 6', 'Day Shift', '1-2', 'C++ dev 6', 'C++ dev 6', '/mo', 'PHP', '10000', '20000', 0, '2015-04-28 00:00:00', 1, '2015-04-28 00:00:00'),
(65, 72, 34, '14', '1', 'Agency 1', 'Day Shift', '1-2', 'Agency 1', 'Agency 1', '/mo', 'PHP', '10000', '20000', 0, '2015-04-28 00:00:00', 1, '2015-04-28 00:00:00'),
(66, 73, 4, '15', '1', 'Agency 2', 'Day Shift', '1-2', 'Agency 2', 'Agency 2', '/mo', 'PHP', '10000', '20000', 0, '2015-04-28 00:00:00', 1, '2015-04-28 00:00:00'),
(67, 74, 23, '14', '1', 'Agency 3', 'Day Shift', '1-2', 'Agency 3', 'Agency 3', '/mo', 'PHP', '10000', '20000', 0, '2015-04-28 00:00:00', 1, '2015-04-28 00:00:00'),
(68, 75, 32, '14', '1', 'Agency 4', 'Day Shift', '1-2', 'Agency 4', 'Agency 4', '/mo', 'PHP', '10000', '20000', 0, '2015-04-28 00:00:00', 1, '2015-04-28 00:00:00'),
(69, 76, 3, '15', '1', 'Agency 5', 'Day Shift', '1-2', 'Agency 5', 'Agency 5', '/mo', 'PHP', '10000', '20000', 0, '2015-04-28 00:00:00', 1, '2015-04-28 00:00:00'),
(70, 77, 3, '4', '1', 'Agency 6', 'Day Shift', '1-2', 'Agency 6', '', '/mo', 'PHP', '10000', '20000', 0, '2015-04-28 00:00:00', 1, '2015-04-28 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `job_educ_reqs`
--

CREATE TABLE IF NOT EXISTS `job_educ_reqs` (
  `id` int(11) unsigned NOT NULL,
  `job_id` int(11) unsigned NOT NULL,
  `education` varchar(150) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=172 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `job_educ_reqs`
--

INSERT INTO `job_educ_reqs` (`id`, `job_id`, `education`) VALUES
(119, 42, '1'),
(120, 42, '2'),
(121, 43, '3'),
(122, 44, '1'),
(123, 44, '2'),
(124, 44, '4'),
(125, 45, '4'),
(126, 45, '6'),
(127, 46, '2'),
(128, 47, '2'),
(129, 48, '4'),
(130, 49, '2'),
(131, 50, '6'),
(132, 51, '6'),
(133, 52, '2'),
(134, 53, '2'),
(135, 54, '1'),
(136, 54, '5'),
(137, 55, '1'),
(138, 55, '2'),
(139, 55, '3'),
(140, 56, '3'),
(141, 56, '4'),
(142, 56, '5'),
(143, 56, '6'),
(144, 57, '1'),
(145, 57, '4'),
(146, 58, '2'),
(147, 58, '4'),
(148, 59, '2'),
(149, 59, '4'),
(150, 60, '2'),
(151, 61, '1'),
(152, 62, '1'),
(153, 63, '1'),
(154, 64, '1'),
(155, 64, '2'),
(156, 65, '1'),
(157, 65, '4'),
(158, 66, '1'),
(159, 67, '1'),
(160, 67, '2'),
(161, 68, '1'),
(162, 69, '1'),
(163, 70, '3'),
(164, 71, '1'),
(165, 71, '2'),
(166, 72, '1'),
(167, 73, '1'),
(168, 74, '5'),
(169, 75, '6'),
(170, 76, '1'),
(171, 77, '1');

-- --------------------------------------------------------

--
-- Table structure for table `job_employment_type`
--

CREATE TABLE IF NOT EXISTS `job_employment_type` (
  `id` int(11) unsigned NOT NULL,
  `job_id` int(11) unsigned NOT NULL,
  `emp_type` varchar(150) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=163 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `job_employment_type`
--

INSERT INTO `job_employment_type` (`id`, `job_id`, `emp_type`) VALUES
(104, 42, '1'),
(105, 43, '1'),
(106, 44, '5'),
(107, 45, '2'),
(108, 46, '4'),
(109, 47, '4'),
(110, 48, '6'),
(111, 49, '2'),
(112, 50, '6'),
(113, 51, '2'),
(114, 52, '2'),
(115, 53, '5'),
(116, 54, '1'),
(117, 54, '2'),
(118, 55, '1'),
(119, 55, '3'),
(120, 56, '1'),
(121, 56, '2'),
(122, 56, '3'),
(123, 56, '4'),
(124, 56, '5'),
(125, 57, '1'),
(126, 57, '3'),
(127, 58, '1'),
(128, 58, '3'),
(129, 59, '1'),
(130, 59, '2'),
(131, 59, '3'),
(132, 60, '1'),
(133, 60, '2'),
(134, 60, '3'),
(135, 61, '1'),
(136, 61, '3'),
(137, 62, '1'),
(138, 62, '3'),
(139, 63, '1'),
(140, 63, '3'),
(141, 64, '1'),
(142, 64, '3'),
(143, 65, '2'),
(144, 65, '3'),
(145, 66, '1'),
(146, 66, '3'),
(147, 67, '1'),
(148, 67, '3'),
(149, 68, '1'),
(150, 68, '3'),
(151, 69, '1'),
(152, 69, '3'),
(153, 70, '2'),
(154, 70, '3'),
(155, 71, '1'),
(156, 71, '3'),
(157, 72, '4'),
(158, 73, '4'),
(159, 74, '4'),
(160, 75, '4'),
(161, 76, '4'),
(162, 77, '4');

-- --------------------------------------------------------

--
-- Table structure for table `job_other_benefits`
--

CREATE TABLE IF NOT EXISTS `job_other_benefits` (
  `id` int(11) unsigned NOT NULL,
  `job_id` int(11) unsigned NOT NULL,
  `benefits` varchar(150) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=487 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `job_other_benefits`
--

INSERT INTO `job_other_benefits` (`id`, `job_id`, `benefits`) VALUES
(306, 42, '1'),
(307, 42, '7'),
(308, 42, '9'),
(309, 42, '10'),
(310, 42, '13'),
(311, 43, '1'),
(312, 43, '2'),
(313, 43, '6'),
(314, 43, '7'),
(315, 43, '9'),
(316, 43, '10'),
(317, 43, '13'),
(318, 44, '1'),
(319, 44, '7'),
(320, 44, '9'),
(321, 44, '10'),
(322, 44, '13'),
(323, 45, '7'),
(324, 45, '9'),
(325, 45, '10'),
(326, 45, '13'),
(327, 46, '1'),
(328, 46, '7'),
(329, 46, '9'),
(330, 46, '10'),
(331, 46, '13'),
(332, 47, '1'),
(333, 47, '7'),
(334, 47, '9'),
(335, 47, '10'),
(336, 47, '13'),
(337, 48, '1'),
(338, 48, '7'),
(339, 48, '9'),
(340, 48, '10'),
(341, 48, '13'),
(342, 49, '1'),
(343, 49, '7'),
(344, 49, '9'),
(345, 49, '10'),
(346, 49, '13'),
(347, 50, '1'),
(348, 50, '7'),
(349, 50, '9'),
(350, 50, '10'),
(351, 50, '13'),
(352, 51, '1'),
(353, 51, '7'),
(354, 51, '9'),
(355, 51, '10'),
(356, 51, '13'),
(357, 52, '1'),
(358, 52, '7'),
(359, 52, '9'),
(360, 52, '10'),
(361, 52, '13'),
(362, 53, '1'),
(363, 53, '7'),
(364, 53, '9'),
(365, 53, '10'),
(366, 53, '13'),
(367, 54, '1'),
(368, 54, '7'),
(369, 54, '9'),
(370, 54, '10'),
(371, 54, '13'),
(372, 55, '1'),
(373, 55, '7'),
(374, 55, '9'),
(375, 55, '10'),
(376, 55, '13'),
(377, 56, '1'),
(378, 56, '7'),
(379, 56, '9'),
(380, 56, '10'),
(381, 56, '13'),
(382, 57, '1'),
(383, 57, '7'),
(384, 57, '9'),
(385, 57, '10'),
(386, 57, '13'),
(387, 58, '1'),
(388, 58, '7'),
(389, 58, '9'),
(390, 58, '10'),
(391, 58, '13'),
(392, 59, '1'),
(393, 59, '7'),
(394, 59, '9'),
(395, 59, '10'),
(396, 59, '13'),
(397, 60, '1'),
(398, 60, '7'),
(399, 60, '9'),
(400, 60, '10'),
(401, 60, '13'),
(402, 61, '1'),
(403, 61, '7'),
(404, 61, '9'),
(405, 61, '10'),
(406, 61, '13'),
(407, 62, '1'),
(408, 62, '7'),
(409, 62, '9'),
(410, 62, '10'),
(411, 62, '13'),
(412, 63, '1'),
(413, 63, '7'),
(414, 63, '9'),
(415, 63, '10'),
(416, 63, '13'),
(417, 64, '1'),
(418, 64, '7'),
(419, 64, '9'),
(420, 64, '10'),
(421, 64, '13'),
(422, 65, '1'),
(423, 65, '7'),
(424, 65, '9'),
(425, 65, '10'),
(426, 65, '13'),
(427, 66, '1'),
(428, 66, '7'),
(429, 66, '9'),
(430, 66, '10'),
(431, 66, '13'),
(432, 67, '1'),
(433, 67, '7'),
(434, 67, '9'),
(435, 67, '10'),
(436, 67, '13'),
(437, 68, '1'),
(438, 68, '7'),
(439, 68, '9'),
(440, 68, '10'),
(441, 68, '13'),
(442, 69, '1'),
(443, 69, '7'),
(444, 69, '9'),
(445, 69, '10'),
(446, 69, '13'),
(447, 70, '1'),
(448, 70, '7'),
(449, 70, '9'),
(450, 70, '10'),
(451, 70, '13'),
(452, 71, '1'),
(453, 71, '7'),
(454, 71, '9'),
(455, 71, '10'),
(456, 71, '13'),
(457, 72, '1'),
(458, 72, '7'),
(459, 72, '9'),
(460, 72, '10'),
(461, 72, '13'),
(462, 73, '1'),
(463, 73, '7'),
(464, 73, '9'),
(465, 73, '10'),
(466, 73, '13'),
(467, 74, '1'),
(468, 74, '7'),
(469, 74, '9'),
(470, 74, '10'),
(471, 74, '13'),
(472, 75, '1'),
(473, 75, '7'),
(474, 75, '9'),
(475, 75, '10'),
(476, 75, '13'),
(477, 76, '1'),
(478, 76, '7'),
(479, 76, '9'),
(480, 76, '10'),
(481, 76, '13'),
(482, 77, '1'),
(483, 77, '7'),
(484, 77, '9'),
(485, 77, '10'),
(486, 77, '13');

-- --------------------------------------------------------

--
-- Table structure for table `job_save`
--

CREATE TABLE IF NOT EXISTS `job_save` (
  `id` int(11) unsigned NOT NULL,
  `jobId` int(11) unsigned NOT NULL,
  `member_id` int(10) unsigned NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '0' COMMENT '0 - apply, 1- shortlisted/underconsideration, 2- sked interview, 3- not qualified, 4- job is close',
  `logtime` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `job_save`
--

INSERT INTO `job_save` (`id`, `jobId`, `member_id`, `status`, `logtime`) VALUES
(1, 77, 6, 0, '2015-04-29 17:25:30'),
(2, 75, 6, 0, '2015-04-29 18:58:46'),
(3, 55, 6, 0, '2015-04-29 19:18:03'),
(4, 76, 6, 0, '2015-04-29 19:18:06'),
(5, 46, 6, 0, '2015-04-29 19:25:40'),
(6, 52, 6, 0, '2015-04-29 19:26:23');

-- --------------------------------------------------------

--
-- Table structure for table `localbankdepositdetails`
--

CREATE TABLE IF NOT EXISTS `localbankdepositdetails` (
  `localbankdepositdetailsId` int(10) unsigned NOT NULL,
  `employerId` int(10) unsigned NOT NULL,
  `depositJobId` int(10) unsigned NOT NULL,
  `bankAccountId` int(10) unsigned NOT NULL COMMENT 'jobKonekBankAccount',
  `depositSlipName` varchar(150) COLLATE utf8_unicode_ci DEFAULT NULL,
  `depositAmount` double NOT NULL DEFAULT '0',
  `depositTransRefNo` varchar(150) COLLATE utf8_unicode_ci DEFAULT NULL,
  `depositDateTime` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `contactName` varchar(250) COLLATE utf8_unicode_ci DEFAULT NULL,
  `contactNo` varchar(150) COLLATE utf8_unicode_ci DEFAULT NULL,
  `contactEmail` varchar(250) COLLATE utf8_unicode_ci DEFAULT NULL,
  `depositLocation` varchar(250) COLLATE utf8_unicode_ci DEFAULT NULL,
  `transactionTime` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status` varchar(32) COLLATE utf8_unicode_ci NOT NULL COMMENT '1-means request, 2-means approved',
  `remark` text COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `localbankdepositdetails`
--

INSERT INTO `localbankdepositdetails` (`localbankdepositdetailsId`, `employerId`, `depositJobId`, `bankAccountId`, `depositSlipName`, `depositAmount`, `depositTransRefNo`, `depositDateTime`, `contactName`, `contactNo`, `contactEmail`, `depositLocation`, `transactionTime`, `status`, `remark`) VALUES
(4, 12, 66, 2, 'localbank-deposit-slip-12-CZ4NWT5.', 1432, '323252', '2015-04-17 14:34:00', 'Asrii', '234432', 'asrii@gmail.com', ',', '2015-04-28 12:44:05', '1', '');

-- --------------------------------------------------------

--
-- Table structure for table `member_work_expi`
--

CREATE TABLE IF NOT EXISTS `member_work_expi` (
  `id` int(10) unsigned NOT NULL,
  `member_id` int(10) unsigned NOT NULL DEFAULT '0',
  `company_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `location` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `industry` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `date_joined_from` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `date_joined_to` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `job_title` varchar(225) COLLATE utf8_unicode_ci DEFAULT NULL,
  `position_lvl` varchar(225) COLLATE utf8_unicode_ci DEFAULT NULL,
  `specialization` varchar(225) COLLATE utf8_unicode_ci DEFAULT NULL,
  `job_role` text COLLATE utf8_unicode_ci,
  `job_desc` text COLLATE utf8_unicode_ci,
  `monthly_sal` int(10) unsigned DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `member_work_expi`
--

INSERT INTO `member_work_expi` (`id`, `member_id`, `company_name`, `location`, `industry`, `date_joined_from`, `date_joined_to`, `job_title`, `position_lvl`, `specialization`, `job_role`, `job_desc`, `monthly_sal`) VALUES
(1, 13, 'FH International', 'makati', 'it', '2015-08-01 00:00:00', '2015-08-31 00:00:00', 'sr. php developer', 'supervisor', 'it', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer nec odio. Praesent libero. Sed cursus ante dapibus diam. Sed nisi. Nulla quis sem at nibh elementum imperdiet. Duis sagittis ipsum. Praesent mauris.', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer nec odio. Praesent libero. Sed cursus ante dapibus diam. Sed nisi. Nulla quis sem at nibh elementum imperdiet. Duis sagittis ipsum. Praesent mauris.', 50000),
(2, 13, 'rendition digital', 'makati', 'it', '2015-08-02 00:00:00', '2015-08-16 00:00:00', 'web designer', 'regular employee', 'web design', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer nec odio. Praesent libero. Sed cursus ante dapibus diam. Sed nisi. Nulla quis sem at nibh elementum imperdiet. Duis sagittis ipsum. Praesent mauris.', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer nec odio. Praesent libero. Sed cursus ante dapibus diam. Sed nisi. Nulla quis sem at nibh elementum imperdiet. Duis sagittis ipsum. Praesent mauris.', 60000);

-- --------------------------------------------------------

--
-- Table structure for table `player`
--

CREATE TABLE IF NOT EXISTS `player` (
  `playerId` int(10) unsigned NOT NULL,
  `username` varchar(100) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `password` varchar(100) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `active` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `email` varchar(250) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `secretQuestion` varchar(100) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `secretAnswer` varchar(100) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `lastLoginIp` varchar(15) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `lastLoginTime` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `lastLogoutTime` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `createdOn` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updatedOn` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `blocked` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `blockedUntil` int(11) unsigned NOT NULL DEFAULT '0',
  `blockedAfter` int(11) unsigned NOT NULL DEFAULT '0',
  `verify` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `lockedStart` datetime DEFAULT '0000-00-00 00:00:00',
  `lockedEnd` datetime DEFAULT '0000-00-00 00:00:00',
  `status` int(1) NOT NULL DEFAULT '0' COMMENT '0 - normal; 1 - frozen, 2 - locked',
  `online` enum('0','1') COLLATE utf8_unicode_ci NOT NULL DEFAULT '1' COMMENT '0 - online; 1 - offline;'
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `player`
--

INSERT INTO `player` (`playerId`, `username`, `password`, `active`, `email`, `secretQuestion`, `secretAnswer`, `lastLoginIp`, `lastLoginTime`, `lastLogoutTime`, `createdOn`, `updatedOn`, `blocked`, `blockedUntil`, `blockedAfter`, `verify`, `lockedStart`, `lockedEnd`, `status`, `online`) VALUES
(1, 'test@gmail.com', '$P$BkVCO07UGYtZEi4aSHSc.8WePsFHc90', 0, 'test@gmail.com', '', '', '127.0.0.1', '2015-03-25 06:27:55', '0000-00-00 00:00:00', '2015-03-25 06:27:55', '0000-00-00 00:00:00', 0, 0, 0, 'pXMml9FdVoNOAvRB5IPkSH7JL8a0zy1C', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '1'),
(2, 'test@g.sdf', '$P$BUJSIcNXGan9w/sYEefUwbwJNDhVLt.', 0, 'test@g.sdf', '', '', '127.0.0.1', '2015-03-25 06:32:45', '0000-00-00 00:00:00', '2015-03-25 06:32:45', '0000-00-00 00:00:00', 0, 0, 0, 'cCtVBirIbnv3KO40ze8NUu2k7fjTsFxd', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '1'),
(3, 'test23@gsdg.vom', '$P$BbCqqEOwczSPOK.NE4ieEdYd3.ZEPz0', 0, 'test23@gsdg.vom', '', '', '127.0.0.1', '2015-03-25 06:39:51', '2015-03-25 08:07:28', '2015-03-25 06:39:51', '0000-00-00 00:00:00', 0, 0, 0, 'E71u5XgCbpMDQiactwmKfTJ2szhkHV4q', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '1'),
(4, 'test1234@gmail.com', '$P$BGSPsfPDRUIgUFMETviAWzK6JeUTsR/', 0, 'test1234@gmail.com', '', '', '127.0.0.1', '2015-03-29 20:03:11', '2015-03-29 20:03:27', '2015-03-29 20:02:49', '0000-00-00 00:00:00', 0, 0, 0, 'ZOovG3aBLTg4zEQ9j62si08K1ShulARc', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '1'),
(5, 'mem1@gmail.com', '$P$BlRCDjTCQvwB5kkMvXoyb.uelNQDle.', 0, 'mem1@gmail.com', '', '', '127.0.0.1', '2015-08-08 06:49:21', '2015-08-08 06:46:09', '2015-03-30 01:26:43', '0000-00-00 00:00:00', 0, 0, 0, 'rCghDGk80fNc2QMOPemKota5Wy36AnES', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '0'),
(6, 'asriiapp1@gmail.com', '$P$BR5UvMTaHWr61dSs7r.eTCkONwZapc/', 0, 'asriiapp1@gmail.com', '', '', '127.0.0.1', '2015-04-30 09:55:33', '2015-04-30 09:55:55', '2015-04-16 11:49:45', '0000-00-00 00:00:00', 0, 0, 0, 'PzeJ9pIujmtrg8i0a2LQS3xMNwVEXDcU', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '1'),
(7, 'testmem1@gmail.com', '$P$Be6IqMYYwKnI3jRgJ6diURnfdln1te/', 0, 'testmem1@gmail.com', '', '', '127.0.0.1', '2015-04-20 06:09:07', '2015-08-08 06:49:01', '2015-04-19 04:44:42', '0000-00-00 00:00:00', 0, 0, 0, 'rPEWql8tZ3KumMcJoYjiaCTV9BLvXHez', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '1'),
(8, 'testmem2@gmail.com', '$P$BCl2nWxV3mPX.VAGzYfib.19a9QoR3.', 0, 'testmem2@gmail.com', '', '', '127.0.0.1', '2015-04-19 04:47:57', '2015-04-19 04:53:45', '2015-04-19 04:47:56', '0000-00-00 00:00:00', 0, 0, 0, 'M7J3VLX9d8qE5z4FwOiBgPaY1USQeDGI', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '1'),
(9, 'testmem3@gmail.com', '$P$BNmEhkdAgN3jpHiCaeCfb1GwmssENe0', 0, 'testmem3@gmail.com', '', '', '127.0.0.1', '2015-04-19 04:54:23', '2015-04-28 12:41:36', '2015-04-19 04:54:22', '0000-00-00 00:00:00', 0, 0, 0, 'DS4kImXYTWRfJFPw01BMhodiCaLruGNV', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '1'),
(10, 'testmem12@gmail.com', '$P$B4EC/sBSEE8cfEM5QvZtZbO920.GaL.', 0, 'testmem12@gmail.com', '', '', '127.0.0.1', '2015-04-19 16:10:33', '2004-12-31 22:37:17', '2015-04-19 16:10:32', '0000-00-00 00:00:00', 0, 0, 0, 'myvVAOKz2SHucFIWpJXfaE1Yejkhsrtx', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '1'),
(11, 'asda@das.cas', '$P$Brxi68m5Bk4qg1NRh9ecoloNOZwCBn1', 0, 'asda@das.cas', '', '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '2015-04-30 10:38:21', '0000-00-00 00:00:00', 0, 0, 0, 'Hmqco96wnWTg50RdpkFZNVih4lECMJDP', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '1'),
(12, 'jona@gmail.com', '$P$BhzyRGhmHR4z4hb8zOQSFTeus9YzLn.', 0, 'jona@gmail.com', '', '', '127.0.0.1', '2015-04-30 10:39:31', '2015-04-30 11:06:38', '2015-04-30 10:39:31', '0000-00-00 00:00:00', 0, 0, 0, 'xgehMnjRaGPN0ZBQTbr6v1SUW2EuypJm', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '1'),
(13, 'asriinew@gmail.com', '$P$Be0d20M4ngBZdloqQhoc4PNmI8cixQ.', 0, 'asriinew@gmail.com', '', '', '127.0.0.1', '2015-08-13 09:12:22', '0000-00-00 00:00:00', '2015-08-12 10:52:59', '0000-00-00 00:00:00', 0, 0, 0, '8sxmSd6qa0GZHhV7OEAjTRbe9LvipMzn', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '0');

-- --------------------------------------------------------

--
-- Table structure for table `playerdetails`
--

CREATE TABLE IF NOT EXISTS `playerdetails` (
  `playerDetailsId` int(10) unsigned NOT NULL,
  `playerId` int(10) unsigned NOT NULL DEFAULT '0',
  `firstName` varchar(32) COLLATE utf8_unicode_ci DEFAULT NULL,
  `lastName` varchar(32) COLLATE utf8_unicode_ci DEFAULT NULL,
  `language` varchar(32) COLLATE utf8_unicode_ci DEFAULT NULL,
  `country` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `address` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `city` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `gender` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `zipcode` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `citizenship` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `region` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `birthdate` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `birthplace` varchar(32) COLLATE utf8_unicode_ci DEFAULT NULL,
  `phone` varchar(32) COLLATE utf8_unicode_ci DEFAULT '',
  `contactNumber` varchar(32) COLLATE utf8_unicode_ci DEFAULT '',
  `preferredContact` varchar(32) COLLATE utf8_unicode_ci DEFAULT NULL,
  `registrationWebsite` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `registrationIP` varchar(32) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=MyISAM AUTO_INCREMENT=13 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `playerdetails`
--

INSERT INTO `playerdetails` (`playerDetailsId`, `playerId`, `firstName`, `lastName`, `language`, `country`, `address`, `city`, `gender`, `zipcode`, `citizenship`, `region`, `birthdate`, `birthplace`, `phone`, `contactNumber`, `preferredContact`, `registrationWebsite`, `registrationIP`) VALUES
(1, 1, 'test', 'test', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', NULL, 'http://demo.ajkk.com/', '127.0.0.1'),
(2, 2, 'tewt', 'setst', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', NULL, 'http://demo.ajkk.com/', '127.0.0.1'),
(3, 3, 'sadsad', 'dfsfsd', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', NULL, 'http://demo.ajkk.com/', '127.0.0.1'),
(4, 4, 'testemp', '1234', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', NULL, 'http://demo.jobkonek.com/', '127.0.0.1'),
(5, 5, 'member', 'one', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', NULL, 'http://demo.jobkonek.com/', '127.0.0.1'),
(6, 6, 'asriifname', 'asriilname', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', NULL, 'http://demo.ajkk.com/', '127.0.0.1'),
(7, 7, 'testmemfname', 'testmemlname', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', NULL, 'http://demo.jobkonek.com/', '127.0.0.1'),
(8, 8, 'testmemtwofname', 'testmemtwolname', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', NULL, 'http://demo.jobkonek.com/', '127.0.0.1'),
(9, 9, 'testmemfname', 'testmemlname', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', NULL, 'http://demo.jobkonek.com/', '127.0.0.1'),
(10, 10, 'test', 'test', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', NULL, 'http://demo.jobkonek.com/', '127.0.0.1'),
(11, 12, 'asda', 'asda', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', NULL, 'http://demo.ajkk.com/', '127.0.0.1'),
(12, 13, 'andy', 'radam', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', NULL, 'http://127.0.0.1/jk3.0/', '127.0.0.1');

-- --------------------------------------------------------

--
-- Table structure for table `playertag`
--

CREATE TABLE IF NOT EXISTS `playertag` (
  `playerTagId` int(10) unsigned NOT NULL,
  `playerId` int(10) unsigned NOT NULL DEFAULT '0',
  `taggerId` int(10) unsigned NOT NULL DEFAULT '0',
  `tagId` int(10) NOT NULL,
  `createdOn` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updatedOn` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `status` varchar(32) COLLATE utf8_unicode_ci NOT NULL DEFAULT ''
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tag`
--

CREATE TABLE IF NOT EXISTS `tag` (
  `tagId` int(10) NOT NULL,
  `tagName` varchar(32) COLLATE utf8_unicode_ci DEFAULT NULL,
  `tagDescription` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `createBy` int(10) DEFAULT NULL,
  `createdOn` datetime DEFAULT NULL,
  `updatedOn` datetime DEFAULT NULL,
  `status` varchar(1) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `automcomplete`
--
ALTER TABLE `automcomplete`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `avail_flpromo`
--
ALTER TABLE `avail_flpromo`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_avail_flpromo_ji` (`job_id`),
  ADD KEY `idx_avail_flpromo_ei` (`emp_id`);

--
-- Indexes for table `avail_jobpromo`
--
ALTER TABLE `avail_jobpromo`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_avail_jobpromo_jpi` (`job_id`),
  ADD KEY `idx_avail_jobpromo_epi` (`emp_id`);

--
-- Indexes for table `cmsbanner`
--
ALTER TABLE `cmsbanner`
  ADD PRIMARY KEY (`bannerId`,`createdOn`);

--
-- Indexes for table `cmsfootercontent`
--
ALTER TABLE `cmsfootercontent`
  ADD PRIMARY KEY (`footercontentId`);

--
-- Indexes for table `cmsnews`
--
ALTER TABLE `cmsnews`
  ADD PRIMARY KEY (`newsId`);

--
-- Indexes for table `country`
--
ALTER TABLE `country`
  ADD PRIMARY KEY (`countryId`);

--
-- Indexes for table `employer`
--
ALTER TABLE `employer`
  ADD PRIMARY KEY (`employerId`);

--
-- Indexes for table `employer_details`
--
ALTER TABLE `employer_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_employer_details` (`emp_id`);

--
-- Indexes for table `employer_media`
--
ALTER TABLE `employer_media`
  ADD PRIMARY KEY (`empMediaId`),
  ADD KEY `FK_emp_media` (`emp_id`);

--
-- Indexes for table `employer_membership`
--
ALTER TABLE `employer_membership`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_user_membership` (`id`,`emp_id`,`jobpost_expiration_date`,`jobpost_activation_date`,`membership_type`),
  ADD KEY `FK_user_membership` (`emp_id`);

--
-- Indexes for table `employer_self`
--
ALTER TABLE `employer_self`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_emp_self` (`emp_id`);

--
-- Indexes for table `emp_notification`
--
ALTER TABLE `emp_notification`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_employer_notification` (`emp_id`);

--
-- Indexes for table `freelancejob_applicant`
--
ALTER TABLE `freelancejob_applicant`
  ADD PRIMARY KEY (`jobApplicantId`),
  ADD KEY `idx_freelancejobapplicant` (`fljobId`,`applicantId`,`empId`),
  ADD KEY `FK_freelancejob_applicant_appid` (`applicantId`),
  ADD KEY `FK_freelancejob_applicant_empid` (`empId`);

--
-- Indexes for table `freelancejob_apply`
--
ALTER TABLE `freelancejob_apply`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_freelanceJob_apply_ji` (`flJobId`),
  ADD KEY `idx_freelanceJob_apply_mi` (`member_id`);

--
-- Indexes for table `freelancejob_save`
--
ALTER TABLE `freelancejob_save`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_freelanceJob_apply_ji` (`flJobId`),
  ADD KEY `idx_freelanceJob_apply_mi` (`member_id`);

--
-- Indexes for table `freelance_job`
--
ALTER TABLE `freelance_job`
  ADD PRIMARY KEY (`fljobId`),
  ADD KEY `idx_fljobs` (`emp_id`);

--
-- Indexes for table `freelance_job_doc`
--
ALTER TABLE `freelance_job_doc`
  ADD PRIMARY KEY (`freelanceJobDocId`),
  ADD KEY `FK_freelance_job_doc_ei` (`fljob_id`);

--
-- Indexes for table `freelance_skill_req`
--
ALTER TABLE `freelance_skill_req`
  ADD PRIMARY KEY (`fljobSkillReqId`),
  ADD KEY `idx_fljobSkillReqId` (`fljobSkillReqId`),
  ADD KEY `freelance_skill_req` (`flJobId`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`jobId`),
  ADD KEY `idx_jobs` (`emp_id`);

--
-- Indexes for table `jobviewlog`
--
ALTER TABLE `jobviewlog`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_jobviewlog_ji` (`jobId`),
  ADD KEY `idx_jobviewlog_mi` (`member_id`);

--
-- Indexes for table `job_applicant`
--
ALTER TABLE `job_applicant`
  ADD PRIMARY KEY (`jobApplicantId`),
  ADD KEY `idx_jobapplicant` (`jobId`,`applicantId`,`empId`),
  ADD KEY `FK_job_applicant_appid` (`applicantId`),
  ADD KEY `FK_job_applicant_empid` (`empId`);

--
-- Indexes for table `job_details`
--
ALTER TABLE `job_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_job_details` (`id`,`job_id`),
  ADD KEY `FK_job_details` (`job_id`);

--
-- Indexes for table `job_educ_reqs`
--
ALTER TABLE `job_educ_reqs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_job_educ_reqs` (`job_id`);

--
-- Indexes for table `job_employment_type`
--
ALTER TABLE `job_employment_type`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_job_emp_type` (`job_id`);

--
-- Indexes for table `job_other_benefits`
--
ALTER TABLE `job_other_benefits`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_job_other_ben` (`job_id`);

--
-- Indexes for table `job_save`
--
ALTER TABLE `job_save`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_job_save_j` (`jobId`),
  ADD KEY `idx_job_save_mi` (`member_id`);

--
-- Indexes for table `localbankdepositdetails`
--
ALTER TABLE `localbankdepositdetails`
  ADD PRIMARY KEY (`localbankdepositdetailsId`),
  ADD KEY `FK_localbankdepositdetails` (`employerId`);

--
-- Indexes for table `member_work_expi`
--
ALTER TABLE `member_work_expi`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `FK_member_work_expi_id` (`id`);

--
-- Indexes for table `player`
--
ALTER TABLE `player`
  ADD PRIMARY KEY (`playerId`);

--
-- Indexes for table `playerdetails`
--
ALTER TABLE `playerdetails`
  ADD PRIMARY KEY (`playerDetailsId`),
  ADD UNIQUE KEY `FK_playerId` (`playerId`);

--
-- Indexes for table `playertag`
--
ALTER TABLE `playertag`
  ADD PRIMARY KEY (`playerTagId`),
  ADD KEY `FK_playertag_playerId` (`playerId`),
  ADD KEY `FK_playertag_tagId` (`tagId`);

--
-- Indexes for table `tag`
--
ALTER TABLE `tag`
  ADD PRIMARY KEY (`tagId`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `automcomplete`
--
ALTER TABLE `automcomplete`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `avail_flpromo`
--
ALTER TABLE `avail_flpromo`
  MODIFY `id` int(11) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=83;
--
-- AUTO_INCREMENT for table `avail_jobpromo`
--
ALTER TABLE `avail_jobpromo`
  MODIFY `id` int(11) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=39;
--
-- AUTO_INCREMENT for table `cmsbanner`
--
ALTER TABLE `cmsbanner`
  MODIFY `bannerId` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `cmsfootercontent`
--
ALTER TABLE `cmsfootercontent`
  MODIFY `footercontentId` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `cmsnews`
--
ALTER TABLE `cmsnews`
  MODIFY `newsId` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `country`
--
ALTER TABLE `country`
  MODIFY `countryId` int(10) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=250;
--
-- AUTO_INCREMENT for table `employer`
--
ALTER TABLE `employer`
  MODIFY `employerId` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `employer_details`
--
ALTER TABLE `employer_details`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT for table `employer_media`
--
ALTER TABLE `employer_media`
  MODIFY `empMediaId` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `employer_membership`
--
ALTER TABLE `employer_membership`
  MODIFY `id` int(11) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT for table `employer_self`
--
ALTER TABLE `employer_self`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT for table `emp_notification`
--
ALTER TABLE `emp_notification`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT for table `freelancejob_applicant`
--
ALTER TABLE `freelancejob_applicant`
  MODIFY `jobApplicantId` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `freelancejob_apply`
--
ALTER TABLE `freelancejob_apply`
  MODIFY `id` int(11) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `freelancejob_save`
--
ALTER TABLE `freelancejob_save`
  MODIFY `id` int(11) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `freelance_job`
--
ALTER TABLE `freelance_job`
  MODIFY `fljobId` int(11) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=142;
--
-- AUTO_INCREMENT for table `freelance_job_doc`
--
ALTER TABLE `freelance_job_doc`
  MODIFY `freelanceJobDocId` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `freelance_skill_req`
--
ALTER TABLE `freelance_skill_req`
  MODIFY `fljobSkillReqId` int(11) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=108;
--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `jobId` int(11) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=78;
--
-- AUTO_INCREMENT for table `jobviewlog`
--
ALTER TABLE `jobviewlog`
  MODIFY `id` int(11) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=138;
--
-- AUTO_INCREMENT for table `job_applicant`
--
ALTER TABLE `job_applicant`
  MODIFY `jobApplicantId` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `job_details`
--
ALTER TABLE `job_details`
  MODIFY `id` int(11) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=71;
--
-- AUTO_INCREMENT for table `job_educ_reqs`
--
ALTER TABLE `job_educ_reqs`
  MODIFY `id` int(11) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=172;
--
-- AUTO_INCREMENT for table `job_employment_type`
--
ALTER TABLE `job_employment_type`
  MODIFY `id` int(11) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=163;
--
-- AUTO_INCREMENT for table `job_other_benefits`
--
ALTER TABLE `job_other_benefits`
  MODIFY `id` int(11) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=487;
--
-- AUTO_INCREMENT for table `job_save`
--
ALTER TABLE `job_save`
  MODIFY `id` int(11) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `localbankdepositdetails`
--
ALTER TABLE `localbankdepositdetails`
  MODIFY `localbankdepositdetailsId` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `member_work_expi`
--
ALTER TABLE `member_work_expi`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `player`
--
ALTER TABLE `player`
  MODIFY `playerId` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT for table `playerdetails`
--
ALTER TABLE `playerdetails`
  MODIFY `playerDetailsId` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `playertag`
--
ALTER TABLE `playertag`
  MODIFY `playerTagId` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tag`
--
ALTER TABLE `tag`
  MODIFY `tagId` int(10) NOT NULL AUTO_INCREMENT;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `employer_details`
--
ALTER TABLE `employer_details`
  ADD CONSTRAINT `FK_emp_details` FOREIGN KEY (`emp_id`) REFERENCES `employer` (`employerId`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `employer_media`
--
ALTER TABLE `employer_media`
  ADD CONSTRAINT `FK_emp_media` FOREIGN KEY (`emp_id`) REFERENCES `employer` (`employerId`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `employer_membership`
--
ALTER TABLE `employer_membership`
  ADD CONSTRAINT `FK_user_membership` FOREIGN KEY (`emp_id`) REFERENCES `employer` (`employerId`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `employer_self`
--
ALTER TABLE `employer_self`
  ADD CONSTRAINT `FK_emp_self` FOREIGN KEY (`emp_id`) REFERENCES `employer` (`employerId`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `emp_notification`
--
ALTER TABLE `emp_notification`
  ADD CONSTRAINT `FK_emp_notifiy` FOREIGN KEY (`emp_id`) REFERENCES `employer` (`employerId`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `freelancejob_applicant`
--
ALTER TABLE `freelancejob_applicant`
  ADD CONSTRAINT `FK_freelancejob_applicant_ai` FOREIGN KEY (`applicantId`) REFERENCES `player` (`playerId`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_freelancejob_applicant_ei` FOREIGN KEY (`empId`) REFERENCES `employer` (`employerId`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_freelancejob_applicant_fji` FOREIGN KEY (`fljobId`) REFERENCES `freelance_job` (`fljobId`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `freelancejob_apply`
--
ALTER TABLE `freelancejob_apply`
  ADD CONSTRAINT `FK_freelanceJob_apply` FOREIGN KEY (`flJobId`) REFERENCES `freelance_job` (`fljobId`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_freelancejob_apply_mi` FOREIGN KEY (`member_id`) REFERENCES `player` (`playerId`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `freelancejob_save`
--
ALTER TABLE `freelancejob_save`
  ADD CONSTRAINT `FK_freelancejob_save_flj` FOREIGN KEY (`flJobId`) REFERENCES `freelance_job` (`fljobId`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_freelancejob_save_mi` FOREIGN KEY (`member_id`) REFERENCES `player` (`playerId`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `freelance_job_doc`
--
ALTER TABLE `freelance_job_doc`
  ADD CONSTRAINT `FK_freelance_job_doc` FOREIGN KEY (`fljob_id`) REFERENCES `freelance_job` (`fljobId`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `freelance_skill_req`
--
ALTER TABLE `freelance_skill_req`
  ADD CONSTRAINT `freelance_skill_req` FOREIGN KEY (`flJobId`) REFERENCES `freelance_job` (`fljobId`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `job_applicant`
--
ALTER TABLE `job_applicant`
  ADD CONSTRAINT `FK_job_applicant` FOREIGN KEY (`jobId`) REFERENCES `jobs` (`jobId`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_job_applicant_empid` FOREIGN KEY (`empId`) REFERENCES `employer` (`employerId`);

--
-- Constraints for table `job_details`
--
ALTER TABLE `job_details`
  ADD CONSTRAINT `FK_job_details` FOREIGN KEY (`job_id`) REFERENCES `jobs` (`jobId`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `job_educ_reqs`
--
ALTER TABLE `job_educ_reqs`
  ADD CONSTRAINT `FK_job_educ_reqs` FOREIGN KEY (`job_id`) REFERENCES `jobs` (`jobId`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `job_employment_type`
--
ALTER TABLE `job_employment_type`
  ADD CONSTRAINT `FK_job_emp_type` FOREIGN KEY (`job_id`) REFERENCES `jobs` (`jobId`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `job_other_benefits`
--
ALTER TABLE `job_other_benefits`
  ADD CONSTRAINT `FK_job_other_ben` FOREIGN KEY (`job_id`) REFERENCES `jobs` (`jobId`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `job_save`
--
ALTER TABLE `job_save`
  ADD CONSTRAINT `FK_job_save_j` FOREIGN KEY (`jobId`) REFERENCES `jobs` (`jobId`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_job_save_mi` FOREIGN KEY (`member_id`) REFERENCES `player` (`playerId`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `localbankdepositdetails`
--
ALTER TABLE `localbankdepositdetails`
  ADD CONSTRAINT `FK_localbankdepositdetails` FOREIGN KEY (`employerId`) REFERENCES `employer` (`employerId`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
