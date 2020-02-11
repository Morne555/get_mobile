-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 18, 2019 at 05:36 PM
-- Server version: 10.3.16-MariaDB
-- PHP Version: 7.3.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `getmobile`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `admin_id` int(11) NOT NULL,
  `admin_username` varchar(255) COLLATE utf8_bin NOT NULL,
  `admin_password` varchar(255) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `cart_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`cart_id`, `user_id`, `product_id`) VALUES
(179, 39, 44),
(180, 39, 46);

-- --------------------------------------------------------

--
-- Table structure for table `checkout`
--

CREATE TABLE `checkout` (
  `checkout_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `checkout_list` varchar(255) COLLATE utf8_bin NOT NULL,
  `checkout_total` double NOT NULL,
  `checkout_shipping` double NOT NULL,
  `checkout_grand_total` double NOT NULL,
  `checkout_date` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `checkout`
--

INSERT INTO `checkout` (`checkout_id`, `user_id`, `checkout_list`, `checkout_total`, `checkout_shipping`, `checkout_grand_total`, `checkout_date`) VALUES
(61, 39, 'Huawei P20 Lite, Apple iPhone 6s, ', 6998, 139.96, 7137.96, '2019-08-13');

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `product_id` int(11) NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `product_image` varchar(255) NOT NULL,
  `product_description` varchar(255) NOT NULL,
  `product_category` varchar(255) NOT NULL,
  `product_sub_category` varchar(255) NOT NULL,
  `product_price` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`product_id`, `product_name`, `product_image`, `product_description`, `product_category`, `product_sub_category`, `product_price`) VALUES
(44, 'Samsung Galaxy Note 10', 'placeholder.png', 'Display 6.8\" 1440 x 3040 pixels. Camera 12 MP / 10 MP front. Processor Qualcomm Snapdragon 855, Octa-core, 2840 MHz. Storage 512 GB + microSDXC. Battery 4300 mAh.', 'phone', 'android', 12000),
(46, 'Huawei P30 Pro', 'placeholder.png', 'Specifications: - EMUI 9.1.0 (compatible with Android 9) - Screen Size: 6.47 inches; FHD+ 2340 x 1080 pixels; 398 PPI - Battery capacity: 4100 mAh (minimum value), 4200 mAh (typical value) - 8 GB RAM + 256 GB ROM - Front camera: 32 MP, f/2.0 aperture, sup', 'phone', 'android', 14999),
(47, 'Huawei P20 Lite', 'placeholder.png', 'Specifications: - Colour: Klein Blue - SIM: Nano Sim - Operation system: android 8.0 - Display: TFT LCD (IPS) - GPS: GPS / AGPS / GLONASS - FHD+ 2280 x 1080 pixels: 432 PPI - Memory: 4 GB + 64 GB (microSD card up to 256 GB) - Audio: mp3, .mp4, .3gp, .ogg,', 'phone', 'android', 2999),
(48, 'Apple iPhone 6s', 'placeholder.png', 'Specifications: - Chip: A9 chip with 64-bit architecture Embedded M9 motion coprocessor. Display: - Retina HD display with 3D Touch - 4.7-inch (diagonal) LED-backlit widescreen.Colour: Space Grey.  Capacity: 32GB', 'phone', 'apple', 3999),
(49, 'Apple iPhone XR', 'placeholder.png', 'Specifications: Display: - Liquid Retina HD display - 6.1-inch (diagonal) all-screen LCD Multi-Touch display with IPS technology. Chip: - A12 Bionic chip. Camera: - 12MP wide-angle camera. FaceID: Enabled by True Depth camera for facial recognition', 'phone', 'apple', 13999),
(50, 'Apple iPhone X', 'placeholder.png', 'Specification: Display: - Super Retina HD display. Chip: - A11 Bionic chip with 64-bit architecture. Camera: - 12MP wide-angle and telephoto cameras. Face ID: - Enabled by TrueDepth camera for facial recognition', 'phone', 'apple', 15999),
(51, 'Samsung Galaxy S10', 'placeholder.png', 'Specifications: Display: - 6.1\" Quad HD+ Dynamic AMOLED - Infinity-O Display (3040x1440). Camera (Front): - 10MP Selfie Camera - Dual Pixel AF. Camera (Rear): - Triple camera - Dual OIS (Optical Image Stabilization). Battery Capacity: - 3400mAh (typical).', 'phone', 'android', 15999),
(52, 'Samsung Galaxy A20', 'placeholder.png', 'Specifications: Processor:  CPU Speed - 1.6 GHz, 1.35 GHz,  CPU Type - Octa-Core. Display:  Size (Main_Display) - 162.0 mm (6.4\"),  Resolution (Main Display) - 720 x 1520 (HD+). Camera:  Rear Camera - Resolution (Multiple) - 13.0 MP + 5.0 MP.', 'phone', 'android', 2555),
(53, 'Smartphone Charger (Micro USB)', 'placeholder.png', 'Raz Tech USB charger and micro USB cable for Samsung, Blackberry and Dream Mobile devices.', 'charger', 'wired', 79),
(54, 'LDNIO Dual USB Travel Wall Charger Power Adapter', 'placeholder.png', 'Features: - Power & Batteries - Current Output 2.4 A - Input Type: AC 100-240V', 'charger', 'wired', 99),
(55, 'Polaroid PWFC811 Wireless Fast Charger', 'placeholder.png', 'Specification: - Input: DC 5V / 2A, DC 9V 1.67A - Output: DC 5.V 1A, DC.9V 1A - Charging Efficiency: 72% - 75%', 'charger', 'wireless', 249),
(56, 'Wireless Fast Charger for Samsung S7/S8, iPhone 8/X', 'placeholder.png', 'Specifications: - Input: 5V 2A - Output: 9V 1.67A - Charging current: 1,000mA - Interface: Micro USB', 'charger', 'wireless', 218),
(57, 'Snug Fast Wireless Desktop Charger', 'placeholder.png', 'Specifications: - Input: 5V/2A 9A/1.67A - Output: 5V/1A 9V/1.1A - Power: 10W', 'charger', 'wireless', 400),
(58, 'Huawei Active Noise Canceling Earphones 3', 'placeholder.png', 'Adopts ergonomic in-ear design, USB Type-C plug with âŒ€13 mm dynamic drivers & high-performance diaphragms to achieve crisp treble, natural alto & deep bass.', 'earphone', 'wired', 233),
(59, 'FiiO F9 Pro with Mic', 'placeholder.png', 'The F9 PRO utilizes a hybrid design in which each channel is composed of one dynamic and two balanced armature (BA) drivers. ', 'earphone', 'wired', 350),
(60, 'Huawei FreeLace wireless earphones', 'placeholder.png', 'HUAWEI FreeLace supports up to 18 hours of playback or13 hours of talk time on a single charge. Inside each of the speakers is a large dynamic driver unit with a diameter of 9.2mm. ', 'earphone', 'wireless', 499),
(61, 'Cygnett Orbit', 'placeholder.png', 'The Cygnett Orbit is one of the most simple cases around - it\'s a flexible, plastic see-through shell for your phone. ', 'cases', '', 99),
(62, 'UAG Pathfinder', 'placeholder.png', 'While the case looks like a beast, it doesn\'t add a lot of weight to your iPhone but does provide excellent protection.', 'cases', '', 432),
(63, 'Samsung Gear S3', 'placeholder.png', 'The Gear S3 has the aesthetics of a truly premium watch with advanced features built right into the watch design. That\'s why it\'s so easy and effortless to use the Gear S3. ', 'watches', '', 2500),
(64, 'Apple Watch Series 4', 'placeholder.png', 'Apple Watch Series 'placeholder.png', Fundamentally redesigned and re-engineered to help you be even more active, healthy and 'placeholder.png' 'watches', 'apple', 4999);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user_id` int(11) NOT NULL,
  `username` varchar(15) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(254) NOT NULL,
  `name` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`cart_id`),
  ADD KEY `user_id_FK` (`user_id`),
  ADD KEY `product_id_FK` (`product_id`);

--
-- Indexes for table `checkout`
--
ALTER TABLE `checkout`
  ADD PRIMARY KEY (`checkout_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`product_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `cart_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=181;

--
-- AUTO_INCREMENT for table `checkout`
--
ALTER TABLE `checkout`
  MODIFY `checkout_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=62;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=65;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `cart`
--
ALTER TABLE `cart`
  ADD CONSTRAINT `product_id_FK` FOREIGN KEY (`product_id`) REFERENCES `product` (`product_id`),
  ADD CONSTRAINT `user_id_FK` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`);

--
-- Constraints for table `checkout`
--
ALTER TABLE `checkout`
  ADD CONSTRAINT `user_id` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
