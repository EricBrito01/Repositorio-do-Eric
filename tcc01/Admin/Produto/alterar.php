<!DOCTYPE html>
<?php
SESSION_start();
if (empty($_SESSION['loginADM']))
{
    header('location:../admin/Login-admin.php');
}
include ("./../../conexao.php");
include("../../banco/banco-produto.php");

$idproduto = $_GET['idproduto'];

$listaid = listaridProduto($conexao, $idproduto);

include("../../banco/banco-fornecedores.php");

foreach ($listaid as $produto)
{
    ?>
    <html>
        <title>Alterar Produto</title>
        <link href="../../css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
        <meta charset="utf-8"> 
    </head>
    <body>
        <div class="container">
            <h1>Alterar Produto</h1>
            <hr>
            <br>
            <form method="post">
                ID: <input class="form-control" type="text" readonly="true" name="txtnome" value="<?php echo $idproduto ?>">
                <br>
                <br>
                Nome: <input class="form-control" type="text" name="txtnome" value="<?php echo $produto['tb_produto_nome'] ?>">
                <br>
                <br>
                Estoque: <input class="form-control" type="text" name="txtestoque" value="<?php echo $produto['tb_produto_estoque'] ?>">
                <br>
                <br>
                Preço: <input class="form-control" type="text" name="txtpreco" value="<?php echo $produto['tb_produto_preco'] ?>">
                <br>
                <br>
                Fornecedor:
                <select name = "cbfornecedor" class = "form-control-sm">
                    <?php
                    $listaforn = listarFornecedor($conexao);
                    foreach ($listaforn as $fornecedor)
                    {
                        ?>
                        <option value="<?php echo $fornecedor['tb_fornecedor_id'] ?>"><?php echo $fornecedor['tb_fornecedor_nome'] ?></option>
                    <?php } ?>
                </select>
                <a href="../fornecedor/Cadastro-fornecedor.php">Novo...</a>
                <br>
                <br>
                <input class="btn btn-success" type="submit" name="btncadastrar" value="Alterar">
            </form>

            <?php
            if ($_POST)
            {
                $produto_nome = $_POST['txtnome'];
                $produto_qtd = $_POST['txtestoque'];
                $produto_preco = $_POST['txtpreco'];
                $fornecedor_id = $_POST['cbfornecedor'];

                if (alterarProduto($conexao, $produto_nome, $idproduto, $produto_qtd, $produto_preco, $fornecedor_id))
                {
                    ?>
                    <br>
                    <div class="alert alert-success" role="alert" id="alerta">Alterado com Sucesso !
                    </div>
                    <?php
                    header('location:Listar-produto.php');
                }
                else
                {
                    ?> 
                    <br>
                    <div class="alert alert-danger" role="alert" id="alerta">Informações Invalídas !
                    </div> 
                    <?php
                }
            }
        }
        ?>

</body>
</html>
