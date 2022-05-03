<?php
/**
 * File DOC
 * 
 * @Description Página de criação de cadastro por parte do usuário do sistema.
 * @ChangeLog
 *  - Renata Carrillo - 12/04/2022: Padronização do <head> e $titlePage.
 *  - Vinícius Lessa - 13/04/2022: Renomeação da página de 'Anúncios.php' para 'TradePosts.php'
 *  - Renata Carrillo - 18/04/2022: Adicionando o seguinte CSS no img dos anúncios para padronização de tamanho: style="max-width:100%;width:395px;height:295px;object-fit:cover;" 
 *  - Vinícius Lessa - 18/04/2022: Mudança do nome do arquivo de "trade_posts.php" para "home.php". Implentação do array de anúncios vindos do Banco de dados propriamente.
 *  - Renata Carrillo - 20/04/2022: Mudança na disposição das imagens do anúncio + inserção de bk-gray nas especificações dos anúncios
 *  - Renata Carrillo - 21/04/2022: Ajuste no Card: ENCONTRE ARTISTAS pós mudança no Bootstrap.
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

include_once '../../defaultFunctions.php';

// Vars
$titlePage  = 'MTC | Anúncios';
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
    <!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">--> <!-- Icons -->
    <link rel="stylesheet" href="<?php echo SITE_URL ?>/css/bootstrap/bootstrap.css"> <!-- Get Bootstrap -->
    <link rel="stylesheet" href="<?php echo SITE_URL ?>/css/style.css">
    
    
    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="<?php echo SITE_URL ?>/images/icon.png">    
  </head>

  <body class="d-flex flex-column h-100 bk-black font-main">
    
    <!-- Header Include -->
    <?php include SITE_PATH . '/includes/header.php'; ?>
    
    <!-- Begin page content -->
    <main>
      <div class="container mb-5">
        <div class="row">
          <div class="col-12 col-sm-6 mt-5">
            <h1 class="text-white"><strong>A N Ú N C I O S</strong></h1>
          </div>
          <hr>
        </div>

        <div class="input-group">
          <div class="form-outline col-10 col-sm-6">
            <input id="search-input" type="search" id="form1" class="form-control" />
          </div>
          <button id="search-button" type="button" class="btn btn-default">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
              <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z"/>
            </svg>
          </button>
        </div>

      </div>
    </main>

    <!-- Trade Posts (Anúncios) vindos do Banco de Dados -->
    <section>
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
              <div class="col-12 col-sm-6 col-lg-4 mt-4 mb-4">
                <div class="p-3">
                  <div class="image_container">
                    <a class="d-flex justify-content-center" href="<?php echo SITE_URL ?>/Views/trade_posts/trade_post_detailed.php/?trade_post=<?php echo $a_tpItem['post_id'] ?>">
                      <?php
                        if ( isset($a_tpItem['image_name']) && $a_tpItem['image_name'] != null ): 
                          if ( validateImageSource($a_tpItem['image_name']) ):?>
                        
                          <img src="<?php echo $a_tpItem['image_name'] ?>" class="image_default" alt="" style="">
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
                  <div class="p-2 bk-gray">
                    <div class="row">
                      <div class="col-12">
                        <h4 class="card-title text-red"><strong><small>R$ </small><?php echo number_format($a_tpItem['price'], 2, ',', '.') ?></strong></h4>
                        <h5 class="card-title text-white "><strong><?php echo $a_tpItem['title'] ?></strong></h5>                        
                      </div>
                    </div>
                    <div class="row mt-2">
                      <div class="col-8">
                        <span class="card-title text-white ">Por:
                          <strong>
                            <a href="<?php echo SITE_URL ?>/Views/users/user_profile.php/?user_id=<?php echo $a_tpItem['user_id'] ?>"
                              class="text-decoration-none text-white">
                              <?php echo $a_tpItem['user_name'] ?>
                            </a>
                          </strong>
                        </span>
                      </div>
                      <div class="col-4 d-flex flex-row-reverse">
                        <a href="<?php echo SITE_URL ?>/Views/trade_posts/trade_post_detailed.php/?trade_post=<?php echo $a_tpItem['post_id'] ?>"
                        class="card-title text-white">Detalhes</a>
                      </div>
                    </div>
                  </div>
                </div>
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
    <div class="container bk-gray col-12 col-sm-8 text-white" style="border-style:solid;border-color:gray;">
        <div class="row mt-3 mb-3">
          <div class="col-12 col-sm-8">
            <h3 class="mt-2 ms-4"><strong>Encontre artistas de diversos genêros</strong></h3>
            <p class="ms-4">Você tem a possibilidade de divulgar o seu trabalho, e encontrar artistas próximos.</p>
          </div>
          <div class="col-12 col-sm-4 mt-1">
            <a class="text-white ms-4" style="font-size:14px;" href="../produtos/MusicTradeCenter.php"><button type="button" class="btn btn-default btn-lg border-0 mt-3"><strong>VER MAIS</strong></button></a>  
          </div>
        </div>
      </div>

    <!-- Footer Include -->
    <?php include SITE_PATH . '/includes/footer.php'; ?>    
  
    <!-- Scripts -->    
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>    
    <script src="<?php echo SITE_URL ?>/js/bootstrap.bundle.js"></script>
    <script src="<?php echo SITE_URL ?>/js/main.js"></script>
        
  </body>

</html>