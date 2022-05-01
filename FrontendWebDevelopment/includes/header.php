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
      <ul class="navbar-nav">
        <li class="nav-item mx-1">
          <li class="nav-link active d-flex justify-content-center btn-navbar"><a href="<?php echo SITE_URL ?>/Views/homepage/index.php" class="border-button nav-link text-white" aria-current="page">Home</a></li>
        </li>
        <li class="nav-item mx-1">
          <li class="nav-link active d-flex justify-content-center btn-navbar"><a href="<?php echo SITE_URL ?>/Views/trade_posts/new_post.php" class="border-button nav-link text-white" aria-current="page">Anunciar</a></li>
        </li>
        <li class="nav-item mx-1">
          <li class="nav-link active d-flex justify-content-center btn-navbar"><a href="<?php echo SITE_URL ?>/Views/trade_posts/home.php" class="border-button nav-link text-white" aria-current="page">Anúncios</a></li>
        </li>
        <li class="nav-item mx-1">
          <li class="nav-link active d-flex justify-content-center btn-navbar"><a href="<?php echo SITE_URL ?>/Views/feed_musical/home.php" class="border-button nav-link text-white" aria-current="page">Feed Musical</a></li>
        </li>
        <li class="nav-item mx-1">
          <li class="nav-link active d-flex justify-content-center btn-navbar"><a href="<?php echo SITE_URL ?>/Views/music_trade_center/home.php" class="border-button nav-link text-white" aria-current="page">Music Trade Center</a></li>
        </li>


        <!-- Logged -->
        <?php if (isset($_SESSION['user_id']) && isset($_SESSION['user_name']) && isset($_SESSION['user_email']) ): ?>
          <li class="nav-item mx-1">
            <li class="nav-link active d-flex justify-content-center btn-navbar">
              <a href="<?php echo SITE_URL ?>/Views/users/chat.php/" class="border-button nav-link text-white" aria-current="page">                
                <span class="px-1">Chats</span>
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-chat-fill" viewBox="0 0 16 16">
                  <path d="M8 15c4.418 0 8-3.134 8-7s-3.582-7-8-7-8 3.134-8 7c0 1.76.743 3.37 1.97 4.6-.097 1.016-.417 2.13-.771 2.966-.079.186.074.394.273.362 2.256-.37 3.597-.938 4.18-1.234A9.06 9.06 0 0 0 8 15z"/>
                </svg>
              </a>
            </li>
          </li>

          <!-- Dropdown -->
          <li class="nav-item dropdown mx-1">
            <a class="nav-link dropdown-toggle d-flex justify-content-center" data-bs-toggle="dropdown" href="#" role="button" aria-expanded="false">
              <?php echo $_SESSION['user_name']; ?>
              <?php if ( isset($_SESSION['profile-pic']) ): ?> 
                <img src="<?php echo $_SESSION['profile-pic'] ?>" class="img-fluid rounded-circle" alt="" style="margin-left:5px;max-width:100%;width:30px;height:30px;object-fit:cover;">
              <?php else: ?>
                <img src="<?php echo SITE_URL ?>/images/icons/default-profile-img.png" class="img-fluid rounded-circle" alt="" style="margin-left:5px;max-width:100%;width:30px;height:30px;object-fit:cover;">
              <?php endif; ?>
              <!-- <img src="<?php echo SITE_URL ?>/images/IMAGENS/ARTISTAS/ARTISTA3.jpg" class="img-fluid rounded-circle" alt="" style="margin-left:5px;max-width:100%;width:30px;height:30px;object-fit:cover;"> -->
            </a>
            <ul class="dropdown-menu">
              <li><a class="dropdown-item" href="<?php echo SITE_URL ?>/Views/users/user_profile.php/?key=about">Meu Pefil</a></li>
              <li><a class="dropdown-item" href="<?php echo SITE_URL ?>/Views/users/user_profile.php/?key=trade_posts">Meus Anúncios</a></li>
              <li><a class="dropdown-item" href="<?php echo SITE_URL ?>/Views/users/user_profile.php/?key=config">Configurações</a></li>
              <li><hr class="dropdown-divider"></li>
              <li><a class="dropdown-item" href="<?php echo SITE_URL ?>/Controllers/c_user.php/?signOut=true">Sair</a></li>
            </ul>
          </li>          

        <!-- Unlogged -->
        <?php else:  ?>
          <li class="nav-item mx-1">
            <li class="nav-link active d-flex justify-content-center btn-navbar"><a href="<?php echo SITE_URL ?>/Views/users/sign_in.php" class="border-button nav-link text-white" aria-current="page">Entrar</a></li>
          </li>
          <li class="nav-item mx-1">
            <li class="nav-link active d-flex justify-content-center btn-signUp"><a href="<?php echo SITE_URL ?>/Views/users/sign_up.php" class="border-button nav-link text-white" aria-current="page">Comerçar</a></li>          
          </li>
        <?php endif; ?>        

      </ul>
    </div>

  </div>
</nav>