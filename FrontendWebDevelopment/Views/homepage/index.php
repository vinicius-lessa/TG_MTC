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
    
    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="<?php echo SITE_URL ?>/images/icon.png"> 

    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="../../js/bootstrap.bundle.min.js"></script>
    <script src="../../js/main.js"></script>    

    <title> 
      <?php echo $titlePage; ?>
    </title>

    <script src='<?php echo SITE_URL ?>/js/main.js'></script>
  </head>

  <body class="d-flex flex-column h-100 bk-preto font-main">
    
    <!-- Header Include -->
    <?php include SITE_PATH . '/includes/header.php'; ?>
    
    <!-- Begin page content -->
    <main>
      <div class="container mt-5 mb-5">
        <div class="row">
        <div class="col-6">
          <img src="../../images/icon.png" class="img-fluid" alt="">
          </div>

          <div class="col-6 mt-5 font-main">
            <h6 class="text-red">Negociação Online</h6>
            <h1 class="text-white"><strong>Music Trade Center</strong></h1>
            <p class="text-white" style="font-size:14px;">Aqui você faz negociação online diretamente com o vendedor, de forma transparente e segura, a qualquer horário, plataforma totalmente dedicadas a você.</p>
            <button type="button" class="btn btn-danger btn-lg border-0 mt-3"><a class="text-white" href="#">NEGOCIE AGORA</a></button>
          </div>
        </div>
      </div>
    </main>
    
    <!-- MEIO DA HOME -->
<div class="container">
<div class="row">

  <div class="col-4 p-5">
      <div class="card-body bk-left">
        <i class="bi bi-bag-check" style="text-align:right;font-size: 2rem; color: white;"></i>
        <p class="card-title text-white" style="text-align:left;">Variedade</p>
        <p class="card-title text-white" style="text-align:left;">Diversas opções de instrumentos e acessórios com preço de desapego para você.</p>
        <a class="text-red" href="#"><strong>Saiba Mais</strong></a>
      </div>
  </div>

  <div class="col-4 p-5">
      <div class="card-body bk-red">
        <i class="bi bi-bag-check" style="text-align:right;font-size: 2rem; color: white;"></i>
        <p class="card-title text-white" style="text-align:left;">Segurança</p>
        <p class="card-title text-white" style="text-align:left;">Aconselhamos que toda a negociação seja feita 100% na plataforma.</p>
        <a class="text-white" href="#"><strong>Saiba Mais</strong></a>
      </div>
  </div>

  <div class="col-4 p-5">
      <div class="card-body bk-left">
        <i class="bi bi-bag-check" style="text-align:right;font-size: 2rem; color: white;"></i>
        <p class="card-title text-white" style="text-align:left;">Entrega</p>
        <p class="card-title text-white" style="text-align:left;">As entregas são negociadas diretamente com o Anunciante do Instrumento.</p>
        <a class="text-red" href="#"><strong>Saiba Mais</strong></a>
      </div>
  </div>

</div>
</div>

  <div class="container mt-5 mb-2">
    <div class="row">
      <div class="col-4 bk-left center">
        <h1 class="text-red mt-5" style="text-align:center;"><strong>+500</strong></h1>
        <h5 class="text-white" style="text-align:center;"><strong>Anúncios em todo o</strong></h5>
        <h5 class="text-white" style="text-align:center;"><strong>Brasil</strong></h5>
       </div>
      
    <div class="col-4">
      <div class="card bk-left" style="width: 18rem;">
        <div class="card-body">
          <h5 class="card-title text-white">Card title</h5>
          <h6 class="card-subtitle mb-2 text-muted text-white">Card subtitle</h6>
          <p class="card-text text-white">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
          <a href="#" class="card-link text-white">Card link</a>
          <a href="#" class="card-link text-white">Another link</a>
        </div>
      </div>
    </div>

    <div class="col-4">
      <div class="card bk-left" style="width: 18rem;">
        <div class="card-body">
          <h5 class="card-title text-white">Card title</h5>
          <h6 class="card-subtitle mb-2 text-muted text-white">Card subtitle</h6>
          <p class="card-text text-white">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
          <a href="#" class="card-link text-white">Card link</a>
          <a href="#" class="card-link text-white">Another link</a>
        </div>
      </div>
    </div>
    </div>
  </div>

  
  <div class="container mb-5">
    <div class="row">
      <div class="col-4 center"></div>
      
      <div class="col-4">
      <div class="card bk-left" style="width: 18rem;">
        <div class="card-body">
          <h5 class="card-title text-white">Card title</h5>
          <h6 class="card-subtitle mb-2 text-muted text-white">Card subtitle</h6>
          <p class="card-text text-white">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
          <a href="#" class="card-link text-white">Card link</a>
          <a href="#" class="card-link text-white">Another link</a>
        </div>
      </div>
    </div>

    <div class="col-4">
      <div class="card bk-left" style="width: 18rem;">
        <div class="card-body">
          <h5 class="card-title text-white">Card title</h5>
          <h6 class="card-subtitle mb-2 text-muted text-white">Card subtitle</h6>
          <p class="card-text text-white">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
          <a href="#" class="card-link text-white">Card link</a>
          <a href="#" class="card-link text-white">Another link</a>
        </div>
      </div>
    </div>
    </div>
  </div>

<!-- FINAL DA HOME -->
<div class="container mt-5 mb-5">
<div class="row">
  <h5 class="text-white"><strong>D E S T A Q U E S</strong></h5>
  <div class="col-4 p-5">
      <div class="card-body bk-left">
      <img src="../../images/produtos/guitarra.jpg" style="width:200px; margin-left:30px;" alt="">
      <p class="card-title text-white" style="text-align:left;font-size:20px;"><strong>Guitarra</strong></p>
        <p class="card-title text-white" style="text-align:left;font-size:14px;">Guitarra Dolphin anos 90 Black piano tipo
        Fender Kurt Cobain Vandalism.</p>
        <p class="card-title text-red" style="text-align:left;"><strong>R$780,00</strong></p>
        <a href="#" class="btn btn-danger border-0">Negociar</a>
      </div>
  </div>
  <div class="col-4 p-5">
      <div class="card-body bk-left">
      <img src="../../images/produtos/guitarra.jpg" style="width:200px; margin-left:30px;" alt="">
      <p class="card-title text-white" style="text-align:left;font-size:20px;"><strong>Guitarra</strong></p>
        <p class="card-title text-white" style="text-align:left;font-size:14px;">Guitarra Dolphin anos 90 Black piano tipo
        Fender Kurt Cobain Vandalism.</p>
        <p class="card-title text-red" style="text-align:left;"><strong>R$780,00</strong></p>
        <a href="#" class="btn btn-danger border-0">Negociar</a>
      </div>
  </div>
  <div class="col-4 p-5">
      <div class="card-body bk-left">
      <img src="../../images/produtos/guitarra.jpg" style="width:200px; margin-left:30px;" alt="">
      <p class="card-title text-white" style="text-align:left;font-size:20px;"><strong>Guitarra</strong></p>
        <p class="card-title text-white" style="text-align:left;font-size:14px;">Guitarra Dolphin anos 90 Black piano tipo
        Fender Kurt Cobain Vandalism.</p>
        <p class="card-title text-red" style="text-align:left;"><strong>R$780,00</strong></p>
        <a href="#" class="btn btn-danger border-0">Negociar</a>
      </div>
  </div>
</div>
</div>
      </div>
    </div>

    <!-- Footer Include -->
    <?php include SITE_PATH . '/includes/footer.php'; ?>    
  
    <script src="<?php echo SITE_URL ?>/bootstrap/js/bootstrap.bundle.min.js"></script>

  </body>
</html>