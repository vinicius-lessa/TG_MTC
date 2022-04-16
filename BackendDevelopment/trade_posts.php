<?php    
/**
 * File DOC
 * 
 * @Description Página de entrada para requisições do tipo GET, PUT, POST e DELETE de 'TradePosts' (Anúncios)
 * @ChangeLog 
 *  - Vinícius Lessa - 14/04/2022: Criação do arquivo e primeiras tratativas para receber a INCLUSÃO de anúncios via POST
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

    // echo json_encode( ['verbo_http' => $_SERVER['REQUEST_METHOD']] );

    // Token Validation
    if (!($_GET["token"] === '16663056-351e723be15750d1cc90b4fcd')):       
        http_response_code(401); // Unauthorized
        echo json_encode([
            'error' => true ,
            'msg' => 'Token is not Valid!'            
        ]);
        exit;
    endif;

    // Fazer Depois - Responder informações da Imagem vindas do banco, tratar a imagem como URL:
    // echo json_encode( ['image' => "http://localhost/TG_MTC/BackendDevelopment/uploads/IMG_20200421_174118.jpg"] );

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
            'msg' => 'Token is not Valid!'            
        ]);
        exit;
    endif;

    // Variables
    $title          = (isset($_POST['title']))          ? $_POST['title'] : ''              ;
    $category_id    = (isset($_POST['category']))       ? intval($_POST['category']) : 0    ;
    $price          = (isset($_POST['price']))          ? floatval($_POST['price']) : 0     ;
    $pCondition_id  = (isset($_POST['p_condition']))    ? intval($_POST['p_condition']) : 0 ;
    $possuiNF       = (isset($_POST['possuiNF']))       ? intval($_POST['possuiNF']) : 3    ;
    $user_id        = (isset($_POST['user_id']))        ? intval($_POST['user_id']) : 0             ;

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
            'msg' => 'Informe Todos os Parâmetros!'
        ]);
        exit;
    endif;

    // Checks IMAGES to UPLOAD
    if(isset($_FILES['file']['name']) && !empty($_FILES['file']['name'])){    
        
        // Check recieved values
        // echo var_dump($_FILES); // Doesn't work with JS
        // echo json_encode( ['Arquivos' => $_FILES] );
    
        // Getting file name
        $fileName = $_FILES['file']['name'];
     
        // Location
        $location       = "uploads/".$fileName;
        $fileSize       = $_FILES['file']['size'];
        $maxsize        = 4194304; //bytes (4mb)
        
        $imageFileType  = pathinfo($location,PATHINFO_EXTENSION);
        $imageFileType  = strtolower($imageFileType);
     
        // Acceptable Extensions
        $valid_extensions = array("jpg","jpeg","png");                      
        
        // File Extension Validation
        if ($fileSize > $maxsize):
            http_response_code(406); // Not Acceptable
            echo json_encode([
                'error' => true ,
                'msg'   => 'O tamanho do arquivo deve ser de no máximo 4mb!'
            ]);
            exit;
        endif;

        // File Size Validation
        if (!in_array(strtolower($imageFileType), $valid_extensions)):
            http_response_code(406); // Not Acceptable
            echo json_encode([
                'error' => true ,
                'msg'   => 'Somente os formatos jpg, jpeg e png são permitidos!'
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
            if (move_uploaded_file($_FILES['file']['tmp_name'],$location)):
                
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