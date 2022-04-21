<?php
/**
 * File DOC
 * 
 * @Description Header Include Page
 * @ChangeLog 
 *  - Vinícius Lessa - 12/04/2022: Mudanças Renata, e ajuste para SESSION do usuário.
 *  - Vinícius Lessa - 13/04/2022: Ajuste das URLs dos elementos <a>. Adição da página 'NewPost' referente a inclusão de novos anúncios.
 * 
 * @ Notes: 
 * 
 */

?>

<header class="mb-3 mt-2">
  <div class="col-12 col-sm-12">
  <div class="row">
    <!-- <header class="py-3"> -->
      
      <div class="col-12 col-sm-4 d-flex justify-content-center">
      <a href="<?php echo SITE_URL ?>/Views/homepage/index.php" class="d-flex align-items-center mb-md-0 me-md-auto text-dark text-decoration-none">
        <img src="<?php echo SITE_URL ?>/images/icon.png" alt="ícone MTC" width="50" height="50">
      </a>
      </div>

      <div class="col-12 col-sm-8 d-flex justify-content-start">
      <ul class="nav nav-pills">
        <li class="nav-item"><a href="<?php echo SITE_URL ?>/Views/homepage/index.php" class="border-button nav-link text-white" aria-current="page">Home</a></li>
        <li class="nav-item"><a href="<?php echo SITE_URL ?>/Views/trade_posts/new_post.php" class="border-button nav-link text-white" aria-current="page">Anunciar</a></li>
        <li class="nav-item"><a href="<?php echo SITE_URL ?>/Views/trade_posts/home.php" class="border-button nav-link text-white">Anúncios</a></li>
        <li class="nav-item"><a href="<?php echo SITE_URL ?>/Views/feed_musical/home.php" class="border-button nav-link text-white">Feed Musical</a></li>
        <li class="nav-item"><a href="<?php echo SITE_URL ?>/Views/music_trade_center/home.php" class="border-button nav-link text-white">Music Trade Center</a></li>
        <?php if (isset($_SESSION['user_id']) && isset($_SESSION['user_name']) && isset($_SESSION['user_email']) ): ?>
          <li class="nav-item"><a href="<?php echo SITE_URL ?>/Controllers/c_user.php/?signOut=true" class="border-button nav-link text-white">Sair</a></li>
          <li class="nav-item"><a href="<?php echo SITE_URL ?>/Views/users/user_profile.php" class="border-button nav-link text-white">Meu Perfil</a></li>
        <?php else:  ?>
          <li class="nav-item"><a href="<?php echo SITE_URL ?>/Views/users/sign_up.php" class="border-button nav-link text-white">Cadastrar</a></li>
          <li class="nav-item"><a href="<?php echo SITE_URL ?>/Views/users/sign_in.php" class="border-button nav-link text-white">Entrar</a></li>          
        <?php endif;  ?>        
      </ul>
      </div>

    <!-- </header> -->
  </div>
  </div>
</header>