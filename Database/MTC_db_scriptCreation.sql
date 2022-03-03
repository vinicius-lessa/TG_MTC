/** 
* @description  SCRIP Oficial da criação do Banco de dados do projeto MTC (Musci Trade Center) e suas propriedades.
* @changeLog
*   2022/03/03 - Vinícius Lessa: Inserção das primeiras instruções.
*/

-- ## 1º - Criar Banco de Dados
CREATE DATABASE 'dbtg2022' CHARSET='utf8_general_ci'

-- ## 2º - Criar tabel de USUÁRIOS do sistema
CREATE TABLE `users`
(
    `user_id`       int(11) NOT NULL auto_increment ,
    `username`      varchar(150) NOT NULL ,
    `birthday`      date NOT NULL , -- 'YYYY-MM-DD'
    `phone`         varchar(15) DEFAULT NULL ,
    `tipo_pessoa`   char NOT NULL ,
    `email`         varchar(150) NOT NULL ,
    `cpf_cnpj`      varchar(14) DEFAULT NULL ,
    `cep`           varchar(8) DEFAULT NULL ,
    `city`          varchar(50) DEFAULT NULL ,
    `district`      varchar(50) DEFAULT NULL ,
    `bio`           varchar(255) DEFAULT NULL ,
    `active_status` boolean NOT NULL , -- 0 is false, 1 is true
    `password`      varchar(255) NOT NULL ,
    CONSTRAINT users_pk PRIMARY KEY (user_id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


-- ## 3º - Show info about USERS Table
DESCRIBE `users`;


-- ## 4º Inserting Data into the USERS Table
INSERT INTO `users`
(
	`username`,
	`birthday`,
	`phone`,
	`tipo_pessoa`,
	`email`,
	`cpf_cnpj`,
	`cep`,
	`city`,
	`district`,
	`bio`,
	`active_status`,
	`password`
) 
VALUES
(
    'Vinícius Lessa',
    '1998-10-17',
    '+55011950769587',
    'F', 
    'vinicius.lessa33@gmail.com',
    '46269889898',
    '18147000',
    'Araçariguama',
    'Jardim Bela Vista',
    'Músico a 10 anos, toco guitarra, violão, contrabaixo, teclado e bateria. Possui um Home Studio onde realizo minhas gravações e demos.',
    true, 
	'$2y$10$dPxmh5OM5vULhzJ9ukd3r.DJ9275YEng7u.iQrHRYd.WY0eCkBoRu'
),
(
    'Renata Carrillo',
    '1998-10-17',
    '+55011950769587',
    'F',
    'renata.carrillo@gmail.com',
    '46269889898',
    '18147000',
    'São Roque',
    'Jardim Meny',
    'Tentei tocar um pouco de vioção, mas FRACASSEI duas vezes',
    true,
	'$2y$10$dPxmh5OM5vULhzJ9ukd3r.DJ9275YEng7u.iQrHRYd.WY0eCkBoRu'
);

-- #######################################################################################################################

/**
* ## ANALISAR
*/
--
-- Estrutura da tabela `comentario`
--

CREATE TABLE `comentario` (
  `cod_comentario` int(11) NOT NULL,
  `cod_cliente` int(11) DEFAULT NULL,
  `cod_anuncio` int(11) DEFAULT NULL,
  `comentario` varchar(255) DEFAULT NULL,
  `data_comentario` date DEFAULT NULL,
  `data_edit` date DEFAULT NULL,
  `excluido` int(11) DEFAULT 0,
  `avaliacao` int(11) DEFAULT 0,
  `titulo_comentario` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dados da tabela `comentario`
--

INSERT INTO `comentario` (`cod_comentario`, `cod_cliente`, `cod_anuncio`, `comentario`, `data_comentario`, `data_edit`, `excluido`, `avaliacao`, `titulo_comentario`) VALUES
(1, 2, 6, 'okok', '2020-06-20', NULL, 1, 2, 'bom'),
(4, 2, 6, 'TESTE', '2020-06-20', NULL, 0, 2, 'TESTE'),
(5, 2, 3, 'eee', '2020-06-20', NULL, 0, 3, 'eee'),
(7, 3, 5, 'Excelente', '2020-06-20', NULL, 1, 4, 'Excelente'),
(8, 3, 5, 'Excelente', '2020-06-20', NULL, 0, 4, 'Excelente'),
(9, 4, 7, 'Legal', '2020-06-22', NULL, 1, 4, 'Legal'),
(10, 4, 7, 'w,lopqwloq', '2020-06-22', NULL, 0, 4, 'odsodkl');

-- --------------------------------------------------------

--
-- Estrutura da tabela `favorito`
--

CREATE TABLE `favorito` (
  `cod_favorito` int(11) NOT NULL,
  `cod_anuncio` int(11) DEFAULT NULL,
  `cod_cliente` int(11) DEFAULT NULL,
  `data_inclusao` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `favorito`
--

INSERT INTO `favorito` (`cod_favorito`, `cod_anuncio`, `cod_cliente`, `data_inclusao`) VALUES
(1, 6, 2, '2020-06-20');

-- --------------------------------------------------------

--
-- TABELA MARCA
--

-- ESTRUTURA

CREATE TABLE `marca` (
  `cod_marca` int(11) NOT NULL,
  `descricao_marca` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


-- ÍNDICES - CHAVES ESTRANGEIRAS

ALTER TABLE `marca`
  ADD PRIMARY KEY (`cod_marca`);

ALTER TABLE `marca`
  MODIFY `cod_marca` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;


-- INSERÇÃO DE DADOS

INSERT INTO `marca` (`cod_marca`, `descricao_marca`) VALUES
(1, 'Ibanez'),
(2, 'Gibson'),
(3, 'Fender'),
(4, 'Epiphone');


--
-- TABELA MODELO
--

CREATE TABLE `modelo` (
  `cod_modelo` int(11) NOT NULL,
  `descricao_modelo` varchar(50) NOT NULL,
  `cod_categoria` int(11) NOT NULL,
  `nome_categoria` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


-- ÍNDICES - CHAVES ESTRANGEIRAS

ALTER TABLE `modelo`
  ADD PRIMARY KEY (`cod_modelo`);

ALTER TABLE `modelo`
  MODIFY `cod_modelo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

ALTER TABLE `modelo`
  ADD KEY `FK_modelo_categoria` (`cod_categoria`);
 
ALTER TABLE `modelo`
  ADD CONSTRAINT `FK_modelo_categoria` FOREIGN KEY (`cod_categoria`) REFERENCES `categoria` (`cod_categoria`);


-- INSERÇÃO DE DADOS

INSERT INTO `modelo` 
  (
    `cod_modelo`, 
    `descricao_modelo`,
    `cod_categoria`, 
    `nome_categoria`
  ) VALUES
  (1, 'Super Strato',1,'Guitarras'),
  (2, 'Les Paul',1,'Guitarras'),
  (3, 'Stratocaster',1,'Guitarras'),
  (4, 'Telecaster',1,'Guitarras'),
  (5, 'Flying V',1,'Guitarras'),
  (6, 'SG',1,'Guitarras');

--
-- TABELA CATEGORIA
--

-- ESTRUTURA

CREATE TABLE `categoria` (
  `cod_categoria` int(11) NOT NULL,
  `nome_categoria` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


-- INSERÇÃO DE DADOS

INSERT INTO `categoria` (`cod_categoria`, `nome_categoria`) VALUES
(1, 'Guitarras'),
(2, 'Violões'),
(3, 'ContraBaixos'),
(4, 'Baterias'),
(5, 'Amplificadores'),
(6, 'Mesas de Som'),
(7, 'Microfones'),
(8, 'Cabos e Adaptadores'),
(9, 'Baixolões'),
(10, 'Capas e Cases'),
(11, 'Interfaces de Som');


-- ÍNDICES - CHAVES ESTRANGEIRAS

ALTER TABLE `categoria`
  ADD PRIMARY KEY (`cod_categoria`);

ALTER TABLE `categoria`
  MODIFY `cod_categoria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- TABELA ANUNCIOS
--

-- ESTRUTURA

CREATE TABLE `anuncios` (
  `cod_anuncio` int(11) NOT NULL,
  `titulo_anuncio` varchar(50) NOT NULL,
  `descricao_anuncio` varchar(250) DEFAULT NULL,
  `valor_un` decimal(6,2) NOT NULL,
  `cover_img` varchar(250) DEFAULT NULL,
  `banner_img` varchar(250) DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `cod_categoria` int(11) NOT NULL,
  `descricao_categoria` varchar(50) NOT NULL,
  `cod_marca` int(11) NOT NULL,
  `descricao_marca` varchar(50) NOT null,
  `cod_modelo` int(11) NOT NULL,
  `descricao_modelo` varchar(50) NOT NULL,
  `cod_usuario` int(11) NOT NULL,
  `nome_usuario` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


-- ÍNDICES - CHAVES ESTRANGEIRAS

ALTER TABLE `anuncios`
  ADD PRIMARY KEY (`cod_anuncio`),
  ADD KEY `FK_anuncio_categoria` (`cod_categoria`),
  ADD KEY `FK_anuncio_marca` (`cod_marca`),
  ADD KEY `FK_anuncio_modelo` (`cod_modelo`),
  ADD KEY `FK_anuncio_usuario` (`cod_usuario`);

ALTER TABLE `anuncios`
  ADD CONSTRAINT `FK_anuncio_categoria` FOREIGN KEY (`cod_categoria`) REFERENCES `categoria` (`cod_categoria`);

ALTER TABLE `anuncios`
  ADD CONSTRAINT `FK_anuncio_marca` FOREIGN KEY (`cod_marca`) REFERENCES `marca` (`cod_marca`);

ALTER TABLE `anuncios`
  ADD CONSTRAINT `FK_anuncio_modelo` FOREIGN KEY (`cod_modelo`) REFERENCES `modelo` (`cod_modelo`);
 
ALTER TABLE `anuncios`
  ADD CONSTRAINT `FK_anuncio_usuario` FOREIGN KEY (`cod_usuario`) REFERENCES `usuario` (`cod_usuario`);


-- INSERÇÃO DE DADOS

INSERT INTO `anuncios` 
  (
    `cod_anuncio`,
    `titulo_anuncio`,
    `descricao_anuncio`,
    `valor_un`,
    `cover_img`,
    `banner_img`,
    `status`,
    `cod_categoria`,
    `descricao_categoria`,
    `cod_marca`,
    `descricao_marca`,
    `cod_modelo`,
    `descricao_modelo`,
    `cod_usuario`,
    `nome_usuario`    
  ) VALUES
  (
    1, 
    'Guitarra Ibanez Preta', 
    'Guitarra Profissional Ibanez preta ano 2014', 
    '1300.00', 
    'imagem-200620200332134861.jpg', 
    'imagem-200620200332137057.jpg',
    1,
    1, 
    'Guitarras', 
    1, 
    'Ibanez', 
    1, 
    'Super Strato',
    1, 
    'Vinícius Lessa'   
  );



/************************************************************************************************/

--
-- Índices para tabela `cliente`
--
ALTER TABLE `cliente`
  ADD PRIMARY KEY (`cod_cliente`);

--
-- Índices para tabela `comentario`
--
ALTER TABLE `comentario`
  ADD PRIMARY KEY (`cod_comentario`),
  ADD KEY `FK_comentario_cliente` (`cod_cliente`),
  ADD KEY `FK_comentario_anuncio` (`cod_anuncio`);

--
-- Índices para tabela `favorito`
--
ALTER TABLE `favorito`
  ADD PRIMARY KEY (`cod_favorito`),
  ADD KEY `FK_favoritoo_cliente` (`cod_cliente`),
  ADD KEY `FK_favoritoo_anuncio` (`cod_anuncio`);

--
-- Índices para tabela `pedido`
--
ALTER TABLE `pedido`
  ADD PRIMARY KEY (`cod_pedido`),
  ADD KEY `FK_pedido_cliente` (`cod_cliente`);

--
-- Índices para tabela `pedido_item`
--
ALTER TABLE `pedido_item`
  ADD KEY `FK_pedidoitem_pedido` (`cod_pedido`),
  ADD KEY `FK_pedidoitem_anuncio` (`cod_anuncio`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `cliente`
--
ALTER TABLE `cliente`
  MODIFY `cod_cliente` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de tabela `comentario`
--
ALTER TABLE `comentario`
  MODIFY `cod_comentario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de tabela `favorito`
--
ALTER TABLE `favorito`
  MODIFY `cod_favorito` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de tabela `pedido`
--
ALTER TABLE `pedido`
  MODIFY `cod_pedido` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT de tabela `anuncios`
--
ALTER TABLE `anuncios`
  MODIFY `cod_anuncio` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de tabela `usuario`
--
ALTER TABLE `usuario`
  MODIFY `cod_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Restrições para despejos de tabelas
--

--
-- Limitadores para a tabela `comentario`
--
ALTER TABLE `comentario`
  ADD CONSTRAINT `FK_comentario_cliente` FOREIGN KEY (`cod_cliente`) REFERENCES `cliente` (`cod_cliente`),
  ADD CONSTRAINT `FK_comentario_anuncio` FOREIGN KEY (`cod_anuncio`) REFERENCES `anuncios` (`cod_anuncio`);

--
-- Limitadores para a tabela `favorito`
--
ALTER TABLE `favorito`
  ADD CONSTRAINT `FK_favoritoo_cliente` FOREIGN KEY (`cod_cliente`) REFERENCES `cliente` (`cod_cliente`),
  ADD CONSTRAINT `FK_favoritoo_anuncio` FOREIGN KEY (`cod_anuncio`) REFERENCES `anuncios` (`cod_anuncio`);

--
-- Limitadores para a tabela `pedido`
--
ALTER TABLE `pedido`
  ADD CONSTRAINT `FK_pedido_cliente` FOREIGN KEY (`cod_cliente`) REFERENCES `cliente` (`cod_cliente`);

--
-- Limitadores para a tabela `pedido_item`
--
ALTER TABLE `pedido_item`
  ADD CONSTRAINT `FK_pedidoitem_pedido` FOREIGN KEY (`cod_pedido`) REFERENCES `pedido` (`cod_pedido`),
  ADD CONSTRAINT `FK_pedidoitem_anuncio` FOREIGN KEY (`cod_anuncio`) REFERENCES `anuncios` (`cod_anuncio`);
COMMIT;

