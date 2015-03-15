-- phpMyAdmin SQL Dump
-- version 4.0.10deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Mar 14, 2015 at 09:54 PM
-- Server version: 5.5.41-0ubuntu0.14.04.1
-- PHP Version: 5.5.9-1ubuntu4.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `daejeonhub`
--

-- --------------------------------------------------------

--
-- Table structure for table `answereds`
--

CREATE TABLE IF NOT EXISTS `answereds` (
  `id_aswered` int(11) NOT NULL AUTO_INCREMENT,
  `id_user` int(11) NOT NULL,
  `id_topic` int(11) NOT NULL,
  `id_reply` int(11) NOT NULL,
  PRIMARY KEY (`id_aswered`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=25 ;

--
-- Dumping data for table `answereds`
--

INSERT INTO `answereds` (`id_aswered`, `id_user`, `id_topic`, `id_reply`) VALUES
(14, 15, 15, 179),
(15, 18, 15, 179),
(16, 15, 20, 169),
(17, 18, 25, 180),
(18, 15, 25, 180),
(19, 22, 25, 181),
(20, 15, 25, 181),
(21, 22, 25, 180),
(22, 23, 15, 166),
(23, 23, 15, 177),
(24, 25, 24, 182);

-- --------------------------------------------------------

--
-- Table structure for table `artifacts`
--

CREATE TABLE IF NOT EXISTS `artifacts` (
  `id_artifact` int(11) NOT NULL AUTO_INCREMENT,
  `id_topic` int(11) NOT NULL,
  `id_reply` int(11) DEFAULT NULL,
  `path` text NOT NULL,
  PRIMARY KEY (`id_artifact`),
  KEY `fk_topic_idx` (`id_topic`),
  KEY `id_reply_idx` (`id_reply`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=36 ;

--
-- Dumping data for table `artifacts`
--

INSERT INTO `artifacts` (`id_artifact`, `id_topic`, `id_reply`, `path`) VALUES
(31, 15, 156, '98a5919c3dc9d8515f4611dfd351f73f.png'),
(32, 15, 178, 'af7d6e972f8721a11fc1aafb80ab0b6d.png'),
(33, 15, 179, 'b66a607a577e231f6d31a1659eb121d6.jpg'),
(34, 25, 180, '852bd400eab2729ef24d5e4af4357d0c.jpg'),
(35, 25, 181, 'c4dcbf07ba5745c70ec3cdc55bf9b7cb.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE IF NOT EXISTS `categories` (
  `idcategory` int(11) NOT NULL AUTO_INCREMENT,
  `category` varchar(100) NOT NULL,
  PRIMARY KEY (`idcategory`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=15 ;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`idcategory`, `category`) VALUES
(1, 'Other'),
(2, 'Health'),
(3, 'Education'),
(4, 'City Life'),
(5, 'Party'),
(6, 'Shopping'),
(7, 'Events'),
(8, 'Food'),
(9, 'Places'),
(10, 'Security'),
(11, 'Finances'),
(12, 'Sports'),
(13, 'Entertainment'),
(14, 'Job');

-- --------------------------------------------------------

--
-- Table structure for table `countries`
--

CREATE TABLE IF NOT EXISTS `countries` (
  `idcountries` int(11) NOT NULL AUTO_INCREMENT,
  `country` varchar(100) NOT NULL,
  `flag_url` varchar(100) NOT NULL,
  PRIMARY KEY (`idcountries`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=244 ;

--
-- Dumping data for table `countries`
--

INSERT INTO `countries` (`idcountries`, `country`, `flag_url`) VALUES
(1, 'Afghanistan', ''),
(2, 'Aland Islands', ''),
(3, 'Albania', ''),
(4, 'Algeria', ''),
(5, 'American Samoa', ''),
(6, 'Andorra', ''),
(7, 'Angola', ''),
(8, 'Anguilla', ''),
(9, 'Antarctica', ''),
(10, 'Antigua And Barbuda', ''),
(11, 'Argentina', ''),
(12, 'Armenia', ''),
(13, 'Aruba', ''),
(14, 'Australia', ''),
(15, 'Austria', ''),
(16, 'Azerbaijan', ''),
(17, 'Bahamas', ''),
(18, 'Bahrain', ''),
(19, 'Bangladesh', ''),
(20, 'Barbados', ''),
(21, 'Belarus', ''),
(22, 'Belgium', ''),
(23, 'Belize', ''),
(24, 'Benin', ''),
(25, 'Bermuda', ''),
(26, 'Bhutan', ''),
(27, 'Bolivia', ''),
(28, 'Bosnia And Herzegovina', ''),
(29, 'Botswana', ''),
(30, 'Bouvet Island', ''),
(31, 'Brazil', ''),
(32, 'British Indian Ocean Territory', ''),
(33, 'Brunei Darussalam', ''),
(34, 'Bulgaria', ''),
(35, 'Burkina Faso', ''),
(36, 'Burundi', ''),
(37, 'Cambodia', ''),
(38, 'Cameroon', ''),
(39, 'Canada', ''),
(40, 'Cape Verde', ''),
(41, 'Cayman Islands', ''),
(42, 'Central African Republic', ''),
(43, 'Chad', ''),
(44, 'Chile', ''),
(45, 'China', ''),
(46, 'Christmas Island', ''),
(47, 'Cocos (Keeling) Islands', ''),
(48, 'Colombia', ''),
(49, 'Comoros', ''),
(50, 'Congo', ''),
(51, 'Congo', ' The Democratic Republic Of The'),
(52, 'Cook Islands', ''),
(53, 'Costa Rica', ''),
(54, 'Cote D''Ivoire', ''),
(55, 'Croatia', ''),
(56, 'Cuba', ''),
(57, 'Cyprus', ''),
(58, 'Czech Republic', ''),
(59, 'Denmark', ''),
(60, 'Djibouti', ''),
(61, 'Dominica', ''),
(62, 'Dominican Republic', ''),
(63, 'Ecuador', ''),
(64, 'Egypt', ''),
(65, 'El Salvador', ''),
(66, 'Equatorial Guinea', ''),
(67, 'Eritrea', ''),
(68, 'Estonia', ''),
(69, 'Ethiopia', ''),
(70, 'Falkland Islands (Malvinas)', ''),
(71, 'Faroe Islands', ''),
(72, 'Fiji', ''),
(73, 'Finland', ''),
(74, 'France', ''),
(75, 'French Guiana', ''),
(76, 'French Polynesia', ''),
(77, 'French Southern Territories', ''),
(78, 'Gabon', ''),
(79, 'Gambia', ''),
(80, 'Georgia', ''),
(81, 'Germany', ''),
(82, 'Ghana', ''),
(83, 'Gibraltar', ''),
(84, 'Greece', ''),
(85, 'Greenland', ''),
(86, 'Grenada', ''),
(87, 'Guadeloupe', ''),
(88, 'Guam', ''),
(89, 'Guatemala', ''),
(90, 'Guernsey', ''),
(91, 'Guinea', ''),
(92, 'Guinea-Bissau', ''),
(93, 'Guyana', ''),
(94, 'Haiti', ''),
(95, 'Heard Island And Mcdonald Islands', ''),
(96, 'Holy See (Vatican City State)', ''),
(97, 'Honduras', ''),
(98, 'Hong Kong', ''),
(99, 'Hungary', ''),
(100, 'Iceland', ''),
(101, 'India', ''),
(102, 'Indonesia', ''),
(103, 'Iran', ' Islamic Republic Of'),
(104, 'Iraq', ''),
(105, 'Ireland', ''),
(106, 'Isle Of Man', ''),
(107, 'Israel', ''),
(108, 'Italy', ''),
(109, 'Jamaica', ''),
(110, 'Japan', ''),
(111, 'Jersey', ''),
(112, 'Jordan', ''),
(113, 'Kazakhstan', ''),
(114, 'Kenya', ''),
(115, 'Kiribati', ''),
(116, 'Korea', ' Democratic People''S Republic Of'),
(117, 'Korea', ' Republic Of'),
(118, 'Kuwait', ''),
(119, 'Kyrgyzstan', ''),
(120, 'Lao People''S Democratic Republic', ''),
(121, 'Latvia', ''),
(122, 'Lebanon', ''),
(123, 'Lesotho', ''),
(124, 'Liberia', ''),
(125, 'Libyan Arab Jamahiriya', ''),
(126, 'Liechtenstein', ''),
(127, 'Lithuania', ''),
(128, 'Luxembourg', ''),
(129, 'Macao', ''),
(130, 'Macedonia', ' The Former Yugoslav Republic Of'),
(131, 'Madagascar', ''),
(132, 'Malawi', ''),
(133, 'Malaysia', ''),
(134, 'Maldives', ''),
(135, 'Mali', ''),
(136, 'Malta', ''),
(137, 'Marshall Islands', ''),
(138, 'Martinique', ''),
(139, 'Mauritania', ''),
(140, 'Mauritius', ''),
(141, 'Mayotte', ''),
(142, 'Mexico', ''),
(143, 'Micronesia', ' Federated States Of'),
(144, 'Moldova', ' Republic Of'),
(145, 'Monaco', ''),
(146, 'Mongolia', ''),
(147, 'Montserrat', ''),
(148, 'Morocco', ''),
(149, 'Mozambique', ''),
(150, 'Myanmar', ''),
(151, 'Namibia', ''),
(152, 'Nauru', ''),
(153, 'Nepal', ''),
(154, 'Netherlands', ''),
(155, 'Netherlands Antilles', ''),
(156, 'New Caledonia', ''),
(157, 'New Zealand', ''),
(158, 'Nicaragua', ''),
(159, 'Niger', ''),
(160, 'Nigeria', ''),
(161, 'Niue', ''),
(162, 'Norfolk Island', ''),
(163, 'Northern Mariana Islands', ''),
(164, 'Norway', ''),
(165, 'Oman', ''),
(166, 'Pakistan', ''),
(167, 'Palau', ''),
(168, 'Palestinian Territory', ' Occupied'),
(169, 'Panama', ''),
(170, 'Papua New Guinea', ''),
(171, 'Paraguay', ''),
(172, 'Peru', ''),
(173, 'Philippines', ''),
(174, 'Pitcairn', ''),
(175, 'Poland', ''),
(176, 'Portugal', ''),
(177, 'Puerto Rico', ''),
(178, 'Qatar', ''),
(179, 'Reunion', ''),
(180, 'Romania', ''),
(181, 'Russian Federation', ''),
(182, 'Rwanda', ''),
(183, 'Saint Helena', ''),
(184, 'Saint Kitts And Nevis', ''),
(185, 'Saint Lucia', ''),
(186, 'Saint Pierre And Miquelon', ''),
(187, 'Saint Vincent And The Grenadines', ''),
(188, 'Samoa', ''),
(189, 'San Marino', ''),
(190, 'Sao Tome And Principe', ''),
(191, 'Saudi Arabia', ''),
(192, 'Senegal', ''),
(193, 'Serbia And Montenegro', ''),
(194, 'Seychelles', ''),
(195, 'Sierra Leone', ''),
(196, 'Singapore', ''),
(197, 'Slovakia', ''),
(198, 'Slovenia', ''),
(199, 'Solomon Islands', ''),
(200, 'Somalia', ''),
(201, 'South Africa', ''),
(202, 'South Georgia And The South Sandwich Islands', ''),
(203, 'Spain', ''),
(204, 'Sri Lanka', ''),
(205, 'Sudan', ''),
(206, 'Suriname', ''),
(207, 'Svalbard And Jan Mayen', ''),
(208, 'Swaziland', ''),
(209, 'Sweden', ''),
(210, 'Switzerland', ''),
(211, 'Syrian Arab Republic', ''),
(212, 'Taiwan', ' Province Of China'),
(213, 'Tajikistan', ''),
(214, 'Tanzania', ' United Republic Of'),
(215, 'Thailand', ''),
(216, 'Timor-Leste', ''),
(217, 'Togo', ''),
(218, 'Tokelau', ''),
(219, 'Tonga', ''),
(220, 'Trinidad And Tobago', ''),
(221, 'Tunisia', ''),
(222, 'Turkey', ''),
(223, 'Turkmenistan', ''),
(224, 'Turks And Caicos Islands', ''),
(225, 'Tuvalu', ''),
(226, 'Uganda', ''),
(227, 'Ukraine', ''),
(228, 'United Arab Emirates', ''),
(229, 'United Kingdom', ''),
(230, 'United States', ''),
(231, 'United States Minor Outlying Islands', ''),
(232, 'Uruguay', ''),
(233, 'Uzbekistan', ''),
(234, 'Vanuatu', ''),
(235, 'Venezuela', ''),
(236, 'Viet Nam', ''),
(237, 'Virgin Islands', ' British'),
(238, 'Virgin Islands', ' U.S.'),
(239, 'Wallis And Futuna', ''),
(240, 'Western Sahara', ''),
(241, 'Yemen', ''),
(242, 'Zambia', ''),
(243, 'Zimbabwe', '');

-- --------------------------------------------------------

--
-- Table structure for table `media`
--

CREATE TABLE IF NOT EXISTS `media` (
  `idmedia` int(11) NOT NULL AUTO_INCREMENT,
  `url` varchar(200) NOT NULL,
  `id_answer` int(11) DEFAULT NULL,
  `id_question` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  PRIMARY KEY (`idmedia`),
  KEY `fk_media_user_idx` (`id_user`),
  KEY `fk_media_question_idx` (`id_question`),
  KEY `fk_media_answer_idx` (`id_answer`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `question`
--

CREATE TABLE IF NOT EXISTS `question` (
  `idquestion` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(200) NOT NULL,
  `description` longtext,
  `registered_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `id_category` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  PRIMARY KEY (`idquestion`),
  KEY `fk_question_user_idx` (`id_user`),
  KEY `fk_question_1_idx` (`id_category`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `replies`
--

CREATE TABLE IF NOT EXISTS `replies` (
  `id_reply` int(12) NOT NULL AUTO_INCREMENT,
  `fk_topic` int(11) NOT NULL,
  `fk_user` int(11) NOT NULL,
  `description` text NOT NULL,
  `up_point` int(11) DEFAULT NULL,
  `registered_at` datetime NOT NULL,
  PRIMARY KEY (`id_reply`),
  KEY `fk_topic_idx` (`fk_topic`),
  KEY `fk_user_idx` (`fk_user`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=184 ;

--
-- Dumping data for table `replies`
--

INSERT INTO `replies` (`id_reply`, `fk_topic`, `fk_user`, `description`, `up_point`, `registered_at`) VALUES
(156, 17, 15, 'The best music ever!!!!!<div><br></div><embed width="320" height="245" src="http://www.youtube.com/v/NUsoVlDFqZg" type="application/x-shockwave-flash">', 0, '2014-06-14 15:38:52'),
(157, 18, 17, 'Here it is the Sun Medical Hospital. I think is a good option for you.', 0, '2014-06-15 03:09:23'),
(158, 18, 18, 'I have no Idea, but you can check this one.&nbsp;<h3 class="r" style="font-size: medium; margin: 0px; padding: 0px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap; color: rgb(34, 34, 34); font-family: arial, sans-serif;"><a href="http://eng.sunhospital.com/sunhealth/sub03.asp" style="color: rgb(102, 0, 153); cursor: pointer;">Sun Healthcare International</a></h3><div><br></div><div><br></div>', 0, '2014-06-15 13:38:54'),
(159, 19, 18, '', 0, '2014-06-15 13:39:39'),
(160, 17, 18, 'AliBaba!', 0, '2014-06-15 14:03:42'),
(161, 18, 15, 'Sun Medical is the closest one!', 0, '2014-06-15 14:09:20'),
(162, 18, 15, 'sadasdasdas', 0, '2014-06-15 14:14:06'),
(163, 18, 15, '12312312312312312', 0, '2014-06-15 14:14:32'),
(164, 18, 15, '\\test', 0, '2014-06-15 14:14:54'),
(165, 18, 15, 'Test', 0, '2014-06-15 14:15:37'),
(166, 15, 18, 'Home Plus!', 1, '2014-06-15 14:20:50'),
(167, 21, 15, 'Test image insert', 0, '2014-06-15 15:54:23'),
(168, 16, 15, '', 0, '2014-06-15 15:56:05'),
(169, 20, 15, 'test', 1, '2014-06-15 16:23:54'),
(170, 20, 15, '', 0, '2014-06-15 16:24:06'),
(171, 20, 15, '', 0, '2014-06-15 16:24:42'),
(172, 20, 15, '', 0, '2014-06-15 16:24:58'),
(173, 17, 15, '', 0, '2014-06-15 16:26:03'),
(174, 17, 15, '', 0, '2014-06-15 16:27:03'),
(175, 17, 15, '', 0, '2014-06-15 16:30:12'),
(176, 18, 15, '', 0, '2014-06-15 16:32:31'),
(177, 15, 15, '', 1, '2014-06-15 16:33:09'),
(178, 15, 15, 'te', 0, '2014-06-15 16:35:06'),
(179, 15, 15, 'You can find several options, but I suggest HomePlus!<div><br></div>', 2, '2014-06-15 16:37:51'),
(180, 25, 18, 'There is a good one in Dunsan. Here is a picture of the map.<div><br></div>', 3, '2014-06-16 11:31:14'),
(181, 25, 22, 'There is also one near Daejeon Station!<embed width="320" height="245" src="http://www.youtube.com/v/gzhJwgpjJ2I" type="application/x-shockwave-flash">', 2, '2014-06-16 11:41:23'),
(182, 24, 25, 'Na casa do carai&nbsp;', 1, '2014-06-23 09:10:22'),
(183, 15, 25, 'GC,IE', 0, '2014-06-23 09:11:43');

-- --------------------------------------------------------

--
-- Table structure for table `topics`
--

CREATE TABLE IF NOT EXISTS `topics` (
  `idtopics` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(45) NOT NULL,
  `description` text NOT NULL,
  `created_at` datetime NOT NULL,
  `fk_category` int(11) NOT NULL,
  `fk_user` int(11) NOT NULL,
  `seen_owner_in` datetime NOT NULL,
  `no_replies` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`idtopics`),
  KEY `fk_category_idx` (`fk_category`),
  KEY `fk_user_idx` (`fk_user`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=29 ;

--
-- Dumping data for table `topics`
--

INSERT INTO `topics` (`idtopics`, `title`, `description`, `created_at`, `fk_category`, `fk_user`, `seen_owner_in`, `no_replies`) VALUES
(15, 'Where can I buy a brand new Washing machine?', 'I''m looking for a brand new washing machine for a reasonable price. Any suggestion of where to find?', '2014-06-14 15:20:39', 6, 15, '2014-11-02 01:19:00', 5),
(16, 'How to use a Washing Machine? Does anybody kn', 'Everything is in Korean, I don''t understand!', '2014-06-14 15:22:24', 1, 15, '2014-08-12 00:11:36', 1),
(17, 'Where can I eat the best Kebab of the world?', 'I''m looking for the best Kebab in the world!             ', '2014-06-14 15:32:25', 8, 15, '2014-06-16 09:00:29', 3),
(18, 'Hospital in Yuseong-dong', 'Where is the nearest hospital within Yuseong-dong?', '2014-06-15 03:02:59', 2, 16, '2014-06-15 03:34:20', 2),
(19, 'Emart near KAIST', 'Is there any E-mart near KAIST?            ', '2014-06-15 13:01:51', 6, 18, '2014-06-15 13:41:34', 0),
(20, 'What does the fox says?', 'The secret of the fox?            ', '2014-06-15 13:54:40', 13, 15, '2014-06-15 16:46:53', 4),
(21, 'I''m looking for second hand Mac Books, any st', 'I''m looking for a MacBook Pro, does anybody know if there is any store in Daejeon?            ', '2014-06-15 14:01:11', 6, 15, '2014-06-15 15:54:23', 1),
(22, 'I''m just testing my new profile picture!', 'Testing            ', '2014-06-15 16:39:34', 11, 18, '2014-06-15 16:39:35', 0),
(23, 'Where can I find a good Washing Machine to se', 'I''m looking for a brand new Washing Machine!            ', '2014-06-16 08:47:21', 6, 19, '2014-11-02 01:16:40', 0),
(24, 'Brazilian Restaurant', 'Does anyone know where can I eat a good Brazilian food?', '2014-06-16 09:01:43', 8, 18, '2014-06-16 11:28:19', 1),
(25, 'Where can I find a good Mexican Restaurant in', 'I''m looking for a good restaurant to have Mexican dinner in Daejeon, I live near KAIST!            ', '2014-06-16 11:24:20', 8, 15, '2014-06-16 12:54:09', 2),
(26, 'Where can I see a good concert in Daejeon?', '            ', '2014-06-16 11:39:03', 7, 22, '2014-06-16 11:39:04', 0),
(27, 'dfsdsfsd', '            dsfsdfsdfsd', '2014-08-12 00:11:28', 7, 15, '2014-08-12 00:11:29', 0),
(28, 'testeeee', '            12312312', '2014-08-12 00:14:18', 10, 27, '2014-08-12 00:14:18', 0);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `iduser` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(45) NOT NULL,
  `email` varchar(100) NOT NULL,
  `created_at` datetime NOT NULL,
  `password` varchar(45) NOT NULL,
  `id_country` int(11) NOT NULL,
  `reputation` int(11) DEFAULT '0',
  `img_name` varchar(1000) DEFAULT 'system_default.jpg',
  PRIMARY KEY (`iduser`,`email`),
  KEY `fk_user_1_idx` (`id_country`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=28 ;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`iduser`, `username`, `email`, `created_at`, `password`, `id_country`, `reputation`, `img_name`) VALUES
(15, 'Aderlei', 'aderleifilho@uol.com.br', '2014-06-14 15:17:27', '', 31, 0, '529823416893605885d43eb66058aeb8.png'),
(16, 'Joao', 'joao@gmail.com', '2014-06-15 03:01:23', 'dccd96c256bc7dd39bae41a405f25e43', 31, 0, 'system_default.jpg'),
(17, 'Maria', 'maria@gmail.com', '2014-06-15 03:07:08', '263bce650e68ab4e23f28263760b9fa5', 31, 0, 'system_default.jpg'),
(18, 'Marcelo', 'm@m.com', '2014-06-15 13:01:12', '202cb962ac59075b964b07152d234b70', 228, 0, '8380d92ebd78a281be0537f4cac19958.png'),
(19, 'Aderlei', 'aderleifilho@kaist.ac.kr', '2014-06-16 08:46:26', 'e10adc3949ba59abbe56e057f20f883e', 31, 0, '0701e369092e49379338c829256cd07f.jpg'),
(20, 'Marc Juanes', 'marc@juanes.com', '2014-06-16 08:57:24', 'e10adc3949ba59abbe56e057f20f883e', 48, 0, 'system_default.jpg'),
(21, 'Thales', 'talao_brant@hotmail.com', '2014-06-16 11:27:34', '', 31, 0, 'http://graph.facebook.com/10203251877125055/picture?type=large'),
(22, 'Psy', 'psy@kaist.ac.kr', '2014-06-16 11:38:21', 'e10adc3949ba59abbe56e057f20f883e', 116, 0, 'dca6f5c11a4f815e1e2e8eb904aecac9.jpg'),
(23, 'Ruan', 'marques.ruan@gmail.com', '2014-06-19 11:58:13', '2ca83deb85344e5b4d5c95918fe50687', 31, 0, 'system_default.jpg'),
(25, 'Pedro Araujo De Carvalho', 'pedropeacar2@gmail.com', '2014-06-23 09:09:26', 'e10adc3949ba59abbe56e057f20f883e', 7, 0, 'system_default.jpg'),
(27, 'Roy', 'roy@toy.com', '2014-08-12 00:12:57', 'e10adc3949ba59abbe56e057f20f883e', 3, 0, '66fe60e2b8aace539367685f37c61cd5.png');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `artifacts`
--
ALTER TABLE `artifacts`
  ADD CONSTRAINT `id_reply` FOREIGN KEY (`id_reply`) REFERENCES `replies` (`id_reply`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `id_topic` FOREIGN KEY (`id_topic`) REFERENCES `topics` (`idtopics`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `media`
--
ALTER TABLE `media`
  ADD CONSTRAINT `fk_media_answer` FOREIGN KEY (`id_answer`) REFERENCES `answer` (`idanswer`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_media_question` FOREIGN KEY (`id_question`) REFERENCES `question` (`idquestion`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_media_user` FOREIGN KEY (`id_user`) REFERENCES `user` (`iduser`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `question`
--
ALTER TABLE `question`
  ADD CONSTRAINT `fk_question_1` FOREIGN KEY (`id_category`) REFERENCES `categories` (`idcategory`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_question_user` FOREIGN KEY (`id_user`) REFERENCES `user` (`iduser`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `replies`
--
ALTER TABLE `replies`
  ADD CONSTRAINT `fk_topic` FOREIGN KEY (`fk_topic`) REFERENCES `topics` (`idtopics`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `replies_ibfk_1` FOREIGN KEY (`fk_user`) REFERENCES `user` (`iduser`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `topics`
--
ALTER TABLE `topics`
  ADD CONSTRAINT `fk_category` FOREIGN KEY (`fk_category`) REFERENCES `categories` (`idcategory`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_user` FOREIGN KEY (`fk_user`) REFERENCES `user` (`iduser`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `fk_user_country` FOREIGN KEY (`id_country`) REFERENCES `countries` (`idcountries`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
