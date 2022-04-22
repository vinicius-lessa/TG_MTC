<?php
/**
 * File DOC
 * 
 * @Description Página de criação de cadastro por parte do usuário do sistema.
 * @ChangeLog 
 *  - Renata Carrillo - 12/04/2022: Padronização do <head> e $titlePage;
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

  $titlePage = 'Music Trade Center';
  $data_slide = 0;

  // require SITE_PATH . '/Controllers/c_trade_posts.php';
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
            <h1 class="text-white"><strong>MUSIC TRADE CENTER</strong></h1>
          </div>
          <hr></hr>
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

<!-- bk -->
<!-- <nav class="navbar navbar-light bk-gray mt-5" style="positiom:absolute;z-index:-1;margin-bottom:-830px;width:650px;">
  <a class="navbar-brand" style="height:800px;" href="#"></a>
</nav> -->


<!-- ANÚNCIOS 01-->
<div class="container">
  <div class="row">

    <div class="col-12 col-sm-4 mt-3">
      <div class="">
        <a href="<?php echo SITE_URL ?>/Views/trade_posts/trade_post_detailed.php">
          <img src="<?php echo SITE_URL ?>/images/produtos2/GUITARRA3.jpg" class="img-fluid" alt="" style="max-width:100%;width:395px;height:240px;object-fit:cover;">
        </a>
      </div>
        <p class="card-title text-white mt-2" style="text-align:left;"><strong>Guitarra Fender Stratoscaster</strong></p>
        <p class="card-title text-red" style="text-align:left;"><strong>R$ 1.789,00</strong></p>
    </div>


    <div class="col-12 col-sm-4 mt-3">
      <div class="">
        <a href="<?php echo SITE_URL ?>/Views/trade_posts/trade_post_detailed.php">
          <img src="<?php echo SITE_URL ?>/images/produtos2/BATERIA.jpg" class="img-fluid" alt="" style="max-width:100%;width:395px;height:240px;object-fit:cover;">
        </a>
      </div>
        <p class="card-title text-white mt-2" style="text-align:left;"><strong>Bateria Gretsch</strong></p>
        <p class="card-title text-red" style="text-align:left;"><strong>R$ 1.210,00</strong></p>
    </div>

    <div class="col-12 col-sm-4 mt-3">
      <div class="">
        <a href="<?php echo SITE_URL ?>/Views/trade_posts/trade_post_detailed.php">
          <img src="<?php echo SITE_URL ?>/images/produtos2/VITROLA.jpg" class="img-fluid" alt="" style="max-width:100%;width:395px;height:240px;object-fit:cover;">
        </a>
      </div>
        <p class="card-title text-white mt-2" style="text-align:left;"><strong>Vitrola Pulse Perkins</strong></p>
        <p class="card-title text-red" style="text-align:left;"><strong>R$ 2.220,00</strong></p>
    </div>

  </div>

  </div>
</div>


<!-- ANÚNCIOS 02-->
<div class="container mb-5">
  <div class="row">

  <div class="col-12 col-sm-4 mt-3">
    <div class="">
      <a href="<?php echo SITE_URL ?>/Views/trade_posts/trade_post_detailed.php">
        <img src="<?php echo SITE_URL ?>/images/produtos2/GUITARRA3.jpg" class="img-fluid" alt="" style="max-width:100%;width:395px;height:240px;object-fit:cover;">
      </a>
    </div>
      <p class="card-title text-white mt-2" style="text-align:left;"><strong>Guitarra Fender Stratoscaster</strong></p>
      <p class="card-title text-red" style="text-align:left;"><strong>R$ 1.789,00</strong></p>
  </div>


  <div class="col-12 col-sm-4 mt-3">
    <div class="">
      <a href="<?php echo SITE_URL ?>/Views/trade_posts/trade_post_detailed.php">
        <img src="<?php echo SITE_URL ?>/images/produtos2/BATERIA.jpg" class="img-fluid" alt="" style="max-width:100%;width:395px;height:240px;object-fit:cover;">
      </a>
    </div>
      <p class="card-title text-white mt-2" style="text-align:left;"><strong>Bateria Gretsch</strong></p>
      <p class="card-title text-red" style="text-align:left;"><strong>R$ 1.210,00</strong></p>
  </div>

  <div class="col-12 col-sm-4 mt-3">
    <div class="">
      <a href="<?php echo SITE_URL ?>/Views/trade_posts/trade_post_detailed.php">
        <img src="<?php echo SITE_URL ?>/images/produtos2/VITROLA.jpg" class="img-fluid" alt="" style="max-width:100%;width:395px;height:240px;object-fit:cover;">
      </a>
    </div>
      <p class="card-title text-white mt-2" style="text-align:left;"><strong>Vitrola Pulse Perkins</strong></p>
      <p class="card-title text-red" style="text-align:left;"><strong>R$ 2.220,00</strong></p>
  </div>

  </div>
</div>

    <!-- ENCONTRE ARTISTAS -->
    <div class="card-group d-flex justify-content-center">
      <div class="bk-gray col-12 col-sm-8 text-white" style="border-style:solid;border-color:gray;">
        <div class="row mt-3 mb-3">
          <div class="col-8 col-sm-8">
            <h3 class="mt-2"><strong>Encontre artistas de diversos genêros</strong></h3>
            <p>Você tem a possibilidade de divulgar o seu trabalho, e encontrar artistas próximos.</p>
          </div>
          <div class="col-4 col-sm-2 mt-1">
            <a class="text-white" style="font-size:14px;" href="../produtos/MusicTradeCenter.php"><button type="button" class="btn btn-default btn-lg border-0 mt-3"><strong>VER MAIS</strong></button></a>  
          </div>
        </div>
      </div>
    </div>

    <!-- Footer Include -->
    <?php include SITE_PATH . '/includes/footer.php'; ?>    
  
    <!-- Scripts -->    
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="<?php echo SITE_URL ?>/js/bootstrap.bundle.min.js"></script>
    <script src="<?php echo SITE_URL ?>/js/main.js"></script>
    
    
  </body>

</html>