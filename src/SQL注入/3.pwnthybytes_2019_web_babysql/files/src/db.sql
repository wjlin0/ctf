SET NAMES utf8;
SET FOREIGN_KEY_CHECKS = 0;

DROP DATABASE IF EXISTS `ctftraining`;
CREATE DATABASE ptbctf;
USE ptbctf;

DROP TABLE IF EXISTS `ptbctf`;
CREATE TABLE `ptbctf` (
  `username` text CHARACTER SET GBK NOT NULL,
  `password` text CHARACTER SET GBK NOT NULL
) ENGINE=InnoDB CHARSET=utf8;


INSERT `ptbctf` (`username`,`password`) VALUES ('flag','Flag is in the database but not here.');


DROP TABLE IF EXISTS `flag_tbl`;
CREATE TABLE `flag_tbl` (
    `secret` text NOT NULL
) ENGINE=InnoDB CHARSET=utf8;

