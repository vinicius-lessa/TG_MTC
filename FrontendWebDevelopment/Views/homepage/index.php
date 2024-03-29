<?php
/**
 * File DOC
 * 
 * @Description Página de criação de cadastro por parte do usuário do sistema.
 * @ChangeLog 
 *  - Vinícius Lessa - 12/04/2022: Inclusão da documentação do arquivo;
 *  - Renata Carrillo - 21/04/2022: Ajuste no Card: ENCONTRE ARTISTAS pós mudança no Bootstrap.
 *  - Vinícius Lessa - 27/05/2022: Ajuste no erro de Image Source.
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

include_once SITE_ROOT.'/defaultFunctions.php';

if ( !validateImageSource(BACKEND_URL) ):
  $backendOffLine = true;
endif;

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
    <!-- <link rel="stylesheet" href="<?php echo SITE_URL ?>/css/bootstrap/bootstrap.min.css"> --> <!-- Get Bootstrap -->
    <link rel="stylesheet" href="<?php echo SITE_URL ?>/css/bootstrap/bootstrap.css"> <!-- Get Bootstrap -->    
    <!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css"> --> <!-- Icons -->
    <link rel="stylesheet" href="<?php echo SITE_URL ?>/css/style.css">
    
    
    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="<?php echo SITE_URL ?>/images/icon.png">
  </head>

  <body class="d-flex flex-column h-100 bk-black font-main">

    <?php
      if ( $backendOffLine ): ?>
        <main>
          <div class="container mt-5 mb-5">
            <div class="row">
              <div class="col-12 text-center">
                <h1 class="text-white my-5"><strong>500 - Internal Server Error</strong></h1>
                <h2 class="text-red my-5"><strong>Tivemos problemas na Conexão ao Servidor</strong></h6>
                <a class="text-white my-5" href="index.php"><button type="button" class="btn btn-default btn-lg border-0 mt-3"><strong>Tentar Novamente</strong></button></a>
              </div>
            </div>
          </div>
        </main>
    <?php
      else:        
    ?>    
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
              <?php 
                $lastId = 0;
                foreach ($a_tpList["data"] as $a_tpItem) { 
                  if ( $lastId == $a_tpItem['post_id'] ):
                    continue; // Skip Iteration
                  endif;
                  $lastId = $a_tpItem['post_id'];
              ?>
                <div class="col-12 col-sm-6 col-lg-4 mt-3">
                  <div class="image_container">
                    <a class="d-flex justify-content-center" href="<?php echo SITE_URL ?>/Views/trade_posts/trade_post_detailed.php/?trade_post=<?php echo $a_tpItem['post_id'] ?>">
                      <?php
                        if ( isset($a_tpItem['image_name']) && $a_tpItem['image_name'] != null ):
                          if ( validateImageSource($a_tpItem['image_name']) ):?>                                                  
                            <img src="<?php echo $a_tpItem['image_name'] ?>" class="image_default" alt="">
                        <?php
                          else: ?>
                            <img src="<?php echo SITE_URL ?>/images/icons/no-image-icon.png" class="image_default" alt="" style="">
                        <?php endif; ?>
                      <?php 
                        else: ?>  
                        <img src="<?php echo SITE_URL ?>/images/icons/no-image-icon.png" class="image_default" alt="" style="">
                      <?php endif; ?>
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

      <!-- Encontre Outros Artistas -->
        <div class="container bk-gray col-12 col-sm-8 text-white" style="border-style:solid;border-color:gray;">
          <div class="row mt-3 mb-3">
            <div class="col-12 col-sm-8">
              <h3 class="mt-2 ms-4"><strong>Encontre artistas de diversos genêros</strong></h3>
              <p class="ms-4">Você tem a possibilidade de divulgar o seu trabalho, e encontrar artistas próximos.</p>
            </div>
            <div class="col-12 col-sm-4 mt-1">
              <a class="text-white ms-4 size-14" href="<?php echo SITE_URL ?>/Views/music_trade_center/home.php"><button type="button" class="btn btn-default btn-lg border-0 mt-3"><strong>VER MAIS</strong></button></a>  
            </div>
          </div>
        </div>

      <!-- Footer Include -->
      <?php include SITE_PATH . '/includes/footer.php'; ?>
    
    <?php
      endif;
    ?>
  
    <!-- Scripts -->    
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>    
    <script src="<?php echo SITE_URL ?>/js/bootstrap.bundle.js"></script>
    <script src="<?php echo SITE_URL ?>/js/main.js"></script>    
    
  </body>

</html>