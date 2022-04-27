<?php
/**
 * File DOC
 * 
 * @Description Página de criação de cadastro por parte do usuário do sistema.
 * @ChangeLog 
 *  - Renata Carrillo - 12/04/2022: Padronização do <head> e $titlePage;
 *  - Vinícius Lessa - 19/04/2022: Início dos trabalhos para tornar o chat funcional.
 *  - Vinícius Lessa - 23/04/2022: Implementação da mensagem imediata do usuário + ajustes visuais.
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
  $post_id      = $_GET['post_id'];  

  if ( isset($_GET['user']) ):
    $userTwo = $_GET['user'];
  else:
    // $userTwo = 0; // Tratar depois
  endif;

endif;


$a_OtherChats = [] ; // Chamado em 'c_chat.php'
require SITE_PATH . '/Controllers/c_chat.php';


$tradePostID  = $_GET['post_id']; // Chamado em 'c_trade_posts.php'
require SITE_PATH . '/Controllers/c_trade_posts.php';


$userCreator      = $tpDetails["data"][0]["user_id"];
$userCreatorName  = $tpDetails["data"][0]["user_name"];
$title            = $tpDetails["data"][0]["title"];
$category         = $tpDetails["data"][0]["pc_desc"];

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
    <!-- <link rel="stylesheet" href="<?php echo SITE_URL ?>/css/bootstrap/bootstrap.min.css"> -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css"> <!-- Icons -->
    <link rel="stylesheet" href="<?php echo SITE_URL ?>/css/style.css">    
    
    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="<?php echo SITE_URL ?>/images/icon.png">

    <script type="text/javascript">
      
      // Used in 'chat.js'
      url = 'http://localhost/TG_MTC/FrontendWebDevelopment/Controllers/c_chat.php/?userLogged=<?php echo $userLogged ?>&userTwo=<?php echo $userTwo ?>&post_id=<?php echo $post_id ?>';      

    </script>

  </head>

  <body class="d-flex flex-column h-100 bk-black font-main">
  <!-- <body class="d-flex flex-column h-100 bk-black font-main"> -->
    
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

          <div class="col-12">
            <div class="text-gray">
              <span class="size-14">Anúncio #<?php echo $post_id; ?></span>
            </div>
          </div>
            
          <div class="col-12">
            <hr class="hr-default">
          </div>        
        </div>

        <!-- Chat Boxes -->
        <div class="container text-white">
          <div class="row chat_panel">
            
            <!-- Main Window -->
            <div class="col-12 col-sm-8 p-2">
              <div class="shadow bk-gray px-3 py-2 rounded h-100">                

                <div class="row px-2 h-100">
                  <div class="col-12 bk-chat h-100 rounded pl-2 pr-1 py-1">  
                    
                    <!-- Chat Topic -->
                    <div class="row chat-topic p-0 m-0">
                      
                      <!-- TP Image -->
                      <div class="col-4 col-sm-2 p-0">
                        <a class="d-flex justify-content-center" href="<?php echo SITE_URL ?>/Views/trade_posts/trade_post_detailed.php/?trade_post=<?php echo $post_id ?>">
                          <img src="<?php echo $_GET['img_url'] ?>" class="rounded" alt="" style="width:190px; height:106px; object-fit:cover;">
                        </a>
                      </div>

                      <div class="col-8 col-sm-10 py-2 pl-2 pr-1">
                        <!-- TP Info -->
                        <div class="row p-0">
                          <div class="col-12">                            
                            <h5>
                              <strong>
                                <a class="linkdefault" href="<?php echo SITE_URL ?>/Views/trade_posts/trade_post_detailed.php/?trade_post=<?php echo $post_id ?>">
                                  <?php echo $title ?>
                                </a>
                              </strong>
                          </h5>      
                          </div>
                          <div class="col-12">
                            <span><?php echo $category; ?></span>
                          </div>
                          <div class="col-12 mt-1">
                            <a href="<?php echo SITE_URL ?>/Views/users/user_profile.php/?user_id=<?php echo $userCreator; ?>" class="linkdefault"><span><?php echo $userCreatorName ?></span></a>
                          </div>                          
                        </div>

                      </div>
                    </div>
                    
                    <hr class="mt-1 hr-default">

                    <div class="d-flex reverse-vertical-direction chat-box">
                      
                      <!-- Input Mensage -->
                      <div class="mx-0" style="height: 45px;">
                        <form id="newMessageForm" method="post" autocomplete="off">
                          <div class="d-flex">
                            <!-- <div class="bk-white"> -->
                              <input type="text" placeholder="Nova mensagem" name="newMessage"  id="newMessage" class="h-100 w-100" maxlength="70">
                            <!-- </div> -->
                            <!-- <div class="bk-yellow"> -->
                              
                              <!-- Hidden Values -->
                              <input type="hidden" id="userLogged" name="userLogged"  value="<?php echo $userLogged; ?>">
                              <input type="hidden" id="userTwo" name="userTwo"        value="<?php echo $userTwo; ?>">
                              <input type="hidden" id="post_id" name="post_id"        value="<?php echo $post_id; ?>">
                              <!-- <input type="hidden" id="chat_id" name="chat_id"        value="<?php // echo $chat_id ?>"> -->

                              <input type="submit" value="Enviar" class="btn-send" name="messageSubmit" id="messageSubmit">

                            <!-- </div> -->
                          </div>
                        </form>
                      </div>
                      
                      <!-- ScrollBar -->
                      <div class="row mx-0 p-0" style="height: 420px;">
                        
                        <!-- Somente aparece no início -->                        
                        <div id="loadingIcon" style="margin: auto;"> <!-- centered -->
                          <div class="d-flex justify-content-center mb-2" >
                            <h5>Buscando mensagens...</h5>
                          </div>
                          
                          <div class="d-flex justify-content-center">
                            <div class="lds-dual-ring"></div>
                          </div>
                        </div>

                        <!-- Ativado quando nenhuma mensagem for encontrada -->
                        <div class="text-gray" id="noMessages" style="display: none; margin: auto;"> <!-- centered -->
                          <div class="d-flex justify-content-center mb-2">
                            <h5>Comece uma nova conversa!</h5>
                          </div>
                          
                          <div class="d-flex justify-content-center">
                            <svg xmlns="http://www.w3.org/2000/svg" width="50" height="50" fill="currentColor" class="bi bi-chat-dots-fill" viewBox="0 0 16 16">
                              <path d="M16 8c0 3.866-3.582 7-8 7a9.06 9.06 0 0 1-2.347-.306c-.584.296-1.925.864-4.181 1.234-.2.032-.352-.176-.273-.362.354-.836.674-1.95.77-2.966C.744 11.37 0 9.76 0 8c0-3.866 3.582-7 8-7s8 3.134 8 7zM5 8a1 1 0 1 0-2 0 1 1 0 0 0 2 0zm4 0a1 1 0 1 0-2 0 1 1 0 0 0 2 0zm3 1a1 1 0 1 0 0-2 1 1 0 0 0 0 2z"/>
                            </svg>
                          </div>
                        </div>

                        <div class="col-12 scrollbar h-100 reverse-vertical-direction px-0" id="chat" style="display: none;">
                          
                          <!-- Not Functional Messages Example -->                                                    

                          <!--<div class="d-flex flex-row-reverse mr-2">
                            <div class="my-1 rounded msg-width msg-user">
                              <div class="m-0"> 
                                <div class="col-12 mb-0 d-flex flex-row-reverse p-0 px-2">
                                  <div class="m-0 p-0">
                                    <small>Olá, tudo sim, e voce?</small>
                                  </div>
                                </div>
                                <div class="float-right mr-1 mb-1 p-0 time d-flex">
                                    <span>10:41</span>
                                </div>
                              </div>
                            </div>
                          </div>

                          <div class="d-flex flex-row">
                            <div class="my-1 bk-lightgray rounded msg-width">
                              <div class="m-0">
                                <div class="col-12 mt-1 p-0 px-2">
                                  <strong><span>Rafaela Alle</span></strong>
                                </div>
                                <div class="col-12 mb-0 p-0 px-2">
                                  <div class="m-0 p-0">
                                    <small>Olá Vinícius, tudo bem?</small>
                                  </div>                                
                                </div>
                                <div class="float-right mr-1 mb-1 p-0 time d-flex">
                                    <span>10:41</span>
                                </div>                              
                              </div>
                            </div>
                          </div> -->                          

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
                  <div class="col-12 text-red">
                    <strong><h4>OUTRAS CONVERSAS</h4></strong>
                  </div>
                </div>

                <hr class="mt-1">

                <div class="row pl-2 pr-1" style="height: 550px;">
                  <div class="col-12 scrollbar h-100 w-100">
                    
                  <?php if ( !empty($a_OtherChats["data"]) ): ?>
                    
                    <div class="row mt-2 mb-4">
                      <div class="col-12 text-center">
                        <strong><h5>SEUS ANÚNCIOS</h5></strong>
                      </div>
                    </div>

                    <?php 
                      $countChatRows = 0;
                      foreach ($a_OtherChats["data"] as $chat) {                      
                    ?>                      
                      <?php if ( $chat["userid_tp_creator"] == $userLogged ):
                        $countChatRows += 1;
                      ?>                      

                        <div class="col-12">
                          <div class="row mb-1">
                            <div class="col-10">
                              <strong>
                                <p class="mb-2">
                                <?php echo $chat["post_title"] ?>
                                </p>
                              </strong>
                              <small>
                                <?php 
                                  if ( $chat["userid_lastmessage"] == $userLogged ):
                                    echo "<strong>Você</strong>: " .  $chat["last_message"] ;

                                  else:
                                    echo "<strong>" . $chat["username_lastmessage"] . "</strong>: " .  $chat["last_message"] ;

                                  endif;
                                ?> <span class="text-gray size-12"> - 10:41 </span> 
                              </small>
                            </div>
                            
                            <!-- Image -->                              
                            <div class="col-2 p-0 blur-container" style="height: 55px;">
                              <!-- Blur -->
                              <div class="blur_background" style=" background-image: url('<?php echo $chat['image_name'] ?>');">
                              </div>

                              <!-- Image -->
                              <div class="image_container_test" style="transform: translate(0px, -53px);">
                                <a href="<?php echo SITE_URL ?>/Views/trade_posts/trade_post_detailed.php/?trade_post=<?php echo $chat['post_id'] ?>">
                                  <img src="<?php echo $chat['image_name'] ?>" class="testtwo" alt="" style="">
                                </a>
                              </div>
                            </div>

                          </div>                          
                        </div>

                        <hr class="hr-default my-4">

                      <?php endif; ?>
                    <?php } ?>

                    <?php if ( $countChatRows == 0 ): ?>
                      <div class="col-12 text-center mb-5">
                        <h6>Nenhuma Conversa encontrada.</h6>
                      </div>
                    <?php endif; ?>


                    <div class="row mt-4 mb-4">
                      <div class="col-12 text-center">
                        <strong><h5>SEUS INTERESSES</h5></strong>
                      </div>
                    </div>

                    <?php 
                      $countChatRows = 0;
                      foreach ($a_OtherChats["data"] as $chat) {                        
                    ?>
                      <?php if ( !($chat["userid_tp_creator"] == $userLogged) ): 
                        $countChatRows += 1;
                      ?>

                        <div class="col-12">
                          <div class="row mb-1">
                            <div class="col-10">
                              <strong>
                                <p class="mb-2">
                                <?php echo $chat["post_title"] ?>
                                </p>
                              </strong>

                              <small>
                                <?php 
                                  if ( $chat["userid_lastmessage"] == $userLogged ):
                                    echo "<strong>Você</strong>: " .  $chat["last_message"] ;

                                  else:
                                    echo "<strong>" . $chat["username_lastmessage"] . "</strong>: " .  $chat["last_message"] ;

                                  endif;
                                ?> <span class="text-gray size-12"> - <?php echo $chat["date"] ?> </span> 
                              </small>

                            </div>
                            
                            <!-- Image -->                              
                            <div class="col-2 p-0 blur-container" style="height: 55px;">
                              <!-- Blur -->
                              <div class="blur_background" style=" background-image: url('<?php echo $chat['image_name'] ?>');">
                              </div>

                              <!-- Image -->
                              <div class="image_container_test" style="transform: translate(0px, -53px);">
                                <a href="<?php echo SITE_URL ?>/Views/trade_posts/trade_post_detailed.php/?trade_post=<?php echo $chat['post_id'] ?>">
                                  <img src="<?php echo $chat['image_name'] ?>" class="testtwo" alt="" style="">
                                </a>
                              </div>
                            </div>

                          </div>                          
                        </div>

                        <hr class="hr-default my-4">

                      <?php endif; ?>
                    <?php } ?>
                    
                    <?php if ( $countChatRows == 0 ): ?>
                      <div class="col-12 text-center">
                        <h6>Nenhuma Conversa encontrada.</h6>
                      </div>
                    <?php endif; ?>                                                                   

                  <?php else: ?>
                    <div class="col-12 text-center">
                      <h3>Nenhuma Conversa encontrada!</h3> <!-- Fazer depois -->
                    </div>
                  <?php endif; ?>

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
    <!-- <script src="<?php echo SITE_URL ?>/js/bootstrap.bundle.min.js"></script> -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="<?php echo SITE_URL ?>/js/chat.js"></script>
  </body>

</html>