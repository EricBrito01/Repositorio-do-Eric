<!DOCTYPE html>
<?php
SESSION_start();
if (empty($_SESSION['loginADM'])) {
    header('location:.././admin/Login-admin.php');
}
?>
<html>

<head>
    
    <title>Cadastro de Fornecedor</title>
    <link href="../../css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="../css/stylesheets/locastyle.css" rel="stylesheet" type="text/css" />
    <meta charset="utf-8">

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
        <h1>Cadastrar Fornecedor</h1>
        <hr>
        <br>
        <form method="post">
            Nome: <input class="form-control" type="text" name="txtnome">
            <br>
            <br>
            CNPJ: <input class="form-control" type="text" name="txtcnpj" placeholder="Sem traços ou pontos">
            <br>
            <br>
            Endereço: <input class="form-control" type="text" name="txtendereco">
            <br>
            <br>
            Bairro: <input class="form-control" type="text" name="txtbairro">
            <br>
            <br>
            Cidade: <input class="form-control" type="text" name="txtcidade">
            <br>
            <br>
            Email: <input class="form-control" type="text" name="txtemail">
            <br>
            <br>
            Telefone: <input class="form-control" placeholder="Sem traços ou pontos" type="text" name="txttel">
            <br>
            <br>
            <input class="btn btn-success" type="submit" name="btncadastrar" value="Cadastrar">
        </form>


        <?php
        include("./../../conexao.php");
        include("../../banco/banco-fornecedores.php");

        if ($_POST) {
            $nome_fornecedor = $_POST['txtnome'];
            $tel_fornecedor = $_POST['txttel'];
            $cnpj_fornecedor = $_POST['txtcnpj'];
            $endereco_fornecedor = $_POST['txtendereco'];
            $bairro_fornecedor = $_POST['txtbairro'];
            $cidade_fornecedor = $_POST['txtcidade'];
            $email_fornecedor = $_POST['txtemail'];

            if (valida_cnpj($cnpj_fornecedor)) {
                if (cadastrarFornecedor($conexao, $nome_fornecedor, $cnpj_fornecedor, $endereco_fornecedor, $bairro_fornecedor, $cidade_fornecedor, $email_fornecedor, $tel_fornecedor)) {

        ?>
                    <br>
                    <div class="alert alert-success" role="alert" id="alerta">Cadastrado com Sucesso !
                    </div>
                <?php
                } else {
                ?>
                    <br>
                    <div class="alert alert-danger" role="alert" id="alerta">Informações Invalídas !
                    </div>
                <?php
                }
            } else {
                ?>
                <br>
                <div class="alert alert-danger" role="alert" id="alerta">CNPJ Invalído !
                </div>
        <?php
            }
        }
        ?>


</body>

</html>