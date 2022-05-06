<?php
/**
 * File DOC
 * 
 * @Description Controller dos usuários, por aqui passam os processos de SIGNIN, SIGNUP, LOGOUT
 * @ChangeLog 
 *  - Vinícius Lessa - 29/03/2022: Início da documentação do arquivo. Mudanças gerais nas Controllers de SIGN IN e SIGN UP.
 *  - Vinícius Lessa - 13/04/2022: Correção simples do botão sair + identação.
 *  - Vinícius Lessa - 2022/04/16: Implementação da função de retorno das informações do usuário (ID, Email e Nome.
 *  - Vinícius Lessa - 05/05/2022: Implementação do 'if' para Atualização do Cadastro de Usuários.
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
$dados = (filter_input_array(INPUT_POST, FILTER_DEFAULT) != null ? filter_input_array(INPUT_POST, FILTER_DEFAULT) : ["action" => "null"] ); // Recieve Post values into $dados

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
            $_SESSION['user_id']        =  $retorna["dados"]["user_id"];
            $_SESSION['user_name']      =  $retorna["dados"]["user_name"];
            $_SESSION['user_email']     =  $retorna["dados"]["email"];
            $_SESSION['user_password']  =  $data["userPassword"];
        endif;
    endif;

    echo json_encode($retorna);
    exit;
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
            $_SESSION['user_id']        =  $retorna["dados"]["user_id"];
            $_SESSION['user_name']      =  $retorna["dados"]["user_name"];
            $_SESSION['user_email']     =  $retorna["dados"]["email"];
            $_SESSION['user_password']  =  $dados["userPassword"];
            $_SESSION['profile-pic']    =  $retorna["dados"]["image_name"];
        endif;
    }

    echo json_encode($retorna);
    exit;
endif;


// Update User's Info
if ($dados['action'] === "UpdateProfile"):    

    // $encripted_password = (isset($dados["userPassword"]))  ? password_hash($dados["userPassword"], PASSWORD_DEFAULT) : '';

    $data = [        
        "userEmail"     => (isset($dados["userEmail"]))     ? $dados["userEmail"] : ''      ,
        "userBirthday"  => (isset($dados["userBirthday"]))  ? $dados["userBirthday"] : ''   ,
        "userPhone"     => (isset($dados["userPhone"]))     ? $dados["userPhone"] : ''      ,
        "userZipCode"   => (isset($dados["userZipCode"]))   ? $dados["userZipCode"] : ''    ,
        "user_id"       => (isset($dados["user_id"]))       ? $dados["user_id"] : ''    ,
        "bioText"       => (isset($dados["bioText"]))       ? $dados["bioText"] : ''            ,
    ];

    // "userName"      => (isset($dados["userName"]))      ? $dados["userName"] : ''       ,
    // "userPassword"  => $encripted_password                                              ,
    // "userType"      => (isset($dados["userType"]))      ? $dados["userType"] : ''       ,    
    
    // if(empty($data["userName"])):
    //     $serverReturn = ['erro'=> true, 'msg' => "<div class='alert alert-danger' role='alert'>Erro: Necessário preencher o Nome do Usuário!</div>"];    
    
    // elseif(empty($data["userPassword"])):
    //     $serverReturn = ['erro'=> true, 'msg' => "<div class='alert alert-danger' role='alert'>Erro: Necessário preencher a Senha!</div>"];
    
    // elseif(empty($data["userType"])):
    //     $serverReturn = ['erro'=> true, 'msg' => "<div class='alert alert-danger' role='alert'>Erro: Necessário preencher o Tipo de Pessoa!</div>"];    

    if (empty($data["userEmail"])):
        $serverReturn = ['erro'=> true, 'msg' => "<div class='alert alert-danger' role='alert'>Erro: Necessário preencher o E-mail!</div>"];

    elseif(empty($data["userZipCode"])):
        $serverReturn = ['erro'=> true, 'msg' => "<div class='alert alert-danger' role='alert'>Erro: Necessário preencher o campo CEP!</div>"];

    else:        
        $serverReturn = userUpdate($data); // Model

        // if(!$serverReturn["erro"]):
        //     $_SESSION['user_id']    =  $serverReturn["dados"]["user_id"];
        //     $_SESSION['user_name']  =  $serverReturn["dados"]["user_name"];
        //     $_SESSION['user_email'] = $serverReturn["dados"]["email"];            
        // endif;
    endif;    

    echo json_encode($serverReturn);
    exit;
endif;


// Called in: 'users/user_profile.php'
if ( isset($profileID) ) :
    
    $profileDetails = loadProfileDetails($profileID);
endif;

// Called in: 'music_trade_center/home.php'
if ( isset($a_Users) ) {
    $a_Users = loadProfileDetails(null); // All Users
    return;
}

// Called in: 'music_trade_center/home.php'
// if ( isset($a_Users) && isset($params) ) {
//     $a_userTradePosts = loadProfileDetails($params); // Implementar na Busca Posteriormente    
// }


// LogOut / Sair
if (isset($_GET['signOut'])) {
    // session_destroy();
    unset($_SESSION['user_id'], $_SESSION['user_name'], $_SESSION['user_email'], $_SESSION['profile-pic']);
    header("location:" . SITE_URL . "/Views/users/sign_in.php");
    exit;
}


?>