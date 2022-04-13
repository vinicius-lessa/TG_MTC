<?php
/**
 * File DOC
 * 
 * @Description Página para inserção de anúncios por parte do usuário. Os dados aqui preenchidos dever ser inseridos na tabela `trade_posts`
 * @ChangeLog 
 *  - Vinícius Lessa - 13/04/2022: Inclusão da documentação de cabeçalho do arquivo. Mudanças inicias baseadas no antigo arquivo "Anunciar.php";
 * 
 * @ Notes: 
 * 
 */

if (session_status() === PHP_SESSION_NONE) {
  session_start();
}

if (!defined('SITE_URL')) {
  include_once '../../config.php';
}

$titlePage = 'Anunciar';

$selectCategory = [];
$selectBrand    = [];
$selectModel    = [];
$selectColor    = [];

// require SITE_PATH . '/Controllers/c_produto.php';

?>

<!DOCTYPE html>
<html lang="pt-br" class="h-100">
  <head>
  <meta charset='utf-8'>    
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>

    <!-- Page Data -->
    <meta name="author" content="Vinícius Lessa / Renata Carrillo">
    <meta name="description" content="Página para inserção de anúncios por parte do usuário. Os dados aqui preenchidos dever ser inseridos na tabela `trade_posts`.">
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

    <main>
      <div class="container">
        
      <?php if (isset($_SESSION['user_id']) && isset($_SESSION['user_name']) && isset($_SESSION['user_email']) ): ?>        
        
        <div class="text-center mt-4">
          <h2 class="text-white">Informações do Anúncio</h2>
        </div>

        <div class="row justify-content-md-center text-white mt-4">
          <div class="col-md-6">
            <form id="insertTP-form" enctype="multipart/form-data" action='<?php echo SITE_URL ?>/Controllers/c_tradePosts.php' method="post">
              
              <span id="msgAlertErroLogin"></span>
              
              <!-- Title / Título do Anúncio -->
              <div class="form-group">
                <label class="mb-2" for="title">Título</label>
                <input class="form-control" type="text" name="title">
              </div>

              <!-- Category / Categoria do Item -->
              <div class="form-group">
                <label class="mb-2" for="category">Categoria</label>
                <select class="form-select" name="category" id="category">
                  <option value="">Selecione a Categoria</option>
                  <?php foreach ($selectCategory as $itemcategoria) {?>
                    <option value="<?php echo $itemcategoria['category_id'] ?>"><?php echo $itemcategoria['description'] ?></option>
                  <?php };?>                  
                </select>
              </div>

              <!-- Brand / Marca do Item -->
              <div class="form-group">
                <label class="mb-2" for="brand">Marca</label>
                <select class="form-select" name="brand" id="brand">
                  <option value="">Selecione a Marca</option>
                  <?php foreach ($selectBrand as $itemBrand) {?>
                    <option value="<?php echo $itemBrand['brand_id'] ?>"><?php echo $itemBrand['description'] ?></option>
                  <?php };?>                  
                </select>
              </div>

              <!-- Model / Modelo do Item -->
              <div class="form-group">
                <label class="mb-2" for="model">Modelo</label>
                <select class="form-select" name="model" id="model">
                  <option value="">Selecione o Modelo</option>
                  <?php foreach ($selectModel as $itemModel) {?>
                    <option value="<?php echo $itemModel['model_id'] ?>"><?php echo $itemModel['description'] ?></option>
                  <?php };?>               
                </select>
              </div>

              <!-- Color / Cor do Item -->
              <div class="form-group">
                <label class="mb-2" for="color">Cor do Equipamento</label>
                <select class="form-select" name="color" id="color">
                  <option value="">Selecione a Cor</option>
                  <?php foreach ($selectColor as $itemColor) {?>
                    <option value="<?php echo $itemColor['color_id'] ?>"><?php echo $itemColor['description'] ?></option>
                  <?php };?>               
                </select>
              </div>              
              
              <!-- Price / Valor do Produto -->
              <div class="form-group">
                <label class="mb-2" for="price">Valor do Produto</label>                
                <input class="form-control money" type="text" name="price" id="price" placeholder="0,00" aria-label="Valor" aria-describedby="basic-addon1">
              </div>

              <div class="form-group">
                <label class="mb-2" for="description">Descrição do Anúncio</label>
                <textarea class="form-control" type="text" name="description" id="description" rows="3"></textarea>
              </div>

              <!-- Product Condition / Estado de Uso -->
              <div class="form-group mt-4 mb-5">
                <div class="mb-2">
                  <span>Estado de Uso</span>
                </div>
                
                <div class="row m-0 p-0">
                  <div class="col-sm m-0">
                    <div class="form-check">
                      <input class="form-check-input" type="radio" name="productCondition" id="productCondition1" value="option1" checked>
                      <label class="form-check-label" for="productCondition1">
                        Produto Novo
                      </label>
                    </div>
                  </div>
                  <div class="col-sm m-0">
                    <div class="form-check">
                      <input class="form-check-input" type="radio" name="productCondition" id="productCondition2" value="option2">
                      <label class="form-check-label" for="productCondition2">
                        Usado, estado de Novo
                      </label>
                    </div>
                  </div>
                </div>
                <div class="row m-0 p-0">
                  <div class="col-sm m-0">
                    <div class="form-check">
                      <input class="form-check-input" type="radio" name="productCondition" id="productCondition3" value="option3">
                      <label class="form-check-label" for="productCondition3">
                        Usado, com detalhes
                      </label>
                    </div>
                  </div>                  
                  <div class="col-sm m-0">
                      <div class="form-check">
                        <input class="form-check-input" type="radio" name="productCondition" id="productCondition4" value="option4">
                        <label class="form-check-label" for="productCondition4">
                          Para Restauração/Reuso
                        </label>
                      </div>
                    </div>
                </div>
              </div>

              <!-- Possui NF? -->
              <div class="form-group mt-4 mb-5">
                <div class="mb-2">
                  <span>Possui Nota Fiscal?</span>
                </div>
                
                <div class="row m-0 p-0">
                  <div class="col-3 m-0">
                    <div class="form-check">
                      <input class="form-check-input" type="radio" name="possuiNF" id="possuiNF1" value="option1" checked>
                      <label class="form-check-label" for="possuiNF1">
                        Sim
                      </label>
                    </div>
                  </div>
                  <div class="col-3 m-0">
                    <div class="form-check">
                      <input class="form-check-input" type="radio" name="possuiNF" id="possuiNF2" value="option2">
                      <label class="form-check-label" for="possuiNF2">
                        Não
                      </label>
                    </div>
                  </div>
                </div>
              </div>              

              <!-- Image Upload -->
              <div class="form-group">
                <label class="mb-2" for="cover_img">Imagem do Produto</label>
                <input class="form-control" type="file" name="cover_img" onchange="readURL(this);">
                <img id="imagePreview1" src="#" />
              </div>              

              <div class="d-flex justify-content-center mt-5">
                <input class="btn btn-default btn-block btn-adm mx-2 col-3" type="submit" value="Anunciar!" name="insertTradePost" id="insertTradePost">
                <!-- <input class="btn btn-default btn-block btn-adm mx-2 col-3" type="reset" value="Limpar" id="limpar"> -->
              </div>
            </form>
          </div>
        </div>            
      
      <?php else:
        // Login necessário para acessar essa página
        header("location:" . SITE_URL . "/Views/users/SignIn.php");
        
      endif;  
      ?>

      </div>
    </main>

    <!-- Footer Include -->
    <?php include SITE_PATH . '/includes/footer.php'; ?>    
  
    <!-- Scripts -->    
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> <!-- jQuery Include -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.15/jquery.mask.min.js"></script> <!-- jQuery - Máscara para Inputs -->
    <script src="<?php echo SITE_URL ?>/js/bootstrap.bundle.min.js"></script>
    <script src="<?php echo SITE_URL ?>/js/main.js"></script>
  </body>

</html>