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

    $newName            = ( isset($dados["userName"])   ? $dados["userName"] : '' ) ;
    $newEmail           = ( isset($dados["userEmail"])  ? $dados["userEmail"] : '' ) ;
    $newPass            = $dados["userPassword"] ;
    
    $encripted_password = ( (isset($newPass) && !empty($newPass)) ? password_hash($newPass, PASSWORD_DEFAULT) : '' );

    $data = [
        "userEmail"     => $newEmail ,
        "userName"      => $newName ,
        "userPassword"  => $encripted_password ,
        "userBirthday"  => (isset($dados["userBirthday"]))  ? $dados["userBirthday"] : '' ,
        "userPhone"     => (isset($dados["userPhone"]))     ? $dados["userPhone"] : '' ,
        "userZipCode"   => (isset($dados["userZipCode"]))   ? $dados["userZipCode"] : '' ,
        "user_id"       => (isset($dados["user_id"]))       ? $dados["user_id"] : '' ,
        "bioText"       => (isset($dados["bioText"]))       ? $dados["bioText"] : '' ,        
        "userType"      => (isset($dados["userType"]))      ? $dados["userType"] : '' ,        
    ];
    
    if(empty($data["userName"])):
        $serverReturn = ['error'=> true, 'msg' => "Necessário preencher o Nome do Usuário!"];
    
    elseif( strlen($data["userPassword"]) < 6 ):
        if (empty($data["userPassword"])):
            $serverReturn = ['error'=> true, 'msg' => "Necessário preencher a Senha!"];
        else:
            $serverReturn = ['error'=> true, 'msg' => "A Senha deve ter pelo menos 6 Caracteres!"];
        endif;
    
    elseif(empty($data["userType"])):
        $serverReturn = ['error'=> true, 'msg' => "Necessário preencher o Tipo de Pessoa!"];

    elseif(empty($data["userEmail"])):
        $serverReturn = ['error'=> true, 'msg' => "Necessário preencher o E-mail!"];

    elseif(empty($data["userZipCode"])):
        $serverReturn = ['error'=> true, 'msg' => "Necessário preencher o campo CEP!"];

    else:
        $serverReturn = userUpdate($data); // Model

        if(!$serverReturn["erro"]):
            if ( $newName != $_SESSION['user_name'] || 
                 $newEmail != $_SESSION['user_email'] || 
                 $newPass != $_SESSION['user_password']):

                $_SESSION['user_name']      = $serverReturn["dados"]["user_name"];
                $_SESSION['user_email']     = $serverReturn["dados"]["email"];            
                $_SESSION['user_password']  = $newPass;            
            endif;
        endif;
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