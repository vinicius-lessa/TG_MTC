<<<<<<< HEAD
<!-- <header class="col-12 col-sm-12 mb-5"> -->
=======
<?php
/**
 * File DOC
 * 
 * @Description Header Include Page
 * @ChangeLog 
 *  - Vinícius Lessa - 06/04/2022: ...
 * 
 * @ Notes: 
 * 
 */
session_start();

?>

<header class="mb-5">
>>>>>>> de30ab7db48952031d43e61a0c3ea42a2f5c6f6d
  <!-- Fixed navbar -->
  <!-- <nav class="navbar navbar-expand-md bk-preto">
    <div class="container">
      <a class="navbar-brand" href="<?php echo SITE_URL ?>/Views/homepage/index.php">
        <img src="../../images/icon.png" alt="ícone MTC" width="50" height="50">
      </a>

      <ul class="nav">
        <li class="nav-item">
            <a class="border-button nav-link text-white" aria-current="page" href="<?php echo SITE_URL ?>/Views/homepage/index.php">Home</a>
        </li>
        <li class="nav-item">
          <a class="border-button nav-link text-white" aria-current="page" href="#">Anúncios</a>
        </li>
        <li class="nav-item">
          <a class="border-button nav-link text-white" aria-current="page" href="#">Feed Musical</a>
        </li>
        <li class="nav-item">
          <a class="border-button nav-link text-white" aria-current="page" href="#">Music Trade Center</a>
        </li>
      </ul>

<<<<<<< HEAD
      <ul class="nav">
        <li class="nav-item">
            <a class="border-button nav-link text-white" href="<?php echo SITE_URL ?>/Views/users/SignUp.php">Cadastrar</a>
        </li>
        <li class="nav-item">
          <a class="border-button nav-link text-white" href="<?php echo SITE_URL ?>/Views/users/SignIn.php">Entrar</a>
        </li>
      </ul>
=======
      <?php if (isset($_SESSION['user_id']) && isset($_SESSION['user_name']) && isset($_SESSION['user_email']) ): ?>
        <ul class="nav justify-content-end">
          <li class="nav-item">
              <form action="<?php echo SITE_URL ?>/Controllers/c_user.php" method="get">
                <a class="nav-link text-white" href="<?php echo SITE_URL ?>/Controllers/c_user.php/?signOut=true">Sair</a>
              </form>
          <li class="nav-item">
            <a class="nav-link text-white" href="<?php echo SITE_URL ?>/Views/users/MyProfile.php">Meu Perfil</a>
          </li>
        </ul>      
      <?php else:  ?>      
        <ul class="nav justify-content-end">
          <li class="nav-item">
              <a class="nav-link text-white" href="<?php echo SITE_URL ?>/Views/users/SignUp.php">Cadastrar</a>
          </li>
          <li class="nav-item">
            <a class="nav-link text-white" href="<?php echo SITE_URL ?>/Views/users/SignIn.php">Entrar</a>
          </li>
        </ul>
      <?php endif;  ?>
>>>>>>> de30ab7db48952031d43e61a0c3ea42a2f5c6f6d

    </div>
  </nav> -->

  <div class="container">
    <header class="d-flex flex-wrap justify-content-center py-3">
      
      <a href="<?php echo SITE_URL ?>/Views/homepage/index.php" class="d-flex align-items-center mb-md-0 me-md-auto text-dark text-decoration-none">
        <img src="../../images/icon.png" alt="ícone MTC" width="50" height="50">
      </a>

      <ul class="nav nav-pills">
        <li class="nav-item"><a href="<?php echo SITE_URL ?>/Views/homepage/index.php" class="border-button nav-link text-white" aria-current="page">Home</a></li>
        <li class="nav-item"><a href="<?php echo SITE_URL ?>/Views/produtos/anuncios.php" class="border-button nav-link text-white">Anúncios</a></li>
        <li class="nav-item"><a href="<?php echo SITE_URL ?>/Views/produtos/FeedMusical.php" class="border-button nav-link text-white">Feed Musical</a></li>
        <li class="nav-item"><a href="<?php echo SITE_URL ?>/Views/produtos/MusicTradeCenter.php" class="border-button nav-link text-white">Music Trade Center</a></li>
        <li class="nav-item"><a href="<?php echo SITE_URL ?>/Views/users/SignUp.php" class="border-button nav-link text-white">Cadastrar</a></li>
        <li class="nav-item"><a href="<?php echo SITE_URL ?>/Views/users/SignIn.php" class="border-button nav-link text-white">Entrar</a></li>
      </ul>

    </header>
  </div>
<!-- </header> -->