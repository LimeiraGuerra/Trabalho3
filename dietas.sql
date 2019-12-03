-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 25-Out-2019 às 17:39
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
-- Estrutura da tabela `alimentos_has_refeições`
--

CREATE TABLE `alimentos_has_refeições` (
  `Refeições_idRefeições` int(11) NOT NULL,
  `Alimentos_idAlimentos` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `dietas`
--

CREATE TABLE `dietas` (
  `idDietas` int(11) NOT NULL,
  `nome` text NOT NULL,
  `totalKcal` int(11) DEFAULT NULL,
  `Users_idUsers` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `refeições`
--

CREATE TABLE `refeições` (
  `idRefeições` int(11) NOT NULL,
  `nome` text NOT NULL,
  `Dietas_idDietas` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `users`
--

CREATE TABLE `users` (
  `idUsers` int(11) NOT NULL,
  `nome` text NOT NULL,
  `senha` text NOT NULL,
  `login` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `users`
--

INSERT INTO `users` (`idUsers`, `nome`, `senha`, `login`) VALUES
(1, 'admin', 'e97afbffc8552d4432276ff4300ad24c', 'admin');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `alimentos_has_refeições`
--
ALTER TABLE `alimentos_has_refeições`
  ADD PRIMARY KEY (`Alimentos_idAlimentos`,`Refeições_idRefeições`),
  ADD KEY `fk_Alimentos_has_Refeições_Refeições1_idx` (`Refeições_idRefeições`);

--
-- Indexes for table `dietas`
--
ALTER TABLE `dietas`
  ADD PRIMARY KEY (`idDietas`),
  ADD KEY `fk_Dietas_Users_idx` (`Users_idUsers`);

--
-- Indexes for table `refeições`
--
ALTER TABLE `refeições`
  ADD PRIMARY KEY (`idRefeições`),
  ADD KEY `fk_Refeições_Dietas1_idx` (`Dietas_idDietas`);

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
  MODIFY `idDietas` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `refeições`
--
ALTER TABLE `refeições`
  MODIFY `idRefeições` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `idUsers` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Limitadores para a tabela `alimentos_has_refeições`
--
ALTER TABLE `alimentos_has_refeições`
  ADD CONSTRAINT `fk_Alimentos_has_Refeições_Refeições1` FOREIGN KEY (`Refeições_idRefeições`) REFERENCES `refeições` (`idRefeições`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limitadores para a tabela `dietas`
--
ALTER TABLE `dietas`
  ADD CONSTRAINT `fk_Dietas_Users` FOREIGN KEY (`Users_idUsers`) REFERENCES `users` (`idUsers`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limitadores para a tabela `refeições`
--
ALTER TABLE `refeições`
  ADD CONSTRAINT `fk_Refeições_Dietas1` FOREIGN KEY (`Dietas_idDietas`) REFERENCES `dietas` (`idDietas`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
