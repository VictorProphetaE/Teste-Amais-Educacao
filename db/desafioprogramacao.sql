-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 10/05/2023 às 16:12
-- Versão do servidor: 10.4.28-MariaDB
-- Versão do PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `desafioprogramacao`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `cadastro`
--

CREATE TABLE `cadastro` (
  `id` int(11) NOT NULL,
  `nome` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `login` varchar(255) NOT NULL,
  `senha` varchar(255) NOT NULL,
  `empregador` tinyint(1) NOT NULL,
  `candidato` tinyint(1) NOT NULL,
  `data_hora` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `cadastro`
--

INSERT INTO `cadastro` (`id`, `nome`, `email`, `login`, `senha`, `empregador`, `candidato`, `data_hora`) VALUES
(1, 'teste4', 'teste4@email.com', 'teste4', '$2y$10$ibeTdxc7nabrlE410.aUauNM3F7pRLmFvWyn1p9AYQZUrDZ1luhGG', 0, 1, '2023-05-07 13:29:11'),
(2, 'teste1', 'teste1@email.com', 'teste1', '$2y$10$Tv1924PH6B/X.y5Ny.rnL.m46rIvFRG3q5c6ySRI.MlooS/ukUcpO', 1, 0, '2023-05-07 18:53:53'),
(3, 'teste', 'teste@email.com', 'teste', '$2y$10$/kXdU9a4Xnl.Tzwni32gbOsn/wJGuOQqaZJ5Z7jSr1wgqZpTFdiTm', 0, 1, '2023-05-08 22:09:57'),
(4, 'teste2', 'teste2@email.com', 'teste2', '$2y$10$qFKfhm4pRpBhVu.cfC6ADu4pJqM5Ww6aUocxKeHfBk65p7owAqY3K', 0, 1, '2023-05-09 23:43:14'),
(5, 'teste3', 'teste3@email.com', 'teste3', '$2y$10$IU41UF65rueY6n4zZQYwoOlz5IPFs7o1O0VCU.xI8T2BNZ.ik.D1C', 0, 1, '2023-05-10 09:31:32');

-- --------------------------------------------------------

--
-- Estrutura para tabela `curriculo_candidato`
--

CREATE TABLE `curriculo_candidato` (
  `id` int(11) NOT NULL,
  `id_candidato` int(11) NOT NULL,
  `nome` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `cpf` varchar(14) NOT NULL,
  `data_nascimento` date NOT NULL,
  `sexo` varchar(10) NOT NULL,
  `estado_civil` varchar(20) NOT NULL,
  `escolaridade` varchar(255) NOT NULL,
  `cursos_especializacoes` text NOT NULL,
  `experiencia_profissional` text NOT NULL,
  `pretensao_salarial` decimal(10,2) NOT NULL,
  `data_hora` datetime NOT NULL DEFAULT current_timestamp(),
  `ativo` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `curriculo_candidato`
--

INSERT INTO `curriculo_candidato` (`id`, `id_candidato`, `nome`, `email`, `cpf`, `data_nascimento`, `sexo`, `estado_civil`, `escolaridade`, `cursos_especializacoes`, `experiencia_profissional`, `pretensao_salarial`, `data_hora`, `ativo`) VALUES
(1, 1, 'teste4', 'teste4@email.com', '458975552', '1998-10-05', 'masculino', 'viuvo', 'doutorado', 'teste341324treraw2', 'teste12312312trwaee3', 7507.00, '2023-05-09 05:06:24', 1),
(2, 3, 'teste', 'teste@email.com', '501.231.457-55', '1998-01-21', 'feminino', 'casado', 'pos', 'tew64er532a1df3', 'trwaer4654adf954e4', 6780.00, '2023-05-10 05:31:24', 1),
(8, 4, 'teste2', 'teste2@email.com', '980.641.579-68', '1987-05-15', 'masculino', 'solteiro', 'pos', 'tewerq', 'erqwar', 8990.00, '0000-00-00 00:00:00', 1),
(21, 5, 'teste3', 'teste3@email.com', '980.641.579-68', '1970-01-01', 'masculino', 'casado', '', '', '', 0.00, '2023-05-10 11:09:39', 1);

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `cadastro`
--
ALTER TABLE `cadastro`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `curriculo_candidato`
--
ALTER TABLE `curriculo_candidato`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_candidato` (`id_candidato`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `cadastro`
--
ALTER TABLE `cadastro`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de tabela `curriculo_candidato`
--
ALTER TABLE `curriculo_candidato`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- Restrições para tabelas despejadas
--

--
-- Restrições para tabelas `curriculo_candidato`
--
ALTER TABLE `curriculo_candidato`
  ADD CONSTRAINT `curriculo_candidato_ibfk_1` FOREIGN KEY (`id_candidato`) REFERENCES `cadastro` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
