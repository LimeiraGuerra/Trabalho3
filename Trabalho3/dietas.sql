-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 04-Dez-2019 às 02:34
-- Versão do servidor: 10.1.40-MariaDB
-- versão do PHP: 7.3.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dietas`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `dietas`
--

CREATE TABLE `dietas` (
  `idDietas` int(11) NOT NULL,
  `nome` text NOT NULL,
  `Users_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `dietas`
--

INSERT INTO `dietas` (`idDietas`, `nome`, `Users_id`) VALUES
(71, 'test', 1),
(72, 'banana', 2),
(73, 'fg', 1),
(74, 'dieta', 1),
(75, 'API', 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `refeicoes`
--

CREATE TABLE `refeicoes` (
  `idRefeicoes` int(11) NOT NULL,
  `nome` text NOT NULL,
  `Dietas_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `refeicoes`
--

INSERT INTO `refeicoes` (`idRefeicoes`, `nome`, `Dietas_id`) VALUES
(9, 'bbb', 71),
(10, 'terra', 72),
(11, 'ffff', 73),
(12, 'ccc', 71),
(13, 'refeicao', 74),
(14, 'teste1', 75),
(15, 'teste2', 75),
(16, 'aaaa', 75);

-- --------------------------------------------------------

--
-- Estrutura da tabela `refeicoes_alimentos`
--

CREATE TABLE `refeicoes_alimentos` (
  `Refeicoes_id` int(11) NOT NULL,
  `Alimentos_id` int(11) NOT NULL,
  `gramas` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `refeicoes_alimentos`
--

INSERT INTO `refeicoes_alimentos` (`Refeicoes_id`, `Alimentos_id`, `gramas`) VALUES
(9, 16, 10),
(9, 20, 50),
(13, 43, 80),
(9, 50, 150),
(10, 57, 50),
(14, 109, 0),
(9, 157, 56),
(14, 162, 20),
(9, 257, 50),
(9, 259, 50),
(15, 327, 212),
(14, 350, 500),
(14, 364, 50),
(14, 481, 500);

-- --------------------------------------------------------

--
-- Estrutura da tabela `users`
--

CREATE TABLE `users` (
  `idUsers` int(11) NOT NULL,
  `nome` text NOT NULL,
  `senha` text NOT NULL,
  `login` varchar(100) NOT NULL,
  `isModerator` tinyint(1) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `users`
--

INSERT INTO `users` (`idUsers`, `nome`, `senha`, `login`, `isModerator`) VALUES
(1, 'admin', 'e97afbffc8552d4432276ff4300ad24c', 'admin', 1),
(2, 'Ana', '9db244f774522b1beda740cc6de4abd5', 'ana', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `dietas`
--
ALTER TABLE `dietas`
  ADD PRIMARY KEY (`idDietas`),
  ADD KEY `fk_Dietas_Users` (`Users_id`);

--
-- Indexes for table `refeicoes`
--
ALTER TABLE `refeicoes`
  ADD PRIMARY KEY (`idRefeicoes`),
  ADD KEY `fk_Refeições_Dietas1` (`Dietas_id`);

--
-- Indexes for table `refeicoes_alimentos`
--
ALTER TABLE `refeicoes_alimentos`
  ADD PRIMARY KEY (`Alimentos_id`,`Refeicoes_id`),
  ADD KEY `fk_Alimentos_has_Refeições_Refeições1` (`Refeicoes_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`idUsers`),
  ADD UNIQUE KEY `login_UNIQUE` (`login`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `dietas`
--
ALTER TABLE `dietas`
  MODIFY `idDietas` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=76;

--
-- AUTO_INCREMENT for table `refeicoes`
--
ALTER TABLE `refeicoes`
  MODIFY `idRefeicoes` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `idUsers` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Limitadores para a tabela `dietas`
--
ALTER TABLE `dietas`
  ADD CONSTRAINT `fk_Dietas_Users` FOREIGN KEY (`Users_id`) REFERENCES `users` (`idUsers`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limitadores para a tabela `refeicoes`
--
ALTER TABLE `refeicoes`
  ADD CONSTRAINT `fk_Refeições_Dietas1` FOREIGN KEY (`Dietas_id`) REFERENCES `dietas` (`idDietas`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limitadores para a tabela `refeicoes_alimentos`
--
ALTER TABLE `refeicoes_alimentos`
  ADD CONSTRAINT `fk_Alimentos_has_Refeições_Refeições1` FOREIGN KEY (`Refeicoes_id`) REFERENCES `refeicoes` (`idRefeicoes`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
