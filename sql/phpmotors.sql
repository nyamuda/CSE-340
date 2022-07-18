-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Host: mysql:3306
-- Generation Time: Jul 18, 2022 at 04:06 AM
-- Server version: 8.0.27
-- PHP Version: 8.0.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `phpmotors`
--

-- --------------------------------------------------------

--
-- Table structure for table `carclassification`
--

CREATE TABLE `carclassification` (
  `classificationId` int NOT NULL,
  `classificationName` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `carclassification`
--

INSERT INTO `carclassification` (`classificationId`, `classificationName`) VALUES
(1, 'SUV'),
(2, 'Classic'),
(3, 'Sports'),
(4, 'Trucks'),
(5, 'Used');

-- --------------------------------------------------------

--
-- Table structure for table `clients`
--

CREATE TABLE `clients` (
  `clientId` int UNSIGNED NOT NULL,
  `clientFirstname` varchar(15) NOT NULL,
  `clientLastname` varchar(25) NOT NULL,
  `clientEmail` varchar(40) NOT NULL,
  `clientPassword` varchar(255) NOT NULL,
  `clientLevel` enum('1','2','3') NOT NULL DEFAULT '1',
  `comment` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `clients`
--

INSERT INTO `clients` (`clientId`, `clientFirstname`, `clientLastname`, `clientEmail`, `clientPassword`, `clientLevel`, `comment`) VALUES
(3, 'Tatenda', 'Nyamuda', 'p@gmail.com', '$2y$10$7xImlsvRPV51eKAcbCmttudJr/Y7UE85Oul4BdrHbOmntgX1n98/a', '1', NULL),
(4, 'hello', 'Nyamuda', 'ptnrlb@gmail.com', '$2y$10$fIYik3PJfvkutntyfOsHOuRych.BlmrjCBFsg/hLDO.U9fzxlrHnm', '1', NULL),
(5, 'Pierce', 'Nyamuda', 'p@gmail.com', '$2y$10$H24/j3uCRnz4gH6o4bx0I.zw1dvBjtH50pXnOcl2PKKUpA9I4/JH6', '1', NULL),
(6, 'Tatenda', 'Nyamuda', 'ptnrlab1@gmail.com', '$2y$10$zZdVrmddOu5kHYDI2rc4VeoiR1crmUiIEsXXF/gLNcnc8/CdgY1S2', '1', NULL),
(7, 'Pierce', 'Nyamuda', 'hello@gmail.com', '$2y$10$6rsaVo8/Bb2btsiObq.rgO8bbWHRDgVaPDyRlMNg3rUnkVtTWvSRK', '1', NULL),
(8, 'Pierce', 'Nyamuda', 'hello1@gmail.com', '$2y$10$tNVsl6vi9FM2Wt8u/5pFmu4SWc8BMu7cQOOabTfmsRD.64eJJcyGy', '1', NULL),
(9, 'study', 'Nyamudas', 'ptnrlab2@gmail.com', '$2y$10$jRwBd/qpRFXqbDG5UNI3o.HMbfEyhHiqgQhBgwFW841uBpA0ZivVW', '1', NULL),
(10, 'Admin', 'Tatenda', 'admin@cse340.net', '$2y$10$OnNRPFj1ePrrt0BA4mjmCOUI3NGoele81EBhZVeD9SvtlSl9AebSO', '3', NULL),
(11, 'moses', 'david', 'ptnrlab@gmail.com', '$2y$10$3S8912Ox/LPxk6iw.Btv9OW1JSXiSXxwyf9J6jvpiKtzH19qdf83S', '1', NULL),
(12, 'Peter', 'Pan', 'peter@gmail.com', '$2y$10$PNYbZRjOb06VxuZ.QMHi.eCvMrEdNUFsw7vFBoq6UAuoUDD4uKWzy', '1', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `images`
--

CREATE TABLE `images` (
  `imgId` int NOT NULL,
  `invId` int NOT NULL,
  `imgName` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `imgPath` varchar(150) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `imgDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `imgPrimary` tinyint NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `images`
--

INSERT INTO `images` (`imgId`, `invId`, `imgName`, `imgPath`, `imgDate`, `imgPrimary`) VALUES
(11, 1, 'jeep-wrangler.jpg', '/phpmotors/images/vehicles/jeep-wrangler.jpg', '2022-07-08 08:23:02', 1),
(12, 1, 'jeep-wrangler-tn.jpg', '/phpmotors/images/vehicles/jeep-wrangler-tn.jpg', '2022-07-08 08:23:02', 1),
(13, 2, 'ford-modelt.jpg', '/phpmotors/images/vehicles/ford-modelt.jpg', '2022-07-08 08:23:39', 1),
(14, 2, 'ford-modelt-tn.jpg', '/phpmotors/images/vehicles/ford-modelt-tn.jpg', '2022-07-08 08:23:39', 1),
(15, 3, 'lambo-Adve.jpg', '/phpmotors/images/vehicles/lambo-Adve.jpg', '2022-07-08 08:24:10', 1),
(16, 3, 'lambo-Adve-tn.jpg', '/phpmotors/images/vehicles/lambo-Adve-tn.jpg', '2022-07-08 08:24:11', 1),
(19, 4, 'monster.jpg', '/phpmotors/images/vehicles/monster.jpg', '2022-07-08 08:26:09', 1),
(20, 4, 'monster-tn.jpg', '/phpmotors/images/vehicles/monster-tn.jpg', '2022-07-08 08:26:09', 1),
(21, 5, 'ms.jpg', '/phpmotors/images/vehicles/ms.jpg', '2022-07-08 08:26:50', 1),
(22, 5, 'ms-tn.jpg', '/phpmotors/images/vehicles/ms-tn.jpg', '2022-07-08 08:26:50', 1),
(23, 6, 'bat.jpg', '/phpmotors/images/vehicles/bat.jpg', '2022-07-08 08:27:10', 1),
(24, 6, 'bat-tn.jpg', '/phpmotors/images/vehicles/bat-tn.jpg', '2022-07-08 08:27:11', 1),
(25, 7, 'mm.jpg', '/phpmotors/images/vehicles/mm.jpg', '2022-07-08 08:27:35', 1),
(26, 7, 'mm-tn.jpg', '/phpmotors/images/vehicles/mm-tn.jpg', '2022-07-08 08:27:36', 1),
(27, 8, 'fire-truck.jpg', '/phpmotors/images/vehicles/fire-truck.jpg', '2022-07-08 08:27:55', 1),
(28, 8, 'fire-truck-tn.jpg', '/phpmotors/images/vehicles/fire-truck-tn.jpg', '2022-07-08 08:27:55', 1),
(29, 10, 'camaro.jpg', '/phpmotors/images/vehicles/camaro.jpg', '2022-07-08 08:28:13', 1),
(30, 10, 'camaro-tn.jpg', '/phpmotors/images/vehicles/camaro-tn.jpg', '2022-07-08 08:28:14', 1),
(31, 11, 'escalade.jpg', '/phpmotors/images/vehicles/escalade.jpg', '2022-07-08 08:28:40', 1),
(32, 11, 'escalade-tn.jpg', '/phpmotors/images/vehicles/escalade-tn.jpg', '2022-07-08 08:28:40', 1),
(33, 12, 'hummer.jpg', '/phpmotors/images/vehicles/hummer.jpg', '2022-07-08 08:29:02', 1),
(34, 12, 'hummer-tn.jpg', '/phpmotors/images/vehicles/hummer-tn.jpg', '2022-07-08 08:29:02', 1),
(35, 13, 'aerocar.jpg', '/phpmotors/images/vehicles/aerocar.jpg', '2022-07-08 08:29:20', 1),
(36, 13, 'aerocar-tn.jpg', '/phpmotors/images/vehicles/aerocar-tn.jpg', '2022-07-08 08:29:20', 1),
(37, 14, 'fbi.jpg', '/phpmotors/images/vehicles/fbi.jpg', '2022-07-08 08:29:38', 1),
(38, 14, 'fbi-tn.jpg', '/phpmotors/images/vehicles/fbi-tn.jpg', '2022-07-08 08:29:38', 1),
(41, 23, 'delorean.jpg', '/phpmotors/images/vehicles/delorean.jpg', '2022-07-08 08:35:44', 1),
(42, 23, 'delorean-tn.jpg', '/phpmotors/images/vehicles/delorean-tn.jpg', '2022-07-08 08:35:44', 1),
(43, 12, 'dustan-woodhouse-SbqztaE7kac-unsplash.jpg', '/phpmotors/images/vehicles/dustan-woodhouse-SbqztaE7kac-unsplash.jpg', '2022-07-08 08:40:57', 0),
(44, 12, 'dustan-woodhouse-SbqztaE7kac-unsplash-tn.jpg', '/phpmotors/images/vehicles/dustan-woodhouse-SbqztaE7kac-unsplash-tn.jpg', '2022-07-08 08:40:57', 0),
(45, 3, 'kyle-bushnell-gELKXGfiSe0-unsplash.jpg', '/phpmotors/images/vehicles/kyle-bushnell-gELKXGfiSe0-unsplash.jpg', '2022-07-08 08:42:41', 0),
(46, 3, 'kyle-bushnell-gELKXGfiSe0-unsplash-tn.jpg', '/phpmotors/images/vehicles/kyle-bushnell-gELKXGfiSe0-unsplash-tn.jpg', '2022-07-08 08:42:41', 0),
(47, 10, 'anna-brown-lpY4jBof9c8-unsplash.jpg', '/phpmotors/images/vehicles/anna-brown-lpY4jBof9c8-unsplash.jpg', '2022-07-08 08:44:57', 0),
(48, 10, 'anna-brown-lpY4jBof9c8-unsplash-tn.jpg', '/phpmotors/images/vehicles/anna-brown-lpY4jBof9c8-unsplash-tn.jpg', '2022-07-08 08:44:57', 0),
(49, 15, 'no-image.png', '/phpmotors/images/vehicles/no-image.png', '2022-07-08 08:50:08', 1),
(50, 15, 'no-image-tn.png', '/phpmotors/images/vehicles/no-image-tn.png', '2022-07-08 08:50:08', 1),
(51, 8, 'john-torcasio-Y2ZJ5XqRB1s-unsplash.jpg', '/phpmotors/images/vehicles/john-torcasio-Y2ZJ5XqRB1s-unsplash.jpg', '2022-07-08 11:06:09', 0),
(52, 8, 'john-torcasio-Y2ZJ5XqRB1s-unsplash-tn.jpg', '/phpmotors/images/vehicles/john-torcasio-Y2ZJ5XqRB1s-unsplash-tn.jpg', '2022-07-08 11:06:09', 0),
(53, 14, 'herson-rodriguez-w8CcH9Md4vE-unsplash.jpg', '/phpmotors/images/vehicles/herson-rodriguez-w8CcH9Md4vE-unsplash.jpg', '2022-07-08 11:07:30', 0),
(54, 14, 'herson-rodriguez-w8CcH9Md4vE-unsplash-tn.jpg', '/phpmotors/images/vehicles/herson-rodriguez-w8CcH9Md4vE-unsplash-tn.jpg', '2022-07-08 11:07:30', 0),
(55, 4, 'filip-mroz-0hJL8lBl0qQ-unsplash.jpg', '/phpmotors/images/vehicles/filip-mroz-0hJL8lBl0qQ-unsplash.jpg', '2022-07-08 11:08:53', 0),
(56, 4, 'filip-mroz-0hJL8lBl0qQ-unsplash-tn.jpg', '/phpmotors/images/vehicles/filip-mroz-0hJL8lBl0qQ-unsplash-tn.jpg', '2022-07-08 11:08:53', 0);

-- --------------------------------------------------------

--
-- Table structure for table `inventory`
--

CREATE TABLE `inventory` (
  `invId` int NOT NULL,
  `invMake` varchar(30) NOT NULL,
  `invModel` varchar(30) NOT NULL,
  `invDescription` text NOT NULL,
  `invImage` varchar(50) NOT NULL,
  `invThumbnail` varchar(50) NOT NULL,
  `invPrice` decimal(10,0) NOT NULL,
  `invStock` smallint NOT NULL,
  `invColor` varchar(20) NOT NULL,
  `classificationId` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `inventory`
--

INSERT INTO `inventory` (`invId`, `invMake`, `invModel`, `invDescription`, `invImage`, `invThumbnail`, `invPrice`, `invStock`, `invColor`, `classificationId`) VALUES
(1, 'Jeep ', 'Wrangler', 'The Jeep Wrangler is small and compact with enough power to get you where you want to go. It is great for everyday driving as well as off-roading whether that be on the rocks or in the mud!', '/phpmotors/images/jeep-wrangler.jpg', '/phpmotors/images/jeep-wrangler-tn.jpg', '28045', 4, 'Orange', 1),
(2, 'Ford', 'Model T', 'The Ford Model T can be a bit tricky to drive. It was the first car to be put into production. You can get it in any color you want if it is black.', '/phpmotors/images/ford-modelt.jpg', '/phpmotors/images/ford-modelt-tn.jpg', '30000', 2, 'Black', 2),
(3, 'Lamborghini', 'Adventador', 'This V-12 engine packs a punch in this sporty car. Make sure you wear your seatbelt and obey all traffic laws.', '/phpmotors/images/lambo-Adve.jpg', '/phpmotors/images/lambo-Adve-tn.jpg', '417650', 2, 'Blue', 3),
(4, 'Monster', 'Truck', 'Most trucks are for working, this one is for fun. This beast comes with 60 inch tires giving you the traction needed to jump and roll in the mud.', '/phpmotors/images/monster.jpg', '/phpmotors/images/monster-tn.jpg', '150000', 3, 'purple', 4),
(5, 'Mechanic', 'Special', 'Not sure where this car came from. However, with a little tender loving care it will run as good a new.', '/phpmotors/images/ms.jpg', '/phpmotors/images/ms-tn.jpg', '100', 2, 'Rust', 5),
(6, 'Batmobile', 'Custom', 'Ever want to be a superhero? Now you can with the bat mobile. This car allows you to switch to bike mode allowing for easy maneuvering through traffic during rush hour.', '/phpmotors/images/bat.jpg', '/phpmotors/images/bat-tn.jpg', '65000', 1, 'Black', 3),
(7, 'Mystery', 'Machine', 'Scooby and the gang always found luck in solving their mysteries because of their 4 wheel drive Mystery Machine. This Van will help you do whatever job you are required to with a success rate of 100%.', '/phpmotors/images/mm.jpg', '/phpmotors/images/mm-tn.jpg', '10000', 12, 'Green', 1),
(8, 'Spartan', 'Fire Truck', 'Emergencies happen often. Be prepared with this Spartan fire truck. Comes complete with 1000 ft. of hose and a 1000-gallon tank.', '/phpmotors/images/fire-truck.jpg', '/phpmotors/images/fire-truck-tn.jpg', '50000', 1, 'Red', 4),
(10, 'Chevy', 'Camaro', 'If you want to look cool this is the car you need! This car has great performance at an affordable price. Own it today!', '/phpmotors/images/camaro.jpg', '/phpmotors/images/camaro-tn.jpg', '25000', 10, 'Silver', 3),
(11, 'Cadillac', 'Escalade', 'This styling car is great for any occasion from going to the beach to meeting the president. The luxurious inside makes this car a home away from home.', '/phpmotors/images/escalade.jpg', '/phpmotors/images/escalade-tn.jpg', '75195', 4, 'Black', 1),
(12, 'GM', 'Hummer', 'Do you have 6 kids and like to go off-roading? The Hummer gives you the small interiors with an engine to get you out of any muddy or rocky situation.', '/phpmotors/images/hummer.jpg', '/phpmotors/images/hummer-tn.jpg', '58800', 5, 'Yellow', 5),
(13, 'Aerocar International', 'Aerocar', 'Are you sick of rush hour traffic? This car converts into an airplane to get you where you are going fast. Only 6 of these were made, get this one while it lasts!', '/phpmotors/images/aerocar.jpg', '/phpmotors/images/aerocar-tn.jpg', '1000000', 1, 'Red', 2),
(14, 'FBI', 'Surveillance Van', 'Do you like police shows? You will feel right at home driving this van. Comes complete with surveillance equipment for an extra fee of $2,000 a month. ', '/phpmotors/images/fbi.jpg', '/phpmotors/images/fbi-tn.jpg', '20000', 1, 'Green', 1),
(15, 'Dog ', 'Car', 'Do you like dogs? Well, this car is for you straight from the 90s from Aspen, Colorado we have the original Dog Car complete with fluffy ears.', '/phpmotors/images/no-image.jpg', '/phpmotors/images/no-image-tn.jpg', '35000', 1, 'Brown', 2),
(23, 'DMC', 'DeLorean', 'home image', '/phpmotors/images/no-image.png', '/phpmotors/images/no-image.png', '500', 1, 'white', 2);

-- --------------------------------------------------------

--
-- Table structure for table `reviews`
--

CREATE TABLE `reviews` (
  `reviewId` int NOT NULL,
  `reviewtext` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `reviewDate` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `invId` int NOT NULL,
  `clientId` int UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `reviews`
--

INSERT INTO `reviews` (`reviewId`, `reviewtext`, `reviewDate`, `invId`, `clientId`) VALUES
(5, 'very good car', '2022-07-17 11:29:59', 5, 9),
(6, 'Not a good car at all', '2022-07-17 12:46:41', 5, 10),
(9, 'Lovely car', '2022-07-17 14:08:05', 5, 11),
(10, 'The fastest car.', '2022-07-17 14:16:21', 5, 12),
(11, 'This car can move. It will take you places.', '2022-07-17 14:19:44', 3, 9),
(12, 'This truck is my favorite.', '2022-07-17 14:29:44', 8, 9),
(13, 'This car will surprise you.', '2022-07-17 16:05:19', 3, 12),
(14, 'I love this car.', '2022-07-17 16:06:54', 7, 9);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `carclassification`
--
ALTER TABLE `carclassification`
  ADD PRIMARY KEY (`classificationId`);

--
-- Indexes for table `clients`
--
ALTER TABLE `clients`
  ADD PRIMARY KEY (`clientId`);

--
-- Indexes for table `images`
--
ALTER TABLE `images`
  ADD PRIMARY KEY (`imgId`),
  ADD KEY `imgId` (`invId`);

--
-- Indexes for table `inventory`
--
ALTER TABLE `inventory`
  ADD PRIMARY KEY (`invId`),
  ADD KEY `classificationId` (`classificationId`);

--
-- Indexes for table `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`reviewId`),
  ADD KEY `invId` (`invId`),
  ADD KEY `clientId` (`clientId`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `carclassification`
--
ALTER TABLE `carclassification`
  MODIFY `classificationId` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `clients`
--
ALTER TABLE `clients`
  MODIFY `clientId` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `images`
--
ALTER TABLE `images`
  MODIFY `imgId` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;

--
-- AUTO_INCREMENT for table `inventory`
--
ALTER TABLE `inventory`
  MODIFY `invId` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `reviews`
--
ALTER TABLE `reviews`
  MODIFY `reviewId` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `images`
--
ALTER TABLE `images`
  ADD CONSTRAINT `FK_inv_images` FOREIGN KEY (`invId`) REFERENCES `inventory` (`invId`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `inventory`
--
ALTER TABLE `inventory`
  ADD CONSTRAINT `inventory_ibfk_1` FOREIGN KEY (`classificationId`) REFERENCES `carclassification` (`classificationId`);

--
-- Constraints for table `reviews`
--
ALTER TABLE `reviews`
  ADD CONSTRAINT `FK_client_reviews` FOREIGN KEY (`clientId`) REFERENCES `clients` (`clientId`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_inv_reviews` FOREIGN KEY (`invId`) REFERENCES `inventory` (`invId`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
