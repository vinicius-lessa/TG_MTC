<?php
/**
 * File DOC
 * 
 * @Description Página de criação de cadastro por parte do usuário do sistema.
 * @ChangeLog 
 *  - Renata Carrillo - 12/04/2022: Padronização do <head> e $titlePage;
 *  - Vinícius Lessa - 19/04/2022: Início dos trabalhos para tornar o chat funcional.
 *  - Vinícius Lessa - 23/04/2022: Implementação da mensagem imediata do usuário + ajustes visuais.
 *  - Vinícius Lessa - 27/04/2022: Implementação de "Outras Conversas".
 *  - Vinícius Lessa - 06/05/2022: Correção dos Bugs na Disposição das Imagens.
 *  - Vinícius Lessa - 10/06/2022: Mudança na seção de "Outras Conversas", alteração das fotos utilizadas e títulos das Conversas.
 * 
 * @ Notes: 
 * 
 */

date_default_timezone_set('America/Sao_Paulo');

if (!defined('SITE_URL')) {
  include_once '../../config.php';
}

include_once SITE_ROOT.'/defaultFunctions.php';

if (session_status() === PHP_SESSION_NONE) {
  session_start();
}

// require SITE_PATH . '/Controllers/c_trade_posts.php';

$titlePage = 'MTC | Chat';

$isLoggedUser = (isset($_SESSION['user_id']) && isset($_SESSION['user_name']) && isset($_SESSION['user_email'])) ? true : false;

if ( $isLoggedUser ):
  $userLogged   = $_SESSION['user_id'];

  // /Views/users/chat.php/&img_url=<?php echo $chat['image_name']
  if ( isset($_GET['user']) && isset($_GET['post_id']) && isset($_GET['img_url']) ):
    $post_id  = $_GET['post_id'];
    $userTwo  = $_GET['user'];
    $imgUrl   = $_GET['img_url'];
  
  endif;

else:
  // Login necessário para acessar essa página
  header("location:" . SITE_URL . "/Views/users/sign_in.php");

endif;


$a_OtherChats = [] ; // Chamado em 'c_chat.php' - Carrega todos os Chats do Usuário
require SITE_PATH . '/Controllers/c_chat.php';


// Último Chat Ativo (caso não tenha vindo de um Post Específico)
if ( !empty($a_OtherChats) && !$a_OtherChats["error"] ):
  if ( !isset($post_id) && !isset($userTwo) && !isset($imgUrl) ):
    $post_id  = $a_OtherChats["data"][0]["post_id"];
    $userTwo  = $a_OtherChats["data"][0]["userTwo"];
    $imgUrl   = $a_OtherChats["data"][0]["image_name"];
  endif;

elseif ( !isset($post_id) && !isset($imgUrl) && !isset($imgUrl) ):
  $noChats = true;

endif;

// $chatPostID = $post_id; // Chamado em 'c_trade_posts.php'
require SITE_PATH . '/Controllers/c_trade_posts.php';


$userCreator      = $tpDetails["data"][0]["user_id"];
$userCreatorName  = $tpDetails["data"][0]["user_name"];
$title            = $tpDetails["data"][0]["title"];
$category         = $tpDetails["data"][0]["pc_desc"];

$isOwnPost        = $userCreator === $_SESSION['user_id']

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
    <link rel="stylesheet" href="<?php echo SITE_URL ?>/css/bootstrap/bootstrap.css"> <!-- Get Bootstrap -->    
    <!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css"> --> <!-- Icons -->
    <link rel="stylesheet" href="<?php echo SITE_URL ?>/css/style.css">
    
    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="<?php echo SITE_URL ?>/images/icon.png">

    <script type="text/javascript">
      
      // Used in 'chat.js'
      url = '<?php echo SITE_URL ?>/Controllers/c_chat.php/?userLogged=<?php echo $userLogged ?>&userTwo=<?php echo $userTwo ?>&post_id=<?php echo $post_id ?>';      

    </script>

  </head>

  <body class="d-flex flex-column h-100 bk-black font-main">
  <!-- <body class="d-flex flex-column h-100 bk-black font-main"> -->
    
    <!-- Header Include -->
    <?php include SITE_PATH . '/includes/header.php'; ?>
    
    <!-- Begin page content -->
    <main>
      <!-- Has Chats? No -->
      <?php if ( $noChats ): ?>
        <div class="container text-center text-white">
          <div class="row">
            <div class="col-12 my-5">
              <h1 class=""><strong>Ainda não começou nenhuma Conversa?</strong></h1>
            </div>

            <div class="col-12 my-5">
              <h5>
                Comece novas Conversas a partir de outros 
                  <a class="linkdefault" href="<?php echo SITE_URL ?>/Views/trade_posts/home.php">
                    <button type='button' class='btn btn-lg border-0 btn-default'>
                      <strong>Anúncios</strong>
                    </button>
                  </a>
                  
                ou Receba propostas dos
                  <a class="linkdefault" href="<?php echo SITE_URL ?>/Views/users/user_profile.php/?key=trade_posts">
                    <button type='button' class='btn btn-lg border-0 btn-default'>
                      <strong>Seus Anúncios</strong>
                    </button>
                  </a>
              </h5>
            </div>
            
            <div class="col-12 my-5">
              <h3>¯\_(ツ)_/¯</h3>
            </div>                
          </div>
        </div>
              
      <!-- Has Chats? Yes -->
      <?php else: ?>
      <div class="container">
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
        <div class="container text-white zeroMargin-Padding-mobile">
          <div class="row chat_panel">
            
            <!-- Main Window -->
            <div class="col-12 col-sm-8 p-2 zeroMargin-Padding-mobile">
              <div class="shadow bk-gray px-3 py-2 rounded h-100">                

                <div class="row px-2 h-100">
                  <div class="col-12 bk-chat h-100 rounded pl-2 pr-1 py-1">  
                    
                    <!-- Chat Topic -->
                    <div class="row chat-topic p-0 m-0">                      
                      <!-- TP Image -->
                      <div class="col-5 col-sm-2 p-0 image-container-new" id="chatTP-img-container">
                        <?php if ( isset($imgUrl) && $imgUrl != null && validateImageSource($imgUrl) ): ?>

                          <!-- Blur -->
                          <div class="img-default-content img_background_blur " style=" background-image: url('<?php echo $imgUrl ?>');">
                          </div>

                          <!-- Image -->
                          <div class="img-default-content img_tp">
                            <a href="<?php echo SITE_URL ?>/Views/trade_posts/trade_post_detailed.php/?trade_post=<?php echo $post_id ?>">
                              <img src="<?php echo $imgUrl ?>" class="img-tag-tp-default" alt="" style="">
                            </a>
                          </div>
                        <?php else: ?>
                          <div class="img-default-content">
                            <a href="<?php echo SITE_URL ?>/Views/trade_posts/trade_post_detailed.php/?trade_post=<?php echo $post_id ?>">
                              <img src="<?php echo SITE_URL ?>/images/icons/no-image-icon.png" alt="Imagem ilustrativa de um produto voltado ao meio musical.">
                            </a>
                          </div>
                        <?php endif; ?>
                      </div>                      

                      <div class="col-7 col-sm-10 py-2 pl-2 pr-1">
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
                            <a href="<?php echo SITE_URL ?>/Views/users/user_profile.php/?key=about&user_id=<?php echo $userCreator; ?>" class="linkdefault">
                              <span>
                                <?php echo $userCreatorName ?>
                              </span>
                              <?php if ($isOwnPost) : echo "<small> (Você)</small>" ;  endif; ?>
                            </a>
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
                              <input type="hidden" id="current_time" name="current_time" value="<?php echo date("h:i"); ?>">

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
            <div class="col-12 col-sm-4 p-2 zeroMargin-Padding-mobile">
              <div class="shadow bk-gray p-3 rounded h-100">
                <div class="row">
                  <div class="col-12">                    
                    <h3 class="title-default">OUTRAS CONVERSAS</h3>
                  </div>
                </div>

                <hr class="mt-1">

                <div class="row pl-2 pr-1" style="height: 550px;">
                  <div class="col-12 scrollbar h-100 w-100">
                    
                  <?php if ( !empty($a_OtherChats["data"]) ): ?>
                    
                    <!-- ANÚNCIOS PRÓPRIOS -->
                    <div class="row mt-2 mb-4">
                      <div class="col-12 text-center text-red stroke-one">
                        <h5>SEUS ANÚNCIOS</h5>
                      </div>
                    </div>

                    <?php 
                      print_r($chatRow);
                      
                      $countChatRows = 0;
                      $lastId = 0;
                      foreach ($a_OtherChats["data"] as $chat) {
                        if ( $lastId == $chat['chat_id'] ):
                          continue; // Skip Iteration
                        endif;
                        $lastId = $chat['chat_id'];
                    ?>                      
                      <?php
                        // Only if User Logged = Author
                        if ( $chat["userid_tp_creator"] == $userLogged ):
                          $countChatRows += 1;
                      ?>

                        <div class="col-12">                          
                          <div class="row mb-1">                            
                            <div class="col-9">
                              
                              <a class="linkdefault" 
                                href="<?php echo SITE_URL ; ?>/Views/users/chat.php/?user=<?php echo $chat['userTwo'] ; ?>&post_id=<?php echo $chat['post_id'] ; ?>&img_url=<?php echo $chat['image_name'] ?>"
                              >
                                <p class="mb-2">
                                  <strong>
                                    <?php echo $chat["post_title"] ?>
                                  </strong>
                                  
                                  <small> 
                                    (<?php echo $chat["userTwo_Name"] ?>)
                                  </small>
                                </p>
                              </a>

                              <small>
                                <?php 
                                  if ( $chat["userid_lastmessage"] == $userLogged ):
                                    echo "<strong>Você</strong>: " .  $chat["last_message"] ;

                                  else:
                                    echo "<strong>" . $chat["username_lastmessage"] . "</strong>: " .  $chat["last_message"] ;

                                  endif;
                                ?> <span class="text-gray size-12"> - <?php echo date("H:i", strtotime($chat['message_date'])  ) ; ?> </span>
                              </small>
                            </div>
                            
                            <!-- TP Image -->
                            <!-- <div class="col-3 p-0 image-container-new" style="height: 70px;"> -->
                              <!-- <?php if ( isset($chat['userTwo_Image']) && $chat['userTwo_Image'] != null && validateImageSource($chat['userTwo_Image']) ): ?> -->

                                <!-- Blur -->
                                <!-- <div class="img-default-content img_background_blur " style=" background-image: url('<?php echo $chat['userTwo_Image'] ?>');">
                                </div> -->

                                <!-- Image -->
                                <!-- <div class="img-default-content img_tp">
                                  <a href="<?php echo SITE_URL ?>/Views/trade_posts/trade_post_detailed.php/?trade_post=<?php echo $chat['post_id'] ?>">
                                    <img src="<?php echo $chat['userTwo_Image'] ?>" class="img-tag-tp-default" alt="" style="">
                                  </a>
                                </div> -->
                              <?php else: ?>
                                <!-- <div class="img-default-content">
                                  <a href="<?php echo SITE_URL ?>/Views/trade_posts/trade_post_detailed.php/?trade_post=<?php echo $chat['post_id'] ?>">
                                    <img src="<?php echo SITE_URL ?>/images/icons/no-image-icon.png" alt="Imagem ilustrativa de um produto voltado ao meio musical.">
                                  </a>
                                </div> -->
                              <?php endif; ?>
                            <!-- </div> -->

                            <div class="col-3 d-flex justify-content-center">
                              <?php if ( isset($chat['userTwo_Image']) && $chat['userTwo_Image'] != null && validateImageSource($chat['userTwo_Image']) ): ?>
                                <img src="<?php echo $chat['userTwo_Image'] ?>" class="img-fluid rounded-circle" alt="" style="max-width:100%;width:60px;height:60px;object-fit:cover;">
                              <?php else: ?>
                                <img src="<?php echo SITE_URL ?>/images/icons/default-profile-img.png" class="img-fluid rounded-circle" alt="" style="max-width:100%;width:60px;height:60px;object-fit:cover;">                                
                              <?php endif; ?>
                            </div>

                          </div>                          
                        </div>

                        <hr class="hr-default my-4">

                      <?php endif; ?>
                    <?php } ?>

                    <?php if ( $countChatRows == 0 ): ?>
                      <div class="col-12 text-center mb-5">
                        <h6>Nenhuma mensagem recebida :(</h6>
                      </div>
                    <?php endif; ?>

                    <!-- ANÚNCIOS INTERESSADOS -->
                    <div class="row mt-4 mb-4">
                      <div class="col-12 text-center text-red stroke-one">
                        <h5>SEUS INTERESSES</h5>
                      </div>
                    </div>

                    <?php 
                      $countChatRows  = 0;
                      $lastId         = 0;

                      foreach ($a_OtherChats["data"] as $chat) {
                        
                        if ( $lastId == $chat['chat_id'] ):
                          continue; // Skip Iteration
                        endif;
                        $lastId = $chat['chat_id'];                                              
                    ?>
                      <?php if ( !($chat["userid_tp_creator"] == $userLogged) ): 
                        $countChatRows += 1;
                      ?>

                        <div class="col-12">
                          <div class="row mb-1">
                            <div class="col-9">
                              <a  class="linkdefault" 
                                  href="<?php echo SITE_URL ; ?>/Views/users/chat.php/?user=<?php echo $chat['userTwo'] ; ?>&post_id=<?php echo $chat['post_id'] ; ?>&img_url=<?php echo $chat['image_name'] ?>"
                              >                                                              
                                <p class="mb-2">
                                  <strong>
                                    <?php echo $chat["post_title"] ?>
                                  </strong>
                                  
                                  <small> 
                                    (<?php echo $chat["userTwo_Name"] ?>)
                                  </small>
                                </p>                                
                              </a>

                              <small>
                                <?php 
                                  if ( $chat["userid_lastmessage"] == $userLogged ):
                                    echo "<strong>Você</strong>: " .  $chat["last_message"] ;

                                  else:
                                    echo "<strong>" . $chat["username_lastmessage"] . "</strong>: " .  $chat["last_message"] ;

                                  endif;
                                ?> <span class="text-gray size-12"> - <?php echo date("H:i", strtotime($chat['message_date'])  ) ; ?> </span> 
                              </small>

                            </div>
                            
                            <!-- TP Image -->
                            <div class="col-3 p-0 image-container-new" style="height: 70px;">
                              <?php if ( isset($chat['image_name']) && $chat['image_name'] != null && validateImageSource($chat['image_name']) ): ?> -->

                                <!-- Blur -->
                                <div class="img-default-content img_background_blur " style=" background-image: url('<?php echo $chat['image_name'] ?>');">
                                </div>

                                <!-- Image -->
                                <div class="img-default-content img_tp">
                                  <a href="<?php echo SITE_URL ?>/Views/trade_posts/trade_post_detailed.php/?trade_post=<?php echo $chat['post_id'] ?>">
                                    <img src="<?php echo $chat['image_name'] ?>" class="img-tag-tp-default" alt="" style="">
                                  </a>
                                </div>
                              <?php else: ?>
                                <div class="img-default-content">
                                  <a href="<?php echo SITE_URL ?>/Views/trade_posts/trade_post_detailed.php/?trade_post=<?php echo $chat['post_id'] ?>">
                                    <img src="<?php echo SITE_URL ?>/images/icons/no-image-icon.png" alt="Imagem ilustrativa de um produto voltado ao meio musical.">
                                  </a>
                                </div>
                              <?php endif; ?>
                            </div> 
                            
                            <!-- <div class="col-3 d-flex justify-content-center">
                              <?php if ( isset($chat['userTwo_Image']) && $chat['userTwo_Image'] != null && validateImageSource($chat['userTwo_Image']) ): ?>
                                <img src="<?php echo $chat['userTwo_Image'] ?>" class="img-fluid rounded-circle" alt="" style="max-width:100%;width:60px;height:60px;object-fit:cover;">
                              <?php else: ?>
                                <img src="<?php echo SITE_URL ?>/images/icons/default-profile-img.png" class="img-fluid rounded-circle" alt="" style="max-width:100%;width:60px;height:60px;object-fit:cover;">
                              <?php endif; ?>
                            </div> -->

                          </div>                          
                        </div>

                        <hr class="hr-default my-4">

                      <?php endif; ?>
                    <?php } ?>
                    
                    <?php if ( $countChatRows == 0 ): ?>
                      <div class="col-12 text-center">
                        <h6>Você ainda não Mandou nenhuma Mensagem :(</h6>
                      </div>
                    <?php endif; ?>                                                                   

                  <?php else: ?>
                    <div class="col-12 text-center">
                      <h3>Você Não possui nenhum Chat Ativo!</h3> <!-- Fazer depois -->
                    </div>
                  <?php endif; ?>

                  </div>
                </div>
              </div>
            </div>

          </div>          
        </div>
      </div>
      
      <!-- Has Chats? End -->
      <?php endif; ?>
    </main>

    <!-- Footer Include -->
    <?php include SITE_PATH . '/includes/footer.php'; ?>    
  
    <!-- Scripts -->    
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script src="<?php echo SITE_URL ?>/js/bootstrap.bundle.js"></script>

    <script src="<?php echo SITE_URL ?>/js/main.js"></script>
    <script src="<?php echo SITE_URL ?>/js/chat.js"></script>
    
  </body>

</html>