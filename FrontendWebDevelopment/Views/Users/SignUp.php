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
    <link rel="icon" type="image/x-icon" href="<?php echo SITE_URL ?>/images/icon.png">

    <title> 
      <?php echo $titlePage; ?>
    </title>

    <script src='<?php echo SITE_URL ?>/js/main.js'></script>
  </head>

  <body class="d-flex flex-column h-100 bk-preto">
    
    <!-- Header Include -->
    <?php include SITE_PATH .'/includes/header.php';?>
    
    <!-- Begin page content -->
    <main>
      <div class="container text-center">
        
        <!-- Title -->
        <div>
          <h2 class="text-white">Criar Conta</h2>
        </div>
        
        <!-- Form -->
        <div class="form-cadastro rounded">
          <form action='<?php echo SITE_URL ?>/Controllers/c_user.php' method="post">
            <div class="form-floating mb-2">
              <input type="text" class="form-control" placeholder="Nome" id="floatingInput" name="nomeUsuario" required>
              <label for="floatingInput">Nome</label>
            </div>

            <div class="form-floating mb-2">
              <input type="email" class="form-control" placeholder="name@example.com" id="floatingInput" name="email" required>
              <label for="floatingInput">Endereço de E-mail</label>
            </div>

            <div class="form-floating mb-2">
              <input type="password" class="form-control" placeholder="Senha" id="floatingInput" name="password" required>
              <label for="floatingInput">Senha</label>
            </div>

            <div class="text-white mt-5 mb-3">
              <h3>Outras Informações</h3>
            </div>              

            <div class="form-floating mb-2">
              <input type="date" class="form-control" placeholder="01/10/2000" id="floatingInput" name="birthday" required>
              <label for="floatingInput">Data Nascimento</label>
            </div>

            <div class="form-floating mb-2">
              <input type="tel" class="form-control" placeholder="(11)XXXX-XXXX" id="floatingInput" name="phone">
              <label for="floatingInput">Telefone/Celular</label>
            </div>

            <div class="form-floating mb-2">
              <input list="tipoPessoa" class="form-control" placeholder="F" id="floatingInput" name="tipoPessoa" required>
              <label for="floatingInput">Tipo Pessoa</label>
              <datalist id="tipoPessoa">
                <option value="Física">
                <option value="Jurídica">
              </datalist>
            </div>

            <div class="form-floating mb-2">
              <input type="text" class="form-control" placeholder="18100-000" id="floatingInput" name="cep">
              <label for="floatingInput">CEP</label>
            </div>

            <input class="btn-default btn mt-5 mb-5" type="submit" value="Confirmar" name="signUp" id="criar">

            <div class="text-white mb-3 mt-3 text-center px-md-3">
              <p>Já possui conta?
                <a href="<?php echo SITE_URL ?>/Views/Users/SignIn.php">Entrar</a>
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