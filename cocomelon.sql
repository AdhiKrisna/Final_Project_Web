-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 30, 2023 at 03:10 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cocomelon`
--

-- --------------------------------------------------------

--
-- Table structure for table `account`
--

CREATE TABLE `account` (
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `image` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `account`
--

INSERT INTO `account` (`username`, `password`, `image`) VALUES
('aa', 'bb', ''),
('adhi', 'krisna', 'Pas Foto KUliah Latar Merah.jpeg'),
('admin', 'cocomelon123', 'Screenshot__235_-removebg-preview.png'),
('arda', '123', ''),
('ganteng', 'ganteng', ''),
('jess', '1234', '20221223_154127.jpg'),
('nolan', 'nolan123', 'download.jpeg'),
('samudrayoga', 'Samudra040702Yoga', 'WhatsApp Image 2022-11-15 at 08.25.50.jpg'),
('xxx123', 'xxx123', '');

-- --------------------------------------------------------

--
-- Table structure for table `feedback`
--

CREATE TABLE `feedback` (
  `id` int(11) NOT NULL,
  `place_id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `comment` longtext NOT NULL,
  `rating` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `feedback`
--

INSERT INTO `feedback` (`id`, `place_id`, `username`, `comment`, `rating`) VALUES
(8, 1, 'adhi', 'bjirfff kuyy login', 5),
(9, 1, 'aa', 'saya mau main jugaaa', 4),
(11, 1, 'admin', 'looks like a bery bery wonderful and peaceful place!', 5),
(12, 2, 'adhi', 'tempatnya romantis bangettt, cocok untuk kaum senja juga. Weekend rame bgt ges', 5),
(13, 1, 'ganteng', 'keren', 4),
(14, 3, 'admin', 'kerenn', 5),
(15, 3, 'ganteng', 'gilzz tempat gua di acc', 5),
(17, 4, 'admin', 'gg', 5),
(18, 4, 'adhi', 'bagus sekali, bintang 2 dlu. Nanti kalo udah kesini jadi bintang 5', 2),
(19, 6, 'admin', 'jelek', 1),
(20, 6, 'arda', 'bagus', 5),
(24, 3, 'samudrayoga', 'kriznarf', 5),
(25, 12, 'admin', 'kelasz', 5),
(26, 11, 'admin', 'jgn pake baju ijo ya fren.', 4);

-- --------------------------------------------------------

--
-- Table structure for table `req_tourism`
--

CREATE TABLE `req_tourism` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `province` varchar(50) NOT NULL,
  `regency` varchar(50) NOT NULL,
  `image` varchar(50) NOT NULL,
  `description` longtext NOT NULL,
  `username` varchar(50) NOT NULL,
  `price` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tourism`
--

CREATE TABLE `tourism` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `province` varchar(50) NOT NULL,
  `regency` varchar(50) NOT NULL,
  `image` varchar(50) NOT NULL,
  `description` longtext NOT NULL,
  `price` int(11) NOT NULL,
  `rating` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tourism`
--

INSERT INTO `tourism` (`id`, `name`, `province`, `regency`, `image`, `description`, `price`, `rating`) VALUES
(1, 'Pura Besakih', 'BALI', 'KABUPATEN KARANG ASEM', 'besakih.jpg', 'Pura Besakih adalah sebuah komplek Pura yang terletak di Desa Besakih, Kecamatan Rendang, Kabupaten Karangasem, Bali, Indonesia. Komplek Pura Besakih terdiri dari 1 Pura Pusat (Pura Penataran Agung Besakih) dan 18 Pura Pendamping (1 Pura Basukian dan 17 Pura Lainnya).', 5000, 4.5),
(2, 'Bukit Paralayang', 'DI YOGYAKARTA', 'KABUPATEN KULON PROGO', 'img3.jpg', 'Bukit Paralayang\nNiihhh boszz\nsenggol dong wkkwokwkowokkw', 15000, 5),
(3, 'Danau Toba', 'SUMATERA UTARA', 'KABUPATEN TOBA SAMOSIR', 'toba.png', ' Apa yang dimaksud dengan Danau Toba?\r\nDanau Toba adalah sebuah danau vulkanik dengan ukuran panjang 100 kilometer dan lebar 30 kilometer yang terletak di Provinsi Sumatera Utara, Indonesia. Danau ini merupakan danau terbesar di Indonesia dan Asia Tenggara. Di tengah danau ini terdapat sebuah pulau vulkanik bernama Pulau Samosir. ', 50000, 5),
(4, 'Klangon', 'DI YOGYAKARTA', 'KABUPATEN SLEMAN', 'klangon.jpg', '   Klangon\r\nNih bos, senggol dong\r\n   ', 2000, 3.5),
(6, 'Batu Payung', 'NUSA TENGGARA BARAT', 'KABUPATEN LOMBOK TENGAH', 'batu payung.jpg', 'Batu Payung berlokasi di Lombok Tengah, Kecamatan Pujut berdekatan dengan lokasi Pantai Tanjung Aan. Bahkan hanya dibutuhkan waktu sekitar 15 menit dari Pantai Tanjung Aan menuju Batu Payung melalui jalur laut. Untuk bisa memasuki area ini tidak ada uang tiket, sebab tempat ini sama sekali tidak memiliki fasilitas. Namun kamu harus membayar sewa kapal sekitar Rp.200.000 untuk bisa sampai ke lokasi ini. Kamu tidak perlu khawatir, sebab harga tersebut akan dibayar dengan keunikan yang disuguhka', 200000, 3),
(11, 'Pantai Parangtritis', 'DI YOGYAKARTA', 'KABUPATEN KULON PROGO', 'Dusk_till_dawn_(cropped).jpg', '  jgn pake baju ijo ya fren. harga tiket gacha, kalo bisa lolos lewat jalan tikus, ga kena palak di gate Parangtritis', 15000, 4),
(12, 'Pantai Menganti', 'ACEH', 'KABUPATEN SIMEULUE', 'pantai menganti.jpeg', 'ini pantai bagus banget lohhh !!!', 15000, 5);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `account`
--
ALTER TABLE `account`
  ADD PRIMARY KEY (`username`);

--
-- Indexes for table `feedback`
--
ALTER TABLE `feedback`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_place_id` (`place_id`),
  ADD KEY `fk_username` (`username`);

--
-- Indexes for table `req_tourism`
--
ALTER TABLE `req_tourism`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tourism`
--
ALTER TABLE `tourism`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `feedback`
--
ALTER TABLE `feedback`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `req_tourism`
--
ALTER TABLE `req_tourism`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `tourism`
--
ALTER TABLE `tourism`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `feedback`
--
ALTER TABLE `feedback`
  ADD CONSTRAINT `fk_place_id` FOREIGN KEY (`place_id`) REFERENCES `tourism` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_username` FOREIGN KEY (`username`) REFERENCES `account` (`username`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
