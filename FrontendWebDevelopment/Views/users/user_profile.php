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
  
  // Calculates Age
  $birthday = date_create_from_format('Y-m-d', $profileDetails['data'][0]['birthday']);
  $now      = date_create_from_format('Y-m-d', date('Y-m-d'));
  $diff     = (array) date_diff($birthday, $now);
  $age      = $diff['y'];

endif;

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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">    

    <link rel="stylesheet" href="<?php echo SITE_URL ?>/css/style.css">
    
    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="<?php echo SITE_URL ?>/images/icon.png">
  </head>

  <body class="d-flex flex-column h-100 bk-black font-main">

    <!-- Header Include -->
    <?php include SITE_PATH .'/includes/header.php';?>

    <main>
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
        
      <!-- Não Logado -->
      <?php
        if ( $userState === 0 ):
        
          // Login necessário para acessar essa página
          header("location:" . SITE_URL . "/Views/users/sign_in.php");
      
        // Perfil Próprio        
        elseif ( $userState === 1 ):
      ?>

        <!-- Profile Header -->
        <div class="container bk-gray text-white rounded">
          <div class="row">
            <div class="col-2"></div>
            <div class="col-8 mt-3 mb-3 text-center p-2">
              <img src="<?php echo SITE_URL ?>/images/IMAGENS/ARTISTAS/ARTISTA3.jpg" class="img-fluid rounded-circle" alt="" style="max-width:100%;width:300px;height:300px;object-fit:cover;">
              <div class="form-group mb-3 mt-2" style="width:90px;">
                <label class="mb-2" for="image-upload" style="font-size:12px;">Alterar Imagem</label>
                <input class="form-control" type="file" name="image-upload" id="image-upload" style="font-size:14px;">
              </div>                              
              <div class="mt-4">
                <h5><strong><?php echo $_SESSION['user_name'] ?></strong></h5>
                <h6><?php echo ($age > 100 ? "Idade: não informado" : $age . "Anos"); ?> </h6>
              </div>                
            </div>
            <div class="col-2"></div>
          </div>
        </div>        

        <!-- Profile Info -->
        <div class="container bk-gray mt-3 mb-5 rounded">
          
          <!-- Testes de Multiple Tabs -->  
          <div class="row text-white">
            <div class="col-12 p-2">
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
                    
                    <!-- MEUS DADOS -->
                    <div class="tab-pane fade show active" id="dados" role="tabpanel" aria-labelledby="dados-tab">                                            
                      <div class="row">
                        <div class="col-12 mt-4 mb-4 text-center">
                          <h5 class="text-red"><strong>Meus Dados</strong></h5>
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

                    <!-- ANÚNCIOS -->
                    <div class="tab-pane fade" id="anuncios" role="tabpanel" aria-labelledby="anuncios-tab">
                      Anúncios
                    </div>

                    <!-- CONFIGURAÇÕES -->
                    <div class="tab-pane fade" id="configuration" role="tabpanel" aria-labelledby="configuration-tab">
                      Configurações
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
              <img src="<?php echo SITE_URL ?>/images/IMAGENS/ARTISTAS/ARTISTA3.jpg" class="img-fluid rounded-circle" alt="" style="max-width:100%;width:300px;height:300px;object-fit:cover;">
              <!-- <div class="form-group mb-3 mt-2" style="width:90px;">
                <label class="mb-2" for="image-upload" style="font-size:12px;">Alterar Imagem</label>
                <input class="form-control" type="file" name="image-upload" id="image-upload" style="font-size:14px;">
              </div> -->
              <div class="mt-4">
                <h5><strong><?php echo $profileDetails['data'][0]['user_name'] ?></strong></h5>
                <h6><?php echo $age ?> Anos</h6>
              </div>
            </div>
            <div class="col-2"></div>
          </div>
        </div>

        <!-- User Info -->
        <div class="container bk-gray mt-3 mb-5 rounded">
          <div class="row">
            <div class="col-12 mt-3 mt-4 mb-4 text-center">
              <h5 class="text-red"><strong>Mais Sobre <?php echo $profileDetails['data'][0]['user_name'] ?></strong></h5>              
            </div>
          </div>

          <div class="row bk-gray" style="margin-left:15px;">
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
                <!-- <div class="input-group-append">
                  <buttom class="input-group-text btn" type="button" for="inputGroupSelect02"><img src="<?php echo SITE_URL ?>/images/IMAGENS/ÍCONES/MAIS.png" class="img-fluid" alt="" width="25px" height="25px"></buttom>
                </div> -->
              </div>

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
      
      <!-- Erro Inesperado -->
      <?php 
        elseif ( $userState == null ):
          header("location:" . SITE_URL . "/Views/homepage/index.php");
        endif;
      ?>

      </div>
    </main>
    
    <!-- footer site -->
    <?php include SITE_PATH.'/includes/footer.php'; ?>

    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>    
    <!-- <script src="<?php echo SITE_URL ?>/js/bootstrap.bundle.min.js"></script> -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="<?php echo SITE_URL ?>/js/main.js"></script>
  </body>

</html>