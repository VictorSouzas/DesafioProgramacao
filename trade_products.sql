-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Feb 22, 2017 at 11:44 AM
-- Server version: 10.1.21-MariaDB
-- PHP Version: 7.1.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `trade_products`
--

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `id` int(11) NOT NULL,
  `id_type_prod` int(10) NOT NULL,
  `id_type_op` int(10) NOT NULL,
  `cod_prod` varchar(60) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `prod_name` varchar(150) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `amount` int(10) NOT NULL,
  `price` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


-- --------------------------------------------------------

--
-- Table structure for table `type_operations`
--

CREATE TABLE `type_operations` (
  `id` int(11) NOT NULL,
  `description` varchar(50) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci ROW_FORMAT=COMPACT;

--
-- Dumping data for table `type_operations`
--

INSERT INTO `type_operations` (`id`, `description`) VALUES
(1, 'Compra'),
(2, 'Venda');

-- --------------------------------------------------------

--
-- Table structure for table `type_product`
--

CREATE TABLE `type_product` (
  `id` int(10) NOT NULL,
  `name` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `descryption` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

--
-- Dumping data for table `type_product`
--

INSERT INTO `type_product` (`id`, `name`, `descryption`) VALUES
(1, 'Mercadoria pronta, completa, acabada', 'É o tipo de mercadoria que prevalece no comércio internacional. Essa mercadoria está totalmente apta a desempenhar a função principal (consoante seu projeto) a que se destina (por exemplo, um roteador digital para fazer o roteamento numa dada rede de computadores; um torno para madeira para executar as operações de torneamento em peças de madeira; e uma máquina de lavar roupa, doméstica, para efetuar a lavagem de roupas de uma família).  '),
(2, 'Mercadoria inacabada', 'É a mercadoria que embora completa, ou seja, possui todos os seus componentes e/ou partes, ainda não apresenta o seu acabamento final. Dessa maneira, por exemplo, um veículo sem pintura é um veículo inacabado.'),
(3, 'Mercadoria incompleta', 'É aquela mercadoria que não apresenta todas os seus componentes e/ou partes, como por exemplo, um automóvel sem rodas; um liquidificados sem motor; e um computador sem placa mãe. Observe que “incompleta” envolve a idéia de “característica essencial”, ou seja, só será incompleta uma mercadoria que já apresenta as características essencias da mercadoria completa.'),
(4, 'Mercadoria por montar', 'É aquela que nunca foi montada. Destarte, quando se compra uma bicicleta numa loja ela vem numa caixa e na situação “por montar”, o que é diferente de uma bicicleta que você leva a uma oficina e lá ela é desmontada.');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_type_prod` (`id_type_prod`),
  ADD KEY `id_type_op` (`id_type_op`),
  ADD KEY `id` (`id`);

--
-- Indexes for table `type_operations`
--
ALTER TABLE `type_operations`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id_3` (`id`),
  ADD KEY `id` (`id`),
  ADD KEY `id_2` (`id`);

--
-- Indexes for table `type_product`
--
ALTER TABLE `type_product`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id` (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;
--
-- AUTO_INCREMENT for table `type_operations`
--
ALTER TABLE `type_operations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `type_product`
--
ALTER TABLE `type_product`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `product`
--
ALTER TABLE `product`
  ADD CONSTRAINT `product_ibfk_1` FOREIGN KEY (`id_type_prod`) REFERENCES `type_product` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `product_ibfk_2` FOREIGN KEY (`id_type_op`) REFERENCES `type_operations` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
