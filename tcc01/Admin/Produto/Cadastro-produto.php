<!DOCTYPE html>
<?php
SESSION_start();
if (empty($_SESSION['loginADM'])) {
    header('location:../admin/Login-admin.php');
}
include("./../../conexao.php");
include("../../banco/banco-produto.php");
include("../../banco/banco-fornecedores.php");
include("../../banco/upload.php");

$lista = listarFornecedor($conexao);
$lista_img = ListarImagem($conexao);
?>
<html>

<title>Cadastro de Produto</title>
<link href="../../css/bootstrap.min.css" rel="stylesheet" type="text/css" />
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
        <h1>Cadastrar Produto</h1>
        <hr>
        <br>
        <form method="POST" enctype="multipart/form-data" action="<?php echo $_SERVER['PHP_SELF']; ?>">

            <h6>Imagem de Exibição:</h6>
            <select name="cbimagem" class="form-control-sm">
                <?php
                foreach ($lista_img as $imagem) {
                ?>
                    <option value="<?php echo $imagem['tb_imagens_prdt_id'] ?>"><?php echo $imagem['tb_imagens_prdt_desc'] ?></option>
                <?php } ?>
            </select>
            <a href="Upload-imagem.php">Adicionar</a>
            <br>
            <br>

            Nome: <input class="form-control" type="text" name="txtnome">
            <br>
            <br>
            Quantidade: <input class="form-control" type="text" name="txtestoque">
            <br>
            <br>
            Preço: <input class="form-control" type="text" name="txtpreco">
            <br>
            <br>
            <h6>Fornecedor:</h6>
            <select name="cbfornecedor" class="form-control-sm">
                <?php
                foreach ($lista as $fornecedor) {
                ?>
                    <option value="<?php echo $fornecedor['tb_fornecedor_id'] ?>"><?php echo $fornecedor['tb_fornecedor_nome'] ?></option>
                <?php } ?>
            </select>
            <a href="../fornecedor/Cadastro-fornecedor.php">Novo...</a>
            <br>
            <br>

            <input class="btn btn-success" type="submit" name="btncadastrar" value="Cadastrar">
        </form>



        <?php
        if ($_POST) {


            $produto_nome = $_POST['txtnome'];
            $produto_qtd = $_POST['txtestoque'];
            $produto_preco = $_POST['txtpreco'];
            $fornecedor_id = $_POST['cbfornecedor'];
            $imagens_prdt_id = $_POST['cbimagem'];


            if (cadastrarProduto($conexao, $produto_nome, $produto_qtd, $produto_preco, $fornecedor_id, $imagens_prdt_id)) {
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
        }



        ?>
    </div>
</body>

</html>