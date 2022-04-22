<?php
/**
 * File DOC
 * 
 * @Description Header Include Page
 * @ChangeLog 
 *  - Vinícius Lessa - 12/04/2022: Mudanças Renata, e ajuste para SESSION do usuário.
 *  - Vinícius Lessa - 13/04/2022: Ajuste das URLs dos elementos <a>. Adição da página 'NewPost' referente a inclusão de novos anúncios.
 *  - Renata Carrillo - 21/04/2022: Ajuste no Header pós mudança no Bootstrap.
 * 
 * @ Notes: 
 * 
 */

?>

<nav class="navbar navbar-expand-lg navbar-dark">
  <div class="container-fluid">

    <div class="col-4 d-flex justify-content-center">
    <a class="navbar-brand" href="<?php echo SITE_URL ?>/Views/homepage/index.php" class="mb-md-0 me-md-auto text-dark text-decoration-none">
      <img src="<?php echo SITE_URL ?>/images/icon.png" alt="ícone MTC" width="50" height="50">
    </a>
    </div>

    <button class="navbar-toggler" style="border-width:2px;" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="col-8 collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <li class="nav-link active btn-efeito-hover"><a href="<?php echo SITE_URL ?>/Views/homepage/index.php" class="border-button nav-link text-white" aria-current="page">Home</a></li>
        </li>
        <li class="nav-item">
          <li class="nav-link active btn-efeito-hover"><a href="<?php echo SITE_URL ?>/Views/trade_posts/new_post.php" class="border-button nav-link text-white" aria-current="page">Anunciar</a></li>
        </li>
        <li class="nav-item">
          <li class="nav-link active btn-efeito-hover"><a href="<?php echo SITE_URL ?>/Views/trade_posts/home.php" class="border-button nav-link text-white" aria-current="page">Anúncios</a></li>
        </li>
        <li class="nav-item">
          <li class="nav-link active btn-efeito-hover"><a href="<?php echo SITE_URL ?>/Views/feed_musical/home.php" class="border-button nav-link text-white" aria-current="page">Feed Musical</a></li>
        </li>
        <li class="nav-item">
          <li class="nav-link active btn-efeito-hover"><a href="<?php echo SITE_URL ?>/Views/music_trade_center/home.php" class="border-button nav-link text-white" aria-current="page">Music Trade Center</a></li>
        </li>


        <li class="nav-item">
        <?php if (isset($_SESSION['user_id']) && isset($_SESSION['user_name']) && isset($_SESSION['user_email']) ): ?>
          <li class="nav-link active btn-efeito-hover"><a href="<?php echo SITE_URL ?>/Controllers/c_user.php/?signOut=true" class="border-button nav-link text-white">Sair</a></li>
          <li class="nav-link active btn-efeito-hover"><a href="<?php echo SITE_URL ?>/Views/users/user_profile.php" class="border-button nav-link text-white">Meu Perfil</a></li>
        <?php else:  ?>
          <li class="nav-link active btn-efeito-hover"><a href="<?php echo SITE_URL ?>/Views/users/sign_up.php" class="border-button nav-link text-white">Cadastrar</a></li>
          <li class="nav-link active btn-efeito-hover"><a href="<?php echo SITE_URL ?>/Views/users/sign_in.php" class="border-button nav-link text-white">Entrar</a></li>          
        <?php endif;  ?> 
        </li>

      </ul>
    </div>

  </div>
</nav>