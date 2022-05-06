<?php    
/**
 * File DOC
 * 
 * @Description Here the USERS table is manipulated
 * @ChangeLog 
 *  - Vinícius Lessa - 16/03/2022: Mudanças importantes para requisições utilizando o método GET. Agora, o servidor irá tratar parâmetros na URL.
 *  - Vinícius Lessa - 28/03/2022: Impletementação e testes na inserção de usuários via POST.
 *  - Vinícius Lessa - 14/04/2022: Diversos ajustes nos últimos dias, referentes a Consulta e Inclusão de usuários. Função 'ServerRespose()' removida.
 *  - Vinícius Lessa - 05/05/2022: Melhoria no processo de troca de fotos de perfil, onde a última foto utiliza é deletada Físicamente e do Banco de Dados.
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
    // For example: .../users.php/?token=...&key=email&value=vinicius@gmail.com

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
                $dbReturn = CrudDB::select(
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
                if (!empty($dbReturn)):
                    
                    for ($i = 0; $i < count($dbReturn); $i++) {
                    
                        if ( !empty($dbReturn[$i]->image_name) ):
                            $dbReturn[$i]->image_name = SITE_URL . "/uploads/user-profile/" . $dbReturn[$i]->image_name;
                        endif;

                        // Consulta Cep e Adicina no Retorno
                        if ( !empty($dbReturn[$i]->cep) ):

                            $dadosCEP = ViaCEP::consultarCEP($dbReturn[$i]->cep);

                            if ( $dadosCEP != null ):
                                // Adiciona nova Propriedade ao Objeto
                                $dbReturn[$i] = (array)$dbReturn[$i];
                                switch ($dadosCEP["uf"]) {
                                    case 'AC':
                                        $dbReturn[$i]['state'] = 'AC - Acre';
                                        break;
                                    case 'AL':
                                        $dbReturn[$i]['state'] = 'AL - Alagoas';
                                        break;
                                    case 'AM':
                                        $dbReturn[$i]['state'] = 'AM - Amazonas';
                                        break;
                                    case 'AP':
                                        $dbReturn[$i]['state'] = 'AP - Amapá';    
                                        break;
                                    case 'BA':
                                        $dbReturn[$i]['state'] = 'BA - Bahia';
                                        break;
                                    case 'CE':
                                        $dbReturn[$i]['state'] = 'CE - Ceará';
                                        break;
                                    case 'DF':
                                        $dbReturn[$i]['state'] = 'DF - Distrito Federal';
                                        break;
                                    case 'ES':
                                        $dbReturn[$i]['state'] = 'ES - Espírito Santo';
                                        break;
                                    case 'GO':
                                        $dbReturn[$i]['state'] = 'GO - Goiás';
                                        break;
                                    case 'MA':
                                        $dbReturn[$i]['state'] = 'MA - Maranhão';
                                        break;
                                    case 'MT':
                                        $dbReturn[$i]['state'] = 'MT - Mato Grosso ';
                                        break;
                                    case 'MS':
                                        $dbReturn[$i]['state'] = 'MS - Mato Grosso do Sul';
                                        break;
                                    case 'MG':
                                        $dbReturn[$i]['state'] = 'MG - Minas Gerais';
                                        break;
                                    case 'PA':
                                        $dbReturn[$i]['state'] = 'PA - Pará';
                                        break;
                                    case 'PB':
                                        $dbReturn[$i]['state'] = 'PB - Paraíba';
                                        break;
                                    case 'PR':
                                        $dbReturn[$i]['state'] = 'PR - Paraná';
                                        break;
                                    case 'PE':
                                        $dbReturn[$i]['state'] = 'PE - Pernambuco';
                                        break;
                                    case 'PI':
                                        $dbReturn[$i]['state'] = 'PI - Piauí';
                                        break;
                                    case 'RJ':
                                        $dbReturn[$i]['state'] = 'RJ - Rio de Janeiro';
                                        break;
                                    case 'RN':
                                        $dbReturn[$i]['state'] = 'RN - Rio Grande do Norte';
                                        break;
                                    case 'RS':
                                        $dbReturn[$i]['state'] = 'RS - Rio Grande do Sul';
                                        break;
                                    case 'RO':
                                        $dbReturn[$i]['state'] = 'RO - Rondônia';
                                        break;
                                    case 'RR':
                                        $dbReturn[$i]['state'] = 'RR - Roraima';
                                        break;
                                    case 'SC':
                                        $dbReturn[$i]['state'] = 'SC - Santa Catarina';
                                        break;
                                    case 'SP':
                                        $dbReturn[$i]['state'] = 'SP - São Paulo';
                                        break;
                                    case 'SE':
                                        $dbReturn[$i]['state'] = 'SE - Sergipe';
                                        break;
                                    case 'TO':
                                        $dbReturn[$i]['state'] = 'TO - Tocantins';
                                        break;
                                }                                
                                $dbReturn[$i]['city'] = $dadosCEP["localidade"];
                                $dbReturn[$i]['district'] = $dadosCEP["bairro"];
                                $dbReturn[$i] = (object)$dbReturn[$i];
                            endif;
                        endif;
                        
                    }

                    http_response_code(200);
                    echo json_encode([
                        'error' => false ,
                        'data'  => $dbReturn
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
                    $dbReturn = CrudDB::select(
                        'SELECT u.user_id,
                                u.user_name,
                                u.password,
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
                    
                    if (!empty($dbReturn)):
                        for ($i = 0; $i < count($dbReturn); $i++) {
                    
                            if ( !empty($dbReturn[$i]->image_name) ):
                                $dbReturn[$i]->image_name = SITE_URL . "/uploads/user-profile/" . $dbReturn[$i]->image_name;
                            endif;

                            // Consulta Cep e Adicina no Retorno
                            if ( !empty($dbReturn[$i]->cep) ):

                                $dadosCEP = ViaCEP::consultarCEP($dbReturn[$i]->cep);

                                if ( $dadosCEP != null ):
                                    // Adiciona nova Propriedade ao Objeto
                                    $dbReturn[$i] = (array)$dbReturn[$i];
                                    switch ($dadosCEP["uf"]) {
                                        case 'AC':
                                            $dbReturn[$i]['state'] = 'AC - Acre';
                                            break;
                                        case 'AL':
                                            $dbReturn[$i]['state'] = 'AL - Alagoas';
                                            break;
                                        case 'AM':
                                            $dbReturn[$i]['state'] = 'AM - Amazonas';
                                            break;
                                        case 'AP':
                                            $dbReturn[$i]['state'] = 'AP - Amapá';    
                                            break;
                                        case 'BA':
                                            $dbReturn[$i]['state'] = 'BA - Bahia';
                                            break;
                                        case 'CE':
                                            $dbReturn[$i]['state'] = 'CE - Ceará';
                                            break;
                                        case 'DF':
                                            $dbReturn[$i]['state'] = 'DF - Distrito Federal';
                                            break;
                                        case 'ES':
                                            $dbReturn[$i]['state'] = 'ES - Espírito Santo';
                                            break;
                                        case 'GO':
                                            $dbReturn[$i]['state'] = 'GO - Goiás';
                                            break;
                                        case 'MA':
                                            $dbReturn[$i]['state'] = 'MA - Maranhão';
                                            break;
                                        case 'MT':
                                            $dbReturn[$i]['state'] = 'MT - Mato Grosso ';
                                            break;
                                        case 'MS':
                                            $dbReturn[$i]['state'] = 'MS - Mato Grosso do Sul';
                                            break;
                                        case 'MG':
                                            $dbReturn[$i]['state'] = 'MG - Minas Gerais';
                                            break;
                                        case 'PA':
                                            $dbReturn[$i]['state'] = 'PA - Pará';
                                            break;
                                        case 'PB':
                                            $dbReturn[$i]['state'] = 'PB - Paraíba';
                                            break;
                                        case 'PR':
                                            $dbReturn[$i]['state'] = 'PR - Paraná';
                                            break;
                                        case 'PE':
                                            $dbReturn[$i]['state'] = 'PE - Pernambuco';
                                            break;
                                        case 'PI':
                                            $dbReturn[$i]['state'] = 'PI - Piauí';
                                            break;
                                        case 'RJ':
                                            $dbReturn[$i]['state'] = 'RJ - Rio de Janeiro';
                                            break;
                                        case 'RN':
                                            $dbReturn[$i]['state'] = 'RN - Rio Grande do Norte';
                                            break;
                                        case 'RS':
                                            $dbReturn[$i]['state'] = 'RS - Rio Grande do Sul';
                                            break;
                                        case 'RO':
                                            $dbReturn[$i]['state'] = 'RO - Rondônia';
                                            break;
                                        case 'RR':
                                            $dbReturn[$i]['state'] = 'RR - Roraima';
                                            break;
                                        case 'SC':
                                            $dbReturn[$i]['state'] = 'SC - Santa Catarina';
                                            break;
                                        case 'SP':
                                            $dbReturn[$i]['state'] = 'SP - São Paulo';
                                            break;
                                        case 'SE':
                                            $dbReturn[$i]['state'] = 'SE - Sergipe';
                                            break;
                                        case 'TO':
                                            $dbReturn[$i]['state'] = 'TO - Tocantins';
                                            break;
                                    }
                                    $dbReturn[$i]['city'] = $dadosCEP["localidade"];
                                    $dbReturn[$i]['district'] = $dadosCEP["bairro"];
                                    $dbReturn[$i] = (object)$dbReturn[$i];
                                endif;
                            endif;
                        }
                        
                        http_response_code(200);
                        echo json_encode([
                            'error' => false ,
                            'data'  => $dbReturn
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
                    $dbReturn = CrudDB::select('SELECT 
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
                    if ( !empty($dbReturn) && !empty($dbReturn[0]->image_name) ):
                        foreach ($dbReturn as $user) {
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
        // if (!Empty($dbReturn)):
            http_response_code(200);
            echo json_encode($dbReturn);
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

// # POST (CREATE e UPDATE)
// No INSOMINIA, utilizar o "MULTIPART FORM" (Structured)
if ($_SERVER['REQUEST_METHOD'] == 'POST'):
    
    // Possíveis Requisições:
    // - Inclusão de novos Usuários: 'users.php/?key=newUser'
    // - Update de Perfil: 'users.php/?key=updateUser'
    // - Alteração da Foto de Perfil: 'users.php/?key=profilePic'

    // echo json_encode( ['verbo_http' => $_SERVER['REQUEST_METHOD']] );
    // exit;

    // Token Validation
    if (!($_POST["token"] === '16663056-351e723be15750d1cc90b4fcd')):        
        http_response_code(401); // Unauthorized
        echo json_encode([
            'error' => true , 
            'msg' => 'Token is not Valid!'
        ]);
        exit;
    endif;

    // Vars
    $userName       = (isset($_POST['userName'])) ? $_POST['userName'] : '' ;
    $userBirthday   = (isset($_POST['userBirthday'])) ? $_POST['userBirthday'] : '' ;
    $userPhone      = (isset($_POST['userPhone'])) ? $_POST['userPhone'] : '' ;
    $userType       = (isset($_POST['userType'])) ? $_POST['userType'] : '' ;
    $userEmail      = (isset($_POST['userEmail'])) ? $_POST['userEmail'] : '' ;
    $userZipCode    = (isset($_POST['userZipCode'])) ? $_POST['userZipCode'] : '' ;
    $userPassword   = (isset($_POST['userPassword'])) ? $_POST['userPassword'] : '' ;
    $bioText        = (isset($_POST['bioText'])) ? $_POST['bioText'] : '' ;
    


    if ( !Empty($uri) && $uri <> 'index.php' ):        
        $keySearch      = (isset($_GET["key"])) ? $_GET["key"] : ""        ;
    endif;

    // New User
    if ( $keySearch == "newUser" ):       

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
        $dbReturn = CrudDB::select(
            "SELECT email FROM users WHERE email LIKE(:EMAIL) and activity_status = 1",
            ['EMAIL' => $userEmail],
            TRUE
        );

        if (!Empty($dbReturn)):        
            http_response_code(406);
            echo json_encode([
                'error'     => true ,
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
            ]);

            if ($retorno):
                // Consulta a inclusão feita para devolver dados de login automático
                $dbReturn = CrudDB::select('SELECT user_id, user_name, email FROM users WHERE email =:USER_EMAIL AND activity_status = 1 LIMIT 1'
                    ,['USER_EMAIL' => $userEmail]
                    ,TRUE);

                if (!empty($dbReturn)):
                    http_response_code(201);
                    echo json_encode([
                        'error' => false ,
                        'msg'   => 'Usuário inserido com Sucesso!' ,
                        'dados' => $dbReturn 
                    ]);
                else:
                    http_response_code(500);
                    echo json_encode([
                        'error' => true ,
                        'msg' => 'Usuário inserido com sucesso, porém não encontrado para realizar login automático!'
                    ]);
                endif;
                exit;
            else:
                http_response_code(500);
                echo json_encode([
                    'error' => true ,
                    'msg' => 'Erro ao inserir novo Usuário!'
                ]);
            endif;
        endif;

    // Update Profile
    elseif ( $keySearch == "updateUser" ):

        $user_id = (isset($_POST['user_id']) ? intval($_POST['user_id']) : 0 ) ;

        if (empty($userEmail) or
            empty($userName) or
            empty($userPassword) or
            empty($userZipCode) or
            empty($userType) or
            $user_id == 0 || !is_numeric($user_id)
            ):
            http_response_code(406); // Not Acceptable
            echo json_encode([
                'error' => true , 
                'msg' => 'Informe Todos os Parâmetros!'
            ]);
            exit;
        endif;

        // Check If Another User Already Has This E-mail
        $dbReturn = CrudDB::select(
            "SELECT user_id FROM users WHERE email LIKE(:EMAIL) AND user_id <> :USER_ID AND activity_status = 1;",
            [
                'EMAIL'     => $userEmail ,
                'USER_ID'   => $user_id
            ],
            TRUE
        );

        if (!Empty($dbReturn)):
            http_response_code(406); // Unacceptable
            echo json_encode([
                'error'     => true ,
                'msg'       => 'Este e-mail já foi Cadastrado!' ,
                'cod_erro'  => 1
            ]);
            exit;
        else:  

            CrudDB::setTabela('users');
                
            // $dbReturn = true;
            $dbReturn = CrudDB::update([
                'user_name'         => "'" . $userName . "'" ,
                'email'             => "'" . $userEmail . "'" ,
                'password'          => "'" . $userPassword . "'" ,
                'tipo_pessoa'       => "'" . $userType. "'" ,
                'birthday'          => "'" . $userBirthday . "'" ,
                'phone'             => "'" . $userPhone . "'" ,
                'cep'               => "'" . $userZipCode . "'" ,
                'bio'               => "'" . $bioText . "'" ,
            ],
            [            
                'user_id' => $user_id 
            ]);
        
            if ($dbReturn):
                http_response_code(202); // Acccepted
                echo json_encode([
                    'error' => false , 
                    'msg' => 'Perfil Atualizado com Sucesso!'
                ]);
                exit;
            else:
                http_response_code(500); // Internal Error
                echo json_encode([
                    'error' => false , 
                    'msg' => 'Problema ao realizar Atualização no Banco de Dados!'
                ]);
                exit;
            endif;
        endif;

    // New Profile Photo
    elseif ( $keySearch == "profilePic" ):
    
        $user_id = (isset($_POST['user_id']) ? intval($_POST['user_id']) : 0 ) ;

        if ( $user_id == 0 || !is_numeric($user_id) ):
            http_response_code(406); // Not Acceptable
            echo json_encode([
                'error' => true ,
                'msg' => 'Informe Todos os Parâmetros!'
            ]);
            exit;
        else:
            // Verifica se o USER existe        
            $dbReturn = CrudDB::select(
                "SELECT u.user_id FROM users u WHERE u.user_id =:USER_ID and activity_status = 1",
                ['USER_ID' => $user_id],
                TRUE
            );

            if ( empty($dbReturn) ):
                http_response_code(406);
                echo json_encode([
                    'error' => true ,
                    'msg'   => 'Usuário ' . $user_id . 'Não encontrado!'
                ]);
                exit;
            endif;

        endif;

        // Check Profile Last Photo(s)        
        $dbReturn = CrudDB::select(
            "SELECT ip.image_id , ip.image_name, ip.user_id
            FROM images_profile ip
            INNER JOIN users u ON u.user_id = ip.user_id 
            WHERE ip.activity_status = 1 AND
                  ip.user_id =:USER_ID AND
                  u.activity_status = 1;",
            ['USER_ID' => $user_id],
            TRUE
        );

        if ( !empty($dbReturn) ):
            foreach ($dbReturn as $image) {                
                
                // Deletes File within SERVER
                $file = "uploads/user-profile/".$image->image_name;                
                    
                if( is_file($file) ):

                    // delete file
                    if ( !(unlink($file)) ): 

                        http_response_code(500); // Internal Server Error
                        echo json_encode([
                            'error' => true ,
                            'msg' => "Anúncio NÃO Deletado. Problema na Deleção do(s) Arquivo(s) '". $file . "' do SERVER!"
                        ]);
                        exit;
                    else:
                        // Deletes Image in `image_profile` Table
                        CrudDB::setTabela('images_profile');
                        $retorno = CrudDB::delete([
                            'user_id' => $image->user_id ,
                            'image_id' => $image->image_id               
                        ]);

                        // Failed
                        if ( !$retorno ):
                            http_response_code(500); // Internal Server Error
                            echo json_encode([
                                'error' => true ,
                                'msg' => "Problemas para Deletar a imagem Atual de Perfil! ('" . $image->image_name . "')"
                            ]);
                            exit;
                        endif;  
                    endif;
                else:
                    http_response_code(500); // Internal Server Error
                    echo json_encode([
                        'error' => true ,
                        'msg' => "Arquivo '" . $file . "' não encontrado no Servidor!"
                    ]);
                    exit;
                endif;                              
            }
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
        echo json_encode(['msg' => 'Informe Todos os Parâmetros!']);
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
        echo json_encode(['msg' => 'Usuário atualizado com sucesso!']);
    else:
        http_response_code(500);
        echo json_encode(['msg' => 'Erro ao atualizar Usuário!']);
    endif;
endif;


#############################################################################################

// ********************* DELETE
if ($_SERVER['REQUEST_METHOD'] == 'DELETE'):
    
    // echo json_encode( ['verbo_http' => $_SERVER['REQUEST_METHOD']] );

    // if (!is_numeric($uri)):
    //     echo json_encode(['msg' => 'O parâmetro não é numérico']);
    //     http_response_code(406);
    //     exit;
    // else:
    //     $dbReturn = CrudDB::select('SELECT id FROM estoque WHERE id = :id', ['id' => $uri], FALSE);
    //     if (!empty($dbReturn)):
    //         // Exclui da Tabela ESTOQUE
    //         CrudDB::setTabela('estoque');
    //         $retorno = CrudDB::delete(['id' => $uri]);

    //         // Exclui da tabela MOVIMENTAÇÃO_ESTOQUE
    //         CrudDB::setTabela('movimentacao_estoque');
    //         $retornoMov = CrudDB::delete(['id_produto' => $uri]);

    //         if ($retorno):
    //             http_response_code(202);
    //             echo json_encode(['msg' => 'Deletado com sucesso!']);
    //             exit;
    //         else:
    //             http_response_code(500);
    //             echo json_encode(['msg' => 'Problema na deleção do cliente!']);
    //             exit;
    //         endif;
    //     else:
    //         http_response_code(404);
    //         echo json_encode(['msg' => 'O parâmetro informado não foi encontrado']);
    //         exit;
    //     endif;
    // endif;
endif;
?>