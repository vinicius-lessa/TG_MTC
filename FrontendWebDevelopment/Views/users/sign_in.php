<?php
/**
 * File DOC
 * 
 * @Description SingIn Page to users login
 * @ChangeLog 
 *  - Vinícius Lessa - 28/03/2022: Creation of the header documentation. Beggining the creation of this page both FrontEnd and BackEnd.
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

$titlePage = "MTC | SignUp";

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
    <link rel="stylesheet" href="<?php echo SITE_URL ?>/css/style.css">
    
    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="<?php echo SITE_URL ?>/images/icon.png">    
  </head>

    <!-- Loading Icon -->
    <div class='spinner-wrapper'>
      <div class="spinner"></div>
    </div>

<body class="body-login bk-gray">
  <div class="container-fluid h-100">
  <div class="row h-100">
    <div class="col-md-6 d-flex justify-content-center align-items-center">

<!-- ATENÇÃO -->
    <?php if ( $isLoggedUser ): ?>
      <div class="text-center mt-5">
        <div class="row">
          <div class="col-12">
            <h3 class="text-white">Bem vindo(a), <?php echo $_SESSION['user_name'] ?>!</h3> 
          </div>
          <div class="col-12">
            <a class='' href='<?php echo SITE_URL ?>/Views/homepage/index.php'><buttom class="text-white btn-default btn btn-danger border-0 mt-3">Clique aqui para começar!</buttom></a>
          </div>
        </div>
      </div>
    </div>
    <?php else:  ?>
<!-- ATENÇÃO -->

    <!-- Form -->
    <div class="form-default">            
      <form id="singIn-form">
        <span id="msgAlertErroLogin"></span>
        
          <!-- ICON -->
          <div class="text-center">
          <a href="<?php echo SITE_URL ?>/Views/homepage/index.php" class="d-flex align-items-center mb-md-0 me-md-auto text-dark text-decoration-none">
            <img src="<?php echo SITE_URL ?>/images/icon.png" alt="ícone MTC" width="75" height="75">
          </a>
          </div>

          <h3 class="text-white"><strong>Faça seu Login</strong></h3>
          <p class="text-white" style="font-size:14px;">Edite seu perfill, publique seus produtos e negocie!</p>
          <div class="form-floating">
            <input type="email" class="form-control" placeholder="name@example.com" id="userEmail" name="email">
            <label for="userEmail">E-mail</label>
          </div>

          <div class="form-floating">
            <input type="password" class="form-control" placeholder="Senha" id="userPassword" name="password">
            <label for="userPassword">Senha</label>
          </div>

          <div class="text-center mt-5">
            <input class="btn-default btn btn-danger border-0" type="submit" value="ENTRAR" name="signIn" id="signIn-btn">
          </div>

          <div class="mt-5 text-white text-center">
            <span>Não possui conta?
              <a href="<?php echo SITE_URL ?>/Views/users/sign_up.php">Cadastre-se aqui</a>
            </span>
          </div>
      </form>
    </div>

    </div>
      <?php endif; ?>

      <!-- IMAGEM RIGHT -->
      <div class="col-md-6 d-none d-sm-flex justify-content-center align-items-center banner-login">
        <div></div>
      </div>

  <!-- </div> -->
  </div>

    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="<?php echo SITE_URL ?>/js/bootstrap.bundle.min.js"></script>
    <script src="<?php echo SITE_URL ?>/js/main.js"></script>
</body>

</html>