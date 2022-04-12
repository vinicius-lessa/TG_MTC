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
session_start();

if (!defined('SITE_URL')) {
    include_once '../config.php';
}

include SITE_PATH . '/Models/m_user.php';

$dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);

/****
    SIGNUP Submit
****/

if (isset($_POST['signUp'])):
    
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
        
    //*** Check recived values    
    
    // $string = implode(",",$data);
    // echo $string;
    // var_dump($data);        
    // var_dump(userCreation($data));    

    $aResponse = userCreation($data);        

    if ($aResponse['retorno']) :
        header("location:" . SITE_URL . "/Views/users/returnSuccess.php");
    else:
        $msgErro = $aResponse['mensagem'];
        header("location:" . SITE_URL . "/Views/users/returnFailed.php?error=$msgErro");
    endif;
endif;


/****
    SIGNIN Submit
****/

// if (isset($_POST['signIn'])):
if ($dados['action'] === "SignIn"): 
    
    $retorna = ['erro'=> true, 'msg' => "<div class='alert alert-danger' role='alert'>Erro: Necessário preencher o campo usuário!</div>"];     

    if(empty($dados["userEmail"])){
        $retorna = ['erro'=> true, 'msg' => "<div class='alert alert-danger' role='alert'>Erro: Necessário preencher o campo usuário!</div>"];
    }elseif(empty($dados["userPassword"])){
        $retorna = ['erro'=> true, 'msg' => "<div class='alert alert-danger' role='alert'>Erro: Necessário preencher o campo senha!</div>"];
    }else{
        
        $retorna = userValidation($dados["userEmail"], $dados["userPassword"]);
        
        if(!$retorna["erro"]):            
            $_SESSION['user_id']    =  $retorna["dados"]["user_id"];
            $_SESSION['user_name']  =  $retorna["dados"]["user_name"];
            $_SESSION['user_email'] = $retorna["dados"]["email"];        
        endif;
    }

    echo json_encode($retorna);
endif;


/****
    LOGOUT Submit
****/

if (isset($_GET['signOut'])) {    
    // session_destroy();
    unset($_SESSION['user_id'], $_SESSION['user_name'], $_SESSION['user_email']);
    header("location:" . SITE_URL . "/Views/homepage/index.php");
}

// *****************************************************************************************************


/* LISTAR CLIENTES */
if (isset($listarClientes)) {
    $listarClientes = listarClientes($conn);
}   

?>