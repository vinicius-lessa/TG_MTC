<?php
    if (!defined('SITE_URL')) {
        include_once '../config.php';
    }

    include SITE_PATH . '/Models/m_cliente.php';

    /* Recebe POST do FORM */
    if (isset($_POST['signUp'])) {
        $data = [];
        foreach ($_POST as $key => $value) {
            if ($key != "signUp") {
                if ($key == "password") {
                    $data[$key] = password_hash($value, PASSWORD_DEFAULT);
                } else {
                    $data[$key] = $value;
                }
            }
        }

        echo "<pre>" . var_dump($data['email']) . "</pre>";

        // if (userCreation($data)) {
        //     header("location:" . SITE_URL . "/Views/Users/returnSuccess.php");
        // } else {
        //     $msgErro = "Ocorreu um erro para cadastrar o usuario no banco, tente novamente";
        //     header("location:" . SITE_URL . "/Views/home/PaginaErro.php?erro=$msgErro");
        // }
    }

    // *****************************************************************************************************


    /* LISTAR CLIENTES */
    if (isset($listarClientes)) {
        $listarClientes = listarClientes($conn);
    }

    /* Verificar se o usuario existe no banco para poder acessar o sistema */
    if (isset($_POST['acessar'])) {
        $usuario = validarUsuario($_POST['email'], $_POST['senha'], $conn);
        // var_dump($usuario);
        if ($usuario) {
            session_start();
            $_SESSION['email'] = $usuario['email'];
            $_SESSION['nome_cliente'] = $usuario['nome_cliente'];
            $_SESSION['cod_cliente'] = $usuario['cod_cliente'];
            header("location:" . SITE_URL . "/Views/home/index.php");
        } else {
            header("location:" . SITE_URL . "/Views/Clientes/loginCliente.php");
        }
    }

    if (isset($_GET['sair'])) {
        session_start();
        session_destroy();
        header("location:" . SITE_URL . "/Views/home/index.php");
    }

    // $conn->close();

?>