<?php
    
    // User Creation
    function userCreation($dados)
    {
        return true;
        /* 
        CONSULTA E-MAIL EXISTENTE (GET)

        SE NÃO EXISTE{
            CRIA USUÁRIO NO BANCO (POST)
            SE DEU CERTO {
                RETORNA VERDADEIRO
            } SE NÃO {
                RETORNA FALSO + ERRO
            }
        } SE EXISTE {
            RETORNA FALSO + ERRO
        }
        

        */
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