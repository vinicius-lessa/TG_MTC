<?php
/**
 * File DOC
 * 
 * @Description Página de criação de cadastro por parte do usuário do sistema.
 * @ChangeLog 
 *  - Renata Carrillo - 12/04/2022: Padronização do <head> e $titlePage;
 *  - Renata Carrillo - 21/04/2022: Ajuste no Card: ENCONTRE ARTISTAS pós mudança no Bootstrap.
 * 
 * @ Notes: 
 * 
 */
if (!defined('SITE_URL')) {
  include_once '../../config.php';
}

if (session_status() === PHP_SESSION_NONE) {
  session_start();
}

$titlePage  = 'MTC | Music Trade Center';
$a_tpList   = [];

require SITE_PATH . '/Controllers/c_trade_posts.php';

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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css"> <!-- Icons -->
    <link rel="stylesheet" href="<?php echo SITE_URL ?>/css/style.css">
    
    
    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="<?php echo SITE_URL ?>/images/icon.png">
  </head>

  <body class="d-flex flex-column h-100 bk-black font-main">
    
    <!-- Header Include -->
    <?php include SITE_PATH . '/includes/header.php'; ?>
    
    <!-- Begin page content -->
    <main>
      <div class="container mb-5">
        <div class="row">
          <div class="col-12 col-sm-6 mt-5">
            <h1 class="text-white"><strong>MUSIC TRADE CENTER</strong></h1>
          </div>
          <hr></hr>
        </div>

        <div class="input-group">
          <div class="form-outline col-10 col-sm-6">
            <input id="search-input" type="search" id="form1" class="form-control" />
          </div>
            <button id="search-button" type="button" class="btn btn-default">
              <i class="bi bi-search"></i>
          </button>
        </div>

      </div>
    </main>

<!-- MÚSICOS -->
<div class="container mb-5">
  <div class="row">

  <div class="col-6 col-sm-3 mt-3">
    <a href="<?php echo SITE_URL ?>/Views/users/user_profile.php">
      <img src="<?php echo SITE_URL ?>/images/IMAGENS/ARTISTAS/ARTISTA01.jpg" class="img-fluid rounded" alt="" style="width:100%;height:250px;object-fit:cover;">
    </a>
    </div>
    <div class="col-6 col-sm-3 mt-3 bk-gray">
      <div class="card-body text-white" style="font-size:14px;">
      <p class="card-title text-white mt-2" style="text-align:left;"><strong><?php echo $_SESSION['user_name'] ?></strong></p>
      <p class="card-title" style="text-align:left;"><strong class="text-red">Genêro(s): </strong>Rock, Pop</p>
      <p class="card-title" style="text-align:left;"><strong class="text-red">Habilidades: </strong>Violão / Bateria / Guitarra</p>
      <p class="card-title" style="text-align:left;"><strong class="text-red">Cidade: </strong>São Roque - SP</p>
      <p class="card-title" style="text-align:left;"><strong class="text-red">Idade: </strong>23 anos</p>
    </div>
  </div>

  <div class="col-6 col-sm-3 mt-3">
    <a href="<?php echo SITE_URL ?>/Views/users/user_profile.php">
      <img src="<?php echo SITE_URL ?>/images/IMAGENS/ARTISTAS/ARTISTA3.jpg" class="img-fluid rounded" alt="" style="width:100%;height:250px;object-fit:cover;">
    </a>
    </div>
    <div class="col-6 col-sm-3 mt-3 bk-gray">
      <div class="card-body text-white" style="font-size:14px;">
      <p class="card-title text-white mt-2" style="text-align:left;"><strong><?php /*echo $_SESSION['user_name'] */?>NOME</strong></p>
      <p class="card-title" style="text-align:left;"><strong class="text-red">Genêro(s): </strong>Rock, Pop</p>
      <p class="card-title" style="text-align:left;"><strong class="text-red">Habilidades: </strong>Violão / Bateria / Guitarra</p>
      <p class="card-title" style="text-align:left;"><strong class="text-red">Cidade: </strong>São Roque - SP</p>
      <p class="card-title" style="text-align:left;"><strong class="text-red">Idade: </strong>23 anos</p>
    </div>
  </div>

  <div class="col-6 col-sm-3 mt-3">
    <a href="<?php echo SITE_URL ?>/Views/users/user_profile.php">
      <img src="<?php echo SITE_URL ?>/images/IMAGENS/ARTISTAS/ARTISTAMEN02.jpg" class="img-fluid rounded" alt="" style="width:100%;height:250px;object-fit:cover;">
    </a>
    </div>
    <div class="col-6 col-sm-3 mt-3 bk-gray">
      <div class="card-body text-white" style="font-size:14px;">
      <p class="card-title text-white mt-2" style="text-align:left;"><strong><?php /*echo $_SESSION['user_name'] */?>NOME</strong></p>
      <p class="card-title" style="text-align:left;"><strong class="text-red">Genêro(s): </strong>Rock, Pop</p>
      <p class="card-title" style="text-align:left;"><strong class="text-red">Habilidades: </strong>Violão / Bateria / Guitarra</p>
      <p class="card-title" style="text-align:left;"><strong class="text-red">Cidade: </strong>São Roque - SP</p>
      <p class="card-title" style="text-align:left;"><strong class="text-red">Idade: </strong>23 anos</p>
    </div>
  </div>

  <div class="col-6 col-sm-3 mt-3">
    <a href="<?php echo SITE_URL ?>/Views/users/user_profile.php">
      <img src="<?php echo SITE_URL ?>/images/IMAGENS/ARTISTAS/ARTISTAWOMEN04.jpg" class="img-fluid rounded" alt="" style="width:100%;height:250px;object-fit:cover;">
    </a>
    </div>
    <div class="col-6 col-sm-3 mt-3 bk-gray">
      <div class="card-body text-white" style="font-size:14px;">
      <p class="card-title text-white mt-2" style="text-align:left;"><strong><?php /*echo $_SESSION['user_name'] */?>NOME</strong></p>
      <p class="card-title" style="text-align:left;"><strong class="text-red">Genêro(s): </strong>Rock, Pop</p>
      <p class="card-title" style="text-align:left;"><strong class="text-red">Habilidades: </strong>Violão / Bateria / Guitarra</p>
      <p class="card-title" style="text-align:left;"><strong class="text-red">Cidade: </strong>São Roque - SP</p>
      <p class="card-title" style="text-align:left;"><strong class="text-red">Idade: </strong>23 anos</p>
    </div>
  </div>

  </div>
</div>


    <!-- ENCONTRE ARTISTAS -->
    <div class="container bk-gray col-12 col-sm-8 text-white" style="border-style:solid;border-color:gray;">
        <div class="row mt-3 mb-3">
          <div class="col-12 col-sm-8">
            <h3 class="mt-2 ms-4"><strong>Encontre artistas de diversos genêros</strong></h3>
            <p class="ms-4">Você tem a possibilidade de divulgar o seu trabalho, e encontrar artistas próximos.</p>
          </div>
          <div class="col-12 col-sm-4 mt-1">
            <a class="text-white ms-4" style="font-size:14px;" href="../produtos/MusicTradeCenter.php"><button type="button" class="btn btn-default btn-lg border-0 mt-3"><strong>VER MAIS</strong></button></a>  
          </div>
        </div>
      </div>

    <!-- Footer Include -->
    <?php include SITE_PATH . '/includes/footer.php'; ?>    
  
    <!-- Scripts -->    
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="<?php echo SITE_URL ?>/js/bootstrap.bundle.min.js"></script>
    <script src="<?php echo SITE_URL ?>/js/main.js"></script>
    
    
  </body>

</html>