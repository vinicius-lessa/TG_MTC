<?php
/**
 * File DOC
 * 
 * @Description Página para inserção de anúncios por parte do usuário. Os dados aqui preenchidos dever ser inseridos na tabela `trade_posts`
 * @ChangeLog 
 *  - Vinícius Lessa - 13/04/2022: Inclusão da documentação de cabeçalho do arquivo. Mudanças inicias baseadas no antigo arquivo "Anunciar.php";
 *  - Vinícius Lessa - 16/04/2022: Mudanças importantes na implementação do envio do formulário;
 *  - Vinícius Lessa - 01/05/2022: Implementação da Atualização do Anúncio utilizando a mesma estrutura com condicionais.
 *  - Vinícius Lessa - 02/05/2022: Continuação da Implementação do CRUD para atualizar o Anúncio, porém no mesmo processo, estou adicionando a opção de Colocar até 3 fotos por Anúncio.
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

include_once '../../defaultFunctions.php';

// Vars

$isLoggedUser     = (isset($_SESSION['user_id']) && isset($_SESSION['user_name']) && isset($_SESSION['user_email'])) ? true : false;
$tradePostAction  = $_GET["action"];
$isUpdate         = false; // Default is False

// Only Logged In
if ( !$isLoggedUser ):  
  header("location:" . SITE_URL . "/Views/users/sign_in.php");
endif;

// Info About TP
if ( $tradePostAction == "update" ):
  $post_id      = $_GET['post_id'];
endif;

$selectCategory = [];
$selectBrand    = [];
$selectModel    = [];
$selectColor    = [];

require SITE_PATH . '/Controllers/c_trade_posts.php';

if ( isset($post_id) && isset($tpDetails) ):
  
  $isOwnPost    = $tpDetails["data"][0]["user_id"] === $_SESSION['user_id'];
  $isUpdate     = true;

  if ( !$isOwnPost ):
    $requestError = true; // Do Not suppose to be here
  endif;

endif;

$titlePage = isset($tpDetails['data'][0]['title']) ? $tpDetails['data'][0]['title'] : "Novo Anúncio";

if ( 
    ( $selectCategory["error"] || $selectBrand["error"] || $selectModel["error"] || $selectColor["error"] ) ||
    ( !isset($selectCategory) || !isset($selectBrand) || !isset($selectModel) || !isset($selectColor) )
    ):

  $requestError = true; // *** Tratar Depois
endif;


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
    <!-- <link rel="stylesheet" href="<?php echo SITE_URL ?>/css/bootstrap/bootstrap.min.css"> --> <!-- Get Bootstrap -->
    <link rel="stylesheet" href="<?php echo SITE_URL ?>/css/bootstrap/bootstrap.css"> <!-- Get Bootstrap -->    
    <!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css"> --> <!-- Icons -->
    <link rel="stylesheet" href="<?php echo SITE_URL ?>/css/style.css">
        
    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="<?php echo SITE_URL ?>/images/icon.png">

    <script type="text/javascript">

      // These vars are called in 'profile.js'
      var user_id   = <?php echo $_SESSION['user_id']; ?>;
      var isUpdate  = <?php echo ( $isUpdate ? "true" : "false" ); ?>;

    </script>

  </head>

  <body class="d-flex flex-column h-100 bk-black font-main">
    
    <!-- Header Include -->
    <?php include SITE_PATH . '/includes/header.php'; ?>    

    <!-- Loading Animation -->
    <div class='spinner-wrapper'>
      <div class="spinner"></div>
    </div>

    <main>
      <div class="container">
      
      <!-- Problemas ao Consultar valores dos campos SELECT -->
      <!-- Error on Request to Server? No -->
      <?php if ( !$requestError ): ?>        
          
        <div class="text-center mt-4">          
          <h2 class="text-white"><?php echo $isUpdate ? "Atualizar Anúncio" : "Novo Anúncio" ?></h2>
        </div>

        <div class="row justify-content-md-center text-white mt-4">
          <div class="col-md-6">
            <form id="newTradePost-form" enctype="multipart/form-data" action='<?php echo SITE_URL ?>/Controllers/c_tradePosts.php' method="post">
              
              <span id="msgAlertErroPost"></span>
              
              <!-- Title / Título do Anúncio -->
              <div class="form-group">
                <label class="mb-2" for="title">Título</label>
                <input class="form-control" type="text" name="title" id="title" autocomplete="off" value="<?php echo $isUpdate ? $tpDetails['data'][0]['title'] : ""  ?>">
              </div>

              <!-- Category / Categoria do Item -->
              <div class="form-group">
                <label class="mb-2" for="category">Categoria</label>
                <select class="form-select" name="category" id="category" onchange="changeCategory();">
                  <option value="default">Selecione a Categoria</option>
                  <?php foreach ($selectCategory["data"] as $itemcategoria) {?>
                    
                    <!-- New TP -->
                    <?php if ( !$isUpdate ): ?>                      
                      <option value="<?php echo $itemcategoria['category_id'] ?>"><?php echo $itemcategoria['description'] ?></option>

                    <!-- Update TP -->
                    <?php else:?>                                            
                      <option value="<?php echo $itemcategoria['category_id'] ?>" <?php echo ($itemcategoria['category_id'] == $tpDetails['data'][0]['category_id'] ? "selected='selected'" : "") ; ?>><?php echo $itemcategoria['description'] ?></option>
                      
                    <?php endif;?>

                  <?php };?>
                </select>
              </div>

              <!-- Brand / Marca do Item -->
              <div class="form-group">
                <label class="mb-2" for="brand">Marca</label>
                <select class="form-select" name="brand" id="brand" onchange="changeBrand();">
                  <option value="default">Selecione a Marca</option>
                  <?php foreach ($selectBrand["data"] as $itemBrand) {?>

                    <!-- New TP -->
                    <?php if ( !$isUpdate ): ?>                      
                      <option value="<?php echo $itemBrand['brand_id'] ?>"> <?php echo $itemBrand['description'] ?> </option>

                    <!-- Update TP -->
                    <?php else:?>
                      <option value="<?php echo $itemBrand['brand_id'] ?>" <?php echo ($itemBrand['brand_id'] == $tpDetails['data'][0]['brand_id'] ? "selected='selected'" : "") ; ?>><?php echo $itemBrand['description'] ?></option>                      
                      
                    <?php endif;?>
                    
                  <?php };?>
                </select>
              </div>

              <!-- Model / Modelo do Item -->
              <div class="form-group">
                <label class="mb-2" for="model">Modelo</label>
                <select class="form-select" name="model" id="model" onchange="changeModel();">
                  <option value="default">Selecione o Modelo</option>
                  <?php foreach ($selectModel["data"] as $itemModel) {?>

                    <!-- New TP -->
                    <?php if ( !$isUpdate ): ?>                      
                      <option value="<?php echo $itemModel['model_id'] ?>"><?php echo $itemModel['description'] ?></option>

                    <!-- Update TP -->
                    <?php else:?>
                      <option 
                        value="<?php echo $itemModel['model_id'] ?>" 
                        <?php echo ($itemModel['model_id'] == $tpDetails['data'][0]['model_id'] ? "selected='selected'" : "") ; ?>>
                          <?php echo $itemModel['description'] ; ?>
                      </option>

                    <?php endif;?>
                    
                    <h1>
                      <?php echo $itemModel['model_id'] ; ?>
                    </h1>

                  <?php };?>                    
                </select>
              </div>

              <!-- Color / Cor do Item -->
              <div class="form-group">
                <label class="mb-2" for="color">Cor do Equipamento</label>
                <select class="form-select" name="color" id="color">
                  <option value="default">Selecione a Cor</option>                    
                  <?php foreach ($selectColor["data"] as $itemColor) {?>

                    <!-- New TP -->
                    <?php if ( !$isUpdate ): ?>                      
                      <option value="<?php echo $itemColor['color_id'] ?>"><?php echo $itemColor['description'] ?></option>

                    <!-- Update TP -->
                    <?php else:?>
                      <option 
                        value="<?php echo $itemColor['color_id'] ?>"
                        <?php echo ($itemColor['color_id'] == $tpDetails['data'][0]['color_id'] ? "selected='selected'" : "") ; ?>>
                          <?php echo $itemColor['description'] ?>
                      </option>

                    <?php endif;?>                    
                    
                  <?php };?>
                </select>
              </div>              
              
              <!-- Price / Valor do Produto -->
              <div class="form-group">
                <label class="mb-2" for="price">Valor do Produto</label>                
                <input class="form-control money" type="text" name="price" id="price" placeholder="0,00" aria-label="Valor" aria-describedby="basic-addon1" value="<?php echo $isUpdate ? $tpDetails['data'][0]['price'] : ""  ?>">
              </div>

              <div class="form-group">
                <label class="mb-2" for="description">Descrição do Anúncio</label>
                <textarea class="form-control" type="text" name="description" id="description" rows="3"><?php echo $isUpdate ? $tpDetails['data'][0]['tp_desc'] : "" ?></textarea>
              </div>

              <!-- Product Condition / Estado de Uso -->
              <div class="form-group mt-4 mb-5">
                <div class="mb-2">
                  <span>Estado de Uso</span>
                </div>
                
                <div class="row m-0 p-0">
                  <div class="col-sm m-0">
                    <div class="form-check">
                      <?php if ( !$isUpdate ): ?>
                        <input class="form-check-input" type="radio" name="p_condition" id="p_condition1" value="1" checked>
                      <?php else: ?>
                        <input 
                          class="form-check-input" 
                          type="radio" 
                          name="p_condition" 
                          id="p_condition1" 
                          value="1" 
                          <?php echo ($tpDetails['data'][0]['condition_id'] == "1" ? "checked" : "") ; ?>
                        >
                      <?php endif; ?>
                      <label class="form-check-label" for="p_condition1">
                        Produto Novo
                      </label>
                    </div>
                  </div>
                  <div class="col-sm m-0">
                    <div class="form-check">
                      <input class="form-check-input" type="radio" name="p_condition" id="p_condition2" value="2">
                      <label class="form-check-label" for="p_condition2">
                        Usado, estado de Novo
                      </label>
                    </div>
                  </div>
                </div>
                <div class="row m-0 p-0">
                  <div class="col-sm m-0">
                    <div class="form-check">
                      
                      <?php if ( !$isUpdate ): ?>
                        <input class="form-check-input" type="radio" name="p_condition" id="p_condition3" value="3">
                      <?php else: ?>
                        <input 
                          class="form-check-input" 
                          type="radio" 
                          name="p_condition" 
                          id="p_condition1" 
                          value="1" 
                          <?php echo ($tpDetails['data'][0]['condition_id'] == "3" ? "checked" : "") ; ?>
                        >
                      <?php endif; ?>
                      
                      <label class="form-check-label" for="p_condition3">
                        Usado, com detalhes
                      </label>
                    </div>
                  </div>                  
                  <div class="col-sm m-0">
                      <div class="form-check">
                        <input class="form-check-input" type="radio" name="p_condition" id="p_condition4" value="4">
                        <label class="form-check-label" for="p_condition4">
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
                      
                      <?php if ( !$isUpdate ): ?>
                        <input class="form-check-input" type="radio" name="possuiNF" id="possuiNF1" value="1" checked>
                      <?php else: ?>
                        <input class="form-check-input" type="radio" name="possuiNF" id="possuiNF1" value="1" <?php echo ($tpDetails['data'][0]['eletronic_invoice'] == "1" ? "checked" : "") ; ?>>
                      
                      <?php endif; ?>
                      
                      <label class="form-check-label" for="possuiNF1">
                        Sim
                      </label>
                    </div>
                  </div>
                  <div class="col-3 m-0">
                    <div class="form-check">
                      
                      <?php if ( !$isUpdate ): ?>
                        <input class="form-check-input" type="radio" name="possuiNF" id="possuiNF2" value="0">
                      <?php else: ?>
                        <input class="form-check-input" type="radio" name="possuiNF" id="possuiNF1" value="0" <?php echo ($tpDetails['data'][0]['eletronic_invoice'] == "0" ? "checked" : "") ; ?>>
                      
                      <?php endif; ?>                      
                      
                      <label class="form-check-label" for="possuiNF2">
                        Não
                      </label>
                    </div>
                  </div>
                </div>
              </div>              

              <!-- Image Upload -->
              <div class="form-group">

                <p class="mb-2" for="">Fotos do Item/Produto</p>
                <!-- <input class="form-control" accept="image/*" type="file" name="image-upload" id="image-upload"> -->
                
                <!-- Image Preview -->
                <div class="row mt-4 px-3">

                  <!-- 1 -->
                  <div class="col-12 col-sm-4 text-center px-2">
                    <div class="image-preview-box row p-1" id="image-preview-box-one">
                      
                      <?php if ( !$isUpdate || ($isUpdate && !isset($tpDetails['data'][0]['image_name']))  ): ?>

                        <!-- Default Text -->
                        <div class="image-preview-text m-0" style="margin: auto;">
                          <button type="button" class="tradePostImage-Button">
                            <label for="image-upload-one" class="label-default">
                              <div class="m-0">
                                Image Upload
                              </div>

                              <div class="m-0">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-plus-circle" viewBox="0 0 16 16">
                                  <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                                  <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z"/>
                                </svg>
                              </div>
                            </label>
                          </button>
                          <input type="file" name="image-upload-one" id="image-upload-one" style="display: none;">
                        </div> 

                      <?php else: ?>

                        <?php if ( validateImageSource($tpDetails['data'][0]['image_name']) ): ?>

                          <!-- Image ifself -->
                          <div class="img-newTP-upload position-relative h-100 p-0">

                            <!-- Blur -->
                            <div class="img-default-content img_background_blur m-0" style="background-image: url('<?php echo $tpDetails["data"][0]["image_name"] ?>');">
                            </div>

                            <!-- Image  -->
                            <div class="img-default-content m-0">
                              <img
                              src="<?php echo $tpDetails['data'][0]['image_name'] ; ?>" 
                              class="img-tag-tp-default" 
                              alt=""
                              >
                            </div>
                          </div>

                        <?php else: ?>

                          <!-- Image ifself -->
                          <div class="img-newTP-upload position-relative h-100 m-0 p-0">

                            <!-- Image  -->
                            <div class="img-default-content m-0">
                              <img src="<?php echo SITE_URL ?>/images/icons/no-image-icon.png" class="img-tag-tp-default" alt="" style="">
                            </div>
                          </div>

                        <?php endif; ?>

                      <?php endif; ?>

                    </div>
                  </div>

                  <!-- 2 -->
                  <div class="col-12 col-sm-4 text-center px-2">
                    <div class="image-preview-box row p-1" id="image-preview-box-two">

                      <?php if ( !$isUpdate || ($isUpdate && !isset($tpDetails['data'][1]['image_name']))  ): ?>

                        <!-- Default Text -->
                        <div class="image-preview-text m-0" style="margin: auto;">
                          <button type="button" class="tradePostImage-Button">
                            <label for="image-upload-two" class="label-default">
                              <div class="m-0">
                                Image Upload
                              </div>

                              <div class="m-0">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-plus-circle" viewBox="0 0 16 16">
                                  <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                                  <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z"/>
                                </svg>
                              </div>
                            </label>
                          </button>
                          <input type="file" name="image-upload-two" id="image-upload-two" style="display: none;">
                        </div> 

                      <?php else: ?>

                        <?php if ( validateImageSource($tpDetails['data'][1]['image_name']) ): ?>

                          <!-- Image ifself -->
                          <div class="img-newTP-upload position-relative h-100 p-0">

                            <!-- Blur -->
                            <div class="img-default-content img_background_blur m-0" style="background-image: url('<?php echo $tpDetails["data"][1]["image_name"] ?>');">
                            </div>

                            <!-- Image  -->
                            <div class="img-default-content m-0">
                              <img
                              src="<?php echo $tpDetails['data'][1]['image_name'] ; ?>"
                              class="img-tag-tp-default" 
                              alt=""
                              >
                            </div>
                          </div>

                        <?php else: ?>

                          <!-- Image ifself -->
                          <div class="img-newTP-upload position-relative h-100 p-0">

                            <!-- Image  -->
                            <div class="img-default-content m-0">
                              <img src="<?php echo SITE_URL ?>/images/icons/no-image-icon.png" class="img-tag-tp-default" alt="" style="">
                            </div>
                          </div>

                        <?php endif; ?>

                      <?php endif; ?>

                    </div>
                  </div>

                  <!-- 3 -->
                  <div class="col-12 col-sm-4 text-center px-3">
                    <div class="image-preview-box row p-0" id="image-preview-box-three">

                      <?php if ( !$isUpdate || ($isUpdate && !isset($tpDetails['data'][2]['image_name']))  ): ?>

                        <!-- Default Text -->
                        <div class="image-preview-text m-0" style="margin: auto;">
                          <button type="button" class="tradePostImage-Button">
                            <label for="image-upload-three" class="label-default">
                              <div class="m-0">
                                Image Upload
                              </div>

                              <div class="m-0">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-plus-circle" viewBox="0 0 16 16">
                                  <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                                  <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z"/>
                                </svg>
                              </div>
                            </label>
                          </button>
                          <input type="file" name="image-upload-three" id="image-upload-three" style="display: none;">
                        </div> 

                      <?php else: ?>

                        <?php if ( validateImageSource($tpDetails['data'][2]['image_name']) ): ?>

                          <!-- Image ifself -->
                          <div class="img-newTP-upload position-relative h-100 p-0">

                            <!-- Blur -->
                            <div class="img-default-content img_background_blur m-0" style="background-image: url('<?php echo $tpDetails["data"][2]["image_name"] ?>');">
                            </div>

                            <!-- Image  -->
                            <div class="img-default-content m-0">
                              <img
                              src="<?php echo $tpDetails['data'][2]['image_name'] ; ?>" 
                              class="img-tag-tp-default" 
                              alt=""
                              >
                            </div>
                          </div>

                        <?php else: ?>

                          <!-- Image ifself -->
                          <div class="img-newTP-upload position-relative h-100 m-0 p-0">

                            <!-- Image  -->
                            <div class="img-default-content m-0">
                              <img src="<?php echo SITE_URL ?>/images/icons/no-image-icon.png" class="img-tag-tp-default" alt="" style="">
                            </div>
                          </div>

                        <?php endif; ?>

                      <?php endif; ?>

                    </div>
                  </div>

                </div>
              </div>

              <!-- Submit Button -->
              <div class="d-flex justify-content-center mt-5">
                <input class="btn btn-default btn-block btn-adm mx-2 col-3" type="submit" value=<?php echo ($isUpdate ? "Atualizar" : "Anunciar!"); ?> name="newTradePost" id="newTradePost">
                <!-- <input class="btn btn-default btn-block btn-adm mx-2 col-3" type="reset" value="Limpar" id="limpar"> -->
              </div>
            </form>
          </div>
        </div>                          

      <!-- Error on Request to Server? Yes -->
      <?php else: ?>

        <div class="container text-center text-white">
          <div class="row">
            <div class="col-12 my-5">
              <h1 class=""><strong>Página Não encontrada!</strong></h1>
            </div>

            <div class="col-12 my-5">
              <h5 class="">Sentimos muito pelo inconveniente. Tivemos problemas na busca pelos dados necessários.</h5>
              <p> <?php echo $profileDetails["msg"] ?></p>
            </div>

            <div class="col-12 my-5">
              <h3>¯\_(ツ)_/¯</h3>
            </div>
          </div>
        </div>

      <!-- Error on Request to Server? End -->
      <?php endif; ?>

      </div>
    </main>

    <!-- Footer Include -->
    <?php include SITE_PATH . '/includes/footer.php'; ?>    
  
    <!-- Scripts -->    
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>    
    <script src="<?php echo SITE_URL ?>/js/bootstrap.bundle.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.15/jquery.mask.min.js"></script> <!-- jQuery - Máscara para Inputs -->    
    <script src="<?php echo SITE_URL ?>/js/tradepost.js"></script>    

  </body>

</html>