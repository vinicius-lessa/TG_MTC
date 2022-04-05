<?php

/**
 * File DOC
 * 
 * @Description Controller dos usuários, por aqui passam os processos de SIGNIN, SIGNUP, LOGOUT
 * @ChangeLog 
 *  - Vinícius Lessa - 29/03/2022: Início da documentação do arquivo. Mudanças gerais nas Controllers de SIGN IN e SIGN UP
 * 
 * @ Notes: As requisições nesta página vem através de JavaScript, pela função FETCH, enviando requisições POST.
 * 
 */

if (!defined('SITE_URL')) {
    include_once '../config.php';
}

include SITE_PATH . '/Models/m_user.php';

// Receive POST Data
$postData = filter_input_array(INPUT_POST, FILTER_DEFAULT);    

/****
    SIGNUP Submit
****/

if (isset($_POST['signUp'])) {
    
    $data = [];
    
    foreach ($_POST as $key => $value) {
        if ($key != "signUp") {
            if ($key == "password") {
                $data[$key] = password_hash($value, PASSWORD_DEFAULT);
            } else {
                $data[$key] = $value;
            }
        }
    }
    
    var_dump($data);
    /*
    // Check recived values        
    
        $string=implode(",",$data);
        echo $string;
        var_dump($data);

        echo "<br><hr><br>";
        
        var_dump(userCreation($data));
    */        

    // $aResponse = userCreation($data);        

    // if ($aResponse['retorno']) {
    //     header("location:" . SITE_URL . "/Views/users/returnSuccess.php");
    // } else {
    //     $msgErro = $aResponse['mensagem'];
    //     header("location:" . SITE_URL . "/Views/users/returnFailed.php?error=$msgErro");
    // }    
}


/****
    SIGNIN Submit
****/

if ($postData['action'] == 'signIn'):
    
    $email      = $postData['email'];
    $password   = $postData['password'];

    if (empty($postData['email']) or empty($postData['password'])):
        $aResponse = ['erro' => true , 'msg' => 'Preencha todos os Campos!'];
    else:        
        $aResponse = userValidation($email, $password);
        
        // $responseReturn = ['erro' => $aResponse['erro'] , 'msg' => $aResponse['msg']];

            // session_start();
            // $_SESSION['email'] = $usuario['email'];
            // $_SESSION['nome_cliente'] = $usuario['nome_cliente'];
            // $_SESSION['cod_cliente'] = $usuario['cod_cliente'];
            // header("location:" . SITE_URL . "/Views/homepage/index.php");        
    endif;

    echo json_encode($aResponse);

endif;


/****
    LOGOUT Submit
****/

if (isset($_GET['sair'])) {
    session_start();
    session_destroy();
    header("location:" . SITE_URL . "/Views/homepage/index.php");
}

// *****************************************************************************************************


/* LISTAR CLIENTES */
if (isset($listarClientes)) {
    $listarClientes = listarClientes($conn);
}   

?>