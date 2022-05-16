<?php
/**
 * File DOC
 * 
 * @Description Página de criação de cadastro por parte do usuário do sistema.
 * @ChangeLog 
 *  - Renata Carrillo - 12/04/2022: Padronização do <head> e titlePage;
 *  - Vinícius Lessa - 18/04/2022: Mudanças do nome do arquivo de "trade_post_view.php" para "trade_post_detailed.php".
 *                                 Mudanças nas estruturas html do anúncio. Implementação do consumo de informações do Banco de dados (de acordo com o anúncio clicado).
 *  - Renata Carrillo - 18/04/22: Inclusão dos "outros anúncios".
 *  - Renata Carrillo - 20/04/2022: Mudança na disposição das imagens do anúncio + inserção de bk-gray nas especificações dos produtos.
 *  - Renata Carrillo - 21/04/2022: Ajuste no Card: ENCONTRE ARTISTAS pós mudança no Bootstrap. 
 *  - Vinícius Lessa - 03/05/2022: Inclusão da Lógica de Carrossel das imagens baseado na quantidade de imagens.
 * 
 * @ Notes: 
 * 
 */

if (session_status() === PHP_SESSION_NONE) {
  session_start();
}

$a_tpList   = []; // Other Trade Posts

if (!defined('SITE_URL')) {
  include_once '../../config.php';
}

include_once SITE_ROOT.'/defaultFunctions.php';

$post_id = $_GET['trade_post']; // usado em 'c_trade_posts.php'
require SITE_PATH . '/Controllers/c_trade_posts.php';

$post_id      = $tpDetails["data"][0]["post_id"];
$userCreator  = $tpDetails["data"][0]["user_id"];
$titlePage    = $tpDetails['data'][0]['title'];

$isOwnPost    = $tpDetails["data"][0]["user_id"] === $_SESSION['user_id'];
$imagesCount  = count($tpDetails["data"]);

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
    <link rel="stylesheet" href="<?php echo SITE_URL ?>/css/bootstrap/bootstrap.css"> <!-- Bootstrap 5 -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.2/font/bootstrap-icons.css"> <!-- Icons -->
    <link rel="stylesheet" href="<?php echo SITE_URL ?>/css/style.css">
    
    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="<?php echo SITE_URL ?>/images/icon.png">

  </head>

  <body class="d-flex flex-column h-100 bk-black font-main">
    
    <!-- Header Include -->
    <?php include SITE_PATH . '/includes/header.php'; ?>
    
    <!-- Begin page content -->
    <div class="container">
      <main>
        <?php       
          if ( isset($tpDetails) && !($tpDetails["error"]) ) :        
        ?>
          <div class="row">
            <div class="col-12 mt-5">
              <h1 class="text-white"><strong><?php echo $tpDetails['data'][0]['title']?></strong></h1>
            </div>
            
            <div class="col-12">
              <div class="text-gray">
                <span class="size-14">Anúncio #<?php echo $tpDetails['data'][0]['post_id'] ; ?></span>
              </div>
            </div>
            
            <div class="col-12">
              <hr class="hr-default">
            </div>
          </div>

          <!-- Main Content -->          
          <article>
            <div class="row">

              <!-- Image Carrousel -->
              <div class="col-12 col-lg-8 p-0">
                <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
                  <div class="carousel-indicators" style="z-index: 10 ;">
                    <?php for ($i = 0; $i < $imagesCount; $i++) {  
                      if ( $i == 0 ):?>
                        <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="<?php echo $i?>" class="active" aria-current="true" aria-label="Slide <?php echo $i?>"></button>
                      <?php else: ?>
                        <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="<?php echo $i?>" aria-label="Slide <?php echo $i?>"></button>
                      <?php endif; ?>
                    <?php }  ?>
                  </div>
                  <div class="carousel-inner">
                    <?php for ($i = 0; $i < $imagesCount; $i++) {  ?>
                      
                      <div class="carousel-item <?php echo $i == 0 ? 'active' : '' ; ?>" data-bs-interval="100000">
                        <div class="col-12 p-0 image-container-new" id="tradepost-img-container">
                          <?php if ( isset($tpDetails["data"][$i]["image_name"]) && $tpDetails["data"][$i]["image_name"] != null && validateImageSource($tpDetails["data"][$i]["image_name"]) ): ?>
                            <!-- Blur -->
                            <div class="img-default-content img_background_blur" style="background-image: url('<?php echo $tpDetails["data"][$i]["image_name"] ?>');">
                            </div>

                            <!-- Image  -->
                            <div class="img-default-content images">
                              <img src="<?php echo $tpDetails["data"][$i]["image_name"] ?>" class="img-tag-tp-default" alt="">
                            </div>
                          <?php else: ?>
                            <div class="img-default-content">
                              <img src="<?php echo SITE_URL ?>/images/icons/no-image-icon.png" class="img-tag-tp-default" alt="Imagem ilustrativa de um produto voltado ao meio musical.">                              
                            </div>
                          <?php endif; ?>
                        </div>
                      </div>

                    <?php }  ?>
                  </div>

                  <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev" style="z-index: 10 ;">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                  </button>
                  <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next" style="z-index: 10 ;">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                  </button>
                </div>
              </div>
              
              <!-- Image Viewer -->
              <div id="image-viewer">
                  <span class="close">&times;</span>
                  <img class="modal-content" id="full-image">
              </div>


              <!-- Trade Post Info -->
              <div class="col-12 col-lg-4 h-100">

                <!-- Title -->
                <div class="row my-3 mx-0">
                  <div class="col-12">
                    <h3 class="text-white"><strong><?php echo $tpDetails['data'][0]['title']?></strong></h3>
                  </div>
                </div>
                <div class="row my-2 mx-0">
                  <div class="col-12">
                    <h3 class="text-red" style="font-weight: bold;">R$ <?php echo number_format($tpDetails["data"][0]["price"], 2, ',', '.') ?></h3>
                  </div>
                </div>                  

                <!-- Outras Informações sobre o Anúncio -->
                <div class="row my-2 mx-0">
                  <div class="col-12 text-white">
                    <div class="row my-2 pb-1 border-bottom border-dark">
                      <div class="col-6">
                        <p class="my-0">Categoria</p>
                        <p class="my-0"><strong class="size-18"><?php echo $tpDetails["data"][0]["pc_desc"] ?></strong></p>
                      </div>
                      <div class="col-6">
                        <p class="my-0">Marca</p>
                        <p class="my-0"><strong class="size-18"><?php echo $tpDetails["data"][0]["pb_desc"] ?></strong></p>
                      </div>
                    </div>

                    <div class="row my-2 pb-1 border-bottom border-dark">
                      <div class="col-12">
                        <p class="my-0">Modelo</p>
                        <p class="my-0"><strong class="size-18"><?php echo $tpDetails["data"][0]["pm_desc"] ?></strong></p>
                      </div>
                    </div>

                    <div class="row my-2 pb-1 border-bottom border-dark">
                      <div class="col-6">
                        <p class="my-0">Estado</p>
                        <p class="my-0"><strong class="size-18"><?php echo (isset($tpDetails["data"][0]["state"]) && !empty($tpDetails["data"][0]["state"]) ? $tpDetails["data"][0]["state"] : "Não Informado" ) ; ?></strong></p>
                      </div>
                      <div class="col-6">
                        <p class="my-0">Cidade</p>
                        <p class="my-0"><strong class="size-18"><?php echo (isset($tpDetails["data"][0]["city"]) && !empty($tpDetails["data"][0]["city"]) ? $tpDetails["data"][0]["city"] : "Não Informado" ) ; ?></strong></p>
                      </div>
                    </div>  
                    
                    <div class="row my-2 pb-1 border-bottom border-dark">
                      <div class="col-12">
                        <p class="my-0">Bairro</p>
                        <p class="my-0"><strong class="size-18"><?php echo (isset($tpDetails["data"][0]["district"]) && !empty($tpDetails["data"][0]["district"]) ? $tpDetails["data"][0]["district"] : "Não Informado" ) ; ?></strong></p>
                      </div>
                    </div>

                    <div class="row my-2 pb-1 border-bottom border-dark">
                      <div class="col-12">
                        <?php 
                          switch ($tpDetails['data'][0]['condition_id']):
                            case "1":
                              $conditionDesc = "Produto Novo";
                              break;
                            case "2":
                              $conditionDesc = "Usado, estado de Novo";
                              break;
                            case "3":
                              $conditionDesc = "Usado, com detalhes";
                              break;
                            case "4":
                              $conditionDesc = "Pare restauração/reaproveitamento";
                              break;
                          endswitch;
                        ?>
                        <p class="my-0">Condição do Item</p>
                        <p class="my-0"><strong class="size-18"><?php echo $conditionDesc ; ?></strong></p>
                      </div>
                    </div>                    

                    <div class="row my-2">
                      <div class="col-12">
                        <p class="my-0">Possui NF ?</p>
                        <p class="my-0"><strong class="size-18"><?php echo ( $tpDetails["data"][0]["eletronic_invoice"] === "0" ? " Não" : " Sim" ) ; ?></strong></p>
                      </div>
                    </div>

                  </div>
                </div>                

              </div>
            </div>
            
            <!-- Description -->
            <div class="row my-4">
              <div class="col-12 col-sm-9 p-0 my-2">
                <div class="rounded bk-gray me-1 p-2 zeroMargin-Padding-mobile tp-detailed-desc h-100">
                  <div class="px-2">
                    <h5 class="card-title text-white text-center mt-2" style="text-align:left;"><strong>Descrição do Anúncio</strong></h5>
                  </div>
                  <div class="my-4 px-2">
                    <p class="card-title text-white size-18" style="text-align:left;"><?php echo nl2br($tpDetails["data"][0]["tp_desc"]) ; ?></p>
                  </div>
                </div>
              </div>              
              
              <div class="col-12 col-sm-3 p-0 my-2">
                <div class="rounded bk-gray ms-1 p-2 zeroMargin-Padding-mobile tp-detailed-desc h-100">
                    <!-- Autor do Anúncio -->
                    <div class="col-12 text-white my-4">

                      <div class="row">
                        <div class="col-12 d-flex justify-content-center">
                          <p>Item anunciado por:</p>
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-12 d-flex align-items-center justify-content-center">
                          <span>
                            <a href="<?php echo SITE_URL ?>/Views/users/user_profile.php/?key=about&user_id=<?php echo $tpDetails["data"][0]["user_id"] ?>" 
                            class="text-decoration-none text-white">
                              <strong>
                                <?php echo $tpDetails["data"][0]["user_name"] ; ?>
                              </strong>
                              <?php if ($isOwnPost) : echo "<small>(Você)</small>" ;  endif; ?>
                            </a>
                          </span>
                          <a
                            href="<?php echo SITE_URL ?>/Views/users/user_profile.php/?key=about&user_id=<?php echo $tpDetails["data"][0]["user_id"] ?>" 
                            class="nav-link px-4 link-secondary">
                              <?php if ( isset($tpDetails["data"][0]["img_profile_name"]) && validateImageSource($tpDetails["data"][0]["img_profile_name"]) ): ?>
                                <img src="<?php echo $tpDetails["data"][0]["img_profile_name"] ?>" class="img-fluid rounded-circle mx-1" alt="" style="max-width:100%;width:70px;height:70px;object-fit:cover;">
                              <?php else: ?>
                                <img src="<?php echo SITE_URL ?>/images/icons/default-profile-img.png" class="img-fluid rounded-circle mx-1" alt="" style="max-width:100%;width:70px;height:70px;object-fit:cover;">
                              <?php endif; ?>
                          </a>
                        </div>
                      </div>

                      <!-- Phone -->
                      <div class="row my-3">
                        <div class="col-12 text-center">
                          <strong class="phone_with_ddd"><?php echo $tpDetails["data"][0]["phone"] ?></strong>
                          <span class="text-red size-18"><i class="bi bi-telephone"></i></span> <!-- Phone Icon -->
                        </div>
                      </div>

                    </div>
                  
                    <!-- Conversar/Chat -->
                    <div class="col-12 d-flex align-items-center justify-content-center" style="margin: 40px 0px 30px 0px;">
                      <?php
                        if ( !($isOwnPost) ) :
                      ?>
                        <a  class='text-white'
                            href='<?php echo SITE_URL ; ?>/Views/users/chat.php/?user=<?php echo $userCreator ; ?>&post_id=<?php echo $post_id ; ?>&img_url=<?php echo $tpDetails["data"][0]["image_name"] ; ?>'>
                          <button type='button' class='btn btn-lg btn-default'>
                            <strong>Chat <?php echo $tpDetails["data"][0]["user_name"] ; ?></strong>
                          </button>
                        </a>
                      <?php
                      endif;
                      ?>
                    </div>                  
                </div>
              </div>
            </div>

          </article>          

        <?php else:  ?>   
          <!-- Problemas ao Solicitar informações ao Server -->
          <div class="row text-center my-5 text-white">
            <h1>Desculpe, não encontramos nada por aqui!</h1>
            <h1 class="mt-5">¯\_(ツ)_/¯</h1>
          </div>
          <div class="row text-center mb-4">
            <p class="text-white"><?php echo $tpDetails['msg'] ?></p>
          </div>
        <?php endif; ?>        
      
      </main>
      
      <!-- OUTROS ANÚNCIOS-->
      <section class="mb-5">      
        <div class="row">
          <div class="col-12 col-sm-12 mt-5">
            <h1 class="text-white"><strong>OUTROS &nbsp;A N Ú N C I O S</strong></h1>
          </div>
          <div class="col-12">
            <hr class="hr-default">
          </div>
        </div>

        <?php 
          if ( isset($a_tpList) && !$a_tpList["error"] ) :
        ?>          
          <div class="row">          
            <?php 
              // Vars
              $tpTotal    = count($a_tpList["data"]);
              $countPosts = 0;
              $lastId     = 0;

              foreach ($a_tpList["data"] as $a_tpItem) { 
                if ( $lastId == $a_tpItem['post_id'] || $a_tpItem['post_id'] == $tpDetails['data'][0]['post_id'] ):
                  continue; // Skip Iteration
                endif;
              
                if ( $countPosts > 5 ): // Max 6 Posts Visible Initially
                  break;
                endif;

              $countPosts++;
              $lastId = $a_tpItem['post_id'];              
            ?>
              <div class="col-12 col-sm-6 col-lg-4 mt-3">
                <div class="image_container">
                  <a class="d-flex justify-content-center" href="<?php echo SITE_URL ?>/Views/trade_posts/trade_post_detailed.php/?trade_post=<?php echo $a_tpItem['post_id'] ?>">
                    <img src="<?php echo $a_tpItem['image_name'] ?>" class="image_default" alt="">
                  </a>
                </div>
                  <p class="card-title text-white mt-2" style="text-align:left;"><strong><?php echo $a_tpItem['title'] ?></strong></p>
                  <p class="card-title text-red" style="text-align:left;"><strong><small>R$</small><?php echo number_format($a_tpItem['price'], 2, ',', '.') ?></strong></p>
              </div>            
            <?php } ?>
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

        <!-- See More -->
        <div class="row">
          <div class="col-12 my-5 text-center">
            <p class="text-white my-0"><a class="link-red" href="<?php echo SITE_URL ?>/Views/trade_posts/home.php">Veja mais Anúncios...</a></p>
          </div>
        </div>
        
      </section>

      <section>
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
      </section>
    </div>       

    <!-- Footer Include -->
    <?php include SITE_PATH . '/includes/footer.php'; ?>    
  
    <!-- Scripts -->    
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    
    <script src="<?php echo SITE_URL ?>/js/bootstrap.bundle.js"></script>

    <script src="<?php echo SITE_URL ?>/js/main.js"></script>
    <script src="<?php echo SITE_URL ?>/js/tradepost.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.15/jquery.mask.min.js"></script> <!-- jQuery - Máscara para Inputs -->
    
  </body>

</html>