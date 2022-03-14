<header>
  <!-- Fixed navbar -->
  <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
    <div class="container-fluid">
    <div class="col-4">
      <a class="row align-items-start navbar-brand" href="<?php echo SITE_URL ?>/Views/home/index.php">
      <img src="images/ícone.png" class="img-thumbnail" alt="...">
      </a>
    </div>
      <!-- <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button> -->
      <div class="col-4">
      <div class="collapse navbar-collapse" id="navbarCollapse">
        <ul class="navbar-nav me-auto mb-2 mb-md-0">
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="#">Home</a>
          </li>
        </ul>
      </div>
        <!-- <form class="d-flex">
          <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
          <button class="btn btn-outline-success" type="submit">Search</button>
        </form> -->
        <div class="col-4">
        <li class="nav-item">
            <a class="nav-link" href="<?php echo SITE_URL ?>/Views/Users/Cadastro.php">Cadastrar</a>
          </li>
          <li class="nav-item">
            <a class="nav-link">Entrar</a>
          </li>
        </div>
      </div>
    </div>
  </nav>
</header>

<!-- Logomarca -->
<!-- <div class="row">
  <div class="col-md-12">
    <a href="<?php echo SITE_URL ?>/Views/home/index.php"><img id="logo-header" alt="Logo do site"/>
      MTC - Music Trade Center
    <a>
  </div>
</div> -->