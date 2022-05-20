<?php
/**
 * File DOC
 * 
 * @Description Página informativa sobre os idealizadores e criadores do site.
 * @ChangeLog 
 *  - Vinícius Lessa - 12/04/2022: Criação do arquivo da página, estruturação mínima;
 *  - Renata Carrillo - 12/04/2022: Padronização do <head> e $titlePage;
 *  - Renata Carrillo - 01/05/2022: Estruturação do conteúdo da página como um todo;
 *
 * @ Notes: 
 *
 */

if (!defined('SITE_URL')) {
  include_once '../../config.php';
}

include_once SITE_ROOT.'/defaultFunctions.php';

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

    
    <section class="showcase">
      <video src="<?php echo SITE_URL ?>/images/teste.mp4" autoplay loop muted></video>
        <h1 class="title text-center mt-5"><strong>MUSIC TRADE CENTER</strong></h1>
    </section>

      <div class="container mt-5 mb-2">

          <div class="row mt-5">
            <h3 class="text-white"><strong>Q U E M &nbsp;S O M O S</strong></h3>
            <hr>

          <div class="row">
            <div class="col-12 col-sm-6">
              <h4 class="text-white">Somos uma empresa com foco no ramo da Música, proporcionando um Serviço totalmente focado na imersão de <strong class="text-red">compra e venda</strong> de músico para músico.</h4>
            </div>

            <div class="container col-12 col-sm-6 mt-2">
              <img class="img-fluid" src="<?php echo SITE_URL ?>/images/IMAGENS/QUEMSOMOS01-1.jpg" alt="Quem Somos">
            </div>

          </div>
      </div>

      <div class="container mt-5 mb-2">
        <div class="row mt-5">
          <h3 class="text-red"><strong>D E S E N V O L V E D O R E S</strong></h3>
          <hr>
        </div>
      </div>

      <div class="container">
      <div class="row">

        <div class="col-12 col-sm-5">
          <img class="card-img-top ms-4" src="<?php echo SITE_URL ?>/images/IMAGENS/DESENVOLVEDORES/VINICIUS.jpg" style="max-width:250px;max-height:250px;" alt="Card image cap">
          <div class="card-body text-white">
            <h5 class="card-title text-left">Vinícius Lessa</h5>
            <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.
                                 Some quick example text to build on the card title and make up the bulk of the card's content.
                                 Some quick example text to build on the card title and make up the bulk of the card's content.
            </p>
            <a href="https://github.com/vinicius-lessa" class="btn btn-default">Github</a>
          </div>
        </div>

        <div class="col-sm-2"></div>

        <div class="col-12 col-sm-5">
          <img class="card-img-top ms-4" src="<?php echo SITE_URL ?>/images/IMAGENS/DESENVOLVEDORES/IURY.jpg" style="max-width:250px;max-height:250px;" alt="Card image cap">
          <div class="card-body text-white">
            <h5 class="card-title">Iury Kukli</h5>
            <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.
                                 Some quick example text to build on the card title and make up the bulk of the card's content.
                                 Some quick example text to build on the card title and make up the bulk of the card's content.
            </p>
            <a href="https://github.com/iurykuklik" class="btn btn-default">Github</a>
          </div>
        </div>

      </div>
      </div>

    </main>

    <!-- footer site -->
    <?php include SITE_PATH.'/includes/footer.php'; ?>

    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="<?php echo SITE_URL ?>/js/bootstrap.bundle.js"></script>
    <script src="<?php echo SITE_URL ?>/js/main.js"></script>
  </body>

</html>