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

<header class="mb-5">
  <div class="container">
    <header class="d-flex flex-wrap justify-content-center py-3">
      
      <a href="<?php echo SITE_URL ?>/Views/homepage/index.php" class="d-flex align-items-center mb-md-0 me-md-auto text-dark text-decoration-none">
        <img src="../../images/icon.png" alt="ícone MTC" width="50" height="50">
      </a>

      <ul class="nav nav-pills">
        <li class="nav-item"><a href="<?php echo SITE_URL ?>/Views/homepage/index.php" class="border-button nav-link text-white" aria-current="page">Home</a></li>
        <li class="nav-item"><a href="<?php echo SITE_URL ?>/Views/trade_posts/NewPost.php" class="border-button nav-link text-white" aria-current="page">Anunciar</a></li>
        <li class="nav-item"><a href="<?php echo SITE_URL ?>/Views/trade_posts/TradePosts.php" class="border-button nav-link text-white">Anúncios</a></li>
        <li class="nav-item"><a href="<?php echo SITE_URL ?>/Views/trade_posts/FeedMusical.php" class="border-button nav-link text-white">Feed Musical</a></li>
        <li class="nav-item"><a href="<?php echo SITE_URL ?>/Views/trade_posts/MusicTradeCenter.php" class="border-button nav-link text-white">Music Trade Center</a></li>
        <?php if (isset($_SESSION['user_id']) && isset($_SESSION['user_name']) && isset($_SESSION['user_email']) ): ?>
          <li class="nav-item"><a href="<?php echo SITE_URL ?>/Controllers/c_user.php/?signOut=true" class="border-button nav-link text-white">Sair</a></li>
          <li class="nav-item"><a href="<?php echo SITE_URL ?>/Views/users/MyProfile.php" class="border-button nav-link text-white">Meu Perfil</a></li>
        <?php else:  ?>
          <li class="nav-item"><a href="<?php echo SITE_URL ?>/Views/users/SignUp.php" class="border-button nav-link text-white">Cadastrar</a></li>
          <li class="nav-item"><a href="<?php echo SITE_URL ?>/Views/users/SignIn.php" class="border-button nav-link text-white">Entrar</a></li>          
        <?php endif;  ?>        
      </ul>

    </header>
  </div>