<?php
/**
 * File DOC
 * 
 * @Description Controller dos usuários, por aqui passam os processos de SIGNIN, SIGNUP, LOGOUT
 * @ChangeLog 
 *  - Vinícius Lessa - 29/03/2022: Início da documentação do arquivo. Mudanças gerais nas Controllers de SIGN IN e SIGN UP.
 *  - Vinícius Lessa - 13/04/2022: Correção simples do botão sair + identação.
 *  - Vinícius Lessa - 2022/04/16: Implementação da função de retorno das informações do usuário (ID, Email e Nome.
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
            $_SESSION['user_id']    =  $retorna["dados"]["user_id"];
            $_SESSION['user_name']  =  $retorna["dados"]["user_name"];
            $_SESSION['user_email'] = $retorna["dados"]["email"];        
        endif;
    }

    echo json_encode($retorna);
    exit;
endif;


// LogOut / Sair
if (isset($_GET['signOut'])) {    
    // session_destroy();
    unset($_SESSION['user_id'], $_SESSION['user_name'], $_SESSION['user_email']);
    header("location:" . SITE_URL . "/Views/users/sign_in.php");
    exit;
}

// GET REQUESTS (from FrontEnd)
if ($_SERVER['REQUEST_METHOD'] == 'GET'):

    // echo json_encode( ['verbo_http' => $_SERVER['REQUEST_METHOD']] );
    // exit;
    
    // Parâmetro passado pela URL
    $uri = basename($_SERVER['REQUEST_URI']);

    if ( !Empty($uri) && $uri <> 'index.php' ):

        // Variables
        $keySearch      = (isset($_GET["key"])) ? $_GET["key"] : ""        ;        

        if (Empty($keySearch)):
            http_response_code(404); // Not Found
            echo json_encode(['msg' => 'Informe todos os parâmetros!']);

        elseif ($keySearch == "user_info"):
            
            if ( isset($_SESSION['user_id']) && isset($_SESSION['user_name']) && isset($_SESSION['user_email']) ):
                http_response_code(200); // Success
                echo json_encode([
                    'user_id'       => $_SESSION['user_id'] ,
                    'user_name'     => $_SESSION['user_name'] ,
                    'user_email'    => $_SESSION['user_email'] ,
                ]);
            else:
                http_response_code(406); // Not Acceptable
                echo json_encode(['data' => 'Informe todos os parâmetros!']);
            endif;
        endif;
    endif;

endif;

// ANALISAR *****************************************************************************************************


/* LISTAR CLIENTES */
if (isset($listarClientes)) {
    $listarClientes = listarClientes($conn);
}   

?>