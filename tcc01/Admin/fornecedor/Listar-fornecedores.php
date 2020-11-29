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

            <h1> Lista de Fornecedores Cadastrados </h1>
            <hr>

            <table class="table table-striped">
                <th>Nome</th>
                <th>CNPJ</th>
                <th>Endereço</th>
                <th>Bairro</th>
                <th>Cidade</th>
                <th>Email</th>
                <th>Telefone</th>
                <th></th>
                <th></th>
                <?php
                include ("./../../conexao.php");
                include("../../banco/banco-fornecedores.php");

                $lista = listarFornecedor($conexao);

                foreach ($lista as $fornecedor)
                {
                    ?>
                    <tr>
                        <td><?php echo $fornecedor['tb_fornecedor_nome']; ?> </td>
                        <td><?php echo $fornecedor['tb_fornecedor_cnpj']; ?> </td>
                        <td><?php echo $fornecedor['tb_fornecedor_endereco']; ?> </td>
                        <td><?php echo $fornecedor['tb_fornecedor_bairro']; ?> </td>
                        <td><?php echo $fornecedor['tb_fornecedor_cidade']; ?> </td>
                        <td><?php echo $fornecedor['tb_fornecedor_email']; ?> </td>
                        <td><?php echo $fornecedor['tb_fornecedor_tel']; ?> </td>
                        <td><a href="excluir.php?idforn='<?php echo $fornecedor['tb_fornecedor_id']?>'">Excluir</a></td>
                        <td><a href="alterar.php?idforn='<?php echo $fornecedor['tb_fornecedor_id']?>'">Alterar</a></td>
                    <tr>

                    <?php } ?>

            </table>
        </div>

    </body>
</html>
