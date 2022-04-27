<?php    
/**
 * File DOC
 * 
 * @Description Página de entrada para requisições do tipo GET, PUT, POST e DELETE de 'TradePosts' (Anúncios)
 * @ChangeLog 
 *  - Vinícius Lessa - 14/04/2022: Criação do arquivo e primeiras tratativas para receber a INCLUSÃO de anúncios via POST,
 *  - Vinícius Lessa - 16/04/2022: Implementação da tratativa POST para inclusão de anúncios com imagens.
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
header('Content-type: application/json; charset=UTF-8');

require_once 'classes/Class.Crud.php';

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

    // echo json_encode( ['verbo_http' => $_SERVER['REQUEST_METHOD']] );

    // Token Validation
    if (!($_GET["token"] === '16663056-351e723be15750d1cc90b4fcd')):       
        http_response_code(401); // Unauthorized
        echo json_encode([
            'error' => true ,
            'msg' => 'Erro: Token is not Valid!'            
        ]);
        exit;
    endif;

    if ( !Empty($uri) && $uri <> 'index.php' ):

        // Variables
        $keySearch  = (isset($_GET["key"]))     ? $_GET["key"] : "" ;
        $user_id    = (isset($_GET['user_id'])) ? intval($_GET['user_id']) : '';

        if (Empty($keySearch)):
            http_response_code(404); // Not Found
            echo json_encode([
                'error' => true ,
                'msg' => 'Informe todos os parâmetros!'
            ]);
            exit;
        else:
            // Unique Trade Post
            if (is_numeric($keySearch)):
                $dados = CrudDB::select(
                    'SELECT 
                        tp.post_id 					,
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
                        u.phone 					,
                        tp.price					,
                        tp.eletronic_invoice 		,
                        tp.created_on				,
                        itp.image_name as image_name
                    FROM trade_posts tp 
                    INNER JOIN product_categorys pc ON tp.category_id  = pc.category_id
                    INNER JOIN product_brands pb ON tp.brand_id = pb.brand_id
                    INNER JOIN product_models pm ON tp.model_id = pm.model_id 
                    INNER JOIN colors c ON tp.color_id  = c.color_id
                    INNER JOIN product_conditions pc2 ON tp.condition_id = pc2.condition_id 
                    INNER JOIN users u ON tp.user_id = u.user_id
                    INNER JOIN images_trade_posts itp ON tp.post_id  = itp.trade_post_id
                    WHERE 
                        tp.post_id          =:POST_ID AND
                        tp.activity_status  = 1
                    ORDER BY tp.created_on DESC LIMIT 1;', 
                    [
                        'POST_ID' => $keySearch
                    ], TRUE);
                
                if (!empty($dados)):                    
                    foreach ($dados as $tradePost) {
                        $tradePost->image_name = SITE_URL . "/uploads/" . $tradePost->image_name;
                    }

                    http_response_code(200); // Success
                    echo json_encode([
                        'error' => false ,
                        'data' => $dados
                    ]);
                    exit;
                else:
                    http_response_code(200); // Success
                    echo json_encode([
                        'error' => true ,
                        'msg' => 'Erro: O Anúncio solicitado não foi encontrado!'
                    ]);
                    exit;
                endif;

            // All Trade Posts
            elseif ($keySearch == 'all'):
                
                $dados = CrudDB::select(
                    'SELECT 
                        tp.post_id , 
                        tp.title ,
                        tp.description as tp_desc 	,
                        tp.user_id ,
                        u.user_name ,
                        tp.category_id ,
                        pc.description , 
                        tp.price , 
                        itp.image_name as image_name 
                    FROM trade_posts tp 
                    INNER JOIN users u ON tp.user_id = u.user_id
                    INNER JOIN product_categorys pc ON tp.category_id  = pc.category_id
                    INNER JOIN images_trade_posts itp ON tp.post_id  = itp.trade_post_id                    
                    where tp.activity_status = 1 ' . (!empty($user_id) ? 'and tp.user_id =:USER_ID ' : '') .
                    'ORDER BY tp.created_on DESC LIMIT 12;',
                    [
                        'USER_ID' => $user_id
                    ], TRUE);                        

                if (!empty($dados)):
                    foreach ($dados as $tradePost) {
                        $tradePost->image_name = SITE_URL . "/uploads/" . $tradePost->image_name;
                    }

                    http_response_code(200); // Success
                    echo json_encode([
                        'error' => false ,
                        'data' => $dados
                    ]);
                    exit;                  
                else:
                    http_response_code(200); // Success
                    echo json_encode([
                        'error' => true ,
                        'msg' => 'Erro: Nenhum anúncio Encontrado!'            
                    ]);
                    exit;
                endif;
            endif;
        endif;            
    else:                
        http_response_code(406); // Not Acceptable
        echo json_encode(['msg' => 'Parâmetro não preenchido na consulta!']);
    endif;

endif;


#############################################################################################

// # POST (INCLUSÃO)
// No INSOMINIA, utilizar o "MULTIPART FORM" (Structured)
if ($_SERVER['REQUEST_METHOD'] == 'POST'):
    
    // echo json_encode( ['verbo_http' => $_SERVER['REQUEST_METHOD']] );

    // Token Validation
    if (!($_POST["token"] === '16663056-351e723be15750d1cc90b4fcd')):
        http_response_code(401); // Unauthorized
        echo json_encode([
            'error' => true ,
            'msg' => 'Erro: Token is not Valid!'            
        ]);
        exit;
    endif;

    // Variables
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
    
    $imageUpload    = false; // By default, image upload will not happen

    // Check Recieved Data
    // echo json_encode([
    //     'error' => true ,
    //     'msg'   => 'Teste' ,
    //     'dados' => $_POST
    // ]);
    // exit;

    // echo json_encode([
    //     'error' => true ,
    //     'msg'   => 'Teste' ,
    //     'dados' => [
    //         "title"      => $title ,
    //         "category"   => $category_id ,
    //         "price"      => $price ,
    //         "condition"  => $p_condition_id ,
    //         "nf"         => $possuiNF ,
    //     ]
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
            'error' => true ,
            'msg' => 'Erro: Informe Todos os Parâmetros!'
        ]);
        exit;
    endif;

    // Checks IMAGES to UPLOAD
    if(isset($_FILES['file']['name']) && !empty($_FILES['file']['name'])){    
        
        // Check recieved values
        // echo var_dump($_FILES); // Doesn't work with JS
        // echo json_encode( ['Arquivos' => $_FILES] );

        // Extension
        $imageFileType  = strrchr($_FILES['file']['name'], ".");
        $imageFileType  = strtolower($imageFileType);

        // Getting and Defining file name
        $data = new DateTime();
        $fileName = "imagem-" . $data->format('Y-m-d') . "_" . rand(1, 9999) . $imageFileType;
     
        // Locations
        $tmpLocation       = $_FILES['file']['tmp_name'];
        $newLocation       = "uploads/".$fileName;
   

        // File Sizes
        $fileSize       = $_FILES['file']['size'];
        $maxsize        = 4194304; //bytes (4mb)        

        // Acceptable Extensions
        $valid_extensions = array("jpg","jpeg","png");                      
        
        // File Extension Validation
        if ($fileSize > $maxsize):
            http_response_code(406); // Not Acceptable
            echo json_encode([
                'error' => true ,
                'msg'   => 'Erro: O tamanho do arquivo deve ser de no máximo 4mb!'
            ]);
            exit;
        endif;

        // File Size Validation
        if (!in_array(substr(strtolower($imageFileType), 1), $valid_extensions)):
            http_response_code(406); // Not Acceptable
            echo json_encode([
                'error' => true ,
                'msg'   => 'Erro: Somente os formatos jpg, jpeg e png são permitidos!'
            ]);
            exit;
        endif;

        $imageUpload = true;
    }

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
            if (move_uploaded_file($tmpLocation, $newLocation)):
                
                // TradePost ID
                $dados = CrudDB::select('SELECT post_id FROM trade_posts WHERE user_id =:USER_ID  ORDER BY created_on DESC LIMIT 1'
                            ,['USER_ID' => $user_id]
                            ,TRUE);
                
                if (!Empty($dados)):
                    CrudDB::setTabela('images_trade_posts');

                    $dbReturnTwo = CrudDB::insert ([
                        'image_name'    => "'" . $fileName . "'" ,
                        'trade_post_id' => "'" . intval($dados[0]->post_id) . "'" ,
                    ]);
        
                    if ($dbReturnTwo):
                        http_response_code(201); // Created
                        echo json_encode([
                            'error' => false ,
                            'msg' => "Anúncio incluído com êxito!"
                        ]);
                        exit;
                    else:
                        http_response_code(500); // Internal Server Error                        
                        echo json_encode([
                            'error' => false ,
                            'msg' => "Anúncio incluído, porém tivemos um Erro na Gravação das imagens no Banco"
                        ]);
                        exit;
                    endif;            
                else: 
                    http_response_code(500); // Internal Server Error                    
                    echo json_encode([
                        'error' => false ,
                        'msg' => "Anúncio incluído mas não encontrado para relacionar imagens!"
                    ]);
                    exit;
                endif;
            else:
                http_response_code(500); // Internal Server Error
                echo json_encode([
                    'error' => true ,
                    'msg'   => 'Anúncio incluído, porém tivemos um Erro no Upload da(s) imagem(ns) ao Servidor'
                ]);
                exit;
            endif;
        else:
            http_response_code(201); // Created
            echo json_encode([
                'error' => false ,
                'msg' => "Anúncio incluído com êxito!"
            ]);
            exit;        
        endif;

    else:            
        http_response_code(500); // Internal Server Error        
        echo json_encode([
            'error' => true ,
            'msg'   => 'Erro ao Inserir Anúncio no Banco de Dados'
        ]);
        exit;
    endif;

endif;




#############################################################################################

// **************** PUT (ALTERAÇÃO)
// No INSOMINIA, utilizar o "FORM URL ENCODED" (Structured)
if ($_SERVER['REQUEST_METHOD'] == 'PUT'):
    
    echo json_encode( ['verbo_http' => $_SERVER['REQUEST_METHOD']] );

endif;


#############################################################################################

// ********************* DELETE
if ($_SERVER['REQUEST_METHOD'] == 'DELETE'):
    
    // echo json_encode( ['verbo_http' => $_SERVER['REQUEST_METHOD']] );

endif;
?>