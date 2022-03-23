<?php
    if (!defined('SITE_URL')) {
      include_once '../../config.php';
    }

    $titlePage = "MTC | Cadastro";
?>

<!DOCTYPE html>
<html lang="pt-br" class="h-100">
  <head>
    <meta charset='utf-8'>    
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>

    <!-- Page Data -->
    <meta name="author" content="Vinícius Lessa / Iuri Ferreira">
    <meta name="description" content="Página de criação de cadastro por parte do usuário do sistema.">
    <title> <?php echo $titlePage; ?> </title>
    
    <!-- StyleSheet -->
    <link rel="stylesheet" href="<?php echo SITE_URL ?>/css/bootstrap/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo SITE_URL ?>/css/style.css">
    
    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="<?php echo SITE_URL ?>/images/icon.png"> 

    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="<?php echo SITE_URL ?>/js/bootstrap.bundle.min.js"></script>
  </head>

  <body class="d-flex flex-column h-100 bk-preto font-main">
    
    <!-- Header Include -->
    <?php include SITE_PATH .'/includes/header.php';?>
    
    <!-- Begin page content -->
    <main>
      <div class="container">
        
        <!-- Title -->
        <div class="text-center">
          <h2 class="text-white">Criar Conta</h2>
        </div>
        
        <!-- Form -->
        <div class="form-default ">
          <form id="singUp-form" action='<?php echo SITE_URL ?>/Controllers/c_user.php' method="post">
            <div class="form-floating">
              <input type="text" class="form-control" placeholder="Nome" id="userName" name="username">
              <label for="userName">Nome</label>
            </div>

            <div>
              <small class="text-lightred" id='nameAlert'></small>
            </div>

            <div class="form-floating">
              <input type="email" class="form-control" placeholder="name@example.com" id="userEmail" name="email">
              <label for="userEmail">E-mail</label>
            </div>

            <div>
              <small class="text-lightred" id='emailAlert'></small>
            </div>

            <div class="form-floating">
              <input type="password" class="form-control" placeholder="Senha" id="userPassword" name="password">
              <label for="userPassword">Senha</label>
            </div>

            <div class="text-center text-white mt-5 mb-3">
              <h3>Outras Informações</h3>
            </div>              

            <div class="form-floating">
              <input type="date" class="form-control" placeholder="01/10/2000" id="userBirthday" name="birthday">
              <label for="userBirthday">Data Nascimento</label>
            </div>

            <div class="form-floating">
              <input type="tel" class="form-control" placeholder="(11)XXXX-XXXX" id="userPhone" name="phone">
              <label for="userPhone">Telefone/Celular</label>
            </div>

            <!-- Tornar REQUERIDO via JS -->
            <div class="form-floating">
              <select class="form-select pt-3 pb-3" name="persontype" id="userType">
                <option selected>Tipo Pessoa</option>
                <option value="F">Física</option>
                <option value="J">Jurídica</option>
              </select>
            </div>

            <div class="form-floating">
              <input type="text" class="form-control" placeholder="18100-000" id="userZipCode" name="cep">
              <label for="userZipCode">CEP</label>
            </div>

            <div class="text-center">
              <input class="submit-btn btn-default btn" type="submit" value="Criar!" name="signUp" id="signUp">
            </div>

            <div class="mt-5 text-white text-center">
              <span>Já possui conta?
                <a href="<?php echo SITE_URL ?>/Views/users/SignIn.php">Entrar</a>
              </span>
            </div>
          </form>
        </div>
      </div>
    </main>

    <!-- footer site -->
    <?php include SITE_PATH .'/includes/footer.php';?>
  </body>
    
  <!-- Scripts -->
  <script src="<?php echo SITE_URL ?>/js/main.js"></script>
</html>