<?php
/**
 * File DOC
 * 
 * @Description Página de criação de cadastro por parte do usuário do sistema.
 * @ChangeLog 
 *  - Renata Carrillo - 12/04/2022: Padronização do <head> e $titlePage;
 *  - Renata Carrillo - 13/04/2022: Finalização do Front da Página;
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

  $titlePage = 'Feed Musical';
  $data_slide = 0;

  // require SITE_PATH . '/Controllers/c_home.php';
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
  <div class="container-fluid">
    <div class="row">
      <div class="col-12 col-sm-12">
        <img src="../../images/IMAGENS/PÚBLICO01.png" class="img-fluid" alt="">
      </div>
        <hr></hr>
    </div>
  </div>

  <!-- <div id="carouselExampleSlidesOnly" class="carousel slide" data-bs-ride="carousel">
  <div class="carousel-inner">
    <div class="carousel-item active">
      <img src="../../images/IMAGENS/PÚBLICO01.PNG" class="d-block w-100" alt="...">
    </div>
    <div class="carousel-item">
    <img src="../../images/IMAGENS/PÚBLICO01.PNG" class="d-block w-100" alt="...">
    </div>
    <div class="carousel-item">
    <img src="../../images/IMAGENS/PÚBLICO01.PNG" class="d-block w-100" alt="...">
    </div>
  </div>
</div> -->

<!-- SUGESTÕES DE PLAYLIST -->
  <div class="container mb-5">
    <div class="row">
      <div class="col-12 col-sm-6 mt-5">
        <h3 class="text-white"><strong>Sugestões de Playlist</strong></h3>
      </div>
        <!-- <hr></hr> -->
  </div>

<div class="container">
  <div class="row">

    <div class="col-6 col-sm-3 mt-3">
      <div class="">
        <a href="<?php echo SITE_URL ?>/Views/trade_posts/TradePostView.php">
          <img src="../../images/IMAGENS/CAPAS PLAYLIST/DISCOS 80s.jpg" class="img-fluid rounded" alt="">
        </a>
      </div>
        <p class="card-title text-red mt-2" style="text-align:left;"><strong>Best 80s songs</strong></p>
        <p class="card-title text-white" style="text-align:left;opacity:30%;"><strong>156 músicas</strong></p>
    </div>


    <div class="col-6 col-sm-3 mt-3">
      <div class="">
        <a href="<?php echo SITE_URL ?>/Views/trade_posts/TradePostView.php">
          <img src="../../images/IMAGENS/CAPAS PLAYLIST/ROCKCAPA.jpg" class="img-fluid rounded" alt="">
        </a>
      </div>
        <p class="card-title text-red mt-2" style="text-align:left;"><strong>Rock Alternativo</strong></p>
        <p class="card-title text-white" style="text-align:left;opacity:30%;"><strong>367 músicas</strong></p>
    </div>

    <div class="col-6 col-sm-3 mt-3">
      <div class="">
        <a href="<?php echo SITE_URL ?>/Views/trade_posts/TradePostView.php">
          <img src="../../images/IMAGENS/CAPAS PLAYLIST/RAPCAPA.jpg" class="rounded img-fluid" alt="">
        </a>
      </div>
        <p class="card-title text-red mt-2" style="text-align:left;"><strong>R.A.P Nacional 90s</strong></p>
        <p class="card-title text-white" style="text-align:left;opacity:30%;"><strong>93 músicas</strong></p>
    </div>

    <div class="col-6 col-sm-3 mt-3">
      <div class="">
        <a href="<?php echo SITE_URL ?>/Views/trade_posts/TradePostView.php">
          <img src="../../images/IMAGENS/PRODUTOS/MISCELANIA.jpg" class="rounded img-fluid" alt="">
        </a>
      </div>
        <p class="card-title text-red mt-2" style="text-align:left;"><strong>Pop 90s</strong></p>
        <p class="card-title text-white" style="text-align:left;opacity:30%;"><strong>211 músicas</strong></p>
    </div>

  </div>

  </div>
</div>

<!-- DISCOGRAFIAS -->
<div class="container mb-1 mt-3">
  <div class="row">
    <div class="col-12 col-sm-6 mt-5">
      <h3 class="text-white"><strong>Discografias</strong></h3>
    </div>
          <!-- <hr></hr> -->
  </div>
</div>

<div class="container col-6 col-sm-10">
<div class="row">
  <!-- <div class="col-12 col-sm-8">
  <div class="row"> -->
      
    <div class="col-12 col-sm-2 mt-3">
      <div class="">
        <a href="<?php echo SITE_URL ?>/Views/trade_posts/TradePostView.php">
          <img src="../../images/IMAGENS/ALBUM/SABOTAGE.jpg" class="rounded-circle" alt="" width="150" height="150">
        </a>
      </div>
        <p class="card-title text-white mt-2" style="text-align:left;margin-left:35px;"><strong>Sabotage</strong></p>
    </div>

    <div class="col-12 col-sm-2 mt-3">
      <div class="">
        <a href="<?php echo SITE_URL ?>/Views/produtos/detalhe-anuncio.php">
          <img src="../../images/IMAGENS/ALBUM/PANTERA.jpg" class="rounded-circle" alt="" width="150" height="150">
        </a>
      </div>
        <p class="card-title text-white mt-2" style="text-align:left;margin-left:25px;"><strong>Metal Magic</strong></p>
    </div>

    <div class="col-12 col-sm-2 mt-3">
      <div class="">
        <a href="<?php echo SITE_URL ?>/Views/produtos/detalhe-anuncio.php">
          <img src="../../images/IMAGENS/ALBUM/ACDC.jpg" class="rounded-circle" alt="" width="150" height="150">
        </a>
      </div>
        <p class="card-title text-white mt-2" style="text-align:left;margin-left:20px;"><strong>Back in Black</strong></p>
    </div>

    <div class="col-12 col-sm-2 mt-3">
      <div class="">
        <a href="<?php echo SITE_URL ?>/Views/produtos/detalhe-anuncio.php">
          <img src="../../images/IMAGENS/ALBUM/PINKFLOYD.jpg" class="rounded-circle" alt="" width="150" height="150">
        </a>
      </div>
        <p class="card-title text-white mt-2" style="text-align:left;margin-left:52px;"><strong>Pulse</strong></p>
    </div>

    <div class="col-12 col-sm-2 mt-3">
      <div class="">
        <a href="<?php echo SITE_URL ?>/Views/produtos/detalhe-anuncio.php">
          <img src="../../images/IMAGENS/ALBUM/MJ.jpg" class="rounded-circle" alt="" width="150" height="150">
        </a>
      </div>
        <p class="card-title text-white mt-2" style="text-align:left;margin-left:25px;"><strong>Off the Wall</strong></p>
    </div>

    <div class="col-12 col-sm-2 mt-3">
      <div class="">
        <a href="<?php echo SITE_URL ?>/Views/trade_posts/TradePostView.php">
          <img src="../../images/IMAGENS/ALBUM/ALICEINCHAINS.jpg" class="rounded-circle" alt="" width="150" height="150">
        </a>
      </div>
        <p class="card-title text-white mt-2" style="text-align:left;margin-left:45px;"><strong>Facelift</strong></p>
    </div>

  </div>
  <div class="row">
  <!-- <div class="col-12 col-sm-8">
  <div class="row"> -->
      
    <div class="col-12 col-sm-2 mt-3 mb-5">
      <div class="">
        <a href="<?php echo SITE_URL ?>/Views/produtos/detalhe-anuncio.php">
          <img src="../../images/IMAGENS/ALBUM/SOUNDGARDEN.jpg" class="rounded-circle" alt="" width="150" height="150">
        </a>
      </div>
        <p class="card-title text-white mt-2" style="text-align:left;margin-left:27px;"><strong>King Animal</strong></p>
    </div>

    <div class="col-12 col-sm-2 mt-3">
      <div class="">
        <a href="<?php echo SITE_URL ?>/Views/produtos/detalhe-anuncio.php">
          <img src="../../images/IMAGENS/ALBUM/PARAMORE.jpg" class="rounded-circle" alt="" width="150" height="150">
        </a>
      </div>
        <p class="card-title text-white mt-2" style="text-align:left;margin-left:27px;"><strong>Singles Club</strong></p>
    </div>

    <div class="col-12 col-sm-2 mt-3">
      <div class="">
        <a href="<?php echo SITE_URL ?>/Views/produtos/detalhe-anuncio.php">
          <img src="../../images/IMAGENS/ALBUM/EWF.jpg" class="rounded-circle" alt="" width="150" height="150">
        </a>
      </div>
        <p class="card-title text-white mt-2" style="text-align:left;margin-left:15px;"><strong>Electric Universe</strong></p>
    </div>

    <div class="col-12 col-sm-2 mt-3">
      <div class="">
        <a href="<?php echo SITE_URL ?>/Views/produtos/detalhe-anuncio.php">
          <img src="../../images/IMAGENS/ALBUM/TOMJOBIM.jpg" class="rounded-circle" alt="" width="150" height="150">
        </a>
      </div>
        <p class="card-title text-white mt-2" style="text-align:left;margin-left:55px;"><strong>Wave</strong></p>
    </div>

    <div class="col-12 col-sm-2 mt-3">
      <div class="">
        <a href="<?php echo SITE_URL ?>/Views/produtos/detalhe-anuncio.php">
          <img src="../../images/IMAGENS/ALBUM/DANIELCAESAR.jpg" class="rounded-circle" alt="" width="150" height="150">
        </a>
      </div>
        <p class="card-title text-white mt-2" style="text-align:left;margin-left:40px;"><strong>Freudian</strong></p>
    </div>

    <div class="col-12 col-sm-2 mt-3">
      <div class="">
        <a href="<?php echo SITE_URL ?>/Views/produtos/detalhe-anuncio.php">
          <img src="../../images/IMAGENS/ALBUM/TEARSFORFEARS.jpg" class="rounded-circle" alt="" width="150" height="150">
        </a>
      </div>
        <p class="card-title text-white mt-2" style="text-align:left;margin-left:35px;"><strong>Cape Fear</strong></p>
    </div>

  </div>
  </div>
  
</div>
</div>


<!-- ARTISTAS EM DESTAQUE -->
<div class="container mb-1 mt-3">
  <div class="row">
    <div class="col-12 col-sm-6 mt-5">
      <h3 class="text-white"><strong>Artistas em Destaque</strong></h3>
    </div>
          <!-- <hr></hr> -->
  </div>
</div>

<div class="container mt-2 mb-5">
<div class="row">

<div class="col-6 col-sm-4">
  <div class="">
    <a href="<?php echo SITE_URL ?>/Views/produtos/detalhe-anuncio.php">
      <img src="../../images/IMAGENS/ALBUM/SABOTAGE.jpg" class="rounded-circle mt-3" alt="" width="150" height="150">
      <img src="../../images/IMAGENS/ALBUM/SABOTAGE.jpg" class="rounded-circle mt-3" alt="" width="80" height="80">
      <img src="../../images/IMAGENS/ALBUM/SABOTAGE.jpg" class="rounded-circle mt-3" alt="" width="50" height="50">
    </a>
  </div>
    <p class="card-title text-white mt-2" style="text-align:left;margin-left:35px;"><strong>Sabotage</strong></p>
</div>

<div class="col-6 col-sm-4">
  <div class="">
    <a href="<?php echo SITE_URL ?>/Views/produtos/detalhe-anuncio.php">
    <img src="../../images/IMAGENS/ALBUM/LUTHER.jpg" class="rounded-circle mt-3" alt="" width="150" height="150">
      <img src="../../images/IMAGENS/ALBUM/LUTHER.jpg" class="rounded-circle mt-3" alt="" width="80" height="80">
      <img src="../../images/IMAGENS/ALBUM/LUTHER.jpg" class="rounded-circle mt-3" alt="" width="50" height="50">
    </a>
  </div>
    <p class="card-title text-white mt-2" style="text-align:left;margin-left:25px;"><strong>Luther Vandross</strong></p>
</div>

<div class="col-6 col-sm-4">
  <div class="">
    <a href="<?php echo SITE_URL ?>/Views/produtos/detalhe-anuncio.php">
    <img src="../../images/IMAGENS/ALBUM/DANIEL.jpg" class="rounded-circle mt-3" alt="" width="150" height="150">
      <img src="../../images/IMAGENS/ALBUM/DANIEL.jpg" class="rounded-circle mt-3" alt="" width="80" height="80">
      <img src="../../images/IMAGENS/ALBUM/DANIEL.jpg" class="rounded-circle mt-3" alt="" width="50" height="50">
    </a>
  </div>
    <p class="card-title text-white mt-2" style="text-align:left;margin-left:25px;"><strong>Daniel Caesar</strong></p>
</div>

<div class="col-6 col-sm-4">
  <div class="">
    <a href="<?php echo SITE_URL ?>/Views/produtos/detalhe-anuncio.php">
    <img src="../../images/IMAGENS/ALBUM/DIMEBAG.jpg" class="rounded-circle mt-3" alt="" width="150" height="150">
      <img src="../../images/IMAGENS/ALBUM/DIMEBAG.jpg" class="rounded-circle mt-3" alt="" width="80" height="80">
      <img src="../../images/IMAGENS/ALBUM/DIMEBAG.jpg" class="rounded-circle mt-3" alt="" width="50" height="50">
    </a>
  </div>
    <p class="card-title text-white mt-2" style="text-align:left;margin-left:25px;"><strong>Dimebag Darrell</strong></p>
</div>

<div class="col-6 col-sm-4">
  <div class="">
    <a href="<?php echo SITE_URL ?>/Views/produtos/detalhe-anuncio.php">
    <img src="../../images/IMAGENS/ALBUM/LAYNE.jpg" class="rounded-circle mt-3" alt="" width="150" height="150">
      <img src="../../images/IMAGENS/ALBUM/LAYNE.jpg" class="rounded-circle mt-3" alt="" width="80" height="80">
      <img src="../../images/IMAGENS/ALBUM/LAYNE.jpg" class="rounded-circle mt-3" alt="" width="50" height="50">
    </a>
  </div>
    <p class="card-title text-white mt-2" style="text-align:left;margin-left:35px;"><strong>Layne Staley</strong></p>
</div>

<div class="col-6 col-sm-4">
  <div class="">
    <a href="<?php echo SITE_URL ?>/Views/produtos/detalhe-anuncio.php">
    <img src="../../images/IMAGENS/ALBUM/EDDIEVANHALEN.jpg" class="rounded-circle mt-3" alt="" width="150" height="150">
      <img src="../../images/IMAGENS/ALBUM/EDDIEVANHALEN.jpg" class="rounded-circle mt-3" alt="" width="80" height="80">
      <img src="../../images/IMAGENS/ALBUM/EDDIEVANHALEN.jpg" class="rounded-circle mt-3" alt="" width="50" height="50">
    </a>
  </div>
    <p class="card-title text-white mt-2" style="text-align:left;margin-left:25px;"><strong>Eddie Van Halen</strong></p>
</div>

</div>
</div>

<!-- MÚSICAS -->
<div class="container mb-1 mt-3">
  <div class="row">
    <div class="col-12 col-sm-6 mt-5">
      <h3 class="text-white"><strong>Músicas</strong></h3>
    </div>
          <!-- <hr></hr> -->
  </div>
</div>

<div class="container mb-5">
  <div class="row">

  <div class="col-6 col-sm-2 mt-3">
      <img src="../../images/IMAGENS/ALBUM/PINKFLOYD.jpg" class="img-fluid rounded" alt="">
    </div>
    <div class="col-6 col-sm-3 mt-3 bk-left">
      <div class="card-body text-white">
        <h5 class="card-title">Shine On You Crazy Diamong</h5>
        <p class="card-text"><small class="text-muted">Pink Floyd</small></p>
    </div>
  </div>

  <div class="col-12 col-sm-1 mt-3"></div>

  <div class="col-6 col-sm-2 mt-3">
      <img src="../../images/IMAGENS/ALBUM/PINKFLOYD.jpg" class="img-fluid rounded" alt="">
    </div>
    <div class="col-6 col-sm-3 mt-3 bk-left">
      <div class="card-body text-white">
        <h5 class="card-title">Shine On You Crazy Diamong</h5>
        <p class="card-text"><small class="text-muted">Pink Floyd</small></p>
    </div>
  </div>

  <div class="col-6 col-sm-2 mt-3">
      <img src="../../images/IMAGENS/ALBUM/PINKFLOYD.jpg" class="img-fluid rounded" alt="">
    </div>
    <div class="col-6 col-sm-3 mt-3 bk-left">
      <div class="card-body text-white">
        <h5 class="card-title">Shine On You Crazy Diamong</h5>
        <p class="card-text"><small class="text-muted">Pink Floyd</small></p>
    </div>
  </div>

  <div class="col-12 col-sm-1 mt-3"></div>

  <div class="col-6 col-sm-2 mt-3">
      <img src="../../images/IMAGENS/ALBUM/PINKFLOYD.jpg" class="img-fluid rounded" alt="">
    </div>
    <div class="col-6 col-sm-3 mt-3 bk-left">
      <div class="card-body text-white">
        <h5 class="card-title">Shine On You Crazy Diamong</h5>
        <p class="card-text"><small class="text-muted">Pink Floyd</small></p>
    </div>
  </div>

  </div>
</div>

  </div>

  </div>
</div>

</main>

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