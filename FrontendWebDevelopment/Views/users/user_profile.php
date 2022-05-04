<?php
/**
 * File DOC
 * 
 * @Description SingIn Page to users do their login
 * @ChangeLog 
 *  - Renata Carrillo - 12/04/2022: Padronização do <head>.
 *  - Vinícius Lessa - 13/04/2022: Correções mínimas de session.
 *  - Vinícius Lessa - 19/04/2022: Diversas mudanças e implementações para validar tipo de visualização e buscar dados do usuário do Banco.
 *  - Vinícius Lessa - 30/04/2022: Inclusão dos Botões de EXCLUIR ANÚNCIO e ALTERAR ANÚNCIO (Não Funcional).
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

include_once '../../defaultFunctions.php';

// Vars
$defaultContent = $_GET["key"];
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
      
        <div class="container zeroMargin-Padding-mobile">
          
        <!-- Não Logado -->
        <?php
          if ( $userState === 0 ):
          
            // Login necessário para acessar essa página
            header("location:" . SITE_URL . "/Views/users/sign_in.php");
        
          // Perfil Próprio        
          elseif ( $userState === 1 ):
        ?>
          <div class="container">
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
          </div>

          <!-- Profile Header -->
          <div class="container bk-gray text-white rounded">
            
            <div class="row ">
              <div class="col-12 d-flex justify-content-center my-3 p-2">
                <div>
                  <?php if ( isset($_SESSION['profile-pic']) ): ?>
                    <img src="<?php echo $_SESSION['profile-pic'] ?>" class="img-fluid rounded-circle" alt="" style="max-width:100%;width:300px;height:300px;object-fit:cover;">
                  <?php else: ?>
                    <img src="<?php echo SITE_URL ?>/images/icons/default-profile-img.png" class="img-fluid rounded-circle" alt="" style="max-width:100%;width:300px;height:300px;object-fit:cover;">
                  <?php endif; ?>
                </div>             
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
                <h5 style="font-weight: bold;"><?php echo ($age > 100 ? "Idade: não informado" : $age . " Anos"); ?></h5>
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
                        <button class="nav-link <?php echo $defaultContent == "about" ? "active" : "" ; ?> default-tabs" id="dados-tab" data-bs-toggle="tab" data-bs-target="#dados" type="button" role="tab" aria-controls="dados" aria-selected="true">Meus Dados</button>
                      </li>
                      <li class="nav-item" role="presentation">
                        <button class="nav-link <?php echo $defaultContent == "trade_posts" ? "active" : "" ; ?> default-tabs" id="anuncios-tab" data-bs-toggle="tab" data-bs-target="#anuncios" type="button" role="tab" aria-controls="anuncios" aria-selected="false">Meus Anúncios</button>
                      </li>
                      <li class="nav-item" role="presentation">
                        <button class="nav-link <?php echo $defaultContent == "config" ? "active" : "" ; ?> default-tabs" id="configuration-tab" data-bs-toggle="tab" data-bs-target="#configuration" type="button" role="tab" aria-controls="configuration" aria-selected="false">Configurações</button>
                      </li>
                    </ul>
                  </div>
                </div>

                <div class="row">
                  <div class="col-12">
                    <div class="tab-content" id="myTabContent">
                      
                      <!-- Self User Data -->
                      <div class="tab-pane fade <?php echo $defaultContent == "about" ? "show active" : "" ; ?>" id="dados" role="tabpanel" aria-labelledby="dados-tab">                                            
                        <div class="row">
                          <div class="col-12 mt-5 mb-5 text-center">
                            <h4 class="text-red"><strong>Minhas Informações</strong></h4>
                          </div>
                        </div>

                        <div class="row mx-1">
                          <div class="col-12 col-sm-6">
                            <div class="text-center">
                              <h5 class="text-red">Informações Artísticas</h5>
                            </div>

                            <!-- Habilidades -->
                            <div class="row mb-3">
                              <div class="col-12 m-0">
                                <p><strong>Principais Habilidades:</strong></p>
                                <p class="text-white">Canto, Guitarra Solo, Bateria Básica</p>
                              </div>
                              <div class="col-10 m-0">                                
                                <select class="form-select" aria-label="Default select example">
                                  <option selected>Adicionar Habilidades</option>
                                  <option value="1">Guitarra Base</option>
                                  <option value="1">Guitarra Solo</option>
                                  <option value="1">Violão Clássico</option>
                                  <option value="1">Contrabaixo Elétrico</option>
                                  <option value="1">Contrabaixo Acústico</option>
                                  <option value="1">Bateria</option>
                                  <option value="1">Percussão</option>
                                  <option value="2">Metais (Sopro)</option>
                                  <option value="2">Metais (Madeira)</option>
                                  <option value="2">Violino</option>
                                  <option value="2">Violoncelo</option>
                                  <option value="2">Harpa</option>
                                  <option value="4">DJ</option>
                                  <option value="5">Produtor</option>
                                  <option value="6">Engenheiro de Áudio</option>
                                </select>
                              </div>
                              <div class="col-2 m-0">
                                <buttom class="btn btn-NoFill-default text-lightred" type="button">
                                  <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-plus-circle-fill" viewBox="0 0 16 16">
                                    <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM8.5 4.5a.5.5 0 0 0-1 0v3h-3a.5.5 0 0 0 0 1h3v3a.5.5 0 0 0 1 0v-3h3a.5.5 0 0 0 0-1h-3v-3z"/>
                                  </svg>
                                </buttom>
                              </div>
                            </div>

                            <hr class="hr-default">

                            <!-- Gênero -->
                            <div class="row mb-3">
                              <div class="col-12 m-0">
                                <p><strong>Gêneros Preferidos:</strong></p>
                                <p class="text-white">Rock & Roll, Blues, Bossa Nova</p>
                              </div>
                              <div class="col-10 m-0">                                
                                <select class="form-select" aria-label="Default select example">
                                  <option selected>Adicionar Gêneros</option>
                                  <option value="1">Hard Rock</option>
                                  <option value="1">Heavy Metal</option>
                                  <option value="1">Death Metal</option>
                                  <option value="1">Black Metal</option>
                                  <option value="1">Grunge</option>
                                  <option value="1">Glam Rock</option>
                                  <option value="1">Opera Rock</option>
                                  <option value="2">Blues</option>
                                  <option value="3">Folk</option>
                                  <option value="4">Bossa Nova</option>
                                  <option value="5">Sertanejo</option>
                                  <option value="6">EDM</option>
                                  <option value="7">Tours</option>
                                  <option value="8">Funk</option>
                                  <option value="9">Funk (Carioca)</option>
                                </select>
                              </div>
                              <div class="col-2 m-0">
                                <buttom class="btn btn-NoFill-default text-lightred" type="button">
                                  <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-plus-circle-fill" viewBox="0 0 16 16">
                                    <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM8.5 4.5a.5.5 0 0 0-1 0v3h-3a.5.5 0 0 0 0 1h3v3a.5.5 0 0 0 1 0v-3h3a.5.5 0 0 0 0-1h-3v-3z"/>
                                  </svg>
                                </buttom>
                              </div>
                            </div>

                            <hr class="hr-default">

                            <!-- Bio -->
                            <h6 class="text-red mt-4"><strong>Biografia</strong></h6>
                            <!-- <div class="form-group">
                            <textarea class="form-control" type="text" name="description" id="description" rows="3">
                              <?php // echo $profileDetails['data'][0]['bio'] ?>
                            </textarea>
                            </div> -->

                            <p class="text-white mt-2" style="font-size:14px;">
                              <?php echo (isset($profileDetails['data'][0]['bio']) ? $profileDetails['data'][0]['bio'] : "Não Informado") ; ?>
                            </p>

                          </div>          

                          <!-- OUTRAS INFORMAÇÕES -->
                          <div class="col-12 col-sm-6 mb-5">
                            <div class="text-center">
                              <h5 class="text-red">Outras Informações</h5>
                            </div>

                            <!-- E-mail -->
                            <div class="form-group text-white mt-3">
                              <label for="userEmail"><strong>E-mail:</strong></label>
                              <input type="email" class="form-control" placeholder="Informe seu E-mail" id="userEmail" name="email" value="<?php echo $profileDetails['data'][0]['email'] ; ?>">
                            </div>

                            <!-- Phone -->
                            <div class="form-group text-white mt-3">
                              <label for="userPhone">Telefone/Celular</label>
                              <input type="tel" class="form-control" placeholder="Informe seu Telefone" id="userPhone" name="phone" value="<?php echo $profileDetails['data'][0]['phone'] ; ?>">
                            </div>

                            <hr class="hr-default">

                            <!-- CEP (editable) -->
                            <div class="form-group mt-3">
                              <label for="userZipCode"><strong>Código Postal (CEP):</strong></label>
                              <input 
                                type="text" 
                                class="form-control"
                                placeholder="Preencha seu CEP"
                                id="userZipCode"
                                name="cep"
                                value="<?php echo $profileDetails['data'][0]['cep'] ; ?>"
                              >
                            </div>                            

                            <!-- Estado -->
                            <div class="form-group mt-3">
                              <p class="mb-2">
                                <strong>Estado:</strong>
                                <?php echo (isset($profileDetails['data'][0]['state']) && !empty($profileDetails['data'][0]['state']) ? $profileDetails['data'][0]['state'] : "Não Informado") ?>
                              </p>
                            </div>

                            <!-- Cidade -->
                            <div class="form-group mt-3">
                              <p class="mb-2">
                                <strong>Cidade:</strong>
                                <?php echo (isset($profileDetails['data'][0]['city']) && !empty($profileDetails['data'][0]['city']) ? $profileDetails['data'][0]['city'] : "Não Informado") ?>
                              </p>
                            </div>
                            
                            <!-- Bairro -->
                            <div class="form-group mt-3">
                              <p class="mb-2">
                                <strong>Bairro:</strong>
                                <?php echo (isset($profileDetails['data'][0]['district']) && !empty($profileDetails['data'][0]['district']) ? $profileDetails['data'][0]['district'] : "Não Informado") ?>
                              </p>
                            </div>

                            <hr class="hr-default">

                            <!-- Birthday -->
                            <div class="form-group mt-3">
                              <p class="mb-2">
                                <strong>Data de Nascimento:</strong>
                                <?php echo ($age > 100 ? "Não Informado" : str_replace("-", "/", date('d-m-Y' , strtotime( $profileDetails['data'][0]['birthday'] ))) . " (" . $age . " Anos)" ); ?>
                              </p>
                            </div>

                          </div>

                        </div>
                      </div>

                      <!-- Self User Trade Posts -->
                      <div class="tab-pane fade <?php echo $defaultContent == "trade_posts" ? "show active" : "" ; ?>" id="anuncios" role="tabpanel" aria-labelledby="anuncios-tab">                    
                        <div class="row mt-5">
                          <div class="col-12 text-center p-0">
                            <h4 class="text-red"><strong>Meus Anúncios</strong></h4>
                          </div>
                        </div>

                        <div class="row">
                          <div class="col-12 mt-0 mb-4 p-4 zeroMargin-Padding-mobile">
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
                            
                              <?php 
                                $lastId = 0;
                                foreach ( $a_userTradePosts["data"] as $a_tpItem ) { 
                                  if ( $lastId == $a_tpItem['post_id'] ):
                                    continue; // Skip Iteration
                                  endif;
                                  $lastId = $a_tpItem['post_id'];
                              ?>
                                <div class="row my-3 mx-2 p-2 zeroMargin-Padding-mobile">
                                                                      
                                  <!-- Image -->
                                  <div class="col-12 col-sm-3 p-0 image-container-new" id="profileTP-img-container">
                                    <?php if ( isset($a_tpItem['image_name']) && $a_tpItem['image_name'] != null && validateImageSource($a_tpItem['image_name']) ): ?>

                                      <!-- Blur -->
                                      <div class="img-default-content img_background_blur " style=" background-image: url('<?php echo $a_tpItem['image_name'] ?>');">
                                      </div>

                                      <!-- Image -->
                                      <div class="img-default-content img_tp">
                                        <a href="<?php echo SITE_URL ?>/Views/trade_posts/trade_post_detailed.php/?trade_post=<?php echo $a_tpItem['post_id'] ?>">
                                          <img src="<?php echo $a_tpItem['image_name'] ?>" class="img-tag-tp-default" alt="" style="">
                                        </a>
                                      </div>
                                    <?php else: ?>
                                      <div class="img-default-content">
                                        <a href="<?php echo SITE_URL ?>/Views/trade_posts/trade_post_detailed.php/?trade_post=<?php echo $a_tpItem['post_id'] ?>">
                                          <img src="<?php echo SITE_URL ?>/images/icons/no-image-icon.png" alt="Imagem ilustrativa de um produto voltado ao meio musical.">
                                        </a>
                                      </div>
                                    <?php endif; ?>
                                  </div>                                  

                                  <!-- Trade Post Info -->
                                  <div class="col-12 col-sm-9 tp-card px-3 py-3">
                                  
                                    <!-- Detalhes -->  
                                    <div class="row">
                                      
                                      <!-- Título + Preço -->
                                      <div class="col-12 col-sm-10 text-center-mobile">
                                          <a class="linkdefault" href="<?php echo SITE_URL ?>/Views/trade_posts/trade_post_detailed.php/?trade_post=<?php echo $a_tpItem['post_id'] ?>">
                                            <h3 class="card-title text-white "><strong><?php echo $a_tpItem['title'] ?></strong></h3>
                                          </a>
                                          <h4 class="card-title text-red"><strong><small>R$ </small><?php echo number_format($a_tpItem['price'], 2, ',', '.') ?></strong></h4>
                                      </div>
                                      
                                      <!-- Funções/CRUD -->
                                      <div class="col-12 col-sm-2 my-3">
                                        
                                        <div class="row">
                                          <div class="col-6 col-sm-12 py-2">
                                            <div class="text-center">
                                              <a class="linkdefault" id="editButton" href="<?php echo SITE_URL ?>/Views/trade_posts/new_post.php/?action=update&post_id=<?php echo $a_tpItem['post_id']; ?>" >
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-fill" viewBox="0 0 16 16" style="transform: translate(-3px, -2px);">
                                                  <path d="M12.854.146a.5.5 0 0 0-.707 0L10.5 1.793 14.207 5.5l1.647-1.646a.5.5 0 0 0 0-.708l-3-3zm.646 6.061L9.793 2.5 3.293 9H3.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.207l6.5-6.5zm-7.468 7.468A.5.5 0 0 1 6 13.5V13h-.5a.5.5 0 0 1-.5-.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.5-.5V10h-.5a.499.499 0 0 1-.175-.032l-.179.178a.5.5 0 0 0-.11.168l-2 5a.5.5 0 0 0 .65.65l5-2a.5.5 0 0 0 .168-.11l.178-.178z"/>
                                                </svg>                                                
                                                <span>Editar</span>
                                              </a>
                                            </div>
                                          </div>

                                          <div class="col-6 col-sm-12 py-2">
                                            <div class="text-center">
                                              <a class="linkdefault" href="#" data-bs-toggle="modal" data-bs-target="#confirm-delete">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash3-fill" viewBox="0 0 16 16" style="transform: translate(-3px, -2px);">
                                                  <path d="M11 1.5v1h3.5a.5.5 0 0 1 0 1h-.538l-.853 10.66A2 2 0 0 1 11.115 16h-6.23a2 2 0 0 1-1.994-1.84L2.038 3.5H1.5a.5.5 0 0 1 0-1H5v-1A1.5 1.5 0 0 1 6.5 0h3A1.5 1.5 0 0 1 11 1.5Zm-5 0v1h4v-1a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5ZM4.5 5.029l.5 8.5a.5.5 0 1 0 .998-.06l-.5-8.5a.5.5 0 1 0-.998.06Zm6.53-.528a.5.5 0 0 0-.528.47l-.5 8.5a.5.5 0 0 0 .998.058l.5-8.5a.5.5 0 0 0-.47-.528ZM8 4.5a.5.5 0 0 0-.5.5v8.5a.5.5 0 0 0 1 0V5a.5.5 0 0 0-.5-.5Z"/>
                                                </svg>                                                
                                                <span>Excluir</span>
                                              </a>
                                            </div>
                                          </div>
                                        </div>

                                        <!-- Model Delete Window -->
                                        <div class="modal fade text-black" id="confirm-delete" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
                                          <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content">

                                              <div class="modal-header">
                                                <h5 class="modal-title" id="deleteModalLabel">Deletar</h5>
                                                <button type="button" class="btn-close" id="closeModalBtn" data-bs-dismiss="modal" aria-label="Close"></button>

                                              </div>
                                              <div class="modal-body">
                                                Deseja realmente Deletar este Anúncio?
                                              </div>

                                              <div class="my-2">
                                                <div class="justify-content-center" id="modalLoading" style="display: none;">
                                                  <div class="spinner-border text-danger" role="status"></div><br>
                                                </div>
                                              </div>

                                              <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                                <button type="button" class="btn btn-danger" id="deleteButton" data-post-id="<?php echo $a_tpItem['post_id'] ?>">Excluir</button>
                                                <div ></div>
                                              </div>

                                            </div>
                                          </div>
                                        </div>                                        

                                      </div>                                      
                                                                          
                                    </div>
                                    
                                    <!-- Descrição -->
                                    <div class="row">
                                      <div class="col-12 text-white">
                                        <span class="card-title">
                                          Descrição do Anúncio:
                                        </span>
                                        <p><?php echo $a_tpItem['tp_desc'] ?></p>
                                      </div>
                                    </div>

                                  </div>
                                </div>
                              <?php } ?>
                            <? endif; ?>
                            
                          </div>
                        </div>                      
                      </div>

                      <!-- CONFIGURAÇÕES -->
                      <div class="tab-pane fade <?php echo $defaultContent == "config" ? "show active" : "" ; ?>" id="configuration" role="tabpanel" aria-labelledby="configuration-tab">
                        
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
              
              <div class="col-12">
                <hr class="hr-default">
              </div>              
            </div>
          </div>
          
          <!-- Profile Header -->
          <div class="container bk-gray text-white rounded">
            <div class="row">
              
              <div class="col-12 mt-3 mb-3 text-center p-2">
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
                        <button class="nav-link <?php echo $defaultContent == "about" ? "active" : "" ; ?> default-tabs" id="dados-tab" data-bs-toggle="tab" data-bs-target="#dados" type="button" role="tab" aria-controls="dados" aria-selected="true">Informações</button>
                      </li>
                      <li class="nav-item" role="presentation">
                        <button class="nav-link <?php echo $defaultContent == "trade_post" ? "active" : "" ; ?> default-tabs" id="anuncios-tab" data-bs-toggle="tab" data-bs-target="#anuncios" type="button" role="tab" aria-controls="anuncios" aria-selected="false">Anúncios Públicados</button>
                      </li>
                    </ul>
                  </div>
                </div>

                <div class="row">
                  <div class="col-12">
                    <div class="tab-content" id="myTabContent">
                      
                      <!-- Public User Info -->
                      <div class="tab-pane fade <?php echo $defaultContent == "about" ? "show active" : "" ; ?>" id="dados" role="tabpanel" aria-labelledby="dados-tab">

                        <div class="row">
                          <div class="col-12 mt-5 mb-5 text-center">
                            <h4 class="text-red"><strong>Mais Sobre <?php echo $profileDetails['data'][0]['user_name'] ?></strong></h4>
                          </div>
                        </div>

                        <div class="row mx-1">
                          <div class="col-12 col-sm-6">
                            <div class="text-center">
                              <h5 class="text-red">Informações Artísticas</h5>
                            </div>

                            <!-- Habilidades -->
                            <div class="row mb-3">
                              <div class="col-12 m-0">
                                <p><strong>Principais Habilidades:</strong></p>
                                <p class="text-white">Canto, Guitarra Solo, Bateria Básica</p>
                              </div>                              
                            </div>

                            <hr class="hr-default">

                            <!-- Gênero -->
                            <div class="row mb-3">
                              <div class="col-12 m-0">
                                <p><strong>Gêneros Preferidos:</strong></p>
                                <p class="text-white">Rock & Roll, Blues, Bossa Nova</p>
                              </div>                              
                            </div>

                            <hr class="hr-default">

                            <!-- Bio -->
                            <h6 class="text-red mt-4"><strong>Biografia</strong></h6>
                            <!-- <div class="form-group">
                            <textarea class="form-control" type="text" name="description" id="description" rows="3">
                              <?php // echo $profileDetails['data'][0]['bio'] ?>
                            </textarea>
                            </div> -->

                            <p class="text-white mt-2" style="font-size:14px;">
                              <?php echo (isset($profileDetails['data'][0]['bio']) ? $profileDetails['data'][0]['bio'] : "Não Informado") ; ?>
                            </p>

                          </div>          

                          <!-- OUTRAS INFORMAÇÕES -->
                          <div class="col-12 col-sm-6 mb-5">                            
                            <div class="text-center">
                              <h5 class="text-red">Outras Informações</h5>
                            </div>                            

                            <!-- E-mail -->
                            <div class="form-group text-white mt-3">
                              <p class="mb-2">
                                <strong>E-mail:</strong>
                                <?php echo (isset($profileDetails['data'][0]['email']) && !empty($profileDetails['data'][0]['email']) ? $profileDetails['data'][0]['email'] : "Não Informado") ?>
                              </p>
                            </div>

                            <!-- Phone -->
                            <div class="form-group text-white mt-3">
                              <p class="mb-2">
                                <strong>Telefone/Celular:</strong>
                                <?php echo (isset($profileDetails['data'][0]['phone']) && !empty($profileDetails['data'][0]['phone']) ? $profileDetails['data'][0]['phone'] : "Não Informado") ?>
                              </p>
                            </div>

                            <hr class="hr-default">

                            <!-- CEP (editable) -->
                            <div class="form-group mt-3">
                              <p class="mb-2">
                                <strong>CEP:</strong>
                                <?php echo (isset($profileDetails['data'][0]['cep']) && !empty($profileDetails['data'][0]['cep']) ? $profileDetails['data'][0]['cep'] : "Não Informado") ?>
                              </p>
                            </div>

                            <!-- Estado -->
                            <div class="form-group mt-3">
                              <p class="mb-2">
                                <strong>Estado:</strong>
                                <?php echo (isset($profileDetails['data'][0]['state']) && !empty($profileDetails['data'][0]['state']) ? $profileDetails['data'][0]['state'] : "Não Informado") ?>
                              </p>
                            </div>

                            <!-- Cidade -->
                            <div class="form-group mt-3">
                              <p class="mb-2">
                                <strong>Cidade:</strong>
                                <?php echo (isset($profileDetails['data'][0]['city']) && !empty($profileDetails['data'][0]['city']) ? $profileDetails['data'][0]['city'] : "Não Informado") ?>
                              </p>
                            </div>
                            
                            <!-- Bairro -->
                            <div class="form-group mt-3">
                              <p class="mb-2">
                                <strong>Bairro:</strong>
                                <?php echo (isset($profileDetails['data'][0]['district']) && !empty($profileDetails['data'][0]['district']) ? $profileDetails['data'][0]['district'] : "Não Informado") ?>
                              </p>
                            </div>

                            <hr class="hr-default">

                            <!-- Birthday -->
                            <div class="form-group mt-3">
                              <p class="mb-2">
                                <strong>Data de Nascimento:</strong>
                                <?php echo ($age > 100 ? "Não Informado" : str_replace("-", "/", date('d-m-Y' , strtotime( $profileDetails['data'][0]['birthday'] ))) . " (" . $age . " Anos)" ); ?>
                              </p>
                            </div>

                          </div>

                        </div>                        
                        
                      </div>

                      <!-- Public User Trade Posts -->
                      <div class="tab-pane fade <?php echo $defaultContent == "trade_post" ? "show active" : "" ; ?>" id="anuncios" role="tabpanel" aria-labelledby="anuncios-tab">

                        <div class="row mt-5">
                          <div class="col-12 text-center p-0">
                            <h4 class="text-red"><strong>Anúncios de <?php echo $profileDetails['data'][0]['user_name'] ?></strong></h4>
                          </div>
                        </div>

                        <div class="row">
                          <div class="col-12 mt-0 mb-4 p-4 zeroMargin-Padding-mobile">
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
                              <?php 
                                $lastId = 0;
                                foreach ($a_userTradePosts["data"] as $a_tpItem) {            
                                  if ( $lastId == $a_tpItem['post_id'] ):
                                    continue; // Skip Iteration
                                  endif;
                                  $lastId = $a_tpItem['post_id'];              
                              ?>
                                <div class="row my-3 mx-2 p-2 zeroMargin-Padding-mobile">
                                
                                  <!-- Image -->
                                  <div class="col-12 col-sm-3 p-0 image-container-new" id="profileTP-img-container">
                                    <!-- Blur -->
                                    <div class="img-default-content img_background_blur " style=" background-image: url('<?php echo $a_tpItem['image_name'] ?>');">
                                    </div>

                                    <!-- Image -->                                    
                                    <div class="img-default-content img_tp">
                                      <a href="<?php echo SITE_URL ?>/Views/trade_posts/trade_post_detailed.php/?trade_post=<?php echo $a_tpItem['post_id'] ?>">
                                        <img src="<?php echo $a_tpItem['image_name'] ?>" class="img-tag-tp-default" alt="" style="">
                                      </a>                                      
                                    </div>
                                  </div>

                                  <!-- Trade Post Info -->
                                  <div class="col-12 col-sm-9 tp-card px-3 py-3">

                                    <!-- Detalhes -->  
                                    <div class="row">                                      
                                      <!-- Título + Preço -->
                                      <div class="col-12 col-sm-10 text-center-mobile">
                                          <h3 class="card-title text-white "><strong><?php echo $a_tpItem['title'] ?></strong></h3>
                                          <h4 class="card-title text-red"><strong><small>R$ </small><?php echo number_format($a_tpItem['price'], 2, ',', '.') ?></strong></h4>
                                      </div>                                                                        
                                    </div>
                                       
                                    <!-- Descrição -->
                                    <div class="row">
                                      <div class="col-12 text-white">
                                        <span class="card-title">
                                          Descrição do Anúncio:
                                        </span>
                                        <p><?php echo $a_tpItem['tp_desc'] ?></p>
                                      </div>

                                      <!-- Link -->
                                      <div class="col-12 d-flex flex-row-reverse">
                                        <a href="<?php echo SITE_URL ?>/Views/trade_posts/trade_post_detailed.php/?trade_post=<?php echo $a_tpItem['post_id'] ?>"
                                        class="card-title text-white">Detalhes</a>
                                      </div>                                  
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