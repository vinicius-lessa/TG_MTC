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
require_once 'classes/WebServices/Class.ViaCEP.php';

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

    // For example:  .../users.php/?token=...&key=allUsers
    // For example: .../users.php/?token=...&key=id&value=7    

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

        if ( Empty($keySearch) ):
            http_response_code(404); // Not Found
            echo json_encode(['msg' => 'Erro: Informe todos os parâmetros!']);
            exit;
        else:
            // All Users
            if ( $keySearch == 'allUsers' ):
                $dados = CrudDB::select(
                    'SELECT u.user_id,
                            u.user_name, 
                            u.birthday,
                            u.phone,
                            u.tipo_pessoa,
                            u.email,
                            u.cep,
                            u.created_on, 
                            (SELECT ip.image_name FROM images_profile ip 
                                WHERE ip.user_id = u.user_id AND
                                    ip.activity_status = 1
                                ORDER BY ip.created_on DESC LIMIT 1) AS `image_name`
                    FROM users u
                    WHERE u.activity_status = 1
                    order by u.created_on desc limit 12;', [], TRUE);
                if (!empty($dados)):
                    
                    for ($i = 0; $i < count($dados); $i++) {
                    
                        if ( !empty($dados[$i]->image_name) ):
                            $dados[$i]->image_name = SITE_URL . "/uploads/user-profile/" . $dados[$i]->image_name;
                        endif;

                        // Consulta Cep e Adicina no Retorno
                        if ( !empty($dados[$i]->cep) ):

                            $dadosCEP = ViaCEP::consultarCEP($dados[$i]->cep);

                            if ( $dadosCEP != null ):
                                // Adiciona nova Propriedade ao Objeto
                                $dados[$i] = (array)$dados[$i];
                                $dados[$i]['state'] = $dadosCEP["uf"];
                                $dados[$i]['city'] = $dadosCEP["localidade"];
                                $dados[$i]['district'] = $dadosCEP["bairro"];
                                $dados[$i] = (object)$dados[$i];
                            endif;
                        endif;
                        
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
            
            // Search by ID
            elseif ( $keySearch == 'id' && !empty($valueSearch) ):

                $userId = $valueSearch;

                if (is_numeric($userId)):
                    $dados = CrudDB::select(
                        'SELECT u.user_id,
                                u.user_name, 
                                u.birthday, 
                                u.phone, 
                                u.tipo_pessoa, 
                                u.email, 
                                u.cep, 
                                u.bio, 
                                u.created_on, 
                                (SELECT ip.image_name FROM images_profile ip 
                                    WHERE ip.user_id = u.user_id AND
                                          ip.activity_status = 1
                                    ORDER BY ip.created_on DESC LIMIT 1) AS `image_name`
                        FROM users u
                        WHERE 	u.user_id =:USER_ID and
                                u.activity_status = 1;'
                        ,['USER_ID' => $userId]
                        ,TRUE);
                    
                    if (!empty($dados)):
                        for ($i = 0; $i < count($dados); $i++) {
                    
                            if ( !empty($dados[$i]->image_name) ):
                                $dados[$i]->image_name = SITE_URL . "/uploads/user-profile/" . $dados[$i]->image_name;
                            endif;

                            // Consulta Cep e Adicina no Retorno
                            if ( !empty($dados[$i]->cep) ):

                                $dadosCEP = ViaCEP::consultarCEP($dados[$i]->cep);

                                if ( $dadosCEP != null ):
                                    // Adiciona nova Propriedade ao Objeto
                                    $dados[$i] = (array)$dados[$i];
                                    $dados[$i]['state'] = $dadosCEP["uf"];
                                    $dados[$i]['city'] = $dadosCEP["localidade"];
                                    $dados[$i]['district'] = $dadosCEP["bairro"];
                                    $dados[$i] = (object)$dados[$i];
                                endif;
                            endif;
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
    
            // Used for LOGIN
            elseif ($_GET['key'] == 'email'):                

                $userEmail = $valueSearch;

                if (!is_numeric($userEmail)):
                    $dados = CrudDB::select('SELECT 
                                                u.user_id, 
                                                u.user_name, 
                                                u.email, 
                                                u.password ,
                                                (SELECT ip.image_name FROM images_profile ip 
                                                    WHERE ip.user_id = u.user_id AND
                                                        ip.activity_status = 1
                                                    ORDER BY ip.created_on desc limit 1) AS `image_name`
                                            FROM users u 
                                            WHERE u.email =:USER_EMAIL AND 
                                                activity_status = 1 
                                            ORDER BY u.created_on DESC LIMIT 1;'
                        ,['USER_EMAIL' => $userEmail]
                        ,TRUE);
                    
                    // Se possuir Imagem de Perfil                    
                    if ( !empty($dados) && !empty($dados[0]->image_name) ):
                        foreach ($dados as $user) {
                            if ( !empty($user->image_name) ):
                                $user->image_name = SITE_URL . "/uploads/user-profile/" . $user->image_name;
                            endif;
                        }
                    endif;
                else:                    
                    http_response_code(406); // Not Acceptable
                    echo json_encode(['msg' => 'Parâmetro E-mail inválido!']);
                    exit;
                endif;    
            
            // Unknown Key
            else:                                
                http_response_code(406); // Not Acceptable
                echo json_encode(['msg' => 'Informe uma Chave (key) correta!']);
                exit;
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
        exit;
    endif;
endif;


#############################################################################################

// # POST (INCLUSÃO)
// No INSOMINIA, utilizar o "MULTIPART FORM" (Structured)
if ($_SERVER['REQUEST_METHOD'] == 'POST'):
    
    // Possíveis Requisições:
    // - Inclusão de novos Usuários: 'users.php/?key=newUser'
    // - Alteração da Foto de Perfil: 'users.php/?key=profilePic'

    // echo json_encode( ['verbo_http' => $_SERVER['REQUEST_METHOD']] );

    // Token Validation
    if (!($_POST["token"] === '16663056-351e723be15750d1cc90b4fcd')):        
        http_response_code(401); // Unauthorized
        echo json_encode([
            'error' => true , 
            'msg' => 'Token is not Valid!'
        ]);
        exit;
    endif;

    if ( !Empty($uri) && $uri <> 'index.php' ):        
        $keySearch      = (isset($_GET["key"])) ? $_GET["key"] : ""        ;
    endif;

    // New User
    if ( $keySearch == "newUser" ):
        
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
            http_response_code(406); // Not Acceptable
            echo json_encode([
                'error' => true , 
                'msg' => 'Informe Todos os Parâmetros!'
            ]);
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

    // New Profile Photo
    elseif ( $keySearch == "profilePic" ):        
    
        $user_id = (isset($_POST['user_id']))        ? intval($_POST['user_id']) : 0 ;

        if ( empty($user_id) ):         
            http_response_code(406); // Not Acceptable
            echo json_encode([
                'error' => true ,
                'msg' => 'Informe Todos os Parâmetros!'
            ]);
            exit;
        else:
            // Verifica se o USER existe        
            $dados = CrudDB::select(
                "SELECT u.user_id FROM users u WHERE u.user_id =:USER_ID and activity_status = 1",
                ['USER_ID' => $user_id],
                TRUE
            );

            if ( empty($dados) ):
                http_response_code(406);
                echo json_encode([
                    'error' => true ,
                    'msg'   => 'Usuário ' . $user_id . 'Não encontrado!'
                ]);
                exit;
            endif;

        endif;

        // Checks IMAGES to UPLOAD
        if(isset($_FILES['file']['name']) && !empty($_FILES['file']['name'])):
            
            // Check recieved values
            // echo var_dump($_FILES); // Doesn't work with JS
            // echo json_encode( ['Arquivos' => $_FILES] );            
    
            // Extension
            $imageFileType  = strrchr($_FILES['file']['name'], ".");
            $imageFileType  = strtolower($imageFileType);
    
            // Getting and Defining file name
            $data = new DateTime();
            $fileName = "imagem-" . $data->format('Y-m-d') . "_" . rand(1, 9999) . $imageFileType;
        
            // Locations
            $tmpLocation       = $_FILES['file']['tmp_name'];
            $newLocation       = "uploads/user-profile/".$fileName;
    
    
            // File Sizes
            $fileSize       = $_FILES['file']['size'];
            $maxsize        = 4194304; //bytes (4mb)        
    
            // Acceptable Extensions
            $valid_extensions = array("jpg","jpeg","png");                      
            
            // File Extension Validation
            if ($fileSize > $maxsize):
                http_response_code(406); // Not Acceptable
                echo json_encode([
                    'error' => true ,
                    'msg'   => 'O tamanho do arquivo deve ser de no máximo 4mb!'
                ]);
                exit;
            endif;
    
            // File Size Validation
            if (!in_array(substr(strtolower($imageFileType), 1), $valid_extensions)):
                http_response_code(406); // Not Acceptable
                echo json_encode([
                    'error' => true ,
                    'msg'   => 'Somente os formatos jpg, jpeg e png são permitidos!'
                ]);
                exit;
            endif;                

        endif;

        if (move_uploaded_file($tmpLocation, $newLocation)):
                        
            CrudDB::setTabela('images_profile');

            $dbReturnTwo = CrudDB::insert ([
                'image_name'    => "'" . $fileName . "'" ,
                'user_id'       => "'" . $user_id . "'"
            ]);

            if ($dbReturnTwo):
                http_response_code(201); // Created
                echo json_encode([
                    'error' => false ,
                    'msg' => "Foto de Perfil atualizada com sucesso!"
                ]);
                exit;
            else:
                http_response_code(500); // Internal Server Error                        
                echo json_encode([
                    'error' => true ,
                    'msg' => "Erro ao Inserir Imagem no Banco de Dados!"
                ]);
                exit;
            endif;           
        else:
            http_response_code(500); // Internal Server Error
            echo json_encode([
                'error' => true ,
                'msg'   => 'Tivemos um Erro no Upload da imagem ao Servidor!'
            ]);
            exit;
        endif;        


    else:
        http_response_code(200);
        echo json_encode([
            'error' => true ,
            'msg' => 'Forneça uma Key via get para a operação!'
        ]);
        exit;    
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