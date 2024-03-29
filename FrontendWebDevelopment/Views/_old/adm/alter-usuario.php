<?php
/* 
4 SEMESTRE - SISTEMAS PARA INTERNET
Author: Vinícius Lessa da Silva / Anderson Nascimento
Since: 2020/06/19
*/
if (!defined('SITE_URL')) {
  include_once '../../config.php';
}

$titlePage = "Alterar Usuário";

$alter_usuario = $_GET['log'];
$id_usuario    = $_GET['usuario'];

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

  <title><?php echo $titlePage; ?></title>
</head>

<body>
  <?php require SITE_PATH . '/includes/menu-adm.php'; ?>
  <div class="container col-8 mt-5 pt-3 pb-5 ">
    <div class="row justify-content-md-center text-center">
      <h1>Alterar Usuario: <?php echo $alter_usuario; ?></h1>
    </div>
    <div class="row justify-content-md-center mt-3">
      <div class="col-md-6">
        <form action='<?php echo SITE_URL ?>/Controllers/c_usuario.php' method="post">
          <div class="form-group mb-3">
            <label for="log">Usuário:</label>
            <input class="form-control input-adm" type="text" name="log" placeholder="Novo Log" value="<?php echo $alter_usuario; ?>">
            <input class="form-control input-adm" type="hidden" name="cod_usuario" value="<?php echo $id_usuario; ?>">

          </div>
          <div class="form-row">
            <div class="form-group col-6 mb-3">
              <label for="senha">Senha:</label>
              <input class="form-control input-adm" type="password" name="senha" placeholder="Senha">
            </div>
            <div class="form-group col-6 mb-3">
              <label for="password">Confirmar senha:</label>
              <input class="form-control input-adm" type="password" placeholder="Confirmar Senha">
            </div>
          </div>
          <div class="d-flex justify-content-center">
            <input class="btn btn-dark btn-block " type="hidden">
            <input class="btn btn-dark btn-block btn-adm mx-2 col-3" type="submit" value="Alterar" name="alterar-usuario" id="alterar-usuario">
            <a class="btn btn-dark btn-block btn-adm mx-2 col-3" href="./index.php">Cancelar</a>
          </div>
        </form>
      </div>
    </div>
  </div>
</body>
<?php require SITE_PATH . '/includes/footer-adm.php'; ?>


</html>