<?php
include("../../banco/banco-funcionarios.php");
include("../../conexao.php");
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Login </title>
        <link href="../../css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
        <meta charset="utf-8"> 
    </head>
    <body>
        <div class="container">
            <h1>Login </h1>
            <hr>
            <br>
            <form method="Post">

                Nome: <input class="form-control" type="text" name="txtemail">
                <br>
                <br>
                Senha: <input class="form-control" type="password" name="txtsenha">
                <br>
                <br>
                <input class="btn btn-success" type="submit" value="Entrar">
            </form>

            <?php
            if ($_POST)
            {

                $nome = $_POST['txtemail'];
                $senha = $_POST['txtsenha'];

                if(login($conexao, $nome, $senha))
                {
                    session_start();

                    $_SESSION ['nome'] = $nome;
                    $_SESSION ['loginADM'] = 'logado';
                    header('location:../Painel.php');
                }
                else
                {
                    ?> 
                    <br>
                    <div class="alert alert-danger" role="alert" id="alerta">Usuario ou Senha Invalídas !
                    </div>
                    <?php
                }
            }
            ?>

        </div>

    </body>
</html>