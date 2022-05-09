<?php
/**
 * File DOC
 * 
 * @Description Página de criação de cadastro por parte do usuário do sistema.
 * @ChangeLog 
 *  - Renata Carrillo - 12/04/2022: Padronização do <head> e $titlePage;
 *  - Renata Carrillo - 21/04/2022: Ajuste no Card: ENCONTRE ARTISTAS pós mudança no Bootstrap.
 *  - Vinícius Lessa - 28/04/2022: Início da Implementação Funcional da busca por usuários existentes no Banco de Dados.
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

$a_Users   = []; // Chamado em 'c_users.php'
require SITE_PATH . '/Controllers/c_user.php';

if ( $a_Users['error'] ):
  $usersSearchError = true;

else:
  $count = 0;
  // Calculates Age
  foreach ($a_Users["data"] as $user) {
    $birthday = date_create_from_format('Y-m-d', $user['birthday']);
    $now      = date_create_from_format('Y-m-d', date('Y-m-d'));
    $diff     = (array) date_diff($birthday, $now);

    $a_Users["data"][$count]["age"]  = $diff['y'];
    
    $count += 1;    
  }

  // print_r($a_Users);

endif;

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
    <!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">--> <!-- Icons -->
    <link rel="stylesheet" href="<?php echo SITE_URL ?>/css/bootstrap/bootstrap.css"> <!-- Get Bootstrap -->        
    <link rel="stylesheet" href="<?php echo SITE_URL ?>/css/style.css">
    
    
    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="<?php echo SITE_URL ?>/images/icon.png">
  </head>

  <body class="d-flex flex-column h-100 bk-black font-main">
    
    <!-- Header Include -->
    <?php include SITE_PATH . '/includes/header.php'; ?>
    
    <!-- Begin page content -->
    <div class="container">

      <!-- Error on Users Search ? Yes -->
      <?php if ( $usersSearchError ): ?>
        <main>
          <div class="container text-center text-white">
            <div class="row">
              <div class="col-12 my-5">
                <h1 class=""><strong>Página Não encontrada!</strong></h1>
              </div>

              <div class="col-12 my-5">
                <h5 class="">Sentimos muito pelo inconveniente. Tivemos problemas na busca pelos dados necessários.</h5>
                <p> <?php echo $profileDetails["msg"] ?></p>
              </div>

              <div class="col-12 my-5">
                <h3>¯\_(ツ)_/¯</h3>
              </div>                
            </div>
          </div>
        </main>

      <!-- Error on Users Search ? No -->
      <?php else: ?>
        <main>
          <div class="container mb-5">

            <!-- Page Title -->
            <div class="row">
              <div class="col-12 col-sm-6 mt-5">
                <h1 class="text-white"><strong>MUSIC TRADE CENTER</strong></h1>
              </div>
              <hr></hr>
            </div>

            <!-- Search Bar -->
            <div class="input-group">
              <div class="form-outline col-10 col-sm-6">
                <input id="search-input" type="search" id="form1" class="form-control" />
              </div>
              <button id="search-button" type="button" class="btn btn-default">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                  <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z"/>
                </svg>
              </button>
            </div>

          </div>            

          <!-- Perfis -->
          <div class="container mb-5">
            <div class="row">

            <?php foreach ($a_Users["data"] as $user) { ?>
                <div class="col-6 col-sm-3 mt-3">
                  <a href="<?php echo SITE_URL ?>/Views/users/user_profile.php/?key=about&user_id=<?php echo $user["user_id"] ?>">
                    <?php if ( isset($user["image_name"]) ): ?>
                      <img src="<?php echo $user["image_name"] ?>" class="img-fluid rounded" alt="" style="width:100%;height:250px;object-fit:cover;">
                    <?php else: ?>
                      <img src="<?php echo SITE_URL ?>/images/icons/default-profile-img-mtc-1.jpg" class="img-fluid rounded" alt="" style="width:100%;height:250px;object-fit:cover;">
                    <?php endif; ?>
                  </a>
                  </div>
                  <div class="col-6 col-sm-3 mt-3 bk-gray">
                    <div class="card-body text-white size-14">
                      <a class="linkdefault" href="<?php echo SITE_URL ?>/Views/users/user_profile.php/?key=about&user_id=<?php echo $user["user_id"] ?>">
                        <h5 class="card-title text-white mt-2" style="text-align:left;"><strong><?php echo $user["user_name"] ?></strong></h5>
                      </a>
                    <p class="card-title" style="text-align:left;"><strong class="text-red">Genêro(s): </strong>Rock, Pop</p>
                    <p class="card-title" style="text-align:left;"><strong class="text-red">Habilidades: </strong>Violão / Bateria / Guitarra</p>
                    <p class="card-title" style="text-align:left;"><strong class="text-red">Local: </strong><?php echo $user["city"] . " - " . $user["state"] ; ?></p>
                    <p class="card-title" style="text-align:left;"><strong class="text-red">Idade: </strong><?php echo ($user['age'] > 100 ? "Não informado" : $user['age'] . " Anos"); ?></p>
                  </div>
              </div>       
            <?php } ?>
            
            <!-- Unfunctional Examples -->
            <!-- <div class="col-6 col-sm-3 mt-3">
              <a href="<?php echo SITE_URL ?>/Views/users/user_profile.php">          
                <img src="<?php echo SITE_URL ?>/images/icons/default-profile-img-mtc-1.jpg" class="img-fluid rounded" alt="" style="width:100%;height:250px;object-fit:cover;">
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
            </div> -->          

            </div>
          </div>
        </main>

        <!-- Encontre Outros Artistas -->
        <section>
          <div class="container bk-gray col-12 col-sm-8 text-white" style="border-style:solid;border-color:gray;">
            <div class="row mt-3 mb-3">
              <div class="col-12 col-sm-8">
                <h3 class="mt-2 ms-4"><strong>Encontre artistas de diversos genêros</strong></h3>
                <p class="ms-4">Você tem a possibilidade de divulgar o seu trabalho, e encontrar artistas próximos.</p>
              </div>
              <div class="col-12 col-sm-4 mt-1">
                <a class="text-white ms-4 size-14" href="<?php echo SITE_URL ?>/Views/music_trade_center/home.php"><button type="button" class="btn btn-default btn-lg border-0 mt-3"><strong>VER MAIS</strong></button></a>  
              </div>
            </div>
          </div>
        </section>

      <!-- Error on Users Search ? End -->
      <?php endif; ?>

    </div>

    <!-- Footer Include -->
    <?php include SITE_PATH . '/includes/footer.php'; ?>    
  
    <!-- Scripts -->    
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>    
    <script src="<?php echo SITE_URL ?>/js/bootstrap.bundle.js"></script>
    <script src="<?php echo SITE_URL ?>/js/main.js"></script>    
    
  </body>

</html>