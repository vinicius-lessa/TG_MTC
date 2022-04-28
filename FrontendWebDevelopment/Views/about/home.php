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
    <!-- StyleSheet -->
    <!-- <link rel="stylesheet" href="<?php echo SITE_URL ?>/css/bootstrap/bootstrap.min.css"> --> <!-- Get Bootstrap -->
    <link rel="stylesheet" href="<?php echo SITE_URL ?>/css/bootstrap/bootstrap.css"> <!-- Get Bootstrap -->    
    <!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css"> --> <!-- Icons -->
    <link rel="stylesheet" href="<?php echo SITE_URL ?>/css/style.css">
    
    
    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="<?php echo SITE_URL ?>/images/icon.png">
  </head>

  <body class="d-flex flex-column h-100 bk-black font-main">

    <!-- Header Include -->
    <?php include SITE_PATH .'/includes/header.php';?>

    <main>
      <div class="container mt-5 mb-2">
        <div class="text-left">
          <div class="row">
            <h2 class="text-white"><strong>Q U E M &nbsp;S O M O S</strong></h2>
            <hr>
          </div>

          <div class="row">
            <div class="col-6">
              <h4 class="text-white">Somos uma empresa com foco no ramo da Música, proporcionando um Serviço totalmente focado na imersão de compra e venda de músico para músico.</h4>
            </div>
          </div>
      </div>

      <div class="container col-6 col-sm-6 mb-3 mt-2">
        <img class="img-fluid" src="<?php echo SITE_URL ?>/images/IMAGENS/QUEMSOMOS01-1.jpg" alt="Quem Somos">
      </div>

      <div class="container col-6"></div>
    </main>

    <!-- footer site -->
    <?php include SITE_PATH.'/includes/footer.php'; ?>

    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="<?php echo SITE_URL ?>/js/bootstrap.bundle.js"></script>
    <script src="<?php echo SITE_URL ?>/js/main.js"></script>
  </body>

</html>