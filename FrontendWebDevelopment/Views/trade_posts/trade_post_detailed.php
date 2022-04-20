<?php
/**
 * File DOC
 * 
 * @Description Página de criação de cadastro por parte do usuário do sistema.
 * @ChangeLog 
 *  - Renata Carrillo - 12/04/2022: Padronização do <head> e titlePage;
 *  - Vinícius Lessa - 18/04/2022: Mudanças do nome do arquivo de "trade_post_view.php" para "trade_post_detailed.php".
 *                                 Mudanças nas estruturas html do anúncio. Implementação do consumo de informações do Banco de dados (de acordo com o anúncio clicado).
 *  - Renata Carrillo - 18/04/22: Inclusão dos "outros anúncios"
 * 
 * @ Notes: 
 * 
 */

if (session_status() === PHP_SESSION_NONE) {
  session_start();
}

$a_tpList   = [];

if (!defined('SITE_URL')) {
  include_once '../../config.php';
}

$isLoggedUser = (isset($_SESSION['user_id']) && isset($_SESSION['user_name']) && isset($_SESSION['user_email'])) ? true : false;

$tradePostID = $_GET['trade_post'];

require SITE_PATH . '/Controllers/c_trade_posts.php';

$titlePage = $tpDetails['data'][0]['title'];

?>

<!DOCTYPE html>
<html lang="pt-br" class="h-100">
  <head>
  <meta charset='utf-8'>    
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>

    <!-- Page Data -->
    <meta name="author" content="Vinícius Lessa / Renata Carrillo">
    <meta name="description" content="Página de criação de cadastro por parte do usuário do sistema.">
    <title> <?php echo $titlePage; ?> </title>
    
    <!-- StyleSheet -->
    <link rel="stylesheet" href="<?php echo SITE_URL ?>/css/bootstrap/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css"> <!-- Icons -->
    <link rel="stylesheet" href="<?php echo SITE_URL ?>/css/style.css">
    
    
    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="<?php echo SITE_URL ?>/images/icon.png">
  </head>

  <body class="d-flex flex-column h-100 bk-black font-main">
    
    <!-- Header Include -->
    <?php include SITE_PATH . '/includes/header.php'; ?>
    
    <!-- Begin page content -->
    <main>
      <div class="container">
        <?php       
          if (isset($tpDetails) && !$tpDetails["error"]) {            
        ?>
          <div class="row">
            <div class="col-12 col-sm-6 mt-5">
              <h1 class="text-white"><strong><?php echo $tpDetails['data'][0]['title']?></strong></h1>
            </div>
            <div class="text-gray">
              <span>Anúncio #<?php echo $tpDetails['data'][0]['post_id']?></span>
            </div>
            <hr>
          </div>        
          <!-- Trade Post Details -->
          <div class="row">
            <div class="col-8 col-sm-8">
              <a href="#">
                <img src="<?php echo $tpDetails["data"][0]["image_name"] ?>" class="img-fluid" alt="" style="max-width:100%;width:695px;height:595px;object-fit:cover;">
              </a>
            </div>
            
            <div class="col-4 col-sm-4">
                <img src="<?php echo $tpDetails["data"][0]["image_name"] ?>" class="img-fluid" alt="" style="max-width:100%;width:395px;height:295px;object-fit:cover;">
                <img src="<?php echo $tpDetails["data"][0]["image_name"] ?>" class="img-fluid mt-3" alt="" style="max-width:100%;width:395px;height:295px;object-fit:cover;">
            </div>
          </div>
                    
          <!-- Principais Informações -->
          <div class="row mt-4">
            <div class="col-12 col-sm-8">
              <div>  
                <h5 class="card-title text-white mt-2" style="text-align:left;"><strong>SOBRE</strong></h5>
              </div>
              <div class="mt-4">
                <p class="card-title text-white" style="text-align:left;"><?php echo $tpDetails["data"][0]["tp_desc"] ?></p>
              </div>
            </div>
            <div class="col-12 col-sm-4 mt-3 mt-4">
              <div class="row">
                <div class="col-12 col-sm-8">
                  <span class="text-white">Valor:</span><h4 class="text-red"><strong>R$ <?php echo $tpDetails["data"][0]["price"] ?></strong></h4>
                </div>
                <div class="col-12 col-sm-4">
                  <a  class="text-white" 
                      href="<?php echo SITE_URL ?>/Views/users/chat.php/?user=<?php echo $tpDetails["data"][0]["user_id"]?>&post_id=<?php echo $tpDetails["data"][0]["post_id"]?>">
                      <button type="button" class="btn btn-danger btn-lg border-0">
                        <strong>CHAT</strong>
                      </button>
                  </a>
                </div>
              </div>
            </div>
          </div>

          <!-- Outras Informações sobre o Anúncio -->
          <div class="row mt-3">
            <div class="col-12 col-sm-4">
              <ul class="list-group list-group-flush">
                <li class="list-group-item bk-black text-white">Categoria: <strong><?php echo $tpDetails["data"][0]["pc_desc"] ?></strong></li>
                <li class="list-group-item bk-black text-white">Marca: <strong><?php echo $tpDetails["data"][0]["pb_desc"] ?></strong></li>
                <li class="list-group-item bk-black text-white">Modelo: <strong><?php echo $tpDetails["data"][0]["pm_desc"] ?></strong></li>
                <li class="list-group-item bk-black text-white">Estado: <strong>São Paulo</strong></li>
              </ul>
            </div>
              
            <div class="col-12 col-sm-4">
              <ul class="list-group list-group-flush">
                <li class="list-group-item bk-black text-white">Cidade: <strong>São Roque</strong></li>
                <li class="list-group-item bk-black text-white">Bairro: <strong></strong></li>                
                <li class="list-group-item bk-black text-white">Telefone: <strong><?php echo $tpDetails["data"][0]["phone"] ?></strong></li>
              </ul>
            </div>

            <!-- Autor do Anúncio -->
            <div class="col-12 col-sm-4 text-white">
              <div class="row">
                <div class="col-12 d-flex justify-content-center">
                  <h5>Anunciante</h5>
                </div>
              </div>
              <div class="row">
                <div class="col-12 d-flex justify-content-center">
                <a href="<?php echo SITE_URL ?>/Views/users/user_profile.php/?user_id=<?php echo $tpDetails["data"][0]["user_id"] ?>" class="nav-link px-4 link-secondary"><img src="<?php echo SITE_URL ?>/images/icons/profile.png" class="img-fluid" alt="" width="100px" height="100px"></a>
                </div>
              </div>
              <div class="row">
                <div class="col-12 d-flex justify-content-center">
                  <h5>
                    <a href="<?php echo SITE_URL ?>/Views/users/user_profile.php/?user_id=<?php echo $tpDetails["data"][0]["user_id"] ?>" 
                    class="text-decoration-none text-white">
                      <strong>
                        <?php echo $tpDetails["data"][0]["user_name"] ; 
                              echo ( $tpDetails["data"][0]["user_id"] === $_SESSION['user_id'] ? " (Você)" : null ); 
                        ?>
                      </strong>
                    </a>
                  </h5>
                </div>
              </div>
            </div>
          
          </div>

        <?php } else {  ?>   
          <!-- Problemas ao Solicitar informações ao Server -->
          <div class="row text-center mb-4">
            <h3 class="text-white">Desculpe, não encontramos nada por aqui!</h3>
          </div>
          <div class="row text-center mb-4">
            <p class="text-white"><?php echo $tpDetails['msg'] ?></p>
          </div>            
        <?php } ?>
      </div>
    </main>

    <div class="container mt-5">
      <div class="row">
        <div class="col-12 col-sm-12 mt-5">
          <h1 class="text-white"><strong>OUTROS &nbsp;A N Ú N C I O S</strong></h1>
        </div>
          <hr></hr>
      </div>
    </div>

    <!-- OUTROS ANÚNCIOS-->
    <!-- Trade Posts (Anúncios) vindos do Banco de Dados -->
    <section>
      <?php 
        if (isset($a_tpList) && !$a_tpList["error"]) {
      ?>
        <div class="container mb-5">
          <div class="row">          
            <?php foreach ($a_tpList["data"] as $a_tpItem) { ?>
              <!--
                > 990 (lg)= 3 
                < 990 (md)= 2
                > 575 (sm)= 1 
              -->
              <div class="col-12 col-sm-6 col-lg-4 mt-3">
                <div>
                  <a href="<?php echo SITE_URL ?>/Views/trade_posts/trade_post_detailed.php/?trade_post=<?php echo $a_tpItem['post_id'] ?>">
                    <img src="<?php echo $a_tpItem['image_name'] ?>" class="img-fluid" alt="" style="max-width:100%;width:395px;height:240px;object-fit:cover;">
                  </a>
                </div>
                  <p class="card-title text-white mt-2" style="text-align:left;"><strong><?php echo $a_tpItem['title'] ?></strong></p>
                  <p class="card-title text-red" style="text-align:left;"><strong><small>R$</small><?php echo number_format($a_tpItem['price'], 2, ',', '.') ?></strong></p>
              </div>            
            <?php } ?>
          </div>
        </div>
      <?php } else {  ?>
        <div class="container mt-5 mb-5">
          <div class="row text-center mb-4">
            <h3 class="text-white">Desculpe, não encontramos nada por aqui!</h3>
          </div>
          <div class="row text-center mb-4">
            <p class="text-white"><?php echo $a_tpList['msg'] ?></p>
          </div>
        </div>
      <?php } ?>
    </section>

    <!-- ENCONTRE ARTISTAS -->
    <div class="card-group">
      <div class="col-12 col-sm-2"></div>

      <div class="bk-gray col-12 col-sm-8 text-white" style="border-style:solid;border-color:gray;">
        <div class="row ms-5 mt-3 mb-3 me-5">
            <h3 class="mt-2"><strong>Encontre artistas de diversos genêros</strong></h3>
            <p>Você tem a possibilidade de divulgar o seu trabalho, e encontrar artistas próximos.</p>
          <div class="col-12 col-sm-4 mt-1">
            <a class="text-white" style="font-size:14px;" href="<?php echo SITE_URL ?>/Views/produtos/MusicTradeCenter.php""><button type="button" class="btn btn-danger btn-lg border-0 mt-3"><strong>VER MAIS</strong></button></a>  
          </div>
        </div>
      </div>

      <div class="col-12 col-sm-2"></div>
    </div>

    <!-- Footer Include -->
    <?php include SITE_PATH . '/includes/footer.php'; ?>    
  
    <!-- Scripts -->    
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="<?php echo SITE_URL ?>/js/bootstrap.bundle.min.js"></script>
    <script src="<?php echo SITE_URL ?>/js/main.js"></script>
    
    
  </body>

</html>