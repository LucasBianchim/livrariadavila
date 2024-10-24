<?php

    require_once('../conexao/conecta.php');

    if(!isset($_SESSION)){
        session_start();
        
    }

    if(isset($_POST['usuario'])&& $_POST['usuario'] != '' &&
    isset($_POST['senha']) && $_POST['senha'] != ''){

        $usuario = mysqli_real_escape_string($conexao, $_POST['usuario']);
        $senha = mysqli_real_escape_string($conexao, $_POST['senha']);

        $sql = "SELECT * FROM funcionario WHERE usuario = '$usuario' and senha = '$senha'";
        $resultado = mysqli_query($conexao, $sql);
        $linha = mysqli_fetch_assoc($resultado);


        if(isset($linha)){
            $_SESSION['ID'] = $linha ['codigo_funcionario'];
            $_SESSION['USER'] = $linha['usuario'];
            //NUNCA ARMAZENAR SENHA
            $_SESSION['PSWD'] = $linha['senha'];
            $_SESSION['TYPE'] = $linha['tipo_acesso'];

            

            if($_SESSION['TYPE'] === '1'){
            header('Location: admin.php');
            }
            else{
            header('Location: index.php');
            $_SESSION['naoAutorizado'] = "Apenas usuários Administradores podem acessar esta seção do site!";
            }

        }
        else{
            $_SESSION['loginErro'] = "Usuário ou senha inválidos!";
            header('Location: index.php');
        }

        
    }

    else{
        $_SESSION['loginVazio'] = "Informe usuário e senha!";
        header('Location: index.php');
    }



?>