<?php
/**
 * File DOC
 * 
 * @Description Model chamado e utilizado pelo Controler de TradePosts (Anúncios).
 * @ChangeLog 
 *  - Vinícius Lessa - 16/04/2022: Inclusão da documentação de cabeçalho do arquivo + alguns ajustes.
 *  - Vinícius Lessa - 18/04/2022: Inclusão da função para consumo REST API dos anúncios a serem exibidos ("loadTradePosts()"). 
 *                                 Implementação da função para consulta dos detalhes do Anúncio ("loadTradePostDetails()")
 * 
 * @ Notes: Arquivo anteriormente chamado de m_produtos.php
 * 
 */


// FUNCTIONS

function loadTradePosts($userID){

    // $url = "http://localhost/FATEC/_GitFinal/TG_TMC_BACKEND/SERVIDOR/anuncios.php/anuncios/";
    // $ch = curl_init($url);
    // curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    // curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    // curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");

    // $response = json_decode(curl_exec($ch));

    $token  = "16663056-351e723be15750d1cc90b4fcd";
    if ( $userID == null ):
      $url    = BACKEND_URL . "/trade_posts.php/?token=" . $token . "&key=all"; // All TP
    else:
      $url    = BACKEND_URL . "/trade_posts.php/?token=" . $token . "&key=all&user_id=" . $userID; // All TP from Especic User
    endif;

    $opts = array('http' =>
        array(
          'method'        =>"GET",
          'header'        => 'Content-Type: application/x-www-form-urlencoded',
          'ignore_errors' => true
        )
    );
      
    $context = stream_context_create($opts);

    // file_get_contents
    $returnJson = file_get_contents($url, false, $context);
    
    // Tranforms Json in Array
    $aData = json_decode($returnJson, true); // Trasnforma em Array

    if (count($aData) == 0 || $aData == false):
      $aData = ['erro'=> true, 'msg' => "<div class='alert alert-danger' role='alert'>Erro: Problemas na requisição ao Servidor!</div>"];
    endif;
    
    return $aData;
}


function loadTradePostDetails($tradePostID){
  $token  = "16663056-351e723be15750d1cc90b4fcd";
  $url    = BACKEND_URL . "/trade_posts.php/?token=" . $token . "&key=". $tradePostID;

  $opts = array('http' =>
      array(
        'method'        =>"GET",
        'header'        => 'Content-Type: application/x-www-form-urlencoded',
        'ignore_errors' => true
      )
  );
    
  $context = stream_context_create($opts);

  // file_get_contents
  $returnJson = file_get_contents($url, false, $context);
  
  // Tranforms Json in Array
  $aData = json_decode($returnJson, true); // Trasnforma em Array

  if (count($aData) == 0 || $aData == false):
    $aData = ['erro'=> true, 'msg' => "<div class='alert alert-danger' role='alert'>Erro: Problemas na requisição ao Servidor!</div>"];
  endif;
  
  return $aData;
}


function loadNewTPOptions($type){

  $token  = "16663056-351e723be15750d1cc90b4fcd";  

  switch( $type ){
    case "categorys":
      $url = BACKEND_URL . "/trade_posts.php/?token=" . $token . "&key=categorys"; // All Categorys;
      break;

    case "brands":
      $url = BACKEND_URL . "/trade_posts.php/?token=" . $token . "&key=brands"; // All Brands;
      break;

    case "models":
      $url = BACKEND_URL . "/trade_posts.php/?token=" . $token . "&key=models"; // All Models;
      break;

    case "colors":
      $url = BACKEND_URL . "/trade_posts.php/?token=" . $token . "&key=colors"; // All Colors;
      break;
  }  

  $opts = array('http' =>
      array(
          'method'        =>"GET",
          'header'        => 'Content-Type: application/x-www-form-urlencoded',
          'ignore_errors' => true
      )
  );
    
  $context = stream_context_create($opts);

  // file_get_contents
  $returnJson = file_get_contents($url, false, $context);
  
  // Tranforms Json in Array
  $aData = json_decode($returnJson, true); // Trasnforma em Array

  if (count($aData) == 0 || $aData == false):
    $aData = [
      'erro'=> true , 
      'msg' => "<div class='alert alert-danger' role='alert'>Erro: Problemas na requisição ao Servidor!</div>"
    ];

  endif;
  
  return $aData;
}


// ********************************************** ANALISAR ********************************************** //


/* FUNÇÃO PARA PESQUISAR O PRODUTO DO CAMPO PESQUISA */
function pesquisarProduto($conn, $produtoPesquisa)
{
  $produtoPesquisa = "%" . $produtoPesquisa . "%";
  $sql = "SELECT  p.cod_produto, p.nome_prod, p.descricao_prod, p.cover_img, p.valor_un, c.nome_categoria
    FROM produto p INNER JOIN categoria c ON p.cod_categoria = c.cod_categoria 
    WHERE p.nome_prod LIKE ? ";

  $stmt = $conn->prepare($sql);
  $stmt->bind_param("s", $produtoPesquisa);
  $stmt->execute();
  $result = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
  // $result = $stmt->get_result()->fetch_assoc();
  $stmt->close();
  return $result;
}

/* ================================================================================ */

/* ALTERAR CATEGORIA NO BANCO */
function alterarcategoria($dados, $conn)
{
  $sql = 'UPDATE categoria SET nome_categoria = ? WHERE cod_categoria = ?';
  $stmt = $conn->prepare($sql);
  $stmt->bind_param("si", $dados['nome_categoria'], $dados['cod_categoria']);
  $result = $stmt->execute() ? true : false;
  $stmt->close();
  return $result;
}

/* ================================================================================ */

/* FUNÇÃO PARA CARREGAR OS DADOS DAS IMAGENS PARA ALTERAÇÃO */
function alterImagem($arquivo)
{
  $data = new DateTime();
  $arquivotemp = $arquivo['tmp_name'];
  $nomeoriginal = $arquivo['name'];
  $nomeproduto = "imagem-" . $data->format('dmY') . $data->format('His') . rand(1, 9999) . alterpegarExtensão($nomeoriginal);

  if (move_uploaded_file($arquivotemp, SITE_PATH . "/images/produtos/" . $nomeproduto)) {
    return $nomeproduto;
  } else {
    return false;
  }
}

function alterpegarExtensão($nome)
{
  return strrchr($nome, ".");
}

/* FUNÇÃO PARA FAZER O SELECT QUE VAI CARREGAR OS DADOS "VIA $_GET" PARA ALTERAÇÃO/DELEÇÃO DO PRODUTO */
function selectalterarproduto($conn, $cod_produto)
{
  $sql = "SELECT p.nome_prod, p.descricao_prod, p.valor_un, p.cover_img, p.banner_img, p.estoque, c.cod_categoria, p.destaque, p.tipo_prod, p.modelo_prod, p.localizacao_prod
    FROM produto p INNER JOIN categoria c ON p.cod_categoria = c.cod_categoria WHERE p.cod_produto = ?";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param("i", $cod_produto);

  $stmt->execute();

  $result = $stmt->get_result()->fetch_assoc();
  $stmt->close();
  return $result;
}

function alterarproduto($conn, $dados)
{
  $sql = 'UPDATE produto SET nome_prod = ? , descricao_prod = ?, valor_un = ?, cover_img = ?, banner_img = ?, estoque = ?, cod_categoria = ?, destaque = ?, tipo_prod = ?, modelo_prod = ?, localizacao_prod = ? WHERE cod_produto = ?';
  $stmt = $conn->prepare($sql);
  $stmt->bind_param("ssdssiiiisss", $dados['nome_prod'], $dados['descricao_prod'], $dados['valor_un'], $dados['cover_img'], $dados['banner_img'], $dados['estoque'], $dados['cod_categoria'], $dados['destaque'], $dados['cod_produto'], $dados['tipo_prod'], $dados['modelo_prod'], $dados['localizacao_prod']);
  $result = $stmt->execute() ? true : false;
  $stmt->close();
  return $result;
  // print_r($result);
}

function deletarproduto($conn, $dados)
{
  // Chave Estrangeira - Comentários
  $sql = 'DELETE FROM comentario WHERE cod_produto = ?';  
  $stmt = $conn->prepare($sql);
  $stmt->bind_param('i', $dados);

  $stmt->execute();

  // Chave Primária
  $sql2 = 'DELETE FROM produto WHERE cod_produto = ?';
  $stmt = $conn->prepare($sql2);
  $stmt->bind_param('i', $dados);

  $result = $stmt->execute() ? true : false;

  $stmt->close();

  return $result;
}

/* FUNÇÃO PARA LISTAR OS PRODUTOS DE ACORDO COM A CATEGORIA */
function carregarProdutosCategoria($conn, $codCategoria, $limit = 12, $offset = 0)
{
  $sql = "SELECT  p.cod_produto, p.nome_prod, p.descricao_prod, p.valor_un, p.cover_img, p.estoque, c.nome_categoria
    FROM produto p  INNER JOIN categoria c ON p.cod_categoria = c.cod_categoria 
    WHERE p.cod_categoria = ? ORDER BY p.nome_prod ASC  LIMIT ? OFFSET ? ";

  $stmt = $conn->prepare($sql);
  $stmt->bind_param("iii", $codCategoria, $limit, $offset);

  $stmt->execute();
  $result = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
  $stmt->close();
  return $result;
}