-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 30.05.2020 klo 13:01
-- Palvelimen versio: 10.4.11-MariaDB
-- PHP Version: 7.4.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `karahviorig`
--

-- --------------------------------------------------------

--
-- Rakenne taululle `kayttaja`
--

CREATE TABLE `kayttaja` (
  `id` int(11) NOT NULL,
  `kayttajaryhma_id` int(11) NOT NULL,
  `kayttajatunnus` varchar(50) NOT NULL,
  `etunimi` varchar(50) DEFAULT NULL,
  `sukunimi` varchar(50) DEFAULT NULL,
  `osoite` varchar(100) DEFAULT NULL,
  `postinumero` char(5) DEFAULT NULL,
  `postitoimipaikka` varchar(50) DEFAULT NULL,
  `puhelinnumero` varchar(20) NOT NULL,
  `sahkopostiosoite` varchar(50) NOT NULL,
  `ytmsnimi` varchar(100) DEFAULT NULL,
  `ytunnus` varchar(9) DEFAULT NULL,
  `laskutusnro` varchar(25) DEFAULT NULL,
  `yhthenketunimi` varchar(50) DEFAULT NULL,
  `yhthenksukunimi` varchar(50) DEFAULT NULL,
  `toimitusosoite` varchar(100) DEFAULT NULL,
  `toimpostinumero` char(5) DEFAULT NULL,
  `toimpostitoimipaikka` varchar(50) DEFAULT NULL,
  `salasana` varchar(255) NOT NULL,
  `aktiivinen` tinyint(1) DEFAULT 1,
  `rekisaika` datetime NOT NULL DEFAULT current_timestamp(),
  `muokaika` datetime DEFAULT NULL,
  `lopetusaika` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Vedos taulusta `kayttaja`
--

INSERT INTO `kayttaja` (`id`, `kayttajaryhma_id`, `kayttajatunnus`, `etunimi`, `sukunimi`, `osoite`, `postinumero`, `postitoimipaikka`, `puhelinnumero`, `sahkopostiosoite`, `ytmsnimi`, `ytunnus`, `laskutusnro`, `yhthenketunimi`, `yhthenksukunimi`, `toimitusosoite`, `toimpostinumero`, `toimpostitoimipaikka`, `salasana`, `aktiivinen`, `rekisaika`, `muokaika`, `lopetusaika`) VALUES
(70, 1, 'testiyllapitaja', 'Ylläpitäjä', 'Testi', 'Testi', '00000', 'Testi', '0000000000', 'testi@testi.testi', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '$2y$10$IxeubAKcLk9N5LKbu6FsduJP1vFL2tZDRk9DM2UW/k2X5w8Y2f9Cy', 1, '2020-05-30 13:54:15', NULL, NULL),
(71, 3, 'testihenkilo', 'Henkilö', 'Testi', 'Testi', '00000', 'Testi', '0000000000', 'testi@testi.testi', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '$2y$10$CxP6RgMlrIuLfoqYv2rV6e/orkqT29o5srKyQswL4lpdllTStFR1e', 1, '2020-05-30 13:57:25', NULL, NULL),
(72, 4, 'testiyritys', NULL, NULL, 'Testi', '00000', 'Testi', '0000000000', 'testi@testi.testi', 'Yritys', '1111111-1', '', 'Yrittäjä', 'Tyyppi', NULL, NULL, NULL, '$2y$10$cxJv2WU/eTzcm92V8d.1meFfkkIU8Rrvap83R1nh0ynbVpJ6wEpnq', 1, '2020-05-30 13:59:36', NULL, NULL),
(73, 2, 'testityontekija', 'Työntekijä', 'Testi', 'Testi', '00000', 'Testi', '0000000000', 'testi@testi.testi', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '$2y$10$j6o.LeLV9h0qQjoiVAC5L.PpSqVekqGWYjZkHytHXqSX/n5TANQai', 1, '2020-05-30 14:00:38', NULL, NULL);

-- --------------------------------------------------------

--
-- Rakenne taululle `kayttajaryhma`
--

CREATE TABLE `kayttajaryhma` (
  `kayttajaryhma_id` int(11) NOT NULL,
  `ryhmanimi` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Vedos taulusta `kayttajaryhma`
--

INSERT INTO `kayttajaryhma` (`kayttajaryhma_id`, `ryhmanimi`) VALUES
(1, 'Ylläpitäjät'),
(2, 'Työntekijät'),
(3, 'Henkilöasiakkaat'),
(4, 'Yritykset');

-- --------------------------------------------------------

--
-- Rakenne taululle `mainokset`
--

CREATE TABLE `mainokset` (
  `kuva_id` int(11) NOT NULL,
  `kuva_kuva` varchar(50) CHARACTER SET latin1 NOT NULL,
  `kuva_nimi` varchar(50) CHARACTER SET latin1 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Rakenne taululle `maksut`
--

CREATE TABLE `maksut` (
  `maksu_id` int(11) NOT NULL,
  `tilausnro` int(11) NOT NULL,
  `maksutapa` tinyint(1) NOT NULL,
  `lasklahaika` datetime DEFAULT NULL,
  `maksettu` tinyint(1) NOT NULL DEFAULT 0,
  `maksettupvm` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Rakenne taululle `sisalto`
--

CREATE TABLE `sisalto` (
  `sisaltonro` int(11) NOT NULL,
  `tilausnro` int(11) NOT NULL,
  `sessiotunnus` varchar(50) DEFAULT NULL,
  `tuote_id` int(11) NOT NULL,
  `lukumaara` int(11) NOT NULL,
  `ostohinta` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Rakenne taululle `tilaus`
--

CREATE TABLE `tilaus` (
  `tilauskooste` int(11) NOT NULL,
  `tilausnro` int(11) DEFAULT NULL,
  `toimpaiva` date DEFAULT NULL,
  `toimaika` time DEFAULT NULL,
  `toimituspaikka` varchar(10) DEFAULT NULL,
  `tilaaja_id` int(11) DEFAULT NULL,
  `lisatiedot` text DEFAULT NULL,
  `tilaus_saapunut` tinyint(1) DEFAULT NULL,
  `tilaus_saapunut_dt` datetime NOT NULL DEFAULT current_timestamp(),
  `tilaus_lahetetty` tinyint(1) DEFAULT NULL,
  `tilaus_lahetetty_dt` datetime DEFAULT NULL,
  `tilaus_peruttu` tinyint(1) DEFAULT NULL,
  `tilaus_peruttu_dt` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Rakenne taululle `tilausnumero`
--

CREATE TABLE `tilausnumero` (
  `tilausnro` int(11) NOT NULL,
  `sessiotunnus` varchar(50) NOT NULL,
  `kayttaja_id` int(11) NOT NULL,
  `aktiivinen` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Rakenne taululle `tuote`
--

CREATE TABLE `tuote` (
  `tuote_id` int(11) NOT NULL,
  `ryhma_id` int(11) NOT NULL,
  `tuotenimi` varchar(50) NOT NULL,
  `raakaaine` text NOT NULL,
  `hinta` double NOT NULL,
  `lisatiedot` text DEFAULT NULL,
  `kuva` varchar(100) DEFAULT NULL,
  `kuvannimi` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Rakenne taululle `tuoteryhma`
--

CREATE TABLE `tuoteryhma` (
  `ryhma_id` int(11) NOT NULL,
  `ryhma_nimi` varchar(50) NOT NULL,
  `kuvaus` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Rakenne taululle `uusiss`
--

CREATE TABLE `uusiss` (
  `uusissId` int(11) NOT NULL,
  `uusissEmail` text NOT NULL,
  `uusissMuuttuja` text NOT NULL,
  `uusissToken` longtext NOT NULL,
  `uusissVoimassa` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `kayttaja`
--
ALTER TABLE `kayttaja`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `kayttajatunnus` (`kayttajatunnus`),
  ADD KEY `fk_kayttajaryhma_id` (`kayttajaryhma_id`);

--
-- Indexes for table `kayttajaryhma`
--
ALTER TABLE `kayttajaryhma`
  ADD PRIMARY KEY (`kayttajaryhma_id`);

--
-- Indexes for table `mainokset`
--
ALTER TABLE `mainokset`
  ADD PRIMARY KEY (`kuva_id`);

--
-- Indexes for table `maksut`
--
ALTER TABLE `maksut`
  ADD PRIMARY KEY (`maksu_id`);

--
-- Indexes for table `sisalto`
--
ALTER TABLE `sisalto`
  ADD PRIMARY KEY (`sisaltonro`),
  ADD KEY `tuote_id` (`tuote_id`),
  ADD KEY `sisalto_ibfk_3` (`tilausnro`);

--
-- Indexes for table `tilaus`
--
ALTER TABLE `tilaus`
  ADD PRIMARY KEY (`tilauskooste`),
  ADD KEY `tilaaja_id` (`tilaaja_id`),
  ADD KEY `tilausnro` (`tilausnro`);

--
-- Indexes for table `tilausnumero`
--
ALTER TABLE `tilausnumero`
  ADD PRIMARY KEY (`tilausnro`);

--
-- Indexes for table `tuote`
--
ALTER TABLE `tuote`
  ADD PRIMARY KEY (`tuote_id`),
  ADD KEY `fk_ryhma_id` (`ryhma_id`);

--
-- Indexes for table `tuoteryhma`
--
ALTER TABLE `tuoteryhma`
  ADD PRIMARY KEY (`ryhma_id`);

--
-- Indexes for table `uusiss`
--
ALTER TABLE `uusiss`
  ADD PRIMARY KEY (`uusissId`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `kayttaja`
--
ALTER TABLE `kayttaja`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=74;

--
-- AUTO_INCREMENT for table `kayttajaryhma`
--
ALTER TABLE `kayttajaryhma`
  MODIFY `kayttajaryhma_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `mainokset`
--
ALTER TABLE `mainokset`
  MODIFY `kuva_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `maksut`
--
ALTER TABLE `maksut`
  MODIFY `maksu_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `sisalto`
--
ALTER TABLE `sisalto`
  MODIFY `sisaltonro` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1147;

--
-- AUTO_INCREMENT for table `tilaus`
--
ALTER TABLE `tilaus`
  MODIFY `tilauskooste` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

--
-- AUTO_INCREMENT for table `tilausnumero`
--
ALTER TABLE `tilausnumero`
  MODIFY `tilausnro` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10095;

--
-- AUTO_INCREMENT for table `tuote`
--
ALTER TABLE `tuote`
  MODIFY `tuote_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT for table `tuoteryhma`
--
ALTER TABLE `tuoteryhma`
  MODIFY `ryhma_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `uusiss`
--
ALTER TABLE `uusiss`
  MODIFY `uusissId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- Rajoitteet vedostauluille
--

--
-- Rajoitteet taululle `kayttaja`
--
ALTER TABLE `kayttaja`
  ADD CONSTRAINT `fk_kayttajaryhma_id` FOREIGN KEY (`kayttajaryhma_id`) REFERENCES `kayttajaryhma` (`kayttajaryhma_id`);

--
-- Rajoitteet taululle `sisalto`
--
ALTER TABLE `sisalto`
  ADD CONSTRAINT `sisalto_ibfk_2` FOREIGN KEY (`tuote_id`) REFERENCES `tuote` (`tuote_id`),
  ADD CONSTRAINT `sisalto_ibfk_3` FOREIGN KEY (`tilausnro`) REFERENCES `tilausnumero` (`tilausnro`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Rajoitteet taululle `tilaus`
--
ALTER TABLE `tilaus`
  ADD CONSTRAINT `tilaus_ibfk_1` FOREIGN KEY (`tilaaja_id`) REFERENCES `kayttaja` (`id`);

--
-- Rajoitteet taululle `tuote`
--
ALTER TABLE `tuote`
  ADD CONSTRAINT `fk_ryhma_id` FOREIGN KEY (`ryhma_id`) REFERENCES `tuoteryhma` (`ryhma_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
