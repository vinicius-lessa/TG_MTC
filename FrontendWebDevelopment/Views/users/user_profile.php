<?php
/**
 * File DOC
 * 
 * @Description SingIn Page to users do their login
 * @ChangeLog 
 *  - Renata Carrillo - 12/04/2022: Padronização do <head>.
 *  - Vinícius Lessa - 13/04/2022: Correções mínimas de session.
 * @ Notes: 
 * 
 */

if (session_status() === PHP_SESSION_NONE) {
  session_start();
}

if (!defined('SITE_URL')) {
  include_once '../../config.php';      
}

$profileID = $_GET['user_id'];

$isLoggedUser = (isset($_SESSION['user_id']) && isset($_SESSION['user_name']) && isset($_SESSION['user_email'])) ? true : false;

$titlePage = "MTC | Meu Perfil";

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
    <link rel="stylesheet" href="<?php echo SITE_URL ?>/css/bootstrap/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo SITE_URL ?>/css/style.css">
    
    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="<?php echo SITE_URL ?>/images/icon.png">
  </head>

  <body class="d-flex flex-column h-100 bk-preto font-main">

    <!-- Header Include -->
    <?php include SITE_PATH .'/includes/header.php';?>

    <main>
      <div class="container">
        <?php
          if ( $isLoggedUser && (!isset($profileID)) ):
        ?>          
          <!-- Page Title -->
          <div class="container">
            <div class="row">
              <div class="col-12 col-sm-6 mt-5">
                <h1 class="text-white"><strong>Seu Perfil</strong></h1>
              </div>
              <hr></hr>
            </div>
          </div>

          <!-- Profile Header -->
          <div class="container bk-left text-white rounded">
            <div class="row">
              <div class="col-2"></div>
              <div class="col-8 mt-3 mb-3 text-center">
                <img src="<?php echo SITE_URL ?>/images/IMAGENS/ARTISTAS/ARTISTA3.jpg" class="img-fluid rounded-circle" alt="" style="max-width:100%;width:200px;height:200px;object-fit:cover;">
                <div class="form-group mb-3 mt-2" style="width:90px;">
                  <label class="mb-2" for="image-upload" style="font-size:12px;">Alterar Imagem</label>
                  <input class="form-control" type="file" name="image-upload" id="image-upload" style="font-size:14px;">
                </div>
                <h5><strong><?php echo $_SESSION['user_name'] ?></strong></h5>
                <h6>23 anos</h6>
              </div>
              <div class="col-2"></div>
            </div>
          </div>

          <!-- User Info -->
          <div class="container bk-left mt-3 mb-5 rounded">
            <div class="row">
              <div class="col-12 mt-3 mb-3 text-center">
                <h5 class="text-red"><strong>Meus Dados</strong></h5>              
              </div>
            </div>

            <div class="row bk-left" style="margin-left:15px;">
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
                <div class="form-group">
                  <textarea class="form-control" type="text" name="description" id="description" rows="3"></textarea>
                </div>
                <p class="text-white mt-2" style="font-size:14px;">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent 
                  eu facilisis orci, cursus luctus arcu. Vivamus venenatis ultrices vem
                  enatis. Sed consectetur at tellus id placerat. Vestibulum ante ipsu
                  primis in faucibus orci luctus et ultrices posuere cubilia curae.
                </p>            
              </div>          

              <!-- OUTRAS INFORMAÇÕES -->
              <div class="col-6 text-white">
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
                    <option value="3">São Roque</option>
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
                      <option value="3">Rio de Janeiro</option>
                      <?php foreach ($selectBrand as $itemBrand) {?>
                        <option value="<?php echo $itemBrand['brand_id'] ?>"><?php echo $itemBrand['description'] ?></option>
                      <?php };?>
                    </select>
                </div>

                <!-- DATA DE NASCIMENTO -->
                <div class="form-group mt-3">
                  <label class="mb-2" for="brand"><strong>Data de Nascimento:</strong></label>
                    <select class="form-select" name="brand" id="brand">
                      <option selected>Escolha...</option>
                      <option value="1">São Paulo</option>
                      <option value="3">São Roque</option>
                      <?php foreach ($selectBrand as $itemBrand) {?>
                        <option value="<?php echo $itemBrand['brand_id'] ?>"><?php echo $itemBrand['description'] ?></option>
                      <?php };?>                  
                    </select>
                </div>

                <!-- E-MAIL -->
                <div class="form-group text-white mt-3">
                  <label for="userEmail"><strong>E-mail:</strong></label>
                  <input type="email" class="form-control" placeholder="name@example.com" id="userEmail" name="email">
                </div>

                <h6 class="text-red mt-5"><strong>Experiência</strong></h6>

                <!-- BIOGRAFIA -->
                  <div class="form-group">
                    <textarea class="form-control" type="text" name="description" id="description" rows="3"></textarea>
                  </div>
                  <p class="text-white mt-2" style="font-size:14px;">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent
                    eu facilisis orci, cursus luctus arcu. Vivamus venenatis ultrices vem
                    enatis. Sed consectetur at tellus id placerat. Vestibulum ante ipsu
                    primis in faucibus orci luctus et ultrices posuere cubilia curae.
                  </p>
              </div>
            </div>
          </div>          
        <?php 
          else:
            if (!isset($profileID)):
              header("location:" . SITE_URL . "/Views/user/sign_in.php");
            else:
        ?>
        <!-- Page Title -->
        <div class="container">
          <div class="row">
            <div class="col-12 col-sm-6 mt-5">
              <h1 class="text-white"><strong>Seu Perfil</strong></h1>
            </div>
            <hr></hr>
          </div>
        </div>
        
        <!-- Profile Header -->
        <div class="container bk-left text-white rounded">
          <div class="row">
            <div class="col-2"></div>
            <div class="col-8 mt-3 mb-3 text-center">
              <img src="<?php echo SITE_URL ?>/images/IMAGENS/ARTISTAS/ARTISTA3.jpg" class="img-fluid rounded-circle" alt="" style="max-width:100%;width:200px;height:200px;object-fit:cover;">
              <!-- <div class="form-group mb-3 mt-2" style="width:90px;">
                <label class="mb-2" for="image-upload" style="font-size:12px;">Alterar Imagem</label>
                <input class="form-control" type="file" name="image-upload" id="image-upload" style="font-size:14px;">
              </div> -->
              <h5><strong>Vinicius Lessa</strong></h5>
              <h6>23 anos</h6>
            </div>
            <div class="col-2"></div>
          </div>
        </div>

        <!-- User Info -->
        <div class="container bk-left mt-3 mb-5 rounded">
          <div class="row">
            <div class="col-12 mt-3 mb-3 text-center">
              <h5 class="text-red"><strong>Meus Dados</strong></h5>              
            </div>
          </div>

          <div class="row bk-left" style="margin-left:15px;">
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
              <p class="text-white mt-2" style="font-size:14px;">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent 
                eu facilisis orci, cursus luctus arcu. Vivamus venenatis ultrices vem
                enatis. Sed consectetur at tellus id placerat. Vestibulum ante ipsu
                primis in faucibus orci luctus et ultrices posuere cubilia curae.
              </p>            
            </div>          

            <!-- OUTRAS INFORMAÇÕES -->
            <div class="col-6 text-white">
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
                <!-- <input type="email" class="form-control" placeholder="name@example.com" id="userEmail" name="email"> -->
              </div>

              <h6 class="text-red mt-5"><strong>Experiência</strong></h6>

              <!-- BIOGRAFIA -->
                <div class="form-group">
                  <!-- <textarea class="form-control" type="text" name="description" id="description" rows="3"></textarea> -->
                </div>
                <p class="text-white mt-2" style="font-size:14px;">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent
                  eu facilisis orci, cursus luctus arcu. Vivamus venenatis ultrices vem
                  enatis. Sed consectetur at tellus id placerat. Vestibulum ante ipsu
                  primis in faucibus orci luctus et ultrices posuere cubilia curae.
                </p>
            </div>
          </div>
        </div>
        <?php 
            endif;
          endif;
        ?>
      </div>
    </main>
    
    <!-- footer site -->
    <?php include SITE_PATH.'/includes/footer.php'; ?>

    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="<?php echo SITE_URL ?>/js/bootstrap.bundle.min.js"></script>
    <script src="<?php echo SITE_URL ?>/js/main.js"></script>
  </body>

</html>