<!DOCTYPE html>
<?php
SESSION_start();
if (empty($_SESSION['loginADM'])) {
    header('location:admin/Login-admin.php');
}

?>
<html>

<head>
    <meta HTTP-EQUIV='refresh' CONTENT='3'>
    <meta charset="UTF-8">
    <title></title>
    <link href="../css/bootstrap.min.css" rel="stylesheet" type="text/css" />

</head>

<body>
    <div class="container">
        <?php
        echo 'Bem vindo,' . $_SESSION['adm'] . ' ';

        //ContarVendas($conexao); 
        ?>
        <a style="margin-left: 1%;" href="Logout.php">Sair</a>
    </div>
    <div class="conteiner-fluid">
        <ul>
            <li>Produto</li>
            <ul>
                <li><a href="Produto/Cadastro-produto.php">Cadastrar</a></li>
                <li><a href="Produto/Listar-produto.php">Listar</a></li>
            </ul>
        </ul>
        <ul>
            <li>Venda</li>
            <ul>
                <li><a href="Venda/Listar-vendas.php">Listar(<?php
                                                                include("../conexao.php");
                                                                include("../banco/vendas-admin.php");

                                                                echo ContarVendas($conexao);
                                                                ?>)</a></li>
            </ul>
        </ul>
        <ul>
            <li>Cliente</li>
            <ul>
                <li><a href="cliente/Listar-clientes.php">Listar</a></li>
            </ul>
        </ul>
        <ul>
            <li>Funcionário</li>
            <ul>
                <li><a href="admin/Cadastro-admin.php">Cadastrar</a></li>
                <li><a href="admin/Listar-admin.php">Listar</a></li>
            </ul>
        </ul>
        <ul>
            <li>Fornecedor</li>
            <ul>
                <li><a href="fornecedor/Cadastro-fornecedor.php">Cadastrar</a></li>
                <li><a href="fornecedor/Listar-fornecedores.php">Listar</a></li>
            </ul>
        </ul>
    </div>
</body>

</html>