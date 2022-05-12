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

include_once SITE_ROOT.'/defaultFunctions.php';

// Vars
$defaultContent = $_GET["key"]; // key=about, key=trade_posts, key=config
$userState = 0; // 1 = Perfil Próprio - 2 = Perfil Público

if ( empty($defaultContent) ):
  $defaultContent = "about";
endif;

// User State Verify
if ( !(isset($_SESSION['user_id']) && isset($_SESSION['user_name']) && isset($_SESSION['user_email'])) ):
  header("location:" . SITE_URL . "/Views/users/sign_in.php");
  exit;

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

      if ( <?php echo $userState ; ?> == 1 ) { // Perfil prórpio
        var user_id = <?php echo isset($profileID) ? $profileID : 0 ; ?>; // called in 'profile.js'        
      }

    </script>
  </head>  

  <body class="d-flex flex-column h-100 bk-black font-main">

    <!-- Loading Animation -->
    <div class='spinner-wrapper'>
      <div class="spinner"></div>
    </div>

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
      
        <div class="container ">
          
        
        <?php
          // Perfil Próprio
          if ( $userState === 1 ):
        ?>
          <div class="container zeroMargin-Padding-mobile">
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
            
            <div class="row">
              <div class="col-12 d-flex justify-content-center my-3 p-2">
                <div>
                  <?php if ( isset($_SESSION['profile-pic']) && $_SESSION['profile-pic'] != null && validateImageSource($_SESSION['profile-pic']) ): ?>
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
                    <input type="file" accept="image/*" name="profile-image" id="profile-image" style="display: none;">
                  </div>
                  <!-- <input type="submit" value="Send"> -->
                </form>
              </div>
            </div>
              
            <div class="row">
              <div class="col-12 text-center mb-3 mt-1 p-2">
                <span id="msgAlertErroProfile" class="d-flex justify-content-center"></span>
                <h3><strong><?php echo $_SESSION['user_name'] ?></strong></h3>
                <h4 style="font-weight: bold;"><?php echo ($age > 100 ? "Idade: não informado" : $age . " Anos"); ?></h4>
              </div>
            </div>
          </div>        

          <!-- Profile Info -->
          <div class="container bk-gray mt-3 mb-5 rounded zeroMargin-Padding-mobile">
                      
            <div class="row text-white">
              <div class="col-12 p-2">

                <!-- Multiple Tabs -->
                <div class="row mx-0">
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
                        
                        <article class="px-3 zeroMargin-Padding-mobile">
                          
                          <!-- Form -->
                          <form id="profileUpdate-form">
                            <div class="row">
                              <div class="col-12 mt-5 mb-4 text-center">
                                <h3 class="text-red"><strong>Minhas Informações</strong></h3>
                              </div>
                            </div>

                            <!-- Infomrações Artíticas -->
                            <div class="container zeroMargin-Padding-mobile">

                              <div class="row m-0">
                                <!-- Main Info -->
                                <div class="col-12">
                                  <div class="text-center">
                                    <h5 class="text-red"><strong>Informações Artísticas</strong></h5>
                                  </div>
                                </div>
                              </div>

                              <div class="row mx-1">
                                <!-- Habilidades -->
                                <div class="col-12 col-lg-6 my-0 py-0">
                                  <div class="row my-0">
                                    <p><strong>Principais Habilidades:</strong></p>
                                    <p class="text-white" id="userHabilty-text">Canto, Guitarra Solo, Bateria Básica</p>  <!-- Caso nao tenha nada: "Adicione Novas Habilidades!" -->
                                  </div>

                                  <div class="row my-0">
                                    <div class="col-11 my-0">
                                      <select class="form-select" aria-label="Default select example" id="hability-list">
                                        <option value="" selected>Adicionar Habilidades</option>
                                        <option value="1">Guitarra Base</option>
                                        <option value="2">Guitarra Solo</option>
                                        <option value="3">Violão Clássico</option>
                                        <option value="4">Contrabaixo Elétrico</option>
                                        <option value="5">Contrabaixo Acústico</option>
                                        <option value="6">Bateria</option>
                                        <option value="7">Percussão</option>
                                        <option value="8">Metais (Sopro)</option>
                                        <option value="9">Metais (Madeira)</option>
                                        <option value="10">Violino</option>
                                        <option value="11">Violoncelo</option>
                                        <option value="12">Harpa</option>
                                        <option value="13">DJ</option>
                                        <option value="14">Produtor</option>
                                        <option value="15">Engenheiro de Áudio</option>
                                      </select>
                                    </div>
                                    <div class="col-1 d-flex flex-row-reverse">
                                      <buttom class="btn edit-btn addThing-btn p-0" type="button" name="addHabilty" id="addHabilty">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-plus-circle-fill" viewBox="0 0 16 16">
                                          <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM8.5 4.5a.5.5 0 0 0-1 0v3h-3a.5.5 0 0 0 0 1h3v3a.5.5 0 0 0 1 0v-3h3a.5.5 0 0 0 0-1h-3v-3z"/>
                                        </svg>
                                      </buttom>
                                    </div>
                                  </div>
                                </div>

                                <!-- Gênero -->         
                                <div class="col-12 col-lg-6 my-0 py-0">                   
                                  <div class="row my-0 py-0">
                                    <p><strong>Gêneros Preferidos:</strong></p>
                                    <p class="text-white" id="userStyles-text">Rock & Roll, Blues</p> <!-- Caso nao tenha nada: "Adicione Novos Gêneros!" -->
                                  </div>
                                  <div class="row my-0 py-0">
                                    <div class="col-11 my-0">
                                      <select class="form-select" aria-label="Default select example" id="style-list">
                                        <option value="" selected>Adicionar Gêneros</option>
                                        <option value="1">Hard Rock</option>
                                        <option value="2">Heavy Metal</option>
                                        <option value="3">Death Metal</option>
                                        <option value="4">Black Metal</option>
                                        <option value="5">Grunge</option>
                                        <option value="6">Glam Rock</option>
                                        <option value="7">Opera Rock</option>
                                        <option value="8">Blues</option>
                                        <option value="9">Folk</option>
                                        <option value="10">Bossa Nova</option>
                                        <option value="11">Sertanejo</option>
                                        <option value="12">EDM</option>
                                        <option value="13">Tours</option>
                                        <option value="14">Funk</option>
                                        <option value="15">Funk (Carioca)</option>
                                      </select>
                                    </div>
                                    <div class="col-1 d-flex flex-row-reverse my-0 py-0">
                                      <buttom class="btn edit-btn addThing-btn p-0" type="button" name="addMusicStyle" id="addMusicStyle">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-plus-circle-fill" viewBox="0 0 16 16">
                                          <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM8.5 4.5a.5.5 0 0 0-1 0v3h-3a.5.5 0 0 0 0 1h3v3a.5.5 0 0 0 1 0v-3h3a.5.5 0 0 0 0-1h-3v-3z"/>
                                        </svg>
                                      </buttom>
                                    </div>
                                  </div>
                                </div>
                              </div>

                              <div class="row mx-1">                                  

                                <!-- Bio -->
                                <div class="col-12 col-lg-8 my-0 py-0">
                                  <div class="row my-0 py-0">
                                    <div class="col-12 my-1 py-0">
                                      <h5 class="text-red"><strong>Biografia</strong></h5>
                                    </div>
                                    <div class="col-12 my-1">
                                      <div class="input-group my-0 py-0">
                                        <textarea
                                          class="form-control textAreaDefault"
                                          name="bioText"
                                          id="bio-text"
                                          aria-label="With textarea"
                                          autocapitalize="none"
                                          autocomplete="off"
                                          maxlength="500"
                                          minlength="10"
                                          spellcheck="true"
                                          rows="5"
                                          ><?php echo (isset($profileDetails['data'][0]['bio']) ? $profileDetails['data'][0]['bio'] : "Escreva Sobre Você...") ; ?>
                                        </textarea>
                                      </div>
                                    </div>                                  
                                  </div>
                                  <div class="row my-0 py-0">
                                    <div class="col-12 d-flex flex-row-reverse">
                                      <buttom class="btn edit-btn text-lightred" type="button" name="edit-bio" id="edit-bio">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-pen" viewBox="0 0 16 16">
                                          <path d="m13.498.795.149-.149a1.207 1.207 0 1 1 1.707 1.708l-.149.148a1.5 1.5 0 0 1-.059 2.059L4.854 14.854a.5.5 0 0 1-.233.131l-4 1a.5.5 0 0 1-.606-.606l1-4a.5.5 0 0 1 .131-.232l9.642-9.642a.5.5 0 0 0-.642.056L6.854 4.854a.5.5 0 1 1-.708-.708L9.44.854A1.5 1.5 0 0 1 11.5.796a1.5 1.5 0 0 1 1.998-.001zm-.644.766a.5.5 0 0 0-.707 0L1.95 11.756l-.764 3.057 3.057-.764L14.44 3.854a.5.5 0 0 0 0-.708l-1.585-1.585z"/>
                                        </svg>
                                      </buttom>
                                    </div>
                                  </div>
                                </div>

                                <!-- Redes Sociais -->
                                <div class="col-12 col-lg-4 my-0 py-0">
                                  <div class="row my-0 py-0">
                                    <div class="col-12 my-1 py-0">
                                      <h5 class="text-red"><strong>Redes Sociais</strong></h5>
                                    </div>
                                    <div class="col-12 my-1">
                                      <ul class="list-group list-group-flush">                                        
                                        <li class="list-group-item">
                                          <a href="https://www.facebook.com" class="linkdefault" target="_blank">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-facebook" viewBox="0 0 16 16">
                                              <path d="M16 8.049c0-4.446-3.582-8.05-8-8.05C3.58 0-.002 3.603-.002 8.05c0 4.017 2.926 7.347 6.75 7.951v-5.625h-2.03V8.05H6.75V6.275c0-2.017 1.195-3.131 3.022-3.131.876 0 1.791.157 1.791.157v1.98h-1.009c-.993 0-1.303.621-1.303 1.258v1.51h2.218l-.354 2.326H9.25V16c3.824-.604 6.75-3.934 6.75-7.951z"/>
                                            </svg> /UserTest
                                          </a>
                                        </li>
                                        <li class="list-group-item">
                                          <a href="https://www.instagram.com" class="linkdefault" target="_blank">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-instagram" viewBox="0 0 16 16">
                                              <path d="M8 0C5.829 0 5.556.01 4.703.048 3.85.088 3.269.222 2.76.42a3.917 3.917 0 0 0-1.417.923A3.927 3.927 0 0 0 .42 2.76C.222 3.268.087 3.85.048 4.7.01 5.555 0 5.827 0 8.001c0 2.172.01 2.444.048 3.297.04.852.174 1.433.372 1.942.205.526.478.972.923 1.417.444.445.89.719 1.416.923.51.198 1.09.333 1.942.372C5.555 15.99 5.827 16 8 16s2.444-.01 3.298-.048c.851-.04 1.434-.174 1.943-.372a3.916 3.916 0 0 0 1.416-.923c.445-.445.718-.891.923-1.417.197-.509.332-1.09.372-1.942C15.99 10.445 16 10.173 16 8s-.01-2.445-.048-3.299c-.04-.851-.175-1.433-.372-1.941a3.926 3.926 0 0 0-.923-1.417A3.911 3.911 0 0 0 13.24.42c-.51-.198-1.092-.333-1.943-.372C10.443.01 10.172 0 7.998 0h.003zm-.717 1.442h.718c2.136 0 2.389.007 3.232.046.78.035 1.204.166 1.486.275.373.145.64.319.92.599.28.28.453.546.598.92.11.281.24.705.275 1.485.039.843.047 1.096.047 3.231s-.008 2.389-.047 3.232c-.035.78-.166 1.203-.275 1.485a2.47 2.47 0 0 1-.599.919c-.28.28-.546.453-.92.598-.28.11-.704.24-1.485.276-.843.038-1.096.047-3.232.047s-2.39-.009-3.233-.047c-.78-.036-1.203-.166-1.485-.276a2.478 2.478 0 0 1-.92-.598 2.48 2.48 0 0 1-.6-.92c-.109-.281-.24-.705-.275-1.485-.038-.843-.046-1.096-.046-3.233 0-2.136.008-2.388.046-3.231.036-.78.166-1.204.276-1.486.145-.373.319-.64.599-.92.28-.28.546-.453.92-.598.282-.11.705-.24 1.485-.276.738-.034 1.024-.044 2.515-.045v.002zm4.988 1.328a.96.96 0 1 0 0 1.92.96.96 0 0 0 0-1.92zm-4.27 1.122a4.109 4.109 0 1 0 0 8.217 4.109 4.109 0 0 0 0-8.217zm0 1.441a2.667 2.667 0 1 1 0 5.334 2.667 2.667 0 0 1 0-5.334z"/>
                                            </svg> /UserTest
                                          </a>
                                        </li>
                                        <li class="list-group-item">
                                            <a href="https://www.youtube.com" class="linkdefault" target="_blank">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-youtube" viewBox="0 0 16 16">
                                              <path d="M8.051 1.999h.089c.822.003 4.987.033 6.11.335a2.01 2.01 0 0 1 1.415 1.42c.101.38.172.883.22 1.402l.01.104.022.26.008.104c.065.914.073 1.77.074 1.957v.075c-.001.194-.01 1.108-.082 2.06l-.008.105-.009.104c-.05.572-.124 1.14-.235 1.558a2.007 2.007 0 0 1-1.415 1.42c-1.16.312-5.569.334-6.18.335h-.142c-.309 0-1.587-.006-2.927-.052l-.17-.006-.087-.004-.171-.007-.171-.007c-1.11-.049-2.167-.128-2.654-.26a2.007 2.007 0 0 1-1.415-1.419c-.111-.417-.185-.986-.235-1.558L.09 9.82l-.008-.104A31.4 31.4 0 0 1 0 7.68v-.123c.002-.215.01-.958.064-1.778l.007-.103.003-.052.008-.104.022-.26.01-.104c.048-.519.119-1.023.22-1.402a2.007 2.007 0 0 1 1.415-1.42c.487-.13 1.544-.21 2.654-.26l.17-.007.172-.006.086-.003.171-.007A99.788 99.788 0 0 1 7.858 2h.193zM6.4 5.209v4.818l4.157-2.408L6.4 5.209z"/>
                                            </svg> /UserTest
                                          </a>
                                        </li>                                        
                                      </ul>                                      
                                    </div>
                                  </div>
                                  <!-- <div class="row my-0 py-0">
                                    <div class="col-12 d-flex flex-row-reverse my-0 py-0">
                                      <buttom class="btn edit-btn text-lightred" type="button" name="edit-bio" id="edit-bio">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-pen" viewBox="0 0 16 16">
                                          <path d="m13.498.795.149-.149a1.207 1.207 0 1 1 1.707 1.708l-.149.148a1.5 1.5 0 0 1-.059 2.059L4.854 14.854a.5.5 0 0 1-.233.131l-4 1a.5.5 0 0 1-.606-.606l1-4a.5.5 0 0 1 .131-.232l9.642-9.642a.5.5 0 0 0-.642.056L6.854 4.854a.5.5 0 1 1-.708-.708L9.44.854A1.5 1.5 0 0 1 11.5.796a1.5 1.5 0 0 1 1.998-.001zm-.644.766a.5.5 0 0 0-.707 0L1.95 11.756l-.764 3.057 3.057-.764L14.44 3.854a.5.5 0 0 0 0-.708l-1.585-1.585z"/>
                                        </svg>
                                      </buttom>
                                    </div>
                                  </div> -->
                                </div>

                              </div>

                            </div>

                            <div class="row m-3">
                              <hr class="hr-default">
                            </div>

                            <!-- Other Infos -->
                            <div class="container">

                              <div class="row">
                                <!-- Main Info -->
                                <div class="col-12 p-0 m-0">
                                  <div class="text-center">
                                    <h5 class="text-red"><strong>Outras Informações</strong></h5>
                                  </div>
                                </div>
                              </div>

                              <div class="row">
                                
                                <!-- Nome Usuário -->
                                <div class="col-12 col-sm-6">
                                  <div class="form-group m-0">
                                    <p class="mb-1"><strong>Nome Usuário</strong></p>
                                  </div>
                                  <div class="input-group m-0">
                                    <input 
                                      type="text"
                                      class="form-control"
                                      placeholder="Nome"
                                      id="userName"
                                      name="username"
                                      disabled
                                      value="<?php echo $profileDetails['data'][0]['user_name'] ; ?>"
                                    >
                                    <button class="btn btn-outline-danger" type="button" name="edit-userName" id="edit-userName">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-pen" viewBox="0 0 16 16">
                                          <path d="m13.498.795.149-.149a1.207 1.207 0 1 1 1.707 1.708l-.149.148a1.5 1.5 0 0 1-.059 2.059L4.854 14.854a.5.5 0 0 1-.233.131l-4 1a.5.5 0 0 1-.606-.606l1-4a.5.5 0 0 1 .131-.232l9.642-9.642a.5.5 0 0 0-.642.056L6.854 4.854a.5.5 0 1 1-.708-.708L9.44.854A1.5 1.5 0 0 1 11.5.796a1.5 1.5 0 0 1 1.998-.001zm-.644.766a.5.5 0 0 0-.707 0L1.95 11.756l-.764 3.057 3.057-.764L14.44 3.854a.5.5 0 0 0 0-.708l-1.585-1.585z"/>
                                        </svg>
                                    </button>
                                  </div>
                                </div>

                                <!-- Senha -->
                                <div class="col-12 col-sm-6 py-0">                                  
                                  <div class="form-group m-0">
                                    <p class="mb-1"><strong>Senha</strong></p>
                                  </div>
                                  <div class="input-group m-0">
                                    <input
                                      type="password"
                                      class="form-control"
                                      placeholder="Senha"
                                      id="userPassword"
                                      name="userPassword"
                                      disabled
                                      value="<?php echo $_SESSION['user_password'] ; ?>"
                                    >
                                    <button class="btn btn-outline-danger" type="button" name="edit-password" id="edit-password">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-pen" viewBox="0 0 16 16">
                                          <path d="m13.498.795.149-.149a1.207 1.207 0 1 1 1.707 1.708l-.149.148a1.5 1.5 0 0 1-.059 2.059L4.854 14.854a.5.5 0 0 1-.233.131l-4 1a.5.5 0 0 1-.606-.606l1-4a.5.5 0 0 1 .131-.232l9.642-9.642a.5.5 0 0 0-.642.056L6.854 4.854a.5.5 0 1 1-.708-.708L9.44.854A1.5 1.5 0 0 1 11.5.796a1.5 1.5 0 0 1 1.998-.001zm-.644.766a.5.5 0 0 0-.707 0L1.95 11.756l-.764 3.057 3.057-.764L14.44 3.854a.5.5 0 0 0 0-.708l-1.585-1.585z"/>
                                        </svg>
                                    </button>
                                  </div>
                                </div>

                              </div>

                              <div class="row">
                                
                                <!-- E-mail -->
                                <div class="col-12 col-sm-6" py-0>
                                  <div class="form-group m-0">
                                    <p class="mb-1"><strong>E-mail</strong></p>
                                  </div>
                                  <div class="input-group m-0">
                                    <input 
                                      type="email" 
                                      class="form-control" 
                                      placeholder="Informe seu E-mail" 
                                      id="userEmail" 
                                      name="email"
                                      disabled
                                      value="<?php echo $profileDetails['data'][0]['email'] ; ?>"
                                    >
                                    <button class="btn btn-outline-danger" type="button" name="edit-email" id="edit-email">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-pen" viewBox="0 0 16 16">
                                          <path d="m13.498.795.149-.149a1.207 1.207 0 1 1 1.707 1.708l-.149.148a1.5 1.5 0 0 1-.059 2.059L4.854 14.854a.5.5 0 0 1-.233.131l-4 1a.5.5 0 0 1-.606-.606l1-4a.5.5 0 0 1 .131-.232l9.642-9.642a.5.5 0 0 0-.642.056L6.854 4.854a.5.5 0 1 1-.708-.708L9.44.854A1.5 1.5 0 0 1 11.5.796a1.5 1.5 0 0 1 1.998-.001zm-.644.766a.5.5 0 0 0-.707 0L1.95 11.756l-.764 3.057 3.057-.764L14.44 3.854a.5.5 0 0 0 0-.708l-1.585-1.585z"/>
                                        </svg>
                                    </button>
                                  </div>
                                </div>

                                <!-- Phone -->
                                <div class="col-12 col-sm-6 py-0">                                  
                                  <div class="form-group m-0">
                                    <p class="mb-1"><strong>Telefone/Celular</strong></p>
                                  </div>
                                  <div class="input-group m-0">
                                    <input
                                      type="tel"
                                      class="form-control phone_with_ddd"
                                      maxlength="11"
                                      placeholder="Informe seu Telefone" 
                                      id="userPhone" 
                                      name="phone" 
                                      disabled
                                      value="<?php echo $profileDetails['data'][0]['phone'] ; ?>"
                                    >
                                    <button class="btn btn-outline-danger" type="button" name="edit-phone" id="edit-phone">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-pen" viewBox="0 0 16 16">
                                          <path d="m13.498.795.149-.149a1.207 1.207 0 1 1 1.707 1.708l-.149.148a1.5 1.5 0 0 1-.059 2.059L4.854 14.854a.5.5 0 0 1-.233.131l-4 1a.5.5 0 0 1-.606-.606l1-4a.5.5 0 0 1 .131-.232l9.642-9.642a.5.5 0 0 0-.642.056L6.854 4.854a.5.5 0 1 1-.708-.708L9.44.854A1.5 1.5 0 0 1 11.5.796a1.5 1.5 0 0 1 1.998-.001zm-.644.766a.5.5 0 0 0-.707 0L1.95 11.756l-.764 3.057 3.057-.764L14.44 3.854a.5.5 0 0 0 0-.708l-1.585-1.585z"/>
                                        </svg>
                                    </button>
                                  </div>
                                </div>

                              </div>

                              <div class="row mt-3 mb-0">
                                
                                <!-- CEP -->
                                <div class="col-12 col-sm-6 my-0">
                                  <div class="form-group mb-0">
                                    <p class="mb-1"><strong>Código Postal (CEP)</strong></p>
                                  </div>
                                  <div class="input-group m-0">
                                    <input 
                                      type="text" 
                                      class="form-control cep"
                                      placeholder="Preencha seu CEP"
                                      id="userZipCode"
                                      name="cep"
                                      disabled
                                      value="<?php echo $profileDetails['data'][0]['cep'] ; ?>"
                                    >
                                    <button class="btn btn-outline-danger" type="button" name="edit-cep" id="edit-cep">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-pen" viewBox="0 0 16 16">
                                          <path d="m13.498.795.149-.149a1.207 1.207 0 1 1 1.707 1.708l-.149.148a1.5 1.5 0 0 1-.059 2.059L4.854 14.854a.5.5 0 0 1-.233.131l-4 1a.5.5 0 0 1-.606-.606l1-4a.5.5 0 0 1 .131-.232l9.642-9.642a.5.5 0 0 0-.642.056L6.854 4.854a.5.5 0 1 1-.708-.708L9.44.854A1.5 1.5 0 0 1 11.5.796a1.5 1.5 0 0 1 1.998-.001zm-.644.766a.5.5 0 0 0-.707 0L1.95 11.756l-.764 3.057 3.057-.764L14.44 3.854a.5.5 0 0 0 0-.708l-1.585-1.585z"/>
                                        </svg>
                                    </button>
                                  </div>                                  
                                </div>

                                <div class="col-12 col-sm-6 my-0">
                                  <div class="row m-0">
                                    <div class="col-12 col-lg-4">
                                      <!-- Estado -->
                                      <p>
                                        <strong>Estado:</strong>
                                        <?php echo (isset($profileDetails['data'][0]['state']) && !empty($profileDetails['data'][0]['state']) ? $profileDetails['data'][0]['state'] : "Não Informado") ?>
                                      </p>
                                    </div>
                                    <div class="col-12 col-lg-4">
                                      <!-- Cidade -->
                                      <p>
                                        <strong>Cidade:</strong>
                                        <?php echo (isset($profileDetails['data'][0]['city']) && !empty($profileDetails['data'][0]['city']) ? $profileDetails['data'][0]['city'] : "Não Informado") ?>
                                      </p>
                                    </div>
                                  </div>
                                  <div class="row m-0">
                                    <div class="col-12 col-lg-4">
                                      <!-- Bairro -->
                                      <p>
                                        <strong>Bairro:</strong>
                                        <?php echo (isset($profileDetails['data'][0]['district']) && !empty($profileDetails['data'][0]['district']) ? $profileDetails['data'][0]['district'] : "Não Informado") ?>
                                      </p>
                                    </div>
                                  </div>
                                                                                                                                        
                                </div>
                                
                              </div>

                              <div class="row my-0 mb-5">

                                <!-- Birthday -->
                                <div class="col-12 col-sm-6 my-0 p-2">
                                  <div class="form-group m-0">
                                    <p class="mb-1">
                                      <strong>Data de Nascimento</strong>
                                      <small><?php echo ($age > 100 ? "Não Informado" : str_replace("-", "/", date('d-m-Y' , strtotime( $profileDetails['data'][0]['birthday'] ))) . " (" . $age . " Anos)" ); ?></small>
                                    </p>
                                  </div>                                
                                  <div class="input-group m-0">
                                    <input 
                                      type="date" 
                                      class="form-control" 
                                      placeholder="Informe sua Data de Nascimento" 
                                      value="<?php echo $profileDetails['data'][0]['birthday'] ; ?>"
                                      id="userBirthday"
                                      name="birthday"
                                      aria-label="User's Birthday" 
                                      aria-describedby="edit-birthday"
                                      disabled
                                    >
                                    <button class="btn btn-outline-danger" type="button" name="edit-birthday" id="edit-birthday">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-pen" viewBox="0 0 16 16">
                                          <path d="m13.498.795.149-.149a1.207 1.207 0 1 1 1.707 1.708l-.149.148a1.5 1.5 0 0 1-.059 2.059L4.854 14.854a.5.5 0 0 1-.233.131l-4 1a.5.5 0 0 1-.606-.606l1-4a.5.5 0 0 1 .131-.232l9.642-9.642a.5.5 0 0 0-.642.056L6.854 4.854a.5.5 0 1 1-.708-.708L9.44.854A1.5 1.5 0 0 1 11.5.796a1.5 1.5 0 0 1 1.998-.001zm-.644.766a.5.5 0 0 0-.707 0L1.95 11.756l-.764 3.057 3.057-.764L14.44 3.854a.5.5 0 0 0 0-.708l-1.585-1.585z"/>
                                        </svg>
                                    </button>                                  
                                  </div>
                                </div>

                                <!-- Tipo Pessoa -->
                                <div class="col-12 col-sm-6 my-0 p-2">
                                  <div class="form-group m-0">
                                    <p class="mb-1">
                                      <strong>Tipo Pessoa</strong>                                      
                                    </p>
                                  </div>                                
                                  <div class="input-group m-0">
                                    <select 
                                      class="form-select" 
                                      name="persontype" 
                                      id="persontype" 
                                      disabled
                                    >                                      
                                      <option value="" <?php echo ( $profileDetails['data'][0]['tipo_pessoa'] == "" ? "selected" : "" ) ; ?>>Tipo Pessoa</option>
                                      <option value="F" <?php echo ( $profileDetails['data'][0]['tipo_pessoa'] == "F" ? "selected" : "" ) ; ?>>Física</option>
                                      <option value="J" <?php echo ( $profileDetails['data'][0]['tipo_pessoa'] == "J" ? "selected" : "" ) ; ?>>Jurídica</option>
                                    </select>
                                    <button class="btn btn-outline-danger" type="button" name="edit-PersonType" id="edit-PersonType">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-pen" viewBox="0 0 16 16">
                                          <path d="m13.498.795.149-.149a1.207 1.207 0 1 1 1.707 1.708l-.149.148a1.5 1.5 0 0 1-.059 2.059L4.854 14.854a.5.5 0 0 1-.233.131l-4 1a.5.5 0 0 1-.606-.606l1-4a.5.5 0 0 1 .131-.232l9.642-9.642a.5.5 0 0 0-.642.056L6.854 4.854a.5.5 0 1 1-.708-.708L9.44.854A1.5 1.5 0 0 1 11.5.796a1.5 1.5 0 0 1 1.998-.001zm-.644.766a.5.5 0 0 0-.707 0L1.95 11.756l-.764 3.057 3.057-.764L14.44 3.854a.5.5 0 0 0 0-.708l-1.585-1.585z"/>
                                        </svg>
                                    </button>                                  
                                  </div>
                                </div>
                                
                              </div>

                            </div>

                            <!-- Submit Error Message -->
                            <div class="col-12 text-center my-2 mx-0">
                              <span id="msgAlertErroUpdate" class="d-flex justify-content-center"></span>
                            </div>

                            <!-- Submit Button -->
                            <div class="row">
                              <div class="col-12 d-flex justify-content-center m-0 p-0">
                                <input class="btn btn-default p-2" type="submit" value="Atualizar Informações" name="profileUpdateSubimit" id="profileUpdateSubimit">
                                <!-- <input class="btn btn-default btn-block btn-adm mx-2 col-3" type="reset" value="Limpar" id="limpar"> -->
                              </div>
                            </div>

                          </form>
                        </article>
                      </div>

                      <!-- Self User Trade Posts -->
                      <div class="tab-pane fade <?php echo $defaultContent == "trade_posts" ? "show active" : "" ; ?>" id="anuncios" role="tabpanel" aria-labelledby="anuncios-tab">                    
                        <div class="row mt-5">
                          <div class="col-12 text-center p-0">
                            <h3 class="text-red"><strong>Meus Anúncios</strong></h3>
                          </div>
                        </div>

                        <div class="row">
                          <div class="col-12 mt-0 mb-4 p-4 ">
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
                                <div class="row my-3 mx-2 p-2 ">
                                                                      
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

                      <!-- Configurações Conta -->
                      <div class="tab-pane fade <?php echo $defaultContent == "config" ? "show active" : "" ; ?>" id="configuration" role="tabpanel" aria-labelledby="configuration-tab">
                        
                        <div class="row mt-5">
                          <div class="col-12 text-center p-0">
                            <h3 class="text-red"><strong>Suas Configurações</strong></h3>
                          </div>
                        </div>

                        <div class="row mt-5 mx-3 my-5">
                          <div class="col-12">
                            <form class="size-18">
                              <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckChecked" checked>
                                <label class="form-check-label" for="flexSwitchCheckChecked">Perfil Público (Visível a todos os Outros Usuários)</label>
                              </div>
                              <!-- <button type="submit" class="btn btn-primary">Submit</button> -->
                            </form>
                          </div>
                          <div class="col-12 d-flex justify-content-center">
                            <div class="m-3 mt-5">
                              <input class="btn btn-primary" type="button" value="Desativar Minha Conta">
                            </div>
                            <div class="m-3 mt-5">
                              <input class="btn btn-danger" type="button" value="Excluir Minha Conta">
                            </div>
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
                <?php if ( isset($profileDetails['data'][0]['image_name']) && $profileDetails['data'][0]['image_name'] != null && validateImageSource($profileDetails['data'][0]['image_name']) ): ?>
                  <img src="<?php echo $profileDetails['data'][0]['image_name'] ; ?>" class="img-fluid rounded-circle" alt="" style="max-width:100%;width:300px;height:300px;object-fit:cover;">
                <?php else: ?>
                  <img src="<?php echo SITE_URL ?>/images/icons/default-profile-img.png" class="img-fluid rounded-circle" alt="" style="max-width:100%;width:300px;height:300px;object-fit:cover;">
                <?php endif; ?>

                
                <div class="mt-4">
                  <h3><strong><?php echo $profileDetails['data'][0]['user_name'] ?></strong></h3>
                  <h4 style="font-weight: bold;"><?php echo ($age > 100 ? "Idade: não informado" : $age . " Anos"); ?> </h4>
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
                            <h3 class="text-red"><strong>Mais Sobre <?php echo $profileDetails['data'][0]['user_name'] ?></strong></h3>
                          </div>
                        </div>

                        <div class="row mx-1">
                          <!-- Main Info -->
                          <div class="col-12 col-sm-6">
                            <div class="text-center mb-5">
                              <h4 class="text-red">Informações Artísticas</h4>
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
                            <div class="row mb-3">
                              <div class="col-12 m-0">
                                <h5 class="text-red mt-4"><strong>Biografia</strong></h5>
                              </div>
                              <div class="col-12 m-0" style="text-align:justify;">
                                <p class="size-16">
                                  <?php echo (isset($profileDetails['data'][0]['bio']) ? $profileDetails['data'][0]['bio'] : "Não Informado") ; ?>
                                </p>
                              </div>
                            </div>

                          </div>          

                          <!-- Other Infos -->
                          <div class="col-12 col-sm-6 mb-5">                            
                            <div class="text-center mb-5">
                              <h4 class="text-red">Outras Informações</h4>
                            </div>                            

                            <!-- Nome -->
                            <div class="form-group text-white mt-3">
                              <p class="mb-2">
                                <strong>Nome do Usuário</strong>
                                <?php echo (isset($profileDetails['data'][0]['user_name']) && !empty($profileDetails['data'][0]['user_name']) ? $profileDetails['data'][0]['user_name'] : "Não Informado") ?>
                              </p>
                            </div>

                            <!-- E-mail -->
                            <div class="form-group text-white mt-3">
                              <p class="mb-2">
                                <strong>E-mail</strong>
                                <?php echo (isset($profileDetails['data'][0]['email']) && !empty($profileDetails['data'][0]['email']) ? $profileDetails['data'][0]['email'] : "Não Informado") ?>
                              </p>
                            </div>

                            <!-- Tipo Pessoa -->
                            <div class="form-group text-white mt-3">
                              <p class="mb-2">
                                <strong>Tipo Pessoa</strong>
                                <?php 
                                  if ( isset($profileDetails['data'][0]['tipo_pessoa']) && !empty($profileDetails['data'][0]['tipo_pessoa']) ):
                                    echo $profileDetails['data'][0]['tipo_pessoa'] == 'F' ? "Física" : "Jurídica";
                                  endif;
                                ?>                                    
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
                            <h3 class="text-red"><strong>Anúncios de <?php echo $profileDetails['data'][0]['user_name'] ?></strong></h3>
                          </div>
                        </div>

                        <div class="row">
                          <div class="col-12 mt-0 mb-4 p-4 ">
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
                                <div class="row my-3 mx-2 p-2 ">
                                
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
    <script src="<?php echo SITE_URL ?>/js/jquery/jquery-3.6.0.js"></script>

    <script src="<?php echo SITE_URL ?>/js/bootstrap.bundle.js"></script>

    <script src="<?php echo SITE_URL ?>/js/main.js"></script>
    <script src="<?php echo SITE_URL ?>/js/profile.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.15/jquery.mask.min.js"></script> <!-- jQuery - Máscara para Inputs -->
    
  </body>

</html>