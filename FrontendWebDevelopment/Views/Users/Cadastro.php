<?php
  if (!defined('SITE_URL')) {
    include_once '../../config.php';
  }

  $titlePage = "Cadastro";
?>

<!DOCTYPE html>
<html lang="pt-br" class="h-100">
  <head>
    <meta charset='utf-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <meta name="description" content="">
    <meta name="author" content="">
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>

    <link href="<?php echo SITE_URL ?>/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo SITE_URL ?>/css/style.css">
    <link rel="icon" type="image/x-icon" href="<?php echo SITE_URL ?>/images/favicon.ico">

    <title> 
      <?php echo $titlePage; ?>
    </title>

    <script src='<?php echo SITE_URL ?>/js/main.js'></script>
  </head>

  <body class="d-flex flex-column h-100">
    <!-- menu do site -->
    <?php include SITE_PATH .'/includes/menu.php';?>

    <h1>Olá</h1>
    
    <!-- Begin page content -->
    <main>
      <div class="container text-center">
        
      <!-- Title -->
        <div class="mt-4">
          <h2>Crie Sua Conta Aqui!</h2>
        </div>
        
        <!-- Form -->
        <div class="form-cadastro rounded">
          <form action='<?php echo SITE_URL ?>/Controllers/c_cliente.php' method="post">
            <div class="form-floating">
              <input type="text" class="form-control" id="floatingInput" placeholder="Nome" name="nomeUsuario" required>
              <label for="floatingInput">Nome</label>
            </div>

            <div class="form-floating">
              <input type="email" class="form-control" id="floatingInput" placeholder="name@example.com" name="email" required>
              <label for="floatingInput">Endereço de E-mail</label>
            </div>

            <div class="form-floating">
              <input type="password" class="form-control" id="floatingInput" placeholder="Senha" name="tipoPessoa" required>
              <label for="floatingInput">Senha</label>
            </div>

            <div class="mt-5 mb-3">
              <h3>Outras Informações</h3>
            </div>              

            <div class="form-floating">
              <input type="text" class="form-control" id="floatingInput" placeholder="01/10/2000" name="birthday" required>
              <label for="floatingInput">Data Nascimento</label>
            </div>

            <div class="form-floating">
              <input type="text" class="form-control" id="floatingInput" placeholder="(11)XXXX-XXXX" name="phone">
              <label for="floatingInput">Telefone/Celular</label>
            </div>

            <div class="form-floating">
              <input type="text" class="form-control" id="floatingInput" placeholder="F" name="tipoPessoa" required>
              <label for="floatingInput">Tipo Pessoa</label>
            </div>

            <div class="form-floating">
              <input type="text" class="form-control" id="floatingInput" placeholder="18100-000" name="cep">
              <label for="floatingInput">CEP</label>
            </div>

            <input class="btn btn-dark btn-adm botao-cadastro box-search font-weight-bold mt-5 mb-5" type="submit" value="Confirmar" name="cadastrar" id="criar">

            <div class="mb-3 mt-3 text-center px-md-3">
              <p>Já possui conta?
                <a href="<?php echo SITE_URL ?>/Views/Users/Login.php">Entrar</a>
              </p>
            </div>            
          </form>
        </div>
      </div>
    </main>

    <!-- footer site -->
    <?php include SITE_PATH .'/includes/footer.php';?>
  </body>
</html>