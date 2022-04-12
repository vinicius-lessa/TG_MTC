<?php
  if (!defined('SITE_URL')) {
    include_once '../../config.php';
  }

  if (session_status() === PHP_SESSION_NONE) {
    session_start();
  }

  $titlePage = 'HomePage';
  $data_slide = 0;

  // require SITE_PATH . '/Controllers/c_home.php';
?>

<!DOCTYPE html>
<html lang="pt-br" class="h-100">
  <head>
  <meta charset='utf-8'>    
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>

    <!-- Page Data -->
    <meta name="author" content="Vinícius Lessa / Iuri Ferreira">
    <meta name="description" content="Página de criação de cadastro por parte do usuário do sistema.">
    <title> <?php echo $titlePage; ?> </title>
    
    <!-- StyleSheet -->
    <link rel="stylesheet" href="<?php echo SITE_URL ?>/css/bootstrap/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css"> <!-- Icons -->
    <link rel="stylesheet" href="<?php echo SITE_URL ?>/css/style.css">
    <link rel="canonical" href="https://getbootstrap.com/docs/5.0/examples/headers/">
    
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
    </main>

<!-- CHAT -->
<!-- <div class="container mt-1">
  <div class="row">

    <div class="col-8 col-sm-8 mt-3">

    </div>

  </div>
</div> -->

<section class="bg-left">
  <div class="container py-5">

    <div class="row">

      <div class="col-sm-6 col-lg-5 col-xl-4 mb-4 mb-md-0">

        <h5 class="font-weight-bold mb-3 text-center text-white">Recentes</h5>

        <div class="card" style="background-color:#252424;border-color:#FFFF;">
          <div class="card-body">

            <ul class="list-unstyled mb-0">
              <li class="p-2 border-bottom">
                <a href="#!" class="d-flex justify-content-between">
                  <div class="d-flex flex-row">
                    <img src="../../images/IMAGENS/ARTISTAS/ARTISTAWOMEN04.jpg" alt="avatar"
                      class="rounded-circle d-flex align-self-center me-3 shadow-1-strong" width="60" height="60">
                    <div class="pt-1">
                      <p class="fw-bold mb-0">John Doe</p>
                      <p class="small text-muted">Hello, Are you there?</p>
                    </div>
                  </div>
                  <div class="pt-1">
                    <p class="small text-muted mb-1">Just now</p>
                    <span class="badge bg-danger float-end">1</span>
                  </div>
                </a>
              </li>
              <li class="p-2 border-bottom">
                <a href="#!" class="d-flex justify-content-between">
                  <div class="d-flex flex-row">
                    <img src="../../images/IMAGENS/ARTISTAS/ARTISTA01.jpg" alt="avatar"
                      class="rounded-circle d-flex align-self-center me-3 shadow-1-strong" width="60" height="60">
                    <div class="pt-1">
                      <p class="fw-bold mb-0">Danny Smith</p>
                      <p class="small text-muted">Lorem ipsum dolor sit.</p>
                    </div>
                  </div>
                  <div class="pt-1">
                    <p class="small text-muted mb-1">5 mins ago</p>
                  </div>
                </a>
              </li>
              <li class="p-2 border-bottom">
                <a href="#!" class="d-flex justify-content-between">
                  <div class="d-flex flex-row">
                    <img src="../../images/IMAGENS/ARTISTAS/ARTISTAWOMEN04.jpg" alt="avatar"
                      class="rounded-circle d-flex align-self-center me-3 shadow-1-strong" width="60" height="60">
                    <div class="pt-1">
                      <p class="fw-bold mb-0">Alex Steward</p>
                      <p class="small text-muted">Lorem ipsum dolor sit.</p>
                    </div>
                  </div>
                  <div class="pt-1">
                    <p class="small text-muted mb-1">Yesterday</p>
                  </div>
                </a>
              </li>
              <li class="p-2 border-bottom">
                <a href="#!" class="d-flex justify-content-between">
                  <div class="d-flex flex-row">
                    <img src="../../images/IMAGENS/ARTISTAS/ARTISTA01.jpg" alt="avatar"
                      class="rounded-circle d-flex align-self-center me-3 shadow-1-strong" width="60" height="60">
                    <div class="pt-1">
                      <p class="fw-bold mb-0">Ashley Olsen</p>
                      <p class="small text-muted">Lorem ipsum dolor sit.</p>
                    </div>
                  </div>
                  <div class="pt-1">
                    <p class="small text-muted mb-1">Yesterday</p>
                  </div>
                </a>
              </li>
              <li class="p-2 border-bottom">
                <a href="#!" class="d-flex justify-content-between">
                  <div class="d-flex flex-row">
                    <img src="../../images/IMAGENS/ARTISTAS/ARTISTAWOMEN04.jpg" alt="avatar"
                      class="rounded-circle d-flex align-self-center me-3 shadow-1-strong" width="60" height="60">
                    <div class="pt-1">
                      <p class="fw-bold mb-0">Kate Moss</p>
                      <p class="small text-muted">Lorem ipsum dolor sit.</p>
                    </div>
                  </div>
                  <div class="pt-1">
                    <p class="small text-muted mb-1">Yesterday</p>
                  </div>
                </a>
              </li>
              <li class="p-2 border-bottom">
                <a href="#!" class="d-flex justify-content-between">
                  <div class="d-flex flex-row">
                    <img src="../../images/IMAGENS/ARTISTAS/ARTISTA01.jpg" alt="avatar"
                      class="rounded-circle d-flex align-self-center me-3 shadow-1-strong" width="60" height="60">
                    <div class="pt-1">
                      <p class="fw-bold mb-0">Lara Croft</p>
                      <p class="small text-muted">Lorem ipsum dolor sit.</p>
                    </div>
                  </div>
                  <div class="pt-1">
                    <p class="small text-muted mb-1">Yesterday</p>
                  </div>
                </a>
              </li>
              <li class="p-2">
                <a href="#!" class="d-flex justify-content-between">
                  <div class="d-flex flex-row">
                    <img src="../../images/IMAGENS/ARTISTAS/ARTISTAWOMEN04.jpg" alt="avatar"
                      class="rounded-circle d-flex align-self-center me-3 shadow-1-strong" width="60" height="60">
                    <div class="pt-1">
                      <p class="fw-bold mb-0">Brad Pitt</p>
                      <p class="small text-muted">Lorem ipsum dolor sit.</p>
                    </div>
                  </div>
                  <div class="pt-1">
                    <p class="small text-muted mb-1">5 mins ago</p>
                    <span class="text-muted float-end"><i class="fas fa-check" aria-hidden="true"></i></span>
                  </div>
                </a>
              </li>
            </ul>

          </div>
        </div>

      </div>

      <div class="col-md-6 col-lg-7 col-xl-8">

        <ul class="list-unstyled">
          <li class="d-flex justify-content-between mb-4">
            <img src="../../images/IMAGENS/ARTISTAS/ARTISTA01.jpg" alt="avatar"
              class="rounded-circle d-flex align-self-start me-3 shadow-1-strong" width="60" height="60">
            <div class="card text-white" style="background-color:#252424;border-color:#FFFF;">
              <div class="card-header d-flex justify-content-between p-3" style="background-color:#000000;border-color:#FFFF;">
                <p class="fw-bold mb-0">Brad Pitt</p>
                <p class="text-muted small mb-0"><i class="far fa-clock"></i> 12 mins ago</p>
              </div>
              <div class="card-body">
                <p class="mb-0">
                  Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut
                  labore et dolore magna aliqua.
                </p>
              </div>
            </div>
          </li>
          <li class="d-flex justify-content-between mb-4">
            <div class="card w-100 text-white" style="background-color:#252424;border-color:#FFFF;">
              <div class="card-header d-flex justify-content-between p-3" style="background-color:#000000;border-color:#FFFF;">
                <p class="fw-bold mb-0">Lara Croft</p>
                <p class="text-muted small mb-0"><i class="far fa-clock"></i> 13 mins ago</p>
              </div>
              <div class="card-body">
                <p class="mb-0">
                  Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque
                  laudantium.
                </p>
              </div>
            </div>
            <img src="../../images/IMAGENS/ARTISTAS/ARTISTA01.jpg" alt="avatar"
              class="rounded-circle d-flex align-self-start ms-3 shadow-1-strong" width="60" height="60">
          </li>
          <li class="d-flex justify-content-between mb-4">
            <img src="../../images/IMAGENS/ARTISTAS/ARTISTAWOMEN04.jpg" alt="avatar"
              class="rounded-circle d-flex align-self-start me-3 shadow-1-strong" width="60" height="60">
              <div class="card w-100 text-white" style="background-color:#252424;border-color:#FFFF;">
              <div class="card-header d-flex justify-content-between p-3" style="background-color:#000000;border-color:#FFFF;">
                <p class="fw-bold mb-0">Brad Pitt</p>
                <p class="text-muted small mb-0"><i class="far fa-clock"></i> 10 mins ago</p>
              </div>
              <div class="card-body">
                <p class="mb-0">
                  Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut
                  labore et dolore magna aliqua.
                </p>
              </div>
            </div>
          </li>
          <li class="bg-white mb-3">
            <div class="form-outline">
              <textarea class="form-control" id="textAreaExample2" rows="4" placeholder="Digite aqui sua mensagem" style="background-color:#252424;border-color:#FFFF;"></textarea>
            </div>
          </li>
          <button type="button" class="btn btn-danger btn-rounded float-end">Send</button>
        </ul>

      </div>

    </div>

  </div>
</section>

    <!-- Footer Include -->
    <?php include SITE_PATH . '/includes/footer.php'; ?>    
  
    <!-- Scripts -->    
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="<?php echo SITE_URL ?>/js/bootstrap.bundle.min.js"></script>
    <script src="<?php echo SITE_URL ?>/js/main.js"></script>
    <script src="../assets/dist/js/bootstrap.bundle.min.js"></script>
    <script src="sidebars.js"></script>
  </body>

</html>