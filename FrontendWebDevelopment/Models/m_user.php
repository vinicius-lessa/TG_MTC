<?php

// QUERY / GET
function userValidation($user, $pass)
{
    // RECEBER DADOS
    // MANDAR CONSULTA PARA BACK
    // CASO RESULTADO FOR MAIOR QUE 0
        // VERIFICA SENHA
            // PERMITE LOGIN
    // ELSE
        // RETORNA MENSAGEM DE USUÁRIO INEXISTENTE

        
    // $sql = 'SELECT cod_cliente, nome_cliente, telefone, cpf, email, senha, cep  from cliente where email = ? ';
    // $stmt = $conn->prepare($sql) ;
    // $stmt->bind_param("s", $user);
    // $stmt->execute();

    // $result = $stmt->get_result()->fetch_assoc();

    // $stmt->close();

    // return password_verify($pass, $result['senha']) ?  $result : false;
}

// INSERT / POST
function userCreation($data)
{
    // Variables
    $token      = "16663056-351e723be15750d1cc90b4fcd";
    $username   = $data['username'];
    $email      = $data['email'];
    $password   = $data['password'];
    $persontype = $data['persontype'];
    
    $birthday   = $data['birthday'];
    $phone      = $data['phone'];
    $cep        = $data['cep'];

    $url        = 'http://localhost/TG_MTC/BackendDevelopment/users.php/';
    
    $postdata = http_build_query(
        array(
            'token'         => $token,
            'user_name'     => $username,
            'email'         => $email,
            'password'      => $password,
            'tipo_pessoa'   => $persontype,
            'birthday'      => $birthday,
            'phone'         => $phone,
            'cep'           => $cep
        )
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
    $aResult = json_decode($returnJson, true); // Trasnforma em Array

    // Servers Problems
    if (count($aResult) == 0 || $aResult == false):
        $aResult = array("mensagem" => "A requisição ao Servidor falhou! Tente Novamente." , 'retorno' => false );
    endif;

    // Query/DB Problems
    $status_line = $http_response_header[0];
    preg_match('{HTTP\/\S*\s(\d{3})}', $status_line, $match);
    $status = $match[1];

    if ($status !== "201") {
        $aResult = array("mensagem" => $aResult['mensagem'], 'retorno' => false );
    }

    return $aResult;
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