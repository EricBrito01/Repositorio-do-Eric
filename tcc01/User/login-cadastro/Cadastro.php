<?php
include("../../banco/banco-usuario.php");
include("../../conexao.php");
$verificar = rand(1000, 9000);
@session_start();
?>
<!DOCTYPE html>
<html>

<head>
    <title>Cadastro de Usuário</title>
    <link href="../../css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <meta charset="utf-8">
    <meta content='width=device-width, initial-scale=0.9' name='viewport'>
    <style>
        html {
            background-color: #56baed;
        }

        body {
            font-family: "Poppins", sans-serif;
            height: 100vh;
        }

        a {
            color: #92badd;
            display: inline-block;
            text-decoration: none;
            font-weight: 400;
        }

        h2 {
            text-align: center;
            font-size: 16px;
            font-weight: 600;
            text-transform: uppercase;
            display: inline-block;
            margin: 40px 8px 10px 8px;
            color: #cccccc;
        }



        /* STRUCTURE */

        .wrapper {
            display: flex;
            align-items: center;
            flex-direction: column;
            justify-content: center;
            width: 100%;
            min-height: 100%;
            padding: 20px;
        }

        #formContent {
            -webkit-border-radius: 10px 10px 10px 10px;
            border-radius: 10px 10px 10px 10px;
            background: #fff;
            padding: 30px;
            width: 90%;
            max-width: 450px;
            position: relative;
            padding: 0px;
            -webkit-box-shadow: 0 30px 60px 0 rgba(0, 0, 0, 0.3);
            box-shadow: 0 30px 60px 0 rgba(0, 0, 0, 0.3);
            text-align: center;
        }

        #formFooter {
            background-color: #f6f6f6;
            border-top: 1px solid #dce8f1;
            padding: 25px;
            text-align: center;
            -webkit-border-radius: 0 0 10px 10px;
            border-radius: 0 0 10px 10px;
        }



        /* TABS */

        h2.inactive {
            color: #cccccc;
        }

        h2.active {
            color: #0d0d0d;
            border-bottom: 2px solid #5fbae9;
        }



        /* FORM TYPOGRAPHY*/

        input[type=button],
        input[type=submit],
        input[type=reset] {
            background-color: #56baed;
            border: none;
            color: white;
            padding: 15px 80px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            text-transform: uppercase;
            font-size: 13px;
            -webkit-box-shadow: 0 10px 30px 0 rgba(95, 186, 233, 0.4);
            box-shadow: 0 10px 30px 0 rgba(95, 186, 233, 0.4);
            -webkit-border-radius: 5px 5px 5px 5px;
            border-radius: 5px 5px 5px 5px;
            margin: 5px 20px 40px 20px;
            -webkit-transition: all 0.3s ease-in-out;
            -moz-transition: all 0.3s ease-in-out;
            -ms-transition: all 0.3s ease-in-out;
            -o-transition: all 0.3s ease-in-out;
            transition: all 0.3s ease-in-out;
        }

        input[type=button]:hover,
        input[type=submit]:hover,
        input[type=reset]:hover {
            background-color: #39ace7;
        }

        input[type=button]:active,
        input[type=submit]:active,
        input[type=reset]:active {
            -moz-transform: scale(0.95);
            -webkit-transform: scale(0.95);
            -o-transform: scale(0.95);
            -ms-transform: scale(0.95);
            transform: scale(0.95);
        }

        input[type=text] {
            background-color: #f6f6f6;
            border: none;
            color: #0d0d0d;
            padding: 15px 32px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
            margin: 5px;
            width: 85%;
            border: 2px solid #f6f6f6;
            -webkit-transition: all 0.5s ease-in-out;
            -moz-transition: all 0.5s ease-in-out;
            -ms-transition: all 0.5s ease-in-out;
            -o-transition: all 0.5s ease-in-out;
            transition: all 0.5s ease-in-out;
            -webkit-border-radius: 5px 5px 5px 5px;
            border-radius: 5px 5px 5px 5px;
        }

        input[type=text]:focus {
            background-color: #fff;
            border-bottom: 2px solid #5fbae9;
        }

        input[type=text]:placeholder {
            color: #cccccc;
        }



        input[type=password] {
            background-color: #f6f6f6;
            border: none;
            color: #0d0d0d;
            padding: 15px 32px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
            margin: 5px;
            width: 85%;
            border: 2px solid #f6f6f6;
            -webkit-transition: all 0.5s ease-in-out;
            -moz-transition: all 0.5s ease-in-out;
            -ms-transition: all 0.5s ease-in-out;
            -o-transition: all 0.5s ease-in-out;
            transition: all 0.5s ease-in-out;
            -webkit-border-radius: 5px 5px 5px 5px;
            border-radius: 5px 5px 5px 5px;
        }

        input[type=password]:focus {
            background-color: #fff;
            border-bottom: 2px solid #5fbae9;
        }

        input[type=password]:placeholder {
            color: #cccccc;
        }



        /* ANIMATIONS */

        /* Simple CSS3 Fade-in-down Animation */
        .fadeInDown {
            -webkit-animation-name: fadeInDown;
            animation-name: fadeInDown;
            -webkit-animation-duration: 1s;
            animation-duration: 1s;
            -webkit-animation-fill-mode: both;
            animation-fill-mode: both;
        }

        @-webkit-keyframes fadeInDown {
            0% {
                opacity: 0;
                -webkit-transform: translate3d(0, -100%, 0);
                transform: translate3d(0, -100%, 0);
            }

            100% {
                opacity: 1;
                -webkit-transform: none;
                transform: none;
            }
        }

        @keyframes fadeInDown {
            0% {
                opacity: 0;
                -webkit-transform: translate3d(0, -100%, 0);
                transform: translate3d(0, -100%, 0);
            }

            100% {
                opacity: 1;
                -webkit-transform: none;
                transform: none;
            }
        }

        /* Simple CSS3 Fade-in Animation */
        @-webkit-keyframes fadeIn {
            from {
                opacity: 0;
            }

            to {
                opacity: 1;
            }
        }

        @-moz-keyframes fadeIn {
            from {
                opacity: 0;
            }

            to {
                opacity: 1;
            }
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
            }

            to {
                opacity: 1;
            }
        }

        .fadeIn {
            opacity: 0;
            -webkit-animation: fadeIn ease-in 1;
            -moz-animation: fadeIn ease-in 1;
            animation: fadeIn ease-in 1;

            -webkit-animation-fill-mode: forwards;
            -moz-animation-fill-mode: forwards;
            animation-fill-mode: forwards;

            -webkit-animation-duration: 1s;
            -moz-animation-duration: 1s;
            animation-duration: 1s;
        }

        .fadeIn.first {
            -webkit-animation-delay: 0.4s;
            -moz-animation-delay: 0.4s;
            animation-delay: 0.4s;
        }

        .fadeIn.second {
            -webkit-animation-delay: 0.6s;
            -moz-animation-delay: 0.6s;
            animation-delay: 0.6s;
        }

        .fadeIn.third {
            -webkit-animation-delay: 0.8s;
            -moz-animation-delay: 0.8s;
            animation-delay: 0.8s;
        }

        .fadeIn.fourth {
            -webkit-animation-delay: 1s;
            -moz-animation-delay: 1s;
            animation-delay: 1s;
        }

        /* Simple CSS3 Fade-in Animation */
        .underlineHover:after {
            display: block;
            left: 0;
            bottom: -10px;
            width: 0;
            height: 2px;
            background-color: #56baed;
            content: "";
            transition: width 0.2s;
        }

        .underlineHover:hover {
            color: #0d0d0d;
        }

        .underlineHover:hover:after {
            width: 100%;
        }



        /* OTHERS */

        *:focus {
            outline: none;
        }

        #icon {
            width: 60%;
        }
    </style>
</head>

<body>

    <div class="wrapper fadeInDown" style="background-color: #ed620c;">
        <div id="formContent">
            <!-- Tabs Titles -->
            <div class="container">
                <br>
                <h1 class="fadeIn first" style="text-align: center;">Cadastro de Usuário</h1>
                <hr>
                <br>
                <form method="post">

                    <input class="fadeIn second" type="text" name="txtnome" placeholder="Nome">
                    <br>
                    <input class="fadeIn third" type="text" name="txtcpf" Placeholder="CPF">
                    <br>
                    <input class="fadeIn second" type="text" name="txttel" Placeholder=" Telefone">
                    <br>
                    <input class="fadeIn third" type="text" name="txtendereco" Placeholder="Rua, Número da casa">
                    <br>
                    <input class="fadeIn second" type="text" name="txtcomplemento" Placeholder="Complemento (Opcional)">
                    <br>
                    <input class="fadeIn third" type="text" name="txtbairro" Placeholder="Bairro">
                    <br>
                    <input class="fadeIn second" type="text" name="txtcidade" Placeholder="Cidade">
                    <br>
                    <input class="fadeIn third" type="text" name="txtemail" Placeholder="Email">
                    <br>
                    <input class="fadeIn second" type="text" name="txtsenha" minlength="8" Placeholder="Senha">
                    <br>
                    <br>
                    <input class="fadeIn four" style="background-color: #ed620c;" type="submit" name="btncadastrar" value="Cadastrar">
                </form>

                <?php
                if ($_POST) {
                    $nome = $_POST['txtnome'];
                    $endereco = $_POST['txtendereco'];
                    $email = $_POST['txtemail'];
                    $senha = $_POST['txtsenha'];
                    $tel = $_POST['txttel'];
                    $bairro = $_POST['txtbairro'];
                    $cidade = $_POST['txtcidade'];
                    $cpf = $_POST['txtcpf'];
                    $complemento = $_POST['txtcomplemento'];

                    if ($complemento == null or $complemento == 0) {
                        $complemento = "SEM COMPLEMENTO";
                    }


                    if (validaCPF($cpf)) {

                        if (cadastrarCliente($conexao, $nome, $endereco, $email, $senha, $cpf, $bairro, $cidade, $tel, $complemento)) {

                            $_SESSION['confirmar'] = $verificar;
                            $to_email = $email;
                            $subject = "Confirmação de Email";
                            $headers  = 'MIME-Version: 1.0' . "\r\n";
                            $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
                            $headers .= 'From: MarketoHome <$email>';
                            $arquivo = " 
                                    <html>
                                        <div style='text-align: center;margin-top: 10%;background-color: whitesmoke;width: 60%;margin-left: 20%;height: 300px;border-radius: 15px'> 
                                            <br>
                                            <h1>MarkeToHome</h1>
                                            <hr>
                                            <br>
                                            <h3>Confirmação de Email :</h3>
                                            <h2 style='text-align: center;margin-top: 10%;background-color: whitesmoke;width: 60%;margin-left: 20%;height: 300px;border-radius: 15px'>$verificar</h2>
                                            </div>
                                    </html>
                                    ";
                            if (mail($to_email, $subject, $arquivo, $headers)) {
                                echo "<script>window.location.href = 'verificar.php'</script>";
                            } else {
                                echo "Falha no envio do email.";
                            }
                        } else {
                            ?>
                            <br>
                            <div class="alert alert-danger" role="alert" id="alerta">Informações Invalídas !
                            </div>
                            <?php
                        }
                    } else {
                        ?>
                        <br>
                        <div class="alert alert-danger" role="alert" id="alerta">CPF Inválido !
                        </div>
                <?php
                    }
                }

                ?>
            </div>

            <div id="formFooter">
                Possui Cadastro ? <a href="Login.php">Entre Aqui</a>
            </div>
        </div>
    </div>
</body>

</html>