<!DOCTYPE html>
<?php
SESSION_start();
if (empty($_SESSION['loginADM']))
{
    header('location:.././admin/Login-admin.php');
}
?>
<html>
    <head>
        <meta charset="UTF-8">
        <link href="../../css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
        <title></title>
    </head>
    <body>
        <div class="container">
            <?php
            echo 'Bem vindo,' . $_SESSION['nome'].' ';
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
                    <li><a href="Listar-vendas.php">Listar</a></li>
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

            <h1> Lista de Todas as Vendas </h1>
            <hr>

            <table class="table table-striped">
                <th>Total</th>
                <th>Cliente</th>
                <?php
                         include ("./../../conexao.php");
                include("../../banco/vendas-admin.php");

                $lista = listarVendas($conexao);

                foreach ($lista as $venda)
                {
                    ?>
                    <tr>
                        <td><?php echo $venda['tb_venda_total']; ?> </td>
                        <td><?php echo $venda['tb_cliente_nome']; ?> </td>
                    <tr>

                    <?php } ?>
            </table>
        </div>
    </body>
</html>
