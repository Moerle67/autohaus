-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Erstellungszeit: 26. Mai 2021 um 13:20
-- Server-Version: 10.4.17-MariaDB
-- PHP-Version: 8.0.0

SET FOREIGN_KEY_CHECKS=0;
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Datenbank: `autohaus`
--
CREATE DATABASE IF NOT EXISTS `autohaus` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `autohaus`;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `auftrag`
--

CREATE TABLE `auftrag` (
  `auftrag_id` int(11) NOT NULL,
  `kunde` int(11) NOT NULL,
  `mitarbeiter` int(11) NOT NULL,
  `Fahrzeug` int(11) NOT NULL,
  `erteilt` datetime DEFAULT NULL,
  `abgeholt` datetime DEFAULT NULL,
  `zurueck` datetime DEFAULT NULL,
  `kmStart` int(11) NOT NULL,
  `kmEnde` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Daten für Tabelle `auftrag`
--

INSERT INTO `auftrag` (`auftrag_id`, `kunde`, `mitarbeiter`, `Fahrzeug`, `erteilt`, `abgeholt`, `zurueck`, `kmStart`, `kmEnde`) VALUES
(9, 1, 1, 6, NULL, '2021-05-16 00:00:00', NULL, 123456, NULL),
(10, 3, 3, 7, NULL, '2021-05-19 00:00:00', '2021-05-26 00:00:00', 12222222, 12222500),
(11, 3, 3, 7, NULL, '2021-05-19 00:00:00', '2021-05-26 00:00:00', 12222222, 12222500),
(12, 1, 1, 9, NULL, '2021-05-19 00:00:00', NULL, 123222, NULL),
(14, 3, 3, 36, NULL, '2021-05-26 00:00:00', '0000-00-00 00:00:00', 100000, 102000),
(15, 1, 1, 1, NULL, '2021-05-26 11:49:08', '2021-05-26 11:50:27', 50000, 50100);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `fahrzeug`
--

CREATE TABLE `fahrzeug` (
  `frz_id` int(11) NOT NULL,
  `modell` int(11) NOT NULL,
  `kennzeichen` varchar(255) NOT NULL,
  `preisgruppe` int(11) NOT NULL,
  `verfügbar` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Daten für Tabelle `fahrzeug`
--

INSERT INTO `fahrzeug` (`frz_id`, `modell`, `kennzeichen`, `preisgruppe`, `verfügbar`) VALUES
(1, 17, 'S-MS-001', 3, 1),
(2, 17, 'S-MS-002', 4, 1),
(3, 17, 'S-MS-003', 3, 1),
(4, 17, 'S-MS-004', 4, 1),
(6, 4, 'S-MS-105', 2, 0),
(7, 7, 'S-MS 105', 4, 1),
(8, 18, 'S-MS-106', 3, 1),
(9, 11, 'S MS-110', 3, 0),
(11, 9, 'S BC 885', 3, 1),
(13, 2, 'S XI 145', 4, 1),
(15, 3, 'S VB 557', 3, 1),
(17, 1, 'S KL 331', 2, 1),
(19, 10, 'S XM 888', 4, 1),
(21, 8, 'S VV 777', 2, 1),
(22, 18, 'S PO 6655', 4, 1),
(23, 11, 'S MC 7676', 4, 1),
(24, 5, 'S GF 4356', 2, 1),
(25, 19, 'S PA 4444', 2, 1),
(26, 6, 'S PS 4478', 2, 1),
(27, 4, 'S QA 4848', 4, 1),
(28, 12, 'S SC 1212', 3, 1),
(29, 20, 'S TA 6654', 2, 1),
(30, 7, 'S TI 1049', 1, 1),
(31, 15, 'S BM 3789', 4, 1),
(32, 14, 'S CM 4592', 3, 1),
(33, 13, 'S KL 556', 2, 1),
(34, 16, 'S JH 3557', 3, 1),
(35, 17, 'S PO 8871', 4, 1),
(36, 9, 'S MC 976', 2, 1),
(37, 2, 'S AU 6092', 2, 1),
(38, 3, 'S AE 715', 3, 1),
(39, 1, 'S AU 3326', 3, 1),
(40, 10, 'S HM 5544', 2, 1),
(41, 8, 'S CD 6820', 4, 1),
(42, 18, 'S CE 1274', 3, 1),
(43, 11, 'S EK 119', 4, 1),
(44, 5, 'S GF 670', 2, 1),
(45, 19, 'S PM 529', 4, 1),
(46, 6, 'S PT 6921', 3, 1),
(47, 4, 'S QA 8842', 4, 1),
(48, 12, 'S SK 1259', 4, 1),
(49, 20, 'S TY 7743', 1, 1),
(50, 7, 'S TU 4390', 1, 1),
(51, 15, 'S XO 5115', 4, 1),
(52, 14, 'S JK 4431', 4, 1),
(53, 6, 'S PT 6901', 3, 1),
(54, 4, 'S QP 487', 4, 1),
(55, 5, 'S GF 538', 2, 1);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `hersteller`
--

CREATE TABLE `hersteller` (
  `hersteller_id` int(11) NOT NULL,
  `Bezeichnung` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Daten für Tabelle `hersteller`
--

INSERT INTO `hersteller` (`hersteller_id`, `Bezeichnung`) VALUES
(1, 'Daimler'),
(2, 'Porsche'),
(3, 'VW'),
(4, 'Audi'),
(5, 'BMW');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `kunde`
--

CREATE TABLE `kunde` (
  `kunde_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `vorname` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Daten für Tabelle `kunde`
--

INSERT INTO `kunde` (`kunde_id`, `name`, `vorname`) VALUES
(1, 'Paulsen', 'Pauline'),
(2, 'Lehman', 'Frank'),
(3, 'Schulze', 'Bärbel'),
(4, 'Kohlesen', 'Corinna');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `mitarbeiter`
--

CREATE TABLE `mitarbeiter` (
  `ma_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `vorname` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Daten für Tabelle `mitarbeiter`
--

INSERT INTO `mitarbeiter` (`ma_id`, `name`, `vorname`) VALUES
(1, 'Maier', 'Hans'),
(2, 'Mörl', 'Ingo'),
(3, 'Müller', 'Susanne'),
(4, 'Kalupke', 'Erna');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `modell`
--

CREATE TABLE `modell` (
  `modell_id` int(11) NOT NULL,
  `bezeichnung` varchar(255) NOT NULL,
  `hersteller` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Daten für Tabelle `modell`
--

INSERT INTO `modell` (`modell_id`, `bezeichnung`, `hersteller`) VALUES
(1, 'A4', 4),
(2, 'A1', 4),
(3, 'A3 Limousine', 4),
(4, 'Q8', 4),
(5, 'Golf', 3),
(6, 'Passat', 3),
(7, 'Tiguan', 3),
(8, 'Caddy', 3),
(9, 'A-Klasse', 1),
(10, 'B-Klasse', 1),
(11, 'E-Klasse', 1),
(12, 'S-Klasse', 1),
(13, '2er', 5),
(14, 'Z4', 5),
(15, 'X', 5),
(16, '7er', 5),
(17, '911', 2),
(18, 'Cayenne', 2),
(19, 'Panamera', 2),
(20, 'Taycan', 2);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `preisgruppe`
--

CREATE TABLE `preisgruppe` (
  `preisgr_id` int(11) NOT NULL,
  `bezeichnung` varchar(255) NOT NULL,
  `stunde` int(11) NOT NULL,
  `km` int(11) NOT NULL,
  `pauschal` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Daten für Tabelle `preisgruppe`
--

INSERT INTO `preisgruppe` (`preisgr_id`, `bezeichnung`, `stunde`, `km`, `pauschal`) VALUES
(1, 'PG 1', 20, 1, 10000),
(2, 'PG 2', 0, 100, 1000),
(3, 'PG III', 200, 0, 0),
(4, 'PG IV', 300, 0, 0);

--
-- Indizes der exportierten Tabellen
--

--
-- Indizes für die Tabelle `auftrag`
--
ALTER TABLE `auftrag`
  ADD PRIMARY KEY (`auftrag_id`),
  ADD KEY `kunde` (`kunde`),
  ADD KEY `mitarbeiter` (`mitarbeiter`),
  ADD KEY `Fahrzeug` (`Fahrzeug`);

--
-- Indizes für die Tabelle `fahrzeug`
--
ALTER TABLE `fahrzeug`
  ADD PRIMARY KEY (`frz_id`),
  ADD UNIQUE KEY `kennzeichen` (`kennzeichen`),
  ADD KEY `modell` (`modell`),
  ADD KEY `preisgruppe` (`preisgruppe`);

--
-- Indizes für die Tabelle `hersteller`
--
ALTER TABLE `hersteller`
  ADD PRIMARY KEY (`hersteller_id`);

--
-- Indizes für die Tabelle `kunde`
--
ALTER TABLE `kunde`
  ADD PRIMARY KEY (`kunde_id`);

--
-- Indizes für die Tabelle `mitarbeiter`
--
ALTER TABLE `mitarbeiter`
  ADD PRIMARY KEY (`ma_id`);

--
-- Indizes für die Tabelle `modell`
--
ALTER TABLE `modell`
  ADD PRIMARY KEY (`modell_id`),
  ADD KEY `hersteller` (`hersteller`);

--
-- Indizes für die Tabelle `preisgruppe`
--
ALTER TABLE `preisgruppe`
  ADD PRIMARY KEY (`preisgr_id`);

--
-- AUTO_INCREMENT für exportierte Tabellen
--

--
-- AUTO_INCREMENT für Tabelle `auftrag`
--
ALTER TABLE `auftrag`
  MODIFY `auftrag_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT für Tabelle `fahrzeug`
--
ALTER TABLE `fahrzeug`
  MODIFY `frz_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;

--
-- AUTO_INCREMENT für Tabelle `hersteller`
--
ALTER TABLE `hersteller`
  MODIFY `hersteller_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT für Tabelle `kunde`
--
ALTER TABLE `kunde`
  MODIFY `kunde_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT für Tabelle `mitarbeiter`
--
ALTER TABLE `mitarbeiter`
  MODIFY `ma_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT für Tabelle `modell`
--
ALTER TABLE `modell`
  MODIFY `modell_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT für Tabelle `preisgruppe`
--
ALTER TABLE `preisgruppe`
  MODIFY `preisgr_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints der exportierten Tabellen
--

--
-- Constraints der Tabelle `auftrag`
--
ALTER TABLE `auftrag`
  ADD CONSTRAINT `auftrag_ibfk_1` FOREIGN KEY (`kunde`) REFERENCES `kunde` (`kunde_id`),
  ADD CONSTRAINT `auftrag_ibfk_2` FOREIGN KEY (`mitarbeiter`) REFERENCES `mitarbeiter` (`ma_id`),
  ADD CONSTRAINT `auftrag_ibfk_3` FOREIGN KEY (`Fahrzeug`) REFERENCES `fahrzeug` (`frz_id`);

--
-- Constraints der Tabelle `fahrzeug`
--
ALTER TABLE `fahrzeug`
  ADD CONSTRAINT `fahrzeug_ibfk_1` FOREIGN KEY (`modell`) REFERENCES `modell` (`modell_id`),
  ADD CONSTRAINT `fahrzeug_ibfk_2` FOREIGN KEY (`preisgruppe`) REFERENCES `preisgruppe` (`preisgr_id`);

--
-- Constraints der Tabelle `modell`
--
ALTER TABLE `modell`
  ADD CONSTRAINT `modell_ibfk_1` FOREIGN KEY (`hersteller`) REFERENCES `hersteller` (`hersteller_id`);
SET FOREIGN_KEY_CHECKS=1;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
