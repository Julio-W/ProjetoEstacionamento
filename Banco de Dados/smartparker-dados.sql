-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Tempo de geração: 13/10/2024 às 18:18
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
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `estacionamento`
--

INSERT INTO `estacionamento` (`ID`, `Nome`, `QuantidadeDeVagas`, `VagasPreferenciais`, `HorarioAbertura`, `HorarioFechamento`, `ValorHora`, `Cidade`, `Estado`, `Numero`, `Gerente`, `CEP`, `Complemento`, `LimiteComum`, `LimitePreferencial`, `Rua`, `Bairro`) VALUES
(5, 'Lava Jato Lider', 40, 10, '06:00:00', '18:00:00', 15, 'Porteirinha', 'MG', 45, 144, 39520000, 'Ao lado da Caixa', 30, 10, 'Rua G', 'Ouro Branco'),
(6, 'One Parking', 200, 20, '12:00:00', '23:59:00', 7, 'Brasília', 'DF', 255, 142, 70040010, 'Próximo à baixada sul', 180, 20, 'Quadra SBN Quadra 1', 'Asa Norte'),
(7, 'Park ME', 1000, 200, '08:00:00', '19:00:00', 20, 'Uberlândia', 'MG', 12, 141, 35502081, 'Proximo ao Mercado Municipal', 800, 200, 'Rua Estrela Dalva', 'Serranopolis'),
(8, 'Park OK', 3, 2, '04:00:00', '12:00:00', 25, 'Contagem', 'MG', 34, 140, 4062001, 'Ao lado da Farmácia', 1, 2, 'Avenida Indianópolis', 'Indianópolis'),
(9, 'Plan. Auto', 30, 3, '03:30:00', '20:30:00', 20, 'Brasília', 'DF', 34, 143, 70804200, 'Um local com gerentes muito responsáveis', 27, 3, 'Avenida Central', 'Vila Planalto'),
(10, 'Socomil', 12, 6, '12:00:00', '23:59:00', 13, 'Montes Claros', 'MG', 564, 139, 36410055, 'local legal', 6, 6, 'Praça Portugal', 'Centro'),
(11, 'Fractual', 5, 2, '01:00:00', '23:00:00', 35, 'Brazlândia', 'DF', 12, 145, 72770300, 'Ao lado da avenida', 3, 2, 'Rodovia DF-220', 'Asa Sul');

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
) ENGINE=InnoDB AUTO_INCREMENT=146 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `usuario`
--

INSERT INTO `usuario` (`ID`, `Nome`, `DataDeNascimento`, `Classe`, `CPF`, `Cidade`, `Estado`, `Email`, `Telefone`, `Senha`) VALUES
(139, 'Junior', '2024-10-10', '1', '111.111.111-11', '', '', 'socomil@gmail.com', 2147483647, '$2y$10$3.4.RtxwvBHBdjwdRmNlKuiLPS.zcOiexWKxY2BQQ0BGeD4dHjSOW'),
(140, 'Paulo', '2024-10-17', '1', '111.111.111-11', '', '', 'parkok@gmail.com', 2147483647, '$2y$10$aF1KGL3jUODeHW/lOyP3LOa3/bcWh9rzk0NVILzdlDB3u79o8j2fa'),
(141, 'Bruna', '2024-10-18', '1', '111.111.111-11', '', '', 'parkme@gmail.com', 2147483647, '$2y$10$kW2quHeL4JsowtdVwOHciOlgQuzsHGtjkn5pgyh2H18qZW8UWTWxC'),
(142, 'Fernanda', '2024-10-10', '1', '111.111.111-11', '', '', 'oneparking@gmail.com', 2147483647, '$2y$10$a6AKEoFBwUNlLp4svjQ6hu2FSsMwTEGLt1eeQl5.5PE9pdHoEFTKy'),
(143, 'Amanda', '2024-10-08', '1', '111.111.111-11', '', '', 'planauto@gmail.com', 2147483647, '$2y$10$k146Zghv9zXFJHstzTe4iO3JspOzN6L4.NZ3kaGfL/T2xjXnS53z.'),
(144, 'Roberto', '2004-01-23', '1', '111.111.111-11', '', '', 'lider@gmail.com', 2147483647, '$2y$10$mxX82gNGyUpGDLqfHnVWwe4Zp5tyW0ZyYnvJ3SWsW57CxA8j6nUmC'),
(145, 'Robertinho', '2024-09-30', '1', '150.241.736-78', '', '', 'robs@gmail.com', 2147483647, '$2y$10$ygWZv/.i0wwKnOZgh528A.f6ujCyZW/GLBZSY.ke626HS36W1CrJC');

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
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `vaga`
--

INSERT INTO `vaga` (`Cod`, `ID`, `Estacionamento`, `Horario_Entrada`, `Horario_Saida`, `Placa`, `Modelo`, `Data`, `Validade`, `Preferencial`, `Valor`) VALUES
(18, 145, 9, '11:01:00', '12:12:00', 'AAA2222', 'moto', '2024-10-04', 1, 1, 23),
(19, 143, 10, '14:14:00', '05:02:00', 'AAA2222', 'caminhao', '2024-10-24', 1, 1, 119);

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
