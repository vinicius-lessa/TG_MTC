<?php
  /* 
  4 SEMESTRE - SISTEMAS PARA INTERNET
  Author: Vinícius Lessa da Silva / Anderson Nascimento
  Since: 2020/06/19
  */

  if (!defined('SITE_URL')) {
      include_once '../../config.php';
  }

  $titlePage = "Cadastrar Produto";
  $selectgenero = [];
  $selectcategoria = [];

  require SITE_PATH . '/Controllers/c_trade_posts.php';
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="stylesheet" href="<?php echo SITE_URL ?>/css/bootstrap.min.css">
  <link rel="stylesheet" href="<?php echo SITE_URL ?>/css/style.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.css">

  <title><?php $titlePage;?></title>
</head>
<?php require SITE_PATH . '/includes/menu-adm.php';?>

<body>
  <div class="container mt-5">
    <div class="row justify-content-md-center text-center">
      <h1>Cadastrar Novo Produto</h1> <!--MUDEI-->
    </div>
    <div class="row justify-content-md-center mt-3">
      <div class="col-md-6">
        <form class="" enctype="multipart/form-data" action='<?php echo SITE_URL ?>/Controllers/c_trade_posts.php' method="post">
          <div class="form-group mb-3">
            <label for="nome_prod">Nome Produto:</label>
            <input class="form-control input-adm" type="text" name="nome_prod" placeholder="Nome Produto">
          </div>
          <div class="form-group mb-3">
            <label for="descricao_prod">Descrição do Produto</label>
            <input class="form-control input-adm" type="text" name="descricao_prod" placeholder="Descrição do Produto">
          </div>
          <div class="form-group mb-3">
            <label for="valor_un">Valor do Produto:</label>
            <input class="form-control input-adm" type="text" name="valor_un" placeholder="Valor R$">
          </div>
          <div class="form-group mb-3">
            <label for="data-lacamento">Data de lançamento:</label>
            <input class="form-control input-adm" type="date" name="data_lancamento">
          </div>
          <div class="form-group mb-3">
            <label for="cover_img">Imagem do Produto:</label>
            <input class="form-control input-adm" type="file" name="cover_img" placeholder="Anexar imagem">
          </div>
          <div class="form-group  mb-3">
            <label for="banner_img">Banner do Produto:</label>
            <input class="form-control input-adm" type="file" name="banner_img" placeholder="Anexar imagem">
          </div>
          <div class="form-group  mb-3">
            <label for="estoque">Quantidade do Produto:</label>
            <input class="form-control input-adm" type="number" name="estoque" placeholder="Quantidade">
          </div>
          <div class="form-check input-adm">
            <label for="destaque" class="pl-2">Produto em Destaque?</label><br>
            <input class=" input-destaque" type="radio" name="destaque" id="destaque1" value="1">
            <label class="form-check-label " for="destaque">Sim </label><br>
            <input class="input-destaque" type="radio" name="destaque" id="destaque0" value="0">
            <label class=" mb-2" for="destaque">Não</label>
          </div><br>
          <div class="form-group  mb-3">
            <label for="categoria">Categoria</label>
            <select class="form-control input-adm" name="cod_categoria" id="cod_categoria">
              <option value="">Selecione Categoria</option>
              <?php foreach ($selectcategoria as $itemcategoria) {?>
                <option value="<?php echo $itemcategoria['cod_categoria'] ?>"><?php echo $itemcategoria['nome_categoria'] ?></option>
              <?php };?>
            </select>
          </div>

          <div class="input-group d-flex justify-content-center">
            <input type="hidden" class="btn btn-dark btn-block btn-comprar">
            <input class="btn btn-dark btn-block btn-adm mx-2 col-3" type="submit" value="Cadastrar" name="cadastrar-produto" id="cadastrar-produto">
            <input class="btn btn-dark btn-block btn-adm mx-2 col-3" type="reset" value="Limpar" id="limpar">
            <a class="btn btn-dark btn-block btn-adm mx-2 col-3" href="./prod-index.php">Cancelar</a>
          </div>
        </form>
      </div>
    </div>
  </div>
</body>
<?php require SITE_PATH . '/includes/footer-adm.php';?>

</html>