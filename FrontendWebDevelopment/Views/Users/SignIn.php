<?php
/**
 * File DOC
 * 
 * @Description SingIn Page to users do their login
 * @ChangeLog 
 *  - Vinícius Lessa - 28/03/2022: Creation of the header documentation. Beggining the creation of this page both FrontEnd and BackEnd.
 * 
 * @ Notes: 
 * 
 */
  
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
    <meta name="author" content="Vinícius Lessa / Iuri Ferreira">
    <meta name="description" content="Página de criação de cadastro por parte do usuário do sistema.">
    <title> <?php echo $titlePage; ?> </title>
    
    <!-- StyleSheet -->
    <link rel="stylesheet" href="<?php echo SITE_URL ?>/css/bootstrap/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo SITE_URL ?>/css/style.css">
    
    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="<?php echo SITE_URL ?>/images/icon.png"> 

    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="<?php echo SITE_URL ?>/js/bootstrap.bundle.min.js"></script>
  </head>

  <body class="d-flex flex-column h-100 bk-preto font-main">

    <!-- Header Include -->
    <?php include SITE_PATH .'/includes/header.php';?>


    <!-- Begin page content -->
    <main>
      <div class="container">
        
        <!-- Title -->
        <div class="text-center">
          <h2 class="text-white">Faça seu Login</h2>
        </div>

        <!-- Form -->
        <div class="form-default ">
          <!-- <form id="singUp-form" action='<?php echo SITE_URL ?>/Controllers/c_user.php' method="post"> -->
          <form id="singUp-form" action='#' method="post">

            <div class="form-floating">
              <input type="email" class="form-control" placeholder="name@example.com" id="userEmail" name="email">
              <label for="userEmail">E-mail</label>
            </div>

            <div>
              <small class="text-lightred" id='emailAlert'>*campo obrigatório</small>
            </div>

            <div class="form-floating">
              <input type="password" class="form-control" placeholder="Senha" id="userPassword" name="password">
              <label for="userPassword">Senha</label>
            </div>

            <div>
              <small class="text-lightred" id='passwordAlert'>*campo obrigatório</small>
            </div>             

            <div class="text-center mt-5">
              <input class="btn-default btn" type="button" value="Ir!" name="signIn" id="signIn-btn">
            </div>

            <div class="mt-5 text-white text-center">
              <span>Não possui conta?
                <a href="<?php echo SITE_URL ?>/Views/users/SignIn.php">Cadastre-se aqui</a>
              </span>
            </div>
          </form>
        </div>
      </div>
    </main>

    <!-- footer site -->
    <?php include SITE_PATH.'/includes/footer.php'; ?>
  </body>

  <!-- Scripts -->
  <script src="<?php echo SITE_URL ?>/js/main.js"></script>
</html>