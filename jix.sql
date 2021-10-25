-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 25-Out-2021 às 06:31
-- Versão do servidor: 10.4.21-MariaDB
-- versão do PHP: 7.3.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `jix`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `alunos`
--

CREATE TABLE `alunos` (
  `id` int(11) NOT NULL,
  `nome` varchar(255) NOT NULL,
  `matricula` varchar(255) NOT NULL,
  `curso` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `alunos`
--

INSERT INTO `alunos` (`id`, `nome`, `matricula`, `curso`) VALUES
(1, 'Breno Ferreira Ribas ', '0033454', 'Eng. Metalurgica'),
(2, 'Aluno Da Jix', '1111122222', 'Eng. de contratar breno ribas');

-- --------------------------------------------------------

--
-- Estrutura da tabela `documentos`
--

CREATE TABLE `documentos` (
  `id` int(11) NOT NULL,
  `nome` varchar(255) NOT NULL,
  `homologado` int(11) NOT NULL DEFAULT 0,
  `id_aluno` int(11) NOT NULL,
  `tipo_atividade` int(11) NOT NULL,
  `data` datetime NOT NULL DEFAULT current_timestamp(),
  `pesquisa` int(11) NOT NULL DEFAULT 0,
  `ensino` int(11) NOT NULL DEFAULT 0,
  `extensao` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `documentos`
--

INSERT INTO `documentos` (`id`, `nome`, `homologado`, `id_aluno`, `tipo_atividade`, `data`, `pesquisa`, `ensino`, `extensao`) VALUES
(54, '12604326061761f60ac4011.85430254.pdf', 1, 1, 0, '2021-10-25 00:07:12', 14, 2, 4),
(55, '24641894061761f6354e637.31298004.pdf', 0, 1, 0, '2021-10-25 00:07:15', 0, 0, 0),
(56, '16889901061762063201094.15526118.jpg', 0, 1, 0, '2021-10-25 00:11:31', 0, 0, 0),
(57, '168654399661762076740246.17277836.pdf', 1, 1, 0, '2021-10-25 00:11:50', 33, 2, 1),
(58, '1098249838617620dd47ee40.45461057.pdf', 0, 2, 0, '2021-10-25 00:13:33', 0, 0, 0),
(59, '860983549617620e97b8af9.19037103.jpg', 0, 2, 0, '2021-10-25 00:13:45', 0, 0, 0);

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `alunos`
--
ALTER TABLE `alunos`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `documentos`
--
ALTER TABLE `documentos`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `alunos`
--
ALTER TABLE `alunos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de tabela `documentos`
--
ALTER TABLE `documentos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=60;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
