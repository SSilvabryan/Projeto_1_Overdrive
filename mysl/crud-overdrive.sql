-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 11/04/2024 às 13:30
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
-- Banco de dados: `crud-overdrive`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `empresa`
--

CREATE TABLE `empresa` (
  `id_company` int(11) NOT NULL,
  `nome` varchar(255) NOT NULL,
  `nome_fantasia` varchar(255) NOT NULL,
  `cnpj` varchar(18) NOT NULL,
  `endereco` varchar(150) NOT NULL,
  `telefone` varchar(14) NOT NULL,
  `responsavel` varchar(100) NOT NULL,
  `data` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `empresa`
--

INSERT INTO `empresa` (`id_company`, `nome`, `nome_fantasia`, `cnpj`, `endereco`, `telefone`, `responsavel`, `data`) VALUES
(11, 'Inativo (Sem Empresa)', 'Inativo', '00.000.000/0000-00', '-', '(00) 0000-0000', '-', '2023-12-14 13:09:54'),
(13, 'Schuenck Grilo Pastelaria LTDA', 'Pastelaria Schuenck', '14.348.184/0001-90', 'Rua Mimi Amazonas, 98', '(41) 3068-4259', 'Moacir Geraldo Schuenck', '2023-12-14 13:29:06'),
(14, 'Kuster Rocha Auto Peças LTDA', 'Auto Peças Kuster', '71.524.494/0001-51', 'Rua Nossa Senhora do Rosário, 199', '(86) 2313-1915', 'Moana Figueiro Kuster', '2023-12-14 13:32:57'),
(15, 'Cavalcante Coutinho Brechó ME', 'Brechó Cavalcante', '58.816.479/0001-19', 'Rua Galdino Pimentel, 1001', '(28) 3044-9763', 'Luis Quindeler Cavalcante', '2023-12-14 13:34:00'),
(17, 'Prata Constantino Perfumaria ME', 'Perfumaria Prata', '26.561.974/0001-38', 'Rua Professor Oscar Clark, 2016', '(22) 3283-8473', 'Pietro Geraldo Prata', '2023-12-14 13:36:10'),
(18, 'Overdrive Desenvolvimento De Softwares E Consultoria Em Informatica Ltda', 'Overdrive', '33.143.114/0001-40', 'Rua Rodolpho Tognasca, 211', '(19) 9192-1394', 'Rafael/Claudio', '2023-12-14 13:47:09'),
(19, 'Gripp Frossard Propaganda LTDA', 'Propaganda Gripp', '00.309.652/0001-02', 'Rua Doutor Carlos Miranda, 130', '(82) 3438-8282', 'Joelma Queiroga Gripp', '2023-12-14 15:10:03'),
(23, 'Cocelo Pessoa Tintas EPP', 'Tintas Cocelo', '12.275.151/0001-31', 'Rua Quipapa, 400', '(87) 3976-9875', 'Vivaldo Henriquez Cocelo', '2023-12-15 15:28:32');

-- --------------------------------------------------------

--
-- Estrutura para tabela `usuario`
--

CREATE TABLE `usuario` (
  `id_usuario` int(11) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `cpf` varchar(20) NOT NULL,
  `cnh` varchar(20) NOT NULL,
  `telefone` varchar(14) NOT NULL,
  `endereco` varchar(150) NOT NULL,
  `carro` varchar(40) NOT NULL,
  `empresa` varchar(255) NOT NULL,
  `senha` varchar(50) NOT NULL,
  `data` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `id_company` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `usuario`
--

INSERT INTO `usuario` (`id_usuario`, `nome`, `cpf`, `cnh`, `telefone`, `endereco`, `carro`, `empresa`, `senha`, `data`, `id_company`) VALUES
(57, 'Valentim Vaz Iwamoto', '163.661.621-66', '37453168297', '(64) 2075-5928', 'Rua José Antônio Naciff, 55', 'Onix', 'Inativo', 'e8d95a51f3af4a3b134bf6bb680a213a', '2023-12-14 13:12:15', 11),
(58, 'Nicollas Serra Carino', '843.589.832-60', '06297751205', '(68) 2813-7252', 'Rua Elise, 56', 'Polo', 'Inativo', 'e8d95a51f3af4a3b134bf6bb680a213a', '2023-12-14 13:14:15', 11),
(60, 'Sidney Xavier Paulo', '892.852.310-98', '44502442793', '(51) 3518-5526', 'Quadra F Dois, 44', 'HB20', 'Pastelaria Schuenck', 'e8d95a51f3af4a3b134bf6bb680a213a', '2023-12-14 13:30:32', 13),
(61, 'Lucy Carino Dores', '240.110.642-11', '73364266378', '(93) 2561-0483', 'Passagem Boa Esperança, 908', 'Argo', 'Inativo', 'e8d95a51f3af4a3b134bf6bb680a213a', '2023-12-14 13:52:08', 11),
(62, 'Wallace Azevedo Sales', '568.852.791-96', '75997583193', '(67) 2381-8354', 'Travessa Tapemirim, 566', 'Fusca', 'Perfumaria Prata', 'e8d95a51f3af4a3b134bf6bb680a213a', '2023-12-14 17:22:07', 17),
(64, 'dasdsadsa', '556.398.801-55', '12321', '(31) 2312-3123', 'dasds', 'casdasda', 'Inativo', 'e8d95a51f3af4a3b134bf6bb680a213a', '2023-12-15 14:53:27', 11),
(65, 'Heitor Salomão Portela', '908.473.756-47', '87263782840', '(95) 3699-7477', 'Travessa Sílvio Leite, 557', 'Gol Bolinha', 'Propaganda Gripp', 'e8d95a51f3af4a3b134bf6bb680a213a', '2023-12-15 12:54:50', 19),
(66, 'Olga Farias Jales', '123.197.529-60', '41171405588', '(47) 3715-1332', 'Servidão Costa Azul, 599', 'Astra', 'Brechó Cavalcante', 'e8d95a51f3af4a3b134bf6bb680a213a', '2023-12-14 17:44:29', 15),
(71, 'joao', '555.568.013-98', '123213213', '(12) 3213-1231', 'desadsa', 'dsads', 'Inativo', 'e8d95a51f3af4a3b134bf6bb680a213a', '2023-12-15 13:38:23', 11);

-- --------------------------------------------------------

--
-- Estrutura para tabela `usuario_adm`
--

CREATE TABLE `usuario_adm` (
  `id_adm` int(11) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `login` varchar(50) NOT NULL,
  `senha` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `usuario_adm`
--

INSERT INTO `usuario_adm` (`id_adm`, `nome`, `login`, `senha`) VALUES
(1, 'Diego Negretto', 'dieguinho', '123senha');

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `empresa`
--
ALTER TABLE `empresa`
  ADD PRIMARY KEY (`id_company`),
  ADD UNIQUE KEY `cnpj` (`cnpj`);

--
-- Índices de tabela `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id_usuario`),
  ADD UNIQUE KEY `cpf` (`cpf`),
  ADD KEY `id_company` (`id_company`) USING BTREE;

--
-- Índices de tabela `usuario_adm`
--
ALTER TABLE `usuario_adm`
  ADD PRIMARY KEY (`id_adm`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `empresa`
--
ALTER TABLE `empresa`
  MODIFY `id_company` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT de tabela `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=73;

--
-- AUTO_INCREMENT de tabela `usuario_adm`
--
ALTER TABLE `usuario_adm`
  MODIFY `id_adm` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
