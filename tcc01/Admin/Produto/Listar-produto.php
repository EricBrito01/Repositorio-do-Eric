<!DOCTYPE html>
<?php
SESSION_start();
if (empty($_SESSION['loginADM'])) {
    header('location:../admin/Login-admin.php');
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
                <li><a href="Cadastro-produto.php">Cadastrar</a></li>
                <li><a href="Listar-produto.php">Listar</a></li>
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

        <h1> Listar Produtos </h1>
        <hr>
        <br>

        <form method="$_GET" class="container-fluid">
            <input class="form-control-sm" style="float: left;width: 50%;margin-right: 1%;" type="text" name="txtpesquisa" placeholder="Buscar Produtos">

            <select name="cbbuscar" class="form-control-sm">
                <option value="0">Selecione</option>
                <option value="1">Nome</option>
                <option value="2">Estoque</option>
                <option value="3">Preço</option>
                <option value="4">Fornecedor</option>
            </select>


            <input type="submit" style="margin-left: 1%;" value="Buscar" class="btn btn-success btn-sm">
        </form>

        <hr>
        

        <table class="table table-striped">
            <th>Código</th>
            <th>Nome</th>
            <th>Estoque</th>
            <th>Preço</th>
            <th>Fornecedor</th>
            <th></th>
            <th></th>
            <?php
            include("../../banco/banco-produto.php");
            $lista = listarProduto($conexao);


            if ($_GET) {
                $tabela = $_GET['cbbuscar'];
                $pesquisa  = $_GET['txtpesquisa'];

                switch ($tabela) {
                    case 0:
                        $lista = listarProduto($conexao);
                        break;
                    case 1:
                        $tabela = "tb_produto_nome";
                        $lista = PesquisaDeProduto($conexao,$tabela,$pesquisa);
                        break;
                    case 2:
                        $tabela = "tb_produto_estoque";
                        $lista = PesquisaDeProduto($conexao,$tabela,$pesquisa);
                        break;
                    case 3:
                        $tabela = "tb_produto_preco";
                        $lista = PesquisaDeProduto($conexao,$tabela,$pesquisa);
                        break;
                    case 4:
                        $tabela = "tb_fornecedor_nome";
                        $lista = PesquisaDeProduto($conexao,$tabela,$pesquisa);
                        break;
                }
            } else {
                $lista = listarProduto($conexao);
            }

            foreach ($lista as $produto) {
            ?>
                <tr>
                    <td><?php echo $produto['tb_produto_id']; ?> </td>
                    <td><?php echo $produto['tb_produto_nome']; ?> </td>
                    <td><?php echo $produto['tb_produto_estoque']; ?> </td>
                    <td><?php echo $produto['tb_produto_preco']; ?> </td>
                    <td><?php echo $produto['tb_fornecedor_nome']; ?> </td>
                    <td><a href="excluir.php?idproduto='<?php echo $produto['tb_produto_id'] ?>'">Excluir</a></td>
                    <td><a href="alterar.php?idproduto='<?php echo $produto['tb_produto_id'] ?>'">Alterar</a></td>
                <tr>

                <?php } ?>

        </table>
</body>

</html>