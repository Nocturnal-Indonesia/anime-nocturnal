-- Adminer 4.2.5 MySQL dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

DROP TABLE IF EXISTS `account_data`;
CREATE TABLE `account_data` (
  `userid` varchar(16) NOT NULL,
  `username` varchar(64) NOT NULL,
  `email` varchar(64) NOT NULL,
  `password` text NOT NULL,
  `ukey` varchar(72) NOT NULL,
  `authority` enum('root','admin','user') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `account_data` (`userid`, `username`, `email`, `password`, `ukey`, `authority`) VALUES
('6616291423635948',	'ammarfaizi2',	'ammarfaizi2@gmail.com',	'=AgBwaTNukSzN1CyO3yLs4q90Q7S',	'jn_vgp6begk_l7ktzc_bg28zqk2zfuo0wy2mm7l9cy5advmwfb69me_76616291423635948',	'user');

DROP TABLE IF EXISTS `account_info`;
CREATE TABLE `account_info` (
  `userid` varchar(16) NOT NULL,
  `nama` varchar(225) NOT NULL,
  `tmplahir` varchar(225) NOT NULL,
  `tgllahir` date NOT NULL,
  `alamat` text NOT NULL,
  `phone` varchar(20) NOT NULL,
  `tgldaftar` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `account_info` (`userid`, `nama`, `tmplahir`, `tgllahir`, `alamat`, `phone`, `tgldaftar`) VALUES
('6616291423635948',	'Ammar Faizi',	'Surakarta',	'1996-12-07',	'Candi Asri 1 No.125 RT38 RW09',	'087836832000',	'2017-05-06 19:23:50');

DROP TABLE IF EXISTS `login_session`;
CREATE TABLE `login_session` (
  `userid` varchar(16) NOT NULL,
  `session` varchar(72) NOT NULL,
  `login_at` datetime NOT NULL,
  `expired_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


-- 2017-05-07 12:35:25
