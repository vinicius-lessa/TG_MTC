<?php
    if (!defined('SITE_URL')) {
      include_once '../../config.php';      
    }

    // header("location:". SITE_URL .  "/Views/users/SignIn.php");

    $titlePage = "MTC | Sucesso";
?>

<!DOCTYPE html>
<html lang="pt-br" class="h-100">
  <head>
    <meta charset='utf-8'>    
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>

    <!-- Page Data -->
    <meta name="author" content="Vinícius Lessa / Iuri Ferreira">
    <meta name="description" content="Página exibida após a criação de conta pelo usuário caso o processo FALHE">
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

    <main>
        <div class="container">
                        
            <div class="text-center">
                <div class="row">
                    <h2 class="text-white">Puxa, tivemos um problema na criação de seu Usuário :(</h2>
                </div>

                <div class="row mt-3">
                    <p class="text-lightgray">Erro: <? echo $_GET["error"]?> <p>
                </div>
                        
                <div class="row mt-5">
                    <h6 class="text-white">Clique <a class='text-blue-link' href='<?php echo SITE_URL ?>/Views/users/SignUp.php'><strong>aqui</strong></a> para tentar novamente</h6>
                </div>
            </div>
        </div>
    </main>
  </body>
</html>