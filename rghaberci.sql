-- phpMyAdmin SQL Dump
-- version 3.3.7deb7
-- http://www.phpmyadmin.net
--
-- Sunucu sürümü: 5.1.66
-- PHP Sürümü: 5.3.3-7+squeeze15

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Veritabanı: `rghaberci`
--
CREATE DATABASE `rghaberci` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `rghaberci`;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `keywords`
--

CREATE TABLE IF NOT EXISTS `keywords` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `keyword` varchar(45) NOT NULL,
  `kwgroup` varchar(45) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `keyword_UNIQUE` (`keyword`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `person`
--

CREATE TABLE IF NOT EXISTS `person` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) NOT NULL,
  `email` varchar(45) NOT NULL,
  `kwgroup` varchar(10) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email_UNIQUE` (`email`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `results`
--

CREATE TABLE IF NOT EXISTS `results` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `keywordid` int(11) NOT NULL,
  `text` text NOT NULL,
  `keyindex` int(11) NOT NULL,
  `date` date NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_results_keywords` (`keywordid`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Dökümü yapılmış tablolar için kısıtlamalar
--

--
-- Tablo kısıtlamaları `results`
--
ALTER TABLE `results`
  ADD CONSTRAINT `fk_results_keywords` FOREIGN KEY (`keywordid`) REFERENCES `keywords` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;
