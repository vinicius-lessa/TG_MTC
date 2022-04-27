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
 *  - Vinícius Lessa - 26/04/2022: Início da implementação da visualização do Anúncio pelo criador (meu perfil > meus anúncios).
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

$post_id = $_GET['trade_post']; // usado em 'c_trade_posts.php'
require SITE_PATH . '/Controllers/c_trade_posts.php';

$post_id      = $tpDetails["data"][0]["post_id"];
$userCreator  = $tpDetails["data"][0]["user_id"];
$titlePage    = $tpDetails['data'][0]['title'];

$isOwnPost    = $tpDetails["data"][0]["user_id"] === $_SESSION['user_id'];

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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css"> <!-- Icons -->
    <link rel="stylesheet" href="<?php echo SITE_URL ?>/css/style.css">
    
    
    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="<?php echo SITE_URL ?>/images/icon.png">
  </head>

  <body class="d-flex flex-column h-100 bk-black font-main">
    
    <!-- Header Include -->
    <?php include SITE_PATH . '/includes/header.php'; ?>
    
    <!-- Begin page content -->
    <div class="container">
      <main class="">
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
                  
          <!-- Main Content -->          
          <article>              
            <div class="row tradepost_container">

              <!-- Image Carrousel -->
              <div class="col-12 col-sm-8 p-0 blur-container">
                <!-- Blur -->
                <div class="blur_background" style="background-image: url('<?php echo $tpDetails["data"][0]["image_name"] ?>');">
                </div>

                <!-- Image -->
                <div class="image_container_test" style="transform: translate(0px, -498px);">
                  <img src="<?php echo $tpDetails["data"][0]["image_name"] ?>" class="testtwo" alt="">
                </div>
              </div>

              <!-- Trade Post Info -->
              <div class="col-12 col-sm-4 h-100">

                <!-- Title -->
                <div class="row my-3 mx-0">
                  <div class="col-12">
                    <h3 class="text-white"><strong><?php echo $tpDetails['data'][0]['title']?></strong></h3>
                  </div>
                </div>
                <div class="row my-2 mx-0">
                  <div class="col-12">
                    <h3 class="text-red" style="font-weight: bold;">R$ <?php echo $tpDetails["data"][0]["price"] ?></h3>
                  </div>
                </div>                  

                <!-- Outras Informações sobre o Anúncio -->
                <div class="row my-3 mx-0">
                  <div class="col-12 text-white">
                    <div class="row">
                      <div class="col-6">
                        <p>Categoria: <strong class="size-18"><?php echo $tpDetails["data"][0]["pc_desc"] ?></strong></p>                          
                      </div>
                      <div class="col-6">
                        <p>Marca: <strong class="size-18"><?php echo $tpDetails["data"][0]["pb_desc"] ?></strong></p>
                      </div>
                    </div>

                    <div class="row">
                      <div class="col-12">
                        <p>Modelo: <strong class="size-18"><?php echo $tpDetails["data"][0]["pm_desc"] ?></strong></p>
                      </div>
                    </div>

                    <div class="row">
                      <div class="col-6">
                        <p>Estado: <strong class="size-18">São Paulo</strong></p>                          
                        <p>Cidade: <strong class="size-18">São Roque</strong></p>
                      </div>
                      <div class="col-6">
                      <p>Bairro: <strong class="size-18"></strong></p>
                        <p>Telefone: <strong class="size-18"><?php echo $tpDetails["data"][0]["phone"] ?></strong></p>
                      </div>
                    </div>

                    <!-- Autor do Anúncio -->
                    <div class="row mt-2">
                      <div class="col-12 text-white">

                        <div class="row">
                          <div class="col-12 d-flex justify-content-center">
                            <p>Item anunciado por:</p>
                          </div>
                        </div>

                        <div class="row">
                          <div class="col-12 d-flex align-items-center justify-content-center">
                            <span>
                              <a href="<?php echo SITE_URL ?>/Views/users/user_profile.php/?user_id=<?php echo $tpDetails["data"][0]["user_id"] ?>" 
                              class="text-decoration-none text-white">
                                <strong>
                                  <?php echo $tpDetails["data"][0]["user_name"] ; ?>
                                </strong>
                                <?php if ($isOwnPost) : echo "<small>(Você)</small>" ;  endif; ?>
                              </a>
                            </span>
                            <a 
                              href="<?php echo SITE_URL ?>/Views/users/user_profile.php/?user_id=<?php echo $tpDetails["data"][0]["user_id"] ?>" 
                              class="nav-link px-4 link-secondary">
                                <!-- <img src="<?php echo SITE_URL ?>/images/icons/profile.png" class="img-fluid" alt="" width="70px" height="70px"> -->
                                <img src="<?php echo SITE_URL ?>/images/IMAGENS/ARTISTAS/ARTISTA3.jpg" class="img-fluid rounded-circle mx-1" alt="" style="max-width:100%;width:70px;height:70px;object-fit:cover;">
                            </a>                              
                          </div>                                                          
                        </div>

                      </div>              
                    </div>                      

                  </div>
                </div>   
                
                <!-- Conversar/Chat -->
                <div class="row mx-0">
                  <div class="col-12 py-2 text-center">
                    <!-- Validar com JS para exibir o botão, porém ao clicar e ser o mesmo usuário, cancelar a âncora -->
                    <?php
                      if ( !($isOwnPost) ) :
                    ?>
                        <a  class='text-white'
                            href='<?php echo SITE_URL ; ?>/Views/users/chat.php/?user=<?php echo $userCreator ; ?>&post_id=<?php echo $post_id ; ?>&img_url=<?php echo $tpDetails["data"][0]["image_name"] ; ?>'>
                          <button type='button' class='btn btn-lg border-0 btn-default'>
                            <strong>Conversar com <?php echo $tpDetails["data"][0]["user_name"] ; ?></strong>
                          </button>
                        </a>
                    <?php
                      endif;
                    ?>
                  </div>
                </div>

              </div>
            </div>
            
            <!-- Description -->
            <div class="row">
              <div class="col-12 mt-4 mb-5">
                <div>
                  <h5 class="card-title text-white mt-2" style="text-align:left;"><strong>Descrição do Anúncio:</strong></h5>
                </div>
                <div class="mt-3">
                  <p class="card-title text-white" style="text-align:left;"><?php echo $tpDetails["data"][0]["tp_desc"] ?></p>
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
      
      <div class="col-12">
        <hr class="hr-default">
      </div>

      <!-- OUTROS ANÚNCIOS-->
      <section>      
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
            <?php foreach ($a_tpList["data"] as $a_tpItem) { ?>
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
      </section>

      <section>
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
      </section>
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