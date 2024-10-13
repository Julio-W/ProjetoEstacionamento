-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Tempo de geração: 13/10/2024 às 18:19
-- Versão do servidor: 8.3.0
-- Versão do PHP: 8.2.18

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `smartparker`
CREATE DATABASE smartparker;
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `estacionamento`
--

DROP TABLE IF EXISTS `estacionamento`;
CREATE TABLE IF NOT EXISTS `estacionamento` (
  `ID` int NOT NULL AUTO_INCREMENT,
  `Nome` varchar(120) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `QuantidadeDeVagas` int NOT NULL,
  `VagasPreferenciais` int NOT NULL,
  `HorarioAbertura` time DEFAULT NULL,
  `HorarioFechamento` time DEFAULT NULL,
  `ValorHora` int NOT NULL,
  `Cidade` varchar(120) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `Estado` varchar(2) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `Numero` int DEFAULT NULL,
  `Gerente` int NOT NULL,
  `CEP` int DEFAULT NULL,
  `Complemento` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `LimiteComum` int NOT NULL,
  `LimitePreferencial` int NOT NULL,
  `Rua` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `Bairro` varchar(200) COLLATE utf8mb4_general_ci DEFAULT NULL,
  PRIMARY KEY (`ID`),
  KEY `fk_gerente` (`Gerente`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `usuario`
--

DROP TABLE IF EXISTS `usuario`;
CREATE TABLE IF NOT EXISTS `usuario` (
  `ID` int NOT NULL AUTO_INCREMENT,
  `Nome` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `DataDeNascimento` date NOT NULL,
  `Classe` varchar(15) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `CPF` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `Cidade` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `Estado` varchar(2) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `Email` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `Telefone` int NOT NULL,
  `Senha` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `vaga`
--

DROP TABLE IF EXISTS `vaga`;
CREATE TABLE IF NOT EXISTS `vaga` (
  `Cod` int NOT NULL AUTO_INCREMENT,
  `ID` int NOT NULL,
  `Estacionamento` int NOT NULL,
  `Horario_Entrada` time NOT NULL,
  `Horario_Saida` time NOT NULL,
  `Placa` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `Modelo` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `Data` date NOT NULL,
  `Validade` tinyint(1) NOT NULL,
  `Preferencial` tinyint(1) NOT NULL,
  `Valor` int NOT NULL,
  PRIMARY KEY (`Cod`),
  KEY `fk_estacionamento` (`Estacionamento`),
  KEY `fk_usuario` (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Restrições para tabelas despejadas
--

--
-- Restrições para tabelas `estacionamento`
--
ALTER TABLE `estacionamento`
  ADD CONSTRAINT `fk_gerente` FOREIGN KEY (`Gerente`) REFERENCES `usuario` (`ID`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Restrições para tabelas `vaga`
--
ALTER TABLE `vaga`
  ADD CONSTRAINT `fk_estacionamento` FOREIGN KEY (`Estacionamento`) REFERENCES `estacionamento` (`ID`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `fk_usuario` FOREIGN KEY (`ID`) REFERENCES `usuario` (`ID`) ON DELETE RESTRICT ON UPDATE RESTRICT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
