<?php
/* 
4 SEMESTRE - SISTEMAS PARA INTERNET
Author: Vinícius Lessa da Silva / Anderson Nascimento
Since: 2020/06/19
*/
if (!defined('SITE_URL')) {
  include_once '../../config.php';
}
session_start();
session_destroy();

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

  <title>Tmc.com</title>
</head>

<body>
  <!-- Header Include -->
  <?php include SITE_PATH.'/includes/menu-adm.php'; ?>
  <!--conteudo da pagina -->

  <div class="container col-8 mt-5 pt-3 pb-5 ">
    <div class="row justify-content-md-center text-center ">
      <h1>Novo Usuário</h1>
    </div>
    <div class="row justify-content-md-center mt-3">
      <div class="col-md-6">
        <form action='<?php echo SITE_URL ?>/Controllers/c_usuario.php' method="post">
          <div class="form-group mb-3">
            <label class="sr-only" for="nome_usuario">Nome:</label>
            <input class="form-control input-adm" type="text" name="nome_usuario" placeholder="Nome Completo">
          </div>
          <div class="form-group mb-3">
            <label class="sr-only" for="telefone">Telefone:</label>
            <input class="form-control input-adm" type="text" name="telefone" placeholder="Telefone">
          </div>
          <div class="form-group mb-3">
            <label class="sr-only" for="cpf">CPF:</label>
            <input class="form-control input-adm" type="text" name="cpf" placeholder="CPF">
          </div>
          <div class="form-group mb-3">
            <label class="sr-only" for="email">E-Mail:</label>
            <input class="form-control input-adm" type="text" name="email" placeholder="E-Mail">
          </div>
          <div class="form-group mb-3">
            <label class="sr-only" for="log">Login:</label>
            <input class="form-control input-adm" type="text" name="log" placeholder="Log">
          </div>
          <div class="form-row">
            <div class="form-group col-6 mb-3">
              <label class="sr-only" for="senha">Senha:</label>
              <input class="form-control input-adm" type="password" name="senha" placeholder="Senha">
            </div>
            <div class="form-group col-6 mb-3">
              <label class="sr-only" for="password">Confirmar senha:</label>
              <input class="form-control input-adm" type="password" placeholder="Confirmar Senha">
            </div>
          </div>
          <div class="d-flex justify-content-center">
            <input class="btn btn-dark btn-block " type="hidden">
            <input class="btn btn-dark btn-block btn-adm mx-2 col-3" type="submit" value="Cadastrar" name="cadastrar-usuario" id="cadastrar-usuario">
            <input class="btn btn-dark btn-block btn-adm mx-2 col-3" type="reset" value="Limpar" id="limpar">
            <a class="btn btn-dark btn-block btn-adm mx-2 col-3" href="./index.php">Cancelar</a>
          </div>
        </form>
      </div>
    </div>
  </div>


  <!-- footer site -->
  <?php include SITE_PATH.'/includes/footer-adm.php'; ?>
</body>

</html>