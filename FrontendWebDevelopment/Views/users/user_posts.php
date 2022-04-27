<?php
/**
 * File DOC
 * 
 * @Description Página que irá listar todos os anúncios do usuário (somente se logado)
 * @ChangeLog  
 *  - Vinícius Lessa - 16/04/2022: Criação do arquivo e inclusão da docuntação no cabeçalho do arquivo. Mudanças básicas não funcionais.
 * @ Notes: 
 * 
 */

if (session_status() === PHP_SESSION_NONE) {
  session_start();
}

if (!defined('SITE_URL')) {
  include_once '../../config.php';      
}

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
    <meta name="description" content="Página que irá listar todos os anúncios do usuário (somente se logado)">
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
        <div class="text-center">
            <div class="row">
                <h3 class="text-white">Meus Anúncios</h3>
            </div>
        </div>
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