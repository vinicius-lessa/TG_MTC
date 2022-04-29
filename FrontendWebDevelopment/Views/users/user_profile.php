<?php
/**
 * File DOC
 * 
 * @Description SingIn Page to users do their login
 * @ChangeLog 
 *  - Renata Carrillo - 12/04/2022: Padronização do <head>.
 *  - Vinícius Lessa - 13/04/2022: Correções mínimas de session.
 *  - Vinícius Lessa - 19/04/2022: Diversas mudanças e implementações para validar tipo de visualização e buscar dados do usuário do Banco.
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

// Vars
$userState = null; // 0 = Não Logado - 1 = Perfil Próprio - 2 = Perfil Público

// User State Verify
if ( !(isset($_SESSION['user_id']) && isset($_SESSION['user_name']) && isset($_SESSION['user_email'])) ):
  $userState = 0; // Não logado
  $titlePage = "Perfil | Bloqueado";

else:  
  if ( !(isset($_GET['user_id'])) || $_GET['user_id'] === $_SESSION['user_id'] ):
    $userState = 1; // Perfil Próprio 
    $profileID = $_SESSION['user_id'];

  else:
    $userState = 2; // Perfil Público
    $profileID = $_GET['user_id'];
        
  endif;
  
  require SITE_PATH . '/Controllers/c_user.php';

  $titlePage  = "Perfil | " . $profileDetails['data'][0]['user_name'];
  
  if ( $profileDetails['error'] ):
    $userSearchError = true;
  else:
    // Calculates Age
    $birthday = date_create_from_format('Y-m-d', $profileDetails['data'][0]['birthday']);
    $now      = date_create_from_format('Y-m-d', date('Y-m-d'));
    $diff     = (array) date_diff($birthday, $now);
    $age      = $diff['y'];
    
    // Self URL profile photo
    if ( $userState == 1 && 
        (!isset($_SESSION['profile-pic']) || $_SESSION['profile-pic'] != $profileDetails['data'][0]['image_name']) 
    ):
      $_SESSION['profile-pic'] = $profileDetails['data'][0]['image_name'];
    endif;    

  endif;

endif;

$a_userTradePosts   = []; // Chamado em 'c_trad_posts.php'
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
    <meta name="description" content="Página que exibirá (somente quando logado) o perfil do usuário">
    <title> <?php echo $titlePage; ?> </title>
    
    <!-- StyleSheet -->
    <!-- <link rel="stylesheet" href="<?php echo SITE_URL ?>/css/bootstrap/bootstrap.min.css"> --> <!-- Get Bootstrap -->
    <link rel="stylesheet" href="<?php echo SITE_URL ?>/css/bootstrap/bootstrap.css"> <!-- Get Bootstrap -->    
    <!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css"> --> <!-- Icons -->
    <link rel="stylesheet" href="<?php echo SITE_URL ?>/css/style.css">
    
    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="<?php echo SITE_URL ?>/images/icon.png">

    <script type="text/javascript">

      if ( $userState = 1 ) { // Perfil prórpio
        var user_id = <?php echo $profileID ?>; // called in 'profile.js'
      }      

    </script>
  </head>

  <!-- Loading Animation -->
  <div class='spinner-wrapper'>
    <div class="spinner"></div>
  </div>

  <body class="d-flex flex-column h-100 bk-black font-main">

    <!-- Header Include -->
    <?php include SITE_PATH .'/includes/header.php';?>

    <main>
      <!-- Error on User Search ? Yes -->
      <?php if ( $userSearchError ): ?>
        <div class="container text-center text-white">
          <div class="row">
            <div class="col-12 my-5">
              <h1 class=""><strong>Usuário Não Encontrado!</strong></h1>
            </div>

            <div class="col-12 my-5">
              <h5 class="">Sentimos muito pelo inconveniente. O perfil solicitado não foi encontrado.</h5>
              <p> <?php echo $profileDetails["msg"] ?></p>
            </div>

            <div class="col-12 my-5">
              <h3>¯\_(ツ)_/¯</h3>
            </div>                
          </div>
        </div>

      <!-- Error on User Search ? No -->
      <?php else: ?>
      
        <div class="container">          
          
        <!-- Não Logado -->
        <?php
          if ( $userState === 0 ):
          
            // Login necessário para acessar essa página
            header("location:" . SITE_URL . "/Views/users/sign_in.php");
        
          // Perfil Próprio        
          elseif ( $userState === 1 ):
        ?>
          <div class="row">
            <div class="col-12 col-sm-6 mt-5">
              <h1 class="text-white"><strong>Seu Perfil</strong></h1>
            </div>
            
            <div class="col-12">
              <div class="text-gray">
                <span>Profile #<?php echo $profileDetails['data'][0]['user_id'] ?></span>
              </div>
            </div>
              
            <div class="col-12">
              <hr class="hr-default">
            </div>
          </div>

          <!-- Profile Header -->
          <div class="container bk-gray text-white rounded">
            
            <div class="row">
              <div class="col-12 d-flex justify-content-center my-3 p-2">
                <div>
                  <?php if ( isset($_SESSION['profile-pic']) ): ?>
                    <img src="<?php echo $_SESSION['profile-pic'] ?>" class="img-fluid rounded-circle" alt="" style="max-width:100%;width:300px;height:300px;object-fit:cover;">
                  <?php else: ?>
                    <img src="<?php echo SITE_URL ?>/images/icons/default-profile-img.png" class="img-fluid rounded-circle" alt="" style="max-width:100%;width:300px;height:300px;object-fit:cover;">
                  <?php endif; ?>
                </div>             
              </div>
              <div class="col-12 d-flex justify-content-center">              
              </div>
            </div>

            <div class="row">
              <div class="col-12 text-center bk-blue p-0" style="height: 0px;">
                <form id="profilepic-form" enctype="multipart/form-data" method="post">
                  <div class="profile-btn" style="transform: translate(80px, -80px);">
                    <button type="button" class="btn btn-primary p-1">
                      <label class="profileImage-label" for="profile-image">
                        <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-pencil-fill" viewBox="0 0 16 16">
                          <path d="M12.854.146a.5.5 0 0 0-.707 0L10.5 1.793 14.207 5.5l1.647-1.646a.5.5 0 0 0 0-.708l-3-3zm.646 6.061L9.793 2.5 3.293 9H3.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.207l6.5-6.5zm-7.468 7.468A.5.5 0 0 1 6 13.5V13h-.5a.5.5 0 0 1-.5-.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.5-.5V10h-.5a.499.499 0 0 1-.175-.032l-.179.178a.5.5 0 0 0-.11.168l-2 5a.5.5 0 0 0 .65.65l5-2a.5.5 0 0 0 .168-.11l.178-.178z"/>
                        </svg>
                      </label>
                    </button>                  
                    <input type="file" name="profile-image" id="profile-image" style="display: none;">
                  </div>
                  <!-- <input type="submit" value="Send"> -->
                </form>
              </div>
            </div>
              
            <div class="row">
              <div class="col-12 text-center mb-3 mt-1 p-2">
                <span id="msgAlertErroProfile" class="d-flex justify-content-center"></span>
                <h4><strong><?php echo $_SESSION['user_name'] ?></strong></h4>
                <h5 style="font-weight: bold;"><?php echo ($age > 100 ? "Idade: não informado" : $age . " Anos"); ?> </h5>
              </div>
            </div>
          </div>        

          <!-- Profile Info -->
          <div class="container bk-gray mt-3 mb-5 rounded">
                      
            <div class="row text-white">
              <div class="col-12 p-2">

                <!-- Multiple Tabs -->
                <div class="row">
                  <div class="col-12">
                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                      <li class="nav-item" role="presentation">
                        <button class="nav-link active default-tabs" id="dados-tab" data-bs-toggle="tab" data-bs-target="#dados" type="button" role="tab" aria-controls="dados" aria-selected="true">Meus Dados</button>
                      </li>
                      <li class="nav-item" role="presentation">
                        <button class="nav-link default-tabs" id="anuncios-tab" data-bs-toggle="tab" data-bs-target="#anuncios" type="button" role="tab" aria-controls="anuncios" aria-selected="false">Meus Anúncios</button>
                      </li>
                      <li class="nav-item" role="presentation">
                        <button class="nav-link default-tabs" id="configuration-tab" data-bs-toggle="tab" data-bs-target="#configuration" type="button" role="tab" aria-controls="configuration" aria-selected="false">Configurações</button>
                      </li>
                    </ul>
                  </div>
                </div>

                <div class="row">
                  <div class="col-12">
                    <div class="tab-content" id="myTabContent">
                      
                      <!-- Self User Data -->
                      <div class="tab-pane fade show active" id="dados" role="tabpanel" aria-labelledby="dados-tab">                                            
                        <div class="row">
                          <div class="col-12 mt-5 mb-5 text-center">
                            <h4 class="text-red"><strong>Minhas Informações</strong></h4>
                          </div>
                        </div>

                        <div class="row mx-1">
                        <div class="col-6">
                          <h6 class="text-red"><strong>Habilidades</strong></h6>
                          <p class="text-white">Guitarra</p>
                          <p class="text-white">Violão</p>
                          <p class="text-white">Baixo</p>
                          
                          <div class="form-group mb-3">
                          <select class="custom-select" id="inputGroupSelect02">
                            <option selected>Escolha...</option>
                            <option value="1">Guitarra</option>
                            <option value="2">Violão</option>
                            <option value="3">Baixo</option>
                            <option value="4">Bateria</option>
                            <option value="5">Piano</option>
                          </select>
                          <div class="input-group-append">
                            <buttom class="input-group-text btn" type="button" for="inputGroupSelect02"><img src="<?php echo SITE_URL ?>/images/IMAGENS/ÍCONES/MAIS.png" class="img-fluid" alt="" width="25px" height="25px"></buttom>
                          </div>
                          </div>

                          <!-- BIOGRAFIA -->
                          <h6 class="text-red mt-5"><strong>Biografia</strong></h6>
                          <!-- <div class="form-group">
                          <textarea class="form-control" type="text" name="description" id="description" rows="3">
                            <?php echo $profileDetails['data'][0]['bio'] ?>
                          </textarea>
                          </div> -->

                          <p class="text-white mt-2" style="font-size:14px;">
                          <?php echo $profileDetails['data'][0]['bio'] ?>
                          </p>

                        </div>          

                        <!-- OUTRAS INFORMAÇÕES -->
                        <div class="col-6 mb-5 text-white">
                          <h6 class="text-red"><strong>Outras Informações</strong></h6>

                          <!-- GÊNERO -->
                          <label><strong>Gênero(s):</strong></label>
                          <p class="text-white">Guitarra</p>
                          <p class="text-white">Violão</p>
                          <p class="text-white">Baixo</p>

                          <div class="input-group mb-3">
                          <select class="custom-select" id="inputGroupSelect02">
                            <option selected>Escolha...</option>
                            <option value="1">Guitarra</option>
                            <option value="2">Violão</option>
                            <option value="3">Baixo</option>
                            <option value="4">Bateria</option>
                            <option value="5">Piano</option>
                          </select>
                          <div class="input-group-append">
                            <buttom class="input-group-text btn" type="button" for="inputGroupSelect02"><img src="<?php echo SITE_URL ?>/images/IMAGENS/ÍCONES/MAIS.png" class="img-fluid" alt="" width="25px" height="25px"></buttom>
                          </div>
                          </div>

                          <!-- CIDADE -->
                          <div class="form-group mt-3">
                          <label class="mb-2" for="brand"><strong>Cidade:</strong></label>
                          <select class="form-select" name="brand" id="brand">
                            <option selected>Escolha...</option>
                            <option value="1">São Paulo</option>
                            <option value="2">São Roque</option>
                            <?php foreach ($selectBrand as $itemBrand) {?>
                            <option value="<?php echo $itemBrand['brand_id'] ?>"><?php echo $itemBrand['description'] ?></option>
                            <?php };?>
                          </select>
                          </div>

                          <!-- ESTADO -->
                          <div class="form-group mt-3">
                          <label class="mb-2" for="brand"><strong>Estado:</strong></label>
                            <select class="form-select" name="brand" id="brand">
                            <option selected>Escolha...</option>
                            <option value="1">São Paulo</option>
                            <option value="2">Rio de Janeiro</option>
                            <?php foreach ($selectBrand as $itemBrand) {?>
                              <option value="<?php echo $itemBrand['brand_id'] ?>"><?php echo $itemBrand['description'] ?></option>
                            <?php };?>
                            </select>
                          </div>

                          <!-- DATA DE NASCIMENTO -->
                          <div class="form-group mt-3">
                          <label class="mb-2" for="brand"><strong>Data de Nascimento:</strong></label>
                            <p><?php echo $profileDetails['data'][0]['birthday'] ?></p>
                            <!-- <select class="form-select" name="brand" id="brand">
                            <option selected>Escolha...</option>
                            <option value="1">São Paulo</option>
                            <option value="3">São Roque</option>
                            <?php foreach ($selectBrand as $itemBrand) {?>
                              <option value="<?php echo $itemBrand['brand_id'] ?>"><?php echo $itemBrand['description'] ?></option>
                            <?php };?>                  
                            </select> -->
                          </div>

                          <!-- E-MAIL -->
                          <div class="form-group text-white mt-3">
                          <label for="userEmail"><strong>E-mail:</strong></label>
                          <input type="email" class="form-control" placeholder="<?php echo $profileDetails['data'][0]['email'] ?>" id="userEmail" name="email">
                          </div>                
                          
                          <!-- BIOGRAFIA -->
                          <!-- <h6 class="text-red mt-5"><strong>Experiência</strong></h6> -->

                          <!-- <div class="form-group">
                          <textarea class="form-control" type="text" name="description" id="description" rows="3"></textarea>
                          </div>
                          <p class="text-white mt-2" style="font-size:14px;">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent
                          eu facilisis orci, cursus luctus arcu. Vivamus venenatis ultrices vem
                          enatis. Sed consectetur at tellus id placerat. Vestibulum ante ipsu
                          primis in faucibus orci luctus et ultrices posuere cubilia curae.
                          </p> -->
                        </div>
                        </div>
                      </div>                    

                      <!-- Self User Trade Posts -->
                      <div class="tab-pane fade" id="anuncios" role="tabpanel" aria-labelledby="anuncios-tab">                    
                        <div class="row mt-5">
                          <div class="col-12 text-center p-0">
                            <h4 class="text-red"><strong>Meus Anúncios</strong></h4>
                          </div>
                        </div>

                        <div class="row">
                          <div class="col-12 mt-0 mb-4 p-4">
                            <? if ( empty($a_userTradePosts["data"]) ): ?>
                              <div class="row text-center">
                                <div class="col-12 my-3">
                                  <h5 class="mb-5">
                                    Você ainda não possui nenhum Anúncio :(
                                  </h5>
                                  <h5>
                                    Comece a
                                    <a class="linkdefault" href="<?php echo SITE_URL ?>/Views/trade_posts/new_post.php">
                                      <button type='button' class='btn btn-lg border-0 btn-default'>
                                      <strong>ANUNCIAR</strong>
                                      </button>
                                    </a> 
                                    agora mesmo!
                                  </h5>
                                </div>

                              </div>
                            <? else: ?>
                            
                              <?php foreach ($a_userTradePosts["data"] as $a_tpItem) { ?>
                                <div class="row my-3 mx-2 p-2">
                                    
                                  <!-- Image -->                              
                                  <div class="col-12 col-sm-3 p-0 blur-container" style="height: 230px;">
                                    <!-- Blur -->
                                    <div class="blur_background" style=" background-image: url('<?php echo $a_tpItem['image_name'] ?>');">
                                    </div>

                                    <!-- Image -->
                                    <div class="image_container_test" style="transform: translate(0px, -229px);">
                                      <a href="<?php echo SITE_URL ?>/Views/trade_posts/trade_post_detailed.php/?trade_post=<?php echo $a_tpItem['post_id'] ?>">
                                        <img src="<?php echo $a_tpItem['image_name'] ?>" class="testtwo" alt="" style="">
                                      </a>
                                    </div>
                                  </div>
                                  

                                  <!-- Trade Post Info -->
                                  <div class="col-12 col-sm-9 tp-card">
                                    <!-- Detalhes -->  
                                    <div class="row mt-2">
                                      <div class="col-8">
                                        <div class="col-8">
                                          <h5 class="card-title text-white "><strong><?php echo $a_tpItem['title'] ?></strong></h5>
                                          <h4 class="card-title text-red"><strong><small>R$ </small><?php echo number_format($a_tpItem['price'], 2, ',', '.') ?></strong></h4>                                      
                                        </div>
                                      </div>
                                    </div>
                                                                          
                                    <div class="row">
                                      <div class="col-8">
                                        <span class="card-title text-white ">
                                          Sobre: <?php echo $a_tpItem['tp_desc'] ?>
                                        </span>
                                      </div>

                                      <!-- Link -->
                                      <!-- <div class="col-4 d-flex flex-row-reverse">
                                        <a href="<?php echo SITE_URL ?>/Views/trade_posts/trade_post_detailed.php/?trade_post=<?php echo $a_tpItem['post_id'] ?>"
                                        class="card-title text-white">Detalhes</a>
                                      </div> -->                                  
                                    </div>

                                  </div>
                                </div>
                              <?php } ?>
                            <? endif; ?>
                            
                          </div>
                        </div>                      
                      </div>

                      <!-- CONFIGURAÇÕES -->
                      <div class="tab-pane fade" id="configuration" role="tabpanel" aria-labelledby="configuration-tab">
                        
                        <div class="row mt-5">
                          <div class="col-12 text-center p-0">
                            <h4 class="text-red"><strong>Suas Configurações</strong></h4>
                          </div>
                        </div>

                      </div>

                    </div>
                  </div>
                </div>
              </div>
            </div>
            
          </div>          
        
        <!-- Perfil Público -->        
        <?php
          elseif ( $userState === 2 ):
        ?>        
          <div class="container">
            <div class="row">
              <div class="col-12 col-sm-6 mt-5">
                <h1 class="text-white"><strong>Perfil Público</strong></h1>
              </div>
              <div class="text-gray">
                <span>Profile #<?php echo $profileDetails['data'][0]['user_id'] ?></span>
              </div>              
              <hr>
            </div>
          </div>
          
          <!-- Profile Header -->
          <div class="container bk-gray text-white rounded">
            <div class="row">
              <div class="col-2"></div>
              <div class="col-8 mt-3 mb-3 text-center p-2">
                <?php if ( isset($profileDetails['data'][0]['image_name']) ): ?>
                  <img src="<?php echo $profileDetails['data'][0]['image_name'] ; ?>" class="img-fluid rounded-circle" alt="" style="max-width:100%;width:300px;height:300px;object-fit:cover;">
                <?php else: ?>
                  <img src="<?php echo SITE_URL ?>/images/icons/default-profile-img.png" class="img-fluid rounded-circle" alt="" style="max-width:100%;width:300px;height:300px;object-fit:cover;">
                <?php endif; ?>

                
                <div class="mt-4">
                  <h4><strong><?php echo $profileDetails['data'][0]['user_name'] ?></strong></h4>
                  <h5 style="font-weight: bold;"><?php echo ($age > 100 ? "Idade: não informado" : $age . " Anos"); ?> </h5>
                </div>
              </div>
              <div class="col-2"></div>
            </div>
          </div>

          <!-- Profile Info -->
          <div class="container bk-gray mt-3 mb-5 rounded">
            
            <div class="row text-white">
              <div class="col-12 p-2">

                <!-- Multiple Tabs -->
                <div class="row">
                  <div class="col-12">
                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                      <li class="nav-item" role="presentation">
                        <button class="nav-link active default-tabs" id="dados-tab" data-bs-toggle="tab" data-bs-target="#dados" type="button" role="tab" aria-controls="dados" aria-selected="true">Informações</button>
                      </li>
                      <li class="nav-item" role="presentation">
                        <button class="nav-link default-tabs" id="anuncios-tab" data-bs-toggle="tab" data-bs-target="#anuncios" type="button" role="tab" aria-controls="anuncios" aria-selected="false">Anúncios Públicados</button>
                      </li>
                    </ul>
                  </div>
                </div>

                <div class="row">
                  <div class="col-12">
                    <div class="tab-content" id="myTabContent">
                      
                      <!-- Public User Info -->
                      <div class="tab-pane fade show active" id="dados" role="tabpanel" aria-labelledby="dados-tab">                                            
                        <div class="row">
                          <div class="col-12 mt-5 mb-5 text-center">
                            <h5 class="text-red"><strong>Mais Sobre <?php echo $profileDetails['data'][0]['user_name'] ?></strong></h5>
                          </div>
                        </div>

                        <div class="row mx-1">

                          <div class="col-6">
                            <h6 class="text-red"><strong>Habilidades</strong></h6>
                            <p class="text-white">Guitarra</p>
                            <p class="text-white">Violão</p>
                            <p class="text-white">Baixo</p>
                            
                            <!--
                            <div class="form-group mb-3">
                              <select class="custom-select" id="inputGroupSelect02">
                                <option selected>Escolha...</option>
                                <option value="1">Guitarra</option>
                                <option value="2">Violão</option>
                                <option value="3">Baixo</option>
                                <option value="4">Bateria</option>
                                <option value="5">Piano</option>
                              </select>
                              <div class="input-group-append">
                                <buttom class="input-group-text btn" type="button" for="inputGroupSelect02"><img src="<?php echo SITE_URL ?>/images/IMAGENS/ÍCONES/MAIS.png" class="img-fluid" alt="" width="25px" height="25px"></buttom>
                              </div> 
                            </div>
                            -->

                            <!-- BIOGRAFIA -->
                            <h6 class="text-red mt-5"><strong>Biografia</strong></h6>
                            <!-- <div class="form-group">
                              <textarea class="form-control" type="text" name="description" id="description" rows="3"></textarea>
                            </div> -->
                            <p class="text-white mt-2" style="font-size:14px;">
                              <?php echo $profileDetails['data'][0]['bio'] ?>
                            </p>            
                          </div>                                   

                          <!-- OUTRAS INFORMAÇÕES -->
                          <div class="col-6 text-white mb-4">
                            <h6 class="text-red"><strong>Outras Informações</strong></h6>

                            <!-- GÊNERO -->
                            <label><strong>Gênero(s):</strong></label>
                            <p class="text-white">Guitarra</p>
                            <p class="text-white">Violão</p>
                            <p class="text-white">Baixo</p>

                            <div class="input-group mb-3">
                              <!-- <select class="custom-select" id="inputGroupSelect02">
                                <option selected>Escolha...</option>
                                <option value="1">Guitarra</option>
                                <option value="2">Violão</option>
                                <option value="3">Baixo</option>
                                <option value="4">Bateria</option>
                                <option value="5">Piano</option>
                              </select> -->
                              <!-- <div class="input-group-append">
                                <buttom class="input-group-text btn" type="button" for="inputGroupSelect02"><img src="<?php echo SITE_URL ?>/images/IMAGENS/ÍCONES/MAIS.png" class="img-fluid" alt="" width="25px" height="25px"></buttom>
                              </div> -->
                            </div>

                            <!-- CIDADE -->
                            <div class="form-group mt-3">
                              <label class="mb-2" for="brand"><strong>Cidade:</strong></label>
                              <!-- <select class="form-select" name="brand" id="brand">
                                <option selected>Escolha...</option>
                                <option value="1">São Paulo</option>
                                <option value="3">São Roque</option>
                                <?php foreach ($selectBrand as $itemBrand) {?>
                                  <option value="<?php echo $itemBrand['brand_id'] ?>"><?php echo $itemBrand['description'] ?></option>
                                <?php };?>
                              </select> -->
                            </div>

                            <!-- ESTADO -->
                            <div class="form-group mt-3">
                              <label class="mb-2" for="brand"><strong>Estado:</strong></label>
                                <!-- <select class="form-select" name="brand" id="brand">
                                  <option selected>Escolha...</option>
                                  <option value="1">São Paulo</option>
                                  <option value="3">Rio de Janeiro</option>
                                  <?php foreach ($selectBrand as $itemBrand) {?>
                                    <option value="<?php echo $itemBrand['brand_id'] ?>"><?php echo $itemBrand['description'] ?></option>
                                  <?php };?>
                                </select> -->
                            </div>

                            <!-- DATA DE NASCIMENTO -->
                            <div class="form-group mt-3">
                              <label class="mb-2" for="brand"><strong>Data de Nascimento:</strong></label>
                              <p> <?php echo $profileDetails['data'][0]['birthday'] ?> </p>
                            <!-- <select class="form-select" name="brand" id="brand">
                                  <option selected>Escolha...</option>
                                  <option value="1">São Paulo</option>
                                  <option value="3">São Roque</option>
                                  <?php foreach ($selectBrand as $itemBrand) {?>
                                    <option value="<?php echo $itemBrand['brand_id'] ?>"><?php echo $itemBrand['description'] ?></option>
                                  <?php };?>                  
                                </select> -->
                            </div>

                            <!-- E-MAIL -->
                            <div class="form-group text-white mt-3">
                              <label for="userEmail"><strong>E-mail:</strong></label>
                              <p><?php echo $profileDetails['data'][0]['email'] ?></p>
                              <!-- <input type="email" class="form-control" placeholder="name@example.com" id="userEmail" name="email"> -->
                            </div>

                            <!-- <h6 class="text-red mt-5"><strong>Experiência</strong></h6> -->

                            <!-- BIOGRAFIA -->
                            <!-- <div class="form-group"> -->
                              <!-- <textarea class="form-control" type="text" name="description" id="description" rows="3"></textarea> -->
                            <!-- </div> -->
                            <!-- <p class="text-white mt-2" style="font-size:14px;">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent
                              eu facilisis orci, cursus luctus arcu. Vivamus venenatis ultrices vem
                              enatis. Sed consectetur at tellus id placerat. Vestibulum ante ipsu
                              primis in faucibus orci luctus et ultrices posuere cubilia curae.
                            </p> -->
                          </div>
                       
                        </div>                                                  
                      </div>                    

                      <!-- Public User Trade Posts -->
                      <div class="tab-pane fade" id="anuncios" role="tabpanel" aria-labelledby="anuncios-tab">                    
                        <div class="row mt-5">
                          <div class="col-12 text-center p-0">
                            <h4 class="text-red"><strong>Meus Anúncios</strong></h4>
                          </div>
                        </div>

                        <div class="row">
                          <div class="col-12 mt-0 mb-4 p-4">
                            
                            <? if ( empty($a_userTradePosts["data"]) ): ?>
                                <div class="row text-center">
                                  <div class="col-12 my-3">
                                    <h5>
                                      Este usuário não possui 
                                        <a class="linkdefault" href="<?php echo SITE_URL ?>/Views/trade_posts/home.php">
                                          <button type='button' class='btn btn-lg btn-default'>
                                            <strong>Anúncios</strong>
                                          </button>
                                        </a>
                                    </h5>
                                  </div>

                                  <div class="col-12 my-3">
                                    <h3>¯\_(ツ)_/¯</h3>
                                  </div>
                                </div>
                            <? else: ?>
                              <?php foreach ($a_userTradePosts["data"] as $a_tpItem) { ?>
                                <div class="row my-3 mx-2 p-2">
                                    
                                  <!-- Image -->                              
                                  <div class="col-12 col-sm-3 p-0 blur-container" style="height: 230px;">
                                    <!-- Blur -->
                                    <div class="blur_background" style=" background-image: url('<?php echo $a_tpItem['image_name'] ?>');">
                                    </div>

                                    <!-- Image -->
                                    <div class="image_container_test" style="transform: translate(0px, -229px);">
                                      <a href="<?php echo SITE_URL ?>/Views/trade_posts/trade_post_detailed.php/?trade_post=<?php echo $a_tpItem['post_id'] ?>">
                                        <img src="<?php echo $a_tpItem['image_name'] ?>" class="testtwo" alt="" style="">
                                      </a>
                                    </div>
                                  </div>
                                  

                                  <!-- Trade Post Info -->
                                  <div class="col-12 col-sm-9 tp-card">
                                    <!-- Detalhes -->  
                                    <div class="row mt-2">
                                      <div class="col-8">
                                        <div class="col-8">
                                          <h5 class="card-title text-white "><strong><?php echo $a_tpItem['title'] ?></strong></h5>
                                          <h4 class="card-title text-red"><strong><small>R$ </small><?php echo number_format($a_tpItem['price'], 2, ',', '.') ?></strong></h4>                                      
                                        </div>
                                      </div>
                                    </div>
                                                                          
                                    <div class="row">
                                      <div class="col-8">
                                        <span class="card-title text-white ">
                                          Sobre: <?php echo $a_tpItem['tp_desc'] ?>
                                        </span>
                                      </div>

                                      <!-- Link -->
                                      <!-- <div class="col-4 d-flex flex-row-reverse">
                                        <a href="<?php echo SITE_URL ?>/Views/trade_posts/trade_post_detailed.php/?trade_post=<?php echo $a_tpItem['post_id'] ?>"
                                        class="card-title text-white">Detalhes</a>
                                      </div> -->                                  
                                    </div>

                                  </div>
                                </div>
                              <?php } ?>
                            <? endif; ?>
                            
                          </div>
                        </div>                      
                      </div>

                    </div>
                  </div>
                </div>
              </div>
            </div>          
          </div>
        
        <!-- Erro Inesperado -->
        <?php 
          elseif ( $userState == null ):
            header("location:" . SITE_URL . "/Views/homepage/index.php");
          endif;
        ?>

        </div>

      <!-- Error on User Search ? End -->
      <?php endif; ?>
    </main>
    
    <!-- footer site -->
    <?php include SITE_PATH.'/includes/footer.php'; ?>

    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>    
    <script src="<?php echo SITE_URL ?>/js/bootstrap.bundle.js"></script>
    <script src="<?php echo SITE_URL ?>/js/profile.js"></script>
  </body>

</html>