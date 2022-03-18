<?php
    // INSERT / POST
    function userCreation($dados)
    {
        // Checks if the e-mail given already exists

        // Variables
        $token  = "16663056-351e723be15750d1cc90b4fcd";
        $key    = "email";
        $value  = $dados['email'];

        $url = "http://localhost/TG_MTC/BackendDevelopment/users.php/?token={$token}&key={$key}&value={$value}";
        
        // file_get_contents
        $opts = array('http' =>
        [
            'method'  => 'GET',
            'ignore_errors' => true,
        ]);
        $context  = stream_context_create($opts);
        $response = file_get_contents($url, false, $context);
        
        // Tranforms Json in Array
        $resultArray = json_decode($response);
    
        // Requisition Failed
        if (count($resultArray) == 0 || $response == false):
            $resultArray = array("Error" => "A requisição ao Servidor falhou, verifique a URL!");
            return $resultArray;
        // Requisition Succed
        else:
            // User Not Found (by e-mail)

            if ($resultArray[0]->email <> $value) {
                /* 
                CRIA USUÁRIO
                
                SE DEU CERTO {
                    RETORNA VERDADEIRO
                } SE NÃO {
                    RETORNA FALSO + ERRO
                } */
    
                // $aResult = json_decode(json_encode($returnJson), true)   ; // Trasnforma em Array
    
                // foreach($aResult as &$Value){
                //     echo "Nome: " . $Value["username"];
                // }

                $resultArray = array("Return" => $resultArray[0]->email . " - " . $value);
                return $resultArray;
            
            // User already exists
            } else {
                $resultArray = array("Return" => "Usuário já existe!");
                return $resultArray;
            }
        endif;
    }

    function validarUsuario($user, $pass, $conn)
    {
        $sql = 'SELECT cod_cliente, nome_cliente, telefone, cpf, email, senha, cep  from cliente where email = ? ';
        $stmt = $conn->prepare($sql) ;
        $stmt->bind_param("s", $user);
        $stmt->execute();

        $result = $stmt->get_result()->fetch_assoc();

        $stmt->close();

        return password_verify($pass, $result['senha']) ?  $result : false;
    }

    /* FUNÇÃO PARA LISTAR CLIENTES */
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