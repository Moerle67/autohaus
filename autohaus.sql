-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Erstellungszeit: 12. Mai 2021 um 12:54
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
  `erteilt` date NOT NULL,
  `abgeholt` date NOT NULL,
  `zurueck` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
(6, 4, 'S-MS-105', 2, 1),
(7, 7, 'S-MS 105', 4, 1),
(8, 18, 'S-MS-106', 3, 1);

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

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `mitarbeiter`
--

CREATE TABLE `mitarbeiter` (
  `ma_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `vorname` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
(1, 'PG 1', 20, 1, 10),
(2, 'PG 2', 0, 100, 100),
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
  MODIFY `auftrag_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT für Tabelle `fahrzeug`
--
ALTER TABLE `fahrzeug`
  MODIFY `frz_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT für Tabelle `hersteller`
--
ALTER TABLE `hersteller`
  MODIFY `hersteller_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT für Tabelle `kunde`
--
ALTER TABLE `kunde`
  MODIFY `kunde_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT für Tabelle `mitarbeiter`
--
ALTER TABLE `mitarbeiter`
  MODIFY `ma_id` int(11) NOT NULL AUTO_INCREMENT;

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
