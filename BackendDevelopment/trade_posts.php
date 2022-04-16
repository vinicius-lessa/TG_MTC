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

    echo json_encode( ['verbo_http' => $_SERVER['REQUEST_METHOD']] );

    // Token Validation
    // if (!($_GET["token"] === '16663056-351e723be15750d1cc90b4fcd')):       
    //     http_response_code(401); // Unauthorized
    //     echo json_encode(['msg' => 'Token is not Valid!']);
    //     exit;
    // endif;

endif;


#############################################################################################

// # POST (INCLUSÃO)
// No INSOMINIA, utilizar o "MULTIPART FORM" (Structured)
if ($_SERVER['REQUEST_METHOD'] == 'POST'):
    
    // echo json_encode( ['verbo_http' => $_SERVER['REQUEST_METHOD']] );

    // Token Validation
    // if (!($_POST["token"] === '16663056-351e723be15750d1cc90b4fcd')):        
    //     http_response_code(401); // Unauthorized
    //     echo json_encode(['msg' => 'Token is not Valid!']);
    //     exit;
    // endif;

    if(isset($_FILES['file']['name']) && !empty($_FILES['file']['name'])){
    // if(isset($_FILES)){

        // echo var_dump($_FILES); // Doesn't work in JS
        // echo json_encode( ['Arquivos' => $_FILES] );
    
        // Getting file name
        $filename = $_FILES['file']['name'];
     
        // Location
        $location       = "uploads/".$filename;
        $size           = $_FILES['file']['size'];
        $maxsize        = 4194304; //bytes (4mb)
        
        $imageFileType  = pathinfo($location,PATHINFO_EXTENSION);
        $imageFileType  = strtolower($imageFileType);
     
        // Valid extensions
        $valid_extensions = array("jpg","jpeg","png");                      
        
        // Check file extension
        if ($size <= $maxsize && in_array(strtolower($imageFileType), $valid_extensions)):            
                
            // Upload file
            if(move_uploaded_file($_FILES['file']['tmp_name'],$location)):
                $response = "The image was successfully uploaded at: " . $location;
            endif;
        else:
            
            $response = "An error occurred while the file uploading! Check the file extension and make sure the image size is less than 3000kb";
        endif;
        
        echo json_encode(['Response: ' => $response]);
        exit;
    }

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