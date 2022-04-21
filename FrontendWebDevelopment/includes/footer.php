<?php
/**
 * File DOC
 * 
 * @Description Footer Include Page
 * @ChangeLog 
 *  - Vinícius Lessa - 13/04/2022: Inclusão da documentação de cabeçalho. Ajuste das URLs dos elementos <a>.
 * 
 * @ Notes: 
 * 
 */

?>

<footer>
  <div class="container mt-5">
    <div class="d-flex justify-content-center py-3">
      <ul class="nav col-12 col-md-auto justify-content-center mb-md-0">
        <!-- <li class="nav-item"><a href="#" class="nav-link" aria-current="page">Home</a></li> -->
        <li class="nav-item"><a href="<?php echo SITE_URL ?>/Views/about/home.php" class="nav-link border-button text-white">Quem Somos</a></li>
        <li class="nav-item"><a href="<?php echo SITE_URL ?>/Views/feed_musical/home.php" class="nav-link border-button text-white">Feed Musical</a></li>
        <li class="nav-item"><a href="<?php echo SITE_URL ?>/Views/music_trade_center/home.php" class="nav-link border-button text-white">Music Trade Center</a></li>
      </ul>
    </div>
    <hr class="my-3">
  </div>

  <div class="container">
    <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-md-between py-3">
      <a href="<?php echo SITE_URL ?>/Views/about/home.php" class="d-flex align-items-center col-md-3 mb-2 mb-md-0 text-dark text-decoration-none"><img src="<?php echo SITE_URL ?>/images/icon.png" class="img-fluid" alt="" width="45px" height="45px"></a>

      <ul class="nav col-12 col-md-auto mb-2 justify-content-center mb-md-0">
        <li><a href="https://www.facebook.com/" class="nav-link px-4 link-secondary"><img src="<?php echo SITE_URL ?>/images/IMAGENS/ÍCONES/facebook-alterado-branco.png" class="img-fluid" alt="" width="25px" height="25px"></a></li>
        <li><a href="https://www.instagram.com/" class="nav-link px-4 link-secondary"><img src="<?php echo SITE_URL ?>/images/IMAGENS/ÍCONES/instagram-alterado-branco.png" class="img-fluid" alt="" width="25px" height="25px"></a></li>
        <li><a href="https://twitter.com/" class="nav-link px-4 link-secondary"><img src="<?php echo SITE_URL ?>/images/IMAGENS/ÍCONES/twitter-alterado-branco.png" class="img-fluid" alt="" width="25px" height="25px"></a></li>
      </ul>

      <div class="col-md-4">
        <span class="text-gray">© 2020 - 2022 Copyright</span> <br />
        <a class="text-white" href="<?php echo SITE_URL ?>/Views/about/home.php">Music Trade Center</a>
      </div>

    </div>
    <hr>
  </div>  
</footer>