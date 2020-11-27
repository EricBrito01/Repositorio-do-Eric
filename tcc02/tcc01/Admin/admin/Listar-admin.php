<!DOCTYPE html>
<?php
SESSION_start();
if (empty($_SESSION['loginADM'])) {
    header('location:Login-admin.php');
}
?>
<html>

<head>
    <meta HTTP-EQUIV='refresh' CONTENT='20'>
    <meta charset="UTF-8">
    <link href="../../css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <title></title>
</head>

<body>

    <div class="container">
        <?php
         echo 'Bem vindo,' . $_SESSION['adm'] . ' ';
        ?>
        <a style="margin-left: 1%;" href="../Logout.php">Sair</a>
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

        <h1> Lista de Funcionários Cadastrados </h1>
        <hr>
        <br>

        <form method="$_GET" class="container-fluid">
            <input class="form-control-sm" style="float: left;width: 50%;margin-right: 1%;" type="text" name="txtpesquisa" placeholder="Buscar Funcionários">

        <select name="cbbuscar" class="form-control-sm">
                <option value="0">Selecione</option>
                <option value="1">Nome</option>
                <option value="2">Senha</option>
            </select>

            <input type="submit" style="margin-left: 1%;" value="Buscar" class="btn btn-success btn-sm">
        </form>

        <hr>

        <table class=" table table-striped">
            <th>Nome</th>
            <th>Senha</th>
            <th></th>
            <th></th>
            <?php
            include("../../banco/banco-funcionarios.php");


            if ($_GET) {
                $tabela = $_GET['cbbuscar'];
                $pesquisa  = $_GET['txtpesquisa'];

                switch ($tabela) {
                    case 0:
                        $lista = listarAdmins($conexao);
                        break;
                    case 1:
                        $tabela = "tb_admin_nome";
                        $lista = PesquisarAdmins($conexao,$tabela,$pesquisa);
                        break;
                    case 2:
                        $tabela = "tb_admin_senha";
                        $lista = PesquisarAdmins($conexao,$tabela,$pesquisa);
                        break;
                    
                }
            } else {
                $lista = listarAdmins($conexao);
            }
        
            foreach ($lista as $tb_admin) {
            ?>
                <tr>
                    <td><?php echo $tb_admin['tb_admin_nome']; ?> </td>
                    <td><?php echo $tb_admin['tb_admin_senha']; ?> </td>
                    <td><a href="excluir.php?idadmin='<?php echo $tb_admin['tb_admin_id'] ?>'">Excluir</a></td>
                    <td><a href="alterar.php?idadmin='<?php echo $tb_admin['tb_admin_id'] ?>'">Alterar</a></td>
                <tr>

                <?php } ?>

        </table>
    </div>

</body>

</html>