/** 
* @description  SCRIP Oficial da criação do Banco de dados do projeto MTC (Musci Trade Center) e suas propriedades.
* @changeLog
*   2022/03/03 - Vinícius Lessa: Inserção das primeiras instruções.
*   2022/03/22 - Vinícius Lessa: Ajustes e melhorias na tabela `users`
*   2022/03/23 - Vinícius Lessa: Inserção do Script para a criação e estruturação das tabelas `TradePosts`, `ProductConditions`, `Category`, `Models` , `Colors`
*   2022/04/16 - Vinícius Lessa: Inserção da tabela 'images_trade_posts', suas colunas, constraits e Insert
*   2022/04/29 - Vinícius Lessa: Inserção da tabela 'category_brand', suas colunas, constraits e Insert
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
    CONSTRAINT PK_users PRIMARY KEY (user_id)
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
( 'Guitarras' , true	) ,
( 'Baterias' , true	) ,
( 'Violões' , true	) ,
( 'Contrabaixos' , true	) ,
( 'Baixolões' , true	) ,
( 'Teclados/Pianos' , true	) ,
( 'Amplificadores/Caixas' , true	) ,
( 'Mesas de Som' , true	) ,
( 'Acessórios/Equipamentos' , true	) ,
( 'Interface de Áudio' , true	) ,
( 'Microfones' , true	) ,
( 'Cabos e Adaptadores' , true	) ,
( 'Capas e Cases' , true	) ,
( 'Pedais/Pedaleiras' , true	) ,
( 'Instrumentos de Sopro' , true	) ,
( 'Serviço - Loja' , true	) ,
( 'Serviço - Banda' , true	) ,
( 'Serviço - Aulas' , true	) ,
( 'Serviço - Manutenção' , true	) ,
( 'Outra Categoria' , true  ) ;


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
( 'Ibanez' , true ) ,
( 'Dean' , true ) ,
( 'Tagima' , true ) ,
( 'Strinberg' , true ) ,
( 'Fender' , true ) ,
( 'Gibson' , true ) ,
( 'Pearl' , true ) ,
( 'Ludwig' , true ) ,
( 'Mapex' , true ) ,
( 'Shelter' , true ) ,
( 'Krest' , true ) ,
( 'Giannini' , true ) ,
( 'Condor' , true ) ,
( 'Phoenix' , true ) ,
( 'Eagle' , true ) ,
( 'Casio' , true ) ,
( 'Yamaha' , true ) ,
( 'Dexibell' , true ) ,
( 'Borne' , true ) ,
( 'Line 6' , true ) ,
( 'Randall' , true ) ,
( 'Edifier' , true ) ,
( 'Orange' , true ) ,
( 'Vox' , true ) ,
( 'Behringer' , true ) ,
( 'Lelong' , true ) ,
( 'Wattsom' , true ) ,
( 'Oneal' , true ) ,
( 'Sennheiser' , true ) ,
( 'Focusrite' , true ) ,
( 'Presonus' , true ) ,
( 'SML' , true ) ,
( 'Shure' , true ) ,
( 'Lyco' , true ) ,
( 'MXT' , true ) ,
( 'Panther' , true ) ,
( 'Hayonik' , true ) ,
( 'Santo Angelo' , true ) ,
( 'Boss' , true ) ,
( 'Zoom' , true ) ,
( 'MXR' , true ) ,
( 'Woodwinds' , true ) ,
( 'Outra Marca' , true ) ;


-- ## 9º - Criar tabela `category_brand`, referente a relação entre Múltiplas CATEGORIAS e Multiplas MARCAS
DROP TABLE IF EXISTS `category_brand`;
CREATE TABLE IF NOT EXISTS `category_brand`
(
  `category_brand_category_id`  int(11)       NOT NULL                ,
  `category_brand_brand_id`     int(11)       NOT NULL                ,  
  `activity_status`             boolean       NOT NULL DEFAULT 1      , -- 0 is false, 1 is true
  `created_on`                  timestamp     NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified_on`                 timestamp     NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  CONSTRAINT FK_product_categorys_category_brand  FOREIGN KEY (category_brand_category_id) REFERENCES product_categorys(category_id) ,
  CONSTRAINT FK_product_brands_category_brand     FOREIGN KEY (category_brand_brand_id) REFERENCES product_brands(brand_id)
) ENGINE=InnoDB DEFAULT CHARSET = utf8;

-- ## 10º - Insere Dados na tabela `category_brand`
INSERT INTO `category_brand`
( `category_brand_category_id` , `category_brand_brand_id` )
VALUES
-- Guitarras
( 44 , 944 ) , ( 44 , 954 ) , ( 44 , 964 ) , ( 44 , 974 ) ,	( 44 , 984 ) , ( 44 , 934 ) ,	( 44 , 1354 ) ,
-- Baterias
( 54 , 994 ) , ( 54 , 1004 ) , ( 54 , 1014 ) , ( 54 , 1024 ) , ( 54 , 1034 ) , ( 54 , 1354 ) ,
-- Violões
( 64	, 954	) , ( 64	, 964	) , ( 64	, 974	) , ( 64	, 1044	) , ( 64	, 1354	) ,
-- Contrabaixos
( 74	, 954 ) , ( 74	, 964 ) , ( 74	, 974 ) , ( 74	, 1054 ) , ( 74	, 1354 ) ,
-- Baixolões
( 84 , 964 ) , ( 84 , 954 ) , ( 84 , 1064 ) , ( 84 , 1054 ) , ( 84 , 1074 ) , ( 84 , 1354 ) ,
-- Teclados/Pianos
( 94 , 1084 ) , ( 94 , 1094 ) , ( 94 , 1104 ) , ( 94 , 1354 ) ,
-- Amplificadores/Caixas
( 104 , 1114 ) , ( 104 , 1124 ) , ( 104 , 1134 ) , ( 104 , 1144 ) , ( 104 , 1154 ) , ( 104 , 1164 ) , ( 104 , 1354 ) ,
-- Mesas de Som
( 114 ,	1174 ) , ( 114 ,	1184 ) , ( 114 ,	1194 ) , ( 114 ,	1204 ) , ( 114 ,	1354 ) ,
-- Acessórios/Equipamentos
( 124 ,	1214 ) , ( 124 ,	1144 ) , ( 124 ,	1174 ) , ( 124 ,	1354 ) ,
-- Interface de Áudio
( 134 ,	1174 ) , ( 134 ,	1224 ) , ( 134 ,	1234 ) , ( 134 ,	1354 ) ,
-- Microfones
( 144 ,	1244 ) , ( 144 ,	1254 ) , ( 144 ,	1264 ) , ( 144 ,	1274 ) , ( 144 ,	1354 ) , ( 144 ,	1214 ) , ( 144 ,	1174 ) 
-- Cabos e Adaptadores
( 154 ,	1164 ) , ( 154 ,	1284 ) , ( 154 ,	1294 ) , ( 154 ,	1304 ) , ( 154 ,	1274 ) , ( 154 ,	1354 ) ,
-- Capas e Cases
( 164 ,	1354 ) ,
-- Pedais/Pedaleiras
( 174 ,	1314 ) , ( 174 ,	1324 ) , ( 174 ,	1334 ) , ( 174 ,	1124 ) , ( 174 ,	1354 ) , 
-- Instrumentos de Sopro
( 184 ,	1024 ) , ( 184 ,	1344 ) , ( 184 ,	1354 ) ,
-- Serviço - Loja
( 194 ,	1354 ) , 
-- Serviço - Banda
( 204 ,	1354 ) ,
-- Serviço - Aulas
( 214	, 1354 ) ,
-- Serviço - Manutenção
( 224 ,	1354 ) ,
-- Outra Categoria
( 234	, 1354 ) ;



-- ## 11º - Criar tabela `product_models`, referente ao Modelo de produtos
DROP TABLE IF EXISTS `product_models`;
CREATE TABLE IF NOT EXISTS `product_models`
(
  `model_id`              int(11)       NOT NULL auto_increment ,
  `description`           varchar(50)   NOT NULL UNIQUE         ,
  `category_id`              int(11)       NOT NULL             ,
  `brand_id`              int(11)       NOT NULL                ,  
  `activity_status`       boolean NOT NULL DEFAULT 1            , -- 0 is false, 1 is true
  `created_on`            timestamp     NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified_on`           timestamp     NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  CONSTRAINT PK_product_models PRIMARY KEY (model_id) ,
  CONSTRAINT FK_brand_model FOREIGN KEY (brand_id) REFERENCES product_brands(brand_id) ,
  CONSTRAINT FK_category_model FOREIGN KEY (category_id) REFERENCES product_categorys(category_id_id)
) ENGINE=InnoDB DEFAULT CHARSET = utf8;

-- ## 12º - Insere Dados na tabela `product_models`
INSERT INTO `product_models`
( `description`, `category_id`, `brand_id`, `activity_status` )
VALUES
-- GUITARRAS
-- Dean
( 'ML' , 44 , 944 , true ) ,
( 'Cadillac' , 44 , 944 , true ) ,
( 'EVO' , 44 , 944 , true ) ,
-- Tagima
( 'T-900' , 44 , 954 , true ) ,
( 'T-550' , 44 , 954 , true ) ,
( 'STELLA NTM' , 44 , 954 , true ) ,
( 'MG-30' , 44 , 954 , true ) ,
( 'TW-55' , 44 , 954 , true ) ,
-- Strinberg
( 'LPS230' , 44 , 964 , true ) ,
( 'CLG 24' , 44 , 964 , true ) ,
-- Fender
( 'Telecaster' , 44 , 974 , true ) ,
( 'Stratocaster' , 44 , 974 , true ) ,
( 'Contemporary' , 44 , 974 , true ) ,
-- Gibson
( 'Les Paul' , 44 , 984 , true ) ,
( 'SG' , 44 , 984 , true ) ,
( 'Axcess' , 44 , 984 , true ) ,
( 'Flying V' , 44 , 984 , true ) ,
( 'Zakk Wylde' , 44 , 984 , true ) ,
-- Ibanez
( 'GIO Series' , 44 , 934 , true ) ,
( 'RG Series' , 44 , 934 , true ) ,

-- BATERIAS
-- Pearl
( 'Decade Maple' , 54 , 994 , true ) ,
( 'Session Select' , 54 , 994 , true ) ,
( 'Midtown Series' , 54 , 994 , true ) ,
( 'Export' , 54 , 994 , true ) ,
-- Ludwig
( 'Rocker' , 54 , 1004 , true ) ,
( 'Breakbeats' , 54 , 1004 , true ) ,
( 'Vintage' , 54 , 1004 , true ) ,
( 'Accent' , 54 , 1004 , true ) ,
( 'Club Date' , 54 , 1004 , true ) ,
-- Mapex
( 'Saturn Series' , 54 , 1014 , true ) , 
( 'Voyager' , 54 , 1014 , true ) , 
( 'VX Series' , 54 , 1014 , true ) , 
( 'Mars Series' , 54 , 1014 , true ) , 
( 'Venus Seies' , 54 , 1014 , true ) ,
-- Shelter
( 'STD 36' , 54 , 1024 , true ) ,
( 'STD 82' , 54 , 1024 , true ) ,
-- Krest
( 'Fusion' , 54 , 1034 , true ) ,
( 'Brilliant' , 54 , 1034 , true ) ,
( 'Rustic' , 54 , 1034 , true ) ,

-- VIOLÕES
-- Tagima
( 'Paraty' , 64 , 954 , true ) ,
( 'Maragogi' , 64 , 954 , true ) ,
( 'Dallas' , 64 , 954 , true ) ,
( 'Kansas' , 64 , 954 , true ) ,
( 'California' , 64 , 954 , true ) ,				
-- Strinberg
( 'ANS95C' , 64 , 964 , true ) ,
( 'ASF 62' , 64 , 964 , true ) ,
( 'DE50SC' , 64 , 964 , true ) ,
( 'AW51C' , 64 , 964 , true ) ,
( 'SC200' , 64 , 964 , true ) ,
( 'SA200' , 64 , 964 , true ) ,				
-- Fender
( 'FA-100' , 64 , 974 , true ) ,
( 'FA-115' , 64 , 974 , true ) ,
( 'CD60' , 64 , 974 , true ) ,
( 'CD140' , 64 , 974 , true ) ,
-- Giannini
( 'Start' , 64 , 1044 , true ) ,
( 'Performance' , 64 , 1044 , true ) ,
( 'GN-15' , 64 , 1044 , true ) ,
( 'GSX-15' , 64 , 1044 , true ) ,

-- CONTRABAIXOS
-- Tagima
( 'Fusion' , 74 , 954 , true ) ,
( 'TJB-535' , 74 , 954 , true ) ,
( 'TJB-4' , 74 , 954 , true ) ,
( 'TBM-5' , 74 , 954 , true ) ,
( 'XB-21 6' , 74 , 954 , true ) ,				
-- Strinberg
( 'Precision' , 74 , 964 , true ) ,
( 'CLB 25A' , 74 , 964 , true ) ,
( 'PBS40' , 74 , 964 , true ) ,				
-- Fender
( 'Southern Cross' , 74 , 974 , true ) ,
( 'Affinity' , 74 , 974 , true ) ,
( 'Aerodyne' , 74 , 974 , true ) ,
( 'American Deluxe' , 74 , 974 , true ) ,
-- Condor
( 'BX12' , 74 , 1054 , true ) ,
( 'XB224' , 74 , 1054 , true ) ,
( 'XB25' , 74 , 1054 , true ) ,
( 'XB26A' , 74 , 1054 , true ) ,
( 'FA5FDB' , 74 , 1054 , true ) ,		

-- BAIXOLÕES
-- Tagima
( 'AB-400' , 84 , 954 , true ) ,
( 'AC-400' , 84 , 954 , true ) ,		
-- Strinberg
( 'BA550' , 84 , 964 , true ) ,
( 'SB240' , 84 , 964 , true ) ,
( 'SB250' , 84 , 964 , true ) ,
-- Phoenix
( 'WJB160' , 84 , 1064 , true ) ,
( 'WJB162' , 84 , 1064 , true ) ,				
-- Condor
( 'CB106' , 84 , 1054 , true ) ,				
-- Eagle
( '90 AEB' , 84 , 1074 , true ) ,		

-- TECLADOS/PIANOS
-- Casio
( 'CT-X3000' , 94 , 1084 , true ) ,
( 'CTK-3500' , 94 , 1084 , true ) ,
( 'LK-S250' , 94 , 1084 , true ) ,
( 'CT-S300' , 94 , 1084 , true ) ,
( 'CT-S200' , 94 , 1084 , true ) ,
( 'WK-7600' , 94 , 1084 , true ) ,				
-- Yamaha
( 'PSR-E353' , 94 , 1094 , true ) ,
( 'PSR-185' , 94 , 1094 , true ) ,
( 'PSR-E463' , 94 , 1094 , true ) ,
( 'PSR-E443' , 94 , 1094 , true ) ,
( 'DGX-530' , 94 , 1094 , true ) ,				
-- Dexibell
( 'VIVO S1' , 94 , 1104 , true ) ,
( 'VIVO S3 PRO' , 94 , 1104 , true ) ,
( 'VIVO S7 PRO' , 94 , 1104 , true ) ,
( 'VIVO S9' , 94 , 1104 , true ) ,
( 'VIVO H10' , 94 , 1104 , true ) ,
( 'VIVO H5' , 94 , 1104 , true ) ,
( 'VIVO H1' , 94 , 1104 , true ) ,
( 'COMBO J7' , 94 , 1104 , true ) ,

-- AMPLIFICADORES/CAIXAS
-- Borne
( 'STRIKE G30' , 104 , 1114 , true ) ,
( 'BASS CB60' , 104 , 1114 , true ) ,
( 'BASS CB 80' , 104 , 1114 , true ) ,
( 'GB400' , 104 , 1114 , true ) ,
( 'MOB T30' , 104 , 1114 , true ) ,
( 'VORAX 1050' , 104 , 1114 , true ) ,
-- Line 6
( 'Spider' , 104 , 1124 , true ) ,
( 'Dime' , 104 , 1124 , true ) ,
-- Randall
( 'RG-1503' , 104 , 1134 , true ) ,
( 'RD-45' , 104 , 1134 , true ) ,
( 'RX-120' , 104 , 1134 , true ) ,
( 'Big Dog' , 104 , 1134 , true ) ,
( 'RH-150' , 104 , 1134 , true ) ,
-- Edifier
( 'R1000T4' , 104 , 1144 , true ) ,
( 'G2000' , 104 , 1144 , true ) ,
( 'R33BT' , 104 , 1144 , true ) ,				
-- Orange
( 'V30' , 104 , 1154 , true ) ,
( 'Micro Terror' , 104 , 1154 , true ) ,
( 'Micro Dark' , 104 , 1154 , true ) ,
( 'Jim Root' , 104 , 1154 , true ) ,
( 'Crush 20' , 104 , 1154 , true ) ,
( 'Crush 12' , 104 , 1154 , true ) ,
( 'PPC 112' , 104 , 1154 , true ) ,
-- Vox
( 'AmPlug2' , 104 , 1164 , true ) ,
( 'VC-D360' , 104 , 1164 , true ) ,
( 'Storm' , 104 , 1164 , true ) ,
( 'Pathfinder' , 104 , 1164 , true ) ,

-- MESAS DE SOM
-- Behringer
( 'XENYX 2442 FX1' , 114 , 1174 , true ) ,
( 'XENYX 2104 FX' , 114 , 1174 , true ) ,
( 'XENYX 2222' , 114 , 1174 , true ) ,
( 'XENYX 1202' , 114 , 1174 , true ) ,
( 'Eurodesk SX3242' , 114 , 1174 , true ) ,
( 'Eurorack MX 2642' , 114 , 1174 , true ) ,

-- Lelong
( 'LE-709' , 114 , 1184 , true ) ,
( 'LE-708' , 114 , 1184 , true ) ,
( 'LE-716' , 114 , 1184 , true ) ,
( 'LE-710' , 114 , 1184 , true ) ,

-- Wattsom
( 'MXS 8' , 114 , 1194 , true ) ,
( 'MXS 4' , 114 , 1194 , true ) ,
( 'MXS 12' , 114 , 1194 , true ) ,
( 'AMBW 12' , 114 , 1194 , true ) ,

-- Oneal
( 'OMX 800' , 114 , 1204 , true ) ,
( 'OMX 12' , 114 , 1204 , true ) ,
( 'OMX 400' , 114 , 1204 , true ) ,
( 'OMX 802' , 114 , 1204 , true ) ,
( 'OMX 4' , 114 , 1204 , true ) ,
		
-- ACESSÓRIOS/EQUIPAMENTOS
-- Sennheiser
( 'HD 25' , 124 , 1214 , true ) ,
( 'HD 206' , 124 , 1214 , true ) ,
( 'HD 280' , 124 , 1214 , true ) ,
( 'HD 599' , 124 , 1214 , true ) ,
( 'HD 200 PRO' , 124 , 1214 , true ) ,
( 'MX 250' , 124 , 1214 , true ) ,

-- Edifier
( 'W820NB' , 124 , 1144 , true ) ,
( 'W820BT' , 124 , 1144 , true ) ,
( 'W830BT' , 124 , 1144 , true ) ,
( 'X5' , 124 , 1144 , true ) ,
( 'X3' , 124 , 1144 , true ) ,
( 'H840' , 124 , 1144 , true ) ,

-- Behringer
( 'FBQ 1502' , 124 , 1174 , true ) ,
( 'Direct Box Di 20' , 124 , 1174 , true ) ,
( 'Mixer MX400' , 124 , 1174 , true ) ,
( 'Amplificador Fone HA400' , 124 , 1174 , true ) ,
		
-- INTERFACES DE ÁUDIO
-- Behringer
( 'UCA-222' , 134 , 1174 , true ) ,
( 'UM2' , 134 , 1174 , true ) ,
( 'UMC-404' , 134 , 1174 , true ) ,
( 'UMC-204' , 134 , 1174 , true ) ,
( 'UMC-1820' , 134 , 1174 , true ) ,

-- Focusrite
( 'Scarlett Solo' , 134 , 1224 , true ) ,
( '18i8' , 134 , 1224 , true ) ,
( 'Clarett 8 PreX' , 134 , 1224 , true ) ,
( '6i6' , 134 , 1224 , true ) ,
( '2i4' , 134 , 1224 , true ) ,

-- Presonus
( 'Studio 26c' , 134 , 1234 , true ) ,
( 'Studio 68c' , 134 , 1234 , true ) ,
( 'AUDIOBOX USB 96' , 134 , 1234 , true ) ,
( 'AUDIOBOX iTwo' , 134 , 1234 , true ) ,
	
-- MICROFONES
-- Sennheiser
( 'Condensador ME 2-II' , 144 , 1214 , true ) ,
( 'Condensador MK 4' , 144 , 1214 , true ) ,
( 'Dinâmico E604' , 144 , 1214 , true ) ,
( 'Lapela XSW' , 144 , 1214 , true ) ,

-- Behringer
( 'C-1U' , 144 , 1174 , true ) ,
( 'C-1' , 144 , 1174 , true ) ,
( 'XM 8500' , 144 , 1174 , true ) ,
( 'B1' , 144 , 1174 , true ) ,

-- Shure
( 'SM57' , 144 , 1254 , true ) ,
( 'SM58' , 144 , 1254 , true ) ,
( 'GLXD4' , 144 , 1254 , true ) ,
( 'SV100' , 144 , 1254 , true ) ,

-- Lyco
( 'UH-01' , 144 , 1264 , true ) ,
( 'UH-02' , 144 , 1264 , true ) ,
( 'UH-07' , 144 , 1264 , true ) ,
( 'UHXPRO' , 144 , 1264 , true ) ,

-- MXT
( 'M-1800B' , 144 , 1274 , true ) ,
( 'M-58' , 144 , 1274 , true ) ,
( 'MUD-515' , 144 , 1274 , true ) ,
( 'BT-58' , 144 , 1274 , true ) ,
		
-- PEDAIS/PEDALEIRAS
-- Boss
( 'GT-1' , 174 , 1314 , true ) ,
( 'GT-100' , 174 , 1314 , true ) ,
( 'RC-500' , 174 , 1314 , true ) ,
( 'ME-80' , 174 , 1314 , true ) ,
( 'CS-3' , 174 , 1314 , true ) ,
( 'GE-7' , 174 , 1314 , true ) ,
( 'DS-1' , 174 , 1314 , true ) ,
( 'VE-500' , 174 , 1314 , true ) ,
( 'RC-5' , 174 , 1314 , true ) ,

-- Zoom
( '500 II' , 174 , 1324 , true ) ,
( 'G2.1DM' , 174 , 1324 , true ) ,
( '505' , 174 , 1324 , true ) ,
( '3030' , 174 , 1324 , true ) ,
( 'G9 2TT' , 174 , 1324 , true ) ,
( 'G5n' , 174 , 1324 , true ) ,
( 'G1' , 174 , 1324 , true ) ,

-- MXR
( 'phase 90' , 174 , 1334 , true ) ,
( 'dyna comp' , 174 , 1334 , true ) ,
( 'carbon copy' , 174 , 1334 , true ) ,
( 'phase 45' , 174 , 1334 , true ) ,
( 'tremolo' , 174 , 1334 , true ) ,
( 'fullbore metal' , 174 , 1334 , true ) ,

-- Line 6
( 'Floor Pod' , 174 , 1124 , true ) ,
( 'Pod HD 500' , 174 , 1124 , true ) ,
( 'Stombox M13' , 174 , 1124 , true ) ,
( 'Firehawk FX' , 174 , 1124 , true ) ,
( 'Floot Pod Plus' , 174 , 1124 , true ) ,
( 'Pod XT Live' , 174 , 1124 , true ) ,
( 'Floor Pod Bass' , 174 , 1124 , true ) ,

-- INSTRUMENTOS DE SOPRO
-- Shelter
( 'Saxofone' , 184 , 1024 , true ) ,
( 'Clarinete' , 184 , 1024 , true ) ,
( 'Trombone' , 184 , 1024 , true ) ,
( 'Tuba' , 184 , 1024 , true ) ,

-- Woodwinds
( 'Saxofone' , 184 , 1344 , true ) ,
( 'Clarinete' , 184 , 1344 , true ) ,
( 'Trombone' , 184 , 1344 , true ) ,
( 'Tuba' , 184 , 1344 , true ) ,

-- OUTRA CATEGORIA
-- Outra Marca
( 'Outros' , 234 , 1354 , true ) ;


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
  -- `category_description`  varchar(50)   NOT NULL                 ,
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
( 'Guitarra Ibanez', 'Vendo minha guitarra Ibanez usada, tenho ela há 8 anos aproxiamadamente.', '2', '2', '2', '2', '2', '4', '1500.50', true, DEFAULT ) ;


-- ## 19º - Criar tabela `images_trade_posts`, referente as IMAGENS utilizadas nos anúncios do sistema
DROP TABLE IF EXISTS `images_trade_posts`;
CREATE TABLE IF NOT EXISTS `images_trade_posts`
(
  `image_id`              int(11)       NOT NULL auto_increment ,
  `image_name`            varchar(255)  NOT NULL                ,
  `trade_post_id`         int(11)       NOT NULL                ,  
  `activity_status`       boolean       NOT NULL DEFAULT 1      , -- 0 is false, 1 is true
  `created_on`            timestamp     NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified_on`           timestamp     NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  CONSTRAINT PK_images PRIMARY KEY (image_id) ,
  CONSTRAINT FK_posts_images FOREIGN KEY (trade_post_id) REFERENCES trade_posts(post_id)
) ENGINE=InnoDB DEFAULT CHARSET = utf8;

-- ## 20º - Insere Dados na tabela `images_trade_posts`
INSERT INTO `images_trade_posts`
( `image_name`, `trade_post_id`, `activity_status`)
VALUES
( 'g2.jpg', '1', DEFAULT ) ;


-- ## 21º - Criar tabela `chat`, referente ao registro dos chats no Sistema (com anúncios relacionados ou não)
-- Base on: https://stackoverflow.com/questions/8351526/storing-chat-messages-inside-a-mysql-table
DROP TABLE IF EXISTS `chat`;
CREATE TABLE IF NOT EXISTS `chat`
(
  `chat_guid`             int(11)      	NOT NULL auto_increment ,
  `trade_post_id`         int(11)       DEFAULT NULL            ,  
  `activity_status`       boolean       NOT NULL DEFAULT 1      , -- 0 is false, 1 is true
  `created_on`            timestamp     NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified_on`           timestamp     NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  CONSTRAINT PK_images PRIMARY KEY (chat_guid) ,
  CONSTRAINT FK_posts_chat FOREIGN KEY (trade_post_id) REFERENCES trade_posts(post_id)  
) ENGINE=InnoDB DEFAULT CHARSET = utf8;


-- ## 22º - Criar tabela `user_chat`, referente a relação entre Múltiplos Usuário e Multiplos Chats
DROP TABLE IF EXISTS `user_chat`;
CREATE TABLE IF NOT EXISTS `user_chat`
(
  `user_chat_chat_guid`   int(11)       NOT NULL                , -- id do CHAT
  `user_chat_user_id`     int(11)       NOT NULL                ,  
  `activity_status`       boolean       NOT NULL DEFAULT 1      , -- 0 is false, 1 is true
  `created_on`            timestamp     NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified_on`           timestamp     NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  CONSTRAINT FK_chat_user_chat FOREIGN KEY (user_chat_chat_guid) REFERENCES chat(chat_guid) ,
  CONSTRAINT FK_users_user_chat FOREIGN KEY (user_chat_user_id) REFERENCES users(user_id)
) ENGINE=InnoDB DEFAULT CHARSET = utf8;

-- ## 23º - Criar tabela `messages`, referente a gravação das Mensagens de Chat
DROP TABLE IF EXISTS `messages`;
CREATE TABLE IF NOT EXISTS `messages`
(
  `message_chat_guid`     int(11)       NOT NULL                ,
  `message_user_id`       int(11)       NOT NULL                ,
  `message`               TINYTEXT      NOT NULL                , -- 255 Caracteres
  `activity_status`       boolean       NOT NULL DEFAULT 1      , -- 0 is false, 1 is true
  `created_on`            timestamp     NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified_on`           timestamp     NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  CONSTRAINT FK_chat_message FOREIGN KEY (message_chat_guid) REFERENCES chat(chat_guid) ,
  CONSTRAINT FK_users_message FOREIGN KEY (message_user_id) REFERENCES users(user_id)
) ENGINE=InnoDB DEFAULT CHARSET = utf8;


-- ## 24º - Criar tabela `images_profile`, referente as IMAGENS utilizadas nos anúncios do sistema
DROP TABLE IF EXISTS `images_profile`;
CREATE TABLE IF NOT EXISTS `images_profile`
(
  `image_id`              int(11)       NOT NULL auto_increment ,
  `image_name`            varchar(255)  NOT NULL                ,
  `user_id`               int(11)       NOT NULL                ,  
  `activity_status`       boolean       NOT NULL DEFAULT 1      , -- 0 is false, 1 is true
  `created_on`            timestamp     NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified_on`           timestamp     NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  CONSTRAINT PK_images PRIMARY KEY (image_id) ,
  CONSTRAINT FK_users_images FOREIGN KEY (user_id) REFERENCES users(user_id)
) ENGINE=InnoDB DEFAULT CHARSET = utf8;

-- ## 25º - Insere Dados na tabela `images_profile`
INSERT INTO `images_profile`
( `image_name`, `user_id`, `activity_status`)
VALUES
( 'img-001.jpg', '4', DEFAULT ) ;


-- ############################################################### ANALISAR ###############################################################

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