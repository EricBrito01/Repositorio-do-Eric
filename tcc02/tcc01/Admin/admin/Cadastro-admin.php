<!DOCTYPE html>
<?php
SESSION_start();
if (empty($_SESSION['loginADM']))
{
    header('location:Login-admin.php');
}
?>
<html>
    <head>
     <title>Cadastro de Usuário</title>
        <link href="../../css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
        <meta charset="utf-8"> 
        <meta HTTP-EQUIV='refresh' CONTENT='20'>
    </head>
    <body>
        <div class="container">
            <?php
             echo 'Bem vindo,' . $_SESSION['adm'] . ' ';
            ?>
            <a  style="margin-left: 1%;"href="../Logout.php">Sair</a>
            <br><br>
        </div>
         <div style="float: left;">
         <ul>
            <li>Produto</li>
            <ul>
                <li><a href="../Produto/Cadastro-produto.php">Cadastrar</a></li>
                <li><a href="../Produto/Listar-produto.php">Listar</a></li>
            </ul>
        </ul>
        <ul>
            <li>Venda</li>
            <ul>
            <li><a href="../Venda/Listar-vendas.php">Listar(<?php
                                                                include("./../../conexao.php");
                                                                include("../../banco/vendas-admin.php");
                                                                
                                                                echo ContarVendas($conexao);
                                                                ?>)</a></li>
            </ul>
        </ul>
        <ul>
            <li>Cliente</li>
            <ul>
                <li><a href="../cliente/Listar-clientes.php">Listar</a></li>
            </ul>
        </ul>
        <ul>
            <li>Funcionário</li>
            <ul>
                <li><a href="../admin/Cadastro-admin.php">Cadastrar</a></li>
                <li><a href="../admin/Listar-admin.php">Listar</a></li>
            </ul>
        </ul>
        <ul>
            <li>Fornecedor</li>
            <ul>
                <li><a href="../fornecedor/Cadastro-fornecedor.php">Cadastrar</a></li>
                <li><a href="../fornecedor/Listar-fornecedores.php">Listar</a></li>
            </ul>
        </ul>
        </div>
        
        <div class="container" style="margin-left:15%;">
            <h1>Cadastrar Funcionário</h1>
            <hr>
            <br>
            <form method="post">

                Nome: <input class="form-control" type="text" name="txtnome">
                <br>
                <br>
                Senha: <input class="form-control" type="password" name="txtsenha">
                <br>
                <br>
                <input class="btn btn-success" type="submit" name="btncadastrar" value="Cadastrar">
            </form>

                       
                <?php
                
                include("../../banco/banco-funcionarios.php");

                if ($_POST) 
                {
                    $nome_admin = $_POST['txtnome'];
                    $senha_admin = $_POST['txtsenha'];

                    if (cadastrarAdmin($conexao, $nome_admin, $senha_admin)) 
                    {
                        
                    ?>
                    <br>
                    <div class="alert alert-success" role="alert" id="alerta">Cadastrado com Sucesso !
                    </div>
                    <?php
                    } 

                    else 
                    {
                      ?> 
                    <br>
                    <div class="alert alert-danger" role="alert" id="alerta">Informações Invalídas !
                    </div>
                    <?php
                    }
                }
                ?>
        
    </body>
</html>
