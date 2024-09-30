-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Tempo de geração: 30/09/2024 às 01:02
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
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `estacionamento`
--

DROP TABLE IF EXISTS `estacionamento`;
CREATE TABLE IF NOT EXISTS `estacionamento` (
  `ID` int NOT NULL AUTO_INCREMENT,
  `Nome` varchar(120) COLLATE utf8mb4_general_ci NOT NULL,
  `QuantidadeDeVagas` int NOT NULL,
  `VagasPreferenciais` int NOT NULL,
  `HorarioAbertura` time DEFAULT NULL,
  `HorarioFechamento` time DEFAULT NULL,
  `Cidade` varchar(120) COLLATE utf8mb4_general_ci NOT NULL,
  `Estado` varchar(2) COLLATE utf8mb4_general_ci NOT NULL,
  `Numero` int NOT NULL,
  `Gerente` int NOT NULL,
  PRIMARY KEY (`ID`),
  KEY `fk_gerente` (`Gerente`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `estacionamento`
--

INSERT INTO `estacionamento` (`ID`, `Nome`, `QuantidadeDeVagas`, `VagasPreferenciais`, `HorarioAbertura`, `HorarioFechamento`, `Cidade`, `Estado`, `Numero`, `Gerente`) VALUES
(1, 'Teste1', 5, 3, '06:00:00', '18:00:00', 'Porteirinha', 'MG', 12, 127),
(2, 'Teste 2', 6, 3, '06:00:00', '20:00:00', 'Porteirinha', 'MG', 12, 130),
(3, 'teste 3', 10, 5, '00:00:00', '23:00:00', 'Rolândia', 'SP', 1212, 129),
(4, 'teste4', 1, 1, '12:00:00', '12:30:00', 'Blumenau', 'MG', 45, 127);

-- --------------------------------------------------------

--
-- Estrutura para tabela `usuario`
--

DROP TABLE IF EXISTS `usuario`;
CREATE TABLE IF NOT EXISTS `usuario` (
  `ID` int NOT NULL AUTO_INCREMENT,
  `Nome` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `DataDeNascimento` date NOT NULL,
  `Classe` varchar(15) COLLATE utf8mb4_general_ci NOT NULL,
  `CPF` varchar(20) COLLATE utf8mb4_general_ci NOT NULL,
  `Cidade` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `Estado` varchar(2) COLLATE utf8mb4_general_ci NOT NULL,
  `Email` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `Telefone` int NOT NULL,
  `Senha` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=138 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `usuario`
--

INSERT INTO `usuario` (`ID`, `Nome`, `DataDeNascimento`, `Classe`, `CPF`, `Cidade`, `Estado`, `Email`, `Telefone`, `Senha`) VALUES
(119, 'teste2222', '2024-08-10', '', '123123', '234234234', 'MG', 'teste666666@teste', 234234, '0'),
(120, 'ouro', '2024-09-09', '', '111111111', '23213', 'PB', 'teste@gmail', 878, '0'),
(121, '', '0000-00-00', '', '0', '', '', 'ji1173774@gmail.com', 0, '123'),
(123, '', '0000-00-00', '', '0', '', '', 'aaa@chatinha.com', 0, '0'),
(124, '', '0000-00-00', '', '0', '', '', 'xahaka@gmail.com', 0, '40028922'),
(125, '', '0000-00-00', '', '0', '', '', 'heheeh@au.com', 0, '$2y$10$Q5yU9I1BV8D6QGOq0Bj.teIp9UjqEJuqZ1hp0ltCdnmJCtcQgalPy'),
(126, '', '0000-00-00', '', '0', '', '', 'tales@gmail.com', 0, '$2y$10$2rIF.QoahzXB/vyi30YKfeeQHQqhlt2Tn3v8JKE5O/LuroLSVpu2m'),
(127, 'João Ítalo Ferreira Soares', '2024-10-02', '1', '150', '', '', 'robs@gmail.com', 2147483647, '$2y$10$egONPWDBAfCwOAGa3zN5J.iRGGn54.d1635vfw7CyKSR2alrrWSKS'),
(128, '', '0000-00-00', '', '0', '', '', 'italo@gmail.com.br', 0, '$2y$10$uzPm/Mr9Nbr1Z5VduDd0eeakNuZZl6ma0fd.SlX/MFmAITxSKoCtC'),
(129, 'heheheh', '2024-09-11', '1', '111.111.111-11', '', '', 'ai@gmail.com', 2147483647, '$2y$10$Y7MF2wscjKVm4h3cJ2Psw.m79/Y31.qs7Xd2GJjPj7vmeOaoQzy8G'),
(130, 'Sharlene', '2024-10-03', '1', '546.036.693-74', '', '', 'vitor@gmail.com', 2147483647, '$2y$10$qnhmx.JDMTiRTtkPEAqctuki5aavn2FghjMBxvl9gHB9p7BhCTKvm'),
(131, 'THAÍS SABRINA FERREIRA SOARES', '2024-09-19', '', '150.241.676-00', '', '', 'blu@gmail.com.br', 2147483647, '$2y$10$nl0Xic7oVVHdbw5TVXXAHuAnJGDSVxKYe5x7VRvhq9.JljXpbvj.m'),
(132, '', '0000-00-00', '', '', '', '', 'teste1@gmail.com', 0, '$2y$10$tDM1E2KFVuy9Q4GRSS3qSOp9yiRtw/.2D4A2BYimjxmbBRmc1aYfm'),
(133, '', '0000-00-00', '', '', '', '', 'art@gmail.com', 0, '$2y$10$1BviqCUxLJCbFX6fGqrX7uZZCQ8xO7TFO8RfwwSVj89Vy6l2OVT5i'),
(134, '', '0000-00-00', '', '', '', '', 'bala@gmail.com', 0, '$2y$10$sGps01TpGYgE8myr8pUe8OyTDBmKo0Yf63pguQ78TjKu8tW0ao1qC'),
(135, '', '0000-00-00', '', '', '', '', 'oii@gmail.com', 0, '$2y$10$8w0eb03o6T.NLVWoz1yonuaTfPT3/9WVqT9M4DseINIyL3xZhg7Se'),
(136, 'João Ítalo Ferreira Soares', '2024-09-20', '', '150.241.676-00', '', '', 'rogs@gmail.com', 2147483647, '$2y$10$LVvtZVv5dV9kvh6HiFFCYuo7eEzhow3Ai7nKuRO2D2so8cEhKBhlu'),
(137, '', '0000-00-00', '', '', '', '', 'hehe@teste.com', 0, '$2y$10$ZYh3oUZXzoPQhYDMxzbUw.XDNjyDsgA6glxSWsGiYrNurmSMwYEEO');

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
  `Horario_Saida` datetime NOT NULL,
  `Placa` varchar(20) COLLATE utf8mb4_general_ci NOT NULL,
  `Modelo` varchar(30) COLLATE utf8mb4_general_ci NOT NULL,
  `Data` date NOT NULL,
  `Validade` tinyint(1) NOT NULL,
  `Preferencial` tinyint(1) NOT NULL,
  PRIMARY KEY (`Cod`),
  KEY `fk_estacionamento` (`Estacionamento`),
  KEY `fk_usuario` (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `vaga`
--

INSERT INTO `vaga` (`Cod`, `ID`, `Estacionamento`, `Horario_Entrada`, `Horario_Saida`, `Placa`, `Modelo`, `Data`, `Validade`, `Preferencial`) VALUES
(9, 127, 2, '00:00:00', '0000-00-00 00:00:00', 'AAA2222', 'caminhao', '2024-09-27', 1, 1),
(10, 127, 2, '00:00:00', '2001-11-00 00:00:00', 'AAA2222', 'caminhao', '2024-09-27', 1, 0),
(11, 127, 2, '00:00:00', '2003-03-00 00:00:00', 'AAA2222', 'caminhao', '2024-10-04', 1, 0),
(12, 127, 2, '23:04:00', '0000-00-00 00:00:00', 'AAA2222', 'caminhao', '2024-10-04', 1, 0),
(13, 127, 4, '05:05:00', '0000-00-00 00:00:00', 'AAA2222', 'caminhao', '0079-08-07', 1, 0);

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
