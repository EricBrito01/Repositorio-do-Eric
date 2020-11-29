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

            <h1> Lista de Funcionários Cadastrados </h1>
            <hr>

            <table class="table table-striped">
                <th>Nome</th>
                <th>Senha</th>
                <th></th>
                <th></th>
                <?php
                include ("./../../conexao.php");
                include("../../banco/banco-funcionarios.php");

                $lista = listarAdmins($conexao);

                foreach ($lista as $tb_admin)
                {
                    ?>
                    <tr>
                        <td><?php echo $tb_admin['tb_admin_nome']; ?> </td>
                        <td><?php echo $tb_admin['tb_admin_senha']; ?> </td>
                        <td><a href="excluir.php?idadmin='<?php echo $tb_admin['tb_admin_id']?>'">Excluir</a></td>
                        <td><a href="alterar.php?idadmin='<?php echo $tb_admin['tb_admin_id']?>'">Alterar</a></td>
                    <tr>

                    <?php } ?>

            </table>
        </div>

    </body>
</html>
