-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Creato il: Mag 23, 2023 alle 12:44
-- Versione del server: 10.4.8-MariaDB
-- Versione PHP: 7.3.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `giornalino`
--

-- --------------------------------------------------------

--
-- Struttura della tabella `account`
--

CREATE TABLE `account` (
  `idAccount` int(11) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password_hash` text NOT NULL,
  `ruolo` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dump dei dati per la tabella `account`
--

INSERT INTO `account` (`idAccount`, `username`, `password_hash`, `ruolo`) VALUES
(1, 'lollo', 'lollo', 'amministratore'),
(19, 'scrittore', '$2y$10$cm2LkVGtQW.Lvbmm7nHBpuDXGtKSL5ca7tbTVBBEBa9F.LI/lLyIu', 'scrittore'),
(20, 'validatore', '$2y$10$L5N.vrGgU5lgLUeivEDxkO/ptyfGUHaCgcRneRcGQNLb4p896P4GS', 'validatore'),
(21, 'admin', 'admin', 'amministratore'),
(25, 'mattias', '$2y$10$uNEVOOOYn8xTskJOaHsVz.ze18LcftQNKApBKzxZD1I0mroO/SNHq', 'scrittore');

-- --------------------------------------------------------

--
-- Struttura della tabella `categorie`
--

CREATE TABLE `categorie` (
  `idCategoria` int(11) NOT NULL,
  `categoria` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dump dei dati per la tabella `categorie`
--

INSERT INTO `categorie` (`idCategoria`, `categoria`) VALUES
(1, 'sport'),
(2, 'circolari'),
(3, 'generale'),
(4, 'didattica');

-- --------------------------------------------------------

--
-- Struttura della tabella `notizie`
--

CREATE TABLE `notizie` (
  `idNotizia` int(11) NOT NULL,
  `titolo` varchar(50) DEFAULT NULL,
  `descrizione` varchar(100) DEFAULT NULL,
  `testo` varchar(200) DEFAULT NULL,
  `categoria` int(11) DEFAULT NULL,
  `validato` int(1) DEFAULT NULL,
  `scrittore` varchar(50) DEFAULT NULL,
  `hotword` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dump dei dati per la tabella `notizie`
--

INSERT INTO `notizie` (`idNotizia`, `titolo`, `descrizione`, `testo`, `categoria`, `validato`, `scrittore`, `hotword`) VALUES
(3, 'Apertura iscrizioni anno 2023/2024', 'Ciao user', 'ciao user, mi hai scoperto, ma chi te l\'ha detto?', 4, 1, NULL, '#ciao'),
(4, 'Viaggio di istruzione a Praga', 'La classe 5^CIA va in gita!', 'Dopo mille peripezie, la classe 5^CIA è riuscita finalmente a svolgere il viaggio di istruzione a Praga!!', 3, 1, NULL, 'fantstico'),
(54, 'ciao', 'CIAO', 'CIAO', 1, 1, 'scrittore', 'hotWord'),
(55, 'si', 'no', 'ti', 2, 1, 'scrittore', 'zia');

--
-- Indici per le tabelle scaricate
--

--
-- Indici per le tabelle `account`
--
ALTER TABLE `account`
  ADD PRIMARY KEY (`idAccount`);

--
-- Indici per le tabelle `categorie`
--
ALTER TABLE `categorie`
  ADD PRIMARY KEY (`idCategoria`);

--
-- Indici per le tabelle `notizie`
--
ALTER TABLE `notizie`
  ADD PRIMARY KEY (`idNotizia`),
  ADD KEY `categoria` (`categoria`);

--
-- AUTO_INCREMENT per le tabelle scaricate
--

--
-- AUTO_INCREMENT per la tabella `account`
--
ALTER TABLE `account`
  MODIFY `idAccount` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT per la tabella `categorie`
--
ALTER TABLE `categorie`
  MODIFY `idCategoria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT per la tabella `notizie`
--
ALTER TABLE `notizie`
  MODIFY `idNotizia` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;

--
-- Limiti per le tabelle scaricate
--

--
-- Limiti per la tabella `notizie`
--
ALTER TABLE `notizie`
  ADD CONSTRAINT `notizie_ibfk_3` FOREIGN KEY (`categoria`) REFERENCES `categorie` (`idCategoria`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
