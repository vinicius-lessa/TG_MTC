<?php    
/**
 * File DOC
 * 
 * @Description Here the USERS table is manipulated
 * @ChangeLog 
 *  - Vinícius Lessa - 16/03/2022: Mudanças importantes para requisições utilizando o método GET. Agora, o servidor irá tratar parâmetros na URL.
 *  - Vinícius Lessa - 28/03/2022: Impletementação e testes na inserção de usuários via POST.
 * 
 * @ Tips & Tricks: 
 *      - Use this to check the method type: echo json_encode( ['verbo_http' => $_SERVER['REQUEST_METHOD']] );
 * 
 *  GET Method notes:
 *      - Url request example: .../users.php/?token={$token}&key={$key}&value={$value}
 * 
 */
 
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS');
header('Content-type: application/json; charset=UTF-8');

require_once 'classes/Class.Crud.php';

# Estabelece Conexão com o BANCO DE DADOS

// Class.Conexao.php
$pdo = ConexaoDB::getConexao();

// Class.Class.Crud.php
CrudDB::setConexao($pdo);

// Parâmetro passado pela URL
$uri = basename($_SERVER['REQUEST_URI']);


#############################################################################################
// FUNCTIONS

function ServerResponse($httpCode, $returnData) {
    
    // Errors
    if (gettype($returnData) == "string"):
                
        http_response_code($httpCode);
        echo json_encode(['mensagem' => $returnData]);

    // Success data requested
    elseif (gettype($returnData) == "array"):
        
        if ($httpCode == 201): // Successful Insert
            http_response_code($httpCode);
            echo json_encode(['mensagem' => $returnData['mensagem'] , 'retorno' => $returnData['retorno'] ]);
            exit;
        endif;

        http_response_code($httpCode);
        echo json_encode($returnData);

    endif;    
}

#############################################################################################
// HTTP METHODS
    
// ### GET (Consulta)
if ($_SERVER['REQUEST_METHOD'] == 'GET'):

    // echo json_encode( ['verbo_http' => $_SERVER['REQUEST_METHOD']] );

    // Token Validation
    if (!($_GET["token"] === '16663056-351e723be15750d1cc90b4fcd')):
        ServerResponse(401, "Token is not Valid!"); // Unauthorized
        exit;
    endif;

    if ( !Empty($uri) && $uri <> 'index.php' ):

        // Variables
        $keySearch      = (isset($_GET["key"])) ? $_GET["key"] : ""        ;
        $valueSearch    = (isset($_GET["value"])) ? $_GET["value"] : ""    ;

        if (Empty($keySearch) || Empty($valueSearch)):
            ServerResponse(404, "Informe todos os parâmetros!"); // Not Found
        else:
            // All Users
            if ($keySearch == 'allUsers' && $valueSearch == 'true'):
                // For example:  .../users.php/?token=...&key=allUsers&value=true
                $dados = CrudDB::select('SELECT * FROM users ORDER BY user_id DESC LIMIT 2',[],TRUE);
            
            // Search by ID
            elseif ($keySearch == 'id'):
                // For example: .../users.php/?token=...&key=id&value=7

                $userId = $valueSearch;

                if (is_numeric($userId)):
                    $dados = CrudDB::select('SELECT * FROM users WHERE user_id =:USER_ID'
                        ,['USER_ID' => $userId]
                        ,TRUE);                
                else:
                    ServerResponse(406, "Parâmetro ID não é numérico!"); // Not Acceptable
                endif;
    
            // Search by E-mail
            elseif ($_GET['key'] == 'email'):
                // For example: .../users.php/?token=...&key=email&value=andre@test.com

                $userEmail = $valueSearch;

                if (!is_numeric($userEmail)):
                    $dados = CrudDB::select('SELECT email, password FROM users WHERE email =:USER_EMAIL AND activity_status = 1 LIMIT 1'
                        ,['USER_EMAIL' => $userEmail]
                        ,TRUE);
                else:
                    ServerResponse(406, "Parâmetro E-mail inválido!"); // Not Acceptable
                endif;    
            
            // Unknown Key
            else:                
                ServerResponse(406, "Informe uma Chave (key) correta!"); // Not Acceptable
            endif;          
        endif;

        // Final DATA
        if (!Empty($dados)):
            ServerResponse(200, $dados); // Success
            return;
        else:
            ServerResponse(404, "Pesquisa nao encontrada!"); // Not Found
        endif;
        
    else:        
        ServerResponse(406, "Parâmetro não preenchido na consulta!"); // Not Acceptable
    endif;
endif;

#############################################################################################

// # POST (INCLUSÃO)
// No INSOMINIA, utilizar o "MULTIPART FORM" (Structured)
if ($_SERVER['REQUEST_METHOD'] == 'POST'):
    
    // echo json_encode( ['verbo_http' => $_SERVER['REQUEST_METHOD']] );

    // Token Validation
    if (!($_POST["token"] === '16663056-351e723be15750d1cc90b4fcd')):
        ServerResponse(401, 'Token is not Valid!'); // Unauthorized
        exit;
    endif;

    // Variables
    $username           = (isset($_POST['user_name'])) ? $_POST['user_name'] : ''       ;
    $birthday           = (isset($_POST['birthday'])) ? $_POST['birthday'] : ''         ;
    $phone              = (isset($_POST['phone'])) ? $_POST['phone'] : ''               ;
    $tipo_pessoa        = (isset($_POST['tipo_pessoa'])) ? $_POST['tipo_pessoa'] : ''   ;
    $email              = (isset($_POST['email'])) ? $_POST['email'] : ''               ;
    $cpf_cnpj           = (isset($_POST['cpf_cnpj'])) ? $_POST['cpf_cnpj'] : ''         ;
    $cep                = (isset($_POST['cep'])) ? $_POST['cep'] : ''                   ;
    $bio                = (isset($_POST['bio'])) ? $_POST['bio'] : ''                   ;
    $activity_status    = 1                                                             ;
    $password           = (isset($_POST['password'])) ? $_POST['password'] : ''         ;
    
    if (empty($username) or
        empty($tipo_pessoa) or 
        empty($email) or
        empty($password)
        ):
        ServerResponse(406, 'Informe Todos os Parâmetros!');
        exit;
    endif;

    // # Verifica se USER já existe
    $dados = CrudDB::select(
        "SELECT email FROM users WHERE email LIKE(:EMAIL) and activity_status = 1",
        ['EMAIL' => $email],
        TRUE
    );

    if (!Empty($dados)):
        ServerResponse(406, 'Usuário já existe!');
        exit;
    else:        
        CrudDB::setTabela('users');

        $retorno = CrudDB::insert
        ([
            'user_name'         => "'" . $username . "'"    ,
            'email'             => "'" . $email . "'"       ,
            'password'          => "'" . $password . "'"    ,
            'tipo_pessoa'       => "'" . $tipo_pessoa. "'"  ,
            'birthday'          => "'" . $birthday . "'"    ,
            'phone'             => "'" . $phone . "'"       ,
            'cep'               => "'" . $cep . "'"         ,
            'cpf_cnpj'          => "'" . $cpf_cnpj . "'"    ,
            'bio'               => "'" . $bio . "'"
        ]);

        if ($retorno):
            ServerResponse(201, array('mensagem' => 'Usuário inserido com Sucesso!', 'retorno' => true)); // Success
        else:           
            ServerResponse(500, 'Erro ao inserir novo Usuário!'); // Error
        endif;
    endif;
endif;


#############################################################################################

// **************** PUT (ALTERAÇÃO)
// No INSOMINIA, utilizar o "FORM URL ENCODED" (Structured)
if ($_SERVER['REQUEST_METHOD'] == 'PUT'):
    
    // echo json_encode( ['verbo_http' => $_SERVER['REQUEST_METHOD']] );

    // PHP NAO POSSUI PUT POR ORIGEM
    parse_str(file_get_contents('php://input'), $_PUT);

    $user_id        = (isset($_PUT['user_id'])) ? $_PUT['user_id'] : ''             ;
    $username       = (isset($_PUT['username'])) ? $_PUT['username'] : ''           ;
    $birthday       = (isset($_PUT['birthday'])) ? $_PUT['birthday'] : ''           ;
    $phone          = (isset($_PUT['phone'])) ? $_PUT['phone'] : ''                 ;
    // $tipo_pessoa    = (isset($_PUT['tipo_pessoa'])) ? $_PUT['tipo_pessoa'] : ''     ;
    $email          = (isset($_PUT['email'])) ? $_PUT['email'] : ''                 ;
    // $cpf_cnpj       = (isset($_PUT['cpf_cnpj'])) ? $_PUT['cpf_cnpj'] : ''           ;
    $cep            = (isset($_PUT['cep'])) ? $_PUT['cep'] : ''                     ;
    $city           = (isset($_PUT['city'])) ? $_PUT['city'] : ''                   ;
    $district       = (isset($_PUT['district'])) ? $_PUT['district'] : ''           ;
    $bio            = (isset($_PUT['bio'])) ? $_PUT['bio'] : ''                     ;
    $activity_status  = (isset($_PUT['activity_status'])) ? $_PUT['activity_status'] : 1  ;
    $password       = (isset($_PUT['password'])) ? $_PUT['password'] : ''           ;

    //  Verifies recieved parameters
    // echo json_encode( [$username] );

    if (
        empty($user_id) or 
        empty($username) or 
        empty($birthday) or 
        empty($phone) or
        empty($email) or 
        empty($cep) or
        empty($city) or
        empty($district) or
        empty($bio) or
        empty($password)
        ):
        echo json_encode(['mensagem' => 'Informe Todos os Parâmetros!']);
        http_response_code(406);
        exit;
    endif;

    CrudDB::setTabela('users');
    $retorno = CrudDB::update
    (
        [
            'username'      => "'" . $username . "'"    , 
            'birthday'      => "'" . $birthday . "'"    ,
            'phone'         => "'" . $phone . "'"       ,
            'email'         => "'" . $email . "'"       ,
            'cep'           => "'" . $cep . "'"         ,
            'city'          => "'" . $city . "'"        ,
            'district'      => "'" . $district . "'"    ,
            'bio'           => "'" . $bio . "'"         ,
            'activity_status' => $activity_status           ,
            'password'      => "'" . $password . "'"
        ],
        [
            'user_id' => $user_id
        ]
    );

    if ($retorno):
        http_response_code(202);
        echo json_encode(['mensagem' => 'Usuário atualizado com sucesso!']);
    else:
        http_response_code(500);
        echo json_encode(['mensagem' => 'Erro ao atualizar Usuário!']);
    endif;
endif;


#############################################################################################

// ********************* DELETE
if ($_SERVER['REQUEST_METHOD'] == 'DELETE'):
    
    // echo json_encode( ['verbo_http' => $_SERVER['REQUEST_METHOD']] );

    // if (!is_numeric($uri)):
    //     echo json_encode(['mensagem' => 'O parâmetro não é numérico']);
    //     http_response_code(406);
    //     exit;
    // else:
    //     $dados = CrudDB::select('SELECT id FROM estoque WHERE id = :id', ['id' => $uri], FALSE);
    //     if (!empty($dados)):
    //         // Exclui da Tabela ESTOQUE
    //         CrudDB::setTabela('estoque');
    //         $retorno = CrudDB::delete(['id' => $uri]);

    //         // Exclui da tabela MOVIMENTAÇÃO_ESTOQUE
    //         CrudDB::setTabela('movimentacao_estoque');
    //         $retornoMov = CrudDB::delete(['id_produto' => $uri]);

    //         if ($retorno):
    //             http_response_code(202);
    //             echo json_encode(['mensagem' => 'Deletado com sucesso!']);
    //             exit;
    //         else:
    //             http_response_code(500);
    //             echo json_encode(['mensagem' => 'Problema na deleção do cliente!']);
    //             exit;
    //         endif;
    //     else:
    //         http_response_code(404);
    //         echo json_encode(['mensagem' => 'O parâmetro informado não foi encontrado']);
    //         exit;
    //     endif;
    // endif;
endif;
?>