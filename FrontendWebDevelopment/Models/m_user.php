<?php

// INSERT / POST
function userCreation($data) {
    
    // Variables
    $token      = "16663056-351e723be15750d1cc90b4fcd";
    $url        = 'http://localhost/TG_MTC/BackendDevelopment/users.php/';
    
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

    if ($status !== "201") {
        $aReturn = [
            'erro'      => true , 
            'msg'       => "<div class='alert alert-danger' role='alert'>Erro: ". $aData['msg'] . "</div>" ,
            'msgAdim'   => $aData['msg'] ,
            'cod_erro'  => $aData['cod_erro']
        ];        
    } else {
        $aReturn = [
            'erro'=> false , 
            'msgAdim' => $aData['msg'] ,
            'dados' => $aData['dados'][0]
        ];
    }

    return $aReturn;
}


// QUERY / GET
function userValidation($email, $password)
{
    $token  = "16663056-351e723be15750d1cc90b4fcd";
    $url    = "http://localhost/TG_MTC/BackendDevelopment/users.php/?token=" . $token . "&key=email&value=" . $email;

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

    // Servers Problems // ***************** VERIFICAR STATUS DO SERVER NO INÍCIO DE CADA PÁGINA **********************
    // if (count($aData) == 0 || $aData == false):
    //     $aData = array("erro" => true , "msg" => "A requisição ao Servidor falhou! Tente Novamente" );
    // endif;

    if (count($aData) == 0 || $aData == false):        
        $retorna = ['erro'=> true, 'msg' => "<div class='alert alert-danger' role='alert'>Erro: Usuário ou a senha inválida!</div>"];
    else:
        if (password_verify($password, $aData[0]["password"])):            
            $retorna = ['erro'=> false, 'dados' => $aData[0]];
        else:
            $retorna = ['erro'=> true, 'msg' => "<div class='alert alert-danger' role='alert'>Erro: Usuário ou a senha inválida!</div>"];
        endif;
    endif;

    // // Query/DB Problems
    // $status_line = $http_response_header[0];
    // preg_match('{HTTP\/\S*\s(\d{3})}', $status_line, $match);
    // $status = $match[1];

    // if ($status !== "200") {
    //     $aResult = array("mensagem" => $aResult['mensagem'], 'retorno' => false );
    // }    
    
    return $retorna;
}


function loadProfileDetails($profileID){
    $token  = "16663056-351e723be15750d1cc90b4fcd";
    $url    = "http://localhost/TG_MTC/BackendDevelopment/users.php/?token=" . $token . "&key=id&value=". $profileID;
  
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
    
    return $aData;
  }

// ################################################# ANALISAR

/* FUNÇÃO PARA LISTAR CLIENTES (usuários) */
function listarClientes($conn)
{
    $sql = 'SELECT cod_cliente, nome_cliente, email FROM cliente';
    $stmt = $conn->prepare($sql);
    $stmt->execute();

    $result = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    $stmt->close();
    return $result;
    // print_r($result);
}

?>