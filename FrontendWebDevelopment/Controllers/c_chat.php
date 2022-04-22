<?php
/**
 * File DOC
 * 
 * @Description Controller que recebe requisições GET pelo JS sobre o Chat entre usuários (Views/chat.php).
 * @ChangeLog 
 *  - Vinícius Lessa - 19/04/2022: Criação do arquivo e inclusão da documentação inicial.
 *  - Vinícius Lessa - 21/04/2022: Início da implementação do processo de gravaçaõ de mensagens no banco de dados, recebendo via método POST do JS da página "chat.php".
 * 
 * @ Notes: 
 * 
 */

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!defined('SITE_URL')) {
    include_once '../config.php';
}

// External Functions
include SITE_PATH . '/Models/m_chat.php';


// Vars
$dados = (filter_input_array(INPUT_POST, FILTER_DEFAULT) != null ? filter_input_array(INPUT_POST, FILTER_DEFAULT) : ["action" => "null"] ); // Recieve Post values into $dados


// RECORD NEW MESSAGE
// if ( isset($_POST['newMessage']) ):
if ($dados['action'] === "newMessage"):
    
    if ( isset($dados['userTwo']) && isset($dados['post_id']) && isset($dados['newMessage']) ):        
        
        $users      = [0 => $dados['userLogged'], 1 => $dados['userTwo']];
        $post_id    = $dados['post_id'];
        $newMessage = $dados['newMessage'];

        $chat_id    = isset($_POST['chat_id']) ? $_POST['chat_id'] : null ;
        
        $data = [
            "users"         =>  $users ,
            "post_id"       =>  $post_id ,
            "newMessage"    =>  $newMessage ,
            "chat_id"       =>  $chat_id 
        ];

        $response = newMessage($data);
        
        echo json_encode($response);
        exit;
    
    else:
        echo json_encode([
            'error' => true ,
            'msg'   => 'Parâmetros não informados!'
        ]);
        
        return;
    endif;
endif;

return;


// REFRESH MESSAGES
// if ( isset($_GET['userLogged']) && isset($_GET['userCreator']) && isset($_GET['post_id']) ):
//     $userLogged     = $_GET['userLogged'];
//     $userCreator    = $_GET['userCreator'];
//     $post_id        = $_GET['post_id'];    

//     $response = selectChat($userLogged, $userCreator, $post_id);

//     // print_r($response['data']);

// 	foreach ($response['data'] as $chatRow) {
// 		echo "<h3>" . $chatRow['user_name'] . "</h3>";
// 		echo "<h5>" . $chatRow['message'] . "</h5>";
// 	}    

//     // echo "<h3>Vinícius Lessa</h3>"; 
//     // echo "<h5>Olá, bom dia!</h5>";

//     // echo "<h3>Renata Carrillo</h3>"; 
//     // echo "<h5>Olá, como posso ajudar?</h5>";

// else:
//     echo "Error, User Not Logged In";

// endif;

?>