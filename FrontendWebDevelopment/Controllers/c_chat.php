<?php
/**
 * File DOC
 * 
 * @Description Controller que recebe requisições GET pelo JS sobre o Chat entre usuários (Views/chat.php).
 * @ChangeLog 
 *  - Vinícius Lessa - 19/04/2022: Criação do arquivo e inclusão da documentação inicial.
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


if ( isset($_GET['userLogged']) && isset($_GET['userCreator']) && isset($_GET['post_id']) ):
    $userLogged     = $_GET['userLogged'];
    $userCreator    = $_GET['userCreator'];
    $post_id        = $_GET['post_id'];    

    $response = selectChat($userLogged, $userCreator, $post_id);

    // print_r($response['data']);

	foreach ($response['data'] as $chatRow) {
		echo "<h3>" . $chatRow['user_name'] . "</h3>";
		echo "<h5>" . $chatRow['message'] . "</h5>";
	}    

    // echo "<h3>Vinícius Lessa</h3>"; 
    // echo "<h5>Olá, bom dia!</h5>";

    // echo "<h3>Renata Carrillo</h3>"; 
    // echo "<h5>Olá, como posso ajudar?</h5>";

else:
    echo "Error, User Not Logged In";

endif;

?>