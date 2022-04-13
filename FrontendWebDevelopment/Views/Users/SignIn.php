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
    <link rel="stylesheet" href="<?php echo SITE_URL ?>/css/bootstrap/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo SITE_URL ?>/css/style.css">
    
    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="<?php echo SITE_URL ?>/images/icon.png">    

  </head>
  
  <!-- <body>
    <div class="loader-wrapper">
      <span class="loader"><span class="loader-inner"></span></span>
    </div>
  <body> -->
  
  <body class="d-flex flex-column h-100 bk-preto font-main">
    
    <!-- Header Include -->
    <?php include SITE_PATH .'/includes/header.php';?>

    <!-- Loading Icon -->
    <div class='spinner-wrapper'>
      <div class="spinner"></div>
    </div>

    <!-- Begin page content -->
    <main>
      <div class="container">
        
      <?php if (isset($_SESSION['user_id']) && isset($_SESSION['user_name']) && isset($_SESSION['user_email']) ): ?>
        <div class="text-center mt-5">
          <div class="row">
              <h3 class="text-white">Bem vindo(a), <?php echo $_SESSION['user_name'] ?>!</h3>
          </div>
                  
          <div class="row mt-5">
              <h6 class="text-white">Clique <a class='text-blue-link' href='<?php echo SITE_URL ?>/Views/homepage/index.php'><strong>aqui</strong></a> para começar!</h6>
          </div>
        </div>
      <?php else:  ?>
        <!-- Title -->
        <div class="text-center mt-4">
          <h2 class="text-white">Faça seu Login</h2>
        </div>

        <!-- Form -->
        <div class="form-default">            
          <form id="singIn-form">
            <span id="msgAlertErroLogin"></span>
            <div class="form-floating">
              <input type="email" class="form-control" placeholder="name@example.com" id="userEmail" name="email">
              <label for="userEmail">E-mail</label>
            </div>

            <div class="form-floating">
              <input type="password" class="form-control" placeholder="Senha" id="userPassword" name="password">
              <label for="userPassword">Senha</label>
            </div>

            <div class="text-center mt-5">
              <input class="btn-default btn" type="submit" value="Ir!" name="signIn" id="signIn-btn">
            </div>

            <div class="mt-5 text-white text-center">
              <span>Não possui conta?
                <a href="<?php echo SITE_URL ?>/Views/users/SignUp.php">Cadastre-se aqui</a>
              </span>
            </div>
          </form>
        </div>
      <?php endif; ?>
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