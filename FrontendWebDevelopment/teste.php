<?php
if (!defined('SITE_URL')) {
    include_once 'config.php';
}
  
?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- StyleSheet -->
    <link rel="stylesheet" href="<?php echo SITE_URL ?>/css/bootstrap/bootstrap.css"> <!-- Bootstrap 5 -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.2/font/bootstrap-icons.css"> <!-- Icons -->
    <link rel="stylesheet" href="<?php echo SITE_URL ?>/css/style.css">
    <link rel="stylesheet" href="<?php echo SITE_URL ?>/css/csstest.css">
    
    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="<?php echo SITE_URL ?>/images/icon.png">

    <title>Página de TESTE</title>
  </head>

  <body class="d-flex flex-column h-100 bk-black font-main" class="" style="height: 1000px;">

    <div class="container bk-white" style="min-height: 1000px;">
        <main class="">
            <div class="row d-flex justify-content-center">
                <div class="col-12 p-2">

                    <!-- Incluir Teste Aqui -->                    
                    <div class="images">
                        <img src="https://www.w3schools.com/howto/img_fjords.jpg" alt="" width="300" height="200">
                        <img src="https://www.w3schools.com/howto/img_fjords.jpg" alt="" width="300" height="200">
                        <img src="https://www.w3schools.com/howto/img_fjords.jpg" alt="" width="300" height="200">
                    </div>

                    <div id="image-viewer">
                        <span class="close">&times;</span>
                        <img class="modal-content" id="full-image">
                    </div>
                    
                </div>
            </div>
        </main>
    </div>
    
    <!-- Scripts -->    
    <script src="<?php echo SITE_URL ?>/js/jquery/jquery-3.6.0.js"></script>

    <script src="<?php echo SITE_URL ?>/js/bootstrap.bundle.js"></script>

    <script src="<?php echo SITE_URL ?>/js/jstest.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.15/jquery.mask.min.js"></script> <!-- jQuery - Máscara para Inputs -->
    
  </body>
</html>