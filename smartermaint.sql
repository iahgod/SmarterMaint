-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Tempo de geração: 09/06/2025 às 21:47
-- Versão do servidor: 9.1.0
-- Versão do PHP: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `smartermaint`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `historico_logs`
--

DROP TABLE IF EXISTS `historico_logs`;
CREATE TABLE IF NOT EXISTS `historico_logs` (
  `id` int NOT NULL AUTO_INCREMENT,
  `manutencao_id` int NOT NULL,
  `usuario_id` int DEFAULT NULL,
  `acao` varchar(255) DEFAULT NULL,
  `data_log` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `manutencao_id` (`manutencao_id`),
  KEY `usuario_id` (`usuario_id`)
) ENGINE=MyISAM AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4;

--
-- Despejando dados para a tabela `historico_logs`
--

INSERT INTO `historico_logs` (`id`, `manutencao_id`, `usuario_id`, `acao`, `data_log`) VALUES
(1, 2, 1, 'Manutenção atualizada.', '2025-06-09 17:52:32'),
(2, 2, 1, 'Status alterado de Aberta para Em andamento. ', '2025-06-09 17:52:39'),
(3, 2, 1, 'Status alterado de <b>Em andamento</b> para <b>Concluída</b>. ', '2025-06-09 17:53:39'),
(4, 2, 1, 'Manutenção atualizada.', '2025-06-09 17:54:09'),
(5, 2, 1, 'Manutenção atualizada.', '2025-06-09 17:54:10'),
(6, 3, 1, 'Manutenção criada: asd', '2025-06-09 17:57:01'),
(7, 4, 1, 'Manutenção criada: Troca de mulher 2', '2025-06-09 17:57:46'),
(8, 5, 1, 'Manutenção criada: asdasd', '2025-06-09 17:58:51'),
(9, 3, 1, 'Manutenção atualizada.', '2025-06-09 18:02:12'),
(10, 3, 1, 'Status alterado de <b>Aberta</b> para <b>Em andamento</b>. ', '2025-06-09 18:02:17'),
(11, 3, 1, 'Manutenção concluída.', '2025-06-09 18:02:21'),
(12, 5, 1, 'Status alterado de <b>Aberta</b> para <b>Em andamento</b>. ', '2025-06-09 18:03:45'),
(13, 5, 1, 'Manutenção concluída.', '2025-06-09 18:05:15'),
(14, 5, 1, 'Manutenção reaberta.', '2025-06-09 18:05:22'),
(15, 5, 1, 'Manutenção atualizada.', '2025-06-09 18:05:29');

-- --------------------------------------------------------

--
-- Estrutura para tabela `instalacoes`
--

DROP TABLE IF EXISTS `instalacoes`;
CREATE TABLE IF NOT EXISTS `instalacoes` (
  `id` int NOT NULL AUTO_INCREMENT,
  `usuario_id` int NOT NULL,
  `nome` varchar(100) NOT NULL,
  `setor` varchar(100) DEFAULT NULL,
  `observacoes` text,
  `criado_em` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;

--
-- Despejando dados para a tabela `instalacoes`
--

INSERT INTO `instalacoes` (`id`, `usuario_id`, `nome`, `setor`, `observacoes`, `criado_em`) VALUES
(1, 1, 'Gerador Bloco AB', 'Manutenção PredialB', 'testeB', '2025-06-08 22:15:19'),
(2, 1, 'Elevador 2', 'Manutenção Predial', 'teste', '2025-06-09 17:41:37');

-- --------------------------------------------------------

--
-- Estrutura para tabela `manutencoes`
--

DROP TABLE IF EXISTS `manutencoes`;
CREATE TABLE IF NOT EXISTS `manutencoes` (
  `id` int NOT NULL AUTO_INCREMENT,
  `instalacao_id` int NOT NULL,
  `tipo` enum('Preventiva','Corretiva') NOT NULL,
  `titulo` varchar(255) CHARACTER SET utf8mb4 NOT NULL,
  `descricao` text NOT NULL,
  `data_prevista` date NOT NULL,
  `data_execucao` date DEFAULT NULL,
  `responsavel` varchar(100) DEFAULT NULL,
  `status` enum('Aberta','Em andamento','Concluída','Atrasada') DEFAULT 'Aberta',
  `criado_em` datetime DEFAULT CURRENT_TIMESTAMP,
  `atualizado_em` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `instalacao_id` (`instalacao_id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4;

--
-- Despejando dados para a tabela `manutencoes`
--

INSERT INTO `manutencoes` (`id`, `instalacao_id`, `tipo`, `titulo`, `descricao`, `data_prevista`, `data_execucao`, `responsavel`, `status`, `criado_em`, `atualizado_em`) VALUES
(1, 2, 'Corretiva', 'Troca de mulher', 'teste', '2025-06-03', NULL, '1', 'Atrasada', '2025-06-08 22:20:32', '2025-06-09 17:41:43'),
(2, 1, 'Preventiva', 'asdsad', 'asdasd', '2025-06-17', NULL, '1', 'Concluída', '2025-06-08 22:36:00', '2025-06-09 17:53:39'),
(3, 2, 'Preventiva', 'asd', 'teste', '2025-06-25', NULL, '1', 'Concluída', '2025-06-09 17:57:01', '2025-06-09 18:02:21'),
(4, 1, 'Preventiva', 'Troca de mulher 2', 'asdasd', '2025-06-10', NULL, '1', 'Aberta', '2025-06-09 17:57:46', '2025-06-09 17:57:46'),
(5, 2, 'Preventiva', 'asdasd', 'asdasd', '2025-06-19', NULL, '1', 'Em andamento', '2025-06-09 17:58:51', '2025-06-09 18:05:22');

-- --------------------------------------------------------

--
-- Estrutura para tabela `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `token` varchar(255) CHARACTER SET utf8mb4 DEFAULT NULL,
  `reset_token` varchar(255) NOT NULL,
  `reset_expires` datetime NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `last_login` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;

--
-- Despejando dados para a tabela `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `token`, `reset_token`, `reset_expires`, `created_at`, `updated_at`, `last_login`) VALUES
(1, 'iago', 'iagovinicius.12328@gmail.com', '$2y$10$j.n6/5nrc5Yoc6VzclIopeOgSTwOpk7nSVYHuvEWeequvJMqguR2.', '7263af9f69f098f88c04a17a0e9fd6ae', '', '0000-00-00 00:00:00', '2025-06-07 23:07:16', '2025-06-07 23:07:16', '2025-06-09 21:31:22');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
