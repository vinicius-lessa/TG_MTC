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
        $userTwo        = (isset($_GET["userTwo"])) ? $_GET["userTwo"] : "" ;
        $post_id        = (isset($_GET["post_id"])) ? $_GET["post_id"] : "" ;

        if ( Empty($userLogged) || Empty($userTwo) || Empty($post_id) ):
            http_response_code(404); // Not Found
            echo json_encode([
                'error' => true ,
                'msg' => 'Informe todos os parâmetros!'
            ]);
            exit;
        else:
            // Unique Trade Post
            if ( is_numeric($userLogged) && is_numeric($userTwo) && is_numeric($post_id) ):
                $dados = CrudDB::select(
                    'SELECT m.message_chat_guid, m.message_user_id, u.user_name, m.message, m.created_on FROM messages m
                     INNER JOIN users u ON m.message_user_id = u.user_id
                     WHERE 	m.message_user_id IN(:USER_LOGGED, :USER_TWO) AND
                            m.activity_status = 1 AND
                            EXISTS (SELECT uc.user_chat_chat_guid FROM user_chat uc WHERE uc.user_chat_chat_guid = m.message_chat_guid AND uc.user_chat_user_id = :USER_LOGGED LIMIT 1) AND
                            EXISTS (SELECT uc.user_chat_chat_guid FROM user_chat uc WHERE uc.user_chat_chat_guid = m.message_chat_guid AND uc.user_chat_user_id = :USER_TWO LIMIT 1) AND
                            m.message_chat_guid = (SELECT c.chat_guid FROM chat c WHERE c.trade_post_id =:POST_ID)
                    order by m.created_on desc limit 10;' , 
                    [                        
                        'USER_LOGGED' => $userLogged ,
                        'USER_TWO' => $userTwo ,
                        'POST_ID' => $post_id ,
                    ], TRUE);
                
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
    // $chat_id        = (isset($_POST['chat_id']))        ? intval($_POST['chat_id']) : 0     ;
    
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

    // Checa se um CHAT envolvendo o ANUNCIO para estes dois usuário já EXISTE
    $dados = 
    CrudDB::select(
        'SELECT c.chat_guid FROM chat c 
         WHERE  c.trade_post_id =:POST_ID AND 
                EXISTS (SELECT uc.user_chat_chat_guid FROM user_chat uc WHERE uc.user_chat_chat_guid = c.chat_guid AND uc.user_chat_user_id =:USER_LOGGED LIMIT 1) AND
                EXISTS (SELECT uc.user_chat_chat_guid FROM user_chat uc WHERE uc.user_chat_chat_guid = c.chat_guid AND uc.user_chat_user_id =:USER_TWO LIMIT 1) ;' ,
        [
            'POST_ID'       => $post_id ,
            'USER_LOGGED'   => $aUsers[0] ,
            'USER_TWO'      => $aUsers[1]
        ] ,
        TRUE
    );

    // Insere tabela CHAT: trade_post_id com $post_id (Somente se for uma nova conversa)
    if ( empty($dados) ):
               
        // http_response_code(500); // Internal Server Error
        // echo json_encode([
        //     'error'     => true ,
        //     'msg'       => "SELECT c.chat_guid FROM chat c 
        //     WHERE  c.trade_post_id =$post_id AND 
        //            EXISTS (SELECT uc.user_chat_chat_guid FROM user_chat uc WHERE uc.user_chat_chat_guid = c.chat_guid AND uc.user_chat_user_id =".$aUsers[0]." LIMIT 1) AND
        //            EXISTS (SELECT uc.user_chat_chat_guid FROM user_chat uc WHERE uc.user_chat_chat_guid = c.chat_guid AND uc.user_chat_user_id =".$aUsers[1]." LIMIT 1) ;"
        // ]);
        // exit;

        CrudDB::setTabela('chat');
            
        // $dbReturn = true;
        $dbReturn = CrudDB::insert([
            'trade_post_id' => "'" . $post_id . "'"
        ]);

        if ( !$dbReturn ):
            http_response_code(500); // Internal Server Error        
            echo json_encode([
                'error'     => true ,
                'msg'       => "Não foi possível enviar esta mensagem!" ,
                'msgAdmin'  => 'Erro ao Inserir novo CHAT para esta conversa'
            ]);
            exit;
        endif;

        // Se for uma nova conversa, recupera o Chat ID incluído acima
        if ( empty($chat_id) ):

            // ID do último chat criado        
            $dados = 
            CrudDB::select(
                'SELECT chat_guid FROM chat WHERE trade_post_id =:POST_ID AND activity_status = 1 ORDER BY created_on DESC LIMIT 1' ,
                ['POST_ID' => $post_id] ,
                TRUE
            );

            if ( !empty($dados) ):
                $chat_id = intval($dados[0]->chat_guid);
            else:
                http_response_code(500); // Internal Server Error
                echo json_encode([
                    'error'     => true ,
                    'msg'       => "Não foi possível enviar esta mensagem!" ,
                    'msgAdmin'  => "Erro no SELECT da tabela 'chat'."
                ]);
                exit;
            endif;

        endif;
    else:
        $chat_id = intval($dados[0]->chat_guid);
    endif;    

    if ( $chat_id != 0 && is_numeric($chat_id) ):
        
        // Insere 2 dados na tabela 'user_chat': chat_guid (id_chat) + user_id            
        foreach( $aUsers as $user_id ){
            
            // Verifica se Chat já existe para ambos os usuários
            $dados = CrudDB::select(
                'SELECT * FROM user_chat WHERE user_chat_chat_guid =:CHAT_ID AND user_chat_user_id =:USER_ID AND activity_status = 1 ORDER BY created_on DESC LIMIT 1' ,
                ['CHAT_ID' => $chat_id, 'USER_ID' => $user_id] ,
                TRUE);

            if ( empty($dados) ):

                CrudDB::setTabela('user_chat');

                // $dbReturn = true;
                $dbReturn = CrudDB::insert([
                    'user_chat_chat_guid' => "'" . $chat_id . "'" ,
                    'user_chat_user_id' => "'" . $user_id . "'"
                ]);

                if ( !$dbReturn ):
                    http_response_code(500); // Internal Server Error
                    echo json_encode([
                        'error'     => true ,
                        'msg'       => "Não foi possível enviar esta mensagem!" ,
                        'msgAdmin'  => "Erro ao inserir dados na tabela 'user_chat'."
                    ]);
                    exit;
                endif;

            endif;
        }

        // Insere dados na tabela 'messages': chat_guid (id_chat) + userID (criador da msg) + msg            
        CrudDB::setTabela('messages');

        // $dbReturn = true;
        $dbReturn = CrudDB::insert([
            'message_chat_guid' => "'" . $chat_id . "'" ,
            'message_user_id'   => "'" . $aUsers[0] . "'" , // Sempre o Usuário Logado (que enviou a mensagem) Definido em c_chat.php.
            'message'           => "'" . $newMessage . "'"
        ]);

        if ( !$dbReturn ):
            http_response_code(500); // Internal Server Error
            echo json_encode([
                'error'     => true ,
                'msg'       => "Não foi possível enviar esta mensagem!" ,
                'msgAdmin'  => "Erro ao inserir dados na tabela 'messages'."
            ]);
            exit;
        else:
            http_response_code(201); // Created
            echo json_encode([
                'error'     => true ,                    
                'msgAdmin'  => "Todos os dados foram inseridos com sucesso!."
            ]);
            exit;                
        endif;
                        
    
    else:
        http_response_code(500); // Internal Server Error
        echo json_encode([
            'error'     => true ,
            'msg'       => "Não foi possível enviar esta mensagem!" ,
            'msgAdmin'  => "O ID do Chat não pode ser encontrado."
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
    
    echo json_encode( ['verbo_http' => $_SERVER['REQUEST_METHOD']] );

endif;
?>