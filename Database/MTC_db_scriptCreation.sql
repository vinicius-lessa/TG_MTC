/** 
* @description  SCRIP Oficial da criação do Banco de dados do projeto MTC (Musci Trade Center) e suas propriedades.
* @changeLog
*   2022/03/03 - Vinícius Lessa: Inserção das primeiras instruções.
*   2022/03/22 - Vinícius Lessa: Ajustes e melhorias na tabela `users`
*   2022/03/23 - Vinícius Lessa: Inserção do Script para a criação e estruturação das tabelas `TradePosts`, `ProductConditions`, `Category`, `Models` , `Colors`
*
*/

-- #######################


-- ## 1º - Criar Banco de Dados
CREATE DATABASE dbtg2022
DEFAULT CHARACTER SET utf8
DEFAULT COLLATE utf8mb4_unicode_ci;


-- ## 2º - Criar tabela 'users', referente aos usuários do sistema
DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users`
(
    `user_id`         int(11) NOT NULL auto_increment       ,
    `user_name`       varchar(50) NOT NULL                  ,
    `birthday`        date NOT NULL                         , -- 'YYYY-MM-DD'
    `phone`           varchar(15) DEFAULT NULL              ,
    `tipo_pessoa`     enum( 'F','J' ) NOT NULL DEFAULT 'F'  ,
    `email`           varchar(50) NOT NULL UNIQUE           ,
    `cpf_cnpj`        varchar(14) DEFAULT NULL UNIQUE       ,
    `cep`             varchar(8) DEFAULT NULL               ,
    -- `city`            varchar(50) DEFAULT NULL ,
    -- `district`        varchar(50) DEFAULT NULL ,
    `bio`             text(250) DEFAULT NULL                ,
    `activity_status` boolean NOT NULL DEFAULT 1            , -- 0 is false, 1 is true
    `password`        varchar(255) NOT NULL                 ,
    `created_on`      timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `modified_on`     timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    CONSTRAINT PK_users PRIMARY KEY (user_id);
) ENGINE=InnoDB DEFAULT CHARSET = utf8;


-- ## 3º - Show info about USERS Table
DESCRIBE `users`;


-- ## 4º Inserting Data into the USERS Table
INSERT INTO `users`
(	
  `user_name`, `birthday`, `phone`, `tipo_pessoa`, `email`, `cpf_cnpj`, `cep`, `bio`, `activity_status`, `password` 
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
    '46269889899',
    '18147000',
    'Tentei tocar um pouco de violão, mas FRACASSEI duas vezes',
    true,
	'$2y$10$dPxmh5OM5vULhzJ9ukd3r.DJ9275YEng7u.iQrHRYd.WY0eCkBoRu'
);

-- ## 5º - Criar tabela `product_categorys`, referente a CATEGORIA de produtos
DROP TABLE IF EXISTS `product_categorys`;
CREATE TABLE IF NOT EXISTS `product_categorys`
(
  `category_id`           int(11)       NOT NULL auto_increment ,
  `description`           varchar(50)   NOT NULL UNIQUE         ,
  `activity_status`       boolean NOT NULL DEFAULT 1 			      , -- 0 is false, 1 is true
  `created_on`            timestamp     NOT NULL DEFAULT CURRENT_TIMESTAMP,  
  `modified_on`           timestamp     NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  CONSTRAINT PK_product_categorys PRIMARY KEY (category_id)
) ENGINE=InnoDB DEFAULT CHARSET = utf8;

-- ## 6º - Insere Dados na tabela `product_categorys`
INSERT INTO `product_categorys` 
( `description`, `activity_status` )
VALUES
( 'Guitarras'             , true	) ,
( 'Violões'               , true	) ,
( 'Contrabaixos'          , true	) ,
( 'Baterias'              , true  ) ,
( 'Amplificadores'        , true  ) ,
( 'Mesas de Som'          , true  ) ,
( 'Microfones'            , true  ) ,
( 'Cabos e Adaptadores'   , true  ) ,
( 'Baixolões'             , true  ) ,
( 'Capas e Cases'         , true  ) ,
( 'Interfaces de Som'     , true  ) ,
( 'Pedaleiras'            , true  ) ,
( 'Instrumentos de Sopro' , true  ) ;


-- ## 7º - Criar tabela `product_brands`, referente as MARCAS de produtos
DROP TABLE IF EXISTS `product_brands`;
CREATE TABLE IF NOT EXISTS `product_brands`
(
  `brand_id`              int(11)       NOT NULL auto_increment ,
  `description`           varchar(50)   NOT NULL UNIQUE         ,  
  `activity_status`       boolean NOT NULL DEFAULT 1            , -- 0 is false, 1 is true
  `created_on`            timestamp     NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified_on`           timestamp     NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  CONSTRAINT PK_product_brands PRIMARY KEY (brand_id)  
) ENGINE=InnoDB DEFAULT CHARSET = utf8;


-- ## 8º - Insere Dados na tabela `product_brands`
INSERT INTO `product_brands`
( `description` , `activity_status` )
VALUES
( 'Ibanez'    , true ) ,
( 'Michael'   , true ) ,
( 'Dean'      , true ) ,
( 'Tagima'    , true ) ,
( 'Strinberg' , true ) ,
( 'Pearl'     , true ) ,
( 'Ludwig'    , true ) ,
( 'Mapex'     , true ) ,
( 'Shelter'   , true ) ,
( 'Woodwinds' , true ) ,
( 'SML'       , true ) ,
( 'Shure'     , true ) ,
( 'Sennheiser', true ) ,
( 'Lyco'      , true ) ,
( 'Behringer' , true ) ;


-- ## 9º - Criar tabela `categorys_x_brands`, referente a relação de N para N de Categoria de Produtos e Marcas
DROP TABLE IF EXISTS `categorys_x_brands`;
CREATE TABLE IF NOT EXISTS `categorys_x_brands`
(
  `relation_id`           int(11)       NOT NULL auto_increment ,
  `category_id`           int(11)       NOT NULL                ,
  `brand_id`              int(11)       NOT NULL                ,  
  `description`           varchar(50)   NOT NULL                ,
  `activity_status`       boolean NOT NULL DEFAULT 1            , -- 0 is false, 1 is true
  `created_on`            timestamp     NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified_on`           timestamp     NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  CONSTRAINT PK_categorys_x_brands PRIMARY KEY (relation_id),
  CONSTRAINT FK_product_categorys FOREIGN KEY (category_id) REFERENCES product_categorys(category_id),
  CONSTRAINT FK_product_brands FOREIGN KEY (brand_id) REFERENCES product_brands(brand_id),
) ENGINE=InnoDB DEFAULT CHARSET = utf8;


-- ## 10º - Insere Dados na tabela `categorys_x_brands`
INSERT INTO `categorys_x_brands`
( `category_id`, `brand_id`, `description`, `activity_status` )
VALUES
( '1' , '1', (SELECT CONCAT(pc.description,' x ',pb.description) from product_categorys pc, product_brands pb where pc.category_id = '1' and pb.brand_id = '1'), true ) ,
( '1' , '2', (SELECT CONCAT(pc.description,' x ',pb.description) from product_categorys pc, product_brands pb where pc.category_id = '1' and pb.brand_id = '2'), true ) ,
( '1' , '3', (SELECT CONCAT(pc.description,' x ',pb.description) from product_categorys pc, product_brands pb where pc.category_id = '1' and pb.brand_id = '3'), true ) ,
( '1' , '4', (SELECT CONCAT(pc.description,' x ',pb.description) from product_categorys pc, product_brands pb where pc.category_id = '1' and pb.brand_id = '4'), true ) ,
( '1' , '5', (SELECT CONCAT(pc.description,' x ',pb.description) from product_categorys pc, product_brands pb where pc.category_id = '1' and pb.brand_id = '5'), true ) ,
( '4' , '6', (SELECT CONCAT(pc.description,' x ',pb.description) from product_categorys pc, product_brands pb where pc.category_id = '4' and pb.brand_id = '6'), true ) ,
( '4' , '7', (SELECT CONCAT(pc.description,' x ',pb.description) from product_categorys pc, product_brands pb where pc.category_id = '4' and pb.brand_id = '7'), true ) ,
( '4' , '8', (SELECT CONCAT(pc.description,' x ',pb.description) from product_categorys pc, product_brands pb where pc.category_id = '4' and pb.brand_id = '8'), true ) ,
( '13' , '9', (SELECT CONCAT(pc.description,' x ',pb.description) from product_categorys pc, product_brands pb where pc.category_id = '13' and pb.brand_id = '9'), true ) ,
( '13' , '10', (SELECT CONCAT(pc.description,' x ',pb.description) from product_categorys pc, product_brands pb where pc.category_id = '13' and pb.brand_id = '10'), true ) ,
( '13' , '11', (SELECT CONCAT(pc.description,' x ',pb.description) from product_categorys pc, product_brands pb where pc.category_id = '13' and pb.brand_id = '11'), true ) ,
( '7' , '12', (SELECT CONCAT(pc.description,' x ',pb.description) from product_categorys pc, product_brands pb where pc.category_id = '7' and pb.brand_id = '12'), true ) ,
( '7' , '13', (SELECT CONCAT(pc.description,' x ',pb.description) from product_categorys pc, product_brands pb where pc.category_id = '7' and pb.brand_id = '13'), true ) ,
( '7' , '14', (SELECT CONCAT(pc.description,' x ',pb.description) from product_categorys pc, product_brands pb where pc.category_id = '7' and pb.brand_id = '14'), true ) ,
( '7' , '15', (SELECT CONCAT(pc.description,' x ',pb.description) from product_categorys pc, product_brands pb where pc.category_id = '7' and pb.brand_id = '15'), true ) ,
( '11' , '15', (SELECT CONCAT(pc.description,' x ',pb.description) from product_categorys pc, product_brands pb where pc.category_id = '11' and pb.brand_id = '15'), true ) ,
( '1' , '16', (SELECT CONCAT(pc.description,' x ',pb.description) from product_categorys pc, product_brands pb where pc.category_id = '1' and pb.brand_id = '16'), true ) ,
( '1' , '17', (SELECT CONCAT(pc.description,' x ',pb.description) from product_categorys pc, product_brands pb where pc.category_id = '1' and pb.brand_id = '17'), true ) ;


-- ## 11º - Criar tabela `product_models`, referente ao Modelo de produtos
DROP TABLE IF EXISTS `product_models`;
CREATE TABLE IF NOT EXISTS `product_models`
(
  `model_id`              int(11)       NOT NULL auto_increment ,
  `description`           varchar(50)   NOT NULL UNIQUE         ,
  `brand_id`              int(11)       NOT NULL                ,
  `activity_status`       boolean NOT NULL DEFAULT 1            , -- 0 is false, 1 is true
  `created_on`            timestamp     NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified_on`           timestamp     NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  CONSTRAINT PK_product_models PRIMARY KEY (model_id) ,
  CONSTRAINT FK_brand_model FOREIGN KEY (brand_id) REFERENCES product_brands(brand_id)
) ENGINE=InnoDB DEFAULT CHARSET = utf8;

-- ## 12º - Insere Dados na tabela `product_models`
INSERT INTO `product_models`
( `description`, `brand_id`, `activity_status` )
VALUES
( 'Aad170ce'              , '1', true	) ,
( 'Tube Screamer Ts9'     , '1', true	) ,
( 'Rg470mbafm'            , '1', true	) ,
( 'Ts808 Dx'              , '1', true  ) ,
( 'Es 3 Echo Shifter'     , '1', true  ) ,
( 'Rg420hpfm'             , '1', true  ) ,
( 'Mahogany Series'       , '7', true  ) ,
( 'Legacy Maple Series'   , '7', true  ) ,
( 'Vistalite Series'      , '7', true  ) ,
( 'NeuSonic Series'       , '7', true  ) ,
( 'Classic Maple Series'  , '7', true  ) ;


-- ## 13º - Criar tabela `product_conditions`, referente as Condições do Produtos no anúncio
DROP TABLE IF EXISTS `product_conditions`;
CREATE TABLE IF NOT EXISTS `product_conditions`
(
  `condition_id`          int(11)       NOT NULL auto_increment ,
  `description`           varchar(50)   NOT NULL UNIQUE         ,
  `activity_status`       boolean       NOT NULL DEFAULT 1      , -- 0 is false, 1 is true
  `created_on`            timestamp     NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified_on`           timestamp     NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  CONSTRAINT PK_product_conditions PRIMARY KEY (condition_id)
) ENGINE=InnoDB DEFAULT CHARSET = utf8;

-- ## 14º - Insere Dados na tabela `product_conditions`
INSERT INTO `product_conditions`
( `description`, `activity_status` )
VALUES
( 'Produto Novo'                      , true	) ,
( 'Usado, estado de Novo'             , true	) ,
( 'Usado, com detalhes'               , true	) ,
( 'Para restauração/reaproveitamento' , true  ) ;


-- ## 15º - Criar tabela `colors`, referente as cores utilizadas no sistema em geral
DROP TABLE IF EXISTS `colors`;
CREATE TABLE IF NOT EXISTS `colors`
(
  `color_id`              int(11)       NOT NULL auto_increment ,
  `description`           varchar(50)   NOT NULL UNIQUE         ,
  `activity_status`       boolean       NOT NULL DEFAULT 1      , -- 0 is false, 1 is true
  `created_on`            timestamp     NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified_on`           timestamp     NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  CONSTRAINT PK_colors PRIMARY KEY (color_id)
) ENGINE=InnoDB DEFAULT CHARSET = utf8;

-- ## 16º - Insere Dados na tabela `colors`
INSERT INTO `colors`
( `description`, `activity_status` )
VALUES
( 'Vermelho'  , true	) ,
( 'Azul'      , true	) ,
( 'Preto'     , true	) ,
( 'Cinza'     , true  ) ,
( 'Roxo'      , true  ) ,
( 'Amarelo'   , true  ) ,
( 'Laranja'   , true  ) ,
( 'Outras'    , true  ) ;


-- ## 17º - Criar tabela `trade_posts`, referente aos ANÚNCIOS de produtos
DROP TABLE IF EXISTS `trade_posts`;
CREATE TABLE IF NOT EXISTS `trade_posts`
(
  `post_id`               int(11)       NOT NULL auto_increment ,
  `title`                 varchar(50)   NOT NULL                ,
  `description`           text(500)     DEFAULT NULL            ,
  `category_id`           int(11)       NOT NULL                ,
  -- `category_description`  varchar(50)   NOT NULL                ,
  `brand_id` 	            int(11)	      NOT NULL                ,
  -- `brand_description`	    varchar(50)	  DEFAULT NULL            ,
  `model_id`              int(11)       NOT NULL                ,
  -- `model_description`     varchar(50)   DEFAULT NULL            ,
  `color_id`              int(11)       NOT NULL                ,
  -- `color_description`     varchar(50)   DEFAULT NULL            ,
  `condition_id`          int(11)       NOT NULL                ,
  -- `condition_description` varchar(50)   DEFAULT NULL            ,
  `user_id`               int(11)       NOT NULL                ,
  -- `user_name`             varchar(50)   NOT NULL                ,  
  `price`                 decimal(7,2)  UNSIGNED NOT NULL       , 
  `eletronic_invoice`     boolean       NOT NULL DEFAULT 1      , -- 0 is false, 1 is true  
  `activity_status`       boolean       NOT NULL DEFAULT 1      , -- 0 is false, 1 is true
  `created_on`            timestamp     NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified_on`           timestamp     NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  CONSTRAINT PK_trade_posts     PRIMARY KEY (post_id) ,
  CONSTRAINT FK_categorys_posts FOREIGN KEY (category_id) REFERENCES product_categorys(category_id) ,
  CONSTRAINT FK_brands_posts    FOREIGN KEY (brand_id) REFERENCES product_brands(brand_id) ,  
  CONSTRAINT FK_models_posts    FOREIGN KEY (model_id) REFERENCES product_models(model_id) ,
  CONSTRAINT FK_colors_posts    FOREIGN KEY (color_id) REFERENCES colors(color_id) ,
  CONSTRAINT FK_conditions_post FOREIGN KEY (condition_id) REFERENCES product_conditions(condition_id) ,
  CONSTRAINT FK_users_posts     FOREIGN KEY (user_id) REFERENCES users(user_id)
) ENGINE=InnoDB DEFAULT CHARSET = utf8;

-- ## 18º - Insere Dados na tabela `trade_posts`
INSERT INTO `trade_posts`
( `title`, `description`, `category_id`, `brand_id`, `model_id`, `color_id`, `condition_id`, `user_id`, `price`, `eletronic_invoice`, `activity_status` )
VALUES
( 'Guitarra Ibanez', 'Vendo minha guitarra Ibanez usada, tenho ela há 8 anos aproxiamadamente.', '2', '2', '2', '2', '2', '1', '1500.50', true, DEFAULT ) ;


-- ## 19º - Criar tabela `images`, referente as IMAGENS utilizadas no site
DROP TABLE IF EXISTS `images`;
CREATE TABLE IF NOT EXISTS `images`
(
  `image_id`              int(11)       NOT NULL auto_increment ,
  `name`                  varchar(255)  NOT NULL                ,
  `img_directory`         varchar(255)  NOT NULL                ,
  `created_on`            timestamp     NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified_on`           timestamp     NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  CONSTRAINT PK_images PRIMARY KEY (image_id)
  -- CONSTRAINT FK_categorys_posts FOREIGN KEY (category_id) REFERENCES product_categorys(category_id)
) ENGINE=InnoDB DEFAULT CHARSET = utf8;



-- ####################################################################################################################### ANALISAR

--
-- Estrutura da tabela `comentario`
--

CREATE TABLE IF NOT EXISTS `comentario` (
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



/************************************************************************************************/


--
-- Índices para tabela `favorito`
--
ALTER TABLE `favorito`
  ADD PRIMARY KEY (`cod_favorito`),
  ADD KEY `FK_favoritoo_cliente` (`cod_cliente`),
  ADD KEY `FK_favoritoo_anuncio` (`cod_anuncio`);



--
-- AUTO_INCREMENT de tabela `favorito`
--
ALTER TABLE `favorito`
  MODIFY `cod_favorito` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;



-- Limitadores para a tabela `favorito`
--
ALTER TABLE `favorito`
  ADD CONSTRAINT `FK_favoritoo_cliente` FOREIGN KEY (`cod_cliente`) REFERENCES `cliente` (`cod_cliente`),
  ADD CONSTRAINT `FK_favoritoo_anuncio` FOREIGN KEY (`cod_anuncio`) REFERENCES `anuncios` (`cod_anuncio`);