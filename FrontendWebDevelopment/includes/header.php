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
  <!-- Fixed navbar -->
  <nav class="navbar navbar-expand-md bk-preto">
    <div class="container-fluid">
      <a class="navbar-brand" href="<?php echo SITE_URL ?>/Views/homepage/index.php">
        <img src="../../images/icon.png" style="text-align:center;margin-left:200px;" alt="ícone MTC" width="50" height="50">
      </a>
      <ul class="nav justify-content-center">
        <li class="nav-item">
            <a class="nav-link text-white" aria-current="page" href="<?php echo SITE_URL ?>/Views/homepage/index.php">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-white" aria-current="page" href="#">Anúncios</a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-white" aria-current="page" href="#">Feed Musical</a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-white" aria-current="page" href="#">Music Trade Center</a>
        </li>
      </ul>

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

    </div>
  </nav>
</header>