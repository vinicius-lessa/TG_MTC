<?php
/**
 * File DOC
 * 
 * @Description SingUp Page to new users
 * @ChangeLog 
 *  - Vinícius Lessa - 28/03/2022: Creation of the header documentation. Last functional changes.
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

$isLoggedUser = (isset($_SESSION['user_id']) && isset($_SESSION['user_name']) && isset($_SESSION['user_email'])) ? true : false;

$titlePage = "MTC | Cadastro";

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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.2/font/bootstrap-icons.css"> <!-- Icons -->
    <link rel="stylesheet" href="<?php echo SITE_URL ?>/css/style.css">    
    
    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="<?php echo SITE_URL ?>/images/icon.png"> 
  </head>
    
  <!-- Loading Animation -->
  <div class='spinner-wrapper'>
    <div class="spinner"></div>
  </div>

  <body class="body-login bk-gray">
    <div class="container-fluid h-100">
      <div class="row h-100">
        <div class="col-md-6 d-flex justify-content-center align-items-center">

          <!-- Logged -->
          <?php if ( $isLoggedUser ): ?>
            <div class="text-center mt-5">
              <div class="row">
                <div class="col-12">
                  <h3 class="text-white">Bem vindo(a), <?php echo $_SESSION['user_name'] ?>!</h3> 
                </div>
                <div class="col-12">
                  <a href='<?php echo SITE_URL ?>/Views/homepage/index.php'><buttom class="text-white btn-default btn btn-danger border-0 mt-3">Clique aqui para começar!</buttom></a>
                </div>
              </div>
            </div>        

          <!-- Unlogged -->
          <?php else:  ?>        
            <div class="form-default">
              <form id="singUp-form">

                <div class="text-center">
                  <a href="<?php echo SITE_URL ?>/Views/homepage/index.php" class="d-flex align-items-center mb-md-0 me-md-auto text-dark text-decoration-none">
                  <img src="<?php echo SITE_URL ?>/images/icon.png" alt="ícone MTC" width="75" height="75">
                </a>
                </div>
              
                <h3 class="text-white"><strong>Criar Conta</strong></h3>
                <p class="text-white" style="font-size:14px;">Faça seu cadastro de forma rápida e gratuíta!</p>
                
                <div class="form-floating">
                  <input type="text" class="form-control" placeholder="Nome" id="userName" name="username">
                  <label for="userName">Nome</label>
                </div>

                <div class="form-floating">
                  <input type="email" class="form-control" placeholder="name@example.com" id="userEmail" name="email">
                  <label for="userEmail">E-mail</label>
                </div>

                <div class="input-group">
                  <div class="form-floating flex-grow-1 m-0">
                    <input type="password" class="form-control" placeholder="Senha" id="userPassword" name="password">
                    <label for="userPassword">Senha</label>
                  </div>
                  <button class="btn btn-danger" type="button" onclick="password_show_hide();">
                      <!-- Hide Eye -->
                      <i class="bi bi-eye-slash-fill" id="showEye"></i>
                      <!-- Show Eye -->
                      <i class="bi bi-eye-fill d-none" id="hideEye"></i>
                    </button>                  
                </div>

                <div class="form-floating">
                  <select class="form-select pt-3 pb-3" name="persontype" id="userType">
                    <option selected>Tipo Pessoa</option>
                    <option value="F">Física</option>
                    <option value="J">Jurídica</option>
                  </select>
                </div>

                <div class="text-center text-white mt-2">
                  <h5><strong>Outras Informações</strong></h5>
                </div>              

                <div class="form-floating">
                  <input type="date" class="form-control" placeholder="01/10/2000" id="userBirthday" name="birthday">
                  <label for="userBirthday">Data Nascimento</label>
                </div>

                <div class="form-floating">
                  <input type="tel" class="form-control phone_with_ddd" placeholder="(11)XXXX-XXXX" id="userPhone" name="phone">
                  <label for="userPhone">Telefone/Celular</label>
                </div>

                <div class="form-floating">
                  <input type="text" class="form-control cep" placeholder="18100-000" id="userZipCode" name="cep">
                  <label for="userZipCode">CEP</label>
                </div>
                
                <span id="msgAlertErroSignUp"></span>

                <div class="text-center mt-5">
                  <input class="btn-default btn btn-danger border-0" type="submit" value="CRIAR!" name="signUp" id="signUp-btn">
                </div>

                <div class="mt-5 text-white text-center">
                  <span>Já possuí conta?
                    <a href="<?php echo SITE_URL ?>/Views/users/sign_in.php">Entrar</a>
                  </span>
                </div>
              </form>
            </div>          
          <?php endif; ?>
          
        </div>

        <!-- IMAGEM RIGHT -->
        <div class="col-md-6 d-none d-sm-flex justify-content-center align-items-center banner-login">
        </div>
      
      </div>
    
    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script src="<?php echo SITE_URL ?>/js/bootstrap.bundle.js"></script>

    <script src="<?php echo SITE_URL ?>/js/main.js"></script>
    <script src="<?php echo SITE_URL ?>/js/signup.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.15/jquery.mask.min.js"></script> <!-- jQuery - Máscara para Inputs -->

  </body>

</html>