-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 10/08/2026 às 18:32
-- Versão do servidor: 10.4.32-MariaDB
-- Versão do PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `bd_backend`
--

DELIMITER $$
--
-- Procedimentos
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `listar_categoria` (IN `var_id` INT)   BEGIN
	IF var_id IS NULL THEN
    	SELECT * FROM categoria;
    ELSE
    	SELECT * FROM categoria WHERE id = var_id;
    END IF;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `salvar_categoria` (IN `var_id` INT, IN `var_nome` VARCHAR(100), IN `var_info` TEXT)   BEGIN
    	IF EXISTS (SELECT id FROM categoria WHERE id = var_id) THEN
        	UPDATE categoria SET nome = var_nome, informacoes = var_info WHERE id = var_id;
        ELSE 
        	INSERT INTO categoria (nome, informacoes) VALUES (var_nome, var_info);
        END IF;
    END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Estrutura para tabela `categoria`
--

CREATE TABLE `categoria` (
  `id` int(11) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `informacoes` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `categoria`
--

INSERT INTO `categoria` (`id`, `nome`, `informacoes`) VALUES
(4, 'TESTE DE AULA', 'INFORMAÇÕES DE 270//2026 14:06'),
(5, 'FDGFDG', 'GFDGGFDGF'),
(6, 'WQW', 'WEQEWEQ'),
(7, 'GHFDGFDGFGFGDG', 'GFDGDGDFDGFDG'),
(8, 'DFGDG', 'GFDGFD'),
(9, 'DFFDS', 'FDSFSDF');

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `categoria`
--
ALTER TABLE `categoria`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `categoria`
--
ALTER TABLE `categoria`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
