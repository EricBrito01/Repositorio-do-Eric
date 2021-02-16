<!DOCTYPE html>
<?php
SESSION_start();
if (empty($_SESSION['loginADM'])) {
    header('location:.././admin/Login-admin.php');
}
?>
<html>

<head>
    <meta charset="UTF-8">
    <meta HTTP-EQUIV='refresh' CONTENT='10'>
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

        <h1> Lista de Todas as Vendas </h1>
        <hr>

        <br>



        <form method="$_GET" class="container-fluid">
            <input class="form-control-sm" style="float: left;width: 50%;margin-right: 1%;" type="text" name="txtpesquisa" placeholder="Buscar Vendas">

            <select name="cbbuscar" class="form-control-sm">
                <option value="0">Selecione</option>
                <option value="1">Data</option>
                <option value="2">Produto</option>
                <option value="3">Cliente</option>
                <option value="4">Preço(R$)</option>
                <option value="5">Quantidade</option>
                <option value="6">Pagamento</option>
                <option value="7">Total(R$)</option>

            </select>

            <input type="submit" style="margin-left: 1%;" value="Buscar" class="btn btn-success btn-sm">
        </form>

        <hr>

        <table class="table table-striped">
            <th>Código</th>
            <th>Data</th>
            <th>Produto</th>
            <th>Cliente</th>
            <th>Preço(R$)</th>
            <th>Quantidade</th>
            <th>Total(R$)</th>
            <th>Status</th>
            <th>Metódo</th>
            <th colspan="2" style="text-align: center;">
                Aprovar Pagamento
            </th>
            

            <?php
            $lista = listarVendas($conexao);

            if ($_GET) {
                $tabela = $_GET['cbbuscar'];
                $pesquisa  = $_GET['txtpesquisa'];

                switch ($tabela) {
                    case 0:
                        $lista = listarVendas($conexao);
                        break;
                    case 1:
                        $tabela = "tb_venda_data";
                        $lista = PesquisarVenda($conexao, $tabela, $pesquisa);
                        break;
                    case 2:
                        $tabela = "tb_produto_nome";
                        $lista = PesquisarVenda($conexao, $tabela, $pesquisa);
                        break;
                    case 3:
                        $tabela = "tb_cliente_nome";
                        $lista = PesquisarVenda($conexao, $tabela, $pesquisa);
                        break;
                    case 4:
                        $tabela = "tb_carrinho_preco";
                        $lista = PesquisarVenda($conexao, $tabela, $pesquisa);
                        break;
                    case 5:
                        $tabela = "tb_carrinho_quantidade";
                        $lista = PesquisarVenda($conexao, $tabela, $pesquisa);
                        break;
                    case 6:
                        $tabela = "tb_carrinho_ativo";
                        $lista = PesquisarVenda($conexao, $tabela, $pesquisa);
                        break;
                    case 7:
                        $tabela = "tb_carrinho_preco";
                        $lista = PesquisarVenda($conexao, $tabela, $pesquisa);
                        break;
                }
            } else {
                $lista = listarVendas($conexao);
            }

            foreach ($lista as $venda) {
            ?>
                <tr>
                    <td><?php echo $venda['tb_venda_id']; ?> </td>
                    <td><?php echo $venda['tb_venda_data']; ?> </td>
                    <td><?php echo $venda['tb_produto_nome']; ?> </td>
                    <td><a href="../cliente/listar-clientes.php?clienteid='<?php echo $venda['tb_cliente_id'] ?>'"><?php echo $venda['tb_cliente_nome']; ?> </td>
                    <td><?php echo $venda['tb_produto_preco']; ?> </td>
                    <td><?php echo $venda['tb_carrinho_quantidade']; ?> </td>
                    <td><?php echo ($venda['tb_produto_preco'] * $venda['tb_carrinho_quantidade']); ?> </td>
                    <td><?php if ($venda['tb_carrinho_ativo'] == 0) {
                            echo "PAGO";
                        } else if ($venda['tb_carrinho_ativo'] == 2) {
                            echo "PENDENTE";
                        }
                        ?> </td>
                    <td><?php if ($venda['tb_venda_metodopag'] == 0) {
                            echo "Dinheiro";
                        } else {
                            echo "Cartão";
                        }
                        ?>
                    </td>
                    <?php
                    if ($venda['tb_carrinho_ativo'] == 0) {
                    } else if ($venda['tb_carrinho_ativo'] == 2) {

                    ?> <td><a href="AprovarVenda.php?carrinhoid='<?php echo $venda['tb_carrinho_id'] ?>'"><button class="btn btn-sm btn-success">Confirmar</button> </td>
                        <td>   <a href="deletar.php?idvenda='<?php echo $venda['tb_venda_id'] ?>'"><button class="btn btn-sm btn-danger">Cancelar</button></td><?php
                                                                                                                                                            }
                                                                                                                                                                ?>

                <tr>
                <?php } ?>
        </table>
    </div>
</body>

</html>