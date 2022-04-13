<?php
/**
 * File DOC
 * 
 * @Description Página informativa sobre os idealizadores e criadores do site.
 * @ChangeLog 
 *  - Vinícius Lessa - 12/04/2022: Criação do arquivo da página, estruturação mínima;
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

  $titlePage = 'Sobre Nós';
  $data_slide = 0;  
?>

<!DOCTYPE html>
<html lang="pt-br" class="h-100">
  <head>
    <meta charset='utf-8'>    
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>

    <!-- Page Data -->
    <meta name="author" content="Vinícius Lessa / Renata Carrillo">
    <meta name="description" content="Página informativa sobre os idealizadores e criadores do site.">
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
  <?php include SITE_PATH .'/includes/header.php';?>

  <main>
      <div class="container">
          <div class="text-center">
              <div class="row">
                  <h3 class="text-white">Sobre Nós...</h3>
              </div>
          </div>
      </div>
  </main>

  <!-- footer site -->
  <?php include SITE_PATH.'/includes/footer.php'; ?>

  <!-- Scripts -->
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="<?php echo SITE_URL ?>/js/bootstrap.bundle.min.js"></script>
  <script src="<?php echo SITE_URL ?>/js/main.js"></script>
  </body>

</html>