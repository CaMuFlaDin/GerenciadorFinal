-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 05-Out-2017 às 22:22
-- Versão do servidor: 5.6.21
-- PHP Version: 5.6.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `gerenciador_financeiro`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `cadastros`
--

CREATE TABLE IF NOT EXISTS `cadastros` (
`id_usuario` int(6) NOT NULL,
  `nome_usuario` varchar(100) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  `senha` varchar(100) NOT NULL,
  `privilegio` char(1) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  `data_inicio` date DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `cadastros`
--

INSERT INTO `cadastros` (`id_usuario`, `nome_usuario`, `senha`, `privilegio`, `data_inicio`) VALUES
(1, 'Luiz', '123', 'N', '2017-09-29'),
(2, 'Andre', '123', 'N', '2017-10-05'),
(3, 'admin', 'admin', 'A', '2017-10-04');

-- --------------------------------------------------------

--
-- Estrutura da tabela `categorias`
--

CREATE TABLE IF NOT EXISTS `categorias` (
`id_categoria` int(6) NOT NULL,
  `nome` varchar(100) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  `tipo` char(1) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `categorias`
--

INSERT INTO `categorias` (`id_categoria`, `nome`, `tipo`) VALUES
(1, 'Salário', 'R'),
(2, 'Aluguel', 'A'),
(3, 'Luz', 'D'),
(4, 'Água', 'D'),
(5, 'Internet', 'D'),
(6, 'Outros', 'D');

-- --------------------------------------------------------

--
-- Estrutura da tabela `lancamentos`
--

CREATE TABLE IF NOT EXISTS `lancamentos` (
`id` int(6) NOT NULL,
  `tipo` char(1) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  `previsao` date DEFAULT NULL,
  `efetivada` date DEFAULT NULL,
  `id_categoria` int(6) DEFAULT NULL,
  `descricao` varchar(250) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  `valor` decimal(10,2) DEFAULT NULL,
  `id_usuario` int(6) DEFAULT NULL,
  `data_envio` date DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=76 DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `lancamentos`
--

INSERT INTO `lancamentos` (`id`, `tipo`, `previsao`, `efetivada`, `id_categoria`, `descricao`, `valor`, `id_usuario`, `data_envio`) VALUES
(54, 'R', '2017-10-03', '2017-10-03', 1, 'SalÃƒÂ¡rio Mensal', '1200.00', 1, '2017-10-05'),
(55, 'D', '2017-10-05', '2017-10-05', 3, 'Luz Mensal', '100.00', 1, '2017-10-05'),
(56, 'D', '2017-10-08', '0000-00-00', 4, 'Ãgua Mensal', '100.00', 1, '2017-10-05'),
(57, 'D', '2017-10-20', '0000-00-00', 5, 'Internet Mensal', '100.00', 1, '2017-10-05'),
(74, 'R', '2017-10-04', '2017-10-04', 1, 'SalÃ¡rio Mensal', '2000.00', 2, '2017-10-05'),
(75, 'D', '2017-10-04', '0000-00-00', 3, 'Luz Mensal', '100.00', 2, '2017-10-05');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cadastros`
--
ALTER TABLE `cadastros`
 ADD PRIMARY KEY (`id_usuario`);

--
-- Indexes for table `categorias`
--
ALTER TABLE `categorias`
 ADD PRIMARY KEY (`id_categoria`);

--
-- Indexes for table `lancamentos`
--
ALTER TABLE `lancamentos`
 ADD PRIMARY KEY (`id`), ADD KEY `id_usuario` (`id_usuario`), ADD KEY `fk_categoria` (`id_categoria`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cadastros`
--
ALTER TABLE `cadastros`
MODIFY `id_usuario` int(6) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `categorias`
--
ALTER TABLE `categorias`
MODIFY `id_categoria` int(6) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `lancamentos`
--
ALTER TABLE `lancamentos`
MODIFY `id` int(6) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=76;
--
-- Constraints for dumped tables
--

--
-- Limitadores para a tabela `lancamentos`
--
ALTER TABLE `lancamentos`
ADD CONSTRAINT `fk_categoria` FOREIGN KEY (`id_categoria`) REFERENCES `categorias` (`id_categoria`),
ADD CONSTRAINT `lancamentos_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `cadastros` (`id_usuario`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
