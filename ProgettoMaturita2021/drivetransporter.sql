-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Creato il: Mag 30, 2021 alle 14:42
-- Versione del server: 5.7.17
-- Versione PHP: 7.1.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `drivetransporter`
--

-- --------------------------------------------------------

--
-- Struttura della tabella `auto`
--

CREATE TABLE `auto` (
  `targa` varchar(45) NOT NULL,
  `marca` varchar(45) NOT NULL,
  `modello` varchar(45) NOT NULL,
  `disponibilita` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dump dei dati per la tabella `auto`
--

INSERT INTO `auto` (`targa`, `marca`, `modello`, `disponibilita`) VALUES
('AE 113 BR', 'mercedes', 'classe s', 'disponibile'),
('FA 546 GW', 'BMW', '750i', 'disponibile');

-- --------------------------------------------------------

--
-- Struttura della tabella `corsa`
--

CREATE TABLE `corsa` (
  `id_corsa` int(11) NOT NULL,
  `tipologia` varchar(45) DEFAULT NULL,
  `data_inizio` datetime NOT NULL,
  `indirizzo_partenza` varchar(1001) NOT NULL,
  `indirizzo_arrivo` varchar(1001) NOT NULL,
  `telefono` varchar(11) NOT NULL,
  `prezzo` float NOT NULL,
  `targa` varchar(45) NOT NULL,
  `id_utente` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dump dei dati per la tabella `corsa`
--

INSERT INTO `corsa` (`id_corsa`, `tipologia`, `data_inizio`, `indirizzo_partenza`, `indirizzo_arrivo`, `telefono`, `prezzo`, `targa`, `id_utente`) VALUES
(2, 'Standard', '2021-05-29 19:02:00', 'Lecco, Lecco, Lombardia, Italia', 'Dasdana, Collio, Brescia, Italia', '0123456789', 13, 'AE 113 BR', 5),
(3, 'Van', '2021-05-29 00:19:00', 'Lecco, Lecco, Lombardia, Italia', 'Chiccolu, 20121 Rezza, Francia', '0123456789', 18, 'AE 113 BR', 6),
(4, 'Standard', '2021-05-29 18:22:00', 'Via Lugano, 6934 Bioggio, Lugano, Svizzera', 'Chiccolu, 20121 Rezza, Francia', '3349311872', 16, 'AE 113 BR', 5);

-- --------------------------------------------------------

--
-- Struttura della tabella `messaggio`
--

CREATE TABLE `messaggio` (
  `id_messaggio` int(11) NOT NULL,
  `tipologia` varchar(45) DEFAULT NULL,
  `data_inizio` datetime DEFAULT NULL,
  `indirizzo_partenza` varchar(1001) DEFAULT NULL,
  `indirizzo_arrivo` varchar(1001) DEFAULT NULL,
  `telefono` varchar(11) DEFAULT NULL,
  `testo` varchar(1001) DEFAULT NULL,
  `destinatario` varchar(45) DEFAULT NULL,
  `mittente` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dump dei dati per la tabella `messaggio`
--

INSERT INTO `messaggio` (`id_messaggio`, `tipologia`, `data_inizio`, `indirizzo_partenza`, `indirizzo_arrivo`, `telefono`, `testo`, `destinatario`, `mittente`) VALUES
(1, 'Luxury', '2021-05-25 10:11:00', 'Lugano, Lugano, Svizzera', 'Chiccolu, 20121 Rezza, Francia', '0123456789', 'sono toh', 'jetw.ncc@gmail.com', 'tohejeh994@cnetmail.net'),
(71, 'Luxury', '2021-05-25 21:41:00', 'Via Lugano 6934, 6934 Bioggio, Lugano, Svizzera', 'Via Martiri della Resistenza, 23807, 23807 Merate, Lecco, Italia', '3349311872', 'primo servizio', 'jetw.ncc@gmail.com', 'bellini.gabriele@issvigano.org'),
(79, NULL, NULL, NULL, NULL, NULL, 'ciao', 'bellini.gabriele@issvigano.org', 'jetw.ncc@gmail.com'),
(80, NULL, NULL, NULL, NULL, NULL, 'ciao', 'bellini.gabriele@issvigano.org', 'jetw.ncc@gmail.com'),
(81, NULL, NULL, NULL, NULL, NULL, 'ciao', 'tohejeh994@cnetmail.net', 'jetw.ncc@gmail.com'),
(82, NULL, NULL, NULL, NULL, NULL, 'bella', 'tohejeh994@cnetmail.net', 'jetw.ncc@gmail.com'),
(84, NULL, NULL, NULL, NULL, NULL, 'ciao sono ciao', 'jetw.ncc@gmail.com', 'ciao@ciao.it'),
(85, NULL, NULL, NULL, NULL, NULL, 'non mi interessa', 'ciao@ciao.it', 'jetw.ncc@gmail.com'),
(86, NULL, NULL, NULL, NULL, NULL, 'ciao sono lonifo', 'jetw.ncc@gmail.com', 'lonifo9051@ffuqzt.com'),
(87, NULL, NULL, NULL, NULL, NULL, 'ciao sono beccato', 'jetw.ncc@gmail.com', 'beccatoecomprato@gmail.com');

-- --------------------------------------------------------

--
-- Struttura della tabella `utente`
--

CREATE TABLE `utente` (
  `id_utente` int(11) NOT NULL,
  `nome` varchar(45) NOT NULL,
  `cognome` varchar(45) NOT NULL,
  `email` varchar(45) NOT NULL,
  `pw` varchar(45) NOT NULL,
  `foto_profilo` varchar(45) DEFAULT NULL,
  `ruolo` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dump dei dati per la tabella `utente`
--

INSERT INTO `utente` (`id_utente`, `nome`, `cognome`, `email`, `pw`, `foto_profilo`, `ruolo`) VALUES
(4, 'admin', 'admin', 'jetw.ncc@gmail.com', '21df215b23aef81599b7381edd221226', 'img/upload/goku.jpg', 'admin'),
(5, 'normal', 'normal', 'tohejeh994@cnetmail.net', '26e930296fb725ac73f5cde60df02d4a', NULL, 'normal'),
(6, 'bellini', 'Losa', 'lonifo9051@ffuqzt.com', '46e33e81721a56c940d3d9fdb1fce598', 'img/upload/coronavirus.jpg', 'normal'),
(7, 'Walter Sostene', 'Losa', 'bellini.gabriele@issvigano.org', '46e33e81721a56c940d3d9fdb1fce598', NULL, 'normal'),
(9, 'Walter Sostene', 'Losa', 'beccatoecomprato@gmail.com', '319571af0acb801af703055101589018', NULL, 'normal');

--
-- Indici per le tabelle scaricate
--

--
-- Indici per le tabelle `auto`
--
ALTER TABLE `auto`
  ADD PRIMARY KEY (`targa`);

--
-- Indici per le tabelle `corsa`
--
ALTER TABLE `corsa`
  ADD PRIMARY KEY (`id_corsa`),
  ADD KEY `fkIdx_39` (`targa`),
  ADD KEY `prenota` (`id_utente`);

--
-- Indici per le tabelle `messaggio`
--
ALTER TABLE `messaggio`
  ADD PRIMARY KEY (`id_messaggio`);

--
-- Indici per le tabelle `utente`
--
ALTER TABLE `utente`
  ADD PRIMARY KEY (`id_utente`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT per le tabelle scaricate
--

--
-- AUTO_INCREMENT per la tabella `corsa`
--
ALTER TABLE `corsa`
  MODIFY `id_corsa` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT per la tabella `messaggio`
--
ALTER TABLE `messaggio`
  MODIFY `id_messaggio` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=88;
--
-- AUTO_INCREMENT per la tabella `utente`
--
ALTER TABLE `utente`
  MODIFY `id_utente` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- Limiti per le tabelle scaricate
--

--
-- Limiti per la tabella `corsa`
--
ALTER TABLE `corsa`
  ADD CONSTRAINT `prenota` FOREIGN KEY (`id_utente`) REFERENCES `utente` (`id_utente`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
