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

  <body class="d-flex flex-column h-100">
    
    <!-- menu do site -->
    <?php include SITE_PATH . '/includes/menu.php'; ?>
    
    <!-- Begin page content -->
    <main class="bk-preto">
      <div class="container mt-5 mb-5">
        <div class="row">
        <div class="col-6">
          <img src="../../images/icon.png" class="img-fluid" alt="">
          </div>

          <div class="col-6 mt-5">
            <h6 class="text-white">Negociação Online</h6>
            <h1 class="text-white">Music Trade Center</h1>
            <p class="text-white">Aqui você faz negociação online diretamente com o vendedor, de forma transparente e segura, a qualquer horário, plataforma totalmente dedicadas a você.</p>
            <button type="button" class="btn btn-lg"><a href="#">NEGOCIE AGORA</a></button>
          </div>
        </div>
      </div>
    </main>
    
    <!-- footer -->
    <?php include SITE_PATH . '/includes/footer.php'; ?>    
  
    <script src="<?php echo SITE_URL ?>/bootstrap/js/bootstrap.bundle.min.js"></script>

  </body>
</html>