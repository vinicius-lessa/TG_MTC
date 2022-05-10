<?php    
/**
 * File DOC
 * 
 * @Description Página de entrada para requisições do tipo GET, PUT, POST e DELETE para CHAT entre usuários
 * @ChangeLog 
 *  - Vinícius Lessa - 19/04/2022: Criação do arquivo e primeiras tratativas para receber a INCLUSÃO de anúncios via POST.
 *  - Vinícius Lessa - 26/04/2022: Reformulação da query de GET dos chats, pois estava com erro quando um mesmo POST tinha mais de um chat.
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
    // exit;

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
        $keysearch      = (isset($_GET["key"])) ? $_GET["key"] : "" ;
        $userLogged     = (isset($_GET["userLogged"])) ? $_GET["userLogged"] : "" ;
        $userTwo        = (isset($_GET["userTwo"])) ? $_GET["userTwo"] : "" ;
        $post_id        = (isset($_GET["post_id"])) ? $_GET["post_id"] : "" ;        

        if ( empty($keysearch) ):
            http_response_code(404); // Not Found
            echo json_encode([
                'error' => true ,
                'msg' => "Preencha o tipo de pesquisa ('&key=')"
            ]);
            exit;
        endif;

        // ...chat.php/?token=16663056-351e723be15750d1cc90b4fcd&userLogged=4&userTwo=14&post_id=204&key=refreshChat
        if ( $keysearch == "refreshChat" ):
            if ( empty($userLogged) || empty($userTwo) || empty($post_id) ):
                http_response_code(404); // Not Found
                echo json_encode([
                    'error' => true ,
                    'msg' => "Preencha os parâmetros para a atualização do Chat!"
                ]);
                exit;
            endif;
        
            if ( is_numeric($userLogged) && is_numeric($userTwo) && is_numeric($post_id) ):
                $dados = CrudDB::select(
                    'SELECT c.chat_guid, m.message_user_id, u.user_name, m.message, m.created_on from chat c
                     INNER JOIN messages m ON m.message_chat_guid = c.chat_guid
                     INNER JOIN users u ON m.message_user_id = u.user_id
                     where 	c.trade_post_id = :POST_ID and
                            c.activity_status = 1 and 
                            m.activity_status = 1 and
                            m.message_user_id in (:USER_TWO, :USER_LOGGED) and
                            exists (select uc.user_chat_chat_guid from user_chat uc where uc.user_chat_chat_guid = m.message_chat_guid and uc.user_chat_user_id = :USER_LOGGED limit 1) and
                            exists (select uc.user_chat_chat_guid from user_chat uc where uc.user_chat_chat_guid = m.message_chat_guid and uc.user_chat_user_id = :USER_TWO limit 1)
                     order by m.created_on desc limit 10;',
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
                        'msg' => 'Nenhuma mensagem anterior encontrada.'
                    ]);
                    exit;
                endif;
            else:
                http_response_code(406); // Not Acceptable
                echo json_encode([
                    'error' => true ,
                    'msg' => 'Parâmetros não são Numéricos!'
                ]);
                exit;
            endif;

        // ...chat.php/?token=16663056-351e723be15750d1cc90b4fcd&userLogged=4&key=chatList
        elseif ( $keysearch == "chatList" && !(empty($userLogged)) ):
            if ( is_numeric($userLogged) ):
                $dados = CrudDB::select(
                    "SELECT 
                    c.chat_guid 			AS `chat_id`	,
                    c.trade_post_id 		AS `post_id`	,
                    tp.title 				AS `post_title` ,
                    tp.user_id 				AS `userid_tp_creator` ,
                    (SELECT u3.user_name 
                        FROM users u3
                        WHERE 	u3.activity_status = 1 AND
                                u3.user_id = userid_tp_creator
                    ) AS `username_tp_creator` ,
                    uc.user_chat_user_id 	AS `user_id` 	,
                    (SELECT uc2.user_chat_user_id
                        FROM user_chat uc2 
                        WHERE 	uc2.activity_status = 1 AND
                                uc2.user_chat_chat_guid = c.chat_guid AND
                                uc2.user_chat_user_id !=:USER_ID
                    ) AS `userTwo` 	,
                    (SELECT m.message_user_id 
                        FROM messages m
                        WHERE	m.activity_status 	= 1 AND
                                m.message_chat_guid = c.chat_guid AND
                                m.message_user_id IN (userTwo, :USER_ID)
                        order by m.created_on DESC LIMIT 1
                    ) AS 'userid_lastmessage' ,
                    (SELECT m.message
                        FROM messages m
                        WHERE	m.activity_status 	= 1 AND
                                m.message_chat_guid = c.chat_guid AND
                                m.message_user_id IN (userTwo, :USER_ID)
                        order by m.created_on DESC LIMIT 1
                    ) AS 'last_message' ,	
                    (SELECT u2.user_name 
                        FROM users u2 
                        WHERE 	u2.activity_status = 1 AND
                                u2.user_id = userid_lastmessage
                    ) AS 'username_lastmessage' ,	
                    (SELECT m.created_on 
                        FROM messages m
                        WHERE	m.activity_status 	= 1 AND
                                m.message_chat_guid = c.chat_guid AND
                                m.message_user_id IN (userTwo, :USER_ID)
                        order by m.created_on DESC LIMIT 1
                    ) AS 'message_date' ,	
                    itp.image_name  AS `image_name`
                    FROM user_chat uc
                    INNER JOIN chat c ON c.chat_guid = uc.user_chat_chat_guid
                    INNER JOIN users u ON u.user_id = uc.user_chat_user_id
                    INNER JOIN trade_posts tp ON tp.post_id = c.trade_post_id
                    left JOIN images_trade_posts itp ON itp.trade_post_id = c.trade_post_id
                    WHERE c.activity_status = 1 AND	  
                        uc.user_chat_user_id =:USER_ID
                    order by 'message_date', userid_tp_creator desc;",
                    [                        
                        'USER_ID' => $userLogged
                    ], TRUE);
                
                if ( !empty($dados) ):
                    foreach ($dados as $chat) {
                        $chat->image_name = SITE_URL . "/uploads/" . $chat->image_name;
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
                        'msg' => 'Nenhum registro de Chat encontrado.'
                    ]);
                    exit;
                endif;
            else:
                http_response_code(406); // Not Acceptable
                echo json_encode([
                    'error' => true ,
                    'msg' => 'Parâmetros não são Numéricos!'
                ]);
                exit;
            endif; 
        else:
            http_response_code(404); // Not Found
            echo json_encode([
                'error' => true ,
                'msg' => "Parâmetros inválidos!"
            ]);
            exit;            
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
                'error'     => false ,
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