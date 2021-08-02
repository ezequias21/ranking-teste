-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 14-Jul-2021 às 03:17
-- Versão do servidor: 10.3.16-MariaDB
-- versão do PHP: 7.1.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `bdii`
--
CREATE DATABASE IF NOT EXISTS `bdii` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `bdii`;
--
-- Banco de dados: `bd_sistema`
--
CREATE DATABASE IF NOT EXISTS `bd_sistema` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `bd_sistema`;

-- --------------------------------------------------------

--
-- Estrutura da tabela `cliente`
--

CREATE TABLE `cliente` (
  `idCliente` varchar(45) NOT NULL,
  `senha` varchar(8) NOT NULL,
  `login` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `cliente`
--

INSERT INTO `cliente` (`idCliente`, `senha`, `login`) VALUES
('1', 'admin', 'admin');

-- --------------------------------------------------------

--
-- Estrutura da tabela `evento`
--

CREATE TABLE `evento` (
  `idEvento` int(11) NOT NULL,
  `nomeEvento` varchar(45) NOT NULL,
  `qtdeIngresso` int(11) NOT NULL,
  `descricao` varchar(45) DEFAULT NULL,
  `data` date NOT NULL,
  `valor` decimal(6,6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `evento`
--

INSERT INTO `evento` (`idEvento`, `nomeEvento`, `qtdeIngresso`, `descricao`, `data`, `valor`) VALUES
(1, 'Cabare', 0, NULL, '0000-00-00', '0.000000');

-- --------------------------------------------------------

--
-- Estrutura da tabela `ingresso`
--

CREATE TABLE `ingresso` (
  `idNumeroIngresso` int(11) NOT NULL,
  `idEvento` int(11) NOT NULL,
  `codigo` varchar(45) NOT NULL,
  `idPedido` int(11) NOT NULL,
  `valorIngresso` decimal(6,3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `pedido`
--

CREATE TABLE `pedido` (
  `idPedido` int(11) NOT NULL,
  `qtdeIngresso` int(11) NOT NULL,
  `valorPedido` decimal(6,3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `realizapedido`
--

CREATE TABLE `realizapedido` (
  `idCliente` varchar(45) NOT NULL,
  `idPedido` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `cliente`
--
ALTER TABLE `cliente`
  ADD PRIMARY KEY (`idCliente`);

--
-- Índices para tabela `evento`
--
ALTER TABLE `evento`
  ADD PRIMARY KEY (`idEvento`);

--
-- Índices para tabela `ingresso`
--
ALTER TABLE `ingresso`
  ADD PRIMARY KEY (`idNumeroIngresso`),
  ADD KEY `fk_Ingresso_Evento_idx` (`idEvento`),
  ADD KEY `fk_Ingresso_Pedido1_idx` (`idPedido`);

--
-- Índices para tabela `pedido`
--
ALTER TABLE `pedido`
  ADD PRIMARY KEY (`idPedido`);

--
-- Índices para tabela `realizapedido`
--
ALTER TABLE `realizapedido`
  ADD PRIMARY KEY (`idCliente`,`idPedido`),
  ADD KEY `fk_Cliente_has_Pedido_Pedido1_idx` (`idPedido`),
  ADD KEY `fk_Cliente_has_Pedido_Cliente1_idx` (`idCliente`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `evento`
--
ALTER TABLE `evento`
  MODIFY `idEvento` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de tabela `ingresso`
--
ALTER TABLE `ingresso`
  MODIFY `idNumeroIngresso` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `pedido`
--
ALTER TABLE `pedido`
  MODIFY `idPedido` int(11) NOT NULL AUTO_INCREMENT;

--
-- Restrições para despejos de tabelas
--

--
-- Limitadores para a tabela `ingresso`
--
ALTER TABLE `ingresso`
  ADD CONSTRAINT `fk_Ingresso_Evento` FOREIGN KEY (`idEvento`) REFERENCES `evento` (`idEvento`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Ingresso_Pedido1` FOREIGN KEY (`idPedido`) REFERENCES `pedido` (`idPedido`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `realizapedido`
--
ALTER TABLE `realizapedido`
  ADD CONSTRAINT `fk_Cliente_has_Pedido_Cliente1` FOREIGN KEY (`idCliente`) REFERENCES `cliente` (`idCliente`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Cliente_has_Pedido_Pedido1` FOREIGN KEY (`idPedido`) REFERENCES `pedido` (`idPedido`) ON DELETE NO ACTION ON UPDATE NO ACTION;
--
-- Banco de dados: `db_tickets`
--
CREATE DATABASE IF NOT EXISTS `db_tickets` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `db_tickets`;

-- --------------------------------------------------------

--
-- Estrutura da tabela `eventos`
--

CREATE TABLE `eventos` (
  `codEvento` int(11) NOT NULL,
  `nomeEvento` varchar(45) NOT NULL,
  `descricao` varchar(45) NOT NULL,
  `QTDEIngresso` int(11) NOT NULL,
  `data` varchar(45) DEFAULT NULL,
  `status` varchar(45) NOT NULL,
  `idUsuario` int(11) DEFAULT NULL,
  `localEvento` varchar(45) NOT NULL,
  `QTDEIngressoDisponivel` int(11) NOT NULL,
  `valorIngresso` decimal(4,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `eventos`
--

INSERT INTO `eventos` (`codEvento`, `nomeEvento`, `descricao`, `QTDEIngresso`, `data`, `status`, `idUsuario`, `localEvento`, `QTDEIngressoDisponivel`, `valorIngresso`) VALUES
(47, 'a', '', 12, 'a', 'disponivel', 26, 'a', 10, '12.00'),
(48, 'b', '', 12, 'b', 'disponivel', 26, 'b', 11, '12.00'),
(49, 'Batalha das Bandas', 'Uma grande Orquestra Musical', 12, '12/18/2019', 'disponivel', 26, 'Ali na esquina', 10, '12.00');

-- --------------------------------------------------------

--
-- Estrutura da tabela `ingress`
--

CREATE TABLE `ingress` (
  `idingresso` int(11) NOT NULL,
  `idPedidos` int(11) NOT NULL,
  `codEvento` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `ingress`
--

INSERT INTO `ingress` (`idingresso`, `idPedidos`, `codEvento`) VALUES
(11, 76, 48),
(12, 76, 47),
(13, 77, 47),
(14, 77, 49),
(15, 77, 49);

-- --------------------------------------------------------

--
-- Estrutura da tabela `pedidos`
--

CREATE TABLE `pedidos` (
  `idPedidos` int(11) NOT NULL,
  `QTDEIngressos` int(11) NOT NULL,
  `valorTotal` decimal(6,3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `pedidos`
--

INSERT INTO `pedidos` (`idPedidos`, `QTDEIngressos`, `valorTotal`) VALUES
(76, 2, '24.000'),
(77, 3, '36.000');

-- --------------------------------------------------------

--
-- Estrutura da tabela `realiza_pedidos1`
--

CREATE TABLE `realiza_pedidos1` (
  `idUsuario` int(11) DEFAULT NULL,
  `idPedidos` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `realiza_pedidos1`
--

INSERT INTO `realiza_pedidos1` (`idUsuario`, `idPedidos`) VALUES
(26, 76),
(26, 77);

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuario`
--

CREATE TABLE `usuario` (
  `id` int(11) NOT NULL,
  `login` varchar(20) NOT NULL,
  `senha` varchar(45) NOT NULL,
  `tipoUsuario` char(40) NOT NULL,
  `nome` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `usuario`
--

INSERT INTO `usuario` (`id`, `login`, `senha`, `tipoUsuario`, `nome`) VALUES
(26, 's', 's', 'vendedor', 'S'),
(27, 'eronildo2', '12345', 'vendedor', 'Eronildo');

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `eventos`
--
ALTER TABLE `eventos`
  ADD PRIMARY KEY (`codEvento`),
  ADD UNIQUE KEY `nomeEvento` (`nomeEvento`),
  ADD KEY `idUsuario` (`idUsuario`);

--
-- Índices para tabela `ingress`
--
ALTER TABLE `ingress`
  ADD PRIMARY KEY (`idingresso`),
  ADD KEY `idPedidos` (`idPedidos`),
  ADD KEY `codEvento` (`codEvento`);

--
-- Índices para tabela `pedidos`
--
ALTER TABLE `pedidos`
  ADD PRIMARY KEY (`idPedidos`);

--
-- Índices para tabela `realiza_pedidos1`
--
ALTER TABLE `realiza_pedidos1`
  ADD KEY `idUsuario` (`idUsuario`),
  ADD KEY `idPedidos` (`idPedidos`);

--
-- Índices para tabela `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `login` (`login`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `eventos`
--
ALTER TABLE `eventos`
  MODIFY `codEvento` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

--
-- AUTO_INCREMENT de tabela `ingress`
--
ALTER TABLE `ingress`
  MODIFY `idingresso` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT de tabela `pedidos`
--
ALTER TABLE `pedidos`
  MODIFY `idPedidos` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=78;

--
-- AUTO_INCREMENT de tabela `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- Restrições para despejos de tabelas
--

--
-- Limitadores para a tabela `eventos`
--
ALTER TABLE `eventos`
  ADD CONSTRAINT `eventos_ibfk_1` FOREIGN KEY (`idUsuario`) REFERENCES `usuario` (`id`);

--
-- Limitadores para a tabela `ingress`
--
ALTER TABLE `ingress`
  ADD CONSTRAINT `ingress_ibfk_1` FOREIGN KEY (`idPedidos`) REFERENCES `pedidos` (`idPedidos`),
  ADD CONSTRAINT `ingress_ibfk_2` FOREIGN KEY (`codEvento`) REFERENCES `eventos` (`codEvento`);

--
-- Limitadores para a tabela `realiza_pedidos1`
--
ALTER TABLE `realiza_pedidos1`
  ADD CONSTRAINT `realiza_pedidos1_ibfk_1` FOREIGN KEY (`idUsuario`) REFERENCES `usuario` (`id`),
  ADD CONSTRAINT `realiza_pedidos1_ibfk_2` FOREIGN KEY (`idPedidos`) REFERENCES `pedidos` (`idPedidos`);
--
-- Banco de dados: `escola`
--
CREATE DATABASE IF NOT EXISTS `escola` DEFAULT CHARACTER SET utf8 COLLATE utf8_bin;
USE `escola`;

-- --------------------------------------------------------

--
-- Estrutura da tabela `curso`
--

CREATE TABLE `curso` (
  `cod` varchar(7) COLLATE utf8_bin NOT NULL,
  `nome_curso` varchar(50) COLLATE utf8_bin NOT NULL,
  `campus` varchar(30) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Extraindo dados da tabela `curso`
--

INSERT INTO `curso` (`cod`, `nome_curso`, `campus`) VALUES
('ENG0001', 'Engenharia de Computação', 'Juazeiro'),
('PSC0001', 'Psicologia', 'Petrolina');

-- --------------------------------------------------------

--
-- Estrutura da tabela `estudante`
--

CREATE TABLE `estudante` (
  `CPF` varchar(11) COLLATE utf8_bin NOT NULL,
  `nome_est` varchar(40) COLLATE utf8_bin NOT NULL,
  `renda_familiar` decimal(10,0) NOT NULL,
  `cod_curso` varchar(7) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Extraindo dados da tabela `estudante`
--

INSERT INTO `estudante` (`CPF`, `nome_est`, `renda_familiar`, `cod_curso`) VALUES
('11111111111', 'Marcelo de Marcos', '1000', 'ENG0001'),
('22222222222', 'Josias de Oliveira', '1500', 'PSC0001');

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `curso`
--
ALTER TABLE `curso`
  ADD PRIMARY KEY (`cod`);

--
-- Índices para tabela `estudante`
--
ALTER TABLE `estudante`
  ADD PRIMARY KEY (`CPF`),
  ADD KEY `fk_cod_curso` (`cod_curso`);

--
-- Restrições para despejos de tabelas
--

--
-- Limitadores para a tabela `estudante`
--
ALTER TABLE `estudante`
  ADD CONSTRAINT `fk_cod_curso` FOREIGN KEY (`cod_curso`) REFERENCES `curso` (`cod`) ON UPDATE CASCADE;
--
-- Banco de dados: `phpmyadmin`
--
CREATE DATABASE IF NOT EXISTS `phpmyadmin` DEFAULT CHARACTER SET utf8 COLLATE utf8_bin;
USE `phpmyadmin`;

-- --------------------------------------------------------

--
-- Estrutura da tabela `pma__bookmark`
--

CREATE TABLE `pma__bookmark` (
  `id` int(10) UNSIGNED NOT NULL,
  `dbase` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT '',
  `user` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT '',
  `label` varchar(255) CHARACTER SET utf8 NOT NULL DEFAULT '',
  `query` text COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Bookmarks';

-- --------------------------------------------------------

--
-- Estrutura da tabela `pma__central_columns`
--

CREATE TABLE `pma__central_columns` (
  `db_name` varchar(64) COLLATE utf8_bin NOT NULL,
  `col_name` varchar(64) COLLATE utf8_bin NOT NULL,
  `col_type` varchar(64) COLLATE utf8_bin NOT NULL,
  `col_length` text COLLATE utf8_bin DEFAULT NULL,
  `col_collation` varchar(64) COLLATE utf8_bin NOT NULL,
  `col_isNull` tinyint(1) NOT NULL,
  `col_extra` varchar(255) COLLATE utf8_bin DEFAULT '',
  `col_default` text COLLATE utf8_bin DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Central list of columns';

-- --------------------------------------------------------

--
-- Estrutura da tabela `pma__column_info`
--

CREATE TABLE `pma__column_info` (
  `id` int(5) UNSIGNED NOT NULL,
  `db_name` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `table_name` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `column_name` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `comment` varchar(255) CHARACTER SET utf8 NOT NULL DEFAULT '',
  `mimetype` varchar(255) CHARACTER SET utf8 NOT NULL DEFAULT '',
  `transformation` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT '',
  `transformation_options` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT '',
  `input_transformation` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT '',
  `input_transformation_options` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Column information for phpMyAdmin';

-- --------------------------------------------------------

--
-- Estrutura da tabela `pma__designer_settings`
--

CREATE TABLE `pma__designer_settings` (
  `username` varchar(64) COLLATE utf8_bin NOT NULL,
  `settings_data` text COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Settings related to Designer';

-- --------------------------------------------------------

--
-- Estrutura da tabela `pma__export_templates`
--

CREATE TABLE `pma__export_templates` (
  `id` int(5) UNSIGNED NOT NULL,
  `username` varchar(64) COLLATE utf8_bin NOT NULL,
  `export_type` varchar(10) COLLATE utf8_bin NOT NULL,
  `template_name` varchar(64) COLLATE utf8_bin NOT NULL,
  `template_data` text COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Saved export templates';

-- --------------------------------------------------------

--
-- Estrutura da tabela `pma__favorite`
--

CREATE TABLE `pma__favorite` (
  `username` varchar(64) COLLATE utf8_bin NOT NULL,
  `tables` text COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Favorite tables';

-- --------------------------------------------------------

--
-- Estrutura da tabela `pma__history`
--

CREATE TABLE `pma__history` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `username` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `db` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `table` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `timevalue` timestamp NOT NULL DEFAULT current_timestamp(),
  `sqlquery` text COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='SQL history for phpMyAdmin';

-- --------------------------------------------------------

--
-- Estrutura da tabela `pma__navigationhiding`
--

CREATE TABLE `pma__navigationhiding` (
  `username` varchar(64) COLLATE utf8_bin NOT NULL,
  `item_name` varchar(64) COLLATE utf8_bin NOT NULL,
  `item_type` varchar(64) COLLATE utf8_bin NOT NULL,
  `db_name` varchar(64) COLLATE utf8_bin NOT NULL,
  `table_name` varchar(64) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Hidden items of navigation tree';

-- --------------------------------------------------------

--
-- Estrutura da tabela `pma__pdf_pages`
--

CREATE TABLE `pma__pdf_pages` (
  `db_name` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `page_nr` int(10) UNSIGNED NOT NULL,
  `page_descr` varchar(50) CHARACTER SET utf8 NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='PDF relation pages for phpMyAdmin';

-- --------------------------------------------------------

--
-- Estrutura da tabela `pma__recent`
--

CREATE TABLE `pma__recent` (
  `username` varchar(64) COLLATE utf8_bin NOT NULL,
  `tables` text COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Recently accessed tables';

--
-- Extraindo dados da tabela `pma__recent`
--

INSERT INTO `pma__recent` (`username`, `tables`) VALUES
('root', '[{\"db\":\"rankingre9\",\"table\":\"compoe_time\"},{\"db\":\"rankingre9\",\"table\":\"partida\"},{\"db\":\"rankingre9\",\"table\":\"time\"},{\"db\":\"rankingre9\",\"table\":\"jogo\"},{\"db\":\"rankingre9\",\"table\":\"usuario_pontos\"},{\"db\":\"rankingre9\",\"table\":\"usuario\"},{\"db\":\"rankingre9\",\"table\":\"oponente\"},{\"db\":\"rankingre9\",\"table\":\"sala\"},{\"db\":\"rankingre9\",\"table\":\"modos_de_jogo\"},{\"db\":\"rankingre9\",\"table\":\"jogar\"}]');

-- --------------------------------------------------------

--
-- Estrutura da tabela `pma__relation`
--

CREATE TABLE `pma__relation` (
  `master_db` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `master_table` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `master_field` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `foreign_db` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `foreign_table` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `foreign_field` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Relation table';

-- --------------------------------------------------------

--
-- Estrutura da tabela `pma__savedsearches`
--

CREATE TABLE `pma__savedsearches` (
  `id` int(5) UNSIGNED NOT NULL,
  `username` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `db_name` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `search_name` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `search_data` text COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Saved searches';

-- --------------------------------------------------------

--
-- Estrutura da tabela `pma__table_coords`
--

CREATE TABLE `pma__table_coords` (
  `db_name` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `table_name` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `pdf_page_number` int(11) NOT NULL DEFAULT 0,
  `x` float UNSIGNED NOT NULL DEFAULT 0,
  `y` float UNSIGNED NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Table coordinates for phpMyAdmin PDF output';

-- --------------------------------------------------------

--
-- Estrutura da tabela `pma__table_info`
--

CREATE TABLE `pma__table_info` (
  `db_name` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `table_name` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `display_field` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Table information for phpMyAdmin';

--
-- Extraindo dados da tabela `pma__table_info`
--

INSERT INTO `pma__table_info` (`db_name`, `table_name`, `display_field`) VALUES
('escola', 'estudante', 'CPF'),
('rankingre910', 'modos_de_jogo', 'modos');

-- --------------------------------------------------------

--
-- Estrutura da tabela `pma__table_uiprefs`
--

CREATE TABLE `pma__table_uiprefs` (
  `username` varchar(64) COLLATE utf8_bin NOT NULL,
  `db_name` varchar(64) COLLATE utf8_bin NOT NULL,
  `table_name` varchar(64) COLLATE utf8_bin NOT NULL,
  `prefs` text COLLATE utf8_bin NOT NULL,
  `last_update` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Tables'' UI preferences';

--
-- Extraindo dados da tabela `pma__table_uiprefs`
--

INSERT INTO `pma__table_uiprefs` (`username`, `db_name`, `table_name`, `prefs`, `last_update`) VALUES
('root', 'db_tickets', 'eventos', '{\"CREATE_TIME\":\"2019-08-04 13:12:30\"}', '2019-08-04 16:18:29'),
('root', 'rankingre9', 'usuario_pontos', '[]', '2021-07-11 01:34:22'),
('root', 'rankingre910', 'jogo', '{\"CREATE_TIME\":\"2021-06-26 16:51:19\",\"sorted_col\":\"`jogo`.`id` ASC\",\"col_order\":[0,7,1,2,3,4,5,6,8],\"col_visib\":[1,1,1,1,1,1,1,1,1]}', '2021-07-03 14:39:22');

-- --------------------------------------------------------

--
-- Estrutura da tabela `pma__tracking`
--

CREATE TABLE `pma__tracking` (
  `db_name` varchar(64) COLLATE utf8_bin NOT NULL,
  `table_name` varchar(64) COLLATE utf8_bin NOT NULL,
  `version` int(10) UNSIGNED NOT NULL,
  `date_created` datetime NOT NULL,
  `date_updated` datetime NOT NULL,
  `schema_snapshot` text COLLATE utf8_bin NOT NULL,
  `schema_sql` text COLLATE utf8_bin DEFAULT NULL,
  `data_sql` longtext COLLATE utf8_bin DEFAULT NULL,
  `tracking` set('UPDATE','REPLACE','INSERT','DELETE','TRUNCATE','CREATE DATABASE','ALTER DATABASE','DROP DATABASE','CREATE TABLE','ALTER TABLE','RENAME TABLE','DROP TABLE','CREATE INDEX','DROP INDEX','CREATE VIEW','ALTER VIEW','DROP VIEW') COLLATE utf8_bin DEFAULT NULL,
  `tracking_active` int(1) UNSIGNED NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Database changes tracking for phpMyAdmin';

-- --------------------------------------------------------

--
-- Estrutura da tabela `pma__userconfig`
--

CREATE TABLE `pma__userconfig` (
  `username` varchar(64) COLLATE utf8_bin NOT NULL,
  `timevalue` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `config_data` text COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='User preferences storage for phpMyAdmin';

--
-- Extraindo dados da tabela `pma__userconfig`
--

INSERT INTO `pma__userconfig` (`username`, `timevalue`, `config_data`) VALUES
('root', '2021-07-14 01:14:45', '{\"Console\\/Mode\":\"collapse\",\"lang\":\"pt\"}');

-- --------------------------------------------------------

--
-- Estrutura da tabela `pma__usergroups`
--

CREATE TABLE `pma__usergroups` (
  `usergroup` varchar(64) COLLATE utf8_bin NOT NULL,
  `tab` varchar(64) COLLATE utf8_bin NOT NULL,
  `allowed` enum('Y','N') COLLATE utf8_bin NOT NULL DEFAULT 'N'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='User groups with configured menu items';

-- --------------------------------------------------------

--
-- Estrutura da tabela `pma__users`
--

CREATE TABLE `pma__users` (
  `username` varchar(64) COLLATE utf8_bin NOT NULL,
  `usergroup` varchar(64) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Users and their assignments to user groups';

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `pma__bookmark`
--
ALTER TABLE `pma__bookmark`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `pma__central_columns`
--
ALTER TABLE `pma__central_columns`
  ADD PRIMARY KEY (`db_name`,`col_name`);

--
-- Índices para tabela `pma__column_info`
--
ALTER TABLE `pma__column_info`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `db_name` (`db_name`,`table_name`,`column_name`);

--
-- Índices para tabela `pma__designer_settings`
--
ALTER TABLE `pma__designer_settings`
  ADD PRIMARY KEY (`username`);

--
-- Índices para tabela `pma__export_templates`
--
ALTER TABLE `pma__export_templates`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `u_user_type_template` (`username`,`export_type`,`template_name`);

--
-- Índices para tabela `pma__favorite`
--
ALTER TABLE `pma__favorite`
  ADD PRIMARY KEY (`username`);

--
-- Índices para tabela `pma__history`
--
ALTER TABLE `pma__history`
  ADD PRIMARY KEY (`id`),
  ADD KEY `username` (`username`,`db`,`table`,`timevalue`);

--
-- Índices para tabela `pma__navigationhiding`
--
ALTER TABLE `pma__navigationhiding`
  ADD PRIMARY KEY (`username`,`item_name`,`item_type`,`db_name`,`table_name`);

--
-- Índices para tabela `pma__pdf_pages`
--
ALTER TABLE `pma__pdf_pages`
  ADD PRIMARY KEY (`page_nr`),
  ADD KEY `db_name` (`db_name`);

--
-- Índices para tabela `pma__recent`
--
ALTER TABLE `pma__recent`
  ADD PRIMARY KEY (`username`);

--
-- Índices para tabela `pma__relation`
--
ALTER TABLE `pma__relation`
  ADD PRIMARY KEY (`master_db`,`master_table`,`master_field`),
  ADD KEY `foreign_field` (`foreign_db`,`foreign_table`);

--
-- Índices para tabela `pma__savedsearches`
--
ALTER TABLE `pma__savedsearches`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `u_savedsearches_username_dbname` (`username`,`db_name`,`search_name`);

--
-- Índices para tabela `pma__table_coords`
--
ALTER TABLE `pma__table_coords`
  ADD PRIMARY KEY (`db_name`,`table_name`,`pdf_page_number`);

--
-- Índices para tabela `pma__table_info`
--
ALTER TABLE `pma__table_info`
  ADD PRIMARY KEY (`db_name`,`table_name`);

--
-- Índices para tabela `pma__table_uiprefs`
--
ALTER TABLE `pma__table_uiprefs`
  ADD PRIMARY KEY (`username`,`db_name`,`table_name`);

--
-- Índices para tabela `pma__tracking`
--
ALTER TABLE `pma__tracking`
  ADD PRIMARY KEY (`db_name`,`table_name`,`version`);

--
-- Índices para tabela `pma__userconfig`
--
ALTER TABLE `pma__userconfig`
  ADD PRIMARY KEY (`username`);

--
-- Índices para tabela `pma__usergroups`
--
ALTER TABLE `pma__usergroups`
  ADD PRIMARY KEY (`usergroup`,`tab`,`allowed`);

--
-- Índices para tabela `pma__users`
--
ALTER TABLE `pma__users`
  ADD PRIMARY KEY (`username`,`usergroup`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `pma__bookmark`
--
ALTER TABLE `pma__bookmark`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `pma__column_info`
--
ALTER TABLE `pma__column_info`
  MODIFY `id` int(5) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `pma__export_templates`
--
ALTER TABLE `pma__export_templates`
  MODIFY `id` int(5) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `pma__history`
--
ALTER TABLE `pma__history`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `pma__pdf_pages`
--
ALTER TABLE `pma__pdf_pages`
  MODIFY `page_nr` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `pma__savedsearches`
--
ALTER TABLE `pma__savedsearches`
  MODIFY `id` int(5) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- Banco de dados: `rankingre9`
--
CREATE DATABASE IF NOT EXISTS `rankingre9` DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci;
USE `rankingre9`;

-- --------------------------------------------------------

--
-- Estrutura da tabela `compoe_time`
--

CREATE TABLE `compoe_time` (
  `id` int(10) UNSIGNED NOT NULL,
  `id_usuario` int(10) UNSIGNED NOT NULL,
  `id_time` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Extraindo dados da tabela `compoe_time`
--

INSERT INTO `compoe_time` (`id`, `id_usuario`, `id_time`) VALUES
(50, 2, 155),
(51, 5, 156),
(52, 2, 157),
(53, 5, 158),
(54, 2, 159),
(55, 5, 159),
(56, 6, 160),
(57, 7, 160),
(58, 2, 161),
(59, 5, 162),
(60, 2, 163),
(61, 5, 163),
(62, 6, 164),
(63, 7, 164),
(64, 2, 165),
(65, 5, 166),
(66, 6, 167),
(67, 2, 168),
(68, 6, 168),
(69, 5, 169),
(70, 7, 169);

-- --------------------------------------------------------

--
-- Estrutura da tabela `jogo`
--

CREATE TABLE `jogo` (
  `id` int(10) UNSIGNED NOT NULL,
  `nome` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `descricao` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `quantidade_de_jogadores_minima` tinyint(4) DEFAULT NULL,
  `quantidade_de_jogadores_maxima` tinyint(4) DEFAULT NULL,
  `ocupado` smallint(6) DEFAULT NULL,
  `disponivel` smallint(6) DEFAULT NULL,
  `aceita_empate` smallint(6) DEFAULT NULL,
  `link_imagem_jogo` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Extraindo dados da tabela `jogo`
--

INSERT INTO `jogo` (`id`, `nome`, `descricao`, `quantidade_de_jogadores_minima`, `quantidade_de_jogadores_maxima`, `ocupado`, `disponivel`, `aceita_empate`, `link_imagem_jogo`) VALUES
(1, 'ludo', '', 2, 4, NULL, NULL, NULL, 'imgs/ludo.png'),
(3, 'xadrez', '', 2, 2, NULL, NULL, NULL, 'imgs/xadrez.jpg'),
(4, 'dama', '', 2, 2, NULL, NULL, NULL, 'imgs/dama.jpeg'),
(5, 'sinuca', '', 2, 4, NULL, NULL, NULL, 'imgs/sinuca.jpg');

-- --------------------------------------------------------

--
-- Estrutura da tabela `modos_de_jogo`
--

CREATE TABLE `modos_de_jogo` (
  `id` int(10) UNSIGNED NOT NULL,
  `modos` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `id_jogo` int(10) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Extraindo dados da tabela `modos_de_jogo`
--

INSERT INTO `modos_de_jogo` (`id`, `modos`, `id_jogo`) VALUES
(1, '1x1', 1),
(2, '2x2', 1),
(3, '1x1x1', 1),
(4, '1x1', 3),
(5, '1 x 1', 19),
(6, '1 x 1', 19),
(7, '1 x 1 x 1 x 1', 19),
(10, '1 x 1', 114),
(11, '1 x 1 x 1 x 1', 114),
(12, '1 x 1', 118),
(13, '1 x 1 x 1 x 1', 118);

-- --------------------------------------------------------

--
-- Estrutura da tabela `oponente`
--

CREATE TABLE `oponente` (
  `id` int(10) UNSIGNED NOT NULL,
  `id_time` int(10) UNSIGNED NOT NULL,
  `id_oponente` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `partida`
--

CREATE TABLE `partida` (
  `id` int(10) UNSIGNED NOT NULL,
  `id_jogada` int(10) UNSIGNED NOT NULL,
  `id_jogo` int(10) UNSIGNED NOT NULL,
  `id_time` int(10) UNSIGNED NOT NULL,
  `id_time_oponente` int(10) UNSIGNED NOT NULL,
  `id_sala` int(10) UNSIGNED NOT NULL,
  `resultado` smallint(5) UNSIGNED DEFAULT NULL,
  `pontuacao_partida` int(10) NOT NULL,
  `data` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Extraindo dados da tabela `partida`
--

INSERT INTO `partida` (`id`, `id_jogada`, `id_jogo`, `id_time`, `id_time_oponente`, `id_sala`, `resultado`, `pontuacao_partida`, `data`) VALUES
(68, 0, 3, 155, 156, 1, 0, 16, '0000-00-00 00:00:00'),
(69, 1, 3, 156, 155, 1, 2, -16, '2021-07-01 00:00:00'),
(70, 2, 3, 157, 158, 1, 0, 15, '2021-07-10 00:00:00'),
(71, 3, 3, 158, 157, 1, 2, -15, '2021-07-11 00:00:00'),
(72, 4, 3, 159, 160, 1, 0, 22, '2021-07-12 00:00:00'),
(73, 5, 3, 160, 159, 1, 2, -22, '2021-07-12 00:00:00'),
(74, 6, 3, 161, 162, 1, 2, -18, '2021-07-13 00:00:00'),
(75, 7, 3, 162, 161, 1, 0, 18, '2021-07-13 00:00:00'),
(76, 8, 3, 163, 164, 1, 0, 13, '2021-07-13 00:16:09'),
(77, 9, 3, 164, 163, 1, 2, -22, '2021-07-13 00:16:09'),
(78, 10, 3, 165, 166, 1, 0, 22, '2021-07-13 00:45:44'),
(79, 10, 3, 165, 167, 1, 0, 22, '2021-07-13 00:45:44'),
(80, 10, 3, 166, 165, 1, 2, -22, '2021-07-13 00:45:44'),
(81, 10, 3, 166, 167, 1, 2, -22, '2021-07-13 00:45:44'),
(82, 10, 3, 167, 165, 1, 2, -22, '2021-07-13 00:45:44'),
(83, 10, 3, 167, 166, 1, 2, -22, '2021-07-13 00:45:44'),
(84, 11, 3, 168, 169, 1, 2, -16, '2021-07-15 00:00:00'),
(85, 12, 3, 169, 168, 1, 0, 16, '2021-07-15 00:00:00');

-- --------------------------------------------------------

--
-- Estrutura da tabela `sala`
--

CREATE TABLE `sala` (
  `id` int(10) UNSIGNED NOT NULL,
  `codigo` varchar(10) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Extraindo dados da tabela `sala`
--

INSERT INTO `sala` (`id`, `codigo`) VALUES
(1, '0x44'),
(3, 'abcd');

-- --------------------------------------------------------

--
-- Estrutura da tabela `time`
--

CREATE TABLE `time` (
  `id` int(10) UNSIGNED NOT NULL,
  `qtde_jogadores` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Extraindo dados da tabela `time`
--

INSERT INTO `time` (`id`, `qtde_jogadores`) VALUES
(155, 1),
(156, 1),
(157, 1),
(158, 1),
(159, 2),
(160, 2),
(161, 1),
(162, 1),
(163, 2),
(164, 2),
(165, 1),
(166, 1),
(167, 1),
(168, 2),
(169, 2);

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuario`
--

CREATE TABLE `usuario` (
  `id` int(10) UNSIGNED NOT NULL,
  `nickname` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `icon` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `pontuacao` int(5) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Extraindo dados da tabela `usuario`
--

INSERT INTO `usuario` (`id`, `nickname`, `icon`, `pontuacao`) VALUES
(2, 'nickname2', 'imgs/icons/icon2.jpg', 1543),
(5, 'nickname3', 'imgs/icons/coelho.jpg', 1621),
(6, 'nickname4', 'imgs/icons/gamba.jpg', 1730),
(7, 'nickname5', 'imgs/icons/macaco.jpg', 1600),
(8, 'nickname6', 'imgs/icons/icon2.jpg', NULL),
(9, 'nickname7', 'imgs/imgs_jogos/60d392963e3e54.08799109.jpg', NULL),
(10, 'nickname6', 'imgs/icons/icon1.jpg', NULL),
(11, 'nickname8', 'imgs/imgs_jogos/60d3a0b601bfc1.69006334.jpg', NULL),
(12, 'nickname9', 'imgs/imgs_jogos/60dc55d4bbd2f7.53987549.jpg', NULL),
(13, 'Jose', 'imgs/icons/peixe.jpg', NULL),
(14, 'mpto', 'imgs/icons/peixe.jpg', NULL),
(15, 'olinda', 'imgs/icons/peixe.jpg', NULL),
(16, 'Cabecao', 'imgs/icons/papagaio.jpg', NULL);

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuario_pontos`
--

CREATE TABLE `usuario_pontos` (
  `id` int(10) UNSIGNED NOT NULL,
  `id_usuario` int(10) UNSIGNED NOT NULL,
  `id_jogo` int(10) UNSIGNED NOT NULL,
  `pontuacao` int(10) UNSIGNED NOT NULL,
  `id_partida` int(10) UNSIGNED NOT NULL,
  `grupo_individual` smallint(5) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Extraindo dados da tabela `usuario_pontos`
--

INSERT INTO `usuario_pontos` (`id`, `id_usuario`, `id_jogo`, `pontuacao`, `id_partida`, `grupo_individual`) VALUES
(27, 2, 3, 1620, 68, 0),
(28, 5, 3, 1100, 69, 0),
(31, 2, 3, 1650, 70, 0),
(32, 5, 3, 1680, 71, 0),
(33, 2, 3, 2000, 72, 1),
(34, 5, 3, 1700, 72, 1),
(35, 6, 3, 1900, 73, 1),
(36, 7, 3, 1930, 73, 1),
(37, 2, 3, 1400, 74, 0),
(38, 5, 3, 1900, 75, 0),
(39, 2, 3, 1700, 76, 1),
(40, 5, 3, 1900, 76, 1),
(41, 6, 3, 1901, 77, 1),
(42, 7, 3, 1650, 77, 1),
(43, 2, 3, 1920, 0, 0),
(44, 5, 3, 1800, 0, 0),
(45, 6, 3, 1400, 0, 0);

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `compoe_time`
--
ALTER TABLE `compoe_time`
  ADD PRIMARY KEY (`id`),
  ADD KEY `compoe_time_ibfk_1` (`id_time`),
  ADD KEY `compoe_time_ibfk_2` (`id_usuario`);

--
-- Índices para tabela `jogo`
--
ALTER TABLE `jogo`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `modos_de_jogo`
--
ALTER TABLE `modos_de_jogo`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_jogo` (`id_jogo`);

--
-- Índices para tabela `oponente`
--
ALTER TABLE `oponente`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `partida`
--
ALTER TABLE `partida`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_jogo` (`id_jogo`),
  ADD KEY `id_time` (`id_time`),
  ADD KEY `partida_ibfk_2` (`id_sala`);

--
-- Índices para tabela `sala`
--
ALTER TABLE `sala`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `time`
--
ALTER TABLE `time`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `usuario_pontos`
--
ALTER TABLE `usuario_pontos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_usuario` (`id_usuario`),
  ADD KEY `id_jogo` (`id_jogo`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `compoe_time`
--
ALTER TABLE `compoe_time`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=71;

--
-- AUTO_INCREMENT de tabela `jogo`
--
ALTER TABLE `jogo`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=119;

--
-- AUTO_INCREMENT de tabela `modos_de_jogo`
--
ALTER TABLE `modos_de_jogo`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT de tabela `partida`
--
ALTER TABLE `partida`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=86;

--
-- AUTO_INCREMENT de tabela `sala`
--
ALTER TABLE `sala`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de tabela `time`
--
ALTER TABLE `time`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=170;

--
-- AUTO_INCREMENT de tabela `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT de tabela `usuario_pontos`
--
ALTER TABLE `usuario_pontos`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- Restrições para despejos de tabelas
--

--
-- Limitadores para a tabela `compoe_time`
--
ALTER TABLE `compoe_time`
  ADD CONSTRAINT `compoe_time_ibfk_1` FOREIGN KEY (`id_time`) REFERENCES `time` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `compoe_time_ibfk_2` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
--
-- Banco de dados: `rankingre910`
--
CREATE DATABASE IF NOT EXISTS `rankingre910` DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci;
USE `rankingre910`;

-- --------------------------------------------------------

--
-- Estrutura da tabela `compoe_time`
--

CREATE TABLE `compoe_time` (
  `id` int(5) UNSIGNED NOT NULL,
  `id_usuario` int(10) UNSIGNED NOT NULL,
  `id_time` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Extraindo dados da tabela `compoe_time`
--

INSERT INTO `compoe_time` (`id`, `id_usuario`, `id_time`) VALUES
(1, 6, 26),
(2, 10, 27),
(3, 6, 28),
(4, 7, 29),
(5, 6, 29),
(12, 6, 30),
(13, 2, 30);

-- --------------------------------------------------------

--
-- Estrutura da tabela `jogar`
--

CREATE TABLE `jogar` (
  `id` int(10) UNSIGNED NOT NULL,
  `id_partida` int(10) UNSIGNED NOT NULL,
  `id_time` int(10) UNSIGNED NOT NULL,
  `resultado` smallint(5) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Extraindo dados da tabela `jogar`
--

INSERT INTO `jogar` (`id`, `id_partida`, `id_time`, `resultado`) VALUES
(1, 1, 1, 0),
(2, 1, 2, 2),
(3, 2, 1, 2),
(4, 2, 3, 0);

-- --------------------------------------------------------

--
-- Estrutura da tabela `jogo`
--

CREATE TABLE `jogo` (
  `id` int(10) UNSIGNED NOT NULL,
  `qtde_max_jogadores` smallint(5) UNSIGNED NOT NULL,
  `qtde_min_jogadores` smallint(5) UNSIGNED NOT NULL,
  `descricao` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `disponivel` smallint(5) UNSIGNED NOT NULL,
  `empate` smallint(5) UNSIGNED NOT NULL,
  `link_imagem_jogo` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `nome` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ocupado` smallint(6) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Extraindo dados da tabela `jogo`
--

INSERT INTO `jogo` (`id`, `qtde_max_jogadores`, `qtde_min_jogadores`, `descricao`, `disponivel`, `empate`, `link_imagem_jogo`, `nome`, `ocupado`) VALUES
(1, 3, 1, 'Muito bom', 1, 1, 'imgs/ludo.png', 'ludo', NULL),
(2, 3, 2, '', 1, 0, 'imgs/xadrez.jpg', 'xadrez', NULL),
(3, 4, 2, '', 1, 0, 'imgs/sinuca.jpg', 'sinuca', NULL),
(4, 2, 1, 'Dama', 1, 0, 'imgs/dama.jpeg', 'Dama', NULL),
(6, 4, 2, 'lkl', 1, 0, '', 'Pneud', NULL),
(8, 3, 2, '', 1, 0, 'imgs/imgs_jogos/60d7863a556951.36933959.jpg', 'Vacoide', 0),
(9, 2, 1, '', 1, 0, 'imgs/imgs_jogos/60d787d84260b0.91228019.jpg', 'Matilda', 0);

-- --------------------------------------------------------

--
-- Estrutura da tabela `modos_de_jogo`
--

CREATE TABLE `modos_de_jogo` (
  `id` int(10) UNSIGNED NOT NULL,
  `modos` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `id_jogo` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Extraindo dados da tabela `modos_de_jogo`
--

INSERT INTO `modos_de_jogo` (`id`, `modos`, `id_jogo`) VALUES
(1, '1x1', 1),
(2, '1x1x1', 1),
(5, '2x2x2', 1),
(6, '1x2x1', 2);

-- --------------------------------------------------------

--
-- Estrutura da tabela `partida`
--

CREATE TABLE `partida` (
  `id` int(10) UNSIGNED NOT NULL,
  `id_jogo` int(10) UNSIGNED NOT NULL,
  `id_sala` int(10) UNSIGNED NOT NULL,
  `id_time` int(10) UNSIGNED NOT NULL,
  `resultado` smallint(5) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Extraindo dados da tabela `partida`
--

INSERT INTO `partida` (`id`, `id_jogo`, `id_sala`, `id_time`, `resultado`) VALUES
(1, 3, 1, 26, 0),
(2, 3, 1, 27, 1),
(3, 4, 1, 28, 0),
(4, 4, 1, 29, 0),
(5, 3, 1, 30, 2);

-- --------------------------------------------------------

--
-- Estrutura da tabela `sala`
--

CREATE TABLE `sala` (
  `id` int(10) UNSIGNED NOT NULL,
  `codigo` smallint(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Extraindo dados da tabela `sala`
--

INSERT INTO `sala` (`id`, `codigo`) VALUES
(1, 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `time`
--

CREATE TABLE `time` (
  `id` int(5) UNSIGNED NOT NULL,
  `qtde_jogadores` smallint(5) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Extraindo dados da tabela `time`
--

INSERT INTO `time` (`id`, `qtde_jogadores`) VALUES
(1, 2),
(2, 2),
(3, 4);

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuario`
--

CREATE TABLE `usuario` (
  `id` int(10) UNSIGNED NOT NULL,
  `nome` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `icon` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Extraindo dados da tabela `usuario`
--

INSERT INTO `usuario` (`id`, `nome`, `icon`) VALUES
(1, 'nickname1', 'imgs/icons/icon1.jpg'),
(2, 'nickname2', 'imgs/icons/icon2.jpg'),
(3, 'nickname2', 'imgs/icons/icon3.jpg'),
(4, 'sebastiao', 'imgs/icons/macaco.jpg'),
(5, 'aloevera', 'imgs/icons/gamba.jpg'),
(6, 'cascudo', 'imgs/icons/coelho.jpg'),
(7, 'Cabecao', 'imgs/icons/icon1.jpg'),
(9, 'nickname4', 'imgs/icons/icon2.jpg'),
(12, 'Matilda', 'imgs/imgs_jogos/60d7827d4ba689.33931200.jpg'),
(13, 'Seu geraldo', 'imgs/imgs_jogos/60d7834ce0e670.56280302.jpg'),
(14, 'Guria', 'imgs/icons/coelho.jpg');

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `compoe_time`
--
ALTER TABLE `compoe_time`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_time` (`id_time`),
  ADD KEY `id_usuario` (`id_usuario`);

--
-- Índices para tabela `jogar`
--
ALTER TABLE `jogar`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_partida` (`id_partida`),
  ADD KEY `id_time` (`id_time`);

--
-- Índices para tabela `jogo`
--
ALTER TABLE `jogo`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `modos_de_jogo`
--
ALTER TABLE `modos_de_jogo`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_jogo` (`id_jogo`);

--
-- Índices para tabela `partida`
--
ALTER TABLE `partida`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_jogo` (`id_jogo`),
  ADD KEY `id_sala` (`id_sala`);

--
-- Índices para tabela `sala`
--
ALTER TABLE `sala`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `time`
--
ALTER TABLE `time`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `compoe_time`
--
ALTER TABLE `compoe_time`
  MODIFY `id` int(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT de tabela `jogar`
--
ALTER TABLE `jogar`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de tabela `jogo`
--
ALTER TABLE `jogo`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de tabela `modos_de_jogo`
--
ALTER TABLE `modos_de_jogo`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de tabela `partida`
--
ALTER TABLE `partida`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de tabela `sala`
--
ALTER TABLE `sala`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de tabela `time`
--
ALTER TABLE `time`
  MODIFY `id` int(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de tabela `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- Restrições para despejos de tabelas
--

--
-- Limitadores para a tabela `jogar`
--
ALTER TABLE `jogar`
  ADD CONSTRAINT `jogar_ibfk_1` FOREIGN KEY (`id_partida`) REFERENCES `partida` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `jogar_ibfk_2` FOREIGN KEY (`id_time`) REFERENCES `time` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limitadores para a tabela `modos_de_jogo`
--
ALTER TABLE `modos_de_jogo`
  ADD CONSTRAINT `modos_de_jogo_ibfk_1` FOREIGN KEY (`id_jogo`) REFERENCES `jogo` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
--
-- Banco de dados: `sistema`
--
CREATE DATABASE IF NOT EXISTS `sistema` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `sistema`;
--
-- Banco de dados: `tempsensor`
--
CREATE DATABASE IF NOT EXISTS `tempsensor` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `tempsensor`;

-- --------------------------------------------------------

--
-- Estrutura da tabela `temperature`
--

CREATE TABLE `temperature` (
  `id` int(11) NOT NULL,
  `temperature` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `temperature`
--
ALTER TABLE `temperature`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `temperature`
--
ALTER TABLE `temperature`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- Banco de dados: `test`
--
CREATE DATABASE IF NOT EXISTS `test` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `test`;

-- --------------------------------------------------------

--
-- Estrutura da tabela `nomes`
--

CREATE TABLE `nomes` (
  `id` int(11) NOT NULL,
  `ultimoNome` varchar(255) DEFAULT NULL,
  `temperature` int(11) DEFAULT NULL,
  `createdAt` datetime NOT NULL,
  `updatedAt` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `nomes`
--
ALTER TABLE `nomes`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `nomes`
--
ALTER TABLE `nomes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
