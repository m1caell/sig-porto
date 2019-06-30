-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Tempo de geração: 30/06/2019 às 19:55
-- Versão do servidor: 10.1.40-MariaDB
-- Versão do PHP: 7.3.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `PORTODB`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `EXPEDITION_SHIP`
--

CREATE TABLE `EXPEDITION_SHIP` (
  `ID_EXPEDITION` int(11) NOT NULL,
  `ID_SHIP` int(11) NOT NULL,
  `EXPEDIRION_DATE` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Despejando dados para a tabela `EXPEDITION_SHIP`
--

INSERT INTO `EXPEDITION_SHIP` (`ID_EXPEDITION`, `ID_SHIP`, `EXPEDIRION_DATE`) VALUES
(35, 5, '2019-06-30 14:51:05');

-- --------------------------------------------------------

--
-- Estrutura para tabela `EXPEDITION_TRUCK`
--

CREATE TABLE `EXPEDITION_TRUCK` (
  `ID_EXPEDITION` int(11) NOT NULL,
  `ID_TRUCK` int(11) NOT NULL,
  `EXPEDIRION_DATE` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura para tabela `HISTORY`
--

CREATE TABLE `HISTORY` (
  `ID_HISTORY` int(11) NOT NULL,
  `ID_SHIP` int(11) NOT NULL,
  `IDS_TRUCKS` varchar(100) DEFAULT NULL,
  `CREATED_DATE` datetime NOT NULL,
  `ISONTHECOAST` tinyint(1) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Despejando dados para a tabela `HISTORY`
--

INSERT INTO `HISTORY` (`ID_HISTORY`, `ID_SHIP`, `IDS_TRUCKS`, `CREATED_DATE`, `ISONTHECOAST`) VALUES
(6, 6, '9', '2019-06-30 19:51:38', 0);

-- --------------------------------------------------------

--
-- Estrutura para tabela `PERSON`
--

CREATE TABLE `PERSON` (
  `USER_ID` int(11) NOT NULL,
  `USERNAME` varchar(200) NOT NULL,
  `EMAIL` varchar(200) NOT NULL,
  `PASSWORD` varchar(200) NOT NULL,
  `TYPE` varchar(50) NOT NULL DEFAULT 'transportador'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Despejando dados para a tabela `PERSON`
--

INSERT INTO `PERSON` (`USER_ID`, `USERNAME`, `EMAIL`, `PASSWORD`, `TYPE`) VALUES
(1, 'teste', 'teste@teste.com', '81dc9bdb52d04dc20036dbd8313ed055', 'transportador'),
(8, 'pablo', 'pablo.trindade@gmail.com', '81dc9bdb52d04dc20036dbd8313ed055', 'transportador'),
(9, 'admin', 'admin@admin.com', '81dc9bdb52d04dc20036dbd8313ed055', 'operador'),
(10, 'Leonardo', 'leo@gmail.com', '81dc9bdb52d04dc20036dbd8313ed055', 'transportador');

-- --------------------------------------------------------

--
-- Estrutura para tabela `SHIP`
--

CREATE TABLE `SHIP` (
  `ID_SHIP` int(11) NOT NULL,
  `NAME` varchar(200) NOT NULL,
  `REGISTRATION` varchar(100) NOT NULL,
  `ISEXPEDITION` tinyint(1) DEFAULT '0',
  `ID_PERSON` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Despejando dados para a tabela `SHIP`
--

INSERT INTO `SHIP` (`ID_SHIP`, `NAME`, `REGISTRATION`, `ISEXPEDITION`, `ID_PERSON`) VALUES
(5, 'Titanic', '1234', 1, 1),
(6, 'PÃ©rola Negra', '34928', 1, 1),
(7, 'GaleÃ£o', '8008546', 0, 1),
(8, 'Nick-boat', '33381', 0, 1),
(9, 'Velejador', '30842', 0, 8),
(10, 'Under', '309842', 0, 8),
(11, 'Billy', '39393', 0, 8),
(12, 'Silvio EmbarcaÃ§Ãµes', '1239', 0, 8),
(14, 'teste', '23084', 0, 9);

-- --------------------------------------------------------

--
-- Estrutura para tabela `TRUCK`
--

CREATE TABLE `TRUCK` (
  `ID_TRUCK` int(11) NOT NULL,
  `NAME` varchar(200) NOT NULL,
  `BOARD` varchar(50) NOT NULL,
  `ISEXPEDITION` tinyint(1) DEFAULT '0',
  `ID_PERSON` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Despejando dados para a tabela `TRUCK`
--

INSERT INTO `TRUCK` (`ID_TRUCK`, `NAME`, `BOARD`, `ISEXPEDITION`, `ID_PERSON`) VALUES
(9, 'Tio Bino', 'DIN-3482', 1, 1),
(10, 'JOESLEU', 'ISD-3209', 0, 1),
(11, 'GYTER', 'INS-2652', 0, 1),
(12, 'Joelma Truck', 'INK-9800', 0, 9);

--
-- Índices de tabelas apagadas
--

--
-- Índices de tabela `EXPEDITION_SHIP`
--
ALTER TABLE `EXPEDITION_SHIP`
  ADD PRIMARY KEY (`ID_EXPEDITION`);

--
-- Índices de tabela `EXPEDITION_TRUCK`
--
ALTER TABLE `EXPEDITION_TRUCK`
  ADD PRIMARY KEY (`ID_EXPEDITION`);

--
-- Índices de tabela `HISTORY`
--
ALTER TABLE `HISTORY`
  ADD PRIMARY KEY (`ID_HISTORY`),
  ADD KEY `FK_SHIP_HISTORY` (`ID_SHIP`);

--
-- Índices de tabela `PERSON`
--
ALTER TABLE `PERSON`
  ADD PRIMARY KEY (`USER_ID`);

--
-- Índices de tabela `SHIP`
--
ALTER TABLE `SHIP`
  ADD PRIMARY KEY (`ID_SHIP`),
  ADD UNIQUE KEY `REGISTRATION` (`REGISTRATION`);

--
-- Índices de tabela `TRUCK`
--
ALTER TABLE `TRUCK`
  ADD PRIMARY KEY (`ID_TRUCK`),
  ADD UNIQUE KEY `BOARD` (`BOARD`);

--
-- AUTO_INCREMENT de tabelas apagadas
--

--
-- AUTO_INCREMENT de tabela `EXPEDITION_SHIP`
--
ALTER TABLE `EXPEDITION_SHIP`
  MODIFY `ID_EXPEDITION` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT de tabela `EXPEDITION_TRUCK`
--
ALTER TABLE `EXPEDITION_TRUCK`
  MODIFY `ID_EXPEDITION` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT de tabela `HISTORY`
--
ALTER TABLE `HISTORY`
  MODIFY `ID_HISTORY` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de tabela `PERSON`
--
ALTER TABLE `PERSON`
  MODIFY `USER_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de tabela `SHIP`
--
ALTER TABLE `SHIP`
  MODIFY `ID_SHIP` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT de tabela `TRUCK`
--
ALTER TABLE `TRUCK`
  MODIFY `ID_TRUCK` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- Restrições para dumps de tabelas
--

--
-- Restrições para tabelas `HISTORY`
--
ALTER TABLE `HISTORY`
  ADD CONSTRAINT `FK_SHIP_HISTORY` FOREIGN KEY (`ID_SHIP`) REFERENCES `SHIP` (`ID_SHIP`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
