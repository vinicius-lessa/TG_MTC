<?php
/**
 * File DOC
 * 
 * @Description Página de criação de cadastro por parte do usuário do sistema.
 * @ChangeLog 
 *  - Renata Carrillo - 12/04/2022: Padronização do <head> e titlePage;
 *  - Vinícius Lessa - 18/04/2022: Mudanças do nome do arquivo de "trade_post_view.php" para "trade_post_detailed.php".
 *                                 Mudanças nas estruturas html do anúncio. Implementação do consumo de informações do Banco de dados (de acordo com o anúncio clicado).
 *  - Renata Carrillo - 18/04/22: Inclusão dos "outros anúncios"
 *  - Renata Carrillo - 20/04/2022: Mudança na disposição das imagens do anúncio + inserção de bk-gray nas especificações dos produtos;
 *  - Renata Carrillo - 21/04/2022: Ajuste no Card: ENCONTRE ARTISTAS pós mudança no Bootstrap.
 * 
 * @ Notes: 
 * 
 */

if (session_status() === PHP_SESSION_NONE) {
  session_start();
}

$a_tpList   = [];

if (!defined('SITE_URL')) {
  include_once '../../config.php';
}

$isLoggedUser = (isset($_SESSION['user_id']) && isset($_SESSION['user_name']) && isset($_SESSION['user_email'])) ? true : false;

$tradePostID = $_GET['trade_post'];

require SITE_PATH . '/Controllers/c_trade_posts.php';

$titlePage = $tpDetails['data'][0]['title'];

$post_id = $tpDetails["data"][0]["post_id"];
$userCreator = $tpDetails["data"][0]["user_id"];

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
    <!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous"> -->
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
      <div class="container">
        <?php       
          if ( isset($tpDetails) && !($tpDetails["error"]) ) :        
        ?>
          <div class="row">
            <div class="col-12 mt-5">
              <h1 class="text-white"><strong><?php echo $tpDetails['data'][0]['title']?></strong></h1>
            </div>
            
            <div class="col-12">
              <div class="text-gray">
                <span class="size-14">Anúncio #<?php echo $tpDetails['data'][0]['post_id']?></span>
              </div>
            </div>
            
            <div class="col-12">
              <hr class="hr-default">
            </div>
          </div>        
          
          <!-- Trade Post Details -->
          <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
            <ol class="carousel-indicators">
              <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
              <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
              <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
            </ol>
            <!-- <div class="dpotTF"></div> -->
            <div class="carousel-inner bQbWAr">
              <div class="d-flex justify-content-center carousel-item active">
                <img class="image" src="<?php echo $tpDetails["data"][0]["image_name"] ?>" alt="First slide" style="max-width:100%;height:400px;">
              </div>
              <div class="carousel-item">
                <img class="d-block w-100" src="<?php echo $tpDetails["data"][0]["image_name"] ?>" alt="Second slide">
              </div>
              <div class="carousel-item">
                <img class="d-block w-100" src="<?php echo $tpDetails["data"][0]["image_name"] ?>" alt="Third slide">
              </div>
            </div>
            <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
              <span class="carousel-control-prev-icon" aria-hidden="true"></span>
              <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
              <span class="carousel-control-next-icon" aria-hidden="true"></span>
              <span class="sr-only">Next</span>
            </a>
          </div>
          <!-- <div class="row">
            <div class="col-8 col-sm-8">
              <a href="#">
                <img src="<?php //echo $tpDetails["data"][0]["image_name"] ?>" class="img-fluid" alt="" style="max-width:100%;width:695px;height:595px;object-fit:cover;">
              </a>
            </div>
            
            <div class="col-4 col-sm-4">
                <img src="<?php //echo $tpDetails["data"][0]["image_name"] ?>" class="img-fluid" alt="" style="max-width:100%;width:395px;height:295px;object-fit:cover;">
                <img src="<?php //echo $tpDetails["data"][0]["image_name"] ?>" class="img-fluid mt-3" alt="" style="max-width:100%;width:395px;height:295px;object-fit:cover;">
            </div>
          </div> -->
                    
          <!-- Principais Informações -->
          <div class="row mt-4">
            <div class="col-12 col-sm-8">
              
              <div>
                <h5 class="card-title text-white mt-2" style="text-align:left;"><strong>SOBRE</strong></h5>
              </div>

              <!-- Description -->
              <div class="mt-3">
                <p class="card-title text-white" style="text-align:left;"><?php echo $tpDetails["data"][0]["tp_desc"] ?></p>
              </div>
              
              <!-- Outras Informações sobre o Anúncio -->
              <div class="row mt-4">
                <div class="col-12 col-sm-6">
                  <ul class="list-group list-group-flush">
                    <li class="list-group-item bk-black text-white">Cidade: <strong>São Roque</strong></li>
                    <li class="list-group-item bk-black text-white">Bairro: <strong></strong></li>                
                    <li class="list-group-item bk-black text-white">Telefone: <strong><?php echo $tpDetails["data"][0]["phone"] ?></strong></li>
                  </ul>
                </div>
                <div class="col-12 col-sm-6">
                  <ul class="list-group list-group-flush">
                    <li class="list-group-item bk-black text-white">Categoria: <strong><?php echo $tpDetails["data"][0]["pc_desc"] ?></strong></li>
                    <li class="list-group-item bk-black text-white">Marca: <strong><?php echo $tpDetails["data"][0]["pb_desc"] ?></strong></li>
                    <li class="list-group-item bk-black text-white">Modelo: <strong><?php echo $tpDetails["data"][0]["pm_desc"] ?></strong></li>
                    <li class="list-group-item bk-black text-white">Estado: <strong>São Paulo</strong></li>
                  </ul>
                </div>
              </div>

            </div>

            <!-- Valor + Chat + Autor -->
            <div class="col-12 col-sm-4">
              <div class="row">
                <div class="col-8 mt-3">
                  <span class="text-white">Valor:</span><h4 class="text-red"><strong>R$ <?php echo $tpDetails["data"][0]["price"] ?></strong></h4>
                </div>
                <div class="col-4 mt-4">
                  <?php
                    if ( !($isLoggedUser && ($tpDetails["data"][0]["user_id"] === $_SESSION['user_id'])) ) : 
                  ?>
                      <a  class='text-white'
                          href='<?php echo SITE_URL ; ?>/Views/users/chat.php/?user=<?php echo $userCreator ; ?>&post_id=<?php echo $post_id ; ?>&img_url=<?php echo $tpDetails["data"][0]["image_name"] ; ?>'>
                        <button type='button' class='btn btn-lg border-0 btn-default'>
                          <strong>CHAT</strong>
                        </button>
                      </a>
                  <?php
                    endif;
                  ?>
                </div>
              </div>

              <!-- Autor do Anúncio -->
              <div class="row mt-3">                                
                <div class="col-12 text-white">
                  <div class="row">
                    <div class="col-12 d-flex justify-content-center">
                      <h5>Anunciante</h5>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-12 d-flex justify-content-center">
                    <a href="<?php echo SITE_URL ?>/Views/users/user_profile.php/?user_id=<?php echo $tpDetails["data"][0]["user_id"] ?>" class="nav-link px-4 link-secondary"><img src="<?php echo SITE_URL ?>/images/icons/profile.png" class="img-fluid" alt="" width="100px" height="100px"></a>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-12 d-flex justify-content-center">
                      <h5>
                        <a href="<?php echo SITE_URL ?>/Views/users/user_profile.php/?user_id=<?php echo $tpDetails["data"][0]["user_id"] ?>" 
                        class="text-decoration-none text-white">
                          <strong>
                            <?php echo $tpDetails["data"][0]["user_name"] ; 
                                  if ($isLoggedUser) :
                                    echo ( $tpDetails["data"][0]["user_id"] === $_SESSION['user_id'] ? " (Você)" : null );
                                  endif;
                            ?>
                          </strong>
                        </a>
                      </h5>
                    </div>
                  </div>
                </div>              
              </div>
            </div>
          </div>

        <?php else:  ?>   
          <!-- Problemas ao Solicitar informações ao Server -->
          <div class="row text-center mb-4">
            <h3 class="text-white">Desculpe, não encontramos nada por aqui!</h3>
          </div>
          <div class="row text-center mb-4">
            <p class="text-white"><?php echo $tpDetails['msg'] ?></p>
          </div>            
        <?php endif; ?>
      </div>
    </main>

    <div class="container mt-5">
      <div class="row">
        <div class="col-12 col-sm-12 mt-5">
          <h1 class="text-white"><strong>OUTROS &nbsp;A N Ú N C I O S</strong></h1>
        </div>
          <hr></hr>
      </div>
    </div>

    <!-- OUTROS ANÚNCIOS-->
    <!-- Trade Posts (Anúncios) vindos do Banco de Dados -->
    <section>
      <?php 
        if ( isset($a_tpList) && !$a_tpList["error"] ) :
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
      <?php else : ?>
        <div class="container mt-5 mb-5">
          <div class="row text-center mb-4">
            <h3 class="text-white">Desculpe, não encontramos nada por aqui!</h3>
          </div>
          <div class="row text-center mb-4">
            <p class="text-white"><?php echo $a_tpList['msg'] ?></p>
          </div>
        </div>
      <?php endif; ?>
    </section>

    <!-- ENCONTRE ARTISTAS -->
    <div class="card-group d-flex justify-content-center">
      <div class="bk-gray col-12 col-sm-8 text-white" style="border-style:solid;border-color:gray;">
        <div class="row mt-3 mb-3">
          <div class="col-12 col-sm-8">
            <h3 class="mt-2"><strong>Encontre artistas de diversos genêros</strong></h3>
            <p>Você tem a possibilidade de divulgar o seu trabalho, e encontrar artistas próximos.</p>
          </div>
          <div class="col-12 col-sm-2 mt-1">
            <a class="text-white" style="font-size:14px;" href="../produtos/MusicTradeCenter.php"><button type="button" class="btn btn-default btn-lg border-0 mt-3"><strong>VER MAIS</strong></button></a>  
          </div>
        </div>
      </div>
    </div>

    <!-- Footer Include -->
    <?php include SITE_PATH . '/includes/footer.php'; ?>    
  
    <!-- Scripts -->    
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    
    <!-- <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script> -->
    <script src="<?php echo SITE_URL ?>/js/bootstrap.bundle.min.js"></script>

    <script src="<?php echo SITE_URL ?>/js/main.js"></script>
    
    
  </body>

</html>