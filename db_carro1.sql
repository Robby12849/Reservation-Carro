-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3307
-- Creato il: Giu 23, 2024 alle 00:03
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
-- Database: `db_carro`
--

-- --------------------------------------------------------

--
-- Struttura della tabella `acquisto`
--

CREATE TABLE `acquisto` (
  `ID_acquisto` int(11) NOT NULL,
  `ID_utente` int(11) DEFAULT NULL,
  `ID_materiale` int(11) DEFAULT NULL,
  `data` date NOT NULL DEFAULT current_timestamp(),
  `costo_totale` int(11) NOT NULL,
  `quantità` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dump dei dati per la tabella `acquisto`
--

INSERT INTO `acquisto` (`ID_acquisto`, `ID_utente`, `ID_materiale`, `data`, `costo_totale`, `quantità`) VALUES
(7, NULL, 1, '2024-06-06', 5, 5),
(8, NULL, 1, '2024-06-06', 70, 70);

-- --------------------------------------------------------

--
-- Struttura della tabella `materiale`
--

CREATE TABLE `materiale` (
  `ID_materiale` int(11) NOT NULL,
  `nome` varchar(60) NOT NULL,
  `quantità` int(11) NOT NULL,
  `prezzo_materiale` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dump dei dati per la tabella `materiale`
--

INSERT INTO `materiale` (`ID_materiale`, `nome`, `quantità`, `prezzo_materiale`) VALUES
(1, 'tondini', 65, 1);

-- --------------------------------------------------------

--
-- Struttura della tabella `prenotazione`
--

CREATE TABLE `prenotazione` (
  `ID_prenotazione` int(11) NOT NULL,
  `ID_utente` int(11) NOT NULL,
  `data` timestamp NOT NULL DEFAULT current_timestamp(),
  `quota_versata` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struttura della tabella `utente`
--

CREATE TABLE `utente` (
  `ID_utente` int(11) NOT NULL,
  `nome` varchar(50) NOT NULL,
  `cognome` varchar(50) NOT NULL,
  `email` varchar(60) NOT NULL,
  `password` varchar(256) NOT NULL,
  `telefono` bigint(20) DEFAULT NULL,
  `ruolo` varchar(20) NOT NULL DEFAULT 'partecipante'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dump dei dati per la tabella `utente`
--

INSERT INTO `utente` (`ID_utente`, `nome`, `cognome`, `email`, `password`, `telefono`, `ruolo`) VALUES
(23, 'angelo ', 'muscatelli', 'angelomuscatelli@gmail.com', '$2y$10$x9HSFpp13g1oh5nsUXRhj.eIC3oi2faKfYfkMi37IvNzHwILVWW3C', 3477103873, 'admin'),
(24, 'Vincenzo', 'Matarazzo', 'vincymata03@gmail.com', '$2y$10$/UZpcJrQxVV.XbCON5pbAuKFbbAC19prYeMBJNgUVbOp1DvQjgDw.', 3701173086, 'admin');

--
-- Indici per le tabelle scaricate
--

--
-- Indici per le tabelle `acquisto`
--
ALTER TABLE `acquisto`
  ADD PRIMARY KEY (`ID_acquisto`),
  ADD KEY `ID_materiale` (`ID_materiale`),
  ADD KEY `ID_utente` (`ID_utente`);

--
-- Indici per le tabelle `materiale`
--
ALTER TABLE `materiale`
  ADD PRIMARY KEY (`ID_materiale`);

--
-- Indici per le tabelle `prenotazione`
--
ALTER TABLE `prenotazione`
  ADD PRIMARY KEY (`ID_prenotazione`),
  ADD KEY `ID_utente` (`ID_utente`);

--
-- Indici per le tabelle `utente`
--
ALTER TABLE `utente`
  ADD PRIMARY KEY (`ID_utente`);

--
-- AUTO_INCREMENT per le tabelle scaricate
--

--
-- AUTO_INCREMENT per la tabella `acquisto`
--
ALTER TABLE `acquisto`
  MODIFY `ID_acquisto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT per la tabella `materiale`
--
ALTER TABLE `materiale`
  MODIFY `ID_materiale` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT per la tabella `prenotazione`
--
ALTER TABLE `prenotazione`
  MODIFY `ID_prenotazione` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT per la tabella `utente`
--
ALTER TABLE `utente`
  MODIFY `ID_utente` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- Limiti per le tabelle scaricate
--

--
-- Limiti per la tabella `acquisto`
--
ALTER TABLE `acquisto`
  ADD CONSTRAINT `ID_materiale` FOREIGN KEY (`ID_materiale`) REFERENCES `materiale` (`ID_materiale`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `ID_utente` FOREIGN KEY (`ID_utente`) REFERENCES `utente` (`ID_utente`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Limiti per la tabella `prenotazione`
--
ALTER TABLE `prenotazione`
  ADD CONSTRAINT `prenotazione_ibfk_1` FOREIGN KEY (`ID_utente`) REFERENCES `utente` (`ID_utente`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
