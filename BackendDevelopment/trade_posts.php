<?php    
/**
 * File DOC
 * 
 * @Description Página de entrada para requisições do tipo GET, PUT, POST e DELETE de 'TradePosts' (Anúncios)
 * @ChangeLog 
 *  - Vinícius Lessa - 14/04/2022: Criação do arquivo e primeiras tratativas para receber a INCLUSÃO de anúncios via POST.
 *  - Vinícius Lessa - 16/04/2022: Implementação da tratativa POST para inclusão de anúncios com imagens.
 *  - Vinícius Lessa - 28/04/2022: Implementação das consultas das tabelas de 'PRODUCT_CATEGORY', 'PRODUCT_BRANDS', 'PRODUCT_MODELS' e 'COLORS'.
 *  - Vinícius Lessa - 01/05/2022: Implementação do método DELETE.
 *  - Vinícius Lessa - 02/05/2022: Implementação da Criação de Anúncios com 3 imagens.
 *  - Vinícius Lessa - 04/05/2022: Finalização da implementação da ATUALIZAÇÃO (via Post) dos anúncios.
 *  - Vinícius Lessa - 24/06/2022: (Dia da apresentação do TG rs) Atualizada a Query de consulta das cores no momento da inclusão de um novo TP.
 * 
 * @ Tips & Tricks: 
 *      - To check the METHOD type use this: echo json_encode( ['verbo_http' => $_SERVER['REQUEST_METHOD']] );
 * 
 *  GET Method notes:
 *      - GET Url request example: .../trade_posts.php/?token={$token}&key={$key}&value={$value}
 * 
 */
 
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS');
header('Content-type: application/json; application/x-www-form-urlencoded; charset=UTF-8');

require_once 'classes/Class.Crud.php';
require_once 'classes/WebServices/Class.ViaCEP.php';

if (!defined('SITE_URL')) {
    include_once 'config.php';
}

# Estabelece Conexão com o BANCO DE DADOS

// Class.Conexao.php
$pdo = ConexaoDB::getConexao();

// Class.Class.Crud.php
CrudDB::setConexao($pdo);

// Parâmetro passado pela URL
$uri = basename($_SERVER['REQUEST_URI']);


#############################################################################################
// HTTP METHODS
    
// ### GET (Consulta)
if ($_SERVER['REQUEST_METHOD'] == 'GET'):

    // Possíveis Requisições:
    // - Todos os Anúncios: 'trade_posts.php/?token=16663056-351e723be15750d1cc90b4fcd&key=all'
    // - Anúncios de um usuário Específico: 'trade_posts.php/?token=16663056-351e723be15750d1cc90b4fcd&key=all&user_id=14'
    // - Anúncio Específico: 'trade_posts.php/?token=16663056-351e723be15750d1cc90b4fcd&key=224'
    
    // - Seleciona Categorias: 'trade_posts.php/?token=16663056-351e723be15750d1cc90b4fcd&key=categorys'

    // - Seleciona Marcas: 'trade_posts.php/?token=16663056-351e723be15750d1cc90b4fcd&key=brands'
    // - Seleciona Marcas (baseado em CATEGORIA): 'trade_posts.php/?token=16663056-351e723be15750d1cc90b4fcd&key=brands&value={pc.category_id}}'

    // - Seleciona Modelos: 'trade_posts.php/?token=16663056-351e723be15750d1cc90b4fcd&key=models'
    // - Seleciona Cores: 'trade_posts.php/?token=16663056-351e723be15750d1cc90b4fcd&key=colors'

    // *** Início

    // echo json_encode( ['verbo_http' => $_SERVER['REQUEST_METHOD']] );
    // exit;

    // Token Validation
    if (!($_GET["token"] === '16663056-351e723be15750d1cc90b4fcd')):
        http_response_code(401); // Unauthorized
        echo json_encode([
            "error" => true ,
            "msg" => 'Erro: Token is not Valid!'
        ]);        
        exit;
    endif;

    if ( !Empty($uri) && $uri <> 'index.php' ):

        // Variables
        $keySearch      = (isset($_GET["key"]))     ? $_GET["key"] : "" ;
        $valueSearch    = (isset($_GET["value"]))   ? $_GET["value"] : "" ;        
        $user_id        = (isset($_GET['user_id'])) ? intval($_GET['user_id']) : '';

        if (Empty($keySearch)):
            http_response_code(404); // Not Found
            echo json_encode([
                "error" => true ,
                "msg" => 'Informe todos os parâmetros!'
            ]);            
            exit;
        else:
            // Unique Trade Post
            if (is_numeric($keySearch)):
                $dbReturn = CrudDB::select(
                    'SELECT 
                    tp.post_id as `post_id` 	,
                    tp.title					,
                    tp.description as tp_desc 	,
                    tp.category_id				,
                    pc.description as pc_desc 	,
                    tp.brand_id					,
                    pb.description as pb_desc  	,
                    tp.model_id					,
                    pm.description as pm_desc  	,
                    tp.color_id					,
                    c.description as c_desc  	,
                    tp.condition_id				,
                    pc2.description as pc2_desc ,
                    tp.user_id					,
                    u.user_name 				,
                    u.cep 				        ,
                    u.phone 					,
                    tp.price					,
                    tp.eletronic_invoice 		,
                    itp.image_name as image_name,
                    ip.image_name as img_profile_name
                    FROM trade_posts tp 
                    INNER JOIN product_categorys pc ON tp.category_id  = pc.category_id
                    INNER JOIN product_brands pb ON tp.brand_id = pb.brand_id
                    INNER JOIN product_models pm ON tp.model_id = pm.model_id 
                    INNER JOIN colors c ON tp.color_id  = c.color_id
                    INNER JOIN product_conditions pc2 ON tp.condition_id = pc2.condition_id 
                    INNER JOIN users u ON tp.user_id = u.user_id
                    LEFT JOIN images_trade_posts itp ON tp.post_id  = itp.trade_post_id
                    -- CROSS JOIN images_trade_posts itp 
                    LEFT JOIN images_profile ip ON ip.user_id = u.user_id 
                    WHERE 
                        tp.post_id          =:POST_ID and                        
                        tp.activity_status  = 1
                    ORDER BY tp.created_on DESC',
                    [
                        'POST_ID' => $keySearch
                    ], TRUE);
                
                if (!empty($dbReturn)):
                    for ($i = 0; $i < count($dbReturn); $i++) {                    
                        if ( !empty($dbReturn[$i]->image_name) ):
                            $dbReturn[$i]->image_name = SITE_URL . "/uploads/" . $dbReturn[$i]->image_name ;
                        endif;

                        if ( !empty($dbReturn[$i]->img_profile_name) ):
                            $dbReturn[$i]->img_profile_name = SITE_URL . "/uploads/user-profile/" . $dbReturn[$i]->img_profile_name ;
                        endif;

                        // Consulta Cep e Adicina no Retorno
                        if ( !empty($dbReturn[$i]->cep) ):

                            $dadosCEP = ViaCEP::consultarCEP($dbReturn[$i]->cep);

                            if ( $dadosCEP != null ):
                                // Adiciona nova Propriedade ao Objeto
                                $dbReturn[$i] = (array)$dbReturn[$i];
                                switch ($dadosCEP["uf"]) {
                                    case 'AC':
                                        $dbReturn[$i]['state'] = 'AC - Acre';
                                        break;
                                    case 'AL':
                                        $dbReturn[$i]['state'] = 'AL - Alagoas';
                                        break;
                                    case 'AM':
                                        $dbReturn[$i]['state'] = 'AM - Amazonas';
                                        break;
                                    case 'AP':
                                        $dbReturn[$i]['state'] = 'AP - Amapá';    
                                        break;
                                    case 'BA':
                                        $dbReturn[$i]['state'] = 'BA - Bahia';
                                        break;
                                    case 'CE':
                                        $dbReturn[$i]['state'] = 'CE - Ceará';
                                        break;
                                    case 'DF':
                                        $dbReturn[$i]['state'] = 'DF - Distrito Federal';
                                        break;
                                    case 'ES':
                                        $dbReturn[$i]['state'] = 'ES - Espírito Santo';
                                        break;
                                    case 'GO':
                                        $dbReturn[$i]['state'] = 'GO - Goiás';
                                        break;
                                    case 'MA':
                                        $dbReturn[$i]['state'] = 'MA - Maranhão';
                                        break;
                                    case 'MT':
                                        $dbReturn[$i]['state'] = 'MT - Mato Grosso ';
                                        break;
                                    case 'MS':
                                        $dbReturn[$i]['state'] = 'MS - Mato Grosso do Sul';
                                        break;
                                    case 'MG':
                                        $dbReturn[$i]['state'] = 'MG - Minas Gerais';
                                        break;
                                    case 'PA':
                                        $dbReturn[$i]['state'] = 'PA - Pará';
                                        break;
                                    case 'PB':
                                        $dbReturn[$i]['state'] = 'PB - Paraíba';
                                        break;
                                    case 'PR':
                                        $dbReturn[$i]['state'] = 'PR - Paraná';
                                        break;
                                    case 'PE':
                                        $dbReturn[$i]['state'] = 'PE - Pernambuco';
                                        break;
                                    case 'PI':
                                        $dbReturn[$i]['state'] = 'PI - Piauí';
                                        break;
                                    case 'RJ':
                                        $dbReturn[$i]['state'] = 'RJ - Rio de Janeiro';
                                        break;
                                    case 'RN':
                                        $dbReturn[$i]['state'] = 'RN - Rio Grande do Norte';
                                        break;
                                    case 'RS':
                                        $dbReturn[$i]['state'] = 'RS - Rio Grande do Sul';
                                        break;
                                    case 'RO':
                                        $dbReturn[$i]['state'] = 'RO - Rondônia';
                                        break;
                                    case 'RR':
                                        $dbReturn[$i]['state'] = 'RR - Roraima';
                                        break;
                                    case 'SC':
                                        $dbReturn[$i]['state'] = 'SC - Santa Catarina';
                                        break;
                                    case 'SP':
                                        $dbReturn[$i]['state'] = 'SP - São Paulo';
                                        break;
                                    case 'SE':
                                        $dbReturn[$i]['state'] = 'SE - Sergipe';
                                        break;
                                    case 'TO':
                                        $dbReturn[$i]['state'] = 'TO - Tocantins';
                                        break;
                                }                                
                                $dbReturn[$i]['city'] = $dadosCEP["localidade"];
                                $dbReturn[$i]['district'] = $dadosCEP["bairro"];
                                $dbReturn[$i] = (object)$dbReturn[$i];
                            endif;
                        endif;                        
                    }
                    
                    http_response_code(200); // Success
                    echo json_encode([
                        "error" => false ,
                        'data' => $dbReturn
                    ]);                    
                    exit;
                else:
                    http_response_code(200); // Success                  
                    echo json_encode([
                        "error" => true ,
                        "msg" => 'Erro: O Anúncio solicitado não foi encontrado!'
                    ]);                    
                    exit;
                endif;

            // All Trade Posts
            elseif ($keySearch == 'all'):
                
                if ( empty($user_id) ):                                        

                    $dados = CrudDB::select(
                        'SELECT 
                            tp.post_id as `post_id`,
                            tp.title ,
                            tp.description as tp_desc 	,
                            tp.user_id ,
                            u.user_name ,
                            tp.category_id ,
                            pc.description as pc_desc ,
                            tp.price , 
                            (SELECT image_name FROM images_trade_posts itp 
                            WHERE 	itp.activity_status = 1 AND
                                    itp.trade_post_id = `post_id`
                            ORDER BY created_on LIMIT 1) AS image_name
                        FROM trade_posts tp 
                        INNER JOIN users u ON tp.user_id = u.user_id
                        INNER JOIN product_categorys pc ON tp.category_id  = pc.category_id
                        where tp.activity_status = 1
                        ORDER BY tp.created_on DESC LIMIT 12;',
                        [], TRUE);
                // TP Per User
                else:

                    if (!is_numeric($user_id)):
                        http_response_code(406); // Not Acceptable
                        echo json_encode([
                            "error" => true ,
                            "msg" => 'O Parâmetro "User Id" não é numérico!'
                        ]);                        
                        exit;
                    endif;

                    $dados = CrudDB::select(
                        'SELECT 
                            tp.post_id as `post_id`,
                            tp.title ,
                            tp.description as tp_desc 	,
                            tp.user_id ,
                            u.user_name ,
                            tp.category_id ,
                            pc.description , 
                            tp.price , 
                            (SELECT image_name FROM images_trade_posts itp 
                            WHERE 	itp.activity_status = 1 AND
                                    itp.trade_post_id = `post_id`
                            ORDER BY created_on LIMIT 1) AS image_name
                        FROM trade_posts tp 
                        INNER JOIN users u ON tp.user_id = u.user_id
                        INNER JOIN product_categorys pc ON tp.category_id  = pc.category_id
                        where tp.activity_status = 1 and tp.user_id =:USER_ID
                        ORDER BY tp.created_on DESC LIMIT 12;',
                        [
                            'USER_ID' => $user_id
                        ], TRUE);                
                endif;

                if (!empty($dados)):
                    foreach ($dados as $tradePost) {
                        if ( $tradePost->image_name != null ):
                            $tradePost->image_name = SITE_URL . "/uploads/" . $tradePost->image_name;
                        endif;
                    }
                    
                    http_response_code(200); // Success
                    echo json_encode([
                        "error" => false ,
                        'data' => $dados
                    ]);                    
                    exit;                  
                else:
                    http_response_code(200); // Success                  
                    echo json_encode([
                        "error" => true ,
                        "msg" => 'Erro: Nenhum anúncio Encontrado!'            
                    ]);                    
                    exit;
                endif;
            
            // Categorys
            elseif ( $keySearch == 'categorys' ):
                            
                $dados = CrudDB::select(
                    "SELECT * FROM (SELECT pc.category_id, pc.description  AS `description`
                    FROM product_categorys pc
                    WHERE pc.activity_status = 1 AND
                          pc.category_id != (SELECT pc.category_id from product_categorys pc 
                                             where pc.activity_status = 1 AND
                                                   pc.description LIKE ('%Outr%'))
                    ORDER BY `description`) a
                    UNION ALL
                    SELECT * FROM (SELECT pc.category_id, pc.description AS `description`
                    FROM product_categorys pc
                    WHERE pc.activity_status = 1 and
                          pc.category_id = (SELECT pc.category_id FROM product_categorys pc 
                                            WHERE pc.activity_status = 1 AND
                                                  pc.description LIKE ('%Outr%'))) b;",
                    [], TRUE);

                if (!empty($dados)):
                    http_response_code(200); // Success
                    echo json_encode([
                        "error" => false ,
                        'data' => $dados
                    ]);                    
                    exit;
                else:
                    http_response_code(200); // Success
                    echo json_encode([
                        "error" => true ,
                        "msg" => 'Problema ao realizar a consulta da tabela `product_categorys` no Banco de Dados'            
                    ]);                    
                    exit;
                endif;            

            // Brands
            elseif ( $keySearch == 'brands' ):
                
                // All Brands
                if ( empty($valueSearch) ):
                    $dados = CrudDB::select(
                        "SELECT * FROM (SELECT pb.brand_id , pb.description AS `description`
                        FROM product_brands pb 
                        WHERE pb.activity_status = 1 AND
                              pb.brand_id != (SELECT pb2.brand_id  FROM product_brands pb2
                                                WHERE pb2.activity_status = 1 AND
                                                       pb2.description like ('%Outr%'))
                        ORDER BY `description`) a
                        UNION ALL
                        SELECT * FROM (SELECT pb.brand_id, pb.description  AS `description`
                        FROM product_brands pb 
                        WHERE pb.activity_status = 1 AND
                              pb.brand_id = (SELECT pb2.brand_id  FROM product_brands pb2
                                                 WHERE pb2.activity_status = 1 AND
                                                       pb2.description like ('%Outr%')) 
                        ) b;",
                        [], TRUE);
    
                    if (!empty($dados)):
                        http_response_code(200); // Success
                        echo json_encode([
                            "error" => false ,
                            'data' => $dados
                        ]);
                        exit;     
                    else:
                        http_response_code(200); // Success                      
                        echo json_encode([
                            "error" => true ,
                            "msg" => 'Problema ao realizar a consulta da tabela `product_brands` no Banco de Dados'
                        ]);                        
                        exit;
                    endif;
                else:
                    if ( is_numeric($valueSearch) ):
                        $dados = CrudDB::select(
                            "SELECT * FROM (SELECT
                            cb.category_brand_brand_id      AS `brand_id` ,	
                            pb.description                  AS `brand_description` 
                            FROM category_brand cb
                            INNER JOIN product_categorys pc ON pc.category_id = cb.category_brand_category_id
                            INNER JOIN product_brands pb    ON pb.brand_id = cb.category_brand_brand_id
                            WHERE cb.activity_status = 1 AND
                                pc.activity_status = 1 AND
                                pb.activity_status = 1 AND
                                pb.description NOT LIKE ('%Outr%') AND
                                cb.category_brand_category_id = :CATEGORY_ID
                            ORDER BY `brand_description` ) a
                            UNION ALL
                            SELECT * FROM (SELECT
                            cb.category_brand_brand_id      AS `brand_id` ,	
                            pb.description                  AS `brand_description` 
                            FROM category_brand cb
                            INNER JOIN product_categorys pc ON pc.category_id = cb.category_brand_category_id
                            INNER JOIN product_brands pb    ON pb.brand_id = cb.category_brand_brand_id
                            WHERE cb.activity_status = 1 AND
                                pc.activity_status = 1 AND
                                pb.activity_status = 1 AND 
                                cb.category_brand_category_id = (SELECT pc2.category_id  FROM product_categorys pc2 
                                                                 WHERE pc2.activity_status = 1 AND
                                                                       pc2.description LIKE ('%Outr%'))
                            ) b ;",
                            [
                                'CATEGORY_ID' => $valueSearch
                            ], TRUE);
        
                        if (!empty($dados)):
                            http_response_code(200); // Success
                            echo json_encode([
                                "error" => false ,
                                'data' => $dados
                            ]);
                            exit;     
                        else:
                            http_response_code(200); // Success
                            echo json_encode([
                                "error" => true ,
                                "msg" => 'Problema ao realizar a consulta da tabela `product_brands` com base na Categoria!'
                            ]);                            
                            exit;
                        endif;
                    else:
                        http_response_code(406); // Not Acceptable                      
                        echo json_encode([
                            "error" => true ,
                            "msg" => 'Valor de Categoria inválido!'
                        ]);                        
                        exit;
                    endif;                    
                endif;                            
            
            // Models
            elseif ($keySearch == 'models'):
                     
                // All Models
                if ( empty($valueSearch) ):
                    $dados = CrudDB::select(
                        "SELECT * FROM (SELECT pm.model_id , pm.description AS `description`
                        FROM product_models pm
                        WHERE pm.activity_status = 1 AND
                              pm.model_id != (SELECT pm2.model_id FROM product_models pm2
                                                WHERE pm2.activity_status = 1 AND
                                                       pm2.description LIKE ('%Outr%'))
                        ORDER BY `description`) a
                        UNION ALL
                        SELECT * FROM (SELECT pm.model_id , pm.description  AS `description`
                        FROM product_models pm
                        WHERE pm.activity_status = 1 AND
                              pm.model_id = (SELECT pm2.model_id FROM product_models pm2
                                               WHERE pm2.activity_status = 1 AND
                                                     pm2.description LIKE ('%Outr%'))
                        ) b;",
                        [], TRUE);

                    if (!empty($dados)):
                        http_response_code(200); // Success
                        echo json_encode([
                            "error" => false ,
                            'data' => $dados
                        ]);                        
                        exit;     
                    else:
                        http_response_code(200); // Success
                        echo json_encode([
                            "error" => true ,
                            "msg" => 'Problema ao realizar a consulta da tabela `product_models` no Banco de Dados'            
                        ]);                        
                        exit;
                    endif;                    
                    
                else:
                    $categoryToSeek = $valueSearch ;
                    $brandToSeek    = (isset($_GET["brand"]))   ? $_GET["brand"] : "" ;

                    if ( empty($brandToSeek) || !is_numeric($categoryToSeek) || !is_numeric($brandToSeek) ):
                        http_response_code(406); // Not Acceptable
                        echo json_encode([
                            "error" => true ,
                            "msg" => 'Categoria ou Valor INVÁLIDOS!'
                        ]);                        
                        exit;
                    endif;

                    $dados = CrudDB::select(
                        "SELECT * FROM (SELECT pm.model_id, pm.description AS `description` FROM product_models pm
                        WHERE pm.activity_status = 1 AND
                                pm.category_id =:CATEGORY_ID AND
                                pm.brand_id =:BRAND_ID AND 
                                pm.model_id  != (SELECT pm2.model_id FROM product_models pm2
                                                    WHERE pm2.activity_status = 1 AND
                                                        pm2.description LIKE ('%Outr%'))
                        ORDER BY `description`) a
                        UNION ALL
                        SELECT * FROM (SELECT pm.model_id, pm.description AS `description` FROM product_models pm
                        WHERE pm.activity_status = 1 AND
                                pm.model_id = (SELECT pm2.model_id FROM product_models pm2
                                                WHERE pm2.activity_status = 1 AND
                                                        pm2.description LIKE ('%Outr%'))
                        ) b;",
                        [
                            'CATEGORY_ID' => $categoryToSeek ,
                            'BRAND_ID' => $brandToSeek
                        ], TRUE);
    
                    if (!empty($dados)):
                        http_response_code(200); // Success
                        echo json_encode([
                            "error" => false ,
                            'data' => $dados
                        ]);                        
                        exit;     
                    else:
                        http_response_code(200); // Success                          
                        echo json_encode([
                            "error" => true ,
                            "msg" => 'Problema ao realizar a consulta da tabela `product_brands` com base na Categoria!'
                        ]);                        
                        exit;
                    endif;
                endif;            

            // Colors
            elseif ($keySearch == 'colors'):
                            
                $dados = CrudDB::select(
                    "SELECT * FROM (SELECT c.color_id , c.description AS `description`
                    FROM colors c
                    WHERE c.activity_status = 1 AND
                          c.color_id != (SELECT c2.color_id from colors c2
                                           WHERE c2.activity_status = 1 AND
                                                 c2.description LIKE ('%Outr%'))
                    ORDER BY `description`) a
                    UNION
                    SELECT * FROM (SELECT c.color_id , c.description AS `description`
                    FROM colors c
                    WHERE c.activity_status = 1 AND
                          c.color_id = (SELECT c2.color_id from colors c2
                                           WHERE c2.activity_status = 1 AND
                                                 c2.description like ('%Outr%'))
                    ORDER BY `description`) b;",
                    [], TRUE);

                if (!empty($dados)):
                    http_response_code(200); // Success
                    echo json_encode([
                        "error" => false ,
                        'data' => $dados
                    ]);                    
                    exit;     
                else:
                    http_response_code(200); // Success
                    echo json_encode([
                        "error" => true ,
                        "msg" => 'Problema ao realizar a consulta da tabela `colors` no Banco de Dados'
                    ]);
                    exit;
                endif;
            endif;

        endif;            
    else:
        http_response_code(406); // Not Acceptable
        echo json_encode([
            "error" => true ,
            "msg"   => 'Parâmetro não preenchido na consulta!'
        ]);
    endif;

endif;


#############################################################################################

// # POST (INCLUSÃO)
// No INSOMINIA, utilizar o "MULTIPART FORM" (Structured)
if ($_SERVER['REQUEST_METHOD'] == 'POST'):
    
    // Possíveis Requisições:
    // - CREATE new Trade Post: .../tradepost.php/ + action == 0
    // - UPDATE Trade Post: .../tradepost.php/ + action == 1

    // echo json_encode( ['verbo_http' => $_SERVER['REQUEST_METHOD']] );
    // exit

    // Token Validation
    if (!($_POST["token"] === '16663056-351e723be15750d1cc90b4fcd')):
        http_response_code(401); // Unauthorized
        echo json_encode([
            "error" => true ,
            "msg" => 'Erro: Token is not Valid!'
        ]);        
        exit;
    endif;
    
    // http_response_code(200); // Unauthorized
    // echo json_encode([
    //     "error" => true ,
    //     'Data' => $_POST,
    //     'Files' => $_FILES
    // ]);    
    // exit;

    // Variables
    $actionPost     = (isset($_POST["action"]))         ? $_POST["action"] : ''             ;
    $post_id        = (isset($_POST["post_id"]))        ? $_POST["post_id"] : ''             ;

    $title          = (isset($_POST['title']))          ? $_POST['title'] : ''              ;
    $category_id    = (isset($_POST['category']))       ? intval($_POST['category']) : 0    ;
    $price          = (isset($_POST['price']))          ? floatval($_POST['price']) : 0     ;
    $pCondition_id  = (isset($_POST['p_condition']))    ? intval($_POST['p_condition']) : 0 ;
    $possuiNF       = (isset($_POST['possuiNF']))       ? intval($_POST['possuiNF']) : 3    ;
    $user_id        = (isset($_POST['user_id']))        ? intval($_POST['user_id']) : 0     ;

    $brand_id       = (isset($_POST['brand'])) ? intval($_POST['brand']) : 0                ;
    $model_id       = (isset($_POST['model'])) ? intval($_POST['model']) : 0                ;
    $description    = (isset($_POST['description'])) ? $_POST['description'] : ''           ;
    $color_id       = (isset($_POST['color'])) ? intval($_POST['color']) : 0                ;
    
    $a_ImgDelete    = (isset($_POST['images-delete'])) ? explode(",", $_POST['images-delete']) : Array();

    $imageUpload    = false; // By default, image upload will not happen    
    
    // Check Received Data
    // echo json_encode([
    //     "error" => true ,
    //     "msg"   => 'Teste' ,
    //     'dados' => $_POST
    // ]);
    // exit;

    if (empty($title) or
        $category_id    == 0 or
        $price          == 0 or
        $pCondition_id  == 0 or
        $user_id        == 0 or
        $possuiNF       == 3
        ):
        
        http_response_code(406);
        echo json_encode([
            "error" => true ,
            "msg" => 'Erro: Informe Todos os Parâmetros!'
        ]);        
        exit;
    endif;

    if ( $actionPost == 0 ):  // 0 = Create, 1 = Update
        $count = count($_FILES['files']['name']);

        // http_response_code(200); // Not Acceptable
        // echo json_encode([
        //     "error" => false ,
        //     'Dados'   => $_FILES['files']
        // ]);        
        // exit;
    
        if ( $count > 0 ):
            
            $a_TmpLocations = array();
            $a_NewLocations = array();
            $a_FileNames    = array();
            
            // Check Received values
            // echo var_dump($_FILES); // Doesn't work with JS
            // echo json_encode( ['Arquivos' => $_FILES] );
    
            for ($i = 0; $i < $count; $i++) {
        
                // Checks IMAGES to UPLOAD
                if( isset($_FILES['files']['name'][$i]) && !empty($_FILES['files']['name'][$i]) ):
        
                    // Extension                
                    $imageFileType  = strrchr($_FILES['files']['name'][$i], ".");
                    $imageFileType  = strtolower($imageFileType);
        
                    // Getting and Defining file name
                    $data           = new DateTime();
                    $a_FileNames[]  = "imagem-" . $data->format('Y-m-d') . "_" . rand(1, 9999) . $imageFileType;
                
                    // Locations
                    $a_TmpLocations[]  = $_FILES['files']['tmp_name'][$i];
                    $a_NewLocations[]  = "uploads/".$a_FileNames[$i];
        
                    // File Sizes
                    // $a_tmpSizes[]   = $_FILES['files']['size'][$i];
                    $fileSize       = $_FILES['files']['size'][$i];
                    $maxsize        = 4194304; //bytes (4mb)        
        
                    // Acceptable Extensions
                    $valid_extensions = array("jpg","jpeg","png");
                    
                    // File Extension Validation
                    if ($fileSize > $maxsize):
                        http_response_code(406); // Not Acceptable
                        echo json_encode([
                            "error" => true ,
                            "msg"   => 'Erro: O tamanho do arquivo deve ser de no máximo 4mb!'
                        ]);                        
                        exit;
                    endif;
        
                    // File Size Validation
                    if (!in_array(substr(strtolower($imageFileType), 1), $valid_extensions)):
                        http_response_code(406); // Not Acceptable
                        echo json_encode([
                            "error" => true ,
                            "msg"   => 'Erro: Somente os formatos jpg, jpeg e png são permitidos! '
                        ]);                        
                        exit;
                    endif;
        
                    $imageUpload = true;
                else:
                    http_response_code(406); // Not Acceptable
                    echo json_encode([
                        "error" => true ,
                        "msg"   => 'Problema no leitura das Imagens para Upload!'
                    ]);                    
                    exit;
                endif;
            }        
        endif; 
    
        CrudDB::setTabela('trade_posts');
            
        // $dbReturn = true;
        $dbReturn = CrudDB::insert([
            'title'             => "'" . $title . "'" ,
            'description'       => "'" . $description . "'" ,
            'category_id'       => "'" . $category_id . "'" ,
            'brand_id'          => "'" . $brand_id . "'" ,
            'model_id'          => "'" . $model_id . "'" ,
            'color_id'          => "'" . $color_id . "'" , 
            'condition_id'      => "'" . $pCondition_id. "'" ,
            'user_id'           => "'" . $user_id . "'" ,
            'price'             => "'" . $price . "'" ,
            'eletronic_invoice' => "'" . $possuiNF . "'" ,
        ]);
    
        if ($dbReturn):
            // Upload file
            if ($imageUpload):
    
                $count = count($a_TmpLocations);
    
                for ($i = 0; $i < $count; $i++) {                
    
                    if (move_uploaded_file($a_TmpLocations[$i], $a_NewLocations[$i])):                    
                        
                        // TradePost ID
                        $dados = CrudDB::select('SELECT post_id FROM trade_posts WHERE user_id =:USER_ID  ORDER BY created_on DESC LIMIT 1'
                                    ,['USER_ID' => $user_id]
                                    ,TRUE);
                        
                        if (!Empty($dados)):
                            CrudDB::setTabela('images_trade_posts');
        
                            $dbReturnTwo = CrudDB::insert ([
                                'image_name'    => "'" . $a_FileNames[$i] . "'" ,
                                'trade_post_id' => "'" . intval($dados[0]->post_id) . "'" ,
                            ]);

                            if ( !$dbReturnTwo ):
                                http_response_code(500); // Internal Server Error
                                echo json_encode([
                                    "error" => false ,
                                    "msg" => "Anúncio incluído, porém tivemos um Erro na Gravação das imagens no Banco"
                                ]);                                
                                exit;
                            endif;
                        else:
                            http_response_code(500); // Internal Server Error
                            echo json_encode([
                                "error" => false ,
                                "msg" => "Anúncio incluído mas não encontrado para relacionar imagens!"
                            ]);                            
                            exit;
                        endif;
                    else:
                        http_response_code(500); // Internal Server Error              
                        echo json_encode([
                            "error" => true ,
                            "msg"   => 'Anúncio incluído, porém tivemos um Erro no Upload da(s) imagem(ns) ao Servidor'
                        ]);                        
                        exit;
                    endif;
                }
    
            // Desired Goal
            http_response_code(201); // Created
            echo json_encode([
                "error" => false ,
                "msg" => "Anúncio incluído com êxito!"
            ]);            
            exit;
    
            else:
                http_response_code(201); // Created          
                echo json_encode([
                    "error" => false ,
                    "msg" => "Anúncio incluído com êxito!"
                ]);                
                exit;        
            endif;
    
        else:
            http_response_code(500); // Internal Server Error                  
            echo json_encode([
                "error" => true ,
                "msg"   => 'Erro ao Inserir Anúncio no Banco de Dados'
            ]);            
            exit;
        endif;        

    elseif ( $actionPost == 1 ):  // 0 = Create, 1 = Update
    
        $count = ( isset($_FILES['files']) ? count($_FILES['files']['name']) : 0 );
    
        // Valida Images
        if ( $count > 0 ):
            
            $a_TmpLocations = array();
            $a_NewLocations = array();
            $a_FileNames    = array();
            
            // Check Received values
            // echo var_dump($_FILES); // Doesn't work with JS
            // echo json_encode( ['Arquivos' => $_FILES] );            
    
            for ($i = 0; $i < $count; $i++) {
        
                // Checks IMAGES to UPLOAD
                if( isset($_FILES['files']['name'][$i]) && !empty($_FILES['files']['name'][$i]) ):
        
                    // Extension                
                    $imageFileType  = strrchr($_FILES['files']['name'][$i], ".");
                    $imageFileType  = strtolower($imageFileType);
        
                    // Getting and Defining file name
                    $data           = new DateTime();
                    $a_FileNames[]  = "imagem-" . $data->format('Y-m-d') . "_" . rand(1, 9999) . $imageFileType;
                
                    // Locations
                    $a_TmpLocations[]  = $_FILES['files']['tmp_name'][$i];
                    $a_NewLocations[]  = "uploads/".$a_FileNames[$i];
        
                    // File Sizes
                    // $a_tmpSizes[]   = $_FILES['files']['size'][$i];
                    $fileSize       = $_FILES['files']['size'][$i];
                    $maxsize        = 4194304; //bytes (4mb)        
        
                    // Acceptable Extensions
                    $valid_extensions = array("jpg","jpeg","png");
                    
                    // File Extension Validation
                    if ($fileSize > $maxsize):
                        http_response_code(406); // Not Acceptable
                        echo json_encode([
                            "error" => true ,
                            "msg"   => 'Erro: O tamanho do arquivo deve ser de no máximo 4mb!'
                        ]);                        
                        exit;
                    endif;
        
                    // File Size Validation
                    if (!in_array(substr(strtolower($imageFileType), 1), $valid_extensions)):
                        http_response_code(406); // Not Acceptable
                        echo json_encode([
                            "error" => true ,
                            "msg"   => 'Erro: Somente os formatos jpg, jpeg e png são permitidos! '
                        ]);                        
                        exit;
                    endif;

                    $imageUpload = true;
                else:
                    http_response_code(406); // Not Acceptable
                    echo json_encode([
                        "error" => true ,
                        "msg"   => 'Problema no leitura das Imagens para Upload!'
                    ]);                    
                    exit;
                endif;
            }
        endif;        

        CrudDB::setTabela('trade_posts');
            
        // $dbReturn = true;
        $dbReturn = CrudDB::update([
            'title'             => "'" . $title . "'" ,
            'description'       => "'" . $description . "'" ,
            'category_id'       => "'" . $category_id . "'" ,
            'brand_id'          => "'" . $brand_id . "'" ,
            'model_id'          => "'" . $model_id . "'" ,
            'color_id'          => "'" . $color_id . "'" , 
            'condition_id'      => "'" . $pCondition_id. "'" ,            
            'price'             => "'" . $price . "'" ,
            'eletronic_invoice' => "'" . $possuiNF . "'" 
        ],
        [
            'post_id' => $post_id ,
            'user_id' => $user_id 
        ]);

        if ($dbReturn):
            
            // Has Images to Delete ?
            if ( !empty($a_ImgDelete) ):                                

                foreach ($a_ImgDelete as $imageToDelete) {
                    
                    // Check if Image Exists
                    $dados = CrudDB::select(
                        "SELECT itp.image_name 
                        FROM images_trade_posts itp 
                        WHERE itp.activity_status = 1 AND 
                              itp.trade_post_id = :POST_ID AND
                              itp.image_name = :IMAGE_NAME
                        ORDER BY itp.created_on DESC LIMIT 1;"
                        , [
                            "POST_ID"       => $post_id ,
                            "IMAGE_NAME"    => $imageToDelete
                          ] 
                        , TRUE);

                    if (!empty($dados)):

                        $file = "uploads/".$imageToDelete;
                    
                        if( is_file($file) ):

                            // delete file
                            if ( !(unlink($file)) ): 
    
                                http_response_code(500); // Internal Server Error
                                echo json_encode([
                                    "error" => true ,
                                    "msg" => "Problema na Deleção do Arquivo físico '" . $imageToDelete . "' no Servidor!"
                                ]);
                                exit;
    
                            else:
                                // Delete Image Name from DB
                                CrudDB::setTabela('images_trade_posts');
                                $retorno = CrudDB::delete([
                                    'trade_post_id' => $post_id ,
                                    'image_name' => $imageToDelete
                                ]);
    
                                if (!$retorno):
                                    http_response_code(500); // Internal Server Error
                                    echo json_encode([
                                        "error" => true ,
                                        "msg" => "O arquivo '" . $imageToDelete . "' não pode ser deletado do Banco de dados!"
                                    ]);
                                    exit;
                                endif;
    
                            endif;
                        else:
                            http_response_code(500); // Internal Server Error
                            echo json_encode([
                                "error" => true ,
                                "msg" => "O arquivo '" . $imageToDelete . "' não foi encontrado no Servidor!"
                            ]);
                            exit;
                        endif;
                    else:
                        http_response_code(500); // Internal Server Error
                        echo json_encode([
                            "error" => true ,
                            "msg" => "Não foi possível Encontrar as Imagens para Deleção!"
                        ]);
                        exit;
                    endif;
                }
            endif;

            // Upload New files (if exists)
            if ($imageUpload):
    
                $count = count($a_TmpLocations);
    
                for ($i = 0; $i < $count; $i++) {
    
                    if (move_uploaded_file($a_TmpLocations[$i], $a_NewLocations[$i])):                    

                        CrudDB::setTabela('images_trade_posts');
    
                        $dbReturnTwo = CrudDB::insert ([
                            'image_name'    => "'" . $a_FileNames[$i] . "'" ,
                            'trade_post_id' => "'" . $post_id . "'" ,
                        ]);
            
                        if ( !$dbReturnTwo ):
                            http_response_code(500); // Internal Server Error
                            echo json_encode([
                                "error" => false ,
                                "msg" => "Anúncio Atualizado e Imagem(ns) movida(s) ao Servidor, porém tivemos um Erro na Gravação das imagens no Banco de Dados!"
                            ]);                            
                            exit;
                        endif;                        
                    else:
                        http_response_code(500); // Internal Server Error              
                        echo json_encode([
                            "error" => true ,
                            "msg"   => 'Anúncio Atualizado com Sucesso, porém um dos Arquivos não pode ser copiado ao Servidor com Sucesso!'
                        ]);                        
                        exit;
                    endif;
                }
    
                // Desired Goal
                http_response_code(202); // Accepted
                echo json_encode([
                    "error" => false ,
                    "msg" => "Anúncio Atualizado com êxito!"
                ]);                
                exit;
    
            else:
                http_response_code(202); // Accepted          
                echo json_encode([
                    "error" => false ,
                    "msg" => "Anúncio Atualizado com êxito!"
                ]);                
                exit;        
            endif;
    
        else:
            http_response_code(500); // Internal Server Error                  
            echo json_encode([
                "error" => true ,
                "msg"   => 'Erro ao ATUALIZAR Anúncio no Banco de Dados'
            ]);            
            exit;
        endif;         

    endif;    

endif;



#############################################################################################

// **************** PUT (ALTERAÇÃO)
if ($_SERVER['REQUEST_METHOD'] == 'PUT'):
    
    // Utilizar "FORM URL Encoded" (application/x-www-form-urlencoded)

    // echo json_encode( ['verbo_http' => $_SERVER['REQUEST_METHOD']] );
    // exit;

endif;


#############################################################################################

// ********************* DELETE
if ($_SERVER['REQUEST_METHOD'] == 'DELETE'):
    
    // Utilizar "FORM URL Encoded" (application/x-www-form-urlencoded)

    // echo json_encode( ['verbo_http' => $_SERVER['REQUEST_METHOD']] );
    // exit;

    parse_str(file_get_contents('php://input'), $_DELETE);

    // Token Validation
    if (!($_DELETE['token'] === '16663056-351e723be15750d1cc90b4fcd')):
        http_response_code(401); // Unauthorized
        echo json_encode([
            "error" => true ,
            "msg" => 'Erro: Token is not Valid!'
        ]);        
        exit;
    endif;

    $post_id = (isset($_DELETE['post_id'])) ? intval($_DELETE['post_id']) : 0 ;

    if (!is_numeric($post_id)):
        http_response_code(406); // Not Acceptable
        echo json_encode([
            "error" => true ,
            "msg" => 'O parâmetro não é numérico'
        ]);        
        exit;
    else:        
        $dados = CrudDB::select("SELECT tp.post_id FROM trade_posts tp WHERE tp.activity_status = 1 AND tp.post_id = :POST_ID", ["POST_ID" => $post_id], FALSE);
        
        if (!empty($dados)):

            // Check if Exists Images related to the Trade Post
            $dados = CrudDB::select("SELECT itp.image_name FROM images_trade_posts itp WHERE itp.activity_status = 1 AND itp.trade_post_id = :POST_ID;", ["POST_ID" => $post_id], TRUE);

            if (!empty($dados)):

                foreach ($dados as $image) {
                    $file = "uploads/".$image->image_name;
                    
                    if( is_file($file) ):
                        // delete file
                        if ( !(unlink($file)) ): 

                            http_response_code(500); // Internal Server Error
                            echo json_encode([
                                "error" => true ,
                                "msg" => "Anúncio NÃO Deletado. Problema na Deleção do(s) Arquivo(s) '". $file . "' do SERVER!"
                            ]);
                            exit;

                        else:
                            // Delete Image Name from DB
                            CrudDB::setTabela('images_trade_posts');
                            $retorno = CrudDB::delete([
                                'trade_post_id' => $post_id ,
                                'image_name' => $image->image_name
                            ]);

                            if (!$retorno):
                                http_response_code(500); // Internal Server Error
                                echo json_encode([
                                    "error" => true ,
                                    "msg" => "Anúncio NÃO DELETADO. Imagem(ens) DELETADA(s) do Servidor, porém não encontradas no BANCO (" . $image->image_name . ")."
                                ]);
                                exit;
                            endif;

                        endif;
                    else:
                        http_response_code(500); // Internal Server Error
                        echo json_encode([
                            "error" => true ,
                            "msg" => "Arquivo '" . $file . "' não encontrado no Servidor!"
                        ]);
                        exit;
                    endif;
                }                                

                // Deletes TRADE POST
                CrudDB::setTabela('trade_posts');
                $retorno = CrudDB::delete(['post_id' => $post_id]);
    
                if ($retorno):
                    http_response_code(202); // Accepted
                    echo json_encode([
                        "error" => false ,
                        "msg" => "Anúncio e Imagem(ens) deletados com Sucesso!"
                    ]);
                    exit;
    
                else:
                    http_response_code(500); // Internal Server Error
                    echo json_encode([
                        "error" => true ,
                        "msg" => 'Imagens Deletadas, porém tivemos problemas na DELEÇÃO do Anúncio!'
                    ]);
                    exit;
                endif;

            else:
                http_response_code(202); // Accepted
                echo json_encode([
                    "error" => false ,
                    "msg" => 'Trade Post deletado com sucesso, porém NENHUMA Imagem relacionada foi encontrada!'
                ]);
                exit;
            endif;                           
            
        else:
            http_response_code(404); // Not Found
            echo json_encode([
                "error" => true ,
                "msg" => 'O parâmetro informado não foi encontrado'
            ]);
            exit;
        endif;
    endif;    

endif;
?>