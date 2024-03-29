<?php
/* 
4 SEMESTRE - SISTEMAS PARA INTERNET
Author: Vinícius Lessa da Silva / Anderson Nascimento
Since: 2020/06/19
*/
if(!defined('SITE_URL')){
include_once '../../config.php';
}
$titlePage = "Excluído!";

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

  <title>
    Tcm.com | <?php echo $titlePage ;?>
  </title>
</head>

<body>
  <!-- Header Include -->
  <?php include SITE_PATH .'/includes/header.php';?>
<body>
  <div class="container mt-5 ">
    <div class="row justify-content-md-center mt-5 mb-5 ">
      <div class="col-md-9 text-center rounded quadro-sucess">
        <h1>Usuário Excluído!</h1>
        <p>Click <a href="../home/index.php">aqui</a> para voltar a home do site</p>
      </div>
    </div>
  </div>
</body>

</html>