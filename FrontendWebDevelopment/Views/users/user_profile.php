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
          <div class="text-center">
              <div class="row">
                  <h3 class="text-white"><?php echo $_SESSION['user_name'] ?></h3>
              </div>
              <div class="row">
                  <h5 class="text-white">Meu Pefil</h5>
              </div>
          </div>
        <?php 
          else:
            if (!isset($profileID)):
              header("location:" . SITE_URL . "/Views/user/sign_in.php");
            else:
        ?>
          <div class="text-center">
          <div class="row">
                  <h3 class="text-white">Usuário #<?php echo $profileID ?></h3>
              </div>
              <div class="row">
                  <h5 class="text-white">Pefil Público</h5>
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