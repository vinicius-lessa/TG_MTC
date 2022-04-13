<?php
/**
 * File DOC
 * 
 * @Description Controller dos usuários, por aqui passam os processos de SIGNIN, SIGNUP, LOGOUT
 * @ChangeLog 
 *  - Vinícius Lessa - 29/03/2022: Início da documentação do arquivo. Mudanças gerais nas Controllers de SIGN IN e SIGN UP.
 *  - Vinícius Lessa - 13/04/2022: Correção simples do botão sair + identação.
 * 
 * @ Notes: As requisições nesta página vem através de JavaScript, pela função FETCH, enviando requisições POST.
 * 
 */

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!defined('SITE_URL')) {
    include_once '../config.php';
}

// External Functions
include SITE_PATH . '/Models/m_user.php';

// Vars
$dados = filter_input_array(INPUT_POST, FILTER_DEFAULT); // Recieve Post values into $dados


// SignUp / Cadastrar
if ($dados['action'] === "SignUp"):
    
    $encripted_password = (isset($dados["userPassword"]))  ? password_hash($dados["userPassword"], PASSWORD_DEFAULT) : '';

    $data = [
        "userName"      => (isset($dados["userName"]))      ? $dados["userName"] : ''       ,
        "userEmail"     => (isset($dados["userEmail"]))     ? $dados["userEmail"] : ''      ,
        "userPassword"  => $encripted_password                                              ,
        "userType"      => (isset($dados["userType"]))      ? $dados["userType"] : ''       ,
        "userBirthday"  => (isset($dados["userBirthday"]))  ? $dados["userBirthday"] : ''   ,
        "userPhone"     => (isset($dados["userPhone"]))     ? $dados["userPhone"] : ''      ,
        "userZipCode"   => (isset($dados["userZipCode"]))   ? $dados["userZipCode"] : ''    ,
    ];
    
    if(empty($data["userName"])):
        $retorna = ['erro'=> true, 'msg' => "<div class='alert alert-danger' role='alert'>Erro: Necessário preencher o Nome do Usuário!</div>"];
    
    elseif(empty($data["userEmail"])):
        $retorna = ['erro'=> true, 'msg' => "<div class='alert alert-danger' role='alert'>Erro: Necessário preencher o E-mail!</div>"];
    
    elseif(empty($data["userPassword"])):
        $retorna = ['erro'=> true, 'msg' => "<div class='alert alert-danger' role='alert'>Erro: Necessário preencher a Senha!</div>"];
    
    elseif(empty($data["userType"])):
        $retorna = ['erro'=> true, 'msg' => "<div class='alert alert-danger' role='alert'>Erro: Necessário preencher o Tipo de Pessoa!</div>"];

    else:
        
        $retorna = userCreation($data);

        if(!$retorna["erro"]):
            $_SESSION['user_id']    =  $retorna["dados"]["user_id"];
            $_SESSION['user_name']  =  $retorna["dados"]["user_name"];
            $_SESSION['user_email'] = $retorna["dados"]["email"];
        endif;
    endif;

    echo json_encode($retorna);
    
endif;


// SignIn / Logar
if ($dados['action'] === "SignIn"):    

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


// LogOut / Sair
if (isset($_GET['signOut'])) {    
    // session_destroy();
    unset($_SESSION['user_id'], $_SESSION['user_name'], $_SESSION['user_email']);
    header("location:" . SITE_URL . "/Views/users/SignIn.php");
}


// ANALISAR *****************************************************************************************************


/* LISTAR CLIENTES */
if (isset($listarClientes)) {
    $listarClientes = listarClientes($conn);
}   

?>