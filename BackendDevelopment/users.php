<?php    
/**
 * File DOC
 * 
 * @Description Here the USERS table is manipulated
 * @ChangeLog 
 *  - Vinícius Lessa - 16/03/2022: Mudanças importantes para requisições utilizando o método GET. Agora, o servidor irá tratar parâmetros na URL.
 *  - Vinícius Lessa - 28/03/2022: Impletementação e testes na inserção de usuários via POST.
 *  - Vinícius Lessa - 14/04/2022: Diversos ajustes nos últimos dias, referentes a Consulta e Inclusão de usuários. Função 'ServerRespose()' removida.
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

if (!defined('SITE_URL')) {
    include_once 'config.php';
}

# Estabelece Conexão com o BANCO DE DADOS

// Class.Conexao.php
$pdo = ConexaoDB::getConexao();

// Class.Class.Crud.php
CrudDB::setConexao($pdo);

// Parâmetro passado pela URL
$uri = basename($_SERVER['REQUEST_URI']);


#############################################################################################
// HTTP METHODS
    
// ### GET (Consulta)
if ($_SERVER['REQUEST_METHOD'] == 'GET'):

    // echo json_encode( ['verbo_http' => $_SERVER['REQUEST_METHOD']] );

    // Token Validation
    if (!($_GET["token"] === '16663056-351e723be15750d1cc90b4fcd')):       
        http_response_code(401); // Unauthorized
        echo json_encode(['msg' => 'Erro: Token is not Valid!']);
        exit;
    endif;

    if ( !Empty($uri) && $uri <> 'index.php' ):

        // Variables
        $keySearch      = (isset($_GET["key"])) ? $_GET["key"] : ""        ;
        $valueSearch    = (isset($_GET["value"])) ? $_GET["value"] : ""    ;

        if (Empty($keySearch) || Empty($valueSearch)):            
            http_response_code(404); // Not Found
            echo json_encode(['msg' => 'Erro: Informe todos os parâmetros!']);
            exit;
        else:
            // All Users
            if ($keySearch == 'allUsers' && $valueSearch == 'true'):
                // For example:  .../users.php/?token=...&key=allUsers&value=true
                $dados = CrudDB::select('SELECT * FROM users WHERE activity_status = true ORDER BY user_id DESC LIMIT 10',[],TRUE);
            
            // Search by ID
            elseif ($keySearch == 'id'):
                // For example: .../users.php/?token=...&key=id&value=7

                $userId = $valueSearch;

                if (is_numeric($userId)):
                    $dados = CrudDB::select(
                        'SELECT u.user_id, u.user_name, u.birthday, u.phone, u.tipo_pessoa, u.email, u.cep, u.bio, u.created_on, ip.image_name FROM users u
                        LEFT JOIN images_profile ip ON ip.user_id  = u.user_id
                        WHERE u.user_id =:USER_ID'
                        ,['USER_ID' => $userId]
                        ,TRUE);
                    
                    if (!empty($dados)):
                        foreach ($dados as $user) {
                            $user->image_name = SITE_URL . "/uploads/user-profile/" . $user->image_name;
                        }    
                        http_response_code(200);
                        echo json_encode([
                            'error' => false ,
                            'data'  => $dados
                        ]);
                        exit;
                    else:
                        http_response_code(200);
                        echo json_encode([
                            'error' => true ,
                            'msg'  => 'Erro: o Perfil solicitado não foi encontrado!'
                        ]);
                        exit;
                    endif;
                else:                    
                    http_response_code(406); // Not Acceptable
                    echo json_encode([
                        'error' => true,
                        'msg' => 'Erro: Parâmetro ID não é numérico!'
                    ]);
                endif;
    
            // Search by E-mail
            elseif ($_GET['key'] == 'email'):
                // For example: .../users.php/?token=...&key=email&value=andre@test.com

                $userEmail = $valueSearch;

                if (!is_numeric($userEmail)):
                    $dados = CrudDB::select('SELECT user_id, user_name, email, password FROM users WHERE email =:USER_EMAIL AND activity_status = 1 LIMIT 1'
                        ,['USER_EMAIL' => $userEmail]
                        ,TRUE);
                else:                    
                    http_response_code(406); // Not Acceptable
                    echo json_encode(['msg' => 'Parâmetro E-mail inválido!']);
                endif;    
            
            // Unknown Key
            else:                                
                http_response_code(406); // Not Acceptable
                echo json_encode(['msg' => 'Informe uma Chave (key) correta!']);
            endif;          
        endif;

        // Final DATA
        // if (!Empty($dados)):
            http_response_code(200);
            echo json_encode($dados);
            exit;
        // else:    
            // http_response_code(404); // Not Found
            // echo json_encode(['msg' => 'Problemas na pesquisa ao Servidor']);
            // return;
        // endif;
        
    else:                
        http_response_code(406); // Not Acceptable
        echo json_encode(['msg' => 'Parâmetro não preenchido na consulta!']);
    endif;
endif;


#############################################################################################

// # POST (INCLUSÃO)
// No INSOMINIA, utilizar o "MULTIPART FORM" (Structured)
if ($_SERVER['REQUEST_METHOD'] == 'POST'):
    
    // echo json_encode( ['verbo_http' => $_SERVER['REQUEST_METHOD']] );

    // Token Validation
    if (!($_POST["token"] === '16663056-351e723be15750d1cc90b4fcd')):        
        http_response_code(401); // Unauthorized
        echo json_encode(['msg' => 'Token is not Valid!']);
        exit;
    endif;

    // Variables
    $userName           = (isset($_POST['userName'])) ? $_POST['userName'] : ''                 ;
    $userBirthday       = (isset($_POST['userBirthday'])) ? $_POST['userBirthday'] : ''         ;
    $userPhone          = (isset($_POST['userPhone'])) ? $_POST['userPhone'] : ''               ;
    $userType           = (isset($_POST['userType'])) ? $_POST['userType'] : ''                 ;
    $userEmail          = (isset($_POST['userEmail'])) ? $_POST['userEmail'] : ''               ;    
    $userZipCode        = (isset($_POST['userZipCode'])) ? $_POST['userZipCode'] : ''           ;    
    $userPassword       = (isset($_POST['userPassword'])) ? $_POST['userPassword'] : ''         ;
    // $cpf_cnpj           = (isset($_POST['cpf_cnpj'])) ? $_POST['cpf_cnpj'] : ''                 ;
    // $bio                = (isset($_POST['bio'])) ? $_POST['bio'] : ''                           ;
    
    if (empty($userName) or
        empty($userType) or 
        empty($userEmail) or
        empty($userPassword)
        ):         
        http_response_code(406);
        echo json_encode(['msg' => 'Informe Todos os Parâmetros!']);
        exit;
    endif;

    // Verifica se USER já existe
    $dados = CrudDB::select(
        "SELECT email FROM users WHERE email LIKE(:EMAIL) and activity_status = 1",
        ['EMAIL' => $userEmail],
        TRUE
    );

    if (!Empty($dados)):        
        http_response_code(406);
        echo json_encode([
            'msg'       => 'Usuário já existe!' ,
            'cod_erro'  => 1
        ]);
        exit;
    else:        
        CrudDB::setTabela('users');
        
        $retorno = CrudDB::insert
        ([
            'user_name'         => "'" . $userName . "'"        ,
            'email'             => "'" . $userEmail . "'"       ,
            'password'          => "'" . $userPassword . "'"    ,
            'tipo_pessoa'       => "'" . $userType. "'"         ,
            'birthday'          => "'" . $userBirthday . "'"    ,
            'phone'             => "'" . $userPhone . "'"       ,
            'cep'               => "'" . $userZipCode . "'"     ,
            // 'cpf_cnpj'          => "'" . $cpf_cnpj . "'"        ,
            // 'bio'               => "'" . $bio . "'"
        ]);

        if ($retorno):
            // Consulta a inclusão feita para devolver dados de login automático
            $dados = CrudDB::select('SELECT user_id, user_name, email FROM users WHERE email =:USER_EMAIL AND activity_status = 1 LIMIT 1'
                ,['USER_EMAIL' => $userEmail]
                ,TRUE);

            if (!Empty($dados)):
                http_response_code(201);
                echo json_encode([
                    'msg'   => 'Usuário inserido com Sucesso!' ,
                    'dados' => $dados 
                ]);                
            else:
                http_response_code(500);
                echo json_encode(['msg' => 'Usuário inserido com sucesso, porém não encontrado para realizar login automático!']);
            endif;
            exit;
        else:            
            http_response_code(500);
            echo json_encode(['msg' => 'Erro ao inserir novo Usuário!']);
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