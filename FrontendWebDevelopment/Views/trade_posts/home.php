<?php
/**
 * File DOC
 * 
 * @Description Página de criação de cadastro por parte do usuário do sistema.
 * @ChangeLog
 *  - Renata Carrillo - 12/04/2022: Padronização do <head> e $titlePage.
 *  - Vinícius Lessa - 13/04/2022: Renomeação da página de 'Anúncios.php' para 'TradePosts.php'
 *  - Renata Carrillo - 18/04/2022: Adicionando o seguinte CSS no img dos anúncios para padronização de tamanho: style="max-width:100%;width:395px;height:295px;object-fit:cover;" 
 *  - Vinícius Lessa - 18/04/2022: Mudnaça do nome do arquivo de "trade_posts.php" para "home.php". Implentação do array de anúncios vindos do Banco de dados propriamente.
 * 
 * @ Notes: 
 * 
 */

if (!defined('SITE_URL')) {
  include_once '../../config.php';
}

if (session_status() === PHP_SESSION_NONE) {
  session_start();
}

$titlePage  = 'MTC | Anúncios';
$a_tpList   = [];

require SITE_PATH . '/Controllers/c_trade_posts.php';

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
      <div class="container mb-5">
        <div class="row">
          <div class="col-12 col-sm-6 mt-5">
            <h1 class="text-white"><strong>A N Ú N C I O S</strong></h1>
          </div>
          <hr>
        </div>

        <div class="input-group">
          <div class="form-outline col-10 col-sm-6">
            <input id="search-input" type="search" id="form1" class="form-control" />
          </div>
            <button id="search-button" type="button" class="btn btn-danger">
              <i class="bi bi-search"></i>
          </button>
        </div>

      </div>
    </main>

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
              <div class="col-12 col-sm-6 col-lg-4 mt-4 mb-4">
                <div class="p-3">
                  <div>
                    <a href="<?php echo SITE_URL ?>/Views/trade_posts/trade_post_detailed.php/?trade_post=<?php echo $a_tpItem['post_id'] ?>">
                      <img src="<?php echo $a_tpItem['image_name'] ?>" class="img-fluid" alt="" style="max-width:100%;width:395px;height:240px;object-fit:cover;">
                    </a>
                  </div>
                  <div class="mt-3 p-2">
                    <div class="row">
                      <div class="col-12">
                        <h4 class="card-title text-red"><strong><small>R$ </small><?php echo number_format($a_tpItem['price'], 2, ',', '.') ?></strong></h4>
                        <h5 class="card-title text-white "><strong><?php echo $a_tpItem['title'] ?></strong></h5>                        
                      </div>
                    </div>
                    <div class="row mt-2">
                      <div class="col-6">
                        <span class="card-title text-white ">Por:
                          <strong>
                            <a href="<?php echo SITE_URL ?>/Views/users/user_profile.php/?user_id=<?php echo $a_tpItem['user_id'] ?>"
                              class="text-decoration-none text-white">
                              <?php echo $a_tpItem['user_name'] ?>
                            </a>
                          </strong>
                        </span>
                      </div>
                      <div class="col-6 d-flex flex-row-reverse">
                        <a href="<?php echo SITE_URL ?>/Views/trade_posts/trade_post_detailed.php/?trade_post=<?php echo $a_tpItem['post_id'] ?>"
                        class="card-title text-white">Detalhes</a>
                      </div>
                    </div>
                  </div>
                </div>
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
            <a class="text-white" style="font-size:14px;" href="<?php echo SITE_URL ?>/Views/produtos/MusicTradeCenter.php"><button type="button" class="btn btn-danger btn-lg border-0 mt-3"><strong>VER MAIS</strong></button></a>  
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