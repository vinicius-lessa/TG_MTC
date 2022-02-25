<?php    
// CRUD TABELA DE HIGHSCORE
    
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS');
header('Content-type: application/json; charset=UTF-8');

require_once 'classes/Class.Crud.php';

# Estabelece Conexão com o BANCO DE DADOS

// Class.Conexao.php
$pdo = ConexaoDB::getConexao();

// Class.Class.Crud.php
CrudGame::setConexao($pdo);

// Parâmetro passado pela URL
$uri = basename($_SERVER['REQUEST_URI']);

#############################################################################################
    
// ### GET (Consulta)
if ($_SERVER['REQUEST_METHOD'] == 'GET'):
    
    // echo json_encode( ['verbo_http' => $_SERVER['REQUEST_METHOD']] );

    if ( !Empty($uri) && $uri <> 'index.php' ):    
        // "WORLD RECORDS"
        if ($uri == 'allData'):                
            $dados = CrudGame::select('SELECT * FROM highscore ORDER BY score DESC LIMIT 10',[],TRUE);
        
        
        // "HIGHEST SCORE + PERSONAL BEST"
        else:
            if (!is_numeric($uri)):
                $dados = CrudGame::select("
                    (SELECT id, score, playername, data FROM highscore ORDER BY score DESC LIMIT 1)
                    UNION
                    (SELECT id, score, playername, data FROM highscore WHERE playername = :PLAYER_NAME ORDER BY score DESC LIMIT 1)"
                    ,['PLAYER_NAME' => $uri]
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


// ### POST (INCLUSÃO)
// No INSOMINIA, utilizar o "MULTIPART FORM" (Structured)    
if ($_SERVER['REQUEST_METHOD'] == 'POST'):
    
    // echo json_encode( ['verbo_http' => $_SERVER['REQUEST_METHOD']] );

    $id         = (isset($_POST['id'])) ? $_POST['id'] : ''                             ;
    $playerName = (isset($_POST['playername'])) ? $_POST['playername'] : ''             ;
    $score      = (isset($_POST['score'])) ? $_POST['score'] : ''                       ;
    $date       = 'CURDATE()'                                                           ;

    if (empty($playerName) or empty($score)):
        echo json_encode(['mensagem' => 'Informe Todos os Parâmetros!']);
        http_response_code(406);
        exit;
    endif;

    # TEMPORARIAMENTE FAÇO UM SELECT PARA VERIFICAR SCORE JÁ EXISTENTE DE PLAYER
    $dados = CrudGame::select(
        'SELECT score FROM highscore WHERE playername = :PLAYER_NAME ORDER BY score DESC LIMIT 1',
        ['PLAYER_NAME' => $playerName],
        TRUE);

    # SE PLAYER JÁ EXISTE, UPDADE
    if (!Empty($dados)):
        if (empty($id)):
            echo json_encode(['mensagem' => 'Informe o ID do player a ser Atualizado!']);
            http_response_code(406);
            exit;
        endif;

        CrudGame::setTabela('highscore');
        $retorno = CrudGame::update(['score' => $score, 'data' => $date], ['id' => $id, 'playername' => "'" . $playerName . "'"]);

        if ($retorno):
            http_response_code(202);
            echo json_encode(['mensagem' => 'Score Atualizado com Sucesso!']);
        else:
            http_response_code(500);
            echo json_encode(['mensagem' => 'Erro ao Atualizar Score!']);
        endif;  
    # SE PLAYER NÃO EXISTE, INSERT
    else:
        CrudGame::setTabela('highscore');
        $retorno = CrudGame::insert(['playername' => "'" . $playerName . "'", 'score' => $score, 'data' => $date]);
    
        if ($retorno):
            http_response_code(201);
            echo json_encode(['mensagem' => 'Novo Score Inserido com Sucesso!']);
        else:            
            http_response_code(500);
            echo json_encode(['mensagem' => 'Erro ao inserir novo Score!']);
        endif;
    endif;
endif;


// **************** PUT (ALTERAÇÃO) !!!!!!!!!!!!!!!!!!!! NÃO UTILIZADO
// No INSOMINIA, utilizar o "FORM URL ENCOCODED" (Structured)
if ($_SERVER['REQUEST_METHOD'] == 'PUT'):
    
    echo json_encode( ['verbo_http' => $_SERVER['REQUEST_METHOD']] );

    // PHP NAO POSSUI PUT POR ORIGEM
//     parse_str(file_get_contents('php://input'), $_PUT);

//     $id         = (isset($_PUT['id'])) ? $_PUT['id'] : ''                               ;
//     $playerName = (isset($_PUT['playername'])) ? "'" . $_PUT['playername'] . "'" : ''   ;        
//     $score      = (isset($_PUT['score']) && $_PUT['score'] > 0) ? $_PUT['score'] : ''   ;
//     $date       = 'CURDATE()'                                                           ;

//     # Verifies recieved parameters
//     // echo json_encode( ["ID" => $id, "NOME" => $playerName, "SCORE" => $score]);

//     if (empty($id)):
//         echo json_encode(['mensagem' => 'Informe o ID do Player']);
//         http_response_code(406);
//         exit;
//     elseif(empty($playerName)):
//         echo json_encode(['mensagem' => 'Informe o Nickname do Player']);
//         http_response_code(406);
//         exit; 
//     elseif(empty($score)):
//         echo json_encode(["mensagem" => "Informe o SCORE a ser atualizado"]);
//         http_response_code(406);
//         exit;
//     endif;

//     CrudGame::setTabela('highscore');
//     $retorno = CrudGame::update(['score' => $score, 'data' => $date], ['id' => $id, 'playername' => $playerName]);

//     if ($retorno):
//         http_response_code(202);
//         echo json_encode(['mensagem' => 'Score Atualizado com Sucesso!']);
//     else:
//         http_response_code(500);
//         echo json_encode(['mensagem' => 'Erro ao Atualizar Score!']);
//     endif;
endif;


// ********************* DELETE !!!!!!!!!!!!!!!!!!!! NÃO UTILIZADO
if ($_SERVER['REQUEST_METHOD'] == 'DELETE'):
    
    // echo json_encode( ['verbo_http' => $_SERVER['REQUEST_METHOD']] );

    // if (!is_numeric($uri)):
    //     echo json_encode(['mensagem' => 'O parâmetro não é numérico']);
    //     http_response_code(406);
    //     exit;
    // else:
    //     $dados = CrudGame::select('SELECT id FROM estoque WHERE id = :id', ['id' => $uri], FALSE);
    //     if (!empty($dados)):
    //         // Exclui da Tabela ESTOQUE
    //         CrudGame::setTabela('estoque');
    //         $retorno = CrudGame::delete(['id' => $uri]);

    //         // Exclui da tabela MOVIMENTAÇÃO_ESTOQUE
    //         CrudGame::setTabela('movimentacao_estoque');
    //         $retornoMov = CrudGame::delete(['id_produto' => $uri]);

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