<?php
  if (!defined('SITE_URL')) {
    include_once '../../config.php';
  }

  if (session_status() === PHP_SESSION_NONE) {
    session_start();
  }

  $titlePage = 'HomePage';
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
    <meta name="author" content="Vinícius Lessa / Iuri Ferreira">
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
      <div class="container mt-5 mb-5">
        <div class="row">
        <div class="col-12 col-sm-6">
          <img src="../../images/icon.png" class="img-fluid" alt="" width="400">
          </div>

          <div class="col-12 col-sm-6 mt-5 font-main">
            <h6 class="text-red"><strong>Negociação Online</strong></h6>
            <h1 class="text-white"><strong>Music Trade Center</strong></h1>
            <p class="text-white">Aqui você faz negociação online diretamente com o vendedor, de forma transparente e segura, a qualquer horário, plataforma totalmente dedicadas a você.</p>
            <a class="text-white" href="#"><button type="button" class="btn btn-danger btn-lg border-0 mt-3"><strong>Negocie agora</strong></button></a>
          </div>
        </div>
      </div>
    </main>

<!-- bk -->
<!-- <nav class="navbar navbar-light bk-left mt-5" style="positiom:absolute;z-index:-1;margin-bottom:-830px;width:650px;">
  <a class="navbar-brand" style="height:800px;" href="#"></a>
</nav> -->

  <!-- MEIO DA HOME -->
  <div class="container mt-5">
    <div class="row">
      
      <div class="col-12 col-sm-4 bk-left center">
        <h1 class="text-red mt-5" style="text-align:center;font-size:42px;"><strong>+3000</strong></h1>
        <h5 class="text-white" style="text-align:center;"><strong>Anúncios em todo o</strong></h5>
        <h5 class="text-white" style="text-align:center;"><strong>estado de São Paulo</strong></h5>
        <h6 class="text-white" style="text-align:center;font-size:12px;margin-top:30px;">em breve em todos os estados</h6>
       </div>  
        
        <div class="col-12 col-sm-4 text-white">
          <a href="../produtos/anuncios.php">
            <img class="card-img" style="opacity:90%;" src="../../images/produtos2/GUITARRA01.jpg" alt="Instrumentos">
          </a>
        </div>

        <div class="col-12 col-sm-4 text-white">
          <a href="../produtos/anuncios.php">
            <img class="card-img" style="opacity:90%;" src="../../images/produtos2/EQUIPAMENTO01.jpg" alt="Equipamentos">
          </a>
        </div>

    </div>
  </div>

  
  <div class="container mb-5 mt-2">
    <div class="row">
      <div class="col-4 center"></div>

        <div class="col-12 col-sm-4 text-white">
          <a href="../produtos/anuncios.php">
            <img class="card-img" style="opacity:90%;" src="../../images/produtos2/ACESSORIOS01.jpg" alt="Acessórios">
          </a>
        </div>

        <div class="col-12 col-sm-4 text-white">
          <a href="../produtos/anuncios.php">
            <img class="card-img" style="opacity:90%;" src="../../images/produtos2/MISCELANIA01.jpg" alt="Miscelânias">
          </a>
        </div>

      </div>
    </div>
  </div>

<!-- ANÚNCIOS 01-->
<div class="container mt-5">
  <div class="row">

    <div class="col-9">
      <h4 class="text-white"><strong>D E S T A Q U E S</strong></h4>
    </div>

    <div class="col-3 mb-5">
      <a class="text-white" style="font-size:16px;" href="../produtos/anuncios.php"><button type="button" class="btn btn-danger btn-lg border-0 mt-3"><strong>VER MAIS</strong></button></a>
    </div>

    <div class="col-12 col-sm-4 mt-3">
      <div class="">
        <a href="../produtos/detalhe-anuncio.php">
          <img src="../../images/produtos2/GUITARRA3.jpg" class="img-fluid" alt="">
        </a>
      </div>
        <p class="card-title text-white mt-2" style="text-align:left;"><strong>Guitarra Fender Stratoscaster</strong></p>
        <p class="card-title text-red" style="text-align:left;"><strong>R$ 1.789,00</strong></p>
    </div>


    <div class="col-12 col-sm-4 mt-3">
      <div class="">
        <a href="../produtos/detalhe-anuncio.php">
          <img src="../../images/produtos2/BATERIA.jpg" class="img-fluid" alt="">
        </a>
      </div>
        <p class="card-title text-white mt-2" style="text-align:left;"><strong>Bateria Gretsch</strong></p>
        <p class="card-title text-red" style="text-align:left;"><strong>R$ 1.210,00</strong></p>
    </div>

    <div class="col-12 col-sm-4 mt-3">
      <div class="">
        <a href="../produtos/detalhe-anuncio.php">
          <img src="../../images/produtos2/VITROLA.jpg" class="img-fluid" alt="">
        </a>
      </div>
        <p class="card-title text-white mt-2" style="text-align:left;"><strong>Vitrola Pulse Perkins</strong></p>
        <p class="card-title text-red" style="text-align:left;"><strong>R$ 2.220,00</strong></p>
    </div>

  </div>

  </div>
</div>


<!-- ANÚNCIOS 02-->
<div class="container mb-5 mt-5">
  <div class="row">

  <div class="col-12 col-sm-4 mt-3">
    <div class="">
      <a href="../produtos/detalhe-anuncio.php">
        <img src="../../images/produtos2/GUITARRA3.jpg" class="img-fluid" alt="">
      </a>
    </div>
      <p class="card-title text-white mt-2" style="text-align:left;"><strong>Guitarra Fender Stratoscaster</strong></p>
      <p class="card-title text-red" style="text-align:left;"><strong>R$ 1.789,00</strong></p>
  </div>


  <div class="col-12 col-sm-4 mt-3">
    <div class="">
      <a href="../produtos/detalhe-anuncio.php">
        <img src="../../images/produtos2/BATERIA.jpg" class="img-fluid" alt="">
      </a>
    </div>
      <p class="card-title text-white mt-2" style="text-align:left;"><strong>Bateria Gretsch</strong></p>
      <p class="card-title text-red" style="text-align:left;"><strong>R$ 1.210,00</strong></p>
  </div>

  <div class="col-12 col-sm-4 mt-3">
    <div class="">
      <a href="../produtos/detalhe-anuncio.php">
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
        <a class="text-white" style="font-size:14px;" href="../produtos/MusicTradeCenter.php"><button type="button" class="btn btn-danger btn-lg border-0 mt-3"><strong>VER MAIS</strong></button></a>  
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