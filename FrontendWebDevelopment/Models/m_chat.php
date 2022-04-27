<?php
/**
 * File DOC
 * 
 * @Description Model que tem a função de buscar informações do Chat do Bando de Dados.
 * @ChangeLog 
 *  - Vinícius Lessa - 19/04/2022: Criação do arquivo e inclusão da documentação inicial.
 *  - Vinícius Lessa - 21/04/2022: Início da implementação da função newMessage para inserção de mensagens no Banco de Dados.
 * 
 * @ Notes: 
 * 
 */


// FUNCTIONS

function newMessage($data) {
    // Variables
    $token      = "16663056-351e723be15750d1cc90b4fcd";
    $url        = 'http://localhost/TG_MTC/BackendDevelopment/chat.php/';
    
    $data       += ["token" => $token];

    $postdata = http_build_query(
        $data
    );
    
    $opts = array('http' =>
        array(
            'method'        => 'POST',
            'header'        => 'Content-Type: application/x-www-form-urlencoded',
            'ignore_errors' => true,
            'content'       => $postdata
        )
    );
    
    $context  = stream_context_create($opts);
    
    // file_get_contents
    $returnJson = file_get_contents($url, false, $context);
    
    // Tranforms Json in Array
    $aData = json_decode($returnJson, true); // Trasnforma em Array

    // Servers Problems // ***************** VERIFICAR STATUS DO SERVER NO INÍCIO DE CADA PÁGINA **********************
    // if (count($aData) == 0 || $aData == false):
    //     $aData = array("erro" => true , "msg" => "A requisição ao Servidor falhou! Tente Novamente" );
    // endif;

    // Query/DB Problems
    $status_line = $http_response_header[0];
    preg_match('{HTTP\/\S*\s(\d{3})}', $status_line, $match);
    $status = $match[1];

    // if ($status !== "201") {
    //     $aReturn = [
    //         'error'      => true , 
    //         'msg'       => "<div class='alert alert-danger' role='alert'>Erro: ". $aData['msg'] . "</div>" ,
    //         'msgAdim'   => $aData['msg'] ,
    //     ];

    //     return $aReturn;
    // }

    // Success
    return $aData;
}

function refreshChat($userLogged, $userTwo, $post_id){

    $token  = "16663056-351e723be15750d1cc90b4fcd";
    $url    = "http://localhost/TG_MTC/BackendDevelopment/chat.php/?token=" . $token . "&userLogged=" . $userLogged . "&userTwo=" . $userTwo . "&post_id=" . $post_id . "&key=refreshChat";

    $opts = array('http' =>
        array(
            'method'        =>"GET",
            'header'        => 'Content-Type: application/x-www-form-urlencoded',
            'ignore_errors' => true
        )
    );
        
    $context = stream_context_create($opts);

    // file_get_contents
    $returnJson = file_get_contents($url, false, $context);

    // Tranforms Json in Array
    $aData = json_decode($returnJson, true); // Trasnforma em Array

    if (count($aData) == 0 || $aData == false):
        $aData = ['erro'=> true, 'msg' => "<div class='alert alert-danger' role='alert'>Erro: Problemas na requisição ao Servidor!</div>"];
    endif;   
    
    // $sql = $pdo->query("SELECT * FROM chat1");

    // foreach ($sql->fetchAll() as $key) {
    //     echo "<h3>".$key['nome']."</h3>";
    //     echo "<h5>".$key['mensagem']."</h5>";
    // }

    return $aData;
}


function getOtherChats($userLogged){

    $token  = "16663056-351e723be15750d1cc90b4fcd";
    $url    = "http://localhost/TG_MTC/BackendDevelopment/chat.php/?token=" . $token . "&userLogged=" . $userLogged . "&key=chatList";

    $opts = array('http' =>
        array(
            'method'        =>"GET",
            'header'        => 'Content-Type: application/x-www-form-urlencoded',
            'ignore_errors' => true
        )
    );
        
    $context = stream_context_create($opts);

    // file_get_contents
    $returnJson = file_get_contents($url, false, $context);

    // Tranforms Json in Array
    $aData = json_decode($returnJson, true); // Trasnforma em Array

    if (count($aData) == 0 || $aData == false):
        $aData = ['erro'=> true, 'msg' => "<div class='alert alert-danger' role='alert'>Erro: Problemas na requisição ao Servidor!</div>"];
    endif; 
    
    // $sql = $pdo->query("SELECT * FROM chat1");

    // foreach ($sql->fetchAll() as $key) {
    //     echo "<h3>".$key['nome']."</h3>";
    //     echo "<h5>".$key['mensagem']."</h5>";
    // }

    return $aData;
}

?>