<?php
/**
 * File DOC
 * 
 * @Description Página de criação de cadastro por parte do usuário do sistema.
 * @ChangeLog 
 *  - Renata Carrillo - 12/04/2022: Padronização do <head> e $titlePage;
 *  - Vinícius Lessa - 19/04/2022: Início dos trabalhos para tornar o chat funcional.
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

// require SITE_PATH . '/Controllers/c_trade_posts.php';

$titlePage = 'MTC | Chat';

$isLoggedUser = (isset($_SESSION['user_id']) && isset($_SESSION['user_name']) && isset($_SESSION['user_email'])) ? true : false;

if ( $isLoggedUser ):
  $userLogged   = $_SESSION['user_id'];
  $userCreator  = $_GET['user'];
  $post_id      = $_GET['post_id'];
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
    <link rel="stylesheet" href="<?php echo SITE_URL ?>/css/bootstrap/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css"> <!-- Icons -->    
    <link rel="stylesheet" href="<?php echo SITE_URL ?>/css/style.css">    
    
    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="<?php echo SITE_URL ?>/images/icon.png">

    <script type="text/javascript">      
      var url = '';

      // Refresh Chat
      function ajax(){
        var req = new XMLHttpRequest();
        req.onreadystatechange = function()
        {
            if (req.readyState == 4 && req.status == 200) {
              document.getElementById('chat').innerHTML = req.responseText;
            }
        }
        url = 'http://localhost/TG_MTC/FrontendWebDevelopment/Controllers/c_chat.php/?userLogged=<?php echo $userLogged ?>&userCreator=<?php echo $userCreator ?>&post_id=<?php echo $post_id ?>';        
        
        req.open('GET', url, true);
        req.send();
      }
      
      // Repeat - 1 min
      // setInterval(function(){ajax();}, 100000);
    </script>

  </head>

  <!-- <body class="d-flex flex-column h-100 bk-black font-main" onload="ajax();"> -->
  <body class="d-flex flex-column h-100 bk-black font-main">
    
    <!-- Header Include -->
    <?php include SITE_PATH . '/includes/header.php'; ?>
    
    <!-- Begin page content -->
    <main>
      <div class="container">
        <!-- Somente se estiver Logado -->
        <?php if ( $isLoggedUser ): ?>

        <div class="row">
          <div class="col-12 col-sm-6 mt-5">
            <h1 class="text-white"><strong>CHAT</strong></h1>
          </div>
          <hr></hr>
        </div>

        <!-- Chat Boxes -->
        <div class="container text-white">
          <div class="row" style="height: 500px; background-color: rgba(255,0,0,0.1);">
            <!-- Current Chat -->
            <div class="col-12 col-sm-8 p-2">
              <div class="shadow bk-gray p-3 border border-danger rounded h-100">
                <!-- <div class="row">
                  <div class="col-12">
                    <strong><h5>Histórico de Conversa</h5></strong>
                  </div>                  
                </div>
                
                <hr class="mt-1"> -->

                <div class="row px-2 h-100">
                  <div class="col-12 bk-chat h-100 rounded p-3 d-flex reverse-direction">

                    <!-- Input Mensage -->                    
                    <div class="bk-orange" style="height: 45px;">
                      <!-- <h3>Teste</h3> -->
                      <form>
                        <div class="d-flex">
                          <!-- <div class="bk-white"> -->
                            <input type="text" placeholder="Nova mensagem" class="h-100 w-100">
                          <!-- </div> -->
                          <!-- <div class="bk-yellow"> -->
                            <input type="submit" value="Enviar" class="border-0">
                          <!-- </div> -->
                        </div>
                      </form>
                    </div>
                    
                    <!-- ScrollBar -->
                    <div class="bk-purple" style="height: 200px;">
                      <div class="scrollbar" id="chat">
                        
                        <div class="col-12 mb-1">
                          <small>Olá Fulano, tudo bem?</small>
                        </div>
                        <div class="col-12 mb-4">
                          <div class="col-12">
                            <strong><span>Rafaela Alle</span></strong>
                          </div>
                        </div>

                        <div class="col-12 mb-1">
                          <small>Olá Fulano, tudo bem?</small>
                        </div>
                        <div class="col-12 mb-4">
                          <div class="col-12">
                            <strong><span>Rafaela Alle</span></strong>
                          </div>
                        </div>

                        <div class="col-12 mb-1">
                          <small>Olá Fulano, tudo bem?</small>
                        </div>
                        <div class="col-12 mb-4">
                          <div class="col-12">
                            <strong><span>Rafaela Alle</span></strong>
                          </div>
                        </div>

                        <div class="col-12 mb-1">
                          <small>Olá Fulano, tudo bem?</small>
                        </div>
                        <div class="col-12 mb-4">
                          <div class="col-12">
                            <strong><span>Rafaela Alle</span></strong>
                          </div>
                        </div>
                        
                        <div class="col-12 mb-1">
                          <small>Olá Fulano, tudo bem?</small>
                        </div>
                        <div class="col-12 mb-4">
                          <div class="col-12">
                            <strong><span>Rafaela Alle</span></strong>
                          </div>
                        </div>
                        
                      </div>  
                    </div>
                  </div>
                </div>
              </div>
            </div>
            
            <!-- Other Chats -->
            <div class="col-12 col-sm-4 p-2">
              <div class="shadow bk-gray p-3 rounded h-100">
                <div class="row">
                  <div class="col-12">
                    <strong><h5>Outras Conversas</h5></strong>
                  </div>                  
                </div>

                <hr class="mt-1">

                <div class="row p-2" style="height: 300px;">
                  <div class="scrollbar h-100">
                    <div class="col-12">
                      <div class="row mb-1">
                        <strong><span>Rafaela Alle</span></strong>
                      </div>
                      <div class="row mb-4">
                        <div class="col-6 d-flex">
                          <small>Olá Fulano, tudo bem?</small>
                        </div>
                        <div class="col-6 d-flex flex-row-reverse text-gray">
                          <small>agora</small>
                        </div>
                      </div>
                    </div>

                    <div class="col-12">
                      <div class="row mb-1">
                        <strong><span>Luiz</span></strong>
                      </div>
                      <div class="row mb-4">
                        <div class="col-6 d-flex">
                          <small>Olá Fulano, tudo bem?</small>
                        </div>
                        <div class="col-6 d-flex flex-row-reverse text-gray">
                          <small>14:25</small>
                        </div>
                      </div>
                    </div>

                    <div class="col-12">
                      <div class="row mb-1">
                        <strong><span>Renato Lompandi</span></strong>
                      </div>
                      <div class="row mb-4">
                        <div class="col-6 d-flex">
                          <small>Olá Fulano, tudo bem?</small>
                        </div>
                        <div class="col-6 d-flex flex-row-reverse text-gray">
                          <small>25/03/2022</small>
                        </div>
                      </div>
                    </div>

                    <div class="col-12">
                      <div class="row mb-1">
                        <strong><span>Renato Lompandi</span></strong>
                      </div>
                      <div class="row mb-4">
                        <div class="col-6 d-flex">
                          <small>Olá Fulano, tudo bem?</small>
                        </div>
                        <div class="col-6 d-flex flex-row-reverse text-gray">
                          <small>25/03/2022</small>
                        </div>
                      </div>
                    </div>
                    
                    <div class="col-12">
                      <div class="row mb-1">
                        <strong><span>Renato Lompandi</span></strong>
                      </div>
                      <div class="row mb-4">
                        <div class="col-6 d-flex">
                          <small>Olá Fulano, tudo bem?</small>
                        </div>
                        <div class="col-6 d-flex flex-row-reverse text-gray">
                          <small>25/03/2022</small>
                        </div>
                      </div>
                    </div>
                    
                    <div class="col-12">
                      <div class="row mb-1">
                        <strong><span>Renato Lompandi</span></strong>
                      </div>
                      <div class="row mb-4">
                        <div class="col-6 d-flex">
                          <small>Olá Fulano, tudo bem?</small>
                        </div>
                        <div class="col-6 d-flex flex-row-reverse text-gray">
                          <small>25/03/2022</small>
                        </div>
                      </div>
                    </div>       
                  </div>
                </div>
              </div>
            </div>

          </div>          
        </div>
      
      <?php else:
        // Login necessário para acessar essa página
        header("location:" . SITE_URL . "/Views/users/sign_in.php");
        
      endif;  
      ?>
      </div>
    </main>

    <!-- Footer Include -->
    <?php include SITE_PATH . '/includes/footer.php'; ?>    
  
    <!-- Scripts -->    
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>    
    <script src="<?php echo SITE_URL ?>/js/bootstrap.bundle.min.js"></script>
    <script src="<?php echo SITE_URL ?>/js/main.js"></script>    
  </body>

</html>