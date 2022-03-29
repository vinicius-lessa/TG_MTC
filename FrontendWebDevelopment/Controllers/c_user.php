<?php
    if (!defined('SITE_URL')) {
        include_once '../config.php';
    }

    include SITE_PATH . '/Models/m_user.php';


    // ###### SingUp
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

        /*
        // Check recived values        
        
            $string=implode(",",$data);
            echo $string;
            var_dump($data);

            echo "<br><hr><br>";
            
            var_dump(userCreation($data));
        */        

        $aResponse = userCreation($data);        

        if ($aResponse['retorno']) {
            header("location:" . SITE_URL . "/Views/users/returnSuccess.php");
        } else {
            $msgErro = $aResponse['mensagem'];
            header("location:" . SITE_URL . "/Views/users/returnFailed.php?error=$msgErro");
        }
    }

    // ###### SingIn
    if (isset($_POST['signIn'])) {
        $usuario = userValidation($_POST['email'], $_POST['senha']);
        // var_dump($usuario);
        if ($usuario) {
            session_start();
            $_SESSION['email'] = $usuario['email'];
            $_SESSION['nome_cliente'] = $usuario['nome_cliente'];
            $_SESSION['cod_cliente'] = $usuario['cod_cliente'];
            header("location:" . SITE_URL . "/Views/home/index.php");
        } else {
            header("location:" . SITE_URL . "/Views/users/SignIn.php");
        }
    }

    if (isset($_GET['sair'])) {
        session_start();
        session_destroy();
        header("location:" . SITE_URL . "/Views/home/index.php");
    }

    // *****************************************************************************************************


    /* LISTAR CLIENTES */
    if (isset($listarClientes)) {
        $listarClientes = listarClientes($conn);
    }   

?>