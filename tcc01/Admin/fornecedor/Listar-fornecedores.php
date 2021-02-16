<!DOCTYPE html>
<?php
SESSION_start();
if (empty($_SESSION['loginADM'])) {
    header('location:.././admin/Login-admin.php');
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

        <h1> Lista de Fornecedores Cadastrados </h1>
        <hr>
        <br>

        <form method="$_GET" class="container-fluid">
            <input class="form-control-sm" style="float: left;width: 50%;margin-right: 1%;" type="text" name="txtpesquisa" placeholder="Buscar Fornecedor">

            <select name="cbbuscar" class="form-control-sm">
                <option value="0">Selecione</option>
                <option value="1">Nome</option>
                <option value="2">CNPJ</option>
                <option value="3">Email</option>
                <option value="4">Código</option>
                <option value="5">Endereço</option>
                <option value="6">Cidade</option>
            </select>

            <input type="submit" style="margin-left: 1%;" value="Buscar" class="btn btn-success btn-sm">
        </form>

        <hr>
        <table class=" table table-striped">
            <th>Código</th>
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
            include("../../banco/banco-fornecedores.php");

            if ($_GET) {
                $tabela = $_GET['cbbuscar'];
                $pesquisa  = $_GET['txtpesquisa'];

                switch ($tabela) {
                    case 0:
                        $lista = listarFornecedor($conexao);
                        break;
                    case 1:
                        $tabela = "tb_fornecedor_nome";
                        $lista = PesquisarFornecedor($conexao, $tabela, $pesquisa);
                        break;
                    case 2:
                        $tabela = "tb_fornecedor_cnpj";
                        $lista = PesquisarFornecedor($conexao, $tabela, $pesquisa);
                        break;
                    case 3:
                        $tabela = "tb_fornecedor_email";
                        $lista = PesquisarFornecedor($conexao, $tabela, $pesquisa);
                        break;
                    case 4:
                        $tabela = "tb_fornecedor_id";
                        $lista = PesquisarFornecedor($conexao, $tabela, $pesquisa);
                        break;
                    case 5:
                        $tabela = "tb_fornecedor_endereco";
                        $lista = PesquisarFornecedor($conexao, $tabela, $pesquisa);
                        break;
                    case 6:
                        $tabela = "tb_fornecedor_cidade";
                        $lista = PesquisarFornecedor($conexao, $tabela, $pesquisa);
                        break;
                }
            } else {
                $lista = listarFornecedor($conexao);
            }

            /////////////////////////////////////

            foreach ($lista as $fornecedor) {
            ?>
                <tr>
                    <td><?php echo $fornecedor['tb_fornecedor_id']; ?> </td>
                    <td><?php echo $fornecedor['tb_fornecedor_nome']; ?> </td>
                    <td><?php echo $fornecedor['tb_fornecedor_cnpj']; ?> </td>
                    <td><?php echo $fornecedor['tb_fornecedor_endereco']; ?> </td>
                    <td><?php echo $fornecedor['tb_fornecedor_bairro']; ?> </td>
                    <td><?php echo $fornecedor['tb_fornecedor_cidade']; ?> </td>
                    <td><?php echo $fornecedor['tb_fornecedor_email']; ?> </td>
                    <td><?php echo $fornecedor['tb_fornecedor_tel']; ?> </td>
                    <td><a href="excluir.php?idforn='<?php echo $fornecedor['tb_fornecedor_id'] ?>'">Excluir</a></td>
                    <td><a href="alterar.php?idforn='<?php echo $fornecedor['tb_fornecedor_id'] ?>'">Alterar</a></td>
                <tr>

                <?php } ?>

        </table>
    </div>

</body>

</html>