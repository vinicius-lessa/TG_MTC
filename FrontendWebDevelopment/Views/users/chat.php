<?php
/**
 * File DOC
 * 
 * @Description Página de criação de cadastro por parte do usuário do sistema.
 * @ChangeLog 
 *  - Renata Carrillo - 12/04/2022: Padronização do <head> e $titlePage;
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

$titlePage = 'MTC | Chat';

// require SITE_PATH . '/Controllers/c_trade_posts.php';
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
  </head>

  <body class="d-flex flex-column h-100 bk-preto font-main">
    
    <!-- Header Include -->
    <?php include SITE_PATH . '/includes/header.php'; ?>
    
    <!-- Begin page content -->
    <main>
      <div class="container">
        <div class="row">
          <div class="col-12 col-sm-6 mt-5">
            <h1 class="text-white"><strong>CHAT</strong></h1>
          </div>
          <hr></hr>
        </div>
      </div>

      <div class="container py-5 px-4">
        <div class="row rounded-lg overflow-hidden shadow">
          <!-- Users box-->
          <div class="col-5 px-0">
            <div class="bg-secondary">

              <div class="bg-gray px-4 py-2 bg-light">
                <p class="h5 mb-0 py-1">Recent</p>
              </div>

              <div class="messages-box">
                <div class="list-group rounded-0">
                  <a class="list-group-item list-group-item-action active text-white rounded-0">
                    <div class="media"><img src="https://bootstrapious.com/i/snippets/sn-chat/avatar.svg" alt="user" width="50" class="rounded-circle">
                      <div class="media-body ml-4">
                        <div class="d-flex align-items-center justify-content-between mb-1">
                          <h6 class="mb-0">Jason Doe</h6><small class="small font-weight-bold">25 Dec</small>
                        </div>
                        <p class="font-italic mb-0 text-small">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore.</p>
                      </div>
                    </div>
                  </a>

                  <a href="#" class="list-group-item list-group-item-action list-group-item-light rounded-0">
                    <div class="media"><img src="https://bootstrapious.com/i/snippets/sn-chat/avatar.svg" alt="user" width="50" class="rounded-circle">
                      <div class="media-body ml-4">
                        <div class="d-flex align-items-center justify-content-between mb-1">
                          <h6 class="mb-0">Jason Doe</h6><small class="small font-weight-bold">14 Dec</small>
                        </div>
                        <p class="font-italic text-muted mb-0 text-small">Lorem ipsum dolor sit amet, consectetur. incididunt ut labore.</p>
                      </div>
                    </div>
                  </a>

                  <a href="#" class="list-group-item list-group-item-action list-group-item-light rounded-0">
                    <div class="media"><img src="https://bootstrapious.com/i/snippets/sn-chat/avatar.svg" alt="user" width="50" class="rounded-circle">
                      <div class="media-body ml-4">
                        <div class="d-flex align-items-center justify-content-between mb-1">
                          <h6 class="mb-0">Jason Doe</h6><small class="small font-weight-bold">9 Nov</small>
                        </div>
                        <p class="font-italic text-muted mb-0 text-small">consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore.</p>
                      </div>
                    </div>
                  </a>

                  <a href="#" class="list-group-item list-group-item-action list-group-item-light rounded-0">
                    <div class="media"><img src="https://bootstrapious.com/i/snippets/sn-chat/avatar.svg" alt="user" width="50" class="rounded-circle">
                      <div class="media-body ml-4">
                        <div class="d-flex align-items-center justify-content-between mb-1">
                          <h6 class="mb-0">Jason Doe</h6><small class="small font-weight-bold">18 Oct</small>
                        </div>
                        <p class="font-italic text-muted mb-0 text-small">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore.</p>
                      </div>
                    </div>
                  </a>

                  <a href="#" class="list-group-item list-group-item-action list-group-item-light rounded-0">
                    <div class="media"><img src="https://bootstrapious.com/i/snippets/sn-chat/avatar.svg" alt="user" width="50" class="rounded-circle">
                      <div class="media-body ml-4">
                        <div class="d-flex align-items-center justify-content-between mb-1">
                          <h6 class="mb-0">Jason Doe</h6><small class="small font-weight-bold">17 Oct</small>
                        </div>
                        <p class="font-italic text-muted mb-0 text-small">consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore.</p>
                      </div>
                    </div>
                  </a>

                  <a href="#" class="list-group-item list-group-item-action list-group-item-light rounded-0">
                    <div class="media"><img src="https://bootstrapious.com/i/snippets/sn-chat/avatar.svg" alt="user" width="50" class="rounded-circle">
                      <div class="media-body ml-4">
                        <div class="d-flex align-items-center justify-content-between mb-1">
                          <h6 class="mb-0">Jason Doe</h6><small class="small font-weight-bold">2 Sep</small>
                        </div>
                        <p class="font-italic text-muted mb-0 text-small">Quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
                      </div>
                    </div>
                  </a>

                  <a href="#" class="list-group-item list-group-item-action list-group-item-light rounded-0">
                    <div class="media"><img src="https://bootstrapious.com/i/snippets/sn-chat/avatar.svg" alt="user" width="50" class="rounded-circle">
                      <div class="media-body ml-4">
                        <div class="d-flex align-items-center justify-content-between mb-1">
                          <h6 class="mb-0">Jason Doe</h6><small class="small font-weight-bold">30 Aug</small>
                        </div>
                        <p class="font-italic text-muted mb-0 text-small">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore.</p>
                      </div>
                    </div>
                  </a>

                  <a href="#" class="list-group-item list-group-item-action list-group-item-light rounded-0">
                    <div class="media"><img src="https://bootstrapious.com/i/snippets/sn-chat/avatar.svg" alt="user" width="50" class="rounded-circle">
                      <div class="media-body ml-4">
                        <div class="d-flex align-items-center justify-content-between mb-3">
                          <h6 class="mb-0">Jason Doe</h6><small class="small font-weight-bold">21 Aug</small>
                        </div>
                        <p class="font-italic text-muted mb-0 text-small">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore.</p>
                      </div>
                    </div>
                  </a>

                </div>
              </div>
            </div>
          </div>
          
          <!-- Chat Box-->
          <div class="col-7 px-0">
            <div class="px-4 py-5 chat-box bg-white">
              <!-- Sender Message-->
              <div class="media w-50 mb-3"><img src="https://bootstrapious.com/i/snippets/sn-chat/avatar.svg" alt="user" width="50" class="rounded-circle">
                <div class="media-body ml-3">
                  <div class="bg-light rounded py-2 px-3 mb-2">
                    <p class="text-small mb-0 text-muted">Test which is a new approach all solutions</p>
                  </div>
                  <p class="small text-muted">12:00 PM | Aug 13</p>
                </div>
              </div>

              <!-- Reciever Message-->
              <div class="media w-50 ml-auto mb-3">
                <div class="media-body">
                  <div class="bg-primary rounded py-2 px-3 mb-2">
                    <p class="text-small mb-0 text-white">Test which is a new approach to have all solutions</p>
                  </div>
                  <p class="small text-muted">12:00 PM | Aug 13</p>
                </div>
              </div>

              <!-- Sender Message-->
              <div class="media w-50 mb-3"><img src="https://bootstrapious.com/i/snippets/sn-chat/avatar.svg" alt="user" width="50" class="rounded-circle">
                <div class="media-body ml-3">
                  <div class="bg-light rounded py-2 px-3 mb-2">
                    <p class="text-small mb-0 text-muted">Test, which is a new approach to have</p>
                  </div>
                  <p class="small text-muted">12:00 PM | Aug 13</p>
                </div>
              </div>

              <!-- Reciever Message-->
              <div class="media w-50 ml-auto mb-3">
                <div class="media-body">
                  <div class="bg-primary rounded py-2 px-3 mb-2">
                    <p class="text-small mb-0 text-white">Apollo University, Delhi, India Test</p>
                  </div>
                  <p class="small text-muted">12:00 PM | Aug 13</p>
                </div>
              </div>

              <!-- Sender Message-->
              <div class="media w-50 mb-3"><img src="https://bootstrapious.com/i/snippets/sn-chat/avatar.svg" alt="user" width="50" class="rounded-circle">
                <div class="media-body ml-3">
                  <div class="bg-light rounded py-2 px-3 mb-2">
                    <p class="text-small mb-0 text-muted">Test, which is a new approach</p>
                  </div>
                  <p class="small text-muted">12:00 PM | Aug 13</p>
                </div>
              </div>

              <!-- Reciever Message-->
              <div class="media w-50 ml-auto mb-3">
                <div class="media-body">
                  <div class="bg-primary rounded py-2 px-3 mb-2">
                    <p class="text-small mb-0 text-white">Apollo University, Delhi, India Test</p>
                  </div>
                  <p class="small text-muted">12:00 PM | Aug 13</p>
                </div>
              </div>

            </div>

            <!-- Typing area -->
            <form action="#" class="bg-light">
              <div class="input-group">
                <input type="text" placeholder="Type a message" aria-describedby="button-addon2" class="form-control rounded-0 border-0 py-4 bg-light">
                <div class="input-group-append">
                  <button id="button-addon2" type="submit" class="btn btn-link"> <i class="fa fa-paper-plane"></i></button>
                </div>
              </div>
            </form>

          </div>
        </div>
      </div>
    </main>

    <!-- Footer Include -->
    <?php include SITE_PATH . '/includes/footer.php'; ?>    
  
    <!-- Scripts -->    
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>    
    <script src="<?php echo SITE_URL ?>/js/bootstrap.bundle.min.js"></script>
    <script src="<?php echo SITE_URL ?>/js/main.js"></script>
    
    <script src="sidebars.js"></script>
  </body>

</html>