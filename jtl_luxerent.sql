-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Creato il: Mag 19, 2025 alle 17:47
-- Versione del server: 10.4.32-MariaDB
-- Versione PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `jtl_luxerent`
--
CREATE DATABASE IF NOT EXISTS `jtl_luxerent` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `jtl_luxerent`;

-- --------------------------------------------------------

--
-- Struttura della tabella `automobili`
--

CREATE TABLE `automobili` (
  `id` int(11) NOT NULL,
  `marca` varchar(50) NOT NULL,
  `anno` int(11) NOT NULL,
  `url_immagine` varchar(255) DEFAULT NULL,
  `prezzo_giornaliero` decimal(10,2) NOT NULL,
  `disponibile` tinyint(1) DEFAULT 1,
  `descrizione` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dump dei dati per la tabella `automobili`
--

INSERT INTO `automobili` (`id`, `marca`, `anno`, `url_immagine`, `prezzo_giornaliero`, `disponibile`, `descrizione`) VALUES
(1, 'Porche Carera 911', 2017, 'Porche Carera 911', 150.00, 1, ''),
(2, 'Audi RS3', 2018, 'Audi RS3', 150.00, 1, ''),
(3, 'Lamborghini Aventador', 2015, 'Lamborghini Aventador', 200.00, 1, ''),
(4, 'Ford Mustang', 2023, 'Ford Mustang', 170.00, 1, ''),
(5, 'Lamborghini Urus', 2017, 'Lamborghini Urus', 200.00, 1, '');

-- --------------------------------------------------------

--
-- Struttura della tabella `disponibilita_auto`
--

CREATE TABLE `disponibilita_auto` (
  `id` int(11) NOT NULL,
  `automobile_id` int(11) NOT NULL,
  `data` date NOT NULL,
  `disponibile` tinyint(1) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struttura della tabella `driver`
--

CREATE TABLE `driver` (
  `id` int(11) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `telefono` varchar(20) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `disponibile` tinyint(1) DEFAULT 1,
  `costo_giornaliero` decimal(10,2) NOT NULL DEFAULT 100.00
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dump dei dati per la tabella `driver`
--

INSERT INTO `driver` (`id`, `nome`, `telefono`, `email`, `disponibile`, `costo_giornaliero`) VALUES
(1, 'Vittorio Roberti', '123456789', 'vittorio.roberti@gmail.com', 1, 100.00),
(2, 'Gianluca Alicandri', '123789456', 'gianluca.alicandri', 1, 100.00),
(3, 'Simone De Sibi', '123456789', 'simone.desibi@gmail.com', 1, 100.00),
(4, 'Matteo Callea', '987654321', 'matteo.callea@gmail.com', 1, 100.00);

-- --------------------------------------------------------

--
-- Struttura della tabella `prenotazioni`
--

CREATE TABLE `prenotazioni` (
  `id` int(11) NOT NULL,
  `utente_id` int(11) NOT NULL,
  `automobile_id` int(11) NOT NULL,
  `data_inizio` date NOT NULL,
  `data_fine` date NOT NULL,
  `data_creazione` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dump dei dati per la tabella `prenotazioni`
--

INSERT INTO `prenotazioni` (`id`, `utente_id`, `automobile_id`, `data_inizio`, `data_fine`, `data_creazione`) VALUES
(1, 1, 1, '2025-05-19', '2025-05-20', '2025-05-19 16:33:20'),
(2, 1, 4, '2025-05-19', '2025-05-22', '2025-05-19 16:50:23');

-- --------------------------------------------------------

--
-- Struttura della tabella `prenotazioni_driver`
--

CREATE TABLE `prenotazioni_driver` (
  `id` int(11) NOT NULL,
  `utente_id` int(11) NOT NULL,
  `data_inizio` date NOT NULL,
  `data_fine` date NOT NULL,
  `note` text DEFAULT NULL,
  `data_creazione` datetime DEFAULT current_timestamp(),
  `driver_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struttura della tabella `utenti`
--

CREATE TABLE `utenti` (
  `id` int(11) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password_hash` varchar(255) NOT NULL,
  `telefono` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dump dei dati per la tabella `utenti`
--

INSERT INTO `utenti` (`id`, `nome`, `email`, `password_hash`, `telefono`) VALUES
(1, 'jako', 'jacopo.toffolo@gmail.com', '0c88028bf3aa6a6a143ed846f2be1ea4', '3280221234');

--
-- Indici per le tabelle scaricate
--

--
-- Indici per le tabelle `automobili`
--
ALTER TABLE `automobili`
  ADD PRIMARY KEY (`id`);

--
-- Indici per le tabelle `disponibilita_auto`
--
ALTER TABLE `disponibilita_auto`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `automobile_id` (`automobile_id`,`data`);

--
-- Indici per le tabelle `driver`
--
ALTER TABLE `driver`
  ADD PRIMARY KEY (`id`);

--
-- Indici per le tabelle `prenotazioni`
--
ALTER TABLE `prenotazioni`
  ADD PRIMARY KEY (`id`),
  ADD KEY `utente_id` (`utente_id`),
  ADD KEY `automobile_id` (`automobile_id`);

--
-- Indici per le tabelle `prenotazioni_driver`
--
ALTER TABLE `prenotazioni_driver`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_driver` (`driver_id`);

--
-- Indici per le tabelle `utenti`
--
ALTER TABLE `utenti`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT per le tabelle scaricate
--

--
-- AUTO_INCREMENT per la tabella `automobili`
--
ALTER TABLE `automobili`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT per la tabella `disponibilita_auto`
--
ALTER TABLE `disponibilita_auto`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT per la tabella `driver`
--
ALTER TABLE `driver`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT per la tabella `prenotazioni`
--
ALTER TABLE `prenotazioni`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT per la tabella `prenotazioni_driver`
--
ALTER TABLE `prenotazioni_driver`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT per la tabella `utenti`
--
ALTER TABLE `utenti`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Limiti per le tabelle scaricate
--

--
-- Limiti per la tabella `disponibilita_auto`
--
ALTER TABLE `disponibilita_auto`
  ADD CONSTRAINT `disponibilita_auto_ibfk_1` FOREIGN KEY (`automobile_id`) REFERENCES `automobili` (`id`) ON DELETE CASCADE;

--
-- Limiti per la tabella `prenotazioni`
--
ALTER TABLE `prenotazioni`
  ADD CONSTRAINT `prenotazioni_ibfk_1` FOREIGN KEY (`utente_id`) REFERENCES `utenti` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `prenotazioni_ibfk_2` FOREIGN KEY (`automobile_id`) REFERENCES `automobili` (`id`) ON DELETE CASCADE;

--
-- Limiti per la tabella `prenotazioni_driver`
--
ALTER TABLE `prenotazioni_driver`
  ADD CONSTRAINT `fk_driver` FOREIGN KEY (`driver_id`) REFERENCES `driver` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
