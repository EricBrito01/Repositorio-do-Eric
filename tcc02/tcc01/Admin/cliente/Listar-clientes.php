<!DOCTYPE html>
<?php
SESSION_start();
if (empty($_SESSION['loginADM'])) {
    header('location:.././admin/Login-admin.php');
}

@$clienteid = $_GET['clienteid'];

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

        <h1> Lista de Clientes Cadastrados </h1>
        <hr>

        <form method="$_GET" class="container-fluid">
            <input class="form-control-sm" style="float: left;width: 50%;margin-right: 1%;" type="text" name="txtpesquisa" placeholder="Buscar Clientes">

            <select name="cbbuscar" class="form-control-sm">
                <option value="0">Selecione</option>
                <option value="1">Nome</option>
                <option value="2">CPF</option>
                <option value="3">Telefone</option>
                <option value="4">Endereço</option>
                <option value="5">Complemento</option>
                <option value="6">Bairro</option>
                <option value="7">Cidade</option>
                <option value="8">Email</option>
            </select>

            <input type="submit" style="margin-left: 1%;" value="Buscar" class="btn btn-success btn-sm">
        </form>

        <hr>


        <table class="table table-striped">
            <th>Código</th>
            <th>Nome</th>
            <th>CPF</th>
            <th>Telefone</th>
            <th>Endereço</th>
            <th>Complemento</th>
            <th>Cidade</th>
            <th>Bairro</th>
            <th>Email</th>
            <?php
            include("./../../conexao.php");
            include("../../banco/banco-usuario.php");


            if ($_GET) {

                if (@$clienteid == null) {
                    $tabela = $_GET['cbbuscar'];
                    $pesquisa  = $_GET['txtpesquisa'];
                } else {
                    $pesquisa = $clienteid;
                    $tabela = 9;
                }

                switch ($tabela) {
                    case 0:
                        $lista = listarCliente($conexao);
                        break;
                    case 1:
                        $tabela = "tb_cliente_nome";
                        $lista = PesquisarUsuario($conexao, $tabela, $pesquisa);
                        break;
                    case 2:
                        $tabela = "tb_cliente_cpf";
                        $lista = PesquisarUsuario($conexao, $tabela, $pesquisa);
                        break;
                    case 3:
                        $tabela = "tb_cliente_tel";
                        $lista = PesquisarUsuario($conexao, $tabela, $pesquisa);
                        break;
                    case 4:
                        $tabela = "tb_cliente_endereco";
                        $lista = PesquisarUsuario($conexao, $tabela, $pesquisa);
                        break;
                    case 5:
                        $tabela = "tb_cliente_complemento";
                        $lista = PesquisarUsuario($conexao, $tabela, $pesquisa);
                        break;
                    case 6:
                        $tabela = "tb_cliente_Bairro";
                        $lista = PesquisarUsuario($conexao, $tabela, $pesquisa);
                        break;
                    case 7:
                        $tabela = "tb_cliente_Cidade";
                        $lista = PesquisarUsuario($conexao, $tabela, $pesquisa);
                        break;
                    case 8:
                        $tabela = "tb_cliente_Email";
                        $lista = PesquisarUsuario($conexao, $tabela, $pesquisa);
                        break;
                    case 9:
                        $tabela = "tb_cliente_id";
                        $lista = listarClienteid($conexao,$clienteid);
                        break;
                }
            } else {
                $lista = listarCliente($conexao);
            }





            foreach ($lista as $cliente) {
            ?>
                <tr>
                    <td><?php echo $cliente['tb_cliente_id']; ?> </td>
                    <td><?php echo $cliente['tb_cliente_nome']; ?> </td>
                    <td><?php echo $cliente['tb_cliente_cpf']; ?> </td>
                    <td><?php echo $cliente['tb_cliente_tel'];; ?> </td>
                    <td><?php echo $cliente['tb_cliente_endereco']; ?> </td>
                    <td><?php echo $cliente['tb_cliente_complemento']; ?> </td>
                    <td><?php echo $cliente['tb_cliente_cidade'] ?> </td>
                    <td><?php echo $cliente['tb_cliente_bairro']; ?> </td>
                    <td><?php echo $cliente['tb_cliente_email'] ?> </td>
                <tr>

                <?php } ?>

        </table>
    </div>

</body>

</html>