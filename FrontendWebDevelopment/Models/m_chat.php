<?php
/**
 * File DOC
 * 
 * @Description Model que tem a função de buscar informações do Chat do Bando de Dados.
 * @ChangeLog 
 *  - Vinícius Lessa - 19/04/2022: Criação do arquivo e inclusão da documentação inicial.
 * 
 * @ Notes: 
 * 
 */


// FUNCTIONS

function selectChat($userLogged, $userCreator, $post_id){

    $token  = "16663056-351e723be15750d1cc90b4fcd";
    $url    = "http://localhost/TG_MTC/BackendDevelopment/chat.php/?token=" . $token . "&userLogged=" . $userLogged . "&userCreator=" . $userCreator . "&post_id=" . $post_id;

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