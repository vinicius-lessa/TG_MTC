<?php
/**
 * File DOC
 * 
 * @Description Página de criação de cadastro por parte do usuário do sistema.
 * @ChangeLog 
 *  - Vinícius Lessa - 12/04/2022: Inclusão da documentação do arquivo;
 * 
 * @ Notes: 
 * 
 */

if (session_status() === PHP_SESSION_NONE) {
  session_start();
}

if (!defined('SITE_URL')) {
  include_once '../../config.php';
}

$titlePage = 'MTC | Início';
$a_tpList   = [];

require SITE_PATH . '/Controllers/c_trade_posts.php';

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
    
    
    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="<?php echo SITE_URL ?>/images/icon.png">
  </head>

  <body class="d-flex flex-column h-100 bk-black font-main">
    
    <!-- Header Include -->
    <?php include SITE_PATH . '/includes/header.php'; ?>
    
    <!-- Begin page content -->
    <main>
      <div class="container mt-5 mb-5">
        <div class="row">
        <div class="col-12 col-sm-6">
          <img src="<?php echo SITE_URL ?>/images/icon.png" class="img-fluid" alt="" width="400">
          </div>

          <div class="col-12 col-sm-6 mt-5 font-main">
            <h6 class="text-red"><strong>Negociação Online</strong></h6>
            <h1 class="text-white"><strong>Music Trade Center</strong></h1>
            <p class="text-white">Aqui você faz negociação online diretamente com o vendedor, de forma transparente e segura, a qualquer horário, plataforma totalmente dedicadas a você.</p>
            <a class="text-white" href="../trade_posts/home.php"><button type="button" class="btn btn-default btn-lg border-0 mt-3"><strong>Negocie agora</strong></button></a>
          </div>
        </div>
      </div>
    </main>

    <!-- MEIO DA HOME -->
    <section>
      <div class="container mt-5">
        <div class="row">
          
          <div class="col-12 col-sm-4 bk-gray center">
            <h1 class="text-red mt-5" style="text-align:center;font-size:42px;"><strong>+3000</strong></h1>
            <h5 class="text-white" style="text-align:center;"><strong>Anúncios em todo o</strong></h5>
            <h5 class="text-white" style="text-align:center;"><strong>estado de São Paulo</strong></h5>
            <h6 class="text-white" style="text-align:center;font-size:12px;margin-top:30px;">em breve em todos os estados</h6>
          </div>  
            
            <div class="col-12 col-sm-4 text-white">
              <a href="../trade_posts/home.php">
                <img class="card-img" style="opacity:90%;" src="<?php echo SITE_URL ?>/images/produtos2/GUITARRA01.jpg" alt="Instrumentos">
              </a>
            </div>

            <div class="col-12 col-sm-4 text-white">
              <a href="../trade_posts/home.php">
                <img class="card-img" style="opacity:90%;" src="<?php echo SITE_URL ?>/images/produtos2/EQUIPAMENTO01.jpg" alt="Equipamentos">
              </a>
            </div>

        </div>
      </div>
    
      <div class="container mb-5 mt-2">
        <div class="row">
          <div class="col-4 center"></div>

            <div class="col-12 col-sm-4 text-white">
              <a href="../trade_posts/home.php">
                <img class="card-img" style="opacity:90%;" src="<?php echo SITE_URL ?>/images/produtos2/ACESSORIOS01.jpg" alt="Acessórios">
              </a>
            </div>

            <div class="col-12 col-sm-4 text-white">
              <a href="../trade_posts/home.php">
                <img class="card-img" style="opacity:90%;" src="<?php echo SITE_URL ?>/images/produtos2/MISCELANIA01.jpg" alt="Miscelânias">
              </a>
            </div>

          </div>
        </div>
      </div>
    </section>

    <!-- Trade Posts (Anúncios) vindos do Banco de Dados -->
    <section>
      <div class="container mt-5">
        <div class="row">

          <div class="col-8">
            <h4 class="text-white"><strong>D E S T A Q U E S</strong></h4>
          </div>

          <div class="col-4 mb-5 d-flex justify-content-end">
            <a class="text-white" href="../trade_posts/home.php"><button type="button" class="btn btn-default btn-lg border-0 mt-3"><strong>VER MAIS</strong></button></a>
          </div>
        </div>
      </div>

      <?php 
        if (isset($a_tpList) && !$a_tpList["error"]) {
      ?>
        <div class="container mb-5">
          <div class="row">          
            <?php foreach ($a_tpList["data"] as $a_tpItem) { ?>
              <!--
                > 990 (lg)= 3
                < 990 (md)= 2
                > 575 (sm)= 1
              -->
              <div class="col-12 col-sm-6 col-lg-4 mt-3">
                <div class="gDskSC">
                  <a class="d-flex justify-content-center" href="<?php echo SITE_URL ?>/Views/trade_posts/trade_post_detailed.php/?trade_post=<?php echo $a_tpItem['post_id'] ?>">
                    <img src="<?php echo $a_tpItem['image_name'] ?>" class="iWRsZI" alt="">
                  </a>
                </div>
                  <p class="card-title text-white mt-2" style="text-align:left;"><strong><?php echo $a_tpItem['title'] ?></strong></p>
                  <p class="card-title text-red" style="text-align:left;"><strong><small>R$</small><?php echo number_format($a_tpItem['price'], 2, ',', '.') ?></strong></p>
              </div>            
            <?php } ?>
          </div>
        </div>
      <?php } else {  ?>
        <div class="container mt-5 mb-5">
          <div class="row text-center mb-4">
            <h3 class="text-white">Desculpe, não encontramos nada por aqui!</h3>
          </div>
          <div class="row text-center mb-4">
            <p class="text-white"><?php echo $a_tpList['msg'] ?></p>
          </div>
        </div>
      <?php } ?>
    </section>

    <!-- ENCONTRE ARTISTAS -->
      <div class="card-group d-flex justify-content-center">
      <!-- <div class="col-12 col-sm-2"></div> -->

      <div class="bk-gray col-12 col-sm-8 text-white" style="border-style:solid;border-color:gray;">
        <div class="row mt-3 mb-3">

          <div class="col-8 col-sm-8">
            <h3 class="mt-2"><strong>Encontre artistas de diversos genêros</strong></h3>
            <p>Você tem a possibilidade de divulgar o seu trabalho, e encontrar artistas próximos.</p>
          </div>

          <div class="col-4 col-sm-2 mt-1">
            <a class="text-white" style="font-size:14px;" href="../produtos/MusicTradeCenter.php"><button type="button" class="btn btn-default btn-lg border-0 mt-3"><strong>VER MAIS</strong></button></a>  
          </div>

        </div>
      </div>

      <!-- <div class="col-12 col-sm-2"></div> -->
    </div>

    <!-- Footer Include -->
    <?php include SITE_PATH . '/includes/footer.php'; ?>    
  
    <!-- Scripts -->    
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="<?php echo SITE_URL ?>/js/bootstrap.bundle.min.js"></script>
    <script src="<?php echo SITE_URL ?>/js/main.js"></script>
    
    
  </body>

</html>