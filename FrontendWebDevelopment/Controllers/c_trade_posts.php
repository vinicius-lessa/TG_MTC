<?php
/**
 * File DOC
 * 
 * @Description Controller que faz a relação das Views TradePosts (Anúncios) com o Model (m_tradePosts.php)
 * @ChangeLog 
 *  - Vinícius Lessa - 16/04/2022: Inclusão da documentação de cabeçalho do arquivo + alguns ajustes;
 *  - Vinícius Lessa - 18/04/2022: Criação da condição para requisitar ao MODEL os dados dos anúncios a serem exibidos na home de Anúncios.
 * 
 * @ Notes: Arquivo anteriormente chamado de c_produtos.php
 * 
 */

if (!defined('SITE_URL')) {
  include_once '../config.php';
}

include SITE_PATH . '/Models/m_tradePosts.php';
// include SITE_PATH . '/Models/m_comentario.php';


// Called in: 'trade_posts/home.php'
if ( isset($a_tpList) ) {
  $a_tpList = loadTradePosts(null);
  // $itensCarrosel = carregarDestaques($conn);
}

// Called in: 'trade_posts/home.php'
if ( isset($a_userTradePosts) ) {
  $a_userTradePosts = loadTradePosts($profileID);
  // $itensCarrosel = carregarDestaques($conn);
}


// Called in: 'trade_posts/trade_post_detailed.php' e 'users/chat.php'
if ( isset($post_id) ) :

  if (is_numeric($post_id)) {
    $tpDetails = loadTradePostDetails($post_id);

    // $Comentarios = carregarComentarios($conn, $DetalheProduto);
    // $notaMedia = calculaNotaMedia($Comentarios);
  } else {
    header("location:" . SITE_URL . "/Views/homepage/index.php");
  }

endif;


// Called in: 'trade_posts/new_post.php'
if ( isset($selectCategory) ):
  
  $selectCategory = loadNewTPOptions("categorys");
endif;

// Called in: 'trade_posts/new_post.php'
if ( isset($selectBrand) ):
  
  $selectBrand = loadNewTPOptions("brands");
endif;

// Called in: 'trade_posts/new_post.php'
if ( isset($selectModel) ):
  
  $selectModel = loadNewTPOptions("models");
endif;

// Called in: 'trade_posts/new_post.php'
if ( isset($selectColor) ):
  
  $selectColor = loadNewTPOptions("colors");
endif;





// ********************************************** ANALISAR ********************************************** //

/* ALTERAR PRODUTO NO BANCO  */
if (isset($_GET['produto'])) {
  $cod_produto = $_GET['produto'];
  $selectproduto = selectalterarproduto($conn, $cod_produto);
}
if (isset($_POST['alterar-produto'])) {
  $dados = [];
  foreach ($_POST as $key => $value) {
    if ($key != "alterar-produto") {
      $dados[$key] = ($value);
    }
  }

  $alternomecover = alterImagem($_FILES['cover_img']);
  $alternomebanner = alterImagem($_FILES['banner_img']);

  $dados['cover_img'] =  $alternomecover;
  $dados['banner_img'] = $alternomebanner;

  if (alterarproduto($conn, $dados)) {
    header("location:" . SITE_URL . "/Views/produtos/prod-index.php");
  } else {
    echo 'Erro ao alterar o cadastro no banco';
  }
  exit;
}

/*Listar os violoes*/
if (isset($listaVioloes)) {
    $listaVioloes = carregarProdutosCategoria($conn, $codCategoria, $limit, $offset);
}

/*Listar as guitarras*/
if (isset($listaGuitarras)) {
  $listaGuitarras = carregarProdutosCategoria($conn, $codCategoria, $limit, $offset);
}

/*Listar as baterias*/
if (isset($listaBaterias)) {
    $listaBaterias = carregarProdutosCategoria($conn, $codCategoria, $limit, $offset);
}


/* ================================================================================ */

/* ALTERAR CATEGORIA NO BANCO */
if (isset($_POST['alterar-categoria'])) {
    $dados = [];
    foreach ($_POST as $key => $value) {
        if ($key != "alterar-categoria") {
            $dados[$key] = ($value);
        }
    }
    if (alterarcategoria($dados, $conn)) {
        header("location:" . SITE_URL . "/Views/produtos/categ-index.php");
    } else {
        echo 'Erro ao alterar o cadastro no banco';
    }
    exit;
}

/* DELETAR PRODUTOS NO BANCO */

if (isset($_POST['deletar-produto'])) {

  if (isset($_GET['produto'])) {
    $cod_produto = $_GET['produto'];
    $selectproduto = selectalterarproduto($conn, $cod_produto);

    if ($selectproduto > 0 && deletarproduto($conn, $cod_produto)) {
      header("location:" . SITE_URL . "/Views/produtos/prod-index.php");
    } else {
      echo 'Erro ao Deletar o cadastro no banco';
    }
    exit;
    
  } else {
    header("location:" . SITE_URL . "/Views/produtos/prod-index.php");
  }
}