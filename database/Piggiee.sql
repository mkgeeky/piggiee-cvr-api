CREATE DATABASE `Piggiee`;

CREATE TABLE `ActiveCVR` (
  `ID` int(11) UNSIGNED NOT NULL,
  `CVR` int(8) NOT NULL,
  `Name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `Phone` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Email` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Street` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `HouseNumber` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ZipCode` int(4) DEFAULT NULL,
  `Coordinates_X` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Coordinates_Y` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Branche` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  ADD PRIMARY KEY (`ID`),
  UNIQUE KEY `CVR` (`CVR`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

CREATE VIEW `Missing_Info` AS SELECT * FROM `ActiveCVR` WHERE `Phone` IS NULL OR `Email` IS NULL OR `Street` IS NULL OR `HouseNumber` IS NULL OR `ZipCode` IS NULL OR `Coordinates_X` IS NULL OR `Coordinates_Y` IS NULL;
