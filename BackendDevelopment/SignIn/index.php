<?php    
/**
 * File DOC
 * 
 * @Description Here the USERS table is manipulated
 * @ChangeLog 
 *  - Vinícius Lessa - 27/05/2022: Criação da Nova Rota 'SignIn' e do arquivo Index.php. Início da implementação da autenticação de usuário no BackEnd, a partir de uma requisição POST.
 * 
 * @ Tips & Tricks: 
 *      - Use this to check the method type: echo json_encode( ['verbo_http' => $_SERVER['REQUEST_METHOD']] );
 *  
 */
 
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS');
header('Content-type: application/json; charset=UTF-8');

require_once '../classes/Class.Crud.php';
require_once '../classes/WebServices/Class.ViaCEP.php';

if (!defined('SITE_URL')) {
    include_once '../config.php';
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

    // For example:  .../users.php/?token=...&key=allUsers
    // For example: .../users.php/?token=...&key=id&value=7
    // For example: .../users.php/?token=...&key=email&value=vinicius@gmail.com

    echo json_encode( ['verbo_http' => $_SERVER['REQUEST_METHOD']] );
    exit;
    
endif;


#############################################################################################

// # POST (CREATE e UPDATE)
// No INSOMINIA, utilizar o "MULTIPART FORM" (Structured)
if ($_SERVER['REQUEST_METHOD'] == 'POST'):
    
    // Possíveis Requisições:
    // - Autenticação de Usuário: '/SignIn/index.php'
    //      - Token + E-mail + Password

    // echo json_encode( ['verbo_http' => $_SERVER['REQUEST_METHOD']] );
    // exit;

    // Token Validation
    if (!($_POST["token"] === '16663056-351e723be15750d1cc90b4fcd')):
        http_response_code(401); // Unauthorized
        echo json_encode([
            'error' => true , 
            'msg' => 'Token is not Valid!'
        ]);
        exit;
    endif;

    // Vars
    $userEmail      = (isset($_POST['userEmail'])) ? $_POST['userEmail'] : '' ;
    $userPassword   = (isset($_POST['userPassword'])) ? $_POST['userPassword'] : '' ;    

    if (empty($userEmail) or
        empty($userPassword)
        ):
        http_response_code(406); // Not Acceptable
        echo json_encode([
            'error' => true , 
            'msg' => 'Informe Todos os Parâmetros!'
        ]);
        exit;
    endif;        
        
    // Autentication        

    if (!is_numeric($userEmail)):
        $dbReturn = CrudDB::select(
            'SELECT
                u.user_id, 
                u.user_name, 
                u.email, 
                u.password as `password` ,
                (SELECT ip.image_name FROM images_profile ip 
                    WHERE ip.user_id = u.user_id AND
                        ip.activity_status = 1
                    ORDER BY ip.created_on desc limit 1) AS `image_name`
            FROM users u 
            WHERE u.email =:USER_EMAIL AND 
                activity_status = 1 
            ORDER BY u.created_on DESC LIMIT 1;'
            ,['USER_EMAIL' => $userEmail]
            ,TRUE);
        
        if ( !empty($dbReturn) && !empty($dbReturn[0]->password) ):

            if ( password_verify($userPassword, $dbReturn[0]->password) ):                
                
                // Se possuir Imagem de Perfil
                if ( !empty($dbReturn[0]->image_name) ):
                    foreach ($dbReturn as $user) {
                        if ( !empty($user->image_name) ):
                            $user->image_name = SITE_URL . "/uploads/user-profile/" . $user->image_name;
                        endif;
                    }
                endif;

                http_response_code(200); // Success
                echo json_encode([
                    'error' => false ,
                    'data'  => $dbReturn[0] ,
                    'msg' => 'Login Efetuado com Sucesso!'
                ]);
                exit;
            else:                

                http_response_code(406); // Not Acceptable
                echo json_encode([
                    'error' => true ,
                    'msg'   => 'Usuário ou a senha inválida!'
                ]);
                exit;
            endif;

        else:
            http_response_code(406); // Not Acceptable
            echo json_encode([
                'error' => true ,
                'msg'   => 'Usuário ou a senha inválida!'
            ]);
            exit;
        endif;

    else:                    
        http_response_code(406); // Not Acceptable
        echo json_encode(['msg' => 'Parâmetro E-mail inválido!']);
        exit;
    endif;

endif;


#############################################################################################

// **************** PUT (ALTERAÇÃO)
// No INSOMINIA, utilizar o "FORM URL ENCODED" (Structured)
if ($_SERVER['REQUEST_METHOD'] == 'PUT'):
    
    echo json_encode( ['verbo_http' => $_SERVER['REQUEST_METHOD']] );
    exit;
    
endif;


#############################################################################################

// ********************* DELETE
if ($_SERVER['REQUEST_METHOD'] == 'DELETE'):
    
    echo json_encode( ['verbo_http' => $_SERVER['REQUEST_METHOD']] );
    exit;
    
endif;
?>