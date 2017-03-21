-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Anamakine: 127.0.0.1
-- Üretim Zamanı: 21 Mar 2017, 18:22:21
-- Sunucu sürümü: 10.1.16-MariaDB
-- PHP Sürümü: 7.0.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Veritabanı: `login`
--

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `uyeler`
--

CREATE TABLE `uyeler` (
  `uid` int(11) NOT NULL,
  `uad` varchar(255) NOT NULL,
  `ad` varchar(255) NOT NULL,
  `soyad` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `sifre` varchar(255) NOT NULL,
  `onaykod` varchar(255) NOT NULL,
  `ktarih` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `aktif` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Tablo döküm verisi `uyeler`
--

INSERT INTO `uyeler` (`uid`, `uad`, `ad`, `soyad`, `email`, `sifre`, `onaykod`, `ktarih`, `aktif`) VALUES
(1, 'somer', '&Ouml;mer', 'Sevinc', 'omer@gmail.com', '81dc9bdb52d04dc20036dbd8313ed055', '0', '2017-03-13 13:42:54', 1),
(2, 'vkmyo', 'vezirkopru', 'myo', 'vkmyo@omu.edu', 'b59c67bf196a4758191e42f76670ceba', '0', '2017-03-14 17:16:17', 1),
(3, 'ilk55', 'ilk', 'ikinci', 'ilk@omu.edu', '81dc9bdb52d04dc20036dbd8313ed055', '0', '2017-03-21 20:04:03', 1);

--
-- Dökümü yapılmış tablolar için indeksler
--

--
-- Tablo için indeksler `uyeler`
--
ALTER TABLE `uyeler`
  ADD PRIMARY KEY (`uid`);

--
-- Dökümü yapılmış tablolar için AUTO_INCREMENT değeri
--

--
-- Tablo için AUTO_INCREMENT değeri `uyeler`
--
ALTER TABLE `uyeler`
  MODIFY `uid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
