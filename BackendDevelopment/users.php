<?php    
// CRUD TABELA DE USERS
   
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
    
// ### GET (Consulta)
if ($_SERVER['REQUEST_METHOD'] == 'GET'):
    
    // echo json_encode( ['verbo_http' => $_SERVER['REQUEST_METHOD']] );

    if ( !Empty($uri) && $uri <> 'index.php' ):
        // All Users
        if ($uri == 'alldata'):                
            $dados = CrudDB::select('SELECT * FROM users ORDER BY user_id DESC LIMIT 10',[],TRUE);
        
        // Especific User
        else:
            if (is_numeric($uri)): //User ID
                $dados = CrudDB::select('SELECT * FROM users WHERE user_id =:USER_ID'
                    ,['USER_ID' => $uri]
                    ,TRUE);                
            else:
                echo json_encode(['mensagem' => 'Parâmetro inválido!']);
            endif;
        endif;
        
        if (!Empty($dados)):  
            echo json_encode($dados);
            http_response_code(200);
        else:
            echo json_encode(['mensagem' => 'Pesquisa nao encontrada!']);
            // http_response_code(406);
            exit;
        endif;
    else:
        http_response_code(406);
        echo json_encode(['mensagem' => 'Parâmetro não preenchido na consulta!']);
        exit;
    endif;
endif;

#############################################################################################

// # POST (INCLUSÃO)
// No INSOMINIA, utilizar o "MULTIPART FORM" (Structured)
if ($_SERVER['REQUEST_METHOD'] == 'POST'):
    
    // echo json_encode( ['verbo_http' => $_SERVER['REQUEST_METHOD']] );

    // Variables
    $username       = (isset($_POST['username'])) ? $_POST['username'] : ''         ;
    $birthday       = (isset($_POST['birthday'])) ? $_POST['birthday'] : ''         ;
    $phone          = (isset($_POST['phone'])) ? $_POST['phone'] : ''               ;
    $tipo_pessoa    = (isset($_POST['tipo_pessoa'])) ? $_POST['tipo_pessoa'] : ''   ;
    $email          = (isset($_POST['email'])) ? $_POST['email'] : ''               ;
    $cpf_cnpj       = (isset($_POST['cpf_cnpj'])) ? $_POST['cpf_cnpj'] : ''         ;
    $cep            = (isset($_POST['cep'])) ? $_POST['cep'] : ''                   ;
    $city           = (isset($_POST['city'])) ? $_POST['city'] : ''                 ;
    $district       = (isset($_POST['district'])) ? $_POST['district'] : ''         ;
    $bio            = (isset($_POST['bio'])) ? $_POST['bio'] : ''                   ;
    $active_status  = 1                                                             ;
    $password       = (isset($_POST['password'])) ? $_POST['password'] : ''         ;
    
    if (
        empty($username) or 
        empty($birthday) or 
        empty($tipo_pessoa) or 
        empty($email) or
        empty($password)
        ):
        echo json_encode(['mensagem' => 'Informe Todos os Parâmetros!']);
        http_response_code(406);
        exit;
    endif;

// # Verifica se USER já existe
    $dados = CrudDB::select(
        "SELECT email FROM users WHERE email LIKE(:EMAIL) and active_status = 1",
        ['EMAIL' => $email],
        TRUE
    );

    if (!Empty($dados)):
        echo json_encode(['mensagem' => 'Usuário já existe!']);
        http_response_code(406);
        exit;
    else:
        CrudDB::setTabela('users');

        $retorno = CrudDB::insert
        ([
            'username'      => "'" . $username . "'"    , 
            'birthday'      => "'" . $birthday . "'"    ,
            'phone'         => "'" . $phone . "'"       ,
            'tipo_pessoa'   => "'" . $tipo_pessoa. "'"  , 
            'email'         => "'" . $email . "'"       ,
            'cpf_cnpj'      => "'" . $cpf_cnpj . "'"    ,
            'cep'           => "'" . $cep . "'"         ,
            'city'          => "'" . $city . "'"        ,
            'district'      => "'" . $district . "'"    ,
            'bio'           => "'" . $bio . "'"         ,
            'active_status' => $active_status           ,
            'password'      => "'" . $password . "'"
        ]);

        if ($retorno):
            http_response_code(201);
            echo json_encode(['mensagem' => 'Usuário inserido com Sucesso!']);
        else:           
            http_response_code(500);
            echo json_encode(['mensagem' => 'Erro ao inserir novo Usuário!']);
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
    $active_status  = (isset($_PUT['active_status'])) ? $_PUT['active_status'] : 1  ;
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
            'active_status' => $active_status           ,
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