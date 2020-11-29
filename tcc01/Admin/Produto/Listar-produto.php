<!DOCTYPE html>
<?php
SESSION_start();
if (empty($_SESSION['loginADM']))
{
    header('location:../admin/Login-admin.php');
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
                    <li><a href="Cadastro-produto.php">Cadastrar</a></li>
                    <li><a href="Listar-produto.php">Listar</a></li>
                </ul>
            </ul>
            <ul>
                <li>Venda</li>
                <ul>
                    <li><a href="../Venda/Listar-vendas.php">Listar</a></li>
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

            <h1> Listar Produtos </h1>
            <hr>
            <table class="table table-striped">
                <th>id</th>
                <th>Nome</th>
                <th>Estoque</th>
                <th>Preço</th>
                <th>Fornecedor</th>
                <th></th>
                <th></th>
                <?php
                include ("../../conexao.php");
                include("../../banco/banco-produto.php");
                $lista = listarProduto($conexao);

                foreach ($lista as $produto)
                {
                    ?>
                    <tr>
                        <td><?php echo $produto['tb_produto_id']; ?> </td>
                        <td><?php echo $produto['tb_produto_nome']; ?> </td>
                        <td><?php echo $produto['tb_produto_estoque']; ?> </td>
                        <td><?php echo $produto['tb_produto_preco']; ?> </td>
                        <td><?php echo $produto['tb_fornecedor_nome']; ?> </td>
                        <td><a href="excluir.php?idproduto='<?php echo $produto['tb_produto_id']?>'">Excluir</a></td>
                        <td><a href="alterar.php?idproduto='<?php echo $produto['tb_produto_id']?>'">Alterar</a></td>
                    <tr>

                    <?php } ?>

            </table>
    </body>
</html>
