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

    <title> <?php echo $titlePage; ?> </title>
    
    <link rel="icon" href="<?php echo SITE_URL ?>/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="<?php echo SITE_URL ?>/css/style.css">

    <!-- Bootstrap core CSS -->
    <link href="<?php echo SITE_URL ?>/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <script src='<?php echo SITE_URL ?>/js/main.js'></script>
  </head>

  <body class="d-flex flex-column h-100">
    
    <!-- menu do site -->
    <?php include SITE_PATH . '/includes/menu.php'; ?>
    
    <!-- Begin page content -->
    <main>
      <div class="container">
        <!-- <div class="row">
          <div class="col"> -->
            <h1 class="mt-5">Seja Bem Vindo!</h1>
            <p class="lead">Music Trade Center é onde todos os <code class="small">músicos</code> se <code class="small">encontram</code>.</p>
            <p><a href="#">Entrar agora!</a></p>
          <!-- </div>
        </div> -->
      </div>
    </main>
    
    <!-- footer -->
    <?php include SITE_PATH . '/includes/footer.php'; ?>    
  
    <script src="<?php echo SITE_URL ?>/bootstrap/js/bootstrap.bundle.min.js"></script>

  </body>
</html>