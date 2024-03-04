-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Anamakine: 127.0.0.1
-- Üretim Zamanı: 04 Mar 2024, 23:50:45
-- Sunucu sürümü: 10.4.27-MariaDB
-- PHP Sürümü: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Veritabanı: `task`
--

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `kitaplar`
--

CREATE TABLE `kitaplar` (
  `id` int(11) NOT NULL,
  `kitap_adi` varchar(50) NOT NULL,
  `kitap_yazari` varchar(50) NOT NULL,
  `kullanici_id` int(11) NOT NULL,
  `alma_tarihi` timestamp NOT NULL DEFAULT current_timestamp(),
  `teslim_tarihi` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Tablo döküm verisi `kitaplar`
--

INSERT INTO `kitaplar` (`id`, `kitap_adi`, `kitap_yazari`, `kullanici_id`, `alma_tarihi`, `teslim_tarihi`) VALUES
(1, 'Monte Cristo Kontu', 'Alexandre Dumas', 1, '2024-03-04 08:57:47', '2024-04-24 08:57:58'),
(2, 'Dorian Gray\'in Portresi', 'Oscar Wilde', 3, '2024-05-04 08:57:47', NULL),
(4, 'Beyaz Diş', 'Jack London', 3, '2024-04-04 08:57:47', '2024-05-04 10:42:51'),
(5, 'Kuyucaklı Yusuf', 'Sabahattin Ali', 1, '2024-03-04 08:57:47', NULL),
(6, '1984', 'George Orwell', 2, '2024-03-04 08:57:47', NULL);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `kullanicilar`
--

CREATE TABLE `kullanicilar` (
  `id` int(11) NOT NULL,
  `ad` varchar(50) NOT NULL,
  `soyad` varchar(50) NOT NULL,
  `kullanici_adi` varchar(50) NOT NULL,
  `sifre` varchar(50) NOT NULL,
  `e_mail` varchar(50) NOT NULL,
  `durum` enum('a','p') DEFAULT 'a'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Tablo döküm verisi `kullanicilar`
--

INSERT INTO `kullanicilar` (`id`, `ad`, `soyad`, `kullanici_adi`, `sifre`, `e_mail`, `durum`) VALUES
(1, 'Yazgül', 'Dönmez', 'yazgul', '123456', 'yazgul@hotmail.com', 'p'),
(2, 'Fatma', 'Sever', 'fatma99', '78900987', 'sever@hotmail.com', 'a'),
(3, 'Büşra', 'Akıncı', 'bus', 'busra1410', 'busra_akinci97@hotmail.com', 'p'),
(4, 'Meryem', 'Dönmez', 'meri', 'meri111', 'meryem.donmez@gmail.com', 'a');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `urunler`
--

CREATE TABLE `urunler` (
  `id` int(11) NOT NULL,
  `urun_adi` varchar(45) NOT NULL,
  `grup_id` int(11) NOT NULL,
  `urun_birimi` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Tablo döküm verisi `urunler`
--

INSERT INTO `urunler` (`id`, `urun_adi`, `grup_id`, `urun_birimi`) VALUES
(3, 'MSI', 1, '15000'),
(4, 'Asus', 1, '10000'),
(5, 'Nvidia', 3, '2500'),
(6, 'AMD', 2, '3000'),
(7, 'Intel', 2, '4000');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `urun_cikan_stok`
--

CREATE TABLE `urun_cikan_stok` (
  `id` int(11) NOT NULL,
  `urun_id` int(11) NOT NULL,
  `urun_cikan_stok` int(11) NOT NULL,
  `tarih` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Tablo döküm verisi `urun_cikan_stok`
--

INSERT INTO `urun_cikan_stok` (`id`, `urun_id`, `urun_cikan_stok`, `tarih`) VALUES
(1, 3, 3, '2024-03-03 18:15:44'),
(2, 5, 17, '2024-03-03 18:16:00');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `urun_giren_stok`
--

CREATE TABLE `urun_giren_stok` (
  `id` int(11) NOT NULL,
  `urun_id` int(11) NOT NULL,
  `urun_giren_stok` int(11) NOT NULL,
  `tarih` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Tablo döküm verisi `urun_giren_stok`
--

INSERT INTO `urun_giren_stok` (`id`, `urun_id`, `urun_giren_stok`, `tarih`) VALUES
(1, 3, 100, '2024-03-03 18:07:31'),
(2, 7, 20, '2024-03-03 18:11:28'),
(3, 6, 20, '2024-03-03 18:13:31'),
(4, 5, 48, '2024-03-03 18:14:05');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `urun_kategori`
--

CREATE TABLE `urun_kategori` (
  `id` int(11) NOT NULL,
  `grup_adi` varchar(45) NOT NULL,
  `durum` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Tablo döküm verisi `urun_kategori`
--

INSERT INTO `urun_kategori` (`id`, `grup_adi`, `durum`) VALUES
(1, 'laptop', 'a'),
(2, 'işlemci', 'p'),
(3, 'ekran kartı', 'a');

--
-- Dökümü yapılmış tablolar için indeksler
--

--
-- Tablo için indeksler `kitaplar`
--
ALTER TABLE `kitaplar`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_kitaplar_kullanicilar` (`kullanici_id`);

--
-- Tablo için indeksler `kullanicilar`
--
ALTER TABLE `kullanicilar`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `urunler`
--
ALTER TABLE `urunler`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_urunler_urun_kategori` (`grup_id`);

--
-- Tablo için indeksler `urun_cikan_stok`
--
ALTER TABLE `urun_cikan_stok`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_urun_cikan_stok_urunler` (`urun_id`);

--
-- Tablo için indeksler `urun_giren_stok`
--
ALTER TABLE `urun_giren_stok`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_urun_giren_stok_urunler` (`urun_id`);

--
-- Tablo için indeksler `urun_kategori`
--
ALTER TABLE `urun_kategori`
  ADD PRIMARY KEY (`id`);

--
-- Dökümü yapılmış tablolar için AUTO_INCREMENT değeri
--

--
-- Tablo için AUTO_INCREMENT değeri `kitaplar`
--
ALTER TABLE `kitaplar`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Tablo için AUTO_INCREMENT değeri `kullanicilar`
--
ALTER TABLE `kullanicilar`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Tablo için AUTO_INCREMENT değeri `urunler`
--
ALTER TABLE `urunler`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Tablo için AUTO_INCREMENT değeri `urun_cikan_stok`
--
ALTER TABLE `urun_cikan_stok`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Tablo için AUTO_INCREMENT değeri `urun_giren_stok`
--
ALTER TABLE `urun_giren_stok`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Tablo için AUTO_INCREMENT değeri `urun_kategori`
--
ALTER TABLE `urun_kategori`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Dökümü yapılmış tablolar için kısıtlamalar
--

--
-- Tablo kısıtlamaları `kitaplar`
--
ALTER TABLE `kitaplar`
  ADD CONSTRAINT `FK_kitaplar_kullanicilar` FOREIGN KEY (`kullanici_id`) REFERENCES `kullanicilar` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Tablo kısıtlamaları `urunler`
--
ALTER TABLE `urunler`
  ADD CONSTRAINT `FK_urunler_urun_kategori` FOREIGN KEY (`grup_id`) REFERENCES `urun_kategori` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Tablo kısıtlamaları `urun_cikan_stok`
--
ALTER TABLE `urun_cikan_stok`
  ADD CONSTRAINT `FK_urun_cikan_stok_urunler` FOREIGN KEY (`urun_id`) REFERENCES `urunler` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Tablo kısıtlamaları `urun_giren_stok`
--
ALTER TABLE `urun_giren_stok`
  ADD CONSTRAINT `FK_urun_giren_stok_urunler` FOREIGN KEY (`urun_id`) REFERENCES `urunler` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
