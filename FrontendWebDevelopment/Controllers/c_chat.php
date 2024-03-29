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

date_default_timezone_set('America/Sao_Paulo');


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
        
        if ( $dados['userLogged'] === $dados['userTwo'] ):
            $users      = [0 => $dados['userLogged']];
        else:            
            $users      = [0 => $dados['userLogged'], 1 => $dados['userTwo']];
        endif;
        
        $post_id    = $dados['post_id'];
        $newMessage = $dados['newMessage'];

        // $chat_id    = isset($_POST['chat_id']) ? $_POST['chat_id'] : null ;
        
        $data = [
            "users"         =>  $users ,
            "post_id"       =>  $post_id ,
            "newMessage"    =>  $newMessage
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


// GET OTHER CHATS
if ( isset($a_OtherChats) && isset($userLogged) ):
    $a_OtherChats = getOtherChats($userLogged);
    return;
endif;


// REFRESH MESSAGES
if ( isset($_GET['userLogged']) && isset($_GET['userTwo']) && isset($_GET['post_id']) ):
    
    $userLogged = $_GET['userLogged'];
    $userTwo    = $_GET['userTwo'];
    $post_id    = $_GET['post_id'];

    $response = refreshChat($userLogged, $userTwo, $post_id);

    // print_r($response);

    if ( !$response['error'] ):                

        foreach ($response['data'] as $chatRow) {

            if ( $chatRow['message_user_id'] == $_SESSION['user_id'] ):
                echo "
                    <div class='d-flex flex-row-reverse mx-2'>
                        <div class='mb-1 rounded msg-width msg-user'>
                            <div class='m-0 mt-2 message-default'>
                                <!-- <div class='col-12 mt-1 p-0 px-2'>
                                    <strong><span>Você</span></strong>
                                </div> -->
                                <div class='col-12 mb-0 d-flex flex-row-reverse p-0 px-2'>
                                    <div class='m-0 p-0'>
                                        <span>". $chatRow['message'] ."</span>
                                    </div>
                                </div>
                                <div class='d-flex flex-row-reverse mx-1 mb-0 p-0 size-12 text-gray' style='transform: translate(0px, -2px);'>
                                    <span>" . date("H:i", strtotime($chatRow['created_on']) ) ."</span>
                                </div>
                            </div>
                        </div>
                    </div>";
            else:
                echo "                
                    <div class='d-flex flex-row'>
                        <div class='my-1 bk-gray rounded msg-width'>
                            <div class='m-0 mt-2 message-default'>
                                <div class='col-12 mt-1 p-0 px-2'>
                                    <strong><span>". $chatRow['user_name'] ."</span></strong>
                                </div>
                                <div class='col-12 mb-0 p-0 px-2'>
                                    <div class='m-0 p-0'>
                                        <span>". $chatRow['message'] ."</span>
                                    </div>                                
                                </div>
                                <div class='d-flex flex-row-reverse mx-1 mb-0 p-0 size-12 text-gray' style='transform: translate(0px, -2px);'>
                                    <span>" . date("H:i", strtotime($chatRow['created_on']) ) . "</span>
                                </div>
                            </div>
                        </div>
                    </div>";
            endif;                                                      
        }

        // Dia da Conversa
        $chatDate = ( date("Y-m-d") == date("Y-m-d", strtotime($chatRow['created_on'])) ? "Hoje" : str_replace("-", "/", date('d-m-Y', strtotime( $chatRow['created_on'] ))) );

        echo "<div class='col-12 my-3'>
                <div class='d-flex justify-content-center'>
                    <div class='py-2 px-4' style='background-color: black; border-radius: 10px;'>
                        <span>" . $chatDate . "</span>
                    </div>
                </div>
            </div>";
    else:            
            
        echo 200; // nenhuma conversa encontrada        
        exit;
        
    endif;
    
// else:
//     echo json_encode([
//         'cod'   =>  500,
//         'msg'   =>  'Preencha todos os parâmetros.'
//     ]);
//     exit;

endif;

?>