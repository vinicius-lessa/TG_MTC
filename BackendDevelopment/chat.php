<?php    
/**
 * File DOC
 * 
 * @Description Página de entrada para requisições do tipo GET, PUT, POST e DELETE para CHAT entre usuários
 * @ChangeLog 
 *  - Vinícius Lessa - 19/04/2022: Criação do arquivo e primeiras tratativas para receber a INCLUSÃO de anúncios via POST, 
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
        $userLogged     = (isset($_GET["userLogged"])) ? $_GET["userLogged"] : "" ;
        $userCreator    = (isset($_GET["userCreator"])) ? $_GET["userCreator"] : "" ;
        $post_id        = (isset($_GET["post_id"])) ? $_GET["post_id"] : "" ;

        if ( Empty($userLogged) || Empty($userCreator) || Empty($post_id) ):
            http_response_code(404); // Not Found
            echo json_encode([
                'error' => true ,
                'msg' => 'Informe todos os parâmetros!'
            ]);
            exit;
        else:
            // Unique Trade Post
            if ( is_numeric($userLogged) && is_numeric($userCreator) && is_numeric($post_id) ):
                $dados = CrudDB::select(
                    'SELECT * FROM CHAT 
                     WHERE trade_post_id = '. $post_id . ' AND user_id IN(' . $userLogged . ',' . $userCreator . ') AND activity_status = true
                     ORDER BY created_on DESC;', [], TRUE);
                
                if (!empty($dados)):                    
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
                        'msg' => 'Nenhum registro de Chat encontrado.'
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
    $aUsers         = (isset($_POST['users']))          ? $_POST['users'] : ''              ;
    $post_id        = (isset($_POST['post_id']))        ? intval($_POST['post_id']) : 0     ;
    $newMessage     = (isset($_POST['newMessage']))     ? $_POST['newMessage'] : 0          ;
    $chat_id        = (isset($_POST['p_condition']))    ? intval($_POST['p_condition']) : 0 ;
    
    // Check Recieved Data
    // http_response_code(201);
    // echo json_encode([
    //     'error' => true ,
    //     'msg'   => 'Teste' ,
    //     'dados' => $_POST
    // ]);
    // exit;

    
    if (empty($aUsers) or
        empty($newMessage) or
        $post_id    == 0        
        ):
        http_response_code(406);
        echo json_encode([
            'error' => true ,
            'msg' => 'Erro: Informe Todos os Parâmetros!'
        ]);
        exit;
    endif;

    // Insere dados na tabela CHAT: post_id

    // recolhe ID do último chat criado

    // Insere 2 dados na tabela 'user_chat': chat_guid (id_chat) + userLogged  e userTwo

    // Insere dados na tabela 'messages': chat_guid (id_chat) + userID (criador da msg)

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
    
    echo json_encode( ['verbo_http' => $_SERVER['REQUEST_METHOD']] );

endif;
?>