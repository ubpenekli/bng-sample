-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Anamakine: 127.0.0.1
-- Üretim Zamanı: 08 Eki 2020, 14:02:11
-- Sunucu sürümü: 10.4.6-MariaDB
-- PHP Sürümü: 7.3.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Veritabanı: `bng`
--

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `stocks`
--

CREATE TABLE `stocks` (
  `product_id` int(8) UNSIGNED ZEROFILL NOT NULL,
  `name` varchar(500) NOT NULL,
  `stock` int(11) NOT NULL,
  `created_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Tablo döküm verisi `stocks`
--

INSERT INTO `stocks` (`product_id`, `name`, `stock`, `created_date`) VALUES
(00000001, 'BNG Product 1', 35, '2020-10-08 11:37:00'),
(00000002, 'BNG Product 2', 35, '2020-10-08 11:37:00'),
(00000003, 'BNG Product 3', 35, '2020-10-08 11:37:00'),
(00000004, 'BNG Product 4', 35, '2020-10-08 11:37:00'),
(00000005, 'BNG Product 5', 35, '2020-10-08 11:37:00'),
(00000006, 'BNG Product 6', 35, '2020-10-08 11:37:00'),
(00000007, 'BNG Product 7', 35, '2020-10-08 11:37:00'),
(00000008, 'BNG Product 8', 35, '2020-10-08 11:37:00'),
(00000009, 'BNG Product 9', 35, '2020-10-08 11:37:00'),
(00000010, 'BNG Product 10', 35, '2020-10-08 11:37:00');

--
-- Dökümü yapılmış tablolar için indeksler
--

--
-- Tablo için indeksler `stocks`
--
ALTER TABLE `stocks`
  ADD PRIMARY KEY (`product_id`) USING BTREE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
