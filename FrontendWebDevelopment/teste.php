<?php
if (!defined('SITE_URL')) {
    include_once 'config.php';
}
  
?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href="<?php echo SITE_URL ?>/css/bootstrap/bootstrap.css"> <!-- Get Bootstrap -->
    <link rel="stylesheet" href="<?php echo SITE_URL ?>/css/style.css">
    <!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous"> -->

    <title>Página de TESTE</title>
  </head>

  <body class="d-flex flex-column h-100 bk-black font-main" class="" style="height: 1000px;">

    <div class="container bk-white" style="height: 1000px;">
        <main class="">
            <div class="row d-flex justify-content-center">
                <div class="col-12 p-2">

                    <div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">
                        <div class="carousel-inner">
                            <div class="carousel-item active">
                                <div class="col-12 p-0 image-container-new" id="tradepost-img-container">
                                    <!-- Blur -->
                                    <div class="img-default-content img_background_blur" style="background-image: url('http://localhost/TG_MTC/BackendDevelopment/uploads/imagem-2022-05-03_4091.jpg');">
                                    </div>

                                    <!-- Image  -->
                                    <div class="img-default-content">
                                    <img src="http://localhost/TG_MTC/BackendDevelopment/uploads/imagem-2022-05-03_4091.jpg" class="img-tag-tp-default" alt="">
                                    </div>
                                </div>
                            </div>
                            <div class="carousel-item">
                                <div class="col-12 p-0 image-container-new" id="tradepost-img-container">
                                    <!-- Blur -->
                                    <div class="img-default-content img_background_blur" style="background-image: url('http://localhost/TG_MTC/BackendDevelopment/uploads/imagem-2022-05-03_2233.jpg');">
                                    </div>

                                    <!-- Image  -->
                                    <div class="img-default-content">
                                    <img src="http://localhost/TG_MTC/BackendDevelopment/uploads/imagem-2022-05-03_2233.jpg" class="img-tag-tp-default" alt="">
                                    </div>
                                </div>
                            </div>
                            <div class="carousel-item">
                                <div class="col-12 p-0 image-container-new" id="tradepost-img-container">
                                    <!-- Blur -->
                                    <div class="img-default-content img_background_blur" style="background-image: url('http://localhost/TG_MTC/BackendDevelopment/uploads/imagem-2022-05-01_7070.jpg');">
                                    </div>

                                    <!-- Image  -->
                                    <div class="img-default-content">
                                    <img src="http://localhost/TG_MTC/BackendDevelopment/uploads/imagem-2022-05-01_7070.jpg" class="img-tag-tp-default" alt="">
                                    </div>
                                </div>                                
                            </div>
                        </div>
                        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="prev" style="z-index: 12 ;">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Previous</span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="next" style="z-index: 12 ;">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Next</span>
                        </button>
                    </div>
                    
                </div>
            </div>
        </main>
    </div>
    
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="<?php echo SITE_URL ?>/js/bootstrap.bundle.js"></script>

  </body>
</html>