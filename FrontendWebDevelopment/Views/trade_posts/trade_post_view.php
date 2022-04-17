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

  $titlePage = 'Detalhe Anúncio';
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
    <link rel="canonical" href="https://getbootstrap.com/docs/5.0/examples/headers/">
    
    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="<?php echo SITE_URL ?>/images/icon.png">
  </head>

  <body class="d-flex flex-column h-100 bk-preto font-main">
    
    <!-- Header Include -->
    <?php include SITE_PATH . '/includes/header.php'; ?>
    
    <!-- Begin page content -->
    <main>
      <div class="container">
        <div class="row">
          <div class="col-12 col-sm-6 mt-5">
            <h1 class="text-white"><strong><?php echo $infoProduto['nome_prod']?>GUITARRA XXX YYY</strong></h1>
          </div>
          <hr></hr>
        </div>
      </div>
    </main>

<!-- DETALHE ANÚNCIO-->
<div class="container mt-1">
  <div class="row">

    <div class="col-8 col-sm-8 mt-3">
      <div class="">
        <a href="#">
          <img src="../../images/produtos2/GUITARRA3.jpg" class="img-fluid" alt="">
        </a>
        <h5 class="card-title text-white mt-2" style="text-align:left;"><strong>Descrição:</strong></h5>
        <p class="card-title text-white" style="text-align:left;">Guitarra Gibson em perfeito estado, usada poucas vezes, apenas em casa, acompanha 2 palhetas novas.</p>
          
        <div class="row mt-4">
        <ul class="col-12 col-sm-6 list-group list-group-flush">
          <li class="list-group-item bk-preto text-white"><strong>Categoria:</strong></li>
          <li class="list-group-item bk-preto text-white"><strong>Modelo:</strong></li>
          <li class="list-group-item bk-preto text-white"><strong>Marca:</strong></li>
          <li class="list-group-item bk-preto text-white"><strong>Estado:</strong></li>
        </ul>
          
        <ul class="col-12 col-sm-6 list-group list-group-flush">
          <li class="list-group-item bk-preto text-white"><strong>Cidade:</strong></li>
          <li class="list-group-item bk-preto text-white"><strong>Bairro:</strong></li>
          <li class="list-group-item bk-preto text-white"><strong>Anunciante:</strong></li>
          <li class="list-group-item bk-preto text-white"><strong>Telefone:</strong></li>
        </ul>
        </div>

      </div>
    </div>

    <div class="col-4 col-sm-4 mt-3">
      <div class="">
          <img src="../../images/produtos2/GUITARRA3.jpg" class="img-fluid" alt="">
          <img src="../../images/produtos2/GUITARRA3.jpg" class="img-fluid mt-3" alt="">
        <div class="mt-5">
          <h5 class="text-red"><strong>R$ 1.170,00</strong></h5>
          <a class="text-white" href="<?php echo SITE_URL ?>/Views/users/chat.php"><button type="button" class="btn btn-danger btn-lg border-0 mt-3"><strong>CHAT</strong></button></a>
        </div>
      </div>
    </div>

  </div>

  </div>
</div>


<div class="container mt-5">
  <div class="row">
    <div class="col-12 col-sm-6 mt-5">
      <h1 class="text-white"><strong>OUTROS &nbsp;A N Ú N C I O S</strong></h1>
    </div>
      <hr></hr>
  </div>
</div>

<!-- OUTROS ANÚNCIOS-->
<div class="container">
  <div class="row">

  <div class="col-12 col-sm-4 mt-3">
    <div class="">
      <a href="<?php echo SITE_URL ?>/Views/trade_posts/trade_post_view.php">
        <img src="../../images/produtos2/GUITARRA3.jpg" class="img-fluid" alt="">
      </a>
    </div>
      <p class="card-title text-white mt-2" style="text-align:left;"><strong>Guitarra Fender Stratoscaster</strong></p>
      <p class="card-title text-red" style="text-align:left;"><strong>R$ 1.789,00</strong></p>
  </div>


  <div class="col-12 col-sm-4 mt-3">
    <div class="">
      <a href="<?php echo SITE_URL ?>/Views/trade_posts/trade_post_view.php">
        <img src="../../images/produtos2/BATERIA.jpg" class="img-fluid" alt="">
      </a>
    </div>
      <p class="card-title text-white mt-2" style="text-align:left;"><strong>Bateria Gretsch</strong></p>
      <p class="card-title text-red" style="text-align:left;"><strong>R$ 1.210,00</strong></p>
  </div>

  <div class="col-12 col-sm-4 mt-3">
    <div class="">
      <a href="<?php echo SITE_URL ?>/Views/trade_posts/trade_post_view.php">
        <img src="../../images/produtos2/VITROLA.jpg" class="img-fluid" alt="">
      </a>
    </div>
      <p class="card-title text-white mt-2" style="text-align:left;"><strong>Vitrola Pulse Perkins</strong></p>
      <p class="card-title text-red" style="text-align:left;"><strong>R$ 2.220,00</strong></p>
  </div>

  </div>
</div>

<!-- OUTROS ANÚNCIOS-->
<div class="container mb-5">
  <div class="row">

  <div class="col-12 col-sm-4 mt-3">
    <div class="">
      <a href="<?php echo SITE_URL ?>/Views/trade_posts/trade_post_view.php">
        <img src="../../images/produtos2/GUITARRA3.jpg" class="img-fluid" alt="">
      </a>
    </div>
      <p class="card-title text-white mt-2" style="text-align:left;"><strong>Guitarra Fender Stratoscaster</strong></p>
      <p class="card-title text-red" style="text-align:left;"><strong>R$ 1.789,00</strong></p>
  </div>


  <div class="col-12 col-sm-4 mt-3">
    <div class="">
      <a href="<?php echo SITE_URL ?>/Views/trade_posts/trade_post_view.php">
        <img src="../../images/produtos2/BATERIA.jpg" class="img-fluid" alt="">
      </a>
    </div>
      <p class="card-title text-white mt-2" style="text-align:left;"><strong>Bateria Gretsch</strong></p>
      <p class="card-title text-red" style="text-align:left;"><strong>R$ 1.210,00</strong></p>
  </div>

  <div class="col-12 col-sm-4 mt-3">
    <div class="">
      <a href="<?php echo SITE_URL ?>/Views/trade_posts/trade_post_view.php">
        <img src="../../images/produtos2/VITROLA.jpg" class="img-fluid" alt="">
      </a>
    </div>
      <p class="card-title text-white mt-2" style="text-align:left;"><strong>Vitrola Pulse Perkins</strong></p>
      <p class="card-title text-red" style="text-align:left;"><strong>R$ 2.220,00</strong></p>
  </div>

  </div>
</div>

<!-- ENCONTRE ARTISTAS -->
<div class="card-group">
  <div class="col-12 col-sm-2"></div>

  <div class="bk-left col-12 col-sm-8 text-white" style="border-style:solid;border-color:gray;">
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
    <script src="../assets/dist/js/bootstrap.bundle.min.js"></script>
    <script src="sidebars.js"></script>
  </body>

</html>