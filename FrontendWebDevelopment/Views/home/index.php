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
    <meta name="description" content="">
    <meta name="author" content="">
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>    
        
    <link href="<?php echo SITE_URL ?>/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo SITE_URL ?>/css/style.css">
    <link rel="icon" type="image/x-icon" href="<?php echo SITE_URL ?>/images/favicon.ico">

    <title> 
      <?php echo $titlePage; ?>
    </title>

    <script src='<?php echo SITE_URL ?>/js/main.js'></script>
  </head>

  <body class="d-flex flex-column h-100 bk-preto">
    
    <!-- menu do site -->
    <?php include SITE_PATH . '/includes/menu.php'; ?>
    
    <!-- Begin page content -->
    <main>
      <div class="container mt-5 mb-5">
        <div class="row">
        <div class="col-6">
          <img src="../../images/icon.png" class="img-fluid" alt="">
          </div>

          <div class="col-6 mt-5">
            <h6 class="text-red">Negociação Online</h6>
            <h1 class="text-white"><strong>Music Trade Center</strong></h1>
            <p class="text-white">Aqui você faz negociação online diretamente com o vendedor, de forma transparente e segura, a qualquer horário, plataforma totalmente dedicadas a você.</p>
            <button type="button" class="btn btn-danger btn-lg mt-3 text-white"><a href="#">NEGOCIE AGORA</a></button>
          </div>
        </div>
      </div>
    </main>
    
    <!-- MEIO DA HOME -->
  <div class="row row-cols-1 row-cols-md-3 g-4">

  <div class="col bk-left">
    <div class="card">
      <div class="card-body">
        <h5 class="card-title text-red" style="text-align:center;"><strong>25</strong></h5>
        <p class="card-title text-white" style="text-align:center;">Usuários em todo o</p>
        <p class="card-title text-white" style="text-align:center;">Brasil.</p>
      </div>
    </div>
  </div>

  <div class="col">
    <div class="card">
      <img src="..." class="card-img-top" alt="...">
      <div class="card-body">
        <h5 class="card-title">Card title</h5>
        <p class="card-text">This is a longer card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
      </div>
    </div>
  </div>

  <div class="col">
    <div class="card">
      <img src="..." class="card-img-top" alt="...">
      <div class="card-body">
        <h5 class="card-title">Card title</h5>
        <p class="card-text">This is a longer card with supporting text below as a natural lead-in to additional content.</p>
      </div>
    </div>
  </div>

  <div class="col">
    <div class="card">
      <img src="..." class="card-img-top" alt="...">
      <div class="card-body">
        <h5 class="card-title">Card title</h5>
        <p class="card-text">This is a longer card with supporting text below as a natural lead-in to additional content.</p>
      </div>
    </div>
  </div>

</div>

    <div class="container">
      <div class="row">

        <div class="col-4 bk-left">
        <h1 class="text-red" style="text-align:center;"><strong>25</strong></h1>
        <h5 class="text-white" style="text-align:center;"><strong>Usuários em todo o</strong></h5>
        <h5 class="text-white" style="text-align:center;"><strong>Brasil</strong></h5>
        </div>
      </div>
    </div>

    <!-- footer -->
    <?php include SITE_PATH . '/includes/footer.php'; ?>    
  
    <script src="<?php echo SITE_URL ?>/bootstrap/js/bootstrap.bundle.min.js"></script>

  </body>
</html>